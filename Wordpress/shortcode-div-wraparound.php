<?php

/**
 * Div Shortcode
 *
 * Wraps the content in a div.
 * id and class are the only available attributes
 *
 * @param string $atts
 * @param string $content
 * @return string
 * @author Matt Vickers
 */

function div_shortcode($atts, $content = null) {

	extract( shortcode_atts( array(
		'id' => '',
		'class' => '',
	), $atts ) );

	$id = $id ? " id=\"$id\"" : NULL;
	$class = $class ? " class=\"$class\"" : NULL;

	//join them to make them nicer in the string
	$id_class = $id . $class;

	return "<div$id_class>$content</div>";

}
add_shortcode('div', 'div_shortcode');
