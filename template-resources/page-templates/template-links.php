<?php /* Template Name: Links */ ?>

<?php get_header(); ?>

<div class="row">
	<div class="span8">

		<h2>Links:</h2>
		<ul>
			<?php wp_list_bookmarks(); ?>
		</ul>

	</div>
	<div class="span4">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
