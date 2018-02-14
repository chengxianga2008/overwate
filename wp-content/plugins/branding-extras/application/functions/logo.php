<?php

//* Logo title attr
add_filter( 'genesis_seo_title', 'logo_title_attr', 10, 3 );
function logo_title_attr( $title, $inside, $wrap ) {
	$branding_extras = new BrandingExtras();
	$options = $branding_extras->get_branding_extras_options();
	$header_logo = !empty($options['header_logo']) ? $options['header_logo'] : $branding_extras->config["header_logo"];

	$inside = sprintf( '<a href="%s" title="%s"><img src="'. $header_logo .'" alt="%s"/></a>', esc_url( get_bloginfo( 'url' ) ), esc_attr( get_bloginfo( 'name' ) ), esc_attr( get_bloginfo( 'name' ) ) );
	return sprintf( '<%1$s class="site-title" itemprop="headline">%2$s</%1$s>', $wrap, $inside );
}

?>