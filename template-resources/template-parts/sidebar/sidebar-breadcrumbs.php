<?php
/**
 * For displaying breadcrumbs
 * @package creativity
*/

if ( ! is_active_sidebar( 'breadcrumbs' ) ) {
	return;
}
 
?>

<?php if ( !is_front_page() || ! is_home() ) : ?>
<div id="breadcrumbs-wrapper">
	<nav id="breadcrumb-sidebar" class="widget-area">
		<?php dynamic_sidebar( 'breadcrumbs' ); ?>
	</nav> 
</div>
<?php endif; ?>