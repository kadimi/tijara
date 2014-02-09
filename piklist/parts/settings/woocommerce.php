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
	,'label' => __('Subscribable product attributes')
	,'description' => __('Choosing an attribute here will allow users to subscribe to terms under that attribute')
	,'choices' => get_wc_attributes()
));
