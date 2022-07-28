<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package THEMENAME
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function portfolio_options( $wp_customize ) {
	// Add note to Jetpack Portfolio Section
	register_option( $wp_customize, array(
			'name'              => 'jetpack_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Note_Control',
			'label'             => sprintf( esc_html__( 'For Portfolio Options for THEMENAME Theme, go %1$shere%2$s', 'TheThemeName' ),
				 '<a href="javascript:wp.customize.section( \'portfolio\' ).focus();">',
				 '</a>'
			),
			'section'           => 'jetpack_portfolio',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'portfolio', array(
			'panel'    => 'theme_options',
			'title'    => esc_html__( 'Portfolio', 'TheThemeName' ),
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
            'name'              => 'portfolio_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Note_Control',
          	'active_callback'   => 'is_ect_portfolio_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Type Enabled', 'TheThemeName' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	register_option( $wp_customize, array(
			'name'              => 'portfolio_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'sanitize_select',
			'active_callback'   => 'is_ect_portfolio_active',
			'choices'           => section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'TheThemeName' ),
			'section'           => 'portfolio',
			'type'              => 'select',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Note_Control',
			'active_callback'   => 'is_portfolio_active',
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'TheThemeName' ),
				 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
				 '</a>'
			),
			'section'           => 'portfolio',
			'type'              => 'description',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'portfolio_number',
			'default'           => 6,
			'sanitize_callback' => 'sanitize_number_range',
			'active_callback'   => 'is_portfolio_active',
			'label'             => esc_html__( 'Number of items to show', 'TheThemeName' ),
			'section'           => 'portfolio',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'portfolio_number', 6 );

	for ( $i = 1; $i <= $number ; $i++ ) {
		//for CPT
		register_option( $wp_customize, array(
				'name'              => 'portfolio_cpt_' . $i,
				'sanitize_callback' => 'sanitize_post',
				'active_callback'   => 'is_portfolio_active',
				'label'             => esc_html__( 'Portfolio', 'TheThemeName' ) . ' ' . $i ,
				'section'           => 'portfolio',
				'type'              => 'select',
				'choices'           => generate_post_array( 'jetpack-portfolio' ),
			)
		);


	} // End for().

}
add_action( 'customize_register', 'portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'is_portfolio_active' ) ) :
	/**
	* Return true if portfolio is active
	*
	* @since THEMENAME 1.0
	*/
	function is_portfolio_active( $control ) {
		$enable = $control->manager->get_setting( 'portfolio_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( is_ect_portfolio_active( $control ) && check_section( $enable ) );
	}
endif;


if ( ! function_exists( 'is_ect_portfolio_inactive' ) ) :
    /**
    *
    * @since THEMENAME 1.0
    */
    function is_ect_portfolio_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

if ( ! function_exists( 'is_ect_portfolio_active' ) ) :
    /**
    *
    * @since THEMENAME 1.0
    */
    function is_ect_portfolio_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;
