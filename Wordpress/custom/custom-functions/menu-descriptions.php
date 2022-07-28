<?php
/**
 * Menu Descriptions
 *
 * This file enables the display of descriptions within the Custom Menu widget.
 *
 * @package Longview
 * @since 1.0.0
 */

/**
 * Adds descriptions to menu item output
 *
 * Based partially on the menu implementation in the Twenty Fifteen theme.
 *
 * @since 1.0.0
 * @see http://www.binarymoon.co.uk/2015/04/adding-menu-descriptions-to-wordpress-menus/
 * @see https://developer.wordpress.org/reference/hooks/walker_nav_menu_start_el/
 * @param string $item_output The menu item's starting HTML output.
 * @param object $item Menu item data object.
 * @param int $depth Depth of menu item. Used for padding.
 * @param array $args An array of wp_nav_menu() arguments.
 * @return string $item_output The menu item's modified HTML output.
 */
function thmfdn_nav_description( $item_output, $item, $depth, $args ) {
    if ( empty( $args->theme_location ) && !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="thmfdn-menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }

    return $item_output;
}

/**
 * Adds class to menu list
 *
 * This function adds a class of 'thmfdn-descriptive-menu' to the unordered
 * list that holds the menu. This allows the descriptive menu to be styled
 * independently of the normal menu. By default, WordPress adds a class of
 * 'menu' at a later point in the menu output process. However, if a class
 * has already been specified, WordPress doesn't add its own. So, to keep
 * things consistent, this function adds the 'menu' class as well.
 *
 * @since 1.0.0
 * @see https://developer.wordpress.org/reference/hooks/widget_nav_menu_args/
 * @param array $nav_menu_args An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
 * @param stdClass $nav_menu Nav menu object for the current menu.
 * @param array $args Display arguments for the current widget.
 * @return array $args Updated menu args.
 */
function thmfdn_add_description_class( $nav_menu_args, $nav_menu, $args ) {
	$nav_menu_args['menu_class'] = 'menu thmfdn-descriptive-menu';

	return $nav_menu_args;
}

/**
 * Add description option to menu widget
 *
 * @since 1.0.0
 * @see https://developer.wordpress.org/reference/hooks/in_widget_form/
 * @param WP_Widget $widget The widget instance, passed by reference.
 * @param null $return Return null if new fields are added.
 * @param array $instance An array of the widget's settings.
 */
function thmfdn_add_menu_description_option( $widget, $return, $instance ) {

	// Are we dealing with a nav menu widget?
	if ( 'nav_menu' == $widget->id_base ) {

		// Display the description option.
		$description = isset( $instance['description'] ) ? $instance['description'] : '';
		?>
			<p>
				<input class="checkbox" type="checkbox" id="<?php echo $widget->get_field_id('description'); ?>" name="<?php echo $widget->get_field_name('description'); ?>" <?php checked( true , $description ); ?> />
				<label for="<?php echo $widget->get_field_id('description'); ?>">
					<?php _e( 'Show descriptions', 'thmfdn_textdomain' ); ?>
				</label>
			</p>
		<?php
	}
}
add_filter( 'in_widget_form', 'thmfdn_add_menu_description_option', 10, 3 );

/**
 * Filters widget during save
 *
 * Used to sanetize custom widget options.
 *
 * @since 1.0.0
 * @see https://developer.wordpress.org/reference/hooks/widget_update_callback/
 * @param array $instance The current widget instance's settings.
 * @param array $new_instance Array of new widget settings.
 * @return array $new_instance The updated array of new widget settings.
 */
function thmfdn_save_menu_description_option( $instance, $new_instance ) {

	// Is the instance a nav menu and are descriptions enabled?
	if ( isset( $new_instance['nav_menu'] ) && !empty( $new_instance['description'] ) ) {
		$new_instance['description'] = 1;
	}

	return $new_instance;
}
add_filter( 'widget_update_callback', 'thmfdn_save_menu_description_option', 10, 2 );

/**
 * Determines whether current menu should display descriptions
 *
 * @since 1.0.0
 * @see https://developer.wordpress.org/reference/hooks/dynamic_sidebar_params/
 * @param array $params The current widget settings/data
 * @return array $params Unmodified $params.
 */
function thmfdn_menu_description_control( $params ) {

	// Gets every custom menu widget from the database.
	$widget_settings = get_option('widget_nav_menu');

	// Does the current menu widget have descriptions turned on?
	if ( !empty( $widget_settings[$params[1]['number']]['description'] ) ) {

		// Adds filter to display menu item descriptions.
		add_filter( 'walker_nav_menu_start_el', 'thmfdn_nav_description', 10, 4 );
		add_filter( 'widget_nav_menu_args', 'thmfdn_add_description_class', 10, 3 );
	} else {

		// Removes filter to display menu item descriptions.
		remove_filter( 'walker_nav_menu_start_el', 'thmfdn_nav_description', 10, 4 );
		remove_filter( 'widget_nav_menu_args', 'thmfdn_add_description_class', 10, 3 );
	}

	// Return the unmodified $params.
	return $params;
}
add_filter( 'dynamic_sidebar_params', 'thmfdn_menu_description_control' );
