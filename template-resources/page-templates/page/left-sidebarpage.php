<?php
/**
 * Template Name: Left Sidebar Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme
 */

get_header(); ?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<!-- sidebar -->
      <?php get_sidebar(); ?>
      <div class="col-md-8 col-xxl-9 order-first order-md-last">

        <main id="main" class="site-main">

					<?php
					while ( have_posts() ) {
						the_post();

						get_template_part( 'loop-templates/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					}
					?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
