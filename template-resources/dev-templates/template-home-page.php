<?php
/**
 * Template Name: Home Page
 *
 * @package andre
 */

get_header(); ?>

<div id="wrapper">
	<div class="homewrapper">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div class="topwidget">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
		<?php endif ?>

		<?php if ( has_header_image() ) : ?>
			<img class="headerimg" src="<?php header_image(); ?>" />
		<?php endif ?>
	</div>
</div>
<?php get_footer(); ?>
