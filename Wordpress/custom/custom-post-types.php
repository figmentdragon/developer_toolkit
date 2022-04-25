<?php

/**
 * Custom post types are new post types you can create. A custom post type can 
 * be added to WordPress via the register_post_type() function. This function 
 * allows you to define a new post type by its labels, supported features, 
 * availability and other specifics.
 * 
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 * @link http://codex.wordpress.org/Post_Types#Custom_Post_Types
 */
function themename_register_post_type() {
    $teamLabels = array(
        'name' => __('Team', 'themename'),
        'singular_name' => __('Team', 'themename'),
        'add_new' => __('Add New', 'themename'),
        'add_new_item' => __('Add New Profile', 'themename'),
        'edit_item' => __('Edit Profile', 'themename'),
        'new_item' => __('New Profile', 'themename'),
        'all_items' => __('All Profiles', 'themename'),
        'view_item' => __('View Profile', 'themename'),
        'search_items' => __('Search Profiles', 'themename'),
        'not_found' => __('No profile was found', 'themename'),
        'not_found_in_trash' => __('No profile was found in Trash', 'themename'),
        'parent_item_colon' => '',
        'menu_name' => __('Team', 'themename')
    );

    $teamArgs = array(
        'labels' => $teamLabels,
        'public' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'menu_icon' => 'dashicons-businessman',
        'query_var' => true,
        'rewrite' => array('slug' => 'team'),
        'has_archive' => false,
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
//            'trackbacks',
            'custom-fields',
//            'comments',
            'revisions',
//            'page-attributes',
//            'post-formats',
        )
    );

    register_post_type('team', $teamArgs);
}

add_action('init', 'themename_register_post_type');

/**
 * To get permalinks to work when you activate the theme
 */
if (!function_exists('themename_rewrite_flush')){
    function themename_rewrite_flush() {
        flush_rewrite_rules();
    }
}

add_action('after_switch_theme', 'themename_rewrite_flush');

function themename_print($title = '', $before = '', $after = '', $echo = true) {

    if (strlen($title) == 0)
        return;
    $title = $before . $title . $after;
    if ($echo)
        echo $title;
    else
        return $title;
}
