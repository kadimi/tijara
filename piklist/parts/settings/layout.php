<?php
/*
Title: Layout
Setting: tijara
*/

// Responsive, yes or no
piklist('field', array(
	'type' => 'select'
	,'field' => 'responsive'
	,'label' => __('Enable responsive layout')
	// ,'description' => __('')
	,'choices' => array(
		'1' => 'Yes'
		,'0' => 'No'
	)
	,'value' => '1'
));
