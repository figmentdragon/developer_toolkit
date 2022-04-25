<?php

$themename_frame_tag = 'i' . 'frame';
global $lazyclass, $src;
$src = 'src';
$lazyclass = 'lazyloaded';
if (themename_option('themename_lazyload_iframe_banner') == true) {
  $src = 'data-src';
  $lazyclass = 'lazyload ' . themename_option('themename_lazyload_effect');
}

if (themename_option('themename_lazyload_image_banner') == true) {
	function themename_filter_gallery_img_atts( $atts, $attachment, $size ) {
			$atts['data-src'] = isset($atts['src']) ? $atts['src'] : '' ;
			$atts['data-sizes'] = isset($atts['sizes']) ? $atts['sizes'] : '' ;
			$atts['data-srcset'] = isset($atts['srcset']) ? $atts['srcset'] : '';
			if (is_array(wp_get_attachment_image_src($attachment->ID))) {
				$image_size = wp_get_attachment_image_src($attachment->ID,$size);
				$atts['src'] = isset($atts['data-src']) ? "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 ".$image_size[1]." ".$image_size[2]."'%3E%3C/svg%3E" : $atts['src'];
			} else {
				$atts['src'] = isset($atts['data-src']) ? 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' : $atts['src'];
			}
			$atts['sizes'] = isset($atts['data-sizes']) ? '' : $atts['sizes'];
			$atts['srcset'] = isset($atts['data-srcset']) ? '' : $atts['srcset'];
			$atts['class'] .= ' lazyload ' . themename_option('themename_lazyload_effect');
	    return $atts;
	}
	add_filter( 'wp_get_attachment_image_attributes', 'themename_filter_gallery_img_atts', 10, 3 );
}

function magic_substr($haystack, $start, $end) {
    $index_start = strpos($haystack, $start);
    $index_start = ($index_start === false) ? 0 : $index_start + strlen($start);
    if (strpos($haystack, $end) == TRUE) {
        $index_end = strpos($haystack, $end, $index_start);
        $length = ($index_end === false) ? strlen($end) : $index_end - $index_start;
        return substr($haystack, $index_start, $length);
    } else {
        return substr($haystack, $index_start);
    }
}

function themename_default_image() {
    global $themename_data;
    if ($themename_data['themename_default_image']) {
        return $themename_data['themename_default_image'];
    } else {
        return get_template_directory_uri() . '/img/default.jpg';
    }
}

function themename_video_prov($vurl) {
    if (strpos($vurl, 'youtube') !== false) {
        $prov = "youtube";
    } elseif (strpos($vurl, 'youtu') !== false) {
        $prov = "youtu";
    } elseif (strpos($vurl, 'vimeo') !== false) {
        $prov = "vimeo";
    } else {
        $prov = "none";
    }
    return $prov;
}

    function themename_video_id($prov, $vurl) {
    	if ($prov == 'youtube') {
    	if (strpos($vurl, 'www.youtube.com/watch?v=')) {
    		if (strpos($vurl, 'https') !== false) {
    		$id = magic_substr($vurl, "https://www.youtube.com/watch?v=", "&");
    	} else {
    		$id = magic_substr($vurl, "http://www.youtube.com/watch?v=", "&");
    	}
    	} else {
    		if (strpos($vurl, 'https') !== false) {
    		$id = magic_substr($vurl, "http://youtube.com/watch?v=", "&");
    	} else {
    		$id = magic_substr($vurl, "https://youtube.com/watch?v=", "&");
    	}
    	}
    } elseif ($prov == 'youtu') {
    	if (strpos($vurl, 'www.youtu.be/watch?v=')) {
    		if (strpos($vurl, 'https') !== false) {
    		$id = magic_substr($vurl, "https://www.youtu.be/watch?v=", "&");
    	} else {
    		$id = magic_substr($vurl, "http://www.youtu.be/watch?v=", "&");
    	}
    	} else {
    		if (strpos($vurl, 'https') !== false) {
    		$id = magic_substr($vurl, "https://youtu.be/", "&");
    		} else {
    		$id = magic_substr($vurl, "http://youtu.be/", "&");
    		}
    	}
    } elseif ($prov == 'vimeo') {
    	if (strpos($vurl, 'https') !== false) {
    		$id = magic_substr($vurl, "https://vimeo.com/", "?");
    	} else {
    		$id = magic_substr($vurl, "http://vimeo.com/", "?");
    	}
    }
    	return $id;
}

function themename_video_frame($prov, $vid) {
    global $themename_frame_tag;
    global $lazyclass, $src;
    echo '<div class="video_fit_container">';
    if ($prov == 'youtube') {
        ?>
          <<?php echo esc_attr($themename_frame_tag); ?>  class="video_frame <?php echo esc_attr($lazyclass);?>" <?php echo esc_attr($src);?>="//www.youtube.com/embed/<?php echo esc_attr($vid); ?>?wmode=transparent&wmode=opaque" frameborder="0" allowfullscreen></<?php echo esc_attr($themename_frame_tag); ?>>
        <?php
    } elseif ($prov == 'youtu') {
        ?>
        <<?php echo esc_attr($themename_frame_tag); ?>  class="video_frame <?php echo esc_attr($lazyclass);?>" <?php echo esc_attr($src);?>="//www.youtube.com/embed/<?php echo esc_attr($vid); ?>" frameborder="0" allowfullscreen></<?php echo esc_attr($themename_frame_tag); ?>>
        <?php
    } elseif ($prov == 'vimeo') {
        ?>
        <<?php echo esc_attr($themename_frame_tag); ?>  class="video_frame <?php echo esc_attr($lazyclass);?>" <?php echo esc_attr($src);?>="//player.vimeo.com/video/<?php echo esc_attr($vid); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></<?php echo esc_attr($themename_frame_tag); ?>>
        <?php
    } else {

    }
    echo '</div>';
}
if (!function_exists('themename_blog_post_banner')) {
function themename_blog_post_banner($size = "", $class = "") {
    global $themename_frame_tag;
    global $post;
    global $lazyclass, $src;

    if ($size == '') {
      if (is_single()) {
        $size = "post-thumbnail";
				if ((themename_cross_option('themename_sidebar_position', $post->ID) != 'none') && is_active_sidebar( 'sidebar-1' ) && themename_option('themename_banners_devices_size')) {
					$size = 'single_full_blog_sidebar';
				}
			}
    }

    if ($class != '') {
      $class = ' ' . $class;
    }

    if (get_post_format() == "image" ) {
        echo '<div class="blog_post_banner blog_post_'.get_post_format().''.$class.'">';
        //$image_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
        $url = '';
        if (is_single()) {
            the_post_thumbnail($size, array("class"=>"img-responsive") );

						// Show caption in single if set to
						if (themename_option('themename_banner_single_caption')) {
							if (get_post(get_post_thumbnail_id())->post_excerpt) { // search for if the image has caption added on it
			 					echo '<figcaption class="wp-caption wp-caption-text">' . wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt) . '</figcaption>'; // displays the image caption
			 				}
						}
        } else if (is_page() && !is_page_template( 'blog' )) {
          if (themename_cross_option('themename_single_thumb_crop') == 'no') {
            $size = "single_full_blog";
          }
					if ((themename_cross_option('themename_sidebar_position', $post->ID) != 'none') && is_active_sidebar( 'sidebar-1' ) && themename_option('themename_banners_devices_size')) {
						$size = 'single_full_blog_sidebar';
					}
          the_post_thumbnail($size, array("class"=>"img-responsive") );
					// Show caption in single post if set to
					if (themename_option('themename_banner_single_caption')) {
						if (get_post(get_post_thumbnail_id())->post_excerpt) { // search for if the image has caption added on it
							echo '<figcaption class="wp-caption wp-caption-text">' . wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt) . '</figcaption>'; // displays the image caption
						}
					}
        } else {
            echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
            the_post_thumbnail($size, array("class"=>"img-responsive") );
            echo '</a>';

						// show caption in blog if set to
						if (themename_option('themename_banner_blog_caption')) {
							if (get_post(get_post_thumbnail_id())->post_excerpt) { // search for if the image has caption added on it
								echo '<figcaption class="wp-caption wp-caption-text">' . wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt) . '</figcaption>'; // displays the image caption
							}
						}
        }
        ?>
        <?php
        echo '</div>';
    } elseif (get_post_format() == "video") {
        if (get_post_meta($post->ID, '_format_video_embed', true) != '' ) {
            echo '<div class="blog_post_banner blog_post_'.get_post_format().''.$class.'">';
            $video_url = get_post_meta($post->ID, '_format_video_embed', true);

            if (strpos($video_url, $themename_frame_tag) != false) {
                echo '<div class="video_fit_container">';
                echo balanceTags($video_url);
                echo '</div>';
            } elseif (strpos($video_url, ".webm") ||
											strpos($video_url, ".ogv") ||
											strpos($video_url, ".mp4") ||
											strpos($video_url, ".m4v") ||
											strpos($video_url, ".wmv") ||
											strpos($video_url, ".mov") ||
											strpos($video_url, ".qt") ||
											strpos($video_url, ".flv") ||
											strpos($video_url, ".mp3") ||
											strpos($video_url, ".m4a") ||
											strpos($video_url, ".m4b") ||
											strpos($video_url, ".ogg") ||
											strpos($video_url, ".oga") ||
											strpos($video_url, ".wma") ||
											strpos($video_url, ".wav")) {
                echo '<div class="video_fit_container">';
                echo do_shortcode('[video url="' . $video_url . '"]');
                echo '</div>';
            } else {
                $prov = themename_video_prov($video_url);
                $vid = themename_video_id($prov, $video_url);
                themename_video_frame($prov, $vid);
            }
            echo '</div>';
						wp_enqueue_script('themename-fitvids-script');
        }else{
            // if video form empty
        }

    } elseif (get_post_format() == "gallery") {
			if (!is_single() && themename_option('themename_blog_gallery_crop') == 'no') {
				$size = 'full';
			}
      if (((class_exists( 'Jetpack' )) && (Jetpack::is_module_active( 'carousel' )))) {
        echo '<div class="Jetpack-gallery-post">';
        $gallery_shortcode = get_post_meta($post->ID, '_format_gallery_shortcode', true);

        echo do_shortcode('[gallery columns="5" numberposts="16" orderby="rand"]', $gallery_shortcode );
        echo '</div>';
      } elseif (themename_option('themename_deactivate_theme_gallery')) {
        echo '<div class="blog_post_banner blog_post_'.get_post_format().''.$class.'">';
        $gallery_shortcode = get_post_meta($post->ID, '_format_gallery_shortcode', true);

        echo do_shortcode('[gallery columns="5" numberposts="16" orderby="rand"]', $gallery_shortcode );
        echo '</div>';
      } else {
        echo '<div class="blog_post_banner blog_post_'.get_post_format().''.$class.'">';

        if (get_post_meta($post->ID, '_format_gallery_shortcode', true) != '' ) {
            $gallery_shortcode = get_post_meta($post->ID, '_format_gallery_shortcode', true);
            if ($size != '') {
                $gallery_shortcode = rtrim($gallery_shortcode, ']');
                $gallery_shortcode = $gallery_shortcode . ' format_size="'.$size.'"]';
            }
            echo do_shortcode( $gallery_shortcode );
        } else {
					$attachments = get_posts(array(
	            'post_type' => 'attachment',
	            'numberposts' => -1,
	            'post_status' => null,
	            'post_parent' => $post->ID,
	            'order' => 'ASC',
	            'orderby' => 'menu_order ID',
	        ));

					if (themename_option('themename_lazyload_image_banner') == true) {
						$image_src = 'data-src';
					  $image_lazyclass = 'lazyload ' . themename_option('themename_lazyload_effect');
					}

					if ($attachments) {
            echo '<div class="filterable_wrapper">';
            echo '<div id="gallery_of_post_'.$post->ID.'" class="clearfix gallery galleryofpostid-'.$post->ID.' themename_row gallery_row themename_post_gallery themename_post_gallery_attachements ">';
            echo '<ul class="grid_slider slides">';
            foreach ($attachments as $attachment) {
                // $image_attributes = wp_get_attachment_url($attachment->ID);
								$image_attributes = wp_get_attachment_image_src( $attachment->ID, $size );
								$image_attributes = $image_attributes[0];
								$image_width = 'width="' .wp_get_attachment_metadata($attachment->ID)['width'] . '"';
								$image_height = 'height="' . wp_get_attachment_metadata($attachment->ID)['height'] . '"';
                $attachment_title = get_the_title($attachment->ID);
								$thumb_srcset = wp_get_attachment_image_srcset( $attachment->ID, $size );
			        	$thumb_sizes = wp_get_attachment_image_sizes( $attachment->ID, $size);
								$src = isset($image_src) ? 'data-' : '';
								$placeholder_src = isset($image_src) ? 'src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="' : '';
								$class= isset($image_lazyclass) ? 'img-responsive ' . $image_lazyclass : 'img-responsive';
                echo '<li class="grid_slide item">';
                echo '<figure class="gallery_column filterable_item full_column">';
                echo '<div class="gallery-icon landscape">';

                echo '<a href="'. $image_attributes.'" href="'. get_the_permalink().'" title="'.$attachment_title.'">';
                echo '<img ' . $image_width . ' ' . $image_height . ' ' . $placeholder_src . ' ' . $src . 'src="'.$image_attributes.'"  ' . $src . 'srcset="'.$thumb_srcset.'" ' . $src . 'sizes="'.$thumb_sizes.'" alt="'.$attachment_title.'" class="' . $class . '">';
                echo '</a>';

                echo '</div>'; // end gallery-icon landscape
                echo '</figure>'; // end gallery_column
                echo '</li>'; // end grid_slide item

            }
            echo '</ul>'; // end grid_slider slides
            echo '<div class="themename_post_gallery_nav_container clearfix"></div>';
            echo '</div>'; // end of #gallery_post_of_*
            echo '</div>'; // end of filterable_wrapper
        	}
				}
      	echo '</div>';
			}
			wp_enqueue_script('themename-imagesloaded-script');
			wp_enqueue_script('themename-gallery-script');

    } elseif (get_post_format() == "audio") {
        echo '<div class="blog_post_banner blog_post_'.get_post_format().''.$class.'">';
        $sound_url = get_post_meta($post->ID, '_format_audio_embed', true);
        if (strpos($sound_url, $themename_frame_tag) != false) {
            echo '<div class="video_fit_container">';
            echo balanceTags($sound_url);
            echo '</div>';
        } elseif (strpos($sound_url, "webm") || strpos($sound_url, ".ogv") || strpos($sound_url, ".mp4") || strpos($sound_url, ".m4v") || strpos($sound_url, ".wmv") || strpos($sound_url, ".mov") || strpos($sound_url, ".qt") || strpos($sound_url, ".flv") || strpos($sound_url, ".mp3") || strpos($sound_url, ".m4a") || strpos($sound_url, ".m4b") || strpos($sound_url, ".ogg") || strpos($sound_url, ".oga") || strpos($sound_url, ".wma") || strpos($sound_url, ".wav")) {
            echo '<div class="video_fit_container">';
            echo do_shortcode('[audio src="' . $sound_url . '" width=100][/audio]');
            echo '</div>';
        } elseif (strpos($sound_url, "soundcloud.com")) {
            ?>
            <<?php echo esc_attr($themename_frame_tag); ?> height="166" <?php if ($lazyclass != '') {?>class="lazyload"<?php } ?> style="overflow:hidden;border:none;width:100%" <?php echo esc_attr($src);?>="https://w.soundcloud.com/player/?url=<?php echo esc_url($sound_url); ?>"></<?php echo esc_attr($themename_frame_tag); ?>>
            <?php
        }
        echo '</div>';
    } else {
        if (!get_the_post_thumbnail()) { return false;}
      echo '<div class="blog_post_banner blog_post_image'.$class.'">';
      //$image_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
      $url = '';
      if (get_the_post_thumbnail()) {
        if (is_single()) {
            the_post_thumbnail($size, array("class"=>"img-responsive") );

						// Show caption in single post if set to
						if (themename_option('themename_banner_single_caption')) {
							if (get_post(get_post_thumbnail_id())->post_excerpt) { // search for if the image has caption added on it
			 					echo '<figcaption class="wp-caption wp-caption-text">' . wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt) . '</figcaption>'; // displays the image caption
			 				}
						}
        }else{
            echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
            the_post_thumbnail($size, array("class"=>"img-responsive") );
            echo '</a>';
						// show caption in blog if set to
						if (themename_option('themename_banner_blog_caption')) {
							if (get_post(get_post_thumbnail_id())->post_excerpt) { // search for if the image has caption added on it
								echo '<figcaption class="wp-caption wp-caption-text">' . wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt) . '</figcaption>'; // displays the image caption
							}
						}
        }
      }
      ?>
      <?php
      echo '</div>';
    }
}
}