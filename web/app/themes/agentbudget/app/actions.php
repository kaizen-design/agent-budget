<?php

add_action( 'init', function () {
	if ( ! headers_sent() && ! is_cli() && session_status() == PHP_SESSION_NONE ) {
		session_start();
	}
} );

add_action( 'after_setup_theme', 'agentbudget_theme_setup' );

function agentbudget_theme_setup()
{
	register_nav_menus( array(
		'primary'  => __( 'Primary Navigation' ),
		//'footer'   => __( 'Footer Navigation' ),
		//'services' => __( 'Footer Services' )
	) );
}

// REMOVE WP EMOJI
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

function disable_embeds_init()
{
	// Remove the REST API endpoint.
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );
	// Turn off oEmbed auto discovery.
	// Don't filter oEmbed results.
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	// Remove oEmbed discovery links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}

add_action( 'init', 'disable_embeds_init', 9999 );