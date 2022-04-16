<?php
/**
 * Customizer sections.
 *
 * @package creativity architect
 */

/**
 * Register the section sections.
 *
 * @author WebDevStudios
 * @param object $wp_customize Instance of WP_Customize_Class.
 */
function customize_sections( $wp_customize ) {

	// Register additional scripts section.
	$wp_customize->add_section(
		'additional_scripts_section',
		[
			'title'    => esc_html__( 'Additional Scripts', 'creativityarchitect' ),
			'priority' => 10,
			'panel'    => 'site-options',
		]
	);

	// Register a social links section.
	$wp_customize->add_section(
		'social_links_section',
		[
			'title'       => esc_html__( 'Social Media', 'creativityarchitect' ),
			'description' => esc_html__( 'Links here power the display_social_network_links() template tag.', 'creativityarchitect' ),
			'priority'    => 90,
			'panel'       => 'site-options',
		]
	);

	// Register a header section.
	$wp_customize->add_section(
		'header_section',
		[
			'title'    => esc_html__( 'Header Customizations', 'creativityarchitect' ),
			'priority' => 90,
			'panel'    => 'site-options',
		]
	);

	// Register a footer section.
	$wp_customize->add_section(
		'footer_section',
		[
			'title'    => esc_html__( 'Footer Customizations', 'creativityarchitect' ),
			'priority' => 90,
			'panel'    => 'site-options',
		]
	);
}
add_action( 'customize_register', 'customize_sections' );