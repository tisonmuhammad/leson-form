<?php
/*
 * Plugin Name: ChaSon Form User Auth
 * Version: 1.2.1
 * Plugin URI: https://www.monoplustudio.com
 * Description: Simply allow users to register into your WordPress site via front-end forms. Completely free of admin panel.
 * Author: Muhammad Tison | Charles Simanjuntak
 * Author URI: https://www.monoplustudio.com
 * License: GPL v3
*/
/* Copyright 2022 Muhammad Tison
    This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
    This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
    You should have received a copy of the GNU General Public License 
*/

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'leson_plugin_settings_link' );
function leson_plugin_settings_link( $links )
{
    $url = 'https://www.monoplustudio.com/donate/?plugin=leson-form';
    $_link = '<a href="'.$url.'" aria-label="Go Donate Now!" title="Go Donate Now!" target="_blank" style="color: #fff;font-weight:700;background: red;border-radius: 5px;padding: 1px 6px;" >' . __( 'Donate Now!', 'domain' ) . '</a>';
    $links[] = $_link;
    return $links;
}

include(plugin_dir_path( __FILE__ ) . '/includes/functions.php');

// include(plugin_dir_path( __FILE__ ) . '/includes/forms/register.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/register2.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/login.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/login2.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/send-reset-link.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/reset-password.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/reset-password2.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/update-profile.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/update-password.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/email-verification.php');

// include(plugin_dir_path( __FILE__ ) . '/includes/http/process-register.php');
include(plugin_dir_path( __FILE__ ) . '/includes/http/process-register2.php');
include(plugin_dir_path( __FILE__ ) . '/includes/http/process-login.php');
include(plugin_dir_path( __FILE__ ) . '/includes/http/process-login2.php');
include(plugin_dir_path( __FILE__ ) . '/includes/http/process-send-reset-link.php');
include(plugin_dir_path( __FILE__ ) . '/includes/http/process-reset-password.php');
include(plugin_dir_path( __FILE__ ) . '/includes/http/process-reset-password2.php');
include(plugin_dir_path( __FILE__ ) . '/includes/http/process-update-profile.php');
include(plugin_dir_path( __FILE__ ) . '/includes/http/process-update-password.php');
include(plugin_dir_path( __FILE__ ) . '/includes/http/process-email-verification.php');

include(plugin_dir_path( __FILE__ ) . '/includes/view/account.php');

include(plugin_dir_path( __FILE__ ) . '/includes/view/bt_dashboard.php');
include(plugin_dir_path( __FILE__ ) . '/includes/view/bt_contact.php');
include(plugin_dir_path( __FILE__ ) . '/includes/view/bt_company.php');
include(plugin_dir_path( __FILE__ ) . '/includes/view/bt_productadd.php');
include(plugin_dir_path( __FILE__ ) . '/includes/view/bt_productlist.php');
include(plugin_dir_path( __FILE__ ) . '/includes/view/bt_productedit.php');
include(plugin_dir_path( __FILE__ ) . '/includes/view/bt_profile.php');
include(plugin_dir_path( __FILE__ ) . '/includes/view/bt_changepassword.php');

// CUSTOME POST
include(plugin_dir_path( __FILE__ ) . '/includes/project.php' );
// include(plugin_dir_path( __FILE__ ) . '/includes/projects.php' );
include(plugin_dir_path( __FILE__ ) . '/includes/localavatar.php' );

include(plugin_dir_path( __FILE__ ) . '/includes/nambah_template.php' );

// add_shortcode('register_form', 'ath_register_form');
add_shortcode('si_daftarmember', 'wpbt_coba_register_form');
add_shortcode('login_form', 'ath_login_form');
add_shortcode('si_login_form', 'wpbt_coba_login_form');
add_shortcode('send_reset_link_form', 'ath_send_reset_link_form');
add_shortcode('password_reset_form', 'ath_password_reset_form');
add_shortcode('si_passwordreset', 'wpbt_coba_password_reset');
add_shortcode('update_profile_form', 'ath_update_profile_form');
add_shortcode('update_password_form', 'ath_update_password_form');
add_shortcode('email_verification_form', 'ath_email_verification_form');
add_shortcode('csf_account', 'ath_csf_account');

add_shortcode('si_dashboard', 'wpbt_coba_dashboard');
add_shortcode('si_contact', 'wpbt_coba_contact');
add_shortcode('si_company', 'wpbt_coba_company');
add_shortcode('si_addproduct', 'wpbt_coba_productadd');
add_shortcode('si_productlist', 'wpbt_coba_productlist');
add_shortcode('si_productedit', 'wpbt_coba_productedit');
add_shortcode('si_profile', 'wpbt_coba_profile');
add_shortcode('si_changepassword', 'wpbt_coba_changepassword');


//Not private submissions - only for users that are not logged in
// add_action('admin_post_nopriv_submit_form_register', 'ath_register_user');
add_action('admin_post_nopriv_submit_form_register2', 'wpbt_coba_register_user');
add_action('admin_post_nopriv_submit_form_login', 'ath_login_user');
add_action('admin_post_nopriv_submit_form_login2', 'wpbt_coba_login_user');
add_action('admin_post_nopriv_submit_form_send_reset_link', 'ath_send_reset_link');
add_action('admin_post_nopriv_submit_form_reset_password', 'ath_reset_password');
add_action('admin_post_nopriv_submit_form_reset_password2', 'wpbt_coba_reset_password');

//Only for logged in users
add_action('admin_post_submit_form_update_profile', 'ath_update_profile');
add_action('admin_post_submit_form_update_password', 'ath_update_password');
add_action('admin_post_submit_form_send_reset_link', 'ath_send_reset_link');
add_action('admin_post_submit_form_reset_password', 'ath_reset_password');
add_action('admin_post_submit_form_reset_password2', 'wpbt_coba_reset_password');
add_action('admin_post_submit_form_email_verification', 'ath_email_verification');


// if ( is_page_template( 'includes/templates/kosongan.php' ) ) {
//     include_once 'includes/templates/kosongan.php';
// }
