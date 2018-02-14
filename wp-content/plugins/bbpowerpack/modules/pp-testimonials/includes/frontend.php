<?php

$testimonials_class = 'pp-testimonials-wrap';

if($settings->heading == '') {
	$testimonials_class .= ' pp-testimonials-no-heading';
}
?>
<div class="<?php echo $testimonials_class; ?>">
	<?php if( $settings->testimonial_layout == '4' ) { ?>
		<div class="layout-4-container <?php echo ( $settings->carousel == 1 ) ? 'carousel-enabled' : ''; ?>">
	<?php } ?>
	<?php if ( $settings->heading != '' ) { ?>
		<h2 class="pp-testimonials-heading"><?php echo $settings->heading; ?></h2>
	<?php } ?>
	<?php if ( $settings->arrows ) { ?>
	<div class="pp-arrow-wrapper">
		<div class="pp-slider-prev pp-slider-nav"></div>
		<div class="pp-slider-next pp-slider-nav"></div>
	</div>
	<?php } ?>
	<div class="pp-testimonials">
		<?php
		$layout = $settings->testimonial_layout;

		$number_testimonials = count($settings->testimonials);

		$classes = '';
		if( ($settings->carousel == 1) ) {
			$classes = 'carousel-enabled';
		}
		else {
			$classes = '';
		}

		switch ( $layout ) {
			case '1':
			for($i=0; $i < $number_testimonials; $i++) :

				if(!is_object($settings->testimonials[$i])) {
					continue;
				}

				$testimonials = $settings->testimonials[$i];

				?>
				<div class="pp-testimonial layout-1 <?php echo $classes; ?>">
					<?php if( $testimonials->photo ) { ?>
						<div class="pp-testimonials-image">
							<img src="<?php echo $testimonials->photo_src; ?>">
						</div>
					<?php } ?>
					<div class="pp-content-wrapper">
						<?php if( $settings->show_arrow == 'yes' ) { ?><div class="pp-arrow-top"></div><?php } ?>
						<?php if( $testimonials->testimonial ) { ?>
							<div class="pp-testimonials-content"><?php echo $testimonials->testimonial; ?></div>
						<?php } ?>
						<?php if( $testimonials->title || $testimonials->subtitle ) { ?>
							<div class="pp-title-wrapper">
								<?php if( $testimonials->title ) { ?>
									<h3 class="pp-testimonials-title"><?php echo $testimonials->title; ?></h3>
								<?php } ?>
								<?php if( $testimonials->subtitle ) { ?>
									<h4 class="pp-testimonials-subtitle"><?php echo $testimonials->subtitle; ?></h4>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php endfor;
			break;

			case '2':
			for($i=0; $i < $number_testimonials; $i++) :

				if(!is_object($settings->testimonials[$i])) {
					continue;
				}

				$testimonials = $settings->testimonials[$i];

				?>
				<div class="pp-testimonial layout-2 <?php echo $classes; ?>">
					<?php if( $testimonials->testimonial ) { ?>
						<div class="pp-content-wrapper">
							<div class="pp-testimonials-content"><?php echo $testimonials->testimonial; ?></div>
							<?php if( $settings->show_arrow == 'yes' ) { ?><div class="pp-arrow-bottom"></div><?php } ?>
						</div>
					<?php } ?>
					<div class="pp-vertical-align">
						<?php if( $testimonials->photo ) { ?>
							<div class="pp-testimonials-image">
								<img src="<?php echo $testimonials->photo_src; ?>">
							</div>
						<?php } ?>
						<?php if( $testimonials->title || $testimonials->subtitle ) { ?>
							<div class="pp-title-wrapper">
								<?php if( $testimonials->title ) { ?>
									<h3 class="pp-testimonials-title"><?php echo $testimonials->title; ?></h3>
								<?php } ?>
								<?php if( $testimonials->subtitle ) { ?>
									<h4 class="pp-testimonials-subtitle"><?php echo $testimonials->subtitle; ?></h4>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php endfor;
			break;

			case '3':
			for($i=0; $i < $number_testimonials; $i++) :

				if(!is_object($settings->testimonials[$i])) {
					continue;
				}

				$testimonials = $settings->testimonials[$i];

				?>
				<div class="pp-testimonial layout-3 <?php echo $classes; ?> clearfix">
					<?php if( $testimonials->photo ) { ?>
						<div class="pp-testimonials-image">
							<img src="<?php echo $testimonials->photo_src; ?>">
						</div>
					<?php } ?>
					<div class="layout-3-content pp-content-wrapper">
						<?php if( $settings->show_arrow == 'yes' ) { ?><div class="pp-arrow-left"></div><?php } ?>
						<?php if( $testimonials->testimonial ) { ?>
							<div class="pp-testimonials-content"><?php echo $testimonials->testimonial; ?></div>
						<?php } ?>
						<?php if( $testimonials->title || $testimonials->subtitle ) { ?>
							<div class="pp-title-wrapper">
								<?php if( $testimonials->title ) { ?>
									<h3 class="pp-testimonials-title"><?php echo $testimonials->title; ?></h3>
								<?php } ?>
								<?php if( $testimonials->subtitle ) { ?>
									<h4 class="pp-testimonials-subtitle"><?php echo $testimonials->subtitle; ?></h4>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php endfor;
			break;

			case '4':
			for($i=0; $i < $number_testimonials; $i++) :

				if(!is_object($settings->testimonials[$i])) {
					continue;
				}

				$testimonials = $settings->testimonials[$i];

				?>
				<div class="pp-testimonial layout-4 <?php echo $classes; ?> <?php echo (!$testimonials->photo) ? 'no-image-inner' : ''; ?>">
					<?php if( $testimonials->photo ) { ?>
						<div class="pp-testimonials-image">
							<img src="<?php echo $testimonials->photo_src; ?>">
						</div>
					<?php } ?>
					<div class="layout-4-content">
						<?php if( $testimonials->testimonial ) { ?>
							<div class="pp-testimonials-content"><?php echo $testimonials->testimonial; ?></div>
						<?php } ?>
						<?php if( $testimonials->title || $testimonials->subtitle ) { ?>
							<div class="pp-title-wrapper">
								<?php if( $testimonials->title ) { ?>
									<h3 class="pp-testimonials-title"><?php echo $testimonials->title; ?></h3>
								<?php } ?>
								<?php if( $testimonials->subtitle ) { ?>
									<h4 class="pp-testimonials-subtitle"><?php echo $testimonials->subtitle; ?></h4>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php endfor;
			break;

			case '5':
			for($i=0; $i < $number_testimonials; $i++) :

				if(!is_object($settings->testimonials[$i])) {
					continue;
				}

				$testimonials = $settings->testimonials[$i];

				?>
				<div class="pp-testimonial layout-5 <?php echo $classes; ?>">
					<div class="pp-vertical-align">
						<?php if( $testimonials->title || $testimonials->subtitle ) { ?>
							<div class="pp-title-wrapper">
								<?php if( $testimonials->title ) { ?>
									<h3 class="pp-testimonials-title"><?php echo $testimonials->title; ?></h3>
								<?php } ?>
								<?php if( $testimonials->subtitle ) { ?>
									<h4 class="pp-testimonials-subtitle"><?php echo $testimonials->subtitle; ?></h4>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<?php if( $testimonials->testimonial ) { ?>
						<div class="pp-content-wrapper">
							<?php if( $settings->show_arrow == 'yes' ) { ?><div class="pp-arrow-top"></div><?php } ?>
							<div class="pp-testimonials-content"><?php echo $testimonials->testimonial; ?></div>
						</div>
					<?php } ?>
				</div>
			<?php endfor;
			break;

			default:
			for($i=0; $i < $number_testimonials; $i++) :

				if(!is_object($settings->testimonials[$i])) {
					continue;
				}

				$testimonials = $settings->testimonials[$i];

				?>
				<div class="pp-testimonial layout-1 <?php echo $classes; ?>">
					<?php if( $testimonials->photo ) { ?>
						<div class="pp-testimonials-image">
							<img src="<?php echo $testimonials->photo_src; ?>">
						</div>
					<?php } ?>
					<?php if( $testimonials->testimonial ) { ?>
						<div class="pp-testimonials-content"><?php echo $testimonials->testimonial; ?></div>
					<?php } ?>
					<?php if( $testimonials->title || $testimonials->subtitle ) { ?>
						<div class="pp-title-wrapper">
							<?php if( $testimonials->title ) { ?>
								<h3 class="pp-testimonials-title"><?php echo $testimonials->title; ?></h3>
							<?php } ?>
							<?php if( $testimonials->subtitle ) { ?>
								<h4 class="pp-testimonials-subtitle"><?php echo $testimonials->subtitle; ?></h4>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			<?php endfor;
			break;
		} ?>

	</div>
	<?php if( $settings->testimonial_layout == '4' ) { ?>
	</div>
	<?php } ?>
</div>
