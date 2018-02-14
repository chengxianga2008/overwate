.fl-node-<?php echo $id; ?> .fl-module-content .pp-social-icon {
	<?php if ( isset( $settings->direction ) && $settings->direction == 'vertical' ) { ?>
		display: block;
		margin-bottom: <?php echo $settings->spacing; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .fl-module-content .pp-social-icon a,
.fl-node-<?php echo $id; ?> .fl-module-content .pp-social-icon a:hover {
	text-decoration: none;
}

.fl-node-<?php echo $id; ?> .fl-module-content .pp-social-icon a {
	display: inline-block;
	height: <?php echo $settings->box_size; ?>px;
	width: <?php echo $settings->box_size; ?>px;
}

.fl-node-<?php echo $id; ?> .fl-module-content .pp-social-icon i {
	float: left;
	color: #<?php echo $settings->color; ?>;
	background: #<?php echo $settings->bg_color; ?>;
	border-radius: <?php echo $settings->radius; ?>px;
	font-size: <?php echo $settings->size; ?>px;
	height: <?php echo $settings->box_size; ?>px;
	width: <?php echo $settings->box_size; ?>px;
	line-height: <?php echo $settings->size * 2; ?>px;
	text-align: center;
}

.fl-node-<?php echo $id; ?> .fl-module-content .pp-social-icon i:hover,
.fl-node-<?php echo $id; ?> .fl-module-content .pp-social-icon a:hover i {
	color: #<?php echo '' != $settings->hover_color ? $settings->hover_color : $settings->color; ?>;
	background: #<?php echo $settings->bg_hover_color; ?>;
}

<?php foreach ( $settings->icons as $i => $icon ) : ?>
	<?php if ( isset( $icon->color ) || isset( $icon->bg_color ) ) : ?>
		.fl-node-<?php echo $id; ?> .fl-module-content .pp-social-icon:nth-child(<?php echo $i + 1; ?>) i {
			<?php if ( isset( $icon->color ) ) : ?>
			color: #<?php echo $icon->color; ?>;
			<?php endif; ?>
			<?php if ( isset( $icon->bg_color ) ) : ?>
			background: #<?php echo $icon->bg_color; ?>;
			<?php endif; ?>
		}
	<?php endif; ?>
	<?php if ( isset( $icon->hover_color ) || isset( $icon->bg_hover_color ) ) : ?>
		.fl-node-<?php echo $id; ?> .fl-module-content .pp-social-icon:nth-child(<?php echo $i + 1; ?>) i:hover,
		.fl-node-<?php echo $id; ?> .fl-module-content .pp-social-icon:nth-child(<?php echo $i + 1; ?>) a:hover i {
			<?php if ( isset( $icon->hover_color ) ) : ?>
			color: #<?php echo $icon->hover_color; ?>;
			<?php endif; ?>
			<?php if ( isset( $icon->bg_hover_color ) ) : ?>
			background: #<?php echo $icon->bg_hover_color; ?>;
			<?php endif; ?>
		}
	<?php endif; ?>
<?php endforeach; ?>

<?php if ( isset( $settings->direction ) && $settings->direction == 'horizontal' ) { ?>
/* Left */
.fl-node-<?php echo $id; ?> .pp-social-icons-left .pp-social-icon {
	margin-right: <?php echo $settings->spacing; ?>px;
}

/* Center */
.fl-node-<?php echo $id; ?> .pp-social-icons-center .pp-social-icon {
	margin-left: <?php echo $settings->spacing; ?>px;
	margin-right: <?php echo $settings->spacing; ?>px;
}

/* Right */
.fl-node-<?php echo $id; ?> .pp-social-icons-right .pp-social-icon {
	margin-left: <?php echo $settings->spacing; ?>px;
}
<?php } ?>

@media only screen and (max-width: <?php echo $settings->breakpoint; ?>px) {
	.fl-node-<?php echo $id; ?> .pp-responsive-left {
		text-align: left;
	}

	.fl-node-<?php echo $id; ?> .pp-responsive-center {
		text-align: center;
	}

	.fl-node-<?php echo $id; ?> .pp-responsive-right {
		text-align: right;
	}

	/* Left */
	.fl-node-<?php echo $id; ?> .pp-responsive-left .pp-social-icon {
		margin-right: <?php echo $settings->spacing; ?>px;
	}

	/* Center */
	.fl-node-<?php echo $id; ?> .pp-responsive-center .pp-social-icon {
		margin-left: <?php echo $settings->spacing; ?>px;
		margin-right: <?php echo $settings->spacing; ?>px;
	}

	/* Right */
	.fl-node-<?php echo $id; ?> .pp-responsive-center .pp-social-icon {
		margin-left: <?php echo $settings->spacing; ?>px;
	}
}
