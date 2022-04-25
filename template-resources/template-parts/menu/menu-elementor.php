<?php
/**
 * Custom menu.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

echo '<div class="menu-custom visible-large">';

echo do_shortcode( get_theme_mod( 'menu_custom' ) );

echo '</div>';
