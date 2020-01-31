<?php
// child style enqueue
add_action( 'wp_enqueue_scripts', 'agency_zita_styles' );
function agency_zita_styles() {
    $themeVersion = wp_get_theme()->get('Version');
    // Enqueue our style.css with our own version
    wp_enqueue_style('agency-zita-styles', get_template_directory_uri() . '/style.css',array(), $themeVersion);
}
//customizer
function agency_zita_blog( $wp_customize ){
define('AGENCY_ZITA_LAYOUT', get_stylesheet_directory_uri() . "/images/agency-zita-blog-layout.png");
$wp_customize->add_setting(
            'zita_blog_layout', array(
                'default'           => 'zta-blog-layout-1',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
$wp_customize->add_control(
            new Zita_WP_Customize_Control_Radio_Image(
                $wp_customize, 'zita_blog_layout', array(
                    'label'    => esc_html__( 'Blog Layout', 'agency-zita' ),
                    'section'  => 'zita-blog-archive',
                    'choices'  => array(   
                        'zta-blog-layout-1' => array(
                            'url' => ZITA_BLOG_ARCHIVE_LAYOUT_1,
                        ),
                        'agc-zta-blog-layout' => array(
                            'url' => AGENCY_ZITA_LAYOUT,
                        ),
                        
                    ),
                    'priority'   =>1,
                )
            )
);
}
add_action( 'customize_register', 'agency_zita_blog', 100 );