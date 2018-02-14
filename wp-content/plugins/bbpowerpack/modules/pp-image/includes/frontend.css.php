.fl-node-<?php echo $id; ?> .pp-photo-container .pp-photo-content {
    background: <?php echo ($settings->box_background) ? '#'.$settings->box_background : 'transparent'; ?>;
    border-color: <?php echo ($settings->border_color) ? '#'.$settings->border_color : 'transparent'; ?>;
    border-style: <?php echo $settings->box_border; ?>;
    -webkit-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    -moz-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    -o-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    -ms-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    border-width: <?php echo ($settings->border_width >= 0) ? $settings->border_width.'px' : '0'; ?>;
    <?php if( $settings->box_shadow == 'enable' ) { ?>
        -webkit-box-shadow: <?php echo $settings->box_shadow_settings['h']; ?>px <?php echo $settings->box_shadow_settings['v']; ?>px <?php echo $settings->box_shadow_settings['blur']; ?>px <?php echo $settings->box_shadow_settings['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity ); ?>;
        -moz-box-shadow: <?php echo $settings->box_shadow_settings['h']; ?>px <?php echo $settings->box_shadow_settings['v']; ?>px <?php echo $settings->box_shadow_settings['blur']; ?>px <?php echo $settings->box_shadow_settings['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity ); ?>;
        -o-box-shadow: <?php echo $settings->box_shadow_settings['h']; ?>px <?php echo $settings->box_shadow_settings['v']; ?>px <?php echo $settings->box_shadow_settings['blur']; ?>px <?php echo $settings->box_shadow_settings['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity ); ?>;
        box-shadow: <?php echo $settings->box_shadow_settings['h']; ?>px <?php echo $settings->box_shadow_settings['v']; ?>px <?php echo $settings->box_shadow_settings['blur']; ?>px <?php echo $settings->box_shadow_settings['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity ); ?>;
    <?php } ?>
    padding-top: <?php echo ($settings->box_padding['top'] >= 0) ? $settings->box_padding['top'].'px' : '0'; ?>;
    padding-bottom: <?php echo ($settings->box_padding['bottom'] >= 0) ? $settings->box_padding['bottom'].'px' : '0'; ?>;
    padding-left: <?php echo ($settings->box_padding['left'] >= 0) ? $settings->box_padding['left'].'px' : '0'; ?>;
    padding-right: <?php echo ($settings->box_padding['right'] >= 0) ? $settings->box_padding['right'].'px' : '0'; ?>;
}
.fl-node-<?php echo $id; ?> .pp-photo-container .pp-photo-content .pp-photo-content-inner {
    -webkit-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    -moz-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    -o-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    -ms-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
}
.fl-node-<?php echo $id; ?> .pp-photo-container .pp-photo-content .pp-photo-content-inner a {
    display: block;
    text-decoration: none !important;
}
<?php if( $settings->image_border_type == 'inside' ) { ?>
    <?php if(!empty($settings->link_type)) { ?>
        .fl-node-<?php echo $id; ?> .pp-photo-container .pp-photo-content .pp-photo-content-inner a:before {
            bottom: 0;
            content: '';
            display: block;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            <?php if($settings->image_border_color) { ?>border-color: #<?php echo $settings->image_border_color; ?>;<?php } ?>
            border-style: <?php echo $settings->image_border_style; ?>;
            <?php if($settings->image_border_width) { ?>border-width: <?php echo $settings->image_border_width; ?>px;<?php } ?>
            <?php if($settings->image_spacing) { ?>margin: <?php echo $settings->image_spacing; ?>px;<?php } ?>
        }
    <?php } else if( '' ==  $settings->link_type ) { ?>
        .fl-node-<?php echo $id; ?> .pp-photo-container .pp-photo-content .pp-photo-content-inner:before {
            bottom: 0;
            content: '';
            display: block;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            <?php if($settings->image_border_color) { ?>border-color: #<?php echo $settings->image_border_color; ?>;<?php } ?>
            border-style: <?php echo $settings->image_border_style; ?>;
            <?php if($settings->image_border_width) { ?>border-width: <?php echo $settings->image_border_width; ?>px;<?php } ?>
            <?php if($settings->image_spacing) { ?>margin: <?php echo $settings->image_spacing; ?>px;<?php } ?>
        }
    <?php } ?>
<?php } ?>
<?php if( $settings->image_border_type == 'outside' ) { ?>
    .fl-node-<?php echo $id; ?> .pp-photo-container .pp-photo-content .pp-photo-content-inner img {
        <?php if($settings->image_border_color) { ?>border-color: #<?php echo $settings->image_border_color; ?>;<?php } ?>
        border-style: <?php echo $settings->image_border_style; ?>;
        <?php if($settings->image_border_width) { ?>border-width: <?php echo $settings->image_border_width; ?>px;<?php } ?>
    }
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-photo-caption {
    <?php if( $settings->show_caption != 'hover' ) { ?>
        background: <?php echo pp_hex2rgba('#'.$settings->caption_color['secondary'], $settings->caption_opacity); ?>;
    <?php } ?>
    color: <?php echo ($settings->caption_color['primary']) ? '#'.$settings->caption_color['primary'] : '#000000'; ?>;
    <?php if( $settings->caption_font['family']	!= 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->caption_font ); ?><?php } ?>
    font-size: <?php echo ($settings->caption_font_size['desktop'] >= 0) ? $settings->caption_font_size['desktop'].'px' : '18px'; ?>;
    line-height: <?php echo ($settings->caption_line_height['desktop'] >= 0) ? $settings->caption_line_height['desktop'] : '1.6'; ?>;
    padding-top: <?php echo ($settings->caption_padding['top'] >= 0) ? $settings->caption_padding['top'].'px' : '0'; ?>;
    padding-bottom: <?php echo ($settings->caption_padding['bottom'] >= 0) ? $settings->caption_padding['bottom'].'px' : '0'; ?>;
    padding-left: <?php echo ($settings->caption_padding['left'] >= 0) ? $settings->caption_padding['left'].'px' : '0'; ?>;
    padding-right: <?php echo ($settings->caption_padding['right'] >= 0) ? $settings->caption_padding['right'].'px' : '0'; ?>;
    text-align: <?php echo $settings->caption_alignment; ?>;
}
.fl-node-<?php echo $id; ?> .pp-overlay-wrap .pp-overlay-bg {
    background: <?php echo pp_hex2rgba('#'.$settings->caption_color['secondary'], $settings->caption_opacity); ?>;
    -webkit-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    -moz-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    -o-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    -ms-border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
    border-radius: <?php echo ($settings->border_radius >= 0) ? $settings->border_radius.'px' : '0'; ?>;
}

@media only screen and ( max-width: 768px ) {
    .fl-node-<?php echo $id; ?> .pp-photo-caption {
        font-size: <?php echo ($settings->caption_font_size['tablet'] >= 0) ? $settings->caption_font_size['tablet'].'px' : '18px'; ?>;
        line-height: <?php echo ($settings->caption_line_height['tablet'] >= 0) ? $settings->caption_line_height['tablet'] : '1.6'; ?>;
    }
}

@media only screen and ( max-width: 480px ) {
    .fl-node-<?php echo $id; ?> .pp-photo-caption {
        font-size: <?php echo ($settings->caption_font_size['mobile'] >= 0) ? $settings->caption_font_size['mobile'].'px' : '18px'; ?>;
        line-height: <?php echo ($settings->caption_line_height['mobile'] >= 0) ? $settings->caption_line_height['mobile'] : '1.6'; ?>;
    }
}
