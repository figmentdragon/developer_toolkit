<?php
/**
 * Block editor (gutenberg) specific functionality
 *
 * @package themename
 */


add_action( 'after_setup_theme', 'themename_block_editor_setup' );

if ( ! function_exists( 'themename_block_editor_setup' ) ) {

	/**
	 * Sets up our default theme support for the WordPress block editor.
	 */
	function themename_block_editor_setup() {

		// Add support for the block editor stylesheet.
		add_theme_support( 'editor-styles' );

		// Add support for wide alignment.
		add_theme_support( 'align-wide' );

		// Register our custom colors as options in the editor.
		$color_palette = themename_generate_color_palette();
		if ( $color_palette ) {
			add_theme_support( 'editor-color-palette', $color_palette );
		}
	}
}

if ( ! function_exists( 'themename_generate_color_palette' ) ) {
	/**
	 * Checks for our JSON file of color values. If exists, creates a color palette array.
	 *
	 * @return array|bool
	 */
	function themename_generate_color_palette() {
		$color_palette = array();

		// Grabs the autogenerated color palette that we're pulling from our compiled bootstrap stylesheets.
		$color_palette_json = file_get_contents( get_theme_file_path( '/inc/editor-color-palette.json' ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

		if ( $color_palette_json ) {
			$color_palette_json = json_decode( $color_palette_json, true );
			foreach ( $color_palette_json as $key => $value ) {
				$key             = str_replace( array( '--bs-', '--' ), '', $key );
				$color_palette[] = array(
					'name'  => $key,
					'slug'  => $key,
					'color' => $value,
				);
			}
		}

		/**
		 * Filters the default bootstrap color palette so it can be overriden by child themes or plugins when we add theme support for editor-color-palette. This array can also be generated via gulp.
		 *
		 * @param array $color_palette An array of color options for the editor-color-palette setting.
		 */
		return apply_filters( 'themename_theme_editor_color_palette', $color_palette );
	}
}
