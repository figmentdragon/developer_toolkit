<?php

global $content_width;
if ( !isset( $content_width ) ) { $content_width = 1920; }

function setup() {
  add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
}

function enqueue_scripts_and_styles() {
  function enqueue_styles() {
    wp_enqueue_style( 'style', get_stylesheet_directory() . '/style.css' );
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
}
