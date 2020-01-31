<?php
/**
 * Attesa to print custom CSS
 *
 * @package Attesa
 */

/**
 * Add Custom CSS to Header 
 */
if ( ! function_exists( 'attesa_custom_css_styles' ) ) {
	function attesa_custom_css_styles() {
		$attesa_custom_css = '';
			/* Website Structure */
			$websiteStructure = apply_filters( 'attesa_website_structure', attesa_options('_website_structure', 'wide') );
			if ($websiteStructure == 'boxed') {
				$websiteBoxedWidth = apply_filters( 'attesa_max_width_structure', attesa_options('_max_width_structure', '1500') );
				$attesa_custom_css .= '
					.attesa-site-wrap,
					header.site-header.withSticky,
					header.site-header.withSticky .nav-middle.format_featuredtitle,
					header.site-header.topbarscrollshow .nav-top.fixed {
						max-width: '.esc_html($websiteBoxedWidth).'px;
					}
					header.site-header.withSticky,
					header.site-header.withSticky .nav-middle.format_featuredtitle,
					header.site-header.topbarscrollshow .nav-top.fixed {
						left: initial !important;
						right: initial !important;
						margin: 0 auto;
					}
				';
			}
			/* Choose the fonts */
			$disableGoogleFonts = attesa_options('_disable_google_fonts', '');
			if (empty($disableGoogleFonts)) {
				$googleFontHeading = attesa_options('_googlefont_heading', 'Quicksand : sans-serif');
				$googleFontText = attesa_options('_googlefont_text', 'Quicksand : sans-serif');
				$piecesHead = explode(" : ", $googleFontHeading);
				$piecesText = explode(" : ", $googleFontText);
			} else {
				$standardFontHeading = attesa_options('_standardfont_heading', 'Arial : sans-serif');
				$standardFontText = attesa_options('_standardfont_text', 'Arial : sans-serif');
				$piecesHead = explode(" : ", $standardFontHeading);
				$piecesText = explode(" : ", $standardFontText);
			}
			$attesa_custom_css .= '
				h1,
				h2,
				h3,
				h4,
				h5,
				h6,
				p.site-title,
				blockquote {
					font-family: '.esc_html($piecesHead[0]).', '.esc_html($piecesHead[1]).';
				}
				body,
				button,
				input,
				select,
				optgroup,
				textarea {
					font-family: '.esc_html($piecesText[0]).', '.esc_html($piecesText[1]).';
				}
			';
			/* Set custom max-width for content, side content and sidebar */
			$max_width = apply_filters( 'attesa_max_width_site_content', attesa_options('_max_width', '1240') );
			$width_content = apply_filters( 'attesa_width_site_content', attesa_options('_width_content', '67') );
			$width_content_nosidebar = apply_filters( 'attesa_width_site_content_no_sidebar', attesa_options('_width_content_nosidebar', '67') );
			if ($max_width != '1240') {
				$attesa_custom_css .= '
					.nav-top .container.boxed,
					.nav-middle .container.boxed,
					.nav-middle-top-title .container.boxed,
					#content.site-content,
					.attesaFooterWidget,
					.attesaFeatBox .attesaFeatBoxContainer,
					.mainFooter .site-copy-down,
					.second-navigation,
					.attesa-woocommerce-sticky-product .container,
					.attesapro-footer-callout-container {
						max-width: '.intval($max_width).'px;
					}
				';
			}
			if ($width_content != '67') {
				$width_sidebar = abs($width_content - 100);
				$attesa_custom_css .= '
					#primary.content-area {width:'.intval($width_content).'%;}
					#secondary.widget-area {width:'.intval($width_sidebar).'%;}
				';
			}
			$attesa_custom_css .=  'body.no-sidebar #primary.content-area {width:'.intval($width_content_nosidebar).'%;}';
			if (function_exists( 'is_woocommerce' ) && is_product() && attesa_options('_woocommerce_stickybar', '1')) {
				$stickyBarBackColor = attesa_options('_woocommerce_stickybar_backcolor', '#fbfbfb');
				$stickyBarTextColor = attesa_options('_woocommerce_stickybar_textcolor', '#404040');
				$attesa_custom_css .= '
					.attesa-woocommerce-sticky-product {
						background-color:'.esc_html($stickyBarBackColor).';
						color:'.esc_html($stickyBarTextColor).';}
				';
			}
			/* Set border radius of elements */
			$borderRadius = apply_filters( 'attesa_elements_border_radius', attesa_options('_elements_border_radius', '5') );
			if ($borderRadius != '5') {
				$attesa_custom_css .= '
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				input[type="text"],
				input[type="email"],
				input[type="url"],
				input[type="password"],
				input[type="search"],
				input[type="number"],
				input[type="tel"],
				input[type="range"],
				input[type="date"],
				input[type="month"],
				input[type="week"],
				input[type="time"],
				input[type="datetime"],
				input[type="datetime-local"],
				input[type="color"],
				textarea,
				select,
				.attesaMenuButton,
				.navigation.pagination .nav-links a,
				.woocommerce-pagination > ul.page-numbers li a,
				.page-links a,
				.navigation.pagination .nav-links span.current,
				.woocommerce-pagination > ul.page-numbers li span,
				.page-links .current,
				aside ul.menu .indicatorBar,
				aside ul.product-categories .indicatorBar,
				.tagcloud a,
				.widget.widget_search input[type="search"],
				.widget.woocommerce.widget_product_search input[type="search"],
				.woocommerce #content form.cart .quantity input[type="number"],
				.widget.widget_search input[type="submit"],
				.widget.woocommerce.widget_product_search button,
				.woocommerce #content form.cart .button,
				.attesa_woocommerce_mini_cart ul.product_list_widget li img,
				.attesa_woo_cart_quantity_item .remove,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a,
				#secondary.widget-area .sidebar-container,
				header.page-header,
				footer.entry-footer .read-more a,
				.post-thumbnail img,
				#toTop,
				#comments article footer img,
				#comments .reply,
				.site-social-float a,
				.woocommerce div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger,
				.woocommerce .wooImage .button,
				.woocommerce .wooImage .added_to_cart,
				.woocommerce-error li a,
				.woocommerce-message a,
				.return-to-shop a,
				.wc-proceed-to-checkout .button.checkout-button,
				.widget_shopping_cart p.buttons a,
				.woocommerce .wishlist_table td.product-add-to-cart a,
				.woocommerce .content-area .woocommerce-tabs .tabs li.active a,
				.woocommerce .content-area .woocommerce-tabs .tabs li a,
				.woocommerce-page table.cart .product-thumbnail img,
				.woocommerce-info,
				.woocommerce-error,
				.woocommerce-message,
				.woocommerce #reviews .commentlist li .avatar,
				.woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single,
				.woocommerce-checkout form.checkout_coupon,
				.woocommerce-checkout form.woocommerce-form-login,
				.product_list_widget li img,
				.woocommerce ul.products > li,
				#payment .payment_methods li,
				.woocommerce .woocommerce-tabs,
				body.attesa-blog-grid .hentry,
				body.attesa-blog-masonry .hentry,
				.prev_next_buttons a,
				.attesa-prevnext-img img,
				.attesa-woocommerce-sticky-product .container .attesa-sticky-first .attesa-sticky-image img,
				.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button,
				.edd_purchase_submit_wrapper a,
				fieldset,
				.edd_downloads_list .edd_download,
				body.edd-page legend,
				.attesaPostWidget img,
				ul.products li.product .tinvwl_add_to_wishlist_button,
				.site-social-widget .attesa-social,
				.authorImg img,
				.theAuthorBox .theShare a,
				.relatedBox .owl-carousel .owl-item img,
				.attesa-pro-sharing-box .attesa-sharing-button a,
				.attesa-pro-sharing-box-container,
				.attesaFeatBoxContainer .attesaproFeatBoxButton a,
				.attesapro-footer-callout .attesapro-footer-callout-button-text a,
				.attesa-about-me-image img,
				.attesa-contact-info i,
				.single-instagram-pic a img,
				.single-instagram-pic-big img,
				.attesa-post-slider-readmore p a,
				.attesa-breadcrumbs,
				.rank-math-breadcrumb,
				.attesa-portfolio-filter li a,
				.attesa-portfolio-grid .attesa-portfolio-readmore p a {
					border-radius: '.intval($borderRadius).'px;
				}
				#wp-calendar > caption {
					-webkit-border-top-left-radius: '.intval($borderRadius).'px;
					-webkit-border-top-right-radius: '.intval($borderRadius).'px;
					-moz-border-radius-topleft: '.intval($borderRadius).'px;
					-moz-border-radius-topright: '.intval($borderRadius).'px;
					border-top-left-radius: '.intval($borderRadius).'px;
					border-top-right-radius: '.intval($borderRadius).'px;
				}
				.woocommerce .wooImage .entry-wooImage img {
					border-top-left-radius: '.intval($borderRadius).'px;
					border-top-right-radius: '.intval($borderRadius).'px;
				}
				.attesa_woocommerce_mini_cart .widget_shopping_cart_content {
					border-bottom-left-radius: '.intval($borderRadius).'px;
					border-bottom-right-radius: '.intval($borderRadius).'px;
				}';
			}
			/* Max height for the logo if the header format is Featured Title */
			$logoMaxHeight = attesa_options('_menu_logo_max_height', '100');
				$attesa_custom_css .= '
					.nav-middle-top-title .attesa-logo img {
						max-height: '.intval($logoMaxHeight).'px;
					}
				';
			/* Font Size */
			$general_font_size = attesa_options('_general_font_size', '16px');
			$sitetitle_font_size = attesa_options('_sitetitle_font_size', '18px');
			$mainmenu_font_size = attesa_options('_mainmenu_font_size', '14px');
			$smalltext_font_size = attesa_options('_smalltext_font_size', '13px');
			$headertitle_font_size = attesa_options('_headertitle_font_size', '48px');
			$widgettitle_font_size = attesa_options('_widgettitle_font_size', '19px');
			$widgettext_font_size = attesa_options('_widgettext_font_size', '14px');
			/* Line Height */
			$content_line_height = attesa_options('_content_line_height', '2');
			$widget_line_height = attesa_options('_widget_line_height', '2');
			$pagetitle_line_height = attesa_options('_pagetitle_line_height', '1.3');
			$widgettitle_line_height = attesa_options('_widgettitle_line_height', '1.5');
			/* Font Weight */
			$sitetitle_font_weight = attesa_options('_sitetitle_font_weight', 'bold');
			$headertitle_font_weight = attesa_options('_headertitle_font_weight', 'normal');
			$widgettitle_font_weight = attesa_options('_widgettitle_font_weight', 'bold');
			$attesa_custom_css .= '@media all and (min-width: 1024px) {';
			if (function_exists( 'is_woocommerce' ) ) {
				$wooheadings_font_size = attesa_options('_wooheadings_font_size', '32px');
				if ($wooheadings_font_size != '32px') {
					$attesa_custom_css .= '
					.woocommerce .content-area .summary h1.entry-title,
					.woocommerce .related h2,
					.woocommerce .woocommerce-tabs .panel > h2,
					.woocommerce .woocommerce-tabs .panel .woocommerce-Reviews-title {
						font-size: '.esc_html($wooheadings_font_size).';
					}';
				}
			}
			if ($general_font_size != '16px') {
				$attesa_custom_css .= '
				body,
				button,
				input,
				select,
				optgroup,
				textarea,
				aside ul.menu .indicatorBar,
				aside ul.product-categories .indicatorBar,
				.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item .remove {
					font-size: '.esc_html($general_font_size).';
				}';
			}
			if ($smalltext_font_size != '13px') {
				$attesa_custom_css .= '
				.smallText,
				blockquote cite,
				.post-navigation span.meta-nav,
				.tagcloud a,
				#comments article .comment-metadata,
				#comments .reply,
				.comment-awaiting-moderation,
				.comment-notes,
				.woocommerce-error li a,
				.woocommerce-message a,
				.woocommerce ul.products > li .price del,
				.woocommerce div.product .summary .price del,
				.woocommerce #content .quantity,
				#payment .payment_methods li .payment_box p,
				.woocommerce .wooImage .button,
				.woocommerce .wooImage .added_to_cart,
				.woocommerce-store-notice,
				#edd_checkout_form_wrap span.edd-description,
				#edd_purchase_submit #edd_terms_agreement #edd_terms,
				#edd_purchase_submit #edd_mailchimp #edd_terms,
				#edd_purchase_submit #edd_terms_agreement>[id*="-terms-wrap"]>[id*="_terms"]>p,
				#edd_purchase_submit #edd_mailchimp>[id*="-terms-wrap"]>[id*="_terms"]>p,
				.eddr-cart-item-notice,
				.edd-cart-added-alert,
				.edd_purchase_submit_wrapper,
				.edd_downloads_list .edd_download .edd_download_inner .edd_download_excerpt,
				.edd_cart_remove_item_btn,
				.edd_purchase_receipt_product_notes,
				.edd_sl_license_key_expired,
				.attesaPostWidget .theText span.date,
				.attesaPostWidget .theText span.comm,
				ul.products li.product .tinvwl_add_to_wishlist_button,
				.woocommerce ul.products li.product a.compare,
				.site-social-widget .attesa-social {
					font-size: '.esc_html($smalltext_font_size).';
				}';
			}
			if ($sitetitle_font_size != '18px') {
				$attesa_custom_css .= '
				.site-branding .site-title {
					font-size: '.esc_html($sitetitle_font_size).';
				}';
			}
			if ($mainmenu_font_size != '14px') {
				$attesa_custom_css .= '
				.main-navigation li,
				.main-navigation-popup li,
				.site-social-header a {
					font-size: '.esc_html($mainmenu_font_size).';
				}';
			}
			if ($headertitle_font_size != '48px') {
				$attesa_custom_css .= '
				.hentry .entry-title,
				.attesaFeatBoxTitle .entry-title,
				.woocommerce h1.page-title {
					font-size: '.esc_html($headertitle_font_size).';
				}';
			}
			if ($widgettitle_font_size != '19px') {
				$attesa_custom_css .= '
				.widget .widget-title .widgets-heading {
					font-size: '.esc_html($widgettitle_font_size).';
				}';
			}
			if ($widgettext_font_size != '14px') {
				$attesa_custom_css .= '
				#secondary.widget-area,
				#tertiary.widget-area,
				.attesaFooterWidget {
					font-size: '.esc_html($widgettext_font_size).';
				}';
			}
			if ($content_line_height != '2') {
				$attesa_custom_css .= '
				.page-content,
				.entry-content,
				.entry-summary {
					line-height: '.esc_html($content_line_height).';
				}';
			}
			if ($widget_line_height != '2') {
				$attesa_custom_css .= '
				#secondary.widget-area,
				#tertiary.widget-area,
				.attesaFooterWidget {
					line-height: '.esc_html($widget_line_height).';
				}';
			}
			if ($pagetitle_line_height != '1.3') {
				$attesa_custom_css .= '
				.hentry .entry-title,
				.attesaFeatBoxTitle .entry-title {
					line-height: '.esc_html($pagetitle_line_height).';
				}
				body.attesa-blog-nogrid .sticky .entry-header .entry-title:before {
					line-height: '.esc_html($pagetitle_line_height + '0.2').';
				}';
			}
			if ($widgettitle_line_height != '1.5') {
				$attesa_custom_css .= '
				.widget .widget-title .widgets-heading {
					line-height: '.esc_html($widgettitle_line_height).';
				}';
			}
			if ($sitetitle_font_weight != 'bold') {
				$attesa_custom_css .= '
				.site-branding .site-title {
					font-weight: '.esc_html($sitetitle_font_weight).';
				}';
			}
			if ($headertitle_font_weight != 'normal') {
				$attesa_custom_css .= '
				.hentry .entry-title,
				.attesaFeatBoxTitle .entry-title,
				.woocommerce h1.page-title {
					font-weight: '.esc_html($headertitle_font_weight).';
				}';
			}
			if ($widgettitle_font_weight != 'bold') {
				$attesa_custom_css .= '
				.widget .widget-title .widgets-heading {
					font-weight: '.esc_html($widgettitle_font_weight).';
				}';
			}
			$attesa_custom_css .= '}';
			/* Main menu style */
			$menuFontWeight = attesa_options('_menu_font_weight', 'bold');
			$menuTextTransform = attesa_options('_menu_text_transform', 'none');
			if (attesa_options('_header_format', 'compat') != 'custom') {
				$attesa_custom_css .='
					.main-navigation li,
					.main-navigation-popup li {
						font-weight: '.esc_html($menuFontWeight).';
						text-transform: '.esc_html($menuTextTransform).';
					}
				';
			}
			/* Main Menu position */
			$menuPosition = attesa_options('_menu_position', 'right');
			$attesa_custom_css .='
				.nav-middle:not(.format_featuredtitle) .container .mainHead {
					float: '.esc_html($menuPosition).';
				}
			';
			/* Featured Image posts opacity color */
			if (is_singular( 'post' ) && '' != get_the_post_thumbnail()) {
				$featImagePostsOpacity = attesa_options('_featimage_style_posts_opacity', '#f5f5f5');
				list($r, $g, $b) = sscanf($featImagePostsOpacity, '#%02x%02x%02x');
				$featImagePostsOpacityPrint = '.attesaFeatBox .attesaFeatBoxOpacityPost {background-color: rgba('.esc_html($r).', '.esc_html($g).', '.esc_html($b).',0.3)}';
				$attesa_custom_css .= apply_filters( 'attesa_opacity_featured_image_style', $featImagePostsOpacityPrint );
			}
			/* Featured Image pages opacity color */
			if (is_page() && '' != get_the_post_thumbnail()) {
				$featImagePagesOpacity = attesa_options('_featimage_style_pages_opacity', '#f5f5f5');
				list($r, $g, $b) = sscanf($featImagePagesOpacity, '#%02x%02x%02x');
				$featImagePagesOpacityPrint = '.attesaFeatBox .attesaFeatBoxOpacityPage {background-color: rgba('.esc_html($r).', '.esc_html($g).', '.esc_html($b).',0.3)}';
				$attesa_custom_css .= apply_filters( 'attesa_opacity_featured_image_style_page', $featImagePagesOpacityPrint );
			}
			/* Social Network float position */
			if (attesa_options('_social_float', '') == '1') {
				$socialFloatPosition = attesa_options('_socialfloat_position', 'left');
				$attesa_custom_css .= '
					.site-social-float {
						'.esc_html($socialFloatPosition).': 10px;
					}
				';
			}
			/* Scroll To Top position */
			if (attesa_options('_show_scrolltotop', '1') == '1') {
				$scrolltotopPosition = attesa_options('_scrolltotop_position', 'right');
				$attesa_custom_css .= '
					#toTop {
						'.esc_html($scrolltotopPosition).': 20px;
					}
				';
			}
			/* Choose classic sidebar position */
			if (is_active_sidebar( attesa_get_classic_sidebar() ) && attesa_check_bar('classic')) {
				$classicsidebarPosition = attesa_options('_classicsidebar_position','right');
				if ($classicsidebarPosition == 'right') {
					$classicSidebarPositionCode = '#primary.content-area {float: left;}';
				} else {
					$classicSidebarPositionCode = '#primary.content-area {float: right;}';
				}
				$attesa_custom_css .= apply_filters( 'attesa_classic_sidebar_position', $classicSidebarPositionCode );
			}
			/* Choose push sidebar position */
			if (is_active_sidebar( attesa_get_push_sidebar() ) && attesa_check_bar('push')) {
				$pushsidebarPosition = attesa_options('_pushsidebar_position','right');
				if ($pushsidebarPosition == 'right') {
					$pushSidebarPositionCode = '
					@media all and (min-width: 1025px) {
						body {
							overflow-x: hidden;
						}
						.attesa-site-wrap {
							left: 0;
							-webkit-transition: left .25s ease-in-out;
							-moz-transition: left .25s ease-in-out;
							-o-transition: left .25s ease-in-out;
							-ms-transition: left .25s ease-in-out;
							transition: left .25s ease-in-out;
						}
						body.yesOpen .attesa-site-wrap,
						body.yesOpen:not(.format_featuredtitle) header.site-header {
							left: -150px;
						}
					}
					body.yesOpen header.site-header.noSticky,
					body.yesOpen header.site-header.relative,
					header.site-header {
						left: 0;
					}
					#tertiary.widget-area {
						border-left-width: 3px;
						border-left-style: solid;
						right: -390px;
						-wekbit-transition-property: right;
						-moz-transition-property: right;
						-o-transition-property: right;
						transition-property: right;
					}
					#tertiary.widget-area.yesOpen {
						right: 0;
					}
					@media all and (max-width: 600px) {
						#tertiary.widget-area {
							right: -100%
						}
					}';
				} else {
					$pushSidebarPositionCode = '
					@media all and (min-width: 1025px) {
						body {
							overflow-x: hidden;
						}
						.attesa-site-wrap {
							right: 0;
							-webkit-transition: right .25s ease-in-out;
							-moz-transition: right .25s ease-in-out;
							-o-transition: right .25s ease-in-out;
							-ms-transition: right .25s ease-in-out;
							transition: right .25s ease-in-out;
						}
						body.yesOpen .attesa-site-wrap,
						body.yesOpen:not(.format_featuredtitle) header.site-header {
							right: -150px;
						}
					}
					body.yesOpen header.site-header.noSticky,
					body.yesOpen header.site-header.relative,
					header.site-header {
						right: 0;
					}
					#tertiary.widget-area {
						border-right-width: 3px;
						border-right-style: solid;
						left: -390px;-wekbit-transition-property: left;
						-moz-transition-property: left;
						-o-transition-property: left;
						transition-property: left;
					}
					#tertiary.widget-area.yesOpen {
						left: 0;
					}
					@media all and (max-width: 600px) {
						#tertiary.widget-area{
							left: -100%
						}
					}';
				}
				$attesa_custom_css .= apply_filters( 'attesa_push_sidebar_position', $pushSidebarPositionCode );
			}
			/* Choose outer background color */
			if ($websiteStructure == 'boxed') {
				$outerBackgroundColor = apply_filters( 'attesa_outer_background_color', attesa_options('_outer_background_color', '#cccccc') );
				$attesa_custom_css .='
					body {
						background-color: '.esc_html($outerBackgroundColor).';
					}
				';
			}
			/* Choose general link color */
			$generalLinkColor = apply_filters( 'attesa_general_link_color', attesa_options('_general_link_color', '#f06292') );
			$attesa_custom_css .='
			blockquote::before,
			a,
			a:visited,
			.main-navigation.menustyle_default > div > ul > li:hover > a,
			.main-navigation.menustyle_default > div > ul > li:focus > a,
			.main-navigation.menustyle_default > div > ul > .current_page_item > a,
			.main-navigation.menustyle_default > div > ul > .current-menu-item > a,
			.main-navigation.menustyle_default > div > ul > .current_page_ancestor > a,
			.main-navigation.menustyle_default > div > ul > .current-menu-ancestor > a,
			.main-navigation.menustyle_default > div > ul > .current_page_parent > a,
			.main-navigation-popup.menustyle_default > div ul li:hover > a,
			.main-navigation-popup.menustyle_default > div ul li:focus > a,
			.main-navigation-popup.menustyle_default > div ul .current_page_item > a,
			.main-navigation-popup.menustyle_default > div ul .current-menu-item > a,
			.main-navigation-popup.menustyle_default > div ul .current_page_ancestor > a,
			.main-navigation-popup.menustyle_default > div ul .current-menu-ancestor > a,
			.main-navigation-popup.menustyle_default > div ul .current_page_parent > a,
			.entry-meta i,
			.entry-footer span i,
			.site-social-header a:hover,
			.site-social-header a:focus,
			.site-social-header a:active,
			.cartwoo-button-mobile a:hover,
			.cartwoo-button-mobile a:focus,
			.cartwoo-button-mobile a:active,
			.cartedd-button-mobile a:hover,
			.cartedd-button-mobile a:focus,
			.cartedd-button-mobile a:active,
			.woocommerce ul.products > li .price,
			.woocommerce div.product .summary .price,
			#edd_purchase_submit #edd_final_total_wrap span {
				color: '.esc_html($generalLinkColor).';
			}
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.main-navigation > div > ul > li > a::before,
			.main-navigation-popup > div ul li a::before,
			.attesaMenuButton,
			.navigation.pagination .nav-links a,
			.woocommerce-pagination > ul.page-numbers li a,
			.page-links a,
			.tagcloud a,
			footer.entry-footer .read-more a,
			#toTop,
			.woocommerce span.onsale,
			.woocommerce .wooImage .button,
			.woocommerce .wooImage .added_to_cart,
			.woocommerce-error li a,
			.woocommerce-message a,
			.return-to-shop a,
			.wc-proceed-to-checkout .button.checkout-button,
			.widget_shopping_cart p.buttons a,
			.woocommerce .wishlist_table td.product-add-to-cart a,
			.woocommerce .content-area .woocommerce-tabs .tabs li.active a,
			.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button,
			.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a.checkout,
			.woocommerce-store-notice,
			.edd_purchase_submit_wrapper a,
			ul.products li.product .tinvwl_add_to_wishlist_button,
			.woocommerce ul.products li.product a.compare,
			.woocommerce ul.products >li:hover .wooImage a.compare.button,
			.attesa-pro-sharing-box-container.style_astheme .attesa-pro-sharing-box .attesa-sharing-button a:hover,
			.attesa-pro-sharing-box-container.style_astheme .attesa-pro-sharing-box .attesa-sharing-button a:focus,
			.attesa-pro-sharing-box-container.style_astheme .attesa-pro-sharing-box .attesa-sharing-button a:active,
			.attesaFeatBoxContainer .attesaproFeatBoxButton a {
				background-color: '.esc_html($generalLinkColor).';
			}
			input[type="text"]:focus,
			input[type="email"]:focus,
			input[type="url"]:focus,
			input[type="password"]:focus,
			input[type="search"]:focus,
			input[type="number"]:focus,
			input[type="tel"]:focus,
			input[type="range"]:focus,
			input[type="date"]:focus,
			input[type="month"]:focus,
			input[type="week"]:focus,
			input[type="time"]:focus,
			input[type="datetime"]:focus,
			input[type="datetime-local"]:focus,
			input[type="color"]:focus,
			textarea:focus,
			.navigation.pagination .nav-links span.current,
			.woocommerce-pagination > ul.page-numbers li span,
			.page-links .current,
			.footerArea,
			body.attesa-blog-grid .sticky,
			body.attesa-blog-masonry .sticky,
			.woocommerce ul.products > li:hover,
			.woocommerce ul.products > li:focus,
			.prev_next_buttons a:hover,
			.prev_next_buttons a:focus,
			.prev_next_buttons a:active,
			.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a:hover,
			.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a:focus,
			.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a:active,
			.site-social-float a:hover,
			.site-social-float a:focus,
			.site-social-float a:active,
			.edd_downloads_list .edd_download:hover,
			.edd_downloads_list .edd_download:focus,
			.edd_downloads_list .edd_download:active,
			.attesa-pro-sharing-box-container.style_astheme .attesa-pro-sharing-box .attesa-sharing-button a {
				border-color: '.esc_html($generalLinkColor).';
			}';
			/* Choose general text color */
			$generalTextColor = apply_filters( 'attesa_general_text_color', attesa_options('_general_text_color', '#404040') );
			$attesa_custom_css .='
			body,
			button,
			input,
			select,
			optgroup,
			textarea,
			input[type="text"]:focus,
			input[type="email"]:focus,
			input[type="url"]:focus,
			input[type="password"]:focus,
			input[type="search"]:focus,
			input[type="number"]:focus,
			input[type="tel"]:focus,
			input[type="range"]:focus,
			input[type="date"]:focus,
			input[type="month"]:focus,
			input[type="week"]:focus,
			input[type="time"]:focus,
			input[type="datetime"]:focus,
			input[type="datetime-local"]:focus,
			input[type="color"]:focus,
			textarea:focus,
			a:hover, a:focus, a:active, .entry-title a, .post-navigation span.meta-nav, #comments .reply a,
			.main-navigation > div > ul > li > a,
			.attesaFeatBoxTitle .entry-title,
			.site-social-header a,
			.cartwoo-button-mobile a,
			.cartedd-button-mobile a,
			.site-social-float a,
			.prev_next_buttons a,
			.woocommerce div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger,
			#edd_checkout_form_wrap label,
			.edd_purchase_receipt_product_name,
			.attesa-main-menu-container.open_pushmenu .attesa-close-pushmenu {
				color: '. esc_html($generalTextColor).';
			}
			.woocommerce ul.products > li .price {
				color: '.esc_html($generalTextColor).' !important;
			}
			button:hover,
			input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover,
			button:active, button:focus,
			input[type="button"]:active,
			input[type="button"]:focus,
			input[type="reset"]:active,
			input[type="reset"]:focus,
			input[type="submit"]:active,
			input[type="submit"]:focus,
			.main-navigation ul ul a,
			.navigation.pagination .nav-links a:hover,
			.navigation.pagination .nav-links a:focus,
			.woocommerce-pagination > ul.page-numbers li a:hover,
			.woocommerce-pagination > ul.page-numbers li a:focus,
			.page-links a:hover,
			.page-links a:focus,
			.tagcloud a:hover,
			.tagcloud a:focus,
			.tagcloud a:active, 
			.hamburger-menu .menu__line,
			.hamburger-menu .menu__plus,
			.woocommerce ul.products > li:hover .wooImage .button,
			.woocommerce ul.products > li:hover .wooImage .added_to_cart,
			.woocommerce-error li a:hover,
			.woocommerce-message a:hover,
			.return-to-shop a:hover,
			.wc-proceed-to-checkout .button.checkout-button:hover,
			.widget_shopping_cart p.buttons a:hover,
			.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button:hover,
			.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button:focus,
			.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button:active,
			.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a.checkout:hover,
			.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a.checkout:focus,
			.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a.checkout:active,
			footer.entry-footer .read-more a:hover,
			footer.entry-footer .read-more a:focus,
			footer.entry-footer .read-more a:active,
			.edd_purchase_submit_wrapper a:hover,
			.edd_purchase_submit_wrapper a:focus,
			.edd_purchase_submit_wrapper a:active,
			.aLoader2,	
			.attesaFeatBoxContainer .attesaproFeatBoxButton a:hover,
			.attesaFeatBoxContainer .attesaproFeatBoxButton a:focus,
			.attesaFeatBoxContainer .attesaproFeatBoxButton a:active,
			.menu-full-screen-icon .icon-full-screen .square-full-screen {
				background-color: '.esc_html($generalTextColor).';
			}
			.hamburger-menu .menu__circle {
				border-color: '.esc_html($generalTextColor).';
			}
			.aLoader1 {
				border-top-color: '.esc_html($generalTextColor).';
			}
			@media all and (max-width: 1025px) {
				.main-navigation ul ul a,
				.main-navigation ul li .indicator:before {
					color: '.esc_html($generalTextColor).' !important;
				}
			}';
			/* Choose general background color */
			$generalBackgroundColor = apply_filters( 'attesa_general_background_color', attesa_options('_general_background_color', '#ffffff') );
			$attesa_custom_css .='
			.attesaLoader,
			.attesa-site-wrap,
			header.site-header.menuMinor,
			body:not(.withOverlayMenu) header.site-header,
			header.site-header .nav-middle.fixed {
				background-color: '.esc_html($generalBackgroundColor).';
			}
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			#toTop,
			.woocommerce span.onsale,
			.main-navigation ul ul a,
			.main-navigation > div > ul > li.attesaMenuButton > a,
			.main-navigation > div > ul > li.attesaMenuButton > a:hover,
			.main-navigation > div > ul > li.attesaMenuButton > a:focus,
			.main-navigation > div > ul > li.attesaMenuButton > a:active,
			.navigation.pagination .nav-links a,
			.woocommerce-pagination > ul.page-numbers li a,
			.page-links a,
			.navigation.pagination .nav-links a:hover,
			.navigation.pagination .nav-links a:focus,
			.woocommerce-pagination > ul.page-numbers li a:hover,
			.woocommerce-pagination > ul.page-numbers li a:focus,
			.page-links a:hover,
			.page-links a:focus,
			.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a.checkout,
			.woocommerce .wooImage .button,
			.woocommerce .wooImage .added_to_cart,
			.woocommerce-error li a,
			.woocommerce-message a,
			.return-to-shop a,
			.wc-proceed-to-checkout .button.checkout-button,
			.widget_shopping_cart p.buttons a,
			.woocommerce .wishlist_table td.product-add-to-cart a,
			.woocommerce .content-area .woocommerce-tabs .tabs li.active a,
			.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button,
			.woocommerce-store-notice,
			.woocommerce-store-notice a,
			.woocommerce-store-notice a:hover,
			.woocommerce-store-notice a:focus,
			.woocommerce-store-notice a:active,
			.edd_purchase_submit_wrapper a,
			ul.products li.product .tinvwl_add_to_wishlist_button,
			.woocommerce ul.products li.product a.compare,
			.attesaFeatBoxContainer .attesaproFeatBoxButton a {
				color: '.esc_html($generalBackgroundColor).';
			}
			.main-navigation ul li.attesaMenuButton .indicator:before {
				color: '.esc_html($generalBackgroundColor).' !important;
			}
			@media all and (max-width: 1025px) {
				.attesa-main-menu-container {
					background-color: '.esc_html($generalBackgroundColor).';
				}
				.main-navigation >div ul li.attesaMenuButton a,
				.main-navigation >div ul li.attesaMenuButton a:hover,
				.main-navigation >div ul li.attesaMenuButton a:focus,
				.main-navigation >div ul li.attesaMenuButton a:active {
					color: '.esc_html($generalBackgroundColor).' !important;
				}
			}';
			/* Choose alternative background color */
			$alternativeBackgroundColor = apply_filters( 'attesa_alternative_background_color', attesa_options('_alternative_background_color', '#fbfbfb') );
			$attesa_custom_css .='
			input[type="text"],
			input[type="email"],
			input[type="url"],
			input[type="password"],
			input[type="search"],
			input[type="number"],
			input[type="tel"],
			input[type="range"],
			input[type="date"],
			input[type="month"],
			input[type="week"],
			input[type="time"],
			input[type="datetime"],
			input[type="datetime-local"],
			input[type="color"],
			textarea,
			select,
			.woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single,
			header.page-header,
			.site-social-float a,	
			#comments .reply,
			.woocommerce div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger,
			.prev_next_buttons a,
			.woocommerce-message,	
			.woocommerce-info,
			.woocommerce-error,
			.woocommerce-checkout form.checkout_coupon,
			.woocommerce-checkout form.woocommerce-form-login,
			.woocommerce .woocommerce-tabs,
			.woocommerce table.shop_attributes tr th,
			.woocommerce-page .entry-content table thead th,
			.woocommerce-page .entry-content table tr:nth-child(even),
			#payment .payment_methods li,
			.attesa-pro-sharing-box-container,
			.attesa-breadcrumbs,
			.rank-math-breadcrumb,
			.attesa-main-menu-container.open_pushmenu .attesa-close-pushmenu {
				background-color: '.esc_html($alternativeBackgroundColor).';
			}
			.tagcloud a,
			footer.entry-footer .read-more a,
			.attesa-pro-sharing-box-container.style_astheme .attesa-pro-sharing-box .attesa-sharing-button a:hover,
			.attesa-pro-sharing-box-container.style_astheme .attesa-pro-sharing-box .attesa-sharing-button a:focus,
			.attesa-pro-sharing-box-container.style_astheme .attesa-pro-sharing-box .attesa-sharing-button a:active {
				color: '.esc_html($alternativeBackgroundColor).';
			}';
			/* Choose content text color */
			$contentTextColor = apply_filters( 'attesa_content_text_color', attesa_options('_content_text_color', '#828282') );
			$attesa_custom_css .='
				.entry-content,
				.entry-summary,
				.entry-meta,
				.entry-meta a,
				.entry-footer span a,
				.attesa-pro-sharing-box .attesa-sharing-button a {
					color: '.esc_html($contentTextColor).';
				}
			';
			/* Choose general border color */
			$generalBorderColor = apply_filters( 'attesa_general_border_color', attesa_options('_general_border_color', '#ececec') );
			$attesa_custom_css .='
			hr,
			#edd_purchase_submit #edd_terms_agreement #edd_terms,
			#edd_purchase_submit #edd_mailchimp #edd_terms,
			#edd_purchase_submit #edd_terms_agreement>[id*="-terms-wrap"]>[id*="_terms"]>p,
			#edd_purchase_submit #edd_mailchimp>[id*="-terms-wrap"]>[id*="_terms"]>p,
			#edd_checkout_cart .edd_cart_header_row th,
			#edd_user_history thead .edd_purchase_row th,
			#edd_sl_license_keys thead .edd_sl_license_row th,
			#edd_purchase_receipt thead th,
			#edd_purchase_receipt_products thead th,
			#edd_sl_license_sites thead th,
			body.edd-page legend,
			.site-social-widget .attesa-social {
				background-color: '.esc_html($generalBorderColor).';
			}
			input[type="text"],
			input[type="email"],
			input[type="url"],
			input[type="password"],
			input[type="search"],
			input[type="number"],
			input[type="tel"],
			input[type="range"],
			input[type="date"],
			input[type="month"],
			input[type="week"],
			input[type="time"],
			input[type="datetime"],
			input[type="datetime-local"],
			input[type="color"],
			textarea,
			select,
			.woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single,
			.site-main .comment-navigation,
			.site-main .posts-navigation,
			.site-main .post-navigation,
			.site-main .navigation.pagination,
			.site-main .woocommerce-pagination,
			.authorAbout,
			.relatedBox,
			header.page-header,	
			.site-social-float a,
			.hentry,
			#comments ol .pingback,
			#comments ol article,
			#comments .reply,
			.woocommerce ul.products > li,
			.prev_next_buttons a,
			.woocommerce-checkout form.checkout_coupon,
			.woocommerce-checkout form.woocommerce-form-login,
			body.woocommerce form.cart,
			.woocommerce .single_variation,
			.woocommerce .woocommerce-tabs,
			.woocommerce #reviews #comments ol.commentlist li .comment-text,
			.woocommerce p.stars a.star-1,
			.woocommerce p.stars a.star-2,
			.woocommerce p.stars a.star-3,
			.woocommerce p.stars a.star-4,
			.single-product div.product .woocommerce-product-rating,
			.woocommerce-page .entry-content table,
			.woocommerce-page .entry-content table thead th,
			.woocommerce-page .entry-content table td, .woocommerce-page .entry-content table th,
			#payment .payment_methods li,
			ul.woocommerce-thankyou-order-details li,
			.woocommerce-MyAccount-navigation ul li,
			fieldset,
			#edd_purchase_submit #edd_terms_agreement #edd_terms,
			#edd_purchase_submit #edd_mailchimp #edd_terms,
			#edd_purchase_submit #edd_terms_agreement>[id*="-terms-wrap"]>[id*="_terms"]>p,
			#edd_purchase_submit #edd_mailchimp>[id*="-terms-wrap"]>[id*="_terms"]>p,
			#edd_checkout_cart td,
			#edd_checkout_cart th,
			#edd_user_history td,
			#edd_user_history th,
			#edd_sl_license_keys td,
			#edd_sl_license_keys th,
			#edd_purchase_receipt td,
			#edd_purchase_receipt th,
			#edd_purchase_receipt_products td,
			#edd_purchase_receipt_products th,
			#edd_sl_license_sites td,
			#edd_sl_license_sites th,
			.edd_downloads_list .edd_download,
			.attesa-pro-sharing-box-container,
			.attesa-breadcrumbs,
			.rank-math-breadcrumb,
			.attesa-main-menu-container.open_pushmenu .attesa-close-pushmenu {
				border-color: '.esc_html($generalBorderColor).';
			}
			.star-rating:before {
				color: '.esc_html($generalBorderColor).';
			}
			@media all and (max-width: 1025px) {
				.main-navigation li,
				.main-navigation ul li .indicator,
				.main-navigation > div > ul > li > ul.sub-menu,
				.attesa-main-menu-container {
					border-color: '.esc_html($generalBorderColor).';
				}
			}';
			/* Choose top bar colors */
			if (apply_filters( 'attesa_show_top_bar', attesa_options('_show_topbar', '1'))) {
				$topbarBackgroundColor = apply_filters( 'attesa_topbar_background_color', attesa_options('_topbar_background_color', '#fbfbfb') );
				$topbarTextColor = apply_filters( 'attesa_topbar_text_color', attesa_options('_topbar_text_color', '#828282') );
				$topbarBorderColor = apply_filters( 'attesa_topbar_border_color', attesa_options('_topbar_border_color', '#ececec') );
				$attesa_custom_css .='
				.nav-top,
				.search-icon .circle,
				.search-container,
				.attesa_woocommerce_mini_cart .widget_shopping_cart_content {
					background-color: '.esc_html($topbarBackgroundColor).';
				}
				.third-navigation li.attesaMenuButton a {
					color: '.esc_html($topbarBackgroundColor).';
				}
				.nav-top,
				.attesa_woocommerce_mini_cart ul.product_list_widget li,
				.attesa_woo_cart_quantity_item .remove,
				.attesa_woocommerce_mini_cart .widget_shopping_cart_content,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a {
					border-color: '.esc_html($topbarBorderColor).';
				}
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__total {
					background-color: '.esc_html($topbarBorderColor).';
				}
				.nav-top,
				.top-block-left a,
				.top-block-left a:hover,
				.top-block-left a:focus,
				.top-block-left a:active,
				.third-navigation li a,
				.cartwoo-button .woo-cart,
				.cartedd-button .edd-cart,
				.search-icon .circle,
				.search-container input[type="search"],
				.search-container input[type="search"]:focus,
				.attesa_woocommerce_mini_cart,
				.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item h3 a,
				.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item .remove,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a,
				.top-block-left .site-social-top a {
					color: '.esc_html($topbarTextColor).';
				}
				.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item .remove:hover,
				.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item .remove:focus,
				.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item .remove:active {
					border-color: '.esc_html($topbarTextColor).';
				}
				.search-container input[type="search"]::placeholder {
					color: '.esc_html($topbarTextColor).';
				}
				.search-container input[type="search"]:-ms-input-placeholder {
					color: '.esc_html($topbarTextColor).';
				}
				.search-container input[type="search"]::-ms-input-placeholder {
					color: '.esc_html($topbarTextColor).';
				}
				.search-icon .handle,
				.search-icon .handle:after {
					background-color: '.esc_html($topbarTextColor).';
				}';
			}
			if ( is_active_sidebar( attesa_get_classic_sidebar() ) && attesa_check_bar('classic') ) {
				/* Choose classic sidebar link color */
				$classicSidebarLinkColor = apply_filters( 'attesa_classicsidebar_link_color', attesa_options('_classicsidebar_link_color', '#f06292') );
				$attesa_custom_css .='
				#secondary.widget-area .sidebar-container a,
				#secondary.widget-area .attesa-contact-info i {
					color: '.esc_html($classicSidebarLinkColor).';
				}
				#secondary.widget-area .tagcloud a,
				#secondary.widget-area button,
				#secondary.widget-area input[type="button"],
				#secondary.widget-area input[type="reset"],
				#secondary.widget-area input[type="submit"],
				#secondary.widget-area #wp-calendar > caption,
				#secondary.widget-area .attesaMenuButton,
				#secondary.widget-area .widget_price_filter .ui-slider .ui-slider-handle,
				#secondary.widget-area .widget_price_filter .ui-slider .ui-slider-range,
				#secondary.widget-area .widget_shopping_cart p.buttons a,
				#secondary.widget-area .edd_purchase_submit_wrapper a {
					background-color: '.esc_html($classicSidebarLinkColor).';
				}
				#secondary.widget-area input[type="text"]:focus,
				#secondary.widget-area input[type="email"]:focus,
				#secondary.widget-area input[type="url"]:focus,
				#secondary.widget-area input[type="password"]:focus,
				#secondary.widget-area input[type="search"]:focus,
				#secondary.widget-area input[type="number"]:focus,
				#secondary.widget-area input[type="tel"]:focus,
				#secondary.widget-area input[type="range"]:focus,
				#secondary.widget-area input[type="date"]:focus,
				#secondary.widget-area input[type="month"]:focus,
				#secondary.widget-area input[type="week"]:focus,
				#secondary.widget-area input[type="time"]:focus,
				#secondary.widget-area input[type="datetime"]:focus,
				#secondary.widget-area input[type="datetime-local"]:focus,
				#secondary.widget-area input[type="color"]:focus,
				#secondary.widget-area textarea:focus,
				#secondary.widget-area #wp-calendar tbody td#today {
					border-color: '.esc_html($classicSidebarLinkColor).';
				}';
				/* Choose classic sidebar text color */
				$classicSidebarTextColor = apply_filters( 'attesa_classicsidebar_text_color', attesa_options('_classicsidebar_text_color', '#404040') );
				$attesa_custom_css .='
				#secondary.widget-area .sidebar-container,
				#secondary.widget-area .sidebar-container a:hover,
				#secondary.widget-area .sidebar-container a:focus,
				#secondary.widget-area .sidebar-container a:active,
				#secondary.widget-area ul.product-categories li a:before,
				#secondary.widget-area input[type="text"],
				#secondary.widget-area input[type="email"],
				#secondary.widget-area input[type="url"],
				#secondary.widget-area input[type="password"],
				#secondary.widget-area input[type="search"],
				#secondary.widget-area input[type="number"],
				#secondary.widget-area input[type="tel"],
				#secondary.widget-area input[type="range"],
				#secondary.widget-area input[type="date"],
				#secondary.widget-area input[type="month"],
				#secondary.widget-area input[type="week"],
				#secondary.widget-area input[type="time"],
				#secondary.widget-area input[type="datetime"],
				#secondary.widget-area input[type="datetime-local"],
				#secondary.widget-area input[type="color"],
				#secondary.widget-area textarea,
				#secondary.widget-area input[type="text"]:focus,
				#secondary.widget-area input[type="email"]:focus,
				#secondary.widget-area input[type="url"]:focus,
				#secondary.widget-area input[type="password"]:focus,
				#secondary.widget-area input[type="search"]:focus,
				#secondary.widget-area input[type="number"]:focus,
				#secondary.widget-area input[type="tel"]:focus,
				#secondary.widget-area input[type="range"]:focus,
				#secondary.widget-area input[type="date"]:focus,
				#secondary.widget-area input[type="month"]:focus,
				#secondary.widget-area input[type="week"]:focus,
				#secondary.widget-area input[type="time"]:focus,
				#secondary.widget-area input[type="datetime"]:focus,
				#secondary.widget-area input[type="datetime-local"]:focus,
				#secondary.widget-area input[type="color"]:focus,
				#secondary.widget-area textarea:focus,
				#secondary.widget-area .attesa-contact-info a {
					color: '.esc_html($classicSidebarTextColor).';
				}
				#secondary.widget-area .tagcloud a:hover,
				#secondary.widget-area .tagcloud a:focus,
				#secondary.widget-area .tagcloud a:active,
				#secondary.widget-area button:hover,
				#secondary.widget-area input[type="button"]:hover,
				#secondary.widget-area input[type="reset"]:hover,
				#secondary.widget-area input[type="submit"]:hover,
				#secondary.widget-area button:active,
				#secondary.widget-area button:focus,
				#secondary.widget-area input[type="button"]:active,
				#secondary.widget-area input[type="button"]:focus,
				#secondary.widget-area input[type="reset"]:active,
				#secondary.widget-area input[type="reset"]:focus,
				#secondary.widget-area input[type="submit"]:active,
				#secondary.widget-area input[type="submit"]:focus,
				#secondary.widget-area .widget_shopping_cart p.buttons a:hover,
				#secondary.widget-area .widget_shopping_cart p.buttons a:focus,
				#secondary.widget-area .widget_shopping_cart p.buttons a:active,
				#secondary.widget-area .edd_purchase_submit_wrapper a:hover,
				#secondary.widget-area .edd_purchase_submit_wrapper a:focus,
				#secondary.widget-area .edd_purchase_submit_wrapper a:active {
					background-color: '.esc_html($classicSidebarTextColor).';
				}
				#secondary.widget-area input[type="search"]::placeholder {
					color: '.esc_html($classicSidebarTextColor).';
				}
				#secondary.widget-area input[type="search"]:-ms-input-placeholder {
					color: '.esc_html($classicSidebarTextColor).';
				}
				#secondary.widget-area input[type="search"]::-ms-input-placeholder {
					color: '.esc_html($classicSidebarTextColor).';
				}';
				/* Choose classic sidebar background color */
				$classicSidebarBackgroundColor = apply_filters( 'attesa_classicsidebar_background_color', attesa_options('_classicsidebar_background_color', '#fbfbfb') );
				$attesa_custom_css .='
				#secondary.widget-area .sidebar-container,
				#secondary.widget-area input[type="text"],
				#secondary.widget-area input[type="email"],
				#secondary.widget-area input[type="url"],
				#secondary.widget-area input[type="password"],
				#secondary.widget-area input[type="search"],
				#secondary.widget-area input[type="number"],
				#secondary.widget-area input[type="tel"],
				#secondary.widget-area input[type="range"],
				#secondary.widget-area input[type="date"],
				#secondary.widget-area input[type="month"],
				#secondary.widget-area input[type="week"],
				#secondary.widget-area input[type="time"],
				#secondary.widget-area input[type="datetime"],
				#secondary.widget-area input[type="datetime-local"],
				#secondary.widget-area input[type="color"],
				#secondary.widget-area textarea {
					background-color: '.esc_html($classicSidebarBackgroundColor).';
				}
				#secondary.widget-area button,
				#secondary.widget-area input[type="button"],
				#secondary.widget-area input[type="reset"],
				#secondary.widget-area input[type="submit"],
				#secondary.widget-area #wp-calendar > caption,
				#secondary.widget-area .tagcloud a,
				#secondary.widget-area .tagcloud a:hover,
				#secondary.widget-area .tagcloud a:focus,
				#secondary.widget-area .tagcloud a:active,
				#secondary.widget-area .widget_shopping_cart p.buttons a,
				#secondary.widget-area .edd_purchase_submit_wrapper a,
				#secondary.widget-area .edd_purchase_submit_wrapper a:hover,
				#secondary.widget-area .edd_purchase_submit_wrapper a:focus,
				#secondary.widget-area .edd_purchase_submit_wrapper a:active,
				#secondary.widget-area .attesaMenuButton a,
				#secondary.widget-area .attesaMenuButton a:hover,
				#secondary.widget-area .attesaMenuButton a:focus,
				#secondary.widget-area .attesaMenuButton a:active {
					color: '.esc_html($classicSidebarBackgroundColor).';
				}';
				/* Choose classic sidebar border color */
				$classicSidebarBorderColor = apply_filters( 'attesa_classicsidebar_border_color', attesa_options('_classicsidebar_border_color', '#ececec') );
				$attesa_custom_css .='
				#secondary.widget-area .sidebar-container,
				#secondary.widget-area .widget .widget-title .widgets-heading,
				#secondary.widget-area input[type="text"],
				#secondary.widget-area input[type="email"],
				#secondary.widget-area input[type="url"],
				#secondary.widget-area input[type="password"],
				#secondary.widget-area input[type="search"],
				#secondary.widget-area input[type="number"],
				#secondary.widget-area input[type="tel"],
				#secondary.widget-area input[type="range"],
				#secondary.widget-area input[type="date"],
				#secondary.widget-area input[type="month"],
				#secondary.widget-area input[type="week"],
				#secondary.widget-area input[type="time"],
				#secondary.widget-area input[type="datetime"],
				#secondary.widget-area input[type="datetime-local"],
				#secondary.widget-area input[type="color"],
				#secondary.widget-area textarea,
				#secondary.widget-area #wp-calendar tbody td,
				#secondary.widget-area fieldset {
					border-color: '.esc_html($classicSidebarBorderColor).';
				}
				#secondary.widget-area ul.menu .indicatorBar,
				#secondary.widget-area ul.product-categories .indicatorBar,
				#secondary.widget-area .widget_price_filter .price_slider_wrapper .ui-widget-content,
				#secondary.widget-area .site-social-widget .attesa-social,
				#secondary.widget-area .attesa-contact-info i {
					background-color: '.esc_html($classicSidebarBorderColor).';
				}';
			}
			if ( is_active_sidebar( attesa_get_push_sidebar() ) && attesa_check_bar('push') ) {
				/* Choose push sidebar link color */
				$pushSidebarLinkColor = apply_filters( 'attesa_pushsidebar_link_color', attesa_options('_pushsidebar_link_color', '#f06292') );
				$attesa_custom_css .='
				#tertiary.widget-area a,
				#tertiary.widget-area .attesa-contact-info i {
					color: '.esc_html($pushSidebarLinkColor).';
				}
				#tertiary.widget-area .tagcloud a,
				#tertiary.widget-area button,
				#tertiary.widget-area input[type="button"],
				#tertiary.widget-area input[type="reset"],
				#tertiary.widget-area input[type="submit"],
				#tertiary.widget-area #wp-calendar > caption,
				#tertiary.widget-area .attesaMenuButton,
				#tertiary.widget-area .widget_price_filter .ui-slider .ui-slider-handle,
				#tertiary.widget-area .widget_price_filter .ui-slider .ui-slider-range,
				#tertiary.widget-area .widget_shopping_cart p.buttons a,
				#tertiary.widget-area .edd_purchase_submit_wrapper a {
					background-color: '.esc_html($pushSidebarLinkColor).';
				}
				#tertiary.widget-area input[type="text"]:focus,
				#tertiary.widget-area input[type="email"]:focus,
				#tertiary.widget-area input[type="url"]:focus,
				#tertiary.widget-area input[type="password"]:focus,
				#tertiary.widget-area input[type="search"]:focus,
				#tertiary.widget-area input[type="number"]:focus,
				#tertiary.widget-area input[type="tel"]:focus,
				#tertiary.widget-area input[type="range"]:focus,
				#tertiary.widget-area input[type="date"]:focus,
				#tertiary.widget-area input[type="month"]:focus,
				#tertiary.widget-area input[type="week"]:focus,
				#tertiary.widget-area input[type="time"]:focus,
				#tertiary.widget-area input[type="datetime"]:focus,
				#tertiary.widget-area input[type="datetime-local"]:focus,
				#tertiary.widget-area input[type="color"]:focus,
				#tertiary.widget-area textarea:focus,
				#tertiary.widget-area #wp-calendar tbody td#today {
					border-color: '.esc_html($pushSidebarLinkColor).';
				}';
				/* Choose push sidebar text color */
				$pushSidebarTextColor = apply_filters( 'attesa_pushsidebar_text_color', attesa_options('_pushsidebar_text_color', '#909090') );
				list($rp, $gp, $bp) = sscanf($pushSidebarTextColor, '#%02x%02x%02x');
				$attesa_custom_css .='
				#tertiary.widget-area,
				#tertiary.widget-area a:hover,
				#tertiary.widget-area a:focus,
				#tertiary.widget-area a:active,
				#tertiary.widget-area ul.product-categories li a:before,
				#tertiary.widget-area input[type="text"],
				#tertiary.widget-area input[type="email"],
				#tertiary.widget-area input[type="url"],
				#tertiary.widget-area input[type="password"],
				#tertiary.widget-area input[type="search"],
				#tertiary.widget-area input[type="number"],
				#tertiary.widget-area input[type="tel"],
				#tertiary.widget-area input[type="range"],
				#tertiary.widget-area input[type="date"],
				#tertiary.widget-area input[type="month"],
				#tertiary.widget-area input[type="week"],
				#tertiary.widget-area input[type="time"],
				#tertiary.widget-area input[type="datetime"],
				#tertiary.widget-area input[type="datetime-local"],
				#tertiary.widget-area input[type="color"],
				#tertiary.widget-area textarea,
				#tertiary.widget-area input[type="text"]:focus,
				#tertiary.widget-area input[type="email"]:focus,
				#tertiary.widget-area input[type="url"]:focus,
				#tertiary.widget-area input[type="password"]:focus,
				#tertiary.widget-area input[type="search"]:focus,
				#tertiary.widget-area input[type="number"]:focus,
				#tertiary.widget-area input[type="tel"]:focus,
				#tertiary.widget-area input[type="range"]:focus,
				#tertiary.widget-area input[type="date"]:focus,
				#tertiary.widget-area input[type="month"]:focus,
				#tertiary.widget-area input[type="week"]:focus,
				#tertiary.widget-area input[type="time"]:focus,
				#tertiary.widget-area input[type="datetime"]:focus,
				#tertiary.widget-area input[type="datetime-local"]:focus,
				#tertiary.widget-area input[type="color"]:focus,
				#tertiary.widget-area textarea:focus,
				#tertiary.widget-area .close-hamburger,
				#tertiary.widget-area .attesa-contact-info a {
					color: '.esc_html($pushSidebarTextColor).';
				}
				#tertiary.widget-area .tagcloud a:hover,
				#tertiary.widget-area .tagcloud a:focus,
				#tertiary.widget-area .tagcloud a:active,
				#tertiary.widget-area button:hover,
				#tertiary.widget-area input[type="button"]:hover,
				#tertiary.widget-area input[type="reset"]:hover,
				#tertiary.widget-area input[type="submit"]:hover,
				#tertiary.widget-area button:active,
				#tertiary.widget-area button:focus,
				#tertiary.widget-area input[type="button"]:active,
				#tertiary.widget-area input[type="button"]:focus,
				#tertiary.widget-area input[type="reset"]:active,
				#tertiary.widget-area input[type="reset"]:focus,
				#tertiary.widget-area input[type="submit"]:active,
				#tertiary.widget-area input[type="submit"]:focus,
				#tertiary.widget-area .widget_shopping_cart p.buttons a:hover,
				#tertiary.widget-area .widget_shopping_cart p.buttons a:focus,
				#tertiary.widget-area .widget_shopping_cart p.buttons a:active,
				#tertiary.widget-area .close-ham-inner:before,
				#tertiary.widget-area .close-ham-inner:after,
				.nano > .nano-pane > .nano-slider,
				#tertiary.widget-area .edd_purchase_submit_wrapper a:hover,
				#tertiary.widget-area .edd_purchase_submit_wrapper a:focus,
				#tertiary.widget-area .edd_purchase_submit_wrapper a:active {
					background-color: '.esc_html($pushSidebarTextColor).';
				}
				#tertiary.widget-area input[type="search"]::placeholder {
					color: '.esc_html($pushSidebarTextColor).';
				}
				#tertiary.widget-area input[type="search"]:-ms-input-placeholder {
					color: '.esc_html($pushSidebarTextColor).';
				}
				#tertiary.widget-area input[type="search"]::-ms-input-placeholder {
					color: '.esc_html($pushSidebarTextColor).';
				}
				.nano > .nano-pane {
					background-color : rgba('.esc_html($rp).','.esc_html($gp).','.esc_html($bp).',0.3);
				}';
				/* Choose push sidebar background color */
				$pushSidebarBackgroundColor = apply_filters( 'attesa_pushsidebar_background_color', attesa_options('_pushsidebar_background_color', '#fbfbfb') );
				$attesa_custom_css .='
				#tertiary.widget-area,
				#tertiary.widget-area input[type="text"],
				#tertiary.widget-area input[type="email"],
				#tertiary.widget-area input[type="url"],
				#tertiary.widget-area input[type="password"],
				#tertiary.widget-area input[type="search"],
				#tertiary.widget-area input[type="number"],
				#tertiary.widget-area input[type="tel"],
				#tertiary.widget-area input[type="range"],
				#tertiary.widget-area input[type="date"],
				#tertiary.widget-area input[type="month"],
				#tertiary.widget-area input[type="week"],
				#tertiary.widget-area input[type="time"],
				#tertiary.widget-area input[type="datetime"],
				#tertiary.widget-area input[type="datetime-local"],
				#tertiary.widget-area input[type="color"],
				#tertiary.widget-area textarea {
					background-color: '.esc_html($pushSidebarBackgroundColor).';
				}
				#tertiary.widget-area button,
				#tertiary.widget-area input[type="button"],
				#tertiary.widget-area input[type="reset"],
				#tertiary.widget-area input[type="submit"],
				#tertiary.widget-area #wp-calendar > caption,
				#tertiary.widget-area .tagcloud a,
				#tertiary.widget-area .tagcloud a:hover,
				#tertiary.widget-area .tagcloud a:focus,
				#tertiary.widget-area .tagcloud a:active,
				#tertiary.widget-area .widget_shopping_cart p.buttons a,
				#tertiary.widget-area .edd_purchase_submit_wrapper a,
				#tertiary.widget-area .edd_purchase_submit_wrapper a:hover,
				#tertiary.widget-area .edd_purchase_submit_wrapper a:focus,
				#tertiary.widget-area .edd_purchase_submit_wrapper a:active,
				#tertiary.widget-area .attesaMenuButton a,
				#tertiary.widget-area .attesaMenuButton a:hover,
				#tertiary.widget-area .attesaMenuButton a:focus,
				#tertiary.widget-area .attesaMenuButton a:active {
					color: '.esc_html($pushSidebarBackgroundColor).';
				}';
				/* Choose push sidebar border color */
				$pushSidebarBorderColor = apply_filters( 'attesa_pushsidebar_border_color', attesa_options('_pushsidebar_border_color', '#ececec') );
				$attesa_custom_css .='
				#tertiary.widget-area,
				#tertiary.widget-area .widget .widget-title .widgets-heading,
				#tertiary.widget-area input[type="text"],
				#tertiary.widget-area input[type="email"],
				#tertiary.widget-area input[type="url"],
				#tertiary.widget-area input[type="password"],
				#tertiary.widget-area input[type="search"],
				#tertiary.widget-area input[type="number"],
				#tertiary.widget-area input[type="tel"],
				#tertiary.widget-area input[type="range"],
				#tertiary.widget-area input[type="date"],
				#tertiary.widget-area input[type="month"],
				#tertiary.widget-area input[type="week"],
				#tertiary.widget-area input[type="time"],
				#tertiary.widget-area input[type="datetime"],
				#tertiary.widget-area input[type="datetime-local"],
				#tertiary.widget-area input[type="color"],
				#tertiary.widget-area textarea,
				#tertiary.widget-area #wp-calendar tbody td,
				#tertiary.widget-area,
				#tertiary.widget-area fieldset {
					border-color: '.esc_html($pushSidebarBorderColor).';
				}
				#tertiary.widget-area ul.menu .indicatorBar,
				#tertiary.widget-area ul.product-categories .indicatorBar,
				#tertiary.widget-area .widget_price_filter .price_slider_wrapper .ui-widget-content,
				#tertiary.widget-area .site-social-widget .attesa-social,
				#tertiary.widget-area .attesa-contact-info i {
					background-color: '.esc_html($pushSidebarBorderColor).';
				}';
			}
			if ( attesa_check_bar('footer') ) {
				/* Choose footer link color */
				$footerLinkColor = apply_filters( 'attesa_footer_link_color', attesa_options('_footer_link_color', '#aeaeae') );
				$attesa_custom_css .='
				.footerArea a,
				.footerArea .attesa-contact-info i {
					color: '.esc_html($footerLinkColor).';
				}
				.footerArea .tagcloud a,
				.footerArea button,
				.footerArea input[type="button"],
				.footerArea input[type="reset"],
				.footerArea input[type="submit"],
				.footerArea #wp-calendar > caption,
				.footerArea .attesaMenuButton,
				.footerArea .widget_price_filter .ui-slider .ui-slider-handle,
				.footerArea .widget_price_filter .ui-slider .ui-slider-range,
				.footerArea .widget_shopping_cart p.buttons a,
				.footerArea .edd_purchase_submit_wrapper a {
					background-color: '.esc_html($footerLinkColor).';
				}
				.footerArea input[type="text"]:focus,
				.footerArea input[type="email"]:focus,
				.footerArea input[type="url"]:focus,
				.footerArea input[type="password"]:focus,
				.footerArea input[type="search"]:focus,
				.footerArea input[type="number"]:focus,
				.footerArea input[type="tel"]:focus,
				.footerArea input[type="range"]:focus,
				.footerArea input[type="date"]:focus,
				.footerArea input[type="month"]:focus,
				.footerArea input[type="week"]:focus,
				.footerArea input[type="time"]:focus,
				.footerArea input[type="datetime"]:focus,
				.footerArea input[type="datetime-local"]:focus,
				.footerArea input[type="color"]:focus,
				.footerArea textarea:focus,
				.footerArea #wp-calendar tbody td#today {
					border-color: '.esc_html($footerLinkColor).';
				}';
				/* Choose footer text color */
				$footerTextColor = apply_filters( 'attesa_footer_text_color', attesa_options('_footer_text_color', '#f0f0f0') );
				$attesa_custom_css .='
				.footerArea,
				.footerArea a:hover,
				.footerArea a:focus,
				.footerArea a:active,
				.footerArea ul.product-categories li a:before,
				.footerArea input[type="text"],
				.footerArea input[type="email"],
				.footerArea input[type="url"],
				.footerArea input[type="password"],
				.footerArea input[type="search"],
				.footerArea input[type="number"],
				.footerArea input[type="tel"],
				.footerArea input[type="range"],
				.footerArea input[type="date"],
				.footerArea input[type="month"],
				.footerArea input[type="week"],
				.footerArea input[type="time"],
				.footerArea input[type="datetime"],
				.footerArea input[type="datetime-local"],
				.footerArea input[type="color"],
				.footerArea textarea,
				.footerArea input[type="text"]:focus,
				.footerArea input[type="email"]:focus,
				.footerArea input[type="url"]:focus,
				.footerArea input[type="password"]:focus,
				.footerArea input[type="search"]:focus,
				.footerArea input[type="number"]:focus,
				.footerArea input[type="tel"]:focus,
				.footerArea input[type="range"]:focus,
				.footerArea input[type="date"]:focus,
				.footerArea input[type="month"]:focus,
				.footerArea input[type="week"]:focus,
				.footerArea input[type="time"]:focus,
				.footerArea input[type="datetime"]:focus,
				.footerArea input[type="datetime-local"]:focus,
				.footerArea input[type="color"]:focus,
				.footerArea textarea:focus,
				.footerArea .attesa-contact-info a {
					color: '.esc_html($footerTextColor).';
				}
				.footerArea .tagcloud a:hover,
				.footerArea .tagcloud a:focus,
				.footerArea .tagcloud a:active,
				.footerArea button:hover,
				.footerArea input[type="button"]:hover,
				.footerArea input[type="reset"]:hover,
				.footerArea input[type="submit"]:hover,
				.footerArea button:active,
				.footerArea button:focus,
				.footerArea input[type="button"]:active,
				.footerArea input[type="button"]:focus,
				.footerArea input[type="reset"]:active,
				.footerArea input[type="reset"]:focus,
				.footerArea input[type="submit"]:active,
				.footerArea input[type="submit"]:focus,
				.footerArea .widget_shopping_cart p.buttons a:hover,
				.footerArea .widget_shopping_cart p.buttons a:focus,
				.footerArea .widget_shopping_cart p.buttons a:active,
				.footerArea .edd_purchase_submit_wrapper a:hover,
				.footerArea .edd_purchase_submit_wrapper a:focus,
				.footerArea .edd_purchase_submit_wrapper a:active {
					background-color: '.esc_html($footerTextColor).';
				}
				.footerArea input[type="search"]::placeholder {
					color: '.esc_html($footerTextColor).';
				}
				.footerArea input[type="search"]:-ms-input-placeholder {
					color: '.esc_html($footerTextColor).';
				}
				.footerArea input[type="search"]::-ms-input-placeholder {
					color: '.esc_html($footerTextColor).';
				}';
				/* Choose footer background color */
				$footerBackgroundColor = apply_filters( 'attesa_footer_background_color', attesa_options('_footer_background_color', '#3f3f3f') );
				$attesa_custom_css .='
				.footerArea,
				.footerArea input[type="text"],
				.footerArea input[type="email"],
				.footerArea input[type="url"],
				.footerArea input[type="password"],
				.footerArea input[type="search"],
				.footerArea input[type="number"],
				.footerArea input[type="tel"],
				.footerArea input[type="range"],
				.footerArea input[type="date"],
				.footerArea input[type="month"],
				.footerArea input[type="week"],
				.footerArea input[type="time"],
				.footerArea input[type="datetime"],
				.footerArea input[type="datetime-local"],
				.footerArea input[type="color"],
				.footerArea textarea {
					background-color: '.esc_html($footerBackgroundColor).';
				}
				.footerArea button,
				.footerArea input[type="button"],
				.footerArea input[type="reset"],
				.footerArea input[type="submit"],
				.footerArea #wp-calendar > caption,
				.footerArea .tagcloud a,
				.footerArea .tagcloud a:hover,
				.footerArea .tagcloud a:focus,
				.footerArea .tagcloud a:active,
				.footerArea .widget_shopping_cart p.buttons a,
				.footerArea .edd_purchase_submit_wrapper a,
				.footerArea .edd_purchase_submit_wrapper a:hover,
				.footerArea .edd_purchase_submit_wrapper a:focus,
				.footerArea .edd_purchase_submit_wrapper a:active,
				.footerArea .attesaMenuButton a,
				.footerArea .attesaMenuButton a:hover,
				.footerArea .attesaMenuButton a:focus,
				.footerArea .attesaMenuButton a:active {
					color: '.esc_html($footerBackgroundColor).';
				}';
				/* Choose footer border color */
				$footerBorderColor = apply_filters( 'attesa_footer_border_color', attesa_options('_footer_border_color', '#bcbcbc') );
				$attesa_custom_css .='
				.footerArea .widget .widget-title .widgets-heading,
				.footerArea input[type="text"],
				.footerArea input[type="email"],
				.footerArea input[type="url"],
				.footerArea input[type="password"],
				.footerArea input[type="search"],
				.footerArea input[type="number"],
				.footerArea input[type="tel"],
				.footerArea input[type="range"],
				.footerArea input[type="date"],
				.footerArea input[type="month"],
				.footerArea input[type="week"],
				.footerArea input[type="time"],
				.footerArea input[type="datetime"],
				.footerArea input[type="datetime-local"],
				.footerArea input[type="color"],
				.footerArea textarea,
				.footerArea #wp-calendar tbody td,
				.footerArea fieldset {
					border-color: '.esc_html($footerBorderColor).';
				}
				.footerArea ul.menu .indicatorBar,
				.footerArea ul.product-categories .indicatorBar,
				.footerArea .widget_price_filter .price_slider_wrapper .ui-widget-content,
				.footerArea .site-social-widget .attesa-social,
				.footerArea .attesa-contact-info i {
					background-color: '.esc_html($footerBorderColor).';
				}';
			}
			if (attesa_options('_show_subfooter', '1')) {
				/* Choose sub-footer link color */
				$subfooterLinkColor = apply_filters( 'attesa_subfooter_link_color', attesa_options('_subfooter_link_color', '#9a9a9a') );
				$attesa_custom_css .='
				.footer-bottom-area a {
					color: '.esc_html($subfooterLinkColor).';
				}
				.footer-bottom-area .attesaMenuButton {
					background-color: '.esc_html($subfooterLinkColor).';
				}';
				/* Choose sub-footer text color */
				$subfooterTextColor = apply_filters( 'attesa_subfooter_text_color', attesa_options('_subfooter_text_color', '#ffffff') );
				$attesa_custom_css .='
				.footer-bottom-area,
				.footer-bottom-area a:hover,
				.footer-bottom-area a:focus,
				.footer-bottom-area a:active {
					color: '.esc_html($subfooterTextColor).';
				}';
				/* Choose sub-footer background color */
				$subfooterBackgroundColor = apply_filters( 'attesa_subfooter_background_color', attesa_options('_subfooter_background_color', '#181818') );
				$attesa_custom_css .='
				.footer-bottom-area {
					background-color: '.esc_html($subfooterBackgroundColor).';
				}
				.second-navigation li.attesaMenuButton a {
					color: '.esc_html($subfooterBackgroundColor).';
				}';
			}
		$attesa_css_output = attesa_minify_css(apply_filters( 'attesa_custom_css_style_filter', $attesa_custom_css ));
		wp_add_inline_style( 'attesa-style', $attesa_css_output );
	}
	add_action('wp_enqueue_scripts', 'attesa_custom_css_styles');
}