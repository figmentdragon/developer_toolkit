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
function custom_register_post_type() {
    $teamLabels = array(
        'name' => __('Team', 'creativity'),
        'singular_name' => __('Team', 'creativity'),
        'add_new' => __('Add New', 'creativity'),
        'add_new_item' => __('Add New Profile', 'creativity'),
        'edit_item' => __('Edit Profile', 'creativity'),
        'new_item' => __('New Profile', 'creativity'),
        'all_items' => __('All Profiles', 'creativity'),
        'view_item' => __('View Profile', 'creativity'),
        'search_items' => __('Search Profiles', 'creativity'),
        'not_found' => __('No profile was found', 'creativity'),
        'not_found_in_trash' => __('No profile was found in Trash', 'creativity'),
        'parent_item_colon' => '',
        'menu_name' => __('Team', 'creativity')
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

add_action('init', 'custom_register_post_type');

/**
 * To get permalinks to work when you activate the theme
 */
if (!function_exists('custom_rewrite_flush')){
    function custom_rewrite_flush() {
        flush_rewrite_rules();
    }
}

add_action('after_switch_theme', 'custom_rewrite_flush');

function custom_print($title = '', $before = '', $after = '', $echo = true) {

    if (strlen($title) == 0)
        return;
    $title = $before . $title . $after;
    if ($echo)
        echo $title;
    else
        return $title;
}
