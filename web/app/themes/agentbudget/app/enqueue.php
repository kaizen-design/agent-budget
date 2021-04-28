<?php

add_action( 'wp_enqueue_scripts', 'agentbudget_enqueue_scripts' );
function agentbudget_enqueue_scripts() {
  
  $assetsDir = get_stylesheet_directory_uri() . '/assets';
  
  //  CSS
  //wp_enqueue_style( 'font-awesome-css', '//use.fontawesome.com/releases/v5.1.0/css/all.css' );
  wp_enqueue_style( 'app-css', $assetsDir . '/css/app.css' );
  
  // Scripts register
  wp_register_script( 'agentbudget-js', $assetsDir . '/js/dist/app.min.js', array(
    'jquery',
    'bootstrap-js',
    'loading-overlay-js'
  ), '', true );
  
  //wp_register_script( 'sweetalert-js', 'https://cdn.jsdelivr.net/npm/sweetalert2@9', array( 'jquery' ), '', true );
  wp_register_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js', [ 'jquery' ], false, true );
  wp_register_script( 'loading-overlay-js', '//cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.4/dist/loadingoverlay.min.js', [], '', true );
  wp_register_script( 'noty-js-cdn', '//cdn.jsdelivr.net/npm/noty@3.2.0-beta/lib/noty.min.js', [], '', true );
  //wp_register_script( 'waypoints-js', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js', [], '', true );
  //wp_register_script( 'counterup-js', $assetsDir . '/js/vendor/jquery.counterup.js', ['jquery', 'waypoints-js'], '', true );
  
  wp_register_script( 'frontpage-js', $assetsDir . '/js/dist/front-page.min.js', array(
    'jquery',
    'agentbudget-js'
  ), '', true );
  
  if ( !is_admin() ) {
    wp_enqueue_script( 'jquery', false, [], false, false );
  }
  
  /**
   * Front Page Scripts
   */
  if ( is_front_page() ) {
    //wp_enqueue_script( 'waypoints-js' );
    //wp_enqueue_script( 'counterup-js' );
    wp_enqueue_script( 'frontpage-js' );
  }
  
  /**
   * Global scripts
   */
  wp_enqueue_script( 'bootstrap-js' );
  wp_enqueue_script( 'pushy-js' );
  wp_enqueue_script( 'agentbudget-js' );
  
  $appOptions = [
    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    'homeUrl' => get_home_url(),
    'templateUrl' => get_stylesheet_directory_uri(),
    'nonce' => wp_create_nonce( 'ajax-nonce' )
  ];
  
  /**
   * Localize global vars
   */
  wp_localize_script( 'agentbudget-js', 'APP', $appOptions );
}