<?php
/**
 * Builds our admin page.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'themename_create_menu' ) ) {
	add_action( 'admin_menu', 'themename_create_menu' );
	/**
	 * Adds our "themename" dashboard menu item
	 *
	 */
	function themename_create_menu() {
		$themename_page = add_theme_page( 'themename', 'themename', apply_filters( 'themename_dashboard_page_capability', 'edit_theme_options' ), 'themename-options', 'themename_settings_page' );
		add_action( "admin_print_styles-$themename_page", 'themename_options_styles' );
	}
}

if ( ! function_exists( 'themename_options_styles' ) ) {
	/**
	 * Adds any necessary scripts to the themename dashboard page
	 *
	 */
	function themename_options_styles() {
		wp_enqueue_style( 'themename-options', get_template_directory_uri() . '/css/admin/admin-style.css', array(), themename_VERSION );
	}
}

if ( ! function_exists( 'themename_settings_page' ) ) {
	/**
	 * Builds the content of our themename dashboard page
	 *
	 */
	function themename_settings_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="themename-masthead clearfix">
					<div class="themename-container">
						<div class="themename-title">
							<a href="<?php echo esc_url(themename_theme_uri_link()); ?>" target="_blank"><?php esc_html_e( 'themename', 'themename' ); ?></a> <span class="themename-version"><?php echo esc_html( themename_VERSION ); ?></span>
						</div>
						<div class="themename-masthead-links">
							<?php if ( ! defined( 'themename_PREMIUM_VERSION' ) ) : ?>
								<a class="themename-masthead-links-bold" href="<?php echo esc_url(themename_theme_uri_link()); ?>" target="_blank"><?php esc_html_e( 'Premium', 'themename' );?></a>
							<?php endif; ?>
							<a href="<?php echo esc_url(themename_WPKOI_AUTHOR_URL); ?>" target="_blank"><?php esc_html_e( 'WPKoi', 'themename' ); ?></a>
                            <a href="<?php echo esc_url(themename_DOCUMENTATION); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'themename' ); ?></a>
						</div>
					</div>
				</div>

				<?php
				/**
				 * themename_dashboard_after_header hook.
				 *
				 */
				 do_action( 'themename_dashboard_after_header' );
				 ?>

				<div class="themename-container">
					<div class="postbox-container clearfix" style="float: none;">
						<div class="grid-container grid-parent">

							<?php
							/**
							 * themename_dashboard_inside_container hook.
							 *
							 */
							 do_action( 'themename_dashboard_inside_container' );
							 ?>

							<div class="form-metabox grid-70" style="padding-left: 0;">
								<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
								<form method="post" action="options.php">
									<?php settings_fields( 'themename-settings-group' ); ?>
									<?php do_settings_sections( 'themename-settings-group' ); ?>
									<div class="customize-button hide-on-desktop">
										<?php
										printf( '<a id="themename_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
											esc_url( admin_url( 'customize.php' ) ),
											esc_html__( 'Customize', 'themename' )
										);
										?>
									</div>

									<?php
									/**
									 * themename_inside_options_form hook.
									 *
									 */
									 do_action( 'themename_inside_options_form' );
									 ?>
								</form>

								<?php
								$modules = array(
									'Backgrounds' => array(
											'url' => themename_theme_uri_link(),
									),
									'Blog' => array(
											'url' => themename_theme_uri_link(),
									),
									'Colors' => array(
											'url' => themename_theme_uri_link(),
									),
									'Copyright' => array(
											'url' => themename_theme_uri_link(),
									),
									'Disable Elements' => array(
											'url' => themename_theme_uri_link(),
									),
									'Demo Import' => array(
											'url' => themename_theme_uri_link(),
									),
									'Hooks' => array(
											'url' => themename_theme_uri_link(),
									),
									'Import / Export' => array(
											'url' => themename_theme_uri_link(),
									),
									'Menu Plus' => array(
											'url' => themename_theme_uri_link(),
									),
									'Page Header' => array(
											'url' => themename_theme_uri_link(),
									),
									'Secondary Nav' => array(
											'url' => themename_theme_uri_link(),
									),
									'Spacing' => array(
											'url' => themename_theme_uri_link(),
									),
									'Typography' => array(
											'url' => themename_theme_uri_link(),
									),
									'Elementor Addon' => array(
											'url' => themename_theme_uri_link(),
									)
								);

								if ( ! defined( 'themename_PREMIUM_VERSION' ) ) : ?>
									<div class="postbox themename-metabox">
										<h3 class="hndle"><?php esc_html_e( 'Premium Modules', 'themename' ); ?></h3>
										<div class="inside" style="margin:0;padding:0;">
											<div class="premium-addons">
												<?php foreach( $modules as $module => $info ) { ?>
												<div class="add-on activated themename-clear addon-container grid-parent">
													<div class="addon-name column-addon-name" style="">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php echo esc_html( $module ); ?></a>
													</div>
													<div class="addon-action addon-addon-action" style="text-align:right;">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php esc_html_e( 'More info', 'themename' ); ?></a>
													</div>
												</div>
												<div class="themename-clear"></div>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php
								endif;

								/**
								 * themename_options_items hook.
								 *
								 */
								do_action( 'themename_options_items' );
								?>
							</div>

							<div class="themename-right-sidebar grid-30" style="padding-right: 0;">
								<div class="customize-button hide-on-mobile">
									<?php
									printf( '<a id="themename_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
										esc_url( admin_url( 'customize.php' ) ),
										esc_html__( 'Customize', 'themename' )
									);
									?>
								</div>

								<?php
								/**
								 * themename_admin_right_panel hook.
								 *
								 */
								 do_action( 'themename_admin_right_panel' );

								  ?>
                                
                                <div class="wpkoi-doc">
                                	<h3><?php esc_html_e( 'themename documentation', 'themename' ); ?></h3>
                                	<p><?php esc_html_e( 'If You`ve stuck, the documentation may help on WPKoi.com', 'themename' ); ?></p>
                                    <a href="<?php echo esc_url(themename_DOCUMENTATION); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'themename documentation', 'themename' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-social">
                                	<h3><?php esc_html_e( 'WPKoi on Facebook', 'themename' ); ?></h3>
                                	<p><?php esc_html_e( 'If You want to get useful info about WordPress and the theme, follow WPKoi on Facebook.', 'themename' ); ?></p>
                                    <a href="<?php echo esc_url(themename_WPKOI_SOCIAL_URL); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Go to Facebook', 'themename' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-review">
                                	<h3><?php esc_html_e( 'Help with You review', 'themename' ); ?></h3>
                                	<p><?php esc_html_e( 'If You like themename theme, show it to the world with Your review. Your feedback helps a lot.', 'themename' ); ?></p>
                                    <a href="<?php echo esc_url(themename_WORDPRESS_REVIEW); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Add my review', 'themename' ); ?></a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'themename_admin_errors' ) ) {
	add_action( 'admin_notices', 'themename_admin_errors' );
	/**
	 * Add our admin notices
	 *
	 */
	function themename_admin_errors() {
		$screen = get_current_screen();

		if ( 'appearance_page_themename-options' !== $screen->base ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
			 add_settings_error( 'themename-notices', 'true', esc_html__( 'Settings saved.', 'themename' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'imported' == $_GET['status'] ) {
			 add_settings_error( 'themename-notices', 'imported', esc_html__( 'Import successful.', 'themename' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
			 add_settings_error( 'themename-notices', 'reset', esc_html__( 'Settings removed.', 'themename' ), 'updated' );
		}

		settings_errors( 'themename-notices' );
	}
}
