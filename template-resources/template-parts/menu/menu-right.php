<?php
/**
 * Right menu.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

?>

<div class="container container-center visible-large nav-wrapper menu-right">

	<div class="grid grid-collapse">

		<div class="1-4 logo-container">

			<?php get_template_part( 'inc/template-parts/logo/logo' ); ?>

		</div>

		<div class="3-4 menu-container">

			<?php do_action( 'before_main_menu' ); ?>

			<nav id="navigation" class="clearfix" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement" aria-label="<?php _e( 'Site Navigation', 'TheCreativityArchitect' ); ?>">

				<?php do_action( 'main_menu_open' ); ?>

				<?php do_action( 'main_menu' ); ?>

				<?php do_action( 'main_menu_close' ); ?>

			</nav>

			<?php do_action( 'after_main_menu' ); ?>

		</div>

	</div>

</div>
