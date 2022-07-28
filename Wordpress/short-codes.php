<?php

/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function creativity_shortcode_demo( $atts, $content = null ) {
    return '<div class="shortcode-demo">' . do_shortcode( $content ) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
function creativity_shortcode_demo_2( $atts, $content = null ) {
    return '<h2>' . $content . '</h2>';
}

/**
 * Shortcode to display copyright year.
 *
 * @author Haris Zulfiqar
 *
 * @param array $atts Optional attributes.
 *     $starting_year Optional. Define starting year to show starting year and current year e.g. 2015 - 2018.
 *     $separator Optional. Separator between starting year and current year.
 *
 * @return string Copyright year text.
 */
function creativity_copyright_year( $atts ) {
	// Setup defaults.
	$args = shortcode_atts(
		[
			'starting_year' => '2022',
			'separator'     => ' - ',
		],
		$atts
	);

	$current_year = gmdate( 'Y' );

	// Return current year if starting year is empty.
	if ( ! $args['starting_year'] ) {
		return $current_year;
	}

	return esc_html( $args['starting_year'] . $args['separator'] . $current_year );
}
