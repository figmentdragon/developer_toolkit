<?php
/**
 * Featured Slider Options
 *
 * @package THEMENAME
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function slider_options( $wp_customize ) {
	$wp_customize->add_section( 'featured_slider', array(
			'panel' => 'theme_options',
			'title' => esc_html__( 'Featured Slider', 'TheThemeName' ),
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'sanitize_select',
			'choices'           => section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'TheThemeName' ),
			'section'           => 'featured_slider',
			'type'              => 'select',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'slider_number',
			'default'           => '4',
			'sanitize_callback' => 'sanitize_number_range',

			'active_callback'   => 'is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'TheThemeName' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'TheThemeName' ),
			'section'           => 'featured_slider',
			'type'              => 'number',
		)
	);

	$slider_number = get_theme_mod( 'slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {

		register_option( $wp_customize, array(
				'name'              => 'slider_logo_image_' . $i,
				'sanitize_callback' => 'sanitize_image',
				'custom_control'    => 'WP_Customize_Image_Control',
				'active_callback'   => 'is_slider_active',
				'label'             => esc_html__( 'Logo Image #', 'TheThemeName' ) . $i,
				'section'           => 'featured_slider',
			)
		);

		// Page Sliders
		register_option( $wp_customize, array(
				'name'              => 'slider_page_' . $i,
				'sanitize_callback' => 'sanitize_post',
				'active_callback'   => 'is_slider_active',
				'label'             => esc_html__( 'Page', 'TheThemeName' ) . ' # ' . $i,
				'section'           => 'featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since 1.0
	*/
	function is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return check_section( $enable );
	}
endif;
