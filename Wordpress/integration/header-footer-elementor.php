<?php
/**
 * Header Footer Elementor integration.
 *
 * https://wordpress.org/plugins/header-footer-elementor/
 *
 * @package THEMENAME
 * @subpackage Integration
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Render header if HFE header termplate exists.
 */
function do_hfe_header() {

	if ( function_exists( 'hfe_render_header' ) && hfe_header_enabled() ) {
		hfe_render_header();
	}

}
add_action( 'header', 'do_hfe_header' );

/**
 * Render footer if HFE footer template exists.
 */
function do_hfe_footer() {

	if ( function_exists( 'hfe_render_footer' ) && hfe_footer_enabled() ) {
		hfe_render_footer();
	}

}
add_action( 'footer', 'do_hfe_footer' );

/**
 * Remove theme header/footer if the respective HFE template is present.
 */
function remove_header_footer_hfe() {

	if ( function_exists( 'hfe_render_header' ) && hfe_header_enabled() ) {
		remove_action( 'header', 'do_header' );
	}

	if ( function_exists( 'hfe_render_footer' ) && hfe_footer_enabled() ) {
		remove_action( 'footer', 'do_footer' );
	}

}
add_action( 'wp', 'remove_header_footer_hfe' );

/**
 * Add HFE theme support.
 */
function header_footer_elementor() {
	add_theme_support( 'header-footer-elementor' );
}
add_action( 'after_setup_theme', 'header_footer_elementor' );
