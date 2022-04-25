<?php

/**
 *  Call to Action Widget
 *
 * I only have 3 word for you:
 * A. Always
 * B. BE
 * C. Closing
 *
 */

 add_action('widgets_init', 'themename_register_cta_simple_widget');

 function themename_register_cta_simple_widget() {
     register_widget('call_to_action_widget');
 }

class Call_To_Action_Widget extends WP_Widget {
  /**
   * Register widget with WordPress.
   */
    public function __construct() {
        parent::__construct(
                'call_to_action_widget', // Root id for all widgets of this type.
                __('Call to Action Widget', 'themename'), // Name for this widget type.
                array('description' => __('A text widget with a Call to Action button.', 'themename'),)// Option array passed to wp_register_sidebar_widget()
        );
    }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $content = apply_filters('widget_content', $instance['content']);
        $button_text = apply_filters('widget_button_text', $instance['button_text']);
        $button_link = apply_filters('widget_button_link', $instance['button_link']);
        $before_widget = $before_widget . '<div class="widget call2action">';
        $after_widget = '</div>' . $after_widget;

        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        echo wpautop($content);
        echo '<a href="' . $button_link . '" class="button">' . $button_text . '</a>';
        echo $after_widget;
    }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param	array	$new_instance	Values just sent to be aved.
   * @param	array	$old_instance	Previously saved values from database.
   *
   * @uses	themename_widgets_updated_field_value()		defined in widget-fields.php
   *
   * @return	array Updated safe values to be saved.
   */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = $new_instance['title'];
        $instance['content'] = $new_instance['content'];
        $instance['button_text'] = $new_instance['button_text'];
        $instance['button_link'] = $new_instance['button_link'];

        return $instance;
    }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param	array $instance Previously saved values from database.
   *
   * @uses	themename_widgets_show_widget_field()		defined in widget-fields.php
   */
    public function form($instance) {

        $title = isset($instance['title']) ? $instance['title'] : '';
        $content = isset($instance['content']) ? $instance['content'] : '';
        $button_text = isset($instance['button_text']) ? $instance['button_text'] : __('Click Here', 'themename');
        $button_link = isset($instance['button_link']) ? $instance['button_link'] : __('#', 'themename');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'themename'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:', 'themename'); ?></label>
            <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo esc_attr($content); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text:', 'themename'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Button Link:', 'themename'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo esc_attr($button_link); ?>" />
        </p>
        <?php
    }

  /**
   * Helper function that holds widget fields
   * Array is used in update and form functions
   */
    private function widget_fields() {
      $fields = array(
        'cta_simple_title' => array(
          'themename_widgets_name' => 'cta_simple_title',
          'themename_widgets_title' => __('Title', 'themename'),
          'themename_widgets_field_type' => 'text',
        ),
        'cta_simple_btn_text' => array(
          'themename_widgets_name' => 'cta_simple_btn_text',
          'themename_widgets_title' => __('Button Text', 'themename'),
          'themename_widgets_field_type' => 'text',
        ),
        'cta_simple_btn_url' => array(
          'themename_widgets_name' => 'cta_simple_btn_url',
          'themename_widgets_title' => __('Button Url', 'themename'),
          'themename_widgets_field_type' => 'text'
        )
      );
    return $fields;
  }
}
