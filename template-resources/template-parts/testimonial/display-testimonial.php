<?php
/**
 * The template for displaying testimonial items
 *
 * @package creativityarchitect
 */

$enable = get_theme_mod( 'creativityarchitect_testimonial_option', 'disabled' );

if ( ! creativityarchitect_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}

$headline    = get_option( 'jetpack_testimonial_title', esc_html__( 'Testimonials', 'creativityarchitect' ) );
$subheadline = get_option( 'jetpack_testimonial_content' );


$classes[] = 'section testimonial-content-section';

if ( ! $headline && ! $subheadline ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="testimonial-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">

	<?php if ( $headline || $subheadline ) : ?>
		<div class="section-heading-wrapper testimonial-content-section-headline">
		<?php if ( $headline ) : ?>
			<div class="section-title-wrapper">
				<h2 class="section-title"><?php echo wp_kses_post( $headline ); ?></h2>
			</div><!-- .section-title-wrapper -->
		<?php endif; ?>

		<?php if ( $subheadline ) : ?>
			<div class="section-description">
				<p><?php echo wp_kses_post( $subheadline ); ?></p>
			</div><!-- .section-description-wrapper -->
		<?php endif; ?>

		</div><!-- .section-heading-wrapper -->
	<?php endif; ?>

		<div class="section-content-wrapper testimonial-content-wrapper  testimonial-slider owl-carousel  owl-dots-enabled'">
			<?php get_template_part( 'template-parts/testimonial/post-types', 'testimonial' ); ?>
		</div><!-- .section-content-wrapper -->

		<div class="nav-controls-container">
			<div class="nav-controls">
				<div id='slider-dots' class='owl-dots'>
				</div>

				<div id='slider-nav' class='owl-nav'>
				</div>
			</div><!-- .nav-controls -->
		</div>
	</div><!-- .wrapper -->
</div><!-- .testimonial-content-section -->
