<?php
/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'carid_clone_enqueue' );
function carid_clone_enqueue() {
	if (is_page() OR get_post_type('') == 'product' OR is_product_category()){
		wp_enqueue_script( 'carid_clone-nivo-slider', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/jquery.nivo.slider.pack.min.js', array('jquery'));
		wp_enqueue_style('carid_clone-nivo-slider-style', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/nivo-slider.min.css');
	}

	wp_enqueue_style( 'carid_clone-style', get_stylesheet_uri() );

	wp_enqueue_style( 'carid_clone-language-style', get_template_directory_uri() . '/css/' . get_locale() . '.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'carid_clone-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	wp_enqueue_script( 'carid_clone-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ));
	wp_localize_script( 'carid_clone-custom', 'caridClone', array('templateUrl' => get_bloginfo("template_url")) );

}
