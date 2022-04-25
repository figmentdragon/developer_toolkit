<div class="creativity_format_field" id="creativity_box_for_post-format-status" >
	<label for="cfpf-format-status-embed"><?php _e('Write a status or paste a status url from Facebook or Twitter', 'writing'); ?></label>
	<textarea name="_format_status_embed" id="cfpf-format-status-embed" tabindex="1"><?php echo esc_textarea(get_post_meta(get_the_id(), '_format_status_embed', true)); ?></textarea>
</div>