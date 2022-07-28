<?php
/*
 * Template Name: Authors List Page
 */
get_header();

// add option to classes to avoid the need of resetting the query in after query
global $creativity_blogpage_id;
global $banner_grid_first_post_id;
$creativity_blogpage_id = (!isset($creativity_blogpage_id)) ? get_the_ID() : $creativity_blogpage_id;
$sidebar_postition = creativity_cross_option('creativity_sidebar_position', $creativity_blogpage_id);
$sidebar_class = creativity_sidebar_class($creativity_blogpage_id);
$show_author_posts = creativity_post_option('show_author_posts_list');
?>
<h4 class="page-title screen-reader-text"><?php echo get_the_title(); ?></h4>
<main class="main_content writing_author_list <?php echo creativity_content_class($creativity_blogpage_id); ?>">
<?php
$args['fields'] = array( 'ID', 'display_name' );

if (creativity_post_option('creativity_author_ids_list') !== '') {
	$args['include'] = creativity_post_option('creativity_author_ids_list');
}
if (creativity_post_option('creativity_author_orderby_list') !== '') {
	$args['orderby'] = creativity_post_option('creativity_author_orderby_list'); //  'registered', 'display_name', 'post_count'
}
$users = get_users($args);
foreach ($users as $user)
{
// Check if avatar is available

$author_id = $user->ID;

if (get_avatar( get_the_author_meta( 'user_email', $author_id ), 80 ) != '') {
	$author_avatar = creativity_filter_lazyload_images(get_avatar( get_the_author_meta( 'user_email', $author_id ), 80 ));
}
$author_profile_url = get_author_posts_url( get_the_author_meta( 'ID', $author_id ) );
 ?>
<div class="author_box author-info<?php if (isset($author_avatar)) { echo ' has_avatar';}?>">

	<?php if (isset($author_avatar)) { ?>
		<div class="author-avatar">
			<a class="author-link" href="<?php echo esc_url($author_profile_url); ?>" rel="author">
			<?php
				echo $author_avatar;
			?>
			</a>
		</div><!-- .author-avatar -->
	<?php } ?>

	<div class="author-description author_text">

		<h3 class="author-title">
			<a class="author-link" href="<?php echo esc_url($author_profile_url); ?>" rel="author">
			<?php echo get_the_author_meta('display_name', $author_id); ?>
			</a>
		</h3>

		<p class="author-bio">
			<?php the_author_meta( 'description', $author_id ); ?>
		</p><!-- .author-bio -->

			<?php
				$social_icons_list = '';

				// Website
				if ($url_link = get_the_author_meta('url', $author_id)) {
					$social_icons_list .= '<a rel="nofollow noreferrer" href="'. esc_url($url_link) .'" target="_blank" class="social_icon social_url social_icon_url" ><i class="fa fa-globe"></i></a>';
				}

				// Facebook
				if ($facebook_link = get_the_author_meta('facebook', $author_id)) {

					if (!strrpos($facebook_link, 'facebook.com') && !strrpos($facebook_link, 'fb.com')) {
						$facebook = "https://facebook.com/". $facebook_link;
					} else {
						$facebook = $facebook_link;
					}

					$social_icons_list .= '<a target="_blank" rel="nofollow noreferrer" href="'. esc_url($facebook) .'" class="social_icon social_facebook social_icon_facebook" ><i class="fa fa-facebook"></i></a>';
				}

				// Twitter
				if ($twitter_link = get_the_author_meta('twitter', $author_id)) {
					if (!strrpos($twitter_link, 'twitter.com') && !strrpos($twitter_link, 'twt.com')) {

						if (strpos($twitter_link, '@')) {
							$twitter = str_replace('@', '', $twitter_link);
						} else {
							$twitter = $twitter_link;
						}
						$twitter = 'https://twitter.com/'.$twitter;

					} else {
						$twitter = $twitter_link;
					}

					$social_icons_list .= '<a rel="nofollow noreferrer" href="'. esc_url($twitter) .'" target="_blank" class="social_icon social_twitter social_icon_twitter"><i class="fa fa-twitter"></i></a>';
				}

				// Google+
				if (get_the_author_meta('gplus', $author_id) != "") {
					$social_icons_list .= '<a rel="nofollow noreferrer" href="'. esc_url(get_the_author_meta('gplus', $author_id)) .'" target="_blank" class="social_icon social_gplus social_icon_gplus"><i class="fa fa-google-plus"></i></a>';
				}

				// Linkedin
				if (get_the_author_meta('linkedin', $author_id) != "") {
					$social_icons_list .= '<a rel="nofollow noreferrer" href="'. esc_url(get_the_author_meta('linkedin', $author_id)) .'" target="_blank" class="social_icon social_linkedin social_icon_linkdin"><i class="fa fa-linkedin"></i></a>';
				}

				// Pinterest
				if (get_the_author_meta('pinterest', $author_id) != "") {
					$social_icons_list .= '<a rel="nofollow noreferrer" href="'. esc_url(get_the_author_meta('pinterest', $author_id)) .'" class="social_icon social_pinterest social_icon_pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
				}

				// Social Icons List if any exists
				if ($social_icons_list != '') {
					echo '<div class="social_icons_list">'.$social_icons_list.'</div>';
				}
			?>
	</div><!-- .author-description -->
</div><!-- .author-info -->
<?php
if ($show_author_posts) {
	$args = array('orderby' => 'rand', 'posts_per_page' => 3, 'author' => $author_id, 'ignore_sticky_posts' => 1, 'meta_query' => array(array( 'key' => '_thumbnail_id', 'value'   => '', 'compare' => '!=', )) );
	$title = sprintf( __( '%s\'s Posts', 'writing' ),  get_the_author_meta('display_name', $author_id));
	echo creativity_single_related_posts($args, $title);
	}
}
?>

    </main><!-- .main_content -->
    <?php if ($sidebar_postition != 'none' ): ?>
      <?php // Show Sidebar only if site width less than 701
      if (!(creativity_option('creativity_site_width')) || !(creativity_option('creativity_site_width') < 701)) { ?>
        <aside class="side_content widget_area <?php echo esc_attr($sidebar_class); ?>">
            <?php get_sidebar(); ?>
        </aside>
      <?php } ?>
    <?php endif; ?>

<?php get_footer(); ?>