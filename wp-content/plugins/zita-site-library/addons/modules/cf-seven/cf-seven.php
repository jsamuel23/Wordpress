<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Elaet_Cf_Seven extends Widget_Base {

	/**
   * Get widget name.
   *
   * Retrieve Cf Seven widget name.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'Contact Form 7';
  }

  /**
   * Get widget title.
   *
   * Retrieve Cf Seven widget title.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget title.
   */
  public function get_title() {
    return __( 'Contact Form 7', 'elaet' );
  }

  /**
   * Get widget icon.
   *
   * Retrieve widget icon.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Cf Seven Widget icon.
   */
  public function get_icon() {
    return 'fa fa-wpforms';
  }

  /**
   * Get widget categories.
   *
   * Retrieve the list of categories Cf Seven widget belongs to.
   *
   * @since 1.0.0
   * @access public
   *
   * @return array Widget categories.
   */
  public function get_categories() {
    return [ 'elaet-category' ];
  }

		
	protected function _register_controls() {

		$this->register_general_content_controls();

		$this->register_label_style_controls();
		$this->register_field_style_controls();
		$this->register_radio_checkbox_style_controls();
		$this->register_button_style_controls();	
		$this->register_message_style_controls();
	}

	protected function register_general_content_controls() {

		$this->start_controls_section(
				'section_contact_us',
				[
					'label' => __( 'Contact Form 7', 'elaet' )
				]
			);
			
		$this->add_control(
			'cf7_form', // id
			[
				'label' => __( 'Select Form', 'elaet' ),
				'type' => Controls_Manager::SELECT,
				'options' => 
					$this->elaet_query_posts('wpcf7_contact_form', -1)
				
			]
		);

		$this->end_controls_section();
	}

	protected function register_label_style_controls() {

		//Label Styles
			$this->start_controls_section(
				'field_label',
				[
					'label' => __( 'Label Styling', 'elaet' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'form_label_color',
				[
					'label' => __( 'Label Color', 'elaet' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_2,
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container .wpcf7 form.wpcf7-form:not(input),' => 'color: {{VALUE}};',
						'{{WRAPPER}} .elaet-cf7-container .wpcf7 form.wpcf7-form label' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'form_labels_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .elaet-cf7-container form.wpcf7-form label',
				]
			);
		
			$this->end_controls_section();

	}

	protected function register_field_style_controls() {

			$this->start_controls_section(
				'form_inputs',
				[
					'label' => __( 'Field Styling', 'elaet' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'cf7_text_align',
				[
					'label'     => __( 'Field Alignment', 'elaet' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'   => [
							'title' => __( 'Left', 'elaet' ),
							'icon'  => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'elaet' ),
							'icon'  => 'fa fa-align-center',
						],
						'right'  => [
							'title' => __( 'Right', 'elaet' ),
							'icon'  => 'fa fa-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container .wpcf7, {{WRAPPER}} .elaet-cf7-container input:not([type=submit]),{{WRAPPER}} .elaet-cf7-container textarea' => 'text-align: {{VALUE}};',
						' {{WRAPPER}} .elaet-cf7-container select' => 'text-align-last:{{VALUE}};',
					],
				]
			);

			$this->add_control(
				'form_inputs_bg',
				[
					'label' => __( 'Field Background', 'elaet' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#f9f9f9',
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3,
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form .wpcf7-form-control-wrap input:not(.wpcf7-submit), .elaet-cf7-container .wpcf7 .wpcf7-form .wpcf7-form-control-wrap textarea' => 'background: {{VALUE}};',
						'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form input:not([type=submit]), {{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form select, {{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form textarea, {{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form .wpcf7-checkbox input[type="checkbox"] + span:before,{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form .wpcf7-acceptance input[type="checkbox"] + span:before, {{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form .wpcf7-radio input[type="radio"] + span:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form input[type=range]::-webkit-slider-runnable-track,{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form input[type=range]:focus::-webkit-slider-runnable-track' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form input[type=range]::-moz-range-track,{{WRAPPER}} input[type=range]:focus::-moz-range-track' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form input[type=range]::-ms-fill-lower,{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form input[type=range]:focus::-ms-fill-lower' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form input[type=range]::-ms-fill-upper,{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-form input[type=range]:focus::-ms-fill-upper' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cf7_field_spacing_heading',
				[
					'label'     => __( 'Spacing', 'elaet' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'cf7_input_margin_top',
				[
					'label'      => __( 'Between Label &amp; Fields', 'elaet' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range'      => [
						'px' => [
							'min' => 1,
							'max' => 60,
						],
					],
					'default'    => [
						'unit' => 'px',
						'size' => 5,
					],
					'selectors'  => [
						'{{WRAPPER}} .elaet-cf7-container input:not([type=submit]):not([type=checkbox]):not([type=radio]), {{WRAPPER}} .elaet-cf7-container select, {{WRAPPER}} .elaet-cf7-container textarea, {{WRAPPER}} .elaet-cf7-container span.wpcf7-list-item' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'cf7_input_margin_bottom',
				[
					'label'      => __( 'Between Fields', 'elaet' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range'      => [
						'px' => [
							'min' => 1,
							'max' => 60,
						],
					],
					'default'    => [
						'unit' => 'px',
						'size' => 10,
					],
					'selectors'  => [
						'{{WRAPPER}} .elaet-cf7-container input:not([type=submit]):not([type=checkbox]):not([type=radio]), {{WRAPPER}} .elaet-cf7-container select, {{WRAPPER}} .elaet-cf7-container textarea, {{WRAPPER}} .elaet-cf7-container span.wpcf7-list-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'cf7_field_dimensions_heading',
				[
					'label'     => __( 'Field Dimensions', 'elaet' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			); 
			$this->add_responsive_control(
				'form_text_inputs_width',
				[
					'label' => __( 'Input Field Width', 'elaet' ),
					'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1200,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
                'default'   => [
                    'size'  => 100,
                    'unit'  => '%'
                ],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container input.wpcf7-text' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

						$this->add_responsive_control(
  			'form_text_inputs_height',
  			[
  				'label' => __( 'Input Field Height', 'elaet' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
						'unit' => 'px',
						'size' => '55',
					],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1200,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container input.wpcf7-text' => 'height: {{SIZE}}{{UNIT}};',
					],
  			]
  		); 

			$this->add_responsive_control(
				'form_textarea_inputs_width',
				[
					'label' => __( 'Textarea Width', 'elaet' ),
					'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1200,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
                'default'   => [
                    'size'  => 100,
                    'unit'  => '%'
                ],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container textarea.wpcf7-textarea' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
  			'form_textarea_inputs_height',
  			[
  				'label' => __( 'Textarea Height', 'elaet' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1200,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container textarea.wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}};',
					],
  			]
  		); 

			$this->add_control(
				'cf7_field_padding_heading',
				[
					'label'     => __( 'Padding', 'elaet' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'form_text_inputs_padding',
				[
					'label' => __( 'Input Text', 'elaet' ),
					'type' => Controls_Manager::DIMENSIONS,
					'description' => __( 'Padding Around Text', 'elaet' ),
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .elaet-cf7-container input:not(.wpcf7-submit)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'form__textarea_inputs_padding',
				[
					'label' => __( 'Textarea Text', 'elaet' ),
					'type' => Controls_Manager::DIMENSIONS,
					'description' => __( 'Padding Around Text', 'elaet' ),
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .elaet-cf7-container textarea.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'form_select_inputs_padding',
				[
					'label' => __( 'Drop-Down Select Text', 'elaet' ),
					'type' => Controls_Manager::DIMENSIONS,
					'description' => __( 'Padding Around Text', 'elaet' ),
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .elaet-cf7-container select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'cf7_field_color_heading',
				[
					'label'     => __( 'Choose Color', 'elaet' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'form_inputs_txt_color',
				[
					'label' => __( 'Input Text / Placeholder', 'elaet' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_2,
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container .wpcf7-form-control-wrap input:not(.wpcf7-submit), .elaet-cf7-container .wpcf7-form-control-wrap textarea, {{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
						'{{WRAPPER}} :-ms-input-placeholder' => 'color: {{VALUE}};',
						'{{WRAPPER}} ::-moz-placeholder' => 'color: {{VALUE}};',
						'{{WRAPPER}} :-moz-placeholder' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'form_select_inputs_bg',
				[
					'label' => __( 'Drop Down Background', 'elaet' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3,
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container .wpcf7-form-control.wpcf7-select' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'form_select_input_text_color',
				[
					'label' => __( 'Drop Down Text', 'elaet' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_2,
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container .wpcf7-form-control.wpcf7-select' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cf7_field_typography_heading',
				[
					'label'     => __( 'TYPOGRAPHY', 'elaet' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => __( 'Field Text', 'elaet' ),
					'name' => 'form_field_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .elaet-cf7-container .wpcf7-form-control-wrap input:not(.wpcf7-submit), .elaet-cf7-container .wpcf7-form-control-wrap textarea'
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[	
					'label' => __( 'Drop Down Text', 'elaet' ),
					'name' => 'form_drop_down_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .elaet-cf7-container .wpcf7-form-control.wpcf7-select',
				]

			);
			
		$this->add_control(
				'cf7_field_border_heading',
				[
					'label'     => __( 'Border', 'elaet' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
	
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_inputs_border',
				'label' => __( 'Border', 'elaet' ),
				'selector' => '{{WRAPPER}} .elaet-cf7-container .wpcf7-form-control-wrap input:not(.wpcf7-submit),{{WRAPPER}} .elaet-cf7-container .wpcf7-form-control-wrap input:not([type="checkbox"]),{{WRAPPER}} .elaet-cf7-container .wpcf7-form-control-wrap input:not([type="radio"]), .elaet-cf7-container .wpcf7-form-control-wrap textarea.wpcf7-form-control.wpcf7-textarea',
			]
		);

	        $this->add_control(
				'form_inputs_border_radius',
				[
					'label' => __( 'Border Radius', 'elaet' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container .wpcf7-form-control-wrap input:not(.wpcf7-submit), .elaet-cf7-container .wpcf7-form-control-wrap textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		
			$this->end_controls_section();

	}


	protected function register_radio_checkbox_style_controls() {

		$this->start_controls_section(
			'cf7_radio_checkbox_style',
			[
				'label' => __( 'Radio &amp; Checkbox Styling', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'cf7_custom_radio_checkbox',
            [
                'label'                 => __( 'Change Default Style', 'elaet' ),
                'type'                  => Controls_Manager::SWITCHER,
                'label_on'              => __( 'Yes', 'elaet' ),
                'label_off'             => __( 'No', 'elaet' ),
                'return_value'          => 'yes',
            ]
        );

			$this->add_control(
				'cf7_radio_checkbox_size',
				[
					'label'      => __( 'Size', 'elaet' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'default'    => [
						'unit' => 'px',
						'size' => '15',
					],
					'range'      => [
						'px' => [
							'min' => 10,
							'max' => 40,
						],
					],
					'condition'  => [
						'cf7_custom_radio_checkbox' => 'yes',
					],
					'selectors'  => [
						'{{WRAPPER}} .elaet-cf7-container .wpcf7-radio span.wpcf7-list-item input[type="radio"]' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elaet-cf7-container .wpcf7-checkbox span.wpcf7-list-item input[type="checkbox"]' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elaet-cf7-container .wpcf7-acceptance span.wpcf7-list-item input[type="checkbox"]' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'cf7_radio_check_label_color',
				[
					'label'     => __( 'Label Color', 'elaet' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'condition'  => [
						'cf7_custom_radio_checkbox' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container .wpcf7-checkbox span.wpcf7-list-item-label, .elaet-cf7-container .wpcf7-radio span.wpcf7-list-item-label,.elaet-cf7-container .wpcf7-acceptance span.wpcf7-list-item-label' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'cf7_radio_checkbox_font-size',
				[
					'label'      => __( 'Label Font Size', 'elaet' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'default'    => [
						'size' => '18',
						'unit' => 'px',
					],
					'range'      => [
						'px' => [
							'min' => 1,
							'max' => 50,
						],
						'em' => [
							'min' => 1,
							'max' => 5,
						],
						'rem' => [
							'min' => 1,
							'max' => 5,
						],
					],
					'condition'  => [
						'cf7_custom_radio_checkbox' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-custom-radio-checkbox .wpcf7-radio .wpcf7-list-item-label' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elaet-custom-radio-checkbox .wpcf7-checkbox .wpcf7-list-item-label' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elaet-custom-radio-checkbox .wpcf7-acceptance .wpcf7-list-item-label' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
            'cf7_radio_checkbox_spacing',
            [
                'label'                 => __( 'Spacing', 'elaet' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
				'condition'             => [
					'cf7_custom_radio_checkbox' => 'yes',
				],
            ]
        );

			$this->add_responsive_control(
				'cf7_radio_checkbox_spacing_left',
				[
					'label'      => __( 'Between Label &amp; Radio or Checkbox', 'elaet' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'default'    => [
						'size' => '0',
						'unit' => 'px',
					],
					'range'      => [
						'px' => [
							'min' => 0,
							'max' => 50,
						],
						'em' => [
							'min' => 0,
							'max' => 5,
						],
						'rem' => [
							'min' => 0,
							'max' => 5,
						],
					],
					'condition'  => [
						'cf7_custom_radio_checkbox' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-custom-radio-checkbox .wpcf7-radio .wpcf7-list-item-label ~ input[type="radio"]' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elaet-custom-radio-checkbox .wpcf7-checkbox .wpcf7-list-item-label ~ input[type="checkbox"]' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elaet-custom-radio-checkbox .wpcf7-acceptance .wpcf7-list-item-label~input[type="checkbox"]' => 'margin-left: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'cf7_radio_checkbox_spacing_label_left',
				[
					'label'      => __( 'Between Fields', 'elaet' ),
					'type'       => Controls_Manager::SLIDER,
					'separator'  => 'after',
					'size_units' => [ 'px', 'em', 'rem' ],
					'default'    => [
						'size' => '0',
						'unit' => 'px',
					],
					'range'      => [
						'px' => [
							'min' => 0,
							'max' => 50,
						],
						'em' => [
							'min' => 0,
							'max' => 5,
						],
						'rem' => [
							'min' => 0,
							'max' => 5,
						],
					],
					'condition'  => [
						'cf7_custom_radio_checkbox' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-custom-radio-checkbox .wpcf7-radio .wpcf7-list-item-label ~ input[type="radio"]' => 'margin-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elaet-custom-radio-checkbox .wpcf7-checkbox .wpcf7-list-item-label ~ input[type="checkbox"]' => 'margin-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elaet-custom-radio-checkbox .wpcf7-acceptance .wpcf7-list-item-label~input[type="checkbox"]' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);

			
		$this->start_controls_tabs( 'tabs_radio_checkbox_style' );

        $this->start_controls_tab(
            'radio_checkbox_normal',
            [
                'label'                 => __( 'Normal', 'elaet' ),
                'condition'             => [
                    'cf7_custom_radio_checkbox' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'radio_checkbox_color',
            [
                'label'                 => __( 'Color', 'elaet' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .elaet-custom-radio-checkbox input[type=checkbox]:before, {{WRAPPER}} .elaet-custom-radio-checkbox input[type=radio]:before' => 'background: {{VALUE}}',
                ],
                'condition'             => [
                    'cf7_custom_radio_checkbox' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'radio_checkbox_border_width',
            [
                'label'                 => __( 'Border Width', 'elaet' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 15,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .elaet-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .elaet-custom-radio-checkbox input[type="radio"]' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'cf7_custom_radio_checkbox' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'radio_checkbox_border_color',
            [
                'label'                 => __( 'Border Color', 'elaet' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .elaet-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .elaet-custom-radio-checkbox input[type="radio"]' => 'border-color: {{VALUE}}',
                ],
                'condition'             => [
                    'cf7_custom_radio_checkbox' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'checkbox_heading',
            [
                'label'                 => __( 'Checkbox', 'elaet' ),
                'type'                  => Controls_Manager::HEADING,
				'condition'             => [
					'cf7_custom_radio_checkbox' => 'yes',
				],
            ]
        );

		$this->add_control(
			'checkbox_border_radius',
			[
				'label'                 => __( 'Border Radius', 'elaet' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .elaet-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .elaet-custom-radio-checkbox input[type="checkbox"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'             => [
                    'cf7_custom_radio_checkbox' => 'yes',
                ],
			]
		);
        
        $this->add_control(
            'radio_heading',
            [
                'label'                 => __( 'Radio Buttons', 'elaet' ),
                'type'                  => Controls_Manager::HEADING,
				'condition'             => [
					'cf7_custom_radio_checkbox' => 'yes',
				],
            ]
        );

		$this->add_control(
			'radio_border_radius',
			[
				'label'                 => __( 'Border Radius', 'elaet' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .elaet-custom-radio-checkbox input[type="radio"], {{WRAPPER}} .elaet-custom-radio-checkbox input[type="radio"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'             => [
                    'cf7_custom_radio_checkbox' => 'yes',
                ],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'radio_checkbox_checked',
            [
                'label'                 => __( 'Checked', 'elaet' ),
                'condition'             => [
                    'cf7_custom_radio_checkbox' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'radio_checkbox_color_checked',
            [
                'label'                 => __( 'Color', 'elaet' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .elaet-custom-radio-checkbox input[type="checkbox"]:checked:before, {{WRAPPER}} .elaet-custom-radio-checkbox input[type="radio"]:checked:before' => 'background: {{VALUE}}',
                ],
                'condition'             => [
                    'cf7_custom_radio_checkbox' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function register_button_style_controls() {

			$this->start_controls_section(
				'form_btn',
				[
					'label' => __( 'Button Styling', 'elaet' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'form_btn_padding',
				[
					'label' => __( 'Padding', 'elaet' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'form_btn_margin',
				[
					'label' => __( 'Margin', 'elaet' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'form_btn_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .elaet-cf7-container input[type="submit"]',
				]
			);

			$this->add_control(
				'cf7_button_dimensions_heading',
				[
					'label'     => __( 'Button Dimensions', 'elaet' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			); 

			$this->add_responsive_control(
				'form_btn_width',
				[
					'label' => __( 'Button Width', 'elaet' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 30,
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 5,
							'max' => 1000,
						],
						'%' => [
							'min' => 5,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container input[type="submit"]' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_responsive_control(
				'form_btn_height',
				[
					'label' => __( 'Button Height', 'elaet' ),
					'type' => Controls_Manager::SLIDER,
					'separator' => 'after',
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'size_units' => [ 'px', 'em' ],
					'range' => [
						'px' => [
							'min' => 5,
							'max' => 300,
						],
						'em' => [
							'min' => 1,
							'max' => 20,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elaet-cf7-container input[type="submit"]' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_button_style' );

				$this->start_controls_tab(
					'tab_button_normal',
					[
						'label' => __( 'Normal', 'elaet' ),
					]
				);

					$this->add_control(
						'button_text_color',
						[
							'label'     => __( 'Text Color', 'elaet' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .elaet-cf7-container input[type="submit"]' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'           => 'btn_background_color',
							'label'          => __( 'Background Color', 'elaet' ),
							'types'          => [ 'classic', 'gradient' ],
							'fields_options' => [
								'color' => [
									'scheme' => [
										'type'  => Scheme_Color::get_type(),
										'value' => Scheme_Color::COLOR_4,
									],
								],
							],
							'selector'       => '{{WRAPPER}} .elaet-cf7-container input[type="submit"]',
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'        => 'btn_border',
							'label'       => __( 'Border', 'elaet' ),
							'placeholder' => '1px',
							'default'     => '1px',
							'selector'    => '{{WRAPPER}} .elaet-cf7-container input[type="submit"]',
						]
					);

					$this->add_responsive_control(
						'btn_border_radius',
						[
							'label'      => __( 'Border Radius', 'elaet' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%' ],
							'selectors'  => [
								'{{WRAPPER}} .elaet-cf7-container input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'     => 'button_box_shadow',
							'selector' => '{{WRAPPER}} .elaet-cf7-container input[type="submit"]',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_button_hover',
					[
						'label' => __( 'Hover', 'elaet' ),
					]
				);

					$this->add_control(
						'btn_hover_color',
						[
							'label'     => __( 'Text Color', 'elaet' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .elaet-cf7-container input[type="submit"]:hover' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'button_hover_border_color',
						[
							'label'     => __( 'Border Hover Color', 'elaet' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .elaet-cf7-container input[type="submit"]:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'     => 'button_background_hover_color',
							'label'    => __( 'Background Color', 'elaet' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .elaet-cf7-container input[type="submit"]:hover',
						]
					);

			$this->end_controls_tab();

			$this->end_controls_tabs();
			
			$this->end_controls_section();
	}

	protected function register_message_style_controls() {

		$this->start_controls_section(
			'cf7_error_section',
			[
				'label' => __( 'Message Styling', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'cf7_field_field_valid_heading',
				[
					'label'     => __( 'Field Validation Message', 'elaet' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_control(
					'cf7_validation_message_color',
					[
						'label'     => __( 'Text Color', 'elaet' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#f70000',
						'selectors' => [
							'{{WRAPPER}} .elaet-cf7-container span.wpcf7-not-valid-tip' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
				'cf7_message_border',
				[
					'label'       => __( 'Border Style', 'elaet' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'solid',
					'label_block' => true,
					'options'     => [
						'none'   => __( 'None', 'elaet' ),
						'solid'  => __( 'Solid', 'elaet' ),
						'double' => __( 'Double', 'elaet' ),
						'dotted' => __( 'Dotted', 'elaet' ),
						'dashed' => __( 'Dashed', 'elaet' ),
					],
					'selectors' => [
							'{{WRAPPER}} .elaet-cf7-container span.wpcf7-not-valid-tip' => 'border-style: {{VALUE}};',
						],
				]
			);

				$this->add_control(
				'cf7_message_border_size',
				[
					'label'      => __( 'Border Width', 'elaet' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'default'    => [
						'top'    => '1',
						'bottom' => '1',
						'left'   => '1',
						'right'  => '1',
						'unit'   => 'px',
					],
					'condition'  => [
						'cf7_message_border!' => 'none',
					],
					'selectors' => [
							'{{WRAPPER}} .elaet-cf7-container span.wpcf7-not-valid-tip' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
				]
			);

				$this->add_control(
					'cf7_message_border_color',
					[
						'label'     => __( 'Border Color', 'elaet' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#f70000',
						'condition' => [
							'cf7_message_border!' => 'none',
						],
						'selectors' => [
							'{{WRAPPER}} .elaet-cf7-container span.wpcf7-not-valid-tip' => 'border-color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'     => 'cf7_message_typography',
						'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
						'selector' => '{{WRAPPER}} .elaet-cf7-container span.wpcf7-not-valid-tip',
					]
				);

			$this->add_control(
				'cf7_form_validation_message',
				[
					'label'     => __( 'Form Submission Message', 'elaet' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'cf7_form_validation_success_message',
				[
					'label'     => __( 'Success Message', 'elaet' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_control(
					'cf7_success_message_color',
					[
						'label'     => __( 'Text Color', 'elaet' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .elaet-cf7-container .wpcf7-mail-sent-ok' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'cf7_success_message_bgcolor',
					[
						'label'     => __( 'Background Color', 'elaet' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .elaet-cf7-container .wpcf7-mail-sent-ok' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'cf7_success_border_color',
					[
						'label'     => __( 'Border Color', 'elaet' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'condition' => [
							'cf7_form_submit_message_border!' => 'none',
							'cf7_valid_border_size!' => '',
						],
						'selectors' => [
							'{{WRAPPER}} .elaet-cf7-container .wpcf7-mail-sent-ok' => 'border-color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
				'cf7_form_validation_error_message',
				[
					'label'     => __( 'Error Message', 'elaet' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_control(
					'cf7_error_message_color',
					[
						'label'     => __( 'Text Color', 'elaet' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-validation-errors, {{WRAPPER}} .elaet-cf7-container div.wpcf7-mail-sent-ng,{{WRAPPER}} .elaet-cf7-container .wpcf7-acceptance-missing' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'cf7_error_message_bgcolor',
					[
						'label'     => __( 'Background Color', 'elaet' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-validation-errors, {{WRAPPER}} .elaet-cf7-container div.wpcf7-mail-sent-ng,{{WRAPPER}} .elaet-cf7-container .wpcf7-acceptance-missing' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'cf7_error_border_color',
					[
						'label'     => __( 'Border Color', 'elaet' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ff0000',
						'separator' => 'after',
						'condition' => [
							'cf7_form_submit_message_border!' => 'none',
							'cf7_valid_border_size!' => '',
						],
						'selectors' => [
							'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-validation-errors, {{WRAPPER}} .elaet-cf7-container div.wpcf7-mail-sent-ng,{{WRAPPER}} .elaet-cf7-container .wpcf7-acceptance-missing' => 'border-color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
				'cf7_form_submit_message_border',
				[
					'label'       => __( 'Border Style', 'elaet' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'solid',
					'label_block' => true,
					'options'     => [
						'none'   => __( 'None', 'elaet' ),
						'solid'  => __( 'Solid', 'elaet' ),
						'double' => __( 'Double', 'elaet' ),
						'dotted' => __( 'Dotted', 'elaet' ),
						'dashed' => __( 'Dashed', 'elaet' ),
					],
					'selectors'  => [
							'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-validation-errors, {{WRAPPER}} .elaet-cf7-container div.wpcf7-mail-sent-ng,{{WRAPPER}} .elaet-cf7-container .wpcf7-acceptance-missing' => 'border-style: {{VALUE}};',
						],
				]
			);

				$this->add_responsive_control(
					'cf7_valid_border_size',
					[
						'label'      => __( 'Border Size', 'elaet' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'default'    => [
							'top'    => '2',
							'bottom' => '2',
							'left'   => '2',
							'right'  => '2',
							'unit'   => 'px',
						],
						'condition' => [
							'cf7_form_submit_message_border!' => 'none',
						],
						'selectors'  => [
							'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-validation-errors, {{WRAPPER}} .elaet-cf7-container div.wpcf7-mail-sent-ng,{{WRAPPER}} .elaet-cf7-container .wpcf7-acceptance-missing' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'cf7_valid_message_radius',
					[
						'label'      => __( 'Border Radius', 'elaet' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'condition' => [
							'cf7_form_submit_message_border!' => 'none',
							'cf7_valid_border_size!' => '',
						],
						'selectors'  => [
							'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-validation-errors, {{WRAPPER}} .elaet-cf7-container div.wpcf7-mail-sent-ng, {{WRAPPER}} .elaet-cf7-container .wpcf7-acceptance-missing' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'cf7_valid_message_padding',
					[
						'label'      => __( 'Message Padding', 'elaet' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors'  => [
							'{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-validation-errors, {{WRAPPER}} .elaet-cf7-container div.wpcf7-mail-sent-ng, {{WRAPPER}} .elaet-cf7-container .wpcf7-acceptance-missing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'     => 'cf7_validation_typo',
						'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
						'selector' => '{{WRAPPER}} .elaet-cf7-container .wpcf7 .wpcf7-validation-errors, {{WRAPPER}} .elaet-cf7-container div.wpcf7-mail-sent-ng,{{WRAPPER}} .elaet-cf7-container .wpcf7-mail-sent-ok,{{WRAPPER}} .elaet-cf7-container .wpcf7-acceptance-missing',
					]
				);

		$this->end_controls_section();

	}

	
	function elaet_query_posts($post_type, $posts_to_show){
		if ( class_exists( 'WPCF7_ContactForm' ) ) {
 		$args = array(
		  'numberposts' => $posts_to_show,
		  'post_type'   => $post_type
		);
 
		$posts = get_posts( $args );		
		$list = array();
		foreach ($posts as $cpost){
		//	print_r($cf7_form);
			$list[$cpost->ID] = $cpost->post_title;
		}
		return $list;
	}
}
	
	protected function render(){
		$settings = $this->get_settings();
		
		if ( !class_exists( 'WPCF7_ContactForm' ) ) {
			?>
	<div class="cf-seven-install">
		<?php _e( 'Please install and activate Contact Form 7.', 'elaet' );  ?>
	</div>
	<?php	}else{
		
		$html = '';
  		if ( 0 == $settings['cf7_form'] ) {
			$html = __( '<div class="cf-seven-choose">'.'Please select a Contact Form 7.'.'</div>', 'elaet' );
			} else {
		if ( $settings['cf7_custom_radio_checkbox'] == 'yes' ) {
         $cf7_custom_radio_check_class = ' elaet-custom-radio-checkbox';
     }
				?>
<div id="elaet-cf7-<?php echo $this->get_id(); ?>" class="elaet-cf7-container <?php echo $cf7_custom_radio_check_class; ?>">	
				<?php
					if ( $settings['cf7_form'] ) {
						echo do_shortcode( '[contact-form-7 id="'.$settings['cf7_form'].'"]' );
					}
				?>				
</div>
			<?php
		}
		echo $html;
	}
 }

}

Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Cf_Seven() );
