<?php

//* Header Settings

?>

<div class="branding-extras-box">
	<div class="branding-extras-box-wrap">
		<div class="branding-extras-box-title">Header</div>
		<div class="branding-extras-box-text">
			<div class="column">
				<div class="column-label column-item">Enable Header Settings</div>
				<div class="column-field column-item"><input type="checkbox" name="is_active_header" value="1" <?php echo $settings['is_active_header']=="1"? 'checked="checked"': '' ; ?>  /> <em>check to activate the header settings</em></div>
			</div>

			<div class="column">
				<div class="column-label column-item">Header Logo</div>
				<div class="column-field column-item">
				    <input type="text" name="header_logo" id="logo_img-url" value="<?php echo $settings['header_logo']!=""? stripslashes($settings['header_logo']): stripslashes($settings['header_logo']); ?>"  />
				    <input type="button" name="upload-btn" id="logo_upload-btn" class="button-uploader" value="Upload Image">	
				</div>
			</div>
		</div>
	</div>
</div>