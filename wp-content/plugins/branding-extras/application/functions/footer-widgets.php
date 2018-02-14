<?php

//* Footer Widgets
function be_footer_widgets() {
	$branding_extras = new BrandingExtras();
	$options = $branding_extras->get_branding_extras_options();

	$column_number = !empty($options['footer_widgets_number']) ? $options['footer_widgets_number'] : $branding_extras->config["footer_widgets_number"];
	
	if($column_number <= 0) {
		$column_number = 1;
	}
	else if($column_number >= 7) {
		$column_number = 6;
	}

	//* Add support for footer widgets
	add_theme_support( 'genesis-footer-widgets', $column_number );
}
be_footer_widgets();

//* Add material cell classes for footer widgets
add_filter( 'genesis_footer_widget_areas', 'add_be_markup_footer_widgets', 10 , 2 );
function add_be_markup_footer_widgets( $output, $footer_widgets ){
	$branding_extras = new BrandingExtras();
	$options = $branding_extras->get_branding_extras_options();
	$footer_widgets_class = !empty($options['footer_widgets_class']) ? $options['footer_widgets_class'] : $branding_extras->config["footer_widgets_class"];
	$footer_widgets_number = !empty($options['footer_widgets_number']) ? $options['footer_widgets_number'] : $branding_extras->config["footer_widgets_number"];
	$footer_widgets = get_theme_support( 'genesis-footer-widgets' );

	if ( ! $footer_widgets || ! isset( $footer_widgets[0] ) || ! is_numeric( $footer_widgets[0] ) )
		return;

	$footer_widgets = (int) $footer_widgets[0];

	//* Check to see if first widget area has widgets. If not, do nothing. No need to check all footer widget areas.
	if ( ! is_active_sidebar( 'footer-1' ) )
		return;

	$inside  = '';
	$output  = '';
	$counter = 1;
	$column = '';

	if($footer_widgets_class == 0 || $footer_widgets_class == null) 
	{
		switch( $footer_widgets_number ) {
			case '1'; $column = 'ez-only'; break;
			case '2': $column = 'one-half'; break;
			case '3': $column = 'one-third'; break;
			case '4': $column = 'one-fourth'; break;
			case '5': $column = 'one-fifth'; break;
			case '6': $column = 'one-sixth'; break;
			default: break;
		}
	}

	while ( $counter <= $footer_widgets ) {
		ob_start();
		dynamic_sidebar( 'footer-' . $counter );
		$widgets = ob_get_clean();
		$column_first = $footer_widgets_class == 0 ? 'first' : null;
		$inside .= $counter == 1 ? sprintf( '<div class="widget-%s widget-area '.$column_first.' '.$column.'" id="footer-widget-%s">%s</div>', $counter, $counter, $widgets ) : sprintf( '<div class="widget-%s widget-area '.$column.'" id="footer-widget-%s">%s</div>', $counter, $counter, $widgets );
		$counter++;
	}
	
	if ( $inside ) {

		$output .= genesis_markup( array(
			'html5'   => '<div %s>' . genesis_sidebar_title( 'Footer' ),
			'xhtml'   => '<div id="footer-widgets" class="footer-widgets">',
			'context' => 'footer-widgets',
			'echo'    => false,
		) );

		$output .= genesis_structural_wrap( 'footer-widgets', 'open', 0 );
		$output .= $inside;
		$output .= genesis_structural_wrap( 'footer-widgets', 'close', 0 );
		$output .= '</div>';
	}
	echo $output;
}

?>