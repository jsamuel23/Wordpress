( function( $ ) {

        var WidgetAdvancedTabs = function () {
            var defaultTabIndex = $('.elaet-advanced-tabs').attr('data-default-tab');

            $(".tab-links li:nth-child("+ defaultTabIndex + ")").addClass("active");
            $(".tabs-content div:nth-child("+ defaultTabIndex + ")").addClass("active");
            
            $('.tab-links li a').on('click',function(e){
                let currentAttribute = $(this).attr('href');
                // Show - Hide Tabs 
                $('.tabs-content '+ currentAttribute).show().siblings().hide();

                // Change - remove current tab to active
                $(this).parent('li').addClass('active').siblings().removeClass('active');
                e.preventDefault();
     });
    }

	$( window ).on( 'elementor/frontend/init', function () {

	elementorFrontend.hooks.addAction( 'frontend/element_ready/elaet-advanced-tabs.default', WidgetAdvancedTabs );
		
	});
} )( jQuery );

