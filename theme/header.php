<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_bloginfo(); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri();?>/favicon.ico" type="image/x-icon" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700,800,600' rel='stylesheet' type='text/css'>
        <?php wp_enqueue_script("jquery"); ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <nav class="navbar navbar-default navbar navbar-default navbar-fixed-top" role="navigation">
          <div class="container">

            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="navbar-center">            
                <a class="navbar-brand " href="<?php echo home_url(); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            </div>
            <section class="collapse navbar-collapse" id="navigationbar">
                <?php
                    wp_nav_menu( array(
                        'menu'              => 'left-menu',
                        'theme_location'    => 'Left Menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => '',
                        'container_id'      => 'bs-right-menu',
                        'menu_class'        => 'nav navbar-nav navbar-left',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                    );
                ?>
                <?php
                    wp_nav_menu( array(
                        'menu'              => 'right-menu',
                        'theme_location'    => 'Right Menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => '',
                        'container_id'      => 'bs-left-menu',
                        'menu_class'        => 'nav navbar-nav navbar-right',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                    );
                ?>
            </section>
            </div>
        </nav>