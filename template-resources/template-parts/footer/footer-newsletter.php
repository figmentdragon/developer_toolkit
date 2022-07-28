<?php
/**
 * Displays footer widgets if assigned
 *
 * @package creativityarchitect
 */

if ( ! is_active_sidebar( 'sidebar-newsletter' ) ) {
	// Bail if there is no widget in newsletter sidebar.
	return;
}

?>

<div id="footer-newsletter" class="widget-area section" role="complementary">
	<div class="wrapper">
		<div class="footer-newsletter">
			<?php dynamic_sidebar( 'sidebar-newsletter' ); ?>
		</div>
	</div><!-- .wrapper -->
</div><!-- .widget-area -->
