<?php

function wpbt_coba_register_form()
{
    ?>

        <?php if( errors_has("register_error_url") ): ?>
            <div class="alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $_SESSION["errors"]["register_error_url"] ?>
            </div>
        <?php endif; ?>

        <section style="background-color: rgba(0,0,0,0.5);background-image: url('https://eria-dewans/wp-content/uploads/2022/08/sean-oulashin-KMn4VEeEPR8-unsplash-300x199.jpg');background-position: center center;background-repeat: no-repeat;background-blend-mode: darken;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;padding: 8rem 10rem;">
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <h1 class="title-heading-left" style="margin:0;color:#ffffff;line-height:30px;"><strong>Welcome,</strong><br><span style="font-size: 25px;">Sign up now</span></h1>
                    </div>
                    <div class="">
                        <p style="text-align: left;color:#ffffff;">Lorem ipsum lorem ipsum Lorem ipsum lorem ipsum Lorem ipsum lorem ipsum</p>
                    </div>
                </div>
                <div class="col-md-6">

                    <form action="<?php echo get_admin_url() ?>admin-post.php" class="form-horizontal" method="post" enctype="multipart/form-data" style="gap: 10px;display: flex;flex-direction: column;">
            
                        <input type="hidden" name="auth_nonce" value="<?php echo wp_create_nonce( get_template_directory_uri( __FILE__ ) ) ?>" />
                        <input type='hidden' name='action' value='submit_form_register' />
            
                        <div class="<?php echo "form-group" . ( errors_has("company_name") ? " has-error" : "" );  ?>">
                            <input type="text" class="form-control form_bt_input" name="company_name" placeholder="Company Name" value="<?php old("username") ?>">
                            <?php if( errors_has("company_name") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["company_name"]; ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="<?php echo "form-group" . ( errors_has("username") ? " has-error" : "" );  ?>">
                            <input type="text" class="form-control form_bt_input" name="username" placeholder="Username" value="<?php old("username") ?>">
                            <?php if( errors_has("username") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["username"]; ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
            
                        <div class="<?php echo "form-group" . ( errors_has("email") ? " has-error" : "" );  ?>">
                            <input type="text" class="form-control form_bt_input" name="email" placeholder="Email" value="<?php old("email") ?>">
                            <?php if( errors_has("email") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["email"]; ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
            
                        <div class="<?php echo "form-group" . ( errors_has("password") ? " has-error" : "" );  ?>">
                            <input type="password" class="form-control form_bt_input" id="password-register" name="password" placeholder="Password">
                            <?php if( errors_has("password") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["password"]; ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
            
                        <div class="<?php echo "form-group" . ( errors_has("password_confirm") ? " has-error" : "" );  ?>">
                            <input type="password" class="form-control form_bt_input" name="password_confirm" placeholder="Confirm Password">
                            <?php if( errors_has("password_confirm") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["password_confirm"]; ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
            
                        <div class="form-group" style="margin-top:16px;">
                            <button type="submit" class="btn_bt register">
                                Sign Up
                            </button>
                            <p class="bt_or" style="">OR</p>
                            <a href="<?php echo network_site_url( '/login-member' ) ?>" class="btn_bt_link">
                                Log In
                            </a>
                        </div>
            
                    </form>

                </div>
            </div>
        </section>
<style>
html.avada-is-100-percent-template #main {
    padding-left: 0 !important;
    padding-right: 0 !important;
}

input[type=text].form_bt_input,
input[type=password].form_bt_input,
input[type=email].form_bt_input,
input[type=text].form_bt_input {
    background: transparent;
    border-top: 0px;
    border-left: 0px;
    border-right: 0px;
    border-radius: 0px;
    color: #fff;
    opacity: 1;
}
input.form_bt_input::-webkit-input-placeholder {
    color: #fff;
}
input.form_bt_input:-internal-autofill-selected {
    background: transparent !important;
}
input.form_bt_input:-webkit-autofill, 
textarea.form_bt_input_textarea:-webkit-autofill, 
select.form_bt_input_select:-webkit-autofill { 
    background-color: transparent !important;
    -webkit-box-shadow: 0 0 0px 0px #ffffff00 inset;
}
.btn_bt {
    width: 100%;
    height: 40px;
    border: 0px;
    border-radius: 5px;
    cursor: pointer;
    background: #fff;
    font-size: 15px;
}
.btn_bt:hover {
    background: #1f3163;
    color: #fff;
}
.btn_bt_link {
    font-size: 15px;
    color: #fff;
    width: 100%;
    line-height: 40px;
    text-align: center;
    display: block;
}
.btn_bt_link:hover {
    background: #66a7db;
    color: #000;
    border-radius: 5px;
}

.bt_or {
    display: block;
    text-align: center;
    margin: 15px 0px !important;
    color: #fff;
    font-size: 14px;
}
.bt_or:before,
.bt_or:after {
  background-color: #fff;
  content: "";
  display: inline-block;
  height: 1px;
  position: relative;
  vertical-align: middle;
  width: 40%;
}
.bt_or:before {
  right: 1em;
  margin-left: -50%;
}
.bt_or:after {
  left: 1em;
  margin-right: -50%;
}
</style>
    <?php
}
?>