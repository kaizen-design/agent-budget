<?php
/**
 * Template Name: Questionnaire
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render( 'questionnaire/index.twig', $context );
