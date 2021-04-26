<?php
/**
 * Helpers
 */


function log_error( $message )
{
	$file = __DIR__ . '/../errors.txt';
	file_put_contents( $file, date( 'Y-m-d h:i:s A' ) . ': ' . $message . '. Url: ' . get_current_page_url() . PHP_EOL, FILE_APPEND );
}

function get_current_page_url( $strip_parameters = true )
{
	if ( is_cli() ) {
		return false;
	}
	$pageURL = 'http';
	if ( isset( $_SERVER["HTTPS"] ) && $_SERVER["HTTPS"] == "on" ) {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ( $_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443" ) {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
	}
	else {
		$pageURL .= $_SERVER["SERVER_NAME"];
	}

	if ( ! $strip_parameters ) {
		$pageURL .= $_SERVER['REQUEST_URI'];
	}
	else {
		$pageURL .= strtok( $_SERVER["REQUEST_URI"], '?' );
	}

	return $pageURL;
}

function log_in_file( $var, $append = false )
{
	$file   = __DIR__ . '/../.log.txt';
	$append = $append ? FILE_APPEND : 0;

	if ( is_array( $var ) ) {
		$var = json_encode( $var, JSON_PRETTY_PRINT );
	}
	elseif ( ! is_string( $var ) ) {
		$var = var_export( $var, true );
	}
	if ( $append ) {
		$var = $var . PHP_EOL . str_repeat( '-', 100 ) . PHP_EOL;
	}
	file_put_contents( $file, $var, $append );
}

function is_cli()
{
	return ( php_sapi_name() === 'cli' );
}

function dd_json( $var = null )
{
	wp_send_json( $var, 200 );
}

if ( ! function_exists( 'm_json_error' ) ) {
	function m_json_error( $error, $echo_exist = true )
	{
		return m_encode_json( array(
			'success' => false,
			'msg'     => $error,
		), $echo_exist );
	}
}

if ( ! function_exists( 'm_json_success' ) ) {
	function m_json_success( $data, $echo_exist = true )
	{
		return m_encode_json( array( 'success' => true, 'data' => $data ), $echo_exist );
	}
}

if ( ! function_exists( 'm_encode_json' ) ) {
	function m_encode_json( $mixed_data, $echo_exit = true )
	{
		if ( ! headers_sent() ) {
			header( "Content-Type: application/json" );
			header( "Cache-Control: no-store, no-cache, must-revalidate, max-age=0" );
			header( "Cache-Control: post-check=0, pre-check=0", false );
			header( "Pragma: no-cache" );
		}
		if ( is_array( $mixed_data ) && isset( $mixed_data['msg'] ) ) {
			$mixed_data['msg'] = utf8_encode( $mixed_data['msg'] );
		}
		if ( $echo_exit ) {
			echo json_encode( $mixed_data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT );
			wp_die();
		}

		return json_encode( $mixed_data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT );
	}
}


/* function to santitze the REQUEST parameters */
function get_request_var( $key, $default = null, $trim = true )
{
	$text = isset( $_REQUEST[ $key ] ) ? $_REQUEST[ $key ] : $default;
	if ( $trim ) {
		$text = trim( $text );
	}

	return $text;
}


/*
 * Returns the client ip addresss
 */
function get_ip()
{
	if ( isset( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
		return $_SERVER['HTTP_CF_CONNECTING_IP'];
	}
	elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	elseif ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
		return $_SERVER['REMOTE_ADDR'];
	}
	if ( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
		return $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif ( isset( $_SERVER["HTTP_X_FORWARDED"] ) ) {
		return $_SERVER['HTTP_X_FORWARDED'];
	}
	else {
		return 0;
	}
}