<?php
if ( ! defined( 'ABSPATH' )) {
   exit; // Exit if accessed directly.
}

//use zitaelementor\widgets\heading/heading_widget;
 class Zita_Site_Llibrary_Core_Addon {

  public function __construct() {
    $this->init();
  }

  public function init() {
    
      // Register Widget Styles
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_style' ] );

    // Register Widget Scripts
    add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

 }

  public function widget_style() {

    // wp_register_style( 'zita-animate', plugins_url( 'css/animate.css', __FILE__ ) );
    wp_register_style( 'widget-price-box', plugins_url( 'assets/css/price-box.css', __FILE__ ) );
    wp_register_style( 'widget-content-switcher', plugins_url( 'assets/css/content-switcher.css', __FILE__ ) );

     // wp_enqueue_style( 'zita-animate' );
    wp_enqueue_style( 'widget-price-box' );
    wp_enqueue_style( 'widget-content-switcher' );

    
  }

  public function widget_scripts() {

    wp_register_script( 'elael-image-effect', plugins_url( 'assets/js/script.js', __FILE__ ),array('jquery'),'',true );

  //  wp_register_script( $handle, $src, $deps, $ver, $in_footer )
    wp_enqueue_script('elael-image-effect');
  }

}

NEW Zita_Site_Llibrary_Core_Addon();




