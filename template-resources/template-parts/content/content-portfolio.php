<?php
/**
 * The template used for displaying projects on index view
 *
 * @package themename
 */

$layout = 'layout-three';

global $post;

$categories_list = get_the_category();

$classes = 'grid-item';
foreach ( $categories_list as $themename_cat ) {
	$classes .= ' ' . $themename_cat->slug ;
}
?>

<article id="portfolio-post-<?php the_ID(); ?>" <?php post_class( esc_attr( $classes ) ); ?>>
	<div class="hentry-inner">
		<?php themename_post_thumbnail( 'themename-portfolio' ); ?>

		<div class="entry-container">
			<header class="entry-header">

				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

				<div class="entry-meta">
					<?php themename_posted_on(); ?>
				</div>

			</header>
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
