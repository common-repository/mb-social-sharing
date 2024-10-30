<?php
class MB_Social_Sharing_Frontend {

	public function __construct() {
		//enqueue scripts
		add_action('wp_enqueue_scripts', array(&$this, 'frontend_scripts'));
		//enqueue styles
		add_action('wp_enqueue_scripts', array(&$this, 'frontend_styles'));


	}


	function frontend_scripts() {
		global $MB_Social_Sharing;
		$frontend_script_path = $MB_Social_Sharing->plugin_url . 'assets/frontend/js/';
		$frontend_script_path = str_replace( array( 'http:', 'https:' ), '', $frontend_script_path );
		$pluginURL = str_replace( array( 'http:', 'https:' ), '', $MB_Social_Sharing->plugin_url );
		$suffix 				= defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		
		// Enqueue your frontend javascript from here
	}

	function frontend_styles() {
		global $MB_Social_Sharing;
		$frontend_style_path = $MB_Social_Sharing->plugin_url . 'assets/frontend/css/';
		$frontend_style_path = str_replace( array( 'http:', 'https:' ), '', $frontend_style_path );
		$suffix 				= defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Enqueue your frontend stylesheet from here
		wp_register_style('MB_Social_Share_frontend_css', $frontend_style_path. 'frontend.css', $MB_Social_Sharing->version);
		wp_enqueue_style( 'MB_Social_Share_frontend_css' );
	}
	

}
