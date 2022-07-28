<?php

/* Integration */

// Gutenberg integration.
require_once THEME_DIR . '/inc/integration/gutenberg/gutenberg.php';

// Header/Footer Elementor integration.
if ( ! function_exists( 'header_footer_elementor_support' ) ) {
	// Backwards compatibility check as this was included in the Premium Add-On earlier.
	require_once THEME_DIR . '/inc/integration/header-footer-elementor.php';
}

/**
 * Elementor Pro integration.
 *
 * @since 2.1
 */
function do_elementor_pro_integration() {

	// Backwards compatibility check as this was included in the Premium Add-On earlier.
	if ( function_exists( 'elementor_pro_integration' ) ) {
		return;
	}

	require_once THEME_DIR . '/inc/integration/elementor-pro.php';

}
add_action( 'elementor_pro/init', 'do_elementor_pro_integration' );

// Beaver Builder integration.
if ( class_exists( 'FLBuilderLoader' ) ) {
	require_once THEME_DIR . '/inc/integration/beaver-builder.php';
}

// Beaver Themer integration.
// Backwards compatibility check as this was included in the Premium Add-On earlier.
if ( ! function_exists( 'bb_header_footer_support' ) && class_exists( 'FLThemeBuilderLoader' ) && class_exists( 'FLBuilderLoader' ) ) {
	require_once THEME_DIR . '/inc/integration/beaver-themer.php';
}

// Divi integration.
if ( class_exists( 'ET_Builder_Plugin' ) ) {
	require_once THEME_DIR . '/inc/integration/divi.php';
}

// Easy Digital Downloads integration.
if ( class_exists( 'Easy_Digital_Downloads' ) ) {
	require_once THEME_DIR . '/inc/integration/edd/edd.php';
}

// WooCommerce integration.
if ( class_exists( 'WooCommerce' ) ) {
	require_once THEME_DIR . '/inc/integration/woocommerce/woocommerce.php';
}

// LifterLMS integration.
if ( class_exists( 'LifterLMS' ) ) {
	require_once THEME_DIR . '/inc/integration/lifterlms/lifterlms.php';
}
 ?>
