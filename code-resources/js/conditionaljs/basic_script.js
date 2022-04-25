/* eslint-disable */
/* --------
double click handle on touch devices doubleTapToGo
------------------------------------------- */
;(function (e,t,n,r) {e.fn.doubleTapToGo=function (r) {if(!("ontouchstart"in t)&&!navigator.msMaxTouchPoints&&!navigator.userAgent.toLowerCase().match(/windows phone os 7/i))return false;this.each(function () {var t=false;e(this).on("click",function (n) {var r=e(this);if(r[0]!=t[0]) {n.preventDefault();t=r}});e(n).on("click touchstart MSPointerDown",function (n) {var r=true,i=e(n.target).parents();for(var s=0;s<i.length;s++)if(i[s]==t[0])r=false;if(r)t=false})});return this}})(jQuery,window,document);
/* eslint-enable */
function readyFn () {
	'use strict';
	/* --------
	add wrapper to select boxes
	------------------------------------------- */
	jQuery('select').each(function () {
		// only wrap if they have no style
		var selectitem = jQuery(this);
		if (selectitem.css('display') !== 'none') {
			if (selectitem.parent().hasClass('widget_archive')) {
				selectitem.wrap('<div class="creativity_select_container"></div>');
			} else {
				selectitem.parent().addClass('creativity_select_container');
			}
		}
	});

	/* --------
	start dropdown menu
	------------------------------------------- */
	// dropdown on desktop screens
	if (jQuery(window).width() > 768) {
		jQuery(document).on('mouseenter', '.main_nav ul.navbar-nav > li, .main_nav ul.navbar-nav > li li', function () {
			var sub = jQuery(this).children('.dropdown-menu');
			if (sub.length > 0) {
				sub.stop().slideDown(200, 'easeOutCubic');
			}
		});
		jQuery(document).on('mouseleave', '.main_nav ul.navbar-nav > li, .main_nav ul.navbar-nav > li li', function () {
			var sub = jQuery(this).children('.dropdown-menu');
			if (sub.length > 0) {
				sub.stop().hide();
			}
		});
	}

	// dropdown on touch screens
	if (jQuery(window).width() > 768) {
		jQuery(document).on('tap', '.main_nav ul.navbar-nav > li, .main_nav ul.navbar-nav > li li', function (event) {
			var sub = jQuery(this).children('.dropdown-menu');
			if (typeof firstClick !== 'undefined' && firstClick === true) {
				if (sub.length > 0) {
					sub.stop().hide();
				}
			} else {
				if (sub.length > 0) {
					sub.stop().slideDown(200, 'easeOutCubic');
				}
				var firstClick = true;
			}
		});
	}

	// primary menu
	// Add class to parent items at mobile for primary menu
	jQuery('.main_menu .dropdown > a, .main_menu .dropdown-submenu > a').each(function () {
		if (jQuery(this).next().length > 0) {
			jQuery(this).addClass('mobile_menu_parent');
		};
	});
	// add arrows to parent items
	jQuery('<span class="mobile_dropdown_arrow"><i class="fa fa-angle-down"></i></span>').appendTo('.top_header_items_holder .main_menu li a.mobile_menu_parent');

	// mobile menu click or touch action, slide menu
	jQuery(document).on('touch click', '.top_menu_wrapper .mobile_menu_button', function (event) {
		event.stopImmediatePropagation();
		event.preventDefault();
		jQuery('.top_header_items_holder').toggleClass('mobile_menu_opened').stop().slideToggle();
	});

	// secondry menu
	// Add class to parent items at mobile for secondary menu
	jQuery('.secondary-menu .dropdown > a, .secondary-menu .dropdown-submenu > a').each(function () {
		if (jQuery(this).next().length > 0) {
			jQuery(this).addClass('mobile_menu_parent');
		};
	});
	// add arrows to parent items
	jQuery('<span class="mobile_dropdown_arrow"><i class="fa fa-angle-down"></i></span>').appendTo('.secondary-menu li a.mobile_menu_parent');
	// secondary mobile menu click action
	jQuery(document).on('touch click', '.secondary_mobile_menu', function (event) {
		event.stopImmediatePropagation();
		event.preventDefault();
		jQuery('.main_menu.secondary-menu').toggleClass('mobile_menu_opened').stop().slideToggle();
	});

	jQuery(window).on('ready resize', function () {
		if (jQuery('body').width() > 768) {
			jQuery('ul.navbar-nav li:has(ul)').doubleTapToGo();
		}
	});

	// opening dropdown menu actions
	jQuery(document).on('touch click', '.main_menu li a.mobile_menu_parent .mobile_dropdown_arrow', function (event) {
		event.stopImmediatePropagation();
		event.preventDefault();
		var arrow = jQuery(this).find('i');
		if (arrow.hasClass('fa-angle-down') !== false) {
			arrow.removeClass('fa-angle-down');
			arrow.addClass('fa-angle-up');
		} else if (arrow.hasClass('fa-angle-up') !== false) {
			arrow.removeClass('fa-angle-up');
			arrow.addClass('fa-angle-down');
		}
		jQuery(this).parent().next('ul.dropdown-menu').stop().slideToggle();
	});

	/* --------
	start effect delay plugin
	------------------------------------------- */
	jQuery.fn.effectDelay = function (name, start) {
		var delay = start;
		return this.each(function () {
			jQuery(this).delay(delay).queue(function (next) {
				jQuery(this).css('visibility', 'visible').addClass('animated ' + name);
				next();
			});
		});
	};

	/* --------
	start animate effect
	------------------------------------------- */
	jQuery('[data-animation]').not('.sorted_effect [data-animation]').appear(function () {
		var $animationName = jQuery(this).attr('data-animation');
		var $animationDelay = jQuery(this).attr('data-animation-delay');
		jQuery(this).effectDelay($animationName, $animationDelay);
	});

	/* --------
	start sorted animate effect
	------------------------------------------- */
	jQuery('.sorted_effect').appear(function () {
		var delay = 200;
		if (jQuery(this).attr('set-animation')) {
			var $set_animation = jQuery(this).attr('set-animation');
			jQuery(this).children().each(function () {
				var animationName = $set_animation;
				// jQuery(this).effectDelay(animationName, delay);
				// delay = delay + 420;
				if (typeof (jQuery(this).children('[data-animation]').attr('data-animation')) !== 'undefined') {
					animationName = jQuery(this).children('[data-animation]').attr('data-animation');
					jQuery(this).children('[data-animation]').effectDelay(animationName, delay);
				} else if (typeof (jQuery(this).attr('data-animation')) !== 'undefined') {
					animationName = jQuery(this).attr('data-animation');
					jQuery(this).effectDelay(animationName, delay);
				} else {
					jQuery(this).effectDelay(animationName, delay);
					delay = delay + 420;
				}
			});
		} else if (jQuery(this).find('[data-animation]')) {
			delay = 100;
			jQuery(this).find('[data-animation]').each(function () {
				var $animationName = jQuery(this).attr('data-animation');
				jQuery(this).effectDelay($animationName, delay);
				delay = delay + 420;
			});
		}
	});

	/* --------
	start header search
	------------------------------------------- */
	jQuery(document).on('touch click', '.header_search i', function (e) {
		if (jQuery('.header_search').hasClass('expanded_search') === false) {
			e.preventDefault();
			jQuery('.header_search').addClass('expanded_search');
			if (jQuery('.sticky_header').length) {
				jQuery('.sticky_header .header_search input[type="text"]').focus();
			} else {
				jQuery('.header_search input[type="text"]').focus();
			}
		} else {
			var search_field = jQuery('.header_search input[type="text"]');
			if (jQuery('.sticky_header').length) {
				search_field = jQuery('.sticky_header .header_search input[type="text"]');
			}

			if (search_field.val() === '') {
				e.preventDefault();
				jQuery('.expanded_search').removeClass('expanded_search');
			}
		}
	});

	/* --------
	start sliding side
	------------------------------------------- */
	// sliding icon click action, open/close sliding sidebar
	jQuery(document).on('touch click', '.header_logo_wrapper #user_info_icon', function (e) {
		e.preventDefault();

		jQuery('.site_side_container').toggleClass('opened');
		jQuery('html, body').toggleClass('side_container_opened');
		if (jQuery('body').width() < 992) {
			var offset = parseInt(jQuery('.sticky_logo').css('top'), 10);
			var top = offset + jQuery('.sticky_logo').height();
			jQuery('.sticky_logo_enabled .site_side_container.sticky_sidebar').css('top', top);
		}
	});

	// sliding icon click action on sticky menu, open/close sliding sidebar
	jQuery(document).on('touch click', '.top_menu_wrapper #user_info_icon', function (e) {
		e.preventDefault();
		jQuery('.site_side_container').toggleClass('opened');
		jQuery('html, body').toggleClass('side_container_opened');
	});

	// overlay click action, close sliding sidebar
	jQuery(document).on('touch click', '.sliding_close_helper_overlay', function (e) {
		e.preventDefault();
		jQuery('html.side_container_opened, body.side_container_opened').removeClass('side_container_opened');
		jQuery('.site_side_container.opened').removeClass('opened');
	});

	/* --------
	start share sign effect
	------------------------------------------- */
	jQuery(document).on('touch mouseenter', '.blog_post_control_item .share_item.share_sign', function () {
		jQuery(this).parent().find('.social_share_item_wrapper').addClass('animating');
	});
	jQuery(document).on('mouseleave', '.blog_post_control_item.blog_post_share', function () {
		jQuery(this).find('.social_share_item_wrapper').removeClass('animating');
	});

	/* --------
Accept cookies notice
------------------------------------------- */

if (jQuery(".writing_cookies_notice_jquery_container").length) {
	jQuery.ajax({
		url: writing_vars.ajax_accept_cookies,
		data: "cookiesnoticestatus=shownotice",
		type: 'POST',
		success: function (html) {
			jQuery(".writing_cookies_notice_jquery_container").html(html);
		}
	});
}

jQuery(document).on('click', '.writing_cookie_accept_area .cookies_accept_button', function (e) {
	jQuery(".writing_cookies_notice_wrapper").fadeOut(function () {
		jQuery(this).remove();
	});

	jQuery.ajax({
		url: writing_vars.ajax_accept_cookies,
		data: "cookiesnoticestatus=accepted",
		type: 'POST'
	});
});

	if (jQuery('.page_main_title.page-header').length) {
		if (jQuery('.page_main_title.page-header').height() > 50) {
			jQuery('.page_main_title.page-header').css('border-radius', '25px');
		}
	}

	// Add class to quotes with long text
	if (jQuery('blockquote').length > 0) {
		jQuery('blockquote').each( function() {
			var blockquote = jQuery(this);
		if (jQuery(this).text().trim().length  > 100) {
			blockquote.addClass('long_quote_text');
		}
		});

	}
}
if (jQuery('body').hasClass('scripts_async_load')) {
	jQuery(window).load(readyFn);
} else {
	jQuery(document).ready(readyFn);
}
