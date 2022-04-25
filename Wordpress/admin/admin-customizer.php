<?php

/**
 * themename Theme Customizer support
 *
 */

add_action('customize_register', 'themename_customize_register');

add_action('customize_preview_init', 'themename_customize_preview_js');

/**
 * Add contextual help to the Themes and Post edit screens.
 *
 *
 * @return void
 */
function themename_contextual_help() {
    if ('admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow']) {
        return;
    }
    get_current_screen()->add_help_tab(array(
        'id' => 'themename',
        'title' => __('themename', 'themename'),
        'content' =>
        '<ul>' .
        '<li>' . sprintf(__('Enhance your site design by using <a href="%s">Featured Images</a> for posts you&rsquo;d like to stand out (also known as post thumbnails). This allows you to associate an image with your post without inserting it. themename uses featured images for posts and pages&mdash;above the title.', 'themename'), 'http://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail') . '</li>' .
        '<li>' . sprintf(__('For an in-depth tutorial, and more tips and tricks, visit the <a href="%s">themename documentation</a>.', 'themename'), 'http://bigemployee.com/projects/big-blank-responsive-wordpress-theme/') . '</li>' .
        '</ul>',
    ));
}

add_action('admin_head-themes.php', 'themename_contextual_help');
add_action('admin_head-edit.php', 'themename_contextual_help');
