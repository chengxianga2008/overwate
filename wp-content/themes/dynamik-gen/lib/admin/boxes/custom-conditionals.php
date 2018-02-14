<?php
/**
 * Builds the Dynamik Custom Conditionals admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-custom-options-nav-conditionals-box" class="dynamik-optionbox-outer-1col searchable-box dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3>
			<span class="custom-option-title-text"><?php _e( 'Custom Conditionals', 'dynamik' ); ?></span>
			<input type="text" id="custom-conditional-search" class="custom-search default-text" value="" title="Search Conditionals" style="width:163px;" />
			<span class="dynamik-custom-fonts-button button dynamik-add-button add-conditional"><?php _e( 'Add', 'dynamik' ); ?></span>
			<a href="http://dynamikdocs.cobaltapps.com/article/69-custom-conditionals" class="tooltip-mark" target="_blank">[?]</a>
		</h3>
		
<?php	if( !empty( $_GET['notice'] ) )
		{
			if( $_GET['notice'] == 'conditional-added' )
			{
?>				<div class="notice-box"><strong><?php _e( 'Custom Conditional successfully added.', 'dynamik' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'conditional-deleted' )
			{
?>				<div class="notice-box"><strong><?php _e( 'Custom Conditional successfully deleted.', 'dynamik' ); ?></strong></div>
<?php		}
		}
?>		
				
		<div id="dynamik-conditionals-wrap">
<?php
		if( !empty( $custom_conditionals ) )
		{
			$conditional_counter = 0;
			foreach( $custom_conditionals as $custom_conditional )
			{
				$conditional_counter++;
?>				<div id="conditional-<?php echo $conditional_counter; ?>">
					<div class="dynamik-custom-conditional-option">
						<p class="bg-box-design">
							<select id="id-custom-conditional-id-<?php echo $conditional_counter; ?>" class="conditional-examples id-custom-conditional-tag-<?php echo $conditional_counter; ?>" name="conditional_examples" size="1" style="width:165px;"><?php dynamik_list_conditional_examples( 'conditional_examples' ); ?></select>
							<label for="custom_conditional_ids[<?php echo $conditional_counter; ?>]"><?php _e( 'Name', 'dynamik' ); ?></label><input type="text" id="custom-conditional-id-<?php echo $conditional_counter; ?>" name="custom_conditional_ids[<?php echo $conditional_counter; ?>]" value="<?php echo $custom_conditional['conditional_id']; ?>" style="width:25%;" class="forbid-chars forbid-caps searchable" />
							<label for="custom_conditional_tags[<?php echo $conditional_counter; ?>]"><?php _e( 'Tag', 'dynamik' ); ?></label><input type="text" id="custom-conditional-tag-<?php echo $conditional_counter; ?>" name="custom_conditional_tags[<?php echo $conditional_counter; ?>]" value="<?php echo $custom_conditional['conditional_tag']; ?>" style="width:25%;" />
							<span id="<?php echo $conditional_counter; ?>" class="button delete-conditional"><?php _e( 'Delete', 'dynamik' ); ?></span>
						</p>
					</div>
				</div>
<?php		}
		}
		else
		{
	?>		<div id="conditional-1">
				<div class="dynamik-custom-conditional-option">
					<p class="bg-box-design">
						<select id="id-custom-conditional-id-1" class="conditional-examples id-custom-conditional-tag-1" name="conditional_examples" size="1" style="width:165px;"><?php dynamik_list_conditional_examples( 'conditional_examples' ); ?></select>
						<label for="custom_conditional_ids[1]"><?php _e( 'Name', 'dynamik' ); ?></label><input type="text" id="custom-conditional-id-1" name="custom_conditional_ids[1]" value="" style="width:25%;" class="forbid-chars forbid-caps searchable" />
						<label for="custom_conditional_ids[1]"><?php _e( 'Tag', 'dynamik' ); ?></label><input type="text" id="custom-conditional-tag-1" name="custom_conditional_tags[1]" value="" style="width:25%;" />
						<span id="1" class="button delete-conditional"><?php _e( 'Delete', 'dynamik' ); ?></span>
					</p>
				</div>
			</div>
<?php	}
?>
		</div>	
	</div>
</div>