<?php
/**
 * Easy Digital Downloads functions.
 *
 * @package THEMENAME
 * @subpackage Integration/EDD
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Determine if we're on an EDD product page.
 *
 * @return boolean.
 */
function is_edd_single() {

	if ( is_singular( 'download' ) ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Determine if we're on an EDD archive page.
 *
 * @return boolean.
 */
function is_edd_archive() {

	if ( is_post_type_archive( 'download' ) || is_tax( 'download_category' ) || is_tax( 'download_tag' ) ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Determin if we're on an EDD page.
 *
 * @return boolean.
 */
function is_edd_page() {

	if ( is_singular( 'download' ) || is_post_type_archive( 'download' ) || is_tax( 'download_category' ) || is_tax( 'download_tag' ) || edd_is_checkout() || edd_is_success_page() || edd_is_failed_transaction_page() || edd_is_purchase_history_page() ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Register sidebars.
 */
function edd_sidebar() {

	// Shop page sidebar.
	register_sidebar( array(
		'id'            => 'edd-sidebar',
		'name'          => __( 'Easy Digital Downloads Sidebar', 'TheThemeName' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
		'description'   => __( 'Widgets in this area will be shown on EDD archive pages.', 'TheThemeName' ),
	) );

	// Product page sidebar.
	register_sidebar( array(
		'id'            => 'edd-product-sidebar',
		'name'          => __( 'Easy Digital Downloads Product Page Sidebar', 'TheThemeName' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
		'description'   => __( 'Widgets in this area will be shown on EDD product pages.', 'TheThemeName' ),
	) );

}
add_action( 'widgets_init', 'edd_sidebar' );

/**
 * Apply sidebars.
 *
 * @param string $sidebar The sidebar.
 *
 * @return string The updated sidebar.
 */
function edd_sidebars( $sidebar ) {

	if ( is_edd_archive() ) {

		$sidebar = 'edd-sidebar';

	} elseif ( is_edd_single() ) {

		$sidebar = 'edd-product-sidebar';

	}

	return $sidebar;

}
add_filter( 'do_sidebar', 'edd_sidebars' );

/**
 * Filter sidebar layout.
 *
 * @param string $sidebar The sidebar layout.
 *
 * @return string The updated sidebar layout.
 */
function edd_sidebar_layout( $sidebar ) {

	if ( is_edd_single() ) {

		$edd_single_sidebar_layout = get_theme_mod( 'edd_single_sidebar_layout', 'global' );
		$single_sidebar_layout     = get_post_meta( get_the_ID(), 'sidebar_position', true );

		if ( 'global' !== $edd_single_sidebar_layout ) {
			$sidebar = $edd_single_sidebar_layout;
		}

		if ( 'global' !== $single_sidebar_layout ) {
			$sidebar = $single_sidebar_layout;
		}

	}

	if ( is_edd_archive() ) {

		$edd_sidebar_layout = get_theme_mod( 'edd_sidebar_layout', 'global' );

		if ( 'global' !== $edd_sidebar_layout ) {
			$sidebar = $edd_sidebar_layout;
		}

	}

	return $sidebar;

}
add_filter( 'sidebar_layout', 'edd_sidebar_layout' );

/**
 * Construct cart menu item.
 */
function edd_menu_item( $markup = 'li' ) {

	if ( svg_enabled() ) {
		$icon = apply_filters( 'edd_menu_item_icon', svg( 'cart' )  );
	} else {
		$icon = apply_filters( 'edd_menu_item_icon', '<i class="themenamef themenamef-' . esc_attr( get_theme_mod( 'edd_menu_item_icon', 'cart' ) ) . '"></i>' );
	}

	$css_classes = apply_filters( 'edd_menu_item_classes', 'menu-item edd-menu-item' );
	$title       = apply_filters( 'edd_menu_item_title', __( 'Shopping Cart', 'TheThemeName' ) );
	$cart_count  = edd_get_cart_quantity();
	$cart_url    = edd_get_checkout_uri();

	// Construct.
	$menu_item = '<' . $markup . ' class="' . esc_attr( $css_classes ) . '">';

	$menu_item .= '<a href="' . esc_url( $cart_url ) . '" title="' . esc_attr( $title ) . '">';

	$menu_item .= '<span class="screen-reader-text">' . __( 'Shopping Cart', 'TheThemeName' ) . '</span>';

	$menu_item .= apply_filters( 'edd_before_menu_item', '' );

	$menu_item .= $icon;

	if ( 'hide' !== get_theme_mod( 'edd_menu_item_count' ) ) {
		$menu_item .= '<span class="edd-menu-item-count">' . wp_kses_data( $cart_count ) . '<span class="screen-reader-text">' . __( 'Items in Cart', 'TheThemeName' ) . '</span></span>';
	}

	$menu_item .= apply_filters( 'edd_after_menu_item', '' );

	$menu_item .= '</a>';

	$menu_item .= apply_filters( 'edd_menu_item_dropdown', '' );

	$menu_item .= '</' . $markup . '>';

	return $menu_item;

}

/**
 * Add cart menu item to main navigation.
 *
 * @param string $items The HTML list content for the menu items.
 * @param object $args The arguments.
 *
 * @return string The updated HTML.
 */
function edd_menu_icon( $items, $args ) {

	// Stop right here if menu item is hidden.
	if ( 'hide' === get_theme_mod( 'edd_menu_item_desktop' ) ) {
		return $items;
	}

	// Hide if we're on non-EDD pages.
	if ( get_theme_mod( 'edd_menu_item_hide_if_not_edd' ) && ! is_edd_page() ) {
		return $items;
	}

	// Stop here if we're on a off canvas menu.
	if ( is_off_canvas_menu() ) {
		return $items;
	}

	// Finally, add menu item to main menu.
	if ( 'main_menu' === $args->theme_location ) {
		$items .= edd_menu_item();
	}

	return $items;

}
add_filter( 'wp_nav_menu_items', 'edd_menu_icon', 10, 2 );

/**
 * Add cart menu item to mobile navigation.
 */
function edd_menu_icon_mobile() {

	// Stop right here if menu item is hidden.
	if ( 'hide' === get_theme_mod( 'edd_menu_item_mobile' ) ) {
		return;
	}

	// Hide if we're on non-EDD pages.
	if ( get_theme_mod( 'edd_menu_item_hide_if_not_edd' ) && ! is_edd_page() ) {
		return;
	}

	// Construct.
	$menu_item  = '<ul class="mobile-nav-item">';
	$menu_item .= edd_menu_item();
	$menu_item .= '</ul>';

	echo $menu_item;

}
add_action( 'before_mobile_toggle', 'edd_menu_icon_mobile' );

/**
 * EDD ajax.
 */
function edd_ajax() {

	wp_enqueue_script( 'edd-ajax', get_template_directory_uri() . '/assets/edd/js/edd-ajax.js', array( 'jquery' ), VERSION, true );

	wp_localize_script(
		'edd-ajax',
		'edd_fragments',
		array(
			'ajaxurl' => function_exists( 'edd_get_ajax_url' ) ? edd_get_ajax_url() : admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'edd_ajax_nonce' ),
		)
	);

}
add_action( 'wp_enqueue_scripts', 'edd_ajax' );

/**
 * EDD fragments.
 */
function edd_fragments() {

	check_ajax_referer( 'edd_ajax_nonce', 'security' );

	echo edd_menu_item();
	die();

}
add_action( 'wp_ajax_edd_fragments', 'edd_fragments' );
add_action( 'wp_ajax_nopriv_edd_fragments', 'edd_fragments' );

/**
 * Remove post navigation from EDD products.
 */
function edd_remove_post_navigation() {

	if ( ! is_singular( 'download' ) ) {
		return;
	}

	remove_action( 'post_links', 'do_post_links' );

}
add_action( 'wp', 'edd_remove_post_navigation' );
