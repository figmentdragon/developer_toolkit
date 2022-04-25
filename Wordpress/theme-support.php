<?php

function themename_custom_features() {
    add_theme_support( 'align-wide' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-background' );
    add_theme_support( 'custom-background',
      array(
        'default-color' => 'FFF',
        'default-image' => get_template_directory_uri() . '/img/bg.jpg'
      ));
    add_theme_support( "custom-header");
		add_theme_support( 'custom-line-height' );
    add_theme_support( 'custom-header',
      array(
        'default-image'          => get_template_directory_uri() . '/img/headers/default.jpg',
        'header-text'            => false,
        'default-text-color'     => '000',
        'width'                  => 1000,
        'height'                 => 198,
        'random-default'         => false
      ));
      $logo_width  = 400;
  		$logo_height = 400;
    add_theme_support( 'custom-logo',
      array(
        'height'               => $logo_height,
        'width'                => $logo_width,
        'flex-width'           => true,
        'flex-height'          => true,
        'unlink-homepage-logo' => true,
      )
    );
    add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-spacing' );
		add_theme_support( 'custom-units' );
    add_theme_support( 'editor-styles' );
		add_theme_support( 'experimental-link-color' );
    add_theme_support( 'html5',
      ['caption', 'comment-form', 'comment-list', 'gallery', 'navigation-widgets', 'style', 'script']
    );
    // Add Support for post formats
    add_theme_support( 'post-formats',
      ['link', 'aside', 'gallery', 'image', 'quote', 'status', 'video', 'audio', 'chat']
    );
    // Add Thumbnail Theme Support.
    add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
  	add_theme_support( 'title-tag' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wp-block-styles' );

  	add_editor_style( array('css/editor-style.css') );
		add_filter( 'rss_widget_feed_link', '__return_false' );
    add_post_type_support( 'page', 'excerpt' );

  }
