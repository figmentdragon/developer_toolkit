<?php
/**
 * Show the appropriate content for the Video post format.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage creativity
 * @since creativity 1.0
 */

$content = get_the_content();

if ( has_block( 'core/video', $content ) ) {
	creativity_print_first_instance_of_block( 'core/video', $content );
} elseif ( has_block( 'core/embed', $content ) ) {
	creativity_print_first_instance_of_block( 'core/embed', $content );
} else {
	creativity_print_first_instance_of_block( 'core-embed/*', $content );
}

// Add the excerpt.
the_excerpt();
