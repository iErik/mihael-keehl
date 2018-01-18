<?php

namespace Mihael\Extras;

use Mihael\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
  * Change excerpt length
  */
function excerpt_length($length) {
  return 55;
}
add_filter('excerpt_length', __NAMESPACE__ . '\\excerpt_length', 999);

/**
  * Change post date format
  */
function post_date_format($the_date, $format, $post) {
  return date('d M Y', strtotime($post->post_date_gmt));
}
add_filter('get_the_date', __NAMESPACE__ . '\\post_date_format', 999, 3);
