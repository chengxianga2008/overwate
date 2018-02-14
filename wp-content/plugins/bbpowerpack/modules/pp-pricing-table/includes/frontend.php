<?php

	$columns = count($settings->pricing_columns);

	if( $settings->pricing_table_style == 'matrix' ) {
		$columns = $columns + 1;
	}

?>

<div class="pp-pricing-table pp-pricing-table-spacing-<?php echo $settings->box_spacing; ?>">

	<?php if( $settings->pricing_table_style == 'matrix' ) { ?>
		<div class="pp-pricing-table-col pp-pricing-table-col-<?php echo $columns; ?> pp-pricing-table-matrix">
			<div class="pp-pricing-table-column">
				<<?php echo $settings->title_tag; ?> class="pp-pricing-table-title">&nbsp;</<?php echo $settings->title_tag; ?>>
				<div class="pp-pricing-table-price">
					&nbsp;
				</div>
				<ul class="pp-pricing-table-features">
					<?php if (!empty($settings->matrix_items)) foreach ($settings->matrix_items as $item) : ?>
					<li><?php echo trim($item); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	<?php } ?>

	<?php

	for ($i=0; $i < count($settings->pricing_columns); $i++) :

		if(!is_object($settings->pricing_columns[$i])) continue;

		$pricingColumn = $settings->pricing_columns[$i];

		$highlight = '';
		$f_title = '';

		if( $settings->highlight !== 'none' && $i == $settings->hl_packages ) {
			$highlight = ' pp-pricing-table-highlight';
			if ( $settings->highlight == 'title' ) {
				$highlight = ' pp-pricing-table-highlight-title';
			}
			if ( $settings->highlight == 'price' ) {
				$highlight = ' pp-pricing-table-highlight-price';
			}
		}

		if( $pricingColumn->hl_featured_title ) {
			$f_title = ' pp-has-featured-title';
		}
	?>
	<div class="pp-pricing-table-col pp-pricing-table-col-<?php echo $columns; ?><?php echo $highlight; ?><?php echo $f_title; ?>">
		<div class="pp-pricing-table-column pp-pricing-table-column-<?php echo $i; ?>">
			<?php if( $pricingColumn->hl_featured_title ) { ?>
				<div class="pp-pricing-featured-title">
					<?php echo $pricingColumn->hl_featured_title; ?>
				</div>
			<?php } ?>
			<div class="pp-pricing-table-inner-wrap">
				<?php if( $settings->title_position == 'above' ) { ?>
					<<?php echo $settings->title_tag; ?> class="pp-pricing-table-title"><?php echo $pricingColumn->title; ?></<?php echo $settings->title_tag; ?>>
				<?php } ?>
				<div class="pp-pricing-table-price">
					<?php echo $pricingColumn->price; ?> <span class="pp-pricing-table-duration"><?php echo $pricingColumn->duration; ?></span>
				</div>
				<?php if( $settings->title_position == 'below' ) { ?>
					<<?php echo $settings->title_tag; ?> class="pp-pricing-table-title"><?php echo $pricingColumn->title; ?></<?php echo $settings->title_tag; ?>>
				<?php } ?>
				<ul class="pp-pricing-table-features">
					<?php if (!empty($pricingColumn->features)) foreach ($pricingColumn->features as $feature) : ?>
					<li><?php echo trim($feature); ?></li>
					<?php endforeach; ?>
				</ul>

				<?php $module->render_button($i); ?>
			</div>
		</div>
	</div>
	<?php

	endfor;

	?>
</div>
