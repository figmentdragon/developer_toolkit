<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package TheThemeName
 * @since TheThemeName 1.0
 */

function custom_functions() {
  add_filter('body_class', 'body_class' );
  add_filter('post_class', 'post_class' );
  add_filter( 'attachment_link', 'enhanced_image_navigation', 10, 2 );

}


function body_class($classes){
  $classes[] = 'theme-header4';
  return $classes;
}

function post_class($classes) {
  $classes[] = 'entry entry-center';
  return $classes;
}

function enhanced_image_navigation( $url, $id ) {
    if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
        return $url;

    $image = get_post( $id );
    if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
        $url .= '#main';

    return $url;
}
