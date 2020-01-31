<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
use WPTRT\Customize\Section\Button;
final class Attesa_Updgrade_Pro_Button {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {
		
		require_once( trailingslashit( get_template_directory() ) . 'inc/pro-button/Button.php' );

		$manager->register_section_type( Button::class );

		$manager->add_section(
			new Button( $manager, 'manager_attesa_buy_pro', [
				'title'       => __( 'Attesa PRO Addon', 'attesa' ),
				'button_text' => __( 'More Info',        'attesa' ),
				'button_url'  => 'https://attesawp.com/attesa-pro/',
				'priority' => 1,
			] )
		);
		
		if ( !class_exists( 'Attesa_extra' ) ) {
			$manager->add_section(
				new Button( $manager, 'manager_attesa_get_extra', [
					'title'       => __( 'Free Attesa Extra plugin', 'attesa' ),
					'button_text' => __( 'Get Attesa Extra',        'attesa' ),
					'button_url'  => admin_url( add_query_arg( array( 's' => 'attesa+extra', 'tab' => 'search', 'type' => 'term' ), 'plugin-install.php' ) ),
					'priority' => 999,
				] )
			);
		}
		
		$manager->add_section(
			new Button( $manager, 'manager_attesa_documentation', [
				'title'       => __( 'Need help?', 'attesa' ),
				'button_text' => __( 'Theme Documentation',        'attesa' ),
				'button_url'  => 'https://attesawp.com/docs/',
				'priority' => 999,
			] )
		);
		
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'attesa-customize-controls-pro-button', trailingslashit( get_template_directory_uri() ) . 'inc/pro-button/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'attesa-customize-controls-pro-button', trailingslashit( get_template_directory_uri() ) . 'inc/pro-button/customize-controls.css' );
	}
}

// Doing this customizer thang!
Attesa_Updgrade_Pro_Button::get_instance();
