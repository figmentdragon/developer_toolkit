<?php
	/**
	 * The html header for 'coming soon' or when don't want displayed'
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package THEME
	 */

	?>
	<!DOCTYPE html>
	<html <?php language_attributes(); ?>>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <!-- Loads the internal WP jQuery. Required if a 3rd party plugin loads jQuery in header instead in footer -->

	<title>
		<?php bloginfo('name'); // show the blog name, from settings ?> |
		<?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page ?>
	</title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href="//www.google-analytics.com" rel="dns-prefetch">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />

  <!-- To be placed in the head tag -->
  <link rel="stylesheet" type="text/css" href="/assets/scripts/css/node_modules/normalize/normalize.css" />
  <link rel="stylesheet" type="text/css" href="/assets/scripts/css/node_modules/reseter/reseter.css" />
  <link rel="stylesheet" type="text/css" href="/assets/scripts/css/node_modules/css-micro-reset/css-micro-reset.css" />
  <link rel="stylesheet" type="text/css" href="/assets/styles/sass/style.scss" />
  <link rel="stylesheet" type="text/css" href="style.css" />

  <?php wp_enqueue_script('jquery'); ?>
  <?php wp_head(); ?>
</head>

<script>
// conditionizr.com
// configure environment tests
conditionizr.config({
	assets: '<?php echo esc_url( get_template_directory_uri() ); ?>',
	tests: {}
});
</script>

<body class="<?php body_class(); ?>" id="<?php page_ID(); ?>">

<?php wp_body_open(); ?>
