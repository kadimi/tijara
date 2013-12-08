<?php
/**
 * Register widgetized area and update sidebar with default widgets
 */
add_action( 'widgets_init', 'carid_clone_widgets_init' );
function carid_clone_widgets_init() {
	register_sidebar( array(
		'name'			=> __( 'Sidebar', 'carid_clone' ),
		'id'			=> 'sidebar-1',
		'before_widget' => "\n" . '<aside id="%1$s" class="widget %2$s">',
		'before_title'  => "\n\t" . '<h5 class="widget-title">',
		'after_title'   => '</h5><div class="widget-contents">',
		'after_widget'  => "\n" . '</div></aside>',
	) );
	register_sidebar( array(
		'name'			=> __( 'Header Center', 'carid_clone' ),
		'id'			=> 'header-center',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'			=> __( 'Footer', 'carid_clone' ),
		'id'			=> 'footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s one-fourth">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
