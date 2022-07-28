<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package creativity_
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function creativity_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'creativity_section_post',
    array(
      'title'    => esc_html__( 'Post Settings', 'creativity' ),
      'priority' => 40,
      'panel' => 'creativity_options_panel',
    )
  );

	// Add Settings and Controls for Layout.
	$wp_customize->add_setting( 'creativity_single_layout',
    array(
      'default'           => 'single-default',
      'sanitize_callback' => 'creativity_sanitize_select',
    ) );

	$wp_customize->add_control( 'creativity_single_layout',
    array(
      'label'    => esc_html__( 'Full Post Layout', 'creativity' ),
      'description' => esc_html__( 'This will let you choose your full post layout.', 'creativity' ),
      'section'  => 'creativity_section_post',
      'type'     => 'radio',
      'choices'  => array(
        'single-default' => esc_html__( 'Post With Sidebar', 'creativity' ),
        'single-centered' => esc_html__( 'Post Full Width Centered No Sidebar', 'creativity' ),
      ),
    )
  );

	// Add Partial for single Layout
	$wp_customize->selective_refresh->add_partial( 'creativity_customize_partial_single_post',
    array(
      'selector'         => '#single-layout',
      'settings'         => array( 'creativity_single_layout', ),
      'render_callback'  => 'creativity_customize_partial_single_content',
      'fallback_refresh' => false,
    )
  );

   // Add Single Post Headline.
	$wp_customize->add_control( new creativity_Customize_Header_Control(
    $wp_customize, 'creativity_theme_options[single_post]', array(
      'label' => esc_html__( 'Show or Hide Post Elements', 'creativity' ),
      'section' => 'creativity_section_post',
      'settings' => array(),
    )
    )
  );

	// Add Setting and Control for showing summary image.
	$wp_customize->add_setting( 'creativity_show_single_image',
    array(
		  'default'           => false,
		  'transport'         => 'postMessage',
		  'sanitize_callback' => 'creativity_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'creativity_show_single_image',
    array(
      'label'    => esc_html__( 'Hide Full Post Featured Image', 'creativity' ),
		  'section'  => 'creativity_section_post',
      'type'     => 'checkbox',
    )
  );

	// Add Setting and Control for showing post full meta info
	$wp_customize->add_setting( 'creativity_single_meta_info',
    array(
      'default'           => false,
      'transport'         => 'postMessage',
      'sanitize_callback' => 'creativity_sanitize_checkbox',
    )
  );

	$wp_customize->add_control( 'creativity_single_meta_info',
    array(
      'label'    => esc_html__( 'Hide Full Post Meta Info', 'creativity' ),
      'section'  => 'creativity_section_post',
      'type'     => 'checkbox',
    )
  );

	// Add Setting and Control for showing summary author.
	$wp_customize->add_setting( 'creativity_show_single_author',
    array(
      'default'           => false,
      'transport'         => 'postMessage',
      'sanitize_callback' => 'creativity_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'creativity_show_single_author',
    array(
      'label'    => esc_html__( 'Hide Full Post By Author', 'creativity' ),
      'section'  => 'creativity_section_post',
      'type'     => 'checkbox',
    ) );

  // Add Setting and Control for showing summary date.
	$wp_customize->add_setting( 'creativity_show_single_date',
    array(
      'default'           => false,
      'transport'         => 'postMessage',
      'sanitize_callback' => 'creativity_sanitize_checkbox',
    ) );

  $wp_customize->add_control( 'creativity_show_single_date',
    array(
      'label'    => esc_html__( 'Hide Full Post Date', 'creativity' ),
      'section'  => 'creativity_section_post',
      'type'     => 'checkbox',
    ) );

	// Add Setting and Control for showing summary comments.
	$wp_customize->add_setting( 'creativity_show_single_comments',
    array(
      'default'           => false,
      'transport'         => 'postMessage',
      'sanitize_callback' => 'creativity_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'creativity_show_single_comments',
    array(
      'label'    => esc_html__( 'Hide Full Post Comment Count', 'creativity' ),
      'section'  => 'creativity_section_post',
      'type'     => 'checkbox',
    ) );

	// Add Setting and Control for showing post categories.
	$wp_customize->add_setting( 'creativity_footer_categories',
    array(
      'default'           => false,
      'transport'         => 'postMessage',
      'sanitize_callback' => 'creativity_sanitize_checkbox',
    ) );

	$wp_customize->add_control( 'creativity_footer_categories',
    array(
      'label'    => esc_html__( 'Hide Categories', 'creativity' ),
      'section'  => 'creativity_section_post',
      'type'     => 'checkbox',
    ) );

	// Add Setting and Control for showing post tags.
	$wp_customize->add_setting( 'creativity_footer_tags', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_footer_tags', array(
		'label'    => esc_html__( 'Hide Tags', 'creativity' ),
		'section'  => 'creativity_section_post',
		'type'     => 'checkbox',
	) );
	// Add Setting and Control for showing author avatar
	$wp_customize->add_setting( 'creativity_display_author_bio', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_display_author_bio', array(
		'label'    => esc_html__( 'Hide Author Bio', 'creativity' ),
		'section'  => 'creativity_section_post',
		'type'     => 'checkbox',
	) );

	// Add Setting and Control for showing post navigation.
	$wp_customize->add_setting( 'creativity_post_navigation', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_post_navigation', array(
		'label'    => esc_html__( 'Hide previous/next post navigation', 'creativity' ),
		'section'  => 'creativity_section_post',
		'type'     => 'checkbox',
	) );

}
add_action( 'customize_register', 'creativity_customize_register_post_settings' );


/**
 * Render single posts partial
 */
function creativity_customize_partial_single_post() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/post/content', 'single' );
	}
}
