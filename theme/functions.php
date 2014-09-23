<?php
// For Debugging
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Register Custom Navigation Walker
require_once('lib/wp_bootstrap_navwalker.php');

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


// Facebook Feed
require 'lib/facebook.php';
$facebook = new Facebook(array(
  'appId'  => '324143354431454',
  'secret' => '90a2b06a5a792d89638d439b2a774db3',
));

function fb_feed() {

	$jsonFilePath = 'fb.json';

	if (file_exists($jsonFilePath)) {

		$jsonFile = fopen($jsonFilePath, 'r');
		$data = fread($jsonFile, filesize($jsonFilePath));
		fclose($jsonFile);

	} else {

		global $facebook;
		
		$request = $facebook->api('/488298457891169/feed');

		// turn data into JSON
		$data = json_encode($request);

		// Write to file
		$jsonFile = fopen($jsonFilePath, "w");
		fwrite($jsonFile, $data);
		fclose($jsonFile);
	}
	return $data;
}