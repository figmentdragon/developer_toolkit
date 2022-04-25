<?php
/**
 * Featured image.
 *
 * Renders featured image on archives.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

// Stop if there's no thumbnail.
if ( ! has_post_thumbnail() ) {
	return;
}

?>

<div class="post-image-wrapper">
	<a class="post-image-link" href="<?php echo esc_url( get_permalink() ); ?>">
		<span class="screen-reader-text"><?php the_title(); ?></span>
		<?php the_post_thumbnail( apply_filters( 'blog_post_thumbnail_size', 'full' ), array( 'class' => 'post-image', 'itemprop' => 'image' ) ); ?>
	</a>
</div>
