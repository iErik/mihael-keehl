<?php

namespace Roots\Sage\Titles;

/**
 * Page titles
 */
function title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Posts', 'mihael-keehl');
    }
  } elseif (is_archive()) {
    return get_the_archive_title();
  } elseif (is_search()) {
    return sprintf(__('Search Results for "%s"', 'mihael-keehl'), get_search_query());
  } elseif (is_404()) {
    return __('404 - Page Not Found', 'mihael-keehl');
  } else {
    return get_the_title();
  }
}

function comments_title() {
  $comments_number = get_comments_number();

  if ($comments_number === '0') {
    _e('No comments', 'mihael-keehl');
  } else if ($comments_number === '1') {
    _e('One comment', 'mihael-keehl');
  } else {
    printf(
      __('%s comments', 'mihael-keehl'),
      number_format_i18n($comments_number)
    );
  }
}

function get_excerpt() {
  $excerpt = get_the_content();
  $excerpt = preg_replace(" ([.*?])",'',$excerpt);
  $excerpt = strip_shortcodes($excerpt);
  $excerpt = wp_strip_all_tags($excerpt);
  $excerpt = substr($excerpt, 0, 250);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
  $excerpt = $excerpt.' ... ';
  return $excerpt;
}
