<?php
/**
 * creativity Theme Customizer
 *
 * @package creativity
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function creativity_customize_register( $wp_customize ) {

	/**
	 * Adds Category dropdown support to theme customizer
	 */
	class creativity_Category_Dropdown_Control extends WP_Customize_Control {
		private $cats = false;

		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			$this->cats = get_categories( $options );
			parent::__construct( $manager, $id, $args );
		}

		public function render_content() {
			if( !empty( $this->cats ) ) {

?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<select <?php $this->link(); ?>>
						<option value="0">&mdash;Select&mdash;</option>
					<?php
					foreach( $this->cats as $cat ) {
						printf( '<option value="%s" %s>%s</option>', esc_attr($cat->term_id), selected( $this->value(), esc_attr($cat->term_id), false) , esc_attr($cat->name) );
					}

					?>
					</select>
				</label>
				<?php
			}

		}

	} // end of class

	/**
	 * Adds info content
	 */
	class creativity_Customize_Info_Control extends WP_Customize_Control {

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<p><?php echo esc_html( $this->value() ); ?></p>
			</label>
		<?php
		}
	}


	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    /** Moving some WordPress default section to 'General Settings' Panel **/
    $wp_customize->remove_section( 'title_tagline' );
    $wp_customize->remove_section( 'colors' );
    $wp_customize->remove_section( 'static_front_page' );

    /*------------------------------------------------------------------------------------*/

    $wp_customize->add_section( 'title_tagline',
        array(
            'title'=>__('Site Identity', 'creativity'), 'panel' => 'creativity_panel_general_settings'
        )
    );

    $wp_customize->add_section( 'colors',
        array(
            'title'=>__('Colors', 'creativity'), 'panel' => 'creativity_panel_general_settings'
        )
    );

    $wp_customize->add_section( 'static_front_page',
        array(
            'title'=>__('Static Front Page', 'creativity'), 'panel' => 'creativity_panel_general_settings'
        )
    );

	$wp_customize->add_section( 'andre_theme_options',
		array(
			'title'    => esc_html__( 'Theme Options', 'andre-lite' ),
			'priority' => 125,
		)
	);

	$wp_customize->add_setting( 'copyright_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( 'copyright_text',
		array(
			'label'   => esc_html__( 'Add copyright text in the footer.', 'andre-lite' ),
			'section' => 'andre_theme_options',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'text-color',
		array(
			'default'           => '#eaeaea',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'text-color',
			array(
				'label'    => esc_html__( 'General text color', 'andre-lite' ),
				'section'  => 'colors',
				'settings' => 'text-color',
				'priority' => 8,
			)
		)
	);

	$wp_customize->add_setting(
		'menu-links',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu-links',
			array(
				'label'    => esc_html__( 'Menu links', 'andre-lite' ),
				'section'  => 'colors',
				'settings' => 'menu-links',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'secondary-color',
		array(
			'default'           => '#f44336',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary-color',
			array(
				'label'    => esc_html__( 'Change the theme red color throughout', 'andre-lite' ),
				'section'  => 'colors',
				'settings' => 'secondary-color',
				'priority' => 12,
			)
		)
	);

	$wp_customize->add_setting(
		'title-color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'title-color',
			array(
				'label'    => esc_html__( 'Titles color', 'andre-lite' ),
				'section'  => 'colors',
				'settings' => 'title-color',
				'priority' => 14,
			)
		)
	);

    /** Dynamic Color Option **/
    $wp_customize->add_setting( 'creativity_tpl_color', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#df2c45' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'creativity_tpl_color',
		array(
    		'label'      => esc_html__( 'Template Color', 'creativity' ),
            'description' => esc_html__( 'Set te template color for the site', 'creativity' ),
    		'section'    => 'colors',
    		'settings'   => 'creativity_tpl_color',
    ) ) );

    /** Necesary Variables **/
    $pr_layout = array(
        'services' => __('Service', 'creativity'),
        'portfolio' => __('Portfolio', 'creativity'),
        'clients' => __('Clients', 'creativity'),
        'contact' => __('Contact', 'creativity'),
        'blog' => __('Blog', 'creativity'),
    );

	// Logo & Favicon
	$wp_customize->add_section( 'creativity_log_favicon',
		array(
			'title' => __( 'Site Logo', 'creativity' ),
            'panel' => 'creativity_panel_general_settings'
		)
	);

	//Home Logo
	$wp_customize->add_setting( 'creativity_home_logo',
		array(
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'creativity_home_logo',
		array(
			'label' => __( 'Home Page Logo', 'creativity' ),
			'section' => 'creativity_log_favicon',
			'settings' => 'creativity_home_logo',
			'priority' => 1,
			'description' => 'Shows on the home page above slider'
			)
		)
	);

	// Header Logo
	$wp_customize->add_setting( 'creativity_logo',
		array(
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'creativity_logo', array(
				'label' => __( 'Header Logo', 'creativity' ),
				'section' => 'creativity_log_favicon',
				'settings' => 'creativity_logo',
				'priority' => 5,
				'description' => 'Shows on the header'
			)

		)

	);

	// General Settings
	$wp_customize->add_panel( 'creativity_panel_general_settings',
		array(
			'title' => __( 'General Settings', 'creativity' ),
			'priority' => 30
		)
	);

	// General Section
	$wp_customize->add_section( 'creativity_section_preloader',
		array(
			'title' => __( 'Preloader', 'creativity' ),
			'priority' => 10,
			'panel' => 'creativity_panel_general_settings'
		)
	);

	// Preloader
	$wp_customize->add_setting( 'creativity_preloader',
		array(
			'sanitize_callback' => 'creativity_sanitize_checkbox'
		)
	);

	$wp_customize->add_control( 'creativity_preloader',
		array(
			'type' => 'checkbox',
			'label' => __( 'Disable Preloader', 'creativity' ),
			'section' => 'creativity_section_preloader',
			'settings' => 'creativity_preloader',
			'priority' => 1
		)
	);

	$wp_customize->add_setting( 'creativity_blog_page',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'creativity_sanitize_integer'

		)
	);

	$wp_customize->add_control( new creativity_Category_Dropdown_Control( $wp_customize, 'creativity_blog_page',
		array(
			'label' => __( 'Choose Category for Blog', 'creativity' ),
			'section' => 'creativity_section_general_settings',
			'settings' => 'creativity_blog_page'
			)
		)
	);

	$wp_customize->add_setting( 'creativity_blog_page',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'creativity_sanitize_integer'

		)
	);

	$wp_customize->add_control( new creativity_Category_Dropdown_Control( $wp_customize, 'creativity_blog_page',
		array(
			'label' => __( 'Choose Category for Blog', 'creativity' ),
			'section' => 'creativity_section_general_settings',
			'settings' => 'creativity_blog_page'
			)

		)
	);

	$wp_customize->add_panel( 'creativity_panel_scroll_page_sections',
		array(
			'title' => __( 'Horizontal Scroll Page Sections', 'creativity' ),
			'priority' => 40
		)
	);

	// Scroll Section Home
	$wp_customize->add_section( 'creativity_section_section_home',
		array(
			'title' => __('Scroll Section - Slider', 'creativity' ),
			'priority' => 5,
			'capability' => 'edit_theme_options',
			'panel' => 'creativity_panel_scroll_page_sections'
		)
	);


	// Home ID for Navigation
	$wp_customize->add_setting( 'creativity_section_home',
		array(
			'default' => 'home',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'creativity_sanitize_text'
		)
	);

	$wp_customize->add_control( new creativity_Customize_Info_Control( $wp_customize, 'creativity_section_home',
		array(
			'label'	=> __( 'ID for Navigation', 'creativity' ),
			'section' => 'creativity_section_section_home',
			'settings' => 'creativity_section_home',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'creativity'), esc_url('http://accesspressthemes.com/documentation/creativity/#!/scrollable_menu'))
			)
		)
	);

	$wp_customize->add_setting( 'creativity_slider_category',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint'

		)
	);

	$wp_customize->add_control( new creativity_Category_Dropdown_Control( $wp_customize, 'creativity_slider_category',
		array(
			'label' => __( 'Choose Category for Slider', 'creativity' ),
			'section' => 'creativity_section_section_home',
			'settings' => 'creativity_slider_category'
			)

		)
	);

	// Slider Pause
	$wp_customize->add_setting( 'creativity_slider_pause',
		array(
			'default' => '4000', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'creativity_sanitize_integer'));
	$wp_customize->add_control( 'creativity_slider_pause',
		array(
			'label'	=> __( 'Slider Pause Duration', 'creativity' ),
			'type' => 'text',
			'settings' => 'creativity_slider_pause',
			'section' => 'creativity_section_section_home'
		)
	);

	// Slider Caption
	$wp_customize->add_setting( 'creativity_slider_caption',
		array(
			'default' => 'yes', 'sanitize_callback' => 'creativity_sanitize_slider_settings'));
	$wp_customize->add_control( 'creativity_slider_caption',
		array(
			'label' => __( 'Show Slider Caption', 'creativity' ),
			'type' => 'radio',
			'settings' => 'creativity_slider_caption',
			'section' => 'creativity_section_section_home',
			'priority' => 20,
			'choices' => array(
			'yes' => __( 'Yes', 'creativity' ),
			'no' => __( 'No', 'creativity' )
			)
		)
	);

	// Display Caption in Mobile Devices
	$wp_customize->add_setting( 'creativity_disp_caption_in_mobile',
		array(
			'default' => 0, 'sanitize_callback' => 'absint'));
	$wp_customize->add_control(
		'creativity_disp_caption_in_mobile',
		array(
			'label' => __( 'Display Caption Description Text in Mobile', 'creativity' ),
			'type' => 'checkbox',
			'section' => 'creativity_section_section_home',
			'priority' => 21,
		)
	);

	// Section 1
	$wp_customize->add_section( 'creativity_sec_1',
		array(
			'title' => __('Scroll Section 1', 'creativity' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'creativity_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'creativity_section_1_disable',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint' ));
	$wp_customize->add_control( 'creativity_section_1_disable',
		array(
			'label'	=> __( 'Disable Section', 'creativity' ),
			'type' => 'checkbox',
			'section' => 'creativity_sec_1',
			'settings' => 'creativity_section_1_disable'
		)
	);

	$wp_customize->add_setting( 'creativity_section_1', array( 'default' => 'section-1', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title_with_dashes' ));
	$wp_customize->add_control(
		'creativity_section_1',
		array(
			'label'	=> __( 'ID for Navigation', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_sec_1',
			'settings' => 'creativity_section_1',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'creativity'), esc_url('http://accesspressthemes.com/documentation/creativity/#!/scrollable_menu'))
		)
	);

    $wp_customize->add_setting( 'creativity_section_1_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_1_type',
		array(
			'label'	=> __( 'Section Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_1',
			'choices' => array(
                'page' => __('Page Layout', 'creativity'),
                'prlayout' => __('Predefined Layout', 'creativity'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'creativity' )
		)
	);

	$wp_customize->add_setting( 'creativity_section_page_1', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_page_1',
		array(
			'label'	=> __( 'Choose a Page for Section', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_sec_1',
			'settings' => 'creativity_section_page_1',
            'active_callback' => 'creativity_section1_pg_layout',
		)
	);

    $wp_customize->add_setting( 'creativity_section_layout1', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_layout1',
		array(
			'label'	=> __( 'Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_1',
            'choices' => $pr_layout,
            'active_callback' => 'creativity_section1_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'creativity' )
		)
	);

	// Section 2
	$wp_customize->add_section(
		'creativity_sec_2',
		array(
			'title' => __('Scroll Section 2', 'creativity' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'creativity_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'creativity_section_2_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_2_disable',
		array(
			'label'	=> __( 'Disable Section', 'creativity' ),
			'type' => 'checkbox',
			'section' => 'creativity_sec_2',
			'settings' => 'creativity_section_2_disable'
		)
	);

	$wp_customize->add_setting( 'creativity_section_2', array( 'default' => 'section-2', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title_with_dashes' ));
	$wp_customize->add_control(
		'creativity_section_2',
		array(
			'label'	=> __( 'ID for Navigation', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_sec_2',
			'settings' => 'creativity_section_2',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'creativity'), esc_url('http://accesspressthemes.com/documentation/creativity/#!/scrollable_menu'))
		)
	);

    $wp_customize->add_setting( 'creativity_section_2_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_2_type',
		array(
			'label'	=> __( 'Section Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_2',
			'choices' => array(
                'page' => __('Page Layout', 'creativity'),
                'prlayout' => __('Predefined Layout', 'creativity'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'creativity' )
		)
	);

	$wp_customize->add_setting( 'creativity_section_page_2', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_page_2',
		array(
			'label'	=> __( 'Choose a Page for Section', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_sec_2',
			'settings' => 'creativity_section_page_2',
            'active_callback' => 'creativity_section2_pg_layout'
		)
	);

    $wp_customize->add_setting( 'creativity_section_layout2', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_layout2',
		array(
			'label'	=> __( 'Choose Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_2',
            'choices' => $pr_layout,
            'active_callback' => 'creativity_section2_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'creativity' )
		)
	);

	// Section 3
	$wp_customize->add_section(
		'creativity_sec_3',
		array(
			'title' => __('Scroll Section 3', 'creativity' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'creativity_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'creativity_section_3_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_3_disable',
		array(
			'label'	=> __( 'Disable Section', 'creativity' ),
			'type' => 'checkbox',
			'section' => 'creativity_sec_3',
			'settings' => 'creativity_section_3_disable'
		)
	);

	$wp_customize->add_setting( 'creativity_section_3', array( 'default' => 'section-3', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title_with_dashes' ));
	$wp_customize->add_control(
		'creativity_section_3',
		array(
			'label'	=> __( 'ID for Navigation', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_sec_3',
			'settings' => 'creativity_section_3',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'creativity'), esc_url('http://accesspressthemes.com/documentation/creativity/#!/scrollable_menu'))
		)
	);

    $wp_customize->add_setting( 'creativity_section_3_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_3_type',
		array(
			'label'	=> __( 'Section Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_3',
			'choices' => array(
                'page' => __('Page Layout', 'creativity'),
                'prlayout' => __('Predefined Layout', 'creativity'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'creativity' )
		)
	);

	$wp_customize->add_setting( 'creativity_section_page_3', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_page_3',
		array(
			'label'	=> __( 'Choose a Page for Section', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_sec_3',
			'settings' => 'creativity_section_page_3',
            'active_callback' => 'creativity_section3_pg_layout',
		)
	);

    $wp_customize->add_setting( 'creativity_section_layout3', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_layout3',
		array(
			'label'	=> __( 'Choose Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_3',
            'choices' => $pr_layout,
            'active_callback' => 'creativity_section3_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'creativity' )
		)
	);

	// Section 4
	$wp_customize->add_section(
		'creativity_sec_4',
		array(
			'title' => __('Scroll Section 4', 'creativity' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'creativity_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'creativity_section_4_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_4_disable',
		array(
			'label'	=> __( 'Disable Section', 'creativity' ),
			'type' => 'checkbox',
			'section' => 'creativity_sec_4',
			'settings' => 'creativity_section_4_disable'
		)
	);

	$wp_customize->add_setting( 'creativity_section_4', array( 'default' => 'section-4', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title' ));
	$wp_customize->add_control(
		'creativity_section_4',
		array(
			'label'	=> __( 'ID for Navigation', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_sec_4',
			'settings' => 'creativity_section_4',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'creativity'), esc_url('http://accesspressthemes.com/documentation/creativity/#!/scrollable_menu'))
		)
	);

    $wp_customize->add_setting( 'creativity_section_4_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_4_type',
		array(
			'label'	=> __( 'Section Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_4',
			'choices' => array(
                'page' => __('Page Layout', 'creativity'),
                'prlayout' => __('Predefined Layout', 'creativity'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'creativity' )
		)
	);

	$wp_customize->add_setting( 'creativity_section_page_4', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_page_4',
		array(
			'label'	=> __( 'Choose a Page for Section', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_sec_4',
			'settings' => 'creativity_section_page_4',
            'active_callback' => 'creativity_section4_pg_layout',
		)
	);

    $wp_customize->add_setting( 'creativity_section_layout4', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_layout4',
		array(
			'label'	=> __( 'Choose Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_4',
            'choices' => $pr_layout,
            'active_callback' => 'creativity_section4_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'creativity' )
		)
	);

	// Section 5
	$wp_customize->add_section(
		'creativity_sec_5',
		array(
			'title' => __('Scroll Section 5', 'creativity' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'creativity_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'creativity_section_5_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_5_disable',
		array(
			'label'	=> __( 'Disable Section', 'creativity' ),
			'type' => 'checkbox',
			'section' => 'creativity_sec_5',
			'settings' => 'creativity_section_5_disable'
		)
	);

	$wp_customize->add_setting( 'creativity_section_5', array( 'default' => 'section-5', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title_with_dashes' ));
	$wp_customize->add_control(
		'creativity_section_5',
		array(
			'label'	=> __( 'ID for Navigation', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_sec_5',
			'settings' => 'creativity_section_5',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'creativity'), esc_url('http://accesspressthemes.com/documentation/creativity/#!/scrollable_menu'))
		)
	);

    $wp_customize->add_setting( 'creativity_section_5_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_5_type',
		array(
			'label'	=> __( 'Section Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_5',
			'choices' => array(
                'page' => __('Page Layout', 'creativity'),
                'prlayout' => __('Predefined Layout', 'creativity'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'creativity' )
		)
	);

	$wp_customize->add_setting( 'creativity_section_page_5', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_page_5',
		array(
			'label'	=> __( 'Choose a Page for Section', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_sec_5',
			'settings' => 'creativity_section_page_5',
            'active_callback' => 'creativity_section5_pg_layout',
		)
	);

    $wp_customize->add_setting( 'creativity_section_layout5', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_layout5',
		array(
			'label'	=> __( 'Choose Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_5',
            'choices' => $pr_layout,
            'active_callback' => 'creativity_section5_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'creativity' )
		)
	);

	// Section 6
	$wp_customize->add_section(
		'creativity_sec_6',
		array(
			'title' => __('Scroll Section 6', 'creativity' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'creativity_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'creativity_section_6_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_6_disable',
		array(
			'label'	=> __( 'Disable Section', 'creativity' ),
			'type' => 'checkbox',
			'section' => 'creativity_sec_6',
			'settings' => 'creativity_section_6_disable'
		)
	);

	$wp_customize->add_setting( 'creativity_section_6', array( 'default' => 'section-6', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title' ));
	$wp_customize->add_control(
		'creativity_section_6',
		array(
			'label'	=> __( 'ID for Navigation', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_sec_6',
			'settings' => 'creativity_section_6',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'creativity'), esc_url('http://accesspressthemes.com/documentation/creativity/#!/scrollable_menu') )
		)
	);

    $wp_customize->add_setting( 'creativity_section_6_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_6_type',
		array(
			'label'	=> __( 'Section Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_6',
			'choices' => array(
                'page' => __('Page Layout', 'creativity'),
                'prlayout' => __('Predefined Layout', 'creativity'),
            ),
			'description' => __( 'Choose either to display Page or Predefined Layout', 'creativity' )
		)
	);

	$wp_customize->add_setting( 'creativity_section_page_6', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_page_6',
		array(
			'label'	=> __( 'Choose a Page for Section', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_sec_6',
			'settings' => 'creativity_section_page_6',
            'active_callback' => 'creativity_section6_pg_layout',
		)
	);

    $wp_customize->add_setting( 'creativity_section_layout6', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_layout6',
		array(
			'label'	=> __( 'Choose Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_6',
            'choices' => $pr_layout,
            'active_callback' => 'creativity_section6_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'creativity' )
		)
	);

    // Section 7
	$wp_customize->add_section(
		'creativity_sec_7',
		array(
			'title' => __('Scroll Section 7', 'creativity' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'creativity_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'creativity_section_7_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_7_disable',
		array(
			'label'	=> __( 'Disable Section', 'creativity' ),
			'type' => 'checkbox',
			'section' => 'creativity_sec_7',
			'settings' => 'creativity_section_7_disable'
		)
	);

	$wp_customize->add_setting( 'creativity_section_7', array( 'default' => 'section-7', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title_with_dashes' ));
	$wp_customize->add_control(
		'creativity_section_7',
		array(
			'label'	=> __( 'ID for Navigation', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_sec_7',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'creativity'), esc_url('http://accesspressthemes.com/documentation/creativity/#!/scrollable_menu') )
		)
	);

    $wp_customize->add_setting( 'creativity_section_7_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_7_type',
		array(
			'label'	=> __( 'Section Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_7',
			'choices' => array(
                'page' => __('Page Layout', 'creativity'),
                'prlayout' => __('Predefined Layout', 'creativity'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'creativity' )
		)
	);

	$wp_customize->add_setting( 'creativity_section_page_7', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_section_page_7',
		array(
			'label'	=> __( 'Choose a Page for Section', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_sec_7',
			'settings' => 'creativity_section_page_7',
            'active_callback' => 'creativity_section7_pg_layout',
		)
	);

    $wp_customize->add_setting( 'creativity_section_layout7', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'creativity_section_layout7',
		array(
			'label'	=> __( 'Choose Layout', 'creativity' ),
			'type' => 'select',
			'section' => 'creativity_sec_7',
            'choices' => $pr_layout,
            'active_callback' => 'creativity_section7_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'creativity' )
		)
	);

	/** Service Section Settings **/
    $wp_customize->add_section(
		'creativity_service_settings',
		array(
			'title' => __('Service Settings', 'creativity' ),
			'priority' => 51,
			'capability' => 'edit_theme_options',
		)
	);

    // Section Title
	$wp_customize->add_setting( 'creativity_service_title', array( 'default' => 'Sample Title', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'creativity_allow_span' ));
	$wp_customize->add_control(
		'creativity_service_title',
		array(
			'label'	=> __( 'Section Title', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_service_settings',
		)
	);

	// Service 1 Page
	$wp_customize->add_setting( 'creativity_service_block_1_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_service_block_1_page',
		array(
			'label'	=> __( 'Service 1', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_service_settings',
		)
	);

	// Service 2 Page
	$wp_customize->add_setting( 'creativity_service_block_2_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_service_block_2_page',
		array(
			'label'	=> __( 'Service 2', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_service_settings',
		)
	);

	// Service 3 Page
	$wp_customize->add_setting( 'creativity_service_block_3_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_service_block_3_page',
		array(
			'label'	=> __( 'Service 3', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_service_settings',
		)
	);

	// Service 4 Page
	$wp_customize->add_setting( 'creativity_service_block_4_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_service_block_4_page',
		array(
			'label'	=> __( 'Service 4', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_service_settings',
		)
	);

	$wp_customize->add_control(
		'creativity_open_service_newtab',
		array(
			'type' => 'checkbox',
			'label' => __( 'Open Service Link in new tab', 'creativity' ),
			'section' => 'creativity_service_settings',
			'settings' => 'creativity_open_service_newtab',
		)
	);

    /** Portfolio Settings **/
    $wp_customize->add_section(
		'creativity_portfolio_settings',
		array(
			'title' => __('Portfolio Settings', 'creativity' ),
			'priority' => 52,
			'capability' => 'edit_theme_options',
		)
	);

    $wp_customize->add_setting( 'creativity_portfolio_title', array( 'default' => 'What we have done - <span>Our Works</span>', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'creativity_allow_span' ));
    $wp_customize->add_control(
		'creativity_portfolio_title',
		array(
			'label'	=> __( 'Section Title', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_portfolio_settings',
		)
	);

    $wp_customize->add_setting( 'creativity_portfolio_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'creativity_sanitize_integer' ));
	$wp_customize->add_control( new creativity_Category_Dropdown_Control( $wp_customize,
        'creativity_portfolio_page',
        array(
				'label' => __( 'Choose Category for Portfolio', 'creativity' ),
				'section' => 'creativity_portfolio_settings',
				'settings' => 'creativity_portfolio_page'
			)
		)
	);

    /** Clients Settings **/
    $wp_customize->add_section(
		'creativity_clients_settings',
		array(
			'title' => __('Clients Settings', 'creativity' ),
			'priority' => 52,
			'capability' => 'edit_theme_options',
		)
	);

    $wp_customize->add_setting( 'creativity_client_title', array( 'default' => 'We Have Some - <span>Great Clients</span>', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'creativity_allow_span' ));
    $wp_customize->add_control(
		'creativity_client_title',
		array(
			'label'	=> __( 'Section Title', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_clients_settings',
		)
	);

    $wp_customize->add_setting( 'creativity_clients_category', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control( new creativity_Category_Dropdown_Control( $wp_customize,
        'creativity_clients_category',
        array(
				'label' => __( 'Choose Category for Clients', 'creativity' ),
				'section' => 'creativity_clients_settings',
				'settings' => 'creativity_clients_category',
			)

		)
	);

    $wp_customize->add_setting( 'creativity_linkto_inpage', array( 'default' => 1, 'capability' => 'edit_theme_options', 'sanitize_callback' => 'creativity_sanitize_checkbox' ));
	$wp_customize->add_control(
		'creativity_linkto_inpage',
		array(
			'type' => 'checkbox',
			'label' => __( 'Link to Inner Page', 'creativity' ),
			'section' => 'creativity_clients_settings',
		)
	);

    /** Contact Settings **/
    $wp_customize->add_section(
		'creativity_contact_settings',
		array(
			'title' => __('Contact Settings', 'creativity' ),
			'priority' => 52,
			'capability' => 'edit_theme_options',
		)
	);

    $wp_customize->add_setting( 'creativity_contact_title', array( 'default' => "We'd Love to - <span>Hear From You</span>", 'capability' => 'edit_theme_options', 'sanitize_callback' => 'creativity_allow_span' ));
    $wp_customize->add_control(
		'creativity_contact_title',
		array(
			'label'	=> __( 'Section Title', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_contact_settings',
		)
	);

    $wp_customize->add_setting( 'creativity_contact_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_contact_page',
		array(
			'label'	=> __( 'Select Page', 'creativity' ),
			'type' => 'dropdown-pages',
			'section' => 'creativity_contact_settings',
		)
	);

    $wp_customize->add_setting( 'creativity_map_info', array( 'sanitize_callback' => 'sanitize_text_field' ));
    $wp_customize->add_control( new WP_Customize_Help_Control( $wp_customize, 'creativity_map_info', array(
            'section' => 'creativity_contact_settings',
            'settings' => 'creativity_map_info',
            'input_attrs' => array(
                'info' => '<p>Add the <span style="text-decoration: underline;">Text</span> widget to the <a href="'.admin_url('widgets.php').'" target="_blank" >Google Map</a> widget area and paste the google map iframe code there.</p>',
            )
        )
    ) );

    /** Blog Settings **/
    $wp_customize->add_section(
		'creativity_blog_settings',
		array(
			'title' => __('Blog Settings', 'creativity' ),
			'priority' => 52,
			'capability' => 'edit_theme_options',
		)
	);

    $wp_customize->add_setting( 'creativity_blog_title', array( 'default' => "Know - <span>What we are Upto</span>", 'capability' => 'edit_theme_options', 'sanitize_callback' => 'creativity_allow_span' ));
    $wp_customize->add_control(
		'creativity_blog_title',
		array(
			'label'	=> __( 'Section Title', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_blog_settings',
		)
	);

    $wp_customize->add_setting( 'creativity_blog_cat', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'creativity_sanitize_integer' ));
	$wp_customize->add_control( new creativity_Category_Dropdown_Control( $wp_customize,
        'creativity_blog_cat',
        array(
				'label' => __( 'Choose Category for Blog', 'creativity' ),
				'section' => 'creativity_blog_settings',
				'settings' => 'creativity_blog_cat'
			)
		)
	);


    $wp_customize->add_setting( 'creativity_blog_readmore_txt', array( 'default' => "Read More", 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
    $wp_customize->add_control(
		'creativity_blog_readmore_txt',
		array(
			'label'	=> __( 'Readmore Text', 'creativity' ),
			'type' => 'text',
			'section' => 'creativity_blog_settings',
		)
	);

	// Social Links
	$wp_customize->add_section(
		'creativity_social_links',
		array(
			'title' => __( 'Social Links', 'creativity' ),
			'priority' => 170
		)
	);

	// Social Icon Shortcode
    // Social Icons Help Info
    $wp_customize->add_setting( 'creativity_sicon_info', array( 'sanitize_callback' => 'sanitize_text_field' ));
    $wp_customize->add_control( new WP_Customize_Help_Control( $wp_customize, 'creativity_sicon_info', array(
            'section' => 'creativity_social_links',
            'settings' => 'creativity_sicon_info',
            'input_attrs' => array(
                'info' => '<p>Make Sure You have installed <a href="https://wordpress.org/plugins/accesspress-social-icons/" target="_blank">AccessPres Social Icons plugin</a>. Then create a social icon set.</p><p>Add the <span style="text-decoration: underline;">AccessPres Social Icons</span> widget to the <a href="'.admin_url('widgets.php').'" target="_blank" >Social Link (Header)</a> widget area.</p>',
            )
        )
    ) );

   	//post settings
    $wp_customize->add_section(
		'creativity_post_settings',
		array(
			'title' => __('Post Settings', 'creativity' ),
			'priority' => 53,
			'capability' => 'edit_theme_options',
		)
	);

    //featured image
	$wp_customize->add_setting( 'creativity_feat_img_disable', array( 'default' => 1, 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_feat_img_disable',
		array(
			'label'	=> __( 'Enable/Disable featured Image', 'creativity' ),
			'type' => 'checkbox',
			'section' => 'creativity_post_settings',
			'settings' => 'creativity_feat_img_disable'
		)
	);

	$wp_customize->add_setting( 'creativity_metadata_disable', array( 'default' => 1, 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'creativity_metadata_disable',
		array(
			'label'	=> __( 'Enable/Disable MetaData', 'creativity' ),
			'type' => 'checkbox',
			'section' => 'creativity_post_settings',
			'settings' => 'creativity_metadata_disable'
		)
	);


}

/** Extra Controls **/
if(class_exists('WP_Customize_Control')) {
    class WP_Customize_Help_Control extends WP_Customize_Control{
        public function render_content() {
            $input_attrs = $this->input_attrs;
            $info = isset($input_attrs['info']) ? $input_attrs['info'] : '';
            ?>
            <div class="help-info">
                <h4><?php esc_html_e('Instruction', 'creativity'); ?></h4>
                <div style="font-weight: bold;">
                    <?php echo wp_kses_post($info); ?>
                </div>
            </div>
            <?php
        }
    }
}


add_action( 'customize_register', 'creativity_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function creativity_customize_preview_js() {
	wp_enqueue_script( 'creativity_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'creativity_customize_preview_js' );

function creativity_customize_scripts() {
	wp_enqueue_style( 'creativity_custom_css', get_template_directory_uri() . '/inc/admin/css/admin.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'creativity_customize_scripts' );


function creativity_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

function creativity_sanitize_integer( $input ) {
	if( is_numeric( $input ) ) {
		return intval( $input );
	}
}

function creativity_sanitize_checkbox( $input ) {
	if( $input == 1 ) {
		return 1;
	}else {
		return '';
	}
}

function creativity_sanitize_float( $input ) {

		return floatval( $input );

}

function creativity_sanitize_filter_html( $input ) {
	return wp_filter_nohtml_kses( $input );
}

function creativity_sanitize_slider_settings( $input ) {
	$options = array(
		'yes' => __( 'Yes', 'creativity' ),
		'no' => __( 'No', 'creativity' ),
		'horizontal' => __( 'Slider', 'creativity' ),
		'fade' => __( 'Fade', 'creativity' ),

	);
	if( array_key_exists( $input, $options ) ) {
		return $input;
	}else {
		return '';
	}
}

    /** Active Callbacks **/
    /** Section Page Layout **/
        function creativity_section1_pg_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_1_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section2_pg_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_2_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section3_pg_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_3_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section4_pg_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_4_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section5_pg_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_5_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section6_pg_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_6_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section7_pg_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_7_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }

    /** Section Predefined layout **/
        function creativity_section1_pr_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_1_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section2_pr_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_2_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section3_pr_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_3_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section4_pr_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_4_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section5_pr_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_5_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section6_pr_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_6_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }

        function creativity_section7_pr_layout( $control ) {
            if ( $control->manager->get_setting('creativity_section_7_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }
    /** Sanitization **/
    function creativity_allow_span($input) {
        $cus_allowed_tags = array(
            'span' => array()
        );

        $input_fil = wp_kses($input, $cus_allowed_tags);

        return $input_fil;
    }

		functions
