<?php
/**
 * The template for displaying all pages in the loop.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage theme_name
 * @since theme_version
 */

 <?php if ( have_posts() ) : ?>

 	<ul>

 		<?php while ( have_posts() ) : the_post(); ?>

 			<li>
 				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
 				<?php the_content(); ?>
 			</li>

 		<?php endwhile ?>

 	</ul>

 <?php endif;
