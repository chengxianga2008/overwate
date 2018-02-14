<?php
/**
 * Builds the Dynamik Custom Templates admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-custom-options-nav-templates-box" class="dynamik-optionbox-outer-1col searchable-box dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3>
			<span class="custom-option-title-text"><?php _e( 'Custom Templates', 'dynamik' ); ?></span>
			<input type="text" id="custom-template-search" class="custom-search default-text" value="" title="Search Templates" style="width:163px;" />
			<span class="dynamik-custom-fonts-button button dynamik-add-button add-template"><?php _e( 'Add', 'dynamik' ); ?></span>
			<a href="http://dynamikdocs.cobaltapps.com/article/67-custom-templates" class="tooltip-mark" target="_blank">[?]</a>
		</h3>

<?php	if( !empty( $_GET['notice'] ) )
		{
			if( $_GET['notice'] == 'template-added' )
			{
?>				<div class="notice-box"><strong><?php _e( 'Custom Template successfully added.', 'dynamik' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'template-deleted' )
			{
?>				<div class="notice-box"><strong><?php _e( 'Custom Template successfully deleted.', 'dynamik' ); ?></strong></div>
<?php		}
		}
?>
		
		<div id="dynamik-templates-wrap">
<?php
		if( !empty( $custom_templates ) )
		{
			$template_counter = 0;
			foreach( $custom_templates as $custom_template )
			{
				$template_counter++;
?>				<div id="template-<?php echo $template_counter; ?>" class="dynamik-all-templates">
					<div class="dynamik-custom-template-option">
						<p class="bg-box-design">
							<label for="custom_template_ids[<?php echo $template_counter; ?>]"><?php _e( 'File Name', 'dynamik' ); ?></label><input type="text" id="custom-template-id-<?php echo $template_counter; ?>" name="custom_template_ids[<?php echo $template_counter; ?>]" value="<?php echo $custom_template['template_file_name']; ?>" style="width:180px;" class="forbid-template-chars forbid-caps forbid-names" /><label for="custom_template_names[<?php echo $template_counter; ?>]"><?php _e( 'Template Name', 'dynamik' ); ?></label><input type="text" id="custom-template-name-<?php echo $template_counter; ?>" name="custom_template_names[<?php echo $template_counter; ?>]" value="<?php echo $custom_template['template_name']; ?>" style="width:180px;" class="searchable" /> <select id="custom-template-type-<?php echo $template_counter; ?>" name="custom_template_types[<?php echo $template_counter; ?>]" ><option value="page_template"<?php echo ( $custom_template['template_type'] == 'page_template' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Page Template', 'dynamik' ); ?></option><option value="wp_template"<?php echo ( $custom_template['template_type'] == 'wp_template' ) ? ' selected="selected"' : ''; ?>><?php _e( 'WordPress Template', 'dynamik' ); ?></option></select>
						</p>
						<p>
						<?php if( $custom_template['template_type'] == 'page_template' ) { ?>
							<label for="custom_template_conditionals[<?php echo $template_counter; ?>]"><?php _e( 'Conditional Tag: ', 'dynamik' ); ?></label><input type="text" id="custom-template-conditional-<?php echo $template_counter; ?>" name="custom_template_conditionals[<?php echo $template_counter; ?>]" value="" title="<?php _e( "is_page_template('my-templates/", 'dynamik' ); ?><?php echo $custom_template['template_file_name']; ?><?php _e( ".php')", 'dynamik' ); ?>" style="width:300px;" class="readonly-text-input" />
						<?php } ?>
							<span id="<?php echo $template_counter; ?>" class="button delete-template"><?php _e( 'Delete', 'dynamik' ); ?></span> <span class="do-shortcode button"><?php _e( '[do_shortcode]', 'dynamik' ); ?></span><span class="view-only-template"><span class="button" style="width:80px !important;"><a href="#wpwrap"><?php _e( 'View Only', 'dynamik' ); ?></a></span></span><span class="view-all-templates"><span class="button" style="width:80px !important;"><a href="#wpwrap"><?php _e( 'View All', 'dynamik' ); ?></a></span></span>
						</p>
						<p style="padding-top:3px;">
							<textarea class="resizable dynamik-tabby-textarea" id="custom-template-textarea-<?php echo $template_counter; ?>" name="custom_template_textarea[<?php echo $template_counter; ?>]" style="height:100px;text-align:left;"><?php echo $custom_template['template_textarea']; ?></textarea>
						</p>
					</div>
				</div>
<?php		}
		}
		else
		{
	?>		<div id="template-1" class="dynamik-all-templates">
				<div class="dynamik-custom-template-option">
					<p class="bg-box-design">
						<label for="custom_template_ids[1]"><?php _e( 'File Name', 'dynamik' ); ?></label><input type="text" id="custom-template-id-1" name="custom_template_ids[1]" value="" style="width:180px;" class="forbid-template-chars forbid-caps forbid-names" /><label for="custom_template_names[1]"><?php _e( 'Template Name', 'dynamik' ); ?></label><input type="text" id="custom-template-name-1" name="custom_template_names[1]" value="" style="width:180px;" class="searchable" /> <select id="custom-template-type-1" name="custom_template_types[1]" ><option value="page_template"><?php _e( 'Page Template', 'dynamik' ); ?></option><option value="wp_template"><?php _e( 'WordPress Template', 'dynamik' ); ?></option></select>
					</p>
					<p>
						<span id="1" class="button delete-template"><?php _e( 'Delete', 'dynamik' ); ?></span><span class="do-shortcode button"><?php _e( '[do_shortcode]', 'dynamik' ); ?></span>
					</p>
					<p style="padding-top:3px;">
						<textarea class="resizable dynamik-tabby-textarea" id="custom-template-textarea-1" name="custom_template_textarea[1]" style="height:100px;text-align:left;"></textarea>
					</p>
				</div>
			</div>
<?php	}
?>		</div>
	</div>
</div>