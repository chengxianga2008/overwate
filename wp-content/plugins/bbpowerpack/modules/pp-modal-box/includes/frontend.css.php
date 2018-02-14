.fl-node-<?php echo $id; ?> .pp-modal-button {
    text-align: <?php echo $settings->button_alignment; ?>;
}
.fl-node-<?php echo $id; ?> .pp-modal-trigger {
    <?php if ( 'button' == $settings->button_type || 'icon' == $settings->button_type ) { ?>
    color: #<?php echo $settings->button_text_color; ?>;
    background-color: <?php echo pp_hex2rgba('#'.$settings->button_color, $settings->button_opacity); ?>;
    padding: <?php echo $settings->button_padding['top']; ?>px <?php echo $settings->button_padding['right']; ?>px <?php echo $settings->button_padding['bottom']; ?>px <?php echo $settings->button_padding['left']; ?>px;
        <?php if ( 'full' == $settings->button_width ) { ?>
        display: inline-block;
        width: 100%;
        <?php } ?>
    <?php } ?>
    <?php if ( 'image' == $settings->button_type || 'icon' == $settings->button_type ) { ?>
    display: inline-block;
    <?php } ?>
    <?php if ( 'yes' == $settings->button_border ) { ?>
    border: <?php echo $settings->button_border_width; ?>px solid #<?php echo $settings->button_border_color; ?>;
    <?php } ?>
    border-radius: <?php echo $settings->button_border_radius; ?>px;
    text-align: center;
    text-decoration: none;
}
.fl-node-<?php echo $id; ?> .pp-modal-trigger .pp-button-icon {
    font-size: <?php echo $settings->button_font_size; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-modal-trigger .pp-modal-trigger-text {
    <?php if( $settings->button_font_family['family'] != 'Default' ) {
        FLBuilderFonts::font_css( $settings->button_font_family );
    } ?>
    font-size: <?php echo $settings->button_font_size; ?>px;
}
.fl-builder-content .fl-node-<?php echo $id; ?> .pp-modal-trigger:hover,
.fl-node-<?php echo $id; ?> .pp-modal-trigger:hover {
    <?php if ( 'button' == $settings->button_type || 'icon' == $settings->button_type ) { ?>
    color: #<?php echo $settings->button_text_hover; ?>;
    background-color: <?php echo pp_hex2rgba('#'.$settings->button_color_hover, $settings->button_opacity_hover); ?>;
    <?php } ?>
    border-color: #<?php echo $settings->button_border_color_hover; ?>;
}
<?php if ( 'image' == $settings->button_type ) { ?>
.fl-node-<?php echo $id; ?> .pp-modal-trigger img {
    border-radius: <?php echo $settings->button_border_radius; ?>px;
    <?php if ( 'auto' != $settings->image_size ) { ?>
    width: <?php echo $settings->image_width; ?>px;
    height: <?php echo $settings->image_height; ?>px;
    <?php } ?>
}
<?php } ?>

<?php if ( 'icon' == $settings->button_type ) { ?>
.fl-node-<?php echo $id; ?> .pp-modal-trigger .pp-modal-trigger-icon {
    font-size: <?php echo $settings->icon_size; ?>px;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-modal-height-auto,
#modal-<?php echo $id; ?>.pp-modal-height-auto {
    display: block !important;
    position: absolute;
    top: -99999px;
    width: <?php echo $settings->modal_width; ?>px;
    visibility: hidden;
}

.fl-node-<?php echo $id; ?> .pp-modal-height-auto .pp-modal-overlay,
#modal-<?php echo $id; ?>.pp-modal-height-auto .pp-modal-overlay {
    display: none !important;
}

.fl-node-<?php echo $id; ?> .pp-modal,
#modal-<?php echo $id; ?> .pp-modal {
    <?php if ( 'color' == $settings->modal_background ) { ?>
    background-color: <?php echo '' == $settings->modal_bg_color ? 'transparent' : pp_hex2rgba('#'.$settings->modal_bg_color, $settings->modal_bg_opacity ? $settings->modal_bg_opacity : 0); ?>;
    <?php } else { ?>
    background-image: url(<?php echo wp_get_attachment_url( $settings->modal_bg_photo ); ?>);
    background-size: <?php echo $settings->modal_bg_size; ?>;
    background-repeat: <?php echo $settings->modal_bg_repeat; ?>;
    <?php } ?>
    <?php if ( 'yes' == $settings->modal_shadow ) { ?>
    -webkit-box-shadow: <?php echo $settings->box_shadow_h; ?>px <?php echo $settings->box_shadow_v; ?>px <?php echo $settings->box_shadow_blur; ?>px <?php echo $settings->box_shadow_spread; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity ); ?>;
    -moz-box-shadow: <?php echo $settings->box_shadow_h; ?>px <?php echo $settings->box_shadow_v; ?>px <?php echo $settings->box_shadow_blur; ?>px <?php echo $settings->box_shadow_spread; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity ); ?>;
    -o-box-shadow: <?php echo $settings->box_shadow_h; ?>px <?php echo $settings->box_shadow_v; ?>px <?php echo $settings->box_shadow_blur; ?>px <?php echo $settings->box_shadow_spread; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity ); ?>;
    box-shadow: <?php echo $settings->box_shadow_h; ?>px <?php echo $settings->box_shadow_v; ?>px <?php echo $settings->box_shadow_blur; ?>px <?php echo $settings->box_shadow_spread; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity ); ?>;
    <?php } ?>
}

<?php if ( 'enabled' == $settings->modal_backlight ) { ?>
.fl-node-<?php echo $id; ?> .pp-modal:before,
#modal-<?php echo $id; ?> .pp-modal:before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: inherit;
    z-index: -1;
    filter: blur(10px);
    -moz-filter: blur(10px);
    -webkit-filter: blur(10px);
    -o-filter: blur(10px);
    transition: all 2s linear;
    -moz-transition: all 2s linear;
    -webkit-transition: all 2s linear;
    -o-transition: all 2s linear;
}
<?php } ?>
.fl-node-<?php echo $id; ?> .pp-modal.layout-standard,
#modal-<?php echo $id; ?> .pp-modal.layout-standard {
    width: <?php echo $settings->modal_width; ?>px;
    height: <?php echo 'yes' == $settings->modal_height_auto ? 'auto' : $settings->modal_height . 'px'; ?>;
    max-width: 90%;
    <?php if ( 'none' != $settings->modal_border ) { ?>
    border<?php echo $settings->modal_border_position == 'default' ? '' : '-' . $settings->modal_border_position; ?>: <?php echo $settings->modal_border_width; ?>px <?php echo $settings->modal_border; ?> #<?php echo $settings->modal_border_color; ?>;
    <?php } ?>
    border-radius: <?php echo $settings->modal_border_radius; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-modal.layout-fullscreen,
#modal-<?php echo $id; ?> .pp-modal.layout-fullscreen {
    margin-top: <?php echo $settings->modal_margin_top; ?>px;
    margin-left: <?php echo $settings->modal_margin_left; ?>px;
    margin-bottom: <?php echo $settings->modal_margin_bottom; ?>px;
    margin-right: <?php echo $settings->modal_margin_right; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-modal .pp-modal-header,
#modal-<?php echo $id; ?> .pp-modal .pp-modal-header {
    background-color: <?php echo $settings->title_bg ? '#' . $settings->title_bg : 'transparent'; ?>;
    border-bottom: <?php echo $settings->title_border; ?>px <?php echo $settings->title_border_style; ?> #<?php echo $settings->title_border_color; ?>;
    <?php if ( 'fullscreen' != $settings->modal_layout ) { ?>
    border-top-left-radius: <?php echo $settings->modal_border_radius; ?>px;
    border-top-right-radius: <?php echo $settings->modal_border_radius; ?>px;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-modal .pp-modal-title,
#modal-<?php echo $id; ?> .pp-modal .pp-modal-title {
    padding: 10px <?php echo $settings->title_padding; ?>px;
    color: #<?php echo $settings->title_color; ?>;
    <?php if( $settings->title_font_family['family'] != 'Default' ) {
        FLBuilderFonts::font_css( $settings->title_font_family );
    } ?>
    font-size: <?php echo $settings->title_font_size; ?>px;
    text-align: <?php echo $settings->title_alignment; ?>;
}
.fl-node-<?php echo $id; ?> .pp-modal .pp-modal-content,
#modal-<?php echo $id; ?> .pp-modal .pp-modal-content {
    <?php echo ('' != $settings->content_text_color) ? 'color: #'.$settings->content_text_color.';' : ''; ?>
    padding: <?php echo $settings->modal_padding; ?>px;
    overflow-y: auto;
}
.fl-node-<?php echo $id; ?> .pp-modal .pp-modal-content.pp-modal-frame:before,
#modal-<?php echo $id; ?> .pp-modal .pp-modal-content.pp-modal-frame:before {
    background: url(<?php echo $module->url . 'loader.gif'; ?>) no-repeat;
    background-position: 50%;
    content: "";
    display: block;
    width: 32px;
    height: 32px;
    border-radius: 100%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate3D(-50%, -50%, 0);
}
.fl-node-<?php echo $id; ?> .pp-modal .pp-modal-content-inner,
#modal-<?php echo $id; ?> .pp-modal .pp-modal-content-inner {
    position: relative;
    height: 100%;
    <?php if ( 'none' != $settings->content_border ) { ?>
    border: <?php echo $settings->content_border_width; ?>px <?php echo $settings->content_border; ?> #<?php echo $settings->content_border_color; ?>;
    border-radius: <?php echo $settings->content_border_radius; ?>px;
    <?php } ?>
    <?php if ( 'fullscreen' == $settings->modal_layout ) { ?>
    overflow-y: auto;
    <?php } else { ?>
    overflow: hidden;
    <?php } ?>
    padding: <?php echo $settings->content_padding; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-modal-close,
#modal-<?php echo $id; ?> .pp-modal-close {
    <?php if ( 'none' == $settings->close_btn_toggle ) { ?>
    display: none;
    <?php } ?>
    background: <?php echo $settings->close_btn_bg ? '#' . $settings->close_btn_bg : 'transparent'; ?>;
    border: <?php echo '' == $settings->close_btn_border ? 0 : $settings->close_btn_border; ?>px solid #<?php echo $settings->close_btn_border_color; ?>;
    border-radius: <?php echo $settings->close_btn_border_radius; ?>px;
    width: <?php echo $settings->close_btn_size; ?>px;
    height: <?php echo $settings->close_btn_size; ?>px;
    position: absolute;
    z-index: 5;
    -webkit-transition: background 0.2s ease-in-out;
    -moz-transition: background 0.2s ease-in-out;
    transition: background 0.2s ease-in-out;
}
.fl-node-<?php echo $id; ?> .pp-modal-close:hover,
#modal-<?php echo $id; ?> .pp-modal-close:hover {
    background: <?php echo $settings->close_btn_bg_hover ? '#' . $settings->close_btn_bg_hover : 'transparent'; ?>;
    -webkit-transition: background 0.2s ease-in-out;
    -moz-transition: background 0.2s ease-in-out;
    transition: background 0.2s ease-in-out;
}
.fl-node-<?php echo $id; ?> .pp-modal-close.box-top-right,
#modal-<?php echo $id; ?> .pp-modal-close.box-top-right {
    top: <?php echo $settings->close_btn_top; ?>px;
    right: <?php echo $settings->close_btn_right; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-modal-close.box-top-left,
#modal-<?php echo $id; ?> .pp-modal-close.box-top-left {
    top: <?php echo $settings->close_btn_top; ?>px;
    left: <?php echo $settings->close_btn_left; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-modal-close.win-top-right,
#modal-<?php echo $id; ?> .pp-modal-close.win-top-right {
    top: <?php echo $settings->close_btn_top; ?>px;
    right: <?php echo $settings->close_btn_right; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-modal-close.win-top-left,
#modal-<?php echo $id; ?> .pp-modal-close.win-top-left {
    top: <?php echo $settings->close_btn_top; ?>px;
    left: <?php echo $settings->close_btn_left; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-modal-close .bar-wrap,
#modal-<?php echo $id; ?> .pp-modal-close .bar-wrap {
    width: 100%;
    height: 100%;
    -webkit-transition: background 0.2s ease-in-out;
    -moz-transition: background 0.2s ease-in-out;
    transition: background 0.2s ease-in-out;
}
.fl-node-<?php echo $id; ?> .pp-modal-close .bar-wrap span,
#modal-<?php echo $id; ?> .pp-modal-close .bar-wrap span {
    background: #<?php echo $settings->close_btn_color; ?>;
    height: <?php echo ( $settings->close_btn_weight == 0 || $settings->close_btn_weight == '' ) ? 1 : $settings->close_btn_weight; ?>px;
    margin-top: <?php echo ($settings->close_btn_weight == 1 || $settings->close_btn_weight == 0 || $settings->close_btn_weight == '') ? 0 : -1; ?>px;
    -webkit-transition: background 0.2s ease-in-out;
    -moz-transition: background 0.2s ease-in-out;
    transition: background 0.2s ease-in-out;
}
.fl-node-<?php echo $id; ?> .pp-modal-close:hover .bar-wrap span,
#modal-<?php echo $id; ?> .pp-modal-close:hover .bar-wrap span {
    background: #<?php echo $settings->close_btn_color_hover; ?>;
    -webkit-transition: background 0.2s ease-in-out;
    -moz-transition: background 0.2s ease-in-out;
    transition: background 0.2s ease-in-out;
}
.fl-node-<?php echo $id; ?> .pp-modal-container.<?php echo $settings->animation_load; ?>.animated,
#modal-<?php echo $id; ?> .pp-modal-container.<?php echo $settings->animation_load; ?>.animated {
    -webkit-animation-duration: <?php echo $settings->animation_load_duration == 0 ? 0.001 : $settings->animation_load_duration; ?>s;
    animation-duration: <?php echo $settings->animation_load_duration == 0 ? 0.001 : $settings->animation_load_duration; ?>s;
}
.fl-node-<?php echo $id; ?> .pp-modal-container.<?php echo $settings->animation_exit; ?>.animated,
#modal-<?php echo $id; ?> .pp-modal-container.<?php echo $settings->animation_exit; ?>.animated {
    -webkit-animation-duration: <?php echo $settings->animation_exit_duration == 0 ? 0.001 : $settings->animation_exit_duration; ?>s;
    animation-duration: <?php echo $settings->animation_exit_duration == 0 ? 0.001 : $settings->animation_exit_duration; ?>s;
}
<?php if( 'none' != $settings->overlay_toggle ) { ?>
.fl-node-<?php echo $id; ?> .pp-modal-container,
#modal-<?php echo $id; ?> .pp-modal-container {
    background-color: <?php echo $settings->overlay_bg_color ? pp_hex2rgba( '#' . $settings->overlay_bg_color, $settings->overlay_opacity ) : 'transparent'; ?>;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-modal-overlay,
#modal-<?php echo $id; ?> .pp-modal-overlay {
	display: none;
    background-color: <?php echo $settings->overlay_bg_color ? pp_hex2rgba( '#' . $settings->overlay_bg_color, $settings->overlay_opacity ) : 'transparent'; ?>;
}

<?php if ( 'photo' == $settings->modal_type ) { ?>
<?php if ( 'fullscreen' != $settings->modal_layout ) { ?>
.fl-node-<?php echo $id; ?> .pp-modal .pp-modal-content img,
#modal-<?php echo $id; ?> .pp-modal .pp-modal-content img {
    border-radius: <?php echo $settings->modal_border_radius; ?>px;
}
<?php } ?>
<?php } ?>

@media only screen and (max-width: <?php echo $settings->media_breakpoint; ?>px) {
    .fl-node-<?php echo $id; ?> .pp-modal.layout-fullscreen,
    #modal-<?php echo $id; ?> .pp-modal.layout-fullscreen {
        top: 0 !important;
        margin 10px !important;
    }
    .fl-node-<?php echo $id; ?> .pp-modal.layout-standard,
    #modal-<?php echo $id; ?> .pp-modal.layout-standard {
        margin-top: 20px;
        margin-bottom: 20px;
    }
}

@media only screen and (max-width: 767px) {
    .fl-node-<?php echo $id; ?> .pp-modal.layout-standard,
    #modal-<?php echo $id; ?> .pp-modal.layout-standard {
        margin-top: 20px;
        margin-bottom: 20px;
    }
}
