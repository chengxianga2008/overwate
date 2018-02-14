<?php
/**
 * Builds the Dynamik Wrap admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-wrap-box" class="dynamik-optionbox-outer-1col dynamik-no-universal-fonts dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3><?php _e( 'Wrap', 'dynamik' ); ?></h3>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Wrap Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-wrap-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[wrap_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'wrap_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-wrap-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-wrap-bg-no-color" name="dynamik[wrap_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'wrap_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-wrap-bg-color" name="dynamik[wrap_bg_color]" value="<?php dynamik_design_options_defaults( true, 'wrap_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-wrap-bg-image" name="dynamik[wrap_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'wrap_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Inner Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-container-wrap-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[inner_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'inner_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-container-wrap-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-container-wrap-bg-no-color" name="dynamik[inner_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'inner_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-container-wrap-bg-color" name="dynamik[inner_bg_color]" value="<?php dynamik_design_options_defaults( true, 'inner_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-container-wrap-bg-image" name="dynamik[inner_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'inner_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Wrap Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-wrap-border-type" name="dynamik[wrap_border_type]" size="1" style="width:100px;">
					<option value="Full"<?php if( dynamik_get_design( 'wrap_border_type' ) == 'Full' ) echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if( dynamik_get_design( 'wrap_border_type' ) == 'Top/Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if( dynamik_get_design( 'wrap_border_type' ) == 'Left/Right' ) echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-wrap-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[wrap_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'wrap_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-wrap-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[wrap_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'wrap_border_style' ) ); ?>
				</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-wrap-border-color" name="dynamik[wrap_border_color]" value="<?php dynamik_design_options_defaults( true, 'wrap_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Inner Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-inner-border-type" name="dynamik[inner_border_type]" size="1" style="width:100px;">
					<option value="Full"<?php if( dynamik_get_design( 'inner_border_type' ) == 'Full' ) echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if( dynamik_get_design( 'inner_border_type' ) == 'Top/Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if( dynamik_get_design( 'inner_border_type' ) == 'Left/Right' ) echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-inner-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[inner_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'inner_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-inner-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[inner_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'inner_border_style' ) ); ?>
				</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-inner-border-color" name="dynamik[inner_border_color]" value="<?php dynamik_design_options_defaults( true, 'inner_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Wrap Box Shadow', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Enable Wrap Box Shadow', 'dynamik' ); ?> <input type="checkbox" id="dynamik-wrap-shadow-active" name="dynamik[wrap_shadow_active]" value="1" <?php if( checked( 1, dynamik_get_design( 'wrap_shadow_active' ) ) ); ?> />
				<?php _e( 'Style', 'dynamik' ); ?> <input type="text" id="dynamik-wrap-shadow-style" name="dynamik[wrap_shadow_style]" value="<?php dynamik_design_options_defaults( true, 'wrap_shadow_style' ); ?>" style="width:220px;" />
				<a href="http://dynamikdocs.cobaltapps.com/article/26-enable-wrap-box-shadow" class="tooltip-mark" target="_blank">[?]</a>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Inner Box Shadow', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Enable Inner Box Shadow', 'dynamik' ); ?> <input type="checkbox" id="dynamik-inner-shadow-active" name="dynamik[inner_shadow_active]" value="1" <?php if( checked( 1, dynamik_get_design( 'inner_shadow_active' ) ) ); ?> />
				<?php _e( 'Style', 'dynamik' ); ?> <input type="text" id="dynamik-inner-shadow-style" name="dynamik[inner_shadow_style]" value="<?php dynamik_design_options_defaults( true, 'inner_shadow_style' ); ?>" style="width:220px;" />
			</p>
		</div>

		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'General Box Shadow', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Enable General Box Shadow', 'dynamik' ); ?> <input type="checkbox" id="dynamik-general-shadow-active" name="dynamik[general_shadow_active]" value="1" <?php if( checked( 1, dynamik_get_design( 'general_shadow_active' ) ) ); ?> />
				<?php _e( 'Style', 'dynamik' ); ?> <input type="text" id="dynamik-general-shadow-style" name="dynamik[general_shadow_style]" value="<?php dynamik_design_options_defaults( true, 'general_shadow_style' ); ?>" style="width:206px;" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-general-shadow-elements" class="dynamik-custom-fonts-button button">#Elements</span></span>
				<div style="display:none;" id="show-general-shadow-elements-box" class="dynamik-custom-fonts-box">
				<?php _e( 'General Box Shadow Elements', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css" id="dynamik-general-shadow-elements" name="dynamik[general_shadow_elements]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'general_shadow_elements' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Wrap Border Radius', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Enable Wrap Border Radius', 'dynamik' ); ?> <input type="checkbox" id="dynamik-wrap-radius-active" name="dynamik[wrap_radius_active]" value="1" <?php if( checked( 1, dynamik_get_design( 'wrap_radius_active' ) ) ); ?> />
				<?php _e( 'Style', 'dynamik' ); ?> <input type="text" id="dynamik-wrap-radius-style" name="dynamik[wrap_radius_style]" value="<?php dynamik_design_options_defaults( true, 'wrap_radius_style' ); ?>" style="width:210px;" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Inner Border Radius', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Enable Inner Border Radius', 'dynamik' ); ?> <input type="checkbox" id="dynamik-inner-radius-active" name="dynamik[inner_radius_active]" value="1" <?php if( checked( 1, dynamik_get_design( 'inner_radius_active' ) ) ); ?> />
				<?php _e( 'Style', 'dynamik' ); ?> <input type="text" id="dynamik-inner-radius-style" name="dynamik[inner_radius_style]" value="<?php dynamik_design_options_defaults( true, 'inner_radius_style' ); ?>" style="width:210px;" />
			</p>
		</div>

		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'General Border Radius', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Enable General Border Radius', 'dynamik' ); ?> <input type="checkbox" id="dynamik-general-radius-active" name="dynamik[general_radius_active]" value="1" <?php if( checked( 1, dynamik_get_design( 'general_radius_active' ) ) ); ?> />
				<?php _e( 'Style', 'dynamik' ); ?> <input type="text" id="dynamik-general-radius-style" name="dynamik[general_radius_style]" value="<?php dynamik_design_options_defaults( true, 'general_radius_style' ); ?>" style="width:196px;" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-general-radius-elements" class="dynamik-custom-fonts-button button">#Elements</span></span>
				<div style="display:none;" id="show-general-radius-elements-box" class="dynamik-custom-fonts-box">
				<?php _e( 'General Border Radius Elements', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css" id="dynamik-general-radius-elements" name="dynamik[general_radius_elements]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'general_radius_elements' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Wrap Margin', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p class="bg-box-design">
				<?php _e( 'Top Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-wrap-top-margin" name="dynamik[wrap_top_margin]" value="<?php dynamik_design_options_defaults( true, 'wrap_top_margin' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-wrap-bottom-margin" name="dynamik[wrap_bottom_margin]" value="<?php dynamik_design_options_defaults( true, 'wrap_bottom_margin' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Inner Margin', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p class="bg-box-design">
				<?php _e( 'Top Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-inner-top-margin" name="dynamik[inner_top_margin]" value="<?php dynamik_design_options_defaults( true, 'inner_top_margin' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-inner-bottom-margin" name="dynamik[inner_bottom_margin]" value="<?php dynamik_design_options_defaults( true, 'inner_bottom_margin' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Wrap Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p class="bg-box-design">
				<?php _e( 'Top/Bottom Padding', 'dynamik' ); ?>
				<input type="text" id="dynamik-wrap-tb-padding" name="dynamik[wrap_tb_padding]" value="<?php dynamik_design_options_defaults( true, 'wrap_tb_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left/Right Padding', 'dynamik' ); ?>
				<input type="text" id="dynamik-wrap-lr-padding" name="dynamik[wrap_lr_padding]" value="<?php dynamik_design_options_defaults( true, 'wrap_lr_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Inner Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p class="bg-box-design">
				<?php _e( 'Top/Bottom', 'dynamik' ); ?>
				<input type="text" id="dynamik-container-wrap-tb-padding" name="dynamik[inner_tb_padding]" value="<?php dynamik_design_options_defaults( true, 'inner_tb_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left/Right', 'dynamik' ); ?>
				<input type="text" class="dynamik-width-option" id="dynamik-container-wrap-lr-padding" name="dynamik[inner_lr_padding]" value="<?php dynamik_design_options_defaults( true, 'inner_lr_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Sidebar Separation', 'dynamik' ); ?>
				<input type="text" class="dynamik-width-option" id="dynamik-sb-separation-padding" name="dynamik[sb_separation_padding]" value="<?php dynamik_design_options_defaults( true, 'sb_separation_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
	</div>

	<div class="dynamik-not-universal" style="width:100%; float:left;">
		<div class="dynamik-optionbox-2col-left-wrap">
			<div class="dynamik-optionbox-outer-2col">
				<div class="dynamik-optionbox-inner-2col">
					<h4><?php _e( 'Site Structure Preview', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/27-site-structure-preview" class="tooltip-mark" target="_blank">[?]</a></h4>
					
					<div id="dynamik-wrap-preview"><img id="dynamik-wrap-preview-img" src=""/></div>
				</div>
			</div>
		</div>
			
		<div class="dynamik-optionbox-2col-right-wrap">
			<div class="dynamik-optionbox-outer-2col">
				<div class="dynamik-optionbox-inner-2col">
					<h4><?php _e( 'Wrap Structure Options', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/28-wrap-structure-options" class="tooltip-mark" target="_blank">[?]</a></h4>
					
					<div class="bg-box" style="float:left;">
						<p style="width:175px; float:left; margin:10px 0; line-height:170%;">
							<input type="radio" class="fixed-fluid-option" name="dynamik[wrap_structure]" value="fixed" <?php if( dynamik_get_design( 'wrap_structure' ) == 'fixed' ) echo 'checked="checked" '; ?>/><input type="hidden" value="wrap-fixed-x2"><label> <?php _e( 'Fixed Design', 'dynamik' ); ?></label>
						</p>

						<p style="width:175px; float:left; margin:10px 0; line-height:170%;">
							<input type="radio" class="fixed-fluid-option" name="dynamik[wrap_structure]" value="fluid" <?php if( dynamik_get_design( 'wrap_structure' ) == 'fluid' ) echo 'checked="checked" '; ?>/><input type="hidden" value="wrap-fluid-x2"><label> <?php _e( 'Fluid Design', 'dynamik' ); ?></label>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>