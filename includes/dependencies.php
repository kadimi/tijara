<?php

/**
 * Require the TGM_Plugin_Activation class
 */
require_once TEMPLATEPATH . '/inc/class-tgm-plugin-activation.php';

/**
 * We require those plugins: 
 * - WooCommerce
 * - PikList
 * - Remove Fields
 */
add_action( 'tgmpa_register', 'tijara_register_required_plugins' );
function tijara_register_required_plugins () {
	$theme_text_domain = 'tijara';
	$plugins = array(
		array(
			'name' 		=> 'WooCommerce',
			'slug' 		=> 'woocommerce',
			'required' 	=> true,
		),
		array(
			'name' 		=> 'PikList',
			'slug' 		=> 'piklist',
			'required' 	=> true,
		),
	);
	$config = array('strings' => array());	
	tgmpa( $plugins, $config );
}
