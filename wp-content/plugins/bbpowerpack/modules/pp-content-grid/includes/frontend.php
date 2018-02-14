<div class="pp-posts-wrapper">
<?php FLBuilderModel::default_settings($settings, array(
	'post_grid_filters_display' => 'no',
	'post_type'	=> 'post',
	'post_grid_filters'	=> 'none'

));
$css_class = '';
if($settings->match_height == 'no') {
	$css_class .= ' pp-masonry-active';
} else {
	$css_class .= ' pp-equal-height';
}
if($settings->layout == 'grid' && $settings->post_grid_filters_display == 'yes' && !empty($settings->post_grid_filters)) {
	$css_class .= ' pp-filters-active';
}

// Get the query data.
$query = FLBuilderLoop::query($settings);
// Render the posts.
if($query->have_posts()) :
	$css_class .= ( FLBuilderLoop::get_paged() > 0 ) ? ' pp-paged-scroll-to' : '';
?>
<?php if($settings->layout == 'grid' && $settings->post_grid_filters_display == 'yes' && 'none' != $settings->post_grid_filters) { ?>
<div class="pp-post-filters-wrapper">
	<ul class="pp-post-filters">
		<?php
			$post_type_slug 	= $settings->post_type;
			$post_filter_tax 	= $settings->post_grid_filters;
			$post_filter_field 	= 'tax_' . $post_type_slug . '_' . $post_filter_tax;
			$post_filter_value	= $settings->$post_filter_field;
			$post_filter_terms	= array();

			if ( $post_filter_value ) {
				$post_filter_term_ids = explode(",", $post_filter_value);
				foreach ( $post_filter_term_ids as $post_filter_term_id ) {
					$post_filter_terms[] = get_term_by('id', $post_filter_term_id, $post_filter_tax);
				}
			}

			$taxonomy 			= get_taxonomy( $post_filter_tax );
			$taxonmy_name 		= $taxonomy->name;
			$terms 				= (count($post_filter_terms) > 0) ? $post_filter_terms : get_terms($post_filter_tax);
			$count 				= count($terms);

			echo '<li class="pp-post-filter pp-filter-active" data-filter="*">' . __('All', 'bb-powerpack') . '</li>';
			if ( $count > 0 ) {
				foreach ( $terms as $term ) {
					$slug = $term->slug;
					if( $post_type_slug == 'post' && $post_filter_tax == 'post_tag' ) {
						echo '<li class="pp-post-filter" data-filter=".tag-'.$slug.'">'.$term->name.'</li>';
					} else {
						echo '<li class="pp-post-filter" data-filter=".'.$taxonomy->name.'-'.$slug.'">'.$term->name.'</li>';
					}
				}
			}
		?>
	</ul>
</div>
<?php } ?>

<div class="pp-content-post-<?php echo $settings->layout; ?><?php echo $css_class; ?> clearfix" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<?php if( $settings->layout == 'carousel' ) { ?>
		<div class="pp-content-posts-inner owl-carousel">
	<?php } ?>

		<?php

		while($query->have_posts()) {

			$query->the_post();

			include $module->dir . 'includes/post-' . $settings->layout . '.php';
		}

		?>
		<?php if( $settings->layout == 'grid' ) { ?>
		<div class="pp-grid-space"></div>
		<?php } ?>
	<?php if ( $settings->layout == 'carousel' ) { ?></div><?php } ?>
</div>

<div class="fl-clear"></div>
<?php endif; ?>

<?php

// Render the pagination.
if($settings->layout != 'carousel' && $settings->pagination != 'none' && $query->have_posts()) :

?>
<div class="pp-content-grid-pagination fl-builder-pagination"<?php if($settings->pagination == 'scroll') echo ' style="display:none;"'; ?>>
	<?php $module->pagination( $query, $settings ); ?>
</div>
<?php endif; ?>

<?php

// Render the empty message.
if(!$query->have_posts() && (defined('DOING_AJAX') || isset($_REQUEST['fl_builder']))) :

?>
<div class="pp-content-grid-empty"><?php esc_html_e('No post found', 'bb-powerpack'); ?></div>
<?php

endif;

wp_reset_postdata();

?>
</div>
