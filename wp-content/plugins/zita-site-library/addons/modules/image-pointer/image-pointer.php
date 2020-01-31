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
class Elaet_Image_Pointer extends Widget_Base {


  
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
    return 'image_pointer';
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
    return __( 'Image Pointer', 'elaet' );
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
    return 'fa fa-mouse-pointer';
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
		$this->register_image_controls();
    $this->register_pointer_controls();
		$this->register_general_style_controls();
    $this->register_image_style_controls();
    $this->register_pointer_style_controls();
	}

 /**
   * Register Image Pointer General Controls.
   *
   * @access protected
   */
  protected function register_general_controls() {

	$this->start_controls_section(
			'general_section_pointer_image',
			[
				'label' => __( 'General', 'elaet' ),
			]
		);
	
	$this->add_control(
      'widget_title_text',
      [
        'label'   => __( 'Widget Title', 'elaet' ),
        'type'    => Controls_Manager::TEXT,
        'description' => __( 'Leave blank to hide.', 'elaet' ),
        'dynamic' => [
          'active' => true,
        ],
        'default' => __( 'My Widget', 'elaet' ),
      ]
    );

	$this->add_control(
      'widget_title_tag',
      [
        'label'   => __( 'Widget Title Tag', 'elaet' ),
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

		$this->end_controls_section();
	}

	/**
   * Register Image Pointer General Controls.
   *
   * @access protected
   */
  protected function register_image_controls() {

	$this->start_controls_section(
			'section_pointer_image',
			[
				'label' => __( 'Image', 'elaet' ),
			]
		);

		$this->add_control(
			'pointer_image',
			[
				'label' => __( 'Choose Image', 'elaet' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
    
  $this->add_control(
        'pointer_image_alt_text',
        [
          'label'   => __( 'Image Alt', 'elaet' ),
          'type'    => Controls_Manager::TEXT,
          'dynamic' => [
            'active' => true,
          ],
          
        ]
      );

  		$this->end_controls_section();
		
	}
/**
   * Register Pointer General Controls.
   *
   * @access protected
   */
  protected function register_pointer_controls() {

  $this->start_controls_section(
      'section_pointer',
      [
        'label' => __( 'Pointer', 'elaet' ),
      ]
    );

 $repeater = new Repeater();

    $repeater->start_controls_tabs(
      'pointer_general_tabs'
    );

    $repeater->start_controls_tab(
      'general_settings_tab',
      [
        'label' => __( 'General', 'elaet' ),
      ]
    );
    
    $repeater->add_control(
      'general_settings_heading',
      [
        'label'     => __( 'General Settings', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
      ]
    );

    $repeater->add_control(
      'pointer_icon',
      [
        'label'   => __( 'Pointer Icon', 'elaet' ),
        'type'    => Controls_Manager::ICON,
        'default' => 'fa fa-arrow-circle-right',
      ]
    );
      
      $repeater->add_control(
      'pointer_hover_animation',
      [
        'label'   => __( 'Pointer Hover Animation', 'elaet' ),
        'type' => Controls_Manager::HOVER_ANIMATION,
        'prefix_class' => 'elementor-animation-',        
      ]
    );

    

     $repeater->add_control(
      'pointer_tooltip_text',
      [
        'label'   => __( 'Tooltip Text', 'elaet' ),
        'type'    => Controls_Manager::TEXTAREA,
        'default' => __( 'Pointer', 'elaet' ),
        'rows'    => 2,
        'dynamic' => [
          'active' => true,
        ],
      ]
    );

    $repeater->add_control(
      'tooltip_text_visibility',
      [
        'label'   => __( 'Tooltip Text Visibility', 'elaet' ),
        'type'    => Controls_Manager::SELECT,
        'options' => [
          'hidden'  => __( 'Hide', 'elaet' ),
          'visible'  => __( 'Always', 'elaet' ),
          'onhover'  => __( 'On Hover', 'elaet' ),
        ],
        'default' => 'visible',
      ]
    );

    $repeater->end_controls_tab();

    $repeater->start_controls_tab(
      'location_tab',
      [
        'label' => __( 'Location', 'elaet' ),
      ]
    );

    $repeater->add_control(
      'location_settings_heading',
      [
        'label'     => __( 'Location Settings', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
      ]
    );

    $repeater->add_responsive_control(
        'vertical_distance',
        [
          'label' => __( 'Vertical Distance', 'elaet' ),
          'type' => Controls_Manager::SLIDER,
        'size_units' => [ '%', ],
        'range' => [
          '%' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
                'default'   => [
                    'size'  => 0,
                    'unit'  => '%'
                ],
        ]
      );

    $repeater->add_responsive_control(
        'horizontal_distance',
        [
          'label' => __( 'Horizontal Distance', 'elaet' ),
          'type' => Controls_Manager::SLIDER,
        'size_units' => [ '%',],
        'range' => [
          '%' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
                'default'   => [
                    'size'  => 0,
                    'unit'  => '%'
                ],
        ]
      );

  $repeater->end_controls_tab();

  $repeater->start_controls_tab(
      'pointer_style_tab',
      [
        'label' => __( 'Style', 'elaet' ),
      ]
    );

  $repeater->add_control(
      'pointer_normal_style_heading',
      [
        'label'     => __( 'Normal', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
      ]
    );

    // Pointer color.
    $repeater->add_control(
      'pointer_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Pointer Background', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#ed003b',
        'selectors' => [
          '{{WRAPPER}} {{CURRENT_ITEM}}.pointer-icon-div' => 'background-color: {{VALUE}};',
        ],     
      ]
    );

    // Pointer color.
    $repeater->add_control(
      'pointer_icon_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Pointer Icon', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} {{CURRENT_ITEM}}.pointer-icon-div' => 'color: {{VALUE}};',
        ],     
      ]
    );

  $repeater->add_control(
      'pointer_onhover_style_heading',
      [
        'label'     => __( 'On Hover', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
      ]
    );
   
    // Pointer color.
    $repeater->add_control(
      'pointer_hover_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Pointer Background', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
         'default' => '#ed003b',
        'selectors' => [
          '{{WRAPPER}} {{CURRENT_ITEM}}.pointer-icon-div:hover' => 'background-color: {{VALUE}};',
        ],     
      ]
    );

    // Pointer color.
    $repeater->add_control(
      'pointer_icon_hover_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Pointer Icon', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} {{CURRENT_ITEM}}.pointer-icon-div:hover' => 'color: {{VALUE}};',
        ],     
      ]
    );

    $repeater->add_control(
      'tootltip_style_heading',
      [
        'label'     => __( 'Tooltip', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
      ]
    );


    // Tooltip background color.
    $repeater->add_control(
      'tooltip_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Tooltip Background', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#262626',
        'selectors' => [
          '{{WRAPPER}} {{CURRENT_ITEM}}.tooltip-text-div' => 'background-color: {{VALUE}};',
          '{{WRAPPER}} {{CURRENT_ITEM}}.tooltip-text-div:after' => 'border-bottom: 15px solid {{VALUE}};',
        ],     
      ]
    );

    // Tooltip Text Color.
    $repeater->add_control(
      'tooltip_text_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Tooltip Text', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} {{CURRENT_ITEM}}.tooltip-text-div' => 'color: {{VALUE}};',
        ],     
      ]
    );

    $repeater->end_controls_tab();
    $repeater->end_controls_tabs();
   
    $this->add_control(
      'pointers_list',
      [
        'type'        => Controls_Manager::REPEATER,
        'fields'      => array_values( $repeater->get_controls() ),
        'default'     => [
          [
            'pointer_tooltip_text' => __( 'Pointer', 'elaet' ),
            'pointer_icon' => 'fa fa-arrow-circle-right',
            'vertical_distance' => 20,
            'horizontal_distance' => 20,
          ],      
        ],
        'title_field' => '{{{ pointer_tooltip_text }}}',
      ]
    );


    $this->end_controls_section();
  }

	/**
   * Register Image Pointer General Style Controls.
   *
   * @access protected
   */
  protected function register_general_style_controls() {

		$this->start_controls_section(
			'styling_section_pointer_image',
			[
				'label' => __( 'General', 'elaet' ),
				'tab'   => Controls_Manager::TAB_STYLE,
        'condition' =>[
            'widget_title_text!' => '',
        ]
			]
		);
 
    // Widget Title color.
    $this->add_control(
      'widget_title_text_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Widget Title Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'separator' => '',  
        'selectors' => [
          '{{WRAPPER}} #widget-title' => 'color: {{VALUE}};',
        ],
        'condition'      => [
          'widget_title_text!' => '',
        ],
      ]
    );

     $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'widget_title_typography',
        'selector' => '{{WRAPPER}} #widget-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        'condition' => [
          'widget_title_text!' => '',
          ],
      ]
    );

    // Widget Title Box Shadow.
    $this->add_group_control(
      Group_Control_Text_Shadow::get_type(),
      [
        'name'      => 'widget_title_box_shadow',
        'label'     => 'Text Shadow',
        'condition'      => [
          'widget_title_text!' => '',
        ],
        'selector'  => '{{WRAPPER}} #widget-title',
      ]
    );

    // Widget Title alignment.
    $this->add_responsive_control(
      'widget_title_alignment',
      [
        'label'          => __( 'Widget Title Alignment', 'elaet' ),
        'type'           => \Elementor\Controls_Manager::CHOOSE,
        'options'        => [
          'left'    => [
            'title' => __( 'Left', 'elaet' ),
            'icon'  => 'fa fa-align-left',
          ],
          'center'  => [
            'title' => __( 'Center', 'elaet' ),
            'icon'  => 'fa fa-align-center',
          ],
          'right'   => [
            'title' => __( 'Right', 'elaet' ),
            'icon'  => 'fa fa-align-right',
          ],
          'justify' => [
            'title' => __( 'Justified', 'elaet' ),
            'icon'  => 'fa fa-align-justify',
          ],
        ],
        'default'        => 'center',
        'tablet_default' => 'center',
        'mobile_default' => 'center',
        'selectors'      => [
          '{{WRAPPER}} #widget-title' => 'text-align: {{VALUE}};',
        ],
        'condition'      => [
          'widget_title_text!' => '',
          ],
      ]
    );

		$this->end_controls_section();

	}

  /**
   * Register Image Pointer Image Style Controls.
   *
   * @access protected
   */
  protected function register_image_style_controls() {

    $this->start_controls_section(
      'image_styling_section_pointer_image',
      [
        'label' => __( 'Image Styling', 'elaet' ),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );

    // Image Border Type
    $this->add_control(
        'image_border_type',
        [
          'label'       => __( 'Border Type', 'elaet' ),
          'type'        => Controls_Manager::SELECT,
          'default'     => 'none',
           'options'     => [
            'none'   => __( 'None', 'elaet' ),
            'solid'  => __( 'Solid', 'elaet' ),
            'double' => __( 'Double', 'elaet' ),
            'dotted' => __( 'Dotted', 'elaet' ),
            'dashed' => __( 'Dashed', 'elaet' ),
          ],
          
          'selectors'   => [
            '{{WRAPPER}} .pointer-image-container img' => 'border-style: {{VALUE}};',
          ],
        ]
      );

    // Border color.
    $this->add_control(
      'image_border_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Border Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'separator' => '',
        'condition'  => [
            'image_border_type!' => 'none', 
          ],
        'selectors' => [
          '{{WRAPPER}} .pointer-image-container img' => 'border-color: {{VALUE}};',
        ],     
      ]
    );

// Image Border Width
  $this->add_control(
        'image_border_width',
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
            'image_border_type!' => 'none', 
          ],
          'selectors'  => [
            '{{WRAPPER}} .pointer-image-container img' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );

  //Image Border Radius
    $this->add_responsive_control(
        'image_border_radius',
        [
          'label'      => __( 'Border Radius', 'elaet' ),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%' ],
          'selectors'  => [
            '{{WRAPPER}} .pointer-image-container img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
          
        ]
      );

    
    $this->end_controls_section();

  }


  /**
   * Register Pointer Style Controls.
   *
   * @access protected
   */
  protected function register_pointer_style_controls() {

    $this->start_controls_section(
      'pointer_styling_section_pointer_image',
      [
        'label' => __( 'Tooltip Styling', 'elaet' ),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'tooltip_text_typography',
        'selector' => '{{WRAPPER}} .tooltip-text-div',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      ]
    );

    // Widget Title Box Shadow.
    $this->add_group_control(
      Group_Control_Text_Shadow::get_type(),
      [
        'name'      => 'tooltip_text_box_shadow',
        'label'     => 'Text Shadow',
        'selector'  => '{{WRAPPER}} .tooltip-text-div',
      ]
    );

    $this->add_responsive_control(
      'tooltip_text_padding',
      [
        'label'      => __( 'Padding', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors'  => [
          '{{WRAPPER}} .tooltip-text-div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    
    $this->end_controls_section();

  }


  protected function render_pointers($settings) {
      
      if ( ! empty( $settings['pointers_list'] ) ){

      foreach ( $settings['pointers_list'] as $item ) {
         ?>

        <div class="elaet-pointer-div" id="pointer-item-<?php echo $item['_id'] ?>" 
          style="top:<?php echo $item['vertical_distance']['size'].$item['vertical_distance']['unit']?>; left:<?php echo $item['horizontal_distance']['size'].$item['horizontal_distance']['unit'] ?>;">
              <?php if ( ! empty( $item['pointer_icon'] ) ){ 
            
                ?>
            <div class="pointer-icon-div elementor-repeater-item-<?php echo $item['_id']; ?> elementor-animation-<?php echo $item['pointer_hover_animation']; ?>">
                <i class="<?php echo esc_attr( $item['pointer_icon'] ); ?>"></i>
            </div>
              <?php } ?>
              <?php
              if ( ! empty( $item['pointer_tooltip_text'] ) ){
                    $tooltip_text_hover_hide_class = '';

                if($item['tooltip_text_visibility'] == 'hidden'){
                    $tooltip_text_hover_visibility = 'visibility: hidden';
                }elseif($item['tooltip_text_visibility'] == 'visible'){
                   $tooltip_text_hover_visibility = 'visibility: visible';
                }elseif($item['tooltip_text_visibility'] == 'onhover'){
                  $tooltip_text_hover_visibility = '';
                  $tooltip_text_hover_hide_class = ' tooltip-text-hover-hide-class';
                }

              ?>
              <div class="tooltip-text-div elementor-repeater-item-<?php echo $item['_id']; ?> <?php echo $tooltip_text_hover_hide_class; ?>" style="<?php echo $tooltip_text_hover_visibility ?>"> 
                <?php echo $item['pointer_tooltip_text']; ?>      
              </div>
              <?php
              }else{
                echo '&nbsp;';
              }
              ?>
        </div>
<?php 
      }


    }
  }
  
	protected function render() {
  
    $settings = $this->get_settings_for_display();
?>
	<div class='image-pointer-parent'>
          		<div class="pointer-title">
          		  <<?php echo $settings['widget_title_tag']; ?> id="widget-title"> 
                  <?php echo $settings['widget_title_text']; ?> 
                </<?php echo $settings['widget_title_tag']; ?>>
                  
              </div>
    
           <?php if ($settings['pointer_image']){ ?>
              <div class="pointer-image-container">
                    <img src="<?php echo $settings['pointer_image']['url']; ?>" alt="<?php echo $settings['pointer_image_alt_text']; ?>">
                    <?php $this->render_pointers( $settings ); ?>
              </div>    
           <?php } ?>   
  </div>
    <?php
    
  }

   

}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Image_Pointer() );