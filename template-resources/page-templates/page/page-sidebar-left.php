<?php /* TEMPLATE NAME: Page Left Sidebar */ ?>

/**
 * Template Name: Left Sidebar
 */

 <?php get_header(); ?>

 <body <?php body_class(); ?>>

   <div class="container">

     <?php get_sidebar(); ?>

       <p class="site-description"><?php bloginfo( 'description' ); ?></p>

       <main class="main" id="main" role="main">
         <div class="container">

<div id="content" class="site-content container py-5 mt-5">
  <div id="primary" class="content-area">

    <!-- Hook to add something nice -->
    <?php bs_after_primary(); ?>

    <div class="row">
      <!-- sidebar -->
      <?php get_sidebar(); ?>
      <div class="col-md-8 col-xxl-9 order-first order-md-last">

        <main id="main" class="site-main">

          <header class="entry-header">
            <?php the_post(); ?>
            <?php the_category(', ') ?><?php the_terms($post->ID, 'isopost_categories', ' ', ' / '); ?>
            <?php the_title('<h1>', '</h1>'); ?>
            <?php theme_post_thumbnail(); ?>
          </header>

          <div class="entry-content">
            <!-- Content -->
            <?php the_content(); ?>
            <!-- .entry-content -->
            <?php wp_link_pages(array(
              'before' => '<div class="page-links">' . esc_html__('Pages:', 'theme'),
              'after'  => '</div>',
            ));
            ?>
          </div>

          <footer class="entry-footer">

          </footer>

          <?php comments_template(); ?>

        </main><!-- #main -->

      </div><!-- col -->
    </div><!-- row -->

  </div><!-- #primary -->
</div><!-- #contenty -->
<?php
get_footer();
