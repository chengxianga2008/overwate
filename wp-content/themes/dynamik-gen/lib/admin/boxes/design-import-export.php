<?php
/**
 * Builds the Dynamik Import/Export admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-<?php echo $nav_alt_id; ?>import-export-box" class="dynamik-optionbox-outer-1col dynamik-not-universal dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3><?php _e( 'Dynamik Skin Import/Export', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/136-dynamik-design-import-export-options" class="tooltip-mark" target="_blank">[?]</a></h3>
		
<?php	if( !empty( $_GET['notice'] ) )
		{
			if( $_GET['notice'] == 'import-error' )
			{
?>				<div class="notice-box"><strong><?php _e( 'Skin Import Error: Import File Must Be In .zip or .dat Format (ie. my_skin.zip or my_skin.dat)', 'dynamik' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'import-error-catalyst' )
			{
?>				<div class="notice-box"><strong><?php _e( 'Skin Import Error: It appears you are trying to Import an older/incompatible Catalyst/Dynamik Skin.', 'dynamik' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'import-catalyst-complete' )
			{
?>				<div class="notice-box"><strong><?php _e( 'Skin Import Complete: Please note that since this was a Catalyst/Dynamik Skin, and therefore not 100% transferable, you may need to tweak the options a bit to get the design just right.', 'dynamik' ); ?></strong></div>
<?php		}
		}
?>		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Dynamik Skin Export', 'dynamik' ); ?></p>
		</div>
		
		<form method="post">
		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<strong><?php _e( 'Skin File Name:', 'dynamik' ); ?></strong> <input type="text" id="design-export-name" name="design_export_name" value="" style="width:200px; margin-bottom:5px;" />
				<input type="checkbox" value="settings_only" name="settings_only[]" value="0"><?php _e( 'Settings Only?', 'dynamik' ); ?>
				<span class="dynamik-custom-fonts-button-wrap"><input type="submit" name="clicked_button" value="<?php _e( 'Export Skin', 'dynamik' ); ?>" class="button-highlighted dynamik-custom-fonts-button button"/></span>
				<input type="hidden" name="action" value="dynamik_design_export">
			</p>
		</div>
		</form>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Dynamik Skin Import', 'dynamik' ); ?></p>
		</div>
		
		<form method="post" style="padding-bottom:10px;" enctype="multipart/form-data">
		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<strong><?php _e( 'Skin Import File:', 'dynamik' ); ?></strong> <input style="width:225px;" name="design_import_file" type="file" />
				<span class="dynamik-custom-fonts-button-wrap"><input type="submit" name="clicked_button" value="<?php _e( 'Import Skin', 'dynamik' ); ?>" class="button-highlighted dynamik-custom-fonts-button button"/>
				<input type="hidden" name="action" value="dynamik_design_import">	
			</p>
		</div>
		</form>
	</div>
		
	<div class="dynamik-optionbox-inner-1col" style="border: 1px solid #DFDFDF; -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05); box-shadow: 0 1px 2px rgba(0,0,0,.05);">
		<h3 style="border:0;"><?php _e( 'Genesis Child Theme Export', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/57-genesis-child-theme-export" class="tooltip-mark" target="_blank">[?]</a></h3>
				
		<div class="dynamik-child-theme-export-wrap" style="padding:10px 10px 10px 0; border-top:1px solid #F0F0F0; background:#FFFFFF;">
			<div class="dynamik-child-theme-export-2col-left">
				<div id="readme-box" style="margin-right:0; margin-bottom:0;">
					<h5 style="padding-bottom:10px;"><?php _e( 'How To Use Genesis Child Theme Export:', 'dynamik' ); ?></h5>
					<p style="margin-top:-15px;">
						<?php _e( '<span style="font-family:verdana, sans-serif; font-weight:bold; font-size:14px; color:#014662;">Step 1:</span> Fill in the Form Fields.', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/58-child-theme-export-step-1" class="tooltip-mark" target="_blank">[?]</a>
					</p>
					
					<p>
						<?php _e( '<span style="font-family:verdana, sans-serif; font-weight:bold; font-size:14px; color:#014662;">Step 2:</span> Choose whether or not to include a reference to the Genesis style.css file in your Child Theme\'s stylesheet.', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/60-child-theme-export-step-2" class="tooltip-mark" target="_blank">[?]</a>
					</p>

					<p>
						<?php _e( '<span style="font-family:verdana, sans-serif; font-weight:bold; font-size:14px; color:#014662;">Step 3:</span> Choose whether or not to include the default Page Templates included with Dynamik (landing.php & page-builder.php) as well as your current "Dynamik Protected Folders".', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/101-child-theme-export-step-3" class="tooltip-mark" target="_blank">[?]</a>
					</p>
					
					<p>
						<?php _e( '<span style="font-family:verdana, sans-serif; font-weight:bold; font-size:14px; color:#014662;">Step 4:</span> Choose whether or not to include your current Dynamik "Theme Settings".', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/102-child-theme-export-step-4" class="tooltip-mark" target="_blank">[?]</a>
					</p>
					
					<p>
						<?php _e( '<span style="font-family:verdana, sans-serif; font-weight:bold; font-size:14px; color:#014662;">Step 5:</span> Choose whether or not to include any or all of your current Dynamik Design and/or Custom content.', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/103-child-theme-export-step-5" class="tooltip-mark" target="_blank">[?]</a>
					</p>
					
					<p>
						<?php _e( '<span style="font-family:verdana, sans-serif; font-weight:bold; font-size:14px; color:#014662;">Step 6:</span> Click the "Export Genesis Child Theme" button.', 'dynamik' ); ?>
					</p>
				</div>
			</div>
			
			<div class="dynamik-child-theme-export-2col-right">
				<div class="bg-box" style="margin-right:0; margin-bottom:0;">
				<form method="post" enctype="multipart/form-data">
					<p>
						<input type="text" id="child-name" name="child_name" value="" style="width:190px; margin-bottom:5px;" /> <?php _e( 'Theme Name', 'dynamik' ); ?><br />
						<input type="text" id="child-author" name="child_author" value="" style="width:190px; margin-bottom:5px;" /> <?php _e( 'Author', 'dynamik' ); ?><br />
						<input type="text" id="child-author-uri" name="child_author_uri" value="" style="width:190px; margin-bottom:5px;" /> <?php _e( 'Author URI', 'dynamik' ); ?><br />
						<input type="text" id="child-version-number" name="child_version_number" value="" style="width:190px;" /> <?php _e( 'Version #', 'dynamik' ); ?><br /><br />

						<input type="checkbox" id="parent-at-style" name="parent_at_style" value="1" > <?php _e( 'Include Reference To Genesis style.css? ', 'dynamik' ); ?><br />
						<input type="checkbox" id="include-default-page-templates" name="include_default_page_templates" value="1" checked > <?php _e( 'Include Default Page Templates? ', 'dynamik' ); ?><br />
						<input type="checkbox" id="include-protected-folders" name="include_protected_folders" value="1" checked > <?php _e( 'Include "Dynamik Protected Folders"? ', 'dynamik' ); ?><br />
						<input type="checkbox" id="include-theme-settings" name="include_theme_settings" value="1" checked > <?php _e( 'Include Dynamik "Theme Settings"? ', 'dynamik' ); ?><br />
						<input type="checkbox" id="include-dynamik-design" name="include_dynamik_design" value="1" checked > <?php _e( 'Include Dynamik "Design Options"? ', 'dynamik' ); ?><br />
						<input type="checkbox" id="include-custom-css" name="include_custom_css" value="1" checked > <?php _e( 'Include Dynamik Custom > Custom CSS? ', 'dynamik' ); ?><br />
						<input type="checkbox" id="include-custom-functions" name="include_custom_functions" value="1" checked > <?php _e( 'Include Dynamik Custom > Custom Functions? ', 'dynamik' ); ?><br />
						<input type="checkbox" id="include-custom-js" name="include_custom_js" value="1" checked > <?php _e( 'Include Dynamik Custom > Custom Javascript? ', 'dynamik' ); ?><br />
						<input type="checkbox" id="include-custom-templates" name="include_custom_templates" value="1" checked > <?php _e( 'Include Dynamik Custom > Custom Templates? ', 'dynamik' ); ?><br />
						<input type="checkbox" id="include-custom-labels" name="include_custom_labels" value="1" checked > <?php _e( 'Include Dynamik Custom > Custom Labels? ', 'dynamik' ); ?><br />
						<input type="checkbox" id="include-custom-widget-areas" name="include_custom_widget_areas" value="1" checked > <?php _e( 'Include Dynamik Custom > Custom Widget Areas? ', 'dynamik' ); ?><br />
						<input type="checkbox" id="include-custom-hook-boxes" name="include_custom_hook_boxes" value="1" checked > <?php _e( 'Include Dynamik Custom > Custom Hook Boxes? ', 'dynamik' ); ?><br /><br />
						
						<input type="submit" name="clicked_button" value="<?php _e( 'Export Genesis Child Theme', 'dynamik' ); ?>" style="margin:0 !important; float:left !important;" class="button-highlighted dynamik-custom-fonts-button button rounded-button"/>
						<input type="hidden" name="action" value="child_export">
					</p>
				</form>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>