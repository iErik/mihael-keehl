<?php

namespace Roots\Sage\Tags;


if ( !function_exists('mihael_post_tags') ) :
  /**
   * Prints HTML with information for the post tags.
   */
  function mihael_post_tags() {
    if ( 'post' == get_post_type() ) {

      /* translators: used between list items, there is a space after the comma */
      $tags_list = get_the_tag_list( '', __( ', ', 'mihael-keehl' ) );
      if ( $tags_list ) {
        printf( '<span class="post-tags">' . esc_html__( 'Tagged: %1$s', 'mihael-keehl' ) . '</span>', $tags_list );
      }
    }
  }
endif;

if ( !function_exists('mihael_post_pagination') ) :
  /**
   * Prints the post's pagination links
   */
  function mihael_post_pagination() {
    wp_link_pages(array(
      'before' => '<div class="page-links pagination">',
      'after'  => '</div>',
      'next_or_number' => 'next'
    ));
  }
endif;
