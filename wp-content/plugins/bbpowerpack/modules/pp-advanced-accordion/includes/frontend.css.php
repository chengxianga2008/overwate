.fl-node-<?php echo $id; ?> .pp-accordion-item {

	<?php if($settings->item_spacing == 0) : ?>

	border-bottom: none;

	<?php else : ?>

	margin-bottom: <?php echo $settings->item_spacing; ?>px;

	<?php endif; ?>

}

.fl-node-<?php echo $id; ?> .pp-accordion-item:hover,
.fl-node-<?php echo $id; ?> .pp-accordion-item.pp-accordion-item-active {

}

.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-button {
	background-color: <?php echo ( $settings->label_background_color['primary'] ) ? '#' . $settings->label_background_color['primary'] : 'transparent'; ?>;
	color: #<?php echo $settings->label_text_color['primary']; ?>;
	border-style: <?php echo $settings->label_border_style; ?>;
	<?php if( $settings->label_border_style != 'none' ) { ?>
	border-top-width: <?php echo $settings->label_border_width['top']; ?>px;
	border-right-width: <?php echo $settings->label_border_width['right']; ?>px;
	border-bottom-width: <?php echo $settings->label_border_width['bottom']; ?>px;
	border-left-width: <?php echo $settings->label_border_width['left']; ?>px;
	<?php } ?>
	border-color: #<?php echo $settings->label_border_color; ?>;

	<?php if($settings->item_spacing == 0) : ?>
		border-bottom-width: 0;
	<?php endif; ?>

	padding-top: <?php echo $settings->label_padding['top']; ?>px;
	padding-right: <?php echo $settings->label_padding['right']; ?>px;
	padding-bottom: <?php echo $settings->label_padding['bottom']; ?>px;
	padding-left: <?php echo $settings->label_padding['left']; ?>px;

	border-top-left-radius: <?php echo $settings->label_border_radius['top_left']; ?>px;
	border-top-right-radius: <?php echo $settings->label_border_radius['top_right']; ?>px;
	border-bottom-left-radius: <?php echo $settings->label_border_radius['bottom_left']; ?>px;
	border-bottom-right-radius: <?php echo $settings->label_border_radius['bottom_right']; ?>px;

}

.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-button:hover,
.fl-node-<?php echo $id; ?> .pp-accordion-item.pp-accordion-item-active .pp-accordion-button {
	background-color: <?php echo ( $settings->label_background_color['secondary'] ) ? '#' . $settings->label_background_color['secondary'] : 'transparent'; ?>;
	color: #<?php echo $settings->label_text_color['secondary']; ?>;
}

<?php if( $settings->item_spacing == 0 ) : ?>
.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-button:last-child {
	border-bottom-width: <?php echo $settings->label_border_width['bottom']; ?>px;
}
<?php endif; ?>

<?php if( $settings->content_bg_color || $settings->content_border_style != 'none' ) { ?>
	.fl-node-<?php echo $id; ?> .pp-accordion-item.pp-accordion-item-active .pp-accordion-button {
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
		transition: none;
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-button .pp-accordion-button-label {
	<?php if( $settings->label_font['family'] != 'Default' ) { ?>
		<?php FLBuilderFonts::font_css( $settings->label_font ); ?>
	<?php } ?>
	<?php if( $settings->label_custom_font_size['desktop'] && $settings->label_font_size == 'custom' ) { ?>
	font-size: <?php echo $settings->label_custom_font_size['desktop']; ?>px;
	<?php } ?>
	line-height: <?php echo $settings->label_line_height['desktop']; ?>;
}

.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-content {
	<?php if( $settings->content_font['family'] != 'Default' ) { ?>
		<?php FLBuilderFonts::font_css( $settings->content_font ); ?>
	<?php } ?>
	<?php if( $settings->content_custom_font_size['desktop'] && $settings->content_font_size == 'custom' ) { ?>
	font-size: <?php echo $settings->content_custom_font_size['desktop']; ?>px;
	<?php } ?>
	line-height: <?php echo $settings->content_line_height['desktop']; ?>;
	background-color: <?php echo ( $settings->content_bg_color ) ? '#' . $settings->content_bg_color : 'transparent'; ?>;
	color: #<?php echo $settings->content_text_color; ?>;
	border-style: <?php echo $settings->content_border_style; ?>;
	<?php if( $settings->content_border_style != 'none' ) { ?>
	border-top-width: <?php echo $settings->content_border_width['top']; ?>px;
	border-right-width: <?php echo $settings->content_border_width['right']; ?>px;
	border-bottom-width: <?php echo $settings->content_border_width['bottom']; ?>px;
	border-left-width: <?php echo $settings->content_border_width['left']; ?>px;
	<?php } ?>
	border-color: #<?php echo $settings->content_border_color; ?>;
	text-align: <?php echo $settings->content_alignment; ?>;
	padding-top: <?php echo $settings->content_padding['top']; ?>px;
	padding-right: <?php echo $settings->content_padding['right']; ?>px;
	padding-bottom: <?php echo $settings->content_padding['bottom']; ?>px;
	padding-left: <?php echo $settings->content_padding['left']; ?>px;

	border-bottom-left-radius: <?php echo $settings->content_border_radius; ?>px;
	border-bottom-right-radius: <?php echo $settings->content_border_radius; ?>px;
}


.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-button-icon {
	font-size: <?php echo $settings->accordion_toggle_icon_size; ?>px;
	color: #<?php echo $settings->accordion_toggle_icon_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-button-icon:before {
	font-size: <?php echo $settings->accordion_toggle_icon_size; ?>px;
}

.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-icon {
	font-size: <?php echo $settings->accordion_icon_size; ?>px;
	width: <?php echo ($settings->accordion_icon_size * 1.25); ?>px;
	color: #<?php echo $settings->label_text_color['primary']; ?>;
}

.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-button:hover .pp-accordion-icon,
.fl-node-<?php echo $id; ?> .pp-accordion-item.pp-accordion-item-active .pp-accordion-icon {
	color: #<?php echo $settings->label_text_color['secondary']; ?>;
}

.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-icon:before {
	font-size: <?php echo $settings->accordion_icon_size; ?>px;
}

@media only screen and (max-width: 768px) {
	.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-button .pp-accordion-button-label {
		<?php if( $settings->label_custom_font_size['tablet'] && $settings->label_font_size == 'custom' ) { ?>
		font-size: <?php echo $settings->label_custom_font_size['tablet']; ?>px;
		<?php } ?>
		line-height: <?php echo $settings->label_line_height['tablet']; ?>;
	}
	.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-content {
		<?php if( $settings->content_custom_font_size['tablet'] && $settings->content_font_size == 'custom' ) { ?>
		font-size: <?php echo $settings->content_custom_font_size['tablet']; ?>px;
		<?php } ?>
		line-height: <?php echo $settings->content_line_height['tablet']; ?>;
	}
}

@media only screen and (max-width: 480px) {
	.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-button .pp-accordion-button-label {
		<?php if( $settings->label_custom_font_size['mobile'] && $settings->label_font_size == 'custom' ) { ?>
		font-size: <?php echo $settings->label_custom_font_size['mobile']; ?>px;
		<?php } ?>
		line-height: <?php echo $settings->label_line_height['mobile']; ?>;
	}
	.fl-node-<?php echo $id; ?> .pp-accordion-item .pp-accordion-content {
		<?php if( $settings->content_custom_font_size['mobile'] && $settings->content_font_size == 'custom' ) { ?>
		font-size: <?php echo $settings->content_custom_font_size['mobile']; ?>px;
		<?php } ?>
		line-height: <?php echo $settings->content_line_height['mobile']; ?>;
	}
}
