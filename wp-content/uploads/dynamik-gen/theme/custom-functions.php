<?php
/* Do not remove this line. Add your functions below. */

//* Add custom body class to the head if beaberbuilder is activated
add_filter( 'body_class', 'fl_builder_class' );
function fl_builder_class( $classes ) {
	$gd_value = get_post_meta(get_the_ID(), '_genesis_dambuster_template', true);
	$gd_value = unserialize($gd_value);
	$gb_enabled = $gd_value['enabled'][0];
	$gd_full_width = $gd_value['full_width'][0];
	
	if (FLBuilderModel::is_builder_enabled() && in_array('page-template-page-builder',$classes)) {
		$classes[] = 'fl-builder-page-builder';
		return $classes;
	}
	else if (FLBuilderModel::is_builder_enabled() && in_array('page-template-blank-template',$classes)) {
		$classes[] = 'fl-builder-page-builder';
		return $classes;
	}
	else if (FLBuilderModel::is_builder_enabled() && $gb_enabled == '1' && $gd_full_width == '1') {
		$classes[] = 'fl-builder-page-builder';
		return $classes;
	}
	else {
		return $classes;
	}
}

//* Add theme support for new menu
//* Add Footer Menu; Keep Primary and Secondary Menus
add_theme_support ( 'genesis-menus' , array ( 
	'primary'   => __( 'Primary Navigation Menu', 'genesis' ),
	'secondary' => __( 'Secondary Navigation Menu', 'genesis' ),
	'responsive'    => __( 'Responsive Navigation Menu', 'genesis' )
) );

//* Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

//* Modify breadcrumb arguments.
add_filter( 'genesis_breadcrumb_args', 'sp_breadcrumb_args' );
function sp_breadcrumb_args( $args ) {
	$args['home'] = '<i class="fa fa-home"></i> Home';
	$args['sep'] = ' <i class="fa fa-angle-right"></i> ';
	$args['list_sep'] = ', '; // Genesis 1.5 and later
	$args['prefix'] = '<div class="breadcrumb"><div class="wrap">';
	$args['suffix'] = '</div></div>';
	$args['heirarchial_attachments'] = true; // Genesis 1.5 and later
	$args['heirarchial_categories'] = true; // Genesis 1.5 and later
	$args['display'] = true;
	$args['labels']['prefix'] = '';
	$args['labels']['author'] = '';
	$args['labels']['category'] = ''; // Genesis 1.6 and later
	$args['labels']['tag'] = '';
	$args['labels']['date'] = '';
	$args['labels']['search'] = 'Search for ';
	$args['labels']['tax'] = '';
	$args['labels']['post_type'] = '';
	$args['labels']['404'] = 'Not found: '; // Genesis 1.5 and later
	return $args;
}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'sp_remove_comment_form_allowed_tags' );
function sp_remove_comment_form_allowed_tags( $defaults ) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}

//* Genesis Search Form Shortcode [genesis_search_form]
add_shortcode( 'genesis_search_form', 'get_search_form' );

//* Modify the Genesis content limit read more link
add_filter( 'get_the_content_more_link', 'sp_read_more_link' );
function sp_read_more_link() {
	return '...<br><br><a class="fl-button-custom" href="' . get_permalink() . '">READ MORE</a>';
}

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
	echo do_shortcode( '[footer_credit]' );
}

//* Add Single Post Navigation Links in Genesis
add_action( 'genesis_entry_footer', 'genesis_prev_next_post_nav' );

//* Remove edit link
add_filter( 'genesis_edit_post_link' , '__return_false' );

//* Add Image Size
/*
add_image_size( 'post-thumbnail', 450, 300, TRUE );
*/

//* Show custom image sizes in media uploader
/*
add_filter( 'image_size_names_choose', 'show_custom_image_sizes_in_uploader' );
function show_custom_image_sizes_in_uploader( $sizes ) {
	$sizes['post-thumbnail'] = 'Post Thumbnail';
	return $sizes;
}
*/

//* Genesis Archive Setting
/*
add_action('init', 'genesis_archive_setting');
function genesis_archive_setting() {
	$types = array('services');
	foreach ( $types as $type ) {
	   add_post_type_support( $type, 'genesis-cpt-archives-settings');
	}
}
*/

//* Force full width layout on all archive pages
/*
add_filter( 'genesis_pre_get_option_site_layout', 'full_width_layout_service_archives' );
function full_width_layout_service_archives( $opt ) {
	if ( is_singular('post-type') ) {
		$opt = 'full-width-content';
		return $opt;
	}
} 
*/

//* Remove Blog Format in CPT
/*
add_action( 'genesis_before','remove_blog_structure' );
function remove_blog_structure() {
	if ( is_singular('post-type') || is_post_type_archive('post-type') ) {

		//* Remove the entry meta in the entry header (requires HTML5 theme support)
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		
		//* Remove the entry title (requires HTML5 theme support)
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

		//* Remove the entry footer markup (requires HTML5 theme support)
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

		//* Remove the entry meta in the entry footer (requires HTML5 theme support)
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	}
}
*/

//* Envira Script
add_action('wp_head', 'ekf_frontend_header', 99);
function ekf_frontend_header() {
	wp_enqueue_style( 'envira-gallery-style' );
	wp_enqueue_script( 'envira-gallery-script' );
}

//* Envira Custom Lightbox
add_action('wp_footer', 'ekf_frontend_footer', 99);
function ekf_frontend_footer() {
	?>
	<script type="text/javascript">jQuery('.envirabox').envirabox();</script>
	<?php
}

//* Remove the entry header markup (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Unregister primary/secondary navigation menus
remove_theme_support( 'genesis-menus' );


//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_filter( 'wpv_filter_query', 'show_empty_default_func', 10, 2 );
     
function show_empty_default_func( $query_args, $setting ) {
    if($setting['view_id'] == 135)
    {
        if( !isset($_GET['arrival-date'])) 
        {
            $query_args['post__in'] = array(0);
        }
    }
    return $query_args;
}

add_action( 'init', 'remove_entry_meta', 11 );

function remove_entry_meta() {

	remove_post_type_support( 'package', 'genesis-entry-meta-before-content' );
	remove_post_type_support( 'package', 'genesis-entry-meta-after-content' );

}

add_action ( 'genesis_before_content', 'sk_show_category_name' );
function sk_show_category_name() {
$category = get_the_category();
if (is_category()) {
    echo '<h2 id="cat-name">' . $category[0]->cat_name . ' Packages</h2>';
}
}

add_action( 'genesis_after_header', 'special_deals_test' );
function special_deals_test () {
	$special_deals = do_shortcode('[types field="special-deal"][/types]');
	if ( $special_deals == '1' ) {

		echo '<div class="breadcrumb"> <span><a href="/">Home</a> <i class="fa fa-angle-right"></i> <a href="/special-deals/">Special Deals</a>';
		if ( in_category ( 'Vanuatu' )) {
			echo '<i class="fa fa-angle-right"></i> <a href="/special-deals/vanuatu/">Vanuatu</a> <i class="fa fa-angle-right"></i>';
			echo get_the_title();
			echo '</span>';
		}

		elseif ( in_category ( 'Maldives' )) {
			echo '<i class="fa fa-angle-right"></i> <a href="/special-deals/maldives/">Maldives</a> <i class="fa fa-angle-right"></i>';
			echo get_the_title();
			echo '</span>';
		}	

		elseif ( in_category ( 'Tahiti' )) {
			echo '<i class="fa fa-angle-right"></i> <a href="/special-deals/tahiti/">Tahiti</a> <i class="fa fa-angle-right"></i>';
			echo get_the_title();
			echo '</span>';
		}	

		elseif ( in_category ( 'Fiji' )) {
			echo '<i class="fa fa-angle-right"></i> <a href="/special-deals/fiji/">Fiji</a> <i class="fa fa-angle-right"></i>';
			echo get_the_title();
			echo '</span>';
		}

		elseif ( in_category ( 'Malaysia' )) {
			echo '<i class="fa fa-angle-right"></i> <a href="/special-deals/malaysia/">Malaysia</a> <i class="fa fa-angle-right"></i>';
			echo get_the_title();
			echo '</span>';
		}	

		elseif ( in_category ( 'Samoa' )) {
			echo '<i class="fa fa-angle-right"></i> <a href="/special-deals/samoa/">Samoa</a> <i class="fa fa-angle-right"></i>';
			echo get_the_title();
			echo '</span>';
		}	

		elseif ( in_category ( 'Philippines' )) {
			echo '<i class="fa fa-angle-right"></i> <a href="/special-deals/philippines/">Philippines</a> <i class="fa fa-angle-right"></i>';
			echo get_the_title();
			echo '</span>';
		}										
		
		echo '</div>';
	}

	else {

	}
}

function b3m_remove_genesis_breadcrumb() {
$special_deals = do_shortcode('[types field="special-deal"][/types]');
  if ( $special_deals == '1' )  
	remove_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );
}
add_action( 'genesis_before', 'b3m_remove_genesis_breadcrumb' );

add_shortcode('wpv-calculate', 'calculate_shortcode');
function calculate_shortcode($atts) {
	return wpv_condition($atts, 0);
}

function format_my_number($atts) {
    $num = $atts["num"];
     
    return number_format($num, 0, '.', ',');
}
add_shortcode("format-currency", "format_my_number");