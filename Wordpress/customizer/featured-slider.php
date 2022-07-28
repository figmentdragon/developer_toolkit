<?php
/**
 * Featured Slider Options
 *
 * @package themename
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themename_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'themename_featured_slider', array(
			'panel' => 'themename_theme_options',
			'title' => esc_html__( 'Featured Slider', 'themename' ),
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'themename_sanitize_select',
			'choices'           => themename_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'themename' ),
			'section'           => 'themename_featured_slider',
			'type'              => 'select',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'themename_sanitize_number_range',

			'active_callback'   => 'themename_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'themename' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'themename' ),
			'section'           => 'themename_featured_slider',
			'type'              => 'number',
		)
	);

	$slider_number = get_theme_mod( 'themename_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {

		themename_register_option( $wp_customize, array(
				'name'              => 'themename_slider_logo_image_' . $i,
				'sanitize_callback' => 'themename_sanitize_image',
				'custom_control'    => 'WP_Customize_Image_Control',
				'active_callback'   => 'themename_is_slider_active',
				'label'             => esc_html__( 'Logo Image #', 'themename' ) . $i,
				'section'           => 'themename_featured_slider',
			)
		);

		// Page Sliders
		themename_register_option( $wp_customize, array(
				'name'              => 'themename_slider_page_' . $i,
				'sanitize_callback' => 'themename_sanitize_post',
				'active_callback'   => 'themename_is_slider_active',
				'label'             => esc_html__( 'Page', 'themename' ) . ' # ' . $i,
				'section'           => 'themename_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'themename_slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'themename_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since 1.0
	*/
	function themename_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'themename_slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return themename_check_section( $enable );
	}
endif;
