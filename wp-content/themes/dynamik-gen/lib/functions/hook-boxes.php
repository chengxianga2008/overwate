<?php
/**
 * Builds the functions required to create, update, delete and display
 * Custom Hook Boxes in Custom Options.
 *
 * @package Dynamik
 */

/**
 * Hook all Custom Hook Boxes that are set to be hooked into a Hook Location.
 *
 * @since 1.0
 */
function dynamik_build_hook_boxes()
{
	$dynamik_conditionals = get_option( 'dynamik_gen_custom_conditionals' );
	$dynamik_hooks = get_option( 'dynamik_gen_custom_hook_boxes' );
	$dynamik_hook_boxes = '<?php' . "\n" . '/**' . "\n" . ' * Build and Hook-In Custom Hook Boxes.' . "\n" . ' */' . "\n";
	$single_quote = "'";
	
	if( !empty( $dynamik_hooks ) )
	{
		foreach( $dynamik_hooks as $dynamik_hook => $hook_bits )
		{
			$dynamik_conditional_tags = '';
			$dynamik_hook_conditional = explode( '|', $hook_bits['conditionals'] );
			foreach( $dynamik_conditionals as $dynamik_conditional => $conditional_bits )
			{
				if( in_array( $conditional_bits['conditional_id'], $dynamik_hook_conditional ) )
				{
					$dynamik_conditional_tags .= $conditional_bits['conditional_tag'] . ' || ';
				}
			}
			
			$dynamik_hook_boxes .= '
/* Name: ' . $hook_bits['hook_name'] . ' */
';
			
			if( $hook_bits['status'] == 'sht' || $hook_bits['status'] == 'bth' )
			{
				$dynamik_hook_boxes .= '
add_shortcode( ' . $single_quote . dynamik_sanatize_string( $hook_bits['hook_name'], true ) . $single_quote . ', ' . $single_quote . 'dynamik_' . dynamik_sanatize_string( $hook_bits['hook_name'], true ) . '_hook_box_shortcode' . $single_quote . ' );
function dynamik_' . dynamik_sanatize_string( $hook_bits['hook_name'], true ) . '_hook_box_shortcode() {';
				$dynamik_hook_boxes .= '
	ob_start();
	dynamik_' . dynamik_sanatize_string( $hook_bits['hook_name'], true ) . '_hook_box_content();
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
';
			}

			if( $hook_bits['status'] == 'hkd' || $hook_bits['status'] == 'bth' )
			{
				$dynamik_hook_boxes .= '
add_action( ' . $single_quote . $hook_bits['hook_location'] . $single_quote . ', ' . $single_quote . 'dynamik_' . dynamik_sanatize_string( $hook_bits['hook_name'], true ) . '_hook_box' . $single_quote . ', ' . $hook_bits['priority'] . ' );
function dynamik_' . dynamik_sanatize_string( $hook_bits['hook_name'], true ) . '_hook_box() {';
				$dynamik_hook_boxes .= '
	dynamik_' . dynamik_sanatize_string( $hook_bits['hook_name'], true ) . '_hook_box_content();
}
';
			}

			if( $hook_bits['status'] == 'css' )
			{
				$dynamik_hook_boxes .= '
add_action( ' . $single_quote . 'wp_head' . $single_quote . ', ' . $single_quote . 'dynamik_' . dynamik_sanatize_string( $hook_bits['hook_name'], true ) . '_hook_box' . $single_quote . ', ' . $hook_bits['priority'] . ' );
function dynamik_' . dynamik_sanatize_string( $hook_bits['hook_name'], true ) . '_hook_box() {';
				$dynamik_hook_boxes .= '
	dynamik_' . dynamik_sanatize_string( $hook_bits['hook_name'], true ) . '_hook_box_content();
}
';
			}
			
			$dynamik_hook_boxes .= '
function dynamik_' . dynamik_sanatize_string( $hook_bits['hook_name'], true ) . '_hook_box_content() {';
			if( !empty( $hook_bits['conditionals'] ) )
			{
				$dynamik_hook_boxes .= '
	if ( ' . substr( $dynamik_conditional_tags, 0, -4 ) . ' ) { ?>
';
			}
			else
			{
				$dynamik_hook_boxes .= ' ?>
';
			}
				
			if( $hook_bits['status'] == 'css' )
			{
				$dynamik_hook_boxes .= '<!-- "' . $hook_bits['hook_name'] . '" hook box styles --><style type="text/css">' . dynamik_minify_css( $hook_bits['hook_textarea'] ) . '</style><!-- end "' . $hook_bits['hook_name'] . '" hook box styles -->';
			}
			else
			{
				$dynamik_hook_boxes .= $hook_bits['hook_textarea'];
			}
				
			if( !empty( $hook_bits['conditionals'] ) )
			{
				$dynamik_hook_boxes .= '
	<?php } else {
		return false;
	}';
			}
			else
			{
				$dynamik_hook_boxes .= '
<?php';
			}
				
			$dynamik_hook_boxes .= '
}
';
		}
	}
	
	return $dynamik_hook_boxes;
}

/**
 * Get Custom Hook Boxes from the database, if any exist, and then return
 * them in a sorted array.
 *
 * @since 1.0
 * @return soreted array of all Custom Hook Boxes from the database if they exist.
 */
function dynamik_get_hooks()
{
	$custom_hooks = get_option( 'dynamik_gen_custom_hook_boxes' );
	
	if( !empty( $custom_hooks ) )
	{
		$custom_hook_name_compare = array();
		foreach( $custom_hooks as $k => $v )
		{
			$custom_hooks[$k]['conditionals'] = explode( '|', $v['conditionals'] );
			$custom_hooks[$k]['hook_textarea'] = stripslashes( $custom_hooks[$k]['hook_textarea'] );
			$custom_hook_name_compare[] = $custom_hooks[$k]['hook_name'];
		}
		$custom_hooks = dynamik_array_sort( $custom_hooks, 'hook_name' );		
		return $custom_hooks;
	}
	else
	{
		return false;
	}
}

/**
 * Update Custom Hook Boxes in the database from current settings posted
 * in the Custom Options > Custom Hook Boxes admin page.
 *
 * @since 1.0
 */
function dynamik_update_hooks( $names = '', $conditionals = '', $hooks = '', $statuses = '', $priorities = '', $textareas = '' )
{
	$dynamik_hooks = get_option( 'dynamik_gen_custom_hook_boxes' );
	$these_hooks = array();
	$hook_id_array = array();
	$hook_name_array = array();
	
	if( !empty( $names[1] ) )
	{
		foreach( $names as $key => $value )
		{
			$these_hooks[$key]['name'] = $value;
		}
		if( !empty( $conditionals ) )
		{
			foreach( $conditionals as $key => $value )
			{
				$these_hooks[$key]['conditionals'] = $value;
			}
		}
		if( !empty( $hooks ) )
		{
			foreach( $hooks as $key => $value )
			{
				$these_hooks[$key]['hook'] = $value;
			}
		}
		if( !empty( $statuses ) )
		{
			foreach( $statuses as $key => $value )
			{
				$these_hooks[$key]['status'] = $value;
			}
		}
		if( !empty( $priorities ) )
		{
			foreach( $priorities as $key => $value )
			{
				$these_hooks[$key]['priority'] = $value;
			}
		}
		if( !empty( $textareas ) )
		{
			foreach( $textareas as $key => $value )
			{
				$these_hooks[$key]['hook_textarea'] = $value;
			}
		}
	}

	if( !empty( $these_hooks ) )
	{
		foreach( $these_hooks as $this_hook )
		{
			$dynamik_hooks = get_option( 'dynamik_gen_custom_hook_boxes' );
			$hook_name = $this_hook['name'];
			$hook_id = dynamik_sanatize_string( $hook_name, true );
			$hook_location = $this_hook['hook'];
			$hook_textarea = htmlspecialchars( $this_hook['hook_textarea'] );
			$status = $this_hook['status'];
			$priority = $this_hook['priority'];
			
			if( !empty( $this_hook['conditionals'] ) )
			{
				$conditionals = implode( '|', $this_hook['conditionals'] );
			}
			else
			{
				$this_hook['conditionals'] = array( '' );
				$conditionals = '';
			}
			
			if( !empty( $hook_id ) )
			{
				$new_values = array( $hook_id => array( 'hook_name' => $hook_name, 'conditionals' => $conditionals, 'hook_location' => $hook_location, 'hook_textarea' => $hook_textarea, 'status' => $status, 'priority' => $priority ) );
				$merged_hook_box = array_merge( $dynamik_hooks, $new_values );
				update_option( 'dynamik_gen_custom_hook_boxes', $merged_hook_box );
			}
		}
	}
}

/**
 * Delete Custom Hook Boxes from the database that are posted for deletion
 * in Custom Options > Custom Hook Boxes.
 *
 * @since 1.0
 */
add_action( 'wp_ajax_dynamik_hook_delete', 'dynamik_delete_hook' );
function dynamik_delete_hook()
{
	$dynamik_hooks = get_option( 'dynamik_gen_custom_hook_boxes' );
	
	$hook_name = $_POST['hook_name'];
	
	foreach( $dynamik_hooks as $key => $value )
	{
		if( in_array( $hook_name, $dynamik_hooks[$key] ) )
		{
			unset( $dynamik_hooks[$key] );
		}
	}

	update_option( 'dynamik_gen_custom_hook_boxes', $dynamik_hooks );
		
	echo 'deleted';
}
