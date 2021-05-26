<?php
/**
 * Template Name: Questionnaire
 */

if ( !is_user_logged_in() ) {
  auth_redirect();
}

//  TODO: add redirect to the report page if questionnaire is completed

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render( 'questionnaire/index.twig', $context );
