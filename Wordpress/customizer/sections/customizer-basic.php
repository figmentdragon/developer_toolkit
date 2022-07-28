<?php
/**
 * Basic Settings
 *
 * Register Basic Settings section, settings and controls for Theme Customizer
 *
 * @package creativity_
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function creativity_customize_register_basic_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'creativity_section_basic', array(
		'title'    => esc_html__( 'Basic Settings', 'creativity' ),
		'priority' => 8,
		'panel' => 'creativity_options_panel',
	) );

	// Add a copyright setting and control.
	$wp_customize->add_setting( 'creativity_copyright', array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'default'           => __( '© 2022', 'creativity' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'creativity_copyright', array(
		'label'    => esc_html__( 'Copyright Name', 'creativity' ),
		'description' => __( 'Enter your copyright text here.', 'creativity' ),
		'section'  => 'creativity_section_basic',
		'type'     => 'text',
	) );


	// Add Gallery Comments Headline.
	$wp_customize->add_control( new creativity_Customize_Header_Control(
		$wp_customize, 'creativity_theme_options[basic_options]', array(
			'label' => esc_html__( 'WP Gallery Options', 'creativity' ),
			'section' => 'creativity_section_basic',
			'settings' => array(),
		)
	) );

	// Add Setting and Control for showing post date.
	$wp_customize->add_setting( 'creativity_attachment_comments', array(
		'default'           => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_attachment_comments', array(
		'label'    => esc_html__( 'Enable Gallery View Comments', 'creativity' ),
		'section'  => 'creativity_section_basic',
		'type'     => 'checkbox',
	) );

	// Add Google Fonts Headline.
	$wp_customize->add_control( new creativity_Customize_Header_Control(
		$wp_customize, 'creativity_google_fonts_option]', array(
			'label' => esc_html__( 'Default Google Fonts', 'creativity' ),
			'section' => 'creativity_section_basic',
			'settings' => array(),
		)
	) );

	// Enable Default Google Fonts
	$wp_customize->add_setting( 'creativity_default_google_fonts', array(
		'default'           => true,
		'description' => esc_html__( 'This theme has a couple Google Fonts included. If you choose to use a plugin for different fonts, you can disable them.', 'creativity' ),
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_default_google_fonts', array(
		'label'    => esc_html__( 'Enable the Default Google Fonts', 'creativity' ),
		'section'  => 'creativity_section_basic',
		'type'     => 'checkbox',
	) );

}
add_action( 'customize_register', 'creativity_customize_register_basic_settings' );
