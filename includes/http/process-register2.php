<!-- HTTP PROSES REGISTER2 -->

<?php

function wpbt_coba_register_user()
{
       //For redirect purposes
    $register_url = network_site_url( '/register-member' );
    $homepage     = network_site_url( '/dashboard-members' );

    $auth_nonce = $_POST['auth_nonce'];
    validate_nonce( $auth_nonce, $homepage );

    $company_name     = sanitize_text_field( trim( $_POST['company_name'] ) );
	$company_country  = sanitize_text_field( trim( $_POST['company_country'] ) );
    $username         = sanitize_text_field( trim( $_POST['username'] ) );
    $email            = sanitize_text_field( trim( $_POST['email'] ) );
    $password         = sanitize_text_field( trim( $_POST['password'] ) );
    $password_confirm = sanitize_text_field( trim( $_POST['password_confirm'] ) );

    $errors = validate_registration( $username, $email, $password, $password_confirm );
	
    if( count( $errors ) > 0 )
    {
        //If there are errors we will set some session values
        //so we can show the user what went wrong and also keep his old values filled in the form
        $_SESSION["errors"]   = $errors;
//         $_SESSION["company_name"] = $company_name;
        $_SESSION["username"] = $username;
        $_SESSION["email"]    = $email;
        wp_safe_redirect( $register_url );
        exit;
    }

    $user_data = array(
//         'company_name' =>  $company_name,
        'user_login' =>  $username,
        'user_email' =>  $email,
        'user_pass'  =>  $password
    );
    $user_id = wp_insert_user( $user_data );
// 	sementara
	update_user_meta( $user_id, 'company_name', $company_name );
	update_user_meta( $user_id, 'company_country', $company_country );
    //IF we get an error here that means we have a problem in our app.
    if( is_wp_error( $user_id ) )
    {
        $_SESSION["errors"]["register_error_url"] = "Sorry, registration failed due to an unxpected error. We are working on fixing it as soon as possible.";
        wp_safe_redirect( $register_url );
        exit;
    }
    //We set this to false at first.
    add_user_meta( $user_id, "email_activated", "0" );
    $creds = array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => false
    );
    $user = wp_signon( $creds, false );
    send_email_verification_link( $user );
    $username = $user->user_login;
    $_SESSION["home_success"] = "Welcome $username, you have registered successfully. Please check your inbox and verify your email.";
    wp_safe_redirect( $homepage );
    exit;

}
