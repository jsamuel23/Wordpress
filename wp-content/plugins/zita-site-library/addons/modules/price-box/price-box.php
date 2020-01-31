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
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;



/**
 * Zita Elementor Widget.
 */


if ( ! defined( 'ABSPATH' ) ) {
  exit;   // Exit if accessed directly.
}

/**
 * Class PriceTable.
 */
class Elaet_Price_Box extends Widget_Base {

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
    return 'price_box';
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
    return __( 'Price Box', 'elaet' );
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
    return 'eicon-price-table';
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
   * Register Price Table controls.
   *
   * @access protected
   */
  protected function _register_controls() {

    $this->register_general_controls();
    $this->register_title_controls();
    $this->register_cta_controls();
    $this->register_pricing_controls();
    $this->register_content_controls();
    
    
    $this->register_ribbon_controls();
    $this->register_title_style_controls();
    $this->register_cta_style_controls();
    $this->register_pricing_style_controls();
    $this->register_content_style_controls();
    $this->register_ribbon_style_controls();
    
  }

  /**
   * Register Price Table General Controls.
   *
   * @access protected
   */
  protected function register_general_controls() {
    $this->start_controls_section(
      'section_general_field',
      [
        'label' => __( 'Price Box', 'elaet' ),
      ]
    );

    $this->add_control(
      'pricetable_style',
      [
        'label'       => __( 'Price Box Style', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'default'     => '3',
        'options'     => [
          '0' => 'Standard',
          '1' => 'Regular',
          '2' => 'Button at Center',
          '3' => 'Rounded Price Background',
          '4' => 'Landscape Skin',
          '5' => 'Features at Top',
        ],
      ]
    );

    $this->add_control(
      'box_hover_animation',
      [
        'label'        => __( 'Price Box Hover Animation', 'elaet' ),
        'type'         => Controls_Manager::SELECT,
        'default'      => '',
        'label_block' => true,
        'options'      => [
          ''                => 'None',
        'grow' => 'Grow',
        'shrink' => 'Shrink',
        'pulse' => 'Pulse',
        'pulse-grow' => 'Pulse Grow',
        'pulse-shrink' => 'Pulse Shrink',
        'push' => 'Push',
        'pop' => 'Pop',
        'bounce-in' => 'Bounce In',
        'bounce-out' => 'Bounce Out',
        'rotate' => 'Rotate',
        'grow-rotate' => 'Grow Rotate',
        'float' => 'Float',
        'sink' => 'Sink',
        'bob' => 'Bob',
        'hang' => 'Hang',
        'skew' => 'Skew',
        'skew-forward' => 'Skew Forward',
        'skew-backward' => 'Skew Backward',
        'wobble-vertical' => 'Wobble Vertical',
        'wobble-horizontal' => 'Wobble Horizontal',
        'wobble-to-bottom-right' => 'Wobble To Bottom Right',
        'wobble-to-top-right' => 'Wobble To Top Right',
        'wobble-top' => 'Wobble Top',
        'wobble-bottom' => 'Wobble Bottom',
        'wobble-skew' => 'Wobble Skew',
        'buzz' => 'Buzz',
        'buzz-out' => 'Buzz Out',
        ],
        'prefix_class' => 'elementor-animation-',
      ]
    );

    $this->end_controls_section();
  }


  /**
   * Register Price Table Heading Controls.
   *
   * @access protected
   */
  protected function register_title_controls() {

    $this->start_controls_section(
      'section_header_field',
      [
        'label' => __( 'Title', 'elaet' ),
      ]
    );

    $this->add_control(
      'heading',
      [
        'label'   => __( 'Title', 'elaet' ),
        'type'    => Controls_Manager::TEXT,
        'dynamic' => [
          'active' => true,
        ],
        'default' => __( 'Premium', 'elaet' ),
      ]
    );

    $this->add_control(
      'sub_heading',
      [
        'label'     => __( 'Description', 'elaet' ),
        'type'      => Controls_Manager::TEXT,
        'dynamic'   => [
          'active' => true,
        ],
        'default'   => __( 'Buy once, use forever.', 'elaet' ),
        ]
    );
    $this->end_controls_section();
  }

     /**
   * Register Price Table Call to Action Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_cta_controls() {

    $this->start_controls_section(
      'section_button',
      [
        'label' => __( 'Button', 'elaet' ),
      ]
    );

    $this->add_control(
      'price_cta_type',
      [
        'label'       => __( 'Type', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'button',
        'label_block' => false,
        'options'     => [
          'none'   => __( 'None', 'elaet' ),
          'link'   => __( 'Text', 'elaet' ),
          'button' => __( 'Button', 'elaet' ),
        ],
      ]
    );

    $this->add_control(
      'cta_text',
      [
        'label'     => __( 'Text', 'elaet' ),
        'type'      => Controls_Manager::TEXT,
        'default'   => __( 'Buy Now', 'elaet' ),
        'dynamic'   => [
          'active' => true,
        ],
        'condition' => [
          'price_cta_type!' => 'none',
        ],
      ]
    );

    $this->add_control(
      'cta_icon',
      [
        'label'     => __( 'Select Icon', 'elaet' ),
        'type'      => Controls_Manager::ICON,
        'default'   => '',
        'condition' => [
          'price_cta_type' => [ 'button', 'link' ],
        ],
      ]
    );

    $this->add_control(
      'cta_icon_position',
      [
        'label'       => __( 'Icon Position', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'right',
        'label_block' => false,
        'options'     => [
          'right' => __( 'After Text', 'elaet' ),
          'left'  => __( 'Before Text', 'elaet' ),
        ],
        'condition'   => [
          'price_cta_type' => [ 'button', 'link' ],
          'cta_icon!'      => '',
        ],
      ]
    );

    $this->add_control(
      'link',
      [
        'label'       => __( 'Link', 'elaet' ),
        'type'        => Controls_Manager::URL,
        'placeholder' => 'http://your-link.com',
        'default'     => [
          'url' => '#',
        ],
        'dynamic'     => [
          'active' => true,
        ],
        'condition'   => [
          'price_cta_type!' => 'none',
        ],
      ]
    );

    $this->add_control(
      'footer_additional_info',
      [
        'label'   => __( 'Disclaimer Text', 'elaet' ),
        'type'    => Controls_Manager::TEXTAREA,
        'rows'    => 2,
        'dynamic' => [
          'active' => true,
        ],
        'condition' => [
          'price_cta_type!' => 'none',
        ],
      ]
    );
    $this->end_controls_section();
  }


  /**
   * Register Price Table Pricing Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_pricing_controls() {

    $this->start_controls_section(
      'section_pricing_fields',
      [
        'label' => __( 'Pricing', 'elaet' ),
      ]
    );
    $this->add_control(
      'price',
      [
        'label'   => __( 'Price', 'elaet' ),
        'type'    => Controls_Manager::TEXT,
        'dynamic' => [
          'active' => true,
        ],
        'default' => __( '99.99', 'elaet' ),
      ]
    );
    $this->add_control(
      'sale',
      [
        'label'        => __( 'Offering Discount?', 'elaet' ),
        'type'         => Controls_Manager::SWITCHER,
        'label_on'     => __( 'Yes', 'elaet' ),
        'label_off'    => __( 'No', 'elaet' ),
        'return_value' => 'yes',
        'default'      => '',
      ]
    );
    $this->add_control(
      'original_price',
      [
        'label'     => __( 'Original Price', 'elaet' ),
        'type'      => Controls_Manager::NUMBER,
        'default'   => '59.99',
        'dynamic'   => [
          'active' => true,
        ],
        'condition' => [
          'sale' => 'yes',
        ],
      ]
    );

    $this->add_control(
      'currency_symbol',
      [
        'label'   => __( 'Currency Symbol', 'elaet' ),
        'type'    => Controls_Manager::SELECT,
        'options' => [
          ''             => __( 'None', 'elaet' ),
          'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'elaet' ),
          'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'elaet' ),
          'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'elaet' ),
          'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'elaet' ),
          'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'elaet' ),
          'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'elaet' ),
          'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'elaet' ),
          'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'elaet' ),
          'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'elaet' ),
          'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'elaet' ),
          'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'elaet' ),
          'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'elaet' ),
          'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'elaet' ),
          'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'elaet' ),
          'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'elaet' ),
          'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'elaet' ),
          'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'elaet' ),
          'custom'       => __( 'Custom', 'elaet' ),
        ],
        'default' => 'dollar',
      ]
    );

    $this->add_control(
      'currency_symbol_custom',
      [
        'label'     => __( 'Currency Symbol', 'elaet' ),
        'type'      => Controls_Manager::TEXT,
        'condition' => [
          'currency_symbol' => 'custom',
        ],
      ]
    );
    $this->add_control(
      'currency_format',
      [
        'label'   => __( 'Currency Format', 'elaet' ),
        'type'    => Controls_Manager::SELECT,
        'options' => [
          ''  => 'Raised',
          ',' => 'Normal',
        ],
      ]
    );
    
    $this->add_control(
      'duration',
      [
        'label'   => __( 'Duration', 'elaet' ),
        'type'    => Controls_Manager::TEXT,
        'default' => __( 'Annually', 'elaet' ),
        'dynamic' => [
          'active' => true,
        ],
      ]
    );

    $this->add_control(
      'duration_position',
      [
        'label'       => __( 'Duration Position', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'label_block' => false,
        'options'     => [
          'below'  => 'Below',
          'beside' => 'Beside',
        ],
        'default'     => 'below',
        
      ]
    );

    $this->end_controls_section();
  }

/**
   * Register Price Table Content Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_content_controls() {

    $this->start_controls_section(
      'section_features',
      [
        'label' => __( 'Features', 'elaet' ),
      ]
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'item_text',
      [
        'label'   => __( 'Text', 'elaet' ),
        'type'    => Controls_Manager::TEXT,
        'default' => __( 'Feature', 'elaet' ),
        'dynamic' => [
          'active' => true,
        ],
      ]
    );

    $repeater->add_control(
      'item_icon',
      [
        'label'   => __( 'Icon', 'elaet' ),
        'type'    => Controls_Manager::ICON,
        'default' => 'fa fa-arrow-circle-right',
      ]
    );

    $repeater->add_control(
      'item_advanced_settings',
      [
        'label'        => __( 'Change Default Style', 'elaet' ),
        'type'         => Controls_Manager::SWITCHER,
        'label_on'     => __( 'Yes', 'elaet' ),
        'label_off'    => __( 'No', 'elaet' ),
        'return_value' => 'yes',
        'default'      => 'no',
      ]
    );

    $repeater->add_control(
      'item_icon_color',
      [
        'label'     => __( 'Icon Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_4,
        ],
        'condition' => [
          'item_icon!'             => '',
          'item_advanced_settings' => 'yes',
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-features-list {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
        ],
      ]
    );

    $repeater->add_control(
      'item_text_color',
      [
        'label'     => __( 'Text Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'condition' => [
          'item_advanced_settings' => 'yes',
        ],
        'selectors' => [
          '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
        ],
      ]
    );

    $repeater->add_control(
      'item_bg_color',
      [
        'label'     => __( 'Background Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'condition' => [
          'item_advanced_settings' => 'yes',
        ],
        'selectors' => [
          '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}} !important;',
        ],
      ]
    );

    $this->add_control(
      'features_list',
      [
        'type'        => Controls_Manager::REPEATER,
        'fields'      => array_values( $repeater->get_controls() ),
        'default'     => [
          [
            'item_text' => __( '100 GB Web Space', 'elaet' ),
            'item_icon' => '',
          ],
          [
            'item_text' => __( '500K Visits/weekly', 'elaet' ),
            'item_icon' => '',
          ],
          [
            'item_text' => __( 'Unlimited Bandwidth', 'elaet' ),
            'item_icon' => '',
          ],
          [
            'item_text' => __( 'Access to Premium Sites', 'elaet' ),
            'item_icon' => '',
          ],
        ],
        'title_field' => '{{{ item_text }}}',
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Register Price Table Ribbon Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_ribbon_controls() {

    $this->start_controls_section(
      'section_ribbon',
      [
        'label' => __( 'Ribbon', 'elaet' ),
      ]
    );

    $this->add_control(
      'show_ribbon',
      [
        'label'       => __( 'Style', 'elaet' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'none',
        'label_block' => false,
        'options'     => [
          'none' => __( 'None', 'elaet' ),
          '1'    => __( 'Corner Ribbon', 'elaet' ),
          '2'    => __( 'Rounded Ribbon', 'elaet' ),
          '3'    => __( 'Flag Ribbon', 'elaet' ),
        ],
      ]
    );

    $this->add_control(
      'ribbon_title',
      [
        'label'     => __( 'Title', 'elaet' ),
        'type'      => Controls_Manager::TEXT,
        'default'   => __( 'Popular', 'elaet' ),
        'condition' => [
          'show_ribbon!' => 'none',
        ],
      ]
    );

    $this->add_control(
      'ribbon_horizontal_position',
      [
        'label'       => __( 'Horizontal Position', 'elaet' ),
        'type'        => Controls_Manager::CHOOSE,
        'label_block' => false,
        'toggle'      => false,
        'options'     => [
          'left'  => [
            'title' => __( 'Left', 'elaet' ),
            'icon'  => 'eicon-h-align-left',
          ],
          'right' => [
            'title' => __( 'Right', 'elaet' ),
            'icon'  => 'eicon-h-align-right',
          ],
        ],
        'default'     => 'left',
        'condition'   => [
          'show_ribbon!' => [ 'none', '3' ],
        ],
      ]
    );

    $ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

    $this->add_responsive_control(
      'ribbon_distance',
      [
        'label'     => __( 'Distance', 'elaet' ),
        'type'      => Controls_Manager::SLIDER,
        'range'     => [
          'px' => [
            'min' => 10,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-ribbon-1 .elaet-price-table-ribbon-content' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
        ],
        'condition' => [
          'show_ribbon' => '1',
        ],
      ]
    );

    $this->add_responsive_control(
      'ribbon_size',
      [
        'label'     => __( 'Size', 'elaet' ),
        'type'      => Controls_Manager::SLIDER,
        'range'     => [
          'em' => [
            'min' => 1,
            'max' => 20,
          ],
        ],
        'default'   => [
          'size' => '4',
          'unit' => 'em',
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-ribbon-2 .elaet-price-table-ribbon-content' => 'min-height: {{SIZE}}em; min-width: {{SIZE}}em; line-height: {{SIZE}}em; z-index: 1;',
        ],
        'condition' => [
          'show_ribbon' => '2',
        ],
      ]
    );

    $this->add_responsive_control(
      'ribbon_top_distance',
      [
        'label'     => __( 'Top Distance', 'elaet' ),
        'type'      => Controls_Manager::SLIDER,
        'range'     => [
          '%' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-ribbon-3 .elaet-price-table-ribbon-content' => 'top: {{SIZE}}%;',
        ],
        'condition' => [
          'show_ribbon' => '3',
        ],
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Register Price Table Heading Style Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_title_style_controls() {

    $this->start_controls_section(
      'section_header_style',
      [
        'label'      => __( 'Title', 'elaet' ),
        'tab'        => Controls_Manager::TAB_STYLE,
        'show_label' => false,
      ]
    );
    $this->add_control(
      'header_bg_color',
      [
        'label'     => __( 'Background Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'   => '#17848C',
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_2,
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-header' => 'background-color: {{VALUE}};',
        ],
      ]
    );
    $this->add_responsive_control(
      'header_padding',
      [
        'label'      => __( 'Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-pricing-style-5 .elaet-price-table-header,{{WRAPPER}} .elaet-pricing-style-4 .elaet-price-table-header,{{WRAPPER}} .elaet-pricing-style-3 .elaet-pricing-heading-wrap, {{WRAPPER}} .elaet-pricing-style-2 .elaet-price-table-header, {{WRAPPER}} .elaet-pricing-style-1 .elaet-price-table-header,{{WRAPPER}} .elaet-pricing-style-0 .elaet-price-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    $this->add_control(
      'heading_style',
      [
        'label'     => __( 'Title', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );
    $this->add_control(
      'heading_tag',
      [
        'label'   => __( 'Title Tag', 'elaet' ),
        'type'    => Controls_Manager::SELECT,
        'options' => [
          'h1'  => __( 'H1', 'elaet' ),
          'h2'  => __( 'H2', 'elaet' ),
          'h3'  => __( 'H3', 'elaet' ),
          'h4'  => __( 'H4', 'elaet' ),
          'h5'  => __( 'H5', 'elaet' ),
          'h6'  => __( 'H6', 'elaet' ),
        ],
        'default' => 'h3',
      ]
    );
    $this->add_control(
      'heading_color',
      [
        'label'     => __( 'Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default' => '#ffffff',
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-heading' => 'color: {{VALUE}}',
        ],
      ]
    );
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .elaet-price-table-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      ]
    );

    $this->add_control(
      'sub_heading_style',
      [
        'label'     => __( 'Description', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        
      ]
    );
    $this->add_control(
      'sub_heading_tag',
      [
        'label'     => __( 'Description Tag', 'elaet' ),
        'type'      => Controls_Manager::SELECT,
        'options'   => [
          'h1'  => __( 'H1', 'elaet' ),
          'h2'  => __( 'H2', 'elaet' ),
          'h3'  => __( 'H3', 'elaet' ),
          'h4'  => __( 'H4', 'elaet' ),
          'h5'  => __( 'H5', 'elaet' ),
          'h6'  => __( 'H6', 'elaet' ),
          'div' => __( 'div', 'elaet' ),
          'p'   => __( 'p', 'elaet' ),
        ],
        
        'default'   => 'p',
      ]
    );
    $this->add_control(
      'sub_heading_color',
      [
        'label'     => __( 'Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_3,
        ],
        'default' => '#ffffff',
        
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-subheading' => 'color: {{VALUE}}',
        ],
      ]
    );
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'      => 'sub_heading_typography',
        'selector'  => '{{WRAPPER}} .elaet-price-table-subheading',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
        
      ]
    );

    $this->end_controls_section();
  }

   /**
   * Register Price Table CTA style Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_cta_style_controls() {

    $this->start_controls_section(
      'section_footer_style',
      [
        'label'      => __( 'Button', 'elaet' ),
        'tab'        => Controls_Manager::TAB_STYLE,
        'show_label' => false,
        'condition' => [
          'price_cta_type!' => 'none',
        ],
      ]

    );

    $this->add_control(
      'footer_bg_color',
      [
        'label'     => __( 'Background Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'   => '#f7f7f7',
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-cta' => 'background-color: {{VALUE}}',
        ],
      ]
    );

    $this->add_responsive_control(
      'footer_padding',
      [
        'label'      => __( 'Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-price-table-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'heading_footer_link',
      [
        'label'     => __( 'Link', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'price_cta_type' => 'link',
        ],
      ]
    );

    $this->add_control(
      'link_text_color',
      [
        'label'     => __( 'Text Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_4,
        ],
        'selectors' => [
          '{{WRAPPER}} a.elaet-pricebox-cta-link' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'price_cta_type' => 'link',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'      => 'link_typography',
        'selector'  => '{{WRAPPER}} a.elaet-pricebox-cta-link',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
        'condition' => [
          'price_cta_type' => 'link',
        ],
      ]
    );

    $this->add_control(
      'link_text_hover_color',
      [
        'label'     => __( 'Link Hover Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} a.elaet-pricebox-cta-link:hover' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'price_cta_type' => 'link',
        ],
      ]
    );

    $this->add_control(
      'heading_footer_button',
      [
        'label'     => __( 'Button', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'price_cta_type' => 'button',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'      => 'button_typography',
        'selector'  => '{{WRAPPER}} .elementor-button, {{WRAPPER}} a.elementor-button',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
        'condition' => [
          'price_cta_type' => 'button',
        ],
      ]
    );

    $this->add_control(
      'button_size',
      [
        'label'     => __( 'Size', 'elaet' ),
        'type'      => Controls_Manager::SELECT,
        'default'   => 'md',
        'options'   => [
          'xs' => __( 'Extra Small', 'elaet' ),
          'sm' => __( 'Small', 'elaet' ),
          'md' => __( 'Medium', 'elaet' ),
          'lg' => __( 'Large', 'elaet' ),
          'xl' => __( 'Extra Large', 'elaet' ),
        ],
        'condition' => [
          'price_cta_type' => 'button',
        ],
      ]
    );
    $this->add_responsive_control(
      'button_custom_padding',
      [
        'label'      => __( 'Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', 'em', '%' ],
        'selectors'  => [
          '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'condition'  => [
          'price_cta_type' => 'button',
        ],
        'separator'  => 'after',
      ]
    );

    $this->start_controls_tabs( 'tabs_button_style' );

      $this->start_controls_tab(
        'tab_button_normal',
        [
          'label'     => __( 'Normal', 'elaet' ),
          'condition' => [
            'price_cta_type' => 'button',
          ],
        ]
      );

      $this->add_control(
        'cta_text_color',
        [
          'label'     => __( 'Text Color', 'elaet' ),
          'type'      => Controls_Manager::COLOR,
          'default'   => '',
          'selectors' => [
            '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
            '{{WRAPPER}} .elementor-button' => 'border-color: {{VALUE}};',
          ],
          'condition' => [
            'price_cta_type' => 'button',
          ],
        ]
      );

      $this->add_control(
        'button_background_color',
        [
          'label'     => __( 'Background Color', 'elaet' ),
          'type'      => Controls_Manager::COLOR,
           'default'   => '#29c697',
          'scheme'    => [
            'type'  => Scheme_Color::get_type(),
            'value' => Scheme_Color::COLOR_4,
          ],
          'selectors' => [
            '{{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
          ],
          'condition' => [
            'price_cta_type' => 'button',
          ],
        ]
      );

      $this->add_control(
        'button_border',
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
            'price_cta_type' => 'button',
          ],
          'selectors'   => [
            '{{WRAPPER}} .elementor-button' => 'border-style: {{VALUE}};',
          ],
        ]
      );

      $this->add_control(
        'button_border_size',
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
            'price_cta_type' => 'button',
            'button_border!' => 'none',
          ],
          'selectors'  => [
            '{{WRAPPER}} .elaet-price-table .elementor-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );

      $this->add_control(
        'button_border_color',
        [
          'label'     => __( 'Border Color', 'elaet' ),
          'type'      => Controls_Manager::COLOR,
          'condition' => [
            'price_cta_type' => 'button',
            'button_border!' => 'none',
          ],
          'default'   => '',
          'selectors' => [
            '{{WRAPPER}} .elaet-price-table .elementor-button' => 'border-color: {{VALUE}};',
          ],
        ]
      );

      $this->add_responsive_control(
        'button_border_radius',
        [
          'label'      => __( 'Border Radius', 'elaet' ),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%' ],
          'selectors'  => [
            '{{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
          'condition'  => [
            'price_cta_type' => 'button',
          ],
        ]
      );
      $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
          'name'      => 'button_box_shadow',
          'label'     => __( 'Button Shadow', 'elaet' ),
          'condition' => [
            'price_cta_type' => 'button',
          ],
          'selector'  => '{{WRAPPER}} .elementor-button',
        ]
      );

      $this->end_controls_tab();

    $this->start_controls_tab(
      'tab_button_hover',
      [
        'label'     => __( 'Hover', 'elaet' ),
        'condition' => [
          'price_cta_type' => 'button',
        ],
      ]
    );

    $this->add_control(
      'button_hover_color',
      [
        'label'     => __( 'Text Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'price_cta_type' => 'button',
        ],
      ]
    );

    $this->add_control(
      'button_background_hover_color',
      [
        'label'     => __( 'Background Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .elementor-button:hover' => 'background-color: {{VALUE}};',
        ],
        'condition' => [
          'price_cta_type' => 'button',
        ],
      ]
    );

    $this->add_control(
      'button_hover_border_color',
      [
        'label'     => __( 'Border Hover Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .elementor-button:hover' => 'border-color: {{VALUE}};',
        ],
        'condition' => [
          'price_cta_type' => 'button',
          'button_border!' => 'none',
        ],
      ]
    );
    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
        'name'      => 'button_hover_box_shadow',
        'label'     => __( 'Hover Shadow', 'elaet' ),
        'selector'  => '{{WRAPPER}} .elementor-button:hover',
        'separator' => 'before',
        'condition' => [
          'price_cta_type' => 'button',
        ],
      ]
    );

    $this->add_control(
      'button_hover_animation',
      [
        'label'     => __( 'Animation', 'elaet' ),
        'type'      => Controls_Manager::HOVER_ANIMATION,
        'condition' => [
          'price_cta_type' => 'button',
        ],
      ]
    );

    $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->add_control(
      'heading_additional_info',
      [
        'label'     => __( 'Disclaimer Text', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'footer_additional_info!' => '',
        ],
      ]
    );
    $this->add_control(
      'additional_info_color',
      [
        'label'     => __( 'Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_3,
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-disclaimer' => 'color: {{VALUE}}',
        ],
        'condition' => [
          'footer_additional_info!' => '',
        ],
      ]
    );
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'      => 'additional_info_typography',
        'selector'  => '{{WRAPPER}} .elaet-price-table-disclaimer',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_3,
        'condition' => [
          'footer_additional_info!' => '',
        ],
      ]
    );

    $this->add_control(
      'additional_info_margin',
      [
        'label'      => __( 'Margin', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'default'    => [
          'top'    => 20,
          'right'  => 20,
          'bottom' => 20,
          'left'   => 20,
          'unit'   => 'px',
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-price-table-disclaimer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        ],
        'condition'  => [
          'footer_additional_info!' => '',
        ],
      ]
    );
    $this->end_controls_section();
  }

  /**
   * Register Price Table Pricing Style Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_pricing_style_controls() {

    $this->start_controls_section(
      'section_pricing_element_style',
      [
        'label'      => __( 'Pricing', 'elaet' ),
        'tab'        => Controls_Manager::TAB_STYLE,
        'show_label' => false,
      ]
    );

    $this->add_control(
      'pricing_element_bg_color',
      [
        'label'     => __( 'Background Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'   => '#17848c',
        'selectors' => [
          '{{WRAPPER}} .elaet-pricing-style-5 .elaet-price-table-price-wrap, {{WRAPPER}} .elaet-pricing-style-4 .elaet-price-table-price-wrap, {{WRAPPER}} .elaet-pricing-style-3 .elaet-price-table-pricing, {{WRAPPER}} .elaet-pricing-style-2 .elaet-price-table-price-wrap, {{WRAPPER}} .elaet-pricing-style-1 .elaet-price-table-price-wrap, {{WRAPPER}} .elaet-pricing-style-0 .elaet-price-table-price-wrap' => 'background-color: {{VALUE}}',
        ],
      ]
    );

    $this->add_responsive_control(
      'price_bg_size',
      [
        'label'      => __( 'Background Size', 'elaet' ),
        'type'       => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em' ],
        'range'      => [
          'px' => [
            'min' => 100,
            'max' => 300,
          ],
          'em' => [
            'min' => 5,
            'max' => 20,
          ],
        ],
        'default'    => [
          'size' => '9',
          'unit' => 'em',
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-pricing-style-3 .elaet-price-table-pricing' => 'min-height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; margin-top: calc( -{{SIZE}}{{UNIT}} / 2 ); box-sizing: content-box;',
          '{{WRAPPER}} .elaet-pricing-style-3 .elaet-price-table-header' => 'padding-bottom: calc( {{SIZE}}{{UNIT}} / 2 );',
        ],
        'condition'  => [
          'pricetable_style' => '3',
        ],
      ]
    );

    $this->add_responsive_control(
      'pricing_element_padding',
      [
        'label'      => __( 'Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'condition'  => [
          'pricetable_style!' => '3',
        ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-price-table-price-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      [
        'name'           => 'price_border_style3',
        'label'          => __( 'Border', 'elaet' ),
        'fields_options' => [
          'border' => [
            'default' => 'solid',
          ],
          'width'  => [
            'default' => [
              'top'    => '3',
              'right'  => '3',
              'bottom' => '3',
              'left'   => '3',
            ],
          ],
        ],
        'condition'      => [
          'pricetable_style' => '3',
        ],
        'selector'       => '{{WRAPPER}} .elaet-pricing-style-3 .elaet-price-table-pricing',
      ]
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
        'name'      => 'section_price_shadow',
        'condition' => [
          'pricetable_style' => '3',
        ],
        'selector'  => '{{WRAPPER}} .elaet-price-table-pricing',
      ]
    );

    $this->add_control(
      'main_price_style',
      [
        'label'     => __( 'Price', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_control(
      'price_color',
      [
        'label'     => __( 'Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'   => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-currency, {{WRAPPER}} .elaet-price-table-integer-part, {{WRAPPER}} .elaet-price-table-fractional-part, {{WRAPPER}} .elaet-price-currency-normal' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'price_typography',
        'selector' => '{{WRAPPER}} .elaet-pricing-value',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      ]
    );

    $this->add_control(
      'heading_currency_style',
      [
        'label'     => __( 'Currency Symbol', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'currency_symbol!' => '',
          'currency_format!' => ',',
        ],
      ]
    );

    $this->add_responsive_control(
      'currency_size',
      [
        'label'     => __( 'Size', 'elaet' ),
        'type'      => Controls_Manager::SLIDER,
        'range'     => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-currency' => 'font-size: calc({{SIZE}}em/100)',
        ],
        'condition' => [
          'currency_symbol!' => '',
          'currency_format!' => ',',
        ],
      ]
    );

    $this->add_control(
      'currency_vertical_position',
      [
        'label'                => __( 'Vertical Position', 'elaet' ),
        'type'                 => Controls_Manager::CHOOSE,
        'label_block'          => false,
        'options'              => [
          'top'    => [
            'title' => __( 'Top', 'elaet' ),
            'icon'  => 'eicon-v-align-top',
          ],
          'middle' => [
            'title' => __( 'Middle', 'elaet' ),
            'icon'  => 'eicon-v-align-middle',
          ],
          'bottom' => [
            'title' => __( 'Bottom', 'elaet' ),
            'icon'  => 'eicon-v-align-bottom',
          ],
        ],
        'condition'            => [
          'currency_symbol!' => '',
          'currency_format!' => ',',
        ],
        'default'              => 'top',
        'selectors_dictionary' => [
          'top'    => 'flex-start',
          'middle' => 'center',
          'bottom' => 'flex-end',
        ],
        'selectors'            => [
          '{{WRAPPER}} .elaet-price-table-currency' => 'align-self: {{VALUE}}',
        ],
      ]
    );
    $this->add_control(
      'fractional_part_style',
      [
        'label'     => __( 'Fractional Part', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'currency_format!' => ',',
        ],
      ]
    );

    $this->add_responsive_control(
      'fractional_part_size',
      [
        'label'     => __( 'Size', 'elaet' ),
        'type'      => Controls_Manager::SLIDER,
        'range'     => [
          'px' => [
            'min' => 1,
            'max' => 100,
          ],
        ],
        'condition' => [
          'currency_format!' => ',',
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-fractional-part' => 'font-size: calc({{SIZE}}em/100)',
        ],
      ]
    );

    $this->add_control(
      'fractional_part_position',
      [
        'label'                => __( 'Vertical Position', 'elaet' ),
        'type'                 => Controls_Manager::CHOOSE,
        'label_block'          => false,
        'options'              => [
          'top'    => [
            'title' => __( 'Top', 'elaet' ),
            'icon'  => 'eicon-v-align-top',
          ],
          'middle' => [
            'title' => __( 'Middle', 'elaet' ),
            'icon'  => 'eicon-v-align-middle',
          ],
          'bottom' => [
            'title' => __( 'Bottom', 'elaet' ),
            'icon'  => 'eicon-v-align-bottom',
          ],
        ],
        'default'              => 'top',
        'selectors_dictionary' => [
          'top'    => 'flex-start',
          'middle' => 'center',
          'bottom' => 'flex-end',
        ],
        'condition'            => [
          'currency_format!' => ',',
        ],
        'selectors'            => [
          '{{WRAPPER}} .elaet-price-table-beside-price' => 'align-self: {{VALUE}}',
        ],
      ]
    );

    $this->add_control(
      'heading_original_price_style',
      [
        'label'     => __( 'Original Price', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'sale'            => 'yes',
          'original_price!' => '',
        ],
      ]
    );

    $this->add_control(
      'original_price_color',
      [
        'label'     => __( 'Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_2,
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-original-price' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'sale'            => 'yes',
          'original_price!' => '',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'      => 'original_price_typography',
        'selector'  => '{{WRAPPER}} .elaet-price-table-original-price',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
        'condition' => [
          'sale'            => 'yes',
          'original_price!' => '',
        ],
      ]
    );

    $this->add_control(
      'original_price_vertical_position',
      [
        'label'                => __( 'Vertical Position', 'elaet' ),
        'type'                 => Controls_Manager::CHOOSE,
        'label_block'          => false,
        'options'              => [
          'top'    => [
            'title' => __( 'Top', 'elaet' ),
            'icon'  => 'eicon-v-align-top',
          ],
          'middle' => [
            'title' => __( 'Middle', 'elaet' ),
            'icon'  => 'eicon-v-align-middle',
          ],
          'bottom' => [
            'title' => __( 'Bottom', 'elaet' ),
            'icon'  => 'eicon-v-align-bottom',
          ],
        ],
        'selectors_dictionary' => [
          'top'    => 'flex-start',
          'middle' => 'center',
          'bottom' => 'flex-end',
        ],
        'default'              => 'middle',
        'selectors'            => [
          '{{WRAPPER}} .elaet-price-table-original-price' => 'align-self: {{VALUE}}',
        ],
        'condition'            => [
          'sale'            => 'yes',
          'original_price!' => '',
        ],
      ]
    );

    $this->add_control(
      'heading_duration_style',
      [
        'label'     => __( 'Duration', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'duration!' => '',
        ],
      ]
    );

    $this->add_control(
      'duration_color',
      [
        'label'     => __( 'Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_2,
        ],
        'default' => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-duration' => 'color: {{VALUE}}',
        ],
        'condition' => [
          'duration!' => '',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'      => 'duration_typography',
        'selector'  => '{{WRAPPER}} .elaet-price-table-duration',
        'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
        'condition' => [
          'duration!' => '',
        ],
      ]
    );

    $this->add_control(
      'duration_part_position',
      [
        'label'                => __( 'Vertical Position', 'elaet' ),
        'type'                 => Controls_Manager::CHOOSE,
        'label_block'          => false,
        'options'              => [
          'top'    => [
            'title' => __( 'Top', 'elaet' ),
            'icon'  => 'eicon-v-align-top',
          ],
          'middle' => [
            'title' => __( 'Middle', 'elaet' ),
            'icon'  => 'eicon-v-align-middle',
          ],
          'bottom' => [
            'title' => __( 'Bottom', 'elaet' ),
            'icon'  => 'eicon-v-align-bottom',
          ],
        ],
        'default'              => 'bottom',
        'selectors_dictionary' => [
          'top'    => 'flex-start',
          'middle' => 'center',
          'bottom' => 'flex-end',
        ],
        'condition'            => [
          'duration_position' => 'beside',
          'currency_format'   => ',',
          
        ],
        'selectors'            => [
          '{{WRAPPER}} .elaet-price-table-beside-price' => 'align-self: {{VALUE}}',
        ],
      ]
    );

    $this->end_controls_section();
  }


  /**
   * Register Price Table Content Style Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_content_style_controls() {

    $this->start_controls_section(
      'section_features_list_style',
      [
        'label'      => __( 'Features', 'elaet' ),
        'tab'        => Controls_Manager::TAB_STYLE,
        'show_label' => false,
      ]
    );

    $this->add_control(
      'price_features_layout',
      [
        'label'        => __( 'Layout', 'elaet' ),
        'type'         => Controls_Manager::SELECT,
        'default'      => 'simple',
        'label_block'  => false,
        'options'      => [
          'simple'    => __( 'Simple', 'elaet' ),
          'divider'   => __( 'Divider between fields', 'elaet' ),
          'borderbox' => __( 'Box Layout', 'elaet' ),
          'strips'    => __( 'Stripped Layout', 'elaet' ),
        ],
        'prefix_class' => 'elaet-price-features-',
      ]
    );

    $this->add_control(
      'features_list_bg_color',
      [
        'label'     => __( 'Background Color 1', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'  => '#f7f7f7',
        // 'condition' => [
          // 'price_features_layout!' => 'strips',
        // ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-features-list, {{WRAPPER}} .elaet-pricing-style-3 .elaet-price-table-price-wrap' => 'background-color: {{VALUE}}',
        ],
      ]
    );
    $this->add_control(
      'features_list_flex_bg_color',
      [
        'label'     => __( 'Background Color 2', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'  => '#f7f7f7',
        'condition' => [
          // 'price_features_layout!' => 'strips',
           'pricetable_style'      => '4',
        ],
        'selectors' => [
          '{{WRAPPER}} .clearfix' => 'background-color: {{VALUE}}',
        ],
      ]
    );


    $this->add_responsive_control(
      'features_list_padding',
      [
        'label'      => __( 'Box Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-price-table-features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'features_list_style_fields',
      [
        'label'     => __( 'Features List', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_responsive_control(
      'features_icon_spacing',
      [
        'label'     => __( 'Icon Spacing', 'elaet' ),
        'type'      => Controls_Manager::SLIDER,
        'default'   => [
          'size' => 5,
          'unit' => 'px',
        ],
        'range'     => [
          'px' => [
            'min' => 0,
            'max' => 20,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-features-list i' => 'margin-right: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'features_icon_color',
      [
        'label'     => __( 'Icon Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-features-list i' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_control(
      'features_list_color',
      [
        'label'     => __( 'Text Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_3,
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-features-list' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'features_list_typography',
        'selector' => '{{WRAPPER}} .elaet-price-table-features-list li',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
      ]
    );

    $this->add_responsive_control(
      'features_rows_padding',
      [
        'label'      => __( 'Item Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-price-table-feature-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'features_list_alignment',
      [
        'label'       => __( 'Alignment', 'elaet' ),
        'type'        => Controls_Manager::CHOOSE,
        'label_block' => false,
        'options'     => [
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
        'selectors'   => [
          '{{WRAPPER}} .elaet-price-table-features-list' => 'text-align: {{VALUE}}',
        ],
      ]
    );

    $this->add_control(
      'features_list_divider_heading',
      [
        'label'     => __( 'Divider', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'price_features_layout' => 'divider',
        ],
      ]
    );

    $this->add_control(
      'features_list_borderbox',
      [
        'label'     => __( 'Box Layout', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'price_features_layout' => 'borderbox',
        ],
      ]
    );

    $this->add_control(
      'divider_style',
      [
        'label'     => __( 'Style', 'elaet' ),
        'type'      => Controls_Manager::SELECT,
        'options'   => [
          'solid'  => __( 'Solid', 'elaet' ),
          'double' => __( 'Double', 'elaet' ),
          'dotted' => __( 'Dotted', 'elaet' ),
          'dashed' => __( 'Dashed', 'elaet' ),
        ],
        'condition' => [
          'price_features_layout' => [ 'divider', 'borderbox' ],
        ],
        'default'   => 'solid',
        'selectors' => [
          '{{WRAPPER}}.elaet-price-features-divider .elaet-price-table-features-list li:before, {{WRAPPER}}.elaet-price-features-borderbox .elaet-price-table-features-list li:before, {{WRAPPER}}.elaet-price-features-borderbox .elaet-price-table-features-list li:after' => 'border-top-style: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'divider_color',
      [
        'label'     => __( 'Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'   => '#ddd',
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_3,
        ],
        'condition' => [
          'price_features_layout' => [ 'divider', 'borderbox' ],
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-features-list li:before, {{WRAPPER}}.elaet-price-features-borderbox .elaet-price-table-features-list li:after' => 'border-top-color: {{VALUE}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'divider_weight',
      [
        'label'     => __( 'Weight', 'elaet' ),
        'type'      => Controls_Manager::SLIDER,
        'default'   => [
          'size' => 1,
          'unit' => 'px',
        ],
        'range'     => [
          'px' => [
            'min' => 1,
            'max' => 20,
          ],
        ],
        'condition' => [
          'price_features_layout' => [ 'divider', 'borderbox' ],
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-features-list li:before, {{WRAPPER}}.elaet-price-features-borderbox .elaet-price-table-features-list li:after' => 'border-top-width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->add_responsive_control(
      'divider_width',
      [
        'label'     => __( 'Width', 'elaet' ),
        'type'      => Controls_Manager::SLIDER,
        'default'   => [
          'size' => '60',
          'unit' => 'px',
        ],
        'condition' => [
          'price_features_layout' => 'divider',
        ],
        'selectors' => [
          '{{WRAPPER}}.elaet-price-features-divider .elaet-price-table-features-list li:before' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
        ],
      ]
    );

    $this->add_control(
      'features_even_odd_fields',
      [
        'label'     => __( 'Stripped Layout', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'price_features_layout' => 'strips',
        ],
      ]
    );

    $this->start_controls_tabs( 'features_list_style' );

    $this->start_controls_tab(
      'features_even',
      [
        'label'     => __( 'Even', 'elaet' ),
        'condition' => [
          'price_features_layout' => 'strips',
        ],
      ]
    );

    $this->add_control(
      'features_bg_color_even',
      [
        'label'     => __( 'Background Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'   => '#FFFFFF',
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table .elaet-price-table-features-list li:nth-child(even)' => 'background-color: {{VALUE}}',
        ],
        'condition' => [
          'price_features_layout' => 'strips',
        ],
      ]
    );

    $this->add_control(
      'features_text_color_even',
      [
        'label'     => __( 'Text Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'   => '',
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table .elaet-price-table-features-list li:nth-child(even)' => 'color: {{VALUE}}',
        ],
        'condition' => [
          'price_features_layout' => 'strips',
        ],
      ]
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
      'tab_features_odd',
      [
        'label'     => __( 'Odd', 'elaet' ),
        'condition' => [
          'price_features_layout' => 'strips',
        ],
      ]
    );

    $this->add_control(
      'table_features_bg_color_odd',
      [
        'label'     => __( 'Background Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'   => '#eaeaea',
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table .elaet-price-table-features-list li:nth-child(odd)' => 'background-color: {{VALUE}}',
        ],
        'condition' => [
          'price_features_layout' => 'strips',
        ],
      ]
    );

    $this->add_control(
      'table_features_text_color_odd',
      [
        'label'     => __( 'Text Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'   => '',
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table .elaet-price-table-features-list li:nth-child(odd)' => 'color: {{VALUE}}',
        ],
        'condition' => [
          'price_features_layout' => 'strips',
        ],
      ]
    );

    $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->add_responsive_control(
      'features_spacing',
      [
        'label'     => __( 'Item Spacing', 'elaet' ),
        'type'      => Controls_Manager::SLIDER,
        'range'     => [
          'px' => [
            'min' => 0,
            'max' => 50,
          ],
        ],
        'default'   => [
          'size' => '0',
          'unit' => 'px',
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table .elaet-price-table-features-list li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'price_features_layout' => 'strips',
        ],
      ]
    );

    $this->end_controls_section();
  }

  
  /**
   * Register Price Table Ribbon Style Controls.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function register_ribbon_style_controls() {

    $this->start_controls_section(
      'section_ribbon_style',
      [
        'label'      => __( 'Ribbon', 'elaet' ),
        'tab'        => Controls_Manager::TAB_STYLE,
        'show_label' => false,
        'condition'  => [
          'show_ribbon!' => 'none',
        ],
      ]
    );
    $this->add_control(
      'ribbon_bg_color',
      [
        'label'     => __( 'Background Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'scheme'    => [
          'type'  => Scheme_Color::get_type(),
          'value' => Scheme_Color::COLOR_4,
        ],
        'default' => '#ea0000',
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-ribbon-content' => 'background-color: {{VALUE}}',
          '{{WRAPPER}} .elaet-price-table-ribbon-3 .elaet-price-table-ribbon-content:before' => 'border-left: 8px solid {{VALUE}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'ribbon_padding',
      [
        'label'      => __( 'Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-price-table-ribbon-3 .elaet-price-table-ribbon-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'separator'  => 'after',
        'condition'  => [
          'show_ribbon' => '3',
        ],
      ]
    );

    $this->add_control(
      'ribbon_text_color',
      [
        'label'     => __( 'Text Color', 'elaet' ),
        'type'      => Controls_Manager::COLOR,
        'default'   => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .elaet-price-table-ribbon-content' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'ribbon_typography',
        'selector' => '{{WRAPPER}} .elaet-price-table-ribbon-content',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
      ]
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
        'name'     => 'box_shadow',
        'selector' => '{{WRAPPER}} .elaet-price-table-ribbon-content',
      ]
    );
    $this->end_controls_section();
  }

  

  /**
   * Method render_button
   *
   * @since 0.0.1
   * @access public
   * @param object $settings for settings.
   */
  public function render_button( $settings ) {
    if ( 'link' == $settings['price_cta_type'] ) {

      $_nofollow = ( 'on' == $settings['link']['nofollow'] ) ? 'nofollow' : '';
      $_target   = ( 'on' == $settings['link']['is_external'] ) ? '_blank' : '';
      $_link     = ( isset( $settings['link']['url'] ) ) ? $settings['link']['url'] : '';

      if ( ! empty( $settings['link']['url'] ) ) {

        $this->add_render_attribute( 'cta_link', 'href', $settings['link']['url'] );
        $this->add_render_attribute( 'cta_link', 'class', 'elaet-pricebox-cta-link' );

        if ( $settings['link']['is_external'] ) {
          $this->add_render_attribute( 'cta_link', 'target', '_blank' );
        }
        if ( $settings['link']['nofollow'] ) {
          $this->add_render_attribute( 'cta_link', 'rel', 'nofollow' );
        }
      }
      ?>
      <a <?php echo $this->get_render_attribute_string( 'cta_link' ); ?>>
        <?php
        if ( ! empty( $settings['cta_icon'] ) && ( 'left' == $settings['cta_icon_position'] ) ) {
          ?>
          <i class="elaet-cta-link-icon elaet-cta-link-icon-before fa <?php echo $settings['cta_icon']; ?>"></i>
          <?php } ?>
          <?php
          if ( ! empty( $settings['cta_text'] ) ) {
            ?>
            <span class="elementor-inline-editing" data-elementor-setting-key="cta_text" data-elementor-inline-editing-toolbar="basic"><?php echo $settings['cta_text']; ?></span>
          <?php } ?>
        <?php
        if ( ! empty( $settings['cta_icon'] ) && 'right' == $settings['cta_icon_position'] ) {
          ?>
          <i class="elaet-cta-link-icon elaet-cta-link-icon-after fa <?php echo $settings['cta_icon']; ?>"></i>
        <?php } ?>
      </a>
      <?php
    } elseif ( 'button' == $settings['price_cta_type'] ) {

      $this->add_render_attribute( 'wrapper', 'class', 'elaet-button-wrapper elementor-button-wrapper' );
      if ( ! empty( $settings['link']['url'] ) ) {
        $this->add_render_attribute( 'button', 'href', $settings['link']['url'] );
        $this->add_render_attribute( 'button', 'class', 'elementor-button-link' );

        if ( $settings['link']['is_external'] ) {
          $this->add_render_attribute( 'button', 'target', '_blank' );
        }
        if ( $settings['link']['nofollow'] ) {
          $this->add_render_attribute( 'button', 'rel', 'nofollow' );
        }
      }
      $this->add_render_attribute( 'button', 'class', ' elementor-button' );
      if ( ! empty( $settings['button_size'] ) ) {
        $this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['button_size'] );
      }
      if ( ! empty( $settings['button_hover_animation'] ) ) {
        $this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
      }
      ?>
      <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
        <a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
          <?php
            $this->add_render_attribute( 'text', 'class', 'elementor-button-text' );
            $this->add_render_attribute( 'text', 'class', 'elementor-inline-editing' );
          ?>
          <?php
          if ( ! empty( $settings['cta_icon'] ) && ( 'left' == $settings['cta_icon_position'] ) ) {
            ?>
            <i class="elaet-cta-link-icon elaet-cta-link-icon-before fa <?php echo $settings['cta_icon']; ?>"></i>
          <?php } ?>
          <?php
          if ( ! empty( $settings['cta_text'] ) ) {
          ?>
          <span <?php echo $this->get_render_attribute_string( 'text' ); ?>  data-elementor-setting-key="cta_text" data-elementor-inline-editing-toolbar="none"><?php echo $settings['cta_text']; ?></span>
          <?php } ?>
          <?php
          if ( ! empty( $settings['cta_icon'] ) && 'right' == $settings['cta_icon_position'] ) {
            ?>
            <i class="elaet-cta-link-icon elaet-cta-link-icon-after fa <?php echo $settings['cta_icon']; ?>"></i>
        <?php } ?>
        </a>
      </div>    
      <?php
    }
  }

  /**
   * Method get_currency_symbol.
   *
   * @since 0.0.1
   * @access public
   * @param object $symbol_name for currency symbol.
   */
  private function get_currency_symbol( $symbol_name ) {
    $symbols = [
      'dollar'       => '&#36;',
      'franc'        => '&#8355;',
      'euro'         => '&#128;',
      'ruble'        => '&#8381;',
      'pound'        => '&#163;',
      'indian_rupee' => '&#8377;',
      'baht'         => '&#3647;',
      'shekel'       => '&#8362;',
      'yen'          => '&#165;',
      'guilder'      => '&fnof;',
      'won'          => '&#8361;',
      'peso'         => '&#8369;',
      'lira'         => '&#8356;',
      'peseta'       => '&#8359',
      'rupee'        => '&#8360;',
      'real'         => 'R$',
      'krona'        => 'kr',
    ];
    return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
  }

  /**
   * Method render_heading_text
   *
   * @since 0.0.1
   * @access public
   * @param object $settings for settings.
   */
  public function render_heading_text( $settings ) {
    if ( $settings['heading'] ) :
      if ( ! empty( $settings['heading'] ) ) :
      ?>
        <div class="elaet-price-heading-text">
          <<?php echo $settings['heading_tag']; ?> class="elaet-price-table-heading elementor-inline-editing" data-elementor-setting-key="heading" data-elementor-inline-editing-toolbar="basic"><?php echo $settings['heading']; ?>
          </<?php echo $settings['heading_tag']; ?>>
        </div>
      <?php
      endif;
    endif;
  }

  /**
   * Method render_subheading_text
   *
   * @since 0.0.1
   * @access public
   * @param object $settings for settings.
   */
  public function render_subheading_text( $settings ) {

    if ( ! empty( $settings['sub_heading'] ) || ! empty( $settings['sub_heading_style2'] ) ) :
    ?>
      <div class="elaet-price-subheading-text">
       
          <<?php echo $settings['sub_heading_tag']; ?> class="elaet-price-table-subheading elementor-inline-editing" data-elementor-setting-key="sub_heading" data-elementor-inline-editing-toolbar="basic">
            <?php echo $settings['sub_heading']; ?>
          </<?php echo $settings['sub_heading_tag']; ?>>
       
      </div>
    <?php
    endif;
  }

  /**
   * Method render_header
   *
   * @since 0.0.1
   * @access public
   * @param object $settings for settings.
   */
  public function render_style_header( $settings ) {

    
      if ( $settings['heading'] || $settings['sub_heading'] ) :
      ?>
        <div class="elaet-price-table-header">
          <div class="elaet-pricing-heading-wrap">
            <?php $this->render_heading_text( $settings ); ?>       
            <?php $this->render_subheading_text( $settings ); ?>
          </div>
        </div>
      <?php
      endif;
    
  }

  /**
   * Method render_price
   *
   * @since 0.0.1
   * @access public
   * @param object $settings for settings.
   */
  public function render_price( $settings ) {
    $symbols = '';

    if ( ! empty( $settings['currency_symbol'] ) ) {
      if ( 'custom' !== $settings['currency_symbol'] ) {
        $symbol = $this->get_currency_symbol( $settings['currency_symbol'] );
      } else {
        $symbol = $settings['currency_symbol_custom'];
      }
    }

    $currency_format = empty( $settings['currency_format'] ) ? '.' : $settings['currency_format'];
    $price           = explode( $currency_format, $settings['price'] );
    $intvalue        = $price[0];
    $fraction        = '';
    if ( 2 === count( $price ) ) {
      $fraction = $price[1];
    }

    $duration_position = $settings['duration_position'];
    $duration_element  = '<span class="elaet-price-table-duration elaet-price-typo-excluded elementor-inline-editing" data-elementor-setting-key="duration" data-elementor-inline-editing-toolbar="basic">' . $settings['duration'] . '</span>';
  ?>
    <div class="elaet-price-table-price-wrap">
      <div class="elaet-price-table-pricing">
        <div class="elaet-pricing-container">
          <div class="elaet-pricing-value">
            <?php if ( 'yes' === $settings['sale'] && ! empty( $settings['original_price'] ) ) : ?>
              <span class="elaet-price-table-original-price elaet-price-typo-excluded"><?php echo $symbol . $settings['original_price']; ?></span>
            <?php endif; ?>

            <?php if ( ! empty( $symbol ) && ',' != $settings['currency_format'] ) : ?>
              <span class="elaet-price-table-currency"><?php echo $symbol; ?></span>
            <?php endif; ?>

            <?php if ( ! empty( $intvalue ) || 0 <= $intvalue ) : ?>
              <?php if ( ! empty( $symbol ) && ',' == $settings['currency_format'] ) : ?>
                  <span class="elaet-price-currency-normal"><?php echo $symbol; ?></span>
                <?php endif; ?>
              <span class="elaet-price-table-integer-part"><?php echo $intvalue; ?></span>
            <?php endif; ?>

            <?php if ( '' !== $fraction || ( ! empty( $settings['duration'] ) && 'beside' === $duration_position ) ) : ?>
              <span class="elaet-price-table-beside-price">
                <span class="elaet-price-table-fractional-part"><?php echo $fraction; ?></span>
                <?php if ( ! empty( $settings['duration'] ) && 'beside' === $duration_position && '3' != $settings['pricetable_style'] ) : ?>
                  <?php echo $duration_element; ?>
                <?php endif; ?>
              </span>
            <?php endif; ?>
          </div>
          <?php if ( ! empty( $settings['duration'] ) ) : ?>
            <?php if ( '3' === $settings['pricetable_style'] || 'below' === $settings['duration_position'] ) : ?>
              <div class="elaet-pricing-duration">
                <?php echo $duration_element; ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php
  }

  /**
   * Method render_features
   *
   * @since 0.0.1
   * @access public
   * @param object $settings for settings.
   */
  public function render_features( $settings ) {

    if ( ! empty( $settings['features_list'] ) ) :
      ?>
      <ul class="elaet-price-table-features-list">
        <?php foreach ( $settings['features_list'] as  $index => $item ) : ?>
          <?php
          $title_key = $this->get_repeater_setting_key( 'item_text', 'features_list', $index );
          $this->add_inline_editing_attributes( $title_key, 'basic' );
          ?>
          <li class="elementor-repeater-item-<?php echo $item['_id']; ?>" style="margin: 0;">
            <div class="elaet-price-table-feature-content">
              <?php if ( ! empty( $item['item_icon'] ) ) : ?>
                <i class="<?php echo esc_attr( $item['item_icon'] ); ?>"></i>
              <?php endif; ?>
              <?php
              if ( ! empty( $item['item_text'] ) ) :
              ?>
              <span <?php echo $this->get_render_attribute_string( $title_key ); ?>><?php echo $item['item_text']; ?></span>
              <?php
              else :
                echo '&nbsp;';
              endif;
              ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <?php
    endif;
  }

  /**
   * Method render_cta
   *
   * @since 0.0.1
   * @access public
   * @param object $settings for settings.
   */
  public function render_cta( $settings ) {
    if ( 'none' != $settings['price_cta_type'] || ! empty( $settings['footer_additional_info'] ) ) :
      if ( ! empty( $settings['cta_text'] ) || ! empty( $settings['footer_additional_info'] ) || ! empty( $settings['cta_icon'] ) ) :
      ?>
        <div class="elaet-price-table-cta">
          <?php if ( 'none' != $settings['price_cta_type'] ) : ?>
              <?php $this->render_button( $settings ); ?>
          <?php endif; ?>

          <?php if ( ! empty( $settings['footer_additional_info'] ) ) : ?>
            <div class="elaet-price-table-disclaimer elementor-inline-editing" data-elementor-setting-key="footer_additional_info" data-elementor-inline-editing-toolbar="basic"><?php echo $settings['footer_additional_info']; ?></div>
          <?php endif; ?>
        </div>
      <?php
      endif;
    endif;
  }


  /**
   * Method render_ribbon
   *
   * @since 0.0.1
   * @access public
   * @param object $settings for settings.
   */
  public function render_ribbon( $settings ) {
    $ribbon_style = '';

    if ( ! empty( $settings['ribbon_title'] ) ) :
      if ( 'none' != $settings['show_ribbon'] ) :
        if ( '1' == $settings['show_ribbon'] ) {
          $ribbon_style = '1';
        } elseif ( '2' == $settings['show_ribbon'] ) {
          $ribbon_style = '2';
        } elseif ( '3' == $settings['show_ribbon'] ) {
          $ribbon_style = '3';
        }

        $this->add_render_attribute( 'ribbon-wrapper', 'class', 'elaet-price-table-ribbon-' . $ribbon_style );

        if ( ! empty( $settings['ribbon_horizontal_position'] ) ) :
          $this->add_render_attribute( 'ribbon-wrapper', 'class', 'elaet-ribbon-' . $settings['ribbon_horizontal_position'] );
        endif;

        ?>
        <div <?php echo $this->get_render_attribute_string( 'ribbon-wrapper' ); ?>>
          <div class="elaet-price-table-ribbon-content elementor-inline-editing" data-elementor-setting-key="ribbon_title" data-elementor-inline-editing-toolbar="none"><?php echo $settings['ribbon_title']; ?></div>
        </div>
      <?php
      endif;
    endif;
  }

  /**
   * Render Price Table output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function render() {
    $settings = $this->get_settings_for_display();
    

    if ( '1' == $settings['pricetable_style'] ) {
  ?>
  <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-<?php echo $settings['pricetable_style']; ?>">
    <div class="elaet-price-table">
      <?php $this->render_style_header( $settings ); ?>       
      <?php $this->render_price( $settings ); ?>
      <?php $this->render_features( $settings ); ?>
      <?php $this->render_cta( $settings ); ?>
    </div>
    <?php $this->render_ribbon( $settings ); ?>
  </div>
  <?php
} elseif ( '2' == $settings['pricetable_style'] ) {
  ?>
  <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-<?php echo $settings['pricetable_style']; ?>">
    <div class="elaet-price-table">
      <?php $this->render_style_header( $settings ); ?>       
      <?php $this->render_price( $settings ); ?>
      <?php $this->render_cta( $settings ); ?>
      <?php $this->render_features( $settings ); ?>
    </div>
    <?php $this->render_ribbon( $settings ); ?>
  </div>
  <?php
} elseif ( '3' == $settings['pricetable_style'] ) {
  ?>
  <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-<?php echo $settings['pricetable_style']; ?>">
    <div class="elaet-price-table">
      <?php $this->render_style_header( $settings ); ?>       
      <?php $this->render_price( $settings ); ?>
      <?php $this->render_features( $settings ); ?>
      <?php $this->render_cta( $settings ); ?>
    </div>
    <?php $this->render_ribbon( $settings ); ?>
  </div>
  <?php
}elseif ( '4' == $settings['pricetable_style'] ) {
  ?>
  <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-<?php echo $settings['pricetable_style']; ?>">
    <div class="elaet-price-table clearfix">
      <div class="elaet-price-table-layout-4-1">
        <?php $this->render_style_header( $settings ); ?>       
        <?php $this->render_price( $settings ); ?>
        <?php $this->render_cta( $settings ); ?>
      </div>
      <div class="elaet-price-table-layout-4-2">
        <?php $this->render_features( $settings ); ?>
      </div>
    </div>
    <?php $this->render_ribbon( $settings ); ?>
  </div>
  <?php
}elseif ( '5' == $settings['pricetable_style'] ) {
  ?>
  <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-<?php echo $settings['pricetable_style']; ?>">
    <div class="elaet-price-table">
      <?php $this->render_style_header( $settings ); ?>       
      <?php $this->render_features( $settings ); ?>
      <?php $this->render_price( $settings ); ?>
      <?php $this->render_cta( $settings ); ?>
    </div>
    <?php $this->render_ribbon( $settings ); ?>
  </div>
  <?php
}elseif ( '0' == $settings['pricetable_style'] ) {
  ?>
  <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-<?php echo $settings['pricetable_style']; ?>">
    <div class="elaet-price-table">
      <?php $this->render_style_header( $settings ); ?> 
      <?php $this->render_cta( $settings ); ?>    
      <?php $this->render_price( $settings ); ?>  
      <?php $this->render_features( $settings ); ?>      
    </div>
    <?php $this->render_ribbon( $settings ); ?>
  </div>
  <?php
}
  }

  /**
   * Render Price Table widget output in the editor.
   *
   * Written as a Backbone JavaScript template and used to generate the live preview.
   *
   * @since 0.0.1
   * @access protected
   */
  protected function _content_template() {
    ?>
    <#
    function render_heading_text() {
      if ( settings.heading ) {
        if ( '' != settings.heading ) {
          #>
          <div class="elaet-price-heading-text">
            <{{ settings.heading_tag }} class="elaet-price-table-heading elementor-inline-editing" data-elementor-setting-key="heading" data-elementor-inline-editing-toolbar="basic"> {{{ settings.heading }}}
            </{{ settings.heading_tag }}>
          </div>
          <#
        }
      }
    }                         
    function render_subheading_text() {
      if ( settings.sub_heading ) {
        if ( '' != settings.sub_heading || '' != settings.sub_heading_style2 ) {
        #>
          <div class="elaet-price-subheading-text">        
              <{{ settings.sub_heading_tag }} class="elaet-price-table-subheading elementor-inline-editing" data-elementor-setting-key="sub_heading" data-elementor-inline-editing-toolbar="basic">
                {{{ settings.sub_heading }}}
              </{{ settings.sub_heading_tag }}>   
          </div>
        <#
        }
      }
    }

    function render_style_header() {
        if ( settings.heading || settings.sub_heading ) {
          #>
          <div class="elaet-price-table-header">
            <div class="elaet-pricing-heading-wrap">
              <# render_heading_text(); #>      
              <# render_subheading_text(); #>
            </div>
          </div>
          <#
        }
      
    }

    function render_price() {
      var symbol = '';

      var symbols = {
        dollar: '&#36;',
        euro: '&#128;',
        franc: '&#8355;',
        pound: '&#163;',
        ruble: '&#8381;',
        shekel: '&#8362;',
        baht: '&#3647;',
        yen: '&#165;',
        won: '&#8361;',
        guilder: '&fnof;',
        peso: '&#8369;',
        peseta: '&#8359;',
        lira: '&#8356;',
        rupee: '&#8360;',
        indian_rupee: '&#8377;',
        real: 'R$',
        krona: 'kr'
      };

      if ( settings.currency_symbol ) {
        if ( 'custom' !== settings.currency_symbol ) {
          symbol = symbols[ settings.currency_symbol ] || '';
        } else {
          symbol = settings.currency_symbol_custom;
        }
      }

      var currencyFormat = settings.currency_format || '.',
        table_price = settings.price.toString(),
        price = table_price.split( currencyFormat ),
        intvalue = price[0],
        fraction = price[1];

      var durationText = '<span class="elaet-price-table-duration elaet-price-typo-excluded elementor-inline-editing" data-elementor-setting-key="duration" data-elementor-inline-editing-toolbar="basic">' + settings.duration + '</span>';
      #>
      <div class="elaet-price-table-price-wrap">
        <div class="elaet-price-table-pricing">
          <div class="elaet-pricing-container">
            <div class="elaet-pricing-value">
              <# if ( settings.sale && settings.original_price ) { #>
                <div class="elaet-price-table-original-price elaet-price-typo-excluded">{{{ symbol + settings.original_price }}}</div>
              <# } #>

              <# if ( '' != symbol && ',' != settings.currency_format) { #>
                <span class="elaet-price-table-currency">{{{ symbol }}}</span>
              <# } #>

              <# if ( '' != intvalue ) { #>
                <# if ( '' != symbol && ',' == settings.currency_format) { #>
                  <span class="elaet-price-currency-normal">{{{ symbol }}}</span>
                <# } #>
                <span class="elaet-price-table-integer-part">{{{ intvalue }}}</span>
              <# } #>

              <span class="elaet-price-table-beside-price">
                <# if ( '' != fraction ) { #>
                  <span class="elaet-price-table-fractional-part">{{{ fraction }}}</span>
                <# } #>
                <# if ( settings.duration && 'beside' === settings.duration_position && '3' != settings.pricetable_style ) { #>
                  {{{ durationText }}}
                <# } #>
              </span>
            </div>
            <# if ( settings.duration ) { #>
              <# if ( '3' === settings.pricetable_style || 'below' === settings.duration_position ) { #>
                <div class="elaet-pricing-duration">
                  {{{ durationText }}}
                </div>
              <# } #>
            <# } #>
          </div>
        </div>
      </div>
      <#
    }

    function render_features() {
      if ( settings.features_list ) { #>
        <ul class="elaet-price-table-features-list">
          <# _.each( settings.features_list, function( item ) { #>
            <li class="elementor-repeater-item-{{ item._id }}" style="margin: 0;">
              <div class="elaet-price-table-feature-content">
                <# if ( item.item_icon ) { #>
                  <i class="{{ item.item_icon }}"></i>
                <# } #>
                <# if ( ! _.isEmpty( item.item_text.trim() ) ) { #>
                  <span>{{{ item.item_text }}}</span>
                <# } else { #>
                  &nbsp;
                <# } #>
              </div>
            </li>
          <# } ); #>
        </ul>
      <# }
    }

    function render_cta() {
      if ( 'none' != settings.price_cta_type || '' != settings.footer_additional_info ) {
        if ( settings.cta_text || settings.cta_icon || settings.footer_additional_info ) { #>
          <div class="elaet-price-table-cta">
            <#
            if( 'none' != settings.price_cta_type ) {
              if( 'link' == settings.price_cta_type ) {
                if ( '' != settings.link.url ) {
                  view.addRenderAttribute( 'cta_link', 'href', settings.link.url );
                  view.addRenderAttribute( 'cta_link', 'class', 'elaet-pricebox-cta-link' ); 
                }
                #>
                <a {{{ view.getRenderAttributeString( 'cta_link' ) }}}>
                  <# 
                  if ( '' != settings.cta_icon && 'left' == settings.cta_icon_position ) {
                  #>
                    <i class="elaet-cta-link-icon elaet-cta-link-icon-before fa {{ settings.cta_icon }}"></i>
                  <# } #>
                  <# 
                  if ( '' != settings.cta_text ) {
                  #>
                  <span class="elementor-inline-editing" data-elementor-setting-key="cta_text" data-elementor-inline-editing-toolbar="basic">{{ settings.cta_text }}</span>
                  <# } #>
                  <# 
                  if ( '' != settings.cta_icon && 'right' == settings.cta_icon_position ) {
                  #>
                    <i class="elaet-cta-link-icon elaet-cta-link-icon-after fa {{ settings.cta_icon }}"></i>
                  <# } #>
                </a>
                <#
              }

              if( 'button' == settings.price_cta_type ) {
                view.addRenderAttribute( 'wrapper', 'class', 'elaet-button-wrapper elementor-button-wrapper' );

                if ( '' != settings.link.url ) {
                  view.addRenderAttribute( 'button', 'href', settings.link.url );
                  view.addRenderAttribute( 'button', 'class', 'elementor-button-link' );  
                }

                view.addRenderAttribute( 'button', 'class', 'elementor-button' );

                if ( '' != settings.button_size ) {
                  view.addRenderAttribute( 'button', 'class', 'elementor-size-' + settings.button_size );
                }

                if ( settings.button_hover_animation ) {
                  view.addRenderAttribute( 'button', 'class', 'elementor-animation-' + settings.button_hover_animation );
                }

                #>
                <div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
                  <a {{{ view.getRenderAttributeString( 'button' ) }}}>
                    <#
                    view.addRenderAttribute( 'text', 'class', 'elementor-button-text' );

                    view.addRenderAttribute( 'text', 'class', 'elementor-inline-editing' );
                    #>
                    <# 
                    if ( '' != settings.cta_icon && 'left' == settings.cta_icon_position ) {
                    #>
                      <i class="elaet-cta-link-icon elaet-cta-link-icon-before fa {{ settings.cta_icon }}"></i>
                    <# } #>
                    <# 
                      if ( '' != settings.cta_text ) {
                    #>
                    <span {{{ view.getRenderAttributeString( 'text' ) }}} data-elementor-setting-key="cta_text" data-elementor-inline-editing-toolbar="none">{{{ settings.cta_text }}}</span>
                    <# } #>
                    <# 
                    if ( '' != settings.cta_icon && 'right' == settings.cta_icon_position ) {
                    #>
                      <i class="elaet-cta-link-icon elaet-cta-link-icon-after fa {{ settings.cta_icon }}"></i>
                    <# } #>
                  </a>
                </div>
              <# } #>
            <# } #>
            <# if ( settings.footer_additional_info ) { #>
              <div class="elaet-price-table-disclaimer elementor-inline-editing" data-elementor-setting-key="footer_additional_info" data-elementor-inline-editing-toolbar="basic">{{{ settings.footer_additional_info }}}</div>
            <# } #>
          </div>
        <# }
      }
    }

    

    function render_ribbon() {
    var ribbon_style = '';
    if ( '' != settings.ribbon_title ) {
      if ( 'none' != settings.show_ribbon ) {

        if ( '1' == settings.show_ribbon ) {
          ribbon_style = '1';
        } else if ( '2' == settings.show_ribbon ) {
          ribbon_style = '2';
        } else if ( '3' == settings.show_ribbon ) {
          ribbon_style = '3';
        }
        var ribbonClass = '';

        if ( settings.ribbon_horizontal_position ) {
          ribbonClass = 'elaet-ribbon-' + settings.ribbon_horizontal_position;
        } #>
        <div class="elaet-price-table-ribbon-{{ ribbon_style }} {{ ribbonClass }}">
          <div class="elaet-price-table-ribbon-content elementor-inline-editing" data-elementor-setting-key="ribbon_title" data-elementor-inline-editing-toolbar="none">{{{ settings.ribbon_title }}}</div>
        </div>
      <# }
      }
    }
    #>

    <#
    if ( '1' == settings.pricetable_style ) { #>
      <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-{{ settings.pricetable_style }}">
        <div class="elaet-price-table">
          <# render_style_header(); #>        
          <# render_price(); #>
          <# render_features(); #>
          <# render_cta(); #>
        </div>
        <# render_ribbon(); #>
      </div>
    <# } else if ( '2' == settings.pricetable_style ) { #>
      <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-{{ settings.pricetable_style }}">
        <div class="elaet-price-table">
          <# render_style_header(); #>        
          <# render_price(); #>
          <# render_cta(); #>
          <# render_features(); #>
        </div>
        <# render_ribbon(); #>
      </div>
    <# } else if ( '3' == settings.pricetable_style ) { #>
      <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-{{ settings.pricetable_style }}">
        <div class="elaet-price-table">
          <# render_style_header(); #>        
          <# render_price(); #>
          <# render_features(); #>
          <# render_cta(); #>
        </div>
        <# render_ribbon(); #>
      </div>
    <# } else if ( '4' == settings.pricetable_style ) { #>
      <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-{{ settings.pricetable_style }}">
        <div class="elaet-price-table clearfix">
          <div class="elaet-price-table-layout-4-1">
            <# render_style_header(); #>        
            <# render_price(); #>
            <# render_cta(); #>
          </div>
          <div class="elaet-price-table-layout-4-2">
            <# render_features(); #>
          </div>
        </div>
        <# render_ribbon(); #>
      </div>
    <# }else if ( '5' == settings.pricetable_style ) { #>
      <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-{{ settings.pricetable_style }}">
        <div class="elaet-price-table">
          <# render_style_header(); #>        
          <# render_features(); #>
          <# render_price(); #>
          <# render_cta(); #>
        </div>
        <# render_ribbon(); #>
      </div>
    <# }else if ( '0' == settings.pricetable_style ) { #>
      <div class="elaet-module-content elaet-price-table-container elaet-pricing-style-{{ settings.pricetable_style }}">
        <div class="elaet-price-table">
          <# render_style_header(); #> 
          <# render_cta(); #>            
          <# render_price(); #>
          <# render_features(); #>      
        </div>
        <# render_ribbon(); #>
      </div>
    <# }
    #>
  <?php
  }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Price_Box() );
