<?php FLBuilderModel::default_settings($settings, array(
	'show_image' 		=> 'yes',
	'show_author'		=> 'yes',
	'show_date'			=> 'yes',
	'show_categories'	=> 'no',
	'meta_separator'	=> ' | ',
	'show_content'		=> 'yes',
	'content_type'		=> 'excerpt',
	'content_length'	=> 300,
	'more_link_type'	=> 'box',
	'more_link_text'	=> __('Read More', 'bb-powerpack'),
	'post_grid_filters_display' => 'no',
	'post_grid_filters'	=> 'none',
	'post_taxonomies'	=> 'none',
	'image_thumb_crop'	=> '',
	'product_rating'	=> 'yes',
	'product_price'		=> 'yes',
	'product_button'	=> 'yes',

));
$terms_list = wp_get_post_terms( get_the_id(), $settings->post_taxonomies );
 ?>
<div <?php post_class('pp-content-post pp-content-carousel-post pp-grid-' . $settings->post_grid_style_select); ?> itemscope="itemscope" itemtype="<?php FLPostGridModule::schema_itemtype(); ?>">

	<?php if( $settings->more_link_type == 'box' && ('product' != $settings->post_type || 'download' != $settings->post_type )) { ?>
		<a class="pp-post-link" href="<?php the_permalink(); ?>"></a>
	<?php } ?>

	<?php FLPostGridModule::schema_meta(); ?>

	<?php if( 'style-1' == $settings->post_grid_style_select ) { ?>

	<<?php echo $settings->title_tag; ?> class="pp-content-grid-title pp-post-title" itemprop="headline">
		<?php if( $settings->more_link_type == 'button' || $settings->more_link_type == 'title' || $settings->more_link_type == 'title_thumb' ) { ?>
			<a href="<?php the_permalink(); ?>">
		<?php } ?>
			<?php the_title(); ?>
		<?php if( $settings->more_link_type == 'button' || $settings->more_link_type == 'title' || $settings->more_link_type == 'title_thumb' ) { ?>
			</a>
		<?php } ?>
	</<?php echo $settings->title_tag; ?>>

	<div class="pp-content-post-meta pp-post-meta">
		<?php if($settings->show_author == 'yes' ) : ?>
			<span class="pp-content-post-author">
			<?php

			printf(
				_x( 'By %s', '%s stands for author name.', 'bb-powerpack' ),
				'<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"><span>' . get_the_author_meta( 'display_name', get_the_author_meta( 'ID' ) ) . '</span></a>'
			);

			?>
			</span>
		<?php endif; ?>
		<?php if($settings->show_date == 'yes' && 'style-5' != $settings->post_grid_style_select ) : ?>
			<?php if($settings->show_author == 'yes' ) : ?>
				<span> <?php echo $settings->meta_separator; ?> </span>
			<?php endif; ?>
			<span class="pp-content-grid-date">
				<?php echo get_the_date(); ?>
			</span>
		<?php endif; ?>

	</div>

	<?php } ?>

	<?php if($settings->show_image == 'yes') : ?>
	<div class="pp-content-carousel-image pp-post-image">
			<?php if(has_post_thumbnail()) { ?>
				<?php if( has_post_thumbnail() ) echo $module->pp_render_img( get_the_id(), $settings->image_thumb_crop ); ?>
			<?php } else {
				$first_img = $module->pp_catch_image( get_the_content() );
				$img_src = '' != $first_img ? $first_img : apply_filters( 'pp_cg_placeholder_img', $module->url .'/images/placeholder.jpg' );
				?>
				<img src="<?php echo $img_src; ?>" />
			<?php } ?>

			<?php if(($settings->show_categories == 'yes' && taxonomy_exists($settings->post_taxonomies) && !empty($terms_list)) && ('style-3' == $settings->post_grid_style_select) ) : ?>
				<div class="pp-content-category-list pp-post-meta">
					<?php if(taxonomy_exists($settings->post_taxonomies)) { ?>
						<?php $i = 1;
						foreach ($terms_list as $term):
							?>
						<?php if( $i == count($terms_list) ) { ?>
							<?php echo $term->name; ?>
						<?php } else { ?>
							<?php echo $term->name . ' /'; ?>
						<?php } ?>
						<?php $i++; endforeach; ?>
					<?php } ?>
				</div>
			<?php endif; ?>

			<?php if( 'style-4' == $settings->post_grid_style_select ) { ?>
				<<?php echo $settings->title_tag; ?> class="pp-content-grid-title pp-post-title" itemprop="headline">
					<?php if( $settings->more_link_type == 'button' || $settings->more_link_type == 'title' || $settings->more_link_type == 'title_thumb' ) { ?>
						<a href="<?php the_permalink(); ?>">
					<?php } ?>
						<?php the_title(); ?>
					<?php if( $settings->more_link_type == 'button' || $settings->more_link_type == 'title' || $settings->more_link_type == 'title_thumb' ) { ?>
						</a>
					<?php } ?>
				</<?php echo $settings->title_tag; ?>>
			<?php } ?>

			<?php if('style-6' == $settings->post_grid_style_select && 'yes' == $settings->show_date) { ?>
			<div class="pp-content-post-date pp-post-meta">
				<span class="pp-post-month"><?php echo get_the_date('M'); ?></span>
				<span class="pp-post-day"><?php echo get_the_date('d'); ?></span>
			</div>
			<?php } ?>
	</div>
	<?php endif; ?>

	<div class="pp-content-carousel-inner pp-content-body">

		<?php if('style-5' == $settings->post_grid_style_select && 'yes' == $settings->show_date) { ?>
		<div class="pp-content-post-date pp-post-meta">
			<span class="pp-post-day"><?php echo get_the_date('d'); ?></span>
			<span class="pp-post-month"><?php echo get_the_date('M'); ?></span>
		</div>
		<?php } ?>

		<div class="pp-content-post-data">

			<?php if( 'style-1' != $settings->post_grid_style_select && 'style-4' != $settings->post_grid_style_select ) { ?>
				<<?php echo $settings->title_tag; ?> class="pp-content-carousel-title pp-post-title" itemprop="headline">
					<?php if( $settings->more_link_type == 'button' || $settings->more_link_type == 'title' || $settings->more_link_type == 'title_thumb' ) { ?>
						<a href="<?php the_permalink(); ?>">
					<?php } ?>
						<?php the_title(); ?>
					<?php if( $settings->more_link_type == 'button' || $settings->more_link_type == 'title' || $settings->more_link_type == 'title_thumb' ) { ?>
						</a>
					<?php } ?>
				</<?php echo $settings->title_tag; ?>>
				<?php if( 'style-2' == $settings->post_grid_style_select ) { ?>
					<span class="pp-post-title-divider"></span>
				<?php } ?>
			<?php } ?>

		<?php if(($settings->show_author == 'yes' || $settings->show_date == 'yes' || $settings->show_categories == 'yes')
				&& ('style-1' != $settings->post_grid_style_select) ) : ?>

		<div class="pp-content-post-meta pp-post-meta">
			<?php if($settings->show_author == 'yes' ) : ?>
				<span class="pp-content-post-author">
				<?php

				printf(
					_x( 'By %s', '%s stands for author name.', 'bb-powerpack' ),
					'<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"><span>' . get_the_author_meta( 'display_name', get_the_author_meta( 'ID' ) ) . '</span></a>'
				);

				?>
				</span>
			<?php endif; ?>

				<?php if($settings->show_date == 'yes' && 'style-5' != $settings->post_grid_style_select && 'style-6' != $settings->post_grid_style_select ) : ?>
					<?php if($settings->show_author == 'yes'  ) : ?>
						<span> <?php echo $settings->meta_separator; ?> </span>
					<?php endif; ?>
					<span class="pp-content-carousel-date">
						<?php echo get_the_date(); ?>
					</span>
				<?php endif; ?>

				<?php if( 'style-6' == $settings->post_grid_style_select || 'style-5' == $settings->post_grid_style_select ) : ?>
					<?php if($settings->show_author == 'yes' && $settings->show_categories == 'yes' && taxonomy_exists($settings->post_taxonomies) && !empty($terms_list) ) : ?>
						<span> <?php echo $settings->meta_separator; ?> </span>
					<?php endif; ?>
					<?php if($settings->show_categories == 'yes') { ?>
					<span class="pp-content-post-category">
						<?php if(taxonomy_exists($settings->post_taxonomies)) { ?>
							<?php $i = 1;
							foreach ($terms_list as $term):
								?>
							<?php if( $i == count($terms_list) ) { ?>
								<?php echo $term->name; ?>
							<?php } else { ?>
								<?php echo $term->name . ' /'; ?>
							<?php } ?>
							<?php $i++; endforeach; ?>
						<?php } ?>
					</span>
					<?php } ?>
				<?php endif; ?>

			</div>
			<?php endif; ?>

			<?php if( $settings->post_type == 'product' && $settings->product_rating == 'yes' && class_exists( 'WooCommerce' ) ) { ?>
				<div class="pp-product-rating">
					<?php
					// Updated function woocommerce_get_template to wc_get_template
					// @since 1.2.7
					if( function_exists( 'wc_get_template' ) ) {
						wc_get_template('loop/rating.php');
					}
					?>
                </div>
			<?php } ?>

			<?php do_action( 'pp_cg_before_post_content', get_the_ID() ); ?>

			<?php if($settings->show_content == 'yes') : ?>
			<div class="pp-content-carousel-content pp-post-content">
				<?php
				if($settings->show_content == 'yes' && $settings->content_type == 'excerpt') :
					the_excerpt();
				endif;
				if($settings->show_content == 'yes' && $settings->content_type == 'content') :
					$more = '...';
					echo wp_trim_words( get_the_content(), $settings->content_length, apply_filters( 'pp_cg_content_limit_more', $more ) );
				endif;
				if ( $settings->content_type == 'full' ) :
					the_content();
				endif;
				?>
			</div>
			<?php endif; ?>

			<?php do_action( 'pp_cg_after_post_content', get_the_ID() ); ?>

			<?php if( $settings->more_link_text != '' && $settings->more_link_type == 'button' && 'product' != $settings->post_type && 'download' != $settings->post_type) : ?>
			<div class="pp-content-grid-more-link">
				<a class="pp-content-carousel-more pp-more-link-button" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $settings->more_link_text; ?></a>
			</div>
			<?php endif; ?>

			<?php if( ( $settings->post_type == 'product' || $settings->post_type == 'download' ) && ( $settings->product_price == 'yes' || $settings->product_button == 'yes' ) ) { ?>
				<?php if( $settings->product_price == 'yes' ) { ?>
					<div class="pp-product-price">
						<?php if( $settings->post_type == 'product' ) { ?>
							<p>
								<?php
								// Updated function woocommerce_get_template to wc_get_template
								// @since 1.2.7
								if( function_exists( 'wc_get_template' ) ) {
									wc_get_template('loop/price.php');
								}
								?>
							</p>
						<?php } ?>
						<?php if( $settings->post_type == 'download' && class_exists( 'Easy_Digital_Downloads' ) ) {
							   if (edd_has_variable_prices(get_the_ID())) {
								   // if the download has variable prices, show the first one as a starting price
									_e('Starting at: ','bb-powerpack');
									edd_price(get_the_ID());
							   } else {
								   edd_price(get_the_ID());
							   }
					   		}
					   ?>
	                </div>
				<?php } ?>
				<?php if( $settings->product_button == 'yes' ) { ?>
					<div class="pp-add-to-cart">
						<?php if( $settings->post_type == 'product' ) {
							// Updated function woocommerce_get_template to wc_get_template
							// @since 1.2.7
							if( function_exists( 'wc_get_template' ) ) {
		                		wc_get_template('loop/add-to-cart.php');
							}
						} ?>
						<?php  if( $settings->post_type == 'download' && class_exists( 'Easy_Digital_Downloads' ) ) {
							if (!edd_has_variable_prices(get_the_ID())) { ?>
	                            <?php echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button'); ?>
	                        <?php }
						} ?>
		            </div>
				<?php } ?>
			<?php } ?>

			<?php if(($settings->show_categories == 'yes' && taxonomy_exists($settings->post_taxonomies) && !empty($terms_list)) && ('style-3' != $settings->post_grid_style_select && 'style-5' != $settings->post_grid_style_select && 'style-6' != $settings->post_grid_style_select)) : ?>
				<div class="pp-content-category-list pp-post-meta">
					<?php if(taxonomy_exists($settings->post_taxonomies)) { ?>
						<?php $i = 1;
						foreach ($terms_list as $term):
							?>
						<?php if( $i == count($terms_list) ) { ?>
							<?php echo $term->name; ?>
						<?php } else { ?>
							<?php echo $term->name . ' /'; ?>
						<?php } ?>
						<?php $i++; endforeach; ?>
					<?php } ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

</div>
