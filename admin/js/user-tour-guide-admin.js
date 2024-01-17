(function( $ ) {
	'use strict';

	$(function() {
        // Your code here, within the DOM ready handler

		// add all steps gor GGSA Product Range Page
		const utgAdminTourSteps = [
			{
				content: "Find all our Curriculum, Professional Learning and School Improvement resources. Begin typing to see search suggestions.",
				title: "Welcome aboard 👋",
				target: ".create-tour",
				order: 1,
				group: 'utg-admin-tour',
			},
			{
				content: "Access all GGSA Curriculum Units categorised by Subject.",
				target: ".tour-options",
				title: "Welcome aboard 👋",
				order: 2,
				group: 'utg-admin-tour',
			},
			{
				title: "Welcome aboard 👋",
				content: "Access all GGSA Curriculum Units categorised by Subject.",
				target: ".tour-style",
				order: 3,
				group: 'utg-admin-tour',
			},
			{
				content: "Click “About” to learn more about the resources we provide for each subject, and use the search function to browse through all the available resources in a subject category.",
				target: ".tour-faq",
				order: 4,
				group: 'utg-admin-tour',
			},
			{
				content: "Click “View Details” to learn more about each specific unit within a year level. Add more units to your library by ticking the boxes on their left.<br>Click Resources to learn more about the resources available in each unit. View samples of Lesson 1, 2 and a Teaching Guide.",
				target: ".guugu-yimithirr-playschool",
				order: 5,
				group: 'utg-admin-tour',
			},
			{
				content: 'Once you’re finished selecting your resources, click “Add to Library”.',
				target: ".progress-status",
				order: 6,
				group: 'utg-admin-tour',
			},
			{
				content: 'View all the resources you’ve added from across Curriculum, Professional Learning and School Improvement. Once a unit or module is added you will see it appear here and in My Library.',
				target: ".library-container",
				order: 7,
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

		$.ajax({
			type: 'GET',
			url: utg_admin_object.ajax_url,
			data: {
				action: 'utg_get_tour_data_from_db',
				nonce: utg_admin_object.nonce,
			},
			success: function (response) {
				adminTour.addSteps(response)
			},
			error: function (error) {
				console.log(error);
			}
		});
		
        // Example: Handle click on #utg_sample
        $('#utg_sample').click(() => {
			adminTour.start('utg-admin-tour');
		})

		$('#add_step').submit((e) => {
			// prevent defualt behaviour
			// e.preventDefault();

			console.log('form submitted');

			const stepTitle = $('#step_title').val();
			const stepContent = $('#step_content').val();
			const stepTarget = $('#step_target').val();
			const stepOrder = $('#step_order').val();

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
				},
				success: function(response){
					window.location.reload();
				},
				error: function(error){
					console.log(error);
				}
			})
		})

    });

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
