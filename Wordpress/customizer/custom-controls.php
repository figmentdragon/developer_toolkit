<?php
/**
 * Custom Controls
 *
 * @package themename
 */

/**
 * Add Custom Controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themename_custom_controls( $wp_customize ) {
	// Custom control for Important Links.
	class themename_Important_Links_Control extends WP_Customize_Control {
		public $type = 'important-links';

		public function render_content() {
			// Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links.
			$important_links = array(
				'theme_instructions' => array(
					'link'  => esc_url( 'https://catchthemes.com/themename-pro/#theme-instructions' ),
					'text'  => esc_html__( 'Theme Instructions', 'themename' ),
					),
				'support' => array(
					'link'  => esc_url( 'https://catchthemes.com/support/' ),
					'text'  => esc_html__( 'Support', 'themename' ),
					),
				'changelog' => array(
					'link'  => esc_url( 'https://catchthemes.com/changelogs/themename-theme/' ),
					'text'  => esc_html__( 'Changelog', 'themename' ),
					),
				'facebook' => array(
					'link'  => esc_url( 'https://www.facebook.com/catchthemes/' ),
					'text'  => esc_html__( 'Facebook', 'themename' ),
					),
				'twitter' => array(
					'link'  => esc_url( 'https://twitter.com/catchthemes/' ),
					'text'  => esc_html__( 'Twitter', 'themename' ),
					),
				'gplus' => array(
					'link'  => esc_url( 'https://plus.google.com/+Catchthemes/' ),
					'text'  => esc_html__( 'Google+', 'themename' ),
					),
				'pinterest' => array(
					'link'  => esc_url( 'http://www.pinterest.com/catchthemes/' ),
					'text'  => esc_html__( 'Pinterest', 'themename' ),
					),
			);

			foreach ( $important_links as $important_link ) {
				echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . $important_link['text'] . ' </a></p>';
			}
		}
	}

	// Custom control for dropdown category multiple select.
	class themename_Multi_Cat extends WP_Customize_Control {
		public $type = 'dropdown-categories';

		public function render_content() {
			$dropdown = wp_dropdown_categories(
				array(
					'name'             => $this->id,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_none' => false,
					'hide_if_empty'    => false,
					'show_option_all'  => esc_html__( 'All Categories', 'themename' ),
				)
			);

			$dropdown = str_replace( '<select', '<select multiple = "multiple" style = "height:150px;" ' . $this->get_link(), $dropdown );

			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);

			echo '<p class="description">' . esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'themename' ) . '</p>';
		}
	}

	// Custom control for dropdown Jetpack Portfolio Type taxonomy multiple select.
	class themename_Multi_Cat_Project_Type extends WP_Customize_Control {
		public $type = 'dropdown-project-types';

		public function render_content() {
			$taxonomy = 'jetpack-portfolio-type';

			if ( ! taxonomy_exists( $taxonomy ) ) {
				echo '<p class="description">' . esc_html__( 'CPT Project Type does not exist. Make sure Essential Content Types plugin is activated with Portfolio CPT enabled.', 'themename' ) . '</p>';

				return;
			}

			$dropdown = wp_dropdown_categories(
				array(
					'name'             => $this->id,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_none' => false,
					'hide_if_empty'    => false,
					'show_option_all'  => esc_html__( 'All Categories', 'themename' ),
					'taxonomy'         => $taxonomy,

				)
			);

			$dropdown = str_replace( '<select', '<select multiple = "multiple" style = "height:150px;" ' . $this->get_link(), $dropdown );

			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);

			echo '<p class="description">' . esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'themename' ) . '</p>';
		}
	}

	// Custom control for any note, use label as output description.
	class themename_Note_Control extends WP_Customize_Control {
		public $type = 'description';

		public function render_content() {
			echo '<h2 class="description">' . $this->label . '</h2>';
		}
	}

	class themename_Sortable_Custom_Control extends WP_Customize_Control {
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
			$sortable_sections = themename_get_sortable_sections();
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
						echo '<a href="javascript:wp.customize.section( \'' . esc_attr( $value['section'] ) . '\' ).focus();">' . esc_html__( 'Edit', 'themename' ) . '</a>';
					}
					echo '</li>';
				}
			    ?>
			</ul>

			<input id="themename_sortable_value" type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
		<?php
		}
	}

	class themename_Toggle_Control extends WP_Customize_Control {
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
add_action( 'customize_register', 'themename_custom_controls', 1 );
