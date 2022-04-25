<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320" />
  <title>
  	<?php bloginfo('name'); // show the blog name, from settings ?> |
  	<?php is_front_page() ? bloginfo('description') : wp_title(''); ?>the CREATIVITY ARCHITECT
  </title>

  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <?php wp_head(); ?>

	<?php // drop Google Analytics Here ?>

  </head>
