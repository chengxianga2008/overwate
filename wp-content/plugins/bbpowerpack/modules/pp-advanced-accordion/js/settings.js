(function($){

	FLBuilder.registerModuleHelper('accordion', {

		rules: {
			item_spacing: {
				required: true,
				number: true
			}
		},

		init: function()
		{
			var form            = $('.fl-builder-settings'),
				//labelSize       = form.find('select[name=label_size]'),
				itemSpacing     = form.find('input[name=item_spacing]');

			//labelSize.on('change', this._previewLabelSize);
			itemSpacing.on('keyup', this._previewItemSpacing);
		},

		_previewLabelSize: function()
		{
			//var size  = $('.fl-builder-settings select[name=label_size]').val(),
				wrap  = FLBuilder.preview.elements.node.find('.pp-accordion');

			//wrap.removeClass('pp-accordion-small');
			//wrap.removeClass('pp-accordion-medium');
			//wrap.removeClass('pp-accordion-large');
			//wrap.addClass('pp-accordion-' + size);
		},

		_previewItemSpacing: function()
		{
			var spacing = parseInt($('.fl-builder-settings input[name=item_spacing]').val(), 10),
				items   = FLBuilder.preview.elements.node.find('.pp-accordion-item');

			items.attr('style', '');

			if(isNaN(spacing) || spacing === 0) {
				items.css('margin-bottom', '0px');
				items.not(':last-child').css('border-bottom', 'none');
			}
			else {
				items.css('margin-bottom', spacing + 'px');
			}
		}
	});

})(jQuery);
