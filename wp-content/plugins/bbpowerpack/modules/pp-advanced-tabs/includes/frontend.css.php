/*  Labels
------------------------------------ */

.fl-node-<?php echo $id; ?> .pp-tabs-default .pp-tabs-label.pp-tab-active {
	border-color: #<?php echo $settings->border_color; ?>;
}

/*  Panels
------------------------------------ */

.fl-node-<?php echo $id; ?> .pp-tabs-default .pp-tabs-panels,
.fl-node-<?php echo $id; ?> .pp-tabs-default .pp-tabs-panel {
	border-color: #<?php echo $settings->border_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-label .pp-tab-icon {
	width: <?php echo $settings->tab_icon_size; ?>px;
	font-size: <?php echo $settings->tab_icon_size; ?>px;
	<?php if( $settings->tab_icon_position == 'left' ) { ?>
		margin-right: 15px;
	<?php } ?>
	<?php if( $settings->tab_icon_position == 'right' ) { ?>
		margin-left: 15px;
	<?php } ?>
	<?php if( $settings->tab_icon_position == 'top' ) { ?>
		margin-bottom: 10px;
	<?php } ?>
	<?php if( $settings->tab_icon_position == 'bottom' ) { ?>
		margin-top: 10px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-tabs-label .pp-tab-icon:before {
	font-size: <?php echo $settings->tab_icon_size; ?>px;
}

.fl-node-<?php echo $id; ?> .pp-tabs .pp-tab-title {
	<?php if( $settings->tab_label_font['family'] != 'Default' ) { ?>
		<?php FLBuilderFonts::font_css( $settings->tab_label_font ); ?>
	<?php } ?>
	<?php if( $settings->tab_label_font_size['desktop'] && $settings->tab_title_size == 'custom' ) { ?>
	font-size: <?php echo $settings->tab_label_font_size['desktop']; ?>px;
	<?php } ?>
	line-height: <?php echo $settings->tab_label_line_height['desktop']; ?>;
	text-transform: <?php echo $settings->label_text_transform; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-panels .pp-tabs-panel-content {
	<?php if( $settings->tab_content_font['family'] != 'Default' ) { ?>
		<?php FLBuilderFonts::font_css( $settings->tab_content_font ); ?>
	<?php } ?>
	<?php if( $settings->tab_content_font_size['desktop'] && $settings->tab_content_size == 'custom' ) { ?>
	font-size: <?php echo $settings->tab_content_font_size['desktop']; ?>px;
	<?php } ?>
	line-height: <?php echo $settings->tab_content_line_height['desktop']; ?>;
	background-color: #<?php echo $settings->content_bg_color; ?>;
	color: #<?php echo $settings->content_text_color; ?>;
	text-align: <?php echo $settings->content_alignment; ?>
}

.fl-node-<?php echo $id; ?> .pp-tabs .pp-tabs-label {
	background-color: #<?php echo $settings->label_background_color; ?>;
	color: #<?php echo $settings->label_text_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs .pp-tabs-label.pp-tab-active,
.fl-node-<?php echo $id; ?> .pp-tabs .pp-tabs-label.pp-tab-active:hover {
	background-color: #<?php echo $settings->label_background_active_color; ?>;
	color: #<?php echo $settings->label_active_text_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs .pp-tabs-label:hover {
	color: #<?php echo $settings->label_active_text_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-panel-label .pp-toggle-icon {
	<?php if( $settings->tab_toggle_icon_size >= 0 ) { ?>
	font-size: <?php echo $settings->tab_toggle_icon_size; ?>px;
	<?php } ?>
	color: #<?php echo $settings->tab_toggle_icon_color; ?>;
}

/*  Style 1
------------------------------------ */

.fl-node-<?php echo $id; ?> .pp-tabs-style-1 .pp-tabs-labels {
	background-color: #<?php echo $settings->border_color; ?>;
	border-color: #<?php echo $settings->border_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-1 .pp-tabs-label:hover {
	color: #<?php echo $settings->label_active_text_color; ?>;
}

/*  Style 2
------------------------------------ */

.fl-node-<?php echo $id; ?> .pp-tabs-style-2 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after {
	border-top-color: #<?php echo $settings->label_background_active_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-2 .pp-tabs-label:first-child:before,
.fl-node-<?php echo $id; ?> .pp-tabs-style-2 .pp-tabs-label::after {
	background: <?php echo pp_hex2rgba('#'.$settings->border_color, '0.7'); ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-2 .pp-tabs-label:hover {
	color: #<?php echo $settings->label_active_text_color; ?>;
}

/*  Style 3
------------------------------------ */

.fl-node-<?php echo $id; ?> .pp-tabs-style-3 .pp-tabs-label:after {
	background-color: #<?php echo $settings->label_active_text_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-3 .pp-tabs-label:hover {
	color: #<?php echo $settings->label_active_text_color; ?>;
}


/*  Style 4
------------------------------------ */

.fl-node-<?php echo $id; ?> .pp-tabs-style-4 .pp-tabs-label:before {
	background-color: #<?php echo $settings->label_active_text_color; ?>;
}

/*  Style 5
------------------------------------ */
.fl-node-<?php echo $id; ?> .pp-tabs-style-5 .pp-tabs-label .pp-tab-label-inner:after {
	background-color: #<?php echo $settings->label_background_active_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-5 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after {
	background-color: #<?php echo $settings->label_background_active_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-5 .pp-tabs-label:hover {
	color: #<?php echo $settings->label_active_text_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-5 .pp-tabs-panels .pp-tabs-panel-content {
	background-color: #<?php echo $settings->label_background_active_color; ?>;
}

/*  Style 6
------------------------------------ */

<?php $percent = ( count($settings->items) - 1 ) * 100; ?>
<?php for( $i = 1; $i <= count($settings->items); $i++ ) { ?>
	<?php if ( $i == count($settings->items) ) { break; } ?>
	<?php if( $i == 1) { ?>
		.fl-node-<?php echo $id; ?> .pp-tabs-style-6 .pp-tabs-label:first-child.pp-tab-active ~ .pp-tabs-label:last-child::before {
			-webkit-transform: translate3d(-<?php echo $percent; ?>%,0,0);
			transform: translate3d(-<?php echo $percent; ?>%,0,0);
		}
	<?php } ?>
	<?php if( $i > 1) {
		$percent = $percent - 100; ?>
		.fl-node-<?php echo $id; ?> .pp-tabs-style-6 .pp-tabs-label:nth-child(<?php echo $i; ?>).pp-tab-active ~ .pp-tabs-label:last-child::before {
			-webkit-transform: translate3d(-<?php echo $percent; ?>%,0,0);
			transform: translate3d(-<?php echo $percent; ?>%,0,0);
		}
	<?php } ?>
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-tabs-style-6 .pp-tabs-label,
.fl-node-<?php echo $id; ?> .pp-tabs-style-6 .pp-tabs-label.pp-tab-active,
.fl-node-<?php echo $id; ?> .pp-tabs-style-6 .pp-tabs-label.pp-tab-active:hover,
.fl-node-<?php echo $id; ?> .pp-tabs .pp-tabs-style-6 .pp-tabs-label:hover {
	background-color: transparent;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-6 .pp-tabs-label:last-child:before {
	background-color: #<?php echo $settings->label_active_text_color; ?>;
}


/*  Style 7
------------------------------------ */

.fl-node-<?php echo $id; ?> .pp-tabs-style-7 .pp-tabs-label .pp-tab-label-inner {
	border-bottom-color: #<?php echo $settings->border_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-7 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after,
.fl-node-<?php echo $id; ?> .pp-tabs-style-7 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:before {
	border-top-color: #<?php echo $settings->border_color; ?>;
}

/*  Style 8
------------------------------------ */

.fl-node-<?php echo $id; ?> .pp-tabs-style-8 .pp-tabs-label .pp-tab-label-inner:after {
	background-color: #<?php echo $settings->border_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-8 .pp-tabs-label:hover .pp-tab-label-inner:after {
	background-color: #<?php echo $settings->label_background_active_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-8 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after {
	background-color: #<?php echo $settings->label_background_active_color; ?>;
}

.fl-node-<?php echo $id; ?> .pp-tabs-style-8 .pp-tabs-label:hover {
	color: #<?php echo $settings->label_active_text_color; ?>;
}

@media only screen and (min-width: 769px) {
	.fl-node-<?php echo $id; ?> .pp-tabs-vertical.pp-tabs-style-2 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after {
		border-left-color: #<?php echo $settings->label_background_active_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .pp-tabs-vertical.pp-tabs-style-6 .pp-tabs-label {
		border-bottom: 4px solid transparent;
	}

	.fl-node-<?php echo $id; ?> .pp-tabs-vertical.pp-tabs-style-6 .pp-tabs-label.pp-tab-active {
		border-bottom: 4px solid #<?php echo $settings->label_active_text_color; ?>;
	}

	.fl-node-<?php echo $id; ?> .pp-tabs-vertical.pp-tabs-style-7 .pp-tabs-label .pp-tab-label-inner {
		border-right-color: #<?php echo $settings->border_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .pp-tabs-vertical.pp-tabs-style-7 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:before,
	.fl-node-<?php echo $id; ?> .pp-tabs-vertical.pp-tabs-style-7 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after {
		border-left-color: #<?php echo $settings->border_color; ?>;
	}
}


@media only screen and (max-width: 768px) {
	.fl-node-<?php echo $id; ?> .pp-tabs-labels .pp-tabs-label .pp-tab-title {
		<?php if( $settings->tab_label_font_size['tablet'] && $settings->tab_title_size == 'custom' ) { ?>
		font-size: <?php echo $settings->tab_label_font_size['tablet']; ?>px;
		<?php } ?>
		line-height: <?php echo $settings->tab_label_line_height['tablet']; ?>;
	}
	.fl-node-<?php echo $id; ?> .pp-tabs-panels .pp-tabs-panel-content {
		<?php if( $settings->tab_content_font_size['tablet'] && $settings->tab_content_size == 'custom' ) { ?>
		font-size: <?php echo $settings->tab_content_font_size['tablet']; ?>px;
		<?php } ?>
		line-height: <?php echo $settings->tab_content_line_height['tablet']; ?>;
	}
	.fl-node-<?php echo $id; ?> .pp-tabs-style-1 .pp-tabs-label {
		border: 4px solid #<?php echo $settings->border_color; ?>;
		margin: 2px 0;
	}
	.fl-node-<?php echo $id; ?> .pp-tabs-style-5 .pp-tabs-label.pp-tab-active {
		background-color: #<?php echo $settings->label_background_active_color; ?> !important;
	}
	.fl-node-<?php echo $id; ?> .pp-tabs-style-8 .pp-tabs-label.pp-tab-active {
		background-color: #<?php echo $settings->label_background_active_color; ?> !important;
	}
}

@media only screen and (max-width: 480px) {
	.fl-node-<?php echo $id; ?> .pp-tabs-labels .pp-tabs-label .pp-tab-title {
		<?php if( $settings->tab_label_font_size['mobile'] && $settings->tab_title_size == 'custom' ) { ?>
		font-size: <?php echo $settings->tab_label_font_size['mobile']; ?>px;
		<?php } ?>
		line-height: <?php echo $settings->tab_label_line_height['mobile']; ?>;
	}
	.fl-node-<?php echo $id; ?> .pp-tabs-panels .pp-tabs-panel-content {
		<?php if( $settings->tab_content_font_size['mobile'] && $settings->tab_content_size == 'custom' ) { ?>
		font-size: <?php echo $settings->tab_content_font_size['mobile']; ?>px;
		<?php } ?>
		line-height: <?php echo $settings->tab_content_line_height['mobile']; ?>;
	}
}
