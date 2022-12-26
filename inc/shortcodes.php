<?php

function portl_event_search_page_func( $atts = array(), $content = '' ) {

  $atts = shortcode_atts( array(
    'id' => 'value',
  ), $atts, 'event_search_page' );

  ob_start();
  include dirname(__DIR__).'/partial/search-page.php';
  $string = ob_get_clean();

  return $string;
}

add_shortcode( 'event_search_page', 'portl_event_search_page_func' );