<?php
/**
 * Builds the Dynamik Options admin page.
 *
 * Note: This file is only called in if the
 * Dynamik Child Theme is active.
 *
 * @package Dynamik
 */
 
/**
 * Build the Dynamik Design Options admin page.
 *
 * @since 1.0
 */
function dynamik_design_options()
{
	global $message, $skin_message;
	$dynamik_font_type = dynamik_get_design( 'font_type' );

	if( $dynamik_font_type )
	{
		foreach( $dynamik_font_type as $key => $value )
		{
			$dynamik_font_type[$key] = $value;
		}
	}

	$dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );
	$dynamik_active_skin = $dynamik_gen_skin_options['active_skin'];

	$px_em_unit_text = dynamik_get_design( 'universal_px_em' ) == 'px' ? 'px' : 'rem';
	?>
	<div class="wrap">
	
		<div id="dynamik-design-saved" class="dynamik-update-box"></div>
		
		<?php
		if( !empty( $_POST['action'] ) && $_POST['action'] == 'reset' )
		{
			update_option( 'dynamik_gen_design_options', dynamik_design_options_defaults() );
			update_option( 'dynamik_gen_responsive_options', dynamik_responsive_options_defaults() );
			update_option( 'dynamik_gen_design_undo_options', dynamik_design_options_defaults() );
			update_option( 'dynamik_gen_responsive_undo_options', dynamik_responsive_options_defaults() );
			// Reset the active Dynamik Skin to 'default'.
			$dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );
			dynamik_skin_images_cleanup();
			dynamik_skin_options_update( $dynamik_gen_skin_options['active_skin'] );
			$dynamik_gen_skin_options['active_skin'] = 'default';
			update_option( 'dynamik_gen_skin_options', $dynamik_gen_skin_options );
			$dynamik_gen_skin_options = get_option( 'dynamik_gen_skin_options' );
			$dynamik_active_skin = $dynamik_gen_skin_options['active_skin'];
			// Write the necessary files to finalize the reset.
			dynamik_write_files( $css = true, $ez = true, $custom = false );
			$dynamik_font_type = dynamik_get_design( 'font_type' );
		?>
			<script type="text/javascript">jQuery(document).ready(function($){ $('#dynamik-design-saved').html('Design Options Reset').css("position", "fixed").fadeIn('slow');window.setTimeout(function(){$('#dynamik-design-saved').fadeOut( 'slow' );}, 2222); });</script>
		<?php
		}
		if( !empty( $_POST['action'] ) && $_POST['action'] == 'undo' )
		{
			update_option( 'dynamik_gen_design_options', get_option( 'dynamik_gen_design_undo_options' ) );
			update_option( 'dynamik_gen_responsive_options', get_option( 'dynamik_gen_responsive_undo_options' ) );
			dynamik_write_files( $css = true, $ez = true, $custom = false );
			dynamik_get_responsive( null, $args = array( 'cached' => false, 'array' => false ) );
			$dynamik_font_type = dynamik_get_design( 'font_type' );
		?>
			<script type="text/javascript">jQuery(document).ready(function($){ $('#dynamik-design-saved').html('Dynamik Options Undone').css("position", "fixed").fadeIn('slow');window.setTimeout(function(){$('#dynamik-design-saved').fadeOut( 'slow' );}, 2222); });</script>
		<?php
		}
		if( !empty( $_GET['activetab'] ) )
		{
		?>
			<script type="text/javascript">jQuery(document).ready(function($) { $('#<?php echo $_GET['activetab']; ?>').click(); });</script>	
		<?php
		}
		?>
		
		<div id="icon-options-general" class="icon32"></div>
		
		<h2 id="dynamik-admin-heading"><?php _e( 'Dynamik - Design Options', 'dynamik' ); ?></h2>
		
		<div class="dynamik-css-builder-button-wrap">
			<span id="show-hide-custom-css-builder" class="button"><?php _e( 'CSS Builder', 'dynamik' ); ?></span>
		</div>

		<?php
		if( dynamik_get_settings( 'design_options_control' ) == 'structure_settings' )
		{
			$admin_wrap_class = ' class="dynamik-wrap-structure-settings"';
			$nav_alt_id = 'alt-';
			$body_display = '';
			$u_control_display = ' style="display:none;"';
			$nav_display = ' dynamik-options-display';
		}
		elseif( dynamik_get_settings( 'design_options_control' ) == 'design_standard' )
		{
			$admin_wrap_class = ' class="dynamik-wrap-design-standard"';
			$nav_alt_id = '';
			$body_display = ' dynamik-options-display';
			$u_control_display = '';
			$nav_display = '';
		}
		else
		{
			$admin_wrap_class = '';
			$nav_alt_id = '';
			$body_display = ' dynamik-options-display';
			$u_control_display = '';
			$nav_display = '';
		}
		?>

		<div class="dynamik-universal-design-control-button-wrap"<?php echo $u_control_display; ?>>
			<span id="show-hide-universal-design-control" class="button"><?php _e( 'U-Control', 'dynamik' ); ?></span>
		</div>

		<div id="dynamik-admin-wrap"<?php echo $admin_wrap_class ?>>
		
			<?php require_once( CHILD_DIR . '/lib/admin/boxes/custom-css-builder.php' ); ?>

			<div class="dynamik-structure-settings-hide">

				<div id="dynamik-design-options-navigation-wrap">
					<div id="dynamik-design-options-nav1" class="dynamik-admin-nav dynamik-design-options-nav">
						<ul>
							<li id="dynamik-design-options-nav-body" class="dynamik-options-nav-all dynamik-options-nav-active"><a href="#">Body</a></li><li id="dynamik-design-options-nav-wrap" class="dynamik-options-nav-all"><a href="#">Wrap</a></li><li id="dynamik-design-options-nav-header" class="dynamik-options-nav-all"><a href="#">Header</a></li><li id="dynamik-design-options-nav-nav1" class="dynamik-options-nav-all"><a href="#">Nav</a></li><li id="dynamik-design-options-nav-nav2" class="dynamik-options-nav-all"><a href="#">Subnav</a></li><li id="dynamik-design-options-nav-nav3" class="dynamik-options-nav-all"><a href="#">Header Nav</a></li><li id="dynamik-design-options-nav-content" class="dynamik-options-nav-all"><a href="#">Content</a></li><li id="dynamik-design-options-nav-comments" class="dynamik-options-nav-all"><a href="#">Comments</a></li><li id="dynamik-design-options-nav-sidebars" class="dynamik-options-nav-all"><a href="#">Sidebars</a></li><li id="dynamik-design-options-nav-footer" class="dynamik-options-nav-all"><a class="dynamik-options-nav-last" href="#">Footer</a></li>
						</ul>
					</div>
					
					<div id="dynamik-design-options-nav2" class="dynamik-admin-nav dynamik-design-options-nav">
						<ul>
							<li id="dynamik-design-options-nav-widths" class="dynamik-options-nav-all dynamik-update-wrap-widths"><a href="#">Widths</a></li><li id="dynamik-design-options-nav-ez" class="dynamik-options-nav-all"><a href="#">EZ</a></li><li id="dynamik-design-options-nav-widgets" class="dynamik-options-nav-all"><a href="#">Widgets</a></li><li id="dynamik-design-options-nav-search" class="dynamik-options-nav-all"><a href="#">Search</a></li><li id="dynamik-design-options-nav-breadcrumbs" class="dynamik-options-nav-all"><a href="#"><?php if( dynamik_get_settings( 'responsive_enabled' ) ) { ?>Crumbs<?php } else { ?>Breadcrumbs<?php } ?></a></li><li id="dynamik-design-options-nav-taxonomy" class="dynamik-options-nav-all"><a href="#">Tax</a></li><li id="dynamik-design-options-nav-author" class="dynamik-options-nav-all"><a href="#">Author</a></li><li id="dynamik-design-options-nav-post-nav" class="dynamik-options-nav-all"><a href="#">Post Nav</a></li><?php if( dynamik_get_settings( 'responsive_enabled' ) ) { ?><li id="dynamik-design-options-nav-responsive" class="dynamik-options-nav-all dynamik-update-wrap-widths"><a href="#">Responsive</a></li><?php } ?><li id="dynamik-design-options-nav-image-uploader" class="dynamik-options-nav-all"><a href="#"><?php if( dynamik_get_settings( 'responsive_enabled' ) ) { ?>Images<?php } else { ?>Image Uploader<?php } ?></a></li><li id="dynamik-design-options-nav-skins" class="dynamik-options-nav-all"><a href="#">Skins</a></li><li id="dynamik-design-options-nav-import-export" class="dynamik-options-nav-all"><a class="dynamik-options-nav-last" href="#">Imp/Exp</a></li>
						</ul>
					</div>
				</div>

				<?php if( dynamik_get_settings( 'design_options_control' ) == 'design_standard' ) { ?>
					<div id="dynamik-u-control-heading" class="dynamik-admin-nav dynamik-design-options-nav" style="display:none;">
						<ul>
							<li id="dynamik-u-control-nav-fonts" class="dynamik-u-control-nav dynamik-options-nav-all"><a href="#">Font Options</a></li><li id="dynamik-u-control-nav-bgs" class="dynamik-u-control-nav dynamik-options-nav-all"><a href="#">Background Options</a></li><li id="dynamik-u-control-nav-borders" class="dynamik-u-control-nav dynamik-options-nav-all"><a href="#">Border Options</a></li>
						</ul>
					</div>
				<?php } else { ?>
					<div id="dynamik-u-control-heading" class="dynamik-admin-nav dynamik-design-options-nav" style="display:none;">
						<ul>
							<li id="dynamik-u-control-nav-fonts" class="dynamik-u-control-nav dynamik-options-nav-all"><a href="#">Font Options</a></li><li id="dynamik-u-control-nav-bgs" class="dynamik-u-control-nav dynamik-options-nav-all"><a href="#">Background Options</a></li><li id="dynamik-u-control-nav-borders" class="dynamik-u-control-nav dynamik-options-nav-all"><a href="#">Border Options</a></li><li id="dynamik-u-control-nav-padding" class="dynamik-u-control-nav dynamik-options-nav-all"><a href="#">Padding/Margin Options</a></li>
						</ul>
					</div>
				<?php } ?>
			
			</div><!-- End .dynamik-structure-settings-hide -->
			
			<div id="dynamik-design-options-nav-alt" class="dynamik-admin-nav dynamik-design-control-hide dynamik-structure-settings-show">
				<ul>
					<li id="dynamik-design-options-nav-alt-nav1" class="dynamik-options-nav-all dynamik-options-nav-active"><a href="#">Nav</a></li><li id="dynamik-design-options-nav-alt-nav2" class="dynamik-options-nav-all"><a href="#">Subnav</a></li><li id="dynamik-design-options-nav-alt-ez" class="dynamik-options-nav-all"><a href="#">EZ Widget Areas</a></li><?php if( dynamik_get_settings( 'responsive_enabled' ) ) { ?><li id="dynamik-design-options-nav-alt-responsive" class="dynamik-options-nav-all"><a href="#">Responsive</a></li><?php } ?><li id="dynamik-design-options-nav-alt-image-uploader" class="dynamik-options-nav-all"><a href="#"><?php if( dynamik_get_settings( 'responsive_enabled' ) ) { ?>Images<?php } else { ?>Image Uploader<?php } ?></a></li><li id="dynamik-design-options-nav-alt-import-export" class="dynamik-options-nav-all"><a class="dynamik-options-nav-last" href="#">Import / Export</a></li>
				</ul>
			</div>

			<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-universal-control.php' ); ?>
			
			<form action="/" id="design-options-form" name="design-options-form">
			
				<input type="hidden" name="action" value="dynamik_design_options_save" />
				<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'design-options' ); ?>" />
				
				<div id="dynamik-floating-save">
					<input type="submit" value="<?php _e( 'Save Changes', 'dynamik' ); ?>" name="Submit" alt="Save Changes"  class="dynamik-save-button button button-primary"/>
					<img class="dynamik-ajax-save-spinner" src="<?php echo site_url() . '/wp-admin/images/spinner-2x.gif'; ?>" />
					<span class="dynamik-saved"></span>
				</div>
				
				<div class="dynamik-design-options-wrap">
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-body.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-wrap.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-header.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-nav-1.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-nav-2.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-nav-3.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-content.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-comments.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-sidebars.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-footer.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-widths.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-ez.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-widgets.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-search.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-breadcrumbs.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-taxonomy.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-author.php' ); ?>
					<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-post-nav.php' ); ?>
				</div>
			
			</form>
		
			<div class="dynamik-design-options-wrap">
				<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-responsive.php' ); ?>
				<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-skins.php' ); ?>
				<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-import-export.php' ); ?>
			</div>
		
			<?php require_once( CHILD_DIR . '/lib/admin/boxes/design-image-uploader.php' ); ?>
			
			<div id="dynamik-admin-footer">
				<p>
					<a href="http://cobaltapps.com" target="_blank">CobaltApps.com</a> | <a href="http://dynamikdocs.cobaltapps.com/" target="_blank">Docs</a> | <a href="http://cobaltapps.com/my-account/" target="_blank">My Account</a> | <a href="http://cobaltapps.com/forum/" target="_blank">Community Forum</a> | <a href="http://cobaltapps.com/affiliates/" target="_blank">Affiliates</a> &middot;
					<a><span id="show-options-reset" class="dynamik-options-reset-button button" style="margin:0; float:none !important;"><?php _e( 'Design Options Reset', 'dynamik' ); ?></span></a><a href="http://dynamikdocs.cobaltapps.com/article/153-design-options-reset" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>
			
			<div style="display:none; width:160px; border:none; background:none; margin:0 auto; padding:0; float:none; position:inherit;" id="show-options-reset-box" class="dynamik-custom-fonts-box">
				<form style="float:left;" id="dynamik-reset-design-options" method="post">
					<input style="background:#D54E21; width:160px !important; color:#FFFFFF !important; -webkit-box-shadow:none; box-shadow:none;" type="submit" value="<?php _e( 'Reset Design Options', 'dynamik' ); ?>" class="dynamik-reset button" name="Submit" onClick='return confirm("<?php _e( 'Are you sure your want to reset your Dynamik Design Options?', 'dynamik' ); ?>")'/><input type="hidden" name="action" value="reset" />
				</form>
				
				<form style="margin-top:5px; float:left;" id="dynamik-undo-design-options" method="post">
					<input style="width:160px !important;" type="submit" value="<?php _e( 'Undo Last Save', 'dynamik' ); ?>" class="dynamik-undo button" name="Submit" onClick='return confirm("<?php _e( 'Are you sure your want to undo your last Design Options Save?', 'dynamik' ); ?>")'/><input type="hidden" name="action" value="undo" />
				</form>
			</div>
		</div>
	</div> <!-- Close Wrap -->
<?php
}

add_action( 'wp_ajax_dynamik_design_options_save', 'dynamik_design_options_save' );
/**
 * Use ajax to update the Dynamik Options based on the posted values.
 *
 * @since 1.0
 */
function dynamik_design_options_save()
{
	check_ajax_referer( 'design-options', 'security' );
	
	if( dynamik_get_design('post_nav_padding_top' ) != '' && dynamik_get_design( 'post_nav_padding_bottom' ) != '' )
	{
		update_option( 'dynamik_gen_design_undo_options', dynamik_get_design( null, $args = array( 'cached' => true, 'array' => true ) ) );
	}
	
	$update = $_POST['dynamik'];
	update_option( 'dynamik_gen_design_options', $update );
	
	dynamik_write_files( $css = true, $ez = true, $custom = false );
	
	echo 'Dynamik Options Updated';
	exit();
}

add_action( 'wp_ajax_dynamik_skin_custom_code_save', 'dynamik_skin_custom_code_save' );
/**
 * Use ajax to update a specific Dynamik Skin custom code file based on the posted values.
 *
 * @since 2.0
 */
function dynamik_skin_custom_code_save() {
	
	check_ajax_referer( 'dynamik-skin-custom-code', 'security' );
	
	if ( $_POST['code_type'] == 'styles' )
		dynamik_write_active_skin_file( $code = $_POST['dynamik']['skin_styles'], $type = $_POST['code_type'] );
	elseif ( $_POST['code_type'] == 'functions' )
		dynamik_write_active_skin_file( $code = $_POST['dynamik']['skin_functions'], $type = $_POST['code_type'] );
	elseif ( $_POST['code_type'] == 'scripts' )
		dynamik_write_active_skin_file( $code = $_POST['dynamik']['skin_scripts'], $type = $_POST['code_type'] );
		
	echo 'Skin ' . ucfirst( $_POST['code_type'] ) . ' Updated';
	exit();
	
}

add_action( 'wp_ajax_dynamik_responsive_options_save', 'dynamik_responsive_options_save' );
/**
 * Use ajax to update the Dynamik Responsive Options based on the posted values.
 *
 * @since 1.0
 */
function dynamik_responsive_options_save()
{
	check_ajax_referer( 'responsive-options', 'security' );
	
	if( dynamik_get_design('post_nav_padding_top' ) != '' && dynamik_get_design( 'post_nav_padding_bottom' ) != '' )
	{
		update_option( 'dynamik_gen_responsive_undo_options', dynamik_get_responsive( null, $args = array( 'cached' => true, 'array' => true ) ) );
	}
	
	$update = $_POST['dynamik'];
	update_option( 'dynamik_gen_responsive_options', $update );

	echo 'Responsive Options Updated';
	exit();
}

/**
 * Create an array of Responsive Options default values.
 *
 * @since 1.0
 * @return an array of Responsive Options default values.
 */
function dynamik_responsive_options_defaults()
{
	$defaults = array(
		'viewport_meta_content' => 'width=device-width, initial-scale=1.0',
		'wrap_media_query_default' => 'default',
		'navbar_media_query_default' => 'default',
		'navbar_media_query_delayed' => 0,
		'header_media_query_default' => 'default',
		'delayed_header_title_area_width' => '320',
		'content_media_query_default' => 'default',
		'content_media_query_padded' => 0,
		'delayed_sidebar_width' => '280',
		'ez_media_query_default' => 'default',
		'footer_media_query_default' => 'default',
		'vertical_menu_sub_page_pre_text' => '- ',
		'vertical_menu_sub_page_text_align' => 'left',
		'dropdown_menu_1_text' => 'Navigation',
		'dropdown_menu_2_text' => 'Navigation',
		'hamburger_icon_1_margin_top' => '-32',
		'hamburger_icon_2_margin_top' => '-32',
		'primary_menu_as_mobile_header_menu' => 0,
		'vertical_toggle_sub_page_reveal' => 1,
		'vertical_toggle_button_styles' => '.responsive-primary-menu-container {
	background: #222222;
	border-bottom: 2px solid #DDDDDD;
	width: 100%;
	padding: 12px 0;
	overflow: hidden;
	cursor: pointer;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	display: none;
}
.responsive-primary-menu-container h3 {
	padding-left: 15px;
	color: #AAAAAA;
	font-size: 16px; font-size: 1.6rem;
	font-family: \'Open Sans\', sans-serif;
	font-weight: normal;
	float: left;
}
.responsive-primary-menu-container .responsive-menu-icon {
	padding: 5px 15px 0 0;
	float: right;
}
.responsive-primary-menu-container .responsive-icon-bar {
	display: block;
	width: 18px;
	height: 3px;
	background: #AAAAAA;
	margin: 1px 0;
	float: right;
	clear: both;
	-webkit-border-radius: 1px;
	border-radius: 1px;
}',
		'vertical_toggle_button_subnav_styles' => '.responsive-secondary-menu-container {
	background: #F5F5F5;
	border-bottom: 2px solid #DDDDDD;
	width: 100%;
	padding: 12px 0;
	overflow: hidden;
	cursor: pointer;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	display: none;
}
.responsive-secondary-menu-container h3 {
	padding-left: 15px;
	color: #888888;
	font-size: 16px; font-size: 1.6rem;
	font-family: \'Open Sans\', sans-serif;
	font-weight: normal;
	float: left;
}
.responsive-secondary-menu-container .responsive-menu-icon {
	padding: 5px 15px 0 0;
	float: right;
}
.responsive-secondary-menu-container .responsive-icon-bar {
	display: block;
	width: 18px;
	height: 3px;
	background: #888888;
	margin: 1px 0;
	float: right;
	clear: both;
	-webkit-border-radius: 1px;
	border-radius: 1px;
}',
		'media_wrap_width' => '1140',
		'media_query_large_cascading_width' => '1140',
		'media_query_large_cascading_content' => '',
		'dynamik_media_query_large_min_width' => '840',
		'dynamik_media_query_large_max_width' => '1140',
		'media_query_large_content' => '',
		'dynamik_media_query_medium_large_min_width' => '480',
		'dynamik_media_query_medium_large_max_width' => '1140',
		'media_query_medium_large_content' => '',
		'media_query_medium_cascading_width' => '839',
		'media_query_medium_cascading_content' => '',
		'dynamik_media_query_medium_min_width' => '480',
		'dynamik_media_query_medium_max_width' => '839',
		'media_query_medium_content' => '',
		'media_query_small_width' => '479',
		'media_query_small_content' => ''
	);
	
	return apply_filters( 'dynamik_responsive_options_defaults', $defaults );
}

/**
 * Create an array of specific Dynamik Options values that
 * are required on the front-end.
 *
 * @since 1.0
 * @return an array of specific Dynamik Options values.
 */
function dynamik_update_design_alt_options()
{
	$dynamik_alt_options = array(
		'minify_css' => dynamik_get_design( 'minify_css' ),
		'font_awesome_css' => dynamik_get_design( 'font_awesome_css' ),
		'wrap_structure' => dynamik_get_design( 'wrap_structure' ),
		'nav1_location' => dynamik_get_design( 'nav1_location' ),
		'nav2_location' => dynamik_get_design( 'nav2_location' ),
		'dynamik_homepage_type' => dynamik_get_design( 'dynamik_homepage_type' ),
		'ez_homepage_select' => dynamik_get_design( 'ez_homepage_select' ),
		'ez_static_home_sb_display' => dynamik_get_design( 'ez_static_home_sb_display' ),
		'ez_static_home_sb_location' => dynamik_get_design( 'ez_static_home_sb_location' ),
		'ez_home_slider_display' => dynamik_get_design( 'ez_home_slider_display' ),
		'ez_home_slider_location' => dynamik_get_design( 'ez_home_slider_location' ),
		'ez_feature_top_display_front_page' => dynamik_get_design( 'ez_feature_top_display_front_page' ),
		'ez_feature_top_display_posts' => dynamik_get_design( 'ez_feature_top_display_posts' ),
		'ez_feature_top_display_pages' => dynamik_get_design( 'ez_feature_top_display_pages' ),
		'ez_feature_top_display_archives' => dynamik_get_design( 'ez_feature_top_display_archives' ),
		'ez_feature_top_display_blog' => dynamik_get_design( 'ez_feature_top_display_blog' ),
		'ez_feature_top_position' => dynamik_get_design( 'ez_feature_top_position' ),
		'ez_feature_top_select' => dynamik_get_design( 'ez_feature_top_select' ),
		'ez_fat_footer_display_front_page' => dynamik_get_design( 'ez_fat_footer_display_front_page' ),
		'ez_fat_footer_display_posts' => dynamik_get_design( 'ez_fat_footer_display_posts' ),
		'ez_fat_footer_display_pages' => dynamik_get_design( 'ez_fat_footer_display_pages' ),
		'ez_fat_footer_display_archives' => dynamik_get_design( 'ez_fat_footer_display_archives' ),
		'ez_fat_footer_display_blog' => dynamik_get_design( 'ez_fat_footer_display_blog' ),
		'ez_fat_footer_position' => dynamik_get_design( 'ez_fat_footer_position' ),
		'ez_fat_footer_select' => dynamik_get_design( 'ez_fat_footer_select' ),
		'author_box_avatar_size' => dynamik_get_design( 'author_box_avatar_size' ),
		'comment_avatar_size' => dynamik_get_design( 'comment_avatar_size' ),
		'font_type' => dynamik_get_design( 'font_type' )
	);
	
	update_option( 'dynamik_gen_design_alt_options', $dynamik_alt_options );
}

/**
 * Create an array of Dynamik Options default values.
 *
 * @since 1.0
 * @return an array of Dynamik Options default values.
 */
function dynamik_design_options_defaults( $defaults = true, $option_check = false, $import = false )
{
	$defaults = array(
		'add_google_fonts' => '[Open Sans|Open+Sans:400,400italic,700,700italic,300,300italic|\'Open Sans\', \'sans-serif\']',
		'universal_link_transition_active' => ( $defaults || !empty( $import['universal_link_transition_active'] ) ) ? 1 : 0,
		'universal_link_transition_style' => 'all 0.2s ease-in-out',
		'body_font_size' => '1.6',
		'universal_line_height' => '1.625',
		'body_font_css' => '',
		'body_bg_type' => 'color',
		'body_bg_color' => 'DDDDDD',
		'body_bg_image' => '',
		'minify_css' => ( $defaults || !empty( $import['minify_css'] ) ) ? 1 : 0,
		'font_awesome_css' => ( !$defaults && !empty( $import['font_awesome_css'] ) ) ? 1 : 0,
		'wrap_bg_type' => 'color',
		'wrap_bg_no_color' => ( !$defaults && !empty( $import['wrap_bg_no_color'] ) ) ? 1 : 0,
		'wrap_bg_color' => 'FFFFFF',
		'wrap_bg_image' => '',
		'inner_bg_type' => 'color',
		'inner_bg_no_color' => ( !$defaults && !empty( $import['inner_bg_no_color'] ) ) ? 1 : 0,
		'inner_bg_color' => 'FFFFFF',
		'inner_bg_image' => '',
		'wrap_border_type' => 'Full',
		'wrap_border_thickness' => '0',
		'wrap_border_style' => 'solid',
		'wrap_border_color' => 'DDDDDD',
		'inner_border_type' => 'Full',
		'inner_border_thickness' => '0',
		'inner_border_style' => 'solid',
		'inner_border_color' => 'DDDDDD',
		'wrap_shadow_active' => ( !$defaults && !empty( $import['wrap_shadow_active'] ) ) ? 1 : 0,
		'wrap_shadow_style' => '0 0 5px #999999',
		'inner_shadow_active' => ( !$defaults && !empty( $import['inner_shadow_active'] ) ) ? 1 : 0,
		'inner_shadow_style' => '0 0 5px #999999',
		'general_shadow_active' => ( !$defaults && !empty( $import['general_shadow_active'] ) ) ? 1 : 0,
		'general_shadow_style' => '0 1px 1px #EEEEEE',
		'general_shadow_elements' => '.taxonomy-description, .content blockquote, .author-description, .author-box, .comment-list li, .ping-list li, a.comment-reply-link, #author, #comment, #email, #url, #respond p.form-allowed-tags, #commentform #submit, .sidebar.widget-area .widget, .breadcrumb, .search-form input[type="submit"], #subbutton, .widget_product_search input#searchsubmit, .search-form input[type="search"], #subbox, .widget_product_search input#s, .pagination li a',
		'wrap_radius_active' => ( !$defaults && !empty( $import['wrap_radius_active'] ) ) ? 1 : 0,
		'wrap_radius_style' => '3px',
		'inner_radius_active' => ( !$defaults && !empty( $import['inner_radius_active'] ) ) ? 1 : 0,
		'inner_radius_style' => '3px',
		'general_radius_active' => ( $defaults || !empty( $import['general_radius_active'] ) ) ? 1 : 0,
		'general_radius_style' => '3px',
		'general_radius_elements' => '.content .taxonomy-description h1, .content .author-description h1, .taxonomy-description, .content blockquote, .author-description, .author-box, .comment-list li, .ping-list li, a.comment-reply-link, #author, #comment, #email, #url, #respond p.form-allowed-tags, #commentform #submit, .sidebar-primary h4, .sidebar-secondary h4, #ez-home-sidebar h4, .sidebar.widget-area .widget, .breadcrumb, .search-form input[type="submit"], #subbutton, .widget_product_search input#searchsubmit, .search-form input[type="search"], #subbox, .widget_product_search input#s, .pagination li a',
		'wrap_top_margin' => '0',
		'wrap_bottom_margin' => '0',
		'inner_top_margin' => '0',
		'inner_bottom_margin' => '0',
		'wrap_tb_padding' => '0',
		'wrap_lr_padding' => '0',
		'inner_tb_padding' => '20',
		'inner_lr_padding' => '20',
		'sb_separation_padding' => '20',
		'wrap_structure' => 'fluid',
		'title_font_size' => '3.6',
		'title_font_color' => '222222',
		'title_font_css' => '',
		'title_link_color' => '000000',
		'title_link_underline' => 'Never',
		'tagline_font_size' => '1.6',
		'tagline_font_color' => '222222',
		'tagline_font_css' => '',
		'header_bg_type' => 'color',
		'header_bg_no_color' => ( !$defaults && !empty( $import['header_bg_no_color'] ) ) ? 1 : 0,
		'header_bg_color' => 'FFFFFF',
		'header_bg_image' => '',
		'header_border_type' => 'Bottom',
		'header_border_thickness' => '0',
		'header_border_style' => 'solid',
		'header_border_color' => 'DDDDDD',
		'fixed_header' => 'disabled',
		'header_height' => '100',
		'header_title_area_center' => ( !$defaults && !empty( $import['header_title_area_center'] ) ) ? 1 : 0,
		'logo_image' => '',
		'retina_logo_active' => ( !$defaults && !empty( $import['retina_logo_active'] ) ) ? 1 : 0,
		'retina_logo_image' => '',
		'header_title_area_width' => '400',
		'header_title_area_height' => '100',
		'text_logo_top_padding' => '12',
		'text_logo_left_padding' => '20',
		'tagline_top_padding' => '0',
		'image_logo_top_margin' => '0',
		'image_logo_bottom_margin' => '0',
		'image_logo_left_margin' => '0',
		'header_widget_width' => '680',
		'header_widget_top_padding' => '24',
		'header_widget_right_padding' => '0',
		'header_widget_text_align' => 'right',
		'nav1_font_size' => '1.6',
		'nav1_font_css' => '',
		'nav1_link_underline' => 'Never',
		'nav1_page_font_color' => 'AAAAAA',
		'nav1_page_hover_font_color' => 'FFFFFF',
		'nav1_page_active_font_color' => 'FFFFFF',
		'nav1_sub_page_font_size' => ( $import && empty( $import['nav1_sub_page_font_size'] ) ) ? $import['nav1_font_size'] : '1.4',
		'nav1_sub_page_font_color' => '888888',
		'nav1_sub_page_hover_font_color' => '000000',
		'nav1_extras_font_size' => '1.6',
		'nav1_extras_font_color' => 'FFFFFF',
		'nav1_extras_font_css' => '',
		'nav1_extras_link_color' => 'AAAAAA',
		'nav1_extras_link_hover_color' => 'FFFFFF',
		'nav1_extras_link_underline' => 'Never',
		'nav1_bg_type' => 'color',
		'nav1_bg_no_color' => ( !$defaults && !empty( $import['nav1_bg_no_color'] ) ) ? 1 : 0,
		'nav1_bg_color' => '222222',
		'nav1_bg_image' => '',
		'nav1_page_bg_type' => 'color',
		'nav1_page_bg_no_color' => ( !$defaults && !empty( $import['nav1_page_bg_no_color'] ) ) ? 1 : 0,
		'nav1_page_bg_color' => '222222',
		'nav1_page_bg_image' => '',
		'nav1_page_hover_bg_type' => 'color',
		'nav1_page_hover_bg_no_color' => ( !$defaults && !empty( $import['nav1_page_hover_bg_no_color'] ) ) ? 1 : 0,
		'nav1_page_hover_bg_color' => '222222',
		'nav1_page_hover_bg_image' => '',
		'nav1_page_active_bg_type' => 'color',
		'nav1_page_active_bg_no_color' => ( !$defaults && !empty( $import['nav1_page_active_bg_no_color'] ) ) ? 1 : 0,
		'nav1_page_active_bg_color' => '222222',
		'nav1_page_active_bg_image' => '',
		'nav1_sub_page_bg_type' => 'color',
		'nav1_sub_page_bg_no_color' => ( !$defaults && !empty( $import['nav1_sub_page_bg_no_color'] ) ) ? 1 : 0,
		'nav1_sub_page_bg_color' => 'F5F5F5',
		'nav1_sub_page_bg_image' => '',
		'nav1_sub_page_hover_bg_type' => 'color',
		'nav1_sub_page_hover_bg_no_color' => ( !$defaults && !empty( $import['nav1_sub_page_hover_bg_no_color'] ) ) ? 1 : 0,
		'nav1_sub_page_hover_bg_color' => 'F5F5F5',
		'nav1_sub_page_hover_bg_image' => '',
		'nav1_border_type' => 'Bottom',
		'nav1_border_thickness' => '0',
		'nav1_border_style' => 'solid',
		'nav1_border_color' => 'DDDDDD',
		'nav1_page_top_border_thickness' => '0',
		'nav1_page_bottom_border_thickness' => '0',
		'nav1_page_left_border_thickness' => '0',
		'nav1_page_right_border_thickness' => '0',
		'nav1_page_border_style' => 'solid',
		'nav1_page_border_color' => 'DDDDDD',
		'nav1_page_hover_border_color' => 'DDDDDD',
		'nav1_page_active_border_color' => 'DDDDDD',
		'nav1_location' => 'Below Header',
		'nav1_alignment' => 'Left',
		'nav1_wrap_top_margin' => '0',
		'nav1_wrap_bottom_margin' => '0',
		'nav1_page_left_margin' => '0',
		'nav1_page_right_margin' => '0',
		'nav1_page_tb_padding' => '17',
		'nav1_page_lr_padding' => '15',
		'nav1_extras_text_padding_top' => '17',
		'nav1_extras_text_padding_right' => '15',
		'nav1_extras_search_padding_top' => '2',
		'nav1_extras_search_padding_right' => '1',
		'nav1_submenu_border_color' => 'E8E8E8',
		'nav1_submenu_width' => '160',
		'nav1_submenu_tb_padding' => '18',
		'nav1_submenu_lr_padding' => '15',
		'nav1_sub_indicator_type' => 'None',
		'nav1_sub_indicator_image' => '',
		'nav1_sub_indicator_width' => '16',
		'nav1_sub_indicator_height' => '16',
		'nav1_sub_indicator_top' => '18',
		'nav1_sub_indicator_right' => '8',
		'nav2_font_size' => '1.6',
		'nav2_font_css' => '',
		'nav2_link_underline' => 'Never',
		'nav2_page_font_color' => '888888',
		'nav2_page_hover_font_color' => '000000',
		'nav2_page_active_font_color' => '000000',
		'nav2_sub_page_font_size' => ( $import && empty( $import['nav2_sub_page_font_size'] ) ) ? $import['nav2_font_size'] : '1.4',
		'nav2_sub_page_font_color' => '888888',
		'nav2_sub_page_hover_font_color' => '000000',
		'nav2_bg_type' => 'color',
		'nav2_bg_no_color' => ( !$defaults && !empty( $import['nav2_bg_no_color'] ) ) ? 1 : 0,
		'nav2_bg_color' => 'F5F5F5',
		'nav2_bg_image' => '',
		'nav2_page_bg_type' => 'color',
		'nav2_page_bg_no_color' => ( !$defaults && !empty( $import['nav2_page_bg_no_color'] ) ) ? 1 : 0,
		'nav2_page_bg_color' => 'F5F5F5',
		'nav2_page_bg_image' => '',
		'nav2_page_hover_bg_type' => 'color',
		'nav2_page_hover_bg_no_color' => ( !$defaults && !empty( $import['nav2_page_hover_bg_no_color'] ) ) ? 1 : 0,
		'nav2_page_hover_bg_color' => 'F5F5F5',
		'nav2_page_hover_bg_image' => '',
		'nav2_page_active_bg_type' => 'color',
		'nav2_page_active_bg_no_color' => ( !$defaults && !empty( $import['nav2_page_active_bg_no_color'] ) ) ? 1 : 0,
		'nav2_page_active_bg_color' => 'F5F5F5',
		'nav2_page_active_bg_image' => '',
		'nav2_sub_page_bg_type' => 'color',
		'nav2_sub_page_bg_no_color' => ( !$defaults && !empty( $import['nav2_sub_page_bg_no_color'] ) ) ? 1 : 0,
		'nav2_sub_page_bg_color' => 'FFFFFF',
		'nav2_sub_page_bg_image' => '',
		'nav2_sub_page_hover_bg_type' => 'color',
		'nav2_sub_page_hover_bg_no_color' => ( !$defaults && !empty( $import['nav2_sub_page_hover_bg_no_color'] ) ) ? 1 : 0,
		'nav2_sub_page_hover_bg_color' => 'FFFFFF',
		'nav2_sub_page_hover_bg_image' => '',
		'nav2_border_type' => 'Bottom',
		'nav2_border_thickness' => '0',
		'nav2_border_style' => 'solid',
		'nav2_border_color' => 'DDDDDD',
		'nav2_page_top_border_thickness' => '0',
		'nav2_page_bottom_border_thickness' => '0',
		'nav2_page_left_border_thickness' => '0',
		'nav2_page_right_border_thickness' => '0',
		'nav2_page_border_style' => 'solid',
		'nav2_page_border_color' => 'DDDDDD',
		'nav2_page_hover_border_color' => 'DDDDDD',
		'nav2_page_active_border_color' => 'DDDDDD',
		'nav2_location' => 'Below Header',
		'nav2_alignment' => 'Left',
		'nav2_wrap_top_margin' => '0',
		'nav2_wrap_bottom_margin' => '0',
		'nav2_page_left_margin' => '0',
		'nav2_page_right_margin' => '0',
		'nav2_page_tb_padding' => '17',
		'nav2_page_lr_padding' => '15',
		'nav2_submenu_border_color' => 'EEEEEE',
		'nav2_submenu_width' => '160',
		'nav2_submenu_tb_padding' => '18',
		'nav2_submenu_lr_padding' => '15',
		'nav2_sub_indicator_type' => 'None',
		'nav2_sub_indicator_image' => '',
		'nav2_sub_indicator_width' => '16',
		'nav2_sub_indicator_height' => '16',
		'nav2_sub_indicator_top' => '18',
		'nav2_sub_indicator_right' => '8',
		'nav3_font_size' => '1.6',
		'nav3_font_css' => '',
		'nav3_link_underline' => 'Never',
		'nav3_page_font_color' => '888888',
		'nav3_page_hover_font_color' => '000000',
		'nav3_page_active_font_color' => '000000',
		'nav3_sub_page_font_size' => ( $import && empty( $import['nav3_sub_page_font_size'] ) ) ? $import['nav3_font_size'] : '1.4',
		'nav3_sub_page_font_color' => '888888',
		'nav3_sub_page_hover_font_color' => '000000',
		'nav3_bg_type' => 'transparent',
		'nav3_bg_no_color' => ( !$defaults && !empty( $import['nav3_bg_no_color'] ) ) ? 1 : 0,
		'nav3_bg_color' => 'FFFFFF',
		'nav3_bg_image' => '',
		'nav3_page_bg_type' => 'transparent',
		'nav3_page_bg_no_color' => ( !$defaults && !empty( $import['nav3_page_bg_no_color'] ) ) ? 1 : 0,
		'nav3_page_bg_color' => 'FFFFFF',
		'nav3_page_bg_image' => '',
		'nav3_page_hover_bg_type' => 'transparent',
		'nav3_page_hover_bg_no_color' => ( !$defaults && !empty( $import['nav3_page_hover_bg_no_color'] ) ) ? 1 : 0,
		'nav3_page_hover_bg_color' => 'FFFFFF',
		'nav3_page_hover_bg_image' => '',
		'nav3_page_active_bg_type' => 'transparent',
		'nav3_page_active_bg_no_color' => ( !$defaults && !empty( $import['nav3_page_active_bg_no_color'] ) ) ? 1 : 0,
		'nav3_page_active_bg_color' => 'FFFFFF',
		'nav3_page_active_bg_image' => '',
		'nav3_sub_page_bg_type' => 'color',
		'nav3_sub_page_bg_no_color' => ( !$defaults && !empty( $import['nav3_sub_page_bg_no_color'] ) ) ? 1 : 0,
		'nav3_sub_page_bg_color' => 'F5F5F5',
		'nav3_sub_page_bg_image' => '',
		'nav3_sub_page_hover_bg_type' => 'color',
		'nav3_sub_page_hover_bg_no_color' => ( !$defaults && !empty( $import['nav3_sub_page_hover_bg_no_color'] ) ) ? 1 : 0,
		'nav3_sub_page_hover_bg_color' => 'F5F5F5',
		'nav3_sub_page_hover_bg_image' => '',
		'nav3_border_type' => 'Full',
		'nav3_border_thickness' => '0',
		'nav3_border_style' => 'solid',
		'nav3_border_color' => 'DDDDDD',
		'nav3_page_top_border_thickness' => '0',
		'nav3_page_bottom_border_thickness' => '0',
		'nav3_page_left_border_thickness' => '0',
		'nav3_page_right_border_thickness' => '0',
		'nav3_page_border_style' => 'solid',
		'nav3_page_border_color' => 'DDDDDD',
		'nav3_page_hover_border_color' => 'DDDDDD',
		'nav3_page_active_border_color' => 'DDDDDD',
		'nav3_wrap_top_margin' => '0',
		'nav3_wrap_bottom_margin' => '0',
		'nav3_page_left_margin' => '0',
		'nav3_page_right_margin' => '0',
		'nav3_page_tb_padding' => '17',
		'nav3_page_lr_padding' => '15',
		'nav3_submenu_border_color' => 'E8E8E8',
		'nav3_submenu_width' => '160',
		'nav3_submenu_tb_padding' => '18',
		'nav3_submenu_lr_padding' => '15',
		'nav3_sub_indicator_type' => 'None',
		'nav3_sub_indicator_image' => '',
		'nav3_sub_indicator_width' => '16',
		'nav3_sub_indicator_height' => '16',
		'nav3_sub_indicator_top' => '18',
		'nav3_sub_indicator_right' => '8',
		'content_heading_font_css' => '',
		'content_heading_h1_font_size' => '3.8',
		'content_heading_h2_font_size' => '3.4',
		'content_heading_h3_font_size' => '2.8',
		'content_heading_h4_font_size' => '2.6',
		'content_heading_h5_font_size' => '1.8',
		'content_heading_h6_font_size' => '1.6',
		'content_heading_h1_font_color' => '222222',
		'content_heading_h2_font_color' => '222222',
		'content_heading_h3_font_color' => '222222',
		'content_heading_h4_font_color' => '222222',
		'content_heading_h5_font_color' => '222222',
		'content_heading_h6_font_color' => '222222',
		'content_heading_h2_link_color' => '222222',
		'content_heading_h2_hover_color' => '0B0080',
		'content_heading_h2_link_underline' => 'Never',
		'content_byline_font_size' => '1.6',
		'content_byline_font_color' => '222222',
		'content_byline_font_css' => '',
		'content_byline_link_color' => '0B0080',
		'content_byline_link_hover_color' => '000000',
		'content_byline_link_underline' => 'Never',
		'content_p_font_size' => '1.8',
		'content_p_font_color' => '222222',
		'content_p_font_css' => '',
		'content_p_link_color' => '0B0080',
		'content_p_link_hover_color' => '000000',
		'content_p_link_underline' => 'Never',
		'blockquote_font_size' => '1.8',
		'blockquote_font_color' => '999999',
		'blockquote_font_css' => '',
		'blockquote_link_color' => '0B0080',
		'blockquote_link_hover_color' => '000000',
		'blockquote_link_underline' => 'Never',
		'caption_font_size' => '1.6',
		'caption_font_color' => '222222',
		'caption_font_css' => '',
		'post_meta_font_size' => '1.6',
		'post_meta_font_color' => '222222',
		'post_meta_font_css' => '',
		'post_meta_link_color' => '0B0080',
		'post_meta_link_hover_color' => '000000',
		'post_meta_link_underline' => 'Never',
		'post_content_bg_type' => 'color',
		'post_content_bg_no_color' => ( !$defaults && !empty( $import['post_content_bg_no_color'] ) ) ? 1 : 0,
		'post_content_bg_color' => 'FFFFFF',
		'post_content_bg_image' => '',
		'page_content_bg_type' => 'color',
		'page_content_bg_no_color' => ( !$defaults && !empty( $import['page_content_bg_no_color'] ) ) ? 1 : 0,
		'page_content_bg_color' => 'FFFFFF',
		'page_content_bg_image' => '',
		'sticky_post_bg_type' => 'color',
		'sticky_post_bg_no_color' => ( !$defaults && !empty( $import['sticky_post_bg_no_color'] ) ) ? 1 : 0,
		'sticky_post_bg_color' => 'F5F5F5',
		'sticky_post_bg_image' => '',
		'blockquote_bg_type' => 'color',
		'blockquote_bg_no_color' => ( !$defaults && !empty( $import['blockquote_bg_no_color'] ) ) ? 1 : 0,
		'blockquote_bg_color' => 'F5F5F5',
		'blockquote_bg_image' => '',
		'caption_bg_type' => 'color',
		'caption_bg_no_color' => ( !$defaults && !empty( $import['caption_bg_no_color'] ) ) ? 1 : 0,
		'caption_bg_color' => 'F5F5F5',
		'caption_bg_image' => '',
		'thumbnail_bg_type' => 'color',
		'thumbnail_bg_no_color' => ( !$defaults && !empty( $import['thumbnail_bg_no_color'] ) ) ? 1 : 0,
		'thumbnail_bg_color' => 'F5F5F5',
		'thumbnail_bg_image' => '',
		'post_content_border_type' => 'Full',
		'post_content_border_thickness' => '0',
		'post_content_border_style' => 'solid',
		'post_content_border_color' => 'DDDDDD',
		'page_content_border_type' => 'Full',
		'page_content_border_thickness' => '0',
		'page_content_border_style' => 'solid',
		'page_content_border_color' => 'DDDDDD',
		'sticky_post_border_type' => 'Full',
		'sticky_post_border_thickness' => '0',
		'sticky_post_border_style' => 'solid',
		'sticky_post_border_color' => 'DDDDDD',
		'blockquote_border_type' => 'Bottom',
		'blockquote_border_thickness' => '0',
		'blockquote_border_style' => 'solid',
		'blockquote_border_color' => 'DDDDDD',
		'caption_border_thickness' => '0',
		'caption_border_style' => 'solid',
		'caption_border_color' => 'DDDDDD',
		'thumbnail_border_thickness' => '0',
		'thumbnail_border_style' => 'solid',
		'thumbnail_border_color' => 'DDDDDD',
		'thumbnail_image_padding' => '0',
		'cc_bottom_border_thickness' => '1',
		'cc_bottom_border_style' => 'solid',
		'cc_bottom_border_color' => 'DDDDDD',
		'content_padding_top' => '10',
		'content_padding_right' => '20',
		'content_padding_bottom' => '10',
		'content_padding_left' => '20',
		'post_content_margin_top' => '0',
		'post_content_margin_bottom' => '40',
		'post_content_padding_top' => '0',
		'post_content_padding_right' => '0',
		'post_content_padding_bottom' => '0',
		'post_content_padding_left' => '0',
		'page_content_margin_top' => '0',
		'page_content_margin_bottom' => '0',
		'page_content_padding_top' => '0',
		'page_content_padding_right' => '0',
		'page_content_padding_bottom' => '0',
		'page_content_padding_left' => '0',
		'sticky_post_margin_top' => '-10',
		'sticky_post_margin_bottom' => '40',
		'sticky_post_padding_top' => '20',
		'sticky_post_padding_right' => '20',
		'sticky_post_padding_bottom' => '20',
		'sticky_post_padding_left' => '20',
		'content_paragraph_margin_bottom' => '25',
		'content_list_style_padding_bottom' => '20',
		'content_list_style' => 'square',
		'content_filler_image_type' => 'Full',
		'content_filler_image_background_type' => 'Transparent',
		'content_filler_image_background_color' => 'FFFFFF',
		'comment_heading_font_size' => '2.6',
		'comment_heading_font_color' => '222222',
		'comment_heading_font_css' => '',
		'comment_author_font_size' => '1.8',
		'comment_author_font_color' => '222222',
		'comment_author_font_css' => '',
		'comment_author_link_color' => '0B0080',
		'comment_author_link_hover_color' => '000000',
		'comment_author_link_underline' => 'Never',
		'comment_meta_font_size' => '1.4',
		'comment_meta_link_color' => '0B0080',
		'comment_meta_link_hover_color' => '000000',
		'comment_meta_link_underline' => 'Never',
		'comment_meta_font_css' => '',
		'comment_reply_text_font_size' => '1.4',
		'comment_reply_text_link_color' => '222222',
		'comment_reply_text_link_hover_color' => '222222',
		'comment_reply_text_link_underline' => 'Never',
		'comment_reply_text_font_css' => '',
		'comment_body_font_size' => '1.6',
		'comment_body_font_color' => '222222',
		'comment_body_font_css' => '',
		'comment_form_font_size' => '1.6',
		'comment_form_font_color' => '222222',
		'comment_form_font_css' => '',
		'comment_link_color' => '0B0080',
		'comment_link_hover_color' => '000000',
		'comment_link_underline' => 'Never',
		'comment_submit_font_size' => '1.6',
		'comment_submit_font_color' => 'FFFFFF',
		'comment_submit_font_css' => '',
		'comment_submit_text_hover_color' => 'FFFFFF',
		'comment_submit_text_hover_underline' => 'Never',
		'comment_form_allowed_tags_font_size' => '1.6',
		'comment_form_allowed_tags_font_color' => '666666',
		'comment_form_allowed_tags_font_css' => '',
		'comment_even_bg_type' => 'color',
		'comment_even_bg_no_color' => ( !$defaults && !empty( $import['comment_even_bg_no_color'] ) ) ? 1 : 0,
		'comment_even_bg_color' => 'F5F5F5',
		'comment_even_bg_image' => '',
		'comment_alt_bg_type' => 'color',
		'comment_alt_bg_no_color' => ( !$defaults && !empty( $import['comment_alt_bg_no_color'] ) ) ? 1 : 0,
		'comment_alt_bg_color' => 'F5F5F5',
		'comment_alt_bg_image' => '',
		'comment_reply_bg_type' => 'color',
		'comment_reply_bg_no_color' => ( !$defaults && !empty( $import['comment_reply_bg_no_color'] ) ) ? 1 : 0,
		'comment_reply_bg_color' => 'E8E8E8',
		'comment_reply_bg_image' => '',
		'comment_reply_text_bg_type' => 'color',
		'comment_reply_text_bg_no_color' => ( !$defaults && !empty( $import['comment_reply_text_bg_no_color'] ) ) ? 1 : 0,
		'comment_reply_text_bg_color' => 'DDDDDD',
		'comment_reply_text_bg_image' => '',
		'comment_reply_text_hover_bg_type' => 'color',
		'comment_reply_text_hover_bg_no_color' => ( !$defaults && !empty( $import['comment_reply_text_hover_bg_no_color'] ) ) ? 1 : 0,
		'comment_reply_text_hover_bg_color' => 'CCCCCC',
		'comment_reply_text_hover_bg_image' => '',
		'comment_avatar_bg_type' => 'color',
		'comment_avatar_bg_no_color' => ( !$defaults && !empty( $import['comment_avatar_bg_no_color'] ) ) ? 1 : 0,
		'comment_avatar_bg_color' => 'FFFFFF',
		'comment_avatar_bg_image' => '',
		'comment_form_bg_type' => 'color',
		'comment_form_bg_no_color' => ( !$defaults && !empty( $import['comment_form_bg_no_color'] ) ) ? 1 : 0,
		'comment_form_bg_color' => 'FFFFFF',
		'comment_form_bg_image' => '',
		'comment_submit_bg_type' => 'color',
		'comment_submit_bg_no_color' => ( !$defaults && !empty( $import['comment_submit_bg_no_color'] ) ) ? 1 : 0,
		'comment_submit_bg_color' => '222222',
		'comment_submit_bg_image' => '',
		'comment_submit_hover_bg_type' => 'color',
		'comment_submit_hover_bg_no_color' => ( !$defaults && !empty( $import['comment_submit_bg_no_color'] ) ) ? 1 : 0,
		'comment_submit_hover_bg_color' => '000000',
		'comment_submit_hover_bg_image' => '',
		'comment_form_allowed_tags_bg_type' => 'color',
		'comment_form_allowed_tags_bg_no_color' => ( !$defaults && !empty( $import['comment_form_allowed_tags_bg_no_color'] ) ) ? 1 : 0,
		'comment_form_allowed_tags_bg_color' => 'F5F5F5',
		'comment_form_allowed_tags_bg_image' => '',
		'comment_list_border_type' => 'Bottom',
		'comment_list_border_thickness' => '0',
		'comment_list_border_style' => 'solid',
		'comment_list_border_color' => 'DDDDDD',
		'comment_reply_text_border_type' => 'Bottom',
		'comment_reply_text_border_thickness' => '0',
		'comment_reply_text_border_style' => 'solid',
		'comment_reply_text_border_color' => 'CCCCCC',
		'comment_reply_text_hover_border_type' => 'Bottom',
		'comment_reply_text_hover_border_thickness' => '0',
		'comment_reply_text_hover_border_style' => 'solid',
		'comment_reply_text_hover_border_color' => 'BBBBBB',
		'comment_avatar_border_thickness' => '0',
		'comment_avatar_border_style' => 'solid',
		'comment_avatar_border_color' => 'DDDDDD',
		'comment_avatar_padding' => '0',
		'comment_form_border_thickness' => '1',
		'comment_form_border_style' => 'solid',
		'comment_form_border_color' => 'DDDDDD',
		'comment_submit_border_thickness' => '0',
		'comment_submit_border_style' => 'solid',
		'comment_submit_border_color' => 'DDDDDD',
		'comment_submit_hover_border_thickness' => '0',
		'comment_submit_hover_border_style' => 'solid',
		'comment_submit_hover_border_color' => 'DDDDDD',
		'comment_form_allowed_tags_border_thickness' => '0',
		'comment_form_allowed_tags_border_style' => 'solid',
		'comment_form_allowed_tags_border_color' => 'DDDDDD',
		'comment_author_email_url_width' => '250',
		'comment_avatar_size' => '48',
		'comment_form_width' => '',
		'comment_submit_width' => '',
		'comments_margin_top' => '0',
		'comments_margin_bottom' => '15',
		'comment_list_margin_top' => '15',
		'comment_list_margin_bottom' => '5',
		'comment_list_padding_top' => '25',
		'comment_list_padding_right' => '25',
		'comment_list_padding_bottom' => '25',
		'comment_list_padding_left' => '25',
		'comment_reply_text_padding_top' => '8',
		'comment_reply_text_padding_right' => '12',
		'comment_reply_text_padding_bottom' => '8',
		'comment_reply_text_padding_left' => '12',
		'submit_button_padding_top' => '10',
		'submit_button_padding_right' => '14',
		'submit_button_padding_bottom' => '10',
		'submit_button_padding_left' => '14',
		'comments_nav_padding_top' => '20',
		'comments_nav_padding_bottom' => '20',
		'comment_form_allowed_tags_margin_top' => '10',
		'comment_form_allowed_tags_margin_bottom' => '20',
		'comment_form_allowed_tags_padding_top' => '25',
		'comment_form_allowed_tags_padding_right' => '25',
		'comment_form_allowed_tags_padding_bottom' => '25',
		'comment_form_allowed_tags_padding_left' => '25',
		'sb_heading_font_size' => '1.6',
		'sb_heading_font_color' => 'FFFFFF',
		'sb_heading_font_css' => '',
		'sb_content_font_size' => '1.6',
		'sb_content_font_color' => '222222',
		'sb_content_font_css' => '',
		'sb_content_link_color' => '0B0080',
		'sb_content_link_hover_color' => '000000',
		'sb_content_link_underline' => 'Never',
		'sb_heading_bg_type' => 'color',
		'sb_heading_bg_no_color' => ( !$defaults && !empty( $import['sb_heading_bg_no_color'] ) ) ? 1 : 0,
		'sb_heading_bg_color' => '222222',
		'sb_heading_bg_image' => '',
		'sb_content_bg_type' => 'color',
		'sb_content_bg_no_color' => ( !$defaults && !empty( $import['sb_content_bg_no_color'] ) ) ? 1 : 0,
		'sb_content_bg_color' => 'F5F5F5',
		'sb_content_bg_image' => '',
		'sb_heading_border_type' => 'Bottom',
		'sb_heading_border_thickness' => '0',
		'sb_heading_border_style' => 'solid',
		'sb_heading_border_color' => 'DDDDDD',
		'sb_content_border_type' => 'Bottom',
		'sb_content_border_thickness' => '0',
		'sb_content_border_style' => 'solid',
		'sb_content_border_color' => 'DDDDDD',
		'sb_li_bottom_border_thickness' => '0',
		'sb_li_bottom_border_style' => 'solid',
		'sb_li_bottom_border_color' => 'DDDDDD',
		'sb_widget_margin_top' => '0',
		'sb_widget_margin_bottom' => '15',
		'sb_heading_padding_top' => '15',
		'sb_heading_padding_right' => '25',
		'sb_heading_padding_bottom' => '15',
		'sb_heading_padding_left' => '25',
		'sb_content_padding_top' => '30',
		'sb_content_padding_right' => '30',
		'sb_content_padding_bottom' => '15',
		'sb_content_padding_left' => '30',
		'sb_li_margin_top' => '0',
		'sb_li_margin_right' => '0',
		'sb_li_margin_bottom' => '7',
		'sb_li_margin_left' => '0',
		'sb_li_padding_top' => '0',
		'sb_li_padding_right' => '0',
		'sb_li_padding_bottom' => '5',
		'sb_li_padding_left' => '0',
		'sb_list_style' => 'none',
		'footer_font_size' => '1.6',
		'footer_font_color' => 'FFFFFF',
		'footer_font_css' => '',
		'footer_link_color' => 'DDDDDD',
		'footer_link_hover_color' => 'FFFFFF',
		'footer_link_underline' => 'Never',
		'footer_bg_type' => 'color',
		'footer_bg_no_color' => ( !$defaults && !empty( $import['footer_bg_no_color'] ) ) ? 1 : 0,
		'footer_bg_color' => '222222',
		'footer_bg_image' => '',
		'footer_border_type' => 'Top',
		'footer_border_thickness' => '0',
		'footer_border_style' => 'solid',
		'footer_border_color' => 'DDDDDD',
		'footer_gototop_width' => '200',
		'footer_creds_width' => '650',
		'footer_padding_top' => '15',
		'footer_padding_right' => '15',
		'footer_padding_bottom' => '15',
		'footer_padding_left' => '15',
		'cc_width_dbl_rt_sb' => '500',
		'sb1_width_dbl_rt_sb' => '340',
		'sb2_width_dbl_rt_sb' => '180',
		'cc_width_dbl_lft_sb' => '500',
		'sb1_width_dbl_lft_sb' => '340',
		'sb2_width_dbl_lft_sb' => '180',
		'cc_width_dbl_sb' => '500',
		'sb1_width_dbl_sb' => '340',
		'sb2_width_dbl_sb' => '180',
		'cc_width_rt_sb' => '700',
		'sb1_width_rt_sb' => '340',
		'cc_width_lft_sb' => '700',
		'sb1_width_lft_sb' => '340',
		'cc_width_no_sb' => '1060',
		'dynamik_homepage_type' => 'default_home',
		'ez_homepage_select' => 'ez_home_3_3_3',
		'ez_widget_home_title_font_size' => '2.2',
		'ez_widget_home_title_font_color' => '222222',
		'ez_widget_home_title_font_css' => '',
		'ez_widget_home_content_font_size' => '1.6',
		'ez_widget_home_content_font_color' => '222222',
		'ez_widget_home_content_font_css' => '',
		'ez_widget_home_content_link_color' => '0B0080',
		'ez_widget_home_content_link_hover_color' => '000000',
		'ez_widget_home_content_link_underline' => 'Never',
		'ez_widget_home_bg_type' => 'color',
		'ez_widget_home_bg_no_color' => ( !$defaults && !empty( $import['ez_widget_home_bg_no_color'] ) ) ? 1 : 0,
		'ez_widget_home_bg_color' => 'FFFFFF',
		'ez_widget_home_bg_image' => '',
		'ez_widget_home_heading_bottom_border_thickness' => '0',
		'ez_widget_home_heading_bottom_border_style' => 'solid',
		'ez_widget_home_heading_bottom_border_color' => 'DDDDDD',
		'ez_widget_home_border_type' => 'Full',
		'ez_widget_home_border_thickness' => '0',
		'ez_widget_home_border_style' => 'solid',
		'ez_widget_home_border_color' => 'DDDDDD',
		'ez_widget_home_padding_top' => '25',
		'ez_widget_home_padding_right' => '20',
		'ez_widget_home_padding_bottom' => '30',
		'ez_widget_home_padding_left' => '20',
		'ez_static_home_sb_display' => '0',
		'ez_static_home_sb_location' => 'right',
		'ez_home_slider_display' => '0',
		'ez_home_slider_location' => 'outside',
		'ez_home_slider_height' => 'auto',
		'ez_feature_top_display_front_page' => '0',
		'ez_feature_top_display_posts' => '0',
		'ez_feature_top_display_pages' => '0',
		'ez_feature_top_display_archives' => '0',
		'ez_feature_top_display_blog' => '0',
		'ez_feature_top_position' => 'outside_inner',
		'ez_feature_top_select' => 'disabled',
		'ez_widget_feature_title_font_size' => '2.2',
		'ez_widget_feature_title_font_color' => '222222',
		'ez_widget_feature_title_font_css' => '',
		'ez_widget_feature_content_font_size' => '1.6',
		'ez_widget_feature_content_font_color' => '222222',
		'ez_widget_feature_content_font_css' => '',
		'ez_widget_feature_content_link_color' => '0B0080',
		'ez_widget_feature_content_link_hover_color' => '000000',
		'ez_widget_feature_content_link_underline' => 'Never',
		'ez_widget_feature_bg_type' => 'color',
		'ez_widget_feature_bg_no_color' => ( !$defaults && !empty( $import['ez_widget_feature_bg_no_color'] ) ) ? 1 : 0,
		'ez_widget_feature_bg_color' => 'F5F5F5',
		'ez_widget_feature_bg_image' => '',
		'ez_widget_feature_heading_bottom_border_thickness' => '0',
		'ez_widget_feature_heading_bottom_border_style' => 'solid',
		'ez_widget_feature_heading_bottom_border_color' => 'DDDDDD',
		'ez_widget_feature_border_type' => 'Bottom',
		'ez_widget_feature_border_thickness' => '0',
		'ez_widget_feature_border_style' => 'solid',
		'ez_widget_feature_border_color' => 'DDDDDD',
		'ez_widget_feature_padding_top' => '25',
		'ez_widget_feature_padding_right' => '20',
		'ez_widget_feature_padding_bottom' => '30',
		'ez_widget_feature_padding_left' => '20',
		'ez_fat_footer_display_front_page' => '0',
		'ez_fat_footer_display_posts' => '0',
		'ez_fat_footer_display_pages' => '0',
		'ez_fat_footer_display_archives' => '0',
		'ez_fat_footer_display_blog' => '0',
		'ez_fat_footer_position' => 'outside_inner',
		'ez_fat_footer_select' => 'disabled',
		'ez_widget_footer_title_font_size' => '2.2',
		'ez_widget_footer_title_font_color' => '222222',
		'ez_widget_footer_title_font_css' => '',
		'ez_widget_footer_content_font_size' => '1.6',
		'ez_widget_footer_content_font_color' => '222222',
		'ez_widget_footer_content_font_css' => '',
		'ez_widget_footer_content_link_color' => '0B0080',
		'ez_widget_footer_content_link_hover_color' => '000000',
		'ez_widget_footer_content_link_underline' => 'Never',
		'ez_widget_footer_bg_type' => 'color',
		'ez_widget_footer_bg_no_color' => ( !$defaults && !empty( $import['ez_widget_footer_bg_no_color'] ) ) ? 1 : 0,
		'ez_widget_footer_bg_color' => 'F5F5F5',
		'ez_widget_footer_bg_image' => '',
		'ez_widget_footer_heading_bottom_border_thickness' => '0',
		'ez_widget_footer_heading_bottom_border_style' => 'solid',
		'ez_widget_footer_heading_bottom_border_color' => 'DDDDDD',
		'ez_widget_footer_border_type' => 'Top',
		'ez_widget_footer_border_thickness' => '0',
		'ez_widget_footer_border_style' => 'solid',
		'ez_widget_footer_border_color' => 'DDDDDD',
		'ez_widget_footer_padding_top' => '25',
		'ez_widget_footer_padding_right' => '20',
		'ez_widget_footer_padding_bottom' => '30',
		'ez_widget_footer_padding_left' => '20',
		'featured_widget_heading_font_size' => '2',
		'featured_widget_heading_font_css' => '',
		'featured_widget_heading_link_color' => '222222',
		'featured_widget_heading_link_hover_color' => '0B0080',
		'featured_widget_heading_link_underline' => 'Never',
		'featured_widget_byline_font_size' => '1.4',
		'featured_widget_byline_font_color' => '222222',
		'featured_widget_byline_font_css' => '',
		'featured_widget_byline_link_color' => '0B0080',
		'featured_widget_byline_link_hover_color' => '000000',
		'featured_widget_byline_link_underline' => 'Never',
		'featured_widget_p_font_size' => '1.6',
		'featured_widget_p_font_color' => '222222',
		'featured_widget_p_font_css' => '',
		'featured_widget_p_link_color' => '0B0080',
		'featured_widget_p_link_hover_color' => '000000',
		'featured_widget_p_link_underline' => 'Never',
		'featured_widget_margin_top' => '0',
		'featured_widget_margin_right' => '0',
		'featured_widget_margin_bottom' => '0',
		'featured_widget_margin_left' => '0',
		'featured_widget_padding_top' => '0',
		'featured_widget_padding_right' => '0',
		'featured_widget_padding_bottom' => '0',
		'featured_widget_padding_left' => '0',
		'dynamik_widget_column_class_compatible' => ( $defaults || !empty( $import['dynamik_widget_column_class_compatible'] ) ) ? 1 : 0,
		'dynamik_widget_title_font_size' => '2.2',
		'dynamik_widget_title_font_color' => '222222',
		'dynamik_widget_title_font_css' => '',
		'dynamik_widget_content_font_size' => '1.6',
		'dynamik_widget_content_font_color' => '222222',
		'dynamik_widget_content_font_css' => '',
		'dynamik_widget_content_link_color' => '0B0080',
		'dynamik_widget_content_link_hover_color' => '000000',
		'dynamik_widget_content_link_underline' => 'Never',
		'dynamik_widget_bg_type' => 'color',
		'dynamik_widget_bg_no_color' => ( !$defaults && !empty( $import['dynamik_widget_bg_no_color'] ) ) ? 1 : 0,
		'dynamik_widget_bg_color' => 'FFFFFF',
		'dynamik_widget_bg_image' => '',
		'dynamik_widget_border_type' => 'Full',
		'dynamik_widget_border_thickness' => '0',
		'dynamik_widget_border_style' => 'solid',
		'dynamik_widget_border_color' => 'DDDDDD',
		'dynamik_widget_width' => '',
		'dynamik_widget_float' => 'none',
		'dynamik_widget_margin_top' => '0',
		'dynamik_widget_margin_right' => '0',
		'dynamik_widget_margin_bottom' => '0',
		'dynamik_widget_margin_left' => '0',
		'dynamik_widget_padding_top' => '0',
		'dynamik_widget_padding_right' => '0',
		'dynamik_widget_padding_bottom' => '0',
		'dynamik_widget_padding_left' => '0',
		'search_form_font_size' => '1.6',
		'search_form_font_color' => '888888',
		'search_form_font_css' => '',
		'search_button_font_size' => '1.6',
		'search_button_font_color' => 'FFFFFF',
		'search_button_font_css' => '',
		'search_button_text_hover_color' => 'FFFFFF',
		'search_button_text_hover_underline' => 'Never',
		'search_form_bg_type' => 'color',
		'search_form_bg_no_color' => ( !$defaults && !empty( $import['search_form_bg_no_color'] ) ) ? 1 : 0,
		'search_form_bg_color' => 'E8E8E8',
		'search_form_bg_image' => '',
		'search_button_bg_type' => 'color',
		'search_button_bg_no_color' => ( !$defaults && !empty( $import['search_button_bg_no_color'] ) ) ? 1 : 0,
		'search_button_bg_color' => '222222',
		'search_button_bg_image' => '',
		'search_button_hover_bg_type' => 'color',
		'search_button_hover_bg_no_color' => ( !$defaults && !empty( $import['search_button_hover_bg_no_color'] ) ) ? 1 : 0,
		'search_button_hover_bg_color' => '000000',
		'search_button_hover_bg_image' => '',
		'search_form_border_thickness' => '0',
		'search_form_border_style' => 'solid',
		'search_form_border_color' => 'DDDDDD',
		'search_button_border_thickness' => '0',
		'search_button_border_style' => 'solid',
		'search_button_border_color' => '222222',
		'search_button_hover_border_thickness' => '0',
		'search_button_hover_border_style' => 'solid',
		'search_button_hover_border_color' => '000000',
		'search_form_width' => '190',
		'search_form_padding_top' => '9',
		'search_form_padding_right' => '5',
		'search_form_padding_bottom' => '10',
		'search_form_padding_left' => '10',
		'search_button_padding_top' => '10',
		'search_button_padding_right' => '14',
		'search_button_padding_bottom' => '10',
		'search_button_padding_left' => '14',
		'breadcrumbs_font_size' => '1.6',
		'breadcrumbs_font_color' => '222222',
		'breadcrumbs_font_css' => '',
		'breadcrumbs_link_color' => '0B0080',
		'breadcrumbs_link_hover_color' => '000000',
		'breadcrumbs_link_underline' => 'Never',
		'breadcrumbs_bg_type' => 'color',
		'breadcrumbs_bg_no_color' => ( !$defaults && !empty( $import['breadcrumbs_bg_no_color'] ) ) ? 1 : 0,
		'breadcrumbs_bg_color' => 'F5F5F5',
		'breadcrumbs_bg_image' => '',
		'breadcrumbs_border_type' => 'Bottom',
		'breadcrumbs_border_thickness' => '0',
		'breadcrumbs_border_style' => 'solid',
		'breadcrumbs_border_color' => 'DDDDDD',
		'breadcrumbs_margin_top' => '-10',
		'breadcrumbs_margin_bottom' => '30',
		'breadcrumbs_padding_top' => '13',
		'breadcrumbs_padding_right' => '20',
		'breadcrumbs_padding_bottom' => '11',
		'breadcrumbs_padding_left' => '25',
		'taxonomy_box_heading_font_size' => '1.6',
		'taxonomy_box_heading_font_color' => 'FFFFFF',
		'taxonomy_box_heading_font_css' => '',
		'taxonomy_box_content_font_size' => '1.6',
		'taxonomy_box_content_font_color' => '222222',
		'taxonomy_box_content_font_css' => '',
		'taxonomy_box_content_link_color' => '0B0080',
		'taxonomy_box_content_link_hover_color' => '000000',
		'taxonomy_box_content_link_underline' => 'Never',
		'taxonomy_box_heading_bg_type' => 'color',
		'taxonomy_box_heading_bg_no_color' => ( !$defaults && !empty( $import['taxonomy_box_heading_bg_no_color'] ) ) ? 1 : 0,
		'taxonomy_box_heading_bg_color' => '222222',
		'taxonomy_box_heading_bg_image' => '',
		'taxonomy_box_content_bg_type' => 'color',
		'taxonomy_box_content_bg_no_color' => ( !$defaults && !empty( $import['taxonomy_box_content_bg_no_color'] ) ) ? 1 : 0,
		'taxonomy_box_content_bg_color' => 'F5F5F5',
		'taxonomy_box_content_bg_image' => '',
		'taxonomy_box_heading_border_type' => 'Bottom',
		'taxonomy_box_heading_border_thickness' => '0',
		'taxonomy_box_heading_border_style' => 'solid',
		'taxonomy_box_heading_border_color' => 'DDDDDD',
		'taxonomy_box_content_border_type' => 'Bottom',
		'taxonomy_box_content_border_thickness' => '0',
		'taxonomy_box_content_border_style' => 'solid',
		'taxonomy_box_content_border_color' => 'DDDDDD',
		'taxonomy_box_margin_top' => '-10',
		'taxonomy_box_margin_bottom' => '30',
		'taxonomy_box_heading_padding_top' => '13',
		'taxonomy_box_heading_padding_right' => '20',
		'taxonomy_box_heading_padding_bottom' => '11',
		'taxonomy_box_heading_padding_left' => '25',
		'taxonomy_box_content_padding_top' => '25',
		'taxonomy_box_content_padding_right' => '25',
		'taxonomy_box_content_padding_bottom' => '25',
		'taxonomy_box_content_padding_left' => '25',
		'author_box_title_font_size' => '2',
		'author_box_title_font_color' => '222222',
		'author_box_title_font_css' => '',
		'author_box_font_size' => '1.6',
		'author_box_font_color' => '222222',
		'author_box_font_css' => '',
		'author_box_link_color' => '0B0080',
		'author_box_link_hover_color' => '000000',
		'author_box_link_underline' => 'Never',
		'author_box_bg_type' => 'color',
		'author_box_bg_no_color' => ( !$defaults && !empty( $import['author_box_bg_no_color'] ) ) ? 1 : 0,
		'author_box_bg_color' => 'F5F5F5',
		'author_box_bg_image' => '',
		'author_box_avatar_bg_type' => 'color',
		'author_box_avatar_bg_no_color' => ( !$defaults && !empty( $import['author_box_avatar_bg_no_color'] ) ) ? 1 : 0,
		'author_box_avatar_bg_color' => 'FFFFFF',
		'author_box_avatar_bg_image' => '',
		'author_box_border_type' => 'Bottom',
		'author_box_border_thickness' => '0',
		'author_box_border_style' => 'solid',
		'author_box_border_color' => 'DDDDDD',
		'author_box_avatar_border_thickness' => '0',
		'author_box_avatar_border_style' => 'solid',
		'author_box_avatar_border_color' => 'DDDDDD',
		'author_box_avatar_size' => '80',
		'author_box_avatar_padding' => '0',
		'author_box_margin_top' => '0',
		'author_box_margin_bottom' => '40',
		'author_box_padding_top' => '25',
		'author_box_padding_right' => '25',
		'author_box_padding_bottom' => '25',
		'author_box_padding_left' => '25',
		'post_nav_font_size' => '1.6',
		'post_nav_font_css' => '',
		'post_nav_link_color' => '0B0080',
		'post_nav_link_hover_color' => '000000',
		'post_nav_link_underline' => 'Never',
		'post_nav_numbered_inactive_bg_type' => 'color',
		'post_nav_numbered_inactive_bg_no_color' => ( !$defaults && !empty( $import['post_nav_numbered_inactive_bg_no_color'] ) ) ? 1 : 0,
		'post_nav_numbered_inactive_bg_color' => 'FFFFFF',
		'post_nav_numbered_inactive_bg_image' => '',
		'post_nav_numbered_active_bg_type' => 'color',
		'post_nav_numbered_active_bg_no_color' => ( !$defaults && !empty( $import['post_nav_numbered_active_bg_no_color'] ) ) ? 1 : 0,
		'post_nav_numbered_active_bg_color' => 'F5F5F5',
		'post_nav_numbered_active_bg_image' => '',
		'post_nav_border_thickness' => '0',
		'post_nav_border_style' => 'solid',
		'post_nav_border_color' => 'DDDDDD',
		'post_nav_padding_top' => '20',
		'post_nav_padding_bottom' => '20',
		'post_nav_numbered_margin_left' => '0',
		'post_nav_numbered_margin_right' => '0',
		'post_nav_numbered_tb_padding' => '8',
		'post_nav_numbered_lr_padding' => '12',
		'universal_px_em' => 'em',
		'font_type' => array(
			'title' => 'Open Sans',
			'tagline' => 'Open Sans',
			'nav1' => 'Open Sans',
			'nav1_extras' => 'Open Sans',
			'nav2' => 'Open Sans',
			'nav3' => 'Open Sans',
			'content_heading' => 'Open Sans',
			'content_byline' => 'Open Sans',
			'content_p' => 'Open Sans',
			'blockquote' => 'Open Sans',
			'caption' => 'Open Sans',
			'post_meta' => 'Open Sans',
			'comment_heading' => 'Open Sans',
			'comment_author' => 'Open Sans',
			'comment_meta' => 'Open Sans',
			'comment_reply_text' => 'Open Sans',
			'comment_body' => 'Open Sans',
			'comment_form' => 'Open Sans',
			'comment_submit' => 'Open Sans',
			'comment_form_allowed_tags' => 'Open Sans',
			'sb_heading' => 'Open Sans',
			'sb_content' => 'Open Sans',
			'footer' => 'Open Sans',
			'ez_widget_home_title' => 'Open Sans',
			'ez_widget_home_content' => 'Open Sans',
			'ez_widget_feature_title' => 'Open Sans',
			'ez_widget_feature_content' => 'Open Sans',
			'ez_widget_footer_title' => 'Open Sans',
			'ez_widget_footer_content' => 'Open Sans',
			'featured_widget_heading' => 'Open Sans',
			'featured_widget_p' => 'Open Sans',
			'featured_widget_byline' => 'Open Sans',
			'dynamik_widget_title' => 'Open Sans',
			'dynamik_widget_content' => 'Open Sans',
			'search_form' => 'Open Sans',
			'search_button' => 'Open Sans',
			'breadcrumbs' => 'Open Sans',
			'taxonomy_box_heading' => 'Open Sans',
			'taxonomy_box_content' => 'Open Sans',
			'author_box_title' => 'Open Sans',
			'author_box' => 'Open Sans',
			'post_nav' => 'Open Sans'
		)
	);
	
	if( $option_check )
	{
		if( dynamik_get_design( $option_check ) != '' ) { echo dynamik_get_design( $option_check ); } else { echo $defaults[$option_check]; }
	}
	else
	{
		return apply_filters( 'dynamik_design_options_defaults', $defaults );
	}
}
