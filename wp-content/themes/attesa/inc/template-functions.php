<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Attesa
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function attesa_body_classes( $classes ) {
	// Add a class if single posts has big featured image
	if (is_singular( 'post' ) && '' != get_the_post_thumbnail()) {
		$featImagePosts = apply_filters( 'attesa_post_featured_image_style', attesa_options('_featimage_style_posts', 'content') );
		if ($featImagePosts == 'header') {
			$classes[] = 'headerFeatImage';
			if (apply_filters( 'attesa_overlay_featured_image_style', attesa_options('_featimage_style_posts_overlay', '') )) {
				$classes[] = 'withOverlayMenu';
			}
		}
	}
	
	// Add a class if single pages has big featured image
	if (is_page() && '' != get_the_post_thumbnail()) {
		$featImagePage = apply_filters( 'attesa_page_featured_image_style', attesa_options('_featimage_style_pages', 'content') );
		if ($featImagePage == 'header') {
			$classes[] = 'headerFeatImage';
			if (apply_filters( 'attesa_overlay_featured_image_style_page', attesa_options('_featimage_style_pages_overlay', '') )) {
				$classes[] = 'withOverlayMenu';
			}
		}
	}
	
	// Add a class if main blog page has big featured image
	if (is_home() && !is_front_page() && '' != get_the_post_thumbnail(get_option('page_for_posts')) ) {
		$classes[] = 'headerFeatImage';
	}
	
	// Check the style to open the main menu on mobile
	if (attesa_options('_header_format','compat') != 'menupopup') {
		if (attesa_options('_header_format','compat') == 'custom') {
			$classes[] = 'mobile_menu_pushmenu';
		} else {
			if (attesa_options('_menu_mobile_open', 'dropdown') == 'pushmenu') {
				$classes[] = 'mobile_menu_pushmenu';
			} else {
				$classes[] = 'mobile_menu_dropdown';
			}
		}
	}
	
	// Add a class for the choosen icon pack
	if (attesa_options('_choose_icon_pack', 'font_awesome_four') == 'font_awesome_four') {
		$classes[] = 'with_fa4';
	} elseif (attesa_options('_choose_icon_pack', 'font_awesome_four') == 'font_awesome_five_comp') {
		$classes[] = 'with_fa5_comp';
	} else {
		$classes[] = 'with_fa5';
	}
	
	// Add a class if shop page has big featured image
	if (function_exists( 'is_woocommerce' ) && is_shop() && '' != get_the_post_thumbnail(get_option('woocommerce_shop_page_id') )) {
		$classes[] = 'headerFeatImage';
	}
	
	// Add a class for the header format
	$classes[] = 'format_'.attesa_options('_header_format', 'compat');
	
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( attesa_get_classic_sidebar() ) || ! attesa_check_bar('classic') ) {
		$classes[] = 'no-sidebar';
	}
	
	// Adds a class for blog page style
	if (is_home() || is_archive() || is_search()) {
		if (attesa_options('_show_posts', 'excerpt') == 'grid') {
			$number_columns = attesa_options('_number_columns', 'threecolblog');
			$classes[] = 'attesa-blog-grid';
			$classes[] = $number_columns;
		} elseif (attesa_options('_show_posts', 'excerpt') == 'masonry') {
			$classes[] = 'attesa-blog-masonry';
			$number_columns = attesa_options('_number_columns', 'threecolblog');
			$classes[] = $number_columns;
		} else {
			$classes[] = 'attesa-blog-nogrid';
		}
	}
	return $classes;
}
add_filter( 'body_class', 'attesa_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function attesa_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'attesa_pingback_header' );

/**
 * Custom allowed html
 */
if( ! function_exists('attesa_allowed_html')){
	function attesa_allowed_html() {
		$allowed_tags = array(
			'a' => array(
				'class' => array(),
				'id'    => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
				'target' => array(),
			),
			'abbr' => array(
				'title' => array(),
			),
			'b' => array(),
			'blockquote' => array(
				'cite'  => array(),
			),
			'cite' => array(
				'title' => array(),
			),
			'code' => array(),
			'del' => array(
				'datetime' => array(),
				'title' => array(),
			),
			'dd' => array(),
			'div' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'dl' => array(),
			'dt' => array(),
			'em' => array(),
			'h1' => array(),
			'h2' => array(),
			'h3' => array(),
			'h4' => array(),
			'h5' => array(),
			'h6' => array(),
			'i' => array(),
			'br' => array(),
			'img' => array(
				'alt'    => array(),
				'class'  => array(),
				'height' => array(),
				'src'    => array(),
				'width'  => array(),
				'style' => array(),
			),
			'li' => array(
				'class' => array(),
			),
			'ol' => array(
				'class' => array(),
			),
			'p' => array(
				'class' => array(),
			),
			'q' => array(
				'cite' => array(),
				'title' => array(),
			),
			'span' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'strike' => array(),
			'strong' => array(),
			'ul' => array(
				'class' => array(),
			),
			'iframe' => array(
				'width' => array(),
				'height' => array(),
				'src' => array(),
				'frameborder' => array(),
				'allow' => array(),
				'style' => array(),
				'name' => array(),
				'id' => array(),
				'class' => array(),
			),
		);
		return apply_filters('attesa_register_allowed_tags', $allowed_tags);
	}
}

/* Register all social network button */
if( ! function_exists('attesa_register_all_social_network')){
	function attesa_register_all_social_network() {
		$iconPrefix = esc_attr(attesa_get_fontawesome_icons('social_prefix'));
		$social = array(
			'facebook' => array (
				'slug' => '_facebookurl',
				'default' => '',
				'label' => __('Facebook URL', 'attesa'),
				'name' => __('Facebook', 'attesa'),
				'icon' => $iconPrefix .' fa-facebook',
			),
			'twitter' => array (
				'slug' => '_twitterurl',
				'default' => '',
				'label' => __('Twitter URL', 'attesa'),
				'name' => __('Twitter', 'attesa'),
				'icon' => $iconPrefix .' fa-twitter',
			),
			'googleplus' => array (
				'slug' => '_googleplusurl',
				'default' => '',
				'label' => __('Google Plus URL', 'attesa'),
				'name' => __('Google Plus', 'attesa'),
				'icon' => $iconPrefix .' fa-google-plus',
			),
			'linkedin' => array (
				'slug' => '_linkedinurl',
				'default' => '',
				'label' => __('LinkedIn URL', 'attesa'),
				'name' => __('LinkedIn', 'attesa'),
				'icon' => $iconPrefix .' fa-linkedin',
			),
			'instagram' => array (
				'slug' => '_instagramurl',
				'default' => '',
				'label' => __('Instagram URL', 'attesa'),
				'name' => __('Instagram', 'attesa'),
				'icon' => $iconPrefix .' fa-instagram',
			),
			'youtube' => array (
				'slug' => '_youtubeurl',
				'default' => '',
				'label' => __('YouTube URL', 'attesa'),
				'name' => __('YouTube', 'attesa'),
				'icon' => $iconPrefix .' fa-youtube',
			),
			'pinterest' => array (
				'slug' => '_pinteresturl',
				'default' => '',
				'label' => __('Pinterest URL', 'attesa'),
				'name' => __('Pinterest', 'attesa'),
				'icon' => $iconPrefix .' fa-pinterest',
			),
			'tumblr' => array (
				'slug' => '_tumblrurl',
				'default' => '',
				'label' => __('Tumblr URL', 'attesa'),
				'name' => __('Tumblr', 'attesa'),
				'icon' => $iconPrefix .' fa-tumblr',
			),
			'flickr' => array (
				'slug' => '_flickrurl',
				'default' => '',
				'label' => __('Flickr URL', 'attesa'),
				'name' => __('Flickr', 'attesa'),
				'icon' => $iconPrefix .' fa-flickr',
			),
			'vk' => array (
				'slug' => '_vkurl',
				'default' => '',
				'label' => __('VK URL', 'attesa'),
				'name' => __('VK', 'attesa'),
				'icon' => $iconPrefix .' fa-vk',
			),
			'xing' => array (
				'slug' => '_xingurl',
				'default' => '',
				'label' => __('Xing URL', 'attesa'),
				'name' => __('Xing', 'attesa'),
				'icon' => $iconPrefix .' fa-xing',
			),
			'reddit' => array (
				'slug' => '_redditurl',
				'default' => '',
				'label' => __('Reddit URL', 'attesa'),
				'name' => __('Reddit', 'attesa'),
				'icon' => $iconPrefix .' fa-reddit-alien',
			),
			'vimeo' => array (
				'slug' => '_vimeourl',
				'default' => '',
				'label' => __('Vimeo URL', 'attesa'),
				'name' => __('Vimeo', 'attesa'),
				'icon' => $iconPrefix .' fa-vimeo',
			),
			'imdb' => array (
				'slug' => '_imdburl',
				'default' => '',
				'label' => __('IMDb URL', 'attesa'),
				'name' => __('IMDb', 'attesa'),
				'icon' => $iconPrefix .' fa-imdb',
			),
			'telegram' => array (
				'slug' => '_telegramurl',
				'default' => '',
				'label' => __('Telegram URL', 'attesa'),
				'name' => __('Telegram', 'attesa'),
				'icon' => $iconPrefix .' fa-telegram',
			),
			'wechat' => array (
				'slug' => '_wechaturl',
				'default' => '',
				'label' => __('WeChat URL', 'attesa'),
				'name' => __('WeChat', 'attesa'),
				'icon' => $iconPrefix .' fa-weixin',
			),
			'weibo' => array (
				'slug' => '_weibourl',
				'default' => '',
				'label' => __('Weibo URL', 'attesa'),
				'name' => __('Weibo', 'attesa'),
				'icon' => $iconPrefix .' fa-weibo',
			),
			'snapchat' => array (
				'slug' => '_snapchaturl',
				'default' => '',
				'label' => __('SnapChat URL', 'attesa'),
				'name' => __('SnapChat', 'attesa'),
				'icon' => $iconPrefix .' fa-snapchat-ghost',
			),
			'soundcloud' => array (
				'slug' => '_soundcloudurl',
				'default' => '',
				'label' => __('SoundCloud URL', 'attesa'),
				'name' => __('SoundCloud', 'attesa'),
				'icon' => $iconPrefix .' fa-soundcloud',
			),
			'okru' => array (
				'slug' => '_okurl',
				'default' => '',
				'label' => __('Ok.ru URL', 'attesa'),
				'name' => __('Ok.ru', 'attesa'),
				'icon' => $iconPrefix .' fa-odnoklassniki',
			),
			'renren' => array (
				'slug' => '_renrenurl',
				'default' => '',
				'label' => __('Renren URL', 'attesa'),
				'name' => __('Renren', 'attesa'),
				'icon' => $iconPrefix .' fa-renren',
			),
			'qq' => array (
				'slug' => '_qqurl',
				'default' => '',
				'label' => __('QQ URL', 'attesa'),
				'name' => __('QQ', 'attesa'),
				'icon' => $iconPrefix .' fa-qq',
			),
			'lastfm' => array (
				'slug' => '_lastfmurl',
				'default' => '',
				'label' => __('Last.fm URL', 'attesa'),
				'name' => __('Last.fm', 'attesa'),
				'icon' => $iconPrefix .' fa-lastfm',
			),
			'wordpress' => array (
				'slug' => '_wordpressurl',
				'default' => '',
				'label' => __('WordPress URL', 'attesa'),
				'name' => __('WordPress', 'attesa'),
				'icon' => $iconPrefix .' fa-wordpress',
			),
		);
		return apply_filters('attesa_social_network_register', $social);
	}
}

/* This is an example to simply add new social network buttons via child-theme using 'attesa_social_network_register' filter
add_filter('attesa_social_network_register', 'attesa_add_additional_social_network');
function attesa_add_additional_social_network($social) {
	$newSocial = array (
		'home' => array (
			'slug' => '_homeurl', //slug
			'default' => '', //default value
			'label' => __('Home URL', 'attesa'), //label in the customizer
			'name' => __('Home', 'attesa'), //Name
			'icon' => 'fa fa-home' //fontAwesome icon
		)
	);
	return array_merge($social,$newSocial);
}
*/

/* Register Google Fonts Heading */
if( ! function_exists('attesa_google_fonts_heading')){
	function attesa_google_fonts_heading() {
		$attesa_google_fonts_heading = array (
			'Playfair Display : serif' => esc_html__( 'Playfair Display', 'attesa'),
			'Poppins : sans-serif' => esc_html__( 'Poppins', 'attesa'),
			'Oswald : sans-serif' => esc_html__( 'Oswald', 'attesa'),
			'Merriweather : serif' => esc_html__( 'Merriweather', 'attesa'),
			'Nunito : sans-serif' => esc_html__( 'Nunito', 'attesa'),
			'Quicksand : sans-serif' => esc_html__( 'Quicksand', 'attesa'),
			'Exo : sans-serif' => esc_html__( 'Exo', 'attesa'),
			'Josefin Slab : serif' => esc_html__( 'Josefin Slab', 'attesa'),
			'Lobster Two : cursive' => esc_html__( 'Lobster Two', 'attesa'),
			'Philosopher : sans-serif' => esc_html__( 'Philosopher', 'attesa'),
			'Kalam : cursive' => esc_html__( 'Kalam', 'attesa'),
			'Khand : sans-serif' => esc_html__( 'Khand', 'attesa'),
			'Nobile : sans-serif' => esc_html__( 'Nobile', 'attesa'),
			'Cormorant Upright : serif' => esc_html__( 'Cormorant Upright', 'attesa'),
			'Atma : cursive' => esc_html__( 'Atma', 'attesa'),
			'Dancing Script : cursive' => esc_html__( 'Dancing Script', 'attesa'),
			'Amatic SC : cursive' => esc_html__( 'Amatic SC', 'attesa'),
			'Cabin Sketch : cursive' => esc_html__( 'Cabin Sketch', 'attesa'),
			'Merienda : cursive' => esc_html__( 'Merienda', 'attesa'),
			'Unkempt : cursive' => esc_html__( 'Unkempt', 'attesa'),
			'Lato : sans-serif' => esc_html__( 'Lato', 'attesa'),
			'Life Savers : cursive' => esc_html__( 'Life Savers', 'attesa'),
			'Caveat : cursive' => esc_html__( 'Caveat', 'attesa'),
			'Oregano : cursive' => esc_html__( 'Oregano', 'attesa'),
			'Skranji : cursive' => esc_html__( 'Skranji', 'attesa'),
			'Stardos Stencil : cursive' => esc_html__( 'Stardos Stencil', 'attesa'),
			'Oleo Script Swash Caps : cursive' => esc_html__( 'Oleo Script Swash Caps', 'attesa'),
			'Cherry Swash : cursive' => esc_html__( 'Cherry Swash', 'attesa'),
			'Tangerine : cursive' => esc_html__( 'Tangerine', 'attesa'),
			'Allan : cursive' => esc_html__( 'Allan', 'attesa'),
			'Almendra : serif' => esc_html__( 'Almendra', 'attesa'),
			'Dosis : sans-serif' => esc_html__( 'Dosis', 'attesa'),
			'Nanum Myeongjo : serif' => esc_html__( 'Nanum Myeongjo', 'attesa'),
			'Expletus Sans : cursive' => esc_html__( 'Expletus Sans', 'attesa'),
			'Sansita : sans-serif' => esc_html__( 'Sansita', 'attesa'),
			'Montserrat Alternates : sans-serif' => esc_html__( 'Montserrat Alternates', 'attesa'),
		);
		return apply_filters('attesa_google_fonts_heading_register', $attesa_google_fonts_heading);
	}
}

/* Register Google Fonts Text */
if( ! function_exists('attesa_google_fonts_text')){
	function attesa_google_fonts_text() {
		$attesa_google_fonts_text = array (
			'Muli : sans-serif' => esc_html__( 'Muli', 'attesa'),
			'Montserrat : sans-serif' => esc_html__( 'Montserrat', 'attesa'),
			'Quicksand : sans-serif' => esc_html__( 'Quicksand', 'attesa'),
			'Roboto : sans-serif' => esc_html__( 'Roboto', 'attesa'),
			'Open Sans : sans-serif' => esc_html__( 'Open Sans', 'attesa'),
			'Roboto Slab : serif' => esc_html__( 'Roboto Slab', 'attesa'),
			'Arimo : sans-serif' => esc_html__( 'Arimo', 'attesa'),
			'Rubik : sans-serif' => esc_html__( 'Rubik', 'attesa'),
			'Cabin : sans-serif' => esc_html__( 'Cabin', 'attesa'),
			'Dosis : sans-serif' => esc_html__( 'Dosis', 'attesa'),
			'Poppins : sans-serif' => esc_html__( 'Poppins', 'attesa'),
			'Catamaran : sans-serif' => esc_html__( 'Catamaran', 'attesa'),
			'Karla : sans-serif' => esc_html__( 'Karla', 'attesa'),
			'Comfortaa : cursive' => esc_html__( 'Comfortaa', 'attesa'),
			'Cabin Condensed : sans-serif' => esc_html__( 'Cabin Condensed', 'attesa'),
			'Rambla : sans-serif' => esc_html__( 'Rambla', 'attesa'),
			'Rasa : serif' => esc_html__( 'Rasa', 'attesa'),
			'Hind Vadodara : sans-serif' => esc_html__( 'Hind Vadodara', 'attesa'),
			'Droid Sans : sans-serif' => esc_html__( 'Droid Sans', 'attesa'),
			'Oxygen : sans-serif' => esc_html__( 'Oxygen', 'attesa'),
			'Judson : serif' => esc_html__( 'Judson', 'attesa'),
			'Lato : sans-serif' => esc_html__( 'Lato', 'attesa'),
			'Sura : serif' => esc_html__( 'Sura', 'attesa'),
			'Maven Pro : sans-serif' => esc_html__( 'Maven Pro', 'attesa'),
			'Quattrocento Sans : sans-serif' => esc_html__( 'Quattrocento Sans', 'attesa'),
			'Rajdhani : sans-serif' => esc_html__( 'Rajdhani', 'attesa'),
			'Vollkorn : serif' => esc_html__( 'Vollkorn', 'attesa'),
			'Advent Pro : sans-serif' => esc_html__( 'Advent Pro', 'attesa'),
			'Livvic : sans-serif' => esc_html__( 'Livvic', 'attesa'),
			'Fira Sans : sans-serif' => esc_html__( 'Fira Sans', 'attesa'),
		);
		return apply_filters('attesa_google_fonts_text_register', $attesa_google_fonts_text);
	}
}

/* This is an example to simply add new Google Fonts (for heading or for text) via child-theme using 'attesa_google_fonts_heading_register' filter (for heading) or 'attesa_google_fonts_text_register' filter (for text)
add_filter('attesa_google_fonts_heading_register', 'attesa_add_additional_google_fonts_heading');
function attesa_add_additional_google_fonts_heading($headingFonts) {
	$newFonts = array (
		'Noto Sans HK : sans-serif' => esc_html__( 'Noto Sans HK', 'attesa-child'),
		'B612 Mono : monospace' => esc_html__( 'B612 Mono', 'attesa-child'),
	);
	return array_merge($headingFonts,$newFonts);
}
*/

/* Create a string with all social network used */
if( ! function_exists('attesa_all_social_network_used')){
	function attesa_all_social_network_used() {		
		$socialString = '';
		foreach (attesa_register_all_social_network() as $social) {
			$socialValue = attesa_options($social['slug'],$social['default']);
			if ($socialValue) {
				$socialString .= $social['slug'].',';
			}
		}
		return $socialString;
	}
}
/**
 * Social Buttons
 */
if( ! function_exists('attesa_show_social_network')){
	function attesa_show_social_network($position) {
		$networkButtons = attesa_all_social_network_used();
		if (!is_array($networkButtons)) {
			$networkButtonsList = explode (',',$networkButtons );
		} else {
			$networkButtonsList = $networkButtons;
		}
		$openLinks = attesa_options('_social_open_links', '_self');
		if ($openLinks == '_blank') {
			$attribute = 'rel=noopener';
		} else {
			$attribute = '';
		}
		if ($position == 'float') {
			$posName = 'site-social-float';
		} elseif ($position == 'footer') {
			$posName = 'site-social-footer';
		} elseif ($position == 'header') {
			$posName = 'site-social-header';
		} elseif ($position == 'top') {
			$posName = 'site-social-top';
		} elseif ($position == 'widget') {
			$posName = 'site-social-widget';
		} elseif ($position == 'elementor') {
			$posName = 'site-social-elementor';
		}
		$socialsToShow = '<div class="'.esc_attr($posName).'">';
		foreach (attesa_register_all_social_network() as $social) {
			if(in_array($social['slug'],$networkButtonsList)) {
				$socialsToShow .= '<a class="attesa-social" href="'.esc_url(attesa_options($social['slug'],$social['default'])).'" target="'.esc_attr($openLinks).'" '.esc_attr($attribute).' title="'.esc_attr($social['name']).'"><i class="'.esc_attr($social['icon']).' spaceLeftRight"><span class="screen-reader-text">'.esc_attr($social['name']).'</span></i></a>';
			}
		}
		$socialsToShow .= '</div>';
		return $socialsToShow;
	}
}

/**
 * Choose the loader
 */

if( ! function_exists('attesa_loadingPage')){
	function attesa_loadingPage() {
		$theLoader = attesa_options('_choose_loader', 'loader1');
		$choosenLoader = '';
		if ($theLoader == 'loader1') {
			$choosenLoader = '<div class="aLoader1"></div>';
		} elseif ($theLoader == 'loader2') {
			$choosenLoader = '<div class="aLoader2"></div>';
		}
		return apply_filters( 'attesa_choose_loader', $choosenLoader );
	}
}

/**
 * Replace Excerpt More
 */
if( ! function_exists('attesa_new_excerpt_more')){
	function attesa_new_excerpt_more( $more ) {
		if ( is_admin() || attesa_options('_show_posts', 'excerpt') == 'fullpost' ) {
			return $more;
		}
		$customMore = attesa_options('_excerpt_more', '&hellip;');
		return esc_html($customMore);
	}
}
add_filter('excerpt_more', 'attesa_new_excerpt_more');

/**
 * Custom Excerpt Length
 */
if( ! function_exists('attesa_custom_excerpt_length')){
	function attesa_custom_excerpt_length( $length ) {
		if ( ! is_admin() || attesa_options('_show_posts', 'excerpt') == 'fullpost' ) {
			$textBlog = attesa_options('_lenght_blog', '55');
			return apply_filters( 'attesa_choose_excerpt_length', intval($textBlog) );
		} else {
			return $length;
		}
	}
}
add_filter( 'excerpt_length', 'attesa_custom_excerpt_length', 999 );

/**
 * Font Awesome 4 array for scroll top icons
 */
if( ! function_exists('attesa_font_awesome_icon_array_scrolltop')){
	function attesa_font_awesome_icon_array_scrolltop(){
		return array("fa fa-arrow-up","fa fa-arrow-circle-up","fa fa-arrow-circle-o-up","fa fa-angle-double-up","fa fa-angle-up","fa fa-chevron-up","fa fa-hand-o-up","fa fa-caret-square-o-up","fa fa-long-arrow-up","fa fa-caret-up","fa fa-level-up","fa fa-chevron-circle-up");
	}
}

/**
 * Font Awesome 5 array for scroll top icons
 */
if( ! function_exists('attesa_font_awesome_5_icon_array_scrolltop')){
	function attesa_font_awesome_5_icon_array_scrolltop(){
		return array("fas fa-angle-double-up", "fas fa-angle-up", "fas fa-arrow-circle-up", "fas fa-arrow-alt-circle-up". "fas fa-arrow-up", "fas fa-caret-square-up", "fas fa-caret-up", "fas fa-chevron-up", "fas fa-cloud-upload-alt", "fas fa-hand-point-up", "fas fa-level-up-alt", "fas fa-long-arrow-alt-up", "fas fa-sort-up", "far fa-arrow-alt-circle-up", "far fa-caret-square-up", "far fa-hand-point-up");
	}
}

/**
 * Font Awesome 4 array for cart icons
 */
if( ! function_exists('attesa_font_awesome_icon_array_cart')){
	function attesa_font_awesome_icon_array_cart(){
		return array("fa fa-archive","fa fa-shopping-cart","fa fa-shopping-bag","fa fa-suitcase");
	}
}

/**
 * Font Awesome 5 array for cart icons
 */
if( ! function_exists('attesa_font_awesome_5_icon_array_cart')){
	function attesa_font_awesome_5_icon_array_cart(){
		return array("fas fa-luggage-cart", "fas fa-shopping-cart", "fas fa-cart-arrow-down", "fas fa-cart-plus", "fab fa-opencart");
	}
}

/**
 * Font Awesome 4 array for general icons
 */
if( ! function_exists('attesa_font_awesome_icon_array_general')){
	function attesa_font_awesome_icon_array_general(){
		return array("fa fa-address-book","fa fa-address-book-o","fa fa-address-card","fa fa-address-card-o","fa fa-bandcamp","fa fa-bath","fa fa-bathtub","fa fa-drivers-license","fa fa-drivers-license-o","fa fa-eercast","fa fa-envelope-open","fa fa-envelope-open-o","fa fa-etsy","fa fa-free-code-camp","fa fa-grav","fa fa-handshake-o","fa fa-id-badge","fa fa-id-card","fa fa-id-card-o","fa fa-imdb","fa fa-linode","fa fa-meetup","fa fa-microchip","fa fa-podcast","fa fa-quora","fa fa-ravelry","fa fa-s15","fa fa-shower","fa fa-snowflake-o","fa fa-superpowers","fa fa-telegram","fa fa-thermometer","fa fa-thermometer-0","fa fa-thermometer-1","fa fa-thermometer-2","fa fa-thermometer-3","fa fa-thermometer-4","fa fa-thermometer-empty","fa fa-thermometer-full","fa fa-thermometer-half","fa fa-thermometer-quarter","fa fa-thermometer-three-quarters","fa fa-times-rectangle","fa fa-times-rectangle-o","fa fa-user-circle","fa fa-user-circle-o","fa fa-user-o","fa fa-vcard","fa fa-vcard-o","fa fa-window-close","fa fa-window-close-o","fa fa-window-maximize","fa fa-window-minimize","fa fa-window-restore","fa fa-wpexplorer","fa fa-address-book","fa fa-address-book-o","fa fa-address-card","fa fa-address-card-o","fa fa-adjust","fa fa-american-sign-language-interpreting","fa fa-anchor","fa fa-archive","fa fa-area-chart","fa fa-arrows","fa fa-arrows-h","fa fa-arrows-v","fa fa-asl-interpreting","fa fa-assistive-listening-systems","fa fa-asterisk","fa fa-at","fa fa-audio-description","fa fa-automobile","fa fa-balance-scale","fa fa-ban","fa fa-bank","fa fa-bar-chart","fa fa-bar-chart-o","fa fa-barcode","fa fa-bars","fa fa-bath","fa fa-bathtub","fa fa-battery","fa fa-battery-0","fa fa-battery-1","fa fa-battery-2","fa fa-battery-3","fa fa-battery-4","fa fa-battery-empty","fa fa-battery-full","fa fa-battery-half","fa fa-battery-quarter","fa fa-battery-three-quarters","fa fa-bed","fa fa-beer","fa fa-bell","fa fa-bell-o","fa fa-bell-slash","fa fa-bell-slash-o","fa fa-bicycle","fa fa-binoculars","fa fa-birthday-cake","fa fa-blind","fa fa-bluetooth","fa fa-bluetooth-b","fa fa-bolt","fa fa-bomb","fa fa-book","fa fa-bookmark","fa fa-bookmark-o","fa fa-braille","fa fa-briefcase","fa fa-bug","fa fa-building","fa fa-building-o","fa fa-bullhorn","fa fa-bullseye","fa fa-bus","fa fa-cab","fa fa-calculator","fa fa-calendar","fa fa-calendar-check-o","fa fa-calendar-minus-o","fa fa-calendar-o","fa fa-calendar-plus-o","fa fa-calendar-times-o","fa fa-camera","fa fa-camera-retro","fa fa-car","fa fa-caret-square-o-down","fa fa-caret-square-o-left","fa fa-caret-square-o-right","fa fa-caret-square-o-up","fa fa-cart-arrow-down","fa fa-cart-plus","fa fa-cc","fa fa-certificate","fa fa-check","fa fa-check-circle","fa fa-check-circle-o","fa fa-check-square","fa fa-check-square-o","fa fa-child","fa fa-circle","fa fa-circle-o","fa fa-circle-o-notch","fa fa-circle-thin","fa fa-clock-o","fa fa-clone","fa fa-close","fa fa-cloud","fa fa-cloud-download","fa fa-cloud-upload","fa fa-code","fa fa-code-fork","fa fa-coffee","fa fa-cog","fa fa-cogs","fa fa-comment","fa fa-comment-o","fa fa-commenting","fa fa-commenting-o","fa fa-comments","fa fa-comments-o","fa fa-compass","fa fa-copyright","fa fa-creative-commons","fa fa-credit-card","fa fa-credit-card-alt","fa fa-crop","fa fa-crosshairs","fa fa-cube","fa fa-cubes","fa fa-cutlery","fa fa-dashboard","fa fa-database","fa fa-deaf","fa fa-deafness","fa fa-desktop","fa fa-diamond","fa fa-dot-circle-o","fa fa-download","fa fa-drivers-license","fa fa-drivers-license-o","fa fa-edit","fa fa-ellipsis-h","fa fa-ellipsis-v","fa fa-envelope","fa fa-envelope-o","fa fa-envelope-open","fa fa-envelope-open-o","fa fa-envelope-square","fa fa-eraser","fa fa-exchange","fa fa-exclamation","fa fa-exclamation-circle","fa fa-exclamation-triangle","fa fa-external-link","fa fa-external-link-square","fa fa-eye","fa fa-eye-slash","fa fa-eyedropper","fa fa-fax","fa fa-feed","fa fa-female","fa fa-fighter-jet","fa fa-file-archive-o","fa fa-file-audio-o","fa fa-file-code-o","fa fa-file-excel-o","fa fa-file-image-o","fa fa-file-movie-o","fa fa-file-pdf-o","fa fa-file-photo-o","fa fa-file-picture-o","fa fa-file-powerpoint-o","fa fa-file-sound-o","fa fa-file-video-o","fa fa-file-word-o","fa fa-file-zip-o","fa fa-film","fa fa-filter","fa fa-fire","fa fa-fire-extinguisher","fa fa-flag","fa fa-flag-checkered","fa fa-flag-o","fa fa-flash","fa fa-flask","fa fa-folder","fa fa-folder-o","fa fa-folder-open","fa fa-folder-open-o","fa fa-frown-o","fa fa-futbol-o","fa fa-gamepad","fa fa-gavel","fa fa-gear","fa fa-gears","fa fa-gift","fa fa-glass","fa fa-globe","fa fa-graduation-cap","fa fa-group","fa fa-hand-grab-o","fa fa-hand-lizard-o","fa fa-hand-paper-o","fa fa-hand-peace-o","fa fa-hand-pointer-o","fa fa-hand-rock-o","fa fa-hand-scissors-o","fa fa-hand-spock-o","fa fa-hand-stop-o","fa fa-handshake-o","fa fa-hard-of-hearing","fa fa-hashtag","fa fa-hdd-o","fa fa-headphones","fa fa-heart","fa fa-heart-o","fa fa-heartbeat","fa fa-history","fa fa-home","fa fa-hotel","fa fa-hourglass","fa fa-hourglass-1","fa fa-hourglass-2","fa fa-hourglass-3","fa fa-hourglass-end","fa fa-hourglass-half","fa fa-hourglass-o","fa fa-hourglass-start","fa fa-i-cursor","fa fa-id-badge","fa fa-id-card","fa fa-id-card-o","fa fa-image","fa fa-inbox","fa fa-industry","fa fa-info","fa fa-info-circle","fa fa-institution","fa fa-key","fa fa-keyboard-o","fa fa-language","fa fa-laptop","fa fa-leaf","fa fa-legal","fa fa-lemon-o","fa fa-level-down","fa fa-level-up","fa fa-life-bouy","fa fa-life-buoy","fa fa-life-ring","fa fa-life-saver","fa fa-lightbulb-o","fa fa-line-chart","fa fa-location-arrow","fa fa-lock","fa fa-low-vision","fa fa-magic","fa fa-magnet","fa fa-mail-forward","fa fa-mail-reply","fa fa-mail-reply-all","fa fa-male","fa fa-map","fa fa-map-marker","fa fa-map-o","fa fa-map-pin","fa fa-map-signs","fa fa-meh-o","fa fa-microchip","fa fa-microphone","fa fa-microphone-slash","fa fa-minus","fa fa-minus-circle","fa fa-minus-square","fa fa-minus-square-o","fa fa-mobile","fa fa-mobile-phone","fa fa-money","fa fa-moon-o","fa fa-mortar-board","fa fa-motorcycle","fa fa-mouse-pointer","fa fa-music","fa fa-navicon","fa fa-newspaper-o","fa fa-object-group","fa fa-object-ungroup","fa fa-paint-brush","fa fa-paper-plane","fa fa-paper-plane-o","fa fa-paw","fa fa-pencil","fa fa-pencil-square","fa fa-pencil-square-o","fa fa-percent","fa fa-phone","fa fa-phone-square","fa fa-photo","fa fa-picture-o","fa fa-pie-chart","fa fa-plane","fa fa-plug","fa fa-plus","fa fa-plus-circle","fa fa-plus-square","fa fa-plus-square-o","fa fa-podcast","fa fa-power-off","fa fa-print","fa fa-puzzle-piece","fa fa-qrcode","fa fa-question","fa fa-question-circle","fa fa-question-circle-o","fa fa-quote-left","fa fa-quote-right","fa fa-random","fa fa-recycle","fa fa-refresh","fa fa-registered","fa fa-remove","fa fa-reorder","fa fa-reply","fa fa-reply-all","fa fa-retweet","fa fa-road","fa fa-rocket","fa fa-rss","fa fa-rss-square","fa fa-s15","fa fa-search","fa fa-search-minus","fa fa-search-plus","fa fa-send","fa fa-send-o","fa fa-server","fa fa-share","fa fa-share-alt","fa fa-share-alt-square","fa fa-share-square","fa fa-share-square-o","fa fa-shield","fa fa-ship","fa fa-shopping-bag","fa fa-shopping-basket","fa fa-shopping-cart","fa fa-shower","fa fa-sign-in","fa fa-sign-language","fa fa-sign-out","fa fa-signal","fa fa-signing","fa fa-sitemap","fa fa-sliders","fa fa-smile-o","fa fa-snowflake-o","fa fa-soccer-ball-o","fa fa-sort","fa fa-sort-alpha-asc","fa fa-sort-alpha-desc","fa fa-sort-amount-asc","fa fa-sort-amount-desc","fa fa-sort-asc","fa fa-sort-desc","fa fa-sort-down","fa fa-sort-numeric-asc","fa fa-sort-numeric-desc","fa fa-sort-up","fa fa-space-shuttle","fa fa-spinner","fa fa-spoon","fa fa-square","fa fa-square-o","fa fa-star","fa fa-star-half","fa fa-star-half-empty","fa fa-star-half-full","fa fa-star-half-o","fa fa-star-o","fa fa-sticky-note","fa fa-sticky-note-o","fa fa-street-view","fa fa-suitcase","fa fa-sun-o","fa fa-support","fa fa-tablet","fa fa-tachometer","fa fa-tag","fa fa-tags","fa fa-tasks","fa fa-taxi","fa fa-television","fa fa-terminal","fa fa-thermometer","fa fa-thermometer-0","fa fa-thermometer-1","fa fa-thermometer-2","fa fa-thermometer-3","fa fa-thermometer-4","fa fa-thermometer-empty","fa fa-thermometer-full","fa fa-thermometer-half","fa fa-thermometer-quarter","fa fa-thermometer-three-quarters","fa fa-thumb-tack","fa fa-thumbs-down","fa fa-thumbs-o-down","fa fa-thumbs-o-up","fa fa-thumbs-up","fa fa-ticket","fa fa-times","fa fa-times-circle","fa fa-times-circle-o","fa fa-times-rectangle","fa fa-times-rectangle-o","fa fa-tint","fa fa-toggle-down","fa fa-toggle-left","fa fa-toggle-off","fa fa-toggle-on","fa fa-toggle-right","fa fa-toggle-up","fa fa-trademark","fa fa-trash","fa fa-trash-o","fa fa-tree","fa fa-trophy","fa fa-truck","fa fa-tty","fa fa-tv","fa fa-umbrella","fa fa-universal-access","fa fa-university","fa fa-unlock","fa fa-unlock-alt","fa fa-unsorted","fa fa-upload","fa fa-user","fa fa-user-circle","fa fa-user-circle-o","fa fa-user-o","fa fa-user-plus","fa fa-user-secret","fa fa-user-times","fa fa-users","fa fa-vcard","fa fa-vcard-o","fa fa-video-camera","fa fa-volume-control-phone","fa fa-volume-down","fa fa-volume-off","fa fa-volume-up","fa fa-warning","fa fa-wheelchair","fa fa-wheelchair-alt","fa fa-wifi","fa fa-window-close","fa fa-window-close-o","fa fa-window-maximize","fa fa-window-minimize","fa fa-window-restore","fa fa-wrench","fa fa-american-sign-language-interpreting","fa fa-asl-interpreting","fa fa-assistive-listening-systems","fa fa-audio-description","fa fa-blind","fa fa-braille","fa fa-cc","fa fa-deaf","fa fa-deafness","fa fa-hard-of-hearing","fa fa-low-vision","fa fa-question-circle-o","fa fa-sign-language","fa fa-signing","fa fa-tty","fa fa-universal-access","fa fa-volume-control-phone","fa fa-wheelchair","fa fa-wheelchair-alt","fa fa-hand-grab-o","fa fa-hand-lizard-o","fa fa-hand-o-down","fa fa-hand-o-left","fa fa-hand-o-right","fa fa-hand-o-up","fa fa-hand-paper-o","fa fa-hand-peace-o","fa fa-hand-pointer-o","fa fa-hand-rock-o","fa fa-hand-scissors-o","fa fa-hand-spock-o","fa fa-hand-stop-o","fa fa-thumbs-down","fa fa-thumbs-o-down","fa fa-thumbs-o-up","fa fa-thumbs-up","fa fa-ambulance","fa fa-automobile","fa fa-bicycle","fa fa-bus","fa fa-cab","fa fa-car","fa fa-fighter-jet","fa fa-motorcycle","fa fa-plane","fa fa-rocket","fa fa-ship","fa fa-space-shuttle","fa fa-subway","fa fa-taxi","fa fa-train","fa fa-truck","fa fa-wheelchair","fa fa-wheelchair-alt","fa fa-genderless","fa fa-intersex","fa fa-mars","fa fa-mars-double","fa fa-mars-stroke","fa fa-mars-stroke-h","fa fa-mars-stroke-v","fa fa-mercury","fa fa-neuter","fa fa-transgender","fa fa-transgender-alt","fa fa-venus","fa fa-venus-double","fa fa-venus-mars","fa fa-file","fa fa-file-archive-o","fa fa-file-audio-o","fa fa-file-code-o","fa fa-file-excel-o","fa fa-file-image-o","fa fa-file-movie-o","fa fa-file-o","fa fa-file-pdf-o","fa fa-file-photo-o","fa fa-file-picture-o","fa fa-file-powerpoint-o","fa fa-file-sound-o","fa fa-file-text","fa fa-file-text-o","fa fa-file-video-o","fa fa-file-word-o","fa fa-file-zip-o","fa fa-circle-o-notch","fa fa-cog","fa fa-gear","fa fa-refresh","fa fa-spinner","fa fa-check-square","fa fa-check-square-o","fa fa-circle","fa fa-circle-o","fa fa-dot-circle-o","fa fa-minus-square","fa fa-minus-square-o","fa fa-plus-square","fa fa-plus-square-o","fa fa-square","fa fa-square-o","fa fa-cc-amex","fa fa-cc-diners-club","fa fa-cc-discover","fa fa-cc-jcb","fa fa-cc-mastercard","fa fa-cc-paypal","fa fa-cc-stripe","fa fa-cc-visa","fa fa-credit-card","fa fa-credit-card-alt","fa fa-google-wallet","fa fa-paypal","fa fa-area-chart","fa fa-bar-chart","fa fa-bar-chart-o","fa fa-line-chart","fa fa-pie-chart","fa fa-bitcoin","fa fa-btc","fa fa-cny","fa fa-dollar","fa fa-eur","fa fa-euro","fa fa-gbp","fa fa-gg","fa fa-gg-circle","fa fa-ils","fa fa-inr","fa fa-jpy","fa fa-krw","fa fa-money","fa fa-rmb","fa fa-rouble","fa fa-rub","fa fa-ruble","fa fa-rupee","fa fa-shekel","fa fa-sheqel","fa fa-try","fa fa-turkish-lira","fa fa-usd","fa fa-viacoin","fa fa-won","fa fa-yen","fa fa-align-center","fa fa-align-justify","fa fa-align-left","fa fa-align-right","fa fa-bold","fa fa-chain","fa fa-chain-broken","fa fa-clipboard","fa fa-columns","fa fa-copy","fa fa-cut","fa fa-dedent","fa fa-eraser","fa fa-file","fa fa-file-o","fa fa-file-text","fa fa-file-text-o","fa fa-files-o","fa fa-floppy-o","fa fa-font","fa fa-header","fa fa-indent","fa fa-italic","fa fa-link","fa fa-list","fa fa-list-alt","fa fa-list-ol","fa fa-list-ul","fa fa-outdent","fa fa-paperclip","fa fa-paragraph","fa fa-paste","fa fa-repeat","fa fa-rotate-left","fa fa-rotate-right","fa fa-save","fa fa-scissors","fa fa-strikethrough","fa fa-subscript","fa fa-superscript","fa fa-table","fa fa-text-height","fa fa-text-width","fa fa-th","fa fa-th-large","fa fa-th-list","fa fa-underline","fa fa-undo","fa fa-unlink","fa fa-angle-double-down","fa fa-angle-double-left","fa fa-angle-double-right","fa fa-angle-double-up","fa fa-angle-down","fa fa-angle-left","fa fa-angle-right","fa fa-angle-up","fa fa-arrow-circle-down","fa fa-arrow-circle-left","fa fa-arrow-circle-o-down","fa fa-arrow-circle-o-left","fa fa-arrow-circle-o-right","fa fa-arrow-circle-o-up","fa fa-arrow-circle-right","fa fa-arrow-circle-up","fa fa-arrow-down","fa fa-arrow-left","fa fa-arrow-right","fa fa-arrow-up","fa fa-arrows","fa fa-arrows-alt","fa fa-arrows-h","fa fa-arrows-v","fa fa-caret-down","fa fa-caret-left","fa fa-caret-right","fa fa-caret-square-o-down","fa fa-caret-square-o-left","fa fa-caret-square-o-right","fa fa-caret-square-o-up","fa fa-caret-up","fa fa-chevron-circle-down","fa fa-chevron-circle-left","fa fa-chevron-circle-right","fa fa-chevron-circle-up","fa fa-chevron-down","fa fa-chevron-left","fa fa-chevron-right","fa fa-chevron-up","fa fa-exchange","fa fa-hand-o-down","fa fa-hand-o-left","fa fa-hand-o-right","fa fa-hand-o-up","fa fa-long-arrow-down","fa fa-long-arrow-left","fa fa-long-arrow-right","fa fa-long-arrow-up","fa fa-toggle-down","fa fa-toggle-left","fa fa-toggle-right","fa fa-toggle-up","fa fa-arrows-alt","fa fa-backward","fa fa-compress","fa fa-eject","fa fa-expand","fa fa-fast-backward","fa fa-fast-forward","fa fa-forward","fa fa-pause","fa fa-pause-circle","fa fa-pause-circle-o","fa fa-play","fa fa-play-circle","fa fa-play-circle-o","fa fa-random","fa fa-step-backward","fa fa-step-forward","fa fa-stop","fa fa-stop-circle","fa fa-stop-circle-o","fa fa-youtube-play","fa fa-500px","fa fa-adn","fa fa-amazon","fa fa-android","fa fa-angellist","fa fa-apple","fa fa-bandcamp","fa fa-behance","fa fa-behance-square","fa fa-bitbucket","fa fa-bitbucket-square","fa fa-bitcoin","fa fa-black-tie","fa fa-bluetooth","fa fa-bluetooth-b","fa fa-btc","fa fa-buysellads","fa fa-cc-amex","fa fa-cc-diners-club","fa fa-cc-discover","fa fa-cc-jcb","fa fa-cc-mastercard","fa fa-cc-paypal","fa fa-cc-stripe","fa fa-cc-visa","fa fa-chrome","fa fa-codepen","fa fa-codiepie","fa fa-connectdevelop","fa fa-contao","fa fa-css3","fa fa-dashcube","fa fa-delicious","fa fa-deviantart","fa fa-digg","fa fa-dribbble","fa fa-dropbox","fa fa-drupal","fa fa-edge","fa fa-eercast","fa fa-empire","fa fa-envira","fa fa-etsy","fa fa-expeditedssl","fa fa-fa","fa fa-facebook","fa fa-facebook-f","fa fa-facebook-official","fa fa-facebook-square","fa fa-firefox","fa fa-first-order","fa fa-flickr","fa fa-font-awesome","fa fa-fonticons","fa fa-fort-awesome","fa fa-forumbee","fa fa-foursquare","fa fa-free-code-camp","fa fa-ge","fa fa-get-pocket","fa fa-gg","fa fa-gg-circle","fa fa-git","fa fa-git-square","fa fa-github","fa fa-github-alt","fa fa-github-square","fa fa-gitlab","fa fa-gittip","fa fa-glide","fa fa-glide-g","fa fa-google","fa fa-google-plus","fa fa-google-plus-circle","fa fa-google-plus-official","fa fa-google-plus-square","fa fa-google-wallet","fa fa-gratipay","fa fa-grav","fa fa-hacker-news","fa fa-houzz","fa fa-html5","fa fa-imdb","fa fa-instagram","fa fa-internet-explorer","fa fa-ioxhost","fa fa-joomla","fa fa-jsfiddle","fa fa-lastfm","fa fa-lastfm-square","fa fa-leanpub","fa fa-linkedin","fa fa-linkedin-square","fa fa-linode","fa fa-linux","fa fa-maxcdn","fa fa-meanpath","fa fa-medium","fa fa-meetup","fa fa-mixcloud","fa fa-modx","fa fa-odnoklassniki","fa fa-odnoklassniki-square","fa fa-opencart","fa fa-openid","fa fa-opera","fa fa-optin-monster","fa fa-pagelines","fa fa-paypal","fa fa-pied-piper","fa fa-pied-piper-alt","fa fa-pied-piper-pp","fa fa-pinterest","fa fa-pinterest-p","fa fa-pinterest-square","fa fa-product-hunt","fa fa-qq","fa fa-quora","fa fa-ra","fa fa-ravelry","fa fa-rebel","fa fa-reddit","fa fa-reddit-alien","fa fa-reddit-square","fa fa-renren","fa fa-resistance","fa fa-safari","fa fa-scribd","fa fa-sellsy","fa fa-share-alt","fa fa-share-alt-square","fa fa-shirtsinbulk","fa fa-simplybuilt","fa fa-skyatlas","fa fa-skype","fa fa-slack","fa fa-slideshare","fa fa-snapchat","fa fa-snapchat-ghost","fa fa-snapchat-square","fa fa-soundcloud","fa fa-spotify","fa fa-stack-exchange","fa fa-stack-overflow","fa fa-steam","fa fa-steam-square","fa fa-stumbleupon","fa fa-stumbleupon-circle","fa fa-superpowers","fa fa-telegram","fa fa-tencent-weibo","fa fa-themeisle","fa fa-trello","fa fa-tripadvisor","fa fa-tumblr","fa fa-tumblr-square","fa fa-twitch","fa fa-twitter","fa fa-twitter-square","fa fa-usb","fa fa-viacoin","fa fa-viadeo","fa fa-viadeo-square","fa fa-vimeo","fa fa-vimeo-square","fa fa-vine","fa fa-vk","fa fa-wechat","fa fa-weibo","fa fa-weixin","fa fa-whatsapp","fa fa-wikipedia-w","fa fa-windows","fa fa-wordpress","fa fa-wpbeginner","fa fa-wpexplorer","fa fa-wpforms","fa fa-xing","fa fa-xing-square","fa fa-y-combinator","fa fa-y-combinator-square","fa fa-yahoo","fa fa-yc","fa fa-yc-square","fa fa-yelp","fa fa-yoast","fa fa-youtube","fa fa-youtube-play","fa fa-youtube-square","fa fa-ambulance","fa fa-h-square","fa fa-heart","fa fa-heart-o","fa fa-heartbeat","fa fa-hospital-o","fa fa-medkit","fa fa-plus-square","fa fa-stethoscope","fa fa-user-md","fa fa-wheelchair","fa fa-wheelchair-alt");
	}
}

/**
 * Font Awesome 5 array for general icons
 */

if ( ! function_exists('attesa_font_awesome_5_icon_array_general')) {
	function attesa_font_awesome_5_icon_array_general() {
		return array("fas fa-ad","fas fa-address-book","fas fa-address-card","fas fa-adjust","fas fa-air-freshener","fas fa-align-center","fas fa-align-justify","fas fa-align-left","fas fa-align-right","fas fa-allergies","fas fa-ambulance","fas fa-american-sign-language-interpreting","fas fa-anchor","fas fa-angle-double-down","fas fa-angle-double-left","fas fa-angle-double-right","fas fa-angle-double-up","fas fa-angle-down","fas fa-angle-left","fas fa-angle-right","fas fa-angle-up","fas fa-angry","fas fa-ankh","fas fa-apple-alt","fas fa-archive","fas fa-archway","fas fa-arrow-alt-circle-down","fas fa-arrow-alt-circle-left","fas fa-arrow-alt-circle-right","fas fa-arrow-alt-circle-up","fas fa-arrow-circle-down","fas fa-arrow-circle-left","fas fa-arrow-circle-right","fas fa-arrow-circle-up","fas fa-arrow-down","fas fa-arrow-left","fas fa-arrow-right","fas fa-arrow-up","fas fa-arrows-alt","fas fa-arrows-alt-h","fas fa-arrows-alt-v","fas fa-assistive-listening-systems","fas fa-asterisk","fas fa-at","fas fa-atlas","fas fa-atom","fas fa-audio-description","fas fa-award","fas fa-baby","fas fa-baby-carriage","fas fa-backspace","fas fa-backward","fas fa-bacon","fas fa-balance-scale","fas fa-balance-scale-left","fas fa-balance-scale-right","fas fa-ban","fas fa-band-aid","fas fa-barcode","fas fa-bars","fas fa-baseball-ball","fas fa-basketball-ball","fas fa-bath","fas fa-battery-empty","fas fa-battery-full","fas fa-battery-half","fas fa-battery-quarter","fas fa-battery-three-quarters","fas fa-bed","fas fa-beer","fas fa-bell","fas fa-bell-slash","fas fa-bezier-curve","fas fa-bible","fas fa-bicycle","fas fa-biking","fas fa-binoculars","fas fa-biohazard","fas fa-birthday-cake","fas fa-blender","fas fa-blender-phone","fas fa-blind","fas fa-blog","fas fa-bold","fas fa-bolt","fas fa-bomb","fas fa-bone","fas fa-bong","fas fa-book","fas fa-book-dead","fas fa-book-medical","fas fa-book-open","fas fa-book-reader","fas fa-bookmark","fas fa-border-all","fas fa-border-none","fas fa-border-style","fas fa-bowling-ball","fas fa-box","fas fa-box-open","fas fa-boxes","fas fa-braille","fas fa-brain","fas fa-bread-slice","fas fa-briefcase","fas fa-briefcase-medical","fas fa-broadcast-tower","fas fa-broom","fas fa-brush","fas fa-bug","fas fa-building","fas fa-bullhorn","fas fa-bullseye","fas fa-burn","fas fa-bus","fas fa-bus-alt","fas fa-business-time","fas fa-calculator","fas fa-calendar","fas fa-calendar-alt","fas fa-calendar-check","fas fa-calendar-day","fas fa-calendar-minus","fas fa-calendar-plus","fas fa-calendar-times","fas fa-calendar-week","fas fa-camera","fas fa-camera-retro","fas fa-campground","fas fa-candy-cane","fas fa-cannabis","fas fa-capsules","fas fa-car","fas fa-car-alt","fas fa-car-battery","fas fa-car-crash","fas fa-car-side","fas fa-caret-down","fas fa-caret-left","fas fa-caret-right","fas fa-caret-square-down","fas fa-caret-square-left","fas fa-caret-square-right","fas fa-caret-square-up","fas fa-caret-up","fas fa-carrot","fas fa-cart-arrow-down","fas fa-cart-plus","fas fa-cash-register","fas fa-cat","fas fa-certificate","fas fa-chair","fas fa-chalkboard","fas fa-chalkboard-teacher","fas fa-charging-station","fas fa-chart-area","fas fa-chart-bar","fas fa-chart-line","fas fa-chart-pie","fas fa-check","fas fa-check-circle","fas fa-check-double","fas fa-check-square","fas fa-cheese","fas fa-chess","fas fa-chess-bishop","fas fa-chess-board","fas fa-chess-king","fas fa-chess-knight","fas fa-chess-pawn","fas fa-chess-queen","fas fa-chess-rook","fas fa-chevron-circle-down","fas fa-chevron-circle-left","fas fa-chevron-circle-right","fas fa-chevron-circle-up","fas fa-chevron-down","fas fa-chevron-left","fas fa-chevron-right","fas fa-chevron-up","fas fa-child","fas fa-church","fas fa-circle","fas fa-circle-notch","fas fa-city","fas fa-clinic-medical","fas fa-clipboard","fas fa-clipboard-check","fas fa-clipboard-list","fas fa-clock","fas fa-clone","fas fa-closed-captioning","fas fa-cloud","fas fa-cloud-download-alt","fas fa-cloud-meatball","fas fa-cloud-moon","fas fa-cloud-moon-rain","fas fa-cloud-rain","fas fa-cloud-showers-heavy","fas fa-cloud-sun","fas fa-cloud-sun-rain","fas fa-cloud-upload-alt","fas fa-cocktail","fas fa-code","fas fa-code-branch","fas fa-coffee","fas fa-cog","fas fa-cogs","fas fa-coins","fas fa-columns","fas fa-comment","fas fa-comment-alt","fas fa-comment-dollar","fas fa-comment-dots","fas fa-comment-medical","fas fa-comment-slash","fas fa-comments","fas fa-comments-dollar","fas fa-compact-disc","fas fa-compass","fas fa-compress","fas fa-compress-arrows-alt","fas fa-concierge-bell","fas fa-cookie","fas fa-cookie-bite","fas fa-copy","fas fa-copyright","fas fa-couch","fas fa-credit-card","fas fa-crop","fas fa-crop-alt","fas fa-cross","fas fa-crosshairs","fas fa-crow","fas fa-crown","fas fa-crutch","fas fa-cube","fas fa-cubes","fas fa-cut","fas fa-database","fas fa-deaf","fas fa-democrat","fas fa-desktop","fas fa-dharmachakra","fas fa-diagnoses","fas fa-dice","fas fa-dice-d20","fas fa-dice-d6","fas fa-dice-five","fas fa-dice-four","fas fa-dice-one","fas fa-dice-six","fas fa-dice-three","fas fa-dice-two","fas fa-digital-tachograph","fas fa-directions","fas fa-divide","fas fa-dizzy","fas fa-dna","fas fa-dog","fas fa-dollar-sign","fas fa-dolly","fas fa-dolly-flatbed","fas fa-donate","fas fa-door-closed","fas fa-door-open","fas fa-dot-circle","fas fa-dove","fas fa-download","fas fa-drafting-compass","fas fa-dragon","fas fa-draw-polygon","fas fa-drum","fas fa-drum-steelpan","fas fa-drumstick-bite","fas fa-dumbbell","fas fa-dumpster","fas fa-dumpster-fire","fas fa-dungeon","fas fa-edit","fas fa-egg","fas fa-eject","fas fa-ellipsis-h","fas fa-ellipsis-v","fas fa-envelope","fas fa-envelope-open","fas fa-envelope-open-text","fas fa-envelope-square","fas fa-equals","fas fa-eraser","fas fa-ethernet","fas fa-euro-sign","fas fa-exchange-alt","fas fa-exclamation","fas fa-exclamation-circle","fas fa-exclamation-triangle","fas fa-expand","fas fa-expand-arrows-alt","fas fa-external-link-alt","fas fa-external-link-square-alt","fas fa-eye","fas fa-eye-dropper","fas fa-eye-slash","fas fa-fan","fas fa-fast-backward","fas fa-fast-forward","fas fa-fax","fas fa-feather","fas fa-feather-alt","fas fa-female","fas fa-fighter-jet","fas fa-file","fas fa-file-alt","fas fa-file-archive","fas fa-file-audio","fas fa-file-code","fas fa-file-contract","fas fa-file-csv","fas fa-file-download","fas fa-file-excel","fas fa-file-export","fas fa-file-image","fas fa-file-import","fas fa-file-invoice","fas fa-file-invoice-dollar","fas fa-file-medical","fas fa-file-medical-alt","fas fa-file-pdf","fas fa-file-powerpoint","fas fa-file-prescription","fas fa-file-signature","fas fa-file-upload","fas fa-file-video","fas fa-file-word","fas fa-fill","fas fa-fill-drip","fas fa-film","fas fa-filter","fas fa-fingerprint","fas fa-fire","fas fa-fire-alt","fas fa-fire-extinguisher","fas fa-first-aid","fas fa-fish","fas fa-fist-raised","fas fa-flag","fas fa-flag-checkered","fas fa-flag-usa","fas fa-flask","fas fa-flushed","fas fa-folder","fas fa-folder-minus","fas fa-folder-open","fas fa-folder-plus","fas fa-font","fas fa-football-ball","fas fa-forward","fas fa-frog","fas fa-frown","fas fa-frown-open","fas fa-funnel-dollar","fas fa-futbol","fas fa-gamepad","fas fa-gas-pump","fas fa-gavel","fas fa-gem","fas fa-genderless","fas fa-ghost","fas fa-gift","fas fa-gifts","fas fa-glass-cheers","fas fa-glass-martini","fas fa-glass-martini-alt","fas fa-glass-whiskey","fas fa-glasses","fas fa-globe","fas fa-globe-africa","fas fa-globe-americas","fas fa-globe-asia","fas fa-globe-europe","fas fa-golf-ball","fas fa-gopuram","fas fa-graduation-cap","fas fa-greater-than","fas fa-greater-than-equal","fas fa-grimace","fas fa-grin","fas fa-grin-alt","fas fa-grin-beam","fas fa-grin-beam-sweat","fas fa-grin-hearts","fas fa-grin-squint","fas fa-grin-squint-tears","fas fa-grin-stars","fas fa-grin-tears","fas fa-grin-tongue","fas fa-grin-tongue-squint","fas fa-grin-tongue-wink","fas fa-grin-wink","fas fa-grip-horizontal","fas fa-grip-lines","fas fa-grip-lines-vertical","fas fa-grip-vertical","fas fa-guitar","fas fa-h-square","fas fa-hamburger","fas fa-hammer","fas fa-hamsa","fas fa-hand-holding","fas fa-hand-holding-heart","fas fa-hand-holding-usd","fas fa-hand-lizard","fas fa-hand-middle-finger","fas fa-hand-paper","fas fa-hand-peace","fas fa-hand-point-down","fas fa-hand-point-left","fas fa-hand-point-right","fas fa-hand-point-up","fas fa-hand-pointer","fas fa-hand-rock","fas fa-hand-scissors","fas fa-hand-spock","fas fa-hands","fas fa-hands-helping","fas fa-handshake","fas fa-hanukiah","fas fa-hard-hat","fas fa-hashtag","fas fa-hat-cowboy","fas fa-hat-cowboy-side","fas fa-hat-wizard","fas fa-haykal","fas fa-hdd","fas fa-heading","fas fa-headphones","fas fa-headphones-alt","fas fa-headset","fas fa-heart","fas fa-heart-broken","fas fa-heartbeat","fas fa-helicopter","fas fa-highlighter","fas fa-hiking","fas fa-hippo","fas fa-history","fas fa-hockey-puck","fas fa-holly-berry","fas fa-home","fas fa-horse","fas fa-horse-head","fas fa-hospital","fas fa-hospital-alt","fas fa-hospital-symbol","fas fa-hot-tub","fas fa-hotdog","fas fa-hotel","fas fa-hourglass","fas fa-hourglass-end","fas fa-hourglass-half","fas fa-hourglass-start","fas fa-house-damage","fas fa-hryvnia","fas fa-i-cursor","fas fa-ice-cream","fas fa-icicles","fas fa-icons","fas fa-id-badge","fas fa-id-card","fas fa-id-card-alt","fas fa-igloo","fas fa-image","fas fa-images","fas fa-inbox","fas fa-indent","fas fa-industry","fas fa-infinity","fas fa-info","fas fa-info-circle","fas fa-italic","fas fa-jedi","fas fa-joint","fas fa-journal-whills","fas fa-kaaba","fas fa-key","fas fa-keyboard","fas fa-khanda","fas fa-kiss","fas fa-kiss-beam","fas fa-kiss-wink-heart","fas fa-kiwi-bird","fas fa-landmark","fas fa-language","fas fa-laptop","fas fa-laptop-code","fas fa-laptop-medical","fas fa-laugh","fas fa-laugh-beam","fas fa-laugh-squint","fas fa-laugh-wink","fas fa-layer-group","fas fa-leaf","fas fa-lemon","fas fa-less-than","fas fa-less-than-equal","fas fa-level-down-alt","fas fa-level-up-alt","fas fa-life-ring","fas fa-lightbulb","fas fa-link","fas fa-lira-sign","fas fa-list","fas fa-list-alt","fas fa-list-ol","fas fa-list-ul","fas fa-location-arrow","fas fa-lock","fas fa-lock-open","fas fa-long-arrow-alt-down","fas fa-long-arrow-alt-left","fas fa-long-arrow-alt-right","fas fa-long-arrow-alt-up","fas fa-low-vision","fas fa-luggage-cart","fas fa-magic","fas fa-magnet","fas fa-mail-bulk","fas fa-male","fas fa-map","fas fa-map-marked","fas fa-map-marked-alt","fas fa-map-marker","fas fa-map-marker-alt","fas fa-map-pin","fas fa-map-signs","fas fa-marker","fas fa-mars","fas fa-mars-double","fas fa-mars-stroke","fas fa-mars-stroke-h","fas fa-mars-stroke-v","fas fa-mask","fas fa-medal","fas fa-medkit","fas fa-meh","fas fa-meh-blank","fas fa-meh-rolling-eyes","fas fa-memory","fas fa-menorah","fas fa-mercury","fas fa-meteor","fas fa-microchip","fas fa-microphone","fas fa-microphone-alt","fas fa-microphone-alt-slash","fas fa-microphone-slash","fas fa-microscope","fas fa-minus","fas fa-minus-circle","fas fa-minus-square","fas fa-mitten","fas fa-mobile","fas fa-mobile-alt","fas fa-money-bill","fas fa-money-bill-alt","fas fa-money-bill-wave","fas fa-money-bill-wave-alt","fas fa-money-check","fas fa-money-check-alt","fas fa-monument","fas fa-moon","fas fa-mortar-pestle","fas fa-mosque","fas fa-motorcycle","fas fa-mountain","fas fa-mouse","fas fa-mouse-pointer","fas fa-mug-hot","fas fa-music","fas fa-network-wired","fas fa-neuter","fas fa-newspaper","fas fa-not-equal","fas fa-notes-medical","fas fa-object-group","fas fa-object-ungroup","fas fa-oil-can","fas fa-om","fas fa-otter","fas fa-outdent","fas fa-pager","fas fa-paint-brush","fas fa-paint-roller","fas fa-palette","fas fa-pallet","fas fa-paper-plane","fas fa-paperclip","fas fa-parachute-box","fas fa-paragraph","fas fa-parking","fas fa-passport","fas fa-pastafarianism","fas fa-paste","fas fa-pause","fas fa-pause-circle","fas fa-paw","fas fa-peace","fas fa-pen","fas fa-pen-alt","fas fa-pen-fancy","fas fa-pen-nib","fas fa-pen-square","fas fa-pencil-alt","fas fa-pencil-ruler","fas fa-people-carry","fas fa-pepper-hot","fas fa-percent","fas fa-percentage","fas fa-person-booth","fas fa-phone","fas fa-phone-alt","fas fa-phone-slash","fas fa-phone-square","fas fa-phone-square-alt","fas fa-phone-volume","fas fa-photo-video","fas fa-piggy-bank","fas fa-pills","fas fa-pizza-slice","fas fa-place-of-worship","fas fa-plane","fas fa-plane-arrival","fas fa-plane-departure","fas fa-play","fas fa-play-circle","fas fa-plug","fas fa-plus","fas fa-plus-circle","fas fa-plus-square","fas fa-podcast","fas fa-poll","fas fa-poll-h","fas fa-poo","fas fa-poo-storm","fas fa-poop","fas fa-portrait","fas fa-pound-sign","fas fa-power-off","fas fa-pray","fas fa-praying-hands","fas fa-prescription","fas fa-prescription-bottle","fas fa-prescription-bottle-alt","fas fa-print","fas fa-procedures","fas fa-project-diagram","fas fa-puzzle-piece","fas fa-qrcode","fas fa-question","fas fa-question-circle","fas fa-quidditch","fas fa-quote-left","fas fa-quote-right","fas fa-quran","fas fa-radiation","fas fa-radiation-alt","fas fa-rainbow","fas fa-random","fas fa-receipt","fas fa-record-vinyl","fas fa-recycle","fas fa-redo","fas fa-redo-alt","fas fa-registered","fas fa-remove-format","fas fa-reply","fas fa-reply-all","fas fa-republican","fas fa-restroom","fas fa-retweet","fas fa-ribbon","fas fa-ring","fas fa-road","fas fa-robot","fas fa-rocket","fas fa-route","fas fa-rss","fas fa-rss-square","fas fa-ruble-sign","fas fa-ruler","fas fa-ruler-combined","fas fa-ruler-horizontal","fas fa-ruler-vertical","fas fa-running","fas fa-rupee-sign","fas fa-sad-cry","fas fa-sad-tear","fas fa-satellite","fas fa-satellite-dish","fas fa-save","fas fa-school","fas fa-screwdriver","fas fa-scroll","fas fa-sd-card","fas fa-search","fas fa-search-dollar","fas fa-search-location","fas fa-search-minus","fas fa-search-plus","fas fa-seedling","fas fa-server","fas fa-shapes","fas fa-share","fas fa-share-alt","fas fa-share-alt-square","fas fa-share-square","fas fa-shekel-sign","fas fa-shield-alt","fas fa-ship","fas fa-shipping-fast","fas fa-shoe-prints","fas fa-shopping-bag","fas fa-shopping-basket","fas fa-shopping-cart","fas fa-shower","fas fa-shuttle-van","fas fa-sign","fas fa-sign-in-alt","fas fa-sign-language","fas fa-sign-out-alt","fas fa-signal","fas fa-signature","fas fa-sim-card","fas fa-sitemap","fas fa-skating","fas fa-skiing","fas fa-skiing-nordic","fas fa-skull","fas fa-skull-crossbones","fas fa-slash","fas fa-sleigh","fas fa-sliders-h","fas fa-smile","fas fa-smile-beam","fas fa-smile-wink","fas fa-smog","fas fa-smoking","fas fa-smoking-ban","fas fa-sms","fas fa-snowboarding","fas fa-snowflake","fas fa-snowman","fas fa-snowplow","fas fa-socks","fas fa-solar-panel","fas fa-sort","fas fa-sort-alpha-down","fas fa-sort-alpha-down-alt","fas fa-sort-alpha-up","fas fa-sort-alpha-up-alt","fas fa-sort-amount-down","fas fa-sort-amount-down-alt","fas fa-sort-amount-up","fas fa-sort-amount-up-alt","fas fa-sort-down","fas fa-sort-numeric-down","fas fa-sort-numeric-down-alt","fas fa-sort-numeric-up","fas fa-sort-numeric-up-alt","fas fa-sort-up","fas fa-spa","fas fa-space-shuttle","fas fa-spell-check","fas fa-spider","fas fa-spinner","fas fa-splotch","fas fa-spray-can","fas fa-square","fas fa-square-full","fas fa-square-root-alt","fas fa-stamp","fas fa-star","fas fa-star-and-crescent","fas fa-star-half","fas fa-star-half-alt","fas fa-star-of-david","fas fa-star-of-life","fas fa-step-backward","fas fa-step-forward","fas fa-stethoscope","fas fa-sticky-note","fas fa-stop","fas fa-stop-circle","fas fa-stopwatch","fas fa-store","fas fa-store-alt","fas fa-stream","fas fa-street-view","fas fa-strikethrough","fas fa-stroopwafel","fas fa-subscript","fas fa-subway","fas fa-suitcase","fas fa-suitcase-rolling","fas fa-sun","fas fa-superscript","fas fa-surprise","fas fa-swatchbook","fas fa-swimmer","fas fa-swimming-pool","fas fa-synagogue","fas fa-sync","fas fa-sync-alt","fas fa-syringe","fas fa-table","fas fa-table-tennis","fas fa-tablet","fas fa-tablet-alt","fas fa-tablets","fas fa-tachometer-alt","fas fa-tag","fas fa-tags","fas fa-tape","fas fa-tasks","fas fa-taxi","fas fa-teeth","fas fa-teeth-open","fas fa-temperature-high","fas fa-temperature-low","fas fa-tenge","fas fa-terminal","fas fa-text-height","fas fa-text-width","fas fa-th","fas fa-th-large","fas fa-th-list","fas fa-theater-masks","fas fa-thermometer","fas fa-thermometer-empty","fas fa-thermometer-full","fas fa-thermometer-half","fas fa-thermometer-quarter","fas fa-thermometer-three-quarters","fas fa-thumbs-down","fas fa-thumbs-up","fas fa-thumbtack","fas fa-ticket-alt","fas fa-times","fas fa-times-circle","fas fa-tint","fas fa-tint-slash","fas fa-tired","fas fa-toggle-off","fas fa-toggle-on","fas fa-toilet","fas fa-toilet-paper","fas fa-toolbox","fas fa-tools","fas fa-tooth","fas fa-torah","fas fa-torii-gate","fas fa-tractor","fas fa-trademark","fas fa-traffic-light","fas fa-train","fas fa-tram","fas fa-transgender","fas fa-transgender-alt","fas fa-trash","fas fa-trash-alt","fas fa-trash-restore","fas fa-trash-restore-alt","fas fa-tree","fas fa-trophy","fas fa-truck","fas fa-truck-loading","fas fa-truck-monster","fas fa-truck-moving","fas fa-truck-pickup","fas fa-tshirt","fas fa-tty","fas fa-tv","fas fa-umbrella","fas fa-umbrella-beach","fas fa-underline","fas fa-undo","fas fa-undo-alt","fas fa-universal-access","fas fa-university","fas fa-unlink","fas fa-unlock","fas fa-unlock-alt","fas fa-upload","fas fa-user","fas fa-user-alt","fas fa-user-alt-slash","fas fa-user-astronaut","fas fa-user-check","fas fa-user-circle","fas fa-user-clock","fas fa-user-cog","fas fa-user-edit","fas fa-user-friends","fas fa-user-graduate","fas fa-user-injured","fas fa-user-lock","fas fa-user-md","fas fa-user-minus","fas fa-user-ninja","fas fa-user-nurse","fas fa-user-plus","fas fa-user-secret","fas fa-user-shield","fas fa-user-slash","fas fa-user-tag","fas fa-user-tie","fas fa-user-times","fas fa-users","fas fa-users-cog","fas fa-utensil-spoon","fas fa-utensils","fas fa-vector-square","fas fa-venus","fas fa-venus-double","fas fa-venus-mars","fas fa-vial","fas fa-vials","fas fa-video","fas fa-video-slash","fas fa-vihara","fas fa-voicemail","fas fa-volleyball-ball","fas fa-volume-down","fas fa-volume-mute","fas fa-volume-off","fas fa-volume-up","fas fa-vote-yea","fas fa-vr-cardboard","fas fa-walking","fas fa-wallet","fas fa-warehouse","fas fa-water","fas fa-wave-square","fas fa-weight","fas fa-weight-hanging","fas fa-wheelchair","fas fa-wifi","fas fa-wind","fas fa-window-close","fas fa-window-maximize","fas fa-window-minimize","fas fa-window-restore","fas fa-wine-bottle","fas fa-wine-glass","fas fa-wine-glass-alt","fas fa-won-sign","fas fa-wrench","fas fa-x-ray","fas fa-yen-sign","fas fa-yin-yang","far fa-address-book","far fa-address-card","far fa-angry","far fa-arrow-alt-circle-down","far fa-arrow-alt-circle-left","far fa-arrow-alt-circle-right","far fa-arrow-alt-circle-up","far fa-bell","far fa-bell-slash","far fa-bookmark","far fa-building","far fa-calendar","far fa-calendar-alt","far fa-calendar-check","far fa-calendar-minus","far fa-calendar-plus","far fa-calendar-times","far fa-caret-square-down","far fa-caret-square-left","far fa-caret-square-right","far fa-caret-square-up","far fa-chart-bar","far fa-check-circle","far fa-check-square","far fa-circle","far fa-clipboard","far fa-clock","far fa-clone","far fa-closed-captioning","far fa-comment","far fa-comment-alt","far fa-comment-dots","far fa-comments","far fa-compass","far fa-copy","far fa-copyright","far fa-credit-card","far fa-dizzy","far fa-dot-circle","far fa-edit","far fa-envelope","far fa-envelope-open","far fa-eye","far fa-eye-slash","far fa-file","far fa-file-alt","far fa-file-archive","far fa-file-audio","far fa-file-code","far fa-file-excel","far fa-file-image","far fa-file-pdf","far fa-file-powerpoint","far fa-file-video","far fa-file-word","far fa-flag","far fa-flushed","far fa-folder","far fa-folder-open","far fa-frown","far fa-frown-open","far fa-futbol","far fa-gem","far fa-grimace","far fa-grin","far fa-grin-alt","far fa-grin-beam","far fa-grin-beam-sweat","far fa-grin-hearts","far fa-grin-squint","far fa-grin-squint-tears","far fa-grin-stars","far fa-grin-tears","far fa-grin-tongue","far fa-grin-tongue-squint","far fa-grin-tongue-wink","far fa-grin-wink","far fa-hand-lizard","far fa-hand-paper","far fa-hand-peace","far fa-hand-point-down","far fa-hand-point-left","far fa-hand-point-right","far fa-hand-point-up","far fa-hand-pointer","far fa-hand-rock","far fa-hand-scissors","far fa-hand-spock","far fa-handshake","far fa-hdd","far fa-heart","far fa-hospital","far fa-hourglass","far fa-id-badge","far fa-id-card","far fa-image","far fa-images","far fa-keyboard","far fa-kiss","far fa-kiss-beam","far fa-kiss-wink-heart","far fa-laugh","far fa-laugh-beam","far fa-laugh-squint","far fa-laugh-wink","far fa-lemon","far fa-life-ring","far fa-lightbulb","far fa-list-alt","far fa-map","far fa-meh","far fa-meh-blank","far fa-meh-rolling-eyes","far fa-minus-square","far fa-money-bill-alt","far fa-moon","far fa-newspaper","far fa-object-group","far fa-object-ungroup","far fa-paper-plane","far fa-pause-circle","far fa-play-circle","far fa-plus-square","far fa-question-circle","far fa-registered","far fa-sad-cry","far fa-sad-tear","far fa-save","far fa-share-square","far fa-smile","far fa-smile-beam","far fa-smile-wink","far fa-snowflake","far fa-square","far fa-star","far fa-star-half","far fa-sticky-note","far fa-stop-circle","far fa-sun","far fa-surprise","far fa-thumbs-down","far fa-thumbs-up","far fa-times-circle","far fa-tired","far fa-trash-alt","far fa-user","far fa-user-circle","far fa-window-close","far fa-window-maximize","far fa-window-minimize","far fa-window-restore","fab fa-500px","fab fa-accessible-icon","fab fa-accusoft","fab fa-acquisitions-incorporated","fab fa-adn","fab fa-adobe","fab fa-adversal","fab fa-affiliatetheme","fab fa-airbnb","fab fa-algolia","fab fa-alipay","fab fa-amazon","fab fa-amazon-pay","fab fa-amilia","fab fa-android","fab fa-angellist","fab fa-angrycreative","fab fa-angular","fab fa-app-store","fab fa-app-store-ios","fab fa-apper","fab fa-apple","fab fa-apple-pay","fab fa-artstation","fab fa-asymmetrik","fab fa-atlassian","fab fa-audible","fab fa-autoprefixer","fab fa-avianex","fab fa-aviato","fab fa-aws","fab fa-bandcamp","fab fa-battle-net","fab fa-behance","fab fa-behance-square","fab fa-bimobject","fab fa-bitbucket","fab fa-bitcoin","fab fa-bity","fab fa-black-tie","fab fa-blackberry","fab fa-blogger","fab fa-blogger-b","fab fa-bluetooth","fab fa-bluetooth-b","fab fa-bootstrap","fab fa-btc","fab fa-buffer","fab fa-buromobelexperte","fab fa-buy-n-large","fab fa-buysellads","fab fa-canadian-maple-leaf","fab fa-cc-amazon-pay","fab fa-cc-amex","fab fa-cc-apple-pay","fab fa-cc-diners-club","fab fa-cc-discover","fab fa-cc-jcb","fab fa-cc-mastercard","fab fa-cc-paypal","fab fa-cc-stripe","fab fa-cc-visa","fab fa-centercode","fab fa-centos","fab fa-chrome","fab fa-chromecast","fab fa-cloudscale","fab fa-cloudsmith","fab fa-cloudversify","fab fa-codepen","fab fa-codiepie","fab fa-confluence","fab fa-connectdevelop","fab fa-contao","fab fa-cotton-bureau","fab fa-cpanel","fab fa-creative-commons","fab fa-creative-commons-by","fab fa-creative-commons-nc","fab fa-creative-commons-nc-eu","fab fa-creative-commons-nc-jp","fab fa-creative-commons-nd","fab fa-creative-commons-pd","fab fa-creative-commons-pd-alt","fab fa-creative-commons-remix","fab fa-creative-commons-sa","fab fa-creative-commons-sampling","fab fa-creative-commons-sampling-plus","fab fa-creative-commons-share","fab fa-creative-commons-zero","fab fa-critical-role","fab fa-css3","fab fa-css3-alt","fab fa-cuttlefish","fab fa-d-and-d","fab fa-d-and-d-beyond","fab fa-dashcube","fab fa-delicious","fab fa-deploydog","fab fa-deskpro","fab fa-dev","fab fa-deviantart","fab fa-dhl","fab fa-diaspora","fab fa-digg","fab fa-digital-ocean","fab fa-discord","fab fa-discourse","fab fa-dochub","fab fa-docker","fab fa-draft2digital","fab fa-dribbble","fab fa-dribbble-square","fab fa-dropbox","fab fa-drupal","fab fa-dyalog","fab fa-earlybirds","fab fa-ebay","fab fa-edge","fab fa-elementor","fab fa-ello","fab fa-ember","fab fa-empire","fab fa-envira","fab fa-erlang","fab fa-ethereum","fab fa-etsy","fab fa-evernote","fab fa-expeditedssl","fab fa-facebook","fab fa-facebook-f","fab fa-facebook-messenger","fab fa-facebook-square","fab fa-fantasy-flight-games","fab fa-fedex","fab fa-fedora","fab fa-figma","fab fa-firefox","fab fa-first-order","fab fa-first-order-alt","fab fa-firstdraft","fab fa-flickr","fab fa-flipboard","fab fa-fly","fab fa-font-awesome","fab fa-font-awesome-alt","fab fa-font-awesome-flag","fab fa-fonticons","fab fa-fonticons-fi","fab fa-fort-awesome","fab fa-fort-awesome-alt","fab fa-forumbee","fab fa-foursquare","fab fa-free-code-camp","fab fa-freebsd","fab fa-fulcrum","fab fa-galactic-republic","fab fa-galactic-senate","fab fa-get-pocket","fab fa-gg","fab fa-gg-circle","fab fa-git","fab fa-git-alt","fab fa-git-square","fab fa-github","fab fa-github-alt","fab fa-github-square","fab fa-gitkraken","fab fa-gitlab","fab fa-gitter","fab fa-glide","fab fa-glide-g","fab fa-gofore","fab fa-goodreads","fab fa-goodreads-g","fab fa-google","fab fa-google-drive","fab fa-google-play","fab fa-google-plus","fab fa-google-plus-g","fab fa-google-plus-square","fab fa-google-wallet","fab fa-gratipay","fab fa-grav","fab fa-gripfire","fab fa-grunt","fab fa-gulp","fab fa-hacker-news","fab fa-hacker-news-square","fab fa-hackerrank","fab fa-hips","fab fa-hire-a-helper","fab fa-hooli","fab fa-hornbill","fab fa-hotjar","fab fa-houzz","fab fa-html5","fab fa-hubspot","fab fa-imdb","fab fa-instagram","fab fa-intercom","fab fa-internet-explorer","fab fa-invision","fab fa-ioxhost","fab fa-itch-io","fab fa-itunes","fab fa-itunes-note","fab fa-java","fab fa-jedi-order","fab fa-jenkins","fab fa-jira","fab fa-joget","fab fa-joomla","fab fa-js","fab fa-js-square","fab fa-jsfiddle","fab fa-kaggle","fab fa-keybase","fab fa-keycdn","fab fa-kickstarter","fab fa-kickstarter-k","fab fa-korvue","fab fa-laravel","fab fa-lastfm","fab fa-lastfm-square","fab fa-leanpub","fab fa-less","fab fa-line","fab fa-linkedin","fab fa-linkedin-in","fab fa-linode","fab fa-linux","fab fa-lyft","fab fa-magento","fab fa-mailchimp","fab fa-mandalorian","fab fa-markdown","fab fa-mastodon","fab fa-maxcdn","fab fa-mdb","fab fa-medapps","fab fa-medium","fab fa-medium-m","fab fa-medrt","fab fa-meetup","fab fa-megaport","fab fa-mendeley","fab fa-microsoft","fab fa-mix","fab fa-mixcloud","fab fa-mizuni","fab fa-modx","fab fa-monero","fab fa-napster","fab fa-neos","fab fa-nimblr","fab fa-node","fab fa-node-js","fab fa-npm","fab fa-ns8","fab fa-nutritionix","fab fa-odnoklassniki","fab fa-odnoklassniki-square","fab fa-old-republic","fab fa-opencart","fab fa-openid","fab fa-opera","fab fa-optin-monster","fab fa-orcid","fab fa-osi","fab fa-page4","fab fa-pagelines","fab fa-palfed","fab fa-patreon","fab fa-paypal","fab fa-penny-arcade","fab fa-periscope","fab fa-phabricator","fab fa-phoenix-framework","fab fa-phoenix-squadron","fab fa-php","fab fa-pied-piper","fab fa-pied-piper-alt","fab fa-pied-piper-hat","fab fa-pied-piper-pp","fab fa-pinterest","fab fa-pinterest-p","fab fa-pinterest-square","fab fa-playstation","fab fa-product-hunt","fab fa-pushed","fab fa-python","fab fa-qq","fab fa-quinscape","fab fa-quora","fab fa-r-project","fab fa-raspberry-pi","fab fa-ravelry","fab fa-react","fab fa-reacteurope","fab fa-readme","fab fa-rebel","fab fa-red-river","fab fa-reddit","fab fa-reddit-alien","fab fa-reddit-square","fab fa-redhat","fab fa-renren","fab fa-replyd","fab fa-researchgate","fab fa-resolving","fab fa-rev","fab fa-rocketchat","fab fa-rockrms","fab fa-safari","fab fa-salesforce","fab fa-sass","fab fa-schlix","fab fa-scribd","fab fa-searchengin","fab fa-sellcast","fab fa-sellsy","fab fa-servicestack","fab fa-shirtsinbulk","fab fa-shopware","fab fa-simplybuilt","fab fa-sistrix","fab fa-sith","fab fa-sketch","fab fa-skyatlas","fab fa-skype","fab fa-slack","fab fa-slack-hash","fab fa-slideshare","fab fa-snapchat","fab fa-snapchat-ghost","fab fa-snapchat-square","fab fa-soundcloud","fab fa-sourcetree","fab fa-speakap","fab fa-speaker-deck","fab fa-spotify","fab fa-squarespace","fab fa-stack-exchange","fab fa-stack-overflow","fab fa-stackpath","fab fa-staylinked","fab fa-steam","fab fa-steam-square","fab fa-steam-symbol","fab fa-sticker-mule","fab fa-strava","fab fa-stripe","fab fa-stripe-s","fab fa-studiovinari","fab fa-stumbleupon","fab fa-stumbleupon-circle","fab fa-superpowers","fab fa-supple","fab fa-suse","fab fa-swift","fab fa-symfony","fab fa-teamspeak","fab fa-telegram","fab fa-telegram-plane","fab fa-tencent-weibo","fab fa-the-red-yeti","fab fa-themeco","fab fa-themeisle","fab fa-think-peaks","fab fa-trade-federation","fab fa-trello","fab fa-tripadvisor","fab fa-tumblr","fab fa-tumblr-square","fab fa-twitch","fab fa-twitter","fab fa-twitter-square","fab fa-typo3","fab fa-uber","fab fa-ubuntu","fab fa-uikit","fab fa-umbraco","fab fa-uniregistry","fab fa-untappd","fab fa-ups","fab fa-usb","fab fa-usps","fab fa-ussunnah","fab fa-vaadin","fab fa-viacoin","fab fa-viadeo","fab fa-viadeo-square","fab fa-viber","fab fa-vimeo","fab fa-vimeo-square","fab fa-vimeo-v","fab fa-vine","fab fa-vk","fab fa-vnv","fab fa-vuejs","fab fa-waze","fab fa-weebly","fab fa-weibo","fab fa-weixin","fab fa-whatsapp","fab fa-whatsapp-square","fab fa-whmcs","fab fa-wikipedia-w","fab fa-windows","fab fa-wix","fab fa-wizards-of-the-coast","fab fa-wolf-pack-battalion","fab fa-wordpress","fab fa-wordpress-simple","fab fa-wpbeginner","fab fa-wpexplorer","fab fa-wpforms","fab fa-wpressr","fab fa-xbox","fab fa-xing","fab fa-xing-square","fab fa-y-combinator","fab fa-yahoo","fab fa-yammer","fab fa-yandex","fab fa-yandex-international","fab fa-yarn","fab fa-yelp","fab fa-yoast","fab fa-youtube","fab fa-youtube-square","fab fa-zhihu");
	}
}

function attesa_get_font_awesome_general() {
	if (attesa_options('_choose_icon_pack', 'font_awesome_four') == 'font_awesome_four') {
		return attesa_font_awesome_icon_array_general();
	} else {
		return attesa_font_awesome_5_icon_array_general();
	}
}

function attesa_get_font_awesome_cart() {
	if (attesa_options('_choose_icon_pack', 'font_awesome_four') == 'font_awesome_four') {
		return attesa_font_awesome_icon_array_cart();
	} else {
		return attesa_font_awesome_5_icon_array_cart();
	}
}

function attesa_get_font_awesome_scrolltop() {
	if (attesa_options('_choose_icon_pack', 'font_awesome_four') == 'font_awesome_four') {
		return attesa_font_awesome_icon_array_scrolltop();
	} else {
		return attesa_font_awesome_5_icon_array_scrolltop();
	}
}

/**
 * Function to check where to show the classic sidebar
 */
if( ! function_exists('attesa_check_bar')){
	function attesa_check_bar($position){
		$attesa_check_return = false;
		if ($position == 'classic') {
			$whereToShow = attesa_options('_classicsidebar_show', 'entire_website,post');
		} elseif ($position == 'footer') {
			$whereToShow = attesa_options('_footerwidgets_show', 'entire_website,post');
		} else {
			$whereToShow = attesa_options('_pushsidebar_show', 'entire_website,post');
		}
		if (!is_array($whereToShow)) {
			$whereToShowEx = explode (',',$whereToShow );
		} else {
			$whereToShowEx = $whereToShow;
		}
		if (in_array( 'entire_website', $whereToShowEx ) ) {
			$attesa_check_return = true;
		} else {
			if ( is_singular() && ! is_front_page() && in_array( get_post_type(), $whereToShowEx ) ) {
				$attesa_check_return = true;
			} elseif ( is_tax() && in_array( get_queried_object()->taxonomy, $whereToShowEx ) ) {
				$attesa_check_return = true;
			} elseif ( is_category() && in_array( get_queried_object()->taxonomy, $whereToShowEx ) ) {
				$attesa_check_return = true;
			} elseif ( is_tag() && in_array( get_queried_object()->taxonomy, $whereToShowEx ) ) {
				$attesa_check_return = true;
			} elseif (is_author() && in_array( 'author_page', $whereToShowEx ) ) {
				$attesa_check_return = true;
			} elseif (is_date() && in_array( 'date_page', $whereToShowEx ) ) {
				$attesa_check_return = true;
			} elseif (is_search() && in_array( 'search_page', $whereToShowEx ) ) {
				$attesa_check_return = true;
			} elseif (is_404() && in_array( 'notfound_page', $whereToShowEx ) ) {
				$attesa_check_return = true;
			} elseif (is_home() && in_array( 'blog_page', $whereToShowEx ) ) {
				$attesa_check_return = true;
			} elseif (is_front_page() && in_array( 'home_page', $whereToShowEx ) ) {
				$attesa_check_return = true;
			}
			/* Check if "WooCommerce" plugin is active */
			if (function_exists( 'is_woocommerce' ) ) {
				if (is_shop() && in_array( 'woocommerce_shop', $whereToShowEx ) ) {
					$attesa_check_return = true;
				}
			}
		}
		return apply_filters( 'attesa_check_return_filter', $attesa_check_return, $position );
	}
}

/**
 * Function to minify CSS code
 */
if ( ! function_exists( 'attesa_minify_css' ) ) {
	function attesa_minify_css( $css = '' ) {
		if ( ! $css ) return;
		$css = preg_replace( '/\s+/', ' ', $css );
		$css = preg_replace( '/;(?=\s*})/', '', $css );
		$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
		$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
		$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
		$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
		$css = trim( $css );
		return $css;
	}
}

/**
 * Action for Attesa Footer Credits
 */
function attesa_footer_credits_print() {
	?>
	<span class="sep"> | </span>
	<?php
	/* translators: 1: Theme name, 2: Theme author. */
	printf( esc_html__( 'WordPress Theme: %1$s by %2$s', 'attesa' ), '<a target="_blank" href="https://attesawp.com/" rel="nofollow" title="Attesa WordPress Theme">Attesa</a>', 'AttesaWP.com' );
}
add_action('attesa_footer_credits','attesa_footer_credits_print');

/* Get the correct classic sidebar */
if ( ! function_exists( 'attesa_get_classic_sidebar' ) ) {
	function attesa_get_classic_sidebar() {
		return apply_filters( 'attesa_filter_get_classic_sidebar', 'sidebar-1' );
	}
}

/* Get the correct push sidebar */
if ( ! function_exists( 'attesa_get_push_sidebar' ) ) {
	function attesa_get_push_sidebar() {
		return apply_filters( 'attesa_filter_get_push_sidebar', 'sidebar-push' );
	}
}

/* Get the posts navigation */
add_action('attesa_posts_navigation', 'attesa_get_posts_navigation');
function attesa_get_posts_navigation() {
	the_posts_pagination( array(
		'prev_text'          => '<i class="'. esc_attr(attesa_get_fontawesome_icons('nav_prefix')) .' fa-angle-double-left spaceRight" aria-hidden="true"></i>' . esc_html__( 'Previous', 'attesa' ),
		'next_text'          => esc_html__( 'Next', 'attesa' ) . '<i class="'. esc_attr(attesa_get_fontawesome_icons('nav_prefix')) .' fa-angle-double-right spaceLeft" aria-hidden="true"></i>',
	) );
}

/* Get FontAwesome Icons based on version */
if ( ! function_exists( 'attesa_get_fontawesome_icons' ) ) {
	function attesa_get_fontawesome_icons($icon) {
		$iconPack = attesa_options('_choose_icon_pack', 'font_awesome_four');
		if ($iconPack == 'font_awesome_four') {
			if ('calendar' == $icon) {
				$current_icon = 'fa fa-calendar-o';
			} elseif ('user' == $icon) {
				$current_icon = 'fa fa-user';
			} elseif ('comments' == $icon) {
				$current_icon = 'fa fa-comments-o';
			} elseif ('categories' == $icon) {
				$current_icon = 'fa fa-folder-open';
			} elseif ('tags' == $icon) {
				$current_icon = 'fa fa-tags';
			} elseif ('edit' == $icon) {
				$current_icon = 'fa fa-wrench';
			} elseif ('social_prefix' == $icon) {
				$current_icon = 'fa';
			} elseif ('nav_prefix' == $icon) {
				$current_icon = 'fa';
			} elseif ('read_more' == $icon) {
				$current_icon = 'fa fa-caret-right';
			} elseif ('general_prefix' == $icon) {
				$current_icon = 'fa';
			} elseif ('close' == $icon) {
				$current_icon = 'fa fa-times-circle-o';
			} elseif ('clock' == $icon) {
				$current_icon = 'fa fa-clock-o';
			} elseif ('star' == $icon) {
				$current_icon = 'fa fa-star-o';
			} elseif ('circle' == $icon) {
				$current_icon = 'fa fa-circle-o-notch';
			} elseif ('facebook_messenger' == $icon) {
				$current_icon = 'fa fa-facebook';
			}
		} else {
			if ('calendar' == $icon) {
				$current_icon = 'far fa-calendar';
			} elseif ('user' == $icon) {
				$current_icon = 'fas fa-user';
			} elseif ('comments' == $icon) {
				$current_icon = 'far fa-comments';
			} elseif ('categories' == $icon) {
				$current_icon = 'fas fa-folder-open';
			} elseif ('tags' == $icon) {
				$current_icon = 'fas fa-tags';
			} elseif ('edit' == $icon) {
				$current_icon = 'fas fa-wrench';
			} elseif ('social_prefix' == $icon) {
				$current_icon = 'fab';
			} elseif ('nav_prefix' == $icon) {
				$current_icon = 'fas';
			} elseif ('read_more' == $icon) {
				$current_icon = 'fas fa-caret-right';
			} elseif ('general_prefix' == $icon) {
				$current_icon = 'fas';
			} elseif ('close' == $icon) {
				$current_icon = 'far fa-times-circle';
			} elseif ('clock' == $icon) {
				$current_icon = 'far fa-clock';
			} elseif ('star' == $icon) {
				$current_icon = 'far fa-star';
			} elseif ('circle' == $icon) {
				$current_icon = 'fas fa-circle-notch';
			} elseif ('facebook_messenger' == $icon) {
				$current_icon = 'fab fa-facebook-messenger';
			}
		}
		return apply_filters( 'attesa_fontawesome_icons_filter', $current_icon );
	}
}

/* Output of the FontAwesome Icons */
if ( ! function_exists( 'attesa_fontawesome_icons' ) ) {
	function attesa_fontawesome_icons( $icon ) {
		echo esc_attr(attesa_get_fontawesome_icons( $icon ));
	}
}

/* Get the scherma markup if active */
if ( ! function_exists( 'attesa_get_schema_markup' ) ) {
	function attesa_get_schema_markup($position) {
		if ( ! attesa_options('_schema_markup', '') ) {
			return null;
		}
		if ('body' == $position) {
			if ( is_singular() ) {
				$markup = 'itemscope itemtype="http://schema.org/WebPage"';
			} else {
				$markup = 'itemscope itemtype="http://schema.org/Article"';
			}
		}
		elseif ( 'header' == $position ) {
			$markup = 'itemscope="itemscope" itemtype="http://schema.org/WPHeader"';
		}
		elseif ( 'sidebar' == $position ) {
			$markup = 'itemscope="itemscope" itemtype="http://schema.org/WPSideBar"';
		}
		elseif ( 'footer' == $position ) {
			$markup = 'itemscope="itemscope" itemtype="http://schema.org/WPFooter"';
		}
		elseif ( 'site-title' == $position ) {
			$markup = 'itemscope itemtype="http://schema.org/WebSite"';
		}
		elseif ( 'main' == $position ) {
			$itemtype = 'http://schema.org/WebPageElement';
			$itemprop = 'mainContentOfPage';
			if ( is_singular( 'post' ) ) {
				$itemprop = '';
				$itemtype = 'http://schema.org/Blog';
			}
			$markup = $itemprop .' itemtype="'.$itemtype.'"';
		}
		elseif ( 'headline' == $position ) {
			$markup = 'itemprop="headline"';
		}
		elseif ( 'author' == $position ) {
			$markup = 'itemprop="author"';
		}
		elseif ( 'data-pub' == $position ) {
			$markup = 'itemprop="datePublished"';
		}
		elseif ( 'name' == $position ) {
			$markup = 'itemprop="name"';
		}
		elseif ( 'text' == $position ) {
			$markup = 'itemprop="text"';
		}
		elseif ( 'url' == $position ) {
			$markup = 'itemprop="url"';
		}
		elseif ( 'site-navigation' == $position ) {
			$markup = 'itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement"';
		}
		elseif ( 'portfolio-main' == $position ) {
			$markup = 'itemscope itemtype="http://schema.org/ImageGallery"';
		}
		elseif ( 'portfolio-single' == $position ) {
			$markup = 'itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"';
		}
		elseif ( 'portfolio-content-url' == $position ) {
			$markup = 'itemprop="contentUrl"';
		}
		return apply_filters( 'attesa_schema_markup_filter', $markup );
	}
}

/* Output of the schema marktup */
if ( ! function_exists( 'attesa_schema_markup' ) ) {
	function attesa_schema_markup( $position ) {
		echo attesa_get_schema_markup( $position ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
/* Output of Yoast breadcrumb */
function attesa_the_breadcrumb() {
	if ( function_exists('yoast_breadcrumb') && attesa_check_for_breadcrumb() ) {
		yoast_breadcrumb( '<p id="breadcrumbs" class="attesa-breadcrumbs smallText">','</p>' );
	}
	if (function_exists('rank_math_the_breadcrumbs') && attesa_check_for_breadcrumb() ) {
		rank_math_the_breadcrumbs();
	}
}

/* Check for the breadcrumb */
function attesa_check_for_breadcrumb() {
	return apply_filters( 'attesa_the_breadcrumb_filter', true );
}