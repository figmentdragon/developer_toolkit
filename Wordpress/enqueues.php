<?php
/**
 * Styles and Scripts
*/
add_action( 'wp_enqueue_scripts', 'scrollme_styles_and_scripts' );
add_action( 'wp_footer', 'deregister_scripts' );
add_action( 'wp_enqueue_scripts', 'scrollme_scripts' );


function deregister_scripts() {
  wp_deregister_script( 'wp-embed' );
}
function deregister_styles() {
  wp_dequeue_style( 'wp-block-library' );
}

function scrollme_styles_and_scripts() {
  // Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
  }

  function scrollme_styles() {
    // CSS
    // Normalize
    wp_register_style( 'normalize', get_template_directory_uri() . '/assets/css/lib/normalize.css', array(), '7.0.0' );

    // Core Style
    wp_register_style( 'core-style', get_template_directory_uri() . '/style.css', array(), 'all');

    //Main Style
    wp_register_style( 'main-style', get_template_directory_uri() . '/assets/stylesheets/main.css', 'all' );

    // Theme Style
    wp_register_style( 'theme-style', get_template_directory_uri() . '/assets/stylesheets/theme.css', 'all' );

    // 3Rd Party
    wp_register_style( 'animate-style', get_template_directory_uri() . '/assets/css/animate.css', array(), '1', 'screen' );
    wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/vendors/genericons/genericons.css', array(), '3.2' );
    wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/vendors/genericons/genericons.css', array(), '3.0.3' );
    wp_enqueue_style( 'scrollme-plugins', get_template_directory_uri() . '/assets/css/pluginstyle.css', array(), '1' );
	  wp_enqueue_style( 'nivo-lightbox', get_template_directory_uri().'/assets/vendors/nivolightbox/nivo-lightbox.css' );
    wp_enqueue_style( 'nivo-lightbox-default', get_template_directory_uri().'/assets/vendors/nivolightbox/themes/default/default.css' );
    wp_enqueue_style( 'jquery-fullpage', get_template_directory_uri().'/assets/js/fullpage/jquery.fullPage.css', true );
  	wp_enqueue_style( 'mcustomscrollbar', get_template_directory_uri().'/assets/vendors/mcustomscrollbar/jquery.mCustomScrollbar.css', true );
  	wp_enqueue_style( 'scrollme-keyboard', get_template_directory_uri().'/assets/css/keyboard.css', true );
  	wp_enqueue_style( 'scrollme-responsive', get_template_directory_uri().'/assets/css/responsive.css', true );


    // Enqueue
    wp_enqueue_style( 'core-style' );
    wp_enqueue_style( 'main-style' );
    wp_enqueue_style( 'theme-style' );
    wp_enqueue_style( 'animate-style' );
  }

  function scrollme_scripts() {
    // jQuery
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/js/lib/jquery.js', array(), '1.11.1' );

    // Conditionizr
    wp_register_script( 'conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0' );

    // Modernizr
    wp_register_script( 'modernizr', get_template_directory_uri() . '/js/lib/modernizr.js', array(), '2.8.3' );

    // JS
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.min.js', array(), '', true);

    // Responsive Video
    wp_enqueue_script( 'scrollme-responsive-videos', get_template_directory_uri() . '/assets/js/responsive-videos.js', array( 'jquery' ), '1.0', true );

    // Animations
    wp_enqueue_script( 'scrollme-animate', get_template_directory_uri() . '/assets/js/animate.js', array( 'jquery' ), '0.1.0', true );

    // Custom JS
    wp_enqueue_script( 'scrollme-custom', get_template_directory_uri() . '/assets/js/customscripts.js', array( 'jquery' ), '1.0', true );

    // 3Rd Party
    wp_enqueue_script( 'jquery-fullpage', get_template_directory_uri().'/assets/js/fullpage/jquery.fullPage.min.js', array( 'jquery' ),'20120206', true );
    wp_enqueue_script( 'jquery-bxslider', get_template_directory_uri().'/assets/js/jquery.bxslider.js', array( 'jquery' ),'20120206', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri().'/assets/js/isotope.pkgd.min.js', array( 'jquery' ),'20120206', true );
    wp_enqueue_script( 'jquery-inview', get_template_directory_uri().'/assets/js/jquery.inview.js', array( 'jquery'), '20120206', true );
    wp_enqueue_script( 'jquery-knob', get_template_directory_uri().'/assets/js/jquery.knob.js', array( 'jquery'), '20120206', true );
    wp_enqueue_script( 'nivo-lightbox', get_template_directory_uri().'/assets/vendors/nivolightbox/nivo-lightbox.js', array( 'jquery'), '20120206', true );
    wp_enqueue_script( 'mcustomscrollbar', get_template_directory_uri().'/assets/vendors/mcustomscrollbar/jquery.mCustomScrollbar.js', array( 'jquery'), '20120206', true );
    wp_enqueue_script( 'device', get_template_directory_uri().'/assets/js/device.js', array( ), '20120206', true );
    wp_enqueue_script( 'scrollto', get_template_directory_uri().'/assets/js/jquery.scrollTo.js', array( ), '20120206', true );
    wp_enqueue_script( 'scrollme-custom-js', get_template_directory_uri().'/assets/js/custom.js', array('jquery', 'jquery-masonry'), '20120206', true );

    $pause = get_theme_mod( 'scrollme_slider_pause', '4000' );

    wp_localize_script( 'scrollme-custom-js', 'sBxslider', array( 'pause' => $pause ) );

    wp_enqueue_style( 'scrollme-style', get_stylesheet_uri(), array(), '1.0' );
    wp_style_add_data( 'scrollme-style', 'rtl', 'replace' );
  }

  function scrollme_conditional_scripts() {
    if ( is_page( 'pagenamehere' ) ) {
      // Conditional script(s)
      wp_register_script( 'scriptname', get_template_directory_uri() . '/js/scriptname.js', array( 'jquery' ), '1.0.0' );
      wp_enqueue_script( 'scriptname' );
    }
  }

  if ( function_exists ( 'scrollme_admin_enqueue_scripts' ) ) {
    $currentScreen = get_current_screen();
    /** Loads the media js file in Page Edit Page only **/
    if( $currentScreen->id == "widgets" || $currentScreen->id == "page" ) {
      wp_enqueue_media();
      wp_enqueue_script( 'scrollme-media-uploader-js', get_template_directory_uri(). '/inc/admin/js/media-uploader.js', array('jquery') );
    }
    wp_enqueue_style('scrollme-other-admin', get_template_directory_uri(). '/inc/admin/css/other-admin.css');
  }
}

function scrollme_preload_scripts() {
	$asset_file_path = dirname( __DIR__ ) . '/build/index.asset.php';

	if ( is_readable( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	} else {
		$asset_file = [
			'version'      => '1.0.0',
			'dependencies' => [ 'wp-polyfill' ],
		];
	}

	?>
	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/build/index.css?ver=<?php echo esc_html( $asset_file['version'] ); ?>" as="style">
	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/build/index.js?ver=<?php echo esc_html( $asset_file['version'] ); ?>" as="script">
	<?php
}
add_action( 'wp_head', 'scrollme_preload_scripts', 1 );

/**
 * Preload assets.
 *
 * @author Corey Collins
 */
function scrollme_preload_assets() {
	?>
	<?php if ( scrollme_get_custom_logo_url() ) : ?>
		<link rel="preload" href="<?php echo esc_url( scrollme_get_custom_logo_url() ); ?>" as="image">
	<?php endif; ?>
	<?php
}
add_action( 'wp_head', 'scrollme_preload_assets', 1 );
