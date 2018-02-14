.fl-node-<?php echo $id; ?>.pp-subscribe-box {
	display: block;
	<?php if ( !empty($settings->box_bg) ) { ?>
	background-color: <?php echo pp_hex2rgba('#'.$settings->box_bg, $settings->box_bg_opacity / 100); ?>;
	<?php } ?>
	border: <?php echo $settings->form_border_width; ?>px <?php echo $settings->form_border_style; ?> #<?php echo $settings->form_border_color; ?>;
	<?php if ( !empty($settings->box_border_radius) ) { ?>
	border-radius: <?php echo $settings->box_border_radius; ?>px;
	<?php } ?>
	<?php if ( 'yes' == $settings->form_shadow_display && 'welcome_gate' != $settings->box_type ) { ?>
	box-shadow: <?php echo $settings->form_shadow['vertical']; ?>px <?php echo $settings->form_shadow['horizontal']; ?>px <?php echo $settings->form_shadow['blur']; ?>px <?php echo $settings->form_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#' . $settings->form_shadow_color, $settings->form_shadow_opacity / 100 ); ?>;
	<?php } ?>
	max-width: <?php echo $settings->box_width; ?>px;
	height: <?php echo $settings->box_height; ?>px;
	<?php if ( ! FLBuilderModel::is_builder_active() ) { ?>
	position: fixed;
	<?php } ?>
	<?php if ( 'welcome_gate' == $settings->box_type ) { ?>
		<?php if ( ! FLBuilderModel::is_builder_active() ) { ?>
			background-color: transparent;
			background: none;
		<?php } ?>
		top: 0;
		left: 0;
		right: auto;
		bottom: auto;
		-webkit-transition: top 0.5s ease-in-out;
		-moz-transition: top 0.5s ease-in-out;
		transition: top 0.5s ease-in-out;
	<?php } else { ?>
		<?php echo $settings->slidein_position; ?>: -<?php echo $settings->box_width + 50; ?>px;
		bottom: 0;
	<?php } ?>
	z-index: 100002;
	<?php if ( 'slidein' == $settings->box_type ) { ?>
	-webkit-transition: <?php echo $settings->slidein_position; ?> 0.3s ease-in-out;
	-moz-transition: <?php echo $settings->slidein_position; ?> 0.3s ease-in-out;
	transition: <?php echo $settings->slidein_position; ?> 0.3s ease-in-out;
	<?php } ?>
}
.fl-node-<?php echo $id; ?>.pp-subscribe-popup_scroll,
.fl-node-<?php echo $id; ?>.pp-subscribe-popup_exit,
.fl-node-<?php echo $id; ?>.pp-subscribe-popup_auto,
.fl-node-<?php echo $id; ?>.pp-subscribe-welcome_gate {
	<?php if ( ! FLBuilderModel::is_builder_active() ) { ?>
	display: none;
	<?php } ?>
}
<?php if ( 'yes' == $settings->show_overlay || 'welcome_gate' == $settings->box_type ) { ?>
.pp-subscribe-<?php echo $id; ?>-overlay {
	display: none;
	<?php if ( 'welcome_gate' != $settings->box_type ) { ?>
		background-color: <?php echo pp_hex2rgba( '#'.$settings->overlay_color, $settings->overlay_opacity/100 ); ?>;
	<?php } else { ?>
		background-color: <?php echo pp_hex2rgba( '#'.$settings->box_bg, $settings->box_bg_opacity / 100 ); ?>;
	<?php } ?>
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	z-index: 100001;
}
<?php } ?>
.fl-node-<?php echo $id; ?>.pp-subscribe-slidein.pp-box-active {
	<?php echo $settings->slidein_position; ?>: 0;
}
.fl-node-<?php echo $id; ?>.pp-subscribe-box .pp-subscribe-inner {
	position: relative;
    float: left;
	height: 100%;
    width: 100%;
}
.fl-node-<?php echo $id; ?>.pp-subscribe-box .pp-subscribe-body {
	display: block;
    height: 100%;
    width: 100%;
    overflow: hidden;
}
.fl-node-<?php echo $id; ?> .pp-subscribe-content {
	<?php if( $settings->content_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->content_font_family ); ?>
    <?php } ?>
    <?php if( $settings->content_font_size == 'custom' && !empty($settings->content_font_size_custom['desktop']) ) { ?>
    font-size: <?php echo $settings->content_font_size_custom['desktop']; ?>px;
    <?php } ?>
	<?php if( $settings->content_line_height == 'custom' && !empty($settings->content_line_height_custom['desktop']) ) { ?>
    line-height: <?php echo $settings->content_line_height_custom['desktop']; ?>;
    <?php } ?>
	<?php if ( 'standard' != $settings->box_type && 'fixed_bottom' != $settings->box_type ) { ?>
		<?php if ( !empty($settings->box_padding['top']) ) { ?>
		padding-top: <?php echo $settings->box_padding['top']; ?>px;
		<?php } ?>
		<?php if ( !empty($settings->box_padding['right']) ) { ?>
		padding-right: <?php echo $settings->box_padding['right']; ?>px;
		<?php } ?>
		<?php if ( !empty($settings->box_padding['bottom']) ) { ?>
		padding-bottom: <?php echo $settings->box_padding['bottom']; ?>px;
		<?php } ?>
		<?php if ( !empty($settings->box_padding['left']) ) { ?>
		padding-left: <?php echo $settings->box_padding['left']; ?>px;
		<?php } ?>
	<?php } ?>
}
.fl-node-<?php echo $id; ?>.pp-subscribe-box .pp-subscribe-content,
.fl-node-<?php echo $id; ?>.pp-subscribe-box .pp-subscribe-form {
	float: left;
	width: 100%;
}
.fl-node-<?php echo $id; ?>.pp-subscribe-box .pp-box-close {
	border-radius: 100%;
	position: <?php echo 'welcome_gate' == $settings->box_type ? 'fixed' : 'absolute'; ?>;
	<?php if ( 'slidein' == $settings->box_type ) { ?>
    	<?php echo 'left' == $settings->slidein_position ? 'right' : 'left'; ?>: -10px;
	<?php } else { ?>
		right: -10px;
	<?php } ?>
    top: -10px;
	<?php if ( 'welcome_gate' == $settings->box_type ) { ?>
		<?php if ( FLBuilderModel::is_builder_active() ) { ?>
			display: none;
		<?php } ?>
		right: 20px;
		top: 20px;
		background: #dadada;
		border: 2px solid #fff;
		width: 40px;
		padding: 2px;
	<?php } else { ?>
    	background: #000;
		border: 2px solid #000;
		width: 20px;
	<?php } ?>
}
.fl-node-<?php echo $id; ?>.pp-subscribe-box .pp-box-close .pp-box-close-svg {
	display: block;
}
.fl-node-<?php echo $id; ?>.pp-subscribe-box .pp-box-close .pp-box-close-svg path {
	stroke: #<?php echo 'welcome_gate' == $settings->box_type ? $settings->box_bg : 'fff'; ?>;
    fill: transparent;
    stroke-linecap: round;
    stroke-width: 5;
}
.fl-node-<?php echo $id; ?>.pp-subscribe-box .pp-subscribe-content p:last-of-type {
	margin-bottom: 0;
}
.fl-node-<?php echo $id; ?>.pp-subscribe-box .pp-form-field {
	position: relative;
}
.fl-node-<?php echo $id; ?>.pp-subscribe-box .pp-form-error-message {
	position: <?php echo 'welcome_gate' == $settings->box_type ? 'static' : 'absolute'; ?>;
    top: -30px;
}

.fl-node-<?php echo $id; ?> .pp-subscribe-form {
	<?php if ( $settings->box_type != 'welcome_gate' ) { ?>
		background-color: <?php echo ($settings->form_bg_color && $settings->form_bg_type == 'color') ? pp_hex2rgba('#' . $settings->form_bg_color, $settings->form_background_opacity / 100) : 'transparent'; ?>;
	    <?php if( $settings->form_bg_image && $settings->form_bg_type == 'image' ) { ?>
		background-image: url('<?php echo $settings->form_bg_image_src; ?>');
	    <?php } ?>
	    <?php if( $settings->form_bg_size ) { ?>
	    background-size: <?php echo $settings->form_bg_size; ?>;
	    <?php } ?>
	    <?php if( $settings->form_bg_repeat ) { ?>
	    background-repeat: <?php echo $settings->form_bg_repeat; ?>;
	    <?php } ?>
	<?php } ?>
	<?php if ( $settings->box_type == 'standard' || $settings->box_type == 'fixed_bottom' ) { ?>
	    <?php if( $settings->form_border_width >= 0 ) { ?>
	    border-width: <?php echo $settings->form_border_width; ?>px;
	    <?php } ?>
	    <?php if( $settings->form_border_color ) { ?>
	    border-color: #<?php echo $settings->form_border_color; ?>;
	    <?php } ?>
	    <?php if( $settings->form_border_style ) { ?>
	    border-style: <?php echo $settings->form_border_style; ?>;
	    <?php } ?>
	    <?php if( $settings->form_border_radius >= 0 ) { ?>
	    border-radius: <?php echo $settings->form_border_radius; ?>px;
	    <?php } ?>
	    <?php if ( 'yes' == $settings->form_shadow_display ) { ?>
	        -webkit-box-shadow: <?php echo $settings->form_shadow['horizontal']; ?>px <?php echo $settings->form_shadow['vertical']; ?>px <?php echo $settings->form_shadow['blur']; ?>px <?php echo $settings->form_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->form_shadow_color, $settings->form_shadow_opacity / 100 ); ?>;
	        -moz-box-shadow: <?php echo $settings->form_shadow['horizontal']; ?>px <?php echo $settings->form_shadow['vertical']; ?>px <?php echo $settings->form_shadow['blur']; ?>px <?php echo $settings->form_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->form_shadow_color, $settings->form_shadow_opacity / 100 ); ?>;
	        -o-box-shadow: <?php echo $settings->form_shadow['horizontal']; ?>px <?php echo $settings->form_shadow['vertical']; ?>px <?php echo $settings->form_shadow['blur']; ?>px <?php echo $settings->form_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->form_shadow_color, $settings->form_shadow_opacity / 100 ); ?>;
	        box-shadow: <?php echo $settings->form_shadow['horizontal']; ?>px <?php echo $settings->form_shadow['vertical']; ?>px <?php echo $settings->form_shadow['blur']; ?>px <?php echo $settings->form_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->form_shadow_color, $settings->form_shadow_opacity / 100 ); ?>;
	    <?php } ?>
	<?php } ?>
    <?php if( $settings->form_padding['top'] >= 0 ) { ?>
		padding-top: <?php echo $settings->form_padding['top']; ?>px;
	<?php } ?>
	<?php if( $settings->form_padding['right'] >= 0 ) { ?>
		padding-right: <?php echo $settings->form_padding['right']; ?>px;
	<?php } ?>
	<?php if( $settings->form_padding['bottom'] >= 0 ) { ?>
		padding-bottom: <?php echo $settings->form_padding['bottom']; ?>px;
	<?php } ?>
	<?php if( $settings->form_padding['left'] >= 0 ) { ?>
		padding-left: <?php echo $settings->form_padding['left']; ?>px;
	<?php } ?>
	<?php if ( 'fixed_bottom' == $settings->box_type && ! FLBuilderModel::is_builder_active() ) { ?>
		position: fixed;
	    bottom: -999px;
	    left: 0;
	    width: 100%;
	    z-index: 100001;
		-webkit-transition: 0.3s bottom ease-in-out;
		-moz-transition: 0.3s bottom ease-in-out;
		transition: 0.3s bottom ease-in-out;
	<?php } ?>
}
<?php if ( 'fixed_bottom' == $settings->box_type && ! FLBuilderModel::is_builder_active() ) { ?>
.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-box-close {
	position: absolute;
    height: 30px;
    width: 30px;
    display: inline-block;
    margin: 0 auto;
    text-align: center;
    left: 50%;
    top: -15px;
	background: #fff;
    border: 1px solid #<?php echo '' != $settings->form_bg_color ? $settings->form_bg_color : '666'; ?>;
    border-radius: 100%;
	cursor: pointer;
}
.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-box-close:before {
	content: "x";
    color: #<?php echo ('' != $settings->form_bg_color && 'ffffff' != $settings->form_bg_color ) ? $settings->form_bg_color : '666'; ?>;
    font-family: sans-serif;
    font-size: 18px;
}
.fl-node-<?php echo $id; ?> .pp-subscribe-form.pp-box-active {
	bottom: 0;
	right: auto;
	-webkit-transition: 0.3s bottom ease-in-out;
	-moz-transition: 0.3s bottom ease-in-out;
	transition: 0.3s bottom ease-in-out;
}
.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-subscribe-form-inner {
	margin: 0 auto;
	margin-top: 8px;
	max-width: <?php echo $settings->box_width; ?>px;
}
<?php } ?>

<?php if( $settings->input_custom_width == 'custom' ) { ?>
	.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-form-field.pp-name-field {
		width: <?php echo $settings->input_name_width; ?>%;
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-form-field.pp-email-field {
		width: <?php echo $settings->input_email_width; ?>%;
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-form-button {
		width: <?php echo $settings->input_button_width; ?>%;
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-form-button {
	<?php if($settings->btn_align == 'right') { ?>
		float: right;
	<?php } ?>
	<?php if($settings->btn_align == 'center') { ?>
		margin: 0 auto;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-form-field {
	<?php if( $settings->layout == 'inline' ) { ?>
	padding-right: <?php echo $settings->inputs_space; ?>%;
	<?php } ?>
	<?php if( $settings->layout == 'stacked' ) { ?>
	margin-bottom: <?php echo $settings->inputs_space; ?>%;
	<?php } ?>
}

<?php if( $settings->layout == 'compact' ) { ?>
	.fl-node-<?php echo $id; ?> .pp-subscribe-form-compact .pp-form-field.pp-name-field {
		padding-right: <?php echo $settings->inputs_space; ?>%;
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=text],
.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=email] {
	<?php if( $settings->input_field_text_color ) { ?>
    color: #<?php echo $settings->input_field_text_color; ?>;
    <?php } ?>
	background-color: <?php echo $settings->input_field_bg_color ? pp_hex2rgba('#' . $settings->input_field_bg_color, $settings->input_field_background_opacity / 100 ) : 'transparent'; ?>;
	border-width: 0;
	border-color: <?php echo $settings->input_field_border_color ? '#' . $settings->input_field_border_color : 'transparent'; ?>;
    <?php if( $settings->input_field_border_radius >= 0 ) { ?>
	border-radius: <?php echo $settings->input_field_border_radius; ?>px;
    -moz-border-radius: <?php echo $settings->input_field_border_radius; ?>px;
    -webkit-border-radius: <?php echo $settings->input_field_border_radius; ?>px;
    -ms-border-radius: <?php echo $settings->input_field_border_radius; ?>px;
    -o-border-radius: <?php echo $settings->input_field_border_radius; ?>px;
    <?php } ?>
    <?php if( $settings->input_border_width['top'] >= 0 ) { ?>
    border-top-width: <?php echo $settings->input_border_width['top']; ?>px;
    <?php } ?>
	<?php if( $settings->input_border_width['bottom'] >= 0 ) { ?>
    border-bottom-width: <?php echo $settings->input_border_width['bottom']; ?>px;
    <?php } ?>
	<?php if( $settings->input_border_width['left'] >= 0 ) { ?>
    border-left-width: <?php echo $settings->input_border_width['left']; ?>px;
    <?php } ?>
	<?php if( $settings->input_border_width['right'] >= 0 ) { ?>
    border-right-width: <?php echo $settings->input_border_width['right']; ?>px;
    <?php } ?>

    <?php if( $settings->input_field_box_shadow == 'yes' ) { ?>
        box-shadow: <?php echo ($settings->input_shadow_direction == 'inset') ? $settings->input_shadow_direction : ''; ?> 0 0 10px #<?php echo $settings->input_shadow_color; ?>;
        -moz-box-shadow: <?php echo ($settings->input_shadow_direction == 'inset') ? $settings->input_shadow_direction : ''; ?> 0 0 10px #<?php echo $settings->input_shadow_color; ?>;
        -webkit-box-shadow: <?php echo ($settings->input_shadow_direction == 'inset') ? $settings->input_shadow_direction : ''; ?> 0 0 10px #<?php echo $settings->input_shadow_color; ?>;
        -ms-box-shadow: <?php echo ($settings->input_shadow_direction == 'inset') ? $settings->input_shadow_direction : ''; ?> 0 0 10px #<?php echo $settings->input_shadow_color; ?>;
        -o-box-shadow: <?php echo ($settings->input_shadow_direction == 'inset') ? $settings->input_shadow_direction : ''; ?> 0 0 10px #<?php echo $settings->input_shadow_color; ?>;
    <?php } ?>
    <?php if( $settings->input_field_padding['top'] >= 0 ) { ?>
    padding-top: <?php echo $settings->input_field_padding['top']; ?>px;
    <?php } ?>
    <?php if( $settings->input_field_padding['bottom'] >= 0 ) { ?>
    padding-bottom: <?php echo $settings->input_field_padding['bottom']; ?>px;
    <?php } ?>
    <?php if( $settings->input_field_padding['left'] >= 0 ) { ?>
    padding-left: <?php echo $settings->input_field_padding['left']; ?>px;
    <?php } ?>
    <?php if( $settings->input_field_padding['right'] >= 0 ) { ?>
    padding-right: <?php echo $settings->input_field_padding['right']; ?>px;
    <?php } ?>
    <?php if( $settings->input_field_text_alignment ) { ?>
    text-align: <?php echo $settings->input_field_text_alignment; ?>;
    <?php } ?>
    <?php if( $settings->input_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->input_font_family ); ?>
    <?php } ?>
    <?php if( $settings->input_font_size['desktop'] && $settings->input_size == 'custom' ) { ?>
    font-size: <?php echo $settings->input_font_size['desktop']; ?>px;
    <?php } ?>
    text-transform: <?php echo $settings->input_text_transform; ?>;
	height: <?php echo $settings->input_height; ?>px;
}

.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=text]:focus,
.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=email]:focus {
	border-color: <?php echo $settings->input_field_focus_color ? '#' . $settings->input_field_focus_color : 'transparent'; ?>;
}

.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=text]::-webkit-input-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
	<?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
	<?php if( $settings->placeholder_font_size['desktop'] && $settings->placeholder_size == 'custom' ) { ?>
    font-size: <?php echo $settings->placeholder_font_size['desktop']; ?>px;
    <?php } ?>
	text-transform: <?php echo $settings->placeholder_text_transform; ?>;
}

.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=text]:-moz-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
	<?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=text]::-moz-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
	<?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=text]:-ms-input-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
	<?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=email]::-webkit-input-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
	<?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
	<?php if( $settings->placeholder_font_size['desktop'] && $settings->placeholder_size == 'custom' ) { ?>
    font-size: <?php echo $settings->placeholder_font_size['desktop']; ?>px;
    <?php } ?>
	text-transform: <?php echo $settings->placeholder_text_transform; ?>;
}
.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=email]:-moz-placeholder {
    <?php if( $settings->input_placeholder_color ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
	<?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=email]::-moz-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
	<?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=email]:-ms-input-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
	<?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}

<?php

FLBuilder::render_module_css('fl-button', $id, array(
	'align'             => '',
	'bg_color'          => $settings->btn_bg_color,
	'bg_hover_color'    => $settings->btn_bg_hover_color,
	'bg_opacity'        => $settings->btn_bg_opacity,
	'bg_hover_opacity'  => $settings->btn_bg_hover_opacity,
	'border_radius'     => $settings->btn_border_radius,
	'icon'              => $settings->btn_icon,
	'icon_position'     => $settings->btn_icon_position,
	'icon_animation'    => $settings->btn_icon_animation,
	'link'              => '#',
	'link_target'       => '_self',
	'style'             => $settings->btn_style,
	'text'              => $settings->btn_text,
	'text_color'        => $settings->btn_text_color,
	'text_hover_color'  => $settings->btn_text_hover_color,
	'width'             => 'full'
));
?>

.fl-node-<?php echo $id; ?> .pp-subscribe-form a.fl-button:focus {
	border: 0;
}

.fl-node-<?php echo $id; ?> .pp-subscribe-form .fl-button-wrap {
	<?php if( $settings->layout == 'stacked' ) { ?>
		text-align: <?php echo $settings->btn_align; ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-subscribe-form a.fl-button,
.fl-node-<?php echo $id; ?> .pp-subscribe-form a.fl-button:visited {
	text-decoration: none;
	<?php if( $settings->button_font_size['desktop'] && $settings->button_size == 'custom' ) { ?>
	font-size: <?php echo $settings->button_font_size['desktop']; ?>px;
	<?php } ?>
	background-color: <?php echo $settings->btn_bg_color ? pp_hex2rgba('#' . $settings->btn_bg_color, $settings->btn_bg_opacity / 100 ) : 'transparent'; ?>;
	<?php if( $settings->button_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->button_font_family ); ?>
    <?php } ?>
	text-transform: <?php echo $settings->button_text_transform; ?>;
	<?php if( $settings->button_padding['top'] >= 0 ) { ?>
	padding-top: <?php echo $settings->button_padding['top']; ?>px;
	<?php } ?>
	<?php if( $settings->button_padding['right'] >= 0 ) { ?>
	padding-right: <?php echo $settings->button_padding['right']; ?>px;
	<?php } ?>
	<?php if( $settings->button_padding['bottom'] >= 0 ) { ?>
	padding-bottom: <?php echo $settings->button_padding['bottom']; ?>px;
	<?php } ?>
	<?php if( $settings->button_padding['left'] >= 0 ) { ?>
	padding-left: <?php echo $settings->button_padding['left']; ?>px;
	<?php } ?>
	<?php if( $settings->button_border_size['top'] >= 0 ) { ?>
	border-top-width: <?php echo $settings->button_border_size['top']; ?>px;
	<?php } ?>
	<?php if( $settings->button_border_size['right'] >= 0 ) { ?>
	border-right-width: <?php echo $settings->button_border_size['right']; ?>px;
	<?php } ?>
	<?php if( $settings->button_border_size['bottom'] >= 0 ) { ?>
	border-bottom-width: <?php echo $settings->button_border_size['bottom']; ?>px;
	<?php } ?>
	<?php if( $settings->button_border_size['left'] >= 0 ) { ?>
	border-left-width: <?php echo $settings->button_border_size['left']; ?>px;
	<?php } ?>
	<?php if( $settings->btn_border_color ) { ?>
	border-color: #<?php echo $settings->btn_border_color; ?>;
    <?php } ?>
	display: block;
	clear: both;
	height: <?php echo $settings->btn_height; ?>px;
	<?php if( $settings->layout == 'stacked' ) { ?>
		margin-top: <?php echo $settings->btn_margin; ?>%;
	<?php } ?>

}

<?php if( $settings->layout == 'stacked' ) { ?>
	.fl-node-<?php echo $id; ?> .pp-subscribe-form-compact .pp-form-field:last-child {
		margin-bottom: <?php echo $settings->btn_margin; ?>%;
	}
<?php } ?>

<?php if( $settings->layout == 'compact' ) { ?>
.fl-node-<?php echo $id; ?> .pp-subscribe-form-compact .pp-form-field {
	margin-bottom: <?php echo $settings->btn_margin; ?>%;
}
<?php } ?>


.fl-node-<?php echo $id; ?> .pp-subscribe-form a.fl-button:hover {
	background-color: <?php echo $settings->btn_bg_hover_color ? pp_hex2rgba('#' . $settings->btn_bg_hover_color, $settings->btn_bg_hover_opacity / 100 ) : 'transparent'; ?>;
	<?php if( $settings->button_border_size['top'] >= 0 ) { ?>
	border-top-width: <?php echo $settings->button_border_size['top']; ?>px;
	<?php } ?>
	<?php if( $settings->button_border_size['right'] >= 0 ) { ?>
	border-right-width: <?php echo $settings->button_border_size['right']; ?>px;
	<?php } ?>
	<?php if( $settings->button_border_size['bottom'] >= 0 ) { ?>
	border-bottom-width: <?php echo $settings->button_border_size['bottom']; ?>px;
	<?php } ?>
	<?php if( $settings->button_border_size['left'] >= 0 ) { ?>
	border-left-width: <?php echo $settings->button_border_size['left']; ?>px;
	<?php } ?>
	<?php if( $settings->btn_border_hover_color ) { ?>
	border-color: #<?php echo $settings->btn_border_hover_color; ?>;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-subscribe-form a.fl-button .fl-button-icon,
.fl-node-<?php echo $id; ?> .pp-subscribe-form a.fl-button .fl-button-icon:before {
	font-size: <?php echo $settings->btn_icon_size; ?>px;
}

.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-form-error-message {
    <?php if( $settings->validation_message_color ) { ?>
	color: #<?php echo $settings->validation_message_color; ?>;
    <?php } ?>
	<?php if( $settings->validation_error_font_size['desktop'] && $settings->success_message_size == 'custom' ) { ?>
    font-size: <?php echo $settings->validation_error_font_size['desktop']; ?>px;
    <?php } ?>
	text-transform: <?php echo $settings->error_text_transform; ?>;
}

.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-form-success-message {
	<?php if( $settings->success_message_font_size['desktop'] && $settings->success_message_size == 'custom' ) { ?>
    font-size: <?php echo $settings->success_message_font_size['desktop']; ?>px;
    <?php } ?>
	<?php if( $settings->success_message_color ) { ?>
	color: #<?php echo $settings->success_message_color; ?>;
    <?php } ?>
	text-transform: <?php echo $settings->success_message_text_transform; ?>;
}

@media only screen and (max-width: 768px) {
	.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=text],
	.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=email] {
		<?php if( $settings->input_font_size['tablet'] && $settings->input_size == 'custom' ) { ?>
	    font-size: <?php echo $settings->input_font_size['tablet']; ?>px;
	    <?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-form a.fl-button,
	.fl-node-<?php echo $id; ?> .pp-subscribe-form a.fl-button:visited {
		<?php if( $settings->button_font_size['tablet'] && $settings->button_size == 'custom' ) { ?>
		font-size: <?php echo $settings->button_font_size['tablet']; ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-form-error-message {
		<?php if( $settings->validation_error_font_size['tablet'] && $settings->success_message_size == 'custom' ) { ?>
	    font-size: <?php echo $settings->validation_error_font_size['tablet']; ?>px;
	    <?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-form-success-message {
		<?php if( $settings->success_message_font_size['tablet'] && $settings->success_message_size == 'custom' ) { ?>
	    font-size: <?php echo $settings->success_message_font_size['tablet']; ?>px;
	    <?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=text]::-webkit-input-placeholder,
	.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=email]::-webkit-input-placeholder {
		<?php if( $settings->placeholder_font_size['tablet'] && $settings->placeholder_size == 'custom' ) { ?>
	    font-size: <?php echo $settings->placeholder_font_size['tablet']; ?>px;
	    <?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-content {
		<?php if( $settings->content_font_size == 'custom' && !empty($settings->content_font_size_custom['tablet']) ) { ?>
			font-size: <?php echo $settings->content_font_size_custom['tablet']; ?>px;
		<?php } ?>
		<?php if( $settings->content_line_height == 'custom' && !empty($settings->content_line_height_custom['tablet']) ) { ?>
			line-height: <?php echo $settings->content_line_height_custom['tablet']; ?>;
		<?php } ?>
	}
}

@media only screen and (max-width: 480px) {
	.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=text],
	.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=email] {
		<?php if( $settings->input_font_size['mobile'] && $settings->input_size == 'custom' ) { ?>
	    font-size: <?php echo $settings->input_font_size['mobile']; ?>px;
	    <?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-form a.fl-button,
	.fl-node-<?php echo $id; ?> .pp-subscribe-form a.fl-button:visited {
		<?php if( $settings->button_font_size['mobile'] && $settings->button_size == 'custom' ) { ?>
		font-size: <?php echo $settings->button_font_size['mobile']; ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-form-error-message {
		<?php if( $settings->validation_error_font_size['mobile'] && $settings->success_message_size == 'custom' ) { ?>
	    font-size: <?php echo $settings->validation_error_font_size['mobile']; ?>px;
	    <?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-form .pp-form-success-message {
		<?php if( $settings->success_message_font_size['mobile'] && $settings->success_message_size == 'custom' ) { ?>
	    font-size: <?php echo $settings->success_message_font_size['mobile']; ?>px;
	    <?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=text]::-webkit-input-placeholder,
	.fl-node-<?php echo $id; ?> .pp-subscribe-form input[type=email]::-webkit-input-placeholder {
		<?php if( $settings->placeholder_font_size['mobile'] && $settings->placeholder_size == 'custom' ) { ?>
	    font-size: <?php echo $settings->placeholder_font_size['mobile']; ?>px;
	    <?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-subscribe-content {
		<?php if( $settings->content_font_size == 'custom' && !empty($settings->content_font_size_custom['tablet']) ) { ?>
			font-size: <?php echo $settings->content_font_size_custom['tablet']; ?>px;
		<?php } ?>
		<?php if( $settings->content_line_height == 'custom' && !empty($settings->content_line_height_custom['tablet']) ) { ?>
			line-height: <?php echo $settings->content_line_height_custom['tablet']; ?>;
		<?php } ?>
	}
}
