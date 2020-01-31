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
use Elementor\Group_Control_Text_Shadow;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Counter Widget Class
 */
class Elaet_Counter extends Widget_Base {
	
	/**
	 * Retrieve Counter Widget Name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'elaet-counter';
	}

	/**
	 * Retrieve Counter Widget Title.
	 *
	 * @access public
	 *
	 * @return string Widget Title.
	 */
	public function get_title() {
		return esc_html__( 'Elite Counter', 'elaet' );
	}

	/**
	 * Retrieve Counter Widget Icon.
	 *
	 * @access public
	 *
	 * @return string Widget Icon.
	 */
	public function get_icon() {
		return 'eicon-clock';
	}

	/**
	 * Retrieve Counter Widget Keywords.
	 *
	 * @access public
	 *
	 * @return string Widget Keywords.
	 */
	public function get_keywords() {
		return [ 'count', 'counter'];
	}

	/**
	 * Retrieve Counter Widget Category.
	 *
	 * @access public
	 *
	 * @return string Widget Category.
	 */
	public function get_categories() {
		return [ 'elaet-category' ];
	}


	/**
	 * Register Counter Widget controls.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

	$this->counter_general_controls();    
	
    $this->counter_general_style_controls();  
	$this->counter_title_style_controls();
	$this->counter_number_style_controls();
	$this->counter_prefix_suffix_style_controls();
	$this->counter_icon_style_controls();
}

	protected function counter_general_controls() {

		$this->start_controls_section(
			'general_settings_section',
			[
				'label' => __( 'General Settings', 'elaet' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'counter_title', [
				'label' => __( 'Counter Title', 'elaet' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
                'description' => __('Leave blank to hide.', 'elaet'),
			]
		);

        $this->add_control(
            'counter_start_number', [
                'label' => __( 'Counter Start Number', 'elaet' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 0
            ]
        );

        $this->add_control(
            'counter_end_number', [
                'label' => __( 'Counter End Number', 'elaet' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'       => 800
            ]
        );

        $this->add_control(
            'counter_prefix_number', [
                'label' => __( 'Counter Prefix Number', 'elaet' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'counter_suffix_number', [
                'label' => __( 'Counter Suffix Number', 'elaet' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'counter_duration', [
                'label' => __( 'Counter Duration', 'elaet' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'description' => __( 'In Seconds', 'elaet' ),
                'label_block' => false,
                'default'     => 2
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'counter_layout', [
                'label'         => __( 'Counter Layout Options', 'elaet' )
            ]
        );

        $this->add_control(
            'counter_icon_type', [
                'label'         => __( 'Icon Type', 'elaet' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'none'  => __('None', 'elaet'),
                    'icon'  => __('Icon', 'elaet'),
                    'image'=> __('Image', 'elaet'),
                ],
                'default'       => 'icon'
            ]
        );

        $this->add_control('counter_icon', [
                'label'         => __( 'Select an Icon', 'elaet' ),
                'type'          => Controls_Manager::ICON,
                'default'       => 'fa fa-clock-o',
                'condition'     => [
                    'counter_icon_type' => 'icon',
                    'counter_icon_type!' => 'none'
                ]
            ]
        );

        $this->add_control('counter_image_icon', [
                'label'         => __( 'Choose Image', 'elaet' ),
                'type'          => Controls_Manager::MEDIA,
                'condition'         => [
                    'counter_icon_type' => 'image',
                    'counter_icon_type!' => 'none'
                ],
                'default'       => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        
        $this->add_control('counter_icon_position', [
                'label'         => __( 'Icon Position', 'elaet' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'top'   => __( 'Top', 'elaet' ),
                    'bottom' => __( 'Bottom', 'elaet' ), 
                ],
                'default'       => 'top',
                'separator'     => 'after'
            ]
        );
        
        $this->add_control(
          'icon_hover_animation',
          [
            'label'   => __( 'Icon Hover Animation', 'elaet' ),
            'type' => Controls_Manager::HOVER_ANIMATION,     
          ]
        );
        
        $this->end_controls_section();
	}

/**
   * Register Counter  General Style Controls.
   *
   * @access protected
   */
  protected function counter_general_style_controls() {
        $this->start_controls_section(
          'counter_general_style_section',
          [
            'label' => __( 'Counter General Style', 'elaet' ),
            'tab'   => Controls_Manager::TAB_STYLE,
          ]
        );


        $this->add_control(
            'elaet_counter_text_background_heading',
            [
                'label'     => __( 'Global Text Settings', 'elaet' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
          'elaet_counter_text_background_type',
          [
            'label'        => __( 'Fill', 'elaet' ),
            'type'         => Controls_Manager::SELECT,
            'description'=> __('Here you can choose to set a color or an image as text background.','elaet'),
            'options'      => [
              'none'    => __( 'None', 'elaet' ),
              'color'    => __( 'Color', 'elaet' ),
              'gradient' => __( 'Background', 'elaet' ),
            ],
            'default'      => 'color',
          ]
        );

        $this->add_control(
            'elaet_counter_text_background',
            [
                'label' => esc_html__( 'Global Text Color', 'elaet' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#23a455',
                'selectors' => [
                    '{{WRAPPER}} .elaet-counter-number, 
                                .elaet-counter-title, 
                                .counter-icon-container .fa, 
                                .counter-prefix-number, 
                                .counter-suffix-number' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'elaet_counter_text_background_type' => 'color',
                ],
            ]
        );

          $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'elaet_counter_text_background_two',
                'label'     => __( 'Digit', 'elaet' ),
                'types'     => [ 'classic', 'gradient' ],
                'default'  => '#ffffff',
                'selector' => '{{WRAPPER}} .elaet-counter-number, 
                                .elaet-counter-title, 
                                .counter-icon-container .fa, 
                                .counter-prefix-number, 
                                .counter-suffix-number',
                'condition'      => [
                    'elaet_counter_text_background_type' => 'gradient',
                ],
            ]
        );

        $this->end_controls_section();
  }

   /**
   * Register Counter Title Style Controls.
   *
   * @access protected
   */
  protected function counter_title_style_controls() {

    $this->start_controls_section(
      'counter_title_style_section',
      [
        'label' => __( 'Counter Title', 'elaet' ),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => [
            'counter_title!' => ''
        ],
      ]
    );

    $this->add_control(
      'title_tag',
      [
        'label'   => __( 'HTML Tag', 'elaet' ),
        'type'    => Controls_Manager::SELECT,
        'options' => [
          'h1' => __( 'H1', 'elaet' ),
          'h2' => __( 'H2', 'elaet' ),
          'h3' => __( 'H3', 'elaet' ),
          'h4' => __( 'H4', 'elaet' ),
          'h5' => __( 'H5', 'elaet' ),
          'h6' => __( 'H6', 'elaet' ),
          'p' => __( 'P', 'elaet' ),
        ],
        'default' => 'h2',
      ]
    );

    $this->add_control(
        'title_color',
        [
            'label' => __( 'Title Color', 'elaet' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#23a455',
            'condition' => [
                    'elaet_counter_text_background_type' => 'none',
            ],
            'selectors' => [
                '{{WRAPPER}} .elaet-counter-title' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'counter_title_typography',
        'selector' => '{{WRAPPER}} .elaet-counter-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      ]
    );

    // Widget Title Box Shadow.
    $this->add_group_control(
      Group_Control_Text_Shadow::get_type(),
      [
        'name'      => 'counter_title_text_shadow',
        'label'     => 'Text Shadow',
        'selector'  => '{{WRAPPER}} .elaet-counter-title',
      ]
    );

    $this->add_responsive_control(
        'counter_title_text_margin',
        [
            'label'         => esc_html__( 'Margin', 'elaet' ),
            'type'          => Controls_Manager::DIMENSIONS,
            'size_units'    => [ 'px', '%', 'em' ],
            'separator'     => 'before',
            'selectors'     => [
                '{{WRAPPER}} .elaet-counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );    

    $this->add_responsive_control(
        'counter_title_text_padding',
        [
            'label'         => esc_html__( 'Padding', 'elaet' ),
            'type'          => Controls_Manager::DIMENSIONS,
            'size_units'    => [ 'px', '%', 'em' ],
            'selectors'     => [
                '{{WRAPPER}} .elaet-counter-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    
    $this->end_controls_section();

  }

   /**
   * Register Counter Number Style Controls.
   *
   * @access protected
   */
  protected function counter_number_style_controls() {

    $this->start_controls_section(
      'counter_number_style_section',
      [
        'label' => __( 'Counter Number Style', 'elaet' ),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
        'counter_number_color',
        [
            'label' => __( 'Color', 'elaet' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#23a455',
            'condition' => [
                    'elaet_counter_text_background_type' => 'none',
            ],
            'selectors' => [
                '{{WRAPPER}} .elaet-counter-number' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'counter_number_typography',
        'selector' => '{{WRAPPER}} .elaet-counter-number',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      ]
    );

    $this->add_group_control(
      Group_Control_Text_Shadow::get_type(),
      [
        'name'      => 'counter_number_text_shadow',
        'label'     => 'Text Shadow',
        'selector'  => '{{WRAPPER}} .elaet-counter-number',
      ]
    );

    $this->add_responsive_control(
        'counter_number_text_margin',
        [
            'label'         => esc_html__( 'Margin', 'elaet' ),
            'type'          => Controls_Manager::DIMENSIONS,
            'size_units'    => [ 'px', '%', 'em' ],
            'separator'     => 'before',
            'selectors'     => [
                '{{WRAPPER}} .elaet-counter-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );    

    $this->add_responsive_control(
        'counter_number_text_padding',
        [
            'label'         => esc_html__( 'Padding', 'elaet' ),
            'type'          => Controls_Manager::DIMENSIONS,
            'size_units'    => [ 'px', '%', 'em' ],
            'selectors'     => [
                '{{WRAPPER}} .elaet-counter-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    
    $this->end_controls_section();

  }

   /**
   * Register Counter Prefix & Suffix Style Controls.
   *
   * @access protected
   */
  protected function counter_prefix_suffix_style_controls() {

    $this->start_controls_section(
      'counter_prefix_suffix_style_section',
      [
        'label' => __( 'Prefix and Suffix', 'elaet' ),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
        'counter_prefix_number_heading',
      [
        'label'     => __( 'Prefix', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'condition' => [
          'counter_prefix_number!' => '',
        ],
      ]
    );

    $this->add_control(
        'counter_prefix_number_color',
        [
            'label' => __( 'Color', 'elaet' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#23a455',
            'selectors' => [
                '{{WRAPPER}} .counter-prefix-number' => 'color: {{VALUE}}',
            ],
            'condition' => [
              'counter_prefix_number!' => '',
              'elaet_counter_text_background_type' => 'none',
            ],
         ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'counter_prefix_number_typography',
        'selector' => '{{WRAPPER}} .counter-prefix-number',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        'condition' => [
          'counter_prefix_number!' => '',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Text_Shadow::get_type(),
      [
        'name'      => 'counter_prefix_number_text_shadow',
        'label'     => 'Text Shadow',
        'selector'  => '{{WRAPPER}} .counter-prefix-number',
        'condition' => [
          'counter_prefix_number!' => '',
        ],
      ]
    );
    
    $this->add_control(
      'counter_suffix_number_heading',
      [
        'label'     => __( 'Suffix', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'counter_suffix_number!' => '',
        ],
      ]
    );

    $this->add_control(
        'counter_suffix_number_color',
        [
            'label' => __( 'Color', 'elaet' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#23a455',
            'selectors' => [
                '{{WRAPPER}} .counter-suffix-number' => 'color: {{VALUE}}',
            ],
            'condition' => [
              'counter_suffix_number!' => '',
              'elaet_counter_text_background_type' => 'none',
            ],
        ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'counter_suffix_number_typography',
        'selector' => '{{WRAPPER}} .counter-suffix-number',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        'condition' => [
          'counter_suffix_number!' => '',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Text_Shadow::get_type(),
      [
        'name'      => 'counter_suffix_number_text_shadow',
        'label'     => 'Text Shadow',
        'separator' => 'after',
        'selector'  => '{{WRAPPER}} .counter-suffix-number',
        'condition' => [
          'counter_suffix_number!' => '',
        ],
      ]
    );

    $this->add_responsive_control(
        'counter_prefix_suffix_number_margin',
        [
            'label'         => esc_html__( 'Margin', 'elaet' ),
            'type'          => Controls_Manager::DIMENSIONS,
            'size_units'    => [ 'px', '%', 'em' ],
            'separator'     => 'before',
            'selectors'     => [
                '{{WRAPPER}} .counter-prefix-number, .counter-suffix-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );    

    $this->add_responsive_control(
        'counter_prefix_suffix_number_padding',
        [
            'label'         => esc_html__( 'Padding', 'elaet' ),
            'type'          => Controls_Manager::DIMENSIONS,
            'size_units'    => [ 'px', '%', 'em' ],
            'selectors'     => [
                '{{WRAPPER}} .counter-prefix-number, .counter-suffix-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();

  }

/**
   * Register Counter Icon Style Controls.
   *
   * @access protected
   */
  protected function counter_icon_style_controls() {

    $this->start_controls_section(
      'counter_icon_style_section',
      [
        'label' => __( 'Counter Icon', 'elaet' ),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
        'counter_icon_icon_color',
        [
            'label' => __( 'Color', 'elaet' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#23a455',
            'selectors' => [
                '{{WRAPPER}} .counter-icon-container i ' => 'color: {{VALUE}}',
            ],
            'condition' => [
              'counter_icon_type' => 'icon',
              'elaet_counter_text_background_type' => 'none',
            ],
        ]
    );

    $this->add_responsive_control(
        'counter_icon_icon_size',
            [
                'label' => __( 'Size', 'elaet' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter-icon-container i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'counter_icon_type' => 'icon',
                ],
            ]
        );
    $this->add_responsive_control(
        'counter_image_icon_size',
            [
                'label' => __( 'Size', 'elaet' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1600,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter-icon-container img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'counter_icon_type' => 'image',
                ],
            ]
        );

    $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'counter_image_icon_border',
                'label' => __( 'Border', 'elaet' ),
                'selector' => '{{WRAPPER}} .counter-icon-container img',
                'condition' => [
                    'counter_icon_type' => 'image',
                ],
            ]
        );
      //Image Border Radius
    $this->add_responsive_control(
        'counter_image_icon_border_radius',
        [
          'label'      => __( 'Border Radius', 'elaet' ),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%' ],
          'selectors'  => [
            '{{WRAPPER}} .counter-icon-container img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],        
        ]
      );

    $this->add_responsive_control(
        'counter_icon_margin',
        [
            'label'         => esc_html__( 'Margin', 'elaet' ),
            'type'          => Controls_Manager::DIMENSIONS,
            'size_units'    => [ 'px', '%', 'em' ],
            'separator'     => 'before',
            'selectors'     => [
                '{{WRAPPER}} .counter-icon-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );    

    $this->add_responsive_control(
        'counter_icon_padding',
        [
            'label'         => esc_html__( 'Padding', 'elaet' ),
            'type'          => Controls_Manager::DIMENSIONS,
            'size_units'    => [ 'px', '%', 'em' ],
            'selectors'     => [
                '{{WRAPPER}} .counter-icon-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();

  }

	protected function render() {
		$settings = $this->get_settings_for_display();
?>   
    <div class="counter-container">
        <?php if ($settings['counter_title'] != ''){ ?>
            <<?php echo $settings['title_tag']; ?> class="elaet-counter-title">
                <?php echo $settings['counter_title']; ?>
            </<?php echo $settings['title_tag']; ?>> 
        <?php } ?>

        <?php if ($settings['counter_icon_type'] != 'none' && $settings['counter_icon_position'] == 'top'){ ?>
            <div class="counter-icon-container elementor-animation-<?php echo $settings['icon_hover_animation'] ?>">
                <?php if ($settings['counter_icon_type'] == 'image'){ ?>
                        <img src="<?php echo $settings['counter_image_icon']['url']; ?>">
                <?php }elseif($settings['counter_icon_type'] == 'icon'){ ?> 
                        <i class="<?php echo esc_attr( $settings['counter_icon'] ); ?>" ></i> 
                <?php } ?> 
            </div>    
        <?php } ?> 

        <div class="counter-wrapper">
            <?php if ($settings['counter_prefix_number']) {  ?>
                <span class="counter-prefix-number">
                    <?php echo $settings['counter_prefix_number'] ?>
                </span>
            <?php } ?>
            <div class="elaet-counter-number" data-start-number="<?php echo $settings['counter_start_number'] ?>" data-duration="<?php echo $settings['counter_duration'] ?>">
                <?php echo $settings['counter_end_number'] ?>
            </div>
            <?php if ($settings['counter_suffix_number']) {  ?>
                <span class="counter-suffix-number">
                    <?php echo $settings['counter_suffix_number'] ?>
                </span>
            <?php } ?>
        </div>

        <?php if ($settings['counter_icon_type'] != 'none' && $settings['counter_icon_position'] == 'bottom'){ ?>
            <div class="counter-icon-container elementor-animation-<?php echo $settings['icon_hover_animation'] ?>">
                <?php if ($settings['counter_icon_type'] == 'image'){ ?>
                        <img src="<?php echo $settings['counter_image_icon']['url']; ?>">
                <?php }elseif($settings['counter_icon_type'] == 'icon'){ ?> 
                        <i class="<?php echo esc_attr( $settings['counter_icon'] ); ?>" ></i> 
                <?php } ?> 
            </div>    
        <?php } ?> 

    </div>    
<?php
	}
	
	protected function _content_template() {}
}


Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Counter() );