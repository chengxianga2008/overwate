<?php
/**
 * Build and hook in the Dynamik admin menus.
 *
 * @package Dynamik
 */

add_action( 'genesis_admin_menu', 'dynamik_add_admin_submenus', 11 );
/**
 * Add the Dynamik admin sub menus under the Genesis admin items.
 *
 * @since 1.0
 */
function dynamik_add_admin_submenus()
{
	add_action( 'admin_menu', 'dynamik_build_admin_submenus' );
}
/**
 * Build the Dynamik admin sub menus.
 *
 * @since 1.0
 */
function dynamik_build_admin_submenus()
{
	$user = wp_get_current_user();
	if( !get_the_author_meta( 'disable_dynamik_gen_settings_menu', $user->ID ) )
	{
		$_dynamik_theme_settings = add_submenu_page( 'genesis', __( 'Dynamik Settings', 'dynamik' ), __( 'Dynamik Settings', 'dynamik' ), 'manage_options', 'dynamik-settings', 'dynamik_theme_settings' );
		
		add_action( 'admin_print_styles-' . $_dynamik_theme_settings, 'dynamik_admin_styles' );
		add_action( 'admin_print_styles-' . $_dynamik_theme_settings, 'dynamik_settings_styles' );
	}
	if( !get_the_author_meta( 'disable_dynamik_gen_design_menu', $user->ID ) )
	{
		$_dynamik_design_options = add_submenu_page( 'genesis', __( 'Dynamik Design', 'dynamik' ), __( 'Dynamik Design', 'dynamik' ), 'manage_options', 'dynamik-design', 'dynamik_design_options' );
		
		add_action( 'admin_print_styles-' . $_dynamik_design_options, 'dynamik_admin_styles' );
		add_action( 'admin_print_styles-' . $_dynamik_design_options, 'dynamik_design_styles' );
		
		add_action( 'admin_print_scripts-' . $_dynamik_design_options, 'dynamik_design_php_vars' );
	}
	if( !get_the_author_meta( 'disable_dynamik_gen_custom_menu', $user->ID ) )
	{
		$_dynamik_custom_options = add_submenu_page( 'genesis', __( 'Dynamik Custom', 'dynamik' ), __( 'Dynamik Custom', 'dynamik' ), 'manage_options', 'dynamik-custom', 'dynamik_custom_options' );
	
		add_action( 'admin_print_styles-' . $_dynamik_custom_options, 'dynamik_admin_styles' );
		add_action( 'admin_print_styles-' . $_dynamik_custom_options, 'dynamik_custom_styles' );
		
		add_action( 'admin_print_scripts-' . $_dynamik_custom_options, 'dynamik_custom_php_vars' );
	}
}

/**
 * Build the javascript variable to properly display the Dynamik Options > Wrap preview images.
 *
 * @since 1.0
 */
function dynamik_design_php_vars()
{
	$enable_ace_editor_syntax_validation = dynamik_get_settings( 'enable_ace_editor_syntax_validation' );
	$ace_editor_syntax_validation = !empty( $enable_ace_editor_syntax_validation ) ? 'true' : 'false';
?>
<script type="text/javascript">
	var dynamik_wrap_image_url = '<?php echo CHILD_URL . '/lib/css/images/wraps/'; ?>';
	var ace_editor_syntax_validation = <?php echo $ace_editor_syntax_validation ?>;
</script>
<?php
}

/**
 * Build the javascript variables that are used in Custom Options.
 *
 * @since 1.0
 */
function dynamik_custom_php_vars()
{
	$enable_ace_editor_syntax_validation = dynamik_get_settings( 'enable_ace_editor_syntax_validation' );
	$ace_editor_syntax_validation = !empty( $enable_ace_editor_syntax_validation ) ? 'true' : 'false';
?>
<script type="text/javascript">
	var dynamik_custom_url = '<?php echo admin_url( 'admin.php?page=dynamik-custom' ); ?>';
	var ace_editor_syntax_validation = <?php echo $ace_editor_syntax_validation ?>;
	var e_name = '<?php _e( 'Name', 'dynamik' ); ?>';
	var e_file_name = '<?php _e( 'File Name', 'dynamik' ); ?>';
	var e_template_name = '<?php _e( 'Template Name', 'dynamik' ); ?>';
	var e_template_type = '<?php _e( 'Template Type', 'dynamik' ); ?>';
	var e_label_create_conditional = '<?php _e( 'Automatically create a Custom Conditional for this Label', 'dynamik' ); ?>';
	var e_tag = '<?php _e( 'Tag', 'dynamik' ); ?>';
	var e_do_shortcode = '<?php _e( '[do_shortcode]', 'dynamik' ); ?>';
	var e_delete = '<?php _e( 'Delete', 'dynamik' ); ?>';
	var e_hook = '<?php _e( 'Hook', 'dynamik' ); ?>';
	var e_priority = '<?php _e( 'Priority', 'dynamik' ); ?>';
	var e_hooked = '<?php _e( 'Hooked', 'dynamik' ); ?>';
	var e_shortcode = '<?php _e( 'Shortcode', 'dynamik' ); ?>';
	var e_both = '<?php _e( 'Both', 'dynamik' ); ?>';
	var e_css = '<?php _e( 'CSS', 'dynamik' ); ?>';
	var e_deactivate = '<?php _e( 'Deactivate', 'dynamik' ); ?>';
	var e_page_template = '<?php _e( 'Page Template', 'dynamik' ); ?>';
	var e_wp_template = '<?php _e( 'WordPress Template', 'dynamik' ); ?>';
	var e_conditionals = '<?php _e( 'Conditionals', 'dynamik' ); ?>';
	var e_class = '<?php _e( 'Class', 'dynamik' ); ?>';
	var e_description = '<?php _e( 'Widget Area Description:', 'dynamik' ); ?>';
	var f_dynamik_list_conditional_examples = '<?php dynamik_list_conditional_examples(); ?>';
	var f_dynamik_list_hooks = '<?php dynamik_list_hooks(); ?>';
	var f_dynamik_list_conditionals = '<?php dynamik_list_conditionals(); ?>';
</script>
<?php
}

add_action( 'admin_init', 'dynamik_admin_init' );
/**
 * Register styles and scripts for the Dynamik admin menus.
 *
 * @since 1.0
 */
function dynamik_admin_init()
{
	wp_register_style( 'dynamik_admin_styles', CHILD_URL . '/lib/css/admin.css' );
	wp_register_style( 'dynamik_jqui_css', CHILD_URL . '/lib/css/smoothness/jquery-ui-1.7.3.custom.css' );
	wp_register_style( 'dynamik_ms_css', CHILD_URL . '/lib/js/multiselect/multiselect.css' );

	wp_register_script( 'dynamik_ace', CHILD_URL . '/lib/js/ace/ace.js' );
	wp_register_script( 'dynamik_ace_autocomplete', CHILD_URL . '/lib/js/ace/ext-language_tools.js' );
	wp_register_script( 'dynamik_code_builder', CHILD_URL . '/lib/js/code-builder.js' );
	wp_register_script( 'dynamik_admin', CHILD_URL . '/lib/js/admin-options.js' );
	wp_register_script( 'dynamik_settings', CHILD_URL . '/lib/js/theme-settings.js' );
	wp_register_script( 'dynamik_design', CHILD_URL . '/lib/js/design-options.js' );
	wp_register_script( 'dynamik_ms_js', CHILD_URL . '/lib/js/multiselect/multiselect.js' );
	wp_register_script( 'dynamik_custom', CHILD_URL . '/lib/js/custom-options.js' );
	wp_register_script( 'dynamik_jscolor', CHILD_URL . '/lib/js/jscolor/jscolor.js' );
	wp_register_script( 'dynamik_custom_css_builder', CHILD_URL . '/lib/js/custom-css-builder.js' );
}

/**
 * Enqueue styles and scripts for the Dynamik admin menus.
 *
 * @since 1.0
 */
function dynamik_admin_styles()
{
	wp_enqueue_style( 'dynamik_admin_styles' );
	
	wp_enqueue_script( 'dynamik_admin' );
}

/**
 * Enqueue styles and scripts for the Dynamik Theme Settings menu.
 *
 * @since 1.0
 */
function dynamik_settings_styles()
{
	wp_enqueue_script( 'dynamik_settings' );
}

/**
 * Enqueue styles and scripts for the Dynamik Design Options menu.
 *
 * @since 1.0
 */
function dynamik_design_styles()
{
	wp_enqueue_script( 'dynamik_code_builder' );
	wp_enqueue_script( 'dynamik_custom_css_builder' );
	wp_enqueue_script( 'dynamik_design' );
	wp_enqueue_script( 'dynamik_jscolor' );
	wp_enqueue_script( 'dynamik_ace' );
	wp_enqueue_script( 'dynamik_ace_autocomplete' );
}

/**
 * Enqueue styles and scripts for the Dynamik Custom Options menu.
 *
 * @since 1.0
 */
function dynamik_custom_styles()
{
	wp_enqueue_style( 'dynamik_jqui_css' );
	wp_enqueue_style( 'dynamik_ms_css' );

	wp_enqueue_script( 'dynamik_ace' );
	wp_enqueue_script( 'dynamik_ace_autocomplete' );
	wp_enqueue_script( 'dynamik_ms_js' );
	wp_enqueue_script( 'dynamik_code_builder' );
	wp_enqueue_script( 'dynamik_custom_css_builder' );
	wp_enqueue_script( 'dynamik_custom' );
	wp_enqueue_script( 'dynamik_jscolor' );
}

/**
 * Execute the dynamik_write_files() function when the Genesis "Theme Settings"
 * admin page is loaded. This ensures the Dynamik Stylesheets are re-written based
 * on the latest "Default Layout" and "Header Settings" settings.
 *
 * @since 1.0
 */
add_action( 'admin_head', 'dynamik_theme_settings_write_styles' );
function dynamik_theme_settings_write_styles()
{
	if( get_admin_page_title() != 'Theme Settings' )
		return;
	
	dynamik_write_files( $css = true, $ez = false, $custom = false  );
}
