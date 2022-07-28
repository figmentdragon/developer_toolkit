<?php
/**
 * Customizer setup.
 *
 * @package THEMENAME
 * @subpackage Customizer
 *
 * @param object $wp_customize The wp customize object.
 */
 defined( 'ABSPATH' ) || die( "Can't access directly" );

 // Load textdomain. This is required to make strings translatable.
 load_theme_textdomain( 'TheThemeName' );

function customizer_setup( $wp_customize ) {

	// Move sections.
	$wp_customize->get_section( 'title_tagline' )->panel    = 'header_panel';
	$wp_customize->get_section( 'background_image' )->panel = 'layout_panel';

	// Move controls.
	$wp_customize->get_control( 'background_color' )->section = 'background_image';

	// Change section titles.
	$wp_customize->get_section( 'title_tagline' )->title    = __( 'Logo', 'TheThemeName' );
	$wp_customize->get_section( 'background_image' )->title = __( 'Background', 'TheThemeName' );

	// Change panel priority.
	$panel = $wp_customize->get_panel( 'nav_menus' );

	if ( $panel ) {
		$panel->priority = 40;
	}

	// Change section priority.
	$wp_customize->get_section( 'background_image' )->priority = 200;

	// Change setting transport method.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Change control priorities.
	$wp_customize->get_control( 'custom_logo' )->priority      = 0;
	$wp_customize->get_control( 'blogname' )->priority         = 9;
	$wp_customize->get_control( 'blogdescription' )->priority  = 19;
	$wp_customize->get_control( 'background_color' )->priority = 100;
	$wp_customize->get_control( 'background_image' )->priority = 0;

	// Partial refresh for custom logo.
	// This is faking a partial refresh to have an edit icon displayed for the logo.
	// A partial refresh isn't possible because the logo & mobile logo are the same by default but can be configured differently.
	// Unfortunately we can't pass multiple arrays with add_partial - this would solve the issue.
	$wp_customize->selective_refresh->add_partial( 'custom_logo', array(
		'selector' => '.logo',
	) );

	// Partial refresh for blogname.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title a',
		'render_callback' => function () {
			bloginfo( 'name' );
		},
	) );

	// Partial refresh for blogdescription.
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.tagline',
		'render_callback' => function () {
			bloginfo( 'description' );
		},
	) );

}
add_action( 'customize_register', 'customizer_setup', 20 );


/**
 * Include Custom Controls
 */
require get_theme_file_path( 'inc/customizer/controls/custom-controls.php' );

require get_theme_file_path( 'inc/customizer/settings/theme-options.php' );

require get_theme_file_path( 'inc/customizer/settings/helpers.php' );

require get_theme_file_path( 'inc/customizer/settings/reset.php' );

require get_theme_file_path( 'inc/customizer/sections/portfolio.php' );

require get_theme_file_path( 'inc/customizer/sections/testimonial.php' );

require get_theme_file_path( 'inc/customizer/sections/featured-content.php' );

require get_theme_file_path( 'inc/customizer/sections/service.php' );

require get_theme_file_path( 'inc/customizer/sections/hero-content.php' );

require get_theme_file_path( 'inc/customizer/sections/featured-slider.php' );

require get_theme_file_path( 'inc/customizer/sections/header-media.php' );
