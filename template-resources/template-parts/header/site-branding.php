<?php
/**
 * Template part for site-branding
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package creativity
 */

 $blog_info    = get_bloginfo( 'name' );
 $description  = get_bloginfo( 'description', 'display' );
 $show_title   = ( true === get_theme_mod( 'display_title_and_tagline', true ) );
 $header_class = $show_title ? 'site-title' : 'screen-reader-text';

?>

<div class="site-branding">
	<?php has_custom_logo() ? the_custom_logo() : ''; ?>

	<div class="site-identity">
		<?php if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
		endif;

		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) : ?>
			<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
		<?php
		endif; ?>
	</div><!-- .site-branding-text-->
</div><!-- .site-branding -->
