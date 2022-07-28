<?php
add_action('widgets_init', 'tweets_widget_init');

function tweets_widget_init() {
    register_widget('tweets_widget');
}

class tweets_widget extends WP_Widget {


    function __construct() {
		parent::__construct(
			'tweets-widget', // Base ID
			'Creativity - Tweets', // Name
			array(
            'description' => '',
            'classname' => 'creativity-tweets-widget',
            'width' => 250,
            'height' => 350,
            'customize_selective_refresh' => true,
           ) // Args
		);
	}


    function widget($args, $instance) {
        extract($args);

        global $creativity_data;

        $title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : '' ;
        $username = isset( $instance['username'] ) ? $instance['username'] : '' ;
        $number = isset( $instance['number'] ) ? $instance['number'] : 2 ;
        $include_media = isset( $instance['include_media'] ) ? $instance['include_media'] : false ;
        $extend_tweet = isset( $instance['extend_tweet'] ) ? $instance['extend_tweet'] : false ;
        $exclude_replies = isset( $instance['exclude_replies'] ) ? $instance['exclude_replies'] : false ;

        echo $before_widget;

        if ($title) :
            echo $before_title;
            echo $title;
            echo $after_title;
        endif;

        $consumerkey = creativity_option('creativity_conk_id');
        $consumersecret = creativity_option('creativity_cons_id');
        $accesstoken = creativity_option('creativity_at_id');
        $accesstokensecret = creativity_option('creativity_ats_id');

				$query = '&';
				$query .= 'username=' . $username;
				$query .= '&';
				$query .= 'number=' . $number;
				$query .= '&';
				$query .= 'include_media=' . $include_media;
				$query .= '&';
				$query .= 'extend_tweet=' . $extend_tweet;
				$query .= '&';
				$query .= 'exclude_replies=' . $exclude_replies;
				$lazyload_image = false;
				if (creativity_option('creativity_lazyload_iframe_banner') == true) {
					$lazyload_image = true;
				}

				?>
				<div class="writing_tweets_widget<?php echo $widget_id; if (isset($lazyload_image)) { echo ' lazyload'; } ?>" data-lazyscript="<?php echo $widget_id; ?>"></div>

				<script type="text/javascript">
					jQuery(window).on('load', function(){
						<?php if ($lazyload_image) : ?>
							document.addEventListener('lazybeforeunveil', function(e){
					    var lazyscript = e.target.getAttribute('data-lazyscript');
							if (lazyscript == '<?php echo $widget_id; ?>') {
						<?php endif; ?>
						jQuery.ajax({
							url: '<?php echo WRITING_CORE_URL . 'twitter/twitter-feed-ajax.php'; ?>',
							type: 'POST',
							data: 'action=loadposts<?php echo $query; ?>',
							success: function (html) {
								jQuery('.writing_tweets_widget<?php echo $widget_id; ?>').html(html);
							}
						});
						<?php if ($lazyload_image) : ?>
								}
							});
						<?php endif; ?>
					});
				</script>
				<?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['username'] = $new_instance['username'];
        $instance['number'] = $new_instance['number'];
        $instance['include_media'] = $new_instance['include_media'];
        $instance['extend_tweet'] = $new_instance['extend_tweet'];
        $instance['exclude_replies'] = $new_instance['exclude_replies'];
        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => __('Tweets', 'writing'), 'username' => '', 'number' => '', 'include_media' => false, 'extend_tweet' => false, 'exclude_replies' => false);
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'writing'); ?>: </label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username', 'writing'); ?>: </label>
            <input id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>" type="text" size="3" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number Of Posts (Including Replies and retweets)', 'writing'); ?>: </label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" type="text" size="3" />
        </p>
        <p>
          <input class="checkbox" id="<?php echo $this->get_field_id( 'include_media' ); ?>" name="<?php echo $this->get_field_name( 'include_media' ); ?>" type="checkbox" <?php checked( $instance[ 'include_media' ], 'on' ); ?> />
          <label for="<?php echo $this->get_field_id('include_media'); ?>"> <?php _e('Include tweet image', 'writing'); ?></label>
        </p>
        <p>
          <input class="checkbox" id="<?php echo $this->get_field_id( 'extend_tweet' ); ?>" name="<?php echo $this->get_field_name( 'extend_tweet' ); ?>" type="checkbox" <?php checked( $instance[ 'extend_tweet' ], 'on' ); ?> />
          <label for="<?php echo $this->get_field_id('extend_tweet'); ?>"> <?php _e('Show Full Tweet', 'writing'); ?></label>
        </p>
        <p>
          <input class="checkbox" id="<?php echo $this->get_field_id( 'exclude_replies' ); ?>" name="<?php echo $this->get_field_name( 'exclude_replies' ); ?>" type="checkbox" <?php checked( $instance[ 'exclude_replies' ], 'on' ); ?> />
          <label for="<?php echo $this->get_field_id('exclude_replies'); ?>"> <?php _e('Exclude Replies', 'writing'); ?></label>
        </p>
        <?php
    }

}
?>