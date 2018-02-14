jQuery(document).ready(function($) {
	
	$('body').addClass('dynamik-fe-css-builder');
	
	$('.dynamik-fe-css-builder-elements-select').each(function() {
		var menu_id = $(this).attr('id');
		this.menu_array = [];
		var menu_li = this;
		$('#'+menu_id+' optgroup option').each(function() {
			var option = $(this).text();
			menu_li.menu_array.push(option);
		});
		
		var menu_li_li = '';
		
		$.each(this.menu_array, function() {
			menu_li_li += '<li>'+this+'</li>';
		});
		
		var menu_optgroup = $('#'+menu_id+' optgroup').attr('label');
		
		var menu_li_open = '		<ul id="'+menu_id+'_ul" class="dynamik-fe-css-builder-elements-select-ul"> \
    <li> \
        <span>'+$('#'+menu_id).find('option:first').text()+'</span> \
        <ul>';
        
		var menu_li_close = '		</ul> \
    </li> \
</ul>';
			
		$(this).after(menu_li_open+'\n'+menu_li_li+'\n'+menu_li_close+'\n');
	});

	var dynamik_fe_css_builder_toggle_handler = function (event) {
		var clickCounter = $('#dynamik-fe-css-builder-css').data('clickCounter') || 0;
		
		if ( clickCounter == 0 ) {
			$('body').addClass('dynamik-fe-css-builder-active');
			$('#dynamik-fe-css-builder').animate({'height': 'show'}, { duration: 300 });
			var css_editor_h3_draggable_mouseenter = function() {
				$('#dynamik-fe-css-builder').draggable();
				$('#dynamik-fe-css-builder').draggable( 'enable' );
				$('#dynamik-fe-css-builder').draggable();
			};
			var css_editor_h3_draggable_mouseleave = function() {
				$('#dynamik-fe-css-builder').draggable();
				$('#dynamik-fe-css-builder').draggable( 'disable' );
				$('#dynamik-fe-css-builder').draggable();
			};
			$('#dynamik-fe-css-builder').addClass('dynamik-fe-css-builder-draggable');
			$('#dynamik-fe-css-builder h3').bind('mouseenter', css_editor_h3_draggable_mouseenter);
			$('#dynamik-fe-css-builder h3').bind('mouseleave', css_editor_h3_draggable_mouseleave);
			clickCounter = 1;
		} else {
			$('body').removeClass('dynamik-fe-css-builder-active');
			$('#dynamik-fe-css-builder').animate({'height': 'hide'}, { duration: 300 });
			clickCounter = 0;
		}
		
		$('#dynamik-fe-css-builder-css').data('clickCounter', clickCounter);
	};
	
	$('#dynamik-fe-css-builder-css').bind('click', dynamik_fe_css_builder_toggle_handler).one('click', dynamik_fe_css_builder_activate);
	$('#dynamik-fe-style-editor-css-builder-toggle-icon').one('click', dynamik_fe_css_builder_activate);

	function dynamik_fe_css_builder_activate() {
		
		function dynamik_fe_css_builder_string_between(string, start_needle, end_needle) {
			var start_pos = string.indexOf(start_needle) + 1;
			var end_pos = string.indexOf(end_needle,start_pos);
			var result = string.substring(start_pos,end_pos);
			return result;
		}
		
		if($('link[href*="//fonts.googleapis.com"][rel!="dns-prefetch"]').length) {
			$('#font_type').append($('<optgroup></optgroup>').attr('label','Available Google Fonts'));
			
			$('link[href*="//fonts.googleapis.com"][rel!="dns-prefetch"]').each(function() {
				var gfont_href = decodeURIComponent($(this).attr('href')).replace(/\+/g, ' ');
				var gfont = '';
				if(gfont_href.indexOf('&') > -1) {
					gfont = dynamik_fe_css_builder_string_between(gfont_href, '=', '&');
				} else {
					gfont = gfont_href.substr(gfont_href.indexOf('=') + 1);
				}
				var gfont_arr = gfont.split('|');
				
				$.each(gfont_arr, function( index, value ) {
					var gfont = value.substr(0, value.indexOf(':'));
					$('#font_type optgroup[label="Available Google Fonts"]').append($('<option></option>').attr('value','\''+gfont+'\', sans-serif').text(gfont));
				});
			});
		} else {
			$('#font_type').append($('<optgroup></optgroup>').attr('label','No Google Fonts Available'));
		}
		
		$('#dynamik-fe-css-builder').addClass('dynamik-fe-css-builder-element');
		$('#dynamik-fe-css-builder *').addClass('dynamik-fe-css-builder-element');
		
		$('.dynamik-fe-css-builder-elements-select-ul').dropit();
		
		$('#dynamik-fe-css-builder-container .dynamik-fe-css-builder-elements-select-ul li ul li').hover(function() {
			var menu_id = $(this).parent().parent().parent().attr('id').slice(0,-3);
			var menu_text = $(this).text();
			$('#'+menu_id+' option').filter(function(index) { return $(this).text() === menu_text; }).attr('selected', 'selected').trigger('change');
		});
		
		$('#dynamik-fe-css-builder-container .dynamik-fe-css-builder-elements-select-ul li ul li').click(function() {
			$($(this).parent().parent().find('span')).text($(this).text());
		});
		
		/* Genesis Labels */
		function dynamik_fe_css_builder_genesis_element_labels_append() {
			$('.site-container').css('position', 'relative').append('<span id="page-label" class="element-labels element-label-right dashicons dashicons-admin-customizer" title=".site-container"></span>');
			$('.site-header').css('position', 'relative').append('<span id="header-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".site-header"></span>');
			$('.site-header .genesis-nav-menu').css('position', 'relative').append('<span id="header-menu-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".site-header .genesis-nav-menu"></span>');
			$('.nav-primary').css('position', 'relative').append('<span id="primary-menu-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".nav-primary"></span>');
			$('.nav-secondary').css('position', 'relative').append('<span id="secondary-menu-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".nav-secondary"></span>');
			$('.archive-description').css('position', 'relative').append('<span id="archive-description-label" class="element-labels element-label-right dashicons dashicons-admin-customizer" title=".archive-description"></span>');
			$('.breadcrumb').css('position', 'relative').append('<span id="breadcrumb-label" class="element-labels element-label-right dashicons dashicons-admin-customizer" title=".breadcrumb"></span>');
			$('.content').css('position', 'relative').append('<span id="content-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".content"></span>');
			$('.entry-header').css('position', 'relative').append('<span id="content-header-label" class="element-labels element-label-right dashicons dashicons-admin-customizer" title=".entry-header"></span>');
			$('.content blockquote').css('position', 'relative').append('<span id="content-blockquote-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".content blockquote"></span>');
			$('.entry-footer .entry-meta').css('position', 'relative').append('<span id="post-meta-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".entry-footer .entry-meta"></span>');
			$('.featured-content').css('position', 'relative').append('<span id="featured-content-label" class="element-labels element-label-right dashicons dashicons-admin-customizer" title=".featured-content"></span>');
			$('.author-box').css('position', 'relative').append('<span id="author-box-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".author-box"></span>');
			$('.after-entry').css('position', 'relative').append('<span id="after-entry-widget-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".after-entry"></span>');
			$('#comments').css('position', 'relative').append('<span id="comment-label" class="element-labels element-label-right dashicons dashicons-admin-customizer" title="#comments"></span>');
			$('#respond').css('position', 'relative').append('<span id="comment-respond-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title="#respond"></span>');
			$('.sidebar').css('position', 'relative').append('<span id="sidebar-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".sidebar"></span>');
			$('#home-hook-wrap').css('position', 'relative').append('<span id="ez-home-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title="#home-hook-wrap"></span>');
			$('#ez-home-sidebar-wrap').css('position', 'relative').append('<span id="ez-home-sidebar-label" class="element-labels element-label-right dashicons dashicons-admin-customizer" title="#ez-home-sidebar-wrap"></span>');
			$('#ez-feature-top-container-wrap').css('position', 'relative').append('<span id="ez-feature-top-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title="#ez-feature-top-container-wrap"></span>');
			$('#ez-fat-footer-container-wrap').css('position', 'relative').append('<span id="ez-fat-footer-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title="#ez-fat-footer-container-wrap"></span>');
			$('.dynamik-widget-area').css('position', 'relative').append('<span id="custom-widget-area-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".dynamik-widget-area"></span>');
			$('.footer-widgets').css('position', 'relative').append('<span id="genesis-footer-widget-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".footer-widgets"></span>');
			$('.site-footer').css('position', 'relative').append('<span id="footer-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".site-footer"></span>');
		};
		
		function dynamik_fe_css_builder_genesis_element_labels_disable() {
			$('.site-container').css('position', '');
			$('.site-header').css('position', '');
			$('.site-header .genesis-nav-menu').css('position', '');
			$('.nav-primary').css('position', '');
			$('.nav-secondary').css('position', '');
			$('.content').css('position', '');
			$('.breadcrumb').css('position', '');
			$('.archive-description').css('position', '');
			$('.author-box').css('position', '');
			$('.featured-content').css('position', '');
			$('.sidebar').css('position', '');
			$('#comments').css('position', '');
			$('#respond').css('position', '');
			$('#home-hook-wrap').css('position', '');
			$('#ez-home-sidebar-wrap').css('position', '');
			$('#ez-feature-top-container-wrap').css('position', '');
			$('#ez-fat-footer-container-wrap').css('position', '');
			$('.dynamik-widget-area').css('position', '');
			$('.footer-widgets').css('position', '');
			$('.site-footer').css('position', '');
		};
		
		var dynamik_fe_css_builder_element_selectors_enable_handler = function() {
			var clickCounter = $('#dynamik-fe-css-builder-element-selectors-icon').data('clickCounter') || 0;
			
			if ( clickCounter == 0 ) {
				$('#dynamik-fe-css-builder-element-selectors-icon').addClass('element_selectors_enabled');
				dynamik_fe_css_builder_genesis_element_labels_append();
				$('.element-labels').click(function() {
					$('.dynamik-fe-css-builder-elements-select').change();
					$('#dynamik-fe-css-builder-nav-open-close-elements').click();
					var element_label_id = $(this).attr('id');
					var element_label_id_select = element_label_id.replace(/-/g, '_').slice(0,-5);
					$('.all-labeled-elements').hide();
					$('#'+element_label_id_select+'elements').show();
					var value = $(this).attr('title') + ' {';
					var styles = ' background: #DDFFDD !important;';
					$('#dynamik-fe-css-builder-highlight-css').html('');
					$('#dynamik-fe-css-builder-highlight-css').html('<style type="text/css">' + value + styles + '}</style>');
					setTimeout(function(){
						$('#dynamik-fe-css-builder-highlight-css').html('');
					}, 1500);
				});
				clickCounter = 1;
			} else {
				$('#dynamik-fe-css-builder-element-selectors-icon').removeClass('element_selectors_enabled');
				dynamik_fe_css_builder_genesis_element_labels_disable();
				$('.element-labels').remove();
				clickCounter = 0;
			}
			
			$('#dynamik-fe-css-builder-element-selectors-icon').data('clickCounter', clickCounter);
		};
		
		$('#dynamik-fe-css-builder-element-selectors-icon').bind('click', dynamik_fe_css_builder_element_selectors_enable_handler);
		
		$('.labeled-elements-button').click(function() {
			element_selectors_enabled_check();
		});
		
		$('#font_unit').change(function() {
			var font_unit = $(this).val();
			var font_size = $('#font_size').val();
			if(font_unit == 'rem') {
				$('#font_size').val(font_size / 10 );
			} else {
				$('#font_size').val(font_size * 10);
			}
		});
		
		$('.dynamik-fe-css-builder-css-builder-nav-all').click(function() {
			var css_nav_id = $(this).attr('id');
			$('.dynamik-fe-css-builder-all-css-builder').hide();
			$('#'+css_nav_id+'-box').show();
			$('.dynamik-fe-css-builder-css-builder-nav-all').removeClass('dynamik-fe-css-builder-options-nav-active');
			$('#'+css_nav_id).addClass('dynamik-fe-css-builder-options-nav-active');
		});
		
		$('#dynamik-fe-css-builder-output-cut-button').click(function() {
			$('#dynamik-fe-css-builder-nav-open-close-elements').click();
			$('#dynamik-fe-css-builder-css').html('<span class="dashicons dashicons-sos"></span><style id="css-builder-editor-css-style" type="text/css"></style>');
		});
		
		$('.dynamik-fe-css-builder-elements-select').change(function () {
			var value = $(this).val() || [];
			var styles = ' background: #DDFFDD !important;';
			$('#dynamik-fe-css-builder-highlight-css').html('<style type="text/css">' + value + styles + '}</style>');
		});
		
		$('#dynamik-fe-css-builder-container').show();
	    $('#dynamik-fe-css-builder-style-editor-toggle-icon').click(function() {
	    	element_selectors_enabled_check();
	    	$('#dynamik-fe-css-builder-highlight-css').html('');
	    	$('#dynamik-fe-css-builder-container').hide();
	    	$('body').removeClass('dynamik-fe-css-builder-active');
	    	$('#dynamik-fe-style-editor-form').show();
	    	$('body').addClass('dynamik-fe-style-editor-active');
	    });
	    
		function element_selectors_enabled_check() {
			if ( $('#dynamik-fe-css-builder-element-selectors-icon').hasClass('element_selectors_enabled') ) {
				$('#dynamik-fe-css-builder-element-selectors-icon').click();
			} else if ( $('#dynamik-fe-css-builder-bb-theme-element-selectors-icon').hasClass('element_selectors_enabled') ) {
				$('#dynamik-fe-css-builder-bb-theme-element-selectors-icon').click();
			} else if ( $('#dynamik-fe-css-builder-twentysixteen-element-selectors-icon').hasClass('element_selectors_enabled') ) {
				$('#dynamik-fe-css-builder-twentysixteen-element-selectors-icon').click();
			}
		}
		
		function dynamik_fe_css_builder_css_change() {
			var css = $('#dynamik-fe-css-builder-output').val();
			$('#dynamik-fe-css-builder-highlight-css').html('');
			$('#dynamik-fe-css-builder-css').html('<span class="dashicons dashicons-sos"></span><style id="css-builder-editor-css-style" type="text/css">' + css + '</style>');
		}
		
		$('#dynamik-fe-css-builder-output').bind('keyup paste', function(e) {
			if (e.type == 'paste') {
				setTimeout(dynamik_fe_css_builder_css_change, 20);
			} else {
				dynamik_fe_css_builder_css_change();
			}
		});

		$('.dynamik-fe-css-builder-buttons').click(function() {
			dynamik_fe_css_builder_css_change();
			$('#dynamik-fe-css-builder-output-cut-button').show();
			$('#dynamik-fe-css-builder-output-copied-button').hide();
			$('.code-builder-output-cut').removeClass('code-builder-output-cut-copied');
		});
		
		$('.dynamik-fe-css-builder-elements-select').change(function() {
			var css = $('#dynamik-fe-css-builder-output').val();
			var new_css = css.replace(/\n\n}/g,'\n}');
			$('#dynamik-fe-css-builder-output').val(new_css);
		});
		
		$('.dynamik-fe-css-builder-button-elements').click(function() {
			var css_length = $('#dynamik-fe-css-builder-output').val().length;
			var css_cursor_position = css_length - 3;
			$('#dynamik-fe-css-builder-output').selectRange(css_cursor_position,css_cursor_position);
			$('#dynamik-fe-css-builder-output-cut-button').show();
			$('#dynamik-fe-css-builder-output-copied-button').hide();
		});
	}
	
	/***
		Genesis Hooks Map
							***/
	var show_hide_bb_hooks_map_toggle_handler = function (event) {
		var clickCounter = $(event.target).data('clickCounter') || 0;
		
		if ( clickCounter == 0 ) {
			$('.dynamik-mapped-hooks').addClass('dynamik-mapped-hooks-styles').each(function(i){
			    var mapped_hook_id = $(this).attr('id');
			    $(this).text('Hook: '+mapped_hook_id);
			});
			clickCounter = 1;
		} else {
			$('.dynamik-mapped-hooks').empty().removeClass('dynamik-mapped-hooks-styles');
			clickCounter = 0;
		}
		
		$(event.target).data('clickCounter', clickCounter);
	};
		
	$('#css-builder-hooks-map').bind('click', show_hide_bb_hooks_map_toggle_handler);
	/***
		END BB Theme Hooks Map
								***/
	
});