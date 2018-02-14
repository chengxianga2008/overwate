<div class="pp-accordion <?php if ( $settings->collapse ) echo ' pp-accordion-collapse'; ?>">
	<?php for ( $i = 0; $i < count( $settings->items ); $i++ ) : if ( empty( $settings->items[ $i ] ) ) continue; ?>
	<div id="pp-accord-<?php echo $id; ?>-<?php echo $i; ?>" class="pp-accordion-item"<?php if ( ! empty( $settings->id ) ) echo ' id="' . sanitize_html_class( $settings->id ) . '-' . $i . '"'; ?>>
		<div class="pp-accordion-button">
			<?php if( $settings->items[$i]->accordion_font_icon ) { ?>
				<span class="pp-accordion-icon <?php echo $settings->items[$i]->accordion_font_icon; ?>"></span>
			<?php } ?>
			<span class="pp-accordion-button-label" itemprop="name description"><?php echo $settings->items[ $i ]->label; ?></span>

			<?php if( $settings->accordion_open_icon != '' ) { ?>
				<span class="pp-accordion-button-icon pp-accordion-open <?php echo $settings->accordion_open_icon; ?>"></span>
			<?php } else { ?>
				<i class="pp-accordion-button-icon pp-accordion-open fa fa-plus"></i>
			<?php } ?>

			<?php if( $settings->accordion_close_icon != '' ) { ?>
				<span class="pp-accordion-button-icon pp-accordion-close <?php echo $settings->accordion_close_icon; ?>"></span>
			<?php } else { ?>
				<i class="pp-accordion-button-icon pp-accordion-close fa fa-minus"></i>
			<?php } ?>

		</div>
		<div class="pp-accordion-content fl-clearfix">
			<div itemprop="text"><?php echo $settings->items[ $i ]->content; ?></div>
		</div>
	</div>
	<?php endfor; ?>
</div>
