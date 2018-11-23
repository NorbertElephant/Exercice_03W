<?php
header( $_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden' );
require_once( '..\app\config\ini.php' );
require_once( APPPATH . 'autoloader.php' );

$sitename = _( 'Error' ) . ' 403';
include_once( WEBPATH . 'header.php' );
?>

<article role="article">
    <header>
        <hgroup>
            <h1><?php echo _( 'Error' ); ?> 403</h1>
            <hr>
            <h2><?php echo _( 'Access denied/forbidden' ); ?></h2>
        </hgroup>
    </header>

    <div class="content">
        <img alt="" src="<?php app_info( 'assets_directory' ); ?>images/errors/403.png" style="float:left;margin:0 25px 25px 0;margin:0 2.5rem 2.5rem 0;max-width:150px;max-width:15rem;">
        <h3><?php echo _( 'You shall not pass !' ); ?></h3>
        <p><?php echo _( 'We\'re sorry, you don\'t have access to the page you requested.' ); ?></p>
        <p><small><?php echo _( 'To view this page, you may have to sign in with a different account.' ); ?></small></p>
    </div>

    <footer>
        <a class="back" href="<?php app_info( 'home' ); ?>" title=""><?php echo _( 'Back to homepage' ); ?></a></li>
    </footer>
</article>

<?php
include_once( WEBPATH . 'footer.php' );