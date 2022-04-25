<div id="creativity_box_for_post-format-quote" class="creativity_format_field creativity_format_field_quote" >
	<div class="cf-elm-block">
		<label for="cfpf-format-quote-source-name"><?php _e('Quote Author Name', 'writing'); ?></label>
		<input type="text" name="_format_quote_source_name" value="<?php echo esc_attr(get_post_meta(get_the_id(), '_format_quote_source_name', true)); ?>" id="cfpf-format-quote-source-name" tabindex="1" />
	</div>
	<div class="cf-elm-block">
		<label for="cfpf-format-quote-source-url"><?php _e('Quote Author URL', 'writing'); ?></label>
		<input type="text" name="_format_quote_source_url" value="<?php echo esc_attr(get_post_meta(get_the_id(), '_format_quote_source_url', true)); ?>" id="cfpf-format-quote-source-url" tabindex="1" />
	</div>
	<div class="cf-elm-block">
		<label for="cfpf-format-quote-source-content"><?php _e('Quote Content', 'writing'); ?></label>
		<textarea name="_format_quote_source_content" id="cfpf-format-quote-source-content" tabindex="1"><?php echo esc_textarea(get_post_meta(get_the_id(), '_format_quote_source_content', true)); ?></textarea>
	</div>
</div>