<?php
error_reporting( E_ALL & ~E_NOTICE ); // Sets which PHP errors are reported (http://php.net/manual/fr/function.error-reporting.php)
if( !defined( 'DEBUG_MODE' ) )
    define( 'DEBUG_MODE', TRUE );

/**
 * --------------------------------------------------
 * CORE PREDEFINED CONSTANTS
 * http://php.net/manual/fr/reserved.constants.php
 * --------------------------------------------------
**/
if( strtoupper( substr( PHP_OS, 0, 3 ) ) == 'WIN' ) : // If the version of the operating system (provided by the pre-defined constants PHP_OS) corresponds to a Windows kernel,
    if( !defined( 'PHP_EOL') ) : define( 'PHP_EOL', "\r\n" ); endif;
    if( !defined( 'PATH_SEPARATOR') ) : define( 'PATH_SEPARATOR', ';' ); endif;
    if( !defined( 'DIRECTORY_SEPARATOR') ) : define( 'DIRECTORY_SEPARATOR', "\\" ); endif;
else :
    if( !defined( 'PHP_EOL') ) : define( 'PHP_EOL', "\n" ); endif;
    if( !defined( 'PATH_SEPARATOR') ) : define( 'PATH_SEPARATOR', ':' ); endif;
    if( !defined( 'DIRECTORY_SEPARATOR') ) : define( 'DIRECTORY_SEPARATOR', "/" ); endif;
endif;

if( !defined( 'DS' ) )
    define( 'DS', DIRECTORY_SEPARATOR ); // Defines the folder separator connected to the system
/** **/



if( !defined( 'ABSPATH' ) )
    define( 'ABSPATH', __DIR__ . DS . '..' . DS . '..' . DS ); // Defines the root folder
if( !defined( 'CONFIGPATH' ) )
    define( 'CONFIGPATH', ABSPATH . 'app' . DS . 'config' . DS ); // Defines the config folder

require_once( CONFIGPATH . 'framewind.conf' );
require_once( CONFIGPATH . 'app.conf' );
require_once( CONFIGPATH . 'db.conf' );
require_once( CONFIGPATH . 'intl.conf' );

require_once( VENDORPATH . 'common.php' );