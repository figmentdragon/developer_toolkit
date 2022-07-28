<?php

/**
 * Fixes the editor from throwing in random
 * empty p tags.
 *
 * @param string $content
 * @return void
 * @author Matt Vickers
 */

function shortcode_empty_paragraph_fix($content){
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
	$content = str_replace('<p></p>', '', $content);

    return $content;

}
add_filter('the_content', 'shortcode_empty_paragraph_fix');
