<article role="article" style="white-space: nowrap;">
    <header>
        <hgroup>
            <h1 id="h1"><?php echo _( 'Add new post' ); ?></h1>
            <hr class="hr">
        </hgroup>
    </header>
    <?php display_errors(); ?>

<form action="<?php app_info( 'url' ); ?>posts/adding/" class="form" enctype="multipart/form-data" method="post">
    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'title' ); ?></legend>

        <div class="wrapper">
            <label class="label" for="txt-title"><?php echo _( 'title' ); ?></label>
            <input class="field" id="txt-title" name="title" type="text"  >
        </div>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'Content' ); ?></legend>

        <div class="wrapper">
            <label class="label " for="txt-content"><?php echo _( 'Content' ); ?></label>
            <input class="field" id="txt-Content" name="content" style="text-transform:lowercase;" type="textarea">
        </div>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'excerpt' ); ?></legend>

        <div class="wrapper">
            <label class="label " for="txt-excerpt"><?php echo _( 'excerpt' ); ?></label>
            <input class="field" id="txt-excerpt" name="excerpt" style="text-transform:lowercase;" type="textarea">
        </div>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'type' ); ?></legend>
        <div class="wrapper">
        <input type="text" name='type'  value="post" readonly >
        </div>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="legend"><?php echo _( 'status' ); ?></legend>
        <div class="wrapper">
            <select name="status" id="status">
                <?php
                foreach ($terms as $key => $value) {
                   echo '<option value="'.$value['keyword'].'" > '.$value['keyword'].' </option>';
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
                   echo '<option value="'.$value['keyword'].'" > '.$value['keyword'].' </option>';
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
                   echo '<option value="'.$value['keyword'].'" > '.$value['keyword'].' </option>';
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
                   echo '<option value="'.$value->getId().'" > '.$value->getTitle().' </option>';
                } ?>
            </select>
        </div>
    </fieldset>
    <div style="text-align:right;">
        <button class="button add dark" type="submit"><span class="inner"><?php echo _( 'Add post' ); ?></span></button>
    </div>
</form>
</article>