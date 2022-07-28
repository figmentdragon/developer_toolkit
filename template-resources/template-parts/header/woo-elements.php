<?php
/**
 * Add WooCommerce Elements in header
 *
 * @package creativityarchitect
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    // Bail if WooCommerce is not installed
    return;
}

if ( get_theme_mod( 'creativityarchitect_header_cart_enable', 0 ) && function_exists( 'creativityarchitect_header_cart' ) ) {
	creativityarchitect_header_cart();
}
