<?php
/**
 * WooCommerce integration.
 *
 * @package THEMENAME
 * @subpackage Integration/WooCommerce
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Change inline styles location.
 *
 * @param string $location The stylesheet handle.
 *
 * @return string The updated stylesheet handle.
 */
function woo_change_inline_style_location( $location ) {

	// Don't change location if WooCommerce scripts are removed.
	if ( ! apply_filters( 'woocommerce_scripts', true ) ) {
		return $location;
	}

	$location = is_premium() ? 'premium-woocommerce' : 'woocommerce';

	return $location;

}
add_filter( 'add_inline_style', 'woo_change_inline_style_location' );

/**
 * WooCommerce theme setup.
 */
function woo_theme_setup() {

	add_theme_support( 'woocommerce', array(
		'gallery_thumbnail_image_width' => 300,
		'single_image_width'            => 800,
	) );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'wc-product-gallery-lightbox' );

}
add_action( 'after_setup_theme', 'woo_theme_setup' );

// Remove default WooCommerce styles.
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Enqueue scripts & styles.
 */
function woo_scripts() {

	if ( ! apply_filters( 'woocommerce_scripts', true ) ) {
		return;
	}

	// WooCommerce layout.
	wp_enqueue_style( 'woocommerce-layout', get_template_directory_uri() . '/css/min/woocommerce-layout-min.css', '', VERSION );

	// WooCommerce.
	wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/css/min/woocommerce-min.css', '', VERSION );

	// WooCommerce smallscreen.
	wp_enqueue_style( 'woocommerce-smallscreen', get_template_directory_uri() . '/css/min/woocommerce-smallscreen-min.css', '', VERSION );

	// WooCommerce.
	wp_enqueue_script( 'woocommerce', get_template_directory_uri() . '/assets/woocommerce/js/woocommerce.js', array( 'jquery' ), VERSION, true );

	// Single add to cart ajax.
	if ( is_product() && 'yes' === get_option( 'woocommerce_enable_ajax_add_to_cart' ) && get_theme_mod( 'woocommerce_single_add_to_cart_ajax' ) ) {
		wp_enqueue_script( 'woocommerce-single-add-to-cart-ajax', get_template_directory_uri() . '/assets/woocommerce/js/woocommerce-single-add-to-cart-ajax.js', array( 'jquery' ), VERSION, true );
	}

}
add_action( 'wp_enqueue_scripts', 'woo_scripts', 10 );

// WooCommerce customizer settings.
require_once THEME_DIR . '/inc/integration/woocommerce/woocommerce-customizer-settings.php';

// WooCommerce functions.
require_once THEME_DIR . '/inc/integration/woocommerce/woocommerce-functions.php';

// WooCommerce customizer styles.
require_once THEME_DIR . '/inc/integration/woocommerce/woocommerce-styles.php';

/**
 * Elementor integration.
 */
function woo_elementor_integration() {
	require_once THEME_DIR . '/inc/integration/woocommerce/woocommerce-elementor.php';
}
add_action( 'elementor/init', 'woo_elementor_integration' );
