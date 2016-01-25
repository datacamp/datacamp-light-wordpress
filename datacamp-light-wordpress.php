<?php
/**
 * @package DataCampLight
 * @version 1.0
 */
/*
Plugin Name: DataCamp Light
Description: This plugin allows easy embedding of programming exercises using the DataCamp Light interactive coding interface.
Author: DataCamp
Version: 1.0
Author URI: https://www.datacamp.com/
*/

if (!defined('ABSPATH')) exit;

class DataCampLight {
	public static function loadJS(){
		wp_enqueue_script("datacamp-light-library", "https://cdn.datacamp.com/datacamp-light-latest.min.js");
	}
}

// wp_enqueue_scripts action hook to link only on the front-end
add_action("wp_enqueue_scripts", array(DataCampLight, "loadJS"));

?>
