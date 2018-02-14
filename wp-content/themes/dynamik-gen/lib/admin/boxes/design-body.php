<?php
/**
 * Builds the Dynamik Body admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-body-box" class="dynamik-optionbox-outer-1col dynamik-no-universal-font-headings dynamik-no-universal-font-content dynamik-no-universal-borders dynamik-no-universal-padding dynamik-all-options<?php echo $body_display; ?>">
	<div class="dynamik-optionbox-inner-1col">
		<h3>
			<?php _e( 'Body', 'dynamik' ); ?>
		</h3>

		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option">
			<p><?php _e( 'Google Font Control', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option">
			<p class="bg-box-design">
				<span style="padding-top:5px; float: left;">
					<?php _e( 'Add Google Fonts:', 'dynamik' ); ?>
					<a href="https://fonts.google.com/" class="tooltip-mark" target="_blank">[https://fonts.google.com/]</a>
					<a href="http://dynamikdocs.cobaltapps.com/article/106-add-google-fonts" class="tooltip-mark" target="_blank">[?]</a>
				</span>
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-add-google-fonts" class="dynamik-custom-fonts-button button" style="float:none !important;">Google Fonts</span></span>
				<div style="display:none; margin:-3px 0 0;" id="show-add-google-fonts-box" class="dynamik-custom-fonts-box">
					<p style="padding:5px 0;">
						<input type="text" id="google-font-shortcode-creator" class="default-text" value="" title="Link Code goes here..." style="width:135px;" />
						<span id="google-fonts-create-sans-serif" class="google-fonts-create button" style="float:none !important;">sans-serif</span><span id="google-fonts-create-serif" class="google-fonts-create button" style="float:none !important;">serif</span><span id="google-fonts-create-cursive" class="google-fonts-create button" style="float:none !important;">cursive</span>
					</p>
					<textarea id="dynamik-add-google-fonts" name="dynamik[add_google_fonts]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'add_google_fonts' ); ?></textarea>
				</div>
			</p>
		</div>

		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option">
			<p><?php _e( 'Universal Link Transition', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option">
			<p class="bg-box-design">
				<?php _e( 'Enable Link Transition', 'dynamik' ); ?> <input type="checkbox" id="dynamik-universal-link-transition-active" name="dynamik[universal_link_transition_active]" value="1" <?php if( checked( 1, dynamik_get_design( 'universal_link_transition_active' ) ) ); ?> />
				<?php _e( 'Style', 'dynamik' ); ?> <input type="text" id="dynamik-universal-link-transition-style" name="dynamik[universal_link_transition_style]" value="<?php dynamik_design_options_defaults( true, 'universal_link_transition_style' ); ?>" style="width:220px;" />
				<a href="http://dynamikdocs.cobaltapps.com/article/24-enable-link-transition" class="tooltip-mark" target="_blank">[?]</a>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-font-option-desc dynamik-universal-font-option">
			<p><?php _e( 'Body Font', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-font-option">
			<p class="bg-box-design">
				<?php _e( 'Size', 'dynamik' ); ?>
				<input type="text" id="dynamik-body-font-size" class="dynamik-universal-child dynamik-universal-content-font-child dynamik-universal-font-size-child dynamik-universal-child-active" name="dynamik[body_font_size]" value="<?php dynamik_design_options_defaults( true, 'body_font_size' ); ?>" style="width:35px;" />
				<code class="dynamik-universal-px-em-child" id="dynamik-body-px-em"><?php echo $px_em_unit_text; ?></code>
				<?php _e( 'Line Height', 'dynamik' ); ?> <input type="text" id="dynamik-universal-line-height" name="dynamik[universal_line_height]" value="<?php dynamik_design_options_defaults( true, 'universal_line_height' ); ?>" style="width:50px;" />
				<?php _e( 'Universal Font Unit', 'dynamik' ); ?> <select id="dynamik-universal-px-em" class="universal-px-em-master" name="dynamik[universal_px_em]" size="1" style="width:55px;">
					<option value="px"<?php echo ( dynamik_get_design( 'universal_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( dynamik_get_design( 'universal_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>rem</option>
				</select> <a href="http://dynamikdocs.cobaltapps.com/article/130-universal-font-unit" class="tooltip-mark" target="_blank">[?]</a>
				<a href="http://dynamikdocs.cobaltapps.com/article/63-dynamik-design-custom-buttons" class="tooltip-mark" target="_blank">[#Custom]</a>
				<span class="dynamik-custom-fonts-button-wrap"><span id="show-body-font-css" class="dynamik-custom-fonts-button button">#Custom</span></span>
				<div style="display:none;" id="show-body-font-css-box" class="dynamik-custom-fonts-box">
				<?php _e( 'Body Font Custom CSS | <code>body { }</code>', 'dynamik' ); ?><br />
				<textarea id="dynamik-body-font-css" class="dynamik-custom-font-css dynamik-universal-child dynamik-universal-font-css-child dynamik-universal-child-active" name="dynamik[body_font_css]" style="width:100%;" rows="10"><?php echo dynamik_get_design( 'body_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc dynamik-bg-option-desc dynamik-universal-bg-option">
			<p><?php _e( 'Body Background', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option dynamik-universal-bg-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="dynamik-body-bg-type" name="dynamik[body_bg_type]" class="iewide bg-option" style="width:175px;">
					<option value="color"<?php if( dynamik_get_design( 'body_bg_type' ) == 'color' ) echo ' selected="selected"'; ?>><?php _e( 'Color', 'dynamik' ); ?></option>
					<option value="top left no-repeat"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top left no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Left)', 'dynamik' ); ?></option>
					<option value="top center no-repeat"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top center no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Center)', 'dynamik' ); ?></option>
					<option value="top right no-repeat"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top right no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Right)', 'dynamik' ); ?></option>
					<option value="top left fixed no-repeat"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top left fixed no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Left Fixed)', 'dynamik' ); ?></option>
					<option value="top center fixed no-repeat"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top center fixed no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Center Fixed)', 'dynamik' ); ?></option>
					<option value="top right fixed no-repeat"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top right fixed no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Right Fixed)', 'dynamik' ); ?></option>
					<option value="top left repeat-x"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top left repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Left)', 'dynamik' ); ?></option>
					<option value="top center repeat-x"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top center repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Center)', 'dynamik' ); ?></option>
					<option value="top right repeat-x"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top right repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Right)', 'dynamik' ); ?></option>
					<option value="top left fixed repeat-x"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top left fixed repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Left Fixed)', 'dynamik' ); ?></option>
					<option value="top center fixed repeat-x"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top center fixed repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Center Fixed)', 'dynamik' ); ?></option>
					<option value="top right fixed repeat-x"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top right fixed repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Right Fixed)', 'dynamik' ); ?></option>
					<option value="top left repeat-y"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top left repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Left)', 'dynamik' ); ?></option>
					<option value="top center repeat-y"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top center repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Center)', 'dynamik' ); ?></option>
					<option value="top right repeat-y"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top right repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Right)', 'dynamik' ); ?></option>
					<option value="top left fixed repeat-y"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top left fixed repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Left Fixed)', 'dynamik' ); ?></option>
					<option value="top center fixed repeat-y"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top center fixed repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Center Fixed)', 'dynamik' ); ?></option>
					<option value="top right fixed repeat-y"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top right fixed repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Right Fixed)', 'dynamik' ); ?></option>
					<option value="top repeat"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top repeat' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal & Vertical-Repeat Image', 'dynamik' ); ?></option>
					<option value="top fixed repeat"<?php if( dynamik_get_design( 'body_bg_type' ) == 'top fixed repeat' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal & Vertical-Repeat Image (Fixed)', 'dynamik' ); ?></option>
				</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box dynamik-universal-child dynamik-universal-bg-color-child dynamik-universal-child-active" id="dynamik-body-bg-color" name="dynamik[body_bg_color]" value="<?php dynamik_design_options_defaults( true, 'body_bg_color' ); ?>" />
				<?php _e( 'Image', 'dynamik' ); ?> <select id="dynamik-body-bg-image" name="dynamik[body_bg_image]" class="dynamik-universal-child dynamik-universal-bg-image-child dynamik-universal-child-active" size="1" style="width:175px;"><?php dynamik_list_images( dynamik_get_design( 'body_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Dynamik CSS', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design" style="padding-top:8px;">
				<input type="checkbox" id="dynamik-minify-css" name="dynamik[minify_css]" value="1" <?php if( checked( 1, dynamik_get_design( 'minify_css' ) ) ); ?> /> <?php _e( 'Minify the Dynamik Stylesheet', 'dynamik' ); ?>
				<a href="http://dynamikdocs.cobaltapps.com/article/25-minify-the-dynamik-stylesheet" class="tooltip-mark" target="_blank">[?]</a> | <a href="<?php echo dynamik_get_stylesheet_location( 'url' ) . 'dynamik.css';?>" target="_blank"><span style="font-style:underline;"><?php _e( 'Click here to view the dynamik.css stylesheet', 'dynamik' ); ?></a> 
			</p>
		</div>
		
		<?php if( file_exists( dynamik_get_active_skin_folder_path() . '/style.css' ) ) { ?>
		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Dynamik Skin CSS', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design" style="padding-top:8px;">
				<a href="<?php echo dynamik_get_active_skin_folder_url() . '/style.css';?>" target="_blank"><span style="font-style:underline;"><?php _e( 'Click here to view the active Dynamik Skin\'s style.css file', 'dynamik' ); ?></a> <a href="http://dynamikdocs.cobaltapps.com/article/222-why-may-you-want-to-reference-the-active-skins-style-css-file" class="tooltip-mark" target="_blank">[?]</a>
			</p>
		</div>
		<?php } ?>

		<div class="dynamik-design-option-desc">
			<p><?php _e( 'Font Awesome Styles', 'dynamik' ); ?></p>
		</div>
		
		<div class="dynamik-design-option">
			<p class="bg-box-design" style="padding-top:8px;">
				<input type="checkbox" id="dynamik-font-awesome-css" name="dynamik[font_awesome_css]" value="1" <?php if( checked( 1, dynamik_get_design( 'font_awesome_css' ) ) ); ?> /> <?php _e( 'Add Support For Font Awesome Icons', 'dynamik' ); ?>
				<a href="http://dynamikdocs.cobaltapps.com/article/171-add-support-for-font-awesome-icons" class="tooltip-mark" target="_blank">[?]</a> | <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><span style="font-style:underline;"><?php _e( 'Click here to view available icons', 'dynamik' ); ?></a> 
			</p>
		</div>
	</div>
</div>