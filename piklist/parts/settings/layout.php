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
