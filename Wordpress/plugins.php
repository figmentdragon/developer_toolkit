<?php
/* --------
start TGM activating plugins
------------------------------------------- */
function creatvity_register_required_plugins() {
  $plugins = array(
    array(
      'name' => esc_attr__('creatvity Core', 'creatvity'), // The plugin name
      'slug' => 'creatvity-core', // The plugin slug (typically the folder name)
      'source' => esc_url('https://ahmad.works/creatvity/plugins/creatvity-core-1-9.zip'), // The plugin source
      'required' => true, // If false, the plugin is only 'recommended' instead of required
      'version' => '1.9', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
      'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
      'external_url' => '', // If set, overrides default API URL and points to an external URL
    ),
    array(
      'name' => esc_attr__('One Click Demo Import', 'creatvity'),
      'slug' => 'one-click-demo-import',
      'required' => false,
      'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
    ),
    array(
      'name' => esc_attr__('Contact Form 7', 'creatvity'),
      'slug' => 'contact-form-7',
      'required' => false,
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
    ),
  );

  $config = array(
    'default_path' => '',                      // Default absolute path to pre-packaged plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => true,                    // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
    'strings'      => array(
      'page_title'                      => esc_attr__( 'Install Required Plugins', 'creatvity' ),
      'menu_title'                      => esc_attr__( 'Install Plugins', 'creatvity' ),
      'installing'                      => esc_attr__( 'Installing Plugin: %s', 'creatvity' ), // %s = plugin name.
      'oops'                            => esc_attr__( 'Something went wrong with the plugin API.', 'creatvity' ),
      'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'creatvity' ), // %1$s = plugin name(s).
      'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'creatvity' ), // %1$s = plugin name(s).
      'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'creatvity' ), // %1$s = plugin name(s).
      'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'creatvity' ), // %1$s = plugin name(s).
      'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'creatvity' ), // %1$s = plugin name(s).
      'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'creatvity' ), // %1$s = plugin name(s).
      'notice_ask_to_update'            => _n_noop( 'The following plugin needs  to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'creatvity' ), // %1$s = plugin name(s).
      'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'creatvity' ), // %1$s = plugin name(s).
      'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'creatvity' ),
      'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'creatvity' ),
      'return'                          => esc_attr__( 'Return to Required Plugins Installer', 'creatvity' ),
      'plugin_activated'                => esc_attr__( 'Plugin activated successfully.', 'creatvity' ),
      'complete'                        => esc_attr__( 'All plugins installed and activated successfully. %s', 'creatvity' ), // %s = dashboard link.
      'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
    )
  );
  tgmpa( $plugins, $config );
}
