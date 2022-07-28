<?php
/**
 * Init.
 *
 * @package THEMENAE
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

require THEME_DIR . '/inc/backwards-compatibility.php';
require_once THEME_DIR . '/inc/body-classes.php';
require_once THEME_DIR . '/inc/breadcrumbs.php';
require_once THEME_DIR . '/inc/class-vars.php';
require THEME_DIR . '/inc/custom-header.php';
require THEME_DIR . '/inc/custom-post-type.php';
require THEME_DIR . '/inc/extras.php';
require_once THEME_DIR . '/inc/gravatar.php';
require_once THEME_DIR . '/inc/helpers.php';
require_once THEME_DIR . '/inc/misc.php';
require_once THEME_DIR . '/inc/options.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require THEME_DIR . '/inc/theme-functions.php';
require_once THEME_DIR . '/inc/theme-mods.php';
require_once THEME_DIR . '/inc/theme-settings.php';
require_once THEME_DIR . '/inc/quick-edit.php';

require THEME_DIR . '/inc/classes/class-plugin-activation.php';
require get_template_directory() . '/inc/classes/class-customize.php';
new Customize();
require_once get_template_directory() . '/inc/classes/class-dark-mode.php';
new Dark_Mode();
require THEME_DIR . '/inc/classes/class-menu-attribute-walker.php';

require THEME_DIR . '/inc/classes/class-script-loader.php';
require THEME_DIR . '/inc/classes/class-separator-control.php';
require THEME_DIR . '/inc/classes/class-svg-icons.php';
require THEME_DIR . '/inc/classes/class-walker-page.php';

require get_template_directory() . '/inc/custom-functions/menu-functions.php';

require_once THEME_DIR . '/inc/customizer/customizer.php';


/**
 * Render pre header.
 */
function do_pre_header() {
	get_template_part( 'template-parts/header/pre-header' );
}
add_action( 'pre_header', 'do_pre_header' );

/**
 * Render header.
 */
function do_header() {
	get_template_part( 'template-parts/header' );
}
add_action( 'header', 'do_header' );

/**
 * Render footer.
 */
function do_footer() {
	get_template_part( 'template-parts/footer' );
}
add_action( 'footer', 'do_footer' );

/**
 * Render 404 page.
 */
function do_404() {
	get_template_part( 'template-parts/404' );
}
add_action( '404', 'do_404' );
