<?php
/**
 * Beaver Builder integration.
 *
 * @package THEMENAME
 * @subpackage Integration
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Remove content wrapper from fl-builder-template CPT.
 *
 * @param string $wrapper The inner content wrapper.
 *
 * @return $wrapper or false.
 */
function bb_inner_content_wrapper( $wrapper ) {

	if ( 'fl-builder-template' === get_post_type() ) {
		return false;
	}

	return $wrapper;

}
add_filter( 'inner_content', 'bb_inner_content_wrapper' );
add_filter( 'inner_content_close', 'bb_inner_content_wrapper' );

/**
 * Remove title from fl-builder-template CPT.
 *
 * @param string $title The title.
 *
 * @return $title or false.
 */
function bb_title( $title ) {

	if ( 'fl-builder-template' === get_post_type() ) {
		return false;
	}

	return $title;

}
add_filter( 'title', 'bb_title' );

/**
 * Remove sidebar from fl-builder-template.
 *
 * @param string $layout The sidebar layout.
 *
 * @return string The updated sidebar layout.
 */
function bb_template( $layout ) {

	if ( 'fl-builder-template' === get_post_type() ) {
		$layout = 'none';
	}

	return $layout;

}
add_filter( 'sidebar_layout', 'bb_template' );
