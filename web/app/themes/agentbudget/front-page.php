<?php
$context = Timber::get_context();
$post    = Timber::query_post();

$context[ 'post' ] = $post;
$context[ 'is_front_page' ] = 'true';


Timber::render( 'front-page/index.twig', $context );