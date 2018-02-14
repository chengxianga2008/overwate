<?php
/**
 * Build and Hook-In Custom Widget Areas.
 */

/* Name: Footer Credit */

add_shortcode( 'footer_credit', 'dynamik_footer_credit_widget_area_shortcode' );
function dynamik_footer_credit_widget_area_shortcode() {
	ob_start();
	dynamik_footer_credit_widget_area_content();
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}

function dynamik_footer_credit_widget_area_content() {
	genesis_widget_area( 'footer_credit', $args = array (
		'before'              => '<div id="footer_credit" class="widget-area dynamik-widget-area footer-credit ez-only">',
		'after'               => '</div>',
		'before_sidebar_hook' => 'genesis_before_footer_credit_widget_area',
		'after_sidebar_hook'  => 'genesis_after_footer_credit_widget_area'
	) );
}

/* Name: Header Top Right */

add_shortcode( 'header_top_right', 'dynamik_header_top_right_widget_area_shortcode' );
function dynamik_header_top_right_widget_area_shortcode() {
	ob_start();
	dynamik_header_top_right_widget_area_content();
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}

function dynamik_header_top_right_widget_area_content() {
	genesis_widget_area( 'header_top_right', $args = array (
		'before'              => '<div id="header_top_right" class="widget-area dynamik-widget-area header-top">',
		'after'               => '</div>',
		'before_sidebar_hook' => 'genesis_before_header_top_right_widget_area',
		'after_sidebar_hook'  => 'genesis_after_header_top_right_widget_area'
	) );
}

/* Name: Header Top Left */

add_shortcode( 'header_top_left', 'dynamik_header_top_left_widget_area_shortcode' );
function dynamik_header_top_left_widget_area_shortcode() {
	ob_start();
	dynamik_header_top_left_widget_area_content();
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}

function dynamik_header_top_left_widget_area_content() {
	genesis_widget_area( 'header_top_left', $args = array (
		'before'              => '<div id="header_top_left" class="widget-area dynamik-widget-area header-top">',
		'after'               => '</div>',
		'before_sidebar_hook' => 'genesis_before_header_top_left_widget_area',
		'after_sidebar_hook'  => 'genesis_after_header_top_left_widget_area'
	) );
}
