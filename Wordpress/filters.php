<?php

/**
 * Filters are functions that WordPress passes data through, at certain points
 * in execution, just before taking some action with the data (such as adding
 * it to the database or sending it to the browser screen). Filters sit between
 * the database and the browser (when WordPress is generating pages), and
 * between the browser and the database (when WordPress is adding new posts and
 * comments to the database); most input and output in WordPress passes through
 * at least one filter. WordPress does some filtering by default, and your
 * plugin can add its own filtering.
 *
 * @link http://codex.wordpress.org/Plugin_API#Filters
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference
 * @link http://adambrown.info/p/wp_hooks
 */

/**
 * Set Excerpt length in words
 * @param int $length
 * @return int set post excerpt length
 * @link http://codex.wordpress.org/Function_Reference/the_excerpt
 */
function themename_excerpt_length($length) {
    return 23; // Just for Jordan
}

add_filter('excerpt_length', 'themename_excerpt_length');

/**
 *  add ... and return excerpt more
 */
function themename_excerpt_more($more) {
    return ' &hellip;';
}

add_filter('excerpt_more', 'themename_excerpt_more');

if (!function_exists('themename_the_attached_image')) :

    /**
     * Print the attached image with a link to the next attached image.
     *
     *
     * @return void
     */
    function themename_the_attached_image() {
        $post = get_post();
        /**
         * Filter the default Creativity Architect attachment size.
         *
         *
         * @param array $dimensions {
         *     An array of height and width dimensions.
         *
         *     @type int $height Height of the image in pixels. Default 810.
         *     @type int $width  Width of the image in pixels. Default 810.
         * }
         */
        $attachment_size = apply_filters('themename_attachment_size', array(960, 640));
        $next_attachment_url = wp_get_attachment_url();
        /*
         * Grab the IDs of all the image attachments in a gallery so we can get the URL
         * of the next adjacent image in a gallery, or the first image (if we're
         * looking at the last image in a gallery), or, in a gallery of one, just the
         * link to that image file.
         */
        $attachment_ids = get_posts(array(
            'post_parent' => $post->post_parent,
            'fields' => 'ids',
            'numberposts' => -1,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => 'ASC',
            'orderby' => 'menu_order ID',
        ));
        // If there is more than 1 attachment in a gallery...
        if (count($attachment_ids) > 1) {
            foreach ($attachment_ids as $attachment_id) {
                if ($attachment_id == $post->ID) {
                    $next_id = current($attachment_ids);
                    break;
                }
            }
            // get the URL of the next image attachment...
            if ($next_id) {
                $next_attachment_url = get_attachment_link($next_id);
            }
            // or get the URL of the first image attachment.
            else {
                $next_attachment_url = get_attachment_link(array_shift($attachment_ids));
            }
        }
        printf('<a href="%1$s" rel="attachment">%2$s</a>', esc_url($next_attachment_url), wp_get_attachment_image($post->ID, $attachment_size)
        );
    }

endif;


/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function themename_wp_title($title, $sep) {
    global $paged, $page;
    if (is_feed()) {
        return $title;
    }
    // Add the site name.
    $title .= get_bloginfo('name');
    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() )) {
        $title = "$title $sep $site_description";
    }
    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'themename'), max($paged, $page));
    }
    return $title;
}

add_filter('wp_title', 'themename_wp_title', 10, 2);

// This function adds nice anchor with id attribute to our h2 tags for reference
// Ref: http://www.w3.org/TR/html4/struct/links.html#h-12.2.3
function themename_anchor_content_h2($content) {

    // Pattern that we want to match
    $pattern = '/<h2>(.*?)<\/h2>/';

    // now run the pattern and callback function on content
    $content = preg_replace_callback($pattern,
            // function to replace the title with an id
            function ($matches) {
        $title = $matches[1];
        $slug = sanitize_title_with_dashes($title);
        return '<h2 id="' . $slug . '"><a class="anchor" href="#' . $slug . '"><i class="fa fa-link"></i></a>' . $title . '</h2>';
    }
            , $content);
    return $content;
}

add_filter('the_content', 'themename_anchor_content_h2');

/**
 * Filter <p> tags wrapping images
 * comment out if you wish to keep them in <p> tags.
 * \2 a tag open
 * \3 image tag
 * \6 a tag close
 * \n is the group of paranthesis returned
 * "generally, the results of the captured groups are in the order in which they
 * are defined (the open parenthesis)"
 * Exclude alignleft and alignright images, and also images middle of  the
 * paragraphs. Also remove wrapping paragraph of images inside spans.
 * @link http://regexone.com/lesson/
 * @link https://www.debuggex.com/r/Xt9Qvb0_3FKQc4BF
 */
function themename_replace_ptags_around_images_with_figure($content) {
    /* For images with default WordPress alignement */
    $content = preg_replace('/<p.*?>\s?(<span .*>)?\s*(<a .*>)?\s*(<img[^>]+class="(?:.+\s)?(aligncenter|alignnone|alignleft|alignright)(?:\s.+)?"([^"]+)".*>)\s*(<\/a>)?\s*(<\/span>)?\s*<\/p>/iU', '<figure class="\4">\2\3\6</figure>', $content);
    /* For images copied with formatting that does not follow WordPress alignement and everything else */
    $content = preg_replace('/<p.*?>\s?(<span .*>)?\s*(<a .*>)?\s*(<img[^>].*>)\s*(<\/a>)?\s*(<\/span>)?\s*<\/p>/iU', '<figure>\2\3\6</figure>', $content);
    return $content;
}

add_filter('the_content', 'themename_replace_ptags_around_images_with_figure');

/**
 * Filter <p> tags wrapping iframes and other embed elements
 * I know, I know.. Just following WordPress Coding Standards
 * @link http://make.wordpress.org/core/handbook/coding-standards/php/#clever-code
 *
 * @param string $content
 */
function themename_remove_ptags_around_embeds($content) {
    $content = preg_replace('/<p.*?>\s?(<object .*>*.<\/object>)\s*<\/p>/iU', '\1', $content);
    $content = preg_replace('/<p.*?>\s?(<embed .*>*.<\/embed>)\s*<\/p>/iU', '\1', $content);
    $content = preg_replace('/<p.*?>\s?(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
    return $content;
}

add_filter('the_content', 'themename_remove_ptags_around_embeds');

/**
 * Improves the caption shortcode with HTML5 figure & figcaption; microdata & wai-aria attributes
 *
 * @param  string $val     Empty
 * @param  array  $attr    Shortcode attributes
 * @param  string $content Shortcode content
 * @return string          Shortcode output
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/img_caption_shortcode
 * @link http://joostkiens.com/improving-wp-caption-shortcode/
 */
function themename_img_caption_shortcode_filter($val, $attr, $content = null) {
    extract(shortcode_atts(array(
        'id' => '',
        'align' => 'aligncenter',
        'width' => '',
        'caption' => ''
                    ), $attr));

    // No caption, no dice... But why width?
    if (1 > (int) $width || empty($caption))
        return $val;

    if ($id)
        $id = esc_attr($id);

    // Add itemprop="contentURL" to image - Ugly hack
    $content = str_replace('<img', '<img itemprop="image"', $content);

    return '<figure id="' . $id . '" aria-describedby="figcaption_' . $id . '" class="wp-caption ' . esc_attr($align) . '">' . do_shortcode($content) . '<figcaption id="figcaption_' . $id . '" class="wp-caption-text" itemprop="description" style="width: ' . (0 + (int) $width) . 'px">' . $caption . '</figcaption></figure>';
}

add_filter('img_caption_shortcode', 'themename_img_caption_shortcode_filter', 10, 3);

/**
 * Remove the text - 'You may use these <abbr title="HyperText Markup
 * Language">HTML</abbr> tags ...'
 * from below the comment entry box.
 *
 * @return array    Returns the $defaults array.
 * @link http://wordpress.org/support/topic/remove-html-tags-and-attributes?replies=35#post-2429820
 */

function themename_remove_comment_allowed_tags_notes($defaults) {
    $defaults['comment_notes_after'] = '';
    return $defaults;
}

add_filter('comment_form_defaults', 'themename_remove_comment_allowed_tags_notes');

/**
 * Remove 'hentry' from post_class()
 * @link https://gist.github.com/jaredatch/1629862
 */
function themename_remove_hentry_from_homepage($class) {
    if(is_front_page()){
        $class = array_diff($class, array('hentry'));
    }
    return $class;
}

add_filter('post_class', 'themename_remove_hentry_from_homepage');
