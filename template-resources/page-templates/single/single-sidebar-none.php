<?php
/*
	 * Template Name: No Sidebar
	 * Template Post Type: post
	 */

get_header();  ?>
<div id="content" class="site-content container py-5 mt-4">
  <div id="primary" class="content-area">

    <!-- Hook to add something nice -->
    <?php bs_after_primary(); ?>

    <?php the_breadcrumb(); ?>

    <main id="main" class="site-main">

      <header class="entry-header">
        <?php the_post(); ?>

        <?php theme_category_badge(); ?>

        <?php the_title('<h1>', '</h1>'); ?>
        <p class="entry-meta">
          <small class="muted-color">
            <?php
            theme_date();
            _e(' by ', 'theme');
            the_author_posts_link();
            theme_comment_count();
            ?>
          </small>
        </p>
        <?php theme_post_thumbnail(); ?>
      </header>

      <div class="entry-content">
        <?php the_content(); ?>
      </div>

      <footer class="entry-footer clear-both">
        <div class="mb-4">
          <?php theme_tags(); ?>
        </div>
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <?php previous_post_link('%link'); ?>
            </li>
            <li class="page-item">
              <?php next_post_link('%link'); ?>
            </li>
          </ul>
        </nav>

      </footer>

      <?php comments_template(); ?>

    </main><!-- #main -->

  </div><!-- #primary -->
</div><!-- #content -->
<?php get_footer(); ?>