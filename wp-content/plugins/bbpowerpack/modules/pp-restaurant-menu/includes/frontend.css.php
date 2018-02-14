<?php
    $number_show = $settings->large_device_columns;
    $width = '100';
    if( $number_show == 5 ) {
     	$width = '18.4';
    } elseif( $number_show == 4 ) {
     	$width = '23.5';
    } elseif( $number_show == 3 ) {
     	$width = '32';
    } elseif( $number_show == 2 ) {
     	$width = '48';
    }
?>

.fl-node-<?php echo $id; ?> .pp-menu-item {
	border-color: #<?php echo $settings->card_border_color; ?>;
	border-style: <?php echo $settings->card_border; ?>;
	border-top-width: <?php echo is_numeric($settings->card_border_width['top']) ? $settings->card_border_width['top'] : '0'; ?>px;
	border-bottom-width: <?php echo is_numeric($settings->card_border_width['bottom']) ? $settings->card_border_width['bottom'] : '0'; ?>px;
	border-left-width: <?php echo is_numeric($settings->card_border_width['left']) ? $settings->card_border_width['left'] : '0'; ?>px;
	border-right-width: <?php echo is_numeric($settings->card_border_width['right']) ? $settings->card_border_width['right'] : '0'; ?>px;
    margin-left: 2%;
    width: <?php echo $width; ?>%;
	float: left;
    <?php if ( $settings->card_bg_type == 'color' ) { ?>
        background-color: #<?php echo $settings->card_bg; ?>;
        padding-left: 10px;
        padding-right: 10px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-menu-item:nth-child(<?php echo (int) $number_show; ?>n+1) {
	margin-left: 0% !important;
	clear: left;
}

.fl-node-<?php echo $id; ?> .pp-restaurant-menu-heading {
    border-color: #<?php echo $settings->heading_border_color; ?>;
	border-style: <?php echo $settings->heading_border; ?>;
	border-top-width: <?php echo is_numeric($settings->heading_border_width['top']) ? $settings->heading_border_width['top'] : '0'; ?>px;
	border-bottom-width: <?php echo is_numeric($settings->heading_border_width['bottom']) ? $settings->heading_border_width['bottom'] : '0'; ?>px;
	border-left-width: <?php echo is_numeric($settings->heading_border_width['left']) ? $settings->heading_border_width['left'] : '0'; ?>px;
	border-right-width: <?php echo is_numeric($settings->heading_border_width['right']) ? $settings->heading_border_width['right'] : '0'; ?>px;
    <?php if ( $settings->heading_bg_type == 'color' ) { ?>
        background-color: #<?php echo $settings->heading_bg; ?>;
    <?php } ?>
    margin-top: <?php echo is_numeric($settings->heading_margin['top']) ? $settings->heading_margin['top'] : '0'; ?>px;
    margin-right: 0;
    margin-bottom: <?php echo is_numeric($settings->heading_margin['bottom']) ? $settings->heading_margin['bottom'] : '0'; ?>px;
    margin-left: 0;
    padding-top: <?php echo is_numeric($settings->heading_padding['top']) ? $settings->heading_padding['top'] : '0'; ?>px;
    padding-right: <?php echo $settings->heading_bg_type == 'color' ? 10 : 0; ?>px;
    padding-bottom: <?php echo is_numeric($settings->heading_padding['bottom']) ? $settings->heading_padding['bottom'] : '0'; ?>px;
    padding-left: <?php echo $settings->heading_bg_type == 'color' ? 10 : 0; ?>px;
}

 <?php
	 if ( $settings->card_border == 'none' ) {
	 	?>
		 	.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-wrap-in .pp-restaurant-menu-item-inline h2{
				padding-top: 0px !important;
			}
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline .pp-restaurant-menu-item-price{
				padding: 0px;
			}
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item .pp-restaurant-menu-item-left{
				padding-left: 0px;
			}
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item .pp-restaurant-menu-item-right{
				padding-right: 0px;
			}
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline-right-content{
 				padding-left: 0px;
 			}

		<?php
	 }
?>

<?php
    if ( $settings->card_bg_type == 'color' ) {
       ?>
            .fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline .pp-restaurant-menu-item-price {
               padding-right: 0;
            }
       <?php
    }
?>

<?php
	 if ( $settings->card_border_width['right'] > 0 ) {
	 	?>
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline {
				padding-bottom: 0px;
			}
		}
		<?php
	 }
 ?>

.fl-node-<?php echo $id; ?> .pp-restaurant-menu-heading {
	color: #<?php echo $settings->menu_heading_color; ?>;
    <?php if( !empty($settings->menu_heading_font) && $settings->menu_heading_font['family'] != 'Default' ) : ?>
        <?php FLBuilderFonts::font_css( $settings->menu_heading_font ); ?>
    <?php endif; ?>
	font-size: <?php echo $settings->menu_heading_size; ?>px;
    text-align: <?php echo $settings->menu_heading_align; ?>;
}

.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-title {
	color: #<?php echo $settings->menu_title_color; ?>;
    <?php if( !empty($settings->items_title_font) && $settings->items_title_font['family'] != 'Default' ) : ?>
        <?php FLBuilderFonts::font_css( $settings->items_title_font ); ?>
    <?php endif; ?>
	font-size: <?php echo $settings->item_title_size; ?>px;
    font-style: <?php echo $settings->items_title_font_style; ?>;
    <?php if ( $settings->restaurant_menu_layout == 'stacked' ) { ?>
    padding-top: 10px;
    display: inline-block;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-wrap-in h2 {
	font-size: <?php echo $settings->item_title_size; ?>px;
    <?php if ( $settings->show_description == 'no' ) { ?>
        margin-bottom: 0 !important;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-description {
    color: #<?php echo $settings->menu_description_color; ?>;
    <?php if( !empty($settings->items_description_font) && $settings->items_description_font['family'] != 'Default' ) : ?>
    	<?php FLBuilderFonts::font_css( $settings->items_description_font ); ?>
    <?php endif; ?>
 	font-size: <?php echo $settings->item_description_size; ?>px;
	font-style: <?php echo $settings->items_description_font_style; ?>;
}

.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-price {
	color: #<?php echo $settings->menu_price_color; ?>;
    <?php if( !empty($settings->items_price_font) && $settings->items_price_font['family'] != 'Default' ) : ?>
    	<?php FLBuilderFonts::font_css( $settings->items_price_font ); ?>
    <?php endif; ?>
	font-size: <?php echo $settings->item_color_size; ?>px;
    font-style : <?php echo $settings->items_price_font_style; ?>;
    <?php if ( $settings->show_price == 'no' ) { ?>
    display: none !important;
    <?php } ?>
    <?php if ( $settings->restaurant_menu_layout == 'stacked' ) { ?>
        padding-top: 10px;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline .pp-restaurant-menu-item-images {
	width: <?php echo $settings->inline_image_width; ?>%;
}

.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline .pp-restaurant-menu-item-inline-right-content {
	width: <?php echo 80 - ($settings->inline_image_width); ?>%;
}

 <?php
	 if ( $settings->large_device_columns == '2' ) {
	 	?>
			.fl-node-<?php echo $id; ?> .pp-menu-item {
					margin-left: 4% !important;
			}
		<?php
	 }
 ?>

 <?php
	 if ( ($settings->card_border_width['bottom'] > '0') && ($settings->card_border_width['top'] == 0) && ($settings->card_border_width['right'] == 0) && ($settings->card_border_width['left'] == 0) ) {
	 	?>
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item .pp-restaurant-menu-item-left {
				padding-left: 0px !important;
			}
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item .pp-restaurant-menu-item-right {
				padding-right: 0px !important;
			}
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline-right-content {
				padding-left: 0px !important;
			}
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline .pp-restaurant-menu-item-images {
				margin-bottom : 10px;
			}
		<?php
	}
?>

<?php
foreach ( $settings->menu_items as $key => $menu_item ) {
	if ( $menu_item->restaurant_select_images == 'none' ){
	 	?>
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline-<?php echo $key; ?> .pp-restaurant-menu-item-inline-right-content {
 				width: 80% !important;
 				padding-bottom: 20px;
 			}
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline-<?php echo $key; ?> .pp-restaurant-menu-item-wrap-in pp-restaurant-menu-item-inline h2 {
				padding-top: 0px !important;
			}
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline-<?php echo $key; ?> .pp-restaurant-menu-item-inline .pp-restaurant-menu-item-images {
				display : none;
			}
			.fl-node-<?php echo $id; ?> .pp-restaurant-menu-item-inline-<?php echo $key; ?> .pp-restaurant-menu-item .pp-restaurant-menu-item-images {
				display : none;
			}
		<?php
    } elseif ( $settings->text_alignment == 'center' ) { ?>
        .fl-node-<?php echo $id; ?> .pp-menu-item-<?php echo $key; ?> .pp-restaurant-menu-item-title {
            display: inline-block;
        }
    <?php }
	?>
<?php } ?>

<?php if ( $settings->text_alignment == 'center' && $settings->restaurant_menu_layout != 'inline' ) { ?>
    .fl-node-<?php echo $id; ?> .pp-menu-item {
        <?php if ( $settings->card_bg_type == 'color' ) { ?>
            padding-bottom: 10px;
            padding-top: 10px;
        <?php } else { ?>
            margin-bottom: 0;
        <?php } ?>
    }
    .fl-node-<?php echo $id; ?> .pp-menu-item .pp-restaurant-menu-item-images {
        width: 100% !important;
        padding: 0 !important;
    }
    .fl-node-<?php echo $id; ?> .pp-menu-item .pp-menu-item-content,
    .fl-node-<?php echo $id; ?> .pp-menu-item .pp-restaurant-menu-item-left {
        width: 100% !important;
        padding-bottom: 0;
        text-align: center !important;
    }
    .fl-node-<?php echo $id; ?> .pp-menu-item .pp-restaurant-menu-item-price,
    .fl-node-<?php echo $id; ?> .pp-menu-item .pp-restaurant-menu-item-right {
        width: 100% !important;
        padding-top: 5px;
        text-align: center !important;
    }
    .fl-node-<?php echo $id; ?> .pp-menu-item .pp-restaurant-menu-item-price {
        padding-top: 0;
        padding-bottom: 0;
    }
    .fl-node-<?php echo $id; ?> .pp-menu-item .pp-menu-item-unit {
        display: inline;
    }
<?php } ?>

@media (max-width: <?php echo $global_settings->medium_breakpoint; ?>px){
	<?php
		$number_column_medium_device = $settings->medium_device_columns;
		$width_medium = '100';
		if( $number_column_medium_device == 5 ) {
			$width_medium = '18.4';
		}elseif( $number_column_medium_device == 4 ) {
			$width_medium = '23.5';
		}elseif( $number_column_medium_device == 3 ) {
			$width_medium = '32';
		}elseif( $number_column_medium_device == 2 ) {
			$width_medium = '48';
		}

	?>
	.fl-node-<?php echo $id; ?> .pp-menu-item:nth-child(n+1) {
		width: <?php echo $width_medium; ?>%;
		margin-left: 2% !important;
		clear: none !important;
	}
	.fl-node-<?php echo $id; ?> .pp-menu-item:nth-child(<?php echo (int) $number_column_medium_device; ?>n+1) {
		margin-left: 0% !important;
		clear: left !important;
	}
}
@media (max-width: <?php echo $global_settings->responsive_breakpoint; ?>px){
	<?php
		$number_column_small_device = $settings->small_device_columns;
		$width_small = '100';
		if( $number_column_small_device == 3 ) {
			$width_small = '32';
		}elseif( $number_column_small_device == 2 ) {
			$width_small = '48';
		}

	?>
	.fl-node-<?php echo $id; ?> .pp-menu-item:nth-child(n+1) {
		width: <?php echo $width_small; ?>%;
		margin-left: 2% !important;
		clear: none !important;
	}
	.fl-node-<?php echo $id; ?> .pp-menu-item:nth-child(<?php echo (int) $number_column_small_device; ?>n+1) {
		margin-left: 0% !important;
		clear: left !important;
	}
	.fl-node-<?php echo $id; ?> .pp-menu-item{
		margin-bottom: 20px;
	}
}
