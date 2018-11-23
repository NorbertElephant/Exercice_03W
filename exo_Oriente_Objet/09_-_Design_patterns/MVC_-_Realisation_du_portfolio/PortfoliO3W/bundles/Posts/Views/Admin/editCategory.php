<article role="article" style="white-space: nowrap;">
    <header>
        <hgroup>
            <h1 id="h1"><?php echo _( 'Edit category' ); ?></h1>
            <hr class="hr">
            <?php if( $me->can( 'edit_posts' ) ) : ?><a class="link add dark left" href="<?php app_info( 'url' ); ?>posts/add/" title="<?php echo _( 'Add new post' ); ?>"><span class="inner"><?php echo _( 'Add new post' ); ?></span></a><?php endif; ?>
        </hgroup>
    </header>
    <?php display_errors(); ?>

<form action="<?php app_info( 'url' ); ?>posts/updatingCategory/<?php echo $posts->getId(); ?>/" class="form" enctype="multipart/form-data" method="post">
    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'title' ); ?></legend>

        <div class="wrapper">
            <label class="label" for="txt-title"><?php echo _( 'title' ); ?></label>
            <input class="field" id="txt-title" name="title" type="text" value="<?php echo $posts->getTitle() ; ?> ">
        </div>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'Content' ); ?></legend>

        <div class="wrapper">
            <label class="label " for="txt-content"><?php echo _( 'Content' ); ?></label>
            <input class="field" id="txt-Content" name="content" style="text-transform:lowercase;" type="textarea" value="<?php echo $posts->getContent() ; ?>">
        </div>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'excerpt' ); ?></legend>

        <div class="wrapper">
            <label class="label " for="txt-excerpt"><?php echo _( 'excerpt' ); ?></label>
            <input class="field" id="txt-excerpt" name="excerpt" style="text-transform:lowercase;" type="textarea" value="<?php echo $posts->getExcerpt() ; ?> ">
        </div>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'type' ); ?></legend>
        <div class="wrapper">
        <input type="text" name='type'  value="category" readonly >
        </div>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'status' ); ?></legend>
        <div class="wrapper">
            <select name="status" id="status">
                <?php
                foreach ($terms as $key => $value) {
                    if ($value['keyword'] == $posts->getStatus()) {
                        echo '<option value="'.$value['keyword'].'" selected="selected" > '.$value['keyword'].' </option>';
                    } else {
                   echo '<option value="'.$value['keyword'].'" > '.$value['keyword'].' </option>';
                    }
                } ?>
            </select>
        </div>
    </fieldset>
    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'access' ); ?></legend>
        <div class="wrapper">
            <select name="access" id="access">
            <?php
                foreach ($access as $key => $value) {
                    if ($value['keyword'] == $posts->getAccess()) {
                        echo '<option value="'.$value['keyword'].'" selected="selected" > '.$value['keyword'].' </option>';
                    } else {
                   echo '<option value="'.$value['keyword'].'" > '.$value['keyword'].' </option>';
                    }
                } ?>
            </select>
        </div>
    </fieldset>
    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'format' ); ?></legend>
        <div class="wrapper">
        <select name="format" id="format">
        <?php
                foreach ($formats as $key => $value) {
                    if ($value['keyword'] == $posts->getFormat()) {
                        echo '<option value="'.$value['keyword'].'" selected="selected" > '.$value['keyword'].' </option>';
                    } else {
                   echo '<option value="'.$value['keyword'].'" > '.$value['keyword'].' </option>';
                    }
                } ?>
        </select>
        </div>
    </fieldset>
    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'parent' ); ?></legend>
        <div class="wrapper">
            <select name="parent" id="parent">
             
               <option value="1" > Pas de Parents </option>'
             
                <?php foreach ( $parents as $value) {
                    if ($value->getId() == $posts->getParent()) {
                        echo '<option value="'.$value->getId().'" selected ="selected"> '.$value->getTitle().' </option>';
                     }else { 
                   echo '<option value="'.$value->getId().'" > '.$value->getTitle().' </option>';
                     }
                } ?>
            </select>
        </div>
    </fieldset>
    <div style="text-align:right;">
        <button class="button add dark" type="submit"><span class="inner"><?php echo _( 'Modify category' ); ?></span></button>
    </div>
</form>
</article>


<?php 

