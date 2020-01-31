<?php
//namespace Elementor;

// Elementor Classes.
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

/**
 * Zita Elementor Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elaet_Image_Widget extends Widget_Base {

  /**
   * Get widget name.
   *
   * Retrieve zita image overlay widget name.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'Image_Animation';
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
    return __( 'Image Animation', 'elaet' );
  }

  /**
   * Get widget icon.
   *
   * Retrieve zita heading widget icon.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget icon.
   */
  public function get_icon() {
    return 'fa fa-picture-o';
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
   * Register zita controls widget controls.
   *
   * Adds different input fields to allow the user to change and customize the widget settings.
   *
   * @since 1.0.0
   * @access protected
   */
  protected function _register_controls() {
    $this->register_image_content_controls();
    $this->register_general_control();
    $this->register_image_hover_content_controls();
    $this->register_heading_style_content_controls();
    $this->register_caption_style_content_controls();
    $this->register_button_style_content_controls();
  }

 protected function register_image_content_controls() {

     $this->start_controls_section(
          'section_image_head',
          [
            'label' => __( 'Image', 'elaet' ),
          ]
        );

    $this->add_control(
          'image_url',
          [
             'label' => __( 'Choose Image', 'elaet' ),
             'type' => Controls_Manager::MEDIA,
             'show_external' => true,
             'show_label' => false,
              'label_block' => true,
             'default' => [
                'url' => Utils::get_placeholder_image_src(),
             ],
             'dynamic'   => [
          'active' => true,
        ],
          ]
        );

    $this->add_group_control(
      Group_Control_Image_Size::get_type(),
      [
        'name'     => 'thumbnail',
        'default' => 'large',
      ]
    );

    $this->add_responsive_control(
      'heading_text_align',
      [
        'label'        => __( 'Image Alignment', 'elaet' ),
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
        ],
        'selectors'    => [
          '{{WRAPPER}} .elaet-image-module' => 'text-align: {{VALUE}};',
        ],
      ]
    );

    $this->end_controls_section();
    
  }
  
/**
   * Register Advanced Heading Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_general_control(){
     $this->start_controls_section(
          'section_general',
          [
            'label' => __( 'Image Effect', 'elaet' ),
          ]
        );

    $this->add_control(
    'image_effect',
    [
       'label'       => __( 'Image Filter', 'elaet' ),
       'type' => Controls_Manager::SELECT,
       'default' => 'none',
       'options' => [
        'none'  => __( 'None', 'elaet' ),
        'blur'  => __( 'Blur', 'elaet' ),
        'sepia' => __( 'Sepia', 'elaet' ),
        'grayscale' => __( 'Grayscale', 'elaet' ),
        'grayscale-reverse' => __( 'Grayscale Reverse', 'elaet' ),
       ],
    ]
  );

    $this->add_control(
    'image_hover',
    [
       'label'       => __( 'Image Hover Effect', 'elaet' ),
       'type' => Controls_Manager::SELECT,
       'default'  => 'zoomin',
       'options'  => [
        'none'    => __( 'None', 'elaet' ),
        'zoomin'  => __( 'zoomIn', 'elaet' ),
        'zoomout' => __( 'zoomOut', 'elaet' ),
        'glow'    => __( 'Glow', 'elaet' ),
        'shine'   => __( 'Shine', 'elaet' ),
        'rotate'  => __( 'Rotate', 'elaet' ),
       ],
    ]
  );
    $this->add_control(
    'image_overlay',
    [
       'label'       => __( 'Image Overlay', 'elaet' ),
       'type' => Controls_Manager::SELECT,
       'default' => 'partial-overlay',
       'options' => [
        'none'             => __( 'None', 'elaet' ),
        'fade-in'          => __( 'fadeIn', 'elaet' ),
        'fadeInUp'         => __( 'fadeInUp', 'elaet' ),
        'fadeInDown'       => __( 'fadeInDown', 'elaet' ),
        'fadeInLeft'       => __( 'fadeInLeft', 'elaet' ),
        'fadeInRight'      => __( 'fadeInRight', 'elaet' ),
        'flip-horizontal'  => __( 'Flip Horizontal', 'elaet' ),
        'flip-vertical'    => __( 'Flip Vertical', 'elaet' ),
        'partial-overlay'  => __( 'Partial Overlay', 'elaet' ),
        'zoomInUp'         => __( 'zoomInUp', 'elaet' ),
        'zoomInDown'       => __( 'zoomInDown', 'elaet' ),
        'zoomInRight'      => __( 'zoomInRight', 'elaet' ),
        'zoomInLeft'       => __( 'zoomInLeft', 'elaet' ),
       ],
    ]
  );



    $this->end_controls_section();

  }
/**
   * Register Advanced Devider Controls.
   *
   * @since 0.0.1
   * @access protected
   */
 
  protected function register_image_hover_content_controls(){

    $this->start_controls_section(
          'section_hover_image',
          [
            'label' => __( 'Image Overlay', 'elaet' ),
          ]
        );

    $this->start_controls_tabs( 'image_overlay_tab' );

      $this->start_controls_tab(
        'image_content',
        [
          'label'     => __( 'Content', 'elaet' ),
        ]
      );

     $this->add_control(
      'heading_hover_title',
      [
        'label'   => __( 'Heading', 'elaet' ),
        'type'    => Controls_Manager::TEXT,
        'default' => __( 'This is the heading', 'elaet' ),
      ]
    );

      $this->add_control(
        'image_hover_subheading',
        [
           'label'       => __( 'Image Caption', 'elaet' ),
           'type'        => Controls_Manager::TEXTAREA,
           'default'     => __('Click to change description.','elaet'),
           'rows'    => '1',
        'dynamic' => [
          'active' => true,
        ],
         ]
      );

      $this->add_control(
      'image_hover_button_txt',
      [
         'label'       => __( 'Button Text', 'elaet' ),
          'default'     => __('BUTTON','elaet'),
         'type'        => Controls_Manager::TEXT,
       ]
    );

   $this->add_control(
      'image_hover_btn_url',
      [
        'label'       => __( 'Link', 'elaet' ),
        'type'        => Controls_Manager::URL,
        'placeholder' => __( 'https://url.com', 'elaet' ),
        'dynamic'     => [
          'active' => true,
        ],
        'default'     => [
          'url' => '',
        ],
      ]
    );
$this->end_controls_tab();

      $this->start_controls_tab(
        'overlay_color_tab',
        [
          'label'     => __( 'Color', 'elaet' ),
        ]
      );

   $this->add_control(
      'overlay_color',
      [
        'label'     => __( 'Overlay Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'   =>'rgba(35,164,85,0.5)',
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-image-color-overlay' => 'background-color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
          'overlay_image',
          [
             'label' => __( 'Image', 'elaet' ),
             'type' => Controls_Manager::MEDIA,
             'show_external' => true,
             'show_label' => false,
              'label_block' => true,
             'default' => [
                'url' => '',
             ],
             'selectors' => [
          '{{WRAPPER}} .image-pro-overlay' => 'background-image: url({{URL}});',
        ],
          ]
        );
    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->end_controls_section();

  }

  /**
   * Register Image style Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_heading_style_content_controls() {
    $this->start_controls_section(
      'section_heading_typography',
      [
        'label' => __( 'Heading', 'elaet' ),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_control(
      'heading_tag',
      [
        'label'   => __( 'HTML Tag', 'elaet' ),
        'type'    => Controls_Manager::SELECT,
        'options' => [
          'h1' =>   __( 'H1', 'elaet' ),
          'h2' =>   __( 'H2', 'elaet' ),
          'h3' =>   __( 'H3', 'elaet' ),
          'h4' =>   __( 'H4', 'elaet' ),
          'h5' =>   __( 'H5', 'elaet' ),
          'h6' =>   __( 'H6', 'elaet' ),
          'p' =>    __( 'P', 'elaet' ),
          'span' => __( 'SPAN', 'elaet' ),
        ],
        'default' => 'h4',
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'heading_typography',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .elaet-image-caption-title, {{WRAPPER}} .elaet-image-title',
      ]
    );

    $this->add_control(
      'heading_color',
      [
        'label'     => __( 'Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'default'  => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .elaet-image-caption-title, {{WRAPPER}} .elaet-image-title' => 'color: {{VALUE}};',
        ],
      ]
    );
    $this->add_group_control(
      Group_Control_Text_Shadow::get_type(),
      [
        'name'     => 'heading_shadow',
        'selector' => '{{WRAPPER}} .elaet-image-caption-title, {{WRAPPER}} .elaet-image-title',
      ]
    );
    $this->add_control(
      'heading_margin',
      [
        'label'      => __( 'Heading Margin', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '0',
          'bottom'   => '15',
          'left'     => '0',
          'right'    => '0',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-image-caption-title, {{WRAPPER}} .elaet-image-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],

      ]
    );
    $this->end_controls_section();
  }

/**
   * Register Image Caption Typography Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_caption_style_content_controls() {
    $this->start_controls_section(
      'section_caption_typography',
      [
        'label' => __( 'Image Caption', 'elaet' ),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'caption_typography',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .elaet-image-caption-desc, {{WRAPPER}} .elaet-image-caption',
      ]
    );

    $this->add_control(
      'caption_color',
      [
        'label'     => __( 'Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'default'  => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .elaet-image-caption-desc, {{WRAPPER}} .elaet-image-caption' => 'color: {{VALUE}};',
        ],
      ]
    );
    $this->add_group_control(
      Group_Control_Text_Shadow::get_type(),
      [
        'name'     => 'caption_shadow',
        'selector' => '{{WRAPPER}} .elaet-image-caption-desc, {{WRAPPER}} .elaet-image-caption',
      ]
    );
    $this->add_control(
      'caption_margin',
      [
        'label'      => __( 'Image Caption Margin', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '0',
          'bottom'   => '20',
          'left'     => '0',
          'right'    => '0',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-image-caption-desc, {{WRAPPER}} .elaet-image-caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],

      ]
    );
    $this->end_controls_section();
  }

/**
   * Register Image Button Typography Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_button_style_content_controls() {
    $this->start_controls_section(
      'section_button_typography',
      [
        'label' => __( 'Image Button', 'elaet' ),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'button_typography',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .elaet-image-action-button, {{WRAPPER}} .elaet-image-caption-button',
      ]
    );

    $this->start_controls_tabs( 'button_style_tab' );

      $this->start_controls_tab(
        'button_normal',
        [
          'label'     => __( 'Normal', 'elaet' ),
        ]
      );

    $this->add_control(
      'button_color',
      [
        'label'     => __( 'Button Text Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'default'  => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .elaet-image-action-button, {{WRAPPER}} .elaet-image-caption-button' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'button_bg',
      [
        'label'     => __( 'Button Background Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'default'  => '#232323',
        'selectors' => [
          '{{WRAPPER}} .elaet-image-action-button, {{WRAPPER}} .elaet-image-caption-button' => 'background: {{VALUE}};',
        ],
      ]
    );
    $this->add_control(
      'button_border_separtor',
      [
        'label'     => __( 'Button Border Style', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_control(
      'button_type',
      [
        'label'       => __( 'Button Type', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'none',
        'label_block' => false,
        'options'     => [
          'none' => __( 'None', 'elaet' ),
          'solid' => __( 'Solid', 'elaet' ),
          'double' => __( 'Double', 'elaet' ),
          'dotted' => __( 'Dotted', 'elaet' ),
          'dashed' => __( 'Dashed', 'elaet' ),
          'groove' => __( 'Groove', 'elaet' ),
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-image-action-button, {{WRAPPER}} .elaet-image-caption-button' => 'border-style: {{VALUE}};',
        ],
      ]
    );

  $this->add_control(
      'button_border_color',
      [
        'label'     => __( 'Border Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-image-action-button, {{WRAPPER}} .elaet-image-caption-button' => 'border-color: {{VALUE}};',
        ],
         'condition'   => [
          'button_type!' => 'none',
        ],
      ]
    );

    $this->add_control(
      'button_border_width',
      [
        'label'      => __( 'Border Width', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '2',
          'bottom'   => '2',
          'left'     => '2',
          'right'    => '2',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-image-action-button, {{WRAPPER}} .elaet-image-caption-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
         'condition'   => [
          'button_type!' => 'none',
        ],

      ]
    );

    $this->add_control(
      'button_radius',
      [
        'label'      => __( 'Border Radius', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '2',
          'bottom'   => '2',
          'left'     => '2',
          'right'    => '2',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-image-action-button, {{WRAPPER}} .elaet-image-caption-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
         'condition'   => [
          'button_type!' => 'none',
        ],

      ]
    );


    $this->add_control(
      'button_padding',
      [
        'label'      => __( 'Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '5',
          'bottom'   => '5',
          'left'     => '20',
          'right'    => '20',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-image-action-button, {{WRAPPER}} .elaet-image-caption-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],

      ]
    );
      $this->end_controls_tab();

      $this->start_controls_tab(
        'button_hover',
        [
          'label'     => __( 'Hover', 'elaet' ),
        ]
      );
      $this->add_control(
      'button_hover_color',
      [
        'label'     => __( 'Button Text Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'default'  => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .elaet-image-action-button:hover, {{WRAPPER}} .elaet-image-caption-button:hover' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'button_hover_bg',
      [
        'label'     => __( 'Button Background Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'default' => '#3d3d3d',
        'selectors' => [
          '{{WRAPPER}} .elaet-image-action-button:hover, {{WRAPPER}} .elaet-image-caption-button:hover' => 'background: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'button_hover_separtor',
      [
        'label'     => __( 'Button Border Style', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_control(
      'button_hover_type',
      [
        'label'       => __( 'Button Type', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'none',
        'label_block' => false,
        'options'     => [
          'none' => __( 'None', 'elaet' ),
          'solid' => __( 'Solid', 'elaet' ),
          'double' => __( 'Double', 'elaet' ),
          'dotted' => __( 'Dotted', 'elaet' ),
          'dashed' => __( 'Dashed', 'elaet' ),
          'groove' => __( 'Groove', 'elaet' ),
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-image-action-button:hover, {{WRAPPER}} .elaet-image-caption-button:hover' => 'border-style: {{VALUE}};',
        ],
      ]
    );

  $this->add_control(
      'button_border_hover_color',
      [
        'label'     => __( 'Border Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-image-action-button:hover, {{WRAPPER}} .elaet-image-caption-button:hover' => 'border-color: {{VALUE}};',
        ],
         'condition'   => [
          'button_type!' => 'none',
        ],
      ]
    );

    $this->add_control(
      'button_border_hover_width',
      [
        'label'      => __( 'Border Width', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '2',
          'bottom'   => '2',
          'left'     => '2',
          'right'    => '2',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-image-action-button:hover, {{WRAPPER}} .elaet-image-caption-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
         'condition'   => [
          'button_type!' => 'none',
        ],

      ]
    );

    $this->add_control(
      'button_hover_radius',
      [
        'label'      => __( 'Border Radius', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '2',
          'bottom'   => '2',
          'left'     => '2',
          'right'    => '2',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-image-action-button:hover, {{WRAPPER}} .elaet-image-caption-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
         'condition'   => [
          'button_type!' => 'none',
        ],

      ]
    );

    $this->add_control(
      'button_hover_padding',
      [
        'label'      => __( 'Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '5',
          'bottom'   => '5',
          'left'     => '20',
          'right'    => '20',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-image-action-button:hover, {{WRAPPER}} .elaet-image-caption-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],

      ]
    );

    $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->end_controls_section();
  }

  protected function effect_reverse_filter($settings){
    $out_effect = array(
        'none' => '',
        'partial-overlay' => '',
        'flip-horizontal' => '',
        'flip-vertical' => '',
        'fadeInUp' => 'fadeOutDown',
        'fadeIn' => 'fadeOut',
        'fadeInLeft' => 'fadeOutLeft',
        'fadeInRight' => 'fadeOutRight',
        'fadeInDown' => 'fadeOutUp',
        'zoomInUp' => 'zoomOutDown',
        'zoomInLeft' => 'zoomOutLeft',
        'zoomInRight' => 'zoomOutRight',
        'zoomInDown' => 'zoomOutUp',
    );

    return $out_effect[$settings['image_overlay']];
  }

  /**
   * Render Image Overlay widget output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.0.0
   * @access protected
   */
  protected function render() {
    $html             = '';
    $settings         = $this->get_settings();
    $dynamic_settings = $this->get_settings_for_display();

    $this->add_inline_editing_attributes( 'heading_hover_title', 'basic' );

     $hverlink = '';

     if ( ! empty( $dynamic_settings['image_hover_btn_url']['url'] ) ) {
      $this->add_render_attribute( 'url', 'href', $dynamic_settings['image_hover_btn_url']['url'] );

      if ( $dynamic_settings['image_hover_btn_url']['is_external'] ) {
        $this->add_render_attribute( 'url', 'target', '_blank' );
      }

      if ( ! empty( $dynamic_settings['image_hover_btn_url']['nofollow'] ) ) {
        $this->add_render_attribute( 'url', 'rel', 'nofollow' );
      }
      $hverlink = $this->get_render_attribute_string( 'url' );
    }

      //print_r($settings['thumbnail_size']);
      //print_r(Group_Control_Image_Size::get_all_image_sizes());
    $src = Group_Control_Image_Size::get_attachment_image_src( $settings['image_url']['id'], 'thumbnail',$settings );
    $image_html = '';

    if ( ! empty( $src ) ) {

        $this->add_render_attribute( 'image_url', 'src', $src );

        $this->add_render_attribute( 'image_url', 'alt', Control_Media::get_image_alt( $settings['image_url'] ) );

        $image_html = '<img class="elaet-img" ' . $this->get_render_attribute_string( 'image_url' ) . '>';
      }

    $tag = $settings['heading_tag'];
    ?>

        <div class="elaet-image-module filter-<?php echo $settings['image_effect']; ?> effect-<?php echo $settings['image_hover']; ?> entrance-effect-<?php echo $settings['image_overlay']; ?>" data-entrance-effect="<?php echo $settings['image_overlay']; ?>" data-exit-effect="<?php echo $this->effect_reverse_filter($settings); ?>">
    <!--insert-->
    <div class="elaet-image-module-wrap">
        <a class="elaet-image-module-external" href="#"></a>
        <div class="elaet-image-pro-flip-box-wrap">
            <div class="elaet-image-flip-box">
                  <?php echo $image_html; ?>
                <?php if('none'==$settings['image_overlay']){ ?>
                <div class="elaet-image-caption-wrapper">
                    <div class="elaet-image-caption-inner">

                        <?php if (!empty( $settings['heading_hover_title'] ) ) { ?>
                          <<?php echo $tag; ?> class="elaet-image-caption-title elementor-inline-editing"  data-elementor-setting-key="heading_hover_title" data-elementor-inline-editing-toolbar="basic"><?php echo $settings['heading_hover_title']; ?></<?php echo $tag; ?>>
                        <?php } ?>
                        <div class="elaet-image-caption-desc"><?php echo $dynamic_settings['image_hover_subheading']; ?></div>
                        <a class="elaet-image-caption-button" <?php echo $hverlink; ?>><?php echo $settings['image_hover_button_txt']; ?></a>
                    </div>
                </div>
                <?php } ?>

              <?php if('none'!=$settings['image_overlay']){ ?>
                <!-- .elaet-image-overlay -->
                <div class="image-pro-overlay">
                    <div class="elaet-image-color-overlay"></div>
                    <div class="elaet-image-overlay-inner">
                    <?php if (!empty( $settings['heading_hover_title'] ) ) { ?>
                      <<?php echo $tag; ?> class="elaet-image-title elementor-inline-editing"  data-elementor-setting-key="heading_hover_title" data-elementor-inline-editing-toolbar="basic"><?php echo $settings['heading_hover_title']; ?></<?php echo $tag; ?>>
                    <?php } ?>
                  
                  <?php if (!empty( $settings['image_hover_subheading'] ) ) { ?>
                       <div class="elaet-image-caption elementor-inline-editing"  data-elementor-setting-key="image_hover_subheading" data-elementor-inline-editing-toolbar="basic"><?php echo $settings['image_hover_subheading']; ?></div>
                  <?php } ?>
                        <a class="elaet-image-action-button, elaet-image-caption-button" <?php echo $hverlink; ?>><?php echo $settings['image_hover_button_txt']; ?></a>
                    </div>
                </div><!-- .elaet-image-overlay -->
                <?php } ?>
            </div>
        </div>
    </div><!-- .elaet-image-module-wrap -->
</div>

<?php
  }
  protected function _content_template() {
    ?>
  <# function effect_reverse_filter(overlay){
    var out_effect = {        
        'none': '',
        'partial-overlay':'',
        'flip-horizontal':'' ,
        'flip-vertical':'' ,
        'fadeInUp': 'fadeOutDown',
        'fadeIn': 'fadeOut',
        'fadeInLeft': 'fadeOutLeft',
        'fadeInRight': 'fadeOutRight',
        'fadeInDown': 'fadeOutUp',
        'zoomInUp': 'zoomOutDown',
        'zoomInLeft': 'zoomOutLeft',
        'zoomInRight': 'zoomOutRight',
        'zoomInDown': 'zoomOutUp',
    };

    return out_effect.overlay;
  }
    var image = {
      id: settings.image_url.id,
      url: settings.image_url.url,
      size: settings.thumbnail_size,
      dimension: settings.thumbnail_custom_dimension,
      model: view.getEditModel()
    };
    var imageurl = elementor.imagesManager.getImageUrl( image );

  #>
        <div class="elaet-image-module filter-{{{settings.image_effect}}} effect-{{{settings.image_hover}}} entrance-effect-{{{settings.image_overlay}}}" data-entrance-effect="{{{settings.image_overlay}}}" data-exit-effect="<# effect_reverse_filter(settings.image_overlay); #>">
    <!--insert-->
    <div class="elaet-image-module-wrap">
        <a class="elaet-image-module-external" href="#"></a>
        <div class="elaet-image-pro-flip-box-wrap">
            <div class="elaet-image-flip-box">
                <img src="{{{ imageurl }}}" />
                <# if('none'==settings.image_overlay){ #>
                <div class="elaet-image-caption-wrapper">
                    <div class="elaet-image-caption-inner">

                        <# if ('' != settings.heading_hover_title ) { #>
                          <{{{settings.heading_tag}}} class="elaet-image-module-title elementor-inline-editing" data-elementor-setting-key="heading_hover_title" data-elementor-inline-editing-toolbar="basic">{{{settings.heading_hover_title}}}</{{{settings.heading_tag}}}>
                        <# } #>
                        <div class="elaet-image-caption-desc">{{{settings.image_hover_subheading}}}</div>
                        <a class="elaet-image-caption-button" >{{{settings.image_hover_button_txt}}}</a>
                    </div>
                </div>
                <# } #>
                <# if ('none'!= settings.image_overlay ) { #>
                <!-- .elaet-image-overlay -->
                <div class="image-pro-overlay">
                    <div class="elaet-image-color-overlay"></div>
                    <div class="elaet-image-overlay-inner">
                    <# if (''!= settings.heading_hover_title ) { #>
                    <{{{settings.heading_tag}}} class="elaet-image-title elementor-inline-editing" data-elementor-setting-key="heading_hover_title" data-elementor-inline-editing-toolbar="basic">{{{settings.heading_hover_title}}}</{{{settings.heading_tag}}}>
                    <# } #>
                  
                  <# if (''!= settings.image_hover_subheading ) { #>
                       <div class="elaet-image-caption elementor-inline-editing"  data-elementor-setting-key="image_hover_subheading" data-elementor-inline-editing-toolbar="basic">{{{settings.image_hover_subheading}}}</div>
                    <# } #>
                        <a class="elaet-image-action-button, elaet-image-caption-button">
                        {{{settings.image_hover_button_txt}}}</a>
                    </div>
                </div><!-- .elaet-image-overlay -->
                <# } #>
            </div>
        </div>
    </div><!-- .elaet-image-module-wrap -->
</div>
  <?php
  }
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Image_Widget() );