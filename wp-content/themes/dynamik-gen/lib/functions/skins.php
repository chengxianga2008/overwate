<?php
/**
 * Builds the Dynamik Skins functions.
 *
 * @package Dynamik
 */

/**
 * List all available Dynamik Skins.
 *
 * @since 1.6
 */
function dynamik_list_skins()
{
	$dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );
	$dynamik_gen_active_skin_options = get_option( 'dynamik_gen_' . $dynamik_gen_skin_options['active_skin'] . '_skin' );
	$active_skin_info = dynamik_skin_style_info( $dynamik_gen_skin_options['active_skin'] );

	echo '<div class="dynamik-skin-listing">';
		echo '<div id="dynamik-active-skin-screenshot-wrap">';
			echo '<img class="dynamik-skin-screenshot" src="' . dynamik_skin_screenshot_check( $dynamik_gen_skin_options['active_skin'] ) . '" title="' . dynamik_unsanatize_string( $dynamik_gen_skin_options['active_skin'] ) . ' - ' . $active_skin_info['version'] . 'by: ' . $active_skin_info['author'] . '" width="360" height="240">';
			if( $dynamik_gen_skin_options['active_skin'] != 'default' )
			{
				echo '<div id="dynamik-active-skin-edit-code-buttons-wrap">';
				if( file_exists( dynamik_get_active_skin_folder_path() . '/style.css' ) )
					echo '<span id="dynamik-active-skin-edit-styles" class="dynamik-active-skin-edit-code"><img src="' . CHILD_URL . '/lib/css/images/skin-edit-css.png" width="45" height="33" style="display:block;"></span>';
				if( file_exists( dynamik_get_active_skin_folder_path() . '/functions.php' ) )
					echo '<span id="dynamik-active-skin-edit-functions" class="dynamik-active-skin-edit-code"><img src="' . CHILD_URL . '/lib/css/images/skin-edit-php.png" width="45" height="33" style="display:block;"></span>';
				if( file_exists( dynamik_get_active_skin_folder_path() . '/scripts.js' ) )
					echo '<span id="dynamik-active-skin-edit-scripts" class="dynamik-active-skin-edit-code"><img src="' . CHILD_URL . '/lib/css/images/skin-edit-js.png" width="45" height="33" style="display:block;"></span>';
				echo '</div>';
			}
		echo '</div>';
		echo '<div class="dynamik-skin-name-wrap active-skin">';
			echo '<span class="dynamik-skin-name">' . __( 'Active:', 'dynamik' ) . ' ' . dynamik_unsanatize_string( $dynamik_gen_skin_options['active_skin'] ) . '</span>';
			echo '<span class="dynamik-skin-buttons">';
				echo '<a class="button snapshot-skin" href="?page=dynamik-design&activetab=dynamik-design-options-nav-skins&fct=snapshot_skin&skinname=' . $dynamik_gen_skin_options['active_skin'] . '" title="' . $dynamik_gen_active_skin_options['snapshot_timestamp'] . '" onClick=\'return confirm("' . __( 'This will take a snapshot of your currently active Dynamik Skin, overwriting the current snapshot of this Skin. Click OK to proceed.', 'dynamik' ) . '")\'>' . __( 'Snapshot', 'dynamik' ) . '</a>';
				echo '<a class="button restore-skin" href="?page=dynamik-design&activetab=dynamik-design-options-nav-skins&fct=restore_skin&skinname=' . $dynamik_gen_skin_options['active_skin'] . '" onClick=\'return confirm("' . __( 'This will restore your currently active Dynamik Skin from your most recent snapshot. Click OK to proceed.', 'dynamik' ) . '")\'>' . __( 'Restore', 'dynamik' ) . '</a>';
			echo '</span>';
		echo '</div>';
	echo '</div>';

	asort( $dynamik_gen_skin_options['available_skins'] );

	$count = -1;
	foreach( $dynamik_gen_skin_options['available_skins'] as $available_skin )
	{
		if( false != dynamik_skins_folder_scan( $available_skin ) && $available_skin != $dynamik_gen_skin_options['active_skin'] )
		{
			$available_skin_info = dynamik_skin_style_info( $available_skin );
			$even_or_odd_skin_class = $count % 2 == 0 ? ' odd-skin' : ' even-skin';
			$third_skin_class = $count % 3 == 0 ? ' third-skin' : '';
			echo '<div class="dynamik-skin-listing' . $even_or_odd_skin_class . $third_skin_class . '">';
				echo '<img class="dynamik-skin-screenshot" src="' . dynamik_skin_screenshot_check( $available_skin ) . '" title="' . dynamik_unsanatize_string( $available_skin ) . ' - ' . $available_skin_info['version'] . 'by: ' . $available_skin_info['author'] . '" width="360" height="240">';
				echo '<div class="dynamik-skin-name-wrap">';
					echo '<span class="dynamik-skin-name">' . dynamik_unsanatize_string( $available_skin ) . '</span>';
					echo '<span class="dynamik-skin-buttons">';
						echo '<a class="button activate-skin" href="?page=dynamik-design&activetab=dynamik-design-options-nav-skins&fct=activate_skin&skinname=' . urlencode( $available_skin ) . '" onClick=\'return confirm("' . __( 'Are you sure you want to activate this Dynamik Skin, as this will de-activate the currently active Skin? If so, click OK to proceed.', 'dynamik' ) . '")\'>' . __( 'Activate', 'dynamik' ) . '</a>';
						if( $available_skin != 'default' )
							echo '<a class="button delete-skin" href="?page=dynamik-design&activetab=dynamik-design-options-nav-skins&fct=delete_skin&skinname=' . urlencode( $available_skin ) . '" onClick=\'return confirm("' . __( 'Are you sure you want to delete this Dynamik Skin? If so, click OK to proceed.', 'dynamik' ) . '")\'>' . __( 'Delete', 'dynamik' ) . '</a>';
					echo '</span>';
				echo '</div>';
			echo '</div>';
			$count++;
		}
	}
}

add_action( 'admin_init', 'dynamik_skins_check' );
/**
 * Determine which Skin's sub-function to run based on the type of POST.
 *
 * @since 1.6
 */
function dynamik_skins_check()
{
	if( !empty( $_GET['fct'] ) )
	{
		switch( $_GET['fct'] )
		{
			case 'delete_skin':
			dynamik_delete_skin();
			break;
			
			case 'activate_skin':
			dynamik_activate_skin();
			break;

			case 'restore_skin':
			dynamik_restore_skin();
			break;

			case 'snapshot_skin':
			dynamik_snapshot_skin();
			break;
		}
	}
}

/**
 * Delete the appropriate Dynamik Skin.
 *
 * @since 1.6
 */
function dynamik_delete_skin()
{
	global $skin_message;
	$dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );
	$skin_name = $_GET['skinname'];
	$deleted_dynamik_skin = get_option( 'dynamik_gen_' . $skin_name . '_skin' );

	delete_option( 'dynamik_gen_' . $skin_name . '_skin' );

	foreach( $dynamik_gen_skin_options['available_skins'] as $available_skin => $value )
	{
		if( false != dynamik_skins_folder_scan( $value ) && $value == $skin_name )
		{
			dynamik_delete_dir( dynamik_get_skins_folder_path() . '/' . $skin_name );
			unset( $dynamik_gen_skin_options['available_skins'][$available_skin] );
			update_option( 'dynamik_gen_skin_options', $dynamik_gen_skin_options );
		}
	}

	$skin_message = '<div class="notice-box" style="margin:0 0 15px;"><strong>' . __( 'Dynamik Skin Deleted', 'dynamik' ) . '</strong></div>';
}

/**
 * Activate the appropriate Dynamik Skin.
 *
 * @since 1.6
 */
function dynamik_activate_skin()
{
	global $skin_message;
	$dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );
	$skin_name = $_GET['skinname'];

	dynamik_skin_images_cleanup();
	dynamik_skin_options_update( $dynamik_gen_skin_options['active_skin'] );

	foreach( $dynamik_gen_skin_options['available_skins'] as $available_skin => $value )
	{
		if( false != dynamik_skins_folder_scan( $value ) && $value == $skin_name )
		{
			$dynamik_gen_skin_options['active_skin'] = $skin_name;
			update_option( 'dynamik_gen_skin_options', $dynamik_gen_skin_options );
			$active_dynamik_skin_options = get_option( 'dynamik_gen_' . $skin_name . '_skin' );
			update_option( 'dynamik_gen_design_options', $active_dynamik_skin_options['design_options'] );
			update_option( 'dynamik_gen_responsive_options', $active_dynamik_skin_options['responsive_options'] );
		}
	}

	if( is_dir( dynamik_get_skins_folder_path() . '/' . $skin_name . '/images' ) )
	{
		$handle = opendir( dynamik_get_skins_folder_path() . '/' . $skin_name . '/images' );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( dynamik_get_skins_folder_path() . '/' . $skin_name . '/images/' . $file, dynamik_get_stylesheet_location( 'path' ) . 'images' . '/' . $file );
			}
		}
		closedir( $handle );

		$handle = opendir( dynamik_get_skins_folder_path() . '/' . $skin_name . '/images/adminthumbnails' );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( dynamik_get_skins_folder_path() . '/' . $skin_name . '/images/adminthumbnails/' . $file, dynamik_get_stylesheet_location( 'path' ) . 'images/adminthumbnails/' . $file );
			}
		}
		closedir( $handle );
	}

	dynamik_write_files( $css = true, $ez = true, $custom = false );

	$skin_message = '<div class="notice-box" style="margin:0 0 15px;"><strong>' . __( 'Dynamik Skin Activated', 'dynamik' ) . '</strong></div>';
}

/**
 * Restore the appropriate Dynamik Skin.
 *
 * @since 1.6
 */
function dynamik_restore_skin()
{
	global $skin_message;
	$skin_name = $_GET['skinname'];

	dynamik_skin_options_restore( $skin_name );
	dynamik_write_files( $css = true, $ez = true, $custom = false );

	$skin_message = '<div class="notice-box" style="margin:0 0 15px;"><strong>' . __( 'Dynamik Skin Restored From Snapshot', 'dynamik' ) . '</strong></div>';
}

/**
 * Take a Snapshot of the appropriate Dynamik Skin.
 *
 * @since 1.6
 */
function dynamik_snapshot_skin()
{
	global $skin_message;
	$skin_name = $_GET['skinname'];

	dynamik_skin_options_update( $skin_name, true );

	$skin_message = '<div class="notice-box" style="margin:0 0 15px;"><strong>' . __( 'Dynamik Skin Snapshot Update Complete', 'dynamik' ) . '</strong></div>';
}

/**
 * Upon import, push the imported Skin name into the database and set it as the active Skin.
 *
 * @since 1.6
 */
function dynamik_import_skin( $skin_name )
{
	$dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );

	array_push( $dynamik_gen_skin_options['available_skins'], $skin_name );
	$dynamik_gen_skin_options['available_skins'] = array_unique( $dynamik_gen_skin_options['available_skins'] );

	$dynamik_gen_skin_options['active_skin'] = $skin_name;
	update_option( 'dynamik_gen_skin_options', $dynamik_gen_skin_options );
}

/**
 * Copy the currently active Dynamik Skin using the name given by the user
 * and then set the new Skin as the currently active Dynamik Skin.
 *
 * @since 1.6
 */
function dynamik_copy_skin( $skin_name )
{
	$dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );
	$dynamik_gen_active_skin_options = get_option( 'dynamik_gen_' . $dynamik_gen_skin_options['active_skin'] . '_skin' );
	if( !get_option( 'dynamik_gen_' . $skin_name . '_skin' ) )
	{
		$import_notice = 'skin-copy-complete';
		update_option( 'dynamik_gen_' . $skin_name . '_skin', $dynamik_gen_active_skin_options );
	}
	else
	{
		$import_notice = 'skin-copy-error';
		wp_redirect( admin_url( 'admin.php?page=dynamik-design&activetab=dynamik-design-options-nav-skins&notice=' . $import_notice ) );
		exit();
	}

	dynamik_skin_options_update( $dynamik_gen_skin_options['active_skin'] );

	$styles_exist = true;
	$functions_exist = true;
	$scripts_exist = true;

	if( !file_exists( dynamik_get_skins_folder_path() . '/' . $dynamik_gen_skin_options['active_skin'] . '/style.css' ) )
	{
		$styles_exist = false;
		$styles = '/*
	Skin Name: ' . dynamik_unsanatize_string( $skin_name ) . '
	Skin URI: http://cobaltapps.com/
	Author: The Cobalt Apps Team
	Author URI: http://cobaltapps.com/
	Version: 1.0
*/

';
	}

	if( !file_exists( dynamik_get_skins_folder_path() . '/' . $dynamik_gen_skin_options['active_skin'] . '/functions.php' ) )
	{
		$functions_exist = false;
		$functions = "<?php
/**
 * Dynamik Skin functions.
 */

/*** BEGIN CORE SKIN FUNCTIONS
	Below is code that is critical to both creating Dynamik and Exported Child Theme
	compatible constants as well as calling in your Skin's scripts.js file. So leave this
	code alone unless you absolutely know what you're doing and why you're editing it.
***/

// Define the Skin constants.
if ( CHILD_THEME_NAME != 'Dynamik Website Builder' ) {
	define( 'SKIN_DIR', get_stylesheet_directory() . '/lib' );
	define( 'SKIN_URL', get_stylesheet_directory_uri() . '/lib' );
} else {
	define( 'SKIN_DIR', dynamik_get_active_skin_folder_path() );
	define( 'SKIN_URL', dynamik_get_active_skin_folder_url() );
}

add_action( 'wp_enqueue_scripts', 'skin_register_scripts' );
/**
 * Register additional Skin scripts and styles.
 *
 * @since 1.0
 */
function skin_register_scripts() {
	/* Uncomment the line below (remove the two beginning forward slasses '//') to activate your {JS} file. */
	//wp_register_script( 'skin-scripts', SKIN_URL . '/scripts.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'skin_load_scripts' );
/**
 * Load additional Skin scripts and styles.
 *
 * @since 1.0
 */
function skin_load_scripts() {
	/* Uncomment the line below (remove the two beginning forward slasses '//') to activate your {JS} file. */
	//wp_enqueue_script( 'skin-scripts' );
}

/*** END CORE SKIN FUNCTIONS
	Below you may include additional Skin functions.
***/

//end Dynamik Skin functions.php";
	}

	if( !file_exists( dynamik_get_skins_folder_path() . '/' . $dynamik_gen_skin_options['active_skin'] . '/scripts.js' ) )
	{
		$scripts_exist = false;
		$scripts = '/* PLEASE NOTE: To make this {JS} file active you must uncomment two lines of code in your Skin\'s {PHP} file. */

/*
 * Add regular (non-jQuery) Javascript code above.
 * Add jQuery code by placing it between the opening "{" bracket and closing "});" brackets below.
 */
jQuery(document).ready(function($) {

	

});';
	}

	dynamik_recurse_copy( dynamik_get_skins_folder_path() . '/' . $dynamik_gen_skin_options['active_skin'], dynamik_get_skins_folder_path() . '/' . $skin_name );
	
	dynamik_import_skin( $skin_name );

	if( false == $styles_exist )
	{
		dynamik_write_active_skin_file( $code = $styles, $type = 'styles' );
	}

	if( false == $functions_exist )
	{
		dynamik_write_active_skin_file( $code = $functions, $type = 'functions' );
	}

	if( false == $scripts_exist )
	{
		dynamik_write_active_skin_file( $code = $scripts, $type = 'scripts' );
	}

	wp_redirect( admin_url( 'admin.php?page=dynamik-design&activetab=dynamik-design-options-nav-skins&notice=' . $import_notice ) );
	exit();
}

/**
 * Turn the Skin style.css info into an array of useful values.
 *
 * @since 1.6
 */
function dynamik_skin_style_info( $skin_name = 'default' )
{
	if( file_exists( dynamik_get_skins_folder_path() . '/' . $skin_name . '/style.css' ) )
	{
		$style_css = dynamik_get_skins_folder_path() . '/' . $skin_name . '/style.css';
		$style_lines = file( $style_css );
		$author = substr( $style_lines[3], 9 );
		$version = substr( $style_lines[5], 10 );
		$styles_exist = true;
	}
	else
	{
		$author = 'Unknown Author';
		$version = '1.0';
		$styles_exist = false;
	}
	$style_info = array(
		'author' => $author,
		'version' => $version . ' ',
		'styles_exist' => $styles_exist
	);

	return $style_info;
}

/**
 * Update the appropriate Dynamik Skin WP Options table array with the latest Dynamik Settings.
 *
 * @since 1.6
 */
function dynamik_skin_options_update( $skin_name, $snapshot = false, $skin_update = false, $skin_images_list = array() )
{
	$skin_import = false;
	if( !get_option( 'dynamik_gen_' . $skin_name . '_skin' ) )
		$skin_import = true;

	$current_dynamik_skin_options = true == $skin_import ? array() : get_option( 'dynamik_gen_' . $skin_name . '_skin' );

	$dynamik_skin_options['design_options'] = dynamik_get_design( null, $args = array( 'cached' => true, 'array' => true ) );
	$dynamik_skin_options['responsive_options'] = dynamik_get_responsive( null, $args = array( 'cached' => true, 'array' => true ) );
	$dynamik_skin_options['design_options_snapshot'] = ( true == $snapshot || true == $skin_import ) ? $dynamik_skin_options['design_options'] : $current_dynamik_skin_options['design_options_snapshot'];
	$dynamik_skin_options['responsive_options_snapshot'] = ( true == $snapshot || true == $skin_import ) ? $dynamik_skin_options['responsive_options'] : $current_dynamik_skin_options['responsive_options_snapshot'];
	$dynamik_skin_options['snapshot_timestamp'] = ( true == $snapshot || true == $skin_import ) ? gmdate( 'Y-m-d H:i:s', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) ) : $current_dynamik_skin_options['snapshot_timestamp'];
	$dynamik_skin_options['skin_images_list'] = ( true == $skin_import || true == $skin_update ) ? $skin_images_list : $current_dynamik_skin_options['skin_images_list'];

	update_option( 'dynamik_gen_' . $skin_name . '_skin', $dynamik_skin_options );
}

/**
 * Restore the appropriate Dynamik Skin Settings from the most recent Dynamik Settings Snapshot.
 *
 * @since 1.6
 */
function dynamik_skin_options_restore( $skin_name )
{
	$current_dynamik_skin_options = get_option( 'dynamik_gen_' . $skin_name . '_skin' );
	$dynamik_design_options_restore = array_merge( dynamik_design_options_defaults( false, false, $current_dynamik_skin_options['design_options_snapshot'] ), $current_dynamik_skin_options['design_options_snapshot'] );
	update_option( 'dynamik_gen_design_options', $dynamik_design_options_restore );
	$responsive_options_restore = array_merge( dynamik_responsive_options_defaults(), $current_dynamik_skin_options['responsive_options_snapshot'] );
	update_option( 'dynamik_gen_responsive_options', $responsive_options_restore );
	
	dynamik_write_files( $css = true, $ez = true, $custom = false );
}

/**
 * Delete any images associated with the Dynamik Skin that is currently being de-activated or deleted.
 *
 * NOTE: Be sure to execute this function BEFORE the dynamik_gen_skin_options array is updated to the
 * current Dynamik Skin (just imported or activated).
 *
 * @since 1.6
 */
function dynamik_skin_images_cleanup()
{
	$dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );
	$dynamik_gen_active_skin_options = get_option( 'dynamik_gen_' . $dynamik_gen_skin_options['active_skin'] . '_skin' );
	$skin_images_list = is_array( $dynamik_gen_active_skin_options['skin_images_list'] ) ? $dynamik_gen_active_skin_options['skin_images_list'] : array();

	$handle = opendir( dynamik_get_stylesheet_location( 'path' ) . 'images' );
	while( false !== ( $file = readdir( $handle ) ) )
	{
		$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
		if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
		{
			if( in_array( $file, $skin_images_list ) )
			{
				if( file_exists( dynamik_get_stylesheet_location( 'path' ) . 'images' . '/' . $file ) )
					unlink( dynamik_get_stylesheet_location( 'path' ) . 'images' . '/' . $file );

				if( file_exists( dynamik_get_stylesheet_location( 'path' ) . 'images' . '/adminthumbnails/' . $file ) )
					unlink( dynamik_get_stylesheet_location( 'path' ) . 'images' . '/adminthumbnails/' . $file );
			}
		}
	}
	closedir( $handle );
}

/**
 * Scan the Dynamik Skins folder for specific information
 * to be used in the Dynamik Design > Skins admin page.
 *
 * @since 1.6
 */
function dynamik_skins_folder_scan( $skin_check = false )
{
	if( dynamik_dir_check( dynamik_get_skins_folder_path() ) )
	{
		$skin_folder_names = scandir( dynamik_get_skins_folder_path() );
		if( false != $skin_check )
		{
			if( in_array( $skin_check, $skin_folder_names ) )
				return true;
			else
				return false;
		}
	}
	else
	{
		return;
	}	
}

/**
 * Check for Dynamik Skin screenshots.
 *
 * @since 1.6
 */
function dynamik_skin_screenshot_check( $skin_name )
{
	if( file_exists( dynamik_get_skins_folder_path() . '/' . $skin_name . '/skin-screenshot.png' ) )
		$skin_screenshot_url = dynamik_get_stylesheet_location( 'url', $root = true ) . 'skins/' . $skin_name . '/skin-screenshot.png';
	else
		$skin_screenshot_url = CHILD_URL . '/images/skin-screenshot.png';

	return $skin_screenshot_url;
}

/**
 * Convert Dynamik Skin style.css ../../theme/images/... CSS code to images/...
 *
 * @since 1.6.3
 */
function dynamik_skin_css_images_converter( $skin_css )
{
	$skin_css = str_replace( '../../theme/images/', 'images/', $skin_css );

	return $skin_css;
}
