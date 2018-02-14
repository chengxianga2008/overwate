<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 * PPLogosGridModule:
 */

?>

<div class="pp-logos-content clearfix">
    <div class="pp-logos-wrapper clearfix">
		<?php
		for($i=0; $i < count($settings->logos_grid); $i++) {

			if(!is_object($settings->logos_grid[$i])) {
				continue;
			}

			$logos_grid = $settings->logos_grid[$i];
            $alt = !empty($logos_grid->upload_logo_title) ? $logos_grid->upload_logo_title : basename($logos_grid->upload_logo_grid_src);

		?>
		<div class="pp-logo pp-logo-<?php echo $i; ?>">
            <div class="pp-logo-inner">
                <div class="pp-logo-inner-wrap">
                    <?php if ( $logos_grid->upload_logo_link != '' ) { ?>
                    <a href="<?php echo $logos_grid->upload_logo_link; ?>" target="<?php echo $settings->upload_logo_link_target; ?>" >
                    <?php } ?>
                        <?php if( $logos_grid->upload_logo_grid ) { ?>
                            <img class="logo-image" src="<?php echo $logos_grid->upload_logo_grid_src; ?>" alt="<?php echo $alt; ?>" />
                        <?php } ?>
                        <?php if( $logos_grid->upload_logo_title ) { ?>
                            <div class="title-wrapper">
                                <p class="logo-title">
                                    <?php echo $logos_grid->upload_logo_title; ?>
                                </p>
                            </div>
                        <?php } ?>
                    <?php if ( $logos_grid->upload_logo_link != '' ) { ?>
                    </a>
                    <?php } ?>
                </div>
            </div>
		</div>
		<?php } ?>
	</div>
    <div class="logo-slider-next"></div>
	<div class="logo-slider-prev"></div>
</div>
