<?php
/**
 * Theme mods.
 *
 * @package THEMENAE
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Excerpt length.
 *
 * @param integer $excerpt_length The excerpt length.
 *
 * @return integer The updated excerpt lenght.
 */
function excerpt_length( $excerpt_length ) {
	// Getting data from Customizer Options
	$excerpt_length = get_theme_mod( 'excerpt_lenght' );
	if ( empty( $excerpt_length ) ) {
		return $excerpt_length;
	}
	if ( is_admin() ) {
		return $length;
	}
	return $excerpt_length;
}
add_filter( 'excerpt_length', 'excerpt_length', 999 );

/**
 * Excerpt more.
 *
 * @param integer $excerpt_more The excerpt indicator.
 *
 * @return integer The updated excerpt indicator.
 */
function excerpt_more( $excerpt_more ) {

	$excerpt_more = get_theme_mod( 'excerpt_more' );
	if ( ! $excerpt_more ) {
		return $excerpt_more;
	}
	if ( is_admin() ) {
		return $excerpt_more;
	}
	return $excerpt_more;

	$more_tag_text = get_theme_mod( 'excerpt_more_text',  esc_html__( 'Continue reading', 'TheThemeName' ) );

  $link = sprintf( '<p class="more-link"><a class="button" href="%1$s" class="readmore">%2$s</a></p>',
  esc_url( get_permalink() ),
  /* translators: %s: Name of current post */
  wp_kses_data( $more_tag_text ) . '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
  );
	return $link;

}
add_filter( 'excerpt_more', 'excerpt_more', 999 );

/**
 * Filter 404 page title.
 *
 * @param string $title The page title.
 *
 * @return string The updated page title.
 */
function custom_404_title( $title ) {

	$custom_title = get_theme_mod( '404_headline' );

	if ( $custom_title ) {
		return $custom_title;
	}

	return $title;

}
add_filter( '404_headline', 'custom_404_title' );


/**
 * Filter 404 page text.
 *
 * @param string $text The page text.
 *
 * @return string The updated page text.
 */
function custom_404_text( $text ) {

	$custom_text = get_theme_mod( '404_text' );

	if ( $custom_text ) {
		return $custom_text;
	}

	return $text;

}
add_filter( '404_text', 'custom_404_text' );

/**
 * Hide search form from 404 page.
 */
function remove_404_search_form() {

	if ( is_404() && 'hide' === get_theme_mod( '404_search_form' ) ) {

		add_filter( 'get_search_form', '__return_false' );

	}

}
add_action( 'wp', 'remove_404_search_form' );

/**
 * Construct search menu item.
 *
 * @param boolean $is_inside_main_menu If we're inside the navigation.
 * @param boolean $is_mobile If we're on mobile.
 *
 * @return string The search menu item.
 */
function search_menu_item( $is_inside_main_menu = true, $is_mobile = false ) {

	$class = $is_mobile ? 'mobile-nav-item' : 'nav-item';

	// If we have a shop, let's call the product search form
	if ( class_exists( 'WooCommerce' ) && get_theme_mod( 'woocommerce_search_menu_item' ) ) {
		$search_form = get_product_search_form( $echo = false );
	} else {
		$search_form = get_search_form( $echo = false );
	}

	// Allow the search form to be filtered for more flexibility.
	$search_form = apply_filters( 'search_menu_item_form', $search_form );

	// We have a slightly different markup for the search menu item if it's being displayed outside the main menu.
	$search_item  = $is_inside_main_menu ? '<li class="menu-item menu-item-search" aria-haspopup="true" aria-expanded="false"><a href="javascript:void(0)" role="button">' : '<div class="' . $class . ' menu-item-search" aria-haspopup="true" aria-expanded="false" role="button">';
	$search_item .= '<span class="screen-reader-text">' . __( 'Search Toggle', 'TheThemeName' ) . '</span>';
	$search_item .= '<div class="menu-search">';
	$search_item .= $search_form;
	$search_item .= '</div>';

	if ( svg_enabled() ) {
		$search_item .= svg( 'search' );
	} else {
		$search_item .= '<i class="THEMENAEf THEMENAEf-search" aria-hidden="true"></i>';
	}

	$search_item .= $is_inside_main_menu ? '</a></li>' : '</div>';

	return $search_item;

}

/**
 * Add search menu item to main menu.
 *
 * @param string $items The menu items.
 * @param object $args The arguments.
 *
 * @return string The updated menu items.
 */
function search_menu_icon( $items, $args ) {

	// Stop here, if we have an off canvas menu.
	if ( is_off_canvas_menu() ) {
		return $items;
	}

	// Only add the search menu item to the main navigation and if it's enabled.
	if ( 'main_menu' === $args->theme_location && get_theme_mod( 'menu_search_icon' ) ) {
		$items .= search_menu_item();
	}

	return $items;

}
add_filter( 'wp_nav_menu_items', 'search_menu_icon', 20, 2 );

/**
 * Add search menu item to mobile menu.
 */
function search_menu_icon_mobile() {

	// Stop here if search menu item is turned off.
	if ( ! get_theme_mod( 'mobile_menu_search_icon' ) ) {
		return;
	}

	echo search_menu_item( $is_navigation = false, $is_mobile = true );

}
add_action( 'before_mobile_toggle', 'search_menu_icon_mobile', 20 );

/**
 * Custom breadcrumbs separator.
 *
 * @param string $separator The separator.
 *
 * @return string The updated separator.
 */
function breadcrumbs_custom_separator( $separator ) {

	$custom_separator = get_theme_mod( 'breadcrumbs_separator' );

	if ( $custom_separator ) {
		return $custom_separator;
	}

	return $separator;

}
add_filter( 'breadcrumbs_separator', 'breadcrumbs_custom_separator' );

/**
 * Categories title.
 *
 * @param string $title The categories title.
 *
 * @return string The updated categories title.
 */
function categories_title( $title ) {

	$cat_title = get_theme_mod( 'blog_categories_title' );

	if ( $cat_title ) {
		return $cat_title;
	}

	return $title;

}
add_filter( 'categories_title', 'categories_title' );

/**
 * Read more text.
 *
 * @param string $text The read more text.
 *
 * @return string The updated read more text.
 */
function read_more_text( $text ) {

	$read_more_text = get_theme_mod( 'blog_read_more_text' );

	if ( $read_more_text ) {
		return $read_more_text;
	}

	return $text;

}
add_filter( 'read_more_text', 'read_more_text' );

/**
 * Article meta separatpr.
 *
 * @param string $separator The separator.
 *
 * @return string The updated separator.
 */
function article_meta_separator( $separator ) {

	$blog_meta_separator = get_theme_mod( 'blog_meta_separator' );

	if ( $blog_meta_separator ) {
		return ' ' . $blog_meta_separator . ' ';
	}

	return $separator;

}
add_filter( 'article_meta_separator', 'article_meta_separator' );

/**
 * Custom mobile logo.
 *
 * @param string $logo_url The logo url.
 *
 * @return string The updated logo url.
 */
function mobile_logo( $logo_url ) {

	$custom_logo_url = get_theme_mod( 'menu_mobile_logo' );

	if ( $custom_logo_url ) {
		return $custom_logo_url;
	}

	return $logo_url;

}
add_filter( 'logo_mobile', 'mobile_logo' );

/**
 * Auto collapse mobile sub-menu navigation class.
 *
 * Add class to .navigation if auto collapse sub-menu enabled.
 */
function mobile_sub_menu_auto_collapse_class( $classes ) {

	return ( get_theme_mod( 'mobile_sub_menu_auto_collapse' ) ? $classes . ' mobile-sub-menu-auto-collapse' : $classes );

}
add_filter( 'navigation_classes', 'mobile_sub_menu_auto_collapse_class' );

/**
 * Add theme color meta tag to head.
 */
function theme_color_meta() {

	$theme_color         = false;
	$accent_color_global = get_theme_mod( 'accent_color_global' );
	$accent_color        = get_theme_mod( 'page_accent_color' );

	// If a global theme color is set, let's apply.
	if ( $accent_color_global ) {
		$theme_color = $accent_color_global;
	}

	// If accent color is set (which is more specific), let's apply this instead.
	if ( $accent_color ) {
		$theme_color = $accent_color;
	}

	// Allow to filter the theme color value for max flexibility.
	$theme_color = apply_filters( 'theme_color', $theme_color );

	// Stop here if we don't have a theme color.
	if ( ! $theme_color ) {
		return;
	}

	// Output.
	echo '<meta name="theme-color" content="' . $theme_color . '">';

}
add_action( 'wp_head', 'theme_color_meta' );
