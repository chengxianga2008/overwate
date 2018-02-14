/**
 * $module An instance of your module class.
 * $id The module's ID.
 * $settings The module's settings.
*/


.fl-node-<?php echo $id; ?> .pp-wpforms-content {
	background-color: <?php echo $settings->form_bg_color ? pp_hex2rgba('#' . $settings->form_bg_color, $settings->form_background_opacity / 100) : 'transparent'; ?>;
    <?php if( $settings->form_bg_image ) { ?>
	background-image: url('<?php echo wp_get_attachment_url( absint($settings->form_bg_image) ); ?>');
    <?php } ?>
    <?php if( $settings->form_bg_size ) { ?>
    background-size: <?php echo $settings->form_bg_size; ?>;
    <?php } ?>
    <?php if( $settings->form_bg_repeat ) { ?>
    background-repeat: <?php echo $settings->form_bg_repeat; ?>;
    <?php } ?>
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
}

<?php if( $settings->form_bg_image && $settings->form_bg_type == 'image' ) { ?>
.fl-node-<?php echo $id; ?> .pp-wpforms-content:before {
	background-color: <?php echo ( $settings->form_bg_overlay ) ? pp_hex2rgba('#' . $settings->form_bg_overlay, $settings->form_bg_overlay_opacity / 100 ) : 'transparent'; ?>;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form  .wpforms-field {
    <?php if( $settings->input_field_margin >= 0 ) { ?>
	margin-bottom: <?php echo $settings->input_field_margin; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-title,
.fl-node-<?php echo $id; ?> .pp-wpforms-content .pp-form-title {
    <?php if( $settings->title_color ) { ?>
    color: #<?php echo $settings->title_color; ?>;
    <?php } ?>
	display: <?php echo ($settings->title_field == 'false') ? 'none' : 'block'; ?>;
    <?php if( $settings->title_font_size['desktop'] && $settings->title_size == 'custom' ) { ?>
    font-size: <?php echo $settings->title_font_size['desktop']; ?>px;
    <?php } ?>
    <?php if( $settings->title_line_height['desktop'] ) { ?>
    line-height: <?php echo $settings->title_line_height['desktop']; ?>;
    <?php } ?>
    <?php if( $settings->title_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->title_font_family ); ?>
    <?php } ?>
    <?php if( $settings->title_alignment ) { ?>
    text-align: <?php echo $settings->title_alignment; ?>;
    <?php } ?>
    <?php if( $settings->title_margin['top'] >= 0 ) { ?>
	margin-top: <?php echo $settings->title_margin['top']; ?>px;
	<?php } ?>
	<?php if( $settings->title_margin['bottom'] >= 0 ) { ?>
	margin-bottom: <?php echo $settings->title_margin['bottom']; ?>px;
	<?php } ?>
    text-transform: <?php echo $settings->title_text_transform; ?>;
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content .pp-form-title {
	display: <?php echo ($settings->form_custom_title_desc == 'yes') ? 'block' : 'none'; ?>;
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-title {
	<?php if( $settings->form_custom_title_desc == 'yes' ) { ?>
	display: none;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-description,
.fl-node-<?php echo $id; ?> .pp-wpforms-content .pp-form-description {
    <?php if( $settings->description_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->description_font_family ); ?>
    <?php } ?>
    <?php if( $settings->description_color ) { ?>
    color: #<?php echo $settings->description_color; ?>;
    <?php } ?>
	display: <?php echo ($settings->description_field == 'false') ? 'none' : 'block'; ?>;
    <?php if( $settings->description_font_size['desktop'] && $settings->description_size == 'custom' ) { ?>
    font-size: <?php echo $settings->description_font_size['desktop']; ?>px;
    <?php } ?>
    <?php if( $settings->description_line_height['desktop'] ) { ?>
    line-height: <?php echo $settings->description_line_height['desktop']; ?>;
    <?php } ?>
    <?php if( $settings->description_alignment ) { ?>
    text-align: <?php echo $settings->description_alignment; ?>;
    <?php } ?>
    <?php if( $settings->description_margin['top'] >= 0 ) { ?>
	margin-top: <?php echo $settings->description_margin['top']; ?>px;
	<?php } ?>
	<?php if( $settings->description_margin['bottom'] >= 0 ) { ?>
	margin-bottom: <?php echo $settings->description_margin['bottom']; ?>px;
	<?php } ?>
    text-transform: <?php echo $settings->description_text_transform; ?>;
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content .pp-form-description {
    display: <?php echo ($settings->form_custom_title_desc == 'yes') ? 'block' : 'none'; ?>;
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-description {
	<?php if( $settings->form_custom_title_desc == 'yes' ) { ?>
	display: none;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-field-label {
    <?php if( $settings->form_label_color ) { ?>
	color: #<?php echo $settings->form_label_color; ?>;
    <?php } ?>
    <?php if( $settings->display_labels ) { ?>
    display: <?php echo $settings->display_labels; ?>;
    <?php } ?>
    <?php if( $settings->label_font_size['desktop'] && $settings->label_size == 'custom' ) { ?>
    font-size: <?php echo $settings->label_font_size['desktop']; ?>px;
    <?php } ?>
    <?php if( $settings->label_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->label_font_family ); ?>
    <?php } ?>
    text-transform: <?php echo $settings->label_text_transform; ?>;
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-field-sublabel,
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-field-label-inline {
    <?php if( $settings->form_label_color ) { ?>
    color: #<?php echo $settings->form_label_color; ?>;
    <?php } ?>
    <?php if( $settings->label_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->label_font_family ); ?>
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-field-description {
    <?php if( $settings->input_desc_font_size['desktop'] && $settings->input_desc_size == 'custom' ) { ?>
    font-size: <?php echo $settings->input_desc_font_size['desktop']; ?>px;
    <?php } ?>
    <?php if( $settings->input_desc_color ) { ?>
    color: #<?php echo $settings->input_desc_color; ?>;
    <?php } ?>
    <?php if( $settings->input_desc_line_height['desktop']) { ?>
    line-height: <?php echo $settings->input_desc_line_height['desktop']; ?>;
    <?php } ?>
    <?php if( $settings->label_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->label_font_family ); ?>
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form select,
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form textarea {
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
    <?php if( $settings->input_field_border_width >= 0 ) { ?>
    <?php echo $settings->input_field_border_position; ?>-width: <?php echo $settings->input_field_border_width; ?>px;
    <?php } ?>
	<?php echo ($settings->input_field_width == 'true') ? 'width: 100% !important;' : ''; ?>
    <?php if( $settings->input_field_box_shadow == 'yes' ) { ?>
        box-shadow: <?php echo ($settings->input_shadow_direction == 'inset') ? $settings->input_shadow_direction : ''; ?> 0 0 10px #<?php echo $settings->input_shadow_color; ?>;
        -moz-box-shadow: <?php echo ($settings->input_shadow_direction == 'inset') ? $settings->input_shadow_direction : ''; ?> 0 0 10px #<?php echo $settings->input_shadow_color; ?>;
        -webkit-box-shadow: <?php echo ($settings->input_shadow_direction == 'inset') ? $settings->input_shadow_direction : ''; ?> 0 0 10px #<?php echo $settings->input_shadow_color; ?>;
        -ms-box-shadow: <?php echo ($settings->input_shadow_direction == 'inset') ? $settings->input_shadow_direction : ''; ?> 0 0 10px #<?php echo $settings->input_shadow_color; ?>;
        -o-box-shadow: <?php echo ($settings->input_shadow_direction == 'inset') ? $settings->input_shadow_direction : ''; ?> 0 0 10px #<?php echo $settings->input_shadow_color; ?>;
    <?php } else { ?>
		box-shadow: none;
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
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form select {
    <?php if( $settings->input_field_height ) { ?>
    height: <?php echo $settings->input_field_height; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-field-row input,
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-field-row select,
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-field-row textarea {
    margin-bottom: <?php echo ( $settings->input_field_margin * 40 ) / 100 ?>px;
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form textarea {
    <?php if( $settings->input_textarea_height ) { ?>
    height: <?php echo $settings->input_textarea_height; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file'])::-webkit-input-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']):-moz-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file'])::-moz-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']):-ms-input-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form select::-webkit-input-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form select:-moz-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form select::-moz-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form select:-ms-input-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form textarea::-webkit-input-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form textarea:-moz-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form textarea::-moz-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form textarea:-ms-input-placeholder {
    <?php if( $settings->input_placeholder_color && $settings->input_placeholder_display == 'block' ) { ?>
    color: #<?php echo $settings->input_placeholder_color; ?>;
    <?php } else { ?>
    color: transparent;
	opacity: 0;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']):focus,
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form select:focus,
.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form textarea:focus {
    border-color: <?php echo $settings->input_field_focus_color ? '#' . $settings->input_field_focus_color : 'transparent'; ?>;
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-submit-container {
    text-align: <?php echo $settings->button_alignment; ?>;
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form button {
    <?php if( $settings->button_text_color['primary'] ) { ?>
	color: #<?php echo $settings->button_text_color['primary']; ?>;
    <?php } ?>
	background: <?php echo $settings->button_bg_color['primary'] ? pp_hex2rgba('#' . $settings->button_bg_color['primary'], $settings->button_background_opacity / 100 ) : 'transparent'; ?>;
    <?php if( $settings->button_border_width || $settings->button_border_color ) { ?>
	border: <?php echo $settings->button_border_width; ?>px solid <?php echo $settings->button_border_color ? '#' . $settings->button_border_color : 'transparent'; ?>;
    <?php } ?>
    <?php if( $settings->button_border_radius >= 0 ) { ?>
    border-radius: <?php echo $settings->button_border_radius; ?>px;
    -moz-border-radius: <?php echo $settings->button_border_radius; ?>px;
    -webkit-border-radius: <?php echo $settings->button_border_radius; ?>px;
    -ms-border-radius: <?php echo $settings->button_border_radius; ?>px;
    -o-border-radius: <?php echo $settings->button_border_radius; ?>px;
    <?php } ?>
    <?php if( $settings->button_padding['top'] >= 0 ) { ?>
    padding-top: <?php echo $settings->button_padding['top']; ?>px;
    <?php } ?>
    <?php if( $settings->button_padding['bottom'] >= 0 ) { ?>
    padding-bottom: <?php echo $settings->button_padding['bottom']; ?>px;
    <?php } ?>
    <?php if( $settings->button_padding['left'] >= 0 ) { ?>
    padding-left: <?php echo $settings->button_padding['left']; ?>px;
    <?php } ?>
    <?php if( $settings->button_padding['right'] >= 0 ) { ?>
    padding-right: <?php echo $settings->button_padding['right']; ?>px;
    <?php } ?>
    <?php if( $settings->button_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->button_font_family ); ?>
    <?php } ?>
    <?php if( $settings->button_font_size['desktop'] && $settings->button_size == 'custom' ) { ?>
    font-size: <?php echo $settings->button_font_size['desktop']; ?>px;
    <?php } ?>
    text-transform: <?php echo $settings->button_text_transform; ?>;
    <?php if( $settings->button_width == 'true' ) { ?> width: 100%; <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form button:hover {
    <?php if( $settings->button_text_color['secondary'] ) { ?>
	color: #<?php echo $settings->button_text_color['secondary']; ?>;
    <?php } ?>
	background: <?php echo $settings->button_bg_color['secondary'] ? '#' . $settings->button_bg_color['secondary'] : 'transparent'; ?>;
    <?php if( $settings->button_border_width || $settings->button_border_color ) { ?>
	border: <?php echo $settings->button_border_width; ?>px solid <?php echo $settings->button_border_color ? '#' . $settings->button_border_color : 'transparent'; ?>;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form label.wpforms-error {
    <?php if( $settings->validation_message ) { ?>
	display: <?php echo $settings->validation_message; ?>;
    <?php } ?>
    <?php if( $settings->validation_message_color ) { ?>
	color: #<?php echo $settings->validation_message_color; ?>;
    <?php } ?>
    <?php if( $settings->validation_message_font_size['desktop'] && $settings->validation_message_size == 'custom' ) { ?>
    font-size: <?php echo $settings->validation_message_font_size['desktop']; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-wpforms-content .wpforms-confirmation-container-full {
    <?php if( $settings->success_message_font_size['desktop'] && $settings->success_message_size == 'custom' ) { ?>
	font-size: <?php echo $settings->success_message_font_size['desktop']; ?>px;
    <?php } ?>
    <?php if( $settings->success_message_color ) { ?>
	color: #<?php echo $settings->success_message_color; ?>;
    <?php } ?>
	border-color: <?php echo $settings->success_message_border_color ? '#' . $settings->success_message_border_color : 'transparent'; ?>;
    background-color: <?php echo $settings->success_message_bg_color ? '#' . $settings->success_message_bg_color : 'transparent'; ?>
}

@media only screen and (max-width: 768px) {
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-title,
    .fl-node-<?php echo $id; ?> .pp-wpforms-content .pp-form-title {
        <?php if( $settings->title_font_size['tablet'] && $settings->title_size == 'custom' ) { ?>
        font-size: <?php echo $settings->title_font_size['tablet']; ?>px;
        <?php } ?>
        <?php if( $settings->title_line_height['tablet'] ) { ?>
        line-height: <?php echo $settings->title_line_height['tablet']; ?>;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-description,
    .fl-node-<?php echo $id; ?> .pp-wpforms-content .pp-form-description {
        <?php if( $settings->description_font_size['tablet'] && $settings->description_size == 'custom' ) { ?>
        font-size: <?php echo $settings->description_font_size['tablet']; ?>px;
        <?php } ?>
        <?php if( $settings->description_line_height['tablet'] ) { ?>
        line-height: <?php echo $settings->description_line_height['tablet']; ?>;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-field-label {
        <?php if( $settings->label_font_size['tablet'] && $settings->label_size == 'custom' ) { ?>
        font-size: <?php echo $settings->label_font_size['tablet']; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form select,
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form textarea {
        <?php if( $settings->input_font_size['tablet'] && $settings->input_size == 'custom' ) { ?>
        font-size: <?php echo $settings->input_font_size['tablet']; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-field-description {
        <?php if( $settings->input_desc_font_size['tablet'] && $settings->input_desc_size == 'custom' ) { ?>
        font-size: <?php echo $settings->input_desc_font_size['tablet']; ?>px;
        <?php } ?>
        <?php if( $settings->input_desc_line_height['tablet']) { ?>
        line-height: <?php echo $settings->input_desc_line_height['tablet']; ?>;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form button {
        <?php if( $settings->button_font_size['tablet'] && $settings->button_size == 'custom' ) { ?>
        font-size: <?php echo $settings->button_font_size['tablet']; ?>px;
        <?php } ?>
    }

    .fl-node-<?php echo $id; ?> .pp-wpforms-content .wpforms-confirmation-container-full {
        <?php if( $settings->success_message_font_size['tablet'] && $settings->success_message_size == 'custom' ) { ?>
    	font-size: <?php echo $settings->success_message_font_size['tablet']; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form label.wpforms-error {
        <?php if( $settings->validation_message_font_size['tablet'] && $settings->validation_message_size == 'custom' ) { ?>
        font-size: <?php echo $settings->validation_message_font_size['tablet']; ?>px;
        <?php } ?>
    }
}

@media only screen and (max-width: 480px) {
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-title,
    .fl-node-<?php echo $id; ?> .pp-wpforms-content .pp-form-title {
        <?php if( $settings->title_font_size['mobile'] && $settings->title_size == 'custom' ) { ?>
        font-size: <?php echo $settings->title_font_size['mobile']; ?>px;
        <?php } ?>
        <?php if( $settings->title_line_height['mobile'] ) { ?>
        line-height: <?php echo $settings->title_line_height['mobile']; ?>;
        <?php } ?>
    }

    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-description,
    .fl-node-<?php echo $id; ?> .pp-wpforms-content .pp-form-description {
        <?php if( $settings->description_font_size['mobile'] && $settings->description_size == 'custom' ) { ?>
        font-size: <?php echo $settings->description_font_size['mobile']; ?>px;
        <?php } ?>
        <?php if( $settings->description_line_height['mobile'] ) { ?>
        line-height: <?php echo $settings->description_line_height['mobile']; ?>;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-field-label {
        <?php if( $settings->label_font_size['mobile'] && $settings->label_size == 'custom' ) { ?>
        font-size: <?php echo $settings->label_font_size['mobile']; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form select,
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form textarea {
        <?php if( $settings->input_font_size['mobile'] && $settings->input_size == 'custom' ) { ?>
        font-size: <?php echo $settings->input_font_size['mobile']; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form .wpforms-field-description {
        <?php if( $settings->input_desc_font_size['mobile'] && $settings->input_desc_size == 'custom' ) { ?>
        font-size: <?php echo $settings->input_desc_font_size['mobile']; ?>px;
        <?php } ?>
        <?php if( $settings->input_desc_line_height['mobile']) { ?>
        line-height: <?php echo $settings->input_desc_line_height['mobile']; ?>;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form button {
        <?php if( $settings->button_font_size['mobile'] && $settings->button_size == 'custom' ) { ?>
        font-size: <?php echo $settings->button_font_size['mobile']; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content .wpforms-confirmation-container-full {
        <?php if( $settings->success_message_font_size['mobile'] && $settings->success_message_size == 'custom' ) { ?>
    	font-size: <?php echo $settings->success_message_font_size['mobile']; ?>px;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-wpforms-content div.wpforms-container-full .wpforms-form label.wpforms-error {
        <?php if( $settings->validation_message_font_size['mobile'] && $settings->validation_message_size == 'custom' ) { ?>
        font-size: <?php echo $settings->validation_message_font_size['mobile']; ?>px;
        <?php } ?>
    }
}
