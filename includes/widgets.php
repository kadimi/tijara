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
		&& isset($settings_1[3]['title']) && empty($settings_1[3]['title'])
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
		'title' => '', 
		'text' => '', 
		'alignment' => 'none') 
	);

	if ( !isset($instance['alignment']) ){
		$instance['alignment'] = null;
	}

	if ( !isset($instance['classes']) ) {
		$instance['classes'] = null;
	} ?>

	<fieldset class="tijara_admin_fieldset">
		<legend><a href="#" class="tijara_admin_fieldset_trigger" >Additional options</a></legend>
		<div class="tijara_admin_fieldset_content">
			<p>
				<input id = "<?php echo $t->get_field_id('hide_in_home'); ?>" name = "<?php echo $t->get_field_name('hide_in_home'); ?>" type = "checkbox" <?php checked(isset($instance['hide_in_home']) ? $instance['hide_in_home'] : 0); ?>/>				
				<label for="<?php echo $t->get_field_id('hide_in_home'); ?>"><?php _e('Hide in homepage', 'tijara'); ?></label>
			</p>

			<p>
				<label for="<?php echo $t->get_field_id('alignment'); ?>"><?php _e('Alignment', 'tijara'); ?></label>:
				<select id="<?php echo $t->get_field_id('alignment'); ?>" name="<?php echo $t->get_field_name('alignment'); ?>">
					<option <?php selected($instance['alignment'], 'default');?> value="default"><?php _e('Default', 'tijara'); ?></option>
					<option <?php selected($instance['alignment'], 'center');?> value="center"><?php _e('Center', 'tijara'); ?></option>
					<option <?php selected($instance['alignment'], 'left');?> value="left"><?php _e('Left', 'tijara'); ?></option>
					<option <?php selected($instance['alignment'], 'right');?> value="right"><?php _e('Right', 'tijara'); ?></option>
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
	$instance['hide_in_home'] = isset($new_instance['hide_in_home']);
	$instance['alignment'] = $new_instance['alignment'];
	$instance['classes'] = strip_tags($new_instance['classes']);
	return $instance;
}

function tijara_dynamic_sidebar_params($params){
	global $wp_registered_widgets;
	$widget_id = $params[0]['widget_id'];
	$widget_obj = $wp_registered_widgets[$widget_id];
	$widget_opt = get_option($widget_obj['callback'][0]->option_name);
	$widget_num = $widget_obj['params'][0]['number'];
	if (isset($widget_opt[$widget_num]['hide_in_home'])){
			if(isset($widget_opt[$widget_num]['alignment']))
					$alignment = $widget_opt[$widget_num]['alignment'];
			else
				$alignment = '';
			$params[0]['before_widget'] = preg_replace('/class="/', 'class="'.$alignment.' half ',  $params[0]['before_widget'], 1);
	}
	return $params;
}