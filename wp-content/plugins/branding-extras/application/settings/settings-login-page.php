<?php

//* Login Page Settings

?>

<div class="branding-extras-box">
	<div class="branding-extras-box-wrap">
		<div class="branding-extras-box-title">Login Page</div>
		<div class="branding-extras-box-text">
			<div class="column">
				<div class="column-label column-item">Enable Custome Login Page</div>
				<div class="column-field column-item"><input type="checkbox" name="is_active_admin_login" value="1" <?php echo $settings['is_active_admin_login']=="1"? 'checked="checked"': '' ; ?>  /> <em>check to activate the custom login page</em></div>
			</div>

			<div class="column">
				<div class="column-label column-item">Login Logo</div>
				<div class="column-field column-item">
				    <input type="text" name="admin_logo_img" id="login_page_img-url" value="<?php echo $settings['admin_logo_img']!=""? stripslashes($settings['admin_logo_img']): stripslashes($settings['admin_logo_img']); ?>"  />
				    <input type="button" name="upload-btn" id="login_page_upload-btn" class="button-uploader" value="Upload Image">	
				</div>
			</div>

			<div class="column">
				<div class="column-label column-item">Background Color</div>
				<div class="column-field column-item">
				    <input type="text" name="admin_logo_bgcolor" placeholder="#FFFFFF" value="<?php echo $settings['admin_logo_bgcolor']!=""? stripslashes($settings['admin_logo_bgcolor']): stripslashes($settings['admin_logo_bgcolor']); ?>" /> <em>transparent and rgba() are allowed</em>
				</div>
			</div>

			<div class="column">
				<div class="column-label column-item">Logo Image Width</div>
				<div class="column-field column-item">
				    <input type="number" min="0" name="admin_logo_width" placeholder="0" value="<?php echo $settings['admin_logo_width']!=""? stripslashes($settings['admin_logo_width']): stripslashes($settings['admin_logo_width']); ?>" />	
				</div>
			</div>

			<div class="column">
				<div class="column-label column-item">Logo Image Height</div>
				<div class="column-field column-item">
				    <input type="number" min="0" name="admin_logo_height" placeholder="0" value="<?php echo $settings['admin_logo_height']!=""? stripslashes($settings['admin_logo_height']): stripslashes($settings['admin_logo_height']); ?>" />	
				</div>
			</div>

			<div class="column">
				<div class="column-label column-item">Padding</div>
				<div class="column-field column-item">
				    <input type="text" name="admin_logo_padding" placeholder="0px 0px 0px 0px" value="<?php echo $settings['admin_logo_padding']!=""? stripslashes($settings['admin_logo_padding']): stripslashes($settings['admin_logo_padding']); ?>" />
				</div>
			</div>

			<div class="column">
				<div class="column-label column-item">Box Shadow</div>
				<div class="column-field column-item">
				    <input type="text" name="admin_logo_box_shadow" placeholder="none" value="<?php echo $settings['admin_logo_box_shadow']!=""? stripslashes($settings['admin_logo_box_shadow']): stripslashes($settings['admin_logo_box_shadow']); ?>" />
				</div>
			</div>
		</div>
	</div>
</div>