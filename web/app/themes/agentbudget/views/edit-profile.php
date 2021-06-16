<?php
/**
 * Template Name: Edit Profile
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

if ( !is_user_logged_in() ) {
  wp_redirect( home_url('login', 'relative') );
  exit;
}

if ( isset( $_GET['change-password'] ) ) {
  $context['is_change_password_tab'] = true;
}

if ( isset( $_POST['edit_profile'] ) ) {
  
  $user_name = $_POST['user_name'];
  $user_birth_month = $_POST['user_birth_month'];
  $user_birth_day = $_POST['user_birth_day'];
  $user_birth_year = $_POST['user_birth_year'];
  $user_city = $_POST['user_city'];
  $user_state = $_POST['user_state'];
  $user_country = $_POST['user_country'];
  $password = $_POST['user_password'];
  $password_confirm = $_POST['user_password_confirm'];
  
  $args = [
    'ID' => $context['user']['id'],
    'display_name' => $user_name,
  ];
  
  if ( !empty( $user_birth_month ) && !empty( $user_birth_day ) && !empty( $user_birth_year ) ) {
    update_user_meta( $context['user']['id'], 'birth_month', $user_birth_month );
    update_user_meta( $context['user']['id'], 'birth_day', $user_birth_day );
    update_user_meta( $context['user']['id'], 'birth_year', $user_birth_year );
  }
  
  if ( !empty( $user_city ) ) {
    update_user_meta( $context['user']['id'], 'city', $user_city );
  }
  
  if ( !empty( $user_state ) ) {
    update_user_meta( $context['user']['id'], 'state', $user_state );
  }
  
  if ( !empty( $user_country ) ) {
    update_user_meta( $context['user']['id'], 'country', $user_country );
  }
  
  if ( isset( $_FILES['user_profile_image'] ) ) {
    if ( ! function_exists( 'wp_handle_upload' ) )
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
    $movefile = wp_handle_upload( $_FILES['user_profile_image'], [ 'test_form' => false ] );
    update_user_meta( $context['user']['id'], 'profile_image', $movefile['url'] );
  }
  
  if ( !empty( $password ) && !empty( $password_confirm ) && $password === $password_confirm ) {
    $args['user_pass'] = $password;
  }
  
  $update_user = wp_update_user( $args );
  
  if ( $update_user ) {
    $context['msg']['success'] = 'Your account information has been successfully updated.';
  } else {
    $context['msg']['error'] = 'Oops, something went wrong updating your account.';
  }
  wp_redirect( home_url('edit-profile', 'relative') );
}

Timber::render( 'profile/edit.twig', $context );
