<?php

		$username				 = $_POST['username'];
		$number					 = $_POST['number'];
		$include_media	 = $_POST['include_media'];
		$extend_tweet		 = $_POST['extend_tweet'];
		$exclude_replies = $_POST['exclude_replies'];
    $consumerkey = creativity_option('creativity_conk_id');
    $consumersecret = creativity_option('creativity_cons_id');
    $accesstoken = creativity_option('creativity_at_id');
    $accesstokensecret = creativity_option('creativity_ats_id');

    echo creativity_twitter_tweets($consumerkey, $consumersecret, $accesstoken, $accesstokensecret, $username, $number, $include_media, $extend_tweet, $exclude_replies);
