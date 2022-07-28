<?php
/**
 * Hero Content Options
 *
 * @package themename
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themename_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'themename_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'themename' ),
			'panel' => 'themename_theme_options',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'themename_sanitize_select',
			'choices'           => themename_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'select',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'themename_sanitize_post',
			'active_callback'   => 'themename_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_content_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'themename_is_hero_content_active',
			'label'             => esc_html__( 'Sub Headline', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'textarea',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_experience_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'themename_is_hero_content_active',
			'label'             => esc_html__( 'Experience Title', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'text',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_date_one',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'themename_is_hero_content_active',
			'label'             => esc_html__( 'Date 1', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'text',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_experience_one',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'themename_is_hero_content_active',
			'label'             => esc_html__( 'Experience 1', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'text',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_date_two',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'themename_is_hero_content_active',
			'label'             => esc_html__( 'Date 2', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'text',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_experience_two',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'themename_is_hero_content_active',
			'label'             => esc_html__( 'Experience 2', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'text',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_date_three',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'themename_is_hero_content_active',
			'label'             => esc_html__( 'Date 3', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'text',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_experience_three',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'themename_is_hero_content_active',
			'label'             => esc_html__( 'Experience 3', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'text',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_date_four',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'themename_is_hero_content_active',
			'label'             => esc_html__( 'Date 4', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'text',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_hero_experience_four',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'themename_is_hero_content_active',
			'label'             => esc_html__( 'Experience 4', 'themename' ),
			'section'           => 'themename_hero_content_options',
			'type'              => 'text',
		)
	);

}
add_action( 'customize_register', 'themename_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'themename_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since 1.0
	*/
	function themename_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'themename_hero_content_visibility' )->value();

		return themename_check_section( $enable );
	}
endif;
