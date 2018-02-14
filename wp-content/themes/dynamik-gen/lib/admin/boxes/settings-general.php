<?php
/**
 * Builds the Dynamik General Settings admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-theme-settings-nav-general-box" class="dynamik-all-options">
	<h3 style="margin-bottom:15px; float:left;"><?php _e( 'General Settings', 'dynamik' ); ?></h3>

	<div class="dynamik-optionbox-2col-left-wrap">
		
		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Page Titles', 'dynamik' ); ?></h4>
				
				<div class="bg-box">	
					<p>
						<input type="checkbox" id="dynamik-remove-all-page-titles" name="dynamik[remove_all_page_titles]" value="1" <?php if( checked( 1, dynamik_get_settings( 'remove_all_page_titles' ) ) ); ?> /> <?php _e( 'Remove All Page Titles', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/12-remove-page-titles" class="tooltip-mark" target="_blank">[?]</a>
					</p>
					
					<p style="display:none;" id="dynamik-remove-all-page-titles-box">
						<?php _e( 'Remove Specific Page Titles By IDs: (ie. 2,17 etc.)', 'dynamik' ); ?> <span id="content-page-ids" class="tooltip-mark">[IDs]</span><br />
						<input type="text" id="dynamik-remove-page-titles-ids" name="dynamik[remove_page_titles_ids]" value="<?php echo dynamik_get_settings( 'remove_page_titles_ids' )?>" style="width:100%;" />
					</p>
					
					<div id="content-page-ids-box" style="display:none;">
						<h5 style="margin-bottom:-10px;"><?php _e( 'Page ID Reference:', 'dynamik' ); ?></h5>
						<p class="page-cat-id-scrollbox">
							<?php $pages = get_pages('orderby=ID&hide_empty=0');
							echo '<strong>Page IDs/Names</strong><br />'; 
								foreach($pages as $page) { 
									echo $page->ID . ' = ' . $page->post_name . '<br />'; 
								} ?>
						</p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Custom Post Types', 'dynamik' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<input type="checkbox" id="dynamik-include-inpost-cpt-all" name="dynamik[include_inpost_cpt_all]" value="1" <?php if( checked( 1, dynamik_get_settings( 'include_inpost_cpt_all' ) ) ); ?> /> <?php _e( 'Include Theme In-Post Options With All Custom Post Types', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/13-include-theme-in-post-options-with-all-custom-post-types" class="tooltip-mark" target="_blank">[?]</a>
					</p>

					<div style="display:none;" id="dynamik-include-inpost-cpt-all-box">
						<p>
							<?php _e( 'Include Theme In-Post Options With Specific Custom Post Types', 'dynamik' ); ?>
							<a href="http://dynamikdocs.cobaltapps.com/article/15-include-theme-in-post-options-with-specific-custom-post-types" class="tooltip-mark" target="_blank">[?]</a>
						</p>
						
						<p>
							<?php _e( 'Add Custom Post Type Names Below: (ie. products,recipes etc.)', 'dynamik' ); ?> <span id="custom-post-type-names" class="tooltip-mark">[Names]</span><br />
							<input type="text" id="dynamik-include-inpost-cpt-names" name="dynamik[include_inpost_cpt_names]" value="<?php echo dynamik_get_settings( 'include_inpost_cpt_names' )?>" style="width:100%;" />
						</p>
						
						<div id="custom-post-type-names-box" style="display:none;">
							<h5 style="margin-bottom:-10px;"><?php _e( 'Custom Post Type Name Reference', 'dynamik' ); ?></h5>
							<p class="page-cat-id-scrollbox">
							<?php
							$args=array(
								'public'   => true,
								'_builtin' => false
							);
							$output = 'names';
							$operator = 'and';
							$post_types = get_post_types( $args, $output, $operator ); 
							echo '<strong>Custom Post Type Names:</strong><br />'; 
							foreach( $post_types as $post_type )
							{
								echo '- ' . $post_type . '<br />';
							} ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'WordPress Post Formats', 'dynamik' ); ?></h4>
				
				<div class="bg-box">	
					<p>
						<input type="checkbox" id="dynamik-post-formats-active" name="dynamik[post_formats_active]" value="1" <?php if( checked( 1, dynamik_get_settings( 'post_formats_active' ) ) ); ?> /> <?php _e( 'Activate WordPress Post Formats', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/16-activate-wordpress-post-formats" class="tooltip-mark" target="_blank">[?]</a>
					</p>
				</div>
			</div>
		</div>

		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Dynamik Protected Folders', 'dynamik' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Protect Specific Folders From Dynamik Auto-Updates', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/104-protect-specific-folders-from-dynamik-auto-updates" class="tooltip-mark" target="_blank">[?]</a>
					</p>
					<p>
						<?php _e( 'Add Protected Folder Names Below: (ie. folder-1,folder-2 etc.)', 'dynamik' ); ?><br />
						<input type="text" id="dynamik-protected-folders" name="dynamik[protected_folders]" value="<?php echo dynamik_get_settings( 'protected_folders' ) ?>" style="width:100%;" />
					</p>
				</div>
			</div>
		</div>
		
		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Responsive Design', 'dynamik' ); ?></h4>
				<div class="bg-box">
					<p>
						<input type="checkbox" id="dynamik-responsive-enabled" name="dynamik[responsive_enabled]" value="1" <?php if( checked( 1, dynamik_get_settings( 'responsive_enabled' ) ) ); ?> /> <?php _e( 'Enable Responsive Design Options In Dynamik.', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/17-enable-responsive-design-options-in-dynamik" class="tooltip-mark" target="_blank">[?]</a>
					</p>
				</div>
			</div>
		</div>
		
		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Dynamik URL Protocols', 'dynamik' ); ?></h4>
				
				<div class="bg-box">	
					<p>
						<input type="checkbox" id="dynamik-protocol-relative-urls" name="dynamik[protocol_relative_urls]" value="1" <?php if( checked( 1, dynamik_get_settings( 'protocol_relative_urls' ) ) ); ?> /> <?php _e( 'Enable Protocol Relative URLs', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/162-enable-protocol-relative-urls" class="tooltip-mark" target="_blank">[?]</a>
					</p>
				</div>
			</div>
		</div>
		
		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Ace Editor Options', 'dynamik' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<input type="checkbox" id="dynamik-enable-ace-editor-syntax-validation" name="dynamik[enable_ace_editor_syntax_validation]" value="1" <?php if ( checked( 1, dynamik_get_settings( 'enable_ace_editor_syntax_validation' ) ) ); ?> /> <?php _e( 'Enable Ace Editor Syntax Validation Checking?', 'dynamik' ); ?>
					</p>
				</div>
			</div>
		</div>
		
		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Design Options Control', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/18-design-options-control" class="tooltip-mark" target="_blank">[?]</a></h4>
				
				<div class="bg-box">
					<p>
						<input type="radio" class="design-level-option" name="dynamik[design_options_control]" value="structure_settings" <?php if( dynamik_get_settings( 'design_options_control' ) == 'structure_settings' ) echo 'checked="checked" '; ?>/><label> <?php _e( 'Structure & Settings', 'dynamik' ); ?></label>
						<input type="radio" class="design-level-option" name="dynamik[design_options_control]" value="design_standard" <?php if( dynamik_get_settings( 'design_options_control' ) == 'design_standard' ) echo 'checked="checked" '; ?>/><label> <?php _e( 'Design Standard', 'dynamik' ); ?></label>
						<input type="radio" class="design-level-option" name="dynamik[design_options_control]" value="kitchen_sink" <?php if( dynamik_get_settings( 'design_options_control' ) == 'kitchen_sink' ) echo 'checked="checked" '; ?>/><label> <?php _e( 'Kitchen Sink', 'dynamik' ); ?></label>
					</p>
				</div>
			</div>
		</div>
		
	</div>
	<div class="dynamik-optionbox-2col-right-wrap">
		
		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Custom Thumbnail Sizes', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/19-custom-thumbnail-sizes" class="tooltip-mark" target="_blank">[?]</a></h4>
					
				<div class="bg-box">
					<p>
						<strong><?php _e( 'Please Note The Following For Proper Use:', 'dynamik' ); ?></strong>
					</p>
					<p>
						<?php _e( '- The "Mode" value must be set for the Custom Thumbnail to work.', 'dynamik' ); ?>
					</p>
					
					<p>
						<?php _e( '- custom-thumb-1 must be set in order for thumb-2 through 5 to work.', 'dynamik' ); ?>
					</p>
				</div>
				<div class="bg-box">
					<p>
						<strong><?php _e( 'custom-thumb-1', 'dynamik' ); ?></strong>
					</p>
					<p>
						<?php _e( 'Mode', 'dynamik' ); ?>
						<select id="dynamik-custom-image-size-one-mode" name="dynamik[custom_image_size_one_mode]" size="1" style="width:70px;">
							<option value="">&nbsp;</option>
							<option value="resize"<?php if( dynamik_get_settings( 'custom_image_size_one_mode' ) == 'resize' ) echo ' selected="selected"'; ?>><?php _e( 'Resize', 'dynamik' ); ?></option>
							<option value="crop"<?php if( dynamik_get_settings( 'custom_image_size_one_mode' ) == 'crop' ) echo ' selected="selected"'; ?>><?php _e( 'Crop', 'dynamik' ); ?></option>
						</select>
						<?php _e( 'Width', 'dynamik' ); ?> <input type="text" id="dynamik-custom-image-size-one-width" name="dynamik[custom_image_size_one_width]" value="<?php echo dynamik_get_settings( 'custom_image_size_one_width' ) ?>" style="width:50px;" /><code class="dynamik-px-unit">px</code> | 
						<?php _e( 'Height', 'dynamik' ); ?> <input type="text" id="dynamik-custom-image-size-one-height" name="dynamik[custom_image_size_one_height]" value="<?php echo dynamik_get_settings( 'custom_image_size_one_height' ) ?>" style="width:50px;" /><code class="dynamik-px-unit">px</code>
					</p>
				</div>
				<div class="bg-box">
					<p>
						<strong><?php _e( 'custom-thumb-2', 'dynamik' ); ?></strong>
					</p>
					<p>
						<?php _e( 'Mode', 'dynamik' ); ?>
						<select id="dynamik-custom-image-size-two-mode" name="dynamik[custom_image_size_two_mode]" size="1" style="width:70px;">
							<option value="">&nbsp;</option>
							<option value="resize"<?php if( dynamik_get_settings( 'custom_image_size_two_mode' ) == 'resize' ) echo ' selected="selected"'; ?>><?php _e( 'Resize', 'dynamik' ); ?></option>
							<option value="crop"<?php if( dynamik_get_settings( 'custom_image_size_two_mode' ) == 'crop' ) echo ' selected="selected"'; ?>><?php _e( 'Crop', 'dynamik' ); ?></option>
						</select>
						<?php _e( 'Width', 'dynamik' ); ?> <input type="text" id="dynamik-custom-image-size-two-width" name="dynamik[custom_image_size_two_width]" value="<?php echo dynamik_get_settings( 'custom_image_size_two_width' ) ?>" style="width:50px;" /><code class="dynamik-px-unit">px</code> | 
						<?php _e( 'Height', 'dynamik' ); ?> <input type="text" id="dynamik-custom-image-size-two-height" name="dynamik[custom_image_size_two_height]" value="<?php echo dynamik_get_settings( 'custom_image_size_two_height' ) ?>" style="width:50px;" /><code class="dynamik-px-unit">px</code>
					</p>
				</div>
				<div class="bg-box">
					<p>
						<strong><?php _e( 'custom-thumb-3', 'dynamik' ); ?></strong>
					</p>
					<p>
						<?php _e( 'Mode', 'dynamik' ); ?>
						<select id="dynamik-custom-image-size-three-mode" name="dynamik[custom_image_size_three_mode]" size="1" style="width:70px;">
							<option value="">&nbsp;</option>
							<option value="resize"<?php if( dynamik_get_settings( 'custom_image_size_three_mode' ) == 'resize' ) echo ' selected="selected"'; ?>><?php _e( 'Resize', 'dynamik' ); ?></option>
							<option value="crop"<?php if( dynamik_get_settings( 'custom_image_size_three_mode' ) == 'crop' ) echo ' selected="selected"'; ?>><?php _e( 'Crop', 'dynamik' ); ?></option>
						</select>
						<?php _e( 'Width', 'dynamik' ); ?> <input type="text" id="dynamik-custom-image-size-three-width" name="dynamik[custom_image_size_three_width]" value="<?php echo dynamik_get_settings( 'custom_image_size_three_width' ) ?>" style="width:50px;" /><code class="dynamik-px-unit">px</code> | 
						<?php _e( 'Height', 'dynamik' ); ?> <input type="text" id="dynamik-custom-image-size-three-height" name="dynamik[custom_image_size_three_height]" value="<?php echo dynamik_get_settings( 'custom_image_size_three_height' ) ?>" style="width:50px;" /><code class="dynamik-px-unit">px</code>
					</p>
				</div>
				<div class="bg-box">
					<p>
						<strong><?php _e( 'custom-thumb-4', 'dynamik' ); ?></strong>
					</p>
					<p>
						<?php _e( 'Mode', 'dynamik' ); ?>
						<select id="dynamik-custom-image-size-four-mode" name="dynamik[custom_image_size_four_mode]" size="1" style="width:70px;">
							<option value="">&nbsp;</option>
							<option value="resize"<?php if( dynamik_get_settings( 'custom_image_size_four_mode' ) == 'resize' ) echo ' selected="selected"'; ?>><?php _e( 'Resize', 'dynamik' ); ?></option>
							<option value="crop"<?php if( dynamik_get_settings( 'custom_image_size_four_mode' ) == 'crop' ) echo ' selected="selected"'; ?>><?php _e( 'Crop', 'dynamik' ); ?></option>
						</select>
						<?php _e( 'Width', 'dynamik' ); ?> <input type="text" id="dynamik-custom-image-size-four-width" name="dynamik[custom_image_size_four_width]" value="<?php echo dynamik_get_settings( 'custom_image_size_four_width' ) ?>" style="width:50px;" /><code class="dynamik-px-unit">px</code> | 
						<?php _e( 'Height', 'dynamik' ); ?> <input type="text" id="dynamik-custom-image-size-four-height" name="dynamik[custom_image_size_four_height]" value="<?php echo dynamik_get_settings( 'custom_image_size_four_height' ) ?>" style="width:50px;" /><code class="dynamik-px-unit">px</code>
					</p>
				</div>
				<div class="bg-box">
					<p>
						<strong><?php _e( 'custom-thumb-5', 'dynamik' ); ?></strong>
					</p>
					<p>
						<?php _e( 'Mode', 'dynamik' ); ?>
						<select id="dynamik-custom-image-size-five-mode" name="dynamik[custom_image_size_five_mode]" size="1" style="width:70px;">
							<option value="">&nbsp;</option>
							<option value="resize"<?php if( dynamik_get_settings( 'custom_image_size_five_mode' ) == 'resize' ) echo ' selected="selected"'; ?>><?php _e( 'Resize', 'dynamik' ); ?></option>
							<option value="crop"<?php if( dynamik_get_settings( 'custom_image_size_five_mode' ) == 'crop' ) echo ' selected="selected"'; ?>><?php _e( 'Crop', 'dynamik' ); ?></option>
						</select>
						<?php _e( 'Width', 'dynamik' ); ?> <input type="text" id="dynamik-custom-image-size-five-width" name="dynamik[custom_image_size_five_width]" value="<?php echo dynamik_get_settings( 'custom_image_size_five_width' ) ?>" style="width:50px;" /><code class="dynamik-px-unit">px</code> | 
						<?php _e( 'Height', 'dynamik' ); ?> <input type="text" id="dynamik-custom-image-size-five-height" name="dynamik[custom_image_size_five_height]" value="<?php echo dynamik_get_settings( 'custom_image_size_five_height' ) ?>" style="width:50px;" /><code class="dynamik-px-unit">px</code>
					</p>
				</div>
			</div>
		</div>

		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Genesis Column Classes', 'dynamik' ); ?></h4>
				
				<div class="bg-box">	
					<p>
						<input type="checkbox" id="dynamik-bootstrap-column-classes-active" name="dynamik[bootstrap_column_classes_active]" value="1" <?php if( checked( 1, dynamik_get_settings( 'bootstrap_column_classes_active' ) ) ); ?> /> <?php _e( 'Enable Genesis "Twitter Bootstrap" Column Classes', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/20-enable-genesis-twitter-bootstrap-column-classes" class="tooltip-mark" target="_blank">[?]</a>
					</p>
				</div>
			</div>
		</div>

		<?php
		if( PARENT_THEME_VERSION < '2.0' )
			$genesis_pre_two_point_oh = ' style="display:none;"';
		else
			$genesis_pre_two_point_oh = '';
		?>

		<div class="dynamik-optionbox-outer-2col"<?php echo $genesis_pre_two_point_oh; ?>>
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Genesis HTML5 Markup', 'dynamik' ); ?></h4>
				
				<div class="bg-box">	
					<p>
						<input type="checkbox" id="dynamik-html-five-active" name="dynamik[html_five_active]" value="1" <?php if( checked( 1, dynamik_get_settings( 'html_five_active' ) ) ); ?> /> <?php _e( 'Activate Genesis HTML5 Markup', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/21-activate-genesis-html5-markup" class="tooltip-mark" target="_blank">[?]</a>
					</p>
				</div>
			</div>
		</div>

		<div id="dynamik-fancy-dropdowns-active-box" class="dynamik-optionbox-outer-2col" style="display:none;">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Genesis "Fancy Dropdowns"', 'dynamik' ); ?></h4>
				
				<div class="bg-box">	
					<p>
						<input type="checkbox" id="dynamik-fancy-dropdowns-active" name="dynamik[fancy_dropdowns_active]" value="1" <?php if( checked( 1, dynamik_get_settings( 'fancy_dropdowns_active' ) ) ); ?> /> <?php _e( 'Enable Genesis Menu "Fancy Dropdowns"', 'dynamik' ); ?>
						<a href="http://dynamikdocs.cobaltapps.com/article/22-enable-genesis-menu-fancy-dropdowns" class="tooltip-mark" target="_blank">[?]</a>
					</p>
				</div>
			</div>
		</div>
		
		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Dynamik Footer Link', 'dynamik' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Add Your Dynamik Affiliate Link Below', 'dynamik' ); ?> (<a href="http://cobaltapps.com/affiliates/" /><?php _e( 'Sign Up', 'dynamik' ); ?></a>)<br />
						<input type="text" id="dynamik-affiliate-link" name="dynamik[affiliate_link]" value="<?php echo dynamik_get_settings( 'affiliate_link' ) ?>" style="width:100%;" />
					</p>
				</div>
			</div>
		</div>
		
	</div>
</div>