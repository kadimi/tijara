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
function tijara_option($option, $default = null) {

	// Todo: try with static $theme_options for less DB requests

	$theme_options = get_option( 'tijara', array() );

	return array_key_exists( $option, $theme_options )
		? $theme_options[$option]
		: $default
	;
}

// Define defaults
function tijara_default( $option ) {
	$defaults = array(
		'topbar_plus' => 'social|cart',
	);

	return array_key_exists( $option, $defaults )
		? $defaults[$option]
		: null
	;
}

// Getter for first image
function tijara_get_image_URL ($image, $default = null) {
	$image = tijara_option($image);
	$image_URL = false;
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
	return tijara_get_image_URL ('background', '');
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

// Remove Piklist menus
add_filter( 'piklist_admin_pages', 'tijara_remove_piklist_menu' );
function tijara_remove_piklist_menu( $pages ) {
	foreach ( $pages as $page => $value ) {
		if ( 'piklist' === $value['menu_slug'] ) {
			unset( $pages[ $page ] );
		}
	}
	return $pages;  
}
