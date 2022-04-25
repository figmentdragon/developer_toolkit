<?php
/**
 * The template for displaying Archive pages.
 *
 * @package THEMENAME
 */

get_header(); ?>

<div id="wrapper">
	<div class="innerwrapper">
		<div id="contentwrapper" class="content">
			<?php the_archive_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php the_archive_description( '<span class="taxonomy-description">', '</span>' ); ?>
			<?php if ( have_posts() ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();
						get_template_part( 'content', get_post_format() );
				endwhile;
				?>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<h2 class="center">
					<?php esc_html_e( 'Not Found', 'THEMENAME' ); ?>
				</h2>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
