.fl-node-<?php echo $id; ?> .pp-3d-slider.pp-user-agent-safari {
    z-index: 100007;
}
.fl-node-<?php echo $id; ?> .pp-3d-slider .pp-slider-img {
    <?php if ( 'yes' == $settings->enable_photo_border ) { ?>
        border-style: solid;
        <?php
            $photo_border = $settings->photo_border;
            foreach ( $photo_border as $border_pos => $border_width ) {
                if ( empty( $border_width ) ) {
                    $photo_border[$border_pos] = 0;
                }
            }
        ?>
        border-top-width: <?php echo $photo_border['top'] . 'px'; ?>;
        border-left-width: <?php echo $photo_border['left'] . 'px'; ?>;
        border-bottom-width: <?php echo $photo_border['bottom'] . 'px'; ?>;
        border-right-width: <?php echo $photo_border['right'] . 'px'; ?>;
        <?php if ( $settings->photo_border_color ) { ?>
            border-color: #<?php echo $settings->photo_border_color; ?>;
        <?php } ?>
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-3d-slider .pp-slider-img-caption {
    <?php if ( $settings->caption_color ) { ?>
        color: #<?php echo $settings->caption_color; ?>;
    <?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-3d-slider .pp-slider-nav .fa {
    <?php if ( $settings->arrow_color ) { ?>
        color: #<?php echo $settings->arrow_color; ?>;
    <?php } ?>
    <?php if ( $settings->arrow_bg_color ) { ?>
        background-color: #<?php echo $settings->arrow_bg_color; ?>;
    <?php } ?>
    border-radius: <?php echo $settings->arrow_radius; ?>%;
}
.fl-node-<?php echo $id; ?> .pp-3d-slider .pp-slider-nav .fa:hover {
    <?php if ( $settings->arrow_hover_color ) { ?>
        color: #<?php echo $settings->arrow_hover_color; ?>;
    <?php } ?>
    <?php if ( $settings->arrow_bg_hover_color ) { ?>
        background-color: #<?php echo $settings->arrow_bg_hover_color; ?>;
    <?php } ?>
}

@media (max-width: 991px) and (min-width: 768px) {
	.pp-3d-slider {
        <?php if ( 'yes' == $settings->autoplay ) { ?>
	        height: 300px;
        <?php } else { ?>
            height: 440px;
        <?php } ?>
	}
}
@media only screen and (max-width: 767px) and (min-width: 480px) {
	.pp-3d-slider {
        <?php if ( 'yes' == $settings->autoplay ) { ?>
	        height: 345px;
        <?php } else { ?>
            height: 420px;
        <?php } ?>
	}
}
@media (max-width: 479px) {
	.pp-3d-slider {
        <?php if ( 'yes' == $settings->autoplay ) { ?>
	        height: 345px;
        <?php } else { ?>
            height: 385px;
        <?php } ?>
	}
}
@media (max-width: 400px) {
	.pp-3d-slider {
        height: 335px;
	}
}
@media (max-width: 370px) {
	.pp-3d-slider {
        height: 310px;
	}
}
