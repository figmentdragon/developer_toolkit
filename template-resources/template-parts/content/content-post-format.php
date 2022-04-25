<?php
	// get sidebar position assigned for the page
	$sidebar_postition = creativity_option('creativity_sidebar_position');

	// set default blog style
	$blog_style = $creativity_setting_blog_style = 'default';

	// If post format layout is set to masonry, otherwise set to blog style set by user
	if (creativity_option('creativity_media_template_layout') == 'media_lib') {
		$creativity_blog_style = 'masonry';
	} elseif (creativity_option('creativity_blog_style')) {
		$creativity_blog_style = creativity_option('creativity_blog_style');
		$blog_style = $creativity_blog_style;
	}

	/* For Featured post layout, if first page,
	set post count $banner_featured_count to 0 to make first post featured,
	otherwise set post count $banner_featured_count to 1.
	*/
	if ($creativity_blog_style == 'banner_grid' || $creativity_blog_style == 'banner_list') {
			if ( $paged == 1) {
				$banner_featured_count = 0;
			} else {
				$banner_featured_count = 1;
			}
	}

	// set excerpt limit if not set by user
	if ( creativity_option('creativity_post_excerpt_limit') == '') {
		$excerpt_limit = 80;
		if ($creativity_blog_style == 'masonry' ) {
				$excerpt_limit = 30;
		}elseif ($creativity_blog_style == 'list') {
				$excerpt_limit = 36;
				if ( ($sidebar_postition != 'none') ) {
					$excerpt_limit = 25;
				}
		}
	}	else {
		// get excerpt limit set by user
		$excerpt_limit = creativity_option('creativity_post_excerpt_limit');
	} // end condition excerpt limit

	// set blog thumbnail size
	$blog_thumbnail_size = 'full_blog';
	if ($creativity_blog_style == 'masonry' ) {
		$blog_thumbnail_size = 'masonry_blog';
	}elseif ($creativity_blog_style == 'list') {
		$blog_thumbnail_size = 'list_blog';
	}

	// if image crop disabled at blog page other than list
	if (creativity_option('creativity_blog_image_crop') == 'no' && $blog_style != 'list') {
		$blog_thumbnail_size = '';
	}

	// Set article tag
	$article_tag = 'article';

	// Start loop
	while ( have_posts() ) : the_post();
		$postid = get_the_ID();
		// check If post format layout is set to media layout, showing thumbs only
		if (creativity_option('creativity_media_template_layout') == 'media_lib') { ?>
			<<?php echo esc_attr($article_tag); ?> id="post-<?php the_ID(); ?>" <?php post_class('blog_post_container'); ?> >

				<div class="blog_post clearfix">
					<?php
					creativity_blog_post_banner('masonry_blog');
					?>
				</div>

			</<?php echo esc_attr($article_tag); ?>><!-- #post-## -->
			<?php
			// otherwise, show post format in  default blog layout
		} else {
			// get posts count

			// Set Featured post grid layout variables based on posts count
			if ($creativity_blog_style == 'banner_grid') {

					// value 0 means first post, if true, set Featured post variables
					if ($banner_featured_count == 0) {

						// Set default  featured post excerpt limit if no excerpt limit set by user
						if ( creativity_option('creativity_post_excerpt_limit') == '') {
							$excerpt_limit = 80;
						}

						$blog_thumbnail_size = 'full_blog';
						$blog_style = 'banners';

						// Increase post count to skip first post
						$banner_featured_count++;
					} else {

						// Set default  featured post excerpt limit if no excerpt limit set by user
						if ( creativity_option('creativity_post_excerpt_limit') == '') {
							$excerpt_limit = 30;
						}

						$blog_thumbnail_size = 'masonry_blog';
						$blog_style = 'masonry';
					} // end condition $banner_featured_count

			} // end condition Featured post grid layout variables

			// Set Featured post list layout variables based on posts count
			if ($creativity_blog_style == 'banner_list') {

				// value 0 means first post, if true, set Featured post variables
				if ($banner_featured_count == 0) {

					// Set default featured post excerpt limit if no excerpt limit set by user
					if ( creativity_option('creativity_post_excerpt_limit') == '') {
						$excerpt_limit = 80;
					}

					$blog_thumbnail_size = 'full_blog';
					$blog_style = 'banners';

					// Increase post count to skip first post
					$banner_featured_count++;
				} else {

					// Set default featured post excerpt limit if no excerpt limit set by user
					if ( creativity_option('creativity_post_excerpt_limit') == '') {
						$excerpt_limit = 36;
					}

					$blog_thumbnail_size = 'list_blog';
					$blog_style = 'list';
				} // end condition $banner_featured_count

			} // end condition Featured post list layout variables
			?>
			<<?php echo esc_attr($article_tag); ?> id="post-<?php the_ID(); ?>" <?php post_class('blog_post_container'); ?> >

				<?php

				// Hidden shcema data (date, author) to avoid Google Webmaster errors, data that are hidden  from  users are shown to  bots
				if ((creativity_cross_option('creativity_show_meta', $postid) == 'no') ||
						(creativity_cross_option('creativity_show_author', $postid) == 'no') ||
						(creativity_cross_option('creativity_show_date', $postid) == 'no')
					 ) {
				?>
					<div class="creativity_hidden_schemas" style="display:none;">
						<?php

						// Date hidden data
						if (creativity_cross_option('creativity_show_date', $postid) == 'no' || creativity_cross_option('creativity_show_meta', $postid) == 'no') {

							$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

							if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
								$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
							}

							$time_string = sprintf( $time_string,
																			esc_attr( get_the_date( 'c' ) ),
																			get_the_date()
																		);

							printf( '<span class="blog_meta_item blog_meta_date"><span class="screen-reader-text"></span>%1$s</span>', $time_string );

						} // end date hidden data condition

						// Author hidden data
						if (creativity_cross_option('creativity_show_author', $postid) == 'no' || creativity_cross_option('creativity_show_meta', $postid) == 'no') {

							printf( '<span class="blog_meta_item blog_meta_author"><span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span></span>',
											esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
											get_the_author()
										);

						} // end author hidden data condition
						?>
					</div><!-- end creativity_hidden_schemas-->
				<?php
				} // end hidden schemas condition
				?>

				<?php // start post content ?>
				<div class="blog_post clearfix">

					<?php
					// Post Thumbnail before Title in masonry, list, banners in blog pages

						/* if blog style is masonry bring post thumbnail before post title */
						if ($blog_style == 'masonry' ) {
						creativity_blog_post_banner($blog_thumbnail_size);
						} else if ($blog_style == 'list' || $blog_style == 'banners') {
						?>
						<div class="posts_list_wrapper clearfix">
							<div class="post_thumbnail_wrapper">
							<?php
							if ($blog_style == "banners")  {
							creativity_blog_post_banner($blog_thumbnail_size);
							}else{
							creativity_post_thumbnail($blog_thumbnail_size);
							}
							?>
							</div><!-- end post_thumbnail_wrapper -->
							<div class="post_info_wrapper"> <!-- use this wrapper in list style only to group all info far from thumbnail wrapper -->
						<?php
						} // end blog post style for thumbnail
						?>



					<?php // Show Title on single page ?>
						<div class="blog_post_title">
							<?php
									the_title(
														 sprintf( '<h2 class="entry-title title post_title"><a href="%s" rel="bookmark">',
														 esc_url( get_permalink() ) ),
														 '</a></h2>'
													 );
							?>
						</div><!-- end blog_post_title -->
					<?php // end show title	?>


					<?php // Show post meta if not hidden
					if (creativity_cross_option('creativity_show_meta', $postid) != 'no'):
					?>
						<div class="blog_post_meta clearfix">
							<?php
							creativity_post_meta();
							edit_post_link( __( 'Edit', 'writing' ), '<span class="blog_meta_item edit_link">', '</span>' );
							?>
						</div><!-- end blog_post_meta -->
					<?php
					endif; // end post meta condition
					?>

					<?php
					/* if blog style is not masonry put post thumbnail after title and meta */
					if ($blog_style == 'default' ) {
						creativity_blog_post_banner($blog_thumbnail_size);
					}
					?>

					<?php // Show Post discription
					if (creativity_option('creativity_post_content_show', $postid) != 'no') {
						// set content variable
						$creativity_content = '';
						?>
						<div class="entry-content blog_post_text blog_post_description">
							<?php
							//  If post excerpt not set to disabled, default case
							if (creativity_option('creativity_post_excerpt', $postid) != "disabled"):
									// check if post has custom excerpt
									if (creativity_cross_option('creativity_custom_description', $postid) != '') {

										// Get post custom excerpt with formatting and applying shortcodes written
										$creativity_content = do_shortcode(wp_specialchars_decode(creativity_cross_option('creativity_custom_description', $postid)));

										// add continue reading button
										$creativity_content .= creativity_more_link('', '');
									} // post doesn't have custom excerpt, but format excerpt is enabled
									else if (creativity_option('creativity_post_with_formatting') == 'yes') {

										// excecute excerpt html code
										$creativity_content = creativity_excerpt_with_format($excerpt_limit);
									} // post doesn't have custom excerpt nor formating excerpt option creativity_post_with_formatting enabled
									else {

										// get default excerpt without formatting
										$creativity_content = '<p>'.creativity_excerpt($excerpt_limit).'</p>';
									}

							// If post excerpt disabled
							else:
									// get full post content with formatting if enabled
									if (creativity_option('creativity_post_with_formatting') == 'yes') {

										/* get content with formatting and add it to variable,
										** ob_start & other functions are used to avoid echoing content and
										** enable checking content for <!-- more --> tag */
										ob_start();
											the_content();
											$creativity_content = ob_get_contents();
										ob_end_clean();

										// check if content contains <!-- more --> tag
										if (strpos($creativity_content, '<!--more-->')) {

											// add continue reading button if full content at blog contains <!-- more -->
											$creativity_content .= creativity_more_link('' , '');
										}
									} // get full post content without formatting, Default case
									else {
										$creativity_content = '<p>'.get_the_content().'</p>';
									} // end checking content format setting
							endif; // end condition checking post excerpt creativity_post_excerpt setting

							echo $creativity_content;
							?>
						</div><!-- end entry-content blog_post_text blog_post_description -->
					<?php
					}
					?>

					<?php // check if blog style is not masonry, then check if readmore button or share enabled to start blog_post_control div
					if (($blog_style !== 'masonry') && (creativity_cross_option('creativity_cont_read_show', $postid) != 'no') || (creativity_cross_option('creativity_show_share', $postid) != 'no')) {
					?>
						<div class="blog_post_control clearfix">

							<?php // check if continue Reading button isn't disabled, default case is enabled
							if (creativity_option('creativity_cont_read_show', $postid) != 'no') {

								// check in case content existed it contains more link
								if (!isset($creativity_content) || (isset($creativity_content) && strpos($creativity_content, 'class="more_link more_link_dots"') != false)) { ?>

									<?php // get continue reading text
									$readmore_text = (creativity_option('creativity_cont_read_text', $postid)) ? __(creativity_option('creativity_cont_read_text', $postid), 'writing') : __('Continue Reading', 'writing') ; ?>
									<div class="blog_post_control_item blog_post_readmore">
										<?php echo sprintf( '<a href="%1$s" class="read_more_link">%2$s</a>', esc_url( get_permalink() ), $readmore_text ); ?>
									</div><!-- end .blog_post_readmore -->
								<?php
								} // end condition check in case content existed it contains more link
								?>
							<?php
							} // end condition if continue Reading button isn't disabled
							?>

							<?php // check if post share isn't disabled, default case is enabled
							if ((creativity_cross_option('creativity_show_share', $postid) != 'no')):
								creativity_post_share();
							endif; ?>
						</div><!-- end blog_post_control -->
					<?php
					} //check if readmore button or share enabled to start blog_post_control div
					?>

					<?php // if blog style is list or banners first
					if ( $blog_style == 'list' || $blog_style == 'banners' ) {
					?>
						</div> <!-- .post_info_wrapper close post_info_wrapper in cas of list style-->
						</div> <!-- .posts_list_wrapper -->
					<?php
					} // end condition blog style is list or banners first
					?>

				</div><!-- end blog_post -->
			</<?php echo esc_attr($article_tag); ?>><!-- #post-## -->
		<?php } // end condition post format layout
	endwhile;
?>