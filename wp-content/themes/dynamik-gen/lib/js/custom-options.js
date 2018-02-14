eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(2($){$.c.f=2(p){p=$.d({g:"!@#$%^&*()+=[]\\\\\\\';,/{}|\\":<>?~`.- ",4:"",9:""},p);7 3.b(2(){5(p.G)p.4+="Q";5(p.w)p.4+="n";s=p.9.z(\'\');x(i=0;i<s.y;i++)5(p.g.h(s[i])!=-1)s[i]="\\\\"+s[i];p.9=s.O(\'|\');6 l=N M(p.9,\'E\');6 a=p.g+p.4;a=a.H(l,\'\');$(3).J(2(e){5(!e.r)k=o.q(e.K);L k=o.q(e.r);5(a.h(k)!=-1)e.j();5(e.u&&k==\'v\')e.j()});$(3).B(\'D\',2(){7 F})})};$.c.I=2(p){6 8="n";8+=8.P();p=$.d({4:8},p);7 3.b(2(){$(3).f(p)})};$.c.t=2(p){6 m="A";p=$.d({4:m},p);7 3.b(2(){$(3).f(p)})}})(C);',53,53,'||function|this|nchars|if|var|return|az|allow|ch|each|fn|extend||alphanumeric|ichars|indexOf||preventDefault||reg|nm|abcdefghijklmnopqrstuvwxyz|String||fromCharCode|charCode||alpha|ctrlKey||allcaps|for|length|split|1234567890|bind|jQuery|contextmenu|gi|false|nocaps|replace|numeric|keypress|which|else|RegExp|new|join|toUpperCase|ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('|'),0,{}));

jQuery(document).ready(function($){
	
    $('textarea[data-editor]').each(function () {
        var textarea = $(this);
        var mode = textarea.data('editor');
        var editDiv = $('<div>', {
            position: 'absolute',
            width: $('#dynamik-admin-footer').width(),
            height: '480px',
            'class': textarea.attr('class')
        }).insertBefore(textarea);
        textarea.css('display', 'none');
        var editor = ace.edit(editDiv[0]);
        editor.renderer.setShowGutter(true);
        editor.setShowPrintMargin(false);
        editor.getSession().setValue(textarea.val());
        editor.getSession().setMode('ace/mode/'+mode);
        editor.getSession().setOption('useWorker', ace_editor_syntax_validation);
        editor.setTheme('ace/theme/textmate');
		editor.setOptions({
		    enableBasicAutocompletion: true,
	        enableSnippets: true,
	        enableLiveAutocompletion: true,
	        useSoftTabs: false
		});
		
		editor.getSession().on('change', function() {
			textarea.val(editor.getSession().getValue());
		});
    });
    
	function resizeAce() {
		$('.ace_editor').width($('#dynamik-admin-footer').width());
		$('.ace_content').width($('#dynamik-admin-footer').width());
	};
	// listen for changes
	$(window).resize(resizeAce);
	// set initially
	resizeAce();

	function getInputSelection(el) {
		var start = 0, end = 0, normalizedValue, range,
			textInputRange, len, endRange;

		if (typeof el.selectionStart == 'number' && typeof el.selectionEnd == 'number') {
			start = el.selectionStart;
			end = el.selectionEnd;
		} else {
			range = document.selection.createRange();

			if (range && range.parentElement() == el) {
				len = el.value.length;
				normalizedValue = el.value.replace(/\r\n/g, '\n');

				// Create a working TextRange that lives only in the input
				textInputRange = el.createTextRange();
				textInputRange.moveToBookmark(range.getBookmark());

				// Check if the start and end of the selection are at the very end
				// of the input, since moveStart/moveEnd doesn't return what we want
				// in those cases
				endRange = el.createTextRange();
				endRange.collapse(false);

				if (textInputRange.compareEndPoints('StartToEnd', endRange) > -1) {
					start = end = len;
				} else {
					start = -textInputRange.moveStart('character', -len);
					start += normalizedValue.slice(0, start).split('\n').length - 1;

					if (textInputRange.compareEndPoints('EndToEnd', endRange) > -1) {
						end = len;
					} else {
						end = -textInputRange.moveEnd('character', -len);
						end += normalizedValue.slice(0, end).split('\n').length - 1;
					}
				}
			}
		}

		return {
			start: start,
			end: end
		};
	}

	function offsetToRangeCharacterMove(el, offset) {
		return offset - (el.value.slice(0, offset).split('\r\n').length - 1);
	}

	function setInputSelection(el, startOffset, endOffset) {
		if (typeof el.selectionStart == 'number' && typeof el.selectionEnd == 'number') {
			el.selectionStart = startOffset;
			el.selectionEnd = endOffset;
		} else {
			var range = el.createTextRange();
			var startCharMove = offsetToRangeCharacterMove(el, startOffset);
			range.collapse(true);
			if (startOffset == endOffset) {
				range.move('character', startCharMove);
			} else {
				range.moveEnd('character', offsetToRangeCharacterMove(el, endOffset));
				range.moveStart('character', startCharMove);
			}
			range.select();
		}
	}

	$('.wrap').on('keydown', '.forbid-chars', function() {
		if (!$(this).data('init')) {
			$(this).data('init', true);
			$(this).alphanumeric({allow:'_',nocaps:true});
			$(this).trigger('keydown');
		}
	});
	
	$('.wrap').on('keydown', '.forbid-chars', function() {
		var value = $(this).val();
		value = value.replace(/^[0-9]/, '');
		$(this).val(value);
	});
	
	$('.wrap').on('keyup', '.forbid-chars', function() {
		var value = $(this).val();
		value = value.replace(/^[0-9]/, '');
		$(this).val(value);
	});
	
    $('.wrap').on('paste', '.forbid-chars', function(event) { 
        var charCode = event.which;
        var keyChar = String.fromCharCode(charCode); 
        return /[*]/.test(keyChar); 
    });

	$('.wrap').on('keydown', '.forbid-chars-alt', function() {
		if (!$(this).data('init')) {
			$(this).data('init', true);
			$(this).alphanumeric({allow:'_ -'});
			$(this).trigger('keydown');
		}
	});
	
	$('.wrap').on('keydown', '.forbid-chars-alt', function() {
		var value = $(this).val();
		value = value.replace(/^[0-9]/, '');
		$(this).val(value);
	});
	
	$('.wrap').on('keyup', '.forbid-chars-alt', function() {
		var value = $(this).val();
		value = value.replace(/^[0-9]/, '');
		$(this).val(value);
	});
	
    $('.wrap').on('paste', '.forbid-chars-alt', function(event) { 
        var charCode = event.which;
        var keyChar = String.fromCharCode(charCode); 
        return /[*]/.test(keyChar); 
    });

	$('.wrap').on('keydown', '.forbid-template-chars', function() {
		if (!$(this).data('init')) {
			$(this).data('init', true);
			$(this).alphanumeric({allow:'-',nocaps:true});
			$(this).trigger('keydown');
		}
	});
	
    $('.wrap').on('paste', '.forbid-template-chars', function(event) { 
        var charCode = event.which;
        var keyChar = String.fromCharCode(charCode); 
        return /[*]/.test(keyChar); 
    });

	$('.wrap').on('focusout', '.forbid-names', function(e) {
		var value = $(this).val();
		if(value == 'functions' || value == 'front-page' || value == 'landing') {
			setTimeout(function() {
				alert('"'+value+'" is not a valid Custom Template Name. Please refer to the Custom Templates [?]Tooltip (the section titled "Important Information About Naming Your Custom Template") for more details.');
			}, 0);
		}
	});
	
	// Variables
	var dynamik_options_nav_all = $('.dynamik-options-nav-all');
	var cct, sel, scrollTop, scrollLeft;
	
	dynamik_options_nav_all.click(function() {
		if($('#dynamik-custom-options-nav-css').hasClass('dynamik-options-nav-active'))
		{
			cct = document.getElementById('dynamik-custom-css');
			sel = getInputSelection(cct);
			scrollTop = cct.scrollTop;
			scrollLeft = cct.scrollLeft;
		}
		var nav_id = $(this).attr('id');
		$('.dynamik-all-options').hide();
		$('#'+nav_id+'-box').show();
		if(nav_id != 'dynamik-custom-options-nav-templates')
		{
			$('#dynamik-floating-save').removeClass('dynamik-templates-tab');
		}
		else
		{
			$('#dynamik-floating-save').addClass('dynamik-templates-tab');
		}
		if(nav_id != 'dynamik-custom-options-nav-labels')
		{
			$('#dynamik-floating-save').removeClass('dynamik-labels-tab');
		}
		else
		{
			$('#dynamik-floating-save').addClass('dynamik-labels-tab');
		}
		if(nav_id != 'dynamik-custom-options-nav-conditionals')
		{
			$('#dynamik-floating-save').removeClass('dynamik-conditionals-tab');
		}
		else
		{
			$('#dynamik-floating-save').addClass('dynamik-conditionals-tab');
		}
		if(sel)
		{
			if(nav_id == 'dynamik-custom-options-nav-css')
			{
				setInputSelection(cct, sel.start, sel.end);
				cct.scrollTop = scrollTop;
				cct.scrollLeft = scrollLeft;
			}
		}
		// Refresh CodeMirror
		$('.CodeMirror').each(function(i, el){
		    el.CodeMirror.refresh();
		});
		dynamik_options_nav_all.removeClass('dynamik-options-nav-active');
		$('#'+nav_id).addClass('dynamik-options-nav-active');
	});

	$('.wrap').on('mousedown', '.do-shortcode', function() {
		var this_hook_id = $(this).parent().parent().parent().attr('id');
		$('#'+this_hook_id+' .dynamik-tabby-textarea').val($('#'+this_hook_id+' .dynamik-tabby-textarea').val().replace(/\[/g, '<?php echo do_shortcode( \'['));
		$('#'+this_hook_id+' .dynamik-tabby-textarea').val($('#'+this_hook_id+' .dynamik-tabby-textarea').val().replace(/\]/g, ']\' ); ?>'));
	});

	$('.wrap').on('mouseup', '.do-shortcode', function() {
		var this_hook_id = $(this).parent().parent().parent().attr('id');
		$('#'+this_hook_id+' .dynamik-tabby-textarea').val($('#'+this_hook_id+' .dynamik-tabby-textarea').val().replace(/\<\?php echo do_shortcode\( \'\<\?php echo do_shortcode\(/g, '<?php echo do_shortcode('));
		$('#'+this_hook_id+' .dynamik-tabby-textarea').val($('#'+this_hook_id+' .dynamik-tabby-textarea').val().replace(/\)\;\ \?\>\'\ \)\;\ \?\>/g, '); ?>'));
	});
	
	/* BEGIN View Only/All Hook Boxes */
	var view_only_hook_handler = function() {
		var this_hook_id = $(this).parent().parent().parent().attr('id');
		$('.dynamik-all-hook-boxes').hide();
		$('#'+this_hook_id).show();
		$('.view-only-hook').hide();
		$('.view-all-hooks').show();
	};
	
	$('.view-only-hook').bind('click', view_only_hook_handler);
	
	var view_all_hook_handler = function() {
		$('.dynamik-all-hook-boxes').show();
		$('.view-all-hooks').hide();
		$('.view-only-hook').show();
	};
	
	$('.view-all-hooks').bind('click', view_all_hook_handler);
	/* END View Only/All Hook Boxes */

	/* BEGIN View Only/All Templates */
	var view_only_template_handler = function() {
		var this_template_id = $(this).parent().parent().parent().attr('id');
		$('.dynamik-all-templates').hide();
		$('#'+this_template_id).show();
		$('.view-only-template').hide();
		$('.view-all-templates').show();
	};
	
	$('.view-only-template').bind('click', view_only_template_handler);
	
	var view_all_template_handler = function() {
		$('.dynamik-all-templates').show();
		$('.view-all-templates').hide();
		$('.view-only-template').show();
	};
	
	$('.view-all-templates').bind('click', view_all_template_handler);
	/* END View Only/All Hook Boxes */

	$('#dynamik-css-builder-popup-active').change(function() {
		if($('#dynamik-css-builder-popup-active').is(':checked')) {
			$('#dynamik-floating-save').removeClass('dynamik-css-tab');
		} else {
			$('#dynamik-floating-save').addClass('dynamik-css-tab');
		}
	});

	$('#show-hide-custom-php-builder').click(function() {
		$('#dynamik-custom-css-builder').hide();
		$('#dynamik-custom-php-builder').animate({'height': 'toggle'}, { duration: 300 });
	});

	$('#php_action_or_filter').change(function() {
		var value = $(this).val();
		if(value == 'add_filter') {
			$('#php_add_actions_wrap').hide();
			$('#php_remove_actions_wrap').hide();
			$('#php_filters_wrap').show();
		} else if(value == 'remove_action') {
			$('#php_add_actions_wrap').hide();
			$('#php_filters_wrap').hide();
			$('#php_remove_actions_wrap').show();
		} else {
			$('#php_filters_wrap').hide();
			$('#php_remove_actions_wrap').hide();
			$('#php_add_actions_wrap').show();
		}
		if(value == 'add_action') {
			$('#php_add_actions_wrap').show();
		}
		if(value == 'replace_action' || value == 'add_filter') {
			$('#custom_function_name_wrap').show();
		} else {
			$('#custom_function_name_wrap').hide();
		}
		if(value == 'add_action') {
			$('.custom-php-builder-button').hide();
			$('#build_add_action_php').show();
		} else if(value == 'remove_action') {
			$('.custom-php-builder-button').hide();
			$('#build_remove_action_php').show();
		} else if(value == 'replace_action') {
			$('.custom-php-builder-button').hide();
			$('#build_replace_action_php').show();
		} else {
			$('.custom-php-builder-button').hide();
			$('#build_add_filter_php').show();
		}
	});
	$('#php_action_or_filter').change();

	$('#wrap_in_php_tags').click(function() {
		var custom_php = $('#php-builder-output').val();
		var new_custom_php = '<?php\n'+custom_php+'?>';
		$('#php-builder-output').val(new_custom_php);
	});

	$('.readonly-text-input').each(function() {
		$('#'+$(this).attr('id')).val($('#'+$(this).attr('id')).attr('title')).prop('readonly', true);
	});

	function show_message(response) {
		$('.dynamik-ajax-save-spinner').hide();
		$('.dynamik-saved').html(response).fadeIn('slow');
		window.setTimeout(function(){
			$('.dynamik-saved').fadeOut('slow'); 
		}, 2222);
	}
	
	$('form#custom-options-form').submit(function() {
		$('.dynamik-ajax-save-spinner').show();
		var data = $(this).serialize();
		jQuery.post(ajaxurl, data, function(response) {
			if(response) {
				show_message(response);
			}
			if( $('#dynamik-floating-save').hasClass('dynamik-css-tab') ) {
				location.reload(true);
			}
			if( $('#dynamik-floating-save').hasClass('dynamik-templates-tab') ) {
				window.setTimeout(function(){
					location.reload(true);
					window.location.replace(dynamik_custom_url+'&activetab=dynamik-custom-options-nav-templates&notice=template-added')
				}, 1500);
			}
			if( $('#dynamik-floating-save').hasClass('dynamik-labels-tab') ) {
				window.setTimeout(function(){
					location.reload(true);
					window.location.replace(dynamik_custom_url+'&activetab=dynamik-custom-options-nav-labels&notice=label-added')
				}, 1500);
			}
			if( $('#dynamik-floating-save').hasClass('dynamik-conditionals-tab') ) {
				window.setTimeout(function(){
					location.reload(true);
					window.location.replace(dynamik_custom_url+'&activetab=dynamik-custom-options-nav-conditionals&notice=conditional-added')
				}, 1500);
			}
		});
		return false;
	});

	var template_counter = 1000;
	$('.add-template').click(function () { 
		template_counter += 1;
		$('#dynamik-templates-wrap').prepend('<div id="template-' + template_counter + '"><div class="dynamik-custom-template-option"><p class="bg-box-design"><label for="custom_template_ids[' + template_counter + ']">' + e_file_name + '</label><input type="text" id="custom-template-id-' + template_counter + '" name="custom_template_ids[' + template_counter + ']" value="" style="width:180px;" class="forbid-template-chars forbid-caps forbid-names" /><label for="custom_template_names[' + template_counter + ']">' + e_template_name + '</label><input type="text" id="custom-template-name-' + template_counter + '" name="custom_template_names[' + template_counter + ']" value="" style="width:180px;" class="searchable" /> <select id="custom-template-type-' + template_counter + '" name="custom_template_types[' + template_counter + ']" ><option value="page_template">' + e_page_template + '</option><option value="wp_template">' + e_wp_template + '</option></select></p><p><span id="' + template_counter + '" class="button delete-template">' + e_delete + '</span><span class="do-shortcode button">' + e_do_shortcode + '</span></p><p style="padding-top:3px;"><textarea class="resizable dynamik-tabby-textarea dynamik-tabby-textarea-temp" id="custom-template-textarea-' + template_counter + '" name="custom_template_textarea[' + template_counter + ']" style="height:100px;text-align:left;"></textarea></p></div></div>');
	});
	
	$('.wrap').on('click', '.delete-template', function () {
		var numb = $(this).attr('id');
		var template_file_name = $('#custom-template-id-' + numb).val();
		if( template_file_name != '' ) {
			var confirm_template_delete = confirm('Are you sure you want to Delete this Template?');
			if(confirm_template_delete) {
				var numb = $(this).attr('id');
						
				var data = {
					action: 'dynamik_template_delete',
					template_file_name: template_file_name
				};

				jQuery.post(ajaxurl, data, function(response) {
				});
				
				$('#template-' + numb).empty().remove();
				
				setTimeout( function() {
					$('.dynamik-save-button').click();
					location.reload(true);
					window.location.replace(dynamik_custom_url+'&activetab=dynamik-custom-options-nav-templates&notice=template-deleted')
				}, 1500 );
			}
		} else {
			var cannot_delete_template = confirm('You cannot delete unsaved Custom Templates. Instead, reload your Dynamik Custom Options admin page and they will automatically disappear.');
			if(cannot_delete_template) {
			}
		}
	});

	var label_counter = 1000;
	$('.add-label').click(function () { 
		label_counter += 1;
		$('#dynamik-labels-wrap').prepend('<div id="label-' + label_counter + '"><div class="dynamik-custom-label-option"><p class="bg-box-design"><label for="custom_label_names[' + label_counter + ']">' + e_name + '</label><input type="text" id="custom-label-name-' + label_counter + '" name="custom_label_names[' + label_counter + ']" value="" style="width:140px;" class="searchable" /> <span class="label-create-conditional">( ' + e_label_create_conditional + ' <input type="checkbox" id="custom-label-create-conditional-' + label_counter + '" name="custom_label_create_conditionals[' + label_counter + ']" value="1" />)</span> <span id="' + label_counter + '" class="button delete-label">' + e_delete + '</span></p></div></div>');
	});
	
	$('.wrap').on('click', '.delete-label', function () {
		var numb = $(this).attr('id');
		var label_name = $('#custom-label-name-' + numb).val();
		if( label_name != '' ) {
			var confirm_label_delete = confirm('Are you sure you want to Delete this Label?');
			if(confirm_label_delete) {
				var numb = $(this).attr('id');
						
				var data = {
					action: 'dynamik_label_delete',
					label_name: label_name
				};

				jQuery.post(ajaxurl, data, function(response) {
				});
				
				$('#label-' + numb).empty().remove();
				
				setTimeout( function() {
					$('.dynamik-save-button').click();
					location.reload(true);
					window.location.replace(dynamik_custom_url+'&activetab=dynamik-custom-options-nav-labels&notice=label-deleted')
				}, 1500 );
			}
		} else {
			var cannot_delete_label = confirm("You cannot delete unsaved Custom Labels. Instead, reload your Dynamik Custom Options admin page and they will automatically disappear.");
			if(cannot_delete_label) {
			}
		}
	});

	$('.conditionals-list-multiselect').multiSelect({minWidth:250});

	var conditional_counter = 1000;
	$('.add-conditional').click(function () { 
		conditional_counter += 1;
		$('#dynamik-conditionals-wrap').prepend('<div id="conditional-' + conditional_counter + '"><div class="dynamik-custom-conditional-option"><p class="bg-box-design"><select id="id-custom-conditional-id-' + conditional_counter + '" class="conditional-examples id-custom-conditional-tag-' + conditional_counter + '" name="conditional_examples" size="1" style="width:165px;">' + f_dynamik_list_conditional_examples + '</select><label for="custom_conditional_ids[' + conditional_counter + ']">' + e_name + '</label><input type="text" id="custom-conditional-id-' + conditional_counter + '" name="custom_conditional_ids[' + conditional_counter + ']" value="" style="width:25%;" class="forbid-chars forbid-caps searchable" /><label for="custom_conditional_tags[' + conditional_counter + ']">' + e_tag + '</label><input type="text" id="custom-conditional-tag-' + conditional_counter + '" name="custom_conditional_tags[' + conditional_counter + ']" value="" style="width:25%;" /><span id="' + conditional_counter + '"class="button delete-conditional">' + e_delete + '</span></p></div></div>');
	});
	
	$('.wrap').on('click', '.delete-conditional', function () { 
		var confirm_conditional_delete = confirm('Are you sure you want to Delete this Conditional?');
		if(confirm_conditional_delete) {
			var numb = $(this).attr('id');
			var conditional_id = $('#custom-conditional-id-' + numb).val();
					
			var data = {
				action: 'dynamik_conditional_delete',
				conditional_id: conditional_id
			};

			jQuery.post(ajaxurl, data, function(response) {
			});
			
			$('#conditional-' + numb).empty().remove();
			
			$('.ui-multiselect-checkboxes input[value^="'+conditional_id+'"]').attr('checked', false);
			
			setTimeout( function() {
				$('.dynamik-save-button').click();
				location.reload(true);
				window.location.replace(dynamik_custom_url+'&activetab=dynamik-custom-options-nav-conditionals&notice=conditional-deleted')
			}, 1500 );
		}
	});

	var widget_counter = 1000;
	$('.add-widget').click(function () { 
		widget_counter += 1;
		$('#dynamik-widgets-wrap').prepend('<div id="widget-' + widget_counter + '"><div class="dynamik-custom-widget-option"><p class="bg-box-design"><label for="custom_widget_ids[' + widget_counter + ']">' + e_name + '</label><input type="text" id="custom-widget-id-' + widget_counter + '" name="custom_widget_ids[' + widget_counter + ']" value="" style="width:200px;" class="forbid-chars-alt searchable" /><select id="custom-widget-hook-' + widget_counter + '" name="custom_widget_hook[' + widget_counter + ']" size="1" style="width:250px;">' + f_dynamik_list_hooks + '</select><label for="custom_widget_priority[' + widget_counter + ']">' + e_priority + '</label><input type="text" id="custom-widget-priority-' + widget_counter + '" name="custom_widget_priority[' + widget_counter + ']" value="10" style="width:30px;" /><select id="custom-widget-status-' + widget_counter + '" class="custom-widget-status" name="custom_widget_status[' + widget_counter + ']" ><option value="hkd">' + e_hooked + '</option><option value="sht">' + e_shortcode + '</option><option value="bth">' + e_both + '</option><option value="no">' + e_deactivate + '</option></select> </p><p><select class="conditionals-list-multiselect" id="custom-widget-conditionals-list-' + widget_counter + '" name="custom_widget_conditionals_list[' + widget_counter + '][]" multiple="multiple" style="width:250px;">' + f_dynamik_list_conditionals + '</select><label for="custom_widget_class[' + widget_counter + ']">' + e_class + '</label><input type="text" id="custom-widget-class-' + widget_counter + '" name="custom_widget_class[' + widget_counter + ']" value="" style="width:250px;" /> <span id="' + widget_counter + '" class="button delete-widget">' + e_delete + '</span></p><p><label for="custom_widget_description[' + widget_counter + ']" style="width:100%;">' + e_description + '</label><textarea class="resizable dynamik-tabby-textarea" id="custom-widget-description-' + widget_counter + '" name="custom_widget_description[' + widget_counter + ']" style="height:45px;margin:5px 0;text-align:left;"></textarea></p></div></div>' );
		$('#custom-widget-conditionals-list-' + widget_counter).multiSelect()
		$('#custom-widget-conditionals-list-' + widget_counter).width('266');
	});

	$('.wrap').on('change', '.custom-widget-status', function() {
		var value = $(this).val();
		var this_id_number = $(this).attr('id').replace(/custom-widget-status-/, '');
		if(value == 'sht') {
			$('#widget-' + this_id_number + ' label:contains("Name")').css('opacity', '1');
			$('#widget-' + this_id_number + ' label:contains("Hook")').css('opacity', '0.2');
			$('#widget-' + this_id_number + ' label:contains("Priority")').css('opacity', '0.2');
			$('#widget-' + this_id_number + ' label:contains("Conditionals")').css('opacity', '0.2');
			$('#widget-' + this_id_number + ' label:contains("Class")').css('opacity', '1');
			$('#widget-' + this_id_number + ' label:contains("Widget Area Description:")').animate({'height': 'show'}, { duration: 300 });
			$('#custom-widget-id-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-widget-hook-' + this_id_number).addClass('disabled-form-element');
			$('#custom-widget-priority-' + this_id_number).addClass('disabled-form-element');
			$('#custom-widget-conditionals-list-' + this_id_number).addClass('disabled-form-element');
			$('#custom-widget-class-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-widget-description-' + this_id_number).animate({'height': 'show'}, { duration: 300 });
		} else if(value == 'no') {
			$('#widget-' + this_id_number + ' label:contains("Name")').css('opacity', '0.2');
			$('#widget-' + this_id_number + ' label:contains("Hook")').css('opacity', '0.2');
			$('#widget-' + this_id_number + ' label:contains("Priority")').css('opacity', '0.2');
			$('#widget-' + this_id_number + ' label:contains("Conditionals")').css('opacity', '0.2');
			$('#widget-' + this_id_number + ' label:contains("Class")').css('opacity', '0.2');
			$('#widget-' + this_id_number + ' label:contains("Widget Area Description:")').animate({'height': 'hide'}, { duration: 300 });
			$('#custom-widget-id-' + this_id_number).addClass('disabled-form-element');
			$('#custom-widget-hook-' + this_id_number).addClass('disabled-form-element');
			$('#custom-widget-priority-' + this_id_number).addClass('disabled-form-element');
			$('#custom-widget-conditionals-list-' + this_id_number).addClass('disabled-form-element');
			$('#custom-widget-class-' + this_id_number).addClass('disabled-form-element');
			$('#custom-widget-description-' + this_id_number).animate({'height': 'hide'}, { duration: 300 });
		} else {
			$('#widget-' + this_id_number + ' label:contains("Name")').css('opacity', '1');
			$('#widget-' + this_id_number + ' label:contains("Hook")').css('opacity', '1');
			$('#widget-' + this_id_number + ' label:contains("Priority")').css('opacity', '1');
			$('#widget-' + this_id_number + ' label:contains("Conditionals")').css('opacity', '1');
			$('#widget-' + this_id_number + ' label:contains("Class")').css('opacity', '1');
			$('#widget-' + this_id_number + ' label:contains("Widget Area Description:")').animate({'height': 'show'}, { duration: 300 });
			$('#custom-widget-id-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-widget-hook-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-widget-priority-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-widget-conditionals-list-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-widget-class-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-widget-description-' + this_id_number).animate({'height': 'show'}, { duration: 300 });
		}
	});
	$('.custom-widget-status').change();
	
	$('.wrap').on('click', '.delete-widget', function () {
		var numb = $(this).attr('id');
		var widget_name = $('#custom-widget-id-' + numb).val();
		if( widget_name != '' ) {
			var confirm_widget_delete = confirm('Are you sure you want to Delete this Widget Area?');
			if(confirm_widget_delete) {		
				var data = {
					action: 'dynamik_widget_delete',
					widget_name: widget_name
				};

				jQuery.post(ajaxurl, data, function(response) {
				});
				
				$('#widget-' + numb).empty().remove();
				
				setTimeout( function() {
					$('.dynamik-save-button').click();
				}, 500 );
			}
		} else {
			var cannot_delete_widget = confirm('You cannot delete unsaved Custom Widget Areas. Instead, reload your Dynamik Custom Options admin page and they will automatically disappear.');
			if(cannot_delete_widget) {
			}
		}
	});
	
	var hook_counter = 1000;
	$('.add-hook').click(function () { 
		hook_counter += 1;
		$('#dynamik-hooks-wrap').prepend('<div id="hook-' + hook_counter + '"><div class="dynamik-custom-hook-option"><p class="bg-box-design"><label for="custom_hook_ids[' + hook_counter + ']">' + e_name + '</label><input type="text" id="custom-hook-id-' + hook_counter + '" name="custom_hook_ids[' + hook_counter + ']" value="" style="width:200px;" class="forbid-chars-alt searchable" /><select id="custom-hook-hook-' + hook_counter + '" name="custom_hook_hook[' + hook_counter + ']" size="1" style="width:250px;">' + f_dynamik_list_hooks + '</select><label for="custom_hook_priority[' + hook_counter + ']">' + e_priority + '</label><input type="text" id="custom-hook-priority-' + hook_counter + '" name="custom_hook_priority[' + hook_counter + ']" value="10" style="width:30px;" /><select id="custom-hook-status-' + hook_counter + '" class="custom-hook-status" name="custom_hook_status[' + hook_counter + ']" ><option value="hkd">' + e_hooked + '</option><option value="sht">' + e_shortcode + '</option><option value="bth">' + e_both + '</option><option value="css">' + e_css + '</option><option value="no">' + e_deactivate + '</option></select></p><p><select class="conditionals-list-multiselect" id="custom-hook-conditionals-list-' + hook_counter + '" name="custom_hook_conditionals_list[' + hook_counter + '][]" multiple="multiple" style="width:250px;">' + f_dynamik_list_conditionals + '</select> <span id="' + hook_counter + '" class="button delete-hook">' + e_delete + '</span><span class="do-shortcode button">' + e_do_shortcode + '</span></p><p><textarea class="resizable dynamik-tabby-textarea dynamik-tabby-textarea-temp" id="custom-hook-textarea-' + hook_counter + '" name="custom_hook_textarea[' + hook_counter + ']" style="height:100px;text-align:left;"></textarea></p></div></div>');
		$('#custom-hook-conditionals-list-' + hook_counter).multiSelect();
		$('#custom-hook-conditionals-list-' + hook_counter).width('266');
	});

	$('.wrap').on('change', '.custom-hook-status', function() {
		var value = $(this).val();
		var this_id_number = $(this).attr('id').replace(/custom-hook-status-/, '');
		if(value == 'sht') {
			$('#hook-' + this_id_number + ' label:contains("Name")').css('opacity', '1');
			$('#hook-' + this_id_number + ' label:contains("Hook")').css('opacity', '0.2');
			$('#hook-' + this_id_number + ' label:contains("Priority")').css('opacity', '0.2');
			$('#hook-' + this_id_number + ' label:contains("Conditionals")').css('opacity', '0.2');
			$('#hook-' + this_id_number + ' label:contains("Hook Box")').css('opacity', '1');
			$('#custom-hook-id-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-hook-hook-' + this_id_number).addClass('disabled-form-element');
			$('#custom-hook-priority-' + this_id_number).addClass('disabled-form-element');
			$('#custom-hook-conditionals-list-' + this_id_number).addClass('disabled-form-element');
			$('#hook-' + this_id_number + ' .dynamik-custom-hook-option').css('min-height', '180px');
			$('#custom-hook-textarea-' + this_id_number).animate({'height': 'show'}, { duration: 300 });
		} else if(value == 'css') {
			$('#hook-' + this_id_number + ' label:contains("Name")').css('opacity', '1');
			$('#hook-' + this_id_number + ' label:contains("Hook")').css('opacity', '0.2');
			$('#hook-' + this_id_number + ' label:contains("Priority")').css('opacity', '1');
			$('#hook-' + this_id_number + ' label:contains("Conditionals")').css('opacity', '1');
			$('#hook-' + this_id_number + ' label:contains("Hook Box")').css('opacity', '1');
			$('#custom-hook-id-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-hook-hook-' + this_id_number).addClass('disabled-form-element');
			$('#custom-hook-priority-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-hook-conditionals-list-' + this_id_number).removeClass('disabled-form-element');
			$('#hook-' + this_id_number + ' .dynamik-custom-hook-option').css('min-height', '180px');
			$('#custom-hook-textarea-' + this_id_number).animate({'height': 'show'}, { duration: 300 });
		} else if(value == 'no') {
			$('#hook-' + this_id_number + ' label:contains("Name")').css('opacity', '0.2');
			$('#hook-' + this_id_number + ' label:contains("Hook")').css('opacity', '0.2');
			$('#hook-' + this_id_number + ' label:contains("Priority")').css('opacity', '0.2');
			$('#hook-' + this_id_number + ' label:contains("Conditionals")').css('opacity', '0.2');
			$('#hook-' + this_id_number + ' label:contains("Hook Box")').css('opacity', '1');
			$('#custom-hook-id-' + this_id_number).addClass('disabled-form-element');
			$('#custom-hook-hook-' + this_id_number).addClass('disabled-form-element');
			$('#custom-hook-priority-' + this_id_number).addClass('disabled-form-element');
			$('#custom-hook-conditionals-list-' + this_id_number).addClass('disabled-form-element');
			$('#hook-' + this_id_number + ' .dynamik-custom-hook-option').css('min-height', '79px');
			$('#custom-hook-textarea-' + this_id_number).animate({'height': 'hide'}, { duration: 300 });
		} else {
			$('#hook-' + this_id_number + ' label:contains("Name")').css('opacity', '1');
			$('#hook-' + this_id_number + ' label:contains("Hook")').css('opacity', '1');
			$('#hook-' + this_id_number + ' label:contains("Priority")').css('opacity', '1');
			$('#hook-' + this_id_number + ' label:contains("Conditionals")').css('opacity', '1');
			$('#hook-' + this_id_number + ' label:contains("Hook Box")').css('opacity', '1');
			$('#custom-hook-id-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-hook-hook-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-hook-priority-' + this_id_number).removeClass('disabled-form-element');
			$('#custom-hook-conditionals-list-' + this_id_number).removeClass('disabled-form-element');
			$('#hook-' + this_id_number + ' .dynamik-custom-hook-option').css('min-height', '180px');
			$('#custom-hook-textarea-' + this_id_number).animate({'height': 'show'}, { duration: 300 });
		}
	});
	$('.custom-hook-status').change();
	
	$('.wrap').on('click', '.delete-hook', function () {
		var numb = $(this).attr('id');
		var hook_name = $('#custom-hook-id-' + numb).val();
		if( hook_name != '' ) {
			var confirm_hook_delete = confirm('Are you sure you want to Delete this Hook Box?');
			if(confirm_hook_delete) {
				var numb = $(this).attr('id');
						
				var data = {
					action: 'dynamik_hook_delete',
					hook_name: hook_name
				};

				jQuery.post(ajaxurl, data, function(response) {
				});
				
				$('#hook-' + numb).empty().remove();
				
				setTimeout( function() {
					$('.dynamik-save-button').click();
				}, 500 );
			}
		} else {
			var cannot_delete_hook = confirm('You cannot delete unsaved Custom Hook Boxes. Instead, reload your Dynamik Custom Options admin page and they will automatically disappear.');
			if(cannot_delete_hook) {
			}
		}
	});

	var conditional_example_insert = function() {
		var example_id = $(this).attr('id');
		var example_class = $(this).attr('class');
		var example_values = $(this).val().split('|');
		if( example_values != 'examples' ) {
			$('#'+example_id.substring(3)).val(example_values[0]);
			$('#'+example_class.substring(24)).val(example_values[1]);
		}
	}
	
	$('.conditional-examples').bind('change', conditional_example_insert);
	
	$('.add-conditional').click(function() {
		$('.conditional-examples').bind('change', conditional_example_insert);
	});

	// Provide "search as you type" feature for custom options
    $(".custom-search").keyup(function() {

        // Retrieve the input field text
        var filter = $(this).val();
        var $this_id = $(this).attr('id').replace('-search','');

        // Loop through the appropriate custom options
        $('.dynamik-'+$this_id+'-option .searchable').each(function(){
 
            // If the custom option does not contain the text phrase fade it out
            if( $(this).val().search(new RegExp(filter, 'i')) < 0 ) {
            	if( $this_id == 'custom-conditional' ) {
            		$(this).parent().parent().parent().fadeOut();
            	} else {
            		$(this).parent().parent().fadeOut();
            	}
 
            // Show the custom option if the phrase matches
            } else {
            	if( $this_id == 'custom-conditional' ) {
            		 $(this).parent().parent().parent().show();
            	} else {
            		 $(this).parent().parent().show();
            	}
            }
        });

    });

	var css_builder_active = $('#dynamik-css-builder-popup-active:checked').val();
	if( css_builder_active ) {
		$('#css-builder-click-to-view').show();
		$('#dynamik-custom-css-admin-p').hide();
	}
	
	$('.dynamik-save-button').click(function() {
		var css_builder_active = $('#dynamik-css-builder-popup-active:checked').val();
		if( css_builder_active ) {
			$('#css-builder-click-to-view').animate({'height': 'show'}, { duration: 300 });
			$('#dynamik-custom-css-admin-p').animate({'height': 'hide'}, { duration: 300 });
		} else {
			$('#css-builder-click-to-view').animate({'height': 'hide'}, { duration: 300 });
			$('#dynamik-custom-css-admin-p').animate({'height': 'show'}, { duration: 300 });
		}
	});

	$('.dynamik-options-reset-button').click(function() {
		var $this = $(this), font_css_id = $this.attr('id');
		$('#'+font_css_id+'-box').animate({'height': 'toggle'}, { duration: 300 });
		hilight_custom();
	});
	
	$('.dynamik-tabby-textarea').tabby();

	$('.wrap').on('focus', '.dynamik-tabby-textarea-temp', function() {
		$('.dynamik-tabby-textarea-temp').tabby();
		$('.dynamik-tabby-textarea').removeClass('dynamik-tabby-textarea-temp');
	});

});