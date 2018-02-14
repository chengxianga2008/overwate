<?php

// Old Background Gradient Setting
if ( isset( $settings->three_d ) && $settings->three_d ) {
	$settings->style = 'gradient';
}

?>
.fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button,
.fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:visited {
	text-decoration: none;
	<?php if( $settings->font['family'] != 'Default' ) { ?><?php FLBuilderFonts::font_css( $settings->font ); ?><?php } ?>
	line-height: <?php echo $settings->line_height['desktop']; ?>;
	padding-top: <?php echo ($settings->padding['top'] >= 0) ? $settings->padding['top'] . 'px ' : '5px'; ?>;
	padding-bottom: <?php echo ($settings->padding['bottom'] >= 0) ? $settings->padding['bottom'] . 'px ' : '5px'; ?>;
	padding-left: <?php echo ($settings->padding['left'] >= 0) ? $settings->padding['left'] . 'px ' : '10px'; ?>;
	padding-right: <?php echo ($settings->padding['right'] >= 0) ? $settings->padding['right'] . 'px ' : '10px'; ?>;
	-webkit-border-radius: <?php echo $settings->border_radius; ?>px;
	-moz-border-radius: <?php echo $settings->border_radius; ?>px;
	border-radius: <?php echo $settings->border_radius; ?>px;
	border: <?php echo $settings->border_size; ?>px #<?php echo $settings->border_color['primary']; ?>;
	border-style: <?php echo $settings->border_type; ?>;
	<?php if ( 'yes' == $settings->button_shadow ) { ?>
	-webkit-box-shadow: <?php echo $settings->box_shadow['vertical']; ?>px <?php echo $settings->box_shadow['horizontal']; ?>px <?php echo $settings->box_shadow['blur']; ?>px <?php echo $settings->box_shadow['spread']; ?>px <?php echo pp_hex2rgba('#'.$settings->box_shadow_color, $settings->box_shadow_opacity); ?>;
	-moz-box-shadow: <?php echo $settings->box_shadow['vertical']; ?>px <?php echo $settings->box_shadow['horizontal']; ?>px <?php echo $settings->box_shadow['blur']; ?>px <?php echo $settings->box_shadow['spread']; ?>px <?php echo pp_hex2rgba('#'.$settings->box_shadow_color, $settings->box_shadow_opacity); ?>;
	box-shadow: <?php echo $settings->box_shadow['vertical']; ?>px <?php echo $settings->box_shadow['horizontal']; ?>px <?php echo $settings->box_shadow['blur']; ?>px <?php echo $settings->box_shadow['spread']; ?>px <?php echo pp_hex2rgba('#'.$settings->box_shadow_color, $settings->box_shadow_opacity); ?>;
	<?php } ?>

	<?php if ( 'custom' == $settings->width ) : ?>
	width: <?php echo $settings->custom_width; ?>px;
	<?php endif; ?>

	<?php if ( ! empty( $settings->bg_color['primary'] ) ) : ?>
	background: #<?php echo $settings->bg_color['primary']; ?>;

		<?php if ( 'transparent' == $settings->style ) : // Transparent ?>
		background: transparent;
		<?php endif; ?>

		<?php if ( 'gradient' == $settings->style ) : // Gradient ?>
		background: -moz-linear-gradient(top,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%, #<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $settings->bg_color_gradient['primary']; ?>), color-stop(100%,#<?php echo $settings->bg_color_gradient['secondary']; ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $settings->bg_color_gradient['primary']; ?>', endColorstr='#<?php echo $settings->bg_color_gradient['secondary']; ?>',GradientType=0 ); /* IE6-9 */
		<?php endif; ?>

	<?php endif; ?>
}
.fl-node-<?php echo $id; ?> a.pp-button .pp-button-text {
	font-size: <?php echo $settings->font_size['desktop']; ?>px;
	letter-spacing: <?php echo $settings->letter_spacing; ?>px;
}

.fl-node-<?php echo $id; ?> .pp-button .pp-button-icon {
	font-size: <?php echo ($settings->icon_size >= 0) ? $settings->icon_size.'px' : '16px'; ?>;
}

<?php if ( ! empty( $settings->text_color['primary'] ) ) : ?>
.fl-node-<?php echo $id; ?> a.pp-button,
.fl-node-<?php echo $id; ?> a.pp-button:visited,
.fl-node-<?php echo $id; ?> a.pp-button *,
.fl-node-<?php echo $id; ?> a.pp-button:visited * {
	color: #<?php echo $settings->text_color['primary']; ?>;
	-webkit-transition: all .3s linear;
    -moz-transition: all .3s linear;
    -o-transition: all .3s linear;
    -ms-transition: all .3s linear;
    transition: all .3s linear;
}
<?php endif; ?>

.fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover,
.fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:focus {
	text-decoration: none;
	<?php if ( $settings->style == 'flat' ) { ?>
	background: <?php echo '' != $settings->bg_color['secondary'] ? '#' . $settings->bg_color['secondary'] : 'none'; ?>;
	<?php } ?>
	<?php if ( $settings->style == 'transparent' ) { ?>
	background: <?php echo !empty( $settings->bg_color_transparent ) ? '#' . $settings->bg_color_transparent : 'none'; ?>;
	<?php } ?>

	<?php if ( ! empty( $settings->border_color['secondary'] ) ) : ?>
	border-color: #<?php echo $settings->border_color['secondary']; ?>;
	<?php else : ?>
	border-color: transparent;
	<?php endif; ?>

	<?php if ( 'gradient' == $settings->style ) { // Gradient ?>
		<?php if( $settings->gradient_hover == 'reverse' ) { ?>
			background: -moz-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%, #<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left bottom, left bottom, color-stop(0%,#<?php echo $settings->bg_color_gradient['primary']; ?>), color-stop(100%,#<?php echo $settings->bg_color_gradient['secondary']; ?>)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* IE10+ */
			background: linear-gradient(to top,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $settings->bg_color_gradient['primary']; ?>', endColorstr='#<?php echo $settings->bg_color_gradient['secondary']; ?>',GradientType=0 ); /* IE6-9 */
		<?php } else if( $settings->gradient_hover == 'primary' ) { ?>
			background: -moz-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%, #<?php echo $settings->bg_color_gradient['primary']; ?> 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left bottom, left bottom, color-stop(0%,#<?php echo $settings->bg_color_gradient['primary']; ?>), color-stop(100%,#<?php echo $settings->bg_color_gradient['primary']; ?>)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['primary']; ?> 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['primary']; ?> 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['primary']; ?> 100%); /* IE10+ */
			background: linear-gradient(to top,  #<?php echo $settings->bg_color_gradient['primary']; ?> 0%,#<?php echo $settings->bg_color_gradient['primary']; ?> 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $settings->bg_color_gradient['primary']; ?>', endColorstr='#<?php echo $settings->bg_color_gradient['primary']; ?>',GradientType=0 ); /* IE6-9 */
		<?php } else if( $settings->gradient_hover == 'secondary' ) { ?>
			background: -moz-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['secondary']; ?> 0%, #<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left bottom, left bottom, color-stop(0%,#<?php echo $settings->bg_color_gradient['primary']; ?>), color-stop(100%,#<?php echo $settings->bg_color_gradient['secondary']; ?>)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['secondary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['secondary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(bottom,  #<?php echo $settings->bg_color_gradient['secondary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* IE10+ */
			background: linear-gradient(to top,  #<?php echo $settings->bg_color_gradient['secondary']; ?> 0%,#<?php echo $settings->bg_color_gradient['secondary']; ?> 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $settings->bg_color_gradient['secondary']; ?>', endColorstr='#<?php echo $settings->bg_color_gradient['secondary']; ?>',GradientType=0 ); /* IE6-9 */
		<?php } ?>
	<?php } ?>
}

<?php if ( ! empty( $settings->text_color['secondary'] ) ) : ?>
.fl-node-<?php echo $id; ?> a.pp-button:hover,
.fl-node-<?php echo $id; ?> a.pp-button:focus,
.fl-node-<?php echo $id; ?> a.pp-button:hover *,
.fl-node-<?php echo $id; ?> a.pp-button:focus * {
	color: #<?php echo $settings->text_color['secondary']; ?>;
}
<?php endif; ?>

<?php
$btn_effect = $settings->button_effect;
if( $settings->style == 'flat' ) {
	switch( $btn_effect ) {
	    case 'fade': ?>
	    .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	        transition: background-color, color;
	        <?php if($settings->button_effect_duration) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	    }
	    <?php
	    break;

	    case 'sweep_right': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleX(0);
	            -moz-transform: scaleX(0);
	            -o-transform: scaleX(0);
	            -ms-transform: scaleX(0);
	            transform: scaleX(0);
	            -webkit-transform-origin: 0 50%;
	            -moz-transform-origin: 0 50%;
	            -o-transform-origin: 0 50%;
	            -ms-transform-origin: 0 50%;
	            transform-origin: 0 50%;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleX(1);
	            -moz-transform: scaleX(1);
	            -o-transform: scaleX(1);
	            -ms-transform: scaleX(1);
	            transform: scaleX(1);
	        }
	    <?php
	    break;

	    case 'sweep_left': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleX(0);
	            -moz-transform: scaleX(0);
	            -o-transform: scaleX(0);
	            -ms-transform: scaleX(0);
	            transform: scaleX(0);
	            -webkit-transform-origin: 100% 50%;
	            -moz-transform-origin: 100% 50%;
	            -o-transform-origin: 100% 50%;
	            -ms-transform-origin: 100% 50%;
	            transform-origin: 100% 50%;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleX(1);
	            -moz-transform: scaleX(1);
	            -o-transform: scaleX(1);
	            -ms-transform: scaleX(1);
	            transform: scaleX(1);
	        }
	    <?php
	    break;

	    case 'sweep_bottom': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleY(0);
	            -moz-transform: scaleY(0);
	            -o-transform: scaleY(0);
	            -ms-transform: scaleY(0);
	            transform: scaleY(0);
	            -webkit-transform-origin: 50% 0;
	            -moz-transform-origin: 50% 0;
	            -o-transform-origin: 50% 0;
	            -ms-transform-origin: 50% 0;
	            transform-origin: 50% 0;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleY(1);
	            -moz-transform: scaleY(1);
	            -o-transform: scaleY(1);
	            -ms-transform: scaleY(1);
	            transform: scaleY(1);
	        }
	    <?php
	    break;

	    case 'sweep_top': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleY(0);
	            -moz-transform: scaleY(0);
	            -o-transform: scaleY(0);
	            -ms-transform: scaleY(0);
	            transform: scaleY(0);
	            -webkit-transform-origin: 50% 100%;
	            -moz-transform-origin: 50% 100%;
	            -o-transform-origin: 50% 100%;
	            -ms-transform-origin: 50% 100%;
	            transform-origin: 50% 100%;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleY(1);
	            -moz-transform: scaleY(1);
	            -o-transform: scaleY(1);
	            -ms-transform: scaleY(1);
	            transform: scaleY(1);
	        }
	    <?php
	    break;

	    case 'bounce_right': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleX(0);
	            -moz-transform: scaleX(0);
	            -o-transform: scaleX(0);
	            -ms-transform: scaleX(0);
	            transform: scaleX(0);
	            -webkit-transform-origin: 0 50%;
	            -moz-transform-origin: 0 50%;
	            -o-transform-origin: 0 50%;
	            -ms-transform-origin: 0 50%;
	            transform-origin: 0 50%;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleX(1);
	            -moz-transform: scaleX(1);
	            -o-transform: scaleX(1);
	            -ms-transform: scaleX(1);
	            transform: scaleX(1);
	            transition-timing-function: cubic-bezier(0.52, 1.64, 0.37, 0.66);
	        }
	    <?php
	    break;

	    case 'bounce_left': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleX(0);
	            -moz-transform: scaleX(0);
	            -o-transform: scaleX(0);
	            -ms-transform: scaleX(0);
	            transform: scaleX(0);
	            -webkit-transform-origin: 100% 50%;
	            -moz-transform-origin: 100% 50%;
	            -o-transform-origin: 100% 50%;
	            -ms-transform-origin: 100% 50%;
	            transform-origin: 100% 50%;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleX(1);
	            -moz-transform: scaleX(1);
	            -o-transform: scaleX(1);
	            -ms-transform: scaleX(1);
	            transform: scaleX(1);
	            transition-timing-function: cubic-bezier(0.52, 1.64, 0.37, 0.66);
	        }
	    <?php
	    break;

	    case 'bounce_bottom': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleY(0);
	            -moz-transform: scaleY(0);
	            -o-transform: scaleY(0);
	            -ms-transform: scaleY(0);
	            transform: scaleY(0);
	            -webkit-transform-origin: 50% 0;
	            -moz-transform-origin: 50% 0;
	            -o-transform-origin: 50% 0;
	            -ms-transform-origin: 50% 0;
	            transform-origin: 50% 0;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleY(1);
	            -moz-transform: scaleY(1);
	            -o-transform: scaleY(1);
	            -ms-transform: scaleY(1);
	            transform: scaleY(1);
	            transition-timing-function: cubic-bezier(0.52, 1.64, 0.37, 0.66);
	        }
	    <?php
	    break;

	    case 'bounce_top': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleY(0);
	            -moz-transform: scaleY(0);
	            -o-transform: scaleY(0);
	            -ms-transform: scaleY(0);
	            transform: scaleY(0);
	            -webkit-transform-origin: 50% 100%;
	            -moz-transform-origin: 50% 100%;
	            -o-transform-origin: 50% 100%;
	            -ms-transform-origin: 50% 100%;
	            transform-origin: 50% 100%;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleY(1);
	            -moz-transform: scaleY(1);
	            -o-transform: scaleY(1);
	            -ms-transform: scaleY(1);
	            transform: scaleY(1);
	            transition-timing-function: cubic-bezier(0.52, 1.64, 0.37, 0.66);
	        }
	    <?php
	    break;

	    case 'radial_out': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            overflow: hidden;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            border-radius: 100%;
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scale(0);
	            -moz-transform: scale(0);
	            -o-transform: scale(0);
	            -ms-transform: scale(0);
	            transform: scale(0);
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scale(2);
	            -moz-transform: scale(2);
	            -o-transform: scale(2);
	            -ms-transform: scale(2);
	            transform: scale(2);
	        }
	    <?php
	    break;

	    case 'radial_in': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            overflow: hidden;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            border-radius: 100%;
	            content: "";
	            <?php if( $settings->bg_color['primary']) { ?>background: #<?php echo $settings->bg_color['primary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scale(2);
	            -moz-transform: scale(2);
	            -o-transform: scale(2);
	            -ms-transform: scale(2);
	            transform: scale(2);
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scale(0);
	            -moz-transform: scale(0);
	            -o-transform: scale(0);
	            -ms-transform: scale(0);
	            transform: scale(0);
	        }
	    <?php
	    break;

	    case 'rectangle_out': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            overflow: hidden;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scale(0);
	            -moz-transform: scale(0);
	            -o-transform: scale(0);
	            -ms-transform: scale(0);
	            transform: scale(0);
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scale(1);
	            -moz-transform: scale(1);
	            -o-transform: scale(1);
	            -ms-transform: scale(1);
	            transform: scale(1);
	        }
	    <?php
	    break;

	    case 'rectangle_in': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            overflow: hidden;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['primary']) { ?>background: #<?php echo $settings->bg_color['primary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scale(1);
	            -moz-transform: scale(1);
	            -o-transform: scale(1);
	            -ms-transform: scale(1);
	            transform: scale(1);
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scale(0);
	            -moz-transform: scale(0);
	            -o-transform: scale(0);
	            -ms-transform: scale(0);
	            transform: scale(0);
	        }
	    <?php
	    break;

	    case 'shutter_in_horizontal': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            overflow: hidden;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['primary']) { ?>background: #<?php echo $settings->bg_color['primary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleX(1);
	            -moz-transform: scaleX(1);
	            -o-transform: scaleX(1);
	            -ms-transform: scaleX(1);
	            transform: scaleX(1);
	            -webkit-transform-origin: 50%;
	            -moz-transform-origin: 50%;
	            -o-transform-origin: 50%;
	            -ms-transform-origin: 50%;
	            transform-origin: 50%;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleX(0);
	            -moz-transform: scaleX(0);
	            -o-transform: scaleX(0);
	            -ms-transform: scaleX(0);
	            transform: scaleX(0);
	        }
	    <?php
	    break;

	    case 'shutter_out_horizontal': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            overflow: hidden;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleX(0);
	            -moz-transform: scaleX(0);
	            -o-transform: scaleX(0);
	            -ms-transform: scaleX(0);
	            transform: scaleX(0);
	            -webkit-transform-origin: 50%;
	            -moz-transform-origin: 50%;
	            -o-transform-origin: 50%;
	            -ms-transform-origin: 50%;
	            transform-origin: 50%;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleX(1);
	            -moz-transform: scaleX(1);
	            -o-transform: scaleX(1);
	            -ms-transform: scaleX(1);
	            transform: scaleX(1);
	        }
	    <?php
	    break;

	    case 'shutter_in_vertical': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            overflow: hidden;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['primary']) { ?>background: #<?php echo $settings->bg_color['primary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleY(1);
	            -moz-transform: scaleY(1);
	            -o-transform: scaleY(1);
	            -ms-transform: scaleY(1);
	            transform: scaleY(1);
	            -webkit-transform-origin: 50%;
	            -moz-transform-origin: 50%;
	            -o-transform-origin: 50%;
	            -ms-transform-origin: 50%;
	            transform-origin: 50%;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleY(0);
	            -moz-transform: scaleY(0);
	            -o-transform: scaleY(0);
	            -ms-transform: scaleY(0);
	            transform: scaleY(0);
	        }
	    <?php
	    break;

	    case 'shutter_out_vertical': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            overflow: hidden;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:before {
	            content: "";
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: scaleY(0);
	            -moz-transform: scaleY(0);
	            -o-transform: scaleY(0);
	            -ms-transform: scaleY(0);
	            transform: scaleY(0);
	            -webkit-transform-origin: 50%;
	            -moz-transform-origin: 50%;
	            -o-transform-origin: 50%;
	            -ms-transform-origin: 50%;
	            transform-origin: 50%;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:before {
	            -webkit-transform: scaleY(1);
	            -moz-transform: scaleY(1);
	            -o-transform: scaleY(1);
	            -ms-transform: scaleY(1);
	            transform: scaleY(1);
	        }
	    <?php
	    break;

	    case 'shutter_out_diagonal': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            overflow: hidden;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:after {
	            content: "";
	            position: absolute;
	            left: 50%;
	            top: 50%;
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: translateX(-50%) translateY(-50%) rotate(45deg) translateZ(0);
	            -moz-transform: translateX(-50%) translateY(-50%) rotate(45deg) translateZ(0);
	            -o-transform: translateX(-50%) translateY(-50%) rotate(45deg) translateZ(0);
	            -ms-transform: translateX(-50%) translateY(-50%) rotate(45deg) translateZ(0);
	            transform: translateX(-50%) translateY(-50%) rotate(45deg) translateZ(0);
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	            height: 0;
	            width: 0;
	            z-index: -1;
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:after {
	            height: 4000%;
	            width: 100%;
	        }
	    <?php
	    break;

	    case 'shutter_in_diagonal': ?>
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button {
	            <?php if( $settings->bg_color['secondary']) { ?>background: #<?php echo $settings->bg_color['secondary']; ?>;<?php } ?>
	            overflow: hidden;
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:after {
	            content: "";
	            position: absolute;
	            left: 50%;
	            top: 50%;
	            <?php if( $settings->bg_color['primary']) { ?>background: #<?php echo $settings->bg_color['primary']; ?>;<?php } ?>
	            <?php if( $settings->text_color['secondary']) { ?>color:#<?php echo $settings->text_color['secondary']; ?>;<?php } ?>
	            <?php if( $settings->border_color['secondary']) { ?>border-color:#<?php echo $settings->border_color['secondary']; ?>;<?php } ?>
	            -webkit-transform: translateX(-50%) translateY(-50%) rotate(45deg) translateZ(0);
	            -moz-transform: translateX(-50%) translateY(-50%) rotate(45deg) translateZ(0);
	            -o-transform: translateX(-50%) translateY(-50%) rotate(45deg) translateZ(0);
	            -ms-transform: translateX(-50%) translateY(-50%) rotate(45deg) translateZ(0);
	            transform: translateX(-50%) translateY(-50%) rotate(45deg) translateZ(0);
	            <?php if($settings->button_effect_duration >= 0) { ?>transition-duration: <?php echo $settings->button_effect_duration; ?>ms;<?php } ?>
	            height: 4000%;
	            width: 100%;
	            z-index: -1;
	        }
	        .fl-node-<?php echo $id; ?> .pp-button-wrap a.pp-button:hover:after {
	            height: 4000%;
	            width: 0;
	        }
	    <?php
	    break;
	}
}
?>

<?php if ( $settings->responsive_bp >= 768 ) { ?>
@media only screen and ( max-width: <?php echo $settings->responsive_bp; ?>px ) {
	.fl-node-<?php echo $id; ?> .pp-button-wrap.pp-button-left {
		text-align: center;
	}
}
<?php } ?>
<?php if ( isset( $settings->line_height['tablet'] ) && '' != $settings->line_height['tablet'] ) { ?>
@media only screen and ( max-width: 768px ) {
	.fl-node-<?php echo $id; ?> a.pp-button,
	.fl-node-<?php echo $id; ?> a.pp-button:visited {
		line-height: <?php echo $settings->line_height['tablet']; ?>;
	}
	.fl-node-<?php echo $id; ?> a.pp-button .pp-button-text {
		font-size: <?php echo $settings->font_size['tablet']; ?>px;
	}
}
<?php } ?>

@media only screen and (max-width: <?php echo $settings->responsive_bp; ?>px) {
	.fl-node-<?php echo $id; ?> .pp-button-wrap {
		text-align: <?php echo $settings->responsive_align; ?> !important;
	}
}

<?php if ( isset( $settings->line_height['mobile'] ) && '' != $settings->line_height['mobile'] ) { ?>
@media only screen and ( max-width: 480px ) {
	.fl-node-<?php echo $id; ?> a.pp-button,
	.fl-node-<?php echo $id; ?> a.pp-button:visited {
		line-height: <?php echo $settings->line_height['mobile']; ?>;
	}
	.fl-node-<?php echo $id; ?> a.pp-button .pp-button-text {
		font-size: <?php echo $settings->font_size['mobile']; ?>px;
	}
}
<?php } ?>
