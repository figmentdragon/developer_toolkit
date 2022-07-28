<?php
/**
 * Header Media Options
 *
 * @package THEMENAME
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'TheThemeName' );

	register_option( $wp_customize, array(
			'name'              => 'header_media_option',
			'default'           => 'entire-site',
			'sanitize_callback' => 'sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'TheThemeName' ),
				'exclude-home'           => esc_html__( 'Excluding Homepage', 'TheThemeName' ),
				'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'TheThemeName' ),
				'entire-site'            => esc_html__( 'Entire Site', 'TheThemeName' ),
				'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'TheThemeName' ),
				'pages-posts'            => esc_html__( 'Pages and Posts', 'TheThemeName' ),
				'disable'                => esc_html__( 'Disabled', 'TheThemeName' ),
			),
			'label'             => esc_html__( 'Enable on', 'TheThemeName' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	/* Scroll Down option */
	register_option( $wp_customize, array(
			'name'              => 'header_media_scroll_down',
			'sanitize_callback' => 'sanitize_checkbox',
			'default'           => 1,
			'label'             => esc_html__( 'Scroll Down Button', 'TheThemeName' ),
			'section'           => 'header_image',
			'custom_control'    => 'Toggle_Control',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'header_media_image_position_desktop',
			'default'           => 'center center',
			'sanitize_callback' => 'sanitize_select',
			'label'             => esc_html__( 'Image Position (Desktop View)', 'TheThemeName' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'choices'           => array(
				'left top'      => esc_html__( 'Left Top', 'TheThemeName' ),
				'left center'   => esc_html__( 'Left Center', 'TheThemeName' ),
				'left bottom'   => esc_html__( 'Left Bottom', 'TheThemeName' ),
				'right top'     => esc_html__( 'Right Top', 'TheThemeName' ),
				'right center'  => esc_html__( 'Right Center', 'TheThemeName' ),
				'right bottom'  => esc_html__( 'Right Bottom', 'TheThemeName' ),
				'center top'    => esc_html__( 'Center Top', 'TheThemeName' ),
				'center center' => esc_html__( 'Center Center', 'TheThemeName' ),
				'center bottom' => esc_html__( 'Center Bottom', 'TheThemeName' ),
			),
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'header_media_image_position_mobile',
			'default'           => 'center center',
			'sanitize_callback' => 'sanitize_select',
			'label'             => esc_html__( 'Image Position (Mobile View)', 'TheThemeName' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'choices'           => array(
				'left top'      => esc_html__( 'Left Top', 'TheThemeName' ),
				'left center'   => esc_html__( 'Left Center', 'TheThemeName' ),
				'left bottom'   => esc_html__( 'Left Bottom', 'TheThemeName' ),
				'right top'     => esc_html__( 'Right Top', 'TheThemeName' ),
				'right center'  => esc_html__( 'Right Center', 'TheThemeName' ),
				'right bottom'  => esc_html__( 'Right Bottom', 'TheThemeName' ),
				'center top'    => esc_html__( 'Center Top', 'TheThemeName' ),
				'center center' => esc_html__( 'Center Center', 'TheThemeName' ),
				'center bottom' => esc_html__( 'Center Bottom', 'TheThemeName' ),
			),
		)
	);

	/*Overlay Option for Header Media*/
	register_option( $wp_customize, array(
			'name'              => 'header_media_image_opacity',
			'default'           => '0',
			'sanitize_callback' => 'sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'TheThemeName' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'header_media_text_alignment',
			'default'           => 'text-align-left',
			'sanitize_callback' => 'sanitize_select',
			'choices'           => array(
				'text-align-center' => esc_html__( 'Center', 'TheThemeName' ),
				'text-align-right'  => esc_html__( 'Right', 'TheThemeName' ),
				'text-align-left'   => esc_html__( 'Left', 'TheThemeName' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'TheThemeName' ),
			'section'           => 'header_image',
			'type'              => 'radio',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'header_media_content_alignment',
			'default'           => 'content-align-right',
			'sanitize_callback' => 'sanitize_select',
			'choices'           => array(
				'content-align-center' => esc_html__( 'Center', 'TheThemeName' ),
				'content-align-right'  => esc_html__( 'Right', 'TheThemeName' ),
				'content-align-left'   => esc_html__( 'Left', 'TheThemeName' ),
			),
			'label'             => esc_html__( 'Content Alignment', 'TheThemeName' ),
			'section'           => 'header_image',
			'type'              => 'radio',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'header_media_logo',
			'sanitize_callback' => 'esc_url_raw',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Header Media Logo', 'TheThemeName' ),
			'section'           => 'header_image',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'header_media_logo_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'sanitize_select',
			'active_callback'   => 'is_header_media_logo_active',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'TheThemeName' ),
				'entire-site'            => esc_html__( 'Entire Site', 'TheThemeName' ) ),
			'label'             => esc_html__( 'Enable Header Media logo on', 'TheThemeName' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'header_media_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Tagline', 'TheThemeName' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    register_option( $wp_customize, array(
			'name'              => 'header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'TheThemeName' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Site Header Text', 'TheThemeName' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'header_media_url',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'TheThemeName' ),
			'section'           => 'header_image',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'TheThemeName' ),
			'section'           => 'header_image',
		)
	);

	register_option( $wp_customize, array(
			'name'              => 'header_url_target',
			'sanitize_callback' => 'sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'TheThemeName' ),
			'section'           => 'header_image',
			'custom_control'    => 'Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'header_media_options' );

/** Active Callback Functions */

if ( ! function_exists( 'is_header_media_logo_active' ) ) :
	/**
	* Return true if header logo is active
	*
	* @since 1.0
	*/
	function is_header_media_logo_active( $control ) {
		$logo = $control->manager->get_setting( 'header_media_logo' )->value();
		if ( '' != $logo ) {
			return true;
		} else {
			return false;
		}
	}
endif;
