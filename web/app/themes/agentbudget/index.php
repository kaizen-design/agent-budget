<?php
/**
 * Blog posts page
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context = Timber::context();

$context['posts'] = new Timber\PostQuery();


Timber::render( 'articles/index.twig', $context );