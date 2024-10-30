<?php
class MB_Social_Sharing_Shortcode {

	public $list_product;

	public function __construct() {
		//shortcodes
		
		add_shortcode('mb_social_share', array(&$this, 'mb_social_share'));
	}


	public function mb_social_share($attr) {
		global $MB_Social_Sharing;
		extract( shortcode_atts( array('link' => '', 'label' => '','content' => ''), $attr ) );
		$this->load_class('share');
		return $this->shortcode_wrapper(array('MB_Social_Share', 'output'),$attr);
	}

	/**
	 * Helper Functions
	 */

	/**
	 * Shortcode Wrapper
	 *
	 * @access public
	 * @param mixed $function
	 * @param array $atts (default: array())
	 * @return string
	 */
	public function shortcode_wrapper($function, $atts = array()) {
		ob_start();
		call_user_func($function, $atts);
		return ob_get_clean();
	}

	/**
	 * Shortcode CLass Loader
	 *
	 * @access public
	 * @param mixed $class_name
	 * @return void
	 */
	public function load_class($class_name = '') {
		global $MB_Social_Sharing;
		if ('' != $class_name && '' != $MB_Social_Sharing->token) {
			require_once ('shortcode/class-' . esc_attr($MB_Social_Sharing->token) . '-shortcode-' . esc_attr($class_name) . '.php');
		}
	}

}
?>
