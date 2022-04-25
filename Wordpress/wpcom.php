<?php
/**
 * WordPress.com-specific functions and definitions
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package themename
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'themename_wpcom_setup' );

if ( ! function_exists( 'themename_wpcom_setup' ) ) {
	/**
	 * Adds support for wp.com-specific theme functions.
	 *
	 * @global array $themecolors
	 */
	function themename_wpcom_setup() {
		global $themecolors;

		// Set theme colors for third party services.
		if ( ! isset( $themecolors ) ) {
			$themecolors = array(
				'bg'     => '',
				'border' => '',
				'text'   => '',
				'link'   => '',
				'url'    => '',
			);
		}

		/* Add WP.com print styles */
		add_theme_support( 'print-styles' );
	}
}

add_action( 'wp_enqueue_scripts', 'themename_wpcom_styles' );

if ( ! function_exists( 'themename_wpcom_styles' ) ) {
	/**
	 * WordPress.com-specific styles
	 */
	function themename_wpcom_styles() {
		wp_enqueue_style( 'themename-wpcom', get_template_directory_uri() . '/inc/style-wpcom.css', array(), '20160411' );
	}
}
