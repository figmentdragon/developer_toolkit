<?php /* Template Name: Archive */ ?>

<?php get_header(); ?>

<?php get_sidebar(); ?>

	<main role="main" aria-label="Content">
		<!-- section -->
		<section>

			<h2><?php esc_html_e( 'Archives', 'THEMENAME' ); ?></h2>

			<?php get_template_part( 'loop' ); ?>

			<?php get_template_part( 'pagination' ); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
