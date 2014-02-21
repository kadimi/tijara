<?php
/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'tijara_enqueue' );
function tijara_enqueue() {
	if (is_page() OR get_post_type('') == 'product' OR kds_is_product_category()){
		wp_enqueue_script( 'tijara-nivo-slider', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/jquery.nivo.slider.pack.min.js', array('jquery'));
		wp_enqueue_style('tijara-nivo-slider-style', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/nivo-slider.min.css');
	}

	// wp_enqueue_style( 'tijara-style', get_stylesheet_uri() );

	// The main stylesheet
	wp_enqueue_style( 'tijara-main', get_template_directory_uri() . '/css/main.css' );

	// Font Awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.css' );

	// The responsive stylesheet
	if( !tijara_option('noresponsive') ) {
		wp_enqueue_style( 'tijara-responsive', get_template_directory_uri() . '/css/responsive.css' );
	}

	// Language specific style
	wp_enqueue_style( 'tijara-language', get_template_directory_uri() . '/css/' . get_locale() . '.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'tijara-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	
	wp_enqueue_script( 'tijara-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), false, true);
	if( !tijara_option('noresponsive') ) {
		wp_enqueue_script( 'tijara-responsive', get_template_directory_uri() . '/js/responsive.js', array( 'jquery' ), false, true);
	}
	wp_localize_script( 'tijara-main', 'tijara', array(
		'templateUrl' => get_template_directory_uri(),
		'tinyNavHeader' => __('Menu', 'tijara'),
		'tinyNavIndent' => __('&ndash; ', 'tijara'),
		'tinyNavHeader' => __('Go to...', 'tijara'),
	) ) ;

}

/**
 * Enqueue admin script and style
 */
add_action( 'admin_init', 'tijara_enqueue_admin' );
function tijara_enqueue_admin () {
	wp_enqueue_style( 'tijara-admin-style', get_template_directory_uri() . '/css/admin.css' );
	wp_enqueue_script( 'tijara-admin-script', get_template_directory_uri() . '/js/admin.js' );
	wp_localize_script( 'tijara-admin-script', 'tijara', array(
		'useImage' => __('Use Image', 'tijara'),
	) ) ;
}

