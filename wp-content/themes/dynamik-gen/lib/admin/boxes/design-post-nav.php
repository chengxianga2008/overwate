<?php
/**
 * Builds the Dynamik Post Nav admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-post-nav-box" class="dynamik-optionbox-outer-1col dynamik-no-universal-font-headings dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3><?php _e( 'Post Navigation', 'dynamik' ); ?></h3>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Post Nav Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-post-nav-font-type" name="dynamik[font_type][post_nav]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['post_nav'] ); ?></select>
				<input type="text" id="dynamik-post-nav-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[post_nav_font_size]" value="<?php dynamik_design_options_defaults( true, 'post_nav_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-post-nav-px-em"><?php echo $px_em_unit_text; ?></code>
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-post-nav-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-post-nav-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Post Nav Font Custom CSS | <code>' . dynamik_html_markup( 'pagination' ) . ' a, ' . dynamik_html_markup( 'pagination' ) . ' a:visited, ' . dynamik_html_markup( 'pagination' ) . ' li a, ' . dynamik_html_markup( 'pagination' ) . ' li.disabled, ' . dynamik_html_markup( 'pagination' ) . ' li a:hover, ' . dynamik_html_markup( 'pagination' ) . ' li.active a { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-post-nav-font-css" name="dynamik[post_nav_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'post_nav_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Post Nav Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-post-nav-link-color" name="dynamik[post_nav_link_color]" value="<?php dynamik_design_options_defaults( true, 'post_nav_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-post-nav-link-hover-color" name="dynamik[post_nav_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'post_nav_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-post-nav-link-underline" name="dynamik[post_nav_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'post_nav_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'post_nav_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'post_nav_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'post_nav_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Post Nav Inactive Numeric BG', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-post-nav-numbered-inactive-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[post_nav_numbered_inactive_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'post_nav_numbered_inactive_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-post-nav-numbered-inactive-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-post-nav-numbered-inactive-bg-no-color" name="dynamik[post_nav_numbered_inactive_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'post_nav_numbered_inactive_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-post-nav-numbered-inactive-bg-color" name="dynamik[post_nav_numbered_inactive_bg_color]" value="<?php dynamik_design_options_defaults( true, 'post_nav_numbered_inactive_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-post-nav-numbered-inactive-bg-image" name="dynamik[post_nav_numbered_inactive_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'post_nav_numbered_inactive_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Post Nav Active Numeric BG', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-post-nav-numbered-active-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[post_nav_numbered_active_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'post_nav_numbered_active_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-post-nav-numbered-active-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-post-nav-numbered-active-bg-no-color" name="dynamik[post_nav_numbered_active_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'post_nav_numbered_active_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-post-nav-numbered-active-bg-color" name="dynamik[post_nav_numbered_active_bg_color]" value="<?php dynamik_design_options_defaults( true, 'post_nav_numbered_active_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-post-nav-numbered-active-bg-image" name="dynamik[post_nav_numbered_active_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'post_nav_numbered_active_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Post Nav Numeric Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-post-nav-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[post_nav_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'post_nav_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-post-nav-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[post_nav_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'post_nav_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-post-nav-border-color" name="dynamik[post_nav_border_color]" value="<?php dynamik_design_options_defaults( true, 'post_nav_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Post Nav Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Padding: Top', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-nav-padding-top" name="dynamik[post_nav_padding_top]" value="<?php echo dynamik_get_design( 'post_nav_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-nav-padding-bottom" name="dynamik[post_nav_padding_bottom]" value="<?php echo dynamik_get_design( 'post_nav_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Post Nav Numeric Margins/Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Margin: Left', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-nav-numbered-margin-left" name="dynamik[post_nav_numbered_margin_left]" value="<?php dynamik_design_options_defaults( true, 'post_nav_numbered_margin_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-nav-numbered-margin-right" name="dynamik[post_nav_numbered_margin_right]" value="<?php dynamik_design_options_defaults( true, 'post_nav_numbered_margin_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Padding: Top/Btm', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-nav-numbered-tb-padding" name="dynamik[post_nav_numbered_tb_padding]" value="<?php dynamik_design_options_defaults( true, 'post_nav_numbered_tb_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Lft/Rt', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-nav-numbered-lr-padding" name="dynamik[post_nav_numbered_lr_padding]" value="<?php dynamik_design_options_defaults( true, 'post_nav_numbered_lr_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
	</div>
</div>