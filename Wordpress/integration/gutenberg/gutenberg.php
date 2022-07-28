<?php
/**
 * Gutenberg integration.
 *
 * @package THEMENAME
 * @subpackage Integration/Gutenberg
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Theme setup.
 */
function gutenberg_theme_setup() {

	// Editor styles.
	add_theme_support( 'editor-styles' );

	// Add support for wide aligned elements.
	add_theme_support( 'align-wide' );

}
add_action( 'after_setup_theme', 'gutenberg_theme_setup' );

/**
 * Generate CSS.
 */
function generate_gutenberg_css() {

	ob_start();
	include_once THEME_DIR . '/inc/integration/gutenberg/gutenberg-styles.php';
	return minify_css( ob_get_clean() );

}

/**
 * Add editor styles.
 */
function gutenberg_block_editor_assets() {

	if ( apply_filters( 'block_editor_styles', true ) ) {
		$inline_styles = generate_gutenberg_css();

		wp_enqueue_style( 'gutenberg-style', get_template_directory_uri() . '/css/block-editor-styles.css', '', VERSION );
		wp_add_inline_style( 'gutenberg-style', $inline_styles );
	}

	if ( ! function_exists( 'register_block_type_from_metadata' ) ) {
		return;
	}

	$enqueue_data = require __DIR__ . '/build/block-editor.asset.php';
	$version      = $enqueue_data['version'];
	$dependencies = $enqueue_data['dependencies'];

	wp_enqueue_style( 'block-editor', THEME_URI . '/inc/integration/gutenberg/build/block-editor.css', array(), $version );

	wp_enqueue_script( 'block-editor', THEME_URI . '/inc/integration/gutenberg/build/block-editor.js', $dependencies, $version, true );

	wp_add_inline_script(
		'editor',
		'var themenameBlocks = {};',
		'before'
	);

}
add_action( 'enqueue_block_editor_assets', 'gutenberg_block_editor_assets' );

/**
 * Change the url of THEMENAME's block assets url.
 *
 * @see https://developer.wordpress.org/reference/functions/plugins_url/
 *
 * @param string $url    The complete URL to the plugins directory including scheme and path.
 * @param string $path   Path relative to the URL to the plugins directory. Blank string
 *                       if no path is specified.
 * @param string $plugin The plugin file path to be relative to. Blank string if no plugin
 *                       is specified.
 */
function parse_block_assets_url( $url, $path, $plugin ) {

	if ( ! function_exists( 'register_block_type_from_metadata' ) ) {
		return;
	}

	if (
		false === stripos( $path, '../../build/block-editor' ) &&
		false === stripos( $path, '../../build/blocks' )
	) {
		return $url;
	}

	$path = str_ireplace( '../../build/', '/build/', $path );
	$url  = THEME_URI . '/inc/integration/gutenberg' . $path;

	return $url;

}
add_filter( 'plugins_url', 'parse_block_assets_url', 10, 3 );

/**
 * Register blocks category.
 *
 * @param array  $categories Block categories.
 * @param object $post Post object.
 *
 * @return array The modified block categories.
 */
function register_blocks_category( $categories, $post ) {

	if ( ! function_exists( 'register_block_type_from_metadata' ) ) {
		return;
	}

	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'TheThemeName',
				'title' => __( 'TheThemeName', 'TheThemeName' ),
			),
		)
	);

}
add_filter( 'block_categories_all', 'register_blocks_category', 10, 2 );

/**
 * Register blocks.
 */
function register_blocks() {

	if ( ! function_exists( 'register_block_type_from_metadata' ) ) {
		return;
	}

	$scan = glob( __DIR__ . '/blocks/*/block.php' );

	foreach ( $scan as $path ) {
		$explode    = explode( '/', $path );
		$block_name = $explode[ count( $explode ) - 2 ];
		$func_name  = str_ireplace( '-', '_', $block_name );

		require_once $path;
	}

}
add_action( 'after_setup_theme', 'register_blocks' );
