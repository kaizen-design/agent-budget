<?php

define( 'STORAGE_DIR', __DIR__ . '/../storage/' );

class AgentBudget extends TimberSite {
  
  private static $instance;
  
  public static function getInstance() {
    if ( !self::$instance ) {
      self::$instance = new AgentBudget();
    }
    
    return self::$instance;
  }
  
  public function __construct() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    //add_action( 'init', array( $this, 'register_sidebars' ) );
    parent::__construct();
    self::$instance = $this;
  }
  
  /*public function register_sidebars() {
    register_sidebar( array(
      'id' => 'post-sidebar',
      'name' => 'Post Sidebar',
      'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="module-title">',
      'after_title' => '</h3>',
    ) );
  }*/
  
  function add_to_context( $context ) {
    $context['theme_options'] = get_fields( 'options' );
    $context['theme_url'] = get_stylesheet_directory_uri();
    //$context['primary_menu'] = new TimberMenu( 'primary' );
    
    if ( is_user_logged_in() ) {
      $context['is_user_logged_in'] = TRUE;
      $user = wp_get_current_user();
      $profile_image = get_user_meta( $user->ID, 'profile_image', true );
      $context['user'] = [
        'id' => $user->ID,
        'email' => $user->user_email,
        'password' => $user->user_pass,
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
        'display_name' => $user->display_name,
        'birth_month' => get_user_meta( $user->ID, 'birth_month', true ),
        'birth_day' => get_user_meta( $user->ID, 'birth_day', true ),
        'birth_year' => get_user_meta( $user->ID, 'birth_year', true ),
        'city' => get_user_meta( $user->ID, 'city', true ),
        'state' => get_user_meta( $user->ID, 'state', true ),
        'country' => get_user_meta( $user->ID, 'country', true ),
        'avatar' => $profile_image ? $profile_image : get_avatar_url( $user->ID, [ 'size' => '70' ] ),
        'is_report_available' => get_user_meta( $user->ID, 'is_report_available', true )
      ];
    }
    
    return $context;
  }
  
  function add_to_twig( $twig ) {
    return $twig;
  }
  
}

require_once( __DIR__ . '/../vendor/autoload.php' );
$APP = AgentBudget::getInstance();