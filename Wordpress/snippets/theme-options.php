<?php

/**
 * Theme Options
 * Available in WP Backend through Design > Customize
 *
 * use get_theme_mod('option_name') to retrieve options
 *
 */

namespace Roots\Sage\Init;

function customize_register($wp_customize)
{
  /**
   * Project Settings
   */

  // first declare settings
  $wp_customize->add_setting(
    'projects_page_id',
    [
      'default'   => 0,
      'transport' => 'refresh',
    ]
  );

  $wp_customize->add_setting(
    'social_fb_url',
    [
      'default'   => 0,
      'transport' => 'refresh',
    ]
  );

  $wp_customize->add_setting(
    'social_xing_url',
    [
      'default'   => 0,
      'transport' => 'refresh',
    ]
  );

  $wp_customize->add_setting(
    'social_linkedin_url',
    [
      'default'   => 0,
      'transport' => 'refresh',
    ]
  );

  // declare sections
  $wp_customize->add_section(
    'projects_section',
    [
      'title'    => __('Projects', 'TheThemeName'),
      'priority' => 30,
    ]
  );

  $wp_customize->add_section(
    'social_section',
    [
      'title'    => __('Social Media', 'TheThemeName'),
      'priority' => 30,
    ]
  );

  // add control elements to sections
  $wp_customize->add_control(
    new \WP_Customize_Control(
      $wp_customize,
      'projects_page_id',
      [
        'label'    => __('Side "Project":', 'TheThemeName'),
        'section'  => 'projects_section',
        'settings' => 'projects_page_id',
        'type'     => 'dropdown-pages',
      ]
    )
  );

  $wp_customize->add_control(
    new \WP_Customize_Control(
      $wp_customize,
      'social_fb_url',
      [
        'label'    => __('URL Facebook', 'TheThemeName'),
        'section'  => 'social_section',
        'settings' => 'social_fb_url',
        'type'     => 'text',
      ]
    )
  );

  $wp_customize->add_control(
    new \WP_Customize_Control(
      $wp_customize,
      'social_xing_url',
      [
        'label'    => __('URL XING', 'TheThemeName'),
        'section'  => 'social_section',
        'settings' => 'social_xing_url',
        'type'     => 'text',
      ]
    )
  );

  $wp_customize->add_control(
    new \WP_Customize_Control(
      $wp_customize,
      'social_linkedin_url',
      [
        'label'    => __('URL LinkedIn', 'TheThemeName'),
        'section'  => 'social_section',
        'settings' => 'social_linkedin_url',
        'type'     => 'text',
      ]
    )
  );
}

add_action('customize_register', __NAMESPACE__.'\\customize_register');
