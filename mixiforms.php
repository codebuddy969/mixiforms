<?php
/**
 * @package Mixiforms
 * @version 1.0.0
 */
/*
Plugin Name: mixiforms
Plugin URI: https://askcoder.tech/contact
Description: Easily embed simple forms in your posts, using the Mixiforms plugin.
Author: Vlad Secrier
Version: 1.0.0
Author URI: https://askcoder.tech/about
*/

// Do not allow direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Constants registration.

! defined( 'MF_VERSION' ) ? define( 'MF_VERSION', '1.0.0' ) : false;
! defined( 'MF_PLUGIN_FILE' ) ? define( 'MF_PLUGIN_FILE', __FILE__ ) : false;
! defined( 'MF_PLUGIN_DIR' ) ? define( 'MF_PLUGIN_DIR', plugin_dir_path( __FILE__ ) ) : false;
! defined( 'MF_PLUGIN_URL' ) ? define( 'MF_PLUGIN_URL', plugin_dir_url( __FILE__ ) ) : false;

// Initialize plugin.

require_once  MF_PLUGIN_DIR . 'mf_initialize.php';

