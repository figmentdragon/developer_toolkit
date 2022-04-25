<?php
/**
 * The template for displaying social media icons
 *
 * @package THEMENAE
 */

?>
<?php if ( get_theme_mod( 'THEMENAE_facebooklink' ) || get_theme_mod( 'THEMENAE_twitterlink' ) || get_theme_mod( 'THEMENAE_pinterestlink' ) || get_theme_mod( 'THEMENAE_instagramlink' ) || get_theme_mod( 'THEMENAE_linkedinlink' ) || get_theme_mod( 'THEMENAE_youtubelink' ) || get_theme_mod( 'THEMENAE_vimeo' ) || get_theme_mod( 'THEMENAE_tumblrlink' ) || get_theme_mod( 'THEMENAE_flickrlink' ) ) : ?>
	<div class="social-icons position-absolute">
		<ul class="list-unstyled d-table mb-2">

		<?php endif; ?>
		<?php if ( get_theme_mod( 'THEMENAE_facebooklink' ) ) : ?>
		<li><a href="<?php echo esc_url( get_theme_mod( 'THEMENAE_facebooklink' ) ); ?>" class="py-2 text-center d-block" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'THEMENAE_twitterlink' ) ) : ?>
		<li><a href="<?php echo esc_url( get_theme_mod( 'THEMENAE_twitterlink' ) ); ?>" class="py-2 text-center d-block" target="_blank"><i class="fab fa-twitter"></i></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'THEMENAE_pinterestlink' ) ) : ?>
		<li><a href="<?php echo esc_url( get_theme_mod( 'THEMENAE_pinterestlink' ) ); ?>" class="py-2 text-center d-block" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'THEMENAE_instagramlink' ) ) : ?>
		<li><a href="<?php echo esc_url( get_theme_mod( 'THEMENAE_instagramlink' ) ); ?>" class="py-2 text-center d-block" target="_blank"><i class="fab fa-instagram"></i></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'THEMENAE_linkedinlink' ) ) : ?>
		<li><a href="<?php echo esc_url( get_theme_mod( 'THEMENAE_linkedinlink' ) ); ?>" class="py-2 text-center d-block" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'THEMENAE_youtubelink' ) ) : ?>
		<li><a href="<?php echo esc_url( get_theme_mod( 'THEMENAE_youtubelink' ) ); ?>" class="py-2 text-center d-block" target="_blank"><i class="fab fa-youtube"></i></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'THEMENAE_vimeo' ) ) : ?>
		<li><a href="<?php echo esc_url( get_theme_mod( 'THEMENAE_vimeo' ) ); ?>" class="py-2 text-center d-block" target="_blank"><i class="fab fa-vimeo-v"></i></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'THEMENAE_tumblrlink' ) ) : ?>
		<li><a href="<?php echo esc_url( get_theme_mod( 'THEMENAE_tumblrlink' ) ); ?>" class="py-2 text-center d-block" target="_blank"><i class="fab fa-tumblr"></i></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'THEMENAE_flickrlink' ) ) : ?>
		<li><a href="<?php echo esc_url( get_theme_mod( 'THEMENAE_flickrlink' ) ); ?>" class="py-2 text-center d-block" target="_blank"><i class="fab fa-flickr"></i></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'THEMENAE_facebooklink' ) || get_theme_mod( 'THEMENAE_twitterlink' ) || get_theme_mod( 'THEMENAE_pinterestlink' ) || get_theme_mod( 'THEMENAE_instagramlink' ) || get_theme_mod( 'THEMENAE_linkedinlink' ) || get_theme_mod( 'THEMENAE_youtubelink' ) || get_theme_mod( 'THEMENAE_vimeo' ) || get_theme_mod( 'THEMENAE_tumblrlink' ) || get_theme_mod( 'THEMENAE_flickrlink' ) ) : ?>
	</ul>
</div>
<?php endif; ?>
