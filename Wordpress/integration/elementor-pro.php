<?php
/**
 * Elementor Pro integration.
 *
 * @package THEMENAME
 * @subpackage Integration
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Register Elementor locations.
 *
 * @param object $elementor_theme_manager The elementor theme manager.
 */
function elementor_locations( $elementor_theme_manager ) {

	// Replace
	$elementor_theme_manager->register_location(
		'pre-header',
		[
			'label'        => __( 'Pre Header (Replace)', 'TheThemeName' ),
			'hook'         => 'before_header',
			'remove_hooks' => ['do_pre_header'],
		]
	);

	$elementor_theme_manager->register_location(
		'header',
		[
			'label'        => __( 'Header (Replace)', 'TheThemeName' ),
			'hook'         => 'header',
			'remove_hooks' => ['do_header'],
		]
	);

	$elementor_theme_manager->register_location(
		'footer',
		[
			'label'        => __( 'Footer (Replace)', 'TheThemeName' ),
			'hook'         => 'footer',
			'remove_hooks' => ['do_footer'],
		]
	);

	$elementor_theme_manager->register_location(
		'before-header',
		[
			'label'    => __( 'Before Header', 'TheThemeName' ) . ' (before_header)',
			'multiple' => true,
			'hook'     => 'before_header',
		]
	);

	$elementor_theme_manager->register_location(
		'after-header',
		[
			'label'    => __( 'After Header', 'TheThemeName' ) . ' (after_header)',
			'multiple' => true,
			'hook'     => 'after_header',
		]
	);

	// Hooks
	$elementor_theme_manager->register_location(
		'before-content',
		[
			'label'    => __( 'Before Content', 'TheThemeName' ) . ' (content_open)',
			'multiple' => true,
			'hook'     => 'content_open',
		]
	);

	$elementor_theme_manager->register_location(
		'after-content',
		[
			'label'    => __( 'After Content', 'TheThemeName' ) . ' (content_close)',
			'multiple' => true,
			'hook'     => 'content_close',
		]
	);

	$elementor_theme_manager->register_location(
		'before-inner-content',
		[
			'label'    => __( 'Before Inner Content', 'TheThemeName' ) . ' (inner_content_open)',
			'multiple' => true,
			'hook'     => 'inner_content_open',
		]
	);

	$elementor_theme_manager->register_location(
		'after-inner-content',
		[
			'label'    => __( 'After Inner Content', 'TheThemeName' ) . ' (inner_content_close)',
			'multiple' => true,
			'hook'     => 'inner_content_close',
		]
	);

	$elementor_theme_manager->register_location(
		'before-main-content',
		[
			'label'    => __( 'Before Main Content', 'TheThemeName' ) . ' (main_content_open)',
			'multiple' => true,
			'hook'     => 'main_content_open',
		]
	);

	$elementor_theme_manager->register_location(
		'after-main-content',
		[
			'label'    => __( 'After Main Content', 'TheThemeName' ) . ' (main_content_open)',
			'multiple' => true,
			'hook'     => 'main_content_open',
		]
	);

	$elementor_theme_manager->register_location(
		'before-footer',
		[
			'label'    => __( 'Before Footer', 'TheThemeName' ) . ' (before_footer)',
			'multiple' => true,
			'hook'     => 'before_footer',
		]
	);

	$elementor_theme_manager->register_location(
		'after-footer',
		[
			'label'    => __( 'After Footer', 'TheThemeName' ) . ' (after_footer)',
			'multiple' => true,
			'hook'     => 'after_footer',
		]
	);

	$elementor_theme_manager->register_location(
		'before-post',
		[
			'label'    => __( 'Before Post', 'TheThemeName' ) . ' (before_article)',
			'multiple' => true,
			'hook'     => 'before_article',
		]
	);

	$elementor_theme_manager->register_location(
		'after-post',
		[
			'label'    => __( 'After Post', 'TheThemeName' ) . ' (after_article)',
			'multiple' => true,
			'hook'     => 'after_article',
		]
	);

	$elementor_theme_manager->register_location(
		'before-sidebar',
		[
			'label'    => __( 'Before Sidebar', 'TheThemeName' ) . ' (sidebar_open)',
			'multiple' => true,
			'hook'     => 'sidebar_open',
		]
	);

	$elementor_theme_manager->register_location(
		'after-sidebar',
		[
			'label'    => __( 'After Sidebar', 'TheThemeName' ) . ' (sidebar_close)',
			'multiple' => true,
			'hook'     => 'sidebar_close',
		]
	);

}
add_action( 'elementor/theme/register_locations', 'elementor_locations' );
