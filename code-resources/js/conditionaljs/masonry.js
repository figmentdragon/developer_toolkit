/* --------
start isotope after imagesloaded
------------------------------------------- */
var $originLeft = true;
if (jQuery('body').hasClass('rtl')) { $originLeft = false; }

var $blogisotope = jQuery('.blog_posts_wrapper.masonry_blog_style:not(.no_masonry_effect), body.paged .blog_posts_wrapper.banner_grid_blog_style:not(.no_masonry_effect)').isotope({
	// options
	itemSelector: '.blog_post_container',
	layoutMode: 'packery',
	transformsEnabled: true,
	originLeft:	$originLeft
});
document.addEventListener('lazybeforeunveil', function () {
	$blogisotope.imagesLoaded(function () {
		$blogisotope.isotope('layout');
	});
});
if (!jQuery('body').hasClass('paged') && jQuery('.blog_posts_wrapper.banner_grid_blog_style').length !== 'undefined') {
	var $gridblogisotope = jQuery('.blog_posts_wrapper.banner_grid_blog_style:not(.no_masonry_effect)').imagesLoaded(function () {
		var column = jQuery('.blog_posts_wrapper.banner_grid_blog_style').width();
		if (jQuery('body').width() > 900 && jQuery('.main_content').hasClass('col-md-12')) {
			column = jQuery('.blog_posts_wrapper.banner_grid_blog_style').width() / 3;
		} else if ((jQuery('body').width() <= 900 && jQuery('body').width() > 490) || (jQuery('body').width() > 900 && jQuery('.main_content').hasClass('col-md-9'))) {
			column = jQuery('.blog_posts_wrapper.banner_grid_blog_style').width() / 2;
		}

		$gridblogisotope.isotope({
			// options
			itemSelector: '.blog_post_container',
			layoutMode: 'packery',
			masonry: {
				columnWidth: column
			},
			transformsEnabled: false,
			originLeft:	$originLeft
		});
	});
}

jQuery(window).on('resize load', function () {
	if (typeof $gridblogisotope !== 'undefined') {
		$gridblogisotope.isotope('layout');
	}
	if (typeof $blogisotope !== 'undefined') {
		$blogisotope.isotope('layout');
	}
});
