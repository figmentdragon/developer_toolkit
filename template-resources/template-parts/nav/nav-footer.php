<?php
/**
 * Displays social navigation
 * @package creativity
 */
?>

<?php if ( has_nav_menu( 'footer' ) ) {
	 echo '<nav id="footer-nav"> ';
		 wp_nav_menu( array( 
				'theme_location' => 'footer', 
				'fallback_cb' => false, 
				'depth' => 1,
				'container' => false, 
				'menu_id' => 'footer-menu', 
			) ); 
		echo '</nav>';
		}
		?>
