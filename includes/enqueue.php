<?php
/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'tijara_enqueue' );
function tijara_enqueue() {

	// wp_enqueue_style( 'tijara-style', get_stylesheet_uri() );

	// The main stylesheet
	wp_enqueue_style( 'tijara-main', get_template_directory_uri() . '/css/main.css' );

	// The responsive stylesheet
	if( !tijara_option('disable_responsive') ) {
		wp_enqueue_style( 'tijara-responsive', get_template_directory_uri() . '/css/responsive.css' );
	}

	// Font Awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.css' );

	// Language specific style
	wp_enqueue_style( 'tijara-language', get_template_directory_uri() . '/css/' . get_locale() . '.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'tijara-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	// Nivo slider for pages, products and product categories
	if (is_page() OR get_post_type('') == 'product' OR kds_is_product_category()){
		wp_enqueue_script( 'tijara-nivo-slider', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/jquery.nivo.slider.pack.min.js', array('jquery'));
		wp_enqueue_style('tijara-nivo-slider-style', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/nivo-slider.min.css');
	}

	// JS	
	wp_enqueue_script( 'tijara-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), false, true);
	if( !tijara_option('disable_responsive') ) {
		wp_enqueue_script( 'tijara-responsive', get_template_directory_uri() . '/js/responsive.js', array( 'jquery' ), false, true);
	}
	wp_localize_script( 'tijara-main', 'tijara', array(
		'templateUrl' => get_template_directory_uri(),
		'tinyNavHeader' => __('Menu', 'tijara'),
		'tinyNavIndent' => __('&ndash; ', 'tijara'),
		'tinyNavHeader' => __('Go to...', 'tijara'),
		'disable_responsive' => (int) tijara_option(disable_responsive),
		'disable_sticky' => (int) tijara_option(disable_sticky),
	) ) ;

}

/**
 * Enqueue script for NProgress, must be first
 */
add_filter( 'wp_enqueue_scripts', 'tijara_nprogress_enqueue', 0 );

function tijara_nprogress_enqueue() {
	wp_enqueue_style( 'nprogress', get_template_directory_uri() . '/vendor/nprogress/nprogress.css' );
	wp_enqueue_script( 'nprogress', get_template_directory_uri() . '/vendor/nprogress/nprogress.js' );
}

/**
 * NProgress, inline
 */
add_action( 'wp_footer', 'tijara_nprogress_inline_enqueue' );
function tijara_nprogress_inline_enqueue() {
  if ( wp_script_is( 'jquery', 'done' ) ) {
	?><script>
		// Todo: Minify 
		NProgress.start();
		var interval = setInterval(function() { NProgress.inc(); }, 1000);
		jQuery(window).load(function(){
			clearInterval(interval);
			NProgress.done();
		});
		jQuery(window).unload(function(){
			NProgress.start();
		});
	</script><?php }
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

/**
 * Remove jQuery Migrate
 */
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );
function remove_jquery_migrate( &$scripts) {
    if ( !is_admin() ) {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
    }
}
