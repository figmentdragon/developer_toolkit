<?php

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
function themename_remove_recent_comments_style() {
    add_filter('show_recent_comments_widget_style', '__return_false');
}

add_action('widgets_init', 'themename_remove_recent_comments_style');

/**
 * Register themename widget areas.
 *
 * @return void
 */
 /* --------
 register widgets
 ------------------------------------------- */
 function themename_widgets_init() {
 	register_sidebar(array(
 	    'name' => __('Default sidebar', 'writing'),
 	    'id' => 'sidebar-1',
 	    'description' => __('This is the default sidebar in your blog, add widgets here and it will appear on all pages have this sidebar'  , 'writing'),
 	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
 	    'after_widget' => "</div>",
 	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
 	    'after_title' => '</span></h4>',
 	));

 	register_sidebar(array(
 	    'name' => __('Sliding Sidebar', 'writing'),
 	    'id' => 'sidebar-2',
 	    'description' => __('This is the sliding side bar, it slides from the right side if you click on user info button'  , 'writing'),
 	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
 	    'after_widget' => "</div>",
 	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
 	    'after_title' => '</span></h4>',
 	));

 	register_sidebar(array(
 	    'name' => __('404 page sidebar', 'writing'),
 	    'id' => 'sidebar-3',
 	    'description' => __('Here you add widgets to 404 Error page'  , 'writing'),
 	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
 	    'after_widget' => "</div>",
 	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
 	    'after_title' => '</span></h4>',
 	));

 	register_sidebar(array(
 	    'name' => __('Footer Widgets 1', 'writing'),
 	    'id' => 'footer-1',
 	    'description' => '',
 	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
 	    'after_widget' => "</div>",
 	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
 	    'after_title' => '</span></h4>',
 	));

 	register_sidebar(array(
 	    'name' => __('Footer Widgets 2', 'writing'),
 	    'id' => 'footer-2',
 	    'description' => '',
 	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
 	    'after_widget' => "</div>",
 	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
 	    'after_title' => '</span></h4>',
 	));

 	register_sidebar(array(
 	    'name' => __('Footer Widgets 3', 'writing'),
 	    'id' => 'footer-3',
 	    'description' => '',
 	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
 	    'after_widget' => "</div>",
 	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
 	    'after_title' => '</span></h4>',
 	));

 }
add_action('widgets_init', 'themename_widgets_init');

/**
 * Widgets helper functions
 *
 * @since themename Widget Pack 1.0
 */

require get_template_directory() . '/inc/widgets/widget-fields.php';


/**
 * Number Counter
 *
 * @since themename Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widget-call-to-action.php';


/**
 * Number Counter
 *
 * @since themename Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widget-feature-box.php';


/**
 * Call to Action
 *
 * @since themename Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widget-number-counter.php' ;

/**
 * Feature Box
 *
 * @since themename Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widget-pricing.php' ;

/**
 * Title
 *
 * @since themename Widget Pack 1.0
 */
require get_template_directory() . '/inc/widgets/widget-title.php' ;
