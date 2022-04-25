<?php
/**
 * The template used for displaying hero content
 *
 * @package TheCreativityArchitect
 */

$experience_title = get_theme_mod( 'TheCreativityArchitect_hero_experience_title' );
$date_one         = get_theme_mod( 'TheCreativityArchitect_hero_date_one' );
$date_two         = get_theme_mod( 'TheCreativityArchitect_hero_date_two' );
$date_three       = get_theme_mod( 'TheCreativityArchitect_hero_date_three' );
$date_four        = get_theme_mod( 'TheCreativityArchitect_hero_date_four' );
$experience_one   = get_theme_mod( 'TheCreativityArchitect_hero_experience_one' );
$experience_two   = get_theme_mod( 'TheCreativityArchitect_hero_experience_two' );
$experience_three = get_theme_mod( 'TheCreativityArchitect_hero_experience_three' );
$experience_four  = get_theme_mod( 'TheCreativityArchitect_hero_experience_four');



$TheCreativityArchitect_id = get_theme_mod( 'TheCreativityArchitect_hero_content' );
$args['page_id'] = absint( $TheCreativityArchitect_id );


// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$hero_query = new WP_Query( $args );
if ( $hero_query->have_posts() ) :
	while ( $hero_query->have_posts() ) :
		$hero_query->the_post();
		?>
		<div id="hero-section" class="section hero-section content-align-right text-align-left">
			<div class="wrapper">
				<div class="section-content-wrapper hero-content-wrapper">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<?php $post_thumbnail = TheCreativityArchitect_post_thumbnail( 'full-image', 'html-with-bg', false ); // TheCreativityArchitect_post_thumbnail( $image_size, $TheCreativityArchitect_type = 'html', $echo = true, $no_thumb = false ).

						if ( $post_thumbnail ) :
							echo $post_thumbnail;
							?>
							<div class="entry-container">
						<?php else : ?>
							<div class="entry-container full-width">
						<?php endif; 
						
							$TheCreativityArchitect_sub_title = get_theme_mod( 'TheCreativityArchitect_hero_content_sub_title' ); ?>
							
							<div class="section-heading-wrapper">										
								
								<header class="entry-header">
									<?php the_title( '<h2 class="entry-title section-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
								</header><!-- .entry-header -->

								<?php if ( $TheCreativityArchitect_sub_title ) : ?>
									<div class="section-description">
										<p><?php echo wp_kses_post( $TheCreativityArchitect_sub_title ); ?></p>
									</div><!-- .section-description-wrapper -->
								<?php endif; ?>
							</div>	
							

							<div class="entry-content">
								
								<?php the_excerpt(); ?>

									<div class="experience">
										<div class="experience-title">
											<?php echo esc_html( $experience_title ); ?>
										</div>

										<div class="experience-wrapper">

											<div class="experience-content-wrapper">
												<div class="experice-date">
													<?php echo esc_html( $date_one ); ?>
												</div>
												<div class="experice-content">
													<?php echo esc_html( $experience_one ); ?>
												</div>
											</div>

											<div class="experience-content-wrapper">
												<div class="experice-date">
													<?php echo esc_html( $date_two ); ?>
												</div>
												<div class="experice-content">
													<?php echo esc_html( $experience_two ); ?>
												</div>
											</div>

											<div class="experience-content-wrapper">
												<div class="experice-date">
													<?php echo esc_html( $date_three ); ?>
												</div>
												<div class="experice-content">
													<?php echo esc_html( $experience_three ); ?>
												</div>
											</div>

											<div class="experience-content-wrapper">
												<div class="experice-date">
													<?php echo esc_html( $date_four ); ?>
												</div>
												<div class="experice-content">
													<?php echo esc_html( $experience_four ); ?>
												</div>
											</div>
										</div>
									</div>
									<?php

									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'TheCreativityArchitect' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span class="page-number">',
										'link_after'  => '</span>',
										'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'TheCreativityArchitect' ) . ' </span>%',
										'separator'   => '<span class="screen-reader-text">, </span>',
									) );
								?>
							</div><!-- .entry-content -->

							<?php if ( get_edit_post_link() ) : ?>
								<footer class="entry-footer">
									<div class="entry-meta">
										<?php
											edit_post_link(
												sprintf(
													/* translators: %s: Name of current post */
													esc_html__( 'Edit %s', 'TheCreativityArchitect' ),
													the_title( '<span class="screen-reader-text">"', '"</span>', false )
												),
												'<span class="edit-link">',
												'</span>'
											);
										?>
									</div>	<!-- .entry-meta -->
								</footer><!-- .entry-footer -->
							<?php endif; ?>
						</div><!-- .hentry-inner -->
					</article>
				</div><!-- .section-content-wrapper -->
			</div><!-- .wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
