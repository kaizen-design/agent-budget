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
    add_action( 'init', array( $this, 'register_sidebars' ) );
    parent::__construct();
    self::$instance = $this;
  }
  
  public function register_sidebars() {
    register_sidebar( array(
      'id' => 'post-sidebar',
      'name' => 'Post Sidebar',
      'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="module-title">',
      'after_title' => '</h3>',
    ) );
  }
  
  function add_to_context( $context ) {
    $context['theme_options'] = get_fields( 'options' );
    $context['primary_menu'] = new TimberMenu( 'primary' );
    //$context['footer_menu'] = new TimberMenu( 'footer' );
    
    return $context;
  }
  
  function add_to_twig( $twig ) {
    return $twig;
  }
  
}

require_once( __DIR__ . '/../vendor/autoload.php' );
$APP = AgentBudget::getInstance();