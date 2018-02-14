(function($){

	FLBuilder.registerModuleHelper('pp-pricing-table', {
		node: '',
		rules: {},

		init: function()
		{
			$( 'input[name=btn_bg_color]' ).on( 'change', this._bgColorChange );
			this._bgColorChange();

			this.node = $('form.fl-builder-pp-pricing-table-settings').data('node');
			$( 'input[name="pricing_columns[]"]' ).on( 'change', this._pricingColumnChange );
			this._pricingColumnChange();
		},

		_bgColorChange: function()
		{
			var bgColor = $( 'input[name=btn_bg_color]' ),
				style   = $( '#fl-builder-settings-section-btn_style' );

			if ( '' == bgColor.val() ) {
				style.hide();
			}
			else {
				style.show();
			}
		},

		_pricingColumnChange: function()
		{

			$.ajax({
				type: 'POST',
				data: { action: 'hl_package', node_preview: 1, node_id: this.node },
				url: ajaxurl,
				success: function( res ) {
					if ( res !== 'undefined' || res !== '' ) {

						var selected = parseInt(res); console.log(res);
						var count = 0;
						var html = '';

						$( 'input[name="pricing_columns[]"]' ).each(function() {
							var data = JSON.parse( $(this).val() );
							if ( count === selected ) {
								html += '<option value="'+count+'" selected="selected">'+data.title+'</option>';
							} else {
								html += '<option value="'+count+'">'+data.title+'</option>';
							}
							count++;
						});

						$( 'select[name="hl_package"]' ).html(html);
					}
				}
			});
		}
	});

})(jQuery);
