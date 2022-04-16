<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
/**
 * Widgets and Sidebars
 *
 * WordPress Widgets add content and features to your Sidebars. Examples are
 * the default widgets that come with WordPress; for post categories, tag
 * clouds, navigation, search, etc.
 *
 * Sidebar is a theme feature introduced with Version 2.2. It's basically a
 * vertical column provided by a theme for displaying information other than
 * the main content of the web page. Themes usually provide at least one
 * sidebar at the left or right of the content. Sidebars usually contain
 * widgets that an administrator of the site can customize.
 *
 * @link https://codex.wordpress.org/WordPress_Widgets
 * @link https://codex.wordpress.org/Widgets_API
 * @link https://codex.wordpress.org/Sidebars
 */

/**
 * Remove recent comments inline style form WP <head>
 * Since function recent_comments_style() in wp-includes\default-widgets.php
 * checks for show_recent_comments_widget_style to be true, lets make it false
 * so it will not display inline css.
 * .recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
 * @link http://codex.wordpress.org/Function_Reference/_return_false
 */
function creativity_remove_recent_comments_style() {
  add_filter('show_recent_comments_widget_style', '__return_false');
}
add_action('widgets_init', 'creativity_remove_recent_comments_style');

/**
 * Add filter to the parameters passed to a widget's display callback.
 * The filter is evaluated on both the front and the back end!
 *
 * @link https://developer.wordpress.org/reference/hooks/dynamic_sidebar_params/
 */
add_filter( 'dynamic_sidebar_params', 'widget_classes' );

/**
 * Count number of visible widgets in a sidebar and add classes to widgets accordingly,
 * so widgets can be displayed one, two, three or four per row.
 *
 * @global array $sidebars_widgets
 *
 * @param array $params {
 *     Parameters passed to a widget’s display callback.
 *
 *     @type array $args  {
 *         An array of widget display arguments.
 *
 *         @type string $name          Name of the sidebar the widget is assigned to.
 *         @type string $id            ID of the sidebar the widget is assigned to.
 *         @type string $description   The sidebar description.
 *         @type string $class         CSS class applied to the sidebar container.
 *         @type string $before_widget HTML markup to prepend to each widget in the sidebar.
 *         @type string $after_widget  HTML markup to append to each widget in the sidebar.
 *         @type string $before_title  HTML markup to prepend to the widget title when displayed.
 *         @type string $after_title   HTML markup to append to the widget title when displayed.
 *         @type string $widget_id     ID of the widget.
 *         @type string $widget_name   Name of the widget.
 *     }
 *     @type array $widget_args {
 *         An array of multi-widget arguments.
 *
 *         @type int $number Number increment used for multiples of the same widget.
 *     }
 * }
 * @return array $params
 */
if ( ! function_exists( 'widget_classes' ) ) {
 function widget_classes( $params ) {
   global $sidebars_widgets;
   /*
	  * When the corresponding filter is evaluated on the front end
	  * this takes into account that there might have been made other changes.
	  */
	   $sidebars_widgets_count = apply_filters( 'sidebars_widgets', $sidebars_widgets );

	    // Only apply changes if sidebar ID is set and the widget's classes depend on the number of widgets in the sidebar.
	     if ( isset( $params[0]['id'] ) && strpos( $params[0]['before_widget'], 'dynamic-classes' ) ) {
  		$sidebar_id   = $params[0]['id'];
  		$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );

  		$widget_classes = 'widget-count-' . $widget_count;
  		if ( 0 === $widget_count % 4 || $widget_count > 6 ) {
  			// Four widgets per row if there are exactly four or more than six widgets.
  			$widget_classes .= ' col-md-3';
  		} elseif ( 6 === $widget_count ) {
  			// If exactly six widgets are published.
  			$widget_classes .= ' col-md-2';
  		} elseif ( $widget_count >= 3 ) {
  			// Three widgets per row if there's three or more widgets.
  			$widget_classes .= ' col-md-4';
  		} elseif ( 2 === $widget_count ) {
  			// If two widgets are published.
  			$widget_classes .= ' col-md-6';
  		} elseif ( 1 === $widget_count ) {
  			// If just on widget is active.
  			$widget_classes .= ' col-md-12';
  		}

  	// Replace the placeholder class 'dynamic-classes' with the classes stored in $widget_classes.
  		$params[0]['before_widget'] = str_replace( 'dynamic-classes', $widget_classes, $params[0]['before_widget'] );
  	}

  	return $params;
  }

} // End of if function_exists( 'widget_classes' ).
add_action( 'widgets_init', 'widgets_init' );


/**
 * Register Widgets and Widget Areas
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Creativity Architect
 * @author WebDevStudios
 * @return void
 * ------------------------------------------- */
function creativity_widgets_init() {
  // Define sidebars.
  $sidebars = [
    'sidebar-1' => esc_html__( 'Default Sidebar', 'creativityarchitect' ),
    'sidebar-2' => esc_html__( 'Sliding Sidebar', 'writing' ),
    'sidebar-3' => esc_htnl__( '404 Page Sidebar', 'writing' ),
    'sidebar-4' => esc_html__( 'Footer Full', 'creativityarchitect' ),
    'sidebar-5' => esc_html__( 'Footer Widgets-1', 'creativityarchitect' ),
    'sidebar-6' => esc_html__( 'Footer Widgets-2', 'creativityarchitect' ),
    'sidebar-7' => esc_html__( 'Footer Widgets-3', 'creativityarchitect' ),
    'sidebar-8' => esc_html__( 'Right Sidebar', 'creativityarchitect' ),
    'sidebar-9' => esc_html__( 'Left Sidebar', 'creativityarchitect' ),
    'sidebar-10' => esc_html__( 'Hero Canvas', 'creativityarchitect' ),
    'sidebar-11' => esc_html__( 'Hero Slider', 'creativityarchitect' ),
    'sidebar-12' => esc_html__( 'Top Full', 'creativityarchitect' ),
  ];

  // Loop through each sidebar and register.
  foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
		register_sidebar(
			[
				'name'          => $sidebar_name,
				'id'            => $sidebar_id,
				'description'   => /* translators: the sidebar name */ sprintf( esc_html__( 'Widget area for %s', 'creativityarchitect' ), $sidebar_name ),
				'before_widget' => '<aside class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);
	}


}
add_action('widgets_init', 'creativity_widgets_init');

/**
 * Declaring Custom Widgets
 * @package Creativity Architect
 * ------------------------------------------- */

// Call to Action
// @since creativity Widget Pack 1.0
 require get_template_directory() . '/inc/widgets/widget-call-to-action.php';

// Feature Box
// @since creativity Widget Pack 1.0
 require get_template_directory() . '/inc/widgets/widget-feature-box.php'

//  Widgets helper functions
// @since creativity Widget Pack 1.0
 require get_template_directory() . '/inc/widgets/widget-fields.php';

// Number Counter
//@since creativity Widget Pack 1.0
 require get_template_directory() . '/inc/widgets/widget-number-counter.php';

// Pricing
//@since creativity Widget Pack 1.0
 require get_template_directory() . '/inc/widgets/widget-pricing.php';

// Title
// @since creativity Widget Pack 1.0
 require get_template_directory() . '/inc/widgets/widget-title.php' ;
