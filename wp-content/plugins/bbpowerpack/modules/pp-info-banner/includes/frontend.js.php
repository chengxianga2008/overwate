;(function($) {

    var bannerOffset = $('.fl-node-<?php echo $id; ?>').offset();
    var bannerHeight = $('.fl-node-<?php echo $id; ?>').height();
    var winHeight = $(window).height();

    $(window).on('scroll', function() {
        var cssClass = $('.fl-node-<?php echo $id; ?> .info-banner-wrap').data('animation-class');
        var cssClassImg = $('.fl-node-<?php echo $id; ?> .pp-info-banner-img').data('animation-class');
        var scrollPos = $(window).scrollTop();

        if (scrollPos >= bannerOffset.top - ( winHeight - bannerHeight )) {
            $('.fl-node-<?php echo $id; ?> .info-banner-wrap').addClass(cssClass);
            $('.fl-node-<?php echo $id; ?> .pp-info-banner-img').addClass(cssClassImg);
        }
    });

})(jQuery);
