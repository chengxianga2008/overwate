<?php
/**
 * Builds the font option lists as well as handels the
 * enqueueing of Google fonts.
 *
 * @package Dynamik
 */

/**
 * Build Google fonts string.
 *
 * @since 1.5
 * @return a string of Google fonts, if any are currently selected.
 */
function dynamik_build_google_fonts_string()
{
	$dynamik_google_font_array = dynamik_font_types_array( $type = 'google' );
	$google_fonts = '';
	$subsets = '';
	
	if( is_array( dynamik_get_design( 'font_type' ) ) )
	{
		foreach( $dynamik_google_font_array as $google_font => $google_font_data )
		{
			if( in_array( $google_font, dynamik_get_design( 'font_type' ) ) )
			{
				if( strpos( $google_font_data['url_string'], '&' ) !== false )
					$google_font_data['url_string'] = substr( $google_font_data['url_string'], 0, strpos( $google_font_data['url_string'], '&' ) );

				$google_fonts .= $google_font_data['url_string'] . '|';
				if( $google_font_data['subset'] != '' )
					$subsets .= $google_font_data['subset'] . ',';
			}
		}
	}
	
	if( !empty( $google_fonts ) && $subsets != '' )
	{
		$subsets = implode( ',', array_unique( explode( ',', $subsets ) ) );
		return rtrim( $google_fonts, '|' ) . '&subset=' . rtrim( $subsets, ',' );
	}
	elseif( !empty( $google_fonts ) && $subsets == '' )
		return rtrim( $google_fonts, '|' );
	else
		return false;
}

add_action( 'wp_enqueue_scripts', 'dynamik_enqueue_google_fonts' );
/**
 * Enqueue Google fonts.
 *
 * @since 1.5
 * @return an enqueue of Google fonts, if any are currently selected.
 */
function dynamik_enqueue_google_fonts()
{
	$google_fonts = dynamik_build_google_fonts_string();
	$google_fonts_enqueue = '';
	
	if( !empty( $google_fonts ) )
	{
		$google_fonts_enqueue = wp_enqueue_style( 'dynamik_enqueued_google_fonts', '//fonts.googleapis.com/css?family=' . $google_fonts, array(), CHILD_THEME_VERSION );
	}
	
	return $google_fonts_enqueue;
}

/**
 * Build the Dynamik font menu HTML.
 *
 * @since 1.0
 */
function dynamik_build_font_menu( $selected = '', $builder = false )
{
	if( false != $builder )
		$dynamik_fonts_array = dynamik_fonts_array( $builder_menu = true );
	else
		$dynamik_fonts_array = dynamik_fonts_array();
	
	foreach( $dynamik_fonts_array as $font_type => $fonts )
	{
		echo '<optgroup label="' . $font_type . ' -------">';
		foreach( $fonts as $font_slug => $font_data )
		{
			$option = '<option value="' . $font_data . '"';
				
			if( $font_data == $selected )
			{
				$option .= ' selected="selected"';
			}
			
			if( $font_type == 'Google Fonts' )
			{
				$gee = ' [G]';
			}
			
			if( !empty( $gee ) )
			{
				$option .= '>' . $font_slug . $gee . '</option>';
			}
			else
			{
				$option .= '>' . $font_slug . '</option>';
			}
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Create an array of Dynamik fonts.
 *
 * @since 1.0
 * @return an array of Dynamik fonts.
 */
function dynamik_fonts_array( $builder_menu = false )
{
	$dynamik_standard_fonts_array = dynamik_font_types_array( $type = 'standard' );

	foreach( $dynamik_standard_fonts_array as $dynamik_standard_font => $value )
	{
		if( false != $builder_menu )
			$dynamik_standard_fonts_array[$dynamik_standard_font] = $value;
		else
			$dynamik_standard_fonts_array[$dynamik_standard_font] = $dynamik_standard_font;
	}

	$dynamik_google_fonts_array = dynamik_font_types_array( $type = 'google' );
	
	foreach( $dynamik_google_fonts_array as $dynamik_google_font => $value )
	{
		if( false != $builder_menu )
			$dynamik_google_fonts_array[$dynamik_google_font] = $value['value'];
		else
			$dynamik_google_fonts_array[$dynamik_google_font] = $dynamik_google_font;
	}
	
	$dynamik_fonts_array = array(
		"Standard Fonts" => $dynamik_standard_fonts_array,
		"Google Fonts" => $dynamik_google_fonts_array
	);
	
	return $dynamik_fonts_array;
}

/**
 * Create an array of Google fonts based on the specified type.
 *
 * @since 1.5
 * @return an array of Google fonts.
 */
function dynamik_font_types_array( $type = 'all' )
{
	$dynamik_font_types_array = array();
	$dynamik_google_fonts_array = array();

	$dynamik_standard_fonts_array = array(
		"Arial" => "Arial, sans-serif",
		"Arial Black" => "'Arial Black', sans-serif",
		"Courier New" => "'Courier New', sans-serif",
		"Georgia" => "Georgia, serif",
		"Helvetica" => "Helvetica, sans-serif",
		"Impact" => "Impact, sans-serif",
		"Lucida Console" => "'Lucida Console', sans-serif",
		"Lucida Sans Unicode" => "'Lucida Sans Unicode', sans-serif",
		"Tahoma" => "Tahoma, sans-serif",
		"Times New Roman" => "'Times New Roman', serif",
		"Trebuchet MS" => "'Trebuchet MS', sans-serif",
		"Verdana" => "Verdana, sans-serif"
	);

	$current_google_fonts = dynamik_get_design( 'add_google_fonts' );
	$current_google_fonts_array_pre = preg_split( '/\\] \\[|\\[|\\]/', $current_google_fonts, -1, PREG_SPLIT_NO_EMPTY );
	$current_google_fonts_array = array_filter( array_map( 'trim', $current_google_fonts_array_pre ), 'strlen' );
	foreach( $current_google_fonts_array as $current_google_font )
	{
		$google_font_pieces = explode( '|', $current_google_font );
  		
  		$subset = '';
		if( ( $pos = strpos( $google_font_pieces[1], '=' ) ) !== FALSE )
		    $subset = substr( $google_font_pieces[1], $pos + 1 ); 

		$dynamik_google_fonts_array[$google_font_pieces[0]] = array(
			"value" => $google_font_pieces[2],
			"url_string" => $google_font_pieces[1],
			"subset" => $subset
		);
	}
	
	if( $type == 'standard' )
	{
		$dynamik_font_types_array = $dynamik_standard_fonts_array;
	}
	elseif( $type == 'google' )
	{
		$dynamik_font_types_array = $dynamik_google_fonts_array;
	}
	else
	{
		foreach( $dynamik_google_fonts_array as $dynamik_google_font => $value )
		{
			$dynamik_google_fonts_array[$dynamik_google_font] = $value['value'];
		}
		$dynamik_font_types_array = array_merge( $dynamik_standard_fonts_array, $dynamik_google_fonts_array );
	}

	return $dynamik_font_types_array;
}
