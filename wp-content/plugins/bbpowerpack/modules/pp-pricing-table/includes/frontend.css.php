.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col {
	padding-left: <?php echo $settings->box_spacing; ?>px;
	padding-right: <?php echo $settings->box_spacing; ?>px;
}

<?php if( $settings->box_spacing == 0 && $settings->box_border != 'none' ) { ?>
	.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col {
		margin-right: -<?php echo $settings->box_border_width; ?>px;
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col .pp-pricing-table-column {
	background-color: <?php echo ($settings->box_bg_color) ? '#' . $settings->box_bg_color : 'transparent'; ?>;
	<?php if( $settings->box_border != 'none' ) { ?>
		border-width: <?php echo $settings->box_border_width; ?>px;
		border-style: <?php echo $settings->box_border; ?>;
		<?php if( $settings->box_border_color ) { ?> border-color: #<?php echo $settings->box_border_color; ?>; <?php } ?>
	<?php } ?>
	<?php if( $settings->box_border_radius >= 0 ) { ?> border-radius: <?php echo $settings->box_border_radius; ?>px; <?php } ?>
	<?php if ( 'yes' == $settings->box_shadow_display ) { ?>
    -webkit-box-shadow: <?php echo $settings->box_shadow['horizontal']; ?>px <?php echo $settings->box_shadow['vertical']; ?>px <?php echo $settings->box_shadow['blur']; ?>px <?php echo $settings->box_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity / 100 ); ?>;
    -moz-box-shadow: <?php echo $settings->box_shadow['horizontal']; ?>px <?php echo $settings->box_shadow['vertical']; ?>px <?php echo $settings->box_shadow['blur']; ?>px <?php echo $settings->box_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity / 100 ); ?>;
    -o-box-shadow: <?php echo $settings->box_shadow['horizontal']; ?>px <?php echo $settings->box_shadow['vertical']; ?>px <?php echo $settings->box_shadow['blur']; ?>px <?php echo $settings->box_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity / 100 ); ?>;
    box-shadow: <?php echo $settings->box_shadow['horizontal']; ?>px <?php echo $settings->box_shadow['vertical']; ?>px <?php echo $settings->box_shadow['blur']; ?>px <?php echo $settings->box_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->box_shadow_color, $settings->box_shadow_opacity / 100 ); ?>;
    <?php } ?>
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
}

<?php if( $settings->highlight == 'package' ) { ?>
.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column {
	background-color: <?php echo ($settings->hl_box_bg_color) ? '#' . $settings->hl_box_bg_color : 'transparent'; ?>;
	<?php if( $settings->hl_box_border != 'none' ) { ?>
		border-width: <?php echo $settings->hl_box_border_width; ?>px;
		border-style: <?php echo $settings->hl_box_border; ?>;
		<?php if( $settings->hl_box_border_color ) { ?> border-color: #<?php echo $settings->hl_box_border_color; ?>; <?php } ?>
	<?php } ?>
	<?php if ( 'yes' == $settings->hl_box_shadow_display ) { ?>
    -webkit-box-shadow: <?php echo $settings->hl_box_shadow['horizontal']; ?>px <?php echo $settings->hl_box_shadow['vertical']; ?>px <?php echo $settings->hl_box_shadow['blur']; ?>px <?php echo $settings->hl_box_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->hl_box_shadow_color, $settings->hl_box_shadow_opacity / 100 ); ?>;
    -moz-box-shadow: <?php echo $settings->hl_box_shadow['horizontal']; ?>px <?php echo $settings->hl_box_shadow['vertical']; ?>px <?php echo $settings->hl_box_shadow['blur']; ?>px <?php echo $settings->hl_box_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->hl_box_shadow_color, $settings->hl_box_shadow_opacity / 100 ); ?>;
    -o-box-shadow: <?php echo $settings->hl_box_shadow['horizontal']; ?>px <?php echo $settings->hl_box_shadow['vertical']; ?>px <?php echo $settings->hl_box_shadow['blur']; ?>px <?php echo $settings->hl_box_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->hl_box_shadow_color, $settings->hl_box_shadow_opacity / 100 ); ?>;
    box-shadow: <?php echo $settings->hl_box_shadow['horizontal']; ?>px <?php echo $settings->hl_box_shadow['vertical']; ?>px <?php echo $settings->hl_box_shadow['blur']; ?>px <?php echo $settings->hl_box_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#'.$settings->hl_box_shadow_color, $settings->hl_box_shadow_opacity / 100 ); ?>;
    <?php } ?>
	margin-top: <?php echo $settings->hl_box_margin_top; ?>px;
	<?php if( $settings->hl_box_padding['top'] >= 0 ) { ?>
	padding-top: <?php echo $settings->hl_box_padding['top']; ?>px;
	<?php } ?>
	<?php if( $settings->hl_box_padding['right'] >= 0 ) { ?>
	padding-right: <?php echo $settings->hl_box_padding['right']; ?>px;
	<?php } ?>
	<?php if( $settings->hl_box_padding['bottom'] >= 0 ) { ?>
	padding-bottom: <?php echo $settings->hl_box_padding['bottom']; ?>px;
	<?php } ?>
	<?php if( $settings->hl_box_padding['left'] >= 0 ) { ?>
	padding-left: <?php echo $settings->hl_box_padding['left']; ?>px;
	<?php } ?>
}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-matrix .pp-pricing-table-column {
	background-color: <?php echo ($settings->matrix_bg) ? '#' . $settings->matrix_bg : 'transparent'; ?>;
	padding-bottom: 0;
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-featured-title {
	background-color: <?php echo ($settings->featured_title_bg_color) ? '#' . $settings->featured_title_bg_color : 'transparent'; ?>;
	color: #<?php echo $settings->featured_title_color; ?>;
	<?php if( $settings->featured_title_font['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->featured_title_font ); ?>
   <?php } ?>
   <?php if( $settings->featured_title_font_size == 'custom' && $settings->featured_title_custom_font_size ) { ?>
	   font-size: <?php echo $settings->featured_title_custom_font_size['desktop']; ?>px;
   <?php } ?>
   <?php if( $settings->featured_title_line_height == 'custom' && $settings->featured_title_custom_line_height ) { ?>
	   line-height: <?php echo $settings->featured_title_custom_line_height['desktop']; ?>;
   <?php } ?>
   letter-spacing: <?php echo $settings->featured_title_letter_spacing; ?>px;
   <?php if( $settings->featured_title_text_transform != 'default' ) { ?>
	   text-transform: <?php echo $settings->featured_title_text_transform; ?>;
   <?php } ?>
	text-align: <?php echo $settings->featured_title_alignment; ?>;
    <?php if( $settings->featured_title_padding['top'] >= 0 ) { ?>
    padding-top: <?php echo $settings->featured_title_padding['top']; ?>px;
    <?php } ?>
    <?php if( $settings->featured_title_padding['right'] >= 0 ) { ?>
    padding-right: <?php echo $settings->featured_title_padding['right']; ?>px;
    <?php } ?>
    <?php if( $settings->featured_title_padding['bottom'] >= 0 ) { ?>
    padding-bottom: <?php echo $settings->featured_title_padding['bottom']; ?>px;
    <?php } ?>
    <?php if( $settings->featured_title_padding['left'] >= 0 ) { ?>
    padding-left: <?php echo $settings->featured_title_padding['left']; ?>px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-featured-title {
	background-color: #<?php echo $settings->hl_featured_title_bg_color; ?>;
	color: #<?php echo $settings->hl_featured_title_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-title {
	background-color: #<?php echo $settings->title_bg_color; ?>;
	color: #<?php echo $settings->title_color; ?>;
	<?php if( $settings->title_font['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->title_font ); ?>
   <?php } ?>
   <?php if( $settings->title_font_size == 'custom' && $settings->title_custom_font_size ) { ?>
	   font-size: <?php echo $settings->title_custom_font_size['desktop']; ?>px;
   <?php } ?>
   <?php if( $settings->title_line_height == 'custom' && $settings->title_custom_line_height ) { ?>
	   line-height: <?php echo $settings->title_custom_line_height['desktop']; ?>;
   <?php } ?>
   letter-spacing: <?php echo $settings->title_letter_spacing; ?>px;
   <?php if( $settings->title_text_transform != 'default' ) { ?>
	   text-transform: <?php echo $settings->title_text_transform; ?>;
   <?php } ?>
   text-align: <?php echo $settings->title_alignment; ?>;
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col .pp-pricing-table-column .pp-pricing-table-title {
	<?php if( $settings->title_padding['top'] >= 0 ) { ?>
    padding-top: <?php echo $settings->title_padding['top']; ?>px;
    <?php } ?>
    <?php if( $settings->title_padding['right'] >= 0 ) { ?>
    padding-right: <?php echo $settings->title_padding['right']; ?>px;
    <?php } ?>
    <?php if( $settings->title_padding['bottom'] >= 0 ) { ?>
    padding-bottom: <?php echo $settings->title_padding['bottom']; ?>px;
    <?php } ?>
    <?php if( $settings->title_padding['left'] >= 0 ) { ?>
    padding-left: <?php echo $settings->title_padding['left']; ?>px;
    <?php } ?>
	margin: 0;
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col .pp-pricing-table-column .pp-pricing-table-price {
	color: #<?php echo $settings->price_color; ?>;
	<?php if( $settings->price_font['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->price_font ); ?>
   <?php } ?>
   <?php if( $settings->price_font_size == 'custom' && $settings->price_custom_font_size ) { ?>
	   font-size: <?php echo $settings->price_custom_font_size['desktop']; ?>px;
   <?php } ?>
   <?php if( $settings->price_text_transform != 'default' ) { ?>
	   text-transform: <?php echo $settings->price_text_transform; ?>;
   <?php } ?>
   text-align: <?php echo $settings->price_alignment; ?>;
   <?php if( $settings->price_padding['top'] ) { ?>
   padding-top: <?php echo $settings->price_padding['top']; ?>px;
   <?php } ?>
   <?php if( $settings->price_padding['right'] ) { ?>
   padding-right: <?php echo $settings->price_padding['right']; ?>px;
   <?php } ?>
   <?php if( $settings->price_padding['bottom'] ) { ?>
   padding-bottom: <?php echo $settings->price_padding['bottom']; ?>px;
   <?php } ?>
   <?php if( $settings->price_padding['left'] ) { ?>
   padding-left: <?php echo $settings->price_padding['left']; ?>px;
   <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-price {
	background-color: <?php echo '#' . $settings->price_bg_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-table-duration {
	<?php if( $settings->duration_font_size == 'custom' && $settings->duration_custom_font_size ) { ?>
 	   font-size: <?php echo $settings->duration_custom_font_size['desktop']; ?>px;
    <?php } ?>
	color: #<?php echo $settings->duration_text_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-table-features {
	<?php if( $settings->features_font['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->features_font ); ?>
   <?php } ?>
   <?php if( $settings->features_font_size == 'custom' && $settings->features_custom_font_size ) { ?>
	   font-size: <?php echo $settings->features_custom_font_size['desktop']; ?>px;
   <?php } ?>
   color: #<?php echo $settings->features_font_color; ?>;
   <?php if( $settings->features_text_transform != 'default' ) { ?>
	   text-transform: <?php echo $settings->features_text_transform; ?>;
   <?php } ?>
   text-align: <?php echo $settings->features_alignment; ?>;
   min-height: <?php echo $settings->features_min_height; ?>px;
}

/* Highlight */
.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight-title .pp-pricing-table-column .pp-pricing-table-title,
.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-title {
	color: #<?php echo $settings->hl_title_color; ?>;
	background-color: #<?php echo $settings->hl_title_bg_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight-price .pp-pricing-table-column .pp-pricing-table-price,
.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-price {
	color: #<?php echo $settings->hl_price_color; ?>;
	background-color: #<?php echo $settings->hl_price_bg_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight-price .pp-pricing-table-column .pp-pricing-table-duration,
.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-duration {
	color: #<?php echo $settings->hl_duration_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-features {
	color: #<?php echo $settings->hl_features_color; ?>;
}

/* Matrix Items */
.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-matrix .pp-pricing-table-column .pp-pricing-table-features {
	color: #<?php echo $settings->matrix_text_color; ?>;
	text-align: <?php echo $settings->matrix_alignment; ?>;
}

/* All Items */
.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-features li {
	<?php if( $settings->features_padding['top'] ) { ?>
    padding-top: <?php echo $settings->features_padding['top']; ?>px;
    <?php } ?>
    <?php if( $settings->features_padding['right'] ) { ?>
    padding-right: <?php echo $settings->features_padding['right']; ?>px;
    <?php } ?>
    <?php if( $settings->features_padding['bottom'] ) { ?>
    padding-bottom: <?php echo $settings->features_padding['bottom']; ?>px;
    <?php } ?>
    <?php if( $settings->features_padding['left'] ) { ?>
    padding-left: <?php echo $settings->features_padding['left']; ?>px;
    <?php } ?>
	border-bottom-style: <?php echo $settings->features_border; ?>;
	<?php if( $settings->features_border_width && $settings->features_border != 'none' ) { ?>border-bottom-width: <?php echo $settings->features_border_width; ?>px; <?php } ?>
	<?php if( $settings->features_border_color ) { ?> border-bottom-color: #<?php echo $settings->features_border_color; ?>; <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col .pp-pricing-table-column .pp-pricing-table-features li:nth-child(even) {
	background-color: <?php echo ($settings->even_features_background) ? '#' . $settings->even_features_background : 'transparent'; ?>;
}

<?php if( $settings->highlight == 'package' ) { ?>
.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-features li:nth-child(even) {
	background-color: <?php echo ($settings->hl_even_features_bg_color) ? '#' . $settings->hl_even_features_bg_color : 'transparent'; ?>;
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-features li {
	border-bottom-style: <?php echo $settings->hl_features_border; ?>;
	<?php if( $settings->hl_features_border_width && $settings->hl_features_border != 'none' ) { ?>border-bottom-width: <?php echo $settings->hl_features_border_width; ?>px; <?php } ?>
	<?php if( $settings->hl_features_border_color ) { ?> border-bottom-color: #<?php echo $settings->hl_features_border_color; ?>; <?php } ?>
}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-matrix .pp-pricing-table-column .pp-pricing-table-features li:nth-child(even) {
	background-color: <?php echo ($settings->matrix_even_features_bg_color) ? '#' . $settings->matrix_even_features_bg_color : 'transparent'; ?>;
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-pricing-table-matrix .pp-pricing-table-column .pp-pricing-table-features li {
		border-bottom-style: <?php echo $settings->matrix_features_border; ?>;
		<?php if( $settings->matrix_features_border_width && $settings->matrix_features_border != 'none' ) { ?>border-bottom-width: <?php echo $settings->matrix_features_border_width; ?>px; <?php } ?>
		<?php if( $settings->matrix_features_border_color ) { ?> border-color: #<?php echo $settings->matrix_features_border_color; ?>; <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column a.fl-button {
	<?php if( $settings->button_font['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->button_font ); ?>
   <?php } ?>
   <?php if( $settings->button_font_size == 'custom' && $settings->button_custom_font_size ) { ?>
	   font-size: <?php echo $settings->button_custom_font_size['desktop']; ?>px !important;
   <?php } ?>
   <?php if( $settings->button_text_transform != 'default' ) { ?>
	   text-transform: <?php echo $settings->button_text_transform; ?>;
   <?php } ?>
}


<?php
// Loop through and style each pricing box
for($i = 0; $i < count($settings->pricing_columns); $i++) :

	if(!is_object($settings->pricing_columns[$i])) continue;

	// Pricing Box Settings
	$pricing_column = $settings->pricing_columns[$i];

?>

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column-<?php echo $i; ?> {
<?php if( $pricing_column->hl_featured_title == '' ) { ?>
	overflow: hidden;
<?php } ?>
	margin-top: <?php echo $pricing_column->margin; ?>px;
}

<?php if( $pricing_column->package_bg_color ) { ?>
.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col .pp-pricing-table-column-<?php echo $i; ?> {
	background-color: #<?php echo $pricing_column->package_bg_color; ?>;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column-<?php echo $i; ?> a.fl-button {
   <?php if( $pricing_column->button_padding->top >= 0 ) { ?>
   padding-top: <?php echo $pricing_column->button_padding->top; ?>px !important;
   <?php } ?>
   <?php if( $pricing_column->button_padding->right >= 0 ) { ?>
   padding-right: <?php echo $pricing_column->button_padding->right; ?>px !important;
   <?php } ?>
   <?php if( $pricing_column->button_padding->bottom >= 0 ) { ?>
   padding-bottom: <?php echo $pricing_column->button_padding->bottom; ?>px !important;
   <?php } ?>
   <?php if( $pricing_column->button_padding->left >= 0 ) { ?>
   padding-left: <?php echo $pricing_column->button_padding->left; ?>px !important;
   <?php } ?>
   <?php if( $pricing_column->button_margin->top >= 0 ) { ?>
   margin-top: <?php echo $pricing_column->button_margin->top; ?>px;
   <?php } ?>
   <?php if( $pricing_column->button_margin->right >= 0 ) { ?>
   margin-right: <?php echo $pricing_column->button_margin->right; ?>px;
   <?php } ?>
   <?php if( $pricing_column->button_margin->bottom >= 0 ) { ?>
   margin-bottom: <?php echo $pricing_column->button_margin->bottom; ?>px;
   <?php } ?>
   <?php if( $pricing_column->button_margin->left >= 0 ) { ?>
   margin-left: <?php echo $pricing_column->button_margin->left; ?>px;
   <?php } ?>
}

/* Pricing Box Highlight */
<?php if ( $settings->highlight != 'none' ) : ?>
	<?php if ( $settings->highlight == 'price' ) : ?>
		.fl-builder-content .fl-node-<?php echo $id; ?> .pp-pricing-table-highlight .pp-pricing-table-price {
			background-color: <?php echo ($settings->hl_price_bg_color) ? '#' . $settings->hl_price_bg_color : 'transparent'; ?>;
		}
	<?php endif; ?>
	<?php if ( $settings->highlight == 'title' ) : ?>
		.fl-builder-content .fl-node-<?php echo $id; ?> .pp-pricing-table-highlight .pp-pricing-table-title {
			background-color: <?php echo ($settings->hl_title_bg_color) ? '#' . $settings->hl_title_bg_color : 'transparent'; ?>;
		}
	<?php endif; ?>
<?php endif; ?>


/* Button CSS */
.fl-builder-content .fl-node-<?php echo $id; ?> .pp-pricing-table-column-<?php echo $i; ?> a.fl-button {
	<?php if ( empty( $pricing_column->btn_width ) ) : ?>
	 	display:block;
	 	margin: 0 30px 5px;
	<?php endif; ?>
}

<?php
FLBuilder::render_module_css('fl-button', $id . ' .pp-pricing-table-column-' . $i , array(
	'align'             => 'center',
	'bg_color'          => $pricing_column->btn_bg_color,
	'bg_hover_color'    => $pricing_column->btn_bg_hover_color,
	'bg_opacity'        => $pricing_column->btn_bg_opacity,
	'bg_hover_opacity'  => $pricing_column->btn_bg_hover_opacity,
	'button_transition' => $pricing_column->btn_button_transition,
	'border_radius'     => $pricing_column->btn_border_radius,
	'border_size'       => $pricing_column->btn_border_size,
	'icon'              => $pricing_column->btn_icon,
	'icon_position'     => $pricing_column->btn_icon_position,
	'link'              => $pricing_column->button_url,
	'link_target'       => '_self',
	'style'             => $pricing_column->btn_style,
	'text_color'        => $pricing_column->btn_text_color,
	'text_hover_color'  => $pricing_column->btn_text_hover_color,
	'width'             => $pricing_column->btn_width
));
?>


<?php endfor; ?>


@media only screen and ( max-width: 768px ) {

	.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col {
		margin-right: auto;
	}
	.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-col.pp-has-featured-title {
		margin-top: 80px;
	}
	<?php if( ($settings->title_font_size == 'custom' && $settings->title_custom_font_size ) || ( $settings->title_line_height == 'custom' && $settings->title_custom_line_height ) ) { ?>
	.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-table-title {
	   <?php if( $settings->title_font_size == 'custom' && $settings->title_custom_font_size ) { ?>
		   font-size: <?php echo $settings->title_custom_font_size['tablet']; ?>px;
	   <?php } ?>
	   <?php if( $settings->title_line_height == 'custom' && $settings->title_custom_line_height ) { ?>
		   line-height: <?php echo $settings->title_custom_line_height['tablet']; ?>;
	   <?php } ?>
   }
   <?php } ?>

	<?php if( ($settings->featured_title_font_size == 'custom' && $settings->featured_title_custom_font_size ) || ( $settings->featured_title_line_height == 'custom' && $settings->featured_title_custom_line_height ) ) { ?>
   .fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-featured-title {
      <?php if( $settings->featured_title_font_size == 'custom' && $settings->featured_title_custom_font_size ) { ?>
   	   font-size: <?php echo $settings->featured_title_custom_font_size['tablet']; ?>px;
      <?php } ?>
      <?php if( $settings->featured_title_line_height == 'custom' && $settings->featured_title_custom_line_height ) { ?>
   	   line-height: <?php echo $settings->featured_title_custom_line_height['tablet']; ?>;
      <?php } ?>
  }
  <?php } ?>


	<?php if( $settings->price_font_size == 'custom' && $settings->price_custom_font_size ) { ?>
   .fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-table-price {
   	   font-size: <?php echo $settings->price_custom_font_size['tablet']; ?>px;
  	}
   <?php } ?>


	<?php if( $settings->duration_font_size == 'custom' && $settings->duration_custom_font_size ) { ?>
	.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-table-duration {
	 	   font-size: <?php echo $settings->duration_custom_font_size['tablet']; ?>px;
	}
 	<?php } ?>


	<?php if( $settings->features_font_size == 'custom' && $settings->features_custom_font_size ) { ?>
	.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-table-features {
		font-size: <?php echo $settings->features_custom_font_size['tablet']; ?>px;
   	}
	<?php } ?>


    <?php if( $settings->button_font_size == 'custom' && $settings->button_custom_font_size ) { ?>
   .fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column a.fl-button {
   	   font-size: <?php echo $settings->button_custom_font_size['tablet']; ?>px !important;
  	}
   <?php } ?>
}

@media only screen and ( max-width: 600px ) {
	<?php if( ($settings->title_font_size == 'custom' && $settings->title_custom_font_size) || ($settings->title_line_height == 'custom' && $settings->title_custom_line_height) ) { ?>
	.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-table-title {
	   <?php if( $settings->title_font_size == 'custom' && $settings->title_custom_font_size ) { ?>
		   font-size: <?php echo $settings->title_custom_font_size['mobile']; ?>px;
	   <?php } ?>
	   <?php if( $settings->title_line_height == 'custom' && $settings->title_custom_line_height ) { ?>
		   line-height: <?php echo $settings->title_custom_line_height['mobile']; ?>;
	   <?php } ?>
   	}
	<?php } ?>

	<?php if( ($settings->featured_title_font_size == 'custom' && $settings->featured_title_custom_font_size) || ($settings->featured_title_line_height == 'custom' && $settings->featured_title_custom_line_height) ) { ?>
   .fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-featured-title {
      <?php if( $settings->featured_title_font_size == 'custom' && $settings->featured_title_custom_font_size ) { ?>
   	   font-size: <?php echo $settings->featured_title_custom_font_size['mobile']; ?>px;
      <?php } ?>
      <?php if( $settings->featured_title_line_height == 'custom' && $settings->featured_title_custom_line_height ) { ?>
   	   line-height: <?php echo $settings->featured_title_custom_line_height['mobile']; ?>;
      <?php } ?>
  	}
	<?php } ?>


    <?php if( $settings->price_font_size == 'custom' && $settings->price_custom_font_size ) { ?>
   .fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-table-price {
   	   font-size: <?php echo $settings->price_custom_font_size['mobile']; ?>px;
  	}
   <?php } ?>


	<?php if( $settings->duration_font_size == 'custom' && $settings->duration_custom_font_size ) { ?>
	.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-table-duration {
	 	font-size: <?php echo $settings->duration_custom_font_size['mobile']; ?>px;
	}
 	<?php } ?>


	<?php if( $settings->features_font_size == 'custom' && $settings->features_custom_font_size ) { ?>
	.fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column .pp-pricing-table-features {
		font-size: <?php echo $settings->features_custom_font_size['mobile']; ?>px;
   	}
	<?php } ?>


    <?php if( $settings->button_font_size == 'custom' && $settings->button_custom_font_size ) { ?>
   .fl-node-<?php echo $id; ?> .pp-pricing-table .pp-pricing-table-column a.fl-button {
   	   font-size: <?php echo $settings->button_custom_font_size['mobile']; ?>px !important;
  	}
   <?php } ?>
}
