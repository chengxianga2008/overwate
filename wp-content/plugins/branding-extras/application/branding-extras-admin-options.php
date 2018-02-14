<div class="wrap" id="branding-extras-wrap">

  <h2>Branding Extras - Settings</h2>
  <!-- 
  <h2 id="branding-extras-settings-tabs" class="nav-tabber-wrapper">
    <a id="settings" class="nav-tabber nav-tabber-active" href="?page=branding-extras">Settings</a>
  </h2> 
  -->
  
  <form action="<?php echo $action_url ?>" method="post">
    <input type="hidden" name="submitted" value="1" />
    <?php wp_nonce_field('branding-extras-fields'); ?>

	<div id="branding-extras-content">
		
		<?php

		//* Branding Information Settings
		include 'settings/settings-branding-information.php';

		//* Header Settings
		include 'settings/settings-header.php';

		//* Footer Widgets Settings
		include 'settings/settings-footer-widgets.php';

		//* Scroll-to-Top Settings
		include 'settings/settings-scrolltop.php';

		//* Login Page Settings
		include 'settings/settings-login-page.php';
		
		?>

    </div>

	<div id="branding-extras-sidebar">
		<div class="branding-extras-box">
			<div class="branding-extras-box-wrap">
				<div class="branding-extras-box-title">Activation</div>
				<div class="branding-extras-box-text">

					<div class="column">
						<div class="column-label column-item">Enable Plugin</div>
						<div class="column-field column-item"><input type="checkbox" name="is_active" value="1" <?php echo $settings['is_active']=="1"? 'checked="checked"': '' ; ?>  /> <em>check to activate the plugin</em></div>
					</div>
				</div>
			</div>
		</div>

		<div class="branding-extras-box">
			<div class="branding-extras-box-wrap">
				<div class="branding-extras-box-title">Save</div>
				<div class="branding-extras-box-text">
					<input type="submit" name="Submit" value="Update" />
				</div>
			</div>
		</div>
	</div>

  </form>
</div>