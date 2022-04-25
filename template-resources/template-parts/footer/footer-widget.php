<?php
/**
 * Displays footer widgets if assigned
 *
 * @package Chique
 */

?>

<?php
if ( is_active_sidebar( 'sidebar-2' ) ||
	 is_active_sidebar( 'sidebar-3' ) ||
	 is_active_sidebar( 'sidebar-4' ) ) :
?>

	<aside id="tertiary" <?php chique_footer_sidebar_class(); ?> role="complementary">
		<div class="wrapper">
			<?php
			if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
				<div class="widget-column footer-widget-1">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			<?php }
			if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
				<div class="widget-column footer-widget-2">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
			<?php }
			if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
				<div class="widget-column footer-widget-3">
					<?php dynamic_sidebar( 'sidebar-4' ); ?>
				</div>
			<?php } ?>
		</div>
	</aside><!-- .widget-area -->

<?php endif;
