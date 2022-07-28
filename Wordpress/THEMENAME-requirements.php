<?php
/**
 * This script is not used within Just Theme Framework itself.
 *
 * This script is meant to be used with your Just Theme Framework-dependent theme or plugin,
 * so that your theme/plugin can verify whether the framework is installed.
 *
 * If framework is not installed, then the script will display a notice with a link to
 * download. If it is installed but not activated, it will display the appropriate notice as well.
 *
 * To use this script, just copy it into your theme/plugin directory then add this in the main file of your project:
 *
 * require_once( 'requirements.php' );
 *
 * @version 1.0
 *
 * @package Just Theme Framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Required functions as it is only loaded in admin pages.
require_once ABSPATH . 'wp-admin/includes/plugin.php';

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
 function register_required_plugins() {
 	/*
 	 * Array of plugin arrays. Required keys are name and slug.
 	 * If the source is NOT from the .org repo, then source is also required.
 	 */
 	$plugins = array(
 		// Catch Web Tools.
 		array(
 			'name' => 'Catch Web Tools', // Plugin Name, translation not required.
 			'slug' => 'catch-web-tools',
 		),
 		// Catch IDs
 		array(
 			'name' => 'Catch IDs', // Plugin Name, translation not required.
 			'slug' => 'catch-ids',
 		),
 		// To Top.
 		array(
 			'name' => 'To top', // Plugin Name, translation not required.
 			'slug' => 'to-top',
 		),
 		// Catch Gallery.
 		array(
 			'name' => 'Catch Gallery', // Plugin Name, translation not required.
 			'slug' => 'catch-gallery',
 		),
 	);

 	if ( ! class_exists( 'Catch_Infinite_Scroll_Pro' ) ) {
 		$plugins[] = array(
 			'name' => 'Catch Infinite Scroll', // Plugin Name, translation not required.
 			'slug' => 'catch-infinite-scroll',
 		);
 	}

 	if ( ! class_exists( 'Essential_Content_Types_Pro' ) ) {
 		$plugins[] = array(
 			'name' => 'Essential Content Types', // Plugin Name, translation not required.
 			'slug' => 'essential-content-types',
 		);
 	}

 	if ( ! class_exists( 'Essential_Widgets_Pro' ) ) {
 		$plugins[] = array(
 			'name' => 'Essential Widgets', // Plugin Name, translation not required.
 			'slug' => 'essential-widgets',
 		);
 	}

 	if ( ! class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
 		$plugins[] = array(
 			'name' => 'Catch Instagram Feed Gallery & Widget', // Plugin Name, translation not required.
 			'slug' => 'catch-instagram-feed-gallery-widget',
 		);
 	}

 	/*
 	 * Array of configuration settings. Amend each line as needed.
 	 *
 	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
 	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
 	 * sending in a pull-request with .po file(s) with the translations.
 	 *
 	 * Only uncomment the strings in the config array if you want to customize the strings.
 	 */
 	$config = array(
 		'id'           => 'TheThemeName',                 // Unique ID for hashing notices for multiple instances of TGMPA.
 		'default_path' => '',                      // Default absolute path to bundled plugins.
 		'menu'         => 'tgmpa-install-plugins', // Menu slug.
 		'has_notices'  => true,                    // Show admin notices or not.
 		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
 		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
 		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
 		'message'      => '',                      // Message to output right before the plugins table.
 	);

 	tgmpa( $plugins, $config );
 }
