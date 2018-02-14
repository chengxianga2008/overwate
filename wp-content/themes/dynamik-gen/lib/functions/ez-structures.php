<?php
/**
 * Build and Write the EZ Widget Area Structures.
 *
 * @package Dynamik
 */

function ez_home_widget_reg( $number = '', $row_title = '', $row = '' )
{
	if( dynamik_get_design( 'dynamik_homepage_type' ) == 'static_home' )
	{
		$ez_home_widget_reg = "
genesis_register_sidebar( array (
	'name'	=>	'EZ Home " . $row_title. " #" . $number . "',
	'id' 	=> 	'dynamik_ez_home_" . $row . "_" . $number . "'
) );
		";
	}
	else
	{
		$ez_home_widget_reg = "";
	}
			
	return $ez_home_widget_reg;
}

function ez_home_sidebar_widget_reg()
{
	if( dynamik_get_design( 'dynamik_homepage_type' ) == 'static_home' && dynamik_get_design( 'ez_static_home_sb_display' ) )
	{
		$ez_home_sidebar_widget_reg = "
genesis_register_sidebar( array (
	'name'	=>	'EZ Home Sidebar',
	'id' 	=> 	'dynamik_ez_home_sidebar'
) );
		";
	}
	else
	{
		$ez_home_sidebar_widget_reg = "";
	}
			
	return $ez_home_sidebar_widget_reg;
}

function ez_home_slider_widget_reg()
{
	if( dynamik_get_design( 'ez_home_slider_display' ) )
	{
		$ez_home_slider_widget_reg = "
genesis_register_sidebar( array (
	'name'	=>	'EZ Home Slider',
	'id' 	=> 	'dynamik_ez_home_slider'
) );
		";
	}
	else
	{
		$ez_home_slider_widget_reg = "";
	}
			
	return $ez_home_slider_widget_reg;
}

function ez_feature_top_widget_reg( $number = '' )
{
	if( dynamik_get_design( 'ez_feature_top_select' ) != 'disabled' )
	{
		$ez_feature_top_widget_reg = "
genesis_register_sidebar( array (
	'name'	=>	'EZ Feature Top " . $number . "',
	'id' 	=> 	'dynamik_ez_feature_top_" . $number . "'
) );
		";
	}
	else
	{
		$ez_feature_top_widget_reg = "";
	}
			
	return $ez_feature_top_widget_reg;
}

function ez_fat_footer_widget_reg( $number = '' )
{
	if( dynamik_get_design( 'ez_fat_footer_select' ) != 'disabled' )
	{
		$ez_fat_footer_widget_reg = "
genesis_register_sidebar( array (
	'name'	=>	'EZ Fat Footer " . $number . "',
	'id' 	=> 	'dynamik_ez_fat_footer_" . $number . "'
) );
		";
	}
	else
	{
		$ez_fat_footer_widget_reg = "";
	}
			
	return $ez_fat_footer_widget_reg;
}

function ez_home_widget( $number = '', $class = '', $row_title = '', $row = '', $single_row = false )
{
	$single_quote = "'";
	
	if( $number == '1' )
	{
		if( $row == 'top' )
		{
			$ez_home_bottom = $single_row ? ' ez-home-bottom' : '';
			$opening_div = '
		<div id="ez-home-top-container" class="ez-home-container-area' . $ez_home_bottom . ' clearfix">

			<div class="ez-home-wrap clearfix">
			';
		}
		elseif( $row == 'middle' )
		{
			$opening_div = '
		<div id="ez-home-middle-container" class="ez-home-container-area clearfix">

			<div class="ez-home-wrap clearfix">
			';
		}
		elseif( $row == 'bottom' )
		{
			$opening_div = '
		<div id="ez-home-bottom-container" class="ez-home-container-area ez-home-bottom clearfix">

			<div class="ez-home-wrap clearfix">
			';
		}
	}
	else
	{
		$opening_div = '';
	}
	
	$ez_home_widget = $opening_div . '
				<div id="ez-home-' . $row . '-' . $number . '" class="widget-area ez-widget-area ' . $class . '">
					<?php if ( ! dynamic_sidebar( ' . $single_quote . 'EZ Home ' . $row_title . ' #' . $number . '' . $single_quote . ' ) ) { ?>
						<div class="widget">
							<h4><?php _e( ' . $single_quote . 'EZ Home ' . $row_title . ' #' . $number . '' . $single_quote . ', ' . $single_quote . 'dynamik' . $single_quote . ' ); ?></h4>
							<p><?php printf( __( ' . $single_quote . 'This is Dynamik Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.' . $single_quote . ', "dynamik" ), admin_url( "widgets.php" ) ); ?></p>
						</div>			
					<?php } ?>
				</div><!-- end #ez-home-' . $row . '-' . $number . ' -->
	';
					
	return $ez_home_widget;
}

function ez_feature_top_widget( $number = '', $class = '' )
{
	$single_quote = "'";
	
	$ez_feature_top_widget = '
	
			<div id="ez-feature-top-' . $number . '" class="widget-area ez-widget-area ' . $class . '">
				<?php if ( ! dynamic_sidebar( ' . $single_quote . 'EZ Feature Top #' . $number . '' . $single_quote . ' ) ) { ?>
					<div class="widget">
						<h4><?php _e( ' . $single_quote . 'EZ Feature Top #' . $number . '' . $single_quote . ', ' . $single_quote . 'dynamik' . $single_quote . ' ); ?></h4>
						<p><?php printf( __( ' . $single_quote . 'This is Dynamik Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.' . $single_quote . ', "dynamik" ), admin_url( "widgets.php" ) ); ?></p>
					</div>			
				<?php } ?>
			</div><!-- end #feature-top-' . $number . ' -->';
					
	return $ez_feature_top_widget;
}

function ez_fat_footer_widget( $number = '', $class = '' )
{
	$single_quote = "'";
	
	$ez_fat_footer_widget = '
	
			<div id="ez-fat-footer-' . $number . '" class="widget-area ez-widget-area ' . $class . '">
				<?php if ( ! dynamic_sidebar( ' . $single_quote . 'EZ Fat Footer #' . $number . '' . $single_quote . ' ) ) { ?>
					<div class="widget">
						<h4><?php _e( ' . $single_quote . 'EZ Fat Footer #' . $number . '' . $single_quote . ', ' . $single_quote . 'dynamik' . $single_quote . ' ); ?></h4>
						<p><?php printf( __( ' . $single_quote . 'This is Dynamik Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.' . $single_quote . ', "dynamik" ), admin_url( "widgets.php" ) ); ?></p>
					</div>			
				<?php } ?>
			</div><!-- end #fat-footer-' . $number . ' -->';
					
	return $ez_fat_footer_widget;
}
		
function build_ez_structures()
{
	$single_quote = "'";
	$ez_home_top_widget_reg = '';
	$ez_home_top_widgets = '';
	$ez_home_middle_widget_reg = '';
	$ez_home_middle_widgets = '';
	$ez_home_bottom_widget_reg = '';
	$ez_home_bottom_widgets = '';
	$ez_feature_top_widget_reg = '';
	$ez_feature_top_widgets = '';
	$ez_fat_footer_widget_reg = '';
	$ez_fat_footer_widgets = '';
	
	switch ( strlen( dynamik_get_design( 'ez_homepage_select' ) ) )
	{
		case '9':
			switch ( substr( dynamik_get_design( 'ez_homepage_select' ), -1 ) )
			{
				case '1':
					$ez_home_top_widget_reg = 
ez_home_widget_reg( '1', 'Top', 'top' );
					$ez_home_top_widgets = 
ez_home_widget( '1', 'ez-only', 'Top', 'top', true ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-top-container -->
		';
					break;
				case '2':
					$ez_home_top_widget_reg = 
ez_home_widget_reg( '1', 'Top', 'top' ) . ez_home_widget_reg( '2', 'Top', 'top' );
					$ez_home_top_widgets = 
ez_home_widget( '1', 'one-half first', 'Top', 'top', true ) . ez_home_widget( '2', 'one-half', 'Top', 'top' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-top-container -->
		';
					break;
				case '3':
					$ez_home_top_widget_reg = 
ez_home_widget_reg( '1', 'Top', 'top' ) . ez_home_widget_reg( '2', 'Top', 'top' ) . ez_home_widget_reg( '3', 'Top', 'top' );
					$ez_home_top_widgets = 
ez_home_widget( '1', 'one-third first', 'Top', 'top', true ) . ez_home_widget( '2', 'one-third', 'Top', 'top' ) . ez_home_widget( '3', 'one-third', 'Top', 'top' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-top-container -->
		';
					break;
			}
			break;
		case '11':
		case '14':
			switch ( substr( dynamik_get_design( 'ez_homepage_select' ), -3, -2 ) )
			{
				case '1':
					$ez_home_top_widget_reg = 
ez_home_widget_reg( '1', 'Top', 'top' );
					$ez_home_top_widgets = 
ez_home_widget( '1', 'ez-only', 'Top', 'top' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-top-container -->
		';
					break;
				case '2':
					switch ( substr( dynamik_get_design( 'ez_homepage_select' ), -5, -4 ) )
					{
						case 'l':
							$widget_1_class = 'two-thirds';
							$widget_2_class = 'one-third';
							break;
						case 'r':
							$widget_1_class = 'one-third';
							$widget_2_class = 'two-thirds';
							break;
						default:
							$widget_1_class = 'one-half';
							$widget_2_class = 'one-half';
							break;
					}
					$ez_home_top_widget_reg = 
ez_home_widget_reg( '1', 'Top', 'top' ) . ez_home_widget_reg( '2', 'Top', 'top' );
					$ez_home_top_widgets = 
ez_home_widget( '1', $widget_1_class . ' first', 'Top', 'top' ) . ez_home_widget( '2', $widget_2_class, 'Top', 'top' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-top-container -->
		';
					break;
				case '3':
					$ez_home_top_widget_reg = 
ez_home_widget_reg( '1', 'Top', 'top' ) . ez_home_widget_reg( '2', 'Top', 'top' ) . ez_home_widget_reg( '3', 'Top', 'top' );
					$ez_home_top_widgets = 
ez_home_widget( '1', 'one-third first', 'Top', 'top' ) . ez_home_widget( '2', 'one-third', 'Top', 'top' ) . ez_home_widget( '3', 'one-third', 'Top', 'top' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-top-container -->
		';
					break;
			}
			
			switch ( substr( dynamik_get_design( 'ez_homepage_select' ), -1 ) )
			{
				case '1':
					$ez_home_bottom_widget_reg = 
ez_home_widget_reg( '1', 'Bottom', 'bottom' );
					$ez_home_bottom_widgets = 
ez_home_widget( '1', 'ez-only', 'Bottom', 'bottom' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-bottom-container -->
		';
					break;
				case '2':
					switch ( substr( dynamik_get_design( 'ez_homepage_select' ), -5, -4 ) )
					{
						case 'l':
							$widget_1_class = 'two-thirds';
							$widget_2_class = 'one-third';
							break;
						case 'r':
							$widget_1_class = 'one-third';
							$widget_2_class = 'two-thirds';
							break;
						default:
							$widget_1_class = 'one-half';
							$widget_2_class = 'one-half';
							break;
					}
					$ez_home_bottom_widget_reg = 
ez_home_widget_reg( '1', 'Bottom', 'bottom' ) . ez_home_widget_reg( '2', 'Bottom', 'bottom' );
					$ez_home_bottom_widgets = 
ez_home_widget( '1', $widget_1_class . ' first', 'Bottom', 'bottom' ) . ez_home_widget( '2', $widget_2_class, 'Bottom', 'bottom' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-bottom-container -->
		';
					break;
				case '3':
					$ez_home_bottom_widget_reg = 
ez_home_widget_reg( '1', 'Bottom', 'bottom' ) . ez_home_widget_reg( '2', 'Bottom', 'bottom' ) . ez_home_widget_reg( '3', 'Bottom', 'bottom' );
					$ez_home_bottom_widgets = 
ez_home_widget( '1', 'one-third first', 'Bottom', 'bottom' ) . ez_home_widget( '2', 'one-third', 'Bottom', 'bottom' ) . ez_home_widget( '3', 'one-third', 'Bottom', 'bottom' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-bottom-container -->
		';
					break;
			}
			break;
		case '13':
		case '16':
			switch ( substr( dynamik_get_design( 'ez_homepage_select' ), -5, -4 ) )
			{
				case '1':
					$ez_home_top_widget_reg = 
ez_home_widget_reg( '1', 'Top', 'top' );
					$ez_home_top_widgets = 
ez_home_widget( '1', 'ez-only', 'Top', 'top' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-top-container -->
		';
					break;
				case '2':
					switch ( substr( dynamik_get_design( 'ez_homepage_select' ), -7, -6 ) )
					{
						case 'l':
							$widget_1_class = 'two-thirds';
							$widget_2_class = 'one-third';
							break;
						case 'r':
							$widget_1_class = 'one-third';
							$widget_2_class = 'two-thirds';
							break;
						default:
							$widget_1_class = 'one-half';
							$widget_2_class = 'one-half';
							break;
					}
					$ez_home_top_widget_reg = 
ez_home_widget_reg( '1', 'Top', 'top' ) . ez_home_widget_reg( '2', 'Top', 'top' );
					$ez_home_top_widgets = 
ez_home_widget( '1', $widget_1_class . ' first', 'Top', 'top' ) . ez_home_widget( '2', $widget_2_class, 'Top', 'top' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-top-container -->
		';
					break;
				case '3':
					$ez_home_top_widget_reg = 
ez_home_widget_reg( '1', 'Top', 'top' ) . ez_home_widget_reg( '2', 'Top', 'top' ) . ez_home_widget_reg( '3', 'Top', 'top' );
					$ez_home_top_widgets = 
ez_home_widget( '1', 'one-third first', 'Top', 'top' ) . ez_home_widget( '2', 'one-third', 'Top', 'top' ) . ez_home_widget( '3', 'one-third', 'Top', 'top' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-top-container -->
		';
					break;
			}
			
			switch ( substr( dynamik_get_design( 'ez_homepage_select' ), -3, -2 ) )
			{
				case '1':
					$ez_home_middle_widget_reg = 
ez_home_widget_reg( '1', 'Middle', 'middle' );
					$ez_home_middle_widgets = 
ez_home_widget( '1', 'ez-only', 'Middle', 'middle' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-middle-container -->
		';
					break;
				case '2':
					switch ( substr( dynamik_get_design( 'ez_homepage_select' ), -7, -6 ) )
					{
						case 'l':
							$widget_1_class = 'two-thirds';
							$widget_2_class = 'one-third';
							break;
						case 'r':
							$widget_1_class = 'one-third';
							$widget_2_class = 'two-thirds';
							break;
						default:
							$widget_1_class = 'one-half';
							$widget_2_class = 'one-half';
							break;
					}
					$ez_home_middle_widget_reg = 
ez_home_widget_reg( '1', 'Middle', 'middle' ) . ez_home_widget_reg( '2', 'Middle', 'middle' );
					$ez_home_middle_widgets = 
ez_home_widget( '1', $widget_1_class . ' first', 'Middle', 'middle' ) . ez_home_widget( '2', $widget_2_class, 'Middle', 'middle' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-middle-container -->
		';
					break;
				case '3':
					$ez_home_middle_widget_reg = 
ez_home_widget_reg( '1', 'Middle', 'middle' ) . ez_home_widget_reg( '2', 'Middle', 'middle' ) . ez_home_widget_reg( '3', 'Middle', 'middle' );
					$ez_home_middle_widgets = 
ez_home_widget( '1', 'one-third first', 'Middle', 'middle' ) . ez_home_widget( '2', 'one-third', 'Middle', 'middle' ) . ez_home_widget( '3', 'one-third', 'Middle', 'middle' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-middle-container -->
		';
					break;
			}
			
			switch ( substr( dynamik_get_design( 'ez_homepage_select' ), -1 ) )
			{
				case '1':
					$ez_home_bottom_widget_reg = 
ez_home_widget_reg( '1', 'Bottom', 'bottom' );
					$ez_home_bottom_widgets = 
ez_home_widget( '1', 'ez-only', 'Bottom', 'bottom' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-bottom-container -->
		';
					break;
				case '2':
					switch ( substr( dynamik_get_design( 'ez_homepage_select' ), -7, -6 ) )
					{
						case 'l':
							$widget_1_class = 'two-thirds';
							$widget_2_class = 'one-third';
							break;
						case 'r':
							$widget_1_class = 'one-third';
							$widget_2_class = 'two-thirds';
							break;
						default:
							$widget_1_class = 'one-half';
							$widget_2_class = 'one-half';
							break;
					}
					$ez_home_bottom_widget_reg = 
ez_home_widget_reg( '1', 'Bottom', 'bottom' ) . ez_home_widget_reg( '2', 'Bottom', 'bottom' );
					$ez_home_bottom_widgets = 
ez_home_widget( '1', $widget_1_class . ' first', 'Bottom', 'bottom' ) . ez_home_widget( '2', $widget_2_class, 'Bottom', 'bottom' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-bottom-container -->
		';
					break;
				case '3':
					$ez_home_bottom_widget_reg = 
ez_home_widget_reg( '1', 'Bottom', 'bottom' ) . ez_home_widget_reg( '2', 'Bottom', 'bottom' ) . ez_home_widget_reg( '3', 'Bottom', 'bottom' );
					$ez_home_bottom_widgets = 
ez_home_widget( '1', 'one-third first', 'Bottom', 'bottom' ) . ez_home_widget( '2', 'one-third', 'Bottom', 'bottom' ) . ez_home_widget( '3', 'one-third', 'Bottom', 'bottom' ) . '
			</div><!-- end .ez-home-wrap -->

		</div><!-- end #ez-home-bottom-container -->
		';
					break;
			}
			break;
	}
	
	switch ( strlen( dynamik_get_design( 'ez_feature_top_select' ) ) )
	{
		case '16':
			switch ( substr( dynamik_get_design( 'ez_feature_top_select' ), -1 ) )
			{
				case '1':
					$ez_feature_top_widget_reg = 
ez_feature_top_widget_reg( '1' );
					$ez_feature_top_widgets = 
ez_feature_top_widget( '1', 'ez-only' ) . '
					';
					break;
				case '2':
					$ez_feature_top_widget_reg = 
ez_feature_top_widget_reg( '1' ) . ez_feature_top_widget_reg( '2' );
					$ez_feature_top_widgets = 
ez_feature_top_widget( '1', 'one-half first' ) . ez_feature_top_widget( '2', 'one-half' ) . '
					';
					break;
				case '3':
					$ez_feature_top_widget_reg = 
ez_feature_top_widget_reg( '1' ) . ez_feature_top_widget_reg( '2' ) . ez_feature_top_widget_reg( '3' );
					$ez_feature_top_widgets = 
ez_feature_top_widget( '1', 'one-third first' ) . ez_feature_top_widget( '2', 'one-third' ) . ez_feature_top_widget( '3', 'one-third' ) . '
					';
					break;
				case '4':
					$ez_feature_top_widget_reg = 
ez_feature_top_widget_reg( '1' ) . ez_feature_top_widget_reg( '2' ) . ez_feature_top_widget_reg( '3' ) . ez_feature_top_widget_reg( '4' );
					$ez_feature_top_widgets = 
ez_feature_top_widget( '1', 'one-fourth first' ) . ez_feature_top_widget( '2', 'one-fourth' ) . ez_feature_top_widget( '3', 'one-fourth' ) . ez_feature_top_widget( '4', 'one-fourth' ) . '
					';
					break;
			}
			break;
		case '19':
			switch ( substr( dynamik_get_design( 'ez_feature_top_select' ), -3, -2 ) )
			{
				case 'l':
					$ez_feature_top_widget_reg = 
ez_feature_top_widget_reg( '1' ) . ez_feature_top_widget_reg( '2' );
					$ez_feature_top_widgets = 
ez_feature_top_widget( '1', 'two-thirds first' ) . ez_feature_top_widget( '2', 'one-third' ) . '
					';
					break;
				case 'r':
					$ez_feature_top_widget_reg = 
ez_feature_top_widget_reg( '1' ) . ez_feature_top_widget_reg( '2' );
					$ez_feature_top_widgets = 
ez_feature_top_widget( '1', 'one-third first' ) . ez_feature_top_widget( '2', 'two-thirds' ) . '
					';
					break;
			}
			break;
	}
	
	switch ( strlen( dynamik_get_design( 'ez_fat_footer_select' ) ) )
	{
		case '15':
			switch ( substr( dynamik_get_design( 'ez_fat_footer_select' ), -1 ) )
			{
				case '1':
					$ez_fat_footer_widget_reg = 
ez_fat_footer_widget_reg( '1' );
					$ez_fat_footer_widgets = 
ez_fat_footer_widget( '1', 'ez-only' ) . '
					';
					break;
				case '2':
					$ez_fat_footer_widget_reg = 
ez_fat_footer_widget_reg( '1' ) . ez_fat_footer_widget_reg( '2' );
					$ez_fat_footer_widgets = 
ez_fat_footer_widget( '1', 'one-half first' ) . ez_fat_footer_widget( '2', 'one-half' ) . '
					';
					break;
				case '3':
					$ez_fat_footer_widget_reg = 
ez_fat_footer_widget_reg( '1' ) . ez_fat_footer_widget_reg( '2' ) . ez_fat_footer_widget_reg( '3' );
					$ez_fat_footer_widgets = 
ez_fat_footer_widget( '1', 'one-third first' ) . ez_fat_footer_widget( '2', 'one-third' ) . ez_fat_footer_widget( '3', 'one-third' ) . '
					';
					break;
				case '4':
					$ez_fat_footer_widget_reg = 
ez_fat_footer_widget_reg( '1' ) . ez_fat_footer_widget_reg( '2' ) . ez_fat_footer_widget_reg( '3' ) . ez_fat_footer_widget_reg( '4' );
					$ez_fat_footer_widgets = 
ez_fat_footer_widget( '1', 'one-fourth first' ) . ez_fat_footer_widget( '2', 'one-fourth' ) . ez_fat_footer_widget( '3', 'one-fourth' ) . ez_fat_footer_widget( '4', 'one-fourth' ) . '
					';
					break;
			}
			break;
		case '18':
			switch ( substr( dynamik_get_design( 'ez_fat_footer_select' ), -3, -2 ) )
			{
				case 'l':
					$ez_fat_footer_widget_reg = 
ez_fat_footer_widget_reg( '1' ) . ez_fat_footer_widget_reg( '2' );
					$ez_fat_footer_widgets = 
ez_fat_footer_widget( '1', 'two-thirds first' ) . ez_fat_footer_widget( '2', 'one-third' ) . '
					';
					break;
				case 'r':
					$ez_fat_footer_widget_reg = 
ez_fat_footer_widget_reg( '1' ) . ez_fat_footer_widget_reg( '2' );
					$ez_fat_footer_widgets = 
ez_fat_footer_widget( '1', 'one-third first' ) . ez_fat_footer_widget( '2', 'two-thirds' ) . '
					';
					break;
			}
			break;
		default:
	}

	$structure = '<?php
/**
 * Build and register EZ Widget Area structures.
 */
 
/**
 * Register EZ Widget Areas
 */';
	
	$structure .= $ez_home_top_widget_reg;
	
	$structure .= $ez_home_middle_widget_reg;
	
	$structure .= $ez_home_bottom_widget_reg;
	
	$structure .= ez_home_sidebar_widget_reg();
	
	$structure .= ez_home_slider_widget_reg();
	
	$structure .= $ez_feature_top_widget_reg;
	
	$structure .= $ez_fat_footer_widget_reg;

	if( dynamik_get_design( 'dynamik_homepage_type' ) == 'static_home' )
	{
		$structure .= '
/**
 * Build the EZ Home Structure HTML.
 *
 * @since 1.0
 */
function ez_home() { ?>
	<div id="ez-home-container-wrap" class="clearfix">
	
		<?php do_action( "dynamik_hook_before_ez_home" ); ?>
		';
		
		$structure .= $ez_home_top_widgets;
		
		$structure .= $ez_home_middle_widgets;
		
		$structure .= $ez_home_bottom_widgets;
				
		$structure .= '
		<?php do_action( "dynamik_hook_after_ez_home" ); ?>
	
	</div><!-- end #ez-home-container-wrap -->
<?php
}
';
	}

	if( dynamik_get_design( 'ez_static_home_sb_display' ) )
	{
		$structure .= '
/**
 * Build the EZ Home Sidebar HTML.
 *
 * @since 1.0
 */
function ez_home_sidebar() { ?>
	<div id="ez-home-sidebar-wrap" class="clearfix">

		<div id="ez-home-sidebar" class="sidebar widget-area ez-widget-area">
		
			<?php if ( ! dynamic_sidebar( ' . $single_quote . 'EZ Home Sidebar' . $single_quote . ' ) ) { ?>
				<div class="widget widget-text"><div class="widget-wrap">
					<h4 class="widgettitle"><?php _e( ' . $single_quote . 'Home Sidebar Widget Area' . $single_quote . ', ' . $single_quote . 'dynamik' . $single_quote . ' ); ?></h4>
					<div class="textwidget"><p><?php printf( __( ' . $single_quote . 'This is the Home Sidebar 1 Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.' . $single_quote . ', "dynamik" ), admin_url( "widgets.php" ) ); ?></p></div>
				</div></div>
			<?php } ?>
			
		</div><!-- end #ez-home-sidebar -->

	</div><!-- end #ez-home-sidebar-wrap -->
<?php
}
';
	}
	else
	{
		$structure .= '';
	}
	
	if( dynamik_get_design( 'ez_home_slider_display' ) )
	{
		$structure .= '
/**
 * Build the EZ Home Slider HTML.
 *
 * @since 1.0
 */
function ez_home_slider() {
	if ( ! is_front_page() )
		return;
?>
	<div id="ez-home-slider-container-wrap" class="clearfix">
	
		<div id="ez-home-slider-container" class="clearfix">

			<div id="ez-home-slider" class="widget-area ez-widget-area ez-only">
			
				<?php if ( ! dynamic_sidebar( ' . $single_quote . 'EZ Home Slider' . $single_quote . ' ) ) { ?>
					<div class="widget">
						<?php if ( function_exists( ' . $single_quote . 'wp_cycle' . $single_quote . ' ) ) { ?>
							<?php wp_cycle(); ?>
						<?php } ?>
					</div>			
				<?php } ?>
				
			</div><!-- end #ez-home-slider -->
		
		</div><!-- end #ez-home-slider-container -->
		
	</div><!-- end #ez-home-slider-container-wrap -->
<?php
}
';
	}
	else
	{
		$structure .= '';
	}
	
	if( dynamik_get_design( 'ez_feature_top_select' ) != 'disabled' )
	{
		$structure .= '
/**
 * Build the EZ Feature Top HTML.
 *
 * @since 1.0
 */
function ez_feature_top() { ?>
	<div id="ez-feature-top-container-wrap" class="clearfix">
	
		<div id="ez-feature-top-container" class="clearfix">';
		
		$structure .= $ez_feature_top_widgets;
				
		$structure .= '
		</div><!-- end #feature-top-container -->
		
	</div><!-- end #feature-top-container-wrap -->
<?php
}
';
	}
	
	if( dynamik_get_design( 'ez_fat_footer_select' ) != 'disabled' )
	{
		$structure .= '
/**
 * Build the EZ Fat Footer HTML.
 *
 * @since 1.0
 */
function ez_fat_footer() { ?>
	<div id="ez-fat-footer-container-wrap" class="clearfix">
	
		<div id="ez-fat-footer-container" class="clearfix">';
		
		$structure .= $ez_fat_footer_widgets;
				
		$structure .= '
		</div><!-- end #fat-footer-container -->
		
	</div><!-- end #fat-footer-container-wrap -->
<?php
}
';
	}
	
	return $structure;
}
