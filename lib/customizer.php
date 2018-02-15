<?php

namespace Mihael\Customizer;

use Mihael\Assets;

function customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
  $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

  /**
   * Class Mihale_Theme_info
   */
  class Mihael_Theme_info extends \WP_Customize_Control {

    /**
     * The type of customize section being rendered.
     */
    public $type = 'info';

    /**
     * The render function for the controller
     */
    public function render_content() { }
  }

  // ___Header Section___ //
  // -------------------- //

  $wp_customize->add_section('mihael_header', array(
    'title'    => __( 'Header', 'mihael-keehl' ),
    'priority' => 10
  ));

  // Logo Upload
  // -----------

  $wp_customize->add_setting('site_logo', array(
    'default-image'     => '',
    'sanitize_callback' => 'esc_url_raw'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control(
    $wp_customize,
    'site_logo',
    array(
      'label'    => __( 'Upload your logo', 'mihael-keehl' ),
      'type'     => 'image',
      'section'  => 'mihael_header',
      'settings' => 'site_logo',
      'priority' => 11
    )
  ));

  // Logo Size
  // ---------

  $wp_customize->add_setting('logo_size', array(
    'sanitize_callback' => 'absint',
    'default'           => '85',
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control('logo_size', array(
    'type'        => 'number',
    'priority'    => 12,
    'section'     => 'mihael_header',
    'label'       => __( 'Logo size', 'mihael-keehl' ),
    'description' => __( 'Width of the logo, Default 68px', 'mihael-keehl' ),
    'input_attrs' => array(
      'min'  => 50,
      'max'  => 600,
      'step' => 2
    )
  ));

  // Logo style
  // ----------

  // TODO: Implement the sanitizer function
  $wp_customize->add_setting('logo_style', array(
    'default'           => 'show-title',
    'sanitize_callback' => __NAMESPACE__ . '\\mihael_sanitize_logo_style'
  ));

  $wp_customize->add_control('logo_style', array(
    'type'        => 'radio',
    'label'       => __( 'Logo style', 'mihael-keehl' ),
    'description' => __( 'This option applies only if you are using a logo', 'mihael-keehl' ),
    'section'     => 'mihael_header',
    'priority'    => 13,
    'choices'     => array(
      'hide-title' => __( 'Only logo', 'mihael-keehl' ),
      'show-title' => __( 'Logo plus site title and description', 'mihael-keehl' )
    )
  ));

  // ___Blog Options Section___ //
  // -------------------------- //

  $wp_customize->add_section('blog_options', array(
    'title'    => __( 'Blog options', 'mihael-keehl' ),
    'priority' => 13,
  ));

  // Excerpt
  // -------

  $wp_customize->add_setting('exc_length', array(
    'sanitize_callback' => 'absint',
    'default'           => '250',
  ));

  $wp_customize->add_control('exc_length', array(
    'type'        => 'number',
    'priority'    => 10,
    'section'     => 'blog_options',
    'label'       => __( 'Excerpt lenght', 'mihael-keehl' ),
    'description' => __( 'Choose your excerpt length. Default: 250 characters', 'mihael-keehl' ),
    'input_attrs' => array(
      'min'  => 0,
      'max'  => 600,
      'step' => 5
    )
  ));

  // ___Colors Section___ //
  // -------------------- //

  // Primary color
  // -------------

  $wp_customize->add_setting('primary_color', array(
    'default'           => '#5845E8',
    'sanitize_callback' => 'sanitize_hex_color',
  ));

  $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'primary_color', array(
    'label'    => __( 'Primary color', 'mihael-keehl' ),
    'section'  => 'colors',
    'settings' => 'primary_color',
    'priority' => 12
  )));

  // Body text
  // ---------

  $wp_customize->add_setting('body_text_color', array(
    'default'   => '#454545',
    'transport' => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));

  $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'body_text_color', array(
    'label'    => __( 'Body text', 'mihael-keehl' ),
    'section'  => 'colors',
    'settings' => 'body_text_color',
    'priority' => 15
  )));

  // Header text color
  // -----------------

  $wp_customize->add_setting('header_text_color', array(
    'default'   => '#FFF',
    'transport' => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));

  $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'header_text_color', array(
    'label'    => __( 'Header text', 'mihael-keehl' ),
    'section'  => 'colors',
    'settings' => 'header_text_color',
    'priority' => 15
  )));

  // Post Heading Color
  // ------------------

  $wp_customize->add_setting('post_heading_color', array(
    'default'           => "#454545",
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'post_heading_color', array(
    'label'    => __( 'Post headings', 'mihael-keehl' ),
    'section'  => 'colors',
    'priority' => 16
  )));

  // Post Content Color
  // ------------------

  $wp_customize->add_setting('post_content_color', array(
    'default'           => "#525252",
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'post_content_color', array(
    'label'    => __( 'Post content', 'mihael-keehl' ),
    'section'  => 'colors',
    'priority' => 17
  )));

  // ___Social Section___ //
  // -------------------- //

  $wp_customize->add_section('mihael_social', array(
    'title'       => __( 'Social', 'mihael-keehl' ),
    'priority'    => 21,
    'description' => __( 'To create a social profile like in the theme demo, do this:<br><ol><li>Go to Appearance > Menus;</li><li>Create a new menu and add links to your social networks by using the Custom Links tab;</li><li>Assign that newly created menu to the Social position.</li></ol>', 'mihael-keehl' ),
  ));

  $wp_customize->add_setting('mihael_theme_social', array(
    'type'              => 'info_control',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr'
  ));

  // TODO: Implement this class
  $wp_customize->add_control(new Mihael_Theme_info($wp_customize, 'social', array(
    'section'  => 'mihael_social',
    'settings' => 'mihael_theme_social',
    'priority' => 10
  )));
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('mihael/customizer', get_template_directory_uri() . '/dist/scripts/customizer.js', ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');


//  Helper Functions
//  ----------------

/**
 * Logo style
 */
function mihael_sanitize_logo_style( $input ) {
  $valid = array(
    'hide-title' => __( 'Only logo', 'mihael-keehl' ),
    'show-title' => __( 'Logo plus site title and description', 'mihael-keehl' ),
  );

  if ( array_key_exists( $input, $valid ) ) {
    return $input;
  } else {
    return '';
  }
}
