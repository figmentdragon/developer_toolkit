<?php
/**
 * creativity architect widgets.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package creativity architect
 */

 if ( ! defined( 'ABSPATH' ) ) {
 	exit; // Exit if accessed directly.
 }

 /**
  * Register widget area.
  *
  * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
  *
  * @author WebDevStudios
  */
function creativity_widgets_init() {
  // Define sidebars.
  $sidebars = [
    'sidebar-1' => esc_html__( 'Sidebar 1', 'creativity' ),
    'sidebar-2' => esc_html__( 'Blog Sidebar', 'creativity' ),
    'right-sidebar' => esc_html__( 'Page Right Sidebar', 'creativity' ),
    'left-sidebar' => esc_html__( 'Page Left Sidebar', 'creativity' ),
    'banner' => esc_html__( 'Banner', 'creativity' ),
    'breadcrumbs' => esc_html__( 'Breadcrumbs', 'creativity' ),
    'bottom-1' => esc_html__( 'Bottom 1', 'creativity' ),
    'bottom-2' => esc_html__( 'Bottom 2', 'creativity' ),
    'bottom-3' => esc_html__( 'Bottom 3', 'creativity' ),
    'bottom-4' => esc_html__( 'Bottom 4', 'creativity' ),
    'footer' => esc_html__( 'Footer', 'creativity' ),
  ];
  // Loop through each sidebar and register.
  foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
     register_sidebar(
       [
         'name'          => $sidebar_name,
         'id'            => $sidebar_id,
         'description'   => /* translators: the sidebar name */ sprintf( esc_html__( 'Widget area for %s', 'creativity' ), $sidebar_name ),
         'before_widget' => '<aside class="widget %2$s">',
         'after_widget'  => '</aside>',
         'before_title'  => '<h2 class="widget-title">',
         'after_title'   => '</h2>',
       ]
     );
   }
}

function creativity_get_theme_widgets() {
  return
  [
    'inc/widgets/recent-posts-widget.php',
  ];
}
