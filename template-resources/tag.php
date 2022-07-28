<?php
/**
* Template Name: Tag
*
* @package WordPress
* @subpackage
* @since   1.0
*
*  The template for displaying tag-$id posts.
*
* @link https://codex.wordpress.org/Creating_an_Error_404_Page
*
*/
get_header(); ?>

	<main role="main" aria-label="Content">
		<!-- section -->
		<section>

			<h1><?php esc_html_e( 'Tag Archive: ', 'creativitycore' ); echo single_tag_title( '', false ); ?></h1>

			<?php get_template_part( 'loop' ); ?>

			<?php get_template_part( 'pagination' ); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
