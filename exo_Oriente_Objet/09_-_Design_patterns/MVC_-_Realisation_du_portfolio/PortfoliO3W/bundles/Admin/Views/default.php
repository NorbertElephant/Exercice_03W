<article role="article" style="white-space: nowrap;">
    <header>
        <hgroup>
            <h1 id="h1"><i class="fa fa-lock" aria-hidden="true"></i> <?php echo _( 'Login form' ); ?></h1>
            <hr class="hr">
        </hgroup>
    </header>

    <div class="flex-wrapper horizontal">
        <div class="x3">
            <?php display_errors(); ?>

            <form action="<?php app_info( 'url' ); ?>users/login/" class="form" method="post">
                <div class="wrapper">
                    <label class="label required" for="txt-login"><?php echo _( 'Login or e-mail address' ); ?></label>
                    <input class="field" id="txt-login" name="login" required="required" type="text">
                </div>
                <div class="wrapper">
                    <label class="label required" for="txt-password"><?php echo _( 'Password' ); ?></label>
                    <input class="field" id="txt-password" name="password" required="required" type="password">
                </div>

                <button class="button login dark" type="submit"><span class="inner"><?php echo _( 'Log in' ); ?></span></button>
            </form>
        </div>
        <div class="x1"></div>
        <div class="x2">
            <p><?php echo _( 'This is a demo application built in a personnal Framework to illustrate the recommended way of developing advanced applications with MVC design pattern' ); ?></p>
            <p><b><i class="fa fa-long-arrow-left" aria-hidden="true"></i> <?php echo _( 'Try either of the following users' ); ?></b></p>
            <table border="1" cellpadding="10" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><?php echo _( 'Username' ); ?></th>
                        <th><?php echo _( 'Password' ); ?></th>
                        <th><?php echo _( 'Role' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>d.tivelet@objectif3w.com</td>
                        <td>admin</td>
                        <td><?php echo _( 'Super administrator' ); ?></td>
                    </tr>
                    <tr>
                        <td>testman@testenv.tld</td>
                        <td>0000</td>
                        <td><?php echo _( 'Subscriber' ); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</article>