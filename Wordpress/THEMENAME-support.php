<?php
/**
 * Theme Support
 */

function THEMENAME_theme_support() {
  add_action( 'after_setup_theme', 'THEMENAME_custom_header_setup' );

  add_post_type_support( 'page', 'excerpt' );

	add_theme_support( 'align-wide' );
	add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'custom-background' );
  add_theme_support( 'custom-header' );
  add_theme_support( 'custom-line-height' );
  add_theme_support( 'custom-spacing' );
  add_theme_support( 'customize-selective-refresh-widgets' );
  add_theme_support( 'editor-styles' );
	add_theme_support( 'ew-newsletter-image' );

	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'styles' );
	add_theme_support( 'title-tag' );
  add_theme_support( 'wp-block-styles' );

  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 960, 640, true );
    add_image_size( 'THEMENAME-thumb-600', 600, 150, true );
    add_image_size( 'THEMENAME-thumb-300', 300, 100, true );
		add_image_size( 'THEMENAME-block-image', 606, 404, true ); // Ratio 3:2
    // Used in featured slider
		add_image_size( 'THEMENAME-slider', 1920, 1080, true ); // Ratio 16:9
		// Used in Portfolio
		add_image_size( 'THEMENAME-portfolio', 1920, 9999, true ); // Flexible Height
    add_image_size( 'large', 700, '', true ); // Large Thumbnail.
    add_image_size( 'medium', 250, '', true ); // Medium Thumbnail.
    add_image_size( 'small', 120, '', true ); // Small Thumbnail.
    add_image_size( 'custom-size', 700, 200, true ); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    // Used in single post page
    add_image_size( 'THEMENAME-single-post-page', 1920, 440, true );

    // Used in featured slider
    add_image_size( 'THEMENAME-slider', 1920, 1080, true ); // Ratio 16:9

    // Used in Portfolio
    add_image_size( 'THEMENAME-portfolio', 1920, 9999, true ); // Flexible Height


  add_theme_support( 'html5',
    array(
      'caption',
      'comment-form',
      'comment-list',
      'gallery',
      'navigation-widgets',
      'search-form',
      'style',
      'script',
    )
  );

  add_theme_support(
    'post-formats',
    array(
      'link',
      'aside',
      'gallery',
      'image',
      'quote',
      'status',
      'video',
      'audio',
      'chat',
    )
  );

  add_theme_support( 'custom-background',
    array(
      'default-image' => get_stylesheet_directory() . '/assets/images/backgrounds/architect/compbulb.png',
    )
  );

  $logo_width  = 200;
  $logo_height = 200;

  add_theme_support( 'custom-logo',
    array(
      'height'      => $logo_height,
      'width'       => $logo_width,
      'flex-width'  => true,
      'flex-height' =>true,
      'unlink-homepage-logo' => true,
    )
  );

}
