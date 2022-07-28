<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title(''); ?><?php if ( wp_title( '', false) ) { echo ': '; } ?><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
    </title>

    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
		<meta name="description" content="<?php bloginfo( 'description' ); ?>">

    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
    <?php endif; ?>

    <script src="https://kit.fontawesome.com/a52bc36f18.js" crossorigin="anonymous"></script>

    <?php wp_head(); ?>
		<script>
		// conditionizr.com
		// configure environment tests
		conditionizr.config({
			assets: '<?php echo esc_url( get_template_directory_uri() ); ?>',
			tests: {}
		});
		</script>

</head>

<body "<?php body_class();?>">

	<?php do_action( 'wp_body_open' ); ?>

<div class="wrapper-header">
  <header>

  </header>
</div><!--wrapper-header-->
  <div class="wrapper">
