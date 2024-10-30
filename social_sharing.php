<?php
/*
Plugin Name: MB Social Sharing
Description: It is a simple social sharing  plugin
Author: Moumita Banerjee
Version: 1.0.0
Author URI: https://www.facebook.com/moumita.banerjee.56808
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! class_exists( 'WC_Dependencies' ) )
	require_once 'includes/class-mb-dependencies.php';
require_once 'includes/mb-social-sharing-core-functions.php';
require_once 'config.php';
if(!defined('ABSPATH')) exit; // Exit if accessed directly
if(!defined('MB_SOCIAL_SHARING_PLUGIN_TOKEN')) exit;
if(!defined('MB_SOCIAL_SHARING_TEXT_DOMAIN')) exit;


// Activation Hooks
register_activation_hook( __FILE__, 'activate_mb_social_share_plugin');
register_activation_hook( __FILE__, 'flush_rewrite_rules' );


if(!class_exists('MB_Social_Sharing')) {
	require_once( 'classes/class-mb-social-sharing.php' );
	global $MB_Social_Sharing;
	$MB_Social_Sharing = new MB_Social_Sharing( __FILE__ );
	$GLOBALS['MB_Social_Sharing'] = $MB_Social_Sharing;
}
?>
