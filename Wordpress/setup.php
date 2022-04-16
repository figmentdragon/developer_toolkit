<?php
/**
 * Theme setup.
 *
 * @package creativity architect
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @author WebDevStudios
 */
function setup() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on creativity architect, use a find and replace
	 * to change 'creativityarchitect' to the name of your theme in all the template files.
	 * You will also need to update the Gulpfile with the new text domain
	 * and matching destination POT file.
	 */
	load_theme_textdomain( 'creativityarchitect', get_template_directory() . '/build/languages' );

	// Register navigation menus.
	register_nav_menus(
		[
			'primary' => esc_html__( 'Primary Menu', 'creativityarchitect' ),
			'footer'  => esc_html__( 'Footer Menu', 'creativityarchitect' ),
			'mobile'  => esc_html__( 'Mobile Menu', 'creativityarchitect' ),
		]
	);
}

add_action( 'after_setup_theme', 'setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @author WebDevStudios
 */
function content_width() {
	$GLOBALS['content_width'] = apply_filters( 'content_width', 640 );
}

add_action( 'after_setup_theme', 'content_width', 0 );

/**
 * Register widget area.
 *

 *

 */
function widgets_init() {




}

add_action( 'widgets_init', 'widgets_init' );
