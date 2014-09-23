<?php
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