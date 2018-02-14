;(function($) {

	$(function() {

		new PPAdvancedTabs({
			id: '<?php echo $id ?>'
		});

		$('.fl-node-<?php echo $id; ?> .pp-tabs-style-2 .pp-tabs-label.pp-tab-active').prev().addClass('pp-no-border');
		$('.fl-node-<?php echo $id; ?> .pp-tabs-style-2 .pp-tabs-label').on('click', function() {
			$('.fl-node-<?php echo $id; ?> .pp-tabs-style-2 .pp-tabs-label').removeClass('pp-no-border');
			$('.fl-node-<?php echo $id; ?> .pp-tabs-style-2 .pp-tabs-label.pp-tab-active').prev().addClass('pp-no-border');
		});

		$('.fl-node-<?php echo $id; ?> .pp-tabs-label').on('click', function() {
			//$('.fl-node-<?php echo $id; ?> .pp-tabs-label').removeClass('pp-tab-active');
			//$(this).addClass('pp-tab-active');
		});

		if($(window).width() > 768) {
			$('.fl-node-<?php echo $id; ?> .pp-tabs-vertical .pp-tabs-panel-content').css('height', $('.fl-node-<?php echo $id; ?> .pp-tabs-vertical .pp-tabs-labels').outerHeight() + 'px');
		}

		if( $(window).width() <= 768 ) {
			$('.fl-node-<?php echo $id; ?> .pp-tabs-label .pp-tab-close').on('click', function() {
				$(this).parents('.pp-tabs-label').removeClass('pp-tab-active');
			});
		}
	});

})(jQuery);
