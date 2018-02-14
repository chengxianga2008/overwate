.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap {
    background: <?php echo ($settings->announcement_bar_background) ? '#'.$settings->announcement_bar_background : 'transparent'; ?>;
    <?php if( $settings->announcement_bar_position == 'top' ) { ?>
        top: 0;
        border-bottom-color: <?php echo ($settings->announcement_bar_border_color) ? '#'.$settings->announcement_bar_border_color : '#000'; ?>;
        border-bottom-style: <?php echo $settings->announcement_bar_border_type; ?>;
        border-bottom-width: <?php echo ($settings->announcement_bar_border_width >= 0) ? $settings->announcement_bar_border_width.'px' : '0'; ?>;
    <?php } ?>
    <?php if( $settings->announcement_bar_position == 'bottom' ) { ?>
        bottom: 0;
        border-top-color: <?php echo ($settings->announcement_bar_border_color) ? '#'.$settings->announcement_bar_border_color : '#000'; ?>;
        border-top-style: <?php echo $settings->announcement_bar_border_type; ?>;
        border-top-width: <?php echo ($settings->announcement_bar_border_width >= 0) ? $settings->announcement_bar_border_width.'px' : '0'; ?>;
    <?php } ?>
    <?php if($settings->announcement_box_shadow == 'yes') { ?>
		-webkit-box-shadow: <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_h']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_v']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_blur']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->announcement_box_shadow_color, $settings->announcement_box_shadow_opacity ); ?>;
		-moz-box-shadow: <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_h']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_v']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_blur']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->announcement_box_shadow_color, $settings->announcement_box_shadow_opacity ); ?>;
	    -o-box-shadow: <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_h']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_v']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_blur']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->announcement_box_shadow_color, $settings->announcement_box_shadow_opacity ); ?>;
	    box-shadow: <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_h']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_v']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_blur']; ?>px <?php echo $settings->announcement_box_shadow_options['announcement_box_shadow_spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->announcement_box_shadow_color, $settings->announcement_box_shadow_opacity ); ?>;
	<?php } ?>
}

<?php if( $settings->announcement_bar_position == 'top' && ! FLBuilderModel::is_builder_active() ) { ?>
    .admin-bar .fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap {
        top: 32px;
    }
<?php } ?>

<?php if ( ! FLBuilderModel::is_builder_active() ) { ?>
.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap.pp-announcement-bar-bottom {
	opacity: 0;
    visibility: hidden;
}
.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap.pp-announcement-bar-top {
    <?php if ( is_admin_bar_showing() ) { ?>
    margin-top: -<?php echo $settings->announcement_bar_height+146; ?>px;
    <?php } else { ?>
    margin-top: -<?php echo $settings->announcement_bar_height+100; ?>px;
    <?php } ?>
}
<?php } ?>
.pp-top-bar {
    margin-top: <?php echo $settings->announcement_bar_height; ?>px !important;
}
.pp-top-bar-admin {
    margin-top: <?php echo $settings->announcement_bar_height+32; ?>px !important;
}
.pp-top-bar .fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap.pp-announcement-bar-top {
	opacity: 1;
    margin-top: 0;
}
.pp-bottom-bar .fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap.pp-announcement-bar-bottom {
	opacity: 1;
    visibility: visible;
}
.pp-bottom-bar {
    margin-bottom: <?php echo $settings->announcement_bar_height; ?>px;
}

.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap .pp-announcement-bar-inner {
    height: <?php echo $settings->announcement_bar_height; ?>px;
    text-align: <?php echo $settings->announcement_text_align; ?>;
}
.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap .pp-announcement-bar-icon .pp-icon {
    color: <?php echo ($settings->announcement_icon_color) ? '#'.$settings->announcement_icon_color : '#000'; ?>;
    font-size: <?php echo ($settings->announcement_icon_size) ? $settings->announcement_icon_size.'px' : '20px'; ?>;
}
.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap .pp-announcement-bar-content p {
    color: <?php echo ($settings->announcement_text_color) ? '#'.$settings->announcement_text_color : '#000'; ?>;
    <?php if( $settings->announcement_text_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->announcement_text_font ); ?><?php } ?>
    font-size: <?php echo ($settings->announcement_text_font_size['announcement_text_font_size_desktop'] >= 0) ? $settings->announcement_text_font_size['announcement_text_font_size_desktop'].'px' : '16px'; ?>;
    line-height: <?php echo ($settings->announcement_text_line_height['announcement_text_line_height_desktop'] >= 0) ? $settings->announcement_text_line_height['announcement_text_line_height_desktop'] : '1.7'; ?>;
}
.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap .pp-announcement-bar-link a {
    <?php if( $settings->announcement_link_type == 'button' ) { ?>
        background: <?php echo ($settings->announcement_button_backgrounds['primary']) ? '#'.$settings->announcement_button_backgrounds['primary'] : 'transparent'; ?>;
        border-color: <?php echo ($settings->announcement_button_border_color) ? '#'.$settings->announcement_button_border_color : '#000'; ?>;
        border-style: <?php echo $settings->announcement_button_border_type; ?>;
        border-radius: <?php echo ($settings->announcement_button_border_radius >= 0) ? $settings->announcement_button_border_radius.'px' : '0'; ?>;
        border-width: <?php echo ($settings->announcement_button_border_width >= 0) ? $settings->announcement_button_border_width.'px' : '0'; ?>;
        padding-top: <?php echo ($settings->announcement_button_padding['announcement_button_top_padding'] >= 0) ? $settings->announcement_button_padding['announcement_button_top_padding'].'px' : '0'; ?>;
        padding-right: <?php echo ($settings->announcement_button_padding['announcement_button_right_padding'] >= 0) ? $settings->announcement_button_padding['announcement_button_right_padding'].'px' : '0'; ?>;
        padding-bottom: <?php echo ($settings->announcement_button_padding['announcement_button_bottom_padding'] >= 0) ? $settings->announcement_button_padding['announcement_button_bottom_padding'].'px' : '0'; ?>;
        padding-left: <?php echo ($settings->announcement_button_padding['announcement_button_left_padding'] >= 0) ? $settings->announcement_button_padding['announcement_button_left_padding'].'px' : '0'; ?>;
    <?php } ?>
    color: <?php echo ($settings->announcement_link_color['primary']) ? '#'.$settings->announcement_link_color['primary'] : '#000'; ?>;
    <?php if( $settings->announcement_link_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->announcement_link_font ); ?><?php } ?>
    font-size: <?php echo ($settings->announcement_link_font_size >= 0) ? $settings->announcement_link_font_size.'px' : '16px'; ?>;
}
.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap .pp-announcement-bar-link a:hover {
    <?php if( $settings->announcement_link_type == 'button' ) { ?>
        background: <?php echo ($settings->announcement_button_backgrounds['secondary']) ? '#'.$settings->announcement_button_backgrounds['secondary'] : 'transparent'; ?>;
    <?php } ?>
    color: <?php echo ($settings->announcement_link_color['secondary']) ? '#'.$settings->announcement_link_color['secondary'] : '#000'; ?>;
}

.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap .pp-announcement-bar-close-button .pp-close-button {
    color: <?php echo ($settings->announcement_close_color) ? '#'.$settings->announcement_close_color : '#000'; ?>;
    font-size: <?php echo ($settings->close_size >= 0) ? $settings->close_size.'px' : '16px'; ?>;
}

@media only screen and ( max-width: 782px ) {
    .pp-top-bar-admin {
        margin-top: <?php echo $settings->announcement_bar_height+46; ?>px !important;
    }
    .logged-in.admin-bar .fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap.pp-announcement-bar-top {
        top: 46px;
    }
    .pp-announcement-bar-link, .pp-announcement-bar-icon, .pp-announcement-bar-content p {
        display: inline-block;
        padding: 5px;
    }
}
@media only screen and ( max-width: 768px ) {
    .fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap .pp-announcement-bar-content p {
        font-size: <?php echo ($settings->announcement_text_font_size['announcement_text_font_size_tablet'] >= 0) ? $settings->announcement_text_font_size['announcement_text_font_size_tablet'].'px' : '16px'; ?>;
        line-height: <?php echo ($settings->announcement_text_line_height['announcement_text_line_height_tablet'] >= 0) ? $settings->announcement_text_line_height['announcement_text_line_height_tablet'] : '1.7'; ?>;
    }
}

@media only screen and ( max-width: 480px ) {
    .fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap .pp-announcement-bar-content p {
        font-size: <?php echo ($settings->announcement_text_font_size['announcement_text_font_size_mobile'] >= 0) ? $settings->announcement_text_font_size['announcement_text_font_size_mobile'].'px' : '16px'; ?>;
        line-height: <?php echo ($settings->announcement_text_line_height['announcement_text_line_height_mobile'] >= 0) ? $settings->announcement_text_line_height['announcement_text_line_height_mobile'] : '1.7'; ?>;
    }
}
