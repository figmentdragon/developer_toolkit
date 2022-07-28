<?php
/**
 * Creativity Architect functions and definitions.
 *
 * Author: CJTerminin | @cjtermini
 * URL: thecreativitycore.com | @creativitycore
 * Custom functions, support, custom post types and more.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package creativity architect
 */
 defined( 'ABSPATH' ) || die( "Can't access directly" );

 define( 'THEME_DIR', get_template_directory() );
 define( 'THEME_URI', get_template_directory_uri() );
 define( 'VERSION', wp_get_theme()->get( 'Version' ) );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/creativitycore-functions.php';
require get_template_directory() . '/inc/creativitycore-extra-controls.php';
require get_template_directory() . '/inc/customizer.php'
require get_template_directory() . '/inc/creativitycore-metabox.php';
require get_template_directory() . '/inc/creativitycore-widgets.php';
require get_template_directory() . '/woocommerce/woocommerce-functions.php';
require get_template_directory() . '/assets/css/dynamic-style.php';
require get_template_directory() . '/inc/welcome/welcome-config.php';


function creativitycore_setup() {
  add_action( 'after_setup_theme', 'setup' );
  add_action( 'after_setup_theme', 'creativitycore_content_width', 0 );
  add_action( 'widgets_init', 'creativitycore_widgets_init' );
  add_action( 'admin_enqueue_scripts', 'creativitycore_admin_enqueue_scripts' );
  add_action( 'init', 'create_post_type_creativitycore' ); // Add our creativity core Custom Post Type
  add_action( 'wp_enqueue_scripts', 'creativitycore_styles' ); // Add Theme Stylesheet
  add_action( 'wp_enqueue_scripts', 'creativitycore_header_scripts' ); // Add Custom Scripts to wp_head
 add_action( 'wp_print_scripts', 'creativitycore_conditional_scripts' ); // Add Conditional Page Scripts

  add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
  add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
  add_theme_support( 'responsive-embeds' );

	add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	add_theme_support( 'custom-background', apply_filters( 'creativitycore_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
  add_theme_support( 'post-thumbnails' );

	add_image_size( 'creativitycore-grid-large', 750, 750, true ); // Grid image crop
	add_image_size( 'creativitycore-post-image', 850, 300, true ); // Post Image
  add_image_size( 'creativitycore-bpost-image', 380, 250, true ); // Blog  Post Image
  add_image_size( 'creativitycore-featbox-image', 580, 350, true ); // Feature Box Thumbnail

}
 if ( ! function_exists( 'wp_body_open' ) ) {
     function wp_body_open() {
         do_action( 'wp_body_open' );
     }
 }


 /*------------------------------------*\
     Functions
 \*------------------------------------*/
 function creativitycore_content_width() {
 	$GLOBALS['content_width'] = apply_filters( 'creativitycore_content_width', 1000 );
 }

 function creativitycore_custom_menu() {
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
 function creativitycore_nav() {
   register_nav_menus(
 		array( // Using array to specify more menus if needed
 			'header-menu'  => esc_html( 'Header Menu', 'creativitycore' ), // Main Navigation
 			'extra-menu'   => esc_html( 'Extra Menu', 'creativitycore' ) // Extra Navigation if needed (duplicate as many as you need!)
   	)
 	);
 }

 // Remove the <div> surrounding the dynamic navigation to cleanup markup
 function wp_nav_menu_args( $args = '' ) {
     $args['container'] = false;
     return $args;
 }

 // Load creativitycore Blank scripts (header.php)
 function creativitycore_header_scripts() {
   if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {
     // Custom scripts
     wp_register_script(
       'creativitycore-scripts',
       get_template_directory_uri() . '/src/build/creativitycore-scripts.js',
       array(
         'banner.js',
         'build-plugins.js',
         'generate-sri.js',
         'change-version.js',
         'vnu-jar.js',
         'zip-examples.js',
       ),
       '1.0.0' );
       // Enqueue Scripts
       wp_enqueue_script( 'creativitycore-scripts' );

       // If production
     } else {
       // Scripts minify
       wp_register_script( 'creativitycore-scripts-min', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), '1.0.0' );
       wp_register_script( 'jquery-fullpage', get_template_directory_uri().'/assets/js/fullpage/jquery.fullPage.min.js', array( 'jquery' ),'20120206', true );
       wp_register_script( 'jquery-bxslider', get_template_directory_uri().'/assets/js/jquery.bxslider.js', array( 'jquery' ),'20120206', true );
       wp_register_script( 'isotope', get_template_directory_uri().'/assets/js/isotope.pkgd.min.js', array( 'jquery' ),'20120206', true );
       wp_register_script( 'jquery-inview', get_template_directory_uri().'/assets/js/jquery.inview.js', array( 'jquery'), '20120206', true );
       wp_register_script( 'jquery-knob', get_template_directory_uri().'/assets/js/jquery.knob.js', array( 'jquery'), '20120206', true );
       wp_register_script( 'nivo-lightbox', get_template_directory_uri().'/assets/js/nivolightbox/nivo-lightbox.js', array( 'jquery'), '20120206', true );
       wp_register_script( 'mcustomscrollbar', get_template_directory_uri().'/assets/js/mcustomscrollbar/jquery.mCustomScrollbar.js', array( 'jquery'), '20120206', true );
       wp_register_script( 'device', get_template_directory_uri().'/assets/js/device.js', array( ), '20120206', true );
       wp_register_script( 'scrollto', get_template_directory_uri().'/assets/js/jquery.scrollTo.js', array( ), '20120206', true );
       wp_register_script( 'creativitycore-custom-js', get_template_directory_uri().'/assets/js/custom.js', array('jquery', 'jquery-masonry'), '20120206', true );

     	$pause = get_theme_mod( 'creativitycore_slider_pause', '4000' );

     	wp_localize_script( 'creativitycore-custom-js', 'sBxslider', array( 'pause' => $pause ) );

       // Enqueue Scripts
       wp_enqueue_script( 'creativitycore-scripts-min' );
       wp_enqueue_style( 'nivo-lightbox' ),
       wp_enqueue_script( 'jquery-fullpage'),
       wp_enqueue_script( 'jquery-bxslider' ),
       wp_enqueue_script( 'isotope' ),
       wp_enqueue_script( 'jquery-inview' ),
       wp_enqueue_script( 'jquery-knob' ),
       wp_enqueue_script( 'nivo-lightbox' ),
       wp_enqueue_script( 'mcustomscrollbar' ),
       wp_enqueue_script( 'device' ),
       wp_enqueue_script( 'scrollto' ),
       wp_enqueue_script( 'creativitycore-custom-js' ),
     }
   }
 }

 // Load creativity core conditional scripts
 function creativitycore_conditional_scripts() {
     if ( is_page( 'pagenamehere' ) ) {
         // Conditional script(s)
         wp_register_script( 'scriptname', get_template_directory_uri() . '/assets/js/scriptname.js', array( 'jquery' ), '1.0.0' );
         wp_enqueue_script( 'scriptname' );
     }
     if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
       wp_enqueue_script( 'comment-reply' );
     }
 }

 // Load creativity core styles
 function creativitycore_styles() {
   if ( HTML5_DEBUG ) {
     // normalize-css
     wp_register_style( 'creativitycore-styles', get_template_directory_uri() . '/src/scss/stylesheets/creativitycore.css', array(), '7.0.0' );
     // Custom CSS
     wp_register_style( 'creativitycore', get_template_directory_uri() . '/assets/stylesheets/creativitycore.css', array( 'normalize' ), '1.0' );
     // Register CSS
     wp_enqueue_style( 'creativitycore' );
   } else {
     // Custom CSS
     wp_register_style( 'creativitycore-cssmin', get_template_directory_uri() . '/assets/stylesheets/creativitycore.css', array(), '1.0' );
     // Register CSS
	   wp_register_style('font-awesome',get_template_directory_uri() . '/assets/css/font-awesome.css',true );
     wp_register_style( 'nivo-lightbox-default', get_template_directory_uri().'/assets/js/nivolightbox/themes/default/default.css' );
     wp_register_style( 'nivo-lightbox', get_template_directory_uri().'/assets/js/nivolightbox/nivo-lightbox.css' );
     wp_register_style( 'jquery-fullpage', get_template_directory_uri().'/assets/js/fullpage/jquery.fullPage.css', true );
     wp_register_style( 'mcustomscrollbar', get_template_directory_uri().'/assets/js/mcustomscrollbar/jquery.mCustomScrollbar.css', true );
     wp_register_style( 'creativitycore-style', get_stylesheet_uri() );
     wp_register_style( 'creativitycore-keyboard', get_template_directory_uri().'/assets/css/keyboard.css', true );
     wp_register_style( 'creativitycore-responsive', get_template_directory_uri().'/assets/css/responsive.css', true );

     wp_enqueue_style( 'creativitycore-cssmin' );
     wp_enqueue_style( 'font-awesome' );
     wp_enqueue_style( 'nivo-lightbox-default' );
     wp_enqueue_style( 'nivo-lightbox' );
     wp_enqueue_style( 'jquery-fullpage' );
     wp_enqueue_style( 'mcustomscrollbar' );
     wp_enqueue_style( 'creativitycore-style' );
     wp_enqueue_style( 'creativitycore-keyboard' );
     wp_enqueue_style( 'creativitycore-responsive' );
     }
 }

 function creativitycore_admin_enqueue_scripts() {
     $currentScreen = get_current_screen();
     /** Loads the media js file in Page Edit Page only **/
     if( $currentScreen->id == "widgets" || $currentScreen->id == "page" ) {
         wp_enqueue_media();
         wp_enqueue_script( 'creativitycore-media-uploader-js', get_template_directory_uri(). '/inc/admin/js/media-uploader.js', array('jquery') );
     }

     wp_enqueue_style('creativitycore-other-admin', get_template_directory_uri(). '/inc/admin/css/other-admin.css');
 }



 // Register creativity core Navigation
 function register_creativitycore_menu() {
     register_nav_menus( array( // Using array to specify more menus if needed
         'header-menu'  => esc_html( 'Header Menu', 'creativitycore' ), // Main Navigation
         'extra-menu'   => esc_html( 'Extra Menu', 'creativitycore' ) // Extra Navigation if needed (duplicate as many as you need!)
     ) );
 }

 // Remove the <div> surrounding the dynamic navigation to cleanup markup
 function creativitycore_wp_nav_menu_args( $args = '' ) {
     $args['container'] = false;
     return $args;
 }

 // Remove Injected classes, ID's and Page ID's from Navigation <li> items
 function creativitycore_css_attributes_filter( $var ) {
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
 // Register widget area.
 function creativitycore_widgets_init() {
     // Define Sidebar Widget Area 1
     register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'creativitycore' ),
		'description'   => '',
		'id'            => 'creativitycore-sidebar-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
     ) );

     register_sidebar( array(
   		'name'          => esc_html__( 'Right Sidebar', 'creativitycore' ),
   		'id'            => 'creativitycore-sidebar-right',
   		'description'   => '',
   		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
   		'after_widget'  => '</aside>',
   		'before_title'  => '<h1 class="widget-title">',
   		'after_title'   => '</h1>',
   	) );

       register_sidebar( array(
   		'name'          => esc_html__( 'Google Map', 'creativitycore' ),
   		'id'            => 'creativitycore-gmap',
   		'description'   => '',
   		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
   		'after_widget'  => '</aside>',
   		'before_title'  => '<h1 class="widget-title">',
   		'after_title'   => '</h1>',
   	) );

       register_sidebar( array(
   		'name'          => esc_html__( 'Social Link (Header)', 'creativitycore' ),
   		'id'            => 'creativitycore-header-socialicon',
   		'description'   => '',
   		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
   		'after_widget'  => '</aside>',
   		'before_title'  => '<h1 class="widget-title">',
   		'after_title'   => '</h1>',
   	) );
   }

 // Remove wp_head() injected Recent Comment styles
 function creativitycore_remove_recent_comments_style() {
     global $wp_widget_factory;

     if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
         remove_action( 'wp_head', array(
             $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
             'recent_comments_style'
         ) );
     }
 }

 // Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
 function creativitycore_wp_pagination() {
     global $wp_query;
     $big = 999999999;
     echo paginate_links( array(
         'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
         'format'  => '?paged=%#%',
         'current' => max( 1, get_query_var( 'paged' ) ),
         'total'   => $wp_query->max_num_pages,
     ) );
 } add_action( 'widgets_init', 'creativitycore_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()


 // Create 20 Word Callback for Index page Excerpts, call using creativitycore_wp_excerpt('creativitycore_wp_index');
 function creativitycore_wp_index( $length ) {
     return 20;
 }

 // Create 40 Word Callback for Custom Post Excerpts, call using creativitycore_wp_excerpt('creativitycore_wp_custom_post');
 function creativitycore_wp_custom_post( $length ) {
     return 40;
 }

 // Create the Custom Excerpts callback
 function creativitycore_wp_excerpt( $length_callback = '', $more_callback = '' ) {
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
 function creativitycore_blank_view_article( $more ) {
     global $post;
     return '... <a class="view-article" href="' . get_permalink( $post->ID ) . '">' . esc_html_e( 'View Article', 'creativitycore' ) . '</a>';
 }

 // Remove Admin bar
 function remove_admin_bar() {
     return false;
 }

 // Remove 'text/css' from our enqueued stylesheet
 function creativitycore_style_remove( $tag ) {
     return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
 }

 // Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
 function remove_thumbnail_dimensions( $html ) {
     $html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
     return $html;
 }

 // Custom Gravatar in Settings > Discussion
 function creativitycore_gravatar ( $avatar_defaults ) {
     $myavatar                   = get_template_directory_uri() . '/img/gravatar.jpg';
     $avatar_defaults[$myavatar] = 'Custom Gravatar';
     return $avatar_defaults;
 }

 // Threaded Comments
 function enable_threaded_comments() {
     if ( ! is_admin() ) {
         if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 ) ) {
             wp_enqueue_script( 'comment-reply' );
         }
     }
 }

 // Custom Comments Callback
 function creativitycore_comments( $comment, $args, $depth ) {
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

     <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
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
     Actions + Filters + ShortCodes
 \*------------------------------------*/

 // Add Actions

 add_action( 'wp_print_scripts', 'creativitycore_conditional_scripts' ); // Add Conditional Page Scripts
 add_action( 'get_header', 'enable_threaded_comments' ); // Enable Threaded Comments

 add_action( 'init', 'creatvitycore_nav' ); // Add creativity core Menu

 add_action( 'widgets_init', 'creativitycore_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
 add_action( 'init', 'creativitycore_wp_pagination' ); // Add our HTML5 Pagination

 // Remove Actions
 remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
 remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
 remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
 remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
 remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
 remove_action( 'wp_head', 'rel_canonical' );
 remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

 // Add Filters
 add_filter( 'avatar_defaults', 'creativitycore_gravatar' ); // Custom Gravatar in Settings > Discussion
 add_filter( 'body_class', 'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
 add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
 add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
 add_filter( 'wp_nav_menu_args', 'wp_nav_menu_args' ); // Remove surrounding <div> from WP Navigation
 // add_filter( 'nav_menu_css_class', 'creativitycore_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected classes (Commented out by default)
 // add_filter( 'nav_menu_item_id', 'creativitycore_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected ID (Commented out by default)
 // add_filter( 'page_css_class', 'creativitycore_css_attributes_filter', 100, 1 ); // Remove Navigation <li> Page ID's (Commented out by default)
 add_filter( 'the_category', 'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
 add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
 add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
 add_filter( 'excerpt_more', 'creativit_core_view_article' ); // Add 'View Article' button instead of [...] for Excerpts
 add_filter( 'show_admin_bar', 'remove_admin_bar' ); // Remove Admin bar
 add_filter( 'style_loader_tag', 'creativitycore_style_remove' ); // Remove 'text/css' from enqueued stylesheet
 add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
 add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
 add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images

 // Remove Filters
 remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether

 // Shortcodes
 add_shortcode( 'creativitycore_shortcode_demo', 'creativitycore_shortcode_demo' ); // You can place [creativitycore_shortcode_demo] in Pages, Posts now.
 add_shortcode( 'creativitycore_shortcode_demo_2', 'creativitycore_shortcode_demo_2' ); // Place [creativitycore_shortcode_demo_2] in Pages, Posts now.

 // Shortcodes above would be nested like this -
 // [creativitycore_shortcode_demo] [creativitycore_shortcode_demo_2] Here's the page title! [/creativitycore_shortcode_demo_2] [/creativitycore_shortcode_demo]

 /*------------------------------------*\
     Custom Post Types
 \*------------------------------------*/

 // Create 1 Custom Post type for a Demo, called creativity-core
 function create_post_type_creativitycore() {
     register_taxonomy_for_object_type( 'category', 'creativity-core' ); // Register Taxonomies for Category
     register_taxonomy_for_object_type( 'post_tag', 'creativity-core' );
     register_post_type( 'creativity-core', // Register Custom Post Type
         array(
         'labels'       => array(
             'name'               => esc_html( 'creativity core Custom Post', 'creativitycore' ), // Rename these to suit
             'singular_name'      => esc_html( 'creativity core Custom Post', 'creativitycore' ),
             'add_new'            => esc_html( 'Add New', 'creativitycore' ),
             'add_new_item'       => esc_html( 'Add New creativity core Custom Post', 'creativitycore' ),
             'edit'               => esc_html( 'Edit', 'creativitycore' ),
             'edit_item'          => esc_html( 'Edit creativity core Custom Post', 'creativitycore' ),
             'new_item'           => esc_html( 'New creativity core Custom Post', 'creativitycore' ),
             'view'               => esc_html( 'View creativity core Custom Post', 'creativitycore' ),
             'view_item'          => esc_html( 'View creativity core Custom Post', 'creativitycore' ),
             'search_items'       => esc_html( 'Search creativity core Custom Post', 'creativitycore' ),
             'not_found'          => esc_html( 'No creativity core Custom Posts found', 'creativitycore' ),
             'not_found_in_trash' => esc_html( 'No creativity core Custom Posts found in Trash', 'creativitycore' ),
         ),
         'public'       => true,
         'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
         'has_archive'  => true,
         'supports'     => array(
             'title',
             'editor',
             'excerpt',
             'thumbnail'
         ), // Go to Dashboard Custom creativity core post for supports
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
 function creativitycore_shortcode_demo( $atts, $content = null ) {
     return '<div class="shortcode-demo">' . do_shortcode( $content ) . '</div>'; // do_shortcode allows for nested Shortcodes
 }

 // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
 function creativitycore_shortcode_demo_2( $atts, $content = null ) {
     return '<h2>' . $content . '</h2>';
 }
