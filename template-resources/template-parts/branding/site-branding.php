<?php
/**
 * Template part for displaying the logo, site title and header banner.
 *
 * @package Highstarter
 *
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

 $blog_info    = get_bloginfo( 'name' );
 $description  = get_bloginfo( 'description', 'display' );
 $show_title   = ( true === get_theme_mod( 'display_title_and_tagline', true ) );
 $header_class = $show_title ? 'site-title' : 'screen-reader-text';

?>

  <?php if ( has_custom_logo() && $show_title ) : ?>
  	<div class="site-logo"><?php the_custom_logo();
    if ( class_exists( 'Responsive_Addons_Pro' ) ) {

			echo Responsive\Core\responsive_sticky_custom_logo();
		}
		echo Responsive\Core\responsive_mobile_custom_logo();
		?>
  </div>
  <?php endif; ?>

  <div class="site-branding">

    <?php if(has_header_image( ) ) : ?>
    <div class="image-overlay">
        <div class="hero-text">
        <!--Site Title and Description-->
        <?php if (display_header_text()==true) : ?>
          <?php if ( $blog_info ) : ?>
        		<?php if ( is_front_page() && ! is_paged() ) : ?>
              <h1 class="<?php echo esc_attr( $header_class ); ?>"><?php echo esc_html( $blog_info ); ?></h1>
            <?php elseif ( is_front_page() || is_home() ) : ?>
              <h1 class="<?php echo esc_attr( $header_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $blog_info ); ?></a></h1>
            <?php

            else :

              ?>
              <p class="<?php echo esc_attr( $header_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $blog_info ); ?></a></p>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ( $description && true === get_theme_mod( 'display_title_and_tagline', true ) ) : ?>
        		<p class="site-description">
        			<?php echo $description; // phpcs:ignore WordPress.Security.EscapeOutput ?>
        		</p>
        	<?php endif; ?>
        </div><!-- .site-branding -->


        <!--Call to action-->
        <?php highstarter_call_to_action() ?>
        </div>
    </div>
    <?php else:
         // Site Title and Description
        if (display_header_text()==true) : ?>
        <div class="no-header-image">
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" style="padding-top: 1em" rel="home">
                    <?php bloginfo('name');?>
                </a>
            </h1>

        <?php
        if ( ! get_theme_mod( 'responsive_hide_tagline', 1 ) ) :
          $response_description = get_bloginfo( 'description', 'display' );
          if ( $response_description || is_customize_preview() ) :
            ?>
            <p class="site-description"><?php echo esc_html( $response_description ); ?></p>
    				<?php
           endif
           ; ?>
        </div>
        <?php endif;
    endif; ?>
</div>
