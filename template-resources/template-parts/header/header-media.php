<?php
/**
 * Display Header Media
 *
 * @package creativityarchitect
 */

if ( 'disable' === get_theme_mod( 'creativityarchitect_header_media_option', 'entire-site' ) ) {
	return;
}

$header_image = creativityarchitect_featured_overall_image();

$header_media_text = creativityarchitect_has_header_media_text();

if ( ( ( is_header_video_active() && has_header_video() ) || 'disable' !== $header_image ) ) :
?>
<div class="custom-header header-media">
	<div class="wrapper">
		<div class="custom-header-media">
			<?php
			if ( is_header_video_active() && has_header_video() ) {
				the_custom_header_markup();
			} elseif ( 'disable' !== $header_image ) {
				echo '<div id="wp-custom-header" class="wp-custom-header"><img src="' . esc_url( $header_image ) . '"/></div>	';
			}
			?>
			<?php creativityarchitect_header_media_text(); ?>

			<?php if ( get_theme_mod( 'creativityarchitect_header_media_scroll_down', 1 ) ) : ?>
					<div class="scroll-down">
						<span><?php esc_html_e( 'Scroll', 'creativityarchitect' ); ?></span>
						<?php echo creativityarchitect_get_svg( array( 'icon' => 'angle-down' ) ); ?>
					</div><!-- .scroll-down -->
			<?php endif; ?>

		</div>
	</div><!-- .wrapper -->
	<div class="custom-header-overlay"></div><!-- .custom-header-overlay -->
</div><!-- .custom-header -->
<?php endif; ?>
