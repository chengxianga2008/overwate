<?php
/**
 * Builds the functions required to create, update, delete and display
 * Custom Templates in Custom Options.
 *
 * @package Dynamik
 */

/**
 * Get Custom Templates from the database, if any exist, and then return
 * them in a sorted array.
 *
 * @since 1.2
 * @return soreted array of all Custom Templates from the database if they exist.
 */
function dynamik_get_templates()
{
	$custom_templates = get_option( 'dynamik_gen_custom_templates' );
	
	if( !empty( $custom_templates ) )
	{
		foreach( $custom_templates as $k => $v )
		{
			$custom_templates[$k]['template_file_name'] = $custom_templates[$k]['template_file_name'] == 'a404' ? '404' : $custom_templates[$k]['template_file_name'];
			$custom_templates[$k]['template_textarea'] = stripslashes( $custom_templates[$k]['template_textarea'] );
		}
		$custom_templates = dynamik_array_sort( $custom_templates, 'template_file_name' );		
		return $custom_templates;
	}
	else
	{
		return false;
	}
}

/**
 * Update Custom Templates in the database from current settings posted
 * in the Custom Options > Custom Templates admin page.
 *
 * @since 1.2
 */
function dynamik_update_templates( $file_names = '', $template_names = '', $template_types = '', $textareas = '' )
{
	$dynamik_templates_array = get_option( 'dynamik_gen_custom_templates' );
	$updated_template_file_name_array = array();
	$updated_template_type_array = array();
	$these_templates = array();
	$template_id_array = array();
	$template_file_name_array = array();
	
	if( !empty( $file_names[1] ) )
	{
		foreach( $file_names as $key => $value )
		{
			$value = $value == '404' ? 'a404' : $value;
			$these_templates[$key]['file_name'] = $value;
		}
		if( !empty( $template_names ) )
		{
			foreach( $template_names as $key => $value )
			{
				$these_templates[$key]['template_name'] = $value;
			}
		}
		if( !empty( $template_types ) )
		{
			foreach( $template_types as $key => $value )
			{
				$these_templates[$key]['template_type'] = $value;
			}
		}
		if( !empty( $textareas ) )
		{
			foreach( $textareas as $key => $value )
			{
				$these_templates[$key]['template_textarea'] = $value;
			}
		}
	}

	if( !empty( $these_templates ) )
	{
		foreach( $these_templates as $this_template )
		{
			$dynamik_templates = get_option( 'dynamik_gen_custom_templates' );
			$updated_template_file_name_array[] = $template_id = $template_file_name = $this_template['file_name'];
			$template_name = $this_template['template_name'];
			$updated_template_type_array[] = $template_type = $this_template['template_type'];
			$template_textarea = htmlspecialchars( $this_template['template_textarea'] );
			
			if( !empty( $template_id ) )
			{
				$new_values = array( $template_id => array( 'template_file_name' => $template_file_name, 'template_name' => $template_name, 'template_type' => $template_type, 'template_textarea' => $template_textarea ) );
				$merged_page_template = array_merge( $dynamik_templates, $new_values );
				update_option( 'dynamik_gen_custom_templates', $merged_page_template );
			}
		}
		foreach( $dynamik_templates_array as $key1 => $value1 )
		{
			if( in_array( $value1['template_file_name'], $updated_template_file_name_array ) )
			{
				foreach( $updated_template_type_array as $key2 => $value2 )
				{
					$template_file_name_value = $value1['template_file_name'] == 'a404' ? '404' : $value1['template_file_name'];
					if( !in_array( $value1['template_type'], $updated_template_file_name_array ) && file_exists( dynamik_get_custom_template_paths( $template_file_name_value, $value1['template_type'] ) ) )
					{
						unlink( dynamik_get_custom_template_paths( $template_file_name_value, $value1['template_type'] ) );
					}
				}
			}
		}
	}
}

/**
 * Delete Custom Templates from the database that are posted for deletion
 * in Custom Options > Custom Templates as well as the Template file that
 * was created inside the root folder of the active Genesis Child Theme.
 *
 * @since 1.2
 */
add_action( 'wp_ajax_dynamik_template_delete', 'dynamik_delete_template' );
function dynamik_delete_template()
{
	$dynamik_templates = get_option( 'dynamik_gen_custom_templates' );
	
	$template_file_name = $_POST['template_file_name'];
	
	foreach( $dynamik_templates as $key => $value )
	{
		$template_file_name_value = $value['template_file_name'] == 'a404' ? '404' : $value['template_file_name'];
		if( $template_file_name == $template_file_name_value )
		{
			unset( $dynamik_templates[$key] );
			unlink( dynamik_get_custom_template_paths( $template_file_name_value, $value['template_type'] ) );
		}
	}

	update_option( 'dynamik_gen_custom_templates', $dynamik_templates );
		
	echo 'deleted';
}

/**
 * Delete Custom Template files when a Custom Options Reset occurs.
 *
 * @since 1.2
 */
function dynamik_reset_delete_template()
{
	$dynamik_templates = get_option( 'dynamik_gen_custom_templates' );
	
	foreach( $dynamik_templates as $key => $value )
	{
		$template_file_name_value = $value['template_file_name'] == 'a404' ? '404' : $value['template_file_name'];
		unlink( dynamik_get_custom_template_paths( $template_file_name_value, $value['template_type'] ) );
	}

	return true;
}
