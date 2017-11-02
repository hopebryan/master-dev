<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

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
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Stripping HTML Tags from the Comments
 */
function cb_remove_html($comment) {
   return wp_strip_all_tags($comment);
}
add_filter('get_comment_text', __NAMESPACE__ . '\\cb_remove_html');
remove_filter('comment_text', 'make_clickable', 9);


function wpdocs_special_nav_class( $args, $item, $depth ) {
/*if ( is_single() || is_home() || is_blog() || is_archive() || is_search() || is_404() ) {
$item->url = get_site_url() . '/' . $item->url;
}*/
if ( !is_front_page() ) {
if(strtolower($item->title) !='blog' && strtolower($item->title) !='home' ) {
$item->url = get_site_url() . '/' . $item->url;
}
} 
}
add_filter( 'nav_menu_item_args' , __NAMESPACE__ . '\\wpdocs_special_nav_class' , 10, 3 ); 