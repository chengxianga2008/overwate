<?php
/**
 * Builds the Dynamik Skins admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-skins-box" class="dynamik-optionbox-outer-1col dynamik-not-universal dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3><?php _e( 'Dynamik Skins', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/165-dynamik-skins" class="tooltip-mark" target="_blank">[?]</a></h3>
		
		<div id="dynamik-create-new-skin">
			<form method="post">
				<p>
					<input type="text" id="new-skin-name" class="default-text" name="new_skin_name" value="" title="New Dynamik Skin Name" style="width:200px; margin:0 5px 5px 0; float:left;" />
					<input type="submit" name="clicked_button" value="<?php _e( 'Create & Activate', 'dynamik' ); ?>" class="button-highlighted button" style="float:left !important;"/><a href="http://dynamikdocs.cobaltapps.com/article/166-create-and-activate-a-new-dynamik-skin" class="tooltip-mark" target="_blank" style="padding-top:4px; float:right;">[?]</a>
					<input type="hidden" name="action" value="dynamik_skin_copy">
				</p>
			</form>
		</div>

<?php	if( !empty( $_GET['notice'] ) )
		{
			if( $_GET['notice'] == 'import-complete' )
			{
?>				<div class="notice-box" style="margin:0 0 13px;"><strong><?php _e( 'Skin Import Complete', 'dynamik' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'skin-update-complete' )
			{
?>				<div class="notice-box" style="margin:0 0 13px;"><strong><?php _e( 'Dynamik Skin Update Complete', 'dynamik' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'skin-copy-complete' )
			{
?>				<div class="notice-box" style="margin:0 0 13px;"><strong><?php _e( 'Dynamik Skin Copy Complete', 'dynamik' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'skin-file-updated' )
			{
?>				<div class="notice-box" style="margin:0 0 13px;"><strong><?php _e( 'Dynamik Skin File Updated', 'dynamik' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'skin-copy-error' )
			{
?>				<div class="notice-box" style="margin:0 0 13px;"><strong><?php _e( 'Error: Dynamik Skin Name Already Exists', 'dynamik' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'skin-import-error' )
			{
?>				<div class="notice-box" style="margin:0 0 13px;"><strong><?php _e( 'Error: Dynamik Skin With This Name Already Exists', 'dynamik' ); ?></strong></div>
<?php		}
		}
?>		
		<?php if( !empty( $skin_message ) ) { echo $skin_message; } ?>
		<?php dynamik_list_skins(); ?>

		<form action="/" id="dynamik-skin-styles-form" class="dynamik-skin-custom-code-form">
			<input type="hidden" name="action" value="dynamik_skin_custom_code_save" />
			<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'dynamik-skin-custom-code' ); ?>" />
			
			<div id="dynamik-skin-styles-overlay" class="dynamik-skin-code-editor-overlay">
				<div id="dynamik-skin-css-editor-outer-wrap" class="dynamik-skin-code-editor-outer-wrap">
					<h5 class="dynamik-skin-code-editor-title"><?php _e( 'Active Skin <code>style.css</code> File', 'dynamik' ); ?></h5>
					<span class="dynamik-skin-code-editor-close">X</span>
					<div class="dynamik-skin-code-editor-wrap">
						<textarea data-editor="css" style="display:none;" wrap="off" id="dynamik-skin-styles" class="dynamik-tabby-textarea" name="dynamik[skin_styles]" rows="20"><?php if( file_exists( dynamik_get_active_skin_folder_path() . '/style.css' ) ) { echo file_get_contents( dynamik_get_active_skin_folder_path() . '/style.css' ); } ?></textarea>
					</div>
					<div class="dynamik-skin-custom-code-button-container">
						<input type="submit" name="Submit" value="<?php _e( 'Save Styles', 'dynamik' ); ?>" style="margin:0 !important; float:left !important;" class="button"/>
						<img class="dynamik-ajax-save-spinner" src="<?php echo site_url() ?>/wp-admin/images/spinner-2x.gif" />
						<span class="dynamik-saved"></span>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</form>

		<form action="/" id="dynamik-skin-functions-form" class="dynamik-skin-custom-code-form">
			<input type="hidden" name="action" value="dynamik_skin_custom_code_save" />
			<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'dynamik-skin-custom-code' ); ?>" />
			
			<div id="dynamik-skin-functions-overlay" class="dynamik-skin-code-editor-overlay">
				<div id="dynamik-skin-php-editor-outer-wrap" class="dynamik-skin-code-editor-outer-wrap">
					<h5 class="dynamik-skin-code-editor-title"><?php _e( 'Active Skin <code>functions.php</code> File', 'dynamik' ); ?></h5>
					<span class="dynamik-skin-code-editor-close">X</span>
					<div class="dynamik-skin-code-editor-wrap">
						<textarea data-editor="php" style="display:none;" wrap="off" id="dynamik-skin-functions" class="dynamik-tabby-textarea" name="dynamik[skin_functions]" rows="20"><?php if( file_exists( dynamik_get_active_skin_folder_path() . '/functions.php' ) ) { echo file_get_contents( dynamik_get_active_skin_folder_path() . '/functions.php' ); } ?></textarea>
					</div>
					<div class="dynamik-skin-custom-code-button-container">
						<input type="submit" name="Submit" value="<?php _e( 'Save Functions', 'dynamik' ); ?>" style="margin:0 !important; float:left !important;" class="button"/>
						<img class="dynamik-ajax-save-spinner" src="<?php echo site_url() ?>/wp-admin/images/spinner-2x.gif" />
						<span class="dynamik-saved"></span>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</form>

		<form action="/" id="dynamik-skin-scripts-form" class="dynamik-skin-custom-code-form">
			<input type="hidden" name="action" value="dynamik_skin_custom_code_save" />
			<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'dynamik-skin-custom-code' ); ?>" />
			
			<div id="dynamik-skin-scripts-overlay" class="dynamik-skin-code-editor-overlay">
				<div id="dynamik-skin-js-editor-outer-wrap" class="dynamik-skin-code-editor-outer-wrap">
					<h5 class="dynamik-skin-code-editor-title"><?php _e( 'Active Skin <code>scripts.js</code> File', 'dynamik' ); ?></h5>
					<span class="dynamik-skin-code-editor-close">X</span>
					<div class="dynamik-skin-code-editor-wrap">
						<textarea data-editor="javascript" style="display:none;" wrap="off" id="dynamik-skin-scripts" class="dynamik-tabby-textarea" name="dynamik[skin_scripts]" rows="20"><?php if( file_exists( dynamik_get_active_skin_folder_path() . '/scripts.js' ) ) { echo file_get_contents( dynamik_get_active_skin_folder_path() . '/scripts.js' ); } ?></textarea>
					</div>
					<div class="dynamik-skin-custom-code-button-container">
						<input type="submit" name="Submit" value="<?php _e( 'Save Scripts', 'dynamik' ); ?>" style="margin:0 !important; float:left !important;" class="button"/>
						<img class="dynamik-ajax-save-spinner" src="<?php echo site_url() ?>/wp-admin/images/spinner-2x.gif" />
						<span class="dynamik-saved"></span>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</form>
	</div>
</div>