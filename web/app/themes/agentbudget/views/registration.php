<?php
/**
 * Template Name: Registration
 */

global $wpdb, $user_ID;

if ( !$user_ID ) {
  $context = Timber::get_context();
  $post = new TimberPost();
  $context['post'] = $post;
  
  if ( isset( $_POST['user_registration'] ) ) {
    global $reg_errors;
    $reg_errors = new WP_Error;
    $username = $_POST['user_name'];
    $useremail = $_POST['user_email'];
    $password = $_POST['user_password'];
    $password_confirm = $_POST['user_password_confirm'];
    
    if ( empty( $username ) || empty( $useremail ) || empty( $password ) || empty( $password_confirm ) ) {
      $reg_errors->add( 'field', 'Required form field is missing.' );
    }
    if ( username_exists( $username ) ) {
      $reg_errors->add( 'user_name', 'The username you entered already exists!' );
    }
    if ( !validate_username( $username ) ) {
      $reg_errors->add( 'username_invalid', 'The username you entered is not valid!' );
    }
    if ( !is_email( $useremail ) ) {
      $reg_errors->add( 'email_invalid', 'Email id is not valid!' );
    }
    if ( email_exists( $useremail ) ) {
      $reg_errors->add( 'email', 'Email already exists!' );
    }
    if ( 8 > strlen( $password ) ) {
      $reg_errors->add( 'password', 'Password must contain at least 8 characters!' );
    }
    if ( $password !== $password_confirm ) {
      $reg_errors->add( 'password', 'Passwords do not match!' );
    }
    
    if ( is_wp_error( $reg_errors ) ) {
      foreach ( $reg_errors->get_error_messages() as $error ) {
        $context['errors'][] = $error;
      }
    }
    
    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
      // sanitize user form input
      global $username, $useremail;
      $username = sanitize_user( $_POST['user_name'] );
      $useremail = sanitize_email( $_POST['user_email'] );
      $password = esc_attr( $_POST['user_password'] );
      
      $userdata = [
        'user_login' => $username,
        'user_email' => $useremail,
        'user_pass' => $password,
      ];
      $user = wp_insert_user( $userdata );
      wp_redirect( home_url( 'login', 'relative' ) );
      exit;
    }
  }
  
  Timber::render( 'auth/registration.twig', $context );
} else {
  wp_redirect( home_url() );
  exit;
}