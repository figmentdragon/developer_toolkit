<?php
/**
 * Custom Functions
 */

function functions() {
  add_action( 'after_switch_theme', 'setup_options' );
  add_action( 'init', 'register_html5_menu' ); // Add HTML5 Blank Menu
  add_action( 'init', 'create_post_type_html5' ); // Add our HTML5 Blank Custom Post Type
  add_action( 'widgets_init', 'my_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
  add_action( 'init', 'html5wp_pagination' );

  // Add Filters
  add_filter( 'avatar_defaults', 'html5blankgravatar' ); // Custom Gravatar in Settings > Discussion
  add_filter( 'body_class', 'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
  add_filter( 'excerpt_length', 'excerpt_length', 999 );
  add_filter( 'excerpt_more', 'excerpt_more' );
  add_filter( 'the_content_more_link', 'more_link', 10, 2 );
  add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
  add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' ); // Remove  surrounding <div> from WP Navigation

  add_shortcode( 'html5_shortcode_demo', 'html5_shortcode_demo' ); // You can place [html5_shortcode_demo] in Pages, Posts now.
  add_shortcode( 'html5_shortcode_demo_2', 'html5_shortcode_demo_2' );
}

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

function remove_category_rel_from_category_list( $thelist ) {
  return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
    return $html;
}


function remove_width_attribute( $html ) {
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
    return $html;
}

function html5blankgravatar ( $avatar_defaults ) {
    $myavatar                   = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = 'Custom Gravatar';
    return $avatar_defaults;
}


function check_section( $value ) {
	return ( 'entire-site' == $value  || ( is_front_page() && 'homepage' === $value ) );
}
function my_css_attributes_filter( $var ) {
    return is_array( $var ) ? array() : '';
}

function custom_image_sizes( $sizes ) {
    return array_merge( $sizes,
      array(
        'thumb-600' => __('600px by 150px'),
        'thumb-300' => __('300px by 100px'),
      )
    );
  }

function excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	// Getting data from Customizer Options
	$length	= get_theme_mod( 'excerpt_length', 30 );
		return absint( $length );
	}
function excerpt_more( $more ) {
  if ( is_admin() ) {
    return $more;
  }
  $more_tag_text = get_theme_mod( 'excerpt_more_text',  esc_html__( 'Continue reading', 'TheThemeName' ) );

  $link = sprintf( '<p class="more-link"><a class="button" href="%1$s" class="readmore">%2$s</a></p>',
  esc_url( get_permalink() ),
  /* translators: %s: Name of current post */
  wp_kses_data( $more_tag_text ) . '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
  );
  return $link;

  }

function more_link( $more_link, $more_link_text ) {
	$more_tag_text = get_theme_mod( 'excerpt_more_text', esc_html__( 'Continue reading', 'TheThemeName' ) );
	return ' &hellip; ' . str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
}

function html5blank_nav() {
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

function my_remove_recent_comments_style() {
    global $wp_widget_factory;

    if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
        remove_action( 'wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ) );
    }
}

function html5_shortcode_demo( $atts, $content = null ) {
    return '<div class="shortcode-demo">' . do_shortcode( $content ) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
function html5_shortcode_demo_2( $atts, $content = null ) {
    return '<h2>' . $content . '</h2>';
}

function html5_style_remove( $tag ) {
    return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}


function html5_blank_view_article( $more ) {
    global $post;
    return '... <a class="view-article" href="' . get_permalink( $post->ID ) . '">' . esc_html_e( 'View Article', 'html5blank' ) . '</a>';
}


function html5wp_custom_post( $length ) {
    return 40;
}

function html5wp_excerpt( $length_callback = '', $more_callback = '' ) {
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


function html5wp_index( $length ) {
    return 20;
}

function my_wp_nav_menu_args( $args = '' ) {
    $args['container'] = false;
    return $args;
}

function html5wp_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links( array(
        'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'format'  => '?paged=%#%',
        'current' => max( 1, get_query_var( 'paged' ) ),
        'total'   => $wp_query->max_num_pages,
    ) );
}

function create_post_type_html5() {
    register_taxonomy_for_object_type( 'category', 'html5-blank' ); // Register Taxonomies for Category
    register_taxonomy_for_object_type( 'post_tag', 'html5-blank' );
    register_post_type( 'html5-blank', // Register Custom Post Type
        array(
        'labels'       => array(
            'name'               => esc_html( 'HTML5 Blank Custom Post', 'html5blank' ), // Rename these to suit
            'singular_name'      => esc_html( 'HTML5 Blank Custom Post', 'html5blank' ),
            'add_new'            => esc_html( 'Add New', 'html5blank' ),
            'add_new_item'       => esc_html( 'Add New HTML5 Blank Custom Post', 'html5blank' ),
            'edit'               => esc_html( 'Edit', 'html5blank' ),
            'edit_item'          => esc_html( 'Edit HTML5 Blank Custom Post', 'html5blank' ),
            'new_item'           => esc_html( 'New HTML5 Blank Custom Post', 'html5blank' ),
            'view'               => esc_html( 'View HTML5 Blank Custom Post', 'html5blank' ),
            'view_item'          => esc_html( 'View HTML5 Blank Custom Post', 'html5blank' ),
            'search_items'       => esc_html( 'Search HTML5 Blank Custom Post', 'html5blank' ),
            'not_found'          => esc_html( 'No HTML5 Blank Custom Posts found', 'html5blank' ),
            'not_found_in_trash' => esc_html( 'No HTML5 Blank Custom Posts found in Trash', 'html5blank' ),
        ),
        'public'       => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive'  => true,
        'supports'     => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export'   => true, // Allows export in Tools > Export
        'taxonomies'   => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ) );
}

function comment( $comment, $args, $depth ) {
  if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

  <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
    <div class="comment-body">
      <?php esc_html_e( 'Pingback:', 'TheThemeName' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'TheThemeName' ), '<span class="edit-link">', '</span>' ); ?>
    </div>
  <?php else : ?>

    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
      <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

        <div class="comment-author vcard">
          <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div><!-- .comment-author -->

        <div class="comment-container">
          <header class="comment-meta">
            <?php printf( __( '%s <span class="says screen-reader-text">says:</span>', 'TheThemeName' ), sprintf( '<cite class="fn author-name">%s</cite>', get_comment_author_link() ) ); ?>

            <a class="comment-permalink entry-meta" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">

              <?php echo get_svg( array( 'icon' => 'clock-o' ) ); ?>
              <time datetime="<?php comment_time( 'c' ); ?>"><?php printf( esc_html__( '%s ago', 'TheThemeName' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time></a>
              <?php edit_comment_link( esc_html__( 'Edit', 'TheThemeName' ), '<span class="edit-link">', '</span>' ); ?>
            </header><!-- .comment-meta -->
            <?php if ( '0' == $comment->comment_approved ) : ?>
              <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'TheThemeName' ); ?></p>
            <?php endif; ?>
            <div class="comment-content">
              <?php comment_text(); ?>
            </div><!-- .comment-content -->
            <?php comment_reply_link(
              array_merge( $args,
              array(
    						'add_below' => 'div-comment',
    						'depth'     => $depth,
    						'max_depth' => $args['max_depth'],
    						'before'    => '<span class="reply">',
    						'after'     => '</span>',
    					) ) );
    				?>
          </div><!-- .comment-content -->

        </article><!-- .comment-body -->
        <?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
        <?php
      endif;
    }
function html5blankcomments( $comment, $args, $depth ) {
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
  <?php
}
