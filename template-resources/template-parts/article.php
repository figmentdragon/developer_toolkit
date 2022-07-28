<?php
/**
 * Article.
 *
 * Displays posts on archives, category, search and index pages.
 *
 * @package TheThemeName
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

$blog_layout = blog_layout();

get_template_part( 'template-parts/blog-layouts/' . $blog_layout['blog_layout'] );
