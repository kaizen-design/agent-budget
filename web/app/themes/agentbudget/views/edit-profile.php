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

if ( isset( $_POST['edit_profile'] ) ) {
  
  $user_name = $_POST['user_name'];
  $user_birth_month = $_POST['user_birth_month'];
  $user_birth_day = $_POST['user_birth_day'];
  $user_birth_year = $_POST['user_birth_year'];
  $user_city = $_POST['user_city'];
  $user_state = $_POST['user_state'];
  $user_country = $_POST['user_country'];
  
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
  
  $update_user = wp_update_user( [
    'ID' => $context['user']['id'],
    'display_name' => $_POST['user_name'],
  ] );
  
  if ( $update_user ) {
    $context['msg']['success'] = 'Your account information has been successfully updated.';
  } else {
    $context['msg']['error'] = 'Oops, something went wrong updating your account.';
  }
  //wp_redirect( home_url('edit-profile', 'relative') );
}

Timber::render( 'profile/edit.twig', $context );
