<?php
/**
 * Primary Menu Template
 *
 * @package Chique
 */

?>
<div id="site-header-menu" class="site-header-menu">
	<div id="primary-menu-wrapper" class="menu-wrapper">

		<div class="header-overlay"></div>

		<div class="menu-toggle-wrapper">
			<button id="menu-toggle" class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
				<div class="menu-bars">
					<div class="bars bar1"></div>
	  				<div class="bars bar2"></div>
	  				<div class="bars bar3"></div>
  				</div>
				<span class="menu-label"><?php echo esc_html_e( 'Menu', 'chique' ); ?></span>
			</button>
		</div><!-- .menu-toggle-wrapper -->

		<div class="menu-inside-wrapper">
			<?php
				if( function_exists( 'chique_header_cart' ) ) {
					chique_header_cart();
				}
				?>

				<?php get_template_part( 'template-parts/header/header', 'navigation' ); ?>

			<div class="mobile-social-search">
				<div class="search-container">
					<?php get_search_form(); ?>
				</div>

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


			</div><!-- .mobile-social-search -->
		</div><!-- .menu-inside-wrapper -->
	</div><!-- #primary-menu-wrapper.menu-wrapper -->

</div><!-- .site-header-menu -->

<div class="search-social-container">
	<div id="primary-search-wrapper">
			<div class="search-container">
				<?php get_search_form(); ?>
			</div>
	</div><!-- #primary-search-wrapper -->

<?php get_template_part( 'template-parts/header/social', 'header' ); ?>
</div> <!-- .search-social-container -->

<?php
	if( function_exists( 'chique_header_cart' ) ) {
		chique_header_cart();
	}
?>
