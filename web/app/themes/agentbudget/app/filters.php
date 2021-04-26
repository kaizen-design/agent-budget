<?php
/**
 * Filters
 */

/**
 *  add page or post name to body class
 */
add_filter( 'body_class', 'add_slug_body_class' );
function add_slug_body_class( $classes ) {
	global $post;
	if (  ( is_single() || is_page() ) && isset( $post ) && $post ) {
		$classes[] = $post->post_name;
	}

	return $classes;
}


add_filter( 'script_loader_src', 'agentbudget_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'agentbudget_remove_script_version', 15, 1 );
function agentbudget_remove_script_version( $src ) {
	$parts = explode( '?ver', $src );

	return $parts[0];
}

//enable shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

//enable field label option in gravity forms backend
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

add_filter( 'gform_init_scripts_footer', '__return_true' );

add_filter( "gform_field_content", "bootstrap_styles_for_gravityforms_fields", 10, 5 );
function bootstrap_styles_for_gravityforms_fields( $content, $field, $value, $lead_id, $form_id ){

	if ( $field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'select' && $field["type"] != 'multiselect' && $field["type"] != 'checkbox' && $field["type"] != 'fileupload' && $field["type"] != 'html' && $field["type"] != 'address' && $field["type"] != 'textarea' ) {
		$content = str_replace( 'div class=\'ginput_container', 'div class=\'form-group', $content );
		$content = str_replace( 'class=\'medium', 'class=\'form-control input-lg', $content );
	}

	if ( $field["type"] == 'name' || $field["type"] == 'address' ) {
		$content = str_replace( '<input ', '<input class=\'form-control input-lg\' ', $content );
	}

	if ( $field["type"] == 'textarea' ) {
		$content = str_replace( 'div class=\'ginput_container', 'div class=\'form-group', $content );
		$content = str_replace( 'class=\'textarea', 'class=\'form-control input-lg textarea', $content );
		$content = str_replace( 'rows=\'10', 'rows=\'5', $content );
	}

	if ( $field["type"] == 'select' || $field["type"] == 'multiselect' ) {
		$content = str_replace( 'div class=\'ginput_container', 'div class=\'form-group', $content );
		$content = str_replace( 'class=\'medium', 'class=\'sumoselect', $content );
	}

	if ( $field["type"] == 'date' ) {
		$content = str_replace( 'class=\'datepicker medium', 'class=\'datepicker form-control input-lg', $content );
	}

	if ( $field["type"] == 'checkbox' ) {
		$content = str_replace( 'li class=\'', 'li class=\'checkbox ', $content );
		$content = str_replace( '<br>', '', $content );
	}

	if ( $field["type"] == 'radio' ) {
		$content = str_replace( 'li class=\'', 'li class=\'radio ', $content );
		$content = str_replace( '<br>', '', $content );
	}

	return $content;

}


add_filter( 'gform_submit_button', 'gravityforms_footer_markup', 10, 2 );
function gravityforms_footer_markup( $button, $form ) {

	$button = str_replace( "class='", "class='btn btn-primary w-100 '", $button );
	return '
    <div class="row justify-content-start form-bottom-action">
      <div class="col-md-12">
        ' . $button . '
      </div>
    </div>
  ';
}

add_filter( 'wpseo_metabox_prio', function(){
	return 'low';
});