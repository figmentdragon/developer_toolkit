<?php

/*------------------------------------*\
    Enqueue Scripts & Styles
\*------------------------------------*/


add_action( 'admin_enqueue_scripts', 'post_options_style' );

add_action( 'customize_preview_init', 'customizer_live_preview' );
add_action( 'customize_controls_enqueue_scripts', 'customizer_control_toggle' );

add_action( 'enqueue_block_editor_assets', 'gutenberg_load_custom_fonts' );

add_action( 'wp_enqueue_scripts', 'scripts' ); // Add Conditional Page Scripts
add_action( 'wp_enqueue_scripts', 'defer_scripts' );
add_action( 'wp_enqueue_scripts', 'theme_styles_and_scripts' );
add_action( 'wp_footer', 'deregister_scripts' );
add_action( 'wp_header', 'header_scripts' ); // Add Custom Scripts to wp_head
add_action( 'wp_header', 'styles' ); // Add Theme Stylesheet
add_action( 'wp_print_styles', 'deregister_styles', 100 );

add_action('tgmpa_register', 'creatvity_register_required_plugins');


function deregister_scripts() {
  wp_deregister_script( 'wp-embed' );
}
function deregister_styles() {
  wp_dequeue_style( 'wp-block-library' );
}

function theme_styles_and_scripts() {
  if ('load_system_fonts') {
    $protocol = is_ssl() ? 'https' : 'http';
    // load fonts from google or locally
    if ('load_fonts_locally') {
      wp_enqueue_style( 'lora', "$protocol://fonts.googleapis.com/css?family=Lora:400,700&subset=latin,latin-ext" );
    } else {
      wp_enqueue_style( 'lora', get_template_directory_uri() . '/framework/googlefonts/lora.css' );
		}
	}
  // add discord icon style for social media links
	if ('discord_url') {
			wp_enqueue_style( 'discord', get_template_directory_uri() . '/framework/font-awesome/css/discord.css', array(), '1' );
	}

	if ('fontawesome_icons_load') {
    wp_enqueue_style( 'creatvity-fontawesome', get_template_directory_uri() . '/framework/font-awesome/custom_fontawesome/css/fontawesome.css', array(), '1' );
  } else {
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/framework/font-awesome/css/font-awesome.min.css', array(), '1' ); }
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' ); }

  // CSS
  wp_register_style('main-style', get_template_directory_uri() . '/style.css', array(), 'all');

  wp_enqueue_style('main-style');

  // JS
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.min.js', array(), '', true);

  // footer scripts
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/framework/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '2', true );
	if (option('js_conditional_load') == true && !is_customize_preview()) {
		global $blogpage_id;

		wp_register_script( 'imagesloaded-script', get_template_directory_uri() . '/assets/js/conditionaljs/imagesloaded.js', array( 'jquery' ), '3.791', true );
		wp_register_script( 'fitvids-script', get_template_directory_uri() . '/assets/js/conditionaljs/fitvids.js', array( 'jquery' ), '3.791', true );
		wp_enqueue_script( 'appear-script', get_template_directory_uri() . '/assets/js/conditionaljs/appear.js', array( 'jquery' ), '3.791', true );
		wp_enqueue_script( 'easing-script', get_template_directory_uri() . '/assets/js/conditionaljs/easing.js', array( 'jquery' ), '3.791', true );
		wp_enqueue_script( 'basic-script', get_template_directory_uri() . '/assets/js/conditionaljs/basic_script.js', array( 'jquery' ), '3.791', true );
		wp_register_script( 'gallery-script', get_template_directory_uri() . '/assets/js/conditionaljs/slickslider.js', array( 'jquery' ), '3.791', true );
    if ((cross_option('blog_style', $blogpage_id) === 'masonry' || cross_option('blog_style', $blogpage_id) === 'banner_grid') && !is_single()) {
			wp_enqueue_script( 'imagesloaded-script');
			wp_enqueue_script( 'isotope-script', get_template_directory_uri() . '/assets/js/conditionaljs/isotope.js', array( 'jquery', 'imagesloaded-script' ), '3.791', true );
			wp_enqueue_script( 'masonry-script', get_template_directory_uri() . '/assets/js/conditionaljs/masonry.js', array( 'jquery','imagesloaded-script', 'isotope-script' ), '3.791', true );
    }
  } else {
		wp_register_script( 'script', get_template_directory_uri() . '/assets/js/creativity.js', array( 'jquery' ), '3.791', true );
		wp_enqueue_script( 'script');
	}
  // if ajax pagination is enabled
  if (cross_option('pagination_style') == 'ajax') {
    global $wp_query;
    wp_register_script( 'ajax-script', get_template_directory_uri() . '/js/ajaxpagination.js', array( 'jquery'), '3.791', true );
    // define js vars
    if (is_page()) {
      $creatvity_core_variables_array = array(
        'ajax_load' =>  get_template_directory_uri() . '/ajax-load.php',
        'query_vars' => json_encode( array('page'=>''))
      );
    } else {
      $creatvity_core_variables_array = array(
        'ajax_load' =>  get_template_directory_uri() . '/ajax-load.php',
        'query_vars' => json_encode( $wp_query->query )
      );

    wp_localize_script( 'ajax-script', 'creatvity_core_vars', $creatvity_core_variables_array );
	}

	if (option('writing_show_cookies_notice') && !is_customize_preview()) {
		$creatvity_variables_array = array(
      'ajax_accept_cookies' => get_theme_file_uri( '/acceptcookies.php', __FILE__ ),
    );
  }

  if (option('js_conditional_load') == true && !is_customize_preview()) {
    wp_localize_script( 'basic-script', 'creatvity_vars', $creatvity_variables_array );
  } else {
    wp_localize_script( 'script', 'creatvity_vars', $creatvity_variables_array );
  }
}
}
  // defer & async scripts
  // only on the front-end
  if(!is_admin()) {
    function creatvity_add_asyncdefer_attribute($tag, $handle) {
      if (!preg_match('/(((.+?))|jr-inta-feed-script|jquery-pllexi-slider)/', $handle) || $handle === 'lazyload-script') {
        return $tag;
      }
      if ('async_scripts') {
      // return the tag with the async attribute
      return str_replace( '<script ', '<script async ', $tag );
    }
    // if the unique handle/name of the registered script has 'defer' in it
    elseif ('defer_scripts') {
      // return the tag with the defer attribute
      return str_replace( '<script ', '<script defer ', $tag );
    }
    // otherwise skip
    else {
      return $tag;
    }
  }
  if (option('async_scripts') || option('defer_scripts')) {
    add_filter('script_loader_tag', 'writing_add_asyncdefer_attribute', 10, 2);
  }
}
// Load creativity styles
function styles() {
  if ( HTML5_DEBUG ) {
  // normalize-css
    wp_register_style( 'normalize', get_template_directory_uri() . '/css/lib/normalize.css', array(), '7.0.0' );

    // Custom CSS
    wp_register_style( 'creativity', get_template_directory_uri() . '/style.css', array( 'normalize' ), '1.0' );

    // Register CSS
    wp_enqueue_style( 'creativity' );
  } else {
    // Custom CSS
    wp_register_style( 'creativitycssmin', get_template_directory_uri() . '/style.css', array(), '1.0' );
    // Register CSS
    wp_enqueue_style( 'creativitycssmin' );
  	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );
    wp_enqueue_style( 'plugins', get_template_directory_uri() . '/pluginstyle.css', array(), '1' );
  }
}
function defer_scripts( $tag, $handle, $src ) {

	// The handles of the enqueued scripts we want to defer
	$defer_scripts = [
        'SCRIPT_ID'
    ];

    // Find scripts in array and defer
    if ( in_array( $handle, $defer_scripts ) ) {
        return '<script type="text/javascript" src="' . $src . '" defer="defer"></script>' . "\n";
    }

    return $tag;
}

// Load creativity scripts (header.php)
function header_scripts() {
  if ( $GLOBALS['pagenow'] = 'wp-login.php' && ! is_admin() ) {
    if ( HTML5_DEBUG ) {
      // jQuery
      wp_deregister_script( 'jquery' );
      wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/lib/jquery.js', array(), '1.11.1' );

      // Conditionizr
      wp_register_script( 'conditionizr', get_template_directory_uri() . '/assets/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0' );

      // Modernizr
      wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array( 'jquery' ), '1' );

      // Register the IE11 polyfill file.
    	wp_register_script(
    		'ie11-polyfills-asset',
    		get_template_directory_uri() . '/assets/js/polyfills.js',
    		array(),
    		wp_get_theme()->get( 'Version' ),
    		true
    	);

    	// Register the IE11 polyfill loader.
    	wp_register_script( 'ie11-polyfills', null,
        array(),
        wp_get_theme()->get( 'Version' ),
        true
      );
      wp_add_inline_script( 'ie11-polyfills', wp_get_script_polyfill( $wp_scripts,
      	array(
          'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'ie11-polyfills-asset',
        )
        )
      );

      // Custom scripts
      wp_register_script( 'creativityscripts', get_template_directory_uri() . '/assets/js/scripts.js',
        array(
          'conditionizr',
          'modernizr',
          'jquery'
        ),
        '1.0.0'
      );
    }
  }
}
// Footer Scripts
function footer_scripts() {
  if (('js_conditional_load') == true && !is_customize_preview()) {
    global $blogpage_id;
    wp_register_script( 'imagesloaded-script', get_template_directory_uri() . '/assets/js/conditionaljs/imagesloaded.js', array( 'jquery' ), '3.791', true );
    wp_register_script( 'fitvids-script', get_template_directory_uri() . '/assets/js/conditionaljs/fitvids.js', array( 'jquery' ), '3.791', true );
    wp_enqueue_script( 'appear-script', get_template_directory_uri() . '/assets/js/conditionaljs/appear.js', array( 'jquery' ), '3.791', true );
    wp_enqueue_script( 'easing-script', get_template_directory_uri() . '/assets/js/conditionaljs/easing.js', array( 'jquery' ), '3.791', true );
    wp_enqueue_script( 'basic-script', get_template_directory_uri() . '/assets/js/conditionaljs/basic_script.js', array( 'jquery' ), '3.791', true );
    wp_register_script( 'gallery-script', get_template_directory_uri() . '/assets/js/conditionaljs/slickslider.js', array( 'jquery' ), '3.791', true );
    if ((cross_option('blog_style', $blogpage_id) === 'masonry' || cross_option('blog_style', $blogpage_id) === 'banner_grid') && !is_single()) {
      wp_enqueue_script( 'imagesloaded-script');
      wp_enqueue_script( 'isotope-script', get_template_directory_uri() . '/assets/js/conditionaljs/isotope.js', array( 'jquery', 'imagesloaded-script' ), '3.791', true );
      wp_enqueue_script( 'masonry-script', get_template_directory_uri() . '/assets/js/conditionaljs/masonry.js', array( 'jquery','imagesloaded-script', 'isotope-script' ), '3.791', true );
    }
    wp_enqueue_script(
  		'responsive-embeds-script',
  		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
  		array( 'ie11-polyfills' ),
  		wp_get_theme()->get( 'Version' ),
  		true
  	);
  } else {
    wp_register_script( 'script', get_template_directory_uri() . '/assets/js/creativity.js', array( 'jquery' ), '3.791', true );
    wp_enqueue_script( 'script');
    if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
      echo '<script>';
      include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
  		echo '</script>';
  	} else {
  		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
  		?>
  		<script>
  		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
  		</script>
  		<?php
  	}
  }
// Load creativity conditional scripts
function conditional_scripts() {
  if ( is_page( 'pagenamehere' ) ) {
    // Conditional script(s)
    wp_register_script( 'scriptname', get_template_directory_uri() . '/assets/js/scriptname.js', array( 'jquery' ), '1.0.0' );
    wp_enqueue_script( 'scriptname' );
  }
  if ( is_rtl() ) {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/framework/bootstrap/css/bootstrap.rtl.css', array(), '1' );
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '3.791');
  } else {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/framework/bootstrap/css/bootstrap.css', array(), '1' );
    wp_enqueue_style( 'rtl-base', get_template_directory_uri() . '/rtl_base.css', array(), '3.791' );
	}
  // add discord icon style for social media links
  if ('discord_url') {
      wp_enqueue_style( 'discord', get_template_directory_uri() . '/framework/font-awesome/css/discord.css', array(), '1' );
  }
  if ('fontawesome_icons_load') {
    wp_enqueue_style( 'creatvity-fontawesome', get_template_directory_uri() . '/framework/font-awesome/custom_fontawesome/css/fontawesome.css', array(), '1' );
  } else {
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/framework/font-awesome/css/font-awesome.min.css', array(), '1' );
  }
  if (cross_option('pagination_style') == 'ajax') {
    global $wp_query;
    wp_register_script( 'ajax-script', get_template_directory_uri() . '/assets/js/ajaxpagination.js', array( 'jquery'), '3.791', true );
    // define js vars
    if (is_page()) {
      $creatvity_core_variables_array = array(
        'ajax_load' =>  get_template_directory_uri() . '/ajax-load.php',
        'query_vars' => json_encode( array('page'=>''))
      );
    } else {
      $creatvity_core_variables_array = array(
        'ajax_load' =>  get_template_directory_uri() . '/ajax-load.php',
        'query_vars' => json_encode( $wp_query->query )
      );
    }
    wp_localize_script( 'ajax-script', 'creatvity_core_vars', $creatvity_core_variables_array );
  }
  if ( has_nav_menu( 'primary' ) ) {
    wp_enqueue_script( 'primary-navigation-script',
    get_template_directory_uri() . '/assets/js/primary-navigation.js',
    array(
      'ie11-polyfills' ),
      wp_get_theme()->get( 'Version' ),
      true
    );
  }

  if (('creatvity_show_cookies_notice') && !is_customize_preview()) {
    $creatvity_variables_array = array(
      'ajax_accept_cookies' => get_theme_file_uri( '/acceptcookies.php', __FILE__ ),
    );
    if (('js_conditional_load') == true && !is_customize_preview()) {
      wp_localize_script( 'basic-script', 'creatvity_vars', $creatvity_variables_array );
    } else {
      wp_localize_script( 'script', 'creatvity_vars', $creatvity_variables_array );
    }
  }
  // Enqueue Scripts
  wp_enqueue_script( 'creativityscripts' );
  // Scripts minify
  wp_register_script( 'creativityscripts-min', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), '1.0.0' );
  // Enqueue Scripts
  wp_enqueue_script( 'creativityscripts-min' );
  wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array('jquery'), '20140222', true);
  wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'scripts'), '20140222', true);
  }
}

function post_options_style() {
  wp_register_style('admin_css', get_template_directory_uri().'/admin-style.css', array(), '1.40', 'all' );
  wp_enqueue_style('admin_css');
}

function customizer_live_preview() {
  wp_enqueue_script( 'customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-slider' ), '1.30', true );
}

function gutenberg_load_custom_fonts($init) {
	global $post;
	if ('load_system_fonts') {
		// load default fonts locally if set
		if ('load_fonts_locally') {
			$stylesheet_url =  get_template_directory_uri() . '/framework/googlefonts/lora.css';
		}

		if ( get_theme_mod( 'blog_font_type') && get_theme_mod( 'blog_font_type', 'creatvity_font')) {
      $stylesheet_url = customizer_library_get_google_font_uri(array(get_theme_mod( 'blog_font_type')));
    }
		if (isset($stylesheet_url)) { // load fonts from google or locally
		wp_enqueue_style( 'gutenber_editor_style', $stylesheet_url );
  }

	$output = '';
	$body_class = '';
	// font family
	if ( get_theme_mod( 'blog_font_type') && get_theme_mod( 'blog_font_type', 'creatvity_font')) {
		$blog_font_type = customizer_library_get_font_stack(get_theme_mod('blog_font_type'));
		$body_class .= 'font-family:'.str_replace('"', "'", $blog_font_type).' !important;';
	}

	// font size
	if (('blog_font_size') && ('blog_font_size' == 'false')) {
		$body_class = "font-size:" . ('blog_font_size') ."px !important";
	}

	// line height
	if (('blog_line_height') && ('blog_line_height' == 'false')) {
		$body_class = "line-height:" . ('blog_line_height') . "px !important";
	}

	if (cross_option('sidebar_position') == 'none') {
		$body_class = "width: 66.66666667%";
	} elseif ((isset($post->ID) && get_post_type( '$postpage' ) && cross_option('content_width_layout') == 'narrow')) {
		$body_class .= "max-width: 710px !important";
	}

	if ($body_class = '') {
		$output = '.wp-block {'.$body_class.'}';
	}

	if ((isset($post->ID)) && get_post_type($post->ID) === 'page') {
		$output = ".editor-styles-wrapper .editor-post-title .editor-post-title__block {
			padding-left: 3px !important;
			padding-right: 3px !important;
			padding-top: 0 !important;
			padding-bottom: 0 !important;
		}

		.editor-post-title__block:not(.is-selected) {
		    border: 1px solid #eee;
		    border-radius: 30px;
		    margin-bottom: 50px;
			}

		.editor-post-title__block:not(.is-selected) textarea {
			border: none;
			background-color: #f2f2f2;
			border-radius: 30px;
			margin: 3px;
			padding: 8px 20px;
			font-size: 17px;
			height: auto !important;
			line-height: auto;
			display: block !important;
		}";
	}

	// main color
	if ( 'main_color' ) {
    $color =  'main_color';
		$output .= '.wp-block a {color: $color !important}';
	}
}
	wp_add_inline_style( 'gutenber_editor_style', $output );
}
