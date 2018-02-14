.fl-node-<?php echo $id; ?> .pp-testimonials-wrap .bx-wrapper .bx-pager a {
	<?php if( $settings->dot_color ) { ?>background: #<?php echo $settings->dot_color; ?><?php } ?>;
}
.fl-node-<?php echo $id; ?> .pp-testimonials-wrap .bx-wrapper .bx-pager a {
	opacity: 0.5;
}
.fl-node-<?php echo $id; ?> .pp-testimonials-wrap .bx-wrapper .bx-pager a.active {
	<?php if( $settings->active_dot_color ) { ?>background: #<?php echo $settings->active_dot_color; ?>;<?php } ?>
	opacity: 1;
}
.fl-node-<?php echo $id; ?> .pp-testimonials-wrap .fa:hover,
.fl-node-<?php echo $id; ?> .pp-testimonials-wrap .fa {
	<?php if( $settings->arrow_color ) { ?>color: #<?php echo $settings->arrow_color; ?>;<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-testimonials-wrap .pp-arrow-wrapper {
	<?php if( $settings->arrow_alignment ) { ?>text-align: <?php echo $settings->arrow_alignment; ?><?php } ?>
}

<?php if( $settings->layout_4_content_bg || $settings->box_border_width != 0 ) { ?>
	.fl-node-<?php echo $id; ?> .pp-testimonials .pp-content-wrapper {
		padding: 20px;
	}
<?php } ?>

<?php if( $settings->testimonial_layout == '1' ) { ?>
	.fl-node-<?php echo $id; ?> .pp-testimonial.layout-1 .pp-content-wrapper {
		<?php if( $settings->box_border_color ) { ?>border-color: #<?php echo $settings->box_border_color; ?>;<?php } ?>
		<?php if( $settings->box_border_radius ) { ?>border-radius: <?php echo $settings->box_border_radius; ?>px;<?php } ?>
		<?php if( $settings->box_border_style ) { ?>border-style: <?php echo $settings->box_border_style; ?>;<?php } ?>
		<?php if( $settings->box_border_width ) { ?>border-width: <?php echo $settings->box_border_width; ?>px;<?php } ?>
		<?php if( $settings->layout_4_content_bg ) { ?>background: #<?php echo $settings->layout_4_content_bg; ?>;<?php } ?>
	}
	<?php if( $settings->show_arrow == 'yes' ) { ?>
		.fl-node-<?php echo $id; ?> .pp-testimonial.layout-1 .pp-arrow-top {
			<?php if( $settings->layout_4_content_bg ) { ?>border-bottom-color: #<?php echo $settings->layout_4_content_bg; ?><?php } ?>
		}
	<?php } ?>
<?php } ?>
<?php if( $settings->testimonial_layout == '2' ) { ?>
	.fl-node-<?php echo $id; ?> .pp-testimonial.layout-2 .pp-content-wrapper {
		<?php if( $settings->box_border_color ) { ?>border-color: #<?php echo $settings->box_border_color; ?>;<?php } ?>
		<?php if( $settings->box_border_radius ) { ?>border-radius: <?php echo $settings->box_border_radius; ?>px;<?php } ?>
		<?php if( $settings->box_border_style ) { ?>border-style: <?php echo $settings->box_border_style; ?>;<?php } ?>
		<?php if( $settings->box_border_width ) { ?>border-width: <?php echo $settings->box_border_width; ?>px;<?php } ?>
		<?php if( $settings->layout_4_content_bg ) { ?>background: #<?php echo $settings->layout_4_content_bg; ?><?php } ?>
	}
	<?php if( $settings->show_arrow == 'yes' ) { ?>
		.fl-node-<?php echo $id; ?> .pp-testimonial.layout-2 .pp-arrow-bottom {
			<?php if( $settings->layout_4_content_bg ) { ?>border-top-color: #<?php echo $settings->layout_4_content_bg; ?>;<?php } ?>
		}
	<?php } ?>
<?php } ?>
<?php if( $settings->testimonial_layout == '3' ) { ?>
	.fl-node-<?php echo $id; ?> .pp-testimonial.layout-3 .pp-content-wrapper {
		<?php if( $settings->box_border_color ) { ?>border-color: #<?php echo $settings->box_border_color; ?>;<?php } ?>
		<?php if( $settings->box_border_radius ) { ?>border-radius: <?php echo $settings->box_border_radius; ?>px;<?php } ?>
		<?php if( $settings->box_border_style ) { ?>border-style: <?php echo $settings->box_border_style; ?>;<?php } ?>
		<?php if( $settings->box_border_width ) { ?>border-width: <?php echo $settings->box_border_width; ?>px;<?php } ?>
		<?php if( $settings->layout_4_content_bg ) { ?>background: #<?php echo $settings->layout_4_content_bg; ?>;<?php } ?>
	}
	<?php if( $settings->show_arrow == 'yes' ) { ?>
		.fl-node-<?php echo $id; ?> .pp-testimonial.layout-3 .pp-arrow-left {
			<?php if( $settings->layout_4_content_bg ) { ?>border-right-color: #<?php echo $settings->layout_4_content_bg; ?><?php } ?>
		}
	<?php } ?>
<?php } ?>
<?php if( $settings->testimonial_layout == '4' ) { ?>
	.fl-node-<?php echo $id; ?> .pp-testimonial.layout-4 .layout-4-content {
		<?php if( $settings->box_border_color ) { ?>border-color: #<?php echo $settings->box_border_color; ?>;<?php } ?>
		<?php if( $settings->box_border_radius ) { ?>border-radius: <?php echo $settings->box_border_radius; ?>px;<?php } ?>
		<?php if( $settings->box_border_style ) { ?>border-style: <?php echo $settings->box_border_style; ?>;<?php } ?>
		<?php if( $settings->box_border_width ) { ?>border-width: <?php echo $settings->box_border_width; ?>px;<?php } ?>
		<?php if( $settings->layout_4_content_bg ) { ?>background: #<?php echo $settings->layout_4_content_bg; ?>;<?php } ?>
	}
<?php } ?>
<?php if( $settings->testimonial_layout == '5' ) { ?>
	.fl-node-<?php echo $id; ?> .pp-testimonial.layout-5 .pp-content-wrapper {
		<?php if( $settings->box_border_color ) { ?>border-color: #<?php echo $settings->box_border_color; ?>;<?php } ?>
		<?php if( $settings->box_border_radius ) { ?>border-radius: <?php echo $settings->box_border_radius; ?>px;<?php } ?>
		<?php if( $settings->box_border_style ) { ?>border-style: <?php echo $settings->box_border_style; ?>;<?php } ?>
		<?php if( $settings->box_border_width ) { ?>border-width: <?php echo $settings->box_border_width; ?>px;<?php } ?>
		<?php if( $settings->layout_4_content_bg ) { ?>background: #<?php echo $settings->layout_4_content_bg; ?>;<?php } ?>
	}
	<?php if( $settings->show_arrow == 'yes' ) { ?>
		.fl-node-<?php echo $id; ?> .pp-testimonial.layout-5 .pp-arrow-top {
			<?php if( $settings->layout_4_content_bg ) { ?>border-bottom-color: #<?php echo $settings->layout_4_content_bg; ?><?php } ?>
		}
	<?php } ?>
<?php } ?>


.fl-node-<?php echo $id; ?> .pp-testimonials-wrap .pp-testimonials-heading {
	<?php if( $settings->heading_color ) { ?>color: #<?php echo $settings->heading_color; ?>;<?php } ?>
	<?php if( $settings->heading_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->heading_font ); ?><?php } ?>
	<?php if( $settings->heading_font_size ) { ?>font-size: <?php echo $settings->heading_font_size; ?>px;<?php } ?>
	<?php if( $settings->heading_alignment ) { ?>text-align: <?php echo $settings->heading_alignment; ?>;<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-testimonial .pp-title-wrapper h3.pp-testimonials-title {
	<?php if( $settings->title_color ) { ?>color: #<?php echo $settings->title_color; ?>;<?php } ?>
	<?php if( $settings->title_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->title_font ); ?><?php } ?>
	<?php if( $settings->title_font_size ) { ?>font-size: <?php echo $settings->title_font_size; ?>px;<?php } ?>
	margin-top: <?php echo $settings->title_margin['top']; ?>px;
	margin-bottom: <?php echo $settings->title_margin['bottom']; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-testimonial .pp-title-wrapper h4.pp-testimonials-subtitle {
	<?php if( $settings->subtitle_color ) { ?>color: #<?php echo $settings->subtitle_color; ?>;<?php } ?>
	<?php if( $settings->subtitle_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->subtitle_font ); ?><?php } ?>
	<?php if( $settings->subtitle_font_size ) { ?>font-size: <?php echo $settings->subtitle_font_size; ?>px;<?php } ?>
	margin-top: <?php echo $settings->subtitle_margin['top']; ?>px;
	margin-bottom: <?php echo $settings->subtitle_margin['bottom']; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-testimonial .pp-testimonials-content {
	<?php if( $settings->text_color ) { ?>color: #<?php echo $settings->text_color; ?><?php } ?>;
	<?php if( $settings->text_font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->text_font ); ?><?php } ?>
	<?php if( $settings->text_font_size ) { ?>font-size: <?php echo $settings->text_font_size; ?>px;<?php } ?>
	margin-top: <?php echo $settings->content_margin['top']; ?>px;
	margin-bottom: <?php echo $settings->content_margin['bottom']; ?>px;
}
.fl-node-<?php echo $id; ?> .pp-testimonial .pp-testimonials-image img {
	<?php if( $settings->border_color ) { ?>border-color: #<?php echo $settings->border_color; ?>;<?php } ?>
	<?php if( $settings->border_width ) { ?>border-width: <?php echo $settings->border_width; ?>px;<?php } ?>
	<?php if( $settings->border_radius ) { ?>border-radius: <?php echo $settings->border_radius; ?>px;<?php } ?>
	<?php if( $settings->image_border_style ) { ?>border-style: <?php echo $settings->image_border_style; ?>;<?php } ?>
	max-height: <?php echo $settings->image_size; ?>px;
	max-width: <?php echo $settings->image_size; ?>px;
}
