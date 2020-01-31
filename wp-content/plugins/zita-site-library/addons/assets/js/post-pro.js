/* global elementor */
(function ($) {

	$( document ).ready(
		function () {
			checkImageSize();
		}
	);

	$( window ).resize(
		function () {
			checkImageSize();
		}
	);

	if ( typeof elementor !== 'undefined' ) {
		$( window ).on(
			'elementor/frontend/init', function () {
                elementor.hooks.addAction(
					'panel/open_editor/widget/elaet-posts-grid', function ( panel ) {
						var $element = panel.$el.find( '.elementor-control-section_grid_image' );
						$element.click(
							function () {
								panel.$el.find( '.elementor-control-grid_image_height .elementor-control-input-wrapper' ).mouseup(
									function () {
										checkImageSize();
									}
								);
							}
						);
					}
				);
			}
		);
	}

	/**
	 * Check the container and image size.
	 */
	function checkImageSize() {
		$( '.elaet-grid .elaet-grid-col' ).each(
			function () {
				var container = $( this ).find( '.elaet-grid-col-image' ),
					containerWidth = $( this ).find( '.elaet-grid-col-image' ).width(),
					containerHeight = $( this ).find( '.elaet-grid-col-image' ).height(),
					imageWidth = $( this ).find( '.elaet-grid-col-image img' ).width(),
					imageHeight = $( this ).find( '.elaet-grid-col-image img' ).height();

				if ( $( this ).find( '.elaet-grid-col-image' ).length > 0 ) {
					if ( containerHeight > imageHeight ) {
						container.addClass( 'elaet-fit-height' );
					}

					if ( (containerWidth - imageWidth > 2) && container.hasClass( 'elaet-fit-height' ) ) {
						container.removeClass( 'elaet-fit-height' );
					}
				}
			}
		);
	}

})( jQuery );
