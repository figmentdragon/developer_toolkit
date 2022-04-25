<?php $gallery_type = creativity_post_gallery_type(); ?>

<div id="creativity_box_for_post-format-gallery" class="creativity_format_field creativity_format_field_gallery" >

	<label><span><?php _e('Gallery Images', 'writing'); ?></span></label>

	<div class="cf-elm-container cfpf-gallery-options">
		<p class="creativity_gallrey_shortcode_field">
			<input type="radio" name="_format_gallery_type" value="shortcode" <?php checked($gallery_type, 'shortcode' ); ?> id="cfpf-format-gallery-type-shortcode"  />
			<label for="cfpf-format-gallery-type-shortcode"><?php _e('Shortcode', 'writing'); ?></label>
			<input type="text" name="_format_gallery_shortcode" value="<?php echo esc_attr(get_post_meta(get_the_id(), '_format_gallery_shortcode', true)); ?>" id="cfpf-format-gallery-shortcode" />
		</p>

		<p style="display: none; visibility: hidden;">
			<input type="radio" name="_format_gallery_type" value="attached-images" <?php checked($gallery_type, 'attached-images' ); ?> id="cfpf-format-gallery-type-attached" />
			<label for="cfpf-format-gallery-type-attached"><?php _e('Images uploaded to this post', 'writing'); ?></label>
		</p>

		<div class="srp-gallery clearfix">

		<?php // running this in the view so it can be used by multiple functions

		if( creativity_post_has_gallery(get_the_id()) ){
			$att_ids = '';
			$arr_shortcode = '';

			$shortcode = get_post_meta(get_the_id(), '_format_gallery_shortcode', true);

			if( $shortcode ){
	            // parse shortcode to get 'ids' param
	            $pattern = get_shortcode_regex();
	            preg_match("/$pattern/s", $shortcode, $match);
	            $arr_shortcode = shortcode_parse_atts($match[3]);
	        }

	        if (isset($arr_shortcode['ids'])) {
		        $att_ids = explode(',',  $arr_shortcode['ids']);
		    }
		    // Shortcodes Ultimate Plugin Gallery
		    elseif (isset ($arr_shortcode['source'])){
		        $su_source_ids = explode(':',  $arr_shortcode['source']);

		        if( count($su_source_ids[1]) > 0 ){
		            $att_ids = explode(',',  $su_source_ids[1]);
		        }
		    }

		    if(is_array($att_ids) && count($att_ids) > 0 ){
		    	$img_attributes = $img_src = $img_title = '';

		    	foreach ($att_ids as $att_id) {
		    		$img_attributes = wp_get_attachment_image_src($att_id);
		    		if( $img_attributes ){
		    			$img_src = $img_attributes[0];

		    			if (is_ssl()) {
			    			$img_src = str_replace('http://', 'https://', $img_src);
						}
		    		}
						$image_title = wp_get_attachment_caption($att_id);
		    		echo '<span data-id="' . $att_id . '" title="' . $img_title . '"><img src="' . esc_url($img_src) . '" alt="'. $image_title .'" /><i class="srp-dashicons"></i></span>';

		    	}
		    }
		} ?>

		</div>

		<p class="none" style="float: none; clear: both;">
			<a href="#" class="button"><?php _e('Upload Images', 'writing'); ?></a>
		</p>
	</div>
</div>
