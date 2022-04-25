<?php
/**
 * The template for displaying the header for the splash page
 * @package Storytime
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body id="splash-page" <?php body_class(); ?>>
