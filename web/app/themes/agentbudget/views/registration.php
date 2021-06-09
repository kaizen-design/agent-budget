<?php
/**
 * Template Name: Registration
 */

if ( is_user_logged_in() ) {
  wp_redirect( home_url() );
  exit;
}

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render( 'auth/registration.twig', $context );
