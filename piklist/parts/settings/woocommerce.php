<?php
/*
Title: TBA
Setting: tijara
Tab: WooCommerce
Order: 1
*/
  
piklist('field', array(
	'type' => 'checkbox'
	,'field' => 'wc_attribute_subscribable'
	,'label' => __('Subscribable product attributes', 'tijara')
	,'description' => __('Choosing an attribute here will allow users to subscribe to terms under that attribute', 'tijara')
	,'choices' => get_wc_attributes()
));
