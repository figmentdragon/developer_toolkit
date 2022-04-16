<?php
/**
 * Comment layout
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Add Bootstrap classes to comment form fields.
add_filter( 'comment_form_default_fields', 'bootstrap_comment_form_fields' );
// Add note if comments are closed.
add_action( 'comment_form_comments_closed', 'comment_form_comments_closed' );
// Add Bootstrap classes to comment form submit button and comment field.
add_filter( 'comment_form_defaults', 'bootstrap_comment_form' );


if ( ! function_exists( 'bootstrap_comment_form_fields' ) ) {
	/**
	 * Add Bootstrap classes to WP's comment form default fields.
	 *
	 * @param array $fields {
	 *     Default comment fields.
	 *
	 *     @type string $author  Comment author field HTML.
	 *     @type string $email   Comment author email field HTML.
	 *     @type string $url     Comment author URL field HTML.
	 *     @type string $cookies Comment cookie opt-in field HTML.
	 * }
	 *
	 * @return array
	 */
	function bootstrap_comment_form_fields( $fields ) {

		$replace = array(
			'<p class="' => '<div class="form-group mb-3',
			'<input'     => '<input class="form-control" ',
			'</p>'       => '</div>',
		);

		if ( isset( $fields['author'] ) ) {
			$fields['author'] = strtr( $fields['author'], $replace );
		}
		if ( isset( $fields['email'] ) ) {
			$fields['email'] = strtr( $fields['email'], $replace );
		}
		if ( isset( $fields['url'] ) ) {
			$fields['url'] = strtr( $fields['url'], $replace );
		}

		$replace = array(
			'<p class="' => '<div class="form-group mb-3 form-check ',
			'<input'     => '<input class="form-check-input" ',
			'<label'     => '<label class="form-check-label" ',
			'</p>'       => '</div>',
		);
		if ( isset( $fields['cookies'] ) ) {
			$fields['cookies'] = strtr( $fields['cookies'], $replace );
		}

		return $fields;
	}
} // End of if function_exists( 'bootstrap_comment_form_fields' )

if ( ! function_exists( 'bootstrap_comment_form' ) ) {
	/**
	 * Adds Bootstrap classes to comment form submit button and comment field.
	 *
	 * @param string[] $args Comment form arguments and fields.
	 *
	 * @return string[]
	 */
	function bootstrap_comment_form( $args ) {
		$replace = array(
			'<p class="' => '<div class="form-group mb-3 ',
			'<textarea'  => '<textarea class="form-control" ',
			'</p>'       => '</div>',
		);

		if ( isset( $args['comment_field'] ) ) {
			$args['comment_field'] = strtr( $args['comment_field'], $replace );
		}

		if ( isset( $args['class_submit'] ) ) {
			$args['class_submit'] = 'btn btn-secondary';
		}

		return $args;
	}
} // End of if function_exists( 'bootstrap_comment_form' ).

if ( ! function_exists( 'comment_form_comments_closed' ) ) {
	/**
	 * Displays a note that comments are closed if comments are closed and there are comments.
	 */
	function comment_form_comments_closed() {
		if ( get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'understrap' ); ?></p>
			<?php
		}
	}
} // End of if function_exists( 'comment_form_comments_closed' ).

// Custom Comments Callback
function custom_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract( $args, EXTR_SKIP );

    if ( 'div' == $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
?>

<!-- heads up: starting < for the html tag (li or div) in the next line: -->
<<?php echo esc_html( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID(); ?>">
<?php if ( 'div' != $args['style'] ) : ?>
<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
<?php endif; ?>
<div class="comment-author vcard">
<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
<?php printf( esc_html( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ) ?>
</div>
<?php if ( $comment->comment_approved == '0' ) : ?>
<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' ) ?></em>
<br />
<?php endif; ?>
<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
				printf( esc_html( '%1$s at %2$s' ), get_comment_date(), get_comment_time() ) ?></a><?php edit_comment_link( esc_html_e( '(Edit)' ), '  ', '' );
		?>
</div>

<?php comment_text() ?>

<div class="reply">
<?php comment_reply_link( array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
</div>
<?php if ( 'div' != $args['style'] ) : ?>
</div>
<?php endif; ?>
<?php }
