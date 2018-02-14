<?php

FLBuilderModel::default_settings($settings, array(
	'post_type' 			=> 'post',
	'order_by'  			=> 'date',
	'order'     			=> 'DESC',
	'offset'    			=> 0,
	'no_results_message'	=> __('No result found.', 'bb-powerpack'),
	'users'     			=> '',
	'show_author'			=> '1',
	'show_date'				=> '1',
	'date_format'			=> 'default',
	'show_post_taxonomies'	=> '1',
	'post_taxonomies'		=> 'category',
	'meta_separator'		=> ' / ',
	'title_margin'			=> array(
		'top'					=> '0',
		'bottom'				=> '0'
	)
));

?>
<div class="pp-post-tile-post pp-post-tile-post-<?php echo $count; ?><?php echo PPContentTilesModule::get_post_class($count, $settings->layout); ?>" itemscope itemtype="<?php PPContentTilesModule::schema_itemtype(); ?>">

	<?php PPContentTilesModule::schema_meta(); ?>

	<?php if(has_post_thumbnail()) :
		$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large'); ?>
	<div class="pp-post-tile-image" style="background-image: url(<?php echo is_array($image) ? $image[0] : ''; ?>)">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php //the_post_thumbnail($settings->image_size); ?>
		</a>
	</div>
	<?php endif; ?>

	<div class="pp-post-tile-text">

		<div class="pp-post-tile-info">
			<?php
				if ( $settings->show_post_taxonomies == '1' && $settings->post_taxonomies != 'none' ) {
					$terms = wp_get_post_terms( get_the_ID(), $settings->post_taxonomies );
					$show_terms = array();
					foreach ( $terms as $term ) {
						$show_terms[] = $term->name;
					}
			?>
				<div class="pp-post-tile-category"><span><?php echo implode( $settings->meta_separator, $show_terms ); ?></span></div>
			<?php } ?>
			<h3 class="pp-post-tile-title" itemprop="headline">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h3>
		</div>

		<?php if($settings->show_author || $settings->show_date) : ?>
		<div class="pp-post-tile-meta">
			<?php if($settings->show_author && $count == 1) : ?>
				<span class="pp-post-tile-author">
				<?php

				printf(
					_x( '%s', '%s stands for author name.', 'bb-powerpack' ),
					'<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"><span>' . get_the_author_meta( 'display_name', get_the_author_meta( 'ID' ) ) . '</span></a>'
				);

				?>
				</span>
			<?php endif; ?>
			<?php if($settings->show_date && $count == 1) : ?>
				<?php if($settings->show_author) : ?>
					<span class="pp-meta-separator"> <?php echo $settings->meta_separator; ?> </span>
				<?php endif; ?>
				<span class="pp-post-tile-date">
					<?php FLBuilderLoop::post_date($settings->date_format); ?>
				</span>
			<?php endif; ?>
		</div>
		<?php endif; ?>

	</div>

</div>
