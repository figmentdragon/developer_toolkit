<?php
/**
 * Customize API: Customize_Notice_Control class
 *
 * @package WordPress
 * @subpackage creativity
 * @since creativity 1.0
 */

/**
 * Customize Notice Control class.
 *
 * @since creativity 1.0
 *
 * @see WP_Customize_Control
 */
class Customize_Notice_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @since creativity 1.0
	 *
	 * @var string
	 */
	public $type = 'creativity-notice';

	/**
	 * Renders the control content.
	 *
	 * This simply prints the notice we need.
	 *
	 * @since creativity 1.0
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<div class="notice notice-warning">
			<p><?php esc_html_e( 'To access the Dark Mode settings, select a light background color.', 'creativity' ); ?></p>
			<p><a href="<?php echo esc_url( __( 'https://wordpress.org/support/article/creativity/#dark-mode-support', 'creativity' ) ); ?>">
				<?php esc_html_e( 'Learn more about Dark Mode.', 'creativity' ); ?>
			</a></p>
		</div>
		<?php
	}
}
