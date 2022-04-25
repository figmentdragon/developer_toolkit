<?php
/**
 * Off canvas mobile menu.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

if ( get_theme_mod( 'mobile_menu_overlay' ) ) {
	echo '<div class="mobile-menu-overlay"></div>';
}

?>

<div class="mobile-menu-off-canvas hidden-large">

	<div class="mobile-nav-wrapper container container-center">

		<div class="mobile-logo-container 2-3">

			<?php get_template_part( 'inc/template-parts/logo/logo-mobile' ); ?>

		</div>

		<div class="menu-toggle-container 1-3">

			<?php do_action( 'before_mobile_toggle' ); ?>

			<?php if ( svg_enabled() ) { ?>

				<button id="mobile-menu-toggle" class="mobile-nav-item mobile-menu-toggle" aria-label="<?php _e( 'Mobile Site Navigation', 'TheCreativityArchitect' ); ?>" aria-controls="navigation" aria-expanded="false" aria-haspopup="true">
					<span class="screen-reader-text"><?php _e( 'Menu Toggle', 'TheCreativityArchitect' ); ?></span>
					<?php echo svg( 'hamburger' ); ?>
				</button>

			<?php } else { ?>

				<button id="mobile-menu-toggle" class="mobile-nav-item mobile-menu-toggle TheCreativityArchitectf TheCreativityArchitectf-hamburger" aria-label="<?php _e( 'Mobile Site Navigation', 'TheCreativityArchitect' ); ?>" aria-controls="navigation" aria-expanded="false" aria-haspopup="true">
					<span class="screen-reader-text"><?php _e( 'Menu Toggle', 'TheCreativityArchitect' ); ?></span>
				</button>

			<?php } ?>

			<?php do_action( 'after_mobile_toggle' ); ?>

		</div>

	</div>

	<div class="mobile-menu-container">

		<?php do_action( 'before_mobile_menu' ); ?>

		<nav id="mobile-navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement" aria-labelledby="mobile-menu-toggle">

			<?php do_action( 'mobile_menu_open' ); ?>

			<?php do_action( 'mobile_menu' ); ?>

			<?php do_action( 'mobile_menu_close' ); ?>

		</nav>

		<?php do_action( 'after_mobile_menu' ); ?>

		<?php if ( svg_enabled() ) { ?>
			<span class="close">
				<?php echo svg( 'times' ); ?>
			</span>
		<?php } else { ?>
			<i class="close TheCreativityArchitectf TheCreativityArchitectf-times" aria-hidden="true"></i>
		<?php } ?>

	</div>

</div>
