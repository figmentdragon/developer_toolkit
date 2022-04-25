<?php
if ( have_posts() ) :

  if ( is_home() && ! is_front_page() ) :
    ?>
    <header class="page-header">
      <h3 class="page-title screen-reader-text"><?php single_post_title(); ?></h3>
    </header>
    <?php
  endif;

  /* Start the Loop */
  while ( have_posts() ) :
    the_post();

    /*
     * Include the Post-Type-specific template for the content.
     * If you want to override this in a child theme, then include a file
     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
     */
    get_template_part( 'template-parts/content', get_post_type() );

  endwhile;

  the_posts_navigation();
?>
