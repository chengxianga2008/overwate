<?php
/**
 * Handels all the Import/Export functionality in Dynamik
 * and the Dynamik Child Theme.
 *
 * @package Dynamik
 */
 
/**
 * Create a string that represnts the current date and time.
 *
 * @since 1.0
 * @return string that represnts the current date and time.
 */
function dynamik_time()
{
	$time = gmdate( 'Y-m-d H:i:s', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
	return strtotime( $time );
}

/**
 * Create all the appropriate files and content that reflect the exported Child Theme
 * and then zip it up and spit it out into the browser for download.
 *
 * @since 1.0
 */
function child_export( $child_name, $author = 'Genesis Theme', $author_uri = 'http://cobaltapps.com/', $version_number = '1.0', $at_style = 'no', $include_default_page_templates = 'yes', $include_protected_folders = 'yes', $include_settings = 'yes', $include_design = 'yes', $include_css = 'yes', $include_functions = 'yes', $include_js = 'yes', $include_templates = 'yes', $include_labels = 'yes', $include_widget_areas = 'yes', $include_hook_boxes = 'yes' )
{
	dynamik_folders_open_permissions();
	dynamik_tmp_folder_cleanup();
	require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
	
	$custom_functions = get_option( 'dynamik_gen_custom_functions' );
	$child_export_zip = strtolower( str_replace( ' ', '-', $child_name ) ) . '.zip';
	$tmp_path = dynamik_get_stylesheet_location( 'path' ) . 'tmp';
	$tmp_child = $tmp_path . '/child';
	$tmp_lib_folder = $tmp_child . '/lib';
	$tmp_image_folder = $tmp_child . '/images';
	$tmp_post_formats_image_folder = $tmp_image_folder . '/post-formats';
	$tmp_my_templates_folder = $tmp_child . '/my-templates';
	$tmp_metaboxes_folder = $tmp_child . '/metaboxes';
	$tmp_js_folder = $tmp_child . '/js';
	$dollar_sign = '$';
	$new_line = '"\n"';
	
	$skin_folder = dynamik_get_active_skin_folder_path();
	$image_folder = dynamik_get_stylesheet_location( 'path' ) . 'images';
	$dynamik_image_folder = dynamik_get_stylesheet_location( 'path' ) . 'default-images';
	$dynamik_post_formats_image_folder = dynamik_get_stylesheet_location( 'path' ) . 'default-images/post-formats';
	$dynamik_my_templates_folder = CHILD_DIR . '/my-templates';
	$dynamik_metaboxes_folder = CHILD_DIR . '/lib/admin/metaboxes';
		
	if( !is_dir( $tmp_path ) )
	{
		mkdir( $tmp_path, 0755, true );
	}
	if( !is_dir( $tmp_child ) )
	{
		mkdir( $tmp_child, 0755, true );
	}
	if( !is_dir( $tmp_lib_folder ) )
	{
		mkdir( $tmp_lib_folder, 0755, true );
	}
	if( !is_dir( $tmp_image_folder ) )
	{
		mkdir( $tmp_image_folder, 0755, true );
	}
	if( !is_dir( $tmp_post_formats_image_folder ) && dynamik_get_settings( 'post_formats_active' ) )
	{
		mkdir( $tmp_post_formats_image_folder, 0755, true );
	}
	if( !is_dir( $tmp_my_templates_folder ) && $include_templates == 'yes' )
	{
		mkdir( $tmp_my_templates_folder, 0755, true );
	}
	if( $include_labels == 'yes' && get_option( 'dynamik_gen_custom_labels' ) != array() )
	{
		if( !is_dir( $tmp_metaboxes_folder ) )
		{
			mkdir( $tmp_metaboxes_folder, 0755, true );
		}
		if( !is_dir( $tmp_metaboxes_folder . '/js' ) )
		{
			mkdir( $tmp_metaboxes_folder . '/js', 0755, true );
		}
		if( !is_dir( $tmp_metaboxes_folder . '/images' ) )
		{
			mkdir( $tmp_metaboxes_folder . '/images', 0755, true );
		}
	}
	if( !is_dir( $tmp_js_folder ) )
	{
		mkdir( $tmp_js_folder, 0755, true );
	}
	
	$style_css = '/*
Theme Name:     ' . $child_name . '
Theme URI:      http://studiopress.com/
Description:    A Genesis Child Theme 
Author:         ' . $author . '
Author URI:     ' . $author_uri . '
Template:       genesis
Version:        ' . $version_number . '
*/
';

	if( $at_style == 'yes' )
	{
		$style_css .= '

/* Import Genesis Parent Styles
------------------------------------------------------------ */

@import url(../genesis/style.css);
';
	}
	
	if( $include_design == 'yes' )
	{
		$style_css .= dynamik_build_design_styles( 'yes' );
	}
	
	if( $include_css == 'yes' && dynamik_get_custom_css( 'custom_css' ) != '' )
	{
		$custom_css_prefix = "\n\n" . '/* ' . __( 'Custom CSS', 'dynamik' ) . "\n" . '------------------------------------------------------------ */' . "\n\n";
		$custom_css = dynamik_get_custom_css( 'custom_css' ) . "\n";
		if( $include_design == 'yes' && dynamik_get_settings( 'responsive_enabled' ) )
		{
			$custom_mq_css_prefix = "\n" . '/* ' . __( 'Custom Responsive CSS', 'dynamik' ) . "\n" . '------------------------------------------------------------ */' . "\n";
			$media_query_css = '
@media only screen and (max-width: ' . dynamik_get_responsive( 'media_wrap_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_large_cascading_content' ) . '
}
@media only screen and (min-width: 768px) and (max-width: ' . dynamik_get_responsive( 'media_wrap_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_large_content' ) . '
}
@media only screen and (min-width: 480px) and (max-width: ' . dynamik_get_responsive( 'media_wrap_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_medium_large_content' ) . '
}
@media only screen and (max-width: 767px) {
' . dynamik_get_responsive( 'media_query_medium_cascading_content' ) . '
}
@media only screen and (min-width: 480px) and (max-width: 767px) {
' . dynamik_get_responsive( 'media_query_medium_content' ) . '
}
@media only screen and (max-width: 479px) {
' . dynamik_get_responsive( 'media_query_small_content' ) . '
}';
		}
		else
		{
			$custom_mq_css_prefix = '';
			$media_query_css = '';
		}
		$style_css .= $custom_css_prefix . $custom_css . $custom_mq_css_prefix . $media_query_css;
	}
	
	$nav_placement_comment = "
/**
 * Manage the placement of navbars.
 */
";
	
	if( dynamik_get_settings( 'responsive_enabled' ) && ( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle_tablet' || dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle' ) )
	{
		if( dynamik_get_design( 'nav1_location' ) == "Above Header" ) { $nav_1_action = "add_action( 'genesis_before_header', 'dynamik_mobile_nav_1' );\nremove_action( 'genesis_after_header', 'genesis_do_nav' );\nadd_action( 'genesis_before_header', 'genesis_do_nav' );\n"; }
		elseif( dynamik_get_design( 'nav1_location' ) == "Below Header" ) { $nav_1_action = "add_action( 'genesis_after_header', 'dynamik_mobile_nav_1', 9 );\n"; }
		
		if( dynamik_get_design( 'nav2_location' ) == "Above Header" ) { $nav_2_action = "add_action( 'genesis_before_header', 'dynamik_mobile_nav_2' );\nremove_action( 'genesis_after_header', 'genesis_do_subnav' );\nadd_action( 'genesis_before_header', 'genesis_do_subnav' );\n"; }
		elseif( dynamik_get_design( 'nav2_location' ) == "Below Header" ) { $nav_2_action = "add_action( 'genesis_after_header', 'dynamik_mobile_nav_2' );\nremove_action( 'genesis_after_header', 'genesis_do_subnav' );\nadd_action( 'genesis_after_header', 'genesis_do_subnav' );\n"; }

		if( true == dynamik_get_responsive( 'vertical_toggle_sub_page_reveal' ) )
			$dynamik_reveal_sub_pages = 'true';
		else
			$dynamik_reveal_sub_pages = 'false';

		if( true == dynamik_get_responsive( 'vertical_toggle_sub_page_reveal' ) )
			$dynamik_reveal_sub_pages = 'true';
		else
			$dynamik_reveal_sub_pages = 'false';

		if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle_tablet' && false == dynamik_get_responsive( 'navbar_media_query_delayed' ) )
			$media_query_mobile_width = dynamik_get_responsive( 'media_query_large_cascading_width' );
		elseif( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle_tablet' && false != dynamik_get_responsive( 'navbar_media_query_delayed' ) )
			$media_query_mobile_width = dynamik_get_responsive( 'media_query_medium_cascading_width' );
		else
			$media_query_mobile_width = dynamik_get_responsive( 'media_query_small_width' );

		$mobile_nav_functions = '
/**
 * Build Nav Mobile Menu HTML.
 *
 * @since 1.0
 */
function dynamik_mobile_nav_1()
{
	if ( ! has_nav_menu( \'primary\' ) )
		return;
?>
	<div class="responsive-primary-menu-container">
		<div class="responsive-menu-icon">
			<span class="responsive-icon-bar"></span>
			<span class="responsive-icon-bar"></span>
			<span class="responsive-icon-bar"></span>
		</div>
		<h3 class="mobile-primary-toggle">' . dynamik_get_responsive( "dropdown_menu_1_text" ) . '</h3>
	</div>
<?php
}

/**
 * Build Subnav Mobile Menu HTML.
 *
 * @since 1.0
 */
function dynamik_mobile_nav_2()
{
	if ( ! has_nav_menu( \'secondary\' ) )
		return;
?>
	<div class="responsive-secondary-menu-container">
		<div class="responsive-menu-icon">
			<span class="responsive-icon-bar"></span>
			<span class="responsive-icon-bar"></span>
			<span class="responsive-icon-bar"></span>
		</div>
		<h3 class="mobile-secondary-toggle">' . dynamik_get_responsive( "dropdown_menu_2_text" ) . '</h3>
	</div>
<?php
}

add_action( \'wp_head\', \'child_responsive_php_vars\' );
/**
 * Build the javascript variables that are used with Responsive Design.
 *
 * @since 1.0
 */
function child_responsive_php_vars() { ?>
<script type="text/javascript">
<?php
if( genesis_superfish_enabled() )
	echo \'var dynamik_sf_enabled = true;\' . "\n";
else
	echo \'var dynamik_sf_enabled = false;\' . "\n";

	echo \'var dynamik_reveal_sub_pages = ' . $dynamik_reveal_sub_pages . ';\' . "\n";
	echo \'var media_query_mobile_width = ' . $media_query_mobile_width . ';\' . "\n";
?>
</script>
<?php
}
';

		$dropdown_menu_register = '';
		$nav_dropdown_functions = '';
	}
	elseif( dynamik_get_settings( 'responsive_enabled' ) && ( dynamik_get_responsive( 'navbar_media_query_default' ) == 'tablet_dropdown' || dynamik_get_responsive( 'navbar_media_query_default' ) == 'mobile_dropdown' ) )
	{
		if( dynamik_get_design( 'nav1_location' ) == "Above Header" ){ $nav_1_action = "remove_action( 'genesis_after_header', 'genesis_do_nav' );\nadd_action( 'genesis_before_header', 'genesis_do_nav' ); add_action( 'genesis_before_header', 'dynamik_dropdown_nav_1' );\n"; }
		elseif( dynamik_get_design( 'nav1_location' ) == "Below Header" ){ $nav_1_action = "add_action( 'genesis_after_header', 'dynamik_dropdown_nav_1' );\n"; }
		
		if( dynamik_get_design( 'nav2_location' ) == "Above Header" ){ $nav_2_action = "remove_action( 'genesis_after_header', 'genesis_do_subnav' );\nadd_action( 'genesis_before_header', 'genesis_do_subnav' ); add_action( 'genesis_before_header', 'dynamik_dropdown_nav_2' );\n"; }
		elseif( dynamik_get_design( 'nav2_location' ) == "Below Header" ){ $nav_2_action = "add_action( 'genesis_after_header', 'dynamik_dropdown_nav_2' );\n"; }

		$mobile_nav_functions = '';

		$dropdown_menu_register = "
/**
 * Register the additional Responsive Dropdown Menus.
 */
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'dynamik' ), 'secondary' => __( 'Secondary Navigation Menu', 'dynamik' ), 'primary_dropdown' => __( 'Responsive Dropdown 1', 'dynamik' ), 'secondary_dropdown' => __( 'Responsive Dropdown 2', 'dynamik' ) ) );
";
		
		$nav_dropdown_functions = '
/**
 * Build Nav Dropdown HTML.
 *
 * @since 1.0
 */
function dynamik_dropdown_nav_1() {
	if ( ! has_nav_menu( \'primary_dropdown\' ) )
		return;
?>
	<div id="dropdown-nav-wrap">
		<!-- dropdown nav for responsive design -->
		<nav id="dropdown-nav" role="navigation">
			<?php dynamik_dropdown_menu_1( array( \'theme_location\' => \'primary_dropdown\', \'dropdown_title\' => \'' . dynamik_get_responsive( 'dropdown_menu_1_text' ) . '\' ) ); ?>
			<div class="responsive-menu-icon">
				<span class="responsive-icon-bar"></span>
				<span class="responsive-icon-bar"></span>
				<span class="responsive-icon-bar"></span>
			</div>
		</nav><!-- #dropdown-nav -->
		<!-- /end dropdown nav -->
	</div>
<?php
}

/**
 * Build Subnav Dropdown HTML.
 *
 * @since 1.0
 */
function dynamik_dropdown_nav_2() {
	if ( ! has_nav_menu( \'secondary_dropdown\' ) )
		return;
?>
	<div id="dropdown-subnav-wrap">	
		<!-- dropdown nav for responsive design -->
		<nav id="dropdown-subnav" role="navigation">
			<?php dynamik_dropdown_menu_2( array( \'theme_location\' => \'secondary_dropdown\', \'dropdown_title\' => \'' . dynamik_get_responsive( 'dropdown_menu_2_text' ) . '\' ) ); ?>
			<div class="responsive-menu-icon">
				<span class="responsive-icon-bar"></span>
				<span class="responsive-icon-bar"></span>
				<span class="responsive-icon-bar"></span>
			</div>
		</nav><!-- #dropdown-subnav -->
		<!-- /end dropdown subnav -->
	</div>
<?php
}

/**
 * The following edited dropdown menu code was
 * pulled from the following WordPress Plugin:
 * http://wordpress.org/plugins/dropdown-menus/
 */

/**
 * Tack on the blank option for urls not in the menu
 */
add_filter( \'wp_nav_menu_items\', \'dropdown_add_blank_item\', 10, 2 );
function dropdown_add_blank_item( $items, $args ) {
	if ( isset( $args->walker ) && is_object( $args->walker ) && method_exists( $args->walker, \'is_dropdown\' ) ) {
		if ( ( ! isset( $args->menu ) || empty( $args->menu ) ) && isset( $args->theme_location ) ) {
			$theme_locations = get_nav_menu_locations();
			$args->menu = wp_get_nav_menu_object( $theme_locations[ $args->theme_location ] );
		}
		$title = isset( $args->dropdown_title ) ? wptexturize( $args->dropdown_title ) : \'&mdash; \' . $args->menu->name . \' &mdash;\';
		if ( !empty( $title ) )
			$items = \'<option value="" class="blank">\' . apply_filters( \'dropdown_blank_item_text\', $title, $args ) . \'</option>\' . $items;
	}
	return $items;
}

/**
 * Remove empty options created in the sub levels output
 */
add_filter( \'wp_nav_menu_items\', \'dropdown_remove_empty_items\', 10, 2 );
function dropdown_remove_empty_items( $items, $args ) {
	if ( isset( $args->walker ) && is_object( $args->walker ) && method_exists( $args->walker, \'is_dropdown\' ) )
		$items = str_replace( "<option></option>", "", $items );
	return $items;
}

/**
 * Overrides the walker argument and container argument then calls wp_nav_menu
 */
function dynamik_dropdown_menu_1( $args ) {
	// if non array supplied use as theme location
	if ( ! is_array( $args ) )
		$args = array( \'menu\' => $args );

	// enforce these arguments so it actually works
	$args[ \'walker\' ] = new Dynamik_DropDown_Nav_Menu();
	$args[ \'items_wrap\' ] = \'<select id="%1$s" class="%2$s mobile-dropdown-menu nav-chosen-select">%3$s</select>\';

	// custom args for controlling indentation of sub menu items
	$args[ \'indent_string\' ] = isset( $args[ \'indent_string\' ] ) ? $args[ \'indent_string\' ] : \'&ndash;&nbsp;\';
	$args[ \'indent_after\' ] =  isset( $args[ \'indent_after\' ] ) ? $args[ \'indent_after\' ] : \'\';

	return wp_nav_menu( $args );
}

/**
 * Overrides the walker argument and container argument then calls wp_nav_menu
 */
function dynamik_dropdown_menu_2( $args ) {
	// if non array supplied use as theme location
	if ( ! is_array( $args ) )
		$args = array( \'menu\' => $args );

	// enforce these arguments so it actually works
	$args[ \'walker\' ] = new Dynamik_DropDown_Nav_Menu();
	$args[ \'items_wrap\' ] = \'<select id="%1$s" class="%2$s mobile-dropdown-menu subnav-chosen-select">%3$s</select>\';

	// custom args for controlling indentation of sub menu items
	$args[ \'indent_string\' ] = isset( $args[ \'indent_string\' ] ) ? $args[ \'indent_string\' ] : \'&ndash;&nbsp;\';
	$args[ \'indent_after\' ] =  isset( $args[ \'indent_after\' ] ) ? $args[ \'indent_after\' ] : \'\';

	return wp_nav_menu( $args );
}

class Dynamik_DropDown_Nav_Menu extends Walker_Nav_Menu {

	// easy way to check it\'s this walker we\'re using to mod the output
	function is_dropdown() {
		return true;
	}

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "</option>";
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "<option>";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : \'\';

		$class_names = $value = \'\';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = \'menu-item-\' . $item->ID;
		$classes[] = \'menu-item-depth-\' . $depth;

		$class_names = join( \' \', apply_filters( \'nav_menu_css_class\', array_unique( array_filter( $classes ) ), $item, $args ) );
		$class_names = \' class="\' . esc_attr( $class_names ) . \'"\';

		$selected = \'\';

		// select current item
		if ( apply_filters( \'dropdown_menus_select_current\', true ) )
			$selected = in_array( \'current-menu-item\', $classes ) ? \' selected="selected"\' : \'\';

		$output .= $indent . \'<option\' . $class_names .\' value="\'. $item->url .\'"\'. $selected .\'>\';

		// push sub-menu items in as we can\'t nest optgroups
		$indent_string = str_repeat( apply_filters( \'dropdown_menus_indent_string\', $args->indent_string, $item, $depth, $args ), ( $depth ) ? $depth : 0 );
		$indent_string .= !empty( $indent_string ) ? apply_filters( \'dropdown_menus_indent_after\', $args->indent_after, $item, $depth, $args ) : \'\';

		$item_output = $args->before . $indent_string;
		$item_output .= $args->link_before . apply_filters( \'the_title\', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $args->after;

		$output .= apply_filters( \'walker_nav_menu_dropdown_start_el\', $item_output, $item, $depth, $args );
	}

	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= apply_filters( \'walker_nav_menu_dropdown_end_el\', "</option>\n", $item, $depth);
	}
}

add_filter( \'dropdown_menus_select_current\', create_function( \'$bool\', \'return false;\' ) );

/**
 * END WordPress dropdown Plugin code.
 */
';
	}
	else
	{
		if( dynamik_get_design( 'nav1_location' ) == "Above Header" ){ $nav_1_action = "remove_action( 'genesis_after_header', 'genesis_do_nav' );\nadd_action( 'genesis_before_header', 'genesis_do_nav' );\n"; }
		elseif( dynamik_get_design( 'nav1_location' ) == "Below Header" ){ $nav_1_action = ""; }
		
		if( dynamik_get_design( 'nav2_location' ) == "Above Header" ){ $nav_2_action = "remove_action( 'genesis_after_header', 'genesis_do_subnav' );\nadd_action( 'genesis_before_header', 'genesis_do_subnav' );\n"; }
		elseif( dynamik_get_design( 'nav2_location' ) == "Below Header" ){ $nav_2_action = ""; }
		
		if( dynamik_get_design( 'nav1_location' ) == "Below Header" && dynamik_get_design( 'nav2_location' ) == "Below Header" ){ $nav_placement_comment = ""; }
		
		$mobile_nav_functions = '';
		$dropdown_menu_register = '';
		$nav_dropdown_functions = '';
	}

	$google_fonts = dynamik_build_google_fonts_string();

	if( !empty( $google_fonts ) )
	{
		$google_fonts_enqueue = 'add_action( \'wp_enqueue_scripts\', \'child_enqueue_google_fonts\' );
/**
 * Enqueue Google fonts.
 *
 * @since 1.0
 */
function child_enqueue_google_fonts() {
	wp_enqueue_style( \'child_enqueued_google_fonts\', \'//fonts.googleapis.com/css?family=' . $google_fonts . '\', array(), CHILD_THEME_VERSION );
}';
	}
	else
	{
		$google_fonts_enqueue = '';
	}

	if( $include_design == 'yes' && dynamik_get_design( 'font_awesome_css' ) )
	{
		$font_awesome_css = '
		
add_action( \'wp_enqueue_scripts\', \'child_font_awesome_styles\' );
/**
 * Add Font Awesome styles.
 *
 * @since 1.0
 */
function child_font_awesome_styles() {
	wp_enqueue_style( \'font-awesome\', \'//maxcdn.bootstrapcdn.com/font-awesome/' . DYN_FONT_AWESOME_VERSION . '/css/font-awesome.min.css\', array(), \'' . DYN_FONT_AWESOME_VERSION . '\' );
}';
	}
	else
	{
		$font_awesome_css = '';
	}
	
	if( dynamik_get_design( 'fixed_header' ) != 'disabled' )
	{
		$fixed_header_fade_effect = dynamik_get_design( 'fixed_header' ) == 'fadein' ? 1 : 0;
		$fixed_header_min_width = dynamik_get_responsive( 'header_media_query_default' ) == 'delayed' ? dynamik_get_responsive( 'dynamik_media_query_large_min_width' ) : dynamik_get_responsive( 'dynamik_media_query_large_max_width' );
		$fixed_header_functions = '
add_action( \'wp_head\', \'child_fixed_header_php_vars\' );
/**
 * Build the javascript variables that are used with a Fixed Header design.
 *
 * @since 1.0
 */
function child_fixed_header_php_vars() { ?>
<script type="text/javascript">
<?php
	echo \'var dynamik_fixed_header_fade = ' . $fixed_header_fade_effect . ';\' . "\n";
	echo \'var dynamik_fixed_header_min_width = \' . apply_filters( \'dynamik_fixed_header_min_width\', ' . $fixed_header_min_width . ' ) . \';\' . "\n";
?>
</script>
<?php
}
';

		$fixed_header_js_enqueue = "
add_action( 'wp_enqueue_scripts', 'child_enqueue_fixed_header_scripts' );
/**
 * Enqueue Fixed Header Design javascript code.
 *
 * @since 1.0
 */
function child_enqueue_fixed_header_scripts() {	
	wp_enqueue_script( 'fixed-header', CHILD_URL . '/js/fixed-header.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
}";
	}
	else
	{
		$fixed_header_functions = '';
		$fixed_header_js_enqueue = '';
	}

	if( dynamik_get_settings( 'responsive_enabled' ) )
	{
		$responsive_viewport_meta = '<meta name="viewport" content="' . dynamik_get_responsive( 'viewport_meta_content' ) . '" id="dynamik-viewport"/>';
	
		$responsive_viewport = "
add_action( 'genesis_meta', 'child_responsive_viewport' );
/**
 * Add viewport meta tag to the genesis_meta hook
 * to force 'real' scale of site when viewed in mobile devices.
 *
 * @since 1.0
 */
function child_responsive_viewport() {
echo '$responsive_viewport_meta' . $new_line;
}";

		$responsive_js_enqueue = "
add_action( 'wp_enqueue_scripts', 'child_enqueue_responsive_scripts' );
/**
 * Enqueue Responsive Design javascript code.
 *
 * @since 1.0
 */
function child_enqueue_responsive_scripts() {	
	wp_enqueue_script( 'responsive', CHILD_URL . '/js/responsive.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
}";
	}
	else
	{
		$responsive_viewport_meta = '';
		$responsive_viewport = '';
		$responsive_js_enqueue = '';
	}

	if( $include_js == 'yes' && file_exists( dynamik_get_custom_js_path() ) && 0 != filesize( dynamik_get_custom_js_path() ) )
	{
		$custom_js = get_option( 'dynamik_gen_custom_js' );
		if( !empty( $custom_js['custom_js_in_head'] ) )
			$in_footer = 'false';
		else
			$in_footer = 'true';

		$custom_js_enqueue = "
add_action( 'get_header', 'child_enqueue_custom_scripts' );
/**
 * Enqueue Custom javascript code.
 *
 * @since 1.0
 */
function child_enqueue_custom_scripts() {	
	wp_enqueue_script( 'custom-scripts', CHILD_URL . '/js/custom-scripts.js', array( 'jquery' ), CHILD_THEME_VERSION, " . $in_footer . " );
}";
	}
	else
	{
		$custom_js_enqueue = '';
	}

	$custom_image_size_one = '';
	$custom_image_size_two = '';
	$custom_image_size_three = '';
	$custom_image_size_four = '';
	$custom_image_size_five = '';

	if( $include_settings == 'yes' )
	{
		if( dynamik_get_settings( 'custom_image_size_one_mode' ) != '' )
		{
			if( dynamik_get_settings( 'custom_image_size_one_mode' ) != '' )
			{
				$custom_image_size_one_crop = dynamik_get_settings( 'custom_image_size_one_mode' ) == 'crop' ? 'true' : 'false';
				$custom_image_size_one = "

/**
 * Add custom thumbnail sizes.
 */
add_image_size( 'custom-thumb-1', " . dynamik_get_settings( 'custom_image_size_one_width' ) . ", " . dynamik_get_settings( 'custom_image_size_one_height' ) . ", " . $custom_image_size_one_crop . " );";
			}
			
			if( dynamik_get_settings( 'custom_image_size_two_mode' ) != '' )
			{
				$custom_image_size_two_crop = dynamik_get_settings( 'custom_image_size_two_mode' ) == 'crop' ? 'true' : 'false';
				$custom_image_size_two = "
add_image_size( 'custom-thumb-2', " . dynamik_get_settings( 'custom_image_size_two_width' ) . ", " . dynamik_get_settings( 'custom_image_size_two_height' ) . ", " . $custom_image_size_two_crop . " );";
			}
			
			if( dynamik_get_settings( 'custom_image_size_three_mode' ) != '' )
			{
				$custom_image_size_three_crop = dynamik_get_settings( 'custom_image_size_three_mode' ) == 'crop' ? 'true' : 'false';
				$custom_image_size_three = "
add_image_size( 'custom-thumb-3', " . dynamik_get_settings( 'custom_image_size_three_width' ) . ", " . dynamik_get_settings( 'custom_image_size_three_height' ) . ", " . $custom_image_size_three_crop . " );";
			}
			
			if( dynamik_get_settings( 'custom_image_size_four_mode' ) != '' )
			{
				$custom_image_size_four_crop = dynamik_get_settings( 'custom_image_size_four_mode' ) == 'crop' ? 'true' : 'false';
				$custom_image_size_four = "
add_image_size( 'custom-thumb-4', " . dynamik_get_settings( 'custom_image_size_four_width' ) . ", " . dynamik_get_settings( 'custom_image_size_four_height' ) . ", " . $custom_image_size_four_crop . " );";
			}
			
			if( dynamik_get_settings( 'custom_image_size_five_mode' ) != '' )
			{
				$custom_image_size_five_crop = dynamik_get_settings( 'custom_image_size_five_mode' ) == 'crop' ? 'true' : 'false';
				$custom_image_size_five = "
add_image_size( 'custom-thumb-5', " . dynamik_get_settings( 'custom_image_size_five_width' ) . ", " . dynamik_get_settings( 'custom_image_size_five_height' ) . ", " . $custom_image_size_five_crop . " );";
			}
		}
	
		$post_title_hook = dynamik_get_settings( 'html_five_active' ) ? 'genesis_entry_header' : 'genesis_post_title';

		if( dynamik_get_settings( 'remove_all_page_titles' ) )
		{
			$remove_page_titles = "
			
add_action( 'get_header', 'child_remove_page_titles' );
/**
 * Remove all page titles.
 *
 * @since 1.0
 */
function child_remove_page_titles() {
    if ( is_page() && ! is_page_template( 'page_blog.php' ) )
        remove_action( '" . $post_title_hook . "', 'genesis_do_post_title' );
}";
		}
		elseif( dynamik_get_settings( 'remove_page_titles_ids' ) != '' )
		{
			$remove_page_titles = "
			
add_action( 'get_header', 'child_remove_page_titles' );
/**
 * Remove specific page titles.
 *
 * @since 1.0
 */
function child_remove_page_titles() {
	global " . $dollar_sign  . "post;
	" . $dollar_sign  . "page_ids = explode( ',', '" . dynamik_get_settings( 'remove_page_titles_ids' ) . "' );
	if ( is_page() && ! is_page_template( 'page_blog.php' ) ) {
		foreach ( " . $dollar_sign  . "page_ids as " . $dollar_sign  . "page_id ) {
			if ( " . $dollar_sign  . "post->ID == " . $dollar_sign  . "page_id )
				remove_action( '" . $post_title_hook . "', 'genesis_do_post_title' );
		}
	}
}";
		}
		else
		{
			$remove_page_titles = '';
		}
		
		if( dynamik_get_settings( 'include_inpost_cpt_all' ) )
		{
			$include_inpost_cpt_names = "

add_action( 'init', 'child_add_post_type_support', 9999 );
/**
 * Add Genesis In-Post options into ALL Custom Post Types.
 *
 * @since 1.0
 */
function child_add_post_type_support() {
	foreach( get_post_types( array( 'public' => true ) ) as " . $dollar_sign  . "post_type ) {
		add_post_type_support( " . $dollar_sign  . "post_type, array( 'genesis-seo', 'genesis-scripts', 'genesis-layouts' ) );
	}
}";
		}
		elseif( dynamik_get_settings( 'include_inpost_cpt_names' ) != '' )
		{
			$include_inpost_cpt_names = "

add_action( 'init', 'child_add_post_type_support', 9999 );
/**
 * Add Genesis In-Post options into specified Custom Post Types.
 *
 * @since 1.0
 */
function child_add_post_type_support() {
	" . $dollar_sign  . "post_types = explode( ',', '" . dynamik_get_settings( 'include_inpost_cpt_names' ) . "' );
	
	foreach ( " . $dollar_sign  . "post_types as " . $dollar_sign  . "post_type ) {
		add_post_type_support( " . $dollar_sign  . "post_type, array( 'genesis-seo', 'genesis-scripts', 'genesis-layouts' ) );
	}
}";
		}
		else
		{
			$include_inpost_cpt_names = '';
		}

		if( dynamik_get_settings( 'post_formats_active' ) )
		{
			$post_formats = "

/**
 * Enable Custom Post Format functionality.
 */
add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
add_theme_support( 'genesis-post-format-images' );";
		}
		else
		{
			$post_formats = '';
		}

		if( dynamik_get_settings( 'html_five_active' ) )
		{
			$html_five = "

/**
 * Add support for Genesis HTML5 Markup.
 */
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );";
		}
		else
		{
			$html_five = '';
		}

		if( dynamik_get_settings( 'html_five_active' ) && dynamik_get_settings( 'fancy_dropdowns_active' ) )
		{
			$fancy_dropdowns = "

/**
 * Add support for Genesis 'Fancy Dropdowns'.
 */
add_filter( 'genesis_superfish_enabled', '__return_true' );";
		}
		else
		{
			$fancy_dropdowns = '';
		}
	}

	$author_box_avatar_size = dynamik_get_design( 'author_box_avatar_size' ) * 2;
	$comment_avatar_size = dynamik_get_design( 'comment_avatar_size' ) * 2;

	$avatar_size_filters = "

add_filter( 'genesis_author_box_gravatar_size', 'child_author_box_gravatar_size' );
/**
 * Modify the size of the Gravatar in the author box.
 *
 * @since 1.0
 */
function child_author_box_gravatar_size( " . $dollar_sign  . "size )
{
	return " . $author_box_avatar_size . ";
}

add_filter( 'genesis_comment_list_args', 'child_comments_gravatar_size' );
/**
 * Modify the size of the Gravatar in comments.
 *
 * @since 1.0
 */
function child_comments_gravatar_size( " . $dollar_sign  . "args )
{
	" . $dollar_sign  . "args['avatar_size'] = " . $comment_avatar_size . ";
	return " . $dollar_sign  . "args;
}";

	$content_filler = "

add_action( 'genesis_loop', 'child_content_filler' );
add_action( 'dynamik_hook_after_ez_home', 'child_content_filler' );
/**
 * Fill in the content/ez_home with 3000px by 1px transparent image to
 * ensure these areas are filled out regardless of their actual content.
 *
 * @since 1.0
 */
function child_content_filler()
{
	?><img src=\"<?php echo CHILD_URL . '/images/content-filler.png'; ?>\" class=\"dynamik-content-filler-img\" alt=\"\"><?php
}";

	$conditional_functions = "

/**
 * This is altered version of the genesis_get_custom_field() function
 * which includes the additional ability to work with array() values.
 *
 * @since 1.0
 */
function dynamik_get_custom_field( " . $dollar_sign  . "field, " . $dollar_sign  . "single = true, " . $dollar_sign  . "explode = false )
{
	if( null === get_the_ID() )
		return '';

	" . $dollar_sign  . "custom_field = get_post_meta( get_the_ID(), " . $dollar_sign  . "field, " . $dollar_sign  . "single );

	if( !" . $dollar_sign  . "custom_field )
		return '';

	if( !" . $dollar_sign  . "single )
	{
		" . $dollar_sign  . "custom_field_string = implode( ',', " . $dollar_sign  . "custom_field );
		if( " . $dollar_sign  . "explode )
		{
			" . $dollar_sign  . "custom_field_array_pre = explode( ',', " . $dollar_sign  . "custom_field_string );
			foreach( " . $dollar_sign  . "custom_field_array_pre as " . $dollar_sign  . "key => " . $dollar_sign  . "value )
			{
				" . $dollar_sign  . "custom_field_array[" . $dollar_sign  . "value] = " . $dollar_sign  . "value;
			}
			return " . $dollar_sign  . "custom_field_array;
		}
		return " . $dollar_sign  . "custom_field_string;
	}

	return is_array( " . $dollar_sign  . "custom_field ) ? stripslashes_deep( " . $dollar_sign  . "custom_field ) : stripslashes( wp_kses_decode_entities( " . $dollar_sign  . "custom_field ) );
}

/**
 * Create a Dynamik Label conditional tag which
 * allows content to be conditionally placed on pages and posts
 * that have specific Dynamik Labels assigned to them.
 *
 * @since 1.0
 */
function dynamik_has_label( " . $dollar_sign  . "label = 'label' )
{
	" . $dollar_sign  . "labels_meta_array = dynamik_get_custom_field( '_dyn_labels', false, true ) != '' ? dynamik_get_custom_field( '_dyn_labels', false, true ) : array();

	if( is_singular() )
	{
		if( in_array( " . $dollar_sign  . "label, " . $dollar_sign  . "labels_meta_array ) ) return true;
	}

	return false;
}

/**
 * Create a Genesis Simple Sidebars conditional tag which
 * allows content to be conditionally placed on pages and posts
 * that have specific simple sidebars assigned to them.
 *
 * @since 1.0
 */
function dynamik_is_ss( " . $dollar_sign  . "sidebar_id = 'sb-id' )
{
	if( !defined( 'SS_SETTINGS_FIELD' ) )
		return false;

	static " . $dollar_sign  . "taxonomies = null;

	if( is_singular() )
	{
		if( " . $dollar_sign  . "sidebar_id == genesis_get_custom_field( '_ss_sidebar' ) ) return true;
	}

	if( is_category() )
	{
		" . $dollar_sign  . "term = get_term( get_query_var( 'cat' ), 'category' );
		if( isset( " . $dollar_sign  . "term->meta['_ss_sidebar'] ) && " . $dollar_sign  . "sidebar_id == " . $dollar_sign  . "term->meta['_ss_sidebar'] ) return true;
	}

	if( is_tag() )
	{
		" . $dollar_sign  . "term = get_term( get_query_var( 'tag_id' ), 'post_tag' );
		if( isset( " . $dollar_sign  . "term->meta['_ss_sidebar'] ) && " . $dollar_sign  . "sidebar_id == " . $dollar_sign  . "term->meta['_ss_sidebar'] ) return true;
	}

	if( is_tax() )
	{
		if ( null === " . $dollar_sign  . "taxonomies )
			" . $dollar_sign  . "taxonomies = ss_get_taxonomies();

		foreach ( " . $dollar_sign  . "taxonomies as " . $dollar_sign  . "tax )
		{
			if ( 'post_tag' == " . $dollar_sign  . "tax || 'category' == " . $dollar_sign  . "tax )
				continue;

			if ( is_tax( " . $dollar_sign  . "tax ) )
			{
				" . $dollar_sign  . "obj = get_queried_object();
				" . $dollar_sign  . "term = get_term( " . $dollar_sign  . "obj->term_id, " . $dollar_sign  . "tax );
				if( isset( " . $dollar_sign  . "term->meta['_ss_sidebar'] ) && " . $dollar_sign  . "sidebar_id == " . $dollar_sign  . "term->meta['_ss_sidebar'] ) return true;
				break;
			}
		}
	}

	return false;
}
";
	
	$do_shortcode_text_widget = "
/**
 * Enable Shortcodes in Text Widgets.
 */
add_filter( 'widget_text', 'do_shortcode' );";

		if( $include_labels == 'yes' && get_option( 'dynamik_gen_custom_labels' ) != array() )
		{
			if( dynamik_get_settings( 'include_inpost_cpt_all' ) )
			{
				foreach( get_post_types( array( 'public' => true ) ) as $post_type )
				{
					$post_types[] = $post_type;
				}
			}
			else
			{
				$post_types = dynamik_get_settings( 'include_inpost_cpt_names' ) != '' ? explode( ',', 'page,post,' . dynamik_get_settings( 'include_inpost_cpt_names' ) ) : array( 'page','post' );
			}
			$post_type_string = implode( ',', $post_types );

			$labels = get_option( 'dynamik_gen_custom_labels' );
			asort( $labels );
			$labels_array = '';
			foreach( $labels as $key => $value )
			{
				$labels_array .= "'" . $value['label_id'] . "' => '" . $value['label_name'] . "',";
			}
			$custom_labels = "

if( is_admin() )
{
	add_filter( 'dynamik_cmb_meta_boxes', 'child_labels_metabox' );
	/**
	 * Define the metabox and field configurations.
	 *
	 * @since 1.0
	 * @return array
	 */
	function child_labels_metabox( array " . $dollar_sign  . "meta_boxes )
	{
		// Start with an underscore to hide fields from custom fields list
		" . $dollar_sign  . "prefix = '_dyn_';
		" . $dollar_sign  . "post_type_array = explode( ',', '" . $post_type_string . "' );

		" . $dollar_sign  . "meta_boxes[] = array(
			'id'         => 'dynamik_labels',
			'title'      => 'Dynamik Labels',
			'pages'      => " . $dollar_sign  . "post_type_array, // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name'    => 'Select Labels',
					'desc'    => 'Select labels appropriate to this page/post.',
					'id'      => " . $dollar_sign  . "prefix . 'labels',
					'type'    => 'multicheck',
					'options' => array(
						" . $labels_array . "
					),
				),
			),
		);

		return " . $dollar_sign  . "meta_boxes;
	}

	add_action( 'init', 'child_initialize_cmb_meta_boxes', 9999 );
	/**
	 * Initialize the metabox class.
	 * @since 1.0
	 */
	function child_initialize_cmb_meta_boxes()
	{
		if( !class_exists( 'dynamik_cmb_Meta_Box' ) )
			require_once CHILD_DIR . '/metaboxes/init.php';
	}
}";

			$custom_labels_classes = "

	if( is_singular() && dynamik_get_custom_field( '_dyn_labels', false, true ) != '' )
	{
		foreach ( dynamik_get_custom_field( '_dyn_labels', false, true ) as " . $dollar_sign  . "key => " . $dollar_sign  . "value )
		{
			" . $dollar_sign  . "classes[] = 'label-' . " . $dollar_sign  . "key;
		}
	}

	if( defined( 'DYNAMIK_LABEL_WIDTH' ) )
		" . $dollar_sign  . "classes[] = DYNAMIK_LABEL_WIDTH;";
		}
		else
		{
			$custom_labels = '';
			$custom_labels_classes = '';
		}

	/**
	 * Build the EZ Structures file if it exists.
	 */
	if( file_exists( dynamik_get_ez_structure_path() ) &&
		( dynamik_get_design_alt( 'dynamik_homepage_type' ) == 'static_home' ||
		dynamik_get_design_alt( 'ez_home_slider_display' ) ||
		dynamik_get_design_alt( 'ez_feature_top_select' ) != 'disabled' ||
		dynamik_get_design_alt( 'ez_fat_footer_select' ) != 'disabled' ) )
	{
		$ez_structures = substr( file_get_contents( dynamik_get_ez_structure_path() ), 5 ) . "\n";
	}
	else
	{
		$ez_structures = '';
	}

	/**
	 * EZ Static Homepage.
	 */
	if( $ez_structures != '' &&
		dynamik_get_design( 'dynamik_homepage_type' ) == 'static_home' )
	{
		$ez_home_structure_classes = '$classes[] = "ez-home";';
	
		$ez_home_code = "
/**
 * Hook the EZ Home Structure function into the 'dynamik_hook_home' Hook.
 */
add_action( 'dynamik_hook_home', 'ez_home' );\n";
	}
	else
	{
		$ez_home_structure_classes = "";
		$ez_home_code = "";
	}
	
	/**
	 * EZ Home Sidebar.
	 */
	if( $ez_structures != '' &&
		dynamik_get_design( 'dynamik_homepage_type' ) == 'static_home' &&
		dynamik_get_design( 'ez_static_home_sb_display' ) )
	{
		$ez_home_sidebar_active_classes = '$classes[] = "ez-home-sidebar";';
		
		if( dynamik_get_design( 'ez_static_home_sb_location' ) == 'left' )
		{
			$ez_home_sidebar_left_classes = '$classes[] = "home-sidebar-left";';
		}
		else
		{
			$ez_home_sidebar_left_classes = "";
		}

		$ez_home_sidebar_code = "
/**
 * Hook the Homepage Sidebar Structure function into the 'dynamik_hook_home' Hook.
 */
add_action( 'dynamik_hook_home', 'ez_home_sidebar' );\n";
	}
	else
	{
		$ez_home_sidebar_active_classes = "";
		$ez_home_sidebar_left_classes = "";
		$ez_home_sidebar_code = "";
	}
	
	if( $ez_structures != '' &&
		dynamik_get_design( 'ez_home_slider_display' ) )
	{
		$ez_home_slider_active_classes = '$classes[] = "ez-home-slider";';

		/**
		 * Determine where to hook in the Home Image Slider based on
		 * whether or not the Static Homepage is active.
		 */
		if( dynamik_get_design( 'dynamik_homepage_type' ) == 'default_home' )
		{
			/**
			 * Determine where to hook in the Home Image Slider based on
			 * Home Slider Layout option setting.
			 */
			if( dynamik_get_design( 'ez_home_slider_location' ) == 'outside' )
			{
				$ez_home_slider_inside_classes = '';

				$ez_home_slider_code = "
/**
 * Hook the Home Slider structure function into the 'genesis_before_content_sidebar_wrap' Hook.
 */
add_action( 'genesis_before_content_sidebar_wrap', 'ez_home_slider' );\n";
			}
			else
			{
				$ez_home_slider_inside_classes = '$classes[] = "slider-inside";';

				$ez_home_slider_code = "
/**
 * Hook the Home Slider structure function into the 'genesis_before_loop' Hook.
 */
add_action( 'genesis_before_loop', 'ez_home_slider' );\n";
			}
		}
		else
		{
			/**
			 * Determine where to hook in the Home Image Slider based on
			 * Home Slider Layout option setting.
			 */
			if( dynamik_get_design( 'ez_home_slider_location' ) == 'outside' )
			{
				$ez_home_slider_inside_classes = '';

				$ez_home_slider_code = "
/**
 * Hook the Home Slider structure function into the 'dynamik_hook_home' Hook.
 */
add_action( 'dynamik_hook_home', 'ez_home_slider', 6 );\n";
			}
			else
			{
				$ez_home_slider_inside_classes = '$classes[] = "slider-inside";';

				$ez_home_slider_code = "
/**
 * Hook the Home Slider structure function into the 'dynamik_hook_before_ez_home' Hook.
 */
add_action( 'dynamik_hook_before_ez_home', 'ez_home_slider' );\n";
			}
		}
	}
	else
	{
		$ez_home_slider_active_classes = '';
		$ez_home_slider_inside_classes = '';
		$ez_home_slider_code = "";
	}

	/**
	 * EZ Feature Top.
	 */
	if( !dynamik_get_design( 'ez_feature_top_display_front_page' ) )
	{
		$ez_feature_top_front_page = 'if ( is_front_page() ) { return; }';
	}
	else
	{
		$ez_feature_top_front_page = '';
	}
	if( !dynamik_get_design( 'ez_feature_top_display_posts' ) )
	{
		$ez_feature_top_posts = 'if ( is_single() ) { return; }';
	}
	else
	{
		$ez_feature_top_posts = '';
	}
	if( !dynamik_get_design( 'ez_feature_top_display_pages' ) )
	{
		$ez_feature_top_pages = "if ( ( is_page() || is_404() ) && ! is_front_page() && ! is_page_template( 'page_blog.php' ) ) { return; }";
	}
	else
	{
		$ez_feature_top_pages = '';
	}
	if( !dynamik_get_design( 'ez_feature_top_display_archives' ) )
	{
		$ez_feature_top_archives = 'if ( is_archive() || is_search() ) { return; }';
	}
	else
	{
		$ez_feature_top_archives = '';
	}
	if( !dynamik_get_design( 'ez_feature_top_display_blog' ) )
	{
		$ez_feature_top_blog = "if ( ( ! is_front_page() && is_home() ) || is_page_template( 'page_blog.php' ) ) { return; }";
	}
	else
	{
		$ez_feature_top_blog = '';
	}
	
	if( dynamik_get_design( 'ez_feature_top_position' ) == 'outside_inner' )
	{
		$ez_feature_top_add_action = "add_action( 'genesis_after_header', 'ez_feature_top' );";
	}
	elseif( dynamik_get_design( 'dynamik_homepage_type' ) != 'static_home' && dynamik_get_design( 'ez_feature_top_position' ) == 'inside_inner' )
	{
		$ez_feature_top_add_action = "add_action( 'genesis_before_content_sidebar_wrap', 'ez_feature_top', 5 );";
	}
	else
	{
		$ez_feature_top_add_action = "is_front_page() ? add_action( 'dynamik_hook_home', 'ez_feature_top', 5 ) : add_action( 'genesis_before_content_sidebar_wrap', 'ez_feature_top', 5 );";
	}
	
	if( $ez_structures != '' &&
		dynamik_get_design( 'ez_feature_top_select' ) != 'disabled' )
	{
		$ez_feature_top_classes = dynamik_get_design( 'ez_feature_top_position' ) == 'outside_inner' ? '$classes[] = "feature-top-outside";' : '';

$ez_feature_top_code = "
/**
 * Hook the Feature Top Structure function into the 'wp_head' Hook.
 */
add_action( 'wp_head', 'child_feature_top' );

/**
 * Determine where NOT to display the Feature Top section before hooking it in.
 *
 * @since 1.0
 */
function child_feature_top() {
	/**
	 * Add conditional tags to control where the Feature Top Widget Area displays.
	 */
	if ( is_page_template( 'landing.php' ) ) { return; }
	" . $ez_feature_top_front_page . " " . $ez_feature_top_posts . " " . $ez_feature_top_pages . " " . $ez_feature_top_archives . " " . $ez_feature_top_blog . "
	
	/**
	 * Hook the Feature Top Structure function into the appropriate Genesis Hook.
	 */
	" . $ez_feature_top_add_action . "
}
";
	}
	else
	{
		$ez_feature_top_classes = "";
		$ez_feature_top_code = "";
	}
	
	/**
	 * EZ Fat Footer.
	 */
	if( !dynamik_get_design( 'ez_fat_footer_display_front_page' ) )
	{
		$ez_fat_footer_front_page = 'if ( is_front_page() ) { return; }';
	}
	else
	{
		$ez_fat_footer_front_page = '';
	}
	if( !dynamik_get_design( 'ez_fat_footer_display_posts' ) )
	{
		$ez_fat_footer_posts = 'if ( is_single() ) { return; }';
	}
	else
	{
		$ez_fat_footer_posts = '';
	}
	if( !dynamik_get_design( 'ez_fat_footer_display_pages' ) )
	{
		$ez_fat_footer_pages = "if ( ( is_page() || is_404() ) && ! is_front_page() && ! is_page_template( 'page_blog.php' ) ) { return; }";
	}
	else
	{
		$ez_fat_footer_pages = '';
	}
	if( !dynamik_get_design( 'ez_fat_footer_display_archives' ) )
	{
		$ez_fat_footer_archives = 'if ( is_archive() || is_search() ) { return; }';
	}
	else
	{
		$ez_fat_footer_archives = '';
	}
	if( !dynamik_get_design( 'ez_fat_footer_display_blog' ) )
	{
		$ez_fat_footer_blog = "if ( ( ! is_front_page() && is_home() ) || is_page_template( 'page_blog.php' ) ) { return; }";
	}
	else
	{
		$ez_fat_footer_blog = '';
	}

	if( dynamik_get_design( 'ez_fat_footer_position' ) == 'outside_inner' )
	{
		$ez_fat_footer_add_action = "add_action( 'genesis_before_footer', 'ez_fat_footer' );";
	}
	elseif( dynamik_get_design( 'dynamik_homepage_type' ) != 'static_home' && dynamik_get_design( 'ez_fat_footer_position' ) == 'inside_inner' )
	{
		$ez_fat_footer_add_action = "add_action( 'genesis_after_content_sidebar_wrap', 'ez_fat_footer' );";
	}
	else
	{
		$ez_fat_footer_add_action = "is_front_page() ? add_action( 'dynamik_hook_home', 'ez_fat_footer' ) : add_action( 'genesis_after_content_sidebar_wrap', 'ez_fat_footer' );";
	}
	
	if( $ez_structures != '' &&
		dynamik_get_design( 'ez_fat_footer_select' ) != 'disabled' )
	{
		$ez_fat_footer_classes = dynamik_get_design( 'ez_fat_footer_position' ) == 'inside_inner' ? '$classes[] = \'fat-footer-inside\';' : '';

$ez_fat_footer_code = "
/**
 * Hook the Fat Footer Structure function into the 'wp_head' Hook.
 */
add_action( 'wp_head', 'child_fat_footer' );

/**
 * Determine where NOT to display the Fat Footer section before hooking it in.
 *
 * @since 1.0
 */
function child_fat_footer() {
	/**
	 * Add conditional tags to control where the Fat Footer Widget Area displays.
	 */
	if ( is_page_template( 'landing.php' ) ) { return; }
	" . $ez_fat_footer_front_page . " " . $ez_fat_footer_posts . " " . $ez_fat_footer_pages . " " . $ez_fat_footer_archives . " " . $ez_fat_footer_blog . "
	
	/**
	 * Hook the Fat Footer Structure function into the appropriate Genesis Hook.
	 */
	" . $ez_fat_footer_add_action . "
}
";
	}
	else
	{
		$ez_fat_footer_classes = '';
		$ez_fat_footer_code = '';
	}

	if( dynamik_get_design( 'wrap_structure' ) == 'fluid' )
	{
		$site_fluid_classes = '$classes[] = \'site-fluid\';';
	}
	else
	{
		$site_fluid_classes = '';
	}
	
	$skin_functions_content = "if ( file_exists( get_stylesheet_directory() . '/lib/functions.php' ) ) {
	require_once( get_stylesheet_directory() . '/lib/functions.php' );
}";
	$custom_functions_content = ( $include_functions == 'yes' ) ? substr( stripslashes( wp_kses_decode_entities( $custom_functions['custom_functions'] ) ), 5 ) : '';
	$custom_widget_areas = ( $include_widget_areas == 'yes' ) ? substr( file_get_contents( dynamik_get_custom_widget_areas_register_path() ), 5 ) . substr( file_get_contents( dynamik_get_custom_widget_areas_path() ), 5 ) : '';
	$custom_hook_boxes = ( $include_hook_boxes == 'yes' ) ? substr( file_get_contents( dynamik_get_custom_hook_boxes_path() ), 5 ) : '';

	$functions_php = "<?php
/**
 * Define and require all the necessary 'bits and pieces'
 * and build all necessary Static Homepage and Featured area functions.
 *
 * @package Dynamik
 */

/**
 * Call Genesis's core functions.
 */
require_once( get_template_directory() . '/lib/init.php' );

/**
 * Define child theme constants.
 */
define( 'CHILD_THEME_NAME', '" . $child_name . "' );
define( 'CHILD_THEME_URL', '" . $author_uri . "' );
define( 'CHILD_THEME_VERSION', '" . $version_number . "' );

add_filter( 'avatar_defaults', 'child_default_avatar' );
/**
 * Display a Custom Avatar if one exists with the correct name
 * and in the correct images directory.
 *
 * @since 1.0
 * @return custom avatar.
 */
function child_default_avatar( {$dollar_sign}avatar_defaults )
{
	{$dollar_sign}custom_avatar_image = '';
	if( file_exists( CHILD_DIR . '/images/custom-avatar.png' ) )
		{$dollar_sign}custom_avatar_image = CHILD_URL . '/images/custom-avatar.png';
	elseif( file_exists( CHILD_DIR . '/images/custom-avatar.jpg' ) )
		{$dollar_sign}custom_avatar_image = CHILD_URL . '/images/custom-avatar.jpg';
	elseif( file_exists( CHILD_DIR . '/images/custom-avatar.gif' ) )
		{$dollar_sign}custom_avatar_image = CHILD_URL . '/images/custom-avatar.gif';
	elseif( file_exists( CHILD_DIR . '/images/custom-avatar.jpg' ) )
		{$dollar_sign}custom_avatar_image = CHILD_URL . '/images/custom-avatar.jpg';

	{$dollar_sign}custom_avatar = apply_filters( 'child_custom_avatar_path', {$dollar_sign}custom_avatar_image );
	{$dollar_sign}avatar_defaults[{$dollar_sign}custom_avatar] = 'Custom Avatar';
	
	return {$dollar_sign}avatar_defaults;
}
{$nav_placement_comment}{$nav_1_action}{$nav_2_action}{$mobile_nav_functions}{$dropdown_menu_register}{$nav_dropdown_functions}{$fixed_header_functions}{$responsive_viewport}{$custom_image_size_one}{$custom_image_size_two}{$custom_image_size_three}{$custom_image_size_four}{$custom_image_size_five}{$remove_page_titles}{$include_inpost_cpt_names}{$post_formats}{$html_five}{$fancy_dropdowns}{$avatar_size_filters}{$content_filler}{$conditional_functions}{$do_shortcode_text_widget}{$custom_labels}
{$ez_home_code}{$ez_home_sidebar_code}{$ez_home_slider_code}{$ez_feature_top_code}{$ez_fat_footer_code}{$ez_structures}{$custom_widget_areas}{$custom_hook_boxes}
/**
 * Filter in specific body classes based on option values.
 */
add_filter( 'body_class', 'child_body_classes' );
/**
 * Determine which classes will be filtered into the body class.
 *
 * @since 1.0
 * @return array of all classes to be filtered into the body class.
 */
function child_body_classes( {$dollar_sign}classes ) {
	if ( is_front_page() ) {
		{$ez_home_structure_classes}
		{$ez_home_sidebar_active_classes}
		{$ez_home_sidebar_left_classes}
		{$ez_home_slider_active_classes}
		{$ez_home_slider_inside_classes}
	}
	
	{$ez_feature_top_classes}
	{$ez_fat_footer_classes}
	{$site_fluid_classes}
	{$custom_labels_classes}

	{$dollar_sign}classes[] = 'override';
	
	return {$dollar_sign}classes;
}

add_filter( 'post_class', 'child_post_classes' );
/**
 * Create an array of useful post classes.
 *
 * @since 1.0
 * @return an array of child post classes.
 */
function child_post_classes( {$dollar_sign}classes )
{
	{$dollar_sign}classes[] = 'override';

	return {$dollar_sign}classes;
}

{$google_fonts_enqueue}{$font_awesome_css}
{$fixed_header_js_enqueue}
{$responsive_js_enqueue}
{$custom_js_enqueue}
{$skin_functions_content}
{$custom_functions_content}";

	if( dynamik_get_design( 'fixed_header' ) != 'disabled' )
		$fixed_header_js = file_get_contents( CHILD_DIR . '/lib/js/fixed-header.js' );

	if( dynamik_get_settings( 'responsive_enabled' ) )
		$responsive_js = file_get_contents( CHILD_DIR . '/lib/js/responsive.js' );

	if( $include_js == 'yes' && file_exists( dynamik_get_custom_js_path() ) && 0 != filesize( dynamik_get_custom_js_path() ) )
		$custom_js = file_get_contents( dynamik_get_custom_js_path() );

	$front_page_php = "<?php
/**
 * Build the basic structural wrap for the EZ Static Homepage.
 *
 * @package Dynamik
 */
 
get_header();
?>
<div id=\"home-hook-wrap\" class=\"clearfix\">
	<?php do_action( 'dynamik_hook_home' ); ?>
</div><!-- end #home-hook-wrap -->
<?php
get_footer();
";

	$style_file = $tmp_child . '/style.css';
	$make_style = fopen( $style_file, 'x' );
	fwrite( $make_style, $style_css );
	fclose ( $make_style );
	
	$functions_file = $tmp_child . '/functions.php';
	$make_functions = fopen( $functions_file, 'x' );
	fwrite( $make_functions, $functions_php );
	fclose ( $make_functions );
	
	if( dynamik_get_design( 'fixed_header' ) != 'disabled' )
	{
		$fixed_header_js_file = $tmp_js_folder . '/fixed-header.js';
		$make_fixed_header_js = fopen( $fixed_header_js_file, 'x' );
		fwrite( $make_fixed_header_js, $fixed_header_js );
		fclose ( $make_fixed_header_js );
	}
	
	if( dynamik_get_settings( 'responsive_enabled' ) )
	{
		$responsive_js_file = $tmp_js_folder . '/responsive.js';
		$make_responsive_js = fopen( $responsive_js_file, 'x' );
		fwrite( $make_responsive_js, $responsive_js );
		fclose ( $make_responsive_js );
	}

	if( $include_js == 'yes' && file_exists( dynamik_get_custom_js_path() ) && 0 != filesize( dynamik_get_custom_js_path() ) )
	{
		$custom_js_file = $tmp_js_folder . '/custom-scripts.js';
		$make_custom_js = fopen( $custom_js_file, 'x' );
		fwrite( $make_custom_js, $custom_js );
		fclose ( $make_custom_js );
	}
	else
	{
		$custom_js_file = '';
	}
	
	if( dynamik_get_design( 'dynamik_homepage_type' ) == 'static_home' )
	{
		$home_file = $tmp_child . '/front-page.php';
		$make_home = fopen( $home_file, 'x' );
		fwrite( $make_home, $front_page_php );
		fclose ( $make_home );
	}
	else
	{
		$home_file = '';
	}
	
	$handle = opendir( $image_folder );
	while( false !== ( $file = readdir( $handle ) ) )
	{
		$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
		if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
		{
			if( $file != 'screenshot.png' )
			{
				copy( $image_folder . '/' . $file, $tmp_image_folder . '/' . $file );
			}
			else
			{
				$screenshot = $file;
				copy( $image_folder . '/' . $file, $tmp_child . '/' . $file );
			}
		}
	}
	closedir( $handle );
	
	$handle = opendir( $dynamik_image_folder );
	while( false !== ( $file = readdir( $handle ) ) )
	{
		$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
		if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
		{
			if( $file != 'screenshot.png' )
				copy( $dynamik_image_folder . '/' . $file, $tmp_image_folder . '/' . $file );
			elseif( $file == 'screenshot.png' && empty( $screenshot ) )
				copy( $dynamik_image_folder . '/' . $file, $tmp_child . '/' . $file );
		}
	}
	closedir( $handle );

	$handle = opendir( $skin_folder );
	while( false !== ( $file = readdir( $handle ) ) )
	{
		$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
		if( $ext == 'php' || $ext == 'js' )
		{
			copy( $skin_folder . '/' . $file, $tmp_lib_folder . '/' . $file );
		}
	}
	closedir( $handle );
	
	if( dynamik_get_settings( 'post_formats_active' ) )
	{
		$handle = opendir( $dynamik_post_formats_image_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
				copy( $dynamik_post_formats_image_folder . '/' . $file, $tmp_post_formats_image_folder . '/' . $file );
		}
		closedir( $handle );
	}

	if( $include_templates == 'yes' )
	{
		$handle = opendir( $dynamik_my_templates_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			if( $file !== '.' && $file !== '..' )
				copy( $dynamik_my_templates_folder . '/' . $file, $tmp_my_templates_folder . '/' . $file );
		}
		closedir( $handle );
	}

	if( $include_labels == 'yes' && get_option( 'dynamik_gen_custom_labels' ) != array() )
	{
		dynamik_recurse_copy( $dynamik_metaboxes_folder, $tmp_metaboxes_folder );
	}

	if( $include_default_page_templates == 'yes' )
	{
		$handle = opendir( CHILD_DIR );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'php' && $file != 'functions.php' && $file != 'front-page.php' )
			{
				$wp_templates_files = true;
				copy( CHILD_DIR . '/' . $file, $tmp_child . '/' . $file );
				$wp_template_files_array[] = $tmp_child . '/' . $file;
			}
		}
		closedir( $handle );
	}

	$protected_folders_check = false;
	if( dynamik_get_settings( 'protected_folders' ) != '' && $include_protected_folders == 'yes' )
	{
		if( dynamik_dir_check( dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders' ) )
			dynamik_protect_folders();
		else
			return;

		// Turn the "protected_folders" string into an array of "folders"
		$protected_folders = dynamik_actual_protected_folders();
		// Copy protected folders over to the exported child theme folder
		foreach( $protected_folders as $protected_folder )
		{
			$protected_folders_check = true;
			dynamik_recurse_copy( dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders/' . $protected_folder, $tmp_child . '/' . $protected_folder );
			$protected_folders_array[] = $tmp_child . '/' . $protected_folder;
		}
	}
	
	$export_files = array( $style_file, $functions_file, $fixed_header_js_file, $responsive_js_file, $custom_js_file, $home_file, $tmp_lib_folder, $tmp_image_folder );
	if( true == $protected_folders_check )
	{
		foreach( $protected_folders_array as $key => $value )
		{
			$export_files[] = $value;
		}
	}
	if( $include_templates == 'yes' && count( scandir( $tmp_my_templates_folder ) ) > 2 )
	{
		$export_files[] = $tmp_my_templates_folder;
	}
	if( $include_default_page_templates == 'yes' && true == $wp_templates_files )
	{
		foreach( $wp_template_files_array as $key => $value )
		{
			$export_files[] = $value;
		}
	}
	if( $include_labels == 'yes' && get_option( 'dynamik_gen_custom_labels' ) != array() )
	{
		$export_files[] = $tmp_metaboxes_folder;
	}
	if( !empty( $screenshot ) )
	{
		$export_files[] = $tmp_child . '/' . $screenshot;
	}
	else
	{
		$export_files[] = $tmp_child . '/screenshot.png';
	}
	$dynamik_pclzip = new PclZip( $tmp_child . '/' . $child_export_zip );
	$dynamik_zipped = $dynamik_pclzip->create( $export_files, PCLZIP_OPT_REMOVE_PATH, $tmp_child );
	if( $dynamik_zipped == 0 )
	{
		die("Error : ".$dynamik_pclzip->errorInfo(true) );
	}
	
	if( ob_get_level() )
	{
		ob_end_clean();
	}
	header("Cache-Control: public, must-revalidate");
	header("Pragma: hack");
	header("Content-Type: application/zip");
	header("Content-Disposition: attachment; filename=$child_export_zip");
	readfile( $tmp_child . '/' . $child_export_zip );
	dynamik_delete_dir( $tmp_child );
	dynamik_folders_close_permissions();
	exit();
}

/**
 * Export the Dynamik Design settings.
 *
 * @since 1.0
 */
function dynamik_design_export( $export_name = false, $settings_only = 'no' )
{
	$export_data = array();
	
	$export_data['dynamik_gen_design_options'] = get_option( 'dynamik_gen_design_options' );
	$export_data['dynamik_gen_responsive_options'] = get_option( 'dynamik_gen_responsive_options' );

	$dynamik_datestamp = dynamik_sanatize_string( gmdate( 'Y-m-d H:i:s', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) ), true );
	if( $export_name )
	{
		$dynamik_export_dat = dynamik_sanatize_string( $export_name, true ) . '.dat';
	}
	else
	{
		$dynamik_export_dat = 'dynamik_skin_' . $dynamik_datestamp . '.dat';
	}
	$cheerios = serialize( $export_data );
	
	if( $settings_only == 'yes' )
	{
		header( "Content-type: text/plain" );
		header( "Content-disposition: attachment; filename=$dynamik_export_dat" );
		header( "Content-Transfer-Encoding: binary" );
		header( "Pragma: no-cache" );
		header( "Expires: 0" );
		echo $cheerios; 
		exit();
	}
	else
	{
		dynamik_folders_open_permissions();
		require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
		if( $export_name )
		{
			$dynamik_export_zip = dynamik_sanatize_string( $export_name, true ) . '.zip';
		}
		else
		{
			$dynamik_export_zip = 'dynamik_skin_' . $dynamik_datestamp . '.zip';
		}
		$dynamik_gen_active_skin_path = dynamik_get_active_skin_folder_path();
		$tmp_path = dynamik_get_stylesheet_location( 'path' ) . 'tmp';
		$dat_filename = $tmp_path . '/' . $dynamik_export_dat;
		$skin_screenshot = '';
		if( file_exists( $dynamik_gen_active_skin_path . '/style.css' ) )
		{
			$skin_custom_styles = $tmp_path . '/style.css';
			copy( $dynamik_gen_active_skin_path . '/style.css', $skin_custom_styles );
		}
		else
		{
			$skin_custom_styles = '';
		}
		if( file_exists( $dynamik_gen_active_skin_path . '/functions.php' ) )
		{
			$skin_custom_functions = $tmp_path . '/functions.php';
			copy( $dynamik_gen_active_skin_path . '/functions.php', $skin_custom_functions );
		}
		else
		{
			$skin_custom_functions = '';
		}
		if( file_exists( $dynamik_gen_active_skin_path . '/scripts.js' ) )
		{
			$skin_custom_scripts = $tmp_path . '/scripts.js';
			copy( $dynamik_gen_active_skin_path . '/scripts.js', $skin_custom_scripts );
		}
		else
		{
			$skin_custom_scripts = '';
		}
		$tmp_image_folder = $tmp_path . '/images';
		$tmp_adthumbs_folder = $tmp_image_folder . '/adminthumbnails';
		$image_folder = dynamik_get_stylesheet_location( 'path' ) . 'images';
		$adthumbs_folder = $image_folder . '/adminthumbnails';
		$skin_screenshot_found = false;

		if( !is_dir( $tmp_path ) )
		{
			mkdir( $tmp_path, 0755, true );
		}
		if( !is_dir( $tmp_image_folder ) )
		{
			mkdir( $tmp_image_folder, 0755, true );
		}
		if( !is_dir( $tmp_adthumbs_folder ) )
		{
			mkdir( $tmp_adthumbs_folder, 0755, true );
		}
		
		$dat_file = fopen( $dat_filename, 'x' );
		fwrite( $dat_file, $cheerios );
		fclose ( $dat_file );
		
		$handle = opendir( $image_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
			{
				if( $file != 'skin-screenshot.png' )
				{
					copy( $image_folder . '/' . $file, $tmp_image_folder . '/' . $file );
				}
				else
				{
					$skin_screenshot_found = true;
					$skin_screenshot = $tmp_path . '/skin-screenshot.png';
					copy( $image_folder . '/' . $file, $skin_screenshot );
				}
			}
		}
		closedir( $handle );
		
		$handle = opendir( $adthumbs_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $file != 'skin-screenshot.png' && ( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' ) )
			{
				copy( $adthumbs_folder . '/' . $file, $tmp_adthumbs_folder . '/' . $file );
			}
		}
		closedir( $handle );

		$handle = opendir( $dynamik_gen_active_skin_path );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $file == 'skin-screenshot.png' && false == $skin_screenshot_found )
			{
				$skin_screenshot = $tmp_path . '/skin-screenshot.png';
				copy( $dynamik_gen_active_skin_path . '/skin-screenshot.png', $skin_screenshot );
			}
		}
		closedir( $handle );

		$export_files = array( $dat_filename, $skin_custom_styles, $skin_custom_functions, $skin_custom_scripts, $tmp_image_folder, $skin_screenshot );
		
		$dynamik_pclzip = new PclZip( $tmp_path . '/' . $dynamik_export_zip );
		$dynamik_zipped = $dynamik_pclzip->create( $export_files, PCLZIP_OPT_REMOVE_PATH, $tmp_path );
		if( $dynamik_zipped == 0 )
		{
			die( "Error : " . $dynamik_pclzip->errorInfo( true ) );
		}
		
		if( ob_get_level() )
		{
			ob_end_clean();
		}
		header( "Cache-Control: public, must-revalidate" );
		header( "Pragma: hack" );
		header( "Content-Type: application/zip" );
		header( "Content-Disposition: attachment; filename=$dynamik_export_zip" );
		readfile( $tmp_path . '/' . $dynamik_export_zip );
		dynamik_delete_temp_files( $tmp_path );
		dynamik_delete_temp_files( $tmp_image_folder );
		dynamik_delete_temp_files( $tmp_adthumbs_folder );
		dynamik_folders_close_permissions();
		exit();
	}
}

/**
 * Import the Dynamik Design settings.
 *
 * @since 1.0
 */
function dynamik_design_import( $import_file )
{
	$dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );
	$active_skin_info = dynamik_skin_style_info( $dynamik_gen_skin_options['active_skin'] );
	$pre_rem_import = false;
	$import_notice = 'import-complete';
	$skin_name = strtolower( substr( $import_file['name'], 0, -4 ) );

	dynamik_folders_open_permissions();
	dynamik_tmp_folder_cleanup();
	$tmp_path = dynamik_get_stylesheet_location( 'path' ) . 'tmp';
	$tmp_import_folder = $tmp_path . '/import';
	$tmp_image_folder = $tmp_import_folder . '/images';
	$tmp_adthumbs_folder = $tmp_image_folder . '/adminthumbnails';
	$image_folder = dynamik_get_stylesheet_location( 'path' ) . 'images';
	$adthumbs_folder = $image_folder . '/adminthumbnails';
	
	if( !is_dir( $tmp_path ) )
	{
		mkdir( $tmp_path, 0755, true );
	}
	if( !is_dir( $tmp_import_folder ) )
	{
		mkdir( $tmp_import_folder, 0755, true );
	}
	dynamik_folders_close_permissions();
	
	if( 'zip' == strtolower( substr( strrchr( $import_file['name'], '.' ), 1 ) ) )
	{
		dynamik_folders_open_permissions();
		require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );

		$import_tmp_name = $import_file['tmp_name'];
		$zip_file = new PclZip( $import_tmp_name );
		
		if( ( $unzip_result_list = $zip_file->extract( PCLZIP_OPT_PATH, $tmp_import_folder ) ) == 0 )
		{
			die("Error : " . $zip_file->errorInfo( true ) );
		}

		$skin_update = false;
		if( get_option( 'dynamik_gen_' . strtolower( substr( $import_file['name'], 0, -4 ) ) . '_skin' ) )
		{
			if( file_exists( $tmp_import_folder . '/style.css' ) )
			{
				$imported_skin_style_lines = file( $tmp_import_folder . '/style.css' );
				$imported_skin_author = substr( $imported_skin_style_lines[3], 9 );
				$imported_skin_version = substr( $imported_skin_style_lines[5], 10 );
				if( $imported_skin_author == $active_skin_info['author'] && $imported_skin_version > $active_skin_info['version'] )
				{
					$skin_update = true;
					$import_notice = 'skin-update-complete';
				}
			}
			
			if( false == $skin_update )
			{
				dynamik_delete_dir( $tmp_import_folder );
				wp_redirect( admin_url( 'admin.php?page=dynamik-design&activetab=dynamik-design-options-nav-skins&notice=skin-import-error' ) );
				exit();
			}
		}

		dynamik_recurse_copy( $tmp_import_folder, dynamik_get_skins_folder_path() . '/' . $skin_name );

		$handle = opendir( dynamik_get_skins_folder_path() . '/' . $skin_name );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'dat' )
			{
				unlink( dynamik_get_skins_folder_path() . '/' . $skin_name . '/' . $file );
			}
		}
		closedir( $handle );

		dynamik_import_skin( $skin_name );
		
		$handle = opendir( $tmp_import_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'dat' )
			{				
				$import_data = file_get_contents( $tmp_import_folder . '/' . $file );
				$dynamik_design_import = unserialize( $import_data );
				
				/* If the Dynamik Design Import file is from a Catalyst/Dynamik Export */
				if( isset( $dynamik_design_import['catalyst_dynamik_options']['body_bg_type'] ) )
				{
					$ez_select_find = array( 'wide_left', 'wide_right' );
					$ez_select_replace = array( 'wl', 'wr' );
					$ez_homepage_select = str_replace( $ez_select_find, $ez_select_replace, $dynamik_design_import['catalyst_dynamik_options']['ez_homepage_select'] );
					$ez_feature_top_select = str_replace( $ez_select_find, $ez_select_replace, $dynamik_design_import['catalyst_dynamik_options']['ez_feature_top_select'] );
					$ez_fat_footer_select = str_replace( $ez_select_find, $ez_select_replace, $dynamik_design_import['catalyst_dynamik_options']['ez_fat_footer_select'] );
					
					if( $dynamik_design_import['catalyst_dynamik_options']['ez_widget_footer_border_type'] == 'Top' )
					{
						$ez_widget_footer_border_type = 'Bottom';
					}
					elseif( $dynamik_design_import['catalyst_dynamik_options']['ez_widget_footer_border_type'] == 'Bottom' )
					{
						$ez_widget_footer_border_type = 'Top';
					}
					else
					{
						$ez_widget_footer_border_type = $dynamik_design_import['catalyst_dynamik_options']['ez_widget_footer_border_type'];
					}

					$unique_to_genesis = array(
						'inner_tb_padding' => $dynamik_design_import['catalyst_dynamik_options']['container_wrap_tb_padding'],
						'inner_lr_padding' => $dynamik_design_import['catalyst_dynamik_options']['container_wrap_lr_padding'],
						'header_title_area_width' => $dynamik_design_import['catalyst_dynamik_options']['header_left_width'],
						'header_widget_width' => $dynamik_design_import['catalyst_dynamik_options']['header_right_width'],
						'nav1_extras_font_size' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_font_size'],
						'nav1_extras_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_font_color'],
						'nav1_extras_font_css' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_font_css'],
						'nav1_extras_link_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_link_color'],
						'nav1_extras_link_hover_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_link_hover_color'],
						'nav1_extras_link_underline' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_link_underline'],
						'nav1_extras_px_em' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_px_em'],
						'nav3_font_size' => $dynamik_design_import['catalyst_dynamik_options']['nav1_font_size'],
						'nav3_px_em' => $dynamik_design_import['catalyst_dynamik_options']['nav1_px_em'],
						'nav3_font_css' => $dynamik_design_import['catalyst_dynamik_options']['nav1_font_css'],
						'nav3_link_underline' => $dynamik_design_import['catalyst_dynamik_options']['nav1_link_underline'],
						'nav3_page_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_font_color'],
						'nav3_page_hover_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_font_color'],
						'nav3_page_active_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_font_color'],
						'nav3_sub_page_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_font_color'],
						'nav3_sub_page_hover_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_hover_font_color'],
						'nav3_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_bg_type'],
						'nav3_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_bg_no_color'] ) ? 1 : 0,
						'nav3_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_bg_color'],
						'nav3_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_bg_image'],
						'nav3_page_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_bg_type'],
						'nav3_page_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_page_bg_no_color'] ) ? 1 : 0,
						'nav3_page_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_bg_color'],
						'nav3_page_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_bg_image'],
						'nav3_page_hover_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_bg_type'],
						'nav3_page_hover_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_bg_no_color'] ) ? 1 : 0,
						'nav3_page_hover_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_bg_color'],
						'nav3_page_hover_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_bg_image'],
						'nav3_page_active_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_bg_type'],
						'nav3_page_active_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_bg_no_color'] ) ? 1 : 0,
						'nav3_page_active_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_bg_color'],
						'nav3_page_active_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_bg_image'],
						'nav3_sub_page_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_bg_type'],
						'nav3_sub_page_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_bg_no_color'] ) ? 1 : 0,
						'nav3_sub_page_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_bg_color'],
						'nav3_sub_page_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_bg_image'],
						'nav3_sub_page_hover_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_hover_bg_type'],
						'nav3_sub_page_hover_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_hover_bg_no_color'] ) ? 1 : 0,
						'nav3_sub_page_hover_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_hover_bg_color'],
						'nav3_sub_page_hover_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_hover_bg_image'],
						'nav3_border_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_border_type'],
						'nav3_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['nav1_border_thickness'],
						'nav3_border_style' => $dynamik_design_import['catalyst_dynamik_options']['nav1_border_style'],
						'nav3_border_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_border_color'],
						'nav3_page_top_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_top_border_thickness'],
						'nav3_page_bottom_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_bottom_border_thickness'],
						'nav3_page_left_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_left_border_thickness'],
						'nav3_page_right_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_right_border_thickness'],
						'nav3_page_border_style' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_border_style'],
						'nav3_page_border_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_border_color'],
						'nav3_page_hover_border_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_border_color'],
						'nav3_page_active_border_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_border_color'],
						'nav3_wrap_top_margin' => $dynamik_design_import['catalyst_dynamik_options']['nav1_wrap_top_margin'],
						'nav3_wrap_bottom_margin' => $dynamik_design_import['catalyst_dynamik_options']['nav1_wrap_bottom_margin'],
						'nav3_page_left_margin' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_left_margin'],
						'nav3_page_right_margin' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_right_margin'],
						'nav3_page_tb_padding' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_tb_padding'],
						'nav3_page_lr_padding' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_lr_padding'],
						'nav3_submenu_border_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_submenu_border_color'],
						'nav3_submenu_width' => $dynamik_design_import['catalyst_dynamik_options']['nav1_submenu_width'],
						'nav3_submenu_tb_padding' => $dynamik_design_import['catalyst_dynamik_options']['nav1_submenu_tb_padding'],
						'nav3_submenu_lr_padding' => $dynamik_design_import['catalyst_dynamik_options']['nav1_submenu_lr_padding'],
						'nav3_sub_indicator_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_type'],
						'nav3_sub_indicator_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_image'],
						'nav3_sub_indicator_width' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_width'],
						'nav3_sub_indicator_height' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_height'],
						'nav3_sub_indicator_top' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_top'],
						'nav3_sub_indicator_right' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_right'],
						'content_padding_top' => '0',
						'content_padding_right' => '0',
						'content_padding_bottom' => '0',
						'content_padding_left' => '0',
						'cc_width_dbl_rt_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
						'sb1_width_dbl_rt_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb1_width'],
						'sb2_width_dbl_rt_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb2_width'],
						'cc_width_dbl_lft_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
						'sb1_width_dbl_lft_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb1_width'],
						'sb2_width_dbl_lft_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb2_width'],
						'cc_width_dbl_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
						'sb1_width_dbl_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb1_width'],
						'sb2_width_dbl_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb2_width'],
						'cc_width_rt_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
						'sb1_width_rt_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb1_width'],
						'cc_width_lft_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
						'sb1_width_lft_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb1_width'],
						'cc_width_no_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
						'ez_homepage_select' => preg_replace( '/\.php$/', '', $ez_homepage_select ),
						'ez_home_slider_height' => $dynamik_design_import['catalyst_dynamik_options']['ez_home_slider_height'] . 'px',
						'ez_feature_top_position' => $dynamik_design_import['catalyst_dynamik_options']['ez_feature_top_position'] == 'inside_wrap' ? 'inside_inner' : 'outside_inner',
						'ez_feature_top_select' => preg_replace( '/\.php$/', '', $ez_feature_top_select ),
						'ez_fat_footer_position' => $dynamik_design_import['catalyst_dynamik_options']['ez_fat_footer_position'] == 'inside_footer' ? 'outside_inner' : 'inside_inner',
						'ez_fat_footer_select' => preg_replace( '/\.php$/', '', $ez_fat_footer_select ),
						'ez_widget_footer_border_type' => $ez_widget_footer_border_type,
						'taxonomy_box_heading_font_size' => $dynamik_design_import['catalyst_dynamik_options']['breadcrumbs_font_size'],
						'taxonomy_box_content_font_size' => $dynamik_design_import['catalyst_dynamik_options']['breadcrumbs_font_size'],
						'taxonomy_box_heading_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
						'taxonomy_box_content_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
						'featured_widget_heading_font_size' => $dynamik_design_import['catalyst_dynamik_options']['excerpt_widget_heading_font_size'],
						'featured_widget_byline_font_size' => $dynamik_design_import['catalyst_dynamik_options']['excerpt_widget_byline_font_size'],
						'featured_widget_p_font_size' => $dynamik_design_import['catalyst_dynamik_options']['excerpt_widget_p_font_size'],
						'dynamik_widget_title_font_size' => $dynamik_design_import['catalyst_dynamik_options']['catalyst_widget_title_font_size'],
						'dynamik_widget_content_font_size' => $dynamik_design_import['catalyst_dynamik_options']['catalyst_widget_content_font_size'],
						'featured_widget_heading_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
						'featured_widget_byline_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
						'featured_widget_p_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
						'dynamik_widget_title_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
						'dynamik_widget_content_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
						'author_box_title_font_size' => $dynamik_design_import['catalyst_dynamik_options']['author_info_title_font_size'],
						'author_box_title_font_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_title_font_color'],
						'author_box_title_font_css' => $dynamik_design_import['catalyst_dynamik_options']['author_info_title_font_css'],
						'author_box_font_size' => $dynamik_design_import['catalyst_dynamik_options']['author_info_font_size'],
						'author_box_font_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_font_color'],
						'author_box_font_css' => $dynamik_design_import['catalyst_dynamik_options']['author_info_font_css'],
						'author_box_link_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_link_color'],
						'author_box_link_hover_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_link_hover_color'],
						'author_box_link_underline' => $dynamik_design_import['catalyst_dynamik_options']['author_info_link_underline'],
						'author_box_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['author_info_bg_type'],
						'author_box_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['author_info_bg_no_color'] ) ? 1 : 0,
						'author_box_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_bg_color'],
						'author_box_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['author_info_bg_image'],
						'author_box_avatar_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_bg_type'],
						'author_box_avatar_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['author_avatar_bg_no_color'] ) ? 1 : 0,
						'author_box_avatar_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_bg_color'],
						'author_box_avatar_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_bg_image'],
						'author_box_border_type' => $dynamik_design_import['catalyst_dynamik_options']['author_info_border_type'],
						'author_box_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['author_info_border_thickness'],
						'author_box_border_style' => $dynamik_design_import['catalyst_dynamik_options']['author_info_border_style'],
						'author_box_border_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_border_color'],
						'author_box_avatar_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_border_thickness'],
						'author_box_avatar_border_style' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_border_style'],
						'author_box_avatar_border_color' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_border_color'],
						'author_box_avatar_size' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_size'],
						'author_box_avatar_padding' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_padding'],
						'author_box_margin_top' => $dynamik_design_import['catalyst_dynamik_options']['author_info_margin_top'],
						'author_box_margin_bottom' => $dynamik_design_import['catalyst_dynamik_options']['author_info_margin_bottom'],
						'author_box_padding_top' => $dynamik_design_import['catalyst_dynamik_options']['author_info_padding_top'],
						'author_box_padding_right' => $dynamik_design_import['catalyst_dynamik_options']['author_info_padding_right'],
						'author_box_padding_bottom' => $dynamik_design_import['catalyst_dynamik_options']['author_info_padding_bottom'],
						'author_box_padding_left' => $dynamik_design_import['catalyst_dynamik_options']['author_info_padding_left'],
						'author_box_title_px_em' => $dynamik_design_import['catalyst_dynamik_options']['author_info_title_px_em'],
						'author_box_px_em' => $dynamik_design_import['catalyst_dynamik_options']['author_info_px_em']
					);
			
					if( $dynamik_design_import['catalyst_dynamik_options']['wrap_open_placement'] == 'wrap_open_after_after_header' &&
					$dynamik_design_import['catalyst_dynamik_options']['wrap_close_placement'] == 'wrap_close_before_before_footer' )
					{
						/* Wrap Structure is 'fluid' */
						$unique_to_genesis_fixed_fluid = array(
							'wrap_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['body_bg_type'],
							'wrap_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['body_bg_no_color'] ) ? 1 : 0,
							'wrap_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['body_bg_color'],
							'wrap_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['body_bg_image'],
							'inner_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['wrap_bg_type'],
							'inner_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['wrap_bg_no_color'] ) ? 1 : 0,
							'inner_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['wrap_bg_color'],
							'inner_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['wrap_bg_image'],
							'inner_border_type' => $dynamik_design_import['catalyst_dynamik_options']['wrap_border_type'],
							'inner_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['wrap_border_thickness'],
							'inner_border_style' => $dynamik_design_import['catalyst_dynamik_options']['wrap_border_style'],
							'inner_border_color' => $dynamik_design_import['catalyst_dynamik_options']['wrap_border_color'],
							'inner_shadow_active' => !empty( $dynamik_design_import['catalyst_dynamik_options']['wrap_shadow_active'] ) ? 1 : 0,
							'inner_shadow_style' => $dynamik_design_import['catalyst_dynamik_options']['wrap_shadow_style'],
							'inner_radius_active' => !empty( $dynamik_design_import['catalyst_dynamik_options']['wrap_radius_active'] ) ? 1 : 0,
							'inner_radius_style' => $dynamik_design_import['catalyst_dynamik_options']['wrap_radius_style'],
							'inner_top_margin' => $dynamik_design_import['catalyst_dynamik_options']['wrap_top_margin'],
							'inner_bottom_margin' => $dynamik_design_import['catalyst_dynamik_options']['wrap_bottom_margin'],
							'wrap_structure' => 'fluid'
						);
					}
					else
					{
						/* Wrap Structure is 'fixed' */
						$unique_to_genesis_fixed_fluid = array(
							'inner_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['container_wrap_bg_type'],
							'inner_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['container_wrap_bg_no_color'] ) ? 1 : 0,
							'inner_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['container_wrap_bg_color'],
							'inner_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['container_wrap_bg_image'],
							'wrap_structure' => 'fixed'
						);
					}
					$unique_to_genesis = array_merge( $unique_to_genesis, $unique_to_genesis_fixed_fluid );
					
					$dynamik_design_options_defaults = dynamik_design_options_defaults();

					foreach( $dynamik_design_import['catalyst_dynamik_options']['font_type'] as $key => $value )
					{
						$dynamik_font_type_family_name = substr( $value, 0, strpos( $value, ',' ) );
						$dynamik_design_import['catalyst_dynamik_options']['font_type'][$key] = str_replace( '\'', '', $dynamik_font_type_family_name );
					}
					
					$dynamik_design_import['catalyst_dynamik_options']['font_type'] = array_merge( $dynamik_design_options_defaults['font_type'], $dynamik_design_import['catalyst_dynamik_options']['font_type'] );
					$design_import_merge_unique = array_merge( $dynamik_design_import['catalyst_dynamik_options'], $unique_to_genesis );
					$design_import_catalyst = array_merge( dynamik_design_options_defaults(), $design_import_merge_unique );
					$pre_rem_import = true;

					$google_fonts_to_merge = array( 'add_google_fonts' => dynamik_deprecated_google_fonts_list() );
					$merge_in_google_fonts = array_merge( $design_import_catalyst, $google_fonts_to_merge );
					$design_import = array_merge( dynamik_design_options_defaults( false, false, $design_import_catalyst ), $merge_in_google_fonts );				

					// With the addition of the Media Query Width Options we now need to pull in the
					// Imported version of the media_wrap_width value to ensure a proper Import
					$media_wrap_width = $dynamik_design_import['catalyst_responsive_options']['media_wrap_width'];
					$responsive_media_query_widths = array(
						'media_query_large_cascading_width' => $media_wrap_width,
						'dynamik_media_query_large_max_width' => $media_wrap_width,
						'dynamik_media_query_medium_large_max_width' => $media_wrap_width
					);
					$responsive_pre_import = array_merge( $dynamik_design_import['catalyst_responsive_options'], $responsive_media_query_widths );
					$responsive_import = array_merge( dynamik_responsive_options_defaults(), $responsive_pre_import );
					$import_notice = 'import-catalyst-complete';
				} /* ElseIf the Dynamik Design Import file is from an older/incompatible Catalyst/Dynamik Export */
				elseif( isset( $dynamik_design_import['body_bg_type'] ) )
				{
					$import_notice = 'import-error-catalyst';
				}
				else
				{
					$pre_rem_import = !empty( $dynamik_design_import['dynamik_gen_design_options']['content_p_px_em'] ) ? true : false;

					if( !isset( $dynamik_design_import['dynamik_gen_design_options']['add_google_fonts'] ) )
					{
						foreach( $dynamik_design_import['dynamik_gen_design_options']['font_type'] as $key => $value )
						{
							$dynamik_font_type_family_name = substr( $value, 0, strpos( $value, ',' ) );
							$dynamik_design_import['dynamik_gen_design_options']['font_type'][$key] = str_replace( '\'', '', $dynamik_font_type_family_name );
						}

						$google_fonts_to_merge = array( 'add_google_fonts' => dynamik_deprecated_google_fonts_list() );
						$merge_in_google_fonts = array_merge( $dynamik_design_import['dynamik_gen_design_options'], $google_fonts_to_merge );
						$design_import = array_merge( dynamik_design_options_defaults( false, false, $dynamik_design_import['dynamik_gen_design_options'] ), $merge_in_google_fonts );				
					}
					else
					{
						$design_import = array_merge( dynamik_design_options_defaults( false, false, $dynamik_design_import['dynamik_gen_design_options'] ), $dynamik_design_import['dynamik_gen_design_options'] );
					}
					
					if( true == $pre_rem_import )
					{
						// With the addition of the Media Query Width Options we now need to pull in the
						// Imported version of the media_wrap_width value to ensure a proper Import
						$media_wrap_width = $dynamik_design_import['dynamik_gen_responsive_options']['media_wrap_width'];
						$responsive_media_query_widths = array(
							'media_query_large_cascading_width' => $media_wrap_width,
							'dynamik_media_query_large_max_width' => $media_wrap_width,
							'dynamik_media_query_medium_large_max_width' => $media_wrap_width
						);
						$responsive_pre_import = array_merge( dynamik_responsive_options_defaults(), $dynamik_design_import['dynamik_gen_responsive_options'] );
						$responsive_import = array_merge( $responsive_pre_import, $responsive_media_query_widths );
					}
					else
					{
						$responsive_import = array_merge( dynamik_responsive_options_defaults(), $dynamik_design_import['dynamik_gen_responsive_options'] );
					}
				}
				
				if( $import_notice != 'import-error-catalyst' )
				{
					// If the Import file is a pre-rem import then update Design Options
					// while converting font sizes accordingly, otherwise perform a basic update_option
					if( true == $pre_rem_import )
						dynamik_update_design_px_em_conversion( $design_import );
					else
						update_option( 'dynamik_gen_design_options', $design_import );

					update_option( 'dynamik_gen_responsive_options', $responsive_import );
				}
			}
		}
		closedir( $handle );

		dynamik_skin_images_cleanup();

		$skin_images_list = array();
		$handle = opendir( $tmp_image_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
			{
				if( $file != 'skin-screenshot.png' )
				{
					$skin_images_list[] = $file;
				}
				copy( $tmp_image_folder . '/' . $file, $image_folder . '/' . $file );
			}
		}
		closedir( $handle );
		
		$handle = opendir( $tmp_adthumbs_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( $tmp_adthumbs_folder . '/' . $file, $adthumbs_folder . '/' . $file );
			}
		}
		closedir( $handle );
		
		dynamik_delete_dir( $tmp_import_folder );
		dynamik_folders_close_permissions();
		
		if( $import_notice != 'import-error-catalyst' )
		{
			dynamik_write_files( $css = true, $ez = true, $custom = false );
		}

		dynamik_skin_options_update( $skin_name, false, $skin_update, $skin_images_list );

		wp_redirect( admin_url( 'admin.php?page=dynamik-design&activetab=dynamik-design-options-nav-skins&notice=' . $import_notice ) );
		exit();
	}	
	elseif( 'dat' == strtolower( substr( strrchr( $import_file['name'], '.' ), 1 ) ) )
	{
		if( get_option( 'dynamik_gen_' . strtolower( substr( $import_file['name'], 0, -4 ) ) . '_skin' ) )
		{
			wp_redirect( admin_url( 'admin.php?page=dynamik-design&activetab=dynamik-design-options-nav-skins&notice=skin-import-error' ) );
			exit();
		}

		dynamik_skin_images_cleanup();

		$import_data = file_get_contents( $import_file['tmp_name'] );
		$dynamik_design_import = unserialize( $import_data );

		if( !is_dir( dynamik_get_skins_folder_path() . '/' . $skin_name ) )
		{
			mkdir( dynamik_get_skins_folder_path() . '/' . $skin_name, 0755, true );
		}
		if( !is_dir( dynamik_get_skins_folder_path() . '/' . $skin_name . '/images' ) )
		{
			mkdir( dynamik_get_skins_folder_path() . '/' . $skin_name . '/images', 0755, true );
		}
		if( !is_dir( dynamik_get_skins_folder_path() . '/' . $skin_name . '/images/adminthumbnails' ) )
		{
			mkdir( dynamik_get_skins_folder_path() . '/' . $skin_name . '/images/adminthumbnails', 0755, true );
		}

		$handle = @fopen( dynamik_get_skins_folder_path() . '/' . $skin_name . '/' . $import_file['name'], 'w' );
		@fwrite( $handle, $import_data );
		@fclose( $handle );
		if( substr( sprintf( '%o', fileperms( dynamik_get_skins_folder_path() . '/' . $skin_name . '/' . $import_file['name'] ) ), -4 ) != '0644' &&
			substr( sprintf( '%o', fileperms( dynamik_get_skins_folder_path() . '/' . $skin_name . '/' . $import_file['name'] ) ), -4 ) != '0666' )
		{
			@chmod( dynamik_get_skins_folder_path() . '/' . $skin_name . '/' . $import_file['name'], 0644 );
		}

		$handle = opendir( dynamik_get_skins_folder_path() . '/' . $skin_name );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'dat' )
			{
				unlink( dynamik_get_skins_folder_path() . '/' . $skin_name . '/' . $file );
			}
		}
		closedir( $handle );

		dynamik_import_skin( $skin_name );

		/* If the Dynamik Design Import file is from a Catalyst/Dynamik Export */
		if( isset( $dynamik_design_import['catalyst_dynamik_options']['body_bg_type'] ) )
		{
			$ez_select_find = array( 'wide_left', 'wide_right' );
			$ez_select_replace = array( 'wl', 'wr' );
			$ez_homepage_select = str_replace( $ez_select_find, $ez_select_replace, $dynamik_design_import['catalyst_dynamik_options']['ez_homepage_select'] );
			$ez_feature_top_select = str_replace( $ez_select_find, $ez_select_replace, $dynamik_design_import['catalyst_dynamik_options']['ez_feature_top_select'] );
			$ez_fat_footer_select = str_replace( $ez_select_find, $ez_select_replace, $dynamik_design_import['catalyst_dynamik_options']['ez_fat_footer_select'] );
			
			if( $dynamik_design_import['catalyst_dynamik_options']['ez_widget_footer_border_type'] == 'Top' )
			{
				$ez_widget_footer_border_type = 'Bottom';
			}
			elseif( $dynamik_design_import['catalyst_dynamik_options']['ez_widget_footer_border_type'] == 'Bottom' )
			{
				$ez_widget_footer_border_type = 'Top';
			}
			else
			{
				$ez_widget_footer_border_type = $dynamik_design_import['catalyst_dynamik_options']['ez_widget_footer_border_type'];
			}

			$unique_to_genesis = array(
				'inner_tb_padding' => $dynamik_design_import['catalyst_dynamik_options']['container_wrap_tb_padding'],
				'inner_lr_padding' => $dynamik_design_import['catalyst_dynamik_options']['container_wrap_lr_padding'],
				'header_title_area_width' => $dynamik_design_import['catalyst_dynamik_options']['header_left_width'],
				'header_widget_width' => $dynamik_design_import['catalyst_dynamik_options']['header_right_width'],
				'nav1_extras_font_size' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_font_size'],
				'nav1_extras_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_font_color'],
				'nav1_extras_font_css' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_font_css'],
				'nav1_extras_link_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_link_color'],
				'nav1_extras_link_hover_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_link_hover_color'],
				'nav1_extras_link_underline' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_link_underline'],
				'nav1_extras_px_em' => $dynamik_design_import['catalyst_dynamik_options']['nav1_right_px_em'],
				'nav3_font_size' => $dynamik_design_import['catalyst_dynamik_options']['nav1_font_size'],
				'nav3_px_em' => $dynamik_design_import['catalyst_dynamik_options']['nav1_px_em'],
				'nav3_font_css' => $dynamik_design_import['catalyst_dynamik_options']['nav1_font_css'],
				'nav3_link_underline' => $dynamik_design_import['catalyst_dynamik_options']['nav1_link_underline'],
				'nav3_page_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_font_color'],
				'nav3_page_hover_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_font_color'],
				'nav3_page_active_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_font_color'],
				'nav3_sub_page_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_font_color'],
				'nav3_sub_page_hover_font_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_hover_font_color'],
				'nav3_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_bg_type'],
				'nav3_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_bg_no_color'] ) ? 1 : 0,
				'nav3_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_bg_color'],
				'nav3_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_bg_image'],
				'nav3_page_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_bg_type'],
				'nav3_page_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_page_bg_no_color'] ) ? 1 : 0,
				'nav3_page_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_bg_color'],
				'nav3_page_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_bg_image'],
				'nav3_page_hover_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_bg_type'],
				'nav3_page_hover_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_bg_no_color'] ) ? 1 : 0,
				'nav3_page_hover_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_bg_color'],
				'nav3_page_hover_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_bg_image'],
				'nav3_page_active_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_bg_type'],
				'nav3_page_active_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_bg_no_color'] ) ? 1 : 0,
				'nav3_page_active_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_bg_color'],
				'nav3_page_active_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_bg_image'],
				'nav3_sub_page_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_bg_type'],
				'nav3_sub_page_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_bg_no_color'] ) ? 1 : 0,
				'nav3_sub_page_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_bg_color'],
				'nav3_sub_page_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_bg_image'],
				'nav3_sub_page_hover_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_hover_bg_type'],
				'nav3_sub_page_hover_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_hover_bg_no_color'] ) ? 1 : 0,
				'nav3_sub_page_hover_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_hover_bg_color'],
				'nav3_sub_page_hover_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_page_hover_bg_image'],
				'nav3_border_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_border_type'],
				'nav3_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['nav1_border_thickness'],
				'nav3_border_style' => $dynamik_design_import['catalyst_dynamik_options']['nav1_border_style'],
				'nav3_border_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_border_color'],
				'nav3_page_top_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_top_border_thickness'],
				'nav3_page_bottom_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_bottom_border_thickness'],
				'nav3_page_left_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_left_border_thickness'],
				'nav3_page_right_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_right_border_thickness'],
				'nav3_page_border_style' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_border_style'],
				'nav3_page_border_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_border_color'],
				'nav3_page_hover_border_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_hover_border_color'],
				'nav3_page_active_border_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_active_border_color'],
				'nav3_wrap_top_margin' => $dynamik_design_import['catalyst_dynamik_options']['nav1_wrap_top_margin'],
				'nav3_wrap_bottom_margin' => $dynamik_design_import['catalyst_dynamik_options']['nav1_wrap_bottom_margin'],
				'nav3_page_left_margin' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_left_margin'],
				'nav3_page_right_margin' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_right_margin'],
				'nav3_page_tb_padding' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_tb_padding'],
				'nav3_page_lr_padding' => $dynamik_design_import['catalyst_dynamik_options']['nav1_page_lr_padding'],
				'nav3_submenu_border_color' => $dynamik_design_import['catalyst_dynamik_options']['nav1_submenu_border_color'],
				'nav3_submenu_width' => $dynamik_design_import['catalyst_dynamik_options']['nav1_submenu_width'],
				'nav3_submenu_tb_padding' => $dynamik_design_import['catalyst_dynamik_options']['nav1_submenu_tb_padding'],
				'nav3_submenu_lr_padding' => $dynamik_design_import['catalyst_dynamik_options']['nav1_submenu_lr_padding'],
				'nav3_sub_indicator_type' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_type'],
				'nav3_sub_indicator_image' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_image'],
				'nav3_sub_indicator_width' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_width'],
				'nav3_sub_indicator_height' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_height'],
				'nav3_sub_indicator_top' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_top'],
				'nav3_sub_indicator_right' => $dynamik_design_import['catalyst_dynamik_options']['nav1_sub_indicator_right'],
				'content_padding_top' => '0',
				'content_padding_right' => '0',
				'content_padding_bottom' => '0',
				'content_padding_left' => '0',
				'cc_width_dbl_rt_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
				'sb1_width_dbl_rt_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb1_width'],
				'sb2_width_dbl_rt_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb2_width'],
				'cc_width_dbl_lft_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
				'sb1_width_dbl_lft_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb1_width'],
				'sb2_width_dbl_lft_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb2_width'],
				'cc_width_dbl_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
				'sb1_width_dbl_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb1_width'],
				'sb2_width_dbl_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb2_width'],
				'cc_width_rt_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
				'sb1_width_rt_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb1_width'],
				'cc_width_lft_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
				'sb1_width_lft_sb' => $dynamik_design_import['catalyst_dynamik_options']['sb1_width'],
				'cc_width_no_sb' => $dynamik_design_import['catalyst_dynamik_options']['cc_width'],
				'ez_homepage_select' => preg_replace( '/\.php$/', '', $ez_homepage_select ),
				'ez_home_slider_height' => $dynamik_design_import['catalyst_dynamik_options']['ez_home_slider_height'] . 'px',
				'ez_feature_top_position' => $dynamik_design_import['catalyst_dynamik_options']['ez_feature_top_position'] == 'inside_wrap' ? 'inside_inner' : 'outside_inner',
				'ez_feature_top_select' => preg_replace( '/\.php$/', '', $ez_feature_top_select ),
				'ez_fat_footer_position' => $dynamik_design_import['catalyst_dynamik_options']['ez_fat_footer_position'] == 'inside_footer' ? 'outside_inner' : 'inside_inner',
				'ez_fat_footer_select' => preg_replace( '/\.php$/', '', $ez_fat_footer_select ),
				'ez_widget_footer_border_type' => $ez_widget_footer_border_type,
				'taxonomy_box_heading_font_size' => $dynamik_design_import['catalyst_dynamik_options']['breadcrumbs_font_size'],
				'taxonomy_box_content_font_size' => $dynamik_design_import['catalyst_dynamik_options']['breadcrumbs_font_size'],
				'taxonomy_box_heading_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
				'taxonomy_box_content_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
				'featured_widget_heading_font_size' => $dynamik_design_import['catalyst_dynamik_options']['excerpt_widget_heading_font_size'],
				'featured_widget_byline_font_size' => $dynamik_design_import['catalyst_dynamik_options']['excerpt_widget_byline_font_size'],
				'featured_widget_p_font_size' => $dynamik_design_import['catalyst_dynamik_options']['excerpt_widget_p_font_size'],
				'dynamik_widget_title_font_size' => $dynamik_design_import['catalyst_dynamik_options']['catalyst_widget_title_font_size'],
				'dynamik_widget_content_font_size' => $dynamik_design_import['catalyst_dynamik_options']['catalyst_widget_content_font_size'],
				'featured_widget_heading_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
				'featured_widget_byline_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
				'featured_widget_p_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
				'dynamik_widget_title_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
				'dynamik_widget_content_px_em' => $dynamik_design_import['catalyst_dynamik_options']['content_p_px_em'],
				'author_box_title_font_size' => $dynamik_design_import['catalyst_dynamik_options']['author_info_title_font_size'],
				'author_box_title_font_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_title_font_color'],
				'author_box_title_font_css' => $dynamik_design_import['catalyst_dynamik_options']['author_info_title_font_css'],
				'author_box_font_size' => $dynamik_design_import['catalyst_dynamik_options']['author_info_font_size'],
				'author_box_font_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_font_color'],
				'author_box_font_css' => $dynamik_design_import['catalyst_dynamik_options']['author_info_font_css'],
				'author_box_link_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_link_color'],
				'author_box_link_hover_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_link_hover_color'],
				'author_box_link_underline' => $dynamik_design_import['catalyst_dynamik_options']['author_info_link_underline'],
				'author_box_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['author_info_bg_type'],
				'author_box_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['author_info_bg_no_color'] ) ? 1 : 0,
				'author_box_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_bg_color'],
				'author_box_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['author_info_bg_image'],
				'author_box_avatar_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_bg_type'],
				'author_box_avatar_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['author_avatar_bg_no_color'] ) ? 1 : 0,
				'author_box_avatar_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_bg_color'],
				'author_box_avatar_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_bg_image'],
				'author_box_border_type' => $dynamik_design_import['catalyst_dynamik_options']['author_info_border_type'],
				'author_box_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['author_info_border_thickness'],
				'author_box_border_style' => $dynamik_design_import['catalyst_dynamik_options']['author_info_border_style'],
				'author_box_border_color' => $dynamik_design_import['catalyst_dynamik_options']['author_info_border_color'],
				'author_box_avatar_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_border_thickness'],
				'author_box_avatar_border_style' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_border_style'],
				'author_box_avatar_border_color' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_border_color'],
				'author_box_avatar_size' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_size'],
				'author_box_avatar_padding' => $dynamik_design_import['catalyst_dynamik_options']['author_avatar_padding'],
				'author_box_margin_top' => $dynamik_design_import['catalyst_dynamik_options']['author_info_margin_top'],
				'author_box_margin_bottom' => $dynamik_design_import['catalyst_dynamik_options']['author_info_margin_bottom'],
				'author_box_padding_top' => $dynamik_design_import['catalyst_dynamik_options']['author_info_padding_top'],
				'author_box_padding_right' => $dynamik_design_import['catalyst_dynamik_options']['author_info_padding_right'],
				'author_box_padding_bottom' => $dynamik_design_import['catalyst_dynamik_options']['author_info_padding_bottom'],
				'author_box_padding_left' => $dynamik_design_import['catalyst_dynamik_options']['author_info_padding_left'],
				'author_box_title_px_em' => $dynamik_design_import['catalyst_dynamik_options']['author_info_title_px_em'],
				'author_box_px_em' => $dynamik_design_import['catalyst_dynamik_options']['author_info_px_em']
			);
			
			if( $dynamik_design_import['catalyst_dynamik_options']['wrap_open_placement'] == 'wrap_open_after_after_header' &&
			$dynamik_design_import['catalyst_dynamik_options']['wrap_close_placement'] == 'wrap_close_before_before_footer' )
			{
				/* Wrap Structure is 'fluid' */
				$unique_to_genesis_fixed_fluid = array(
					'wrap_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['body_bg_type'],
					'wrap_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['body_bg_no_color'] ) ? 1 : 0,
					'wrap_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['body_bg_color'],
					'wrap_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['body_bg_image'],
					'inner_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['wrap_bg_type'],
					'inner_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['wrap_bg_no_color'] ) ? 1 : 0,
					'inner_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['wrap_bg_color'],
					'inner_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['wrap_bg_image'],
					'inner_border_type' => $dynamik_design_import['catalyst_dynamik_options']['wrap_border_type'],
					'inner_border_thickness' => $dynamik_design_import['catalyst_dynamik_options']['wrap_border_thickness'],
					'inner_border_style' => $dynamik_design_import['catalyst_dynamik_options']['wrap_border_style'],
					'inner_border_color' => $dynamik_design_import['catalyst_dynamik_options']['wrap_border_color'],
					'inner_shadow_active' => !empty( $dynamik_design_import['catalyst_dynamik_options']['wrap_shadow_active'] ) ? 1 : 0,
					'inner_shadow_style' => $dynamik_design_import['catalyst_dynamik_options']['wrap_shadow_style'],
					'inner_radius_active' => !empty( $dynamik_design_import['catalyst_dynamik_options']['wrap_radius_active'] ) ? 1 : 0,
					'inner_radius_style' => $dynamik_design_import['catalyst_dynamik_options']['wrap_radius_style'],
					'inner_top_margin' => $dynamik_design_import['catalyst_dynamik_options']['wrap_top_margin'],
					'inner_bottom_margin' => $dynamik_design_import['catalyst_dynamik_options']['wrap_bottom_margin'],
					'wrap_structure' => 'fluid'
				);
			}
			else
			{
				/* Wrap Structure is 'fixed' */
				$unique_to_genesis_fixed_fluid = array(
					'inner_bg_type' => $dynamik_design_import['catalyst_dynamik_options']['container_wrap_bg_type'],
					'inner_bg_no_color' => !empty( $dynamik_design_import['catalyst_dynamik_options']['container_wrap_bg_no_color'] ) ? 1 : 0,
					'inner_bg_color' => $dynamik_design_import['catalyst_dynamik_options']['container_wrap_bg_color'],
					'inner_bg_image' => $dynamik_design_import['catalyst_dynamik_options']['container_wrap_bg_image'],
					'wrap_structure' => 'fixed'
				);
			}
			$unique_to_genesis = array_merge( $unique_to_genesis, $unique_to_genesis_fixed_fluid );
			
			$dynamik_design_options_defaults = dynamik_design_options_defaults();

			foreach( $dynamik_design_import['catalyst_dynamik_options']['font_type'] as $key => $value )
			{
				$dynamik_font_type_family_name = substr( $value, 0, strpos( $value, ',' ) );
				$dynamik_design_import['catalyst_dynamik_options']['font_type'][$key] = str_replace( '\'', '', $dynamik_font_type_family_name );
			}
			
			$dynamik_design_import['catalyst_dynamik_options']['font_type'] = array_merge( $dynamik_design_options_defaults['font_type'], $dynamik_design_import['catalyst_dynamik_options']['font_type'] );
			$design_import_merge_unique = array_merge( $dynamik_design_import['catalyst_dynamik_options'], $unique_to_genesis );
			$design_import_catalyst = array_merge( dynamik_design_options_defaults(), $design_import_merge_unique );
			$pre_rem_import = true;

			$google_fonts_to_merge = array( 'add_google_fonts' => dynamik_deprecated_google_fonts_list() );
			$merge_in_google_fonts = array_merge( $design_import_catalyst, $google_fonts_to_merge );
			$design_import = array_merge( dynamik_design_options_defaults( false, false, $design_import_catalyst ), $merge_in_google_fonts );	

			// With the addition of the Media Query Width Options we now need to pull in the
			// Imported version of the media_wrap_width value to ensure a proper Import
			$media_wrap_width = $dynamik_design_import['catalyst_responsive_options']['media_wrap_width'];
			$responsive_media_query_widths = array(
				'media_query_large_cascading_width' => $media_wrap_width,
				'dynamik_media_query_large_max_width' => $media_wrap_width,
				'dynamik_media_query_medium_large_max_width' => $media_wrap_width
			);
			$responsive_pre_import = array_merge( $dynamik_design_import['catalyst_responsive_options'], $responsive_media_query_widths );
			$responsive_import = array_merge( dynamik_responsive_options_defaults(), $responsive_pre_import );
			$import_notice = 'import-catalyst-complete';
		} /* ElseIf the Dynamik Design Import file is from an older/incompatible Catalyst/Dynamik Export */
		elseif( isset( $dynamik_design_import['body_bg_type'] ) )
		{
			$import_notice = 'import-error-catalyst';
		}
		else
		{
			$pre_rem_import = !empty( $dynamik_design_import['dynamik_gen_design_options']['content_p_px_em'] ) ? true : false;

			if( !isset( $dynamik_design_import['dynamik_gen_design_options']['add_google_fonts'] ) )
			{
				foreach( $dynamik_design_import['dynamik_gen_design_options']['font_type'] as $key => $value )
				{
					$dynamik_font_type_family_name = substr( $value, 0, strpos( $value, ',' ) );
					$dynamik_design_import['dynamik_gen_design_options']['font_type'][$key] = str_replace( '\'', '', $dynamik_font_type_family_name );
				}

				$google_fonts_to_merge = array( 'add_google_fonts' => dynamik_deprecated_google_fonts_list() );
				$merge_in_google_fonts = array_merge( $dynamik_design_import['dynamik_gen_design_options'], $google_fonts_to_merge );
				$design_import = array_merge( dynamik_design_options_defaults( false, false, $dynamik_design_import['dynamik_gen_design_options'] ), $merge_in_google_fonts );				
			}
			else
			{
				$design_import = array_merge( dynamik_design_options_defaults( false, false, $dynamik_design_import['dynamik_gen_design_options'] ), $dynamik_design_import['dynamik_gen_design_options'] );
			}
			
			if( true == $pre_rem_import )
			{
				// With the addition of the Media Query Width Options we now need to pull in the
				// Imported version of the media_wrap_width value to ensure a proper Import
				$media_wrap_width = $dynamik_design_import['dynamik_gen_responsive_options']['media_wrap_width'];
				$responsive_media_query_widths = array(
					'media_query_large_cascading_width' => $media_wrap_width,
					'dynamik_media_query_large_max_width' => $media_wrap_width,
					'dynamik_media_query_medium_large_max_width' => $media_wrap_width
				);
				$responsive_pre_import = array_merge( dynamik_responsive_options_defaults(), $dynamik_design_import['dynamik_gen_responsive_options'] );
				$responsive_import = array_merge( $responsive_pre_import, $responsive_media_query_widths );
			}
			else
			{
				$responsive_import = array_merge( dynamik_responsive_options_defaults(), $dynamik_design_import['dynamik_gen_responsive_options'] );
			}
		}

		if( $import_notice != 'import-error-catalyst' )
		{
			// If the Import file is a pre-rem import then update Design Options
			// while converting font sizes accordingly, otherwise perform a basic update_option
			if( true == $pre_rem_import )
				dynamik_update_design_px_em_conversion( $design_import );
			else
				update_option( 'dynamik_gen_design_options', $design_import );

			update_option( 'dynamik_gen_responsive_options', $responsive_import );
		
			dynamik_write_files( $css = true, $ez = true, $custom = false );
		}

		dynamik_skin_options_update( $skin_name );

		wp_redirect( admin_url( 'admin.php?page=dynamik-design&activetab=dynamik-design-options-nav-skins&notice=' . $import_notice ) );
		exit();
	}
	else
	{
		wp_redirect( admin_url( 'admin.php?page=dynamik-design&activetab=dynamik-design-options-nav-import-export&notice=import-error' ) );
		exit();
	}
}

/**
 * Export the specified Custom Option settings.
 *
 * @since 1.0
 */
function dynamik_custom_export( $export_name = false, $theme_settings = '', $custom_css = '', $custom_functions = '', $custom_js = '', $custom_templates = '', $custom_labels = '', $conditionals = '', $widget_areas = '', $hook_boxes = '' )
{
	$export_data = array();
	
	if( !empty( $theme_settings ) )
	{
		$export_data['dynamik_theme_settings'] = get_option( 'dynamik_gen_theme_settings' );
	}
	
	if( !empty( $custom_css ) )
	{
		$export_data['dynamik_custom_css'] = get_option( 'dynamik_gen_custom_css' );
	}
	
	if( !empty( $custom_functions ) )
	{
		$export_data['dynamik_custom_functions'] = get_option( 'dynamik_gen_custom_functions' );
	}

	if( !empty( $custom_js ) )
	{
		$export_data['dynamik_custom_js'] = get_option( 'dynamik_gen_custom_js' );
	}

	if( !empty( $custom_templates ) )
	{
		$export_data['dynamik_templates'] = get_option( 'dynamik_gen_custom_templates' );
	}

	if( !empty( $custom_labels ) )
	{
		$export_data['dynamik_labels'] = get_option( 'dynamik_gen_custom_labels' );
	}
	
	if( !empty( $conditionals ) )
	{
		$export_data['dynamik_conditionals'] = get_option( 'dynamik_gen_custom_conditionals' );
	}
	
	if( !empty( $widget_areas ) )
	{
		$export_data['dynamik_widgets'] = get_option( 'dynamik_gen_custom_widget_areas' );
	}
	
	if( !empty( $hook_boxes ) )
	{
		$export_data['dynamik_hooks'] = get_option( 'dynamik_gen_custom_hook_boxes' );
	}

	$dynamik_datestamp = date( 'YmdHis', dynamik_time() );
	if( $export_name && $export_name != 'Export File Name' )
	{
		$dynamik_export_dat = $export_name . '.dat';
	}
	else
	{
		$dynamik_export_dat = 'dynamik_custom_' . $dynamik_datestamp . '.dat';
	}
	
	$cheerios = serialize( $export_data );
	
	header( "Content-type: text/plain" );
	header( "Content-disposition: attachment; filename=$dynamik_export_dat" );
	header( "Content-Transfer-Encoding: binary" );
	header( "Pragma: no-cache" );
	header( "Expires: 0" );
	echo $cheerios; 
	exit();
}

/**
 * Import the specified Custom Option settings into
 * their appropriate sections of the wp_options table.
 *
 * @since 1.0
 */
function dynamik_custom_import( $import_file, $theme_settings = '', $custom_css = '', $custom_functions = '', $custom_js = '', $custom_templates = '', $custom_labels = '', $conditionals = '', $widget_areas = '', $hook_boxes = '' )
{
	$dynamik_templates = get_option( 'dynamik_gen_custom_templates' );
	$dynamik_labels = get_option( 'dynamik_gen_custom_labels' );
	$dynamik_conditionals = get_option( 'dynamik_gen_custom_conditionals' );
	$dynamik_widgets = get_option( 'dynamik_gen_custom_widget_areas' );
	$dynamik_hooks = get_option( 'dynamik_gen_custom_hook_boxes' );
	
	if( 'dat' == strtolower( substr( strrchr( $import_file['name'], '.' ), 1 ) ) )
	{
		$import_data = file_get_contents( $import_file['tmp_name'] );
		$dynamik_import = unserialize( $import_data );
		
		if( !empty( $theme_settings ) )
		{
			if( !empty( $dynamik_import['dynamik_theme_settings'] ) )
			{
				$theme_settings_import = array_merge( dynamik_theme_settings_defaults( false, $dynamik_import['dynamik_theme_settings'] ), $dynamik_import['dynamik_theme_settings'] );
				update_option( 'dynamik_gen_theme_settings', $theme_settings_import );
			}
		}
		
		if( !empty( $custom_css ) )
		{
			if( !empty( $dynamik_import['dynamik_custom_css'] ) )
			{
				$custom_css_import = array_merge( dynamik_custom_css_options_defaults(), $dynamik_import['dynamik_custom_css'] );
				update_option( 'dynamik_gen_custom_css', $custom_css_import );
			}
		}
		
		if( !empty( $custom_functions ) )
		{
			if( !empty( $dynamik_import['dynamik_custom_functions'] ) )
			{
				$custom_functions_import = array_merge( dynamik_custom_functions_options_defaults(), $dynamik_import['dynamik_custom_functions'] );
				update_option( 'dynamik_gen_custom_functions', $custom_functions_import );
			}
		}

		if( !empty( $custom_js ) )
		{
			if( !empty( $dynamik_import['dynamik_custom_js'] ) )
			{
				$custom_js_import = array_merge( dynamik_custom_js_options_defaults(), $dynamik_import['dynamik_custom_js'] );
				update_option( 'dynamik_gen_custom_js', $custom_js_import );
			}
		}

		if( !empty( $custom_templates ) )
		{
			if( !empty( $dynamik_import['dynamik_templates'] ) )
			{
				$dynamik_templates_array = array();
				foreach( $dynamik_templates as $key => $value )
				{
					if( !in_array( $dynamik_templates[$key]['template_file_name'], $dynamik_templates_array ) )
					{
						$dynamik_templates_array[] = $dynamik_templates[$key]['template_file_name'];
					}
				}
				foreach( $dynamik_import['dynamik_templates'] as $key => $value )
				{	
					if( in_array( $dynamik_import['dynamik_templates'][$key]['template_file_name'], $dynamik_templates_array ) )
					{
						unset( $dynamik_import['dynamik_templates'][$key] );
					}
				}
				$templates_import = array_merge( $dynamik_templates, $dynamik_import['dynamik_templates'] );
				update_option( 'dynamik_gen_custom_templates', $templates_import );
			}
		}

		if( !empty( $custom_labels ) )
		{
			if( !empty( $dynamik_import['dynamik_labels'] ) )
			{
				$dynamik_labels_array = array();
				foreach( $dynamik_labels as $key => $value )
				{
					if( !in_array( $dynamik_labels[$key]['label_name'], $dynamik_labels_array ) )
					{
						$dynamik_labels_array[] = $dynamik_labels[$key]['label_name'];
					}
				}
				foreach( $dynamik_import['dynamik_labels'] as $key => $value )
				{	
					if( in_array( $dynamik_import['dynamik_labels'][$key]['label_name'], $dynamik_labels_array ) )
					{
						unset( $dynamik_import['dynamik_labels'][$key] );
					}
				}
				$labels_import = array_merge( $dynamik_labels, $dynamik_import['dynamik_labels'] );
				update_option( 'dynamik_gen_custom_labels', $labels_import );
			}
		}
		
		if( !empty( $conditionals ) )
		{
			if( !empty( $dynamik_import['dynamik_conditionals'] ) )
			{
				$dynamik_conditionals_array = array();
				foreach( $dynamik_conditionals as $key => $value )
				{
					$dynamik_conditionals_array[] = $dynamik_conditionals[$key]['conditional_id'];
				}
				foreach( $dynamik_import['dynamik_conditionals'] as $key => $value )
				{	
					if( in_array( $dynamik_import['dynamik_conditionals'][$key]['conditional_id'], $dynamik_conditionals_array ) )
					{
						unset( $dynamik_import['dynamik_conditionals'][$key] );
					}
				}
				$conditionals_import = array_merge( $dynamik_conditionals, $dynamik_import['dynamik_conditionals'] );
				update_option( 'dynamik_gen_custom_conditionals', $conditionals_import );
			}
		}
		
		if( !empty( $widget_areas ) )
		{
			if( !empty( $dynamik_import['dynamik_widgets'] ) )
			{
				$dynamik_widgets_array = array();
				foreach( $dynamik_widgets as $key => $value )
				{
					if( !in_array( $dynamik_widgets[$key]['widget_name'], $dynamik_widgets_array ) )
					{
						$dynamik_widgets_array[] = $dynamik_widgets[$key]['widget_name'];
					}
				}
				foreach( $dynamik_import['dynamik_widgets'] as $key => $value )
				{	
					if( in_array( $dynamik_import['dynamik_widgets'][$key]['widget_name'], $dynamik_widgets_array ) )
					{
						unset( $dynamik_import['dynamik_widgets'][$key] );
					}
				}
				$widgets_import = array_merge( $dynamik_widgets, $dynamik_import['dynamik_widgets'] );
				update_option( 'dynamik_gen_custom_widget_areas', $widgets_import );
			}
		}
		
		if( !empty( $hook_boxes ) )
		{
			if( !empty( $dynamik_import['dynamik_hooks'] ) )
			{
				$dynamik_hooks_array = array();
				foreach( $dynamik_hooks as $key => $value )
				{
					if( !in_array( $dynamik_hooks[$key]['hook_name'], $dynamik_hooks_array ) )
					{
						$dynamik_hooks_array[] = $dynamik_hooks[$key]['hook_name'];
					}
				}
				foreach( $dynamik_import['dynamik_hooks'] as $key => $value )
				{	
					if( in_array( $dynamik_import['dynamik_hooks'][$key]['hook_name'], $dynamik_hooks_array ) )
					{
						unset( $dynamik_import['dynamik_hooks'][$key] );
					}
				}
				$hooks_import = array_merge( $dynamik_hooks, $dynamik_import['dynamik_hooks'] );
				update_option( 'dynamik_gen_custom_hook_boxes', $hooks_import );
			}
		}
		
		dynamik_write_files( $css = true, $ez = false );
		wp_redirect( admin_url( 'admin.php?page=dynamik-settings&activetab=dynamik-theme-settings-nav-import-export&notice=import-complete' ) );
		exit();
	}	
	else
	{
		wp_redirect( admin_url( 'admin.php?page=dynamik-settings&activetab=dynamik-theme-settings-nav-import-export&notice=import-error' ) );
		exit();
	}
}

/**
 * Clone the Dynamik Child Theme Settings & Images over to the Genesis Extender Plugin.
 *
 * @since 1.0.2
 */
function dynamik_theme_clone( $clone_theme_settings = '', $clone_theme_metadata = '', $clone_theme_images = '' )
{
	if( !empty( $clone_theme_settings ) )
	{
		$plugin_settings_clone = array_merge( genesis_extender_settings_defaults(), get_option( 'dynamik_gen_theme_settings' ) );
		update_option( 'genesis_extender_settings', $plugin_settings_clone );

		$custom_css_clone = array_merge( genesis_extender_custom_css_options_defaults(), get_option( 'dynamik_gen_custom_css' ) );
		update_option( 'genesis_extender_custom_css', $custom_css_clone );

		$custom_functions_clone = array_merge( genesis_extender_custom_functions_options_defaults(), get_option( 'dynamik_gen_custom_functions' ) );
		update_option( 'genesis_extender_custom_functions', $custom_functions_clone );

		$custom_js_clone = array_merge( genesis_extender_custom_js_options_defaults(), get_option( 'dynamik_gen_custom_js' ) );
		update_option( 'genesis_extender_custom_js', $custom_js_clone );

		update_option( 'genesis_extender_custom_templates', get_option( 'dynamik_gen_custom_templates' ) );
		update_option( 'genesis_extender_custom_labels', get_option( 'dynamik_gen_custom_labels' ) );
		$dynamik_custom_conditionals = get_option( 'dynamik_gen_custom_conditionals' );
		foreach( $dynamik_custom_conditionals as $key => $value )
		{
			if( substr( $value['conditional_tag'], 0, 7 ) == 'dynamik' )
			{
				$dynamik_custom_conditionals[$key]['conditional_tag'] = str_replace( substr( $value['conditional_tag'], 0, 7 ), 'extender', $value['conditional_tag'] );
			}
		}
		update_option( 'genesis_extender_custom_conditionals', $dynamik_custom_conditionals );
		update_option( 'genesis_extender_custom_widget_areas', get_option( 'dynamik_gen_custom_widget_areas' ) );
		update_option( 'genesis_extender_custom_hook_boxes', get_option( 'dynamik_gen_custom_hook_boxes' ) );
	}

	if( !empty( $clone_theme_metadata ) )
	{
		global $wpdb;

		$wpdb->update( $wpdb->postmeta, array( 'meta_key' => '_genext_labels' ), array( 'meta_key' => '_dyn_labels' ) );
	}

	if( !empty( $clone_theme_images ) )
	{
		dynamik_folders_open_permissions();

		$theme_image_folder = dynamik_get_stylesheet_location( 'path' ) . 'images';
		$theme_adthumbs_folder = $theme_image_folder . '/adminthumbnails';

		$plugin_image_folder = genesis_extender_get_stylesheet_location( 'path' ) . 'images';
		$plugin_adthumbs_folder = $plugin_image_folder . '/adminthumbnails';

		dynamik_delete_temp_files( $plugin_image_folder );
		dynamik_delete_temp_files( $plugin_adthumbs_folder );

		$handle = opendir( $theme_image_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( $theme_image_folder . '/' . $file, $plugin_image_folder . '/' . $file );
			}
		}
		closedir( $handle );
		
		$handle = opendir( $theme_adthumbs_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( $theme_adthumbs_folder . '/' . $file, $plugin_adthumbs_folder . '/' . $file );
			}
		}
		closedir( $handle );

		dynamik_folders_close_permissions();
	}
	
	genesis_extender_write_files();
	wp_redirect( admin_url( 'admin.php?page=dynamik-settings&activetab=dynamik-theme-settings-nav-import-export&notice=theme-clone-complete' ) );
	exit();
}

/**
 * Clone the Genesis Extender Plugin Settings & Images over to the Dynamik Child Theme.
 *
 * @since 1.0.2
 */
function genesis_extender_clone( $clone_plugin_settings = '', $clone_plugin_metadata = '', $clone_plugin_images = '' )
{
	if( !empty( $clone_plugin_settings ) )
	{
		$plugin_settings_clone = array_merge( dynamik_theme_settings_defaults(), get_option( 'genesis_extender_settings' ) );
		update_option( 'dynamik_gen_theme_settings', $plugin_settings_clone );

		$custom_css_clone = array_merge( dynamik_custom_css_options_defaults(), get_option( 'genesis_extender_custom_css' ) );
		update_option( 'dynamik_gen_custom_css', $custom_css_clone );

		$custom_functions_clone = array_merge( dynamik_custom_functions_options_defaults(), get_option( 'genesis_extender_custom_functions' ) );
		update_option( 'dynamik_gen_custom_functions', $custom_functions_clone );

		$custom_js_clone = array_merge( dynamik_custom_js_options_defaults(), get_option( 'genesis_extender_custom_js' ) );
		update_option( 'dynamik_gen_custom_js', $custom_js_clone );

		update_option( 'dynamik_gen_custom_templates', get_option( 'genesis_extender_custom_templates' ) );
		update_option( 'dynamik_gen_custom_labels', get_option( 'genesis_extender_custom_labels' ) );
		$genesis_extender_custom_conditionals = get_option( 'genesis_extender_custom_conditionals' );
		foreach( $genesis_extender_custom_conditionals as $key => $value )
		{
			if( substr( $value['conditional_tag'], 0, 8 ) == 'extender' )
			{
				$genesis_extender_custom_conditionals[$key]['conditional_tag'] = str_replace( substr( $value['conditional_tag'], 0, 8 ), 'dynamik', $value['conditional_tag'] );
			}
		}
		update_option( 'dynamik_gen_custom_conditionals', $genesis_extender_custom_conditionals );
		update_option( 'dynamik_gen_custom_widget_areas', get_option( 'genesis_extender_custom_widget_areas' ) );
		update_option( 'dynamik_gen_custom_hook_boxes', get_option( 'genesis_extender_custom_hook_boxes' ) );
	}

	if( !empty( $clone_plugin_metadata ) )
	{
		global $wpdb;

		$wpdb->update( $wpdb->postmeta, array( 'meta_key' => '_dyn_labels' ), array( 'meta_key' => '_genext_labels' ) );
	}

	if( !empty( $clone_plugin_images ) )
	{
		dynamik_folders_open_permissions();

		$plugin_image_folder = genesis_extender_get_stylesheet_location( 'path' ) . 'images';
		$plugin_adthumbs_folder = $plugin_image_folder . '/adminthumbnails';

		$theme_image_folder = dynamik_get_stylesheet_location( 'path' ) . 'images';
		$theme_adthumbs_folder = $theme_image_folder . '/adminthumbnails';

		dynamik_delete_temp_files( $theme_image_folder );
		dynamik_delete_temp_files( $theme_adthumbs_folder );

		$handle = opendir( $plugin_image_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( $plugin_image_folder . '/' . $file, $theme_image_folder . '/' . $file );
			}
		}
		closedir( $handle );
		
		$handle = opendir( $plugin_adthumbs_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( $plugin_adthumbs_folder . '/' . $file, $theme_adthumbs_folder . '/' . $file );
			}
		}
		closedir( $handle );

		dynamik_folders_close_permissions();
	}
	
	dynamik_write_files( $css = true, $ez = false );
	wp_redirect( admin_url( 'admin.php?page=dynamik-settings&activetab=dynamik-theme-settings-nav-import-export&notice=plugin-clone-complete' ) );
	exit();
}

add_action( 'admin_init', 'dynamik_import_export_check' );
/**
 * Check for Import/Export $_POST actions and react appropriately.
 *
 * @since 1.0
 */
function dynamik_import_export_check()
{
	if( !empty( $_POST['action'] ) && $_POST['action'] == 'dynamik_design_export' )
	{
		$export_name = $_POST['design_export_name'] != '' ? $_POST['design_export_name'] : false;
		$settings_only = isset( $_POST['settings_only'] ) ? 'yes' : 'no';
		dynamik_design_export( $export_name, $settings_only );
	}
	if( !empty( $_POST['action'] ) && $_POST['action'] == 'dynamik_design_import' )
	{
		dynamik_design_import( $_FILES['design_import_file'] );
	}
	if( !empty( $_POST['action'] ) && $_POST['action'] == 'child_export' )
	{
		$parent_at_style = isset( $_POST['parent_at_style'] ) ? 'yes' : 'no';
		$include_default_page_templates = isset( $_POST['include_default_page_templates'] ) ? 'yes' : 'no';
		$include_protected_folders = isset( $_POST['include_protected_folders'] ) ? 'yes' : 'no';
		$include_theme_settings = isset( $_POST['include_theme_settings'] ) ? 'yes' : 'no';
		$include_dynamik_design = isset( $_POST['include_dynamik_design'] ) ? 'yes' : 'no';
		$include_custom_css = isset( $_POST['include_custom_css'] ) ? 'yes' : 'no';
		$include_custom_functions = isset( $_POST['include_custom_functions'] ) ? 'yes' : 'no';
		$include_custom_js = isset( $_POST['include_custom_js'] ) ? 'yes' : 'no';
		$include_custom_templates = isset( $_POST['include_custom_templates'] ) ? 'yes' : 'no';
		$include_custom_labels = isset( $_POST['include_custom_labels'] ) ? 'yes' : 'no';
		$include_custom_widget_areas = isset( $_POST['include_custom_widget_areas'] ) ? 'yes' : 'no';
		$include_custom_hook_boxes = isset( $_POST['include_custom_hook_boxes'] ) ? 'yes' : 'no';
		child_export( $_POST['child_name'], $_POST['child_author'], $_POST['child_author_uri'], $_POST['child_version_number'], $parent_at_style, $include_default_page_templates, $include_protected_folders, $include_theme_settings, $include_dynamik_design, $include_custom_css, $include_custom_functions, $include_custom_js, $include_custom_templates, $include_custom_labels, $include_custom_widget_areas, $include_custom_hook_boxes );
	}
	if( !empty( $_POST['action'] ) && $_POST['action'] == 'dynamik_skin_copy' )
	{
		dynamik_copy_skin( dynamik_sanatize_string( $_POST['new_skin_name'], true ) );
	}
	if( !empty( $_POST['action'] ) && $_POST['action'] == 'dynamik_custom_export' )
	{
		$export_name = $_POST['dynamik_export_name'] != '' ? $_POST['dynamik_export_name'] : false;
		$theme_settings = isset( $_POST['export_settings'] ) ? $_POST['export_settings'] : '';
		$custom_css = isset( $_POST['export_css'] ) ? $_POST['export_css'] : '';
		$custom_functions = isset( $_POST['export_functions'] ) ? $_POST['export_functions'] : '';
		$custom_js = isset( $_POST['export_js'] ) ? $_POST['export_js'] : '';
		$custom_templates = isset( $_POST['export_templates'] ) ? $_POST['export_templates'] : '';
		$custom_labels = isset( $_POST['export_labels'] ) ? $_POST['export_labels'] : '';
		$conditionals = isset( $_POST['export_conditionals'] ) ? $_POST['export_conditionals'] : '';
		$widget_areas = isset( $_POST['export_widgets'] ) ? $_POST['export_widgets'] : '';
		$hook_boxes = isset( $_POST['export_hooks'] ) ? $_POST['export_hooks'] : '';

		dynamik_custom_export( $export_name, $theme_settings, $custom_css, $custom_functions, $custom_js, $custom_templates, $custom_labels, $conditionals, $widget_areas, $hook_boxes );
	}
	if( !empty( $_POST['action'] ) && $_POST['action'] == 'dynamik_custom_import' )
	{
		$theme_settings = isset( $_POST['import_settings'] ) ? $_POST['import_settings'] : '';
		$custom_css = isset( $_POST['import_css'] ) ? $_POST['import_css'] : '';
		$custom_functions = isset( $_POST['import_functions'] ) ? $_POST['import_functions'] : '';
		$custom_js = isset( $_POST['import_js'] ) ? $_POST['import_js'] : '';
		$custom_templates = isset( $_POST['import_templates'] ) ? $_POST['import_templates'] : '';
		$custom_labels = isset( $_POST['import_labels'] ) ? $_POST['import_labels'] : '';
		$conditionals = isset( $_POST['import_conditionals'] ) ? $_POST['import_conditionals'] : '';
		$widget_areas = isset( $_POST['import_widgets'] ) ? $_POST['import_widgets'] : '';
		$hook_boxes = isset( $_POST['import_hooks'] ) ? $_POST['import_hooks'] : '';
		
		dynamik_custom_import( $_FILES['custom_import_file'], $theme_settings, $custom_css, $custom_functions, $custom_js, $custom_templates, $custom_labels, $conditionals, $widget_areas, $hook_boxes );
	}
	if( defined( 'GENEXT_VERSION' ) && !empty( $_POST['action'] ) && $_POST['action'] == 'dynamik_theme_clone' )
	{
		$clone_theme_settings = isset( $_POST['clone_theme_settings'] ) ? $_POST['clone_theme_settings'] : '';
		$clone_theme_metadata = isset( $_POST['clone_theme_metadata'] ) ? $_POST['clone_theme_metadata'] : '';
		$clone_theme_images = isset( $_POST['clone_theme_images'] ) ? $_POST['clone_theme_images'] : '';
		dynamik_theme_clone( $clone_theme_settings, $clone_theme_metadata, $clone_theme_images );
	}
	if( defined( 'GENEXT_VERSION' ) && !empty( $_POST['action'] ) && $_POST['action'] == 'genesis_extender_clone' )
	{
		$clone_plugin_settings = isset( $_POST['clone_plugin_settings'] ) ? $_POST['clone_plugin_settings'] : '';
		$clone_plugin_metadata = isset( $_POST['clone_plugin_metadata'] ) ? $_POST['clone_plugin_metadata'] : '';
		$clone_plugin_images = isset( $_POST['clone_plugin_images'] ) ? $_POST['clone_plugin_images'] : '';
		genesis_extender_clone( $clone_plugin_settings, $clone_plugin_metadata, $clone_plugin_images );
	}
}

/**
 * Delete files of specified extension and in specific folders.
 *
 * NOTE: This is used to delete the temporary files created
 * when performing a Dynamik Skin export.
 *
 * @since 1.0
 */
function dynamik_delete_temp_files( $dir )
{
	$handle = opendir( $dir );
	while( false !== ( $file = readdir( $handle ) ) )
	{
		$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
		if( $ext == 'zip' || $ext == 'dat' || $ext == 'css' || $ext == 'php' || $ext == 'js' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
		{
			unlink( $dir . '/' . $file );
		}
	}
	closedir( $handle );
}

/**
 * Backup and restore protected folders specified in the
 * Dynamik Settings admin page, for auto-update protection.
 *
 * @since 1.5
 */
function dynamik_protect_folders( $mode = 'backup' )
{
	$no_protected_folders = false;

	if( dynamik_dir_check( dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders' ) )
	{
		$potentially_protected_folders = scandir( dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders' );
		if( dynamik_get_settings( 'protected_folders' ) == '' )
			$no_protected_folders = true;
	}
	else
	{
		return;
	}

	// Turn the "protected_folders" string into an array of "folders"
	$protected_folders = false == $no_protected_folders ? explode( ',', dynamik_get_settings( 'protected_folders' ) ) : array();
	if( $mode == 'backup' )
	{
		// Backup protected folders
		if( false == $no_protected_folders )
		{
			foreach( $protected_folders as $protected_folder )
			{
				if( is_dir( CHILD_DIR . '/' . $protected_folder ) )
				{
					dynamik_delete_dir( dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders/' . $protected_folder );
					dynamik_recurse_copy( CHILD_DIR . '/' . $protected_folder, dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders/' . $protected_folder );					
				}
			}
		}
		// Clean up folders that are no longer being protected
		if( false == $no_protected_folders )
		{
			foreach ( $potentially_protected_folders as $potentially_protected_folder )
			{
		        if( $potentially_protected_folder != '.' && $potentially_protected_folder != '..' && !in_array( $potentially_protected_folder, $protected_folders ) )
		            dynamik_delete_dir( dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders/' . $potentially_protected_folder );
			}			
		}
		else
		{
			dynamik_delete_dir( dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders', true );
		}
	}
	else
	{
		// Restore protected folders
		foreach( $protected_folders as $protected_folder )
		{
			dynamik_recurse_copy( dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders/' . $protected_folder, CHILD_DIR . '/' . $protected_folder );
		}		
	}
}

/**
 * Compare both the actual protected-folders directory contents with
 * the "Dynamik Protected Folders" value to create an array of actual
 * existing folders that are set to be "protected" by Dynamik.
 *
 * @since 1.6.1
 * @return an array of actual protected folders.
 */
function dynamik_actual_protected_folders()
{
	$child_dir_folders = array();
	$potentially_protected_folders = scandir( dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders' );
	foreach( $potentially_protected_folders as $potentially_protected_folder )
	{
		if( $potentially_protected_folder != '.' && $potentially_protected_folder != '..' )
			$child_dir_folders[] = $potentially_protected_folder;
	}

	// Turn the "protected_folders" string into an array of "folders"
	$protected_folders = dynamik_get_settings( 'protected_folders' ) != '' ? explode( ',', dynamik_get_settings( 'protected_folders' ) ) : array();
	// unset any "protected folders" that don't actually exist in the Dynamik protected-folders directory.
	foreach( $protected_folders as $key => $value )
	{
		if( !in_array( $value, $child_dir_folders ) )
			unset( $protected_folders[$key] );
	}

	return $protected_folders;
}

/**
 * Recursive file/folder copy function.
 *
 * @since 1.5
 */
function dynamik_recurse_copy( $src, $dst )
{
	if( !is_dir( $src ) )
		return;

    $dir = opendir( $src );

	if( !dynamik_dir_check( $dst ) )
		return;

	while( false !== ( $file = readdir( $dir ) ) )
	{ 
	    if( ( $file != '.' ) && ( $file != '..' ) )
	    { 
	        if( is_dir( $src . '/' . $file ) )
	            dynamik_recurse_copy( $src . '/' . $file, $dst . '/' . $file ); 
	        else
	            copy( $src . '/' . $file, $dst . '/' . $file ); 
	    } 
	} 
	closedir( $dir ); 
}

/**
 * Remove any files and/or folders that are not supposed to be
 * in the Dynamik /wp-content/uploads/ tmp folder. This helps
 * prevent potential Import/Export issues.
 *
 * @since 1.6.1
 */
function dynamik_tmp_folder_cleanup()
{
	$tmp_path = dynamik_get_stylesheet_location( 'path' ) . 'tmp';

	$handle = opendir( $tmp_path );
	while( false !== ( $file = readdir( $handle ) ) )
	{
		if( $file !== '.' && $file !== '..' && $file !== 'images' )
		{
			if( is_dir( $tmp_path . '/' . $file ) )
				dynamik_delete_dir( $tmp_path . '/' . $file );
			else
				unlink( $tmp_path . '/' . $file );
		}
	}
	closedir( $handle );
}

/**
 * Delete specific folders.
 *
 * NOTE: This is used to delete the temporary folders created
 * when performing a Dynamik Options or Child Theme export.
 *
 * @since 1.0
 */
function dynamik_delete_dir( $dir, $keep_root = false )
{
	if( !is_dir( $dir ) )
		return;

	$handle = opendir( $dir );
	while( false !== ( $file = readdir( $handle ) ) )
	{
		if( is_dir( $dir . '/' . $file ) )
		{
			if( $file != '.' && $file != '..' )
				dynamik_delete_dir( $dir . '/' . $file );
		}
		else
		{
			if( $file != '.' && $file != '..' )
				unlink( $dir . '/' . $file );
		}
	}
	closedir( $handle );

	if( false == $keep_root )
		rmdir( $dir );
}

/**
 * This function is not currently in use, but we'll keep it around
 * in case we need it in the future.
 *
 * @since 1.0
 */
function dynamik_copy_dir( $source, $destination )
{
	if( is_dir( $source ) )
	{
		if( !is_dir( $destination ) )
		{
			mkdir( $destination, 0755, true );
		}
		$handle = opendir( $source );
		while( false !== ( $readdirectory = readdir( $handle ) ) )
		{
			if( $readdirectory == '.' || $readdirectory == '..' )
			{
				continue;
			}
			$pathdir = $source . '/' . $readdirectory; 
			if( is_dir( $pathdir ) )
			{
				dynamik_copy_dir( $pathdir, $destination . '/' . $readdirectory );
				continue;
			}
			copy( $pathdir, $destination . '/' . $readdirectory );
		}
		closedir( $handle );
	}
	else
	{
		copy( $source, $destination );
	}
}

/**
 * Convert pre-1.3 font sizes to their appropriate px or rem values.
 *
 * @since 1.3
 */
function dynamik_update_design_px_em_conversion( $design_options )
{
	// Create font values array
	$font_values = array();

	// Account for a few necessary DWB 1.3 font values
	$design_options['body_px_em'] = 'px';
	$design_options['comment_reply_text_font_size'] = $design_options['comment_body_font_size'];
	$design_options['comment_reply_text_link_color'] = $design_options['comment_link_color'];
	$design_options['comment_reply_text_link_hover_color'] = $design_options['comment_link_hover_color'];
	$design_options['comment_reply_text_link_underline'] = $design_options['comment_link_underline'];
	$design_options['comment_reply_text_font_css'] = $design_options['comment_body_font_css'];
	$design_options['comment_reply_text_px_em'] = $design_options['comment_body_px_em'];
	$design_options['comment_reply_text_font_u'] = $design_options['comment_body_font_u'];
	$design_options['comment_reply_text_link_u'] = $design_options['comment_link_u'];
	$design_options['comment_form_allowed_tags_font_size'] = $design_options['comment_body_font_size'];
	$design_options['comment_form_allowed_tags_px_em'] = $design_options['comment_body_px_em'];

	// Determine the overall direction of font unit implementation
	// based on the content_p_px_em unit value of the imported options
	if( $design_options['content_p_px_em'] == 'em' )
	{
		$font_values['universal_px_em'] = 'em';
		$font_unit = 'rem';
	}
	else
	{
		$font_values['universal_px_em'] = 'px';
		$font_unit = 'px';
	}

	// Cycle through the $design_options array
	foreach( $design_options as $key => $value )
	{
		// Only do stuff with options that have a px or em value
		if( $value == 'px' || $value == 'em' )
		{
			// Create a Font Size Key based on the current px or em value being manipulated
			// First do a check to see if this is an H tag key which has
			// a different font-size naming convention than px_em key
			if( is_numeric( substr( $key, 1, 1 ) ) )
				$font_size_key = 'content_heading_' . substr( $key, 0, -5 ) . 'font_size';
			else
				$font_size_key = substr( $key, 0, -5 ) . 'font_size';

			// Determine how to convert the font size based on the
			// content_p_px_em unit value of the imported options
			if( $font_unit == 'rem' )
			{
				if( $value == 'px' )
				{
					// Create a new value for the current font size by converting it from px to rem
					$new_value = strval( $design_options[$font_size_key] / 10 );					
				}
				else
				{
					// Create a new value for the current font size, giving it a rem value
					// by first converting it from em to px, and then to rem
					$new_value = strval( round( $design_options[$font_size_key] * $design_options['body_font_size'] ) / 10 );
				}
			}
			else
			{
				if( $value == 'px' )
				{
					// Retain the current px value of the font size
					$new_value = strval( $design_options[$font_size_key] );					
				}
				else
				{
					// Create a new value for the current font size by converting it from em to px
					$new_value = strval( round( $design_options[$font_size_key] * $design_options['body_font_size'] ) );
				}
			}

			// Add to the $font_values array based on the $new_value created
			$font_values[$font_size_key] = $new_value;
		}
	}

	// Merge the $font_values array into the current $design_options
	$dynamik_design_settings = wp_parse_args( $font_values, $design_options );

	// Update the Design Options with the merged array
	update_option( 'dynamik_gen_design_options', $dynamik_design_settings );
}

/**
 * Turn the deprecated Google Fonts list array into a list of
 * bracketed Google Fonts for use in the "Add Google Fonts" box.
 *
 * @since 1.5
 * @return a list of bracketed Google Fonts.
 */
function dynamik_deprecated_google_fonts_list()
{
	$dynamik_deprecated_google_font_array = array(
		"Aclonica" => array(
			"value"	=> "'Aclonica', sans-serif",
			"url_string" => "Aclonica|"
		),
		"Allan" => array(
			"value"	=> "'Allan', sans-serif",
			"url_string" => "Allan:bold|"
		),
		"Allerta" => array(
			"value"	=> "'Allerta', sans-serif",
			"url_string" => "Allerta|"
		),
		"Allerta Stencil" => array(
			"value"	=> "'Allerta Stencil', sans-serif",
			"url_string" => "Allerta+Stencil|"
		),
		"Amaranth" => array(
			"value"	=> "'Amaranth', sans-serif",
			"url_string" => "Amaranth:regular,regularitalic,bold,bolditalic|"
		),
		"Annie Use Your Telescope" => array(
			"value"	=> "'Annie Use Your Telescope', serif",
			"url_string" => "Annie+Use+Your+Telescope|"
		),
		"Anonymous Pro" => array(
			"value"	=> "'Anonymous Pro', sans-serif",
			"url_string" => "Anonymous+Pro:regular,italic,bold,bolditalic|"
		),
		"Anton" => array(
			"value"	=> "'Anton', sans-serif",
			"url_string" => "Anton|"
		),
		"Architects Daughter" => array(
			"value"	=> "'Architects Daughter', sans-serif",
			"url_string" => "Architects+Daughter|"
		),
		"Arimo" => array(
			"value"	=> "'Arimo', sans-serif",
			"url_string" => "Arimo:regular,italic,bold,bolditalic|"
		),
		"Arvo" => array(
			"value"	=> "'Arvo', sans-serif",
			"url_string" => "Arvo:regular,italic,bold,bolditalic|"
		),
		"Astloch" => array(
			"value"	=> "'Astloch', serif",
			"url_string" => "Astloch:regular,bold|"
		),
		"Bangers" => array(
			"value"	=> "'Bangers', serif",
			"url_string" => "Bangers|"
		),
		"Bentham" => array(
			"value"	=> "'Bentham', serif",
			"url_string" => "Bentham|"
		),
		"Bevan" => array(
			"value"	=> "'Bevan', sans-serif",
			"url_string" => "Bevan|"
		),
		"Bigshot One" => array(
			"value"	=> "'Bigshot One', serif",
			"url_string" => "Bigshot+One|"
		),
		"Buda" => array(
			"value"	=> "'Buda', serif",
			"url_string" => "Buda:light|"
		),
		"Cabin" => array(
			"value"	=> "'Cabin', sans-serif",
			"url_string" => "Cabin:regular,500,600,bold|"
		),
		"Cabin Sketch" => array(
			"value"	=> "'Cabin Sketch', sans-serif",
			"url_string" => "Cabin+Sketch:bold|"
		),
		"Calligraffiti" => array(
			"value"	=> "'Calligraffiti', cursive, serif",
			"url_string" => "Calligraffiti|"
		),
		"Candal" => array(
			"value"	=> "'Candal', sans-serif",
			"url_string" => "Candal|"
		),
		"Cantarell" => array(
			"value"	=> "'Cantarell', sans-serif",
			"url_string" => "Cantarell:regular,italic,bold,bolditalic|"
		),
		"Cardo" => array(
			"value"	=> "'Cardo', sans-serif",
			"url_string" => "Cardo|"
		),
		"Carter One" => array(
			"value"	=> "'Carter One', serif",
			"url_string" => "Carter+One|"
		),
		"Cherry Cream Soda" => array(
			"value"	=> "'Cherry Cream Soda', serif",
			"url_string" => "Cherry+Cream+Soda|"
		),
		"Chewy" => array(
			"value"	=> "'Chewy', curisve, serif",
			"url_string" => "Chewy|"
		),
		"Coda" => array(
			"value"	=> "'Coda', sans-serif",
			"url_string" => "Coda:800|"
		),
		"Coda Caption" => array(
			"value"	=> "'Coda Caption', sans-serif",
			"url_string" => "Coda+Caption:800|"
		),
		"Comong Soon" => array(
			"value"	=> "'Coming Soon', cursive, serif",
			"url_string" => "Coming+Soon|"
		),
		"Copse" => array(
			"value"	=> "'Copse', serif",
			"url_string" => "Copse|"
		),
		"Corben" => array(
			"value"	=> "'Corben', serif",
			"url_string" => "Corben:b|"
		),
		"Cousine" => array(
			"value"	=> "'Cousine', sans-serif",
			"url_string" => "Cousine:regular,italic,bold,bolditalic|"
		),
		"Covered By Your Grace" => array(
			"value"	=> "'Covered By Your Grace', cursive, serif",
			"url_string" => "Covered+By+Your+Grace|"
		),
		"Crafty Girls" => array(
			"value"	=> "'Crafty Girls', cursive, serif",
			"url_string" => "Crafty+Girls|"
		),
		"Crimson Text" => array(
			"value"	=> "'Crimson Text', serif",
			"url_string" => "Crimson+Text:regular,regularitalic,600,600italic,bold,bolditalic|"
		),
		"Crushed" => array(
			"value"	=> "'Crushed', sans-serif",
			"url_string" => "Crushed|"
		),
		"Cuprum" => array(
			"value"	=> "'Cuprum', sans-serif",
			"url_string" => "Cuprum|"
		),
		"Damion" => array(
			"value"	=> "'Damion', serif",
			"url_string" => "Damion|"
		),
		"Dancing Script" => array(
			"value"	=> "'Dancing Script', cursive, serif",
			"url_string" => "Dancing+Script:400,700&v2|"
		),
		"Dawning of a New Day" => array(
			"value"	=> "'Dawning of a New Day', serif",
			"url_string" => "Dawning+of+a+New+Day|"
		),
		"Didact Gothic" => array(
			"value"	=> "'Didact Gothic', sans-serif",
			"url_string" => "Didact+Gothic|"
		),
		"Droid Sans" => array(
			"value"	=> "'Droid Sans', sans-serif",
			"url_string" => "Droid+Sans:regular,bold|"
		),
		"Droid Sans Mono" => array(
			"value"	=> "'Droid Sans Mono', sans-serif",
			"url_string" => "Droid+Sans+Mono|"
		),
		"Droid Serif" => array(
			"value"	=> "'Droid Serif', serif",
			"url_string" => "Droid+Serif:regular,italic,bold,bolditalic|"
		),
		"EB Garamond" => array(
			"value"	=> "'EB Garamond', serif",
			"url_string" => "EB+Garamond|"
		),
		"Expletus Sans" => array(
			"value"	=> "'Expletus Sans', sans-serif",
			"url_string" => "Expletus+Sans:regular,regularitalic,500,500italic,600,600italic,bold,bolditalic|"
		),
		"Fontdiner Swanky" => array(
			"value"	=> "'Fontdiner Swanky', cursive, serif",
			"url_string" => "Fontdiner+Swanky|"
		),
		"Francois One" => array(
			"value"	=> "'Francois One', sans-serif",
			"url_string" => "Francois+One|"
		),
		"Geo" => array(
			"value"	=> "'Geo', sans-serif",
			"url_string" => "Geo|"
		),
		"Goudy Bookletter 1911" => array(
			"value"	=> "'Goudy Bookletter 1911', serif",
			"url_string" => "Goudy+Bookletter+1911|"
		),
		"Gruppo" => array(
			"value"	=> "'Gruppo', sans-serif",
			"url_string" => "Gruppo|"
		),
		"Holtwood One SC" => array(
			"value"	=> "'Holtwood One SC', sans-serif",
			"url_string" => "Holtwood+One+SC|"
		),
		"Homemade Apple" => array(
			"value"	=> "'Homemade Apple', cursive, serif",
			"url_string" => "Homemade+Apple|"
		),
		"IM Fell DW Pica" => array(
			"value"	=> "'IM Fell DW Pica', serif",
			"url_string" => "IM+Fell+DW+Pica:regular,italic|"
		),
		"IM Fell DW Pica SC" => array(
			"value"	=> "'IM Fell DW Pica SC', serif",
			"url_string" => "IM+Fell+DW+Pica+SC|"
		),
		"IM Fell Double Pica" => array(
			"value"	=> "'IM Fell Double Pica', serif",
			"url_string" => "IM+Fell+Double+Pica:regular,italic|"
		),
		"IM Fell Double Pica SC" => array(
			"value"	=> "'IM Fell Double Pica SC', serif",
			"url_string" => "IM+Fell+Double+Pica+SC|"
		),
		"IM Fell English" => array(
			"value"	=> "'IM Fell English', serif",
			"url_string" => "IM+Fell+English:regular,italic|"
		),
		"IM Fell English SC" => array(
			"value"	=> "'IM Fell English SC', serif",
			"url_string" => "IM+Fell+English+SC|"
		),
		"IM Fell French Canon" => array(
			"value"	=> "'IM Fell French Canon', serif",
			"url_string" => "IM+Fell+French+Canon:regular,italic|"
		),
		"IM Fell French Canon SC" => array(
			"value"	=> "'IM Fell French Canon SC', serif",
			"url_string" => "IM+Fell+French+Canon+SC|"
		),
		"IM Fell Great Primer" => array(
			"value"	=> "'IM Fell Great Primer', serif",
			"url_string" => "IM+Fell+Great+Primer:regular,italic"
		),
		"IM Fell Great Primer SC" => array(
			"value"	=> "'IM Fell Great Primer SC', serif",
			"url_string" => "IM+Fell+Great+Primer+SC"
		),
		"Inconsolata" => array(
			"value"	=> "'Inconsolata', sans-serif",
			"url_string" => "Inconsolata|"
		),
		"Indie Flower" => array(
			"value"	=> "'Indie Flower', cursive, sans-serif",
			"url_string" => "Indie+Flower|"
		),
		"Irish Grover" => array(
			"value"	=> "'Irish Grover', cursive, serif",
			"url_string" => "Irish+Grover|"
		),
		"Josefin Sans" => array(
			"value"	=> "'Josefin Sans', sans-serif",
			"url_string" => "Josefin+Sans:100,100italic,light,lightitalic,regular,regularitalic,600,600italic,bold,bolditalic|"
		),
		"Josefin Slab" => array(
			"value" => "'Josefin Slab', sans-serif",
			"url_string" => "Josefin+Slab:100,100italic,light,lightitalic,regular,regularitalic,600,600italic,bold,bolditalic|"
		),
		"Judson" => array(
			"value" => "'Judson', serif",
			"url_string" => "Judson:regular,regularitalic,bold|"
		),
		"Just Another Hand" => array(
			"value" => "'Just Another Hand', cursive, serif",
			"url_string" => "Just+Another+Hand|"
		),
		"Just Me Again Down Here" => array(
			"value" => "'Just Me Again Down Here', cursive, serif",
			"url_string" => "Just+Me+Again+Down+Here|"
		),
		"Kenia" => array(
			"value"	=> "'Kenia', sans-serif",
			"url_string" => "Kenia|"
		),
		"Kranky" => array(
			"value"	=> "'Kranky', cursive, serif",
			"url_string" => "Kranky|"
		),
		"Kreon" => array(
			"value"	=> "'Kreon', serif",
			"url_string" => "Kreon:light,regular,bold|"
		),
		"Kristi" => array(
			"value"	=> "'Kristi', cursive, serif",
			"url_string" => "Kristi|"
		),
		"Lato" => array(
			"value"	=> "'Lato', sans-serif",
			"url_string" => "Lato:100,100italic,light,lightitalic,regular,regularitalic,bold,bolditalic,900,900italic|"
		),
		"League Script" => array(
			"value"	=> "'League Script', cursive, serif",
			"url_string" => "League+Script|"
		),
		"Lekton" => array(
			"value"	=> "'Lekton', sans-serif",
			"url_string" => "Lekton:regular,italic,bold|"
		),
		"Lobster" => array(
			"value"	=> "'Lobster', cursive, serif",
			"url_string" => "Lobster|"
		),
		"Luckiest Guy" => array(
			"value"	=> "'Luckiest Guy', cursive, serif",
			"url_string" => "Luckiest+Guy|"
		),
		"Maiden Orange" => array(
			"value"	=> "'Maiden Orange', serif",
			"url_string" => "Maiden+Orange|"
		),
		"Mako" => array(
			"value"	=> "'Mako', sans-serif",
			"url_string" => "Mako|"
		),
		"Meddon" => array(
			"value"	=> "'Meddon', cursive, serif",
			"url_string" => "Meddon|"
		),
		"MedievalSharp" => array(
			"value"	=> "'MedievalSharp', cursive, serif",
			"url_string" => "MedievalSharp|"
		),
		"Megrim" => array(
			"value"	=> "'Megrim', serif",
			"url_string" => "Megrim|"
		),
		"Merriweather" => array(
			"value"	=> "'Merriweather', serif",
			"url_string" => "Merriweather:light,regular,bold,900|"
		),
		"Molengo" => array(
			"value"	=> "'Molengo', sans-serif",
			"url_string" => "Molengo|"
		),
		"Monofett" => array(
			"value"	=> "'Monofett', sans-serif",
			"url_string" => "Monofett|"
		),
		"Mountains of Christmas" => array(
			"value"	=> "'Mountains of Christmas', cursive, sans-serif",
			"url_string" => "Mountains+of+Christmas|"
		),
		"Neucha" => array(
			"value"	=> "'Neucha', sans-serif",
			"url_string" => "Neucha|"
		),
		"Neuton" => array(
			"value"	=> "'Neuton', serif",
			"url_string" => "Neuton:regular,italic|"
		),
		"News Cycle" => array(
			"value"	=> "'News Cycle', sans-serif",
			"url_string" => "News+Cycle|"
		),
		"Nova Script" => array(
			"value"	=> "'Nova Script', serif",
			"url_string" => "Nova+Script|"
		),
		"Nova Oval" => array(
			"value"	=> "'Nova Oval', serif",
			"url_string" => "Nova+Oval|"
		),
		"Nova Round" => array(
			"value"	=> "'Nova Round', serif",
			"url_string" => "Nova+Round|"
		),
		"Nova Slim" => array(
			"value"	=> "'Nova Slim', serif",
			"url_string" => "Nova+Slim|"
		),
		"Nova Flat" => array(
			"value"	=> "'Nova Flat', serif",
			"url_string" => "Nova+Flat|"
		),
		"Nova Cut" => array(
			"value"	=> "'Nova Cut', serif",
			"url_string" => "Nova+Cut|"
		),
		"Nova Square" => array(
			"value"	=> "'Nova Square', serif",
			"url_string" => "Nova+Square|"
		),
		"Nova Mono" => array(
			"value"	=> "'Nova Mono', serif",
			"url_string" => "Nova+Mono|"
		),
		"Nobile" => array(
			"value"	=> "'Nobile', sans-serif",
			"url_string" => "Nobile:regular,italic,bold,bolditalic|"
		),
		"OFL Sorts Mill Goudy TT" => array(
			"value"	=> "'OFL Sorts Mill Goudy TT', serif",
			"url_string" => "OFL+Sorts+Mill+Goudy+TT:regular,italic|"
		),
		"Old Standard TT" => array(
			"value"	=> "'Old Standard TT', serif",
			"url_string" => "Old+Standard+TT:regular,italic,bold|"
		),
		"Open Sans Condensed" => array(
			"value"	=> "'Open Sans Condensed', sans-serif",
			"url_string" => "Open+Sans+Condensed:light,lightitalic|"
		),
		"Open Sans" => array(
			"value"	=> "'Open Sans', sans-serif",
			"url_string" => "Open+Sans:light,lightitalic,regular,regularitalic,600,600italic,bold,bolditalic,800,800italic|"
		),
		"Orbitron" => array(
			"value"	=> "'Orbitron', sans-serif",
			"url_string" => "Orbitron:regular,500,bold,900|"
		),
		"Oswald" => array(
			"value"	=> "'Oswald', sans-serif",
			"url_string" => "Oswald|"
		),
		"Over the Rainbow" => array(
			"value"	=> "'Over the Rainbow', serif",
			"url_string" => "Over+the+Rainbow|"
		),
		"Pacifico" => array(
			"value"	=> "'Pacifico', cursive, serif",
			"url_string" => "Pacifico|"
		),
		"Paytone One" => array(
			"value"	=> "'Paytone One', sans-serif",
			"url_string" => "Paytone+One|"
		),
		"Permanent Marker" => array(
			"value"	=> "'Permanent Marker', cursive, serif",
			"url_string" => "Permanent+Marker|"
		),
		"Philosopher" => array(
			"value"	=> "'Philosopher', serif",
			"url_string" => "Philosopher|"
		),
		"Play" => array(
			"value"	=> "'Play', sans-serif",
			"url_string" => "Play:regular,bold|"
		),
		"PT Sans" => array(
			"value"	=> "'PT Sans', sans-serif",
			"url_string" => "PT+Sans:regular,italic,bold,bolditalic|"
		),
		"PT Sans Caption" => array(
			"value"	=> "'PT Sans Caption', sans-serif",
			"url_string" => "PT+Sans+Caption:regular,bold|"
		),
		"PT Sans Narrow" => array(
			"value"	=> "'PT Sans Narrow', sans-serif",
			"url_string" => "PT+Sans+Narrow:regular,bold|"
		),
		"PT Serif" => array(
			"value"	=> "'PT Serif', serif",
			"url_string" => "PT+Serif:regular,italic,bold,bolditalic|"
		),
		"PT Serif Caption" => array(
			"value"	=> "'PT Serif Caption', serif",
			"url_string" => "PT+Serif+Caption:regular,italic|"
		),
		"Puritan" => array(
			"value"	=> "'Puritan', sans-serif",
			"url_string" => "Puritan:regular,italic,bold,bolditalic|"
		),
		"Quattrocento" => array(
			"value"	=> "'Quattrocento', serif",
			"url_string" => "Quattrocento|"
		),
		"Quattrocento Sans" => array(
			"value"	=> "'Quattrocento Sans', sans-serif",
			"url_string" => "Quattrocento+Sans|"
		),
		"Radley" => array(
			"value"	=> "'Radley', serif",
			"url_string" => "Radley|"
		),
		"Raleway" => array(
			"value"	=> "'Raleway', sans-serif",
			"url_string" => "Raleway:100|"
		),
		"Reenie Beanie" => array(
			"value"	=> "'Reenie Beanie', cursive, serif",
			"url_string" => "Reenie+Beanie|"
		),
		"Rock Salt" => array(
			"value"	=> "'Rock Salt', cursive, serif",
			"url_string" => "Rock+Salt|"
		),
		"Rokkitt" => array(
			"value"	=> "'Rokkitt', serif",
			"url_string" => "Rokkitt|"
		),
		"Schoolbell" => array(
			"value"	=> "'Schoolbell', cursive, serif",
			"url_string" => "Schoolbell|"
		),
		"Shanti" => array(
			"value"	=> "'Shanti', sans-serif",
			"url_string" => "Shanti|"
		),
		"Sigmar One" => array(
			"value"	=> "'Sigmar One', sans-serif",
			"url_string" => "Sigmar+One|"
		),
		"Six Caps" => array(
			"value"	=> "'Six Caps', sans-serif",
			"url_string" => "Six+Caps|"
		),
		"Slackey" => array(
			"value"	=> "'Slackey', cursive, serif",
			"url_string" => "Slackey|"
		),
		"Smythe" => array(
			"value"	=> "'Smythe', serif",
			"url_string" => "Smythe|"
		),
		"Sniglet" => array(
			"value"	=> "'Sniglet', cursive, serif",
			"url_string" => "Sniglet:800|"
		),
		"Special Elite" => array(
			"value"	=> "'Special Elite', serif",
			"url_string" => "Special+Elite|"
		),
		"Sue Ellen Francisco" => array(
			"value"	=> "'Sue Ellen Francisco', serif",
			"url_string" => "Sue+Ellen+Francisco|"
		),
		"Sunshiney" => array(
			"value"	=> "'Sunshiney', cursive, serif",
			"url_string" => "Sunshiney|"
		),
		"Swanky and Moo Moo" => array(
			"value"	=> "'Swanky and Moo Moo', serif",
			"url_string" => "Swanky+and+Moo+Moo|"
		),
		"Syncopate" => array(
			"value"	=> "'Syncopate', sans-serif",
			"url_string" => "Syncopate:regular,bold|"
		),
		"Tangerine" => array(
			"value"	=> "'Tangerine', cursive, serif",
			"url_string" => "Tangerine:regular,bold|"
		),
		"Terminal Dosis Light" => array(
			"value"	=> "'Terminal Dosis Light', sans-serif",
			"url_string" => "Terminal+Dosis+Light|"
		),
		"The Girl Next Door" => array(
			"value"	=> "'The Girl Next Door', serif",
			"url_string" => "The+Girl+Next+Door|"
		),
		"Tinos" => array(
			"value"	=> "'Tinos', serif",
			"url_string" => "Tinos:regular,italic,bold,bolditalic|"
		),
		"Ubuntu" => array(
			"value"	=> "'Ubuntu', sans-serif",
			"url_string" => "Ubuntu:light,lightitalic,regular,italic,500,500italic,bold,bolditalic|"
		),
		"Ultra" => array(
			"value"	=> "'Ultra', serif",
			"url_string" => "Ultra|"
		),
		"UnifrakturCook" => array(
			"value"	=> "'UnifrakturCook', serif",
			"url_string" => "UnifrakturCook:b|"
		),
		"UnifrakturMaguntia" => array(
			"value"	=> "'UnifrakturMaguntia', serif",
			"url_string" => "UnifrakturMaguntia|"
		),
		"Unkempt" => array(
			"value"	=> "'Unkempt', cursive, serif",
			"url_string" => "Unkempt|"
		),
		"VT323" => array(
			"value"	=> "'VT323', sans-serif",
			"url_string" => "VT323|"
		),
		"Vibur" => array(
			"value"	=> "'Vibur', cursive, serif",
			"url_string" => "Vibur|"
		),
		"Volkorn" => array(
			"value"	=> "'Vollkorn', serif",
			"url_string" => "Vollkorn:regular,italic,bold,bolditalic|"
		),
		"Waiting for the Sunrise" => array(
			"value"	=> "'Waiting for the Sunrise', serif",
			"url_string" => "Waiting+for+the+Sunrise|"
		),
		"Wallpoet" => array(
			"value"	=> "'Wallpoet', sans-serif",
			"url_string" => "Wallpoet|"
		),
		"Walter Turncoat" => array(
			"value"	=> "'Walter Turncoat', cursive, serif",
			"url_string" => "Walter+Turncoat|"
		),
		"Yanone Kaffeesatz" => array(
			"value"	=> "'Yanone Kaffeesatz', sans-serif",
			"url_string" => "Yanone+Kaffeesatz:extralight,light,regular,bold|"
		),
	);

	$bracketed_google_fonts = '';

	foreach( $dynamik_deprecated_google_font_array as $key => $value )
	{
		foreach( $value as $key2 => $value2 )
		{
			$bracketed_google_font = '[' . $key . '|' . str_replace( '|', '', $value['url_string'] ) . '|' . $value['value'] . ']' . "\n";
		}
		$bracketed_google_fonts .= $bracketed_google_font;
	}

	return $bracketed_google_fonts;
}
