<?php
// For Debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// For live reloading
if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
  wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
  wp_enqueue_script('livereload');
}

// Register Menus
function register_menus() {
  register_nav_menu('left-menu',__( 'Left Menu' ));
  register_nav_menu('right-menu',__( 'Right Menu' ));
}
add_action( 'init', 'register_menus' );



// Register Custom Navigation Walker
require_once('lib/wp_bootstrap_navwalker.php');

// Load Composer Dependencies
require_once('lib/autoload.php');

// Facebook Feed
require_once('fb_feed.php');

// Twitter Feed

function twitter_feed () {

    $config = array(
        'consumer_key' => 'YKfniTT4KcO24NA1qb9T79gxi',
        'consumer_secret' => '6ZhcMRdMyaoUWIxoPfpekdeiavPMGP9qyw6d74B8CzQMpgFxIX',
        'oauth_token' => '838713331-TzSuQUllxJbCPmr9aXdprxoXrG6z5jBxg05kVoCj',
        'oauth_token_secret' => 'ODMW4y6K31Y0Yr50Oo1wtAMOBngAvu4lgQX41fO1Cm1H3',
        'output_format' => 'object'
    );

    $tw = new TwitterOAuth\TwitterOAuth($config);

    $params = array(
        'screen_name' => 'alainpupo',
        'count' => 10,
        'exclude_replies' => true
    );

    $response = $tw->get('statuses/user_timeline', $params);

    return json_encode($response);
}