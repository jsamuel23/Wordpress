(function($) {
	"use strict";
	$(document).ready(function() {
		//FontAwesome Icon Control JS
		$('body').on('click', '.attesa-icon-list li', function(){
			var icon_class = $(this).find('i').attr('class');
			$(this).addClass('icon-active').siblings().removeClass('icon-active');
			$(this).parent('.attesa-icon-list').prev('.attesa-selected-icon').children('i').attr('class','').addClass(icon_class);
			$(this).parent('.attesa-icon-list').next('input').val(icon_class).trigger('change');
		});
		$('body').on('click', '.attesa-selected-icon', function(){
			$(this).next().slideToggle();
		});
		// Multiple checkbox control
		$( 'ul.toShowClassic li.attesaToShow input[type="checkbox"], ul.toShowPush li.attesaToShow input[type="checkbox"], ul.toShowFooter li.attesaToShow input[type="checkbox"], ul.toShowShare li.attesaToShow input[type="checkbox"], ul.toShowFooterCallout li.attesaToShow input[type="checkbox"], ul.toShowContact li.attesaToShow input[type="checkbox"]' ).on( 'change', function() {
			var checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
				function() {
					return this.value;
				}
			).get().join( ',' );
			$( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
		});
		$('ul.toShowClassic li.attesaToShow.entire input').on('click', function(){
			if ( $(this).is(':checked') ) {
				$('ul.toShowClassic .isentire input').attr('disabled', true);
				$('ul.toShowClassic .isentire').addClass('opa');
			} else {
				$('ul.toShowClassic .isentire input').attr('disabled', false);
				$('ul.toShowClassic .isentire').removeClass('opa');
			}
		});
		if ( $('ul.toShowClassic li.attesaToShow.entire input').hasClass('active') ) {
			$('ul.toShowClassic .isentire input').attr('disabled', true);
			$('ul.toShowClassic .isentire').addClass('opa');
		} else {
			$('ul.toShowClassic .isentire input').attr('disabled', false);
			$('ul.toShowClassic .isentire').removeClass('opa');
		}
		$('ul.toShowPush li.attesaToShow.entire input').on('click', function(){
			if ( $(this).is(':checked') ) {
				$('ul.toShowPush .isentire input').attr('disabled', true);
				$('ul.toShowPush .isentire').addClass('opa');
			} else {
				$('ul.toShowPush .isentire input').attr('disabled', false);
				$('ul.toShowPush .isentire').removeClass('opa');
			}
		});
		if ( $('ul.toShowPush li.attesaToShow.entire input').hasClass('active') ) {
			$('ul.toShowPush .isentire input').attr('disabled', true);
			$('ul.toShowPush .isentire').addClass('opa');
		} else {
			$('ul.toShowPush .isentire input').attr('disabled', false);
			$('ul.toShowPush .isentire').removeClass('opa');
		}
		$('ul.toShowFooter li.attesaToShow.entire input').on('click', function(){
			if ( $(this).is(':checked') ) {
				$('ul.toShowFooter .isentire input').attr('disabled', true);
				$('ul.toShowFooter .isentire').addClass('opa');
			} else {
				$('ul.toShowFooter .isentire input').attr('disabled', false);
				$('ul.toShowFooter .isentire').removeClass('opa');
			}
		});
		if ( $('ul.toShowFooter li.attesaToShow.entire input').hasClass('active') ) {
			$('ul.toShowFooter .isentire input').attr('disabled', true);
			$('ul.toShowFooter .isentire').addClass('opa');
		} else {
			$('ul.toShowFooter .isentire input').attr('disabled', false);
			$('ul.toShowFooter .isentire').removeClass('opa');
		}
		$('ul.toShowContact li.attesaToShow.entire input').on('click', function(){
			if ( $(this).is(':checked') ) {
				$('ul.toShowContact .isentire input').attr('disabled', true);
				$('ul.toShowContact .isentire').addClass('opa');
			} else {
				$('ul.toShowContact .isentire input').attr('disabled', false);
				$('ul.toShowContact .isentire').removeClass('opa');
			}
		});
		if ( $('ul.toShowContact li.attesaToShow.entire input').hasClass('active') ) {
			$('ul.toShowContact .isentire input').attr('disabled', true);
			$('ul.toShowContact .isentire').addClass('opa');
		} else {
			$('ul.toShowContact .isentire input').attr('disabled', false);
			$('ul.toShowContact .isentire').removeClass('opa');
		}
		$('body').on('click', '.customize-control-title.attesatab', function(){
			$(this).nextAll('.attesa-multiple-checkbox').slideToggle();
		});
	});
})(jQuery);