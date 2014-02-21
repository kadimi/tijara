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
	,'field' => 'responsive'
	,'label' => __('Enable responsive layout', 'tijara')
	// ,'description' => __('')
	,'choices' => array(
		'1' => __('Yes', 'tijara')
		,'O' => __('No', 'tijara')
	)
	,'value' => '1'
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

