<?php /* Template Name: Home */

get_header();

$args = array (
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => 10
);

$query = new WP_Query($args);

if ($query->have_posts()) {
	while ($query->have_posts()) {
		$query->the_post(); ?>

		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	
	<?php }
} else {

	// no posts found

}

wp_reset_postdata();

get_footer(); ?>