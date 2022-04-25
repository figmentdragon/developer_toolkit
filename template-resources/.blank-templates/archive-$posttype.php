<?php
/**
 * Template Name: Archive
 * Template Post Type:
 *
 * The template for displaying Archive-$posttype pages.
 *
 * @package WordPress
 * @subpackage theme_name
 * @since theme_version
 */
get_header(); ?>

<!-- .page-header -->
<header class="page-header">
    <?php the_archive_title( '<h1 class="page-title">', '</h1>' );
        the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
</header>
<!-- .page-header -->
