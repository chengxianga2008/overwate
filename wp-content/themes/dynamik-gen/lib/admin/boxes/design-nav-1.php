<?php
/**
 * Builds the Dynamik Nav admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-<?php echo $nav_alt_id; ?>nav1-box" class="dynamik-optionbox-outer-1col dynamik-no-universal-font-headings dynamik-no-universal-font-content dynamik-all-options<?php echo $nav_display; ?>">
	<div class="dynamik-optionbox-inner-1col">
		<h3><?php _e( 'Nav', 'dynamik' ); ?></h3>
		
		<div class="dynamik-structure-settings-hide">
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option">
			<p><?php _e( 'Main Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-nav1-font-type" name="dynamik[font_type][nav1]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['nav1'] ); ?></select>
				<input type="text" id="dynamik-nav1-font-size" class="dynamik-universal-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[nav1_font_size]" value="<?php dynamik_design_options_defaults( true, 'nav1_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-nav1-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-nav1-link-underline" name="dynamik[nav1_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if( dynamik_get_design( 'nav1_link_underline' ) == 'Never' ) echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if( dynamik_get_design( 'nav1_link_underline' ) == 'On Hover' ) echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if( dynamik_get_design( 'nav1_link_underline' ) == 'Off Hover' ) echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if( dynamik_get_design( 'nav1_link_underline' ) == 'Always' ) echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-nav1-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-nav1-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Nav Font Custom CSS | <code>' . dynamik_html_markup( 'nav_primary' ) . ' { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-nav1-font-css" name="dynamik[nav1_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'nav1_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option">
			<p><?php _e( 'Inactive/Hover/Active Page Fonts', 'dynamik' ); ?></p>
		</div>

		<div class="dynamik-design-option dynamik-universal-font-option">
			<p class="bg-box-design">
				<?php _e( 'Inactive Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-nav1-page-font-color" name="dynamik[nav1_page_font_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_font_color' ); ?>" />
				<?php _e( 'Hover Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-nav1-page-hover-font-color" name="dynamik[nav1_page_hover_font_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_hover_font_color' ); ?>" />
				<?php _e( 'Active Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-nav1-page-active-font-color" name="dynamik[nav1_page_active_font_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_active_font_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option">
			<p><?php _e( 'Sub-Page Fonts', 'dynamik' ); ?></p>
		</div>

		<div class="dynamik-design-option dynamik-universal-font-option">
			<p class="bg-box-design">
				<input type="text" id="dynamik-nav1-sub-page-font-size" class="dynamik-universal-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[nav1_sub_page_font_size]" value="<?php dynamik_design_options_defaults( true, 'nav1_sub_page_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-nav1-sub-page-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-nav1-sub-page-font-color" name="dynamik[nav1_sub_page_font_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_sub_page_font_color' ); ?>" />
				<?php _e( 'Hover Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-nav1-sub-page-hover-font-color" name="dynamik[nav1_sub_page_hover_font_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_sub_page_hover_font_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option">
			<p><?php _e( 'Nav "Extras" Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-nav1-extras-font-type" name="dynamik[font_type][nav1_extras]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['nav1_extras'] ); ?></select>
				<input type="text" id="dynamik-nav1-extras-font-size" class="dynamik-universal-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[nav1_extras_font_size]" value="<?php dynamik_design_options_defaults( true, 'nav1_extras_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-nav1-extras-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-nav1-extras-font-color" name="dynamik[nav1_extras_font_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_extras_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-nav1-extras-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-nav1-extras-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Nav "Extras" Font Custom CSS | <code>.genesis-nav-menu li.right { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-nav1-extras-font-css" name="dynamik[nav1_extras_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'nav1_extras_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option">
			<p><?php _e( 'Nav "Extras" Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-nav1-extras-link-color" name="dynamik[nav1_extras_link_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_extras_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-nav1-extras-link-hover-color" name="dynamik[nav1_extras_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_extras_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-nav1-extras-link-underline" name="dynamik[nav1_extras_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'nav1_extras_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'nav1_extras_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'nav1_extras_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'nav1_extras_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Main Background', 'dynamik' ); ?></p>
		</div>

		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-nav1-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[nav1_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'nav1_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-nav1-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-nav1-bg-no-color" name="dynamik[nav1_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'nav1_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-nav1-bg-color" name="dynamik[nav1_bg_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-nav1-bg-image" name="dynamik[nav1_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'nav1_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Inactive Page Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-nav1-page-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[nav1_page_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'nav1_page_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-nav1-page-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-nav1-page-bg-no-color" name="dynamik[nav1_page_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'nav1_page_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-nav1-page-bg-color" name="dynamik[nav1_page_bg_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-nav1-page-bg-image" name="dynamik[nav1_page_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'nav1_page_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Page Hover Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-nav1-page-hover-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[nav1_page_hover_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'nav1_page_hover_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-nav1-page-hover-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-nav1-page-hover-bg-no-color" name="dynamik[nav1_page_hover_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'nav1_page_hover_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-nav1-page-hover-bg-color" name="dynamik[nav1_page_hover_bg_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_hover_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-nav1-page-hover-bg-image" name="dynamik[nav1_page_hover_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'nav1_page_hover_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Active Page Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-nav1-page-active-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[nav1_page_active_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'nav1_page_active_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-nav1-page-active-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-nav1-page-active-bg-no-color" name="dynamik[nav1_page_active_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'nav1_page_active_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-nav1-page-active-bg-color" name="dynamik[nav1_page_active_bg_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_active_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-nav1-page-active-bg-image" name="dynamik[nav1_page_active_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'nav1_page_active_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Sub-Page Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-nav1-sub-page-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[nav1_sub_page_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'nav1_sub_page_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-nav1-sub-page-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-nav1-sub-page-bg-no-color" name="dynamik[nav1_sub_page_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'nav1_sub_page_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-nav1-sub-page-bg-color" name="dynamik[nav1_sub_page_bg_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_sub_page_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-nav1-sub-page-bg-image" name="dynamik[nav1_sub_page_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'nav1_sub_page_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Sub-Page Hover Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-nav1-sub-page-hover-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[nav1_sub_page_hover_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'nav1_sub_page_hover_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-nav1-sub-page-hover-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-nav1-sub-page-hover-bg-no-color" name="dynamik[nav1_sub_page_hover_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'nav1_sub_page_hover_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-nav1-sub-page-hover-bg-color" name="dynamik[nav1_sub_page_hover_bg_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_sub_page_hover_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-nav1-sub-page-hover-bg-image" name="dynamik[nav1_sub_page_hover_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'nav1_sub_page_hover_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Main Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-nav1-border-type" name="dynamik[nav1_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (dynamik_get_design( 'nav1_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if (dynamik_get_design( 'nav1_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Top"<?php if (dynamik_get_design( 'nav1_border_type' ) == 'Top') echo ' selected="selected"'; ?>><?php _e( 'Top', 'dynamik' ); ?></option>
					<option value="Bottom"<?php if (dynamik_get_design( 'nav1_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if (dynamik_get_design( 'nav1_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[nav1_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'nav1_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-nav1-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[nav1_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'nav1_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-nav1-border-color" name="dynamik[nav1_border_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Individual Page Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness:', 'dynamik' ); ?>
				<?php _e( 'Top', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-page-top-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[nav1_page_top_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_top_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Btm', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-page-bottom-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[nav1_page_bottom_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_bottom_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Lft', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-page-left-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[nav1_page_left_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_left_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Rt', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-page-right-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[nav1_page_right_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_right_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-nav1-page-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[nav1_page_border_style]" size="1" style="width:70px;">
					<?php dynamik_list_borders( dynamik_get_design( 'nav1_page_border_style' ) ); ?>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Individual Page Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Colors: Inactive', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-nav1-page-border-color" name="dynamik[nav1_page_border_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_border_color' ); ?>" />
				<?php _e( 'Hover', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-nav1-page-hover-border-color" name="dynamik[nav1_page_hover_border_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_hover_border_color' ); ?>" />
				<?php _e( 'Active', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-nav1-page-active-border-color" name="dynamik[nav1_page_active_border_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_active_border_color' ); ?>" />
			</p>
		</div>
		
		</div><!-- End .dynamik-structure-settings-hide -->
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Nav Placement', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<?php _e( 'Location Of Nav', 'dynamik' ); ?> <select id="dynamik-nav1-location" name="dynamik[nav1_location]" size="1" style="width:115px;">
					<option value="Above Header"<?php if( dynamik_get_design( 'nav1_location' ) == 'Above Header' ) echo ' selected="selected"'; ?>><?php _e( 'Above Header', 'dynamik' ); ?></option>
					<option value="Below Header"<?php if( dynamik_get_design( 'nav1_location' ) == 'Below Header' ) echo ' selected="selected"'; ?>><?php _e( 'Below Header', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Alignment', 'dynamik' ); ?> <select id="dynamik-nav1-alignment" name="dynamik[nav1_alignment]" size="1" style="width:70px;">
					<option value="Left"<?php if( dynamik_get_design( 'nav1_alignment' ) == 'Left' ) echo ' selected="selected"'; ?>><?php _e( 'Left', 'dynamik' ); ?></option>
					<option value="Center"<?php if( dynamik_get_design( 'nav1_alignment' ) == 'Center' ) echo ' selected="selected"'; ?>><?php _e( 'Center', 'dynamik' ); ?></option>
				</select> <a href="http://dynamikdocs.cobaltapps.com/article/30-adjusting-location-of-navbar" class="tooltip-mark" target="_blank">[?]</a>
			</p>
		</div>
		
		<div class="dynamik-structure-settings-hide">
		
		<div class="dynamik-design-standard-hide">
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Nav Wrap Margins', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Top Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-nav1-wrap-top-margin" name="dynamik[nav1_wrap_top_margin]" value="<?php dynamik_design_options_defaults( true, 'nav1_wrap_top_margin' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-nav1-wrap-bottom-margin" name="dynamik[nav1_wrap_bottom_margin]" value="<?php dynamik_design_options_defaults( true, 'nav1_wrap_bottom_margin' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Individual Page Margins/Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p class="bg-box-design">
				<?php _e( 'Margin: Left', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-page-left-margin" name="dynamik[nav1_page_left_margin]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_left_margin' ); ?>" style="width:30px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-page-right-margin" name="dynamik[nav1_page_right_margin]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_right_margin' ); ?>" style="width:30px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Padding: Top/Btm', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-page-tb-padding" name="dynamik[nav1_page_tb_padding]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_tb_padding' ); ?>" style="width:30px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Lft/Rt', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-page-lr-padding" name="dynamik[nav1_page_lr_padding]" value="<?php dynamik_design_options_defaults( true, 'nav1_page_lr_padding' ); ?>" style="width:30px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Nav "Extras" Text Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Top Padding', 'dynamik' ); ?>
				<input type="text" id="dynamik-nav1-extras-text-padding-top" name="dynamik[nav1_extras_text_padding_top]" value="<?php dynamik_design_options_defaults( true, 'nav1_extras_text_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right Padding', 'dynamik' ); ?>
				<input type="text" id="dynamik-nav1-extras-text-padding-bottom" name="dynamik[nav1_extras_text_padding_right]" value="<?php dynamik_design_options_defaults( true, 'nav1_extras_text_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Nav "Extras" Search Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Top Padding', 'dynamik' ); ?>
				<input type="text" id="dynamik-nav1-extras-search-padding-top" name="dynamik[nav1_extras_search_padding_top]" value="<?php dynamik_design_options_defaults( true, 'nav1_extras_search_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right Padding', 'dynamik' ); ?>
				<input type="text" id="dynamik-nav1-extras-search-padding-bottom" name="dynamik[nav1_extras_search_padding_right]" value="<?php dynamik_design_options_defaults( true, 'nav1_extras_search_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Submenu', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p class="bg-box-design">
				<?php _e( 'Border Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-nav1-submenu-border-color" name="dynamik[nav1_submenu_border_color]" value="<?php dynamik_design_options_defaults( true, 'nav1_submenu_border_color' ); ?>" />
				<?php _e( 'Width', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-submenu-width" name="dynamik[nav1_submenu_width]" value="<?php dynamik_design_options_defaults( true, 'nav1_submenu_width' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
				<span class="dynamik-design-standard-hide">
				<?php _e( 'Padding: Top/Btm', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-submenu-tb-padding" name="dynamik[nav1_submenu_tb_padding]" value="<?php dynamik_design_options_defaults( true, 'nav1_submenu_tb_padding' ); ?>" style="width:30px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Lft/Rt', 'dynamik' ); ?> <input type="text" id="dynamik-nav1-submenu-lr-padding" name="dynamik[nav1_submenu_lr_padding]" value="<?php dynamik_design_options_defaults( true, 'nav1_submenu_lr_padding' ); ?>" style="width:30px;" /><code class="dynamik-px-unit">px</code>
				</span><!-- End .dynamik-design-standard-hide -->
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p>
				<?php _e( 'Sub-Indicator', 'dynamik' ); ?>
				<a href="http://dynamikdocs.cobaltapps.com/article/31-navbar-sub-indicator" class="tooltip-mark" target="_blank">[?]</a>
			</p>
		</div>

		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<select id="dynamik-nav1-sub-indicator-type" class="dynamik-nav-sub-indicator-type" name="dynamik[nav1_sub_indicator_type]" size="1" style="width:65px;">
					<option value="Text"<?php if( dynamik_get_design( 'nav1_sub_indicator_type' ) == 'Text' ) echo ' selected="selected"'; ?>><?php _e( 'Text', 'dynamik' ); ?></option>
					<option value="Image"<?php if( dynamik_get_design( 'nav1_sub_indicator_type' ) == 'Image' ) echo ' selected="selected"'; ?>><?php _e( 'Image', 'dynamik' ); ?></option>
					<option value="None"<?php if( dynamik_get_design( 'nav1_sub_indicator_type' ) == 'None' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'dynamik' ); ?></option>
				</select>
				<span style="display: none;" id="dynamik-nav1-sub-indicator-type-options">
				<select id="dynamik-nav1-sub-indicator-image" name="dynamik[nav1_sub_indicator_image]" size="1" style="width:85px;"><?php dynamik_list_images( dynamik_get_design( 'nav1_sub_indicator_image' ) ); ?></select>
				<?php _e( 'Width', 'dynamik' ); ?>
				<input type="text" id="dynamik-nav1-sub-indicator-width" name="dynamik[nav1_sub_indicator_width]" value="<?php dynamik_design_options_defaults( true, 'nav1_sub_indicator_width' ); ?>" style="width:30px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Height', 'dynamik' ); ?>
				<input type="text" id="dynamik-nav1-sub-indicator-height" name="dynamik[nav1_sub_indicator_height]" value="<?php dynamik_design_options_defaults( true, 'nav1_sub_indicator_height' ); ?>" style="width:30px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Top', 'dynamik' ); ?>
				<input type="text" id="dynamik-nav1-sub-indicator-top" name="dynamik[nav1_sub_indicator_top]" value="<?php dynamik_design_options_defaults( true, 'nav1_sub_indicator_top' ); ?>" style="width:30px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" id="dynamik-nav1-sub-indicator-right" name="dynamik[nav1_sub_indicator_right]" value="<?php dynamik_design_options_defaults( true, 'nav1_sub_indicator_right' ); ?>" style="width:30px;" /><code class="dynamik-px-unit">px</code>
				</span>
			</p>
		</div>
		
		</div><!-- End .dynamik-structure-settings-hide -->
		
	</div>
</div>