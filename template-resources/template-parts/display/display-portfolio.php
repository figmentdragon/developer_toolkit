<?php
/**
 * The template for displaying portfolio items
 *
 * @package TheCreativityArchitect
 */

$enable = get_theme_mod( 'TheCreativityArchitect_portfolio_option', 'disabled' );

if ( ! TheCreativityArchitect_check_section( $enable ) ) {
	// Bail if portfolio section is disabled.
	return;
}

$TheCreativityArchitect_title = get_option( 'jetpack_portfolio_title', esc_html__( 'Projects', 'TheCreativityArchitect' ) );
$sub_title    = get_option( 'jetpack_portfolio_content' );

$classes[] = 'layout-three';
$classes[] = 'jetpack-portfolio';
$classes[] = 'section';

if( !$TheCreativityArchitect_title && !$sub_title ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="portfolio-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $TheCreativityArchitect_title || $sub_title ) : ?>
			<div class="section-heading-wrapper portfolio-section-headline">
				
				<div class="heading-wrapper">
					<?php if ( $TheCreativityArchitect_title ) : ?>
						<div class="section-title-wrapper">
							<h2 class="section-title"><?php echo wp_kses_post( $TheCreativityArchitect_title ); ?></h2>
						</div><!-- .section-title-wrapper -->
					<?php endif; ?>

					<?php if ( $sub_title ) : ?>
						<div class="section-description">
							<p><?php echo wp_kses_post( $sub_title ); ?></p>
						</div><!-- .section-description-wrapper -->
					<?php endif; ?>
				</div>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper portfolio-content-wrapper layout-three">
			<div class="grid">
				<?php get_template_part( 'template-parts/portfolio/post-types', 'portfolio' ); ?>
			</div>
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #portfolio-section -->
