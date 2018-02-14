.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper:before {
	border-right-color: <?php echo ($settings->timeline_line_color) ? '#'.$settings->timeline_line_color : '#000' ?>;
	border-right-style: <?php echo $settings->timeline_line_style ?>;
	border-right-width: <?php echo ($settings->timeline_line_width >= 0) ? $settings->timeline_line_width : '1' ?>px;
}
.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper:after {
	border-color: <?php echo ($settings->timeline_line_color) ? '#'.$settings->timeline_line_color : '#000' ?>;
}
.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-title {
	<?php if( $settings->title_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->title_font ); ?><?php } ?>
	<?php if( $settings->title_font_size['title_font_size_desktop'] >= 0 && $settings->title_font_size != '' ) { ?>font-size: <?php echo $settings->title_font_size['title_font_size_desktop']; ?>px;<?php } ?>
	<?php if( $settings->title_line_height['title_line_height_desktop'] >= 0 && $settings->title_line_height != '' ) { ?>line-height: <?php echo $settings->title_line_height['title_line_height_desktop']; ?>;<?php } ?>
	<?php if( $settings->title_padding['top'] >= 0 ) { ?>padding-top: <?php echo $settings->title_padding['top']; ?>px;<?php } ?>
	<?php if( $settings->title_padding['bottom'] >= 0 ) { ?>padding-bottom: <?php echo $settings->title_padding['bottom']; ?>px;<?php } ?>
	<?php if( $settings->title_padding['left'] >= 0 ) { ?>padding-left: <?php echo $settings->title_padding['left']; ?>px;<?php } ?>
	<?php if( $settings->title_padding['right'] >= 0 ) { ?>padding-right: <?php echo $settings->title_padding['right']; ?>px;<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-text-wrapper {
	<?php if( $settings->content_padding['top'] >= 0 ) { ?>padding-top: <?php echo $settings->content_padding['top']; ?>px;<?php } ?>
	<?php if( $settings->content_padding['bottom'] >= 0 ) { ?>padding-bottom: <?php echo $settings->content_padding['bottom']; ?>px;<?php } ?>
	<?php if( $settings->content_padding['left'] >= 0 ) { ?>padding-left: <?php echo $settings->content_padding['left']; ?>px;<?php } ?>
	<?php if( $settings->content_padding['right'] >= 0 ) { ?>padding-right: <?php echo $settings->content_padding['right']; ?>px;<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-text-wrapper p {
	<?php if( $settings->text_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->text_font ); ?><?php } ?>
	<?php if( $settings->text_font_size['text_font_size_desktop'] >= 0 && $settings->text_font_size != '' ) { ?>font-size: <?php echo $settings->text_font_size['text_font_size_desktop']; ?>px;<?php } ?>
	<?php if( $settings->text_line_height['text_line_height_desktop'] >= 0 && $settings->text_line_height != '' ) { ?>line-height: <?php echo $settings->text_line_height['text_line_height_desktop']; ?>;<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content a {
	<?php if( $settings->button_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->button_font ); ?><?php } ?>
	<?php if( $settings->button_font_size ) { ?>font-size: <?php echo $settings->button_font_size; ?>px;<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-icon {
	<?php if( $settings->icon_padding >= 0 ) { ?>padding: <?php echo $settings->icon_padding; ?>px;<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-icon .pp-icon {
	<?php if( $settings->icon_size >= 0 ) { ?>font-size: <?php echo $settings->icon_size; ?>px;<?php } ?>
}

<?php $number_items = count($settings->timeline);
for( $i = 0; $i < $number_items; $i++ ) {
	$timeline = $settings->timeline[$i];
	?>
	.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item-<?php echo $i; ?> .pp-timeline-icon {
		background: <?php echo ($timeline->icon_color->secondary) ? '#'.$timeline->icon_color->secondary : 'transparent' ?>;
		border-color: <?php echo ($timeline->icon_border_color) ? '#'.$timeline->icon_border_color : 'transparent' ?>;
		border-style: <?php echo $timeline->icon_border_style ?>;
		border-radius: <?php echo ($timeline->icon_border_radius >= 0) ? $timeline->icon_border_radius : '0' ?>px;
		border-width: <?php echo ($timeline->icon_border_width >= 0) ? $timeline->icon_border_width : '0' ?>px;
		color: <?php echo ($timeline->icon_color->primary) ? '#'.$timeline->icon_color->primary : '#000' ?>;
	}

	.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item-<?php echo $i; ?> .pp-timeline-content .pp-timeline-title-wrapper {
		background: <?php echo ($timeline->title_color->secondary) ? '#'.$timeline->title_color->secondary : 'transparent' ?>;
		color: <?php echo ($timeline->title_color->primary) ? '#'.$timeline->title_color->primary : '#000' ?>;
	}
	.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item-<?php echo $i; ?> .pp-timeline-content .pp-timeline-text-wrapper p {
		color: <?php echo ($timeline->text_color) ? '#'.$timeline->text_color : '#000' ?>;
	}

	.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item-<?php echo $i; ?> .pp-timeline-content {
		background: <?php echo ($timeline->timeline_box_background) ? '#'.$timeline->timeline_box_background : 'transparent' ?>;
		border-color: <?php echo ($timeline->timeline_box_border_color) ? '#'.$timeline->timeline_box_border_color : 'transparent' ?>;
		border-style: <?php echo $timeline->timeline_box_border_type ?>;
		border-radius: <?php echo ($timeline->timeline_box_border_radius >= 0) ? $timeline->timeline_box_border_radius : '0' ?>px;
		border-width: <?php echo ($timeline->timeline_box_border_width >= 0) ? $timeline->timeline_box_border_width : '0' ?>px;
		<?php if($timeline->timeline_box_shadow == 'yes') {	?>
			-webkit-box-shadow: <?php echo $timeline->box_shadow_options->box_shadow_h; ?>px <?php echo $timeline->box_shadow_options->box_shadow_v; ?>px <?php echo $timeline->box_shadow_options->box_shadow_blur; ?>px <?php echo $timeline->box_shadow_options->box_shadow_spread; ?>px <?php echo pp_hex2rgba( '#'.$timeline->timeline_box_shadow_color, $timeline->timeline_box_shadow_opacity ); ?>;
			-moz-box-shadow: <?php echo $timeline->box_shadow_options->box_shadow_h; ?>px <?php echo $timeline->box_shadow_options->box_shadow_v; ?>px <?php echo $timeline->box_shadow_options->box_shadow_blur; ?>px <?php echo $timeline->box_shadow_options->box_shadow_spread; ?>px <?php echo pp_hex2rgba( '#'.$timeline->timeline_box_shadow_color, $timeline->timeline_box_shadow_opacity ); ?>;
		    -o-box-shadow: <?php echo $timeline->box_shadow_options->box_shadow_h; ?>px <?php echo $timeline->box_shadow_options->box_shadow_v; ?>px <?php echo $timeline->box_shadow_options->box_shadow_blur; ?>px <?php echo $timeline->box_shadow_options->box_shadow_spread; ?>px <?php echo pp_hex2rgba( '#'.$timeline->timeline_box_shadow_color, $timeline->timeline_box_shadow_opacity ); ?>;
		    box-shadow: <?php echo $timeline->box_shadow_options->box_shadow_h; ?>px <?php echo $timeline->box_shadow_options->box_shadow_v; ?>px <?php echo $timeline->box_shadow_options->box_shadow_blur; ?>px <?php echo $timeline->box_shadow_options->box_shadow_spread; ?>px <?php echo pp_hex2rgba( '#'.$timeline->timeline_box_shadow_color, $timeline->timeline_box_shadow_opacity ); ?>;
		<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item-<?php echo $i; ?> .pp-timeline-icon-wrapper .pp-separator-arrow {
		<?php if( $timeline->title != '' ) { ?>
			border-left-color: <?php echo ($timeline->title_color->secondary) ? '#'.$timeline->title_color->secondary : 'transparent' ?>;
		<?php } else { ?>
			border-left-color: <?php echo ($timeline->timeline_box_background) ? '#'.$timeline->timeline_box_background : 'transparent' ?>;
		<?php } ?>
	}
	<?php if( $i % 2 == 1 ) { ?>
		.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item-<?php echo $i; ?> .pp-timeline-icon-wrapper .pp-separator-arrow {
			border-left-color: transparent;
			<?php if( $timeline->title != '' ) { ?>
				border-right: 10px solid <?php echo ($timeline->title_color->secondary) ? '#'.$timeline->title_color->secondary : 'transparent' ?>;
			<?php } else { ?>
				border-right: 10px solid <?php echo ($timeline->timeline_box_background) ? '#'.$timeline->timeline_box_background : 'transparent' ?>;
			<?php } ?>
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item-<?php echo $i; ?> .pp-timeline-content .pp-timeline-button {
		background: <?php echo ($timeline->timeline_button_background->primary) ? '#'.$timeline->timeline_button_background->primary : 'transparent' ?>;
		border-color: <?php echo ($timeline->timeline_button_border_color) ? '#'.$timeline->timeline_button_border_color : 'transparent' ?>;
		border-style: <?php echo $timeline->timeline_button_border_type; ?>;
		border-radius: <?php echo ($timeline->timeline_button_border_radius) ? $timeline->timeline_button_border_radius.'px' : '0' ?>;
		border-width: <?php echo ($timeline->timeline_button_border_width) ? $timeline->timeline_button_border_width.'px' : '0' ?>;
		color: <?php echo ($timeline->timeline_button_color->primary) ? '#'.$timeline->timeline_button_color->primary : '#000' ?>;
		padding-top: <?php echo ( $timeline->button_padding->button_top_padding >= 0) ? $timeline->button_padding->button_top_padding.'px' : '10px';?>;
		padding-right: <?php echo ( $timeline->button_padding->button_right_padding >= 0) ? $timeline->button_padding->button_right_padding.'px' : '10px';?>;
		padding-bottom: <?php echo ( $timeline->button_padding->button_bottom_padding >= 0) ? $timeline->button_padding->button_bottom_padding.'px' : '10px';?>;
		padding-left: <?php echo ( $timeline->button_padding->button_left_padding >= 0) ? $timeline->button_padding->button_left_padding.'px' : '10px';?>;
	}
	.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item-<?php echo $i; ?> .pp-timeline-content .pp-timeline-button:hover {
		background: <?php echo ($timeline->timeline_button_background->secondary) ? '#'.$timeline->timeline_button_background->secondary : 'transparent' ?>;
		color: <?php echo ($timeline->timeline_button_color->secondary) ? '#'.$timeline->timeline_button_color->secondary : '#000' ?>;
	}
<?php } ?>

@media only screen and ( max-width: 768px ) {
	.pp-timeline .pp-timeline-content-wrapper:before {
	    left: 3%;
	    -webkit-transform: translateX(-3%);
	    -moz-transform: translateX(-3%);
	    -o-transform: translateX(-3%);
	    -ms-transform: translateX(-3%);
	    transform: translateX(-3%);
	}
	.pp-timeline .pp-timeline-content-wrapper:after {
		left: 3%;
		-webkit-transform: translateX(-40%);
		-moz-transform: translateX(-40%);
		-o-transform: translateX(-40%);
		-ms-transform: translateX(-40%);
		transform: translateX(-40%);
	}
	.pp-timeline .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content {
	    float: right;
	    width: 90%;
	}
	.pp-timeline .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-icon-wrapper {
	    left: 3%;
		width: 15%;
	}
	.pp-timeline .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-icon-wrapper .pp-separator-arrow {
	    left: auto;
	    right: 0;
	}
	.pp-timeline .pp-timeline-content-wrapper .pp-timeline-item:nth-of-type(2n) .pp-timeline-icon-wrapper .pp-separator-arrow {
	    right: 0;
	}

	<?php $number_items = count($settings->timeline);
	for( $i = 0; $i < $number_items; $i++ ) {
		$timeline = $settings->timeline[$i];
		?>
		.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item-<?php echo $i; ?> .pp-timeline-icon-wrapper .pp-separator-arrow {
			<?php if( $timeline->title != '' ) { ?>
				border-right: 10px solid <?php echo ($timeline->title_color->secondary) ? '#'.$timeline->title_color->secondary : 'transparent' ?>;
			<?php } else { ?>
				border-right: 10px solid <?php echo ($timeline->timeline_box_background) ? '#'.$timeline->timeline_box_background : 'transparent' ?>;
			<?php } ?>
			border-left: none;
		}
		<?php if( $i % 2 == 1 ) { ?>
			.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item-<?php echo $i; ?> .pp-timeline-icon-wrapper .pp-separator-arrow {
				border-left-color: transparent;
				<?php if( $timeline->title != '' ) { ?>
					border-right: 10px solid <?php echo ($timeline->title_color->secondary) ? '#'.$timeline->title_color->secondary : 'transparent' ?>;
				<?php } else { ?>
					border-right: 10px solid <?php echo ($timeline->timeline_box_background) ? '#'.$timeline->timeline_box_background : 'transparent' ?>;
				<?php } ?>
			}
		<?php } ?>
	<?php } ?>
	.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-title {
		<?php if( $settings->title_font_size['title_font_size_tablet'] >= 0 ) { ?>font-size: <?php echo $settings->title_font_size['title_font_size_tablet']; ?>px;<?php } ?>
		<?php if( $settings->title_line_height['title_line_height_tablet'] >= 0 ) { ?>line-height: <?php echo $settings->title_line_height['title_line_height_tablet']; ?>;<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-text-wrapper p {
		<?php if( $settings->text_font_size['text_font_size_tablet'] >= 0 ) { ?>font-size: <?php echo $settings->text_font_size['text_font_size_tablet']; ?>px;<?php } ?>
		<?php if( $settings->text_line_height['text_line_height_tablet'] >= 0 ) { ?>line-height: <?php echo $settings->text_line_height['text_line_height_tablet']; ?>;<?php } ?>
	}
}
@media only screen and ( max-width: 480px ) {
	.pp-timeline .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content {
	    width: 85%;
	}
	.pp-timeline .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-icon-wrapper {
		width: 24%;
	}
	.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-title {
		<?php if( $settings->title_font_size['title_font_size_mobile'] >= 0 ) { ?>font-size: <?php echo $settings->title_font_size['title_font_size_mobile']; ?>px;<?php } ?>
		<?php if( $settings->title_line_height['title_line_height_mobile'] >= 0 ) { ?>line-height: <?php echo $settings->title_line_height['title_line_height_mobile']; ?>;<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-text-wrapper p {
		<?php if( $settings->text_font_size['text_font_size_mobile'] >= 0 ) { ?>font-size: <?php echo $settings->text_font_size['text_font_size_mobile']; ?>px;<?php } ?>
		<?php if( $settings->text_line_height['text_line_height_mobile'] >= 0 ) { ?>line-height: <?php echo $settings->text_line_height['text_line_height_mobile']; ?>;<?php } ?>
	}
}
