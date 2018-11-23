<!DOCTYPE html>
<html<?php language_attributes(); ?>>
    <head>
        <meta charset="<?php app_info( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <title><?php echo ( isset( $sitename ) ? $sitename . ( defined( 'TITLE_SEPARATOR' ) ? TITLE_SEPARATOR : '' ) : '' ) . get_app_info( 'app_name' ); ?></title>

        <link rel="apple-touch-icon" sizes="180x180" href="<?php app_info( 'assets_directory' ); ?>favicons/apple-touch-icon.png?v=qAqGWwBKv7">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php app_info( 'assets_directory' ); ?>favicons/favicon-32x32.png?v=qAqGWwBKv7">
        <link rel="icon" type="image/png" sizes="194x194" href="<?php app_info( 'assets_directory' ); ?>favicons/favicon-194x194.png?v=qAqGWwBKv7">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php app_info( 'assets_directory' ); ?>favicons/android-chrome-192x192.png?v=qAqGWwBKv7">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php app_info( 'assets_directory' ); ?>favicons/favicon-16x16.png?v=qAqGWwBKv7">
        <link rel="manifest" href="<?php app_info( 'assets_directory' ); ?>favicons/manifest.json?v=qAqGWwBKv7">
        <link rel="mask-icon" href="<?php app_info( 'assets_directory' ); ?>favicons/safari-pinned-tab.svg?v=qAqGWwBKv7" color="#e91e63">
        <link rel="shortcut icon" href="<?php app_info( 'assets_directory' ); ?>favicons/favicon.ico?v=qAqGWwBKv7">
        <meta name="apple-mobile-web-app-title" content="Objectif 3W">
        <meta name="application-name" content="Objectif 3W">
        <meta name="msapplication-TileColor" content="#263238">
        <meta name="msapplication-TileImage" content="<?php app_info( 'assets_directory' ); ?>favicons/mstile-144x144.png?v=qAqGWwBKv7">
        <meta name="msapplication-config" content="<?php app_info( 'assets_directory' ); ?>favicons/browserconfig.xml?v=qAqGWwBKv7">
        <meta name="theme-color" content="#263238">

        <style type="text/css">
            <!--
            @import url('<?php app_info( 'assets_directory' ); ?>fonts/font-awesome/css/font-awesome.min.css');
            @import url('<?php app_info( 'stylesheet_url' ); ?>');
            -->
        </style>
    </head>
    <body>
        <div id="column-left">
            <header role="banner">
                <a id="primary-logo" href="<?php app_info( 'home' ); ?>" title="<?php app_info( 'app_name' ); ?>"><img alt="<?php app_info( 'app_name' ); ?>" class="logo svg" data-svg="<?php app_info( 'assets_directory' ); ?>images/logo_objectif3w_vertical.svg" src="<?php app_info( 'assets_directory' ); ?>images/logo_objectif3w_vertical.png"><!-- <span id="site-title"><?php app_info( 'app_name' ); ?></span> --></a>
                <nav id="primary-nav">
                    <ul class="menus" id="primary-menu">
                        <li class="menu-item<?php if( is_current_menu_item( get_app_info( 'home' ) ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'home' ); ?>" title="<?php echo _( 'Home' ); ?>"><?php echo _( 'Home' ); ?></a></li>
                        <li class="menu-item<?php if( is_current_menu_item( get_app_info( 'url' ) . 'services/' ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'url' ); ?>services/" title="<?php echo KernelController::translate( 'Services' ); ?>"><?php echo KernelController::translate( 'Services' ); ?></a></li>
                        <li class="menu-item<?php if( is_current_menu_item( get_app_info( 'url' ) . 'portfolio/' ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'url' ); ?>portfolio/" title="<?php echo KernelController::translate( 'Réalisations' ); ?>"><?php echo KernelController::translate( 'Réalisations' ); ?></a></li>
                        <li class="menu-item<?php if( is_current_menu_item( get_app_info( 'url' ) . 'curriculum/' ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'url' ); ?>curriculum/" title="<?php echo KernelController::translate( 'Curriculum vitae' ); ?>"><?php echo KernelController::translate( 'Curriculum vitae' ); ?></a></li>
                        <li class="menu-item<?php if( is_current_menu_item( get_app_info( 'url' ) . 'contact/' ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'url' ); ?>contact/" title="<?php echo KernelController::translate( 'Contact' ); ?>"><?php echo KernelController::translate( 'Contact' ); ?></a></li>
                    </ul>
                </nav>
            </header>

            <aside id="sidebar-left">
                <ul class="widget" id="primary-widget">
                    <li class="widget-item">
                        <div class="search-form">
                            <form action="<?php app_info( 'url' ); ?>" class="form" method="post">
                                <div class="wrapper">
                                    <label class="label" for="search-text"><?php echo _( 'Search keywords' ); ?></label>
                                    <input class="field" id="search-text" name="search" required="required" type="text" value="">
                                </div>

                                <a class="search-button button search light" href="" title="<?php echo _( 'Search' ); ?>"><span class="inner"><?php echo _( 'Search' ); ?></span></a>
                            </form>
                        </div>
                    </li>
                </ul>
            </aside>
        </div>

        <main role="main">