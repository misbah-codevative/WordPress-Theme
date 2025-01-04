<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="masthead">




    <!-- header section strats -->
    <header class="header_section">
      <div class="header_bottom">
        <div class="container-fluid">
          <div class="row">
            <div class="col-4">
              <nav class="navbar navbar-expand-lg custom_nav-container ">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ">
                  <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'primary-menu',
                            'container'      => 'nav',
                            'container_class'=> 'primary-nav',
                        ));
                    }
                    ?>
                  </ul>
                </div>
              </nav>
            </div>
            <div class="col-4 text-center">
              <a class="navbar-brand mx-auto" href="index.html">
                <span>
                  <?php mytheme_display_custom_logo(); ?>
                </span>
              </a>
            </div>
            <div class="col-4 d-inline-flex justify-content-end">
              <a href="!#">Contact</a>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- end header section -->
</header>
