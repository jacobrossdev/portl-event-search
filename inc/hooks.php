<?php

add_action( 'wp_enqueue_scripts', 'portl_event_search_asset_enqueue' );
function portl_event_search_asset_enqueue($hook) {
    
   wp_enqueue_style( 'dashicons' );
  wp_register_script( 'portl-events-ajax-script', plugins_url( '/assets/script.js', __DIR__ ), array('jquery') );
  wp_localize_script( 'portl-events-ajax-script', 'portl', 
    array( 
      'ajax_url' => admin_url( 'admin-ajax.php' ), 
      'we_value' => 1234 
    )
  );
  wp_enqueue_script('portl-events-ajax-script');

  wp_enqueue_style('portl-events-ajax-script', plugins_url('/assets/style.css', __DIR__), [], false, 'all' );


    wp_enqueue_style( 'jquery-ui',
      'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css',
      array(),
      '1.00' );
  wp_enqueue_script( 'timepicker-js', plugins_url( '/assets/timepicker.js', __DIR__ ), array('jquery','jquery-ui-datepicker') );
  wp_enqueue_style( 'timepicker-css', plugins_url('/assets/timepicker.css', __DIR__), [], false, 'all' );
}

/**
 * Hook it into Wordpress
 */
add_action('admin_menu', 'portl_event_search_admin_pages'); 

/**
 * Place all the add_menu_page functions in here
 */
function portl_event_search_admin_pages(){
  $admin_page_name = 'Portl Event Search';
  add_menu_page( $admin_page_name, $admin_page_name, 'manage_options', 'portl-event-search-options', 'portl_event_search_admin_pages_callback' );
}

/**
 * Admin page function
 */
function portl_event_search_admin_pages_callback(){

  $message = NULL;

  $options = array();

  if ( !current_user_can( 'manage_options' ) )  {
  
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );  
  }

  if( isset( $_POST['Publish'] ) ){
    
    update_option( 'portl_events_search', $_POST );
  }
  
  $options = get_option( 'portl_events_search' );

  ob_start(); include dirname(__DIR__) . '/partial/admin.php'; $template = ob_get_clean();

  echo $template;
}