<?php
/**
 * The template for displaying services posts on the front page
 *
 * @package TheCreativityArchitect
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<?php
		if( has_post_thumbnail() ) {
			TheCreativityArchitect_post_thumbnail( array(80, 80), 'html', true, false ); 
		}?>

		<div class="entry-container">
			<header class="entry-header">
				<div class="entry-category">
					<?php TheCreativityArchitect_cat_list(); ?>
				</div>

				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>

				<div class="entry-meta">
					<?php TheCreativityArchitect_posted_on(); ?>
				</div><!-- .entry-meta -->

			</header>

			<?php
				$excerpt = get_the_excerpt();
				echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
			 ?>
		</div><!-- .entry-container -->
	</div> <!-- .hentry-inner -->
</article> <!-- .article -->
