<?php
$space_desktop = ( $settings->hover_card_column_width['hover_card_columns_desktop'] - 1 ) * $settings->hover_card_spacing;
$space_tablet = ( $settings->hover_card_column_width['hover_card_columns_tablet'] - 1 ) * $settings->hover_card_spacing;
$space_mobile = ( $settings->hover_card_column_width['hover_card_columns_mobile'] - 1 ) * $settings->hover_card_spacing;
$hover_card_columns_desktop = ( 100 - $space_desktop ) / $settings->hover_card_column_width['hover_card_columns_desktop'];
$hover_card_columns_tablet = ( 100 - $space_tablet ) / $settings->hover_card_column_width['hover_card_columns_tablet'];
$hover_card_columns_mobile = ( 100 - $space_mobile ) / $settings->hover_card_column_width['hover_card_columns_mobile']; ?>

.fl-node-<?php echo $id; ?> .pp-hover-card-container {
	width: <?php echo $hover_card_columns_desktop; ?>%;
	height: <?php echo $settings->hover_card_height_f['hover_card_height']; ?>px;
    margin-right: <?php echo $settings->hover_card_spacing; ?>%;
    margin-bottom: <?php echo $settings->hover_card_spacing; ?>%;
	float: left;
}

.fl-node-<?php echo $id; ?> .pp-hover-card-container:nth-of-type(<?php echo $settings->hover_card_column_width['hover_card_columns_desktop']; ?>n+1) {
    clear: left;
}

.fl-node-<?php echo $id; ?> .pp-hover-card-container:nth-of-type(<?php echo $settings->hover_card_column_width['hover_card_columns_desktop']; ?>n) {
    margin-right: 0;
}

<?php $number_cards = count($settings->card_content);
for($i = 0; $i < $number_cards; $i++) {
	$cards = $settings->card_content[$i];
	?>
	<?php if( $cards->hover_card_bg_type == 'image' ) { ?>
		.fl-node-<?php echo $id; ?> .hover-card-<?php echo $i; ?> .pp-hover-card:hover {
			background: <?php echo ($cards->hover_card_overlay) ? pp_hex2rgba('#'.$cards->hover_card_overlay, $cards->hover_card_overlay_opacity) : 'transparent'; ?>;
		}
		.fl-node-<?php echo $id; ?> .pp-hover-card-container.style-2:hover .pp-hover-card-overlay {
			opacity: 0.1;
		}
	<?php } ?>
	.fl-node-<?php echo $id; ?> .hover-card-<?php echo $i; ?> .pp-hover-card-overlay {
		<?php if( $cards->hover_card_box_border_radius >= 0 ) { ?>border-radius: <?php echo $cards->hover_card_box_border_radius; ?>px;<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-hover-card-container.hover-card-<?php echo $i; ?> {
		<?php if( $cards->hover_card_box_border_radius >= 0 ) { ?>border-radius: <?php echo $cards->hover_card_box_border_radius; ?>px;<?php } ?>
		background-color: <?php echo ($cards->hover_card_bg_color) ? '#'.$cards->hover_card_bg_color : 'transparent'; ?>;
		<?php if( $cards->hover_card_box_image && $cards->hover_card_bg_type == 'image' ) { ?>
		background-image: url('<?php echo $cards->hover_card_box_image_src; ?>');
		background-repeat: no-repeat;
		background-size: cover;
		<?php } ?>
	}


	.fl-node-<?php echo $id; ?> .pp-hover-card-container.hover-card-<?php echo $i; ?> .pp-hover-card-inner {
		<?php if( $cards->hover_card_box_padding->top ) { ?>
		padding-top: <?php echo $cards->hover_card_box_padding->top; ?>px;
		<?php } ?>
		<?php if( $cards->hover_card_box_padding->right ) { ?>
		padding-right: <?php echo $cards->hover_card_box_padding->right; ?>px;
		<?php } ?>
		<?php if( $cards->hover_card_box_padding->bottom ) { ?>
		padding-bottom: <?php echo $cards->hover_card_box_padding->bottom; ?>px;
		<?php } ?>
		<?php if( $cards->hover_card_box_padding->left ) { ?>
		padding-left: <?php echo $cards->hover_card_box_padding->left; ?>px;
		<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .pp-hover-card-container.hover-card-<?php echo $i; ?> .pp-hover-card .pp-hover-card-border {
		border-color: <?php echo ($cards->hover_card_box_border_color) ? '#'.$cards->hover_card_box_border_color : 'transparent'; ?>;
		<?php if( $cards->hover_card_box_border_radius >= 0 ) { ?>border-radius: <?php echo $cards->hover_card_box_border_radius; ?>px;<?php } ?>
		<?php if( $cards->hover_card_box_border_width >= 0 && $cards->hover_card_box_border != 'none' ) { ?>border-width: <?php echo $cards->hover_card_box_border_width; ?>px;<?php } ?>
		<?php if( $cards->hover_card_box_border ) { ?>border-style: <?php echo $cards->hover_card_box_border; ?>;<?php } ?>
		<?php if( $cards->hover_card_box_border_opacity >= 0 ) { ?>opacity: <?php echo $cards->hover_card_box_border_opacity; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .hover-card-<?php echo $i; ?>.powerpack-style:hover .pp-hover-card-description {
		opacity: 1;
	}

	.fl-node-<?php echo $id; ?> .hover-card-<?php echo $i; ?>.powerpack-style:hover .pp-more-link {
		opacity: 1;
	}


	.fl-node-<?php echo $id; ?> .pp-hover-card-container.hover-card-<?php echo $i; ?> .pp-hover-card-title h3 {
		<?php if( $cards->hover_card_title_color ) { ?>color: #<?php echo $cards->hover_card_title_color; ?>;<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-hover-card-container.hover-card-<?php echo $i; ?> .pp-hover-card-description {
		<?php if( $cards->hover_card_description_color ) { ?>color: #<?php echo $cards->hover_card_description_color; ?>;<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-hover-card-container.hover-card-<?php echo $i; ?> .pp-hover-card .icon {
		<?php if( $cards->hover_card_icon_color ) { ?>color: #<?php echo $cards->hover_card_icon_color; ?>;<?php } ?>
		<?php if($cards->hover_card_icon_size >= 0 ) { ?>
		font-size: <?php echo $cards->hover_card_icon_size; ?>px;
		width: <?php echo $cards->hover_card_icon_size; ?>px;
		<?php } ?>
	}


/* Button */
	.fl-node-<?php echo $id; ?> .pp-hover-card-container.hover-card-<?php echo $i; ?> .pp-hover-card .pp-hover-card-inner .pp-more-link {
		background: <?php echo ($cards->button_background->primary) ? '#'.$cards->button_background->primary : 'transparent'; ?>;
		<?php if( $cards->button_border_color->primary ) { ?>border-color: #<?php echo $cards->button_border_color->primary; ?>;<?php } ?>
		<?php if( $cards->button_border_radius >= 0 ) { ?>border-radius: <?php echo $cards->button_border_radius; ?>px;<?php } ?>
		<?php if( $cards->button_border_width && $cards->button_border != 'none' ) { ?>border-width: <?php echo $cards->button_border_width; ?>px;<?php } ?>
		<?php if( $cards->button_border ) { ?>border-style: <?php echo $cards->button_border; ?>;<?php } ?>
		<?php if( $cards->button_color->primary ) { ?>color: #<?php echo $cards->button_color->primary; ?>;<?php } ?>
		<?php if( $cards->button_padding->top ) { ?>
		padding-top: <?php echo $cards->button_padding->top; ?>px;
		<?php } ?>
		<?php if( $cards->button_padding->right ) { ?>
		padding-right: <?php echo $cards->button_padding->right; ?>px;
		<?php } ?>
		<?php if( $cards->button_padding->bottom ) { ?>
		padding-bottom: <?php echo $cards->button_padding->bottom; ?>px;
		<?php } ?>
		<?php if( $cards->button_padding->left ) { ?>
		padding-left: <?php echo $cards->button_padding->left; ?>px;
		<?php } ?>
		<?php if( $cards->button_width ) { ?>
		width: <?php echo $cards->button_width; ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-hover-card-container.hover-card-<?php echo $i; ?> .pp-hover-card .pp-hover-card-inner .pp-more-link:hover {
		<?php if( $cards->button_background->secondary ) { ?>background: #<?php echo $cards->button_background->secondary; ?>;<?php } ?>
		<?php if( $cards->button_color->secondary ) { ?>color: #<?php echo $cards->button_color->secondary; ?>;<?php } ?>
		<?php if( $cards->button_border_color->secondary ) { ?>border-color: #<?php echo $cards->button_border_color->secondary; ?>;<?php } ?>
	}

<?php } ?>

.fl-node-<?php echo $id; ?> .pp-hover-card-container .pp-hover-card-title h3 {
	<?php if( $settings->hover_card_title_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->hover_card_title_font ); ?><?php } ?>
	<?php if( $settings->hover_card_title_font_size_f['hover_card_title_font_size'] ) { ?>font-size: <?php echo $settings->hover_card_title_font_size_f['hover_card_title_font_size']; ?>px;<?php } ?>
	<?php if( $settings->hover_card_title_line_height_f['hover_card_title_line_height'] ) { ?>line-height: <?php echo $settings->hover_card_title_line_height_f['hover_card_title_line_height']; ?>;<?php } ?>
	<?php if( $settings->hover_card_title_margin['hover_card_title_margin_top'] ) { ?>margin-top: <?php echo $settings->hover_card_title_margin['hover_card_title_margin_top']; ?>px;<?php } ?>
	<?php if( $settings->hover_card_title_margin['hover_card_title_margin_bottom'] ) { ?>margin-bottom: <?php echo $settings->hover_card_title_margin['hover_card_title_margin_bottom']; ?>px;<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-hover-card-container .pp-hover-card-description {
	<?php if( $settings->hover_card_description_font['family']	!= 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->hover_card_description_font ); ?><?php } ?>
	<?php if( $settings->hover_card_description_font_size_f['hover_card_description_font_size'] ) { ?>font-size: <?php echo $settings->hover_card_description_font_size_f['hover_card_description_font_size']; ?>px;<?php } ?>
	<?php if( $settings->hover_card_description_line_height_f['hover_card_description_line_height'] ) { ?>line-height: <?php echo $settings->hover_card_description_line_height_f['hover_card_description_line_height']; ?>;<?php } ?>
	<?php if( $settings->hover_card_description_margin['hover_card_description_margin_top'] ) { ?>margin-top: <?php echo $settings->hover_card_description_margin['hover_card_description_margin_top']; ?>px;<?php } ?>
	<?php if( $settings->hover_card_description_margin['hover_card_description_margin_bottom'] ) { ?>margin-bottom: <?php echo $settings->hover_card_description_margin['hover_card_description_margin_bottom']; ?>px;<?php } ?>
}

/* Button */
.fl-node-<?php echo $id; ?> .pp-hover-card .pp-hover-card-inner .pp-more-link {
	<?php if( $settings->button_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->button_font ); ?><?php } ?>
	<?php if( $settings->button_font_size_f['button_font_size'] ) { ?>font-size: <?php echo $settings->button_font_size_f['button_font_size']; ?>px;<?php } ?>
}

@media only screen and (max-width: <?php echo $global_settings->medium_breakpoint; ?>px) {
    .fl-node-<?php echo $id; ?> .pp-hover-card-container {
        <?php if( $settings->hover_card_column_width['hover_card_columns_tablet'] >= 0 ) { ?>
        width: <?php echo $hover_card_columns_tablet; ?>%;
        <?php } ?>
		<?php if( $settings->hover_card_height_f['hover_card_height_tablet'] >= 0 ) { ?>
		height: <?php echo $settings->hover_card_height_f['hover_card_height_tablet']; ?>px;
		<?php } ?>
    }
	.fl-node-<?php echo $id; ?> .pp-hover-card-container .pp-hover-card-title h3 {
		<?php if( $settings->hover_card_title_font_size_f['hover_card_title_font_size_tablet'] ) { ?>font-size: <?php echo $settings->hover_card_title_font_size_f['hover_card_title_font_size_tablet']; ?>px;<?php } ?>
		<?php if( $settings->hover_card_title_line_height_f['hover_card_title_line_height_tablet'] ) { ?>line-height: <?php echo $settings->hover_card_title_line_height_f['hover_card_title_line_height_tablet']; ?>;<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-hover-card-container .pp-hover-card-description {
		<?php if( $settings->hover_card_description_font_size_f['hover_card_description_font_size_tablet'] ) { ?>font-size: <?php echo $settings->hover_card_description_font_size_f['hover_card_description_font_size_tablet']; ?>px;<?php } ?>
		<?php if( $settings->hover_card_description_line_height_f['hover_card_description_line_height_tablet'] ) { ?>line-height: <?php echo $settings->hover_card_description_line_height_f['hover_card_description_line_height_tablet']; ?>;<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-hover-card .pp-hover-card-inner .pp-more-link {
		<?php if( $settings->button_font_size_f['hover_card_button_font_size_tablet'] ) { ?>font-size: <?php echo $settings->button_font_size_f['hover_card_button_font_size_tablet']; ?>px;<?php } ?>
	}
    .fl-node-<?php echo $id; ?> .pp-hover-card-container:nth-of-type(<?php echo $settings->hover_card_column_width['hover_card_columns_desktop']; ?>n+1) {
        clear: none;
    }
    .fl-node-<?php echo $id; ?> .pp-hover-card-container:nth-of-type(<?php echo $settings->hover_card_column_width['hover_card_columns_tablet']; ?>n+1) {
        clear: left;
    }
    .fl-node-<?php echo $id; ?> .pp-hover-card-container:nth-of-type(<?php echo $settings->hover_card_column_width['hover_card_columns_desktop']; ?>n) {
        margin-right: <?php echo $settings->hover_card_spacing; ?>%;
    }
    .fl-node-<?php echo $id; ?> .pp-hover-card-container:nth-of-type(<?php echo $settings->hover_card_column_width['hover_card_columns_tablet']; ?>n) {
        margin-right: 0;
    }
}

@media only screen and (max-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {
    .fl-node-<?php echo $id; ?> .pp-hover-card-container {
        <?php if( $settings->hover_card_column_width['hover_card_columns_mobile'] >= 0 ) { ?>
        width: <?php echo $hover_card_columns_mobile; ?>%;
        <?php } ?>
		<?php if( $settings->hover_card_height_f['hover_card_height_mobile'] >= 0 ) { ?>
		height: <?php echo $settings->hover_card_height_f['hover_card_height_mobile']; ?>px;
		<?php } ?>
    }
	.fl-node-<?php echo $id; ?> .pp-hover-card-container .pp-hover-card-title h3 {
		<?php if( $settings->hover_card_title_font_size_f['hover_card_title_font_size_mobile'] ) { ?>font-size: <?php echo $settings->hover_card_title_font_size_f['hover_card_title_font_size_mobile']; ?>px;<?php } ?>
		<?php if( $settings->hover_card_title_line_height_f['hover_card_title_line_height_mobile'] ) { ?>line-height: <?php echo $settings->hover_card_title_line_height_f['hover_card_title_line_height_mobile']; ?>;<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-hover-card-container .pp-hover-card-description {
		<?php if( $settings->hover_card_description_font_size_f['hover_card_description_font_size_mobile'] ) { ?>font-size: <?php echo $settings->hover_card_description_font_size_f['hover_card_description_font_size_mobile']; ?>px;<?php } ?>
		<?php if( $settings->hover_card_description_line_height_f['hover_card_description_line_height_mobile'] ) { ?>line-height: <?php echo $settings->hover_card_description_line_height_f['hover_card_description_line_height_mobile']; ?>;<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-hover-card .pp-hover-card-inner .pp-more-link {
		<?php if( $settings->button_font_size_f['hover_card_button_font_size_mobile'] ) { ?>font-size: <?php echo $settings->button_font_size_f['hover_card_button_font_size_mobile']; ?>px;<?php } ?>
	}
    .fl-node-<?php echo $id; ?> .pp-hover-card-container:nth-of-type(<?php echo $settings->hover_card_column_width['hover_card_columns_tablet']; ?>n+1) {
            clear: none;
    }
    .fl-node-<?php echo $id; ?> .pp-hover-card-container:nth-of-type(<?php echo $settings->hover_card_column_width['hover_card_columns_mobile']; ?>n+1) {
            clear: left;
    }
    .fl-node-<?php echo $id; ?> .pp-hover-card-container:nth-of-type(<?php echo $settings->hover_card_column_width['hover_card_columns_tablet']; ?>n) {
            margin-right: <?php echo $settings->hover_card_spacing; ?>%;
    }
    .fl-node-<?php echo $id; ?> .pp-hover-card-container:nth-of-type(<?php echo $settings->hover_card_column_width['hover_card_columns_mobile']; ?>n) {
            margin-right: 0;
    }
}
