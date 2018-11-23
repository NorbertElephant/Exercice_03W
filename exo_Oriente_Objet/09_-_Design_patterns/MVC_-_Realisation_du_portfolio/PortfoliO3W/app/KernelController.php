<?php
/**
 * ------------------------------------------------------------
 * KERNEL CONTROLLER
 * (Requires : NavigationManagement | TypeTest | SRequest | KernelException | KernelView | AuthModule)
 * ------------------------------------------------------------
**/
abstract class KernelController {
    use TypeTest;

    /**
     * --------------------------------------------------
     * PROPERTIES
     * --------------------------------------------------
    **/
    private $_controller;
    private $_action;
    private $_model;
    private $_view;
    private $_request;
    private $_settings;
    private $_caching;
    private $_mod_auth;



    /**
     * --------------------------------------------------
     * MAGIC METHODS
     * --------------------------------------------------
    **/
    /**
     * __construct - Class constructor
     * @param   SRequest    $request
     * @return
    **/
    public function __construct( SRequest $request ) {
        $this->_request = $request;
        $this->_controller = substr( get_class( $this ), 0, strlen( 'Controller' )*(-1) );
        $this->_caching = ( CACHE_DELAY>0 ? TRUE : FALSE );

        $this->_settings = array(
            'model'     => array( 'path'  => BUNDLESPATH . $this->_controller . DS ),
            'view'      => array( 'path'  => BUNDLESPATH . $this->_controller . DS . 'Views' . DS ),
            'layout'    => array( 'path'  => THEMESPATH . 'default' . DS ),
        );

        $this->mergeSettings();

        KernelException::$_debug_mode = ( defined( 'DEBUG_MODE' ) && is_bool( DEBUG_MODE ) ? DEBUG_MODE : KernelException::DEBUG_MODE );

        if( method_exists( $this, 'preload' ) )
            $this->preload();
    }



    /**
     * --------------------------------------------------
     * SETTERS
     * --------------------------------------------------
    **/
    /**
     * setAction -
     * @param   string  $action
     * @return
    **/
    protected function setAction( $action ) {
        $this->_action = substr( $action, 0, strlen( 'Action' )*(-1) );
    }

    /**
     * setView -
     * @param
     * @return
    **/
    protected function setView() {
        try {
            $this->_view = new KernelView( $this->_controller, $this->_action, ( isset( $this->_settings['view']['path'] ) ? $this->_settings['view']['path'] : '' ) );
            $this->_view->setLayout( ( isset( $this->_settings['layout']['path'] ) ? $this->_settings['layout']['path'] : '' ) );
            $this->_view->setCache( CACHE_DELAY, CACHEPATH );

            $this->_view->title = nl2br( self::translate( $this->_settings['site_title'], ( $this->_request->get( 'lang' )!==NULL ? $this->_request->get( 'lang' ) : ISO_LANGUAGE_CODE ) ) );
            $this->_view->baseline = nl2br( self::translate( $this->_settings['site_baseline'], ( $this->_request->get( 'lang' )!==NULL ? $this->_request->get( 'lang' ) : ISO_LANGUAGE_CODE ) ) );
            $this->_view->street = $this->_settings['address']['street'];
            $this->_view->additional = $this->_settings['address']['additional'];
            $this->_view->zipcode = $this->_settings['address']['zipcode'];
            $this->_view->city = $this->_settings['address']['city'];
            $this->_view->email = $this->_settings['contacts']['email'];
            $this->_view->phone = $this->_settings['contacts']['phone'];

            if( $this->isAuthentified() )
                $this->_view->me = ( $this->_mod_auth!==NULL && $this->_mod_auth->getUser()!==NULL ? $this->_mod_auth->getUser() : new ClassUser );

            $this->_view->error = $this->_request->get( '_err' );
        } catch( Exception $e ) {
            throw new KernelException( 'Can not declare a new view object', $e->getCode(), $e );
        }
    }

    /**
     * setModel -
     * @param
     * @return
    **/
    protected function setModel() {
        $modelName = $this->_controller . 'Model'; // Defines the default model's name

        if( file_exists( ( isset( $this->_settings['model']['path'] ) ? $this->_settings['model']['path'] : '' ) . $modelName . '.php' ) )
            $this->_model = new $modelName();
        else
            throw new KernelException( 'Can not find the specified model', 120 );
    }



    /**
     * --------------------------------------------------
     * GETTERS
     * --------------------------------------------------
    **/
    /**
     * getController -
     * @param
     * @return string
    **/
    protected function getController() {
        return $this->_controller;
    }

    /**
     * getAction -
     * @param
     * @return string
    **/
    protected function getAction() {
        return $this->_action;
    }

    /**
     * getModel -
     * @param
     * @return KernelModel
    **/
    protected function getModel() {
        return $this->_model;
    }

    /**
     * getView -
     * @param
     * @return KernelView
    **/
    protected function getView() {
        return $this->_view;
    }

    /**
     * getRequest -
     * @param
     * @return SRequest
    **/
    protected function getRequest() {
        return $this->_request;
    }

    /**
     * getSettings -
     * @param
     * @return Array
    **/
    protected function getSettings() {
        return $this->_settings;
    }

    /**
     * getCaching -
     * @param
     * @return Bool
    **/
    protected function getCaching() {
        return $this->_caching;
    }

    /**
     * getModAuth -
     * @param
     * @return AuthModule
    **/
    protected function getModAuth() {
        return $this->_mod_auth;
    }



    /**
     * --------------------------------------------------
     * ACTIONS
     * --------------------------------------------------
    **/
    /**
     * defaultAction - Defines the default action
     * @param
     * @return
    **/
    abstract public function defaultAction();



    /**
     * --------------------------------------------------
     * METHODS
     * --------------------------------------------------
    **/
    /**
     * translate -
     * @param   string      $sentence
     *          [string     $lang]
     * @return
    **/
    public static function translate( $sentence, $lang = NULL ) {
        $sentence = preg_replace_callback( '/\[:([^\]]+)\]([^\[]+)/', function ( $matches ) {
            return '{"' . $matches[1] . '":"' . $matches[2] . '"}';
        }, $sentence );

        $languages = json_decode( str_replace( '}{', ',', $sentence ), TRUE );

        if( !is_null( $languages ) && !empty( $lang ) )
            if( isset( $languages[$lang] ) ) :
                return $languages[$lang];
            endif;
        else
            return $sentence;

        return FALSE;
    }

    /**
     * launcher - Launches the action
     * @param   string  $action
     * @return
    **/
    public function launcher( $action ) {
        try {
            if( method_exists( $this, $action ) )
                $this->$action();
            else
                NavigationManagement::redirect( DOMAIN . 'error/404/' );
                // throw new KernelException( 'Can not find the <strong>' . $this->_action . '</strong> specified controller\'s method', 100 );

        } catch( Exception $e ) {
            throw new KernelException( 'Can not launch the <strong>' . $this->_action . '</strong> application controller\'s method', $e->getCode(), $e );
        }
    }

    /**
     * preload - Calls before any other action
     * @param
     * @return
    **/
    protected function preload() {
        $this->_mod_auth = new AuthModule( APP_TAG );
    }

    /**
     * init - Initiates the action
     * @param   string  $action
     * @return
    **/
    protected function init( $action ) {
        $this->setAction( $action );
        $this->setView();
    }

    /**
     * render - Renders the view
     * @param   [bool       $cache]
     *          [string     $view]
     *          [string     $layout]
     * @return
    **/
    protected function render( Bool $cache = FALSE, $view = NULL, $layout = NULL ) {
        try {
            
            echo $this->_view->render( $cache, $view, $layout );
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->_action . '</strong> view in  <strong>' . $this->_controller . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * disableCache - Disables the cache
     * @param
     * @return
    **/
    protected function disableCache() {
        $this->_caching = FALSE;
    }

    /**
     * isAuthentified - Indicates if anyone is authentified
     * @param
     * @return  bool
    **/
    protected function isAuthentified() {
        if( $this->_mod_auth!==NULL && $this->_mod_auth->getUser()!==NULL )
            return TRUE;

        return FALSE;
    }

    /**
     * mergeSettings - Merges the settings with those stored in the database
     * @param
     * @return
    **/
    private function mergeSettings() {
        if( file_exists( APPPATH . 'KernelModel.php' ) )
            $model = new KernelModel();
        else
            throw new KernelException( 'Can not find the specified model', 120 );

        $this->_settings = array_merge( $this->_settings, json_decode( $model->getSetting( 'general_settings' ), TRUE ) );
    }
}