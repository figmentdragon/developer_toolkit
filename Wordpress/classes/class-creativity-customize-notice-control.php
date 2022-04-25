<?php
/**
 * Customize API: themename_Customize_Notice_Control class
 *
 * @package WordPress
 * @subpackage themename
 * @since themename 1.0
 */

/**
 * Customize Notice Control class.
 *
 * @since themename 1.0
 *
 * @see WP_Customize_Control
 */
class themename_Customize_Notice_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @since themename 1.0
	 *
	 * @var string
	 */
	public $type = 'themename-notice';

	/**
	 * Renders the control content.
	 *
	 * This simply prints the notice we need.
	 *
	 * @since themename 1.0
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<div class="notice notice-warning">
			<p><?php esc_html_e( 'To access the Dark Mode settings, select a light background color.', 'themename' ); ?></p>
			<p><a href="<?php echo esc_url( __( 'https://wordpress.org/support/article/themename/#dark-mode-support', 'themename' ) ); ?>">
				<?php esc_html_e( 'Learn more about Dark Mode.', 'themename' ); ?>
			</a></p>
		</div>
		<?php
	}
}
