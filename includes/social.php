<?php

// Add social icons to posts & products
add_filter( 'the_content', 'social_icons');
add_filter( 'woocommerce_short_description', 'social_icons');
function social_icons( $content ) {

	global $post;

	if(in_array($post->post_type, array('post', 'product')))
		$content = '<div class="addthis_toolbox addthis_default_style alignright"><a class="addthis_button_preferred_1"></a><a class="addthis_button_preferred_2"></a><a class="addthis_button_preferred_3"></a><a class="addthis_button_preferred_4"></a><a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a></div><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52428f774a8770d0"></script>' . $content;

	return $content;
}
