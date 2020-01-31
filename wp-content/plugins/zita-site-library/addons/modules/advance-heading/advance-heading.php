<?php
//namespace Elementor;

// Elementor Classes.
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
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
class Elaet_Heading_Widget extends Widget_Base {

  /**
   * Get widget name.
   *
   * Retrieve zita heading widget name.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'Advance Heading';
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
    return __( 'Advance Heading', 'elaet' );
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
    return 'eicon-type-tool';
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
    $this->register_general_control();
    $this->register_devider_content_controls();
    $this->register_style_content_controls();
    $this->register_heading_style_content_controls();
    $this->register_description_style_content_controls();
    $this->register_divider_content_controls();
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
            'label' => __( 'General', 'elaet' ),
          ]
        );

    $this->add_control(
      'heading_title',
      [
        'label'   => __( 'Heading', 'elaet' ),
        'type'    => Controls_Manager::TEXTAREA,
        'rows'    => '2',
        'dynamic' => [
          'active' => true,
        ],
        'default' => __( 'Heading Title', 'elaet' ),
      ]
    );
    $this->add_control(
      'heading_url',
      [
        'label'       => __( 'Link', 'elaet' ),
        'type'        => Controls_Manager::URL,
        'placeholder' => __( 'https://new-url.com', 'elaet' ),
        'dynamic'     => [
          'active' => true,
        ],
        'default'     => [
          'url' => '',
        ],
      ]
    );
    $this->add_control(
      'heading_description',
      [
        'label'   => __( 'Description', 'elaet' ),
        'type'    => Controls_Manager::TEXTAREA,
        'dynamic' => [
          'active' => true,
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
  protected function register_devider_content_controls() {
    $this->start_controls_section(
      'section_separator',
      [
        'label' => __( 'Heading Separator', 'elaet' ),
      ]
    );
    $this->add_control(
      'heading_devider_style',
      [
        'label'       => __( 'Style', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'none',
        'label_block' => false,
        'options'     => [
          'none'       => __( 'None', 'elaet' ),
          'line'       => __( 'Line', 'elaet' ),
          'line_icon'  => __( 'Line With Icon', 'elaet' ),
          'line_image' => __( 'Line With Image', 'elaet' ),
          'line_text'  => __( 'Line With Text', 'elaet' ),
        ],
      ]
    );
    $this->add_control(
      'heading_devider_position',
      [
        'label'       => __( 'Separator Position', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'center',
        'label_block' => false,
        'options'     => [
          'center' => __( 'Between Heading &amp; Description', 'elaet' ),
          'top'    => __( 'Top', 'elaet' ),
          'bottom' => __( 'Bottom', 'elaet' ),
        ],
        'condition'   => [
          'heading_devider_style!' => 'none',
        ],
      ]
    );

    /* Separator line with Icon */
    $this->add_control(
      'heading_icon',
      [
        'label'     => __( 'Select Icon', 'elaet' ),
        'type'      => Controls_Manager::ICON,
        'default'   => 'fa fa-star',
        'condition' => [
          'heading_devider_style' => 'line_icon',
        ],
      ]
    );

    /* Separator line with Image */
    $this->add_control(
      'heading_image_type',
      [
        'label'       => __( 'Image Source', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'media',
        'label_block' => false,
        'options'     => [
          'media' => __( 'Media Library', 'elaet' ),
          'url'   => __( 'URL', 'elaet' ),
        ],
        'condition'   => [
          'heading_devider_style' => 'line_image',
        ],
      ]
    );
    $this->add_control(
      'heading_image',
      [
        'label'     => __( 'Image', 'elaet' ),
        'type'      => Controls_Manager::MEDIA,
        'default'   => [
          'url' => Utils::get_placeholder_image_src(),
        ],
        'dynamic'   => [
          'active' => true,
        ],
        'condition' => [
          'heading_devider_style' => 'line_image',
          'heading_image_type'      => 'media',
        ],
      ]
    );
    $this->add_control(
      'heading_image_link',
      [
        'label'         => __( 'Photo URL', 'elaet' ),
        'type'          => Controls_Manager::URL,
        'default'       => [
          'url' => '',
        ],
        'show_external' => false, // Show the 'open in new tab' button.
        'condition'     => [
          'heading_devider_style' => 'line_image',
          'heading_image_type'      => 'url',
        ],
      ]
    );

    /* Separator line with text */
    $this->add_control(
      'heading_line_text',
      [
        'label'     => __( 'Enter Text', 'elaet' ),
        'type'      => Controls_Manager::TEXT,
        'default'   => __( 'Ultimate', 'elaet' ),
        'condition' => [
          'heading_devider_style' => 'line_text',
        ],
        'dynamic'   => [
          'active' => true,
        ],
        'selector'  => '{{WRAPPER}} .elaet-divider-text',
      ]
    );

    $this->add_control(
      'heading_separator_padding',
      [
        'label'      => __( 'Separator Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '0',
          'bottom'   => '0',
          'left'     => '0',
          'right'    => '0',
          'unit'     => 'px',
          
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-separator-parent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],

      ]
    );

    $this->add_control(
      'heading_separator_margin',
      [
        'label'      => __( 'Separator Margin', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '0',
          'bottom'   => '0',
          'left'     => '0',
          'right'    => '0',
          'unit'     => 'px',
          
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-separator-parent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],

      ]
    );

    $this->end_controls_section();
  }

/**
   * Register Heading Style Controls.
   *
   * @since 0.0.1
   * @access protected
   */
protected  function register_style_content_controls(){
  $this->start_controls_section(
      'section_style',
      [
        'label' => __( 'General', 'elaet' ),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );

  $this->add_responsive_control(
      'heading_text_align',
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
        ],
        'selectors'    => [
          '{{WRAPPER}} .elaet-heading,{{WRAPPER}} .elaet-description, {{WRAPPER}} .elaet-heading-align' => 'text-align: {{VALUE}};',
        ],
        'prefix_class' => 'elaet%s-heading-align-',
      ]
    );

    $this->end_controls_section();

  }


  /**
   * Register Advanced Heading Typography Controls.
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
          'h1' => __( 'H1', 'elaet' ),
          'h2' => __( 'H2', 'elaet' ),
          'h3' => __( 'H3', 'elaet' ),
          'h4' => __( 'H4', 'elaet' ),
          'h5' => __( 'H5', 'elaet' ),
          'h6' => __( 'H6', 'elaet' ),
        ],
        'default' => 'h2',
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'heading_typography',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .elaet-heading, {{WRAPPER}} .elaet-heading a',
      ]
    );

    $this->add_control(
      'heading_text_bg_color',
      [
        'label'     => __( 'Heading Text Background', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} #elaet-heading' => 'background-color: {{VALUE}};',
        ],
       ]
    );

    $this->add_control(
      'heading_color_type',
      [
        'label'        => __( 'Fill', 'elaet' ),
        'type'         => Controls_Manager::SELECT,
        'options'      => [
          'color'    => __( 'Color', 'elaet' ),
          'gradient' => __( 'Background', 'elaet' ),
        ],
        'default'      => 'color',
        'prefix_class' => 'elaet-heading-fill-',
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
        'selectors' => [
          '{{WRAPPER}} .elaet-heading-text' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'heading_color_type' => 'color',
        ],
      ]
    );
    $this->add_group_control(
      Group_Control_Background::get_type(),
      [
        'name'           => 'heading_color_gradient',
        'types'          => [ 'gradient', 'classic' ],
        'selector'       => '{{WRAPPER}} .elaet-heading-text',
        'fields_options' => [
          'background' => [
            'scheme' => [
              'type'  => Scheme_Color::get_type(),
              'value' => Scheme_Color::COLOR_1,
            ],
          ],
        ],
        'condition'      => [
          'heading_color_type' => 'gradient',
        ],
      ]
    );
    $this->add_group_control(
      Group_Control_Text_Shadow::get_type(),
      [
        'name'     => 'heading_shadow',
        'selector' => '{{WRAPPER}} .elaet-heading-text',
      ]
    );
    $this->add_control(
      'heading_text_bg_padding',
      [
        'label'      => __( 'Heading Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '0',
          'bottom'   => '0',
          'left'     => '0',
          'right'    => '0',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'selectors'  => [
          '{{WRAPPER}} #elaet-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],

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
          'bottom'   => '0',
          'left'     => '0',
          'right'    => '0',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],

      ]
    );
    $this->end_controls_section();
  }

  /**
   * Register description Typography Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_description_style_content_controls() {

    $this->start_controls_section(
      'section_desc_typography',
      [
        'label'     => __( 'Description', 'elaet' ),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => [
          'heading_description!' => '',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'      => 'heading_desc_typography',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_3,
        'selector'  => '{{WRAPPER}} .elaet-description',
        'condition' => [
          'heading_description!' => '',
        ],
      ]
    );
    $this->add_control(
      'heading_desc_color',
      [
        'label'     => __( 'Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_3,
        ],
        'default'   => '',
        'condition' => [
          'heading_description!' => '',
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-description' => 'color: {{VALUE}};',
        ],
      ]
    );
    $this->add_control(
      'heading_desc_margin',
      [
        'label'      => __( 'Description Margin', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '15',
          'bottom'   => '0',
          'left'     => '0',
          'right'    => '0',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'condition'  => [
          'heading_description!' => '',
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],

      ]
    );
    $this->end_controls_section();
  }



  /**
   * Register Divider Image/Icon Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_divider_content_controls() {

    $this->start_controls_section(
      'section_separator_line_style',
      [
        'label'     => __( 'Separator - Line', 'elaet' ),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => [
          'heading_devider_style!' => 'none',
        ],
      ]
    );

    $this->add_control(
      'heading_line_style',
      [
        'label'       => __( 'Style', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'solid',
        'label_block' => false,
        'options'     => [
          'solid'  => __( 'Solid', 'elaet' ),
          'dashed' => __( 'Dashed', 'elaet' ),
          'dotted' => __( 'Dotted', 'elaet' ),
          'double' => __( 'Double', 'elaet' ),
        ],
        'condition'   => [
          'heading_devider_style!' => 'none',
        ],
        'selectors'   => [
          '{{WRAPPER}} .elaet-divider-line > span, {{WRAPPER}} .elaet-divider' => 'border-top-style: {{VALUE}};',
        ],
      ]
    );
    $this->add_control(
      'heading_line_color',
      [
        'label'     => __( 'Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_4,
        ],
        'condition' => [
          'heading_devider_style!' => 'none',
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-divider-line > span, {{WRAPPER}} .elaet-divider, {{WRAPPER}} .elaet-heading-text' => 'border-top-color: {{VALUE}};',
        ],
      ]
    );
    $this->add_control(
      'heading_line_thickness',
      [
        'label'      => __( 'Thickness', 'elaet' ),
        'type'       => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em', 'rem' ],
        'range'      => [
          'px' => [
            'min' => 1,
            'max' => 200,
          ],
        ],
        'default'    => [
          'size' => 2,
          'unit' => 'px',
        ],
        'condition'  => [
          'heading_devider_style!' => 'none',
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-divider, {{WRAPPER}} .elaet-divider-line > span ' => 'border-top-width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'heading_line_width',
      [
        'label'          => __( 'Width', 'elaet' ),
        'type'           => Controls_Manager::SLIDER,
        'size_units'     => [ '%', 'px' ],
        'range'          => [
          'px' => [
            'max' => 1000,
          ],
        ],
        'default'        => [
          'size' => 20,
          'unit' => '%',
        ],
        'tablet_default' => [
          'unit' => '%',
        ],
        'mobile_default' => [
          'unit' => '%',
        ],
        'label_block'    => true,
        'condition'      => [
          'heading_devider_style!' => 'none',
        ],
        'selectors'      => [
          '{{WRAPPER}} .elaet-divider, {{WRAPPER}} .elaet-divider-wrap' => 'width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'section_imgicon_style',
      [
        'label'     => __( 'Separator - Icon / Image / Text', 'elaet' ),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => [
          'heading_devider_style' => [ 'line_icon', 'line_image', 'line_text' ],
        ],
      ]
    );

      $this->add_control(
        'heading_line_text_color',
        [
          'label'     => __( 'Text Color', 'elaet' ),
          'type'      => Controls_Manager::COLOR,
          'scheme'    => [
            'type'  => Scheme_Color::get_type(),
            'value' => Scheme_Color::COLOR_3,
          ],
          'condition' => [
            'heading_devider_style' => 'line_text',
          ],
          'selectors' => [
            '{{WRAPPER}} .elaet-divider-text' => 'color: {{VALUE}};',
          ],
        ]
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
          'name'      => 'heading_separator_typography',
          'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
          'condition' => [
            'heading_devider_style' => 'line_text',
          ],
          'selector'  => '{{WRAPPER}} .elaet-divider-text',
        ]
      );

    $this->add_responsive_control(
      'heading_icon_size',
      [
        'label'      => __( 'Icon Size', 'elaet' ),
        'type'       => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em', 'rem' ],
        'range'      => [
          'px' => [
            'min' => 1,
            'max' => 100,
          ],
        ],
        'default'    => [
          'size' => 30,
          'unit' => 'px',
        ],
        'condition'  => [
          'heading_devider_style' => 'line_icon',
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-icon-wrap .elaet-icon i' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; text-align: center;',
          '{{WRAPPER}} .elaet-icon-wrap .elaet-icon' => ' height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'heading_image_size',
      [
        'label'      => __( 'Image Size', 'elaet' ),
        'type'       => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em', 'rem' ],
        'range'      => [
          'px' => [
            'min' => 1,
            'max' => 500,
          ],
        ],
        'default'    => [
          'size' => 50,
          'unit' => 'px',
        ],
        'condition'  => [
          'heading_devider_style' => 'line_image',
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-image-content .elaet-photo-img'   => 'min-width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'heading_icon_position',
      [
        'label'          => __( 'Position', 'elaet' ),
        'type'           => Controls_Manager::SLIDER,
        'size_units'     => [ '%' ],
        'range'          => [
          '%' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'default'        => [
          'size' => 50,
          'unit' => '%',
        ],
        'tablet_default' => [
          'unit' => '%',
        ],
        'mobile_default' => [
          'unit' => '%',
        ],
        'condition'      => [
          'heading_devider_style' => [ 'line_icon', 'line_image', 'line_text' ],
        ],
        'selectors'      => [
          '{{WRAPPER}} .elaet-left-line'  => 'width: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .elaet-right-line' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
        ],
      ]
    );

    $this->add_responsive_control(
      'heading_icon_padding',
      [
        'label'      => __( 'Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '0',
          'bottom'   => '0',
          'left'     => '10',
          'right'    => '10',
          'unit'     => 'px',
          'isLinked' => false,
        ],
        'condition'  => [
          'heading_devider_style' => [ 'line_icon', 'line_image', 'line_text' ],
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-divider-content' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],

      ]
    );

    $this->add_control(
      'heading_icon_fields',
      [
        'label'     => __( 'Style', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'heading_devider_style!' => [ 'none', 'line_text' ],
        ],
      ]
    );

    $this->add_control(
      'heading_imgicon_style_options',
      [
        'label'       => __( 'Select Style', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'simple',
        'label_block' => false,
        'options'     => [
          'simple' => __( 'Simple', 'elaet' ),
          'custom' => __( 'Design your own', 'elaet' ),
        ],
        'condition'   => [
          'heading_devider_style!' => [ 'none', 'line_text' ],
        ],
      ]
    );
    $this->add_control(
      'headings_icon_color',
      [
        'label'     => __( 'Icon Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'condition' => [
          'heading_imgicon_style_options' => 'simple',
          'heading_devider_style'       => 'line_icon',
        ],
        'default'   => '',
        'selectors' => [
          '{{WRAPPER}} .elaet-icon-wrap .elaet-icon i'  => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'headings_icon_hover_color',
      [
        'label'     => __( 'Icon Hover Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'condition' => [
          'heading_imgicon_style_options' => 'simple',
          'heading_devider_style'       => 'line_icon',
        ],
        'default'   => '',
        'selectors' => [
          '{{WRAPPER}} .elaet-icon-wrap .elaet-icon:hover i'  => 'color: {{VALUE}};',
        ],
      ]
    );
    $this->add_control(
      'headings_icon_animation',
      [
        'label'     => __( 'Hover Animation', 'elaet' ),
        'type'      => Controls_Manager::HOVER_ANIMATION,
        'condition' => [
          'heading_imgicon_style_options' => 'simple',
          'heading_devider_style!'      => [ 'none', 'line_text' ],
        ],
      ]
    );

    $this->start_controls_tabs( 'heading_imgicon_style' );

      $this->start_controls_tab(
        'heading_imgicon_normal',
        [
          'label'     => __( 'Normal', 'elaet' ),
          'condition' => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style!'      => [ 'none', 'line_text' ],
          ],
        ]
      );

      $this->add_control(
        'heading_icon_color',
        [
          'label'     => __( 'Icon Color', 'elaet' ),
          'type'      => Controls_Manager::COLOR,
          'scheme'    => [
            'type'  => Scheme_Color::get_type(),
            'value' => Scheme_Color::COLOR_1,
          ],
          'condition' => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style'       => 'line_icon',
          ],
          'default'   => '',
          'selectors' => [
            '{{WRAPPER}} .elaet-icon-wrap .elaet-icon i'  => 'color: {{VALUE}};',
          ],
        ]
      );
      $this->add_control(
        'heading_icon_bgcolor',
        [
          'label'     => __( 'Background Color', 'elaet' ),
          'type'      => Controls_Manager::COLOR,
          'default'   => '',
          'condition' => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style!'      => [ 'none', 'line_text' ],
          ],
          'selectors' => [
            '{{WRAPPER}} .elaet-icon-wrap .elaet-icon, {{WRAPPER}} .elaet-image-content' => 'background-color: {{VALUE}};',
          ],
        ]
      );
      $this->add_responsive_control(
        'heading_icon_bg_size',
        [
          'label'      => __( 'Background Size', 'elaet' ),
          'type'       => Controls_Manager::SLIDER,
          'size_units' => [ 'px' ],
          'range'      => [
            'px' => [
              'min' => 0,
              'max' => 100,
            ],
          ],
          'default'    => [
            'size' => '0',
            'unit' => 'px',
          ],
          'condition'  => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style!'      => [ 'none', 'line_text' ],
          ],
          'selectors'  => [
            '{{WRAPPER}} .elaet-icon-wrap .elaet-icon, {{WRAPPER}} .elaet-image-content' => 'padding: {{SIZE}}{{UNIT}}; display:inline-block; box-sizing:content-box;',
          ],
        ]
      );

      $this->add_control(
        'heading_icon_border',
        [
          'label'       => __( 'Border Style', 'elaet' ),
          'type'        => Controls_Manager::SELECT,
          'default'     => 'none',
          'label_block' => false,
          'options'     => [
            'none'   => __( 'None', 'elaet' ),
            'solid'  => __( 'Solid', 'elaet' ),
            'double' => __( 'Double', 'elaet' ),
            'dotted' => __( 'Dotted', 'elaet' ),
            'dashed' => __( 'Dashed', 'elaet' ),
          ],
          'condition'   => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style!'      => [ 'none', 'line_text' ],
          ],
          'selectors'   => [
            '{{WRAPPER}} .elaet-icon-wrap .elaet-icon, {{WRAPPER}} .elaet-image .elaet-image-content' => 'border-style: {{VALUE}};',
          ],
        ]
      );
      $this->add_control(
        'heading_icon_border_color',
        [
          'label'     => __( 'Border Color', 'elaet' ),
          'type'      => Controls_Manager::COLOR,
          'scheme'    => [
            'type'  => Scheme_Color::get_type(),
            'value' => Scheme_Color::COLOR_1,
          ],
          'condition' => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style!'      => [ 'none', 'line_text' ],
            'heading_icon_border!'          => 'none',
          ],
          'default'   => '',
          'selectors' => [
            '{{WRAPPER}} .elaet-icon-wrap .elaet-icon, {{WRAPPER}} .elaet-image-content' => 'border-color: {{VALUE}};',
          ],
        ]
      );
      $this->add_control(
        'heading_icon_border_size',
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
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style!'      => [ 'none', 'line_text' ],
            'heading_icon_border!'          => 'none',
          ],
          'selectors'  => [
            '{{WRAPPER}} .elaet-icon-wrap .elaet-icon, {{WRAPPER}} .elaet-image-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; box-sizing:content-box;',
          ],
        ]
      );
      $this->add_control(
        'heading_icon_border_radius',
        [
          'label'      => __( 'Rounded Corners', 'elaet' ),
          'type'       => Controls_Manager::SLIDER,
          'size_units' => [ 'px' ],
          'range'      => [
            'px' => [
              'min' => 0,
              'max' => 1000,
            ],
          ],
          'default'    => [
            'size' => 20,
            'unit' => 'px',
          ],
          'selectors'  => [
            '{{WRAPPER}} .elaet-icon-wrap .elaet-icon, {{WRAPPER}} .elaet-image-content'   => 'border-radius: {{SIZE}}{{UNIT}};',
          ],
          'condition'  => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style!'      => [ 'none', 'line_text' ],
          ],
        ]
      );
      $this->end_controls_tab();

      $this->start_controls_tab(
        'heading_imgicon_hover',
        [
          'label'     => __( 'Hover', 'elaet' ),
          'condition' => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style!'      => [ 'none', 'line_text' ],
          ],
        ]
      );
      $this->add_control(
        'heading_icon_hover_color',
        [
          'label'     => __( 'Icon Hover Color', 'elaet' ),
          'type'      => Controls_Manager::COLOR,
          'condition' => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style'       => 'line_icon',
          ],
          'default'   => '',
          'selectors' => [
            '{{WRAPPER}} .elaet-icon-wrap .elaet-icon:hover i'  => 'color: {{VALUE}};',
          ],
        ]
      );
      $this->add_control(
        'infobox_icon_hover_bgcolor',
        [
          'label'     => __( 'Background Hover Color', 'elaet' ),
          'type'      => Controls_Manager::COLOR,
          'default'   => '',
          'condition' => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style!'      => [ 'none', 'line_text' ],
          ],
          'selectors' => [
            '{{WRAPPER}} .elaet-icon-wrap .elaet-icon:hover, {{WRAPPER}} .elaet-image-content:hover' => 'background-color: {{VALUE}};',

          ],
        ]
      );
      $this->add_control(
        'heading_icon_hover_border',
        [
          'label'     => __( 'Border Hover Color', 'elaet' ),
          'type'      => Controls_Manager::COLOR,
          'condition' => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style!'      => [ 'none', 'line_text' ],
            'heading_icon_border!'          => 'none',
          ],
          'default'   => '',
          'selectors' => [
            '{{WRAPPER}} .elaet-icon-wrap .elaet-icon:hover, {{WRAPPER}} .elaet-image-content:hover ' => 'border-color: {{VALUE}};',
          ],
        ]
      );
      $this->add_control(
        'heading_icon_animation',
        [
          'label'     => __( 'Hover Animation', 'elaet' ),
          'type'      => Controls_Manager::HOVER_ANIMATION,
          'condition' => [
            'heading_imgicon_style_options' => 'custom',
            'heading_devider_style!'      => [ 'none', 'line_text' ],
          ],
        ]
      );

      $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->end_controls_section();
  }

  function rendar_image(){
        $settings = $this->get_settings_for_display();
        $image_html = '';
    if ( 'url' == $settings['heading_image_type'] ) { 

      if ( ! empty( $settings['heading_image_link'] ) ) {

      $this->add_render_attribute( 'heading_image_link', 'src', $settings['heading_image_link']['url'] );

          $image_html = '<img class="elaet-photo-img" ' . $this->get_render_attribute_string( 'heading_image_link' ) . '>';
      }
    } elseif('media' == $settings['heading_image_type']){
        if ( ! empty( $settings['heading_image']['url'] ) ) {

        $this->add_render_attribute( 'heading_image', 'src', $settings['heading_image']['url'] );

        $this->add_render_attribute( 'heading_image', 'alt', Control_Media::get_image_alt( $settings['heading_image'] ) );

        $image_html = '<img class="elaet-photo-img" ' . $this->get_render_attribute_string( 'heading_image' ) . '>';
      }

    }
    echo $image_html;

  }

  function render_devider($position, $settings){ 

      if ( 'none' != $settings['heading_devider_style'] && $position == $settings['heading_devider_position'] ):

        if ( 'line_icon' == $settings['heading_devider_style'] || 'line_image' == $settings['heading_devider_style'] ) {
      $animation_class = '';
      if ( 'simple' == $settings['heading_imgicon_style_options'] ) {
        $animation_class = $settings['headings_icon_animation'];
      } elseif ( 'custom' == $settings['heading_imgicon_style_options'] ) {
        $animation_class = $settings['heading_icon_animation'];
      }

    }

    ?>
    <div class="elaet-separator-parent">
      <div class="elaet-module-content elaet-divider-main ">

        <?php if ( 'line' == $settings['heading_devider_style'] ) { ?>
          <div class="elaet-divider"></div>
        <?php } ?>

        <?php if ( 'line_icon' == $settings['heading_devider_style'] ) { ?>
        <div class="elaet-divider-wrap" >
            <div class="elaet-divider-line elaet-left-line">
                <span></span>
            </div>
            <div class="elaet-divider-content">
                <div class="elaet-module-content elaet-divider-main elementor-animation-<?php echo $animation_class; ?>">
                    <div class="elaet-icon-wrap">
                        <span class="elaet-icon">
                            <i class="<?php echo $settings['heading_icon']; ?>"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="elaet-divider-line elaet-right-line">
                <span></span>
            </div>
        </div>
      <?php } ?>

    <?php if ( 'line_image' == $settings['heading_devider_style'] ) { ?>

        <div class="elaet-divider-wrap">
            <div class="elaet-divider-line elaet-left-line">
                <span></span>
            </div>
            <div class="elaet-divider-content">
                <div class="elaet-module-content">
                    <div class="elaet-image-content elementor-animation-<?php echo $animation_class; ?>">
                       <?php $this->rendar_image(); ?>
                    </div>
                </div>
            </div>
            <div class="elaet-divider-line elaet-right-line">
                <span></span>
            </div>
        </div>
      <?php } ?>

    <?php if ( 'line_text' == $settings['heading_devider_style'] ) { ?>
      <div class="elaet-module-content elaet-divider-main">
        <div class="elaet-divider-wrap">
            <div class="elaet-divider-line elaet-left-line">
                <span></span>
            </div>
            <div class="elaet-divider-content">
                <span class="elaet-divider-text">
                <?php echo $this->get_settings_for_display( 'heading_line_text' ); ?>
                </span>
            </div>
            <div class="elaet-divider-line elaet-right-line">
                <span></span>
            </div>
        </div>
    </div>
      <?php } ?>

        </div>
      </div>
      <?php
    endif;
  }

  /**
   * Render oEmbed widget output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.0.0
   * @access protected
   */
  protected function render() {
    $html             = $link ='';
    $settings         = $this->get_settings();
    $dynamic_settings = $this->get_settings_for_display();

    $this->add_inline_editing_attributes( 'heading_title', 'basic' );
    $this->add_inline_editing_attributes( 'heading_description', 'advanced' );

    if ( empty( $dynamic_settings['heading_title'] ) ) {
      return;
    }

    if ( ! empty( $dynamic_settings['heading_url']['url'] ) ) {
      $this->add_render_attribute( 'url', 'href', $dynamic_settings['heading_url']['url'] );

      if ( $dynamic_settings['heading_url']['is_external'] ) {
        $this->add_render_attribute( 'url', 'target', '_blank' );
      }

      if ( ! empty( $dynamic_settings['heading_url']['nofollow'] ) ) {
        $this->add_render_attribute( 'url', 'rel', 'nofollow' );
      }
      $link = $this->get_render_attribute_string( 'url' );
    }
?>
    <div class="elaet-module-content elaet-heading-wrapper elaet-heading-align">  
      <?php $this->render_devider( 'top', $settings ); ?>
      <<?php echo $settings['heading_tag']; ?> class="elaet-heading" id="elaet-heading">
        <a <?php echo $link; ?> >
          <span class="elaet-heading-text elementor-inline-editing" data-elementor-setting-key="heading_title" data-elementor-inline-editing-toolbar="basic" ><?php echo $dynamic_settings['heading_title']; ?>
          </span>
      </a>
      </<?php echo $settings['heading_tag']; ?>>
        <?php $this->render_devider( 'center', $settings ); ?>
          <?php if ($settings['heading_description'] !=""): ?>
            <div class="elaet-description elementor-inline-editing" data-elementor-setting-key="heading_description" data-elementor-inline-editing-toolbar="advanced"> <?php echo $this->get_settings_for_display( 'heading_description' ); ?> 
            </div>
          <?php endif ?> 
    </div>
        <?php $this->render_devider( 'bottom', $settings ); ?>
<?php 
  }
  protected function _content_template() {
    ?>
    <#
    if ( '' == settings.heading_title ) {
      return;
    }
    if ( '' != settings.heading_link.url ) {
      view.addRenderAttribute( 'url', 'href', settings.heading_link.url );
    }
    #>
    <div class="elaet-module-content elaet-heading-wrapper elaet-heading-align"> 
          <{{{ settings.heading_tag }}} class="elaet-heading">
 
    <a {{{ view.getRenderAttributeString( 'url' ) }}} >
      <span class="elaet-heading-text elementor-inline-editing" data-elementor-setting-key="" data-elementor-inline-editing-toolbar="" ><# settings.heading_title #></span>
    </a>
          </{{{ settings.heading_tag }}}>
    <#      if ($settings['heading_description'] != ""){  #> 
      <div class="elaet-description elementor-inline-editing" data-elementor-setting-key="heading_description" data-elementor-inline-editing-toolbar="advanced">
        <# settings.heading_description #> 
      </div>
    <# } #>
    </div>

    <h3>{{{ settings.url }}}</h3>
    <?php
  }

  

}
Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Heading_Widget() );