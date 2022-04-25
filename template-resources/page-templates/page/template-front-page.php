<?php /* Template Name: Front Page */ ?>

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package THEME
 */

<?php get_header(); ?>

<body <?php body_class(); ?> id="front-page">
 <div class="container">

<?php get_sidebar(); ?>
  <p class="site-description"><?php bloginfo( 'description' ); ?></p>

<main class="main" id="main" role="main">
    <div class="container">



    </div>
</main>

    </div>
  </body>
</html>
