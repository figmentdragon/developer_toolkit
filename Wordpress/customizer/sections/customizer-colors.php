<?php
/**
 * Layout Settings
 *
 * Register Layout section, settings and controls for Theme Customizer
 *
 * @package THEMENAME
 */

/**
 * Adds all layout settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function THEMENAME_customize_register_colour_settings( $wp_customize ) {

// Site Title Colour
 	$wp_customize->add_setting( 'THEMENAME_sitetitle_colour', array(
		'default'        => '#262626',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_sitetitle_colour', array(
		'label'   => esc_html__( 'Site Title Colour', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_sitetitle_colour',
	) ) );
	
// Site tagline Colour
 	$wp_customize->add_setting( 'THEMENAME_tagline_colour', array(
		'default'        => '#444',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_tagline_colour', array(
		'label'   => esc_html__( 'Site Tagline  Colour', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_tagline_colour',
	) ) );
	
// Accent Colour
 	$wp_customize->add_setting( 'THEMENAME_accent_colour', array(
		'default'        => '#c7b897',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_accent_colour', array(
		'label'   => esc_html__( 'Gutenberg Accent Colour', 'TheThemeName' ),
		'description'   => esc_html__( 'This is your accent colour when using the Gutenberg editor.', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_accent_colour',
	) ) );

// Primary Colour
 	$wp_customize->add_setting( 'THEMENAME_first_colour', array(
		'default'        => '#c7b897',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_first_colour', array(
		'label'   => esc_html__( 'First Colour', 'TheThemeName' ),
		'description'   => esc_html__( 'This is the beige colour.', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_first_colour',
	) ) );

// Second Colour
 	$wp_customize->add_setting( 'THEMENAME_third_colour', array(
		'default'        => '#262626',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_third_colour', array(
		'label'   => esc_html__( 'Third Colour', 'TheThemeName' ),
		'description'   => esc_html__( 'This is a dark grey colour; used mostly for headings, titles, and buttons.', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_third_colour',
	) ) );

// Third Colour
 	$wp_customize->add_setting( 'THEMENAME_fourth_colour', array(
		'default'        => '#9a9a9a',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_fourth_colour', array(
		'label'   => esc_html__( 'Fourth Colour', 'TheThemeName' ),
		'description'   => esc_html__( 'This is a medium grey colour; used mostly for secondary text like meta post info.', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_fourth_colour',
	) ) );

// border and line Colours
 	$wp_customize->add_setting( 'THEMENAME_line_colour', array(
		'default'        => '#dedede',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_line_colour', array(
		'label'   => esc_html__( 'Border and Line  Colours', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_line_colour',
	) ) );
	
// image borders
 	$wp_customize->add_setting( 'THEMENAME_image_border', array(
		'default'        => '#d8d2c5',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_image_border', array(
		'label'   => esc_html__( 'Image Border', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_image_border',
	) ) );

// image hover borders
 	$wp_customize->add_setting( 'THEMENAME_image_hborder', array(
		'default'        => '#c3b496',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_image_hborder', array(
		'label'   => esc_html__( 'Image Hover Border', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_image_hborder',
	) ) );
	
// Dropcap Colour
 	$wp_customize->add_setting( 'THEMENAME_dropcap_colour', array(
		'default'        => '#444',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_dropcap_colour', array(
		'label'   => esc_html__( 'For the Gutenberg editor Drop Cap', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_dropcap_colour',
	) ) );

	
// splash page button
 	$wp_customize->add_setting( 'THEMENAME_splash_button', array(
		'default'        => '#262626',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_splash_button', array(
		'label'   => esc_html__( 'Splash Page Button', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_splash_button',
	) ) );
	
// splash page button text
 	$wp_customize->add_setting( 'THEMENAME_splash_button_text', array(
		'default'        => '#fff',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_splash_button_text', array(
		'label'   => esc_html__( 'Splash Page Button Text', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_splash_button_text',
	) ) );

// splash page button hover
 	$wp_customize->add_setting( 'THEMENAME_splash_hbutton', array(
		'default'        => '#c3b496',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_splash_hbutton', array(
		'label'   => esc_html__( 'Splash Page Button Text', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_splash_hbutton',
	) ) );

// splash page button hover text
 	$wp_customize->add_setting( 'THEMENAME_splash_hbutton_text', array(
		'default'        => '#fff',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_splash_hbutton_text', array(
		'label'   => esc_html__( 'Splash Page Button Hover Text', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_splash_hbutton_text',
	) ) );

// main menu link colour
 	$wp_customize->add_setting( 'THEMENAME_menu_link_colour', array(
		'default'        => '#161616',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_menu_link_colour', array(
		'label'   => esc_html__( 'Main Menu Links', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_menu_link_colour',
	) ) );
	
// main menu link hover colour
 	$wp_customize->add_setting( 'THEMENAME_menu_hover_link_colour', array(
		'default'        => '#ceb654',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_menu_hover_link_colour', array(
		'label'   => esc_html__( 'Main Menu Links (hover)', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_menu_hover_link_colour',
	) ) );

// main submenu link colour
 	$wp_customize->add_setting( 'THEMENAME_submenu_link_colour', array(
		'default'        => '#161616',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_submenu_link_colour', array(
		'label'   => esc_html__( 'Main Menu (submenu) Links', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_submenu_link_colour',
	) ) );
// main submenu link hover colour
 	$wp_customize->add_setting( 'THEMENAME_submenu_link_hover_colour', array(
		'default'        => '#ceb654',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_submenu_link_hover_colour', array(
		'label'   => esc_html__( 'Main Menu (submenu hover) Links', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_submenu_link_hover_colour',
	) ) );
	
// main menu submenu bg
 	$wp_customize->add_setting( 'THEMENAME_submenu_bg', array(
		'default'        => '#fff',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_submenu_bg', array(
		'label'   => esc_html__( 'Main Submenu Background', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_submenu_bg',
	) ) );
	
// main menu submenu border
 	$wp_customize->add_setting( 'THEMENAME_submenu_border', array(
		'default'        => '#ececec',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'THEMENAME_submenu_border', array(
		'label'   => esc_html__( 'Main Submenu Border', 'TheThemeName' ),
		'section' => 'colors',
		'settings'   => 'THEMENAME_submenu_border',
	) ) );
	
}
add_action( 'customize_register', 'THEMENAME_customize_register_colour_settings' );
