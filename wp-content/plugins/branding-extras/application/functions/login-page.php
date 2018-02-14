<?php

//* Login Logo
add_action('login_head', 'be_loginlogo');
function be_loginlogo() {
	$branding_extras = new BrandingExtras();
	$options = $branding_extras->get_branding_extras_options();

	$admin_logo_img = !empty($options['admin_logo_img']) ? $options['admin_logo_img'] : $branding_extras->config["admin_logo_width"];
	$admin_logo_bgcolor = !empty($options['admin_logo_bgcolor']) ? $options['admin_logo_bgcolor'] : $branding_extras->config["admin_logo_bgcolor"];
	$admin_logo_width = !empty($options['admin_logo_width']) ? $options['admin_logo_width'] : $branding_extras->config["admin_logo_width"];
	$admin_logo_height = !empty($options['admin_logo_height']) ? $options['admin_logo_height'] : $branding_extras->config["admin_logo_height"];
	$admin_logo_padding = !empty($options['admin_logo_padding']) ? $options['admin_logo_padding'] : $branding_extras->config["admin_logo_padding"];
	$admin_logo_box_shadow = !empty($options['admin_logo_box_shadow']) ? $options['admin_logo_box_shadow'] : $branding_extras->config["admin_logo_box_shadow"];

	$admin_container_width = $admin_logo_width > '320' ? $admin_logo_width : '320';

	echo '<style type="text/css">
			body.login h1 a { 
				padding: '.$admin_logo_padding.'; 
				width: '.$admin_logo_width.'px; 
				height: '.$admin_logo_height.'px; 
				box-shadow: '.$admin_logo_box_shadow.';
				background-color: '.$admin_logo_bgcolor.';
				background-image: url('.$admin_logo_img.');
				background-repeat: no-repeat;
				background-attachment: scroll;
				background-position: center center;
				background-size: initial;
			}
			body.login #login {
				width: '.$admin_container_width.'px;
			}
		</style>';
}

//* Login Logo URL
add_filter( 'login_headerurl', 'be_loginlogo_url' );
function be_loginlogo_url($url) {
	return get_bloginfo('url');
}

//* Login Logo Title
add_filter( 'login_headertitle', 'be_loginlogo_title' );
function be_loginlogo_title( $title ) {
	return esc_attr( get_bloginfo( 'name' ) );
}

?>