<?php

/**
 * creativity Theme Customizer support
 *
 */

add_action('customize_register', 'creativity_customize_register');

add_action('customize_preview_init', 'creativity_customize_preview_js');

/**
 * Add contextual help to the Themes and Post edit screens.
 *
 *
 * @return void
 */
function creativity_contextual_help() {
    if ('admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow']) {
        return;
    }
    get_current_screen()->add_help_tab(array(
        'id' => 'creativity',
        'title' => __('creativity', 'creativity'),
        'content' =>
        '<ul>' .
        '<li>' . sprintf(__('Enhance your site design by using <a href="%s">Featured Images</a> for posts you&rsquo;d like to stand out (also known as post thumbnails). This allows you to associate an image with your post without inserting it. creativity uses featured images for posts and pages&mdash;above the title.', 'creativity'), 'http://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail') . '</li>' .
        '<li>' . sprintf(__('For an in-depth tutorial, and more tips and tricks, visit the <a href="%s">creativity documentation</a>.', 'creativity'), 'http://bigemployee.com/projects/big-blank-responsive-wordpress-theme/') . '</li>' .
        '</ul>',
    ));
}

add_action('admin_head-themes.php', 'creativity_contextual_help');
add_action('admin_head-edit.php', 'creativity_contextual_help');
