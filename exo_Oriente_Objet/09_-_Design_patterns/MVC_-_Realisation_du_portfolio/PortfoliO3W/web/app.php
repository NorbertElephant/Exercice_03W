<?php
error_reporting( E_ALL & ~E_NOTICE ); // Sets which PHP errors are reported (http://php.net/manual/fr/function.error-reporting.php)
try {
    require_once( '../app/config/ini.php' );
    require_once( APPPATH . 'autoloader.php' );

    /**
     * --------------------------------------------------
     * AUTOROUTING
     * --------------------------------------------------
    **/
    NavigationManagement::route( get_app_info('url') );
    /** **/
} catch( KernelException $e ) {
    if( DEBUG_MODE )
        die( $e );
    else
        NavigationManagement::redirect( DOMAIN . 'error/500/');

} catch( Exception $e ) {
    if( DEBUG_MODE )
        die( $e->getMessage() );
    else
        NavigationManagement::redirect( DOMAIN . 'error/500/');
}