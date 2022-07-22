(function ($) {

	'use strict';

    $('.add-document-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-document-button', spinner: 'add-document-spinner', message: 'add-document-message'});
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
