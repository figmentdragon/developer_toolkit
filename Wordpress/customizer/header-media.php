<?php
/**
 * Header Media Options
 *
 * @package themename
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themename_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'themename' );

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_option',
			'default'           => 'entire-site',
			'sanitize_callback' => 'themename_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'themename' ),
				'exclude-home'           => esc_html__( 'Excluding Homepage', 'themename' ),
				'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'themename' ),
				'entire-site'            => esc_html__( 'Entire Site', 'themename' ),
				'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'themename' ),
				'pages-posts'            => esc_html__( 'Pages and Posts', 'themename' ),
				'disable'                => esc_html__( 'Disabled', 'themename' ),
			),
			'label'             => esc_html__( 'Enable on', 'themename' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	/* Scroll Down option */
	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_scroll_down',
			'sanitize_callback' => 'themename_sanitize_checkbox',
			'default'           => 1,
			'label'             => esc_html__( 'Scroll Down Button', 'themename' ),
			'section'           => 'header_image',
			'custom_control'    => 'themename_Toggle_Control',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_image_position_desktop',
			'default'           => 'center center',
			'sanitize_callback' => 'themename_sanitize_select',
			'label'             => esc_html__( 'Image Position (Desktop View)', 'themename' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'choices'           => array(
				'left top'      => esc_html__( 'Left Top', 'themename' ),
				'left center'   => esc_html__( 'Left Center', 'themename' ),
				'left bottom'   => esc_html__( 'Left Bottom', 'themename' ),
				'right top'     => esc_html__( 'Right Top', 'themename' ),
				'right center'  => esc_html__( 'Right Center', 'themename' ),
				'right bottom'  => esc_html__( 'Right Bottom', 'themename' ),
				'center top'    => esc_html__( 'Center Top', 'themename' ),
				'center center' => esc_html__( 'Center Center', 'themename' ),
				'center bottom' => esc_html__( 'Center Bottom', 'themename' ),
			),
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_image_position_mobile',
			'default'           => 'center center',
			'sanitize_callback' => 'themename_sanitize_select',
			'label'             => esc_html__( 'Image Position (Mobile View)', 'themename' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'choices'           => array(
				'left top'      => esc_html__( 'Left Top', 'themename' ),
				'left center'   => esc_html__( 'Left Center', 'themename' ),
				'left bottom'   => esc_html__( 'Left Bottom', 'themename' ),
				'right top'     => esc_html__( 'Right Top', 'themename' ),
				'right center'  => esc_html__( 'Right Center', 'themename' ),
				'right bottom'  => esc_html__( 'Right Bottom', 'themename' ),
				'center top'    => esc_html__( 'Center Top', 'themename' ),
				'center center' => esc_html__( 'Center Center', 'themename' ),
				'center bottom' => esc_html__( 'Center Bottom', 'themename' ),
			),
		)
	);

	/*Overlay Option for Header Media*/
	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_image_opacity',
			'default'           => '0',
			'sanitize_callback' => 'themename_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'themename' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_text_alignment',
			'default'           => 'text-align-left',
			'sanitize_callback' => 'themename_sanitize_select',
			'choices'           => array(
				'text-align-center' => esc_html__( 'Center', 'themename' ),
				'text-align-right'  => esc_html__( 'Right', 'themename' ),
				'text-align-left'   => esc_html__( 'Left', 'themename' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'themename' ),
			'section'           => 'header_image',
			'type'              => 'radio',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_content_alignment',
			'default'           => 'content-align-right',
			'sanitize_callback' => 'themename_sanitize_select',
			'choices'           => array(
				'content-align-center' => esc_html__( 'Center', 'themename' ),
				'content-align-right'  => esc_html__( 'Right', 'themename' ),
				'content-align-left'   => esc_html__( 'Left', 'themename' ),
			),
			'label'             => esc_html__( 'Content Alignment', 'themename' ),
			'section'           => 'header_image',
			'type'              => 'radio',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_logo',
			'sanitize_callback' => 'esc_url_raw',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Header Media Logo', 'themename' ),
			'section'           => 'header_image',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_logo_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'themename_sanitize_select',
			'active_callback'   => 'themename_is_header_media_logo_active',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'themename' ),
				'entire-site'            => esc_html__( 'Entire Site', 'themename' ) ),
			'label'             => esc_html__( 'Enable Header Media logo on', 'themename' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Tagline', 'themename' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'themename' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Site Header Text', 'themename' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_url',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'themename' ),
			'section'           => 'header_image',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'themename' ),
			'section'           => 'header_image',
		)
	);

	themename_register_option( $wp_customize, array(
			'name'              => 'themename_header_url_target',
			'sanitize_callback' => 'themename_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'themename' ),
			'section'           => 'header_image',
			'custom_control'    => 'themename_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'themename_header_media_options' );

/** Active Callback Functions */

if ( ! function_exists( 'themename_is_header_media_logo_active' ) ) :
	/**
	* Return true if header logo is active
	*
	* @since 1.0
	*/
	function themename_is_header_media_logo_active( $control ) {
		$logo = $control->manager->get_setting( 'themename_header_media_logo' )->value();
		if ( '' != $logo ) {
			return true;
		} else {
			return false;
		}
	}
endif;
