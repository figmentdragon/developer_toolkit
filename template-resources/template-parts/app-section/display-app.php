<?php 
/**
 * The template used for displaying hero content
 *
 * @package My Music Band
 */
?>

<?php
$enable_section = get_theme_mod( 'euphony_app_section_visibility', 'disabled' );

if ( ! euphony_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

$type = get_theme_mod( 'euphony_app_section_type', 'page' );

if ( 'page' === $type || 'post' === $type || 'category' === $type ) {
	get_template_part( 'template-parts/app-section/post-type-app' );
} else {
	get_template_part( 'template-parts/app-section/custom-app' );
}
