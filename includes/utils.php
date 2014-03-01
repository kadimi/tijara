<?php

// Load template files in a way that allows override by child theme
// https://codex.wordpress.org/Function_Reference/load_template
function tijara_load_template( $filename ) {
	$path = './templates/' . $filename;
	if ( $overridden_template = locate_template($path) ) {
		load_template( $overridden_template );
	} else {
		load_template(dirname(__FILE__) . $path);
	}
}

function header_social_links() {

	$social_links = tijara_option('social_links');

	if ( !is_array($social_links) ) {
		return;
	}

	/**
	 * Social sites to font icon reference
	 * 
	 * Example:
	 * $social_domains['google'] = ''
	 * 
	 * Note:
	 * If no corresponding value is found for a social site,
	 * the domain without extention will be used (e.g.: twitter, facebook...)
	 */
	$social_domains = array(
		'google' => array('google-plus', 'Google+'),
		'facebook' => array('facebook', 'Facebook'),
		'flickr' => array('flickr', 'Flickr'),
		'instagram' => array('instagram', 'Instagram'),
		'linkedin' => array('linkedin', 'LinkedIn'),
		'pinterest' => array('pinterest', 'Pinterest'),
		'skype' => array('skype', 'Skype'),
		'twitter' => array('twitter', 'Twitter'),
		'vimeo' => array('vimeo', 'Vimeo'),
		'vk' => array('vk', 'VKontakte'),
		'youtube' => array('youtube', 'YouTube'),
	);

	foreach ($social_links as $social_link) {
		// Get link domain 
		$social_domain = str_replace('www.', '', get_value(parse_url($social_link), 'host'));

		// Automatic slug
		$social_domain_no_ext = array_shift(preg_split('/(?=\.[^.]+$)/', $social_domain));

		// Slug from referece
		if( isset($social_domains[$social_domain_no_ext]) ){
			$social_slug = $social_domains[$social_domain_no_ext][0];
			$social_service = $social_domains[$social_domain_no_ext][1];
		} else {
			$social_slug =  'question-circle';
		}

		echo "<a title = \"" . sprintf(__('Follow on %s', 'tijara'), $social_service) . "\" href=\"$social_link\" ><i class=\"$social_slug fa fa-$social_slug\"></i></a> ";
	}
}

// Get value from array returned by function, compatible with PHP even if < 5.4
function get_value ($array, $key) {
	return $array[$key];
}