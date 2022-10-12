<?php
	function wpbt_coba_login_form()
	{
		?>

			<?php if( errors_has("login_error_url") ): ?>
				<div class="alert alert-danger text-center">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo $_SESSION["errors"]["login_error_url"] ?>
				</div>
			<?php endif; ?>

			<?php if( success_has("success") ): ?>
				<div class="alert alert-success text-center">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo $_SESSION["success"] ?>
				</div>
			<?php endif; ?>

			<section class="sectionatas" style="background-color: rgba(0,0,0,0.5);background-image: url('<?php echo network_site_url( '/wp-content/uploads/2022/08/sean-oulashin-KMn4VEeEPR8-unsplash-300x199.jpg' ) ?>');">
				<div class="row">
					<div class="col-md-6">
						<div class="">
							<h1 class="title-heading-left" style="margin:0;color:#ffffff;line-height:30px;"><strong>Share your story!</strong></h1>
						</div>
						<div class="" style="">
							<p style="text-align: left;color:#ffffff;">Are you a private company operating in one of the ASEAN+3 countries?</p><p style="text-align: left;color:#ffffff;">Welcome!</p><p style="text-align: left;color:#ffffff;">Through this platform, RKC-MPD strives to serve as a catalyst for the promotion of private sector’s efforts in reducing plastic waste and marine plastic debris.</p><p style="text-align: left;color:#ffffff;">If you are a private company working in ASEAN+3 countries and your business activities help combat marine plastic litter, please register yourself and submit a summary of your products/technologies/services by answering a set of questions in English.</p><p style="text-align: left;color:#ffffff;">Thank you.</p>
						</div>
					</div>

					<div class="col-md-6">

						<form action="<?php echo get_admin_url() ?>admin-post.php" class="form-horizontal" method="post">

							<input type="hidden" name="auth_nonce" value="<?php echo wp_create_nonce( get_template_directory_uri( __FILE__ ) ) ?>" />
							<input type='hidden' name='action' value='submit_form_login2' />

							<div class="form-group">
								<input type="text" class="form-control form_bt_input" name="username" placeholder="Username" value="<?php old("username") ?>">
							</div>

							<div class="form-group">
								<input type="password" class="form-control form_bt_input" id="password-login" name="password" placeholder="Password">
							</div>

							<div class="form-group" style="margin-top:16px;">
								<div class="checkbox">
									<label  style="color: #fff;">
										<input type="checkbox" name="remember" value="true"> Remember Me
									</label>
								</div>
							</div>

							<div class="form-group" style="margin-top:16px;">
								<button type="submit" class="btn_bt login">
									Login
								</button>
							</div>

							<div class="" style="width:100%;display:block;margin-top:16px;text-align: center;">
								<a class="btn_bt_links register" href="<?php echo network_site_url( '/register-member' ) ?>">Create New Account</a>
								<span style="color: #fff;margin:0px 10px;opacity: .7;"> or </span>
								<a class="btn_bt_links forgot-password" href="<?php echo network_site_url( '/request-password-reset-link' ) ?>">Forgot Your Password?</a>

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

				.btn_bt_links {
					color: #fff;
				}
				.btn_bt_links:hover {
					color: #66a7db;
					text-decoration: underline;
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
				.sectionatas {
					background-position: center center;
					background-repeat: no-repeat;
					background-blend-mode: darken;
					border-width: 0px 0px 0px 0px;
					border-color: #e2e2e2;
					border-style: solid;
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
					padding: 8rem 10rem;
				}
				@media only screen and (max-width: 800px) {
					.sectionatas {
						padding: 8rem 20px;
					}
				}
			</style>

		<?php
	}
?>
