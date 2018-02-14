(function($) {

	PPAccordion = function( settings )
	{
		this.settings 	= settings;
		this.nodeClass  = '.fl-node-' + settings.id;
		this._init();
	};

	PPAccordion.prototype = {

		settings	: {},
		nodeClass   : '',

		_init: function()
		{
			$( this.nodeClass + ' .pp-accordion-button' ).css('height', $( this.nodeClass + ' .pp-accordion-button' ).outerHeight() + 'px');
			$( this.nodeClass + ' .pp-accordion-button' ).on('click', $.proxy( this._buttonClick, this ) );

			this._openDefaultItem();

			if(location.hash && location.hash.search('pp-accord') !== -1) {
				$(location.hash).find('.pp-accordion-button').trigger('click');
			}
		},

		_buttonClick: function( e )
		{
			var button      = $( e.target ).closest('.pp-accordion-button'),
				accordion   = button.closest('.pp-accordion'),
				item	    = button.closest('.pp-accordion-item'),
				allContent  = accordion.find('.pp-accordion-content'),
				allIcons    = accordion.find('.pp-accordion-button i.pp-accordion-button-icon'),
				content     = button.siblings('.pp-accordion-content'),
				icon        = button.find('i.pp-accordion-button-icon');

			if(accordion.hasClass('pp-accordion-collapse')) {
				accordion.find( '.pp-accordion-item-active' ).removeClass( 'pp-accordion-item-active' );
				allContent.slideUp('normal');
				//allIcons.removeClass('fa-minus');
				//allIcons.addClass('fa-plus');
			}

			if(content.is(':hidden')) {
				item.addClass( 'pp-accordion-item-active' );
				content.slideDown('normal', this._slideDownComplete);
				//icon.addClass('fa-minus');
				//icon.removeClass('fa-plus');
			}
			else {
				item.removeClass( 'pp-accordion-item-active' );
				content.slideUp('normal', this._slideUpComplete);
				//icon.addClass('fa-plus');
				//icon.removeClass('fa-minus');
			}
		},

		_slideUpComplete: function()
		{
			var content 	= $( this ),
				accordion 	= content.closest( '.pp-accordion' );

			accordion.trigger( 'fl-builder.pp-accordion-toggle-complete' );
		},

		_slideDownComplete: function()
		{
			var content 	= $( this ),
				accordion 	= content.closest( '.pp-accordion' ),
				item 		= content.parent(),
				win  		= $( window );

			// Gallery module support.
			FLBuilderLayout.refreshGalleries( content );

			// Content Grid module support.
			if ( 'undefined' !== typeof $.fn.isotope ) {
				content.find('.pp-content-post-grid.pp-masonry-active').isotope('layout');

				var highestBox = 0;
				var contentHeight = 0;

	            content.find('.pp-equal-height .pp-content-post').css('height', '').each(function(){
	                if($(this).height() > highestBox) {
	                	highestBox = $(this).height();
	                	contentHeight = $(this).find('.pp-content-post-data').outerHeight();
	                }
	            });

	            $(this.nodeClass).find('.pp-equal-height .pp-content-post').height(highestBox);
			}

			if ( item.offset().top < win.scrollTop() + 100 ) {
				$( 'html, body' ).animate({
					scrollTop: item.offset().top - 100
				}, 500, 'swing');
			}

			accordion.trigger( 'fl-builder.pp-accordion-toggle-complete' );
		},

		_openDefaultItem: function()
		{
			if(typeof this.settings.defaultItem !== 'undefined') {
				var item = $.isNumeric(this.settings.defaultItem) ? (this.settings.defaultItem - 1) : null;

				if(item !== null) {
					$( this.nodeClass + ' .pp-accordion-button' ).eq(item).trigger('click');
				}
			}
		}
	};

})(jQuery);
