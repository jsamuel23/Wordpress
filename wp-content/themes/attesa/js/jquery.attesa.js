(function($) {
	'use strict';
	/*-----------------------------------------------------------------------------------*/
	/*  Detect Mobile Browser
	/*-----------------------------------------------------------------------------------*/
		var mobileDetect = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
	$(document).ready(function() {
		/*-----------------------------------------------------------------------------------*/
		/*  Page Loader
		/*-----------------------------------------------------------------------------------*/ 
			if ( $( '.attesaLoader' ).length ) {
				$('.attesaLoader').delay(600).fadeOut(1000);
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Sidebar Push Button
		/*-----------------------------------------------------------------------------------*/ 
			$('.hamburger-menu, .opacityBox, .close-hamburger').click(function(){
				$('.hamburger-menu, .opacityBox, body, #tertiary.widget-area').toggleClass('yesOpen');
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Search Push Button
		/*-----------------------------------------------------------------------------------*/ 
			$('.search-icon').click(function(){
				$('.search-icon, .search-container, body').toggleClass('yesOpenSearch');
				$('.search-container').fadeToggle(300);
				if (!mobileDetect) {
					$('.search-container .search-field').focus();
				}
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Set nanoscroller
		/*-----------------------------------------------------------------------------------*/ 
			function setNano() {
				if ( $( '#tertiary.widget-area' ).length ) {
					$('.nano').nanoScroller({ preventPageScrolling: true });
				}
			}
			setNano();
		/*-----------------------------------------------------------------------------------*/
		/*  Menu Widget
		/*-----------------------------------------------------------------------------------*/
			if ( $( 'aside ul.menu, aside ul.product-categories' ).length ) {
				$('aside ul.menu, aside ul.product-categories').find('li').each(function(){
					if($(this).children('ul').length > 0){
						$(this).append('<span class="indiContainer"><span class="indicatorBar"></span></div>');
					}
					$('.indiContainer').css('height', $('aside ul li').outerHeight() + 'px');
				});
				$('aside ul.menu > li.menu-item-has-children .indicatorBar, .aside ul.menu > li.page_item_has_children .indicatorBar, aside ul.product-categories > li.cat-parent .indicatorBar').click(function() {
					$(this).parents('li').find('> ul.sub-menu, > ul.children').toggleClass('yesOpenBar');
					$(this).toggleClass('yesOpenBar');
					var $self = $(this).parents('li');
					if($self.find('> ul.sub-menu, > ul.children').hasClass('yesOpenBar')) {
						$self.find('> ul.sub-menu, > ul.children').slideDown(300);
					} else {
						$self.find('> ul.sub-menu, > ul.children').slideUp(200);
					}
				});
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Mobile Menu
		/*-----------------------------------------------------------------------------------*/ 
			if ($( window ).width() <= 1025) {
				$('.main-navigation').find('li').each(function(){
					if($(this).children('ul').length > 0){
						$(this).append('<span class="indicator"></span>');
					}
				});
				$('.main-navigation ul > li.menu-item-has-children .indicator, .main-navigation ul > li.page_item_has_children .indicator').click(function() {
					$(this).parent().find('> ul.sub-menu, > ul.children').toggleClass('yesOpen');
					$(this).toggleClass('yesOpen');
					var $self = $(this).parent();
					if($self.find('> ul.sub-menu, > ul.children').hasClass('yesOpen')) {
						$self.find('> ul.sub-menu, > ul.children').slideDown(300);
					} else {
						$self.find('> ul.sub-menu, > ul.children').slideUp(200);
					}
				});
			}
			$(window).resize(function() {
				if ($( window ).width() > 1025) {
					$('.main-navigation ul > li.menu-item-has-children, .main-navigation ul > li.page_item_has_children').find('> ul.sub-menu, > ul.children').slideDown(300);
				}
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Open/Close menu
		/*-----------------------------------------------------------------------------------*/ 
			if ($('body').hasClass('mobile_menu_pushmenu')) {
				$('.format_compat .subHead .menu-toggle, .format_featuredtitle .subHead .menu-toggle, .attesa-close-pushmenu, .opacityMenu, .subHead.attesa-elementor-menu .menu-toggle').click(function() {
					$('.attesa-main-menu-container, .opacityMenu').toggleClass('menuOpen');
				});
			} else {
				$('.format_compat .subHead .menu-toggle, .format_featuredtitle .subHead .menu-toggle, .subHead.attesa-elementor-menu .menu-toggle').click(function() {
					$('.attesa-main-menu-container').slideToggle('fast');
				});
			}
			$('#top-navigation .menu-toggle-top').click(function() {
				$('.third-navigation div > ul').slideToggle('fast');
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Open/Close popup format menu
		/*-----------------------------------------------------------------------------------*/ 
			$('.menu-full-screen-icon').click(function() {
				
				if ($('.attesa-main-menu-full-screen').hasClass('yesOpenPopupMenu')) {
					$('.attesa-main-menu-full-screen, body').removeClass('yesOpenPopupMenu');
					$('html').removeClass('overflowpopup');
				} else {
					$('.attesa-main-menu-full-screen, body').addClass('yesOpenPopupMenu');
					$('html').addClass('overflowpopup');
				}
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Sccroll to section
		/*-----------------------------------------------------------------------------------*/ 
			$('ul.menu a[href*="#"]:not([href="#"])').click(function() {
				if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
				  var target = $(this.hash);
				  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				  if (target.length) {
					$('html, body').animate({
					  scrollTop: target.offset().top - 60
					}, 1000);
					if ($('body').hasClass('mobile_menu_pushmenu')) {
						$('.attesa-main-menu-container, .opacityMenu').removeClass('menuOpen');
					} else if ($('body').hasClass('mobile_menu_dropdown')) {
						$('.attesa-main-menu-container').hide('fast');
					} else {
						$('.attesa-main-menu-full-screen, body').removeClass('yesOpenPopupMenu');
						$('html').removeClass('overflowpopup');
					}
					return false;
				  }
				}
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Scroll To Top
		/*-----------------------------------------------------------------------------------*/ 
			if ( $( '#toTop' ).length ) {
				if (!mobileDetect || $('#toTop').hasClass('scrolltop_on') ) {
					$(window).scroll(function(){
						if ($(this).scrollTop() > 700) {
							$('#toTop').addClass('visible');
						} 
						else {
							$('#toTop').removeClass('visible');
						}
					}); 
					$('#toTop').click(function(){
						$('html, body').animate({ scrollTop: 0 }, 1000);
						return false;
					});
				}
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Menu Fixed
		/*-----------------------------------------------------------------------------------*/ 
			function setMenu() {
				if ( (!mobileDetect && $('header.site-header').hasClass('withSticky')) || (mobileDetect && $('header.site-header').hasClass('yesMobile')) ) {
					$('header.site-header').addClass('fixed');
					if ($('body').is('.headerFeatImage, .attesa-full-width') ) {
						if ($('body').hasClass('withOverlayMenu') ) {
							$('.attesaFeatBox, body.attesa-full-width #content.site-content').css('margin-top', $('.nav-top').outerHeight() + 'px');
						} else {
							$('.attesaFeatBox, body.attesa-full-width #content.site-content').css('margin-top', $('header.site-header').outerHeight() + 'px');
						}
					} else {
						$('#content.site-content').css('margin-top', $('header.site-header').outerHeight() + 'px');
					}
					var $filter = $('header.site-header'),
						$topHeight = $('.nav-top').outerHeight();
					if ($filter.size()) {
						$(window).scroll(function () {
							if (!$filter.hasClass('menuMinor') && $(window).scrollTop() > 0 ) {
								$filter.addClass('menuMinor');
								if ($filter.hasClass('topbarscrollhide')) {
									$filter.css( 'margin-top', '-' + $topHeight + 'px' );
								}
								$('body').addClass('menuMinor');
							} else if ($filter.hasClass('menuMinor') && $(window).scrollTop() <= 0 ) {
								$filter.removeClass('menuMinor');
								$('body').removeClass('menuMinor');
								$filter.css( 'margin-top', '0px' );
							}
						});
					}
				} else if ($('body').is('.headerFeatImage, .attesa-full-width') && $('body').hasClass('withOverlayMenu')) { 
					$('header.site-header').addClass('relative');
					$('.attesaFeatBox, body.attesa-full-width #content.site-content').css('top', '-' + $('.nav-middle').outerHeight() + 'px');
				}
			}
			function setMenuTitle() {
				var $middleleTopHeight = $('.nav-middle-top-title').outerHeight(),
					$menuTopHeight = $('.nav-middle').outerHeight(),
					$allTopDiv = $menuTopHeight + $middleleTopHeight;
				if ( (!mobileDetect && $('header.site-header').hasClass('withSticky')) || (mobileDetect && $('header.site-header').hasClass('yesMobile')) ) {
					$('.nav-middle.format_featuredtitle').addClass('mobileFixed');
					var $filter = $('header.site-header'),
						$filterMenu = $('.nav-middle'),
						$filterTop = $('.nav-top'),
						$topHeight = $('.nav-top').outerHeight(),
						$filterSpacer = $('<div />', {
							'class': 'filter-drop-spacer',
							'height': $filterMenu.outerHeight()
						}),
						$filterSpacerTop = $('<div />', {
							'class': 'filter-drop-spacer-top',
							'height': $filterTop.outerHeight()
						});
						if ($filter.hasClass('topbarscrollshow')) {
							var $ifHeightTop = $topHeight;
						} else {
							var $ifHeightTop = 0;
						}
					if ($('body').is('.headerFeatImage, .attesa-full-width') ) {
						if ($('body').hasClass('withOverlayMenu') ) {
							$('.attesaFeatBox, body.attesa-full-width #content.site-content').css('margin-top', '-' + $allTopDiv + 'px');
						}
					}
					if ($filterMenu.size()) {
						$(window).scroll(function () {
							if ($filter.hasClass('topbarscrollshow') && $(window).scrollTop() > $filterTop.offset().top ) {
								$filterTop.addClass('fixed');
								$filterTop.before($filterSpacerTop);
							} else if ($filter.hasClass('topbarscrollshow') && $(window).scrollTop() <= $filterSpacerTop.offset().top ) {
								$filterSpacerTop.remove();
								$filterTop.removeClass('fixed');
							} else if (!$filter.hasClass('menuMinor') && $(window).scrollTop() + $ifHeightTop > $filterMenu.offset().top ) {
								$filterMenu.addClass('fixed');
								if ($filter.hasClass('topbarscrollshow')) {
									$filterMenu.css('top', $topHeight + 'px');
								}
								$filterMenu.addClass('menuMinor');
								$filter.addClass('menuMinor');
								$filterMenu.before($filterSpacer);
							} else if ($filter.hasClass('menuMinor') && $(window).scrollTop() + $ifHeightTop <= $filterSpacer.offset().top ) {
								$filterMenu.removeClass('fixed');
								$filterMenu.removeClass('menuMinor');
								$filter.removeClass('menuMinor');
								$filterSpacer.remove();
								$filterMenu.css( 'top', '0px' );
							}
						});
					}
				} else if ($('body').is('.headerFeatImage, .attesa-full-width') && $('body').hasClass('withOverlayMenu')) { 
					$('.attesaFeatBox, body.attesa-full-width #content.site-content').css('margin-top', '-' + $allTopDiv + 'px');
				}
			}
			if ( $( '.nav-middle-top-title' ).length ) {
				setMenuTitle();
			} else {
				setMenu();
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Set resize
		/*-----------------------------------------------------------------------------------*/ 
			$(window).resize(function() {
				setNano();
				if ( $( '.nav-middle-top-title' ).length ) {
					setMenuTitle();
				} else {
					setMenu();
				}
			});
	});
	$(window).load(function() {
		/*-----------------------------------------------------------------------------------*/
		/*  Sticky woocommerce bar
		/*-----------------------------------------------------------------------------------*/ 
		if ( $( '.attesa-woocommerce-sticky-product' ).length ) {
			$(window).scroll(function () {
				var d = $('.woocommerce .content-area .summary').offset().top - $('header.site-header').outerHeight(),
					z = $('.woocommerce .content-area .summary').height(),
					y = $('.footer-bottom-area').offset().top,
					wS = $(window).scrollTop(),
					wH = $(window).height();
				if ( wS >= d + z && wS < (y-wH) ) {
					$('.attesa-woocommerce-sticky-product').addClass('slideInUp');
					$('.attesa-woocommerce-sticky-product').removeClass('slideOutDown');
				} else {
					$('.attesa-woocommerce-sticky-product').removeClass('slideInUp');
					$('.attesa-woocommerce-sticky-product').addClass('slideOutDown');
				}
			});
			$('.attesa-woocommerce-sticky-product .attesa-sticky-button').click(function(){
				$('html,body').animate({ scrollTop: $('.woocommerce div.product').offset().top - $('header.site-header').outerHeight() - 30 }, 500);
				return false;
			});
		}
	});
})(jQuery);