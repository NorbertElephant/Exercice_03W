<?php
header( $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found' );
require_once( '..\app\config\ini.php' );
require_once( APPPATH . 'autoloader.php' );

$sitename = _( 'Error' ) . ' 404';
include_once( WEBPATH . 'header.php' );
?>

<article role="article">
    <header>
        <hgroup>
            <h1><?php echo _( 'Error' ); ?> 404</h1>
            <hr>
            <h2><?php echo _( 'Page not found' ); ?></h2>
        </hgroup>
    </header>

    <div class="content">
        <img alt="" src="<?php app_info( 'assets_directory' ); ?>images/errors/404.png" style="float:left;margin:0 25px 25px 0;margin:0 2.5rem 2.5rem 0;max-width:150px;max-width:15rem;">
        <h3><?php echo _( 'You are lost !' ); ?></h3>
        <p><?php echo _( 'They can\'t all be winners ... try again.' ); ?></p>
        <p><small><?php printf( _( 'The requested URL could not be found on this server.<br>If you entered the URL manually, please check it and try again.<br>If you think this is a server error, please <a href="mailto:%s">contact technical support</a>.' ), SUPPORT_EMAIL ); ?></small></p>
    </div>

    <footer>
        <a class="back" href="<?php app_info( 'home' ); ?>" title=""><?php echo _( 'Back to homepage' ); ?></a></li>
    </footer>
</article>

<?php
include_once( WEBPATH . 'footer.php' );