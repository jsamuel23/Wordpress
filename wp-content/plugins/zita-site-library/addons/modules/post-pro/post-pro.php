<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

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
use Elementor\Control_Slider;
use Elementor\Group_Control_Image_Size;


/**
 * Zita Elementor Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elaet_Post_Pro extends Widget_Base {


 // End if().

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
    return 'post-widget';
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
    return __( 'Post &amp; Page Pro', 'elaet' );
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
    return 'eicon-post-content';
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
   * Register dependent script.
   *
   * @return array
   */
  public function get_script_depends() {
    return [ 'elaet-grid-js' ];
  }

  
  /**
   * Get post types.
   */
  private function grid_get_all_post_types() {
    $options = array();
    $exclude = array( 'attachment', 'elementor_library' ); // excluded post types

    $args = array(
      'public' => true,
    );

   $post_types = get_post_types( $args, 'objects' );
    
    foreach ( $post_types as $post_type ) {

      // Check if post type name exists.
      if ( ! isset( $post_type->name ) ) {
        continue;
      }

      // Check if post type label exists.
      if ( ! isset( $post_type->label ) ) {
        continue;
      }

      // Check if post type is excluded.
      if ( in_array( $post_type->name, $exclude ) === true ) {
        continue;
      }

      $options[ $post_type->name ] = $post_type->label;
    }

    return $options;
  }

  /**
   * Get post type categories.
   */
  private function grid_get_all_post_type_categories( $post_type ) {
    $options['0'] = 'All';

    if ( $post_type == 'post' ) {
      $taxonomy = 'category';
    } elseif ( $post_type == 'product' ) {
      $taxonomy = 'product_cat';
    }

    if ( ! empty( $taxonomy ) ) {
      // Get categories for post type.
      $terms = get_terms(
        array(
          'taxonomy'   => $taxonomy,
          'hide_empty' => false,
        )
      );
      if ( ! empty( $terms ) ) {
        foreach ( $terms as $term ) {
          if ( isset( $term ) ) {
            if ( isset( $term->slug ) && isset( $term->name ) ) {
              $options[ $term->slug ] = $term->name;
            }
          }
        }
      }
    }

    return $options;
  }

  /*****************************************
  *********Calculate reading time.**********
  ******************************************/
  
     private function elaet_calculate_reading_time(){
      $post_id      = get_the_ID();
      $post_content       = get_post_field( 'post_content', $post_id );
      $stripped_content   = strip_shortcodes( $post_content );
      $strip_tags_content = strip_tags( $stripped_content );
      $word_count         = str_word_count( $strip_tags_content );
      $reading_time       = ceil( $word_count / 220 );
      return $reading_time;

    }

  /**
   * Register Elementor Controls.
   */
  protected function _register_controls() {
    // Content.
    $this->grid_general_section();
    $this->grid_image_section();
    $this->grid_title_section();
    $this->grid_meta_section();
    $this->grid_content_section();
    
    // Style.
    $this->grid_general_style_section();
    $this->grid_image_style_section();
    $this->grid_title_style_section();
    $this->grid_meta_style_section();
    $this->grid_content_style_section();
    $this->grid_pagination_style_section();
  }

  /**
   * Content > Grid.
   */
  private function grid_general_section() {
    $this->start_controls_section(
      'section_grid',
      [
        'label' => __( 'Grid', 'elaet' ),
      ]
    );

// Blog Layout.
    $this->add_control(
      'grid_style',
      [
        'type'    => \Elementor\Controls_Manager::SELECT,
        'label'   => __( 'Blog Layout', 'elaet' ),
        'default' => 'grid',
        'options' => [
          'grid' => __( 'Grid', 'elaet' ),
          'list' => __( 'List', 'elaet' ),
         'zigzag' => __( 'Zig-Zag', 'elaet' ),
        ],
      ]
    );
  // Blog Structure.
    $this->add_control(
      'blog_structure',
      [
        'type'    => \Elementor\Controls_Manager::SELECT,
        'label'   => __( 'Blog Structure', 'elaet' ),
        'default' => 'image_at_top',
        'options' => [
          'image_at_top'          => __( 'Image At Top', 'elaet' ),
          'image_at_middle'         => __( 'Image At Middle', 'elaet' ),    
        ],
      ]
    );
    // Post type.
    $this->add_control(
      'grid_post_type',
      [
        'type'    => \Elementor\Controls_Manager::SELECT,
        'label'   => __( 'Post Type', 'elaet' ),
        'default' => 'post',
        'options' => $this->grid_get_all_post_types(),
      ]
    );

    // Post categories.
    $this->add_control(
      'grid_post_categories',
      [
        'type'      => \Elementor\Controls_Manager::SELECT,
        'label'     => __( 'Category', 'elaet' ),
        'options'   => $this->grid_get_all_post_type_categories( 'post' ),
        'condition' => [
          'grid_post_type' => 'post',
        ],
      ]
    );

    // Product categories.
    $this->add_control(
      'grid_product_categories',
      [
        'type'      => \Elementor\Controls_Manager::SELECT,
        'label'     => __( 'Category', 'elaet' ),
        'options'   => $this->grid_get_all_post_type_categories( 'product' ),
        'condition' => [
          'grid_post_type' => 'product',
        ],
      ]
    );

    // Items.
    $this->add_control(
      'grid_items',
      [
        'type'        => \Elementor\Controls_Manager::NUMBER,
        'label'       => __( 'Items', 'elaet' ),
        'placeholder' => __( 'How many items?', 'elaet' ),
        'default'     => 6,
      ]
    );

    // Columns.
    $this->add_responsive_control(
      'grid_columns',
      [
        'type'           => \Elementor\Controls_Manager::SELECT,
        'label'          => __( 'Columns', 'elaet' ),
        'default'        => 3,
        'tablet_default' => 1,
        'mobile_default' => 1,
        'options'        => [
          1 => 1,
          2 => 2,
          3 => 3,
          4 => 4,       
        ],
        'condition'   => [
          'grid_style' => 'grid',
        ]     
      ]
    );

    // Order by.
    $this->add_control(
      'grid_order_by',
      [
        'type'    => \Elementor\Controls_Manager::SELECT,
        'label'   => __( 'Order by', 'elaet' ),
        'default' => 'date',
        'options' => [
          'none' => __('No order', 'elaet'),
          'date'          => __( 'Date', 'elaet' ),
          'title'         => __( 'Title', 'elaet' ),
          'modified'      => __( 'Modified date', 'elaet' ),
          'comment_count' => __( 'Comment count', 'elaet' ),
          'rand'          => __( 'Random', 'elaet' ),
           'ID'           => __('Post ID', 'elaet'),
          'author'        => __('Author', 'elaet'),
          'parent'        => __('By parent', 'elaet'),
          'menu_order'    => __('Menu order', 'elaet'),
          'post__in'      => __('By include order', 'elaet'),
        ],
      ]
    );

    // Order Ascending Or Descending
    $this->add_control(
            'grid_ordering',
            [
                'label' => __('Order', 'elaet'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'ASC' => __('Ascending', 'elaet'),
                    'DESC' => __('Descending', 'elaet'),
                ),
                'default' => 'DESC',
            ]
        );

    // Display pagination.
    $this->add_control(
      'grid_pagination',
      [
        'label'   => __( 'Pagination', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Content > Image Options.
   */
  private function grid_image_section() {
    $this->start_controls_section(
      'section_grid_image',
      [
        'label' => __( 'Image', 'elaet' ),
      ]
    );

    // Hide image.
    $this->add_control(
      'grid_image_hide',
      [
        'label'   => __( 'Hide', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => '', 
        'return'  => 'yes',    
      ]
    );

    
    //Image Size
    $this->add_control(
      'grid_image_size',
      [
        'type'    => \Elementor\Controls_Manager::SELECT,
        'label'   => __( 'Image Size', 'elaet' ),
        'default' => 'full',
        'options' => [
          'thumbnail'          => __( 'Thumbnail', 'elaet' ),
          'medium'         => __( 'Medium', 'elaet' ),
          'large' => __( 'Large', 'elaet' ),
          'full'          => __( 'Full', 'elaet' ),
        ],
        'condition'   => [
          'grid_image_hide' => '',
        ]
      ]
    );

    // Image link.
    $this->add_control(
      'grid_image_link',
      [
        'label'   => __( 'Link', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => 'yes',
        'condition'   => [
          'grid_image_hide' => '',
        ]
      ]
    );

    // Image alignment.
    $this->add_responsive_control(
      'grid_image_alignment',
      [
        'label'          => __( 'Image Alignment', 'elaet' ),
        'type'           => \Elementor\Controls_Manager::CHOOSE,
        'options'        => [
          '1'   => [
            'title' => __( 'Left', 'elaet' ),
            'icon'  => 'fa fa-align-left',
          ],
          '3'  => [
            'title' => __( 'Right', 'elaet' ),
            'icon'  => 'fa fa-align-right',
          ],
          ],
        'condition'   => [
          'grid_image_hide' => '',
          'grid_style'  => 'list'
        ],
        'default'        => '1',
        'tablet_default' => '1',
        'mobile_default' => '1',
        'selectors'      => [
          '{{WRAPPER}} .elaet-grid-container.elaet-grid-style-list  .elaet-grid-col .elaet-grid-col-image' => 'order: {{VALUE}};',
        ],
      ]
    );


    $this->end_controls_section();
  }

  /**
   * Content > Title Options.
   */
  private function grid_title_section() {
    $this->start_controls_section(
      'section_grid_title',
      [
        'label' => __( 'Title', 'elaet' ),
      ]
    );

    // Hide title.
    $this->add_control(
      'grid_title_hide',
      [
        'label'   => __( 'Hide', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
      ]
    );

    // Title tag.
    $this->add_control(
      'grid_title_tag',
      [
        'type'    => \Elementor\Controls_Manager::SELECT,
        'label'   => __( 'Tag', 'elaet' ),
        'default' => 'h2',
        'options' => [
          'h1'   => 'H1',
          'h2'   => 'H2',
          'h3'   => 'H3',
          'h4'   => 'H4',
          'h5'   => 'H5',
          'h6'   => 'H6',
          'span' => 'span',
          'p'    => 'p',
          'div'  => 'div',
        ],
        'condition'   => [
          'grid_title_hide' => '',
        ]
      ]
    );

    // Title link.
    $this->add_control(
      'grid_title_link',
      [
        'label'   => __( 'Link', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => 'yes',
        'condition'   => [
          'grid_title_hide' => '',
        ]
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Content > Meta Options.
   */
  private function grid_meta_section() {
    $this->start_controls_section(
      'section_grid_meta',
      [
        'label' => __( 'Meta', 'elaet' ),
      ]
    );

    // Hide content.
    $this->add_control(
      'grid_meta_hide',
      [
        'label'   => __( 'Hide', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
      ]
    );

    // Meta.
    $this->add_control(
      'grid_meta_display',
      [
        'label'       => __( 'Display', 'elaet' ),
        'label_block' => true,
        'type'        => \Elementor\Controls_Manager::SELECT2,
        'default'     => [ 'author', 'date' ],
        'multiple'    => true,
        'options'     => [
          'author'   => __( 'Author', 'elaet' ),
          'date'     => __( 'Date', 'elaet' ),
          'category' => __( 'Category', 'elaet' ),
          'tags'     => __( 'Tags', 'elaet' ),
          'comments' => __( 'Comments', 'elaet' ),
          'read-time' => __( 'Read Time', 'elaet' ),
        ],
        'condition'   => [
          'grid_meta_hide' => '',
        ]
      ]
    );

    // No. of Categories.
    $this->add_control(
      'grid_meta_categories_max',
      [
        'type'        => \Elementor\Controls_Manager::NUMBER,
        'label'       => __( 'No. of Categories', 'elaet' ),
        'placeholder' => __( 'How many categories to display?', 'elaet' ),
        'default'     => __( '1', 'elaet' ),
        'condition'   => [
          'grid_meta_display' => 'category',
          'grid_meta_hide' => '',
        ],
      ]
    );

    // No. of Tags.
    $this->add_control(
      'grid_meta_tags_max',
      [
        'type'        => \Elementor\Controls_Manager::NUMBER,
        'label'       => __( 'No. of Tags', 'elaet' ),
        'default'     => __( '1', 'elaet' ),
        'placeholder' => __( 'How many tags to display?', 'elaet' ),
        'condition'   => [
          'grid_meta_display' => 'tags',
          'grid_meta_hide' => '',
        ],
      ]
    );

    // Remove meta icons.
    $this->add_control(
      'grid_meta_remove_icons',
      [
        'label'   => __( 'Remove icons', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
        'condition'   => [
            'grid_meta_hide' => '',
        ],
      ]
    );
    // Remove meta icons.
    $this->add_control(
      'grid_meta_date_box',
      [
        'label'   => __( 'Enable Date Box', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
        'condition'   => [
            'grid_meta_hide' => '',
            'grid_image_hide' => '',
        ],
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Content > Content Options.
   */
  private function grid_content_section() {
    $this->start_controls_section(
      'section_grid_content',
      [
        'label' => __( 'Content', 'elaet' ),
      ]
    );

    // Hide content.
    $this->add_control(
      'grid_content_hide',
      [
        'label'   => __( 'Hide', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
      ]
    );

    // Show full content.
    $this->add_control(
      'grid_content_full_post',
      [
        'label'   => __( 'Show full content', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
        'condition' => [
          'grid_content_hide' => ''
        ]
      ]
    );

    // Length.
    $this->add_control(
      'grid_content_length',
      [
        'type'        => \Elementor\Controls_Manager::NUMBER,
        'label'       => __( 'Excerpt Length', 'elaet' ),
        'placeholder' => __( 'Length of content (words)', 'elaet' ),
        'default'     => 30,
        'condition'   => [
            'grid_content_full_post!' => 'yes',
            'grid_content_hide' => ''
        ]
      ]
    );


    // Make First Post Large.
    $this->add_control(
      'grid_content_first_post',
      [
        'label'   => __( 'Make First Post Large', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
        'condition' => [
          'grid_content_hide' => ''   
        ]
      ]
    );
    // Make Sixth Post Large.
    $this->add_control(
      'grid_content_sixth_post',
      [
        'label'   => __( 'Make Sixth Post Large', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
        'condition' => [
          'grid_content_hide' => ''
        ]
      ]
    );

    // Drop Cap.
    $this->add_control(
      'grid_drop_cap_effect',
      [
        'label'   => __( 'Enable Drop Cap', 'elaet' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
        'condition' => [
          'grid_content_hide' => ''
        ]
      ]
    );
    
    // Price.
    $this->add_control(
      'grid_content_price',
      [
        'label'     => __( 'Price', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'condition' => [
          'section_grid.grid_post_type' => 'product',
          'grid_content_hide' => ''
        ],
      ]
    );

    // Read more button hide.
    $this->add_control(
      'grid_content_default_btn',
      [
        'label'     => __( 'Button', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'condition' => [
          'section_grid.grid_post_type!' => 'product',
          'grid_content_full_post'  => '',

        ],
      ]
    );

    // Default button text.
    $this->add_control(
      'grid_content_default_btn_text',
      [
        'type'        => \Elementor\Controls_Manager::TEXT,
        'label'       => __( 'Button text', 'elaet' ),
        'placeholder' => __( 'Read more', 'elaet' ),
        'default'     => __( 'Read more', 'elaet' ),
        'condition'   => [
          'grid_content_full_post'  => '',
          'grid_content_default_btn!'    => '',
          'section_grid.grid_post_type!' => 'product',
        ],
      ]
    );

    // Add to cart button hide.
    $this->add_control(
      'grid_content_product_btn',
      [
        'label'     => __( 'Button', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::SWITCHER,
        'default'   => 'yes',
        'condition' => [
          'section_grid.grid_post_type' => 'product',
        ],
      ]
    );

    // Button alignment.
    $this->add_responsive_control(
      'grid_content_btn_alignment',
      [
        'label'          => __( 'Button Alignment', 'elaet' ),
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
        'default'        => 'left',
        'tablet_default' => 'left',
        'mobile_default' => 'center',
        'selectors'      => [
          '{{WRAPPER}} .elaet-grid-footer' => 'text-align: {{VALUE}};',
        ],
        'condition'      => [
          'grid_content_default_btn!' => '',
          'grid_content_full_post'  => '',
        ],
      ]
    );

    // Content alignment.
    $this->add_responsive_control(
      'grid_content_alignment',
      [
        'label'          => __( 'Content Alignment', 'elaet' ),
        'type'           => \Elementor\Controls_Manager::CHOOSE,
        'options'        => [
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
          'justify' => [
            'title' => __( 'Justified', 'elaet' ),
            'icon'  => 'fa fa-align-justify',
          ],
        ],
        'default'        => 'left',
        'tablet_default' => 'left',
        'mobile_default' => 'center',
        'selectors'      => [
          '{{WRAPPER}} .elaet-grid-col-content' => 'text-align: {{VALUE}};',
        ],
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Style > Grid options.
   */
  private function grid_general_style_section() {
    // Tab.
    $this->start_controls_section(
      'section_grid_style',
      [
        'label' => __( 'Grid Styling', 'elaet' ),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    // Content Box Border
    $this->add_control(
        'grid_content_box_border_style',
        [
          'label'       => __( 'Content Box Border Style', 'elaet' ),
          'type'        => Controls_Manager::SELECT,
          'default'     => 'none',
          'label_block' => true,
          'options'     => [
            'none'   => __( 'None', 'elaet' ),
            'solid'  => __( 'Solid', 'elaet' ),
            'double' => __( 'Double', 'elaet' ),
            'dotted' => __( 'Dotted', 'elaet' ),
            'dashed' => __( 'Dashed', 'elaet' ),
          ],
          
          'selectors'   => [
            '{{WRAPPER}} .elaet-grid-col' => 'border-style: {{VALUE}};',
          ],
        ]
      );

// Content Box Border Width
  $this->add_control(
        'grid_content_box_border_size',
        [
          'label'      => __( 'Content Box Border Width', 'elaet' ),
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
            'grid_content_box_border_style!' => 'none',
            
          ],
          'selectors'  => [
            '{{WRAPPER}} .elaet-grid-col' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );

    // Border color.
    $this->add_control(
      'grid_content_box_border_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Content Box Border Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'separator' => '',
        'default'  => '#bababa',
        'condition'  => [
            'grid_content_box_border_style!' => 'none',   
          ],
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-col' => 'border-color: {{VALUE}};',
        ],
        
      ]
    );

    // Items options.
    $this->add_control(
      'grid_style_columns_margin_heading',
      [
        'label'     => __( 'Columns Spacing', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    // Columns margin.
    $this->add_responsive_control(
      'grid_style_columns_spacing_tnb',
      [
        'label'     => __( 'Top &amp; Bottom', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::SLIDER,
        'default'   => [
          'size' => 5,
        ],
        'range'     => [
          'px' => [
            'min' => 0,
            'max' => 50,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-wrapper'   => 'margin-top:  {{SIZE}}{{UNIT}}; margin-bottom:  {{SIZE}}{{UNIT}} ;',
          
        ],
      ]
    );

    // Columns margin.
    $this->add_responsive_control(
      'grid_style_columns_spacing_lnr',
      [
        'label'     => __( 'Left &amp; Right', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::SLIDER,
        'default'   => [
          'size' => 5,
        ],
        'range'     => [
          'px' => [
            'min' => 0,
            'max' => 50,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-wrapper'   => 'padding-right:  {{SIZE}}{{UNIT}}; padding-left:  {{SIZE}}{{UNIT}};',
          
        ],
      ]
    );

    // Items options.
    $this->add_control(
      'grid_items_style_heading',
      [
        'label'     => __( 'Items', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    // Items internal padding.
    $this->add_responsive_control(
      'grid_items_style_padding',
      [
        'label'      => __( 'Padding', 'elaet' ),
        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
        'default'    => [
          'top'    => 5,
          'right'  => 5,
          'bottom' => 5,
          'left'   => 5,
          'unit'   => 'px',
        ],
        'size_units' => [ 'px', '%' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-grid-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    // Items box shadow.
    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name'      => 'grid_items_style_box_shadow',
        'selector'  => '{{WRAPPER}} .elaet-grid-col',
        'separator' => '',
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'section_grid_column_style',
      [
        'label'     => __( 'Column Background', 'elaet' ),
        'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    //*******************************************************************************
    //**********Two Column Grid Layout Column Background ****************************
    //*******************************************************************************
    $this->start_controls_tabs(
      'grid_column_style_tabs'
    );

    $this->start_controls_tab(
      'style_grid_one_tab',
      [
        'label' => __( 'One Col', 'elaet' ),
      ]
    );

    $this->add_control(
      'grid_one_first_col_bg_heading',
      [
        'label'     => __( 'First Column Background', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name'     => 'grid_one_first_col_bg',
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .elaet-grid-desktop-1 .elaet-grid-wrapper .elaet-grid-col',
      ]
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
      'style_grid_two_tab',
      [
        'label' => __( 'Two Col', 'elaet' ),
      ]
    );

    $this->add_control(
      'grid_two_first_col_bg_heading',
      [
        'label'     => __( 'First Column Background', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    // First Column Background.
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name'     => 'grid_two_first_col_bg',
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .elaet-grid-desktop-2 .elaet-grid-wrapper:nth-child(2n+1) .elaet-grid-col',
      ]
    );

    $this->add_control(
      'grid_two_second_col_bg_heading',
      [
        'label'     => __( 'Second Column Background', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );
        //Second Column Background.
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name'     => 'grid_two_second_col_bg',
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .elaet-grid-desktop-2 .elaet-grid-wrapper:nth-child(2n+2) .elaet-grid-col',
      ]
    );

    $this->end_controls_tab();

    //*********************************************************************************
    //**********Three Column Grid Layout Column Background ****************************
    //*********************************************************************************

    $this->start_controls_tab(
      'style_grid_three_tab',
      [
        'label' => __( 'Three Col', 'elaet' ),
      ]
    );

    $this->add_control(
      'grid_three_first_col_bg_heading',
      [
        'label'     => __( 'First Column Background', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    // First Column Background.
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name'     => 'grid_three_first_col_bg',
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .elaet-grid-desktop-3 .elaet-grid-wrapper:nth-child(3n+1) .elaet-grid-col',
      ]
    );

    $this->add_control(
      'grid_three_second_col_bg_heading',
      [
        'label'     => __( 'Second Column Background', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );
        //Second Column Background.
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name'     => 'grid_three_second_col_bg',
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .elaet-grid-desktop-3 .elaet-grid-wrapper:nth-child(3n+2) .elaet-grid-col',
      ]
    );

  $this->add_control(
      'grid_three_third_col_bg_heading',
      [
        'label'     => __( 'Third Column Background', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    
      ]
    );
        //Second Column Background.
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name'     => 'grid_three_third_col_bg',
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .elaet-grid-desktop-3 .elaet-grid-wrapper:nth-child(3n+3) .elaet-grid-col',
      ]
    );

    $this->end_controls_tab();

    //********************************************************************************
    //**********Four Column Grid Layout Column Background ****************************
    //********************************************************************************
    
    $this->start_controls_tab(
      'style_grid_four_tab',
      [
        'label' => __( 'Four Col', 'elaet' ),
      ]
    );

    $this->add_control(
      'grid_four_first_col_bg_heading',
      [
        'label'     => __( 'First Column Background', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    // First Column Background.
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name'     => 'grid_four_first_col_bg',
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .elaet-grid-desktop-4 .elaet-grid-wrapper:nth-child(4n+1) .elaet-grid-col',
      ]
    );

    $this->add_control(
      'grid_four_second_col_bg_heading',
      [
        'label'     => __( 'Second Column Background', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );
        //Second Column Background.
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name'     => 'grid_four_second_col_bg',
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .elaet-grid-desktop-4 .elaet-grid-wrapper:nth-child(4n+2) .elaet-grid-col',
      ]
    );

  $this->add_control(
      'grid_four_third_col_bg_heading',
      [
        'label'     => __( 'Third Column Background', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    
      ]
    );
        //Second Column Background.
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name'     => 'grid_four_third_col_bg',
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .elaet-grid-desktop-4 .elaet-grid-wrapper:nth-child(4n+3) .elaet-grid-col',
      ]
    );

    $this->add_control(
      'grid_four_fourth_col_bg_heading',
      [
        'label'     => __( 'Fourth Column Background', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    
      ]
    );
        //Second Column Background.
    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name'     => 'grid_four_fourth_col_bg',
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .elaet-grid-desktop-4 .elaet-grid-wrapper:nth-child(4n+4) .elaet-grid-col',
      ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    //********************************************************************************
    //**********Grid Layout Column Background End ****************************
    //********************************************************************************


    $this->end_controls_section();
















  }

  /**
   * Style > Image.
   */
  private function grid_image_style_section() {
    // Tab.
    $this->start_controls_section(
      'section_grid_image_style',
      [
        'label'     => __( 'Image', 'elaet' ),
        'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
        'condition' => [
          'section_grid_image.grid_image_hide' => '',
        ],
      ]
    );

    // Image border radius.
    $this->add_control(
      'grid_image_style_border_radius',
      [
        'label'      => __( 'Border Radius', 'elaet' ),
        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-grid-col-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'condition'  => [
          'section_grid_image.grid_image_hide' => '',
        ],
      ]
    );

    // Image box shadow.
    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name'      => 'grid_image_style_box_shadow',
        'selector'  => '{{WRAPPER}} .elaet-grid-col-image',
        'separator' => '',
        'condition' => [
          'section_grid_image.grid_image_hide' => '',
        ],
      ]
    );

    // Image margin.
    $this->add_responsive_control(
      'grid_image_style_padding',
      [
        'label'      => __( 'Spacing Around Image', 'elaet' ),
        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-grid-col-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'condition'  => [
          'section_grid_image.grid_image_hide' => '',
        ],
      ]
    );

// Image Alignment
    $this->add_responsive_control(
      'grid_content_image_alignment',
      [
        'label'          => __( 'Image Alignment', 'elaet' ),
        'type'           => \Elementor\Controls_Manager::CHOOSE,
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
        'tablet_default' => 'flex-start',
        'mobile_default' => 'center',
        'selectors'      => [
          '{{WRAPPER}} .elaet-grid .elaet-grid-wrapper .elaet-grid-col .elaet-grid-col-image ' => 'justify-content: {{VALUE}};',
        ],
        'condition'  => [
          'section_grid_image.grid_image_hide' => '',
        ],
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Style > Title.
   */
  private function grid_title_style_section() {
    // Tab.
    $this->start_controls_section(
      'section_grid_title_style',
      [
        'label'     => __( 'Title', 'elaet' ),
        'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
        'condition' => [
          'section_grid_title.grid_title_hide' => '',
        ],
      ]
    );

    // Title typography.
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name'     => 'grid_title_style_typography',
        'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .elaet-grid .entry-title.elaet-grid-title, {{WRAPPER}} .elaet-grid .entry-title.elaet-grid-title > a',
      ]
    );

    // Title color.
    $this->add_control(
      'grid_title_style_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Color', 'elaet' ),
        'default'   =>'#3A3A3A',
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-grid .entry-title.elaet-grid-title'       => 'color: {{VALUE}};',
          '{{WRAPPER}} .elaet-grid .entry-title.elaet-grid-title > a'   => 'color: {{VALUE}};',
        ],
      ]
    );

    // Title margin.
    $this->add_responsive_control(
      'grid_title_style_margin',
      [
        'label'      => __( 'Margin', 'elaet' ),
        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-grid-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Style > Meta.
   */
  private function grid_meta_style_section() {
    // Tab.
    $this->start_controls_section(
      'section_grid_meta_style',
      [
        'label'     => __( 'Meta', 'elaet' ),
        'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
        'condition' => [
          'section_grid_meta.grid_meta_hide' => '',
        ],
      ]
    );

    // Meta typography.
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name'     => 'grid_meta_style_typography',
        'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} div.elaet-grid-meta span',
      ]
    );

    // Meta color.
    $this->add_control(
      'grid_meta_style_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Color', 'elaet' ),
        'default' => '#666666',
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-meta'      => 'color: {{VALUE}};',
          '{{WRAPPER}} .elaet-grid-meta span' => 'color: {{VALUE}};',
          '{{WRAPPER}} .elaet-grid-meta a'    => 'color: {{VALUE}};',
        ],
      ]
    ); 

  // Date Box Meta Styling.
    $this->add_control(
      'grid_meta_date_box_radius',
      [
        'label'     => __( 'Date Box Border Radius', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::SLIDER,
        'condition' => [
          'grid_meta_date_box' => 'yes',
        ],
        
        'range'     => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
        ],        
        'selectors'  => [
          '{{WRAPPER}} .elaet-date-meta' => 'border-radius : {{SIZE}}{{UNIT}};',
        ],
      ]
    );


    $this->start_controls_tabs( 'grid_meta_date_box_style' );

    // Normal tab.
    $this->start_controls_tab(
      'grid_meta_date_box_style_normal',
      [
        'label'     => __( 'Normal', 'elaet' ),
        'condition' => [
          'grid_meta_date_box' => 'yes',
        ],
      ]
    );

    // Normal text color.
    $this->add_control(
      'grid_meta_date_box_style_normal_text_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Text Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'separator' => '',
        'default'  => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-col-image div.elaet-date-meta' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'grid_meta_date_box' => 'yes',
        ],
      ]
    );

    // Normal background color.
    $this->add_control(
      'grid_meta_date_box_style_normal_bg_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Background Color', 'elaet' ),
        'default'  => '#006799',
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'separator' => '',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-col-image div.elaet-date-meta' => 'background-color: {{VALUE}};',
        ],
        'condition' => [
          'grid_meta_date_box' => 'yes',
        ],
      ]
    );


    $this->end_controls_tab();

    // Hover tab.
    $this->start_controls_tab(
      'grid_meta_date_box_style_hover',
      [
        'label'     => __( 'Hover', 'elaet' ),
        'condition' => [
          'grid_meta_date_box' => 'yes',
        ],
      ]
    );

    // Hover text color.
    $this->add_control(
      'grid_meta_date_box_style_hover_text_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Text Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'separator' => '',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-col-image div.elaet-date-meta:hover' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'grid_meta_date_box' => 'yes',
        ],
      ]
    );

    // Hover background color.
    $this->add_control(
      'grid_meta_date_box_style_hover_bg_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Background Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
      'separator' => '',
      'selectors' => [
        '{{WRAPPER}} .elaet-grid-col-image div.elaet-date-meta:hover' => 'background-color: {{VALUE}};',
        ],
        'condition' => [
          'grid_meta_date_box' => 'yes',
        ],
      ]
    );

    $this->end_controls_tab();

    $this->end_controls_tabs();

    // Meta margin.
    $this->add_responsive_control(
      'grid_meta_style_margin',
      [
        'label'      => __( 'Margin', 'elaet' ),
        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-grid-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Style > Content.
   */
  private function grid_content_style_section() {
    // Tab.
    $this->start_controls_section(
      'section_grid_content_style',
      [
        'label' => __( 'Content', 'elaet' ),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    // Content typography.
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name'      => 'grid_content_style_typography',
        'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_2,
        'selector'  => '{{WRAPPER}} .elaet-grid-content',
        'condition' => [
          'section_grid_content.grid_content_hide' => '',
        ],
      ]
    );

    // Content color.
    $this->add_control(
      'grid_content_style_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#666666',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-content' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'section_grid_content.grid_content_hide' => '',
        ],
      ]
    );

    // Content margin
    $this->add_responsive_control(
      'grid_content_style_margin',
      [
        'label'      => __( 'Margin', 'elaet' ),
        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-grid-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'condition'  => [
          'section_grid_content.grid_content_hide' => '',
        ],
      ]
    );

    // Heading for price options.
    $this->add_control(
      'grid_content_price_style_heading',
      [
        'label'     => __( 'Price', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'section_grid_content.grid_content_price' => 'yes',
          'section_grid.grid_post_type'             => 'product',
        ],
      ]
    );

    // Price typography.
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name'      => 'grid_content_price_style_typography',
        'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector'  => '{{WRAPPER}} .elaet-grid-price',
        'condition' => [
          'section_grid_content.grid_content_price' => 'yes',
          'section_grid.grid_post_type'             => 'product',
        ],
      ]
    );

    // Price color.
    $this->add_control(
      'grid_content_price_style_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-price' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'section_grid_content.grid_content_price' => 'yes',
          'section_grid.grid_post_type'             => 'product',
        ],
      ]
    );

    // Price bottom margin.
    $this->add_responsive_control(
      'grid_content_price_style_margin',
      [
        'label'      => __( 'Margin', 'elaet' ),
        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-grid-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'condition'  => [
          'section_grid_content.grid_content_price' => 'yes',
          'section_grid.grid_post_type'             => 'product',
        ],
      ]
    );

    // Drop Cap Heading.
    $this->add_control(
      'grid_drop_cap_style',
      [
        'label'     => __( 'Drop Cap', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'grid_drop_cap_effect' => 'yes',
          'grid_content_hide' => ''
        ],
      ]
    );

    // Drop Cap Text color.
    $this->add_control(
      'grid_drop_cap_text_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#B1B1B1',
        'selectors' => [
          '{{WRAPPER}} div.elaet-grid-content.drop-cap-class:first-letter' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'grid_drop_cap_effect' => 'yes',
          'grid_content_hide' => ''
        ],
      ]
    );

    // Buttons options.
    $this->grid_content_style_button();

    $this->end_controls_section();
  }

  /**
   * Tabs for the Style > Button section.
   */
  private function grid_content_style_button() {
    // Heading for button options.
    $this->add_control(
      'grid_button_style_heading',
      [
        'label'     => __( 'Button', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );

    // Content typography.
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name'      => 'grid_button_style_typography',
        'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector'  => '{{WRAPPER}} .elaet-grid-footer a',
        'condition' => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );

    $this->start_controls_tabs( 'grid_button_style' );

    // Normal tab.
    $this->start_controls_tab(
      'grid_button_style_normal',
      [
        'label'     => __( 'Normal', 'elaet' ),
        'condition' => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );

    // Normal text color.
    $this->add_control(
      'grid_button_style_normal_text_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Text Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default'  => '#ffffff',
        'separator' => '',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-footer a' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );

    // Normal background color.
    $this->add_control(
      'grid_button_style_normal_bg_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Background Color', 'elaet' ),
        'default'  => '#ff2b63',
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'separator' => '',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-footer a' => 'background-color: {{VALUE}};',
        ],
        'condition' => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );

    // Normal box shadow.
    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name'      => 'grid_button_style_normal_box_shadow',
        'selector'  => '{{WRAPPER}} .elaet-grid-footer a',
        'separator' => '',
        'condition' => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );

    $this->end_controls_tab();

    // Hover tab.
    $this->start_controls_tab(
      'grid_button_style_hover',
      [
        'label'     => __( 'Hover', 'elaet' ),
        'condition' => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );

    // Hover text color.
    $this->add_control(
      'grid_button_style_hover_text_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Text Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'separator' => '',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-footer a:hover' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );

    // Hover background color.
    $this->add_control(
      'grid_button_style_hover_bg_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Background Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'separator' => '',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-footer a:hover' => 'background-color: {{VALUE}};',
        ],
        'condition' => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );

    // Hover box shadow.
    $this->add_group_control(
      \Elementor\Group_Control_Box_Shadow::get_type(),
      [
        'name'      => 'grid_button_style_hover_box_shadow',
        'selector'  => '{{WRAPPER}} .elaet-grid-footer a:hover',
        'separator' => '',
        'condition' => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );

    $this->end_controls_tab();

    $this->end_controls_tabs();

    // Button padding.
    $this->add_control(
      'grid_button_style_padding',
      [
        'label'      => __( 'Button padding', 'elaet' ),
        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-grid-footer a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'condition'  => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );

    // Button border radius.
    $this->add_control(
      'grid_button_style_border_radius',
      [
        'label'      => __( 'Button border radius', 'elaet' ),
        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-grid-footer a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'condition'  => [
          'section_grid_content.grid_content_default_btn!' => '',
          'section_grid_content.grid_content_product_btn!' => '',
        ],
      ]
    );
  }

  /**
   * Style > Pagination.
   */
  private function grid_pagination_style_section() {
    // Tab.
    $this->start_controls_section(
      'section_grid_pagination_style',
      [
        'label'     => __( 'Pagination', 'elaet' ),
        'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
        'condition' => [
          'section_grid.grid_pagination' => 'yes',
        ],
      ]
    );

    $this->add_control(
      'grid_pagination_active_page_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Active Page Text Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-pagination span'    => 'color: {{VALUE}};',
        ],
      ]
    ); 

    $this->add_control(
      'grid_pagination_active_page_bg_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Active Page Background', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#2d2d2d',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-pagination span'    => 'background: {{VALUE}};',
        ],
      ]
    ); 



      $this->add_control(
      'grid_pagination_inactive_page_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Inactive Page Text Color', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-pagination a'    => 'color: {{VALUE}};',
        ],
      ]
    );

      $this->add_control(
      'grid_pagination_inactive_page_bg_color',
      [
        'type'      => \Elementor\Controls_Manager::COLOR,
        'label'     => __( 'Inactive Page Background', 'elaet' ),
        'scheme'    => [
          'type'  => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#4054b2',
        'selectors' => [
          '{{WRAPPER}} .elaet-grid-pagination a'    => 'background: {{VALUE}};',
        ],
      ]
    ); 

        // Pagination alignment.
    $this->add_responsive_control(
      'grid_pagination_alignment',
      [
        'label'          => __( 'Alignment', 'elaet' ),
        'type'           => \Elementor\Controls_Manager::CHOOSE,
        'options'        => [
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
        'default'        => 'center',
        'tablet_default' => 'center',
        'mobile_default' => 'center',
        'selectors'      => [
          '{{WRAPPER}} .elaet-grid-pagination ' => 'justify-content: {{VALUE}};',
        ],
      ]
    );

    // Image margin.
    $this->add_responsive_control(
      'grid_pagination_style_margin',
      [
        'label'      => __( 'Margin', 'elaet' ),
        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
        'default'    => [
            'top'    => '0',
            'bottom' => '0',
            'left'   => '0',
            'right'  => '5',
            'unit'   => 'px',
          ],
        'size_units' => [ 'px' ],
        'selectors'  => [
          '{{WRAPPER}} .elaet-grid-pagination .pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Render function to output the post type grid.
   */
  protected function render() {
    // Get settings.
    $settings = $this->get_settings();
    $grid_posts_class = $grid_sixth_post_class =  '';
    
    if ($settings['grid_content_first_post'] ) {
           $grid_posts_class = ' elaet-grid-parent';
    }
    
    if($settings['grid_content_sixth_post']){
            $grid_sixth_post_class = ' elaet-grid-sixth-post-parent';
            $grid_posts_class = ' elaet-grid-parent';
    }

  if($settings['grid_style'] == 'grid'){
    $grid_columns_mobile = ( ! empty( $settings['grid_columns_mobile'] ) ? ' elaet-grid-mobile-' . $settings['grid_columns_mobile'] : '' );
    $grid_columns_tablet = ( ! empty( $settings['grid_columns_tablet'] ) ? ' elaet-grid-tablet-' . $settings['grid_columns_tablet'] : '' );
    $grid_columns = ( ! empty( $settings['grid_columns'] ) ? ' elaet-grid-desktop-' . $settings['grid_columns'] : '' );
  }elseif($settings['grid_style'] == 'zigzag'){
      $grid_style = ' elaet-grid-style-zigzag';
      $grid_columns_mobile = ' elaet-grid-mobile-1';
      $grid_columns_tablet = ' elaet-grid-tablet-1';
      $grid_columns = ' elaet-grid-desktop-1';
  }elseif($settings['grid_style'] == 'list'){
      $grid_style = ' elaet-grid-style-list';
      $grid_columns_mobile = ' elaet-grid-mobile-1';
      $grid_columns_tablet = ' elaet-grid-tablet-1';
      $grid_columns = ' elaet-grid-desktop-1';
  }


    // Output.
    echo '<div class="elaet-grid">';
    echo '<div class="elaet-grid-container '. $grid_posts_class . $grid_sixth_post_class . $grid_style . $grid_columns_mobile . $grid_columns_tablet . $grid_columns . '">';

    // Arguments for query.
    $args = array();

    // Display only published posts.
    $args['post_status'] = 'publish';

    // Ignore sticky posts.
    $args['ignore_sticky_posts'] = 1;

    // Check if post type exists.
    if ( ! empty( $settings['grid_post_type'] ) && post_type_exists( $settings['grid_post_type'] ) ) {
      $args['post_type'] = $settings['grid_post_type'];
    }

    // Display posts in category.
    if ( ! empty( $settings['grid_post_categories'] ) && $settings['grid_post_type'] == 'post' ) {
      $args['category_name'] = $settings['grid_post_categories'];
    }

    // Display products in category.
    if ( ! empty( $settings['grid_product_categories'] ) && $settings['grid_post_type'] == 'product' ) {
      $args['tax_query'] = array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'product_cat',
          'field'    => 'slug',
          'terms'    => $settings['grid_product_categories'],
        ),
      );
    }

    // Items to display.
    if ( ! empty( $settings['grid_items'] ) && intval( $settings['grid_items'] ) == $settings['grid_items'] ) {
      $args['posts_per_page'] = $settings['grid_items'];
    }

    // Order by.
    if ( ! empty( $settings['grid_order_by'] ) ) {
      $args['orderby'] = $settings['grid_order_by'];
    }
    // Order Ascending or Descending.
    if ( ! empty( $settings['grid_ordering'] ) ) {
      $args['order'] = $settings['grid_ordering'];
    }

    // Pagination.
    if ( ! empty( $settings['grid_pagination'] ) ) {
      $paged         = get_query_var( 'paged' );
      if ( empty( $paged ) ) {
        $paged         = get_query_var( 'page' );
      }
      $args['paged'] = $paged;
    }

    // Query.
    $query = new \WP_Query( $args );

    // Query results.
    if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
        $query->the_post();
         
        $elaet_no_image = ( $settings['grid_image_hide'] == 'yes' || ! has_post_thumbnail() ? ' elaet-no-image' : '' );
        
        echo '<div class="elaet-grid-wrapper">';
        echo '<div class="elaet-grid-col' . $elaet_no_image . '">';

    if($settings['grid_style'] == 'zigzag'){

       // Image.
        $this->renderImage();

        echo '<div class="elaet-grid-col-content">';
        
        // Title.
        $this->renderTitle();

        // Meta.
        $this->renderMeta();

        // Content.
        $this->renderContent();
      }elseif ($settings['blog_structure'] == 'image_at_top') {
        
        // Image.
        $this->renderImage();

        echo '<div class="elaet-grid-col-content">';
        
        // Title.
        $this->renderTitle();

        // Meta.
        $this->renderMeta();

        // Content.
        $this->renderContent();

      }elseif($settings['blog_structure'] == 'image_at_middle'){

        // Title.
        $this->renderTitle();

        // Meta.
        $this->renderMeta();

        // Image.
        $this->renderImage();

        echo '<div class="elaet-grid-col-content">';

        // Content.
        $this->renderContent();  
      }    

        // Price.
        if ( class_exists( 'WooCommerce' ) ) {
          $this->renderPrice();
        }

        // Button.
        $this->renderButton();

        echo '</div><!-- .elaet-grid-col-content -->';
        echo '</div>';
        echo '</div>';

      } // End while().

      // Pagination.
      if ( ! empty( $settings['grid_pagination'] ) ) { ?>
        <div class="elaet-grid-pagination">
          <?php
          $big           = 999999999;
          $totalpages    = $query->max_num_pages;
          $current       = max( 1, $paged );
          $paginate_args = array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => $current,
            'total'     => $totalpages,
            'show_all'  => false,
            'end_size'  => 1,
            'mid_size'  => 3,
            'prev_next' => true,
            'prev_text' => esc_html__( 'Previous', 'elaet' ),
            'next_text' => esc_html__( 'Next', 'elaet' ),
            'type'      => 'plain',
            'add_args'  => false,
          );

          $pagination = paginate_links( $paginate_args ); ?>
          <nav class="pagination">
            <?php echo $pagination; ?>
          </nav>
        </div>
        <?php
      }
    } // End if().

    // Restore original data.
    wp_reset_postdata();

    echo '</div><!-- .elaet-grid-container -->';

    echo '</div><!-- .elaet-grid -->';
  }

  /**
   * Render image of post type.
   */
  protected function renderImage() {
    $settings = $this->get_settings();

    // Only in editor.
    if ( $settings['grid_image_hide'] !== 'yes' ) {
      // Check if post type has featured image.
      if ( has_post_thumbnail() ) {
       
       

        if ( $settings['grid_image_link'] == 'yes' ) {
          ?>
          <div class="elaet-grid-col-image ">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php if($settings['grid_meta_date_box'] == 'yes'){  ?>
              <div class='elaet-date-meta'>
                <span> <?php echo get_the_date('M'); ?> </span>
                <span><b> <?php echo get_the_date('j'); ?> </b></span>
                <span> <?php echo get_the_date('Y'); ?> </span>
              </div>
            <?php } ?>
              <?php 
              the_post_thumbnail(
                $settings['grid_image_size'], array(
                  'class' => 'img-responsive',
                  'alt'   => get_the_title( get_post_thumbnail_id() ),
                )
              ); ?>
            </a>
          </div>
        <?php } else { ?>
          <div class="elaet-grid-col-image ">
            <?php if($settings['grid_meta_date_box'] == 'yes'){  ?>
              <div class='elaet-date-meta'>
                <span> <?php echo get_the_date('M'); ?> </span>
                <span><b> <?php echo get_the_date('j'); ?></b></span>
                <span> <?php echo get_the_date('Y'); ?> </span>
              </div>
            <?php } ?>
            <?php
            the_post_thumbnail(
              $settings['grid_image_size'], array(
                'class' => 'img-responsive',
                'alt'   => get_the_title( get_post_thumbnail_id() ),
              )
            ); ?>
          </div>
          <?php
        }
      }
    }
  }

  /**
   * Render title of post type.
   */
  protected function renderTitle() {
    $settings = $this->get_settings();

    if ( $settings['grid_title_hide'] !== 'yes' ) { ?>
      <<?php echo $settings['grid_title_tag']; ?> class="entry-title elaet-grid-title">
      <?php if ( $settings['grid_title_link'] == 'yes' ) { ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
          <?php the_title(); ?>
        </a>
        <?php
      } else {
        the_title();
      } ?>
      </<?php echo $settings['grid_title_tag']; ?>>
      <?php
    }
  }

  /**
   * Render meta of post type.
   */
  protected function renderMeta() {
    $settings = $this->get_settings();

    if ( $settings['grid_meta_hide'] !== 'yes' ) {
      if ( ! empty( $settings['grid_meta_display'] ) ) { ?>
        <div class="entry-meta elaet-grid-meta">

          <?php
          foreach ( $settings['grid_meta_display'] as $meta ) {

            switch ( $meta ) :
              // Author
              case 'author': ?>
                <span class="elaet-grid-author">
                  <?php
                  echo ( $settings['grid_meta_remove_icons'] == '' ) ? '<i class="fa fa-user"></i>' : '';

                  echo get_the_author(); ?>
                </span>
                <?php
                 break;

              // Date           
              case 'date': ?>
                <span class="elaet-grid-date">
                  <?php
                  echo ( $settings['grid_meta_remove_icons'] == '' ) ? '<i class="fa fa-calendar"></i>' : '';
                  echo get_the_date(); ?>
                </span>
                <?php
                break;
              
              // Category           
              case 'category':
                $this->renderMetaGridCategories();
                 break;
                // Tags
               
              case 'tags':
                $this->renderMetaGridTags();
                 break;
              // Read Time
               
                case 'read-time':
          $read_time = $this->elaet_calculate_reading_time();
          $time_unit    = __( ' min ', 'zita' );
          $time_postfix = __( ' read ', 'zita' );
          if ( '' != $read_time ) {
            
  $time_icon = ( $settings['grid_meta_remove_icons'] == '' ) ? '<i class="fa fa-clock-o"></i>' : '';
  echo '<span class="elaet-reading-time">' . $time_icon . $read_time . $time_unit . $time_postfix . '</span>';         
          }
          break;
        
              // Comments/Reviews
              case 'comments': ?>
                <span class="elaet-grid-comments">
                  <?php
                  echo ( $settings['grid_meta_remove_icons'] == '' ) ? '<i class="fa fa-comment"></i>' : '';

                  if ( $settings['grid_post_type'] == 'product' ) {
                    echo comments_number( __( 'No reviews', 'elaet' ), __( '1 review', 'elaet' ), __( '% reviews', 'elaet' ) );
                  } else {
                    echo comments_number( __( 'No comments', 'elaet' ), __( '1 comment', 'elaet' ), __( '% comments', 'elaet' ) );
                  } ?>
                </span>
                <?php
                break;
            endswitch;
          } // End foreach().?>

        </div>
        <?php
      }// End if().
    }// End if().
  }

  /**
   * Display price if post type is product.
   */
  protected function renderPrice() {

    if ( ! function_exists( 'wc_get_product' ) ) {
      return null;
    }

    $settings = $this->get_settings();
    $product  = wc_get_product( get_the_ID() );

    if ( $settings['grid_post_type'] == 'product' && $settings['grid_content_price'] == 'yes' ) { ?>
      <div class="elaet-grid-price">
        <?php
        $price = $product->get_price_html();
        if ( ! empty( $price ) ) {
          echo wp_kses(
            $price, array(
              'span' => array(
                'class' => array(),
              ),
              'del'  => array(),
            )
          );
        } ?>
      </div>
      <?php
    }
  }

  /**
   * Display Add to Cart button.
   */
  protected function renderAddToCart() {

    if ( ! function_exists( 'wc_get_product' ) ) {
      return null;
    }

    $product = wc_get_product( get_the_ID() );

    echo apply_filters(
      'woocommerce_loop_add_to_cart_link',
      sprintf(
        '<a href="%s" title="%s" rel="nofollow">%s</a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->add_to_cart_text() ),
        esc_html( $product->add_to_cart_text() )
      ), $product
    );
  }

  /**
   * Render content of post type.
   */
  protected function renderContent() {
    $settings = $this->get_settings();
  $drop_cap_class = (!empty($settings['grid_drop_cap_effect'])) ? ' drop-cap-class' : '';

    if ( $settings['grid_content_hide'] !== 'yes' ) { 
   echo   '<div class="entry-content elaet-grid-content'. $drop_cap_class.'">';
        
        if( $settings['grid_content_full_post'] === 'yes' ) {
          the_content();
        } else {
          if ( empty( $settings['grid_content_length'] ) ) {
            the_excerpt();
          } else {
            echo wp_trim_words( get_the_excerpt(), $settings['grid_content_length'] );
          }
        }?>
      </div>
      <?php
    }
  }

  /**
   * Render button of post type.
   */
  protected function renderButton() {
    $settings = $this->get_settings();

    if ( $settings['grid_post_type'] == 'product' && $settings['grid_content_product_btn'] == 'yes' ) { ?>
      <div class="elaet-grid-footer">
        <?php $this->renderAddToCart(); ?>
      </div>
    <?php } elseif ( $settings['grid_content_default_btn'] == 'yes' && ! empty( $settings['grid_content_default_btn_text'] ) && $settings['grid_content_full_post'] == '' ) { ?>
      <div class="elaet-grid-footer">
        <a href="<?php echo get_the_permalink(); ?>"
           title="<?php echo $settings['grid_content_default_btn_text']; ?>"><?php echo $settings['grid_content_default_btn_text']; ?></a>
      </div>
      <?php
    }
  }

  /**
   * Display categories in meta section.
   */
  protected function renderMetaGridCategories() {
    $settings           = $this->get_settings();
    $maxCategories      = $settings['grid_meta_categories_max'] ? $settings['grid_meta_categories_max'] : '-1';
    $i                  = 0; // counter


 if ( $settings['grid_post_type'] == 'product' ) {
  $post_id = get_the_ID();
  $args = array( 'taxonomy' => 'product_cat', );
  $post_type_category = get_the_terms($post_id,$args );
  
  foreach ($post_type_category as $cat) {

  if ( $i == $maxCategories ) {
            break;
          }
    if($cat->category_parent == 0) { ?>
      <span class="elaet-grid-categories">
        <?php
        echo ( $settings['grid_meta_remove_icons'] == '' ) ? '<i class="fa fa-bookmark"></i>' : '';  
        ?>  
         <span class="elaet-grid-categories-item">
      <?php
        echo '<a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';
      }
       $i ++; 
    ?>
     </span>
  <?php   } ?>
   </span>
<?php
 
 }else{
    $post_type_category = get_the_category();
  
    if ( $post_type_category ) { ?>
      <span class="elaet-grid-categories">
        <?php
        echo ( $settings['grid_meta_remove_icons'] == '' ) ? '<i class="fa fa-bookmark"></i>' : '';

        foreach ( $post_type_category as $category ) {
          if ( $i == $maxCategories ) {
            break;
          } ?>
          <span class="elaet-grid-categories-item">
            <a href="<?php echo get_category_link( $category->term_id ); ?>"
               title="<?php echo $category->name; ?>">
              <?php echo $category->name; ?>
            </a>
          </span>
          <?php
          $i ++;
        } ?>
      </span>
      <?php
      }
    }
  }

  /**
   * Display tags in meta section.
   */
  protected function renderMetaGridTags() {
    $settings       = $this->get_settings();
   
    $maxTags        = $settings['grid_meta_tags_max'] ? $settings['grid_meta_tags_max'] : '-1';
    $i              = 0; // counter


if ( $settings['grid_post_type'] == 'product' ) {

  // get product_tags of the current product
  $post_type_tags = get_the_terms( get_the_ID(), 'product_tag' );

  //only start if we have some tags
  if ( $post_type_tags && ! is_wp_error( $post_type_tags ) ) { 
  ?>
      <span class="elaet-grid-tags">
      <?php  
        echo ( $settings['grid_meta_remove_icons'] == '' ) ? '<i class="fa fa-tags"></i>' : '';

        //for each tag we create a list item
        foreach ($post_type_tags as $tag) {
          if ( $i == $maxTags ) {
                break;
              } 
        ?>
          <span class="elaet-grid-tags-item">
        <?php
          $tag_title = $tag->name; // tag name
          $tag_link = get_term_link( $tag );// tag archive link
          echo '<a href="'.$tag_link.'">'.$tag_title.'</a>';
        ?>
          </span>
          <?php
          $i ++;
        }
          ?>
      </span>
  <?php
}
}else{
   $post_type_tags = get_the_tags();
    if ( $post_type_tags ) { ?>
      <span class="elaet-grid-tags">
        <?php
        echo ( $settings['grid_meta_remove_icons'] == '' ) ? '<i class="fa fa-tags"></i>' : '';

        foreach ( $post_type_tags as $tag ) {
          if ( $i == $maxTags ) {
            break;
          } ?>
          <span class="elaet-grid-tags-item">
            <a href="<?php echo get_tag_link( $tag->term_id ); ?>" title="<?php echo $tag->name; ?>">
              <?php echo $tag->name; ?>
            </a>
          </span>
          <?php
          $i ++;
        } ?>
      </span>
      <?php
    }
  }
}    

}


Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Post_Pro() );