<?php

// Branding Information Shortcode
function be_branding_information( $atts ){
	$branding_extras = new BrandingExtras();
	$options = $branding_extras->get_branding_extras_options();
    $address = !empty($options['address']) ? stripslashes($options['address']) : $branding_extras->config["address"];
    $contact_number = !empty($options['contact_number']) ? stripslashes($options['contact_number']) : $branding_extras->config["contact_number"];
    $email_address = !empty($options['email_address']) ? stripslashes($options['email_address']) : $branding_extras->config["email_address"];

	$branding_information = shortcode_atts( array(
		'type' => null
    ), $atts );

	switch ( $branding_information['type'] )
    {
        case 'address':
            $branding_information = $address;
            break;

        case 'contact_number': 
            $branding_information = $contact_number;
            break;

        case 'email_address': 
            $branding_information = $email_address;
            break;

        default:
            break;
    }
    return $branding_information;
}
add_shortcode( 'branding-information', 'be_branding_information' );

?>