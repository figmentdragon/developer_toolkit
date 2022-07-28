<?php
add_action('widgets_init', 'about_widget_init');
function about_widget_init() {
    register_widget('about_widget');
}

function widgets_script(){
	global $pagenow;
	if (in_array($pagenow, array('widgets.php', 'customize.php'))) {
    wp_enqueue_media();
    wp_enqueue_script('widgets_script', plugin_dir_url( __FILE__ ) . 'widgets.js');
	}
}
add_action('admin_enqueue_scripts', 'widgets_script');

class about_widget extends WP_Widget {

    function __construct() {
		parent::__construct(
			'about-widget', // Base ID
			theme_name . ' - About Me', // Name
			array( 'classname' => 'about-widget',
             'description' => '', 'width' => 250,
             'height' => 350,
             'customize_selective_refresh' => true,
           ) // Args
		);
	}

    function widget($args, $instance) {
        extract($args);

        $title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : '' ;
        $image_shape = isset( $instance['image_shape'] ) ? esc_attr($instance['image_shape']) : 'rounded' ;
        $image_size = isset( $instance['image_size'] ) ? esc_attr($instance['image_size']) : 'default' ;
        $text = isset( $instance['text'] ) ? esc_attr($instance['text']) : '' ;

				$image = isset( $instance['image'] ) ? esc_url($instance['image']) : '' ;

				if ($image != '') {
					if ($image_size == 'small') {
						$image_dimension = 100;
					} else if ($image_size == 'medium') {
						$image_dimension = 150;
					} else if ($image_size == 'large') {
						$image_dimension = 200;
					} else {
						$image_dimension = 275;
					}
					// add_image_size('creativity_about_me_thumb', $image_dimension, $image_dimension, true);
					$image_id = creativity_get_attachment_id_by_url($image);
					$image_url = wp_get_attachment_image_src($image_id, array($image_dimension, $image_dimension));

					if ($image_url != '') {
						$image = $image_url[0];
					}
				}

				if (creativity_option('creativity_lazyload_image_banner') == true) {
					$image_src = 'src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src';
					$image_lazyclass = 'lazyload ' . creativity_option('creativity_lazyload_effect');
				}
				$src = isset($image_src) ? 'src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src' : 'src';
				$class= isset($image_lazyclass) ? 'img-responsive ' . $image_lazyclass : 'img-responsive';

        echo $before_widget;

        if ($title) :
            echo $before_title;
            echo $title;
            echo $after_title;
        endif;


        echo '<div class="creativity_about_me">';
            echo '<div class="author_image_wrapper '.$image_size.' '.$image_shape.'">';
                echo '<img class="' . $class . '" ' . $src . '="'.$image.'" alt="'.$title.'" />';
            echo '</div>';
            echo '<div class="author_text_wrapper">';
                echo '<p>'.do_shortcode(htmlspecialchars_decode($text)).'</p>';
            echo '</div>';
        echo '</div>';


        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['image'] = $new_instance['image'];
        $instance['image_shape'] = $new_instance['image_shape'];
        $instance['image_size'] = $new_instance['image_size'];
        $instance['text'] = $new_instance['text'];
        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => __('About Me', 'writing'), 'image' => '', 'image_shape' => 'rounded', 'image_size' => 'default', 'text' => '');
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'writing'); ?>:</label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
         <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image', 'writing'); ?>:</label><br />
           <img class="custom_media_image" src="<?php if(!empty($instance['image'])){echo $instance['image'];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
           <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" value="<?php echo $instance['image']; ?>">
           <input type="button" value="<?php _e( 'Upload Image', 'writing' ); ?>" class="button custom_media_upload" id="custom_image_uploader"/>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('image_shape'); ?>"><?php _e('Image Shape', 'writing'); ?>: </label>
          <select id="<?php echo $this->get_field_id('image_shape'); ?>" name="<?php echo $this->get_field_name('image_shape'); ?>" >
              <option value="rounded" <?php if ($instance['image_shape'] == 'rounded') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Rounded', 'writing'); ?></option>
              <option value="circle" <?php if ($instance['image_shape'] == 'circle') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Circle', 'writing'); ?></option>
          </select>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('image_size'); ?>"><?php _e('Image Size', 'writing'); ?>: </label>
          <select id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>" >
              <option value="default" <?php if ($instance['image_size'] == 'default') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Default', 'writing'); ?></option>
              <option value="large" <?php if ($instance['image_size'] == 'large') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Large', 'writing'); ?></option>
              <option value="medium" <?php if ($instance['image_size'] == 'medium') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Medium', 'writing'); ?></option>
              <option value="small" <?php if ($instance['image_size'] == 'small') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Small', 'writing'); ?></option>
          </select>
        </p>
        <p>
           <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:', 'writing' ); ?>:</label>
            <textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $instance['text']; ?></textarea>
        </p>
        <?php
    }

}
?>