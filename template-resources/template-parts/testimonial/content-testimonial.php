<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Chique
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<div class="entry-container">
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div>
			<?php $position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); ?>
			<header class="entry-header">
				<h2 class="entry-title"><a href=<?php the_permalink(); ?>><?php the_title(); ?></a></h2>
				<?php if ( $position ) : ?>
					<p class="entry-meta"><span class="position">
						<?php echo esc_html( $position ); ?></span>
					</p>
				<?php endif; ?>
			</header>
		</div><!-- .entry-container -->	
	</div><!-- .hentry-inner -->
</article>
