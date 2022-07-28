<?php
/**
 * Customizer function.
 *
 * @package THEMENAME
 * @subpackage Customizer
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

if ( ! function_exists( 'get_theme_mod_value' ) ) {

	/**
	 * Helper function to get theme_mod array values by key.
	 *
	 * @param array $array The decoded theme_mod array.
	 * @param string $key The array key.
	 * @param boolean $default The default to check against.
	 * @param booleon $print_default Wether the default value should be returned.
	 *
	 * @return mixed The key value.
	 */
	function get_theme_mod_value( $array, $key, $default = false, $print_default = false ) {

		// Stop here if we have no array and we don't want to print a default.
		if ( ! $array && ! $print_default ) {
			return false;
		}

		// Initialize value.
		$value = false;

		// If we want to return a default, let's adjust the value.
		if ( $default && $print_default ) {
			$value = $default;
		}

		// Get & set the value by key if we have one.
		$value = isset( $array[$key] ) ? $array[$key] : $value;

		// If we don't want to return a default and the saved
		// value matches default, we set value back to false.
		if ( $default && ! $print_default ) {
			$value = $default === $value ? false : $value;
		}

		return $value;

	}

}

/**
 * Adjust customizer preview.
 */
function adjust_customizer_responsive_sizes() {

	$medium_breakpoint = function_exists( 'breakpoint_medium' ) ? breakpoint_medium() : 768;
	$mobile_breakpoint = function_exists( 'breakpoint_mobile' ) ? breakpoint_mobile() : 480;

	$tablet_margin_left = -$medium_breakpoint / 2 . 'px';
	$tablet_width       = $medium_breakpoint . 'px';

	$mobile_margin_left = -$mobile_breakpoint / 2 . 'px';
	$mobile_width       = $mobile_breakpoint . 'px';

	?>

	<style>
		.wp-customizer .preview-tablet .wp-full-overlay-main {
			margin-left: <?php echo esc_attr( $tablet_margin_left ); ?>;
			width: <?php echo esc_attr( $tablet_width ); ?>;
		}
		.wp-customizer .preview-mobile .wp-full-overlay-main {
			margin-left: <?php echo esc_attr( $mobile_margin_left ); ?>;
			width: <?php echo esc_attr( $mobile_width ); ?>;
			height: 680px;
		}
	</style>

	<?php

}
add_action( 'customize_controls_print_styles', 'adjust_customizer_responsive_sizes' );

/**
 * Minify CSS.
 *
 * @param string $css The css.
 *
 * @return string The minified CSS.
 */
function minify_css( $css ) {

	// Remove Comments
	$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
	// Remove space after colons
	$css = str_replace( ': ', ':', $css );
	$css = str_replace( ' {', '{', $css );
	$css = str_replace( ', ', ',', $css );
	// Remove whitespace
	$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

	return $css;

}

/**
 * Generate customizer CSS.
 */
function generate_css() {

	ob_start();
	include get_template_directory() . '/inc/customizer/styles.php';
	return minify_css( ob_get_clean() );

}

/**
 * Create customizer-styles.css file.
 */
function create_customizer_css_file() {

	if ( 'file' !== apply_filters( 'css_output', 'inline' ) ) {
		return;
	}

	global $wp_filesystem;

	if ( ! $wp_filesystem ) {
		if ( ! function_exists( 'WP_Filesystem' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}
	}

	WP_Filesystem();

	$upload_dir = wp_upload_dir();
	$pbf_dir    = trailingslashit( $upload_dir['basedir'] ) . 'THEMENAME/';
	$css        = generate_css();

	// Create THEMENAME folder if it doesn't exist.
	if ( ! file_exists( $pbf_dir ) ) {
		$wp_filesystem->mkdir( $pbf_dir );
	}

	// Create customizer-styles.css file if it doesn't exist, otherwise attempt to update it.
	if ( ! file_exists( $pbf_dir . 'THEMENAME/customizer-styles.css' ) ) {
		$wp_filesystem->put_contents( $pbf_dir . 'customizer-styles.css', $css, 0644 );
	} else {
		// Override the file only if changes were made in the customizer.
		if ( $css !== $wp_filesystem->get_contents( $pbf_dir . 'customizer-styles.css' ) ) {
			$wp_filesystem->put_contents( $pbf_dir . 'customizer-styles.css', $css, 0644 );
		}
	}

}
add_action( 'wp_loaded', 'create_customizer_css_file' );

/**
 * Enqueue customizer CSS.
 */
function customizer_frontend_scripts() {

	$css_output = apply_filters( 'css_output', 'inline' );

	if ( 'inline' === $css_output ) {

		$inline_styles = generate_css();
		wp_add_inline_style( apply_filters( 'add_inline_style', 'style' ), $inline_styles );

	} elseif ( 'file' === $css_output ) {

		$upload_dir = wp_upload_dir();
		$file_path  = $upload_dir['basedir'] . '/THEMENAME/customizer-styles.css';
		$file_url   = $upload_dir['baseurl'] . '/THEMENAME/customizer-styles.css';

		if ( file_exists( $file_path ) ) {
			wp_enqueue_style( 'customizer', $file_url, '', filemtime( $file_path ) );
		}

	}

}
add_action( 'wp_enqueue_scripts', 'customizer_frontend_scripts', 11 );

/**
 * Customizer CSS live preview.
 */
function customizer_preview_css() {

	if ( ! is_customize_preview() ) {
		return;
	}

	echo '<style id="customize-saved-styles">';
	require THEME_DIR . '/inc/customizer/styles.php';
	echo '</style>';

}
add_action( 'wp_head', 'customizer_preview_css', 999 );

/**
 * Post message.
 */
function customizer_preview_js() {

	wp_enqueue_script( 'postmessage', get_template_directory_uri() . '/inc/customizer/js/postmessage.js', array( 'jquery', 'customize-preview' ), VERSION, true );

}
add_action( 'customize_preview_init', 'customizer_preview_js' );

/**
 * Enqueue customizer scripts & styles.
 */
function customizer_scripts_styles() {

	wp_enqueue_style( 'customizer', get_template_directory_uri() . '/inc/customizer/css/customizer.css', '', VERSION );
	wp_enqueue_script( 'customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array( 'jquery' ), VERSION, true );

	wp_enqueue_style( 'responsive-controls', get_template_directory_uri() . '/inc/customizer/css/responsive-controls.css', '', VERSION );
	wp_enqueue_script( 'responsive-controls', get_template_directory_uri() . '/inc/customizer/js/responsive-controls.js', array( 'jquery' ), VERSION, true );

}
add_action( 'customize_controls_print_styles', 'customizer_scripts_styles' );

// Stop here if WP_Customize_Control doesn't exist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Add Kirki custom controls.
 *
 * @param WP_Customize_Manager $wp_customize Instance of WP_Customize_Manager.
 */
function custom_controls_238290( $wp_customize ) {

	// Custom controls.
	require THEME_DIR . '/inc/customizer/controls/padding/control-padding.php';
	require THEME_DIR . '/inc/customizer/controls/input-slider/control-input-slider.php';
	require THEME_DIR . '/inc/customizer/controls/responsive-input/control-responsive-input.php';
	require THEME_DIR . '/inc/customizer/controls/responsive-padding/control-responsive-padding.php';
	require THEME_DIR . '/inc/customizer/controls/responsive-input-slider/control-responsive-input-slider.php';

}
add_action( 'customize_register', 'custom_controls_238290' );

/**
 * Custom Kirki default fonts.
 *
 * @param array $standard_fonts The standard fonts.
 *
 * @return array The updated standard fonts.
 */
function custom_default_fonts( $standard_fonts ) {

    $standard_fonts = array();

    $standard_fonts['helveticreativityneue'] = array(
        'label'    => 'Helvetica Neue',
        'variants' => array( 'regular', 'italic', '700', '700italic' ),
        'stack'    => '"Helvetica Neue", Helvetica, Arial, sans-serif',
    );

    $standard_fonts['helvetica'] = array(
        'label'    => 'Helvetica',
        'variants' => array( 'regular', 'italic', '700', '700italic' ),
        'stack'    => 'Helvetica, Arial, sans-serif',
    );

    $standard_fonts['arial'] = array(
        'label'    => 'Arial',
        'variants' => array( 'regular', 'italic', '700', '700italic' ),
        'stack'    => 'Arial, Helvetica, sans-serif',
    );

    return $standard_fonts;

}
add_filter( 'kirki/fonts/standard_fonts', 'custom_default_fonts', 0 );
