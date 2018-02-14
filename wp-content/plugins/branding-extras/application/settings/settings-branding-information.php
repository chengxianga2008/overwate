<?php

//* Branding Information Settings

?>

<div class="branding-extras-box">
			<div class="branding-extras-box-wrap">
				<div class="branding-extras-box-title">Branding Information</div>
				<div class="branding-extras-box-text">
					<div class="column">
						<div class="column-label column-item">Enable Branding Information</div>
						<div class="column-field column-item"><input type="checkbox" name="is_active_information" value="1" <?php echo $settings['is_active_information']=="1"? 'checked="checked"': '' ; ?>  /> <em>check to activate the branding information shortcode</em></div>
					</div>

					<div class="column">
						<div class="column-label column-item">Address</div>
						<div class="column-field column-item">
						    <textarea rows="4" cols="50" name="address"><?php echo $settings['address']!=""? stripslashes($settings['address']): stripslashes($settings['address']); ?></textarea> <em>type = address (allow html code)</em>
						</div>
					</div>

					<div class="column">
						<div class="column-label column-item">Contact Number</div>
						<div class="column-field column-item">
						    <textarea rows="4" cols="50" name="contact_number"><?php echo $settings['contact_number']!=""? stripslashes($settings['contact_number']): stripslashes($settings['contact_number']); ?></textarea> <em>type = contact_number (allow html code)</em>
						</div>
					</div>

					<div class="column">
						<div class="column-label column-item">Email Address</div>
						<div class="column-field column-item">
						    <textarea rows="4" cols="50" name="email_address"><?php echo $settings['email_address']!=""? stripslashes($settings['email_address']): stripslashes($settings['email_address']); ?></textarea> <em>type = email_address (allow html code)</em>
						</div>
					</div>

					<div class="column">
						<div class="column-label column-item">Shortcode</div>
						<div class="column-field column-item">
							[branding-information type=""]
						</div>
					</div>
				</div>
			</div>
		</div>