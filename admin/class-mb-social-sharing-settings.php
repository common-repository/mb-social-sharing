<?php
class MB_Social_Sharing_Settings {
  
  private $tabs = array();
  
  private $options;
  
  /**
   * Start up
   */
  public function __construct() {
    // Admin menu
    add_action( 'admin_menu', array( $this, 'add_settings_page' ), 100 );
    add_action( 'admin_init', array( $this, 'settings_page_init' ) );
    
    // Settings tabs
    add_action('settings_page_mb_social_sharing_general_tab_init', array(&$this, 'general_tab_init'), 10, 1);
  }
  
  /**
   * Add options page
   */
  public function add_settings_page() {
    global $MB_Social_Sharing;
    
    add_menu_page(
        __('Social Sharing Settings', $MB_Social_Sharing->text_domain), 
        __('Social Sharing Settings', $MB_Social_Sharing->text_domain), 
        'manage_options', 
        'mb-social-sharing-setting-admin', 
        array( $this, 'create_mb_social_sharing_settings' )
    );
    
    $this->tabs = $this->get_mb_settings_tabs();
  }
  
  function get_mb_settings_tabs() {
    global $MB_Social_Sharing;
    $tabs = apply_filters('mb_social_sharing_tabs', array(
      'mb_social_sharing_general' => __('Social Sharing General', $MB_Social_Sharing->text_domain)
    ));
    return $tabs;
  }
  
  function mb_settings_tabs( $current = 'mb_social_sharing_general' ) {
    if ( isset ( $_GET['tab'] ) ) :
      $current = $_GET['tab'];
    else:
      $current = 'mb_social_sharing_general';
    endif;
    
    $links = array();
    foreach( $this->tabs as $tab => $name ) :
      if ( $tab == $current ) :
        $links[] = "<a class='nav-tab nav-tab-active' href='?page=mb-social-sharing-setting-admin&tab=$tab'>$name</a>";
      else :
        $links[] = "<a class='nav-tab' href='?page=mb-social-sharing-setting-admin&tab=$tab'>$name</a>";
      endif;
    endforeach;
    echo '<div class="icon32" id="mb_menu_ico"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ( $links as $link )
      echo $link;
    echo '</h2>';
    
    foreach( $this->tabs as $tab => $name ) :
      if ( $tab == $current ) :
        echo "<h2>$name Settings</h2>";
      endif;
    endforeach;
  }

  /**
   * Options page callback
   */
  public function create_mb_social_sharing_settings() {
    global $MB_Social_Sharing;
    ?>
    <div class="wrap">
      <?php $this->mb_settings_tabs(); ?>
      <?php
      $tab = ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'mb_social_sharing_general' );
      $this->options = get_option( "mb_{$tab}_settings_name" );
      //print_r($this->options);
      
      // This prints out all hidden setting errors
      settings_errors("mb_{$tab}_settings_name");
      ?>
      <form method="post" action="options.php">
      <?php
        // This prints out all hidden setting fields
        settings_fields( "mb_{$tab}_settings_group" );   
        do_settings_sections( "mb-{$tab}-settings-admin" );
        submit_button(); 
      ?>
      </form>
    </div>
    <?php
    
  }

  /**
   * Register and add settings
   */
  public function settings_page_init() { 
    do_action('befor_settings_page_init');
    
    // Register each tab settings
    foreach( $this->tabs as $tab => $name ) :
      do_action("settings_page_{$tab}_tab_init", $tab);
    endforeach;
    
    do_action('after_settings_page_init');
  }
  
  /**
   * Register and add settings fields
   */
  public function settings_field_init($tab_options) {
    global $MB_Social_Sharing;
    
    if(!empty($tab_options) && isset($tab_options['tab']) && isset($tab_options['ref']) && isset($tab_options['sections'])) {
      // Register tab options
      register_setting(
        "mb_{$tab_options['tab']}_settings_group", // Option group
        "mb_{$tab_options['tab']}_settings_name", // Option name
        array( $tab_options['ref'], "mb_{$tab_options['tab']}_settings_sanitize" ) // Sanitize
      );
      
      foreach($tab_options['sections'] as $sectionID => $section) {
        // Register section
        add_settings_section(
          $sectionID, // ID
          $section['title'], // Title
          array( $tab_options['ref'], "{$sectionID}_info" ), // Callback
          "mb-{$tab_options['tab']}-settings-admin" // Page
        );
        
        // Register fields
        if(isset($section['fields'])) {
          foreach($section['fields'] as $fieldID => $field) {
            if(isset($field['type'])) {
              $field = $MB_Social_Sharing->mb_wp_fields->check_field_id_name($fieldID, $field);
              $field['tab'] = $tab_options['tab'];
              $callbak = $this->get_field_callback_type($field['type']);
              if(!empty($callbak)) {
                add_settings_field(
                  $fieldID,
                  $field['title'],
                  array( $this, $callbak ),
                  "mb-{$tab_options['tab']}-settings-admin",
                  $sectionID,
                  $field
                );
              }
            }
          }
        }
      }
    }
  }
  
  function general_tab_init($tab) {
    global $MB_Social_Sharing;
    $MB_Social_Sharing->admin->load_class("settings-{$tab}", $MB_Social_Sharing->plugin_path, $MB_Social_Sharing->token);
    new MB_Social_Sharing_Settings_Gneral($tab);
  }
  
  function get_field_callback_type($fieldType) {
    $callBack = '';
    switch($fieldType) {
      case 'input':
      case 'text':

        
      case 'checkbox':
        $callBack = 'checkbox_field_callback';
        break;
        

      default:
        $callBack = '';
        break;
    }
    
    return $callBack;
  }
  

  
  /** 
   * Get the checkbox field display
   */
  public function checkbox_field_callback($field) {
    global $MB_Social_Sharing;
    $field['value'] = isset( $field['value'] ) ? esc_attr( $field['value'] ) : '';
    $field['value'] = isset( $this->options[$field['name']] ) ? esc_attr( $this->options[$field['name']] ) : $field['value'];
    $field['dfvalue'] = isset( $this->options[$field['name']] ) ? esc_attr( $this->options[$field['name']] ) : '';
    $field['name'] = "mb_{$field['tab']}_settings_name[{$field['name']}]";
    $MB_Social_Sharing->mb_wp_fields->checkbox_input($field);
  }
  

  
}