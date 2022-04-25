<?php
/**
 * Vertical menu left.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

?>

<div class="menu-vertical menu-vertical-left visible-large">

	<div class="1-4 logo-container">

		<?php get_template_part( 'inc/template-parts/logo/logo' ); ?>

	</div>

	<?php do_action( 'before_main_menu' ); ?>

	<nav id="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">

		<?php do_action( 'main_menu_open' ); ?>

		<?php do_action( 'main_menu' ); ?>

		<?php do_action( 'main_menu_close' ); ?>

	</nav>

	<?php do_action( 'after_main_menu' ); ?>

</div>
