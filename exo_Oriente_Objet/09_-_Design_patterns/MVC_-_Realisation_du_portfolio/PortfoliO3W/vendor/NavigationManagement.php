<?php
trait NavigationManagement {
    /**
     * requestUri -
     * @param   [string     $uri]
     * @return  string
    **/
    static public function requestUri( $uri = NULL ) {
        return substr( ( !is_null( $uri ) ? $uri : get_app_info( 'url' ) ), strlen( ( isset( $_SERVER['REQUEST_SCHEME'] ) ? $_SERVER['REQUEST_SCHEME'] : 'http' ) . '://' . $_SERVER['SERVER_NAME'] ) );
    }

    /**
     * redirect -
     * @param   [string     $uri]
     * @return
    **/
    static public function redirect( $uri = 'error/404/' ) {
        header( 'Location:' . $uri );
        exit;
    }

    /**
     * walks - Defines the walks
     * @param   [string     $base_uri]
     * @return  array
    **/
    static public function walks( $base_uri = NULL ) {
        $request_uri = ( strlen( $_SERVER['QUERY_STRING'] )>0 ? substr( $_SERVER['REQUEST_URI'], 0, ( ( strlen( $_SERVER['QUERY_STRING'] ) * (-1) ) - 1 ) ) : $_SERVER['REQUEST_URI'] );
        return array_values( array_diff( explode( '/', $request_uri ), explode( '/', ( !empty( $base_uri ) ? $base_uri : DOMAIN ) ) ) );
    }

    /**
     * clean - Cleans the walks
     * @param   string      $walk
     * @return  string
    **/
    static public function clean( $walk ) {
        return str_replace( ' ', '', ucwords( strtolower( preg_replace( '/(_|-)/', ' ', $walk ) ) ) );
    }

    /**
     * route - Defines the route
     * @param   string      $base_uri
     *          [string     $default_controller]
     *          [string     $default_action]
     * @return
    **/
    static public function route( $base_uri, $default_controller = 'Pages', $default_action = 'default' ) {
        $walks = self::walks( $base_uri );

        if( count( $walks )>0 )
            $class = self::clean( $walks[0] ) . 'Controller'; // Defines the controller's name depending on passed value

        if( !isset( $class ) || !class_exists( $class ) )
            $class = $default_controller . 'Controller'; // Defines the default controller's name

        if( class_exists( $class ) ) :
            $ctrl = new $class( SRequest::getInstance() ); // Instantiates the controller

            if( count( $walks )>1 )
                $method = self::clean( $walks[1] ) . 'Action'; // Defines the method's name depending on passed value
            elseif( count( $walks )==1 && $class==$default_controller . 'Controller' )
                $method = self::clean( $walks[0] ) . 'Action'; // Defines the method's name depending on passed value
            else
                $method = $default_action . 'Action'; // Defines the default method's name

            if( method_exists( $ctrl, 'launcher' ) ) :
                $ctrl->launcher( $method ); // Calls the launcher
                exit;
            endif;
        endif;

        throw new KernelException( '[Loader Exception] Class "' . $class . '" not found' );
    }

    /**
     *
    **/
    static public function errors() {
        if( SRequest::getInstance()->get( '_err' )!==NULL )
            switch( SRequest::getInstance()->get( '_err' ) ) :
                case 'ok':
                    return _( '<span class="ok">Updating successfully</span>' );
                    break;
                case 'required':
                    return _( '<span class="warning">Please fill all required fields</span>' );
                    break;
                case 'password':
                    return _( '<span class="warning">Password mismatch</span>' );
                    break;
                case 'avatar':
                    return _( '<span class="warning">Avatar can\'t be changed</span>' );
                    break;
                case 'login':
                    return _( '<span class="error">Wrong login or password. Try again</span>' );
                    break;
                default:
                    return _( '<span class="error">An error occured</span>' );
            endswitch;
    }
}