    ( function( $ ) {

        var WidgetCounter = function () {
        $('.elaet-counter-number').each(function() {
            var startNumber = $(this).data("start-number");
            var duration = $(this).data("duration");
            $(this).prop('Counter', startNumber).animate({
                Counter: $(this).text()
            }, {
                duration: duration*1000,
                easing: 'swing',
                step: function(now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    }

    $( window ).on( 'elementor/frontend/init', function () {

    elementorFrontend.hooks.addAction( 'frontend/element_ready/elaet-counter.default', WidgetCounter );
        
    });
} )( jQuery );

