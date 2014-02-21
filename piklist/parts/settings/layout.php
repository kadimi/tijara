<?php
/*
Title: Layout
Setting: tijara
*/

// Logo
piklist('field', array(
	'type' => 'file'
	,'field' => 'logo'
	,'label' => 'Logo'
	,'description' => 'Your logo will appear in the header'
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

