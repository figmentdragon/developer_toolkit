<?php
/**
 * Archive elements.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'TheThemeNamearchive_title' ) ) {
	add_action( 'TheThemeNamearchive_title', 'TheThemeNamearchive_title' );
	/**
	 * Build the archive title
	 *
	 */
	function TheThemeNamearchive_title() { ?>
		<header class="page-header<?php if ( is_author() ) echo ' clearfix';?>">
			<?php
			/**
			 * TheThemeNamebefore_archive_title hook.
			 *
			 */
			do_action( 'TheThemeNamebefore_archive_title' );
			?>

			<h1 class="page-title">
				<?php the_archive_title(); ?>
			</h1>

			<?php
			/**
			 * TheThemeNameafter_archive_title hook.
			 *
			 */
			do_action( 'TheThemeNameafter_archive_title' );

			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) {
				printf( '<div class="taxonomy-description">%s</div>', wp_kses_post( $term_description ) ); 
			}

			if ( get_the_author_meta( 'description' ) && is_author() ) {
				echo '<div class="author-info">' . esc_html( get_the_author_meta( 'description' ) ) . '</div>'; 
			}

			/**
			 * TheThemeNameafter_archive_description hook.
			 *
			 */
			do_action( 'TheThemeNameafter_archive_description' ); ?>
		</header><!-- .page-header -->
		<?php
	}
}

if ( ! function_exists( 'TheThemeNamefilter_the_archive_title' ) ) {
	add_filter( 'get_the_archive_title', 'TheThemeNamefilter_the_archive_title' );
	/**
	 * Alter the_archive_title() function to match our original archive title function
	 *
	 *
	 * @param string $title The archive title
	 * @return string The altered archive title
	 */
	function TheThemeNamefilter_the_archive_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			/*
			 * Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			 */
			the_post();
			$title = sprintf( '%1$s<span class="vcard">%2$s</span>',
				get_avatar( get_the_author_meta( 'ID' ), 75 ),
				get_the_author()
			);
			/*
			 * Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();
		}

		return $title;

	}
}
