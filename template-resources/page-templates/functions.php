<?php
/**
 * Author: Robert DeVore | @deviorobert
 * URL: creativityarchitect-.com | @creativityarchitect-
 * Custom functions, support, custom post types and more.
 */

require_once 'src/modules/is-debug.php';

require get_parent_theme_file_path( '/inc/custom-header.php' );
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );
require get_parent_theme_file_path( '/inc/widget-social-icons.php' );
require get_parent_theme_file_path( '/inc/events.php' );
require get_parent_theme_file_path( '/inc/color-scheme.php' );
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );
require get_parent_theme_file_path( '/inc/template-functions.php' );
require get_parent_theme_file_path( '/inc/template-tags.php' );

require get_parent_theme_file_path( '/inc/icon-functions.php' );

require get_parent_theme_file_path( '/inc/theme-functions.php' );
require get_parent_theme_file_path( '/inc/defaults.php' );


if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path( '/inc/jetpack.php' );
}
/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if ( ! isset( $content_width ) ) {
    $content_width = 900;
}

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'align-wide' );
  // Enables post and comment RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );
  // Add Support for Custom Backgrounds - Uncomment below if you're going to use.
  add_theme_support( 'custom-background',
      array(
        'default-color' => 'FFF',
        'default-image' => get_template_directory_uri() . '/img/bg.jpg'
      )
    );
  // Add Support for Custom Header - Uncomment below if you're going to use.
  add_theme_support( 'custom-header',
    array(
      'default-image'          => get_template_directory_uri() . '/src/images/header/default.jpg',
      'header-text'            => false,
        'default-text-color'     => '000',
        'width'                  => 1000,
        'height'                 => 198,
        'random-default'         => false
      )
    );
  add_theme_support( 'custom-logo',
    array(
      'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
    )
  );
  add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'editor-styles' );
  add_theme_support( 'ew-newsletter-image' );

  // Enable HTML5 support.
  add_theme_support( 'html5',
    array(
      'caption',
      'comment-form',
      'comment-list',
      'gallery',
      'search-form'
    )
  );

  // Add Thumbnail Theme Support.
  add_theme_support( 'post-thumbnails' );
    add_image_size( 'large', 700, '', true ); // Large Thumbnail.
    add_image_size( 'medium', 250, '', true ); // Medium Thumbnail.
    add_image_size( 'small', 120, '', true ); // Small Thumbnail.
    add_image_size( 'custom-size', 700, 200, true ); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
		add_image_size( 'creativityarchitect-block-image', 606, 404, true ); //
		add_image_size( 'creativityarchitect-single-post-page', 1920, 440, true );
    add_image_size( 'creativityarchitect-slider', 1920, 1080, true ); // Ratio 16:9
		add_image_size( 'creativityarchitect-portfolio', 1920, 9999, true ); // Flexible Height
  add_theme_support( 'responsive-embeds' );
  add_theme_support( 'title-tag' );

  // Localisation Support.
  load_theme_textdomain( 'creativityarchitect', get_template_directory() . '/languages' );
}

/*------------------------------------*\
    Functions
\*------------------------------------*/

if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}
$editor_style_url = 'assets/css/editor-style.css';
  add_editor_style( $editor_style_url );

if ( 'light' === get_theme_mod( 'editor_color_scheme', 'dark' ) ) {
  $editor_style_url = 'assets/css/editor-style-light.css';
}

// Creativity Architect navigation
function creativityarchitect_nav() {
    wp_nav_menu(
    array(
        'theme_location'  => 'header-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => '',
        )
    );
}

// Register Creativity Architect Navigation
function register_creativityarchitect_menu() {
    register_nav_menus( array( // Using array to specify more menus if needed
        'header-menu'  => esc_html( 'Header Menu', 'creativityarchitect' ), // Main Navigation
        'extra-menu'   => esc_html( 'Extra Menu', 'creativityarchitect' ) // Extra Navigation if needed (duplicate as many as you need!)
    ) );
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args( $args = '' ) {
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter( $var ) {
    return is_array( $var ) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list( $thelist ) {
    return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class( $classes ) {
    global $post;
    if ( is_home() ) {
        $key = array_search( 'blog', $classes, true );
        if ( $key > -1 ) {
            unset( $classes[$key] );
        }
    } elseif ( is_page() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    } elseif ( is_singular() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    }

    return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
    return $html;
}

// If Dynamic Sidebar Exists
register_sidebar( array(
  'name'          => esc_html( 'Widget Area 1', 'creativityarchitect' ),
  'description'   => esc_html( 'Description for this widget-area...', 'creativityarchitect' ),
  'id'            => 'widget-area-1',
  'before_widget' => '<div id="%1$s" class="%2$s">',
  'after_widget'  => '</div>',
  'before_title'  => '<h3>',
  'after_title'   => '</h3>',
  )
);

// Define Sidebar Widget Area 2
register_sidebar( array(
  'name'          => esc_html( 'Widget Area 2', 'creativityarchitect' ),
  'description'   => esc_html( 'Description for this widget-area...', 'creativityarchitect' ),
  'id'            => 'widget-area-2',
  'before_widget' => '<div id="%1$s" class="%2$s">',
  'after_widget'  => '</div>',
  'before_title'  => '<h3>',
  'after_title'   => '</h3>',
  )
);

function copyright() {
  global $wpdb;
  $copyright_dates = $wpdb->get_results("
  SELECT
  YEAR(min(post_date_gmt)) AS firstdate,
  YEAR(max(post_date_gmt)) AS lastdate
  FROM
  $wpdb->posts
  WHERE
  post_status = 'publish'
  ");
  $output = '';
  if($copyright_dates) {
    $copyright = "&copy; " . $copyright_dates[0]->firstdate;
    if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
      $copyright .= '-' . $copyright_dates[0]->lastdate;
    }
    $output = $copyright;
  }
  return $output;
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
    global $wp_widget_factory;

    if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
        remove_action( 'wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ) );
    }
}

function creativityarchitect_widgets_init() {
	$args = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Sidebar', 'creativityarchitect' ),
		'id'          => 'sidebar-1',
		'description' => esc_html__( 'Add widgets here.', 'creativityarchitect' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 1', 'creativityarchitect' ),
		'id'          => 'sidebar-2',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'creativityarchitect' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 2', 'creativityarchitect' ),
		'id'          => 'sidebar-3',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'creativityarchitect' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 3', 'creativityarchitect' ),
		'id'          => 'sidebar-4',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'creativityarchitect' ),
		) + $args
	);

	if ( class_exists( 'Catch_Instagram_Feed_Gallery_Widget' ) ||  class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		register_sidebar( array(
			'name'        => esc_html__( 'Instagram', 'creativityarchitect' ),
			'id'          => 'sidebar-instagram',
			'description' => esc_html__( 'Appears above footer. This sidebar is only for Widget from plugin Catch Instagram Feed Gallery Widget and Catch Instagram Feed Gallery Widget Pro', 'creativityarchitect' ),
			) + $args
		);
	}
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function creativityarchitectwp_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links( array(
        'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'format'  => '?paged=%#%',
        'current' => max( 1, get_query_var( 'paged' ) ),
        'total'   => $wp_query->max_num_pages,
    ) );
}

// Create 20 Word Callback for Index page Excerpts, call using creativityarchitectwp_excerpt('creativityarchitectwp_index');
function creativityarchitectwp_index( $length ) {
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using creativityarchitectwp_excerpt('creativityarchitectwp_custom_post');
function creativityarchitectwp_custom_post( $length ) {
    return 40;
}

// Create the Custom Excerpts callback
function creativityarchitectwp_excerpt( $length_callback = '', $more_callback = '' ) {
    global $post;
    if ( function_exists( $length_callback ) ) {
        add_filter( 'excerpt_length', $length_callback );
    }
    if ( function_exists( $more_callback ) ) {
        add_filter( 'excerpt_more', $more_callback );
    }
    $output = get_the_excerpt();
    $output = apply_filters( 'wptexturize', $output );
    $output = apply_filters( 'convert_chars', $output );
    $output = '<p>' . $output . '</p>';
    echo esc_html( $output );
}

// Custom View Article link to Post
function creativityarchitect_view_article( $more ) {
    global $post;
    return '... <a class="view-article" href="' . get_permalink( $post->ID ) . '">' . esc_html_e( 'View Article', 'creativityarchitect' ) . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function creativityarchitect_style_remove( $tag ) {
    return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
    return $html;
}

// Custom Gravatar in Settings > Discussion
function creativityarchitect_gravatar ( $avatar_defaults ) {
    $myavatar                   = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = 'Custom Gravatar';
    return $avatar_defaults;
}

function creativityarchitect_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

function enable_threaded_comments() {
    if ( ! is_admin() ) {
        if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
}

// Custom Comments Callback
function creativityarchitect_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract( $args, EXTR_SKIP );

    if ( 'div' == $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo esc_html( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID(); ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
    <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    <?php printf( esc_html( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ) ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
      <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' ) ?></em>
      <br />
    <?php endif; ?>
    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link(
      $comment->comment_ID ) ) ?>">
        <?php
            printf( esc_html( '%1$s at %2$s' ), get_comment_date(), get_comment_time() ) ?></a><?php edit_comment_link( esc_html_e( '(Edit)' ), '  ', '' );
            ?>
          </div>
          <?php comment_text() ?>
          <div class="reply">
            <?php comment_reply_link( array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
          </div>
          <?php if ( 'div' != $args['style'] ) : ?>
          </div>
        <?php endif; ?>
      <?php }

/*------------------------------------*\
    Enqueue Scripts + Styles
\*------------------------------------*/

// Load Creativity Architect scripts (header.php)
function creativityarchitect_header_scripts() {
  $min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
  $path = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'assets/js/source/' : 'assets/js/';

  if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {
    if ( HTML5_DEBUG ) {
      wp_deregister_script( 'jquery' );
      wp_register_script( 'jquery', get_template_directory_uri() . '/src/js/lib/jquery.js', array(), '1.11.1' );
      wp_register_script( 'conditionizr', get_template_directory_uri() . '/src/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0' );
      wp_register_script( 'modernizr', get_template_directory_uri() . '/src/js/lib/modernizr.js', array(), '2.8.3' );
      wp_register_script( 'creativityarchitect-scripts', get_template_directory_uri() . '/src/js/scripts.js',
        array(
          'conditionizr',
          'modernizr',
          'jquery'
        ),
        '1.0.0' );
      wp_enqueue_script( 'creativityarchitect-scripts' );
    } else {
      wp_register_script( 'creativityarchitect-scripts-min', get_template_directory_uri() . '/src/js/scripts.min.js', array(), '1.0.0' );
      wp_enqueue_script( 'creativityarchitect-scripts-min' );
    }
  }
}


function creativityarchitect_scripts() {
  $dir_uri = get_template_directory_uri();
  $min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
  $path = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'src/js/source/' : 'src/js/';

  wp_enqueue_script( 'creativityarchitect-html5',
    get_theme_file_uri( $path . 'html5' . $min . '.js' ), array(), '3.7.3' );
  wp_script_add_data( 'creativityarchitect-html5', 'conditional', 'lt IE 9' );
  wp_enqueue_script( 'creativityarchitect-skip-link-focus-fix',
    get_theme_file_uri( $path . 'skip-link-focus-fix' . $min . '.js' ), array(), '201800703', true );
  wp_enqueue_script( 'creativityarchitect-menu', $dir_uri .  $path. "menu.js", array( 'jquery'), 'CREATIVITYARCHITECT_VERSION', true );
  wp_enqueue_script( 'creativityarchitect-a11y', $dir_uri .  $path. "a11y.js", array(), 'CREATIVITYARCHITECT_VERSION', true );
  wp_enqueue_script( 'creativityarchitect-menu-control', $dir_uri .  $path. "menu-control.js", array( 'jquery'), 'CREATIVITYARCHITECT_VERSION', true );
}

// Load Creativity Architect conditional scripts
function creativityarchitect_conditional_scripts() {
  $min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
  $path = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'assets/js/source/' : 'assets/js/';

  if ( is_page( 'pagenamehere' ) ) {
    // Conditional script(s)
    wp_register_script( 'scriptname', get_template_directory_uri() . '/js/scriptname.js', array( 'jquery' ), '1.0.0' );
    wp_enqueue_script( 'scriptname' );
  }
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }


  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }
}

// Load Creativity Architect styles
function creativityarchitect_styles() {
  $creativityarchitect_settings = wp_parse_args(
    get_option( 'creativityarchitect_settings', array() ),
    creativityarchitect_get_defaults()
  );
  $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
  $dir_uri = get_template_directory_uri();
  if ( SCRIPT_DEBUG ) {
    wp_register_style( 'normalize', get_template_directory_uri() . '/css/lib/normalize.css', array(), '7.0.0' );

    wp_enqueue_style( 'creativityarchitect', get_template_directory_uri() . '/style.css', array( 'normalize' ), '1.0' );

    wp_enqueue_style( 'creativityarchitect' );
  } else {
      wp_register_style( 'creativityarchitect-cssmin', get_template_directory_uri() . '/style.css', array(), '1.0' );
      wp_enqueue_style( 'creativityarchitect-cssmin' );

      wp_enqueue_style( 'creativityarchitect-style-grid', $dir_uri . "/css/unsemantic-grid{$suffix}.css", false, 'CREATIVITYARCHITECT_VERSION', 'all' );
      wp_enqueue_style( 'creativityarchitect-style', $dir_uri . "/style{$suffix}.css", array( 'creativityarchitect-style-grid' ), 'CREATIVITYARCHITECT_VERSION', 'all' );
      wp_enqueue_style( 'creativityarchitect-mobile-style', $dir_uri . "/css/mobile{$suffix}.css", array( 'creativityarchitect-style' ), 'CREATIVITYARCHITECT_VERSION', 'all' );
    }
}

// Enqueue scripts and styles.
function creativityarchitect_enabled_scripts() {
  $creativityarchitect_settings = wp_parse_args(
    get_option( 'creativityarchitect_settings', array() ),
    creativityarchitect_get_defaults()
  );
  $min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
  $path = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'src/js/source/' : 'src/js/';
  $dir_uri = get_template_directory_uri();

  $deps[] = 'jquery';
  $enable_portfolio = get_theme_mod( 'creativityarchitect_portfolio_option', 'disabled' );
  if ( creativityarchitect_check_section( $enable_portfolio ) ) {
      $deps[] = 'jquery-masonry';
    }

  $enable_featured_content = get_theme_mod( 'creativityarchitect_featured_content_option', 'disabled' );

  //Slider Scripts
  $enable_slider      = creativityarchitect_check_section( get_theme_mod( 'creativityarchitect_slider_option', 'disabled' ) );
  $enable_testimonial_slider      = creativityarchitect_check_section( get_theme_mod( 'creativityarchitect_testimonial_option', 'disabled' ) ) && get_theme_mod( 'creativityarchitect_testimonial_slider', 1 );

  if ( $enable_slider || $enable_testimonial_slider ) {
      // Enqueue owl carousel css. Must load CSS before JS.
      wp_enqueue_style( 'owl-carousel-core', get_theme_file_uri( 'assets/css/owl-carousel/owl.carousel.min.css' ), null, '2.3.4' );
      wp_enqueue_style( 'owl-carousel-default', get_theme_file_uri( 'assets/css/owl-carousel/owl.theme.default.min.css' ), null, '2.3.4' );
      wp_enqueue_script( 'owl-carousel', get_theme_file_uri( $path . 'owl.carousel' . $min . '.js' ), array( 'jquery' ), '2.3.4', true );
      $deps[] = 'owl-carousel';
    }
  wp_enqueue_script( 'creativityarchitect-script', get_theme_file_uri( $path . 'functions' . $min . '.js' ), $deps, '201800703', true );
  wp_localize_script( 'creativityarchitect-script', 'creativityarchitectOptions',
      array(
        'screenReaderText' => array(
          'expand'   => esc_html__( 'expand child menu', 'creativityarchitect' ),
          'collapse' => esc_html__( 'collapse child menu', 'creativityarchitect' ),
          'icon'     => creativityarchitect_get_svg(
            array(
              'icon'     => 'angle-down',
              'fallback' => true,
            )
          ),
        ),
        'iconNavPrev'     => creativityarchitect_get_svg(
          array(
            'icon'     => 'angle-left',
            'fallback' => true,
          )
        ),
        'iconNavNext'     => creativityarchitect_get_svg(
          array(
            'icon'     => 'angle-right',
            'fallback' => true,
          )
        ),
        'iconTestimonialNavPrev'     => '<span>' . esc_html__( 'PREV', 'creativityarchitect' ) . '</span>',
        'iconTestimonialNavNext'     => '<span>' . esc_html__( 'NEXT', 'creativityarchitect' ) . '</span>',
        'rtl' => is_rtl(),
        'dropdownIcon'     => creativityarchitect_get_svg(
          array(
            'icon' => 'angle-down',
            'fallback' => true
          )
        ),
      )
    );

  if ( 'click' == $creativityarchitect_settings[ 'nav_dropdown_type' ] || 'click-arrow' == $creativityarchitect_settings[ 'nav_dropdown_type' ] ) {
    wp_enqueue_script( 'creativityarchitect-dropdown-click', $dir_uri . $path . "dropdown-click.js", array( 'creativityarchitect-menu' ), 'CREATIVITYARCHITECT_VERSION', true );
  }

  if ( 'enable' == $creativityarchitect_settings['nav_search'] ) {
    wp_enqueue_script( 'creativityarchitect-navigation-search', $dir_uri . $path. "navigation-search.js", array( 'creativityarchitect-menu' ), 'CREATIVITYARCHITECT_VERSION', true );
  }

  if ( 'enable' == $creativityarchitect_settings['back_to_top'] ) {
    wp_enqueue_script( 'creativityarchitect-back-to-top', $dir_uri .  $path . "back-to-top.js", array(), 'CREATIVITYARCHITECT_VERSION', true );
  }

  $magic_cursor  = 'enable';
  if ( isset( $creativityarchitect_settings['magic_cursor'] ) ) {
    $magic_cursor = $creativityarchitect_settings['magic_cursor'];
  }

  if ( $magic_cursor != 'disable' ) {
    wp_enqueue_style( 'creativityarchitect-magic-mouse', esc_url( $dir_uri ) . "/css/magic-mouse.min.css", false, 'CREATIVITYARCHITECT_VERSION', 'all' );
    wp_enqueue_script( 'creativityarchitect-magic-mouse', $dir_uri . $path . "magic-mouse.min.js", array( 'jquery'), 'CREATIVITYARCHITECT_VERSION', true );
  }

  $type_effect		 = 'enable';
  if ( isset( $creativityarchitect_settings['type_effect'] ) ) {
    $type_effect = $creativityarchitect_settings['type_effect'];
  }

  if ( $type_effect != 'disable' ) {
    wp_enqueue_script( 'creativityarchitect-t', esc_url( get_stylesheet_directory_uri() ) . "$dir_uri .  $path " . "t.min.js", array( 'jquery'), 'CREATIVITYARCHITECT_VERSION', true );
  }

  $cursor		 = 'enable';
  $preloader   = 'enable';
  if ( isset( $creativityarchitect_settings['cursor'] ) ) {
      $cursor = $creativityarchitect_settings['cursor'];
    }
  if ( isset( $creativityarchitect_settings['creativityarchitect_preloader'] ) ) {
    $preloader = $creativityarchitect_settings['creativityarchitect_preloader'];
  }
}

add_action( 'wp_enqueue_scripts', 'creativityarchitect_enabled_scripts' );

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action( 'wp_enqueue_scripts', 'creativityarchitect_enabled_scripts' ); // Add Custom Scripts to wp_head
add_action( 'wp_header', 'creativityarchitect_header_scripts' );
add_action( 'wp_enqueue_scripts', 'creativityarchitect_scripts' );
add_action( 'wp_print_scripts', 'creativityarchitect_conditional_scripts' ); // Add Conditional Page Scripts
add_action( 'get_header', 'enable_threaded_comments' ); // Enable Threaded Comments
add_action( 'wp_enqueue_scripts', 'creativityarchitect_styles' ); // Add Theme Stylesheet
add_action( 'init', 'register_creativityarchitect_menu' ); // Add Creativity Architect Menu
add_action( 'init', 'create_post_type_creativityarchitect' ); // Add our Creativity Architect Custom Post Type
add_action( 'widgets_init', 'my_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
add_action( 'widgets_init', 'creativityarchitect_widgets_init' );
add_action( 'init', 'creativityarchitectwp_pagination' );
add_action( 'wp_head', 'creativityarchitect_javascript_detection', 0 );


// Remove Actions
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Add Filters
add_filter( 'avatar_defaults', 'creativityarchitect_gravatar' ); // Custom Gravatar in Settings > Discussion
add_filter( 'body_class', 'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' ); // Remove surrounding <div> from WP Navigation
add_filter( 'nav_menu_css_class', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected classes (Commented out by default)
add_filter( 'nav_menu_item_id', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected ID (Commented out by default)
add_filter( 'page_css_class', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter( 'the_category', 'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter( 'excerpt_more', 'creativityarchitect_view_article' ); // Add 'View Article' button instead of [...] for Excerpts
add_filter( 'show_admin_bar', 'remove_admin_bar' ); // Remove Admin bar
add_filter( 'style_loader_tag', 'creativityarchitect_style_remove' ); // Remove 'text/css' from enqueued stylesheet
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode( 'creativityarchitect_shortcode_demo', 'creativityarchitect_shortcode_demo' ); // You can place [creativityarchitect_shortcode_demo] in Pages, Posts now.
add_shortcode( 'creativityarchitect_shortcode_demo_2', 'creativityarchitect_shortcode_demo_2' ); // Place [creativityarchitect_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [creativityarchitect_shortcode_demo] [creativityarchitect_shortcode_demo_2] Here's the page title! [/creativityarchitect_shortcode_demo_2] [/creativityarchitect_shortcode_demo]

/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called Creativity Core
function create_post_type_creativityarchitect() {
    register_taxonomy_for_object_type( 'category', 'creativityarchitect' ); // Register Taxonomies for Category
    register_taxonomy_for_object_type( 'post_tag', 'creativityarchitect' );
    register_post_type( 'creativityarchitect', // Register Custom Post Type
        array(
        'labels'       => array(
            'name'               => esc_html( 'Creativity Architect Custom Post', 'creativityarchitect' ), // Rename these to suit
            'singular_name'      => esc_html( 'Creativity Architect Custom Post', 'creativityarchitect' ),
            'add_new'            => esc_html( 'Add New', 'creativityarchitect' ),
            'add_new_item'       => esc_html( 'Add New Creativity Architect Custom Post', 'creativityarchitect' ),
            'edit'               => esc_html( 'Edit', 'creativityarchitect' ),
            'edit_item'          => esc_html( 'Edit Creativity Architect Custom Post', 'creativityarchitect' ),
            'new_item'           => esc_html( 'New Creativity Architect Custom Post', 'creativityarchitect' ),
            'view'               => esc_html( 'View Creativity Architect Custom Post', 'creativityarchitect' ),
            'view_item'          => esc_html( 'View Creativity Architect Custom Post', 'creativityarchitect' ),
            'search_items'       => esc_html( 'Search Creativity Architect Custom Post', 'creativityarchitect' ),
            'not_found'          => esc_html( 'No Creativity Architect Custom Posts found', 'creativityarchitect' ),
            'not_found_in_trash' => esc_html( 'No Creativity Architect Custom Posts found in Trash', 'creativityarchitect' ),
        ),
        'public'       => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive'  => true,
        'supports'     => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom Creativity Architect post for supports
        'can_export'   => true, // Allows export in Tools > Export
        'taxonomies'   => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ) );
}

/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function creativityarchitect_shortcode_demo( $atts, $content = null ) {
    return '<div class="shortcode-demo">' . do_shortcode( $content ) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
function creativityarchitect_shortcode_demo_2( $atts, $content = null ) {
    return '<h2>' . $content . '</h2>';
}
