<?php
/**
 * WooCommerce customizer settings.
 *
 * @package THEMENAME
 * @subpackage Integration/WooCommerce
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

// Load textdomain. This is required to make strings translatable.
load_theme_textdomain( 'TheThemeName' );

/**
 * Setup.
 *
 * @param object $wp_customize The wp_customize object.
 */
function woo_customizer_setup( $wp_customize ) {

	// Reorder sections.
	$wp_customize->get_section( 'woocommerce_store_notice' )->priority    = 10;
	$wp_customize->get_section( 'woocommerce_product_images' )->priority  = 20;
	$wp_customize->get_section( 'woocommerce_product_catalog' )->priority = 30;
	$wp_customize->get_section( 'woocommerce_checkout' )->priority        = 50;

	// Change section title.
	$wp_customize->get_section( 'woocommerce_product_catalog' )->title = __( 'Shop Page', 'TheThemeName' );

}
add_action( 'customize_register', 'woo_customizer_setup', 20 );

/* Sections */

// Menu item.
Kirki::add_section( 'woocommerce_menu_item_options', array(
	'title'    => __( 'Cart Menu Item', 'TheThemeName' ),
	'panel'    => 'woocommerce',
	'priority' => 25,
) );

// Product page.
Kirki::add_section( 'woocommerce_product_options', array(
	'title'    => __( 'Product Page', 'TheThemeName' ),
	'panel'    => 'woocommerce',
	'priority' => 40,
) );

// Sidebar.
Kirki::add_section( 'woocommerce_sidebar_options', array(
	'title'    => __( 'Sidebar', 'TheThemeName' ),
	'panel'    => 'woocommerce',
	'priority' => 60,
) );

// Notices.
Kirki::add_section( 'woocommerce_notices_options', array(
	'title'    => __( 'Notices', 'TheThemeName' ),
	'panel'    => 'woocommerce',
	'priority' => 70,
) );

/* Fields - Menu Item */

// Hide from non WooCommerce pages.
Kirki::add_field( 'TheThemeName', array(
	'type'        => 'toggle',
	'settings'    => 'woocommerce_menu_item_hide_if_not_wc',
	'label'       => __( 'Hide from non-Shop Pages', 'TheThemeName' ),
	'description' => __( 'Display Menu Item only on WooCommerce related pages', 'TheThemeName' ),
	'section'     => 'woocommerce_menu_item_options',
	'default'     => 0,
	'priority'    => 5,
) );

// Turn search into product search.
Kirki::add_field( 'TheThemeName', array(
	'type'        => 'toggle',
	'settings'    => 'woocommerce_search_menu_item',
	'label'       => __( 'Product Search', 'TheThemeName' ),
	'description' => __( 'Turn the Search Menu Item into a Product Search', 'TheThemeName' ),
	'section'     => 'woocommerce_menu_item_options',
	'default'     => 0,
	'priority'    => 5,
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_search_menu_item_separator',
	'section'  => 'woocommerce_menu_item_options',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => 5,
) );

// Menu item.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'select',
	'settings'        => 'woocommerce_menu_item_desktop',
	'label'           => __( 'Visibility (Desktop)', 'TheThemeName' ),
	'description'     => __( 'Adds a Cart Icon to your Main Navigation', 'TheThemeName' ),
	'section'         => 'woocommerce_menu_item_options',
	'default'         => 'show',
	'priority'        => 10,
	'multiple'        => 1,
	'choices'         => array(
		'show' => __( 'Show', 'TheThemeName' ),
		'hide' => __( 'Hide', 'TheThemeName' ),
	),
	'partial_refresh' => array(
		'woocommerce_menu_item_desktop' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Menu item color.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'color',
	'settings'        => 'woocommerce_menu_item_desktop_color',
	'label'           => __( 'Color', 'TheThemeName' ),
	'section'         => 'woocommerce_menu_item_options',
	'default'         => '',
	'priority'        => 11,
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_menu_item_desktop',
			'operator' => '!=',
			'value'    => 'hide',
		),
		array(
			'setting'  => 'woocommerce_menu_item_count',
			'operator' => '!=',
			'value'    => 'hide',
		),
	),
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_menu_item_separator_1',
	'section'  => 'woocommerce_menu_item_options',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => 12,
) );

// Mobile menu item.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'select',
	'settings'        => 'woocommerce_menu_item_mobile',
	'label'           => __( 'Visibility (Mobile)', 'TheThemeName' ),
	'description'     => __( 'Adds a Cart Icon to your Mobile Navigation', 'TheThemeName' ),
	'section'         => 'woocommerce_menu_item_options',
	'default'         => 'show',
	'priority'        => 13,
	'multiple'        => 1,
	'choices'         => array(
		'show' => __( 'Show', 'TheThemeName' ),
		'hide' => __( 'Hide', 'TheThemeName' ),
	),
	'partial_refresh' => array(
		'woocommerce_menu_item_mobile' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

// Menu item color.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'color',
	'settings'        => 'woocommerce_menu_item_mobile_color',
	'label'           => __( 'Color', 'TheThemeName' ),
	'section'         => 'woocommerce_menu_item_options',
	'default'         => '',
	'priority'        => 14,
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_menu_item_mobile',
			'operator' => '!=',
			'value'    => 'hide',
		),
		array(
			'setting'  => 'woocommerce_menu_item_count',
			'operator' => '!=',
			'value'    => 'hide',
		),
	),
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_menu_item_separator_2',
	'section'  => 'woocommerce_menu_item_options',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => 15,
) );

// Menu item count.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'select',
	'settings'        => 'woocommerce_menu_item_count',
	'label'           => __( 'Count', 'TheThemeName' ),
	'section'         => 'woocommerce_menu_item_options',
	'default'         => 'show',
	'priority'        => 16,
	'multiple'        => 1,
	'choices'         => array(
		'show' => __( 'Show', 'TheThemeName' ),
		'hide' => __( 'Hide', 'TheThemeName' ),
	),
	'partial_refresh' => array(
		'woocommerce_menu_item_count' => array(
			'container_inclusive' => true,
			'selector'            => '#header',
			'render_callback'     => function () {
				return get_template_part( 'inc/template-parts/header' );
			},
		),
	),
) );

/* Fields - Product Page */

$product_priority = 0;

// Custom width.
Kirki::add_field( 'TheThemeName', array(
	'type'        => 'dimension',
	'label'       => __( 'Custom Content Width', 'TheThemeName' ),
	'settings'    => 'woocommerce_single_custom_width',
	'section'     => 'woocommerce_product_options',
	'description' => __( 'Default: 1200px', 'TheThemeName' ),
	'priority'    => $product_priority++,
	'transport'   => 'postMessage',
) );

// Alignment.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'radio-image',
	'settings'  => 'woocommerce_single_alignment',
	'label'     => __( 'Image Alignment', 'TheThemeName' ),
	'section'   => 'woocommerce_product_options',
	'default'   => 'left',
	'priority'  => $product_priority++,
	'multiple'  => 1,
	'transport' => 'postMessage',
	'choices'   => array(
		'left'  => THEME_URI . '/inc/customizer/img/align-left.jpg',
		'right' => THEME_URI . '/inc/customizer/img/align-right.jpg',
	),
) );

// Image container width.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'slider',
	'settings'  => 'woocommerce_single_image_width',
	'label'     => __( 'Image Width', 'TheThemeName' ),
	'section'   => 'woocommerce_product_options',
	'priority'  => $product_priority++,
	'default'   => 50,
	'transport' => 'postMessage',
	'choices'   => array(
		'min'  => '25',
		'max'  => '75',
		'step' => '1',
	),
) );

// Disable gallery zoom.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'toggle',
	'settings' => 'woocommerce_single_disable_gallery_zoom',
	'label'    => __( 'Disable Gallery Zoom', 'TheThemeName' ),
	'section'  => 'woocommerce_product_options',
	'priority' => $product_priority++,
	'default'  => false,
) );

// Disable gallery slider.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'toggle',
	'settings' => 'woocommerce_single_disable_gallery_slider',
	'label'    => __( 'Disable Gallery Slider', 'TheThemeName' ),
	'section'  => 'woocommerce_product_options',
	'priority' => $product_priority++,
	'default'  => false,
) );

// Disable gallery lightbox.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'toggle',
	'settings' => 'woocommerce_single_disable_gallery_lightbox',
	'label'    => __( 'Disable Gallery Lightbox', 'TheThemeName' ),
	'section'  => 'woocommerce_product_options',
	'priority' => $product_priority++,
	'default'  => false,
) );

// Summary separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'select',
	'settings' => 'woocommerce_single_summary_separator',
	'label'    => __( 'Summary Separator', 'TheThemeName' ),
	'section'  => 'woocommerce_product_options',
	'default'  => 'hide',
	'priority' => $product_priority++,
	'choices'  => array(
		'hide' => __( 'Hide', 'TheThemeName' ),
		'show' => __( 'Show', 'TheThemeName' ),
	),
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_single_quantity_separator',
	'section'  => 'woocommerce_product_options',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => $product_priority++,
) );

// Increase - Decrease button.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'select',
	'settings' => 'woocommerce_quantity_buttons',
	'label'    => __( 'Price Quantity Buttons (+/-)', 'TheThemeName' ),
	'section'  => 'woocommerce_product_options',
	'default'  => 'show',
	'priority' => $product_priority++,
	'choices'  => array(
		'show' => __( 'Show', 'TheThemeName' ),
		'hide' => __( 'Hide', 'TheThemeName' ),
	),
) );

// Price color.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'color',
	'settings'  => 'woocommerce_single_price_color',
	'label'     => __( 'Font Color', 'TheThemeName' ),
	'section'   => 'woocommerce_product_options',
	'transport' => 'postMessage',
	'default'   => '#3e4349',
	'priority'  => $product_priority++,
	'choices'   => array(
		'alpha' => true,
	),
) );

// Price font size.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'input_slider',
	'label'     => __( 'Font Size', 'TheThemeName' ),
	'settings'  => 'woocommerce_single_price_size',
	'section'   => 'woocommerce_product_options',
	'transport' => 'postMessage',
	'priority'  => $product_priority++,
	'default'   => '22px',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_single_tabs_separator',
	'section'  => 'woocommerce_product_options',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => $product_priority++,
) );

// Tabs layout.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'select',
	'settings' => 'woocommerce_single_tabs',
	'label'    => __( 'Tabs Layout', 'TheThemeName' ),
	'section'  => 'woocommerce_product_options',
	'default'  => 'default',
	'priority' => $product_priority++,
	'multiple' => 1,
	'choices'  => array(
		'default' => __( 'Default', 'TheThemeName' ),
		'modern'  => __( 'Modern', 'TheThemeName' ),
	),
) );

// Tabs background color.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'color',
	'settings'        => 'woocommerce_single_tabs_background_color',
	'label'           => __( 'Background Color', 'TheThemeName' ),
	'section'         => 'woocommerce_product_options',
	'default'         => '#e7e7ec',
	'priority'        => $product_priority++,
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_single_tabs',
			'operator' => '!=',
			'value'    => 'modern',
		),
	),
) );

// Tabs background color alt.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'color',
	'settings'        => 'woocommerce_single_tabs_background_color_alt',
	'label'           => __( 'Hover', 'TheThemeName' ),
	'section'         => 'woocommerce_product_options',
	'default'         => '#f5f5f7',
	'priority'        => $product_priority++,
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_single_tabs',
			'operator' => '!=',
			'value'    => 'modern',
		),
	),
) );

// Tabs background color active.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'color',
	'settings'        => 'woocommerce_single_tabs_background_color_active',
	'label'           => __( 'Active', 'TheThemeName' ),
	'section'         => 'woocommerce_product_options',
	'default'         => '#ffffff',
	'priority'        => $product_priority++,
	'transport'       => 'postMessage',
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_single_tabs',
			'operator' => '!=',
			'value'    => 'modern',
		),
	),
) );

// Tabs font color.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'color',
	'settings'  => 'woocommerce_single_tabs_font_color',
	'label'     => __( 'Font Color', 'TheThemeName' ),
	'section'   => 'woocommerce_product_options',
	'default'   => '#3e4349',
	'priority'  => $product_priority++,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Tabs hover color.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'color',
	'settings'  => 'woocommerce_single_tabs_font_color_alt',
	'label'     => __( 'Hover', 'TheThemeName' ),
	'section'   => 'woocommerce_product_options',
	'default'   => '',
	'priority'  => $product_priority++,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Tabs active color.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'color',
	'settings'  => 'woocommerce_single_tabs_font_color_active',
	'label'     => __( 'Active', 'TheThemeName' ),
	'section'   => 'woocommerce_product_options',
	'default'   => '',
	'priority'  => $product_priority++,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Tabs font size.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'input_slider',
	'label'     => __( 'Font Size', 'TheThemeName' ),
	'settings'  => 'woocommerce_single_tabs_font_size',
	'section'   => 'woocommerce_product_options',
	'transport' => 'postMessage',
	'priority'  => $product_priority++,
	'default'   => '16px',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_single_add_to_cart_ajax_separator',
	'section'  => 'woocommerce_product_options',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => $product_priority++,
) );

// Single add to cart ajax.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'toggle',
	'settings' => 'woocommerce_single_add_to_cart_ajax',
	'label'    => __( 'Enable AJAX add to cart button', 'TheThemeName' ),
	'section'  => 'woocommerce_product_options',
	'priority' => $product_priority++,
	'default'  => false,
) );

/* Fields - Sidebar */

// Shop sidebar layout.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'select',
	'settings' => 'woocommerce_sidebar_layout',
	'label'    => __( 'Shop Page Sidebar', 'TheThemeName' ),
	'section'  => 'woocommerce_sidebar_options',
	'default'  => 'none',
	'priority' => 0,
	'multiple' => 1,
	'choices'  => array(
		'right' => __( 'Right', 'TheThemeName' ),
		'left'  => __( 'Left', 'TheThemeName' ),
		'none'  => __( 'No Sidebar', 'TheThemeName' ),
	),
) );

// Product sidebar layout.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'select',
	'settings' => 'woocommerce_single_sidebar_layout',
	'label'    => __( 'Product Page Sidebar', 'TheThemeName' ),
	'section'  => 'woocommerce_sidebar_options',
	'default'  => 'none',
	'priority' => 1,
	'multiple' => 1,
	'choices'  => array(
		'right' => __( 'Right', 'TheThemeName' ),
		'left'  => __( 'Left', 'TheThemeName' ),
		'none'  => __( 'No Sidebar', 'TheThemeName' ),
	),
) );

/* Fields - Notices */

// Store notice color.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'color',
	'settings'        => 'woocommerce_store_notice_color',
	'label'           => __( 'Store Notice', 'TheThemeName' ),
	'section'         => 'woocommerce_store_notice',
	// The woocommerce_store_notice priority is 10.
	'priority'        => 10,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_demo_store',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_store_notice_separator',
	'section'  => 'woocommerce_store_notice',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => 100,
) );

// Info color.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'color',
	'settings'  => 'woocommerce_info_notice_color',
	'label'     => __( 'Info Notice', 'TheThemeName' ),
	'section'   => 'woocommerce_store_notice',
	'priority'  => 100,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Success color.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'color',
	'settings'  => 'woocommerce_message_notice_color',
	'label'     => __( 'Success Notice', 'TheThemeName' ),
	'section'   => 'woocommerce_store_notice',
	'default'   => '#4fe190',
	'priority'  => 100,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// Error color.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'color',
	'settings'  => 'woocommerce_error_notice_color',
	'label'     => __( 'Error Notice', 'TheThemeName' ),
	'section'   => 'woocommerce_store_notice',
	'default'   => '#ff6347',
	'priority'  => 100,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_general_notice_color_separator',
	'section'  => 'woocommerce_store_notice',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => 100,
) );

// General notice's background color.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'color',
	'settings'  => 'woocommerce_notice_bg_color',
	'label'     => __( 'Notice Bg Color', 'TheThemeName' ),
	'section'   => 'woocommerce_store_notice',
	'priority'  => 100,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

// General notice's text color.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'color',
	'settings'  => 'woocommerce_notice_text_color',
	'label'     => __( 'Notice Text Color', 'TheThemeName' ),
	'section'   => 'woocommerce_store_notice',
	'priority'  => 100,
	'transport' => 'postMessage',
	'choices'   => array(
		'alpha' => true,
	),
) );

/* Fields - Checkout */

// Alignment.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'select',
	'settings' => 'woocommerce_checkout_layout',
	'label'    => __( 'Layout', 'TheThemeName' ),
	'section'  => 'woocommerce_checkout',
	'default'  => 'default',
	'priority' => 1,
	'multiple' => 1,
	'choices'  => array(
		'default' => __( 'Default', 'TheThemeName' ),
		'side'    => __( 'Side by Side', 'TheThemeName' ),
	),
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_checkout_layout_separator',
	'section'  => 'woocommerce_checkout',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => 2,
) );

/* Fields - Product Loop */

$shop_priority = 20;

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_loop_separator_0',
	'section'  => 'woocommerce_product_catalog',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => $shop_priority++,
) );

// Custom width.
Kirki::add_field( 'TheThemeName', array(
	'type'        => 'dimension',
	'label'       => __( 'Custom Content Width', 'TheThemeName' ),
	'settings'    => 'woocommerce_loop_custom_width',
	'section'     => 'woocommerce_product_catalog',
	'description' => __( 'Default: 1200px', 'TheThemeName' ),
	'priority'    => $shop_priority++,
	'transport'   => 'postMessage',
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_loop_separator_1',
	'section'  => 'woocommerce_product_catalog',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => $shop_priority++,
) );

// Remove page title.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'toggle',
	'settings' => 'woocommerce_loop_remove_page_title',
	'label'    => __( 'Hide Page Title', 'TheThemeName' ),
	'section'  => 'woocommerce_product_catalog',
	'default'  => 0,
	'priority' => $shop_priority++,
) );

// Remove breadcrumbs.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'toggle',
	'settings' => 'woocommerce_loop_remove_breadcrumbs',
	'label'    => __( 'Hide Breadcrumbs', 'TheThemeName' ),
	'section'  => 'woocommerce_product_catalog',
	'default'  => 0,
	'priority' => $shop_priority++,
) );

// Remove result count.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'toggle',
	'settings' => 'woocommerce_loop_remove_result_count',
	'label'    => __( 'Hide Result Count', 'TheThemeName' ),
	'section'  => 'woocommerce_product_catalog',
	'default'  => 0,
	'priority' => $shop_priority++,
) );

// Remove ordering.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'toggle',
	'settings' => 'woocommerce_loop_remove_ordering',
	'label'    => __( 'Hide Ordering', 'TheThemeName' ),
	'section'  => 'woocommerce_product_catalog',
	'default'  => 0,
	'priority' => $shop_priority++,
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_loop_separator_2',
	'section'  => 'woocommerce_product_catalog',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => $shop_priority++,
) );

// Products per row.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'responsive_input',
	'settings' => 'woocommerce_loop_products_per_row',
	'label'    => __( 'Products per Row', 'TheThemeName' ),
	'section'  => 'woocommerce_product_catalog',
	'priority' => $shop_priority++,
	'default'  => json_encode(
		array(
			'desktop' => '4',
			'tablet'  => '2',
			'mobile'  => '1',
		)
	),
	'sanitize_callback' => kirki_sanitize_helper( 'absint' ),
) );

// Grid gap.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'select',
	'settings' => 'woocommerce_loop_grid_gap',
	'label'    => __( 'Grid Gap', 'TheThemeName' ),
	'section'  => 'woocommerce_product_catalog',
	'default'  => 'large',
	'priority' => $shop_priority++,
	'multiple' => 1,
	'choices'  => array(
		'small'    => __( 'Small', 'TheThemeName' ),
		'medium'   => __( 'Medium', 'TheThemeName' ),
		'large'    => __( 'Large', 'TheThemeName' ),
		'xlarge'   => __( 'xLarge', 'TheThemeName' ),
		'collapse' => __( 'Collapse', 'TheThemeName' ),
	),
) );

// Content alignment.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'radio-image',
	'settings'  => 'woocommerce_loop_content_alignment',
	'label'     => __( 'Content Alignment', 'TheThemeName' ),
	'section'   => 'woocommerce_product_catalog',
	'default'   => 'left',
	'priority'  => $shop_priority++,
	'multiple'  => 1,
	'transport' => 'postMessage',
	'choices'   => array(
		'left'   => THEME_URI . '/inc/customizer/img/align-left.jpg',
		'center' => THEME_URI . '/inc/customizer/img/align-center.jpg',
		'right'  => THEME_URI . '/inc/customizer/img/align-right.jpg',
	),
) );

// Product structure.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'sortable',
	'settings' => 'woocommerce_loop_sortable_content',
	'label'    => __( 'Structure', 'TheThemeName' ),
	'section'  => 'woocommerce_product_catalog',
	'default'  => array(
		'category',
		'title',
		'price',
		'add_to_cart',
	),
	'choices'  => array(
		'category'    => __( 'Category', 'TheThemeName' ),
		'title'       => __( 'Title', 'TheThemeName' ),
		'rating'      => __( 'Rating', 'TheThemeName' ),
		'price'       => __( 'Price', 'TheThemeName' ),
		'add_to_cart' => __( 'Add to Cart Button', 'TheThemeName' ),
		'excerpt'     => __( 'Short Description', 'TheThemeName' ),
	),
	'priority' => $shop_priority++,
) );

// Layout.
Kirki::add_field(
	'TheThemeName',
	array(
		'type'     => 'select',
		'settings' => 'woocommerce_loop_layout',
		'label'    => __( 'Layout', 'TheThemeName' ),
		'section'  => 'woocommerce_product_catalog',
		'default'  => 'default',
		'priority' => $shop_priority++,
		'choices'  => array(
			'default' => __( 'Default', 'TheThemeName' ),
			'list'    => __( 'List', 'TheThemeName' ),
		),
	)
);

// Alignment.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'radio-image',
	'settings'        => 'woocommerce_loop_image_alignment',
	'label'           => __( 'Image Alignment', 'TheThemeName' ),
	'section'         => 'woocommerce_product_catalog',
	'default'         => 'left',
	'priority'        => $shop_priority++,
	'multiple'        => 1,
	'transport'       => 'postMessage',
	'choices'         => array(
		'left'  => THEME_URI . '/inc/customizer/img/align-left.jpg',
		'right' => THEME_URI . '/inc/customizer/img/align-right.jpg',
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_loop_layout',
			'operator' => '==',
			'value'    => 'list',
		),
	),
) );

// Image container width.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'slider',
	'settings'        => 'woocommerce_loop_image_width',
	'label'           => __( 'Image Width', 'TheThemeName' ),
	'section'         => 'woocommerce_product_catalog',
	'priority'        => $shop_priority++,
	'default'         => 50,
	'transport'       => 'postMessage',
	'choices'         => array(
		'min'  => '25',
		'max'  => '75',
		'step' => '1',
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_loop_layout',
			'operator' => '==',
			'value'    => 'list',
		),
	),
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_loop_sale_separator',
	'section'  => 'woocommerce_product_catalog',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => $shop_priority++,
) );

// Sale position.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'select',
	'settings' => 'woocommerce_loop_sale_position',
	'label'    => __( 'Sale Badge', 'TheThemeName' ),
	'section'  => 'woocommerce_product_catalog',
	'default'  => 'outside',
	'priority' => $shop_priority++,
	'multiple' => 1,
	'choices'  => array(
		'none'    => __( 'Hide', 'TheThemeName' ),
		'outside' => __( 'Outside', 'TheThemeName' ),
		'inside'  => __( 'Inside', 'TheThemeName' ),
	),
) );

// Sale layout.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'select',
	'settings'        => 'woocommerce_loop_sale_layout',
	'label'           => __( 'Layout', 'TheThemeName' ),
	'section'         => 'woocommerce_product_catalog',
	'default'         => 'round',
	'priority'        => $shop_priority++,
	'multiple'        => 1,
	'choices'         => array(
		'round'  => __( 'Round', 'TheThemeName' ),
		'square' => __( 'Square', 'TheThemeName' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_loop_sale_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

// Sale alignment.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'radio-image',
	'settings'        => 'woocommerce_loop_sale_alignment',
	'label'           => __( 'Alignment', 'TheThemeName' ),
	'section'         => 'woocommerce_product_catalog',
	'default'         => 'left',
	'priority'        => $shop_priority++,
	'multiple'        => 1,
	'choices'         => array(
		'left'   => THEME_URI . '/inc/customizer/img/align-left.jpg',
		'center' => THEME_URI . '/inc/customizer/img/align-center.jpg',
		'right'  => THEME_URI . '/inc/customizer/img/align-right.jpg',
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_loop_sale_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

// Sale font size.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'input_slider',
	'label'           => __( 'Font Size', 'TheThemeName' ),
	'settings'        => 'woocommerce_loop_sale_font_size',
	'section'         => 'woocommerce_product_catalog',
	'transport'       => 'postMessage',
	'priority'        => $shop_priority++,
	'default'         => '14px',
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_loop_sale_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

// Sale background color.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'color',
	'settings'        => 'woocommerce_loop_sale_background_color',
	'label'           => __( 'Background Color', 'TheThemeName' ),
	'section'         => 'woocommerce_product_catalog',
	'transport'       => 'postMessage',
	'default'         => '#4fe190',
	'priority'        => $shop_priority++,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_loop_sale_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

// Sale color.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'color',
	'settings'        => 'woocommerce_loop_sale_font_color',
	'label'           => __( 'Font Color', 'TheThemeName' ),
	'section'         => 'woocommerce_product_catalog',
	'transport'       => 'postMessage',
	'default'         => '#fff',
	'priority'        => $shop_priority++,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_loop_sale_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_loop_title_separator',
	'section'  => 'woocommerce_product_catalog',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => $shop_priority++,
) );

// Title font size.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'input_slider',
	'label'     => __( 'Title Font Size', 'TheThemeName' ),
	'settings'  => 'woocommerce_loop_title_size',
	'section'   => 'woocommerce_product_catalog',
	'transport' => 'postMessage',
	'priority'  => $shop_priority++,
	'default'   => '16px',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
) );

// Title color.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'color',
	'settings'  => 'woocommerce_loop_title_color',
	'label'     => __( 'Font Color', 'TheThemeName' ),
	'section'   => 'woocommerce_product_catalog',
	'transport' => 'postMessage',
	'default'   => '#3e4349',
	'priority'  => $shop_priority++,
	'choices'   => array(
		'alpha' => true,
	),
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_loop_price_separator',
	'section'  => 'woocommerce_product_catalog',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => $shop_priority++,
) );

// Price font size.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'input_slider',
	'label'     => __( 'Price Font Size', 'TheThemeName' ),
	'settings'  => 'woocommerce_loop_price_size',
	'section'   => 'woocommerce_product_catalog',
	'transport' => 'postMessage',
	'priority'  => $shop_priority++,
	'default'   => '16px',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
) );

// Price color.
Kirki::add_field( 'TheThemeName', array(
	'type'      => 'color',
	'settings'  => 'woocommerce_loop_price_color',
	'label'     => __( 'Font Color', 'TheThemeName' ),
	'section'   => 'woocommerce_product_catalog',
	'transport' => 'postMessage',
	'default'   => '#3e4349',
	'priority'  => $shop_priority++,
	'choices'   => array(
		'alpha' => true,
	),
) );

// Separator.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'custom',
	'settings' => 'woocommerce_loop_out_of_stock_separator',
	'section'  => 'woocommerce_product_catalog',
	'default'  => '<hr style="border-top: 1px solid #ccc; border-bottom: 1px solid #f8f8f8">',
	'priority' => $shop_priority++,
) );

// Out of stock notice.
Kirki::add_field( 'TheThemeName', array(
	'type'     => 'select',
	'settings' => 'woocommerce_loop_out_of_stock_notice',
	'label'    => __( 'Out of Stock Notice', 'TheThemeName' ),
	'section'  => 'woocommerce_product_catalog',
	'default'  => 'show',
	'priority' => $shop_priority++,
	'multiple' => 1,
	'choices'  => array(
		'show' => __( 'Show', 'TheThemeName' ),
		'hide' => __( 'Hide', 'TheThemeName' ),
	),
) );

// Out of stock background color.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'color',
	'settings'        => 'woocommerce_loop_out_of_stock_background_color',
	'label'           => __( 'Background Color', 'TheThemeName' ),
	'section'         => 'woocommerce_product_catalog',
	'transport'       => 'postMessage',
	'default'         => 'rgba(0,0,0,.7)',
	'priority'        => $shop_priority++,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_loop_out_of_stock_notice',
			'operator' => '!=',
			'value'    => 'hide',
		),
	),
) );

// Out of stock color.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'color',
	'settings'        => 'woocommerce_loop_out_of_stock_font_color',
	'label'           => __( 'Font Color', 'TheThemeName' ),
	'section'         => 'woocommerce_product_catalog',
	'transport'       => 'postMessage',
	'default'         => '#fff',
	'priority'        => $shop_priority++,
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_loop_out_of_stock_notice',
			'operator' => '!=',
			'value'    => 'hide',
		),
	),
) );

// Out of stock font size.
Kirki::add_field( 'TheThemeName', array(
	'type'            => 'input_slider',
	'label'           => __( 'Font Size', 'TheThemeName' ),
	'settings'        => 'woocommerce_loop_out_of_stock_font_size',
	'section'         => 'woocommerce_product_catalog',
	'transport'       => 'postMessage',
	'priority'        => $shop_priority++,
	'default'         => '14px',
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'woocommerce_loop_out_of_stock_notice',
			'operator' => '!=',
			'value'    => 'hide',
		),
	),
) );
