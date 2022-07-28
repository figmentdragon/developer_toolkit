<?php
/**
 * Fix for Links Widget
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

 Class creativity_Links_Widget extends WP_Widget_Links {
    function widget( $args, $instance ) {
			$show_description = isset($instance['description']) ? $instance['description'] : false;
			$show_name = isset($instance['name']) ? $instance['name'] : false;
			$show_rating = isset($instance['rating']) ? $instance['rating'] : false;
			$show_images = isset($instance['images']) ? $instance['images'] : true;
			$category = isset($instance['category']) ? $instance['category'] : false;
			$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : 'name';
			$order = $orderby == 'rating' ? 'DESC' : 'ASC';
			$limit = isset( $instance['limit'] ) ? $instance['limit'] : -1;

			// $before_widget = preg_replace( '/id="[^"]*"/', 'id="%id"', $args['before_widget'] );

			$widget_links_args = array(
				'title_before'     => $args['before_title'],
				'title_after'      => $args['after_title'],
				'category_before'  => $args['before_widget'],
				'category_after'   => $args['after_widget'],
				'show_images'      => $show_images,
				'show_description' => $show_description,
				'show_name'        => $show_name,
				'show_rating'      => $show_rating,
				'category'         => $category,
				'class'            => 'linkcat widget',
				'orderby'          => $orderby,
				'order'            => $order,
				'limit'            => $limit,
			);

			/**
			 * Filters the arguments for the Links widget.
			 *
			 * @since 2.6.0
			 * @since 4.4.0 Added the `$instance` parameter.
			 *
			 * @see wp_list_bookmarks()
			 *
			 * @param array $widget_links_args An array of arguments to retrieve the links list.
			 * @param array $instance          The settings for the particular instance of the widget.
			 */
			wp_list_bookmarks( apply_filters( 'widget_links_args', $widget_links_args, $instance ) );
    }
}

function creativity_links_widget_register() {
    unregister_widget( 'WP_Widget_Links' );
    register_widget( 'creativity_Links_Widget' );
}
add_action( 'widgets_init', 'creativity_links_widget_register' );