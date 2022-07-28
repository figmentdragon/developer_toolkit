<?php
/**
 * Functions for page templates.
 *
 * @package TheThemeName
 */

function get_theme_layout() {
	$layout = '';
	if ( is_page_template( 'templates/no-sidebar.php' ) ) {
		$layout = 'no-sidebar';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = get_theme_mod( 'default_layout', 'right-sidebar' );
		if ( is_home() || is_archive() ) {
			$layout = get_theme_mod( 'homepage_archive_layout', 'right-sidebar' );
		}
 	}
 	return $layout;
}

function get_sidebar_id() {
	$sidebar = $id = '';
	$layout = get_theme_layout();
	if ( 'no-sidebar' === $layout ) {
		return $sidebar;
	}
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$sidebar = 'sidebar-1'; // Primary Sidebar.
	}
	return $sidebar;
}

function get_first_image( $postID, $size, $attr, $src = false ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if ( isset( $matches[1][0] ) ) {
		// Get first image.
		$first_img = $matches[1][0];

		if ( $src ) {
			//Return url of src is true
			return $first_img;
		}

		return '<img class="wp-post-image" src="'. esc_url( $first_img ) .'">';
	}

	return false;
}

if ( ! function_exists( 'featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own featured_image(), and that function will be used instead.
	 *
	 * @since 1.0
	 */
	function featured_image() {
		if ( is_header_video_active() && has_header_video() ) {
			return true;
		}
		$thumbnail = 'post-thumbnail';

		if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
			$jetpack_options = get_theme_mod( 'jetpack_testimonials' );
			$option = 'jetpack_testimonial_featured_image';
			$featured_image = get_option( 'jetpack_testimonial_featured_image' );
			if ( isset( $jetpack_options['featured-image'] ) && '' !== $jetpack_options['featured-image'] ) {
				$image = wp_get_attachment_image_src( (int) $jetpack_options['featured-image'], $thumbnail );
				return $image['0'];
			} elseif ( ! isset( $jetpack_options['featured-image'] ) && isset( $featured_image ) && '' !== $featured_image ) {
				$image = wp_get_attachment_image_src( (int) $featured_image, $thumbnail );
				return $image['0'];
			} else {
				return false;
			}
		} elseif ( is_post_type_archive( 'jetpack-portfolio' ) || is_post_type_archive( 'featured-content' ) || is_post_type_archive( 'ect-service' ) || is_post_type_archive( 'ect-team' ) || is_post_type_archive( 'ect-event' ) ) {
			$option = '';

			if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
				$option = 'jetpack_portfolio_featured_image';
			} elseif ( is_post_type_archive( 'featured-content' ) ) {
				$option = 'featured_content_featured_image';
			} elseif ( is_post_type_archive( 'ect-service' ) ) {
				$option = 'ect_service_featured_image';
			} elseif ( is_post_type_archive( 'ect-team' ) ) {
				$option = 'ect_team_featured_image';
			} elseif ( is_post_type_archive( 'ect-event' ) ) {
				$option = 'ect_event_featured_image';
			}

			$featured_image = get_option( $option );

			if ( '' !== $featured_image ) {
				$image = wp_get_attachment_image_src( (int) $featured_image, $thumbnail );
				return isset( $image[0] ) ? $image[0] : false;
			} else {
				return get_header_image();
			}
		} else {
			return get_header_image();
		}
	} // featured_image
endif;

if ( ! function_exists( 'header_media_text' ) ):
	/**
	 * Display Header Media Text
	 *
	 * @since 1.0
	 */
	function header_media_text() {

		if ( ! has_header_media_text() ) {
			// Bail early if header media text is disabled on front page
			return get_header_image();
		}

		$content_alignment = get_theme_mod( 'header_media_content_alignment', 'content-align-right' );
		$text_alignment = get_theme_mod( 'header_media_text_alignment', 'text-align-left' );

		$header_media_logo = get_theme_mod( 'header_media_logo' );

		$classes = array();
		if( is_front_page() ) {
			$classes[] = $content_alignment;
			$classes[] = $text_alignment;
		}

		?>
		<div class="custom-header-content sections header-media-section <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="custom-header-content-wrapper">
				<?php
				$header_media_subtitle = get_theme_mod( 'header_media_sub_title' );
				$enable_homepage_logo = get_theme_mod( 'header_media_logo_option', 'homepage' );

				if( is_front_page() ) : ?>
					<div class="section-subtitle"> <?php echo esc_html( $header_media_subtitle ); ?> </div>
				<?php endif;

				if ( check_section( $enable_homepage_logo ) && $header_media_logo ) {  ?>
					<div class="site-header-logo">
						<img src="<?php echo esc_url( $header_media_logo ); ?>" title="<?php echo esc_url( home_url( '/' ) ); ?>" />
					</div><!-- .site-header-logo -->
				<?php } ?>

				<?php
				$tag = 'h2';

				if ( is_singular() || is_404() ) {
					$tag = 'h1';
				}

				header_title( '<div class="section-title-wrapper"><' . $tag . ' class="section-title entry-title">', '</' . $tag . '></div>' );
				?>

				<?php header_description( '<div class="site-header-text">', '</div>' ); ?>

				<?php if ( is_front_page() ) :
					$header_media_url_text = get_theme_mod( 'header_media_url_text' );

					if ( $header_media_url_text ) :
						$header_media_url = get_theme_mod( 'header_media_url', '#' );
						?>
						<span class="more-link">
							<a href="<?php echo esc_url( $header_media_url ); ?>" target="<?php echo esc_attr( get_theme_mod( 'header_url_target' ) ? '_blank' : '_self' ); ?>" class="readmore"><?php echo esc_html( $header_media_url_text ); ?></a>
						</span>
					<?php endif;
				endif; ?>
			</div><!-- .custom-header-content-wrapper -->
		</div><!-- .custom-header-content -->
		<?php
	} // header_media_text.
endif;

if ( ! function_exists( 'has_header_media_text' ) ):
	/**
	 * Return Header Media Text fro front page
	 *
	 * @since 1.0
	 */
	function has_header_media_text() {
		$header_image = featured_overall_image();

		if ( is_front_page() ) {
			$header_media_subtitle = get_theme_mod( 'header_media_sub_title' );
			$header_media_logo     = get_theme_mod( 'header_media_logo' );
			$header_media_title    = get_theme_mod( 'header_media_title' );
			$header_media_text     = get_theme_mod( 'header_media_text' );
			$header_media_url      = get_theme_mod( 'header_media_url', '#' );
			$header_media_url_text = get_theme_mod( 'header_media_url_text' );

			if ( ! $header_media_logo && ! $header_media_subtitle && ! $header_media_title && ! $header_media_text && ! $header_media_url && ! $header_media_url_text ) {
				// Bail early if header media text is disabled
				return false;
			}
		} elseif ( 'disable' === $header_image ) {
			return false;
		}

		return true;
	} // has_header_media_text.
endif;

// Overwrite parent theme's blog header function
add_action( 'after_header', 'blog_header_image', 11 );
function blog_header_image() {

	if ( ( is_front_page() && is_home() ) || ( is_home() ) ) {
		$blog_header_image 			=  get_setting( 'blog_header_image' );
		$blog_header_title 			=  get_setting( 'blog_header_title' );
		$blog_header_text 			=  get_setting( 'blog_header_text' );
		$blog_header_button_text 	=  get_setting( 'blog_header_button_text' );
		$blog_header_button_url 	=  get_setting( 'blog_header_button_url' );
		if ( $blog_header_image != '' ) { ?>
		<div class="page-header-image grid-parent page-header-blog" style="background-image: url('<?php echo esc_url($blog_header_image); ?>') !important;">
        	<div class="page-header-noiseoverlay"></div>
        	<div class="page-header-blog-inner">
                <div class="page-header-blog-content-h grid-container">
                    <div class="page-header-blog-content">
                    <?php if ( $blog_header_title != '' ) { ?>
                        <div class="page-header-blog-text">
                            <?php if ( $blog_header_title != '' ) { ?>
                            <h2><?php echo wp_kses_post( $blog_header_title ); ?></h2>
                            <div class="clearfix"></div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    </div>
                </div>
                <div class="page-header-blog-content page-header-blog-content-b">
                	<?php if ( $blog_header_text != '' ) { ?>
                	<div class="page-header-blog-text">
						<?php if ( $blog_header_title != '' ) { ?>
                        <p><?php echo wp_kses_post( $blog_header_text ); ?></p>
                        <div class="clearfix"></div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="page-header-blog-button">
                        <?php if ( $blog_header_button_text != '' ) { ?>
                        <a class="read-more button" href="<?php echo esc_url( $blog_header_button_url ); ?>"><?php echo esc_html( $blog_header_button_text ); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
		</div>
		<?php
		}
	}
}






function content_image() {
	if ( has_post_thumbnail() && jetpack_featured_image_display() && is_singular() ) {
		global $post, $wp_query;

		// Get Page ID outside Loop.
		$page_id = $wp_query->get_queried_object_id();

		if ( $post ) {
	 		if ( is_attachment() ) {
				$parent = $post->post_parent;

				$individual_featured_image = get_post_meta( $parent, 'featured-image', true );
			} else {
				$individual_featured_image = get_post_meta( $page_id, 'featured-image', true );
			}
		}

		if ( empty( $individual_featured_image ) ) {
			$individual_featured_image = 'default';
		}

		if ( 'disable' === $individual_featured_image ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		} else {
			$class = array();

			$image_size = 'post-thumbnail';

			if ( 'default' !== $individual_featured_image ) {
				$image_size = $individual_featured_image;
				$class[]    = 'from-metabox';
			} else {
				$layout = get_theme_layout();

				if ( 'no-sidebar-full-width' === $layout ) {
					$image_size = 'post-thumbnail';
				}
			}

			$class[] = $individual_featured_image;
			?>
			<div class="post-thumbnail <?php echo esc_attr( implode( ' ', $class ) ); ?>">
				<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( $image_size ); ?>
				</a>
			</div>
		<?php
		}
	} // End if ().
}

function sections( $selector = 'header' ) {
		get_template_part( 'template-parts/header/header-media' );
		get_template_part( 'template-parts/display/display-slider' );
		get_template_part( 'template-parts/display/display-portfolio' );
		get_template_part( 'template-parts/display/content-hero' );
		get_template_part( 'template-parts/display/display-testimonial' );
		get_template_part( 'template-parts/display/display-services' );
		get_template_part( 'template-parts/display/display-featured' );
	}


function post_thumbnail( $image_size = 'post-thumbnail', $type = 'html', $echo = true, $no_thumb = false ) {
	$image = $image_url = '';

	if ( has_post_thumbnail() ) {
		$image_url = get_the_post_thumbnail_url( get_the_ID(), $image_size );
		$image     = get_the_post_thumbnail( get_the_ID(), $image_size );
	} else {
		if ( is_array( $image_size ) && $no_thumb ) {
			$image_url  = trailingslashit( get_stylesheet_directory() ) . 'assets/images/no-thumb-' . $image_size[0] . 'x' . $image_size[1] . '.jpg';
			$image      = '<img src="' . esc_url( $image_url ) . '" alt="" />';
		} elseif ( $no_thumb ) {
			global $_wp_additional_image_sizes;

			$image_url  = trailingslashit( get_stylesheet_directory() ) . 'assets/images/no-thumb-1920x822.jpg';

			if ( array_key_exists( $image_size, $_wp_additional_image_sizes ) ) {
				$image_url  = trailingslashit( get_stylesheet_directory() ) . 'assets/images/no-thumb-' . $_wp_additional_image_sizes[ $image_size ]['width'] . 'x' . $_wp_additional_image_sizes[ $image_size ]['height'] . '.jpg';
			}

			$image      = '<img src="' . esc_url( $image_url ) . '" alt="" />';
		}

		// Get the first image in page, returns false if there is no image.
		$first_image_url = get_first_image( get_the_ID(), $image_size, '', true );

		// Set value of image as first image if there is an image present in the page.
		if ( $first_image_url ) {
			$image_url = $first_image_url;
			$image = '<img class="wp-post-image" src="'. esc_url( $image_url ) .'">';
		}
	}

	if ( ! $image_url ) {
		// Bail if there is no image url at this stage.
		return;
	}

	if ( 'url' === $type ) {
		return $image_url;
	}

	$output = '<div';

	if ( 'html-with-bg' === $type ) {
		$output .= ' class="post-thumbnail-background" style="background-image: url( ' . esc_url( $image_url ) . ' )"';
	} else {
		$output .= ' class="post-thumbnail"';
	}

	$output .= '>';

	if ( 'html-with-bg' !== $type ) {
		$output .= '<a href="' . esc_url( get_the_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">' . $image;
	} else {
		$output .= '<a class="cover-link" href="' . esc_url( get_the_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">';
	}

	$output .= '</a></div><!-- .post-thumbnail -->';

	if ( ! $echo ) {
		return $output;
	}

	echo $output;
}

function new_excerpt_length( $length ) {
	return 70;
}

function read_more_custom_excerpt( $text ) {
		if ( strpos( $text, '[&hellip;]' ) ) {
			$excerpt = str_replace( '[&hellip;]', '<a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'TheThemeName' ) . '</a>', $text );
		} else {
			$excerpt = $text . '<a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'TheThemeName' ) . '</a>';
		}
		return $excerpt;
	}

function trim_excerpt($text) {
  return str_replace('[&hellip;]', '&hellip;', $text);
}

function truncate_phrase( $text, $max_characters ) {
	$text = trim( $text );
	if ( mb_strlen( $text ) > $max_characters ) {
		//* Truncate $text to $max_characters + 1
		$text = mb_substr( $text, 0, $max_characters + 1 );
		//* Truncate to the last space in the truncated string
		$text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
	}
	return $text;
}

function get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {
		$content = get_the_content( '', $stripteaser );
		// Strip tags and shortcodes so the content truncation count is done correctly.
		$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );
		// Remove inline styles / .
		$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );
		// Truncate $content to $max_char
		$content = truncate_phrase( $content, $max_characters );
		// More link?
		if ( $more_link_text ) {
			$link   = apply_filters( 'get_the_content_more_link', sprintf( '<span class="readmore"><a href="%s" class="more-link">%s</a></span>', esc_url( get_permalink() ), $more_link_text ), $more_link_text );
			$output = sprintf( '<p>%s %s</p>', $content, $link );
		} else {
			$output = sprintf( '<p>%s</p>', $content );
			$link = '';
		}
		return apply_filters( 'get_the_content_limit', $output, $content, $link, $max_characters );
	}



function get_social($echo = true){

	$link_enabled = 0;

	$social_link = '';
	$fb_link      = esc_url(get_theme_mod('facebook'));
	$twitter_link = esc_url(get_theme_mod('twitter'));
	$insta_link   = esc_url(get_theme_mod('instagram'));
	$github_link   = esc_url(get_theme_mod('github'));
	$linked_link  = esc_url(get_theme_mod('linkedin'));
	$ytube_link   = esc_url(get_theme_mod('youtube'));
	$pint_link    = esc_url(get_theme_mod('pinterest'));
	$drib_link    = esc_url(get_theme_mod('dribble'));


	if($fb_link):
		$social_link .='<li><a href="'.$fb_link.'" target="_blank"><span class="fa fa-facebook"></span></a></li>';
		$link_enabled++;
	endif;

	if($twitter_link):
		$social_link .='<li><a href="'.$twitter_link.'" target="_blank"><span class="fa fa-twitter"></span></a></li>';
		$link_enabled++;
	endif;

	if($insta_link):
		$social_link .='<li><a href="'.$insta_link.'" target="_blank"><span class="fa fa-instagram"></span></a></li>';
		$link_enabled++;
	endif;

	if($github_link):
		$social_link .='<li><a href="'.$github_link.'" target="_blank"><span class="fa fa-github"></span></a></li>';
		$link_enabled++;
	endif;

	if($linked_link):
		$social_link .='<li><a href="'.$linked_link.'" target="_blank"><span class="fa fa-linkedin"></span></a></li>';
		$link_enabled++;
	endif;

	if($ytube_link):
		$social_link .='<li><a href="'.$ytube_link.'" target="_blank"><span class="fa fa-youtube"></span></a></li>';
		$link_enabled++;
	endif;

	if($pint_link):
		$social_link .='<li><a href="'.$pint_link.'" target="_blank"><span class="fa fa-pinterest-p"></span></a></li>';
		$link_enabled++;
	endif;

	if($drib_link):
		$social_link .='<li><a href="'.$drib_link.'" target="_blank"><span class="fa fa-dribbble"></span></a></li>';
		$link_enabled++;
	endif;

	$social_link_output = '';
	$button_style = esc_html(get_theme_mod('social_button_style', 'default-colors'));

	if($link_enabled > 0):
		$social_link_output .='
		<div class="site-header-top-right site-column-3">
			<nav id="social-navigation" class="social-navigation '.$button_style.'"><ul>'.$social_link.'</ul></nav>
		</div>';
	endif;

	if($echo)
		echo $social_link_output;
	else
	return $social_link_output;

}

function social_sharing_buttons() {
	global $post;
	// Show this on post only. if social shared enabled.

	// Get current page URL
	$shortURL = get_permalink();

	// Get current page title
	$shortTitle = get_the_title();
	$postmediaurl = get_the_post_thumbnail_url($post->id);
	// Construct sharing URL without using any script
	$twitterURL = esc_url('http://twitter.com/share?text='.$shortTitle.'&url='.$shortURL);
	$facebookURL = esc_url('https://www.facebook.com/sharer/sharer.php?u='.$shortURL);
	$linkedInURL = esc_url('https://www.linkedin.com/shareArticle?mini=true&url='.$shortURL.'&title='.$shortTitle);
	//$googleURL = esc_url('https://plus.google.com/share?url='.$shortURL);
	//$bufferURL = 'https://bufferapp.com/add?url='.$shortURL.'&amp;text='.$shortTitle;
	$pinterestURL = esc_url('http://pinterest.com/pin/create/button/?url='.$shortURL.'&media='.$postmediaurl.'&description='.$shortTitle);

	// Add sharing button at the end of page/page content
	$content = '<ul>';

	$content .= '<li><a href="'.$facebookURL.'" onclick="window.open(this.href, \'facebook-share\',\'width=580,height=296\');return false;"><span class="fa fa-facebook"></span></a></li>';

	$content .= '<li><a href="'. $twitterURL .'" onclick="window.open(this.href, \'twitter-share\', \'width=550,height=235\');return false;"><span class="fa fa-twitter"></span></a></li>';

	$content .= '<li><a href="'. $linkedInURL .'" onclick="window.open(this.href, \'linkedIn-share\', \'width=550,height=550\');return false;"><span class="fa fa-linkedin"></span></a></li>';

	$content .= '<li><a href="#" onclick="window.open(\''.$pinterestURL.'\', \'pinterest-share\', \'width=490,height=530\');return false;"><span class="fa fa-pinterest-p"></span></a></li>';

	/* $content .= '<li><a href="'.$googleURL.'" onclick="window.open(this.href, \'google-plus-share\', \'width=490,height=530\');return false;"><span class="fa fa-google-plus"></span></a></li>'; */

	$content .= '</ul>';

	return $content;

}

if ( ! function_exists ( 'pagenavi' ) ) {
	function pagenavi(){

		the_posts_pagination(
			array(
				'mid_size' => 2,
				'prev_text' => __( '&larr; Previous', 'TheThemeName' ),
				'next_text' => __( 'Next &rarr;', 'TheThemeName' ),
			)
		);
	}
}

if ( ! function_exists ( 'comment_list' ) ) {
function comment_list( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :  // 1
		case 'trackback' : // 1
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Pingback:', 'TheThemeName' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'TheThemeName' ), '<span class="edit-link">', '</span>' ); ?></p>
			<?php
			break;
			default : // 2
			GLOBAL $post;
			$avatar_variation = ' img-thumbnail';
			?>
			<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<?php
				printf( '<div class="comment-img">%1$s %2$s</div>',
				get_avatar( $comment, 120 ),
				( $comment->user_id === $post->post_author ) ? '<span class="bypostauthor">' . __( 'Post<br>Author', 'TheThemeName' ) . '</span>' : ''
			);
			?>
			<article id="comment-<?php comment_ID(); ?>" class="comment-meta">
				<header class="comment-header">
					<?php
					printf( '<cite class="comment-author">%1$s</cite>',
					get_comment_author_link()
				);
				printf( '<div> <a href="%1$s" class="comment-time"><time datetime="%2$s">%3$s</time></a> </div>',
				  esc_url( get_comment_link( $comment->comment_ID ) ),
					get_comment_time( 'c' ),
					sprintf( __( '%1$s at %2$s', 'TheThemeName' ),
					get_comment_date(),
					get_comment_time()
					)
				);
				edit_comment_link( __( '<i class="icon-edit"></i> Edit', 'TheThemeName' ) );
				?>
				<div class="comment-reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div><!-- .reply -->
			</header>
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'TheThemeName' ); ?></p>
			<?php endif; ?>
			<section class="comment-content">
				<?php comment_text(); ?>
			</section>
		</article>
		<?php
		break;
	endswitch;
}
}

if ( ! function_exists ( 'enqueue_comments_reply' ) ) {
	function enqueue_comments_reply() {
		if( get_option( 'thread_comments' ) )  {
			wp_enqueue_script( 'comment-reply' );
		}
	}

}
