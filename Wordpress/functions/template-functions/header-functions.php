<?php
/**
 * Functions for the header
 */


add_action( 'logo', 'construct_logo' );

function construct_logo() {
  $custom_logo_id = get_theme_mod( 'custom_logo' );
  $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
  if ( has_custom_logo() ) {
    echo '<img src="'. esc_url( $logo[0] ) .'">';
  } else { ?>
    <img src="<?php echo esc_url( theme_directory() ); ?>/assets/images/logo/logo-corner.png" class="logo logo-img" width="500" height="500"/>
     <?php }?>
   }
