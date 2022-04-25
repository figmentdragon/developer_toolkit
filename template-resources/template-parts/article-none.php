<?php
/**
 * Article none.
 *
 * Is displayed if no post has been found.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

echo '<h1 class="entry-title" itemprop="headline">' . apply_filters( 'no_post_headline', __( "Oops, this article couldn't be found!", 'TheCreativityArchitect' ) ) . '</h1>';

?>

<div class="entry-content" itemprop="text">
	<?php echo '<p>' . apply_filters( 'no_post_content', __( "Something went wrong.", 'TheCreativityArchitect' ) ) . '</p>'; ?>
</div>
