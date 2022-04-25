<div id="creativity_box_for_post-format-video" class="creativity_format_field creativity_format_field_video" >
	<label for="cfpf-format-video-embed"><?php _e('Video URL (oEmbed) or Embed Code', 'writing'); ?></label>
	<textarea name="_format_video_embed" id="cfpf-format-video-embed" tabindex="1"><?php echo esc_textarea(get_post_meta(get_the_id(), '_format_video_embed', true)); ?></textarea>
</div>