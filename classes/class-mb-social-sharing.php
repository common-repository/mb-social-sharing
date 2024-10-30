<?php
class MB_Social_Sharing {

	public $plugin_url;

	public $plugin_path;

	public $version;

	public $token;
	
	public $text_domain;
	
	public $library;

	public $shortcode;

	public $admin;

	public $frontend;

	private $file;
	
	public $settings;
	
	public $mb_wp_fields;

	public function __construct($file) {

		$this->file = $file;
		$this->plugin_url = trailingslashit(plugins_url('', $plugin = $file));
		$this->plugin_path = trailingslashit(dirname($file));
		$this->token = MB_SOCIAL_SHARING_PLUGIN_TOKEN;
		$this->text_domain = MB_SOCIAL_SHARING_TEXT_DOMAIN;
		$this->version = MB_SOCIAL_SHARING_PLUGIN_VERSION;
		
		add_action('init', array(&$this, 'init'), 0);
	}
	
	/**
	 * initilize plugin on WP init
	 */
	function init() {
		
		// Init Text Domain
		$this->text_domain;
		
		// Init library
		$this->load_class('library');
		$this->library = new MB_Social_Sharing_Library();

		if (is_admin()) {
			$this->load_class('admin');
			$this->admin = new MB_Social_Sharing_Admin();
		}

		if (!is_admin()) {
			$this->load_class('frontend');
			$this->frontend = new MB_Social_Sharing_Frontend();
			
			// init shortcode
      		$this->load_class('shortcode');
      		$this->shortcode = new MB_Social_Sharing_Shortcode();
		}

		// MB Wp Fields
		$this->mb_wp_fields = $this->library->load_wp_fields();
	}
	

	public function load_class($class_name = '') {
		if ('' != $class_name && '' != $this->token) {
			require_once ('class-' . esc_attr($this->token) . '-' . esc_attr($class_name) . '.php');
		} // End If Statement
	}// End load_class()
	
	/** Cache Helpers *********************************************************/

	/**
	 * Sets a constant preventing some caching plugins from caching a page. Used on dynamic pages
	 *
	 * @access public
	 * @return void
	 */
	function nocache() {
		if (!defined('DONOTCACHEPAGE'))
			define("DONOTCACHEPAGE", "true");
		// WP Super Cache constant
	}

}
