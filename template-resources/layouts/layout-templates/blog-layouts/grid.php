<?php
/**
 * Blog Layout | Grid.
 *
 * @package TheThemeName
 * @subpackage Template Parts
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

$template_parts         = blog_layout();
$template_parts_header  = $template_parts['template_parts_header'];
$template_parts_content = $template_parts['template_parts_content'];
$template_parts_footer  = $template_parts['template_parts_footer'];
$style                  = $template_parts['style'];
$post_classes           = array( 'blog-layout-grid' );
$post_classes[]         = 'post-style-' . $style;
$paged                  = (get_query_var('paged')) ? get_query_var('paged') : 1;

?>

<div class="article-wrapper">

	<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?> <?php archive_schema_markup(); ?>>

		<header class="article-header">

			<?php
			if ( ! empty( $template_parts_header ) && is_array( $template_parts_header ) ) {
				foreach ( $template_parts_header as $part ) {
					get_template_part( 'inc/template-parts/blog/blog-' . $part );
				}
			}
			?>

		</header>

		<section class="entry-summary article-content" itemprop="text">

			<?php
			if ( ! empty( $template_parts_content ) && is_array( $template_parts_content ) ) {
				if ( in_array( 'post', $template_parts_content ) ) {
						the_content();
				} elseif ( in_array( 'excerpt', $template_parts_content ) ) {
						the_excerpt();
				}
			}
			?>

			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'TheThemeName' ),
				'after'  => '</div>',
			) );
			?>

		</section>

		<?php if ( $template_parts_footer != false ) { ?>

			<footer class="article-footer">

				<?php
				if ( ! empty( $template_parts_footer ) && is_array( $template_parts_footer ) ) {
					foreach ( $template_parts_footer as $part ) {
						get_template_part( 'inc/template-parts/blog/blog-' . $part );
					}
				}
				?>

			</footer>

		<?php } ?>

	</article>

</div>
