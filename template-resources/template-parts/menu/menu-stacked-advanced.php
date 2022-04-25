<?php
/**
 * Stacked advanced menu.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

?>

<div class="visible-large menu-stacked-advanced<?php echo esc_attr( menu_alignment() ); ?>">

	<div class="menu-stacked-advanced-wrapper">

		<div class="container container-center">

			<div class="1-4">

				<?php get_template_part( 'inc/template-parts/logo/logo' ); ?>

			</div>

			<div class="3-4">

				<?php echo do_shortcode( get_theme_mod( 'menu_stacked_wysiwyg' ) ); ?>

			</div>

		</div>

	</div>

	<?php do_action( 'before_main_menu' ); ?>

	<nav id="navigation" class="container container-center nav-wrapper" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement" aria-label="<?php _e( 'Site Navigation', 'TheCreativityArchitect' ); ?>">

		<?php do_action( 'main_menu_open' ); ?>

		<?php do_action( 'main_menu' ); ?>

		<?php do_action( 'main_menu_close' ); ?>

	</nav>

	<?php do_action( 'after_main_menu' ); ?>

</div>
