<?php
/**
 * The template for displaying post meta (post date, post author and post comments)
 *
 * @package TheCreativityArchitect
 */

?>
<?php if ( 'post' === get_post_type() ) : ?>
<div class="post-meta mt-3 pt-5">
	<div class="row">
		<div class="col-12 col-sm-6">
			<div class="row">
				<div class="col-12 col-sm-4">
					<div class="post-author">
						<span class="post-author-title d-block text-white-50 text-uppercase"><?php esc_html_e( 'Author', 'TheCreativityArchitect' ); ?>:</span>
						<?php // translators: %s containing the name of the author. ?>
						<span class="post-author-item"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'TheCreativityArchitect' ), get_the_author() ); ?>" class="text-white text-decoration-underline"><?php echo get_the_author(); ?></a></span>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<div class="post-date">
						<span class="post-date-title d-block text-white-50 text-uppercase"><?php esc_html_e( 'Published on', 'TheCreativityArchitect' ); ?>:</span>
						<span class="post-date-item text-white"><?php echo esc_html( the_time( get_option( 'date_format' ) ) ); ?></span>
					</div>
				</div>
			<?php if ( post_password_required() !== true ) : ?>
				<div class="col-12 col-sm-4">
					<div class="post-comments">
						<span class="post-comments-title d-block text-white-50 text-uppercase"><?php esc_html_e( 'Comments', 'TheCreativityArchitect' ); ?>:</span>
						<span class="post-comments-item text-white"><?php comments_number( __( '0 Comments', 'TheCreativityArchitect' ), __( '1 Comment', 'TheCreativityArchitect' ), __( '% Comments', 'TheCreativityArchitect' ) ); ?></span>
					</div>
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
