<?php
/**
 * Blog Settings
 *
 * Register Blog Settings section, settings and controls for Theme Customizer
 *
 * @package creativity_
 */

/**
 * Adds blog settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function creativity_customize_register_blog_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'creativity_section_blog', array(
		'title'    => esc_html__( 'Blog Settings', 'creativity' ),
		'priority' => 30,
		'panel' => 'creativity_options_panel',
	) );
		

	// Add Settings and Controls for blog layout.
	$wp_customize->add_setting( 'creativity_blog_layout', array(
		'default'           => 'default',
		'sanitize_callback' => 'creativity_sanitize_select',
	) );

	$wp_customize->add_control( 'creativity_blog_layout', array(
		'label'    => esc_html__( 'Blog Layout', 'creativity' ),
		'section'  => 'creativity_section_blog',
		'settings' => 'creativity_blog_layout',
		'type'     => 'select',
		'choices'  => array(
			'default' => esc_html__( 'Default With Sidebar', 'creativity' ),
			'large'  => esc_html__( 'Large Full Width No Sidebar', 'creativity' ),		
		),
	) );
	
	// Add Settings and Controls for blog content.
	$wp_customize->add_setting( 'creativity_blog_content', array(	
		'default'           => 'excerpt',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_select',				
	) );

	$wp_customize->add_control( 'creativity_blog_content', array(
		'label'    => esc_html__( 'Blog Summary Type', 'creativity' ),
		'description' => esc_html__( 'This will let you choose to use excerpts for your blog summaries. This is ONLY for the Default Right Sidebar blog layout.', 'creativity' ),
		'section'  => 'creativity_section_blog',
		'settings' => 'creativity_blog_content',
		'type'     => 'radio',
		'choices'  => array(
			'index'   => esc_html__( 'Post Summary', 'creativity' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'creativity' ),
		),	
	) );		

	// Add Setting and Control for Excerpt Length.
	$wp_customize->add_setting( 'creativity_excerpt_length', array(
		'default'           => 35,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'creativity_excerpt_length', array(
		'label'    => esc_html__( 'Excerpt Length', 'creativity' ),
		'section'  => 'creativity_section_blog',
		'type'     => 'number',
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 1,
        ),		
	) );

	// Add Partial for Blog Layout and Excerpt Length.
	$wp_customize->selective_refresh->add_partial( 'creativity_blog_content_partial', array(
		'selector'         => '.blog-summary',
		'settings'         => array(
			'creativity_blog_layout',
			'creativity_blog_content',
			'creativity_excerpt_length',
		),
		'render_callback'  => 'creativity_customize_partial_blog_content',
		'fallback_refresh' => false,
	) );
	
	// Add Post Layout Headline.
	$wp_customize->add_control( new creativity_Customize_Header_Control(
		$wp_customize, 'creativity_summary_showhide_option', array(
			'label' => esc_html__( 'Summary Show or Hide Elements', 'creativity' ),
			'section' => 'creativity_section_blog',
			'settings' => array(),
		)
	) );	
	
	
	// Add Setting and Control for showing featured label.
	$wp_customize->add_setting( 'creativity_show_featured_label', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_show_featured_label', array(
		'label'    => esc_html__( 'Hide Featured Label', 'creativity' ),
		'section'  => 'creativity_section_blog',
		'type'     => 'checkbox',
	) );	
	

	// Add Setting and Control for showing summary meta.
	$wp_customize->add_setting( 'creativity_show_summary_meta', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_show_summary_meta', array(
		'label'    => esc_html__( 'Hide Post Summary Meta Info', 'creativity' ),
		'section'  => 'creativity_section_blog',
		'type'     => 'checkbox',
	) );	

	// Add Setting and Control for showing summary image.
	$wp_customize->add_setting( 'creativity_show_summary_image', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_show_summary_image', array(
		'label'    => esc_html__( 'Hide Post Summary Featured Image', 'creativity' ),
		'section'  => 'creativity_section_blog',
		'type'     => 'checkbox',
	) );	

	// Add Setting and Control for showing summary author.
	$wp_customize->add_setting( 'creativity_show_summary_author', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_show_summary_author', array(
		'label'    => esc_html__( 'Hide Post Summary By Author', 'creativity' ),
		'section'  => 'creativity_section_blog',
		'type'     => 'checkbox',
	) );

	// Add Setting and Control for showing summary date.
	$wp_customize->add_setting( 'creativity_show_summary_date', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_show_summary_date', array(
		'label'    => esc_html__( 'Hide Post Summary Date', 'creativity' ),
		'section'  => 'creativity_section_blog',
		'type'     => 'checkbox',
	) );

	// Add Setting and Control for showing summary comments.
	$wp_customize->add_setting( 'creativity_show_summary_comments', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_show_summary_comments', array(
		'label'    => esc_html__( 'Hide Post Summary Comment Count', 'creativity' ),
		'section'  => 'creativity_section_blog',
		'type'     => 'checkbox',
	) );

	// Add Setting and Control for showing edit link
	$wp_customize->add_setting( 'creativity_show_edit', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'creativity_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'creativity_show_edit', array(
		'label'    => esc_html__( 'Hide Edit Links on Pages &amp; Posts', 'creativity' ),
		'section'  => 'creativity_section_blog',
		'type'     => 'checkbox',
	) );	
	
}
add_action( 'customize_register', 'creativity_customize_register_blog_settings' );


/**
 * Render the blog content for the selective refresh partial.
 */
function creativity_customize_partial_blog_content() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/post/content', get_post_format() );
	}
}
