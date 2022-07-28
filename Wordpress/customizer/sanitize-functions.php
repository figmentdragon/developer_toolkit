<?php
/**
 * Sanitize Functions
 *
 * Used to validate the user input of the theme settings
 * Based on https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 *
 * @package creativity_
 */

// Text Area
 function creativity_sanitize_textarea($input){
	return wp_kses_post( $input );
}

// Strip Slashes
	function creativity_sanitize_strip_slashes($input) {
		return wp_kses_stripslashes($input);
	}	

/**
 * Checkbox sanitization callback example.
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked` as a boolean value, either TRUE or FALSE.
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function creativity_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
	
/**
 * Select & Radio Button sanitization callback
 * @param String  $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function creativity_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
