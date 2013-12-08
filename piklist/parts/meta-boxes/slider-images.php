<?php
/*
Title: Slider Images
Post type: page,product,post
*/
piklist('field', array(
	'type' => 'file'
	,'field' => 'slider_images'
	,'scope' => 'post_meta'
	,'label' => 'Slider Image(s)'
	,'description' => 'You can upload/choose one or many images, drag & drop to reorder'
	,'options' => array(
		'title' => 'Add Image(s)'
		,'button' => 'Add Image'
	)
	, 
));
