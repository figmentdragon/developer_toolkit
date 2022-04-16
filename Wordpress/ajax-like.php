<?php

$post_id        = isset($_POST['page_id']) ? $_POST['page_id'] : '';
$like_status           = isset($_POST['like_status']) ? $_POST['like_status'] : 'liked';

$likes = get_post_meta($post_id, 'creativity_post_likes', true);

if ($like_status == 'liked' && $likes > 0) {
	$likes++;
} else if ($like_status == 'unliked' && $likes > 0) {
	$likes--;
} else {
	$likes = 1;
}

update_post_meta($post_id, 'creativity_post_likes', $likes);

echo $likes;

exit;
?>
