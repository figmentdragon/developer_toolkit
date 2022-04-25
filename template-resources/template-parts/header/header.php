<?php /* Template Name: Header */ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/assets/scripts/css/boostrap.css"/>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  	<link rel="stylesheet" type="text/css" href="/assets/scripts/css/node_modules/normalize/normalize.css" />
 	<link rel="stylesheet" type="text/css" href="/assets/scripts/css/node_modules/reseter/reseter.css" />
  	<link rel="stylesheet" type="text/css" href="/assets/scripts/css/node_modules/css-micro-reset/css-micro-reset.css" />
  	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="/assets/styles/css/theme.css" />

<script>
// conditionizr.com
// configure environment tests
    conditionizr.config({
        assets: '<?php echo esc_url( get_template_directory_uri() ); ?>',
        tests: {}
    });
</script>

<?php wp_enqueue_script('jquery'); ?>
<?php wp_head() ?>

</head>
=======


  <title>
  	<?php bloginfo('name'); // show the blog name, from settings ?> |
  	<?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page ?>
  </title>

  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<script>
	// conditionizr.com
	// configure environment tests
	    conditionizr.config({
	        assets: '<?php echo esc_url( get_template_directory_uri() ); ?>',
	        tests: {}
	    });
	</script>

	<?php wp_enqueue_script('jquery'); ?>
	<?php wp_head() ?>

  <link rel="dns-prefetch" href="//google-analytics.com">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />

  </head>
>>>>>>> pr-6/figmentdragon/page-templates
