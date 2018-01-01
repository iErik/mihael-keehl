<?php
/**
 * Mihael style functions
 */

function mihael_hex2rgba( $color, $opacity = false ) {

  if ( $color[0] == '#' ) {
    $color = substr( $color, 1 );
  }
    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    $rgb = array_map( 'hexdec', $hex );
    $output = 'rgba(' . implode( ',',$rgb ) . ',' . $opacity . ')';

    return $output;
}

function color_luminance($hexcolor, $percent)
{
  if ( strlen( $hexcolor ) < 6 ) {
    $hexcolor = $hexcolor[0] . $hexcolor[0] . $hexcolor[1] . $hexcolor[1] . $hexcolor[2] . $hexcolor[2];
  }
  $hexcolor = array_map('hexdec', str_split( str_pad( str_replace('#', '', $hexcolor), 6, '0' ), 2 ) );

  foreach ($hexcolor as $i => $color) {
    $from = $percent < 0 ? 0 : $color;
    $to = $percent < 0 ? $color : 255;
    $pvalue = ceil( ($to - $from) * $percent );
    $hexcolor[$i] = str_pad( dechex($color + $pvalue), 2, '0', STR_PAD_LEFT);
  }

  return '#' . implode($hexcolor);
}

function mihael_custom_styles( $custom ) {
  $custom = '';

  // Logo size
  $logo_size = get_theme_mod( 'logo_size', '68' );
  if ( !empty($logo_size) ) {
    $custom .= '.page-header img.site-logo { width:' . intval($logo_size) . 'px; }' . "\n";
  }

  // Body background color
  $body_bg = get_theme_mod('background_color', "#F9F9F9");
  if ( !empty($body_bg) && ($body_bg != '#F9F9F9') ) {
    $custom .= '.posts-navigation .nav-previous, .posts-navigation .nav-next { background-color:' . color_luminance($body_bg, -0.055) . ' !important; border-color:' . color_luminance($body_bg, -0.10) . ' !important;}' . "\n";
    $custom .= '.page-links a { background-color: ' . color_luminance($body_bg, -0.055) . ' !important; border-color: ' . color_luminance($body_bg, -0.10) . ' !important;}' . "\n";
    $custom .= 'blockquote { border-color: ' . color_luminance($body_bg, -0.225) . ' !important; background-color: ' . color_luminance($body_bg, -0.055) . ' !important;}' . "\n";
    $custom .= 'blockquote::before { color: ' . color_luminance($body_bg, -0.3755) . ' !important;}' . "\n";
    $custom .= 'blockquote cite { color: ' . color_luminance($body_bg, -0.3755) . ' !important;}' . "\n";
    $custom .= '.post-feed .hentry { border-color:' . color_luminance($body_bg, -0.103) . ' !important;}' . "\n";
    $custom .= '.post-feed .hentry .post-category { background-color:' . color_luminance($body_bg, -0.06) . ' !important;}' . "\n";
    $custom .= '.comments-area .comment-list .comment { border-color:' . color_luminance($body_bg, -0.06) . ' !important;}' . "\n";
    $custom .= '.comments-area .comment-list .comment .reply { background-color:' . color_luminance($body_bg, -0.08) . ' !important;}' . "\n";
  }

  // Body Text Color
  $body_text_color = get_theme_mod( 'body_text_color', "#454545");
  if ( !empty($body_text_color) && ($body_text_color != '#454545') ) {
    $custom .= 'body { color:' . esc_attr($body_text_color) . ' !important ;}' . "\n";
    $custom .= '.single-post .post.hentry .post-footer, .page-template-default .page.hentry .post-footer { color: ' . color_luminance($body_text_color, -0.3855) . ' !important; }' . "\n";
    $custom .= '.comments-heading::after, .comments-heading::before { background-color:' . mihael_hex2rgba($body_text_color, 0.54) .  ' !important; }' . "\n";
    $custom .= '.comment-body .comment-author .says, .comment-body .comment-metadata a { color:' . color_luminance($body_text_color, 0.05) . ' !important; }' . "\n";
    $custom .= '.error404 .error-404 .search-field-wrapper { border-color:' . esc_attr($body_text_color) . ' !important; color:' . mihael_hex2rgba($body_text_color, 0.74) . ' !important;}' . "\n";
  }

  // Primary color
  $primary_color = get_theme_mod( 'primary_color', '#5845E8');

  if ( !empty($primary_color) ) {
    $custom .= 'a { color: ' . esc_attr($primary_color) . ';}' . "\n";
  }

  if ( !empty($primary_color) && ($primary_color != '#5845E8') ) {
    $custom .= '.bypostauthor { color: ' . esc_attr($primary_color) . ' !important; }' . "\n";
    $custom .= '.header, .page-header-mobile .widget-area { background-color:' . esc_attr($primary_color) . ' !important;}' . "\n";
    $custom .= '.page-template-page-sans-serif .panel-right .post-heading .title::after { background-color:' . esc_attr($primary_color) . ' !important; }' . "\n";
  }

  // Header Text Color
  $header_text_color = get_theme_mod('header_text_color', "#FFF");
  if ( !empty($header_text_color) && ($header_text_color != '#FFF') ) {
    $custom .= '.header, .page-header-mobile .widget-area { color:' . esc_attr($header_text_color) . ' !important; }' . "\n";
    $custom .= '.header .panel-control .search-field { color:' . mihael_hex2rgba($header_text_color, 0.0) . '!important ; border-color: ' . mihael_hex2rgba($header_text_color, 0.0) . ' !important;}' . "\n";
    $custom .= '.header .panel-control .search-form.is-active .search-field { color:' . mihael_hex2rgba($header_text_color, 0.9) . ' !important; border-color: ' . mihael_hex2rgba($header_text_color, 0.5) . ' !important;}' . "\n";
    $custom .= '.header .widget-area .widget_search .search-form label { border-color: ' .mihael_hex2rgba($header_text_color, 0.5) . ' !important;}' . "\n";
    $custom .= '.header .widget-area .widget_search .search-field { color: ' . mihael_hex2rgba($header_text_color, 0.9) . ' !important;}' . "\n";
    $custom .= '.page-header .site-brand::after { background-color:' . mihael_hex2rgba($header_text_color, 0.35) . ' !important;}' . "\n";
    $custom .= '.header .site-navigation .menu-primary .menu-item { border-color:' . mihael_hex2rgba($header_text_color, 0.16) . ' !important;}' . "\n";
  }

  // Post Heading Text Color
  $heading_text_color = get_theme_mod('post_heading_color', "#454545");
  if ( !empty($heading_text_color) && ($heading_text_color != '#454545') ) {
    $custom .= '.post-feed .post-heading, .single-post .post-heading, .page .post-heading { color:' . esc_attr($heading_text_color) . ' !important ;}' . "\n";
  }

  // Post Content Text Color
  $post_content_color = get_theme_mod('post_content_color', "#525252");
  if ( !empty($post_content_color) && ($post_content_color != '#525252') ) {
    $custom .= '.post-feed .post-summary, .single-post .post-content, .page .post-content { color:' . esc_attr($post_content_color) . ' !important;}' . "\n";
    $custom .= '.page-template-page-sans-serif .post-content { color:' . color_luminance($post_content_color, 0.09) . ' !important; }' . "\n";
  }


  wp_add_inline_style( 'mihael-keehl/css', $custom );
}

add_action( 'wp_enqueue_scripts', 'mihael_custom_styles' );
