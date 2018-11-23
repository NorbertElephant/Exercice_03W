<article role="article" style="white-space: nowrap;">
    <header>
        <hgroup>
            <h1 id="h1"><?php echo _( 'Categories list' ); ?></h1>
            <hr class="hr">
            <?php if( $me->can( 'edit_posts' ) ) : ?><a class="link add dark left" href="<?php app_info( 'url' ); ?>posts/addCategory/" title="<?php echo _( 'Add new category' ); ?>"><span class="inner"><?php echo _( 'Add new category' ); ?></span></a><?php endif; ?>
        </hgroup>
    </header>

    <?php echo $list; ?>
</article>