<?php
/* Functions for composing the header */

/* Create the top nav */
add_action('attesa_top_bar', 'attesa_get_top_bar');
function attesa_get_top_bar() {
	$showTopBar = apply_filters( 'attesa_show_top_bar', attesa_options('_show_topbar', '1') );
	if ($showTopBar) :
		$showInTopNav = attesa_options('_social_top', '');
		$showWooCartButton = attesa_options('_show_woocart', '');
		$showEddCartButton = attesa_options('_show_eddcart', '');
		$showSearchButton = attesa_options('_show_search', '1');
		$showTopBarMenu = attesa_options('_show_topbar_menu', '1');
		$invertPosition = attesa_options('_topbar_invert', '');
		?>
		<div class="nav-top">
			<?php $topBarStyle = apply_filters( 'attesa_topbar_style', attesa_options('_topbar_style', 'boxed') ); ?>
			<div class="container smallText <?php echo esc_attr($topBarStyle); ?>">
				<div class="top-block-left <?php echo $invertPosition ? 'invert' : ''; ?>">
					<?php
					$phoneNumber = attesa_options('_phone_number', '');
					if($phoneNumber || is_customize_preview()): 
						$phoneNumberLink = attesa_options('_phone_number_link', ''); ?>
						<?php if($phoneNumberLink) : ?>
							<?php $numberLink = filter_var($phoneNumber, FILTER_SANITIZE_NUMBER_INT); ?>
							<span class="top-phone">
								<i class="<?php attesa_fontawesome_icons('general_prefix'); ?> fa-phone spaceRight" aria-hidden="true"></i><span class="attesa-number"><a href="tel:<?php echo esc_attr($numberLink); ?>"><?php echo esc_html($phoneNumber); ?></a></span>
							</span>
						<?php else: ?>
							<span class="top-phone">
								<i class="<?php attesa_fontawesome_icons('general_prefix'); ?> fa-phone spaceRight" aria-hidden="true"></i><span class="attesa-number"><?php echo esc_html($phoneNumber); ?></span>
							</span>
						<?php endif; ?>
					<?php endif; ?>
					<?php
					$emailAddress = attesa_options('_email_address', '');
					if(is_email($emailAddress) || is_customize_preview()):
						$emailAddressLink = attesa_options('_email_address_link', ''); ?>
						<?php if($emailAddressLink) : ?>
							<span class="top-email">
								<i class="<?php attesa_fontawesome_icons('general_prefix'); ?> fa-envelope spaceRight" aria-hidden="true"></i><span class="attesa-email"><a href="mailto:<?php echo esc_html(antispambot($emailAddress)); ?>"><?php echo esc_html(antispambot($emailAddress)); ?></a></span>
							</span>
						<?php else: ?>
							<span class="top-email">
								<i class="<?php attesa_fontawesome_icons('general_prefix'); ?> fa-envelope spaceRight" aria-hidden="true"></i><span class="attesa-email"><?php echo esc_html(antispambot($emailAddress)); ?></span>
							</span>
						<?php endif; ?>
					<?php endif; ?>
					<?php
					$customField = attesa_options('_custom_field', '');
					if($customField || is_customize_preview()):
					$customFieldIcon = attesa_options('_customfield_icon', 'fa fa-bell');
					?>
						<span class="top-custom">
							<i class="<?php echo esc_attr($customFieldIcon); ?> spaceRight" aria-hidden="true"></i><span class="attesa-custom"><?php echo do_shortcode(wp_kses_post( $customField )); ?></span>
						</span>
					<?php endif; ?>
					<?php 
						if ($showInTopNav == 1) {
							echo attesa_show_social_network('top'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
					?>
				</div>
				<div class="top-block-right <?php echo $invertPosition ? 'invert' : ''; ?>">
					<?php if ($showSearchButton) : ?>
					<!-- Start: Search Icon and Form -->
					<div class="search-icon">
					  <span class="circle"></span>
					  <span class="handle"></span>
					</div>
					<div class="search-container">
						<?php get_search_form(); ?>
					</div>
					<!-- End: Search Icon and Form -->
					<?php endif; ?>
					<?php
					if ($showWooCartButton && function_exists( 'is_woocommerce' )) : ?>
					<div class="cartwoo-button">
						<a class="woo-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>">
							<div class="cart-handle">
								<div class="cart-body">
									<i class="<?php echo esc_attr(attesa_options('_woocommercecart_icon', 'fa fa-shopping-cart')); ?>" aria-hidden="true"></i>
									<span class="cart-items"><span class="shopping-count">
										<?php if(WC()->cart->get_cart_contents_count() != 0){ echo intval(WC()->cart->get_cart_contents_count()); } ?>
									</span></span>
								</div>
							</div>
						</a>
						<div class="attesa_woocommerce_mini_cart">
							<div class="widget_shopping_cart_content">
								<?php woocommerce_mini_cart(); ?>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<?php if($showEddCartButton && function_exists( 'EDD' )) : ?>
					<div class="cartedd-button">
						<a class="edd-cart" href="<?php echo esc_url(edd_get_checkout_uri()); ?>">
							<i class="<?php echo esc_attr(attesa_options('_eddcart_icon', 'fa fa-shopping-cart')); ?>" aria-hidden="true"></i>
							<span class="header-cart edd-cart-quantity">
								<?php if (edd_get_cart_quantity() != 0) { echo intval(edd_get_cart_quantity()); } ?>
							</span>
						</a>
					</div>
					<?php endif; ?>
					<?php if ($showTopBarMenu) : ?>
					<nav id="top-navigation" class="third-navigation" <?php attesa_schema_markup('site-navigation'); ?>>
						<button class="menu-toggle-top"><i class="<?php attesa_fontawesome_icons('general_prefix'); ?> fa-lg fa-bars" aria-hidden="true"></i></button>
						<?php wp_nav_menu( array( 'theme_location' => 'top', 'menu_id' => 'top-menu', 'depth' => 1, 'fallback_cb' => false ) ); ?>
					</nav>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php
	endif;
}

/* Create the header */
add_action('attesa_header', 'attesa_get_header');
function attesa_get_header() {
	$showTopBar = apply_filters( 'attesa_show_top_bar', attesa_options('_show_topbar', '1') );
	$headerScroll = attesa_options('_header_scroll', 'smaller');
	$headerFormat = attesa_options('_header_format', 'compat');
	$showInHeader =  attesa_options('_social_menu', '');
	$headerStyle = apply_filters( 'attesa_header_style', attesa_options('_header_style', 'boxed') );
	$menuPosition = attesa_options('_menu_position', 'right');
	$showWooCartButton = attesa_options('_show_woocart', '');
	$showEddCartButton = attesa_options('_show_eddcart', '');
	$showSearchButton = attesa_options('_show_search', '1');
	$mobileMenuOpen = attesa_options('_menu_mobile_open', 'dropdown');
	$mobileMenuIcon = attesa_options('_mobile_menu_icon', 'fas fa fa-bars');
	$mobileMenuText = attesa_options('_menu_mobile_default_text', __( 'Menu', 'attesa' ));
	?>
	<?php /* if the header format is compat */ if ($headerFormat == 'compat'): ?>
		<?php if ($mobileMenuOpen == 'pushmenu' && $headerFormat != 'menupopup'): ?>
			<div class="opacityMenu"></div>
		<?php endif; ?>
		<div class="nav-middle headerscroll<?php echo esc_attr($headerScroll); ?> format_<?php echo esc_attr($headerFormat); ?>">
			<div class="container <?php echo esc_attr($headerStyle); ?>">
				<div class="mainLogo">
					<div class="subLogo">
						<div class="site-branding menuposition_<?php echo esc_attr($menuPosition); ?>" <?php attesa_schema_markup('site-title'); ?>>
							<?php
							if ( function_exists( 'the_custom_logo' ) ) : ?>
							<div class="attesa-logo">
								<?php the_custom_logo(); ?>
							</div>
							<?php endif; ?>
							<div class="attesa-text-logo">
								<?php
								if ( is_front_page() && is_home() ) :
									?>
									<h1 class="site-title" <?php attesa_schema_markup('name'); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" <?php attesa_schema_markup('url'); ?>><?php bloginfo( 'name' ); ?></a></h1>
									<?php
								else :
									?>
									<p class="site-title" <?php attesa_schema_markup('name'); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" <?php attesa_schema_markup('url'); ?>><?php bloginfo( 'name' ); ?></a></p>
									<?php
								endif;
								$removeSiteDescription = attesa_options('_hide_description', '');
								if (empty($removeSiteDescription)) :
									$attesa_description = get_bloginfo( 'description', 'display' );
									if ( $attesa_description || is_customize_preview() ) :
										?>
										<p class="site-description smallText"><?php echo $attesa_description; /* // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></p>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div><!-- .mainLogo -->
				<div class="mainFunc">
					<div class="subFunc">
						<?php
						if ($showWooCartButton && function_exists( 'is_woocommerce') && $showTopBar ) : ?>
						<div class="cartwoo-button-mobile">
							<a class="woo-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>">
								<div class="cart-handle">
									<div class="cart-body">
										<i class="<?php echo esc_attr(attesa_options('_woocommercecart_icon', 'fa fa-shopping-cart')); ?>" aria-hidden="true"></i>
										<span class="cart-items"><span class="shopping-count">
											<?php if(WC()->cart->get_cart_contents_count() != 0){ echo intval(WC()->cart->get_cart_contents_count()); } ?>
										</span></span>
									</div>
								</div>
							</a>
						</div>
						<?php endif; ?>
						<?php
						if ($showEddCartButton && function_exists( 'EDD') && $showTopBar ) : ?>
						<div class="cartedd-button-mobile">
							<a class="edd-cart" href="<?php echo esc_url(edd_get_checkout_uri()); ?>">
								<i class="<?php echo esc_attr(attesa_options('_eddcart_icon', 'fa fa-shopping-cart')); ?>" aria-hidden="true"></i>
								<span class="header-cart edd-cart-quantity">
									<?php if (edd_get_cart_quantity() != 0) { echo intval(edd_get_cart_quantity()); } ?>
								</span>
							</a>
						</div>
						<?php endif; ?>
						<?php 
							if ($showInHeader == 1 ) {
								echo '<div class="attesa-social-header-desktop">';
								echo attesa_show_social_network('header'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo '</div>';
							}
						?>
						<?php if ( is_active_sidebar( attesa_get_push_sidebar() ) && attesa_check_bar('push') ) : ?>
							<?php if(attesa_options('_pushsidebar_icon','three_lines_icon') == 'three_lines_icon') : ?>
								<div class="hamburger-menu">
									<div class="menu__line menu_line1"></div>
									<div class="menu__line menu_line2"></div>
									<div class="menu__line menu_line3"></div>
									<div class="menu__line menu_line4"></div>
									<div class="menu__line menu_line5"></div>
								</div>
							<?php elseif(attesa_options('_pushsidebar_icon','three_lines_icon') == 'plus_icon'): ?>
								<div class="hamburger-menu noOw">
									<div class="menu__plus menu_plus1"></div>
									<div class="menu__plus menu_plus2"></div>
								</div>
							<?php else: ?>
								<div class="hamburger-menu noOw">
									<div class="menu__circle"></div>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div><!-- .mainFunc -->
				<div class="mainHead">
					<div class="subHead">
						<?php $menuLinksStyle = attesa_options('_menu_links_style', 'minimal'); ?>
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php echo esc_html($mobileMenuText); ?><i class="spaceLeft <?php echo esc_attr($mobileMenuIcon); ?>" aria-hidden="true"></i></button>
						<div class="attesa-main-menu-container open_<?php echo esc_attr($mobileMenuOpen); ?>">
							<?php if ($mobileMenuOpen == 'pushmenu'): ?>
								<?php $closeMenuText = attesa_options('_menu_mobile_text_close',__( 'Close menu', 'attesa' )); ?>
								<div class="attesa-close-pushmenu"><i class="<?php attesa_fontawesome_icons('close'); ?> spaceRight" aria-hidden="true"></i><?php echo esc_html($closeMenuText); ?></div>
							<?php endif; ?>
							<nav id="site-navigation" class="main-navigation menustyle_<?php echo esc_attr($menuLinksStyle); ?>" <?php attesa_schema_markup('site-navigation'); ?>>
								<?php
								wp_nav_menu( array(
									'theme_location' => 'main',
									'menu_id'        => 'primary-menu',
								) );
								?>
							</nav><!-- #site-navigation -->
							<?php 
								if ($showInHeader == 1) {
									echo '<div class="attesa-social-header-mobile">';
									echo attesa_show_social_network('header'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo '</div>';
								}
								if ($showSearchButton && $showTopBar) {
									echo '<div class="attesa-search-button-mobile">';
									get_search_form();
									echo '</div>';
								}
							?>
						</div>
					</div>
				</div><!-- .mainHead -->
			</div>
		</div>
	<?php /* if the header format is featuredtitle */ elseif ($headerFormat == 'featuredtitle'): ?>
		<?php if ($mobileMenuOpen == 'pushmenu' && $headerFormat != 'menupopup'): ?>
			<div class="opacityMenu"></div>
		<?php endif; ?>
		<div class="nav-middle-top-title">
			<div class="container <?php echo esc_attr($headerStyle); ?>">
				<div class="mainSoc">
					<div class="subSoc">
						<?php 
							if ($showInHeader == 1) {
								echo '<div class="attesa-social-header-desktop">';
								echo attesa_show_social_network('header'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo '</div>';
							}
						?>
					</div>
				</div><!-- .mainSoc -->
				<div class="mainLogo">
					<div class="subLogo">
						<div class="site-branding" <?php attesa_schema_markup('site-title'); ?>>
							<?php
							if ( function_exists( 'the_custom_logo' ) ) : ?>
							<div class="attesa-logo">
								<?php the_custom_logo(); ?>
							</div>
							<?php endif; ?>
							<div class="attesa-text-logo">
								<?php
								if ( is_front_page() && is_home() ) :
									?>
									<h1 class="site-title" <?php attesa_schema_markup('name'); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" <?php attesa_schema_markup('url'); ?>><?php bloginfo( 'name' ); ?></a></h1>
									<?php
								else :
									?>
									<p class="site-title" <?php attesa_schema_markup('name'); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" <?php attesa_schema_markup('url'); ?>><?php bloginfo( 'name' ); ?></a></p>
									<?php
								endif;
								$removeSiteDescription = attesa_options('_hide_description', '');
								if (empty($removeSiteDescription)) :
									$attesa_description = get_bloginfo( 'description', 'display' );
									if ( $attesa_description || is_customize_preview() ) :
										?>
										<p class="site-description smallText"><?php echo $attesa_description; /* // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></p>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div><!-- .mainLogo -->
				<div class="mainFunc">
					<div class="subFunc">
						<?php
						if ($showWooCartButton && function_exists( 'is_woocommerce') && $showTopBar ) : ?>
						<div class="cartwoo-button-mobile">
							<a class="woo-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>">
								<div class="cart-handle">
									<div class="cart-body">
										<i class="<?php echo esc_attr(attesa_options('_woocommercecart_icon', 'fa fa-shopping-cart')); ?>" aria-hidden="true"></i>
										<span class="cart-items"><span class="shopping-count">
											<?php if(WC()->cart->get_cart_contents_count() != 0){ echo intval(WC()->cart->get_cart_contents_count()); } ?>
										</span></span>
									</div>
								</div>
							</a>
						</div>
						<?php endif; ?>
						<?php
						if ($showEddCartButton && function_exists( 'EDD') && $showTopBar ) : ?>
						<div class="cartedd-button-mobile">
							<a class="edd-cart" href="<?php echo esc_url(edd_get_checkout_uri()); ?>">
								<i class="<?php echo esc_attr(attesa_options('_eddcart_icon', 'fa fa-shopping-cart')); ?>" aria-hidden="true"></i>
								<span class="header-cart edd-cart-quantity">
									<?php if (edd_get_cart_quantity() != 0) { echo intval(edd_get_cart_quantity()); } ?>
								</span>
							</a>
						</div>
						<?php endif; ?>
						<?php if ( is_active_sidebar( attesa_get_push_sidebar() ) && attesa_check_bar('push') ) : ?>
							<?php if(attesa_options('_pushsidebar_icon','three_lines_icon') == 'three_lines_icon') : ?>
								<div class="hamburger-menu">
									<div class="menu__line menu_line1"></div>
									<div class="menu__line menu_line2"></div>
									<div class="menu__line menu_line3"></div>
									<div class="menu__line menu_line4"></div>
									<div class="menu__line menu_line5"></div>
								</div>
							<?php elseif(attesa_options('_pushsidebar_icon','three_lines_icon') == 'plus_icon'): ?>
								<div class="hamburger-menu noOw">
									<div class="menu__plus menu_plus1"></div>
									<div class="menu__plus menu_plus2"></div>
								</div>
							<?php else: ?>
								<div class="hamburger-menu noOw">
									<div class="menu__circle"></div>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div><!-- .mainFunc -->
			</div>
		</div>
		<div class="nav-middle headerscroll<?php echo esc_attr($headerScroll); ?> format_<?php echo esc_attr($headerFormat); ?>" <?php attesa_schema_markup('site-navigation'); ?>>
			<div class="container <?php echo esc_attr($headerStyle); ?>">
				<div class="mainHead">
					<div class="subHead">
						<?php $menuLinksStyle = attesa_options('_menu_links_style', 'minimal'); ?>
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php echo esc_html($mobileMenuText); ?><i class="spaceLeft <?php echo esc_attr($mobileMenuIcon); ?>" aria-hidden="true"></i></button>
						<div class="attesa-main-menu-container open_<?php echo esc_attr($mobileMenuOpen); ?>">
							<?php if ($mobileMenuOpen == 'pushmenu'): ?>
									<?php $closeMenuText = attesa_options('_menu_mobile_text_close',__( 'Close menu', 'attesa' )); ?>
									<div class="attesa-close-pushmenu"><i class="<?php attesa_fontawesome_icons('close'); ?> spaceRight" aria-hidden="true"></i><?php echo esc_html($closeMenuText); ?></div>
								<?php endif; ?>
							<nav id="site-navigation" class="main-navigation menustyle_<?php echo esc_attr($menuLinksStyle); ?>">
								<?php
								wp_nav_menu( array(
									'theme_location' => 'main',
									'menu_id'        => 'primary-menu',
								) );
								?>
							</nav><!-- #site-navigation -->
							<?php 
								if ($showInHeader == 1) {
									echo '<div class="attesa-social-header-mobile">';
									echo attesa_show_social_network('header'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo '</div>';
								}
								if ($showSearchButton && $showTopBar) {
									echo '<div class="attesa-search-button-mobile">';
									get_search_form();
									echo '</div>';
								}
							?>
						</div>
					</div>
				</div><!-- .mainHead -->
			</div>
		</div>
	<?php /* if the header format is menupopup */ elseif ($headerFormat == 'menupopup'): ?>
		<div class="nav-middle headerscroll<?php echo esc_attr($headerScroll); ?> format_<?php echo esc_attr($headerFormat); ?>">
			<div class="container <?php echo esc_attr($headerStyle); ?>">
				<div class="mainLogo">
					<div class="subLogo">
						<div class="site-branding menuposition_<?php echo esc_attr($menuPosition); ?>" <?php attesa_schema_markup('site-title'); ?>>
							<?php
							if ( function_exists( 'the_custom_logo' ) ) : ?>
							<div class="attesa-logo">
								<?php the_custom_logo(); ?>
							</div>
							<?php endif; ?>
							<div class="attesa-text-logo">
								<?php
								if ( is_front_page() && is_home() ) :
									?>
									<h1 class="site-title" <?php attesa_schema_markup('name'); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" <?php attesa_schema_markup('url'); ?>><?php bloginfo( 'name' ); ?></a></h1>
									<?php
								else :
									?>
									<p class="site-title" <?php attesa_schema_markup('name'); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" <?php attesa_schema_markup('url'); ?>><?php bloginfo( 'name' ); ?></a></p>
									<?php
								endif;
								$removeSiteDescription = attesa_options('_hide_description', '');
								if (empty($removeSiteDescription)) :
									$attesa_description = get_bloginfo( 'description', 'display' );
									if ( $attesa_description || is_customize_preview() ) :
										?>
										<p class="site-description smallText"><?php echo $attesa_description; /* // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></p>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div><!-- .mainLogo -->
				<div class="mainFunc">
					<div class="subFunc">
						<?php
						if ($showWooCartButton && function_exists( 'is_woocommerce') && $showTopBar ) : ?>
						<div class="cartwoo-button-mobile">
							<a class="woo-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>">
								<div class="cart-handle">
									<div class="cart-body">
										<i class="<?php echo esc_attr(attesa_options('_woocommercecart_icon', 'fa fa-shopping-cart')); ?>" aria-hidden="true"></i>
										<span class="cart-items"><span class="shopping-count">
											<?php if(WC()->cart->get_cart_contents_count() != 0){ echo intval(WC()->cart->get_cart_contents_count()); } ?>
										</span></span>
									</div>
								</div>
							</a>
						</div>
						<?php endif; ?>
						<?php
						if ($showEddCartButton && function_exists( 'EDD') && $showTopBar ) : ?>
						<div class="cartedd-button-mobile">
							<a class="edd-cart" href="<?php echo esc_url(edd_get_checkout_uri()); ?>">
								<i class="<?php echo esc_attr(attesa_options('_eddcart_icon', 'fa fa-shopping-cart')); ?>" aria-hidden="true"></i>
								<span class="header-cart edd-cart-quantity">
									<?php if (edd_get_cart_quantity() != 0) { echo intval(edd_get_cart_quantity()); } ?>
								</span>
							</a>
						</div>
						<?php endif; ?>
						<?php if ( is_active_sidebar( attesa_get_push_sidebar() ) && attesa_check_bar('push') ) : ?>
							<?php if(attesa_options('_pushsidebar_icon','three_lines_icon') == 'three_lines_icon') : ?>
								<div class="hamburger-menu">
									<div class="menu__line menu_line1"></div>
									<div class="menu__line menu_line2"></div>
									<div class="menu__line menu_line3"></div>
									<div class="menu__line menu_line4"></div>
									<div class="menu__line menu_line5"></div>
								</div>
							<?php elseif(attesa_options('_pushsidebar_icon','three_lines_icon') == 'plus_icon'): ?>
								<div class="hamburger-menu noOw">
									<div class="menu__plus menu_plus1"></div>
									<div class="menu__plus menu_plus2"></div>
								</div>
							<?php else: ?>
								<div class="hamburger-menu noOw">
									<div class="menu__circle"></div>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div><!-- .mainFunc -->
				<div class="mainHead">
					<div class="subHead">
						<div class="menu-full-screen-icon">
						  <div class="icon-full-screen">
							<div class="square-full-screen"></div>
							<div class="square-full-screen"></div>
							<div class="square-full-screen"></div>
							<div class="square-full-screen"></div>
							<div class="square-full-screen"></div>
							<div class="square-full-screen"></div>
							<div class="square-full-screen"></div>
							<div class="square-full-screen"></div>
							<div class="square-full-screen"></div>
						  </div>
						</div>
						<?php $menuLinksStyle = attesa_options('_menu_links_style', 'minimal'); ?>
						<div class="attesa-main-menu-full-screen">
							<div class="attesa-main-menu-full-screen-container">
								<div class="attesa-main-menu-full-screen-sub-container">
									<nav id="site-navigation" class="main-navigation-popup menustyle_<?php echo esc_attr($menuLinksStyle); ?>" <?php attesa_schema_markup('site-navigation'); ?>>
										<?php
										wp_nav_menu( array(
											'theme_location' => 'main',
											'menu_id'        => 'primary-menu',
										) );
										?>
									</nav><!-- #site-navigation -->
									<?php 
										if ($showSearchButton && $showTopBar) {
											echo '<div class="attesa-search-button-popup">';
											get_search_form();
											echo '</div>';
										}
										if ($showInHeader == 1) {
											echo '<div class="attesa-social-header-popup">';
											echo attesa_show_social_network('header'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											echo '</div>';
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div><!-- .mainHead -->
			</div>
		</div>
	<?php endif; ?>
	<?php
}

/* Create the big featured image in the header */
add_action('attesa_big_featured_image_style', 'attesa_get_big_featured_image_style');
function attesa_get_big_featured_image_style() {
	$featImagePosts = apply_filters( 'attesa_post_featured_image_style', attesa_options('_featimage_style_posts', 'content') );
	$featImagePage = apply_filters( 'attesa_page_featured_image_style', attesa_options('_featimage_style_pages', 'content') );
	if (is_singular( 'post' ) && $featImagePosts == 'header' && '' != get_the_post_thumbnail()) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'attesa-the-post-big');
		$overlayFeatImage = apply_filters( 'attesa_overlay_featured_image_style', attesa_options('_featimage_style_posts_overlay', '') );
		$heightFeatImage = apply_filters( 'attesa_height_featured_image_style', attesa_options('_featimage_style_posts_height', '500') );
		$fixedFeatImage = apply_filters( 'attesa_fixed_featured_image_style', attesa_options('_featimage_style_posts_fixed', '') );
		$featImageTitle = apply_filters( 'attesa_title_featured_image_style', attesa_options('_featimage_style_posts_title', 'insidecontent') );
		?>
		<div class="attesaFeatBox <?php echo $overlayFeatImage ? 'withOverlayMenu' : 'noOverlayMenu' ?>" style="background-image: url(<?php echo esc_url($src[0]); ?>);height:<?php echo intval($heightFeatImage); ?>px; background-attachment: <?php echo $fixedFeatImage ? 'fixed' : 'scroll' ?>">
			<div class="attesaFeatBoxContainer">
			<?php
				if ($featImageTitle == 'insideheader') {
					the_title( '<div class="attesaFeatBoxTitle"><h1 class="entry-title" '. attesa_get_schema_markup('headline') .'>', '</h1></div>' );
				}
				do_action('attesa_inside_feat_box_post');
			?>
			</div>
			<div class="attesaFeatBoxOpacityPost"></div>
		</div>
		<?php
	}
	if (is_page() && $featImagePage == 'header' && '' != get_the_post_thumbnail()) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'attesa-the-post-big');
		$overlayFeatImage = apply_filters( 'attesa_overlay_featured_image_style_page', attesa_options('_featimage_style_pages_overlay', '') );
		$heightFeatImage = apply_filters( 'attesa_height_featured_image_style_page', attesa_options('_featimage_style_pages_height', '500') );
		$fixedFeatImage = apply_filters( 'attesa_fixed_featured_image_style_page', attesa_options('_featimage_style_pages_fixed', '') );
		$featImageTitle = apply_filters( 'attesa_title_featured_image_style_page', attesa_options('_featimage_style_pages_title', 'insidecontent') );
		?>
		<div class="attesaFeatBox <?php echo $overlayFeatImage ? 'withOverlayMenu' : 'noOverlayMenu' ?>" style="background-image: url(<?php echo esc_url($src[0]); ?>);height:<?php echo intval($heightFeatImage); ?>px; background-attachment: <?php echo $fixedFeatImage ? 'fixed' : 'scroll' ?>">
			<div class="attesaFeatBoxContainer">
			<?php
				if ($featImageTitle == 'insideheader') {
					the_title( '<div class="attesaFeatBoxTitle"><h1 class="entry-title" '. attesa_get_schema_markup('headline') .' >', '</h1></div>' );
				}
				do_action('attesa_inside_feat_box_page');
			?>
			</div>
			<div class="attesaFeatBoxOpacityPage"></div>
		</div>
		<?php
	}
	if (is_home() && !is_front_page() && '' != get_the_post_thumbnail(get_option('page_for_posts')) ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_option('page_for_posts')), 'attesa-the-post-big');
		$overlayFeatImage = attesa_options('_featimage_style_pages_overlay', '');
		$heightFeatImage = attesa_options('_featimage_style_pages_height', '500');
		$fixedFeatImage = attesa_options('_featimage_style_pages_fixed', '');
		?>
		<div class="attesaFeatBox <?php echo $overlayFeatImage ? 'withOverlayMenu' : 'noOverlayMenu' ?>" style="background-image: url(<?php echo esc_url($src[0]); ?>);height:<?php echo intval($heightFeatImage); ?>px; background-attachment: <?php echo $fixedFeatImage ? 'fixed' : 'scroll' ?>">
			<div class="attesaFeatBoxOpacityPost"></div>
		</div>
		<?php
	}
	if (function_exists( 'is_woocommerce' ) && is_shop() && '' != get_the_post_thumbnail(get_option('woocommerce_shop_page_id')) ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_option('woocommerce_shop_page_id')), 'attesa-the-post-big');
		$overlayFeatImage = attesa_options('_featimage_style_pages_overlay', '');
		$heightFeatImage = attesa_options('_featimage_style_pages_height', '500');
		$fixedFeatImage = attesa_options('_featimage_style_pages_fixed', '');
		?>
		<div class="attesaFeatBox <?php echo $overlayFeatImage ? 'withOverlayMenu' : 'noOverlayMenu' ?>" style="background-image: url(<?php echo esc_url($src[0]); ?>);height:<?php echo intval($heightFeatImage); ?>px; background-attachment: <?php echo $fixedFeatImage ? 'fixed' : 'scroll' ?>">
			<div class="attesaFeatBoxOpacityPost"></div>
		</div>
		<?php
	}
}