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
	
	$( window ).load(
		function( $ ) {
			
			/*
			 * Run Progress Bar
			 */
			
			var progressbar = function() {
				var window_position = jQuery( window ).scrollTop();
				window_position     = window_position + jQuery( window ).height();
				
				jQuery( '.kyber-progress-bar-inner' ).each( function( index ) {
					var element_position  = jQuery( this ).offset().top;
					
					if ( element_position < window_position ) {
						if ( ! jQuery( this ).parent( '.kyber-progress-bar' ).hasClass( 'bar-is-animated' ) ) {
							jQuery( this ).parent( '.kyber-progress-bar' ).addClass( 'bar-is-animated' );
							var $this = this;
							var max_value = jQuery( this ).attr( 'data-bar-value' );
							var height    = jQuery( this ).attr( 'data-bar-height' );
							var width = 1;
							var id = setInterval( frame, 14 );
							jQuery( $this ).css( 'height', height + "px" );

							function frame() {
								if ( width >= 100 ) {
									clearInterval( id );
								} else {
									if ( max_value >= width ) {
										width++;
										jQuery( $this ).css( 'width', width + "%" );	
									}
								}
							}
						}
					}
				});
			}
			
			/*
			 * Run Counter
			 */
			
			var counter = function() {
				var window_position = jQuery( window ).scrollTop();
				window_position     = window_position + jQuery( window ).height();
				
				jQuery( '.kyber-counter-wrapper .kyber-counter-number' ).each( function( index ) {
					var element_position  = jQuery( this ).offset().top;
					if ( element_position < window_position ) {
						if ( ! jQuery( this ).hasClass( 'counter-is-animated' ) ) {
							jQuery( this ).addClass( 'counter-is-animated' );
							var $this = this;
							var max_value = jQuery( this ).attr( 'data-counter-value' );

							var $this = jQuery(this);
							jQuery({ Count: 0 }).animate(
							{ 
								Count: $this.text() 
							},
							{
								duration: 2000,
								easing: 'swing',
								step: function () {
									$this.text( Math.ceil( this.Count ) );
								}
							});
						}
					}
				});
			}

			progressbar();
			counter();

			jQuery( window ).on( 'scroll', function(){
				progressbar();
				counter();
			});
			
			/*
			 * Owl carousel
			 */

			jQuery( '.owl-carousel' ).each( function() {
				var $owl_options = ( jQuery( this ).attr( 'data-owl_options' ) ) ? jQuery( this ).data( 'owl_options' ) : {};
				$owl_options.rtl = ( jQuery( 'body' ).hasClass( 'rtl' ) ) ? true : false;
				jQuery( this ).owlCarousel( $owl_options );
			});
			
			/*
			 * Magnific Popup
			 */

			jQuery( '.kyber-mfg-popup-image' ).magnificPopup({
				type: 'image'
			});
		}
	);
})( jQuery );