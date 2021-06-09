<?php
$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

if ( is_user_logged_in() ) {
  if ( $context['user']['is_report_available'] ) {
    wp_redirect( home_url('my-report', 'relative') );
    exit;
  } else {
    Timber::render( 'front-page/welcome.twig', $context );
  }
} else {
  Timber::render( 'front-page/landing.twig', $context );
}
