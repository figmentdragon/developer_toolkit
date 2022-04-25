<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package THEMENAE
 */

if ( ! is_active_sidebar( 'THEMENAE-sidebar-right' ) ) {
    return;
}
?>
<?php
	$woo_page = THEMENAE_is_realy_woocommerce_page();
?>
<?php if( THEMENAE_get_sidebar_layout() == "right_sidebar" || $woo_page ) : ?>
    <div id="secondary" class="widget-area">
        <?php dynamic_sidebar( 'THEMENAE-sidebar-right' ); ?>
    </div><!-- #secondary -->
<?php endif;
