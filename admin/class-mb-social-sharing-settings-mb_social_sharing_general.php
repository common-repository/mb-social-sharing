<?php
class MB_Social_Sharing_Settings_Gneral {
  /**
   * Holds the values to be used in the fields callbacks
   */
  private $options;
  
  private $tab;

  /**
   * Start up
   */
  public function __construct($tab) {
    $this->tab = $tab;
    $this->options = get_option( "mb_{$this->tab}_settings_name" );
    $this->settings_page_init();
  }
  
  /**
   * Register and add settings
   */
  public function settings_page_init() {
    global $MB_Social_Sharing;
    
    $settings_tab_options = 
            array("tab" => "{$this->tab}",
                  "ref" => &$this,
                  "sections" => array(
                    "default_settings_section" => 
                          array(
                                
                              "title" =>  __('Enable Your Social Share Button', $MB_Social_Sharing->text_domain), 
                              "fields" => array( 
                              "mb_enable_facebook" => array(
                                'title' => __('Facebook', $MB_Social_Sharing->text_domain) , 
                                'type' => 'checkbox', 
                                'id' => 'mb_enable_facebook', 
                                'label_for' => 'mb_enable_facebook', 
                                'name' => 'mb_enable_facebook', 
                                'value' => '1'
                                ), 
                              "mb_enable_twitter" => array(
                                  'title' => __('Twitter', $MB_Social_Sharing->text_domain) , 
                                  'type' => 'checkbox', 
                                  'id' => 'mb_enable_twitter', 
                                  'label_for' => 'mb_enable_twitter', 
                                  'name' => 'mb_enable_twitter', 
                                  'value' => '1'
                                  ), 
                              "mb_enable_google" => array(
                                  'title' => __('Google+', $MB_Social_Sharing->text_domain) , 
                                  'type' => 'checkbox', 
                                  'id' => 'mb_enable_google', 
                                  'label_for' => 'mb_enable_google', 
                                  'name' => 'mb_enable_google', 
                                  'value' => '1'
                                  ), 
                              "mb_enable_linkedin" => array(
                                  'title' => __('LinkedIn', $MB_Social_Sharing->text_domain) , 
                                  'type' => 'checkbox', 
                                  'id' => 'mb_enable_linkedin', 
                                  'label_for' => 'mb_enable_linkedin', 
                                  'name' => 'mb_enable_linkedin', 
                                  'value' => '1'
                                  ),
                              "mb_enable_pinterst" => array(
                                  'title' => __('Pinterst', $MB_Social_Sharing->text_domain) , 
                                  'type' => 'checkbox', 
                                  'id' => 'mb_enable_pinterst', 
                                  'label_for' => 'mb_enable_pinterst', 
                                  'name' => 'mb_enable_pinterst', 
                                  'value' => '1'
                                  ), 
                              "mb_enable_digg" => array(
                                  'title' => __('Digg', $MB_Social_Sharing->text_domain) , 
                                  'type' => 'checkbox', 
                                  'id' => 'mb_enable_digg', 
                                  'label_for' => 'mb_enable_digg', 
                                  'name' => 'mb_enable_digg', 
                                  'value' => '1'
                                  ),
                              "mb_enable_reddit" => array(
                                  'title' => __('Reddit', $MB_Social_Sharing->text_domain) , 
                                  'type' => 'checkbox', 
                                  'id' => 'mb_enable_reddit', 
                                  'label_for' => 'mb_enable_reddit', 
                                  'name' => 'mb_enable_reddit', 
                                  'value' => '1'
                                  )
                                )
                              )
                          )
                      );
    
    $MB_Social_Sharing->admin->settings->settings_field_init(apply_filters("settings_{$this->tab}_tab_options", $settings_tab_options));
  }

  /**
   * Sanitize each setting field as needed
   *
   * @param array $input Contains all settings fields as array keys
   */
  public function mb_mb_social_sharing_general_settings_sanitize( $input ) {
    global $MB_Social_Sharing;
    $new_input = array();
    
    $hasError = false;

    if( isset( $input['mb_enable_facebook'] ) )
      $new_input['mb_enable_facebook'] = sanitize_text_field( $input['mb_enable_facebook'] );
    
    if( isset( $input['mb_enable_twitter'] ) )
      $new_input['mb_enable_twitter'] = sanitize_text_field( $input['mb_enable_twitter'] );
    
    if( isset( $input['mb_enable_google'] ) )
      $new_input['mb_enable_google'] = sanitize_text_field( $input['mb_enable_google'] );
    
    if( isset( $input['mb_enable_linkedin'] ) )
      $new_input['mb_enable_linkedin'] = sanitize_text_field( $input['mb_enable_linkedin'] );
    
    if( isset( $input['mb_enable_pinterst'] ) )
      $new_input['mb_enable_pinterst'] = sanitize_text_field( $input['mb_enable_pinterst'] );
    
    if( isset( $input['mb_enable_digg'] ) )
      $new_input['mb_enable_digg'] = sanitize_text_field( $input['mb_enable_digg'] );

    if( isset( $input['mb_enable_reddit'] ) )
      $new_input['mb_enable_reddit'] = sanitize_text_field( $input['mb_enable_reddit'] );
    
    if(!$hasError) {
      add_settings_error(
        "mb_{$this->tab}_settings_name",
        esc_attr( "mb_{$this->tab}_settings_admin_updated" ),
        __('General settings updated', $MB_Social_Sharing->text_domain),
        'updated'
      );
    }

    return $new_input;
  }

  /** 
   * Print the Section text
   */
  public function default_settings_section_info() {
    global $MB_Social_Sharing;
    _e('Enter your default settings below', $MB_Social_Sharing->text_domain);
  }
  
  
}