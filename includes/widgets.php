<?php
/**
 * Register widgetized area and update sidebar with default widgets
 */
add_action( 'widgets_init', 'tijara_widgets_init' );
function tijara_widgets_init() {
	register_sidebar( array(
		'name'			=> __( 'Sidebar', 'tijara' ),
		'id'			=> 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5><div class="widget-contents">',
		'after_widget'  => '</div></aside>',
	) );
	register_sidebar( array(
		'name'			=> __( 'Header Center', 'tijara' ),
		'id'			=> 'header-center',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'			=> __( 'Footer', 'tijara' ),
		'id'			=> 'footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s one-fourth">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

// if no title then add widget content wrapper to before widget
add_filter( 'dynamic_sidebar_params', 'check_sidebar_params' );
function check_sidebar_params( $params ) {
	global $wp_registered_widgets;

	$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
	$settings_1 = $settings_getter->get_settings();
	$settings_2 = $settings_1[ $params[1]['number'] ];

	if (
		$params[0]['after_widget'] == '</div></aside>' 
		&& $settings_1[2]['title'] !== $settings_1[3]['title']
		&& isset($settings_2['title']) 
		&& empty($settings_2['title']) 
		&& (
			!(
				isset($settings_2['number']) 
				|| isset($settings_2['count']) 
				|| isset($settings_2['dropdown']) 
				|| isset($settings_2['hierarchical']) 
			)
		)
	)
		$params[0][ 'before_widget' ] .= '<div class="widget-contents">';

	return $params;
}