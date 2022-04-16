<?php

/**
 * In WordPress, a "taxonomy" is a grouping mechanism for some posts
 * (or links or custom post types).
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 * @link http://codex.wordpress.org/Taxonomies#Custom_Taxonomies
 */
// create two taxonomies, genres and writers for the post type "book"
function custom_register_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __('Departments', 'creativity'),
        'singular_name' => __('Department', 'creativity'),
        'search_items' => __('Search Departments', 'creativity'),
        'all_items' => __('All Departments', 'creativity'),
        'parent_item' => __('Parent Department', 'creativity'),
        'parent_item_colon' => __('Parent Department:', 'creativity'),
        'edit_item' => __('Edit Department', 'creativity'),
        'update_item' => __('Update Department', 'creativity'),
        'add_new_item' => __('Add New Department', 'creativity'),
        'new_item_name' => __('New Department Name', 'creativity'),
//        'separate_items_with_commas' => __('Separate departments with commas', 'creativity'),
        'add_or_remove_items' => __('Add or remove departments', 'creativity'),
//        'choose_from_most_used' => __('Choose from the most used departments', 'creativity'),
        'not_found' => __('No department was found.', 'creativity'),
        'menu_name' => __('Departments', 'creativity'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
//        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'department')
    );

    register_taxonomy('department', array('team'), $args);
}

add_action('init', 'custom_register_taxonomies');

/**
 * To get permalinks to work when you activate the theme
 */
if (!function_exists('custom_rewrite_flush')){
    function custom_rewrite_flush() {
        flush_rewrite_rules();
    }
}

add_action('after_switch_theme', 'flush_rewrite_rules');
