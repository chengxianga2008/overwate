<?php
/**
 * Builds the Custom JS admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-custom-options-nav-js-box" class="dynamik-optionbox-outer-1col dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">
		<h3 style="margin-bottom:15px;"><?php _e( 'Custom Javascript', 'dynamik' ); ?>
		<span style="color:#777777;">( <?php _e( 'Place In &lt;head&gt;', 'dynamik' ); ?>
		<input type="checkbox" id="dynamik-custom-js-in-head" name="custom_js[custom_js_in_head]" value="1" <?php if( checked( 1, $custom_js['custom_js_in_head'] ) ); ?> /> )</span>
		<a href="http://dynamikdocs.cobaltapps.com/article/66-custom-javascript" class="tooltip-mark" target="_blank">[?]</a></h3>

		<p style="margin:0;">
			<textarea data-editor="javascript" style="display:none;" wrap="off" id="dynamik-custom-js" class="dynamik-tabby-textarea" name="custom_js[custom_js]" rows="20"><?php echo stripslashes( esc_textarea( $custom_js['custom_js'] ) ); ?></textarea>
		</p>
	</div>
</div>