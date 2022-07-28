<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function testimonial_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
	register_option( $wp_customize, array(
			'name'              => 'jetpack_testimonial_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Note_Control',
			'label'             => sprintf( esc_html__( 'For Testimonial Options for Theme, go %1$shere%2$s', 'TheThemeName' ),
				'<a href="javascript:wp.customize.section( \'testimonials\' ).focus();">',
				 '</a>'
			),
		   'section'            => 'jetpack_testimonials',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'testimonials', array(
			'panel'    => 'theme_options',
			'title'    => esc_html__( 'Testimonials', 'TheThemeName' ),
		)
	);

	$action = 'install-plugin';
    $slug   = 'essential-content-types';

    $install_url = wp_nonce_url(
        add_query_arg(
            array(
                'action' => $action,
                'plugin' => $slug
            ),
            admin_url( 'update.php' )
        ),
        $action . '_' . $slug
    );

    register_option( $wp_customize, array(
            'name'              => 'testimonial_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Note_Control',
            'active_callback'   => 'is_ect_testimonial_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'TheThemeName' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	register_option( $wp_customize, array(
			'name'              => 'testimonial_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'sanitize_select',
			'active_callback'   => 'is_ect_testimonial_active',
			'choices'           => section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'TheThemeName' ),
			'section'           => 'testimonials',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'testimonial_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Note_Control',
			'active_callback'   => 'is_testimonial_active',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'TheThemeName' ),
				'<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
				'</a>'
			),
			'section'           => 'testimonials',
			'type'              => 'description',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'testimonial_number',
			'default'           => '3',
			'sanitize_callback' => 'sanitize_number_range',
			'active_callback'   => 'is_testimonial_active',
			'label'             => esc_html__( 'Number of items', 'TheThemeName' ),
			'section'           => 'testimonials',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'testimonial_number', 3 );

	for ( $i = 1; $i <= $number ; $i++ ) {

		//for CPT
		register_option( $wp_customize, array(
				'name'              => 'testimonial_cpt_' . $i,
				'sanitize_callback' => 'sanitize_post',
				'active_callback'   => 'is_testimonial_active',
				'label'             => esc_html__( 'Testimonial', 'TheThemeName' ) . ' ' . $i ,
				'section'           => 'testimonials',
				'type'              => 'select',
				'choices'           => generate_post_array( 'jetpack-testimonial' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'is_testimonial_active' ) ) :
	/**
	* Return true if testimonial is active
	*
	* @since 1.0
	*/
	function is_testimonial_active( $control ) {
		$enable = $control->manager->get_setting( 'testimonial_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( is_ect_testimonial_active( $control ) && check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since 1.0
    */
    function is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'is_ect_testimonial_active' ) ) :
    /**
    *
    * @since 1.0
    */
    function is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;
