<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_bloginfo(); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri();?>/favicon.ico" type="image/x-icon" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700,600|Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
        <?php wp_enqueue_script("jquery"); ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header class="header-logo">
            <span class="circle-bg"></span>
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_stylesheet_directory_uri();?>/img/Alain-logo.png">
            </a>
        </header>
        <nav class="navbar navbar-default nav-band" role="navigation">
          <div class="container">

            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <section class="collapse navbar-collapse" id="navigationbar">
                <?php
                    wp_nav_menu( array(
                        'menu'              => 'left-menu',
                        'theme_location'    => 'left-menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => '',
                        'container_id'      => 'bs-left-menu',
                        'menu_class'        => 'nav navbar-nav navbar-left',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                    );
                ?>
                <?php
                    wp_nav_menu( array(
                        'menu'              => 'right-menu',
                        'theme_location'    => 'right-menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => '',
                        'container_id'      => 'bs-right-menu',
                        'menu_class'        => 'nav navbar-nav navbar-right',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                    );
                ?>
            </section>
            </div>
        </nav>