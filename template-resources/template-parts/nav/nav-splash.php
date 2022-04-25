<?php
/**
 * Displays splash navigation
 * @package creativity
 */
?>


<nav id="splash-nav">
    <?php wp_nav_menu( array( 
				'theme_location' => 'splash', 
				'fallback_cb' => false, 
				'depth' => 1,
				'container' => false, 
				'menu_id' => 'splash-menu', 
			) ); 
		?>
</nav>
