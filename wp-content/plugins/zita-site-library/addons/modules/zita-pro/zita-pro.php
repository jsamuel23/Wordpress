<?php

// Elementor Classes.
use Elementor\Widget_Base;

/**
 * Class ZitaPro.
 */
class Zita_Pro extends Widget_Base {

	/**
	 * Retrieve ZitaPro Widget name.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'zita-pro-license';
	}

	/**
	 * Retrieve ZitaPro Widget title.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return '<a href="'.admin_url('/admin.php?page=zita-license').'">Enable Pro Feature</a>';
	}

	/**
	 * Retrieve ZitaPro Widget icon.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-pro-icon';
	}

	/**
   * Get widget categories.
   *
   * Retrieve the list of categories the widget belongs to.
   *
   * @since 1.0.0
   * @access public
   *
   * @return array Widget categories.
   */
  public function get_categories() {
    return [ 'elaet-category' ];
  }


}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Zita_Pro() );
