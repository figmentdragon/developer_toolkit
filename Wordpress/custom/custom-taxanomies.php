<?php

/**
 * In WordPress, a "taxonomy" is a grouping mechanism for some posts 
 * (or links or custom post types).
 * 
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 * @link http://codex.wordpress.org/Taxonomies#Custom_Taxonomies
 */
// create two taxonomies, genres and writers for the post type "book"
function themename_register_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __('Departments', 'themename'),
        'singular_name' => __('Department', 'themename'),
        'search_items' => __('Search Departments', 'themename'),
        'all_items' => __('All Departments', 'themename'),
        'parent_item' => __('Parent Department', 'themename'),
        'parent_item_colon' => __('Parent Department:', 'themename'),
        'edit_item' => __('Edit Department', 'themename'),
        'update_item' => __('Update Department', 'themename'),
        'add_new_item' => __('Add New Department', 'themename'),
        'new_item_name' => __('New Department Name', 'themename'),
//        'separate_items_with_commas' => __('Separate departments with commas', 'themename'),
        'add_or_remove_items' => __('Add or remove departments', 'themename'),
//        'choose_from_most_used' => __('Choose from the most used departments', 'themename'),
        'not_found' => __('No department was found.', 'themename'),
        'menu_name' => __('Departments', 'themename'),
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

add_action('init', 'themename_register_taxonomies');

/**
 * To get permalinks to work when you activate the theme
 */
if (!function_exists('themename_rewrite_flush')){
    function themename_rewrite_flush() {
        flush_rewrite_rules();
    }
}

add_action('after_switch_theme', 'flush_rewrite_rules');