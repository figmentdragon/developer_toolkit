<form class="search clearfix animated searchHelperFade" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<input class="col-md-12 search_text" id="appendedInputButton" placeholder="<?php _e( 'Hit enter to search', 'writing' ); ?>" type="text" name="s">
	<input type="hidden" name="post_type" value="post" />
	<i class="fa fa-search"><input type="submit" class="search_submit" id="searchsubmit" value="" /></i>
</form>
