<?php
/**
 * Builds the Settings Import/Export admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-theme-settings-nav-import-export-box" class="dynamik-optionbox-outer-1col dynamik-all-options">
	
<?php	if( !empty( $_GET['notice'] ) )
	{
		if( $_GET['notice'] == 'import-error' )
		{
?>				<div id="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin-bottom:15px;padding:5px;clear:both;"><strong><?php _e( 'Settings/Custom Import Error: Import File Must Be In .dat Format (ie. my_backup.dat)', 'dynamik' ); ?></strong></div>
<?php		}
		elseif( $_GET['notice'] == 'import-complete' )
		{
?>				<div id="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin-bottom:15px;padding:5px;clear:both;"><strong><?php _e( 'Settings/Custom Import Complete', 'dynamik' ); ?></strong></div>
<?php		}
		elseif( $_GET['notice'] == 'theme-clone-complete' )
		{
?>				<div id="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin-bottom:15px;padding:5px;clear:both;"><strong><?php _e( 'Dynamik Theme Clone Complete. You should now de-activate the Dynamik Theme to use the Genesis Extender Plugin.', 'dynamik' ); ?></strong></div>
<?php		}
		elseif( $_GET['notice'] == 'plugin-clone-complete' )
		{
?>				<div id="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin-bottom:15px;padding:5px;clear:both;"><strong><?php _e( 'Genesis Extender Plugin Clone Complete. You should now de-activate the Genesis Extender Plugin to use the Dynamik Theme.', 'dynamik' ); ?></strong></div>
<?php		}
	}
?>

	<div class="dynamik-optionbox-inner-1col">
		<h3 style="border:none; border-bottom:1px solid #F0F0F0; -webkit-box-shadow:none; box-shadow:none;"><?php _e( 'Dynamik Settings/Custom Import/Export', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/131-dynamik-settings-custom-import-export" class="tooltip-mark" target="_blank">[?]</a></h3>
		
		<div style="width:100%; float:left; padding:10px 10px 10px 0;">
			<div class="dynamik-optionbox-2col-left-wrap" style="padding: 0 10px;">
				<form method="post">
				<div class="bg-box" style="margin-right:0; margin-bottom:0;">
					<h4><?php _e( 'Export Settings/Custom Options', 'dynamik' ); ?><span style="float:right;">( <span id="settings-export-check-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Check', 'dynamik' ); ?></span> | <span id="settings-export-uncheck-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Uncheck', 'dynamik' ); ?></span> )</span></h4>
					<div class="dynamik-import-export-checkboxes-wrap">
						<p>
							<input class="settings-export-check" type="checkbox" id="export-settings" name="export_settings" value="1" checked /> <?php _e( 'Theme Settings', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-css" name="export_css" value="1" checked /> <?php _e( 'Custom CSS', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-functions" name="export_functions" value="1" checked /> <?php _e( 'Custom Functions', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-js" name="export_js" value="1" checked /> <?php _e( 'Custom JS', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-templates" name="export_templates" value="1" checked /> <?php _e( 'Custom Templates', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-labels" name="export_labels" value="1" checked /> <?php _e( 'Custom Labels', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-conditionals" name="export_conditionals" value="1" checked /> <?php _e( 'Custom Conditionals', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-widgets" name="export_widgets" value="1" checked /> <?php _e( 'Custom Widget Areas', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-hooks" name="export_hooks" value="1" checked /> <?php _e( 'Custom Hook Boxes', 'dynamik' ); ?>
						</p>
					</div>
					<p class="dynamik-import-export-action-fields">
						<input type="text" id="dynamik-export-name" class="default-text" name="dynamik_export_name" value="" title="Export File Name" style="width:100%;" class="forbid-chars" />
					</p>
					<p class="dynamik-import-export-action-fields">
						<input type="submit" name="clicked_button" value="<?php _e( 'Export Custom Options', 'dynamik' ); ?>" style="margin:-5px 0 0 !important; float:right !important;" class="button-highlighted dynamik-custom-fonts-button button rounded-button"/>
						<input type="hidden" name="action" value="dynamik_custom_export">
					</p>
				</div>
				</form>
			</div>
		
			<div class="dynamik-optionbox-2col-right-wrap" style="padding: 0 10px;">
				<form method="post" enctype="multipart/form-data">
				<div class="bg-box" style="margin-right:0; margin-bottom:0;">
					<h4><?php _e( 'Import Settings/Custom Options', 'dynamik' ); ?><span style="float:right;">( <span id="settings-import-check-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Check', 'dynamik' ); ?></span> | <span id="settings-import-uncheck-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Uncheck', 'dynamik' ); ?></span> )</span></h4>
					<div class="dynamik-import-export-checkboxes-wrap">
						<p>
							<input class="settings-import-check" type="checkbox" id="import-settings" name="import_settings" value="1" checked /> <?php _e( 'Theme Settings', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-css" name="import_css" value="1" checked /> <?php _e( 'Custom CSS', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-functions" name="import_functions" value="1" checked /> <?php _e( 'Custom Functions', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-js" name="import_js" value="1" checked /> <?php _e( 'Custom JS', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-templates" name="import_templates" value="1" checked /> <?php _e( 'Custom Templates', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-labels" name="import_labels" value="1" checked /> <?php _e( 'Custom Labels', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-conditionals" name="import_conditionals" value="1" checked /> <?php _e( 'Custom Conditionals', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-widgets" name="import_widgets" value="1" checked /> <?php _e( 'Custom Widget Areas', 'dynamik' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-hooks" name="import_hooks" value="1" checked /> <?php _e( 'Custom Hook Boxes', 'dynamik' ); ?>
						</p>
					</div>
					<p class="dynamik-import-export-action-fields">
						<input style="float:right; width:200px;" name="custom_import_file" type="file" />
					</p>
					<p class="dynamik-import-export-action-fields">
						<input type="submit" name="clicked_button" value="<?php _e( 'Import Custom Options', 'dynamik' ); ?>" style="margin:-5px 0 0 !important; float:right !important;" class="button-highlighted dynamik-custom-fonts-button button rounded-button"/>
						<input type="hidden" name="action" value="dynamik_custom_import">
					</p>
				</div>
				</form>
			</div>
		</div>
	</div>

	<?php if( defined( 'GENEXT_VERSION' ) ) { ?>

		<div class="dynamik-optionbox-inner-1col">
			<div class="bg-box">
				<p style="font-size:12px;">
					<?php _e( 'The Genesis Extender Plugin is currently active and therefore you can use the "Clone Options" feature below to transfer either the Dynamik Child Theme\'s Settings, In-Post Metadata & Images over to the Genesis Extender Plugin, or transfer the Genesis Extender Plugin\'s Settings, In-Post Metadata & Images over to the Dynamik Child Theme.', 'dynamik' ); ?>
				</p>
			</div>
		</div>

		<div class="dynamik-optionbox-inner-1col">
			<h3 style="border:none; border-bottom:1px solid #F0F0F0; -webkit-box-shadow:none; box-shadow:none;"><?php _e( 'Dynamik Theme/Genesis Extender Plugin Cloning', 'dynamik' ); ?></h3>
			
			<div style="width:100%; float:left; padding:10px 10px 10px 0;">
				<div class="dynamik-optionbox-2col-left-wrap" style="padding: 0 10px;">
					<form method="post">
					<div class="bg-box">
						<h4><?php _e( 'Clone Dynamik Theme --> to --> Genesis Extender Plugin', 'dynamik' ); ?></h4>
						<p style="margin-top:-10px;">
							<?php _e( 'In this scenario you would be taking ALL of your Dynamik Child Theme Settings, In-Post Metadata & Images and Importing them into the currently active Genesis Extender Plugin. The assumption would be that after you take this action you would de-activate the Dynamik Theme and use the Genesis Extender Plugin.', 'dynamik' ); ?>
						</p>
						<p>
							<input type="checkbox" id="clone-theme-settings" name="clone_theme_settings" value="1" checked /> <?php _e( 'Include Theme Settings', 'dynamik' ); ?>
						</p>
						<p>
							<input type="checkbox" id="clone-theme-metadata" name="clone_theme_metadata" value="1" checked /> <?php _e( 'Include Theme Metadata (Custom Label In-Post Settings)', 'dynamik' ); ?>
						</p>
						<p>
							<?php _e( '<strong>Please Note:</strong> This will wipe out your Dynamik Custom Label In-Post Metadata upon transferring it to Genesis Extender.', 'dynamik' ); ?>
						</p>
						<p>
							<input type="checkbox" id="clone-theme-images" name="clone_theme_images" value="1" checked /> <?php _e( 'Include Theme Images', 'dynamik' ); ?> <input type="submit" name="clicked_button" value="<?php _e( 'Clone Now', 'dynamik' ); ?>" style="margin:-5px 0 0 !important; float:right !important;" class="button-highlighted button" onClick='return confirm("<?php _e( 'Are you sure your want to do this? This will completely overwrite the currently active Genesis Extender Plugin Settings & Images with the currently active Dynamik Theme Settings & Images. This cannot be undone.', 'dynamik' ); ?>")'/>
							<input type="hidden" name="action" value="dynamik_theme_clone">
						</p>
					</div>
					</form>
				</div>
			
				<div class="dynamik-optionbox-2col-right-wrap" style="padding: 0 10px;">
					<form method="post" enctype="multipart/form-data">
					<div class="bg-box">
						<h4><?php _e( 'Clone Genesis Extender Plugin --> to --> Dynamik Theme', 'dynamik' ); ?></h4>
						<p style="margin-top:-10px;">
							<?php _e( 'In this scenario you would be taking ALL of your Genesis Extender Plugin Settings, In-Post Metadata & Images and Importing them into the currently active Dynamik Child Theme. The assumption would be that after you take this action you would de-activate the Genesis Extender Plugin and use the Dynamik Theme.', 'dynamik' ); ?>
						</p>
						<p>
							<input type="checkbox" id="clone-plugin-settings" name="clone_plugin_settings" value="1" checked /> <?php _e( 'Include Plugin Settings', 'dynamik' ); ?>
						</p>
						<p>
							<input type="checkbox" id="clone-plugin-metadata" name="clone_plugin_metadata" value="1" checked /> <?php _e( 'Include Plugin Metadata (Custom Label In-Post Settings)', 'dynamik' ); ?>
						</p>
						<p>
							<?php _e( '<strong>Please Note:</strong> This will wipe out your Genesis Extender Custom Label In-Post Metadata upon transferring it to Dynamik.', 'dynamik' ); ?>
						</p>
						<p>
							<input type="checkbox" id="clone-plugin-images" name="clone_plugin_images" value="1" checked /> <?php _e( 'Include Plugin Images', 'dynamik' ); ?> <input type="submit" name="clicked_button" value="<?php _e( 'Clone Now', 'dynamik' ); ?>" style="margin:-5px 0 0 !important; float:right !important;" class="button-highlighted button" onClick='return confirm("<?php _e( 'Are you sure your want to do this? This will completely overwrite the currently active Dynamik Theme Settings & Images with the currently active Genesis Extender Plugin Settings & Images. This cannot be undone.', 'dynamik' ); ?>")'/>
							<input type="hidden" name="action" value="genesis_extender_clone">
						</p>
					</div>
					</form>
				</div>
			</div>
		</div>

	<?php } ?>

</div>