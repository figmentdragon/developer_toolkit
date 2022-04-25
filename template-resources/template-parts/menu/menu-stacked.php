<?php
/**
 * Stacked menu.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

?>

<div class="container container-center visible-large nav-wrapper menu-stacked">

	<?php get_template_part( 'inc/template-parts/logo/logo' ); ?>

	<?php do_action( 'before_main_menu' ); ?>

	<nav id="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement" aria-label="<?php _e( 'Site Navigation', 'TheCreativityArchitect' ); ?>">

		<?php do_action( 'main_menu_open' ); ?>

		<?php do_action( 'main_menu' ); ?>

		<?php do_action( 'main_menu_close' ); ?>

	</nav>

	<?php do_action( 'after_main_menu' ); ?>

</div>
