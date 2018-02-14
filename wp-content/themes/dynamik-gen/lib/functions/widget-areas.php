<?php
/**
 * Builds the functions required to create, update, delete and display
 * Custom Widget Areas in Custom Options.
 *
 * @package Dynamik
 */

/**
 * Register each Custom Widget Area based on their current database settings.
 *
 * @since 1.0
 */
function dynamik_register_widget_areas()
{
	$dynamik_widgets = get_option( 'dynamik_gen_custom_widget_areas' );
	$dynamik_widget_areas = '<?php' . "\n" . '/**' . "\n" . ' * Register Custom Widget Areas.' . "\n" . ' */' . "\n";
	
	if( !empty( $dynamik_widgets ) )
	{
		array_multisort( $dynamik_widgets );
		
		foreach( $dynamik_widgets as $dynamik_widget => $widget_bits )
		{
			if( !empty( $widget_bits['description'] ) )
				$wa_description = $widget_bits['description'];
			else
				$wa_description = '';

			$dynamik_widget_areas .= "
genesis_register_sidebar( array(
	'id' 			=>	'" . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . "',
	'name'			=>	__( '" . $widget_bits['widget_name'] . "', 'dynamik' ),
	'description' 	=>	__( '" . esc_html ( $wa_description ) . "', 'dynamik' )
) );
";
		}
	}

	return $dynamik_widget_areas;
}

/**
 * Hook all Custom Widget Areas that area set to be hooked into a Hook Location.
 *
 * @since 1.0
 */
function dynamik_build_widget_areas()
{
	$dynamik_conditionals = get_option( 'dynamik_gen_custom_conditionals' );
	$dynamik_widgets = get_option( 'dynamik_gen_custom_widget_areas' );
	$dynamik_widget_areas = '<?php' . "\n" . '/**' . "\n" . ' * Build and Hook-In Custom Widget Areas.' . "\n" . ' */' . "\n";
	$single_quote = "'";
	
	if( !empty( $dynamik_widgets ) )
	{
		foreach( $dynamik_widgets as $dynamik_widget => $widget_bits )
		{
			$tab = '';
			$dynamik_conditional_tags = '';
			if( !empty( $widget_bits['class'] ) )
			{
				$widget_bits['class'] = ' ' . $widget_bits['class'];
			}
			$dynamik_widget_conditional = explode( '|', $widget_bits['conditionals'] );
			foreach( $dynamik_conditionals as $dynamik_conditional => $conditional_bits )
			{
				if( in_array( $conditional_bits['conditional_id'], $dynamik_widget_conditional ) )
				{
					$dynamik_conditional_tags .= $conditional_bits['conditional_tag'] . ' || ';
				}
			}
			
			$dynamik_widget_areas .= '
/* Name: ' . $widget_bits['widget_name'] . ' */
';

			if( $widget_bits['status'] == 'sht' || $widget_bits['status'] == 'bth' )
			{
				$dynamik_widget_areas .= '
add_shortcode( ' . $single_quote . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . $single_quote . ', ' . $single_quote . 'dynamik_' . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . '_widget_area_shortcode' . $single_quote . ' );
function dynamik_' . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . '_widget_area_shortcode() {';
				$dynamik_widget_areas .= '
	ob_start();
	dynamik_' . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . '_widget_area_content();
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
';
			}

			if( $widget_bits['status'] == 'hkd' || $widget_bits['status'] == 'bth' )
			{
				$dynamik_widget_areas .= '
add_action( ' . $single_quote . $widget_bits['hook_location'] . $single_quote . ', ' . $single_quote . 'dynamik_' . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . '_widget_area' . $single_quote . ', ' . $widget_bits['priority'] . ' );
function dynamik_' . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . '_widget_area() {';
				$dynamik_widget_areas .= '
	dynamik_' . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . '_widget_area_content();
}
';
			}
			
			$dynamik_widget_areas .= '
function dynamik_' . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . '_widget_area_content() {';
			if( !empty( $widget_bits['conditionals'] ) )
			{
				$tab = '	';
				$dynamik_widget_areas .= '
	if ( ' . substr( $dynamik_conditional_tags, 0, -4 ) . ' ) {';
			}
				
			$dynamik_widget_areas .= '
	' . $tab . 'genesis_widget_area( ' . $single_quote . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . $single_quote . ', $args = array (
		' . $tab . $single_quote . 'before' . $single_quote . '              => ' . $single_quote . '<div id="' . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . '" class="widget-area dynamik-widget-area' . $widget_bits['class'] . '">' . $single_quote . ',
		' . $tab . $single_quote . 'after' . $single_quote . '               => ' . $single_quote . '</div>' . $single_quote . ',
		' . $tab . $single_quote . 'before_sidebar_hook' . $single_quote . ' => ' . $single_quote . 'genesis_before_' . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . '_widget_area' . $single_quote . ',
		' . $tab . $single_quote . 'after_sidebar_hook' . $single_quote . '  => ' . $single_quote . 'genesis_after_' . dynamik_sanatize_string( $widget_bits['widget_name'], true ) . '_widget_area' . $single_quote . '
	' . $tab . ') );';
				
			if( !empty( $widget_bits['conditionals'] ) )
			{
				$dynamik_widget_areas .= '
	} else {
		return false;
	}';
			}
				
			$dynamik_widget_areas .= '
}
';
		}
	}
	
	return $dynamik_widget_areas;
}

/**
 * Get Custom Widget Areas from the database, if any exist, and then return
 * them in a sorted array.
 *
 * @since 1.0
 * @return soreted array of all Custom Widget Areas from the database if they exist.
 */
function dynamik_get_widgets()
{
	$custom_widgets = get_option( 'dynamik_gen_custom_widget_areas' );

	if( !empty( $custom_widgets ) )
	{
		foreach( $custom_widgets as $k => $v )
		{
			$custom_widgets[$k]['conditionals'] = explode( '|', $v['conditionals'] );
			$custom_widgets[$k]['description'] = stripslashes( $custom_widgets[$k]['description'] );
		}
		$custom_widgets = dynamik_array_sort( $custom_widgets, dynamik_sanatize_string( 'widget_name', true ) );	
		return $custom_widgets;
	}
	else
	{
		return false;
	}
}

/**
 * Update Custom Widget Areas in the database from current settings posted
 * in the Custom Options > Custom Widget Areas admin page.
 *
 * @since 1.0
 */
function dynamik_update_widgets( $names = '', $conditionals = '', $hooks = '', $classes = '', $descriptions = '', $statuses = '', $priorities = '' )
{
	$dynamik_widgets = get_option( 'dynamik_gen_custom_widget_areas' );
	$these_widgets = array();
	$widget_id_array = array();
	$widget_name_array = array();
	
	if( !empty( $names[1] ) )
	{
		foreach( $names as $key => $value )
		{
			$these_widgets[$key]['name'] = $value;
		}
		if( !empty( $conditionals ) )
		{
			foreach( $conditionals as $key => $value )
			{
				$these_widgets[$key]['conditionals'] = $value;
			}
		}
		if( !empty( $hooks ) )
		{
			foreach( $hooks as $key => $value )
			{
				$these_widgets[$key]['hook'] = $value;
			}
		}
		if( !empty( $classes ) )
		{
			foreach( $classes as $key => $value )
			{
				$these_widgets[$key]['class'] = $value;
			}
		}
		if( !empty( $descriptions ) )
		{
			foreach( $descriptions as $key => $value )
			{
				$these_widgets[$key]['description'] = $value;
			}
		}
		if( !empty( $statuses ) )
		{
			foreach( $statuses as $key => $value )
			{
				$these_widgets[$key]['status'] = $value;
			}
		}
		if( !empty( $priorities ) )
		{
			foreach( $priorities as $key => $value )
			{
				$these_widgets[$key]['priority'] = $value;
			}
		}
	}
	
	if( !empty( $these_widgets ) )
	{
		foreach( $these_widgets as $this_widget )
		{
			$dynamik_widgets = get_option( 'dynamik_gen_custom_widget_areas' );
			$widget_name = $this_widget['name'];
			$widget_id = dynamik_sanatize_string( $widget_name, true );
			$hook_location = $this_widget['hook'];
			$class = $this_widget['class'];
			$description = htmlspecialchars( $this_widget['description'] );
			$status = $this_widget['status'];
			$priority = $this_widget['priority'];
			
			if( !empty( $this_widget['conditionals'] ) )
			{
				$conditionals = implode( '|', $this_widget['conditionals'] );
			}
			else
			{
				$this_widget['conditionals'] = array( '' );
				$conditionals = '';
			}
			
			if( !empty( $widget_id ) )
			{
				$new_values = array( $widget_id => array( 'widget_name' => $widget_name, 'conditionals' => $conditionals, 'hook_location' => $hook_location, 'class' => $class, 'description' => $description, 'status' => $status, 'priority' => $priority ) );
				$merged_widget_area = array_merge( $dynamik_widgets, $new_values );
				update_option( 'dynamik_gen_custom_widget_areas', $merged_widget_area );
			}
		}
	}
}

/**
 * Delete Custom Widget Areas from the database that are posted for deletion
 * in Custom Options > Custom Widget Areas.
 * 
 *
 * @since 1.0
 */
add_action( 'wp_ajax_dynamik_widget_delete', 'dynamik_delete_widget' );
function dynamik_delete_widget()
{
	$dynamik_widgets = get_option( 'dynamik_gen_custom_widget_areas' );
	
	$widget_name = $_POST['widget_name'];
	
	foreach( $dynamik_widgets as $key => $value )
	{
		if( in_array( $widget_name, $dynamik_widgets[$key] ) )
		{
			unset( $dynamik_widgets[$key] );
		}
	}

	update_option( 'dynamik_gen_custom_widget_areas', $dynamik_widgets );
	
	echo 'deleted';
}

/**
 * Build drop-down menu for Custom Widget Area classes for the CSS Builder tool.
 *
 * @since 1.0
 */
function dynamik_widget_class_dropdown()
{
	$dynamik_widgets = get_option( 'dynamik_gen_custom_widget_areas' );
	
	if( !empty( $dynamik_widgets ) )
	{
		foreach( $dynamik_widgets as $k => $v )
		{
			if( $dynamik_widgets[$k]['class'] != '' )
			{
				echo '<option value="' . $dynamik_widgets[$k]['class'] . '">' . $dynamik_widgets[$k]['class'] . '</option>';
			}
		}
	}
}
