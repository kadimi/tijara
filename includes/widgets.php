<?php
/**
 * Register widgetized area and update sidebar with default widgets
 */
add_action( 'widgets_init', 'tijara_widgets_init' );
function tijara_widgets_init() {
	register_sidebar( array(
		'name'			=> __( 'Header Center', 'tijara' ),
		'id'			=> 'header-center',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'			=> __( 'Sidebar', 'tijara' ),
		'id'			=> 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5><div class="widget-contents">',
		'after_widget'  => '</div></aside>',
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

function force_widget_title($title) {
    return !$title ? '<span class="generated">&nbsp;</span>' : $title;
}
add_filter('widget_title', force_widget_title);

// if no title then add widget content wrapper to before widget
//add_filter( 'dynamic_sidebar_params', 'check_sidebar_params' );
function check_sidebar_params( $params ) {
	global $wp_registered_widgets;
	$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
	$settings_1 = $settings_getter->get_settings();
	$settings_2 = $settings_1[ $params[1]['number'] ];

	if (
		$params[0]['after_widget'] == '</div></aside>' 
		&& isset($settings_1[3]['title']) 
		&& empty($settings_1[3]['title'])
	)
	$params[0][ 'before_widget' ] .= '<div class="widget-contents">';

	return $params;
}

/**
 * Add Widget options
 */
//Add input fields(priority 5, 3 parameters)
add_action('in_widget_form', 'tijara_in_widget_form',5,3);
//Callback function for options update (priorität 5, 3 parameters)
add_filter('widget_update_callback', 'tijara_in_widget_form_update',5,3);
//add class names (default priority, one parameter)
add_filter('dynamic_sidebar_params', 'tijara_dynamic_sidebar_params');

function tijara_in_widget_form($t, $return, $instance){

	$instance = wp_parse_args( (array) $instance, array( 
		'alignment' => '', /* (none), left, right, center */
		'collapse' => '', /* (expanded), collapsed, nocollapse */
	) );

	if ( !isset($instance['alignment']) ){
		$instance['alignment'] = null;
	}

	if ( !isset($instance['classes']) ) {
		$instance['classes'] = null;
	}

	if ( !isset($instance['image']) ) {
		$instance['image'] = null;
	} ?>

	<fieldset class="tijara_admin_fieldset">
		<legend><a href="#" class="tijara_admin_fieldset_trigger" ><?php _e('Additional options', 'tijara'); ?></a></legend>
		<div class="tijara_admin_fieldset_content">
			<p>
				<label for="<?php echo $t->get_field_id('image'); ?>"><?php _e('Image - 32px<sup>2</sup> recommended', 'tijara'); ?></label>:
				<br />
				<input type="text" name="<?php echo $t->get_field_name('image'); ?>" title="<?php printf (__('Image for the %s widget', 'tijara'), $t->name); ?>" id="<?php echo $t->get_field_id('image'); ?>" value="<?php echo $instance['image'];?>" placeholder="<?php _e('Upload/Choose Image', 'tijara') ;?>"/>
			</p>

			<p>
				<input id = "<?php echo $t->get_field_id('hide_in_home'); ?>" name = "<?php echo $t->get_field_name('hide_in_home'); ?>" type = "checkbox" <?php checked(isset($instance['hide_in_home']) ? $instance['hide_in_home'] : 0); ?>/>				
				<label for="<?php echo $t->get_field_id('hide_in_home'); ?>"><?php _e('Hide in homepage', 'tijara'); ?></label>
			</p>

			<p>
				<label for="<?php echo $t->get_field_id('alignment'); ?>"><?php _e('Alignment', 'tijara'); ?></label>:
				<select id="<?php echo $t->get_field_id('alignment'); ?>" name="<?php echo $t->get_field_name('alignment'); ?>">
					<option <?php selected($instance['alignment'], '');?> value=""><?php _e('No change', 'tijara'); ?></option>
					<option <?php selected($instance['alignment'], 'alignleft');?> value="alignleft"><?php _e('Left', 'tijara'); ?></option>
					<option <?php selected($instance['alignment'], 'alignright');?> value="alignright"><?php _e('Right', 'tijara'); ?></option>
					<option <?php selected($instance['alignment'], 'aligncenter');?> value="aligncenter"><?php _e('Center', 'tijara'); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo $t->get_field_id('collapse'); ?>"><?php _e('Expand/Collapse', 'tijara'); ?></label>:
				<select id="<?php echo $t->get_field_id('collapse'); ?>" name="<?php echo $t->get_field_name('collapse'); ?>">
					<option <?php selected($instance['collapse'], '');?> value=""><?php _e('Start expanded', 'tijara'); ?></option>
					<option <?php selected($instance['collapse'], 'collapsed');?> value="collapsed"><?php _e('Start collapsed', 'tijara'); ?></option>
					<option <?php selected($instance['collapse'], 'nocollapse');?> value="nocollapse"><?php _e('Disable feature', 'tijara'); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo $t->get_field_id('classes'); ?>"><?php _e('Classes', 'tijara'); ?></label>:
				<br />
				<input type="text" name="<?php echo $t->get_field_name('classes'); ?>" id="<?php echo $t->get_field_id('classes'); ?>" value="<?php echo $instance['classes'];?>" />
			</p>

		</div>
	</fieldset>
	
	<?php
	$retrun = null;
	return array($t, $return, $instance);
}

function tijara_in_widget_form_update($instance, $new_instance, $old_instance){
	$instance['alignment'] = $new_instance['alignment'];
	$instance['classes'] = strip_tags($new_instance['classes']);
	$instance['collapse'] = $new_instance['collapse'];
	$instance['hide_in_home'] = isset($new_instance['hide_in_home']);
	$instance['image'] = strip_tags($new_instance['image']);
	return $instance;
}

function tijara_dynamic_sidebar_params($params){
	global $wp_registered_widgets;
	$widget_id = $params[0]['widget_id'];
	$widget_object = $wp_registered_widgets[$widget_id];
	$widget_option = get_option($widget_object['callback'][0]->option_name);
	$widget_number = $widget_object['params'][0]['number'];
	if (isset($widget_option[$widget_number]['alignment'])){
			if(isset($widget_option[$widget_number]['alignment'])){
				$alignment = $widget_option[$widget_number]['alignment'];
			} else {
				$alignment = '';
			}
			$params[0]['before_widget'] = preg_replace('/class="/', 'class="'.$alignment.' ',  $params[0]['before_widget'], 1);
	}
	if (isset($widget_option[$widget_number]['collapse'])){
			if(isset($widget_option[$widget_number]['collapse'])){
				$collapse = $widget_option[$widget_number]['collapse'];
			} else {
				$collapse = '';
			}
			$params[0]['before_widget'] = preg_replace('/class="/', 'class="'.$collapse.' ',  $params[0]['before_widget'], 1);
	}
	return $params;
}

// Hide widget depending on widget option (hide_in_home)
//add_filter('dynamic_sidebar_params', 'tijara_dynamic_sidebar_params_2');
function tijara_dynamic_sidebar_params_2($params) {

	global $wp_registered_widgets;

	($GLOBALS['sidebars_widgets'] = array());


	// Get the widget id_base and number
	$widget_id = $params[0]['widget_id'];
	preg_match('/(.+)-(\d+)/', $widget_id, $widget_id_parts);
	list(, $widget_id_base, $widget_number) = $widget_id_parts;
	$widget_family_options = get_option('widget_' . $widget_id_base);
	$widget_options = $widget_family_options[$widget_number];
	/*
		// This also works but complicates things for nothing
		$widget_object = $wp_registered_widgets[$params[0]['widget_id']];
		$widget_id_base = $widget_object['callback'][0]->id_base;
		$widget_number = $widget_object['callback'][0]->number;
		$widget_options = get_option($widget_object['callback'][0]->option_name);
	//*/

	if($widget_options['hide_in_home']){
		return array(0);
	} else {
		return $params;
	}
}

// Remove the widgets from the front end depending on widget option
add_filter( 'sidebars_widgets', 'tijara_sidebars_widgets', 10);
function tijara_sidebars_widgets ($sidebars_widgets){
	foreach ($sidebars_widgets as $sidebar => $widgets) {
		foreach ($widgets as $widget_index => $widget_id) {
			if($sidebar == 'wp_inactive_widgets'){
				continue;
			}
			// Get the widget id_base and number
			$widget_id = $widget_id;
			preg_match('/(.+)-(\d+)/', $widget_id, $widget_id_parts);
			list(, $widget_id_base, $widget_number) = $widget_id_parts;
			$widget_family_options = get_option('widget_' . $widget_id_base);
			$widget_options = $widget_family_options[$widget_number];
			// Remove the widget
			if($widget_options['hide_in_home']){
				unset($sidebars_widgets[$sidebar][$widget_index]);
			}
		}
	}
	return $sidebars_widgets;
}

// Customize body class
add_filter('body_class', 'tijara_body_class');
function tijara_body_class($classes) {

	global $sidebars_widgets;

	// Sidebar position
	$classes[] = 'sidebar-' . tijara_option('sidebar_position');

	// Handle empty sidebar
	if(empty($sidebars_widgets['sidebar-1'])){
		$classes = array_values(array_diff($classes,array('sidebar-before')));
		$classes = array_values(array_diff($classes,array('sidebar-after')));
		$classes[] = 'sidebar-none';
	}
	return $classes;
}
