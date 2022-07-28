<?php
/**
 * WooCommerce/Elementor integration.
 *
 * @package THEMENAME
 * @subpackage Integration/WooCommerce
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Fix WooCommerce/Elementor grid issue.
 *
 * https://github.com/elementor/elementor/issues/16057
 */
function woo_elementor_grid_fix() {
	echo '<style id="elementor-woocommerce-product-loop-fix">.products.elementor-grid { display:  flex }</style>';
}
add_action( 'wp_head', 'woo_elementor_grid_fix', 999 );
