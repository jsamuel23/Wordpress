<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 

/**
 * Elementor Image Pointer
 *
 * @since 1.0.0
 */
class Elaet_Icon_List_Widget extends Widget_Base {


  
/**
   * Get widget name.
   *
   * Retrieve zita Image Pointer widget name.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'elite_icon_list';
  }

  /**
   * Get widget title.
   *
   * Retrieve zita hedaing widget title.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget title.
   */
  public function get_title() {
    return __( ' Elite Icon List', 'elaet' );
  }

  /**
   * Get widget icon.
   *
   * Retrieve zita pointer widget icon.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget icon.
   */
  public function get_icon() {
    return 'fa fa-th-list';
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

  // public function is_reload_preview_required() {
  //       return true;
  //   }

	protected function _register_controls() {

			$this->register_general_controls();

    		$this->register_list_style_controls();
    		$this->register_list_icon_style_controls();
    		$this->register_list_image_icon_style_controls();
    		$this->register_list_text_style_controls();
	}

 /**
   * Register Icon List General Controls.
   *
   * @access protected
   */
  protected function register_general_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon List', 'elaet' ),
			]
		);

		$this->add_control(
			'list_view',
			[
				'label' => __( 'Layout', 'elaet' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'block',
				'options' => [
					'block' => [
						'title' => __( 'Default', 'elaet' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'inline' => [
						'title' => __( 'Inline', 'elaet' ),
						'icon' => 'eicon-form-vertical',
					],
				],
			]
		);

	$this->add_control(
      'list_items_heading',
      [
        'label'     => __( 'List Items', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => __( 'Text', 'elaet' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'New List Item', 'elaet' ),
				'default' => __( 'New List Item', 'elaet' ),
			]
		);

		$repeater->add_control(
			'icon_type',
			[
				'label' => __( 'Icon Type', 'elaet' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon'  => __( 'Icon', 'elaet' ),
					'image' => __( 'Image', 'elaet' ),
				],
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'elaet' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'fa fa-envira',
				'condition' => [
					'icon_type' => 'icon',
				],
			]
		);

		$repeater->add_control(
			'icon_image',
			[
				'label' => __( 'Choose Image', 'elaet' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'elaet' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'https://your-link.com', 'elaet' ),
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => __( 'First Item', 'elaet' ),
						'icon' => 'fa fa-chevron-circle-right',
					],
					[
						'text' => __( 'Second Item', 'elaet' ),
						'icon' => 'fa fa-arrow-right',
					],
					[
						'text' => __( 'Third Item', 'elaet' ),
						'icon' => 'fa fa-bell',
					],
				],
				'title_field' => '<i class="{{ icon }}" aria-hidden="true"></i> {{{ text }}}',
			]
		);

		$this->end_controls_section();
		
	}

 /**
   * Register list Style Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_list_style_controls() {

  	$this->start_controls_section(
			'section_icon_list',
			[
				'label' => __( 'List', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
  	$this->add_control(
      'list_spacing_heading',
      [
        'label'     => __( 'Spacing', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

		
		$this->add_responsive_control(
			'space_icon_text',
			[
				'label' => __( 'Between Icon &amp; Text', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 60,
					],
				],
				'default' =>[
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space_list_item',
			[
				'label' => __( 'Between List Item', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 60,
					],
				],
				'default' =>[
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-items:not(.elaet-inline-items) .elaet-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elaet-icon-list-items:not(.elaet-inline-items) .elaet-icon-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elaet-icon-list-items.elaet-inline-items .elaet-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elaet-icon-list-items.elaet-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
				],
			]
		);

	$this->add_responsive_control(
			'space_list_border',
			[
				'label' => __( 'Between Item &amp; Border', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 6,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'condition' => [
					'list_view' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-text' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
      'list_item_align',
      [
        'label'          => __( 'List Item Alignment', 'elaet' ),
        'type'           => Controls_Manager::CHOOSE,
        'options'        => [
          'flex-start'    => [
            'title' => __( 'Left', 'elaet' ),
            'icon'  => 'fa fa-align-left',
          ],
          'center'  => [
            'title' => __( 'Center', 'elaet' ),
            'icon'  => 'fa fa-align-center',
          ],
          'flex-end'   => [
            'title' => __( 'Right', 'elaet' ),
            'icon'  => 'fa fa-align-right',
          ],
        ],
        'default'        => 'flex-start',
        'tablet_default' => 'center',
        'mobile_default' => 'center',
       'selectors'      => [
         '{{WRAPPER}} span.elaet-list-item-wrapper' => 'justify-content: {{VALUE}};',
        ],
      ]
    );

		$this->add_control(
      'list_divider_heading',
      [
        'label'     => __( 'Divider', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

		$this->add_control(
			'list_item_divider',
			[
				'label' => __( 'Show Divider', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'elaet' ),
				'label_on' => __( 'On', 'elaet' ),
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-items:not(.elaet-inline-items) .elaet-icon-list-item:not(:last-child):after' => 'content: ""',
				],
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => __( 'Style', 'elaet' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'Solid', 'elaet' ),
					'double' => __( 'Double', 'elaet' ),
					'dotted' => __( 'Dotted', 'elaet' ),
					'dashed' => __( 'Dashed', 'elaet' ),
				],
				'default' => 'solid',
				'condition' => [
					'list_item_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-items:not(.elaet-inline-items) .elaet-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}; border-bottom: none;border-left: none;border-right: none;',
					'{{WRAPPER}} .elaet-icon-list-items:not(.elaet-inline-items) .elaet-icon-list-item:last-child:after' => 'border: none',
					'{{WRAPPER}} .elaet-icon-list-items.elaet-inline-items .elaet-icon-list-item.elaet-inline-item:not(:last-child) span.span-elaet-list-divider' => 'border-left-style: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'divider_weight',
			[
				'label' => __( 'Thickness', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 2,
				],
				'range' => [
					'px' => [
						'max'  => 20,
						'step' => 0.1,
					],
				],
				'condition' => [
					'list_item_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-items:not(.elaet-inline-items) .elaet-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .elaet-icon-list-item.elaet-inline-item:not(:last-child) span.span-elaet-list-divider' => 'border-left-width: {{SIZE}}{{UNIT}}',

				],
			]
		);

		$this->add_responsive_control(
			'divider_width',
			[
				'label' => __( 'Width', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'condition' => [
					'list_item_divider' => 'yes',
					'list_view!' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-items:not(.elaet-inline-items) .elaet-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .elaet-icon-list-item.elaet-inline-item:not(:last-child) span.span-elaet-list-divider' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'block_divider_margin',
			[
				'label' => __( 'Margin', 'elaet' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'unit' => '%',
				],
				'condition' => [
					'list_item_divider' => 'yes',
					'list_view!' => 'inline',
				],
			'selectors'  => [
            	'{{WRAPPER}} .elaet-icon-list-items:not(.elaet-inline-items) .elaet-icon-list-item:not(:last-child):after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => __( 'Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#848484',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'list_item_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-items:not(.elaet-inline-items) .elaet-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .elaet-icon-list-item.elaet-inline-item:not(:last-child) span.span-elaet-list-divider' => 'border-left-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
  }
  /**
   * Register List Icon Style Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_list_icon_style_controls() {

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => __( 'Icon', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
      'list_items_bg_heading',
      [
        'label'     => __( 'Icon Background', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

		$this->add_responsive_control(
			'icon_bg_height',
			[
				'label' => __( 'Height', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 6,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_bg_width',
			[
				'label' => __( 'Width', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 6,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
        'icon_bg_padding',
        [
          'label'      => __( 'Padding', 'elaet' ),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px' ],
          'default'    => [
            'top'    => '0',
            'bottom' => '0',
            'left'   => '0',
            'right'  => '0',
            'unit'   => 'px',
          ],
          'selectors'  => [
            '{{WRAPPER}} .elaet-icon-list-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );

		$this->add_control(
        'icon_bg_border_radius',
        [
          'label'      => __( 'Border Radius', 'elaet' ),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px' ],
          'default'    => [
            'top'    => '50',
            'bottom' => '50',
            'left'   => '50',
            'right'  => '50',
            'unit'   => 'px',
          ],
          'selectors'  => [
            '{{WRAPPER}} .elaet-icon-list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );


		$this->start_controls_tabs(
			'icon_style_tabs'
		);

		$this->start_controls_tab(
			'icon_normal_tab',
			[
				'label' => __( 'Normal', 'elaet' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#343f7a',
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-icon i' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Icon Background Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover_tab',
			[
				'label' => __( 'Hover', 'elaet' ),
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Icon Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-item:hover .elaet-icon-list-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color_hover',
			[
				'label' => __( 'Icon Background Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-item:hover .elaet-icon-list-icon' =>'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
  }
   /**
   * Register List Image Icon Style Controls.
   *
   * @since 0.0.1
   * @access protected
   */

    protected function register_list_image_icon_style_controls() {

    	$this->start_controls_section(
			'section_image_icon_style',
			[
				'label' => __( 'List Item Image', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

	$this->add_control(
      'image_dimensions_heading',
      [
        'label'     => __( 'Image Dimensions', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
      ]
    );

		$this->add_responsive_control(
			'image_icon_width',
			[
				'label' => __( 'Image Width', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
					'unit'   => 'px',
				],
				'range'     => [
		          'px' => [
		            'min' => 20,
		            'max' => 200,
		          ],
       		 ],
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-image-icon img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

	$this->add_control(
      'image_advanced_settings',
      [
        'label'        => __( 'Change Height', 'elaet' ),
        'type'         => Controls_Manager::SWITCHER,
        'label_on'     => __( 'Yes', 'elaet' ),
        'label_off'    => __( 'No', 'elaet' ),
        'return_value' => 'yes',
        'default'      => 'no',
      ]
    );

		$this->add_responsive_control(
			'image_icon_height',
			[
				'label' => __( 'Image Height', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'range'     => [
		          'px' => [
		            'min' => 20,
		            'max' => 200,
		          ],
       		 ],
       		 'condition' => [
					'image_advanced_settings' => 'yes',
			],
			'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-image-icon img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

	$this->add_control(
      'image_border_heading',
      [
        'label'     => __( 'Border', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

	$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_image_border',
				'label' => __( 'Border', 'elaet' ),
				'selector' => '{{WRAPPER}} .elaet-icon-list-image-icon img',
			]
		);

		$this->add_control(
        'image_icon_bg_border_radius',
        [
          'label'      => __( 'Border Radius', 'elaet' ),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px' ],
          'default'    => [
            'top'    => '0',
            'bottom' => '0',
            'left'   => '0',
            'right'  => '0',
            'unit'   => 'px',
          ],
          'selectors'  => [
            '{{WRAPPER}} .elaet-icon-list-image-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
           ],
        ]
      );

		$this->end_controls_section();

    }

   /**
   * Register List Text Style Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_list_text_style_controls() {

  			$this->start_controls_section(
			'section_text_style',
			[
				'label' => __( 'Text', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-text' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'Hover', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elaet-icon-list-item:hover .elaet-icon-list-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .elaet-icon-list-item',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
  }

	/**
	 * Render icon list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'icon_list_container', 'class', 'elaet-icon-list-container' );
		$this->add_render_attribute( 'icon_list', 'class', 'elaet-icon-list-items' );
		$this->add_render_attribute( 'list_item', 'class', 'elaet-icon-list-item' );

		if ( 'inline' === $settings['list_view'] ) {
			$this->add_render_attribute( 'icon_list', 'class', 'elaet-inline-items' );
			$this->add_render_attribute( 'list_item', 'class', 'elaet-inline-item' );
		}
		?>
	<div <?php echo $this->get_render_attribute_string( 'icon_list_container' ); ?>>
		<ul <?php echo $this->get_render_attribute_string( 'icon_list' ); ?> style="margin: 0">
			<?php
			foreach ( $settings['icon_list'] as $index => $item ) :
				$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );

				$this->add_render_attribute( $repeater_setting_key, 'class', 'elaet-icon-list-text' );

				$this->add_inline_editing_attributes( $repeater_setting_key );
				?>
			<li <?php echo $this->get_render_attribute_string( 'list_item' ); ?> >
					<?php
					if ( ! empty( $item['link']['url'] ) ) {
						$link_key = 'link_' . $index;

						$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

						if ( $item['link']['is_external'] ) {
							$this->add_render_attribute( $link_key, 'target', '_blank' );
						}

						if ( $item['link']['nofollow'] ) {
							$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
						}

						echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
					}  ?>
			<span class="elaet-list-item-wrapper">
					<span class="elaet-list-icon-wrapper"> 
					<?php
if ( ! empty( $item['icon']) && $item['icon_type'] == 'icon' ){
						?>
						<span class="elaet-icon-list-icon">
							<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
						</span>
<?php }elseif( ! empty( $item['icon_image']['url']) && $item['icon_type'] == 'image' ){ ?>
	<span class="elaet-icon-list-image-icon">
		<?php echo '<img src="' . $item['icon_image']['url'] . '">'; ?>
	</span>
<?php  } ?>
					</span>
			<span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>><?php echo $item['text']; ?></span>
					<?php if ( ! empty( $item['link']['url'] ) ) : ?>
						</a>
					<?php endif; ?>

<?php if ('yes' == $settings['list_item_divider'] && 'inline' == $settings['list_view']) {  
					echo '<span class="span-elaet-list-divider">'.'&nbsp;'.'</span>';
				 } ?>
		</span>
				</li>
				
				<?php
			endforeach;
			?>
		</ul>
	</div>
		<?php
	}

	/**
	 * Render icon list widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<#
			view.addRenderAttribute( 'icon_list', 'class', 'elaet-icon-list-items' );
			view.addRenderAttribute( 'list_item', 'class', 'elaet-icon-list-item' );

			if ( 'inline' == settings.list_view ) {
				view.addRenderAttribute( 'icon_list', 'class', 'elaet-inline-items' );
				view.addRenderAttribute( 'list_item', 'class', 'elaet-inline-item' );
			}
		#>
		<# if ( settings.icon_list ) { #>
			<ul {{{ view.getRenderAttributeString( 'icon_list' ) }}} style="margin: 0">
			<# _.each( settings.icon_list, function( item, index ) {

					var iconTextKey = view.getRepeaterSettingKey( 'text', 'icon_list', index );

					view.addRenderAttribute( iconTextKey, 'class', 'elaet-icon-list-text' );

					view.addInlineEditingAttributes( iconTextKey ); #>

					<li {{{ view.getRenderAttributeString( 'list_item' ) }}} style="">
						<# if ( item.link && item.link.url ) { #>
							<a href="{{ item.link.url }}">
						<# } #>
			<span class="elaet-list-item-wrapper">
					<span class="elaet-list-icon-wrapper"> 
						<# if ( item.icon && 'icon' == item.icon_type) { #>
						<span class="elaet-icon-list-icon">
							<i class="{{ item.icon }}" aria-hidden="true"></i>
						</span>
				<# }else if ( item.icon_image.url && 'image' == item.icon_type ) { #>
						<span class="elaet-icon-list-image-icon">
							<img src="{{ item.icon_image.url }}">
						</span>
						<# } #>
					</span>
						<span {{{ view.getRenderAttributeString( iconTextKey ) }}}>{{{ item.text }}}</span>
						<# if ( item.link && item.link.url ) { #>
							</a>
						<# } #>
				
				<# if ('inline' == settings.list_view && 'yes' == settings.list_item_divider  ) { #>
							<span class="span-elaet-list-divider">&nbsp;</span>
						<# } #>
			</span>
					</li>
					
				<#
				} ); #>
			</ul>
		<#	} #>

		<?php
	}
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Icon_List_Widget() );
