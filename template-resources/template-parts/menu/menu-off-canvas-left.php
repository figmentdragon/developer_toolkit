<?php
/**
 * Off canvas menu left.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

if ( get_theme_mod( 'menu_overlay' ) ) {
	echo '<div class="menu-overlay"></div>';
}

?>

<div class="container container-center visible-large nav-wrapper menu-left">

	<div class="grid grid-collapse">

		<div class="3-4 menu-container">

			<div class="menu-toggle-container">

				<?php do_action( 'before_menu_toggle' ); ?>

				<?php if ( svg_enabled() ) { ?>

					<button id="menu-toggle" class="nav-item menu-toggle" aria-label="<?php _e( 'Site Navigation', 'TheCreativityArchitect' ); ?>" aria-controls="navigation" aria-expanded="false" aria-haspopup="true">
						<span class="screen-reader-text"><?php _e( 'Menu Toggle', 'TheCreativityArchitect' ); ?></span>
						<?php echo svg( 'hamburger' ); ?>
					</button>

				<?php } else { ?>

					<button id="menu-toggle" class="nav-item menu-toggle TheCreativityArchitectf TheCreativityArchitectf-hamburger" aria-label="<?php _e( 'Site Navigation', 'TheCreativityArchitect' ); ?>" aria-controls="navigation" aria-expanded="false" aria-haspopup="true">
						<span class="screen-reader-text"><?php _e( 'Menu Toggle', 'TheCreativityArchitect' ); ?></span>
					</button>

				<?php } ?>

				<?php do_action( 'after_menu_toggle' ); ?>

			</div>

		</div>

		<div class="1-4 logo-container">

			<?php get_template_part( 'inc/template-parts/logo/logo' ); ?>

		</div>

	</div>

</div>

<div class="menu-off-canvas menu-off-canvas-left visible-large">

	<?php do_action( 'before_main_menu' ); ?>

	<nav id="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement" aria-labelledby="menu-toggle">

		<?php do_action( 'main_menu_open' ); ?>

		<?php do_action( 'main_menu' ); ?>

		<?php do_action( 'main_menu_close' ); ?>

	</nav>

	<?php do_action( 'after_main_menu' ); ?>

	<?php if ( svg_enabled() ) { ?>
		<span class="close">
			<?php echo svg( 'times' ); ?>
		</span>
	<?php } else { ?>
		<i class="close TheCreativityArchitectf TheCreativityArchitectf-times" aria-hidden="true"></i>
	<?php } ?>

</div>
