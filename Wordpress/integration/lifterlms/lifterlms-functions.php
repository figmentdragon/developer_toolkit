<?php
/**
 * LifterLMS functions.
 *
 * @package THEMENAME
 * @subpackage Integration/LifterLMS
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Remove LifterLMS default sidebars.
 */
function lifterlms_remove_archive_sidebar() {

	remove_action( 'lifterlms_sidebar', 'lifterlms_get_sidebar' );

}
add_action( 'wp', 'lifterlms_remove_archive_sidebar' );

/**
 * Display LifterLMS course and lesson sidebars.
 *
 * @param string $id The default sidebar id
 *
 * @return string $id The updated sidebar id
 */
function lifterlms_sidebar_function( $sidebar_id ) {

	$sidebar_id = 'sidebar-1';

	return $sidebar_id;

}
add_filter( 'llms_get_theme_default_sidebar', 'lifterlms_sidebar_function' );

/**
 * Remove default theme sidebars from LifterLMS archives & membership pages.
 *
 * This is the preferred/opinionated default state.
 *
 * @param string $layout The sidebar layout
 *
 * @return string $layout The updated sidebar layout
 */
function lifterlms_default_archive_sidebars( $layout ) {

	// Stop here if we're not on a LifterLMS archive or membership page.
	if ( ! is_lifterlms_archive() && ! is_membership() ) {
		return $layout;
	}

	return 'none';

}
add_filter( 'sidebar_layout', 'lifterlms_default_archive_sidebars' );

/**
 * Remove sidebar from course pages if users are not logged in.
 *
 * This is the preferred/opinionated default state.
 *
 * @param string $layout The sidebar layout
 *
 * @return string $layout The updated sidebar layout
 */
function lifterlms_remove_course_sidebar_if_not_logged_in( $layout ) {

	if ( is_course() && ! is_user_logged_in() ) {
		$layout = 'none';
	}

	return $layout;

}
add_filter( 'sidebar_layout', 'lifterlms_remove_course_sidebar_if_not_logged_in' );

/**
 * Replace sidebar widgets with the ones in LifterLMS' lesson sidebar when viewing a quiz.
 *
 * We must do this as they don't provide a more convenient way to manipulate sidebars on quizzes.
 * Simply replacing the sidebar won't work so we follow their process of replacing the widgets.
 *
 * @param array $widgets The widgets array
 *
 * @return array $widgets The updated widgets array
 */
function lifterlms_replace_quiz_sidebar_widgets( $widgets ) {

	$sidebar_id = 'sidebar-1';

	if ( is_singular( 'llms_quiz' ) && array_key_exists( 'llms_lesson_widgets_side', $widgets ) ) {
		$widgets[$sidebar_id] = $widgets['llms_lesson_widgets_side'];
	}

	return $widgets;

}
add_filter( 'sidebars_widgets', 'lifterlms_replace_quiz_sidebar_widgets' );

/**
 * Remove post links from lessons, quizzes & memberships.
 *
 */
function lifterlms_remove_post_navigation() {

	if ( ! is_lifterlms_single() ) {
		return;
	}

	remove_action( 'post_links', 'do_post_links' );

}
add_action( 'wp', 'lifterlms_remove_post_navigation' );

/**
 * Remove header & footer from certificate pages.
 *
 */
function lifterlms_remove_header_footer() {

	if ( ! is_singular( 'llms_certificate' ) ) {
		return;
	}

	remove_action( 'header', 'do_header' );
	remove_action( 'footer', 'do_footer' );

}
add_action( 'wp', 'lifterlms_remove_header_footer' );

/**
 * Add an arbitrary plugin directory to the list.
 *
 * @param array $dirs Array of paths to directories to load LifterLMS templates from
 *
 * @return array $dirs Updated array of paths
 */
function lifterlms_theme_override_dirs( $dirs ) {
	
	array_unshift( $dirs, THEME_DIR . '/inc/integration/lifterlms/templates' );

	return $dirs;
	
}
add_filter( 'lifterlms_theme_override_directories', 'lifterlms_theme_override_dirs', 10, 1 );

function lifterlms_remove_title_from_dashboard( $title ) {

	if ( is_llms_account_page() ) {
		$title = false;
	}

	return $title;

}
add_filter( 'title', 'lifterlms_remove_title_from_dashboard' );
