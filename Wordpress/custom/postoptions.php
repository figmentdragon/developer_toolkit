<?php
add_action("admin_init", "themename_post_meta_boxes");

function themename_post_meta_boxes() {
    $global_types = array('post','page');
    $types = array('post', 'page');

    // add meta box for commons options in posts and pages

    add_meta_box("post_options", sprintf(__('%s - Post Options.', 'writing'), theme_name), "themename_posts_meta_options", "post", "normal", "core");

    add_meta_box("Page_options", sprintf(__('%s - Page Options.', 'writing'), theme_name), "themename_page_options", "page", "normal", "core");

    add_meta_box("themename_blog_template_box", sprintf(__('%s - Blog Template Options.', 'writing'), theme_name), "page_blog_template_options", "page", "normal", "high");
    add_meta_box("themename_authorslist_template_box", sprintf(__('%s - Authors List Options.', 'writing'), theme_name), "page_authorslist_template_options", "page", "normal", "high");

    foreach ($global_types as $type) {
        add_meta_box("themename_general_page_options", sprintf(__('%s - General Page Options.', 'writing'), theme_name), "themename_global_options", $type, "normal", "core");
    }
}

function themename_post_options($value, $validation = "") {
    global $post;

    $depends_on_templates = "";
    if (isset($value['templates']) && $value['templates'] != "" ) {

        $mother_templates_atts = '';
        foreach($value['templates'] as $template) {
            $mother_templates_atts .= 'page-templates/'.$template.'.php ';
        }
        $depends_on_templates = ' data_mother_templates="'.$mother_templates_atts.'"';
    }
    ?>

    <div class="option-item themename_post_option_item" id="<?php echo esc_attr($value['id']) ?>-item" <?php echo esc_attr($depends_on_templates); ?> >
        <span class="label"><?php echo esc_attr($value['name']); ?></span>
        <?php
        $id = esc_attr($value['id']);
        $get_meta = get_post_custom($post->ID);
        $current_value = "";
        if (isset($value['default']) && $value['default']) {
        	$current_value = $value['default'];
        }
        if (isset($get_meta[$id][0])) {
            if ($validation == 'html') {
                $current_value = balanceTags($get_meta[$id][0]);
            }elseif($validation == 'url') {
                $current_value = esc_url($get_meta[$id][0]);
            }elseif($validation == 'attr') {
                $current_value = esc_attr($get_meta[$id][0]);
            }else{
                $current_value = $get_meta[$id][0];
            }
        }

        switch ($value['type']) {

            case 'text':
                ?>
                <input  name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" type="text" value="<?php echo esc_attr($current_value) ?>" />
                <?php
                break;

            case 'color':
                ?>
                <input class="themename_color" name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" type="text" value="<?php echo esc_attr($current_value) ?>"  />
                <?php
                break;

            case 'image':
                ?>
                <input  name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" class="input-upload" type="text" value="<?php echo esc_attr($current_value) ?>" />
                <a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
                <?php
                break;

            case 'video':
                ?>
                <input  name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" class="input-upload" type="text" value="<?php echo esc_attr($current_value) ?>" />
                <a href="#" class="aq_upload_button button" rel="video">Upload</a><p></p>
                <?php
                break;

            case 'select':
                ?>
                <select name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>">
                    <?php foreach ($value['options'] as $key => $option) { ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php
                        if ($current_value == $key) {
                            echo ' selected="selected"';
                        }
                        ?>><?php echo esc_attr($option); ?></option>
                            <?php } ?>
                </select>
                <?php
                break;

            case 'multiselect':
                ?>
                <select multiple name="<?php echo esc_attr($value['id']); ?>[]" id="<?php echo esc_attr($value['id']); ?>">
                    <?php foreach ($value['options'] as $key => $option) { ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php
                        if (strpos($current_value, esc_attr($key)) !== false) {
                            echo ' selected="selected"';
                        }
                        ?>><?php echo esc_attr($option); ?></option>
                            <?php } ?>
                </select>
                <?php
                break;

            case 'textarea':
                ?>
                <textarea name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" type="<?php echo esc_attr($value['type']); ?>" cols="" rows=""><?php echo esc_attr($current_value) ?></textarea>
                <?php
                break;
        }
        ?>
    </div>
    <?php
}


function themename_page_options() {

    themename_post_options(
            array("name" => __("Show Title", 'writing'),
                "id" => "themename_show_title",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'yes' => __('Yes', 'writing'),
                    'no' => __('No', 'writing')
    )));

    themename_post_options(
      array("name" => __("Set Pages Title Style like Posts Title Style", 'writing'),
      "id" => "themename_plain_page_title",
      "type" => "select",
      "options" => array(
        false => __('Same as site options', 'writing'),
        'yes' => __('Yes', 'writing'),
        'no' => __('No', 'writing')
      )));

    themename_post_options(
            array("name" => __("Show Share Icons", 'writing'),
                "id" => "themename_show_share",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'yes' => __('Yes', 'writing'),
                    'no' => __('No', 'writing')
    )));

    themename_post_options(
            array("name" => __("Show Author Box", 'writing'),
                "id" => "show_author_box",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'yes' => __('Yes', 'writing'),
                    'no' => __('No', 'writing')
    )));

    themename_post_options(
            array("name" => __("Enable Facebook Comments", 'writing'),
                "id" => "themename_enable_facebook_comments",
                "type" => "select",
                "options" => array(
                    'no' => __('No', 'writing'),
                    'yes' => __('Yes', 'writing'),
    )));

    wp_nonce_field( basename( __FILE__ ), 'themename_page_options' );

}

add_action('save_post', 'save_page_options');
function save_page_options() {
    global $post;

    if ( isset($post) ) : // check if post is exists

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['themename_page_options'] ) || !wp_verify_nonce( $_POST['themename_page_options'], basename( __FILE__ ) ) )
        return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

        $custom_meta_fields = array(
          'themename_show_title',
          'themename_plain_page_title',
          'themename_show_share',
          'show_author_box',
          'themename_enable_facebook_comments',
        );

    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }

    endif; // end if check if post is exists
}

function page_authorslist_template_options() {

    themename_post_options(
            array("name" => __("Order Users by", 'writing'),
                "id" => "themename_author_orderby_list",
                "type" => "select",
                "options" => array(
                    'registered' => __('Registration Order', 'writing'),
                    'display_name' => __('Name', 'writing'),
                    'post_count' => __('Number Of Posts', 'writing')
    )));

		$users = get_users(array('fields' => array('ID', 'display_name')));
    $users_array = array(
      false => __('All Users', 'writing')
    );
    foreach ($users as $user) {
      $users_array[$user->ID] = $user->display_name;
    }
    themename_post_options(
            array("name" => __("Users to Show", 'writing'),
                "id" => "themename_author_ids_list",
                "type" => "multiselect",
                "options" => $users_array,
              ));

    themename_post_options(
            array("name" => __("Show Author's posts", 'writing'),
                "id" => "show_author_posts_list",
                "type" => "select",
                "options" => array(
                    false => __('No', 'writing'),
                    true => __('Yes', 'writing'),
    )));

    wp_nonce_field( basename( __FILE__ ), 'page_authorslist_template_options' );

}

add_action('save_post', 'save_page_authorslist_template_options');
function save_page_authorslist_template_options() {
    global $post;

    if ( isset($post) ) : // check if post is exists

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['page_authorslist_template_options'] ) || !wp_verify_nonce( $_POST['page_authorslist_template_options'], basename( __FILE__ ) ) )
        return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

        $custom_meta_fields = array(
          'themename_author_ids_list',
          'themename_author_orderby_list',
          'show_author_posts_list',
        );

    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
					if ($custom_meta_field == 'themename_author_ids_list') {
            $array = implode(',', $_POST[$custom_meta_field]);
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($array)));
          } else {
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
          }
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }

    endif; // end if check if post is exists
}

function themename_posts_meta_options() {

    themename_post_options(
            array("name" => __("Show Title", 'writing'),
                "id" => "themename_show_title",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'yes' => __('Yes', 'writing'),
                    'no' => __('No', 'writing')
    )));

    themename_post_options(
            array("name" => __("Show Meta Info", 'writing'),
                "id" => "themename_show_meta",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'yes' => __('Yes', 'writing'),
                    'no' => __('No', 'writing')
    )));

    themename_post_options(
            array("name" => __("Show Share Icons", 'writing'),
                "id" => "themename_show_share",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'yes' => __('Yes', 'writing'),
                    'no' => __('No', 'writing')
    )));

    themename_post_options(
            array("name" => __("Show Author Box", 'writing'),
                "id" => "show_author_box",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'yes' => __('Yes', 'writing'),
                    'no' => __('No', 'writing')
    )));

    themename_post_options(
            array("name" => __("Custom Description", 'writing'),
                "id" => "themename_custom_description",
                "type" => "textarea",
                "default" => "",
                ));

    wp_nonce_field( basename( __FILE__ ), 'themename_posts_meta_options' );
}

add_action('save_post', 'themename_save_post');

function themename_save_post() {
    global $post;

    if ( isset($post) ) : // check if post is exists
    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['themename_posts_meta_options'] ) || !wp_verify_nonce( $_POST['themename_posts_meta_options'], basename( __FILE__ ) ) )
        return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

    $custom_meta_fields = array(
      'themename_show_meta',
      'themename_show_share',
      'themename_show_title',
      'show_author_box',
      'themename_custom_description',
    );
    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }
    endif; // end if check if post is exists
}

function page_blog_template_options() {
    themename_post_options(
            array("name" => __("Pagination Style", 'writing'),
                "id" => "themename_pagination_style",
                "type" => "select",
                "templates" => array('blog'),
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'nav' => __('Older/Newer Links', 'writing'),
                    'num' => __('Numerical', 'writing'),
                    'ajax' => __('Ajax', 'writing')
    )));

    themename_post_options(
            array("name" => __("Blog Style", 'writing'),
                "id" => "themename_blog_style",
                "type" => "select",
                "templates" => array('blog'),
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'default' => __('Default (Classic)', 'writing'),
                    'banners' => __('Banners First', 'writing'),
                    'masonry' => __('Masonry', 'writing'),
                    'list' => __('List', 'writing'),
                    'banner_grid' => __('Masonry with Featured Post', 'writing'),
                    'banner_list' => __('List with Featured Post', 'writing'),
    )));

    themename_post_options(
            array("name" => __("Number of Posts (Leave blank for default)", 'writing'),
                "id" => "themename_blog_page_posts_number",
                "type" => "text",
                "templates" => array('blog'),
                "default" => "",
    ));

    $cats = get_categories();
    $cat_array = array(
      false => __('All Categories', 'writing')
    );
    foreach ($cats as $cat) {
      $cat_array[$cat->term_id] = $cat->name;
    }
    themename_post_options(
            array("name" => __("Category", 'writing'),
                "id" => "themename_blog_page_cat",
                "type" => "multiselect",
                "templates" => array('blog'),
                "options" => $cat_array,
              ));

    wp_nonce_field( basename( __FILE__ ), 'page_blog_template_options' );

}

add_action('save_post', 'save_blog_template');

function save_blog_template() {
    global $post;

    if ( isset($post) ) : // check if post is exists

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['page_blog_template_options'] ) || !wp_verify_nonce( $_POST['page_blog_template_options'], basename( __FILE__ ) ) )
        return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

    $custom_meta_fields = array(
        'themename_blog_style',
        'themename_pagination_style',
        'themename_blog_page_cat',
        'themename_blog_page_posts_number',
    );

    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
          if ($custom_meta_field == 'themename_blog_page_cat') {
            $array = implode(',', $_POST[$custom_meta_field]);
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($array)));
          } else {
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
          }
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }

    endif; // end if check if post is exists
}



function themename_global_options() {

	?>
	<script type="text/javascript">
	jQuery(window).on('load', function () {
		var selector = jQuery('.editor-page-attributes__template select').attr('value');
		if (selector === 'page-templates/blog.php') {
			jQuery('#themename_blog_template_box').show();
			jQuery('#Page_options').hide();
			jQuery('#themename_authorslist_template_box').hide();
		} else if (selector == 'page-templates/authors_list.php'){
			jQuery('#themename_blog_template_box').hide();
			jQuery('#Page_options').hide();
			jQuery('#themename_authorslist_template_box').show();
		} else if (selector == '') {
			jQuery('#themename_authorslist_template_box').hide();
			jQuery('#themename_blog_template_box').hide();
			jQuery('#Page_options').show();
		}
	});
	jQuery(document).on('change', '.editor-page-attributes__template select', function () {
		var selector = jQuery('.editor-page-attributes__template select').attr('value');
		if (selector === 'page-templates/blog.php') {
			jQuery('#themename_blog_template_box').show();
			jQuery('#Page_options').hide();
			jQuery('#themename_authorslist_template_box').hide();
		} else if (selector == 'page-templates/authors_list.php'){
			jQuery('#themename_blog_template_box').hide();
			jQuery('#Page_options').hide();
			jQuery('#themename_authorslist_template_box').show();
		} else if (selector == '') {
			jQuery('#themename_authorslist_template_box').hide();
			jQuery('#themename_blog_template_box').hide();
			jQuery('#Page_options').show();
		}
	});
	</script>
	<?php

    themename_post_options(
            array("name" => __("Sidebar Position", 'writing'),
                "id" => "themename_sidebar_position",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'left' => __('Left Sidebar', 'writing'),
                    'right' => __('Right Sidebar', 'writing'),
                    'none' => __('No Sidebar', 'writing'),
    )));

    themename_post_options(
            array("name" => __("Sliding Sidebar", 'writing'),
                "id" => "themename_enable_sliding_sidebar",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'yes' => __('Show', 'writing'),
                    'no' => __('Hide', 'writing'),
    )));

    themename_post_options(
            array("name" => __("Enable Sticky Menu", 'writing'),
                "id" => "themename_sticky_menu",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'writing'),
                    'yes' => __('Yes', 'writing'),
                    'no' => __('No', 'writing'),
    )));


    wp_nonce_field( basename( __FILE__ ), 'themename_global_options' );
}

add_action('save_post', 'save_global');
function save_global() {
    global $post;

    if ( isset($post) ) : // check if post is exists

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['themename_global_options'] ) || !wp_verify_nonce( $_POST['themename_global_options'], basename( __FILE__ ) ) )
        return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

    $custom_meta_fields = array(
        'themename_sidebar_position',
        'themename_enable_sliding_sidebar',
        'themename_sticky_menu'
    );

    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }

    endif; // end if check if post is exists
}
?>
