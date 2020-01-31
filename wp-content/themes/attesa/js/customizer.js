/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	function convertHex(hex,opacity){
		hex = hex.replace('#','');
		r = parseInt(hex.substring(0,2), 16);
		g = parseInt(hex.substring(2,4), 16);
		b = parseInt(hex.substring(4,6), 16);

		result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
		return result;
	}

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	wp.customize( 'attesa_theme_options[_phone_number]', function( value ) {
		value.bind( function( to ) {
			$( '.top-phone .attesa-number' ).text( to );
		} );
	} );
	wp.customize( 'attesa_theme_options[_email_address]', function( value ) {
		value.bind( function( to ) {
			$( '.top-email .attesa-email' ).text( to );
		} );
	} );
	wp.customize( 'attesa_theme_options[_custom_field]', function( value ) {
		value.bind( function( to ) {
			$( '.top-custom .attesa-custom' ).text( to );
		} );
	} );
	wp.customize( 'attesa_theme_options[_read_more_text]', function( value ) {
		value.bind( function( to ) {
			$( 'footer.entry-footer .read-more span' ).text( to );
		} );
	} );
	wp.customize( 'attesa_theme_options[_woocommerce_stickybar_text]', function( value ) {
		value.bind( function( to ) {
			$( '.attesa-sticky-second .attesa-sticky-button' ).text( to );
		} );
	} );
	wp.customize( 'attesa_theme_options[_copyright_text]', function( value ) {
		value.bind( function( to ) {
			$( '.site-copy-down .site-info span.custom' ).text( to );
		} );
	} );
	/* Color js */
	wp.customize( 'attesa_theme_options[_featimage_style_posts_opacity]', function( value ) {
		value.bind( function( to ) {
			$('.attesaFeatBox .attesaFeatBoxOpacityPost').css('background-color', convertHex(to,30) );
		} );
	} );
	wp.customize( 'attesa_theme_options[_featimage_style_pages_opacity]', function( value ) {
		value.bind( function( to ) {
			$('.attesaFeatBox .attesaFeatBoxOpacityPage').css('background-color', convertHex(to,30) );
		} );
	} );
	wp.customize( 'attesa_theme_options[_woocommerce_stickybar_backcolor]', function( value ) {
		value.bind( function( to ) {
			$('.attesa-woocommerce-sticky-product').css('background-color', to );
		} );
	} );
	wp.customize( 'attesa_theme_options[_woocommerce_stickybar_textcolor]', function( value ) {
		value.bind( function( to ) {
			$('.attesa-woocommerce-sticky-product').css('color', to );
		} );
	} );
} )( jQuery );
