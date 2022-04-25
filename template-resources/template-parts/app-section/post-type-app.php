<?php
/**
 * The template used for displaying promotion headline
 *
 * @package My Music Band
 */
?>

<?php

$type = get_theme_mod( 'euphony_app_section_type', 'page' );

if ( 'page' === $type && $id = get_theme_mod( 'euphony_app_section' ) ) {
	$args['page_id'] = absint( $id );
} elseif ( 'post' === $type && $id = get_theme_mod( 'euphony_app_section_post' ) ) {
	$args['p'] = absint( $id );
} elseif ( 'category' === $type && $cat = get_theme_mod( 'euphony_app_section_category' ) ) {
	$args['cat']            = absint( $cat );
	$args['posts_per_page'] = 1;
}

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$app_section_query = new WP_Query( $args );
if ( $app_section_query->have_posts() ) :
	while ( $app_section_query->have_posts() ) :
		$app_section_query->the_post();

		$class[] = 'section';
		$class[] = 'app-section';
		$class[] = 'promotion-section';
		$class[] = get_theme_mod( 'euphony_app_section_image_position', 'content-align-left' );
		$class[] = get_theme_mod( 'euphony_app_section_text_alignment', 'text-align-left' );

		if ( get_theme_mod( 'euphony_app_section_wrap_text' ) ) {
			$class[] = 'content-frame';
		}

		if ( get_theme_mod( 'euphony_app_section_text_color', 1 ) ) {
			$class[] = 'content-color-white';
		}
		?>
		<div id="app-section" class="<?php echo esc_attr( implode( ' ', $class ) ); ?>">
			<div class="wrapper section-content-wrapper">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="hentry-inner">
						<?php euphony_post_thumbnail( 'euphony-slider', 'html-with-bg' ); // euphony_post_thumbnail( $image_size, $type = 'html', $echo = true, $no_thumb = false ). ?>

						<div class="content-wrapper">
							<div class="entry-container">
								<div class="entry-container-frame">
									<?php if ( get_theme_mod( 'euphony_display_app_section_title', 1 ) ) : ?>
										<header class="entry-header section-title-wrapper">
											<?php the_title( '<h2 class="entry-title section-title">', '</h2>' ); ?>
										</header><!-- .entry-header -->
									<?php endif; ?>

									<?php
										$image = get_theme_mod( 'euphony_app_section_logo_image' );
										if ( $image ) : ?>
											<div class="post-thumbnail">
												<img src="<?php echo esc_url( $image ); ?>">
											</div><!-- .post-thumbnail-->
										<?php endif; ?>

									<?php
									$show_content = get_theme_mod( 'euphony_app_section_show', 'full-content' );

									if ( 'full-content' === $show_content ) { ?>
										<div class="entry-content">
											<?php
											the_content();

											wp_link_pages( array(
												'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'chique' ) . '</span>',
												'after'       => '</div>',
												'link_before' => '<span class="page-number">',
												'link_after'  => '</span>',
												'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'chique' ) . ' </span>%',
												'separator'   => '<span class="screen-reader-text">, </span>',
											) );
											?>
										</div><!-- .entry-content -->
									<?php
									}
									elseif ( 'excerpt' === $show_content ) { ?>
										<div class="entry-summary">
											<?php the_excerpt(); ?>
										</div><!-- .entry-summary -->
									<?php
									} ?>
								</div><!-- .entry-container-frame -->
							</div><!-- .entry-container -->
						</div><!-- .content-wrapper -->
					</div><!-- .hentry-inner -->
				</article><!-- #post-## -->
			</div><!-- .wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
