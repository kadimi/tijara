<?php

// remove parentheses from category list and add span class to post count
add_filter('wp_list_categories','categories_postcount_filter');
function categories_postcount_filter ($variable) {
	$variable = str_replace('(', '', $variable);
	$variable = str_replace(')', '', $variable);
	return $variable;
}

// A better exerpt
add_filter('get_the_excerpt', 'trim_excerpt');
function trim_excerpt($text){
	return preg_replace('#^(.*) \[&hellip;\]$#', '$1<a href=' . get_permalink() . '>&hellip;' . __('read more', 'carid_clone') . '</a>', $text);
}
