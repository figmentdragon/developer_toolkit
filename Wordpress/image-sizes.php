<?php
/**
 * Add all the Image Sizes
 * add_image_size()
*/

add_image_size( 'large', 700, '', true ); // Large Thumbnail.
add_image_size( 'medium', 250, '', true ); // Medium Thumbnail.
add_image_size( 'small', 120, '', true ); // Small Thumbnail.
add_image_size( 'custom-size', 700, 200, true ); // Custom Thumbnail Size	add_image_size('themename_small_thumbnail', 50, 50, true);
add_image_size('themename_pagination_thumbnail', 60, 60, true);
// add_image_size('themename_about_me_thumb', 275, 275, true); call using the_post_thumbnail('custom-size');
add_image_size('themename_small_thumbnail', 50, 50, true);
add_image_size('themename_pagination_thumbnail', 60, 60, true);
// add_image_size('themename_about_me_thumb', 275, 275, true);


?>
