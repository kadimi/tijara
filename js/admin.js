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

	// Set image for widgets
	$(document).on('click', "[id^='widget-'][id$='-image']", function(e) { 

		// Define the model
		kds_media_frame = wp.media.frames.kds_media_frame = wp.media({
			trigger: e.target,
			library: {type: 'image'},
			title: $(this).attr('title'),
			button: { 
				text: tijara.useImage
			},
			multiple: false
		});
	 
		// When an image is selected, run a callback.
		kds_media_frame.on( 'select', function(e) {

			// We set multiple to false so only get one image from the uploader
			attachment = kds_media_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			$(kds_media_frame.options.trigger)
				.val(attachment.url)
				.change()
			;
			
		});

		// Finally, open the modal
		kds_media_frame.open();

	});

	// Show the widget image if set
	$(document).on("change", "[id^='widget-'][id$='-image']", function(e) { 
			
		var $this = $(e.target);
		
		// Remove any previously generated image for this widgets
		$this
			.siblings('.tijara_admin_widget_image')
			.remove()
		;

		// Hide fields with URL and generate image tag
		$this.val() && $this
			.prop('type', 'hidden')
			.after('<img src="' + $this.val() + '" class="tijara_admin_widget_image" /> <div  class="tijara_admin_widget_image_delete"><a href="#" >remove</a></div>')
		;

	});
	
	// Change all at least once
	$("[id^='widget-'][id$='-image']").change();

	// Remove image
	$(document).on('click', ".tijara_admin_widget_image_delete", function(e) { 
		var $this = $(e.target);
		$this
			.parent()
			.siblings('.tijara_admin_widget_image')
			.remove();
		;
		$this
			.parent()
			.siblings('input')
			.prop('type', 'input')
			.val('')
		;
		$this.remove();
	});

	// Expand all widget holders by default
	$('.widgets-holder-wrap').removeClass('closed');

});