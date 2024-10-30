<?php
/**
 * MB Social Share plugin Install
 *
 * Plugin install default pages to WordPress. Runs on activation and upgrade.
 *
 * @author 		Moumita Banerjee
 * @package 	mb-social-sharing/Admin/Install
 * @version    1.0.0
 */

class MB_Social_Share_Install {

	public function __construct() {
  		global $MB_Social_Sharing;
  		$this->mb_social_share_plugin_default_settings();

  	}

	/**
   * save default MB Social Share settings
   *
   * @access public
   * @return void
   */
  function mb_social_share_plugin_default_settings() {
    $general_settings = get_option('mb_mb_social_sharing_general_settings_name');
    if(empty($general_settings)) {
      $general_settings = array (
        'mb_enable_facebook' => '1',
        'mb_enable_twitter' => '1',
        'mb_enable_google' => '1',
        'mb_enable_linkedin' => '1',
        'mb_enable_pinterst' => '1',
      );
      update_option('mb_mb_social_sharing_general_settings_name', $general_settings);
    }
  }
}