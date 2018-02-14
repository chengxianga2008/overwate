<?php
/**
 * Register Custom Widget Areas.
 */

genesis_register_sidebar( array(
	'id' 			=>	'footer_credit',
	'name'			=>	__( 'Footer Credit', 'dynamik' ),
	'description' 	=>	__( 'Footer credit widget area.', 'dynamik' )
) );

genesis_register_sidebar( array(
	'id' 			=>	'header_top_left',
	'name'			=>	__( 'Header Top Left', 'dynamik' ),
	'description' 	=>	__( 'Header top left widget area.', 'dynamik' )
) );

genesis_register_sidebar( array(
	'id' 			=>	'header_top_right',
	'name'			=>	__( 'Header Top Right', 'dynamik' ),
	'description' 	=>	__( 'Header top right widget area.', 'dynamik' )
) );
