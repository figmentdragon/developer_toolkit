<?php
/*****************************************/
## Theme set-up functions
/*****************************************/
if ( ! function_exists ( 'setup' ) ) {
add_action('after_setup_theme', 'setup');
function setup(){

	load_theme_textdomain( 'TheThemeName', get_template_directory().'/languages' );

	add_theme_support('post-thumbnails'); // Add theme support for post thumbnails (featured images).
	add_theme_support('automatic-feed-links');  // Add theme support for automatic feed links.
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	$defaults = array(
		'default-color'          => '',
		'default-image'          => '',
		'default-repeat'         => '',
		'default-position-x'     => '',
		'default-attachment'     => '',

	);
	add_theme_support( 'custom-background', $defaults );

	add_theme_support( 'custom-logo', array(
		'flex-height' => true,
		'flex-width'  => true,

	) );

	add_theme_support('post-formats', array( 'link', 'gallery', 'quote', 'image', 'video', 'audio' ) );
	// Adds support for a variety of post formats.

	add_action( 'wp_enqueue_scripts', 'enqueue_styles_scripts' );
	add_action( 'admin_enqueue_scripts', 'enqueue_styles_scripts' );
	//add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
	//add_action( 'wp_enqueue_scripts', 'custom_enqueue_script' );
	add_image_size ( 'slider', 1600, 9999, false );
	add_image_size ( 'post-image', 780, 9999, false );

	//remove_filter( 'the_content', 'wpautop' );
	//add_filter( 'the_content', 'wpautop' , 12);

	add_theme_support( 'woocommerce' );

}
}

/**********************************************/
## Attach stylesheets & javascripts
/**********************************************/
if ( ! function_exists ( 'enqueue_styles_scripts' ) ) {
	function enqueue_styles_scripts() {

		$uri_path   = get_template_directory_uri();
		$font_url   = esc_attr(get_theme_mod('font_url'));
		$slider_status     = esc_attr(get_theme_mod('slider_enable', 'enable'));

		if (is_admin() ):
			wp_enqueue_script('admin-custom-script', $uri_path . '/assets/js/admin/admin.js', array('jquery'), '1.0.0', true);

		else:
		wp_enqueue_style('style', $uri_path . '/style.css', null, false, 'all');

		if ( is_rtl() ) // if RTL language enabled.
		wp_enqueue_style('rtl-style', $uri_path . '/assets/css/style-rtl.css', null, false, 'all');
		else
		wp_enqueue_style('main-style', $uri_path . '/assets/css/style-ltr.css', null, false, 'all');

		if ( class_exists( 'WooCommerce' ) ):
			wp_enqueue_style('woocommerce-style', $uri_path . '/assets/css/woocommerce.css', null, false, 'all');
		endif;

		if($font_url != ''):
			wp_enqueue_style('google_fonts',$font_url , null, false, 'all');
		endif;

		/********************************************/
		## Attach theme javascripts.
		/*******************************************/
		wp_enqueue_script('pace', $uri_path . '/assets/js/pace.min.js', array('jquery'), '1.0.0', true);

		wp_enqueue_script('modernizr', $uri_path . '/assets/js/modernizr.js', array('jquery'), '1.0.0', true);

		wp_enqueue_script('cssua', $uri_path . '/assets/js/cssua.min.js', array('jquery'), '1.0.0', true);

		wp_enqueue_script('carousel', $uri_path . '/assets/js/slick.min.js', array('jquery'), '1.0.0', true);

		wp_enqueue_script('fitvids', $uri_path . '/assets/js/jquery.fitvids.js', array('jquery'), '1.0.0', true);

		wp_enqueue_script('scrollUp', $uri_path . '/assets/js/jquery.scrollUp.min.js', array('jquery'), '1.0.0', true);

		/********************************************************/
		## custom footer js script
		/*********************************************************/
		wp_enqueue_script( 'main-js', $uri_path . '/assets/js/main.js', $uri_path . '/assets/js/main.js', array('jquery'), '1.0.0', true);


		if($slider_status == 'enable'):
		   $slider_speed  = esc_attr(get_theme_mod('slider_duration', '5000'));

		    wp_add_inline_script('main-js', 'jQuery(document).ready(function($){
				jQuery("#site-banner-carousel").slick({ dots: true, infinite: true,slidesToShow: 1,  slidesToScroll: 1, autoplay: true,autoplaySpeed: '.$slider_speed.', pauseOnHover: true,
				arrows: true,prevArrow : \'<span class="slick-prev"></span>\',nextArrow : \'<span class="slick-next"></span>\',customPaging: function(slider, i) {return \'<span>\' + (i + 1) + \'</span>\';},cssEase: \'ease-in-out\', easing: \'ease-in-out\',lazyLoad: true,
				rtl: RTL,responsive: [{ breakpoint: 1200, settings: {	slidesToShow: 1  }}]});});');
		endif;


		endif;
	}
}
/**
 * Registers an editor stylesheet for the theme.
 */
if ( ! function_exists ( 'add_editor_styles' ) ) {
function add_editor_styles() {
	$uri_path   = get_template_directory_uri();

    add_editor_style( $uri_path . '/assets/css/admin/editor.css' );
}
add_action( 'admin_init', 'add_editor_styles' );
}

/**************************************************/
## body class filter.
/**************************************************/
if ( ! function_exists ( 'body_class' ) ) {
add_filter('body_class', 'body_class' );


}
if ( ! function_exists ( 'post_class' ) ) {
add_filter('post_class', 'post_class' );

function post_class($classes) {

	$classes[] = 'entry entry-center';

	return $classes;
}
}
