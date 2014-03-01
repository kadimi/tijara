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
		'button' => __('Upload or choose logo', 'tijara')
		,'modal_title' => __('Upload or choose a logo', 'tijara')
	)
));

// Favicon
piklist('field', array(
	'type' => 'file'
	,'field' => 'favicon'
	,'help' => __('The rRecommanded size is 60x60', 'tijara')
	,'label' => __('Shortcut Icon (favicon)', 'tijara')
	,'options' => array(
		'button' => __('Upload or choose a favicon', 'tijara')
		,'modal_title' => __('Upload or choose a favicon', 'tijara')
	)
));

// Logo Position
piklist('field', array(
	'type' => 'radio'
	,'field' => 'logo_position'
	,'label' => __('Logo position', 'tijara')
	,'choices' => array(
		'' => __('Automatic', 'tijara')
		,'header' => __('The header', 'tijara') /* Default */
		,'menu' => __('The primary menu (uses favicon)', 'tijara')
		,'none' => __('Hidden', 'tijara')
	)
	,'list' => false
	, 'value' => ''
));

// Logo Width
piklist('field', array(
	'type' => 'select'
	,'field' => 'logo_width'
	,'label' => 'Logo width (in spans)'
	,'help' => 'How many header spans (out of 12) will the logo occupy?'
	,'choices' => array(
		'1' => '1'
		,'2' => '2'
		,'3' => __('3 (1/4th of the header width)', 'tijara')
		,'4' => __('4 (1/3rd of the header width)', 'tijara')
		,'6' => __('6 (half the header width)', 'tijara')
		,'12' => __('12 (the full header)', 'tijara')
	)
	,'value' => '3'
));

// Top bar menu
piklist('field', array(
	'type' => 'radio'
	,'field' => 'topbar_menu'
	,'label' => __('Show top bar menu', 'tijara')
	,'choices' => array(
		'1' => __('Yes', 'tijara')
		,'0' => __('No', 'tijara')
	)
	,'list' => false
	,'value' => '1'
));

// Top bar content
piklist('field', array(
	'type' => 'radio'
	,'field' => 'topbar_plus'
	,'label' => __('Top additionnal components', 'tijara')
	,'choices' => array(
		'cart' => __('Cart', 'tijara')
		,'social' => __('Social icons', 'tijara')
		,'cart|social' => __('Cart then social icons', 'tijara')
		,'social|cart' => __('Social then cart icons', 'tijara')
	)
	,'list' => false
));

// Main menu width
piklist('field', array(
	'type' => 'radio'
	,'field' => 'menu_width'
	,'label' => __('Main menu width', 'tijara')
	,'choices' => array(
		'normal' => __('Normal', 'tijara')
		,'wide' => __('Wide (fit page)', 'tijara')
	)
	,'list' => false
	,'value' => 'normal'
));

// Sticky
piklist('field', array(
	'type' => 'checkbox'
	,'field' => 'sticky'
	,'label' => __('Enable sticky', 'tijara')
	,'choices' => array(
		'topbar' => __('Top bar', 'tijara')
		,'menu' => __('Main menu', 'tijara')
	)
	,'list' => false
	,'value' => 'menu'
));

// Responsive, yes or no
piklist('field', array(
	'type' => 'radio'
	,'field' => 'disable_responsive'
	,'label' => __('Disable responsive layout', 'tijara')
	// ,'description' => __('')
	,'choices' => array(
		'1' => __('Yes', 'tijara')
		,'0' => __('No', 'tijara')
	)
	,'list' => false
	,'value' => '0'
));

// Boxed 
piklist('field', array(
	'type' => 'radio'
	,'field' => 'boxed'
	,'label' => __('Use boxed layout', 'tijara')
	// ,'description' => __('')
	,'choices' => array(
		'1' => __('Yes', 'tijara')
		,'0' => __('No', 'tijara')
	)
	,'list' => false
	,'value' => '0'
));

// Boxed > background
piklist('field', array(
	'type' => 'file'
	,'field' => 'background'
	,'label' => __('Website background image', 'tijara')
	,'options' => array(
		'button' => __('Upload or choose a background image', 'tijara')
		,'modal_title' => __('Upload or choose a background image', 'tijara')
	)
	,'conditions' => array(
		array(
			'field' => 'boxed'
			,'value' => '1'
		)
	)
));

// Boxed > background > style
piklist('field', array(
	'type' => 'select'
	,'field' => 'background_style'
	,'label' => __('Background image style', 'tijara')
	,'choices' => array(
		'repeat' => __('Repeat', 'tijara')
		,'repeat-x' => __('Repeat horizontaly (repeat-x)', 'tijara')
		,'repeat-y' => __('Repeat verticaly (repeat-y)', 'tijara')
		,'stretch' => __('Stretch', 'tijara')
	)
	,'conditions' => array(
		array(
			'field' => 'boxed'
			,'value' => '1'
		)
	)
	,'value' => 'repeat'
));

// Responsive, yes or no
piklist('field', array(
	'type' => 'radio'
	,'field' => 'sidebar_position'
	,'label' => __('Sidebar position', 'tijara')
	// ,'description' => __('')
	,'choices' => array(
		'before' => __('Before main content', 'tijara')
		,'after' => __('After main content', 'tijara')
	)
	,'list' => false
	,'value' => 'before'
));

// Socials links
piklist('field', array(
	'type' => 'text'
	,'field' => 'social_links'
	,'add_more' => true
	,'columns' => 12
	,'help' => 'Tijara will automatically use the right icon when displaying the link'
	,'label' => 'Social links'
	,'attributes' => array(
		'label' => 'eg. https://www.facebook.com/tijara'
		,'placeholder' => 'eg. https://www.facebook.com/tijara'
	),
	'list' => false
));
