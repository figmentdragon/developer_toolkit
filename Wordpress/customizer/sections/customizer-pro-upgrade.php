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
 * @param object $wp_customize / Customizer Object.
 */
function creativity_customize_register_upgrade_settings( $wp_customize ) {
// SECTION - UPGRADE
    $wp_customize->add_section( 'creativity_upgrade', array(
        'title'       => esc_html__( 'Upgrade to Pro', 'creativity' ),
        'priority'    => 0
    ) );
		$wp_customize->add_setting( 'creativity_upgrade_pro', array(
			'default' => '',
			'sanitize_callback' => '__return_false'
		) );
		$wp_customize->add_control( new creativity_Customize_Static_Text_Control( $wp_customize, 'creativity_upgrade_pro', array(
			'label'	=> esc_html__('Get The Pro Version:','creativity'),
			'section'	=> 'creativity_upgrade',
			'description' => array('')
		) ) );	
}
add_action( 'customize_register', 'creativity_customize_register_upgrade_settings' );