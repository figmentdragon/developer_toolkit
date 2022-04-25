<?php 
global $themify;
?>

<?php themify_post_before(); // hook ?>
<article id="post-<?php the_id(); ?>" <?php post_class("post tf_clearfix " . $themify->get_categories_as_classes(get_the_id())); ?>>
	<?php themify_post_start(); // hook ?>

	<?php themify_post_media(); ?>

	<div class="post-content">

		<?php if($themify->hide_date != 'yes'): ?>
			<time datetime="<?php the_time('o-m-d') ?>" class="post-date entry-date updated"><?php echo get_the_date( apply_filters( 'themify_loop_date', '' ) ) ?></time>

		<?php endif; //post date ?>

		<?php if($themify->hide_title != 'yes'): ?>
			<?php themify_post_title(); ?>
		<?php endif; //post title ?>

		<?php if($themify->hide_meta != 'yes'): ?>
			<p class="post-meta entry-meta">
				<span class="post-author"><?php echo themify_get_author_link() ?></span>
				<span class="post-category"><?php the_category(', ') ?></span>
				<?php the_tags(' <span class="post-tag">', ', ', '</span>'); ?>
				<?php themify_comments_popup_link(array('zero'=>__( '0 Comments', 'themify' ),'one'=>__( '1 Comment', 'themify' ),'more'=>__( '% Comments', 'themify' ))); ?>
			</p>
		<?php endif; //post meta ?>

		<?php themify_post_content();?>

	</div>
	<!-- /.post-content -->
	<?php themify_post_end(); // hook ?>

</article>
<!-- /.post -->
<?php themify_post_after(); // hook ?>
