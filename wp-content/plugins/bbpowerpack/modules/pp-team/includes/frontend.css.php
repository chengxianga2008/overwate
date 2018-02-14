/**
 * This file should contain frontend styles that
 * will be applied to individual module instances.
 *
 * $module An instance of your module class.
 * $id The module's ID.
 * $settings The module's settings.
 */

.fl-node-<?php echo $id; ?> {

}

.fl-node-<?php echo $id; ?> .pp-member-wrapper {
    background-color: <?php echo ($settings->box_background['primary']) ? '#' . $settings->box_background['primary'] : 'transparent'; ?>;
	border-style: <?php echo $settings->box_border; ?>;
	<?php if( $settings->box_border_width && $settings->box_border != 'none' ) { ?>border-width: <?php echo $settings->box_border_width; ?>px; <?php } ?>
	<?php if( $settings->box_border_color ) { ?> border-color: #<?php echo $settings->box_border_color; ?>; <?php } ?>
	<?php if( $settings->box_border_radius >= 0 ) { ?> border-radius: <?php echo $settings->box_border_radius; ?>px; <?php } ?>
    <?php if( $settings->box_padding['top'] >= 0 ) { ?>
	padding-top: <?php echo $settings->box_padding['top']; ?>px;
	<?php } ?>
	<?php if( $settings->box_padding['right'] >= 0 ) { ?>
	padding-right: <?php echo $settings->box_padding['right']; ?>px;
	<?php } ?>
	<?php if( $settings->box_padding['bottom'] >= 0 ) { ?>
	padding-bottom: <?php echo $settings->box_padding['bottom']; ?>px;
	<?php } ?>
	<?php if( $settings->box_padding['left'] >= 0 ) { ?>
	padding-left: <?php echo $settings->box_padding['left']; ?>px;
	<?php } ?>
    opacity: 1;
	text-align: <?php echo $settings->box_content_alignment; ?>;
}

.fl-node-<?php echo $id; ?> .pp-member-wrapper:hover {
    background-color: <?php echo ($settings->box_background['secondary']) ? '#' . $settings->box_background['secondary'] : 'transparent'; ?>;
}

.fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-image img {
	border-style: <?php echo $settings->image_border; ?>;
	<?php if( $settings->image_border_width && $settings->image_border != 'none' ) { ?>border-width: <?php echo $settings->image_border_width; ?>px; <?php } ?>
	<?php if( $settings->image_border_color ) { ?> border-color: #<?php echo $settings->image_border_color; ?>; <?php } ?>
	<?php if( $settings->image_border_radius >= 0 ) { ?> border-radius: <?php echo $settings->image_border_radius; ?>px; <?php } ?>
	<?php if ( 'yes' == $settings->image_shadow_display ) { ?>
    -webkit-box-shadow: <?php echo $settings->image_shadow['horizontal']; ?>px <?php echo $settings->image_shadow['vertical']; ?>px <?php echo $settings->image_shadow['blur']; ?>px <?php echo $settings->image_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->image_shadow_color, $settings->image_shadow_opacity / 100 ); ?>;
    -moz-box-shadow: <?php echo $settings->image_shadow['horizontal']; ?>px <?php echo $settings->image_shadow['vertical']; ?>px <?php echo $settings->image_shadow['blur']; ?>px <?php echo $settings->image_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->image_shadow_color, $settings->image_shadow_opacity / 100 ); ?>;
    -o-box-shadow: <?php echo $settings->image_shadow['horizontal']; ?>px <?php echo $settings->image_shadow['vertical']; ?>px <?php echo $settings->image_shadow['blur']; ?>px <?php echo $settings->image_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->image_shadow_color, $settings->image_shadow_opacity / 100 ); ?>;
    box-shadow: <?php echo $settings->image_shadow['horizontal']; ?>px <?php echo $settings->image_shadow['vertical']; ?>px <?php echo $settings->image_shadow['blur']; ?>px <?php echo $settings->image_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->image_shadow_color, $settings->image_shadow_opacity / 100 ); ?>;
    <?php } ?>
    <?php if( $settings->image_greyscale == 'greyscale' ) { ?>
        -webkit-filter: grayscale(100%);
        -moz-filter: grayscale(100%);
        -ms-filter: grayscale(100%);
        -o-filter: grayscale(100%);
        filter: grayscale(100%);
    <?php } ?>
    overflow: hidden;
}

.fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-content {
    <?php if( $settings->box_content_padding['top'] >= 0 ) { ?>
	padding-top: <?php echo $settings->box_content_padding['top']; ?>px;
	<?php } ?>
	<?php if( $settings->box_content_padding['right'] >= 0 ) { ?>
	padding-right: <?php echo $settings->box_content_padding['right']; ?>px;
	<?php } ?>
	<?php if( $settings->box_content_padding['bottom'] >= 0 ) { ?>
	padding-bottom: <?php echo $settings->box_content_padding['bottom']; ?>px;
	<?php } ?>
	<?php if( $settings->box_content_padding['left'] >= 0 ) { ?>
	padding-left: <?php echo $settings->box_content_padding['left']; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-name {
    <?php if( $settings->title_font['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->title_font ); ?>
   <?php } ?>
	<?php if( $settings->title_font_size_toggle == 'custom' && $settings->title_custom_font_size['desktop'] ) { ?>
		font-size: <?php echo $settings->title_custom_font_size['desktop']; ?>px;
	<?php } ?>
    <?php if( $settings->title_line_height_toggle == 'custom' && $settings->title_custom_line_height['desktop'] ) { ?>
		line-height: <?php echo $settings->title_custom_line_height['desktop']; ?>;
	<?php } ?>
	<?php if( $settings->title_font_color ) { ?>
		color: #<?php echo $settings->title_font_color; ?>;
	<?php } ?>
	margin-top: <?php echo $settings->title_margin['top']; ?>px;
	margin-bottom: <?php echo $settings->title_margin['bottom']; ?>px;
}

.fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-designation {
	<?php if( $settings->designation_font['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->designation_font ); ?>
   <?php } ?>
	<?php if( $settings->designation_font_size_toggle == 'custom' && $settings->designation_custom_font_size['desktop'] ) { ?>
		font-size: <?php echo $settings->designation_custom_font_size['desktop']; ?>px;
	<?php } ?>
	<?php if( $settings->designation_line_height_toggle == 'custom' && $settings->designation_custom_line_height['desktop'] ) { ?>
		line-height: <?php echo $settings->designation_custom_line_height['desktop']; ?>;
	<?php } ?>
	<?php if( $settings->designation_font_color ) { ?>
		color: #<?php echo $settings->designation_font_color; ?>;
	<?php } ?>
	margin-top: <?php echo $settings->designation_margin['top']; ?>px;
	margin-bottom: <?php echo $settings->designation_margin['bottom']; ?>px;
}

.fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-description {
	<?php if( $settings->description_font['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->description_font ); ?>
   <?php } ?>
	<?php if( $settings->description_font_size_toggle == 'custom' && $settings->description_custom_font_size['desktop'] ) { ?>
		font-size: <?php echo $settings->description_custom_font_size['desktop']; ?>px;
	<?php } ?>
	<?php if( $settings->description_line_height_toggle == 'custom' && $settings->description_custom_line_height['desktop'] ) { ?>
		line-height: <?php echo $settings->description_custom_line_height['desktop']; ?>;
	<?php } ?>
	<?php if( $settings->description_font_color ) { ?>
		color: #<?php echo $settings->description_font_color; ?>;
	<?php } ?>
	margin-top: <?php echo $settings->description_margin['top']; ?>px;
	margin-bottom: <?php echo $settings->description_margin['bottom']; ?>px;
}

.fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-separator {
    width: <?php echo $settings->separator_width; ?>px;
    height: <?php echo $settings->separator_height; ?>px;
    background-color: <?php echo ( $settings->separator_color ) ? '#' . $settings->separator_color : 'transparent' ?>;
    display: inline-block;
}

.fl-node-<?php echo $id; ?> .pp-member-social-icons li {
    margin-right: <?php echo $settings->social_links_space; ?>px;
}

.fl-node-<?php echo $id; ?> .pp-member-social-icons li a::before {
    background-color: <?php echo ($settings->social_links_background['primary']) ? '#' . $settings->social_links_background['primary'] : 'transparent'; ?>;
    color: #<?php echo $settings->social_links_color['primary']; ?>;
    font-size: <?php echo $settings->social_links_font_size; ?>px;
	border-style: <?php echo $settings->social_links_border; ?>;
	<?php if( $settings->social_links_border_width && $settings->social_links_border != 'none' ) { ?>border-width: <?php echo $settings->social_links_border_width; ?>px; <?php } ?>
	<?php if( $settings->social_links_border_color['primary'] ) { ?> border-color: #<?php echo $settings->social_links_border_color['primary']; ?>; <?php } ?>
	<?php if( $settings->social_links_border_radius >= 0 ) { ?> border-radius: <?php echo $settings->social_links_border_radius; ?>px; <?php } ?>
    <?php if( $settings->social_links_padding['top'] >= 0 ) { ?>
	padding-top: <?php echo $settings->social_links_padding['top']; ?>px;
	<?php } ?>
	<?php if( $settings->social_links_padding['right'] >= 0 ) { ?>
	padding-right: <?php echo $settings->social_links_padding['right']; ?>px;
	<?php } ?>
	<?php if( $settings->social_links_padding['bottom'] >= 0 ) { ?>
	padding-bottom: <?php echo $settings->social_links_padding['bottom']; ?>px;
	<?php } ?>
	<?php if( $settings->social_links_padding['left'] >= 0 ) { ?>
	padding-left: <?php echo $settings->social_links_padding['left']; ?>px;
	<?php } ?>
    width: <?php echo ($settings->social_links_font_size * 2.2); ?>px;
    height: <?php echo ($settings->social_links_font_size * 2.2); ?>px;
    text-align: <?php echo $settings->box_content_alignment; ?>;
}

.fl-node-<?php echo $id; ?> .pp-member-social-icons li:hover a:before {
    background-color: <?php echo ($settings->social_links_background['secondary']) ? '#' . $settings->social_links_background['secondary'] : 'transparent'; ?>;
    color: #<?php echo $settings->social_links_color['secondary']; ?>;
    <?php if( $settings->social_links_border_color['secondary'] ) { ?> border-color: #<?php echo $settings->social_links_border_color['secondary']; ?>; <?php } ?>
}

@media only screen and (max-width: 768px) {
    .fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-name {
    	<?php if( $settings->title_font_size_toggle == 'custom' && $settings->title_custom_font_size['tablet'] ) { ?>
    		font-size: <?php echo $settings->title_custom_font_size['tablet']; ?>px;
    	<?php } ?>
        <?php if( $settings->title_line_height_toggle == 'custom' && $settings->title_custom_line_height['tablet'] ) { ?>
    		line-height: <?php echo $settings->title_custom_line_height['tablet']; ?>;
    	<?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-designation {
    	<?php if( $settings->designation_font_size_toggle == 'custom' && $settings->designation_custom_font_size['tablet'] ) { ?>
    		font-size: <?php echo $settings->designation_custom_font_size['tablet']; ?>px;
    	<?php } ?>
        <?php if( $settings->designation_line_height_toggle == 'custom' && $settings->designation_custom_line_height['tablet'] ) { ?>
    		line-height: <?php echo $settings->designation_custom_line_height['tablet']; ?>;
    	<?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-description {
    	<?php if( $settings->description_font_size_toggle == 'custom' && $settings->description_custom_font_size['tablet'] ) { ?>
    		font-size: <?php echo $settings->description_custom_font_size['tablet']; ?>px;
    	<?php } ?>
        <?php if( $settings->description_line_height_toggle == 'custom' && $settings->description_custom_line_height['tablet'] ) { ?>
    		line-height: <?php echo $settings->description_custom_line_height['tablet']; ?>;
    	<?php } ?>
    }
}

@media only screen and (max-width: 480px) {
    .fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-name {
    	<?php if( $settings->title_font_size_toggle == 'custom' && $settings->title_custom_font_size['mobile'] ) { ?>
    		font-size: <?php echo $settings->title_custom_font_size['mobile']; ?>px;
    	<?php } ?>
        <?php if( $settings->title_line_height_toggle == 'custom' && $settings->title_custom_line_height['mobile'] ) { ?>
    		line-height: <?php echo $settings->title_custom_line_height['mobile']; ?>;
    	<?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-designation {
    	<?php if( $settings->designation_font_size_toggle == 'custom' && $settings->designation_custom_font_size['mobile'] ) { ?>
    		font-size: <?php echo $settings->designation_custom_font_size['mobile']; ?>px;
    	<?php } ?>
        <?php if( $settings->designation_line_height_toggle == 'custom' && $settings->designation_custom_line_height['mobile'] ) { ?>
    		line-height: <?php echo $settings->designation_custom_line_height['mobile']; ?>;
    	<?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-member-wrapper .pp-member-description {
    	<?php if( $settings->description_font_size_toggle == 'custom' && $settings->description_custom_font_size['mobile'] ) { ?>
    		font-size: <?php echo $settings->description_custom_font_size['mobile']; ?>px;
    	<?php } ?>
        <?php if( $settings->description_line_height_toggle == 'custom' && $settings->description_custom_line_height['mobile'] ) { ?>
    		line-height: <?php echo $settings->description_custom_line_height['mobile']; ?>;
    	<?php } ?>
    }
}
