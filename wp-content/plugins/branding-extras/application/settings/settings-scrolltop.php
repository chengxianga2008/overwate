<?php

//* Scroll-to-Top Settings

?>

<div class="branding-extras-box">
	<div class="branding-extras-box-wrap">
		<div class="branding-extras-box-title">Scroll-to-Top</div>
		<div class="branding-extras-box-text">
			<div class="column">
				<div class="column-label column-item">Enable Scroll-to-Top</div>
				<div class="column-field column-item"><input type="checkbox" name="is_active_scroll" value="1" <?php echo $settings['is_active_scroll']=="1"? 'checked="checked"': '' ; ?>  /> <em>check to activate the scroll-to-top</em></div>
			</div>

			<div class="column">
				<div class="column-label column-item">Image</div>
				<div class="column-field column-item">
				    <input type="text" name="scroll_img" id="scroll_img-url" value="<?php echo $settings['scroll_img']!=""? stripslashes($settings['scroll_img']): stripslashes($settings['scroll_img']); ?>"  />
				    <input type="button" name="upload-btn" id="scroll_img_upload-btn" class="button-uploader" value="Upload Image">	
				</div>
			</div>

			<div class="column">
				<div class="column-label column-item">Alt Text</div>
				<div class="column-field column-item">
				    <input type="text" name="scroll_img_alt" placeholder="Scroll to Top"  value="<?php echo $settings['scroll_img_alt']!=""? stripslashes($settings['scroll_img_alt']): stripslashes($settings['scroll_img_alt']); ?>"  />
				</div>
			</div>

			<div class="column">
				<div class="column-label column-item">Width</div>
				<div class="column-field column-item">
				    <input type="number" min="0" name="scroll_img_width" placeholder="48" value="<?php echo $settings['scroll_img_width']!=""? stripslashes($settings['scroll_img_width']): stripslashes($settings['scroll_img_width']); ?>" />	
				</div>
			</div>

			<div class="column">
				<div class="column-label column-item">Height</div>
				<div class="column-field column-item">
				    <input type="number" min="0" name="scroll_img_height" placeholder="48" value="<?php echo $settings['scroll_img_height']!=""? stripslashes($settings['scroll_img_height']): stripslashes($settings['scroll_img_height']); ?>" />	
				</div>
			</div>

			<div class="column">
				<div class="column-label column-item">Offset X</div>
				<div class="column-field column-item">
				    <input type="number" min="0" name="scroll_offset_x" placeholder="5" value="<?php echo $settings['scroll_offset_x']!=""? stripslashes($settings['scroll_offset_x']): stripslashes($settings['scroll_offset_x']); ?>" />
				</div>
			</div>

			<div class="column">
				<div class="column-label column-item">Offset Y</div>
				<div class="column-field column-item">
				    <input type="number" min="0" name="scroll_offset_y" placeholder="5" value="<?php echo $settings['scroll_offset_y']!=""? stripslashes($settings['scroll_offset_y']): stripslashes($settings['scroll_offset_y']); ?>" />
				</div>
			</div>
		</div>
	</div>
</div>