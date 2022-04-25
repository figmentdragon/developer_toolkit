<?php
/**
 * Main Navigation
 * @package creativity
 */
?>


<div class="nav-wrapper">
    <nav id="main-navigation" class="primary-navigation navigation clearfix">
        <?php
		// Display Main Navigation.
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container' => false,
			'menu_class' => 'main-navigation-menu',
			'echo' => true,
			'fallback_cb' => 'creativity__fallback_menu',
			)
		);
	?>
    </nav>
</div>
