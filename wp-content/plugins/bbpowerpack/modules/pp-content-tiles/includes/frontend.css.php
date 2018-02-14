<?php
$percent = 60;
if ( $settings->layout > 1 ) {
	$percent = 50;
}
?>

.fl-node-<?php echo $id; ?> .pp-post-tile-post {
	margin-right: <?php echo $settings->post_spacing; ?>px;
	margin-bottom: <?php echo $settings->post_spacing; ?>px;
	position: relative;
	overflow: hidden;
	height: <?php echo $settings->post_height + $settings->post_spacing; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-post-tile-left,
.fl-node-<?php echo $id; ?> .pp-post-tile-right {
	float: left;
	width: 50%;
}
<?php if ( $settings->layout == 4 ) { ?>
	.fl-node-<?php echo $id; ?> .pp-post-tile-left {
		width: 75%;
	}
	.fl-node-<?php echo $id; ?> .pp-post-tile-right {
		width: 25%;
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-post-tile-medium {
	height: <?php echo ($settings->post_height * $percent) / 100; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-post-tile-small {
	float: left;
	height: <?php echo $settings->post_height - (($settings->post_height * $percent) / 100); ?>px;
	width: calc(50% - <?php echo $settings->post_spacing; ?>px);
	<?php if ( $settings->layout == 4 ) { ?>
	width: 100%;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-title {
	<?php if ( $settings->title_font['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->title_font ); ?>
   	<?php } ?>
   	<?php if ( $settings->title_font_size != 'default' && isset($settings->title_custom_font_size['desktop']) ) { ?>
	   font-size: <?php echo $settings->title_custom_font_size['desktop']; ?>px;
	<?php } ?>
	<?php if ( $settings->title_line_height != 'default' && isset($settings->title_custom_line_height['desktop']) ) { ?>
	   line-height: <?php echo $settings->title_custom_line_height['desktop']; ?>;
	<?php } ?>
	<?php if ( $settings->title_letter_spacing != 'default' && isset($settings->title_custom_letter_spacing['desktop']) ) { ?>
	   letter-spacing: <?php echo $settings->title_custom_letter_spacing['desktop']; ?>px;
	<?php } ?>
	<?php if ( $settings->title_text_transform != 'none' ) { ?>
		text-transform: <?php echo $settings->title_text_transform; ?>;
	<?php } ?>
	<?php if ( isset($settings->title_margin['top']) ) { ?>
		margin-top: <?php echo $settings->title_margin['top']; ?>px;
	<?php } ?>
	<?php if ( isset($settings->title_margin['bottom']) ) { ?>
		margin-bottom: <?php echo $settings->title_margin['bottom']; ?>px;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-post-tile-small .pp-post-tile-title {
	<?php if ( $settings->title_font_size_s != 'default' && isset($settings->title_custom_font_size_s['desktop']) ) { ?>
	   font-size: <?php echo $settings->title_custom_font_size_s['desktop']; ?>px;
	<?php } else { ?>
		font-size: 18px;
	<?php } ?>
	<?php if ( $settings->title_line_height_s != 'default' && isset($settings->title_custom_line_height_s['desktop']) ) { ?>
	   line-height: <?php echo $settings->title_custom_line_height_s['desktop']; ?>;
	<?php } else { ?>
		line-height: 24px;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-category,
.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-meta {
	<?php if ( $settings->meta_font['family'] != 'Default' ) { ?>
	   <?php FLBuilderFonts::font_css( $settings->meta_font ); ?>
   	<?php } ?>
   	<?php if ( $settings->meta_font_size != 'default' && isset($settings->meta_custom_font_size['desktop']) ) { ?>
	   font-size: <?php echo $settings->meta_custom_font_size['desktop']; ?>px;
	<?php } ?>
	<?php if ( $settings->meta_letter_spacing != 'default' && isset($settings->meta_custom_letter_spacing['desktop']) ) { ?>
	   letter-spacing: <?php echo $settings->meta_custom_letter_spacing['desktop']; ?>px;
	<?php } ?>
	<?php if ( $settings->meta_text_transform != 'none' ) { ?>
		text-transform: <?php echo $settings->meta_text_transform; ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-category span {
	display: inline-block;
	<?php if ( isset( $settings->tax_bg_color ) && !empty( $settings->tax_bg_color ) ) { ?>
		background-color: #<?php echo $settings->tax_bg_color; ?>;
		margin-bottom: 10px;
		padding: 2px 8px;
		-webkit-transition: background-color 0.2s ease-in-out;
		-moz-transition: background-color 0.2s ease-in-out;
		transition: background-color 0.2s ease-in-out;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-post-tile-post:hover .pp-post-tile-category span {
	<?php if ( isset( $settings->tax_bg_color_h ) && !empty( $settings->tax_bg_color_h ) ) { ?>
		background-color: #<?php echo $settings->tax_bg_color_h; ?>;
		-webkit-transition: background-color 0.2s ease-in-out;
		-moz-transition: background-color 0.2s ease-in-out;
		transition: background-color 0.2s ease-in-out;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-meta {
	margin-left: 20px;
	<?php if ( isset($settings->meta_margin['top']) ) { ?>
		margin-top: <?php echo $settings->meta_margin['top']; ?>px;
	<?php } ?>
	<?php if ( isset($settings->meta_margin['bottom']) ) { ?>
		margin-bottom: <?php echo $settings->meta_margin['bottom']; ?>px;
	<?php } ?>
    min-height: 0;
}
.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-author {
	display: inline-block;
    position: relative;
}
.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-author,
.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-date {
	display: inline-block;
    position: relative;
	top: 0;
}
.fl-node-<?php echo $id; ?> .pp-post-tile-post a,
.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-category,
.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-author,
.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-date,
.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-meta-separator {
	color: #<?php echo ( isset( $settings->text_color ) && !empty( $settings->text_color ) ) ? $settings->text_color : 'ffffff'; ?>;
    text-shadow: 1px 1px 1px rgba(0,0,0,.3);
}

@media only screen and (max-width: 768px) {
	.fl-node-<?php echo $id; ?> .pp-post-tile-left,
	.fl-node-<?php echo $id; ?> .pp-post-tile-right {
		width: 100%;
	}
	.fl-node-<?php echo $id; ?> .pp-post-tile-left .pp-post-tile-post {
		margin-right: 0;
	}
	.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-title {
	   	<?php if ( $settings->title_font_size != 'default' && isset($settings->title_custom_font_size['tablet']) && !empty($settings->title_custom_font_size['tablet']) ) { ?>
		   font-size: <?php echo $settings->title_custom_font_size['tablet']; ?>px;
		<?php } ?>
		<?php if ( $settings->title_line_height != 'default' && isset($settings->title_custom_line_height['tablet']) && !empty($settings->title_custom_font_size['tablet']) ) { ?>
		   line-height: <?php echo $settings->title_custom_line_height['tablet']; ?>;
		<?php } ?>
		<?php if ( $settings->title_letter_spacing != 'default' && isset($settings->title_custom_letter_spacing['tablet']) && !empty($settings->title_custom_font_size['tablet']) ) { ?>
		   letter-spacing: <?php echo $settings->title_custom_letter_spacing['tablet']; ?>px;
		<?php } ?>
	}
}

@media only screen and (max-width: 480px) {
	.fl-node-<?php echo $id; ?> .pp-post-tile-small {
		width: 100%;
	}
	.fl-node-<?php echo $id; ?> .pp-post-tile-post .pp-post-tile-title {
	   	<?php if ( $settings->title_font_size != 'default' && isset($settings->title_custom_font_size['mobile']) && !empty($settings->title_custom_font_size['mobile']) ) { ?>
		   font-size: <?php echo $settings->title_custom_font_size['mobile']; ?>px;
		<?php } ?>
		<?php if ( $settings->title_line_height != 'default' && isset($settings->title_custom_line_height['mobile']) && !empty($settings->title_custom_font_size['mobile']) ) { ?>
		   line-height: <?php echo $settings->title_custom_line_height['mobile']; ?>;
		<?php } ?>
		<?php if ( $settings->title_letter_spacing != 'default' && isset($settings->title_custom_letter_spacing['mobile']) && !empty($settings->title_custom_font_size['mobile']) ) { ?>
		   letter-spacing: <?php echo $settings->title_custom_letter_spacing['mobile']; ?>px;
		<?php } ?>
	}
}
