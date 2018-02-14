<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 * PPHighlightBoxModule:
 */

?>
<div class="pp-highlight-box-content <?php echo $settings->box_icon_effect; ?>">
    <?php if( $settings->box_font_icon && $settings->box_icon_select == 'font_icon' ) { ?>
        <div class="font_icon">
            <div class="font_icon_inner">
                <i class="<?php echo $settings->box_font_icon; ?>"></i>
            </div>
        </div>
    <?php } ?>
    <?php if( $settings->box_custom_icon && $settings->box_icon_select == 'custom_icon' ) { ?>
        <div class="custom_icon">
            <div class="custom_icon_inner">
                <div class="custom_icon_inner_wrap">
                    <img src="<?php echo $settings->box_custom_icon_src; ?>" />
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="box-text">
        <?php
        if ( $settings->box_content ) {
            echo $settings->box_content;
        }
        ?>
    </div>
    <?php if ( $settings->box_link ) { ?>
        <a class="box-link" href="<?php echo $settings->box_link; ?>" target="<?php echo $settings->link_target; ?>"></a>
    <?php } ?>
</div>
