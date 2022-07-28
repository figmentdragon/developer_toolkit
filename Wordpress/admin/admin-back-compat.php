<?php

/**
 * Creativity Architect back compat functionality
 *
 * Prevents Creativity Architect from running on WordPress versions prior to 3.8,
 * since this theme is not meant to be backward compatible beyond that
 * and relies on many newer functions and markup changes introduced in 3.8.
 *
 */

/**
 * Prevent switching to Creativity Architect on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 *
 * @return void
 */
function themename_switch_theme() {
    switch_theme(WP_DEFAULT_THEME, WP_DEFAULT_THEME);
    unset($_GET['activated']);
    add_action('admin_notices', 'themename_upgrade_notice');
}

add_action('after_switch_theme', 'themename_switch_theme');

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Creativity Architect on WordPress versions prior to 3.8.
 *
 *
 * @return void
 */
function themename_upgrade_notice() {
    $message = sprintf(__('Creativity Architect requires at least WordPress version 3.8. You are running version %s. Please upgrade and try again.', 'themename'), $GLOBALS['wp_version']);
    printf('<div class="error"><p>%s</p></div>', $message);
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 3.8.
 *
 *
 * @return void
 */
function themename_customize() {
    wp_die(sprintf(__('Creativity Architect requires at least WordPress version 3.8. You are running version %s. Please upgrade and try again.', 'themename'), $GLOBALS['wp_version']), '', array(
        'back_link' => true,
    ));
}

add_action('load-customize.php', 'themename_customize');

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 *
 * @return void
 */
function themename_preview() {
    if (isset($_GET['preview'])) {
        wp_die(sprintf(__('Creativity Architect requires at least WordPress version 3.8. You are running version %s. Please upgrade and try again.', 'themename'), $GLOBALS['wp_version']));
    }
}

add_action('template_redirect', 'themename_preview');
