<?php
/*
Plugin Name: Creativity Core
Plugin URI: https://ahmad.works/writing/
Description: The core plugin of Creativity Wordpress theme
Author: Ahmad Abou Hashem
Author URI: https://ahmad.works/
Version: 1.9
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'WRITING_CORE_VERSION', '1.9' );
define( 'WRITING_CORE_PATH', plugin_dir_path( __FILE__ ));
define( 'WRITING_CORE_URL', plugin_dir_url( __FILE__ ));

if ( ! function_exists( 'creativity_option' ) ) :
function creativity_option($id) {
    if (!$id) {
    	return;
    }
    if (get_theme_mod($id) !== null ) {
        return get_theme_mod($id);
    }
}
endif;

/* --------
include widgets
------------------------------------------- */
require dirname( __FILE__ ) . '/widgets/tweets.php';
require dirname( __FILE__ ) . '/twitter/twitteroauth.php';
require dirname( __FILE__ ) . '/widgets/postlist.php';
require dirname( __FILE__ ) . '/widgets/about.php';
require dirname( __FILE__ ) . '/widgets/fbpage.php';
require dirname( __FILE__ ) . '/widgets/gplus.php';
require dirname( __FILE__ ) . '/widgets/social.php';
require dirname( __FILE__ ) . '/widgets/links.php';

// Run this code on 'after_theme_setup', when plugins have already been loaded.
add_action('after_setup_theme', 'creativity_instaram_slider');
// This function loads the plugin.
function creativity_instaram_slider() {

	if (!class_exists('JR_InstagramSlider')) {
		// load Social if not already loaded
		include_once( dirname( __FILE__ ) . '/widgets/instaram_slider.php');
	}
}

/* --------
creativity latest tweets widget
------------------------------------------- */
if ( ! function_exists( 'creativity_twitter_tweets' ) ) :
function creativity_twitter_tweets($consumerkey = '', $consumersecret = '', $accesstoken = '', $accesstokensecret = '', $screenname = '', $tweets_count = 2, $include_media = false, $extend_tweet = false, $exclude_replies = false) {
    if (empty($consumerkey) || empty($consumersecret) || empty($accesstokensecret) || empty($accesstoken)) {
        return __('Your twitter application info is not set correctly in option panel, please create please login to Twitter Application Manager here https://apps.twitter.com/ , create new application and new access token, then go to theme customizer social section and fill the data you got from Twitter application', 'writing');
    } else {
        $twitter = new pencilTwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

				$args = array();
				if ($screenname != '') {
					$args['screen_name'] = $screenname;
				}
				if ($tweets_count != '') {
					$args['count'] = $tweets_count;
				}
				if ($extend_tweet) {
					$args['tweet_mode'] = 'extended';
				}
				if ($exclude_replies) {
					$args['exclude_replies'] = 'true';
				}

				if (creativity_option('creativity_lazyload_image_banner') == true) {
					$image_src = 'src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src';
				  $image_lazyclass = 'load_on_click ' . creativity_option('creativity_lazyload_effect');
				}

        $tweets = $twitter->request('statuses/user_timeline','GET', $args);
        $output = '';

        if (is_array($tweets) && !isset($tweets->errors)) {
            $i = 0;
            $lnk_msg = NULL;


            foreach ($tweets as $tweet) {

                $lnk_page = 'https://twitter.com/' . $screenname;
                $page_name = $tweet->user->name;

								// get full text if extended, or text if default
								if (isset($tweet->full_text)) {
										$msg = $tweet->full_text;
								} else {
									$msg = $tweet->text;
								}

                if (is_array($tweet->entities->urls)) {
                    try {
                        if (array_key_exists('0', $tweet->entities->urls)) {
                            $lnk_msg = $tweet->entities->urls[0]->url;
                        } else {
                            $lnk_msg = NULL;
                        }
                    } catch (Exception $e) {
                        $lnk_msg = NULL;
                    }
                }

								// tweet link
                $lnk_tweet = 'https://twitter.com/' . $screenname . '/status/' . $tweet->id_str;

                /* Tweet Time */
                $time = strtotime($tweet->created_at);
                $delta = abs(time() - $time); /* in seconds */
                $result = '';
                if ($delta < 1) {
                    $result = ' just now';
                } elseif ($delta < 60) {
                    $result = $delta . ' seconds ago';
                } elseif ($delta < 120) {
                    $result = ' about a minute ago';
                } elseif ($delta < (45 * 60)) {
                    $result = ' about ' . round(($delta / 60), 0) . ' minutes ago';
                } elseif ($delta < (2 * 60 * 60)) {
                    $result = ' about an hour ago';
                } elseif ($delta < (24 * 60 * 60)) {
                	$timetext = sprintf( _n( 'an hour', '%s hours', round(($delta / 3600), 0), 'writing' ), round(($delta / 3600), 0)) ;
                    $result = ' about ' . $timetext . ' ago';
                } elseif ($delta < (48 * 60 * 60)) {
                    $result = ' about a day ago';
                } elseif ($delta > (48 * 60 * 60) && $delta < (24 * 60 * 60 * 30)) {
                	$timetext = sprintf( _n( 'a day', '%s days', round(($delta / 86400), 0), 'writing' ), round(($delta / 86400), 0)) ;
                	$result = ' about ' . $timetext . ' ago';
                } elseif ($delta > (24 * 60 * 60 * 30) && $delta < (24 * 60 * 60 * 30 * 12)) {
                	$timetext = sprintf( _n( 'a month', '%s months', round(($delta / 2592000), 0), 'writing' ), round(($delta / 2592000), 0)) ;
                	$result = ' about ' . $timetext . ' ago';
                } elseif ($delta > (24 * 60 * 60 * 30 * 12)) {
                	$timetext = sprintf( _n( 'a year', '%s years', round(($delta / 31104000), 0), 'writing' ), round(($delta / 25920000), 0)) ;
                	$result = ' about ' . $timetext . ' ago';
                }
								// Add images attached to tweet if existed
								if ($include_media) {
									if (isset($tweet->entities->media)) {
											if (array_key_exists('0', $tweet->entities->media)) {
												$img = $tweet->entities->media[0]->media_url_https;
												if (isset($tweet->entities->media[0]->url)) {
													$img_link = $tweet->entities->media[0]->url;
												} else {
													$img_link = $lnk_tweet;
												}
											}
									} else {
										$img = '';
									}
								}

                if ($i >= $tweets_count)
                    break;


                $output .= '<li class="tweet-item">';
                $output .= '<a rel="nofollow noreferrer" target="_blank" href="' . $lnk_tweet . '" class="tweet_icon"><i class="fa fa-twitter"></i></a>';
                $output .= '<a rel="nofollow noreferrer" target="_blank" class="tweet_name" href="' . $lnk_tweet . '">' . $page_name . '</a> ';

                $output .= '<span class="tweet_text">';
                $output .= creativity_make_clickable($msg);
								if (isset($img) && $img != '') {
									$output .= '<a rel="nofollow noreferrer" href="'.$img_link.'" target="_blank">';
										$src = isset($image_src) ? 'src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src' : 'src';
										$class= isset($image_lazyclass) ? 'class="' . $image_lazyclass . '"': '';
										$output .= '<img ' . $src . '="'.$img.'" ' . $class . ' />';
									$output .= '</a>';
								}
                $output .= '</span>';

                $output .= '<div class="tweet_control">';
	                $output .= '<a rel="nofollow noreferrer" href="' . $lnk_tweet . '" target="_blank" class="tweet_time">' . $result . '</a>';

	                $output .= '<span class="tweet_links">';
	                $output .= '<a class="tweet_link tweet_link_reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet->id_str.'"><i class="fa fa-reply"></i></a>';
	                $output .= '<a class="tweet_link tweet_link_retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet->id_str.'"><i class="fa fa-retweet"></i></a>';
	                $output .= '<a class="tweet_link tweet_link_retweet" href="https://twitter.com/intent/favorite?tweet_id='.$tweet->id_str.'"><i class="fa fa-star"></i></a>';
	                $output .= '</span>';
                $output .= '</div>'; // end tweet_control

	            $output .= '</li>';


              $i++;
            } /* foreach */



            if (!empty($output)) {
							$output = "<ul>" . $output . "</ul>";
							$output .= '<script>jQuery(document).ready(function() {window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if (d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));});</script>';
            } else {
							$output = __("No Tweets!", 'writing-core');
						}
						return $output;
        } else {
            if (isset($tweets->errors)):
                $output .= '<span class="tweet_error">Message: ' . $tweets->errors[0]->message . ', Please check your Twitter Authentication Data or internet connection.</span>';
            else:
                $output .= '<span class="tweet_error">Please check your internet connection.</span>';
            endif;

            if (!empty($output)) {
                return $output;
            }
        }
    }
}
endif;
