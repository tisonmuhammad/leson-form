<?php

function ath_update_password_form()
{
    ?>

    <?php
        //We have a function that checks it for us already, but just incase we will check again.
        if( !is_user_logged_in() )
        {
            exit;
        }

        $current_user = wp_get_current_user();
    ?>

    <header class="sui-header">
        <h1 class="sui-header-title">
            <?php echo get_the_title(); ?>
        </h1>
    </header>

    <article class="sui-box">
        <div class="sui-box-body">
            <div id="update-password" class="ath-card-auth">

                <?php if( errors_has("update_password_url") ): ?>
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $_SESSION["errors"]["update_password_url"] ?>
                    </div>
                <?php endif; ?>

                <div class="ath-card-content">

                    
                    <form action="<?php echo get_admin_url() ?>admin-post.php" class="form-horizontal" method="post">

                        <input type="hidden" name="auth_nonce" value="<?php echo wp_create_nonce( get_template_directory_uri( __FILE__ ) ) ?>" />
                        <input type='hidden' name='action' value='submit_form_update_password' />

                        <div class="<?php echo "sui-form-field" . ( errors_has("current_password") ? " sui-form-field-error" : "" );  ?>">

                            <label class="sui-label" for="current_password" id="label-current_password">Current Password</label>

                            <div class="sui-with-button sui-with-button-icon">
                                <input type="password" class="sui-form-control" name="current_password" placeholder="Current Password" aria-labelledby="label-current_password" aria-describedby="error-current_password description-current_password">
                                
                                <button class="sui-button-icon" type="button">
                                    <span aria-hidden="true" class="sui-icon-eye"></span>
                                    <span class="sui-password-text sui-screen-reader-text">Show Password</span>
                                    <span class="sui-password-text sui-screen-reader-text sui-hidden">Hide Password</span>
                                </button>
                            </div>

                            <!-- <span id="description-current_password" class="sui-description">Enter description here.</span> -->

                            <?php if( errors_has("current_password") ): ?>
                                <span id="error-current_password" class="sui-error-message">
                                    <strong><?php echo $_SESSION["errors"]["current_password"]; ?></strong>
                                </span>
                                <!-- <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["current_password"]; ?></strong>
                                </span> -->
                            <?php endif; ?>

                        </div>

                        <div class="<?php echo "sui-form-field" . ( errors_has("new_password") ? " sui-form-field-error" : "" );  ?>">
                            
                            <label class="sui-label" for="new_password" id="label-new_password">Current Password</label>
                            
                            <div class="sui-with-button sui-with-button-icon">
                                <input type="password" class="sui-form-control" name="new_password" placeholder="New Password" aria-labelledby="label-new_password" aria-describedby="error-new_password description-new_password">

                                <button class="sui-button-icon" type="button">
                                    <span aria-hidden="true" class="sui-icon-eye"></span>
                                    <span class="sui-password-text sui-screen-reader-text">Show Password</span>
                                    <span class="sui-password-text sui-screen-reader-text sui-hidden">Hide Password</span>
                                </button>
                            </div>

                            <?php if( errors_has("new_password") ): ?>
                                <span id="error-new_password" class="sui-error-message">
                                    <strong><?php echo $_SESSION["errors"]["new_password"]; ?></strong>
                                </span>
                                <!-- <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["new_password"]; ?></strong>
                                </span> -->
                            <?php endif; ?>
                        </div>

                        <div class="<?php echo "sui-form-field" . ( errors_has("password_confirm") ? " sui-form-field-error" : "" );  ?>">
                            
                            <label class="sui-label" for="password_confirm" id="label-password_confirm">Current Password</label>

                            <div class="sui-with-button sui-with-button-icon">
                                <input type="password" class="sui-form-control" name="password_confirm"  placeholder="Confirm New Password" aria-labelledby="label-password_confirm" aria-describedby="error-password_confirm description-password_confirm">

                                <button class="sui-button-icon" type="button">
                                    <span aria-hidden="true" class="sui-icon-eye"></span>
                                    <span class="sui-password-text sui-screen-reader-text">Show Password</span>
                                    <span class="sui-password-text sui-screen-reader-text sui-hidden">Hide Password</span>
                                </button>
                            </div>

                            <?php if( errors_has("password_confirm") ): ?>
                                <span id="error-password_confirm" class="sui-error-message">
                                    <strong><?php echo $_SESSION["errors"]["password_confirm"]; ?></strong>
                                </span>
                                <!-- <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["password_confirm"]; ?></strong>
                                </span> -->
                            <?php endif; ?>
                        </div>

                        <div class="sui-form-field">
                            <button type="submit" class="sui-button sui-button-lg update-password">
                                <i class="fa fa-btn fa-shield"></i> Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </article>

    <?php

}


?>