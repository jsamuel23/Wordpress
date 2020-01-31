<?php
/**
 * Attesa support for WooCommerce
 *
 * @package AttesaWP
 */
if ( ! class_exists( 'Attesa_WooCommerce' ) ) {

	class Attesa_WooCommerce {
		/**
		 * Main Class Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array($this, 'attesa_woocommerce_scripts') );
			add_action( 'after_setup_theme', array($this, 'attesa_woocommerce_support') );
			add_filter( 'woocommerce_add_to_cart_fragments', array($this, 'attesa_cart_count_fragments'), 10, 1 );
			add_filter( 'woocommerce_output_related_products_args', array($this, 'attesa_related_products_args') );
			add_action( 'woocommerce_single_product_summary', array($this, 'attesa_prev_next_product'), 6 );
			add_action( 'wp_footer', array($this, 'attesa_woocommerce_sticky_bar') );
			add_action( 'init', array($this, 'attesa_woocommerce_related_products') );
		}
		
		/* Dequeue default WooCommerce Layout */
		public static function attesa_woocommerce_scripts() {
			wp_dequeue_style ( 'woocommerce-layout' );
			wp_dequeue_style ( 'woocommerce-smallscreen' );
			wp_dequeue_style ( 'woocommerce-general' );
		}
		
		/* Add WooCommerce Theme Support */
		public static function attesa_woocommerce_support() {
			$wooCommerceStyle = attesa_options('_woocommerce_gallery_style', 'defaultgallery');
			$wooCommerceLightbox = attesa_options('_woocommerce_default_lightbox', '1');
			if ($wooCommerceStyle == 'zoomgallery') {
				add_theme_support( 'wc-product-gallery-zoom' );
				add_theme_support( 'wc-product-gallery-slider' );
			} else {
				remove_theme_support( 'wc-product-gallery-zoom' );
				remove_theme_support( 'wc-product-gallery-slider' );
			}
			if ($wooCommerceLightbox) {
				add_theme_support( 'wc-product-gallery-lightbox' );
			} else {
				remove_theme_support( 'wc-product-gallery-lightbox' );
			}
		}
		
		/* Show or remove WooCommerce relaterd products */
		public static function attesa_woocommerce_related_products() {
			if (!attesa_options('_woocommerce_show_related', '1')) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}
		}
		
		/* Add menu cart item to the Woo fragments so it updates with AJAX */
		public static function attesa_cart_count_fragments( $fragments ) {
			$fragments['span.shopping-count'] = '<span class="shopping-count">' . WC()->cart->get_cart_contents_count() . '</span>';
			return $fragments;
		}
		
		/* Manage the numbering of related products */
		public static function attesa_related_products_args( $args ) {
			$args['posts_per_page'] = wc_get_default_products_per_row();
			$args['columns'] = wc_get_default_products_per_row();
			return $args;
		}
		
		/* WooCommerce previous and next products */
		public static function attesa_prev_next_product(){
			if (attesa_options('_woocommerce_prevnext_product', '1')) {
				$prev_post = get_previous_post();
				$next_post = get_next_post();
				echo '<div class="prev_next_buttons">';
					if (!empty( $prev_post )): ?>
						<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
							<span class="attesa-prevnext"><i class="fa fas fa-angle-left" aria-hidden="true"></i></span>
							<div class="attesa-prevnext-container">
								<?php if (has_post_thumbnail()) : ?>
									<span class="attesa-prevnext-img"><?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ); ?></span>
								<?php endif; ?>
							</div>
						</a>
					<?php endif;
					if (!empty( $next_post )): ?>
						<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
							<span class="attesa-prevnext"><i class="fa fas fa-angle-right" aria-hidden="true"></i></span>
							<div class="attesa-prevnext-container">
								<?php if (has_post_thumbnail()) : ?>
									<span class="attesa-prevnext-img"><?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?></span>
								<?php endif; ?>
							</div>
						</a>
					<?php endif;
				echo '</div>';
			}
		}
		
		/* Sticky bar for single products WooCommerce */
		public static function attesa_woocommerce_sticky_bar() {
			if (attesa_options('_woocommerce_stickybar', '1') && is_product()) {
				global $product;
				$StickyBarText = attesa_options('_woocommerce_stickybar_text', __( 'View Product', 'attesa' ));
				?>
				<div class="attesa-woocommerce-sticky-product slideOutDown">
					<div class="container">
						<div class="attesa-sticky-first">
							<?php if (has_post_thumbnail($product->get_id())) : ?>
								<div class="attesa-sticky-image"><?php echo get_the_post_thumbnail( $product->get_id(), 'woocommerce_thumbnail' ); ?></div>
							<?php endif; ?>
							<div class="attesa-sticky-details">
								<span class="attesa-sticky-title"><?php echo esc_html($product->get_name()); ?></span>
								<p class="attesa-sticky-price smallText"><?php echo wp_kses_post($product->get_price_html()); ?></p>
							</div>
						</div>
						<div class="attesa-sticky-second smallText">
							<?php if($StickyBarText || is_customize_preview()): ?>
								<div class="attesa-sticky-button"><?php echo esc_html($StickyBarText); ?></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php
			}
		}
	}
}
new Attesa_WooCommerce();