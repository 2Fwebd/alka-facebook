<?php
/**
 * Plugin Name:       Alka Facebook
 * Description:       Login and Register your users using Facebook's API
 * Version:           2.0.0
 * Author:            Alkaweb
 * Author URI:        http://alka-web.com
 * Text Domain:       alkaweb
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/2Fwebd/alka-facebook
 */


/*
 * Plugin constants
 */
if(!defined('ALKA_FACEBOOK_URL'))
	define('ALKA_FACEBOOK_URL', plugin_dir_url( __FILE__ ));
if(!defined('ALKA_FACEBOOK_PATH'))
	define('ALKA_FACEBOOK_PATH', plugin_dir_path( __FILE__ ));

/*
 * Import the Facebook SDK and load all the classes
 */
include (ALKA_FACEBOOK_PATH . 'facebook-sdk/autoload.php');

/*
 * Import the plugin classes
 */
include (ALKA_FACEBOOK_PATH . 'classes/AlkaFacebook.php');
include (ALKA_FACEBOOK_PATH . 'classes/AlkaAdmin.php');
