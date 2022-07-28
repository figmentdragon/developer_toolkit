<?php
/************************************************/
## About me custom widget.
/************************************************/
class aboutme_widget extends WP_Widget {

	public function __construct() {
		parent::__construct('about', /* Unique widget ID */
			esc_html__('THEMENAEs - About Me', 'TheThemeName'), /* Widget title display in widget area. */
			array( 'description' => esc_html__( 'About me widget content.', 'TheThemeName' ), ) /* Widget description */
		);

		add_action( 'admin_enqueue_scripts', array($this, 'scripts') );
	}

	/**********************************************/
	## Creating widget front-end
	## This is where the action happens
	/*********************************************/
	public function widget( $args, $instance ) {

		$title = isset($instance['title']) ? esc_html($instance['title']) : '';
		$author_name = isset($instance['author_name']) ? esc_html($instance['author_name']) : '';
		$author_description = isset($instance['author_description']) ? esc_html($instance['author_description']) : '';

		$author_image = isset($instance['author_image']) ? esc_url($instance['author_image']) : '';

		echo $args['before_widget']; /* before and after widget arguments are defined by themes */
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];


		/* This is where you run the code and display the output */
		echo'<div class="author">';
			if($author_image != ''):
			echo '<div class="author-image"><img src="'.$author_image.'" alt="'.$author_name.'"></div>';
			endif;
			echo '
			<div class="author-meta">
				<h6 class="author-name">'.$author_name.'</h6>
				<p class="author-desc">'.$author_description.'</p>
			</div>
		</div>';
		echo $args['after_widget'];
	}

	/****************************************/
	## Widget Backend
	/****************************************/

	public function form( $instance ) {

		$title = isset( $instance[ 'title' ] ) ? esc_attr($instance[ 'title' ]) : '';
		$author_name = isset( $instance[ 'author_name' ] ) ? esc_attr($instance[ 'author_name' ]) : '';
		$author_image = isset( $instance[ 'author_image' ] ) ? esc_url($instance['author_image']) : '';
		$author_description = isset( $instance[ 'author_description' ] ) ? esc_attr($instance['author_description']) : '';


		/* Widget admin form */
	?>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title', 'TheThemeName' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'author_name' )); ?>"><?php esc_html_e( 'Author Name', 'TheThemeName' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'author_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'author_name' )); ?>" type="text" value="<?php echo $author_name; ?>" />
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'author_image' )); ?>"><?php esc_html_e( 'Upload Author Image', 'TheThemeName' ); ?></label>
		<div class="cta-author-image">
			<?php $cta_img = isset($author_image) ? '' : 'display:none;'; ?>
				<img id="<?php echo $this->get_field_id('author_image'); ?>-preview" src="<?php echo esc_attr($author_image); ?>" style="margin:5px 0;padding:0;max-width:180px;height:auto;<?php echo $cta_img; ?>" />
			<?php $cta_no_img = isset($instance[ 'author_image' ]) ? 'style="display:none;"' : ''; ?>
		</div>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'author_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'author_image' )); ?>" type="text" value="<?php echo $author_image; ?>" style="display: none"/>

		<input type="button" value="<?php echo esc_attr(__('Select Image', 'TheThemeName')); ?>" name="<?php echo $this->get_field_name('author_image'); ?>" class="button button-primary media-upload" id="<?php echo $this->get_field_id('author_image'); ?>-button" />
		<br class="clear">
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'author_description')); ?>"><?php esc_html_e( 'Description', 'TheThemeName' ); ?></label>
		<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'author_description')); ?>" name="<?php echo esc_attr($this->get_field_name( 'author_description' )); ?>"><?php echo $author_description; ?></textarea>
	</p>


	<?php

	}

	/**********************************************************/
	## Updating widget replacing old instances with new.
	/**********************************************************/

	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = isset( $new_instance['title'] ) ? esc_html( $new_instance['title'] ) : '';

		$instance['author_name'] = isset( $new_instance['author_name'] ) ? esc_html( $new_instance['author_name'] ) : '';


		$instance['author_description'] = isset( $new_instance['author_description'] ) ? esc_html( $new_instance['author_description'] ) : '';

		$instance['author_image'] = isset( $new_instance['author_image'] ) ? esc_url( $new_instance['author_image'] ) : '';


		return $instance;
	}

	public function scripts() {
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_media();
		wp_enqueue_script('widget_admin', TEMPLATE_DIRECTORY_URI . '/assets/scripts/js/admin/about-me.js', array('jquery'));
	}
} /* class end */

// Register and load the widget
function load_aboutme_widget() {
	register_widget( 'aboutme_widget' );
}

add_action( 'widgets_init', 'load_aboutme_widget' );

?>
