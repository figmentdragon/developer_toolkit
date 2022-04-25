<?php
/**
 * The template used for displaying slider
 *
 * @package TheCreativityArchitect
 */

$enable_slider = get_theme_mod( 'TheCreativityArchitect_slider_option', 'disabled' );

if ( ! TheCreativityArchitect_check_section( $enable_slider ) ) {
	return;
}

?>

<div id="feature-slider-section" class="section text-align-left content-align-right">
	<div class="wrapper section-content-wrapper feature-slider-wrapper">
		<div class="main-slider owl-carousel">
			<?php get_template_part( 'template-parts/slider/post-type-slider' ); ?>
		</div><!-- .main-slider -->

		<div class="scroll-down">
			<span><?php esc_html_e( 'Scroll', 'TheCreativityArchitect' ); ?></span>
			<?php echo TheCreativityArchitect_get_svg( array( 'icon' => 'angle-down' ) ); ?>
		</div><!-- .scroll-down -->
	</div><!-- .wrapper -->
</div><!-- #feature-slider -->

