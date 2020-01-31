( function( $ ) {

	    var WidgetElaetCompareImages = function ($scope, $) {
        var image_comparison_elem     = $scope.find('.elaet-compare-images').eq(0),
            offset                    = image_comparison_elem.data('offset'),
            orientation               = image_comparison_elem.data('orientation'),
            before_label              = image_comparison_elem.data('before-label'),
            after_label               = image_comparison_elem.data('after-label'),
            hover_slider              = image_comparison_elem.data('hover-slider'),
            handle_slider             = image_comparison_elem.data('handle-slider'),
            click_slider              = image_comparison_elem.data('click-slider'),
            overlay                   = image_comparison_elem.data('overlay');
       
        image_comparison_elem.twentytwenty({
            default_offset_pct:         offset,
            orientation:                orientation,
            before_label:               before_label,
            after_label:                after_label,
            move_slider_on_hover:       hover_slider,
            move_with_handle_only:      handle_slider,
            click_to_move:              click_slider,
            no_overlay:                 overlay
        });
    };
	

	$( window ).on( 'elementor/frontend/init', function () {

	elementorFrontend.hooks.addAction( 'frontend/element_ready/elaet-compare-images.default', WidgetElaetCompareImages );
		
	});
} )( jQuery );