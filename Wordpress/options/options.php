<?php
/**
 * Options.
 *
 * @package THEMENAE
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Load metaboxes.
 */
function metabox_setup() {
	add_action( 'add_meta_boxes', 'metaboxes' );
}
add_action( 'load-post.php', 'metabox_setup' );
add_action( 'load-post-new.php', 'metabox_setup' );

/**
 * Metaboxes.
 */
function metaboxes() {
	// Get public post types.
	$post_types = get_post_types( array( 'public' => true ) );
	// Remove post types from array.
	unset( $post_types['hooks'], $post_types['elementor_library'], $post_types['fl-builder-template'] );
	// Add options metabox.
	add_meta_box( 'TheThemeName', __( 'Template Settings', 'TheThemeName' ), 'options_metabox_callback', $post_types, 'side', 'default' );
	// Add sidebar metabox.
	add_meta_box( 'sidebar', __( 'Sidebar', 'TheThemeName' ), 'sidebar_metabox_callback', $post_types, 'side', 'default' );
}

/**
 * Options metabox callback.
 *
 * @param object $post The post oject.
 */
function options_metabox_callback( $post ) {

	wp_nonce_field( "post_{$post->ID}_options_nonce", 'options_nonce' );

	$stored_meta = get_post_meta( $post->ID, 'options', true );
	$stored_meta = empty( $stored_meta ) ? array() : $stored_meta;

	if ( in_array( 'remove-title', $stored_meta, true ) ) {
		$remove_title = 'remove-title';
	} else {
		$remove_title = false;
	}

	if ( in_array( 'full-width', $stored_meta, true ) ) {
		$width_type = 'full-width';
	} elseif ( in_array( 'contained', $stored_meta, true ) ) {
		$width_type = 'contained';
	} elseif ( in_array( 'custom-width', $stored_meta, true ) ) {
		$width_type = 'custom-width';
	} else {
		$width_type = 'layout-global';
	}

	if ( in_array( 'remove-featured', $stored_meta, true ) ) {
		$remove_featured = 'remove-featured';
	} else {
		$remove_featured = false;
	}

	if ( in_array( 'remove-header', $stored_meta, true ) ) {
		$remove_header = 'remove-header';
	} else {
		$remove_header = false;
	}

	if ( in_array( 'remove-footer', $stored_meta, true ) ) {
		$remove_footer = 'remove-footer';
	} else {
		$remove_footer = false;
	}

	$custom_width_value = isset( $stored_meta['custom_width_value'] ) ? $stored_meta['custom_width_value'] : '';

	?>

	<h4><?php _e( 'Layout', 'TheThemeName' ); ?></h4>

	<div>
		<input id="layout-global" type="radio" name="options[]" value="layout-global" class="layout-option" <?php checked( $width_type, 'layout-global' ); ?> />
		<label for="layout-global"><?php _e( 'Inherit Global Settings', 'TheThemeName' ); ?></label>
		<?php
		if ( ! is_premium() ) {
			echo '<a style="text-decoration: none; box-shadow: none;" href="https://wp-pagebuilderframework.com/docs/global-template-settings/" target="_blank"><i style="font-size: 18px; margin-top: -3px; width: 15px; height: 15px;" class="dashicons dashicons-editor-help"></i></a>';
		}
		?>
	</div>

	<div>
		<input id="layout-full-width" type="radio" name="options[]" value="full-width" class="layout-option" <?php checked( $width_type, 'full-width' ); ?> />
		<label for="layout-full-width"><?php _e( 'Full Width', 'TheThemeName' ); ?></label>
	</div>

	<div>
		<input id="layout-contained" type="radio" name="options[]" value="contained" class="layout-option" <?php checked( $width_type, 'contained' ); ?> />
		<label for="layout-contained"><?php _e( 'Contained', 'TheThemeName' ); ?></label>
	</div>

	<div>
		<input id="layout-custom-width" type="radio" name="options[]" value="custom-width" class="layout-option" <?php checked( $width_type, 'custom-width' ); ?> />
		<label for="layout-custom-width"><?php _e( 'Custom Width', 'TheThemeName' ); ?></label>
	</div>

	<div class="layout-custom-width-field-wrapper<?php echo esc_attr( 'custom-width' === $width_type ? '' : ' is-hidden' ); ?>">
		<input id="layout-custom-width-value" name="options[custom_width_value]" value="<?php echo esc_attr( $custom_width_value ); ?>" />
	</div>

	<h4><?php _e( 'Disable Elements', 'TheThemeName' ); ?></h4>

	<div>
		<input id="remove-title" type="checkbox" name="options[]" value="remove-title" <?php checked( $remove_title, 'remove-title' ); ?> />
		<label for="remove-title"><?php _e( 'Page Title', 'TheThemeName' ); ?></label>
	</div>

	<div>
		<input id="remove-featured" type="checkbox" name="options[]" value="remove-featured" <?php checked( $remove_featured, 'remove-featured' ); ?> />
		<label for="remove-featured"><?php _e( 'Featured Image', 'TheThemeName' ); ?></label>
	</div>

	<div>
		<input id="remove-header" type="checkbox" name="options[]" value="remove-header" <?php checked( $remove_header, 'remove-header' ); ?> />
		<label for="remove-header"><?php _e( 'Header', 'TheThemeName' ); ?></label>
	</div>

	<div>
		<input id="remove-footer" type="checkbox" name="options[]" value="remove-footer" <?php checked( $remove_footer, 'remove-footer' ); ?> />
		<label for="remove-footer"><?php _e( 'Footer', 'TheThemeName' ); ?></label>
	</div>

	<?php

}

/**
 * Sidebar metabox callback.
 *
 * @param object $post The post object.
 */
function sidebar_metabox_callback( $post ) {

	wp_nonce_field( "post_{$post->ID}_sidebar_nonce", 'sidebar_nonce' );

	$sidebar_position = get_post_meta( $post->ID, 'sidebar_position', true );
	$sidebar_position = ! empty( $sidebar_position ) ? $sidebar_position : 'global';

	?>

	<div>
		<input id="sidebar-global" type="radio" name="sidebar_position" value="global" <?php checked( $sidebar_position, 'global' ); ?> />
		<label for="sidebar-global"><?php _e( 'Inherit Global Settings', 'TheThemeName' ); ?></label>
	</div>

	<div>
		<input id="sidebar-right" type="radio" name="sidebar_position" value="right" <?php checked( $sidebar_position, 'right' ); ?> />
		<label for="sidebar-right"><?php _e( 'Right Sidebar', 'TheThemeName' ); ?></label>
	</div>

	<div>
		<input id="sidebar-left" type="radio" name="sidebar_position" value="left" <?php checked( $sidebar_position, 'left' ); ?> />
		<label for="sidebar-left"><?php _e( 'Left Sidebar', 'TheThemeName' ); ?></label>
	</div>

	<div>
		<input id="no-sidebar" type="radio" name="sidebar_position" value="none" <?php checked( $sidebar_position, 'none' ); ?> />
		<label for="no-sidebar"><?php _e( 'No Sidebar', 'TheThemeName' ); ?></label>
	</div>

	<?php

}

/**
 * Save metadata.
 *
 * @param integer $post_id The post ID.
 * @param WP_Post $post The Instance of WP_Post object.
 * @param bool    $update Whether this is an existing post being updated.
 */
function save_metadata( $post_id, $post, $update ) {
	$is_autosave            = wp_is_post_autosave( $post_id );
	$is_revision            = wp_is_post_revision( $post_id );
	$is_valid_nonce         = ( isset( $_POST['options_nonce'] ) && wp_verify_nonce( $_POST['options_nonce'], "post_{$post_id}_options_nonce" ) ) ? true : false;
	$is_valid_sidebar_nonce = ( isset( $_POST['sidebar_nonce'] ) && wp_verify_nonce( $_POST['sidebar_nonce'], "post_{$post_id}_sidebar_nonce" ) ) ? true : false;

	// Stop here if autosave, revision or nonce is invalid.
	if ( $is_autosave || $is_revision || ! $is_valid_nonce || ! $is_valid_sidebar_nonce ) {
		return;
	}

	// Stop if current user can't edit posts.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// Save options metadata.
	$checked = array();
	if ( isset( $_POST['options'] ) ) {
		if ( in_array( 'remove-title', $_POST['options'], true ) ) {
			$checked[] .= 'remove-title';
		}
		if ( in_array( 'full-width', $_POST['options'], true ) ) {
			$checked[] .= 'full-width';
		}
		if ( in_array( 'contained', $_POST['options'], true ) ) {
			$checked[] .= 'contained';
		}
		if ( in_array( 'custom-width', $_POST['options'], true ) ) {
			$checked[] .= 'custom-width';
		}
		if ( isset( $_POST['options']['custom_width_value'] ) ) {
			$checked['custom_width_value'] = $_POST['options']['custom_width_value'];
		}
		if ( in_array( 'layout-global', $_POST['options'], true ) ) {
			$checked[] .= 'layout-global';
		}
		if ( in_array( 'remove-featured', $_POST['options'], true ) ) {
			$checked[] .= 'remove-featured';
		}
		if ( in_array( 'remove-header', $_POST['options'], true ) ) {
			$checked[] .= 'remove-header';
		}
		if ( in_array( 'remove-footer', $_POST['options'], true ) ) {
			$checked[] .= 'remove-footer';
		}
	}
	update_post_meta( $post_id, 'options', $checked );
	// Save sidebar metadata.
	$sidebar_position = isset( $_POST['sidebar_position'] ) ? $_POST['sidebar_position'] : '';
	update_post_meta( $post_id, 'sidebar_position', $sidebar_position );
}
add_action( 'save_post', 'save_metadata', 10, 3 );

/**
 * Prepare custom column(s) setup.
 */
function prepare_post_list_custom_columns() {
	$post_types = get_post_types( array( 'public' => true ) );
	foreach ( $post_types as $post_type ) {
		add_filter( "manage_{$post_type}_posts_columns", 'post_list_columns' );
		add_action( "manage_{$post_type}_posts_custom_column", 'post_list_custom_column', 10, 2 );
	}

}
add_action( 'admin_init', 'prepare_post_list_custom_columns' );

/**
 * Manage posts columns.
 *
 * At least 1 custom column is needed for us to be able
 * to add custom fields to quick edit box in post list screen.
 *
 * @param array $columns The existing columns.
 * @return array The modified columns.
 */
function post_list_columns( $columns ) {
	$columns['layout'] = __( 'Layout', 'TheThemeName' );
	return $columns;
}

/**
 * Manage posts custom column content.
 *
 * @param string $column_name The name of the column to display.
 * @param int    $post_id The current post ID.
 */
function post_list_custom_column( $column_name, $post_id ) {

	if ( 'layout' !== $column_name ) {
		return;
	}

	$post_options = get_post_meta( $post_id, 'options', true );
	$post_options = $post_options ? $post_options : array();
	$column_value = '';

	if ( in_array( 'full-width', $post_options, true ) ) {
		$layout = 'full-width';

		$column_value = __( 'Full Width', 'TheThemeName' );
	} elseif ( in_array( 'contained', $post_options, true ) ) {
		$layout = 'contained';

		$column_value = __( 'Contained', 'TheThemeName' );
	} else {
		$layout = 'layout-global';

		$column_value = __( 'Inherit Global Settings', 'TheThemeName' );
	}

	$checked_removals = array();

	if ( in_array( 'remove-title', $post_options, true ) ) {
		array_push( $checked_removals, 'remove-title' );
	}

	if ( in_array( 'remove-featured', $post_options, true ) ) {
		array_push( $checked_removals, 'remove-featured' );
	}

	if ( in_array( 'remove-header', $post_options, true ) ) {
		array_push( $checked_removals, 'remove-header' );
	}

	if ( in_array( 'remove-footer', $post_options, true ) ) {
		array_push( $checked_removals, 'remove-footer' );
	}

	$removals = implode( ',', $checked_removals );

	$sidebar_position = get_post_meta( $post_id, 'sidebar_position', true );
	$sidebar_position = ! empty( $sidebar_position ) ? $sidebar_position : 'global';

	$options_nonce = wp_create_nonce( "post_{$post_id}_options_nonce" );
	$sidebar_nonce = wp_create_nonce( "post_{$post_id}_sidebar_nonce" );

	$custom_data_attr = apply_filters( 'post_list_quick_edit_preset_data_attr', '', $post_id );
	?>

	<span class="quick-edit-column-value"><?php echo esc_html( $column_value ); ?></span>

	<input
		type="hidden"
		class="quick-edit-preset-values"
		data-layout="<?php echo $layout; ?>"
		data-checked-removals="<?php echo esc_attr( $removals ); ?>"
		data-sidebar-position="<?php echo esc_attr( $sidebar_position ); ?>"
		data-options-nonce="<?php echo esc_attr( $options_nonce ); ?>"
		data-sidebar-nonce="<?php echo esc_attr( $sidebar_nonce ); ?>"
		<?php echo $custom_data_attr; ?>
	>

	<?php

}
