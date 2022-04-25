<?php
/**
 * 404.
 *
 * Construct the theme 404 page.
 *
 * @package TheCreativityArchitect
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

?>

<div id="content">

	<?php do_action( 'content_open' ); ?>

	<?php inner_content(); ?>

		<?php do_action( 'inner_content_open' ); ?>

		<main id="main" class="main<?php echo singular_class(); ?>">

			<div class="text-center">

				<?php echo '<h1 class="entry-title" itemprop="headline">' . apply_filters( '404_headline', __( "404 - This page couldn't be found.", 'TheCreativityArchitect' ) ) . '</h1>'; ?>

				<div class="container-center medium-1-2" itemprop="text">

					<?php echo '<p>' . apply_filters( '404_text', __( "Oops! We're sorry, this page couldn't be found!", 'TheCreativityArchitect' ) ) . '</p>'; ?>

					<?php get_search_form(); ?>

				</div>

			</div>

		</main>

		<?php do_action( 'inner_content_close' ); ?>

	<?php inner_content_close(); ?>

	<?php do_action( 'content_close' ); ?>

</div>
