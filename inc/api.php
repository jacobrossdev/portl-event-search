<?php

// Same handler function...
add_action( 'wp_ajax_nopriv_portl_retrieve_events', 'portl_retrieve_events' );
add_action( 'wp_ajax_portl_retrieve_events', 'portl_retrieve_events' );
function portl_retrieve_events() {
  global $wpdb;
 
  $location = portl_get_geocode_from_googlapi( $_POST['address'] );

  $options = get_option( 'portl_events_search' );

  $events = portl_get_events_from_remote_server( array(
    "location" => array(
      'lat' => $location->lat,
      'lng' => $location->lng
    ),
    'startingAfter' => strtotime($_POST['starting']) ? strtotime($_POST['starting']) : time(),
    'maxDistanceMiles' => intval($_POST['distance']),
    'page' => intval($_POST['page']),
    'pageSize'=> 25
  ) );

  $events = $events->items;

  $keys = array_column($events, 'distance');
  array_multisort($keys, SORT_ASC, $events);

  $categories = array();
  foreach($events as $e){ 
  foreach($e->event->categories as $cat){
    $categories[] = $cat;
  }}

  $categories = array_unique($categories);

  if( empty($events) ){
    echo 'false';
    wp_die();
  }

  ob_start();
  include dirname(__DIR__).'/partial/search-results.php';
  $html = ob_get_clean();
  echo $html; 
  wp_die();
}

// Same handler function...
add_action( 'wp_ajax_nopriv_portl_retrieve_page', 'portl_retrieve_page' );
add_action( 'wp_ajax_portl_retrieve_page', 'portl_retrieve_page' );
function portl_retrieve_page() {
  global $wpdb;
 
  $location = portl_get_geocode_from_googlapi( $_POST['address'] );

  $options = get_option( 'portl_events_search' );

  $events = portl_get_events_from_remote_server( array(
    "location" => array(
      'lat' => $location->lat,
      'lng' => $location->lng
    ),
    'startingAfter' => strtotime($_POST['starting']) ? strtotime($_POST['starting']) : time(),
    'maxDistanceMiles' => intval($_POST['distance']),
    'page' => invtal($_POST['page']),
    'pageSize'=> 50
  ) );

  $events = $events->items;

  $keys = array_column($events, 'distance');
  array_multisort($keys, SORT_ASC, $events);

  $categories = array();
  foreach($events as $e){ 
  foreach($e->event->categories as $cat){
    $categories[] = $cat;
  }}

  $categories = array_unique($categories);

  if( empty($events) ){
    echo 'false';
    wp_die();
  }

  ob_start();
  include dirname(__DIR__).'/partial/results-page.php';
  $html = ob_get_clean();
  echo $html; 
  wp_die();
}

function portl_get_events_from_remote_server($request_data){

  $options = get_option( 'portl_events_search' );

  $packet = array(

      "headers" => [

          "Content-Type" => "application/json",

          "Authorization" => "Basic " . $options['portl_event_search_token'],

      ],

      'method' => 'POST',

      'body' => wp_json_encode($request_data)

  );


  $api_response = wp_remote_request( 'https://api.portl.com/events/search',
  
      $packet
  
  );

  //error_log(print_r($api_response,1) . "\r\n", 3, __DIR__ . '/api_response.log');


  $response_body = wp_remote_retrieve_body($api_response);

  $response_body = json_decode($response_body);

  return $response_body;
}

function portl_get_geocode_from_googlapi($address){

  $options = get_option( 'portl_events_search' );

  $google_key = $options['portl_event_google_token'];

  $api_response = wp_remote_get('https://maps.google.com/maps/api/geocode/json?address='.$address.'&key='.$google_key,[
    'body' => wp_json_encode([
      'address' => $address
    ])
  ]);

  $response_body = wp_remote_retrieve_body($api_response);

  $response_body = json_decode($response_body);

  return $response_body->results[0]->geometry->location;
}