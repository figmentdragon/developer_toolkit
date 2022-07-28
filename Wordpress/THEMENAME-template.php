<?php

function template_functions() {
  add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
  add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
  add_filter( 'nav_menu_css_class', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected classes (Commented out by default)
  add_filter( 'nav_menu_item_id', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected ID (Commented out by default)
  add_filter( 'page_css_class', 'my_css_attributes_filter', 100, 1 );
}
