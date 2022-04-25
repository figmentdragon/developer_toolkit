<?php
/**
 * Top Social Navigation
 * @package creativity
 */

	// Display Social Icons Menu.
	echo '<nav id="header-social-icons" class="header-social-menu social-menu clearfix">';										
		wp_nav_menu( array(
			'theme_location' => 'top-social',
			'container' => false,
			'menu_class' => 'social-icons-menu',
			'echo' => true,
			'fallback_cb' => '',
			'link_before' => '<span class="screen-reader-text">',
			'link_after' => '</span>',
			'depth' => 1,
			)
		);
	echo '</nav>';

 ?>
