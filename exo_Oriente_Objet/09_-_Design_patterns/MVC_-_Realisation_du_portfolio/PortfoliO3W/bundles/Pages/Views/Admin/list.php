<article role="article" style="white-space: nowrap;">
    <header>
        <hgroup>
            <h1 id="h1"><?php echo _( 'Pages list' ); ?></h1>
            <hr class="hr">
            <?php if( $me->can( 'edit_pages' ) ) : ?><a class="link add dark left" href="<?php app_info( 'url' ); ?>pages/add/" title="<?php echo _( 'Add new page' ); ?>"><span class="inner"><?php echo _( 'Add new page' ); ?></span></a><?php endif; ?>
        </hgroup>
    </header>

    <?php 
    echo $list; ?>
</article>