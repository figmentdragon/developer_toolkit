<?php
	/** Woocommerce Hooks **/
	remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper');
	add_action('woocommerce_before_main_content', 'creativity_output_content_wrapper_start', 10);
	remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end');
	add_action('woocommerce_after_main_content', 'creativity_output_content_wrapper_end', 10);

	function creativity_output_content_wrapper_start() {
		echo '<div class="container clearfix">';
        echo '<div id="primary" class="content-area twentysixteen"><main id="main" class="site-main" role="main">';
	}

	function creativity_output_content_wrapper_end() {
		echo '</div>';
        get_sidebar('right');
        echo '</div>';
	}