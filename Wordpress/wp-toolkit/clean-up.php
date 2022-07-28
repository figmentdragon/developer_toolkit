<?php

function clean_up()
{
  remove_action('wp_head', 'wp_generator');                // #1
  remove_action('wp_head', 'wlwmanifest_link');            // #2
  remove_action('wp_head', 'rsd_link');                    // #3
  remove_action('wp_head', 'wp_shortlink_wp_head');        // #4

  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);    // #5

  add_filter('the_generator', '__return_false');            // #6
  //    add_filter('show_admin_bar','__return_false');            // #7

  remove_action('wp_head', 'print_emoji_detection_script', 7);  // #8
  remove_action('wp_print_styles', 'print_emoji_styles');

  /**
   * This is another WordPress anomaly: the standard RSS feed must be explicitly activated with add_theme_support( 'automatic-feed-links' ); but the extra feeds for the single posts (like the list of comments) are generated automatically.
   */

  /**
   * Every time a user leaves a message WordPress adds a cookie to save the name, email and website. If you do not have a huge amount of returning visitors avoid setting useless cookies. Just add to the init function:
   */


  // disable WPML generator tag
