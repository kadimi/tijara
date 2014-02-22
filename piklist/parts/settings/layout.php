<?php
/*
Title: Header
Setting: tijara
*/

// Logo
piklist('field', array(
	'type' => 'file'
	,'field' => 'logo'
	,'label' => __('Logo', 'tijara')
	,'options' => array(
		'button' => __('Upload or Choose Logo', 'tijara')
		,'modal_title' => __('Upload or Choose a logo', 'tijara')
	)
));

// Favicon
piklist('field', array(
	'type' => 'file'
	,'field' => 'favicon'
	,'help' => __('The rRecommanded size is 60x60', 'tijara')
	,'label' => __('Shortcut Icon (favicon)', 'tijara')
	,'options' => array(
		'button' => __('Upload or Choose a favicon', 'tijara')
		,'modal_title' => __('Upload or choose a favicon', 'tijara')
	)
));

// Logo Position
piklist('field', array(
	'type' => 'radio'
	,'field' => 'logo_position'
	,'label' => __('Logo position', 'tijara')
	,'choices' => array(
		'' => __('The header', 'tijara') /* Default */
		,'menu' => __('The primary menu (uses favicon)', 'tijara')
		,'auto' => __('Automatic', 'tijara')
		,'none' => __('Hidden', 'tijara')
	)
	,'list' => false
	, 'value' => '0'
));

// Logo Width
piklist('field', array(
	'type' => 'select'
	,'field' => 'logo_width'
	,'label' => 'Logo width (in spans)'
	,'help' => 'How many header spans (out of 12) will the logo occupy?'
	,'choices' => array(
		'1' => __('1', 'tijara')
		,'2' => __('2', 'tijara')
		,'3' => __('3 (1/4th of the header width)', 'tijara')
		,'4' => __('4 (1/3rd of the header width)', 'tijara')
		,'6' => __('6 (half the header width)', 'tijara')
		,'12' => __('12 (the full header)', 'tijara')
	)
	,'value' => '3'
));

// Responsive, yes or no
piklist('field', array(
	'type' => 'select'
	,'field' => 'disable_responsive'
	,'label' => __('Disable responsive layout', 'tijara')
	// ,'description' => __('')
	,'choices' => array(
		'O' => __('No', 'tijara')
		,'1' => __('Yes', 'tijara')
	)
	,'value' => '0'
));

// Responsive, yes or no
piklist('field', array(
	'type' => 'select'
	,'field' => 'sidebar_position'
	,'label' => __('Sidebar position', 'tijara')
	// ,'description' => __('')
	,'choices' => array(
		'before' => __('Before main content', 'tijara')
		,'after' => __('After main content', 'tijara')
	)
	,'value' => 'before'
));

