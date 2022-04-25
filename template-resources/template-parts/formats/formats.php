<?php

function creativity_format_scripts() {

	/* --------
	add theme styles
	------------------------------------------- */
	wp_register_style( 'formatstyle', get_template_directory_uri() . '/inc/formats/formatstyle.css', array(), '2' );

	/* --------
	include format scripts
	------------------------------------------- */
	wp_register_script( 'creativity-formatscript', get_template_directory_uri() . '/inc/formats/formatscript.js', array( 'jquery' ), '2', true );

	/* --------
	add sortable library for gallery
	------------------------------------------- */
	global $pagenow;
	if (in_array($pagenow, array('post.php', 'post-new.php'))) {
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('creativity-formatscript');
		wp_enqueue_style('formatstyle');
	}

	$post_formats = get_theme_support('post-formats');
	if (in_array('gallery', $post_formats[0])) {
		add_action('save_post', 'creativity_format_gallery_save_post');
	}
	if (in_array('video', $post_formats[0])) {
		add_action('save_post', 'creativity_format_video_save_post');
	}
	if (in_array('audio', $post_formats[0])) {
		add_action('save_post', 'creativity_format_audio_save_post');
	}

}
add_action( 'admin_init', 'creativity_format_scripts' );

function creativity_format_gallery_save_post( $post_id ) {
	if (!defined('XMLRPC_REQUEST')) {
		$keys = array(
			'_format_gallery_shortcode',
			'_format_gallery_type'
		);
		foreach ($keys as $key) {
			if (isset($_POST[$key])) {
				update_post_meta($post_id, $key, $_POST[$key]);
			}
		}
	}
}
function creativity_format_video_save_post($post_id) {
	if (!defined('XMLRPC_REQUEST') && isset($_POST['_format_video_embed'])) {
		update_post_meta($post_id, '_format_video_embed', $_POST['_format_video_embed']);
	}
}
// action added in creativity_admin_init()

function creativity_format_audio_save_post($post_id) {
	if (!defined('XMLRPC_REQUEST') && isset($_POST['_format_audio_embed'])) {
		update_post_meta($post_id, '_format_audio_embed', $_POST['_format_audio_embed']);
	}
}

add_action('save_post', 'save_creativity_formats');

function save_creativity_formats() {
    global $post;

    if ( isset($post) ) : // check if post is exists

    /* Verify the nonce before proceeding. */
     if ( !isset( $_POST['page_blog_template_options'] ) || !wp_verify_nonce( $_POST['page_blog_template_options'], basename( __FILE__ ) ) )
         return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

    $custom_meta_fields = array(
        '',
    );

    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }

    endif; // end if check if post is exists
}

function creativity_formats_meta_boxes() {
    $global_types = array('post','page', 'project', 'product');
    $types = array('post', 'page');

    // add meta box for commons options in posts and pages
		foreach ($global_types as $type) {
			add_meta_box("creativity_format_meta_boxes", __('Creativity Featured Thumbnail', 'writing'), "creativity_format_meta_boxes", 'post', "side", "low");
		}
}

function creativity_format_meta_boxes() {
	$post_formats = get_theme_support('post-formats');
	if (!empty($post_formats[0]) && is_array($post_formats[0])) {
		global $post;
		$current_post_format = get_post_format(get_the_id());

		// support the possibility of people having hacked in custom
		// post-formats or that this theme doesn't natively support
		// the post-format in the current post - a tab will be added
		// for this format but the default WP post UI will be shown ~sp
		if (!empty($current_post_format) && !in_array($current_post_format, $post_formats[0])) {
			array_push($post_formats[0], get_post_format_string($current_post_format));
		}
		array_unshift($post_formats[0], 'standard');
		$post_formats = $post_formats[0];

		$formats = array(
			'link',
			'quote',
			'video',
			'gallery',
			'audio',
			'status',
		);

		foreach ($formats as $format) {
			if (in_array($format, $post_formats)) {
				get_template_part( '/inc/formats/boxes/format', $format );
			}
		}
	}
}

function creativity_post_gallery_type() {
	$post = get_post();
	$value = get_post_meta(get_the_id(), '_format_gallery_type', true);
	switch ($value) {
		case 'shortcode':
		case 'attached-images':
			$value = $value;
		break;
		default:
			$value = 'shortcode';
	}
	return $value;
}

function creativity_post_has_gallery($post_id = null) {
	if (empty($post_id)) {
		$post = get_post();
		$post_id = get_the_id();
	}
	if (creativity_post_gallery_type() == 'shortcode') {
		$shortcode = get_post_meta($post_id, '_format_gallery_shortcode', true);
		return (bool) !empty($shortcode);
	}
	else {
		$images = new WP_Query(array(
			'post_parent' => $post_id,
			'post_type' => 'attachment',
			'post_status' => 'inherit',
			'posts_per_page' => 1, // -1 to show all
			'post_mime_type' => 'image%',
			'orderby' => 'menu_order',
			'order' => 'ASC'
		));
		return (bool) $images->post_count;
	}
}

function creativity_gallery_menu_order() {
	if (!empty($_POST['order']) && is_array($_POST['order'])) {
		$i = 0;
		foreach ($_POST['order'] as $post_id) {
			$post_id = intval($post_id);
			if ($post_id) {
				wp_update_post(array(
					'ID' => $post_id,
					'menu_order' => $i
				));
				++$i;
			}
		}
		header('Content-type: text/javascript');
		echo json_encode(array(
			'result' => 'success'
		));
		die();
	}
}
add_action('wp_ajax_creativity_gallery_menu_order', 'creativity_gallery_menu_order');
