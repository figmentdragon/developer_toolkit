<?php
/**
 * Custom Controls
 *
 * @package THEMENAME
 */

/**
 * Add Custom Controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function custom_controls( $wp_customize ) {
	// Custom control for Important Links.
	class Important_Links_Control extends WP_Customize_Control {
		public $type = 'important-links';

		public function render_content() {
			// Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links.
			$important_links = array(
				'theme_instructions' => array(
					'link'  => esc_url( 'https://catchthemes.com/THEMENAME-pro/#theme-instructions' ),
					'text'  => esc_html__( 'Theme Instructions', 'TheThemeName' ),
					),
				'support' => array(
					'link'  => esc_url( 'https://catchthemes.com/support/' ),
					'text'  => esc_html__( 'Support', 'TheThemeName' ),
					),
				'changelog' => array(
					'link'  => esc_url( 'https://catchthemes.com/changelogs/THEMENAME-theme/' ),
					'text'  => esc_html__( 'Changelog', 'TheThemeName' ),
					),
				'facebook' => array(
					'link'  => esc_url( 'https://www.facebook.com/catchthemes/' ),
					'text'  => esc_html__( 'Facebook', 'TheThemeName' ),
					),
				'twitter' => array(
					'link'  => esc_url( 'https://twitter.com/catchthemes/' ),
					'text'  => esc_html__( 'Twitter', 'TheThemeName' ),
					),
				'gplus' => array(
					'link'  => esc_url( 'https://plus.google.com/+Catchthemes/' ),
					'text'  => esc_html__( 'Google+', 'TheThemeName' ),
					),
				'pinterest' => array(
					'link'  => esc_url( 'http://www.pinterest.com/catchthemes/' ),
					'text'  => esc_html__( 'Pinterest', 'TheThemeName' ),
					),
			);

			foreach ( $important_links as $important_link ) {
				echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . $important_link['text'] . ' </a></p>';
			}
		}
	}

	// Custom control for dropdown category multiple select.
	class Multi_Cat extends WP_Customize_Control {
		public $type = 'dropdown-categories';

		public function render_content() {
			$dropdown = wp_dropdown_categories(
				array(
					'name'             => $this->id,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_none' => false,
					'hide_if_empty'    => false,
					'show_option_all'  => esc_html__( 'All Categories', 'TheThemeName' ),
				)
			);

			$dropdown = str_replace( '<select', '<select multiple = "multiple" style = "height:150px;" ' . $this->get_link(), $dropdown );

			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);

			echo '<p class="description">' . esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'TheThemeName' ) . '</p>';
		}
	}

	// Custom control for dropdown Jetpack Portfolio Type taxonomy multiple select.
	class Multi_Cat_Project_Type extends WP_Customize_Control {
		public $type = 'dropdown-project-types';

		public function render_content() {
			$taxonomy = 'jetpack-portfolio-type';

			if ( ! taxonomy_exists( $taxonomy ) ) {
				echo '<p class="description">' . esc_html__( 'CPT Project Type does not exist. Make sure Essential Content Types plugin is activated with Portfolio CPT enabled.', 'TheThemeName' ) . '</p>';

				return;
			}

			$dropdown = wp_dropdown_categories(
				array(
					'name'             => $this->id,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_none' => false,
					'hide_if_empty'    => false,
					'show_option_all'  => esc_html__( 'All Categories', 'TheThemeName' ),
					'taxonomy'         => $taxonomy,

				)
			);

			$dropdown = str_replace( '<select', '<select multiple = "multiple" style = "height:150px;" ' . $this->get_link(), $dropdown );

			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);

			echo '<p class="description">' . esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'TheThemeName' ) . '</p>';
		}
	}

	// Custom control for any note, use label as output description.
	class Note_Control extends WP_Customize_Control {
		public $type = 'description';

		public function render_content() {
			echo '<h2 class="description">' . $this->label . '</h2>';
		}
	}

	class Sortable_Custom_Control extends WP_Customize_Control {
		public $type = 'sortable';

		public $sortable_sections =array();

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 * @uses WP_Customize_Control::__construct()
		 *
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
		 * @param string               $id      Control ID.
		 * @param array                $args    Optional. Arguments to override class property defaults.
		 */
		public function __construct( $manager, $id, $args = array() ) {

			// Calls the parent __construct
			parent::__construct( $manager, $id, $args );

			// Set Sortable Sections
			$sortable_sections = get_sortable_sections();
			$this->sortable_sections = apply_filters( 'customizer_sortable_sections', $sortable_sections, $id );

		}

		/**
		* Render the control's content.
		*/
		public function render_content() {
			$sortable_sections = $this->sortable_sections;
			$sortable_sections = array_merge( array_flip( explode( ',', $this->value() ) ), $sortable_sections );
		?>
			<ul class="custom-sortable">
				<?php
				foreach ( $sortable_sections as $key => $value ) {
					echo '<li id="' . esc_attr( $key ) . '" >';
					echo '<span class="label">' . esc_html( $value['label'] ) . '</span>';
					if ( isset( $value['section'] ) ) {
						echo '<a href="javascript:wp.customize.section( \'' . esc_attr( $value['section'] ) . '\' ).focus();">' . esc_html__( 'Edit', 'TheThemeName' ) . '</a>';
					}
					echo '</li>';
				}
			    ?>
			</ul>

			<input id="sortable_value" type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
		<?php
		}
	}

	class Toggle_Control extends WP_Customize_Control {
		public $type = 'light';

		/**
		 * Render the control's content.
		 */
		public function render_content() {
			?>
			<label>
				<div style="display:flex;flex-direction: row;justify-content: flex-start;">
					<span class="customize-control-title" style="flex: 2 0 0; vertical-align: middle;"><?php echo esc_html( $this->label ); ?></span>
					<input id="cb<?php echo esc_attr( $this->instance_number ); ?>" type="checkbox" class="tgl tgl-<?php echo $this->type; ?>" value="<?php echo esc_attr( $this->value() ); ?>"
											<?php
											$this->link();
											checked( $this->value() );
											?>
					 />
					<label for="cb<?php echo $this->instance_number; ?>" class="tgl-btn"></label>
				</div>
				<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php endif; ?>
			</label>
			<?php
		}
	}
}
add_action( 'customize_register', 'custom_controls', 1 );

function enqueue_customizer_control_js() {
	wp_register_script( 'live-preview', THEME_DIR . '/inc/customizer/controls/js/customizer-live-preview.js' );

	wp_register_script( 'input-slider', THEME_DIR . '/inc/customizer/controls/js/input-slider.js' );

	wp_register_script( 'padding', THEME_DIR . '/inc/customizer/controls/js/padding.js' );

	wp_register_script( 'responsive-input-slider', THEME_DIR . '/inc/customizer/controls/js/responsive-input-slider.js' );

	wp_register_script( 'responsive-input', THEME_DIR . '/inc/customizer/controls/js/responsive-input.js' );

	wp_register_script( 'responsive-padding', THEME_DIR . '/inc/customizer/controls/js/responsive-padding.js' );

	wp_register_script( 'slider-control', THEME_DIR . '/inc/customizer/controls/js/slider-control.js' );

	wp_register_script( 'typography-customizer', THEME_DIR . '/inc/customizer/controls/js/typography-customizer.js' );

	wp_enqueue_script( 'live-preview' );
	wp_enqueue_script( 'input-slider' );
	wp_enqueue_script( 'padding' );
	wp_enqueue_script( 'responsive-input-slider' );
	wp_enqueue_script( 'responsive-input' );
	wp_enqueue_script( 'responsive-padding' );
	wp_enqueue_script( 'slider-control' );
	wp_enqueue_script( 'typography-customizer' );
}
add_action( 'customize_register', 'enqueue_customizer_control_js' );

function enqueue_customizer_control_css() {
	wp_register_style( 'input-slider', THEME_DIR . '/inc/customizer/controls/css/input-slider.css' );

	wp_register_style( 'slider-customizer', THEME_DIR . '/inc/customizer/controls/css/slider-customizer.css' );

	wp_register_style( 'typography-customizer', THEME_DIR . '/inc/customizer/controls/css/typography-customizer.css' );

	wp_enqueue_style( 'input-slider' );
	wp_enqueue_style( 'slider-customizer' );
	wp_enqueue_style( 'typography-customizer' );
}
add_action( 'customizer_register', 'enqueue_customizer_cotnrol_css' );

require THEME_DIR . '/inc/customizer/controls/class-range-control.php';

require THEME_DIR . '/inc/customizer/controls/class-typography-control.php';

require THEME_DIR . '/inc/customizer/controls/color-scheme.php';

require THEME_DIR . '/inc/customizer/controls/headline-control.php';
