(function($) {

    $('.fl-node-<?php echo $id; ?> .pp-flipbox-container').mouseenter(function() {
        $(this).addClass('pp-hover');
        $(this).click(function() {
            $(this).toggleClass('pp-hover');
        });
    });
    $('.fl-node-<?php echo $id; ?> .pp-flipbox-container').mouseleave(function() {
        $(this).removeClass('pp-hover');
    });

    if( $('.fl-node-<?php echo $id; ?> .pp-flipbox-front').outerHeight() > $('.fl-node-<?php echo $id; ?> .pp-flipbox-back').outerHeight() ) {
        $('.fl-node-<?php echo $id; ?> .pp-flipbox-back').css( 'height', $('.fl-node-<?php echo $id; ?> .pp-flipbox-front').outerHeight() + 'px' );
    }
    else {
        $('.fl-node-<?php echo $id; ?> .pp-flipbox-front').css( 'height', $('.fl-node-<?php echo $id; ?> .pp-flipbox-back').outerHeight() + 'px' );
    }

})(jQuery);
