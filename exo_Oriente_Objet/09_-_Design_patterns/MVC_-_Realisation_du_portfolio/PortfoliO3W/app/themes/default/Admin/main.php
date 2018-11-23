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
            @import url('<?php app_info( 'admin_stylesheet_url' ); ?>');
            -->
        </style>
    </head>
    <body class="admin">
        <div id="column-left">
            <header role="banner">
                <a id="primary-logo" href="<?php app_info( 'home' ); ?>" title="<?php app_info( 'app_name' ); ?>"><img alt="<?php app_info( 'app_name' ); ?>" class="logo svg" data-svg="<?php app_info( 'assets_directory' ); ?>images/logo_objectif3w_vertical.svg" src="<?php app_info( 'assets_directory' ); ?>images/logo_objectif3w_vertical.png"><!-- <span id="site-title"><?php app_info( 'app_name' ); ?></span> --></a>
                <nav id="primary-nav">
                    <ul class="menus" id="primary-menu">
                        <li class="menu-item<?php if( is_current_menu_item( get_app_info( 'home' ) ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'home' ); ?>" title="<?php echo _( 'Back to main site' ); ?>"><?php echo _( 'Back to main site' ); ?></a></li>
                        <?php if( class_exists( 'AdminController' ) && $me->can( 'edit_dashboard' ) ) : ?><li class="menu-item<?php if( is_current_menu_item( get_app_info( 'url' ) . 'admin/dashboard/' ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'url' ); ?>admin/dashboard/" title="<?php echo _( 'Dashboard' ); ?>"><?php echo _( 'Dashboard' ); ?></a></li><?php endif; ?>
                        <?php if( class_exists( 'UsersController' ) && $me->can( 'list_users' ) ) : ?><li class="menu-item<?php if( is_current_menu_item( get_app_info( 'url' ) . 'users/' ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'url' ); ?>users/" title="<?php echo _( 'Users' ); ?>"><?php echo _( 'Users' ); ?></a></li><?php endif; ?>
                        <?php if( class_exists( 'PagesController' ) && $me->can( 'edit_pages' ) ) : ?><li class="menu-item<?php if( is_current_menu_item( get_app_info( 'url' ) . 'pages/list/' ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'url' ); ?>pages/list/" title="<?php echo _( 'Pages' ); ?>"><?php echo _( 'Pages' ); ?></a></li><?php endif; ?>
                        <?php if( class_exists( 'PostsController' ) && $me->can( 'edit_posts' ) ) : ?><li class="menu-item<?php if( is_current_menu_item( get_app_info( 'url' ) . 'posts/list/' ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'url' ); ?>posts/list/" title="<?php echo _( 'Portfolio' ); ?>"><?php echo _( 'Portfolio' ); ?></a></li><?php endif; ?>
                        <?php if( class_exists( 'ServicesController' ) && $me->can( 'edit_pages' ) ) : ?><li class="menu-item<?php if( is_current_menu_item( get_app_info( 'url' ) . 'services/list/' ) ) echo ' current-menu-item'; ?>"><a href="<?php app_info( 'url' ); ?>services/list/" title="<?php echo _( 'Services' ); ?>"><?php echo _( 'Services' ); ?></a></li><?php endif; ?>
                    </ul>
                </nav>

                <?php
                if( class_exists( 'UsersController' ) ) : ?>
                <div id="mod_auth">
                    <a class="mod_auth-link" href="<?php app_info( 'url' ); ?>users/profile/" title=""><?php if( !empty( $me->getAvatar() ) ) : $me->avatar( 'display' ); else : ?><i class="fa fa-user-circle fa-2x" aria-hidden="true"></i><?php endif; ?></a>
                    <div class="mod_auth-block">
                        <p><?php echo _( 'Welcome' ) . ' ' . ( !empty( $me->getFirstname() ) ? $me->getFirstname() : ( !empty( $me->getLogin() ) ? $me->getLogin() : $me->getEmail() ) ); ?></p>
                        <a class="link profile dark" href="<?php app_info( 'url' ); ?>users/profile/"><span class="inner"><?php echo _( 'Edit my profile' ); ?></span></a>
                        <a class="link logout dark" href="<?php app_info( 'url' ); ?>admin/logout/"><span class="inner"><?php echo _( 'Log out' ); ?></span></a>
                    </div>
                </div>
                <?php endif; ?>
            </header>
        </div>

        <div id="column-right">
            <main role="main">
                <?php echo $html; ?>
            </main>

            <footer role="contentinfo">
                <p><small>&copy;<?php echo date( 'Y' ) . ( defined( 'AUTHOR_NAME' ) ? ' ' . AUTHOR_NAME : '' ) . ' - ' . mb_strtolower( _( 'All rights reserved' ) ); ?></small></p>
            </footer>
        </div>

        <script type="text/javascript">
            /*<![CDATA[*/
            window.addEventListener( 'load', function ( e ) {
                for( var svg of document.querySelectorAll( 'img.svg' ) ) {
                    if( svg.getAttribute( 'data-svg' )!='' && svg.getAttribute( 'data-svg' )!==null )
                        svg.src = svg.getAttribute( 'data-svg' );
                }

                for( var input of document.querySelectorAll( '.form .field' ) ) {
                    if( input.value=='' )
                        input.style.backgroundColor = 'transparent';

                    input.addEventListener( 'keyup', function ( e ) {
                        if( e.target.value=='' )
                            e.target.style.backgroundColor = 'transparent';
                        else
                            e.target.style.backgroundColor = '#F1F1F1';
                    } );
                }
            } );
            /*]]>*/
        </script>
    </body>
</html>