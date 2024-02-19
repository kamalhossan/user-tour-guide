(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(function(){

		const publicTour = new tourguide.TourGuideClient({});

		$.ajax({
			type: 'GET',
			url: utg_public_object.ajax_url,
			data: {
				action: 'utg_t',
				nonce: utg_public_object.nonce,
			},
			success: function (response) {
				const settings  = utg_public_object.setting;
				publicTour.setOptions(settings)
				if (response.length === 0) {
					$('.utg-tour-start').text('No tour found');
					$('.utg-tour-start').attr('disabled', 'disabled');
				} else if (response.length > 0) {
					const tourID = $('.utg-tour-start').attr('id');
					publicTour.addSteps(response);
					let tourFound = false
					response.forEach((e) => {
						if (tourID == e.group) {
							tourFound = true;
							return;
						}
					});
					if (!tourFound) {
						$('.utg-tour-start').text('No tour found');
						$('.utg-tour-start').attr('disabled', 'disabled');
					}
				}
				if(utg_public_object.complete){
					publicTour.start("user-tour-guide");
				}
			},
			error: function (error) {
				console.log(error);
				if(error){
					$('.utg-tour-start').text('No data');
					$('.utg-tour-start').attr('disabled', 'disabled');
				}
			}
		});

		$(document).on('click', '.utg-tour-start', function(e){
			const id = $(this).attr('id');
			publicTour.start(id);
		})

		publicTour.onAfterExit(()=>{
			// add shadow outside clikable
			// $('.tour-backdrop').remove();
			completeMeta();
		})
			
		publicTour.onFinish(()=>{
			completeMeta();
		}) 

		function completeMeta(){
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$.ajax({
				type: 'POST',
				url: utg_public_object.ajax_url,
				data: {
					action: 'utg_change_user_meta',
					nonce: utg_public_object.nonce,
				},
				success: function (response) {
					console.log(response);
				},
				error: function (error) {
					console.log(error);
				}
			});
		}
		
	});

})( jQuery );
