<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  load_theme_textdomain('mihael-keehl', get_template_directory() . '/languages');

  // Enable custom background color
  add_theme_support('custom-background', array(
    'default-color' => '#F9F9F9'
  ));

  // Enable post formats
  add_theme_support('post-formats', ['image', 'video', 'audio']);

  // Enable plugins to manage the document title
  add_theme_support('title-tag');

  // Enable HTML5 markup support
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Register wp_nav_menu() menus
  register_nav_menus([
    'primary' => __('Primary Menu', 'mihael-keehl'),
    'social'  => __('Social', 'mihael-keehl')
  ]);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Sidebar', 'mihael-keehl'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section id="%1$s" class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');


/**
 * Exclude pages from WordPress search page
 */
if (!is_admin()) {
  function wp_search_filter($query) {
    if ($query->is_search) {
      $query->set('post_type', 'post');
    }

    return $query;
  }

  add_filter('pre_get_posts', __NAMESPACE__ . '\\wp_search_filter');
}

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('mihael-keehl/css', Assets\asset_path('styles/main.css'), false, null);

  wp_enqueue_style('mihael-keehl/fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&amp;subset=latin-ext');
  wp_enqueue_style('mihael-keehl/fonts', '//fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i&amp;subset=latin-ext');
  wp_enqueue_style('mihael-keehl/icons', '//file.myfontastic.com/ZoTwybVoHdbmHbuBDUUrJL/icons.css');

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets' );
