<?php
/*
Title: Layout
Setting: tijara
*/

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
