<?php
/**
 * Template Name: Page Builder
 *
 * Credit for the following code goes to...
 * Sridhar Katakam for his tutorial here: https://sridharkatakam.com/full-width-page-template-in-genesis-for-beaver-builder/
 * As well as Bill Erickson for his tutorial here: http://www.billerickson.net/full-width-landing-pages-in-genesis/
 */

add_filter( 'body_class', 'dynamik_page_builder_body_class' );
/**
 * Adds a css class to the body element
 *
 * @param  array $classes the current body classes
 * @return array $classes modified classes
 */
function dynamik_page_builder_body_class( $classes ) {
	$classes[] = 'dynamik-page-builder';
	return $classes;
}

add_filter( 'genesis_attr_site-inner', 'dynamik_page_builder_attributes_site_inner' );
/**
 * Add attributes for site-inner element.
 *
 * @since 2.0.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return array Amended attributes.
 */
function dynamik_page_builder_attributes_site_inner( $attributes ) {
	$attributes['role']     = 'main';
	$attributes['itemprop'] = 'mainContentOfPage';

	return $attributes;
}

// Remove div.site-inner's div.wrap
add_filter( 'genesis_structural_wrap-site-inner', '__return_empty_string' );

// Display Header
get_header();

// Display Content
the_post(); // sets the 'in the loop' property to true.
the_content();

// Display Footer
get_footer();
