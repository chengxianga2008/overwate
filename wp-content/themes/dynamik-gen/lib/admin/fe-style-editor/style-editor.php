<?php
/**
 * Handles the front-end style editor functionality.
 *
 * @package Dynamik
 */

/**
 * Build the Dynamik Style Editor.
 *
 * @since 2.0
 */
function dynamik_fe_style_editor() {
	
?>
	<div id="dynamik-fe-style-editor" style="display:none;">
		
		<h3>
			<span class="dashicons dashicons-move" style="padding-top:3px;"></span>
		</h3>
		
		<?php do_action( 'dynamik_fe_style_editor_form' ); ?>
		
	</div><!-- END #dynamik-fe-style-editor -->
<?php

}

add_action( 'dynamik_fe_style_editor_form', 'dynamik_fe_style_editor_build_form' );
/**
 * Build and add_action the Style Editor form.
 *
 * @since 2.0
 */
function dynamik_fe_style_editor_build_form() {
	
?>
		<form action="/" id="dynamik-fe-style-editor-form" name="dynamik-fe-style-editor-form">
			
			<input type="hidden" name="action" value="dynamik_fe_style_editor_save" />
			<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'dynamik-fe-style-editor' ); ?>" />
		
			<div class="dynamik-fe-style-editor-nav">
				<input id="dynamik-fe-style-editor-save-button" type="submit" value="<?php _e( 'Save Changes', 'dynamik' ); ?>" name="Submit" alt="Save Changes" />
				<img class="dynamik-ajax-save-spinner" src="<?php echo site_url() . '/wp-admin/images/spinner-2x.gif'; ?>" />
				<span class="dynamik-saved"></span>
	
				<span id="dynamik-fe-style-editor-contract-icon" class="dynamik-fe-style-editor-icons dashicons dashicons-editor-contract"></span>
				<span id="dynamik-fe-style-editor-css-builder-toggle-icon" class="dynamik-fe-style-editor-icons dashicons dashicons-admin-customizer"></span>
				<span id="dynamik-fe-style-editor-search-icon" class="dynamik-fe-style-editor-icons dashicons dashicons-search"></span>
			</div><!-- END .dynamik-fe-style-editor-nav -->
			
			<div id="dynamik-fe-style-editor-container">
				
				<textarea data-editor="css" style="display:none;" wrap="off" id="dynamik-fe-style-editor-output" class="code-builder-output" name="dynamik[custom_css]"><?php echo dynamik_get_custom_css( 'custom_css' ); ?></textarea>					
			
			</div><!-- END #dynamik-fe-style-editor-container -->
		
		</form><!-- END #dynamik-fe-style-editor-form -->
<?php
	
}

add_action( 'wp_head', 'dynamik_fe_css_echo', 15 );
/**
 * Echo the Dynamik Custom Stylesheet into the <head>.
 *
 * @since 2.0
 */
function dynamik_fe_css_echo() {

	$output = '';
    $custom_css = dynamik_preserve_backslashes( dynamik_get_custom_css( 'custom_css' ) );

	if ( $custom_css != '' )
		$output .= $custom_css . "\n";
	
	$output = "\n\n<!-- Begin echoed Dynamik Custom CSS -->\n<style id=\"dynamik-custom-css-echo\" type=\"text/css\">\n" . dynamik_preserve_backslashes( $output ) . "</style>\n<!-- End echoed Dynamik Custom CSS -->\n";

	if ( dynamik_get_settings( 'responsive_enabled' ) ) {
		
		$media_query_css = '
@media only screen and (max-width: ' . dynamik_get_responsive( 'media_query_large_cascading_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_large_cascading_content' ) . '
}
@media only screen and (min-width: ' . dynamik_get_responsive( 'dynamik_media_query_large_min_width' ) . 'px) and (max-width: ' . dynamik_get_responsive( 'dynamik_media_query_large_max_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_large_content' ) . '
}
@media only screen and (min-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_large_min_width' ) . 'px) and (max-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_large_max_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_medium_large_content' ) . '
}
@media only screen and (max-width: ' . dynamik_get_responsive( 'media_query_medium_cascading_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_medium_cascading_content' ) . '
}
@media only screen and (min-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_min_width' ) . 'px) and (max-width: ' . dynamik_get_responsive( 'dynamik_media_query_medium_max_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_medium_content' ) . '
}
@media only screen and (max-width: ' . dynamik_get_responsive( 'media_query_small_width' ) . 'px) {
' . dynamik_get_responsive( 'media_query_small_content' ) . '
}';

		$media_query_css = "\n<!-- Begin Media Query Custom CSS -->\n<style id=\"media-query-custom-css-echo\" type=\"text/css\">" . dynamik_preserve_backslashes( $media_query_css ) . "\n</style>\n<!-- End Media Query Custom CSS -->\n\n";
		
	} else {
		
		$media_query_css = '';
		
	}
	
	echo stripslashes( $output . $media_query_css );
	
}

add_action( 'wp_head', 'dynamik_fe_style_editor_add_html' );
/**
 * Add the Dynamik Style Editor HTML to the <head> area.
 *
 * @since 2.0
 */
function dynamik_fe_style_editor_add_html() {

	$enable_ace_editor_syntax_validation = dynamik_get_settings( 'enable_ace_editor_syntax_validation' );
	$ace_editor_syntax_validation = !empty( $enable_ace_editor_syntax_validation ) ? 'true' : 'false';

?>
<script type="text/javascript">
var ace_editor_syntax_validation = <?php echo $ace_editor_syntax_validation ?>;
var dynamik_fe_style_editor_images_url = 'url(<?php echo dynamik_get_stylesheet_location( 'url' ) . 'images'; ?>';
var dynamik_fe_style_editor_images_url_single_quotes = 'url(\'<?php echo dynamik_get_stylesheet_location( 'url' ) . 'images'; ?>';
var dynamik_fe_style_editor_images_url_double_quotes = 'url("<?php echo dynamik_get_stylesheet_location( 'url' ) . 'images'; ?>';
var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
</script>
<?php

	echo '<span id="dynamik-fe-style-editor-css"><span class="dashicons dashicons-editor-code"></span></span>' . "\n";
	dynamik_fe_style_editor();
	
}

add_action( 'wp_enqueue_scripts', 'dynamik_fe_style_editor_register_scripts' );
/**
 * Register styles and scripts.
 *
 * @since 2.0
 */
function dynamik_fe_style_editor_register_scripts() {

	wp_register_style( 'dynamik_fe_style_editor_styles', CHILD_URL . '/lib/admin/fe-style-editor/front-end.css' );
	wp_register_script( 'dynamik_fe_style_editor', CHILD_URL . '/lib/admin/fe-style-editor/front-end.js', array( 'jquery', 'jquery-ui-draggable' ), CHILD_THEME_VERSION, true );
	wp_register_script( 'dynamik_ace', CHILD_URL . '/lib/js/ace/ace.js' );
	wp_register_script( 'dynamik_ace_autocomplete', CHILD_URL . '/lib/js/ace/ext-language_tools.js' );
		
}

add_action( 'wp_enqueue_scripts', 'dynamik_fe_style_editor_load_scripts' );
/**
 * Load styles and scripts.
 *
 * @since 2.0
 */
function dynamik_fe_style_editor_load_scripts() {

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'dynamik_fe_style_editor_styles' );
	wp_enqueue_style( 'dynamik_jquery_ui_css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', false, CHILD_THEME_VERSION, false );
	wp_enqueue_script( 'jquery-ui-resizable' );
	wp_enqueue_script( 'dynamik_fe_style_editor' );
	wp_enqueue_script( 'dynamik_ace' );
	wp_enqueue_script( 'dynamik_ace_autocomplete' );
		
}
