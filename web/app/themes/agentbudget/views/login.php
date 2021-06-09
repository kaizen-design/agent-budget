<?php
/**
 * Template Name: Login
 */

if ( is_user_logged_in() ) {
  wp_redirect( home_url() );
  exit;
}

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

if ( isset( $_POST['user_auth'] ) ) {
  $login = $_POST['user_login'];
  $password = $_POST['user_password'];
  $creds = [
    'user_login' => $login,
    'user_password' => $password,
    'remember' => isset( $_POST['remember_me'] ) ? true : false
  ];
  $user = wp_signon( $creds );
  if ( isset( $user->errors ) ) {
    $context['error'] = $user->get_error_message();
  } else {
    wp_redirect( home_url() );
    exit;
  }
}

Timber::render( 'auth/login.twig', $context );
