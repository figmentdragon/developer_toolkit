<?php
function themename_theme_features() {
	add_theme_support( 'align-wide' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'custom-background',
    apply_filters(
      'themename_custom_background_args',
      array(
        'default-color' => 'ffffff',
        'default-image' => '',
      )
    )
  );
  add_theme_support( 'customize-selective-refresh-widgets' );
  add_theme_support( 'custom-logo',
    array(
      'height'      => 512,
      'width'       => 512,
      'flex-width'  => true,
      'flex-height' => true,
    )
  );
  add_theme_support( 'editor-font-sizes',
    [
			[
				'name' => __( 'Small', 'themename' ),
				'size' => 12,
				'slug' => 'small',
			],
			[
				'name' => __( 'Normal', 'themename' ),
				'size' => 16,
				'slug' => 'normal',
			],
			[
				'name' => __( 'Large', 'themename' ),
				'size' => 36,
				'slug' => 'large',
			],
			[
				'name' => __( 'Huge', 'themename' ),
				'size' => 50,
				'slug' => 'huge',
			],
		]
	);
  add_theme_support( 'html5',
    array(
      'caption',
      'comment-form',
      'comment-list',
      'gallery',
      'search-form',
      'style',
      'script',
    )
  );
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'full-width', 1920, 1080, false );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'title-tag' );

}
?>
