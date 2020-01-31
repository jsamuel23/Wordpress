<?php
// namespace Elementor;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Elaet_Countdown_Timer extends Widget_Base {

	public function get_name() {
		return 'elaet-countdown-clock';
	}

	public function get_title() {
		return esc_html__( 'Countdown Clock', 'elaet' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}

   public function get_categories() {
		return [ 'elaet-category' ];
	}

	protected function _register_controls() {

 	$this->countdown_general_controls();
    $this->countdown_content_controls();
    $this->countdown_expire_action_controls();

    $this->countdown_style_controls();
    $this->countdown_individual_box_style_controls();
    $this->countdown_expire_message_style_controls();
	
}

 protected function countdown_general_controls() {
 	$this->start_controls_section(
  			'elaet_section_countdown_settings_general',
  			[
  				'label' => esc_html__( 'Countdown Clock Settings', 'elaet' )
  			]
  		);
		
		$this->add_control(
			'elaet_countdown_due_time',
			[
				'label' => esc_html__( 'Countdown Due Date', 'elaet' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => date("Y-m-d", strtotime("+ 1 day")),
				'description' => esc_html__( 'Set the due date and time', 'elaet' ),
			]
		);

		$this->add_control(
		  'elaet_section_countdown_style',
		  	[
		   	'label'       	=> esc_html__( 'Clock Layout', 'elaet' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'style-1',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'style-1'  	=> esc_html__( 'Layout 1', 'elaet' ),
		     		'style-2' 	=> esc_html__( 'Layout 2', 'elaet' ),
		     	],
		  	]
		);

		$this->add_control(
			'elaet_countdown_label_view',
			[
				'label' => esc_html__( 'Label Position', 'elaet' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'elaet-countdown-label-block',
				'options' => [
					'elaet-countdown-label-block' => esc_html__( 'Block', 'elaet' ),
					'elaet-countdown-label-inline' => esc_html__( 'Inline', 'elaet' ),
				],
			]
		);

		$this->add_responsive_control(
			'elaet_countdown_label_padding_left',
			[
				'label' => esc_html__( 'Left spacing for Labels', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'description' => esc_html__( 'Use when you select inline labels', 'elaet' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-label' => 'padding-left:{{SIZE}}px;',
				],
				'condition' => [
					'elaet_countdown_label_view' => 'elaet-countdown-label-inline',
				],
			]
		);
	$this->end_controls_section();
}

  protected function countdown_content_controls() {

  		$this->start_controls_section(
  			'elaet_section_countdown_settings_content',
  			[
  				'label' => esc_html__( 'Items Settings', 'elaet' )
  			]
  		);

  		$this->add_control(
			'elaet_show_labels',
			[
				'label' => esc_html__( 'Show Labels', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'elaet_countdown_days',
			[
				'label' => esc_html__( 'Show Days', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'elaet_countdown_days_label',
			[
				'label' => esc_html__( 'Label for Days', 'elaet' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Days', 'elaet' ),
				'condition' => [
					'elaet_countdown_days' => 'yes',
					'elaet_show_labels' => 'yes'
				],
			]
		);
		

		$this->add_control(
			'elaet_countdown_hours',
			[
				'label' => esc_html__( 'Show Hours', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'elaet_countdown_hours_label',
			[
				'label' => esc_html__( 'Label for Hours', 'elaet' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Hours', 'elaet' ),
				'condition' => [
					'elaet_countdown_hours' => 'yes',
					'elaet_show_labels' => 'yes'
				],
			]
		);

		$this->add_control(
			'elaet_countdown_minutes',
			[
				'label' => esc_html__( 'Show Minutes', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'elaet_countdown_minutes_label',
			[
				'label' => esc_html__( 'Label for Minutes', 'elaet' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Minutes', 'elaet' ),
				'condition' => [
					'elaet_countdown_minutes' => 'yes',
					'elaet_show_labels' => 'yes'
				],
			]
		);
			
		$this->add_control(
			'elaet_countdown_seconds',
			[
				'label' => esc_html__( 'Show Seconds', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'elaet_countdown_seconds_label',
			[
				'label' => esc_html__( 'Label for Seconds', 'elaet' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Seconds', 'elaet' ),
				'condition' => [
					'elaet_countdown_seconds' => 'yes',
					'elaet_show_labels' => 'yes'
				],
			]
		);

		$this->add_control(
			'elaet_countdown_separator_heading',
			[
				'label' => __( 'Countdown Separator', 'elaet' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'      => [
          			'elaet_countdown_days_text_background_type' => 'color',
          			'elaet_countdown_hours_text_background_type' => 'color',
          			'elaet_countdown_minutes_text_background_type' => 'color',
          			'elaet_countdown_seconds_text_background_type' => 'color',
        		],
			]
		);

		$this->add_control(
			'elaet_countdown_separator',
			[
				'label' => esc_html__( 'Show Separator', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'elaet-countdown-show-separator',
				'default' => '',
				'condition'      => [
          			'elaet_countdown_days_text_background_type' => 'color',
          			'elaet_countdown_hours_text_background_type' => 'color',
          			'elaet_countdown_minutes_text_background_type' => 'color',
          			'elaet_countdown_seconds_text_background_type' => 'color',
        		],
			]
		);

		$this->add_control(
			'separator_value',
			[
				'label' => __( 'Separator Content', 'elaet' ),
				'type' => Controls_Manager::TEXT,
				'default' => ':',
				'condition' => [
					'elaet_countdown_separator' => 'elaet-countdown-show-separator',
					'elaet_countdown_days_text_background_type' => 'color',
          			'elaet_countdown_hours_text_background_type' => 'color',
          			'elaet_countdown_minutes_text_background_type' => 'color',
          			'elaet_countdown_seconds_text_background_type' => 'color',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-show-separator .elaet-countdown-digits:after' => 'content: "{{VALUE}}"',
				],
			]
		);

		$this->add_control(
			'elaet_countdown_separator_color',
			[
				'label' => esc_html__( 'Separator Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'condition' => [
					'elaet_countdown_separator' => 'elaet-countdown-show-separator',
					'elaet_countdown_days_text_background_type' => 'color',
          			'elaet_countdown_hours_text_background_type' => 'color',
          			'elaet_countdown_minutes_text_background_type' => 'color',
          			'elaet_countdown_seconds_text_background_type' => 'color',
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-digits::after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'elaet_countdown_separator_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .elaet-countdown-digits::after',
				'condition' => [
					'elaet_countdown_separator' => 'elaet-countdown-show-separator',
					'elaet_countdown_days_text_background_type' => 'color',
          			'elaet_countdown_hours_text_background_type' => 'color',
          			'elaet_countdown_minutes_text_background_type' => 'color',
          			'elaet_countdown_seconds_text_background_type' => 'color',
				],
			]
		);
		$this->end_controls_section();
}

   protected function countdown_expire_action_controls() {
   		$this->start_controls_section(
			'countdown_on_expire_settings',
			[
				'label' => esc_html__( 'Action After Expire' , 'elaet' )
			]
		);

		$this->add_control(
			'countdown_expire_type',
			[
				'label'			=> esc_html__('Expire Action', 'elaet'),
				'label_block'	=> false,
				'type'			=> Controls_Manager::SELECT,
                'description'   => esc_html__('Choose whether if you want to set a message or a redirect link', 'elaet'),
				'options'		=> [
					'none'		=> esc_html__('None', 'elaet'),
					'text'		=> esc_html__('Message', 'elaet'),
					'url'		=> esc_html__('Redirection Link', 'elaet'),
				],
				'default'		=> 'none'
			]
		);

		$this->add_control(
			'countdown_expiry_text_title',
			[
				'label'			=> esc_html__('On Expiry Title', 'elaet'),
				'type'			=> Controls_Manager::TEXTAREA,
				'default'		=> esc_html__('Time Over','elaet'),
				'condition'		=> [
					'countdown_expire_type' => 'text'
				]
			]
		);

		$this->add_control(
			'countdown_expiry_text',
			[
				'label'			=> esc_html__('On Expiry Content', 'elaet'),
				'type'			=> Controls_Manager::WYSIWYG,
				'default'		=> esc_html__('This is the content to be displayed when the countdown is finished.','elaet'),
				'condition'		=> [
					'countdown_expire_type' => 'text'
				]
			]
		);

		$this->add_control(
			'countdown_expiry_redirection',
			[
				'label'			=> esc_html__('Redirect To (URL)', 'elaet'),
				'type'			=> Controls_Manager::TEXT,
				'condition'		=> [
					'countdown_expire_type' => 'url'
				],
				'default'		=> '#'
			]
		);

		$this->end_controls_section();
 }
		
  		
 protected function countdown_style_controls() {
   		$this->start_controls_section(
			'elaet_section_countdown_styles_general',
			[
				'label' => esc_html__( 'Items Styling', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_responsive_control(
			'elaet_countdown_spacing',
			[
				'label' => esc_html__( 'Space Between Items', 'elaet' ),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'after',
				'default' => [
					'size' => 12,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-item > div' => 'margin-right:{{SIZE}}px; margin-left:{{SIZE}}px;',
				],
				'condition' => [
					'elaet_section_countdown_style' => ['style-1']
				]
			]
		);
	
		$this->add_control(
			'elaet_countdown_items_typo_heading',
			[
				'label' => __( 'Typography', 'elaet' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'elaet_countdown_digit_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .elaet-countdown-digits',
				'label' => 'Digits'
			]
		);

		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'elaet_countdown_label_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .elaet-countdown-label',
				'label' => 'Labels'
			]
		);	

		$this->add_control(
			'elaet_countdown_items_heading',
			[
				'label' => __( 'Item Settings', 'elaet' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->add_responsive_control(
			'elaet_countdown_box_padding',
			[
				'label' => esc_html__( 'Padding', 'elaet' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-item > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elaet_countdown_box_border',
				'label' => esc_html__( 'Border', 'elaet' ),
				'selector' => '{{WRAPPER}} .elaet-countdown-item > div',
			]
		);

		$this->add_responsive_control(
			'elaet_countdown_box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elaet' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-item > div' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'elaet_countdown_box_shadow',
				'selector' => '{{WRAPPER}} .elaet-countdown-item > div',
			]
		);
	$this->end_controls_section();
}


 protected function countdown_individual_box_style_controls() {	

	$this->start_controls_section(
			'elaet_countdown_days_styles_section',
			[
				'label' => esc_html__( 'Days Section', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'elaet_countdown_days' => 'yes',
				],
			]
		);

		$this->add_control(
			'elaet_countdown_days_background_heading',
			[
				'label'		=> __( 'Item Background', 'elaet' ),
				'type'		=> Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'elaet_countdown_days_background',
                'label'     => __( 'Days Background', 'elaet' ),
         		'description'=> __('Here you can choose to set a color or an image as text background.','elaet'),
                'types'     => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elaet-countdown-item > div.elaet-countdown-days',
            ]
        );

	$this->add_control(
			'elaet_countdown_days_digits_background_heading',
			[
				'label'		=> __( 'Text Background', 'elaet' ),
				'type'		=> Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

	$this->add_control(
      'elaet_countdown_days_text_background_type',
      [
        'label'        => __( 'Fill', 'elaet' ),
        'type'         => Controls_Manager::SELECT,
        'description'=> __('Here you can choose to set a color or an image as text background.','elaet'),
        'options'      => [
          'color'    => __( 'Color', 'elaet' ),
          'gradient' => __( 'Background', 'elaet' ),
        ],
        'default'      => 'color',
      ]
    );

		$this->add_control(
			'elaet_countdown_days_digit_color',
			[
				'label' => esc_html__( 'Digit Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-days .elaet-countdown-digits' => 'color: {{VALUE}};',
				],
				'condition' => [
	          		'elaet_countdown_days_text_background_type' => 'color',
	        	],
			]
		);

		  $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'elaet_countdown_days_digits_background',
                'label'     => __( 'Digit', 'elaet' ),
                'types'     => [ 'classic', 'gradient' ],
                'default'  => '#ffffff',
                'selector' => '{{WRAPPER}} .elaet-countdown-days .elaet-countdown-digits,{{WRAPPER}} .elaet-countdown-days .elaet-countdown-label',
                'condition'      => [
          			'elaet_countdown_days_text_background_type' => 'gradient',
        		],
            ]
        );

		$this->add_control(
			'elaet_countdown_days_label_color',
			[
				'label' => esc_html__( 'Label Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-days .elaet-countdown-label' => 'color: {{VALUE}};',
				],
				'condition'      => [
          			'elaet_countdown_days_text_background_type' => 'color',
        		],
			]
		);

		$this->add_control(
			'elaet_countdown_days_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-item > div.elaet-countdown-days' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'elaet_countdown_hours_styles_section',
			[
				'label' => esc_html__( 'Hours Section', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'elaet_countdown_hours' => 'yes',
				],
			]
		);

		$this->add_control(
			'elaet_countdown_hours_background_heading',
			[
				'label'		=> __( 'Item Background', 'elaet' ),
				'type'		=> Controls_Manager::HEADING,
			]
		);

	$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'elaet_countdown_hours_background',
                'label'     => __( 'Background', 'elaet' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elaet-countdown-item > div.elaet-countdown-hours',
            ]
        );

		$this->add_control(
			'elaet_countdown_hours_digits_background_heading',
			[
				'label'		=> __( 'Text Background', 'elaet' ),
				'type'		=> Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

	$this->add_control(
      'elaet_countdown_hours_text_background_type',
      [
        'label'        => __( 'Fill', 'elaet' ),
        'type'         => Controls_Manager::SELECT,
        'description'=> __('Here you can choose to set a color or an image as text background.','elaet'),
        'options'      => [
          'color'    => __( 'Color', 'elaet' ),
          'gradient' => __( 'Background', 'elaet' ),
        ],
        'default'      => 'color',
      ]
    );

		$this->add_control(
			'elaet_countdown_hours_digit_color',
			[
				'label' => esc_html__( 'Digit Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-hours .elaet-countdown-digits' => 'color: {{VALUE}};',
				],
				'condition' => [
	          		'elaet_countdown_hours_text_background_type' => 'color',
	        	],
			]
		);

		$this->add_control(
			'elaet_countdown_hours_label_color',
			[
				'label' => esc_html__( 'Label Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-hours .elaet-countdown-label' => 'color: {{VALUE}};',
				],
				'condition' => [
	          		'elaet_countdown_hours_text_background_type' => 'color',
	        	],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'elaet_countdown_hours_digits_background',
                'label'     => __( 'Digit', 'elaet' ),
                'types'     => [ 'classic', 'gradient' ],
                'default'  => '#ffffff',
                'selector' => '{{WRAPPER}} .elaet-countdown-hours .elaet-countdown-digits,{{WRAPPER}} .elaet-countdown-hours .elaet-countdown-label',
                'condition'      => [
          			'elaet_countdown_hours_text_background_type' => 'gradient',
        		],
            ]
        );

		$this->add_control(
			'elaet_countdown_hours_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-item > div.elaet-countdown-hours' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'elaet_countdown_minutes_styles_section',
			[
				'label' => esc_html__( 'Minutes Section', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'elaet_countdown_minutes' => 'yes',
				],
			]
		);

		$this->add_control(
			'elaet_countdown_minutes_background_heading',
			[
				'label'		=> __( 'Item Background', 'elaet' ),
				'type'		=> Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'elaet_countdown_minutes_background',
                'label'     => __( 'Background', 'elaet' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elaet-countdown-item > div.elaet-countdown-minutes',
            ]
        );

		$this->add_control(
			'elaet_countdown_minutes_digits_background_heading',
			[
				'label'		=> __( 'Text Background', 'elaet' ),
				'type'		=> Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

	$this->add_control(
      'elaet_countdown_minutes_text_background_type',
      [
        'label'        => __( 'Fill', 'elaet' ),
        'type'         => Controls_Manager::SELECT,
        'description'=> __('Here you can choose to set a color or an image as text background.','elaet'),
        'options'      => [
          'color'    => __( 'Color', 'elaet' ),
          'gradient' => __( 'Background', 'elaet' ),
        ],
        'default'      => 'color',
      ]
    );

		$this->add_control(
			'elaet_countdown_minutes_digit_color',
			[
				'label' => esc_html__( 'Digit Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-minutes .elaet-countdown-digits' => 'color: {{VALUE}};',
				],
				'condition'      => [
          			'elaet_countdown_minutes_text_background_type' => 'color',
        		],
			]
		);

		$this->add_control(
			'elaet_countdown_minutes_label_color',
			[
				'label' => esc_html__( 'Label Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-minutes .elaet-countdown-label' => 'color: {{VALUE}};',
				],
				'condition'      => [
          			'elaet_countdown_minutes_text_background_type' => 'color',
        		],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'elaet_countdown_minutes_digits_background',
                'label'     => __( 'Digit', 'elaet' ),
                'types'     => [ 'classic', 'gradient' ],
                'default'  => '#ffffff',
                'selector' => '{{WRAPPER}} .elaet-countdown-minutes .elaet-countdown-digits,{{WRAPPER}} .elaet-countdown-minutes .elaet-countdown-label',
                'condition'      => [
          			'elaet_countdown_minutes_text_background_type' => 'gradient',
        		],
            ]
        );


		$this->add_control(
			'elaet_countdown_minutes_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elaet' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-item > div.elaet-countdown-minutes' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'elaet_countdown_seconds_styles_section',
			[
				'label' => esc_html__( 'Seconds Section', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'elaet_countdown_seconds' => 'yes',
				],
			]
		);

		$this->add_control(
			'elaet_countdown_seconds_background_heading',
			[
				'label'		=> __( 'Item Background', 'elaet' ),
				'type'		=> Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'elaet_countdown_seconds_background_color',
                'label'     => __( 'Background', 'elaet' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elaet-countdown-item > div.elaet-countdown-seconds',
            ]
        );

		$this->add_control(
			'elaet_countdown_seconds_text_background_heading',
			[
				'label'		=> __( 'Text Background', 'elaet' ),
				'type'		=> Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

	$this->add_control(
      'elaet_countdown_seconds_text_background_type',
      [
        'label'        => __( 'Fill', 'elaet' ),
        'type'         => Controls_Manager::SELECT,
       'description'=> __('Here you can choose to set a color or an image as text background.','elaet'),
        'options'      => [
          'color'    => __( 'Color', 'elaet' ),
          'gradient' => __( 'Background', 'elaet' ),
        ],
        'default'      => 'color',
      ]
    );
		$this->add_control(
			'elaet_countdown_seconds_digit_color',
			[
				'label'		=> esc_html__( 'Digit Color', 'elaet' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-seconds .elaet-countdown-digits' => 'color: {{VALUE}};',
				],
				 'condition'      => [
          			'elaet_countdown_seconds_text_background_type' => 'color',
        		],
			]
		);

		$this->add_control(
			'elaet_countdown_seconds_label_color',
			[
				'label'		=> esc_html__( 'Label Color', 'elaet' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#ffffff',
				'selectors'	=> [
					'{{WRAPPER}} .elaet-countdown-seconds .elaet-countdown-label' => 'color: {{VALUE}};',
				],
				 'condition'      => [
          			'elaet_countdown_seconds_text_background_type' => 'color',
        		],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'elaet_countdown_seconds_text_background',
                'label'     => __( 'Digit', 'elaet' ),
                'types'     => [ 'classic', 'gradient' ],
                'default'  => '#ffffff',
                'selector' => '{{WRAPPER}} .elaet-countdown-seconds .elaet-countdown-digits,{{WRAPPER}} .elaet-countdown-seconds .elaet-countdown-label',
                 'condition'      => [
          			'elaet_countdown_seconds_text_background_type' => 'gradient',
        		],
            ]
        );

	$this->add_control(
			'elaet_countdown_seconds_border_color',
			[
				'label'		=> esc_html__( 'Border Color', 'elaet' ),
				'type'		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .elaet-countdown-item > div.elaet-countdown-seconds' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

}

	 protected function countdown_expire_message_style_controls() {	
		$this->start_controls_section(
			'elaet_section_countdown_expire_style',
			[
				'label'	=> esc_html__( 'Expire Message', 'elaet' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'countdown_expire_type'	=> 'text'
				]
			]
		);

		$this->add_responsive_control(
			'elaet_countdown_expire_message_alignment',
			[
				'label' => esc_html__( 'Text Alignment', 'elaet' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elaet' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elaet' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elaet' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-finish-message' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_elaet_countdown_expire_title',
			[
				'label'		=> __( 'Title Style', 'elaet' ),
				'type'		=> Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

		$this->add_control(
			'elaet_countdown_expire_title_color',
			[
				'label'		=> esc_html__( 'Title Color', 'elaet' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .elaet-countdown-finish-message .expiry-title' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'countdown_expire_type' => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name'			=> 'elaet_countdown_expire_title_typography',
				'scheme'	=> Scheme_Typography::TYPOGRAPHY_2,
				'selector'	=> '{{WRAPPER}} .elaet-countdown-finish-message .expiry-title',
				'condition'	=> [
					'countdown_expire_type' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'elaet_expire_title_margin',
			[
				'label' => esc_html__( 'Margin', 'elaet' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elaet-countdown-finish-message .expiry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'heading_elaet_countdown_expire_message',
			[
				'label'		=> __( 'Content Style', 'elaet' ),
				'type'		=> Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

		$this->add_control(
			'elaet_countdown_expire_message_color',
			[
				'label'		=> esc_html__( 'Text Color', 'elaet' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .elaet-countdown-finish-text' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'countdown_expire_type' => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name'			=> 'elaet_countdown_expire_message_typography',
				'scheme'	=> Scheme_Typography::TYPOGRAPHY_2,
				'selector'	=> '.elaet-countdown-finish-text',
				'condition'	=> [
					'countdown_expire_type' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'elaet_countdown_expire_message_padding',
			[
				'label'			=> esc_html__( 'Padding', 'elaet' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', '%', 'em' ],
				'separator'		=> 'before',
				'selectors'		=> [
					'{{WRAPPER}} .elaet-countdown-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'countdown_expire_type' => 'text',
				],
			]
		);

		$this->end_controls_section();
	}

		protected function render( ) {
		
      $settings = $this->get_settings();
		
		$get_due_date =  esc_attr($settings['elaet_countdown_due_time']);
		$due_date = date("M d Y G:i:s", strtotime($get_due_date));
		if( 'style-1' === $settings['elaet_section_countdown_style'] ) {
			$elaet_countdown_style = 'style-1';
		}elseif( 'style-2' === $settings['elaet_section_countdown_style'] ) {
			$elaet_countdown_style = 'style-2';
		}

	// Countdown text color type
			if($settings['elaet_countdown_days_text_background_type'] == 'color'){
			$countdown_text_color1 = ' countdown-text-color';
		}else{
			$countdown_text_color1 = ' countdown-text-background';
		}

			if($settings['elaet_countdown_hours_text_background_type'] == 'color'){
			$countdown_text_color2 = ' countdown-text-color';
		}else{
			$countdown_text_color2 = ' countdown-text-background';
		}

			if($settings['elaet_countdown_minutes_text_background_type'] == 'color'){
			$countdown_text_color3 = ' countdown-text-color';
		}else{
			$countdown_text_color3 = ' countdown-text-background';
		}

			if($settings['elaet_countdown_seconds_text_background_type'] == 'color'){
			$countdown_text_color4 = ' countdown-text-color';
		}else{
			$countdown_text_color4 = ' countdown-text-background';
		}

		$this->add_render_attribute( 'elaet-countdown', 'class', 'elaet-countdown-wrapper' );
		$this->add_render_attribute( 'elaet-countdown', 'data-countdown-id', esc_attr($this->get_id()) );
		$this->add_render_attribute( 'elaet-countdown', 'data-expire-type', $settings['countdown_expire_type'] );

        if ( $settings['countdown_expire_type'] == 'text' ) {
			if( ! empty($settings['countdown_expiry_text']) ) {
				$this->add_render_attribute( 'elaet-countdown', 'data-expiry-text', wp_kses_post($settings['countdown_expiry_text']) );
			}
			   
			if( ! empty($settings['countdown_expiry_text_title']) ) {
				$this->add_render_attribute('elaet-countdown', 'data-expiry-title', wp_kses_post($settings['countdown_expiry_text_title']) );
			}
        }
        elseif ( $settings['countdown_expire_type'] == 'url' ) {
			$this->add_render_attribute( 'elaet-countdown', 'data-redirect-url', $settings['countdown_expiry_redirection'] );
        }
        else{
           //do nothing
        }

	?>

<div <?php echo $this->get_render_attribute_string( 'elaet-countdown' ); ?>>
  <div class="elaet-countdown-container <?php echo esc_attr($settings['elaet_countdown_separator'] ); ?>">
    <ul id="elaet-countdown-<?php echo esc_attr($this->get_id()); ?>" class="elaet-countdown-items <?php echo esc_attr( $elaet_countdown_style ); ?>" data-date="<?php echo esc_attr($due_date) ; ?>">
      <?php if ( ! empty( $settings['elaet_countdown_days'] ) ){ ?>
     <li class="elaet-countdown-item">
       <div class="elaet-countdown-days <?php echo esc_attr($settings['elaet_countdown_label_view'] ); ?>">
        <span data-days class="elaet-countdown-digits<?php echo $countdown_text_color1; ?>">00</span>
          <?php if ( 'yes' == ( $settings['elaet_show_labels'] ) ){ ?>
          	<span class="elaet-countdown-label<?php echo $countdown_text_color1; ?>"><?php echo esc_attr($settings['elaet_countdown_days_label'] ); ?>
           	</span>
          <?php } ?>
        </div>
      </li>
      <?php } ?>
      <?php if ( ! empty( $settings['elaet_countdown_hours'] ) ){ ?>
      <li class="elaet-countdown-item">
        <div class="elaet-countdown-hours <?php echo esc_attr($settings['elaet_countdown_label_view'] ); ?>"><span data-hours class="elaet-countdown-digits <?php echo $countdown_text_color2; ?>">00</span>
          <?php if ( 'yes' == ( $settings['elaet_show_labels'] ) ){ ?><span class="elaet-countdown-label<?php echo $countdown_text_color2; ?>"><?php echo esc_attr($settings['elaet_countdown_hours_label'] ); ?></span>
          <?php } ?>
        </div>
      </li>
      <?php } ?>
      <?php if ( ! empty( $settings['elaet_countdown_minutes'] ) ){ ?>
      <li class="elaet-countdown-item">
        <div class="elaet-countdown-minutes <?php echo esc_attr($settings['elaet_countdown_label_view'] ); ?>"><span data-minutes class="elaet-countdown-digits <?php echo $countdown_text_color3; ?>">00</span>
          <?php if ( 'yes' == ( $settings['elaet_show_labels'] ) ){ ?><span class="elaet-countdown-label<?php echo $countdown_text_color3; ?>"><?php echo esc_attr($settings['elaet_countdown_minutes_label'] ); ?></span>
          <?php } ?>
        </div>
      </li>
      <?php } ?>
      <?php if ( ! empty( $settings['elaet_countdown_seconds'] ) ){ ?>
      <li class="elaet-countdown-item">
        <div class="elaet-countdown-seconds <?php echo esc_attr($settings['elaet_countdown_label_view'] ); ?>"><span data-seconds class="elaet-countdown-digits <?php echo $countdown_text_color4; ?>">00</span>
          <?php if ( 'yes' == ( $settings['elaet_show_labels'] ) ){ ?><span class="elaet-countdown-label<?php echo $countdown_text_color4; ?>"><?php echo esc_attr($settings['elaet_countdown_seconds_label'] ); ?></span>
          <?php } ?>
        </div>
      </li>
      <?php } ?>
    </ul>
    <div class="clearfix"></div>
  </div>
</div>

	
	<?php
	
	}

	protected function content_template() {
		
		?>
	
		<?php
	}
}
Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Countdown_Timer() );