<?php
/**
 * Default mobile menu.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

?>

<div class="mobile-menu-default hidden-large">

	<div class="mobile-nav-wrapper container container-center">

		<div class="mobile-logo-container">

			<?php get_template_part( 'inc/template-parts/logo/logo-mobile' ); ?>

		</div>

		<div class="menu-toggle-container">

			<a id="mobile-menu-toggle" href="javascript:void(0)" class="mobile-menu-toggle button button-full" aria-label="<?php _e( 'Mobile Site Navigation', 'TheCreativityArchitect' ); ?>" aria-controls="navigation" aria-expanded="false" aria-haspopup="true" role="button">
				<?php echo apply_filters( 'mobile_menu_text', __( 'Menu', 'TheCreativityArchitect' ) ); ?>
			</a>

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

	</div>

</div>
