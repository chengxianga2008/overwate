.fl-node-<?php echo $id; ?> .pp-info-banner-content {
    width: 100%;
    position: relative;
    overflow: hidden;
    background: <?php echo $settings->banner_bg_color ? '#' . $settings->banner_bg_color : 'transparent' ?>;
    <?php if( $settings->banner_min_height ) { ?>
	height: <?php echo $settings->banner_min_height; ?>px;
    <?php } ?>
    <?php if( $settings->banner_border_type ) { ?>
	border-style: <?php echo $settings->banner_border_type; ?>;
    <?php } ?>
    border-color: <?php echo $settings->banner_border_color ? '#' . $settings->banner_border_color : 'transparent' ?>;
    <?php if( $settings->banner_border_width >= 0 ) { ?>
    border-width: <?php echo $settings->banner_border_width; ?>px;
    <?php } ?>
    <?php if( $settings->banner_image_arrangement == 'background' && $settings->banner_image ) { ?>
    background-image: url('<?php echo $settings->banner_image_src; ?>');
    <?php } ?>
    <?php if( $settings->banner_bg_size ) { ?>
    background-size: <?php echo $settings->banner_bg_size; ?>;
    <?php } ?>
    <?php if( $settings->banner_bg_repeat ) { ?>
    background-repeat: <?php echo $settings->banner_bg_repeat; ?>;
    <?php } ?>
    background-position: <?php echo $settings->banner_bg_position; ?>;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content:before {
    content: "";
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
    background-color: <?php echo $settings->banner_bg_overlay ? '#' . $settings->banner_bg_overlay : 'transparent'; ?>;
    opacity: <?php echo $settings->banner_bg_opacity; ?>;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content .pp-info-banner-inner {
    display: table;
    width: 100%;
    height: 100%;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content .info-banner-wrap {
    display: table-cell;
    vertical-align: middle;
	position: relative;
	z-index: 5;
    <?php if( $settings->banner_info_padding >= 0 ) { ?>
	padding-top: <?php echo $settings->banner_info_padding; ?>px;
    <?php } ?>
    <?php if( $settings->banner_info_padding_b >= 0 ) { ?>
	padding-bottom: <?php echo $settings->banner_info_padding_b; ?>px;
    <?php } ?>
    <?php if( $settings->banner_info_padding_l >= 0 ) { ?>
	padding-left: <?php echo $settings->banner_info_padding_l; ?>px;
    <?php } ?>
    <?php if( $settings->banner_info_padding_r >= 0 ) { ?>
	padding-right: <?php echo $settings->banner_info_padding_r; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content .info-banner-wrap.animated {
    -webkit-animation-duration: <?php echo $settings->banner_info_transition_duration; ?>ms;
    -moz-animation-duration: <?php echo $settings->banner_info_transition_duration; ?>ms;
    -ms-animation-duration: <?php echo $settings->banner_info_transition_duration; ?>ms;
    -o-animation-duration: <?php echo $settings->banner_info_transition_duration; ?>ms;
    animation-duration: <?php echo $settings->banner_info_transition_duration; ?>ms;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content .info-banner-wrap.info-right {
	text-align: right;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content .info-banner-wrap.info-center {
	text-align: center;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-title {
    line-height: 1;
    <?php if( $settings->banner_title_font['family'] != 'Default' ) { ?>
	<?php FLBuilderFonts::font_css( $settings->banner_title_font ); ?>
    <?php } ?>
    <?php if( $settings->banner_title_font_size ) { ?>
	font-size: <?php echo $settings->banner_title_font_size; ?>px;
    <?php } ?>
    <?php if ( $settings->banner_title_spacing != '' ) { ?>
    letter-spacing: <?php echo $settings->banner_title_spacing; ?>px;
    <?php } ?>
    <?php if( $settings->banner_title_color ) { ?>
	color: #<?php echo $settings->banner_title_color; ?>;
    <?php } ?>
    <?php if( $settings->banner_title_margin >= 0 ) { ?>
	margin-bottom: <?php echo $settings->banner_title_margin; ?>px;
    <?php } ?>
    <?php if( $settings->banner_title_border_type) { ?>
    border-style: <?php echo $settings->banner_title_border_type; ?>;
    <?php } ?>
    border-color: <?php echo $settings->banner_title_border_color ? '#' . $settings->banner_title_border_color : 'transparent'; ?>;
    border-width: 0;
    <?php echo $settings->banner_title_border_position; ?>-width: <?php echo $settings->banner_title_border_width; ?>px;
    <?php if( $settings->banner_title_padding_top >= 0 ) { ?>
    padding-top: <?php echo $settings->banner_title_padding_top; ?>px;
    <?php } ?>
    <?php if( $settings->banner_title_padding_bottom >= 0 ) { ?>
    padding-bottom: <?php echo $settings->banner_title_padding_bottom; ?>px;
    <?php } ?>
    <?php if( $settings->banner_title_padding_left >= 0 ) { ?>
    padding-left: <?php echo $settings->banner_title_padding_left; ?>px;
    <?php } ?>
    <?php if( $settings->banner_title_padding_right >= 0 ) { ?>
    padding-right: <?php echo $settings->banner_title_padding_right; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-description {
    <?php if( $settings->banner_desc_font['family'] != 'Default' ) { ?>
	<?php FLBuilderFonts::font_css( $settings->banner_desc_font ); ?>
    <?php } ?>
    <?php if( $settings->banner_desc_font_size ) { ?>
	font-size: <?php echo $settings->banner_desc_font_size; ?>px;
    <?php } ?>
    <?php if( $settings->banner_desc_color ) { ?>
	color: #<?php echo $settings->banner_desc_color; ?>;
    <?php } ?>
    <?php if( $settings->banner_desc_margin >= 0 ) { ?>
	margin-bottom: <?php echo $settings->banner_desc_margin; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content img {
	position: absolute;
	display: block;
	float: none;
	width: auto;
	margin: 0 auto;
	max-width: none;
	z-index: 1;
    <?php if( $settings->banner_image_height >= 0 ) { ?>
	height: <?php echo $settings->banner_image_height; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content img.pp-info-banner-img {
    <?php if ( $settings->banner_image_effect != 'none' ) { ?>
        opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-info-banner-content img.pp-info-banner-img.<?php echo $settings->banner_image_effect; ?> {
    opacity: 1;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content img.animated {
    -webkit-animation-duration: <?php echo $settings->banner_image_transition_duration; ?>ms;
    -moz-animation-duration: <?php echo $settings->banner_image_transition_duration; ?>ms;
    -ms-animation-duration: <?php echo $settings->banner_image_transition_duration; ?>ms;
    -o-animation-duration: <?php echo $settings->banner_image_transition_duration; ?>ms;
    animation-duration: <?php echo $settings->banner_image_transition_duration; ?>ms;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content img.img-top-right {
	left: auto;
    right: 0;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content img.img-top-center {
    left: 30%;
    -webkit-transform: translateX(-30%);
    -moz-transform: translateX(-30%);
    -ms-transform: translateX(-30%);
    -o-transform: translateX(-30%);
    transform: translateX(-30%);
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content img.img-center-left {
    top: 30%;
    -webkit-transform: translateY(-30%);
    -moz-transform: translateY(-30%);
    -ms-transform: translateY(-30%);
    -o-transform: translateY(-30%);
    transform: translateY(-30%);
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content img.img-center {
    top: 30%;
    left: 30%;
    -webkit-transform: translate(-30%,-30%);
    -moz-transform: translate(-30%,-30%);
    -ms-transform: translate(-30%,-30%);
    -o-transform: translate(-30%,-30%);
    transform: translate(-30%,-30%);
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content img.img-center-right {
    top: 30%;
    -webkit-transform: translateY(-30%);
    -moz-transform: translateY(-30%);
    -ms-transform: translateY(-30%);
    -o-transform: translateY(-30%);
    transform: translateY(-30%);
    left: auto;
    right: 0;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content img.img-bottom-center,
.fl-node-<?php echo $id; ?> .pp-info-banner-content img.img-bottom-left,
.fl-node-<?php echo $id; ?> .pp-info-banner-content img.img-bottom-right {
    top: auto;
    bottom: 0;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content img.img-bottom-center {
    left: 30%;
    transform: translateX(-30%);
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content img.img-bottom-right {
    right: 0;
    left: auto;
}


.fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-button {
	border-style: <?php echo $settings->banner_button_border_type; ?>;
    <?php if( $settings->banner_button_border_color ) { ?>
	border-color: #<?php echo $settings->banner_button_border_color; ?>;
    <?php } ?>
    <?php if( $settings->banner_button_border_width >= 0 ) { ?>
	border-width: <?php echo $settings->banner_button_border_width; ?>px;
    <?php } ?>
    <?php if( $settings->banner_button_border_radius >= 0 ) { ?>
	border-radius: <?php echo $settings->banner_button_border_radius; ?>px;
    <?php } ?>
    background-color: <?php echo $settings->banner_button_bg_color ? '#' . $settings->banner_button_bg_color : 'transparent'; ?>;
	color: #<?php echo $settings->banner_button_text_color; ?>;
    <?php if( $settings->banner_button_font['family'] != 'Default' ) { ?>
	<?php FLBuilderFonts::font_css( $settings->banner_button_font ); ?>
    <?php } ?>
    <?php if( $settings->banner_button_font_size ) { ?>
	font-size: <?php echo $settings->banner_button_font_size; ?>px;
    <?php } ?>
    <?php if( $settings->banner_button_padding_left >= 0 ) { ?>
	padding-left: <?php echo $settings->banner_button_padding_left; ?>px;
    <?php } ?>
    <?php if( $settings->banner_button_padding_right >= 0 ) { ?>
    padding-right: <?php echo $settings->banner_button_padding_right; ?>px;
    <?php } ?>
    <?php if( $settings->banner_button_padding_top >= 0 ) { ?>
    padding-top: <?php echo $settings->banner_button_padding_top; ?>px;
    <?php } ?>
    <?php if( $settings->banner_button_padding_bottom >= 0 ) { ?>
    padding-bottom: <?php echo $settings->banner_button_padding_bottom; ?>px;
    <?php } ?>
	display: inline-block;
    box-shadow: none;
    text-decoration: none;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-link {
    text-decoration: none !important;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
}

.fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-button:hover {
    background-color: <?php echo $settings->banner_button_bg_hover_color ? '#' . $settings->banner_button_bg_hover_color : 'transparent'; ?>;
    <?php if( $settings->banner_button_text_hover ) { ?>
	color: #<?php echo $settings->banner_button_text_hover; ?>;
    <?php } ?>
    border-color: <?php echo $settings->banner_button_border_hover ? '#' . $settings->banner_button_border_hover : 'transparent'; ?>;
    text-decoration: none;
}

@media only screen and (max-width: <?php echo $settings->banner_bp1; ?>px) {
    .fl-node-<?php echo $id; ?> .pp-info-banner-content {
        <?php if( $settings->banner_bp1_min_height ) { ?>
    	height: <?php echo $settings->banner_bp1_min_height; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-title {
        <?php if( $settings->banner_bp1_title_font_size ) { ?>
    	font-size: <?php echo $settings->banner_bp1_title_font_size; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-description {
        <?php if( $settings->banner_bp1_desc_font_size ) { ?>
    	font-size: <?php echo $settings->banner_bp1_desc_font_size; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-button {
        <?php if( $settings->banner_bp1_button_font_size ) { ?>
    	font-size: <?php echo $settings->banner_bp1_button_font_size; ?>px;
        <?php } ?>
    }
}

@media only screen and (max-width: <?php echo $settings->banner_bp2; ?>px) {
    .fl-node-<?php echo $id; ?> .pp-info-banner-content {
        <?php if( $settings->banner_bp2_min_height ) { ?>
    	height: <?php echo $settings->banner_bp2_min_height; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-title {
        <?php if( $settings->banner_bp2_title_font_size ) { ?>
    	font-size: <?php echo $settings->banner_bp2_title_font_size; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-description {
        <?php if( $settings->banner_bp2_desc_font_size ) { ?>
    	font-size: <?php echo $settings->banner_bp2_desc_font_size; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-button {
        <?php if( $settings->banner_bp2_button_font_size ) { ?>
    	font-size: <?php echo $settings->banner_bp2_button_font_size; ?>px;
        <?php } ?>
    }
}

@media only screen and (max-width: <?php echo $settings->banner_bp3; ?>px) {
    .fl-node-<?php echo $id; ?> .pp-info-banner-content {
        <?php if( $settings->banner_bp3_min_height ) { ?>
    	height: <?php echo $settings->banner_bp3_min_height; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-title {
        <?php if( $settings->banner_bp3_title_font_size ) { ?>
    	font-size: <?php echo $settings->banner_bp3_title_font_size; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-description {
        <?php if( $settings->banner_bp3_desc_font_size ) { ?>
    	font-size: <?php echo $settings->banner_bp3_desc_font_size; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-info-banner-content .banner-button {
        <?php if( $settings->banner_bp3_button_font_size ) { ?>
    	font-size: <?php echo $settings->banner_bp3_button_font_size; ?>px;
        <?php } ?>
    }
}
