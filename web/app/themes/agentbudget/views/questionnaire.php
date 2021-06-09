<?php
/**
 * Template Name: Questionnaire
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

if ( !is_user_logged_in() ) {
  wp_redirect( home_url('login', 'relative') );
  exit;
} else {
  if ( $context['user']['is_report_available'] ) {
    wp_redirect( home_url('my-report', 'relative') );
    exit;
  }
}

Timber::render( 'questionnaire/index.twig', $context );
