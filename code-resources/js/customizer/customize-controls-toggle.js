(function (api) {
	'use strict';

	api.bind('ready', function () {
		// Create list of callbacks, each callback contains array [callback id, dependent id(s), callback value]
		// if callback id has callback value show dependent id, otherwise hide it
		var single_var_callbacks = [
			['creativity_enable_header_color', 'creativity_header_color'],
			['creativity_enable_header_text_color', 'creativity_header_text_color'],
			['creativity_enable_header_hover_color', 'creativity_header_hover_color'],
			['creativity_enable_top_menu_color', 'creativity_top_menu_color'],
			['creativity_enable_top_menu_text_color', 'creativity_top_menu_text_color'],
			['creativity_enable_top_menu_hover_color', 'creativity_top_menu_hover_color'],
			['creativity_enable_body_background_color', 'creativity_body_background_color'],
			['creativity_enable_post_background_color', 'creativity_post_background_color'],
			['creativity_enable_main_text_color', 'creativity_main_text_color'],
			['creativity_enable_text_hover_color', 'creativity_text_hover_color'],
			['creativity_enable_custom_css', 'creativity_custom_css_code'],
			['creativity_enable_custom_js', 'creativity_custom_js_code'],
			['creativity_fb_id', 'creativity_facebook_app_id'],
			['creativity_sticky_menu', 'creativity_sticky_logo'],
			['creativity_load_system_fonts', 'creativity_load_fonts_locally', false],
			['creativity_header_background', 'creativity_header_background_style'],
			['creativity_logo_type', ['creativity_logo_image_t_margin', 'creativity_logo_text_t_margin'], 'image_text'],
			['creativity_enable_sliding_sidebar', 'creativity_header_avatar', 'yes'],
			['creativity_logo_position', 'creativity_center_logo', 'header'],
			['creativity_logo_position', 'creativity_sticky_logo', 'header'],
			['creativity_enable_custom_single_image_size', ['creativity_custom_image_size_width', 'creativity_custom_image_size_height']],
			['creativity_post_excerpt', ['creativity_post_excerpt_limit', 'creativity_post_excerpt_text'], 'enabled'],
			['creativity_cont_read_show', 'creativity_cont_read_text', 'yes'],
			['creativity_enable_facebook_comments', ['creativity_facebook_comments_html5', 'creativity_facebook_comments_width', 'creativity_facebook_comments_num']],
			['creativity_show_tagline', ['creativity_tagline_font_type', 'creativity_tagline_font_size', 'creativity_tagline_line_height'], ['beside', 'below']]
		];

		// Show and hide controls with 2 options only
		single_var_callbacks.forEach(function (item, index) {
			api(item[0], function (setting) {
				var linkSettingValueToControlActiveState;

				/**
				* Update a control's active state according to the boxed_body setting's value.
				*
				* @param {api.Control} control Boxed body control.
				*/
				linkSettingValueToControlActiveState = function (control) {
					var visibility = function () {
						var check = item[2];
						var value = api.value(item[0])();
						var activate = false;
						if (typeof check !== 'undefined') {
							if (Array.isArray(check)) {
								if (check.indexOf(value) !== -1) {
									activate = true;
								} else {
									activate = false;
								}
							} else {
								if (check === value) {
									activate = true;
								} else {
									activate = false;
								}
							}
						} else {
							activate = value;
						}

						if (activate) {
							control.container.slideDown(180);
						} else {
							control.container.slideUp(180);
						}
					};
					// Set initial active state.
					visibility();
					// Update activate state whenever the setting is changed.
					setting.bind(visibility);
				};

				// Call linkSettingValueToControlActiveState on each dependent id if is array
				if (Array.isArray(item[1])) {
					item[1].forEach(function (setting, index) {
						api.control(setting, linkSettingValueToControlActiveState);
					});
				} else {
					api.control(item[1], linkSettingValueToControlActiveState);
				}
			});
		});

		// show control when edit button selected
		jQuery('.creativity-custom-refresh-partial').on('click', function (event) {
			event.stopImmediatePropagation();
			event.preventDefault();
			var data = [jQuery(this).attr('data-control'), jQuery(this).attr('data-focus')];
			// identify type to show
			if (data[1] === 'panel') {
				api.panel(data[0]).focus();
			} else if (data[1] === 'section') {
				api.section(data[0]).focus();
			} else {
				api.control(data[0]).focus();
			}
		});
		api.previewer.bind('preview-edit', function (data) {
			// identify type to show
			if (data[1] === 'panel') {
				api.panel(data[0]).focus();
			} else if (data[1] === 'section') {
				api.section(data[0]).focus();
			} else {
				api.control(data[0]).focus();
			}
		});

		jQuery.fn.shake = function (settings) {
			if (typeof settings.interval === 'undefined') {
				settings.interval = 100;
			}

			if (typeof settings.distance === 'undefined') {
				settings.distance = 10;
			}

			if (typeof settings.times === 'undefined') {
				settings.times = 4;
			}

			if (typeof settings.complete === 'undefined') {
				settings.complete = function () {};
			}

			jQuery(this).css('position', 'relative');

			for (var iter = 0; iter < (settings.times + 1); iter++) {
				jQuery(this).animate({ left: ((iter % 2 === 0 ? settings.distance : settings.distance * -1)) }, settings.interval);
			}

			jQuery(this).animate({ left: 0 }, settings.interval, settings.complete);
		};
		jQuery('.focus_shake').on('focus', function () {
			jQuery(this).parent().shake({
				interval: 100,
				distance: 5,
				times: 5
			});
		});
	});
}(wp.customize));
