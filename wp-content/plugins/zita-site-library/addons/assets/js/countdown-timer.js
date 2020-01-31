(function ($) {
    "use strict";	
    
	var CountDown = function ($scope, $) {
		var $coundDown           = $scope.find('.elaet-countdown-wrapper').eq(0),
		$countdown_id            = ($coundDown.data("countdown-id") !== undefined) ? $coundDown.data("countdown-id") : '',
		$expire_type             = ($coundDown.data("expire-type")  !== undefined) ? $coundDown.data("expire-type") : '',
		$expiry_text             = ($coundDown.data("expiry-text")  !== undefined) ? $coundDown.data("expiry-text") : '',
		$expiry_title			 = ($coundDown.data("expiry-title") !== undefined) ? $coundDown.data('expiry-title') : '',
		$redirect_url            = ($coundDown.data("redirect-url") !== undefined) ? $coundDown.data("redirect-url") : '',
		$template                = ($coundDown.data("template")     !== undefined) ? $coundDown.data("template") : '';
		
		jQuery(document).ready(function($) {
			'use strict';
			var countDown = $("#elaet-countdown-" + $countdown_id);
	
			countDown.countdown({
				end: function() {
					if( $expire_type == 'text'){
						countDown.html( '<div class="elaet-countdown-finish-message"><h4 class="expiry-title">' + $expiry_title + '</h4>' + '<div class="elaet-countdown-finish-text">' + $expiry_text + '</div></div>');
					}
					else if ( $expire_type === 'url'){
						var editMode = $('body').find('#elementor').length;
						if( editMode > 0 ) {
							countDown.html("Redirect URL will work only in frontend.");
						} else {
							window.location.href = $redirect_url;
						}	
					}
					else{
						//do nothing!
					}
				}
			});
		});
	}
$(window).on('elementor/frontend/init', function () {
 elementorFrontend.hooks.addAction('frontend/element_ready/elaet-countdown-clock.default', CountDown);
    });

}(jQuery));