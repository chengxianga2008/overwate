<?php
/**
 * Builds the Dynamik Header admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-header-box" class="dynamik-optionbox-outer-1col dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3><?php _e( 'Header | Logo', 'dynamik' ); ?></h3>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'Header Title Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-title-font-type" name="dynamik[font_type][title]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['title'] ); ?></select>
				<?php _e( 'Size', 'dynamik' ); ?>
				<input type="text" id="dynamik-title-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[title_font_size]" value="<?php dynamik_design_options_defaults( true, 'title_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-title-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-title-font-color" name="dynamik[title_font_color]" value="<?php dynamik_design_options_defaults( true, 'title_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-title-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-title-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Title Font Custom CSS | <code>' . dynamik_html_markup( 'site_title' ) . ' { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-title-font-css" name="dynamik[title_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'title_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'Header Title Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( 'Link Hover Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-title-link-color" name="dynamik[title_link_color]" value="<?php dynamik_design_options_defaults( true, 'title_link_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-title-link-underline" name="dynamik[title_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'title_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'title_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'title_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'title_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Header Tagline Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-tagline-font-type" name="dynamik[font_type][tagline]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['tagline'] ); ?></select>
				<?php _e( 'Size', 'dynamik' ); ?>
				<input type="text" id="dynamik-tagline-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[tagline_font_size]" value="<?php dynamik_design_options_defaults( true, 'tagline_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-tagline-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-tagline-font-color" name="dynamik[tagline_font_color]" value="<?php dynamik_design_options_defaults( true, 'tagline_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-tagline-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-tagline-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Tagline Font Custom CSS | <code>' . dynamik_html_markup( 'site_description' ) . ' { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-tagline-font-css" name="dynamik[tagline_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'tagline_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Header Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-header-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[header_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'header_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-header-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-header-bg-no-color" name="dynamik[header_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'header_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-header-bg-color" name="dynamik[header_bg_color]" value="<?php dynamik_design_options_defaults( true, 'header_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-header-bg-image" name="dynamik[header_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'header_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Header Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-header-border-type" name="dynamik[header_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if( dynamik_get_design( 'header_border_type' ) == 'Full' ) echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if( dynamik_get_design( 'header_border_type' ) == 'Top/Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Top"<?php if( dynamik_get_design( 'header_border_type' ) == 'Top' ) echo ' selected="selected"'; ?>><?php _e( 'Top', 'dynamik' ); ?></option>
					<option value="Bottom"<?php if( dynamik_get_design( 'header_border_type' ) == 'Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if( dynamik_get_design( 'header_border_type' ) == 'Left/Right' ) echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-header-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[header_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'header_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-header-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[header_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'header_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-header-border-color" name="dynamik[header_border_color]" value="<?php dynamik_design_options_defaults( true, 'header_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Fixed Header Options', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<?php _e( 'Fixed "Sticky" Header', 'dynamik' ); ?> <select id="dynamik-fixed-header" name="dynamik[fixed_header]" size="1" style="width:98px;">
					<option value="disabled"<?php if( dynamik_get_design( 'fixed_header' ) == 'disabled' ) echo ' selected="selected"'; ?>><?php _e( 'Disabled', 'dynamik' ); ?></option>
					<option value="fixed"<?php if( dynamik_get_design( 'fixed_header' ) == 'fixed' ) echo ' selected="selected"'; ?>><?php _e( 'Fixed', 'dynamik' ); ?></option>
					<option value="fadein"<?php if( dynamik_get_design( 'fixed_header' ) == 'fadein' ) echo ' selected="selected"'; ?>><?php _e( 'Fade-In', 'dynamik' ); ?></option>
				</select>
				<a href="http://dynamikdocs.cobaltapps.com/article/266-fixed-header-options" class="tooltip-mark" target="_blank">[?]</a>
			</p>
		</div>

		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Header Dimensions', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<?php _e( 'Header Minimum Height', 'dynamik' ); ?> <input type="text" id="dynamik-header-height" name="dynamik[header_height]" value="<?php dynamik_design_options_defaults( true, 'header_height' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Select Logo Alignment/Type', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design" style="padding-top:8px;">
				<?php _e( 'Center Title Area/Logo', 'dynamik' ); ?> <input type="checkbox" id="dynamik-header-title-area-center" name="dynamik[header_title_area_center]" value="1" <?php if( checked( 1, dynamik_get_design( 'header_title_area_center' ) ) ); ?> />
				<a href="http://dynamikdocs.cobaltapps.com/article/263-center-title-area-logo" class="tooltip-mark" target="_blank">[?]</a>
				(<?php _e( 'Select a Logo Type', 'dynamik' ); ?>
				<b><a href="<?php echo admin_url( 'admin.php?page=genesis' ); ?>"><?php _e( 'HERE', 'dynamik' ); ?></a></b>)
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Select Logo Image', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<?php _e( 'Logo Image', 'dynamik' ); ?> <select id="dynamik-logo-image" name="dynamik[logo_image]" size="1" style="width:175px;"><?php dynamik_list_images( dynamik_get_design( 'logo_image' ) ); ?></select>
				<?php _e( 'Add Retina-Ready Logo', 'dynamik' ); ?> <input type="checkbox" id="dynamik-retina-logo-active" name="dynamik[retina_logo_active]" value="1" <?php if( checked( 1, dynamik_get_design( 'retina_logo_active' ) ) ); ?> />
				<a href="http://dynamikdocs.cobaltapps.com/article/29-add-retina-ready-logo" class="tooltip-mark" target="_blank">[?]</a>
			</p>
		</div>

		<div style="display:none;" class="dynamik-design-option-desc dynamik-retina-logo-active-box">
			<p><?php _e( 'Select Retina Logo Image', 'dynamik' ); ?></p>
		</div>
		
		<div style="display:none;" class="dynamik-design-option dynamik-retina-logo-active-box">
			<p class="bg-box-design">
				<?php _e( 'Retina Logo Image', 'dynamik' ); ?> <select id="dynamik-retina-logo-image" name="dynamik[retina_logo_image]" size="1" style="width:175px;"><?php dynamik_list_images( dynamik_get_design( 'retina_logo_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Header Title Area Dimensions', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<?php _e( 'Title Area Width', 'dynamik' ); ?>
				<?php if( genesis_get_option( 'blog_title' ) == 'text' ) { ?>
					<span class="dynamik-header-title-area-center-box"><input type="text" id="dynamik-header-title-area-width" name="dynamik[header_title_area_width]" value="<?php dynamik_design_options_defaults( true, 'header_title_area_width' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code></span>
					<code class="dynamik-header-title-area-center-box-show">100%</code>
				<?php } else { ?>
					<input type="text" id="dynamik-header-title-area-width" name="dynamik[header_title_area_width]" value="<?php dynamik_design_options_defaults( true, 'header_title_area_width' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php } ?>
				<?php _e( 'Title Area Height (Image Logo Only)', 'dynamik' ); ?> <input type="text" id="dynamik-header-title-area-height" name="dynamik[header_title_area_height]" value="<?php dynamik_design_options_defaults( true, 'header_title_area_height' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<a href="http://dynamikdocs.cobaltapps.com/article/264-header-title-area-dimensions" class="tooltip-mark" target="_blank">[?]</a>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Header Text Title Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p class="bg-box-design">
				<?php _e( 'Top Padding', 'dynamik' ); ?> <input type="text" id="dynamik-text-logo-top-padding" name="dynamik[text_logo_top_padding]" value="<?php dynamik_design_options_defaults( true, 'text_logo_top_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<span class="dynamik-header-title-area-center-box"><?php _e( 'Left Padding', 'dynamik' ); ?> <input type="text" id="dynamik-text-logo-left-padding" name="dynamik[text_logo_left_padding]" value="<?php dynamik_design_options_defaults( true, 'text_logo_left_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code></span>
				<?php _e( 'Tagline Top Padding', 'dynamik' ); ?> <input type="text" id="dynamik-tagline-top-padding" name="dynamik[tagline_top_padding]" value="<?php dynamik_design_options_defaults( true, 'tagline_top_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Header Image Logo Margins', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p class="bg-box-design">
				<?php _e( 'Top Margin', 'dynamik' ); ?> <input type="text" id="dynamik-image-logo-top-margin" name="dynamik[image_logo_top_margin]" value="<?php dynamik_design_options_defaults( true, 'image_logo_top_margin' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom Margin', 'dynamik' ); ?> <input type="text" id="dynamik-image-logo-bottom-margin" name="dynamik[image_logo_bottom_margin]" value="<?php dynamik_design_options_defaults( true, 'image_logo_bottom_margin' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<span class="dynamik-header-title-area-center-box"><?php _e( 'Left Margin', 'dynamik' ); ?> <input type="text" id="dynamik-image-logo-left-margin" name="dynamik[image_logo_left_margin]" value="<?php dynamik_design_options_defaults( true, 'image_logo_left_margin' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code></span>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option dynamik-header-title-area-center-box">
			<p><?php _e( 'Header Widget Area Styles', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option dynamik-header-title-area-center-box">
			<p class="bg-box-design">
				<?php _e( 'Width', 'dynamik' ); ?> <input type="text" id="dynamik-header-widget-width" name="dynamik[header_widget_width]" value="<?php dynamik_design_options_defaults( true, 'header_widget_width' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Top Padding', 'dynamik' ); ?> <input type="text" id="dynamik-header-widget-top-padding" name="dynamik[header_widget_top_padding]" value="<?php dynamik_design_options_defaults( true, 'header_widget_top_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right Padding', 'dynamik' ); ?> <input type="text" id="dynamik-header-widget-right-padding" name="dynamik[header_widget_right_padding]" value="<?php dynamik_design_options_defaults( true, 'header_widget_right_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Text Align', 'dynamik' ); ?> <select id="dynamik-header-widget-text-align" name="dynamik[header_widget_text_align]" size="1" style="width:65px;">
					<option value="left"<?php if( dynamik_get_design( 'header_widget_text_align' ) == 'left' ) echo ' selected="selected"'; ?>><?php _e( 'Left', 'dynamik' ); ?></option>
					<option value="right"<?php if( dynamik_get_design( 'header_widget_text_align' ) == 'right' ) echo ' selected="selected"'; ?>><?php _e( 'Right', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
	</div>
</div>