<?php
class MB_Social_Sharing_Admin {
  
  public $settings;

	public function __construct() {

		$this->load_class('settings');
		$this->settings = new MB_Social_Sharing_Settings();

		add_action('admin_head-edit.php',array(&$this,'addCustomImportButton'),99);
	}

	function load_class($class_name = '') {
	  global $MB_Social_Sharing;
		if ('' != $class_name) {
			require_once ($MB_Social_Sharing->plugin_path . '/admin/class-' . esc_attr($MB_Social_Sharing->token) . '-' . esc_attr($class_name) . '.php');
		} // End If Statement
	}// End load_class()


	function addCustomImportButton()
	{
	    global $current_screen;
	    if ('post' != $current_screen->post_type) {
	        return;
	    }

	    ?>
	        <script type="text/javascript">
	            jQuery(document).ready( function($)
	            {
	                jQuery(jQuery(".wrap h1")[0]).append("<a  id='doc_popup' class='add-new-h2' style='cursor:pointer;'>Export</a>");
	            });
	        </script>
	    <?php
	}
	
}