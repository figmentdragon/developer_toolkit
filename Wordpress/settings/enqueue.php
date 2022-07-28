<?php

/*------------------------------------*\
    Enqueue Scripts & Styles
\*------------------------------------*/
add_action( 'wp_enqueue_scripts', 'creativity_scripts_and_styles' );
add_action( 'wp_footer', 'deregister_scripts' );
add_action( 'wp_enqueue_scripts', 'creativity_conditional_scripts' );

function deregister_scripts() {
  wp_deregister_script( 'wp-embed' );
}
function deregister_styles() {
  wp_dequeue_style( 'wp-block-library' );
}

function creativity_scripts_and_styles() {
  wp_enqueue_style('font-awesome',get_template_directory_uri() . '/css/font-awesome.css',true );
	wp_enqueue_style( 'nivo-lightbox', get_template_directory_uri().'/assets/vendors/nivolightbox/nivo-lightbox.css' );
	wp_enqueue_style( 'nivo-lightbox-default', get_template_directory_uri().'/assets/vendors/nivolightbox/themes/default/default.css' );
	wp_enqueue_style( 'jquery-fullpage', get_template_directory_uri().'/assets/vendors/fullpage/jquery.fullPage.css', true );
	wp_enqueue_style( 'mcustomscrollbar', get_template_directory_uri().'/assets/vendors/mcustomscrollbar/jquery.mCustomScrollbar.css', true );
	wp_enqueue_style( 'creativity-style', get_stylesheet_uri() );
	wp_enqueue_style( 'creativity-keyboard', get_template_directory_uri().'/assets/css/keyboard.css', true );
	wp_enqueue_style( 'creativity-responsive', get_template_directory_uri().'/assets/css/responsive.css', true );
	wp_enqueue_style( 'creativity', get_template_directory_uri() . '/assets/css/creativity.css', true );

  wp_register_style('main-style', get_template_directory_uri() . '/style.css', array(), 'all');

  wp_enqueue_style('main-style');
}

// Load creativity styles
function creativity_styles() {
  // normalize-css
    wp_register_style( 'normalize', get_template_directory_uri() . '/assets/css/lib/normalize.css', array(), '7.0.0' );

    // Custom CSS
    wp_register_style( 'creativity', get_template_directory_uri() . '/assets/css/creativity.css', array( 'normalize' ), '1.0' );

    wp_enqueue_style( 'main-style' );
    // Custom CSS
    wp_enqueue_style( 'creativity' );
    // Register CSS
    wp_enqueue_style( 'creativitycssmin' );
  	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/images/genericons/genericons.css', array(), '3.2' );
    wp_enqueue_style( 'creativity-plugins', get_template_directory_uri() . '/assets/css/pluginstyle.css', array(), '1' );
}

function creativity_scripts() {
  wp_enqueue_script( 'jquery-fullpage', get_template_directory_uri().'/assets/vendors/fullpage/jquery.fullPage.min.js', array( 'jquery' ),'20120206', true );
  wp_enqueue_script( 'jquery-bxslider', get_template_directory_uri().'/assets/js/jquery/jquery.bxslider.js', array( 'jquery' ),'20120206', true );
  wp_enqueue_script( 'isotope', get_template_directory_uri().'/assets/vendors/isotope.pkgd.min.js', array( 'jquery' ),'20120206', true );
  wp_enqueue_script( 'jquery-inview', get_template_directory_uri().'/assets/js/jquery/jquery.inview.js', array( 'jquery'), '20120206', true );
  wp_enqueue_script( 'jquery-knob', get_template_directory_uri().'/assets/js/jquery/jquery.knob.js', array( 'jquery'), '20120206', true );
  wp_enqueue_script( 'nivo-lightbox', get_template_directory_uri().'/assets/vendors/nivolightbox/nivo-lightbox.js', array( 'jquery'), '20120206', true );
  wp_enqueue_script( 'mcustomscrollbar', get_template_directory_uri().'/assets/vendors/mcustomscrollbar/jquery.mCustomScrollbar.js', array( 'jquery'), '20120206', true );
  wp_enqueue_script( 'device', get_template_directory_uri().'/assets/js/device.js', array( ), '20120206', true );
  wp_enqueue_script( 'scrollto', get_template_directory_uri().'/assets/js/jquery/jquery.scrollTo.js', array( ), '20120206', true );
  wp_enqueue_script( 'creativity-custom-js', get_template_directory_uri().'/assets/js/custom.js', array('jquery', 'jquery-masonry'), '20120206', true );

  $pause = get_theme_mod( 'creativity_slider_pause', '4000' );

  wp_localize_script( 'creativity-custom-js', 'sBxslider', array( 'pause' => $pause ) );
}

function creativity_conditional_scripts() {
  if ( ! is_admin() ) {
    wp_enqueue_script(     'responsive-videos',  get_template_directory_uri() . '/assets/js/responsive-videos.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'animate', get_template_directory_uri(). '/assets/js/animate.js', array( 'jquery' ), '0.1.0' , true );
    wp_enqueue_script( 'creativity-custom', get_template_directory_uri() . '/js/customscripts.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );
		wp_enqueue_style( 'animate-style', get_template_directory_uri() . '/animate.css', array(), '1', 'screen' );
		wp_enqueue_style( 'creativity-style', get_stylesheet_uri(), array(), '1.0' );
		wp_style_add_data( 'creativity-style', 'rtl', 'replace' );
	}
}