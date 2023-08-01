<?php
/**
 * Plugin Name:       xDr Webhook Plugin
 * Plugin URI:        https://github.com/xd12r
 * Description:       This plugin sends a webhook when a post is published.
 * Version:           1.2.1
 * Author:            xDr
 * Author URI:        https://github.com/xd12r
 * License:           GPLv3
 * Domain Path:       /languages
 */
 
 // If this file is called directly, abort
 
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once(dirname( __FILE__ ).'/functions.php');
