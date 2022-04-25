<?php
/**
 * Primary Menu Template
 *
 * @package creativity
 */

?>
<div id="site-header-menu" class="site-header-menu">
	<div id="primary-menu-wrapper" class="menu-wrapper">
		<div class="menu-toggle-wrapper">
			<button id="menu-toggle"  class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php echo creativity_get_svg( array( 'icon' => 'bars' ) ); echo creativity_get_svg( array( 'icon' => 'close' ) ); ?><span class="menu-label"><?php echo esc_html_e( 'Menu', 'creativity' ); ?></span></button>
		</div><!-- .menu-toggle-wrapper -->

		<?php
		if ( get_theme_mod( 'creativity_header_cart_enable', 0 ) && function_exists( 'creativity_cart_link' ) ) {
			creativity_cart_link();
		}
		?>


		<?php
		if ( get_theme_mod( 'creativity_header_cart_enable', 0 ) && function_exists( 'creativity_myaccount_icon_link' ) ) {
			creativity_myaccount_icon_link();
		}
		?>

		<div class="menu-inside-wrapper">
			<button id="menu-toggle"  class="close-toggle" aria-controls="top-menu" aria-expanded="false"><?php echo creativity_get_svg( array( 'icon' => 'close' ) ); ?><span class="menu-label"><?php echo esc_html_e( 'Close', 'creativity' ); ?></span></button>
			
			<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'creativity' ); ?>">
					<?php
						wp_nav_menu( array(
								'container'      => '',
								'theme_location' => 'primary-menu',
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'menu nav-menu',
							)
						);
					?>
				</nav><!-- .main-navigation -->
			<?php else : ?>
				<nav id="site-navigation" class="main-navigation default-page-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'creativity' ); ?>">
					<?php wp_page_menu(
						array(
							'menu_class' => 'primary-menu-container',
							'before'     => '<ul id="menu-primary-items" class="menu nav-menu">',
							'after'      => '</ul>',
						)
					); ?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<div class="mobile-social-search">
				<?php if ( has_nav_menu( 'social-menu' ) ) : ?>
					 <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'creativity' ); ?>">
					 <?php
						 wp_nav_menu( array(
							 'theme_location'  => 'social-menu',
							 'menu_class'      => 'social-links-menu',
							 'container'       => 'div',
							 'container_class' => 'menu-social-container',
							 'depth'           => 1,
							 'link_before'     => '<span class="screen-reader-text">',
							 'link_after'      => '</span>' . creativity_get_svg( array( 'icon' => 'chain' ) ),
						 ) );
					 ?>
				<?php endif; ?>

				<div class="search-container">
					<?php get_search_form(); ?>
				</div>
			</div><!-- .mobile-social-search -->
		</div><!-- .menu-inside-wrapper -->
	</div><!-- #primary-menu-wrapper.menu-wrapper -->

	<div class="line"></div>

	<?php get_template_part( 'template-parts/navigation/navigation', 'social-floating' ); ?>

	<?php get_template_part( 'template-parts/header/woo-elements' ); ?>
</div><!-- .site-header-menu -->
