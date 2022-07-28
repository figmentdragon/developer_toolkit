<?php
/**
 * Comment structure.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'TheThemeNamecomment' ) ) {
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function TheThemeNamecomment( $comment, $args, $depth ) {
		$args['avatar_size'] = apply_filters( 'TheThemeNamecomment_avatar_size', 50 );

		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php esc_html_e( 'Pingback:', 'TheThemeName' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'TheThemeName' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body" itemscope itemtype="https://schema.org/Comment">
				<footer class="comment-meta">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<div class="comment-author-info">
						<div class="comment-author vcard" itemprop="author" itemscope itemtype="https://schema.org/Person">
							<?php printf( '<cite itemprop="name" class="fn">%s</cite>', get_comment_author_link() ); ?>
						</div><!-- .comment-author -->

						<div class="entry-meta comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>" itemprop="datePublished">
									<?php printf( 
										/* translators: 1: date, 2: time */
										esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'TheThemeName' ),
										esc_html( get_comment_date() ),
										esc_html( get_comment_time() )
									); ?>
								</time>
							</a>
							<?php edit_comment_link( __( 'Edit', 'TheThemeName' ), '<span class="edit-link">| ', '</span>' ); ?>
							<?php
							comment_reply_link( array_merge( $args, array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<span class="reply">| ',
								'after'     => '</span>',
							) ) );
							?>
						</div><!-- .comment-metadata -->
					</div><!-- .comment-author-info -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'TheThemeName' ); // WPCS: XSS OK. ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content" itemprop="text">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->
			</article><!-- .comment-body -->
		<?php
		endif;
	}
}

add_filter( 'comment_form_default_fields', 'TheThemeNamefilter_comment_fields' );
/**
 * Customizes the existing comment fields.
 *
 * @param array $fields
 * @return array
 */
function TheThemeNamefilter_comment_fields( $fields ) {
	$commenter = wp_get_current_commenter();

	$fields['author'] = '<label for="author" class="screen-reader-text">' . esc_html__( 'Name', 'TheThemeName' ) . '</label><input placeholder="' . esc_attr__( 'Name', 'TheThemeName' ) . ' *" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />';
	$fields['email'] = '<label for="email" class="screen-reader-text">' . esc_html__( 'Email', 'TheThemeName' ) . '</label><input placeholder="' . esc_attr__( 'Email', 'TheThemeName' ) . ' *" id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" />';
	$fields['url'] = '<label for="url" class="screen-reader-text">' . esc_html__( 'Website', 'TheThemeName' ) . '</label><input placeholder="' . esc_attr__( 'Website', 'TheThemeName' ) . '" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />';

	return $fields;
}
