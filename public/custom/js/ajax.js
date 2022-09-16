(function ($) {

	'use strict';

    $('.approve-payment').on('click', function() {
        handleAjax({that: $(this), button: 'approve-payment-button', spinner: 'approve-payment-spinner'});    
    });

    $('.delete-psr').on('click', function() {
        handleAjax({that: $(this), button: 'delete-psr-button', spinner: 'delete-psr-spinner'});
    });

    $('.client-delete-plot').on('click', function() {
        handleAjax({that: $(this), button: 'client-delete-plot-button', spinner: 'client-delete-plot-spinner'});    
    });

    $('.make-payment').on('click', function() {
        handleAjax({that: $(this), button: 'make-payment-button', spinner: 'make-payment-spinner'});    
    });

})(jQuery);
