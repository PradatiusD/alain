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