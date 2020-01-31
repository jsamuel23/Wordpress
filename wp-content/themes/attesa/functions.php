<?php
/**
 * Attesa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Attesa
 */

if ( ! function_exists( 'attesa_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function attesa_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Attesa, use a find and replace
		 * to change 'attesa' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'attesa', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		/* Support for Gutenberg */
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'css/gutenberg-editor-style.css' );
		add_theme_support( 'editor-font-sizes', array(
			array(
				'name'      => __( 'Small', 'attesa' ),
				'shortName' => __( 'S', 'attesa' ),
				'size'      => 14,
				'slug'      => 'small'
			),
			array(
				'name'      => __( 'Regular', 'attesa' ),
				'shortName' => __( 'M', 'attesa' ),
				'size'      => 16,
				'slug'      => 'regular'
			),
			array(
				'name'      => __( 'Large', 'attesa' ),
				'shortName' => __( 'L', 'attesa' ),
				'size'      => 20,
				'slug'      => 'large'
			),
			array(
				'name'      => __( 'Larger', 'attesa' ),
				'shortName' => __( 'XL', 'attesa' ),
				'size'      => 24,
				'slug'      => 'larger'
			)
		) );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'attesa-the-post-big' , 1920, 99999);
		add_image_size( 'attesa-the-post' , 850, 99999);
		add_image_size( 'attesa-small' , 500, 270, true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main' => esc_html__( 'Primary menu', 'attesa' ),
			'top' => esc_html__( 'Top menu', 'attesa' ),
			'footer' => esc_html__( 'Footer menu', 'attesa' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		// Add support for WooCommerce
		add_theme_support( 'woocommerce' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 60,
			'width'       => 220,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );
		
		/**
		 * Call all theme options
		 */
		if( ! function_exists('attesa_options')){
			function attesa_options($name, $default = false) {
				$options = ( get_option( 'attesa_theme_options' ) ) ? get_option( 'attesa_theme_options' ) : null;
				if ( isset( $options[ $name ] ) ) {
					return apply_filters( "attesa_theme_options_{$name}", $options[ $name ] );
				}
				return apply_filters( "attesa_theme_options_{$name}", $default );
			}
		}
	}
endif;
add_action( 'after_setup_theme', 'attesa_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function attesa_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'attesa_content_width', 830 );
}
add_action( 'after_setup_theme', 'attesa_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function attesa_widgets_init() {
	$attesa_widgets_heading = apply_filters( 'attesa_widgets_heading', attesa_options('_widgets_heading', 'h3') );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Classic Sidebar', 'attesa' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'attesa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><'.$attesa_widgets_heading.' class="widgets-heading">',
		'after_title'   => '</'.$attesa_widgets_heading.'></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Push Sidebar', 'attesa' ),
		'id'            => 'sidebar-push',
		'description'   => esc_html__( 'Add widgets here.', 'attesa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><'.$attesa_widgets_heading.' class="widgets-heading">',
		'after_title'   => '</'.$attesa_widgets_heading.'></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'attesa' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'attesa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><'.$attesa_widgets_heading.' class="widgets-heading">',
		'after_title'   => '</'.$attesa_widgets_heading.'></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'attesa' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'attesa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><'.$attesa_widgets_heading.' class="widgets-heading">',
		'after_title'   => '</'.$attesa_widgets_heading.'></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'attesa' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'attesa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><'.$attesa_widgets_heading.' class="widgets-heading">',
		'after_title'   => '</'.$attesa_widgets_heading.'></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'attesa' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'attesa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><'.$attesa_widgets_heading.' class="widgets-heading">',
		'after_title'   => '</'.$attesa_widgets_heading.'></div>',
	) );
}
add_action( 'widgets_init', 'attesa_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function attesa_scripts() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_enqueue_style( 'attesa-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );
	if (attesa_options('_choose_icon_pack', 'font_awesome_five') == 'font_awesome_four') {
		wp_enqueue_style( 'font-awesome-4', get_template_directory_uri() .'/css/font-awesome'.$min.'.css', array(), '4.7.0');
	} elseif (attesa_options('_choose_icon_pack', 'font_awesome_five') == 'font_awesome_five') {
		wp_enqueue_style( 'font-awesome-5-all', get_template_directory_uri() .'/css/all'.$min.'.css', array(), '5.11.1');
	} elseif (attesa_options('_choose_icon_pack', 'font_awesome_five') == 'font_awesome_five_comp') {
		wp_enqueue_style( 'font-awesome-5-all', get_template_directory_uri() .'/css/all'.$min.'.css', array(), '5.11.1');
		wp_enqueue_style( 'font-awesome-4-shim', get_template_directory_uri() .'/css/v4-shims'.$min.'.css', array(), '5.11.1');
	}
	
	$disableGoogleFonts = attesa_options('_disable_google_fonts', '');
	if (empty($disableGoogleFonts)) {
		$googleFontHeading = attesa_options('_googlefont_heading', 'Quicksand : sans-serif');
		$googleFontText = attesa_options('_googlefont_text', 'Quicksand : sans-serif');
		$piecesHead = explode(" : ", $googleFontHeading);
		$piecesText = explode(" : ", $googleFontText);
		$fontNameHead = str_replace(" ", "+", $piecesHead[0]);
		$fontNameText = str_replace(" ", "+", $piecesText[0]);
		if (is_rtl()) {
			$query_args = array(
				'family' => $fontNameText.':400,700%7C'. $fontNameHead .':400,700',
				'subset' => 'arabic'
			);
		} else {
			$query_args = array(
				'family' => $fontNameText.':400,700%7C'. $fontNameHead .':400,700'
			);
		}
		wp_enqueue_style( 'attesa-googlefonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
	}
	wp_enqueue_script( 'attesa-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix'.$min.'.js', array(), '20151215', true );
	wp_enqueue_script( 'attesa-custom', get_template_directory_uri() . '/js/jquery.attesa'.$min.'.js', array('jquery'), wp_get_theme()->get('Version'), true );
	if ( attesa_options('_smooth_scroll', '1') == 1) {
		wp_enqueue_script( 'attesa-smooth-scroll', get_template_directory_uri() . '/js/SmoothScroll'.$min.'.js', array('jquery'), '1.4.9', true );
	}
	if ( is_active_sidebar( attesa_get_push_sidebar() ) && attesa_check_bar('push') ) {
		wp_enqueue_script( 'attesa-nanoScroll', get_template_directory_uri() . '/js/jquery.nanoscroller'.$min.'.js', array('jquery'), '0.8.7', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'attesa_scripts' );

/**
 * Register all Elementor locations
 */
function attesa_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'attesa_register_elementor_locations' );

/**
 * Template for the header
 */
require get_template_directory() . '/inc/partials/com-header.php';

/**
 * Template for the footer
 */
require get_template_directory() . '/inc/partials/com-footer.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer custom class.
 */
require get_template_directory() . '/inc/customizer-class.php';

/**
 * Print custom CSS.
 */
require get_template_directory() . '/inc/custom-css.php';

/**
 * WooCommerce support.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/third/woocommerce.php';
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load PRO Button in the customizer
 */
require get_template_directory() . '/inc/pro-button/class-customize.php';

/* Calling the welcome notice only if user is admin and Attesa Extra plugin is not installed */
if ( is_admin() && !class_exists( 'Attesa_extra' ) ) {
	require get_template_directory() . '/inc/attesa-notice.php';
}
/**
 * TGM Plugin Activation
 */
require_once dirname( __FILE__ ) . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'attesa_recommended_plugins' );
function attesa_recommended_plugins() {
    $plugins = array(
		array(
            'name'               => 'Elementor',
            'slug'               => 'elementor',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(
            'name'               => 'Attesa Extra',
            'slug'               => 'attesa-extra',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
	);
	$config = array(
		'id'           => 'attesaplug',              // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'attesaplug-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',  
    );
    tgmpa( $plugins, $config );
}