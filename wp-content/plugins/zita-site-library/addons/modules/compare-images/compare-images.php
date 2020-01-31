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
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Compare Images Widget Class
 */
class Elaet_Compare_Images extends Widget_Base {
	
    /**
	 * Retrieve Compare Images Widget Name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'elaet-compare-images';
	}

    /**
	 * Retrieve Compare Images Widget Title.
	 *
	 * @access public
	 *
	 * @return string Widget Title.
	 */
	public function get_title() {
		return esc_html__( 'Compare Images', 'elaet' );
	}

    /**
	 * Retrieve Compare Images Widget Icon.
	 *
	 * @access public
	 *
	 * @return string Widget Icon.
	 */
	public function get_icon() {
		return 'eicon-image-before-after';
	}

    /**
	 * Retrieve Compare Images Widget Keywords.
	 *
	 * @access public
	 *
	 * @return string Widget Keywords.
	 */
	public function get_keywords() {
		return [ 'compare', 'image', 'image comparison', 'compare images' ];
	}

    /**
	 * Retrieve Compare Images Widget Category.
	 *
	 * @access public
	 *
	 * @return string Widget Category.
	 */
   	public function get_categories() {
		return [ 'elaet-category' ];
	}

		/**
	 * Register Compare Images Widget controls.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

 	$this->compare_images_general_controls();
 	
 	$this->compare_images_general_configuration();
 	$this->compare_images_controller_style();
 	$this->compare_images_label_style();
	
}

	 protected function compare_images_general_controls() {
        
        $this->start_controls_section(
            'section_compare_images_general',
            [
                'label'             => __( 'Images', 'elaet' ),
            ]
        );

        $this->add_control(
			'module_size',
			[
				'label' => __( 'Module Size', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-compare-images' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

	$this->add_responsive_control(
      'compare_images_alignment',
      [
        'label'        => __( 'Overall Alignment', 'elaet' ),
        'type'         => Controls_Manager::CHOOSE,
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
          '{{WRAPPER}} .twentytwenty-wrapper' => 'justify-content: {{VALUE}};',
        ],
      ]
    );


	 	
		$this->add_control(
			'before_image_heading',
			[
				'label'     => __( 'Before Image', 'elaet' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

	 	$this->add_control(
            'before_label',
            [
                'label'             => __( 'Label', 'elaet' ),
                'type'              => Controls_Manager::TEXT,
                'default'           => __( 'Before', 'elaet' ),
            ]
        );

		$this->add_control(
			'before_image',
			[
				'label' => esc_html( 'Image', 'elaet' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'after_image_heading',
			[
				'label'     => __( 'After Image', 'elaet' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);	

		$this->add_control(
            'after_label',
            [
                'label'             => __( 'Label', 'elaet' ),
                'type'              => Controls_Manager::TEXT,
                'default'           => __( 'After', 'elaet' ),
            ]
        );

        $this->add_control(
			'after_image',
			[
				'label' => esc_html( 'Image', 'elaet' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'separator' => 'after',
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->end_controls_section();

	 }

	  	 protected function compare_images_general_configuration() {
	 	$this->start_controls_section(
            'section_image_box_settings',
            [
                'label'             => __( 'Configuration', 'elaet' ),
                'tab'               => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'visible_ratio',
            [
                'label'                 => __( 'Initial Handle Position', 'elaet' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.1,
                    ],
                ],
                'size_units'            => '',
            ]
        );
        
        $this->add_control(
            'orientation',
            [
                'label'                 => __( 'Orientation', 'elaet' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'horizontal',
                'options'               => [
                    'vertical'      => __( 'Vertical', 'elaet' ),
                    'horizontal'    => __( 'Horizontal', 'elaet' ),
                ],
            ]
        );
        
        $this->add_control(
            'move_slider',
            [
                'label'                 => __( 'Move Slider', 'elaet' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'drag',
                'options'               => [
                    'drag'          => __( 'Drag', 'elaet' ),
                    'mouse_move'    => __( 'Mouse Hover', 'elaet' ),
                    'mouse_click'   => __( 'Mouse Click', 'elaet' ),
                ],
            ]
        );
        
       $this->add_control(
		'overlay_heading',
			[
				'label' => __( 'Overlay Settings', 'elaet' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'overlay',
            [
                'label'             => __( 'Overlay', 'elaet' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'yes',
                'label_on'          => __( 'Show', 'elaet' ),
                'label_off'         => __( 'Hide', 'elaet' ),
                'return_value'      => 'yes',
            ]
        );

        $this->start_controls_tabs( 'tabs_overlay_style' );

        $this->start_controls_tab(
            'tab_overlay_normal',
            [
                'label'             => __( 'Normal', 'elaet' ),
            ]
        );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'overlay_background',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .twentytwenty-overlay',
				'condition'         => [
					'overlay'  => 'yes',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_overlay_hover',
            [
                'label'             => __( 'Hover', 'elaet' ),
            ]
        );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'overlay_background_hover',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .twentytwenty-overlay:hover',
				'condition'         => [
					'overlay'  => 'yes',
				],
			]
		);

        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

	}

	protected function compare_images_controller_style() {
		
		$this->start_controls_section(
            'section_handle_style',
            [
                'label'             => __( 'Handle', 'elaet' ),
                'tab'               => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_handle_style' );

        $this->start_controls_tab(
            'tab_handle_normal',
            [
                'label'             => __( 'Handle', 'elaet' ),
            ]
        );

        $this->add_control(
            'handle_icon_color',
            [
                'label'             => __( 'Icon Color', 'elaet' ),
                'type'              => Controls_Manager::COLOR,
                'default'           => '',
                'selectors'         => [
                    '{{WRAPPER}} .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}}',
                    '{{WRAPPER}} .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}}',
                    '{{WRAPPER}} .twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}}',
                    '{{WRAPPER}} .twentytwenty-down-arrow' => 'border-top-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'handle_background',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .twentytwenty-handle',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'              => 'handle_border',
				'label'             => __( 'Border', 'elaet' ),
				'placeholder'       => '1px',
				'default'           => '1px',
				'selector'          => '{{WRAPPER}} .twentytwenty-handle',
				'separator'         => 'before',
			]
		);

		$this->add_control(
			'handle_border_radius',
			[
				'label'             => __( 'Border Radius', 'elaet' ),
				'type'              => Controls_Manager::DIMENSIONS,
				'size_units'        => [ 'px', '%' ],
				'selectors'         => [
					'{{WRAPPER}} .twentytwenty-handle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'handle_box_shadow',
				'selector'              => '{{WRAPPER}} .twentytwenty-handle',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_handle_hover',
            [
                'label'             => __( 'Separator', 'elaet' ),
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label'             => __( 'Color', 'elaet' ),
                'type'              => Controls_Manager::COLOR,
                'default'           => '',
                'selectors'         => [
                    '{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'background: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
			'separator_width',
			[
				'label'             => __( 'Width', 'elaet' ),
				'type'              => Controls_Manager::SLIDER,
				'default'           => [
                    'size' => 3,
                    'unit' => 'px',
                ],
				'size_units'        => [ 'px', '%' ],
				'range'             => [
					'px' => [
						'max' => 20,
					],
				],
				'tablet_default'    => [
					'unit' => 'px',
				],
				'mobile_default'    => [
					'unit' => 'px',
				],
				'selectors'         => [
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => 'width: {{SIZE}}{{UNIT}}; margin-left: calc(-{{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle::before' => 'height: {{SIZE}}{{UNIT}}; margin-top:calc( -{{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle::after' => 'height: {{SIZE}}{{UNIT}}; margin-top:calc( -{{SIZE}}{{UNIT}}/2 );',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();
	}

	protected function compare_images_label_style() {
		
		$this->start_controls_section(
            'section_label_style',
            [
                'label'             => __( 'Before/After Label', 'elaet' ),
                'tab'               => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
			'label_horizontal_position',
			[
				'label'                 => __( 'Position', 'elaet' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'default'               => 'top',
				'options'               => [
					'top'          => [
						'title'    => __( 'Top', 'elaet' ),
						'icon'     => 'eicon-v-align-top',
					],
					'middle'       => [
						'title'    => __( 'Middle', 'elaet' ),
						'icon'     => 'eicon-v-align-middle',
					],
					'bottom'       => [
						'title'    => __( 'Bottom', 'elaet' ),
						'icon'     => 'eicon-v-align-bottom',
					],
				],
				'prefix_class'          => 'elaet-ic-label-horizontal-',
				'condition'             => [
					'orientation'  => 'horizontal',
				],
			]
		);
        
        $this->add_control(
			'label_vertical_position',
			[
				'label'                 => __( 'Position', 'elaet' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'elaet' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'           => [
						'title' => __( 'Center', 'elaet' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'            => [
						'title' => __( 'Right', 'elaet' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'               => 'center',
				'prefix_class'  => 'elaet-ic-label-vertical-',
				'condition'             => [
					'orientation'  => 'vertical',
				],
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'              => 'label_typography',
                'label'             => __( 'Typography', 'elaet' ),
                'scheme'            => Scheme_Typography::TYPOGRAPHY_4,
                'selector'          => '{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before',
            ]
        );

		$this->add_responsive_control(
			'label_padding',
			[
				'label'             => __( 'Padding', 'elaet' ),
				'type'              => Controls_Manager::DIMENSIONS,
				'size_units'        => [ 'px', 'em', '%' ],
				'selectors'         => [
					'{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'         => 'after',
			]
		);
        
        $this->start_controls_tabs( 'tabs_label_style' );

        $this->start_controls_tab(
            'tab_label_before',
            [
                'label'             => __( 'Before', 'elaet' ),
            ]
        );

        $this->add_control(
            'label_text_color_before',
            [
                'label'             => __( 'Text Color', 'elaet' ),
                'type'              => Controls_Manager::COLOR,
                'default'           => '',
                'selectors'         => [
                    '{{WRAPPER}} .twentytwenty-before-label:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'label_bg_color_before',
            [
                'label'             => __( 'Background Color', 'elaet' ),
                'type'              => Controls_Manager::COLOR,
                'default'           => '',
                'selectors'         => [
                    '{{WRAPPER}} .twentytwenty-before-label:before' => 'background: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'              => 'label_border',
				'label'             => __( 'Border', 'elaet' ),
				'placeholder'       => '1px',
				'default'           => '1px',
				'selector'          => '{{WRAPPER}} .twentytwenty-before-label:before',
			]
		);

		$this->add_control(
			'label_border_radius',
			[
				'label'             => __( 'Border Radius', 'elaet' ),
				'type'              => Controls_Manager::DIMENSIONS,
				'size_units'        => [ 'px', '%' ],
				'selectors'         => [
					'{{WRAPPER}} .twentytwenty-before-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_label_after',
            [
                'label'             => __( 'After', 'elaet' ),
            ]
        );

        $this->add_control(
            'label_text_color_after',
            [
                'label'             => __( 'Text Color', 'elaet' ),
                'type'              => Controls_Manager::COLOR,
                'default'           => '',
                'selectors'         => [
                    '{{WRAPPER}} .twentytwenty-after-label:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'label_bg_color_after',
            [
                'label'             => __( 'Background Color', 'elaet' ),
                'type'              => Controls_Manager::COLOR,
                'default'           => '',
                'selectors'         => [
                    '{{WRAPPER}} .twentytwenty-after-label:before' => 'background: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'              => 'label_border_after',
				'label'             => __( 'Border', 'elaet' ),
				'placeholder'       => '1px',
				'default'           => '1px',
				'selector'          => '{{WRAPPER}} .twentytwenty-after-label:before',
			]
		);

		$this->add_control(
			'label_border_radius_after',
			[
				'label'             => __( 'Border Radius', 'elaet' ),
				'type'              => Controls_Manager::DIMENSIONS,
				'size_units'        => [ 'px', '%' ],
				'selectors'         => [
					'{{WRAPPER}} .twentytwenty-after-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
		$this->end_controls_section();
 }

 	protected function render() {
		$settings = $this->get_settings_for_display();

        $visible_ratio = ( $settings['visible_ratio']['size'] != '' ? $settings['visible_ratio']['size'] : '0.5' );
        $orientation   = ( $settings['orientation'] != '' ? $settings['orientation'] : 'vertical' );
        $before_label  = ( $settings['before_label'] != '' ? esc_attr( $settings['before_label'] ) : '');
        $after_label   = ( $settings['after_label'] != '' ? esc_attr( $settings['after_label'] ) : '' );
        $slider_on_hover = ( $settings['move_slider'] == 'mouse_move' ? true : false );
        $slider_with_handle = ( $settings['move_slider'] == 'drag' ? true : false );
        $slider_with_click = ( $settings['move_slider'] == 'mouse_click' ? true : false );
        $no_overlay = ( $settings['overlay'] == 'yes' ? false : true );
        
?>
	<div class="twentytwenty-container elaet-compare-images" data-offset='<?php echo $visible_ratio; ?>' data-orientation='<?php echo $orientation; ?>' data-before-label='<?php echo $before_label; ?>' data-after-label='<?php echo $after_label; ?>' data-hover-slider='<?php echo $slider_on_hover; ?>' data-handle-slider='<?php echo $slider_with_handle; ?>' data-click-slider='<?php echo $slider_with_click; ?>' data-overlay='<?php echo $no_overlay; ?>'>
<?php
	if ( ! empty( $settings['before_image']['url'] ) ){
		echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings,'before_image' );
	}
	
	if ( ! empty( $settings['after_image']['url'] ) ){
		echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings,'after_image' );
	}
?>
	</div>
<?php
}

protected function _content_template() {
				
	}

 }

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Compare_Images() );