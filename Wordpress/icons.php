<?php
/**
 * SVG icons related functions and filters
 *
 * @package creativity_
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add SVG definitions to footer.
 *
 * @author WebDevStudios
 */
function creativity_include_svg_icons() {
	// Define SVG sprite file.
	$svg_icons = get_template_directory() . '/build/images/icons/sprite.svg';

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		echo '<div class="svg-sprite-wrapper">';
		require_once $svg_icons;
		echo '</div>';
	}
}

/**
 * Return SVG markup.
 *
 * @param string $icon SVG icon id.
 * @return string $svg SVG markup.
 */
function creativity_get_svg( $icon = null ) {
	// Return early if no icon was defined.
	if ( empty( $icon ) ) {
		return;
	}

	// Create SVG markup.
	$svg = '<svg class="icon icon-' . esc_attr( $icon ) . '" aria-hidden="true" role="img">';
	$svg .= ' <use xlink:href="' . get_parent_theme_file_uri( '/assets/icons/genericons-neue.svg#' ) . esc_attr( $icon ) . '"></use> ';
	$svg .= '</svg>';

	return $svg;
}

/**
 * Add dropdown icon if menu item has children.
 *
 * @param  string $title The menu item's title.
 * @param  object $item  The current menu item.
 * @param  array  $args  An array of wp_nav_menu() arguments.
 * @param  int    $depth Depth of menu item. Used for padding.
 * @return string $title The menu item's title with dropdown icon.
 */
 function creativity_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
   if ( 'primary' === $args->theme_location ) {
     foreach ( $item->classes as $value ) {
       if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
         $title = $title . '<span class="sub-menu-icon">' . creativity_get_svg( 'expand' ) . '</span>';
       }
     }
   }
   return $title;
 }

/**
 * Return SVG markup for social icons.
 *
 * @param string $icon SVG icon id.
 * @return string $svg SVG markup.
 */
function creativity_get_social_svg( $icon = null ) {
	// Return early if no icon was defined.
	if ( empty( $icon ) ) {
		return;
	}

	// Create SVG markup.
	$svg = '<svg class="icon icon-' . esc_attr( $icon ) . '" aria-hidden="true" role="img">';
	$svg .= ' <use xlink:href="' . get_parent_theme_file_uri( '/assets/icons/social-icons.svg#icon-' ) . esc_attr( $icon ) . '"></use> ';
	$svg .= '</svg>';

	return $svg;
}

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function creativity_social_icons_menu( $item_output, $item, $depth, $args ) {

	// Get supported social icons.
	$social_icons = creativity_supported_social_icons();

	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'top-social' === $args->theme_location ) {
		$icon = 'star';
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$icon = esc_attr( $value );
			}
		}
		$item_output = str_replace( $args->link_after, '</span>' . creativity_get_social_svg( $icon ), $item_output );
	}

	return $item_output;
}

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function creativity_supported_social_icons() {
	// Supported branded social links icons and do not require translation.
    // The wordpress must be lowercase as this references a font icon
	$supported_social_icons = array(
		'500px.com'       => '500px',
		'amazon'          => 'amazon',
		'apple'           => 'apple',
		'bandcamp.com'    => 'bandcamp',
		'behance.net'     => 'behance',
		'bitbucket.org'   => 'bitbucket',
		'codepen.io'      => 'codepen',
		'deviantart.com'  => 'deviantart',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'etsy.com'        => 'etsy',
		'facebook.com'    => 'facebook',
		'feed'            => 'feed',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'google-plus',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'envelope-o',
		'medium.com'      => 'medium',
		'meetup.com'      => 'meetup',
		'pinterest.com'   => 'pinterest-p',
		'getpocket.com'   => 'get-pocket',
		'reddit.com'      => 'reddit-alien',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'slideshare.net'  => 'slideshare',
		'snapchat.com'    => 'snapchat-ghost',
		'soundcloud.com'  => 'soundcloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'vine.co'         => 'vine',
		'vk.com'          => 'vk',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'xing.com'        => 'xing',
		'yelp.com'        => 'yelp',
		'youtube.com'     => 'youtube',
	);

	return $supported_social_icons;
}
