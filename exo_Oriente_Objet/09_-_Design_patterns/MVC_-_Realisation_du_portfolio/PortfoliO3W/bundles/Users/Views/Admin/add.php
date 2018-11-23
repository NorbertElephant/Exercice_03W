<article role="article" style="white-space: nowrap;">
    <header>
        <hgroup>
            <h1 id="h1"><?php echo _( 'Add new user' ); ?></h1>
            <hr class="hr">
        </hgroup>
    </header>

    <?php display_errors(); ?>

    <form action="<?php app_info( 'url' ); ?>users/adding/" class="form" enctype="multipart/form-data" method="post">
        <fieldset class="fieldset">
            <legend class="legend"><?php echo _( 'Name' ); ?></legend>

            <div class="wrapper">
                <label class="label" for="txt-login"><?php echo _( 'Username' ); ?></label>
                <input class="field" id="txt-login" name="login" type="text">
            </div>
            <div class="wrapper">
                <label class="label required" for="txt-firstname"><?php echo _( 'First name' ); ?></label>
                <input class="field" id="txt-firstname" name="firstname" required="required" style="text-transform:capitalize;" type="text">
            </div>
            <div class="wrapper">
                <label class="label required" for="txt-lastname"><?php echo _( 'Last name' ); ?></label>
                <input class="field" id="txt-lastname" name="lastname" required="required" style="text-transform:uppercase;" type="text">
            </div>
        </fieldset>

        <fieldset class="fieldset">
            <legend class="legend"><?php echo _( 'Contact info' ); ?></legend>

            <div class="wrapper">
                <label class="label required" for="txt-email"><?php echo _( 'E-mail address' ); ?></label>
                <input class="field" id="txt-email" name="email" required="required" style="text-transform:lowercase;" type="email">
            </div>
        </fieldset>

        <fieldset class="fieldset">
            <legend class="legend"><?php echo _( 'Manage options' ); ?></legend>

            <div class="wrapper">
                <?php echo $roles; ?>
            </div>
            <div class="wrapper">
                <label class="label required" for="txt-password"><?php echo _( 'Password' ); ?></label>
                <input class="field" id="txt-password" name="password" required="required" type="password">
            </div>
            <div class="wrapper">
                <label class="label required" for="txt-passwordconfirm"><?php echo _( 'Repeat password' ); ?></label>
                <input class="field" id="txt-passwordconfirm" name="passwordconfirm" required="required" type="password">
            </div>
        </fieldset>

        <?php if( $me->can( 'upload_files' ) ) : ?>
        <fieldset class="fieldset">
            <legend class="legend"><?php echo _( 'Avatar' ); ?></legend>

            <div class="wrapper">
                <label class="label" for="txt-avatar"><?php echo _( 'Image' ); ?></label>
                <input class="field" id="txt-avatar" name="avatar" type="file">
            </div>
        </fieldset>
        <?php endif; ?>

        <div style="text-align:right;">
            <button class="button add dark" type="submit"><span class="inner"><?php echo _( 'Add user' ); ?></span></button>
        </div>
    </form>
</article>