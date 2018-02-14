<?php
/**
 * Builds the Dynamik Widgets admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-widgets-box" class="dynamik-optionbox-outer-1col dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<div class="dynamik-no-universal-bgs dynamik-no-universal-borders">
			<h3><?php _e( 'Featured Post/Page Widget', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/40-featured-post-page-widget" class="tooltip-mark" target="_blank">[?]</a></h3>

			<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
				<p><?php _e( 'Featured Widget Heading Fonts', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
				<p class="bg-box-design">
					<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-featured-widget-heading-font-type" name="dynamik[font_type][featured_widget_heading]" size="1" style="width:98px;">
					<?php dynamik_build_font_menu( $dynamik_font_type['featured_widget_heading'] ); ?></select>
					<input type="text" id="dynamik-featured-widget-heading-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[featured_widget_heading_font_size]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_heading_font_size' ); ?>" style="width:35px;" />
					<code class="dynamik-universal-px-em-child" id="dynamik-featured-widget-heading-px-em"><?php echo $px_em_unit_text; ?></code>
					<span class="dynamik-custom-fonts-button-wrap"><span id="show-featured-widget-heading-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
					<div style="display:none;" id="show-featured-widget-heading-font-css-box" class="dynamik-custom-fonts-box">
					<?php _e( 'Featured Widget Heading Font Custom CSS | <code>.featuredpage .page h2, .featuredpost .post h2 { }</code>', 'dynamik' ); ?><br />
					<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-featured-widget-heading-font-css" name="dynamik[featured_widget_heading_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'featured_widget_heading_font_css' ); ?></textarea>
					</div>
				</p>
			</div>
			
			<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
				<p><?php _e( 'Featured Widget Heading Link', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
				<p class="bg-box-design">
					<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-featured-widget-heading-link-color" name="dynamik[featured_widget_heading_link_color]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_heading_link_color' ); ?>" />
					<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-featured-widget-heading-link-hover-color" name="dynamik[featured_widget_heading_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_heading_link_hover_color' ); ?>" />
					<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-featured-widget-heading-link-underline" name="dynamik[featured_widget_heading_link_underline]" size="1" style="width:90px;">
						<option value="Never"<?php if (dynamik_get_design( 'featured_widget_heading_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
						<option value="On Hover"<?php if (dynamik_get_design( 'featured_widget_heading_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
						<option value="Off Hover"<?php if (dynamik_get_design( 'featured_widget_heading_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
						<option value="Always"<?php if (dynamik_get_design( 'featured_widget_heading_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
					</select>
				</p>
			</div>
			
			<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
				<p><?php _e( 'Featured Widget Byline Fonts', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
				<p class="bg-box-design">
					<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-featured-widget-byline-font-type" name="dynamik[font_type][featured_widget_byline]" size="1" style="width:98px;">
					<?php dynamik_build_font_menu( $dynamik_font_type['featured_widget_byline'] ); ?></select>
					<input type="text" id="dynamik-featured-widget-byline-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[featured_widget_byline_font_size]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_byline_font_size' ); ?>" style="width:35px;" />
					<code class="dynamik-universal-px-em-child" id="dynamik-featured-widget-byline-px-em"><?php echo $px_em_unit_text; ?></code>
					<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-featured-widget-byline-font-color" name="dynamik[featured_widget_byline_font_color]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_byline_font_color' ); ?>" />
					<span class="dynamik-custom-fonts-button-wrap"><span id="show-featured-widget-byline-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
					<div style="display:none;" id="show-featured-widget-byline-font-css-box" class="dynamik-custom-fonts-box">
					<?php _e( 'Featured Widget Byline Font Custom CSS<code>.featuredpage .page ' . dynamik_html_markup( 'entry_header_entry_meta' ) . ', .featuredpost .post ' . dynamik_html_markup( 'entry_header_entry_meta' ) . ' {}</code>', 'dynamik' ); ?><br />
					<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-featured-widget-byline-font-css" name="dynamik[featured_widget_byline_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'featured_widget_byline_font_css' ); ?></textarea>
					</div>
				</p>
			</div>
			
			<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
				<p><?php _e( 'Featured Widget Byline Link', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
				<p class="bg-box-design">
					<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-featured-widget-byline-link-color" name="dynamik[featured_widget_byline_link_color]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_byline_link_color' ); ?>" />
					<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-featured-widget-byline-link-hover-color" name="dynamik[featured_widget_byline_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_byline_link_hover_color' ); ?>" />
					<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-featured-widget-byline-link-underline" name="dynamik[featured_widget_byline_link_underline]" size="1" style="width:90px;">
						<option value="Never"<?php if (dynamik_get_design( 'featured_widget_byline_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
						<option value="On Hover"<?php if (dynamik_get_design( 'featured_widget_byline_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
						<option value="Off Hover"<?php if (dynamik_get_design( 'featured_widget_byline_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
						<option value="Always"<?php if (dynamik_get_design( 'featured_widget_byline_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
					</select>
				</p>
			</div>
			
			<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
				<p><?php _e( 'Featured Widget Paragraph Fonts', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
				<p class="bg-box-design">
					<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-featured-widget-p-font-type" name="dynamik[font_type][featured_widget_p]" size="1" style="width:98px;">
					<?php dynamik_build_font_menu( $dynamik_font_type['featured_widget_p'] ); ?></select>
					<input type="text" id="dynamik-featured-widget-p-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[featured_widget_p_font_size]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_p_font_size' ); ?>" style="width:35px;" />
					<code class="dynamik-universal-px-em-child" id="dynamik-featured-widget-p-px-em"><?php echo $px_em_unit_text; ?></code>
					<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-featured-widget-p-font-color" name="dynamik[featured_widget_p_font_color]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_p_font_color' ); ?>" />
					<span class="dynamik-custom-fonts-button-wrap"><span id="show-featured-widget-p-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
					<div style="display:none;" id="show-featured-widget-p-font-css-box" class="dynamik-custom-fonts-box">
					<?php _e( 'Featured Widget Paragraph Font Custom CSS | <code>.featuredpage .page p, .featuredpost .post p { }</code>', 'dynamik' ); ?><br />
					<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-featured-widget-p-font-css" name="dynamik[featured_widget_p_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'featured_widget_p_font_css' ); ?></textarea>
					</div>
				</p>
			</div>
			
			<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
				<p><?php _e( 'Featured Widget Paragraph Link', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
				<p class="bg-box-design">
					<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-featured-widget-p-link-color" name="dynamik[featured_widget_p_link_color]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_p_link_color' ); ?>" />
					<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-featured-widget-p-link-hover-color" name="dynamik[featured_widget_p_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_p_link_hover_color' ); ?>" />
					<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-featured-widget-p-link-underline" name="dynamik[featured_widget_p_link_underline]" size="1" style="width:90px;">
						<option value="Never"<?php if( dynamik_get_design( 'featured_widget_p_link_underline' ) == 'Never' ) echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
						<option value="On Hover"<?php if( dynamik_get_design( 'featured_widget_p_link_underline' ) == 'On Hover' ) echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
						<option value="Off Hover"<?php if( dynamik_get_design( 'featured_widget_p_link_underline' ) == 'Off Hover' ) echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
						<option value="Always"<?php if( dynamik_get_design( 'featured_widget_p_link_underline' ) == 'Always' ) echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
					</select>
				</p>
			</div>
			
			<div class="dynamik-design-standard-hide">
			
			<div class="dynamik-design-option-desc dynamik-universal-padding-option">
				<p><?php _e( 'Featured Widget Margins', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option dynamik-universal-padding-option">
				<p>
					<?php _e( 'Margin: Top', 'dynamik' ); ?>
					<input type="text" id="dynamik-featured-widget-margin-top" name="dynamik[featured_widget_margin_top]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_margin_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Right', 'dynamik' ); ?>
					<input type="text" id="dynamik-featured-widget-margin-right" name="dynamik[featured_widget_margin_right]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_margin_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Bottom', 'dynamik' ); ?>
					<input type="text" id="dynamik-featured-widget-margin-bottom" name="dynamik[featured_widget_margin_bottom]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_margin_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Left', 'dynamik' ); ?>
					<input type="text" id="dynamik-featured-widget-margin-left" name="dynamik[featured_widget_margin_left]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_margin_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				</p>
			</div>
			
			<div class="dynamik-design-option-desc dynamik-universal-padding-option">
				<p><?php _e( 'Featured Widget Padding', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option dynamik-universal-padding-option">
				<p>
					<?php _e( 'Padding: Top', 'dynamik' ); ?>
					<input type="text" id="dynamik-featured-widget-padding-top" name="dynamik[featured_widget_padding_top]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Right', 'dynamik' ); ?>
					<input type="text" id="dynamik-featured-widget-padding-right" name="dynamik[featured_widget_padding_right]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Bottom', 'dynamik' ); ?>
					<input type="text" id="dynamik-featured-widget-padding-bottom" name="dynamik[featured_widget_padding_bottom]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Left', 'dynamik' ); ?>
					<input type="text" id="dynamik-featured-widget-padding-left" name="dynamik[featured_widget_padding_left]" value="<?php dynamik_design_options_defaults( true, 'featured_widget_padding_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				</p>
			</div>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		<h3 style="margin-top:15px; float:left;"><?php _e( 'Custom Widget Areas', 'dynamik' ); ?>
		<span style="color:#777777;">( <?php _e( 'Column Class Compatible', 'dynamik' ); ?>
		<input type="checkbox" id="dynamik-design-widget-column-class-compatible" name="dynamik[dynamik_widget_column_class_compatible]" value="1" <?php if( checked( 1, dynamik_get_design( 'dynamik_widget_column_class_compatible' ) ) ); ?> /> )</span>
		<a href="http://dynamikdocs.cobaltapps.com/article/41-custom-widget-areas-column-class-compatible" class="tooltip-mark" target="_blank">[?]</a></h3>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'Custom Widget Heading Fonts', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-design-widget-title-font-type" name="dynamik[font_type][dynamik_widget_title]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['dynamik_widget_title'] ); ?></select>
				<input type="text" id="dynamik-design-widget-title-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[dynamik_widget_title_font_size]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_title_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-design-widget-title-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-design-widget-title-font-color" name="dynamik[dynamik_widget_title_font_color]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_title_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-dynamik-widget-title-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-dynamik-widget-title-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Text Widget Content Font Custom CSS | <code>.dynamik-widget-area h4 { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-design-widget-title-font-css" name="dynamik[dynamik_widget_title_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'dynamik_widget_title_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Custom Widget Content Fonts', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-design-widget-content-font-type" name="dynamik[font_type][dynamik_widget_content]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['dynamik_widget_content'] ); ?></select>
				<input type="text" id="dynamik-design-widget-content-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[dynamik_widget_content_font_size]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_content_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-design-widget-content-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-design-widget-content-font-color" name="dynamik[dynamik_widget_content_font_color]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_content_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-dynamik-widget-content-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-dynamik-widget-content-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Text Widget Content Font Custom CSS | <code>.dynamik-widget-area { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-design-widget-content-font-css" name="dynamik[dynamik_widget_content_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'dynamik_widget_content_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Custom Widget Content Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-design-widget-content-link-color" name="dynamik[dynamik_widget_content_link_color]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_content_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-design-widget-content-link-hover-color" name="dynamik[dynamik_widget_content_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_content_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-design-widget-content-link-underline" name="dynamik[dynamik_widget_content_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'dynamik_widget_content_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'dynamik_widget_content_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'dynamik_widget_content_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'dynamik_widget_content_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Custom Widget Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-design-widget-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[dynamik_widget_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'dynamik_widget_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-design-widget-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-design-widget-bg-no-color" name="dynamik[dynamik_widget_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'dynamik_widget_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-design-widget-bg-color" name="dynamik[dynamik_widget_bg_color]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-design-widget-bg-image" name="dynamik[dynamik_widget_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'dynamik_widget_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Custom Widget Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-design-widget-border-type" name="dynamik[dynamik_widget_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (dynamik_get_design( 'dynamik_widget_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top"<?php if (dynamik_get_design( 'dynamik_widget_border_type' ) == 'Top') echo ' selected="selected"'; ?>><?php _e( 'Top', 'dynamik' ); ?></option>
					<option value="Bottom"<?php if (dynamik_get_design( 'dynamik_widget_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'dynamik' ); ?></option>
					<option value="Left"<?php if (dynamik_get_design( 'dynamik_widget_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'dynamik' ); ?></option>
					<option value="Right"<?php if (dynamik_get_design( 'dynamik_widget_border_type' ) == 'Right') echo ' selected="selected"'; ?>><?php _e( 'Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-design-widget-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[dynamik_widget_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-design-widget-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[dynamik_widget_border_style]" size="1" style="width:95px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'dynamik_widget_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-design-widget-border-color" name="dynamik[dynamik_widget_border_color]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Custom Widget Width', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option column-class-compatible-toggle">
			<p>
				<?php _e( 'Widget Width', 'dynamik' ); ?>
				<input type="text" id="dynamik-widget-width" name="dynamik[dynamik_widget_width]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_width' ); ?>" style="width:50px;" /><?php _e( ' |', 'dynamik' ); ?>
				<?php _e( '( Blank = No Set Width )', 'dynamik' ); ?>
				<?php _e( 'Widget Float', 'dynamik' ); ?> <select id="dynamik-widget-float" name="dynamik[dynamik_widget_float]" size="1" style="width:65px;">
					<option value="none"<?php if( dynamik_get_design( 'dynamik_widget_float' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'dynamik' ); ?></option>
					<option value="left"<?php if( dynamik_get_design( 'dynamik_widget_float' ) == 'left' ) echo ' selected="selected"'; ?>><?php _e( 'Left', 'dynamik' ); ?></option>
					<option value="right"<?php if( dynamik_get_design( 'dynamik_widget_float' ) == 'right' ) echo ' selected="selected"'; ?>><?php _e( 'Right', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Custom Widget Margins', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option column-class-compatible-toggle">
			<p>
				<?php _e( 'Margin: Top', 'dynamik' ); ?>
				<input type="text" id="dynamik-widget-margin-top" name="dynamik[dynamik_widget_margin_top]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_margin_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" id="dynamik-widget-margin-right" name="dynamik[dynamik_widget_margin_right]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_margin_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom', 'dynamik' ); ?>
				<input type="text" id="dynamik-widget-margin-bottom" name="dynamik[dynamik_widget_margin_bottom]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_margin_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left', 'dynamik' ); ?>
				<input type="text" id="dynamik-widget-margin-left" name="dynamik[dynamik_widget_margin_left]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_margin_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Custom Widget Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option column-class-compatible-toggle">
			<p>
				<?php _e( 'Padding: Top', 'dynamik' ); ?>
				<input type="text" id="dynamik-widget-padding-top" name="dynamik[dynamik_widget_padding_top]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" id="dynamik-widget-padding-right" name="dynamik[dynamik_widget_padding_right]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom', 'dynamik' ); ?>
				<input type="text" id="dynamik-widget-padding-bottom" name="dynamik[dynamik_widget_padding_bottom]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left', 'dynamik' ); ?>
				<input type="text" id="dynamik-widget-padding-left" name="dynamik[dynamik_widget_padding_left]" value="<?php dynamik_design_options_defaults( true, 'dynamik_widget_padding_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
	</div>
</div>