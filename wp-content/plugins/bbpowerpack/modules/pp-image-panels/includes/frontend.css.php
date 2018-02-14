.fl-node-<?php echo $id; ?> .pp-image-panels-wrap .pp-panel-item {
	height: <?php echo $settings->panel_height ?>px;
}
.fl-node-<?php echo $id; ?> .pp-image-panels-wrap .pp-panel-item .pp-panel-title h3 {
	<?php if ( 'no' == $settings->show_title ) { ?>
	display: none;
	<?php } ?>
	font-size: <?php echo $settings->title_font_size['title_font_size_desktop']; ?>px;
	<?php if( $settings->title_font['family']	!= 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->title_font ); ?><?php } ?>
	line-height: <?php echo $settings->title_line_height['title_line_height_desktop']; ?>;
	padding-top: <?php echo $settings->title_padding['title_top_padding']; ?>px;
	padding-right: <?php echo $settings->title_padding['title_right_padding']; ?>px;
	padding-bottom: <?php echo $settings->title_padding['title_bottom_padding']; ?>px;
	padding-left: <?php echo $settings->title_padding['title_left_padding']; ?>px;
}
<?php
$number_panels = count($settings->image_panels);
for( $i = 0; $i < $number_panels; $i++ ) {
	$panel = $settings->image_panels[$i];
	if ( !is_object($panel) ) {
		continue;
	}
?>
	.fl-node-<?php echo $id; ?> .pp-image-panels-wrap .pp-panel-link-<?php echo $i; ?> {
		<?php if( $panel->link_type == 'panel' ) { ?>
			width: <?php echo 100/$number_panels; ?>%;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-image-panels-wrap .pp-panel-item-<?php echo $i; ?> {
		<?php if( $panel->link_type == 'none' ) { ?>
			width: <?php echo 100/$number_panels; ?>%;
		<?php } else { ?>
			width: 100%;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-image-panels-wrap .pp-panel-item-<?php echo $i; ?> {
		background-image: url(<?php echo $panel->photo_src; ?>);
		<?php if ( $settings->image_panels[$i]->position == 'custom' ) { ?>
		background-position: <?php echo $settings->image_panels[$i]->custom_position; ?>%;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-image-panels-wrap .pp-panel-item-<?php echo $i; ?> .pp-panel-title h3 {
		background: <?php echo pp_hex2rgba( '#'.$panel->title_colors->secondary, $panel->title_opacity ) ?>;
		color: #<?php echo $panel->title_colors->primary; ?>;
	}
<?php } ?>

@media only screen and ( max-width: 768px ) {
	.fl-node-<?php echo $id; ?> .pp-image-panels-wrap .pp-panel-item .pp-panel-title h3 {
		font-size: <?php echo $settings->title_font_size['title_font_size_tablet']; ?>px;
		line-height: <?php echo $settings->title_line_height['title_line_height_tablet']; ?>;
	}
	<?php for( $i = 0; $i < $number_panels; $i++ ) {
		$panel = $settings->image_panels[$i];
	?>
		.fl-node-<?php echo $id; ?> .pp-image-panels-wrap .pp-panel-link-<?php echo $i; ?>,
		.fl-node-<?php echo $id; ?> .pp-image-panels-wrap .pp-panel-item-<?php echo $i; ?> {
			width: 100% !important;
		}
	<?php } ?>
}
@media only screen and ( max-width: 480px ) {
	.fl-node-<?php echo $id; ?> .pp-image-panels-wrap .pp-panel-item .pp-panel-title h3 {
		font-size: <?php echo $settings->title_font_size['title_font_size_mobile']; ?>px;
		line-height: <?php echo $settings->title_line_height['title_line_height_mobile']; ?>;
	}
}
