(function ($) {

	'use strict';

    $('.update-password-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'update-password-button', spinner: 'update-password-spinner', message: 'update-password-message'});
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
