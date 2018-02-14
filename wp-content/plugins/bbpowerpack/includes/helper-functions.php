<?php

/**
 * Error messages.
 *
 * @since 1.2.0
 * @return mixed
 */
function pp_set_error( $key )
{
	$errors = array(
		'fetch_error'      	=> esc_html__( 'Unable to fetch template data. Please click on the "Reload" button.', 'bb-powerpack' ),
		'connection_lost'	=> esc_html__( 'Error donwloading template data. Please check your internet connection and click on the "Reload" button.', 'bb-powerpack' ),
	);
	if ( isset( $errors[$key] ) && ! isset( BB_PowerPack::$errors[$key] ) ) {
		BB_PowerPack::$errors[$key] = $errors[$key];
	}
}

/**
 * Checks to see if the site has SSL enabled or not.
 *
 * @since 1.2.1
 * @return bool
 */
function pp_is_ssl()
{
	if ( is_ssl() ) {
		return true;
	}
	else if ( 0 === stripos( get_option( 'siteurl' ), 'https://' ) ) {
		return true;
	}
	else if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' == $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
		return true;
	}

	return false;
}

/**
 * Returns an array of paths for the upload directory
 * of the current site.
 *
 * @since 1.1.7
 * @return array
 */
function pp_get_upload_dir()
{
	$wp_info = wp_upload_dir();

	if ( is_multisite() ) {
		$wp_info = array(
			'basedir' => ABSPATH . 'wp-content/uploads',
			'baseurl' => network_site_url( '/wp-content/uploads' )
		);
	}

	$dir_name = basename( BB_POWERPACK_DIR );

	// SSL workaround.
	if ( pp_is_ssl() ) {
		$wp_info['baseurl'] = str_ireplace( 'http://', 'https://', $wp_info['baseurl'] );
	}

	// Build the paths.
	$dir_info = array(
		'path'	 => $wp_info['basedir'] . '/' . $dir_name . '/',
		'url'	 => $wp_info['baseurl'] . '/' . $dir_name . '/'
	);

	// Create the upload dir if it doesn't exist.
	if ( ! file_exists( $dir_info['path'] ) ) {

		// Create the directory.
		mkdir( $dir_info['path'] );

		// Add an index file for security.
		file_put_contents( $dir_info['path'] . 'index.html', '' );
	}

	return $dir_info;
}

/**
 * Downloads template file.
 *
 * @since 1.1.7
 * @return bool
 */
function pp_download_template( $url, $path, $filename = '' )
{
    // Initialize the flag.
    $downloaded = false;

    // Download file.
    $file = basename( parse_url( $url, PHP_URL_PATH ) );
	if ( '' != $filename ) {
		$file = $filename;
	}
    if ( $file ) {
		$path = $path . $file;

		// Delete the file if is already exists.
		if ( file_exists( $path ) ) {
			unlink($path);
		}

		if ( function_exists( 'curl_init' ) ) {
			$ch = curl_init();
	        curl_setopt( $ch, CURLOPT_URL, $url );
	        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 30 );
	        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	        $content = curl_exec($ch);
	        if ( curl_errno($ch) ) {
	            pp_set_error( 'fetch_error' );
	            $content = '';
	        } else {
	            curl_close($ch);
	        }

			if ( $content != '' ) {
				$file = $content;
	        	file_put_contents( $path, $file );
	        	$downloaded = true;
			}
		}

		// If not downloaded, retrive the content in a new file.
		if ( ! $downloaded ) {
			$file = @file_get_contents( $url );
			if ( ! $file ) {
				pp_set_error('connection_lost');
			} else {
				file_put_contents( $path, $file );
			}
		}
    }

    // Set the flag true if is downloaded.
    if ( file_exists( $path ) ) {
        $downloaded = true;
    }

    return $downloaded;
}

function pp_download_template_data( $request = '' )
{
	if ( 'new' != $request && file_exists( BB_PowerPack::$upload_dir['path'] . 'page-templates.json' ) && file_exists( BB_PowerPack::$upload_dir['path'] . 'row-templates.json' ) ) {
		return;
	}

	$page = pp_download_template( 'https://wpbeaveraddons.com/page-templates/template-data/?show=page&export', BB_PowerPack::$upload_dir['path'], 'page-templates.json' );
	$row = pp_download_template( 'https://wpbeaveraddons.com/page-templates/template-data/?show=row&export', BB_PowerPack::$upload_dir['path'], 'row-templates.json' );

	if ( ! $page || ! $row ) {
		pp_set_error('connection_lost');
	}
}

function pp_get_template_data( $type )
{
	$path = BB_PowerPack::$upload_dir['path'];
	$file = $path . $type . '-templates.json';

	if ( ! file_exists( $file ) ) {
		pp_download_template_data();
	}

	$data = @file_get_contents( $file );
	if ( $data ) {
		$data = json_decode( $data, true );
	}

	BB_PowerPack_Admin_Settings::$templates_count[$type] = count( $data );

	return $data;
}

/**
 * Row templates categories
 */
function pp_row_templates_categories()
{
    $cats = array(
        'pp-contact-blocks'     => __('Contact Blocks', 'bb-powerpack'),
        'pp-contact-forms'      => __('Contact Forms', 'bb-powerpack'),
        'pp-call-to-action'     => __('Call To Action', 'bb-powerpack'),
        'pp-hero'               => __('Hero', 'bb-powerpack'),
        'pp-heading'            => __('Heading', 'bb-powerpack'),
        'pp-subscribe-forms'    => __('Subscribe Forms', 'bb-powerpack'),
        'pp-content'            => __('Content', 'bb-powerpack'),
        'pp-blog-posts'         => __('Blog Posts', 'bb-powerpack'),
        'pp-lead-generation'    => __('Lead Generation', 'bb-powerpack'),
        'pp-logos'              => __('Logos', 'bb-powerpack'),
        'pp-faq'              	=> __('FAQ', 'bb-powerpack'),
        'pp-team'               => __('Team', 'bb-powerpack'),
        'pp-testimonials'       => __('Testimonials', 'bb-powerpack'),
        'pp-features'           => __('Features', 'bb-powerpack'),
        'pp-services'           => __('Services', 'bb-powerpack'),
    );

	if ( is_array( $cats ) ) {
    	ksort($cats);
	}

    return $cats;
}

/**
 * Templates categories
 */
function pp_templates_categories( $type )
{
	$templates = pp_get_template_data( $type );
	$data = array();

	if ( is_array( $templates ) ) {
		foreach ( $templates as $cat => $info ) {
			$data[$cat] = array(
				'title'		=> $info['name'],
				'type'		=> $info['type'],
			);
			if ( isset( $info['count'] ) ) {
				$data[$cat]['count'] = $info['count'];
			}
		}

    	ksort($data);
	}

    return $data;
}

/**
 * Templates filters
 */
function pp_template_filters()
{
	$filters = array(
		'all'				=> __( 'All', 'bb-powerpack' ),
		'home'				=> __( 'Home', 'bb-powerpack' ),
		'about'				=> __( 'About', 'bb-powerpack' ),
		'contact'			=> __( 'Contact', 'bb-powerpack' ),
		'landing'			=> __( 'Landing', 'bb-powerpack' ),
		'sales'				=> __( 'Sales', 'bb-powerpack' ),
		'coming-soon'		=> __( 'Coming Soon', 'bb-powerpack' ),
	);

	return $filters;
}

/**
 * Templates source URL
 */
function pp_templates_src( $type = 'page', $category = '' )
{
	$src = array();
	$url = 'https://s3.amazonaws.com/ppbeaver/data/';

	if ( $type == 'row' ) {
		$mode 	= BB_PowerPack_Admin_Settings::get_template_scheme();
		$url 	= $url . $mode . '/';
	}

	foreach ( pp_templates_categories( $type ) as $slug => $title ) {
		$src[$slug] = $url . $slug . '.dat';
	}

	if ( '' != $category && isset( $src[$category] ) ) {
		return $src[$category];
	}

	return $src;
}

/**
 * Templates demo source URL
 */
function pp_templates_preview_src( $type = 'page', $category = '' )
{
    $url = 'https://wpbeaveraddons.com/page-templates/';

	$templates = pp_get_template_data( $type );
	$data = array();

	if ( is_array( $templates ) ) {

		foreach ( $templates as $cat => $info ) {
			$data[$cat] = $info['slug'];
		}

	}

    if ( '' == $category ) {
        return $data;
    }

    if ( isset( $data[$category] ) ) {
        return $data[$category];
    }

    return $url;
}

function pp_get_template_screenshot_url( $type, $category, $mode = '' )
{
	$url = 'https://s3.amazonaws.com/ppbeaver/assets/400x400/';
	$scheme = BB_PowerPack_Admin_Settings::get_template_scheme();

	if ( ( $type == 'page' || $scheme == 'color' ) && $mode == '' ) {
		return $url . $category . '.jpg';
	}

	if ( $mode == 'color' ) {
		return $url . $category . '.jpg';
	}

	if ( $mode == 'greyscale' ) {
		return $url . 'greyscale/' . $category . '.jpg';
	}

	return $url . $scheme . '/' . $category . '.jpg';
}

/**
 * Modules
 */
function pp_modules()
{
    // $categories = FLBuilderModel::get_categorized_modules( true );
    // $modules    = array();
	//
    // foreach ( $categories[BB_POWERPACK_CAT] as $title => $module ) {
    //     $slug = is_object( $module ) ? $module->slug : $module['slug'];
    //     $modules[$slug] = $title;
    // }
	foreach(FLBuilderModel::$modules as $module) {
		if ( $module->category == BB_POWERPACK_CAT ) {
			$slug = is_object( $module ) ? $module->slug : $module['slug'];
			$modules[$slug] = $module->name;
		}
	}

    return $modules;
}

/**
 * Row and Column Extensions
 */
function pp_extensions()
{
    $extensions = array(
        'row'       => array(
            'separators'    => __('Separators', 'bb-powerpack'),
            'gradient'      => __('Gradient', 'bb-powerpack'),
            'overlay'       => __('Overlay Type', 'bb-powerpack'),
            'expandable'    => __('Expandable', 'bb-powerpack'),
            'downarrow'     => __('Down Arrow', 'bb-powerpack'),
        ),
        'col'       => array(
            'separators'    => __('Separators', 'bb-powerpack'),
            'gradient'      => __('Gradient', 'bb-powerpack'),
            'corners'       => __('Round Corners', 'bb-powerpack'),
            'shadow'        => __('Box Shadow', 'bb-powerpack'),
        )
    );

    return $extensions;
}

/**
 * Hex to Rgba
 */
function pp_hex2rgba( $hex, $opacity )
{
	$hex = str_replace( '#', '', $hex );

	if ( strlen($hex) == 3 ) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgba = array($r, $g, $b, $opacity);

	return 'rgba(' . implode(', ', $rgba) . ')';
}

/**
 * Returns long day format.
 *
 * @since 1.2.2
 * @param string $day
 * @return mixed
 */
function pp_long_day_format( $day = '' )
{
	$days = array(
		'Sunday'        => __('Sunday', 'bb-powerpack'),
		'Monday'        => __('Monday', 'bb-powerpack'),
		'Tuesday'       => __('Tuesday', 'bb-powerpack'),
		'Wednesday'     => __('Wednesday', 'bb-powerpack'),
		'Thursday'      => __('Thursday', 'bb-powerpack'),
		'Friday'        => __('Friday', 'bb-powerpack'),
		'Saturday'      => __('Saturday', 'bb-powerpack'),
	);

	if ( isset( $days[$day] ) ) {
		return $days[$day];
	}
	else {
		return $days;
	}
}

/**
 * Returns short day format.
 *
 * @since 1.2.2
 * @param string $day
 * @return string
 */
function pp_short_day_format( $day )
{
	$days = array(
		'Sunday'        => __('Sun', 'bb-powerpack'),
		'Monday'        => __('Mon', 'bb-powerpack'),
		'Tuesday'       => __('Tue', 'bb-powerpack'),
		'Wednesday'     => __('Wed', 'bb-powerpack'),
		'Thursday'      => __('Thu', 'bb-powerpack'),
		'Friday'        => __('Fri', 'bb-powerpack'),
		'Saturday'      => __('Sat', 'bb-powerpack'),
	);

	if ( isset( $days[$day] ) ) {
		return $days[$day];
	}
}

/**
 * Returns user agent.
 *
 * @since 1.2.4
 * @return string
 */
function pp_get_user_agent()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	if (stripos( $user_agent, 'Chrome') !== false)
	{
	    return 'chrome';
	}
	elseif (stripos( $user_agent, 'Safari') !== false)
	{
	   return 'safari';
	}
	elseif (stripos( $user_agent, 'Firefox') !== false)
	{
	   return 'firefox';
	}
}
