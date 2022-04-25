<?php

/*

	Custom Widget Template
	by Matt Vickers - http://envexlabs.com

	Usage

	Step 1: Change any values you may need to change

	Step 2: Include this file in your functions.php file. ex: include TEMPLATEPATH . '/custom_widget.php';

	Step 3: Impress your friends
*/

class Custom_Widget extends WP_Widget {

	function Custom_Widget() {
		$widget_ops = array('classname' => 'custom_widget', 'description' => 'Just a custom widget. Move along.' );
		$this->WP_Widget('custom_widget', 'Custom Widget', $widget_ops);
	}

	function widget($args, $instance) {

		/*

			Your variables from form() are automatically added to the $instance variable
			just use the array values when echoing out the HTML
		*/

		echo '<h3>' . $instance['title'] . '</h3>';

		echo '<p>' . $instance['text'] . '</p>';

	}

	function form($instance) {

		/*

			If you're going to add inputs to your widget, just use the code below as a template
			of what to do to add an input.

			1. Add to $instance
			2. Create a new variable
			3. Add the HTML
		*/

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '') );
		$title = strip_tags($instance['title']);
		$entry_title = strip_tags($instance['text']); ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('text'); ?>">Text: <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo attribute_escape($entry_title); ?></textarea></label></p>

	<?php

	}

	/*

		Nothing to edit below here
	*/

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		return $instance;
	}

}

register_widget('Custom_Widget');
