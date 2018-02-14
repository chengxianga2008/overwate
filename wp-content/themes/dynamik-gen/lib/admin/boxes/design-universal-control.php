<?php
/**
 * Builds the Universal Control admin content.
 *
 * @package Dynamik
 */
?>

<div style="display:none;" id="dynamik-universal-design-control" class="dynamik-optionbox-outer-1col">
	<div class="dynamik-optionbox-inner-1col">
		<h3 style="border-bottom:0;"><?php _e( 'Universal Design Control', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/129-universal-design-control" class="tooltip-mark" target="_blank">[?]</a></h3>

		<div id="dynamik-universal-design-control-wrap">

			<div id="dynamik-universal-design-control-wrap-inner" style="padding:5px 15px;">
				<div id="dynamik-universal-design-control-options">
					<div id="dynamik-universal-design-control-options-box" style="display:none;">
						<p style="margin-top:0; float:left;">
							<?php _e( 'Included Sections:', 'dynamik' ); ?>
							( <span id="design-section-include-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Include All', 'dynamik' ); ?></span> | <span id="design-section-exclude-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Exclude All', 'dynamik' ); ?></span> )
							<span id="dynamik-universal-design-control-section-buttons">
								<input id="design-section-body" class="button dynamik-no-universal-borders dynamik-no-universal-padding" type="button" value="Body">
								<input id="design-section-wrap" class="button dynamik-no-universal-fonts" type="button" value="Wrap">
								<input id="design-section-header" class="button" type="button" value="Header">
								<input id="design-section-nav1" class="button" type="button" value="Nav">
								<input id="design-section-nav2" class="button" type="button" value="Subnav">
								<input id="design-section-nav3" class="button" type="button" value="Header Nav">
								<input id="design-section-content" class="button" type="button" value="Content">
								<input id="design-section-comments" class="button" type="button" value="Comments">
								<input id="design-section-sidebars" class="button" type="button" value="Sidebar">
								<input id="design-section-footer" class="button" type="button" value="Footer">
								<input id="design-section-ez" class="button" type="button" value="EZ">
								<input id="design-section-widgets" class="button" type="button" value="Widgets">
								<input id="design-section-search" class="button" type="button" value="Search">
								<input id="design-section-breadcrumbs" class="button" type="button" value="Crumbs">
								<input id="design-section-taxonomy" class="button" type="button" value="Tax">
								<input id="design-section-author" class="button" type="button" value="Author">
								<input id="design-section-post-nav" class="button" type="button" value="Post Nav">
							</span>
						</p>

						<div class="dynamik-universal-design-controls dynamik-universal-design-font-controls">
							<p style="margin:10px 0 -10px;">
								<?php _e( 'Fonts Types Affected:', 'dynamik' ); ?>
								( <span id="font-types-affect-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Affect All', 'dynamik' ); ?></span> | <span id="font-types-affect-headings" style="color:#21759B; cursor:pointer;"><?php _e( 'Affect Headings', 'dynamik' ); ?></span> | <span id="font-types-affect-content" style="color:#21759B; cursor:pointer;"><?php _e( 'Affect Content', 'dynamik' ); ?></span> )
							</p>
							<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-design-font-controls" style="width:26%;">
								<p><?php _e( 'Fonts', 'dynamik' ); ?></p>
							</div>

							<div class="dynamik-design-option dynamik-universal-design-font-controls" style="width:72%;">
								<p class="bg-box-design">
									<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-master-control" id="dynamik-universal-font-type" name="universal_font_type" size="1" style="width:98px;">
									<?php dynamik_build_font_menu( 'arial' ); ?></select>
									<input type="text" id="dynamik-universal-font-size" class="dynamik-universal-master-control" name="universal_font_size" value="1.6" style="width:35px;" />
									<code class="dynamik-universal-px-em-child" id="dynamik-universal-px-em"><?php echo $px_em_unit_text; ?></code>
									<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-master-control" id="dynamik-universal-font-color" name="universal_font_color" value="universal_font_color" />
									<span class="dynamik-custom-fonts-button-wrap"><span id="show-universal-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
									<span class="dynamik-u-control-color-sync-wrap"><?php _e( 'Sync', 'dynamik' ); ?> <input type="checkbox" id="dynamik-universal-font-sync" name="universal_font_sync" value="1" /><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-master-control" id="dynamik-universal-font-color-option-sync" name="universal_font_color_sync" value="universal_font_color_sync" style="margin-left:0;" /></span>
									<div style="display:none;" id="show-universal-font-css-box" class="dynamik-custom-fonts-box">
									<?php _e( 'Font Custom CSS', 'dynamik' ); ?><br />
									<textarea class="dynamik-universal-master-control" id="dynamik-universal-font-css" name="universal_font_css" style="width:100%;" rows="10"><?php echo ''; ?></textarea>
									</div>
								</p>
							</div>
							
							<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-design-font-controls" style="width:26%;">
								<p><?php _e( 'Font Links', 'dynamik' ); ?></p>
							</div>
							
							<div class="dynamik-design-option dynamik-universal-design-font-controls" style="width:72%;">
								<p class="bg-box-design">
									<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-master-control" id="dynamik-universal-link-color" name="universal_link_color" value="universal_link_color" />
									<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-master-control" id="dynamik-universal-link-hover-color" name="universal_link_hover_color" value="universal_link_hover_color" />
									<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-master-control" id="dynamik-universal-link-underline" name="universal_link_underline" size="1" style="width:90px;">
										<option value="Never"><?php _e( 'Never', 'dynamik' ); ?></option>
										<option value="On Hover"><?php _e( 'On Hover', 'dynamik' ); ?></option>
										<option value="Off Hover"><?php _e( 'Off Hover', 'dynamik' ); ?></option>
										<option value="Always"><?php _e( 'Always', 'dynamik' ); ?></option>
									</select>
								</p>
							</div>
						</div>

						<div class="dynamik-universal-design-controls dynamik-universal-design-bg-controls">
							<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-design-bg-controls" style="width:26%;">
								<p><?php _e( 'Backgrounds', 'dynamik' ); ?></p>
							</div>
							
							<div class="dynamik-design-option dynamik-universal-design-bg-controls" style="width:72%;">
								<p class="bg-box-design">
									<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-universal-bg-type" class="dynamik-universal-master-control" name="universal_bg_type" size="1" style="width:145px;">
									<?php dynamik_list_bg_options( 'color' ); ?>
									</select> <span style="display:none;" id="dynamik-universal-bg-type-checkbox"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-universal-bg-no-color" name="universal_bg_no_color" class="dynamik-universal-master-control" value="1" />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-master-control" id="dynamik-universal-bg-color" name="universal_bg_color" value="universal_bg_color" />
									<span class="dynamik-u-control-color-sync-wrap"><?php _e( 'Sync', 'dynamik' ); ?> <input type="checkbox" id="dynamik-universal-bg-sync" name="universal_bg_sync" value="1" /><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-master-control" id="dynamik-universal-bg-color-sync" name="universal_bg_color_sync" value="universal_bg_color_sync" style="margin-left:0;" /></span>
									<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-universal-bg-image" name="universal_bg_image" class="dynamik-universal-master-control" size="1" style="width:150px;"><?php dynamik_list_images( "universal_bg_image" ); ?></select>
								</p>
							</div>
						</div>

						<div class="dynamik-universal-design-controls dynamik-universal-design-border-controls">
							<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-design-border-controls" style="width:26%;">
								<p><?php _e( 'Borders', 'dynamik' ); ?></p>
							</div>
							
							<div class="dynamik-design-option dynamik-universal-design-border-controls" style="width:72%;">
								<p class="bg-box-design">
									<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-universal-border-thickness" class="dynamik-universal-master-control" name="universal_border_thickness" value="0" style="width:35px;" /><code class="dynamik-px-unit">px</code>
									<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-universal-border-style" class="dynamik-universal-master-control" name="universal_border_style" size="1" style="width:90px; margin-right:5px;">
										<?php dynamik_list_borders( 'solid' ); ?>
									</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-master-control" id="dynamik-universal-border-color" name="universal_border_color" value="universal_border_color" />
									<span class="dynamik-u-control-color-sync-wrap"><?php _e( 'Sync', 'dynamik' ); ?> <input type="checkbox" id="dynamik-universal-border-sync" name="universal_border_sync" value="1" /><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-master-control" id="dynamik-universal-border-color-sync" name="universal_border_color_sync" value="universal_border_color_sync" style="margin-left:0;" /></span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>