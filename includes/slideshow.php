<?php 
/**
 * Show Nivo-slider on pages, products and product archive pages
 */
add_action('wp_head', 'nivoSlider');
function nivoSlider() {
	if (is_page() OR get_post_type('') == 'product' OR kds_is_product_category()){
		?><script>
			jQuery(document).ready(function($){
				// strip BR elements created by Wordpress
				$('#slider .nivoSlider br').each(function(){ 
					$(this).remove();
				});
				// Initiate nivoslider
				$('.nivoSlider').nivoSlider({
					directionNav: false,
					pauseTime:7500,
					animSpeed: 1000, 
					pauseOnHover: false,
					randomStart: true 
				});
				// Remove slider controls when there is only one
				$('a.nivo-control').length == 1 && $('a.nivo-control').css('visibility', 'hidden');
				// Add the class 'has-slider' to the body classes
				$('body')
					.filter(function () {
						return $('.nivoSlider').length;
					})
					.addClass('has-slider');
			});
		</script><?php
	}
}
