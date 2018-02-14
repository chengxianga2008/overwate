<?php

//* Footer Widgets Settings

?>

<div class="branding-extras-box">
	<div class="branding-extras-box-wrap">
		<div class="branding-extras-box-title">Footer Widgets</div>
		<div class="branding-extras-box-text">
			<div class="column">
				<div class="column-label column-item">Enable Footer Widgets</div>
				<div class="column-field column-item"><input type="checkbox" name="is_active_footer_widgets" value="1" <?php echo $settings['is_active_footer_widgets']=="1"? 'checked="checked"': '' ; ?>  /> <em>check to activate the footer widgets</em></div>
			</div>

			<div class="column">
				<div class="column-label column-item">Number of Widgets</div>
				<div class="column-field column-item">
					<input type="number" min="1" max="6" name="footer_widgets_number" placeholder="1" value="<?php echo $settings['footer_widgets_number']!=""? stripslashes($settings['footer_widgets_number']): stripslashes($settings['footer_widgets_number']); ?>" />
				</div>
			</div>

			<div class="column">
				<div class="column-label column-item">Disabled Column Classes</div>
				<div class="column-field column-item">
					<input type="checkbox" name="footer_widgets_class" value="0" <?php echo $settings['footer_widgets_class']=="1"? 'checked="checked"': '0' ; ?>  /><em>check to removed column classes</em>
				</div>
			</div>
		</div>
	</div>
</div>