<?php
/**
 * Builds the Dynamik Custom Labels admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-custom-options-nav-labels-box" class="dynamik-optionbox-outer-1col searchable-box dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3>
			<span class="custom-option-title-text"><?php _e( 'Custom Labels', 'dynamik' ); ?></span>
			<input type="text" id="custom-label-search" class="custom-search default-text" value="" title="Search Labels" style="width:163px;" />
			<span class="dynamik-custom-fonts-button button dynamik-add-button add-label"><?php _e( 'Add', 'dynamik' ); ?></span>
			<a href="http://dynamikdocs.cobaltapps.com/article/68-custom-labels" class="tooltip-mark" target="_blank">[?]</a>
		</h3>

<?php	if( !empty( $_GET['notice'] ) )
		{
			if( $_GET['notice'] == 'label-added' )
			{
?>				<div class="notice-box"><strong><?php _e( 'Custom Label successfully added.', 'dynamik' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'label-deleted' )
			{
?>				<div class="notice-box"><strong><?php _e( 'Custom Label successfully deleted.', 'dynamik' ); ?></strong></div>
<?php		}
		}
?>
		
		<div id="dynamik-labels-wrap">
<?php
		if( !empty( $custom_labels ) )
		{
			$label_counter = 0;
			foreach( $custom_labels as $custom_label )
			{
				$label_counter++;
?>				<div id="label-<?php echo $label_counter; ?>" class="dynamik-all-labels">
					<div class="dynamik-custom-label-option">
						<p class="bg-box-design">
							<label for="custom_label_names[<?php echo $label_counter; ?>]"><?php _e( 'Name', 'dynamik' ); ?></label><input type="text" id="custom-label-name-<?php echo $label_counter; ?>" name="custom_label_names[<?php echo $label_counter; ?>]" value="<?php echo stripslashes( $custom_label['label_name'] ); ?>" style="width:140px;" class="searchable default-text" />
							<label for="custom_label_conditionals[<?php echo $label_counter; ?>]"><?php _e( 'Conditional Tag: ', 'dynamik' ); ?></label><input type="text" id="custom-label-conditional-<?php echo $label_counter; ?>" name="custom_label_conditionals[<?php echo $label_counter; ?>]" value="" title="<?php _e( "dynamik_has_label('", 'dynamik' ); ?><?php echo $custom_label['label_id']; ?><?php _e( "')", 'dynamik' ); ?>" style="width:20%;" class="readonly-text-input" />
							<label for="custom_label_body_classes[<?php echo $label_counter; ?>]"><?php _e( 'Body Class: ', 'dynamik' ); ?></label><input type="text" id="custom-label-body-class-<?php echo $label_counter; ?>" name="custom_label_body_classes[<?php echo $label_counter; ?>]" value="" title="<?php _e( 'label-', 'dynamik' ); ?><?php echo $custom_label['label_id']; ?>" style="width:19%;" class="readonly-text-input" />
							<span id="<?php echo $label_counter; ?>" class="button delete-label"> <?php _e( 'Delete', 'dynamik' ); ?></span>
						</p>
					</div>
				</div>
<?php		}
		}
		else
		{
	?>		<div id="label-1" class="dynamik-all-labels">
				<div class="dynamik-custom-label-option">
					<p class="bg-box-design">
						<label for="custom_label_names[1]"><?php _e( 'Name', 'dynamik' ); ?></label><input type="text" id="custom-label-name-1" name="custom_label_names[1]" value="" style="width:140px;" class="searchable" /> <span class="label-create-conditional">( <?php _e( 'Automatically create a Custom Conditional for this Label', 'dynamik' ); ?> <input type="checkbox" id="custom-label-create-conditional-1" name="custom_label_create_conditionals[1]" value="1" />)</span>
						<span id="1" class="button delete-label"> <?php _e( 'Delete', 'dynamik' ); ?></span>
					</p>
				</div>
			</div>
<?php	}
?>		</div>
	</div>
</div>