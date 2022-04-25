<?php
/**
 * Pricing Widget
 *
 * @package themename
 */

add_action('widgets_init', 'themename_register_pricing_widget');

function themename_register_pricing_widget() {
    register_widget('themename_pricing');
}

class themename_Pricing extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'themename_pricing', 'AP : Pricing Table', array(
                'description' => __('A widget that shows Pricing Table', 'themename')
            )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            // This widget has no title
            // Other fields
            'pricing_plan' => array(
                'themename_widgets_name' => 'pricing_plan',
                'themename_widgets_title' => __('Plan Name', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_plan_sub_text' => array(
                'themename_widgets_name' => 'pricing_plan_sub_text',
                'themename_widgets_title' => __('Sub Text', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_price_currency' => array(
                'themename_widgets_name' => 'pricing_price_currency',
                'themename_widgets_title' => __('Currency', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),

            'pricing_price' => array(
                'themename_widgets_name' => 'pricing_price',
                'themename_widgets_title' => __('Price', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_price_decimal' => array(
                'themename_widgets_name' => 'pricing_price_decimal',
                'themename_widgets_title' => __('Decimal Value', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_price_per' => array(
                'themename_widgets_name' => 'pricing_price_per',
                'themename_widgets_title' => __('Price Per', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature1' => array(
                'themename_widgets_name' => 'pricing_feature1',
                'themename_widgets_title' => __('Feature 1', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature1_font_a' => array(
                'themename_widgets_name' => 'pricing_feature1_font_a',
                'themename_widgets_title' => __('Feature 1 Font Awesome', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature2' => array(
                'themename_widgets_name' => 'pricing_feature2',
                'themename_widgets_title' => __('Feature 2', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature2_font_a' => array(
                'themename_widgets_name' => 'pricing_feature2_font_a',
                'themename_widgets_title' => __('Feature 2 Font Awesome', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature3' => array(
                'themename_widgets_name' => 'pricing_feature3',
                'themename_widgets_title' => __('Feature 3', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature3_font_a' => array(
                'themename_widgets_name' => 'pricing_feature3_font_a',
                'themename_widgets_title' => __('Feature 3 Font Awesome', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature4' => array(
                'themename_widgets_name' => 'pricing_feature4',
                'themename_widgets_title' => __('Feature 4', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature4_font_a' => array(
                'themename_widgets_name' => 'pricing_feature4_font_a',
                'themename_widgets_title' => __('Feature 4 Font Awesome', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature5' => array(
                'themename_widgets_name' => 'pricing_feature5',
                'themename_widgets_title' => __('Feature 5', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature5_font_a' => array(
                'themename_widgets_name' => 'pricing_feature5_font_a',
                'themename_widgets_title' => __('Feature 5 Font Awesome', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature6' => array(
                'themename_widgets_name' => 'pricing_feature6',
                'themename_widgets_title' => __('Feature 6', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_feature6_font_a' => array(
                'themename_widgets_name' => 'pricing_feature6_font_a',
                'themename_widgets_title' => __('Feature 6 Font Awesome', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),

            'pricing_desc' => array(
                'themename_widgets_name' => 'pricing_desc',
                'themename_widgets_title' => __( 'Description', 'themename' ),
                'themename_widgets_field_type' => 'textarea',
                'themename_widgets_row' => '6'
            ),
            'pricing_button_text' => array(
                'themename_widgets_name' => 'pricing_button_text',
                'themename_widgets_title' => __('Button Text', 'themename'),
                'themename_widgets_desc' => __('Leave Empty not to show', 'themename'),
                'themename_widgets_field_type' => 'text',
            ),
            'pricing_button_link' => array(
                'themename_widgets_name' => 'pricing_button_link',
                'themename_widgets_title' => __('Button Link', 'themename'),
                'themename_widgets_field_type' => 'url',
            ),
            'pricing_featured' => array(
                'themename_widgets_name' => 'pricing_featured',
                'themename_widgets_title' => __('Featured', 'themename'),
                'themename_widgets_field_type' => 'checkbox',
            ),
        );

        return $fields;
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

        $pricing_plan = isset( $instance['pricing_plan'] ) ? esc_attr($instance['pricing_plan']) : '';
        $pricing_plan_sub_text = isset($instance['pricing_plan_sub_text']) ? esc_attr($instance['pricing_plan_sub_text']) : '';
        $pricing_price_currency = isset($instance['pricing_price_currency']) ? esc_attr($instance['pricing_price_currency']) : '';
        $pricing_price = isset($instance['pricing_price']) ? esc_attr($instance['pricing_price']) : '';
        $pricing_price_decimal = isset($instance['pricing_price_decimal']) ? esc_attr($instance['pricing_price_decimal']) : '';
        $pricing_price_per = isset($instance['pricing_price_per']) ? esc_attr($instance['pricing_price_per']) : '';
        $pricing_feature1 = isset($instance['pricing_feature1']) ? esc_attr($instance['pricing_feature1']) : '';
        $pricing_feature1_a = isset($instance['pricing_feature1_font_a']) ? esc_attr($instance['pricing_feature1_font_a']) : '';
        $pricing_feature2 = isset($instance['pricing_feature2']) ? esc_attr($instance['pricing_feature2']) : '';
        $pricing_feature2_a = isset($instance['pricing_feature2_font_a']) ? esc_attr($instance['pricing_feature2_font_a']) : '';
        $pricing_feature3 = isset($instance['pricing_feature3']) ? esc_attr($instance['pricing_feature3']) : '';
        $pricing_feature3_a = isset($instance['pricing_feature3_font_a']) ? esc_attr($instance['pricing_feature3_font_a']) : '';
        $pricing_feature4 = isset($instance['pricing_feature4']) ? esc_attr($instance['pricing_feature4']) : '';
        $pricing_feature4_a = isset($instance['pricing_feature4_font_a']) ? esc_attr($instance['pricing_feature4_font_a']) : '';
        $pricing_feature5 = isset($instance['pricing_feature5']) ? esc_attr($instance['pricing_feature5']) : '';
        $pricing_feature5_a = isset($instance['pricing_feature5_font_a']) ? esc_attr($instance['pricing_feature5_font_a']) : '';
        $pricing_feature6 = isset($instance['pricing_feature6']) ? esc_attr($instance['pricing_feature6']) : '';
        $pricing_feature6_a = isset($instance['pricing_feature6_font_a']) ? esc_attr($instance['pricing_feature6_font_a']) : '';
        $pricing_desc = isset($instance['pricing_desc']) ? esc_attr($instance['pricing_desc']) : '';
        $pricing_button_text = isset($instance['pricing_button_text']) ? esc_attr($instance['pricing_button_text']) : '';
        $pricing_button_link = isset($instance['pricing_button_link']) ? esc_attr($instance['pricing_button_link']) : '';
        $pricing_featured = isset($instance['pricing_featured']) ? esc_attr($instance['pricing_featured']) : '';

        echo wp_kses_post($before_widget);
        ?>
        <div class="wow fadeInUp ap-pricing-table <?php if( !empty( $pricing_featured ) ) { echo 'feat-tble';} ?>">
            <div class="ap-pricing-head">
                <?php if (!empty($pricing_plan)): ?>
                    <h2>
                        <?php echo esc_html($pricing_plan); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($pricing_plan_sub_text)): ?>
                    <div class="ap-pricing-plan-sub-text"><?php echo esc_html($pricing_plan_sub_text); ?></div>
                <?php endif; ?>


            </div>

            <div class="ap-price-box">
                <?php if (!empty($pricing_price)): ?>
                    <div class="ap-pricing-plan">
                        <?php if( !empty( $pricing_price_currency )) { echo  '<span class="currency">'.esc_html($pricing_price_currency).'</span>'; } ?><?php echo esc_html($pricing_price); ?>
                        <?php if( !empty( $pricing_price_decimal ) ) { echo  '<span class="dec-value">'.esc_html($pricing_price_decimal).'</span>'; }?>
                    </div>
                    <div class="ap-per"><?php echo esc_html($pricing_price_per); ?></div>
                <?php endif; ?>

                <?php if (!empty($pricing_button_text)): ?>
                    <div class="ap-pricing-readmore"><a class="bttn" href="<?php echo esc_url($pricing_button_link); ?>"><?php echo esc_html($pricing_button_text); ?></a></div>
                <?php endif; ?>

            </div>

            <div class="ap-pricing-features">
                <ul class="ap-pricing-features-inner">
                    <?php if (!empty($pricing_feature1)): ?>
                        <li><span><?php if( !empty( $pricing_feature1_a ) ) { echo '<i class="'.esc_attr($pricing_feature1_a).'"></i>';}?></span><?php echo esc_html($pricing_feature1); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature2)): ?>
                        <li><span><?php if( !empty( $pricing_feature2_a ) ) { echo '<i class="'.esc_attr($pricing_feature2_a).'"></i>';}?></span><?php echo esc_html($pricing_feature2); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature3)): ?>
                        <li><span><?php if( !empty( $pricing_feature3_a ) ) { echo '<i class="'.esc_attr($pricing_feature3_a).'"></i>';}?></span><?php echo esc_html($pricing_feature3); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature4)): ?>
                        <li><span><?php if( !empty( $pricing_feature4_a ) ) { echo '<i class="'.esc_attr($pricing_feature4_a).'"></i>';}?></span><?php echo esc_html($pricing_feature4); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature5)): ?>
                        <li><span><?php if( !empty( $pricing_feature5_a ) ) { echo '<i class="'.esc_attr($pricing_feature5_a).'"></i>';}?></span><?php echo esc_html($pricing_feature5); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature6)): ?>
                        <li><span><?php if( !empty( $pricing_feature6_a ) ) { echo '<i class="'.esc_attr($pricing_feature6_a).'"></i>';}?></span><?php echo esc_html($pricing_feature6); ?></li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="ap-pricing-desc">
                <?php  if( !empty( $pricing_desc ) ): ?>
                    <p><?php echo esc_textarea($pricing_desc); ?></p>
                <?php  endif; ?>
            </div>


        </div>
        <?php
        echo wp_kses_post($after_widget);
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	themename_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$themename_widgets_name] = themename_widgets_updated_field_value($widget_field, $new_instance[$themename_widgets_name]);
        }

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
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $themename_widgets_field_value = !empty($instance[$themename_widgets_name]) ? esc_attr($instance[$themename_widgets_name]) : '';
            themename_widgets_show_widget_field($this, $widget_field, $themename_widgets_field_value);
        }
    }

}
