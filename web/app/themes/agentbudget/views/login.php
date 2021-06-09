<?php
/**
 * Template Name: Login
 */

if ( is_user_logged_in() ) {
  //  TODO: redirect to homepage
}

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render( 'auth/login.twig', $context );
