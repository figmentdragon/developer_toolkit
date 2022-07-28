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
function ca_customize_sections( $wp_customize ) {

	// Register additional scripts section.
	$wp_customize->add_section(
		'ca_additional_scripts_section',
		[
			'title'    => esc_html__( 'Additional Scripts', 'themename' ),
			'priority' => 10,
			'panel'    => 'site-options',
		]
	);

	// Register a social links section.
	$wp_customize->add_section(
		'ca_social_links_section',
		[
			'title'       => esc_html__( 'Social Media', 'themename' ),
			'description' => esc_html__( 'Links here power the display_social_network_links() template tag.', 'themename' ),
			'priority'    => 90,
			'panel'       => 'site-options',
		]
	);

	// Register a header section.
	$wp_customize->add_section(
		'ca_header_section',
		[
			'title'    => esc_html__( 'Header Customizations', 'themename' ),
			'priority' => 90,
			'panel'    => 'site-options',
		]
	);

	// Register a footer section.
	$wp_customize->add_section(
		'ca_footer_section',
		[
			'title'    => esc_html__( 'Footer Customizations', 'themename' ),
			'priority' => 90,
			'panel'    => 'site-options',
		]
	);
}
add_action( 'customize_register', 'ca_customize_sections' );
