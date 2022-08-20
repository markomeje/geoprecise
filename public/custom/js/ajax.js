(function ($) {

	'use strict';

    $('.client-delete-plot').on('click', function() {
        handleAjax({that: $(this), button: 'client-delete-plot-button', spinner: 'client-delete-plot-spinner'});    
    });

    $('.make-payment').on('click', function() {
        handleAjax({that: $(this), button: 'make-payment-button', spinner: 'make-payment-spinner'});    
    });

})(jQuery);
