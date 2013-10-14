<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package carid_clone
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function carid_clone_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'carid_clone_jetpack_setup' );
