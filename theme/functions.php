<?php

if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {

  // For Debugging on Localhost
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  // For live reloading
  wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
  wp_enqueue_script('livereload');
}

// Register Menus
function register_menus() {
  register_nav_menu('left-menu', 'Left Menu');
  register_nav_menu('right-menu', 'Right Menu');
}
add_action( 'init', 'register_menus' );



// Register Custom Navigation Walker
require_once('lib/wp_bootstrap_navwalker.php');

// Load Composer Dependencies
require_once('lib/autoload.php');

// And Credentials
require_once('config.php');

// Facebook Feed
require_once('fb_feed.php');

// Twitter Feed

function twitter_feed () {

    global $alainConfig;

    $config = $alainConfig['twitter'];

    $tw = new TwitterOAuth\TwitterOAuth($config);

    $params = array(
        'screen_name' => 'alainpupo',
        'count' => 20,
        'exclude_replies' => true
    );

    $response = $tw->get('statuses/user_timeline', $params);

    return json_encode($response);
}

// YouTube Feed

function youtube_feed () {

    global $alainConfig;

    $youtube = new Madcoda\Youtube($alainConfig['youtube']);

    $videoList = $youtube->searchVideos('Alain Pupo');
    
    return json_encode($videoList);
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function add_widgets() {

  register_sidebar( array(
    'name' => 'Right Sidebar',
    'id' => 'right_sidebar',
    'before_widget' => '<div>',
    'after_widget' =>  '</div>',
    'before_title' =>  '<h2>',
    'after_title' =>   '</h2>',
  ) );
}
add_action( 'widgets_init', 'add_widgets' );

// Header Scripts
function header_scripts () {
  wp_enqueue_script('jquery');
  wp_enqueue_style('theme-style', get_stylesheet_uri());
  wp_enqueue_style('custom_fonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700,600|Open+Sans+Condensed:300,700', array(), '1.0');
  wp_enqueue_style('fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array(), '4.0.3');
}
add_action('wp_enqueue_scripts','header_scripts');

// Footer Scripts
function footer_scripts() {
  wp_enqueue_script('bootstrapJS','//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js',array('jquery'), '3.2.0', true);
}
add_action( 'wp_enqueue_scripts', 'footer_scripts');


// Homepage Footer Scripts
function homepage_footer_scripts() {

  if (is_front_page()){
    wp_enqueue_script('angular','//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js',array(), '1.2.25', true);
    wp_enqueue_script('angular-sanitize','//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular-sanitize.min.js',array('angular'), '1.2.20',true);
    wp_enqueue_script('homepage_dependencies', get_stylesheet_directory_uri() . '/lib/homepage-dependencies.min.js', array('angular','jquery'), true);
    wp_enqueue_script('home_feeds', get_stylesheet_directory_uri() . '/home_feeds.js', array('angular','jquery','homepage_dependencies','angular-sanitize'), true);
  }
}
add_action( 'wp_enqueue_scripts', 'homepage_footer_scripts');



// Google webmaster tools
function google_webmaster_tag(){
    ob_start();
    ?>
    <?php if (get_current_blog_id() == 1): ?>
      <meta name="google-site-verification" content="Z-3wkBBZYw1xSoUV2k0RvVf-aKV8fgPGy2uwKFzqiFk" />
    <?php endif ?>
    <?php
    $output = ob_get_clean();
    echo $output;
}
add_action('wp_head','google_webmaster_tag');