<?php
//namespace Elementor;


// Elementor Classes.
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Class ContentToggle.
 */
class Elaet_Content_Swicher extends Widget_Base {

	/**
	 * Retrieve Radio Button Switcher Widget name.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'content-switcher';
	}

	/**
	 * Retrieve Radio Button Switcher Widget title.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Content Switcher';
	}

	/**
	 * Retrieve Radio Button Switcher Widget icon.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-toggle';
	}

	/**
   * Get widget categories.
   *
   * Retrieve the list of categories the oEmbed widget belongs to.
   *
   * @since 1.0.0
   * @access public
   *
   * @return array Widget categories.
   */
  public function get_categories() {
    return [ 'elaet-category' ];
  }

	/**
	 * Register General Content controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function _register_controls() {
		$this->register_general_content_controls();
		$this->register_general_content_style_controls();
	}

	/**
	 * Render button widget classes names.
	 *
	 * @since 0.0.1
	 * @param array  $settings The settings array.
	 * @param int    $node_id The node id.
	 * @param string $section Section one or two.
	 * @return string Concatenated string of classes
	 * @access public
	 */
	public function get_modal_content( $settings, $node_id, $section ) {

		$normal_content_1 = $this->get_settings_for_display( 'section_content_1' );
		$normal_content_2 = $this->get_settings_for_display( 'section_content_2' );
		$content_type     = $settings[ $section ];
		if ( 'th_select_section_1' === $section ) {
			switch ( $content_type ) {
				case 'content':
					global $wp_embed;
					return '<div>' . wpautop( $wp_embed->autoembed( $normal_content_1 ) ) . '</div>';
				break;
				case 'saved_rows':
					return \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['section_saved_rows_1'] );
				break;
				case 'saved_page_templates':
					return \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['section_saved_pages_1'] );
				break;
				default:
					return;
				break;
			}
		} else {
			switch ( $content_type ) {
				case 'content':
					global $wp_embed;
					return '<div>' . wpautop( $wp_embed->autoembed( $normal_content_2 ) ) . '</div>';
				break;
				case 'saved_rows':
					return \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['section_saved_rows_2'] );
				break;
				case 'saved_page_templates':
					return \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['section_saved_pages_2'] );
				break;
				default:
					return;
				break;
			}
		}
	}

	/**
	 *  Get Saved Widgets
	 *
	 *  @param string $type Type.
	 *  @since 0.0.1
	 *  @return string
	 */
	public function get_saved_data( $type = 'page' ) {

		$saved_widgets = $this->get_post_template( $type );
		$options[-1]   = __( 'Select', 'elaet' );
		if ( count( $saved_widgets ) ) {
			foreach ( $saved_widgets as $saved_row ) {
				$options[ $saved_row['id'] ] = $saved_row['name'];
			}
		} else {
			$options['no_template'] = __( 'It seems that, you have not saved any template yet.', 'elaet' );
		}
		return $options;
	}

	/**
	 *  Get Templates based on category
	 *
	 *  @param string $type Type.
	 *  @since 0.0.1
	 *  @return string
	 */
	public function get_post_template( $type = 'page' ) {
		$posts = get_posts(
			array(
				'post_type'      => 'elementor_library',
				'orderby'        => 'title',
				'order'          => 'ASC',
				'posts_per_page' => '-1',
				'tax_query'      => array(
					array(
						'taxonomy' => 'elementor_library_type',
						'field'    => 'slug',
						'terms'    => $type,
					),
				),
			)
		);

		$templates = array();

		foreach ( $posts as $post ) {

			$templates[] = array(
				'id'   => $post->ID,
				'name' => $post->post_title,
			);
		}

		return $templates;
	}

	/**
	 * Registers all controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_general_content_controls() {
		// th heading section starts.
		$this->start_controls_section(
			'th_section_content_1',
			[
				'label' => __( 'Primary Content', 'elaet' ),
			]
		);

		// th section 1 heading text.
		$this->add_control(
			'th_section_heading_1',
			[
				'label'   => __( 'Title', 'elaet' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Title 1', 'elaet' ),
			]
		);

		// th content section 1.
		$this->add_control(
			'th_select_section_1',
			[
				'label'   => __( 'Content Type', 'elaet' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => $this->get_content_type(),
			]
		);

		// th content section 1 - content.
		$this->add_control(
			'section_content_1',
			[
				'label'      => __( 'Content', 'elaet' ),
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => __( 'This is your primary content. Fusce volutpat porta leo et porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus eu mattis eros. Sed quis ante sodales, dapibus mi sed, egestas tellus. Nam ornare porta mi, eget ultricies dui. Fusce tempor quam quis viverra faucibus. ', 'elaet' ),
				'rows'       => 10,
				'show_label' => false,
				'dynamic'    => [
					'active' => true,
				],
				'condition'  => [
					'th_select_section_1' => 'content',
				],
			]
		);

		// th content section 1 - saved rows.
		$this->add_control(
			'section_saved_rows_1',
			[
				'label'     => __( 'Select Section', 'elaet' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_saved_data( 'section' ),
				'default'   => '-1',
				'condition' => [
					'th_select_section_1' => 'saved_rows',
				],
			]
		);

		// th content section 1 - saved pages.
		$this->add_control(
			'section_saved_pages_1',
			[
				'label'     => __( 'Select Page', 'elaet' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_saved_data( 'page' ),
				'default'   => '-1',
				'condition' => [
					'th_select_section_1' => 'saved_page_templates',
				],
			]
		);

		// th heading section ends.
		$this->end_controls_section();

		// th content sections starts.
		$this->start_controls_section(
			'th_sections_content_2',
			[
				'label' => __( 'Secondary Content', 'elaet' ),
			]
		);

		// th section 2 heading text.
		$this->add_control(
			'th_section_heading_2',
			[
				'label'   => __( 'Title', 'elaet' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Title 2', 'elaet' ),
			]
		);

		// th content section 2.
		$this->add_control(
			'th_select_section_2',
			[
				'label'   => __( 'Content Type', 'elaet' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => $this->get_content_type(),
			]
		);

		// th content section 2 - content.
		$this->add_control(
			'section_content_2',
			[
				'label'      => __( 'Content', 'elaet' ),
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => __( 'This is your secondary content. Sed sit amet facilisis tortor. Proin in dapibus diam. Quisque aliquam nec elit sit amet ultrices. Duis eu ornare quam. Nullam feugiat bibendum sapien, a tempor enim eleifend non. Suspendisse tortor dolor, iaculis at felis at, mollis rhoncus eros. Morbi ut congue dui, sed gravida metus.', 'elaet' ),
				'rows'       => 10,
				'show_label' => false,
				'dynamic'    => [
					'active' => true,
				],
				'condition'  => [
					'th_select_section_2' => 'content',
				],
			]
		);

		// th content section 2 - saved rows.
		$this->add_control(
			'section_saved_rows_2',
			[
				'label'     => __( 'Select Section', 'elaet' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_saved_data( 'section' ),
				'default'   => '-1',
				'condition' => [
					'th_select_section_2' => 'saved_rows',
				],
			]
		);

		// th content section 2 - saved pages.
		$this->add_control(
			'section_saved_pages_2',
			[
				'label'     => __( 'Select Page', 'elaet' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_saved_data( 'page' ),
				'default'   => '-1',
				'condition' => [
					'th_select_section_2' => 'saved_page_templates',
				],
			]
		);

		// th heading section ends.
		$this->end_controls_section();

	}

	/**
	 * Registers all controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_general_content_style_controls() {

				// Section heading style starts.
		$this->start_controls_section(
			'section_style_heading',
			[
				'label' => __( 'Titles', 'elaet' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Color Heading
		$this->add_control(
			'spacing_heading',
			[
				'label'     => __( 'Spacing', 'elaet' ),
				'type'      => Controls_Manager::HEADING,
				
			]
		);

		// Spacing Headings and toggle button.
		$this->add_responsive_control(
			'rds_button_headings_spacing',
			[
				'label'     => __( 'Button &amp; Titles', 'elaet' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'   => [
					'size' => 5,
				],
				'selectors' => [
					// General.
					'{{WRAPPER}} .elaet-th-wrapper .elaet-sec-1'         => 'margin-right: {{SIZE}}%;',
					'{{WRAPPER}} .elaet-th-wrapper .elaet-sec-2'         => 'margin-left: {{SIZE}}%;',
				],
			]
		);

		// Spacing Headings and content.
		$this->add_responsive_control(
			'rds_headings_content_spacing',
			[
				'label'     => __( 'Content &amp; Titles', 'elaet' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 5
				],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					// General.
					'{{WRAPPER}} .elaet-th-toggle' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		// Headings and toggle button.
		$this->add_responsive_control(
			'rds_headings_top_spacing',
			[
				'label'     => __( 'Titles Top', 'elaet' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'   => [
					'size' => 2,
				],
				'selectors' => [
					// General.
					'{{WRAPPER}} .elaet-th-wrapper .elaet-sec-1'         => 'margin-top: {{SIZE}}%;',
					'{{WRAPPER}} .elaet-th-wrapper .elaet-sec-2'         => 'margin-top: {{SIZE}}%;',
				],
			]
		);

		// Color Heading
		$this->add_control(
			'section_color_heading',
			[
				'label'     => __( 'Color', 'elaet' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Title 1 - color.
		$this->add_control(
			'section_heading_1_color',
			[
				'label'     => __( 'Title 1', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-th-head-1' => 'color: {{VALUE}};',
				],
				'separator' => 'none',
			]
		);

		// Title 2 - color.
		$this->add_control(
			'section_heading_2_color',
			[
				'label'     => __( 'Title 2', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-th-head-2' => 'color: {{VALUE}};',
				],
				'separator' => 'none',
			]
		);

		// Typography Heading.
		$this->add_control(
			'section_typography_heading',
			[
				'label'     => __( 'Typography', 'elaet' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Title 1 - typography.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => __( 'Title 1', 'elaet' ),
				'name'     => 'section_heading_1_typo',
				'selector' => '{{WRAPPER}} .elaet-th-head-1',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		// Title 2 - typography.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => __( 'Title 2', 'elaet' ),
				'name'     => 'section_heading_2_typo',
				'selector' => '{{WRAPPER}} .elaet-th-head-2',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'th_header_size',
			[
				'label'     => __( 'HTML Tag', 'elaet' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p' => 'p',
				],
				'default'   => 'h5',
				'separator' => 'before',
			]
		);

		// heading alignment content Alignment.
		$this->add_responsive_control(
			'rds_heading_alignment',
			[
				'label'     => __( 'Alignment', 'elaet' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'elaet' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'elaet' ),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end'   => [
						'title' => __( 'Right', 'elaet' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-th-toggle' => 'justify-content: {{VALUE}};',			],
			]
		);

		// Heading background color.
		$this->add_control(
			'section_heading_bg_color',
			[
				'label'     => __( 'Background Color', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elaet-th-toggle' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Heading - Border.
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'heading_border',
				'label'     => __( 'Border', 'elaet' ),
				'selector'  => '{{WRAPPER}} .elaet-th-toggle',
			]
		);

		$this->add_control(
			'heading_border_radius',
			[
				'label'      => __( 'Border Radius', 'elaet' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elaet-th-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Overall Heading - padding.
		$this->add_responsive_control(
			'th_heading_padding',
			[
				'label'      => __( 'Padding', 'elaet' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .elaet-th-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Section heading style ends.
		$this->end_controls_section();



		// Switch style starts.
		$this->start_controls_section(
			'th_switch_style',
			[
				'label' => __( 'Switch', 'elaet' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// th default switch mode.
		$this->add_control(
			'th_default_switch',
			[
				'label'        => __( 'Default Display', 'elaet' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'off',
				'return_value' => 'on',
				'options'      => [
					'off' => 'Primary Content',
					'on'  => 'Secondary Content',
				],
				'separator'    => 'before',
			]
		);

		// th select switch.
		$this->add_control(
			'th_select_switch',
			[
				'label'   => __( 'Switch Style', 'elaet' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'label_box',
				'options' => $this->get_switch_type(),
			]
		);

		// Content 1 - heading.
		$this->add_control(
			'switch_bg_color_heading',
			[
				'label'     => __( 'Switch Background Color', 'elaet' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'th_select_section_1' => 'content',
				],
			]
		);

		// Switch - Off color.
		$this->add_control(
			'th_switch_color_off',
			[
				'label'     => __( 'Switch 1', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#3aa8a2',
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-th-slider' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elaet-toggle input[type="checkbox"] + label:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elaet-toggle input[type="checkbox"] + label:after' => 'border: 0.3em solid {{VALUE}};',
					'{{WRAPPER}} .elaet-label-box-active .elaet-label-box-switch' => 'background: {{VALUE}};',

				],
			]
		);

				// Switch - Off color.
		$this->add_control(
			'th_switch_color_right_half',
			[
				'label'     => __( 'Switch 1 Other Half', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#eeeeee',
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'condition' => [
					'th_select_switch' => ['oval_label_box','label_box'],
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-label-box-inner .elaet-label-box-active' => 'background: {{VALUE}};',

				],
			]
		);

		// Switch - On color.
		$this->add_control(
			'th_switch_color_on',
			[
				'label'     => __( 'Switch 2', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#6b6b6b',
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],

				'selectors' => [
					'{{WRAPPER}} .elaet-th-switch:checked + .elaet-th-slider' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elaet-th-switch:focus + .elaet-th-slider'     => '-webkit-box-shadow: 0 0 1px {{VALUE}};box-shadow: 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .elaet-toggle input[type="checkbox"]:checked + label:before'     => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elaet-toggle input[type="checkbox"]:checked + label:after'     => '-webkit-transform: translateX(3.5em);-ms-transform: translateX(3.5em);transform: translateX(3.5em);border: 0.3em solid {{VALUE}};',
					'{{WRAPPER}} .elaet-toggle.elaet-capsule-div input[type="checkbox"]:checked + label:before'     => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elaet-toggle.elaet-capsule-div input[type="checkbox"]:checked + label:after'     => '-webkit-transform: translateX(3.7em);-ms-transform: translateX(3.7em);transform: translateX(3.7em);border: 0.3em solid {{VALUE}};',
					'{{WRAPPER}} .elaet-label-box-inactive .elaet-label-box-switch' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'th_switch_color_left_half',
			[
				'label'     => __( 'Switch 2 Other Half', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#eeeeee',
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'condition' => [
					'th_select_switch' => ['oval_label_box','label_box'],
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-label-box-inner .elaet-label-box-inactive' => 'background-color: {{VALUE}};',
				],
			]
		);


		// Switch - Controller Color.
		$this->add_control(
			'th_switch_controller',
			[
				'label'     => __( 'Controller Color', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elaet-th-slider:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elaet-toggle input[type="checkbox"] + label:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} span.elaet-label-box-switch' => 'color: {{VALUE}};',
				],
			]
		);

		// Switch size.
		$this->add_responsive_control(
			'rds_switch_size',
			[
				'label'     => __( 'Switch Size', 'elaet' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 15,
				],
				'range'     => [
					'px' => [
						'min'  => 10,
						'max'  => 35,
						'step' => 1,
					],
				],
				'selectors' => [
					// General.
					'{{WRAPPER}} .elaet-main-btn,{{WRAPPER}} .elaet-main-btn label ' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		// Switch style ends.
		$this->end_controls_section();

			// Content style starts.
		$this->start_controls_section(
			'th_content_style',
			[
				'label' => __( 'Content', 'elaet' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Content 1 - heading.
		$this->add_control(
			'section_content_color_heading',
			[
				'label'     => __( 'Color', 'elaet' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'th_select_section_1' => 'content',
				],
			]
		);

		// Content 1 Color.
		$this->add_control(
			'section_content_1_color',
			[
				'label'     => __( 'Primary Content', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'th_select_section_1' => 'content',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-th-content-1.elaet-th-section-1' => 'color: {{VALUE}};',
				],
			]
		);

		// Content 2 Color.
		$this->add_control(
			'section_content_2_color',
			[
				'label'     => __( 'Secondary Content', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'th_select_section_2' => 'content',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-th-content-2.elaet-th-section-2' => 'color: {{VALUE}};',
				],
			]
		);

		// Content 1 - heading.
		$this->add_control(
			'section_content_bg_color_heading',
			[
				'label'     => __( 'Background Color', 'elaet' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'th_select_section_1' => 'content',
				],
			]
		);

		// Content 1 BG Color.
		$this->add_control(
			'section_content_1_bg_color',
			[
				'label'     => __( 'Primary Content', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default'  => '#ffffff',
				'condition' => [
					'th_select_section_1' => 'content',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-th-content-1.elaet-th-section-1' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Content 2 BG Color.
		$this->add_control(
			'section_content_2_bg_color',
			[
				'label'     => __( 'Secondary Content', 'elaet' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default'  => '#ffffff',
				'condition' => [
					'th_select_section_2' => 'content',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-th-content-2.elaet-th-section-2' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Content 2 - heading.
		$this->add_control(
			'section_content_typo_heading',
			[
				'label'     => __( 'Typography', 'elaet' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'th_select_section_2' => 'content',
				],
			]
		);

		// Content 1 Typo.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => __( 'Primary Content', 'elaet' ),
				'name'      => 'section_content_1_typo',
				'selector'  => '{{WRAPPER}} .elaet-th-content-1.elaet-th-section-1',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_3,
				'condition' => [
					'th_select_section_1' => 'content',
				],
				'separator' => 'after',
			]
		);	

		// Content 2 Typo.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => __( 'Secondary Content', 'elaet' ),
				'name'      => 'section_content_2_typo',
				'selector'  => '{{WRAPPER}} .elaet-th-content-2.elaet-th-section-2',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_3,
				'condition' => [
					'th_select_section_2' => 'content',
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'th_content_advance_setting',
			[
				'label'     => __( 'Other Settings', 'elaet' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Content padding.
		$this->add_responsive_control(
			'th_content_padding',
			[
				'label'      => __( 'Padding', 'elaet' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
		            'top'    => '20',
		            'bottom' => '20',
		            'left'   => '20',
		            'right'  => '20',
		            'unit'   => 'px',
		          ],
				'selectors'  => [
					'{{WRAPPER}} .elaet-th-toggle-sections .elaet-th-content-1.elaet-th-section-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elaet-th-toggle-sections .elaet-th-content-2.elaet-th-section-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label'      => __( 'Border Radius', 'elaet' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elaet-th-toggle-sections .elaet-th-content-1.elaet-th-section-1,{{WRAPPER}} .elaet-th-toggle-sections .elaet-th-content-2.elaet-th-section-2' => 'overflow: hidden;border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->start_controls_tabs(
			'content_border_tabs'
		);

		$this->start_controls_tab(
			'primary_content_tab',
			[
				'label' => __( 'Primary Content', 'elaet' ),
			]
		);

		// Primary Content - Border.
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'primary_content_border',
				'label'     => __( 'Border', 'elaet' ),
				'selector' => '{{WRAPPER}} .elaet-th-toggle-sections .elaet-th-content-1.elaet-th-section-1',
				]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'secondary_content_tab',
			[
				'label' => __( 'Secondary Content', 'elaet' ),
			]
		);

		//Secondary Content - Border.
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'secondary_content_border',
				'label'     => __( 'Border', 'elaet' ),
				'selector' => '{{WRAPPER}} .elaet-th-toggle-sections .elaet-th-content-2.elaet-th-section-2',
				]
		);
		
		$this->end_controls_tab();

		$this->end_controls_tabs();

		// Content style ends.
		$this->end_controls_section();

	}

	/**
	 * Render content type list.
	 *
	 * @since 0.0.1
	 * @return array Array of content type
	 * @access public
	 */
	public function get_content_type() {

		$content_type = array(
			'content'              => __( 'Content', 'elaet' ),
			'saved_rows'           => __( 'Saved Section', 'elaet' ),
			'saved_page_templates' => __( 'Saved Page', 'elaet' ),
		);

		return $content_type;
	}

	/**
	 * Render content type list.
	 *
	 * @since 0.0.1
	 * @return array Array of content type
	 * @access public
	 */
	public function get_switch_type() {

		$switch_type = array(
			'round_1'   => __( 'Switch 1', 'elaet' ),
			'round_2'   => __( 'Switch 2', 'elaet' ),
			'capsule' => __( 'Capsule', 'elaet' ),
			'rectangle' => __( 'Rectangle', 'elaet' ),
			'oval_label_box' => __( 'Tick', 'elaet' ),
			'label_box' => __( 'Oval Label', 'elaet' ),
		);

		return $switch_type;
	}

	/**
	 * Render Radio Button output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function render() {

		$settings  = $this->get_settings();
		$node_id   = $this->get_id();
		$is_editor = \Elementor\Plugin::instance()->editor->is_edit_mode();
		ob_start();
		include 'template.php';
		$html = ob_get_clean();
		echo $html;
	}

	/**
	 * Render Timeline output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function _content_template() {}

}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Content_Swicher() );
