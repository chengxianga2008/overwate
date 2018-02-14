<?php
/**
 * Builds the Custom Functions admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-custom-options-nav-functions-box" class="dynamik-optionbox-outer-1col dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3 style="margin-bottom:15px;"><?php _e( 'Custom Functions', 'dynamik' ); ?>
		<span style="color:#777777;">( <?php _e( 'Affect Admin', 'dynamik' ); ?>
		<input type="checkbox" id="dynamik-custom-functions-effect-admin" name="custom_functions[custom_functions_effect_admin]" value="1" <?php if( checked( 1, $custom_functions['custom_functions_effect_admin'] ) ); ?> /> )</span>
		<a href="http://dynamikdocs.cobaltapps.com/article/65-custom-functions" class="tooltip-mark" target="_blank">[?]</a></h3>

		<p style="margin:0;">
			<textarea data-editor="php" style="display:none;" wrap="off" id="dynamik-custom-functions" class="dynamik-tabby-textarea" name="custom_functions[custom_functions]" rows="20"><?php echo stripslashes( esc_textarea( $custom_functions['custom_functions'] ) ); ?></textarea>
		</p>
	</div>
</div>