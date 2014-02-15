<?php

/**
 * Set up admin pages
 */
add_filter('piklist_admin_pages', 'tijara_settings_pages');
function tijara_settings_pages($pages){
	$pages[] = array(
		'page_title'	=> 'Tijara Theme Settings'	// Title of page
		,'menu_title'	=> 'Tijara'				// Title of menu link
		,'capability'	=> 'manage_options'				// Minimum capability to see this page
		,'menu_slug'	=> 'tijara'				// Menu slug
		,'setting'		=> 'tijara'				// The settings name
		,'icon'			=> 'options-general'			// Menu/Page Icon
		,'save'			=> true							// show save button true/false
		,'single_line'	=> false
		,'default_tab'	=> 'Basic'
	);
	return $pages;
}

// Define a getter for options
function tijara_option($option) {
	$theme_options = get_option('tijara');
	if(isset($theme_options[$option])){
		return $theme_options[$option];
	}
}

// Logo URL getter
function tijara_get_logo_URL ($default = 'logo.png') {
	$logo = tijara_option('logo');
	if ( !empty( $logo[0] ) ) {
		$logo_URI = wp_get_attachment_url( $logo[0] );	
	}
	if ($logo_URI){
		return $logo_URI;
	} else {
		return get_template_directory_uri() . '/' . $default;
	}
	
}