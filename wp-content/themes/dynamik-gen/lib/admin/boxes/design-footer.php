<?php
/**
 * Builds the Dynamik Footer admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-footer-box" class="dynamik-optionbox-outer-1col dynamik-no-universal-font-headings dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3><?php _e( 'Footer', 'dynamik' ); ?></h3>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Footer Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-footer-font-type" name="dynamik[font_type][footer]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['footer'] ); ?></select>
				<input type="text" id="dynamik-footer-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[footer_font_size]" value="<?php dynamik_design_options_defaults( true, 'footer_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-footer-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-footer-font-color" name="dynamik[footer_font_color]" value="<?php dynamik_design_options_defaults( true, 'footer_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-footer-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-footer-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Footer Font Custom CSS | <code>' . dynamik_html_markup( 'site_footer' ) . ' p { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-footer-font-css" name="dynamik[footer_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'footer_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Footer Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-footer-link-color" name="dynamik[footer_link_color]" value="<?php dynamik_design_options_defaults( true, 'footer_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-footer-link-hover-color" name="dynamik[footer_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'footer_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-footer-link-underline" name="dynamik[footer_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'footer_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'footer_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'footer_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'footer_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Footer Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-footer-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[footer_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'footer_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-footer-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-footer-bg-no-color" name="dynamik[footer_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'footer_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-footer-bg-color" name="dynamik[footer_bg_color]" value="<?php dynamik_design_options_defaults( true, 'footer_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-footer-bg-image" name="dynamik[footer_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'footer_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Footer Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-footer-border-type" name="dynamik[footer_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if( dynamik_get_design( 'footer_border_type' ) == 'Full' ) echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if( dynamik_get_design( 'footer_border_type' ) == 'Top/Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Top"<?php if( dynamik_get_design( 'footer_border_type' ) == 'Top' ) echo ' selected="selected"'; ?>><?php _e( 'Top', 'dynamik' ); ?></option>
					<option value="Bottom"<?php if( dynamik_get_design( 'footer_border_type' ) == 'Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if( dynamik_get_design( 'footer_border_type' ) == 'Left/Right' ) echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-footer-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[footer_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'footer_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-footer-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[footer_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'footer_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-footer-border-color" name="dynamik[footer_border_color]" value="<?php dynamik_design_options_defaults( true, 'footer_border_color' ); ?>" />
			</p>
		</div>

		<?php $html_five_active = current_theme_supports( 'html5' ) ? ' style="display:none;"' : ''; ?>
		
		<div class="dynamik-design-option-desc"<?php echo $html_five_active; ?>>
			<p><?php _e( 'Footer Dimensions', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option"<?php echo $html_five_active; ?>>
			<p>
				<?php _e( '"Go To Top" Width', 'dynamik' ); ?>
				<input type="text" id="dynamik-footer-gototop-width" name="dynamik[footer_gototop_width]" value="<?php dynamik_design_options_defaults( true, 'footer_gototop_width' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Footer Credits Width', 'dynamik' ); ?>
				<input type="text" id="dynamik-footer-creds-width" name="dynamik[footer_creds_width]" value="<?php dynamik_design_options_defaults( true, 'footer_creds_width' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Footer Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Padding: Top', 'dynamik' ); ?>
				<input type="text" id="dynamik-footer-padding-top" name="dynamik[footer_padding_top]" value="<?php dynamik_design_options_defaults( true, 'footer_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" id="dynamik-footer-padding-right" name="dynamik[footer_padding_right]" value="<?php dynamik_design_options_defaults( true, 'footer_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom', 'dynamik' ); ?>
				<input type="text" id="dynamik-footer-padding-bottom" name="dynamik[footer_padding_bottom]" value="<?php dynamik_design_options_defaults( true, 'footer_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left', 'dynamik' ); ?>
				<input type="text" id="dynamik-footer-padding-left" name="dynamik[footer_padding_left]" value="<?php dynamik_design_options_defaults( true, 'footer_padding_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
	</div>
</div>