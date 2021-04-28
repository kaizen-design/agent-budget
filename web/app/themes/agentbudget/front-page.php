<?php
$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

if ( is_user_logged_in() ) {
  Timber::render( 'front-page/welcome.twig', $context );
} else {
  Timber::render( 'front-page/landing.twig', $context );
}
