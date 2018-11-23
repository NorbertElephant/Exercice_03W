<?php
/**
 * _n -
 * @param
 * @return
**/
function _n() {
    return call_user_func_array( 'ngettext', func_get_args() );
}

/**
 * app_info - Displays information about the current app
 * @param   [string     $show]
 * @return
**/
function app_info( $show = '' ) {
    echo get_app_info( $show );
}

/**
 * get_app_info - Retrieves information about the current app
 * @param   [string     $show]
 * @return  string
**/
function get_app_info( $show = '' ) {
    switch( $show ) :
        case 'url':
        case 'home':
            return get_home_url();
            break;
        case 'charset':
            return get_option( 'charset', 'UTF-8' );
            break;
        case 'language':
            return get_option( 'language', 'en' );
            break;
        case 'text_direction':
            if( function_exists( 'is_rtl' ) )
                return ( is_rtl() ? 'rtl' : 'ltr' );
            else
                return 'ltr';
            break;
        case 'app_name':
            return get_option( 'app_name' );
            break;
        case 'app_description':
            return get_option( 'app_description' );
            break;
        case 'stylesheet_url':
            return get_stylesheet_uri();
            break;
        case 'admin_stylesheet_url':
            return get_stylesheet_uri( TRUE );
            break;
        case 'assets_directory':
            return get_assets_directory_uri();
            break;
        case 'support_email':
            return get_option( 'support_email' );
            break;
        case 'pagination':
            return get_option( 'pagination', 20 );
            break;
    endswitch;
}

/**
 * get_home_url - Retrieves the URL for the current app where the front end is accessible
 * @param
 * @return  string
**/
function get_home_url() {
    return DOMAIN;
}

/**
 * get_uploads_url - Retrieves the URL for the uploads dir
 * @param
 * @return  string
**/
function get_uploads_url() {
    return DOMAIN . 'web' . DS . 'uploads' . DS;
}

/**
 * get_option - Retrieves an option value based on an option name
 * @param   string     $option
 *          [mixed      $default]
 * @return  mixed
**/
function get_option( $option, $default = FALSE ) {
    if( empty( $option ) )
        return FALSE;

    switch( $option ) :
        case 'charset':
            return defined( 'CHARSET' ) ? CHARSET : $default;
            break;
        case 'language':
            $output = defined( 'ISO_LANGUAGE_CODE' ) ? ISO_LANGUAGE_CODE : $default;
            return str_replace( '_', '-', $output );
            break;
        case 'app_name':
            return defined( 'SITE_TITLE' ) ? SITE_TITLE : '';
            break;
        case 'app_description':
            return defined( 'DESCRIPTION' ) ? DESCRIPTION : '';
            break;
        case 'support_email':
            return defined( 'SUPPORT_EMAIL' ) ? SUPPORT_EMAIL : $default;
            break;
        case 'pagination':
            return defined( 'RESULTS_PER_PAGE' ) ? RESULTS_PER_PAGE : $default;
            break;
    endswitch;
}

/**
 * get_stylesheet_uri - Retrieves the URI of current theme stylesheet
 * @param   bool    $backend
 * @return  string
**/
function get_stylesheet_uri( $backend = FALSE ) {
    return ( !$backend ? THEME_URL . 'style.css' : DOMAIN . 'app/themes/default/Admin/style.css' );
}

/**
 * get_assets_directory_uri - Retrieves the URI of current theme stylesheet
 * @param
 * @return  string
**/
function get_assets_directory_uri() {
    return ASSETS_URL;
}

/**
 * get_assets_directory_uri - Displays the language attributes for the html tag
 * @param   [string     $doctype]
 * @return
**/
function language_attributes( $doctype = 'html' ) {
    echo get_language_attributes( $doctype );
}

/**
 * get_language_attributes - Gets the language attributes for the html tag
 * @param   [string     $doctype]
 * @return  string
**/
function get_language_attributes( $doctype = 'html' ) {
    $attributes = array();

    if( function_exists( 'is_rtl' ) && is_rtl() )
        $attributes[] = 'dir="rtl"';

    if( ( $lang = get_app_info( 'language' ) )!==FALSE ) :
        if( $doctype == 'html' )
            $attributes[] = 'lang="' . $lang . '"';

        if( $doctype == 'xhtml' )
            $attributes[] = 'xmlns="http://www.w3.org/1999/xhtml" lang="' . $lang . '" xml:lang="' . $lang / '"';
    endif;

    return ' ' . implode( ' ', $attributes );
}

/**
 * is_current_menu_item - Defines if the current menu item is the current page
 * @param   string  $uri
 * @return  bool
**/
function is_current_menu_item( $uri ) {
    if( NavigationManagement::requestUri()==$_SERVER['REQUEST_URI'] )
        $walks = array_diff( explode( '/', NavigationManagement::requestUri( $uri ) ), explode( '/', $_SERVER['REQUEST_URI'] ) );
    else
        $walks = array_diff( explode( '/', $_SERVER['REQUEST_URI'] ), explode( '/', NavigationManagement::requestUri( $uri ) ) );

    if( empty( $walks ) )
        return TRUE;

    return FALSE;
}

/**
 * display_errors - Displays errors
 * @param
 * @return
**/
function display_errors() {
    echo NavigationManagement::errors();
}