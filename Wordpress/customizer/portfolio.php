<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themename_portfolio_options( $wp_customize ) {
	// Add note to Jetpack Portfolio Section
	themename_register_option( $wp_customize, array(
			'name'              => 'themename_jetpack_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'themename_Note_Control',
			'label'             => sprintf( esc_html__( 'For Portfolio Options for Theme, go %1$shere%2$s', 'themename' ),
				 '<a href="javascript:wp.customize.section( \'themename_portfolio\' ).focus();">',
				 '</a>'
			),
			'section'           => 'jetpack_portfolio',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'themename_portfolio', array(
			'panel'    => 'themename_theme_options',
			'title'    => esc_html__( 'Portfolio', 'themename' ),
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

    themename_register_option( $wp_customize, array(
            'name'              => 'themename_portfolio_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'themename_Note_Control',
          	'active_callback'   => 'themename_is_ect_portfolio_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Type Enabled', 'themename' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'themename_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_portfolio_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'themename_sanitize_select',
			'active_callback'   => 'themename_is_ect_portfolio_active',
			'choices'           => themename_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'themename' ),
			'section'           => 'themename_portfolio',
			'type'              => 'select',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'themename_Note_Control',
			'active_callback'   => 'themename_is_portfolio_active',
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'themename' ),
				 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
				 '</a>'
			),
			'section'           => 'themename_portfolio',
			'type'              => 'description',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_portfolio_number',
			'default'           => 6,
			'sanitize_callback' => 'themename_sanitize_number_range',
			'active_callback'   => 'themename_is_portfolio_active',
			'label'             => esc_html__( 'Number of items to show', 'themename' ),
			'section'           => 'themename_portfolio',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'themename_portfolio_number', 6 );

	for ( $i = 1; $i <= $number ; $i++ ) {
		//for CPT
		themename_register_option( $wp_customize, array(
				'name'              => 'themename_portfolio_cpt_' . $i,
				'sanitize_callback' => 'themename_sanitize_post',
				'active_callback'   => 'themename_is_portfolio_active',
				'label'             => esc_html__( 'Portfolio', 'themename' ) . ' ' . $i ,
				'section'           => 'themename_portfolio',
				'type'              => 'select',
				'choices'           => themename_generate_post_array( 'jetpack-portfolio' ),
			)
		);


	} // End for().

}
add_action( 'customize_register', 'themename_portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'themename_is_portfolio_active' ) ) :
	/**
	* Return true if portfolio is active
	*
	* @since 1.0
	*/
	function themename_is_portfolio_active( $control ) {
		$enable = $control->manager->get_setting( 'themename_portfolio_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( themename_is_ect_portfolio_active( $control ) && themename_check_section( $enable ) );
	}
endif;


if ( ! function_exists( 'themename_is_ect_portfolio_inactive' ) ) :
    /**
    *
    * @since 1.0
    */
    function themename_is_ect_portfolio_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

if ( ! function_exists( 'themename_is_ect_portfolio_active' ) ) :
    /**
    *
    * @since 1.0
    */
    function themename_is_ect_portfolio_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;
