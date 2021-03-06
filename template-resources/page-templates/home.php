<?php
/**
 * Template Name: Home
 *
 */
get_header();
?>
<div id="home" class="site-content">
    <div id="main" role="main">
        <?php while (have_posts()) : the_post(); ?>
            <article id="content" <?php post_class(); ?> <?php schema(); ?>>
                <?php
                creativity_post_thumbnail();
                ?>
                <div class="entry-content" <?php schema('mainContentOfPage'); ?>>
                    <?php the_content(); ?>
                    <?php edit_post_link(__('Edit', 'creativity')); ?>
                </div><!-- .entry-content -->
            </article><!-- #content -->
        <?php endwhile; ?>
    <?php if (is_active_sidebar('call2action') && is_front_page()) : ?>
        <?php dynamic_sidebar('call2action'); ?>
    <?php endif; ?>
    </div><!-- #main -->
</div><!-- #home -->
<?php
get_footer();
