<?php

/**
 * Set up admin pages
 */
add_filter('piklist_admin_pages', 'carid_clone_settings_pages');
function carid_clone_settings_pages($pages){
	$pages[] = array(
		'page_title'	=> 'CarID clone Theme Settings'	// Title of page
		,'menu_title'	=> 'CarID clone'				// Title of menu link
		,'capability'	=> 'manage_options'				// Minimum capability to see this page
		,'menu_slug'	=> 'carid_clone'				// Menu slug
		,'setting'		=> 'carid_clone'				// The settings name
		,'icon'			=> 'options-general'			// Menu/Page Icon
		,'save'			=> true							// show save button true/false
		,'single_line'	=> false
		,'default_tab'	=> 'Basic'
	);
	return $pages;
}