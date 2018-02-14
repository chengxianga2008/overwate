jQuery(document).ready(function($) {

	$('#show-hide-custom-css-builder').click(function() {
		$('#dynamik-custom-php-builder').hide();
		$('#dynamik-custom-css-builder').animate({'height': 'toggle'}, { duration: 300 });
		// Variables
		var dynamik_css_builder_nav_all = $('.dynamik-css-builder-nav-all');
		
		dynamik_css_builder_nav_all.click(function() {
			var css_nav_id = $(this).attr('id');
			$('.dynamik-all-css-builder').hide();
			$('#'+css_nav_id+'-box').show();
			dynamik_css_builder_nav_all.removeClass('dynamik-options-nav-active');
			$('#'+css_nav_id).addClass('dynamik-options-nav-active');
		});
	});

	$('#custom_css_elements').change(function() {
		var custom_css_elements = $(this).val();
		$('.css_builder_element_select').hide();
		$('#'+custom_css_elements+'_elements').show();
	});
	
	$('.custom-css-builder-button-elements').click(function() {
		var custom_css_length = $('#css-builder-output').val().length;
		var custom_css_cursor_position = custom_css_length - 3;
		$('#css-builder-output').selectRange(custom_css_cursor_position,custom_css_cursor_position);
	});
	
});