<?php
/**
 * Main theme functions.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function themename_get_setting( $setting ) {
  $themename_settings = wp_parse_args(
    get_option( 'themename_settings', array() ),
    themename_get_defaults()
  );
  return $themename_settings[ $setting ];
}

function themename_get_layout() {
  global $post;
  $themename_settings = wp_parse_args(
    get_option( 'themename_settings', array() ),
    themename_get_defaults()
  );
  $layout = $themename_settings['layout_setting'];
  $layout_meta = ( isset( $post ) ) ? get_post_meta( $post->ID, '_themename-sidebar-layout-meta', true ) : '';
  $buddypress = false;
  if ( function_exists( 'is_buddypress' ) ) {
    $buddypress = ( is_buddypress() ) ? true : false;
  }
  if ( is_single() && ! $buddypress ) {
		$layout = null;
		$layout = $themename_settings['single_layout_setting'];
	}
  if ( '' !== $layout_meta && false !== $layout_meta ) {
		$layout = $layout_meta;
	}
  if ( is_home() || is_archive() || is_search() || is_tax() ) {
		$layout = null;
		$layout = $themename_settings['blog_layout_setting'];
	}
  return apply_filters( 'themename_sidebar_layout', $layout );
}

function themename_get_footer_widgets() {
  global $post;
  $themename_settings = wp_parse_args(
    get_option( 'themename_settings', array() ),
    themename_get_defaults()
  );
  $widgets = $themename_settings['footer_widget_setting'];
  $widgets_meta = ( isset( $post ) ) ? get_post_meta( $post->ID, '_themename-footer-widget-meta', true ) : '';
  if ( ! is_singular() ) {
    $widgets_meta = '';
  }
  if ( '' !== $widgets_meta && false !== $widgets_meta ) {
    $widgets = $widgets_meta;
  }
  return apply_filters( 'themename_footer_widgets', $widgets );
}

function themename_show_excerpt() {
  global $post;
  $themename_settings = wp_parse_args(
    get_option( 'themename_settings', array() ),
    themename_get_defaults()
  );
  $more_tag = apply_filters( 'themename_more_tag', strpos( $post->post_content, '<!--more-->' ) );
  $format = ( false !== get_post_format() ) ? get_post_format() : 'standard';
  $show_excerpt = ( 'excerpt' == $themename_settings['post_content'] ) ? true : false;
  $show_excerpt = ( $more_tag ) ? false : $show_excerpt;
  $show_excerpt = ( is_search() ) ? true : $show_excerpt;
  return apply_filters( 'themename_show_excerpt', $show_excerpt );
}

function themename_show_title() {
  return apply_filters( 'themename_show_title', true );
}

function themename_padding_css( $top, $right, $bottom, $left ) {
  $padding_top = ( isset( $top ) && '' !== $top ) ? absint( $top ) . 'px ' : '0px ';
  $padding_right = ( isset( $right ) && '' !== $right ) ? absint( $right ) . 'px ' : '0px ';
  $padding_bottom = ( isset( $bottom ) && '' !== $bottom ) ? absint( $bottom ) . 'px ' : '0px ';
  $padding_left = ( isset( $left ) && '' !== $left ) ? absint( $left ) . 'px' : '0px';
  if ( ( absint( $padding_top ) === absint( $padding_right ) ) && ( absint( $padding_right ) === absint( $padding_bottom ) ) && ( absint( $padding_bottom ) === absint( $padding_left ) ) ) {
    return $padding_left;
  }
  return $padding_top . $padding_right . $padding_bottom . $padding_left;
}

function themename_get_link_url() {
  $has_url = get_url_in_content( get_the_content() );
  return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

function themename_get_navigation_location() {
  return apply_filters( 'themename_navigation_location', themename_get_setting( 'nav_position_setting' ) );
}

function themename_extra_colors_css() {
  // Get our settings
  $themename_settings = wp_parse_args(
    get_option( 'themename_settings', array() ),
    themename_get_color_defaults()
  );

  $themename_border_color  	 = '#000000';
  $def_cursor_image  	  = '';
  $pointer_cursor_image = '';
  $bg_color = get_background_color();
  if ( isset( $themename_settings['themename_border_color'] ) ) {
    $themename_border_color = $themename_settings['themename_border_color'];
  }
  if ( isset( $themename_settings['def_cursor_image'] ) ) {
    $def_cursor_image = $themename_settings['def_cursor_image'];
  }
  if ( isset( $themename_settings['pointer_cursor_image'] ) ) {
    $pointer_cursor_image = $themename_settings['pointer_cursor_image'];
  }

  $themename_extracolors =
  'header .main-navigation .main-nav ul li a.wpkoi-nav-btn {
    background-color: ' . esc_attr( $themename_settings[ 'navigation_text_color' ] ) . ';
    color: ' . esc_attr( $themename_settings[ 'navigation_background_color' ] ) . ';
  }
  header .main-navigation .main-nav ul li a.wpkoi-nav-btn:hover {
    background-color: ' . esc_attr( $themename_settings[ 'navigation_text_hover_color' ] ) . ';
    color: ' . esc_attr( $themename_settings[ 'navigation_background_color' ] ) . ';
  }
  .transparent-header.home .main-navigation.is_stuck {
    background-color: #' . esc_attr( $bg_color ) . ' ;
  }
  .themename-borders .lalita-side-padding-inside {
    border: 10px solid ' . esc_attr( $themename_border_color ) . ';
  }
  .themename-borders .site-footer {
    border-top: 10px solid ' . esc_attr( $themename_border_color ) . ';
  }
  .themename-borders .site-header {
    border-bottom: 10px solid ' . esc_attr( $themename_border_color ) . ';
  }
  .themename-borders .nav-float-right .is_stuck.main-navigation .nav-float-right .is_stuck.main-navigation{
    border-color: ' . esc_attr( $themename_border_color ) . ';
  }
  .themename-blog-img .post-image img {
    border: 5px solid ' . esc_attr( $themename_border_color ) . ';
  }';

  if ( $def_cursor_image != '' ) {
    $themename_extracolors .= 'body.themename-cursor-image{
      cursor: url(' . esc_url( $def_cursor_image ) . '), auto;
    }';
  }
  if ( $pointer_cursor_image != '' ) {
    $themename_extracolors .= '.themename-cursor-image a, .themename-cursor-image input[type="submit"]
    :hover {
      cursor: url(' . esc_url( $pointer_cursor_image ) . '), auto;
    }';
  }

  return $themename_extracolors;
}
