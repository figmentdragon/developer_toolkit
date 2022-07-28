<?php
/**
 * Setting up theme settings.
 *
 * @package THEMENAE
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Admin body class.
 *
 * @param string $classes The class names.
 */
function theme_settings_admin_body_class( $classes ) {

	$screen = get_current_screen();

	if ( $screen->id !== 'appearance_page_premium' ) {
		return $classes;
	}

	$classes .= ' heatbox-admin has-header';

	return $classes;

}
add_action( 'admin_body_class', 'theme_settings_admin_body_class' );

/**
 * Add theme settings.
 */
function theme_settings_page() {

	add_theme_page( __( 'Theme Settings', 'TheThemeName' ), __( 'Theme Settings', 'TheThemeName' ), 'manage_options', 'theme_settings_callback' );

}
add_action( 'admin_menu', 'theme_settings_page' );

/**
 * Theme settings callback.
 */
function theme_settings_callback() {
	require __DIR__ . '/settings/settings-page.php';
}

/**
 * Save activation notice dismissal.
 */
function activation_notice_dismissal() {

	$nonce   = isset( $_POST['nonce'] ) ? $_POST['nonce'] : 0;
	$dismiss = isset( $_POST['dismiss'] ) ? absint( $_POST['dismiss'] ) : 0;

	if ( empty( $dismiss ) ) {
		wp_send_json_error( 'Invalid Request' );
	}

	if ( ! wp_verify_nonce( $nonce, 'Dismiss_Activation_Notice' ) ) {
		wp_send_json_error( 'Invalid Token' );
	}

	update_option( 'activation_notice_dismissed', 1 );
	wp_send_json_success( 'Activation notice has been dismissed.' );

}
add_action( 'wp_ajax_activation_notice_dismissal', 'activation_notice_dismissal' );

/**
 * Save BFCM notice dismissal.
 */
function bfcm_notice_dismissal() {

	$nonce   = isset( $_POST['nonce'] ) ? $_POST['nonce'] : 0;
	$dismiss = isset( $_POST['dismiss'] ) ? absint( $_POST['dismiss'] ) : 0;

	if ( empty( $dismiss ) ) {
		wp_send_json_error( 'Invalid Request' );
	}

	if ( ! wp_verify_nonce( $nonce, 'Dismiss_Bfcm_Notice' ) ) {
		wp_send_json_error( 'Invalid Token' );
	}

	update_option( 'bfcm_notice_dismissed', 1 );
	wp_send_json_success( 'BFCM notice has been dismissed.' );

}
add_action( 'wp_ajax_bfcm_notice_dismissal', 'bfcm_notice_dismissal' );

/**
 * Display BFCM notice.
 */
function show_bfcm_notice() {

	// Stop here if current user is not an admin.
	if ( ! current_user_can( 'administrator' ) ) {
		return;
	}

    global $pagenow;
    $screen = get_current_screen();

    // Stop if we are not on the dashboard or THEMENAE settings page.
	if ( $pagenow !== 'index.php' && 'appearance_page_premium' !== $screen->id ) {
		return;
	}

    $start = strtotime( 'november 22nd, 2021' );
    $end   = strtotime( 'november 30th, 2021' );
    $now   = time();

    // Stop here if we are not in the sales period.
    if ( $now < $start || $now > $end ) {
    	return;
    }

	// Stop here if notice has been dismissed.
	if ( ! empty( get_option( 'bfcm_notice_dismissed', 0 ) ) ) {
		return;
	}

	require __DIR__ . '/settings/bfcm-notice.php';

}
add_action( 'admin_notices', 'show_bfcm_notice' );
