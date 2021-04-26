<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context               = Timber::get_context();
$post                  = Timber::query_post();
$context['post']       = $post;



if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} 
else {
	Timber::render( 'articles/single.twig', $context );
}