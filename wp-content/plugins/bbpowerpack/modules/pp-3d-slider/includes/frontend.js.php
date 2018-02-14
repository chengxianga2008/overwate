(function ($) {
    <?php if ( 'yes' == $settings->autoplay ) { ?>
        $( '.fl-node-<?php echo $id; ?> .pp-3d-slider' ).gallery({ autoplay : true, interval : <?php echo $settings->autoplay_interval * 1000; ?> });
    <?php } else { ?>
        $( '.fl-node-<?php echo $id; ?> .pp-3d-slider' ).gallery();
    <?php } ?>
})(jQuery);
