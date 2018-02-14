<?php
/**
 * This is the initialization file for Dynamik,
 * defining constants, globaling database option arrays
 * and requiring other function files.
 *
 * @package Dynamik
 */
 
/**
 * Define Dynamik child theme constants.
 */
define( 'CHILD_THEME_NAME', 'Dynamik Website Builder' );
define( 'CHILD_THEME_VERSION', '2.0.4' );
define( 'DYN_FONT_AWESOME_VERSION', '4.7.0' );

/**
 * Localization.
 */
load_child_theme_textdomain( 'dynamik', apply_filters( 'child_theme_textdomain', CHILD_DIR . '/lib/languages', 'dynamik' ) );

/**
 * Require files.
 */
require_once( CHILD_DIR . '/lib/functions/file-paths.php' );
require_once( CHILD_DIR . '/lib/functions/options.php' );

/**
 * Define Dynamik child theme constants.
 *
 * Note: Because this constant uses the dynamik_get_settings
 * function it has to be defined AFTER the dynamik-settings.php
 * file is called.
 */
$child_theme_url = dynamik_get_settings( 'affiliate_link' ) != '' ? dynamik_get_settings( 'affiliate_link' ) : 'http://cobaltapps.com/downloads/dynamik-website-builder/';
define( 'CHILD_THEME_URL', $child_theme_url );

require_once( CHILD_DIR . '/lib/functions/add-styles.php' );
require_once( CHILD_DIR . '/lib/functions/general.php' );
require_once( CHILD_DIR . '/lib/functions/navbars.php' );
require_once( CHILD_DIR . '/lib/functions/fonts.php' );
require_once( CHILD_DIR . '/lib/functions/ez-functions.php' );

/**
 * Create a global to define whether or not the FE CSS Buidler tool is active.
 */
$dynamik_fe_css_builder = false;

if( dynamik_get_custom_css( 'css_builder_popup_active' ) && current_user_can( 'administrator' ) )
{
	$dynamik_fe_css_builder = true;
}

add_action( 'init', 'dynamik_fe_style_editor_init' );
/**
 * Conditionally initialize the front-end style editor functionality.
 *
 * @since 2.0
 */
function dynamik_fe_style_editor_init() {
	
	global $dynamik_fe_css_builder;
	
	if ( ! $dynamik_fe_css_builder )
		return;
	
	if ( ! is_admin() ) {
		
		require_once( CHILD_DIR . '/lib/admin/fe-style-editor/style-editor.php' );
		require_once( CHILD_DIR . '/lib/admin/fe-css-builder/general.php' );
		require_once( CHILD_DIR . '/lib/admin/fe-css-builder/genesis-elements.php' );
		require_once( CHILD_DIR . '/lib/admin/fe-css-builder/fe-css-builder.php' );
		
	}
	
	add_action( 'wp_ajax_dynamik_fe_style_editor_save', 'dynamik_fe_style_editor_save' );
	/**
	 * Use ajax to update the theme styles based on the posted values.
	 *
	 * @since 2.0
	 */
	function dynamik_fe_style_editor_save() {
		
		check_ajax_referer( 'dynamik-fe-style-editor', 'security' );
		
		$update = array(
			'custom_css' => $_POST['dynamik']['custom_css'],
			'css_builder_popup_active' => dynamik_get_custom_css( 'css_builder_popup_active' ),
			'custom_functions' => dynamik_get_custom_css( 'custom_functions' )
		);
		$update_merged = array_merge( dynamik_custom_css_options_defaults(), $update );
		update_option( 'dynamik_gen_custom_css', $update_merged );
		
		dynamik_write_files( $css = true, $ez = false, $custom = false  );
		
		echo 'Custom CSS Updated';
		
		exit();
		
	}
		
}

/**
 * Create globals and Require files only needed for admin.
 */
if( is_admin() )
{
	/**
	 * Create globals to define both the folder locations to be written to and their current writable state.
	 */
	$dynamik_folders = array( CHILD_DIR, CHILD_DIR . '/my-templates', dynamik_get_stylesheet_location( 'path', $root = true ), dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders', dynamik_get_skins_folder_path(), dynamik_get_stylesheet_location( 'path' ), dynamik_get_stylesheet_location( 'path' ) . 'images', dynamik_get_stylesheet_location( 'path' ) . 'adminthumbnails', dynamik_get_stylesheet_location( 'path' ) . 'tmp', dynamik_get_stylesheet_location( 'path' ) . 'tmp/images', dynamik_get_stylesheet_location( 'path' ) . 'tmp/images/adminthumbnails' );
	$dynamik_unwritable = false;

	foreach( $dynamik_folders as $dynamik_folder )
	{
		if( is_dir( $dynamik_folder ) && !is_writable( $dynamik_folder ) )
		{
			// Update $dynamik_unwritable global.
			$dynamik_unwritable = true;
		}
	}

	if( defined( 'GENEXT_VERSION' ) )
	{
		add_action( 'admin_notices', 'dynamik_extender_is_active_nag' );
		/**
		 * Build "Extender Is Active" Nag HTML.
		 *
		 * @since 1.2.2
		 */
		function dynamik_extender_is_active_nag()
		{			
			echo '<div id="update-nag">';
			printf( __( '<strong>Genesis Extender & Dynamik Website Builder Are Currently Active!</strong> If you are <a href="%s">transferring settings</a> then do so now, otherwise deactivate <a href="%s">Genesis Extender</a> or <a href="%s">Dynamik Website Builder</a>.', 'dynamik' ), admin_url( 'admin.php?page=dynamik-settings' ), admin_url( 'plugins.php' ), admin_url( 'themes.php' ) );
			echo '</div>';
		}
	}

	if( defined( 'GENESS_VERSION' ) )
	{
		add_action( 'admin_notices', 'dynamik_essentials_is_active_nag' );
		/**
		 * Build "Essentials Is Active" Nag HTML.
		 *
		 * @since 1.7
		 */
		function dynamik_essentials_is_active_nag()
		{			
			echo '<div id="update-nag">';
			printf( __( '<strong>Genesis Essentials & Dynamik Website Builder Are Currently Active!</strong> These two Cobalt Apps products are not to be used together so deactivate <a href="%s">Genesis Essentials</a> or <a href="%s">Dynamik Website Builder</a>.', 'dynamik' ), admin_url( 'plugins.php' ), admin_url( 'themes.php' ) );
			echo '</div>';
		}
	}

	require_once( CHILD_DIR . '/lib/functions/option-lists.php' );
	require_once( CHILD_DIR . '/lib/functions/skins.php' );
	require_once( CHILD_DIR . '/lib/admin/build-menu.php' );
	require_once( CHILD_DIR . '/lib/admin/theme-settings.php' );
	require_once( CHILD_DIR . '/lib/admin/design-options.php' );
	require_once( CHILD_DIR . '/lib/admin/custom-options.php' );
	require_once( CHILD_DIR . '/lib/functions/user-meta.php' );
	require_once( CHILD_DIR . '/lib/functions/build-styles.php' );
	require_once( CHILD_DIR . '/lib/functions/write-files.php' );
	require_once( CHILD_DIR . '/lib/functions/image-uploader.php' );
	require_once( CHILD_DIR . '/lib/update/theme-updater.php' );
	require_once( CHILD_DIR . '/lib/functions/import-export.php' );
	require_once( CHILD_DIR . '/lib/functions/ez-structures.php' );
	require_once( CHILD_DIR . '/lib/admin/metaboxes/metaboxes.php' );
	require_once( CHILD_DIR . '/lib/functions/templates.php' );
	require_once( CHILD_DIR . '/lib/functions/labels.php' );
	require_once( CHILD_DIR . '/lib/functions/conditionals.php' );
	require_once( CHILD_DIR . '/lib/functions/widget-areas.php' );
	require_once( CHILD_DIR . '/lib/functions/hook-boxes.php' );
	require_once( CHILD_DIR . '/lib/update/update.php' );
}

/**
 * Updated "Protected Folders" before potential auto-update of Dynamik.
 */
if( is_admin() && !isset( $_GET['activated'] ) && ( $pagenow == "themes.php" || $pagenow == "update-core.php" ) )
{
	dynamik_protect_folders();
}

/**
 * Run if Dynamik was just activated.
 */
if( is_admin() && isset( $_GET['activated'] ) && $pagenow == "themes.php" )
{
	dynamik_activate();
}

/**
 * Require the active Skin Functions file.
 */
dynamik_require_skin_functions_file();

/**
 * Require the Custom Functions file.
 */
dynamik_require_custom_functions_file();
