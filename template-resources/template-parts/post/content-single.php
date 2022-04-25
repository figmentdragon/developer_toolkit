<?php
/**
 * Single post partial template.
 * @package creativity
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( false == esc_attr(get_theme_mod( 'creativity__show_single_image', false ) ) ) {
					creativity_post_thumbnail(); 
				}	
		?>
    <div class="post-content">

        <header class="entry-header post-entry-header">

            <?php  if (get_theme_mod( 'creativity__show_default_post_title_group', true ) ) {	
			
				the_title( '<h1 class="entry-title">', '</h1>' ); 			

				if ( false == esc_attr(get_theme_mod( 'creativity__show_single_meta', false ) ) ) {
					creativity_single_entry_meta();
				}
						
			} 
			?>

        </header>

        <div class="entry-content clearfix">
            <?php the_content(); 
            creativity_multipage_navigation();
            ?>

        </div>

        <footer class="entry-footer">

            <?php 
			
			if ( false == esc_attr(get_theme_mod( 'creativity__footer_categories', false ) ) ) {
				creativity_categories();
			}
			
			if ( false == esc_attr(get_theme_mod( 'creativity__footer_tags', false ) ) && has_tag() ) {
				echo '<p id="post-tags">', esc_html(creativity_entry_tags()), '</p>';
			}
			
			if ( false == esc_attr(get_theme_mod( 'creativity__display_author_bio', false ) ) ) {
				get_template_part( 'author-bio' ); 
			}		
			
			if ( false == esc_attr(get_theme_mod( 'creativity__post_navigation', false ) ) ) {
				creativity_post_navigation(); 
			}	

			?>

        </footer>

        <?php // If comments are open or we have at least one comment, load up the comment template.
			comments_template(); 
		?>

    </div>
</article>
