<?php
/**
 * Customizer functionality
 *
 * @package themename
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since 1.0
 *
 * @see themename_header_style()
 */
function themename_custom_header_and_bg() {
  $default_background_color = '#000000';
  $default_text_color = '#999999';

  add_theme_support( 'custom-background',
    apply_filters( 'themename_custom_bg_args',
      array(
        'default-color' => $default_background_color,
      )
      )
    );
  add_theme_support( 'custom-header',
    apply_filters( 'themename_custom_header_args',
      $default = array(
        'default-image'      => get_template_directory_uri( '/src/images/header/header-image.jpg' ),
        'default-text-color' => $default_text_color,
        'width'              => 1920,
        'height'             => 822,
        'flex-height'        => true,
        'random-default'         => true,
        'video'              => true,
      )
    )
  );
	register_default_headers(
      array(
        'default-image' => array(
          'url'           => '%s/src/images/headers/header-image.jpg',
          'thumbnail_url' => '%s/src/images/headers/header-image-275x155.jpg',
          'description'   => esc_html__( 'Default Header Image', 'themename' ),
        )
      )
    );
  }
add_action( 'after_setup_theme', 'themename_custom_header_and_bg' );

function themename_customize_control_js() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	$path = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'src/js/source/' : 'src/js/';

	wp_enqueue_style( 'themename-custom-controls-css', trailingslashit( esc_url( get_template_directory_uri() ) ) . 'src/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'themename_customize_control_js' );
