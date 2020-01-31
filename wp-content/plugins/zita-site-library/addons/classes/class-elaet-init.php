<?php
if ( ! defined( 'ABSPATH' )) {
   exit; // Exit if accessed directly.
}

/**
 * Main Zita Elementor Addon Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Zita_Site_Llibrary_Addon_Init {

   /**
    * Plugin Version
    *
    * @since 1.0.0
    *
    * @var string The plugin version.
    */
   const VERSION = '1.0.0';

   /**
    * Minimum Elementor Version
    *
    * @since 1.0.0
    *
    * @var string Minimum Elementor version required to run the plugin.
    */
   const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

   /**
    * Minimum PHP Version
    *
    * @since 1.0.0
    *
    * @var string Minimum PHP version required to run the plugin.
    */
   const MINIMUM_PHP_VERSION = '5.4';

   /**
    * Instance
    *
    * @since 1.0.0
    *
    * @access private
    * @static
    *
    * @var Zita_Site_Llibrary_Addon_Init The single instance of the class.
    */
   private static $_instance = null;

   /**
    * Instance
    *
    * Ensures only one instance of the class is loaded or can be loaded.
    *
    * @since 1.0.0
    *
    * @access public
    * @static
    *
    * @return Zita_Site_Llibrary_Addon_Init An instance of the class.
    */
   public static function instance() {

      if ( is_null( self::$_instance ) ) {
         self::$_instance = new self();
      }
      return self::$_instance;

   }

   /**
    * Constructor
    *
    * @since 1.0.0
    *
    * @access public
    */
   public function __construct() {

      add_action( 'init', [ $this, 'i18n' ] );
      add_action( 'plugins_loaded', [ $this, 'init' ] );

   }

   /**
    * Load Textdomain
    *
    * Load plugin localization files.
    *
    * Fired by `init` action hook.
    *
    * @since 1.0.0
    *
    * @access public
    */
   public function i18n() {

      load_plugin_textdomain( 'elaet' );

   }

   /**
    * Initialize the plugin
    *
    * Load the plugin only after Elementor (and other plugins) are loaded.
    * Checks for basic plugin requirements, if one check fail don't continue,
    * if all check have passed load the files required to run the plugin.
    *
    * Fired by `plugins_loaded` action hook.
    *
    * @since 1.0.0
    *
    * @access public
    */
   public function init() {

      // Check for required PHP version
      if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
         add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
         return;
      }

  
    // Register Widget Styles
    add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_style' ] );

    // Register Widget Scripts
    add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

   }


   /**
    * Admin notice
    *
    * Warning when the site doesn't have a minimum required PHP version.
    *
    * @since 1.0.0
    *
    * @access public
    */
   public function admin_notice_minimum_php_version() {

      if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

      $message = sprintf(
         /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
         esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elaet' ),
         '<strong>' . esc_html__( 'Zita Addon Elementor', 'elaet' ) . '</strong>',
         '<strong>' . esc_html__( 'PHP', 'elaet' ) . '</strong>',
          self::MINIMUM_PHP_VERSION
      );

      printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

   }

   public function widget_style() {

   
wp_register_style( 'elaet-frontend-min-style', ELAET_UN_PLUGIN_URL.'/assets/css/elaet.frontend.min.css');
wp_register_style( 'elite-addons-style', ELAET_UN_PLUGIN_URL. '/assets/css/elite-addons-style.css' );
wp_register_style( 'twentytwenty-css', ELAET_UN_PLUGIN_URL. '/assets/css/twentytwenty.css' );


    wp_enqueue_style( 'elaet-frontend-min-style' ); 
    wp_enqueue_style( 'elite-addons-style' ); 
    wp_enqueue_style( 'twentytwenty-css' );

    
  }

  public function widget_scripts() {

    wp_register_script( 'elaet-content-switcher-js', ELAET_UN_PLUGIN_URL. 'assets/js/content-switcher.js',array('jquery'),'',true );
    wp_register_script( 'elaet-image-effect-js', ELAET_UN_PLUGIN_URL. 'assets/js/image-effect.js',array('jquery'),'',true );
    wp_register_script( 'elaet-post-pro-js', ELAET_UN_PLUGIN_URL. 'assets/js/post-pro.js',array('jquery'),'',true );
     wp_register_script( 'elaet-countdown-timer-js', ELAET_UN_PLUGIN_URL. 'assets/js/countdown-timer.js',array('jquery'),'',true );
    wp_register_script( 'elaet-countdown-min-js', ELAET_UN_PLUGIN_URL. 'assets/js/countdown.min.js',array('jquery'),'',true );
    wp_register_script( 'elaet-compare-images-js', ELAET_UN_PLUGIN_URL. 'assets/js/compare-images.js',array('jquery'),'',true );
    wp_register_script( 'jquery-event-move', ELAET_UN_PLUGIN_URL. 'assets/js/jquery.event.move.js',array('jquery'),'',true );
    wp_register_script( 'jquery-twentytwenty-js', ELAET_UN_PLUGIN_URL. 'assets/js/jquery.twentytwenty.js',array('jquery'),'',true );
    wp_register_script( 'elaet-advanced-tabs-js', ELAET_UN_PLUGIN_URL. 'assets/js/advanced-tabs.js',array('jquery'),'',true );
    wp_register_script( 'elaet-counter-js', ELAET_UN_PLUGIN_URL. 'assets/js/counter.js',array('jquery'),'',true );


      if(get_option( 'zita_license_key')):
       wp_enqueue_script('elaet-content-switcher-js');
       wp_enqueue_script('elaet-image-effect-js');
       wp_enqueue_script('elaet-post-pro-js');
       wp_enqueue_script('elaet-countdown-timer-js');
       wp_enqueue_script('elaet-countdown-min-js');
       wp_enqueue_script('elaet-compare-images-js');
       wp_enqueue_script('jquery-event-move');
       wp_enqueue_script('jquery-twentytwenty-js');
       wp_enqueue_script('elaet-advanced-tabs-js');
       wp_enqueue_script('elaet-counter-js');
     endif;

   }

}

Zita_Site_Llibrary_Addon_Init::instance();

/*****  Creating a New Category*********
*******************************************/
function Zita_Site_Llibrary_elementor_widget_categories( $elements_manager ) {

  $elements_manager->add_category(
    'elaet-category',
    [
      'title' => __( 'Zita Premium Addons', 'elaet' ),
      'icon' => 'eicon-pro-icon',
    ]
  );
}
add_action( 'elementor/elements/categories_registered', 'Zita_Site_Llibrary_elementor_widget_categories' );

function Zita_Site_Llibrary_add_new_elements(){
  if(get_option( 'zita_license_key')):
  require_once ELAET_EXT_DIR.'modules/price-box/price-box.php';
  require_once ELAET_EXT_DIR.'modules/advance-heading/advance-heading.php'; 
  require_once ELAET_EXT_DIR.'modules/image-effect/image-effect.php';
  require_once ELAET_EXT_DIR.'modules/content-switcher/content-switcher.php';
  require_once ELAET_EXT_DIR.'modules/post-pro/post-pro.php'; 
  require_once ELAET_EXT_DIR.'modules/image-pointer/image-pointer.php';
  require_once ELAET_EXT_DIR.'modules/instagram-feed/instagram-feed.php';
  require_once ELAET_EXT_DIR.'modules/icon-list/icon-list.php';
  require_once ELAET_EXT_DIR.'modules/count-down/count-down.php';
  require_once ELAET_EXT_DIR.'modules/cf-seven/cf-seven.php'; 
  require_once ELAET_EXT_DIR.'modules/compare-images/compare-images.php';
  require_once ELAET_EXT_DIR.'modules/advanced-tabs/advanced-tabs.php';
  require_once ELAET_EXT_DIR.'modules/counter/counter.php';
  else:
      require_once ELAET_EXT_DIR.'modules/zita-pro/zita-pro.php';
endif;
}

add_action('elementor/widgets/widgets_registered','Zita_Site_Llibrary_add_new_elements');
