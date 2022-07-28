<?php
/**
 * Checkbox sanitization callback.
 */
function creativity_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Select sanitization callback example.
 *
 * - Sanitization: select
 * - Control: select, radio
 */
function creativity_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


/**
 * Social Sharing Hook
 * @since 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if (!function_exists('creativity_social_sharing')) :
    function creativity_social_sharing($post_id)
    {
        $creativity_url = get_the_permalink($post_id);
        $creativity_title = get_the_title($post_id);
        $creativity_image = get_the_post_thumbnail_url($post_id);
        
        //sharing url
        $creativity_twitter_sharing_url = esc_url('http://twitter.com/share?text=' . $creativity_title . '&url=' . $creativity_url);
        $creativity_facebook_sharing_url = esc_url('https://www.facebook.com/sharer/sharer.php?u=' . $creativity_url);
        $creativity_pinterest_sharing_url = esc_url('http://pinterest.com/pin/create/button/?url=' . $creativity_url . '&media=' . $creativity_image . '&description=' . $creativity_title);
        $creativity_linkedin_sharing_url = esc_url('http://www.linkedin.com/shareArticle?mini=true&title=' . $creativity_title . '&url=' . $creativity_url);
        
        ?>
        <div class="post-share">
            <a target="_blank" href="<?php echo $creativity_facebook_sharing_url; ?>"><i class="fa fa-facebook"></i></a>
            <a target="_blank" href="<?php echo $creativity_twitter_sharing_url; ?>"><i
                        class="fa fa-twitter"></i></a>
            <a target="_blank" href="<?php echo $creativity_pinterest_sharing_url; ?>"><i
                        class="fa fa-pinterest"></i></a>
            <a target="_blank" href="<?php echo $creativity_linkedin_sharing_url; ?>"><i class="fa fa-linkedin"></i></a>
        </div>
        <?php
    }
endif;
add_action('creativity_social_sharing', 'creativity_social_sharing', 10);