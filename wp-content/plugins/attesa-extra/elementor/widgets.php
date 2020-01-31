<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Attesa_Extra_Elementor_Extensions {
	private static $_instance = null;
	
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}
	
	/**
	 * Widget constructor.
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_elementor_widgets' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_elementor_widget_categories' ) );
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'widget_scripts' ) );
		add_action( 'elementor/preview/enqueue_scripts', array( $this, 'widget_scripts_preview' ) );
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_style' ) );
	}
	
	/**
	 * Registers widgets in Elementor
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_elementor_widgets() {
		require_once AE_PATH . '/elementor/widgets/navigation-menu.php';
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Attesa_Extra_Navigation_Menu() );
		
		require_once AE_PATH . '/elementor/widgets/site-logo.php';
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Attesa_Extra_Site_Logo() );
		
		require_once AE_PATH . '/elementor/widgets/site-social-buttons.php';
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Attesa_Extra_Site_Social_Buttons() );
		
		require_once AE_PATH . '/elementor/widgets/posts-carousel.php';
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Attesa_Extra_Posts_Carousel() );
		
		require_once AE_PATH . '/elementor/widgets/divider.php';
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Attesa_Extra_Divider() );
		
		require_once AE_PATH . '/elementor/widgets/heading-typewriter.php';
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Attesa_Extra_Heading_Typewriter() );
		
		require_once AE_PATH . '/elementor/widgets/alert-message.php';
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Attesa_Extra_Alert_Message() );
	}
	
	public function register_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'attesa-elements',
				[
					'title' => __( 'Attesa Theme Elements', 'attesa-extra' ),
					'icon' => 'fa fa-plug',
				]
		);
	}
	
	public function widget_scripts() {
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_register_script('typed', plugins_url('elementor/js/typed'.$min.'.js',dirname(__FILE__)), array('jquery'),'1.1.4',true);
		wp_register_script('awp-alert', plugins_url('elementor/js/alert'.$min.'.js',dirname(__FILE__)), array('jquery'),ATTESA_EXTRA_PLUGIN_VERSION,true);
	}
	
	public function widget_scripts_preview() {
		wp_enqueue_script( 'typed' );
		wp_enqueue_script( 'awp-alert' );
	}
	
	public function editor_style() {
		wp_enqueue_style( 'awp-elementor-editor', plugins_url( 'elementor/css/editor.min.css',dirname(__FILE__)), array(), ATTESA_EXTRA_PLUGIN_VERSION );
	}
}
Attesa_Extra_Elementor_Extensions::instance();