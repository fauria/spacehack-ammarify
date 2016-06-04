/**
 * Themify Custom Panel script to make start date required
 */
var themifyMetaBox, ThemifyRequired;

(function($){

	'use strict';

	/**
	 * Class to prevent post submission and add/remove error messages.
	 *
	 * @type {{error: {required: (*|HTMLElement)}, initialize: Function, addError: Function, removeError: Function, scrollToError: Function}}
	 */
	ThemifyRequired = {
		/**
		 * @var {object} List of possible errors.
		 */
		error: {
			required: $( '<div class="themify-error-required notice error attention">' + themifyMetaBox.required_error + '</div>' )
		},

		/**
		 * Initialize class. If any of the .themify-required fields are empty, prevent post submission
		 * and scroll edit screen to the position of the first error message.
		 */
		initialize: function() {
			var self = this;

			$( '#themify-meta-boxes' ).find( themifyMetaBox.validate.required ).addClass( 'themify-required' );

			$('body')
				.on( 'keyup input paste change propertychange', '.themify-required', function( e ){
					var $self = $(e.currentTarget);
					if ( '' === $self.val() ) {
						self.addError( $self, self.error.required );
					} else {
						self.removeError( $self, '.themify-error-required' );
					}
				} )
				.on( 'submit', '#post', function ( e ) {
					var doScroll = false;
					$( '.themify-required' ).each( function () {
						var $self = $(this);
						if ( '' === $self.val() && ! doScroll ) {
							e.preventDefault();
							$('#publish').removeClass('disabled');
							$('#publishing-action').find('.is-active').removeClass('is-active');
							self.addError( $self, self.error.required );
							doScroll = $self.offset().top - 60;
						}
					} );
					if ( doScroll ) {
						self.scrollToError( doScroll );
					}
				} );
		},

		/**
		 * Add error message to the field.
		 *
		 * @param {object} $obj Field where the error is.
		 * @param {object} $error Message to display.
		 */
		addError: function( $obj, $error ) {
			$obj.closest('.themify_field').append( $error );
		},

		/**
		 * Remove error message from a field.
		 *
		 * @param {object} $obj Field where the error should be removed.
		 * @param type
		 */
		removeError: function( $obj, type ) {
			$obj.closest('.themify_field').find( type ).remove();
		},

		/**
		 * Scroll edit screen to where the error is.
		 *
		 * @param position
		 */
		scrollToError: function( position ) {
			$('body').animate({ scrollTop: position }, 800);
		}
	};


	$(document).ready(function(){
		ThemifyRequired.initialize();
	});

})(jQuery);