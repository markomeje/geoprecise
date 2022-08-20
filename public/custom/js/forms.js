(function ($) {

	'use strict';

    $('.add-client-sib-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-client-sib-button', spinner: 'add-client-sib-spinner', message: 'add-client-sib-message'});
    });

    $('.add-client-plot-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-client-plot-button', spinner: 'add-client-plot-spinner', message: 'add-client-plot-message'});
    });

    $('.survey-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'survey-button', spinner: 'survey-spinner', message: 'survey-message'});
    });

    $('.psr-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'psr-button', spinner: 'psr-spinner', message: 'psr-message'});
    });

    $('.add-plot-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-plot-button', spinner: 'add-plot-spinner', message: 'add-plot-message'});
    });

    $('.edit-plot-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'edit-plot-button', spinner: 'edit-plot-spinner', message: 'edit-plot-message'});
    });

    $('.add-layout-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-layout-button', spinner: 'add-layout-spinner', message: 'add-layout-message'});
    });

    $('.edit-layout-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'edit-layout-button', spinner: 'edit-layout-spinner', message: 'edit-layout-message'});
    });

    $('.add-document-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-document-button', spinner: 'add-document-spinner', message: 'add-document-message'});
    });

    $('.edit-document-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'edit-document-button', spinner: 'edit-document-spinner', message: 'edit-document-message'});
    });

    $('.edit-client-profile-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'edit-client-profile-button', spinner: 'edit-client-profile-spinner', message: 'edit-client-profile-message'});
    });

    $('.login-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'login-button', spinner: 'login-spinner', message: 'login-message'});
    });

    $('.signup-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'signup-button', spinner: 'signup-spinner', message: 'signup-message'});
    });

})(jQuery);
