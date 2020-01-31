<?php
/**
 * Attesa Theme Customizer
 *
 * @package Attesa
 */
 
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function attesa_customize_preview_js() {
	wp_enqueue_script( 'attesa-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'attesa_customize_preview_js' );

function attesa_customizer_script() {
	wp_enqueue_script( 'attesa-customizer-script', get_template_directory_uri() .'/js/customizer-script.js', array('jquery'),wp_get_theme()->get('Version'), true  );
	wp_enqueue_style( 'attesa-customizer-style', get_template_directory_uri() .'/inc/css/customizer-style.css', array(), wp_get_theme()->get('Version'));		
	if (attesa_options('_choose_icon_pack', 'font_awesome_five') == 'font_awesome_four') {
		wp_enqueue_style( 'font-awesome-4', get_template_directory_uri() .'/css/font-awesome.min.css', array(), '4.7.0');
	} elseif (attesa_options('_choose_icon_pack', 'font_awesome_five') == 'font_awesome_five') {
		wp_enqueue_style( 'font-awesome-5-all', get_template_directory_uri() .'/css/all.min.css', array(), '5.11.1');
	} elseif (attesa_options('_choose_icon_pack', 'font_awesome_five') == 'font_awesome_five_comp') {
		wp_enqueue_style( 'font-awesome-5-all', get_template_directory_uri() .'/css/all.min.css', array(), '5.11.1');
		wp_enqueue_style( 'font-awesome-4-shim', get_template_directory_uri() .'/css/v4-shims.min.css', array(), '5.11.1');
	}
	
}
add_action( 'customize_controls_enqueue_scripts', 'attesa_customizer_script' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function attesa_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'attesa_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'attesa_customize_partial_blogdescription',
		) );
	}
	/* Add Panels */
	$wp_customize->add_panel( 'attesa_themeoptions', array(
	  'priority'       => 50,
	  'capability'     => 'edit_theme_options',
	  'theme_supports' => '',
	  'title'          => esc_html__('Attesa Theme Options', 'attesa')
	) );
	/* Add Sections Theme Options */
	$wp_customize->add_section( 'section_attesa_theme_options_general', array(
	     'title'    => esc_html__( 'General Settings', 'attesa' ),
	     'priority' => 10,
		 'panel'  => 'attesa_themeoptions',
	) );
	$wp_customize->add_section( 'section_attesa_theme_options_typography', array(
	     'title'    => esc_html__( 'Typography Settings', 'attesa' ),
	     'priority' => 10,
		 'panel'  => 'attesa_themeoptions',
	) );
	$wp_customize->add_section( 'section_attesa_theme_options_colors', array(
	     'title'    => esc_html__( 'Colors Settings', 'attesa' ),
	     'priority' => 10,
		 'panel'  => 'attesa_themeoptions',
	) );
	$wp_customize->add_section( 'section_attesa_theme_options_topbar', array(
	     'title'    => esc_html__( 'Top bar settings', 'attesa' ),
	     'priority' => 10,
		 'panel'  => 'attesa_themeoptions',
	) );
	$wp_customize->add_section( 'section_attesa_theme_options_header', array(
	     'title'    => esc_html__( 'Header settings', 'attesa' ),
	     'priority' => 10,
		 'panel'  => 'attesa_themeoptions',
	) );
	$wp_customize->add_section( 'section_attesa_theme_options_postpage', array(
	     'title'    => esc_html__( 'Posts and pages settings', 'attesa' ),
	     'priority' => 10,
		 'panel'  => 'attesa_themeoptions',
	) );
	if (function_exists( 'is_woocommerce' )) {
		$wp_customize->add_section( 'section_attesa_theme_options_woocommerce', array(
			 'title'    => esc_html__( 'WooCommerce Settings', 'attesa' ),
			 'priority' => 10,
			 'panel'  => 'attesa_themeoptions',
		) );
	}
	$wp_customize->add_section( 'section_attesa_theme_options_classicsidebar', array(
	     'title'    => esc_html__( 'Classic sidebar settings', 'attesa' ),
	     'priority' => 10,
		 'panel'  => 'attesa_themeoptions',
	) );
	$wp_customize->add_section( 'section_attesa_theme_options_pushsidebar', array(
	     'title'    => esc_html__( 'Push sidebar settings', 'attesa' ),
	     'priority' => 10,
		 'panel'  => 'attesa_themeoptions',
	) );
	$wp_customize->add_section( 'section_attesa_theme_options_scrolltotop', array(
	     'title'    => esc_html__( 'Scroll to top settings', 'attesa' ),
	     'priority' => 10,
		 'panel'  => 'attesa_themeoptions',
	) );
	$wp_customize->add_section( 'section_attesa_theme_options_footer', array(
	     'title'    => esc_html__( 'Footer settings', 'attesa' ),
	     'priority' => 10,
		 'panel'  => 'attesa_themeoptions',
	) );
	$wp_customize->add_section( 'section_attesa_theme_options_social', array(
	     'title'    => esc_html__( 'Social Buttons', 'attesa' ),
	     'priority' => 10,
		 'panel'  => 'attesa_themeoptions',
	) );
	/**
	* ################ SECTION GENERAL SETTINGS
	*/
	/* Heading general options */
	$wp_customize->add_setting('attesa_theme_options[_heading_general_options]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_general_options]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_general_options]',
			'section'		=> 'section_attesa_theme_options_general',
			'label'			=> __( 'General Options', 'attesa' ),
			'priority' => 1,
		))
	);
	/* Show Page Loader */
	$wp_customize->add_setting('attesa_theme_options[_show_loader]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_loader]', array(
        'label'      => __( 'Show page loader', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_show_loader]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Choose page loader */
	$wp_customize->add_setting('attesa_theme_options[_choose_loader]', array(
        'default'    => 'loader1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_choose_loader]', array(
        'label'      => __( 'Choose loader style', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_choose_loader]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_loader_active',
		'priority' => 1,
		'choices' => array(
			'loader1' => __( 'Loader 1', 'attesa'),
			'loader2' => __( 'Loader 2', 'attesa'),
		),
    ) );
	/* Choose icon pack */
	$wp_customize->add_setting('attesa_theme_options[_choose_icon_pack]', array(
        'default'    => 'font_awesome_five',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_choose_icon_pack]', array(
        'label'      => __( 'Choose icon pack', 'attesa' ),
		'description' => __('After changing the icon pack, save the settings and refresh this page to update icon set.<br/>Note: Changing the icon pack may reset the previously chosen icons', 'attesa'),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_choose_icon_pack]',
        'type'       => 'select',
		'priority' => 1,
		'choices' => array(
			'font_awesome_four' => __( 'Font Awesome 4', 'attesa'),
			'font_awesome_five_comp' => __( 'Font Awesome 5 and compatibility with 4', 'attesa'),
			'font_awesome_five' => __('Font Awesome 5', 'attesa'),
		),
    ) );
	/* Enable Schema Markup */
	$wp_customize->add_setting('attesa_theme_options[_schema_markup]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_schema_markup]', array(
        'label'      => __( 'Enable Schema Markup', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_schema_markup]',
        'type'       => 'checkbox',
		'priority' => 2,
    ) );
	/* Enable Smooth Scroll */
	$wp_customize->add_setting('attesa_theme_options[_smooth_scroll]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_smooth_scroll]', array(
        'label'      => __( 'Enable Smooth Scroll', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_smooth_scroll]',
        'type'       => 'checkbox',
		'priority' => 2,
    ) );
	/* Elements border radius */
	$wp_customize->add_setting('attesa_theme_options[_elements_border_radius]', array(
        'default'    => '5',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint'
    ) );
	$wp_customize->add_control('attesa_theme_options[_elements_border_radius]', array(
        'label'      => __( 'Border radius for elements (in pixel)', 'attesa' ),
		'description'	=> __( 'Default value 5', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_elements_border_radius]',
        'type'       => 'number',
		'input_attrs' => array(
			'min'           => 0,
			'max'           => 100,
			'step'          => 1,
		),
		'priority' => 3,
    ) );
	/* Show Social Network float */
	$wp_customize->add_setting('attesa_theme_options[_social_float]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_social_float]', array(
        'label'      => __( 'Show social network in float', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_social_float]',
        'type'       => 'checkbox',
		'priority' => 3,
    ) );
	/* Social network float position */
	$wp_customize->add_setting('attesa_theme_options[_socialfloat_position]', array(
        'default'    => 'left',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_socialfloat_position]', array(
        'label'      => __( 'Social network float position', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_socialfloat_position]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_socialfloat_active',
		'priority' => 3,
		'choices' => array(
			'right' => __( 'Right', 'attesa'),
			'left' => __( 'Left', 'attesa'),
		),
    ) );
	/* Hover effects image */
	$wp_customize->add_setting('attesa_theme_options[_imagehover_effect]', array(
        'default'    => 'none',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_imagehover_effect]', array(
        'label'      => __( 'Images hover effect', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_imagehover_effect]',
        'type'       => 'select',
		'priority' => 3,
		'choices' => array(
			'none' => __( 'No effect', 'attesa'),
			'blur' => __( 'Blur', 'attesa'),
			'grayscale' => __( 'Gray Scale', 'attesa'),
			'invert' => __( 'Invert', 'attesa'),
			'sepia' => __( 'Sepia', 'attesa'),
		),
    ) );
	/* Widgets title heading */
	$wp_customize->add_setting('attesa_theme_options[_widgets_heading]', array(
        'default'    => 'h3',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_widgets_heading]', array(
        'label'      => __( 'Widgets title heading', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_widgets_heading]',
        'type'       => 'select',
		'priority' => 3,
		'choices' => array(
			'h1' => __( 'H1', 'attesa'),
			'h2' => __( 'H2', 'attesa'),
			'h3' => __( 'H3', 'attesa'),
			'h4' => __( 'H4', 'attesa'),
			'h5' => __( 'H5', 'attesa'),
			'h6' => __( 'H6', 'attesa'),
		),
    ) );
	/* Heading width section */
	$wp_customize->add_setting('attesa_theme_options[_heading_width_content]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_width_content]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_width_content]',
			'section'		=> 'section_attesa_theme_options_general',
			'label'			=> __( 'Site Width Section', 'attesa' ),
			'priority' => 3,
		))
	);
	/* Website structure */
	$wp_customize->add_setting('attesa_theme_options[_website_structure]', array(
        'default'    => 'wide',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_website_structure]', array(
        'label'      => __( 'Website structure', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_website_structure]',
        'type'       => 'select',
		'priority' => 3,
		'choices' => array(
			'wide' => __( 'Wide', 'attesa'),
			'boxed' => __( 'Boxed', 'attesa'),
		),
    ) );
	/* Max width for website structure */
	$wp_customize->add_setting('attesa_theme_options[_max_width_structure]', array(
        'default'    => '1500',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint'
    ) );
	$wp_customize->add_control('attesa_theme_options[_max_width_structure]', array(
        'label'      => __( 'Max width for boxed website (in pixel)', 'attesa' ),
		'description'	=> __( 'Default value 1500', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_max_width_structure]',
        'type'       => 'number',
		'active_callback' => 'attesa_is_website_boxed',
		'input_attrs' => array(
			'min'           => 900,
			'max'           => 1920,
			'step'          => 10,
		),
		'priority' => 3,
    ) );
	/* Max width for content */
	$wp_customize->add_setting('attesa_theme_options[_max_width]', array(
        'default'    => '1240',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint'
    ) );
	$wp_customize->add_control('attesa_theme_options[_max_width]', array(
        'label'      => __( 'Max width for site content (in pixel)', 'attesa' ),
		'description'	=> __( 'Default value 1240', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_max_width]',
        'type'       => 'number',
		'input_attrs' => array(
			'min'           => 900,
			'max'           => 1920,
			'step'          => 10,
		),
		'priority' => 4,
    ) );
	/* Width for content side */
	$wp_customize->add_setting('attesa_theme_options[_width_content]', array(
        'default'    => '67',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint'
    ) );
	$wp_customize->add_control('attesa_theme_options[_width_content]', array(
        'label'      => __( 'Width for content side with sidebar (in percentage)', 'attesa' ),
		'description'	=> __( 'Default value 67, the sidebar will automatically adapt to new measures to complete 100%', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_width_content]',
        'type'       => 'number',
		'input_attrs' => array(
			'min'           => 10,
			'max'           => 100,
			'step'          => 1,
		),
		'priority' => 5,
    ) );
	/* Width for content side without sidebar */
	$wp_customize->add_setting('attesa_theme_options[_width_content_nosidebar]', array(
        'default'    => '67',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint'
    ) );
	$wp_customize->add_control('attesa_theme_options[_width_content_nosidebar]', array(
        'label'      => __( 'Width for content side without sidebar (in percentage)', 'attesa' ),
		'description'	=> __( 'Default value 67', 'attesa' ),
        'section'    => 'section_attesa_theme_options_general',
        'settings'   => 'attesa_theme_options[_width_content_nosidebar]',
        'type'       => 'number',
		'input_attrs' => array(
			'min'           => 10,
			'max'           => 100,
			'step'          => 1,
		),
		'priority' => 6,
    ) );
	/**
	* ################ SECTION TYPOGRAPHY SETTINGS
	*/
	/* Heading font section */
	$wp_customize->add_setting('attesa_theme_options[_heading_font]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_font]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_font]',
			'section'		=> 'section_attesa_theme_options_typography',
			'label'			=> __( 'Font Family settings', 'attesa' ),
			'priority' => 1,
		))
	);
	/* Disable Google Fonts */
	$wp_customize->add_setting('attesa_theme_options[_disable_google_fonts]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_disable_google_fonts]', array(
        'label'      => __( 'Disable Google Fonts and use standard fonts', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_disable_google_fonts]',
        'type'       => 'checkbox',
		'priority' => 2,
    ) );
	/* Heading Google Fonts */
	$wp_customize->add_setting('attesa_theme_options[_googlefont_heading]', array(
        'default'    => 'Quicksand : sans-serif',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_fonts',
    ) );
	$wp_customize->add_control('attesa_theme_options[_googlefont_heading]', array(
        'label'      => __( 'Choose the Heading Google Font', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_googlefont_heading]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_googlefont_active',
		'priority' => 3,
		'choices' => attesa_google_fonts_heading()
    ) );
	/* Text Google Font */
	$wp_customize->add_setting('attesa_theme_options[_googlefont_text]', array(
        'default'    => 'Quicksand : sans-serif',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_fonts',
    ) );
	$wp_customize->add_control('attesa_theme_options[_googlefont_text]', array(
        'label'      => __( 'Choose the Text Google Font', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_googlefont_text]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_googlefont_active',
		'priority' => 4,
		'choices' => attesa_google_fonts_text()
    ) );
	/* Heading Standard Fonts */
	$wp_customize->add_setting('attesa_theme_options[_standardfont_heading]', array(
        'default'    => 'Arial : sans-serif',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_fonts',
    ) );
	$wp_customize->add_control('attesa_theme_options[_standardfont_heading]', array(
        'label'      => __( 'Choose the Heading Standard Font', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_standardfont_heading]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_googlefont_disable',
		'priority' => 5,
		'choices' => array(
			'Arial : sans-serif' => esc_html__( 'Arial', 'attesa'),
			'Arial Black : sans-serif' => esc_html__( 'Arial Black', 'attesa'),
			'Comic Sans MS : sans-serif' => esc_html__( 'Comic Sans MS', 'attesa'),
			'Impact : sans-serif' => esc_html__( 'Impact', 'attesa'),
			'Lucida Sans Unicode : sans-serif' => esc_html__( 'Lucida Sans Unicode', 'attesa'),
			'Tahoma : sans-serif' => esc_html__( 'Tahoma', 'attesa'),
			'Trebuchet MS : sans-serif' => esc_html__( 'Trebuchet MS', 'attesa'),
			'Verdana : sans-serif' => esc_html__( 'Verdana', 'attesa'),
			'Georgia : serif' => esc_html__( 'Georgia', 'attesa'),
			'Palatino Linotype : serif' => esc_html__( 'Palatino Linotype', 'attesa'),
			'Times New Roman : serif' => esc_html__( 'Times New Roman', 'attesa'),
			'Courier New : monospace' => esc_html__( 'Courier New', 'attesa'),
			'Lucida Console : monospace' => esc_html__( 'Lucida Console', 'attesa'),
		),
    ) );
	/* Text Standard Fonts */
	$wp_customize->add_setting('attesa_theme_options[_standardfont_text]', array(
        'default'    => 'Arial : sans-serif',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_fonts',
    ) );
	$wp_customize->add_control('attesa_theme_options[_standardfont_text]', array(
        'label'      => __( 'Choose the Text Standard Font', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_standardfont_text]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_googlefont_disable',
		'priority' => 6,
		'choices' => array(
			'Arial : sans-serif' => esc_html__( 'Arial', 'attesa'),
			'Arial Black : sans-serif' => esc_html__( 'Arial Black', 'attesa'),
			'Comic Sans MS : sans-serif' => esc_html__( 'Comic Sans MS', 'attesa'),
			'Impact : sans-serif' => esc_html__( 'Impact', 'attesa'),
			'Lucida Sans Unicode : sans-serif' => esc_html__( 'Lucida Sans Unicode', 'attesa'),
			'Tahoma : sans-serif' => esc_html__( 'Tahoma', 'attesa'),
			'Trebuchet MS : sans-serif' => esc_html__( 'Trebuchet MS', 'attesa'),
			'Verdana : sans-serif' => esc_html__( 'Verdana', 'attesa'),
			'Georgia : serif' => esc_html__( 'Georgia', 'attesa'),
			'Palatino Linotype : serif' => esc_html__( 'Palatino Linotype', 'attesa'),
			'Times New Roman : serif' => esc_html__( 'Times New Roman', 'attesa'),
			'Courier New : monospace' => esc_html__( 'Courier New', 'attesa'),
			'Lucida Console : monospace' => esc_html__( 'Lucida Console', 'attesa'),
		),
    ) );
	/* Heading font size section */
	$wp_customize->add_setting('attesa_theme_options[_heading_font_size]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_font_size]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_font_size]',
			'section'		=> 'section_attesa_theme_options_typography',
			'label'			=> __( 'Font size settings', 'attesa' ),
			'priority' => 7,
		))
	);
	/* General font size */
	$wp_customize->add_setting('attesa_theme_options[_general_font_size]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '16px'
    ) );
	$wp_customize->add_control('attesa_theme_options[_general_font_size]', array(
        'label'      => __( 'General text font size', 'attesa' ),
		'description'	=> __( 'Default value 16px', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_general_font_size]',
        'type'       => 'text',
		'priority' => 8,
    ) );
	/* Small font size */
	$wp_customize->add_setting('attesa_theme_options[_smalltext_font_size]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '13px'
    ) );
	$wp_customize->add_control('attesa_theme_options[_smalltext_font_size]', array(
        'label'      => __( 'Small font size', 'attesa' ),
		'description'	=> __( 'Default value 13px', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_smalltext_font_size]',
        'type'       => 'text',
		'priority' => 9,
    ) );
	/* Site title font size */
	$wp_customize->add_setting('attesa_theme_options[_sitetitle_font_size]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '18px'
    ) );
	$wp_customize->add_control('attesa_theme_options[_sitetitle_font_size]', array(
        'label'      => __( 'Site title font size', 'attesa' ),
		'description'	=> __( 'Default value 18px', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_sitetitle_font_size]',
        'type'       => 'text',
		'priority' => 10,
    ) );
	/* Main menu font size */
	$wp_customize->add_setting('attesa_theme_options[_mainmenu_font_size]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '14px'
    ) );
	$wp_customize->add_control('attesa_theme_options[_mainmenu_font_size]', array(
        'label'      => __( 'Main menu font size', 'attesa' ),
		'description'	=> __( 'Default value 14px', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_mainmenu_font_size]',
        'type'       => 'text',
		'priority' => 11,
    ) );
	/* Header title */
	$wp_customize->add_setting('attesa_theme_options[_headertitle_font_size]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '48px'
    ) );
	$wp_customize->add_control('attesa_theme_options[_headertitle_font_size]', array(
        'label'      => __( 'Header title (post,page,etc..)', 'attesa' ),
		'description'	=> __( 'Default value 48px', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_headertitle_font_size]',
        'type'       => 'text',
		'priority' => 12,
    ) );
	/* Widget title */
	$wp_customize->add_setting('attesa_theme_options[_widgettitle_font_size]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '19px'
    ) );
	$wp_customize->add_control('attesa_theme_options[_widgettitle_font_size]', array(
        'label'      => __( 'Widget title', 'attesa' ),
		'description'	=> __( 'Default value 19px', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_widgettitle_font_size]',
        'type'       => 'text',
		'priority' => 13,
    ) );
	/* Widget text */
	$wp_customize->add_setting('attesa_theme_options[_widgettext_font_size]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '14px'
    ) );
	$wp_customize->add_control('attesa_theme_options[_widgettext_font_size]', array(
        'label'      => __( 'Widget text', 'attesa' ),
		'description'	=> __( 'Default value 14px', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_widgettext_font_size]',
        'type'       => 'text',
		'priority' => 14,
    ) );
	if (function_exists( 'is_woocommerce' )) {
		/* WooCommerce Headings */
		$wp_customize->add_setting('attesa_theme_options[_wooheadings_font_size]', array(
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'default'    => '32px'
		) );
		$wp_customize->add_control('attesa_theme_options[_wooheadings_font_size]', array(
			'label'      => __( 'WooCommerce Headings (single product title, related products, tabs, etc...)', 'attesa' ),
			'description'	=> __( 'Default value 32px', 'attesa' ),
			'section'    => 'section_attesa_theme_options_typography',
			'settings'   => 'attesa_theme_options[_wooheadings_font_size]',
			'type'       => 'text',
			'priority' => 15,
		) );
	}
	/* Heading line height section */
	$wp_customize->add_setting('attesa_theme_options[_heading_line_height]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_line_height]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_line_height]',
			'section'		=> 'section_attesa_theme_options_typography',
			'label'			=> __( 'Line height settings', 'attesa' ),
			'priority' => 16,
		))
	);
	/* Content line height */
	$wp_customize->add_setting('attesa_theme_options[_content_line_height]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '2'
    ) );
	$wp_customize->add_control('attesa_theme_options[_content_line_height]', array(
        'label'      => __( 'Content line height', 'attesa' ),
		'description'	=> __( 'Default value 2', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_content_line_height]',
        'type'       => 'text',
		'priority' => 17,
    ) );
	/* Page title line height */
	$wp_customize->add_setting('attesa_theme_options[_pagetitle_line_height]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '1.3'
    ) );
	$wp_customize->add_control('attesa_theme_options[_pagetitle_line_height]', array(
        'label'      => __( 'Page title line height (post,page,etc..)', 'attesa' ),
		'description'	=> __( 'Default value 1.3', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_pagetitle_line_height]',
        'type'       => 'text',
		'priority' => 18,
    ) );
	/* Widget line height */
	$wp_customize->add_setting('attesa_theme_options[_widget_line_height]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '2'
    ) );
	$wp_customize->add_control('attesa_theme_options[_widget_line_height]', array(
        'label'      => __( 'Widget line height', 'attesa' ),
		'description'	=> __( 'Default value 2', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_widget_line_height]',
        'type'       => 'text',
		'priority' => 19,
    ) );
	/* Widget title line height */
	$wp_customize->add_setting('attesa_theme_options[_widgettitle_line_height]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '1.5'
    ) );
	$wp_customize->add_control('attesa_theme_options[_widgettitle_line_height]', array(
        'label'      => __( 'Widget title line height', 'attesa' ),
		'description'	=> __( 'Default value 1.5', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_widgettitle_line_height]',
        'type'       => 'text',
		'priority' => 20,
    ) );
	/* Heading font weight section */
	$wp_customize->add_setting('attesa_theme_options[_heading_font_weight]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_font_weight]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_font_weight]',
			'section'		=> 'section_attesa_theme_options_typography',
			'label'			=> __( 'Font weight settings', 'attesa' ),
			'priority' => 21,
		))
	);
	/* Site Title font weight */
	$wp_customize->add_setting('attesa_theme_options[_sitetitle_font_weight]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => 'bold'
    ) );
	$wp_customize->add_control('attesa_theme_options[_sitetitle_font_weight]', array(
        'label'      => __( 'Site Title font weight', 'attesa' ),
		'description'	=> __( 'Default bold', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_sitetitle_font_weight]',
        'type'       => 'select',
		'priority' => 22,
		'choices' => array(
			'bold' => __( 'Bold', 'attesa'),
			'normal' => __( 'Normal', 'attesa'),
		),
    ) );
	/* Header Title font weight */
	$wp_customize->add_setting('attesa_theme_options[_headertitle_font_weight]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => 'normal'
    ) );
	$wp_customize->add_control('attesa_theme_options[_headertitle_font_weight]', array(
        'label'      => __( 'Header title font weight (post,page,etc..)', 'attesa' ),
		'description'	=> __( 'Default normal', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_headertitle_font_weight]',
        'type'       => 'select',
		'priority' => 23,
		'choices' => array(
			'bold' => __( 'Bold', 'attesa'),
			'normal' => __( 'Normal', 'attesa'),
		),
    ) );
	/* Widget Title font weight */
	$wp_customize->add_setting('attesa_theme_options[_widgettitle_font_weight]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => 'bold'
    ) );
	$wp_customize->add_control('attesa_theme_options[_widgettitle_font_weight]', array(
        'label'      => __( 'Widget title font weight', 'attesa' ),
		'description'	=> __( 'Default bold', 'attesa' ),
        'section'    => 'section_attesa_theme_options_typography',
        'settings'   => 'attesa_theme_options[_widgettitle_font_weight]',
        'type'       => 'select',
		'priority' => 24,
		'choices' => array(
			'bold' => __( 'Bold', 'attesa'),
			'normal' => __( 'Normal', 'attesa'),
		),
    ) );
	/**
	* ################ SECTION THEME COLORS SETTINGS
	*/
	/* Heading general colors */
	$wp_customize->add_setting('attesa_theme_options[_heading_general_colors]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_general_colors]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_general_colors]',
			'section'		=> 'section_attesa_theme_options_colors',
			'label'			=> __( 'General colors', 'attesa' ),
			'priority' => 1,
		))
	);
	/* Outer background color' */
	$wp_customize->add_setting( 'attesa_theme_options[_outer_background_color]', array(
		'default' => '#cccccc',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_outer_background_color]', 
		array(
			'label' => __( 'Outer background color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_outer_background_color]',
			'active_callback' => 'attesa_is_website_boxed',
			'priority' => 2,
		) )
	);
	/* General background color' */
	$wp_customize->add_setting( 'attesa_theme_options[_general_background_color]', array(
		'default' => '#ffffff',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_general_background_color]', 
		array(
			'label' => __( 'General background color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_general_background_color]',
			'priority' => 3,
		) )
	);
	/* Alternative background color' */
	$wp_customize->add_setting( 'attesa_theme_options[_alternative_background_color]', array(
		'default' => '#fbfbfb',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_alternative_background_color]', 
		array(
			'label' => __( 'Alternative background color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_alternative_background_color]',
			'priority' => 4,
		) )
	);
	/* General text color' */
	$wp_customize->add_setting( 'attesa_theme_options[_general_text_color]', array(
		'default' => '#404040',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_general_text_color]', 
		array(
			'label' => __( 'General text color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_general_text_color]',
			'priority' => 5,
		) )
	);
	/* Content text color' */
	$wp_customize->add_setting( 'attesa_theme_options[_content_text_color]', array(
		'default' => '#828282',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_content_text_color]', 
		array(
			'label' => __( 'Content text color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_content_text_color]',
			'priority' => 6,
		) )
	);
	/* General link color' */
	$wp_customize->add_setting( 'attesa_theme_options[_general_link_color]', array(
		'default' => '#f06292',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_general_link_color]', 
		array(
			'label' => __( 'General link color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_general_link_color]',
			'priority' => 7,
		) )
	);
	/* General border color' */
	$wp_customize->add_setting( 'attesa_theme_options[_general_border_color]', array(
		'default' => '#ececec',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_general_border_color]', 
		array(
			'label' => __( 'General border color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_general_border_color]',
			'priority' => 8,
		) )
	);
	/* Heading top bar color section */
	$wp_customize->add_setting('attesa_theme_options[_heading_topbar_color]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_topbar_color]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_topbar_color]',
			'section'		=> 'section_attesa_theme_options_colors',
			'label'			=> __( 'Top bar colors', 'attesa' ),
			'active_callback' => 'attesa_is_topbar_active',
			'priority' => 9,
		))
	);
	/* Top bar background color' */
	$wp_customize->add_setting( 'attesa_theme_options[_topbar_background_color]', array(
		'default' => '#fbfbfb',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_topbar_background_color]', 
		array(
			'label' => __( 'Top bar background color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_topbar_background_color]',
			'active_callback' => 'attesa_is_topbar_active',
			'priority' => 10,
		) )
	);
	/* Top bar text color' */
	$wp_customize->add_setting( 'attesa_theme_options[_topbar_text_color]', array(
		'default' => '#828282',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_topbar_text_color]', 
		array(
			'label' => __( 'Top bar text color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_topbar_text_color]',
			'active_callback' => 'attesa_is_topbar_active',
			'priority' => 11,
		) )
	);
	/* Top bar border color' */
	$wp_customize->add_setting( 'attesa_theme_options[_topbar_border_color]', array(
		'default' => '#ececec',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_topbar_border_color]', 
		array(
			'label' => __( 'Top bar border color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_topbar_border_color]',
			'active_callback' => 'attesa_is_topbar_active',
			'priority' => 12,
		) )
	);
	/* Heading classic sidebar color section */
	$wp_customize->add_setting('attesa_theme_options[_heading_classicsidebar_color]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_classicsidebar_color]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_classicsidebar_color]',
			'section'		=> 'section_attesa_theme_options_colors',
			'label'			=> __( 'Classic sidebar colors', 'attesa' ),
			'priority' => 13,
		))
	);
	/* Classic sidebar background color' */
	$wp_customize->add_setting( 'attesa_theme_options[_classicsidebar_background_color]', array(
		'default' => '#fbfbfb',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_classicsidebar_background_color]', 
		array(
			'label' => __( 'Classic sidebar background color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_classicsidebar_background_color]',
			'priority' => 14,
		) )
	);
	/* Classic sidebar text color' */
	$wp_customize->add_setting( 'attesa_theme_options[_classicsidebar_text_color]', array(
		'default' => '#404040',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_classicsidebar_text_color]', 
		array(
			'label' => __( 'Classic sidebar text color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_classicsidebar_text_color]',
			'priority' => 15,
		) )
	);
	/* Classic sidebar link color' */
	$wp_customize->add_setting( 'attesa_theme_options[_classicsidebar_link_color]', array(
		'default' => '#f06292',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_classicsidebar_link_color]', 
		array(
			'label' => __( 'Classic sidebar link color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_classicsidebar_link_color]',
			'priority' => 16,
		) )
	);
	/* Classic sidebar border color' */
	$wp_customize->add_setting( 'attesa_theme_options[_classicsidebar_border_color]', array(
		'default' => '#ececec',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_classicsidebar_border_color]', 
		array(
			'label' => __( 'Classic sidebar border color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_classicsidebar_border_color]',
			'priority' => 17,
		) )
	);
	/* Heading push sidebar color section */
	$wp_customize->add_setting('attesa_theme_options[_heading_pushsidebar_color]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_pushsidebar_color]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_pushsidebar_color]',
			'section'		=> 'section_attesa_theme_options_colors',
			'label'			=> __( 'Push sidebar colors', 'attesa' ),
			'priority' => 18,
		))
	);
	/* Push sidebar background color' */
	$wp_customize->add_setting( 'attesa_theme_options[_pushsidebar_background_color]', array(
		'default' => '#fbfbfb',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_pushsidebar_background_color]', 
		array(
			'label' => __( 'Push sidebar background color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_pushsidebar_background_color]',
			'priority' => 19,
		) )
	);
	/* Push sidebar text color' */
	$wp_customize->add_setting( 'attesa_theme_options[_pushsidebar_text_color]', array(
		'default' => '#909090',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_pushsidebar_text_color]', 
		array(
			'label' => __( 'Push sidebar text color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_pushsidebar_text_color]',
			'priority' => 20,
		) )
	);
	/* Push sidebar link color' */
	$wp_customize->add_setting( 'attesa_theme_options[_pushsidebar_link_color]', array(
		'default' => '#f06292',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_pushsidebar_link_color]', 
		array(
			'label' => __( 'Push sidebar link color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_pushsidebar_link_color]',
			'priority' => 21,
		) )
	);
	/* Push sidebar border color' */
	$wp_customize->add_setting( 'attesa_theme_options[_pushsidebar_border_color]', array(
		'default' => '#ececec',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_pushsidebar_border_color]', 
		array(
			'label' => __( 'Push sidebar border color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_pushsidebar_border_color]',
			'priority' => 22,
		) )
	);
	/* Heading footer color section */
	$wp_customize->add_setting('attesa_theme_options[_heading_footer_color]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_footer_color]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_footer_color]',
			'section'		=> 'section_attesa_theme_options_colors',
			'label'			=> __( 'Footer colors', 'attesa' ),
			'priority' => 23,
		))
	);
	/* Footer background color */
	$wp_customize->add_setting( 'attesa_theme_options[_footer_background_color]', array(
		'default' => '#3f3f3f',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_footer_background_color]', 
		array(
			'label' => __( 'Footer background color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_footer_background_color]',
			'priority' => 24,
		) )
	);
	/* Footer text color */
	$wp_customize->add_setting( 'attesa_theme_options[_footer_text_color]', array(
		'default' => '#f0f0f0',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_footer_text_color]', 
		array(
			'label' => __( 'Footer text color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_footer_text_color]',
			'priority' => 25,
		) )
	);
	/* Footer link color */
	$wp_customize->add_setting( 'attesa_theme_options[_footer_link_color]', array(
		'default' => '#aeaeae',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_footer_link_color]', 
		array(
			'label' => __( 'Footer link color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_footer_link_color]',
			'priority' => 26,
		) )
	);
	/* Footer border color */
	$wp_customize->add_setting( 'attesa_theme_options[_footer_border_color]', array(
		'default' => '#bcbcbc',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_footer_border_color]', 
		array(
			'label' => __( 'Footer border color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_footer_border_color]',
			'priority' => 27,
		) )
	);
	/* Sub-Footer background color */
	$wp_customize->add_setting( 'attesa_theme_options[_subfooter_background_color]', array(
		'default' => '#181818',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_subfooter_background_color]', 
		array(
			'label' => __( 'Sub-Footer background color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_subfooter_background_color]',
			'priority' => 28,
		) )
	);
	/* Sub-Footer text color */
	$wp_customize->add_setting( 'attesa_theme_options[_subfooter_text_color]', array(
		'default' => '#ffffff',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_subfooter_text_color]', 
		array(
			'label' => __( 'Sub-Footer text color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_subfooter_text_color]',
			'priority' => 29,
		) )
	);
	/* Sub-Footer link color */
	$wp_customize->add_setting( 'attesa_theme_options[_subfooter_link_color]', array(
		'default' => '#9a9a9a',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_subfooter_link_color]', 
		array(
			'label' => __( 'Sub-Footer link color', 'attesa' ),
			'section' => 'section_attesa_theme_options_colors',
			'settings' =>'attesa_theme_options[_subfooter_link_color]',
			'priority' => 30,
		) )
	);
	/**
	* ################ SECTION TOPBAR SETTINGS
	*/
	/* Show Top Bar */
	$wp_customize->add_setting('attesa_theme_options[_show_topbar]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_topbar]', array(
        'label'      => __( 'Show top bar', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_show_topbar]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Show Top Bar also on tablet/smartphone */
	$wp_customize->add_setting('attesa_theme_options[_show_topbar_mobile]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_topbar_mobile]', array(
        'label'      => __( 'Show top bar also on tablet/smartphone', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_show_topbar_mobile]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 1,
    ) );
	/* Invert position */
	$wp_customize->add_setting('attesa_theme_options[_topbar_invert]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_topbar_invert]', array(
        'label'      => __( 'Invert position', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_topbar_invert]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 1,
    ) );
	/* Top bar style */
	$wp_customize->add_setting('attesa_theme_options[_topbar_style]', array(
        'default'    => 'boxed',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_topbar_style]', array(
        'label'      => __( 'Top bar style', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_topbar_style]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 2,
		'choices' => array(
			'boxed' => __( 'Boxed', 'attesa'),
			'fullwidth' => __( 'Full width', 'attesa'),
		),
    ) );
	/* Top bar scroll */
	$wp_customize->add_setting('attesa_theme_options[_topbar_scroll]', array(
        'default'    => 'hide',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_topbar_scroll]', array(
        'label'      => __( 'Top bar scroll', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_topbar_scroll]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 3,
		'choices' => array(
			'hide' => __( 'Hide when scroll down', 'attesa'),
			'show' => __( 'Show when scroll down', 'attesa'),
		),
    ) );
	/* Show Search button */
	$wp_customize->add_setting('attesa_theme_options[_show_search]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_search]', array(
        'label'      => __( 'Show search button', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_show_search]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 4,
    ) );
	/* Show WooCommerce Cart */
	$wp_customize->add_setting('attesa_theme_options[_show_woocart]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_woocart]', array(
        'label'      => __( 'Show WooCommerce Cart', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_show_woocart]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_topbar_and_woo_active',
		'priority' => 5,
    ) );
	/* FontAwesome WooCommerce cart Icon */
	$wp_customize->add_setting('attesa_theme_options[_woocommercecart_icon]', array(
		'default'			=> 'fa fa-shopping-cart',
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Fontawesome_Icon(
		$wp_customize,
		'attesa_theme_options[_woocommercecart_icon]',
		array(
			'settings'		=> 'attesa_theme_options[_woocommercecart_icon]',
			'section'		=> 'section_attesa_theme_options_topbar',
			'label'			=> __( 'WooCommerce Cart Icon', 'attesa' ),
			'type'       => 'iconWooCommerceCart',
			'active_callback' => 'attesa_is_topbar_and_woo_active',
			'priority' => 5,
		))
	);
	/* Show EDD Cart */
	$wp_customize->add_setting('attesa_theme_options[_show_eddcart]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_eddcart]', array(
        'label'      => __( 'Show EDD Cart', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_show_eddcart]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_topbar_and_edd_active',
		'priority' => 5,
    ) );
	/* FontAwesome EDD cart Icon */
	$wp_customize->add_setting('attesa_theme_options[_eddcart_icon]', array(
		'default'			=> 'fa fa-shopping-cart',
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Fontawesome_Icon(
		$wp_customize,
		'attesa_theme_options[_eddcart_icon]',
		array(
			'settings'		=> 'attesa_theme_options[_eddcart_icon]',
			'section'		=> 'section_attesa_theme_options_topbar',
			'label'			=> __( 'EDD Cart Icon', 'attesa' ),
			'type'       => 'iconWooCommerceCart',
			'active_callback' => 'attesa_is_topbar_and_edd_active',
			'priority' => 5,
		))
	);
	/* Show top bar navigation menu */
	$wp_customize->add_setting('attesa_theme_options[_show_topbar_menu]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_topbar_menu]', array(
        'label'      => __( 'Show top bar navigation menu (if set)', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_show_topbar_menu]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 6,
    ) );
	/* Phone number */
	$wp_customize->add_setting('attesa_theme_options[_phone_number]', array(
		'sanitize_callback' => 'attesa_sanitize_text',
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	) );
	$wp_customize->add_control('attesa_theme_options[_phone_number]', array(
		'label'      => __( 'Phone number', 'attesa' ),
		'description'	=> __( 'Leave the field blank if you do not want to use it', 'attesa' ),
		'section'    => 'section_attesa_theme_options_topbar',
		'settings'   => 'attesa_theme_options[_phone_number]',
		'type'       => 'text',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 7,
	) );
	$wp_customize->selective_refresh->add_partial('attesa_theme_options[_phone_number]', array(
	  'selector' => '.top-phone .attesa-number',
	  'settings' => 'attesa_theme_options[_phone_number]',
	  'render_callback' => 'attesa_selective_refresh_phone_number',
	) );
	/* Make phone clickable */
	$wp_customize->add_setting('attesa_theme_options[_phone_number_link]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_phone_number_link]', array(
        'label'      => __( 'Make phone number clickable', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_phone_number_link]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 8,
    ) );
	/* Email address */
	$wp_customize->add_setting('attesa_theme_options[_email_address]', array(
		'sanitize_callback' => 'sanitize_email',
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	) );
	$wp_customize->add_control('attesa_theme_options[_email_address]', array(
		'label'      => __( 'Email Address', 'attesa' ),
		'description'	=> __( 'Leave the field blank if you do not want to use it', 'attesa' ),
		'section'    => 'section_attesa_theme_options_topbar',
		'settings'   => 'attesa_theme_options[_email_address]',
		'type'       => 'text',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 9,
	) );
	$wp_customize->selective_refresh->add_partial('attesa_theme_options[_email_address]', array(
	  'selector' => '.top-email .attesa-email',
	  'settings' => 'attesa_theme_options[_email_address]',
	  'render_callback' => 'attesa_selective_refresh_email_address',
	) );
	/* Make email clickable */
	$wp_customize->add_setting('attesa_theme_options[_email_address_link]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_email_address_link]', array(
        'label'      => __( 'Make email address clickable', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_email_address_link]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 10,
    ) );
	/* Custom filed */
	$wp_customize->add_setting('attesa_theme_options[_custom_field]', array(
		'sanitize_callback' => 'attesa_sanitize_text',
		'default'    => '',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	) );
	$wp_customize->add_control('attesa_theme_options[_custom_field]', array(
		'label'      => __( 'Custom field', 'attesa' ),
		'description'	=> __( 'Leave the field blank if you do not want to use it. Shortcode accepted', 'attesa' ),
		'section'    => 'section_attesa_theme_options_topbar',
		'settings'   => 'attesa_theme_options[_custom_field]',
		'type'       => 'text',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 11,
	) );
	$wp_customize->selective_refresh->add_partial('attesa_theme_options[_custom_field]', array(
	  'selector' => '.top-custom .attesa-custom',
	  'settings' => 'attesa_theme_options[_custom_field]',
	  'render_callback' => 'attesa_selective_refresh_custom_field',
	) );
	/* FontAwesome Custom field Icon */
	$wp_customize->add_setting('attesa_theme_options[_customfield_icon]', array(
		'default'			=> 'fa fa-bell',
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Fontawesome_Icon(
		$wp_customize,
		'attesa_theme_options[_customfield_icon]',
		array(
			'settings'		=> 'attesa_theme_options[_customfield_icon]',
			'section'		=> 'section_attesa_theme_options_topbar',
			'label'			=> __( 'Custom Field Icon', 'attesa' ),
			'type'       => 'iconCustomField',
			'active_callback' => 'attesa_is_topbar_active',
			'priority' => 12,
		))
	);
	/* Show social network in the top bar */
	$wp_customize->add_setting('attesa_theme_options[_social_top]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_social_top]', array(
        'label'      => __( 'Show social network in the top bar', 'attesa' ),
        'section'    => 'section_attesa_theme_options_topbar',
        'settings'   => 'attesa_theme_options[_social_top]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_topbar_active',
		'priority' => 12,
    ) );
	/**
	* ################ SECTION HEADER SETTINGS
	*/
	/* Sticky header */
	$wp_customize->add_setting('attesa_theme_options[_sticky_header]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_sticky_header]', array(
        'label'      => __( 'Sticky header when scroll down', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_sticky_header]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Sticky header */
	$wp_customize->add_setting('attesa_theme_options[_sticky_header_mobile]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_sticky_header_mobile]', array(
        'label'      => __( 'Sticky header also on tablet/smartphone', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_sticky_header_mobile]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_sticky_active',
		'priority' => 1,
    ) );
	/* Header style */
	$wp_customize->add_setting('attesa_theme_options[_header_style]', array(
        'default'    => 'boxed',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_header_style]', array(
        'label'      => __( 'Header style', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_header_style]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_customheader_active',
		'priority' => 1,
		'choices' => array(
			'boxed' => __( 'Boxed', 'attesa'),
			'fullwidth' => __( 'Full width', 'attesa'),
		),
    ) );
	/* Header format */
	$wp_customize->add_setting('attesa_theme_options[_header_format]', array(
        'default'    => 'compat',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_header_format]', array(
        'label'      => __( 'Header format', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_header_format]',
        'type'       => 'select',
		'priority' => 1,
		'choices' => array(
			'compat' => __( 'Compat', 'attesa'),
			'featuredtitle' => __( 'Featured Title', 'attesa'),
			'menupopup' => __( 'Menu Popup', 'attesa'),
		),
    ) );
	/* Header scroll */
	$wp_customize->add_setting('attesa_theme_options[_header_scroll]', array(
        'default'    => 'smaller',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_header_scroll]', array(
        'label'      => __( 'Header scroll', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_header_scroll]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_sticky_active_and_not_custom',
		'priority' => 2,
		'choices' => array(
			'smaller' => __( 'Make it smaller when scroll down', 'attesa'),
			'normal' => __( 'Leave it normal when scroll down', 'attesa'),
		),
    ) );
	/* Remove title description */
	$wp_customize->add_setting('attesa_theme_options[_hide_description]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_hide_description]', array(
        'label'      => __( 'Remove title description (if set)', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_hide_description]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_customheader_active',
		'priority' => 2,
    ) );
	/* Show social network in the header */
	$wp_customize->add_setting('attesa_theme_options[_social_menu]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_social_menu]', array(
        'label'      => __( 'Show social network in the header', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_social_menu]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_customheader_active',
		'priority' => 2,
    ) );
	/* Heading menu style section */
	$wp_customize->add_setting('attesa_theme_options[_heading_menu_style]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_menu_style]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_menu_style]',
			'section'		=> 'section_attesa_theme_options_header',
			'label'			=> __( 'Main menu style', 'attesa' ),
			'priority' => 2,
		))
	);
	/* Menu font weight */
	$wp_customize->add_setting('attesa_theme_options[_menu_font_weight]', array(
        'default'    => 'bold',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_menu_font_weight]', array(
        'label'      => __( 'Menu font weight', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_menu_font_weight]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_customheader_active',
		'priority' => 3,
		'choices' => array(
			'bold' => __( 'Bold', 'attesa'),
			'normal' => __( 'Normal', 'attesa'),
		),
    ) );
	/* Menu text transform */
	$wp_customize->add_setting('attesa_theme_options[_menu_text_transform]', array(
        'default'    => 'none',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_menu_text_transform]', array(
        'label'      => __( 'Menu text transform', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_menu_text_transform]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_customheader_active',
		'priority' => 4,
		'choices' => array(
			'none' => __( 'None', 'attesa'),
			'uppercase' => __( 'Uppercase', 'attesa'),
		),
    ) );
	/* Menu links style */
	$wp_customize->add_setting('attesa_theme_options[_menu_links_style]', array(
        'default'    => 'minimal',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_menu_links_style]', array(
        'label'      => __( 'Menu links style', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_menu_links_style]',
        'type'       => 'select',
		'priority' => 5,
		'choices' => array(
			'minimal' => __( 'Minimal', 'attesa'),
			'minimaltop' => __( 'Minimal Top', 'attesa'),
			'bounce' => __( 'Bounce', 'attesa'),
			'default' => __( 'Default', 'attesa'),
		),
    ) );
	/* Menu position */
	$wp_customize->add_setting('attesa_theme_options[_menu_position]', array(
        'default'    => 'right',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_menu_position]', array(
        'label'      => __( 'Menu position', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_menu_position]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_header_format_title',
		'priority' => 6,
		'choices' => array(
			'right' => __( 'Right', 'attesa'),
			'left' => __( 'Left', 'attesa'),
		),
    ) );
	/* Menu logo max-height */
	$wp_customize->add_setting('attesa_theme_options[_menu_logo_max_height]', array(
        'default'    => '65',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint'
    ) );
	$wp_customize->add_control('attesa_theme_options[_menu_logo_max_height]', array(
        'label'      => __( 'Max height for the logo in pixel (if used)', 'attesa' ),
		'description'	=> __( 'Default value 65', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_menu_logo_max_height]',
        'type'       => 'number',
		'active_callback' => 'attesa_is_header_format_title_reverse',
		'priority' => 7,
    ) );
	/* Heading mobile menu style section */
	$wp_customize->add_setting('attesa_theme_options[_heading_mobile_menu_style]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_mobile_menu_style]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_mobile_menu_style]',
			'section'		=> 'section_attesa_theme_options_header',
			'label'			=> __( 'Mobile menu style', 'attesa' ),
			'active_callback' => 'attesa_is_menu_not_popup',
			'priority' => 8,
		))
	);
	/* Mobile menu text */
	$wp_customize->add_setting('attesa_theme_options[_menu_mobile_default_text]', array(
		'sanitize_callback' => 'attesa_sanitize_text',
		'default'    => __( 'Menu', 'attesa' ),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control('attesa_theme_options[_menu_mobile_default_text]', array(
		'label'      => __( 'Mobile menu text', 'attesa' ),
		'section'    => 'section_attesa_theme_options_header',
		'settings'   => 'attesa_theme_options[_menu_mobile_default_text]',
		'type'       => 'text',
		'active_callback' => 'attesa_is_menu_not_popup',
		'priority' => 8,
	) );
	/* FontAwesome Mobile Menu Icon */
	$wp_customize->add_setting('attesa_theme_options[_mobile_menu_icon]', array(
		'default'			=> 'fas fa fa-bars',
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Fontawesome_Icon(
		$wp_customize,
		'attesa_theme_options[_mobile_menu_icon]',
		array(
			'settings'		=> 'attesa_theme_options[_mobile_menu_icon]',
			'section'		=> 'section_attesa_theme_options_header',
			'label'			=> __( 'Mobile Menu Icon', 'attesa' ),
			'type'       => 'iconCustomField',
			'active_callback' => 'attesa_is_menu_not_popup',
			'priority' => 8,
		))
	);
	/* Opening mobile menu */
	$wp_customize->add_setting('attesa_theme_options[_menu_mobile_open]', array(
        'default'    => 'dropdown',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_menu_mobile_open]', array(
        'label'      => __( 'Open mobile menu', 'attesa' ),
        'section'    => 'section_attesa_theme_options_header',
        'settings'   => 'attesa_theme_options[_menu_mobile_open]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_menu_not_popup',
		'priority' => 9,
		'choices' => array(
			'dropdown' => __( 'Dropdown', 'attesa'),
			'pushmenu' => __( 'Push menu', 'attesa'),
		),
    ) );
	/* Close menu text */
	$wp_customize->add_setting('attesa_theme_options[_menu_mobile_text_close]', array(
		'sanitize_callback' => 'attesa_sanitize_text',
		'default'    => __( 'Close menu', 'attesa' ),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control('attesa_theme_options[_menu_mobile_text_close]', array(
		'label'      => __( 'Text to close the menu', 'attesa' ),
		'section'    => 'section_attesa_theme_options_header',
		'settings'   => 'attesa_theme_options[_menu_mobile_text_close]',
		'type'       => 'text',
		'active_callback' => 'attesa_is_menu_not_popup_and_dropdown',
		'priority' => 10,
	) );
	/**
	* ################ SECTION POSTS AND PAGES SETTINGS
	*/
	/* Heading main blog page section */
	$wp_customize->add_setting('attesa_theme_options[_heading_blog_page]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_blog_page]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_blog_page]',
			'section'		=> 'section_attesa_theme_options_postpage',
			'label'			=> __( 'Main blog page', 'attesa' ),
			'priority' => 1,
		))
	);
	/* Blog page show */
	$wp_customize->add_setting('attesa_theme_options[_show_posts]', array(
        'default'    => 'excerpt',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_posts]', array(
        'label'      => __( 'Blog page, show posts', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_show_posts]',
        'type'       => 'select',
		'priority' => 1,
		'choices' => array(
			'excerpt' => __( 'Show excerpt', 'attesa'),
			'grid' => __( 'Show grid', 'attesa'),
			'fullpost' => __( 'Show full post', 'attesa'),
		),
    ) );
	/* Number of columns */
	$wp_customize->add_setting('attesa_theme_options[_number_columns]', array(
        'default'    => 'threecolblog',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_number_columns]', array(
        'label'      => __( 'Number of columns', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_number_columns]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_grid_active',
		'priority' => 2,
		'choices' => array(
			'onecolblog' => __( '1', 'attesa'),
			'twocolblog' => __( '2', 'attesa'),
			'threecolblog' => __( '3', 'attesa'),
			'fourcolblog' => __( '4', 'attesa'),
		),
    ) );
	/* Text lenght for blog */
	$wp_customize->add_setting('attesa_theme_options[_lenght_blog]', array(
        'default'    => '55',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint',
    ) );
	$wp_customize->add_control('attesa_theme_options[_lenght_blog]', array(
        'label'      => __( 'Text lenght for blog excerpt (number of words)', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_lenght_blog]',
        'type'       => 'number',
		'active_callback' => 'attesa_is_excerpt_active',
		'priority' => 2,
    ) );
	/* Custom Excerpt More */
	$wp_customize->add_setting('attesa_theme_options[_excerpt_more]', array(
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    => '&hellip;'
    ) );
	$wp_customize->add_control('attesa_theme_options[_excerpt_more]', array(
        'label'      => __( 'Custom Excerpt Final', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_excerpt_more]',
        'type'       => 'text',
		'active_callback' => 'attesa_is_excerpt_active',
		'priority' => 3,
    ) );
	/* Show read more button */
	$wp_customize->add_setting('attesa_theme_options[_show_more_button]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_more_button]', array(
        'label'      => __( 'Show "read more" button', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_show_more_button]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_excerpt_active',
		'priority' => 4,
    ) );
	/* Custom read more button text */
	$wp_customize->add_setting('attesa_theme_options[_read_more_text]', array(
		'sanitize_callback' => 'attesa_sanitize_text',
		'default'    => __( 'Read More', 'attesa' ),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	) );
	$wp_customize->add_control('attesa_theme_options[_read_more_text]', array(
		'label'      => __( 'Text button for "read more"', 'attesa' ),
		'section'    => 'section_attesa_theme_options_postpage',
		'settings'   => 'attesa_theme_options[_read_more_text]',
		'type'       => 'text',
		'active_callback' => 'attesa_is_excerpt_and_button_active',
		'priority' => 5,
	) );
	$wp_customize->selective_refresh->add_partial('attesa_theme_options[_read_more_text]', array(
	  'selector' => 'footer.entry-footer .read-more span',
	  'settings' => 'attesa_theme_options[_read_more_text]',
	  'render_callback' => 'attesa_selective_refresh_read_more_text',
	) );
	/* Show featured images (if exist) in the main blog page */
	$wp_customize->add_setting('attesa_theme_options[_show_featimage_mainblog]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_featimage_mainblog]', array(
        'label'      => __( 'Show featured images (if exist) in the posts list', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_show_featimage_mainblog]',
        'type'       => 'checkbox',
		'priority' => 5,
    ) );
	/* Heading single blog pages section */
	$wp_customize->add_setting('attesa_theme_options[_heading_singleblog_page]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_singleblog_page]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_singleblog_page]',
			'section'		=> 'section_attesa_theme_options_postpage',
			'label'			=> __( 'Single blog posts', 'attesa' ),
			'priority' => 6,
		))
	);
	/* Featured image style */
	$wp_customize->add_setting('attesa_theme_options[_featimage_style_posts]', array(
        'default'    => 'content',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_featimage_style_posts]', array(
        'label'      => __( 'Featured image style (if set)', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_featimage_style_posts]',
        'type'       => 'select',
		'priority' => 7,
		'choices' => array(
			'content' => __( 'Featured image inside the content', 'attesa'),
			'header' => __( 'Big Featured image in the header', 'attesa'),
		),
    ) );
	/* Overlay featured image to the main menu */
	$wp_customize->add_setting('attesa_theme_options[_featimage_style_posts_overlay]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_featimage_style_posts_overlay]', array(
        'label'      => __( 'Overlay featured image to the main menu', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_featimage_style_posts_overlay]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_featimage_posts_big_active',
		'priority' => 8,
    ) );
	/* Featured image fixed */
	$wp_customize->add_setting('attesa_theme_options[_featimage_style_posts_fixed]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_featimage_style_posts_fixed]', array(
        'label'      => __( 'Featured image fixed inside the box', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_featimage_style_posts_fixed]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_featimage_posts_big_active',
		'priority' => 9,
    ) );
	/* Featured image height */
	$wp_customize->add_setting('attesa_theme_options[_featimage_style_posts_height]', array(
        'default'    => '500',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint'
    ) );
	$wp_customize->add_control('attesa_theme_options[_featimage_style_posts_height]', array(
        'label'      => __( 'Featured image height (in pixel)', 'attesa' ),
		'description'	=> __( 'Default value 500', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_featimage_style_posts_height]',
        'type'       => 'number',
		'active_callback' => 'attesa_is_featimage_posts_big_active',
		'input_attrs' => array(
			'min'           => 200,
			'max'           => 1080,
			'step'          => 10,
		),
		'priority' => 10,
    ) );
	/* Featured image opacity color */
	$wp_customize->add_setting( 'attesa_theme_options[_featimage_style_posts_opacity]', array(
		'default' => '#f5f5f5',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_featimage_style_posts_opacity]', 
		array(
			'label' => __( 'Opacity color', 'attesa' ),
			'section' => 'section_attesa_theme_options_postpage',
			'settings' =>'attesa_theme_options[_featimage_style_posts_opacity]',
			'active_callback' => 'attesa_is_featimage_posts_big_active',
			'priority' => 11,
		) )
	);
	/* Featured image title position */
	$wp_customize->add_setting('attesa_theme_options[_featimage_style_posts_title]', array(
        'default'    => 'insidecontent',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_featimage_style_posts_title]', array(
        'label'      => __( 'Title position', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_featimage_style_posts_title]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_featimage_posts_big_active',
		'priority' => 12,
		'choices' => array(
			'insidecontent' => __( 'Inside the content', 'attesa'),
			'insideheader' => __( 'Inside the header', 'attesa'),
		),
    ) );
	/* Show previous and next post */
	$wp_customize->add_setting('attesa_theme_options[_show_prevnext_section]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_prevnext_section]', array(
        'label'      => __( 'Show previous and next post', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_show_prevnext_section]',
        'type'       => 'checkbox',
		'priority' => 13,
    ) );
	/* Heading single pages section */
	$wp_customize->add_setting('attesa_theme_options[_heading_singlepage_page]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_singlepage_page]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_singlepage_page]',
			'section'		=> 'section_attesa_theme_options_postpage',
			'label'			=> __( 'Single pages', 'attesa' ),
			'priority' => 14,
		))
	);
	/* Featured image style */
	$wp_customize->add_setting('attesa_theme_options[_featimage_style_pages]', array(
        'default'    => 'content',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_featimage_style_pages]', array(
        'label'      => __( 'Featured image style (if set)', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_featimage_style_pages]',
        'type'       => 'select',
		'priority' => 15,
		'choices' => array(
			'content' => __( 'Featured image inside the content', 'attesa'),
			'header' => __( 'Big Featured image in the header', 'attesa'),
		),
    ) );
	/* Overlay featured image to the main menu */
	$wp_customize->add_setting('attesa_theme_options[_featimage_style_pages_overlay]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_featimage_style_pages_overlay]', array(
        'label'      => __( 'Overlay featured image to the main menu', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_featimage_style_pages_overlay]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_featimage_pages_big_active',
		'priority' => 16,
    ) );
	/* Featured image fixed */
	$wp_customize->add_setting('attesa_theme_options[_featimage_style_pages_fixed]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_featimage_style_pages_fixed]', array(
        'label'      => __( 'Featured image fixed inside the box', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_featimage_style_pages_fixed]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_featimage_pages_big_active',
		'priority' => 17,
    ) );
	/* Featured image height */
	$wp_customize->add_setting('attesa_theme_options[_featimage_style_pages_height]', array(
        'default'    => '500',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint'
    ) );
	$wp_customize->add_control('attesa_theme_options[_featimage_style_pages_height]', array(
        'label'      => __( 'Featured image height (in pixel)', 'attesa' ),
		'description'	=> __( 'Default value 500', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_featimage_style_pages_height]',
        'type'       => 'number',
		'active_callback' => 'attesa_is_featimage_pages_big_active',
		'input_attrs' => array(
			'min'           => 200,
			'max'           => 1080,
			'step'          => 10,
		),
		'priority' => 18,
    ) );
	/* Featured image opacity color */
	$wp_customize->add_setting( 'attesa_theme_options[_featimage_style_pages_opacity]', array(
		'default' => '#f5f5f5',
		'type' => 'option', 
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
		'attesa_theme_options[_featimage_style_pages_opacity]', 
		array(
			'label' => __( 'Opacity color', 'attesa' ),
			'section' => 'section_attesa_theme_options_postpage',
			'settings' =>'attesa_theme_options[_featimage_style_pages_opacity]',
			'active_callback' => 'attesa_is_featimage_pages_big_active',
			'priority' => 19,
		) )
	);
	/* Featured image title position */
	$wp_customize->add_setting('attesa_theme_options[_featimage_style_pages_title]', array(
        'default'    => 'insidecontent',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_featimage_style_pages_title]', array(
        'label'      => __( 'Title position', 'attesa' ),
        'section'    => 'section_attesa_theme_options_postpage',
        'settings'   => 'attesa_theme_options[_featimage_style_pages_title]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_featimage_pages_big_active',
		'priority' => 20,
		'choices' => array(
			'insidecontent' => __( 'Inside the content', 'attesa'),
			'insideheader' => __( 'Inside the header', 'attesa'),
		),
    ) );
	if (function_exists( 'is_woocommerce' )) {
		/**
		* ################ SECTION WOOCOMMERCE SETTINGS
		*/
		/* Heading single pages section */
		$wp_customize->add_setting('attesa_theme_options[_heading_woocommerce_settings]', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'       => 'option',
		));
		$wp_customize->add_control(
			new Attesa_Customize_Heading(
			$wp_customize,
			'attesa_theme_options[_heading_woocommerce_settings]',
			array(
				'settings'		=> 'attesa_theme_options[_heading_woocommerce_settings]',
				'section'		=> 'section_attesa_theme_options_woocommerce',
				'label'			=> __( 'WooCommerce Settings', 'attesa' ),
				'description'	=> __( 'Some of these options needs to refresh the page to view the changes.', 'attesa' ),
				'priority' => 1,
			))
		);
		/* WooCommerce gallery style */
		$wp_customize->add_setting('attesa_theme_options[_woocommerce_gallery_style]', array(
			'default'    => 'defaultgallery',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'attesa_sanitize_select',
			'transport' => 'postMessage'
		) );
		$wp_customize->add_control('attesa_theme_options[_woocommerce_gallery_style]', array(
			'label'      => __( 'Gallery style', 'attesa' ),
			'section'    => 'section_attesa_theme_options_woocommerce',
			'settings'   => 'attesa_theme_options[_woocommerce_gallery_style]',
			'type'       => 'select',
			'priority' => 1,
			'choices' => array(
				'defaultgallery' => __( 'Default gallery', 'attesa'),
				'zoomgallery' => __( 'Zoom gallery', 'attesa'),
			),
		) );
		/* WooCommerce lighbox */
		$wp_customize->add_setting('attesa_theme_options[_woocommerce_default_lightbox]', array(
			'default'    => '1',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'attesa_sanitize_checkbox',
			'transport' => 'postMessage'
		) );
		$wp_customize->add_control('attesa_theme_options[_woocommerce_default_lightbox]', array(
			'label'      => __( 'Use default WooCommerce lightbox', 'attesa' ),
			'section'    => 'section_attesa_theme_options_woocommerce',
			'settings'   => 'attesa_theme_options[_woocommerce_default_lightbox]',
			'type'       => 'checkbox',
			'priority' => 2,
		) );
		/* WooCommerce prev and next product */
		$wp_customize->add_setting('attesa_theme_options[_woocommerce_prevnext_product]', array(
			'default'    => '1',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'attesa_sanitize_checkbox',
			'transport' => 'postMessage'
		) );
		$wp_customize->add_control('attesa_theme_options[_woocommerce_prevnext_product]', array(
			'label'      => __( 'Show previous and next product (arrow icons)', 'attesa' ),
			'section'    => 'section_attesa_theme_options_woocommerce',
			'settings'   => 'attesa_theme_options[_woocommerce_prevnext_product]',
			'type'       => 'checkbox',
			'priority' => 3,
		) );
		/* WooCommerce related products */
		$wp_customize->add_setting('attesa_theme_options[_woocommerce_show_related]', array(
			'default'    => '1',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'attesa_sanitize_checkbox',
			'transport' => 'postMessage'
		) );
		$wp_customize->add_control('attesa_theme_options[_woocommerce_show_related]', array(
			'label'      => __( 'Show related products', 'attesa' ),
			'section'    => 'section_attesa_theme_options_woocommerce',
			'settings'   => 'attesa_theme_options[_woocommerce_show_related]',
			'type'       => 'checkbox',
			'priority' => 3,
		) );
		/* WooCommerce show sticky bar */
		$wp_customize->add_setting('attesa_theme_options[_woocommerce_stickybar]', array(
			'default'    => '1',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'attesa_sanitize_checkbox'
		) );
		$wp_customize->add_control('attesa_theme_options[_woocommerce_stickybar]', array(
			'label'      => __( 'Show sticky bar product when user scroll down', 'attesa' ),
			'section'    => 'section_attesa_theme_options_woocommerce',
			'settings'   => 'attesa_theme_options[_woocommerce_stickybar]',
			'type'       => 'checkbox',
			'priority' => 4,
		) );
		/* WooCommerce sticky bar text */
		$wp_customize->add_setting('attesa_theme_options[_woocommerce_stickybar_text]', array(
			'sanitize_callback' => 'attesa_sanitize_text',
			'default'    => __( 'View Product', 'attesa' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage'
		) );
		$wp_customize->add_control('attesa_theme_options[_woocommerce_stickybar_text]', array(
			'label'      => __( 'Sticky bar button text', 'attesa' ),
			'section'    => 'section_attesa_theme_options_woocommerce',
			'settings'   => 'attesa_theme_options[_woocommerce_stickybar_text]',
			'type'       => 'text',
			'active_callback' => 'attesa_is_woo_stickybar_active',
			'priority' => 5,
		) );
		$wp_customize->selective_refresh->add_partial('attesa_theme_options[_woocommerce_stickybar_text]', array(
		  'selector' => '.attesa-sticky-second .attesa-sticky-button',
		  'settings' => 'attesa_theme_options[_woocommerce_stickybar_text]',
		  'render_callback' => 'attesa_selective_refresh_stickybar_text',
		) );
		/* Sticky bar background color */
		$wp_customize->add_setting( 'attesa_theme_options[_woocommerce_stickybar_backcolor]', array(
			'default' => '#fbfbfb',
			'type' => 'option', 
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage'
		));
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'attesa_theme_options[_woocommerce_stickybar_backcolor]', 
			array(
				'label' => __( 'Sticky bar background color', 'attesa' ),
				'section' => 'section_attesa_theme_options_woocommerce',
				'settings' =>'attesa_theme_options[_woocommerce_stickybar_backcolor]',
				'active_callback' => 'attesa_is_woo_stickybar_active',
				'priority' => 6,
			) )
		);
		/* Sticky bar text color */
		$wp_customize->add_setting( 'attesa_theme_options[_woocommerce_stickybar_textcolor]', array(
			'default' => '#404040',
			'type' => 'option', 
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage'
		));
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'attesa_theme_options[_woocommerce_stickybar_textcolor]', 
			array(
				'label' => __( 'Sticky bar text color', 'attesa' ),
				'section' => 'section_attesa_theme_options_woocommerce',
				'settings' =>'attesa_theme_options[_woocommerce_stickybar_textcolor]',
				'active_callback' => 'attesa_is_woo_stickybar_active',
				'priority' => 7,
			) )
		);
	}
	/**
	* ################ SECTION CLASSIC SIDEBAR SETTINGS
	*/
	/* Where to show classic sidebar */
	$wp_customize->add_setting('attesa_theme_options[_classicsidebar_show]', array(
		'default'			=> 'entire_website,post',
		'sanitize_callback' => 'attesa_sanitize_show',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Choose_Show(
		$wp_customize,
		'attesa_theme_options[_classicsidebar_show]',
		array(
			'settings'		=> 'attesa_theme_options[_classicsidebar_show]',
			'section'		=> 'section_attesa_theme_options_classicsidebar',
			'label'			=> __( 'Show classic sidebar in', 'attesa' ),
			'type'       => 'toShowClassic',
			'choices' => attesa_show_list(),
			'priority' => 1,
		))
	);
	/* Classic sidebar position */
	$wp_customize->add_setting('attesa_theme_options[_classicsidebar_position]', array(
        'default'    => 'right',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_classicsidebar_position]', array(
        'label'      => __( 'Sidebar position', 'attesa' ),
        'section'    => 'section_attesa_theme_options_classicsidebar',
        'settings'   => 'attesa_theme_options[_classicsidebar_position]',
        'type'       => 'select',
		'priority' => 2,
		'choices' => array(
			'right' => __( 'Right', 'attesa'),
			'left' => __( 'Left', 'attesa'),
		),
    ) );
	/**
	* ################ SECTION PUSH SIDEBAR SETTINGS
	*/
	/* Where to show push sidebar */
	$wp_customize->add_setting('attesa_theme_options[_pushsidebar_show]', array(
		'default'			=> 'entire_website,post',
		'sanitize_callback' => 'attesa_sanitize_show',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Choose_Show(
		$wp_customize,
		'attesa_theme_options[_pushsidebar_show]',
		array(
			'settings'		=> 'attesa_theme_options[_pushsidebar_show]',
			'section'		=> 'section_attesa_theme_options_pushsidebar',
			'label'			=> __( 'Show push sidebar in', 'attesa' ),
			'type'       => 'toShowPush',
			'choices' => attesa_show_list(),
			'priority' => 1,
		))
	);
	/* Push sidebar position */
	$wp_customize->add_setting('attesa_theme_options[_pushsidebar_position]', array(
        'default'    => 'right',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_pushsidebar_position]', array(
        'label'      => __( 'Sidebar position', 'attesa' ),
        'section'    => 'section_attesa_theme_options_pushsidebar',
        'settings'   => 'attesa_theme_options[_pushsidebar_position]',
        'type'       => 'select',
		'priority' => 2,
		'choices' => array(
			'right' => __( 'Right', 'attesa'),
			'left' => __( 'Left', 'attesa'),
		),
    ) );
	/* Show opacity push sidebar */
	$wp_customize->add_setting('attesa_theme_options[_show_opacitypush]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_opacitypush]', array(
        'label'      => __( 'Show opacity when push sidebar is open', 'attesa' ),
        'section'    => 'section_attesa_theme_options_pushsidebar',
        'settings'   => 'attesa_theme_options[_show_opacitypush]',
        'type'       => 'checkbox',
		'priority' => 2,
    ) );
	/* Push sidebar icon */
	$wp_customize->add_setting('attesa_theme_options[_pushsidebar_icon]', array(
        'default'    => 'three_lines_icon',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_pushsidebar_icon]', array(
        'label'      => __( 'Choose the icon', 'attesa' ),
        'section'    => 'section_attesa_theme_options_pushsidebar',
        'settings'   => 'attesa_theme_options[_pushsidebar_icon]',
        'type'       => 'select',
		'priority' => 3,
		'choices' => array(
			'three_lines_icon' => __( 'Three Lines Icon', 'attesa'),
			'plus_icon' => __( 'Plus Icon', 'attesa'),
			'circle_icon' => __( 'Circle Icon', 'attesa'),
		),
    ) );
	/**
	* ################ SECTION SCROLL TO TOP SETTINGS
	*/
	/* Show the Scroll to Top button */
	$wp_customize->add_setting('attesa_theme_options[_show_scrolltotop]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_scrolltotop]', array(
        'label'      => __( 'Show the Scroll to Top button', 'attesa' ),
        'section'    => 'section_attesa_theme_options_scrolltotop',
        'settings'   => 'attesa_theme_options[_show_scrolltotop]',
        'type'       => 'checkbox',
		'priority' => 1,
    ) );
	/* Show the Scroll to Top button also on mobile */
	$wp_customize->add_setting('attesa_theme_options[_show_scrolltotop_mobile]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_scrolltotop_mobile]', array(
        'label'      => __( 'Show the Scroll to Top button also on mobile', 'attesa' ),
        'section'    => 'section_attesa_theme_options_scrolltotop',
        'settings'   => 'attesa_theme_options[_show_scrolltotop_mobile]',
        'type'       => 'checkbox',
		'active_callback' => 'attesa_is_scrolltotop_active',
		'priority' => 2,
    ) );
	/* Scroll to top position */
	$wp_customize->add_setting('attesa_theme_options[_scrolltotop_position]', array(
        'default'    => 'right',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_scrolltotop_position]', array(
        'label'      => __( 'Scroll to top button position', 'attesa' ),
        'section'    => 'section_attesa_theme_options_scrolltotop',
        'settings'   => 'attesa_theme_options[_scrolltotop_position]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_scrolltotop_active',
		'priority' => 3,
		'choices' => array(
			'right' => __( 'Bottom right', 'attesa'),
			'left' => __( 'Bottom Left', 'attesa'),
		),
    ) );
	/* FontAwesome Scroll to top Icon */
	$wp_customize->add_setting('attesa_theme_options[_scrolltotop_icon]', array(
		'default'			=> 'fa fa-angle-up',
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Fontawesome_Icon(
		$wp_customize,
		'attesa_theme_options[_scrolltotop_icon]',
		array(
			'settings'		=> 'attesa_theme_options[_scrolltotop_icon]',
			'section'		=> 'section_attesa_theme_options_scrolltotop',
			'label'			=> __( 'Scroll to top icon', 'attesa' ),
			'type'       => 'iconScrollTop',
			'active_callback' => 'attesa_is_scrolltotop_active',
			'priority' => 4,
		))
	);
	/**
	* ################ SECTION FOOTER SETTINGS
	*/	
	/* Heading footer section */
	$wp_customize->add_setting('attesa_theme_options[_heading_footer]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_footer]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_footer]',
			'section'		=> 'section_attesa_theme_options_footer',
			'label'			=> __( 'Footer widgets settings', 'attesa' ),
			'priority' => 1,
		))
	);
	/* Where to show footer widgets */
	$wp_customize->add_setting('attesa_theme_options[_footerwidgets_show]', array(
		'default'			=> 'entire_website,post',
		'sanitize_callback' => 'attesa_sanitize_show',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Choose_Show(
		$wp_customize,
		'attesa_theme_options[_footerwidgets_show]',
		array(
			'settings'		=> 'attesa_theme_options[_footerwidgets_show]',
			'section'		=> 'section_attesa_theme_options_footer',
			'label'			=> __( 'Show footer widgets in', 'attesa' ),
			'type'       => 'toShowFooter',
			'choices' => attesa_show_list(),
			'priority' => 1,
		))
	);
	/* Number of footer columns */
	$wp_customize->add_setting('attesa_theme_options[_footer_numbers]', array(
        'default'    => 'threecol',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select'
    ) );
	$wp_customize->add_control('attesa_theme_options[_footer_numbers]', array(
        'label'      => __( 'Number of footer columns', 'attesa' ),
        'section'    => 'section_attesa_theme_options_footer',
        'settings'   => 'attesa_theme_options[_footer_numbers]',
        'type'       => 'select',
		'active_callback' => 'attesa_is_customfooter_active',
		'priority' => 2,
		'choices' => array(
			'onecol' => __( '1', 'attesa'),
			'twocol' => __( '2', 'attesa'),
			'threecol' => __( '3', 'attesa'),
			'fourcol' => __( '4', 'attesa'),
		),
    ) );
	/* Heading sub footer section */
	$wp_customize->add_setting('attesa_theme_options[_heading_subfooter]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'       => 'option',
	));
	$wp_customize->add_control(
		new Attesa_Customize_Heading(
		$wp_customize,
		'attesa_theme_options[_heading_subfooter]',
		array(
			'settings'		=> 'attesa_theme_options[_heading_subfooter]',
			'section'		=> 'section_attesa_theme_options_footer',
			'label'			=> __( 'Sub-footer settings', 'attesa' ),
			'priority' => 3,
		))
	);
	/* Show sub-footer */
	$wp_customize->add_setting('attesa_theme_options[_show_subfooter]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_subfooter]', array(
        'label'      => __( 'Show sub-footer', 'attesa' ),
        'section'    => 'section_attesa_theme_options_footer',
        'settings'   => 'attesa_theme_options[_show_subfooter]',
        'type'       => 'checkbox',
		'priority' => 4,
    ) );
	/* Show footer navigation menu */
	$wp_customize->add_setting('attesa_theme_options[_show_footer_menu]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_show_footer_menu]', array(
        'label'      => __( 'Show footer navigation menu (if set)', 'attesa' ),
        'section'    => 'section_attesa_theme_options_footer',
        'settings'   => 'attesa_theme_options[_show_footer_menu]',
		'active_callback' => 'attesa_is_subfooter_active',
        'type'       => 'checkbox',
		'priority' => 4,
    ) );
	/* Show Social Network footer */
	$wp_customize->add_setting('attesa_theme_options[_social_footer]', array(
        'default'    => '1',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_checkbox'
    ) );
	$wp_customize->add_control('attesa_theme_options[_social_footer]', array(
        'label'      => __( 'Show social network in footer', 'attesa' ),
        'section'    => 'section_attesa_theme_options_footer',
        'settings'   => 'attesa_theme_options[_social_footer]',
		'active_callback' => 'attesa_is_subfooter_active',
        'type'       => 'checkbox',
		'priority' => 5,
    ) );
	/* Copyright Text */
	$wp_customize->add_setting('attesa_theme_options[_copyright_text]', array(
		'sanitize_callback' => 'attesa_sanitize_text',
		'default'    => '&copy; '.date('Y').' '. get_bloginfo('name'),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	) );
	$wp_customize->add_control('attesa_theme_options[_copyright_text]', array(
		'label'      => __( 'Copyright Text', 'attesa' ),
		'description' => __( 'Get the PRO version to remove AttesaWP credits', 'attesa' ),
		'section'    => 'section_attesa_theme_options_footer',
		'settings'   => 'attesa_theme_options[_copyright_text]',
		'active_callback' => 'attesa_is_subfooter_active',
		'type'       => 'text',
		'priority' => 6,
	) );
	$wp_customize->selective_refresh->add_partial('attesa_theme_options[_copyright_text]', array(
	  'selector' => '.site-copy-down .site-info span.custom',
	  'settings' => 'attesa_theme_options[_copyright_text]',
	  'render_callback' => 'attesa_selective_refresh_copyright_text',
	) );
	/**
	* ################ SECTION SOCIAL BUTTONS
	*/	
	foreach( attesa_register_all_social_network() as $attesa_theme_options ) {
		// SETTINGS
		$wp_customize->add_setting(
			'attesa_theme_options[' . $attesa_theme_options['slug']. ']', array(
				'default' => $attesa_theme_options['default'],
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
				'type'     => 'option',
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			'attesa_theme_options[' . $attesa_theme_options['slug']. ']', 
			array('label' => $attesa_theme_options['label'], 
			'section'    => 'section_attesa_theme_options_social',
			'settings' =>'attesa_theme_options[' . $attesa_theme_options['slug']. ']',
			)
		);
	}
	/* Open social links */
	$wp_customize->add_setting('attesa_theme_options[_social_open_links]', array(
        'default'    => '_self',
        'type'       => 'option',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'attesa_sanitize_select',
    ) );
	$wp_customize->add_control('attesa_theme_options[_social_open_links]', array(
        'label'      => __( 'Open social links', 'attesa' ),
        'section'    => 'section_attesa_theme_options_social',
        'settings'   => 'attesa_theme_options[_social_open_links]',
        'type'       => 'select',
		'priority' => 4,
		'choices' => array(
			'_self' => __( 'Same window', 'attesa'),
			'_blank' => __( 'New Window', 'attesa'),
		),
    ) );
}
add_action( 'customize_register', 'attesa_customize_register' );

/**
 * Delete font size style from tag cloud widget
 */
if( ! function_exists('attesa_fix_tag_cloud')){
	function attesa_fix_tag_cloud($tag_string){
	   return preg_replace('/ style=("|\')(.*?)("|\')/','',$tag_string);
	}
}
add_filter('wp_generate_tag_cloud', 'attesa_fix_tag_cloud',10,1);


function attesa_customize_partial_blogname() {
	bloginfo( 'name' );
}

function attesa_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function attesa_selective_refresh_phone_number() {
	return esc_html(attesa_options('_phone_number'));
}

function attesa_selective_refresh_email_address() {
	return esc_html(attesa_options('_email_address'));
}

function attesa_selective_refresh_custom_field() {
	return wp_kses(attesa_options('_custom_field'), attesa_allowed_html());
}

function attesa_selective_refresh_read_more_text() {
	return esc_html(attesa_options('_read_more_text'));
}

function attesa_selective_refresh_copyright_text() {
	return wp_kses(attesa_options('_copyright_text'), attesa_allowed_html());
}

function attesa_selective_refresh_stickybar_text() {
	return esc_html(attesa_options('_woocommerce_stickybar_text'));
}

function attesa_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

function attesa_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function attesa_sanitize_fonts( $input, $setting ) {
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function attesa_sanitize_show( $input ) {
	$multi_values = ! is_array( $input ) ? explode( ',', $input ) : $input;
    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

function attesa_show_list() {
	$args = array( 'public' => true );
	$allPostTypes = get_post_types( $args, 'objects', 'and' );
	$allTaxonimies = get_taxonomies( $args, 'objects', 'and' );
	$merge = array_merge($allPostTypes, $allTaxonimies);
	foreach ( $merge as $taxsandposts => $taxandpost ) {
		$all[$taxandpost->name] = $taxandpost->label;
	}
	return $all;
}

function attesa_sanitize_text( $input ) {
	return wp_kses($input, attesa_allowed_html());
}

function attesa_is_loader_active() {
	$showLoader = attesa_options('_show_loader', '');
	if ($showLoader == 1) {
		return true;
	}
	return false;
}

function attesa_is_socialfloat_active() {
	$socialFloat = attesa_options('_social_float', '');
	if ($socialFloat == 1) {
		return true;
	}
	return false;
}

function attesa_is_topbar_active() {
	$showTopbar = attesa_options('_show_topbar', '');
	if ($showTopbar == 1) {
		return true;
	}
	return false;
}

function attesa_is_website_boxed() {
	$websiteStucture = attesa_options('_website_structure', 'wide');
	if ($websiteStucture == 'boxed') {
		return true;
	}
	return false;
}

function attesa_is_excerpt_active() {
	$showExcerpt = attesa_options('_show_posts', 'excerpt');
	if ($showExcerpt != 'fullpost') {
		return true;
	}
	return false;
}

function attesa_is_grid_active() {
	$showGrid = attesa_options('_show_posts', 'excerpt');
	if ($showGrid == 'grid' || $showGrid == 'masonry') {
		return true;
	}
	return false;
}

function attesa_is_sticky_active() {
	$stickyHeader = attesa_options('_sticky_header', '1');
	if ($stickyHeader == '1') {
		return true;
	}
	return false;
}

function attesa_is_sticky_active_and_not_custom() {
	$stickyHeader = attesa_options('_sticky_header', '1');
	$headerFormat = attesa_options('_header_format','compat');
	if ($stickyHeader == '1' && $headerFormat != 'custom') {
		return true;
	}
	return false;
}

function attesa_is_excerpt_and_button_active() {
	$showExcerpt = attesa_options('_show_posts', 'excerpt');
	$showMoreButton = attesa_options('_show_more_button', '1');
	if ($showExcerpt != 'fullpost' && $showMoreButton == 1) {
		return true;
	}
	return false;
}

function attesa_is_topbar_and_woo_active() {
	$showTopbar = attesa_options('_show_topbar', '');
	if ( function_exists( 'is_woocommerce' ) && $showTopbar == 1 ) {
		return true;
	}
	return false;
}

function attesa_is_topbar_and_edd_active() {
	$showTopbar = attesa_options('_show_topbar', '');
	if ( function_exists( 'EDD' ) && $showTopbar == 1 ) {
		return true;
	}
	return false;
}

function attesa_is_featimage_posts_big_active() {
	$featImagePosts = attesa_options('_featimage_style_posts', 'content');
	if ($featImagePosts == 'header') {
		return true;
	}
	return false;
}

function attesa_is_featimage_pages_big_active() {
	$featImagePages = attesa_options('_featimage_style_pages', 'content');
	if ($featImagePages == 'header') {
		return true;
	}
	return false;
}

function attesa_is_scrolltotop_active() {
	$showScrolltotop = attesa_options('_show_scrolltotop', '1');
	if ($showScrolltotop == '1') {
		return true;
	}
	return false;
}

function attesa_is_woo_stickybar_active() {
	$showStickyBar = attesa_options('_woocommerce_stickybar','1');
	if ($showStickyBar == '1') {
		return true;
	}
	return false;
}

function attesa_is_googlefont_active() {
	$disableGoogleFont = attesa_options('_disable_google_fonts','');
	if ($disableGoogleFont == '1') {
		return false;
	}
	return true;
}
function attesa_is_googlefont_disable() {
	$disableGoogleFont = attesa_options('_disable_google_fonts','');
	if ($disableGoogleFont == '1') {
		return true;
	}
	return false;
}

function attesa_is_header_format_title() {
	$headerFormat = attesa_options('_header_format','compat');
	if ($headerFormat == 'featuredtitle' || $headerFormat == 'custom') {
		return false;
	}
	return true;
}
function attesa_is_header_format_title_reverse() {
	$headerFormat = attesa_options('_header_format','compat');
	if ($headerFormat == 'featuredtitle') {
		return true;
	}
	return false;
}

function attesa_is_menu_not_popup() {
	$headerFormat = attesa_options('_header_format','compat');
	if ($headerFormat == 'menupopup' || $headerFormat == 'custom' ) {
		return false;
	}
	return true;
}

function attesa_is_menu_not_popup_and_dropdown() {
	$headerFormat = attesa_options('_header_format','compat');
	$menuMobileOpen = attesa_options('_menu_mobile_open', 'dropdown');
	if ($headerFormat == 'menupopup' || $headerFormat == 'custom') {
		return false;
	}
	if ($menuMobileOpen == 'dropdown') {
		return false;
	}
	return true;
}

function attesa_is_subfooter_active() {
	$showSubfooter = attesa_options('_show_subfooter','1');
	if ($showSubfooter == '1') {
		return true;
	}
	return false;
}

function attesa_is_customfooter_active() {
	return apply_filters('attesa_is_customfooter_active_filter', true);
}

function attesa_is_customheader_active() {
	return apply_filters('attesa_is_customheader_active_filter', true);
}