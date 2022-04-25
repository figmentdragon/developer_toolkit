<?php

$loopFile        = $_POST['loop_file'];
$paged           = $_POST['page_no'];
$posts_per_cycle  = $_POST['posts_per_page'];
$post_type  = $_POST['post_type'];
$ajaxpost_id = $_POST['pageid'];
if ( isset( $_GET[ 'wpml_lang' ] ) ) {
    do_action( 'wpml_switch_language',  $_GET[ 'wpml_lang' ] ); // switch the content language
}
$query_vars = $_POST['query_vars'];
$query_vars = json_decode(stripslashes($query_vars), true);
if (array_key_exists("page", $query_vars)) {
  $args = array();
} else {
$args = $query_vars;
}
# Load the posts
$args['posts_per_page'] = $posts_per_cycle;
$args['paged'] = $paged;
$wp_query = new WP_Query($args);

include(locate_template('content.php'));
wp_reset_query();
exit;
?>
