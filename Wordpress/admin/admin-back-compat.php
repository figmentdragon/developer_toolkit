<?php

/**
 * creativity back compat functionality
 *
 * Prevents creativity from running on WordPress versions prior to 3.8,
 * since this theme is not meant to be backward compatible beyond that
 * and relies on many newer functions and markup changes introduced in 3.8.
 *
 */

/**
 * Prevent switching to creativity on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 *
 * @return void
 */
function creativity_switch_theme() {
    switch_theme(WP_DEFAULT_THEME, WP_DEFAULT_THEME);
    unset($_GET['activated']);
    add_action('admin_notices', 'creativity_upgrade_notice');
}

add_action('after_switch_theme', 'creativity_switch_theme');

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * creativity on WordPress versions prior to 3.8.
 *
 *
 * @return void
 */
function creativity_upgrade_notice() {
    $message = sprintf(__('creativity requires at least WordPress version 3.8. You are running version %s. Please upgrade and try again.', 'creativity'), $GLOBALS['wp_version']);
    printf('<div class="error"><p>%s</p></div>', $message);
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 3.8.
 *
 *
 * @return void
 */
function creativity_customize() {
    wp_die(sprintf(__('creativity requires at least WordPress version 3.8. You are running version %s. Please upgrade and try again.', 'creativity'), $GLOBALS['wp_version']), '', array(
        'back_link' => true,
    ));
}

add_action('load-customize.php', 'creativity_customize');

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 *
 * @return void
 */
function creativity_preview() {
    if (isset($_GET['preview'])) {
        wp_die(sprintf(__('creativity requires at least WordPress version 3.8. You are running version %s. Please upgrade and try again.', 'creativity'), $GLOBALS['wp_version']));
    }
}

add_action('template_redirect', 'creativity_preview');
