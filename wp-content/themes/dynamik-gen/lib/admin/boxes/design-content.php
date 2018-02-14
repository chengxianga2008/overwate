<?php
/**
 * Builds the Dynamik Content admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-content-box" class="dynamik-optionbox-outer-1col dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3><?php _e( 'Content', 'dynamik' ); ?></h3>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'Content Heading Font', 'dynamik' ); ?></p>
		</div>

		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( 'H1 - H6 Font Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-content-heading-font-type" name="dynamik[font_type][content_heading]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['content_heading'] ); ?></select>
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-content-heading-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-content-heading-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Content Heading Font Custom CSS | <code>' . dynamik_html_markup( 'content' ) . ' .post h1, ' . dynamik_html_markup( 'content' ) . ' .post h2, ' . dynamik_html_markup( 'content' ) . ' .post h3, ' . dynamik_html_markup( 'content' ) . ' .post h4, ' . dynamik_html_markup( 'content' ) . ' .post h5, ' . dynamik_html_markup( 'content' ) . ' .post h6, ' . dynamik_html_markup( 'content' ) . ' .page h1, ' . dynamik_html_markup( 'content' ) . ' .page h2, ' . dynamik_html_markup( 'content' ) . ' .page h3, ' . dynamik_html_markup( 'content' ) . ' .page h4, ' . dynamik_html_markup( 'content' ) . ' .page h5, ' . dynamik_html_markup( 'content' ) . ' .page h6 { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-content-heading-font-css" name="dynamik[content_heading_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'content_heading_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'Content Heading Font Sizes H1-H2', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( 'H1', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-heading-h1-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[content_heading_h1_font_size]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h1_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-content-heading-h1-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'H2', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-heading-h2-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[content_heading_h2_font_size]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h2_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-content-heading-h2-px-em"><?php echo $px_em_unit_text; ?></code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'Content Heading Font Sizes H3-H6', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( 'H3', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-heading-h3-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[content_heading_h3_font_size]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h3_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-content-heading-h3-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'H4', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-heading-h4-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[content_heading_h4_font_size]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h4_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-content-heading-h4-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'H5', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-heading-h5-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[content_heading_h5_font_size]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h5_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-content-heading-h5-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'H6', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-heading-h6-font-size" class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[content_heading_h6_font_size]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h6_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-content-heading-h6-px-em"><?php echo $px_em_unit_text; ?></code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'Content Heading Font Colors H1-H2', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( '(H1)', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-heading-h1-font-color" name="dynamik[content_heading_h1_font_color]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h1_font_color' ); ?>" />
				<?php _e( '(H2)', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-heading-h2-font-color" name="dynamik[content_heading_h2_font_color]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h2_font_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'Content Heading Font Colors H3-H6', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( '(H3)', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-heading-h3-font-color" name="dynamik[content_heading_h3_font_color]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h3_font_color' ); ?>" />
				<?php _e( '(H4)', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-heading-h4-font-color" name="dynamik[content_heading_h4_font_color]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h4_font_color' ); ?>" />
				<?php _e( '(H5)', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-heading-h5-font-color" name="dynamik[content_heading_h5_font_color]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h5_font_color' ); ?>" />
				<?php _e( '(H6)', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-heading-h6-font-color" name="dynamik[content_heading_h6_font_color]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h6_font_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p><?php _e( 'Content Heading Link Options H1/H2', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-heading">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-heading-h2-link-color" name="dynamik[content_heading_h2_link_color]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h2_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-heading-h2-hover-color" name="dynamik[content_heading_h2_hover_color]" value="<?php dynamik_design_options_defaults( true, 'content_heading_h2_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-heading-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-content-heading-h2-link-underline" name="dynamik[content_heading_h2_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'content_heading_h2_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'content_heading_h2_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'content_heading_h2_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'content_heading_h2_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Content Byline Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-content-byline-font-type" name="dynamik[font_type][content_byline]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['content_byline'] ); ?></select>
				<?php _e( 'Size', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-byline-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[content_byline_font_size]" value="<?php dynamik_design_options_defaults( true, 'content_byline_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-content-byline-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-byline-font-color" name="dynamik[content_byline_font_color]" value="<?php dynamik_design_options_defaults( true, 'content_byline_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-content-byline-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-content-byline-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Content Post Info Font Custom CSS | <code>.post-info { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-content-byline-font-css" name="dynamik[content_byline_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'content_byline_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Content Byline Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-byline-link-color" name="dynamik[content_byline_link_color]" value="<?php dynamik_design_options_defaults( true, 'content_byline_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-byline-link-hover-color" name="dynamik[content_byline_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'content_byline_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-content-byline-link-underline" name="dynamik[content_byline_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'content_byline_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'content_byline_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'content_byline_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'content_byline_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Content Paragraph Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-content-p-font-type" name="dynamik[font_type][content_p]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['content_p'] ); ?></select>
				<?php _e( 'Size', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-p-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[content_p_font_size]" value="<?php dynamik_design_options_defaults( true, 'content_p_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-content-p-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-p-font-color" name="dynamik[content_p_font_color]" value="<?php dynamik_design_options_defaults( true, 'content_p_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-content-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-content-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Content Paragraph Font Custom CSS | <code>.entry-content p, .entry-content ul li, .entry-content ol li { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-content-p-font-css" name="dynamik[content_p_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'content_p_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Content Paragraph Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-p-link-color" name="dynamik[content_p_link_color]" value="<?php dynamik_design_options_defaults( true, 'content_p_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-content-p-link-hover-color" name="dynamik[content_p_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'content_p_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-content-p-link-underline" name="dynamik[content_p_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'content_p_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'content_p_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'content_p_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'content_p_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Blockquote Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-blockquote-font-type" name="dynamik[font_type][blockquote]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['blockquote'] ); ?></select>
				<?php _e( 'Size', 'dynamik' ); ?>
				<input type="text" id="dynamik-blockquote-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[blockquote_font_size]" value="<?php dynamik_design_options_defaults( true, 'blockquote_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-blockquote-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-blockquote-font-color" name="dynamik[blockquote_font_color]" value="<?php dynamik_design_options_defaults( true, 'blockquote_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-blockquote-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-blockquote-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Blockquote Font Custom CSS | <code>' . dynamik_html_markup( 'content' ) . ' blockquote p { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-blockquote-font-css" name="dynamik[blockquote_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'blockquote_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Blockquote Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-blockquote-link-color" name="dynamik[blockquote_link_color]" value="<?php dynamik_design_options_defaults( true, 'blockquote_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-blockquote-link-hover-color" name="dynamik[blockquote_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'blockquote_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-blockquote-link-underline" name="dynamik[blockquote_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'blockquote_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'blockquote_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'blockquote_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'blockquote_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Image Caption Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-caption-font-type" name="dynamik[font_type][caption]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['caption'] ); ?></select>
				<?php _e( 'Size', 'dynamik' ); ?>
				<input type="text" id="dynamik-caption-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[caption_font_size]" value="<?php dynamik_design_options_defaults( true, 'caption_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-caption-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-caption-font-color" name="dynamik[caption_font_color]" value="<?php dynamik_design_options_defaults( true, 'caption_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-caption-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-caption-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Image Caption Font Custom CSS | <code>p.wp-caption-text { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-caption-font-css" name="dynamik[caption_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'caption_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Post-Meta Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-type-child dynamik-universal-child-active" id="dynamik-post-meta-font-type" name="dynamik[font_type][post_meta]" size="1" style="width:98px;">
				<?php dynamik_build_font_menu( $dynamik_font_type['post_meta'] ); ?></select>
				<?php _e( 'Size', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-meta-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[post_meta_font_size]" value="<?php dynamik_design_options_defaults( true, 'post_meta_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-post-meta-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Color', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-post-meta-font-color" name="dynamik[post_meta_font_color]" value="<?php dynamik_design_options_defaults( true, 'post_meta_font_color' ); ?>" />
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-post-meta-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-post-meta-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Post-Meta Font Custom CSS | <code>' . dynamik_html_markup( 'entry_footer_entry_meta' ) . ' { }</code>', 'dynamik' ); ?><br />
				<textarea class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-css-child dynamik-universal-child-active" id="dynamik-post-meta-font-css" name="dynamik[post_meta_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'post_meta_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option dynamik-universal-font-option-content">
			<p><?php _e( 'Post-Meta Link', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option dynamik-universal-font-option-content">
			<p class="bg-box-design">
				<?php _e( 'Link', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-post-meta-link-color" name="dynamik[post_meta_link_color]" value="<?php dynamik_design_options_defaults( true, 'post_meta_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'dynamik' ); ?><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-hover-color-child dynamik-universal-font-color-option-child dynamik-universal-child-active" id="dynamik-post-meta-link-hover-color" name="dynamik[post_meta_link_hover_color]" value="<?php dynamik_design_options_defaults( true, 'post_meta_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'dynamik' ); ?> <select class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-link-underline-child dynamik-universal-child-active" id="dynamik-post-meta-link-underline" name="dynamik[post_meta_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (dynamik_get_design( 'post_meta_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'dynamik' ); ?></option>
					<option value="On Hover"<?php if (dynamik_get_design( 'post_meta_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'dynamik' ); ?></option>
					<option value="Off Hover"<?php if (dynamik_get_design( 'post_meta_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'dynamik' ); ?></option>
					<option value="Always"<?php if (dynamik_get_design( 'post_meta_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Post Content Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-post-content-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[post_content_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'post_content_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-post-content-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-post-content-bg-no-color" name="dynamik[post_content_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'post_content_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-post-content-bg-color" name="dynamik[post_content_bg_color]" value="<?php dynamik_design_options_defaults( true, 'post_content_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-post-content-bg-image" name="dynamik[post_content_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'post_content_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Page Content Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-page-content-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[page_content_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'page_content_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-page-content-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-page-content-bg-no-color" name="dynamik[page_content_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'page_content_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-page-content-bg-color" name="dynamik[page_content_bg_color]" value="<?php dynamik_design_options_defaults( true, 'page_content_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-page-content-bg-image" name="dynamik[page_content_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'page_content_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Sticky Post Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-sticky-post-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[sticky_post_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'sticky_post_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-sticky-post-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-sticky-post-bg-no-color" name="dynamik[sticky_post_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'sticky_post_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-sticky-post-bg-color" name="dynamik[sticky_post_bg_color]" value="<?php dynamik_design_options_defaults( true, 'sticky_post_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-sticky-post-bg-image" name="dynamik[sticky_post_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'sticky_post_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Blockquote Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-blockquote-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[blockquote_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'blockquote_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-blockquote-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-blockquote-bg-no-color" name="dynamik[blockquote_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'blockquote_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-blockquote-bg-color" name="dynamik[blockquote_bg_color]" value="<?php dynamik_design_options_defaults( true, 'blockquote_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-blockquote-bg-image" name="dynamik[blockquote_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'blockquote_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Image Caption Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-caption-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[caption_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'caption_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-caption-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-caption-bg-no-color" name="dynamik[caption_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'caption_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-caption-bg-color" name="dynamik[caption_bg_color]" value="<?php dynamik_design_options_defaults( true, 'caption_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-caption-bg-image" name="dynamik[caption_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'caption_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Thumbnail Image Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-thumbnail-bg-type" class="dynamik-bg-type dynamik-universal-child dynamik-universal-bg-type-child dynamik-universal-child-active" name="dynamik[thumbnail_bg_type]" size="1" style="width:145px;">
				<?php dynamik_list_bg_options( dynamik_get_design( 'thumbnail_bg_type' ) ); ?>
				</select> <span style="display:none;" id="dynamik-thumbnail-bg-type-checkbox" class="dynamik-universal-child dynamik-bg-type-checkbox dynamik-universal-child-active"><?php _e( '(No Color', 'dynamik' ); ?> <input type="checkbox" id="dynamik-thumbnail-bg-no-color" name="dynamik[thumbnail_bg_no_color]" class="dynamik-universal-child dynamik-universal-bg-no-color-child dynamik-universal-child-active" value="1" <?php if( checked( 1, dynamik_get_design( 'thumbnail_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-thumbnail-bg-color" name="dynamik[thumbnail_bg_color]" value="<?php dynamik_design_options_defaults( true, 'thumbnail_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-thumbnail-bg-image" name="dynamik[thumbnail_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:150px;"><?php dynamik_list_images( dynamik_get_design( 'thumbnail_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Post Content Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-post-content-border-type" name="dynamik[post_content_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (dynamik_get_design( 'post_content_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if (dynamik_get_design( 'post_content_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Bottom"<?php if (dynamik_get_design( 'post_content_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'dynamik' ); ?></option>
					<option value="Left"<?php if (dynamik_get_design( 'post_content_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'dynamik' ); ?></option>
					<option value="Right"<?php if (dynamik_get_design( 'post_content_border_type' ) == 'Right') echo ' selected="selected"'; ?>><?php _e( 'Right', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if (dynamik_get_design( 'post_content_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-content-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[post_content_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'post_content_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-post-content-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[post_content_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'post_content_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-post-content-border-color" name="dynamik[post_content_border_color]" value="<?php dynamik_design_options_defaults( true, 'post_content_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Page Content Border', 'dynamik' ); ?></p>
		</div>

		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-page-content-border-type" name="dynamik[page_content_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (dynamik_get_design( 'page_content_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if (dynamik_get_design( 'page_content_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Bottom"<?php if (dynamik_get_design( 'page_content_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'dynamik' ); ?></option>
					<option value="Left"<?php if (dynamik_get_design( 'page_content_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'dynamik' ); ?></option>
					<option value="Right"<?php if (dynamik_get_design( 'page_content_border_type' ) == 'Right') echo ' selected="selected"'; ?>><?php _e( 'Right', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if (dynamik_get_design( 'page_content_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?>
				<input type="text" id="dynamik-page-content-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[page_content_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'page_content_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-page-content-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[page_content_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'page_content_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-page-content-border-color" name="dynamik[page_content_border_color]" value="<?php dynamik_design_options_defaults( true, 'page_content_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Sticky Post Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-sticky-post-border-type" name="dynamik[sticky_post_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (dynamik_get_design( 'sticky_post_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if (dynamik_get_design( 'sticky_post_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Bottom"<?php if (dynamik_get_design( 'sticky_post_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'dynamik' ); ?></option>
					<option value="Left"<?php if (dynamik_get_design( 'sticky_post_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if (dynamik_get_design( 'sticky_post_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-sticky-post-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[sticky_post_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'sticky_post_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-sticky_post-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[sticky_post_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'sticky_post_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-sticky-post-border-color" name="dynamik[sticky_post_border_color]" value="<?php dynamik_design_options_defaults( true, 'sticky_post_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Blockquote Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-blockquote-border-type" name="dynamik[blockquote_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (dynamik_get_design( 'blockquote_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
					<option value="Top/Bottom"<?php if (dynamik_get_design( 'blockquote_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'dynamik' ); ?></option>
					<option value="Top"<?php if (dynamik_get_design( 'blockquote_border_type' ) == 'Top') echo ' selected="selected"'; ?>><?php _e( 'Top', 'dynamik' ); ?></option>
					<option value="Bottom"<?php if (dynamik_get_design( 'blockquote_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'dynamik' ); ?></option>
					<option value="Left"<?php if (dynamik_get_design( 'blockquote_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'dynamik' ); ?></option>
					<option value="Left/Right"<?php if (dynamik_get_design( 'blockquote_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'dynamik' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'dynamik' ); ?> <input type="text" id="dynamik-blockquote-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[blockquote_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'blockquote_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-blockquote-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[blockquote_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php dynamik_list_borders( dynamik_get_design( 'blockquote_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-blockquote-border-color" name="dynamik[blockquote_border_color]" value="<?php dynamik_design_options_defaults( true, 'blockquote_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Image Caption Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'dynamik' ); ?>
				<input type="text" id="dynamik-caption-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[caption_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'caption_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-caption-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[caption_border_style]" size="1" style="width:80px;">
					<?php dynamik_list_borders( dynamik_get_design( 'caption_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-caption-border-color" name="dynamik[caption_border_color]" value="<?php dynamik_design_options_defaults( true, 'caption_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Thumbnail Image Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'dynamik' ); ?>
				<input type="text" id="dynamik-thumbnail-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[thumbnail_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'thumbnail_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-thumbnail-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[thumbnail_border_style]" size="1" style="width:80px;">
					<?php dynamik_list_borders( dynamik_get_design( 'thumbnail_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-thumbnail-border-color" name="dynamik[thumbnail_border_color]" value="<?php dynamik_design_options_defaults( true, 'thumbnail_border_color' ); ?>" />
				<span class="dynamik-design-standard-hide">
				<?php _e( 'Padding', 'dynamik' ); ?>
				<input type="text" id="dynamik-thumbnail-image-padding" name="dynamik[thumbnail_image_padding]" value="<?php dynamik_design_options_defaults( true, 'thumbnail_image_padding' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				</span><!-- End .dynamik-design-standard-hide -->
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-border-option-desc dynamik-universal-border-option">
			<p><?php _e( 'Content Bottom Border', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-border-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'dynamik' ); ?>
				<input type="text" id="dynamik-cc-bottom-border-thickness" class="dynamik-universal-child dynamik-universal-border-thickness-child dynamik-universal-child-active" name="dynamik[cc_bottom_border_thickness]" value="<?php dynamik_design_options_defaults( true, 'cc_bottom_border_thickness' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Style', 'dynamik' ); ?> <select id="dynamik-cc-bottom-border-style" class="dynamik-universal-child dynamik-universal-border-style-child dynamik-universal-child-active" name="dynamik[cc_bottom_border_style]" size="1" style="width:80px;">
					<?php dynamik_list_borders( dynamik_get_design( 'cc_bottom_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-border-color-child dynamik-universal-child-active" id="dynamik-cc-bottom-border-color" name="dynamik[cc_bottom_border_color]" value="<?php dynamik_design_options_defaults( true, 'cc_bottom_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Content Wrap Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Padding: Top', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-padding-top" name="dynamik[content_padding_top]" value="<?php dynamik_design_options_defaults( true, 'content_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" class="dynamik-width-option" id="dynamik-content-padding-right" name="dynamik[content_padding_right]" value="<?php dynamik_design_options_defaults( true, 'content_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-padding-bottom" name="dynamik[content_padding_bottom]" value="<?php dynamik_design_options_defaults( true, 'content_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left', 'dynamik' ); ?>
				<input type="text" class="dynamik-width-option" id="dynamik-content-padding-left" name="dynamik[content_padding_left]" value="<?php dynamik_design_options_defaults( true, 'content_padding_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Post Content Margins', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Top Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-content-margin-top" name="dynamik[post_content_margin_top]" value="<?php dynamik_design_options_defaults( true, 'post_content_margin_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-content-margin-bottom" name="dynamik[post_content_margin_bottom]" value="<?php dynamik_design_options_defaults( true, 'post_content_margin_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Post Content Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Padding: Top', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-content-padding-top" name="dynamik[post_content_padding_top]" value="<?php dynamik_design_options_defaults( true, 'post_content_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-content-padding-right" name="dynamik[post_content_padding_right]" value="<?php dynamik_design_options_defaults( true, 'post_content_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-content-padding-bottom" name="dynamik[post_content_padding_bottom]" value="<?php dynamik_design_options_defaults( true, 'post_content_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left', 'dynamik' ); ?>
				<input type="text" id="dynamik-post-content-padding-left" name="dynamik[post_content_padding_left]" value="<?php dynamik_design_options_defaults( true, 'post_content_padding_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Page Content Margins', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Top Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-page-content-margin-top" name="dynamik[page_content_margin_top]" value="<?php dynamik_design_options_defaults( true, 'page_content_margin_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-page-content-margin-bottom" name="dynamik[page_content_margin_bottom]" value="<?php dynamik_design_options_defaults( true, 'page_content_margin_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Page Content Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Padding: Top', 'dynamik' ); ?>
				<input type="text" id="dynamik-page-content-padding-top" name="dynamik[page_content_padding_top]" value="<?php dynamik_design_options_defaults( true, 'page_content_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" id="dynamik-page-content-padding-right" name="dynamik[page_content_padding_right]" value="<?php dynamik_design_options_defaults( true, 'page_content_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom', 'dynamik' ); ?>
				<input type="text" id="dynamik-page-content-padding-bottom" name="dynamik[page_content_padding_bottom]" value="<?php dynamik_design_options_defaults( true, 'page_content_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left', 'dynamik' ); ?>
				<input type="text" id="dynamik-page-content-padding-left" name="dynamik[page_content_padding_left]" value="<?php dynamik_design_options_defaults( true, 'page_content_padding_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Sticky Post Margins', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Top Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-sticky-post-margin-top" name="dynamik[sticky_post_margin_top]" value="<?php dynamik_design_options_defaults( true, 'sticky_post_margin_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-sticky-post-margin-bottom" name="dynamik[sticky_post_margin_bottom]" value="<?php dynamik_design_options_defaults( true, 'sticky_post_margin_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Sticky Post Padding', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Padding: Top', 'dynamik' ); ?>
				<input type="text" id="dynamik-sticky-post-padding-top" name="dynamik[sticky_post_padding_top]" value="<?php dynamik_design_options_defaults( true, 'sticky_post_padding_top' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" id="dynamik-sticky-post-padding-right" name="dynamik[sticky_post_padding_right]" value="<?php dynamik_design_options_defaults( true, 'sticky_post_padding_right' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Bottom', 'dynamik' ); ?>
				<input type="text" id="dynamik-sticky-post-padding-bottom" name="dynamik[sticky_post_padding_bottom]" value="<?php dynamik_design_options_defaults( true, 'sticky_post_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'Left', 'dynamik' ); ?>
				<input type="text" id="dynamik-sticky-post-padding-left" name="dynamik[sticky_post_padding_left]" value="<?php dynamik_design_options_defaults( true, 'sticky_post_padding_left' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-universal-padding-option">
			<p><?php _e( 'Paragraph / List-Style Spacing', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-padding-option">
			<p>
				<?php _e( 'Paragraph Bottom Margin', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-paragraph-margin-bottom" name="dynamik[content_paragraph_margin_bottom]" value="<?php dynamik_design_options_defaults( true, 'content_paragraph_margin_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
				<?php _e( 'List-Style Bottom Padding', 'dynamik' ); ?>
				<input type="text" id="dynamik-content-list-style-padding-bottom" name="dynamik[content_list_style_padding_bottom]" value="<?php dynamik_design_options_defaults( true, 'content_list_style_padding_bottom' ); ?>" style="width:35px;" /><code class="dynamik-px-unit">px</code>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Content List Style Type', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<?php _e( 'Content List Style', 'dynamik' ); ?>
				<select id="dynamik-content-list-style" name="dynamik[content_list_style]" size="1" style="width:70px;">
					<option value="none"<?php if (dynamik_get_design( 'content_list_style' ) == 'none') echo ' selected="selected"'; ?>><?php _e( 'none', 'dynamik' ); ?></option>
					<option value="disc"<?php if (dynamik_get_design( 'content_list_style' ) == 'disc') echo ' selected="selected"'; ?>><?php _e( 'disc', 'dynamik' ); ?></option>
					<option value="circle"<?php if (dynamik_get_design( 'content_list_style' ) == 'circle') echo ' selected="selected"'; ?>><?php _e( 'circle', 'dynamik' ); ?></option>
					<option value="square"<?php if (dynamik_get_design( 'content_list_style' ) == 'square') echo ' selected="selected"'; ?>><?php _e( 'square', 'dynamik' ); ?></option>
				</select>
			</p>
		</div>

		<div class="dynamik-design-option-desc">
			<p>
				<?php _e( 'Content Filler Image', 'dynamik' ); ?>
				<a href="http://dynamikdocs.cobaltapps.com/article/265-content-filler-image" class="tooltip-mark" target="_blank">[?]</a>
			</p>
		</div>

		<div class="dynamik-design-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?>
				<select id="dynamik-content-filler-image-type" class="dynamik-content-filler-image-type" name="dynamik[content_filler_image_type]" size="1" style="width:75px;">
					<option value="Disabled"<?php if( dynamik_get_design( 'content_filler_image_type' ) == 'Disabled' ) echo ' selected="selected"'; ?>><?php _e( 'Disabled', 'dynamik' ); ?></option>
					<option value="Minimal"<?php if( dynamik_get_design( 'content_filler_image_type' ) == 'Minimal' ) echo ' selected="selected"'; ?>><?php _e( 'Minimal', 'dynamik' ); ?></option>
					<option value="Full"<?php if( dynamik_get_design( 'content_filler_image_type' ) == 'Full' ) echo ' selected="selected"'; ?>><?php _e( 'Full', 'dynamik' ); ?></option>
				</select>
				<span style="display: none;" id="dynamik-content-filler-image-type-options">
					<?php _e( 'Filler Color Type', 'dynamik' ); ?>
					<select id="dynamik-content-filler-image-background-type" class="dynamik-content-filler-image-background-type" name="dynamik[content_filler_image_background_type]" size="1" style="width:95px;">
						<option value="Transparent"<?php if( dynamik_get_design( 'content_filler_image_background_type' ) == 'Transparent' ) echo ' selected="selected"'; ?>><?php _e( 'Transparent', 'dynamik' ); ?></option>
						<option value="Color"<?php if( dynamik_get_design( 'content_filler_image_background_type' ) == 'Color' ) echo ' selected="selected"'; ?>><?php _e( 'Color', 'dynamik' ); ?></option>
					</select>
					<span style="display: none;" id="dynamik-content-filler-image-background-type-options">
						<?php _e( 'Filler Color', 'dynamik' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="dynamik-content-filler-image-background-color" name="dynamik[content_filler_image_background_color]" value="<?php dynamik_design_options_defaults( true, 'content_filler_image_background_color' ); ?>" />
					</span>
				</span>
			</p>
		</div>
	</div>
</div>