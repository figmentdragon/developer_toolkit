<?php
/**
 * The template used for displaying slider
 *
 * @package TheCreativityArchitect
 */

$quantity     = get_theme_mod( 'TheCreativityArchitect_slider_number', 4 );
$no_of_post   = 0; // for number of posts
$post_list    = array(); // list of valid post/page ids

$args = array(
	'post_type'           => 'any',
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1, // ignore sticky posts
);
//Get valid number of posts

for ( $i = 1; $i <= $quantity; $i++ ) {
	$TheCreativityArchitect_post_id = '';

	$TheCreativityArchitect_post_id = get_theme_mod( 'TheCreativityArchitect_slider_page_' . $i );

	if ( $TheCreativityArchitect_post_id && '' !== $TheCreativityArchitect_post_id ) {
		$post_list = array_merge( $post_list, array( $TheCreativityArchitect_post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;

if ( ! $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :
	$loop->the_post();

	$classes = 'post post-' . get_the_ID() . ' hentry slides';

	$slider_logo = get_theme_mod( 'TheCreativityArchitect_slider_logo_image_' . ( absint( $loop ->current_post ) + 1 ) );

	?>
	<article class="<?php echo esc_attr( $classes ); ?>">
		<div class="hentry-inner">
			<?php TheCreativityArchitect_post_thumbnail( 'TheCreativityArchitect-slider', 'html', true, true ); ?>
			
			<div class="entry-container">
				<div class="content-wrapper">
					<header class="entry-header">

						<?php if( $slider_logo ) : ?>
							<div class="slider-logo">
								<img src="<?php echo esc_url( $slider_logo ); ?>">
							</div>
						<?php endif; ?>
					</header>

					<?php
					    echo '<div class="entry-summary"><p>' . wp_kses_post( get_the_excerpt() ) . '</p></div><!-- .entry-summary -->';
					?>
				</div>
			</div><!-- .entry-container -->			
		</div><!-- .hentry-inner -->
	</article><!-- .slides -->
<?php
endwhile;

wp_reset_postdata();
