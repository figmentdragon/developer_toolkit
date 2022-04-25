<?php

/**
 * Primary Menu Template
 *
 * @package creativity
 */

if (has_nav_menu('social-menu')) :  ?>
	<div id="floating-social" class="floating-social">
		<?php if ( has_nav_menu('social-menu') ) : ?>
			<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e('Social Menu', 'creativity'); ?>">
				<?php
				wp_nav_menu(array(
					'theme_location'  => 'social-menu',
					'menu_class'      => 'social-links-menu',
					'container'       => 'div',
					'container_class' => 'menu-social-container',
					'depth'           => 1,
					'link_before'     => '<span class="screen-reader-text">',
					'link_after'      => '</span>' . creativity_get_svg(array('icon' => 'chain')),
				));
				?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>

		<div id="primary-search-wrapper" class="menu-wrapper">
			<div class="menu-toggle-wrapper">
				<button id="social-search-toggle" class="menu-toggle search-toggle"><?php echo creativity_get_svg(array('icon' => 'search')); ?><span class="screen-reader-text"><?php esc_html_e('Search', 'creativity'); ?></span></button>
			</div><!-- .menu-toggle-wrapper -->
		</div><!-- #social-search-wrapper.menu-wrapper -->
	</div><!--  .floating-social  -->
<?php endif; ?>
