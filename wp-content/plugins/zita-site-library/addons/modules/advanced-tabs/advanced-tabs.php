<?php
// namespace Elementor;

//Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Repeater;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Advanced Tabs Widget Class
 */
class Elaet_Advanced_Tabs extends Widget_Base {
	
	/**
	 * Retrieve Advanced Tabs Widget Name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'elaet-advanced-tabs';
	}

	/**
	 * Retrieve Advanced Tabs Widget Title.
	 *
	 * @access public
	 *
	 * @return string Widget Title.
	 */
	public function get_title() {
		return esc_html__( 'Advanced Tabs', 'elaet' );
	}

	/**
	 * Retrieve Advanced Tabs Widget Icon.
	 *
	 * @access public
	 *
	 * @return string Widget Icon.
	 */
	public function get_icon() {
		return 'eicon-tabs';
	}

	/**
	 * Retrieve Advanced Tabs Widget Keywords.
	 *
	 * @access public
	 *
	 * @return string Widget Keywords.
	 */
	public function get_keywords() {
		return [ 'tabs', 'tab', 'advanced tabs'];
	}

	/**
	 * Retrieve Advanced Tabs Widget Category.
	 *
	 * @access public
	 *
	 * @return string Widget Category.
	 */
	public function get_categories() {
		return [ 'elaet-category' ];
	}

	function elaet_get_page_templates(){
		$page_templates = get_posts( array(
			'post_type'         => 'elementor_library',
			'posts_per_page'    => -1
		)); 

		$options = array();

		if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
			foreach ( $page_templates as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}
		}
		return $options;
	}


	/**
	 * Register Advanced Tabs Widget controls.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

	$this->advanced_tabs_general_controls();    
	
	$this->advanced_tabs_general_style();
	$this->advanced_tab_title_style();
	$this->advanced_tabs_content_style();
	$this->advanced_tabs_pointer_triangle_style();
}

	protected function advanced_tabs_general_controls() {

		$this->start_controls_section(
			'general_settings_section',
			[
				'label' => __( 'General Settings', 'elaet' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tabs_layout',
			[
				'label' => __( 'Tabs Layout', 'elaet' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal'  => __( 'Horizontal', 'elaet' ),
					'vertical'  => __( 'Vertical', 'elaet' ),
				],
			]
		);

		$this->add_control(
			'default_active_tab_index', [
				'label' => __( 'Default Active Tab Index', 'elaet' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 1,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'advanced_tab_title', [
				'label' => __( 'Tab Title', 'elaet' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'elaet' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_icon_type',
			[
				'label' => __( 'Tab Icon', 'elaet' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'none'  => __( 'None', 'elaet' ),
					'icon'  => __( 'Icon', 'elaet' ),
					'image' => __( 'Images', 'elaet' ),
				],
			]
		);

		$repeater->add_control(
	      'tab_icon',
	      [
	        'label'   => __( 'Tab Icon', 'elaet' ),
	        'type'    => Controls_Manager::ICON,
	        'default' => 'fa fa-arrow-circle-right',
	        'condition' => [
	        	'tab_icon_type' => 'icon',
	        ],
	      ]
	    );

	    $repeater->add_control(
			'tab_image_icon',
			[
				'label' => __( 'Choose Image', 'elaet' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tab_icon_type' => 'image',
				],
			]
		);

		$repeater->add_control(
			'content_type',
			[
				'label' => __( 'Content Type', 'elaet' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'content',
				'options' => [
					'content'  => __( 'Content', 'elaet' ),
					'elementor_templates' => __( 'Elementor Templates', 'elaet' ),
				],
			]
		);

		$repeater->add_control(
			'advanced_tab_content', [
				'label' => __( 'Tab Content', 'elaet' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Tab content. Click the edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eu elit nec lectus laoreet volutpat quis non erat. Proin eu arcu libero. Maecenas a pretium felis. Cras eget fermentum lacus, aliquam facilisis mi. Duis luctus dolor in arcu imperdiet, quis malesuada justo rutrum.' , 'elaet' ),
				'show_label' => true,
				'condition' => [
					'content_type' => 'content'
				]
			]
		);

		$repeater->add_control(
			'elaet_elementor_templates',
					[
						'label' => __('Choose Template', 'elaet'),
						'type' => Controls_Manager::SELECT,
						'options' => $this->elaet_get_page_templates(),
						'condition' => [
							'content_type' => 'elementor_templates',
						],
					]
			);
			 
		$this->add_control(
			'advanced_tab_items',
			[
				'label' => __( 'Repeater List', 'elaet' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'advanced_tab_title' => __( 'Tab #1', 'elaet' ),
						'advanced_tab_content' => __( 'Tab content. Click the edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eu elit nec lectus laoreet volutpat quis non erat. Proin eu arcu libero. Maecenas a pretium felis. Cras eget fermentum lacus, aliquam facilisis mi. Duis luctus dolor in arcu imperdiet, quis malesuada justo rutrum.', 'elaet' ),
					],
					[
						'advanced_tab_title' => __( 'Tab #2', 'elaet' ),
						'advanced_tab_content' => __( 'Tab content. Click the edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eu elit nec lectus laoreet volutpat quis non erat. Proin eu arcu libero. Maecenas a pretium felis. Cras eget fermentum lacus, aliquam facilisis mi. Duis luctus dolor in arcu imperdiet, quis malesuada justo rutrum.', 'elaet' ),
					],
				],
				'title_field' => '{{{ advanced_tab_title }}}',
			]
		);

		$this->end_controls_section();

	}

	protected function advanced_tabs_general_style() {

		$this->start_controls_section(
			'elaet_advanced_tabs_general_style_section',
			[
				'label' => __( 'General Style', 'elaet' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elaet_advanced_tabs_border',
				'label' => __( 'Border', 'elaet' ),
				'selector' => '{{WRAPPER}} .elaet-advanced-tabs',
			]
		);

		$this->add_responsive_control(
            'elaet_advanced_tabs_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elaet'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elaet-advanced-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'elaet_adv_tabs_padding',
            [
                'label' => esc_html__('Padding', 'elaet'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elaet-advanced-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'elaet_adv_tabs_margin',
            [
                'label' => esc_html__('Margin', 'elaet'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elaet-advanced-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'elaet_advanced_tabs_box_shadow',
                'selector' => '{{WRAPPER}} .elaet-advanced-tabs',
            ]
        );

		$this->end_controls_section();

	}

	protected function advanced_tab_title_style(){

		$this->start_controls_section(
            'elaet_adv_tabs_title_style',
            [
                'label' => esc_html__('Tabs Title', 'elaet'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
          'elaet_adv_tabs_title_align',
          [
            'label'        => __( 'Overall Alignment', 'elaet' ),
            'type'         => Controls_Manager::CHOOSE,
            'options'      => [
              'flex-start'   => [
                'title' => __( 'Left', 'elaet' ),
                'icon'  => 'eicon-h-align-left',
              ],
              'center' => [
                'title' => __( 'Center', 'elaet' ),
                'icon'  => 'eicon-h-align-center',
              ],
              'flex-end'  => [
                'title' => __( 'Right', 'elaet' ),
                'icon'  => 'eicon-h-align-right',
              ],
            ],
            'condition' => [
                    'tabs_layout' => 'horizontal',
            ],
            'selectors'    => [
              '{{WRAPPER}} .elaet-advanced-tabs.horizontal .tab-links' => 'align-self: {{VALUE}};',
            ],
          ]
        );

    $this->add_responsive_control(
      'tabs_text_align',
      [
        'label'        => __( 'Title Text Alignment', 'elaet' ),
        'type'         => Controls_Manager::CHOOSE,
        'separator'    => 'after',
        'options'      => [
          'flex-start'   => [
            'title' => __( 'Left', 'elaet' ),
            'icon'  => 'fa fa-align-left',
          ],
          'center' => [
            'title' => __( 'Center', 'elaet' ),
            'icon'  => 'fa fa-align-center',
          ],
          'flex-end'  => [
            'title' => __( 'Right', 'elaet' ),
            'icon'  => 'fa fa-align-right',
          ],
        ],
        'selectors'    => [
          '{{WRAPPER}} .tab-links .tab-link' => 'justify-content: {{VALUE}};',
        ],
      ]
    );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'elaet_adv_tabs_tab_title_typography',
                'selector' => '{{WRAPPER}} .elaet-tab-title-text',
            ]
        );

        $this->add_responsive_control(
            'elaet_adv_vertical_tabs_title_width',
            [
                'label' => __('Tab Min Width', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                   '{{WRAPPER}} .elaet-advanced-tabs.vertical .tab-links' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tabs_layout' => 'vertical',
                ],
            ]
        );

        $this->add_responsive_control(
            'elaet_adv_horizontal_tabs_title_width',
            [
                'label' => __('Tab Min Width', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                   '{{WRAPPER}} .elaet-advanced-tabs.horizontal .tab-links li' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tabs_layout' => 'horizontal',
                ],
            ]
        );

        $this->add_responsive_control(
            'elaet_adv_tabs_tab_icon_size',
            [
                'label' => __('Icon Size', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elaet-tab-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elaet-tab-image-icon img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'elaet_adv_tabs_tab_icon_gap',
            [
                'label' => __('Icon Gap', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elaet-tab-icon, {{WRAPPER}} .elaet-tab-image-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'elaet_adv_tabs_tab_padding',
            [
                'label' => esc_html__('Padding', 'elaet'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-links .tab-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'elaet_adv_tabs_tab_margin',
            [
                'label' => esc_html__('Margin', 'elaet'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-links li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('elaet_adv_tabs_header_tabs');

        // Active State Tab
        $this->start_controls_tab(
            'elaet_adv_tabs_header_active', 
            ['label' => esc_html__('Active', 'elaet')]
        );

        $this->add_control(
            'elaet_adv_tabs_tab_color_active',
            [
                'label' => esc_html__('Tab Background Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .active .tab-link' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .elaet-advanced-tabs.vertical .tab-links li.active:after,
                    {{WRAPPER}} .elaet-advanced-tabs.horizontal .tab-links li.active:after' => 'background: {{VALUE}};',
                 ],
            ]
        );
        $this->add_control(
            'elaet_adv_tabs_tab_text_color_active',
            [
                'label' => esc_html__('Text Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .active .tab-link' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'elaet_adv_tabs_tab_icon_color_active',
            [
                'label' => esc_html__('Icon Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .active .tab-link .elaet-tab-icon' => 'color: {{VALUE}};',
                 ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'elaet_adv_tabs_tab_border_active',
                'label' => esc_html__('Border', 'elaet'),
                'selector' => '{{WRAPPER}} .tab-links .active .tab-link',
            ]
        );
        $this->add_responsive_control(
            'elaet_adv_tabs_tab_border_radius_active',
            [
                'label' => esc_html__('Border Radius', 'elaet'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-links .active .tab-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        // Normal State Tab
        $this->start_controls_tab('elaet_adv_tabs_header_normal', 
        	[
        		'label' => esc_html__('Inactive', 'elaet')
        	]
        );

        $this->add_control(
            'elaet_adv_tabs_tab_color',
            [
                'label' => esc_html__('Tab Background Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f1f1f1',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .tab-link' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'elaet_adv_tabs_tab_text_color',
            [
                'label' => esc_html__('Text Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .tab-link' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'elaet_adv_tabs_tab_icon_color',
            [
                'label' => esc_html__('Icon Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .tab-link .elaet-tab-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'elaet_adv_tabs_tab_border',
                'label' => esc_html__('Border', 'elaet'),
                'selector' => '{{WRAPPER}} .tab-links .tab-link',
            ]
        );
        $this->add_responsive_control(
            'elaet_adv_tabs_tab_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elaet'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-links .tab-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
       
        // Hover State Tab

        $this->start_controls_tab('elaet_adv_tabs_header_hover', 
        	['label' => esc_html__('Hover', 'elaet')]
        );

        $this->add_control(
         'elaet_active_adv_tabs_color_hover_heading',
         [
             'label' => __( 'Active Tab', 'elaet' ),
             'type' => Controls_Manager::HEADING,          
         ]
        );

        $this->add_control(
            'elaet_adv_tabs_active_tab_color_hover',
            [
                'label' => esc_html__('Background Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .active .tab-link:hover,
                    {{WRAPPER}} .elaet-advanced-tabs.vertical .tab-links li.active:hover::after,
                     {{WRAPPER}} .elaet-advanced-tabs.horizontal .tab-links li.active:hover::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'elaet_adv_tabs_active_tab_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .active .tab-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_control(
            'elaet_adv_tabs_active_tab_icon_color_hover',
            [
                'label' => esc_html__('Icon Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .active .tab-link:hover .elaet-tab-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
         'elaet_inactive_adv_tabs_color_hover_heading',
         [
             'label' => __( 'Inactive Tab', 'elaet' ),
             'type' => Controls_Manager::HEADING,
             'separator' => 'before',            
         ]
        );

        $this->add_control(
            'elaet_adv_tabs_tab_color_hover',
            [
                'label' => esc_html__('Background Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#d6d6d6',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .tab-link:hover' => 'background: {{VALUE}};',
                ],
            ]

        );

        $this->add_control(
            'elaet_adv_tabs_tab_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .tab-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'elaet_adv_tabs_tab_icon_color_hover',
            [
                'label' => esc_html__('Icon Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .tab-links .tab-link:hover .elaet-tab-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
	}

	protected function advanced_tabs_content_style() {

		$this->start_controls_section(
            'elaet_adv_tabs_content_style_section',
            [
                'label' => esc_html__('Tabs Content', 'elaet'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
          'elaet_adv_tabs_content_align',
          [
            'label'        => __( 'Overall Alignment', 'elaet' ),
            'type'         => Controls_Manager::CHOOSE,
            'options'      => [
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
              'justify'  => [
                'title' => __( 'Justify', 'elaet' ),
                'icon'  => 'fa fa-align-justify',
              ],
            ],
            'selectors'    => [
              '{{WRAPPER}} .tabs-content' => 'text-align: {{VALUE}};',
            ],
          ]
        );

        $this->add_control(
            'elaet_adv_tabs_content_bg_color',
            [
                'label' => esc_html__('Background Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tabs-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'elaet_adv_tabs_content_text_color',
            [
                'label' => esc_html__('Text Color', 'elaet'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .tabs-content .tab' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'elaet_adv_tabs_content_typography',
                'selector' => '{{WRAPPER}} .tabs-content .tab',
            ]
        );
        $this->add_responsive_control(
            'elaet_adv_tabs_content_padding',
            [
                'label' => esc_html__('Padding', 'elaet'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tabs-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'elaet_adv_tabs_content_margin',
            [
                'label' => esc_html__('Margin', 'elaet'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tabs-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'elaet_adv_tabs_content_border',
                'label' => esc_html__('Border', 'elaet'),
                'selector' => '{{WRAPPER}} .tabs-content .tab',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'elaet_adv_tabs_content_shadow',
                'selector' => '{{WRAPPER}} .tabs-content .tab',
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
	}

	protected function advanced_tabs_pointer_triangle_style() {

		$this->start_controls_section(
            'elaet_adv_tabs_pointer_triangle_section',
            [
                'label' => esc_html__('Pointer Triangle', 'elaet'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'elaet_adv_tabs_triangle_show',
            [
                'label' => esc_html__('Show Triangle on Active Tab', 'elaet'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
			'horizontal_triangle_dimensions_heading',
			[
				'label' => __( 'Horizontal Triangle Settings', 'elaet' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
                    'elaet_adv_tabs_triangle_show' => 'yes',
                    'tabs_layout' => 'horizontal',
                ],
			]
		);

        $this->add_responsive_control(
            'elaet_adv_tabs_horizontal_triangle_width',
            [
                'label' => esc_html__('Triangle Width', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 25,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elaet-advanced-tabs.horizontal .tab-links li.active:after' => 'width: {{SIZE}}px;',
                ],
                'condition' => [
                    'elaet_adv_tabs_triangle_show' => 'yes',
                    'tabs_layout' => 'horizontal',
                ],
            ]
        );

        $this->add_responsive_control(
            'elaet_adv_tabs_horizontal_triangle_height',
            [
                'label' => esc_html__('Triangle Height', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 25,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elaet-advanced-tabs.horizontal .tab-links li.active:after' => 'height:{{SIZE}}px',
                ],
                'condition' => [
                    'elaet_adv_tabs_triangle_show' => 'yes',
                    'tabs_layout' => 'horizontal',
                ],
            ]
        );

        $this->add_responsive_control(
            'elaet_adv_tabs_horizontal_triangle_top_distance',
            [
                'label' => esc_html__('Top Distance', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elaet-advanced-tabs.horizontal .tab-links li.active:after' => 'top: {{SIZE}}%;',
                ],
                'condition' => [
                    'elaet_adv_tabs_triangle_show' => 'yes',
                    'tabs_layout' => 'horizontal',
                ],
            ]
        );

        $this->add_responsive_control(
            'elaet_adv_tabs_horizontal_triangle_left_distance',
            [
                'label' => esc_html__('Left Distance', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 33,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elaet-advanced-tabs.horizontal .tab-links li.active:after' => 'left: {{SIZE}}%;',
                ],
                'condition' => [
                    'elaet_adv_tabs_triangle_show' => 'yes',
                    'tabs_layout' => 'horizontal',
                ],
            ]
        );

        $this->add_control(
			'vertical_triangle_dimensions_heading',
			[
				'label' => __( 'Vertical Triangle Settings', 'elaet' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                    'elaet_adv_tabs_triangle_show' => 'yes',
                    'tabs_layout' => 'vertical',
                ],				
			]
		);

        $this->add_responsive_control(
            'elaet_adv_tabs_vertical_triangle_width',
            [
                'label' => esc_html__('Triangle Width', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elaet-advanced-tabs.vertical .tab-links li.active:after' => 'width: {{SIZE}}px;',
                ],
                'condition' => [
                    'elaet_adv_tabs_triangle_show' => 'yes',
                    'tabs_layout' => 'vertical',
                ],
            ]
        );

        $this->add_responsive_control(
            'elaet_adv_tabs_vertical_triangle_height',
            [
                'label' => esc_html__('Triangle Height', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 25,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elaet-advanced-tabs.vertical .tab-links li.active:after' => 'height:{{SIZE}}px',
                ],
                'condition' => [
                    'elaet_adv_tabs_triangle_show' => 'yes',
                    'tabs_layout' => 'vertical',
                ],
            ]
        );

        $this->add_responsive_control(
            'elaet_adv_tabs_vertical_triangle_top_distance',
            [
                'label' => esc_html__('Top Distance', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 22,
                    'unit' => '%'
                ],
                'range' => [
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elaet-advanced-tabs.vertical .tab-links li.active:after' => 'top: {{SIZE}}%;',
                ],
                'condition' => [
                    'elaet_adv_tabs_triangle_show' => 'yes',
                    'tabs_layout' => 'vertical',
                ],
            ]
        );

        $this->add_responsive_control(
            'elaet_adv_tabs_vertical_triangle_left_distance',
            [
                'label' => esc_html__('Left Distance', 'elaet'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elaet-advanced-tabs.vertical .tab-links li.active:after' => 'left: {{SIZE}}%;',
                ],
                'condition' => [
                    'elaet_adv_tabs_triangle_show' => 'yes',
                    'tabs_layout' => 'vertical',
                ],
            ]
        );


        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['advanced_tab_items'] ) { 
				$tabs_layout = ($settings['tabs_layout'] === 'vertical') ? 'vertical' : 'horizontal';
			?>
			<div class="elaet-advanced-tabs <?php echo $tabs_layout; ?>" data-default-tab="<?php echo $settings['default_active_tab_index']; ?>">   
				<?php $show_triangle = ($settings['elaet_adv_tabs_triangle_show'] === 'yes') ? ' triangle' : ''; ?>
				<ul class='tab-links<?php echo $show_triangle; ?>'>
					<?php foreach (  $settings['advanced_tab_items'] as $key => $item ) { 
					$tabCount = $key + 1; 
					?>          
						<li data-tab="<?php echo $tabCount; ?>" >
							<a class="tab-link" href="#tab-<?php echo $item['_id']; ?>"> 
							<?php 
								if ( ! empty( $item['tab_icon']) && $item['tab_icon_type'] == 'icon' ){
							?>
							<span class="elaet-tab-icon">
								<i class="<?php echo esc_attr( $item['tab_icon'] ); ?>" aria-hidden="true">
								</i>
							</span>
							<?php }elseif( ! empty( $item['tab_image_icon']['url']) && $item['tab_icon_type'] == 'image' ){ ?>
							<span class="elaet-tab-image-icon">
								<?php echo '<img src="' . $item['tab_image_icon']['url'] . '">'; ?>
							</span>
							<?php  } ?>
								<span class="elaet-tab-title-text"><?php echo $item['advanced_tab_title']; ?></span>
							</a>
						</li>
					<?php } ?>
				</ul>
				<div class="tabs-content">
					<?php foreach (  $settings['advanced_tab_items'] as $key => $item ) { 
						$tabCount = $key + 1;
					?>                  
						<div id="tab-<?php echo $item['_id']; ?>" class="tab elementor-repeater-item-<?php echo $item['_id']; ?>" data-tab="<?php echo $tabCount; ?>">
							<?php 
		 						if($item['content_type'] === 'content'){            
		         					echo $item['advanced_tab_content'] ;
		 						}else{
		         					echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $item['elaet_elementor_templates'] );
								}
							?>
						</div> 
					<?php 	} ?>
				</div>
			</div>  
		<?php           
		}
	}
	
	protected function _content_template() {}
}


Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Advanced_Tabs() );