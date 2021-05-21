<?php

add_action( 'wp_ajax_update_wp_user_data', 'update_wp_user_data' );
add_action( 'wp_ajax_nopriv_update_wp_user_data', 'update_wp_user_data' );

function update_wp_user_data() {
  $user = wp_get_current_user();
  if ( !current_user_can( 'edit_user', $user->ID ) ) {
    return false;
  }
  if ( !isset( $_POST['data'] ) ) {
    return false;
  }
  $data = json_decode(stripslashes($_POST['data']), true);
  
  foreach ($data as $key => $value) {
    update_user_meta( $user->ID, $key, $value );
  }
  
  m_json_success( $data );
}