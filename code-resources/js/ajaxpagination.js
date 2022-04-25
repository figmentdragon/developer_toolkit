function readyFn (jQuery) {
	'use strict';

	/* --------
	apply ajax loading posts
	-------------------------------------------	*/
	jQuery(document).on('click', '.navigation_links.ajax_load_more a', function (e) {
		e.preventDefault();
		jQuery(this).html('Loading...');

		var ajax_nav_container = jQuery(this).parent();
		var ajaxcontainer = jQuery('.ajax_content_container');
		var posttype = ajax_nav_container.attr('data-posttype');
		var postsperpage = ajax_nav_container.attr('data-postsperpage');
		var loopfile = ajax_nav_container.attr('data-loopfile');
		var totalpages = (ajax_nav_container.attr('data-totalpages'));
		var count = parseInt(ajax_nav_container.attr('data-cycle'));
		var pageid = ajax_nav_container.attr('data-pageid');

		if ((count) <= totalpages) {
			count++;
			ajax_nav_container.attr('data-cycle', count);
			loadArticle(count, posttype, postsperpage, loopfile, ajaxcontainer, pageid);

			if (count === totalpages) {
				ajax_nav_container.hide();
			} else {
				var nextLink = jQuery(this).attr('href');
				var nextpage = count + 1;
				if (nextLink.indexOf('paged') >= 0) {
					nextLink = nextLink.replace(/paged[=].[0-9]?/, 'paged=' + nextpage);
				} else if (nextLink.indexOf('/page/') >= 0) {
					nextLink = nextLink.replace(/page\/.[0-9]?/, 'page/' + nextpage);
				}
				jQuery(this).attr('href', nextLink);
			}
		} else {
			return false;
		}
		jQuery(this).html('Load More');
	});

	function loadArticle (pagenumber, posttype, postsperpage, loopfile, ajaxcontainer, pageid) {
		ajaxcontainer.addClass('animated');

		var query_vars = writing_core_vars.query_vars;

		jQuery.ajax({
			url: writing_core_vars.ajax_load,
			type: 'POST',
			data: 'action=loadposts&page_no=' + pagenumber + '&loop_file=' + loopfile + '&posts_per_page=' + postsperpage + '&post_type=' + posttype + '&query_vars=' + query_vars + '&pageid=' + pageid,
			success: function (html) {
				var content = '<div class="fadeInDown">' + html + '</div>';
				var $blogisotope = jQuery('.blog_posts_wrapper.masonry_blog_style').imagesLoaded(function () {
					$blogisotope.isotope({
						// options
						itemSelector: '.blog_post_container',
						transformsEnabled: false,
						isOriginLeft: jQuery('body.rtl').length !== true
					});
				});

				if (jQuery('.banner_grid_blog_style').length) {
					jQuery('.banner_grid_blog_style').append(html);
				} else if (jQuery('.banner_list_blog_style').length) {
					jQuery('.banner_list_blog_style').append(html);
				} else {
					jQuery('.ajax_content_container').append(content);
				}
				var $pagedgridblogisotope = jQuery('.blog_posts_wrapper.banner_grid_blog_style').imagesLoaded(function () {
					jQuery('.video_fit_container').not('.filterable_grid .video_fit_container, .masonry_blog_style .video_fit_container').fitVids();
					$pagedgridblogisotope.isotope({
						// options
						itemSelector: '.blog_post_container',
						layoutMode: 'packery',
						transformsEnabled: false,
						originLeft: jQuery('body.rtl').length !== true
					});
				});
				$pagedgridblogisotope = jQuery('.blog_posts_wrapper.banner_grid_blog_style').isotope('reloadItems');
				var slider = jQuery('.grid_slider');
				if (typeof slider !== 'undefined') {
					slider.imagesLoaded(function () {
						if (jQuery('body.rtl').length) {
							jQuery('.grid_slider').not('.grid_slider.slick-initialized').slick({
								slide: '.grid_slide.item',
								adaptiveHeight: true,
								arrow: true
							});
						} else {
							jQuery('.grid_slider').not('.grid_slider.slick-initialized').slick({
								slide: '.grid_slide.item',
								adaptiveHeight: true,
								arrow: true
							});
						};
					});
				}
				$blogisotope = jQuery('.blog_posts_wrapper.masonry_blog_style').imagesLoaded(function () {
					$blogisotope.isotope({
					// options
						itemSelector: '.blog_post_container',
						transformsEnabled: false,
						isOriginLeft: jQuery('body.rtl').length !== true
					});
				});

				$blogisotope = jQuery('.blog_posts_wrapper.masonry_blog_style').isotope('reloadItems');
				jQuery('.blog_post_control_item .share_item.share_sign').not('.blog_single .blog_post_control_item .share_item.share_sign').on('touchstart mouseenter', function () {
					jQuery(this).parent().find('.social_share_item_wrapper').addClass('animating');
				});
				jQuery('.blog_post_control_item.blog_post_share').not('.blog_single .blog_post_control_item.blog_post_share').on('mouseleave', function () {
					jQuery(this).find('.social_share_item_wrapper').removeClass('animating');
				});
			}
		});
	};
}
jQuery(document).ready(readyFn);
