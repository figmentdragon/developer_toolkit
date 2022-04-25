<div id="creativity_box_for_post-format-audio" class="creativity_format_field creativity_format_field_audio" >
	<label for="cfpf-format-audio-embed"><?php _e('Audio URL (oEmbed) or Embed Code', 'writing'); ?></label>
	<textarea name="_format_audio_embed" id="cfpf-format-audio-embed" tabindex="1"><?php echo esc_textarea(get_post_meta(get_the_id(), '_format_audio_embed', true)); ?></textarea>
</div>