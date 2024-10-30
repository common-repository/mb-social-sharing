<?php
if( ! function_exists( 'activate_mb_social_share_plugin' ) ) {
	/**
	 * On activation, include the installer and run it.
	 *
	 * @access public
	 * @return void
	 */
	function activate_mb_social_share_plugin() {
		require_once( 'class-mb-social-share-install.php' );
		new MB_Social_Share_Install();
		update_option( 'mb_social_share_plugin_installed', 1 );
	}
}

if(!function_exists('get_social_sharing_settings')) {
  function get_social_sharing_settings($name = '', $tab = '') {
    if(empty($tab) && empty($name)) return '';
    if(empty($tab)) return get_option($name);
    if(empty($name)) return get_option("mb_{$tab}_settings_name");
    $settings = get_option("mb_{$tab}_settings_name");
    if(!isset($settings[$name])) return '';
    return $settings[$name];
  }
}
?>
