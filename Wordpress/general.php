<?php
/**
 * General functions.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'themename_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'themename_scripts' );
	/**
	 * Enqueue scripts and styles
	 */
	function themename_scripts() {
		$themename_settings = wp_parse_args(
			get_option( 'themename_settings', array() ),
			themename_get_defaults()
		);

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$dir_uri = get_template_directory_uri();

		wp_enqueue_style( 'themename-style-grid', $dir_uri . "/css/unsemantic-grid{$suffix}.css", false, themename_VERSION, 'all' );
		wp_enqueue_style( 'themename-style', $dir_uri . "/style{$suffix}.css", array( 'themename-style-grid' ), themename_VERSION, 'all' );
		wp_enqueue_style( 'themename-mobile-style', $dir_uri . "/css/mobile{$suffix}.css", array( 'themename-style' ), themename_VERSION, 'all' );

		if ( is_child_theme() ) {
			wp_enqueue_style( 'themename-child', get_stylesheet_uri(), array( 'themename-style' ), filemtime( get_stylesheet_directory() . '/style.css' ), 'all' );
		}

		wp_enqueue_style( 'font-awesome', $dir_uri . "/css/font-awesome{$suffix}.css", false, '5.1', 'all' );

		if ( function_exists( 'wp_script_add_data' ) ) {
			wp_enqueue_script( 'themename-classlist', $dir_uri . "/js/classList{$suffix}.js", array(), themename_VERSION, true );
			wp_script_add_data( 'themename-classlist', 'conditional', 'lte IE 11' );
		}

		wp_enqueue_script( 'themename-menu', $dir_uri . "/js/menu{$suffix}.js", array( 'jquery'), themename_VERSION, true );
		wp_enqueue_script( 'themename-a11y', $dir_uri . "/js/a11y{$suffix}.js", array(), themename_VERSION, true );
		wp_enqueue_script( 'themename-menu-control', $dir_uri . "/js/menu-control.js", array( 'jquery'), themename_VERSION, true );

		if ( 'click' == $themename_settings[ 'nav_dropdown_type' ] || 'click-arrow' == $themename_settings[ 'nav_dropdown_type' ] ) {
			wp_enqueue_script( 'themename-dropdown-click', $dir_uri . "/js/dropdown-click{$suffix}.js", array( 'themename-menu' ), themename_VERSION, true );
		}

		if ( 'enable' == $themename_settings['nav_search'] ) {
			wp_enqueue_script( 'themename-navigation-search', $dir_uri . "/js/navigation-search{$suffix}.js", array( 'themename-menu' ), themename_VERSION, true );
		}

		if ( 'enable' == $themename_settings['back_to_top'] ) {
			wp_enqueue_script( 'themename-back-to-top', $dir_uri . "/js/back-to-top{$suffix}.js", array(), themename_VERSION, true );
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

if ( ! function_exists( 'themename_widgets_init' ) ) {
	add_action( 'widgets_init', 'themename_widgets_init' );
	/**
	 * Register widgetized area and update sidebar with default widgets
	 */
	function themename_widgets_init() {
		$widgets = array(
			'sidebar-1' => __( 'Right Sidebar', 'themename' ),
			'sidebar-2' => __( 'Left Sidebar', 'themename' ),
			'header' => __( 'Header', 'themename' ),
			'footer-1' => __( 'Footer Widget 1', 'themename' ),
			'footer-2' => __( 'Footer Widget 2', 'themename' ),
			'footer-3' => __( 'Footer Widget 3', 'themename' ),
			'footer-4' => __( 'Footer Widget 4', 'themename' ),
			'footer-5' => __( 'Footer Widget 5', 'themename' ),
			'footer-bar' => __( 'Footer Bar','themename' ),
			'top-bar' => __( 'Top Bar','themename' ),
		);

		foreach ( $widgets as $id => $name ) {
			register_sidebar( array(
				'name'          => $name,
				'id'            => $id,
				'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => apply_filters( 'themename_start_widget_title', '<h2 class="widget-title">' ),
				'after_title'   => apply_filters( 'themename_end_widget_title', '</h2>' ),
			) );
		}
	}
}

if ( ! function_exists( 'themename_smart_content_width' ) ) {
	add_action( 'wp', 'themename_smart_content_width' );
	/**
	 * Set the $content_width depending on layout of current page
	 * Hook into "wp" so we have the correct layout setting from themename_get_layout()
	 * Hooking into "after_setup_theme" doesn't get the correct layout setting
	 */
	function themename_smart_content_width() {
		global $content_width;

		$container_width = themename_get_setting( 'container_width' );
		$right_sidebar_width = apply_filters( 'themename_right_sidebar_width', '25' );
		$left_sidebar_width = apply_filters( 'themename_left_sidebar_width', '25' );
		$layout = themename_get_layout();

		if ( 'left-sidebar' == $layout ) {
			$content_width = $container_width * ( ( 100 - $left_sidebar_width ) / 100 );
		} elseif ( 'right-sidebar' == $layout ) {
			$content_width = $container_width * ( ( 100 - $right_sidebar_width ) / 100 );
		} elseif ( 'no-sidebar' == $layout ) {
			$content_width = $container_width;
		} else {
			$content_width = $container_width * ( ( 100 - ( $left_sidebar_width + $right_sidebar_width ) ) / 100 );
		}
	}
}

if ( ! function_exists( 'themename_page_menu_args' ) ) {
	add_filter( 'wp_page_menu_args', 'themename_page_menu_args' );
	/**
	 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	 *
	 *
	 * @param array $args The existing menu args.
	 * @return array Menu args.
	 */
	function themename_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
}

if ( ! function_exists( 'themename_disable_title' ) ) {
	add_filter( 'themename_show_title', 'themename_disable_title' );
	/**
	 * Remove our title if set.
	 *
	 *
	 * @return bool Whether to display the content title.
	 */
	function themename_disable_title() {
		global $post;

		$disable_headline = ( isset( $post ) ) ? get_post_meta( $post->ID, '_themename-disable-headline', true ) : '';

		if ( ! empty( $disable_headline ) && false !== $disable_headline ) {
			return false;
		}

		return true;
	}
}

if ( ! function_exists( 'themename_resource_hints' ) ) {
	add_filter( 'wp_resource_hints', 'themename_resource_hints', 10, 2 );
	/**
	 * Add resource hints to our Google fonts call.
	 *
	 *
	 * @param array  $urls           URLs to print for resource hints.
	 * @param string $relation_type  The relation type the URLs are printed.
	 * @return array $urls           URLs to print for resource hints.
	 */
	function themename_resource_hints( $urls, $relation_type ) {
		if ( wp_style_is( 'themename-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
			if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
				$urls[] = array(
					'href' => 'https://fonts.gstatic.com',
					'crossorigin',
				);
			} else {
				$urls[] = 'https://fonts.gstatic.com';
			}
		}
		return $urls;
	}
}

if ( ! function_exists( 'themename_remove_caption_padding' ) ) {
	add_filter( 'img_caption_shortcode_width', 'themename_remove_caption_padding' );
	/**
	 * Remove WordPress's default padding on images with captions
	 *
	 * @param int $width Default WP .wp-caption width (image width + 10px)
	 * @return int Updated width to remove 10px padding
	 */
	function themename_remove_caption_padding( $width ) {
		return $width - 10;
	}
}

if ( ! function_exists( 'themename_enhanced_image_navigation' ) ) {
	add_filter( 'attachment_link', 'themename_enhanced_image_navigation', 10, 2 );
	/**
	 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
	 */
	function themename_enhanced_image_navigation( $url, $id ) {
		if ( ! is_attachment() && ! wp_attachment_is_image( $id ) ) {
			return $url;
		}

		$image = get_post( $id );
		if ( ! empty( $image->post_parent ) && $image->post_parent != $id ) {
			$url .= '#main';
		}

		return $url;
	}
}

if ( ! function_exists( 'themename_categorized_blog' ) ) {
	/**
	 * Determine whether blog/site has more than one category.
	 *
	 *
	 * @return bool True of there is more than one category, false otherwise.
	 */
	function themename_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'themename_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'themename_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so twentyfifteen_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so twentyfifteen_categorized_blog should return false.
			return false;
		}
	}
}

if ( ! function_exists( 'themename_category_transient_flusher' ) ) {
	add_action( 'edit_category', 'themename_category_transient_flusher' );
	add_action( 'save_post',     'themename_category_transient_flusher' );
	/**
	 * Flush out the transients used in {@see themename_categorized_blog()}.
	 *
	 */
	function themename_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'themename_categories' );
	}
}

add_filter( 'themename_fontawesome_essentials', 'themename_set_font_awesome_essentials' );
/**
 * Check to see if we should include the full Font Awesome library or not.
 *
 *
 * @param bool $essentials
 * @return bool
 */
function themename_set_font_awesome_essentials( $essentials ) {
	if ( themename_get_setting( 'font_awesome_essentials' ) ) {
		return true;
	}

	return $essentials;
}