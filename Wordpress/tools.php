<?php
# -----------------------------------------------------------------
# Page and Template Checks
# -----------------------------------------------------------------

function get_pages_with_template ( $template ) {
	// returns array of pages with a given template

	// look for pages that use the given template
	$seekpages = get_posts (array (
				'post_type' => 'page',
				'meta_key' => '_wp_page_template',
				'meta_value' => $template,
				'posts_per_page' => -1
	));

	// holder for results
	$tpages = array(0 => 'Select Page');


	// Walk those results, store ID of pages found
	foreach ( $seekpages as $p ) {
		$tpages[$p->ID] = $p->post_title;
	}

	return $tpages;
}

function get_write_page() {

	// return slud for page set in theme options for writing page (newer versions of )
	if ( page_with_template_exists( 'write_page' ) )  {
		return ( template_op( 'post_name', get_post( ( 'write_page' ) ) ) );
	} else {
		// older versions of  use the slug
		return ('write');
	}
}

function redirect_url() {
	// where to send visitors after login ok
	return ( home_url('/') . get_write_page() );
}

# -----------------------------------------------------------------
# Media
# -----------------------------------------------------------------

// for uploading images
function insert_attachment( $file_handler, $post_id ) {

	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) return (false);

	require_once( ABSPATH . "wp-admin" . '/inc/image.php' );
	require_once( ABSPATH . "wp-admin" . '/inc/file.php' );
	require_once( ABSPATH . "wp-admin" . '/inc/media.php' );

	$attach_id = media_handle_upload( $file_handler, $post_id );

	return ($attach_id);

}


# -----------------------------------------------------------------
# Override the Radcliffe Comment Function
# -----------------------------------------------------------------


if ( ! function_exists( 'comment' ) ) {

	function comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

			<?php __( 'Pingback:', 'radcliffe' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'radcliffe' ), '<span class="edit-link">', '</span>' ); ?>

		</li>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

			<div id="comment-<?php comment_ID(); ?>" class="comment">

				<?php
				echo get_avatar( $comment, 150 );
        ?>

				<div class="comment-inner">

					<div class="comment-header">

						<cite><?php echo get_comment_author_link(); ?></cite>

						<span><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo get_comment_date() . ' &mdash; ' . get_comment_time(); ?></a></span>

					</div>

					<div class="comment-content">

						<?php if ( '0' == $comment->comment_approved ) : ?>

							<p class="comment-awaiting-moderation"><?php __( 'Your comment is awaiting moderation.', 'radcliffe' ); ?></p>

						<?php endif; ?>

						<?php comment_text(); ?>

					</div><!-- .comment-content -->

					<div class="comment-actions">

						<?php edit_comment_link( __( 'Edit', 'radcliffe' ), '', '' ); ?>

						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'radcliffe' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

					</div><!-- .comment-actions -->

				</div><!-- .comment-inner -->

			</div><!-- .comment-## -->

		<?php
			break;
		endswitch;
	}

}


# -----------------------------------------------------------------
# Grab bag
# -----------------------------------------------------------------

function word_count( $content ) {
   return str_word_count( strip_tags( $content ) );
}

function preview_notice() {
	return ('<div class="notify"><span class="symbol icon-info"></span>
This is a preview of your entry that shows how it will look when published. <a href="#" onclick="self.close();return false;">Close this window/tab</a> when done to return to the writing form. Make any changes and click "Update and Save Draft" again or if it is ready, click "Publish Now".
				</div>');
}


/**
 * Recursively sort an array of taxonomy terms hierarchically. Child categories will be
 * placed under a 'children' member of their parent term.
 * @param Array   $cats     taxonomy term objects to sort
 * @param Array   $into     result array to put them in
 * @param integer $parentId the current parent ID to put them in
   h/t http://wordpress.stackexchange.com/a/99516/14945
 */
function sort_terms_hierarchicaly( Array &$cats, Array &$into, $parentId = 0 )
{
    foreach ($cats as $i => $cat) {
        if ($cat->parent == $parentId) {
            $into[$cat->term_id] = $cat;
            unset($cats[$i]);
        }
    }

    foreach ($into as $topCat) {
        $topCat->children = array();
        sort_terms_hierarchicaly($cats, $topCat->children, $topCat->term_id);
    }
}


# -----------------------------------------------------------------
# Email
# -----------------------------------------------------------------

function allowed_email_domain( $email ) {
	// checks if an email address is within a list of allowed domains

	// allow for empty entries
	if ( empty($email) ) return true;

	// extract domain h/t https://www.fraudlabspro.com/resources/tutorials/how-to-extract-domain-name-from-email-address/
	$domain = substr($email, strpos($email, '@') + 1);

	$allowables = explode(",", option('email_domains'));

	foreach ( $allowables as $item) {
		if ( $domain == trim($item)) return true;
	}

	return false;
}

# -----------------------------------------------------------------
# API
# -----------------------------------------------------------------


// -----  expose post meta date to API

function create_api_posts_meta_field() {

	register_rest_field( 'post', 'meta', array(
								 'get_callback' => 'get_meta_for_api',
 								 'schema' => null,)
 	);
}

function get_meta_for_api( $object ) {
	//get the id of the post object array
	$post_id = $object['id'];

	// meta data fields we wish to make available
	$meta_fields = ['author' => 'wAuthor', 'license' => 'wLicense', 'footer' => 'wFooter'];

	// array to hold stuff
	$meta = [];

 	foreach ($meta_fields as $meta_key =>  $meta_value) {
	 	//return the post meta for each field
	 	$meta[$meta_key] =  get_post_meta( $post_id, $meta_value, true );
	 }

	 return ($meta);
}
?>
