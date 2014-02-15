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
	wp_enqueue_style( 'tijara-main-style', get_template_directory_uri() . '/css/main.css' );

	// The responsive stylesheet
	if(tijara_option('responsive')) {
		// echo 1;
		wp_enqueue_style( 'tijara-responsive-style', get_template_directory_uri() . '/css/responsive.css' );
	}

	wp_enqueue_style( 'tijara-language-style', get_template_directory_uri() . '/css/' . get_locale() . '.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'tijara-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	wp_enqueue_script( 'tijara-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ));
	wp_localize_script( 'tijara-custom', 'tijara', array('templateUrl' => get_template_directory_uri()) );

}
