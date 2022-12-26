<?php

 /**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://domain.com
 * @since             1.0.0
 * @package           portl-event-search
 *
 *
 * @wordpress-plugin
 * Plugin Name:       Portl Event Search
 * Plugin URI:        http://domain.com
 * Description:       Use the shortcode <code>[event_search_page]</code> to create an event search on any page.
 * Version:           1.0.0
 * Author:            PORTL
 * Author URI:        http://domain.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       portl-event-search
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

include 'inc/shortcodes.php';
include 'inc/hooks.php';
include 'inc/api.php';
