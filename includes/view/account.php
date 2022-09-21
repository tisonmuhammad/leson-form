<?php

function ath_csf_account()
{
    ?>

<div id="wfp-postbox" class="wfp-postbox">
	<form action="<?php echo admin_url( 'admin-post.php' ); ?>" id="new_post" name="new_post" class="new-post" method="post">
		<input type="hidden" name="action" value="wfp_post_save" />
		<div class="wfp-form-container">
			<div class="wfp-left-content grid-item">
				<div>
					<label for="title"><?php _e('Title','wp-frontend-posts'); ?><span>*</span></label>
					<input type="text" id="title" value="" tabindex="1" size="20" name="title" required />
				</div>
				<div>
					<label for="content"><?php _e('Content','wp-frontend-posts'); ?></label>
					<?php
						$content = '';
						if (isset($_POST['submit'])) {
							$content = $_POST['content'];
						}
						$editor_settings = array(
							'textarea_name' => 'content',
							'textarea_rows' => 12,
							'media_buttons' => true
							
						);
						wp_editor($content, 'user-editor', $settings = $editor_settings);
					?>
				</div>
			</div>
			<div class="wfp-right-content grid-item">
				<div>
					<label for="category"><?php _e('Category','wp-frontend-posts'); ?></label>
					<div class="cat-list">
						<?php
							$terms = get_terms([
								'taxonomy' => 'category',
								'hide_empty' => false,
							]);
						?>
						<select id="wfp-category" class="postform" name="post_category[]">
							<option value="" selected disabled></option>
						<?php
							foreach($terms as $cat) {
								echo '<option value="'.$cat->term_id.'">'.$cat->name.'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div>
					<label for="post_tags"><?php _e('Tags','wp-frontend-posts'); ?></label>
					<input type="text" value="" name="post_tags" id="post_tags" />
				</div>
				<div id="wfp-featured-image">
					<div id="wfp-featured-image-container"  class="featured-image-container wfp-image-preview">
						<img width="280" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/placeholder.png'; ?>" class="feature-image" alt="image">
					</div>
					<label class="custom-file-upload">
						<input id="wfp-feature-image" type="file"/>
						<input name="wfp_feature_image" type="hidden" id="wfp-feature-image-id" value=""/>
						<i class="fas fa-cloud-upload-alt"></i> <?php _e('Set Featured Image','wp-frontend-posts'); ?>
					</label>
				</div>
			</div>
			<?php wp_nonce_field( 'wfp-frontend-post' ); ?>
			<p>
				<input type="submit" value="Publish" tabindex="6" id="submit" name="submit" />
			</p>
		</div>
	</form>
</div>
        <div class="wpuf-dashboard-container">
            <nav class="wpuf-dashboard-navigation">
                <ul>
                    <li>Dashboard</li>
                    <li>Post</li>
                    <li>Add Post</li>
                    <li>Edit Profile</li>
                    <?php
                        if ( is_user_logged_in() ) {
                            foreach ( $sections as $section => $label ) {
                                // backward compatibility
                                if ( is_array( $label ) ) {
                                    $section = $label['slug'];
                                    $label   = $label['label'];
                                }

                                if ( 'subscription' == $section ) {
                                    if ( 'off' == wpuf_get_option( 'show_subscriptions', 'wpuf_my_account', 'on' ) || 'on' != wpuf_get_option( 'enable_payment', 'wpuf_payment', 'on' ) ) {
                                        continue;
                                    }
                                }

                                if ( 'billing-address' == $section ) {
                                    if ( 'off' == wpuf_get_option( 'show_billing_address', 'wpuf_my_account', 'on' ) || 'on' != wpuf_get_option( 'enable_payment', 'wpuf_payment', 'on' ) ) {
                                        continue;
                                    }
                                }

                                $default_active_tab = wpuf_get_option( 'account_page_active_tab', 'wpuf_my_account', 'dashboard' );
                                $active_tab         = false;

                                if ( ( isset( $_GET['section'] ) && $_GET['section'] == $section ) || ( !isset( $_GET['section'] ) && $default_active_tab == $section ) ) {
                                    $active_tab = true;
                                }

                                $active = $active_tab ? $section . ' active' : $section;
                                echo sprintf(
                                    '<li class="wpuf-menu-item %s"><a href="%s">%s</a></li>',
                                    esc_attr( $active ),
                                    esc_attr( add_query_arg( [ 'section' => $section ], get_permalink() ) ),
                                    esc_attr( $label )
                                );
                            }
                        }
                    ?>
                </ul>
            </nav>
            <div class="wpuf-dashboard-content row <?php echo ( !empty( $current_section ) ) ? esc_attr( $current_section ) : ''; ?>">
                <?php
                    if ( !empty( $current_section ) && is_user_logged_in() ) {
                        do_action( "wpuf_account_content_{$current_section}", $sections, $current_section );
                    }
                ?>

                <div class="col-md-12">
                    <h2>Add Post</h2>
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0">Product, Service, or Technology</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-600">Name<span class="text-danger"> *</span></label>
                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Please provide a specific name of product, service, and/or technology offered by the company, which are relevant to mitigate marine plastic debris issues">
                                            <img src="https://solutions.rkcmpd-eria.org/assets/icon/info.png" width="15">
                                        </a>
                                        <input type="text" class="form-control required" name="txtProductName" required="" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-600">Title<span class="text-danger"> *</span></label>
                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Please provide a specific name of product, service, and/or technology offered by the company, which are relevant to mitigate marine plastic debris issues">
                                            <img src="https://solutions.rkcmpd-eria.org/assets/icon/info.png" width="15">
                                        </a>
                                        <input type="text" class="form-control required" name="txtProductName" required="" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-600">Solution Types<span class="text-danger"> *</span></label>
                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Please provide a specific name of product, service, and/or technology offered by the company, which are relevant to mitigate marine plastic debris issues">
                                            <img src="https://solutions.rkcmpd-eria.org/assets/icon/info.png" width="15">
                                        </a>
                                        <input type="text" class="form-control required" name="txtProductName" required="" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<style>
.mb-4, .my-4 {
    margin-bottom: 1.5rem !important;
}
.mb-0, .my-0 {
    margin-bottom: 0 !important;
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
    box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
}
.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0, 0, 0, 0.03);
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}
.card-header:first-child {
    border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}

.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.row {
    margin-right: -10px;
    margin-left: -10px;
}
.row [class*=col-] {
    padding-right: 10px;
    padding-left: 10px;
}

.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col, .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm, .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md, .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg, .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl, .col-xl-auto {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}
@media (min-width: 768px) {
    .col-md-12 {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
}

.form-group {
    margin-bottom: 1rem;
}
label {
    display: inline-block;
    margin-bottom: 0.5rem;
}
.font-weight-600 {
    font-weight: 600!important;
}
.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.d-flex {
    display: -ms-flexbox!important;
    display: flex!important;
}
.justify-content-between {
    -ms-flex-pack: justify!important;
    justify-content: space-between!important;
}
.align-items-center {
    -ms-flex-align: center!important;
    align-items: center!important;
}
.fs-17 {
    font-size: 17px!important;
}
</style>
    <?php
}