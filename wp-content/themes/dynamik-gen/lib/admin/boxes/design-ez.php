<?php
/**
 * Builds the Dynamik EZ admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-<?php echo $nav_alt_id; ?>ez-box" class="dynamik-optionbox-outer-1col dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3><?php _e( 'Static Homepage EZ-Widget Areas', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/34-static-homepage-ez-widget-areas" class="tooltip-mark" target="_blank">[?]</a></h3>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Homepage Type', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p style="margin-top:4px;" class="bg-box-design">
				<input class="dynamik-homepage-type" type="radio" name="dynamik[dynamik_homepage_type]" value="default_home" <?php if( dynamik_get_design( 'dynamik_homepage_type' ) == 'default_home' ) echo 'checked="checked" '; ?>/> <label><?php _e( 'WordPress Default Homepage', 'dynamik' ); ?></label>
				<input class="dynamik-homepage-type" type="radio" name="dynamik[dynamik_homepage_type]" value="static_home" <?php if( dynamik_get_design( 'dynamik_homepage_type' ) == 'static_home' ) echo 'checked="checked" '; ?>/> <label><?php _e( 'EZ Static Homepage', 'dynamik' ); ?></label>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Static Homepage Structure', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<?php _e( 'Select A Static Homepage Layout', 'dynamik' ); ?>
				<select id="dynamik-ez-homepage-select" name="dynamik[ez_homepage_select]" size="1" style="width:250px;">
					<?php dynamik_list_ez_home_structure_options( dynamik_get_design( 'ez_homepage_select' ) ); ?>
				</select> <a href="http://dynamikdocs.cobaltapps.com/article/35-ez-static-homepage-layout-reference-examples" class="tooltip-mark" target="_blank">[<?php _e( 'Examples', 'dynamik' ); ?>]</a>
			</p>
		</div>
		
		<div class="dynamik-structure-settings-hide">
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'EZ Home Widget Heading Fonts', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-ez-widget-home-title-font-type" name="dynamik[font_type][ez_widget_home_title]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['ez_widget_home_title'] ); ?></select>
				<input type="text" id="dynamik-ez-widget-home-title-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[ez_widget_home_title_font_size]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_title_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-ez-widget-home-title-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-home-title-font-color" name="dynamik[ez_widget_home_title_font_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_title_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-ez-widget-home-title-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-home-title-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'EZ Home Heading Font Custom CSS | <code>#ez-home-container-wrap .ez-widget-area h4 { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-ez-widget-home-title-font-css" name="dynamik[ez_widget_home_title_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'ez_widget_home_title_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'EZ Home Widget Content Fonts', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-ez-widget-home-content-font-type" name="dynamik[font_type][ez_widget_home_content]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['ez_widget_home_content'] ); ?></select>
				<input type="text" id="dynamik-ez-widget-home-content-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[ez_widget_home_content_font_size]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_content_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-ez-widget-home-content-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-home-content-font-color" name="dynamik[ez_widget_home_content_font_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_content_font_color' ); ?>" />				<span class="dynamik-custom-fonts-button-wrap"><span id="show-ez-widget-home-content-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-home-content-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'EZ Home Content Font Custom CSS | <code>#ez-home-container-wrap .ez-widget-area { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-ez-widget-home-content-font-css" name="dynamik[ez_widget_home_content_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'ez_widget_home_content_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'EZ Home Widget Content Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-home-content-link-color" name="dynamik[ez_widget_home_content_link_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_content_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-home-content-link-hover-color" name="dynamik[ez_widget_home_content_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_content_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-ez-widget-home-content-link-underline" name="dynamik[ez_widget_home_content_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'ez_widget_home_content_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'ez_widget_home_content_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'ez_widget_home_content_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'ez_widget_home_content_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'EZ Home BG', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-ez-widget-home-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[ez_widget_home_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'ez_widget_home_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-ez-widget-home-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-ez-widget-home-bg-no-color" name="dynamik[ez_widget_home_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_widget_home_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-ez-widget-home-bg-color" name="dynamik[ez_widget_home_bg_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-ez-widget-home-bg-image" name="dynamik[ez_widget_home_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'ez_widget_home_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'EZ Home Heading Bottom Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'dynamik' ); ?>
				<input type="text" id="dynamik-ez-widget-home-heading-bottom-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[ez_widget_home_heading_bottom_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_heading_bottom_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-ez-widget-home-heading-bottom-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[ez_widget_home_heading_bottom_border_style]" size="1" style="width:80px;">
					<?php dynamik_list_borders( dynamik_get_design( 'ez_widget_home_heading_bottom_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-ez-widget-home-heading-bottom-border-color" name="dynamik[ez_widget_home_heading_bottom_border_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_heading_bottom_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'EZ Home Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-ez-widget-home-border-type" name="dynamik[ez_widget_home_border_type]" size="1" style="width:100px;">
					<option value="Full"<?php if (dynamik_get_design( 'ez_widget_home_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if (dynamik_get_design( 'ez_widget_home_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if (dynamik_get_design( 'ez_widget_home_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-ez-widget-home-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[ez_widget_home_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-ez-widget-home-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[ez_widget_home_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'ez_widget_home_border_style' ) ); ?>
				</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-ez-widget-home-border-color" name="dynamik[ez_widget_home_border_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Static Homepage Wrap Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Padding: Top', 'dynamik' ); ?>
				<input type="text" id="ez-widget-home-padding-top" name="dynamik[ez_widget_home_padding_top]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" class="ez-widget-home-width-option" id="ez-widget-home-padding-right" name="dynamik[ez_widget_home_padding_right]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom', 'dynamik' ); ?>
				<input type="text" id="ez-widget-home-padding-bottom" name="dynamik[ez_widget_home_padding_bottom]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left', 'dynamik' ); ?>
				<input type="text" class="ez-widget-home-width-option" id="ez-widget-home-padding-left" name="dynamik[ez_widget_home_padding_left]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_home_padding_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		</div><!-- End .dynamik-structure-settings-hide -->

		<div class="dynamik-not-universal">		
			<h3 style="margin-top:15px; float:left;"><?php _e( 'Homepage EZ-Widget Area Extras', 'dynamik' ); ?></h3>
			
			<div class="dynamik-design-option-desc">
				<p><?php _e( 'Static Homepage Sidebar', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option">
				<p style="margin-top:5px;" class="bg-box-design">
					<?php _e( 'Activate', 'dynamik' ); ?> <input type="checkbox" id="dynamik-ez-static-home-sb-display" name="dynamik[ez_static_home_sb_display]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_static_home_sb_display' ) ) ); ?> />
					<?php _e( 'Display Location', 'dynamik' ); ?> <input type="radio" name="dynamik[ez_static_home_sb_location]" value="right" <?php if (dynamik_get_design( 'ez_static_home_sb_location' ) == 'right') echo 'checked="checked" '; ?>/><label><?php _e( 'Right of Content', 'dynamik' ); ?></label>
					<input type="radio" name="dynamik[ez_static_home_sb_location]" value="left" <?php if (dynamik_get_design( 'ez_static_home_sb_location' ) == 'left') echo 'checked="checked" '; ?>/><label><?php _e( 'Left of Content', 'dynamik' ); ?></label>
				</p>
			</div>
			
			<div class="dynamik-design-option-desc">
				<p><?php _e( 'Homepage Slider', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/36-homepage-slider" class="tooltip-mark" target="_blank">[?]</a></p>
			</div>
			
			<div class="dynamik-design-option">
				<p class="bg-box-design">
					<?php _e( 'Activate', 'dynamik' ); ?> <input type="checkbox" id="dynamik-ez-home-slider-display" name="dynamik[ez_home_slider_display]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_home_slider_display' ) ) ); ?> />
					<?php _e( 'Display Location', 'dynamik' ); ?> <input type="radio" name="dynamik[ez_home_slider_location]" value="outside" <?php if (dynamik_get_design( 'ez_home_slider_location' ) == 'outside') echo 'checked="checked" '; ?>/><label><?php _e( 'Outside Sidebar', 'dynamik' ); ?></label>
					<input type="radio" name="dynamik[ez_home_slider_location]" value="inside" <?php if (dynamik_get_design( 'ez_home_slider_location' ) == 'inside') echo 'checked="checked" '; ?>/><label><?php _e( 'Inside Sidebar', 'dynamik' ); ?></label>
					<?php _e( 'Height', 'dynamik' ); ?> <input type="text" id="ez-home-slider-height" name="dynamik[ez_home_slider_height]" value="<?php dynamik_design_options_defaults( true, 'ez_home_slider_height' ); ?>" style="width:45px;" />
					<a href="http://dynamikdocs.cobaltapps.com/article/37-home-slider-display-location-reference-examples" class="tooltip-mark" target="_blank">[<?php _e( 'Examples', 'dynamik' ); ?>]</a>
				</p>
			</div>
		</div>
		
		<h3 style="margin-top:15px; float:left;"><?php _e( 'Feature Top EZ-Widget Areas', 'dynamik' ); ?></h3>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Feature Top Display Locations', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p style="margin-top:5px;" class="bg-box-design">
				<?php _e( 'Home', 'dynamik' ); ?> <input class="ez-feature-check" type="checkbox" id="dynamik-ez-feature-top-display-front-page" name="dynamik[ez_feature_top_display_front_page]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_feature_top_display_front_page' ) ) ); ?> />
				<?php _e( 'Posts', 'dynamik' ); ?> <input class="ez-feature-check" type="checkbox" id="dynamik-ez-feature-top-display-posts" name="dynamik[ez_feature_top_display_posts]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_feature_top_display_posts' ) ) ); ?> />
				<?php _e( 'Pages', 'dynamik' ); ?> <input class="ez-feature-check" type="checkbox" id="dynamik-ez-feature-top-display-pages" name="dynamik[ez_feature_top_display_pages]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_feature_top_display_pages' ) ) ); ?> />
				<?php _e( 'Archives', 'dynamik' ); ?> <input class="ez-feature-check" type="checkbox" id="dynamik-ez-feature-top-display-archives" name="dynamik[ez_feature_top_display_archives]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_feature_top_display_archives' ) ) ); ?> />
				<?php _e( 'Blog', 'dynamik' ); ?> <input class="ez-feature-check" type="checkbox" id="dynamik-ez-feature-top-display-blog" name="dynamik[ez_feature_top_display_blog]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_feature_top_display_blog' ) ) ); ?> />
				<span style="float:right;">( <span id="ez-feature-check-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Check', 'dynamik' ); ?></span> | <span id="ez-feature-uncheck-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Uncheck', 'dynamik' ); ?></span> )</span>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Feature Top Display Position', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p style="margin-top:3px;" class="bg-box-design">
				<input type="radio" name="dynamik[ez_feature_top_position]" value="inside_inner" <?php if( dynamik_get_design( 'ez_feature_top_position' ) == 'inside_inner' ) echo 'checked="checked" '; ?>/><label><?php _e( 'Inside Inner Div', 'dynamik' ); ?></label>
				<input type="radio" name="dynamik[ez_feature_top_position]" value="outside_inner" <?php if( dynamik_get_design( 'ez_feature_top_position' ) == 'outside_inner' ) echo 'checked="checked" '; ?>/><label><?php _e( 'Outside Inner Div', 'dynamik' ); ?></label>
				<a href="http://dynamikdocs.cobaltapps.com/article/75-ez-feature-top-display-position" class="tooltip-mark" target="_blank">[?]</a>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Feature Top Structure', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<?php _e( 'Select A Feature Top Layout', 'dynamik' ); ?>
				<select id="dynamik-ez-feature-top-select" name="dynamik[ez_feature_top_select]" size="1" style="width:250px;">
					<?php dynamik_list_ez_feature_top_structure_options( dynamik_get_design( 'ez_feature_top_select' ) ); ?>
				</select> <a href="http://dynamikdocs.cobaltapps.com/article/38-ez-feature-top-layout-reference-examples" class="tooltip-mark" target="_blank">[<?php _e( 'Examples', 'dynamik' ); ?>]</a>
			</p>
		</div>
		
		<div class="dynamik-structure-settings-hide">
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'Feature Top Widget Heading Fonts', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-title-font-type" name="dynamik[font_type][ez_widget_feature_title]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['ez_widget_feature_title'] ); ?></select>
				<input type="text" id="dynamik-ez-widget-feature-title-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[ez_widget_feature_title_font_size]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_title_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-ez-widget-feature-title-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-title-font-color" name="dynamik[ez_widget_feature_title_font_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_title_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-ez-widget-feature-title-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-feature-title-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'EZ Feature Top Heading Font Custom CSS | <code>#ez-feature-top-container .ez-widget-area h4 { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-title-font-css" name="dynamik[ez_widget_feature_title_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'ez_widget_feature_title_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Feature Top Widget Content Fonts', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-content-font-type" name="dynamik[font_type][ez_widget_feature_content]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['ez_widget_feature_content'] ); ?></select>
				<input type="text" id="dynamik-ez-widget-feature-content-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[ez_widget_feature_content_font_size]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_content_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-ez-widget-feature-content-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-content-font-color" name="dynamik[ez_widget_feature_content_font_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_content_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-ez-widget-feature-content-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-feature-content-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'EZ Feature Top Content Font Custom CSS | <code>#ez-feature-top-container .ez-widget-area { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-content-font-css" name="dynamik[ez_widget_feature_content_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'ez_widget_feature_content_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Feature Top Widget Content Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-content-link-color" name="dynamik[ez_widget_feature_content_link_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_content_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-content-link-hover-color" name="dynamik[ez_widget_feature_content_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_content_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-content-link-underline" name="dynamik[ez_widget_feature_content_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'ez_widget_feature_content_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'ez_widget_feature_content_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'ez_widget_feature_content_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'ez_widget_feature_content_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Feature Top Container Wrap BG', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-ez-widget-feature-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[ez_widget_feature_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'ez_widget_feature_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-ez-widget-feature-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-ez-widget-feature-bg-no-color" name="dynamik[ez_widget_feature_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_widget_feature_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-bg-color" name="dynamik[ez_widget_feature_bg_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-ez-widget-feature-bg-image" name="dynamik[ez_widget_feature_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'ez_widget_feature_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Feature Top Heading Bottom Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'dynamik' ); ?>
				<input type="text" id="dynamik-ez-widget-feature-heading-bottom-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[ez_widget_feature_heading_bottom_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_heading_bottom_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-ez-widget-feature-heading-bottom-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[ez_widget_feature_heading_bottom_border_style]" size="1" style="width:80px;">
					<?php dynamik_list_borders( dynamik_get_design( 'ez_widget_feature_heading_bottom_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-heading-bottom-border-color" name="dynamik[ez_widget_feature_heading_bottom_border_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_heading_bottom_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Feature Top Container Wrap Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-ez-widget-feature-border-type" name="dynamik[ez_widget_feature_border_type]" size="1" style="width:100px;">
					<option value="Full"<?php if (dynamik_get_design( 'ez_widget_feature_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top"<?php if (dynamik_get_design( 'ez_widget_feature_border_type' ) == 'Top') echo ' selected="selected"'; ?>><?php _e( 'Top', 'dynamik' ); ?></option>
					<option value="Bottom"<?php if (dynamik_get_design( 'ez_widget_feature_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if (dynamik_get_design( 'ez_widget_feature_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if (dynamik_get_design( 'ez_widget_feature_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-ez-widget-feature-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[ez_widget_feature_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-ez-widget-feature-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[ez_widget_feature_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'ez_widget_feature_border_style' ) ); ?>
				</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-ez-widget-feature-border-color" name="dynamik[ez_widget_feature_border_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Feature Top Container Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Padding: Top', 'dynamik' ); ?>
				<input type="text" id="ez-widget-feature-padding-top" name="dynamik[ez_widget_feature_padding_top]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" class="ez-widget-feature-width-option" id="ez-widget-feature-padding-right" name="dynamik[ez_widget_feature_padding_right]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom', 'dynamik' ); ?>
				<input type="text" id="ez-widget-feature-padding-bottom" name="dynamik[ez_widget_feature_padding_bottom]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left', 'dynamik' ); ?>
				<input type="text" class="ez-widget-feature-width-option" id="ez-widget-feature-padding-left" name="dynamik[ez_widget_feature_padding_left]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_feature_padding_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		</div><!-- End .dynamik-structure-settings-hide -->
		
		<h3 style="margin-top:15px; float:left;"><?php _e( 'Fat Footer EZ-Widget Areas', 'dynamik' ); ?></h3>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Fat Footer Display Locations', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p style="margin-top:5px;" class="bg-box-design">
				<?php _e( 'Home', 'dynamik' ); ?> <input class="ez-footer-check" type="checkbox" id="dynamik-ez-fat-footer-display-front-page" name="dynamik[ez_fat_footer_display_front_page]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_fat_footer_display_front_page' ) ) ); ?> />
				<?php _e( 'Posts', 'dynamik' ); ?> <input class="ez-footer-check" type="checkbox" id="dynamik-ez-fat-footer-display-posts" name="dynamik[ez_fat_footer_display_posts]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_fat_footer_display_posts' ) ) ); ?> />
				<?php _e( 'Pages', 'dynamik' ); ?> <input class="ez-footer-check" type="checkbox" id="dynamik-ez-fat-footer-display-pages" name="dynamik[ez_fat_footer_display_pages]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_fat_footer_display_pages' ) ) ); ?> />
				<?php _e( 'Archives', 'dynamik' ); ?> <input class="ez-footer-check" type="checkbox" id="dynamik-ez-fat-footer-display-archives" name="dynamik[ez_fat_footer_display_archives]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_fat_footer_display_archives' ) ) ); ?> />
				<?php _e( 'Blog', 'dynamik' ); ?> <input class="ez-footer-check" type="checkbox" id="dynamik-ez-fat-footer-display-blog" name="dynamik[ez_fat_footer_display_blog]" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_fat_footer_display_blog' ) ) ); ?> />
				<span style="float:right;">( <span id="ez-footer-check-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Check', 'dynamik' ); ?></span> | <span id="ez-footer-uncheck-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Uncheck', 'dynamik' ); ?></span> )</span>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Fat Footer Display Position', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p style="margin-top:3px;" class="bg-box-design">
				<input type="radio" name="dynamik[ez_fat_footer_position]" value="inside_inner" <?php if( dynamik_get_design( 'ez_fat_footer_position' ) == 'inside_inner' ) echo 'checked="checked" '; ?>/><label><?php _e( 'Inside Inner Div', 'dynamik' ); ?></label>
				<input type="radio" name="dynamik[ez_fat_footer_position]" value="outside_inner" <?php if( dynamik_get_design( 'ez_fat_footer_position' ) == 'outside_inner' ) echo 'checked="checked" '; ?>/><label><?php _e( 'Outside Inner Div', 'dynamik' ); ?></label>
				<a href="http://dynamikdocs.cobaltapps.com/article/74-ez-fat-footer-display-position" class="tooltip-mark" target="_blank">[?]</a>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Fat Footer Structure', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<?php _e( 'Select A Fat Footer Layout', 'dynamik' ); ?>
				<select id="dynamik-ez-fat-footer-select" name="dynamik[ez_fat_footer_select]" size="1" style="width:250px;">
					<?php dynamik_list_ez_fat_footer_structure_options( dynamik_get_design( 'ez_fat_footer_select' ) ); ?>
				</select> <a href="http://dynamikdocs.cobaltapps.com/article/39-ez-fat-footer-layout-reference-examples" class="tooltip-mark" target="_blank">[<?php _e( 'Examples', 'dynamik' ); ?>]</a>
			</p>
		</div>
		
		<div class="dynamik-structure-settings-hide">
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'Fat Footer Widget Heading Fonts', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-title-font-type" name="dynamik[font_type][ez_widget_footer_title]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['ez_widget_footer_title'] ); ?></select>
				<input type="text" id="dynamik-ez-widget-footer-title-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[ez_widget_footer_title_font_size]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_title_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-ez-widget-footer-title-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-title-font-color" name="dynamik[ez_widget_footer_title_font_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_title_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-ez-widget-footer-title-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-footer-title-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'EZ Fat Footer Heading Font Custom CSS | <code>#ez-fat-footer-container .ez-widget-area h4 { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-title-font-css" name="dynamik[ez_widget_footer_title_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'ez_widget_footer_title_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Fat Footer Widget Content Fonts', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-content-font-type" name="dynamik[font_type][ez_widget_footer_content]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['ez_widget_footer_content'] ); ?></select>
				<input type="text" id="dynamik-ez-widget-footer-content-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[ez_widget_footer_content_font_size]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_content_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-ez-widget-footer-content-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-content-font-color" name="dynamik[ez_widget_footer_content_font_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_content_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-ez-widget-footer-content-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-footer-content-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'EZ Fat Footer Content Font Custom CSS | <code>#ez-fat-footer-container .ez-widget-area { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-content-font-css" name="dynamik[ez_widget_footer_content_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'ez_widget_footer_content_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Fat Footer Widget Content Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-content-link-color" name="dynamik[ez_widget_footer_content_link_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_content_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-content-link-hover-color" name="dynamik[ez_widget_footer_content_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_content_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-content-link-underline" name="dynamik[ez_widget_footer_content_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if( dynamik_get_design( 'ez_widget_footer_content_link_underline' ) == 'Never' ) echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if( dynamik_get_design( 'ez_widget_footer_content_link_underline' ) == 'On Hover' ) echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if( dynamik_get_design( 'ez_widget_footer_content_link_underline' ) == 'Off Hover' ) echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if( dynamik_get_design( 'ez_widget_footer_content_link_underline' ) == 'Always' ) echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Fat Footer Container Wrap BG', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-ez-widget-footer-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[ez_widget_footer_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'ez_widget_footer_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-ez-widget-footer-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-ez-widget-footer-bg-no-color" name="dynamik[ez_widget_footer_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'ez_widget_footer_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-bg-color" name="dynamik[ez_widget_footer_bg_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-ez-widget-footer-bg-image" name="dynamik[ez_widget_footer_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'ez_widget_footer_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Fat Footer Heading Bottom Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'dynamik' ); ?>
				<input type="text" id="dynamik-ez-widget-footer-heading-bottom-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[ez_widget_footer_heading_bottom_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_heading_bottom_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-ez-widget-footer-heading-bottom-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[ez_widget_footer_heading_bottom_border_style]" size="1" style="width:80px;">
					<?php dynamik_list_borders( dynamik_get_design( 'ez_widget_footer_heading_bottom_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-heading-bottom-border-color" name="dynamik[ez_widget_footer_heading_bottom_border_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_heading_bottom_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Fat Footer Container Wrap Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-ez-widget-footer-border-type" name="dynamik[ez_widget_footer_border_type]" size="1" style="width:100px;">
					<option value="Full"<?php if( dynamik_get_design( 'ez_widget_footer_border_type' ) == 'Full' ) echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top"<?php if( dynamik_get_design( 'ez_widget_footer_border_type' ) == 'Top' ) echo ' selected="selected"'; ?>><?php _e( 'Top', 'dynamik' ); ?></option>
					<option value="Bottom"<?php if( dynamik_get_design( 'ez_widget_footer_border_type' ) == 'Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if( dynamik_get_design( 'ez_widget_footer_border_type' ) == 'Top/Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if( dynamik_get_design( 'ez_widget_footer_border_type' ) == 'Left/Right' ) echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-ez-widget-footer-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[ez_widget_footer_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-ez-widget-footer-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[ez_widget_footer_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'ez_widget_footer_border_style' ) ); ?>
				</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-ez-widget-footer-border-color" name="dynamik[ez_widget_footer_border_color]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Fat Footer Container Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Padding: Top', 'dynamik' ); ?>
				<input type="text" id="ez-widget-footer-padding-top" name="dynamik[ez_widget_footer_padding_top]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" class="ez-widget-footer-width-option" id="ez-widget-footer-padding-right" name="dynamik[ez_widget_footer_padding_right]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom', 'dynamik' ); ?>
				<input type="text" id="ez-widget-footer-padding-bottom" name="dynamik[ez_widget_footer_padding_bottom]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left', 'dynamik' ); ?>
				<input type="text" class="ez-widget-footer-width-option" id="ez-widget-footer-padding-left" name="dynamik[ez_widget_footer_padding_left]" value="<?php dynamik_design_options_defaults( true, 'ez_widget_footer_padding_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		</div><!-- End .dynamik-structure-settings-hide -->
		
	</div>
</div>