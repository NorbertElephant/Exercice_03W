<article role="article" style="white-space: nowrap;">
    <header>
        <hgroup>
            <h1 id="h1"><?php echo _( 'Users list' ); ?></h1>
            <hr class="hr">
            <?php if( $me->can( 'create_users' ) ) : ?><a class="link add dark left" href="<?php app_info( 'url' ); ?>users/add/" title="<?php echo _( 'Add new user' ); ?>"><span class="inner"><?php echo _( 'Add new user' ); ?></span></a><?php endif; ?>
        </hgroup>
    </header>

    <?php echo $list; ?>
</article>