<?php /* TEMPLATE NAME: Search Form */ ?>

<form class="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label class="sr-only" for="s"><?php esc_html_e( 'Search', 'the_creativity_architect' ); ?></label>

	<div role="search">

		<input class="search-input" type="search" name="s" aria-label="Search site for:" placeholder="<?php esc_html_e( 'To search, type and hit enter.', 'THEMENAME' ); ?>">

		<button class="search-submit" type="submit"><?php esc_html_e( 'Search', 'THEMENAME' ); ?></button>
	</div>

	<div class="input-group">

		<input class="field form-control" id="s" name="s" type="text"
			placeholder="<?php esc_attr_e( 'Search &hellip;', 'the_creativity_architect' ); ?>" value="<?php the_search_query(); ?>">

			<span class="input-group-append">

				<input class="submit btn btn-primary" id="searchsubmit" name="submit" type="submit" value="<?php esc_attr_e( 'Search', 'the_creativity_architect' ); ?>">
			</span>
		</div>
	</form>
