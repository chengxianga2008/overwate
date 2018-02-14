<?php
/**
 * Builds the Dynamik stylesheet.
 *
 * @package Dynamik
 */

/**
 * Calculate the Dynamik CSS based on the current Dynamik settings.
 *
 * @since 1.0
 * @return the Dynamik CSS based on the current Dynamik settings.
 */
function dynamik_build_design_styles( $child = 'no' )
{
	dynamik_get_settings( null, $args = array( 'cached' => false, 'array' => false ) );
	dynamik_get_design( null, $args = array( 'cached' => false, 'array' => false ) );
	dynamik_get_responsive( null, $args = array( 'cached' => false, 'array' => false ) );
	dynamik_get_custom_css( null, $args = array( 'cached' => false, 'array' => false ) );

	$dynamik_font_type = dynamik_get_design( 'font_type' );
	$dynamik_font_types_array = dynamik_font_types_array();
	foreach( $dynamik_font_type as $key => $value )
	{
		if( array_key_exists( $value, $dynamik_font_types_array ) )
			$dynamik_font_type[$key] = $dynamik_font_types_array[$value];
		else
			$dynamik_font_type[$key] = $dynamik_font_types_array['Arial'];
	}

	if( dynamik_get_settings( 'responsive_enabled' ) )
	{
		$width = 'max-width';
	}
	else
	{
		$width = 'width';
	}
	$dynamik_custom_labels = get_option( 'dynamik_gen_custom_labels' );

	/****************************************
			Define Widths & Padding
	****************************************/
	
	// Content area widths
	$cc_width_dbl_rt_sb = dynamik_get_design( 'cc_width_dbl_rt_sb' );
	$sb1_width_dbl_rt_sb = dynamik_get_design( 'sb1_width_dbl_rt_sb' );
	$sb2_width_dbl_rt_sb = dynamik_get_design( 'sb2_width_dbl_rt_sb' );
	
	$cc_width_dbl_lft_sb = dynamik_get_design( 'cc_width_dbl_lft_sb' );
	$sb1_width_dbl_lft_sb = dynamik_get_design( 'sb1_width_dbl_lft_sb' );
	$sb2_width_dbl_lft_sb = dynamik_get_design( 'sb2_width_dbl_lft_sb' );
	
	$cc_width_dbl_sb = dynamik_get_design( 'cc_width_dbl_sb' );
	$sb1_width_dbl_sb = dynamik_get_design( 'sb1_width_dbl_sb' );
	$sb2_width_dbl_sb = dynamik_get_design( 'sb2_width_dbl_sb' );
	
	$cc_width_rt_sb = dynamik_get_design( 'cc_width_rt_sb' );
	$sb1_width_rt_sb = dynamik_get_design( 'sb1_width_rt_sb' );
	
	$cc_width_lft_sb = dynamik_get_design( 'cc_width_lft_sb' );
	$sb1_width_lft_sb = dynamik_get_design( 'sb1_width_lft_sb' );
	
	$cc_width_no_sb = dynamik_get_design( 'cc_width_no_sb' );

	$delayed_sidebar_width = dynamik_get_responsive( 'delayed_sidebar_width' );
	$delayed_sidebar_content_margin = $delayed_sidebar_width + 20;

	$label_cc_sb_sb_width = $cc_width_dbl_rt_sb + $sb1_width_dbl_rt_sb + $sb2_width_dbl_rt_sb;
	$label_cc_sb_width = $cc_width_rt_sb + $sb1_width_rt_sb;
	$label_cc_width = $cc_width_no_sb;
	
	// Horizontal padding
	$wrap_lr_padding = dynamik_get_design( 'wrap_lr_padding' );
	$inner_lr_padding = dynamik_get_design( 'inner_lr_padding' );
	$sb_separation_padding = dynamik_get_design( 'sb_separation_padding' );
	
	$inner_border_thickness = dynamik_get_design( 'inner_border_thickness' );
	
	if( dynamik_get_design( 'inner_border_type' ) == 'Full' )
	{
		$inner_lr_border_thickness_combined = $inner_border_thickness * 2;
	}
	elseif( dynamik_get_design( 'inner_border_type' ) == 'Top/Bottom' )
	{
		$inner_lr_border_thickness_combined = 0;
	}
	else
	{
		$inner_lr_border_thickness_combined = $inner_border_thickness * 2;
	}
	
	// Vertical margins and padding
	$wrap_top_margin = dynamik_get_design( 'wrap_top_margin' );
	$wrap_bottom_margin = dynamik_get_design( 'wrap_bottom_margin' );
	$wrap_tb_padding = dynamik_get_design( 'wrap_tb_padding' );
	$inner_top_margin = dynamik_get_design( 'inner_top_margin' );
	$inner_bottom_margin = dynamik_get_design( 'inner_bottom_margin' );
	$inner_tb_padding = dynamik_get_design( 'inner_tb_padding' );
	$content_padding_top = dynamik_get_design( 'content_padding_top' );
	$content_padding_right = dynamik_get_design( 'content_padding_right' );
	$content_padding_bottom = dynamik_get_design( 'content_padding_bottom' );
	$content_padding_left = dynamik_get_design( 'content_padding_left' );
	
	$content_lr_border_thickness_combined = $content_padding_right + $content_padding_left;
	
	$cc_plus_sb_width_dbl_rt_sb = $cc_width_dbl_rt_sb + $sb1_width_dbl_rt_sb + $sb2_width_dbl_rt_sb + $content_lr_border_thickness_combined;
	$cc_plus_sb_width_dbl_lft_sb = $cc_width_dbl_lft_sb + $sb1_width_dbl_lft_sb + $sb2_width_dbl_lft_sb + $content_lr_border_thickness_combined;
	$cc_plus_sb_width_dbl_sb = $cc_width_dbl_sb + $sb1_width_dbl_sb + $sb2_width_dbl_sb + $content_lr_border_thickness_combined;
	$cc_plus_sb_width_rt_sb = $cc_width_rt_sb + $sb1_width_rt_sb + $content_lr_border_thickness_combined;
	$cc_plus_sb_width_lft_sb = $cc_width_lft_sb + $sb1_width_lft_sb + $content_lr_border_thickness_combined;
	$cc_plus_sb_width_no_sb = $cc_width_no_sb + $content_lr_border_thickness_combined;
	
	$content_sb_wrap_width_dbl_rt_sb = $cc_width_dbl_rt_sb + $sb1_width_dbl_rt_sb + $sb_separation_padding + $content_lr_border_thickness_combined;
	$content_sb_wrap_width_dbl_lft_sb = $cc_width_dbl_lft_sb + $sb1_width_dbl_lft_sb + $sb_separation_padding + $content_lr_border_thickness_combined;
	$content_sb_wrap_width_dbl_sb = $cc_width_dbl_sb + $sb1_width_dbl_sb + $sb_separation_padding + $content_lr_border_thickness_combined;
	$content_sb_wrap_width_rt_sb = $cc_width_rt_sb + $sb1_width_rt_sb + $sb_separation_padding + $content_lr_border_thickness_combined;
	$content_sb_wrap_width_lft_sb = $cc_width_lft_sb + $sb1_width_lft_sb + $sb_separation_padding + $content_lr_border_thickness_combined;
	$content_sb_wrap_width_no_sb = $cc_width_no_sb + $content_lr_border_thickness_combined;

	$label_pre_width_content_sb_wrap_dbl_sb = $content_sb_wrap_width_dbl_rt_sb - $cc_width_dbl_rt_sb - $sb1_width_dbl_rt_sb;
	$label_pre_width_content_sb_wrap_single_sb = $content_sb_wrap_width_rt_sb - $label_cc_sb_width;
	$label_pre_width_content_sb_wrap_no_sb = $content_sb_wrap_width_no_sb - $label_cc_width;
	
	// #wrap/.site-container and #inner/.site-inner total width calculations
	$inner_width_dbl_rt_sb = $cc_plus_sb_width_dbl_rt_sb + ( $sb_separation_padding * 2 );
	$inner_width_dbl_lft_sb = $cc_plus_sb_width_dbl_lft_sb + ( $sb_separation_padding * 2 );
	$inner_width_dbl_sb = $cc_plus_sb_width_dbl_sb + ( $sb_separation_padding * 2 );
	$inner_width_rt_sb = $cc_plus_sb_width_rt_sb + $sb_separation_padding;
	$inner_width_lft_sb = $cc_plus_sb_width_lft_sb + $sb_separation_padding;
	$inner_width_no_sb = $cc_plus_sb_width_no_sb;

	$label_pre_width_inner_dbl_sb = $inner_width_dbl_rt_sb - $label_cc_sb_sb_width;
	$label_pre_width_inner_single_sb = $inner_width_rt_sb - $label_cc_sb_width;
	$label_pre_width_inner_no_sb = $inner_width_no_sb - $label_cc_width;
	
	$wrap_width_dbl_rt_sb = $inner_width_dbl_rt_sb + ( $inner_lr_padding * 2 ) + $inner_lr_border_thickness_combined;
	$wrap_width_dbl_lft_sb = $inner_width_dbl_lft_sb + ( $inner_lr_padding * 2 ) + $inner_lr_border_thickness_combined;
	$wrap_width_dbl_sb = $inner_width_dbl_sb + ( $inner_lr_padding * 2 ) + $inner_lr_border_thickness_combined;
	$wrap_width_rt_sb = $inner_width_rt_sb + ( $inner_lr_padding * 2 ) + $inner_lr_border_thickness_combined;
	$wrap_width_lft_sb = $inner_width_lft_sb + ( $inner_lr_padding * 2 ) + $inner_lr_border_thickness_combined;
	$wrap_width_no_sb = $inner_width_no_sb + ( $inner_lr_padding * 2 ) + $inner_lr_border_thickness_combined;

	$label_pre_width_wrap_dbl_sb = $wrap_width_dbl_rt_sb - $label_cc_sb_sb_width;
	$label_pre_width_wrap_single_sb = $wrap_width_rt_sb - $label_cc_sb_width;
	$label_pre_width_wrap_no_sb = $wrap_width_no_sb - $label_cc_width;
	
	if( genesis_site_layout() == 'content-sidebar' )
	{
		$inner_width_ez_home = $wrap_width_rt_sb;
	}
	elseif( genesis_site_layout() == 'sidebar-content' )
	{
		$inner_width_ez_home = $wrap_width_lft_sb;
	}
	elseif( genesis_site_layout() == 'content-sidebar-sidebar' )
	{
		$inner_width_ez_home = $wrap_width_dbl_rt_sb;
	}
	elseif( genesis_site_layout() == 'sidebar-sidebar-content' )
	{
		$inner_width_ez_home = $wrap_width_dbl_lft_sb;
	}
	elseif( genesis_site_layout() == 'sidebar-content-sidebar' )
	{
		$inner_width_ez_home = $wrap_width_dbl_sb;
	}
	else
	{
		$inner_width_ez_home = $wrap_width_no_sb;
	}
	
	if( genesis_site_layout() == 'content-sidebar' )
	{
		$media_wrap_width = $wrap_width_rt_sb + ( $wrap_lr_padding * 2 );
	}
	elseif( genesis_site_layout() == 'sidebar-content' )
	{
		$media_wrap_width = $wrap_width_lft_sb + ( $wrap_lr_padding * 2 );
	}
	elseif( genesis_site_layout() == 'content-sidebar-sidebar' )
	{
		$media_wrap_width = $wrap_width_dbl_rt_sb + ( $wrap_lr_padding * 2 );
	}
	elseif( genesis_site_layout() == 'sidebar-sidebar-content' )
	{
		$media_wrap_width = $wrap_width_dbl_lft_sb + ( $wrap_lr_padding * 2 );
	}
	elseif( genesis_site_layout() == 'sidebar-content-sidebar' )
	{
		$media_wrap_width = $wrap_width_dbl_sb + ( $wrap_lr_padding * 2 );
	}
	else
	{
		$media_wrap_width = $wrap_width_no_sb + ( $wrap_lr_padding * 2 );
	}
	
	// Update the dynamik_gen_responsive_options with the latest media_wrap_width value.
	if( get_option( 'dynamik_gen_responsive_options' ) )
	{
		$media_wrap_width_array = array( 'media_wrap_width' => $media_wrap_width );
		$responsive_options_merged = array_merge( dynamik_get_responsive( null, $args = array( 'cached' => true, 'array' => true ) ), $media_wrap_width_array );
		update_option( 'dynamik_gen_responsive_options', $responsive_options_merged );
	}
	else
	{
		update_option( 'dynamik_gen_responsive_options', dynamik_responsive_options_defaults() );
	}
	dynamik_get_responsive( null, $args = array( 'cached' => false, 'array' => false ) );
	
	// EZ Widget Area width calculations
	$ez_widget_home_border_thickness = dynamik_get_design( 'ez_widget_home_border_thickness' );
	if( dynamik_get_design( 'ez_widget_home_border_type' ) == 'Full' || dynamik_get_design( 'ez_widget_home_border_type' ) == 'Left/Right' )
	{
		$ez_widget_home_lr_border_thickness = $ez_widget_home_border_thickness * 2;
	}
	else
	{
		$ez_widget_home_lr_border_thickness = 0;
	}
	$ez_home_lr_padding = dynamik_get_design( 'ez_widget_home_padding_left' ) + dynamik_get_design( 'ez_widget_home_padding_right' );
	$ez_home_container_wrap_with_sb_rt_spacing = 'margin-right: 300px;';
	$ez_home_container_wrap_with_sb_lft_spacing = 'margin-left: 300px;';
	$ez_home_container_wrap_with_sb_rt_alt_spacing = 'margin-right: 0;';
	$ez_home_sb_margin_lft = 'margin-left: -280px;';
	$ez_home_sb_margin_rt = 'margin-right: -280px;';
	$ez_home_sb_alt_margin_lft = 'margin-left: 0;';
	
	$ez_widget_feature_border_thickness = dynamik_get_design( 'ez_widget_feature_border_thickness' );
	if( dynamik_get_design( 'ez_widget_feature_border_type' ) == 'Full' || dynamik_get_design( 'ez_widget_feature_border_type' ) == 'Left/Right' )
	{
		$ez_widget_feature_lr_border_thickness = $ez_widget_feature_border_thickness * 2;
	}
	else
	{
		$ez_widget_feature_lr_border_thickness = 0;
	}
	
	$ez_feature_top_lr_padding = dynamik_get_design( 'ez_widget_feature_padding_left' ) + dynamik_get_design( 'ez_widget_feature_padding_right' );
	
	if( dynamik_get_design( 'ez_feature_top_position' ) == 'outside_inner' )
	{
		$ez_feature_top_container_width_dbl_rt_sb = $wrap_width_dbl_rt_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
		$ez_feature_top_container_width_dbl_lft_sb = $wrap_width_dbl_lft_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
		$ez_feature_top_container_width_dbl_sb = $wrap_width_dbl_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
		$ez_feature_top_container_width_rt_sb = $wrap_width_rt_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
		$ez_feature_top_container_width_lft_sb = $wrap_width_lft_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
		$ez_feature_top_container_width_no_sb = $wrap_width_no_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
	}
	else
	{
		$ez_feature_top_container_width_dbl_rt_sb = $inner_width_dbl_rt_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
		$ez_feature_top_container_width_dbl_lft_sb = $inner_width_dbl_lft_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
		$ez_feature_top_container_width_dbl_sb = $inner_width_dbl_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
		$ez_feature_top_container_width_rt_sb = $inner_width_rt_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
		$ez_feature_top_container_width_lft_sb = $inner_width_lft_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
		$ez_feature_top_container_width_no_sb = $inner_width_no_sb - $ez_feature_top_lr_padding - $ez_widget_feature_lr_border_thickness;
	}
	
	$ez_widget_footer_border_thickness = dynamik_get_design( 'ez_widget_footer_border_thickness' );
	if( dynamik_get_design( 'ez_widget_footer_border_type' ) == 'Full' || dynamik_get_design( 'ez_widget_footer_border_type' ) == 'Left/Right' )
	{
		$ez_widget_footer_lr_border_thickness = $ez_widget_footer_border_thickness * 2;
	}
	else
	{
		$ez_widget_footer_lr_border_thickness = 0;
	}
	
	$ez_fat_footer_lr_padding = dynamik_get_design( 'ez_widget_footer_padding_left' ) + dynamik_get_design( 'ez_widget_footer_padding_right' );
	
	if( dynamik_get_design( 'ez_fat_footer_position' ) == 'inside_inner' )
	{
		$ez_fat_footer_container_width_dbl_rt_sb = $inner_width_dbl_rt_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
		$ez_fat_footer_container_width_dbl_lft_sb = $inner_width_dbl_lft_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
		$ez_fat_footer_container_width_dbl_sb = $inner_width_dbl_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
		$ez_fat_footer_container_width_rt_sb = $inner_width_rt_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
		$ez_fat_footer_container_width_lft_sb = $inner_width_lft_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
		$ez_fat_footer_container_width_no_sb = $inner_width_no_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
	}
	else
	{
		$ez_fat_footer_container_width_dbl_rt_sb = $wrap_width_dbl_rt_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
		$ez_fat_footer_container_width_dbl_lft_sb = $wrap_width_dbl_lft_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
		$ez_fat_footer_container_width_dbl_sb = $wrap_width_dbl_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
		$ez_fat_footer_container_width_rt_sb = $wrap_width_rt_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
		$ez_fat_footer_container_width_lft_sb = $wrap_width_lft_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
		$ez_fat_footer_container_width_no_sb = $wrap_width_no_sb - $ez_fat_footer_lr_padding - $ez_widget_footer_lr_border_thickness;
	}
	
	// Custom Widget Area width/float
	if( !dynamik_get_design( 'dynamik_widget_width' ) )
	{
		$dynamik_widget_width = '';
	}
	else
	{
		$dynamik_widget_width = 'width: ' . dynamik_get_design( 'dynamik_widget_width' ) . ';';
	}
	
	$dynamik_widget_float = dynamik_get_design( 'dynamik_widget_float' );
	
	// Header/Logo widths/height/margins/padding
	$header_border_thickness = dynamik_get_design( 'header_border_thickness' );
	
	if( dynamik_get_design( 'header_border_type' ) == 'Full' || dynamik_get_design( 'header_border_type' ) == 'Left/Right' )
	{
		$header_width_dbl_rt_sb = $wrap_width_dbl_rt_sb - ( $header_border_thickness * 2 );
		$header_width_dbl_lft_sb = $wrap_width_dbl_lft_sb - ( $header_border_thickness * 2 );
		$header_width_dbl_sb = $wrap_width_dbl_sb - ( $header_border_thickness * 2 );
		$header_width_rt_sb = $wrap_width_rt_sb - ( $header_border_thickness * 2 );
		$header_width_lft_sb = $wrap_width_lft_sb - ( $header_border_thickness * 2 );
		$header_width_no_sb = $wrap_width_no_sb - ( $header_border_thickness * 2 );
	}
	else
	{
		$header_width_dbl_rt_sb = $wrap_width_dbl_rt_sb;
		$header_width_dbl_lft_sb = $wrap_width_dbl_lft_sb;
		$header_width_dbl_sb = $wrap_width_dbl_sb;
		$header_width_rt_sb = $wrap_width_rt_sb;
		$header_width_lft_sb = $wrap_width_lft_sb;
		$header_width_no_sb = $wrap_width_no_sb;
	}

	$label_pre_width_header_dbl_sb = $header_width_dbl_rt_sb - $label_cc_sb_sb_width;
	$label_pre_width_header_single_sb = $header_width_rt_sb - $label_cc_sb_width;
	$label_pre_width_header_no_sb = $header_width_no_sb - $label_cc_width;
	
	$header_height = dynamik_get_design( 'header_height' );
	$header_title_area_center = dynamik_get_design( 'header_title_area_center' );
	$header_title_area_width = dynamik_get_design( 'header_title_area_width' ) . 'px';
	$header_title_area_width_alt = !empty( $header_title_area_center ) ? '100%' : $header_title_area_width;
	$header_title_area_float = !empty( $header_title_area_center ) ? 'none' : 'left';
	$delayed_header_title_area_width = !empty( $header_title_area_center ) ? '100%' : dynamik_get_responsive( 'delayed_header_title_area_width' ) . 'px';
	$header_title_area_logo_height = dynamik_get_design( 'header_title_area_height' );
	$text_logo_top_padding = dynamik_get_design( 'text_logo_top_padding' );
	$text_logo_left_padding = !empty( $header_title_area_center ) ? '0' : dynamik_get_design( 'text_logo_left_padding' );
	$header_title_area_text_align = !empty( $header_title_area_center ) ? 'center' : 'left';
	$tagline_top_padding = dynamik_get_design( 'tagline_top_padding' );
	$image_logo_top_margin = dynamik_get_design( 'image_logo_top_margin' );
	$image_logo_bottom_margin = dynamik_get_design( 'image_logo_bottom_margin' );
	$image_logo_left_margin = dynamik_get_design( 'image_logo_left_margin' );
	$header_logo_margins = !empty( $header_title_area_center ) ? $image_logo_top_margin . 'px auto ' . $image_logo_bottom_margin . 'px' : $image_logo_top_margin . 'px 0 ' . $image_logo_bottom_margin . 'px ' . $image_logo_left_margin . 'px';
	$header_widget_width = dynamik_get_design( 'header_widget_width' );
	$header_widget_top_padding = dynamik_get_design( 'header_widget_top_padding' );
	$header_widget_right_padding = dynamik_get_design( 'header_widget_right_padding' );
	$header_widget_text_align = dynamik_get_design( 'header_widget_text_align' );
	
	// Nav, Subnav & Header Nav widths & alignment
	$nav1_border_thickness = dynamik_get_design( 'nav1_border_thickness' );

	if( dynamik_get_design( 'nav1_border_type' ) == 'Full' || dynamik_get_design( 'nav1_border_type' ) == 'Left/Right' )
	{
		$nav1_width_dbl_rt_sb = $wrap_width_dbl_rt_sb - ( $nav1_border_thickness * 2 );
		$nav1_width_dbl_lft_sb = $wrap_width_dbl_lft_sb - ( $nav1_border_thickness * 2 );
		$nav1_width_dbl_sb = $wrap_width_dbl_sb - ( $nav1_border_thickness * 2 );
		$nav1_width_rt_sb = $wrap_width_rt_sb - ( $nav1_border_thickness * 2 );
		$nav1_width_lft_sb = $wrap_width_lft_sb - ( $nav1_border_thickness * 2 );
		$nav1_width_no_sb = $wrap_width_no_sb - ( $nav1_border_thickness * 2 );
	}
	else
	{
		$nav1_width_dbl_rt_sb = $wrap_width_dbl_rt_sb;
		$nav1_width_dbl_lft_sb = $wrap_width_dbl_lft_sb;
		$nav1_width_dbl_sb = $wrap_width_dbl_sb;
		$nav1_width_rt_sb = $wrap_width_rt_sb;
		$nav1_width_lft_sb = $wrap_width_lft_sb;
		$nav1_width_no_sb = $wrap_width_no_sb;
	}

	$label_pre_width_nav1_dbl_sb = $nav1_width_dbl_rt_sb - $label_cc_sb_sb_width;
	$label_pre_width_nav1_single_sb = $nav1_width_rt_sb - $label_cc_sb_width;
	$label_pre_width_nav1_no_sb = $nav1_width_no_sb - $label_cc_width;

	if( dynamik_get_design( 'nav1_alignment' ) == 'Center' )
	{
		$nav1_center_alignment = '

/* Primary Navigation Center Alignment
------------------------------------------------------------ */

.genesis-nav-menu li.right {
	display: none;
}

ul.menu-primary {
	float: none;
	text-align: center;
}

.menu-primary li {
	display: inline-block;
	float: none;
}

.menu-primary li li {
	text-align: left;
}
';
	} else {
		$nav1_center_alignment = '';
	}
	
	$nav2_border_thickness = dynamik_get_design( 'nav2_border_thickness' );
	
	if( dynamik_get_design( 'nav2_border_type' ) == 'Full' || dynamik_get_design( 'nav2_border_type' ) == 'Left/Right' )
	{
		$nav2_width_dbl_rt_sb = $wrap_width_dbl_rt_sb - ( $nav2_border_thickness * 2 );
		$nav2_width_dbl_lft_sb = $wrap_width_dbl_lft_sb - ( $nav2_border_thickness * 2 );
		$nav2_width_dbl_sb = $wrap_width_dbl_sb - ( $nav2_border_thickness * 2 );
		$nav2_width_rt_sb = $wrap_width_rt_sb - ( $nav2_border_thickness * 2 );
		$nav2_width_lft_sb = $wrap_width_lft_sb - ( $nav2_border_thickness * 2 );
		$nav2_width_no_sb = $wrap_width_no_sb - ( $nav2_border_thickness * 2 );
	}
	else
	{
		$nav2_width_dbl_rt_sb = $wrap_width_dbl_rt_sb;
		$nav2_width_dbl_lft_sb = $wrap_width_dbl_lft_sb;
		$nav2_width_dbl_sb = $wrap_width_dbl_sb;
		$nav2_width_rt_sb = $wrap_width_rt_sb;
		$nav2_width_lft_sb = $wrap_width_lft_sb;
		$nav2_width_no_sb = $wrap_width_no_sb;
	}

	$label_pre_width_nav2_dbl_sb = $nav2_width_dbl_rt_sb - $label_cc_sb_sb_width;
	$label_pre_width_nav2_single_sb = $nav2_width_rt_sb - $label_cc_sb_width;
	$label_pre_width_nav2_no_sb = $nav2_width_no_sb - $label_cc_width;

	if( dynamik_get_design( 'nav2_alignment' ) == 'Center' )
	{
		$nav2_center_alignment = '

/* Secondary Navigation Center Alignment
------------------------------------------------------------ */

ul.menu-secondary {
	float: none;
	text-align: center;
}

.menu-secondary li {
	display: inline-block;
	float: none;
}

.menu-secondary li li {
	text-align: left;
}
';
	} else {
		$nav2_center_alignment = '';
	}
	
	$nav3_border_thickness = dynamik_get_design( 'nav3_border_thickness' );
	
	if( dynamik_get_design( 'nav3_border_type' ) == 'Full' || dynamik_get_design( 'nav3_border_type' ) == 'Left/Right' )
	{
		$nav3_width = $header_widget_width - ( $nav3_border_thickness * 2 );
	}
	else
	{
		$nav3_width = $header_widget_width;
	}

	// Vertical Menu Options
	$vertical_menu_sub_page_pre_text = dynamik_get_responsive( 'vertical_menu_sub_page_pre_text' );
	$vertical_menu_sub_page_text_align = dynamik_get_responsive( 'vertical_menu_sub_page_text_align' );
	
	// Breadcrumbs margins/padding
	$breadcrumbs_margin_top = dynamik_get_design( 'breadcrumbs_margin_top' );
	$breadcrumbs_margin_bottom = dynamik_get_design( 'breadcrumbs_margin_bottom' );
	$breadcrumbs_padding_top = dynamik_get_design( 'breadcrumbs_padding_top' );
	$breadcrumbs_padding_right = dynamik_get_design( 'breadcrumbs_padding_right' );
	$breadcrumbs_padding_bottom = dynamik_get_design( 'breadcrumbs_padding_bottom' );
	$breadcrumbs_padding_left = dynamik_get_design( 'breadcrumbs_padding_left' );
	
	// Taxonomy Box margins/padding
	$taxonomy_box_margin_top = dynamik_get_design( 'taxonomy_box_margin_top' );
	$taxonomy_box_margin_bottom = dynamik_get_design( 'taxonomy_box_margin_bottom' );
	$taxonomy_box_heading_padding_top = dynamik_get_design( 'taxonomy_box_heading_padding_top' );
	$taxonomy_box_heading_padding_right = dynamik_get_design( 'taxonomy_box_heading_padding_right' );
	$taxonomy_box_heading_padding_bottom = dynamik_get_design( 'taxonomy_box_heading_padding_bottom' );
	$taxonomy_box_heading_padding_left = dynamik_get_design( 'taxonomy_box_heading_padding_left' );
	$taxonomy_box_content_padding_top = dynamik_get_design( 'taxonomy_box_content_padding_top' );
	$taxonomy_box_content_padding_right = dynamik_get_design( 'taxonomy_box_content_padding_right' );
	$taxonomy_box_content_padding_bottom = dynamik_get_design( 'taxonomy_box_content_padding_bottom' );
	$taxonomy_box_content_padding_left = dynamik_get_design( 'taxonomy_box_content_padding_left' );
	
	// Post Content margins/padding
	$post_content_margin_top = dynamik_get_design( 'post_content_margin_top' );
	$post_content_margin_bottom = dynamik_get_design( 'post_content_margin_bottom' );
	$post_content_padding_top = dynamik_get_design( 'post_content_padding_top' );
	$post_content_padding_right = dynamik_get_design( 'post_content_padding_right' );
	$post_content_padding_bottom = dynamik_get_design( 'post_content_padding_bottom' );
	$post_content_padding_left = dynamik_get_design( 'post_content_padding_left' );
	
	// Page Content margins/padding
	$page_content_margin_top = dynamik_get_design( 'page_content_margin_top' );
	$page_content_margin_bottom = dynamik_get_design( 'page_content_margin_bottom' );
	$page_content_padding_top = dynamik_get_design( 'page_content_padding_top' );
	$page_content_padding_right = dynamik_get_design( 'page_content_padding_right' );
	$page_content_padding_bottom = dynamik_get_design( 'page_content_padding_bottom' );
	$page_content_padding_left = dynamik_get_design( 'page_content_padding_left' );
	
	// Sticky-Post margins/padding
	$sticky_post_margin_top = dynamik_get_design( 'sticky_post_margin_top' );
	$sticky_post_margin_bottom = dynamik_get_design( 'sticky_post_margin_bottom' );
	$sticky_post_padding_top = dynamik_get_design( 'sticky_post_padding_top' );
	$sticky_post_padding_right = dynamik_get_design( 'sticky_post_padding_right' );
	$sticky_post_padding_bottom = dynamik_get_design( 'sticky_post_padding_bottom' );
	$sticky_post_padding_left = dynamik_get_design( 'sticky_post_padding_left' );
	
	// Content Paragraph/List-Style padding
	$content_paragraph_margin_bottom = dynamik_get_design( 'content_paragraph_margin_bottom' );
	$content_list_style_padding_bottom = dynamik_get_design( 'content_list_style_padding_bottom' );
	
	// EZ Widget padding
	$ez_widget_home_padding_top = dynamik_get_design( 'ez_widget_home_padding_top' );
	$ez_widget_home_padding_right = dynamik_get_design( 'ez_widget_home_padding_right' );
	$ez_widget_home_padding_bottom = dynamik_get_design( 'ez_widget_home_padding_bottom' );
	$ez_widget_home_padding_left = dynamik_get_design( 'ez_widget_home_padding_left' );
	$ez_widget_feature_padding_top = dynamik_get_design( 'ez_widget_feature_padding_top' );
	$ez_widget_feature_padding_right = dynamik_get_design( 'ez_widget_feature_padding_right' );
	$ez_widget_feature_padding_bottom = dynamik_get_design( 'ez_widget_feature_padding_bottom' );
	$ez_widget_feature_padding_left = dynamik_get_design( 'ez_widget_feature_padding_left' );
	$ez_widget_footer_padding_top = dynamik_get_design( 'ez_widget_footer_padding_top' );
	$ez_widget_footer_padding_right = dynamik_get_design( 'ez_widget_footer_padding_right' );
	$ez_widget_footer_padding_bottom = dynamik_get_design( 'ez_widget_footer_padding_bottom' );
	$ez_widget_footer_padding_left = dynamik_get_design( 'ez_widget_footer_padding_left' );
	
	// EZ Home Slider height
	$ez_home_slider_height = dynamik_get_design( 'ez_home_slider_height' );
	
	// Featured Post/Page Widget margins/padding
	$featured_widget_margin_top = dynamik_get_design( 'featured_widget_margin_top' );
	$featured_widget_margin_right = dynamik_get_design( 'featured_widget_margin_right' );
	$featured_widget_margin_bottom = dynamik_get_design( 'featured_widget_margin_bottom' );
	$featured_widget_margin_left = dynamik_get_design( 'featured_widget_margin_left' );
	$featured_widget_padding_top = dynamik_get_design( 'featured_widget_padding_top' );
	$featured_widget_padding_right = dynamik_get_design( 'featured_widget_padding_right' );
	$featured_widget_padding_bottom = dynamik_get_design( 'featured_widget_padding_bottom' );
	$featured_widget_padding_left = dynamik_get_design( 'featured_widget_padding_left' );
	
	// Custom Widget Area margins/padding
	$dynamik_widget_margin_top = dynamik_get_design( 'dynamik_widget_margin_top' );
	$dynamik_widget_margin_right = dynamik_get_design( 'dynamik_widget_margin_right' );
	$dynamik_widget_margin_bottom = dynamik_get_design( 'dynamik_widget_margin_bottom' );
	$dynamik_widget_margin_left = dynamik_get_design( 'dynamik_widget_margin_left' );
	$dynamik_widget_padding_top = dynamik_get_design( 'dynamik_widget_padding_top' );
	$dynamik_widget_padding_right = dynamik_get_design( 'dynamik_widget_padding_right' );
	$dynamik_widget_padding_bottom = dynamik_get_design( 'dynamik_widget_padding_bottom' );
	$dynamik_widget_padding_left = dynamik_get_design( 'dynamik_widget_padding_left' );
	
	// Post-Nav margins/padding
	$post_nav_padding_top = dynamik_get_design( 'post_nav_padding_top' );
	$post_nav_padding_bottom = dynamik_get_design( 'post_nav_padding_bottom' );
	$post_nav_numbered_margin_left = dynamik_get_design( 'post_nav_numbered_margin_left' );
	$post_nav_numbered_margin_right = dynamik_get_design( 'post_nav_numbered_margin_right' );
	$post_nav_numbered_tb_padding = dynamik_get_design( 'post_nav_numbered_tb_padding' );
	$post_nav_numbered_lr_padding = dynamik_get_design( 'post_nav_numbered_lr_padding' );
	
	// Thumbnails image padding
	$thumbnail_image_padding = dynamik_get_design( 'thumbnail_image_padding' );
	
	// Comment Widths/Margin/Padding
	$comment_avatar_size = dynamik_get_design( 'comment_avatar_size' );
	$comment_avatar_padding = dynamik_get_design( 'comment_avatar_padding' );
	$comment_author_email_url_width = dynamik_get_design( 'comment_author_email_url_width' );
	
	if( dynamik_get_design( 'comment_form_width' ) == '' )
	{
		$comment_form_width = '98%';
	}
	else
	{
		$comment_form_width = dynamik_get_design( 'comment_form_width' );
	}
	
	if( dynamik_get_design( 'comment_submit_width' ) == '' )
	{
		$comment_submit_width = 'auto';
	}
	else
	{
		$comment_submit_width = dynamik_get_design( 'comment_submit_width' );
	}
	
	$comments_margin_top = dynamik_get_design( 'comments_margin_top' );
	$comments_margin_bottom = dynamik_get_design( 'comments_margin_bottom' );

	$comment_list_margin_top = dynamik_get_design( 'comment_list_margin_top' );
	$comment_list_margin_bottom = dynamik_get_design( 'comment_list_margin_bottom' );
	$comment_list_padding_top = dynamik_get_design( 'comment_list_padding_top' );
	$comment_list_padding_right = dynamik_get_design( 'comment_list_padding_right' );
	$comment_list_padding_bottom = dynamik_get_design( 'comment_list_padding_bottom' );
	$comment_list_padding_left = dynamik_get_design( 'comment_list_padding_left' );

	$comment_reply_text_padding_top = dynamik_get_design( 'comment_reply_text_padding_top' );
	$comment_reply_text_padding_right = dynamik_get_design( 'comment_reply_text_padding_right' );
	$comment_reply_text_padding_bottom = dynamik_get_design( 'comment_reply_text_padding_bottom' );
	$comment_reply_text_padding_left = dynamik_get_design( 'comment_reply_text_padding_left' );
	
	$submit_button_padding_top = dynamik_get_design( 'submit_button_padding_top' );
	$submit_button_padding_right = dynamik_get_design( 'submit_button_padding_right' );
	$submit_button_padding_bottom = dynamik_get_design( 'submit_button_padding_bottom' );
	$submit_button_padding_left = dynamik_get_design( 'submit_button_padding_left' );
	
	$comments_nav_padding_top = dynamik_get_design( 'comments_nav_padding_top' );
	$comments_nav_padding_bottom = dynamik_get_design( 'comments_nav_padding_bottom' );

	$comment_form_allowed_tags_margin_top = dynamik_get_design( 'comment_form_allowed_tags_margin_top' );
	$comment_form_allowed_tags_margin_bottom = dynamik_get_design( 'comment_form_allowed_tags_margin_bottom' );
	$comment_form_allowed_tags_padding_top = dynamik_get_design( 'comment_form_allowed_tags_padding_top' );
	$comment_form_allowed_tags_padding_right = dynamik_get_design( 'comment_form_allowed_tags_padding_right' );
	$comment_form_allowed_tags_padding_bottom = dynamik_get_design( 'comment_form_allowed_tags_padding_bottom' );
	$comment_form_allowed_tags_padding_left = dynamik_get_design( 'comment_form_allowed_tags_padding_left' );
	
	// Author Box margins/padding
	$author_box_margin_top = dynamik_get_design( 'author_box_margin_top' );
	$author_box_margin_bottom = dynamik_get_design( 'author_box_margin_bottom' );
	$author_box_padding_top = dynamik_get_design( 'author_box_padding_top' );
	$author_box_padding_right = dynamik_get_design( 'author_box_padding_right' );
	$author_box_padding_bottom = dynamik_get_design( 'author_box_padding_bottom' );
	$author_box_padding_left = dynamik_get_design( 'author_box_padding_left' );
	
	// Author Box Avatar Widths/Padding
	$author_box_avatar_size = dynamik_get_design( 'author_box_avatar_size' );
	$author_box_avatar_padding = dynamik_get_design( 'author_box_avatar_padding' );
	
	// Sidebar Widget/Heading/Content/List-Style margins/padding
	$sb_widget_margin_top = dynamik_get_design( 'sb_widget_margin_top' );
	$sb_widget_margin_bottom = dynamik_get_design( 'sb_widget_margin_bottom' );
	$sb_heading_padding_top = dynamik_get_design( 'sb_heading_padding_top' );
	$sb_heading_padding_right = dynamik_get_design( 'sb_heading_padding_right' );
	$sb_heading_padding_bottom = dynamik_get_design( 'sb_heading_padding_bottom' );
	$sb_heading_padding_left = dynamik_get_design( 'sb_heading_padding_left' );
	$sb_content_padding_top = dynamik_get_design( 'sb_content_padding_top' );
	$sb_content_padding_right = dynamik_get_design( 'sb_content_padding_right' );
	$sb_content_padding_bottom = dynamik_get_design( 'sb_content_padding_bottom' );
	$sb_content_padding_left = dynamik_get_design( 'sb_content_padding_left' );
	$sb_li_margin_top = dynamik_get_design( 'sb_li_margin_top' );
	$sb_li_margin_right = dynamik_get_design( 'sb_li_margin_right' );
	$sb_li_margin_bottom = dynamik_get_design( 'sb_li_margin_bottom' );
	$sb_li_margin_left = dynamik_get_design( 'sb_li_margin_left' );
	$sb_li_padding_top = dynamik_get_design( 'sb_li_padding_top' );
	$sb_li_padding_right = dynamik_get_design( 'sb_li_padding_right' );
	$sb_li_padding_bottom = dynamik_get_design( 'sb_li_padding_bottom' );
	$sb_li_padding_left = dynamik_get_design( 'sb_li_padding_left' );
	
	// Footer width/padding
	$footer_gototop_width = dynamik_get_design( 'footer_gototop_width' );
	$footer_creds_width = dynamik_get_design( 'footer_creds_width' );
	$footer_padding_top = dynamik_get_design( 'footer_padding_top' );
	$footer_padding_right = dynamik_get_design( 'footer_padding_right' );
	$footer_padding_bottom = dynamik_get_design( 'footer_padding_bottom' );
	$footer_padding_left = dynamik_get_design( 'footer_padding_left' );
	
	$footer_border_thickness = dynamik_get_design( 'footer_border_thickness' );

	if( dynamik_get_design( 'footer_border_type' ) == 'Full' || dynamik_get_design( 'footer_border_type' ) == 'Left/Right' )
	{
		$footer_width_dbl_rt_sb = $wrap_width_dbl_rt_sb - ( $footer_border_thickness * 2 ) - $footer_padding_right - $footer_padding_left;
		$footer_width_dbl_lft_sb = $wrap_width_dbl_lft_sb - ( $footer_border_thickness * 2 ) - $footer_padding_right - $footer_padding_left;
		$footer_width_dbl_sb = $wrap_width_dbl_sb - ( $footer_border_thickness * 2 ) - $footer_padding_right - $footer_padding_left;
		$footer_width_rt_sb = $wrap_width_rt_sb - ( $footer_border_thickness * 2 ) - $footer_padding_right - $footer_padding_left;
		$footer_width_lft_sb = $wrap_width_lft_sb - ( $footer_border_thickness * 2 ) - $footer_padding_right - $footer_padding_left;
		$footer_width_no_sb = $wrap_width_no_sb - ( $footer_border_thickness * 2 ) - $footer_padding_right - $footer_padding_left;
	}
	else
	{
		$footer_width_dbl_rt_sb = $wrap_width_dbl_rt_sb - $footer_padding_right - $footer_padding_left;
		$footer_width_dbl_lft_sb = $wrap_width_dbl_lft_sb - $footer_padding_right - $footer_padding_left;
		$footer_width_dbl_sb = $wrap_width_dbl_sb - $footer_padding_right - $footer_padding_left;
		$footer_width_rt_sb = $wrap_width_rt_sb - $footer_padding_right - $footer_padding_left;
		$footer_width_lft_sb = $wrap_width_lft_sb - $footer_padding_right - $footer_padding_left;
		$footer_width_no_sb = $wrap_width_no_sb - $footer_padding_right - $footer_padding_left;
	}

	$label_pre_width_footer_dbl_sb = $footer_width_dbl_rt_sb - $label_cc_sb_sb_width;
	$label_pre_width_footer_single_sb = $footer_width_rt_sb - $label_cc_sb_width;
	$label_pre_width_footer_no_sb = $footer_width_no_sb - $label_cc_width;
	
	// Search Form width/padding
	$search_form_width = dynamik_get_design( 'search_form_width' );
	
	$search_form_padding_top = dynamik_get_design( 'search_form_padding_top' );
	$search_form_padding_right = dynamik_get_design( 'search_form_padding_right' );
	$search_form_padding_bottom = dynamik_get_design( 'search_form_padding_bottom' );
	$search_form_padding_left = dynamik_get_design( 'search_form_padding_left' );
	$search_button_padding_top = dynamik_get_design( 'search_button_padding_top' );
	$search_button_padding_right = dynamik_get_design( 'search_button_padding_right' );
	$search_button_padding_bottom = dynamik_get_design( 'search_button_padding_bottom' );
	$search_button_padding_left = dynamik_get_design( 'search_button_padding_left' );
	
	/****************************************
			Define Background Styles
	****************************************/
	
	// Body Background
	$body_bg_type = dynamik_get_design( 'body_bg_type' );
	$body_bg_color = dynamik_get_design( 'body_bg_color' );
	$body_bg_image = dynamik_get_design( 'body_bg_image' );
	
	if( $body_bg_type == 'color' )
	{
		$body_bg = 'background: #' . $body_bg_color . ';';
	}
	else
	{
		$body_bg = 'background: #' . $body_bg_color . ' url(images/' . $body_bg_image . ') ' . $body_bg_type . ';';
	}

	// Wrap background
	$wrap_bg_type = dynamik_get_design( 'wrap_bg_type' );
	$wrap_bg_no_color = dynamik_get_design( 'wrap_bg_no_color' ) ? dynamik_get_design( 'wrap_bg_no_color' ) : '';
	$wrap_bg_color = dynamik_get_design( 'wrap_bg_color' );
	$wrap_bg_image = dynamik_get_design( 'wrap_bg_image' );
	
	if( $wrap_bg_type == 'color' )
	{
		$wrap_bg = 'background: #' . $wrap_bg_color . ';';
	}
	elseif( $wrap_bg_type == 'transparent' )
	{
		$wrap_bg = 'background: transparent;';
	}
	elseif( !empty( $wrap_bg_no_color ) )
	{
		$wrap_bg = 'background: url(images/' . $wrap_bg_image . ') ' . $wrap_bg_type . ';';
	}
	else
	{
		$wrap_bg = 'background: #' . $wrap_bg_color . ' url(images/' . $wrap_bg_image . ') ' . $wrap_bg_type . ';';
	}
	
	// Container Wrap background
	$inner_bg_type = dynamik_get_design( 'inner_bg_type' );
	$inner_bg_no_color = dynamik_get_design( 'inner_bg_no_color' ) ? dynamik_get_design( 'inner_bg_no_color' ) : '';
	$inner_bg_color = dynamik_get_design( 'inner_bg_color' );
	$inner_bg_image = dynamik_get_design( 'inner_bg_image' );
	
	if( $inner_bg_type == 'color' )
	{
		$inner_bg = 'background: #' . $inner_bg_color . ';';
	}
	elseif( $inner_bg_type == 'transparent' )
	{
		$inner_bg = 'background: transparent;';
	}
	elseif( !empty( $inner_bg_no_color ) )
	{
		$inner_bg = 'background: url(images/' . $inner_bg_image . ') ' . $inner_bg_type . ';';
	}
	else
	{
		$inner_bg = 'background: #' . $inner_bg_color . ' url(images/' . $inner_bg_image . ') ' . $inner_bg_type . ';';
	}
	
	// Header/Logo background
	$header_bg_type = dynamik_get_design( 'header_bg_type' );
	$header_bg_no_color = dynamik_get_design( 'header_bg_no_color' ) ? dynamik_get_design( 'header_bg_no_color' ) : '';
	$header_bg_color = dynamik_get_design( 'header_bg_color' );
	$header_bg_image = dynamik_get_design( 'header_bg_image' );
	$retina_logo_active = dynamik_get_design( 'retina_logo_active' );
	
	if( $header_bg_type == 'color' )
	{
		$header_bg = 'background: #' . $header_bg_color . ';';
	}
	elseif( $header_bg_type == 'transparent' )
	{
		$header_bg = 'background: transparent;';
	}
	elseif( !empty( $header_bg_no_color ) )
	{
		$header_bg = 'background: url(images/' . $header_bg_image . ') ' . $header_bg_type . ';';
	}
	else
	{
		$header_bg = 'background: #' . $header_bg_color . ' url(images/' . $header_bg_image . ') ' . $header_bg_type . ';';
	}
	
	if( dynamik_get_design( 'logo_image' ) != '' )
	{
		$logo_image = 'background: url(images/' . dynamik_get_design( 'logo_image' ) . ') left top no-repeat;';

		if( !empty( $retina_logo_active ) )
		{
			$retina_logo_media_query = '

/* Retina Logo
------------------------------------------------------------ */

@media only screen and (-webkit-min-device-pixel-ratio: 2),
	only screen and (min--moz-device-pixel-ratio: 2),
	only screen and (-o-min-device-pixel-ratio: 2/1),
	only screen and (min-device-pixel-ratio: 2) {

	.header-image .site-header .wrap .title-area {
		background: url(images/' . dynamik_get_design( 'retina_logo_image' ) . ') left top no-repeat;
		background-size: ' . $header_title_area_width . ' ' . $header_title_area_logo_height . 'px;
	}

}' . "\n";
		}
		else
		{
			$retina_logo_media_query = '';
		}
	}
	else
	{
		$logo_image = 'background: none;';
		$retina_logo_media_query = '';
	}
	
	// Nav backgrounds
	$nav1_bg_type = dynamik_get_design( 'nav1_bg_type' );
	$nav1_bg_no_color = dynamik_get_design( 'nav1_bg_no_color' ) ? dynamik_get_design( 'nav1_bg_no_color' ) : '';
	$nav1_bg_color = dynamik_get_design( 'nav1_bg_color' );
	$nav1_bg_image = dynamik_get_design( 'nav1_bg_image' );
	
	if( $nav1_bg_type == 'color' )
	{
		$nav1_bg = 'background: #' . $nav1_bg_color . ';';
	}
	elseif( $nav1_bg_type == 'transparent' )
	{
		$nav1_bg = 'background: transparent;';
	}
	elseif( !empty( $nav1_bg_no_color ) )
	{
		$nav1_bg = 'background: url(images/' . $nav1_bg_image . ') ' . $nav1_bg_type . ';';
	}
	else
	{
		$nav1_bg = 'background: #' . $nav1_bg_color . ' url(images/' . $nav1_bg_image . ') ' . $nav1_bg_type . ';';
	}
	
	$nav1_page_bg_type = dynamik_get_design( 'nav1_page_bg_type' );
	$nav1_page_bg_no_color = dynamik_get_design( 'nav1_page_bg_no_color' ) ? dynamik_get_design( 'nav1_page_bg_no_color' ) : '';
	$nav1_page_bg_color = dynamik_get_design( 'nav1_page_bg_color' );
	$nav1_page_bg_image = dynamik_get_design( 'nav1_page_bg_image' );
	
	if( $nav1_page_bg_type == 'color' )
	{
		$nav1_page_bg = 'background: #' . $nav1_page_bg_color . ';';
	}
	elseif( $nav1_page_bg_type == 'transparent' )
	{
		$nav1_page_bg = 'background: transparent;';
	}
	elseif( !empty( $nav1_page_bg_no_color ) )
	{
		$nav1_page_bg = 'background: url(images/' . $nav1_page_bg_image . ') ' . $nav1_page_bg_type . ';';
	}
	else
	{
		$nav1_page_bg = 'background: #' . $nav1_page_bg_color . ' url(images/' . $nav1_page_bg_image . ') ' . $nav1_page_bg_type . ';';
	}
	
	$nav1_page_hover_bg_type = dynamik_get_design( 'nav1_page_hover_bg_type' );
	$nav1_page_hover_bg_no_color = dynamik_get_design( 'nav1_page_hover_bg_no_color' ) ? dynamik_get_design( 'nav1_page_hover_bg_no_color' ) : '';
	$nav1_page_hover_bg_color = dynamik_get_design( 'nav1_page_hover_bg_color' );
	$nav1_page_hover_bg_image = dynamik_get_design( 'nav1_page_hover_bg_image' );
	
	if( $nav1_page_hover_bg_type == 'color' )
	{
		$nav1_page_hover_bg = 'background: #' . $nav1_page_hover_bg_color . ';';
	}
	elseif( $nav1_page_hover_bg_type == 'transparent' )
	{
		$nav1_page_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $nav1_page_hover_bg_no_color ) )
	{
		$nav1_page_hover_bg = 'background: url(images/' . $nav1_page_hover_bg_image . ') ' . $nav1_page_hover_bg_type . ';';
	}
	else
	{
		$nav1_page_hover_bg = 'background: #' . $nav1_page_hover_bg_color . ' url(images/' . $nav1_page_hover_bg_image . ') ' . $nav1_page_hover_bg_type . ';';
	}
	
	$nav1_page_active_bg_type = dynamik_get_design( 'nav1_page_active_bg_type' );
	$nav1_page_active_bg_no_color = dynamik_get_design( 'nav1_page_active_bg_no_color' ) ? dynamik_get_design( 'nav1_page_active_bg_no_color' ) : '';
	$nav1_page_active_bg_color = dynamik_get_design( 'nav1_page_active_bg_color' );
	$nav1_page_active_bg_image = dynamik_get_design( 'nav1_page_active_bg_image' );
	
	if( $nav1_page_active_bg_type == 'color' )
	{
		$nav1_page_active_bg = 'background: #' . $nav1_page_active_bg_color . ';';
	}
	elseif( $nav1_page_active_bg_type == 'transparent' )
	{
		$nav1_page_active_bg = 'background: transparent;';
	}
	elseif( !empty( $nav1_page_active_bg_no_color ) )
	{
		$nav1_page_active_bg = 'background: url(images/' . $nav1_page_active_bg_image . ') ' . $nav1_page_active_bg_type . ';';
	}
	else
	{
		$nav1_page_active_bg = 'background: #' . $nav1_page_active_bg_color . ' url(images/' . $nav1_page_active_bg_image . ') ' . $nav1_page_active_bg_type . ';';
	}
	
	$nav1_sub_page_bg_type = dynamik_get_design( 'nav1_sub_page_bg_type' );
	$nav1_sub_page_bg_no_color = dynamik_get_design( 'nav1_sub_page_bg_no_color' ) ? dynamik_get_design( 'nav1_sub_page_bg_no_color' ) : '';
	$nav1_sub_page_bg_color = dynamik_get_design( 'nav1_sub_page_bg_color' );
	$nav1_sub_page_bg_image = dynamik_get_design( 'nav1_sub_page_bg_image' );
	
	if( $nav1_sub_page_bg_type == 'color' )
	{
		$nav1_sub_page_bg = 'background: #' . $nav1_sub_page_bg_color . ';';
	}
	elseif( $nav1_sub_page_bg_type == 'transparent' )
	{
		$nav1_sub_page_bg = 'background: transparent;';
	}
	elseif( !empty( $nav1_sub_page_bg_no_color ) )
	{
		$nav1_sub_page_bg = 'background: url(images/' . $nav1_sub_page_bg_image . ') ' . $nav1_sub_page_bg_type . ';';
	}
	else
	{
		$nav1_sub_page_bg = 'background: #' . $nav1_sub_page_bg_color . ' url(images/' . $nav1_sub_page_bg_image . ') ' . $nav1_sub_page_bg_type . ';';
	}
	
	$nav1_sub_page_hover_bg_type = dynamik_get_design( 'nav1_sub_page_hover_bg_type' );
	$nav1_sub_page_hover_bg_no_color = dynamik_get_design( 'nav1_sub_page_hover_bg_no_color' ) ? dynamik_get_design( 'nav1_sub_page_hover_bg_no_color' ) : '';
	$nav1_sub_page_hover_bg_color = dynamik_get_design( 'nav1_sub_page_hover_bg_color' );
	$nav1_sub_page_hover_bg_image = dynamik_get_design( 'nav1_sub_page_hover_bg_image' );
	
	if( $nav1_sub_page_hover_bg_type == 'color' )
	{
		$nav1_sub_page_hover_bg = 'background: #' . $nav1_sub_page_hover_bg_color . ';';
	}
	elseif( $nav1_sub_page_hover_bg_type == 'transparent' )
	{
		$nav1_sub_page_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $nav1_sub_page_hover_bg_no_color ) )
	{
		$nav1_sub_page_hover_bg = 'background: url(images/' . $nav1_sub_page_hover_bg_image . ') ' . $nav1_sub_page_hover_bg_type . ';';
	}
	else
	{
		$nav1_sub_page_hover_bg = 'background: #' . $nav1_sub_page_hover_bg_color . ' url(images/' . $nav1_sub_page_hover_bg_image . ') ' . $nav1_sub_page_hover_bg_type . ';';
	}
	
	// Subnav backgrounds
	$nav2_bg_type = dynamik_get_design( 'nav2_bg_type' );
	$nav2_bg_no_color = dynamik_get_design( 'nav2_bg_no_color' ) ? dynamik_get_design( 'nav2_bg_no_color' ) : '';
	$nav2_bg_color = dynamik_get_design( 'nav2_bg_color' );
	$nav2_bg_image = dynamik_get_design( 'nav2_bg_image' );
	
	if( $nav2_bg_type == 'color' )
	{
		$nav2_bg = 'background: #' . $nav2_bg_color . ';';
	}
	elseif( $nav2_bg_type == 'transparent' )
	{
		$nav2_bg = 'background: transparent;';
	}
	elseif( !empty( $nav2_bg_no_color ) )
	{
		$nav2_bg = 'background: url(images/' . $nav2_bg_image . ') ' . $nav2_bg_type . ';';
	}
	else
	{
		$nav2_bg = 'background: #' . $nav2_bg_color . ' url(images/' . $nav2_bg_image . ') ' . $nav2_bg_type . ';';
	}
	
	$nav2_page_bg_type = dynamik_get_design( 'nav2_page_bg_type' );
	$nav2_page_bg_no_color = dynamik_get_design( 'nav2_page_bg_no_color' ) ? dynamik_get_design( 'nav2_page_bg_no_color' ) : '';
	$nav2_page_bg_color = dynamik_get_design( 'nav2_page_bg_color' );
	$nav2_page_bg_image = dynamik_get_design( 'nav2_page_bg_image' );
	
	if( $nav2_page_bg_type == 'color' )
	{
		$nav2_page_bg = 'background: #' . $nav2_page_bg_color . ';';
	}
	elseif( $nav2_page_bg_type == 'transparent' )
	{
		$nav2_page_bg = 'background: transparent;';
	}
	elseif( !empty( $nav2_page_bg_no_color ) )
	{
		$nav2_page_bg = 'background: url(images/' . $nav2_page_bg_image . ') ' . $nav2_page_bg_type . ';';
	}
	else
	{
		$nav2_page_bg = 'background: #' . $nav2_page_bg_color . ' url(images/' . $nav2_page_bg_image . ') ' . $nav2_page_bg_type . ';';
	}
	
	$nav2_page_hover_bg_type = dynamik_get_design( 'nav2_page_hover_bg_type' );
	$nav2_page_hover_bg_no_color = dynamik_get_design( 'nav2_page_hover_bg_no_color' ) ? dynamik_get_design( 'nav2_page_hover_bg_no_color' ) : '';
	$nav2_page_hover_bg_color = dynamik_get_design( 'nav2_page_hover_bg_color' );
	$nav2_page_hover_bg_image = dynamik_get_design( 'nav2_page_hover_bg_image' );
	
	if( $nav2_page_hover_bg_type == 'color' )
	{
		$nav2_page_hover_bg = 'background: #' . $nav2_page_hover_bg_color . ';';
	}
	elseif( $nav2_page_hover_bg_type == 'transparent' )
	{
		$nav2_page_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $nav2_page_hover_bg_no_color ) )
	{
		$nav2_page_hover_bg = 'background: url(images/' . $nav2_page_hover_bg_image . ') ' . $nav2_page_hover_bg_type . ';';
	}
	else
	{
		$nav2_page_hover_bg = 'background: #' . $nav2_page_hover_bg_color . ' url(images/' . $nav2_page_hover_bg_image . ') ' . $nav2_page_hover_bg_type . ';';
	}
	
	$nav2_page_active_bg_type = dynamik_get_design( 'nav2_page_active_bg_type' );
	$nav2_page_active_bg_no_color = dynamik_get_design( 'nav2_page_active_bg_no_color' ) ? dynamik_get_design( 'nav2_page_active_bg_no_color' ) : '';
	$nav2_page_active_bg_color = dynamik_get_design( 'nav2_page_active_bg_color' );
	$nav2_page_active_bg_image = dynamik_get_design( 'nav2_page_active_bg_image' );
	
	if( $nav2_page_active_bg_type == 'color' )
	{
		$nav2_page_active_bg = 'background: #' . $nav2_page_active_bg_color . ';';
	}
	elseif( $nav2_page_active_bg_type == 'transparent' )
	{
		$nav2_page_active_bg = 'background: transparent;';
	}
	elseif( !empty( $nav2_page_active_bg_no_color ) )
	{
		$nav2_page_active_bg = 'background: url(images/' . $nav2_page_active_bg_image . ') ' . $nav2_page_active_bg_type . ';';
	}
	else
	{
		$nav2_page_active_bg = 'background: #' . $nav2_page_active_bg_color . ' url(images/' . $nav2_page_active_bg_image . ') ' . $nav2_page_active_bg_type . ';';
	}
	
	$nav2_sub_page_bg_type = dynamik_get_design( 'nav2_sub_page_bg_type' );
	$nav2_sub_page_bg_no_color = dynamik_get_design( 'nav2_sub_page_bg_no_color' ) ? dynamik_get_design( 'nav2_sub_page_bg_no_color' ) : '';
	$nav2_sub_page_bg_color = dynamik_get_design( 'nav2_sub_page_bg_color' );
	$nav2_sub_page_bg_image = dynamik_get_design( 'nav2_sub_page_bg_image' );
	
	if( $nav2_sub_page_bg_type == 'color' )
	{
		$nav2_sub_page_bg = 'background: #' . $nav2_sub_page_bg_color . ';';
	}
	elseif( $nav2_sub_page_bg_type == 'transparent' )
	{
		$nav2_sub_page_bg = 'background: transparent;';
	}
	elseif( !empty( $nav2_sub_page_bg_no_color ) )
	{
		$nav2_sub_page_bg = 'background: url(images/' . $nav2_sub_page_bg_image . ') ' . $nav2_sub_page_bg_type . ';';
	}
	else
	{
		$nav2_sub_page_bg = 'background: #' . $nav2_sub_page_bg_color . ' url(images/' . $nav2_sub_page_bg_image . ') ' . $nav2_sub_page_bg_type . ';';
	}
	
	$nav2_sub_page_hover_bg_type = dynamik_get_design( 'nav2_sub_page_hover_bg_type' );
	$nav2_sub_page_hover_bg_no_color = dynamik_get_design( 'nav2_sub_page_hover_bg_no_color' ) ? dynamik_get_design( 'nav2_sub_page_hover_bg_no_color' ) : '';
	$nav2_sub_page_hover_bg_color = dynamik_get_design( 'nav2_sub_page_hover_bg_color' );
	$nav2_sub_page_hover_bg_image = dynamik_get_design( 'nav2_sub_page_hover_bg_image' );
	
	if( $nav2_sub_page_hover_bg_type == 'color' )
	{
		$nav2_sub_page_hover_bg = 'background: #' . $nav2_sub_page_hover_bg_color . ';';
	}
	elseif( $nav2_sub_page_hover_bg_type == 'transparent' )
	{
		$nav2_sub_page_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $nav2_sub_page_hover_bg_no_color ) )
	{
		$nav2_sub_page_hover_bg = 'background: url(images/' . $nav2_sub_page_hover_bg_image . ') ' . $nav2_sub_page_hover_bg_type . ';';
	}
	else
	{
		$nav2_sub_page_hover_bg = 'background: #' . $nav2_sub_page_hover_bg_color . ' url(images/' . $nav2_sub_page_hover_bg_image . ') ' . $nav2_sub_page_hover_bg_type . ';';
	}

	// Vertical Toggle Menu styles
	$vertical_toggle_button_styles = dynamik_get_responsive( 'vertical_toggle_button_styles' );
	$vertical_toggle_button_subnav_styles = dynamik_get_responsive( 'vertical_toggle_button_subnav_styles' );

	// Hamburger Menu Icon Top Margins
	$hamburger_icon_1_margin_top = dynamik_get_responsive( 'hamburger_icon_1_margin_top' );
	$hamburger_icon_2_margin_top = dynamik_get_responsive( 'hamburger_icon_2_margin_top' );
	
	// Header Nav backgrounds
	$nav3_bg_type = dynamik_get_design( 'nav3_bg_type' );
	$nav3_bg_no_color = dynamik_get_design( 'nav3_bg_no_color' ) ? dynamik_get_design( 'nav3_bg_no_color' ) : '';
	$nav3_bg_color = dynamik_get_design( 'nav3_bg_color' );
	$nav3_bg_image = dynamik_get_design( 'nav3_bg_image' );
	
	if( $nav3_bg_type == 'color' )
	{
		$nav3_bg = 'background: #' . $nav3_bg_color . ';';
	}
	elseif( $nav3_bg_type == 'transparent' )
	{
		$nav3_bg = 'background: transparent;';
	}
	elseif( !empty( $nav3_bg_no_color ) )
	{
		$nav3_bg = 'background: url(images/' . $nav3_bg_image . ') ' . $nav3_bg_type . ';';
	}
	else
	{
		$nav3_bg = 'background: #' . $nav3_bg_color . ' url(images/' . $nav3_bg_image . ') ' . $nav3_bg_type . ';';
	}
	
	$nav3_page_bg_type = dynamik_get_design( 'nav3_page_bg_type' );
	$nav3_page_bg_no_color = dynamik_get_design( 'nav3_page_bg_no_color' ) ? dynamik_get_design( 'nav3_page_bg_no_color' ) : '';
	$nav3_page_bg_color = dynamik_get_design( 'nav3_page_bg_color' );
	$nav3_page_bg_image = dynamik_get_design( 'nav3_page_bg_image' );
	
	if( $nav3_page_bg_type == 'color' )
	{
		$nav3_page_bg = 'background: #' . $nav3_page_bg_color . ';';
	}
	elseif( $nav3_page_bg_type == 'transparent' )
	{
		$nav3_page_bg = 'background: transparent;';
	}
	elseif( !empty( $nav3_page_bg_no_color ) )
	{
		$nav3_page_bg = 'background: url(images/' . $nav3_page_bg_image . ') ' . $nav3_page_bg_type . ';';
	}
	else
	{
		$nav3_page_bg = 'background: #' . $nav3_page_bg_color . ' url(images/' . $nav3_page_bg_image . ') ' . $nav3_page_bg_type . ';';
	}
	
	$nav3_page_hover_bg_type = dynamik_get_design( 'nav3_page_hover_bg_type' );
	$nav3_page_hover_bg_no_color = dynamik_get_design( 'nav3_page_hover_bg_no_color' ) ? dynamik_get_design( 'nav3_page_hover_bg_no_color' ) : '';
	$nav3_page_hover_bg_color = dynamik_get_design( 'nav3_page_hover_bg_color' );
	$nav3_page_hover_bg_image = dynamik_get_design( 'nav3_page_hover_bg_image' );
	
	if( $nav3_page_hover_bg_type == 'color' )
	{
		$nav3_page_hover_bg = 'background: #' . $nav3_page_hover_bg_color . ';';
	}
	elseif( $nav3_page_hover_bg_type == 'transparent' )
	{
		$nav3_page_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $nav3_page_hover_bg_no_color ) )
	{
		$nav3_page_hover_bg = 'background: url(images/' . $nav3_page_hover_bg_image . ') ' . $nav3_page_hover_bg_type . ';';
	}
	else
	{
		$nav3_page_hover_bg = 'background: #' . $nav3_page_hover_bg_color . ' url(images/' . $nav3_page_hover_bg_image . ') ' . $nav3_page_hover_bg_type . ';';
	}
	
	$nav3_page_active_bg_type = dynamik_get_design( 'nav3_page_active_bg_type' );
	$nav3_page_active_bg_no_color = dynamik_get_design( 'nav3_page_active_bg_no_color' ) ? dynamik_get_design( 'nav3_page_active_bg_no_color' ) : '';
	$nav3_page_active_bg_color = dynamik_get_design( 'nav3_page_active_bg_color' );
	$nav3_page_active_bg_image = dynamik_get_design( 'nav3_page_active_bg_image' );
	
	if( $nav3_page_active_bg_type == 'color' )
	{
		$nav3_page_active_bg = 'background: #' . $nav3_page_active_bg_color . ';';
	}
	elseif( $nav3_page_active_bg_type == 'transparent' )
	{
		$nav3_page_active_bg = 'background: transparent;';
	}
	elseif( !empty( $nav3_page_active_bg_no_color ) )
	{
		$nav3_page_active_bg = 'background: url(images/' . $nav3_page_active_bg_image . ') ' . $nav3_page_active_bg_type . ';';
	}
	else
	{
		$nav3_page_active_bg = 'background: #' . $nav3_page_active_bg_color . ' url(images/' . $nav3_page_active_bg_image . ') ' . $nav3_page_active_bg_type . ';';
	}
	
	$nav3_sub_page_bg_type = dynamik_get_design( 'nav3_sub_page_bg_type' );
	$nav3_sub_page_bg_no_color = dynamik_get_design( 'nav3_sub_page_bg_no_color' ) ? dynamik_get_design( 'nav3_sub_page_bg_no_color' ) : '';
	$nav3_sub_page_bg_color = dynamik_get_design( 'nav3_sub_page_bg_color' );
	$nav3_sub_page_bg_image = dynamik_get_design( 'nav3_sub_page_bg_image' );
	
	if( $nav3_sub_page_bg_type == 'color' )
	{
		$nav3_sub_page_bg = 'background: #' . $nav3_sub_page_bg_color . ';';
	}
	elseif( $nav3_sub_page_bg_type == 'transparent' )
	{
		$nav3_sub_page_bg = 'background: transparent;';
	}
	elseif( !empty( $nav3_sub_page_bg_no_color ) )
	{
		$nav3_sub_page_bg = 'background: url(images/' . $nav3_sub_page_bg_image . ') ' . $nav3_sub_page_bg_type . ';';
	}
	else
	{
		$nav3_sub_page_bg = 'background: #' . $nav3_sub_page_bg_color . ' url(images/' . $nav3_sub_page_bg_image . ') ' . $nav3_sub_page_bg_type . ';';
	}
	
	$nav3_sub_page_hover_bg_type = dynamik_get_design( 'nav3_sub_page_hover_bg_type' );
	$nav3_sub_page_hover_bg_no_color = dynamik_get_design( 'nav3_sub_page_hover_bg_no_color' ) ? dynamik_get_design( 'nav3_sub_page_hover_bg_no_color' ) : '';
	$nav3_sub_page_hover_bg_color = dynamik_get_design( 'nav3_sub_page_hover_bg_color' );
	$nav3_sub_page_hover_bg_image = dynamik_get_design( 'nav3_sub_page_hover_bg_image' );
	
	if( $nav3_sub_page_hover_bg_type == 'color' )
	{
		$nav3_sub_page_hover_bg = 'background: #' . $nav3_sub_page_hover_bg_color . ';';
	}
	elseif( $nav3_sub_page_hover_bg_type == 'transparent' )
	{
		$nav3_sub_page_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $nav3_sub_page_hover_bg_no_color ) )
	{
		$nav3_sub_page_hover_bg = 'background: url(images/' . $nav3_sub_page_hover_bg_image . ') ' . $nav3_sub_page_hover_bg_type . ';';
	}
	else
	{
		$nav3_sub_page_hover_bg = 'background: #' . $nav3_sub_page_hover_bg_color . ' url(images/' . $nav3_sub_page_hover_bg_image . ') ' . $nav3_sub_page_hover_bg_type . ';';
	}
	
	// Post content background
	$post_content_bg_type = dynamik_get_design( 'post_content_bg_type' );
	$post_content_bg_no_color = dynamik_get_design( 'post_content_bg_no_color' ) ? dynamik_get_design( 'post_content_bg_no_color' ) : '';
	$post_content_bg_color = dynamik_get_design( 'post_content_bg_color' );
	$post_content_bg_image = dynamik_get_design( 'post_content_bg_image' );
	
	if( $post_content_bg_type == 'color' )
	{
		$post_content_bg = 'background: #' . $post_content_bg_color . ';';
	}
	elseif( $post_content_bg_type == 'transparent' )
	{
		$post_content_bg = 'background: transparent;';
	}
	elseif( !empty( $post_content_bg_no_color ) )
	{
		$post_content_bg = 'background: url(images/' . $post_content_bg_image . ') ' . $post_content_bg_type . ';';
	}
	else
	{
		$post_content_bg = 'background: #' . $post_content_bg_color . ' url(images/' . $post_content_bg_image . ') ' . $post_content_bg_type . ';';
	}
	
	// Page content background
	$page_content_bg_type = dynamik_get_design( 'page_content_bg_type' );
	$page_content_bg_no_color = dynamik_get_design( 'page_content_bg_no_color' ) ? dynamik_get_design( 'page_content_bg_no_color' ) : '';
	$page_content_bg_color = dynamik_get_design( 'page_content_bg_color' );
	$page_content_bg_image = dynamik_get_design( 'page_content_bg_image' );
	
	if( $page_content_bg_type == 'color' )
	{
		$page_content_bg = 'background: #' . $page_content_bg_color . ';';
	}
	elseif( $page_content_bg_type == 'transparent' )
	{
		$page_content_bg = 'background: transparent;';
	}
	elseif( !empty( $page_content_bg_no_color ) )
	{
		$page_content_bg = 'background: url(images/' . $page_content_bg_image . ') ' . $page_content_bg_type . ';';
	}
	else
	{
		$page_content_bg = 'background: #' . $page_content_bg_color . ' url(images/' . $page_content_bg_image . ') ' . $page_content_bg_type . ';';
	}
	
	// Sticky-Post background
	$sticky_post_bg_type = dynamik_get_design( 'sticky_post_bg_type' );
	$sticky_post_bg_no_color = dynamik_get_design( 'sticky_post_bg_no_color' ) ? dynamik_get_design( 'sticky_post_bg_no_color' ) : '';
	$sticky_post_bg_color = dynamik_get_design( 'sticky_post_bg_color' );
	$sticky_post_bg_image = dynamik_get_design( 'sticky_post_bg_image' );
	
	if( $sticky_post_bg_type == 'color' )
	{
		$sticky_post_bg = 'background: #' . $sticky_post_bg_color . ' !important;';
	}
	elseif( $sticky_post_bg_type == 'transparent' )
	{
		$sticky_post_bg = 'background: transparent !important;';
	}
	elseif( !empty( $sticky_post_bg_no_color ) )
	{
		$sticky_post_bg = 'background: url(images/' . $sticky_post_bg_image . ') ' . $sticky_post_bg_type . ' !important;';
	}
	else
	{
		$sticky_post_bg = 'background: #' . $sticky_post_bg_color . ' url(images/' . $sticky_post_bg_image . ') ' . $sticky_post_bg_type . ' !important;';
	}
	
	// Blockquote background
	$blockquote_bg_type = dynamik_get_design( 'blockquote_bg_type' );
	$blockquote_bg_no_color = dynamik_get_design( 'blockquote_bg_no_color' ) ? dynamik_get_design( 'blockquote_bg_no_color' ) : '';
	$blockquote_bg_color = dynamik_get_design( 'blockquote_bg_color' );
	$blockquote_bg_image = dynamik_get_design( 'blockquote_bg_image' );
	
	if( $blockquote_bg_type == 'color' )
	{
		$blockquote_bg = 'background: #' . $blockquote_bg_color . ';';
	}
	elseif( $blockquote_bg_type == 'transparent' )
	{
		$blockquote_bg = 'background: transparent;';
	}
	elseif( !empty( $blockquote_bg_no_color ) )
	{
		$blockquote_bg = 'background: url(images/' . $blockquote_bg_image . ') ' . $blockquote_bg_type . ';';
	}
	else
	{
		$blockquote_bg = 'background: #' . $blockquote_bg_color . ' url(images/' . $blockquote_bg_image . ') ' . $blockquote_bg_type . ';';
	}
	
	// Image Caption background
	$caption_bg_type = dynamik_get_design( 'caption_bg_type' );
	$caption_bg_no_color = dynamik_get_design( 'caption_bg_no_color' ) ? dynamik_get_design( 'caption_bg_no_color' ) : '';
	$caption_bg_color = dynamik_get_design( 'caption_bg_color' );
	$caption_bg_image = dynamik_get_design( 'caption_bg_image' );
	
	if( $caption_bg_type == 'color' )
	{
		$caption_bg = 'background: #' . $caption_bg_color . ';';
	}
	elseif( $caption_bg_type == 'transparent' )
	{
		$caption_bg = 'background: transparent;';
	}
	elseif( !empty( $caption_bg_no_color ) )
	{
		$caption_bg = 'background: url(images/' . $caption_bg_image . ') ' . $caption_bg_type . ';';
	}
	else
	{
		$caption_bg = 'background: #' . $caption_bg_color . ' url(images/' . $caption_bg_image . ') ' . $caption_bg_type . ';';
	}
	
	// Thumbnail Image background
	$thumbnail_bg_type = dynamik_get_design( 'thumbnail_bg_type' );
	$thumbnail_bg_no_color = dynamik_get_design( 'thumbnail_bg_no_color' ) ? dynamik_get_design( 'thumbnail_bg_no_color' ) : '';
	$thumbnail_bg_color = dynamik_get_design( 'thumbnail_bg_color' );
	$thumbnail_bg_image = dynamik_get_design( 'thumbnail_bg_image' );
	
	if( $thumbnail_bg_type == 'color' )
	{
		$thumbnail_bg = 'background: #' . $thumbnail_bg_color . ';';
	}
	elseif( $thumbnail_bg_type == 'transparent' )
	{
		$thumbnail_bg = 'background: transparent;';
	}
	elseif( !empty( $thumbnail_bg_no_color ) )
	{
		$thumbnail_bg = 'background: url(images/' . $thumbnail_bg_image . ') ' . $thumbnail_bg_type . ';';
	}
	else
	{
		$thumbnail_bg = 'background: #' . $thumbnail_bg_color . ' url(images/' . $thumbnail_bg_image . ') ' . $thumbnail_bg_type . ';';
	}
	
	// EZ Widget Area backgrounds
	$ez_widget_home_bg_type = dynamik_get_design( 'ez_widget_home_bg_type' );
	$ez_widget_home_bg_no_color = dynamik_get_design( 'ez_widget_home_bg_no_color' ) ? dynamik_get_design( 'ez_widget_home_bg_no_color' ) : '';
	$ez_widget_home_bg_color = dynamik_get_design( 'ez_widget_home_bg_color' );
	$ez_widget_home_bg_image = dynamik_get_design( 'ez_widget_home_bg_image' );
	
	if( $ez_widget_home_bg_type == 'color' )
	{
		$ez_widget_home_bg = 'background: #' . $ez_widget_home_bg_color . ';';
	}
	elseif( $ez_widget_home_bg_type == 'transparent' )
	{
		$ez_widget_home_bg = 'background: transparent;';
	}
	elseif( !empty( $ez_widget_home_bg_no_color ) )
	{
		$ez_widget_home_bg = 'background: url(images/' . $ez_widget_home_bg_image . ') ' . $ez_widget_home_bg_type . ';';
	}
	else
	{
		$ez_widget_home_bg = 'background: #' . $ez_widget_home_bg_color . ' url(images/' . $ez_widget_home_bg_image . ') ' . $ez_widget_home_bg_type . ';';
	}
	
	$ez_widget_feature_bg_type = dynamik_get_design( 'ez_widget_feature_bg_type' );
	$ez_widget_feature_bg_no_color = dynamik_get_design( 'ez_widget_feature_bg_no_color' ) ? dynamik_get_design( 'ez_widget_feature_bg_no_color' ) : '';
	$ez_widget_feature_bg_color = dynamik_get_design( 'ez_widget_feature_bg_color' );
	$ez_widget_feature_bg_image = dynamik_get_design( 'ez_widget_feature_bg_image' );
	
	if( $ez_widget_feature_bg_type == 'color' )
	{
		$ez_widget_feature_bg = 'background: #' . $ez_widget_feature_bg_color . ';';
	}
	elseif( $ez_widget_feature_bg_type == 'transparent' )
	{
		$ez_widget_feature_bg = 'background: transparent;';
	}
	elseif( !empty( $ez_widget_feature_bg_no_color ) )
	{
		$ez_widget_feature_bg = 'background: url(images/' . $ez_widget_feature_bg_image . ') ' . $ez_widget_feature_bg_type . ';';
	}
	else
	{
		$ez_widget_feature_bg = 'background: #' . $ez_widget_feature_bg_color . ' url(images/' . $ez_widget_feature_bg_image . ') ' . $ez_widget_feature_bg_type . ';';
	}
	
	$ez_widget_footer_bg_type = dynamik_get_design( 'ez_widget_footer_bg_type' );
	$ez_widget_footer_bg_no_color = dynamik_get_design( 'ez_widget_footer_bg_no_color' ) ? dynamik_get_design( 'ez_widget_footer_bg_no_color' ) : '';
	$ez_widget_footer_bg_color = dynamik_get_design( 'ez_widget_footer_bg_color' );
	$ez_widget_footer_bg_image = dynamik_get_design( 'ez_widget_footer_bg_image' );
	
	if( $ez_widget_footer_bg_type == 'color' )
	{
		$ez_widget_footer_bg = 'background: #' . $ez_widget_footer_bg_color . ';';
	}
	elseif( $ez_widget_footer_bg_type == 'transparent' )
	{
		$ez_widget_footer_bg = 'background: transparent;';
	}
	elseif( !empty( $ez_widget_footer_bg_no_color ) )
	{
		$ez_widget_footer_bg = 'background: url(images/' . $ez_widget_footer_bg_image . ') ' . $ez_widget_footer_bg_type . ';';
	}
	else
	{
		$ez_widget_footer_bg = 'background: #' . $ez_widget_footer_bg_color . ' url(images/' . $ez_widget_footer_bg_image . ') ' . $ez_widget_footer_bg_type . ';';
	}
	
	// Custom Widget Area background
	$dynamik_widget_bg_type = dynamik_get_design( 'dynamik_widget_bg_type' );
	$dynamik_widget_bg_no_color = dynamik_get_design( 'dynamik_widget_bg_no_color' ) ? dynamik_get_design( 'dynamik_widget_bg_no_color' ) : '';
	$dynamik_widget_bg_color = dynamik_get_design( 'dynamik_widget_bg_color' );
	$dynamik_widget_bg_image = dynamik_get_design( 'dynamik_widget_bg_image' );
	
	if( $dynamik_widget_bg_type == 'color' )
	{
		$dynamik_widget_bg = 'background: #' . $dynamik_widget_bg_color . ';';
	}
	elseif( $dynamik_widget_bg_type == 'transparent' )
	{
		$dynamik_widget_bg = 'background: transparent;';
	}
	elseif( !empty( $dynamik_widget_bg_no_color ) )
	{
		$dynamik_widget_bg = 'background: url( ' . $image_dir . $dynamik_widget_bg_image . ' ) ' . $dynamik_widget_bg_type . ';';
	}
	else
	{
		$dynamik_widget_bg = 'background: #' . $dynamik_widget_bg_color . ' url( ' . $image_dir . $dynamik_widget_bg_image . ' ) ' . $dynamik_widget_bg_type . ';';
	}

	// Sidebar background
	$sb_heading_bg_type = dynamik_get_design( 'sb_heading_bg_type' );
	$sb_heading_bg_no_color = dynamik_get_design( 'sb_heading_bg_no_color' ) ? dynamik_get_design( 'sb_heading_bg_no_color' ) : '';
	$sb_heading_bg_color = dynamik_get_design( 'sb_heading_bg_color' );
	$sb_heading_bg_image = dynamik_get_design( 'sb_heading_bg_image' );
	
	if( $sb_heading_bg_type == 'color' )
	{
		$sb_heading_bg = 'background: #' . $sb_heading_bg_color . ';';
	}
	elseif( $sb_heading_bg_type == 'transparent' )
	{
		$sb_heading_bg = 'background: transparent;';
	}
	elseif( !empty( $sb_heading_bg_no_color ) )
	{
		$sb_heading_bg = 'background: url(images/' . $sb_heading_bg_image . ') ' . $sb_heading_bg_type . ';';
	}
	else
	{
		$sb_heading_bg = 'background: #' . $sb_heading_bg_color . ' url(images/' . $sb_heading_bg_image . ') ' . $sb_heading_bg_type . ';';
	}
	
	$sb_content_bg_type = dynamik_get_design( 'sb_content_bg_type' );
	$sb_content_bg_no_color = dynamik_get_design( 'sb_content_bg_no_color' ) ? dynamik_get_design( 'sb_content_bg_no_color' ) : '';
	$sb_content_bg_color = dynamik_get_design( 'sb_content_bg_color' );
	$sb_content_bg_image = dynamik_get_design( 'sb_content_bg_image' );
	
	if( $sb_content_bg_type == 'color' )
	{
		$sb_content_bg = 'background: #' . $sb_content_bg_color . ';';
	}
	elseif( $sb_content_bg_type == 'transparent' )
	{
		$sb_content_bg = 'background: transparent;';
	}
	elseif( !empty( $sb_content_bg_no_color ) )
	{
		$sb_content_bg = 'background: url(images/' . $sb_content_bg_image . ') ' . $sb_content_bg_type . ';';
	}
	else
	{
		$sb_content_bg = 'background: #' . $sb_content_bg_color . ' url(images/' . $sb_content_bg_image . ') ' . $sb_content_bg_type . ';';
	}
	
	// Breadcrumbs background
	$breadcrumbs_bg_type = dynamik_get_design( 'breadcrumbs_bg_type' );
	$breadcrumbs_bg_no_color = dynamik_get_design( 'breadcrumbs_bg_no_color' ) ? dynamik_get_design( 'breadcrumbs_bg_no_color' ) : '';
	$breadcrumbs_bg_color = dynamik_get_design( 'breadcrumbs_bg_color' );
	$breadcrumbs_bg_image = dynamik_get_design( 'breadcrumbs_bg_image' );
	
	if( $breadcrumbs_bg_type == 'color' )
	{
		$breadcrumbs_bg = 'background: #' . $breadcrumbs_bg_color . ';';
	}
	elseif( $breadcrumbs_bg_type == 'transparent' )
	{
		$breadcrumbs_bg = 'background: transparent;';
	}
	elseif( !empty( $breadcrumbs_bg_no_color ) )
	{
		$breadcrumbs_bg = 'background: url(images/' . $breadcrumbs_bg_image . ') ' . $breadcrumbs_bg_type . ';';
	}
	else
	{
		$breadcrumbs_bg = 'background: #' . $breadcrumbs_bg_color . ' url(images/' . $breadcrumbs_bg_image . ') ' . $breadcrumbs_bg_type . ';';
	}
	
	// Taxonomy Box background
	$taxonomy_box_heading_bg_type = dynamik_get_design( 'taxonomy_box_heading_bg_type' );
	$taxonomy_box_heading_bg_no_color = dynamik_get_design( 'taxonomy_box_heading_bg_no_color' ) ? dynamik_get_design( 'taxonomy_box_heading_bg_no_color' ) : '';
	$taxonomy_box_heading_bg_color = dynamik_get_design( 'taxonomy_box_heading_bg_color' );
	$taxonomy_box_heading_bg_image = dynamik_get_design( 'taxonomy_box_heading_bg_image' );
	
	if( $taxonomy_box_heading_bg_type == 'color' )
	{
		$taxonomy_box_heading_bg = 'background: #' . $taxonomy_box_heading_bg_color . ';';
	}
	elseif( $taxonomy_box_heading_bg_type == 'transparent' )
	{
		$taxonomy_box_heading_bg = 'background: transparent;';
	}
	elseif( !empty( $taxonomy_box_heading_bg_no_color ) )
	{
		$taxonomy_box_heading_bg = 'background: url(images/' . $taxonomy_box_heading_bg_image . ') ' . $taxonomy_box_heading_bg_type . ';';
	}
	else
	{
		$taxonomy_box_heading_bg = 'background: #' . $taxonomy_box_heading_bg_color . ' url(images/' . $taxonomy_box_heading_bg_image . ') ' . $taxonomy_box_heading_bg_type . ';';
	}
	
	$taxonomy_box_content_bg_type = dynamik_get_design( 'taxonomy_box_content_bg_type' );
	$taxonomy_box_content_bg_no_color = dynamik_get_design( 'taxonomy_box_content_bg_no_color' ) ? dynamik_get_design( 'taxonomy_box_content_bg_no_color' ) : '';
	$taxonomy_box_content_bg_color = dynamik_get_design( 'taxonomy_box_content_bg_color' );
	$taxonomy_box_content_bg_image = dynamik_get_design( 'taxonomy_box_content_bg_image' );
	
	if( $taxonomy_box_content_bg_type == 'color' )
	{
		$taxonomy_box_content_bg = 'background: #' . $taxonomy_box_content_bg_color . ';';
	}
	elseif( $taxonomy_box_content_bg_type == 'transparent' )
	{
		$taxonomy_box_content_bg = 'background: transparent;';
	}
	elseif( !empty( $taxonomy_box_content_bg_no_color ) )
	{
		$taxonomy_box_content_bg = 'background: url(images/' . $taxonomy_box_content_bg_image . ') ' . $taxonomy_box_content_bg_type . ';';
	}
	else
	{
		$taxonomy_box_content_bg = 'background: #' . $taxonomy_box_content_bg_color . ' url(images/' . $taxonomy_box_content_bg_image . ') ' . $taxonomy_box_content_bg_type . ';';
	}
	
	// Author Box backgrounds
	$author_box_bg_type = dynamik_get_design( 'author_box_bg_type' );
	$author_box_bg_no_color = dynamik_get_design( 'author_box_bg_no_color' ) ? dynamik_get_design( 'author_box_bg_no_color' ) : '';
	$author_box_bg_color = dynamik_get_design( 'author_box_bg_color' );
	$author_box_bg_image = dynamik_get_design( 'author_box_bg_image' );
	
	if( $author_box_bg_type == 'color' )
	{
		$author_box_bg = 'background: #' . $author_box_bg_color . ';';
	}
	elseif( $author_box_bg_type == 'transparent' )
	{
		$author_box_bg = 'background: transparent;';
	}
	elseif( !empty( $author_box_bg_no_color ) )
	{
		$author_box_bg = 'background: url(images/' . $author_box_bg_image . ') ' . $author_box_bg_type . ';';
	}
	else
	{
		$author_box_bg = 'background: #' . $author_box_bg_color . ' url(images/' . $author_box_bg_image . ') ' . $author_box_bg_type . ';';
	}
	
	$author_box_avatar_bg_type = dynamik_get_design( 'author_box_avatar_bg_type' );
	$author_box_avatar_bg_no_color = dynamik_get_design( 'author_box_avatar_bg_no_color' ) ? dynamik_get_design( 'author_box_avatar_bg_no_color' ) : '';
	$author_box_avatar_bg_color = dynamik_get_design( 'author_box_avatar_bg_color' );
	$author_box_avatar_bg_image = dynamik_get_design( 'author_box_avatar_bg_image' );
	
	if( $author_box_avatar_bg_type == 'color' )
	{
		$author_box_avatar_bg = 'background: #' . $author_box_avatar_bg_color . ';';
	}
	elseif( $author_box_avatar_bg_type == 'transparent' )
	{
		$author_box_avatar_bg = 'background: transparent;';
	}
	elseif( !empty( $author_box_avatar_bg_no_color ) )
	{
		$author_box_avatar_bg = 'background: url(images/' . $author_box_avatar_bg_image . ') ' . $author_box_avatar_bg_type . ';';
	}
	else
	{
		$author_box_avatar_bg = 'background: #' . $author_box_avatar_bg_color . ' url(images/' . $author_box_avatar_bg_image . ') ' . $author_box_avatar_bg_type . ';';
	}
	
	// Post-Nav backgrounds
	$post_nav_numbered_inactive_bg_type = dynamik_get_design( 'post_nav_numbered_inactive_bg_type' );
	$post_nav_numbered_inactive_bg_no_color = dynamik_get_design( 'post_nav_numbered_inactive_bg_no_color' ) ? dynamik_get_design( 'post_nav_numbered_inactive_bg_no_color' ) : '';
	$post_nav_numbered_inactive_bg_color = dynamik_get_design( 'post_nav_numbered_inactive_bg_color' );
	$post_nav_numbered_inactive_bg_image = dynamik_get_design( 'post_nav_numbered_inactive_bg_image' );
	
	if( $post_nav_numbered_inactive_bg_type == 'color' )
	{
		$post_nav_numbered_inactive_bg = 'background: #' . $post_nav_numbered_inactive_bg_color . ';';
	}
	elseif( $post_nav_numbered_inactive_bg_type == 'transparent' )
	{
		$post_nav_numbered_inactive_bg = 'background: transparent;';
	}
	elseif( !empty( $post_nav_numbered_inactive_bg_no_color ) )
	{
		$post_nav_numbered_inactive_bg = 'background: url(images/' . $post_nav_numbered_inactive_bg_image . ') ' . $post_nav_numbered_inactive_bg_type . ';';
	}
	else
	{
		$post_nav_numbered_inactive_bg = 'background: #' . $post_nav_numbered_inactive_bg_color . ' url(images/' . $post_nav_numbered_inactive_bg_image . ') ' . $post_nav_numbered_inactive_bg_type . ';';
	}
	
	$post_nav_numbered_active_bg_type = dynamik_get_design( 'post_nav_numbered_active_bg_type' );
	$post_nav_numbered_active_bg_no_color = dynamik_get_design( 'post_nav_numbered_active_bg_no_color' ) ? dynamik_get_design( 'post_nav_numbered_active_bg_no_color' ) : '';
	$post_nav_numbered_active_bg_color = dynamik_get_design( 'post_nav_numbered_active_bg_color' );
	$post_nav_numbered_active_bg_image = dynamik_get_design( 'post_nav_numbered_active_bg_image' );
	
	if( $post_nav_numbered_active_bg_type == 'color' )
	{
		$post_nav_numbered_active_bg = 'background: #' . $post_nav_numbered_active_bg_color . ';';
	}
	elseif( $post_nav_numbered_active_bg_type == 'transparent' )
	{
		$post_nav_numbered_active_bg = 'background: transparent;';
	}
	elseif( !empty( $post_nav_numbered_active_bg_no_color ) )
	{
		$post_nav_numbered_active_bg = 'background: url(images/' . $post_nav_numbered_active_bg_image . ') ' . $post_nav_numbered_active_bg_type . ';';
	}
	else
	{
		$post_nav_numbered_active_bg = 'background: #' . $post_nav_numbered_active_bg_color . ' url(images/' . $post_nav_numbered_active_bg_image . ') ' . $post_nav_numbered_active_bg_type . ';';
	}
	
	// Comment backgrounds
	$comment_even_bg_type = dynamik_get_design( 'comment_even_bg_type' );
	$comment_even_bg_no_color = dynamik_get_design( 'comment_even_bg_no_color' ) ? dynamik_get_design( 'comment_even_bg_no_color' ) : '';
	$comment_even_bg_color = dynamik_get_design( 'comment_even_bg_color' );
	$comment_even_bg_image = dynamik_get_design( 'comment_even_bg_image' );
	
	if( $comment_even_bg_type == 'color' )
	{
		$comment_even_bg = 'background: #' . $comment_even_bg_color . ';';
	}
	elseif( $comment_even_bg_type == 'transparent' )
	{
		$comment_even_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_even_bg_no_color ) )
	{
		$comment_even_bg = 'background: url(images/' . $comment_even_bg_image . ') ' . $comment_even_bg_type . ';';
	}
	else
	{
		$comment_even_bg = 'background: #' . $comment_even_bg_color . ' url(images/' . $comment_even_bg_image . ') ' . $comment_even_bg_type . ';';
	}
	
	$comment_alt_bg_type = dynamik_get_design( 'comment_alt_bg_type' );
	$comment_alt_bg_no_color = dynamik_get_design( 'comment_alt_bg_no_color' ) ? dynamik_get_design( 'comment_alt_bg_no_color' ) : '';
	$comment_alt_bg_color = dynamik_get_design( 'comment_alt_bg_color' );
	$comment_alt_bg_image = dynamik_get_design( 'comment_alt_bg_image' );
	
	if( $comment_alt_bg_type == 'color' )
	{
		$comment_alt_bg = 'background: #' . $comment_alt_bg_color . ';';
	}
	elseif( $comment_alt_bg_type == 'transparent' )
	{
		$comment_alt_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_alt_bg_no_color ) )
	{
		$comment_alt_bg = 'background: url(images/' . $comment_alt_bg_image . ') ' . $comment_alt_bg_type . ';';
	}
	else
	{
		$comment_alt_bg = 'background: #' . $comment_alt_bg_color . ' url(images/' . $comment_alt_bg_image . ') ' . $comment_alt_bg_type . ';';
	}
	
	$comment_reply_bg_type = dynamik_get_design( 'comment_reply_bg_type' );
	$comment_reply_bg_no_color = dynamik_get_design( 'comment_reply_bg_no_color' ) ? dynamik_get_design( 'comment_reply_bg_no_color' ) : '';
	$comment_reply_bg_color = dynamik_get_design( 'comment_reply_bg_color' );
	$comment_reply_bg_image = dynamik_get_design( 'comment_reply_bg_image' );
	
	if( $comment_reply_bg_type == 'color' )
	{
		$comment_reply_bg = 'background: #' . $comment_reply_bg_color . ';';
	}
	elseif( $comment_reply_bg_type == 'transparent' )
	{
		$comment_reply_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_reply_bg_no_color ) )
	{
		$comment_reply_bg = 'background: url(images/' . $comment_reply_bg_image . ') ' . $comment_reply_bg_type . ';';
	}
	else
	{
		$comment_reply_bg = 'background: #' . $comment_reply_bg_color . ' url(images/' . $comment_reply_bg_image . ') ' . $comment_reply_bg_type . ';';
	}

	$comment_reply_text_bg_type = dynamik_get_design( 'comment_reply_text_bg_type' );
	$comment_reply_text_bg_no_color = dynamik_get_design( 'comment_reply_text_bg_no_color' ) ? dynamik_get_design( 'comment_reply_text_bg_no_color' ) : '';
	$comment_reply_text_bg_color = dynamik_get_design( 'comment_reply_text_bg_color' );
	$comment_reply_text_bg_image = dynamik_get_design( 'comment_reply_text_bg_image' );
	
	if( $comment_reply_text_bg_type == 'color' )
	{
		$comment_reply_text_bg = 'background: #' . $comment_reply_text_bg_color . ';';
	}
	elseif( $comment_reply_text_bg_type == 'transparent' )
	{
		$comment_reply_text_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_reply_text_bg_no_color ) )
	{
		$comment_reply_text_bg = 'background: url(images/' . $comment_reply_text_bg_image . ') ' . $comment_reply_text_bg_type . ';';
	}
	else
	{
		$comment_reply_text_bg = 'background: #' . $comment_reply_text_bg_color . ' url(images/' . $comment_reply_text_bg_image . ') ' . $comment_reply_text_bg_type . ';';
	}

	$comment_reply_text_hover_bg_type = dynamik_get_design( 'comment_reply_text_hover_bg_type' );
	$comment_reply_text_hover_bg_no_color = dynamik_get_design( 'comment_reply_text_hover_bg_no_color' ) ? dynamik_get_design( 'comment_reply_text_hover_bg_no_color' ) : '';
	$comment_reply_text_hover_bg_color = dynamik_get_design( 'comment_reply_text_hover_bg_color' );
	$comment_reply_text_hover_bg_image = dynamik_get_design( 'comment_reply_text_hover_bg_image' );
	
	if( $comment_reply_text_hover_bg_type == 'color' )
	{
		$comment_reply_text_hover_bg = 'background: #' . $comment_reply_text_hover_bg_color . ';';
	}
	elseif( $comment_reply_text_hover_bg_type == 'transparent' )
	{
		$comment_reply_text_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_reply_text_hover_bg_no_color ) )
	{
		$comment_reply_text_hover_bg = 'background: url(images/' . $comment_reply_text_hover_bg_image . ') ' . $comment_reply_text_hover_bg_type . ';';
	}
	else
	{
		$comment_reply_text_hover_bg = 'background: #' . $comment_reply_text_hover_bg_color . ' url(images/' . $comment_reply_text_hover_bg_image . ') ' . $comment_reply_text_hover_bg_type . ';';
	}
	
	$comment_avatar_bg_type = dynamik_get_design( 'comment_avatar_bg_type' );
	$comment_avatar_bg_no_color = dynamik_get_design( 'comment_avatar_bg_no_color' ) ? dynamik_get_design( 'comment_avatar_bg_no_color' ) : '';
	$comment_avatar_bg_color = dynamik_get_design( 'comment_avatar_bg_color' );
	$comment_avatar_bg_image = dynamik_get_design( 'comment_avatar_bg_image' );
	
	if( $comment_avatar_bg_type == 'color' )
	{
		$comment_avatar_bg = 'background: #' . $comment_avatar_bg_color . ';';
	}
	elseif( $comment_avatar_bg_type == 'transparent' )
	{
		$comment_avatar_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_avatar_bg_no_color ) )
	{
		$comment_avatar_bg = 'background: url(images/' . $comment_avatar_bg_image . ') ' . $comment_avatar_bg_type . ';';
	}
	else
	{
		$comment_avatar_bg = 'background: #' . $comment_avatar_bg_color . ' url(images/' . $comment_avatar_bg_image . ') ' . $comment_avatar_bg_type . ';';
	}
	
	$comment_form_bg_type = dynamik_get_design( 'comment_form_bg_type' );
	$comment_form_bg_no_color = dynamik_get_design( 'comment_form_bg_no_color' ) ? dynamik_get_design( 'comment_form_bg_no_color' ) : '';
	$comment_form_bg_color = dynamik_get_design( 'comment_form_bg_color' );
	$comment_form_bg_image = dynamik_get_design( 'comment_form_bg_image' );
	
	if( $comment_form_bg_type == 'color' )
	{
		$comment_form_bg = 'background: #' . $comment_form_bg_color . ';';
	}
	elseif( $comment_form_bg_type == 'transparent' )
	{
		$comment_form_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_form_bg_no_color ) )
	{
		$comment_form_bg = 'background: url(images/' . $comment_form_bg_image . ') ' . $comment_form_bg_type . ';';
	}
	else
	{
		$comment_form_bg = 'background: #' . $comment_form_bg_color . ' url(images/' . $comment_form_bg_image . ') ' . $comment_form_bg_type . ';';
	}
	
	$comment_submit_bg_type = dynamik_get_design( 'comment_submit_bg_type' );
	$comment_submit_bg_no_color = dynamik_get_design( 'comment_submit_bg_no_color' ) ? dynamik_get_design( 'comment_submit_bg_no_color' ) : '';
	$comment_submit_bg_color = dynamik_get_design( 'comment_submit_bg_color' );
	$comment_submit_bg_image = dynamik_get_design( 'comment_submit_bg_image' );
	
	if( $comment_submit_bg_type == 'color' )
	{
		$comment_submit_bg = 'background: #' . $comment_submit_bg_color . ';';
	}
	elseif( $comment_submit_bg_type == 'transparent' )
	{
		$comment_submit_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_submit_bg_no_color ) )
	{
		$comment_submit_bg = 'background: url(images/' . $comment_submit_bg_image . ') ' . $comment_submit_bg_type . ';';
	}
	else
	{
		$comment_submit_bg = 'background: #' . $comment_submit_bg_color . ' url(images/' . $comment_submit_bg_image . ') ' . $comment_submit_bg_type . ';';
	}
	
	$comment_submit_hover_bg_type = dynamik_get_design( 'comment_submit_hover_bg_type' );
	$comment_submit_hover_bg_no_color = dynamik_get_design( 'comment_submit_hover_bg_no_color' ) ? dynamik_get_design( 'comment_submit_hover_bg_no_color' ) : '';
	$comment_submit_hover_bg_color = dynamik_get_design( 'comment_submit_hover_bg_color' );
	$comment_submit_hover_bg_image = dynamik_get_design( 'comment_submit_hover_bg_image' );
	
	if( $comment_submit_hover_bg_type == 'color' )
	{
		$comment_submit_hover_bg = 'background: #' . $comment_submit_hover_bg_color . ';';
	}
	elseif( $comment_submit_hover_bg_type == 'transparent' )
	{
		$comment_submit_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_submit_hover_bg_no_color ) )
	{
		$comment_submit_hover_bg = 'background: url(images/' . $comment_submit_hover_bg_image . ') ' . $comment_submit_hover_bg_type . ';';
	}
	else
	{
		$comment_submit_hover_bg = 'background: #' . $comment_submit_hover_bg_color . ' url(images/' . $comment_submit_hover_bg_image . ') ' . $comment_submit_hover_bg_type . ';';
	}

	$comment_form_allowed_tags_bg_type = dynamik_get_design( 'comment_form_allowed_tags_bg_type' );
	$comment_form_allowed_tags_bg_no_color = dynamik_get_design( 'comment_form_allowed_tags_bg_no_color' ) ? dynamik_get_design( 'comment_form_allowed_tags_bg_no_color' ) : '';
	$comment_form_allowed_tags_bg_color = dynamik_get_design( 'comment_form_allowed_tags_bg_color' );
	$comment_form_allowed_tags_bg_image = dynamik_get_design( 'comment_form_allowed_tags_bg_image' );
	
	if( $comment_form_allowed_tags_bg_type == 'color' )
	{
		$comment_form_allowed_tags_bg = 'background: #' . $comment_form_allowed_tags_bg_color . ';';
	}
	elseif( $comment_form_allowed_tags_bg_type == 'transparent' )
	{
		$comment_form_allowed_tags_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_form_allowed_tags_bg_no_color ) )
	{
		$comment_form_allowed_tags_bg = 'background: url(images/' . $comment_form_allowed_tags_bg_image . ') ' . $comment_form_allowed_tags_bg_type . ';';
	}
	else
	{
		$comment_form_allowed_tags_bg = 'background: #' . $comment_form_allowed_tags_bg_color . ' url(images/' . $comment_form_allowed_tags_bg_image . ') ' . $comment_form_allowed_tags_bg_type . ';';
	}
	
	// Footer background
	$footer_bg_type = dynamik_get_design( 'footer_bg_type' );
	$footer_bg_no_color = dynamik_get_design( 'footer_bg_no_color' ) ? dynamik_get_design( 'footer_bg_no_color' ) : '';
	$footer_bg_color = dynamik_get_design( 'footer_bg_color' );
	$footer_bg_image = dynamik_get_design( 'footer_bg_image' );
	
	if( $footer_bg_type == 'color' )
	{
		$footer_bg = 'background: #' . $footer_bg_color . ';';
	}
	elseif( $footer_bg_type == 'transparent' )
	{
		$footer_bg = 'background: transparent;';
	}
	elseif( !empty( $footer_bg_no_color ) )
	{
		$footer_bg = 'background: url(images/' . $footer_bg_image . ') ' . $footer_bg_type . ';';
	}
	else
	{
		$footer_bg = 'background: #' . $footer_bg_color . ' url(images/' . $footer_bg_image . ') ' . $footer_bg_type . ';';
	}
	
	// Search Form background
	$search_form_bg_type = dynamik_get_design( 'search_form_bg_type' );
	$search_form_bg_no_color = dynamik_get_design( 'search_form_bg_no_color' ) ? dynamik_get_design( 'search_form_bg_no_color' ) : '';
	$search_form_bg_color = dynamik_get_design( 'search_form_bg_color' );
	$search_form_bg_image = dynamik_get_design( 'search_form_bg_image' );
	
	if( $search_form_bg_type == 'color' )
	{
		$search_form_bg = 'background: #' . $search_form_bg_color . ';';
	}
	elseif( $search_form_bg_type == 'transparent' )
	{
		$search_form_bg = 'background: transparent;';
	}
	elseif( !empty( $search_form_bg_no_color ) )
	{
		$search_form_bg = 'background: url(images/' . $search_form_bg_image . ') ' . $search_form_bg_type . ';';
	}
	else
	{
		$search_form_bg = 'background: #' . $search_form_bg_color . ' url(images/' . $search_form_bg_image . ') ' . $search_form_bg_type . ';';
	}
	
	$search_button_bg_type = dynamik_get_design( 'search_button_bg_type' );
	$search_button_bg_no_color = dynamik_get_design( 'search_button_bg_no_color' ) ? dynamik_get_design( 'search_button_bg_no_color' ) : '';
	$search_button_bg_color = dynamik_get_design( 'search_button_bg_color' );
	$search_button_bg_image = dynamik_get_design( 'search_button_bg_image' );
	
	if( $search_button_bg_type == 'color' )
	{
		$search_button_bg = 'background: #' . $search_button_bg_color . ';';
	}
	elseif( $search_button_bg_type == 'transparent' )
	{
		$search_button_bg = 'background: transparent;';
	}
	elseif( !empty( $search_button_bg_no_color ) )
	{
		$search_button_bg = 'background: url(images/' . $search_button_bg_image . ') ' . $search_button_bg_type . ';';
	}
	else
	{
		$search_button_bg = 'background: #' . $search_button_bg_color . ' url(images/' . $search_button_bg_image . ') ' . $search_button_bg_type . ';';
	}
	
	$search_button_hover_bg_type = dynamik_get_design( 'search_button_hover_bg_type' );
	$search_button_hover_bg_no_color = dynamik_get_design( 'search_button_hover_bg_no_color' ) ? dynamik_get_design( 'search_button_hover_bg_no_color' ) : '';
	$search_button_hover_bg_color = dynamik_get_design( 'search_button_hover_bg_color' );
	$search_button_hover_bg_image = dynamik_get_design( 'search_button_hover_bg_image' );
	
	if( $search_button_hover_bg_type == 'color' )
	{
		$search_button_hover_bg = 'background: #' . $search_button_hover_bg_color . ';';
	}
	elseif( $search_button_hover_bg_type == 'transparent' )
	{
		$search_button_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $search_button_hover_bg_no_color ) )
	{
		$search_button_hover_bg = 'background: url(images/' . $search_button_hover_bg_image . ') ' . $search_button_hover_bg_type . ';';
	}
	else
	{
		$search_button_hover_bg = 'background: #' . $search_button_hover_bg_color . ' url(images/' . $search_button_hover_bg_image . ') ' . $search_button_hover_bg_type . ';';
	}
	
	/****************************************
			Define Border Styles
	****************************************/
	
	// #wrap/.site-container border
	$wrap_border_thickness = dynamik_get_design( 'wrap_border_thickness' );
	$wrap_border_style = dynamik_get_design( 'wrap_border_style' );
	$wrap_border_color = dynamik_get_design( 'wrap_border_color' );
	
	if( dynamik_get_design( 'wrap_border_type' ) == 'Full' )
	{
		$wrap_tb_border_thickness = $wrap_border_thickness;
		$wrap_lr_border_thickness = $wrap_border_thickness;
	}
	elseif( dynamik_get_design( 'wrap_border_type' ) == 'Top/Bottom' )
	{
		$wrap_tb_border_thickness = $wrap_border_thickness;
		$wrap_lr_border_thickness = 0;
	}
	else
	{
		$wrap_tb_border_thickness = 0;
		$wrap_lr_border_thickness = $wrap_border_thickness;
	}
	
	$wrap_shadow_style = dynamik_get_design( 'wrap_shadow_style' );
	$wrap_radius_style = dynamik_get_design( 'wrap_radius_style' );
	
	if( dynamik_get_design( 'wrap_shadow_active' ) )
	{
		$wrap_box_shadow = '-webkit-box-shadow: ' . $wrap_shadow_style . ';' . "\n";
		$wrap_box_shadow .= "\t" . 'box-shadow: ' . $wrap_shadow_style . ';';
	}
	else
	{
		$wrap_box_shadow = '';
	}
	
	if( dynamik_get_design( 'wrap_radius_active' ) )
	{
		$wrap_border_radius = '-webkit-border-radius: ' . $wrap_radius_style . ';' . "\n";
		$wrap_border_radius .= "\t" . 'border-radius: ' . $wrap_radius_style . ';';
	}
	else
	{
		$wrap_border_radius = '';
	}
	
	// Header border (Thickness is defined in Widths section)
	$header_border_style = dynamik_get_design( 'header_border_style' );
	$header_border_color = dynamik_get_design( 'header_border_color' );
	
	if( dynamik_get_design( 'header_border_type' ) == 'Top' )
	{
		$header_top_border_thickness = $header_border_thickness;
		$header_bottom_border_thickness = 0;
		$header_lr_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'header_border_type' ) == 'Bottom' )
	{
		$header_top_border_thickness = 0;
		$header_bottom_border_thickness = $header_border_thickness;
		$header_lr_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'header_border_type' ) == 'Top/Bottom' )
	{
		$header_top_border_thickness = $header_border_thickness;
		$header_bottom_border_thickness = $header_border_thickness;
		$header_lr_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'header_border_type' ) == 'Left/Right' )
	{
		$header_top_border_thickness = 0;
		$header_bottom_border_thickness = 0;
		$header_lr_border_thickness = $header_border_thickness;
	}
	else
	{
		$header_top_border_thickness = $header_border_thickness;
		$header_bottom_border_thickness = $header_border_thickness;
		$header_lr_border_thickness = $header_border_thickness;
	}
	
	// Nav borders (Thickness is defined in Widths section)
	$nav1_border_style = dynamik_get_design( 'nav1_border_style' );
	$nav1_border_color = dynamik_get_design( 'nav1_border_color' );
	$nav1_page_border_style = dynamik_get_design( 'nav1_page_border_style' );
	$nav1_page_border_color = dynamik_get_design( 'nav1_page_border_color' );
	$nav1_page_hover_border_color = dynamik_get_design( 'nav1_page_hover_border_color' );
	$nav1_page_active_border_color = dynamik_get_design( 'nav1_page_active_border_color' );
	$nav1_submenu_border_color = dynamik_get_design( 'nav1_submenu_border_color' );
	
	if( dynamik_get_design( 'nav1_border_type' ) == 'Bottom' )
	{
		$nav1_top_border_thickness = 0;
		$nav1_bottom_border_thickness = $nav1_border_thickness;
		$nav1_left_border_thickness = 0;
		$nav1_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'nav1_border_type' ) == 'Top' )
	{
		$nav1_top_border_thickness = $nav1_border_thickness;
		$nav1_bottom_border_thickness = 0;
		$nav1_left_border_thickness = 0;
		$nav1_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'nav1_border_type' ) == 'Top/Bottom' )
	{
		$nav1_top_border_thickness = $nav1_border_thickness;
		$nav1_bottom_border_thickness = $nav1_border_thickness;
		$nav1_left_border_thickness = 0;
		$nav1_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'nav1_border_type' ) == 'Left/Right' )
	{
		$nav1_top_border_thickness = 0;
		$nav1_bottom_border_thickness = 0;
		$nav1_left_border_thickness = $nav1_border_thickness;
		$nav1_right_border_thickness = $nav1_border_thickness;
	}
	else
	{
		$nav1_top_border_thickness = $nav1_border_thickness;
		$nav1_bottom_border_thickness = $nav1_border_thickness;
		$nav1_left_border_thickness = $nav1_border_thickness;
		$nav1_right_border_thickness = $nav1_border_thickness;
	}
	
	//*** Nav Page Border Thickness options are defined below ***//
	
	// Subnav borders (Thickness is defined in Widths section)
	$nav2_border_style = dynamik_get_design( 'nav2_border_style' );
	$nav2_border_color = dynamik_get_design( 'nav2_border_color' );
	$nav2_page_border_style = dynamik_get_design( 'nav2_page_border_style' );
	$nav2_page_border_color = dynamik_get_design( 'nav2_page_border_color' );
	$nav2_page_hover_border_color = dynamik_get_design( 'nav2_page_hover_border_color' );
	$nav2_page_active_border_color = dynamik_get_design( 'nav2_page_active_border_color' );
	$nav2_submenu_border_color = dynamik_get_design( 'nav2_submenu_border_color' );
	
	if( dynamik_get_design( 'nav2_border_type' ) == 'Bottom' )
	{
		$nav2_top_border_thickness = 0;
		$nav2_bottom_border_thickness = $nav2_border_thickness;
		$nav2_left_border_thickness = 0;
		$nav2_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'nav2_border_type' ) == 'Top' )
	{
		$nav2_top_border_thickness = $nav2_border_thickness;
		$nav2_bottom_border_thickness = 0;
		$nav2_left_border_thickness = 0;
		$nav2_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'nav2_border_type' ) == 'Top/Bottom' )
	{
		$nav2_top_border_thickness = $nav2_border_thickness;
		$nav2_bottom_border_thickness = $nav2_border_thickness;
		$nav2_left_border_thickness = 0;
		$nav2_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'nav2_border_type' ) == 'Left/Right' )
	{
		$nav2_top_border_thickness = 0;
		$nav2_bottom_border_thickness = 0;
		$nav2_left_border_thickness = $nav2_border_thickness;
		$nav2_right_border_thickness = $nav2_border_thickness;
	}
	else
	{
		$nav2_top_border_thickness = $nav2_border_thickness;
		$nav2_bottom_border_thickness = $nav2_border_thickness;
		$nav2_left_border_thickness = $nav2_border_thickness;
		$nav2_right_border_thickness = $nav2_border_thickness;
	}
	
	//*** Subnav Page Border Thickness options are defined below ***//
	
	// Header Nav borders (Thickness is defined in Widths section)
	$nav3_border_style = dynamik_get_design( 'nav3_border_style' );
	$nav3_border_color = dynamik_get_design( 'nav3_border_color' );
	$nav3_page_border_style = dynamik_get_design( 'nav3_page_border_style' );
	$nav3_page_border_color = dynamik_get_design( 'nav3_page_border_color' );
	$nav3_page_hover_border_color = dynamik_get_design( 'nav3_page_hover_border_color' );
	$nav3_page_active_border_color = dynamik_get_design( 'nav3_page_active_border_color' );
	$nav3_submenu_border_color = dynamik_get_design( 'nav3_submenu_border_color' );
	
	if( dynamik_get_design( 'nav3_border_type' ) == 'Bottom' )
	{
		$nav3_top_border_thickness = 0;
		$nav3_bottom_border_thickness = $nav3_border_thickness;
		$nav3_left_border_thickness = 0;
		$nav3_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'nav3_border_type' ) == 'Top' )
	{
		$nav3_top_border_thickness = $nav3_border_thickness;
		$nav3_bottom_border_thickness = 0;
		$nav3_left_border_thickness = 0;
		$nav3_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'nav3_border_type' ) == 'Top/Bottom' )
	{
		$nav3_top_border_thickness = $nav3_border_thickness;
		$nav3_bottom_border_thickness = $nav3_border_thickness;
		$nav3_left_border_thickness = 0;
		$nav3_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'nav3_border_type' ) == 'Left/Right' )
	{
		$nav3_top_border_thickness = 0;
		$nav3_bottom_border_thickness = 0;
		$nav3_left_border_thickness = $nav3_border_thickness;
		$nav3_right_border_thickness = $nav3_border_thickness;
	}
	else
	{
		$nav3_top_border_thickness = $nav3_border_thickness;
		$nav3_bottom_border_thickness = $nav3_border_thickness;
		$nav3_left_border_thickness = $nav3_border_thickness;
		$nav3_right_border_thickness = $nav3_border_thickness;
	}
	
	//*** Header Nav Page Border Thickness options are defined below ***//
	
	// #inner/.site-inner border
	// $inner_border_thickness is defined near the top of this file.
	$inner_border_style = dynamik_get_design( 'inner_border_style' );
	$inner_border_color = dynamik_get_design( 'inner_border_color' );
	
	if( dynamik_get_design( 'inner_border_type' ) == 'Full' )
	{
		$inner_tb_border_thickness = $inner_border_thickness;
		$inner_lr_border_thickness = $inner_border_thickness;
	}
	elseif( dynamik_get_design( 'inner_border_type' ) == 'Top/Bottom' )
	{
		$inner_tb_border_thickness = $inner_border_thickness;
		$inner_lr_border_thickness = 0;
	}
	else
	{
		$inner_tb_border_thickness = 0;
		$inner_lr_border_thickness = $inner_border_thickness;
	}
	
	$inner_shadow_style = dynamik_get_design( 'inner_shadow_style' );
	$inner_radius_style = dynamik_get_design( 'inner_radius_style' );
	
	if( dynamik_get_design( 'inner_shadow_active' ) )
	{
		$inner_box_shadow = '-webkit-box-shadow: ' . $inner_shadow_style . ';' . "\n";
		$inner_box_shadow .= "\t" . 'box-shadow: ' . $inner_shadow_style . ';';
	}
	else
	{
		$inner_box_shadow = '';
	}
	
	if( dynamik_get_design( 'inner_radius_active' ) )
	{
		$inner_border_radius = '-webkit-border-radius: ' . $inner_radius_style . ';' . "\n";
		$inner_border_radius .= "\t" . 'border-radius: ' . $inner_radius_style . ';';
	}
	else
	{
		$inner_border_radius = '';
	}

	// General Box Shadow/Border Radius
	$general_shadow_style = dynamik_get_design( 'general_shadow_style' );
	$general_radius_style = dynamik_get_design( 'general_radius_style' );
	$general_shadow_elements = dynamik_get_design( 'general_shadow_elements' );
	$general_radius_elements = dynamik_get_design( 'general_radius_elements' );
	
	if( dynamik_get_design( 'general_shadow_active' ) )
	{
		$general_shadow_styles = "\n" . $general_shadow_elements . ' {
	-webkit-box-shadow: ' . $general_shadow_style . ';
	box-shadow: ' . $general_shadow_style . ';
}';
	}
	else
	{
		$general_shadow_styles = '';
	}
	
	if( dynamik_get_design( 'general_radius_active' ) )
	{
		$general_radius_styles = "\n" . $general_radius_elements . ' {
		-webkit-border-radius: ' . $general_radius_style . ';
		border-radius: ' . $general_radius_style . ';
}';
	}
	else
	{
		$general_radius_styles = '';
	}
	
	// Post content borders
	$post_content_border_thickness = dynamik_get_design( 'post_content_border_thickness' );
	$post_content_border_style = dynamik_get_design( 'post_content_border_style' );
	$post_content_border_color = dynamik_get_design( 'post_content_border_color' );
	
	if( dynamik_get_design( 'post_content_border_type' ) == 'Top/Bottom' )
	{
		$post_content_top_border_thickness = $post_content_border_thickness;
		$post_content_bottom_border_thickness = $post_content_border_thickness;
		$post_content_left_border_thickness = 0;
		$post_content_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'post_content_border_type' ) == 'Bottom' )
	{
		$post_content_top_border_thickness = 0;
		$post_content_bottom_border_thickness = $post_content_border_thickness;
		$post_content_left_border_thickness = 0;
		$post_content_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'post_content_border_type' ) == 'Left/Right' )
	{
		$post_content_top_border_thickness = 0;
		$post_content_bottom_border_thickness = 0;
		$post_content_left_border_thickness = $post_content_border_thickness;
		$post_content_right_border_thickness = $post_content_border_thickness;
	}
	elseif( dynamik_get_design( 'post_content_border_type' ) == 'Left' )
	{
		$post_content_top_border_thickness = 0;
		$post_content_bottom_border_thickness = 0;
		$post_content_left_border_thickness = $post_content_border_thickness;
		$post_content_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'post_content_border_type' ) == 'Right' )
	{
		$post_content_top_border_thickness = 0;
		$post_content_bottom_border_thickness = 0;
		$post_content_left_border_thickness = 0;
		$post_content_right_border_thickness = $post_content_border_thickness;
	}
	else
	{
		$post_content_top_border_thickness = $post_content_border_thickness;
		$post_content_bottom_border_thickness = $post_content_border_thickness;
		$post_content_left_border_thickness = $post_content_border_thickness;
		$post_content_right_border_thickness = $post_content_border_thickness;
	}
	
	// Page content borders
	$page_content_border_thickness = dynamik_get_design( 'page_content_border_thickness' );
	$page_content_border_style = dynamik_get_design( 'page_content_border_style' );
	$page_content_border_color = dynamik_get_design( 'page_content_border_color' );
	
	if( dynamik_get_design( 'page_content_border_type' ) == 'Top/Bottom' )
	{
		$page_content_top_border_thickness = $page_content_border_thickness;
		$page_content_bottom_border_thickness = $page_content_border_thickness;
		$page_content_left_border_thickness = 0;
		$page_content_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'page_content_border_type' ) == 'Bottom' )
	{
		$page_content_top_border_thickness = 0;
		$page_content_bottom_border_thickness = $page_content_border_thickness;
		$page_content_left_border_thickness = 0;
		$page_content_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'page_content_border_type' ) == 'Left/Right' )
	{
		$page_content_top_border_thickness = 0;
		$page_content_bottom_border_thickness = 0;
		$page_content_left_border_thickness = $page_content_border_thickness;
		$page_content_right_border_thickness = $page_content_border_thickness;
	}
	elseif( dynamik_get_design( 'page_content_border_type' ) == 'Left' )
	{
		$page_content_top_border_thickness = 0;
		$page_content_bottom_border_thickness = 0;
		$page_content_left_border_thickness = $page_content_border_thickness;
		$page_content_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'page_content_border_type' ) == 'Right' )
	{
		$page_content_top_border_thickness = 0;
		$page_content_bottom_border_thickness = 0;
		$page_content_left_border_thickness = 0;
		$page_content_right_border_thickness = $page_content_border_thickness;
	}
	else
	{
		$page_content_top_border_thickness = $page_content_border_thickness;
		$page_content_bottom_border_thickness = $page_content_border_thickness;
		$page_content_left_border_thickness = $page_content_border_thickness;
		$page_content_right_border_thickness = $page_content_border_thickness;
	}
	
	// Sticky-Post borders
	$sticky_post_border_thickness = dynamik_get_design( 'sticky_post_border_thickness' );
	$sticky_post_border_style = dynamik_get_design( 'sticky_post_border_style' );
	$sticky_post_border_color = dynamik_get_design( 'sticky_post_border_color' );
	
	if( dynamik_get_design( 'sticky_post_border_type' ) == 'Top/Bottom' )
	{
		$sticky_post_top_border_thickness = $sticky_post_border_thickness;
		$sticky_post_bottom_border_thickness = $sticky_post_border_thickness;
		$sticky_post_left_border_thickness = 0;
		$sticky_post_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'sticky_post_border_type' ) == 'Bottom' )
	{
		$sticky_post_top_border_thickness = 0;
		$sticky_post_bottom_border_thickness = $sticky_post_border_thickness;
		$sticky_post_left_border_thickness = 0;
		$sticky_post_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'sticky_post_border_type' ) == 'Left/Right' )
	{
		$sticky_post_top_border_thickness = 0;
		$sticky_post_bottom_border_thickness = 0;
		$sticky_post_left_border_thickness = $sticky_post_border_thickness;
		$sticky_post_right_border_thickness = $sticky_post_border_thickness;
	}
	elseif( dynamik_get_design( 'sticky_post_border_type' ) == 'Left' )
	{
		$sticky_post_top_border_thickness = 0;
		$sticky_post_bottom_border_thickness = 0;
		$sticky_post_left_border_thickness = $sticky_post_border_thickness;
		$sticky_post_right_border_thickness = 0;
	}
	else
	{
		$sticky_post_top_border_thickness = $sticky_post_border_thickness;
		$sticky_post_bottom_border_thickness = $sticky_post_border_thickness;
		$sticky_post_left_border_thickness = $sticky_post_border_thickness;
		$sticky_post_right_border_thickness = $sticky_post_border_thickness;
	}
	
	// EZ Widget borders
	$ez_widget_home_heading_bottom_border_thickness = dynamik_get_design( 'ez_widget_home_heading_bottom_border_thickness' );
	$ez_widget_home_heading_bottom_border_style = dynamik_get_design( 'ez_widget_home_heading_bottom_border_style' );
	$ez_widget_home_heading_bottom_border_color = dynamik_get_design( 'ez_widget_home_heading_bottom_border_color' );
	
	$ez_widget_home_border_thickness = dynamik_get_design( 'ez_widget_home_border_thickness' );
	$ez_widget_home_border_style = dynamik_get_design( 'ez_widget_home_border_style' );
	$ez_widget_home_border_color = dynamik_get_design( 'ez_widget_home_border_color' );
	
	if( dynamik_get_design( 'ez_widget_home_border_type' ) == 'Full' )
	{
		$ez_widget_home_tb_border_thickness = $ez_widget_home_border_thickness;
		$ez_widget_home_lr_border_thickness = $ez_widget_home_border_thickness;
	}
	elseif( dynamik_get_design( 'ez_widget_home_border_type' ) == 'Top/Bottom' )
	{
		$ez_widget_home_tb_border_thickness = $ez_widget_home_border_thickness;
		$ez_widget_home_lr_border_thickness = 0;
	}
	else
	{
		$ez_widget_home_tb_border_thickness = 0;
		$ez_widget_home_lr_border_thickness = $ez_widget_home_border_thickness;
	}
	
	$ez_widget_feature_heading_bottom_border_thickness = dynamik_get_design( 'ez_widget_feature_heading_bottom_border_thickness' );
	$ez_widget_feature_heading_bottom_border_style = dynamik_get_design( 'ez_widget_feature_heading_bottom_border_style' );
	$ez_widget_feature_heading_bottom_border_color = dynamik_get_design( 'ez_widget_feature_heading_bottom_border_color' );
	
	$ez_widget_feature_border_thickness = dynamik_get_design( 'ez_widget_feature_border_thickness' );
	$ez_widget_feature_border_style = dynamik_get_design( 'ez_widget_feature_border_style' );
	$ez_widget_feature_border_color = dynamik_get_design( 'ez_widget_feature_border_color' );
	
	if( dynamik_get_design( 'ez_widget_feature_border_type' ) == 'Top' )
	{
		$ez_widget_feature_top_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_bottom_border_thickness = 0;
		$ez_widget_feature_left_border_thickness = 0;
		$ez_widget_feature_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'ez_widget_feature_border_type' ) == 'Bottom' )
	{
		$ez_widget_feature_top_border_thickness = 0;
		$ez_widget_feature_bottom_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_left_border_thickness = 0;
		$ez_widget_feature_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'ez_widget_feature_border_type' ) == 'Top/Bottom' )
	{
		$ez_widget_feature_top_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_bottom_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_left_border_thickness = 0;
		$ez_widget_feature_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'ez_widget_feature_border_type' ) == 'Left/Right' )
	{
		$ez_widget_feature_top_border_thickness = 0;
		$ez_widget_feature_bottom_border_thickness = 0;
		$ez_widget_feature_left_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_right_border_thickness = $ez_widget_feature_border_thickness;
	}
	else
	{
		$ez_widget_feature_top_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_bottom_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_left_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_right_border_thickness = $ez_widget_feature_border_thickness;
	}
	
	$ez_widget_footer_heading_bottom_border_thickness = dynamik_get_design( 'ez_widget_footer_heading_bottom_border_thickness' );
	$ez_widget_footer_heading_bottom_border_style = dynamik_get_design( 'ez_widget_footer_heading_bottom_border_style' );
	$ez_widget_footer_heading_bottom_border_color = dynamik_get_design( 'ez_widget_footer_heading_bottom_border_color' );
	
	$ez_widget_footer_border_thickness = dynamik_get_design( 'ez_widget_footer_border_thickness' );
	$ez_widget_footer_border_style = dynamik_get_design( 'ez_widget_footer_border_style' );
	$ez_widget_footer_border_color = dynamik_get_design( 'ez_widget_footer_border_color' );
	
	if( dynamik_get_design( 'ez_widget_footer_border_type' ) == 'Top' )
	{
		$ez_widget_footer_top_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_bottom_border_thickness = 0;
		$ez_widget_footer_left_border_thickness = 0;
		$ez_widget_footer_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'ez_widget_footer_border_type' ) == 'Bottom' )
	{
		$ez_widget_footer_top_border_thickness = 0;
		$ez_widget_footer_bottom_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_left_border_thickness = 0;
		$ez_widget_footer_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'ez_widget_footer_border_type' ) == 'Top/Bottom' )
	{
		$ez_widget_footer_top_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_bottom_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_left_border_thickness = 0;
		$ez_widget_footer_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'ez_widget_footer_border_type' ) == 'Left/Right' )
	{
		$ez_widget_footer_top_border_thickness = 0;
		$ez_widget_footer_bottom_border_thickness = 0;
		$ez_widget_footer_left_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_right_border_thickness = $ez_widget_footer_border_thickness;
	}
	else
	{
		$ez_widget_footer_top_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_bottom_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_left_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_right_border_thickness = $ez_widget_footer_border_thickness;
	}
	
	// Custom Widget Area borders
	$dynamik_widget_border_thickness = dynamik_get_design( 'dynamik_widget_border_thickness' );
	$dynamik_widget_border_style = dynamik_get_design( 'dynamik_widget_border_style' );
	$dynamik_widget_border_color = dynamik_get_design( 'dynamik_widget_border_color' );
	
	if( dynamik_get_design( 'dynamik_widget_border_type' ) == 'Top' )
	{
		$dynamik_widget_top_border_thickness = $dynamik_widget_border_thickness;
		$dynamik_widget_bottom_border_thickness = 0;
		$dynamik_widget_left_border_thickness = 0;
		$dynamik_widget_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'dynamik_widget_border_type' ) == 'Bottom' )
	{
		$dynamik_widget_top_border_thickness = 0;
		$dynamik_widget_bottom_border_thickness = $dynamik_widget_border_thickness;
		$dynamik_widget_left_border_thickness = 0;
		$dynamik_widget_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'dynamik_widget_border_type' ) == 'Left' )
	{
		$dynamik_widget_top_border_thickness = 0;
		$dynamik_widget_bottom_border_thickness = 0;
		$dynamik_widget_left_border_thickness = $dynamik_widget_border_thickness;
		$dynamik_widget_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'dynamik_widget_border_type' ) == 'Right' )
	{
		$dynamik_widget_top_border_thickness = 0;
		$dynamik_widget_bottom_border_thickness = 0;
		$dynamik_widget_left_border_thickness = 0;
		$dynamik_widget_right_border_thickness = $dynamik_widget_border_thickness;
	}
	else
	{
		$dynamik_widget_top_border_thickness = $dynamik_widget_border_thickness;
		$dynamik_widget_bottom_border_thickness = $dynamik_widget_border_thickness;
		$dynamik_widget_left_border_thickness = $dynamik_widget_border_thickness;
		$dynamik_widget_right_border_thickness = $dynamik_widget_border_thickness;
	}
	
	// Breadcrumb borders
	$breadcrumbs_border_thickness = dynamik_get_design( 'breadcrumbs_border_thickness' );
	$breadcrumbs_border_style = dynamik_get_design( 'breadcrumbs_border_style' );
	$breadcrumbs_border_color = dynamik_get_design( 'breadcrumbs_border_color' );
	
	if( dynamik_get_design( 'breadcrumbs_border_type' ) == 'Top/Bottom' )
	{
		$breadcrumbs_top_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_bottom_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_left_border_thickness = 0;
		$breadcrumbs_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'breadcrumbs_border_type' ) == 'Bottom' )
	{
		$breadcrumbs_top_border_thickness = 0;
		$breadcrumbs_bottom_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_left_border_thickness = 0;
		$breadcrumbs_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'breadcrumbs_border_type' ) == 'Left/Right' )
	{
		$breadcrumbs_top_border_thickness = 0;
		$breadcrumbs_bottom_border_thickness = 0;
		$breadcrumbs_left_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_right_border_thickness = $breadcrumbs_border_thickness;
	}
	elseif( dynamik_get_design( 'breadcrumbs_border_type' ) == 'Left' )
	{
		$breadcrumbs_top_border_thickness = 0;
		$breadcrumbs_bottom_border_thickness = 0;
		$breadcrumbs_left_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_right_border_thickness = 0;
	}
	else
	{
		$breadcrumbs_top_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_bottom_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_left_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_right_border_thickness = $breadcrumbs_border_thickness;
	}
	
	// Taxonomy Box borders
	$taxonomy_box_heading_border_thickness = dynamik_get_design( 'taxonomy_box_heading_border_thickness' );
	$taxonomy_box_heading_border_style = dynamik_get_design( 'taxonomy_box_heading_border_style' );
	$taxonomy_box_heading_border_color = dynamik_get_design( 'taxonomy_box_heading_border_color' );
	
	if( dynamik_get_design( 'taxonomy_box_heading_border_type' ) == 'Bottom' )
	{
		$taxonomy_box_heading_top_border_thickness = 0;
		$taxonomy_box_heading_bottom_border_thickness = $taxonomy_box_heading_border_thickness;
		$taxonomy_box_heading_lr_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'taxonomy_box_heading_border_type' ) == 'Top/Bottom' )
	{
		$taxonomy_box_heading_top_border_thickness = $taxonomy_box_heading_border_thickness;
		$taxonomy_box_heading_bottom_border_thickness = $taxonomy_box_heading_border_thickness;
		$taxonomy_box_heading_lr_border_thickness = 0;
	}
	else
	{
		$taxonomy_box_heading_top_border_thickness = $taxonomy_box_heading_border_thickness;
		$taxonomy_box_heading_bottom_border_thickness = $taxonomy_box_heading_border_thickness;
		$taxonomy_box_heading_lr_border_thickness = $taxonomy_box_heading_border_thickness;
	}
	
	$taxonomy_box_content_border_thickness = dynamik_get_design( 'taxonomy_box_content_border_thickness' );
	$taxonomy_box_content_border_style = dynamik_get_design( 'taxonomy_box_content_border_style' );
	$taxonomy_box_content_border_color = dynamik_get_design( 'taxonomy_box_content_border_color' );
	
	if( dynamik_get_design( 'taxonomy_box_content_border_type' ) == 'Bottom' )
	{
		$taxonomy_box_content_top_border_thickness = 0;
		$taxonomy_box_content_bottom_border_thickness = $taxonomy_box_content_border_thickness;
		$taxonomy_box_content_lr_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'taxonomy_box_content_border_type' ) == 'Top/Bottom' )
	{
		$taxonomy_box_content_top_border_thickness = $taxonomy_box_content_border_thickness;
		$taxonomy_box_content_bottom_border_thickness = $taxonomy_box_content_border_thickness;
		$taxonomy_box_content_lr_border_thickness = 0;
	}
	else
	{
		$taxonomy_box_content_top_border_thickness = $taxonomy_box_content_border_thickness;
		$taxonomy_box_content_bottom_border_thickness = $taxonomy_box_content_border_thickness;
		$taxonomy_box_content_lr_border_thickness = $taxonomy_box_content_border_thickness;
	}
	
	// Author Box avatar borders
	$author_box_avatar_border_thickness = dynamik_get_design( 'author_box_avatar_border_thickness' );
	$author_box_avatar_border_style = dynamik_get_design( 'author_box_avatar_border_style' );
	$author_box_avatar_border_color = dynamik_get_design( 'author_box_avatar_border_color' );
	
	// Author Box borders
	$author_box_border_thickness = dynamik_get_design( 'author_box_border_thickness' );
	$author_box_border_style = dynamik_get_design( 'author_box_border_style' );
	$author_box_border_color = dynamik_get_design( 'author_box_border_color' );
	
	if( dynamik_get_design( 'author_box_border_type' ) == 'Full' )
	{
		$author_box_top_border_thickness = $author_box_border_thickness;
		$author_box_bottom_border_thickness = $author_box_border_thickness;
		$author_box_left_border_thickness = $author_box_border_thickness;
		$author_box_right_border_thickness = $author_box_border_thickness;
	}
	elseif( dynamik_get_design( 'author_box_border_type' ) == 'Top/Bottom' )
	{
		$author_box_top_border_thickness = $author_box_border_thickness;
		$author_box_bottom_border_thickness = $author_box_border_thickness;
		$author_box_left_border_thickness = 0;
		$author_box_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'author_box_border_type' ) == 'Top' )
	{
		$author_box_top_border_thickness = $author_box_border_thickness;
		$author_box_bottom_border_thickness = 0;
		$author_box_left_border_thickness = 0;
		$author_box_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'author_box_border_type' ) == 'Bottom' )
	{
		$author_box_top_border_thickness = 0;
		$author_box_bottom_border_thickness = $author_box_border_thickness;
		$author_box_left_border_thickness = 0;
		$author_box_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'author_box_border_type' ) == 'Left/Right' )
	{
		$author_box_top_border_thickness = 0;
		$author_box_bottom_border_thickness = 0;
		$author_box_left_border_thickness = $author_box_border_thickness;
		$author_box_right_border_thickness = $author_box_border_thickness;
	}
	elseif( dynamik_get_design( 'author_box_border_type' ) == 'Left' )
	{
		$author_box_top_border_thickness = 0;
		$author_box_bottom_border_thickness = 0;
		$author_box_left_border_thickness = $author_box_border_thickness;
		$author_box_right_border_thickness = 0;
	}
	else
	{
		$author_box_top_border_thickness = 0;
		$author_box_bottom_border_thickness = 0;
		$author_box_left_border_thickness = 0;
		$author_box_right_border_thickness = $author_box_border_thickness;
	}
	
	// Post-Nav borders
	$post_nav_border_thickness = dynamik_get_design( 'post_nav_border_thickness' );
	$post_nav_border_style = dynamik_get_design( 'post_nav_border_style' );
	$post_nav_border_color = dynamik_get_design( 'post_nav_border_color' );
	
	// Thumbnail borders
	$thumbnail_border_thickness = dynamik_get_design( 'thumbnail_border_thickness' );
	$thumbnail_border_style = dynamik_get_design( 'thumbnail_border_style' );
	$thumbnail_border_color = dynamik_get_design( 'thumbnail_border_color' );
	
	// Blockquote borders
	$blockquote_border_thickness = dynamik_get_design( 'blockquote_border_thickness' );
	$blockquote_border_style = dynamik_get_design( 'blockquote_border_style' );
	$blockquote_border_color = dynamik_get_design( 'blockquote_border_color' );
	
	if( dynamik_get_design( 'blockquote_border_type' ) == 'Left' )
	{
		$blockquote_top_border_thickness = 0;
		$blockquote_bottom_border_thickness = 0;
		$blockquote_left_border_thickness = $blockquote_border_thickness;
		$blockquote_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'blockquote_border_type' ) == 'Top/Bottom' )
	{
		$blockquote_top_border_thickness = $blockquote_border_thickness;
		$blockquote_bottom_border_thickness = $blockquote_border_thickness;
		$blockquote_left_border_thickness = 0;
		$blockquote_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'blockquote_border_type' ) == 'Top' )
	{
		$blockquote_top_border_thickness = $blockquote_border_thickness;
		$blockquote_bottom_border_thickness = 0;
		$blockquote_left_border_thickness = 0;
		$blockquote_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'blockquote_border_type' ) == 'Bottom' )
	{
		$blockquote_top_border_thickness = 0;
		$blockquote_bottom_border_thickness = $blockquote_border_thickness;
		$blockquote_left_border_thickness = 0;
		$blockquote_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'blockquote_border_type' ) == 'Left/Right' )
	{
		$blockquote_top_border_thickness = 0;
		$blockquote_bottom_border_thickness = 0;
		$blockquote_left_border_thickness = $blockquote_border_thickness;
		$blockquote_right_border_thickness = $blockquote_border_thickness;
	}
	else
	{
		$blockquote_top_border_thickness = $blockquote_border_thickness;
		$blockquote_bottom_border_thickness = $blockquote_border_thickness;
		$blockquote_left_border_thickness = $blockquote_border_thickness;
		$blockquote_right_border_thickness = $blockquote_border_thickness;
	}
	
	// Content Caption borders
	$caption_border_thickness = dynamik_get_design( 'caption_border_thickness' );
	$caption_border_style = dynamik_get_design( 'caption_border_style' );
	$caption_border_color = dynamik_get_design( 'caption_border_color' );
	
	// Content Bottom borders
	$cc_bottom_border_thickness = dynamik_get_design( 'cc_bottom_border_thickness' );
	$cc_bottom_border_style = dynamik_get_design( 'cc_bottom_border_style' );
	$cc_bottom_border_color = dynamik_get_design( 'cc_bottom_border_color' );
	
	// Sidebar Heading/Content borders
	$sb_heading_border_thickness = dynamik_get_design( 'sb_heading_border_thickness' );
	$sb_heading_border_style = dynamik_get_design( 'sb_heading_border_style' );
	$sb_heading_border_color = dynamik_get_design( 'sb_heading_border_color' );
	
	if( dynamik_get_design( 'sb_heading_border_type' ) == 'Bottom' )
	{
		$sb_heading_top_border_thickness = 0;
		$sb_heading_bottom_border_thickness = $sb_heading_border_thickness;
		$sb_heading_lr_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'sb_heading_border_type' ) == 'Top/Bottom' )
	{
		$sb_heading_top_border_thickness = $sb_heading_border_thickness;
		$sb_heading_bottom_border_thickness = $sb_heading_border_thickness;
		$sb_heading_lr_border_thickness = 0;
	}
	else
	{
		$sb_heading_top_border_thickness = $sb_heading_border_thickness;
		$sb_heading_bottom_border_thickness = $sb_heading_border_thickness;
		$sb_heading_lr_border_thickness = $sb_heading_border_thickness;
	}
	
	$sb_content_border_thickness = dynamik_get_design( 'sb_content_border_thickness' );
	$sb_content_border_style = dynamik_get_design( 'sb_content_border_style' );
	$sb_content_border_color = dynamik_get_design( 'sb_content_border_color' );
	
	if( dynamik_get_design( 'sb_content_border_type' ) == 'Bottom' )
	{
		$sb_content_top_border_thickness = 0;
		$sb_content_bottom_border_thickness = $sb_content_border_thickness;
		$sb_content_lr_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'sb_content_border_type' ) == 'Top/Bottom' )
	{
		$sb_content_top_border_thickness = $sb_content_border_thickness;
		$sb_content_bottom_border_thickness = $sb_content_border_thickness;
		$sb_content_lr_border_thickness = 0;
	}
	else
	{
		$sb_content_top_border_thickness = $sb_content_border_thickness;
		$sb_content_bottom_border_thickness = $sb_content_border_thickness;
		$sb_content_lr_border_thickness = $sb_content_border_thickness;
	}
	
	$sb_li_bottom_border_thickness = dynamik_get_design( 'sb_li_bottom_border_thickness' );
	$sb_li_bottom_border_style = dynamik_get_design( 'sb_li_bottom_border_style' );
	$sb_li_bottom_border_color = dynamik_get_design( 'sb_li_bottom_border_color' );
	
	// Comment borders
	$comment_list_border_thickness = dynamik_get_design( 'comment_list_border_thickness' );
	$comment_list_border_style = dynamik_get_design( 'comment_list_border_style' );
	$comment_list_border_color = dynamik_get_design( 'comment_list_border_color' );
	
	if( dynamik_get_design( 'comment_list_border_type' ) == 'Full' )
	{
		$comment_list_top_border_thickness = $comment_list_border_thickness;
		$comment_list_bottom_border_thickness = $comment_list_border_thickness;
		$comment_list_left_border_thickness = $comment_list_border_thickness;
		$comment_list_right_border_thickness = $comment_list_border_thickness;
	}
	elseif( dynamik_get_design( 'comment_list_border_type' ) == 'Top/Bottom' )
	{
		$comment_list_top_border_thickness = $comment_list_border_thickness;
		$comment_list_bottom_border_thickness = $comment_list_border_thickness;
		$comment_list_left_border_thickness = 0;
		$comment_list_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'comment_list_border_type' ) == 'Top' )
	{
		$comment_list_top_border_thickness = $comment_list_border_thickness;
		$comment_list_bottom_border_thickness = 0;
		$comment_list_left_border_thickness = 0;
		$comment_list_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'comment_list_border_type' ) == 'Bottom' )
	{
		$comment_list_top_border_thickness = 0;
		$comment_list_bottom_border_thickness = $comment_list_border_thickness;
		$comment_list_left_border_thickness = 0;
		$comment_list_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'comment_list_border_type' ) == 'Left/Right' )
	{
		$comment_list_top_border_thickness = 0;
		$comment_list_bottom_border_thickness = 0;
		$comment_list_left_border_thickness = $comment_list_border_thickness;
		$comment_list_right_border_thickness = $comment_list_border_thickness;
	}
	elseif( dynamik_get_design( 'comment_list_border_type' ) == 'Left' )
	{
		$comment_list_top_border_thickness = 0;
		$comment_list_bottom_border_thickness = 0;
		$comment_list_left_border_thickness = $comment_list_border_thickness;
		$comment_list_right_border_thickness = 0;
	}
	else
	{
		$comment_list_top_border_thickness = 0;
		$comment_list_bottom_border_thickness = 0;
		$comment_list_left_border_thickness = 0;
		$comment_list_right_border_thickness = $comment_list_border_thickness;
	}

	$comment_reply_text_border_thickness = dynamik_get_design( 'comment_reply_text_border_thickness' );
	$comment_reply_text_border_style = dynamik_get_design( 'comment_reply_text_border_style' );
	$comment_reply_text_border_color = dynamik_get_design( 'comment_reply_text_border_color' );
	
	if( dynamik_get_design( 'comment_reply_text_border_type' ) == 'Full' )
	{
		$comment_reply_text_top_border_thickness = $comment_reply_text_border_thickness;
		$comment_reply_text_bottom_border_thickness = $comment_reply_text_border_thickness;
		$comment_reply_text_left_border_thickness = $comment_reply_text_border_thickness;
		$comment_reply_text_right_border_thickness = $comment_reply_text_border_thickness;
	}
	elseif( dynamik_get_design( 'comment_reply_text_border_type' ) == 'Top/Bottom' )
	{
		$comment_reply_text_top_border_thickness = $comment_reply_text_border_thickness;
		$comment_reply_text_bottom_border_thickness = $comment_reply_text_border_thickness;
		$comment_reply_text_left_border_thickness = 0;
		$comment_reply_text_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'comment_reply_text_border_type' ) == 'Top' )
	{
		$comment_reply_text_top_border_thickness = $comment_reply_text_border_thickness;
		$comment_reply_text_bottom_border_thickness = 0;
		$comment_reply_text_left_border_thickness = 0;
		$comment_reply_text_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'comment_reply_text_border_type' ) == 'Bottom' )
	{
		$comment_reply_text_top_border_thickness = 0;
		$comment_reply_text_bottom_border_thickness = $comment_reply_text_border_thickness;
		$comment_reply_text_left_border_thickness = 0;
		$comment_reply_text_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'comment_reply_text_border_type' ) == 'Left/Right' )
	{
		$comment_reply_text_top_border_thickness = 0;
		$comment_reply_text_bottom_border_thickness = 0;
		$comment_reply_text_left_border_thickness = $comment_reply_text_border_thickness;
		$comment_reply_text_right_border_thickness = $comment_reply_text_border_thickness;
	}
	elseif( dynamik_get_design( 'comment_reply_text_border_type' ) == 'Left' )
	{
		$comment_reply_text_top_border_thickness = 0;
		$comment_reply_text_bottom_border_thickness = 0;
		$comment_reply_text_left_border_thickness = $comment_reply_text_border_thickness;
		$comment_reply_text_right_border_thickness = 0;
	}
	else
	{
		$comment_reply_text_top_border_thickness = 0;
		$comment_reply_text_bottom_border_thickness = 0;
		$comment_reply_text_left_border_thickness = 0;
		$comment_reply_text_right_border_thickness = $comment_reply_text_border_thickness;
	}

	$comment_reply_text_hover_border_thickness = dynamik_get_design( 'comment_reply_text_hover_border_thickness' );
	$comment_reply_text_hover_border_style = dynamik_get_design( 'comment_reply_text_hover_border_style' );
	$comment_reply_text_hover_border_color = dynamik_get_design( 'comment_reply_text_hover_border_color' );
	
	if( dynamik_get_design( 'comment_reply_text_hover_border_type' ) == 'Full' )
	{
		$comment_reply_text_hover_top_border_thickness = $comment_reply_text_hover_border_thickness;
		$comment_reply_text_hover_bottom_border_thickness = $comment_reply_text_hover_border_thickness;
		$comment_reply_text_hover_left_border_thickness = $comment_reply_text_hover_border_thickness;
		$comment_reply_text_hover_right_border_thickness = $comment_reply_text_hover_border_thickness;
	}
	elseif( dynamik_get_design( 'comment_reply_text_hover_border_type' ) == 'Top/Bottom' )
	{
		$comment_reply_text_hover_top_border_thickness = $comment_reply_text_hover_border_thickness;
		$comment_reply_text_hover_bottom_border_thickness = $comment_reply_text_hover_border_thickness;
		$comment_reply_text_hover_left_border_thickness = 0;
		$comment_reply_text_hover_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'comment_reply_text_hover_border_type' ) == 'Top' )
	{
		$comment_reply_text_hover_top_border_thickness = $comment_reply_text_hover_border_thickness;
		$comment_reply_text_hover_bottom_border_thickness = 0;
		$comment_reply_text_hover_left_border_thickness = 0;
		$comment_reply_text_hover_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'comment_reply_text_hover_border_type' ) == 'Bottom' )
	{
		$comment_reply_text_hover_top_border_thickness = 0;
		$comment_reply_text_hover_bottom_border_thickness = $comment_reply_text_hover_border_thickness;
		$comment_reply_text_hover_left_border_thickness = 0;
		$comment_reply_text_hover_right_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'comment_reply_text_hover_border_type' ) == 'Left/Right' )
	{
		$comment_reply_text_hover_top_border_thickness = 0;
		$comment_reply_text_hover_bottom_border_thickness = 0;
		$comment_reply_text_hover_left_border_thickness = $comment_reply_text_hover_border_thickness;
		$comment_reply_text_hover_right_border_thickness = $comment_reply_text_hover_border_thickness;
	}
	elseif( dynamik_get_design( 'comment_reply_text_hover_border_type' ) == 'Left' )
	{
		$comment_reply_text_hover_top_border_thickness = 0;
		$comment_reply_text_hover_bottom_border_thickness = 0;
		$comment_reply_text_hover_left_border_thickness = $comment_reply_text_hover_border_thickness;
		$comment_reply_text_hover_right_border_thickness = 0;
	}
	else
	{
		$comment_reply_text_hover_top_border_thickness = 0;
		$comment_reply_text_hover_bottom_border_thickness = 0;
		$comment_reply_text_hover_left_border_thickness = 0;
		$comment_reply_text_hover_right_border_thickness = $comment_reply_text_hover_border_thickness;
	}
	
	$comment_avatar_border_thickness = dynamik_get_design( 'comment_avatar_border_thickness' );
	$comment_avatar_border_style = dynamik_get_design( 'comment_avatar_border_style' );
	$comment_avatar_border_color = dynamik_get_design( 'comment_avatar_border_color' );
	
	$comment_form_border_thickness = dynamik_get_design( 'comment_form_border_thickness' );
	$comment_form_border_style = dynamik_get_design( 'comment_form_border_style' );
	$comment_form_border_color = dynamik_get_design( 'comment_form_border_color' );
	
	$comment_submit_border_thickness = dynamik_get_design( 'comment_submit_border_thickness' );
	$comment_submit_border_style = dynamik_get_design( 'comment_submit_border_style' );
	$comment_submit_border_color = dynamik_get_design( 'comment_submit_border_color' );
	
	$comment_submit_hover_border_thickness = dynamik_get_design( 'comment_submit_hover_border_thickness' );
	$comment_submit_hover_border_style = dynamik_get_design( 'comment_submit_hover_border_style' );
	$comment_submit_hover_border_color = dynamik_get_design( 'comment_submit_hover_border_color' );

	$comment_form_allowed_tags_border_thickness = dynamik_get_design( 'comment_form_allowed_tags_border_thickness' );
	$comment_form_allowed_tags_border_style = dynamik_get_design( 'comment_form_allowed_tags_border_style' );
	$comment_form_allowed_tags_border_color = dynamik_get_design( 'comment_form_allowed_tags_border_color' );
	
	// Footer border (Thickness is defined in Widths section)
	$footer_border_style = dynamik_get_design( 'footer_border_style' );
	$footer_border_color = dynamik_get_design( 'footer_border_color' );
	
	if( dynamik_get_design( 'footer_border_type' ) == 'Top' )
	{
		$footer_top_border_thickness = $footer_border_thickness;
		$footer_bottom_border_thickness = 0;
		$footer_lr_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'footer_border_type' ) == 'Bottom' )
	{
		$footer_top_border_thickness = 0;
		$footer_bottom_border_thickness = $footer_border_thickness;
		$footer_lr_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'footer_border_type' ) == 'Top/Bottom' )
	{
		$footer_top_border_thickness = $footer_border_thickness;
		$footer_bottom_border_thickness = $footer_border_thickness;
		$footer_lr_border_thickness = 0;
	}
	elseif( dynamik_get_design( 'footer_border_type' ) == 'Left/Right' )
	{
		$footer_top_border_thickness = 0;
		$footer_bottom_border_thickness = 0;
		$footer_lr_border_thickness = $footer_border_thickness;
	}
	else
	{
		$footer_top_border_thickness = $footer_border_thickness;
		$footer_bottom_border_thickness = $footer_border_thickness;
		$footer_lr_border_thickness = $footer_border_thickness;
	}
	
	// Search Form borders
	$search_form_border_thickness = dynamik_get_design( 'search_form_border_thickness' );
	$search_form_border_style = dynamik_get_design( 'search_form_border_style' );
	$search_form_border_color = dynamik_get_design( 'search_form_border_color' );
	
	$search_button_border_thickness = dynamik_get_design( 'search_button_border_thickness' );
	$search_button_border_style = dynamik_get_design( 'search_button_border_style' );
	$search_button_border_color = dynamik_get_design( 'search_button_border_color' );
	
	$search_button_hover_border_thickness = dynamik_get_design( 'search_button_hover_border_thickness' );
	$search_button_hover_border_style = dynamik_get_design( 'search_button_hover_border_style' );
	$search_button_hover_border_color = dynamik_get_design( 'search_button_hover_border_color' );
	
	/****************************************
			Define Font Styles
	****************************************/
	
	// Universal/Body fonts
	$universal_line_height = dynamik_get_design( 'universal_line_height' );
	$body_font_size = dynamik_build_font_size( 'body' );

	if( true == dynamik_get_design( 'universal_link_transition_active' ) )
	{
		$universal_link_transition = '
a,
button,
input:focus,
input[type="button"],
input[type="reset"],
input[type="submit"],
textarea:focus,
.button {
	-webkit-transition: ' . dynamik_get_design( 'universal_link_transition_style' ) . ';
	-moz-transition: ' . dynamik_get_design( 'universal_link_transition_style' ) . ';
	-ms-transition: ' . dynamik_get_design( 'universal_link_transition_style' ) . ';
	-o-transition: ' . dynamik_get_design( 'universal_link_transition_style' ) . ';
	transition: ' . dynamik_get_design( 'universal_link_transition_style' ) . ';
}';
	}
	else
	{
		$universal_link_transition = '';
	}

	// Header fonts
	$title_font_type = $dynamik_font_type['title'];
	$title_font_size = dynamik_build_font_size( 'title' );
	$title_font_color = dynamik_get_design( 'title_font_color' );
	$title_link_color = dynamik_get_design( 'title_link_color' );

	if( dynamik_get_design( 'title_link_underline' ) == 'On Hover' )
	{
		$title_link_underline_visited = 'none';
		$title_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'title_link_underline' ) == 'Off Hover' )
	{
		$title_link_underline_visited = 'underline';
		$title_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'title_link_underline' ) == 'Always' )
	{
		$title_link_underline_visited = 'underline';
		$title_link_underline_hover = 'underline';
	}
	else
	{
		$title_link_underline_visited = 'none';
		$title_link_underline_hover = 'none';
	}
	
	$tagline_font_type = $dynamik_font_type['tagline'];
	$tagline_font_size = dynamik_build_font_size( 'tagline' );
	$tagline_font_color = dynamik_get_design( 'tagline_font_color' );
	
	// Navb fonts
	$nav1_font_type = $dynamik_font_type['nav1'];
	$nav1_font_size = dynamik_build_font_size( 'nav1' );
	$nav1_sub_page_font_size = dynamik_build_font_size( 'nav1_sub_page' );
	if( dynamik_get_design( 'universal_px_em' ) == 'em' )
	{
		$nav1_font_size_px = dynamik_get_design( 'nav1_font_size' ) * 10;
	}
	else
	{
		$nav1_font_size_px = dynamik_get_design( 'nav1_font_size' );
	}
	
	if( dynamik_get_design( 'nav1_link_underline' ) == 'On Hover' )
	{
		$nav1_link_underline_visited = 'none';
		$nav1_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'nav1_link_underline' ) == 'Off Hover' )
	{
		$nav1_link_underline_visited = 'underline';
		$nav1_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'nav1_link_underline' ) == 'Always' )
	{
		$nav1_link_underline_visited = 'underline';
		$nav1_link_underline_hover = 'underline';
	}
	else
	{
		$nav1_link_underline_visited = 'none';
		$nav1_link_underline_hover = 'none';
	}
	
	$nav1_page_font_color = dynamik_get_design( 'nav1_page_font_color' );
	$nav1_page_hover_font_color = dynamik_get_design( 'nav1_page_hover_font_color' );
	$nav1_page_active_font_color = dynamik_get_design( 'nav1_page_active_font_color' );
	$nav1_sub_page_font_color = dynamik_get_design( 'nav1_sub_page_font_color' );
	$nav1_sub_page_hover_font_color = dynamik_get_design( 'nav1_sub_page_hover_font_color' );
	
	$nav1_extras_font_type = $dynamik_font_type['nav1_extras'];
	$nav1_extras_font_size = dynamik_build_font_size( 'nav1_extras' );
	$nav1_extras_font_color = dynamik_get_design( 'nav1_extras_font_color' );
	$nav1_extras_link_color = dynamik_get_design( 'nav1_extras_link_color' );
	$nav1_extras_link_hover_color = dynamik_get_design( 'nav1_extras_link_hover_color' );
	
	if( dynamik_get_design( 'nav1_extras_link_underline' ) == 'On Hover' )
	{
		$nav1_extras_link_underline_visited = 'none';
		$nav1_extras_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'nav1_extras_link_underline' ) == 'Off Hover' )
	{
		$nav1_extras_link_underline_visited = 'underline';
		$nav1_extras_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'nav1_extras_link_underline' ) == 'Always' )
	{
		$nav1_extras_link_underline_visited = 'underline';
		$nav1_extras_link_underline_hover = 'underline';
	}
	else
	{
		$nav1_extras_link_underline_visited = 'none';
		$nav1_extras_link_underline_hover = 'none';
	}
	
	// Subnav fonts
	$nav2_font_type = $dynamik_font_type['nav2'];
	$nav2_font_size = dynamik_build_font_size( 'nav2' );
	$nav2_sub_page_font_size = dynamik_build_font_size( 'nav2_sub_page' );
	if( dynamik_get_design( 'universal_px_em' ) == 'em' )
	{
		$nav2_font_size_px = dynamik_get_design( 'nav2_font_size' ) * 10;
	}
	else
	{
		$nav2_font_size_px = dynamik_get_design( 'nav2_font_size' );
	}
	
	if( dynamik_get_design( 'nav2_link_underline' ) == 'On Hover' )
	{
		$nav2_link_underline_visited = 'none';
		$nav2_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'nav2_link_underline' ) == 'Off Hover' )
	{
		$nav2_link_underline_visited = 'underline';
		$nav2_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'nav2_link_underline' ) == 'Always' )
	{
		$nav2_link_underline_visited = 'underline';
		$nav2_link_underline_hover = 'underline';
	}
	else
	{
		$nav2_link_underline_visited = 'none';
		$nav2_link_underline_hover = 'none';
	}
	
	$nav2_page_font_color = dynamik_get_design( 'nav2_page_font_color' );
	$nav2_page_hover_font_color = dynamik_get_design( 'nav2_page_hover_font_color' );
	$nav2_page_active_font_color = dynamik_get_design( 'nav2_page_active_font_color' );
	$nav2_sub_page_font_color = dynamik_get_design( 'nav2_sub_page_font_color' );
	$nav2_sub_page_hover_font_color = dynamik_get_design( 'nav2_sub_page_hover_font_color' );
	
	// Header Nav fonts
	$nav3_font_type = $dynamik_font_type['nav3'];
	$nav3_font_size = dynamik_build_font_size( 'nav3' );
	$nav3_sub_page_font_size = dynamik_build_font_size( 'nav3_sub_page' );
	if( dynamik_get_design( 'universal_px_em' ) == 'em' )
	{
		$nav3_font_size_px = dynamik_get_design( 'nav3_font_size' ) * 10;
	}
	else
	{
		$nav3_font_size_px = dynamik_get_design( 'nav3_font_size' );
	}
	
	if( dynamik_get_design( 'nav3_link_underline' ) == 'On Hover' )
	{
		$nav3_link_underline_visited = 'none';
		$nav3_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'nav3_link_underline' ) == 'Off Hover' )
	{
		$nav3_link_underline_visited = 'underline';
		$nav3_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'nav3_link_underline' ) == 'Always' )
	{
		$nav3_link_underline_visited = 'underline';
		$nav3_link_underline_hover = 'underline';
	}
	else
	{
		$nav3_link_underline_visited = 'none';
		$nav3_link_underline_hover = 'none';
	}
	
	$nav3_page_font_color = dynamik_get_design( 'nav3_page_font_color' );
	$nav3_page_hover_font_color = dynamik_get_design( 'nav3_page_hover_font_color' );
	$nav3_page_active_font_color = dynamik_get_design( 'nav3_page_active_font_color' );
	$nav3_sub_page_font_color = dynamik_get_design( 'nav3_sub_page_font_color' );
	$nav3_sub_page_hover_font_color = dynamik_get_design( 'nav3_sub_page_hover_font_color' );
	
	// Content fonts
	$content_heading_font_type = $dynamik_font_type['content_heading'];
	
	$content_heading_h1_font_size = dynamik_build_font_size( 'h1' );
	$content_heading_h2_font_size = dynamik_build_font_size( 'h2' );
	$content_heading_h3_font_size = dynamik_build_font_size( 'h3' );
	$content_heading_h4_font_size = dynamik_build_font_size( 'h4' );
	$content_heading_h5_font_size = dynamik_build_font_size( 'h5' );
	$content_heading_h6_font_size = dynamik_build_font_size( 'h6' );
	
	$content_heading_h1_font_color = dynamik_get_design( 'content_heading_h1_font_color' );
	$content_heading_h2_font_color = dynamik_get_design( 'content_heading_h2_font_color' );
	$content_heading_h2_link_color = dynamik_get_design( 'content_heading_h2_link_color' );
	$content_heading_h2_hover_color = dynamik_get_design( 'content_heading_h2_hover_color' );
	$content_heading_h3_font_color = dynamik_get_design( 'content_heading_h3_font_color' );
	$content_heading_h4_font_color = dynamik_get_design( 'content_heading_h4_font_color' );
	$content_heading_h5_font_color = dynamik_get_design( 'content_heading_h5_font_color' );
	$content_heading_h6_font_color = dynamik_get_design( 'content_heading_h6_font_color' );
	
	if( dynamik_get_design( 'content_heading_h2_link_underline' ) == 'On Hover' )
	{
		$content_heading_h2_link_underline_visited = 'none';
		$content_heading_h2_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'content_heading_h2_link_underline' ) == 'Off Hover' )
	{
		$content_heading_h2_link_underline_visited = 'underline';
		$content_heading_h2_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'content_heading_h2_link_underline' ) == 'Always' )
	{
		$content_heading_h2_link_underline_visited = 'underline';
		$content_heading_h2_link_underline_hover = 'underline';
	}
	else
	{
		$content_heading_h2_link_underline_visited = 'none';
		$content_heading_h2_link_underline_hover = 'none';
	}
	
	$content_p_font_type = $dynamik_font_type['content_p'];
	$content_p_font_size = dynamik_build_font_size( 'content_p' );
	$content_p_font_color = dynamik_get_design( 'content_p_font_color' );
	$content_p_link_color = dynamik_get_design( 'content_p_link_color' );
	$content_p_link_hover_color = dynamik_get_design( 'content_p_link_hover_color' );
	
	if( dynamik_get_design( 'content_p_link_underline' ) == 'On Hover' )
	{
		$content_p_link_underline_visited = 'none';
		$content_p_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'content_p_link_underline' ) == 'Off Hover' )
	{
		$content_p_link_underline_visited = 'underline';
		$content_p_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'content_p_link_underline' ) == 'Always' )
	{
		$content_p_link_underline_visited = 'underline';
		$content_p_link_underline_hover = 'underline';
	}
	else
	{
		$content_p_link_underline_visited = 'none';
		$content_p_link_underline_hover = 'none';
	}
	
	$content_byline_font_type = $dynamik_font_type['content_byline'];
	$content_byline_font_size = dynamik_build_font_size( 'content_byline' );
	$content_byline_font_color = dynamik_get_design( 'content_byline_font_color' );
	$content_byline_link_color = dynamik_get_design( 'content_byline_link_color' );
	$content_byline_link_hover_color = dynamik_get_design( 'content_byline_link_hover_color' );
	
	if( dynamik_get_design( 'content_byline_link_underline' ) == 'On Hover' )
	{
		$content_byline_link_underline_visited = 'none';
		$content_byline_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'content_byline_link_underline' ) == 'Off Hover' )
	{
		$content_byline_link_underline_visited = 'underline';
		$content_byline_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'content_byline_link_underline' ) == 'Always' )
	{
		$content_byline_link_underline_visited = 'underline';
		$content_byline_link_underline_hover = 'underline';
	}
	else
	{
		$content_byline_link_underline_visited = 'none';
		$content_byline_link_underline_hover = 'none';
	}
	
	// Sidebar fonts
	$sb_heading_font_type = $dynamik_font_type['sb_heading'];
	$sb_heading_font_size = dynamik_build_font_size( 'sb_heading' );
	$sb_heading_font_color = dynamik_get_design( 'sb_heading_font_color' );
	
	$sb_content_font_type = $dynamik_font_type['sb_content'];
	$sb_content_font_size = dynamik_build_font_size( 'sb_content' );
	$sb_content_font_color = dynamik_get_design( 'sb_content_font_color' );
	$sb_content_link_color = dynamik_get_design( 'sb_content_link_color' );
	$sb_content_link_hover_color = dynamik_get_design( 'sb_content_link_hover_color' );
	
	if( dynamik_get_design( 'sb_content_link_underline' ) == 'On Hover' )
	{
		$sb_content_link_underline_visited = 'none';
		$sb_content_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'sb_content_link_underline' ) == 'Off Hover' )
	{
		$sb_content_link_underline_visited = 'underline';
		$sb_content_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'sb_content_link_underline' ) == 'Always' )
	{
		$sb_content_link_underline_visited = 'underline';
		$sb_content_link_underline_hover = 'underline';
	}
	else
	{
		$sb_content_link_underline_visited = 'none';
		$sb_content_link_underline_hover = 'none';
	}

	// Breadcrumb fonts
	$breadcrumbs_font_type = $dynamik_font_type['breadcrumbs'];
	$breadcrumbs_font_size = dynamik_build_font_size( 'breadcrumbs' );
	$breadcrumbs_font_color = dynamik_get_design( 'breadcrumbs_font_color' );
	$breadcrumbs_link_color = dynamik_get_design( 'breadcrumbs_link_color' );
	$breadcrumbs_link_hover_color = dynamik_get_design( 'breadcrumbs_link_hover_color' );
	
	if( dynamik_get_design( 'breadcrumbs_link_underline' ) == 'On Hover' )
	{
		$breadcrumbs_link_underline_visited = 'none';
		$breadcrumbs_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'breadcrumbs_link_underline' ) == 'Off Hover' )
	{
		$breadcrumbs_link_underline_visited = 'underline';
		$breadcrumbs_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'breadcrumbs_link_underline' ) == 'Always' )
	{
		$breadcrumbs_link_underline_visited = 'underline';
		$breadcrumbs_link_underline_hover = 'underline';
	}
	else
	{
		$breadcrumbs_link_underline_visited = 'none';
		$breadcrumbs_link_underline_hover = 'none';
	}
	
	// Taxonomy Box fonts
	$taxonomy_box_heading_font_type = $dynamik_font_type['taxonomy_box_heading'];
	$taxonomy_box_heading_font_size = dynamik_build_font_size( 'taxonomy_box_heading' );
	$taxonomy_box_heading_font_color = dynamik_get_design( 'taxonomy_box_heading_font_color' );
	
	$taxonomy_box_content_font_type = $dynamik_font_type['taxonomy_box_content'];
	$taxonomy_box_content_font_size = dynamik_build_font_size( 'taxonomy_box_content' );
	$taxonomy_box_content_font_color = dynamik_get_design( 'taxonomy_box_content_font_color' );
	$taxonomy_box_content_link_color = dynamik_get_design( 'taxonomy_box_content_link_color' );
	$taxonomy_box_content_link_hover_color = dynamik_get_design( 'taxonomy_box_content_link_hover_color' );
	
	if( dynamik_get_design( 'taxonomy_box_content_link_underline' ) == 'On Hover' )
	{
		$taxonomy_box_content_link_underline_visited = 'none';
		$taxonomy_box_content_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'taxonomy_box_content_link_underline' ) == 'Off Hover' )
	{
		$taxonomy_box_content_link_underline_visited = 'underline';
		$taxonomy_box_content_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'taxonomy_box_content_link_underline' ) == 'Always' )
	{
		$taxonomy_box_content_link_underline_visited = 'underline';
		$taxonomy_box_content_link_underline_hover = 'underline';
	}
	else
	{
		$taxonomy_box_content_link_underline_visited = 'none';
		$taxonomy_box_content_link_underline_hover = 'none';
	}
	
	// Author Box fonts
	$author_box_title_font_type = $dynamik_font_type['author_box_title'];
	$author_box_title_font_size = dynamik_build_font_size( 'author_box_title' );
	$author_box_title_font_color = dynamik_get_design( 'author_box_title_font_color' );
	
	$author_box_font_type = $dynamik_font_type['author_box'];
	$author_box_font_size = dynamik_build_font_size( 'author_box' );
	$author_box_font_color = dynamik_get_design( 'author_box_font_color' );
	$author_box_link_color = dynamik_get_design( 'author_box_link_color' );
	$author_box_link_hover_color = dynamik_get_design( 'author_box_link_hover_color' );
	
	if( dynamik_get_design( 'author_box_link_underline' ) == 'On Hover' )
	{
		$author_box_link_underline_visited = 'none';
		$author_box_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'author_box_link_underline' ) == 'Off Hover' )
	{
		$author_box_link_underline_visited = 'underline';
		$author_box_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'author_box_link_underline' ) == 'Always' )
	{
		$author_box_link_underline_visited = 'underline';
		$author_box_link_underline_hover = 'underline';
	}
	else
	{
		$author_box_link_underline_visited = 'none';
		$author_box_link_underline_hover = 'none';
	}
	
	// Post-Nav fonts
	$post_nav_font_type = $dynamik_font_type['post_nav'];
	$post_nav_font_size = dynamik_build_font_size( 'post_nav' );
	$post_nav_link_color = dynamik_get_design( 'post_nav_link_color' );
	$post_nav_link_hover_color = dynamik_get_design( 'post_nav_link_hover_color' );
	
	if( dynamik_get_design( 'post_nav_link_underline' ) == 'On Hover' )
	{
		$post_nav_link_underline_visited = 'none';
		$post_nav_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'post_nav_link_underline' ) == 'Off Hover' )
	{
		$post_nav_link_underline_visited = 'underline';
		$post_nav_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'post_nav_link_underline' ) == 'Always' )
	{
		$post_nav_link_underline_visited = 'underline';
		$post_nav_link_underline_hover = 'underline';
	}
	else
	{
		$post_nav_link_underline_visited = 'none';
		$post_nav_link_underline_hover = 'none';
	}
	
	// Blockquote fonts
	$blockquote_font_type = $dynamik_font_type['blockquote'];
	$blockquote_font_size = dynamik_build_font_size( 'blockquote' );
	$blockquote_font_color = dynamik_get_design( 'blockquote_font_color' );
	$blockquote_link_color = dynamik_get_design( 'blockquote_link_color' );
	$blockquote_link_hover_color = dynamik_get_design( 'blockquote_link_hover_color' );
	
	if( dynamik_get_design( 'blockquote_link_underline' ) == 'On Hover' )
	{
		$blockquote_link_underline_visited = 'none';
		$blockquote_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'blockquote_link_underline' ) == 'Off Hover' )
	{
		$blockquote_link_underline_visited = 'underline';
		$blockquote_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'blockquote_link_underline' ) == 'Always' )
	{
		$blockquote_link_underline_visited = 'underline';
		$blockquote_link_underline_hover = 'underline';
	}
	else
	{
		$blockquote_link_underline_visited = 'none';
		$blockquote_link_underline_hover = 'none';
	}
	
	// Content Caption fonts
	$caption_font_type = $dynamik_font_type['caption'];
	$caption_font_size = dynamik_build_font_size( 'caption' );
	$caption_font_color = dynamik_get_design( 'caption_font_color' );
	
	// Post-Meta fonts
	$post_meta_font_type = $dynamik_font_type['post_meta'];
	$post_meta_font_size = dynamik_build_font_size( 'post_meta' );
	$post_meta_font_color = dynamik_get_design( 'post_meta_font_color' );
	$post_meta_link_color = dynamik_get_design( 'post_meta_link_color' );
	$post_meta_link_hover_color = dynamik_get_design( 'post_meta_link_hover_color' );
	
	if( dynamik_get_design( 'post_meta_link_underline' ) == 'On Hover' )
	{
		$post_meta_link_underline_visited = 'none';
		$post_meta_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'post_meta_link_underline' ) == 'Off Hover' )
	{
		$post_meta_link_underline_visited = 'underline';
		$post_meta_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'post_meta_link_underline' ) == 'Always' )
	{
		$post_meta_link_underline_visited = 'underline';
		$post_meta_link_underline_hover = 'underline';
	}
	else
	{
		$post_meta_link_underline_visited = 'none';
		$post_meta_link_underline_hover = 'none';
	}
	
	// EZ Widget Fonts
	$ez_widget_home_title_font_type = $dynamik_font_type['ez_widget_home_title'];
	$ez_widget_home_title_font_size = dynamik_build_font_size( 'ez_widget_home_title' );
	$ez_widget_home_title_font_color = dynamik_get_design( 'ez_widget_home_title_font_color' );
	
	$ez_widget_home_content_font_type = $dynamik_font_type['ez_widget_home_content'];
	$ez_widget_home_content_font_size = dynamik_build_font_size( 'ez_widget_home_content' );
	$ez_widget_home_content_font_color = dynamik_get_design( 'ez_widget_home_content_font_color' );
	$ez_widget_home_content_link_color = dynamik_get_design( 'ez_widget_home_content_link_color' );
	$ez_widget_home_content_link_hover_color = dynamik_get_design( 'ez_widget_home_content_link_hover_color' );
	
	if( dynamik_get_design( 'ez_widget_home_content_link_underline' ) == 'On Hover' )
	{
		$ez_widget_home_content_link_underline_visited = 'none';
		$ez_widget_home_content_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'ez_widget_home_content_link_underline' ) == 'Off Hover' )
	{
		$ez_widget_home_content_link_underline_visited = 'underline';
		$ez_widget_home_content_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'ez_widget_home_content_link_underline' ) == 'Always' )
	{
		$ez_widget_home_content_link_underline_visited = 'underline';
		$ez_widget_home_content_link_underline_hover = 'underline';
	}
	else
	{
		$ez_widget_home_content_link_underline_visited = 'none';
		$ez_widget_home_content_link_underline_hover = 'none';
	}
	
	$ez_widget_feature_title_font_type = $dynamik_font_type['ez_widget_feature_title'];
	$ez_widget_feature_title_font_size = dynamik_build_font_size( 'ez_widget_feature_title' );
	$ez_widget_feature_title_font_color = dynamik_get_design( 'ez_widget_feature_title_font_color' );
	
	$ez_widget_feature_content_font_type = $dynamik_font_type['ez_widget_feature_content'];
	$ez_widget_feature_content_font_size = dynamik_build_font_size( 'ez_widget_feature_content' );
	$ez_widget_feature_content_font_color = dynamik_get_design( 'ez_widget_feature_content_font_color' );
	$ez_widget_feature_content_link_color = dynamik_get_design( 'ez_widget_feature_content_link_color' );
	$ez_widget_feature_content_link_hover_color = dynamik_get_design( 'ez_widget_feature_content_link_hover_color' );
	
	if( dynamik_get_design( 'ez_widget_feature_content_link_underline' ) == 'On Hover' )
	{
		$ez_widget_feature_content_link_underline_visited = 'none';
		$ez_widget_feature_content_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'ez_widget_feature_content_link_underline' ) == 'Off Hover' )
	{
		$ez_widget_feature_content_link_underline_visited = 'underline';
		$ez_widget_feature_content_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'ez_widget_feature_content_link_underline' ) == 'Always' )
	{
		$ez_widget_feature_content_link_underline_visited = 'underline';
		$ez_widget_feature_content_link_underline_hover = 'underline';
	}
	else
	{
		$ez_widget_feature_content_link_underline_visited = 'none';
		$ez_widget_feature_content_link_underline_hover = 'none';
	}
	
	$ez_widget_footer_title_font_type = $dynamik_font_type['ez_widget_footer_title'];
	$ez_widget_footer_title_font_size = dynamik_build_font_size( 'ez_widget_footer_title' );
	$ez_widget_footer_title_font_color = dynamik_get_design( 'ez_widget_footer_title_font_color' );
	
	$ez_widget_footer_content_font_type = $dynamik_font_type['ez_widget_footer_content'];
	$ez_widget_footer_content_font_size = dynamik_build_font_size( 'ez_widget_footer_content' );
	$ez_widget_footer_content_font_color = dynamik_get_design( 'ez_widget_footer_content_font_color' );
	$ez_widget_footer_content_link_color = dynamik_get_design( 'ez_widget_footer_content_link_color' );
	$ez_widget_footer_content_link_hover_color = dynamik_get_design( 'ez_widget_footer_content_link_hover_color' );
	
	if( dynamik_get_design( 'ez_widget_footer_content_link_underline' ) == 'On Hover' )
	{
		$ez_widget_footer_content_link_underline_visited = 'none';
		$ez_widget_footer_content_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'ez_widget_footer_content_link_underline' ) == 'Off Hover' )
	{
		$ez_widget_footer_content_link_underline_visited = 'underline';
		$ez_widget_footer_content_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'ez_widget_footer_content_link_underline' ) == 'Always' )
	{
		$ez_widget_footer_content_link_underline_visited = 'underline';
		$ez_widget_footer_content_link_underline_hover = 'underline';
	}
	else
	{
		$ez_widget_footer_content_link_underline_visited = 'none';
		$ez_widget_footer_content_link_underline_hover = 'none';
	}
	
	// Dynamik Widget fonts
	$featured_widget_heading_font_type = $dynamik_font_type['featured_widget_heading'];
	$featured_widget_heading_font_size = dynamik_build_font_size( 'featured_widget_heading' );
	$featured_widget_heading_link_color = dynamik_get_design( 'featured_widget_heading_link_color' );
	$featured_widget_heading_link_hover_color = dynamik_get_design( 'featured_widget_heading_link_hover_color' );
	
	if( dynamik_get_design( 'featured_widget_heading_link_underline' ) == 'On Hover' )
	{
		$featured_widget_heading_link_underline_visited = 'none';
		$featured_widget_heading_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'featured_widget_heading_link_underline' ) == 'Off Hover' )
	{
		$featured_widget_heading_link_underline_visited = 'underline';
		$featured_widget_heading_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'featured_widget_heading_link_underline' ) == 'Always' )
	{
		$featured_widget_heading_link_underline_visited = 'underline';
		$featured_widget_heading_link_underline_hover = 'underline';
	}
	else
	{
		$featured_widget_heading_link_underline_visited = 'none';
		$featured_widget_heading_link_underline_hover = 'none';
	}
	
	$featured_widget_p_font_type = $dynamik_font_type['featured_widget_p'];
	$featured_widget_p_font_size = dynamik_build_font_size( 'featured_widget_p' );
	$featured_widget_p_font_color = dynamik_get_design( 'featured_widget_p_font_color' );
	$featured_widget_p_link_color = dynamik_get_design( 'featured_widget_p_link_color' );
	$featured_widget_p_link_hover_color = dynamik_get_design( 'featured_widget_p_link_hover_color' );
	
	if( dynamik_get_design( 'featured_widget_p_link_underline' ) == 'On Hover' )
	{
		$featured_widget_p_link_underline_visited = 'none';
		$featured_widget_p_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'featured_widget_p_link_underline' ) == 'Off Hover' )
	{
		$featured_widget_p_link_underline_visited = 'underline';
		$featured_widget_p_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'featured_widget_p_link_underline' ) == 'Always' )
	{
		$featured_widget_p_link_underline_visited = 'underline';
		$featured_widget_p_link_underline_hover = 'underline';
	}
	else
	{
		$featured_widget_p_link_underline_visited = 'none';
		$featured_widget_p_link_underline_hover = 'none';
	}
	
	$featured_widget_byline_font_type = $dynamik_font_type['featured_widget_byline'];
	$featured_widget_byline_font_size = dynamik_build_font_size( 'featured_widget_byline' );
	$featured_widget_byline_font_color = dynamik_get_design( 'featured_widget_byline_font_color' );
	$featured_widget_byline_link_color = dynamik_get_design( 'featured_widget_byline_link_color' );
	$featured_widget_byline_link_hover_color = dynamik_get_design( 'featured_widget_byline_link_hover_color' );
	
	if( dynamik_get_design( 'featured_widget_byline_link_underline' ) == 'On Hover' )
	{
		$featured_widget_byline_link_underline_visited = 'none';
		$featured_widget_byline_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'featured_widget_byline_link_underline' ) == 'Off Hover' )
	{
		$featured_widget_byline_link_underline_visited = 'underline';
		$featured_widget_byline_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'featured_widget_byline_link_underline' ) == 'Always' )
	{
		$featured_widget_byline_link_underline_visited = 'underline';
		$featured_widget_byline_link_underline_hover = 'underline';
	}
	else
	{
		$featured_widget_byline_link_underline_visited = 'none';
		$featured_widget_byline_link_underline_hover = 'none';
	}
	
	// Custom Widget Area fonts
	$dynamik_widget_title_font_type = $dynamik_font_type['dynamik_widget_title'];
	$dynamik_widget_title_font_size = dynamik_build_font_size( 'dynamik_widget_title' );
	$dynamik_widget_title_font_color = dynamik_get_design( 'dynamik_widget_title_font_color' );
	
	$dynamik_widget_content_font_type = $dynamik_font_type['dynamik_widget_content'];
	$dynamik_widget_content_font_size = dynamik_build_font_size( 'dynamik_widget_content' );
	$dynamik_widget_content_font_color = dynamik_get_design( 'dynamik_widget_content_font_color' );
	$dynamik_widget_content_link_color = dynamik_get_design( 'dynamik_widget_content_link_color' );
	$dynamik_widget_content_link_hover_color = dynamik_get_design( 'dynamik_widget_content_link_hover_color' );
	
	if( dynamik_get_design( 'dynamik_widget_content_link_underline' ) == 'On Hover' )
	{
		$dynamik_widget_content_link_underline_visited = 'none';
		$dynamik_widget_content_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'dynamik_widget_content_link_underline' ) == 'Off Hover' )
	{
		$dynamik_widget_content_link_underline_visited = 'underline';
		$dynamik_widget_content_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'dynamik_widget_content_link_underline' ) == 'Always' )
	{
		$dynamik_widget_content_link_underline_visited = 'underline';
		$dynamik_widget_content_link_underline_hover = 'underline';
	}
	else
	{
		$dynamik_widget_content_link_underline_visited = 'none';
		$dynamik_widget_content_link_underline_hover = 'none';
	}
	
	// Comment fonts
	$comment_heading_font_type = $dynamik_font_type['comment_heading'];
	$comment_heading_font_size = dynamik_build_font_size( 'comment_heading' );
	$comment_heading_font_color = dynamik_get_design( 'comment_heading_font_color' );
	$comment_heading_font_css = dynamik_get_design( 'comment_heading_font_css' );
	
	$comment_author_font_type = $dynamik_font_type['comment_author'];
	$comment_author_font_size = dynamik_build_font_size( 'comment_author' );
	$comment_author_font_color = dynamik_get_design( 'comment_author_font_color' );
	$comment_author_font_css = dynamik_get_design( 'comment_author_font_css' );

	$comment_author_link_color = dynamik_get_design( 'comment_author_link_color' );
	$comment_author_link_hover_color = dynamik_get_design( 'comment_author_link_hover_color' );
	
	if( dynamik_get_design( 'comment_author_link_underline' ) == 'On Hover' )
	{
		$comment_author_link_underline_visited = 'none';
		$comment_author_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'comment_author_link_underline' ) == 'Off Hover' )
	{
		$comment_author_link_underline_visited = 'underline';
		$comment_author_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'comment_author_link_underline' ) == 'Always' )
	{
		$comment_author_link_underline_visited = 'underline';
		$comment_author_link_underline_hover = 'underline';
	}
	else
	{
		$comment_author_link_underline_visited = 'none';
		$comment_author_link_underline_hover = 'none';
	}
	
	$comment_meta_font_type = $dynamik_font_type['comment_meta'];
	$comment_meta_font_size = dynamik_build_font_size( 'comment_meta' );
	$comment_meta_link_color = dynamik_get_design( 'comment_meta_link_color' );
	$comment_meta_link_hover_color = dynamik_get_design( 'comment_meta_link_hover_color' );
	$comment_meta_font_css = dynamik_get_design( 'comment_meta_font_css' );
	
	if( dynamik_get_design( 'comment_meta_link_underline' ) == 'On Hover' )
	{
		$comment_meta_link_underline_visited = 'none';
		$comment_meta_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'comment_meta_link_underline' ) == 'Off Hover' )
	{
		$comment_meta_link_underline_visited = 'underline';
		$comment_meta_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'comment_meta_link_underline' ) == 'Always' )
	{
		$comment_meta_link_underline_visited = 'underline';
		$comment_meta_link_underline_hover = 'underline';
	}
	else
	{
		$comment_meta_link_underline_visited = 'none';
		$comment_meta_link_underline_hover = 'none';
	}

	$comment_reply_text_font_type = $dynamik_font_type['comment_reply_text'];
	$comment_reply_text_font_size = dynamik_build_font_size( 'comment_reply_text' );
	$comment_reply_text_link_color = dynamik_get_design( 'comment_reply_text_link_color' );
	$comment_reply_text_link_hover_color = dynamik_get_design( 'comment_reply_text_link_hover_color' );
	$comment_reply_text_font_css = dynamik_get_design( 'comment_reply_text_font_css' );
	
	if( dynamik_get_design( 'comment_reply_text_link_underline' ) == 'On Hover' )
	{
		$comment_reply_text_link_underline_visited = 'none';
		$comment_reply_text_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'comment_reply_text_link_underline' ) == 'Off Hover' )
	{
		$comment_reply_text_link_underline_visited = 'underline';
		$comment_reply_text_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'comment_reply_text_link_underline' ) == 'Always' )
	{
		$comment_reply_text_link_underline_visited = 'underline';
		$comment_reply_text_link_underline_hover = 'underline';
	}
	else
	{
		$comment_reply_text_link_underline_visited = 'none';
		$comment_reply_text_link_underline_hover = 'none';
	}
	
	$comment_body_font_type = $dynamik_font_type['comment_body'];
	$comment_body_font_size = dynamik_build_font_size( 'comment_body' );
	$comment_body_font_color = dynamik_get_design( 'comment_body_font_color' );
	$comment_body_font_css = dynamik_get_design( 'comment_body_font_css' );
	
	$comment_form_font_type = $dynamik_font_type['comment_form'];
	$comment_form_font_size = dynamik_build_font_size( 'comment_form' );
	$comment_form_font_color = dynamik_get_design( 'comment_form_font_color' );
	$comment_form_font_css = dynamik_get_design( 'comment_form_font_css' );
	
	$comment_link_color = dynamik_get_design( 'comment_link_color' );
	$comment_link_hover_color = dynamik_get_design( 'comment_link_hover_color' );
	
	if( dynamik_get_design( 'comment_link_underline' ) == 'On Hover' )
	{
		$comment_link_underline_visited = 'none';
		$comment_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'comment_link_underline' ) == 'Off Hover' )
	{
		$comment_link_underline_visited = 'underline';
		$comment_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'comment_link_underline' ) == 'Always' )
	{
		$comment_link_underline_visited = 'underline';
		$comment_link_underline_hover = 'underline';
	}
	else
	{
		$comment_link_underline_visited = 'none';
		$comment_link_underline_hover = 'none';
	}
	
	$comment_submit_font_type = $dynamik_font_type['comment_submit'];
	$comment_submit_font_size = dynamik_build_font_size( 'comment_submit' );
	$comment_submit_font_color = dynamik_get_design( 'comment_submit_font_color' );
	$comment_submit_font_css = dynamik_get_design( 'comment_submit_font_css' );

	$comment_submit_text_hover_color = dynamik_get_design( 'comment_submit_text_hover_color' );
	
	if( dynamik_get_design( 'comment_submit_text_hover_underline' ) == 'On Hover' )
	{
		$comment_submit_link_underline_visited = 'none';
		$comment_submit_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'comment_submit_text_hover_underline' ) == 'Off Hover' )
	{
		$comment_submit_link_underline_visited = 'underline';
		$comment_submit_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'comment_submit_text_hover_underline' ) == 'Always' )
	{
		$comment_submit_link_underline_visited = 'underline';
		$comment_submit_link_underline_hover = 'underline';
	}
	else
	{
		$comment_submit_link_underline_visited = 'none';
		$comment_submit_link_underline_hover = 'none';
	}

	$comment_form_allowed_tags_font_type = $dynamik_font_type['comment_form_allowed_tags'];
	$comment_form_allowed_tags_font_size = dynamik_build_font_size( 'comment_form_allowed_tags' );
	$comment_form_allowed_tags_font_color = dynamik_get_design( 'comment_form_allowed_tags_font_color' );
	$comment_form_allowed_tags_font_css = dynamik_get_design( 'comment_form_allowed_tags_font_css' );
	
	// Footer fonts
	$footer_font_type = $dynamik_font_type['footer'];
	$footer_font_size = dynamik_build_font_size( 'footer' );
	$footer_font_color = dynamik_get_design( 'footer_font_color' );
	$footer_link_color = dynamik_get_design( 'footer_link_color' );
	$footer_link_hover_color = dynamik_get_design( 'footer_link_hover_color' );
	
	if( dynamik_get_design( 'footer_link_underline' ) == 'On Hover' )
	{
		$footer_link_underline_visited = 'none';
		$footer_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'footer_link_underline' ) == 'Off Hover' )
	{
		$footer_link_underline_visited = 'underline';
		$footer_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'footer_link_underline' ) == 'Always' )
	{
		$footer_link_underline_visited = 'underline';
		$footer_link_underline_hover = 'underline';
	}
	else
	{
		$footer_link_underline_visited = 'none';
		$footer_link_underline_hover = 'none';
	}

	$footer_p_text_align = dynamik_get_settings( 'html_five_active' ) ? 'text-align: center;' : '';
	
	// Search Form fonts
	$search_form_font_type = $dynamik_font_type['search_form'];
	$search_form_font_size = dynamik_build_font_size( 'search_form' );
	$search_form_font_color = dynamik_get_design( 'search_form_font_color' );
	
	$search_button_font_type = $dynamik_font_type['search_button'];
	$search_button_font_size = dynamik_build_font_size( 'search_button' );
	$search_button_font_color = dynamik_get_design( 'search_button_font_color' );
	
	$search_button_text_hover_color = dynamik_get_design( 'search_button_text_hover_color' );
	
	if( dynamik_get_design( 'search_button_text_hover_underline' ) == 'On Hover' )
	{
		$search_button_link_underline_visited = 'none';
		$search_button_link_underline_hover = 'underline';
	}
	elseif( dynamik_get_design( 'search_button_text_hover_underline' ) == 'Off Hover' )
	{
		$search_button_link_underline_visited = 'underline';
		$search_button_link_underline_hover = 'none';
	}
	elseif( dynamik_get_design( 'search_button_text_hover_underline' ) == 'Always' )
	{
		$search_button_link_underline_visited = 'underline';
		$search_button_link_underline_hover = 'underline';
	}
	else
	{
		$search_button_link_underline_visited = 'none';
		$search_button_link_underline_hover = 'none';
	}

	$search_form_input_placeholder = '';
	
	if( dynamik_get_settings( 'html_five_active' ) )
	{
		$search_form_input_placeholder = '
::-webkit-input-placeholder {
	color: #' . $search_form_font_color . ';
}
';
	}
		
	/****************************************
			Define Misc Styles
	****************************************/
	
	$default_images = $child == 'no' ? 'default-images' : 'images';
	
	// Nav dimensions
	$nav1_page_top_border_thickness = dynamik_get_design( 'nav1_page_top_border_thickness' );
	$nav1_page_bottom_border_thickness = dynamik_get_design( 'nav1_page_bottom_border_thickness' );
	$nav1_page_left_border_thickness = dynamik_get_design( 'nav1_page_left_border_thickness' );
	$nav1_page_right_border_thickness = dynamik_get_design( 'nav1_page_right_border_thickness' );
	
	$nav1_extras_text_padding_top = dynamik_get_design( 'nav1_extras_text_padding_top' );
	$nav1_extras_text_padding_right = dynamik_get_design( 'nav1_extras_text_padding_right' );
	$nav1_extras_search_padding_top = dynamik_get_design( 'nav1_extras_search_padding_top' );
	$nav1_extras_search_padding_right = dynamik_get_design( 'nav1_extras_search_padding_right' );
	
	$nav1_submenu_width = dynamik_get_design( 'nav1_submenu_width' );
	$nav1_submenu_tb_padding = dynamik_get_design( 'nav1_submenu_tb_padding' );
	$nav1_submenu_lr_padding = dynamik_get_design( 'nav1_submenu_lr_padding' );
	
	$nav1_wrap_top_margin = dynamik_get_design( 'nav1_wrap_top_margin' );
	$nav1_wrap_bottom_margin = dynamik_get_design( 'nav1_wrap_bottom_margin' );
	
	$nav1_page_left_margin = dynamik_get_design( 'nav1_page_left_margin' );
	$nav1_page_right_margin = dynamik_get_design( 'nav1_page_right_margin' );
	$nav1_page_tb_padding = dynamik_get_design( 'nav1_page_tb_padding' );
	$nav1_page_lr_padding = dynamik_get_design( 'nav1_page_lr_padding' );

	$nav1_sf_right_padding = dynamik_get_design( 'nav1_sub_indicator_type' ) == 'None' ? $nav1_page_lr_padding : $nav1_page_lr_padding + 10;
	
	$nav1_page_tb_border_thickness_combined = $nav1_page_top_border_thickness + $nav1_page_bottom_border_thickness;
	$nav1_page_tb_padding_combined = $nav1_page_tb_padding * 2;
	$nav1_submenu_lr_padding_combined = $nav1_submenu_lr_padding * 2;
	$nav1_submenu_tb_padding_combined = $nav1_submenu_tb_padding * 2;
	
	$nav1_submenu_width_plus = $nav1_submenu_width + $nav1_submenu_lr_padding_combined + $nav1_page_left_margin + 5;

	$nav1_liulul_left_margin = $nav1_submenu_width + $nav1_submenu_lr_padding_combined + 1;
	$nav1_liulul_top_margin = ($nav1_font_size_px + $nav1_submenu_tb_padding_combined + 1) * -1;
	
	$nav1_sub_indicator_type = dynamik_get_design( 'nav1_sub_indicator_type' );
	$nav1_sub_indicator_image = dynamik_get_design( 'nav1_sub_indicator_image' );
	$nav1_sub_indicator_width = dynamik_get_design( 'nav1_sub_indicator_width' );
	$nav1_sub_indicator_height = dynamik_get_design( 'nav1_sub_indicator_height' );
	$nav1_sub_indicator_top = dynamik_get_design( 'nav1_sub_indicator_top' );
	$nav1_sub_indicator_right = dynamik_get_design( 'nav1_sub_indicator_right' );
	
	if( $nav1_sub_indicator_type == 'Image' && $nav1_sub_indicator_image == '' )
	{
		$nav1_sub_indicator_image_path = $default_images . '/icon-plus.png';
	}
	else
	{
		$nav1_sub_indicator_image_path = 'images/' . $nav1_sub_indicator_image;
	}
	
	if( !dynamik_get_settings( 'html_five_active' ) )
	{
		if( $nav1_sub_indicator_type == 'Text' )
		{
			$nav1_sub_indicator_styles = '.menu-primary li a .sf-sub-indicator {
	top: ' . $nav1_page_tb_padding . 'px;
	right: ' . $nav1_page_lr_padding . 'px;
	position: absolute;
	float: right;
	display: block;
	overflow: hidden;
}

.menu-primary li li a .sf-sub-indicator {
	top: ' . $nav1_submenu_tb_padding . 'px;
	right: ' . $nav1_submenu_lr_padding . 'px;
}';
		}
		elseif( $nav1_sub_indicator_type == 'Image' )
		{
			$nav1_sub_indicator_styles = '.menu-primary li a .sf-sub-indicator,
.menu-primary li li a .sf-sub-indicator,
.menu-primary li li li a .sf-sub-indicator {
	background: url(' . $nav1_sub_indicator_image_path . ') no-repeat;
	background-size: ' . $nav1_sub_indicator_width . 'px ' . $nav1_sub_indicator_height . 'px;
	width: ' . $nav1_sub_indicator_width . 'px;
	height: ' . $nav1_sub_indicator_height . 'px;
	top: ' . $nav1_sub_indicator_top . 'px;
	right: ' . $nav1_sub_indicator_right . 'px;
	position: absolute;
	text-indent: -9999px;
}';
		}
		else
		{
			$nav1_sub_indicator_styles = '.menu-primary li a .sf-sub-indicator,
.menu-primary li li a .sf-sub-indicator,
.menu-primary li li li a .sf-sub-indicator {
	text-indent: -9999px;
}';
		}	
	}
	else
	{
		if( $nav1_sub_indicator_type == 'Text' )
		{
			$nav1_sub_indicator_styles = '.menu-primary.sf-arrows .sf-with-ul:after {
	top: ' . $nav1_page_tb_padding . 'px;
	right: ' . $nav1_page_lr_padding . 'px;
	position: absolute;
	float: right;
	display: block;
	overflow: hidden;
	content: \'\bb\';
}

.menu-primary.sf-arrows li li .sf-with-ul:after {
	top: ' . $nav1_submenu_tb_padding . 'px;
	right: ' . $nav1_submenu_lr_padding . 'px;
}';
		}
		elseif( $nav1_sub_indicator_type == 'Image' )
		{
			$nav1_sub_indicator_styles = '.menu-primary.sf-arrows .sf-with-ul:after {
	background: url(' . $nav1_sub_indicator_image_path . ') no-repeat;
	background-size: ' . $nav1_sub_indicator_width . 'px ' . $nav1_sub_indicator_height . 'px;
	width: ' . $nav1_sub_indicator_width . 'px;
	height: ' . $nav1_sub_indicator_height . 'px;
	top: ' . $nav1_sub_indicator_top . 'px;
	right: ' . $nav1_sub_indicator_right . 'px;
	position: absolute;
	content: \'\';
}';
		}
		else
		{
			$nav1_sub_indicator_styles = '.menu-primary.sf-arrows .sf-with-ul:after {
	content: \'\';
}';
		}
	}
	
	// Subnav dimensions
	$nav2_page_top_border_thickness = dynamik_get_design( 'nav2_page_top_border_thickness' );
	$nav2_page_bottom_border_thickness = dynamik_get_design( 'nav2_page_bottom_border_thickness' );
	$nav2_page_left_border_thickness = dynamik_get_design( 'nav2_page_left_border_thickness' );
	$nav2_page_right_border_thickness = dynamik_get_design( 'nav2_page_right_border_thickness' );
	
	$nav2_submenu_width = dynamik_get_design( 'nav2_submenu_width' );
	$nav2_submenu_tb_padding = dynamik_get_design( 'nav2_submenu_tb_padding' );
	$nav2_submenu_lr_padding = dynamik_get_design( 'nav2_submenu_lr_padding' );
	
	$nav2_wrap_top_margin = dynamik_get_design( 'nav2_wrap_top_margin' );
	$nav2_wrap_bottom_margin = dynamik_get_design( 'nav2_wrap_bottom_margin' );
	
	$nav2_page_left_margin = dynamik_get_design( 'nav2_page_left_margin' );
	$nav2_page_right_margin = dynamik_get_design( 'nav2_page_right_margin' );
	$nav2_page_tb_padding = dynamik_get_design( 'nav2_page_tb_padding' );
	$nav2_page_lr_padding = dynamik_get_design( 'nav2_page_lr_padding' );
	
	$nav2_sf_right_padding = dynamik_get_design( 'nav2_sub_indicator_type' ) == 'None' ? $nav2_page_lr_padding : $nav2_page_lr_padding + 10;
	
	$nav2_page_tb_border_thickness_combined = $nav2_page_top_border_thickness + $nav2_page_bottom_border_thickness;
	$nav2_page_tb_padding_combined = $nav2_page_tb_padding * 2;
	$nav2_submenu_lr_padding_combined = $nav2_submenu_lr_padding * 2;
	$nav2_submenu_tb_padding_combined = $nav2_submenu_tb_padding * 2;
	
	$nav2_submenu_width_plus = $nav2_submenu_width + $nav2_submenu_lr_padding_combined + $nav2_page_left_margin + 5;

	$nav2_liulul_left_margin = $nav2_submenu_width + $nav2_submenu_lr_padding_combined + 1;
	$nav2_liulul_top_margin = ($nav2_font_size_px + $nav2_submenu_tb_padding_combined + 1) * -1;
	
	$nav2_sub_indicator_type = dynamik_get_design( 'nav2_sub_indicator_type' );
	$nav2_sub_indicator_image = dynamik_get_design( 'nav2_sub_indicator_image' );
	$nav2_sub_indicator_width = dynamik_get_design( 'nav2_sub_indicator_width' );
	$nav2_sub_indicator_height = dynamik_get_design( 'nav2_sub_indicator_height' );
	$nav2_sub_indicator_top = dynamik_get_design( 'nav2_sub_indicator_top' );
	$nav2_sub_indicator_right = dynamik_get_design( 'nav2_sub_indicator_right' );
	
	if( $nav2_sub_indicator_type == 'Image' && $nav2_sub_indicator_image == '' )
	{
		$nav2_sub_indicator_image_path = $default_images . '/icon-plus.png';
	}
	else
	{
		$nav2_sub_indicator_image_path = 'images/' . $nav2_sub_indicator_image;
	}
	
	if( !dynamik_get_settings( 'html_five_active' ) )
	{
		if( $nav2_sub_indicator_type == 'Text' )
		{
			$nav2_sub_indicator_styles = '.menu-secondary li a .sf-sub-indicator {
	top: ' . $nav2_page_tb_padding . 'px;
	right: ' . $nav2_page_lr_padding . 'px;
	position: absolute;
	float: right;
	display: block;
	overflow: hidden;
}

.menu-secondary li li a .sf-sub-indicator {
	top: ' . $nav2_submenu_tb_padding . 'px;
	right: ' . $nav2_submenu_lr_padding . 'px;
}';
		}
		elseif( $nav2_sub_indicator_type == 'Image' )
		{
			$nav2_sub_indicator_styles = '.menu-secondary li a .sf-sub-indicator,
.menu-secondary li li a .sf-sub-indicator,
.menu-secondary li li li a .sf-sub-indicator {
	background: url(' . $nav2_sub_indicator_image_path . ') no-repeat;
	background-size: ' . $nav2_sub_indicator_width . 'px ' . $nav2_sub_indicator_height . 'px;
	width: ' . $nav2_sub_indicator_width . 'px;
	height: ' . $nav2_sub_indicator_height . 'px;
	top: ' . $nav2_sub_indicator_top . 'px;
	right: ' . $nav2_sub_indicator_right . 'px;
	position: absolute;
	text-indent: -9999px;
}';
		}
		else
		{
			$nav2_sub_indicator_styles = '.menu-secondary li a .sf-sub-indicator,
.menu-secondary li li a .sf-sub-indicator,
.menu-secondary li li li a .sf-sub-indicator {
	text-indent: -9999px;
}';
		}
	}
	else
	{
		if( $nav2_sub_indicator_type == 'Text' )
		{
			$nav2_sub_indicator_styles = '.menu-secondary.sf-arrows .sf-with-ul:after {
	top: ' . $nav2_page_tb_padding . 'px;
	right: ' . $nav2_page_lr_padding . 'px;
	position: absolute;
	float: right;
	display: block;
	overflow: hidden;
	content: \'\bb\';
}

.menu-secondary.sf-arrows li li .sf-with-ul:after {
	top: ' . $nav2_submenu_tb_padding . 'px;
	right: ' . $nav2_submenu_lr_padding . 'px;
}';
		}
		elseif( $nav2_sub_indicator_type == 'Image' )
		{
			$nav2_sub_indicator_styles = '.menu-secondary.sf-arrows .sf-with-ul:after {
	background: url(' . $nav2_sub_indicator_image_path . ') no-repeat;
	background-size: ' . $nav2_sub_indicator_width . 'px ' . $nav2_sub_indicator_height . 'px;
	width: ' . $nav2_sub_indicator_width . 'px;
	height: ' . $nav2_sub_indicator_height . 'px;
	top: ' . $nav2_sub_indicator_top . 'px;
	right: ' . $nav2_sub_indicator_right . 'px;
	position: absolute;
	content: \'\';
}';
		}
		else
		{
			$nav2_sub_indicator_styles = '.menu-secondary.sf-arrows .sf-with-ul:after {
	content: \'\';
}';
		}
	}
	
	// Header Nav dimensions
	$nav3_page_top_border_thickness = dynamik_get_design( 'nav3_page_top_border_thickness' );
	$nav3_page_bottom_border_thickness = dynamik_get_design( 'nav3_page_bottom_border_thickness' );
	$nav3_page_left_border_thickness = dynamik_get_design( 'nav3_page_left_border_thickness' );
	$nav3_page_right_border_thickness = dynamik_get_design( 'nav3_page_right_border_thickness' );
	
	$nav3_submenu_width = dynamik_get_design( 'nav3_submenu_width' );
	$nav3_submenu_tb_padding = dynamik_get_design( 'nav3_submenu_tb_padding' );
	$nav3_submenu_lr_padding = dynamik_get_design( 'nav3_submenu_lr_padding' );
	
	$nav3_wrap_top_margin = dynamik_get_design( 'nav3_wrap_top_margin' );
	$nav3_wrap_bottom_margin = dynamik_get_design( 'nav3_wrap_bottom_margin' );
	
	$nav3_page_left_margin = dynamik_get_design( 'nav3_page_left_margin' );
	$nav3_page_right_margin = dynamik_get_design( 'nav3_page_right_margin' );
	$nav3_page_tb_padding = dynamik_get_design( 'nav3_page_tb_padding' );
	$nav3_page_lr_padding = dynamik_get_design( 'nav3_page_lr_padding' );
	
	$nav3_sf_right_padding = dynamik_get_design( 'nav3_sub_indicator_type' ) == 'None' ? $nav3_page_lr_padding : $nav3_page_lr_padding + 10;
	
	$nav3_page_tb_border_thickness_combined = $nav3_page_top_border_thickness + $nav3_page_bottom_border_thickness;
	$nav3_page_tb_padding_combined = $nav3_page_tb_padding * 2;
	$nav3_submenu_lr_padding_combined = $nav3_submenu_lr_padding * 2;
	$nav3_submenu_tb_padding_combined = $nav3_submenu_tb_padding * 2;
	
	$nav3_submenu_width_plus = $nav3_submenu_width + $nav3_submenu_lr_padding_combined + $nav3_page_left_margin + 5;

	$nav3_liulul_left_margin = $nav3_submenu_width + $nav3_submenu_lr_padding_combined + 1;
	$nav3_liulul_top_margin = ($nav3_font_size_px + $nav3_submenu_tb_padding_combined + 1) * -1;
	
	$nav3_sub_indicator_type = dynamik_get_design( 'nav3_sub_indicator_type' );
	$nav3_sub_indicator_image = dynamik_get_design( 'nav3_sub_indicator_image' );
	$nav3_sub_indicator_width = dynamik_get_design( 'nav3_sub_indicator_width' );
	$nav3_sub_indicator_height = dynamik_get_design( 'nav3_sub_indicator_height' );
	$nav3_sub_indicator_top = dynamik_get_design( 'nav3_sub_indicator_top' );
	$nav3_sub_indicator_right = dynamik_get_design( 'nav3_sub_indicator_right' );
	
	if( $nav3_sub_indicator_type == 'Image' && $nav3_sub_indicator_image == '' )
	{
		$nav3_sub_indicator_image_path = $default_images . '/icon-plus.png';
	}
	else
	{
		$nav3_sub_indicator_image_path = 'images/' . $nav3_sub_indicator_image;
	}
	
	if( !dynamik_get_settings( 'html_five_active' ) )
	{
		if( $nav3_sub_indicator_type == 'Text' )
		{
			$nav3_sub_indicator_styles = dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li a .sf-sub-indicator {
	top: ' . $nav3_page_tb_padding . 'px;
	right: ' . $nav3_page_lr_padding . 'px;
	position: absolute;
	float: right;
	display: block;
	overflow: hidden;
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a .sf-sub-indicator {
	top: ' . $nav3_submenu_tb_padding . 'px;
	right: ' . $nav3_submenu_lr_padding . 'px;
}';
		}
		elseif( $nav3_sub_indicator_type == 'Image' )
		{
			$nav3_sub_indicator_styles = dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li a .sf-sub-indicator,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a .sf-sub-indicator,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li li a .sf-sub-indicator {
	background: url(' . $nav3_sub_indicator_image_path . ') no-repeat;
	background-size: ' . $nav3_sub_indicator_width . 'px ' . $nav3_sub_indicator_height . 'px;
	width: ' . $nav3_sub_indicator_width . 'px;
	height: ' . $nav3_sub_indicator_height . 'px;
	top: ' . $nav3_sub_indicator_top . 'px;
	right: ' . $nav3_sub_indicator_right . 'px;
	position: absolute;
	text-indent: -9999px;
}';
		}
		else
		{
			$nav3_sub_indicator_styles = dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li a .sf-sub-indicator,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a .sf-sub-indicator,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li li a .sf-sub-indicator {
	text-indent: -9999px;
}';
		}
	}
	else
	{
		if( $nav3_sub_indicator_type == 'Text' )
		{
			$nav3_sub_indicator_styles = dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu.sf-arrows .sf-with-ul:after {
	top: ' . $nav3_page_tb_padding . 'px;
	right: ' . $nav3_page_lr_padding . 'px;
	position: absolute;
	float: right;
	display: block;
	overflow: hidden;
	content: \'\bb\';
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a .sf-sub-indicator {
	top: ' . $nav3_submenu_tb_padding . 'px;
	right: ' . $nav3_submenu_lr_padding . 'px;
}';
		}
		elseif( $nav3_sub_indicator_type == 'Image' )
		{
			$nav3_sub_indicator_styles = dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu.sf-arrows .sf-with-ul:after,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a .sf-sub-indicator,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li li a .sf-sub-indicator {
	background: url(' . $nav3_sub_indicator_image_path . ') no-repeat;
	background-size: ' . $nav3_sub_indicator_width . 'px ' . $nav3_sub_indicator_height . 'px;
	width: ' . $nav3_sub_indicator_width . 'px;
	height: ' . $nav3_sub_indicator_height . 'px;
	top: ' . $nav3_sub_indicator_top . 'px;
	right: ' . $nav3_sub_indicator_right . 'px;
	position: absolute;
	content: \'\';
}';
		}
		else
		{
			$nav3_sub_indicator_styles = dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu.sf-arrows .sf-with-ul:after,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a .sf-sub-indicator,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li li a .sf-sub-indicator {
	content: \'\';
}';
		}
	}

	if( dynamik_get_settings( 'responsive_enabled' ) )
	{
		$content_sidebar_sidebar_site_container_min_width = '';
		$sidebar_sidebar_content_site_container_min_width = '';
		$sidebar_content_sidebar_site_container_min_width = '';
		$content_sidebar_site_container_min_width = '';
		$sidebar_content_site_container_min_width = '';
		$full_width_content_site_container_min_width = '';
	}
	else
	{
		$content_sidebar_sidebar_site_container_min_width = "\n\t" . 'min-width: ' . $wrap_width_dbl_rt_sb . 'px;';
		$sidebar_sidebar_content_site_container_min_width = "\n\t" . 'min-width: ' . $wrap_width_dbl_lft_sb . 'px;';
		$sidebar_content_sidebar_site_container_min_width = "\n\t" . 'min-width: ' . $wrap_width_dbl_sb . 'px;';
		$content_sidebar_site_container_min_width = "\n\t" . 'min-width: ' . $wrap_width_rt_sb . 'px;';
		$sidebar_content_site_container_min_width = "\n\t" . 'min-width: ' . $wrap_width_lft_sb . 'px;';
		$full_width_content_site_container_min_width = "\n\t" . 'min-width: ' . $wrap_width_no_sb . 'px;';
	}
	
	// #wrap/.site-container Styles
	$wrap_structure = dynamik_get_design( 'wrap_structure' );

	$wrap_styles = dynamik_html_markup( 'site_container' ) . ' {
	' . $wrap_bg . '
	border-top: ' . $wrap_tb_border_thickness . 'px ' . $wrap_border_style . ' #' . $wrap_border_color . ';
	border-bottom: ' . $wrap_tb_border_thickness . 'px ' . $wrap_border_style . ' #' . $wrap_border_color . ';
	border-left: ' . $wrap_lr_border_thickness . 'px ' . $wrap_border_style . ' #' . $wrap_border_color . ';
	border-right: ' . $wrap_lr_border_thickness . 'px ' . $wrap_border_style . ' #' . $wrap_border_color . ';
	margin: ' . $wrap_top_margin . 'px auto ' . $wrap_bottom_margin . 'px;
	padding: ' . $wrap_tb_padding . 'px ' . $wrap_lr_padding . 'px ' . $wrap_tb_padding . 'px ' . $wrap_lr_padding . 'px;
	clear: both;
	' . $wrap_box_shadow . '
	' . $wrap_border_radius . '
}';
	
	if( $wrap_structure == 'fluid' )
	{
		$wrap_styles .= '

.content-sidebar-sidebar ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': 100%;' . $content_sidebar_sidebar_site_container_min_width . '
}

.sidebar-sidebar-content ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': 100%;' . $sidebar_sidebar_content_site_container_min_width . '
}

.sidebar-content-sidebar ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': 100%;' . $sidebar_content_sidebar_site_container_min_width . '
}

.content-sidebar ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': 100%;' . $content_sidebar_site_container_min_width . '
}

.sidebar-content ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': 100%;' . $sidebar_content_site_container_min_width . '
}

.full-width-content ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': 100%;' . $full_width_content_site_container_min_width . '
}';
	}
	else
	{
		$wrap_styles .= '

.content-sidebar-sidebar ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': ' . $wrap_width_dbl_rt_sb . 'px;
}

.sidebar-sidebar-content ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': ' . $wrap_width_dbl_lft_sb . 'px;
}

.sidebar-content-sidebar ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': ' . $wrap_width_dbl_sb . 'px;
}

.content-sidebar ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': ' . $wrap_width_rt_sb . 'px;
}

.sidebar-content ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': ' . $wrap_width_lft_sb . 'px;
}

.full-width-content ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': ' . $wrap_width_no_sb . 'px;
}';
	}
	
	if( dynamik_get_design( 'fixed_header' ) != 'disabled' )
	{
		$fixed_header_styles = '
	
.dynamik-fixed-header.dynamik-scrolled ' . dynamik_html_markup( 'site_header' ) . ' {
	width: 100%;
	position: fixed;
	top: 0;
	left: 0;
	z-index: 9999;
}

.admin-bar.dynamik-fixed-header.dynamik-scrolled ' . dynamik_html_markup( 'site_header' ) . ' {
	top: 32px;
}';		
	}
	else
	{
		$fixed_header_styles = '';
	}
	
	// Create custom font styles	
	$body_font_css = '';
	if( dynamik_get_design( 'body_font_css' ) )
	{
		$body_font_css = "\n\t" . dynamik_get_design( 'body_font_css' );
	}
	
	$title_font_css = '';
	if( dynamik_get_design( 'title_font_css' ) )
	{
		$title_font_css = "\n\t" . dynamik_get_design( 'title_font_css' );
	}
	
	$tagline_font_css = '';
	if( dynamik_get_design( 'tagline_font_css' ) )
	{
		$tagline_font_css = "\n\t" . dynamik_get_design( 'tagline_font_css' );
	}
	
	$nav1_font_css = '';
	if( dynamik_get_design( 'nav1_font_css' ) )
	{
		$nav1_font_css = "\n\t" . dynamik_get_design( 'nav1_font_css' );
	}
	
	$nav1_extras_font_css = '';
	if( dynamik_get_design( 'nav1_extras_font_css' ) )
	{
		$nav1_extras_font_css = "\n\t" . dynamik_get_design( 'nav1_extras_font_css' );
	}
	
	$nav2_font_css = '';
	if( dynamik_get_design( 'nav2_font_css' ) )
	{
		$nav2_font_css = "\n\t" . dynamik_get_design( 'nav2_font_css' );
	}
	
	$nav3_font_css = '';
	if( dynamik_get_design( 'nav3_font_css' ) )
	{
		$nav3_font_css = "\n\t" . dynamik_get_design( 'nav3_font_css' );
	}
	
	$content_heading_font_css = '';
	if( dynamik_get_design( 'content_heading_font_css' ) )
	{
		$content_heading_font_css = "\n\t" . dynamik_get_design( 'content_heading_font_css' );
	}
	
	$content_byline_font_css = '';
	if( dynamik_get_design( 'content_byline_font_css' ) )
	{
		$content_byline_font_css = "\n\t" . dynamik_get_design( 'content_byline_font_css' );
	}
	
	$content_p_font_css = '';
	if( dynamik_get_design( 'content_p_font_css' ) )
	{
		$content_p_font_css = "\n\t" . dynamik_get_design( 'content_p_font_css' );
	}
	
	$breadcrumbs_font_css = '';
	if( dynamik_get_design( 'breadcrumbs_font_css' ) )
	{
		$breadcrumbs_font_css = "\n\t" . dynamik_get_design( 'breadcrumbs_font_css' );
	}
	
	$taxonomy_box_heading_font_css = '';
	if( dynamik_get_design( 'taxonomy_box_heading_font_css' ) )
	{
		$taxonomy_box_heading_font_css = "\n\t" . dynamik_get_design( 'taxonomy_box_heading_font_css' );
	}
	
	$taxonomy_box_content_font_css = '';
	if( dynamik_get_design( 'taxonomy_box_content_font_css' ) )
	{
		$taxonomy_box_content_font_css = "\n\t" . dynamik_get_design( 'taxonomy_box_content_font_css' );
	}
	
	$author_box_title_font_css = '';
	if( dynamik_get_design( 'author_box_title_font_css' ) )
	{
		$author_box_title_font_css = "\n\t" . dynamik_get_design( 'author_box_title_font_css' );
	}
	
	$author_box_font_css = '';
	if( dynamik_get_design( 'author_box_font_css' ) )
	{
		$author_box_font_css = "\n\t" . dynamik_get_design( 'author_box_font_css' );
	}
	
	$post_nav_font_css = '';
	if( dynamik_get_design( 'post_nav_font_css' ) )
	{
		$post_nav_font_css = "\n\t" . dynamik_get_design( 'post_nav_font_css' );
	}
	
	$blockquote_font_css = '';
	if( dynamik_get_design( 'blockquote_font_css' ) )
	{
		$blockquote_font_css = "\n\t" . dynamik_get_design( 'blockquote_font_css' );
	}
	
	$caption_font_css = '';
	if( dynamik_get_design( 'caption_font_css' ) )
	{
		$caption_font_css = "\n\t" . dynamik_get_design( 'caption_font_css' );
	}
	
	$post_meta_font_css = '';
	if( dynamik_get_design( 'post_meta_font_css' ) )
	{
		$post_meta_font_css = "\n\t" . dynamik_get_design( 'post_meta_font_css' );
	}
	
	$ez_widget_home_title_font_css = '';
	if( dynamik_get_design( 'ez_widget_home_title_font_css' ) )
	{
		$ez_widget_home_title_font_css = "\n\t" . dynamik_get_design( 'ez_widget_home_title_font_css' );
	}
	
	$ez_widget_home_content_font_css = '';
	if( dynamik_get_design( 'ez_widget_home_content_font_css' ) )
	{
		$ez_widget_home_content_font_css = "\n\t" . dynamik_get_design( 'ez_widget_home_content_font_css' );
	}
	
	$ez_widget_feature_title_font_css = '';
	if( dynamik_get_design( 'ez_widget_feature_title_font_css' ) )
	{
		$ez_widget_feature_title_font_css = "\n\t" . dynamik_get_design( 'ez_widget_feature_title_font_css' );
	}
	
	$ez_widget_feature_content_font_css = '';
	if( dynamik_get_design( 'ez_widget_feature_content_font_css' ) )
	{
		$ez_widget_feature_content_font_css = "\n\t" . dynamik_get_design( 'ez_widget_feature_content_font_css' );
	}
	
	$ez_widget_footer_title_font_css = '';
	if( dynamik_get_design( 'ez_widget_footer_title_font_css' ) )
	{
		$ez_widget_footer_title_font_css = "\n\t" . dynamik_get_design( 'ez_widget_footer_title_font_css' );
	}
	
	$ez_widget_footer_content_font_css = '';
	if( dynamik_get_design( 'ez_widget_footer_content_font_css' ) )
	{
		$ez_widget_footer_content_font_css = "\n\t" . dynamik_get_design( 'ez_widget_footer_content_font_css' );
	}
	
	$featured_widget_heading_font_css = '';
	if( dynamik_get_design( 'featured_widget_heading_font_css' ) )
	{
		$featured_widget_heading_font_css = "\n\t" . dynamik_get_design( 'featured_widget_heading_font_css' );
	}
	
	$featured_widget_p_font_css = '';
	if( dynamik_get_design( 'featured_widget_p_font_css' ) )
	{
		$featured_widget_p_font_css = "\n\t" . dynamik_get_design( 'featured_widget_p_font_css' );
	}
	
	$featured_widget_byline_font_css = '';
	if( dynamik_get_design( 'featured_widget_byline_font_css' ) )
	{
		$featured_widget_byline_font_css = "\n\t" . dynamik_get_design( 'featured_widget_byline_font_css' );
	}
	
	$dynamik_widget_title_font_css = '';
	if( dynamik_get_design( 'dynamik_widget_title_font_css' ) )
	{
		$dynamik_widget_title_font_css = "\n\t" . dynamik_get_design( 'dynamik_widget_title_font_css' );
	}
	
	$dynamik_widget_content_font_css = '';
	if( dynamik_get_design( 'dynamik_widget_content_font_css' ) )
	{
		$dynamik_widget_content_font_css = "\n\t" . dynamik_get_design( 'dynamik_widget_content_font_css' );
	}
	
	$sb_heading_font_css = '';
	if( dynamik_get_design( 'sb_heading_font_css' ) )
	{
		$sb_heading_font_css = "\n\t" . dynamik_get_design( 'sb_heading_font_css' );
	}
	
	$sb_content_font_css = '';
	if( dynamik_get_design( 'sb_content_font_css' ) )
	{
		$sb_content_font_css = "\n\t" . dynamik_get_design( 'sb_content_font_css' );
	}
	
	$comment_heading_font_css = '';
	if( dynamik_get_design( 'comment_heading_font_css' ) )
	{
		$comment_heading_font_css = "\n\t" . dynamik_get_design( 'comment_heading_font_css' );
	}
	
	$comment_author_font_css = '';
	if( dynamik_get_design( 'comment_author_font_css' ) )
	{
		$comment_author_font_css = "\n\t" . dynamik_get_design( 'comment_author_font_css' );
	}
	
	$comment_meta_font_css = '';
	if( dynamik_get_design( 'comment_meta_font_css' ) )
	{
		$comment_meta_font_css = "\n\t" . dynamik_get_design( 'comment_meta_font_css' );
	}

	$comment_reply_text_font_css = '';
	if( dynamik_get_design( 'comment_reply_text_font_css' ) )
	{
		$comment_reply_text_font_css = "\n\t" . dynamik_get_design( 'comment_reply_text_font_css' );
	}
	
	$comment_body_font_css = '';
	if( dynamik_get_design( 'comment_body_font_css' ) )
	{
		$comment_body_font_css = "\n\t" . dynamik_get_design( 'comment_body_font_css' );
	}
	
	$comment_form_font_css = '';
	if( dynamik_get_design( 'comment_form_font_css' ) )
	{
		$comment_form_font_css = "\n\t" . dynamik_get_design( 'comment_form_font_css' );
	}
	
	$comment_submit_font_css = '';
	if( dynamik_get_design( 'comment_submit_font_css' ) )
	{
		$comment_submit_font_css = "\n\t" . dynamik_get_design( 'comment_submit_font_css' );
	}

	$comment_form_allowed_tags_font_css = '';
	if( dynamik_get_design( 'comment_form_allowed_tags_font_css' ) )
	{
		$comment_form_allowed_tags_font_css = "\n\t" . dynamik_get_design( 'comment_form_allowed_tags_font_css' );
	}
	
	$footer_font_css = '';
	if( dynamik_get_design( 'footer_font_css' ) )
	{
		$footer_font_css = "\n\t" . dynamik_get_design( 'footer_font_css' );
	}
	
	$search_form_font_css = '';
	if( dynamik_get_design( 'search_form_font_css' ) )
	{
		$search_form_font_css = "\n\t" . dynamik_get_design( 'search_form_font_css' );
	}
	
	$search_button_font_css = '';
	if( dynamik_get_design( 'search_button_font_css' ) )
	{
		$search_button_font_css = "\n\t" . dynamik_get_design( 'search_button_font_css' );
	}
	
	/* List Styles */

	$content_list_style = dynamik_get_design( 'content_list_style' );
	
	if( $content_list_style != "none" )
		$content_list_style_left_margin = 20;
	else
		$content_list_style_left_margin = 10;
	
	$sb_list_style = dynamik_get_design( 'sb_list_style' );

	/* Misc. Custom Widget Area Styles */

	$dynamik_widget_column_class_compatible = dynamik_get_design( 'dynamik_widget_column_class_compatible' );
	
	if( !empty( $dynamik_widget_column_class_compatible ) )
	{
		$dynamik_widget_area_styles = '.dynamik-widget-area {
	' . $dynamik_widget_bg . '
	border-top: ' . $dynamik_widget_top_border_thickness . 'px ' . $dynamik_widget_border_style . ' #' . $dynamik_widget_border_color . ';
	border-bottom: ' . $dynamik_widget_bottom_border_thickness . 'px ' . $dynamik_widget_border_style . ' #' . $dynamik_widget_border_color . ';
	border-left: ' . $dynamik_widget_left_border_thickness . 'px ' . $dynamik_widget_border_style . ' #' . $dynamik_widget_border_color . ';
	border-right: ' . $dynamik_widget_right_border_thickness . 'px ' . $dynamik_widget_border_style . ' #' . $dynamik_widget_border_color . ';
	color: #' . $dynamik_widget_content_font_color . ';
	font-family: ' . $dynamik_widget_content_font_type . ';
	font-size: ' . $dynamik_widget_content_font_size . ';
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	' . $dynamik_widget_content_font_css . '
}';
	}
	else
	{
		$dynamik_widget_area_styles = '.dynamik-widget-area {
	' . $dynamik_widget_bg . '
	border-top: ' . $dynamik_widget_top_border_thickness . 'px ' . $dynamik_widget_border_style . ' #' . $dynamik_widget_border_color . ';
	border-bottom: ' . $dynamik_widget_bottom_border_thickness . 'px ' . $dynamik_widget_border_style . ' #' . $dynamik_widget_border_color . ';
	border-left: ' . $dynamik_widget_left_border_thickness . 'px ' . $dynamik_widget_border_style . ' #' . $dynamik_widget_border_color . ';
	border-right: ' . $dynamik_widget_right_border_thickness . 'px ' . $dynamik_widget_border_style . ' #' . $dynamik_widget_border_color . ';
	' . $dynamik_widget_width . '
	float: ' . $dynamik_widget_float . ';
	margin: ' . $dynamik_widget_margin_top . 'px ' . $dynamik_widget_margin_right . 'px ' . $dynamik_widget_margin_bottom . 'px ' . $dynamik_widget_margin_left . 'px;
	padding: ' . $dynamik_widget_padding_top . 'px ' . $dynamik_widget_padding_right . 'px ' . $dynamik_widget_padding_bottom . 'px ' . $dynamik_widget_padding_left . 'px;
	color: #' . $dynamik_widget_content_font_color . ';
	font-family: ' . $dynamik_widget_content_font_type . ';
	font-size: ' . $dynamik_widget_content_font_size . ';
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	' . $dynamik_widget_content_font_css . '
}';
	}

	/* Content Filler Image Styles */

	if( dynamik_get_design( 'content_filler_image_background_type' ) == 'Transparent' )
	{
		$content_filler_image_background = 'transparent';
	}
	else
	{
		$content_filler_image_background = '#' . dynamik_get_design( 'content_filler_image_background_color' );
	}

	if( dynamik_get_design( 'content_filler_image_type' ) == 'Disabled' )
	{
		$content_filler_image_styles = '';
	}
	elseif( dynamik_get_design( 'content_filler_image_type' ) == 'Minimal' )
	{
		$content_filler_image_styles = '

.dynamik-content-filler-img {
	width: 100% !important;
	height: 0 !important;
	border: 0 !important;
	margin: 0 !important;
	padding: 0 !important;
	display: block !important;
}';
	}
	else
	{
		$content_filler_image_styles = '

.dynamik-content-filler-img {
	background: ' . $content_filler_image_background . ';
	width: 100% !important;
	height: 1px !important;
	border: 0 !important;
	margin: 0 !important;
	padding: 0 !important;
	display: block !important;
}';
	}
	
	/* Media Query Default Styles */
	
	if( dynamik_get_responsive( 'wrap_media_query_default' ) == 'default' )
	{
		$wrap_mq_first = dynamik_html_markup( 'site_container' ) . ' { border: 0; margin: 0 auto; -webkit-border-radius: 0; border-radius: 0; -webkit-box-shadow: none; box-shadow: none; }' . "\n";
	}
	else
	{
		$wrap_mq_first = '';
	}
	
	$header_left_mq_height = $header_height - $text_logo_top_padding;
	
	if( dynamik_get_responsive( 'header_media_query_default' ) == 'default' )
	{
		$header_mq_first = 'body.override ' . dynamik_html_markup( 'site_header' ) . ' .wrap, ' . dynamik_html_markup( 'title_area' ) . ', ' . dynamik_html_markup( 'site_header' ) . ' .widget-area { width: 100%; }' . "\n";
		$header_mq_first .= dynamik_html_markup( 'title_area' ) . ' { height: ' . $header_left_mq_height . 'px; padding-left: 0; text-align: center; float: none; }' . "\n";
		$header_mq_first .= dynamik_html_markup( 'site_header' ) . ' .widget-area { padding: 0; }' . "\n";
		$header_mq_first .= '.header-image ' . dynamik_html_markup( 'site_header' ) . ' .wrap ' . dynamik_html_markup( 'title_area' ) . ' { margin: ' . $image_logo_top_margin . 'px auto ' . $image_logo_bottom_margin . 'px; float: none; }' . "\n";
		$header_mq_second = '';
		$header_mq_fourth = '';
	}
	elseif( dynamik_get_responsive( 'header_media_query_default' ) == 'delayed' )
	{
		$header_mq_first = '';
		$header_mq_second = 'body.override ' . dynamik_html_markup( 'site_header' ) . ' .wrap { width: 100%; }' . "\n";
		$header_mq_second .= dynamik_html_markup( 'title_area' ) . ' { width: ' . $delayed_header_title_area_width . '; }' . "\n";
		$header_mq_second .= dynamik_html_markup( 'site_header' ) . ' .widget-area { width: auto; max-width: ' . $header_widget_width . 'px; }' . "\n";
		$header_mq_fourth = 'body.override ' . dynamik_html_markup( 'site_header' ) . ' .wrap, ' . dynamik_html_markup( 'title_area' ) . ', ' . dynamik_html_markup( 'site_header' ) . ' .widget-area { width: 100%; }' . "\n";
		$header_mq_fourth .= dynamik_html_markup( 'title_area' ) . ' { height: ' . $header_left_mq_height . 'px; padding-left: 0; text-align: center; float: none; }' . "\n";
		$header_mq_fourth .= dynamik_html_markup( 'site_header' ) . ' .widget-area { padding: 0; }' . "\n";
		$header_mq_fourth .= '.header-image ' . dynamik_html_markup( 'site_header' ) . ' .wrap ' . dynamik_html_markup( 'title_area' ) . ' { margin: ' . $image_logo_top_margin . 'px auto ' . $image_logo_bottom_margin . 'px; float: none; }' . "\n";
	}
	else
	{
		$header_mq_first = '';
		$header_mq_second = '';
		$header_mq_fourth = '';
	}

	$primary_menu_as_mobile_header_menu = dynamik_get_responsive( 'primary_menu_as_mobile_header_menu' );
	$primary_menu_as_mobile_header_menu_active = false;
	if( !empty( $primary_menu_as_mobile_header_menu ) &&
		( ( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle_tablet' ) ||
		( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle' ) ||
		( dynamik_get_responsive( 'navbar_media_query_default' ) == 'tablet_dropdown' ) ||
		( dynamik_get_responsive( 'navbar_media_query_default' ) == 'mobile_dropdown' ) ) )
	{
		$primary_menu_as_mobile_header_menu_active = true;
	}
	if( false != $primary_menu_as_mobile_header_menu_active )
	{
		$primary_menu_as_mobile_header_menu_query_styles = dynamik_html_markup( 'site_header' ) . ' .widget_nav_menu { display: none; }';
		$primary_menu_as_mobile_header_menu_styles = "\n\t" . 'display: none;';
	}
	else
	{
		$primary_menu_as_mobile_header_menu_query_styles = '';
		$primary_menu_as_mobile_header_menu_styles = '';
	}

	if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'default' )
	{
		if( true == dynamik_get_responsive( 'navbar_media_query_delayed' ) )
		{
			$navbar_mq_first = '';
			$navbar_mq_second = 'body.override .menu-primary, body.override .menu-secondary { width: 100%; }' . "\n";
			$navbar_mq_second .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: auto; max-width: ' . $header_widget_width . 'px; }' . "\n";
			$navbar_mq_third = '';
			$navbar_mq_fourth = 'body.override .menu-primary, body.override .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: 100%; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'site_header' ) . ' .widget-area { float: none; }' . "\n";
			$navbar_mq_fourth .= '.genesis-nav-menu li.right { display: none; }' . "\n";
			$navbar_mq_fourth .= 'ul.menu-primary, ul.menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' ul.genesis-nav-menu { float: none; text-align: center; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { display: inline-block; float: none; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: left; }' . "\n";
			$navbar_mq_fifth = '';
			$navbar_mq_sixth = '';			
		}
		else
		{
			$navbar_mq_first = 'body.override .menu-primary, body.override .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: 100%; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'site_header' ) . ' .widget-area { float: none; }' . "\n";
			$navbar_mq_first .= '.genesis-nav-menu li.right { display: none; }' . "\n";
			$navbar_mq_first .= 'ul.menu-primary, ul.menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' ul.genesis-nav-menu { float: none; text-align: center; }' . "\n";
			$navbar_mq_first .= '.menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { display: inline-block; float: none; }' . "\n";
			$navbar_mq_first .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: left; }' . "\n";
			$navbar_mq_second = '';
			$navbar_mq_third = '';
			$navbar_mq_fourth = '';
			$navbar_mq_fifth = '';
			$navbar_mq_sixth = '';
		}
	}
	elseif( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle_tablet' )
	{
		if( true == dynamik_get_responsive( 'navbar_media_query_delayed' ) )
		{
			$navbar_mq_first = '';
			$navbar_mq_second = 'body.override .menu-primary, body.override .menu-secondary { width: 100%; }' . "\n";
			$navbar_mq_second .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: auto; max-width: ' . $header_widget_width . 'px; }' . "\n";
			$navbar_mq_third = '';
			$navbar_mq_fourth = 'body.override .menu-primary, body.override .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: 100%; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'site_header' ) . ' .widget-area { float: none; }' . "\n";
			$navbar_mq_fourth .= '.genesis-nav-menu li.right { display: none; }' . "\n";
			$navbar_mq_fourth .= 'ul.menu-primary, ul.menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' ul.genesis-nav-menu, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { float: none; text-align: center; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { display: inline-block; float: none; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: left; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ', ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { height: 100%; border-bottom: 0; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary, .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .menu, .menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li, .menu-primary li ul, .menu-secondary li ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul { width: 100%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li ul, .menu-secondary li ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul { display: block; visibility: visible; height: 100%; left: 0; position: relative; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary a { border-right: 0 !important; border-bottom: ' . $nav1_bottom_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ' !important; }' . "\n";
			$navbar_mq_fourth .= '.menu-secondary a { border-right: 0 !important; border-bottom: ' . $nav2_bottom_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ' !important; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu a { border-right: 0 !important; border-bottom: ' . $nav3_bottom_border_thickness . 'px ' . $nav3_border_style . ' #' . $nav3_border_color . ' !important; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: center; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li li a, .menu-primary li li a:link, .menu-primary li li a:visited, .menu-secondary li li a, .menu-secondary li li a:link, .menu-secondary li li a:visited, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:link, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:visited { width: auto; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li ul ul, .menu-secondary li ul ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul ul { margin: 0; }' . "\n";
			$navbar_mq_fourth .= 'ul.genesis-nav-menu, .genesis-nav-menu li  { text-align: ' . $vertical_menu_sub_page_text_align . ' !important; }' . "\n";
			$navbar_mq_fourth .= '.genesis-nav-menu .sub-menu a::before { content: "' . $vertical_menu_sub_page_pre_text . '"; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li:hover ul ul, .menu-secondary li:hover ul ul { left: 0; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary .sub-menu a, .menu-primary .sub-menu a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 5 ) . 'px; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary .sub-menu li li a, .menu-primary .sub-menu li li a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 15 ) . 'px; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary .sub-menu li li ul li a, .menu-primary .sub-menu li li ul li a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 25 ) . 'px; }' . "\n";
			$navbar_mq_fourth .= '.menu-secondary .sub-menu a, .menu-secondary .sub-menu a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 5 ) . 'px; }' . "\n";
			$navbar_mq_fourth .= '.menu-secondary .sub-menu li li a, .menu-secondary .sub-menu li li a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 15 ) . 'px; }' . "\n";
			$navbar_mq_fourth .= '.menu-secondary .sub-menu li li ul li a, .menu-secondary .sub-menu li li ul li a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 25 ) . 'px; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ' { display: none; }' . $primary_menu_as_mobile_header_menu_query_styles . "\n";
			$navbar_mq_fourth .= '.responsive-primary-menu-container, .responsive-secondary-menu-container, .mobile-primary-toggle, .mobile-secondary-toggle { display: block; }' . "\n";
			$navbar_mq_fifth = '';
			$navbar_mq_sixth = '';
		}
		else
		{
			$navbar_mq_first = 'body.override .menu-primary, body.override .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: 100%; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'site_header' ) . ' .widget-area { float: none; }' . "\n";
			$navbar_mq_first .= '.genesis-nav-menu li.right { display: none; }' . "\n";
			$navbar_mq_first .= 'ul.menu-primary, ul.menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' ul.genesis-nav-menu, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { float: none; text-align: center; }' . "\n";
			$navbar_mq_first .= '.menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { display: inline-block; float: none; }' . "\n";
			$navbar_mq_first .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: left; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ', ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { height: 100%; border-bottom: 0; }' . "\n";
			$navbar_mq_first .= '.menu-primary, .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .menu, .menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li, .menu-primary li ul, .menu-secondary li ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul { width: 100%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }' . "\n";
			$navbar_mq_first .= '.menu-primary li ul, .menu-secondary li ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul { display: block; visibility: visible; height: 100%; left: 0; position: relative; }' . "\n";
			$navbar_mq_first .= '.menu-primary a { border-right: 0 !important; border-bottom: ' . $nav1_bottom_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ' !important; }' . "\n";
			$navbar_mq_first .= '.menu-secondary a { border-right: 0 !important; border-bottom: ' . $nav2_bottom_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ' !important; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu a { border-right: 0 !important; border-bottom: ' . $nav3_bottom_border_thickness . 'px ' . $nav3_border_style . ' #' . $nav3_border_color . ' !important; }' . "\n";
			$navbar_mq_first .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: center; }' . "\n";
			$navbar_mq_first .= '.menu-primary li li a, .menu-primary li li a:link, .menu-primary li li a:visited, .menu-secondary li li a, .menu-secondary li li a:link, .menu-secondary li li a:visited, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:link, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:visited { width: auto; }' . "\n";
			$navbar_mq_first .= '.menu-primary li ul ul, .menu-secondary li ul ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul ul { margin: 0; }' . "\n";
			$navbar_mq_first .= 'ul.genesis-nav-menu, .genesis-nav-menu li  { text-align: ' . $vertical_menu_sub_page_text_align . ' !important; }' . "\n";
			$navbar_mq_first .= '.genesis-nav-menu .sub-menu a::before { content: "' . $vertical_menu_sub_page_pre_text . '"; }' . "\n";
			$navbar_mq_first .= '.menu-primary li:hover ul ul, .menu-secondary li:hover ul ul { left: 0; }' . "\n";
			$navbar_mq_first .= '.menu-primary .sub-menu a, .menu-primary .sub-menu a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 5 ) . 'px; }' . "\n";
			$navbar_mq_first .= '.menu-primary .sub-menu li li a, .menu-primary .sub-menu li li a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 15 ) . 'px; }' . "\n";
			$navbar_mq_first .= '.menu-primary .sub-menu li li ul li a, .menu-primary .sub-menu li li ul li a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 25 ) . 'px; }' . "\n";
			$navbar_mq_first .= '.menu-secondary .sub-menu a, .menu-secondary .sub-menu a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 5 ) . 'px; }' . "\n";
			$navbar_mq_first .= '.menu-secondary .sub-menu li li a, .menu-secondary .sub-menu li li a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 15 ) . 'px; }' . "\n";
			$navbar_mq_first .= '.menu-secondary .sub-menu li li ul li a, .menu-secondary .sub-menu li li ul li a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 25 ) . 'px; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ' { display: none; }' . $primary_menu_as_mobile_header_menu_query_styles . "\n";
			$navbar_mq_first .= '.responsive-primary-menu-container, .responsive-secondary-menu-container, .mobile-primary-toggle, .mobile-secondary-toggle { display: block; }' . "\n";
			$navbar_mq_second = '';
			$navbar_mq_third = '';
			$navbar_mq_fourth = '';
			$navbar_mq_fifth = '';
			$navbar_mq_sixth = '';
		}
	}
	elseif( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical' || dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle' )
	{
		if( true == dynamik_get_responsive( 'navbar_media_query_delayed' ) )
		{
			$navbar_mq_first = '';
			$navbar_mq_second = 'body.override .menu-primary, body.override .menu-secondary { width: 100%; }' . "\n";
			$navbar_mq_second .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: auto; max-width: ' . $header_widget_width . 'px; }' . "\n";
			$navbar_mq_third = '';
			$navbar_mq_fourth = 'body.override .menu-primary, body.override .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: 100%; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'site_header' ) . ' .widget-area { float: none; }' . "\n";
			$navbar_mq_fourth .= '.genesis-nav-menu li.right { display: none; }' . "\n";
			$navbar_mq_fourth .= 'ul.menu-primary, ul.menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' ul.genesis-nav-menu, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { float: none; text-align: center; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { display: inline-block; float: none; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: left; }' . "\n";
			if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle' )
			{
				if( false != $primary_menu_as_mobile_header_menu_active )
				{
					$navbar_mq_fifth = dynamik_html_markup( 'nav_secondary' ) . ' { display: block; }' . "\n";
				}
				else
				{
					$navbar_mq_fifth = dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ' { display: block; }' . "\n";
				}
				$navbar_mq_fifth .= '.responsive-primary-menu-container, .responsive-secondary-menu-container { display: none; }' . "\n";
			}
			else
			{
				$navbar_mq_fifth = '';
			}
			$navbar_mq_sixth = dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ', ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { height: 100%; border-bottom: 0; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary, .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .menu, .menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li, .menu-primary li ul, .menu-secondary li ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul { width: 100%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary li ul, .menu-secondary li ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul { display: block; visibility: visible; height: 100%; left: 0; position: relative; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary a { border-right: 0 !important; border-bottom: ' . $nav1_bottom_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ' !important; }' . "\n";
			$navbar_mq_sixth .= '.menu-secondary a { border-right: 0 !important; border-bottom: ' . $nav2_bottom_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ' !important; }' . "\n";
			$navbar_mq_sixth .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu a { border-right: 0 !important; border-bottom: ' . $nav3_bottom_border_thickness . 'px ' . $nav3_border_style . ' #' . $nav3_border_color . ' !important; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: center; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary li li a, .menu-primary li li a:link, .menu-primary li li a:visited, .menu-secondary li li a, .menu-secondary li li a:link, .menu-secondary li li a:visited, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:link, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:visited { width: auto; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary li ul ul, .menu-secondary li ul ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul ul { margin: 0; }' . "\n";
			$navbar_mq_sixth .= 'ul.genesis-nav-menu, .genesis-nav-menu li  { text-align: ' . $vertical_menu_sub_page_text_align . ' !important; }' . "\n";
			$navbar_mq_sixth .= '.genesis-nav-menu .sub-menu a::before { content: "' . $vertical_menu_sub_page_pre_text . '"; }' . "\n";
			if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle' ) {
				$navbar_mq_sixth .= '.menu-primary li:hover ul ul, .menu-secondary li:hover ul ul { left: 0; }' . "\n";
				$navbar_mq_sixth .= '.menu-primary .sub-menu a, .menu-primary .sub-menu a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 5 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= '.menu-primary .sub-menu li li a, .menu-primary .sub-menu li li a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 15 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= '.menu-primary .sub-menu li li ul li a, .menu-primary .sub-menu li li ul li a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 25 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= '.menu-secondary .sub-menu a, .menu-secondary .sub-menu a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 5 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= '.menu-secondary .sub-menu li li a, .menu-secondary .sub-menu li li a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 15 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= '.menu-secondary .sub-menu li li ul li a, .menu-secondary .sub-menu li li ul li a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 25 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ' { display: none; }' . $primary_menu_as_mobile_header_menu_query_styles . "\n";
				$navbar_mq_sixth .= '.responsive-primary-menu-container, .responsive-secondary-menu-container, .mobile-primary-toggle, .mobile-secondary-toggle { display: block; }' . "\n";
			}
		}
		else
		{
			$navbar_mq_first = 'body.override .menu-primary, body.override .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: 100%; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'site_header' ) . ' .widget-area { float: none; }' . "\n";
			$navbar_mq_first .= '.genesis-nav-menu li.right { display: none; }' . "\n";
			$navbar_mq_first .= 'ul.menu-primary, ul.menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' ul.genesis-nav-menu, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { float: none; text-align: center; }' . "\n";
			$navbar_mq_first .= '.menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { display: inline-block; float: none; }' . "\n";
			$navbar_mq_first .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: left; }' . "\n";
			$navbar_mq_second = '';
			if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle' )
			{
				if( false != $primary_menu_as_mobile_header_menu_active )
				{
					$navbar_mq_third = dynamik_html_markup( 'nav_secondary' ) . ' { display: block; }' . "\n";
				}
				else
				{
					$navbar_mq_third = dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ' { display: block; }' . "\n";
				}
				$navbar_mq_third .= '.responsive-primary-menu-container, .responsive-secondary-menu-container { display: none; }' . "\n";
			}
			else
			{
				$navbar_mq_third = '';
			}
			$navbar_mq_fourth = '';
			$navbar_mq_fifth = '';
			$navbar_mq_sixth = dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ', ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { height: 100%; border-bottom: 0; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary, .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .menu, .menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li, .menu-primary li ul, .menu-secondary li ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul { width: 100%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary li ul, .menu-secondary li ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul { display: block; visibility: visible; height: 100%; left: 0; position: relative; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary a { border-right: 0 !important; border-bottom: ' . $nav1_bottom_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ' !important; }' . "\n";
			$navbar_mq_sixth .= '.menu-secondary a { border-right: 0 !important; border-bottom: ' . $nav2_bottom_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ' !important; }' . "\n";
			$navbar_mq_sixth .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu a { border-right: 0 !important; border-bottom: ' . $nav3_bottom_border_thickness . 'px ' . $nav3_border_style . ' #' . $nav3_border_color . ' !important; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: center; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary li li a, .menu-primary li li a:link, .menu-primary li li a:visited, .menu-secondary li li a, .menu-secondary li li a:link, .menu-secondary li li a:visited, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:link, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:visited { width: auto; }' . "\n";
			$navbar_mq_sixth .= '.menu-primary li ul ul, .menu-secondary li ul ul, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul ul { margin: 0; }' . "\n";
			$navbar_mq_sixth .= 'ul.genesis-nav-menu, .genesis-nav-menu li  { text-align: ' . $vertical_menu_sub_page_text_align . ' !important; }' . "\n";
			$navbar_mq_sixth .= '.genesis-nav-menu .sub-menu a::before { content: "' . $vertical_menu_sub_page_pre_text . '"; }' . "\n";
			if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle' )
			{
				$navbar_mq_sixth .= '.menu-primary li:hover ul ul, .menu-secondary li:hover ul ul { left: 0; }' . "\n";
				$navbar_mq_sixth .= '.menu-primary .sub-menu a, .menu-primary .sub-menu a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 5 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= '.menu-primary .sub-menu li li a, .menu-primary .sub-menu li li a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 15 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= '.menu-primary .sub-menu li li ul li a, .menu-primary .sub-menu li li ul li a:link { padding: ' . $nav1_submenu_tb_padding . 'px ' . ( $nav1_submenu_lr_padding + 25 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= '.menu-secondary .sub-menu a, .menu-secondary .sub-menu a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 5 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= '.menu-secondary .sub-menu li li a, .menu-secondary .sub-menu li li a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 15 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= '.menu-secondary .sub-menu li li ul li a, .menu-secondary .sub-menu li li ul li a:link { padding: ' . $nav2_submenu_tb_padding . 'px ' . ( $nav2_submenu_lr_padding + 25 ) . 'px; }' . "\n";
				$navbar_mq_sixth .= dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ' { display: none; }' . $primary_menu_as_mobile_header_menu_query_styles . "\n";
				$navbar_mq_sixth .= '.responsive-primary-menu-container, .responsive-secondary-menu-container, .mobile-primary-toggle, .mobile-secondary-toggle { display: block; }' . "\n";
			}
		}
	}
	elseif( dynamik_get_responsive( 'navbar_media_query_default' ) == 'tablet_dropdown' )
	{
		if( true == dynamik_get_responsive( 'navbar_media_query_delayed' ) )
		{
			$navbar_mq_first = '';
			$navbar_mq_second = 'body.override .menu-primary, body.override .menu-secondary { width: 100%; }' . "\n";
			$navbar_mq_second .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: auto; max-width: ' . $header_widget_width . 'px; }' . "\n";
			$navbar_mq_third = '';
			$navbar_mq_fourth = dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ' { display: none; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: 100%; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'site_header' ) . ' .widget-area { float: none; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'site_header' ) . ' ul.genesis-nav-menu { float: none; text-align: center; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { display: inline-block; float: none; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: left; }' . "\n";
			$navbar_mq_fourth .= '#dropdown-nav-wrap, #dropdown-subnav-wrap { display: block; }' . $primary_menu_as_mobile_header_menu_query_styles . "\n";
			$navbar_mq_fifth = '';
			$navbar_mq_sixth = '';
		}
		else
		{
			$navbar_mq_first = dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ' { display: none; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: 100%; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'site_header' ) . ' .widget-area { float: none; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'site_header' ) . ' ul.genesis-nav-menu { float: none; text-align: center; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { display: inline-block; float: none; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: left; }' . "\n";
			$navbar_mq_first .= '#dropdown-nav-wrap, #dropdown-subnav-wrap { display: block; }' . $primary_menu_as_mobile_header_menu_query_styles . "\n";
			$navbar_mq_second = '';
			$navbar_mq_third = '';
			$navbar_mq_fourth = '';
			$navbar_mq_fifth = '';
			$navbar_mq_sixth = '';
		}
	}
	elseif( dynamik_get_responsive( 'navbar_media_query_default' ) == 'mobile_dropdown' )
	{
		if( true == dynamik_get_responsive( 'navbar_media_query_delayed' ) )
		{
			$navbar_mq_first = '';
			$navbar_mq_second = 'body.override .menu-primary, body.override .menu-secondary { width: 100%; }' . "\n";
			$navbar_mq_second .= dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: auto; max-width: ' . $header_widget_width . 'px; }' . "\n";
			$navbar_mq_third = '';
			$navbar_mq_fourth = 'body.override .menu-primary, body.override .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: 100%; }' . "\n";
			$navbar_mq_fourth .= dynamik_html_markup( 'site_header' ) . ' .widget-area { float: none; }' . "\n";
			$navbar_mq_fourth .= '.genesis-nav-menu li.right { display: none; }' . "\n";
			$navbar_mq_fourth .= 'ul.menu-primary, ul.menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' ul.genesis-nav-menu { float: none; text-align: center; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { display: inline-block; float: none; }' . "\n";
			$navbar_mq_fourth .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: left; }' . "\n";
			$navbar_mq_fifth = '';
			$navbar_mq_sixth = dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ' { display: none; }' . "\n";
			$navbar_mq_sixth .= '#dropdown-nav-wrap, #dropdown-subnav-wrap { display: block; }' . $primary_menu_as_mobile_header_menu_query_styles . "\n";
		}
		else
		{
			$navbar_mq_first = 'body.override .menu-primary, body.override .menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' .widget-area, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu { width: 100%; }' . "\n";
			$navbar_mq_first .= dynamik_html_markup( 'site_header' ) . ' .widget-area { float: none; }' . "\n";
			$navbar_mq_first .= '.genesis-nav-menu li.right { display: none; }' . "\n";
			$navbar_mq_first .= 'ul.menu-primary, ul.menu-secondary, ' . dynamik_html_markup( 'site_header' ) . ' ul.genesis-nav-menu { float: none; text-align: center; }' . "\n";
			$navbar_mq_first .= '.menu-primary li, .menu-secondary li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li { display: inline-block; float: none; }' . "\n";
			$navbar_mq_first .= '.menu-primary li li, .menu-secondary li li, ' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li { text-align: left; }' . "\n";
			$navbar_mq_second = '';
			$navbar_mq_third = '';
			$navbar_mq_fourth = '';
			$navbar_mq_fifth = '';
			$navbar_mq_sixth = dynamik_html_markup( 'nav_primary' ) . ', ' . dynamik_html_markup( 'nav_secondary' ) . ' { display: none; }' . "\n";
			$navbar_mq_sixth .= '#dropdown-nav-wrap, #dropdown-subnav-wrap { display: block; }' . $primary_menu_as_mobile_header_menu_query_styles . "\n";
		}
	}
	else
	{
		$navbar_mq_first = '';
		$navbar_mq_second = '';
		$navbar_mq_third = '';
		$navbar_mq_fourth = '';
		$navbar_mq_fifth = '';
		$navbar_mq_sixth = '';
	}

	$content_media_query_padded = dynamik_get_responsive( 'content_media_query_padded' );
	
	if( dynamik_get_responsive( 'content_media_query_default' ) == 'default' )
	{
		$content_mq_first = 'body.override ' . dynamik_html_markup( 'site_inner' ) . ' { padding-bottom: 10px; }' . "\n";
		$content_mq_first .= 'body.override ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ', body.override ' . dynamik_html_markup( 'content' ) . ' { width: 100%; }' . "\n";
		$content_mq_first .= dynamik_html_markup( 'content' ) . ' { padding: 0; }' . "\n";
		$content_mq_first .= 'body.override .breadcrumb { margin: 0 0 ' . $breadcrumbs_margin_bottom . 'px; }' . "\n";
		$content_mq_first .= 'body.override ' . dynamik_html_markup( 'sidebar_primary' ) . ', body.override ' . dynamik_html_markup( 'sidebar_secondary' ) . ' { width: 100%; float: left; }' . "\n";
		$content_mq_first .= dynamik_html_markup( 'sidebar_primary' ) . ' { margin: 20px 0 0; }' . "\n";
		$content_mq_second = '';
		if( !empty( $content_media_query_padded ) )
		{
			$content_mq_third = dynamik_html_markup( 'content' ) . ' .override { padding: 10px 20px 0; }' . "\n";
			$content_mq_third .= 'body.override .breadcrumb { margin: 0 20px ' . ( $breadcrumbs_margin_bottom - 10 ) . 'px; }' . "\n";
		}
		else
		{
			$content_mq_third = 'body.override .breadcrumb { margin: 0 0 ' . ( $breadcrumbs_margin_bottom - 10 ) . 'px; }' . "\n";
		}
		$content_mq_third .= '.author-box { margin: ' . $author_box_margin_top . 'px 20px ' . $author_box_margin_bottom . 'px; }' . "\n";
		$content_mq_third .= '#comments { margin: ' . $comments_margin_top . 'px 20px ' . $comments_margin_bottom . 'px; }' . "\n";
		$content_mq_third .= dynamik_html_markup( 'entry_pings' ) . ' { margin: 0 20px; }' . "\n";
		$content_mq_third .= '#respond { margin: 0 20px 15px; }' . "\n";
		$content_mq_fourth = '';
		if( !empty( $content_media_query_padded ) )
		{
			$content_mq_sixth = dynamik_html_markup( 'content' ) . ' .override { padding: 0; }' . "\n";
			$content_mq_sixth .= 'body.override .breadcrumb { margin: 0 0 ' . ( $breadcrumbs_margin_bottom - 10 ) . 'px; }' . "\n";
		}
		else
		{
			$content_mq_sixth = 'body.override .breadcrumb { margin: 0 0 ' . ( $breadcrumbs_margin_bottom - 10 ) . 'px; }' . "\n";
		}
	}
	elseif( dynamik_get_responsive( 'content_media_query_default' ) == 'delayed' )
	{
		$content_mq_first = '';
		$content_mq_second = 'body.override ' . dynamik_html_markup( 'site_inner' ) . ' { padding-bottom: 10px; }' . "\n";
		$content_mq_second .= 'body.override ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ' { width: 100%; }' . "\n";
		$content_mq_second .= 'body.override ' . dynamik_html_markup( 'content' ) . ' { width: auto; max-width: 100%; max-width: -moz-available; padding: 0; }' . "\n";
		$content_mq_second .= 'body.content-sidebar-sidebar ' . dynamik_html_markup( 'content' ) . ', body.sidebar-content-sidebar ' . dynamik_html_markup( 'content' ) . ', body.content-sidebar ' . dynamik_html_markup( 'content' ) . ' { margin-right: ' . $delayed_sidebar_content_margin . 'px; }' . "\n";
		$content_mq_second .= 'body.sidebar-sidebar-content ' . dynamik_html_markup( 'content' ) . ', body.sidebar-content ' . dynamik_html_markup( 'content' ) . ' { margin-left: ' . $delayed_sidebar_content_margin . 'px; }' . "\n";
		$content_mq_second .= 'body.full-width-content ' . dynamik_html_markup( 'content' ) . ' { margin: 0; }' . "\n";
		$content_mq_second .= 'body.override ' . dynamik_html_markup( 'sidebar_primary' ) . ' { width: ' . $delayed_sidebar_width . 'px; }' . "\n";
		$content_mq_second .= 'body.content-sidebar-sidebar ' . dynamik_html_markup( 'sidebar_primary' ) . ', body.sidebar-content-sidebar ' . dynamik_html_markup( 'sidebar_primary' ) . ', body.content-sidebar ' . dynamik_html_markup( 'sidebar_primary' ) . ' { margin-left: -' . $delayed_sidebar_width . 'px; }' . "\n";
		$content_mq_second .= 'body.sidebar-sidebar-content ' . dynamik_html_markup( 'sidebar_primary' ) . ', body.sidebar-content ' . dynamik_html_markup( 'sidebar_primary' ) . ' { margin-right: -' . $delayed_sidebar_width . 'px; }' . "\n";
		$content_mq_second .= 'body.override ' . dynamik_html_markup( 'sidebar_secondary' ) . ' { width: 100%; margin: 20px 0 0; float: left; }' . "\n";
		if( !empty( $content_media_query_padded ) )
		{
			$content_mq_third = dynamik_html_markup( 'content' ) . ' .override { padding: 10px 20px 0; }' . "\n";
			$content_mq_third .= 'body.override .breadcrumb { margin: 0 20px ' . ( $breadcrumbs_margin_bottom - 10 ) . 'px; }' . "\n";
		}
		else
		{
			$content_mq_third = 'body.override .breadcrumb { margin: 0 0 ' . ( $breadcrumbs_margin_bottom - 10 ) . 'px; }' . "\n";
		}
		$content_mq_third .= '.author-box { margin: ' . $author_box_margin_top . 'px 20px ' . $author_box_margin_bottom . 'px; }' . "\n";
		$content_mq_third .= '#comments { margin: ' . $comments_margin_top . 'px 20px ' . $comments_margin_bottom . 'px; }' . "\n";
		$content_mq_third .= dynamik_html_markup( 'entry_pings' ) . ' { margin: 0 20px; }' . "\n";
		$content_mq_third .= '#respond { margin: 0 20px 15px; }' . "\n";
		$content_mq_fourth = 'body.override ' . dynamik_html_markup( 'site_inner' ) . ' { padding-bottom: 10px; }' . "\n";
		$content_mq_fourth .= 'body.override ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ', body.override ' . dynamik_html_markup( 'content' ) . ' { width: 100%; }' . "\n";
		$content_mq_fourth .= dynamik_html_markup( 'content' ) . ' { padding: 0; }' . "\n";
		$content_mq_fourth .= 'body.override ' . dynamik_html_markup( 'sidebar_primary' ) . ', body.override ' . dynamik_html_markup( 'sidebar_secondary' ) . ' { width: 100%; float: left; }' . "\n";
		$content_mq_fourth .= dynamik_html_markup( 'sidebar_primary' ) . ' { margin: 20px 0 0; }' . "\n";
		if( !empty( $content_media_query_padded ) )
		{
			$content_mq_sixth = dynamik_html_markup( 'content' ) . ' .override { padding: 0; }' . "\n";
			$content_mq_sixth .= 'body.override .breadcrumb { margin: 0 0 ' . ( $breadcrumbs_margin_bottom - 10 ) . 'px; }' . "\n";
		}
		else
		{
			$content_mq_sixth = 'body.override .breadcrumb { margin: 0 0 ' . ( $breadcrumbs_margin_bottom - 10 ) . 'px; }' . "\n";
		}
	}
	else
	{
		$content_mq_first = '';
		$content_mq_second = '';
		$content_mq_third = '';
		$content_mq_fourth = '';
		$content_mq_sixth = '';
	}

	$bootstrap_column_classes_active = dynamik_get_settings( 'bootstrap_column_classes_active' );

	if( !empty( $bootstrap_column_classes_active ) )
	{
		$responsive_columns_left_spacing = 'margin';
		$responsive_column_spacing = 'margin-left: 0; padding-bottom: ' . $content_paragraph_margin_bottom . 'px;';
		$responsive_column_classes = '/* Column Classes
--------------------------------------------- */

.five-sixths,
.four-sixths,
.four-fifths,
.one-fifth,
.one-fourth,
.one-half,
.one-sixth,
.one-third,
.three-fourths,
.three-fifths,
.three-sixths,
.two-fourths,
.two-fifths,
.two-sixths,
.two-thirds {
	float: left;
	margin-left: 2.564102564102564%;
	margin-bottom: 20px;
}

.one-half,
.three-sixths,
.two-fourths {
	width: 48.717948717948715%;
}

.one-third,
.two-sixths {
	width: 31.623931623931625%;
}

.four-sixths,
.two-thirds {
	width: 65.81196581196582%;
}

.one-fourth {
	width: 23.076923076923077%;
}

.three-fourths {
	width: 74.35897435897436%;
}

.one-fifth {
	width: 17.9487179487179488%;
}

.two-fifths {
	width: 38.4615384615384616%;
}

.three-fifths {
	width: 58.9743589743589744%;
}

.four-fifths {
	width: 79.4871794871794872%;
}

.one-sixth {
	width: 14.52991452991453%;
}

.five-sixths {
	width: 82.90598290598291%;
}

.first, .ez-only {
	margin-left: 0;
	clear: both;
}

.ez-only {
	width: 100%;
	float: left;
}';
	}
	else
	{
		$responsive_columns_left_spacing = 'padding';
		$responsive_column_spacing = 'padding: 0 0 ' . $content_paragraph_margin_bottom . 'px;';
		$responsive_column_classes = '/* Column Classes
------------------------------------------------------------ */

.five-sixths,
.four-fifths,
.four-sixths,
.one-fifth,
.one-fourth,
.one-half,
.one-sixth,
.one-third,
.three-fifths,
.three-fourths,
.three-sixths,
.two-fifths,
.two-fourths,
.two-sixths,
.two-thirds {
	float: left;
	margin: 0 0 20px;
	padding-left: 3%;
}

.one-half,
.three-sixths,
.two-fourths {
	width: 48%;
}

.one-third,
.two-sixths {
	width: 31%;
}

.four-sixths,
.two-thirds {
	width: 65%;
}

.one-fourth {
	width: 22.5%;
}

.three-fourths {
	width: 73.5%;
}

.one-fifth {
	width: 17.4%;
}

.two-fifths {
	width: 37.8%;
}

.three-fifths {
	width: 58.2%;
}

.four-fifths {
	width: 78.6%;
}

.one-sixth {
	width: 14%;
}

.five-sixths {
	width: 82%;
}

.first, .ez-only {
	padding-left: 0;
	clear: both;
}

.ez-only {
	width: 100%;
	float: left;
}';
	}
	
	if( dynamik_get_responsive( 'ez_media_query_default' ) == 'default' )
	{
		$ez_mq_first = '#home-hook-wrap { padding: ' . $ez_widget_home_padding_top . 'px ' . ( $ez_widget_home_padding_right + 10 ) . 'px ' . $ez_widget_home_padding_bottom . 'px ' . ( $ez_widget_home_padding_left + 10 ) . 'px; }' . "\n";
		$ez_mq_first = '#ez-home-container-wrap, #ez-home-sidebar-wrap { width: 100%; max-width: 100%; }' . "\n";
		$ez_mq_first .= '#ez-home-sidebar-wrap { margin: 20px 0 0; float: left; }' . "\n";
		$ez_mq_first .= '.five-sixths, .four-fifths, .four-sixths, .one-fifth, .one-fourth,' . "\n";
		$ez_mq_first .= '.one-half, .one-sixth, .one-third, .three-fifths, .three-fourths,' . "\n";
		$ez_mq_first .= '.three-sixths, .two-fifths, .two-fourths, .two-sixths, .two-thirds { width: 100%; ' . $responsive_column_spacing . ' }' . "\n";
		$ez_mq_first .= '.first { padding-top: 0 !important; }' . "\n";
		$ez_mq_first .= '#ez-home-slider.ez-widget-area, .slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; }' . "\n";
		$ez_mq_first .= '#home-hook-wrap { padding-bottom: 0; padding-left: ' . ( $ez_widget_home_padding_left + 10 ) . 'px; padding-right: ' . ( $ez_widget_home_padding_right + 10 ) . 'px; }' . "\n";
		$ez_mq_first .= '#ez-home-container-wrap, .ez-home-container-area,' . "\n";
		$ez_mq_first .= '#ez-feature-top-container, #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; }' . "\n";
		$ez_mq_first .= 'body.override.fat-footer-inside #ez-fat-footer-container-wrap { margin-top: 0; margin-bottom: ' . $ez_widget_home_padding_bottom . 'px; }' . "\n";
		$ez_mq_first .= '#ez-home-container-wrap .ez-widget-area,' . "\n";
		$ez_mq_first .= '#ez-feature-top-container .ez-widget-area,' . "\n";
		$ez_mq_first .= '#ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; ' . $responsive_columns_left_spacing . '-left: 0 !important; }' . "\n";
		$ez_mq_first .= '#ez-home-sidebar-wrap { margin: 0; }' . "\n";
		$ez_mq_fourth = '';
	}
	elseif( dynamik_get_responsive( 'ez_media_query_default' ) == 'delayed' )
	{
		$ez_mq_first = '#home-hook-wrap { padding: ' . $ez_widget_home_padding_top . 'px ' . ( $ez_widget_home_padding_right + 10 ) . 'px ' . $ez_widget_home_padding_bottom . 'px ' . ( $ez_widget_home_padding_left + 10 ) . 'px; }' . "\n";
		$ez_mq_first .= '#ez-home-container-wrap, #ez-home-sidebar-wrap { width: 100%; max-width: 100%; }' . "\n";
		$ez_mq_first .= '#ez-home-sidebar-wrap { margin: 20px 0 0; float: left; }' . "\n";
		$ez_mq_fourth = '.five-sixths, .four-fifths, .four-sixths, .one-fifth, .one-fourth,' . "\n";
		$ez_mq_fourth .= '.one-half, .one-sixth, .one-third, .three-fifths, .three-fourths,' . "\n";
		$ez_mq_fourth .= '.three-sixths, .two-fifths, .two-fourths, .two-sixths, .two-thirds { width: 100%; ' . $responsive_column_spacing . ' }' . "\n";
		$ez_mq_fourth .= '.first { padding-top: 0 !important; }' . "\n";
		$ez_mq_fourth .= '#ez-home-slider.ez-widget-area, .slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; }' . "\n";
		$ez_mq_fourth .= '#home-hook-wrap { padding-bottom: 0; padding-left: ' . ( $ez_widget_home_padding_left + 10 ) . 'px; padding-right: ' . ( $ez_widget_home_padding_right + 10 ) . 'px; }' . "\n";
		$ez_mq_fourth .= '#ez-home-container-wrap, .ez-home-container-area,' . "\n";
		$ez_mq_fourth .= '#ez-feature-top-container, #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; }' . "\n";
		$ez_mq_fourth .= 'body.override.fat-footer-inside #ez-fat-footer-container-wrap { margin-top: 0; margin-bottom: ' . $ez_widget_home_padding_bottom . 'px; }' . "\n";
		$ez_mq_fourth .= '#ez-home-container-wrap .ez-widget-area,' . "\n";
		$ez_mq_fourth .= '#ez-feature-top-container .ez-widget-area,' . "\n";
		$ez_mq_fourth .= '#ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; ' . $responsive_columns_left_spacing . '-left: 0 !important; }' . "\n";
		$ez_mq_fourth .= '#ez-home-sidebar-wrap { margin: 0; }' . "\n";
	}
	else
	{
		$ez_mq_first = '';
		$ez_mq_fourth = '';
	}
	
	if( dynamik_get_responsive( 'footer_media_query_default' ) == 'default' )
	{
		$footer_mq_first = dynamik_html_markup( 'site_footer' ) . ' .creds, ' . dynamik_html_markup( 'site_footer' ) . ' .gototop { width: 100%; text-align: center; float: none; }' . "\n";
	}
	else
	{
		$footer_mq_first = '';
	}
	
	if( dynamik_get_custom_css( 'custom_css' ) == '' && dynamik_get_design( 'minify_css' ) )
	{
		$media_query_large_cascading_content = dynamik_get_responsive( 'media_query_large_cascading_content' );
		$media_query_large_content = dynamik_get_responsive( 'media_query_large_content' );
		$media_query_medium_large_content = dynamik_get_responsive( 'media_query_medium_large_content' );
		$media_query_medium_cascading_content = dynamik_get_responsive( 'media_query_medium_cascading_content' );
		$media_query_medium_content = dynamik_get_responsive( 'media_query_medium_content' );
		$media_query_small_content = dynamik_get_responsive( 'media_query_small_content' );
	}
	else
	{
		$media_query_large_cascading_content = '';
		$media_query_large_content = '';
		$media_query_medium_large_content = '';
		$media_query_medium_cascading_content = '';
		$media_query_medium_content = '';
		$media_query_small_content = '';
	}
	
	// Build dynamik CSS content
	$css = '

/* Baseline Normalize
	normalize.css v2.1.2 | MIT License | git.io/normalize
--------------------------------------------- */

article,aside,details,figcaption,figure,footer,header,hgroup,main,nav,section,summary{display:block}audio,canvas,video{display:inline-block}audio:not([controls]){display:none;height:0}[hidden]{display:none}html{font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}a:focus{outline:thin dotted}a:active,a:hover{outline:0}h1{font-size:2em;margin:.67em 0}abbr[title]{border-bottom:1px dotted}b,strong{font-weight:bold}dfn{font-style:italic}hr{-moz-box-sizing:content-box;box-sizing:content-box;height:0}mark{background:#ff0;color:#000}code,kbd,pre,samp{font-family:monospace,serif;font-size:1em}pre{white-space:pre-wrap}q{quotes:"\201C" "\201D" "\2018" "\2019"}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sup{top:-0.5em}sub{bottom:-0.25em}img{border:0}svg:not(:root){overflow:hidden}figure{margin:0}fieldset{border:1px solid silver;margin:0 2px;padding:.35em .625em .75em}legend{border:0;padding:0}button,input,select,textarea{font-family:inherit;font-size:100%;margin:0}button,input{line-height:normal}button,select{text-transform:none}button,html input[type="button"],input[type="reset"],input[type="submit"]{-webkit-appearance:button;cursor:pointer}button[disabled],html input[disabled]{cursor:default}input[type="checkbox"],input[type="radio"]{box-sizing:border-box;padding:0}input[type="search"]{-webkit-appearance:textfield;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box}input[type="search"]::-webkit-search-cancel-button,input[type="search"]::-webkit-search-decoration{-webkit-appearance:none}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}textarea{overflow:auto;vertical-align:top}table{border-collapse:collapse;border-spacing:0}


/* Defaults
------------------------------------------------------------ */

html {
	font-size: 62.5%; /* 10px browser default */
}

body,
h1,
h2,
h2 a,
h2 a:visited,
h3,
h4,
h5,
h6,
p,
select,
textarea {
	margin: 0;
	padding: 0;
	text-decoration: none;
}

li,
ol,
ul {
	margin: 0;
	padding: 0;
}

ol li {
	list-style-type: decimal;
}

.screen-reader-text {
    clip: rect(1px, 1px, 1px, 1px);
    position: absolute !important;
    height: 1px;
    width: 1px;
    overflow: hidden;
}


/* Clear Floats
------------------------------------------------------------ */

.archive-pagination:before,
.clearfix:before,
.entry:before,
.entry-pagination:before,
.footer-widgets:before,
' . dynamik_html_markup( 'nav_primary' ) . ':before,
' . dynamik_html_markup( 'nav_secondary' ) . ':before,
' . dynamik_html_markup( 'site_container' ) . ':before,
' . dynamik_html_markup( 'site_footer' ) . ':before,
' . dynamik_html_markup( 'site_header' ) . ':before,
' . dynamik_html_markup( 'site_inner' ) . ':before,
.wrap:before {
	content: " ";
	display: table;
}

.archive-pagination:after,
.clearfix:after,
.entry:after,
.entry-pagination:after,
.footer-widgets:after,
' . dynamik_html_markup( 'nav_primary' ) . ':after,
' . dynamik_html_markup( 'nav_secondary' ) . ':after,
' . dynamik_html_markup( 'site_container' ) . ':after,
' . dynamik_html_markup( 'site_footer' ) . ':after,
' . dynamik_html_markup( 'site_header' ) . ':after,
' . dynamik_html_markup( 'site_inner' ) . ':after,
.wrap:after {
	clear: both;
	content: " ";
	display: table;
}

.clearfix:after { visibility: hidden; display: block; height: 0; font-size: 0; line-height: 0; content: " "; clear: both; }
.clearfix { display: block; }
/* IE6 */
* html .clearfix { height: 1%; }
/* IE7 */
*:first-child + html .clearfix { min-height: 1%; }


/* Hyperlinks
------------------------------------------------------------ */

a,
a:visited {
	color: #0d72c7;
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
}

a img {
	border: none;
}
' . $universal_link_transition . '


/* Body
------------------------------------------------------------ */

body {
	' . $body_bg . '
	color: #' . $content_p_font_color . ';
	font-family: ' . $content_p_font_type . ';
	font-size: ' . $body_font_size . ';
	line-height: ' . $universal_line_height . ';' . $body_font_css . '
}

::-moz-selection {
	background-color: #0d72c7;
	color: #fff;
}

::selection {
	background-color: #0d72c7;
	color: #fff;
}


/* Wrap
------------------------------------------------------------ */

' . $wrap_styles . '
' . $general_shadow_styles . '
' . $general_radius_styles . '


/* Header
------------------------------------------------------------ */

' . dynamik_html_markup( 'site_header' ) . ' {
	' . $header_bg . '
	min-height: ' . $header_height . 'px;
	border-top: ' . $header_top_border_thickness . 'px ' . $header_border_style . ' #' . $header_border_color . ';
	border-bottom: ' . $header_bottom_border_thickness . 'px ' . $header_border_style . ' #' . $header_border_color . ';
	border-left: ' . $header_lr_border_thickness . 'px ' . $header_border_style . ' #' . $header_border_color . ';
	border-right: ' . $header_lr_border_thickness . 'px ' . $header_border_style . ' #' . $header_border_color . ';
	clear: both;
}

' . dynamik_html_markup( 'site_header' ) . ' .wrap {
	margin: 0 auto;
	padding: 0;
	float: none;
	overflow: hidden;
}

.content-sidebar-sidebar ' . dynamik_html_markup( 'site_header' ) . ' .wrap {
	width: ' . $header_width_dbl_rt_sb . 'px;
}

.sidebar-sidebar-content ' . dynamik_html_markup( 'site_header' ) . ' .wrap {
	width: ' . $header_width_dbl_lft_sb . 'px;
}

.sidebar-content-sidebar ' . dynamik_html_markup( 'site_header' ) . ' .wrap {
	width: ' . $header_width_dbl_sb . 'px;
}

.content-sidebar ' . dynamik_html_markup( 'site_header' ) . ' .wrap {
	width: ' . $header_width_rt_sb . 'px;
}

.sidebar-content ' . dynamik_html_markup( 'site_header' ) . ' .wrap {
	width: ' . $header_width_lft_sb . 'px;
}

.full-width-content ' . dynamik_html_markup( 'site_header' ) . ' .wrap {
	width: ' . $header_width_no_sb . 'px;
}

' . dynamik_html_markup( 'title_area' ) . ' {
	width: ' . $header_title_area_width_alt . ';
	padding: ' . $text_logo_top_padding . 'px 0 0 ' . $text_logo_left_padding . 'px;
	float: ' . $header_title_area_float . ';
	text-align: ' . $header_title_area_text_align . ';
	overflow: hidden;
}

' . dynamik_html_markup( 'site_title' ) . ' {
	color: #' . $title_font_color . ';
	font-family: ' . $title_font_type . ';
	font-size: ' . $title_font_size . ';
	font-weight: 300;
	line-height: 1.25;' . $title_font_css . '
}

' . dynamik_html_markup( 'site_title' ) . ' a,
' . dynamik_html_markup( 'site_title' ) . ' a:visited {
	color: #' . $title_font_color . ';
	text-decoration: ' . $title_link_underline_visited . ';
}

' . dynamik_html_markup( 'site_title' ) . ' a:hover {
	color: #' . $title_link_color . ';
	text-decoration: ' . $title_link_underline_hover . ';
}

' . dynamik_html_markup( 'site_description' ) . ' {
	margin: 0;
	padding: ' . $tagline_top_padding . 'px 0 0;
	color: #' . $tagline_font_color . ';
	font-family: ' . $tagline_font_type . ';
	font-size: ' . $tagline_font_size . ';
	font-weight: 300;' . $tagline_font_css . '
}

' . dynamik_html_markup( 'site_header' ) . ' .widget-area {
	width: ' . $header_widget_width . 'px;
	padding: ' . $header_widget_top_padding . 'px ' . $header_widget_right_padding . 'px 0 0;
	float: right;
	text-align: ' . $header_widget_text_align . ';
}' . $fixed_header_styles . '


/* Image Header - Partial Width
------------------------------------------------------------ */

.header-image ' . dynamik_html_markup( 'site_header' ) . ' .wrap ' . dynamik_html_markup( 'title_area' ) . ' {
	' . $logo_image . '
	height: ' . $header_title_area_logo_height . 'px;
	margin: ' . $header_logo_margins . ';
	float: ' . $header_title_area_float . ';
}

.header-image ' . dynamik_html_markup( 'title_area' ) . ',
.header-image ' . dynamik_html_markup( 'site_title' ) . ',
.header-image ' . dynamik_html_markup( 'site_title' ) . ' a {
	width: ' . $header_title_area_width . ';
	height: ' . $header_title_area_logo_height . 'px;
	padding: 0;
	float: left;
	display: block; 
	text-indent: -9999px;
	overflow: hidden;
}

.header-image ' . dynamik_html_markup( 'site_description' ) . ' {
	display: block;
	overflow: hidden;
}


/* Primary Navigation
------------------------------------------------------------ */

' . dynamik_html_markup( 'nav_primary' ) . ' {
	' . $nav1_bg . '
	border-top: ' . $nav1_top_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	border-bottom: ' . $nav1_bottom_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	border-left: ' . $nav1_left_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	border-right: ' . $nav1_right_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	margin: ' . $nav1_wrap_top_margin . 'px 0 ' . $nav1_wrap_bottom_margin . 'px 0;
	color: #' . $nav1_page_font_color . ';
	font-family: ' . $nav1_font_type . ';
	font-size: ' . $nav1_font_size . ';
	line-height: 1em;
	clear: both;' . $nav1_font_css . $primary_menu_as_mobile_header_menu_styles . '
}

.menu-primary {
	margin: 0 auto;
	padding: 0;
	float: none;
	overflow: hidden;
	display: block;
	clear: both;
}

.content-sidebar-sidebar .menu-primary {
	width: ' . $nav1_width_dbl_rt_sb . 'px;
}

.sidebar-sidebar-content .menu-primary {
	width: ' . $nav1_width_dbl_lft_sb . 'px;
}

.sidebar-content-sidebar .menu-primary {
	width: ' . $nav1_width_dbl_sb . 'px;
}

.content-sidebar .menu-primary {
	width: ' . $nav1_width_rt_sb . 'px;
}

.sidebar-content .menu-primary {
	width: ' . $nav1_width_lft_sb . 'px;
}

.full-width-content .menu-primary {
	width: ' . $nav1_width_no_sb . 'px;
}

.menu-primary ul {
	float: left;
	width: 100%;
}

.menu-primary li {
	float: left;
	list-style-type: none;
}

.menu-primary a {
	' . $nav1_page_bg . '
	border-top: ' . $nav1_page_top_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_border_color . ';
	border-bottom: ' . $nav1_page_bottom_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_border_color . ';
	border-left: ' . $nav1_page_left_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_border_color . ';
	border-right: ' . $nav1_page_right_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_border_color . ';
	margin: 0 ' . $nav1_page_right_margin . 'px 0 ' . $nav1_page_left_margin . 'px;
	padding: ' . $nav1_page_tb_padding . 'px ' . $nav1_page_lr_padding . 'px ' . $nav1_page_tb_padding . 'px ' . $nav1_page_lr_padding . 'px;
	color: #' . $nav1_page_font_color . ';
	text-decoration: ' . $nav1_link_underline_visited . ';
	display: block;
	position: relative;
}

.menu-primary li a:active,
.menu-primary li a:hover {
	' . $nav1_page_hover_bg . '
	border-top: ' . $nav1_page_top_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_hover_border_color . ';
	border-bottom: ' . $nav1_page_bottom_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_hover_border_color . ';
	border-left: ' . $nav1_page_left_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_hover_border_color . ';
	border-right: ' . $nav1_page_right_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_hover_border_color . ';
	color: #' . $nav1_page_hover_font_color . ';
	text-decoration: ' . $nav1_link_underline_hover . ';
}

.menu-primary li.current_page_item a,
.menu-primary li.current-cat a,
.menu-primary li.current-menu-item a {
	' . $nav1_page_active_bg . '
	border-top: ' . $nav1_page_top_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_active_border_color . ';
	border-bottom: ' . $nav1_page_bottom_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_active_border_color . ';
	border-left: ' . $nav1_page_left_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_active_border_color . ';
	border-right: ' . $nav1_page_right_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_active_border_color . ';
	color: #' . $nav1_page_active_font_color . ';
	text-decoration: ' . $nav1_link_underline_hover . ';
}

.menu-primary li li a,
.menu-primary li li a:link,
.menu-primary li li a:visited {
	' . $nav1_sub_page_bg . '
	width: ' . $nav1_submenu_width . 'px;
	border-top: 0;
	border-right: 1px solid #' . $nav1_submenu_border_color . ';
	border-bottom: 1px solid #' . $nav1_submenu_border_color . ';
	border-left: 1px solid #' . $nav1_submenu_border_color . ';
	margin: 0 0 0 ' . $nav1_page_left_margin . 'px;
	padding: ' . $nav1_submenu_tb_padding . 'px ' . $nav1_submenu_lr_padding . 'px ' . $nav1_submenu_tb_padding . 'px ' . $nav1_submenu_lr_padding . 'px;
	color: #' . $nav1_sub_page_font_color . ';
	font-size: ' . $nav1_sub_page_font_size . ';
	text-decoration: ' . $nav1_link_underline_visited . ';
	float: none;
	position: relative;
}

.menu-primary li li a:active,
.menu-primary li li a:hover {
	' . $nav1_sub_page_hover_bg . '
	color: #' . $nav1_sub_page_hover_font_color . ';
	text-decoration: ' . $nav1_link_underline_hover . ';
}

.menu-primary li ul {
	width: ' . $nav1_submenu_width_plus . 'px;
	height: auto;
	margin: 0;
	z-index: 9999;
	left: -9999px;
	position: absolute;
}

.menu-primary li ul ul {
	margin: ' . $nav1_liulul_top_margin . 'px 0 0 ' . $nav1_liulul_left_margin . 'px;
}

.genesis-nav-menu li:hover ul ul,
.genesis-nav-menu li.sfHover ul ul {
	left: -9999px;
}

.genesis-nav-menu li:hover,
.genesis-nav-menu li.sfHover {
	position: static;
}

ul.genesis-nav-menu li:hover>ul,
ul.genesis-nav-menu li.sfHover ul {
	left: auto;
}

.menu-primary li a.sf-with-ul {
	padding-right: ' . $nav1_sf_right_padding . 'px;
}

' . $nav1_sub_indicator_styles . '

#wpadminbar li:hover ul ul {
	left: 0;
}


/* Primary Navigation Extras
------------------------------------------------------------ */

.genesis-nav-menu li.right {
	color: #' . $nav1_extras_font_color . ';
	font-family: ' . $nav1_extras_font_type . ';
	font-size: ' . $nav1_extras_font_size . ';
	padding: ' . $nav1_extras_text_padding_top . 'px ' . $nav1_extras_text_padding_right . 'px 0 0;
	float: right;' . $nav1_extras_font_css . '
}

.genesis-nav-menu li.right a {
	background: none;
	border: none;
	display: inline;
}

.genesis-nav-menu li.right a, .genesis-nav-menu li.right a:visited {
	color: #' . $nav1_extras_link_color . ';
	text-decoration: ' . $nav1_extras_link_underline_visited . ';
}

.genesis-nav-menu li.right a:hover {
	color: #' . $nav1_extras_link_hover_color . ';
	text-decoration: ' . $nav1_extras_link_underline_hover . ';
}

.genesis-nav-menu li.search {
	padding: ' . $nav1_extras_search_padding_top . 'px ' . $nav1_extras_search_padding_right . 'px 0 0;
}

.genesis-nav-menu li.rss a {
	background: url(' . $default_images . '/rss.png) no-repeat center left;
	margin: 0 0 0 10px;
	padding: 0 0 0 16px;
}

.genesis-nav-menu li.twitter a {
	background: url(' . $default_images . '/twitter-nav.png) no-repeat center left;
	padding: 0 0 0 20px;
}
' . $nav1_center_alignment . '

/* Secondary Navigation
------------------------------------------------------------ */

' . dynamik_html_markup( 'nav_secondary' ) . ' {
	' . $nav2_bg . '
	border-top: ' . $nav2_top_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	border-bottom: ' . $nav2_bottom_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	border-left: ' . $nav2_left_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	border-right: ' . $nav2_right_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	margin: ' . $nav2_wrap_top_margin . 'px 0 ' . $nav2_wrap_bottom_margin . 'px 0;
	color: #' . $nav2_page_font_color . ';
	font-family: ' . $nav2_font_type . ';
	font-size: ' . $nav2_font_size . ';
	line-height: 1em;
	clear: both;' . $nav2_font_css . '
}

.menu-secondary {
	margin: 0 auto;
	padding: 0;
	float: none;
	overflow: hidden;
	display: block;
	clear: both;
}

.content-sidebar-sidebar .menu-secondary {
	width: ' . $nav2_width_dbl_rt_sb . 'px;
}

.sidebar-sidebar-content .menu-secondary {
	width: ' . $nav2_width_dbl_lft_sb . 'px;
}

.sidebar-content-sidebar .menu-secondary {
	width: ' . $nav2_width_dbl_sb . 'px;
}

.content-sidebar .menu-secondary {
	width: ' . $nav2_width_rt_sb . 'px;
}

.sidebar-content .menu-secondary {
	width: ' . $nav2_width_lft_sb . 'px;
}

.full-width-content .menu-secondary {
	width: ' . $nav2_width_no_sb . 'px;
}

.menu-secondary ul {
	float: left;
	width: 100%;
}

.menu-secondary li {
	float: left;
	list-style-type: none;
}

.menu-secondary a {
	' . $nav2_page_bg . '
	border-top: ' . $nav2_page_top_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_border_color . ';
	border-bottom: ' . $nav2_page_bottom_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_border_color . ';
	border-left: ' . $nav2_page_left_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_border_color . ';
	border-right: ' . $nav2_page_right_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_border_color . ';
	margin: 0 ' . $nav2_page_right_margin . 'px 0 ' . $nav2_page_left_margin . 'px;
	padding: ' . $nav2_page_tb_padding . 'px ' . $nav2_page_lr_padding . 'px ' . $nav2_page_tb_padding . 'px ' . $nav2_page_lr_padding . 'px;
	color: #' . $nav2_page_font_color . ';
	text-decoration: ' . $nav2_link_underline_visited . ';
	display: block;
	position: relative;
}

.menu-secondary li a:active,
.menu-secondary li a:hover {
	' . $nav2_page_hover_bg . '
	border-top: ' . $nav2_page_top_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_hover_border_color . ';
	border-bottom: ' . $nav2_page_bottom_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_hover_border_color . ';
	border-left: ' . $nav2_page_left_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_hover_border_color . ';
	border-right: ' . $nav2_page_right_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_hover_border_color . ';
	color: #' . $nav2_page_hover_font_color . ';
	text-decoration: ' . $nav2_link_underline_hover . ';
}

.menu-secondary li.current_page_item a,
.menu-secondary li.current-cat a,
.menu-secondary li.current-menu-item a {
	' . $nav2_page_active_bg . '
	border-top: ' . $nav2_page_top_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_active_border_color . ';
	border-bottom: ' . $nav2_page_bottom_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_active_border_color . ';
	border-left: ' . $nav2_page_left_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_active_border_color . ';
	border-right: ' . $nav2_page_right_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_active_border_color . ';
	color: #' . $nav2_page_active_font_color . ';
	text-decoration: ' . $nav2_link_underline_hover . ';
}

.menu-secondary li li a,
.menu-secondary li li a:link,
.menu-secondary li li a:visited {
	' . $nav2_sub_page_bg . '
	width: ' . $nav2_submenu_width . 'px;
	border-top: 0;
	border-right: 1px solid #' . $nav2_submenu_border_color . ';
	border-bottom: 1px solid #' . $nav2_submenu_border_color . ';
	border-left: 1px solid #' . $nav2_submenu_border_color . ';
	margin: 0 0 0 ' . $nav2_page_left_margin . 'px;
	padding: ' . $nav2_submenu_tb_padding . 'px ' . $nav2_submenu_lr_padding . 'px ' . $nav2_submenu_tb_padding . 'px ' . $nav2_submenu_lr_padding . 'px;
	color: #' . $nav2_sub_page_font_color . ';
	font-size: ' . $nav2_sub_page_font_size . ';
	text-decoration: ' . $nav2_link_underline_visited . ';
	float: none;
	position: relative;
}

.menu-secondary li li a:active,
.menu-secondary li li a:hover {
	' . $nav2_sub_page_hover_bg . '
	color: #' . $nav2_sub_page_hover_font_color . ';
	text-decoration: ' . $nav2_link_underline_hover . ';
}

.menu-secondary li ul {
	width: ' . $nav2_submenu_width_plus . 'px;
	height: auto;
	margin: 0;
	z-index: 9999;
	left: -9999px;
	position: absolute;
}

.menu-secondary li ul ul {
	margin: ' . $nav2_liulul_top_margin . 'px 0 0 ' . $nav2_liulul_left_margin . 'px;
}

.menu-secondary li a.sf-with-ul {
	padding-right: ' . $nav2_sf_right_padding . 'px;
}

' . $nav2_sub_indicator_styles . '
' . $nav2_center_alignment . '

/* Vertical Toggle Menu
------------------------------------------------------------ */

' . $vertical_toggle_button_styles . '

' . $vertical_toggle_button_subnav_styles . '


/* Responsive Dropdown Navbars
------------------------------------------------------------ */

#dropdown-nav-wrap,
#dropdown-subnav-wrap {
	display: none;
}

#dropdown-nav,
#dropdown-subnav {
	overflow: hidden;
}

#dropdown-nav {
	' . $nav1_bg . '
	border-top: ' . $nav1_top_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	border-bottom: ' . $nav1_bottom_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	border-left: ' . $nav1_left_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	border-right: ' . $nav1_right_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
}

.nav-chosen-select,
.subnav-chosen-select {
	background: transparent;
	border: 0;
	width: 100%;
	padding: 15px;
	cursor: pointer;
	-webkit-appearance: none;
}

.nav-chosen-select {
	color: #' . $nav1_page_font_color . ';
	font-family: ' . $nav1_font_type . ';
	font-size: ' . $nav1_font_size . ';
}

.nav-chosen-select option {
	color: #' . $nav1_sub_page_font_color . ';
}

#dropdown-nav .responsive-menu-icon,
#dropdown-subnav .responsive-menu-icon {
	padding-right: 15px;
	float: right;
}

#dropdown-nav .responsive-icon-bar,
#dropdown-subnav .responsive-icon-bar {
	width: 18px;
	height: 3px;
	margin: 1px 0;
	float: right;
	clear: both;
	display: block;
	-webkit-border-radius: 1px;
	border-radius: 1px;
}

#dropdown-nav .responsive-menu-icon {
	margin-top: ' . $hamburger_icon_1_margin_top . 'px;
}

#dropdown-nav .responsive-icon-bar {
	background: #' . $nav1_page_font_color . ';
}

#dropdown-subnav {
	' . $nav2_bg . '
	border-top: ' . $nav2_top_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	border-bottom: ' . $nav2_bottom_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	border-left: ' . $nav2_left_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	border-right: ' . $nav2_right_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
}

.subnav-chosen-select {
	color: #' . $nav2_page_font_color . ';
	font-family: ' . $nav2_font_type . ';
	font-size: ' . $nav2_font_size . ';
}

.subnav-chosen-select option {
	color: #' . $nav2_sub_page_font_color . ';
}

#dropdown-subnav .responsive-menu-icon {
	margin-top: ' . $hamburger_icon_2_margin_top . 'px;
}

#dropdown-subnav .responsive-icon-bar {
	background: #' . $nav2_page_font_color . ';
}


/* Header Navigation
------------------------------------------------------------ */

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu {
	' . $nav3_bg . '
	border-top: ' . $nav3_top_border_thickness . 'px ' . $nav3_border_style . ' #' . $nav3_border_color . ';
	border-bottom: ' . $nav3_bottom_border_thickness . 'px ' . $nav3_border_style . ' #' . $nav3_border_color . ';
	border-left: ' . $nav3_left_border_thickness . 'px ' . $nav3_border_style . ' #' . $nav3_border_color . ';
	border-right: ' . $nav3_right_border_thickness . 'px ' . $nav3_border_style . ' #' . $nav3_border_color . ';
	width: ' . $nav3_width . 'px;
	margin: ' . $nav3_wrap_top_margin . 'px 0 ' . $nav3_wrap_bottom_margin . 'px 0;
	padding: 0;
	color: #' . $nav3_page_font_color . ';
	font-family: ' . $nav3_font_type . ';
	font-size: ' . $nav3_font_size . ';
	line-height: 1em;
	overflow: hidden;
	float: none;
	clear: both;
	display: block;' . $nav3_font_css . '
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu ul {
	float: left;
	width: 100%;
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li {
	text-align: left;
	list-style-type: none;
	display: inline-block;
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu a {
	' . $nav3_page_bg . '
	border-top: ' . $nav3_page_top_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_border_color . ';
	border-bottom: ' . $nav3_page_bottom_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_border_color . ';
	border-left: ' . $nav3_page_left_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_border_color . ';
	border-right: ' . $nav3_page_right_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_border_color . ';
	margin: 0 ' . $nav3_page_right_margin . 'px 0 ' . $nav3_page_left_margin . 'px;
	padding: ' . $nav3_page_tb_padding . 'px ' . $nav3_page_lr_padding . 'px ' . $nav3_page_tb_padding . 'px ' . $nav3_page_lr_padding . 'px;
	color: #' . $nav3_page_font_color . ';
	text-decoration: ' . $nav3_link_underline_visited . ';
	display: block;
	position: relative;
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li a:active,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li a:hover {
	' . $nav3_page_hover_bg . '
	border-top: ' . $nav3_page_top_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_hover_border_color . ';
	border-bottom: ' . $nav3_page_bottom_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_hover_border_color . ';
	border-left: ' . $nav3_page_left_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_hover_border_color . ';
	border-right: ' . $nav3_page_right_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_hover_border_color . ';
	color: #' . $nav3_page_hover_font_color . ';
	text-decoration: ' . $nav3_link_underline_hover . ';
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li.current_page_item a,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li.current-cat a,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li.current-menu-item a {
	' . $nav3_page_active_bg . '
	border-top: ' . $nav3_page_top_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_active_border_color . ';
	border-bottom: ' . $nav3_page_bottom_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_active_border_color . ';
	border-left: ' . $nav3_page_left_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_active_border_color . ';
	border-right: ' . $nav3_page_right_border_thickness . 'px ' . $nav3_page_border_style . ' #' . $nav3_page_active_border_color . ';
	color: #' . $nav3_page_active_font_color . ';
	text-decoration: ' . $nav3_link_underline_hover . ';
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:link,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:visited {
	' . $nav3_sub_page_bg . '
	width: ' . $nav3_submenu_width . 'px;
	border-top: 0;
	border-right: 1px solid #' . $nav3_submenu_border_color . ';
	border-bottom: 1px solid #' . $nav3_submenu_border_color . ';
	border-left: 1px solid #' . $nav3_submenu_border_color . ';
	margin: 0 0 0 ' . $nav3_page_left_margin . 'px;
	padding: ' . $nav3_submenu_tb_padding . 'px ' . $nav3_submenu_lr_padding . 'px ' . $nav3_submenu_tb_padding . 'px ' . $nav3_submenu_lr_padding . 'px;
	color: #' . $nav3_sub_page_font_color . ';
	font-size: ' . $nav3_sub_page_font_size . ';
	text-decoration: ' . $nav3_link_underline_visited . ';
	float: none;
	position: relative;
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:active,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li li a:hover {
	' . $nav3_sub_page_hover_bg . '
	color: #' . $nav3_sub_page_hover_font_color . ';
	text-decoration: ' . $nav3_link_underline_hover . ';
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul {
	width: ' . $nav3_submenu_width_plus . 'px;
	height: auto;
	margin: 0;
	z-index: 9999;
	left: -9999px;
	position: absolute;
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li ul ul {
	margin: ' . $nav3_liulul_top_margin . 'px 0 0 ' . $nav3_liulul_left_margin . 'px;
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li:hover>ul,
' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li.sfHover ul {
	left: auto;
}

' . dynamik_html_markup( 'site_header' ) . ' .genesis-nav-menu li a.sf-with-ul {
	padding-right: ' . $nav3_sf_right_padding . 'px;
}

' . $nav3_sub_indicator_styles . '


/* Inner
------------------------------------------------------------ */

' . dynamik_html_markup( 'site_inner' ) . ' {
	' . $inner_bg . '
	border-top: ' . $inner_tb_border_thickness . 'px ' . $inner_border_style . ' #' . $inner_border_color . ';
	border-bottom: ' . $inner_tb_border_thickness . 'px ' . $inner_border_style . ' #' . $inner_border_color . ';
	border-left: ' . $inner_lr_border_thickness . 'px ' . $inner_border_style . ' #' . $inner_border_color . ';
	border-right: ' . $inner_lr_border_thickness . 'px ' . $inner_border_style . ' #' . $inner_border_color . ';
	margin: ' . $inner_top_margin . 'px auto ' . $inner_bottom_margin . 'px;
	padding: ' . $inner_tb_padding . 'px ' . $inner_lr_padding . 'px ' . $inner_tb_padding . 'px ' . $inner_lr_padding . 'px;
	overflow: hidden;
	clear: both;
	' . $inner_box_shadow . '
	' . $inner_border_radius . '
}

.content-sidebar-sidebar ' . dynamik_html_markup( 'site_inner' ) . ' {
	' . $width . ': ' . $inner_width_dbl_rt_sb . 'px;
}

.sidebar-sidebar-content ' . dynamik_html_markup( 'site_inner' ) . ' {
	' . $width . ': ' . $inner_width_dbl_lft_sb . 'px;
}

.sidebar-content-sidebar ' . dynamik_html_markup( 'site_inner' ) . ' {
	' . $width . ': ' . $inner_width_dbl_sb . 'px;
}

.content-sidebar ' . dynamik_html_markup( 'site_inner' ) . ' {
	' . $width . ': ' . $inner_width_rt_sb . 'px;
}

.sidebar-content ' . dynamik_html_markup( 'site_inner' ) . ' {
	' . $width . ': ' . $inner_width_lft_sb . 'px;
}

.full-width-content ' . dynamik_html_markup( 'site_inner' ) . ' {
	' . $width . ': ' . $inner_width_no_sb . 'px;
}

.ez-home ' . dynamik_html_markup( 'site_inner' ) . ' {
	' . $width . ': ' . $inner_width_ez_home . 'px;
	padding: 0;
}


/* Breadcrumb/Taxonomy Description
------------------------------------------------------------ */

.breadcrumb {
	' . $breadcrumbs_bg . '
	border-top: ' . $breadcrumbs_top_border_thickness . 'px ' . $breadcrumbs_border_style . ' #' . $breadcrumbs_border_color . ';
	border-bottom: ' . $breadcrumbs_bottom_border_thickness . 'px ' . $breadcrumbs_border_style . ' #' . $breadcrumbs_border_color . ';
	border-left: ' . $breadcrumbs_left_border_thickness . 'px ' . $breadcrumbs_border_style . ' #' . $breadcrumbs_border_color . ';
	border-right: ' . $breadcrumbs_right_border_thickness . 'px ' . $breadcrumbs_border_style . ' #' . $breadcrumbs_border_color . ';
	margin-top: ' . $breadcrumbs_margin_top . 'px;
	margin-bottom: ' . $breadcrumbs_margin_bottom . 'px;
	padding: ' . $breadcrumbs_padding_top . 'px ' . $breadcrumbs_padding_right . 'px ' . $breadcrumbs_padding_bottom . 'px ' . $breadcrumbs_padding_left . 'px;
	color: #' . $breadcrumbs_font_color . ';
	font-family: ' . $breadcrumbs_font_type . ';
	font-size: ' . $breadcrumbs_font_size . ';' . $breadcrumbs_font_css . '
}

.breadcrumb a,
.breadcrumb a:visited {
	color: #' . $breadcrumbs_link_color . ';
	text-decoration: ' . $breadcrumbs_link_underline_visited . ';
}

.breadcrumb a:hover {
	color: #' . $breadcrumbs_link_hover_color . ';
	text-decoration: ' . $breadcrumbs_link_underline_hover . ';
}

.taxonomy-description,
.author-description {
	' . $taxonomy_box_content_bg . '
	border-top: ' . $taxonomy_box_content_top_border_thickness . 'px ' . $taxonomy_box_content_border_style . ' #' . $taxonomy_box_content_border_color . ';
	border-bottom: ' . $taxonomy_box_content_bottom_border_thickness . 'px ' . $taxonomy_box_content_border_style . ' #' . $taxonomy_box_content_border_color . ';
	border-left: ' . $taxonomy_box_content_lr_border_thickness . 'px ' . $taxonomy_box_content_border_style . ' #' . $taxonomy_box_content_border_color . ';
	border-right: ' . $taxonomy_box_content_lr_border_thickness . 'px ' . $taxonomy_box_content_border_style . ' #' . $taxonomy_box_content_border_color . ';
	margin: ' . $taxonomy_box_margin_top . 'px 0 ' . $taxonomy_box_margin_bottom . 'px;
	padding: 0;
	color: #' . $taxonomy_box_content_font_color . ';
	font-family: ' . $taxonomy_box_content_font_type . ';
	font-size: ' . $taxonomy_box_content_font_size . ';' . $taxonomy_box_content_font_css . '
}

' . dynamik_html_markup( 'content' ) . ' .taxonomy-description h1,
' . dynamik_html_markup( 'content' ) . ' .author-description h1 {
	' . $taxonomy_box_heading_bg . '
	border-top: ' . $taxonomy_box_heading_top_border_thickness . 'px ' . $taxonomy_box_heading_border_style . ' #' . $taxonomy_box_heading_border_color . ';
	border-bottom: ' . $taxonomy_box_heading_bottom_border_thickness . 'px ' . $taxonomy_box_heading_border_style . ' #' . $taxonomy_box_heading_border_color . ';
	border-left: ' . $taxonomy_box_heading_lr_border_thickness . 'px ' . $taxonomy_box_heading_border_style . ' #' . $taxonomy_box_heading_border_color . ';
	border-right: ' . $taxonomy_box_heading_lr_border_thickness . 'px ' . $taxonomy_box_heading_border_style . ' #' . $taxonomy_box_heading_border_color . ';
	margin: 0;
	padding: ' . $taxonomy_box_heading_padding_top . 'px ' . $taxonomy_box_heading_padding_right . 'px ' . $taxonomy_box_heading_padding_bottom . 'px ' . $taxonomy_box_heading_padding_left . 'px;
	color: #' . $taxonomy_box_heading_font_color . ';
	font-family: ' . $taxonomy_box_heading_font_type . ';
	font-size: ' . $taxonomy_box_heading_font_size . ';
	font-weight: 300;' . $taxonomy_box_heading_font_css . '
}

' . dynamik_html_markup( 'content' ) . ' .taxonomy-description p,
' . dynamik_html_markup( 'content' ) . ' .author-description p {
	padding: ' . $taxonomy_box_content_padding_top . 'px ' . $taxonomy_box_content_padding_right . 'px ' . $taxonomy_box_content_padding_bottom . 'px ' . $taxonomy_box_content_padding_left . 'px;
}

' . dynamik_html_markup( 'content' ) . ' .taxonomy-description a, ' . dynamik_html_markup( 'content' ) . ' .taxonomy-description a:visited,
' . dynamik_html_markup( 'content' ) . ' .author-description a, ' . dynamik_html_markup( 'content' ) . ' .author-description a:visited {
	color: #' . $taxonomy_box_content_link_color . ';
	text-decoration: ' . $taxonomy_box_content_link_underline_visited . ';
}

' . dynamik_html_markup( 'content' ) . ' .taxonomy-description a:hover,
' . dynamik_html_markup( 'content' ) . ' .author-description a:hover {
	color: #' . $taxonomy_box_content_link_hover_color . ';
	text-decoration: ' . $taxonomy_box_content_link_underline_hover . ';
}


/* Content-Sidebar Wrap
------------------------------------------------------------ */

' . dynamik_html_markup( 'content_sidebar_wrap' ) . ' {
	float: left;
}

.sidebar-content-sidebar ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ',
.sidebar-sidebar-content ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ' {
	float: right;
}

.content-sidebar-sidebar ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ' {
	width: ' . $content_sb_wrap_width_dbl_rt_sb . 'px;
}

.sidebar-sidebar-content ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ' {
	width: ' . $content_sb_wrap_width_dbl_lft_sb . 'px;
}

.sidebar-content-sidebar ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ' {
	width: ' . $content_sb_wrap_width_dbl_sb . 'px;
}

.content-sidebar ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ' {
	width: ' . $content_sb_wrap_width_rt_sb . 'px;
}

.sidebar-content ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ' {
	width: ' . $content_sb_wrap_width_lft_sb . 'px;
}

.full-width-content ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ' {
	width: ' . $content_sb_wrap_width_no_sb . 'px;
}


/* Content
------------------------------------------------------------ */

' . dynamik_html_markup( 'content' ) . ' {
	margin: 0;
	padding: ' . $content_padding_top . 'px ' . $content_padding_right . 'px ' . $content_padding_bottom . 'px ' . $content_padding_left . 'px;
	float: left;
}

.content-sidebar-sidebar ' . dynamik_html_markup( 'content' ) . ' {
	width: ' . $cc_width_dbl_rt_sb . 'px;
}

.sidebar-sidebar-content ' . dynamik_html_markup( 'content' ) . ' {
	width: ' . $cc_width_dbl_lft_sb . 'px;
}

.sidebar-content-sidebar ' . dynamik_html_markup( 'content' ) . ' {
	width: ' . $cc_width_dbl_sb . 'px;
}

.content-sidebar ' . dynamik_html_markup( 'content' ) . ' {
	width: ' . $cc_width_rt_sb . 'px;
}

.sidebar-content ' . dynamik_html_markup( 'content' ) . ' {
	width: ' . $cc_width_lft_sb . 'px;
}

.full-width-content ' . dynamik_html_markup( 'content' ) . ' {
	width: ' . $cc_width_no_sb . 'px;
}

.sidebar-content ' . dynamik_html_markup( 'content' ) . ',
.sidebar-sidebar-content ' . dynamik_html_markup( 'content' ) . ' {
	float: right;
}

' . dynamik_html_markup( 'content' ) . ' .post,
' . dynamik_html_markup( 'content' ) . ' .entry {
	' . $post_content_bg . '
	border-top: ' . $post_content_top_border_thickness . 'px ' . $post_content_border_style . ' #' . $post_content_border_color . ';
	border-bottom: ' . $post_content_bottom_border_thickness . 'px ' . $post_content_border_style . ' #' . $post_content_border_color . ';
	border-left: ' . $post_content_left_border_thickness . 'px ' . $post_content_border_style . ' #' . $post_content_border_color . ';
	border-right: ' . $post_content_right_border_thickness . 'px ' . $post_content_border_style . ' #' . $post_content_border_color . ';
	margin: ' . $post_content_margin_top . 'px 0 ' . $post_content_margin_bottom . 'px;
	padding: ' . $post_content_padding_top . 'px ' . $post_content_padding_right . 'px ' . $post_content_padding_bottom . 'px ' . $post_content_padding_left . 'px;
}

' . dynamik_html_markup( 'content' ) . ' .page {
	' . $page_content_bg . '
	border-top: ' . $page_content_top_border_thickness . 'px ' . $page_content_border_style . ' #' . $page_content_border_color . ';
	border-bottom: ' . $page_content_bottom_border_thickness . 'px ' . $page_content_border_style . ' #' . $page_content_border_color . ';
	border-left: ' . $page_content_left_border_thickness . 'px ' . $page_content_border_style . ' #' . $page_content_border_color . ';
	border-right: ' . $page_content_right_border_thickness . 'px ' . $page_content_border_style . ' #' . $page_content_border_color . ';
	margin: ' . $page_content_margin_top . 'px 0 ' . $page_content_margin_bottom . 'px;
	padding: ' . $page_content_padding_top . 'px ' . $page_content_padding_right . 'px ' . $page_content_padding_bottom . 'px ' . $page_content_padding_left . 'px;
}

.dynamik-page-builder .site-inner p,
.entry-content p {
	margin: 0 0 ' . $content_paragraph_margin_bottom . 'px;
}

.dynamik-page-builder .site-inner p,
.dynamik-page-builder .site-inner ul li,
.dynamik-page-builder .site-inner ol li,
.entry-content p,
.entry-content ul li,
.entry-content ol li,
.entry-pagination {
	color: #' . $content_p_font_color . ';
	font-family: ' . $content_p_font_type . ';
	font-size: ' . $content_p_font_size . ';' . $content_p_font_css . '
}

.dynamik-page-builder .site-inner a,
.dynamik-page-builder .site-inner a:visited,
.entry-content a,
.entry-content a:visited {
	color: #' . $content_p_link_color . ';
	text-decoration: ' . $content_p_link_underline_visited . ';
}

.dynamik-page-builder .site-inner a:hover,
.entry-content a:hover {
	color: #' . $content_p_link_hover_color . ';
	text-decoration: ' . $content_p_link_underline_hover . ';
}

.dynamik-page-builder .site-inner blockquote,
' . dynamik_html_markup( 'content' ) . ' blockquote {
	' . $blockquote_bg . '
	border-top: ' . $blockquote_top_border_thickness . 'px ' . $blockquote_border_style . ' #' . $blockquote_border_color . ';
	border-bottom: ' . $blockquote_bottom_border_thickness . 'px ' . $blockquote_border_style . ' #' . $blockquote_border_color . ';
	border-left: ' . $blockquote_left_border_thickness . 'px ' . $blockquote_border_style . ' #' . $blockquote_border_color . ';
	border-right: ' . $blockquote_right_border_thickness . 'px ' . $blockquote_border_style . ' #' . $blockquote_border_color . ';
	margin: 5px 5px 20px 30px;
	padding: 25px 30px 5px;
}

.dynamik-page-builder .site-inner blockquote p,
' . dynamik_html_markup( 'content' ) . ' blockquote p {
	color: #' . $blockquote_font_color . ';
	font-family: ' . $blockquote_font_type . ';
	font-size: ' . $blockquote_font_size . ';
	font-style: italic;' . $blockquote_font_css . '
}

.dynamik-page-builder .site-inner blockquote a,
.dynamik-page-builder .site-inner blockquote a:visited,
' . dynamik_html_markup( 'content' ) . ' blockquote a,
' . dynamik_html_markup( 'content' ) . ' blockquote a:visited {
	color: #' . $blockquote_link_color . ';
	text-decoration: ' . $blockquote_link_underline_visited . ';
}

.dynamik-page-builder .site-inner blockquote a:hover,
' . dynamik_html_markup( 'content' ) . ' blockquote a:hover {
	color: #' . $blockquote_link_hover_color . ';
	text-decoration: ' . $blockquote_link_underline_hover . ';
}

p.subscribe-to-comments {
	padding: 20px 0 10px;
}

.clear {
	clear: both;
}

.clear-line {
	border-bottom: 1px solid #ddd;
	clear: both;
	margin: 0 0 25px;
}


/* Content Headlines
------------------------------------------------------------ */

.dynamik-page-builder .site-inner h1,
.dynamik-page-builder .site-inner h2,
.dynamik-page-builder .site-inner h3,
.dynamik-page-builder .site-inner h4,
.dynamik-page-builder .site-inner h5,
.dynamik-page-builder .site-inner h6,
' . dynamik_html_markup( 'content' ) . ' .post h1,
' . dynamik_html_markup( 'content' ) . ' .post h2,
' . dynamik_html_markup( 'content' ) . ' .post h3,
' . dynamik_html_markup( 'content' ) . ' .post h4,
' . dynamik_html_markup( 'content' ) . ' .post h5,
' . dynamik_html_markup( 'content' ) . ' .post h6,
' . dynamik_html_markup( 'content' ) . ' .page h1,
' . dynamik_html_markup( 'content' ) . ' .page h2,
' . dynamik_html_markup( 'content' ) . ' .page h3,
' . dynamik_html_markup( 'content' ) . ' .page h4,
' . dynamik_html_markup( 'content' ) . ' .page h5,
' . dynamik_html_markup( 'content' ) . ' .page h6,
' . dynamik_html_markup( 'content' ) . ' h1.entry-title,
' . dynamik_html_markup( 'content' ) . ' .entry-content h1,
' . dynamik_html_markup( 'content' ) . ' h2.entry-title,
' . dynamik_html_markup( 'content' ) . ' .entry-content h2,
' . dynamik_html_markup( 'content' ) . ' .entry-content h3,
' . dynamik_html_markup( 'content' ) . ' .entry-content h4,
' . dynamik_html_markup( 'content' ) . ' .entry-content h5,
' . dynamik_html_markup( 'content' ) . ' .entry-content h6,
body.search ' . dynamik_html_markup( 'content' ) . ' h1.archive-title {
	margin: 0 0 10px;
	font-family: ' . $content_heading_font_type . ';
	font-weight: 300;
	line-height: 1.25;' . $content_heading_font_css . '
}

.dynamik-page-builder .site-inner h1,
' . dynamik_html_markup( 'content' ) . ' .post h1,
' . dynamik_html_markup( 'content' ) . ' .page h1,
' . dynamik_html_markup( 'content' ) . ' h1.entry-title,
' . dynamik_html_markup( 'content' ) . ' .entry-content h1,
body.search ' . dynamik_html_markup( 'content' ) . ' h1.archive-title {
	color: #' . $content_heading_h1_font_color . ';
	font-size: ' . $content_heading_h1_font_size . ';
}

' . dynamik_html_markup( 'content' ) . ' .post h1 a,
' . dynamik_html_markup( 'content' ) . ' .post h1 a:visited,
' . dynamik_html_markup( 'content' ) . ' .page h1 a,
' . dynamik_html_markup( 'content' ) . ' .page h1 a:visited,
' . dynamik_html_markup( 'content' ) . ' h1.entry-title a,
' . dynamik_html_markup( 'content' ) . ' h1.entry-title a:visited
' . dynamik_html_markup( 'content' ) . ' .post h2 a,
' . dynamik_html_markup( 'content' ) . ' .post h2 a:visited,
' . dynamik_html_markup( 'content' ) . ' .page h2 a,
' . dynamik_html_markup( 'content' ) . ' .page h2 a:visited,
' . dynamik_html_markup( 'content' ) . ' h2.entry-title a,
' . dynamik_html_markup( 'content' ) . ' h2.entry-title a:visited {
	color: #' . $content_heading_h2_link_color . ';
	text-decoration: ' . $content_heading_h2_link_underline_visited . ';
}

' . dynamik_html_markup( 'content' ) . ' .post h1 a:hover,
' . dynamik_html_markup( 'content' ) . ' .page h1 a:hover,
' . dynamik_html_markup( 'content' ) . ' h1.entry-title a:hover
' . dynamik_html_markup( 'content' ) . ' .post h2 a:hover,
' . dynamik_html_markup( 'content' ) . ' .page h2 a:hover,
' . dynamik_html_markup( 'content' ) . ' h2.entry-title a:hover {
	color: #' . $content_heading_h2_hover_color . ';
	text-decoration: ' . $content_heading_h2_link_underline_hover . ';
}

.dynamik-page-builder .site-inner h2,
' . dynamik_html_markup( 'content' ) . ' .post h2,
' . dynamik_html_markup( 'content' ) . ' .page h2,
' . dynamik_html_markup( 'content' ) . ' h2.entry-title,
' . dynamik_html_markup( 'content' ) . ' .entry-content h2 {
	color: #' . $content_heading_h2_font_color . ';
	font-size: ' . $content_heading_h2_font_size . ';
}

.dynamik-page-builder .site-inner h3,
' . dynamik_html_markup( 'content' ) . ' .post h3,
' . dynamik_html_markup( 'content' ) . ' .page h3,
' . dynamik_html_markup( 'content' ) . ' .entry-content h3 {
	color: #' . $content_heading_h3_font_color . ';
	font-size: ' . $content_heading_h3_font_size . ';
}

.dynamik-page-builder .site-inner h4,
' . dynamik_html_markup( 'content' ) . ' .post h4,
' . dynamik_html_markup( 'content' ) . ' .page h4,
' . dynamik_html_markup( 'content' ) . ' .entry-content h4 {
	color: #' . $content_heading_h4_font_color . ';
	font-size: ' . $content_heading_h4_font_size . ';
}

.dynamik-page-builder .site-inner h5,
' . dynamik_html_markup( 'content' ) . ' .post h5,
' . dynamik_html_markup( 'content' ) . ' .page h5,
' . dynamik_html_markup( 'content' ) . ' .entry-content h5 {
	color: #' . $content_heading_h5_font_color . ';
	font-size: ' . $content_heading_h5_font_size . ';
}

.dynamik-page-builder .site-inner h6,
' . dynamik_html_markup( 'content' ) . ' .post h6,
' . dynamik_html_markup( 'content' ) . ' .page h6,
' . dynamik_html_markup( 'content' ) . ' .entry-content h6 {
	color: #' . $content_heading_h6_font_color . ';
	font-size: ' . $content_heading_h6_font_size . ';
}


' . $responsive_column_classes . '


/* EZ Widget Area Class
------------------------------------------------------------ */

.ez-widget-area {
	margin-bottom: 0;
}

.ez-widget-area h4 {
	margin: 0 0 10px;
	padding: 0 0 5px;
	font-weight: 300;
}

.ez-widget-area ul,
.ez-widget-area ol {
	margin: 0;
	padding: 0 0 15px 0;
}

.ez-widget-area ul li,
.ez-widget-area ol li {
	margin: 0 0 0 20px;
	padding: 0;
}

.ez-widget-area ul li {
	list-style-type: square;
}

.ez-widget-area ul ul,
.ez-widget-area ol ol {
	padding: 0;
}


/* EZ Home Widget Areas
------------------------------------------------------------ */

#home-hook-wrap {
	' . $ez_widget_home_bg . '
	border-top: ' . $ez_widget_home_tb_border_thickness . 'px ' . $ez_widget_home_border_style . ' #' . $ez_widget_home_border_color . ';
	border-bottom: ' . $ez_widget_home_tb_border_thickness . 'px ' . $ez_widget_home_border_style . ' #' . $ez_widget_home_border_color . ';
	border-left: ' . $ez_widget_home_lr_border_thickness . 'px ' . $ez_widget_home_border_style . ' #' . $ez_widget_home_border_color . ';
	border-right: ' . $ez_widget_home_lr_border_thickness . 'px ' . $ez_widget_home_border_style . ' #' . $ez_widget_home_border_color . ';
	padding: ' . $ez_widget_home_padding_top . 'px ' . $ez_widget_home_padding_right . 'px ' . $ez_widget_home_padding_bottom . 'px ' . $ez_widget_home_padding_left . 'px;
	clear: both;
}

#ez-home-container-wrap {
    max-width: -moz-available;
}

#ez-home-container-wrap .post {
	margin: 0 0 20px;
}

#ez-home-container-wrap .post p {
	margin: 0 0 ' . $content_paragraph_margin_bottom . 'px;
}

#ez-home-container-wrap .page p {
	margin: 0 0 ' . $content_paragraph_margin_bottom . 'px;
}

#ez-home-container-wrap .post p' . dynamik_html_markup( 'entry_header_entry_meta' ) . ',
#ez-home-container-wrap .page p.byline {
	margin: -5px 0 15px;
}

#ez-home-container-wrap .ez-widget-area img.wp-post-image {
	margin-bottom: 10px !important;
}

#ez-home-container-wrap .ez-widget-area h4,
#ez-home-slider-container-wrap .ez-widget-area h4 {
	border-bottom: ' . $ez_widget_home_heading_bottom_border_thickness . 'px ' . $ez_widget_home_heading_bottom_border_style . ' #' . $ez_widget_home_heading_bottom_border_color . ';
	color: #' . $ez_widget_home_title_font_color . ';
	font-family: ' . $ez_widget_home_title_font_type . ';
	font-size: ' . $ez_widget_home_title_font_size . ';' . $ez_widget_home_title_font_css . '
}

#ez-home-container-wrap .ez-widget-area {
	color: #' . $ez_widget_home_content_font_color . ';
	font-family: ' . $ez_widget_home_content_font_type . ';
	font-size: ' . $ez_widget_home_content_font_size . ';' . $ez_widget_home_content_font_css . '
}

#ez-home-container-wrap .ez-widget-area a,
#ez-home-container-wrap .ez-widget-area a:visited {
	color: #' . $ez_widget_home_content_link_color . ';
	text-decoration: ' . $ez_widget_home_content_link_underline_visited . ';
}

#ez-home-container-wrap .ez-widget-area a:hover {
	color: #' . $ez_widget_home_content_link_hover_color . ';
	text-decoration: ' . $ez_widget_home_content_link_underline_hover . ';
}

#ez-home-container-wrap .ez-widget-area #wp-calendar caption,
#ez-home-container-wrap .ez-widget-area #wp-calendar th {
	color: #' . $ez_widget_home_content_font_color . ';
}

#ez-home-container-wrap img,
#ez-home-container-wrap p img {
	max-width: 100%;
	height: auto;
	display: block;
}

#ez-home-container-wrap .nivoSlider img {
    max-width: none;
}

.ez-home-sidebar #ez-home-container-wrap {
	' . $ez_home_container_wrap_with_sb_rt_spacing . '
	float: left;
}

.ez-home-sidebar.home-sidebar-left #ez-home-container-wrap {
	' . $ez_home_container_wrap_with_sb_lft_spacing . '
	' . $ez_home_container_wrap_with_sb_rt_alt_spacing . '
	float: right;
}

.ez-home-container-area {
	margin: 0 0 20px;
	overflow: hidden;
}

.ez-home-bottom {
	margin: 0;
}


/* Homepage Sidebar
------------------------------------------------------------ */

#ez-home-sidebar-wrap {
	width: 280px;
	' . $ez_home_sb_margin_lft . '
	float: right;
}

.home-sidebar-left #ez-home-sidebar-wrap {
	' . $ez_home_sb_alt_margin_lft . '
	' . $ez_home_sb_margin_rt . '
	float: left;
}

#ez-home-sidebar.sidebar {
	float: none;
}


/* Homepage Slider
------------------------------------------------------------ */

#ez-home-slider-container-wrap {
	margin: 0 0 20px;
	overflow: hidden;
}

#ez-home-slider {
	width: 100%;
	height: ' . $ez_home_slider_height . ';
}

#ez-home-slider .nivoSlider img {
    max-width: none;
}


/* EZ Feature Top Widget Areas
------------------------------------------------------------ */

#ez-feature-top-container-wrap {
	' . $ez_widget_feature_bg . '
	border-top: ' . $ez_widget_feature_top_border_thickness . 'px ' . $ez_widget_feature_border_style . ' #' . $ez_widget_feature_border_color . ';
	border-bottom: ' . $ez_widget_feature_bottom_border_thickness . 'px ' . $ez_widget_feature_border_style . ' #' . $ez_widget_feature_border_color . ';
	border-left: ' . $ez_widget_feature_left_border_thickness . 'px ' . $ez_widget_feature_border_style . ' #' . $ez_widget_feature_border_color . ';
	border-right: ' . $ez_widget_feature_right_border_thickness . 'px ' . $ez_widget_feature_border_style . ' #' . $ez_widget_feature_border_color . ';
	margin: 0 0 20px;
	clear: both;
}

.feature-top-outside #ez-feature-top-container-wrap {
	margin: 0;
}

.content-sidebar-sidebar #ez-feature-top-container {
	' . $width . ': ' . $ez_feature_top_container_width_dbl_rt_sb . 'px;
}

.sidebar-sidebar-content #ez-feature-top-container {
	' . $width . ': ' . $ez_feature_top_container_width_dbl_lft_sb . 'px;
}

.sidebar-content-sidebar #ez-feature-top-container {
	' . $width . ': ' . $ez_feature_top_container_width_dbl_sb . 'px;
}

.content-sidebar #ez-feature-top-container {
	' . $width . ': ' . $ez_feature_top_container_width_rt_sb . 'px;
}

.sidebar-content #ez-feature-top-container {
	' . $width . ': ' . $ez_feature_top_container_width_lft_sb . 'px;
}

.full-width-content #ez-feature-top-container {
	' . $width . ': ' . $ez_feature_top_container_width_no_sb . 'px;
}

#ez-feature-top-container {
	margin: 0 auto;
	padding: ' . $ez_widget_feature_padding_top . 'px ' . $ez_widget_feature_padding_right . 'px ' . $ez_widget_feature_padding_bottom . 'px ' . $ez_widget_feature_padding_left . 'px;
}

#ez-feature-top-container .ez-widget-area h4 {
	border-bottom: ' . $ez_widget_feature_heading_bottom_border_thickness . 'px ' . $ez_widget_feature_heading_bottom_border_style . ' #' . $ez_widget_feature_heading_bottom_border_color . ';
	color: #' . $ez_widget_feature_title_font_color . ';
	font-family: ' . $ez_widget_feature_title_font_type . ';
	font-size: ' . $ez_widget_feature_title_font_size . ';' . $ez_widget_feature_title_font_css . '
}

#ez-feature-top-container .ez-widget-area {
	color: #' . $ez_widget_feature_content_font_color . ';
	font-family: ' . $ez_widget_feature_content_font_type . ';
	font-size: ' . $ez_widget_feature_content_font_size . ';' . $ez_widget_feature_content_font_css . '
}

#ez-feature-top-container .ez-widget-area a,
#ez-feature-top-container .ez-widget-area a:visited {
	color: #' . $ez_widget_feature_content_link_color . ';
	text-decoration: ' . $ez_widget_feature_content_link_underline_visited . ';
}

#ez-feature-top-container .ez-widget-area a:hover {
	color: #' . $ez_widget_feature_content_link_hover_color . ';
	text-decoration: ' . $ez_widget_feature_content_link_underline_hover . ';
}

#ez-feature-top-container .ez-widget-area #wp-calendar caption,
#ez-feature-top-container .ez-widget-area #wp-calendar th {
	color: #' . $ez_widget_feature_content_font_color . ';
}

#ez-feature-top-container img,
#ez-feature-top-container p img {
	max-width: 100%;
	height: auto;
}

#ez-feature-top-container .nivoSlider img {
    max-width: none;
}


/* EZ Fat Footer Widget Areas
------------------------------------------------------------ */

#ez-fat-footer-container-wrap,
.fat-footer-inside #ez-fat-footer-container-wrap {
	' . $ez_widget_footer_bg . '
	border-top: ' . $ez_widget_footer_top_border_thickness . 'px ' . $ez_widget_footer_border_style . ' #' . $ez_widget_footer_border_color . ';
	border-bottom: ' . $ez_widget_footer_bottom_border_thickness . 'px ' . $ez_widget_footer_border_style . ' #' . $ez_widget_footer_border_color . ';
	border-left: ' . $ez_widget_footer_left_border_thickness . 'px ' . $ez_widget_footer_border_style . ' #' . $ez_widget_footer_border_color . ';
	border-right: ' . $ez_widget_footer_right_border_thickness . 'px ' . $ez_widget_footer_border_style . ' #' . $ez_widget_footer_border_color . ';
	clear: both;
}

.fat-footer-inside #ez-fat-footer-container-wrap {
	float: left;
}

.ez-home.fat-footer-inside #ez-fat-footer-container-wrap {
	margin-top: ' . $ez_widget_home_padding_bottom . 'px;
}

.content-sidebar-sidebar #ez-fat-footer-container {
	' . $width . ': ' . $ez_fat_footer_container_width_dbl_rt_sb . 'px;
}

.sidebar-sidebar-content #ez-fat-footer-container {
	' . $width . ': ' . $ez_fat_footer_container_width_dbl_lft_sb . 'px;
}

.sidebar-content-sidebar #ez-fat-footer-container {
	' . $width . ': ' . $ez_fat_footer_container_width_dbl_sb . 'px;
}

.content-sidebar #ez-fat-footer-container {
	' . $width . ': ' . $ez_fat_footer_container_width_rt_sb . 'px;
}

.sidebar-content #ez-fat-footer-container {
	' . $width . ': ' . $ez_fat_footer_container_width_lft_sb . 'px;
}

.full-width-content #ez-fat-footer-container {
	' . $width . ': ' . $ez_fat_footer_container_width_no_sb . 'px;
}

#ez-fat-footer-container {
	margin: 0 auto;
	padding: ' . $ez_widget_footer_padding_top . 'px ' . $ez_widget_footer_padding_right . 'px ' . $ez_widget_footer_padding_bottom . 'px ' . $ez_widget_footer_padding_left . 'px;
}

#ez-fat-footer-container .ez-widget-area h4 {
	border-bottom: ' . $ez_widget_footer_heading_bottom_border_thickness . 'px ' . $ez_widget_footer_heading_bottom_border_style . ' #' . $ez_widget_footer_heading_bottom_border_color . ';
	color: #' . $ez_widget_footer_title_font_color . ';
	font-family: ' . $ez_widget_footer_title_font_type . ';
	font-size: ' . $ez_widget_footer_title_font_size . ';' . $ez_widget_footer_title_font_css . '
}

#ez-fat-footer-container .ez-widget-area {
	color: #' . $ez_widget_footer_content_font_color . ';
	font-family: ' . $ez_widget_footer_content_font_type . ';
	font-size: ' . $ez_widget_footer_content_font_size . ';' . $ez_widget_footer_content_font_css . '
}

#ez-fat-footer-container .ez-widget-area a,
#ez-fat-footer-container .ez-widget-area a:visited {
	color: #' . $ez_widget_footer_content_link_color . ';
	text-decoration: ' . $ez_widget_footer_content_link_underline_visited . ';
}

#ez-fat-footer-container .ez-widget-area a:hover {
	color: #' . $ez_widget_footer_content_link_hover_color . ';
	text-decoration: ' . $ez_widget_footer_content_link_underline_hover . ';
}

#ez-fat-footer-container .ez-widget-area #wp-calendar caption,
#ez-fat-footer-container .ez-widget-area #wp-calendar th {
	color: #' . $ez_widget_footer_content_font_color . ';
}

#ez-fat-footer-container img,
#ez-fat-footer-container p img {
	max-width: 100%;
	height: auto;
}

#ez-fat-footer-container .nivoSlider img {
    max-width: none;
}


/* Custom Widget Areas
------------------------------------------------------------ */

' . $dynamik_widget_area_styles . '

.dynamik-widget-area p,
.dynamik-widget-area ul li,
.dynamik-widget-area.entry-content ol li {
	color: #' . $dynamik_widget_content_font_color . ';
	font-family: ' . $dynamik_widget_content_font_type . ';
	font-size: ' . $dynamik_widget_content_font_size . ';' . $dynamik_widget_content_font_css . '
}

.dynamik-widget-area h4,
' . dynamik_html_markup( 'content' ) . ' .dynamik-widget-area h4 {
	padding: 0 0 5px;
	color: #' . $dynamik_widget_title_font_color . ';
	font-family: ' . $dynamik_widget_title_font_type . ';
	font-size: ' . $dynamik_widget_title_font_size . ';
	font-weight: 300;
	line-height: 1.25;' . $dynamik_widget_title_font_css . '
}

.dynamik-widget-area a,
.dynamik-widget-area a:visited {
	color: #' . $dynamik_widget_content_link_color . ';
	text-decoration: ' . $dynamik_widget_content_link_underline_visited . ';
}

.dynamik-widget-area a:hover {
	color: #' . $dynamik_widget_content_link_hover_color . ';
	text-decoration: ' . $dynamik_widget_content_link_underline_hover . ';
}

.dynamik-widget-area #wp-calendar caption,
.dynamik-widget-area #wp-calendar th {
	color: #' . $dynamik_widget_content_font_color . ';
}


/* Featured Post Grid
------------------------------------------------------------ */

.genesis-grid-even,
.genesis-grid-odd {
	margin: 0 0 20px;
	padding: 0 0 15px;
	width: 48%;
}

.genesis-grid-even {
	float: right;
}

.genesis-grid-odd {
	clear: both;
	float: left;
}


/* Ordered / Unordered Lists
------------------------------------------------------------ */

.dynamik-page-builder .site-inner ul,
.dynamik-page-builder .site-inner ol,
.entry-content ul,
.entry-content ol,
.dynamik-widget-area ul,
.dynamik-widget-area ol {
	margin: 0;
	padding: 0 0 ' . $content_list_style_padding_bottom . 'px;
}

.dynamik-page-builder .site-inner ul li,
.archive-page ul li,
.entry-content ul li,
.dynamik-widget-area ul li {
	list-style-type: ' . $content_list_style . ';
	margin: 0 0 0 30px;
	padding: 0;
}

.dynamik-page-builder .site-inner ol li,
.entry-content ol li,
.dynamik-widget-area ol li {
	margin: 0 0 0 35px;
}

.dynamik-page-builder .site-inner ul ul,
.dynamik-page-builder .site-inner ol ol,
.archive-page ul ul,
.entry-content ul ul,
.entry-content ol ol,
.dynamik-widget-area ul ul,
.dynamik-widget-area ol ol {
	padding: 0;
}


/* Post Info
------------------------------------------------------------ */

' . dynamik_html_markup( 'entry_header_entry_meta' ) . ' {
	margin: -5px 0 15px;
	color: #' . $content_byline_font_color . ';
	font-family: ' . $content_byline_font_type . ';
	font-size: ' . $content_byline_font_size . ';' . $content_byline_font_css . '
}

' . dynamik_html_markup( 'entry_header_entry_meta' ) . ' a,
' . dynamik_html_markup( 'entry_header_entry_meta' ) . ' a:visited {
	color: #' . $content_byline_link_color . ';
	text-decoration: ' . $content_byline_link_underline_visited . ';
}

' . dynamik_html_markup( 'entry_header_entry_meta' ) . ' a:hover {
	color: #' . $content_byline_link_hover_color . ';
	text-decoration: ' . $content_byline_link_underline_hover . ';
}

.entry-comments-link::before {
	content: "\2014";
	margin: 0 6px 0 2px;
}


/* Post Meta
------------------------------------------------------------ */

' . dynamik_html_markup( 'entry_footer_entry_meta' ) . ' {
	border-top: ' . $cc_bottom_border_thickness . 'px ' . $cc_bottom_border_style . ' #' . $cc_bottom_border_color . ';
	padding: 5px 0 0;
	color: #' . $post_meta_font_color . ';
	font-family: ' . $post_meta_font_type . ';
	font-size: ' . $post_meta_font_size . ';
	font-style: italic;
	clear: both;' . $post_meta_font_css . '
}

' . dynamik_html_markup( 'entry_footer_entry_meta' ) . ' a,
' . dynamik_html_markup( 'entry_footer_entry_meta' ) . ' a:visited {
	color: #' . $post_meta_link_color . ';
	text-decoration: ' . $post_meta_link_underline_visited . ';
}

' . dynamik_html_markup( 'entry_footer_entry_meta' ) . ' a:hover {
	color: #' . $post_meta_link_hover_color . ';
	text-decoration: ' . $post_meta_link_underline_hover . ';
}


/* Author Box
------------------------------------------------------------ */

.author-box {
	' . $author_box_bg . '
	border-top: ' . $author_box_top_border_thickness . 'px ' . $author_box_border_style . ' #' . $author_box_border_color . ';
	border-bottom: ' . $author_box_bottom_border_thickness . 'px ' . $author_box_border_style . ' #' . $author_box_border_color . ';
	border-left: ' . $author_box_left_border_thickness . 'px ' . $author_box_border_style . ' #' . $author_box_border_color . ';
	border-right: ' . $author_box_right_border_thickness . 'px ' . $author_box_border_style . ' #' . $author_box_border_color . ';
	margin: ' . $author_box_margin_top . 'px 0 ' . $author_box_margin_bottom . 'px;
	padding: ' . $author_box_padding_top . 'px ' . $author_box_padding_right . 'px ' . $author_box_padding_bottom . 'px ' . $author_box_padding_left . 'px;
	overflow: hidden;
	clear: both;
}

' . dynamik_html_markup( 'author_box_title' ) . ' {
	color: #' . $author_box_title_font_color . ';
	font-family: ' . $author_box_title_font_type . ';
	font-size: ' . $author_box_title_font_size . ';
	font-weight: 300;' . $author_box_title_font_css . '
}

' . dynamik_html_markup( 'author_box_content' ) . ' {
	color: #' . $author_box_font_color . ';
	font-family: ' . $author_box_font_type . ';
	font-size: ' . $author_box_font_size . ';' . $author_box_font_css . '
}

.author-box a,
.author-box a:visited {
	color: #' . $author_box_link_color . ' !important;
	text-decoration: ' . $author_box_link_underline_visited . ' !important;
}

.author-box a:hover {
	color: #' . $author_box_link_hover_color . ' !important;
	text-decoration: ' . $author_box_link_underline_hover . ' !important;
}


/* Sticky Posts
------------------------------------------------------------ */

.sticky {
	background-color: #f5f5f5;
	margin: -10px 0 40px;
	padding: 20px;
}

' . dynamik_html_markup( 'content' ) . ' .sticky {
	' . $sticky_post_bg . '
	border-top: ' . $sticky_post_top_border_thickness . 'px ' . $sticky_post_border_style . ' #' . $sticky_post_border_color . ';
	border-bottom: ' . $sticky_post_bottom_border_thickness . 'px ' . $sticky_post_border_style . ' #' . $sticky_post_border_color . ';
	border-left: ' . $sticky_post_left_border_thickness . 'px ' . $sticky_post_border_style . ' #' . $sticky_post_border_color . ';
	border-right: ' . $sticky_post_right_border_thickness . 'px ' . $sticky_post_border_style . ' #' . $sticky_post_border_color . ';
	margin: ' . $sticky_post_margin_top . 'px 0 ' . $sticky_post_margin_bottom . 'px 0;
	padding: ' . $sticky_post_padding_top . 'px ' . $sticky_post_padding_right . 'px ' . $sticky_post_padding_bottom . 'px ' . $sticky_post_padding_left . 'px;
}


/* Archive Page
------------------------------------------------------------ */

.archive-page {
	float: left;
	padding: 20px 0 0;
	width: 45%;
}


/* Post Icons
------------------------------------------------------------ */

.post-comments,
.tags {
	background: url(' . $default_images . '/icon-dot.png) no-repeat left;
	margin: 0 0 0 3px;
	padding: 0 0 0 10px;
}


/* Images
------------------------------------------------------------ */

img {
	max-width: 100%;
	height: auto;
}

.nivoSlider img {
    max-width: none;
}

.featuredpage img,
.featuredpost img,
.post-image {
	' . $thumbnail_bg . '
	border: ' . $thumbnail_border_thickness . 'px ' . $thumbnail_border_style . ' #' . $thumbnail_border_color . ';
	padding: ' . $thumbnail_image_padding . 'px;
}

.author-box .avatar {
	' . $author_box_avatar_bg . '
	border: ' . $author_box_avatar_border_thickness . 'px ' . $author_box_avatar_border_style . ' #' . $author_box_avatar_border_color . ';
	width: ' . $author_box_avatar_size . 'px;
	height: ' . $author_box_avatar_size . 'px;
	margin: 0 10px 0 0;
	padding: ' . $author_box_avatar_padding . 'px;
	float: left;
}

.post-image {
	margin: 0 10px 10px 0;
}

img.centered,
.aligncenter {
	display: block;
	margin: 0 auto 10px;
}

img.alignnone {
	display: inline;
	margin: 0 0 10px;
}

img.alignleft {
	display: inline;
	margin: 0 15px 10px 0;
}

img.alignright {
	display: inline;
	margin: 0 0 10px 15px;
}

.alignleft {
	float: left;
	margin: 0 15px 10px 0;
}

.alignright {
	float: right;
	margin: 0 0 10px 15px;
}

.wp-caption {
	' . $caption_bg . '
	border: ' . $caption_border_thickness . 'px ' . $caption_border_style . ' #' . $caption_border_color . ';
	max-width: 100%;
	padding: 5px;
	text-align: center;
}

p.wp-caption-text {
	margin: 5px 0;
	color: #' . $caption_font_color . ';
	font-family: ' . $caption_font_type . ';
	font-size: ' . $caption_font_size . ';' . $caption_font_css . '
}

.wp-smiley,
.wp-wink {
	border: none;
	float: none;
}

.post-format-image {
	display: block;
	float: right;
}

.page .post-format-image {
	display: none;
}

.page-template-page_blog-php .post-format-image {
	display: block;
}

.dynamik-page-builder .site-inner {
	max-width: none;
	padding: 0;
}' . $content_filler_image_styles . '


/* Post Navigation
------------------------------------------------------------ */

' . dynamik_html_markup( 'pagination' ) . ',
.entry-pagination {
	width: 100%;
	margin: 0;
	padding: ' . $post_nav_padding_top . 'px 0 ' . $post_nav_padding_bottom . 'px;
	overflow: hidden;
}

' . dynamik_html_markup( 'pagination' ) . ' li {
	display: inline;
}

' . dynamik_html_markup( 'pagination' ) . ' a,
' . dynamik_html_markup( 'pagination' ) . ' a:visited,
.entry-pagination a,
.entry-pagination a:visited {
	color: #' . $post_nav_link_color . ';
	font-family: ' . $post_nav_font_type . ';
	font-size: ' . $post_nav_font_size . ';
	text-decoration: ' . $post_nav_link_underline_visited . ';' . $post_nav_font_css . '
}

' . dynamik_html_markup( 'pagination' ) . ' a:hover,
.entry-pagination a:hover {
	color: #' . $post_nav_link_hover_color . ';
	text-decoration: ' . $post_nav_link_underline_hover . ';
}

' . dynamik_html_markup( 'pagination' ) . ' li a,
' . dynamik_html_markup( 'pagination' ) . ' li.disabled,
' . dynamik_html_markup( 'pagination' ) . ' li a:hover,
' . dynamik_html_markup( 'pagination' ) . ' li.active a {
	' . $post_nav_numbered_inactive_bg . '
	border: ' . $post_nav_border_thickness . 'px ' . $post_nav_border_style . ' #' . $post_nav_border_color . ';
	margin: 0 ' . $post_nav_numbered_margin_right . 'px 0 ' . $post_nav_numbered_margin_left . 'px;
	padding: ' . $post_nav_numbered_tb_padding . 'px ' . $post_nav_numbered_lr_padding . 'px ' . $post_nav_numbered_tb_padding . 'px ' . $post_nav_numbered_lr_padding . 'px;
	color: #' . $post_nav_link_color . ';
	font-family: ' . $post_nav_font_type . ';
	font-size: ' . $post_nav_font_size . ';
	text-decoration: ' . $post_nav_link_underline_visited . ';' . $post_nav_font_css . '
}

' . dynamik_html_markup( 'pagination' ) . ' li a:hover,
' . dynamik_html_markup( 'pagination' ) . ' li.active a {
	' . $post_nav_numbered_active_bg . '
	color: #' . $post_nav_link_hover_color . ';
	text-decoration: ' . $post_nav_link_underline_visited . ';
}

' . dynamik_html_markup( 'pagination' ) . ' li a:hover {
	text-decoration: ' . $post_nav_link_underline_hover . ';
}


/* Primary / Secondary Sidebars
------------------------------------------------------------ */

.sidebar {
	float: right;
	display: inline;
}

' . dynamik_html_markup( 'sidebar_secondary' ) . ' {
	float: left;
}

.sidebar-content ' . dynamik_html_markup( 'sidebar_primary' ) . ',
.sidebar-sidebar-content ' . dynamik_html_markup( 'sidebar_primary' ) . ' {
	float: left;
}

.content-sidebar-sidebar ' . dynamik_html_markup( 'sidebar_secondary' ) . ' {
	float: right;
}

.content-sidebar ' . dynamik_html_markup( 'sidebar_primary' ) . ' {
	width: ' . $sb1_width_rt_sb . 'px;
}

.sidebar-content ' . dynamik_html_markup( 'sidebar_primary' ) . ' {
	width: ' . $sb1_width_lft_sb . 'px;
}

.content-sidebar-sidebar ' . dynamik_html_markup( 'sidebar_primary' ) . ' {
	width: ' . $sb1_width_dbl_rt_sb . 'px;
}

.content-sidebar-sidebar ' . dynamik_html_markup( 'sidebar_secondary' ) . ' {
	width: ' . $sb2_width_dbl_rt_sb . 'px;
}

.sidebar-sidebar-content ' . dynamik_html_markup( 'sidebar_primary' ) . ' {
	width: ' . $sb1_width_dbl_lft_sb . 'px;
}

.sidebar-sidebar-content ' . dynamik_html_markup( 'sidebar_secondary' ) . ' {
	width: ' . $sb2_width_dbl_lft_sb . 'px;
}

.sidebar-content-sidebar ' . dynamik_html_markup( 'sidebar_primary' ) . ' {
	width: ' . $sb1_width_dbl_sb . 'px;
}

.sidebar-content-sidebar ' . dynamik_html_markup( 'sidebar_secondary' ) . ' {
	width: ' . $sb2_width_dbl_sb . 'px;
}

' . dynamik_html_markup( 'sidebar_primary' ) . ' h4,
' . dynamik_html_markup( 'sidebar_secondary' ) . ' h4,
#ez-home-sidebar h4 {
	' . $sb_heading_bg . '
	border-top: ' . $sb_heading_top_border_thickness . 'px ' . $sb_heading_border_style . ' #' . $sb_heading_border_color . ';
	border-bottom: ' . $sb_heading_bottom_border_thickness . 'px ' . $sb_heading_border_style . ' #' . $sb_heading_border_color . ';
	border-left: ' . $sb_heading_lr_border_thickness . 'px ' . $sb_heading_border_style . ' #' . $sb_heading_border_color . ';
	border-right: ' . $sb_heading_lr_border_thickness . 'px ' . $sb_heading_border_style . ' #' . $sb_heading_border_color . ';
	margin: 0;
	padding: ' . $sb_heading_padding_top . 'px ' . $sb_heading_padding_right . 'px ' . $sb_heading_padding_bottom . 'px ' . $sb_heading_padding_left . 'px;
	color: #' . $sb_heading_font_color . ';
	font-family: ' . $sb_heading_font_type . ';
	font-size: ' . $sb_heading_font_size . ';
	font-weight: 300;
	line-height: 1.25;' . $sb_heading_font_css . '
}

' . dynamik_html_markup( 'sidebar_primary' ) . ',
' . dynamik_html_markup( 'sidebar_secondary' ) . ',
#ez-home-sidebar {
	color: #' . $sb_content_font_color . ';
	font-family: ' . $sb_content_font_type . ';
	font-size: ' . $sb_content_font_size . ';' . $sb_content_font_css . '
}

' . dynamik_html_markup( 'sidebar_primary' ) . ' a,
' . dynamik_html_markup( 'sidebar_primary' ) . ' a:visited,
' . dynamik_html_markup( 'sidebar_secondary' ) . ' a,
' . dynamik_html_markup( 'sidebar_secondary' ) . ' a:visited,
#ez-home-sidebar a,
#ez-home-sidebar a:visited {
	color: #' . $sb_content_link_color . ';
	text-decoration: ' . $sb_content_link_underline_visited . ';
}

' . dynamik_html_markup( 'sidebar_primary' ) . ' a:hover,
' . dynamik_html_markup( 'sidebar_secondary' ) . ' a:hover,
#ez-home-sidebar a:hover {
	color: #' . $sb_content_link_hover_color . ';
	text-decoration: ' . $sb_content_link_underline_hover . ';
}

.sidebar.widget-area .widget {
	' . $sb_content_bg . '
	border-top: ' . $sb_content_top_border_thickness . 'px ' . $sb_content_border_style . ' #' . $sb_content_border_color . ';
	border-bottom: ' . $sb_content_bottom_border_thickness . 'px ' . $sb_content_border_style . ' #' . $sb_content_border_color . ';
	border-left: ' . $sb_content_lr_border_thickness . 'px ' . $sb_content_border_style . ' #' . $sb_content_border_color . ';
	border-right: ' . $sb_content_lr_border_thickness . 'px ' . $sb_content_border_style . ' #' . $sb_content_border_color . ';
	margin: ' . $sb_widget_margin_top . 'px 0 ' . $sb_widget_margin_bottom . 'px;
	padding: 0 0 15px;
}

.sidebar.widget-area ol,
.sidebar.widget-area ul,
.sidebar.widget-area .textwidget,
.sidebar.widget-area .widget_tag_cloud div div,
.sidebar.widget-area .author-bio-widget,
.sidebar.widget-area .featuredpage .page,
.sidebar.widget-area .featuredpost .post {
	margin: 0 !important;
	padding: ' . $sb_content_padding_top . 'px ' . $sb_content_padding_right . 'px ' . $sb_content_padding_bottom . 'px ' . $sb_content_padding_left . 'px;
}

.sidebar.widget-area #wp-calendar caption,
.sidebar.widget-area #wp-calendar th {
	color: #' . $sb_content_font_color . ';
}

.sidebar.widget-area .widget_archive select,
.sidebar.widget-area #cat {
	margin: ' . $sb_content_padding_top . 'px ' . $sb_content_padding_right . 'px ' . $sb_content_padding_bottom . 'px ' . $sb_content_padding_left . 'px;
}

.sidebar.widget-area ul li {
	border-bottom: ' . $sb_li_bottom_border_thickness . 'px ' . $sb_li_bottom_border_style . ' #' . $sb_li_bottom_border_color . ';
	margin: ' . $sb_li_margin_top . 'px ' . $sb_li_margin_right . 'px ' . $sb_li_margin_bottom . 'px ' . $sb_li_margin_left . 'px;
	padding: ' . $sb_li_padding_top . 'px ' . $sb_li_padding_right . 'px ' . $sb_li_padding_bottom . 'px ' . $sb_li_padding_left . 'px;
	list-style-type: ' . $sb_list_style . ';
	word-wrap: break-word;
}

.sidebar.widget-area ul ul li {
	border: none;
	margin: 0;
}

/* Dropdowns
------------------------------------------------------------ */

.widget_archive select,
#cat {
	background: #F5F5F5;
	border: 1px solid #DDDDDD;
	width: 83%;
	margin: 15px 15px 0;
	padding: 3px;
	font-size: 14px;
	display: inline;
}


/* Featured Page / Post
------------------------------------------------------------ */

.featuredpage,
.featuredpost {
	overflow: hidden;
	clear: both;
}

.featuredpage .page,
.featuredpost .post {
	margin: ' . $featured_widget_margin_top . 'px ' . $featured_widget_margin_right . 'px ' . $featured_widget_margin_bottom . 'px ' . $featured_widget_margin_left . 'px !important;
	padding: ' . $featured_widget_padding_top . 'px ' . $featured_widget_padding_right . 'px ' . $featured_widget_padding_bottom . 'px ' . $featured_widget_padding_left . 'px;
	overflow: hidden;
}

.featuredpage .page p,
.featuredpost .post p {
	color: #' . $featured_widget_p_font_color . ';
	font-family: ' . $featured_widget_p_font_type . ';
	font-size: ' . $featured_widget_p_font_size . ';' . $featured_widget_p_font_css . '
}

.featuredpage .page a,
.featuredpage .page a:visited,
.featuredpost .post a,
.featuredpost .post a:visited {
	color: #' . $featured_widget_p_link_color . ' !important;
	text-decoration: ' . $featured_widget_p_link_underline_visited . ' !important;
}

.featuredpage .page a:hover,
.featuredpost .post a:hover {
	color: #' . $featured_widget_p_link_hover_color . ' !important;
	text-decoration: ' . $featured_widget_p_link_underline_hover . ' !important;
}

.featuredpage .page h2,
.featuredpost .post h2 {
	margin: 0 0 5px;
	font-family: ' . $featured_widget_heading_font_type . ';
	font-size: ' . $featured_widget_heading_font_size . ';
	font-weight: 300;
	line-height: 1.25;' . $featured_widget_heading_font_css . '
}

.featuredpage .page h2 a,
.featuredpage .page h2 a:visited,
.featuredpost .post h2 a,
.featuredpost .post h2 a:visited {
	color: #' . $featured_widget_heading_link_color . ' !important;
	text-decoration: ' . $featured_widget_heading_link_underline_visited . ' !important;
}

.featuredpage .page h2 a:hover,
.featuredpost .post h2 a:hover {
	color: #' . $featured_widget_heading_link_hover_color . ' !important;
	text-decoration: ' . $featured_widget_heading_link_underline_hover . ' !important;
}

.featuredpage .page .byline,
.featuredpost .post ' . dynamik_html_markup( 'entry_header_entry_meta' ) . ' {
	color: #' . $featured_widget_byline_font_color . ' !important;
	font-family: ' . $featured_widget_byline_font_type . ' !important;
	font-size: ' . $featured_widget_byline_font_size . ' !important;' . $featured_widget_byline_font_css . '
}

.featuredpage .page .byline a,
.featuredpage .page .byline a:visited,
.featuredpost .post ' . dynamik_html_markup( 'entry_header_entry_meta' ) . ' a,
.featuredpost .post ' . dynamik_html_markup( 'entry_header_entry_meta' ) . ' a:visited {
	color: #' . $featured_widget_byline_link_color . ' !important;
	text-decoration: ' . $featured_widget_byline_link_underline_visited . ' !important;
}

.featuredpage .page .byline a:hover,
.featuredpost .post ' . dynamik_html_markup( 'entry_header_entry_meta' ) . ' a:hover {
	color: #' . $featured_widget_byline_link_hover_color . ' !important;
	text-decoration: ' . $featured_widget_byline_link_underline_hover . ' !important;
}

.more-from-category {
	padding: 5px 15px 0;
}


/* User Profile
------------------------------------------------------------ */

.user-profile {
	overflow: hidden;
}

.user-profile p {
	padding: 5px 15px 0;
}

.user-profile .posts_link {
	padding: 0 15px;
}


/* Search Form
------------------------------------------------------------ */

' . dynamik_html_markup( 'site_header' ) . ' ' . dynamik_html_markup( 'search_form' ) . ' {
	float: right;
	padding: 12px 0 0;
}

.sidebar ' . dynamik_html_markup( 'search_form' ) . ' {
	padding: 15px 0 10px 30px;
}

' . dynamik_html_markup( 'search_form_search' ) . ', #subbox, .widget_product_search input#s {
	' . $search_form_bg . '
	border: ' . $search_form_border_thickness . 'px ' . $search_form_border_style . ' #' . $search_form_border_color . ';
	width: ' . $search_form_width . 'px;
	margin: 10px 5px 0 0;
	padding: ' . $search_form_padding_top . 'px ' . $search_form_padding_right . 'px ' . $search_form_padding_bottom . 'px ' . $search_form_padding_left . 'px;
	color: #' . $search_form_font_color . ';
	font-family: ' . $search_form_font_type . ';
	font-size: ' . $search_form_font_size . ';
	-webkit-appearance: none;' . $search_form_font_css . '
}
' . $search_form_input_placeholder . '
' . dynamik_html_markup( 'nav_primary' ) . ' ' . dynamik_html_markup( 'search_form_search' ) . ' {
	margin: 2px -7px 0 0;
}

' . dynamik_html_markup( 'search_form_submit' ) . ', #subbutton, .widget_product_search input#searchsubmit {
	' . $search_button_bg . '
	border: ' . $search_button_border_thickness . 'px ' . $search_button_border_style . ' #' . $search_button_border_color . ';
	margin: 0;
	padding: ' . $search_button_padding_top . 'px ' . $search_button_padding_right . 'px ' . $search_button_padding_bottom . 'px ' . $search_button_padding_left . 'px;
	color: #' . $search_button_font_color . ';
	font-family: ' . $search_button_font_type . ';
	font-size: ' . $search_button_font_size . ';
	line-height: 19px;
	cursor: pointer;
	text-decoration: ' . $search_button_link_underline_visited . ';' . $search_button_font_css . '
}

' . dynamik_html_markup( 'search_form_submit' ) . ':hover, #subbutton:hover,  .widget_product_search input#searchsubmit:hover {
	' . $search_button_hover_bg . '
	border: ' . $search_button_hover_border_thickness . 'px ' . $search_button_hover_border_style . ' #' . $search_button_hover_border_color . ';
	color: #' . $search_button_text_hover_color . ';
	text-decoration: ' . $search_button_link_underline_hover . ';
}

.widget_product_search label {
	display: none;
}


/* eNews and Update Widget
------------------------------------------------------------ */

.enews p {
	padding: 10px 15px 5px;
}

.enews #subscribe {
	padding: 0 0 0 15px;
}

.enews #subbox {
	margin: 5px -7px 0 0;
	padding: 6px 5px;
	width: 75%;
}


/* Calendar Widget
------------------------------------------------------------ */

#wp-calendar {
	width: 100%;
	padding: 20px;
}

#wp-calendar caption {
	font-size: 14px;
	font-style: italic;
	padding: 20px 30px 0 0;
	text-align: right;
}

#wp-calendar thead {
	background-color: #F5F5F5;
	font-weight: bold;
	margin: 10px 0 0;
}

#wp-calendar td {
	background-color: #F5F5F5;
	padding: 2px;
	text-align: center;
}


/* Footer Widgets
------------------------------------------------------------ */

#footer-widgets {
	background-color: #F5F5F5;
	border-top: 1px solid #ddd;
	clear: both;
	font-size: 14px;
	margin: 0 auto;
	overflow: hidden;
	width: 100%;
}

#footer-widgets .wrap {
	overflow: hidden;
	padding: 20px 30px 10px;
}

#footer-widgets .widget {
	background: none;
	border: none;
	margin: 0 0 15px;
	padding: 0;
}

#footer-widgets .textwidget {
	padding: 0;
}

#footer-widgets .widget_tag_cloud div div {
	padding: 0;
}

#footer-widgets p {
	font-size: inherit;
	margin: 0 0 10px;
}

#footer-widgets ul {
	margin: 0;
}

#footer-widgets ul li {
	margin: 0 0 0 20px;
}

#footer-widgets #wp-calendar thead,
#footer-widgets #wp-calendar td {
	background: none;
}

.footer-widgets-1 {
	float: left;
	margin: 0 30px 0 0;
	width: 280px;
}

.footer-widgets-2 {
	float: left;
	width: 280px;
}

.footer-widgets-3 {
	float: right;
	width: 280px;
}


/* Footer
------------------------------------------------------------ */

' . dynamik_html_markup( 'site_footer' ) . ' {
	' . $footer_bg . '
	border-top: ' . $footer_top_border_thickness . 'px ' . $footer_border_style . ' #' . $footer_border_color . ';
	border-bottom: ' . $footer_bottom_border_thickness . 'px ' . $footer_border_style . ' #' . $footer_border_color . ';
	border-left: ' . $footer_lr_border_thickness . 'px ' . $footer_border_style . ' #' . $footer_border_color . ';
	border-right: ' . $footer_lr_border_thickness . 'px ' . $footer_border_style . ' #' . $footer_border_color . ';
	overflow: hidden;
	clear: both;
}

' . dynamik_html_markup( 'site_footer' ) . ' .wrap {
	margin: 0 auto;
	padding: ' . $footer_padding_top . 'px ' . $footer_padding_right . 'px ' . $footer_padding_bottom . 'px ' . $footer_padding_left . 'px;
	overflow: hidden;
}

.content-sidebar-sidebar ' . dynamik_html_markup( 'site_footer' ) . ' .wrap {
	' . $width . ': ' . $footer_width_dbl_rt_sb . 'px;
}

.sidebar-sidebar-content ' . dynamik_html_markup( 'site_footer' ) . ' .wrap {
	' . $width . ': ' . $footer_width_dbl_lft_sb . 'px;
}

.sidebar-content-sidebar ' . dynamik_html_markup( 'site_footer' ) . ' .wrap {
	' . $width . ': ' . $footer_width_dbl_sb . 'px;
}

.content-sidebar ' . dynamik_html_markup( 'site_footer' ) . ' .wrap {
	' . $width . ': ' . $footer_width_rt_sb . 'px;
}

.sidebar-content ' . dynamik_html_markup( 'site_footer' ) . ' .wrap {
	' . $width . ': ' . $footer_width_lft_sb . 'px;
}

.full-width-content ' . dynamik_html_markup( 'site_footer' ) . ' .wrap {
	' . $width . ': ' . $footer_width_no_sb . 'px;
}

' . dynamik_html_markup( 'site_footer' ) . ' p {
	color: #' . $footer_font_color . ';
	font-family: ' . $footer_font_type . ';
	font-size: ' . $footer_font_size . ';
	' . $footer_p_text_align . $footer_font_css . '
}

' . dynamik_html_markup( 'site_footer' ) . ' a,
' . dynamik_html_markup( 'site_footer' ) . ' a:visited {
	color: #' . $footer_link_color . ';
	text-decoration: ' . $footer_link_underline_visited . ';
}

' . dynamik_html_markup( 'site_footer' ) . ' a:hover {
	color: #' . $footer_link_hover_color . ';
	text-decoration: ' . $footer_link_underline_hover . ';
}

' . dynamik_html_markup( 'site_footer' ) . ' .gototop {
	float: left;
	width: ' . $footer_gototop_width . 'px;
}

' . dynamik_html_markup( 'site_footer' ) . ' .creds {
	float: right;
	text-align: right;
	width: ' . $footer_creds_width . 'px;
}


/* Comments
------------------------------------------------------------ */

#comments {
	margin: ' . $comments_margin_top . 'px 0 ' . $comments_margin_bottom . 'px;
	overflow: hidden;
}

#respond {
	margin: 0 0 15px;
	padding: 20px 0 0;
}

#comments h3,
#respond h3 {
	margin: 0 0 10px;
	color: #' . $comment_heading_font_color . ';
	font-family: ' . $comment_heading_font_type . ';
	font-size: ' . $comment_heading_font_size . ';
	font-weight: 300;
	line-height: 1.25;' . $comment_heading_font_css . '
}

#author,
#comment,
#email,
#url {
	' . $comment_form_bg . '
	border: ' . $comment_form_border_thickness . 'px ' . $comment_form_border_style . ' #' . $comment_form_border_color . ';
	width: ' . $comment_author_email_url_width . 'px;
	margin: 0 5px 10px 0;
	padding: 5px;
	color: #' . $comment_form_font_color . ';
	font-family: ' . $comment_form_font_type . ';
	font-size: ' . $comment_form_font_size . ';
	-webkit-box-shadow: 0 1px 2px #E8E8E8 inset;
	box-shadow: 0 1px 2px #E8E8E8 inset;' . $comment_form_font_css . '
}

#comment {
	width: ' . $comment_form_width . ';
	height: 150px;
	margin: 0 0 10px;
}

#commentform #submit {
	' . $comment_submit_bg . '
	border: ' . $comment_submit_border_thickness . 'px ' . $comment_submit_border_style . ' #' . $comment_submit_border_color . ';
	width: ' . $comment_submit_width . ';
	padding: ' . $submit_button_padding_top . 'px ' . $submit_button_padding_right . 'px ' . $submit_button_padding_bottom . 'px ' . $submit_button_padding_left . 'px;
	color: #' . $comment_submit_font_color . ';
	font-family: ' . $comment_submit_font_type . ';
	font-size: ' . $comment_submit_font_size . ';
	line-height: 19px;
	cursor: pointer;
	text-decoration: ' . $comment_submit_link_underline_visited . ';' . $comment_submit_font_css . '
}

#commentform #submit:hover {
	' . $comment_submit_hover_bg . '
	border: ' . $comment_submit_hover_border_thickness . 'px ' . $comment_submit_hover_border_style . ' #' . $comment_submit_hover_border_color . ';
	color: #' . $comment_submit_text_hover_color . ';
	text-decoration: ' . $comment_submit_link_underline_hover . ';
}

.comment-author {
	color: #' . $comment_author_font_color . ';
	font-family: ' . $comment_author_font_type . ';
}

' . dynamik_html_markup( 'comment_author_link' ) . ',
.comment-author .says {
	font-size: ' . $comment_author_font_size . ';' . $comment_author_font_css . '
}

' . dynamik_html_markup( 'comment_author_link' ) . ' a, ' . dynamik_html_markup( 'comment_author_link' ) . ' a:visited {
	color: #' . $comment_author_link_color . ';
	text-decoration: ' . $comment_author_link_underline_visited . ';
}

' . dynamik_html_markup( 'comment_author_link' ) . ' a:hover {
	color: #' . $comment_author_link_hover_color . ';
	text-decoration: ' . $comment_author_link_underline_hover . ';
}

.ping-list {
	margin: 0 0 40px;
}

.comment-list ol,
.ping-list ol {
	padding: 10px;
}

.comment-list li,
.ping-list li {
	border-top: ' . $comment_list_top_border_thickness . 'px ' . $comment_list_border_style . ' #' . $comment_list_border_color . ';
	border-bottom: ' . $comment_list_bottom_border_thickness . 'px ' . $comment_list_border_style . ' #' . $comment_list_border_color . ';
	border-left: ' . $comment_list_left_border_thickness . 'px ' . $comment_list_border_style . ' #' . $comment_list_border_color . ';
	border-right: ' . $comment_list_right_border_thickness . 'px ' . $comment_list_border_style . ' #' . $comment_list_border_color . ';
	margin: ' . $comment_list_margin_top . 'px 0 ' . $comment_list_margin_bottom . 'px;
	padding: ' . $comment_list_padding_top . 'px ' . $comment_list_padding_right . 'px ' . $comment_list_padding_bottom . 'px ' . $comment_list_padding_left . 'px;
	font-weight: bold;
	list-style-type: none;
}

.comment-list li .avatar {
	' . $comment_avatar_bg . '
	border: ' . $comment_avatar_border_thickness . 'px ' . $comment_avatar_border_style . ' #' . $comment_avatar_border_color . ';
	width: ' . $comment_avatar_size . 'px;
	height: ' . $comment_avatar_size . 'px;
	margin: 5px 0 0 10px;
	padding: ' . $comment_avatar_padding . 'px;
	float: right;
}

.comment-list li ul li {
	' . $comment_reply_bg . '
	margin-right: -16px;
	list-style-type: none;
}

.comment-content p {
	margin: 0 0 20px;
}

.comment-content p,
#respond p {
	color: #' . $comment_body_font_color . ';
	font-family: ' . $comment_body_font_type . ';
	font-size: ' . $comment_body_font_size . ';
	font-weight: 300;' . $comment_body_font_css . '
}

.comment-notes {
	margin: 0 0 10px;
}

#respond label {
	' . dynamik_html_markup( 'respond_label' ) . '
}

.comment-list cite,
.ping-list cite {
	font-style: normal;
	font-weight: normal;
}

' . dynamik_html_markup( 'comment_meta' ) . ',
.comment-edit-link {
	margin: 0 0 5px;
	color: #' . $comment_meta_link_color . ';
	font-family: ' . $comment_meta_font_type . ';
	font-size: ' . $comment_meta_font_size . ';
	font-weight: normal;' . $comment_meta_font_css . '
}

' . dynamik_html_markup( 'comment_meta' ) . ' a,
' . dynamik_html_markup( 'comment_meta' ) . ' a:visited,
.comment-edit-link a,
.comment-edit-link a:visited {
	color: #' . $comment_meta_link_color . ' !important;
	text-decoration: ' . $comment_meta_link_underline_visited . ' !important;
}

' . dynamik_html_markup( 'comment_meta' ) . ' a:hover,
.comment-edit-link a:hover {
	color: #' . $comment_meta_link_hover_color . ' !important;
	text-decoration: ' . $comment_meta_link_underline_hover . ' !important;
}

a.comment-reply-link,
a.comment-reply-link:visited {
	' . $comment_reply_text_bg . '
	border-top: ' . $comment_reply_text_top_border_thickness . 'px ' . $comment_reply_text_border_style . ' #' . $comment_reply_text_border_color . ';
	border-bottom: ' . $comment_reply_text_bottom_border_thickness . 'px ' . $comment_reply_text_border_style . ' #' . $comment_reply_text_border_color . ';
	border-left: ' . $comment_reply_text_left_border_thickness . 'px ' . $comment_reply_text_border_style . ' #' . $comment_reply_text_border_color . ';
	border-right: ' . $comment_reply_text_right_border_thickness . 'px ' . $comment_reply_text_border_style . ' #' . $comment_reply_text_border_color . ';
	padding: ' . $comment_reply_text_padding_top . 'px ' . $comment_reply_text_padding_right . 'px ' . $comment_reply_text_padding_bottom . 'px ' . $comment_reply_text_padding_left . 'px;
	color: #' . $comment_reply_text_link_color . ';
	font-family: ' . $comment_reply_text_font_type . ';
	font-size: ' . $comment_reply_text_font_size . ';
	font-weight: 300;
	text-decoration: ' . $comment_reply_text_link_underline_visited . ';' . $comment_reply_text_font_css . '
}

a.comment-reply-link:hover {
	' . $comment_reply_text_hover_bg . '
	border-top: ' . $comment_reply_text_hover_top_border_thickness . 'px ' . $comment_reply_text_hover_border_style . ' #' . $comment_reply_text_hover_border_color . ';
	border-bottom: ' . $comment_reply_text_hover_bottom_border_thickness . 'px ' . $comment_reply_text_hover_border_style . ' #' . $comment_reply_text_hover_border_color . ';
	border-left: ' . $comment_reply_text_hover_left_border_thickness . 'px ' . $comment_reply_text_hover_border_style . ' #' . $comment_reply_text_hover_border_color . ';
	border-right: ' . $comment_reply_text_hover_right_border_thickness . 'px ' . $comment_reply_text_hover_border_style . ' #' . $comment_reply_text_hover_border_color . ';
	color: #' . $comment_reply_text_link_hover_color . ';
	text-decoration: ' . $comment_reply_text_link_underline_hover . ';
}

.comment-content a,
.comment-content a:visited,
#comments .navigation a,
#comments .navigation a:visited,
#respond a,
#respond a:visited {
	color: #' . $comment_link_color . ';
	text-decoration: ' . $comment_link_underline_visited . ';
}

.comment-content a:hover,
#comments .navigation a:hover,
#respond a:hover {
	color: #' . $comment_link_hover_color . ';
	text-decoration: ' . $comment_link_underline_hover . ';
}

.nocomments {
	text-align: center;
}

#comments .navigation {
	padding: ' . $comments_nav_padding_top . 'px 0 ' . $comments_nav_padding_bottom . 'px;
	display: block;
}

.thread-even {
	' . $comment_even_bg . '
}

.thread-alt {
	' . $comment_alt_bg . '
}

.form-allowed-tags {
	' . $comment_form_allowed_tags_bg . '
	border: ' . $comment_form_allowed_tags_border_thickness . 'px ' . $comment_form_allowed_tags_border_style . ' #' . $comment_form_allowed_tags_border_color . ';
	margin: ' . $comment_form_allowed_tags_margin_top . 'px 0 ' . $comment_form_allowed_tags_margin_bottom . 'px;
	padding: ' . $comment_form_allowed_tags_padding_top . 'px ' . $comment_form_allowed_tags_padding_right . 'px ' . $comment_form_allowed_tags_padding_bottom . 'px ' . $comment_form_allowed_tags_padding_left . 'px;
}

#respond p.form-allowed-tags {
	color: #' . $comment_form_allowed_tags_font_color . ';
	font-family: ' . $comment_form_allowed_tags_font_type . ';
	font-size: ' . $comment_form_allowed_tags_font_size . ';' . $comment_form_allowed_tags_font_css . '
}


/* BuddyPress
------------------------------------------------------------ */

div.item-list-tabs {
	margin: 25px 0 20px;
}

div.item-list-tabs' . dynamik_html_markup( 'nav_secondary' ) . ' {
	margin: -15px 0 15px;
}

.padder div.pagination {
	margin: -20px 0 0;
}

form#whats-new-form textarea {
	width: 97%;
}

table.forum {
	margin: 0;
}

table.forum tr > td:first-child,
table.forum tr > th:first-child {
	padding: 10px 15px;
}

ul#topic-post-list p {
	padding: 0 0 20px;
}

div.dir-search {
	margin: -29px 0 0;
}

ul.button-nav li,
div#item-header ul li,
ul.item-list li {
	list-style: none;
}

ul#topic-post-list {
	margin: 0 0 15px;
}

#post-topic-reply {
	margin: 15px 0 0;
}

' . dynamik_html_markup( 'sidebar_primary' ) . ' .item-options,
' . dynamik_html_markup( 'sidebar_secondary' ) . ' .item-options,
' . dynamik_html_markup( 'sidebar_primary' ) . ' .avatar-block,
' . dynamik_html_markup( 'sidebar_secondary' ) . ' .avatar-block {
	padding: 10px 10px 0;
}

' . dynamik_html_markup( 'sidebar_primary' ) . ' ul.item-list .vcard,
' . dynamik_html_markup( 'sidebar_secondary' ) . ' ul.item-list .vcard,
' . dynamik_html_markup( 'sidebar_primary' ) . ' .avatar-block,
' . dynamik_html_markup( 'sidebar_secondary' ) . ' .avatar-block {
	overflow: auto;
}

' . dynamik_html_markup( 'sidebar_primary' ) . ' a img.avatar,
' . dynamik_html_markup( 'sidebar_secondary' ) . ' a img.avatar {
	background: #F6F6F6;
	margin: 0 10px 10px 0;
	padding: 5px;
	float: left;
}

' . dynamik_html_markup( 'sidebar_primary' ) . ' ul.item-list,
' . dynamik_html_markup( 'sidebar_secondary' ) . ' ul.item-list {
	width: auto;
	padding: 0 10px;
}

#primary ul.item-list,
#primary ul.item-list li {
	list-style-type: none;
}

.widget-error {
	padding: 10px;
}


/* BBPress
------------------------------------------------------------ */

.bbPress ' . dynamik_html_markup( 'content' ) . ' .hentry p {
	padding: 0;
}

.bbPress ' . dynamik_html_markup( 'content' ) . ' .hentry ul li p {
	padding: 0 0 20px;
}

.bbPress ' . dynamik_html_markup( 'content' ) . ' .hentry ul {
	padding: 0;
}

.bbPress ' . dynamik_html_markup( 'content' ) . ' .hentry ul li {
	margin: 0;
	list-style: none;
}

.bbPress .post-format-icon {
	display: none;
}
' . $retina_logo_media_query;

	$minify_css = dynamik_get_design( 'minify_css' );
	if( file_exists( dynamik_get_active_skin_folder_path() . '/style.css' ) && ( !empty( $minify_css ) || $child = 'yes' ) )
	{
		$skin_styles = file_get_contents( dynamik_get_active_skin_folder_path() . '/style.css' );
		
		$css .= "\n" . '
/* Active Dynamik Skin Custom Styles
------------------------------------------------------------ */

' . dynamik_skin_css_images_converter( $skin_styles ) . "\n";
	}

	if( !empty( $dynamik_custom_labels ) )
	{
		foreach( $dynamik_custom_labels as $key => $value )
		{
			if( substr( $value['label_id'], 0, 6 ) == 'width-' && is_numeric( substr( $value['label_id'], 6, 2 ) ) )
			{
				$label_id_split_dashes = explode( '-', $value['label_id'] );

				if( substr_count( $value['label_id'], '-' ) == 3 )
				{
					$label_sb1_active = true;
					$label_sb2_active = true;
					$label_cc_width = $label_id_split_dashes[1];
					$label_sb1_width = $label_id_split_dashes[2];
					$label_sb2_width = $label_id_split_dashes[3];
					$label_total_width = $label_cc_width + $label_sb1_width + $label_sb2_width;
					$label_width_content_sb_wrap = $label_pre_width_content_sb_wrap_dbl_sb + $label_cc_width + $label_sb1_width;
					$label_width_inner = $label_pre_width_inner_dbl_sb + $label_total_width;
					if( $wrap_structure == 'fluid' ) {
						$label_width_wrap = '100%';
					} else {
						$label_width_wrap = $label_pre_width_wrap_dbl_sb + $label_total_width . 'px';
					}
					$label_width_header = $label_pre_width_header_dbl_sb + $label_total_width;
					$label_width_nav1 = $label_pre_width_nav1_dbl_sb + $label_total_width;
					$label_width_nav2 = $label_pre_width_nav2_dbl_sb + $label_total_width;
					$label_width_footer = $label_pre_width_footer_dbl_sb + $label_total_width;
				}
				elseif( substr_count( $value['label_id'], '-' ) == 2 )
				{
					$label_sb1_active = true;
					$label_sb2_active = false;
					$label_cc_width = $label_id_split_dashes[1];
					$label_sb1_width = $label_id_split_dashes[2];
					$label_sb2_width = 0;
					$label_total_width = $label_cc_width + $label_sb1_width + $label_sb2_width;
					$label_width_content_sb_wrap = $label_pre_width_content_sb_wrap_single_sb + $label_total_width;
					$label_width_inner = $label_pre_width_inner_single_sb + $label_total_width;
					if( $wrap_structure == 'fluid' ) {
						$label_width_wrap = '100%';
					} else {
						$label_width_wrap = $label_pre_width_wrap_single_sb + $label_total_width . 'px';
					}
					$label_width_header = $label_pre_width_header_single_sb + $label_total_width;
					$label_width_nav1 = $label_pre_width_nav1_single_sb + $label_total_width;
					$label_width_nav2 = $label_pre_width_nav2_single_sb + $label_total_width;
					$label_width_footer = $label_pre_width_footer_single_sb + $label_total_width;
				}
				else
				{
					$label_sb1_active = false;
					$label_sb2_active = false;
					$label_cc_width = $label_id_split_dashes[1];
					$label_sb1_width = 0;
					$label_sb2_width = 0;
					$label_total_width = $label_cc_width + $label_sb1_width + $label_sb2_width;
					$label_width_content_sb_wrap = $label_pre_width_content_sb_wrap_no_sb + $label_total_width;
					$label_width_inner = $label_pre_width_inner_no_sb + $label_total_width;
					if( $wrap_structure == 'fluid' ) {
						$label_width_wrap = '100%';
					} else {
						$label_width_wrap = $label_pre_width_wrap_no_sb + $label_total_width . 'px';
					}
					$label_width_header = $label_pre_width_header_no_sb + $label_total_width;
					$label_width_nav1 = $label_pre_width_nav1_no_sb + $label_total_width;
					$label_width_nav2 = $label_pre_width_nav2_no_sb + $label_total_width;
					$label_width_footer = $label_pre_width_footer_no_sb + $label_total_width;
				}

				$css .= '

/* Custom Label ' . $value['label_name'] . '
------------------------------------------------------------ */

.label-' . $value['label_id'] . ' ' . dynamik_html_markup( 'site_container' ) . ' {
	' . $width . ': ' . $label_width_wrap . ';
}

.label-' . $value['label_id'] . ' ' . dynamik_html_markup( 'site_header' ) . ' .wrap {
	width: ' . $label_width_header . 'px;
}

.label-' . $value['label_id'] . ' .menu-primary {
	width: ' . $label_width_nav1 . 'px;
}

.label-' . $value['label_id'] . ' .menu-secondary {
	width: ' . $label_width_nav2 . 'px;
}

.label-' . $value['label_id'] . ' ' . dynamik_html_markup( 'site_inner' ) . ' {
	' . $width . ': ' . $label_width_inner . 'px;
}

.label-' . $value['label_id'] . ' ' . dynamik_html_markup( 'content_sidebar_wrap' ) . ' {
	width: ' . $label_width_content_sb_wrap . 'px;
}

.label-' . $value['label_id'] . ' ' . dynamik_html_markup( 'content' ) . ' {
	width: ' . $label_cc_width . 'px;
}
';

				if( $label_sb1_active )
				{
					$css .= '
.label-' . $value['label_id'] . ' ' . dynamik_html_markup( 'sidebar_primary' ) . ' {
	width: ' . $label_sb1_width . 'px;
}
';
				}

				if( $label_sb2_active )
				{
					$css .= '
.label-' . $value['label_id'] . ' ' . dynamik_html_markup( 'sidebar_secondary' ) . ' {
	width: ' . $label_sb2_width . 'px;
}
';
				}

				$css .= '
.label-' . $value['label_id'] . ' ' . dynamik_html_markup( 'site_footer' ) . ' .wrap {
	' . $width . ': ' . $label_width_footer . 'px;
}
';
			}
		}
	}

	if( dynamik_get_settings( 'responsive_enabled' ) )
	{
		$css .= "\n" . '
/* Default Responsive Styles
------------------------------------------------------------ */
';

		$css .= '
@media screen and (min-device-width: 320px) and (max-device-width: 1024px)
{
/* CSS for iPhone and iPad only */
html { -webkit-text-size-adjust: none; /* Prevent font scaling in landscape */ }
}

@media only screen and (max-width: ' . dynamik_get_responsive( 'media_query_large_cascading_width' ) . 'px) {
' . $wrap_mq_first . $header_mq_first . $navbar_mq_first . $content_mq_first . $ez_mq_first . $footer_mq_first . $media_query_large_cascading_content . '
}

@media only screen and (min-width: ' . dynamik_get_responsive( 'dynamik_media_query_large_min_width' ) . 'px) and (max-width: ' . dynamik_get_responsive( 'dynamik_media_query_large_max_width' ) . 'px) {
' . $header_mq_second . $navbar_mq_second . $content_mq_second . $media_query_large_content . '
}

@media only screen and (min-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_large_min_width' ) . 'px) and (max-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_large_max_width' ) . 'px) {
' . $navbar_mq_third . $content_mq_third . $media_query_medium_large_content . '
}

@media only screen and (max-width: ' . dynamik_get_responsive( 'media_query_medium_cascading_width' ) . 'px) {
' . $header_mq_fourth . $navbar_mq_fourth . $content_mq_fourth . $ez_mq_fourth . $media_query_medium_cascading_content . '
}

@media only screen and (min-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_min_width' ) . 'px) and (max-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_max_width' ) . 'px) {
' . $navbar_mq_fifth . $media_query_medium_content . '
}

@media only screen and (max-width: ' . dynamik_get_responsive( 'media_query_small_width' ) . 'px) {
' . $navbar_mq_sixth . $content_mq_sixth . $media_query_small_content . '
}';
	}
	
	return $css;
}

/**
 * Build the Custom stylesheet file.
 *
 * @since 1.0
 */
function dynamik_build_custom_styles()
{
	$css = '/* ' . __( 'Custom CSS', 'dynamik' ) . "\n" . '------------------------------------------------------------ */' . "\n";

	if( dynamik_get_settings( 'responsive_enabled' ) )
	{
		$css .= dynamik_get_custom_css( 'custom_css' );
		
		$css .= "\n\n" . '/* ' . __( 'Custom Responsive CSS', 'dynamik' ) . "\n" . '------------------------------------------------------------ */';
		$css .= '
@media only screen and (max-width: ' . dynamik_get_responsive( 'media_query_large_cascading_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_large_cascading_content' ) . '
}

@media only screen and (min-width: ' . dynamik_get_responsive( 'dynamik_media_query_large_min_width' ) . 'px) and (max-width: ' . dynamik_get_responsive( 'dynamik_media_query_large_max_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_large_content' ) . '
}

@media only screen and (min-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_large_min_width' ) . 'px) and (max-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_large_max_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_medium_large_content' ) . '
}

@media only screen and (max-width: ' . dynamik_get_responsive( 'media_query_medium_cascading_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_medium_cascading_content' ) . '
}

@media only screen and (min-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_min_width' ) . 'px) and (max-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_max_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_medium_content' ) . '
}

@media only screen and (max-width: ' . dynamik_get_responsive( 'media_query_small_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_small_content' ) . '
}';
	}
	else
	{
		$css = dynamik_get_custom_css( 'custom_css' );
	}
	
	return $css;
}

/**
 * Build the font-size: values bases on either the px or rem unit setting.
 *
 * @since 1.3
 */
function dynamik_build_font_size( $font_key )
{
	// Build the $font_size_key based on either the $font_key alone or with the addition
	// of 'content_heading_' to accomodate the different naming convention of the Content Headings
	$font_size_key = substr( $font_key, -2, 1 ) == 'h' ? 'content_heading_' . $font_key . '_font_size' : $font_key . '_font_size';

	// Build the $font_size_styles according to the font unit currently assigned to that font size
	if( dynamik_get_design( 'universal_px_em' ) == 'em' )
		$font_size_styles = ( dynamik_get_design( $font_size_key ) * 10 ) . 'px; font-size: ' . dynamik_get_design( $font_size_key ) . 'rem';
	else
		$font_size_styles = dynamik_get_design( $font_size_key ) . 'px';

	return $font_size_styles;
}
