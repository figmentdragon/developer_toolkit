<?php
# -----------------------------------------------------------------
# Options Panel for Admin
# -----------------------------------------------------------------

// -----  Add admin menu link for Theme Options
add_action( 'wp_before_admin_bar_render', 'options_to_admin' );

// put the options on the menu and top stage, for admins only
function options_to_admin() {

	if ( current_user_can( 'manage_options' ) ) {
		global $wp_admin_bar;

		// we can add a submenu item too
		$wp_admin_bar->add_menu( array(
			'parent' => '',
			'id' => 'TheThemeName-options',
			'title' => __('TheThemeName Options'),
			'href' => admin_url( 'themes.php?page=TheThemeName-options')
		) );

		// add a customizer link that opens the sharing form
		$wp_admin_bar->add_menu( array(
			'parent' => 'customize',
			'id' => 'THEMENAE-customize',
			'title' => __('Writing Form'),
			'href' => admin_url( 'customize.php?url='. redirect_url())
		) );

	}
}

// Set up javascript for the theme options interface
function enqueue_options_scripts() {

	// media scripts needed for wordpress media uploaders
	wp_enqueue_media();

	// custom jquery for the options admin screen
	wp_register_script( 'options_js' , get_stylesheet_directory() . '/assets/scripts/js/jQuery/options.js', null , '1.0', TRUE );
	wp_enqueue_script( 'options_js' );
}

// load theme options Settings
function load_theme_options() {

	if ( file_exists( get_stylesheet_directory()  . '/inc/classes/classes-theme-options.php' ) ) {
		include_once( get_stylesheet_directory()  . '/inc/classes/classes-theme-options.php' );
	}

}
?>
