<?php
/**
 * Thumbnail Settings
 * Register Thumbnails section, settings and controls for the Theme Customizer
 * Settings and controls to manage image thumbnail cropping
 *
 * @package creativity_
 */

/**
 * Adds all layout settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function creativity_customize_register_thumbnail_settings( $wp_customize ) {

	// Add Section for Theme Options.
	$wp_customize->add_section( 'creativity_section_thumbnails',
    array(
      'title'    => esc_html__( 'Thumbnail Settings', 'creativity' ),
      'priority' => 50,
      'panel'    => 'creativity_options_panel',
    ) );

	// Add Featured Images Headline.
	$wp_customize->add_control( new creativity_Customize_Header_Control(
    $wp_customize, 'creativity_theme_options[crop_featured_images]',
      array(
        'label' => esc_html__( 'Crop Blog Featured Images', 'creativity' ),
        'section' => 'creativity_section_thumbnails',
        'settings' => array(),
      )
      )
    );

	// Add Setting and Control for cropping the recent posts thumbnails
	$wp_customize->add_setting( 'creativity_crop_recent',
    array(
      'default'           => false,
      'sanitize_callback' => 'creativity_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'creativity_crop_recent',
    array(
      'label'    => esc_html__( 'Crop images for the recent posts thumbnails.', 'creativity' ),
      'section'  => 'creativity_section_thumbnails',
      'type'     => 'checkbox',
	) );

	// Add Setting and Control for cropping Large featured images on blog and archives.
	$wp_customize->add_setting( 'creativity_crop_large_featured',
    array(
      'default'           => false,
      'sanitize_callback' => 'creativity_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'creativity_crop_large_featured',
    array(
      'label'    => esc_html__( 'Crop featured images for the large blog Layout', 'creativity' ),
      'section'  => 'creativity_section_thumbnails',
      'type'     => 'checkbox',
    )
  );
}
add_action( 'customize_register', 'creativity_customize_register_thumbnail_settings' );
