<?php
/**
 * Define and require all the necessary "bits and pieces"
 * and build all necessary Static Homepage and Featured area functions.
 *
 * @package Dynamik
 */

if( file_exists( dynamik_get_ez_structure_path() ) )
{
	if( dynamik_get_design_alt( 'dynamik_homepage_type' ) == 'static_home' ||
		dynamik_get_design_alt( 'ez_home_slider_display' ) ||
		dynamik_get_design_alt( 'ez_feature_top_select' ) != 'disabled' ||
		dynamik_get_design_alt( 'ez_fat_footer_select' ) != 'disabled' )
	{
		require_once( dynamik_get_ez_structure_path() );
	}

	/****************************************
		Static Homepage
	****************************************/

	/**
	 * Make sure the Dynamik Homepage Type has been set to "Static Home" and that
	 * the EZ Home Structure file exists before proceeding to hook the ez_home()
	 * function into the dynamik_hook_home hook location.
	 */
	if( dynamik_get_design_alt( 'dynamik_homepage_type' ) == 'static_home' )
	{
		add_action( 'dynamik_hook_home', 'ez_home' );
	}

	/**
	 * Make sure the Dynamik Homepage Type has been set to "Static Home" and that
	 * the EZ Home Structure file exists before proceeding to hook the ez_home_sidebar()
	 * function into the dynamik_hook_home hook location.
	 */
	if( dynamik_get_design_alt( 'dynamik_homepage_type' ) == 'static_home' &&
		dynamik_get_design_alt( 'ez_static_home_sb_display' ) )
	{
		add_action( 'dynamik_hook_home', 'ez_home_sidebar' ); 
	}

	/**
	 * Make sure the EZ Home Slider is currently active before proceeding to
	 * require the EZ Home Slider Structure file and corresponding function.
	 */
	if( dynamik_get_design_alt( 'ez_home_slider_display' ) )
	{
		/**
		 * Determine where to hook in the Home Image Slider based on
		 * whether or not the Static Homepage is active.
		 */
		if( dynamik_get_design_alt( 'dynamik_homepage_type' ) == 'default_home' )
		{
			/**
			 * Determine where to hook in the Home Image Slider based on
			 * Home Slider Layout option setting.
			 */
			if( dynamik_get_design_alt( 'ez_home_slider_location' ) == 'outside' )
			{
				add_action( 'genesis_before_content_sidebar_wrap', 'ez_home_slider' );
			}
			else
			{
				add_action( 'genesis_before_loop', 'ez_home_slider' );
			}
		}
		else
		{
			/**
			 * Determine where to hook in the Home Image Slider based on
			 * Home Slider Layout option setting.
			 */
			if( dynamik_get_design_alt( 'ez_home_slider_location' ) == 'outside' )
			{
				add_action( 'dynamik_hook_home', 'ez_home_slider', 6 );
			}
			else
			{
				add_action( 'dynamik_hook_before_ez_home', 'ez_home_slider' );
			}
		}
	}

	/****************************************
		Feature Top
	****************************************/

	/**
	 * Hook the Feature Top Structure function into the 'wp' Hook.
	 */
	add_action( 'wp_head', 'ez_feature_top_structure' );
	/**
	 * Determine where NOT to display the Feature Top section before hooking it in.
	 *
	 * @since 1.0
	 */
	function ez_feature_top_structure()
	{
		if( dynamik_get_design_alt( 'ez_feature_top_select' ) != 'disabled' )
		{
			if( is_front_page() && !dynamik_get_design_alt( 'ez_feature_top_display_front_page' ) )
				return;
			if( is_single() && !dynamik_get_design_alt( 'ez_feature_top_display_posts' ) )
				return;
			if( ( is_page() || is_404() ) && !is_front_page() && !is_page_template( 'page_blog.php' ) && !dynamik_get_design_alt( 'ez_feature_top_display_pages' ) )
				return;
			if( ( is_archive() || is_search() ) && !dynamik_get_design_alt( 'ez_feature_top_display_archives' ) )
				return;
			if( ( ( !is_front_page() && is_home() ) || is_page_template( 'page_blog.php' ) ) && !dynamik_get_design_alt( 'ez_feature_top_display_blog' ) )
				return;
			if( is_page_template( 'landing.php' ) )
				return;
			
			if( dynamik_get_design_alt( 'ez_feature_top_position' ) == 'outside_inner' )
			{
				add_action( 'genesis_after_header', 'ez_feature_top' );
			}
			else
			{
				if( is_front_page() && dynamik_get_design_alt( 'dynamik_homepage_type' ) == 'static_home' )
				{
					add_action( 'dynamik_hook_home', 'ez_feature_top', 5 );
				}
				else
				{
					add_action( 'genesis_before_content_sidebar_wrap', 'ez_feature_top', 5 );
				}
			}
		}
	}

	/****************************************
		Fat Footer
	****************************************/

	/**
	 * Hook the Fat Footer structure function into the 'wp' Hook.
	 */
	add_action( 'wp_head', 'ez_fat_footer_structure' );
	/**
	 * Determine where NOT to display the Fat Footer section before hooking it in.
	 *
	 * @since 1.0
	 */
	function ez_fat_footer_structure()
	{
		if( dynamik_get_design_alt( 'ez_fat_footer_select' ) != 'disabled' )
		{
			if( is_front_page() && !dynamik_get_design_alt( 'ez_fat_footer_display_front_page' ) )
				return;
			if( is_single() && !dynamik_get_design_alt( 'ez_fat_footer_display_posts' ) )
				return;
			if( ( is_page() || is_404() ) && !is_front_page() && !is_page_template( 'page_blog.php' ) && !dynamik_get_design_alt( 'ez_fat_footer_display_pages' ) )
				return;
			if( ( is_archive() || is_search() ) && !dynamik_get_design_alt( 'ez_fat_footer_display_archives' ) )
				return;
			if( ( ( !is_front_page() && is_home() ) || is_page_template( 'page_blog.php' ) ) && !dynamik_get_design_alt( 'ez_fat_footer_display_blog' ) )
				return;
			if( is_page_template( 'landing.php' ) )
				return;
			
			if( dynamik_get_design_alt( 'ez_fat_footer_position' ) == 'outside_inner' )
			{
				add_action( 'genesis_before_footer', 'ez_fat_footer' );
			}
			else
			{
				if( is_front_page() && dynamik_get_design_alt( 'dynamik_homepage_type' ) == 'static_home' )
				{
					add_action( 'dynamik_hook_home', 'ez_fat_footer' );
				}
				else
				{
					add_action( 'genesis_after_content_sidebar_wrap', 'ez_fat_footer' );
				}
			}
		}
	}
}
