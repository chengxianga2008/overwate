jQuery(document).ready(function($){
	$('#logo_upload-btn, #logo_img-url').click(function(e) {
	    e.preventDefault();
	    var image = wp.media({ title: 'Upload Image', multiple: false }).open() .on('select', function(e){
	        // This will return the selected image from the Media Uploader, the result is an object
	        var uploaded_image = image.state().get('selection').first();
	        // We convert uploaded_image to a JSON object to make accessing it easier
	        // Output to the console uploaded_image
	        console.log(uploaded_image);
	        var image_url = uploaded_image.toJSON().url;
	        // Let's assign the url value to the input field

	        $('#logo_img-url').val(image_url);
	    });
	});

	$('#scroll_img_upload-btn, #scroll_img-url').click(function(e) {
	    e.preventDefault();
	    var image = wp.media({ title: 'Upload Image', multiple: false }).open() .on('select', function(e){
	        // This will return the selected image from the Media Uploader, the result is an object
	        var uploaded_image = image.state().get('selection').first();
	        // We convert uploaded_image to a JSON object to make accessing it easier
	        // Output to the console uploaded_image
	        console.log(uploaded_image);
	        var image_url = uploaded_image.toJSON().url;
	        // Let's assign the url value to the input field

	        $('#scroll_img-url').val(image_url);
	    });
	});

	$('#login_page_upload-btn, #login_page_img-url').click(function(e) {
	    e.preventDefault();
	    var image = wp.media({ title: 'Upload Image', multiple: false }).open() .on('select', function(e){
	        // This will return the selected image from the Media Uploader, the result is an object
	        var uploaded_image = image.state().get('selection').first();
	        // We convert uploaded_image to a JSON object to make accessing it easier
	        // Output to the console uploaded_image
	        console.log(uploaded_image);
	        var image_url = uploaded_image.toJSON().url;
	        // Let's assign the url value to the input field

	        $('#login_page_img-url').val(image_url);
	    });
	});
});