/**
 * $module An instance of your module class.
 * $id The module's ID.
 * $settings The module's settings.
*/


.fl-node-<?php echo $id; ?> .pp-gf-content .gform_wrapper {
	max-width: 100%;
}

.fl-node-<?php echo $id; ?> .pp-gf-content {
	background-color: <?php echo $settings->form_bg_color ? pp_hex2rgba('#' . $settings->form_bg_color, $settings->form_background_opacity) : 'transparent'; ?>;
    <?php if( $settings->form_bg_image && $settings->form_bg_type == 'image' ) { ?>
	background-image: url('<?php echo $settings->form_bg_image_src; ?>');
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
.fl-node-<?php echo $id; ?> .pp-gf-content:before {
	background-color: <?php echo ( $settings->form_bg_overlay ) ? pp_hex2rgba('#' . $settings->form_bg_overlay, $settings->form_bg_overlay_opacity / 100 ) : 'transparent'; ?>;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-gf-content .gform_wrapper ul li.gfield {
	list-style-type: none !important;
    <?php if( $settings->input_field_margin >= 0 ) { ?>
	margin-bottom: <?php echo $settings->input_field_margin; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gform_title,
.fl-node-<?php echo $id; ?> .form-title {
    <?php if( $settings->title_color ) { ?>
    color: #<?php echo $settings->title_color; ?>;
    <?php } ?>
	display: <?php echo ($settings->title_field == 'false') ? 'none' : 'block'; ?>;
    <?php if( $settings->title_font_size ) { ?>
    font-size: <?php echo $settings->title_font_size; ?>px;
    <?php } ?>
    <?php if( $settings->title_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->title_font_family ); ?>
    <?php } ?>
    <?php if( $settings->title_alignment ) { ?>
    text-align: <?php echo $settings->title_alignment; ?>;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .form-title {
	display: <?php echo ($settings->form_custom_title_desc == 'yes') ? 'block' : 'none'; ?>;
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gform_title {
	<?php if( $settings->form_custom_title_desc == 'yes' ) { ?>
	display: none;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper span.gform_description,
.fl-node-<?php echo $id; ?> .form-description {
    <?php if( $settings->description_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->description_font_family ); ?>
    <?php } ?>
    <?php if( $settings->description_color ) { ?>
    color: #<?php echo $settings->description_color; ?>;
    <?php } ?>
	display: <?php echo ($settings->description_field == 'false') ? 'none' : 'block'; ?>;
    <?php if( $settings->description_font_size ) { ?>
    font-size: <?php echo $settings->description_font_size; ?>px;
    <?php } ?>
    <?php if( $settings->description_alignment ) { ?>
    text-align: <?php echo $settings->description_alignment; ?>;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .form-description {
    display: <?php echo ($settings->form_custom_title_desc == 'yes') ? 'block' : 'none'; ?>;
}

.fl-node-<?php echo $id; ?> .gform_wrapper span.gform_description {
	<?php if( $settings->form_custom_title_desc == 'yes' ) { ?>
	display: none;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .gfield_label {
    <?php if( $settings->form_label_color ) { ?>
	color: #<?php echo $settings->form_label_color; ?>;
    <?php } ?>
    <?php if( $settings->display_labels ) { ?>
    display: <?php echo $settings->display_labels; ?>;
    <?php } ?>
    <?php if( $settings->label_font_size ) { ?>
    font-size: <?php echo $settings->label_font_size; ?>px;
    <?php } ?>
    <?php if( $settings->label_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->label_font_family ); ?>
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .ginput_complex.ginput_container label {
    <?php if( $settings->display_labels == 'none' ) { ?>
    display: <?php echo $settings->display_labels; ?>;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container label,
.fl-node-<?php echo $id; ?> .gform_wrapper table.gfield_list thead th,
.fl-node-<?php echo $id; ?> .gform_wrapper span.ginput_product_price_label,
.fl-node-<?php echo $id; ?> .gform_wrapper span.ginput_quantity_label,
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield_html {
    <?php if( $settings->form_label_color ) { ?>
    color: #<?php echo $settings->form_label_color; ?> !important;
    <?php } ?>
    <?php if( $settings->label_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->label_font_family ); ?>
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper span.ginput_product_price {
    <?php if( $settings->product_price_color ) { ?>
    color: #<?php echo $settings->product_price_color; ?> !important;
    <?php } ?>
    <?php if( $settings->label_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->label_font_family ); ?>
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .gfield_description {
    <?php if( $settings->input_desc_font_size ) { ?>
    font-size: <?php echo $settings->input_desc_font_size; ?>px;
    <?php } ?>
    <?php if( $settings->input_desc_color ) { ?>
    color: #<?php echo $settings->input_desc_color; ?>;
    <?php } ?>
    <?php if( $settings->input_desc_line_height ) { ?>
    line-height: <?php echo $settings->input_desc_line_height; ?>;
    <?php } ?>
    <?php if( $settings->label_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->label_font_family ); ?>
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gsection {
	<?php if( $settings->section_border_width >= 0 ) { ?>
	border-bottom-width: <?php echo $settings->section_border_width; ?>px;
	<?php } ?>
	<?php if( $settings->section_border_color ) { ?>
	border-bottom-color: #<?php echo $settings->section_border_color; ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper h2.gsection_title {
	<?php if( $settings->section_text_color ) { ?>
	color: <?php echo $settings->section_text_color; ?>;
	<?php } ?>
	<?php if( $settings->section_font_size ) { ?>
	font-size: <?php echo $settings->section_font_size; ?>px;
	<?php } ?>
}


.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:focus,
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield select,
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea {
    <?php if( $settings->input_field_text_color ) { ?>
        color: #<?php echo $settings->input_field_text_color; ?>;
    <?php } ?>
	background-color: <?php echo $settings->input_field_bg_color ? pp_hex2rgba('#' . $settings->input_field_bg_color, $settings->input_field_background_opacity) : ''; ?>;
	border-width: 0;
	border-color: <?php echo $settings->input_field_border_color ? '#' . $settings->input_field_border_color : ''; ?>;
    <?php if( $settings->input_field_border_radius >= 0 ) { ?>
        -webkit-border-radius: <?php echo $settings->input_field_border_radius; ?>px;
        -moz-border-radius: <?php echo $settings->input_field_border_radius; ?>px;
        -ms-border-radius: <?php echo $settings->input_field_border_radius; ?>px;
        -o-border-radius: <?php echo $settings->input_field_border_radius; ?>px;
        border-radius: <?php echo $settings->input_field_border_radius; ?>px;
    <?php } ?>
    <?php if( $settings->input_field_border_width >= 0 ) { ?>
        <?php echo $settings->input_field_border_position; ?>-width: <?php echo $settings->input_field_border_width; ?>px;
        border-style: solid;
    <?php } ?>
	<?php echo ($settings->input_field_width == 'true') ? 'width: 100% !important;' : ''; ?>
    <?php if( $settings->input_field_box_shadow == 'none' ) { ?>
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        -ms-box-shadow: none;
        -o-box-shadow: none;
        box-shadow: none;
    <?php } ?>
    <?php if( $settings->input_field_padding >= 0 ) { ?>
	padding: <?php echo $settings->input_field_padding; ?>px;
    <?php } ?>
    <?php if( $settings->input_field_text_alignment ) { ?>
    text-align: <?php echo $settings->input_field_text_alignment; ?>;
    <?php } ?>
    <?php if( $settings->input_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->input_font_family ); ?>
    <?php } ?>
    <?php if( $settings->input_font_size ) { ?>
    font-size: <?php echo $settings->input_font_size; ?>px;
    <?php } ?>
    outline: none;
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield select {
    <?php if ( $settings->input_field_height == 'custom' ) { ?>
        height: <?php echo $settings->input_field_height_custom; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_complex input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=image]):not([type=file]),
.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_complex select {
    margin-bottom: <?php echo ( $settings->input_field_margin * 30 ) / 100 ?>px;
}

.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_complex span {
    margin-bottom: <?php echo ( $settings->input_field_margin * 40 ) / 100; ?>px;
}

<?php if( $settings->gf_input_placeholder_color && $settings->gf_input_placeholder_display == 'block' ) { ?>
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input::-webkit-input-placeholder {
    color: #<?php echo $settings->gf_input_placeholder_color; ?>;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:-moz-placeholder {
    color: #<?php echo $settings->gf_input_placeholder_color; ?>;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input::-moz-placeholder {
    color: #<?php echo $settings->gf_input_placeholder_color; ?>;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:-ms-input-placeholder {
    color: #<?php echo $settings->gf_input_placeholder_color; ?>;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea::-webkit-input-placeholder {
    color: #<?php echo $settings->gf_input_placeholder_color; ?>;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea:-moz-placeholder {
    color: #<?php echo $settings->gf_input_placeholder_color; ?>;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea::-moz-placeholder {
    color: #<?php echo $settings->gf_input_placeholder_color; ?>;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea:-ms-input-placeholder {
    color: #<?php echo $settings->gf_input_placeholder_color; ?>;
}
<?php } ?>

<?php if( $settings->gf_input_placeholder_display == 'none' ) { ?>
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input::-webkit-input-placeholder {
    color: transparent;
    opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:-moz-placeholder {
    color: transparent;
    opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input::-moz-placeholder {
    color: transparent;
    opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:-ms-input-placeholder {
    color: transparent;
    opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea::-webkit-input-placeholder {
    color: transparent;
    opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea:-moz-placeholder {
    color: transparent;
    opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea::-moz-placeholder {
    color: transparent;
    opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea:-ms-input-placeholder {
    color: transparent;
    opacity: 0;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']):focus,
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield select:focus,
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea:focus {
    border-color: <?php echo $settings->input_field_focus_color ? '#' . $settings->input_field_focus_color : 'transparent'; ?>;
}

.fl-node-<?php echo $id; ?> .gform_wrapper .top_label input.medium,
.fl-node-<?php echo $id; ?> .gform_wrapper .top_label select.medium {
    width: <?php echo ($settings->input_field_width == 'true') ? '100%' : '49%'; ?> !important;
}

.fl-node-<?php echo $id; ?> .gform_wrapper textarea.medium {
    <?php if( $settings->input_field_width == 'true' ) { ?> width: 100% !important; <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_complex .ginput_full input[type="text"],
.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_complex  input[type="text"] {
    width: <?php echo ($settings->input_field_width == 'true') ? '100%' : '97.5%'; ?> !important;
}

.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_complex .ginput_right {
    margin-left: 0 !important;
}

.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_complex .ginput_right input,
.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_complex .ginput_right select {
    <?php if( $settings->input_field_width == 'true' ) { ?> width: 100% !important;<?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gform_footer {
    <?php if( $settings->button_alignment ) { ?>
    text-align: <?php echo $settings->button_alignment; ?>;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gform_footer .gform_button,
.fl-node-<?php echo $id; ?> .gform_wrapper .gform_page_footer .button {
	width: <?php echo ($settings->button_width == 'true') ? '100%' : 'auto'; ?>;
    <?php if( $settings->button_text_color ) { ?>
	color: #<?php echo $settings->button_text_color; ?>;
    <?php } ?>
	background-color: <?php echo $settings->button_bg_color ? pp_hex2rgba('#' . $settings->button_bg_color, $settings->button_background_opacity) : 'transparent'; ?>;
	border: <?php echo $settings->button_border_width; ?>px solid <?php echo $settings->button_border_color ? '#' . $settings->button_border_color : 'transparent'; ?>;
    <?php if( $settings->button_border_radius >= 0 ) { ?>
    border-radius: <?php echo $settings->button_border_radius; ?>px;
    -moz-border-radius: <?php echo $settings->button_border_radius; ?>px;
    -webkit-border-radius: <?php echo $settings->button_border_radius; ?>px;
    -ms-border-radius: <?php echo $settings->button_border_radius; ?>px;
    -o-border-radius: <?php echo $settings->button_border_radius; ?>px;
    <?php } ?>
    <?php if( $settings->button_padding_top_bottom >= 0 ) { ?>
    padding-top: <?php echo $settings->button_padding_top_bottom; ?>px;
    padding-bottom: <?php echo $settings->button_padding_top_bottom; ?>px;
    <?php } ?>
    <?php if( $settings->button_padding_left_right >= 0 ) { ?>
    padding-left: <?php echo $settings->button_padding_left_right; ?>px;
    padding-right: <?php echo $settings->button_padding_left_right; ?>px;
    <?php } ?>
    <?php if( $settings->button_font_family['family'] != 'Default' ) { ?>
    <?php FLBuilderFonts::font_css( $settings->button_font_family ); ?>
    <?php } ?>
    <?php if( $settings->button_font_size ) { ?>
    font-size: <?php echo $settings->button_font_size; ?>px;
    <?php } ?>
    white-space: normal;
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gform_page_footer .button {
	<?php if( $settings->button_width == 'true' ) { ?>
		margin-bottom: 5px !important;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper.gf_browser_ie .gform_footer .gform_button,
.fl-node-<?php echo $id; ?> .gform_wrapper.gf_browser_ie .gform_page_footer .button {
    <?php if( $settings->button_padding_top_bottom >= 0 ) { ?>
    padding-top: <?php echo $settings->button_padding_top_bottom; ?>px;
    padding-bottom: <?php echo $settings->button_padding_top_bottom; ?>px;
    <?php } ?>
    <?php if( $settings->button_padding_left_right >= 0 ) { ?>
    padding-left: <?php echo $settings->button_padding_left_right; ?>px;
    padding-right: <?php echo $settings->button_padding_left_right; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gform_footer .gform_button:hover,
.fl-node-<?php echo $id; ?> .gform_wrapper .gform_page_footer .button:hover {
    <?php if( $settings->button_hover_text_color ) { ?>
	color: #<?php echo $settings->button_hover_text_color; ?>;
    <?php } ?>
	background: <?php echo $settings->button_hover_bg_color ? '#' . $settings->button_hover_bg_color : 'transparent'; ?>;
    <?php if( $settings->button_border_width >= 0 ) { ?>
	border-width: <?php echo $settings->button_border_width; ?>px;
    <?php } ?>
}


.fl-node-<?php echo $id; ?> .gform_wrapper .validation_error,
.fl-node-<?php echo $id; ?> .gform_wrapper li.gfield.gfield_error,
.fl-node-<?php echo $id; ?> .gform_wrapper li.gfield.gfield_error.gfield_contains_required.gfield_creditcard_warning {
    <?php if( $settings->validation_error_color ) { ?>
	color: #<?php echo $settings->validation_error_color; ?> !important;
    <?php } ?>
	border-color: <?php echo $settings->validation_error_border_color ? '#' . $settings->validation_error_border_color : 'transparent'; ?> !important;
    <?php if ( ! isset( $settings->validation_error_border_color ) || empty( $settings->validation_error_border_color ) ) { ?>
        border: none;
        padding-top: 0;
        padding-bottom: 0;
    <?php } ?>
}

<?php if ( ! isset( $settings->validation_error_border_color ) || empty( $settings->validation_error_border_color ) ) { ?>
.fl-node-<?php echo $id; ?> .gform_wrapper li.gfield.gfield_error.gfield_contains_required div.ginput_container,
.fl-node-<?php echo $id; ?> .gform_wrapper li.gfield.gfield_error.gfield_contains_required label.gfield_label {
    margin-top: 8px;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .gform_wrapper .validation_error {
    <?php if( $settings->validation_error_font_size ) { ?>
	font-size: <?php echo $settings->validation_error_font_size; ?>px !important;
    <?php } ?>
    <?php if( $settings->validation_error ) { ?>
	display: <?php echo $settings->validation_error; ?> !important;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield.gfield_error {
	background-color: <?php echo ($settings->form_error_field_background_color) ? '#' . $settings->form_error_field_background_color : 'transparent'; ?>;
    Width: 100%;
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield.gfield_error .gfield_label {
    <?php if( $settings->form_error_field_label_color ) { ?>
	color: #<?php echo $settings->form_error_field_label_color; ?>;
    <?php } ?>
	margin-left: 0;
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield_error .validation_message {
    <?php if( $settings->validation_message ) { ?>
	display: <?php echo $settings->validation_message; ?>;
    <?php } ?>
    <?php if( $settings->validation_message_color ) { ?>
	color: #<?php echo $settings->validation_message_color; ?>;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield_error input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield_error .ginput_container select,
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield_error .ginput_container textarea {
	border-color: <?php echo ($settings->form_error_input_border_color) ? '#' . $settings->form_error_input_border_color : 'transparent'; ?>;
    <?php if( $settings->form_error_input_border_width >= 0 ) { ?>
	border-width: <?php echo $settings->form_error_input_border_width; ?>px !important;
    <?php } ?>
}
