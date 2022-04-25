<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Storytime
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="page-header">
        <?php if (get_theme_mod( 'storytime_show_page_featured_image', true ) && has_post_thumbnail() ) {
				 storytime_post_thumbnail(); 
			 }
			 ?>

        <?php 
			 if (get_theme_mod( 'storytime_show_default_page_title_group', true ) ) {	
				 the_title( '<h1 class="page-title">', '</h1>' ); 
			 }
			?>


        <?php if ( has_excerpt() && !is_archive() && !is_search() && !is_404()  ) :						
			$page_id = get_queried_object_id(); ?>
        <p id="page-intro">
            <?php echo esc_html(get_post_field( 'post_excerpt', $page_id, 'display' ) ); ?>
        </p>
        <?php endif;?>

        <hr class="page-title-line">

    </header>


    <div class="post-content entry-content clearfix">
        <?php the_content(); ?>
		<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit This Page<span class="screen-reader-text"> "%s"</span>', 'storytime' ),
				get_the_title()
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer>'
		);
		?>
        <?php storytime_multipage_navigation(); ?>
    </div>
	
	

</article>
