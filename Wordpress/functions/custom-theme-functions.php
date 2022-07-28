<?php
/*  tru-writer theme functions

	Lives and forks at http://github.com/cogdog/truwriter

	Much of the magic happens here. Edit your own discretion, peril, unless you
	find a coding error, and by all means please fork this to the github repo
	thus you are deemed an honorary SPLOT knight.

	We suggest putting your own extra groovy code in incldes/custom-functions.php

*/

function custom_theme_functions() {
  wp_insert_term( 'In Progress', 'category' );
  wp_insert_term( 'Published', 'category' );

if (! page_with_template_exists( 'page-write.php' ) ) {

    $page_data = array(
			'post_title' 	=> 'Write? Write. Right.',
			'post_content'	=> 'Here is the place to compose, preview, and hone your fine words. If you are building this site, maybe edit this page to customize this wee bit of text.',
			'post_name'		=> 'write',
			'post_status'	=> 'publish',
			'post_type'		=> 'page',
			'post_author' 	=> 1,
			'post_date' 	=> date('Y-m-d H:i:s', time() - 172800),
			'page_template'	=> 'page-write.php',
		);

		wp_insert_post( $page_data );
    // add rewrite rules, then flush to make sure they stick.
  	rewrite_rules();
  	flush_rewrite_rules();
  }

if (! page_with_template_exists( 'page-desk.php' ) ) {
    $page_data = array(
  		'post_title' 	=> 'Welcome Desk',
  		'post_content'	=> 'You are but one special key word away from being able to write. Hopefully the kind owner of this site has provided you the key phrase. Spelling and capitalization do count. If you are said owner, editing this page will let you personalize this bit. ',
			'post_name'		=> 'desk',
			'post_status'	=> 'publish',
			'post_type'		=> 'page',
			'post_author' 	=> 1,
			'post_date' 	=> date('Y-m-d H:i:s', time() - 172800),
			'page_template'	=> 'page-desk.php',
		);
		wp_insert_post( $page_data );
	}

if (! page_with_template_exists( 'page-random.php' ) ) {
    // create the writing form page if it does not exist
    $page_data = array(
			'post_title' 	=> 'Random',
			'post_content'	=> 'You should never see this page, it is for random redirects. What are you doing looking at this page? Get back to writing, willya?',
			'post_name'		=> 'random',
			'post_status'	=> 'publish',
			'post_type'		=> 'page',
			'post_author' 	=> 1,
			'post_date' 	=> date('Y-m-d H:i:s', time() - 172800),
			'page_template'	=> 'page-random.php',
		);
		wp_insert_post( $page_data );
	}

if (! page_with_template_exists( 'page-get-edit-link.php' ) ) {
    $page_data = array(
  		'post_title' 	=> 'Get Edit Link',
  		'post_content'	=> 'You should never see this page, it is for doing a few chores. What did your mom tell you about peeking?',
  		'post_name'		=> 'get-edit-link',
  		'post_status'	=> 'publish',
  		'post_type'		=> 'page',
  		'post_author' 	=> 1,
  		'post_date' 	=> date('Y-m-d H:i:s', time() - 172800),
			'page_template'	=> 'page-get-edit-link.php',
		);
  	wp_insert_post( $page_data );
  }

function change_post_label() {
    global $menu;
    global $submenu;

    $thing_name = 'Writing';

    $menu[5][0] = $thing_name . 's';
    $submenu['edit.php'][5][0] = 'All ' . $thing_name . 's';
    $submenu['edit.php'][10][0] = 'Add ' . $thing_name;
    $submenu['edit.php'][15][0] = $thing_name .' Categories';
    $submenu['edit.php'][16][0] = $thing_name .' Tags';
    echo '';
  }

function change_post_object() {
    $thing_name = 'Writing';

    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name =  $thing_name . 's';;
    $labels->singular_name =  $thing_name;
    $labels->add_new = 'Add ' . $thing_name;
    $labels->add_new_item = 'Add ' . $thing_name;
    $labels->edit_item = 'Edit ' . $thing_name;
    $labels->new_item =  $thing_name;
    $labels->view_item = 'View ' . $thing_name;
    $labels->search_items = 'Search ' . $thing_name;
    $labels->not_found = 'No ' . $thing_name . ' found';
    $labels->not_found_in_trash = 'No ' .  $thing_name . ' found in Trash';
    $labels->all_items = 'All ' . $thing_name;
    $labels->menu_name =  $thing_name;
    $labels->name_admin_bar =  $thing_name;
  }

function drafts_menu() {
    add_submenu_page('edit.php', 'Writings in Progress (not submitted)', 'In Progress', 'edit_pages', 'edit.php?post_status=draft&post_type=post&cat=' . get_cat_ID( 'In Progress' ) );
    add_submenu_page('edit.php', 'Writings Submitted for Approval', 'Pending Approval', 'edit_pages', 'edit.php?post_status=pending&post_type=post' );
  }

function cookie_expiration( $expiration, $user_id, $remember ) {
  if ( current_user_can( 'edit_pages' )  ) {
    return $remember ? $expiration : 1209600;
  } else {
    return $remember ? $expiration : 7200;
  }
}

function comment_mod( $defaults ) {
	$defaults['title_reply'] = 'Provide Feedback';
	$defaults['logged_in_as'] = '';
	$defaults['title_reply_to'] = 'Provide Feedback for %s';
	return $defaults;
}

function tqueryvars( $qvars ) {
  $qvars[] = 'tk';
  $qvars[] = 'wid';
  return $qvars;
}

function is_menu_location_used( $location = 'primary' ) {
  $menulocations = get_nav_menu_locations();
	$navmenus = wp_get_nav_menus();
	if ( empty( $menulocations ) OR empty( $navmenus ) ) return false;
	return in_array( $location , $menulocations);
}

function default_menu() {
	$home = home_url('/');
	return ( '<li><a href="' . $home . '">Home</a></li><li><a href="' . $home . 'write' . '">Write</a></li><li><a href="' . $home . 'random' . '">Random</a></li>' );
}

function my_login_logo() { ?>
	<style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory(); ?>/assets/images/logo/logo-architect.png);
			padding-bottom: 30px;
		}
		#backtoblog {display:none;}
		#nav {display:none;}
	</style>
<?php }

function login_link( $url ) {
  return get_bloginfo( 'url' );
}

function autologin() {
  if (! isset ( $_GET['autologin'] ) ) return;
	if ($_GET['autologin'] == 'writer') {
		$creds['user_login'] = 'writer';
		$creds['user_password'] = option('pkey');
		$autologin_user = get_user_by( 'login', $creds['user_login'] );
    if ( $autologin_user ) {
      wp_set_current_user( $autologin_user->id, $autologin_user->user_login );
      wp_set_auth_cookie( $autologin_user->id);
      do_action( 'wp_login', $autologin_user->user_login );
      wp_redirect ( site_url() . '/write' );
    } else {
      die ('Bad news! Missing user for "' . $creds['user_login'] . '".');
    }
  }
}

function add_scripts() {
  $style = 'radcliffe_style';
  wp_enqueue_style( $style, get_stylesheet_directory() . '/style.css' );

  wp_enqueue_style( 'child-style', get_stylesheet_directory() . '/style.css', array( $style ), wp_get_theme()->get('Version') );

 	if ( is_page('write') ) {
    if (! is_admin() ) wp_enqueue_media();
    wp_enqueue_script( 'suggest' );
    wp_register_script( 'jquery.writer' , get_stylesheet_directory() . '/assets/sripts/js/jQuery/jquery.writer.js', 'suggest' , '1.23', TRUE );
		wp_enqueue_script( 'jquery.writer' );
    wp_enqueue_script( 'fancybox', get_stylesheet_directory() . '/assets/scripts/js/lib/lightbox/js/jquery.fancybox.pack.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'lightbox', get_stylesheet_directory() . '/assets/scripts/js/lib/lightbox/js/lightbox.js', array( 'fancybox' ), '1.1', null , '1.0', TRUE );
    wp_enqueue_style( 'lightbox-style', get_stylesheet_directory() . '/assets/scripts/css/lightbox/css/jquery.fancybox.css' );
  } elseif ( is_single() ) {
    wp_register_script( 'jquery.editlink' , get_stylesheet_directory() . '/js/jQuery/jquery.editlink.js', null , '0.1', TRUE );
		wp_enqueue_script( 'jquery.editlink' );
  }
}

function oembed_filter( $str ) {
  global $wp_embed;
  add_filter( 'embed_oembed_discover', '__return_false', 999 );
	$str = $wp_embed->autoembed( $str );
  remove_filter( 'embed_oembed_discover', '__return_false', 999 );
  return $str;
}

function my_default_image_size () {
  return 'large';
}

function form_default_prompt() {
  if ( get_theme_mod( 'default_prompt') != "" ) {
    return get_theme_mod( 'default_prompt');
  }	else {
    return 'Enter the content for your writing below. You must save first and preview once before it goes into the system as a draft. After that, continue to edit, save, and preview as much as needed. Remember to click  "Publish Final" when you are done. If you include your email address, we can send you a link that will allow you to make changes later.';
  }
}

function form_re_edit_prompt() {
  if ( get_theme_mod( 're_edit_prompt') != "" ) {
    return get_theme_mod( 're_edit_prompt');
  }	else {
    return 'You can now re-edit any part of this previously published writing. If you do not save any final changes, it will be left as it was before.';
  }
}

function form_item_title() {
  if ( get_theme_mod( 'item_title') != "" ) {
    echo get_theme_mod( 'item_title');
  }	else {
    echo 'The Title';
  }
}

function form_item_title_prompt() {
	 if ( get_theme_mod( 'item_title_prompt') != "" ) {
	 	echo get_theme_mod( 'item_title_prompt');
	 }	else {
	 	echo 'A good title is important! Create an eye-catching title for your story, one that would make a person who sees it want to stop whatever they are doing and read it..';
  }
}

function form_item_byline() {
  if ( get_theme_mod( 'item_byline') != "" ) {
    echo get_theme_mod( 'item_byline');
  }	else {
    echo 'How to List Author';
  }
}

function form_item_byline_prompt() {
  if ( get_theme_mod( 'item_byline_prompt') != "" ) {
    echo get_theme_mod( 'item_byline_prompt');
  }	else {
    echo 'Publish under your name, twitter handle, secret agent name, or remain "Anonymous". If you include a twitter handle such as @billyshakespeare, when someone tweets your work you will get a lovely notification.';
  }
}

function form_item_header_image() {
	 if ( get_theme_mod( 'item_header_image') != "" ) {
	 	echo get_theme_mod( 'item_header_image');
	 }	else {
	 	echo 'Header Image';
	 }
}

function form_item_header_image_prompt() {
	 if ( get_theme_mod( 'item_header_image_prompt') != "" ) {
	 	echo get_theme_mod( 'item_header_image_prompt');
	 }	else {
	 	echo 'You can upload any image file to be used in the header or choose from ones that have already been added to the site. Ideally this image should be at least 1440px wide for photos. Any uploaded image should either be your own or one licensed for re-use; provide an attribution credit for the image in the caption field below.';
	 }
}

function form_item_header_caption() {
	 if ( get_theme_mod( 'item_header_caption') != "" ) {
	 	echo get_theme_mod( 'item_header_caption');
	 }	else {
	 	echo 'Caption/credits for header image';
	 }
}

function form_item_header_caption_prompt() {
	 if ( get_theme_mod( 'item_header_caption_prompt') != "" ) {
	 	echo get_theme_mod( 'item_header_caption_prompt');
	 }	else {
	 	echo 'Provide full credit / attribution for the header image.';
	 }
}

function form_item_writing_area() {
	 if ( get_theme_mod( 'item_writing_area') != "" ) {
	 	echo get_theme_mod( 'item_writing_area');
	 }	else {
	 	echo 'Writing Area';
	 }
}

function form_item_writing_area_prompt() {
	 if ( get_theme_mod( 'item_writing_area_prompt') != "" ) {
	 	echo get_theme_mod( 'item_writing_area_prompt');
	 }	else {
	 	echo 'Use the editing area below the toolbar to write and format your writing. You can also paste formatted content here (e.g. from MS Word or Google Docs). The editing tool will do its best to preserve standard formatting--headings, bold, italic, lists, footnotes, and hypertext links. Click "Add Media" to upload images to include in your writing or choose from the media already in the media library (click on the tab labelled "media library"). You can also embed audio and video from many social sites simply by putting the URL of the media on a separate line (you will see a place holder in the editor, but the media will only show in preview and when published).  Click and drag the icon in the lower right to resize the editing space.';
	 }
}

function form_item_footer() {
	 if ( get_theme_mod( 'item_footer') != "" ) {
	 	echo get_theme_mod( 'item_footer');
	 }	else {
	 	echo 'Additional Information for Footer';
	 }
}

function form_item_footer_prompt() {
	 if ( get_theme_mod( 'item_footer_prompt') != "" ) {
	 	echo get_theme_mod( 'item_footer_prompt');
	 }	else {
	 	echo 'Add any endnote / credits information you wish to append to the end of your writing, such as a citation to where it was previously published or any other meta information. URLs will be automatically hyperlinked when published.';
	 }
}

function form_item_license() {
	 if ( get_theme_mod( 'item_license') != "" ) {
	 	echo get_theme_mod( 'item_license');
	 }	else {
	 	echo 'Creative Commons License';
	 }
}

function form_item_license_prompt() {
	 if ( get_theme_mod( 'item_license_prompt') != "" ) {
	 	echo get_theme_mod( 'item_license_prompt');
	 }	else {
	 	echo 'Choose your preferred license.';
	 }
}

function form_item_categories() {
	 if ( get_theme_mod( 'item_categories') != "" ) {
	 	echo get_theme_mod( 'item_categories');
	 }	else {
	 	echo 'Kind of Writing';
	 }
}

function form_item_categories_prompt() {
	 if ( get_theme_mod( 'item_categories_prompt') != "" ) {
	 	echo get_theme_mod( 'item_categories_prompt');
	 }	else {
	 	echo 'Check as many that apply.';
	 }
}

function form_item_tags() {
	 if ( get_theme_mod( 'item_tags') != "" ) {
	 	echo get_theme_mod( 'item_tags');
	 }	else {
	 	echo 'Tags';
	 }
}

function form_item_tags_prompt() {
	 if ( get_theme_mod( 'item_tags_prompt') != "" ) {
	 	echo get_theme_mod( 'item_tags_prompt');
	 }	else {
	 	echo 'Add any descriptive tags for your writing. Separate multiple ones with commas.';
	 }
}

function form_item_email() {
	 if ( get_theme_mod( 'item_email') != "" ) {
	 	echo get_theme_mod( 'item_email');
	 }	else {
	 	echo 'Your Email Address';
	 }
}

function form_item_email_prompt() {
	 if ( get_theme_mod( 'item_email_prompt') != "" ) {
	 	echo get_theme_mod( 'item_email_prompt');
	 }	else {
	 	echo 'If you provide an email address when your writing is published, you can request a special link that will allow you to edit it again in the future.';
	 }
}

function form_item_editor_notes() {
	 if ( get_theme_mod( 'item_editor_notes') != "" ) {
	 	echo get_theme_mod( 'item_editor_notes');
	 }	else {
	 	echo 'Extra Information for Editors';
	 }
}

function form_item_editor_notes_prompt() {
	 if ( get_theme_mod( 'item_editor_notes_prompt') != "" ) {
	 	echo get_theme_mod( 'item_editor_notes_prompt');
	 }	else {
	 	echo 'This information will *not* be published with your work, it is informational for the editor use only.';
	 }
}

function publish ( $post ) {
	 mail_edit_link ( $post->ID, 'published' );
    // Send edit link when published
}

function cc_license_html ($license, $author='', $yr='') {
	// outputs the proper license
	// $license is abbeviation. author is from post metadata, yr is from post date

	if ( !isset( $license ) or $license == '' ) return '';

	if ($license == 'copyright') {
		// boo copyrighted! sigh, slap on the copyright text. Blarg.
		return 'This work by ' . $author . ' is &copy;' . $yr . ' All Rights Reserved';
	}

	// names of creative commons licenses
	$commons = array (
		'by' => 'Attribution',
		'by-sa' => 'Attribution-ShareAlike',
		'by-nd' => 'Attribution-NoDerivs',
		'by-nc' => 'Attribution-NonCommercial',
		'by-nc-sa' => 'Attribution-NonCommercial-ShareAlike',
		'by-nc-nd' => 'Attribution-NonCommercial-NoDerivs',
	);

	// do we have an author?
	$credit = ($author == '') ? '' : ' by ' . $author;

	return '<a rel="license" href="http://creativecommons.org/licenses/' . $license . '/4.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/' . $license . '/4.0/88x31.png" /></a><br />This work' . $credit . ' is licensed under a <a rel="license" href="http://creativecommons.org/licenses/' . $license . '/4.0/">Creative Commons ' . $commons[$license] . ' 4.0 International License</a>.';
}

function page_with_template_exists ( $template ) {
	$seekpages = get_posts (array (
				'post_type' => 'page',
				'meta_key' => '_wp_page_template',
				'meta_value' => $template
			));
			$pages_found = ( count ($seekpages) ) ? true : false ;
			return ($pages_found);
}

function get_attachment_caption_by_id( $post_id ) {
    $the_attachment = get_post( $post_id );
    return ( $the_attachment->post_excerpt );
}

function get_reading_time( $prefix_string, $suffix_string ) {
  if ( shortcode_exists( 'rt_reading_time' ) ) {
		return ( $prefix_string . ' ~' . do_shortcode( '[rt_reading_time postfix="minutes" postfix_singular="minute"]' ) . $suffix_string );
	}
}

function get_twitter_name( $str ) {
	// takes an author string and extracts a twitter handle if there is one

	$found = preg_match('/@(\\w+)\\b/i', '$str', $matches);

	if ($found) {
		return $matches[0];
	} else {
		return false;
	}
}

function author_user_check( $expected_user = 'writer' ) {
	$auser = get_user_by( 'login', $expected_user );
	if ( !$auser) {
		return ('The Authoring account not set up. You need to <a href="' . admin_url( 'user-new.php') . '">create a user account</a> with login name <strong>' . $expected_user . '</strong> with a role of <strong>Author</strong>. Make a killer strong password; no one uses it. Not even you.');
	} elseif ( $auser->roles[0] != 'author') {
		// for multisite let's check if user is not member of blog
		if ( is_multisite() AND !is_user_member_of_blog( $auser->ID, get_current_blog_id() ) )  {
			return ('The user account <strong>' . $expected_user . '</strong> is set up but it has not been added as a user to this site (and needs to have a role of <strong>Author</strong>). You can <a href="' . admin_url( 'user-edit.php?user_id=' . $auser->ID ) . '">edit the account now</a>');
		} else {

			return ('The user account <strong>' . $expected_user . '</strong> is set up but needs to have it\'s role set to <strong>Author</strong>. You can <a href="' . admin_url( 'user-edit.php?user_id=' . $auser->ID ) . '">edit it now</a>');
		}
	} else {
    return ('The authoring account <strong>' . $expected_user . '</strong> is correctly set up. You are ready to Write and Roll. Or your site users are.');
  }
}

function check_user( $allowed='writer' ) {
  $current_user = wp_get_current_user();
  return ( $current_user->user_login == $allowed );
}

function twitternameify( $str ) {
  $str = preg_replace( "/@(\w+)/", "<a href=\"https://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $str );
  return $str;
}

function publink ( $redirect ) {
  if ( is_user_logged_in() and !current_user_can( 'edit_others_posts' ) )  {
    return ( wp_logout_url( $redirect ) );
  } else {
    return ( $redirect  );
  }
}

function get_page_id_by_slug( $page_slug ) {
	// pass the slug and get it's id, so we can use most basic permalink structure
	// ----- h/t https://gist.github.com/davidpaulsson/9224518

	// get page as object
	$page = get_page_by_path( $page_slug );

	if ( $page ) {
		return $page->ID;
	} else {
		return null;
	}
}

function set_html_content_type() {
  return 'text/html';
}

function br2nl ( $string ) {
  return preg_replace('/\<br(\s*)?\/?\>/i', PHP_EOL, $string);
}
}
?>
