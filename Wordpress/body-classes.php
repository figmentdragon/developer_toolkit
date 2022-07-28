<?php
/**
 * Body classes.
 *
 * @package THEMENAE
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );


if ( ! function_exists( 'featured_overall_image' ) ) :
/**
 * Template for Featured Header Image from theme options
 *
 * To override this in a child theme
 * simply create your own featured_pagepost_image(), and that function will be used instead.
 *
 * @since 1.0
 */
	function featured_overall_image() {
		global $post;
		$enable = get_theme_mod( 'header_media_option', 'entire-site' );
			// Check Enable/Disable header image in Page/Post Meta box
		if ( is_singular() ) {
				//Individual Page/Post Image Setting
			$individual_featured_image = get_post_meta( $post->ID, 'darcie-single-post-page', true );

			if ( 'disable' === $individual_featured_image || ( 'default' === $individual_featured_image && 'disable' === $enable ) ) {
				return 'disable' ;
			} elseif ( 'enable' == $individual_featured_image && 'disable' === $enable ) {
				return featured_page_post_image();
			}
		}
			// Check Homepage
		if ( 'homepage' === $enable ) {
			if ( is_front_page() ) {
				return featured_image();
			}
		} elseif ( 'exclude-home' === $enable ) {
			// Check Excluding Homepage
			if ( ! is_front_page() ) {
				return featured_image();
			}
		} elseif ( 'exclude-home-page-post' === $enable ) {
			if ( is_front_page() ) {
				return 'disable';
			} elseif ( is_singular() || ( class_exists( 'WooCommerce' ) && is_shop() ) || ( is_home() && ! is_front_page() ) ) {
				return featured_page_post_image();
			} else {
				return featured_image();
			}
		} elseif ( 'entire-site' === $enable ) {
			// Check Entire Site
			return featured_image();
		} elseif ( 'entire-site-page-post' === $enable ) {
				// Check Entire Site (Post/Page)
			if ( is_singular() || ( class_exists( 'WooCommerce' ) && is_shop() ) || ( is_home() && ! is_front_page() ) ) {
				return featured_page_post_image();
			} else {
				return featured_image();
			}
		} elseif ( 'pages-posts' === $enable ) {
			// Check Page/Post
			if ( is_singular() ) {
				return featured_page_post_image();
			}
		}
			return 'disable';
	} // featured_overall_image
endif;


/**
 * Body classes.
 *
 * @param array $classes The body classes.
 *
 * @return array The updated body classes.
 */
function body_classes( $classes ) {
	// Adds a class with respect to layout selected.
	$layout  = get_theme_layout();
	$sidebar = get_sidebar_id();
	$sidebar_layout = sidebar_layout();
	$inner_content = inner_content( $echo = false );
	$enable_slider = check_section( get_theme_mod( 'slider_option', 'disabled' ) );
	$header_image = featured_overall_image();
	$settings = get_option( 'settings' );
	$layout_class = "no-sidebar content-width-layout";

	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_singular() ) {
		global $post;
		$classes[] = '' . $post->post_name;
	}

	// Always add a front-page class to the front page.
	if ( is_front_page() && ! is_home() ) {
		$classes[] = 'page-template-front-page';
	}

	if( is_front_page() && ! is_home() ) {
		$classes[] = 'blog';
	}

	// Adds a class of (full-width) to blogs.
	$classes[] = 'fluid-layout';
	$classes[] = $layout_class;
	$classes[] = 'excerpt';
	$classes[] = 'navigation-default';

	// Sidebar classes.
	$classes[] = 'none' === $sidebar_layout ? 'no-sidebar' : 'sidebar-' . $sidebar_layout;

	if ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'two-columns-layout content-left';
		}
	}

	if ( ! $inner_content ) {
		$classes[] = 'full-width';
	}

	if ( get_theme_mod( 'page_boxed' ) ) {
		$classes[] = 'boxed-layout';
	}

	$classes['color-scheme'] = esc_attr( 'color-scheme-' . get_theme_mod( 'color_scheme', 'default' ) );

	if ( 'disable' !== $header_image || $enable_slider ) {
		if ( 'disable' !== $header_image ) {
			$classes[] = 'has-header-media';
		}
		$classes[] = 'absolute-header';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Add a class if there is header media text.
	if ( has_header_media_text() ) {
		$classes[] = 'has-header-text';
	}

	$bg_dots 	    = 'enable';
	$blog_bg		= 'enable';

	if ( isset( $settings['bg_dots'] ) ) {
		$bg_dots = $settings['bg_dots'];
	}

	if ( isset( $settings['blog_bg'] ) ) {
		$blog_bg = $settings['blog_bg'];
	}

	// BG dots
	if ( $bg_dots != 'disable' ) {
		$classes[] = 'bg-dots';
	}

	// Blog post background
	if ( $blog_bg != 'disable' ) {
		$classes[] = 'blog-bg';
	}

	// Add THEMENAE body class.
	$classes[] = 'THEMENAE';

	// WooCommerce list layout.
	if ( 'list' === get_theme_mod( 'woocommerce_loop_layout' ) ) {
		$classes[] = 'woo-list-view';
	}

	return $classes;
}
add_filter( 'body_class', 'body_classes' );

if ( ! function_exists( 'body_classes' ) ) {
	add_filter( 'body_class', 'body_classes' );
	function body_classes( $classes ) {
		// Get Customizer settings

		return $classes;
	}
}
function post_classes( $classes ) {

	// Add post class to all posts.
	$classes[] = 'post';

	return $classes;

}
add_filter( 'post_class', 'post_classes' );

// Magic mouse
if ( ! function_exists( 'scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'scripts' );
	/**
	 * Enqueue scripts and styles
	 */
	function scripts() {

		$dir_uri = get_stylesheet_directory();
		// Get Customizer settings
		$settings = get_option( 'settings' );
		$magic_cursor  = 'enable';
		if ( isset( $settings['magic_cursor'] ) ) {
			$magic_cursor = $settings['magic_cursor'];
		}

		if ( $magic_cursor != 'disable' ) {
			wp_enqueue_style( 'magic-mouse', esc_url( $dir_uri ) . "/assets/scripts/css/min/magic-mouse.min.css", false, 'VERSION', 'all' );
			wp_enqueue_script( 'magic-mouse', esc_url( $dir_uri ) . "/assets/scripts/js/jQuery/magic-mouse.min.js", array( 'jquery'), 'VERSION', true );
		}
	}
}
