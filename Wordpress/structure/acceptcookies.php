<?php

$cookies_text = themename_option('themename_cookies_description_text') ? themename_option('themename_cookies_description_text') : __('This site uses cookies for the purpose of remembering you and to understand how you use the site, so we can make it better.', 'themename');
$cookies_link_text = themename_option('themename_cookies_links_text') ? themename_option('themename_cookies_links_text') : __('<span class="cookies_accept_links">Please read our <a href = "#">Cookies </a> &amp; <a href="#">Privacy</a> policies</span>', 'themename');

if (isset($_POST['cookiesnoticestatus']) && $_POST['cookiesnoticestatus'] == "accepted") {
	if (is_user_logged_in()) {
		update_user_meta(get_current_user_id(), 'themename_cookies_accepted', 1);
	}else{
		setcookie('themename_cookies_accepted', 1, time() + ( 365 * 24 * 60 * 60) );
	}
} elseif (isset($_POST['cookiesnoticestatus']) && $_POST['cookiesnoticestatus'] == "shownotice" && !themename_cookies_accepted() && themename_option('themename_show_cookies_notice') && $cookies_text != '') {

		?>
		<div class="themename_cookies_notice_wrapper">
			<div class="themename_cookies_notice">
				<?php if (themename_option('themename_show_cookies_icon') !== 0 ): ?>
					<?php
						if (themename_option('themename_cookies_icon_class')) {
							$cookies_icon_class = '<i class="cookies_bar_icon '.themename_option('themename_cookies_icon_class').'"></i>';
						}else{
							$cookies_icon_class = '<i class="cookies_bar_icon fa fa-check-square"></i>';
						}
					?>
					<div class="cookies_icons"><?php echo $cookies_icon_class; ?></div>
				<?php endif; ?>

				<?php if (themename_option('themename_cookies_title') != ''): ?>
					<h3 class="title themename_cookies_title"><?php echo themename_option('themename_cookies_title'); ?></h3>
				<?php endif; ?>

				<p class="themename_cookis_description"><?php echo $cookies_text; ?></p>
				<div class="themename_cookie_accept_area">

					<?php if ($cookies_link_text != ''): ?>
						<span class="cookies_accept_links"><?php echo do_shortcode(wp_specialchars_decode($cookies_link_text)); ?></span>
					<?php endif; ?>

					<span class="cookies_accept_button"><?php esc_attr_e('I Agree', 'themename'); ?></span>
				</div>
			</div>
		</div>
		<?php
}
?>
