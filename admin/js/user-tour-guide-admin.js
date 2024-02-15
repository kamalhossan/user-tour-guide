(function( $ ) {
	'use strict';

	$(function() {

		// add all steps for tour
		const utgAdminTourSteps = [
			{
				content: "This is the form where you can create user guide tour for your visitor",
				title: "Create Your User Tour",
				target: ".add_step",
				order: 1,
				group: 'utg-admin-tour',
			},
			{
				content: "This is the title of your tour, as you can create only one tour right now, you cant change the name, it will not show to your visitor, don't worry!",
				title: "Tour Name",
				target: "#tour_name",
				order: 2,
				group: 'utg-admin-tour',
			},
			{
				content: "This is the title of your tour box",
				target: "#step_title",
				title: "Step Title",
				order: 3,
				group: 'utg-admin-tour',
			},
			{
				content: "Add as much informations you can, so that user know what they can achieve with the element",
				title: "Tour Descriptions",
				target: "#step_content",
				order: 4,
				group: 'utg-admin-tour',
			},
			{
				title: "Order Your Tour",
				content: "Your all steps will be shown to user as it order",
				target: "#step_order",
				order: 5,
				group: 'utg-admin-tour',
			},
			{
				title: 'Target Your Element',
				content: "Here you need to specify the HTMLElement | Element | Class or ID from the Doc to place this tour",
				target: "#step_target",
				order: 6,
				group: 'utg-admin-tour',
			},
			{
				title: "Save Your Tour",
				content: "To save your step you need to click 'Add Step'",
				target: ".submit",
				order: 7,
				group: 'utg-admin-tour',
			},
			{
				title: 'Check your Tour',
				content: 'Once you saved your step it will appear here”.',
				target: ".your-steps",
				order: 8,
				group: 'utg-admin-tour',
			},
			{
				title: 'Start Again',
				content: 'If you want to run this tour again, just click on Begin Sample Tour',
				target: "#utg_sample",
				order: 9,
				group: 'utg-admin-tour',
			},
		];

		const adminTour = new tourguide.TourGuideClient({
			showStepProgress: false,
			showStepDots: false,
			exitOnClickOutside: false,
			// prevLabel: "Back it up",
			// nextLabel: "Forwards"
		});

		adminTour.addSteps(utgAdminTourSteps);


		$('#bugs').click(function(){
			$.ajax({
				type: 'POST',
				url: utg_admin_object.ajax_url,
				data: {
					action: 'utg_fix_bugs',
					// nonce: utg_admin_object.nonce,
				},
				success: function (response) {
					console.log(response)
				},
				error: function (error) {
					console.log(error);
				}	
			})
		})

		// $.ajax({
		// 	type: 'GET',
		// 	url: utg_admin_object.ajax_url,
		// 	data: {
		// 		action: 'utg_get_tour_data_from_db',
		// 		nonce: utg_admin_object.nonce,
		// 	},
		// 	success: function (response) {
		// 		adminTour.addSteps(response)
		// 	},
		// 	error: function (error) {
		// 		console.log(error);
		// 	}
		// });
		
        // Example: Handle click on #utg_sample
        $('#utg_sample').click(() => {
			adminTour.start('utg-admin-tour');
		})

		$('.add_step').each(function(){
			$(this).submit(function(e){
				e.preventDefault();

				const stepTitle = $(this).find('#step_title').val();
				const stepContent = $(this).find('#step_content').val();
				const stepTarget = $(this).find('#step_target').val();
				const stepOrder = $(this).find('#step_order').val();
				const tourName = $(this).find('#tour_name').val();

				$.ajax({
					type: 'POST',
					url: utg_admin_object.ajax_url,
					data: {
						action: 'utg_add_steps_to_db',
						nonce: utg_admin_object.nonce,
						stepTitle: stepTitle,
						stepContent: stepContent,
						stepTarget: stepTarget,
						stepOrder: stepOrder,
						tourName: tourName,
					},
					success: function(response){
						console.log(response);
						window.location.reload();
					},
					error: function(error){
						console.log(error);
					}
				})
			})
		})


		$('#add_new_tour').submit((e) => {
			// prevent defualt behaviour
			e.preventDefault();

			const stepTitle = $('#new_step_title').val();
			const stepContent = $('#new_step_content').val();
			const stepTarget = $('#new_step_target').val();
			const stepOrder = $('#new_step_order').val();
			const tourName = $('#new_tour_name').val();

			$.ajax({
				type: 'POST',
				url: utg_admin_object.ajax_url,
				data: {
					action: 'utg_add_steps_to_db',
					nonce: utg_admin_object.nonce,
					stepTitle: stepTitle,
					stepContent: stepContent,
					stepTarget: stepTarget,
					stepOrder: stepOrder,
					tourName: tourName,
				},
				success: function(response){
					console.log(response);
					window.location.reload();
				},
				error: function(error){
					console.log(error);
				}
			})
		})

		$('.edit_step').each(function(){
			$(this).submit(function(e){
				e.preventDefault();
				const id = $(this).attr('id');
				const editTitle = $('#step_title_' + id).val();
				const editContent = $('#step_content_' + id).val();
				const editTarget = $('#step_target_' + id).val();
				const editOrder = $('#step_order_' + id).val();

				console.log(id, editTitle, editContent, editTarget, editOrder);

				$.ajax({
					type: 'POST',
					url: utg_admin_object.ajax_url,
					data: {
						action: 'utg_edit_steps_to_db',
						nonce: utg_admin_object.nonce,
						id: id,
						stepTitle: editTitle,
						stepContent: editContent,
						stepTarget: editTarget,
						stepOrder: editOrder,
					},
					success: function(response){
						console.log(response);
						window.location.reload();
					},
					error: function(error){
						console.log(error);
					}
				})
				
			})
		})

		$('.delete').each(function(){
			$(this).click(function(e){
				const deleteId = $(this).attr('id');
				const confirmations = window.confirm('Are you sure?');
				if(confirmations){
					console.log(deleteId);
					$.ajax({
						type: 'POST',
						url: utg_admin_object.ajax_url,
						data: {
							action: 'utg_remove_steps_from_db',
							nonce: utg_admin_object.nonce,
							id: deleteId,
						},
						success: function(response){
							console.log(response);
							window.location.reload();
						},
						error: function(error){
							console.log(error);
						}
					})
				} else {
					console.log('skip')
				}
			})
		})

		$('.nav-link').each(function(){
			$(this).click(function(){
				const tabName = $(this).text();

				$.ajax({
					type: 'POST',
					url: utg_admin_object.ajax_url,
					data: {
						action: 'save_active_tab',
						nonce: utg_admin_object.nonce,
						activeTab: tabName,
					},
					success: function(response){
						console.log(response);
					},
					error: function(error){
						console.log(error);
					}
				})
			})
		})

		
		if($('.utg-admin-tour').hasClass('open')){
			$('#tourStart').modal('show');

			
		} else {
			console.log('no class')
		}

		

		$('#start-tour').click(() => {
			adminTour.start('utg-admin-tour');
		})

		$('#admin-skip').click(function(){
			$.ajax({
				type: 'POST',
				url: utg_admin_object.ajax_url,
				data:{
					action: 'utg_admin_tour_skip',
					nonce: utg_admin_object.nonce
				},
				success: function(response){
					console.log('admin tour skipped');
				},
				error : function(error){

				}
			})
		})

    });

	// check body has class or not
	


	console.log('admin plugin load');

	// Fetch all the forms we want to apply custom Bootstrap validation styles to
	var forms = document.querySelectorAll('.needs-validation')

	// Loop over them and prevent submission
	Array.prototype.slice.call(forms)
	.forEach(function (form) {
		form.addEventListener('submit', function (event) {
		if (!form.checkValidity()) {
			event.preventDefault()
			event.stopPropagation()
		}

		form.classList.add('was-validated')
		}, false)
	})

})( jQuery );
