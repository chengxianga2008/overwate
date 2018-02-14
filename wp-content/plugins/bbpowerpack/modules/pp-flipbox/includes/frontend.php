<?php

$flipbox_class = 'pp-flipbox-wrap';
$ie = '';
if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT'])) {
	$ie = ' pp-ie';
}

?>
<div class="pp-flip-box<?php echo $ie; ?>">
	<div class="<?php echo $flipbox_class; ?>">
		<div class="pp-flipbox-container">
			<div class="pp-flipbox pp-flipbox-front">
				<div class="pp-flipbox-inner">
					<?php if( $settings->icon_type == 'icon' && $settings->icon_select != '' ) { ?>
						<div class="pp-icon-wrapper animated">
							<div class="pp-flipbox-icon">
								<div class="pp-flipbox-icon-inner">
									<span class="pp-icon <?php echo $settings->icon_select; ?>"></span>
								</div>
							</div>
						</div>
					<?php } else if( $settings->icon_type == 'image' && $settings->image_select != '' ) { ?>
						<div class="pp-icon-wrapper animated">
							<div class="pp-flipbox-image">
								<img src="<?php echo $settings->image_select_src; ?>">
							</div>
						</div>
					<?php } ?>
					<div class="pp-flipbox-title">
						<<?php echo $settings->front_title_tag; ?> class="pp-flipbox-front-title"> <?php echo $settings->front_title; ?> </<?php echo $settings->front_title_tag; ?>>
					</div>
					<div class="pp-flipbox-description">
						<?php echo $settings->front_description; ?>
					</div>
				</div>
			</div>
			<div class="pp-flipbox pp-flipbox-back">
				<div class="pp-flipbox-inner">
					<div class="pp-flipbox-title">
						<<?php echo $settings->back_title_tag; ?> class="pp-flipbox-back-title"><?php echo $settings->back_title; ?></<?php echo $settings->back_title_tag; ?>>
					</div>
					<div class="pp-flipbox-description">
						<?php echo $settings->back_description; ?>
					</div>
					<?php if( $settings->link_type == 'custom' ) { ?>
						<a class="pp-more-link" href="<?php echo $settings->link; ?>" target="<?php echo $settings->link_target; ?>"><?php echo $settings->link_text; ?></a>
					<?php } ?>
				</div>
			</div>
		</div>

	</div>
</div>
