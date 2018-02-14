<?php
/**
 * This file houses the functions that don't fit in any of the
 * other Dynamik function files.
 *
 * @package Dynamik
 */

add_action( 'genesis_meta', 'dynamik_responsive_viewport' );
/**
 * Add viewport meta tag to the genesis_meta hook
 * to force 'real' scale of site when viewed in mobile devices.
 *
 * @since 1.0
 */
function dynamik_responsive_viewport()
{
	if( !dynamik_get_settings( 'responsive_enabled' ) )
		return false;

	echo '<meta name="viewport" content="' . dynamik_get_responsive( 'viewport_meta_content' ) . '" id="dynamik-viewport"/>' . "\n";
}

add_filter( 'genesis_pre_load_favicon', 'dynamik_load_favicon' );
/**
 * Return favicon link if one is found.
 *
 * @since 1.0
 * @return url to favicon image if one is located in /wp-content/uploads/dynamik-gen/theme/images/
 */
function dynamik_load_favicon()
{
	if( file_exists( dynamik_get_stylesheet_location( 'path' ) . 'images/favicon.ico' ) )
		$favicon = dynamik_get_stylesheet_location( 'url' ) . 'images/favicon.ico';
	elseif( file_exists( dynamik_get_stylesheet_location( 'path' ) . 'images/favicon.gif' ) )
		$favicon = dynamik_get_stylesheet_location( 'url' ) . 'images/favicon.gif';
	elseif( file_exists( dynamik_get_stylesheet_location( 'path' ) . 'images/favicon.png' ) )
		$favicon = dynamik_get_stylesheet_location( 'url' ) . 'images/favicon.png';
	elseif( file_exists( dynamik_get_stylesheet_location( 'path' ) . 'images/favicon.jpg' ) )
		$favicon = dynamik_get_stylesheet_location( 'url' ) . 'images/favicon.jpg';
	else
		$favicon = PARENT_URL . '/images/favicon.ico';

	if( $favicon )
	{
		return $favicon;
	}
	else
	{
		return false;
	}
}

add_filter( 'avatar_defaults', 'dynamik_default_avatar' );
/**
 * Display a Custom Avatar if one exists with the correct name
 * and in the correct images directory.
 *
 * @since 1.0.1
 * @return custom avatar.
 */
function dynamik_default_avatar( $avatar_defaults )
{
	$custom_avatar_image = '';
	if( file_exists( dynamik_get_stylesheet_location( 'path' ) . 'images/custom-avatar.png' ) )
		$custom_avatar_image = dynamik_get_stylesheet_location( 'url' ) . 'images/custom-avatar.png';
	elseif( file_exists( dynamik_get_stylesheet_location( 'path' ) . 'images/custom-avatar.jpg' ) )
		$custom_avatar_image = dynamik_get_stylesheet_location( 'url' ) . 'images/custom-avatar.jpg';
	elseif( file_exists( dynamik_get_stylesheet_location( 'path' ) . 'images/custom-avatar.gif' ) )
		$custom_avatar_image = dynamik_get_stylesheet_location( 'url' ) . 'images/custom-avatar.gif';
	elseif( file_exists( dynamik_get_stylesheet_location( 'path' ) . 'images/custom-avatar.jpg' ) )
		$custom_avatar_image = dynamik_get_stylesheet_location( 'url' ) . 'images/custom-avatar.jpg';

	$custom_avatar = apply_filters( 'dynamik_custom_avatar_path', $custom_avatar_image );
	$avatar_defaults[$custom_avatar] = 'Custom Avatar';

	return $avatar_defaults;
}

add_action('after_setup_theme', 'dynamik_add_custom_thumb_sizes');
/**
 * Add custom thumbnail sizes if set in Dynamik Settings.
 *
 * @since 1.0
 */
function dynamik_add_custom_thumb_sizes()
{
	if( dynamik_get_settings( 'custom_image_size_one_mode' ) == '' )
		return;

	$custom_image_size_one_crop = dynamik_get_settings( 'custom_image_size_one_mode' ) == 'crop' ? true : false;
	add_image_size( 'custom-thumb-1', dynamik_get_settings( 'custom_image_size_one_width' ), dynamik_get_settings( 'custom_image_size_one_height' ), $custom_image_size_one_crop );

	if( dynamik_get_settings( 'custom_image_size_two_mode' ) != '' )
	{
		$custom_image_size_two_crop = dynamik_get_settings( 'custom_image_size_two_mode' ) == 'crop' ? true : false;
		add_image_size( 'custom-thumb-2', dynamik_get_settings( 'custom_image_size_two_width' ), dynamik_get_settings( 'custom_image_size_two_height' ), $custom_image_size_two_crop );
	}
	if( dynamik_get_settings( 'custom_image_size_three_mode' ) != '' )
	{
		$custom_image_size_three_crop = dynamik_get_settings( 'custom_image_size_three_mode' ) == 'crop' ? true : false;
		add_image_size( 'custom-thumb-3', dynamik_get_settings( 'custom_image_size_three_width' ), dynamik_get_settings( 'custom_image_size_three_height' ), $custom_image_size_three_crop );
	}
	if( dynamik_get_settings( 'custom_image_size_four_mode' ) != '' )
	{
		$custom_image_size_four_crop = dynamik_get_settings( 'custom_image_size_four_mode' ) == 'crop' ? true : false;
		add_image_size( 'custom-thumb-4', dynamik_get_settings( 'custom_image_size_four_width' ), dynamik_get_settings( 'custom_image_size_four_height' ), $custom_image_size_four_crop );
	}
	if( dynamik_get_settings( 'custom_image_size_five_mode' ) != '' )
	{
		$custom_image_size_five_crop = dynamik_get_settings( 'custom_image_size_five_mode' ) == 'crop' ? true : false;
		add_image_size( 'custom-thumb-5', dynamik_get_settings( 'custom_image_size_five_width' ), dynamik_get_settings( 'custom_image_size_five_height' ), $custom_image_size_five_crop );
	}
}

add_filter( 'image_size_names_choose', 'dynamik_add_custom_thumbs' );
/**
 * Add any Custom Dynamik Thumbnails to the WP Media Uploader.
 *
 * @since 1.5
 */
function dynamik_add_custom_thumbs( $thumb_sizes ) {
	$custom_thumb_sizes = array(
		'custom-thumb-1' => 'Custom Thumb 1',
		'custom-thumb-2' => 'Custom Thumb 2',
		'custom-thumb-3' => 'Custom Thumb 3',
		'custom-thumb-4' => 'Custom Thumb 4',
		'custom-thumb-5' => 'Custom Thumb 5'
	);

	return array_merge( $thumb_sizes, $custom_thumb_sizes );
}

add_action( 'get_header', 'dynamik_remove_page_titles' );
/**
 * Remove all or specific page titles if specified in Dynamik Settings.
 *
 * @since 1.0
 */
function dynamik_remove_page_titles()
{
	global $post;
	$post_title_hook = dynamik_get_settings( 'html_five_active' ) ? 'genesis_entry_header' : 'genesis_post_title';

	if( !is_page() || is_page_template( 'page_blog.php' ) )
		return;

	if( dynamik_get_settings( 'remove_all_page_titles' ) )
	{
		remove_action( $post_title_hook, 'genesis_do_post_title' );
		return;
	}

	if( dynamik_get_settings( 'remove_page_titles_ids' ) == '' )
		return;

	foreach( explode( ',', dynamik_get_settings( 'remove_page_titles_ids' ) ) as $remove_page_titles_id )
	{
		if( $post->ID == $remove_page_titles_id )
			remove_action( $post_title_hook, 'genesis_do_post_title' );
	}
}

add_action( 'init', 'dynamik_add_post_type_support', 9999 );
/**
 * Add Genesis In-Post options into Custom Post Types
 * if enabled in Dynamik Settings.
 *
 * @since 1.0
 */
function dynamik_add_post_type_support()
{
	if( dynamik_get_settings( 'include_inpost_cpt_all' ) )
	{
		foreach( get_post_types( array( 'public' => true ) ) as $post_type )
		{
			add_post_type_support( $post_type, array( 'genesis-seo', 'genesis-scripts', 'genesis-layouts' ) );
		}
	}
	else
	{
		$post_types = explode( ',', dynamik_get_settings( 'include_inpost_cpt_names' ) );

		foreach ( $post_types as $post_type )
		{
			add_post_type_support( $post_type, array( 'genesis-seo', 'genesis-scripts', 'genesis-layouts' ) );
		}
	}
}

$header_title_area_center = dynamik_get_design( 'header_title_area_center' );
/**
 * Remove the Header Right Widget Area if Title Area is centered.
 */
if( !empty( $header_title_area_center ) )
{
	unregister_sidebar( 'header-right' );
}

/**
 * Add support for Post Formats.
 */
if( dynamik_get_settings( 'post_formats_active' ) )
{
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	add_theme_support( 'genesis-post-format-images' );
}

/**
 * Add support for Genesis HTML5 Markup.
 */
if( dynamik_get_settings( 'html_five_active' ) )
{
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
}

/**
 * Add support for Genesis "Fancy Dropdowns".
 */
if( dynamik_get_settings( 'html_five_active' ) && dynamik_get_settings( 'fancy_dropdowns_active' ) )
{
	add_filter( 'genesis_superfish_enabled', '__return_true' );
}

/**
 * XHTML to HTML5 Markup conversion.
 *
 * @since 1.1
 */
function dynamik_html_markup( $markup )
{
	if( dynamik_get_settings( 'html_five_active' ) )
	{
		$html_markup = array(
			'site_container' => '.site-container',
			'site_header' => '.site-header',
			'title_area' => '.title-area',
			'site_title' => '.site-title',
			'site_description' => '.site-description',
			'nav_primary' => '.nav-primary',
			'nav_secondary' => '.nav-secondary',
			'site_inner' => '.site-inner',
			'content_sidebar_wrap' => '.content-sidebar-wrap',
			'content' => '.content',
			'entry_header_entry_meta' => '.entry-header .entry-meta',
			'entry_footer_entry_meta' => '.entry-footer .entry-meta',
			'pagination' => '.pagination',
			'sidebar_primary' => '.sidebar-primary',
			'sidebar_secondary' => '.sidebar-secondary',
			'site_footer' => '.site-footer',
			'author_box_title' => '.author-box-title',
			'author_box_content' => '.author-box-content',
			'comment_author_link' => '.comment-author span',
			'comment_meta' => '.comment-meta',
			'comment_reply' => '.comment-reply',
			'entry_pings' => '.entry-pings',
			'respond_label' => 'display: block;',
			'search_form' => '.search-form',
			'search_form_search' => '.search-form input[type="search"]',
			'search_form_submit' => '.search-form input[type="submit"]'
		);
	}
	else
	{
		$html_markup = array(
			'site_container' => '#wrap',
			'site_header' => '#header',
			'title_area' => '#title-area',
			'site_title' => '#title',
			'site_description' => '#description',
			'nav_primary' => '#nav',
			'nav_secondary' => '#subnav',
			'site_inner' => '#inner',
			'content_sidebar_wrap' => '#content-sidebar-wrap',
			'content' => '#content',
			'entry_header_entry_meta' => '.post-info',
			'entry_footer_entry_meta' => '.post-meta',
			'pagination' => '.navigation',
			'sidebar_primary' => '#sidebar',
			'sidebar_secondary' => '#sidebar-alt',
			'site_footer' => '#footer',
			'author_box_title' => '.author-box strong',
			'author_box_content' => '.author-box p',
			'comment_author_link' => '.comment-author cite',
			'comment_meta' => '.commentmetadata',
			'comment_reply' => '.reply',
			'entry_pings' => '#pings',
			'respond_label' => '',
			'search_form' => '.searchform',
			'search_form_search' => '.s',
			'search_form_submit' => '.searchsubmit'
		);
	}

	// Return $html_markup[$markup].
	return apply_filters( 'dynamik_html_markup', $html_markup[$markup] );
}

add_action( 'get_header', 'dynamik_bbpress_actions' );
/**
 * Add support for the BBPress Forum Plugin.
 *
 * @since 1.0.3
 */
function dynamik_bbpress_actions()
{
	if ( class_exists( 'bbPress' ) && is_bbpress() )
	{
		//remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
		remove_action( 'genesis_before_post_content', 'genesis_post_info' );
		remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
		remove_action( 'genesis_after_post', 'genesis_do_author_box_single' );
	}
}

add_filter( 'frontpage_template', 'dynamik_enable_custom_template_front_page' );
/**
 * Enable Custom Page Template use in Settings > Reading > "Front page displays" option.
 *
 * @since 1.5
 */
function dynamik_enable_custom_template_front_page( $template )
{
	// Check if a custom template has been selected
	if ( get_page_template_slug() )
		return get_page_template();

	return $template;
}

add_filter( 'genesis_author_box_gravatar_size', 'dynamik_author_box_gravatar_size' );
/**
 * Modify the size of the Gravatar in the author box.
 *
 * @since 1.5
 */
function dynamik_author_box_gravatar_size( $size )
{
	return dynamik_get_design_alt( 'author_box_avatar_size' ) * 2;
}

add_filter( 'genesis_comment_list_args', 'dynamik_comments_gravatar_size' );
/**
 * Modify the size of the Gravatar in comments.
 *
 * @since 1.5
 */
function dynamik_comments_gravatar_size( $args )
{
	$args['avatar_size'] = dynamik_get_design_alt( 'comment_avatar_size' ) * 2;
	return $args;
}

add_action( 'genesis_loop', 'dynamik_content_filler' );
add_action( 'dynamik_hook_after_ez_home', 'dynamik_content_filler' );
/**
 * Fill in the content with 3000px by 1px transparent image to account
 * for a content area width issue that occurs when "Delayed" Content
 * is enabled in the Responsive Design Options or when the EZ Static Homepage
 * is enabled with the Home Sidebar active.
 *
 * @since 1.5
 */
function dynamik_content_filler()
{
	if( dynamik_get_design( 'content_filler_image_type' ) == 'Disabled' )
		return;
	
	?><img src="<?php echo CHILD_URL . '/images/content-filler.png'; ?>" class="dynamik-content-filler-img" alt=""><?php
}

/**
 * Check if directory exists and try and create it if it does not.
 *
 * @since 1.5
 * @return true or false based on the findings of the function.
 */
function dynamik_dir_check( $dir )
{
	if( !is_dir( $dir ) )
	{
		mkdir( $dir );
		@chmod( $dir, 0755 );
	}

	if( is_dir( $dir ) )
		return true;
	else
		return false;
}

/**
 * Minify (strip out unnecessary stuff) CSS code.
 *
 * @since 1.0
 * @return a minified version of CSS code.
 */
function dynamik_minify_css( $css )
{
    $css = preg_replace( '/\s+/', ' ', $css );
    $css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
    $css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
    $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
    $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
    $css = preg_replace( '/0 0 0 0/', '0', $css );

    return apply_filters( 'dynamik_minify_css', $css );
}

/**
 * Preserve backslasshes in Custom CSS when appropriate.
 *
 * @since 1.5
 * @return CSS code with preserved backslashes.
 */
function dynamik_preserve_backslashes( $css )
{
    $css = str_replace( 'content: " ', 'content: " \\', $css );
    $css = str_replace( 'content:" ', 'content:" \\', $css );
    $css = str_replace( 'content: "', 'content: "\\', $css );
    $css = str_replace( 'content:"', 'content:"\\', $css );
    $css = str_replace( 'content: \'', 'content: \'\\', $css );
    $css = str_replace( 'content:\'', 'content:\'\\', $css );

    return apply_filters( 'dynamik_preserve_backslashes', $css );
}

/**
 * Sanatize strings of text.
 *
 * @since 1.2
 */
function dynamik_sanatize_string( $string, $underscore = false )
{
    // Lowercase everything.
    $string = strtolower( $string );
    // Make alphaunermic.
    $string = preg_replace( '/[^a-z0-9_\s-]/', '', $string );
    // Clean multiple dashes or whitespaces.
    $string = preg_replace( '/[\s-]+/', ' ', $string );
    if( true == $underscore )
    {
	    // Convert whitespaces and dashes to underscore.
	    $string = preg_replace( '/[\s-]/', '_', $string );
    }
    else
    {
	    // Convert whitespaces and underscore to dash.
	    $string = preg_replace( '/[\s_]/', '-', $string );
	}
    return $string;
}

/**
 * "Un-Sanatize" strings of text.
 *
 * @since 1.6
 */
function dynamik_unsanatize_string( $string )
{
    // Convert underscores to whitespaces.
    $string = str_replace( '_', ' ', $string );

    // Uppercase case everything.
    $string = ucwords( $string );

    return $string;
}

/**
 * This is altered version of the genesis_get_custom_field() function
 * which includes the additional ability to work with array() values.
 *
 * @since 1.2
 */
function dynamik_get_custom_field( $field, $single = true, $explode = false )
{
	if( null === get_the_ID() )
		return '';

	$custom_field = get_post_meta( get_the_ID(), $field, $single );

	if( !$custom_field )
		return '';

	if( !$single )
	{
		$custom_field_string = implode( ',', $custom_field );
		if( $explode )
		{
			$custom_field_array_pre = explode( ',', $custom_field_string );
			foreach( $custom_field_array_pre as $key => $value )
			{
				$custom_field_array[$value] = $value;
			}
			return $custom_field_array;
		}
		return $custom_field_string;
	}

	return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );
}

/**
 * Create a Dynamik Label conditional tag which
 * allows content to be conditionally placed on pages and posts
 * that have specific Dynamik Labels assigned to them.
 *
 * @since 1.2
 */
function dynamik_has_label( $label = 'label' )
{
	$labels_meta_array = dynamik_get_custom_field( '_dyn_labels', false, true ) != '' ? dynamik_get_custom_field( '_dyn_labels', false, true ) : array();

	if( is_singular() )
	{
		if( in_array( $label, $labels_meta_array ) ) return true;
	}

	return false;
}

/**
 * Create a Genesis Simple Sidebars conditional tag which
 * allows content to be conditionally placed on pages and posts
 * that have specific simple sidebars assigned to them.
 *
 * @since 1.2
 */
function dynamik_is_ss( $sidebar_id = 'sb-id' )
{
	if( !defined( 'SS_SETTINGS_FIELD' ) )
		return false;

	static $taxonomies = null;

	if( is_singular() )
	{
		if( $sidebar_id == genesis_get_custom_field( '_ss_sidebar' ) ) return true;
	}

	if( is_category() )
	{
		$term = get_term( get_query_var( 'cat' ), 'category' );
		if( isset( $term->meta['_ss_sidebar'] ) && $sidebar_id == $term->meta['_ss_sidebar'] ) return true;
	}

	if( is_tag() )
	{
		$term = get_term( get_query_var( 'tag_id' ), 'post_tag' );
		if( isset( $term->meta['_ss_sidebar'] ) && $sidebar_id == $term->meta['_ss_sidebar'] ) return true;
	}

	if( is_tax() )
	{
		if ( null === $taxonomies )
			$taxonomies = ss_get_taxonomies();

		foreach ( $taxonomies as $tax )
		{
			if ( 'post_tag' == $tax || 'category' == $tax )
				continue;

			if ( is_tax( $tax ) )
			{
				$obj = get_queried_object();
				$term = get_term( $obj->term_id, $tax );
				if( isset( $term->meta['_ss_sidebar'] ) && $sidebar_id == $term->meta['_ss_sidebar'] ) return true;
				break;
			}
		}
	}

	return false;
}

/**
 * Enable Shortcodes in Text Widgets.
 */
add_filter( 'widget_text', 'do_shortcode' );

add_filter( 'body_class', 'dynamik_body_classes' );
/**
 * Create an array of body classes that reflect various Dynamik settings.
 *
 * @since 1.0
 * @return an array of Dynamik body classes.
 */
function dynamik_body_classes( $classes )
{
	$browser = $_SERVER['HTTP_USER_AGENT'];

	// OS specific classes
	if( preg_match( '/Mac/', $browser ) )
		$classes[] = 'mac';
	elseif( preg_match( '/Windows/', $browser ) )
		$classes[] = 'windows';
	elseif( preg_match( '/Linux/', $browser ) )
		$classes[] = 'linux';
	else
		$classes[] = 'unknown-os';

	// Browser specific classes
	if( preg_match( '/Chrome/', $browser ) )
	{
		$classes[] = 'chrome';
	}
	elseif( preg_match( '/Safari/', $browser ) )
	{
		$classes[] = 'safari';

		preg_match( '/Version\/(\d.\d)/si', $browser, $matches );

		if( isset( $matches[0] ) && isset( $matches[0][1] ) )
		  $sf_version = 'sf' . str_replace( '.', '-', $matches[1] );
		else
		  $sf_version = '';

		$classes[] = $sf_version;
	}
	elseif( preg_match( '/Opera/', $browser ) )
	{
		$classes[] = 'opera';

		preg_match( '/Opera\/(\d.\d)/si', $browser, $matches );
		$op_version = 'op' . str_replace( '.', '-', $matches[1] );
		$classes[] = $op_version;
	}
	elseif( preg_match( '/MSIE/', $browser ) )
	{
		$classes[] = 'msie';

		if( preg_match( '/MSIE 6.0/', $browser ) )
				$classes[] = 'ie6';
		elseif( preg_match( '/MSIE 7.0/', $browser ) )
				$classes[] = 'ie7';
		elseif( preg_match( '/MSIE 8.0/', $browser ) )
				$classes[] = 'ie8';
		elseif( preg_match( '/MSIE 9.0/', $browser ) )
				$classes[] = 'ie9';
		elseif( preg_match( '/MSIE 10.0/', $browser ) )
				$classes[] = 'ie10';
	}
	elseif( '!!navigator.userAgent.match(/Trident.*rv\:11\./)' )
	{
		$classes[] = 'ie11';
	}
	elseif( preg_match( '/Firefox/', $browser ) && preg_match( '/Gecko/', $browser ) )
	{
		$classes[] = 'firefox';

		preg_match( '/Firefox\/(\d)/si', $browser, $matches );
		$ff_version = 'ff' . str_replace( '.', '-', $matches[1] );
		$classes[] = $ff_version;
	}
	else
	{
		$classes[] = 'unknown-browser';
	}

	if( is_front_page() && dynamik_get_design_alt( 'ez_home_slider_display' ) )
	{
		$classes[] = 'ez-home-slider';

		if( dynamik_get_design_alt( 'ez_home_slider_location' ) == 'inside' )
		{
			$classes[] = 'slider-inside';
		}
	}

	if( is_front_page() && dynamik_get_design_alt( 'dynamik_homepage_type' ) == 'static_home' &&
		dynamik_get_design_alt( 'ez_homepage_select' ) )
	{
		$classes[] = 'ez-home';

		if( dynamik_get_design_alt( 'ez_static_home_sb_display' ) )
		{
			$classes[] = 'ez-home-sidebar';
		}

		if( dynamik_get_design_alt( 'ez_static_home_sb_location' ) == 'left' )
		{
			$classes[] = 'home-sidebar-left';
		}
	}

	if( dynamik_get_design_alt( 'ez_feature_top_position' ) == 'outside_inner' )
		$classes[] = 'feature-top-outside';

	if( dynamik_get_design_alt( 'ez_fat_footer_position' ) == 'inside_inner' )
		$classes[] = 'fat-footer-inside';

	if( dynamik_get_design_alt( 'wrap_structure' ) == 'fluid' )
		$classes[] = 'site-fluid';

	if( is_singular() && dynamik_get_custom_field( '_dyn_labels', false, true ) != '' )
	{
		foreach ( dynamik_get_custom_field( '_dyn_labels', false, true ) as $key => $value )
		{
			$classes[] = 'label-' . $key;
		}
	}

	if( defined( 'DYNAMIK_LABEL_WIDTH' ) )
		$classes[] = DYNAMIK_LABEL_WIDTH;

	$classes[] = 'override';

	return $classes;
}

add_filter( 'post_class', 'dynamik_post_classes' );
/**
 * Create an array of useful post classes.
 *
 * @since 1.3
 * @return an array of Dynamik post classes.
 */
function dynamik_post_classes( $classes )
{
	$classes[] = 'override';

	return $classes;
}

if ( dynamik_get_custom_css( 'css_builder_popup_active' ) && current_user_can( 'administrator' ) && PHP_VERSION >= 5.3 )
	add_action( 'wp_head', 'dynamik_hooks_map' );
	
/**
 * Display Genesis action hooks on front-end of site (visible to logged in admins only)
 *
 * @since 2.0
 */
function dynamik_hooks_map() {
    
    $hooks = dynamik_hooks_array();
    
    foreach ( $hooks as $hook => $value ) {
        
        add_action( '' . $value . '', function() use ( $value ) { echo '<div id="' . $value . '" class="dynamik-mapped-hooks"></div>'; } );
        
    }
    
}

/**
 * Build an array of Genesis action hooks.
 *
 * @since 2.0
 * @return an array of Genesis action hooks.
 */
function dynamik_hooks_array() {
    
    $hooks = array( 
		'genesis_doctype',
		'genesis_title',
		'genesis_meta',
		'wp_head',
		'genesis_before',
		'genesis_after',
		'genesis_before_header',
		'genesis_header',
		'genesis_after_header',
		'genesis_site_title',
		'genesis_site_description',
		'genesis_header_right',
		'genesis_before_content_sidebar_wrap',
		'genesis_after_content_sidebar_wrap',
		'genesis_before_content',
		'genesis_after_content',
		'dynamik_hook_before_ez_home',
		'dynamik_hook_home',
		'dynamik_hook_after_ez_home',
		'genesis_before_entry',
		'genesis_after_entry',
		'genesis_entry_header',
		'genesis_before_entry_content',
		'genesis_entry_content',
		'genesis_after_entry_content',
		'genesis_entry_footer',
		'genesis_before_post',
		'genesis_after_post',
		'genesis_before_post_title',
		'genesis_post_title',
		'genesis_after_post_title',
		'genesis_before_post_content',
		'genesis_post_content',
		'genesis_after_post_content',
		'genesis_before_loop',
		'genesis_loop',
		'genesis_after_loop',
		'genesis_after_endwhile',
		'genesis_loop_else',
		'genesis_before_comments',
		'genesis_comments',
		'genesis_after_comments',
		'genesis_list_comments',
		'genesis_before_pings',
		'genesis_pings',
		'genesis_after_pings',
		'genesis_before_comment',
		'genesis_after_comment',
		'genesis_before_comment_form',
		'genesis_comment_form',
		'genesis_after_comment_form',
		'genesis_sidebar',
		'genesis_before_sidebar_widget_area',
		'genesis_after_sidebar_widget_area',
		'genesis_sidebar_alt',
		'genesis_before_sidebar_alt_widget_area',
		'genesis_after_sidebar_alt_widget_area',
		'genesis_before_footer',
		'genesis_footer',
		'genesis_after_footer'
    );
    
    return $hooks;
    
}

add_action( 'wp_head', 'dynamik_responsive_php_vars' );
/**
 * Build the javascript variables that are used with Responsive Design.
 *
 * @since 1.3
 */
function dynamik_responsive_php_vars()
{
	if( dynamik_get_responsive( 'navbar_media_query_default' ) != 'vertical_toggle_tablet' &&
		dynamik_get_responsive( 'navbar_media_query_default' ) != 'vertical_toggle' )
		return;
?>
<script type="text/javascript">
<?php
if( genesis_superfish_enabled() )
	echo 'var dynamik_sf_enabled = true;' . "\n";
else
	echo 'var dynamik_sf_enabled = false;' . "\n";

if( true == dynamik_get_responsive( 'vertical_toggle_sub_page_reveal' ) )
	echo 'var dynamik_reveal_sub_pages = true;' . "\n";
else
	echo 'var dynamik_reveal_sub_pages = false;' . "\n";

if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle_tablet' &&
	false == dynamik_get_responsive( 'navbar_media_query_delayed' ) )
	echo 'var media_query_mobile_width = ' . dynamik_get_responsive( 'media_query_large_cascading_width' ) . ';' . "\n";
elseif( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle_tablet' &&
	false != dynamik_get_responsive( 'navbar_media_query_delayed' ) )
	echo 'var media_query_mobile_width = ' . dynamik_get_responsive( 'media_query_medium_cascading_width' ) . ';' . "\n";
else
	echo 'var media_query_mobile_width = ' . dynamik_get_responsive( 'media_query_small_width' ) . ';' . "\n";
?>
</script>
<?php
}

add_action( 'wp_head', 'dynamik_fixed_header_php_vars' );
/**
 * Build the javascript variables that are used when Fixed Header is enabled.
 *
 * @since 2.0
 */
function dynamik_fixed_header_php_vars()
{
	if( dynamik_get_design( 'fixed_header' ) == 'disabled' )
		return;
?>
<script type="text/javascript">
<?php
$fade_effect = dynamik_get_design( 'fixed_header' ) == 'fadein' ? 1 : 0;
$min_width = dynamik_get_responsive( 'header_media_query_default' ) == 'delayed' ? dynamik_get_responsive( 'dynamik_media_query_large_min_width' ) : dynamik_get_responsive( 'dynamik_media_query_large_max_width' );
echo 'var dynamik_fixed_header_fade = ' . $fade_effect . ';' . "\n";
echo 'var dynamik_fixed_header_min_width = ' . apply_filters( 'dynamik_fixed_header_min_width', $min_width ) . ';' . "\n";
?>
</script>
<?php
}

add_action( 'wp_enqueue_scripts', 'dynamik_register_scripts' );
/**
 * Register various bits of javascript.
 *
 * @since 1.3
 */
function dynamik_register_scripts()
{
	$custom_js = get_option( 'dynamik_gen_custom_js' );
	if( !empty( $custom_js['custom_js_in_head'] ) )
		$in_footer = false;
	else
		$in_footer = true;

	wp_register_script( 'js-color-popup', CHILD_URL . '/lib/js/jscolor/jscolor-popup.js', false, CHILD_THEME_VERSION, true );
	wp_register_script( 'responsive', CHILD_URL . '/lib/js/responsive.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_register_script( 'fixed-header', CHILD_URL . '/lib/js/fixed-header.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_register_script( 'custom-scripts', dynamik_get_stylesheet_location( 'url' ) . 'custom-scripts.js', array( 'jquery' ), CHILD_THEME_VERSION, $in_footer );
}

add_action( 'wp_enqueue_scripts', 'dynamik_load_scripts' );
/**
 * Load various bits of javascript.
 *
 * @since 1.3
 */
function dynamik_load_scripts()
{
	if( dynamik_get_settings( 'responsive_enabled' ) )
		wp_enqueue_script( 'responsive' );
		
	if( dynamik_get_design( 'fixed_header' ) != 'disabled' )
		wp_enqueue_script( 'fixed-header' );

	if( file_exists( dynamik_get_custom_js_path() ) && 0 != filesize( dynamik_get_custom_js_path() ) )
		wp_enqueue_script( 'custom-scripts' );
}

/**
 * Add theme support for the Genesis Connect WooCommerce Plugin
 * if the WooCommerce Plugin is active.
 */
if( class_exists( 'Woocommerce' ) )
{
	add_theme_support( 'genesis-connect-woocommerce' );
}

/**
 * Require the currently active Dynamik Skin
 * Functions file only if it exists.
 *
 * @since 1.6
 *
 */
function dynamik_require_skin_functions_file()
{
	if( file_exists( dynamik_get_active_skin_folder_path() . '/functions.php' ) )
	{
		require_once( dynamik_get_active_skin_folder_path() . '/functions.php' );
	}
}

add_action( 'after_setup_theme', 'dynamik_require_custom_widget_areas_register_file' );
/**
 * Require the Dynamik Custom Widget Areas Register file only if it exists.
 *
 * @since 1.0
 *
 */
function dynamik_require_custom_widget_areas_register_file()
{
	if( file_exists( dynamik_get_custom_widget_areas_register_path() ) )
	{
		require_once( dynamik_get_custom_widget_areas_register_path() );
	}
}

add_action( 'after_setup_theme', 'dynamik_require_custom_widget_areas_file' );
/**
 * Require the Dynamik Custom Widget Areas file only on the
 * site's front-end and only if it exists.
 *
 * @since 1.0
 *
 */
function dynamik_require_custom_widget_areas_file()
{
	if( !is_admin() && file_exists( dynamik_get_custom_widget_areas_path() ) )
	{
		require_once( dynamik_get_custom_widget_areas_path() );
	}
}

add_action( 'after_setup_theme', 'dynamik_require_custom_hook_boxes_file' );
/**
 * Require the Dynamik Custom Hook Boxes file only on the
 * site's front-end and only if it exists.
 *
 * @since 1.0
 *
 */
function dynamik_require_custom_hook_boxes_file()
{
	if( !is_admin() && file_exists( dynamik_get_custom_hook_boxes_path() ) )
	{
		require_once( dynamik_get_custom_hook_boxes_path() );
	}
}

/**
 * Require the Dynamik Custom Functions file only on the site's front-end
 * (unless "Affect Admin" option is checked) and only if it exists.
 *
 * @since 1.0
 *
 */
function dynamik_require_custom_functions_file()
{
	$custom_functions = get_option( 'dynamik_gen_custom_functions' );

	if( file_exists( dynamik_get_custom_functions_path() ) &&
		( !empty( $custom_functions['custom_functions_effect_admin'] ) || !is_admin() ) )
	{
		require_once( dynamik_get_custom_functions_path() );
	}
}
