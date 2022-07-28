<?php
/**
 * The template for displaying testimonial items
 *
 * @package creativityarchitect
 */

$number = get_theme_mod( 'creativityarchitect_testimonial_number', 3 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

$args['post_type'] = 'jetpack-testimonial';

for ( $i = 1; $i <= $number; $i++ ) {
	$creativityarchitect_post_id = '';

	$creativityarchitect_post_id =  get_theme_mod( 'creativityarchitect_testimonial_cpt_' . $i );


	if ( $creativityarchitect_post_id && '' !== $creativityarchitect_post_id ) {
		// Polylang Support.
		if ( class_exists( 'Polylang' ) ) {
			$creativityarchitect_post_id = pll_get_post( $creativityarchitect_post_id, pll_current_language() );
		}

		$post_list = array_merge( $post_list, array( $creativityarchitect_post_id ) );

	}
}

$args['post__in'] = $post_list;
$args['orderby'] = 'post__in';

$args['posts_per_page'] = $number;
$loop = new WP_Query( $args );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();

		$position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); 
		$counter  = absint( $loop ->current_post ) + 1; ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="hentry-inner">
				<div class="post-thumbnail">
					<span class="counter"><?php echo esc_html( '0' . $counter . '.' ); ?></span>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<img src="<?php the_post_thumbnail_url( array(268, 268) ); ?>">
					</a>

					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

						<?php if ( $position ) : ?>
							<p class="entry-meta"><span class="position">
								<?php echo esc_html( $position ); ?></span>
							</p>
						<?php endif; ?>
					</header>

				</div>
				
				<div class="entry-container">
					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div>		
				</div><!-- .entry-container -->	
			</div><!-- .hentry-inner -->
		</article>
<?php
	endwhile;
	wp_reset_postdata();
endif;
