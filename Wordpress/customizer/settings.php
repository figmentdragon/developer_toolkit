<?php
/**
 * Customizer settings.
 *
 * @package creativity architect
 */

/**
 * Register additional scripts.
 *
 * @author WebDevStudios
 *
 * @param WP_Customize_Manager $wp_customize Instance of WP_Customize_Manager.
 */
function ca_customize_additional_scripts( $wp_customize ) {
	// Register a setting.
	$wp_customize->add_setting(
		'ca_header_scripts',
		[
			'default'           => '',
			'sanitize_callback' => 'force_balance_tags',
		]
	);

	// Create the setting field.
	$wp_customize->add_control(
		'ca_header_scripts',
		[
			'label'       => esc_attr__( 'Header Scripts', 'themename' ),
			'description' => esc_attr__( 'Additional scripts to add to the header. Basic HTML tags are allowed.', 'themename' ),
			'section'     => 'ca_additional_scripts_section',
			'type'        => 'textarea',
		]
	);

	// Register a setting.
	$wp_customize->add_setting(
		'ca_footer_scripts',
		[
			'default'           => '',
			'sanitize_callback' => 'force_balance_tags',
		]
	);

	// Create the setting field.
	$wp_customize->add_control(
		'ca_footer_scripts',
		[
			'label'       => esc_attr__( 'Footer Scripts', 'themename' ),
			'description' => esc_attr__( 'Additional scripts to add to the footer. Basic HTML tags are allowed.', 'themename' ),
			'section'     => 'ca_additional_scripts_section',
			'type'        => 'textarea',
		]
	);
}

add_action( 'customize_register', 'ca_customize_additional_scripts' );

/**
 * Register a social icons setting.
 *
 * @author WebDevStudios
 *
 * @param WP_Customize_Manager $wp_customize Instance of WP_Customize_Manager.
 */
function ca_customize_social_icons( $wp_customize ) {
	// Create an array of our social links for ease of setup.
	$social_networks = [
		'facebook',
		'instagram',
		'twitter',
		'linkedin',
	];

	// Loop through our networks to setup our fields.
	foreach ( $social_networks as $network ) {

		// Register a setting.
		$wp_customize->add_setting(
			'ca_' . $network . '_link',
			[
				'default'           => '',
				'sanitize_callback' => 'esc_url',
			]
		);

		// Create the setting field.
		$wp_customize->add_control(
			'ca_' . $network . '_link',
			[
				'label'   => /* translators: the social network name. */ sprintf( esc_attr__( '%s URL', 'themename' ), ucwords( $network ) ),
				'section' => 'ca_social_links_section',
				'type'    => 'text',
			]
		);
	}
}

add_action( 'customize_register', 'ca_customize_social_icons' );

/**
 * Register copyright text setting.
 *
 * @author WebDevStudios
 *
 * @param WP_Customize_Manager $wp_customize Instance of WP_Customize_Manager.
 */
function ca_customize_copyright_text( $wp_customize ) {
	// Register a setting.
	$wp_customize->add_setting(
		'ca_copyright_text',
		[
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		]
	);

	// Create the setting field.
	$wp_customize->add_control(
		new Text_Editor_Custom_Control(
			$wp_customize,
			'ca_copyright_text',
			[
				'label'       => esc_attr__( 'Copyright Text', 'themename' ),
				'description' => esc_attr__( 'The copyright text will be displayed in the footer. Basic HTML tags allowed.', 'themename' ),
				'section'     => 'ca_footer_section',
				'type'        => 'textarea',
			]
		)
	);
}

add_action( 'customize_register', 'ca_customize_copyright_text' );
