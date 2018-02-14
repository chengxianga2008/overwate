<?php
    $responsive_display = $settings->responsive_display;
    $medium_device = $global_settings->medium_breakpoint;
    $small_device = $global_settings->responsive_breakpoint;
    $breakpoint = '';
    if ( $responsive_display == 'desktop' ) {
        $breakpoint = '> ' . $medium_device;
    }
    if ( $responsive_display == 'desktop-medium' ) {
        $breakpoint = '>= ' . $medium_device;
    }
    if ( $responsive_display == 'medium' ) {
        $breakpoint = '=== ' . $medium_device;
    }
    if ( $responsive_display == 'medium-mobile' ) {
        $breakpoint = '<= ' . $medium_device;
    }
    if ( $responsive_display == 'mobile' ) {
        $breakpoint = '<= ' . $small_device;
    }
?>

<?php if ( ! FLBuilderModel::is_builder_active() ) { ?>
;(function($) {

    $(window).load(function() {
        <?php if ( $responsive_display != '' && $breakpoint != '' ) { ?>
        if ( $(window).width() <?php echo $breakpoint; ?> ) {
        <?php } ?>

        setTimeout(function() {
            if( $('.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap').hasClass('pp-announcement-bar-bottom') ) {
                $('html').addClass('pp-bottom-bar');
            }
            if( $('.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap').hasClass('pp-announcement-bar-top') ) {
                var thisHeight = $('.fl-node-<?php echo $id; ?> .pp-announcement-bar-wrap').outerHeight();

                if( $('body').hasClass('admin-bar') ) {
                    $('html').addClass('pp-top-bar-admin');
                    thisHeight = thisHeight + $('#wpadminbar').outerHeight();
                }

                var style = '<style id="pp-style"> .pp-announcement-bar.pp-top-bar { margin-top: ' + thisHeight + 'px !important; } </style>';
                if ( $( '#pp-style' ).length === 0 ) {
                    $('head').append(style);
                }

                $('html').addClass('pp-announcement-bar pp-top-bar');
            }

            <?php if( $settings->announcement_bar_position == 'bottom' ) { ?>
                $('.fl-node-<?php echo $id; ?> .pp-announcement-bar-close-button').on('click', function() {
                    $('html').removeClass('pp-bottom-bar');
                });
            <?php } ?>
            <?php if( $settings->announcement_bar_position == 'top' ) { ?>
                $('.fl-node-<?php echo $id; ?> .pp-announcement-bar-close-button').on('click', function() {
                    $('html').removeClass('pp-top-bar');
                    $('html').removeClass('pp-top-bar-admin');
                });
            <?php } ?>
        }, 1000);

        <?php if ( $responsive_display != '' && $breakpoint != '' ) { ?>
        }
        <?php } ?>

    });

})(jQuery);
<?php } ?>
