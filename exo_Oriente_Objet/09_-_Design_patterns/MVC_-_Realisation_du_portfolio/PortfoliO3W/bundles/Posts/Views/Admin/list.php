<article role="article" style="white-space: nowrap;">
    <header>
        <hgroup>
            <h1 id="h1"><?php echo _( 'Posts list' ); ?></h1>
            <hr class="hr">
            <?php if( $me->can( 'manage_categories' ) ) : ?><a class="link list dark left" href="<?php app_info( 'url' ); ?>posts/manage-categories/" title="<?php echo _( 'Manage categories' ); ?>"><span class="inner"><?php echo _( 'Manage categories' ); ?></span></a><?php endif; ?>
            <?php if( $me->can( 'edit_posts' ) ) : ?><a class="link add dark left" href="<?php app_info( 'url' ); ?>posts/add/" title="<?php echo _( 'Add new post' ); ?>"><span class="inner"><?php echo _( 'Add new post' ); ?></span></a><?php endif; ?>
        </hgroup>
    </header>

    <?php echo $list; ?>
</article>