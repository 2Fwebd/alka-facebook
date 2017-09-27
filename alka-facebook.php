<?php
/**
 * Plugin Name:       Alka Facebook
 * Description:       Login and Register your users using Facebook's API
 * Version:           1.0.0
 * Author:            Alkaweb
 * Author URI:        http://alka-web.com
 * Text Domain:       alkaweb
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/2Fwebd/alka-facebook
 */

/*
 * Import the Facebook SDK and load all the classes
 */
include (plugin_dir_path( __FILE__ ) . 'facebook-sdk/autoload.php');

/*
 * Import the plugin classes
 */
include (plugin_dir_path( __FILE__ ) . 'classes/AlkaFacebook.php');

