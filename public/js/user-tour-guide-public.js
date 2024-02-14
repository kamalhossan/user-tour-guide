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

		
		const publicTour = new tourguide.TourGuideClient({
			showStepProgress: false,
			showStepDots: false,
			exitOnClickOutside: false,
		});

		$.ajax({
			type: 'GET',
			url: utg_public_object.ajax_url,
			data: {
				action: 'utg_get_user_tour_data_from_db',
				nonce: utg_public_object.nonce,
			},
			success: function (response) {
				// console.log(response);
				if(response.length === 0){
					$('.utg-tour-start').text('No tour found');
					$('.utg-tour-start').attr('disabled', 'disabled');
				} else {
					publicTour.addSteps(response)
				}
				if(utg_public_object.complete){
					publicTour.start("user-tour-guide");
				}
			},
			error: function (error) {
				console.log(error);
			}
		});

		$('.utg-tour-start').each(function(){
			const id = $(this).attr('id');
			$(this).click(function(){
				publicTour.start(id);
			})			
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
