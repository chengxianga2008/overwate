jQuery(document).ready(function($) {

	if($.browser.msie) {
		$('select').one('mousedown',function(){
			$(this).data('origWidth', $(this).css('width'));
		}).mousedown(function(){
			$(this).css('width','auto');
		}).change(function(){
			$(this).css('width',$(this).data('origWidth'));
		}).blur(function(){
			$(this).css('width',$(this).data('origWidth'));
		});
	}

	function default_text(selector) {
		var element = $(selector);
		var text = element.attr('title');
		if (element.val() == '') {
			element.val(text).addClass('default-text-active');
		}
		element.focus(function() {
			if (element.val() == text) {
				element.val('').removeClass('default-text-active');
			}
		}).blur(function() {
			if (element.val() == '') {
				element.val(text).addClass('default-text-active');
			}
		});/*.parents('form').submit(function() {
			$('.default-text').each(function() {
				if($(this).val() == this.title) {
					$(this).val('').removeClass('default-text-active');
				}
			});
		});*/
	}
	$('.default-text').each(function() {
		default_text('#'+$(this).attr('id'));
	});
	$('.wrap').on('click', '.dynamik-add-button', function () {
		$('.default-text').each(function() {
			default_text('#'+$(this).attr('id'));
		});		
	});
	
});