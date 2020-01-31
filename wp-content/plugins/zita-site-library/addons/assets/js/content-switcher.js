( function( $ ) {

	/**
	 * Radio Button Switcher JS Function.
	 *
	 */
	var WidgetelaetContentToggleHandler = function( $scope, $ ) {
		if ( 'undefined' == typeof $scope ) {
			return;
		}
		var $this           = $scope.find( '.elaet-th-wrapper' );
		var node_id 		= $scope.data( 'id' );
		var th_section_1   = $scope.find( ".elaet-th-section-1" );
		var th_section_2   = $scope.find( ".elaet-th-section-2" );
		var main_btn        = $scope.find( ".elaet-main-btn" );
		var switch_type     = $( main_btn ).attr( 'data-switch-type' );
		var current_class;

		switch ( switch_type ) {
			case 'round_1':
				current_class = '.elaet-switch-round-1';
				break;
			case 'round_2':
				current_class = '.elaet-switch-round-2';
				break;
			case 'capsule':
				current_class = '.elaet-switch-capsule';
				break;
			case 'rectangle':
				current_class = '.elaet-switch-rectangle';
				break;
			case 'oval_label_box':
				current_class = '.elaet-switch-oval-label-box';
				break;
			case 'label_box':
				current_class = '.elaet-switch-label-box';
				break;
			
			default:
				current_class = 'No Class Selected';
				break;
		}

		var th_switch      = $scope.find( current_class );

		if( $( th_switch ).is( ':checked' ) ) {
			$( th_section_1 ).hide();
		} else {
			$( th_section_2 ).hide();
		}

		$( th_switch ).click(function(){
	        $( th_section_1 ).toggle();
	        $( th_section_2 ).toggle();
	    });
	};

	

	$( window ).on( 'elementor/frontend/init', function () {

	elementorFrontend.hooks.addAction( 'frontend/element_ready/content-switcher.default', WidgetelaetContentToggleHandler );
		
	});
} )( jQuery );
