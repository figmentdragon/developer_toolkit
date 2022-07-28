<?php
/**
 * LifterLMS custom wrapper (start).
 *
 * @package THEMENAME
 * @subpackage Integration/LifterLMS
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

$grid_gap = get_theme_mod( 'sidebar_gap', 'medium' );

?>

<div id="content">

<?php do_action( 'content_open' ); ?>

<?php inner_content(); ?>

<?php do_action( 'inner_content_open' ); ?>

<div class="grid main-grid grid-<?php echo esc_attr( $grid_gap ); ?>">

<?php do_action( 'sidebar_left' ); ?>

<main id="main" class="main medium-2-3<?php echo archive_class(); ?>">
