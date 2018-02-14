<?php
/**
 * Locate, Write and Add various Dynamik files.
 *
 * @package Dynamik
 */
 
/**
 * Write the Dynamik stylesheet file.
 *
 * @since 1.0
 */
function dynamik_write_design_styles()
{
    $css_prefix = '/* ' . __( 'Dynamik Styles', 'dynamik' ) . ' */' . "\n";
    $css = dynamik_build_design_styles();
	$css = $css_prefix . $css;

	$door = @fopen( dynamik_get_design_stylesheet_path(), 'w' );
	@fwrite( $door, $css );
	@fclose( $door );
	if( substr( sprintf( '%o', fileperms( dynamik_get_design_stylesheet_path() ) ), -4 ) != '0644' &&
		substr( sprintf( '%o', fileperms( dynamik_get_design_stylesheet_path() ) ), -4 ) != '0666' )
	{
		@chmod( dynamik_get_design_stylesheet_path(), 0644 );
	}
}

/**
 * Write the minified Dynamik stylesheet file.
 *
 * @since 1.0
 */
function dynamik_write_minified_styles()
{
	$css_prefix = '/* ' . __( 'This file is auto-generated from the Dynamik Options settings and custom.css content (if file exists). Any direct edits here will be lost if the settings page is saved', 'dynamik' ) .' */'."\n";
    $css = dynamik_build_design_styles();
	if( file_exists( dynamik_get_custom_stylesheet_path() ) && dynamik_get_custom_css( 'custom_css' ) != '' )
	{
		$css .= file_get_contents( dynamik_get_custom_stylesheet_path() );
	}
    $css = $css_prefix . dynamik_minify_css( $css );

	$door = @fopen( dynamik_get_minified_stylesheet_path(), 'w' );
	@fwrite( $door, $css );
	@fclose( $door );
	if( substr( sprintf( '%o', fileperms( dynamik_get_minified_stylesheet_path() ) ), -4 ) != '0644' &&
		substr( sprintf( '%o', fileperms( dynamik_get_minified_stylesheet_path() ) ), -4 ) != '0666' )
	{
		@chmod( dynamik_get_minified_stylesheet_path(), 0644 );
	}
}
 
/**
 * Write the Custom stylesheet file.
 *
 * @since 1.0
 */
function dynamik_write_custom_styles()
{
	$css = dynamik_build_custom_styles();
	
	$handle = @fopen( dynamik_get_custom_stylesheet_path(), 'w' );
	@fwrite( $handle, $css );
	@fclose( $handle );
	if( substr( sprintf( '%o', fileperms( dynamik_get_custom_stylesheet_path() ) ), -4 ) != '0644' &&
		substr( sprintf( '%o', fileperms( dynamik_get_custom_stylesheet_path() ) ), -4 ) != '0666' )
	{
		@chmod( dynamik_get_custom_stylesheet_path(), 0644 );
	}
}

/**
* Write to a specified file in the active Dynamik Skin, create if does not exist.
*
* @since 2.0
*
*/
function dynamik_write_active_skin_file( $code, $type ) {
	
	if ( $type == 'styles' )
		$path = dynamik_get_active_skin_folder_path() . '/style.css';
	elseif ( $type == 'functions' )
		$path = dynamik_get_active_skin_folder_path() . '/functions.php';
	elseif ( $type == 'scripts' )	
		$path = dynamik_get_active_skin_folder_path() . '/scripts.js';
		
	dynamik_folders_open_permissions();
	$handle = @fopen( $path, 'w' );
	@fwrite( $handle, stripslashes( $code ) );
	@fclose( $handle );
	dynamik_folders_close_permissions();
	
}

/**
 * Create the Dynamik EZ Structure file if it does not already exist.
 *
 * @since 1.0
 *
 */
function dynamik_create_ez_structure_file()
{
	if( file_exists( dynamik_get_ez_structure_path() ) )
		return;
		
	$handle = @fopen( dynamik_get_ez_structure_path(), 'w' );
	@fwrite( $handle, stripslashes( '<?php' . "\n" ) );
	@fclose( $handle );
}

/**
 * Write to the Dynamik EZ Structure file if it exists.
 *
 * @since 1.0
 *
 */
function dynamik_write_ez_structures( $code = '' )
{
	dynamik_folders_open_permissions();
	
	if( !file_exists( dynamik_get_ez_structure_path() ) )
	{
		dynamik_create_ez_structure_file();
	}

	$handle = @fopen( dynamik_get_ez_structure_path(), 'w+' );
	@fwrite( $handle, stripslashes( $code ) );
	@fclose( $handle );
	
	dynamik_folders_close_permissions();
}

/**
 * Create the Dynamik Custom Functions file if it does not already exist.
 *
 * @since 1.0
 *
 */
function dynamik_create_custom_functions_file()
{
	if( file_exists( dynamik_get_custom_functions_path() ) )
		return;
		
	$handle = @fopen( dynamik_get_custom_functions_path(), 'w' );
	@fwrite( $handle, stripslashes( '<?php' . "\n" . '/* Do not remove this line. Add your functions below. */' . "\n" ) );
	@fclose( $handle );
}

/**
 * Write to the Dynamik Custom Functions file if it exists.
 *
 * @since 1.0
 *
 */
function dynamik_write_custom_functions( $code = '' )
{
	dynamik_folders_open_permissions();
	if( !file_exists( dynamik_get_custom_functions_path() ) )
	{
		dynamik_create_custom_functions_file();
	}

	$handle = @fopen( dynamik_get_custom_functions_path(), 'w+' );
	@fwrite( $handle, stripslashes( $code ) );
	@fclose( $handle );
	dynamik_folders_close_permissions();
}

/**
 * Create the Dynamik Custom JS file if it does not already exist.
 *
 * @since 1.2
 *
 */
function dynamik_create_custom_js_file()
{
	if( file_exists( dynamik_get_custom_js_path() ) )
		return;
		
	$handle = @fopen( dynamik_get_custom_js_path(), 'w' );
	@fwrite( $handle, '' );
	@fclose( $handle );
}

/**
 * Write to the Dynamik Custom JS file if it exists.
 *
 * @since 1.2
 *
 */
function dynamik_write_custom_js( $code = '' )
{
	dynamik_folders_open_permissions();
	if( !file_exists( dynamik_get_custom_js_path() ) )
	{
		dynamik_create_custom_js_file();
	}

	$handle = @fopen( dynamik_get_custom_js_path(), 'w+' );
	@fwrite( $handle, stripslashes( $code ) );
	@fclose( $handle );
	dynamik_folders_close_permissions();
}

/**
 * Create and write to the Dynamik Custom Template files.
 *
 * @since 1.2
 *
 */
function dynamik_write_custom_templates()
{
	dynamik_folders_open_permissions();
	$dynamik_templates = get_option( 'dynamik_gen_custom_templates' );
	
	if( !empty( $dynamik_templates ) )
	{
		dynamik_dir_check( CHILD_DIR . '/my-templates' );
	
		foreach( $dynamik_templates as $dynamik_template => $template_bits )
		{
			if( $template_bits['template_type'] == 'page_template' )
			{
				$dynamik_template_content = '<?php
/*
 * Template Name: ' . $template_bits['template_name'] . '
 */
?>
';
			}
			else
			{
				$dynamik_template_content = '<?php
/*
 * Custom WordPress Template: ' . $template_bits['template_name'] . '
 */
?>
';
			}

			$template_file_name = $template_bits['template_file_name'] == 'a404' ? '404' : $template_bits['template_file_name'];
			$dynamik_template_content .= $template_bits['template_textarea'];

			$handle = @fopen( dynamik_get_custom_template_paths( $template_file_name, $template_bits['template_type'] ), 'w+' );
			@fwrite( $handle, htmlspecialchars_decode( stripslashes( $dynamik_template_content ) ) );
			@fclose( $handle );

			$dynamik_template_content = '';
		}
	}
	dynamik_folders_close_permissions();
}

/**
 * Create the Dynamik Custom Widget Areas Register file if it does not already exist.
 *
 * @since 1.0
 *
 */
function dynamik_create_custom_widget_areas_register_file()
{
	if( file_exists( dynamik_get_custom_widget_areas_register_path() ) )
		return;
		
	$handle = @fopen( dynamik_get_custom_widget_areas_register_path(), 'w' );
	@fwrite( $handle, stripslashes( '<?php' . "\n" . '/**' . "\n" . ' * Build, Register and Hook-In Custom Widget Areas.' . "\n" . ' *' . "\n" . ' * @package Dynamik' . "\n" . ' */' . "\n" ) );
	@fclose( $handle );
}

/**
 * Write to the Dynamik Custom Widget Areas Register file if it exists.
 *
 * @since 1.0
 *
 */
function dynamik_write_custom_widget_areas_register( $code = '' )
{
	dynamik_folders_open_permissions();
	if( !file_exists( dynamik_get_custom_widget_areas_register_path() ) )
	{
		dynamik_create_custom_widget_areas_register_file();
	}

	$handle = @fopen( dynamik_get_custom_widget_areas_register_path(), 'w+' );
	@fwrite( $handle, stripslashes( $code ) );
	@fclose( $handle );
	dynamik_folders_close_permissions();
}

/**
 * Create the Dynamik Custom Widget Areas file if it does not already exist.
 *
 * @since 1.0
 *
 */
function dynamik_create_custom_widget_areas_file()
{
	if( file_exists( dynamik_get_custom_widget_areas_path() ) )
		return;
		
	$handle = @fopen( dynamik_get_custom_widget_areas_path(), 'w' );
	@fwrite( $handle, stripslashes( '<?php' . "\n" . '/**' . "\n" . ' * Build, Register and Hook-In Custom Widget Areas.' . "\n" . ' *' . "\n" . ' * @package Dynamik' . "\n" . ' */' . "\n" ) );
	@fclose( $handle );
}

/**
 * Write to the Dynamik Custom Widget Areas file if it exists.
 *
 * @since 1.0
 *
 */
function dynamik_write_custom_widget_areas( $code = '' )
{
	dynamik_folders_open_permissions();
	if( !file_exists( dynamik_get_custom_widget_areas_path() ) )
	{
		dynamik_create_custom_widget_areas_file();
	}

	$handle = @fopen( dynamik_get_custom_widget_areas_path(), 'w+' );
	@fwrite( $handle, stripslashes( $code ) );
	@fclose( $handle );
	dynamik_folders_close_permissions();
}

/**
 * Create the Dynamik Custom Hook Boxes file if it does not already exist.
 *
 * @since 1.0
 *
 */
function dynamik_create_custom_hook_boxes_file()
{
	if( file_exists( dynamik_get_custom_hook_boxes_path() ) )
		return;
		
	$handle = @fopen( dynamik_get_custom_hook_boxes_path(), 'w' );
	@fwrite( $handle, stripslashes( '<?php' . "\n" . '/**' . "\n" . ' * Build and Hook-In Custom Hook Boxes.' . "\n" . ' *' . "\n" . ' * @package Dynamik' . "\n" . ' */' . "\n" ) );
	@fclose( $handle );
}

/**
 * Write to the Dynamik Custom Hook Boxes file if it exists.
 *
 * @since 1.0
 *
 */
function dynamik_write_custom_hook_boxes( $code = '' )
{
	dynamik_folders_open_permissions();
	if( !file_exists( dynamik_get_custom_hook_boxes_path() ) )
	{
		dynamik_create_custom_hook_boxes_file();
	}

	$handle = @fopen( dynamik_get_custom_hook_boxes_path(), 'w+' );
	@fwrite( $handle, htmlspecialchars_decode( stripslashes( $code ) ) );
	@fclose( $handle );
	dynamik_folders_close_permissions();
}

/**
 * Call to all necessary functions to create both the
 * Dynamik and Custom stylesheets.
 *
 * @since 1.0
 */
function dynamik_write_files( $css = true, $ez = true, $custom = true )
{
	dynamik_folders_open_permissions();
	if( $css )
	{
		dynamik_write_design_styles();
		dynamik_write_custom_styles();
		dynamik_write_minified_styles();
	}
	if( $ez )
	{
		dynamik_write_ez_structures( build_ez_structures() );
	}
	if( $custom )
	{
		$custom_functions = get_option( 'dynamik_gen_custom_functions' );
		dynamik_write_custom_functions( $custom_functions['custom_functions'] );
		$custom_js = get_option( 'dynamik_gen_custom_js' );
		dynamik_write_custom_js( $custom_js['custom_js'] );
		dynamik_write_custom_templates();
		dynamik_write_custom_widget_areas_register( dynamik_register_widget_areas() );
		dynamik_write_custom_widget_areas( dynamik_build_widget_areas() );
		dynamik_write_custom_hook_boxes( dynamik_build_hook_boxes() );
	}
	dynamik_folders_close_permissions();
	dynamik_update_design_alt_options();
}

/* File Permissions Check */

/**
 * Test to see if a directory is writable and/or able to
 * be made writable by Dynamik.
 *
 * @since 1.0
 * @return true or false based on the findings of the function.
 */
function dynamik_writable( $dir, $level_open = 0777, $level_close = 0755 )
{
	if( !is_writable( $dir ) )
	{
		@chmod( $dir, $level_open );
	}
	else
	{
		return true;
	}
	
	if( !is_writable( $dir ) )
	{
		return false;
	}
	else
	{
		@chmod( $dir, $level_close );
	}
	
	return true;
}

/**
 * @chmod a directory to 0777.
 *
 * @since 1.0
 */
function dynamik_open_permissions( $dir, $level_open = 0777 )
{
	@chmod( $dir, $level_open );
}

/**
 * @chmod a directory to 0755.
 *
 * @since 1.0
 */
function dynamik_close_permissions( $dir, $level_close = 0755 )
{
	@chmod( $dir, $level_close );
}

/**
 * Make any unwritable folders writable.
 *
 * NOTE: "folders" meaning Dynamik stylesheet and Image Uploader folders.
 *
 * @since 1.0
 */
function dynamik_folders_open_permissions()
{
	global $dynamik_unwritable, $dynamik_folders;
	
	if( $dynamik_unwritable )
	{
		foreach( $dynamik_folders as $dynamik_folder )
		{
			if( is_dir( $dynamik_folder ) )
			{
				dynamik_open_permissions( $dynamik_folder );
			}
		}
	}
}

/**
 * Return any folders that were made writable by Dynamik to a permission setting of 0755.
 *
 * NOTE: "folders" meaning Dynamik stylesheet and Image Uploader folders.
 *
 * @since 1.0
 */
function dynamik_folders_close_permissions()
{
	global $dynamik_unwritable, $dynamik_folders;
	
	if( $dynamik_unwritable )
	{
		foreach( $dynamik_folders as $dynamik_folder )
		{
			if( is_dir( $dynamik_folder ) )
			{
				dynamik_close_permissions( $dynamik_folder );
			}
		}
	}
}
