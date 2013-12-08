<?php
/*
Title: Slider Images
Taxonomy: product_cat
*/
piklist('field', array(
  'type' => 'file'
  ,'field' => 'slider_images'
  ,'label' => 'Slider Image(s)'
  ,'description' => 'You can upload/choose one or many images, drag & drop to reorder'
  ,'options' => array(
    'title' => 'Add Image(s)'
    ,'button' => 'Add Image'
  )
));
