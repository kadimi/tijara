<?php 
	/**
	 * Prevent direct access to this file
	 */
	function_exists('tijara_option') OR die(); 
?>

<?php

	// Load images if applicable, i.e, for pages, products and product categories
	if ( is_page() OR kds_is_product() OR kds_is_product_category()	) {
		// Taxonomy archive pages are different, we will query term data
		if (kds_is_product_category()) {
			$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); 
			$term_custom = piklist('get_term_custom', $term->term_id);
			$slider_images = $term_custom['slider_images'];
		}
		// For other pages (page, product, post), we use the post meta
		else {
			$slider_images = get_post_meta($post->ID, 'slider_images', false);
		}

		// OK, let's get actual URL instead of attachment ID
		if($slider_images){
			foreach ($slider_images as $key => $value) {
				if ( !$value ) {
					unset($slider_images[$key]);
				} else {
					$slider_images[$key] = wp_get_attachment_url($value);
				}
			}
		}

		if($slider_images){
			?><div id="slider" class="nivoSlider"><?php
			foreach ($slider_images as $src)
				echo '<img src="' . $src . '" alt="" />';
			?></div><!-- #slider --><?php
		}
	} 
