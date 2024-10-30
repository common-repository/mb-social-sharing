<?php
class MB_Social_Sharing_Library {
  
  public $lib_path;
  
  public $lib_url;
  
  public $php_lib_path;
  
  public $php_lib_url;
  

	public function __construct() {
	  global $MB_Social_Sharing;
	  
	  	$this->lib_path = $MB_Social_Sharing->plugin_path . 'lib/';

    	$this->lib_url = $MB_Social_Sharing->plugin_url . 'lib/';
    
    	$this->php_lib_path = $this->lib_path . 'php/';
    
    	$this->php_lib_url = $this->lib_url . 'php/';
	}
	
	/**
	 * PHP WP fields Library
	 */
	public function load_wp_fields() {
	  global $MB_Social_Sharing;
	  if ( ! class_exists( 'MB_WP_Fields' ) )
	    require_once ($this->php_lib_path . 'class-mb-wp-fields.php');
	  $MB_WP_Fields = new MB_WP_Fields(); 
	  return $MB_WP_Fields;
	}
	
	
}
