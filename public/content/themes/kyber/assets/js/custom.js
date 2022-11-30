/******************
	:: Indexes
*******************

Window -> Load
:: Progress Bar

*******************
	:: Indexes
*******************/

( function($){
	"use strict"
	
	$( document ).ready( function($) {
		$( '.search-popup-modal' ).magnificPopup({
			type: 'inline',
			preloader: false,
			modal: true
		});

		$(document).on('click', '.popup-modal-dismiss, .mfp-close', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
		
		var header_offset    = $( '.header-stickable' ).offset();
		var header_position  = header_offset.top;
		var window_width     = $( window ).width();

		if ( $( 'body' ).hasClass( 'admin-bar' ) && window_width >= 992 ) {
			$( '.site-header-container' ).addClass( 'admin-bar-enabled' );
		}

		$( window ).scroll(
			function(event) {

			var current_position = $( window ).scrollTop();

			if ( current_position > header_position ) {
				$( '.header-stickable' ).addClass( 'kyber-sticky-header' );
				var offset_px = 0;
				if( $('#wpadminbar').length > 0 && (self===top) ){
					offset_px = jQuery('#wpadminbar').height();
				}
				$('.header-stickable').css('top', offset_px + "px");
			} else {
				$('.header-stickable' ).removeClass( 'kyber-sticky-header' );
				$('.header-stickable').removeAttr('style');
			}
		});
		
		$('.popup-kyber a').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
		
		$( '#primary-menu' ).slicknav({
			'label' : ' ',
			'closedSymbol': '+', 
			'openedSymbol': '-', 
			appendTo : '#site-navigation-mobile'
		});
	});

})( jQuery );