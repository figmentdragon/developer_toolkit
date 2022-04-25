<?php
/**
 * The Left sidebar containing the main widget area.
 *
 * @package THEMENAE
 */

if ( ! is_active_sidebar( 'THEMENAE-sidebar-left' ) ) {
    return;
}
?>

<?php if( THEMENAE_get_sidebar_layout() == "left_sidebar" ) : ?>
    <div id="secondary" class="widget-area">
        <?php dynamic_sidebar( 'THEMENAE-sidebar-left' ); ?>
    </div><!-- #secondary -->
<?php endif;
