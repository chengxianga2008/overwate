<?php
/**
 * Locate, Write and Add various Dynamik files.
 *
 * @package Dynamik
 */
 
/**
 * Get the stylesheet location based on the type of stylesheet.
 *
 * @since 1.0
 * @return the stylesheet location.
 */
function dynamik_get_stylesheet_location( $type, $root = false )
{      
    $uploads = wp_upload_dir();

    if( dynamik_get_settings( 'protocol_relative_urls' ) )
    {
        $base_url = $uploads['baseurl'];
        $base_dir = $uploads['basedir'];
        $dir = ( 'url' == $type ) ? str_replace( 'http:', '', $base_url ) : $base_dir;
    }
    else
    {
        $dir = ( 'url' == $type ) ? $uploads['baseurl'] : $uploads['basedir'];
    }

    $sub_dir = $root ? '/dynamik-gen/' : '/dynamik-gen/theme/';

    return apply_filters( 'dynamik_get_stylesheet_location', $dir . $sub_dir );
}

/**
 * Get the stylesheet name based on the name value passed into the function.
 *
 * @since 1.0
 * @return the stylesheet name.
 */
function dynamik_get_stylesheet_name( $slug='stylesheet' )
{
    return apply_filters( 'dynamik_get_stylesheet_name', $slug . '.css' );
}

/**
 * Get the Dynamik stylesheet name.
 *
 * @since 1.0
 * @return the Dynamik stylesheet name.
 */
function dynamik_get_design_stylesheet_name()
{
    return apply_filters( 'dynamik_get_design_stylesheet_name', dynamik_get_stylesheet_name( 'dynamik' ) );
}

/**
 * Get the minified Dynamik stylesheet name.
 *
 * @since 1.0
 * @return the minified Dynamik stylesheet name.
 */
function dynamik_get_minified_stylesheet_name()
{
    return apply_filters( 'dynamik_get_minified_stylesheet_name', dynamik_get_stylesheet_name( 'dynamik-min' ) );
}

/**
 * Get the Custom stylesheet name.
 *
 * @since 1.0
 * @return the Custom stylesheet name.
 */
function dynamik_get_custom_stylesheet_name()
{
    return apply_filters( 'dynamik_get_custom_stylesheet_name', dynamik_get_stylesheet_name( 'dynamik-custom' ) );
}

/**
 * Get the Dynamik stylesheet path.
 *
 * @since 1.0
 * @return the Dynamik stylesheet path.
 */
function dynamik_get_design_stylesheet_path()
{
    return apply_filters( 'dynamik_get_design_stylesheet_path', dynamik_get_stylesheet_location( 'path' ) . dynamik_get_design_stylesheet_name() );
}

/**
 * Get the minified Dynamik stylesheet path.
 *
 * @since 1.0
 * @return the minified Dynamik stylesheet path.
 */
function dynamik_get_minified_stylesheet_path()
{
    return apply_filters( 'dynamik_get_minified_stylesheet_path', dynamik_get_stylesheet_location( 'path' ) . dynamik_get_minified_stylesheet_name() );
}

/**
 * Get the Custom stylesheet path.
 *
 * @since 1.0
 * @return the Custom stylesheet path.
 */
function dynamik_get_custom_stylesheet_path()
{
    return apply_filters( 'dynamik_get_custom_stylesheet_path', dynamik_get_stylesheet_location( 'path' ) . dynamik_get_custom_stylesheet_name() );
}

/**
 * Get the Dynamik stylesheet url.
 *
 * @since 1.0
 * @return the Dynamik stylesheet url.
 */
function dynamik_get_design_stylesheet_url() {
    return apply_filters( 'dynamik_get_design_stylesheet_url', dynamik_get_stylesheet_location( 'url' ) . dynamik_get_design_stylesheet_name() );
}

/**
 * Get the minified Dynamik stylesheet url.
 *
 * @since 1.0
 * @return the minified Dynamik stylesheet url.
 */
function dynamik_get_minified_stylesheet_url() {
    return apply_filters( 'dynamik_get_minified_stylesheet_url', dynamik_get_stylesheet_location( 'url' ) . dynamik_get_minified_stylesheet_name() );
}

/**
 * Get the Custom stylesheet url.
 *
 * @since 1.0
 * @return the Custom stylesheet url.
 */
function dynamik_get_custom_stylesheet_url() {
    return apply_filters( 'dynamik_get_custom_stylesheet_url', dynamik_get_stylesheet_location( 'url' ) . dynamik_get_custom_stylesheet_name() );
}
 
/**
 * Get the Dynamik EZ Structure file path.
 *
 * @since 1.0
 * @return the Dynamik EZ Structure file path.
 *
 */
function dynamik_get_ez_structure_path()
{
    return dynamik_get_stylesheet_location( 'path' ) . 'ez-structures.php';
}

/**
 * Get the Dynamik Custom Functions file path.
 *
 * @since 1.0
 * @return the Dynamik Custom Functions file path.
 *
 */
function dynamik_get_custom_functions_path()
{
    return dynamik_get_stylesheet_location( 'path' ) . 'custom-functions.php';
}

/**
 * Get the Dynamik Custom JS file path.
 *
 * @since 1.2
 * @return the Dynamik Custom JS file path.
 *
 */
function dynamik_get_custom_js_path()
{
    return dynamik_get_stylesheet_location( 'path' ) . 'custom-scripts.js';
}

/**
 * Get the Dynamik Custom Template file paths.
 *
 * @since 1.2
 * @return the Dynamik Custom Template file paths.
 *
 */
function dynamik_get_custom_template_paths( $template_file_name, $template_type )
{
    if( $template_type == 'page_template' )
    {
        return CHILD_DIR . '/my-templates/' . $template_file_name . '.php';
    }
    else
    {
        return CHILD_DIR . '/' . $template_file_name . '.php';
    }
}

/**
 * Get the Dynamik Custom Widget Areas Register file path.
 *
 * @since 1.0
 * @return the Dynamik Custom Widget Areas Register file path.
 *
 */
function dynamik_get_custom_widget_areas_register_path()
{
    return dynamik_get_stylesheet_location( 'path' ) . 'custom-widget-areas-register.php';
}

/**
 * Get the Dynamik Custom Widget Areas file path.
 *
 * @since 1.0
 * @return the Dynamik Custom Widget Areas file path.
 *
 */
function dynamik_get_custom_widget_areas_path()
{
    return dynamik_get_stylesheet_location( 'path' ) . 'custom-widget-areas.php';
}

/**
 * Get the Dynamik Custom Hook Boxes file path.
 *
 * @since 1.0
 * @return the Dynamik Custom Hook Boxes file path.
 *
 */
function dynamik_get_custom_hook_boxes_path()
{
    return dynamik_get_stylesheet_location( 'path' ) . 'custom-hook-boxes.php';
}

/**
 * Get the Dynamik Skins folder url.
 *
 * @since 1.6
 * @return the Dynamik Skins folder url.
 *
 */
function dynamik_get_skins_folder_url()
{
    return dynamik_get_stylesheet_location( 'url', $root = true ) . 'skins';
}

/**
 * Get the active Dynamik Skins folder url.
 *
 * @since 1.6
 * @return the active Dynamik Skins folder url.
 *
 */
function dynamik_get_active_skin_folder_url()
{
    $dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );
    return dynamik_get_skins_folder_url() . '/' . $dynamik_gen_skin_options['active_skin'];
}

/**
 * Get the Dynamik Skins folder path.
 *
 * @since 1.6
 * @return the Dynamik Skins folder path.
 *
 */
function dynamik_get_skins_folder_path()
{
    return dynamik_get_stylesheet_location( 'path', $root = true ) . 'skins';
}

/**
 * Get the active Dynamik Skins folder path.
 *
 * @since 1.6
 * @return the active Dynamik Skins folder path.
 *
 */
function dynamik_get_active_skin_folder_path()
{
    $dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );
    return dynamik_get_skins_folder_path() . '/' . $dynamik_gen_skin_options['active_skin'];
}
