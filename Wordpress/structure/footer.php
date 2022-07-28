<?php
/**
 * Footer elements.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'construct_footer' ) ) {
	add_action( 'footer', 'construct_footer' );
	/**
	 * Build our footer.
	 *
	 */
	function construct_footer() {
		?>
		<footer id="site-info" class="site-footer" role="contentinfo" itemtype="https://schema.org/WPFooter" itemscope="itemscope">
      <div id="copyright" class="small copyright">
        <span>
        <?php do_action( 'credits' ); ?>
				</div>
			</div>
		</footer><!-- .site-info -->
		<?php
	}
}

if ( ! function_exists( 'footer_bar' ) ) {
	add_action( 'before_copyright', 'footer_bar', 15 );
	/**
	 * Build our footer bar
	 *
	 */
	function footer_bar() {
		if ( ! is_active_sidebar( 'footer-bar' ) ) {
			return;
		}
		?>
		<div class="footer-bar">
			<?php dynamic_sidebar( 'footer-bar' ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'add_footer_info' ) ) {
	add_action( 'credits', 'add_footer_info' );
	/**
	 * Add the copyright to the footer
	 *
	 */
	function add_footer_info() {
    echo copyright();
    echo esc_html( bloginfo( 'name' ) ) . '</span> &bull; ' . esc_html__( 'Powered by', '' ) . ' <a href="' . esc_url( theme_uri_link() ) . '" itemprop="url">' . esc_html__( 'themename', '' ) . '</a>';
	}
}

/**
 * Build our individual footer widgets.
 * Displays a sample widget if no widget is found in the area.
 *
 *
 * @param int $widget_width The width class of our widget.
 * @param int $widget The ID of our widget.
 */
function do_footer_widget( $widget_width, $widget ) {
	$widget_width = apply_filters( "footer_widget_{$widget}_width", $widget_width );
	$tablet_widget_width = apply_filters( "footer_widget_{$widget}_tablet_width", '50' );
	?>
	<div class="footer-widget-<?php echo absint( $widget ); ?> grid-parent grid-<?php echo absint( $widget_width ); ?> tablet-grid-<?php echo absint( $tablet_widget_width ); ?> mobile-grid-100">
		<?php if ( ! dynamic_sidebar( 'footer-' . absint( $widget ) ) ) :
	        $current_user = wp_get_current_user();
	        if (user_can( $current_user, 'administrator' )) { ?>
			<aside class="widget inner-padding widget_text">
				<h4 class="widget-title"><?php esc_html_e( 'Footer Widget', '' );?></h4>
				<div class="textwidget">
					<p>
						<?php esc_html_e( 'Replace this widget content by going to ', '' ); ?><a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>"><strong><?php esc_html_e('Appearance / Widgets', '' ); ?></strong></a><?php esc_html_e( ' and dragging widgets into this widget area.', '' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'To remove or choose the number of footer widgets, go to ', '' ); ?><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><strong><?php esc_html_e('Appearance / Customize / Layout / Footer Widgets', '' ); ?></strong></a><?php esc_html_e( '.', '' ); ?>
					</p>
				</div>
			</aside>
		<?php } endif; ?>
	</div>
	<?php
}

if ( ! function_exists( 'construct_footer_widgets' ) ) {
	add_action( 'footer', 'construct_footer_widgets', 5 );
	/**
	 * Build our footer widgets.
	 *
	 */
	function construct_footer_widgets() {
		// Get how many widgets to show.
		$widgets = get_footer_widgets();

		if ( ! empty( $widgets ) && 0 !== $widgets ) :

			// Set up the widget width.
			$widget_width = '';
			if ( $widgets == 1 ) {
				$widget_width = '100';
			}

			if ( $widgets == 2 ) {
				$widget_width = '50';
			}

			if ( $widgets == 3 ) {
				$widget_width = '33';
			}

			if ( $widgets == 4 ) {
				$widget_width = '25';
			}

			if ( $widgets == 5 ) {
				$widget_width = '20';
			}
			?>
			<div id="footer-widgets" class="site footer-widgets">
				<div <?php inside_footer_class(); ?>>
					<div class="inside-footer-widgets">
						<?php
						if ( $widgets >= 1 ) {
							do_footer_widget( $widget_width, 1 );
						}

						if ( $widgets >= 2 ) {
							do_footer_widget( $widget_width, 2 );
						}

						if ( $widgets >= 3 ) {
							do_footer_widget( $widget_width, 3 );
						}

						if ( $widgets >= 4 ) {
							do_footer_widget( $widget_width, 4 );
						}

						if ( $widgets >= 5 ) {
							do_footer_widget( $widget_width, 5 );
						}
						?>
					</div>
				</div>
			</div>
		<?php
		endif;

		/**
		 * after_footer_widgets hook.
		 *
		 */
		do_action( 'after_footer_widgets' );
	}
}

if ( ! function_exists( 'back_to_top' ) ) {
	add_action( 'after_footer', 'back_to_top', 2 );
	/**
	 * Build the back to top button
	 *
	 */
	function back_to_top() {
		$settings = wp_parse_args(
			get_option( 'settings', array() ),
			get_defaults()
		);

		if ( 'enable' !== $settings[ 'back_to_top' ] ) {
			return;
		}

		echo '<a title="' . esc_attr__( 'Scroll back to top', '' ) . '" rel="nofollow" href="#" class="-back-to-top" style="opacity:0;visibility:hidden;" data-scroll-speed="' . absint( apply_filters( 'back_to_top_scroll_speed', 400 ) ) . '" data-start-scroll="' . absint( apply_filters( 'back_to_top_start_scroll', 300 ) ) . '">
				<span class="screen-reader-text">' . esc_html__( 'Scroll back to top', '' ) . '</span>
			</a>';
	}
}

add_action( 'after_footer', 'side_padding_footer', 5 );
/**
 * Add holder div if sidebar padding is enabled
 *
 */
function side_padding_footer() {
	$settings = wp_parse_args(
		get_option( 'spacing_settings', array() ),
		spacing_get_defaults()
	);

	$fixed_side_content   =  get_setting( 'fixed_side_content' );
	$socials_display_side =  get_setting( 'socials_display_side' );

	if ( ( $settings[ 'side_top' ] != 0 ) || ( $settings[ 'side_right' ] != 0 ) || ( $settings[ 'side_bottom' ] != 0 ) || ( $settings[ 'side_left' ] != 0 ) ) { ?>
    	<div class="-side-left-cover"></div>
    	<div class="-side-right-cover"></div>
	</div>
	<?php }
	if ( ( $fixed_side_content != '' ) || ( $socials_display_side == true ) ) { ?>
    <div class="-side-left-content">
        <?php if ( $socials_display_side == true ) { ?>
        <div class="-side-left-socials">
        <?php do_action( 'social_bar_action' ); ?>
        </div>
        <?php } ?>
        <?php if ( $fixed_side_content != '' ) { ?>
    	<div class="-side-left-text">
        <?php echo wp_kses_post( $fixed_side_content ); ?>
        </div>
        <?php } ?>
    </div>
    <?php
	}
}
