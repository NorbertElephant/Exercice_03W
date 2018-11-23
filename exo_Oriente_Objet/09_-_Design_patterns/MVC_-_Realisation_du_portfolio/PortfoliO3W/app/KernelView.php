<?php
// METTRE AU PROPRE : Params / Setters / Getters / Returns / Visibilité
/**
 * ------------------------------------------------------------
 * CORE VIEW
 * (Requires : SRequest | KernelException | KernelLayout)
 * ------------------------------------------------------------
**/
class KernelView {
    /**
     * --------------------------------------------------
     * PROPERTIES
     * --------------------------------------------------
    **/
    private $_controller;
    private $_action;
    private $_path;
    private $_layout;
    private $_cache;

    private $_properties = [];


    /**
     * --------------------------------------------------
     * MAGIC METHODS
     * --------------------------------------------------
    **/
    /**
     * __construct - Class constructor
     * @param   string  $controller
     *          string  $action
     *          string  $path
     * @return
    **/
    public function __construct( $controller, $action, $path ) {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_path = $path;
    }

    /**
     * __set - Setter
     * @param   string  $property
     *          mixed   $value
     * @return
    **/
    public function __set( $property, $value ) {
        $this->_properties[$property] = $value;
    }

    /**
     * __get - Getter
     * @param   string  $property
     * @return  mixed
    **/
    public function __get( $property ) {
        return ( isset( $this->_properties ) && array_key_exists( $property, $this->_properties ) ? $this->_properties[$property] : FALSE );
    }



    /**
     * --------------------------------------------------
     * SETTERS
     * --------------------------------------------------
    **/
    /**
     * setLayout -
     * @param   string  $layout
     * @return
    **/
    public function setLayout( $layout ) {
        try {
            $this->_layout = new KernelLayout( $layout, $this );
        } catch( Exception $e ) {
            throw new KernelException( 'Can not declare a new layout object', $e->getCode(), $e );
        }
    }

    /**
     * setCache -
     * @param   [int        $delay]
     *          [string     $path]
     * @return
    **/
    public function setCache( Int $delay = 0, $path = '' ) {
        $this->_cache = array(
            'delay' => $delay,
            'path'  => $path
        );
    }



    /**
     * --------------------------------------------------
     * GETTERS
     * --------------------------------------------------
    **/
    /**
     * getProperties -
     * @param
     * @return
    **/
    public function getProperties() {
        return ( isset( $this->_properties ) ? $this->_properties : array() );
    }

    /**
     * getLayout -
     * @param
     * @return
    **/
    public function getLayout() {
        return $this->_layout;
    }



    /**
     * --------------------------------------------------
     * METHODS
     * --------------------------------------------------
    **/
    /**
     * render - Renders the view wrapped into the layout
     * @param   bool    $cache
     *          string  $view
     *          string  $layout
     * @return
    **/
    public function render( Bool $cache, $view, $layout ) {
        try {

            if( !isset( $view ) )
                $view = $this->_action;

            if( !isset( $this->_cache['path'] ) || ( isset( $this->_cache['delay'] ) && $this->_cache['delay']<=0 ) )
                $cache = FALSE;

            if( $cache ) :
                if( file_exists( $this->_cache['path'] . $this->_controller ) || mkdir( $this->_cache['path'] . $this->_controller, 0777, TRUE ) )
                    $file = $this->_cache['path'] . $this->_controller . DS . $view . ( SRequest::getInstance()->get( 'id' )!==NULL ? '-' . SRequest::getInstance()->get( 'id' ) : '' ) . '.html';
                else
                    $file = $this->_cache['path'] . $this->_controller . ucfirst( $view ) . ( SRequest::getInstance()->get( 'id' )!==NULL ? '-' . SRequest::getInstance()->get( 'id' ) : '' ) . '.html';

                $expire = time() - $this->_cache['delay'];
            endif;

            extract( $this->getProperties() );

            if( $private && ( empty( $me ) || empty( $me->getLogin() ) ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( $cache && file_exists( $file ) && filemtime( $file ) > $expire ) :
                $html = file_get_contents( $file );
            else :
                if( file_exists( $this->_path . $view . '.php' ) ) :
                    ob_start();
                    include( $this->_path . $view . '.php' );
                    $html = ob_get_contents();
                    ob_end_clean();

                    $this->_layout->setLayout( $layout );
                    $html = $this->_layout->wrap( $html );

                    if( $cache ) :
                        file_put_contents( $file, $html );
                    endif;
                else :
                    throw new KernelException( 'Can not render the <strong>' . $this->_action . '</strong> view in  <strong>' . $this->_controller . '</strong>' );
                endif;
            endif;

            return $html;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not wrap the <strong>' . $view . '</strong> view in the layout', $e->getCode(), $e );
        }
    }
}