<?php
/**
 * Builds the Dynamik Custom Hook Boxes admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-custom-options-nav-hook-boxes-box" class="dynamik-optionbox-outer-1col searchable-box dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3>
			<span class="custom-option-title-text"><?php _e( 'Custom Hook Boxes', 'dynamik' ); ?></span>
			<input type="text" id="custom-hook-search" class="custom-search default-text" value="" title="Search Hook Boxes" style="width:163px;" />
			<span class="dynamik-custom-fonts-button button dynamik-add-button add-hook"><?php _e( 'Add', 'dynamik' ); ?></span>
			<a href="http://dynamikdocs.cobaltapps.com/article/71-custom-hook-boxes" class="tooltip-mark" target="_blank">[?]</a>
		</h3>
		
		<div id="dynamik-hooks-wrap">
<?php
		if( !empty( $custom_hooks ) )
		{
			$hook_counter = 0;
			foreach( $custom_hooks as $custom_hook )
			{
				$hook_counter++;
?>				<div id="hook-<?php echo $hook_counter; ?>" class="dynamik-all-hook-boxes">
					<div class="dynamik-custom-hook-option">
						<p class="bg-box-design">
							<label for="custom_hook_ids[<?php echo $hook_counter; ?>]"><?php _e( 'Name', 'dynamik' ); ?></label><input type="text" id="custom-hook-id-<?php echo $hook_counter; ?>" name="custom_hook_ids[<?php echo $hook_counter; ?>]" value="<?php echo $custom_hook['hook_name']; ?>" style="width:200px;" class="forbid-chars-alt searchable" /><select id="custom-hook-hook-<?php echo $hook_counter; ?>" name="custom_hook_hook[<?php echo $hook_counter; ?>]" size="1" style="width:250px;"><?php dynamik_list_hooks( $custom_hook['hook_location'] ); ?></select><label for="custom_hook_priority[<?php echo $hook_counter; ?>]"><?php _e( 'Priority', 'dynamik' ); ?></label><input type="text" id="custom-hook-priority-<?php echo $hook_counter; ?>" name="custom_hook_priority[<?php echo $hook_counter; ?>]" value="<?php echo $custom_hook['priority']; ?>" style="width:30px;" /><select id="custom-hook-status-<?php echo $hook_counter; ?>" class="custom-hook-status" name="custom_hook_status[<?php echo $hook_counter; ?>]" ><option value="hkd"<?php echo ( $custom_hook['status'] == 'hkd' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Hooked', 'dynamik' ); ?></option><option value="sht"<?php echo ( $custom_hook['status'] == 'sht' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Shortcode', 'dynamik' ); ?></option><option value="bth"<?php echo ( $custom_hook['status'] == 'bth' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Both', 'dynamik' ); ?></option><option value="css"<?php echo ( $custom_hook['status'] == 'css' ) ? ' selected="selected"' : ''; ?>><?php _e( 'CSS', 'dynamik' ); ?></option><option value="no"<?php echo ( $custom_hook['status'] == 'no' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Deactivate', 'dynamik' ); ?></option></select>
						</p>
						<p>
							<select class="conditionals-list-multiselect" id="custom-hook-conditionals-list-<?php echo $hook_counter; ?>" name="custom_hook_conditionals_list[<?php echo $hook_counter; ?>][]" multiple="multiple" style="width:250px;"><?php dynamik_list_conditionals( $custom_hook['conditionals'] ); ?></select> <span id="<?php echo $hook_counter; ?>" class="button delete-hook"><?php _e( 'Delete', 'dynamik' ); ?></span><span class="do-shortcode button"><?php _e( '[do_shortcode]', 'dynamik' ); ?></span><span class="view-only-hook"><span class="button" style="width:80px !important;"><a href="#wpwrap"><?php _e( 'View Only', 'dynamik' ); ?></a></span></span> <span class="view-all-hooks"><span class="button" style="width:80px !important;"><a href="#wpwrap"><?php _e( 'View All', 'dynamik' ); ?></a></span></span>
						</p>
						<p>
							<textarea class="resizable dynamik-tabby-textarea" id="custom-hook-textarea-<?php echo $hook_counter; ?>" name="custom_hook_textarea[<?php echo $hook_counter; ?>]" style="height:100px;text-align:left;"><?php echo $custom_hook['hook_textarea']; ?></textarea>
						</p>
					</div>
				</div>
<?php		}
		}
		else
		{
	?>		<div id="hook-1" class="dynamik-all-hook-boxes">
				<div class="dynamik-custom-hook-option">
					<p class="bg-box-design">
						<label for="custom_hook_ids[1]"><?php _e( 'Name', 'dynamik' ); ?></label><input type="text" id="custom-hook-id-1" name="custom_hook_ids[1]" value="" style="width:200px;" class="forbid-chars-alt searchable" /><select id="custom-hook-hook-1" name="custom_hook_hook[1]" size="1" style="width:250px;"><?php dynamik_list_hooks(); ?></select><label for="custom_hook_priority[1]"><?php _e( 'Priority', 'dynamik' ); ?></label><input type="text" id="custom-hook-priority-1" name="custom_hook_priority[1]" value="10" style="width:30px;" /><select id="custom-hook-status-1" class="custom-hook-status" name="custom_hook_status[1]" ><option value="hkd"><?php _e( 'Hooked', 'dynamik' ); ?></option><option value="sht"><?php _e( 'Shortcode', 'dynamik' ); ?></option><option value="bth"><?php _e( 'Both', 'dynamik' ); ?></option><option value="css"><?php _e( 'CSS', 'dynamik' ); ?></option><option value="no"><?php _e( 'Deactivate', 'dynamik' ); ?></option></select>
					</p>
					<p>
						<select class="conditionals-list-multiselect" id="custom-hook-conditionals-list-1" name="custom_hook_conditionals_list[1][]" multiple="multiple" style="width:250px;"><?php dynamik_list_conditionals(); ?></select> <span id="1" class="button delete-hook"><?php _e( 'Delete', 'dynamik' ); ?></span><span class="do-shortcode button"><?php _e( '[do_shortcode]', 'dynamik' ); ?></span>
					</p>
					<p>
						<textarea class="resizable dynamik-tabby-textarea" id="custom-hook-textarea-1" name="custom_hook_textarea[1]" style="height:100px;text-align:left;"></textarea>
					</p>
				</div>
			</div>
<?php	}
?>		</div>
	</div>
</div>