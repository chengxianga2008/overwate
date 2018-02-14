<?php
/**
 * Builds the Dynamik Custom Widget Areas admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-custom-options-nav-widget-areas-box" class="dynamik-optionbox-outer-1col searchable-box dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3>
			<span class="custom-option-title-text"><?php _e( 'Custom Widget Areas', 'dynamik' ); ?></span>
			<input type="text" id="custom-widget-search" class="custom-search default-text" value="" title="Search Widget Areas" style="width:163px;" />
			<span class="dynamik-custom-fonts-button button dynamik-add-button add-widget"><?php _e( 'Add', 'dynamik' ); ?></span>
			<a href="http://dynamikdocs.cobaltapps.com/article/70-custom-widget-areas" class="tooltip-mark" target="_blank">[?]</a>
		</h3>
		
		<div id="dynamik-widgets-wrap">
<?php
		if( !empty( $custom_widgets ) )
		{
			$widget_counter = 0;
			foreach( $custom_widgets as $custom_widget )
			{
				$widget_counter++;
?>				<div id="widget-<?php echo $widget_counter; ?>">
					<div class="dynamik-custom-widget-option">
						<p class="bg-box-design">
							<label for="custom_widget_ids[<?php echo $widget_counter; ?>]"><?php _e( 'Name', 'dynamik' ); ?></label><input type="text" id="custom-widget-id-<?php echo $widget_counter; ?>" name="custom_widget_ids[<?php echo $widget_counter; ?>]" value="<?php echo $custom_widget['widget_name']; ?>" style="width:200px;" class="forbid-chars-alt searchable" /><select id="custom-widget-hook-<?php echo $widget_counter; ?>" name="custom_widget_hook[<?php echo $widget_counter; ?>]" size="1" style="width:250px;"><?php dynamik_list_hooks( $custom_widget['hook_location'] ); ?></select><label for="custom_widget_priority[<?php echo $widget_counter; ?>]"><?php _e( 'Priority', 'dynamik' ); ?></label><input type="text" id="custom-widget-priority-<?php echo $widget_counter; ?>" name="custom_widget_priority[<?php echo $widget_counter; ?>]" value="<?php echo $custom_widget['priority']; ?>" style="width:30px;" /><select id="custom-widget-status-<?php echo $widget_counter; ?>" class="custom-widget-status" name="custom_widget_status[<?php echo $widget_counter; ?>]" ><option value="hkd"<?php echo ( $custom_widget['status'] == 'hkd' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Hooked', 'dynamik' ); ?></option><option value="sht"<?php echo ( $custom_widget['status'] == 'sht' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Shortcode', 'dynamik' ); ?></option><option value="bth"<?php echo ( $custom_widget['status'] == 'bth' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Both', 'dynamik' ); ?></option><option value="no"<?php echo ( $custom_widget['status'] == 'no' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Deactivate', 'dynamik' ); ?></option></select>
						</p>
						<p>
							<select class="conditionals-list-multiselect" id="custom-widget-conditionals-list-<?php echo $widget_counter; ?>" name="custom_widget_conditionals_list[<?php echo $widget_counter; ?>][]" multiple="multiple" style="width:250px;"><?php dynamik_list_conditionals( $custom_widget['conditionals'] ); ?></select><label for="custom_widget_class[<?php echo $widget_counter; ?>]"><?php _e( 'Class', 'dynamik' ); ?></label><input type="text" id="custom-widget-class-<?php echo $widget_counter; ?>" name="custom_widget_class[<?php echo $widget_counter; ?>]" value="<?php echo $custom_widget['class']; ?>" style="width:250px;" /> <span id="<?php echo $widget_counter; ?>" class="button delete-widget"> <?php _e( 'Delete', 'dynamik' ); ?></span>
						</p>
						<p>
							<label for="custom_widget_description[<?php echo $widget_counter; ?>]" style="width:100%;"><?php _e( 'Widget Area Description:', 'dynamik' ); ?></label>
							<textarea class="resizable dynamik-tabby-textarea" id="custom-widget-description-<?php echo $widget_counter; ?>" name="custom_widget_description[<?php echo $widget_counter; ?>]" style="height:45px;margin:5px 0;text-align:left;"><?php echo $custom_widget['description']; ?></textarea>
						</p>
					</div>
				</div>
<?php		}
		}
		else
		{
	?>		<div id="widget-1">
				<div class="dynamik-custom-widget-option">
					<p class="bg-box-design">
						<label for="custom_widget_ids[1]"><?php _e( 'Name', 'dynamik' ); ?></label><input type="text" id="custom-widget-id-1" name="custom_widget_ids[1]" value="" style="width:200px;" class="forbid-chars-alt searchable" /><select id="custom-widget-hook-1" name="custom_widget_hook[1]" size="1" style="width:250px;"><?php dynamik_list_hooks(); ?></select><label for="custom_widget_priority[1]"><?php _e( 'Priority', 'dynamik' ); ?></label><input type="text" id="custom-widget-priority-1" name="custom_widget_priority[1]" value="10" style="width:30px;" /><select id="custom-widget-status-1" class="custom-widget-status" name="custom_widget_status[1]" ><option value="hkd"><?php _e( 'Hooked', 'dynamik' ); ?></option><option value="sht"><?php _e( 'Shortcode', 'dynamik' ); ?></option><option value="bth"><?php _e( 'Both', 'dynamik' ); ?></option><option value="no"><?php _e( 'Deactivate', 'dynamik' ); ?></option></select>
					</p>
					<p>
						<select class="conditionals-list-multiselect" id="custom-widget-conditionals-list-1" name="custom_widget_conditionals_list[1][]" multiple="multiple" style="width:250px;"><?php dynamik_list_conditionals(); ?></select><label for="custom_widget_class[1]"><?php _e( 'Class', 'dynamik' ); ?></label><input type="text" id="custom-widget-class-1" name="custom_widget_class[1]" value="" style="width:250px;" /> <span id="1" class="button delete-widget"> <?php _e( 'Delete', 'dynamik' ); ?></span>
					</p>
					<p>
						<label for="custom_widget_description[1]" style="width:100%;"><?php _e( 'Widget Area Description:', 'dynamik' ); ?></label>
						<textarea class="resizable dynamik-tabby-textarea" id="custom-widget-description-1" name="custom_widget_description[1]" style="height:45px;margin:5px 0;text-align:left;"></textarea>
					</p>
				</div>
			</div>
<?php	}
?>		</div>
	</div>
</div>