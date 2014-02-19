jQuery(document).ready(function ($){

	// Setup fieldset trigger callback
	$(document).on('click', '.tijara_admin_fieldset_trigger', function(e) {
		e.preventDefault();
		$(this)
			.closest('.tijara_admin_fieldset')
			.find('.tijara_admin_fieldset_content')
			.slideToggle("fast")
			.parent()
			.toggleClass('expanded')
		;
	});

});