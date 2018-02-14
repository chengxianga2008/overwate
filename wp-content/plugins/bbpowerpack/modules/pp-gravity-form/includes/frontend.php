<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 * PPGravityFormModule:
 */

?>
<div class="pp-gf-content">
	<h3 class="form-title">
	<?php if ( $settings->custom_title ) {
	 	echo $settings->custom_title;
	} ?>
	</h3>
	<p class="form-description">
	<?php if ( $settings->custom_description ) {
		echo $settings->custom_description;
	} ?>
	</p>
    <?php
    if ( $settings->select_form_field ) {
        echo do_shortcode( '[gravityform id='.absint( $settings->select_form_field ).' title='.$settings->title_field.' description='.$settings->description_field.' ajax=true tabindex='. $settings->form_tab_index .']' );
    }
    ?>
</div>
