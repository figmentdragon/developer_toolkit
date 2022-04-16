<?php
/**
 * Functions used to implement options
 *
 * @package Customizer Library Demo
 */

/**
 * Enqueue Google Fonts Example
 */
function demo_fonts() {

		// Font options
		$fonts = array(
			get_theme_mod( 'creativity_logo_font_type'),
			get_theme_mod( 'creativity_main_font_type'),
			get_theme_mod( 'creativity_tagline_font_type'),
			get_theme_mod( 'creativity_head_font_type'),
			get_theme_mod( 'creativity_blog_font_type'),
			get_theme_mod( 'creativity_menu_font_type'),
			get_theme_mod( 'creativity_bloglist_title_font_type'),
			get_theme_mod( 'creativity_blogsingle_title_font_type'),
			get_theme_mod( 'creativity_metainfo_font_type'),
			get_theme_mod( 'creativity_widgettitle_font_type'),
		);

		$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'writing_google_fonts', $font_uri, array(), null, 'screen' );

}
add_action( 'wp_enqueue_scripts', 'demo_fonts' );
add_action( 'admin_enqueue_scripts', 'demo_fonts');

function writing_googlefonts_async($tag, $handle) {
	if ($handle === 'writing_google_fonts') {
		return str_replace( "media='screen'", "media='print' onload='this.media=\"all\"'", $tag );
	} else {
		return $tag;
	}
}

function writing_preconnect_prefetch() {
		// Font options
		$fonts = array(
			get_theme_mod( 'creativity_logo_font_type'),
			get_theme_mod( 'creativity_main_font_type'),
			get_theme_mod( 'creativity_tagline_font_type'),
			get_theme_mod( 'creativity_head_font_type'),
			get_theme_mod( 'creativity_blog_font_type'),
			get_theme_mod('creativity_menu_font_type'),
			get_theme_mod('creativity_bloglist_title_font_type'),
			get_theme_mod('creativity_blogsingle_title_font_type'),
			get_theme_mod('creativity_metainfo_font_type'),
			get_theme_mod('creativity_widgettitle_font_type'),
		);

		$font_uri = customizer_library_get_google_font_uri( $fonts );

	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />';
	echo '<link rel="preload" as="style" href="'.$font_uri.'" />';
}

if (creativity_option('creativity_async_google_fonts')) {
	add_filter('style_loader_tag', 'writing_googlefonts_async', 10, 2);
	add_action('wp_head', 'writing_preconnect_prefetch');
}
