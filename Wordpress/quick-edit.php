<?php
/**
 * Quick edit.
 *
 * @package THEMENAE
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Add layout options to quick edit box.
 *
 * @see https://developer.wordpress.org/reference/hooks/quick_edit_custom_box/
 *
 * @param string $column_name Name of the column to edit.
 * @param string $post_type The post type slug, or current screen name if this is a taxonomy list table.
 * @param string $taxonomy The taxonomy name, if any.
 */
function quick_edit_layout( $column_name, $post_type, $taxonomy ) {

	if ( 'layout' !== $column_name ) {
		return;
	}

	?>

	<div class="quick-edit">
		<div class="quick-edit-row has-4">

			<div class="quick-edit-col">
				<h4>
					<?php _e( 'Layout', 'TheThemeName' ); ?>
				</h4>

				<div class="quick-edit-fields-area" data-fields-group-name="layout" data-fields-group-type="radio">

					<div class="quick-edit-field quick-edit-radio-field">
						<div class="quick-edit-control">
							<input type="radio" name="options[]" value="layout-global" class="quick-edit-use-preset" data-preset-name="layout" />
						</div>
						<label for="" class="quick-edit-label">
							<?php _e( 'Inherit Global Settings', 'TheThemeName' ); ?>
						</label>
					</div>

					<div class="quick-edit-field quick-edit-radio-field">
						<div class="quick-edit-control">
							<input type="radio" name="options[]" value="full-width" class="quick-edit-use-preset" data-preset-name="layout" />
						</div>
						<label for="" class="quick-edit-label">
							<?php _e( 'Full Width', 'TheThemeName' ); ?>
						</label>
					</div>

					<div class="quick-edit-field quick-edit-radio-field">
						<div class="quick-edit-control">
							<input type="radio" name="options[]" value="contained" class="quick-edit-use-preset" data-preset-name="layout" />
						</div>
						<label for="" class="quick-edit-label">
							<?php _e( 'Contained', 'TheThemeName' ); ?>
						</label>
					</div>

				</div>

				<?php do_action( 'post_list_quick_edit_column_1', $column_name, $post_type, $taxonomy ); ?>

			</div>

			<div class="quick-edit-col">
				<h4>
					<?php _e( 'Disable Elements', 'TheThemeName' ); ?>
				</h4>

				<div class="quick-edit-fields-area" data-fields-group-name="checked-removals" data-fields-group-type="checkbox">

					<div class="quick-edit-field quick-edit-checkbox-field">
						<div class="quick-edit-control">
							<input type="checkbox" name="options[]" value="remove-title" class="quick-edit-use-preset" data-preset-name="checked-removals" />
						</div>
						<label for="" class="quick-edit-label">
							<?php _e( 'Page Title', 'TheThemeName' ); ?>
						</label>
					</div>

					<div class="quick-edit-field quick-edit-checkbox-field">
						<div class="quick-edit-control">
							<input type="checkbox" name="options[]" value="remove-featured" class="quick-edit-use-preset" data-preset-name="checked-removals" />
						</div>
						<label for="" class="quick-edit-label">
							<?php _e( 'Featured Image', 'TheThemeName' ); ?>
						</label>
					</div>

					<div class="quick-edit-field quick-edit-checkbox-field">
						<div class="quick-edit-control">
							<input type="checkbox" name="options[]" value="remove-header" class="quick-edit-use-preset" data-preset-name="checked-removals" />
						</div>
						<label for="" class="quick-edit-label">
							<?php _e( 'Header', 'TheThemeName' ); ?>
						</label>
					</div>

					<div class="quick-edit-field quick-edit-checkbox-field">
						<div class="quick-edit-control">
							<input type="checkbox" name="options[]" value="remove-footer" class="quick-edit-use-preset" data-preset-name="checked-removals" />
						</div>
						<label for="" class="quick-edit-label">
							<?php _e( 'Footer', 'TheThemeName' ); ?>
						</label>
					</div>

				</div>

				<?php do_action( 'post_list_quick_edit_column_2', $column_name, $post_type, $taxonomy ); ?>

			</div>

			<div class="quick-edit-col">
				<h4>
					<?php _e( 'Sidebar', 'TheThemeName' ); ?>
				</h4>

				<div class="quick-edit-fields-area" data-fields-group-name="sidebar-position" data-fields-group-type="radio">

					<div class="quick-edit-field quick-edit-radio-field">
						<div class="quick-edit-control">
							<input type="radio" name="sidebar_position" value="global" class="quick-edit-use-preset" data-preset-name="sidebar-position" />
						</div>
						<label for="" class="quick-edit-label">
							<?php _e( 'Inherit Global Settings', 'TheThemeName' ); ?>
						</label>
					</div>

					<div class="quick-edit-field quick-edit-radio-field">
						<div class="quick-edit-control">
							<input type="radio" name="sidebar_position" value="right" class="quick-edit-use-preset" data-preset-name="sidebar-position" />
						</div>
						<label for="" class="quick-edit-label">
							<?php _e( 'Right Sidebar', 'TheThemeName' ); ?>
						</label>
					</div>

					<div class="quick-edit-field quick-edit-radio-field">
						<div class="quick-edit-control">
							<input type="radio" name="sidebar_position" value="left" class="quick-edit-use-preset" data-preset-name="sidebar-position" />
						</div>
						<label for="" class="quick-edit-label">
							<?php _e( 'Left Sidebar', 'TheThemeName' ); ?>
						</label>
					</div>

					<div class="quick-edit-field quick-edit-radio-field">
						<div class="quick-edit-control">
							<input type="radio" name="sidebar_position" value="none" class="quick-edit-use-preset" data-preset-name="sidebar-position" />
						</div>
						<label for="" class="quick-edit-label">
							<?php _e( 'No Sidebar', 'TheThemeName' ); ?>
						</label>
					</div>

				</div>

				<?php do_action( 'post_list_quick_edit_column_3', $column_name, $post_type, $taxonomy ); ?>

			</div>

			<div class="quick-edit-col">
				<?php do_action( 'post_list_quick_edit_column_4', $column_name, $post_type, $taxonomy ); ?>
			</div>

		</div>

		<input type="hidden" name="options_nonce" class="quick-edit-nonce-field">
		<input type="hidden" name="sidebar_nonce" class="quick-edit-nonce-field">

		<?php do_action( 'post_list_quick_edit_nonce_field' ); ?>

	</div>

	<?php

}
add_action( 'quick_edit_custom_box', 'quick_edit_layout', 10, 3 );
