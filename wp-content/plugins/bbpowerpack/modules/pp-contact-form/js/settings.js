(function($){

	FLBuilder.registerModuleHelper('pp-contact-form', {


		rules: {
            'form_border_width': {
                number: true
            },
            'form_border_radius': {
                number: true,
            },
            'form_shadow_h': {
                number: true
            },
            'form_shadow_v': {
                number: true
            },
            'form_shadow_blur': {
                number: true
            },
            'form_shadow_spread': {
                number: true
            },
            'form_shadow_opacity': {
                number: true
            },
            'form_padding': {
                number: true
            },
            'title_margin': {
                number: true
            },
            'description_margin': {
                number: true
            },
            'input_field_height': {
                number: true
            },
            'input_textarea_height': {
                number: true
            },
            'input_field_background_opacity': {
                number: true
            },
            'input_field_border_width': {
                number: true
            },
            'input_field_border_radius': {
                number: true
            },
            'input_field_padding': {
                number: true
            },
            'input_field_margin': {
                number: true
            },
            'button_width_size': {
                number: true
            },
            'button_background_opacity': {
                number: true
            },
            'button_border_width': {
                number: true
            },
            'button_border_radius': {
                number: true
            },
            'title_font_size': {
                number: true
            },
            'title_line_height': {
                number: true
            },
            'description_font_size': {
                number: true
            },
            'description_line_height': {
                number: true
            },
            'label_font_size': {
                number: true
            },
            'input_font_size': {
                number: true
            },
            'button_font_size': {
                number: true
            },
            'validation_error_font_size': {
                number: true
            },
            'success_message_font_size': {
                number: true
            }
        },


		init: function()
		{
			var form      = $( '.fl-builder-settings' ),
				action    = form.find( 'select[name=success_action]' );

			this._actionChanged();

			action.on( 'change', this._actionChanged );
		},

		_actionChanged: function()
		{
			var form      = $( '.fl-builder-settings' ),
				action    = form.find( 'select[name=success_action]' ).val(),
				url       = form.find( 'input[name=success_url]' );

			url.rules('remove');

			if ( 'redirect' == action ) {
				url.rules( 'add', { required: true } );
			}
		}


	});

})(jQuery);
