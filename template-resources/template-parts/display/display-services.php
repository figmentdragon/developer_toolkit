<?php
/**
 * The template for displaying services content
 *
 * @package TheThemeName
 */

$enable_content = get_theme_mod( 'TheThemeName_service_option', 'disabled' );

if ( ! TheThemeName_check_section( $enable_content ) ) {
	// Bail if services content is disabled.
	return;
}

$TheThemeName_title = get_option( 'ect_service_title', esc_html__( 'We design & build brands', 'TheThemeName' ) );
$sub_title    = get_option( 'ect_service_content' );

$classes[] = 'services-section';
$classes[] = 'section';

if ( ! $TheThemeName_title && ! $sub_title ) {
	$classes[] = 'no-section-heading';
}

?>

<div id="services-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<div class="service-content-area">
			<?php if ( $TheThemeName_title || $sub_title ) : ?>
				<div class="section-heading-wrapper">
					<?php if ( $TheThemeName_title ) : ?>
						<div class="section-title-wrapper">
							<h2 class="section-title"><?php echo wp_kses_post( $TheThemeName_title ); ?></h2>
						</div><!-- .page-title-wrapper -->
					<?php endif;  

					if ( $sub_title ) : ?>
						<div class="section-description">
							<p><?php echo wp_kses_post( $sub_title ); ?></p>
						</div><!-- .section-description -->
					<?php endif; ?>

				</div><!-- .section-heading-wrapper -->
			<?php endif; ?>

			<div class="section-content-wrapper services-content-wrapper layout-two">
				<?php get_template_part( 'template-parts/services/post-types-services' ); ?>
			</div><!-- .services-wrapper -->
		</div>
	</div><!-- .wrapper -->
</div><!-- #services-section -->
