.fl-node-<?php echo $id; ?> .pp-notification-wrapper {
	background: <?php echo ($settings->box_background) ? '#'.$settings->box_background : 'transparent'; ?>;
	<?php if($settings->box_border_type) { ?>border-style: <?php echo $settings->box_border_type; ?>;<?php } ?>
	<?php if($settings->box_border_color) { ?>border-color: #<?php echo $settings->box_border_color; ?>;<?php } ?>
	<?php if($settings->box_border_width) { ?>border-width: <?php echo $settings->box_border_width; ?>px;<?php } ?>
	<?php if($settings->box_border_radius) { ?>border-radius: <?php echo $settings->box_border_radius; ?>px;<?php } ?>
	padding-top: <?php echo ($settings->box_padding['box_top_padding'] >= 0) ? $settings->box_padding['box_top_padding'].'px' : '0'; ?>;
	padding-right: <?php echo ($settings->box_padding['box_right_padding'] >= 0) ? $settings->box_padding['box_right_padding'].'px' : '0'; ?>;
	padding-bottom: <?php echo ($settings->box_padding['box_bottom_padding'] >= 0) ? $settings->box_padding['box_bottom_padding'].'px' : '0'; ?>;
	padding-left: <?php echo ($settings->box_padding['box_left_padding'] >= 0) ? $settings->box_padding['box_left_padding'].'px' : '0'; ?>;
}
.fl-node-<?php echo $id; ?> .pp-notification-wrapper .pp-notification-inner .pp-notification-icon {
	margin-right: <?php echo ($settings->box_padding['box_left_padding'] > 0) ? $settings->box_padding['box_left_padding'].'px' : '10px'; ?>;
}
.fl-node-<?php echo $id; ?> .pp-notification-wrapper .pp-notification-inner .pp-notification-icon span.pp-icon {
	<?php if($settings->icon_color) { ?>color: #<?php echo $settings->icon_color; ?>;<?php } ?>
	<?php if($settings->icon_size) { ?>font-size: <?php echo $settings->icon_size; ?>px;<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-notification-wrapper .pp-notification-inner .pp-notification-content p {
	<?php if($settings->text_color) { ?>color: #<?php echo $settings->text_color; ?>;<?php } ?>
	<?php if( $settings->text_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->text_font ); ?><?php } ?>
	<?php if($settings->text_size['text_size_desktop'] >= 0) { ?>font-size: <?php echo $settings->text_size['text_size_desktop']; ?>px;<?php } ?>
	<?php if($settings->text_line_height['text_line_height_desktop'] >= 0) { ?>line-height: <?php echo $settings->text_line_height['text_line_height_desktop']; ?>;<?php } ?>
}

@media only screen and ( max-width: 768px ) {
	.fl-node-<?php echo $id; ?> .pp-notification-wrapper .pp-notification-inner .pp-notification-content p {
		<?php if($settings->text_size['text_size_tablet'] >= 0) { ?>font-size: <?php echo $settings->text_size['text_size_tablet']; ?>px;<?php } ?>
		<?php if($settings->text_line_height['text_line_height_tablet'] >= 0) { ?>line-height: <?php echo $settings->text_line_height['text_line_height_tablet']; ?>;<?php } ?>
	}
}

@media only screen and ( max-width: 480px ) {
	.fl-node-<?php echo $id; ?> .pp-notification-wrapper .pp-notification-inner .pp-notification-content p {
		<?php if($settings->text_size['text_size_mobile'] >= 0) { ?>font-size: <?php echo $settings->text_size['text_size_mobile']; ?>px;<?php } ?>
		<?php if($settings->text_line_height['text_line_height_mobile'] >= 0) { ?>line-height: <?php echo $settings->text_line_height['text_line_height_mobile']; ?>;<?php } ?>
	}
}
