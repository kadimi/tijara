<?php

/**
 * Set up admin pages
 */
add_filter('piklist_admin_pages', 'tijara_settings_pages');
function tijara_settings_pages($pages){
	$pages[] = array(
		'page_title'	=> 'Tijara'	// Title of page
		,'menu_title'	=> 'Tijara'				// Title of menu link
		,'capability'	=> 'manage_options'				// Minimum capability to see this page
		,'menu_slug'	=> 'tijara'				// Menu slug
		,'setting'		=> 'tijara'				// The settings name
		,'icon'			=> 'options-general'			// Menu/Page Icon
		,'save'			=> true							// show save button true/false
		,'single_line'	=> true
		,'default_tab'	=> __('Header, Sidebar & Footer', 'tijara')
	);
	return $pages;
}

// Define a getter for options
function tijara_option($option) {

	// Todo: try with static $theme_options for less DB requests

	$theme_options = get_option('tijara');

	// var_dump($theme_options); die();

	return isset($theme_options[$option]) ? $theme_options[$option] : false;
}

// Getter for first image
function tijara_get_image_URL ($image, $default = null) {
	$image = tijara_option($image);
	is_array($image) && $image = $image[0];
	if ( !empty( $image ) ) {
		$image_URL = wp_get_attachment_url( $image );	
	}
	if ($image_URL){
		return $image_URL;
	} else if ( isset($default) ) {
		return get_template_directory_uri() . '/' . $default;
	} else {
		return false;
	}
}

// Logo URL getter
function tijara_get_logo_URL ($default = 'logo.png') {
	return tijara_get_image_URL ('logo', $default);
}

// Logo URL getter
function tijara_get_background_URL () {
	return tijara_get_image_URL ('background', $default);
}

// Favicon URL getter
function tijara_get_favicon_URL ($default = 'logo.png') {
	return tijara_get_image_URL ('favicon', $default);
}

// Fix settings
add_action( 'init', 'tijara_init' );
function tijara_init() {
	add_filter( 'pre_update_option_tijara', 'tijara_repair_options', 10, 2 );
}
function tijara_repair_options( $new_value, $old_value ) {
	
	// Remove empty social links
	$new_value['social_links'] = array_filter($new_value['social_links']);

	return $new_value;
}
