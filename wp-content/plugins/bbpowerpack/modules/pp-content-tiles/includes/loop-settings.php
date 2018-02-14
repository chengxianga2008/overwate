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

$settings = apply_filters( 'pp_tiles_loop_settings', $settings );
do_action( 'pp_tiles_loop_settings_before_form', $settings ); // e.g Add custom FLBuilder::render_settings_field()

?>
<div class="fl-custom-query fl-loop-data-source" data-source="custom_query">
	<div id="fl-builder-settings-section-general" class="fl-loop-builder fl-builder-settings-section">

		<table class="fl-form-table">
		<?php

		// Post type
		FLBuilder::render_settings_field('post_type', array(
			'type'          => 'post-type',
			'label'         => __('Post Type', 'bb-powerpack'),
		), $settings);

		// Order by
		FLBuilder::render_settings_field('order_by', array(
			'type'          => 'select',
			'label'         => __('Order By', 'bb-powerpack'),
			'options'       => array(
				'author'         => __('Author', 'bb-powerpack'),
				'comment_count'  => __('Comment Count', 'bb-powerpack'),
				'date'           => __('Date', 'bb-powerpack'),
				'modified'       => __('Date Last Modified', 'bb-powerpack'),
				'ID'             => __('ID', 'bb-powerpack'),
				'menu_order'     => __('Menu Order', 'bb-powerpack'),
				'meta_value'     => __('Meta Value (Alphabetical)', 'bb-powerpack'),
				'meta_value_num' => __('Meta Value (Numeric)', 'bb-powerpack'),
				'rand'        	 => __('Random', 'bb-powerpack'),
				'title'          => __('Title', 'bb-powerpack'),
			),
			'toggle'		=> array(
				'meta_value' 	=> array(
					'fields'		=> array( 'order_by_meta_key' )
				),
				'meta_value_num' => array(
					'fields'		=> array( 'order_by_meta_key' )
				)
			)
		), $settings);

		// Meta Key
		FLBuilder::render_settings_field('order_by_meta_key', array(
			'type'          => 'text',
			'label'         => __('Meta Key', 'bb-powerpack'),
		), $settings);

		// Order
		FLBuilder::render_settings_field('order', array(
			'type'          => 'select',
			'label'         => __('Order', 'bb-powerpack'),
			'options'       => array(
				'DESC'          => __('Descending', 'bb-powerpack'),
				'ASC'           => __('Ascending', 'bb-powerpack'),
			)
		), $settings);

		// Offset
		FLBuilder::render_settings_field('offset', array(
			'type'          => 'text',
			'label'         => _x('Offset', 'How many posts to skip.', 'bb-powerpack'),
			'default'       => '0',
			'size'          => '4',
			'help'          => __('Skip this many posts that match the specified criteria.', 'bb-powerpack')
		), $settings);

		// No results message
		FLBuilder::render_settings_field('no_results_message', array(
			'type' 			=> 'text',
			'label'			=> __('No Results Message', 'bb-powerpack'),
			'default'		=> __('No Posts Found.', 'bb-powerpack')
		), $settings);

		?>
		</table>
	</div>
	<div id="fl-builder-settings-section-filter" class="fl-builder-settings-section">
		<h3 class="fl-builder-settings-title"><?php esc_html_e('Filter', 'bb-powerpack'); ?></h3>
		<?php foreach(FLBuilderLoop::post_types() as $slug => $type) : ?>
			<table class="fl-form-table fl-loop-builder-filter fl-loop-builder-<?php echo $slug; ?>-filter" <?php if($slug == $settings->post_type) echo 'style="display:table;"'; ?>>
			<?php

			// Posts
			FLBuilder::render_settings_field('posts_' . $slug, array(
				'type'          => 'suggest',
				'action'        => 'fl_as_posts',
				'data'          => $slug,
				'label'         => $type->label,
				'help'          => sprintf(__('Enter a list of %s. Only these %s will be shown.', 'bb-powerpack'), $type->label, $type->label),
				'matching'      => true
			), $settings);

			// Taxonomies
			$taxonomies = FLBuilderLoop::taxonomies($slug);

			foreach($taxonomies as $tax_slug => $tax) {

				FLBuilder::render_settings_field('tax_' . $slug . '_' . $tax_slug, array(
					'type'          => 'suggest',
					'action'        => 'fl_as_terms',
					'data'          => $tax_slug,
					'label'         => $tax->label,
					'help'          => sprintf(__('Enter a list of %s. Only posts with these %s will be shown.', 'bb-powerpack'), $tax->label, $tax->label),
					'matching'      => true
				), $settings);
			}

			?>
			</table>
		<?php endforeach; ?>
		<table class="fl-form-table">
		<?php

		// Author
		FLBuilder::render_settings_field('users', array(
			'type'          => 'suggest',
			'action'        => 'fl_as_users',
			'label'         => __('Authors', 'bb-powerpack'),
			'help'          => __('Enter a list of authors usernames. Only posts with these authors will be shown.', 'bb-powerpack'),
			'matching'      => true
		), $settings);

		?>
		</table>
	</div>
</div>
<div id="fl-builder-settings-section-meta" class="fl-builder-settings-section">
	<h3 class="fl-builder-settings-title"><?php esc_html_e('Meta', 'bb-powerpack'); ?></h3>
	<table class="fl-form-table">
	<?php

	// Show Author
	FLBuilder::render_settings_field('show_author', array(
		'type'          => 'pp-switch',
		'label'         => __('Author', 'bb-powerpack'),
		'default'       => '1',
		'options'       => array(
			'1'             => __('Yes', 'bb-powerpack'),
			'0'             => __('No', 'bb-powerpack')
		)
	), $settings);

	// Show Date
	FLBuilder::render_settings_field('show_date', array(
		'type'          => 'pp-switch',
		'label'         => __('Date', 'bb-powerpack'),
		'default'       => '1',
		'options'       => array(
			'1'             => __('Yes', 'bb-powerpack'),
			'0'             => __('No', 'bb-powerpack')
		),
		'toggle'        => array(
			'1'             => array(
				'fields'        => array('date_format')
			)
		)
	), $settings);

	// Date format
	FLBuilder::render_settings_field('date_format', array(
		'type'          => 'select',
		'label'         => __('Date Format', 'bb-powerpack'),
		'default'       => 'default',
		'options'       => array(
			'default'		=> __('Default', 'bb-powerpack'),
			'M j, Y'        => date('M j, Y'),
			'F j, Y'        => date('F j, Y'),
			'm/d/Y'         => date('m/d/Y'),
			'm-d-Y'         => date('m-d-Y'),
			'd M Y'         => date('d M Y'),
			'd F Y'         => date('d F Y'),
			'Y-m-d'         => date('Y-m-d'),
			'Y/m/d'         => date('Y/m/d'),
		)
	), $settings);

	// Show taxonomy
	FLBuilder::render_settings_field('show_post_taxonomies', array(
		'type'          => 'pp-switch',
		'label'         => __('Show Taxonomy', 'bb-powerpack'),
		'default'       => 'show',
		'options'       => array(
			'1'           => __('Yes', 'bb-powerpack'),
			'0'           => __('No', 'bb-powerpack')
		),
		'toggle'        => array(
			'1'           => array(
				'fields'        => array('post_taxonomies')
			)
		)
	), $settings);

	// Show taxonomy
	FLBuilder::render_settings_field('post_taxonomies', array(
		'type'          => 'select',
		'label'         => __('Select Taxonomy', 'bb-powerpack'),
		'default'       => 'none',
		'options'       => array(
			'none'          => __('None', 'bb-powerpack')
		)
	), $settings);

	// Separators
	FLBuilder::render_settings_field('meta_separator', array(
		'type'          => 'select',
		'label'         => __('Meta Separator', 'bb-powerpack'),
		'default'       => ' / ',
		'options'       => array(
			' / '          	=> ' / ',
			' | '			=> ' | ',
			' - '			=> ' - '
		)
	), $settings);

	?>
	</table>
</div>

<?php
do_action( 'pp_tiles_loop_settings_after_form', $settings ); // e.g Add custom FLBuilder::render_settings_field()
?>

<script type="text/javascript">
	;(function($) {
		$('.fl-builder-pp-content-tiles-settings select[name="post_type"]').on('change', function() {
			var post_type_slug 		= $(this).val();
			var post_taxonomies 	= $('.fl-builder-pp-content-tiles-settings select[name="post_taxonomies"]');
			var selected_taxonomy 	= '<?php echo $settings->post_taxonomies; ?>';
			$.ajax({
				type: 'post',
				data: {action: 'ct_get_post_tax', post_type_slug: post_type_slug},
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				success: function(res) {
					if ( res !== 'undefined' || res !== '' ) {
						post_taxonomies.html(res);
						post_taxonomies.find('option[value="'+selected_taxonomy+'"]').attr('selected', 'selected');
					}
				}
			});
		});
	})(jQuery);
</script>
