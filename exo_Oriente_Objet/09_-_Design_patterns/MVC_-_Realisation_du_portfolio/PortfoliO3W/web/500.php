<?php
header( $_SERVER['SERVER_PROTOCOL'] . ' 500 Internal server error' );
require_once( '..\app\config\ini.php' );
require_once( APPPATH . 'autoloader.php' );

$sitename = _( 'Error' ) . ' 500';
include_once( WEBPATH . 'header.php' );
?>

<article role="article">
    <header>
        <hgroup>
            <h1><?php echo _( 'Error' ); ?> 500</h1>
            <hr>
            <h2><?php echo _( 'Internal server error' ); ?></h2>
        </hgroup>
    </header>

    <div class="content">
        <img alt="" src="<?php app_info( 'assets_directory' ); ?>images/errors/500.png" style="float:left;margin:0 25px 25px 0;margin:0 2.5rem 2.5rem 0;max-width:150px;max-width:15rem;">
        <h3><?php echo _( 'Sorry, it\'s not you. It\'s us !' ); ?></h3>
        <p><?php echo _( 'Something went wrong' ); ?></p>
        <p><small><?php printf( _( 'We are experiencing an internal server problem.<br>Please try again later or <a href="mailto:%s">contact technical support</a>.' ), get_app_info( 'support_email' ) ); ?></small></p>
    </div>

    <footer>
        <a class="back" href="<?php app_info( 'home' ); ?>" title=""><?php echo _( 'Back to homepage' ); ?></a></li>
    </footer>
</article>

<?php
include_once( WEBPATH . 'footer.php' );