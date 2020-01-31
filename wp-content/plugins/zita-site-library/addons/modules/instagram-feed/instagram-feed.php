<?php
//namespace Elementor;


// Elementor Classes.

use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Color;


if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Instagram_Feed_Elementor.
 */
class Elaet_Instagram_Feed_Elementor extends Widget_Base {

	/**
	 * Retrieve Radio Button Switcher Widget name.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'instagram-feed';
	}

	/**
	 * Retrieve Radio Button Switcher Widget title.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Instagram Feed', 'elaet' );
	}

	/**
	 * Retrieve Radio Button Switcher Widget icon.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-instagram';
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

	protected function _register_controls() {

		$this->elaet_instagram_settings_options();
		$this->elaet_content_layout_options();
		$this->elaet_image_general_options();
		$this->elaet_meta_general_options();

		$this->elaet_style_layout_options();
		$this->elaet_style_image_options();
		$this->elaet_style_meta_options();
		
	}

	/**
	 * Content Layout Options.
	 */
	private function elaet_instagram_settings_options() {
		$this->start_controls_section(
			'instagram_settings_section',
			[
				'label' => esc_html__( 'Instagram Settings', 'elaet' ),
			]
		);

		$this->add_control(
				'client_id',
				[
					'label' => __( 'Client Id', 'elaet' ),
					'type' => Controls_Manager::TEXT,
					'default' => '',
				]
			);
		$this->add_control(
				'redirect_uri',
				[
					'label' => __( 'Redirect URI', 'elaet' ),
					'type' => Controls_Manager::TEXT,
					'default' => '',
					'description' => __( 'To know how to get Client Id &amp; Redirect URI<br><a target="_blank" href="https://themehunk.com/docs/elite-instagram-feed-for-elementor">Click Here</a>', 'elaet' ) ,
				]
			);

		$this->add_control(
				'access_token',
				[
					'label' => __( 'Access Token', 'elaet' ),
					'type' => Controls_Manager::TEXT,
					'default' => '',
				]
			);

		$this->add_control(
			'filter_by_date',
			[
				'label' => __( 'Image Filtering', 'elaet' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'all_images',
				'options' => [
					'all_images' => __( 'Show All Images', 'elaet' ),
					'images_by_date' => __( 'Filter Images by Date', 'elaet' ),
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'elaet_instafeed_start_time',
			[
				'label' => esc_html__( 'From Date', 'elaet' ),
				'type' => Controls_Manager::DATE_TIME,
				'picker_options' => [
			        'enableTime' => false,
			    ],
				'default' => date("2000-01-01"),
				'description' => esc_html__( 'Choose starting date.', 'elaet' ),
				'condition' =>[
					'filter_by_date' =>'images_by_date'
				],
			]
		);

		$this->add_control(
			'elaet_instafeed_end_time',
			[
				'label' => esc_html__( 'Till Date', 'elaet' ),
				'type' => Controls_Manager::DATE_TIME,
				'picker_options' => [
			        'enableTime' => false,
			    ],
				'default' => date("Y-m-d", strtotime("+ 1 day")),
				'description' => esc_html__( 'Choose ending date.', 'elaet' ),
				'condition' =>[
					'filter_by_date' =>'images_by_date'
				],
			]
		);;


		$this->end_controls_section();
	}

	/**
	 * Content Layout Options.
	 */
	private function elaet_content_layout_options() {

		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'elaet' ),
			]
		);
		
		$this->add_responsive_control(
			'feed_columns',
			[
				'label' => __( 'Columns', 'elaet' ),
				'type' => Controls_Manager::SELECT,
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default'=> 3,
		        'tablet_default' => 2,
		        'mobile_default' => 1,
				'options' => [
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
					6 => 6,
					7 => 7,
					8 => 8,
				],
				'prefix_class' => 'elementor-grid-',
				'frontend_available' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_profile',
			[
				'label' => __( 'Show Profile', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elaet' ),
		        'label_off'    => __( 'No', 'elaet' ),
		        'return_value' => 'yes',
		        'default'      => '',
			]
		);

		$this->end_controls_section();

	}
	/**
	 * Image Options.
	 */
	private function elaet_image_general_options() {
		$this->start_controls_section(
			'instagram_image_section',
			[
				'label' => esc_html__( 'Image', 'elaet' ),
			]
		);

		$this->add_control(
			'number_of_images',
			[
				'label' => __( 'Number of Images', 'elaet' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 9,
			]
		);

		$this->add_control(
			'image_size',
			[
				'label' => __( 'Image Size', 'elaet' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'standard_resolution',
				'options' => [
					'standard_resolution' => esc_html__( 'Standard', 'elaet' ),
					'low_resolution' => esc_html__( 'Medium', 'elaet' ),
					'thumbnail' => esc_html__( 'Small', 'elaet' ),
				],
			]
		);

		$this->add_control(
			'link_to_image',
			[
				'label' => __( 'Add Link to Image', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elaet' ),
				'label_off' => __( 'Hide', 'elaet' ),
				'default' => 'yes',
				'description' => __( 'This will enable the link to image on your Instagram Account.', 'elaet' ),
			]
		);


		
		$this->end_controls_section();
	}

	/**
	 * Content Meta Options.
	 */
	private function elaet_meta_general_options() {

		$this->start_controls_section(
			'section_meta',
			[
				'label' => __( 'Meta', 'elaet' ),
			]
		);
		$this->add_control(
			'show_likes',
			[
				'label' => __( 'Show Likes', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elaet' ),
				'label_off' => __( 'Hide', 'elaet' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_comments',
			[
				'label' => __( 'Show Comments', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elaet' ),
				'label_off' => __( 'Hide', 'elaet' ),
				'default' => 'yes',
				'description' =>  __( 'Likes &amp; Comments will be displayed on image hover.', 'elaet' ),
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Style Layout Options.
	 */
	private function elaet_style_layout_options() {

		// Layout.
		$this->start_controls_section(
			'section_layout_style',
			[
				'label' => __( 'Layout', 'elaet' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Columns margin.
		$this->add_responsive_control(
			'feed_columns_margin',
			[
				'label'     => __( 'Columns margin', 'elaet' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 15,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-grid-container' => 'grid-column-gap: {{SIZE}}{{UNIT}}',
					
				],
			]
		);

		// Row margin.
		$this->add_responsive_control(
			'grid_style_rows_margin',
			[
				'label'     => __( 'Rows margin', 'elaet' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 15,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elaet-grid-container' => 'grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
      'profile_settings_heading',
      [
        'label'     => __( 'Profile Settings', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
       ]
    );

		$this->add_control(
			'link_to_profile_image',
			[
				'label' => __( 'Link image to profile ', 'elaet' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'elaet' ),
				'label_off' => __( 'No', 'elaet' ),
				'default' => 'yes',
				 'condition'   => [
          		'show_profile' => 'yes',
        		],
			]
		);

		$this->add_responsive_control(
      'profile_text_align',
      [
        'label'        => __( 'Alignment', 'elaet' ),
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
        'default' => 'center',
         'condition'   => [
          	'show_profile' => 'yes',
        ],
        'selectors'    => [
          '{{WRAPPER}} .user-insta-bio-inner' => 'text-align: {{VALUE}};',
        ],
      ]
    );

		$this->add_control(
      'profile_image_radius',
      [
        'label'      => __( 'Image Border Radius', 'elaet' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px' ],
        'default'    => [
          'top'      => '100',
          'bottom'   => '100',
          'left'     => '100',
          'right'    => '100',
          'unit'     => 'px',
        ],
        'selectors'  => [
          '{{WRAPPER}} .user-insta-bio-inner img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
         'condition'   => [
          'show_profile' => 'yes',
        ],

      ]
    );

		$this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'bio_text_typography',
        'label_block' => true,
        'label'	   => 'Profile Text Typography',
        'selector' => '{{WRAPPER}} .user-insta-bio-inner span',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
        'condition'   => [
          'show_profile' => 'yes',
        ],
      ]
    );
		// Meta color.
		$this->add_control(
			'bio_text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Color', 'elaet' ),
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'default'	=> '#556071',
				'condition'   => [
          			'show_profile' => 'yes',
        		],
				'selectors' => [
					'{{WRAPPER}} .user-insta-bio-inner span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
      'profile_spacing_heading',
      [
        'label'     => __( 'Spacing', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition'   => [
          'show_profile' => 'yes',
        ],
       ]
    );

		$this->add_responsive_control(
			'profile_image_spacing',
			[
				'label'     => __( 'Below Profile Image', 'elaet' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 5,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'condition'   => [
          			'show_profile' => 'yes',
        		],
				'selectors' => [
					'{{WRAPPER}} .user-insta-bio-inner img' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'profile_data_spacing',
			[
				'label'     => __( 'Below Bio', 'elaet' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 5,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'condition'   => [
          			'show_profile' => 'yes',
        		],
				'selectors' => [
					'{{WRAPPER}} .user-insta-bio' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);



		$this->end_controls_section();

	}

	/**
	 * Style Image Options.
	 */
	private function elaet_style_image_options() {

		// Box.
		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'Image', 'elaet' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Image border radius.
		$this->add_control(
			'feed_image_border_width',
			[
				'label'      => __( 'Border Width', 'elaet' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elaet-feed-main .elaet-feed-item img' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],				
			]
		);

		// Image border radius.
		$this->add_control(
			'feed_image_border_radius',
			[
				'label'      => __( 'Border Radius', 'elaet' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elaet-feed-main .elaet-feed-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elaet-feed-main .elaet-feed-item a:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'feed_image_style' );

		// Normal tab.
		$this->start_controls_tab(
			'feed_image_style_normal',
			[
				'label'     => __( 'Normal', 'elaet' ),
			]
		);

		// Normal border color.
		$this->add_control(
			'feed_image_style_normal_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Border Color', 'elaet' ),
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .elaet-feed-main .elaet-feed-item img' => 'border-color: {{VALUE}};',
				],
			]
		);

		// Normal box shadow.
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'feed_image_style_normal_box_shadow',
				'selector'  => '{{WRAPPER}} .elaet-feed-main .elaet-feed-item img',
			]
		);

		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'feed_image_style_hover',
			[
				'label'     => __( 'Hover', 'elaet' ),
			]
		);

		// Hover background color.
		$this->add_control(
			'feed_image_style_hover_overlay_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Overlay Color', 'elaet' ),
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => 'rgba(0,0,0,0.5)',
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .elaet-feed-main .elaet-feed-item a:before' => 'background: {{VALUE}};',
				],
			]
		);

		// Hover border color.
		$this->add_control(
			'feed_image_style_hover_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Border Color', 'elaet' ),
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .elaet-feed-main .elaet-feed-item:hover img' => 'border-color: {{VALUE}};',
				],
			]
		);

		// Hover box shadow.
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'feed_image_style_hover_box_shadow',
				'selector'  => '{{WRAPPER}} .elaet-feed-main .elaet-feed-item:hover img',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	/**
	 * Style > Meta.
	 */
	private function elaet_style_meta_options() {
		// Tab.
		$this->start_controls_section(
			'section_feed_meta_style',
			[
				'label'     => __( 'Meta', 'elaet' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
		          'show_likes' => 'yes',
		          'show_comments' => 'yes',
		        ],
			]
		);

		$this->add_control(
      'icon_style_heading',
      [
        'label'     => __( 'Choose Icon', 'elaet' ),
        'type'      => Controls_Manager::HEADING,
       ]
    );

		$this->add_control(
      'likes_icon',
      [
        'label'     => __( 'Likes', 'elaet' ),
        'type'      => Controls_Manager::ICON,
        'default'   => 'fa-heart-o',   
        'condition' => [
		          'show_likes' => 'yes',
		 ],  
      ]
    );

		$this->add_control(
      'comments_icon',
      [
        'label'     => __( 'Comments', 'elaet' ),
        'type'      => Controls_Manager::ICON,
        'default'   => 'fa-comment-o',
        'condition' => [
		          'show_comments' => 'yes',
		 ],   
      ]
    );

		// Meta color.
		$this->add_control(
			'feed_meta_style_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Color', 'elaet' ),
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'default'	=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elaet-feed-main .elaet-feed-item .elaet-feed-likes-comments span'      => 'color: {{VALUE}};',
				],
			]
		);

	$this->add_control(
      'feed_meta_style_size',
      [
        'label'     => __( 'Font Size', 'elaet' ),
        'type'      => \Elementor\Controls_Manager::SLIDER,      
        'range'     => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
          'default'   => [
          'size' => 20,
          'unit' => 'px',
        ],
        ],        
        'selectors'  => [
          '{{WRAPPER}} .elaet-feed-main .elaet-feed-item .elaet-feed-likes-comments span'      => 'font-size: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
				'feed_meta_padding',
				[
					'label'      => __( 'Padding', 'uael' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .elaet-feed-main .elaet-feed-item .elaet-feed-likes-comments span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
	);

	$this->add_responsive_control(
				'feed_meta_margin',
				[
					'label'      => __( 'Margin', 'uael' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'default'    => [
			          'top'      => '0',
			          'bottom'   => '0',
			          'left'     => '10',
			          'right'    => '10',
			          'unit'     => 'px',
			        ],
					'selectors'  => [
						'{{WRAPPER}} .elaet-feed-main .elaet-feed-item .elaet-feed-likes-comments span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
	);



		$this->end_controls_section();
	}

	// Function to get the instafeeds.

	private function instagram_feed_for_elementor_feeds( $access_token, $image_num, $image_resolution,$starttime,$endtime ) { 
		if($starttime == false && $endtime == false){
		    $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . trim( $access_token ). '&count=' . trim( $image_num );
	    }else{

	    $url = 'https://api.instagram.com/v1/users/self/media/recent/?max_timestamp='.trim( $endtime ).'&min_timestamp='.trim( $starttime ).'&access_token=' . trim( $access_token ). '&count=' . trim( $image_num );
	    	
	    }

	    $feeds_json = wp_remote_fopen( $url );

	    $feeds_obj 	= json_decode( $feeds_json, true ); 

	    $feeds_images_array = array();

	    if ( 200 == $feeds_obj['meta']['code'] ) {

	        if ( ! empty( $feeds_obj['data'] ) ) {

	            foreach ( $feeds_obj['data'] as $data ) { 
	                array_push( $feeds_images_array, array( $data['images'][$image_resolution]['url'], $data['link'], $data['likes'], $data['comments'], $data['type'] ) );
	            }

	            $ending_array = array(
	                'images' => $feeds_images_array,
	            );

	            return $ending_array;
	        }
	    }
	}

// Function to get the user bio details.

	private function instagram_bio_data_for_elementor( $access_token ){

	$url = 'https://api.instagram.com/v1/users/self/?access_token=' . trim( $access_token );

	$bio_data_json = wp_remote_fopen( $url );

	$bio_data_obj 	= json_decode( $bio_data_json, true ); 

	return $bio_data_obj;
}

	protected function render( $instance = [] ) {
		// Get settings.
		$settings = $this->get_settings();


		if ( "" == $settings['access_token'] ) {

			$client_id = $settings['client_id'];
			$redirect_uri = $settings['redirect_uri'];
		if($client_id && $redirect_uri){
			$access_token_activated = ' access-token-activated';
		}else{
			$access_token_activated = '';
		}

				$html = __( 'Please Enter Client Id and Redirect URI. Then open given link in new tab to get the access token.', 'elaet' ).'<br>'.'<a href="https://api.instagram.com/oauth/authorize/?client_id='.$client_id.'&scope=basic+public_content&redirect_uri='.$redirect_uri.'&response_type=token" target="_blank">'.__( 'Get Access Token', 'elaet' ).'</a>';
				echo '<div class='.'"access-token-div'.$access_token_activated.'">'.$html.'</div>';
				
			} else {

		?>
		<div class="elaet-feed-main">
<?php 
		if( '' == $settings['show_profile']){
			$hide_bio = ' hide-bio-class';
		}else{
			$hide_bio = '';
		}			 
?>
	<div class="user-insta-bio<?php echo $hide_bio; ?> ">
<?php
	$insta_bio_data['data']['username'] = $insta_bio_data['data']['profile_picture'] = $insta_bio_data['data']['full_name'] = $insta_bio_data['data']['bio'] = '';

	$access_token = $settings['access_token'];
	 $insta_bio_data = $this->instagram_bio_data_for_elementor(esc_html( $access_token ));  
	
	$insta_bio_data['data']['username'];
	$insta_bio_data['data']['profile_picture'];
	$insta_bio_data['data']['full_name'];
	$insta_bio_data['data']['bio'];
	

?>

	
	<div class="user-insta-bio-inner" >
	<?php 	if('yes' === $settings['link_to_profile_image']){   ?>
		<a href="<?php echo esc_url('https://www.instagram.com/'.$insta_bio_data['data']['username'] ); ?>">
			<img src="<?php echo esc_url( $insta_bio_data['data']['profile_picture'] ); ?>" alt="<?php echo $insta_bio_data['data']['username']; ?>">
		</a><br>
	<?php }else{ ?>
		
			<img src="<?php echo esc_url( $insta_bio_data['data']['profile_picture'] ); ?>" alt="<?php echo $insta_bio_data['data']['username']; ?>"><br>
	<?php }  ?>

		<span ><?php echo $insta_bio_data['data']['full_name']. ' | '; ?></span>
		<span><?php echo '@'.$insta_bio_data['data']['username']; ?></span><br>
		<span><?php echo $insta_bio_data['data']['bio']; ?></span>
	</div>

	</div>
			<div class="elaet-feed-inner">
			<?php  ?>
				<?php

		if ($settings['filter_by_date'] == 'images_by_date') {
					
		$get_start_time =  esc_attr($settings['elaet_instafeed_start_time']);
		$start_time = strtotime($get_start_time);

		$get_end_time =  esc_attr($settings['elaet_instafeed_end_time']);
		$end_time = strtotime($get_end_time);
		
		}else{
			$start_time = false;
			$end_time  = false;
		}

				$access_token = $settings['access_token'];

				$number_of_images = $settings['number_of_images'];

				$image_size = $settings['image_size'];

				$show_likes = $settings['show_likes'];

				$show_comments = $settings['show_comments'];

				$insta_feeds = $this->instagram_feed_for_elementor_feeds( esc_html( $access_token ), absint( $number_of_images ), esc_html( $image_size ),$start_time,$end_time );

			if(is_array($insta_feeds) || is_object($insta_feeds)){
				$count 	= count( $insta_feeds['images'] );
			}else{
				$count = '';
			}
			    ?>

				<div class="elaet-feed-items elaet-grid-container elementor-grid">
					<?php
				        for ( $i = 0; $i < $count; $i ++ ) {
				            if ( $insta_feeds['images'][ $i ] ) { ?>

				            	<div class="elaet-feed-item feed-type-<?php echo esc_attr( $insta_feeds['images'][ $i ][4] ); ?>">

			<?php 	if('yes' === $settings['link_to_image']){   ?>
					    		<a href="<?php echo esc_url( $insta_feeds['images'][ $i ][1]); ?>" target="_blank">

				            			<img src="<?php echo esc_url( $insta_feeds['images'][ $i ][0] ); ?>" alt="">

				            			<?php if ( 'yes' === $show_likes || 'yes' === $show_comments ) { ?>
					            			<div class="elaet-feed-likes-comments">
					            				<?php if ( 'yes' === $show_likes ) { ?>
					            					<span class="elaet-feed-likes">
					        
<i class="fa <?php echo $settings['likes_icon']; ?>" aria-hidden="true"></i>
					            <?php echo absint( $insta_feeds['images'][ $i ][2]['count']); ?></span>
					            				<?php } ?>
					            				<?php if ( 'yes' === $show_comments ) { ?>
					            					<span class="elaet-feed-comments">
					         
<i class="fa <?php echo $settings['comments_icon']; ?>" aria-hidden="true"></i>
					         <?php echo absint( $insta_feeds['images'][ $i ][3]['count']); ?></span>
					            				<?php } ?>
					            			</div>	
					            		<?php } ?>			            			
				            	</a>

			<?php }else{  ?>	
						<a href="#" >
							 <img src="<?php echo esc_url( $insta_feeds['images'][ $i ][0] ); ?>" alt="" >

				            		<?php if ( 'yes' === $show_likes || 'yes' === $show_comments ) { ?>
					            			<div class="elaet-feed-likes-comments">
					            				<?php if ( 'yes' === $show_likes ) { ?>
					            					<span class="elaet-feed-likes">
					           
		<i class="fa <?php echo $settings['likes_icon']; ?>" aria-hidden="true"></i>
					           <?php echo absint( $insta_feeds['images'][ $i ][2]['count']); ?></span>
					            				<?php } ?>
					            				<?php if ( 'yes' === $show_comments ) { ?>
					            					<span class="elaet-feed-comments">
					          
	    <i class="fa <?php echo $settings['comments_icon']; ?>" aria-hidden="true"></i> 
					          <?php echo absint( $insta_feeds['images'][ $i ][3]['count']); ?></span>
					            				<?php } ?>
					            			</div>
					    </a>	
					            	<?php } ?>	
					          
						<?php			} ?>
				            	</div>
				                <?php
				            }
				        } ?>
				</div>

			</div>			      						               
		</div>
		<?php
	}	// Render Ends Here
}

}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elaet_Instagram_Feed_Elementor() );
