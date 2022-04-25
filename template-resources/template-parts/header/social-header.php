<?php
/**
 * Primary Menu Template
 *
 * @package Chique
 */

?>
<?php if ( has_nav_menu( 'social' ) ) : ?>
	<div id="social-menu-wrapper">
			<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'chique' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'container'       => 'div',
						'container_class' => 'menu-social-container',
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
						'depth'          => 1,
					) );
				?>
			</nav><!-- .social-navigation -->
	</div><!-- .menu-wrapper -->
<?php endif; ?>
