<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package creativity
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function creativity_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) ) {
		$args['show_home'] = true;
		return $args;
	}
}
add_filter( 'wp_page_menu_args', 'creativity_page_menu_args' );

if ( ! is_admin() ) {
	/**
	 * Defines new blog excerpt length and link text.
	 *
	 * @param array $length Configuration arguments.
	 */
	function creativity_new_excerpt_length( $length ) {
		return 70;
	}
	add_filter( 'excerpt_length', 'creativity_new_excerpt_length' );

add_filter( 'the_excerpt', 'creativity_read_more_custom_excerpt' );
/**
 * Defines new blog excerpt length and link text.
 *
 * @param array $body-color Configuration arguments.
 */
function creativity_read_more_custom_excerpt( $body-color ) {
	if ( strpos( $body-color, '[&hellip;]' ) ) {
		$excerpt = str_replace( '[&hellip;]', '<a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'creativity' ) . '</a>', $body-color );
		} else {
		$excerpt = $body-color . '<a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'creativity' ) . '</a>';
	}
	return $excerpt;
	}
}

/**
 * Archives Titles
 *
 * @param array $title Configuration arguments.
 */
function creativity_get_the_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = get_the_date( _x( 'Y', 'yearly archives date format', 'creativity' ) );
	} elseif ( is_month() ) {
		$title = get_the_date( _x( 'F Y', 'monthly archives date format', 'creativity' ) );
	} elseif ( is_day() ) {
		$title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'creativity' ) );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} else {
		$title = esc_html__( 'Archives', 'creativity' );
	}
	return $title;
};
add_filter( 'get_the_archive_title', 'creativity_get_the_archive_title', 10, 1 );

/**
 * Defines new blog excerpt length and link text.
 *
 * @param array $item_output Configuration arguments.
 * @param array $item Configuration arguments.
 * @param array $depth Configuration arguments.
 * @param array $args Configuration arguments.
 */
function creativity_nav_description( $item_output, $item, $depth, $args ) {
	if ( ! empty( $item->description ) ) {
		$item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'creativity_nav_description', 10, 4 );

/**
 * Skip link function.
 */
function creativity_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#contentwrapper">' . esc_html__( 'Skip to the content', 'creativity' ) . '</a>';
}
add_action( 'wp_body_open', 'creativity_skip_link', 5 );

/**
 * Display admin notice.
 */
function creativity_notice() {
	global $current_user;
	$user_id = $current_user->ID;
	if ( ! get_user_meta( $user_id, 'creativity_notice_ignore' ) ) {
		echo '<div class="updated notice"><p>' . esc_html__( 'Thanks for installing creativity Lite! Want more features?', 'creativity' ) . '<a href="https://vivathemes.com/wordpress-theme/creativity/" target="blank">' . esc_html__( 'Check Out the Pro Version  &#8594;', 'creativity' ) . '</a><a class="notice-dismiss" href="?creativity-ignore-notice"><span class="screen-reader-text">Dismiss Notice</span></a></p></div>';
	}
}
add_action( 'admin_notices', 'creativity_notice' );

/**
 * Ignore admin notice.
 */
function creativity_notice_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	if ( isset( $_GET['creativity-ignore-notice'] ) ) {
		add_user_meta( $user_id, 'creativity_notice_ignore', 'true', true );
	}
}
add_action( 'admin_init', 'creativity_notice_ignore' );

add_action( 'admin_head', 'creativity_admin_style' );
/**
 * Style for nadmin notification.
 */
function creativity_admin_style() {
	echo '<style>
	.notice {position: relative;}
	a.notice-dismiss {text-decoration:none;}
	</style>';
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function creativity_body_classes( $classes ) {
	global $post;
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if( is_singular( array( 'post', 'page' )) ) {
		$post_sidebar = get_post_meta( $post->ID, 'creativity_sidebar_layout', true );
		if( empty( $post_sidebar ) ) {
			$classes[] = 'right_sidebar';
		}else{
			$classes[] = $post_sidebar;
		}
	}

	return $classes;
}
add_filter( 'body_class', 'creativity_body_classes' );

// Remove current class on hash menu
add_filter('nav_menu_css_class', 'creativity_remove_current_class_hash', 10, 2 );

function creativity_remove_current_class_hash($classes, $item) {
	$class_names = array( 'current-menu-item', 'current-menu-ancestor', 'current-menu-parent', 'current_page_parent',  'current_page_ancestor', 'current_page_item' );
	if( strpos( $item->url, '#' ) !== false ) {
		foreach( $class_names as $class_name ) {
			if(($key = array_search($class_name, $classes)) !== false) {
				unset($classes[$key]);
			}
		}

	}
	return $classes;
}

/**
 * Custom Search Form
 */
function creativity_search_form( $form ) {
	$form = '<form role="search" method="get" class="search-form" action="' . home_url( '/' ) . '" >
	<div><label class="screen-reader-text" for="s">' . __( 'Search for:', 'creativity' ) . '</label>
	<input type="search" class="search-field" placeholder="'. __('Search..', 'creativity').'" value="' . get_search_query() . '" name="s" id="s" />
	<input type="submit" id="search-submit" value="'. __('Search..', 'creativity').'" />
	</div>
	</form>';

	return $form;
}

add_filter( 'get_search_form', 'creativity_search_form' );

/**
 * Sidebar Layout Class
 */
function creativity_get_sidebar_layout()  {
	global $post;
	$post_sidebar = 'right_sidebar';

	if( is_singular() ) {
		$post_sidebar = get_post_meta( $post->ID, 'creativity_sidebar_layout', true );
	}

	return $post_sidebar;
}

/** Add Editor Styles **/
function creativity_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}

add_action( 'admin_init', 'creativity_add_editor_styles' );

function creativity_dynamic_style() {
    $preloader = get_theme_mod( 'creativity_preloader' );
    $disp_cap_in_mobile = absint(get_theme_mod('creativity_disp_caption_in_mobile', 0));

    if( isset( $preloader ) && $preloader == '' ) :
    ?>
    <style>
    .no-js #loader { display: none; }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .creativity-preloader { position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; z-index: 9999999; background: url('<?php echo esc_url(get_template_directory_uri()."/images/loading.gif"); ?>') center no-repeat #fff;}

	<?php if(!$disp_cap_in_mobile) : ?>
    @media screen and (max-width:580px) {
	.slide-desc{
			display: none;
		}
	}
	<?php endif; ?>
    </style>
    <?php
    endif;
}
add_action( 'wp_head', 'creativity_dynamic_style', 15 );

/** Woocommerce Tweaks **/
/**
	* Woo Commerce Number of row filter Function
**/
add_filter('loop_shop_columns', 'creativity_loop_columns');
if (!function_exists('creativity_loop_columns')) {
   function creativity_loop_columns() {
       $xr = 3;
       return $xr;
   }
}

add_action( 'body_class', 'creativity_woo_body_class');
if (!function_exists('creativity_woo_body_class')) {
   function creativity_woo_body_class( $class ) {
          $class[] = 'columns-'.creativity_loop_columns();
          return $class;
   }
}

function woo_related_products_limit() {
	  global $product;

		$args['posts_per_page'] = 6;
		return $args;
	}
add_filter( 'woocommerce_output_related_products_args', 'creativity_related_products_args' );

function creativity_related_products_args( $args ) {
	$args['posts_per_page'] = 4; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}
