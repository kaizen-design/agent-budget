<?php
/**
 * Template Name: My Profile
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

if ( !is_user_logged_in() ) {
  wp_redirect( home_url('login', 'relative') );
  exit;
}

Timber::render( 'profile/index.twig', $context );
