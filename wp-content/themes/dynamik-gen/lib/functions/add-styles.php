<?php
/**
 * Enqueue/Echo the Dynamik stylesheets/CSS.
 *
 * @package Dynamik
 */

remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'genesis_meta', 'dynamik_load_stylesheets' );
/**
 * Enqueue appropriate stylesheets.
 *
 * @since 1.6.2
 */
function dynamik_load_stylesheets()
{
	add_action( 'wp_enqueue_scripts', 'dynamik_add_stylesheets', 5 );
}
/**
 * Determine which stylesheet should be displayed and where
 * based on the Dynamik options.
 *
 * @since 1.0
 */
function dynamik_add_stylesheets()
{
	global $dynamik_fe_css_builder;
	
    if( !dynamik_get_design( 'minify_css' ) || $dynamik_fe_css_builder )
	{
		if( file_exists( dynamik_get_design_stylesheet_path() ) )
		{
			wp_enqueue_style( 'dynamik_design_stylesheet', dynamik_get_design_stylesheet_url(), array(), filemtime( dynamik_get_design_stylesheet_path() ) );
		}
		else
		{
			wp_enqueue_style( 'dynamik_genesis_stylesheet', PARENT_URL . '/style.css', array(), PARENT_THEME_VERSION );
		}
		if( file_exists( dynamik_get_active_skin_folder_path() . '/style.css' ) && !dynamik_get_design( 'minify_css' ) )
		{
			wp_enqueue_style( 'dynamik_skin_stylesheet', dynamik_get_active_skin_folder_url() . '/style.css', array(), filemtime( dynamik_get_active_skin_folder_path() . '/style.css' ) );
		}
		if( file_exists( dynamik_get_custom_stylesheet_path() ) && ! $dynamik_fe_css_builder )
		{
			wp_enqueue_style( 'dynamik_custom_stylesheet', dynamik_get_custom_stylesheet_url(), array(), filemtime( dynamik_get_custom_stylesheet_path() ) );
		}
    }
    elseif( dynamik_get_design( 'minify_css' ) )
	{
		if( file_exists( dynamik_get_minified_stylesheet_path() ) )
		{
			wp_enqueue_style( 'dynamik_minified_stylesheet', dynamik_get_minified_stylesheet_url(), array(), filemtime( dynamik_get_minified_stylesheet_path() ) );
		}
		else
		{
			wp_enqueue_style( 'dynamik_genesis_stylesheet', PARENT_URL . '/style.css', array(), PARENT_THEME_VERSION );
		}
    }
    if( dynamik_get_design( 'font_awesome_css' ) )
	{
		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/' . DYN_FONT_AWESOME_VERSION . '/css/font-awesome.min.css', array(), DYN_FONT_AWESOME_VERSION );
	}
}
