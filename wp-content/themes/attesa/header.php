<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Attesa
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php attesa_schema_markup('body'); ?>>
<?php 
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}
?>
<?php if(attesa_options('_show_loader', '') == 1 ) : ?>
	<div class="attesaLoader">
		<?php echo wp_kses(attesa_loadingPage(), attesa_allowed_html()); ?>
	</div>
<?php endif; ?>
<div class="attesa-site-wrap">
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'attesa' ); ?></a>
		<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) : ?>
			<?php $attesa_stickyHeader = apply_filters( 'attesa_sticky_header_scroll', attesa_options('_sticky_header', '1') );
			$attesa_stickyHeaderMobile = apply_filters( 'attesa_sticky_header_scroll_mobile', attesa_options('_sticky_header_mobile', '') );
			$attesa_topBarScroll = apply_filters( 'attesa_choose_top_nav', attesa_options('_topbar_scroll', 'hide') );
			$attesa_showTopBarMobile = apply_filters( 'attesa_show_top_bar_mobile', attesa_options('_show_topbar_mobile', '1') ); ?>
			<header id="masthead" class="site-header topbarscroll<?php echo esc_attr($attesa_topBarScroll); ?> <?php echo $attesa_stickyHeader ? 'withSticky' : 'noSticky' ?> <?php echo $attesa_stickyHeaderMobile ? 'yesMobile' : 'nonMobile' ?> <?php echo $attesa_showTopBarMobile ? 'inMobile' : 'noMobile' ?>" <?php attesa_schema_markup('header'); ?>>
				
				<?php do_action( 'attesa_top_bar' ); ?>
					
				<?php do_action( 'attesa_header' ); ?>
					
			</header><!-- #masthead -->
		<?php endif; ?>
		
		<?php do_action( 'attesa_big_featured_image_style' ); ?>
		
		<div id="content" class="site-content">
		<?php do_action('attesa_before_site_content'); ?>
		<?php attesa_the_breadcrumb(); ?>
		<div class="attesa-content-container">
