<?php

/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called creativity-Blank
function create_post_type_creativity() {
  register_taxonomy_for_object_type( 'category', 'creativity' ); // Register Taxonomies for Category
  register_taxonomy_for_object_type( 'post_tag', 'creativity' );
  register_post_type( 'creativity', // Register Custom Post Type
    array(
      'labels'       => array(
        'name'               => esc_html( 'creativity Custom Post', 'creativity' ), // Rename these to suit
        'singular_name'      => esc_html( 'creativity Custom Post', 'creativity' ),
        'add_new'            => esc_html( 'Add New', 'creativity' ),
        'add_new_item'       => esc_html( 'Add New creativity Custom Post', 'creativity' ),
        'edit'               => esc_html( 'Edit', 'creativity' ),
        'edit_item'          => esc_html( 'Edit creativity Custom Post', 'creativity' ),
        'new_item'           => esc_html( 'New creativity Custom Post', 'creativity' ),
        'view'               => esc_html( 'View creativity Custom Post', 'creativity' ),
        'view_item'          => esc_html( 'View creativity Custom Post', 'creativity' ),
        'search_items'       => esc_html( 'Search creativity Custom Post', 'creativity' ),
        'not_found'          => esc_html( 'No creativity Custom Posts found', 'creativity' ),
        'not_found_in_trash' => esc_html( 'No creativity Custom Posts found in Trash', 'creativity' ),
      ),
      'public'       => true,
      'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
      'has_archive'  => true,
      'supports'     => array(
        'title',
        'editor',
        'excerpt',
        'thumbnail'
      ), // Go to Dashboard Custom creativity post for supports
      'can_export'   => true, // Allows export in Tools > Export
      'taxonomies'   => array(
        'post_tag',
        'category'
      ) // Add Category and Post Tags support
    )
  );
}
