
<div class="fl-node-<?php echo $id; ?> pp-restaurant-menu-item-wrap">
	<h3 class="pp-restaurant-menu-heading"><?php echo $settings->menu_heading; ?></h3>
	<div class="pp-restaurant-menu-item-wrap-in">
		<?php
		foreach ( $settings->menu_items as $key => $menu_item ) {

			 if ( $settings->restaurant_menu_layout == 'stacked' ) {
			 	?>
			 	<div class="pp-restaurant-menu-item pp-restaurant-menu-item-<?php echo $key; ?> pp-menu-item pp-menu-item-<?php echo $key; ?>">
				 	<?php if ( '' != trim( $menu_item->menu_item_images ) && 'yes' == $menu_item->restaurant_select_images ) { ?>
					 	<a <?php if ( '' != $menu_item->menu_items_link ) { ?>href="<?php echo $menu_item->menu_items_link;?>"<?php } ?> target="<?php echo $menu_item->menu_items_link_target;?>" class="pp-restaurant-menu-item-images">
							<?php
							$image = $menu_item->menu_item_images_src;
							?>
			   	 			<img src="<?php echo $image;?>" />
						</a>
					<?php } ?>
					<div class="pp-restaurant-menu-item-left">
						<?php if ( '' != trim( $menu_item->menu_items_title ) ) { ?>
							<h2>
								<?php if ( '' != trim($menu_item->menu_items_link) ) { ?>
									<a href="<?php echo $menu_item->menu_items_link;?>" target="<?php echo $menu_item->menu_items_link_target;?>" class="pp-restaurant-menu-item-title"><?php echo $menu_item->menu_items_title; ?></a>
								<?php } else { ?>
									<span class="pp-restaurant-menu-item-title"><?php echo $menu_item->menu_items_title; ?></span>
								<?php } ?>
							</h2>
						<?php } ?>
						<?php if ( $settings->show_description == 'yes' ) { ?>
							<div class="pp-restaurant-menu-item-description">
								<?php echo $menu_item->menu_item_description; ?>
							</div>
						<?php } ?>
					</div>
					<div class="pp-restaurant-menu-item-right">
						<?php if ( '' != trim( $menu_item->menu_items_price ) && $settings->show_price == 'yes' ) { ?>
							<div class="pp-restaurant-menu-item-price">
								<span><?php echo $settings->currency_symbol; ?> </span> <?php echo $menu_item->menu_items_price; ?>
								<?php if ( '' != trim( $menu_item->menu_items_unit ) ) { ?>
									<span class="pp-menu-item-unit"> <?php echo trim( $menu_item->menu_items_unit ); ?></span>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
				<?php
			 } else {
			 	?>
			 		<div class="pp-restaurant-menu-item-inline pp-restaurant-menu-item-inline-<?php echo $key; ?> pp-menu-item pp-menu-item-<?php echo $key; ?>">
				 		<?php if ( '' != trim( $menu_item->menu_item_images ) && 'yes' == $menu_item->restaurant_select_images ) { ?>
				 			<a <?php if ( '' != $menu_item->menu_items_link ) { ?>href="<?php echo $menu_item->menu_items_link;?>"<?php } ?> target="<?php echo $menu_item->menu_items_link_target;?>" class="pp-restaurant-menu-item-images">
							<?php
							$image = $menu_item->menu_item_images_src;
							?>
			   	 			<img src="<?php echo $image;?>" />
			   	 			</a>
			   	 		<?php } ?>
			   	 		<div class="pp-restaurant-menu-item-inline-right-content pp-menu-item-content">
			   	 			<?php if ( '' != trim( $menu_item->menu_items_title ) ) { ?>
					   	 		<h2>
									<?php if ( '' != trim($menu_item->menu_items_link) ) { ?>
										<a target="<?php echo $menu_item->menu_items_link_target;?>" href="<?php echo $menu_item->menu_items_link;?>" class="pp-restaurant-menu-item-title"><?php echo $menu_item->menu_items_title; ?></a>
									<?php } else { ?>
										<span class="pp-restaurant-menu-item-title"><?php echo $menu_item->menu_items_title; ?></span>
									<?php } ?>
								</h2>
							<?php } ?>
							<?php if ( $settings->show_description == 'yes' ) { ?>
								<div class="pp-restaurant-menu-item-description">
									<?php echo $menu_item->menu_item_description; ?>
								</div>
							<?php } ?>
						</div>
						<?php if ( '' != trim( $menu_item->menu_items_price ) && $settings->show_price == 'yes' ) { ?>
							<div class="pp-restaurant-menu-item-price">
								<span><?php echo $settings->currency_symbol; ?> </span> <?php echo $menu_item->menu_items_price; ?>
								<?php if ( '' != trim( $menu_item->menu_items_unit ) ) { ?>
									<span class="pp-menu-item-unit"> <?php echo trim( $menu_item->menu_items_unit ); ?></span>
								<?php } ?>
							</div>
						<?php } ?>
			 		</div>
			 	<?php
			 }
		?>
		<?php } ?>
	</div>
</div>
