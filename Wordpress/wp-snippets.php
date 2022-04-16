<?php
/**
 * Wordpress Snippets Library
 */
 ?>



<?php include (TEMPLATEPATH . '/your-file.php'); ?>

<!--
  This will find what the ID is of the top-most post_parent(), in a nested child page. For example, this page you are literally looking at is nested under.
  <?php $parent ?> will be the correct ID. For example, for use with wp_list_pages.
-->
<?php if ($post->post_parent)	{
  $ancestors=get_post_ancestors($post->ID);
  $root=count($ancestors)-1;
  $parent = $ancestors[$root];
} else {
  $parent = $post->ID;
} ?>

<!-- Embed Page in a Page -->
<?php $recent = new WP_Query("page_id=**ID**"); while($recent->have_posts()) : $recent->the_post();?>
  <h3><?php the_title(); ?></h3>
  <?php the_content(); ?>
<?php endwhile; ?>

<!--Run Loop on Specific Category-->
<?php query_posts('cat=5'); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
   <?php the_content(); ?>
<?php endwhile; endif; ?>
<!--If you were to use this, for example, in a left sidebar which ran before the main loop on your page, remember to reset the query or it will upset that main loop.-->
<?php wp_reset_query(); ?>

<!--Uses WordPress functions and queries to pull user information, and to display the login/logout/register links.-->
<div id="user-details">
<?php
   if (is_user_logged_in()) {
      $user = wp_get_current_user();
      echo ‘Welcome back <strong>’.$user->display_name.‘</strong> !’;
   } else { ?>
      Please <strong><?php wp_loginout(); ?></strong>
      or <a href="<?php echo get_option(’home’); ?>/wp-login.php?action=register"> <strong>Register</strong></a>
<?php } ?>
</div>
