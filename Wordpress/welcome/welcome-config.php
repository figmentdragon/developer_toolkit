<?php
	/**
	 * Welcome Page Initiation
	*/

	get_template_part('/inc/welcome/welcome');

	/** Plugins **/
	$th_plugins = array(
		// *** Companion Plugins
		'companion_plugins' => array(

		),

		//Displays on Required Plugins tab
		'req_plugins' => array(

			// Free Plugins
			'free_plug' => array(

				'siteorigin-panels' => array(
					'slug' => 'siteorigin-panels',
					'filename' => 'siteorigin-panels.php',
					'class' => 'SiteOrigin_Panels',
				),

				'accesspress-social-icons' => array(
					'slug' => 'accesspress-social-icons',
					'filename' => 'accesspress-social-icons.php',
					'class' => 'APS_Class'
				),

				'accesspress-instagram-feed' => array(
					'slug' => 'accesspress-instagram-feed',
					'filename' => 'accesspress-instagram-feed.php',
					'class' => 'IF_Class'
				),

				'ap-custom-testimonial' => array(
					'slug' => 'ap-custom-testimonial',
					'filename' => 'ap-custom-testimonial.php',
					'class' => 'APCT_free'
				),

				'accesspress-twitter-feed' => array(
					'slug' => 'accesspress-twitter-feed',
					'filename' => 'accesspress-twitter-feed.php',
					'class' => 'APTF_Class'
				),

			),
			'pro_plug' => array(

			),
		),

		// *** Displays on Import Demo section
		'required_plugins' => array(
			'access-demo-importer' => array(
					'slug' 		=> 'access-demo-importer',
					'name' 		=> esc_html__('Access Demo Importer', 'creativity'),
					'filename' 	=>'access-demo-importer.php',
					'host_type' => 'wordpress', // Use either bundled, remote, wordpress
					'class' 	=> 'Access_Demo_Importer',
					'info' 		=> esc_html__('Access Demo Importer adds the feature to Import the Demo Conent with a single click.', 'creativity'),
			),

		),

		
	);

	$strings = array(
		// Welcome Page General Texts
		'welcome_menu_text' => esc_html__( 'creativity Welcome', 'creativity' ),
		'theme_short_description' => esc_html__( 'creativity - A horizontal scrolling WordPress Themes lets you navigate your website horizontally. The theme has beautifully crafted clean and elegant design and is fully responsive that show beautifully on all the devices. creativity is a multipurpose theme and is perfect for business, web agency, personal blog, portfolio , photography, magazine, parallax one page and freelancer. creativity has powerful features and provides a easier way to configure the front page with live preview from a customizer panel. The theme is Polylang compatible, Woo Commerce compatible, Translation Ready, SEO Friendly, bbPress and works with all other major plugins as well. So look no further and start creating your beautiful website using creativity. For demo http://demo.accesspressthemes.com/scroll-me', 'creativity' ),

		// Plugin Action Texts
		'install_n_activate' 	=> esc_html__('Install and Activate', 'creativity'),
		'deactivate' 			=> esc_html__('Deactivate', 'creativity'),
		'activate' 				=> esc_html__('Activate', 'creativity'),

		// Getting Started Section
		'doc_heading' 		=> esc_html__('Step 1 - Documentation', 'creativity'),
		'doc_description' 	=> esc_html__('Read the Documentation and follow the instructions to manage the site , it helps you to set up the theme more easily and quickly. The Documentation is very easy with its pictorial  and well managed listed instructions. ', 'creativity'),
		'doc_link'			=> 'https://doc.accesspressthemes.com/creativity/',
		'doc_read_now' 		=> esc_html__( 'Read Now', 'creativity' ),
		'cus_heading' 		=> esc_html__('Step 2 - Customizer Panel', 'creativity'),
		'cus_read_now' 		=> esc_html__( 'Go to Customizer Panels', 'creativity' ),

		// Recommended Plugins Section
		'pro_plugin_title' 			=> esc_html__( 'Premium Plugins', 'creativity' ),
		'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'creativity' ),

		

		// Demo Actions
		'activate_btn' 		=> esc_html__('Activate', 'creativity'),
		'installed_btn' 	=> esc_html__('Activated', 'creativity'),
		'demo_installing' 	=> esc_html__('Installing Demo', 'creativity'),
		'demo_installed' 	=> esc_html__('Demo Installed', 'creativity'),
		'demo_confirm' 		=> esc_html__('Are you sure to import demo content ?', 'creativity'),

		// Actions Required
		'req_plugin_info' => esc_html__('All these required plugins will be installed and activated while importing demo. Or you can choose to install and activate them manually. If you\'re not importing any of the demos, you must install and activate these plugins manually.', 'creativity' ),
		'req_plugins_installed' => esc_html__( 'All Recommended action has been successfully completed.', 'creativity' ),
		'customize_theme_btn' 	=> esc_html__( 'Customize Theme', 'creativity' ),
		'pro_plugin_title' 			=> esc_html__( 'Premium Plugins', 'creativity' ),
		'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'creativity' ),
	);

	/**
	 * Initiating Welcome Page
	*/
	$my_theme_wc_page = new creativity_Welcome( $th_plugins, $strings );