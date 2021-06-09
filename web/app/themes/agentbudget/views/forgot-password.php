<?php
/**
 * Template Name: Forgot Password
 */

if ( is_user_logged_in() ) {
  wp_redirect( home_url() );
  exit;
}

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

if ( isset( $_POST['reset_password'] ) ) {
  $email = trim( $_POST['user_email'] );
  
  if ( empty( $email ) ) {
    $context['msg']['error'] = 'Enter your e-mail address.';
  } else if ( !is_email( $email ) ) {
    $context['msg']['error'] = 'Invalid e-mail address.';
  } else if ( !email_exists( $email ) ) {
    $context['msg']['error'] = 'There is no user registered with that email address.';
  } else {
    
    $random_password = wp_generate_password( 12, false );
    $user = get_user_by( 'email', $email );
    
    $update_user = wp_update_user( array(
        'ID' => $user->ID,
        'user_pass' => $random_password
      )
    );
    
    // if  update user return true then lets send user an email containing the new password
    if ( $update_user ) {
      $to = $email;
      $subject = 'Your new password';
      $sender = get_option( 'name' );
      
      $message = 'Your new password is: ' . $random_password;
      
      $headers[] = 'MIME-Version: 1.0' . "\r\n";
      $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers[] = "X-Mailer: PHP \r\n";
      $headers[] = 'From: ' . $sender . ' < ' . $email . '>' . "\r\n";
      
      $mail = wp_mail( $to, $subject, $message, $headers );
      if ( $mail )
        $context['msg']['success'] = 'Check your email address for you new password.';
      
    } else {
      $context['msg']['error'] = 'Oops, something went wrong updating your account.';
    }
    
  }
}

Timber::render( 'auth/forgot-password.twig', $context );
