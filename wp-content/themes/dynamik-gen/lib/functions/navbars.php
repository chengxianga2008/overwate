<?php

/**
 * Build the various Dynamik Navbar functions.
 *
 * @package Dynamik
 */
 
/**
 * Determine whether or not to register the additional Responsive Dropdown Menus.
 */
if( dynamik_get_settings( 'responsive_enabled' ) &&
	( dynamik_get_responsive( 'navbar_media_query_default' ) == 'tablet_dropdown' ||
	dynamik_get_responsive( 'navbar_media_query_default' ) == 'mobile_dropdown' ) )
{
	add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'dynamik' ), 'secondary' => __( 'Secondary Navigation Menu', 'dynamik' ), 'primary_dropdown' => __( 'Responsive Dropdown 1', 'dynamik' ), 'secondary_dropdown' => __( 'Responsive Dropdown 2', 'dynamik' ) ) );
}

/**
 * Determine placement of Nav.
 */
if( dynamik_get_design_alt( 'nav1_location' ) == 'Above Header' )
{
	add_action( 'genesis_before_header', 'dynamik_mobile_nav_1' );
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	add_action( 'genesis_before_header', 'genesis_do_nav' );
	add_action( 'genesis_before_header', 'dynamik_dropdown_nav_1' );
}
else
{
	add_action( 'genesis_after_header', 'dynamik_mobile_nav_1', 9 );
	add_action( 'genesis_after_header', 'dynamik_dropdown_nav_1' );
}

/**
 * Determine placement of Subnav.
 */
if( dynamik_get_design_alt( 'nav2_location' ) == 'Above Header' )
{
	add_action( 'genesis_before_header', 'dynamik_mobile_nav_2' );
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	add_action( 'genesis_before_header', 'genesis_do_subnav' );
	add_action( 'genesis_before_header', 'dynamik_dropdown_nav_2' );
}
else
{
	add_action( 'genesis_after_header', 'dynamik_mobile_nav_2' );
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	add_action( 'genesis_after_header', 'genesis_do_subnav' );
	add_action( 'genesis_after_header', 'dynamik_dropdown_nav_2' );
}

/**
 * Build Nav Mobile Menu HTML.
 *
 * @since 1.2
 */
function dynamik_mobile_nav_1()
{
	if( !has_nav_menu( 'primary' ) ||
		!dynamik_get_settings( 'responsive_enabled' ) ||
		( dynamik_get_responsive( 'navbar_media_query_default' ) != 'vertical_toggle_tablet' &&
		dynamik_get_responsive( 'navbar_media_query_default' ) != 'vertical_toggle' ) )
		return;
?>
	<div class="responsive-primary-menu-container">
		<div class="responsive-menu-icon">
			<span class="responsive-icon-bar"></span>
			<span class="responsive-icon-bar"></span>
			<span class="responsive-icon-bar"></span>
		</div>
		<h3 class="mobile-primary-toggle"><?php echo apply_filters( 'dropdown_menu_1_text', dynamik_get_responsive( 'dropdown_menu_1_text' ) ); ?></h3>
	</div>
<?php
}

/**
 * Build Subnav Mobile Menu HTML.
 *
 * @since 1.2
 */
function dynamik_mobile_nav_2()
{
	if( !has_nav_menu( 'secondary' ) ||
		!dynamik_get_settings( 'responsive_enabled' ) ||
		( dynamik_get_responsive( 'navbar_media_query_default' ) != 'vertical_toggle_tablet' &&
		dynamik_get_responsive( 'navbar_media_query_default' ) != 'vertical_toggle' ) )
		return;
?>
	<div class="responsive-secondary-menu-container">
		<div class="responsive-menu-icon">
			<span class="responsive-icon-bar"></span>
			<span class="responsive-icon-bar"></span>
			<span class="responsive-icon-bar"></span>
		</div>
		<h3 class="mobile-secondary-toggle"><?php echo apply_filters( 'dropdown_menu_2_text', dynamik_get_responsive( 'dropdown_menu_2_text' ) ); ?></h3>
	</div>
<?php
}
 
/**
 * Build Nav Dropdown HTML.
 *
 * @since 1.0
 */
function dynamik_dropdown_nav_1()
{
	if( !has_nav_menu( 'primary_dropdown' ) ||
		!dynamik_get_settings( 'responsive_enabled' ) ||
		( dynamik_get_responsive( 'navbar_media_query_default' ) != 'tablet_dropdown' &&
		dynamik_get_responsive( 'navbar_media_query_default' ) != 'mobile_dropdown' ) )
		return;
?>
	<div id="dropdown-nav-wrap">
		<!-- dropdown nav for responsive design -->
		<nav id="dropdown-nav" role="navigation">
			<?php dynamik_dropdown_menu_1( array( 'theme_location' => 'primary_dropdown', 'dropdown_title' => apply_filters( 'dropdown_menu_1_text', dynamik_get_responsive( 'dropdown_menu_1_text' ) ) ) ); ?>
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
function dynamik_dropdown_nav_2()
{
	if( !has_nav_menu( 'secondary_dropdown' ) ||
		!dynamik_get_settings( 'responsive_enabled' ) ||
		( dynamik_get_responsive( 'navbar_media_query_default' ) != 'tablet_dropdown' &&
		dynamik_get_responsive( 'navbar_media_query_default' ) != 'mobile_dropdown' ) )
		return;
?>
	<div id="dropdown-subnav-wrap">	
		<!-- dropdown nav for responsive design -->
		<nav id="dropdown-subnav" role="navigation">
			<?php dynamik_dropdown_menu_2( array( 'theme_location' => 'secondary_dropdown', 'dropdown_title' => apply_filters( 'dropdown_menu_2_text', dynamik_get_responsive( 'dropdown_menu_2_text' ) ) ) ); ?>
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
add_filter( 'wp_nav_menu_items', 'dropdown_add_blank_item', 10, 2 );
function dropdown_add_blank_item( $items, $args ) {
	if ( isset( $args->walker ) && is_object( $args->walker ) && method_exists( $args->walker, 'is_dropdown' ) ) {
		if ( ( ! isset( $args->menu ) || empty( $args->menu ) ) && isset( $args->theme_location ) ) {
			$theme_locations = get_nav_menu_locations();
			$args->menu = wp_get_nav_menu_object( $theme_locations[ $args->theme_location ] );
		}
		$title = isset( $args->dropdown_title ) ? wptexturize( $args->dropdown_title ) : '&mdash; ' . $args->menu->name . ' &mdash;';
		if ( ! empty( $title ) )
			$items = '<option value="" class="blank">' . apply_filters( 'dropdown_blank_item_text', $title, $args ) . '</option>' . $items;
	}
	return $items;
}

/**
 * Remove empty options created in the sub levels output
 */
add_filter( 'wp_nav_menu_items', 'dropdown_remove_empty_items', 10, 2 );
function dropdown_remove_empty_items( $items, $args ) {
	if ( isset( $args->walker ) && is_object( $args->walker ) && method_exists( $args->walker, 'is_dropdown' ) )
		$items = str_replace( "<option></option>", "", $items );
	return $items;
}

/**
 * Overrides the walker argument and container argument then calls wp_nav_menu
 */
function dynamik_dropdown_menu_1( $args ) {
	// if non array supplied use as theme location
	if ( ! is_array( $args ) )
		$args = array( 'menu' => $args );

	// enforce these arguments so it actually works
	$args[ 'walker' ] = new Dynamik_DropDown_Nav_Menu();
	$args[ 'items_wrap' ] = '<select id="%1$s" class="%2$s mobile-dropdown-menu nav-chosen-select">%3$s</select>';

	// custom args for controlling indentation of sub menu items
	$args[ 'indent_string' ] = isset( $args[ 'indent_string' ] ) ? $args[ 'indent_string' ] : '&ndash;&nbsp;';
	$args[ 'indent_after' ] =  isset( $args[ 'indent_after' ] ) ? $args[ 'indent_after' ] : '';

	return wp_nav_menu( $args );
}

/**
 * Overrides the walker argument and container argument then calls wp_nav_menu
 */
function dynamik_dropdown_menu_2( $args ) {
	// if non array supplied use as theme location
	if ( ! is_array( $args ) )
		$args = array( 'menu' => $args );

	// enforce these arguments so it actually works
	$args[ 'walker' ] = new Dynamik_DropDown_Nav_Menu();
	$args[ 'items_wrap' ] = '<select id="%1$s" class="%2$s mobile-dropdown-menu subnav-chosen-select">%3$s</select>';

	// custom args for controlling indentation of sub menu items
	$args[ 'indent_string' ] = isset( $args[ 'indent_string' ] ) ? $args[ 'indent_string' ] : '&ndash;&nbsp;';
	$args[ 'indent_after' ] =  isset( $args[ 'indent_after' ] ) ? $args[ 'indent_after' ] : '';

	return wp_nav_menu( $args );
}

class Dynamik_DropDown_Nav_Menu extends Walker_Nav_Menu {

	// easy way to check it's this walker we're using to mod the output
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
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'menu-item-depth-' . $depth;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_unique( array_filter( $classes ) ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$selected = '';

		// select current item
		if ( apply_filters( 'dropdown_menus_select_current', true ) )
			$selected = in_array( 'current-menu-item', $classes ) ? ' selected="selected"' : '';

		$output .= $indent . '<option' . $class_names .' value="'. $item->url .'"'. $selected .'>';

		// push sub-menu items in as we can't nest optgroups
		$indent_string = str_repeat( apply_filters( 'dropdown_menus_indent_string', $args->indent_string, $item, $depth, $args ), ( $depth ) ? $depth : 0 );
		$indent_string .= !empty( $indent_string ) ? apply_filters( 'dropdown_menus_indent_after', $args->indent_after, $item, $depth, $args ) : '';

		$item_output = $args->before . $indent_string;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_dropdown_start_el', $item_output, $item, $depth, $args );
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
		$output .= apply_filters( 'walker_nav_menu_dropdown_end_el', "</option>\n", $item, $depth);
	}
}

add_filter( 'dropdown_menus_select_current', create_function( '$bool', 'return false;' ) );

/**
 * END WordPress dropdown Plugin code.
 */
