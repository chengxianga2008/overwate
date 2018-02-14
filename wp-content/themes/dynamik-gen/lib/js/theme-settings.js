eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(2($){$.c.f=2(p){p=$.d({g:"!@#$%^&*()+=[]\\\\\\\';,/{}|\\":<>?~`.- ",4:"",9:""},p);7 3.b(2(){5(p.G)p.4+="Q";5(p.w)p.4+="n";s=p.9.z(\'\');x(i=0;i<s.y;i++)5(p.g.h(s[i])!=-1)s[i]="\\\\"+s[i];p.9=s.O(\'|\');6 l=N M(p.9,\'E\');6 a=p.g+p.4;a=a.H(l,\'\');$(3).J(2(e){5(!e.r)k=o.q(e.K);L k=o.q(e.r);5(a.h(k)!=-1)e.j();5(e.u&&k==\'v\')e.j()});$(3).B(\'D\',2(){7 F})})};$.c.I=2(p){6 8="n";8+=8.P();p=$.d({4:8},p);7 3.b(2(){$(3).f(p)})};$.c.t=2(p){6 m="A";p=$.d({4:m},p);7 3.b(2(){$(3).f(p)})}})(C);',53,53,'||function|this|nchars|if|var|return|az|allow|ch|each|fn|extend||alphanumeric|ichars|indexOf||preventDefault||reg|nm|abcdefghijklmnopqrstuvwxyz|String||fromCharCode|charCode||alpha|ctrlKey||allcaps|for|length|split|1234567890|bind|jQuery|contextmenu|gi|false|nocaps|replace|numeric|keypress|which|else|RegExp|new|join|toUpperCase|ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('|'),0,{}));

jQuery(document).ready(function($) {

	// Variables
	var dynamik_options_nav_all = $('.dynamik-options-nav-all');
	var dynamik_all_options = $('.dynamik-all-options');
	
	dynamik_options_nav_all.click(function() {
		var nav_id = $(this).attr('id');
		dynamik_all_options.hide();
		$('#'+nav_id+'-box').show();
		dynamik_options_nav_all.removeClass('dynamik-options-nav-active');
		$('#'+nav_id).addClass('dynamik-options-nav-active');
	});
	
	function show_message(response) {
		$('.dynamik-ajax-save-spinner').hide();
		$('.dynamik-saved').html(response).fadeIn('slow');
		window.setTimeout(function(){
			$('.dynamik-saved').fadeOut('slow'); 
		}, 2222);
	}
	
	$('form#theme-settings-form').submit(function() {
		$('.dynamik-ajax-save-spinner').show();
		var dynamik_data = $(this).serialize();
		jQuery.post(ajaxurl, dynamik_data, function(response) {
			if(response) {
				show_message(response);
			}
		});
		return false;
	});

	$('.forbid-chars').on('keydown', function() {
		if (!$(this).data('init')) {
			$(this).data('init', true);
			$(this).alphanumeric({allow:'_',nocaps:false});
			$(this).trigger('keydown');
		}
	});
	
	$('#dynamik-remove-all-page-titles').change(function() {
		var remove_all_page_titles = $('#dynamik-remove-all-page-titles:checked').val();
		if( remove_all_page_titles ) {
			$('#dynamik-remove-all-page-titles-box').animate({'height': 'hide'}, { duration: 300 });
		} else {
			$('#dynamik-remove-all-page-titles-box').animate({'height': 'show'}, { duration: 300 });
		}
	});
	$('#dynamik-remove-all-page-titles').change();

	$('#content-page-ids').click(function() {
		$('#content-page-ids-box').animate({'height': 'toggle'}, { duration: 300 });
	});

	$('#dynamik-include-inpost-cpt-all').change(function() {
		var include_inpost_cpt_all = $('#dynamik-include-inpost-cpt-all:checked').val();
		if( include_inpost_cpt_all ) {
			$('#dynamik-include-inpost-cpt-all-box').animate({'height': 'hide'}, { duration: 300 });
		} else {
			$('#dynamik-include-inpost-cpt-all-box').animate({'height': 'show'}, { duration: 300 });
		}
	});
	$('#dynamik-include-inpost-cpt-all').change();

	$('#custom-post-type-names').click(function() {
		$('#custom-post-type-names-box').animate({'height': 'toggle'}, { duration: 300 });
	});

	$('#dynamik-html-five-active').change(function() {
		var html_file_active = $('#dynamik-html-five-active:checked').val();
		if( html_file_active ) {
			$('#dynamik-fancy-dropdowns-active-box').animate({'height': 'show'}, { duration: 300 });
		} else {
			$('#dynamik-fancy-dropdowns-active-box').animate({'height': 'hide'}, { duration: 300 });
		}
	});
	$('#dynamik-html-five-active').change();

	$('#settings-export-check-all').click( function() {
		$('.settings-export-check').attr('checked', true);
	});
	
	$('#settings-export-uncheck-all').click( function() {
		$('.settings-export-check').attr('checked', false);
	});

	$('#settings-import-check-all').click( function() {
		$('.settings-import-check').attr('checked', true);
	});
	
	$('#settings-import-uncheck-all').click( function() {
		$('.settings-import-check').attr('checked', false);
	});

	$('.dynamik-options-reset-button').click(function() {
		var $this = $(this), font_css_id = $this.attr('id');
		$('#'+font_css_id+'-box').animate({'height': 'toggle'}, { duration: 300 });
		hilight_custom();
	});

});