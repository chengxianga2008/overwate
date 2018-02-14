<div class="pp-social-icons pp-social-icons-<?php echo $settings->align; ?> pp-responsive-<?php echo $settings->responsive_align; ?>">
<?php

foreach($settings->icons as $icon) {

	if(!is_object($icon)) {
		continue;
	}
	?>
	<span class="pp-social-icon">
		<a href="<?php echo $icon->link; ?>" target="<?php echo isset($icon->link_target) ? $icon->link_target : '_blank'; ?>">
			<i class="fa <?php echo $icon->icon; ?>"></i>
		</a>
	</span>
	<?php
}

?>
</div>
