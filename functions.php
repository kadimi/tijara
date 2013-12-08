<?php
/**
 * carid_clone functions and definitions
 *
 * @package carid_clone
 */

/**
 * Load templates files in a way that makes them easy to override (by child themes )
 */
add_action( 'after_setup_theme', 'carid_clone_bootstrap' );
function carid_clone_bootstrap() {
	locate_template(array('includes/dependencies.php'), true, true);
	locate_template(array('includes/enqueue.php'), true, true);
	locate_template(array('includes/logo.php'), true, true);
	locate_template(array('includes/piklist.php'), true, true);
	locate_template(array('includes/slideshow.php'), true, true);
	locate_template(array('includes/social.php'), true, true);
	locate_template(array('includes/tweaks.php'), true, true);
	locate_template(array('includes/widgets.php'), true, true);
	locate_template(array('includes/woocommerce.php'), true, true);
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'carid_clone_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function carid_clone_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on carid_clone, use a find and replace
	 * to change 'carid_clone' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'carid_clone', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'carid_clone' ),
	) );

	/**
	 * Then, I (Nabil Kadimi) added the secondary menu
	 */
	register_nav_menus( array(
		'secondary_menu' => __( 'Secondary Menu', 'carid_clone' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	// add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'carid_clone_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // carid_clone_setup
add_action( 'after_setup_theme', 'carid_clone_setup' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// require get_template_directory() . '/inc/jetpack.php';

