(function ($) {

	'use strict';

    $('.reprinting-apply-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'reprinting-apply-button', spinner: 'reprinting-apply-spinner', message: 'reprinting-apply-message'});
    });

    $('.password-reset-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'password-reset-button', spinner: 'password-reset-spinner', message: 'password-reset-message'});
    });

    $('.process-reset-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'process-reset-button', spinner: 'process-reset-spinner', message: 'process-reset-message'});
    });

    $('.edit-plan-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'edit-plan-button', spinner: 'edit-plan-spinner', message: 'edit-plan-message'});
    });

    $('.save-plan-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'save-plan-button', spinner: 'save-plan-spinner', message: 'save-plan-message'});
    });

    $('.add-plan-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'add-plan-button', spinner: 'add-plan-spinner', message: 'add-plan-message'});
    });

    $('.make-payment-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'make-payment-button', spinner: 'make-payment-spinner', message: 'make-payment-message'});
    });

    $('.apply-sib-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'apply-sib-button', spinner: 'apply-sib-spinner', message: 'apply-sib-message'});
    });

    $('.permission-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'permission-button', spinner: 'permission-spinner', message: 'permission-message'});
    });

    $('.resend-phone-otp-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'resend-phone-otp-button', spinner: 'resend-phone-otp-spinner', message: 'resend-phone-otp-message'});
    });

    $('.verify-phone-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'verify-phone-button', spinner: 'verify-phone-spinner', message: 'verify-phone-message'});
    });

    $('.resend-verification-form').submit('click', function() {
        event.preventDefault();
        handleForm({form: $(this), button: 'resend-verification-button', spinner: 'resend-verification-spinner', message: 'resend-verification-message'});
    });

    $('.record-plan-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'record-plan-button', spinner: 'record-plan-spinner', message: 'record-plan-message'});
    });

    $('.save-sib-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'save-sib-button', spinner: 'save-sib-spinner', message: 'save-sib-message'});
    });

    $('.edit-staff-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'edit-staff-button', spinner: 'edit-staff-spinner', message: 'edit-staff-message'});
    });

    $('.add-staff-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-staff-button', spinner: 'add-staff-spinner', message: 'add-staff-message'});
    });

    $('.admin-record-payment-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'admin-record-payment-button', spinner: 'admin-record-payment-spinner', message: 'admin-record-payment-message'});
    });

    $('.add-client-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-client-button', spinner: 'add-client-spinner', message: 'add-client-message'});
    });

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
