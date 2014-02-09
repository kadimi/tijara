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
