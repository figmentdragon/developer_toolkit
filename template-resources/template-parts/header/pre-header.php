<?php
/**
 * Pre header.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

$pre_header_layout            = get_theme_mod( 'pre_header_layout' );
$layout                       = 'one' === $pre_header_layout ? ' pre-header-one-column' : ' pre-header-two-columns';
$inner_layout                 = 'one' === $pre_header_layout ? 'inner-pre-header-content' : 'inner-pre-header-left';
$pre_header_hook_open         = 'one' === $pre_header_layout ? 'pre_header_open' : 'pre_header_left_open';
$pre_header_hook_close        = 'one' === $pre_header_layout ? 'pre_header_close' : 'pre_header_left_close';
$pre_header_column_one        = get_theme_mod( 'pre_header_column_one', __( 'Column 1', 'TheCreativityArchitect' ) );
$pre_header_column_two        = get_theme_mod( 'pre_header_column_two', __( 'Column 2', 'TheCreativityArchitect' ) );
$pre_header_column_one_layout = get_theme_mod( 'pre_header_column_one_layout', 'text' );
$pre_header_column_two_layout = get_theme_mod( 'pre_header_column_two_layout', 'text' );

// Stop here if pre header is disabled or not set.
if ( ! $pre_header_layout || 'none' === $pre_header_layout ) {
	return;
}

?>

<div id="pre-header" class="pre-header">

	<?php do_action( 'before_pre_header' ); ?>

	<div class="inner-pre-header container container-center<?php echo esc_attr( $layout ); ?>">

		<div class="<?php echo esc_attr( $inner_layout ); ?>">

			<?php

			do_action( $pre_header_hook_open );

			if ( 'text' === $pre_header_column_one_layout ) {

				wp_nav_menu( array(
					'theme_location' => 'pre_header_menu',
					'container'      => false,
					'menu_class'     => 'menu sub-menu' . sub_menu_alignment() . sub_menu_animation(),
					'depth'          => '4',
					'fallback_cb'    => false,
				) );

				echo do_shortcode( $pre_header_column_one );

			} elseif ( 'menu' === $pre_header_column_one_layout ) {

				wp_nav_menu( array(
					'theme_location' => 'pre_header_menu',
					'container'      => false,
					'menu_class'     => 'menu sub-menu' . sub_menu_alignment() . sub_menu_animation(),
					'depth'          => '4',
					'fallback_cb'    => 'menu_fallback',
				) );

			}

			do_action( $pre_header_hook_close );

			?>

		</div>

		<?php if ( 'two' === $pre_header_layout ) { ?>

		<div class="inner-pre-header-right">

			<?php

			do_action( 'pre_header_right_open' );

			if ( 'text' === $pre_header_column_two_layout ) {

				echo do_shortcode( $pre_header_column_two );

				wp_nav_menu( array(
					'theme_location' => 'pre_header_menu_right',
					'container'      => false,
					'menu_class'     => 'menu sub-menu' . sub_menu_alignment() . sub_menu_animation(),
					'depth'          => '4',
					'fallback_cb'    => false,
				) );

			} elseif ( 'menu' === $pre_header_column_two_layout ) {

				wp_nav_menu( array(
					'theme_location' => 'pre_header_menu_right',
					'container'      => false,
					'menu_class'     => 'menu sub-menu' . sub_menu_alignment() . sub_menu_animation(),
					'depth'          => '4',
					'fallback_cb'    => 'menu_fallback',
				) );

			}

			do_action( 'pre_header_right_close' );

			?>

		</div>

		<?php } ?>

    </div>

    <?php do_action( 'after_pre_header' ); ?>

</div>
