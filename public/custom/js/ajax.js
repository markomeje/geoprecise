(function ($) {

	'use strict';

    $('.delete-layout').on('click', function() {
        handleAjax({that: $(this), button: 'delete-layout-button', spinner: 'delete-layout-spinner'});
    });

    $('.issue-plan').on('click', function() {
        handleAjax({that: $(this), button: 'issue-plan-button', spinner: 'issue-plan-spinner'});
    });

    $('.toggle-layout-status').on('click', function() {
        handleAjax({that: $(this), button: 'toggle-layout-status-button', spinner: 'toggle-layout-status-spinner'});
    });

    $('.apply-sib').on('click', function() {
        handleAjax({that: $(this), button: 'apply-sib-button', spinner: 'apply-sib-spinner'});    
    });

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
