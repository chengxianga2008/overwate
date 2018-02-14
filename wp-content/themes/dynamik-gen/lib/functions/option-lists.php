<?php
/**
 * Builds many of the admin options drop-down lists.
 *
 * @package Dynamik
 */

/**********
CSS Builder Elements
           **********/

/**
 * Build main Elements Selector option list.
 *
 * @since 1.0.0
 * @return main Elements Selector option array.
 */
function dynamik_css_builder_elements_array() {
	
	$dynamik_css_builder_elements = array(
		'Page Elements' => 'page',
		'Header' => 'header',
		'Header Menu' => 'header_menu',
		'Primary Menu' => 'primary_menu',
		'Secondary Menu' => 'secondary_menu',
		'Content' => 'content',
		'Breadcrumbs' => 'breadcrumbs',
		'Archive Description' => 'archive_description',
		'Author Box' => 'author_box',
		'Featured Content' => 'featured_content',
		'Sidebars' => 'sidebar',
		'Comments' => 'comment',
		'Comment Respond' => 'comment_respond',
		'EZ Feature Top' => 'ez_feature_top',
		'EZ Fat Footer' => 'ez_fat_footer',
		'EZ Home' => 'ez_home',
		'EZ Home Sidebar' => 'ez_home_sidebar',
		'EZ Home Slider' => 'ez_home_slider',
		'Custom Widget Areas' => 'custom_widget_areas',
		'Genesis Footer Widgets' => 'genesis_footer_widget',
		'Footer' => 'footer'
	);
	
	return $dynamik_css_builder_elements;
	
}

/**
 * Build main Elements Selector option menu.
 *
 * @since 1.0.0
 */
function dynamik_build_css_builder_elements_menu( $selected = '' ) {
	
	$dynamik_css_builder_elements_array = dynamik_css_builder_elements_array();
	
	foreach( $dynamik_css_builder_elements_array as $element_type => $elements ) {
		
		$option = '<option value="' . $elements . '"';
			
		if ( $elements == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $element_type . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Build Page CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Page CSS elements array.
 */
function dynamik_page_elements_array() {
	
	$dynamik_page_elements_array = array(
		'-- Page Elements --' => array(
			'HTML' => '/* HTML */' . "\n" . 'html',
			'Body' => '/* Body */' . "\n" . 'body',
			'Universal Link' => '/* Universal Link */' . "\n" . 'a, a:visited',
			'Universal Link Hover' => '/* Universal Link Hover */' . "\n" . 'a:hover',
			'Universal Headings' => '/* Universal Headings */' . "\n" . 'h1, h2, h3, h4, h5, h6',
			'H1 Headings' => '/* H1 Headings */' . "\n" . 'h1',
			'H2 Headings' => '/* H2 Headings */' . "\n" . 'h2',
			'H3 Headings' => '/* H3 Headings */' . "\n" . 'h3',
			'H4 Headings' => '/* H4 Headings */' . "\n" . 'h4',
			'H5 Headings' => '/* H5 Headings */' . "\n" . 'h5',
			'H6 Headings' => '/* H6 Headings */' . "\n" . 'h6'
		),
		'-- Images / Alignment --' => array(
			'Image Align None' => '/* Image Align None */' . "\n" . 'img.alignnone',
			'Image Align Left' => '/* Image Align Left */' . "\n" . 'img.alignleft',
			'Image Align Center' => '/* Image Align Center */' . "\n" . 'img.centered',
			'Image Align Right' => '/* Image Align Right */' . "\n" . 'img.alignright',
			'Image WP Smiley' => '/* Image WP Smiley */' . "\n" . 'img.wp-smiley, img.wp-wink',
			'Align Left' => '/* Align Left */' . "\n" . '.alignleft',
			'Align Center' => '/* Align Center */' . "\n" . '.aligncenter',
			'Align Right' => '/* Align Right */' . "\n" . '.alignright',
			'WP Caption' => '/* WP Caption */' . "\n" . '.wp-caption',
			'WP Caption Text' => '/* WP Caption Text */' . "\n" . 'p.wp-caption-text',
			'Thumbnail Image' => '/* Thumbnail Image */' . "\n" . '.attachment-thumbnail',
			'Post Format Image' => '/* Post Format Image */' . "\n" . '.post-format-image'
		),
		'-- Forms --' => array(
			'Input/Select/Textarea' => '/* Input/Select/Textarea */' . "\n" . 'input, select, textarea',
			'Input/Textarea Focus' => '/* Input/Textarea Focus */' . "\n" . 'input:focus, textarea:focus',
			'Buttons' => '/* Buttons */' . "\n" . 'button, input[type=&#34;button&#34;], input[type=&#34;reset&#34;], input[type=&#34;submit&#34;], .button',
			'Buttons Hover' => '/* Buttons Hover */' . "\n" . 'button:hover, input:hover[type=&#34;button&#34;], input:hover[type=&#34;reset&#34;], input:hover[type=&#34;submit&#34;], .button:hover, button:focus, input:focus[type=&#34;button&#34;], input:focus[type=&#34;reset&#34;], input:focus[type=&#34;submit&#34;], .button:focus',
			'Content Button Hover' => '/* Content Button Hover */' . "\n" . '.entry-content .button:hover, .entry-content .button:focus',
			'Button Small' => '/* Button Small */' . "\n" . 'a.button.small, button.small, input[type=&#34;button&#34;].small, input[type=&#34;reset&#34;].small, input[type=&#34;submit&#34;].small',
			'Button Disabled' => '/* Button Disabled */' . "\n" . '.site-container button:disabled, .site-container button:disabled:hover, .site-container input:disabled, .site-container input:disabled:hover, .site-container input[type=&#34;button&#34;]:disabled, .site-container input[type=&#34;button&#34;]:disabled:hover, .site-container input[type=&#34;reset&#34;]:disabled, .site-container input[type=&#34;reset&#34;]:disabled:hover, .site-container input[type=&#34;submit&#34;]:disabled, .site-container input[type=&#34;submit&#34;]:disabled:hover'
		),
		'-- Tables --' => array(
			'Table' => '/* Table */' . "\n" . 'table',
			'Table Body' => '/* Table Body */' . "\n" . 'tbody',
			'Table Standard/Header Cells' => '/* Table Standard/Header Cells */' . "\n" . 'td, th',
			'Table Standard Cells' => '/* Table Standard Cells */' . "\n" . 'td',
			'Table Header Cells' => '/* Table Header Cells */' . "\n" . 'th',
			'Table Standard/Header Cells first-child' => '/* Table Standard/Header Cells first-child */' . "\n" . 'td:first-child, th:first-child'
		),
		'-- Containers --' => array(
			'HTML' => '/* HTML */' . "\n" . 'html',
			'Body' => '/* Body */' . "\n" . 'body',
			'Site Container' => '/* Page Container */' . "\n" . '.site-container',
			'Site Inner' => '/* Site Inner */' . "\n" . '.site-inner',
			'Landing Page Site Inner' => '/* Landing Page Site Inner */' . "\n" . '.landing-page .site-inner',
			'Wrap Class' => '/* Wrap Class */' . "\n" . '.wrap',
			'Content Sidebar Wrap' => '/* Content Sidebar Wrap */' . "\n" . '.content-sidebar-wrap'
		)
	);
	
	return $dynamik_page_elements_array;
	
}

/**
 * Build Header CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Header CSS elements array.
 */
function dynamik_header_elements_array() {
	
	$dynamik_header_elements_array = array(
		'-- Header --' => array(
			'Header' => '/* Header */' . "\n" . '.site-header',
			'Header Wrap' => '/* Header Wrap */' . "\n" . '.site-header > .wrap',
			'Title Area' => '/* Title Area */' . "\n" . '.title-area',
			'Site Title' => '/* Site Title */' . "\n" . '.site-title',
			'Site Title Link' => '/* Site Title Link */' . "\n" . '.site-title a, .site-title a:visited',
			'Site Title Link Hover' => '/* Site Title Link Hover */' . "\n" . '.site-title a:hover, .site-title a:focus',
			'Site Description' => '/* Site Description */' . "\n" . '.site-description',
			'Logo Image Area' => '/* Logo Image Area */' . "\n" . '.header-image .title-area',
			'Logo Image' => '/* Logo Image */' . "\n" . '.header-image .site-title > a',
			'Header Widget Area' => '/* Header Widget Area */' . "\n" . '.site-header .widget-area'
		)
	);
	
	return $dynamik_header_elements_array;
	
}

/**
 * Build Header Menu CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Header Menu CSS elements array.
 */
function dynamik_header_menu_elements_array() {
	
	$dynamik_header_menu_elements_array = array(
		'-- Header Menu --' => array(
			'Header Menu' => '/* Header Menu */' . "\n" . '.site-header .genesis-nav-menu',
			'Header Menu Page Link' => '/* Header Menu Page Link */' . "\n" . '.site-header .genesis-nav-menu a',
			'Header Menu Page Link Hover' => '/* Header Menu Page Link Hover */' . "\n" . '.site-header .genesis-nav-menu li a:active, .site-header .genesis-nav-menu li a:hover,  .site-header .genesis-nav-menu li a:focus',
			'Header Menu Current Page Link' => '/* Header Menu Current Page Link */' . "\n" . '.site-header .genesis-nav-menu .current_page_item a, .site-header .genesis-nav-menu .current-cat a, .site-header .genesis-nav-menu .current-menu-item a',
			'Header Menu Page Link Hover/Current Page' => '/* Header Menu Page Link Hover/Current Page */' . "\n" . '.site-header .genesis-nav-menu li a:active, .site-header .genesis-nav-menu li a:hover, .site-header .genesis-nav-menu li a:focus,' . "\n" . '.site-header .genesis-nav-menu .current_page_item a, .site-header .genesis-nav-menu .current-cat a, .site-header .genesis-nav-menu .current-menu-item a',
			'Header Menu Page jQuery Sub-Indicator' => '/* Header Menu Page jQuery Sub-Indicator */' . "\n" . '.site-header .genesis-nav-menu li a .sf-sub-indicator, .site-header .genesis-nav-menu li li a .sf-sub-indicator, .site-header .genesis-nav-menu li li li a .sf-sub-indicator',
			'Header Menu Sub-Menu' => '/* Header Menu Sub-Menu */' . "\n" . '.site-header .genesis-nav-menu .sub-menu',
			'Header Menu Sub-Menu Link' => '/* Header Menu Sub-Menu Link */' . "\n" . '.site-header .genesis-nav-menu .sub-menu a, .site-header .genesis-nav-menu .sub-menu a:link, .site-header .genesis-nav-menu .sub-menu a:visited',
			'Header Menu Sub-Menu Link Hover' => '/* Header Menu Sub-Menu Link Hover */' . "\n" . '.site-header .genesis-nav-menu .sub-menu a:active, .site-header .genesis-nav-menu .sub-menu a:hover'
		)
	);
	
	return $dynamik_header_menu_elements_array;
	
}

/**
 * Build Primary Menu CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Primary Menu CSS elements array.
 */
function dynamik_primary_menu_elements_array() {
	
	$dynamik_primary_menu_elements_array = array(
		'-- Primary Menu --' => array(
			'Primary Nav' => '/* Primary Nav */' . "\n" . '.nav-primary',
			'Primary Nav Menu' => '/* Primary Nav Menu */' . "\n" . '.menu-primary',
			'Primary Nav Page Link' => '/* Primary Nav Page Link */' . "\n" . '.menu-primary a',
			'Primary Nav Page Link Hover' => '/* Primary Nav Page Link Hover */' . "\n" . '.menu-primary li a:active, .menu-primary li a:hover, .menu-primary li a:focus',
			'Primary Nav Current Page Link' => '/* Primary Nav Current Page Link */' . "\n" . '.menu-primary .current_page_item a, .menu-primary .current-cat a, .menu-primary .current-menu-item a',
			'Primary Nav Page Link Hover/Current Page' => '/* Primary Nav Page Link Hover/Current Page */' . "\n" . '.menu-primary li a:active, .menu-primary li a:hover, .menu-primary li a:focus,' . "\n" . '.menu-primary .current_page_item a, .menu-primary .current-cat a, .menu-primary .current-menu-item a',
			'Primary Nav Page jQuery Sub-Indicator' => '/* Primary Nav Page jQuery Sub-Indicator */' . "\n" . '.menu-primary li a .sf-sub-indicator, .menu-primary li li a .sf-sub-indicator, .menu-primary li li li a .sf-sub-indicator',
			'Primary Nav Sub-Menu' => '/* Primary Nav Sub-Menu */' . "\n" . '.menu-primary .sub-menu',
			'Primary Nav Sub-Menu Link' => '/* Primary Nav Sub-Menu Link */' . "\n" . '.menu-primary .sub-menu a, .menu-primary .sub-menu a:link, .menu-primary .sub-menu a:visited',
			'Primary Nav Sub-Menu Link Hover' => '/* Primary Nav Sub-Menu Link Hover */' . "\n" . '.menu-primary .sub-menu a:active, .menu-primary .sub-menu a:hover',
			'Primary Nav Right' => '/* Primary Nav Right */' . "\n" . '.genesis-nav-menu li.right',
			'Primary Nav Right Search' => '/* Primary Nav Right Search */' . "\n" . '.genesis-nav-menu li.search',
			'Primary Nav Right RSS' => '/* Primary Nav Right RSS */' . "\n" . '.genesis-nav-menu li.rss a',
			'Primary Nav Right Twitter' => '/* Primary Nav Right Twitter */' . "\n" . '.genesis-nav-menu li.twitter a',
			'Primary Nav Right Link' => '/* Primary Nav Right Link */' . "\n" . '.genesis-nav-menu li.right a, .genesis-nav-menu li.right a:visted',
			'Primary Nav Right Link Hover' => '/* Primary Nav Right Link Hover */' . "\n" . '.genesis-nav-menu li.right a:hover'
		)
	);
	
	return $dynamik_primary_menu_elements_array;
	
}

/**
 * Build Secondary Menu CSS elements drop-down list.
 *
 * @since 1.0
 * @return Secondary Menu CSS elements array.
 */
function dynamik_secondary_menu_elements_array() {
	
	$dynamik_secondary_menu_elements_array = array(
		'-- Secondary Menu --' => array(
			'Secondary Nav' => '/* Secondary Nav */' . "\n" . '.nav-secondary',
			'Secondary Nav Menu' => '/* Secondary Nav Menu */' . "\n" . '.menu-secondary',
			'Secondary Nav Page Link' => '/* Secondary Nav Page Link */' . "\n" . '.menu-secondary a',
			'Secondary Nav Page Link Hover' => '/* Secondary Nav Page Link Hover */' . "\n" . '.menu-secondary li a:active, .menu-secondary li a:hover, .menu-secondary li a:focus',
			'Secondary Nav Current Page Link' => '/* Secondary Nav Current Page Link */' . "\n" . '.menu-secondary .current_page_item a, .menu-secondary .current-cat a, .menu-secondary .current-menu-item a',
			'Secondary Nav Page Link Hover/Current Page' => '/* Secondary Nav Page Link Hover/Current Page */' . "\n" . '.menu-secondary li a:active, .menu-secondary li a:hover, .menu-secondary li a:focus,' . "\n" . '.menu-secondary .current_page_item a, .menu-secondary .current-cat a, .menu-secondary .current-menu-item a',
			'Secondary Nav Page jQuery Sub-Indicator' => '/* Secondary Nav Page jQuery Sub-Indicator */' . "\n" . '.menu-secondary li a .sf-sub-indicator, .menu-secondary li li a .sf-sub-indicator, .menu-secondary li li li a .sf-sub-indicator',
			'Secondary Nav Sub-Menu Link' => '/* Secondary Nav Sub-Menu */' . "\n" . '.menu-secondary .sub-menu',
			'Secondary Nav Sub-Menu Link' => '/* Secondary Nav Sub-Menu Link */' . "\n" . '.menu-secondary .sub-menu a, .menu-secondary .sub-menu a:link, .menu-secondary .sub-menu a:visited',
			'Secondary Nav Sub-Menu Link Hover' => '/* Secondary Nav Sub-Menu Link Hover */' . "\n" . '.menu-secondary .sub-menu a:active, .menu-secondary .sub-menu a:hover'
		),
		'-- Secondary Menu (In Footer) --' => array(
			'Secondary Nav' => '/* Secondary Nav */' . "\n" . '.site-footer .nav-secondary',
			'Secondary Nav Menu' => '/* Secondary Nav Menu */' . "\n" . '.site-footer .menu-secondary',
			'Secondary Nav Page Link' => '/* Secondary Nav Page Link */' . "\n" . '.site-footer .menu-secondary a',
			'Secondary Nav Page Link Hover' => '/* Secondary Nav Page Link Hover */' . "\n" . '.site-footer .menu-secondary li a:active, .site-footer .menu-secondary li a:hover, .site-footer .menu-secondary li a:focus',
			'Secondary Nav Current Page Link' => '/* Secondary Nav Current Page Link */' . "\n" . '.site-footer .menu-secondary .current_page_item a, .site-footer .menu-secondary .current-cat a, .site-footer .menu-secondary .current-menu-item a',
			'Secondary Nav Page Link Hover/Current Page' => '/* Secondary Nav Page Link Hover/Current Page */' . "\n" . '.site-footer .menu-secondary li a:active, .site-footer .menu-secondary li a:hover, .site-footer .menu-secondary li a:focus,' . "\n" . '.site-footer .menu-secondary .current_page_item a, .site-footer .menu-secondary .current-cat a, .site-footer .menu-secondary .current-menu-item a',
			'Secondary Nav Page jQuery Sub-Indicator' => '/* Secondary Nav Page jQuery Sub-Indicator */' . "\n" . '.site-footer .menu-secondary li a .sf-sub-indicator, .site-footer .menu-secondary li li a .sf-sub-indicator, .site-footer .menu-secondary li li li a .sf-sub-indicator',
			'Secondary Nav Sub-Menu Link' => '/* Secondary Nav Sub-Menu */' . "\n" . '.site-footer .menu-secondary .sub-menu',
			'Secondary Nav Sub-Menu Link' => '/* Secondary Nav Sub-Menu Link */' . "\n" . '.site-footer .menu-secondary .sub-menu a, .site-footer .menu-secondary .sub-menu a:link, .site-footer .menu-secondary .sub-menu a:visited',
			'Secondary Nav Sub-Menu Link Hover' => '/* Secondary Nav Sub-Menu Link Hover */' . "\n" . '.site-footer .menu-secondary .sub-menu a:active, .site-footer .menu-secondary .sub-menu a:hover'
		)
	);
	
	return $dynamik_secondary_menu_elements_array;
	
}

/**
 * Build Content CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Content CSS elements array.
 */
function dynamik_content_elements_array() {
	
	$dynamik_content_elements_array = array(
		'-- Content --' => array(
			'Content' => '/* Content */' . "\n" . '.content',
			'Content Post' => '/* Content Post */' . "\n" . '.content .post',
			'Content Page' => '/* Content Page */' . "\n" . '.content .page',
			'Content Entry' => '/* Content Entry */' . "\n" . '.content .entry',
			'Content Paragraph' => '/* Content Paragraph */' . "\n" . '.entry-content p',
			'Content Lists' => '/* Content Lists */' . "\n" . '.entry-content ul li, .entry-content ol li',
			'Content Link' => '/* Content Link */' . "\n" . '.entry-content a, .entry-content a:visited',
			'Content Link Hover' => '/* Content Link Hover */' . "\n" . '.entry-content a:hover, .entry-content a:focus',
			'Content Blockquote' => '/* Content Blockquote */' . "\n" . '.content blockquote',
			'Content Blockquote Paragraph' => '/* Content Blockquote Paragraph */' . "\n" . '.content blockquote p',
			'Content Blockquote Link' => '/* Content Blockquote Link */' . "\n" . '.content blockquote a, .content blockquote a:visited',
			'Content Blockquote Link Hover' => '/* Content Blockquote Link Hover */' . "\n" . '.content blockquote a:hover, .content blockquote a:focus',
			'Post/Page Title' => '/* Post/Page Title */' . "\n" . '.content .entry-title',
			'Post Title Link' => '/* Post Title Link */' . "\n" . '.content .entry-title a, .content .entry-title a:visited',
			'Post Title Link Hover' => '/* Post Title Link Hover */' . "\n" . '.content .entry-title a:hover, .content .entry-title a:focus',
			'Content H1' => '/* Content H1 */' . "\n" . '.content h1',
			'Content H2' => '/* Content H2 */' . "\n" . '.content h2',
			'Content H3' => '/* Content H3 */' . "\n" . '.content h3',
			'Content H4' => '/* Content H4 */' . "\n" . '.content h4',
			'Content H5' => '/* Content H5 */' . "\n" . '.content h5',
			'Content H6' => '/* Content H6 */' . "\n" . '.content h6',
			'Content Post H1' => '/* Content Post H1 */' . "\n" . '.content .post h1',
			'Content Post H2' => '/* Content Post H2 */' . "\n" . '.content .post h2',
			'Content Post H3' => '/* Content Post H3 */' . "\n" . '.content .post h3',
			'Content Post H4' => '/* Content Post H4 */' . "\n" . '.content .post h4',
			'Content Post H5' => '/* Content Post H5 */' . "\n" . '.content .post h5',
			'Content Post H6' => '/* Content Post H6 */' . "\n" . '.content .post h6',
			'Content Page H1' => '/* Content Page H1 */' . "\n" . '.content .page h1',
			'Content Page H2' => '/* Content Page H2 */' . "\n" . '.content .page h2',
			'Content Page H3' => '/* Content Page H3 */' . "\n" . '.content .page h3',
			'Content Page H4' => '/* Content Page H4 */' . "\n" . '.content .page h4',
			'Content Page H5' => '/* Content Page H5 */' . "\n" . '.content .page h5',
			'Content Page H6' => '/* Content Page H6 */' . "\n" . '.content .page h6',
			'Content Post/Page UL LI' => '/* Content Post/Page UL LI */' . "\n" . '.entry-content ul li',
			'Content Post/Page OL LI' => '/* Content Post/Page OL LI */' . "\n" . '.entry-content ol li',
			'Post Info' => '/* Post Info */' . "\n" . '.entry-header .entry-meta',
			'Post Info Link' => '/* Post Info Link */' . "\n" . '.entry-header .entry-meta a, .entry-header .entry-meta a:visited',
			'Post Info Link Hover' => '/* Post Info Link Hover */' . "\n" . '.entry-header .entry-meta a:hover, .entry-header .entry-meta a:focus',
			'Post Meta' => '/* Post Meta */' . "\n" . '.entry-footer .entry-meta',
			'Post Meta Link' => '/* Post Meta Link */' . "\n" . '.entry-footer .entry-meta a, .entry-footer .entry-meta a:visited',
			'Post Meta Link Hover' => '/* Post Meta Link Hover */' . "\n" . '.entry-footer .entry-meta a:hover, .entry-footer .entry-meta a:focus',
			'More Link Wrap' => '/* More Link Wrap */' . "\n" . '.more-link-wrap',
			'More Link' => '/* More Link */' . "\n" . 'a.more-link',
			'More Link Hover' => '/* More Link Hover */' . "\n" . 'a.more-link:hover',
			'Post Navigation' => '/* Post Navigation */' . "\n" . '.pagination',
			'Post Navigation Link' => '/* Post Navigation Link */' . "\n" . '.pagination a, .pagination a:visited',
			'Post Navigation Link Hover' => '/* Post Navigation Link Hover */' . "\n" . '.pagination a:hover, .pagination a:focus',
			'Post Navigation Numbered' => '/* Post Navigation Numbered */' . "\n" . '.pagination li a, .pagination li.disabled, .pagination li a:hover, .pagination li.active a ',
			'Post Navigation Numbered Link' => '/* Post Navigation Numbered Link */' . "\n" . '.pagination li a:hover, .pagination li.active a ',
			'Post Navigation Numbered Link Hover' => '/* Post Navigation Numbered Link Hover */' . "\n" . '.pagination li a:hover, .pagination li a:focus'
		)
	);
	
	return $dynamik_content_elements_array;
	
}

/**
 * Build Breadcrumb CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Breadcrumb CSS elements array.
 */
function dynamik_breadcrumb_elements_array() {
	
	$dynamik_breadcrumb_elements_array = array(
		'-- Breadcrumbs --' => array(
			'Breadcrumbs' => '/* Breadcrumbs */' . "\n" . '.breadcrumb',
			'Breadcrumbs Link' => '/* Breadcrumbs Link */' . "\n" . '.breadcrumb a',
			'Breadcrumbs Link Hover' => '/* Breadcrumbs Link Hover */' . "\n" . '.breadcrumb a:hover, .breadcrumb a:focus'
		)
	);
	
	return $dynamik_breadcrumb_elements_array;
	
}

/**
 * Build Archive Description CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Archive Description CSS elements array.
 */
function dynamik_archive_description_elements_array() {
	
	$dynamik_archive_description_elements_array = array(
		'-- Archive Description --' => array(
			'Archive Description' => '/* Archive Description */' . "\n" . '.archive-description',
			'Archive Description Title' => '/* Archive Description Title */' . "\n" . '.content .archive-description .archive-title',
			'Archive Description Paragraph' => '/* Archive Description Paragraph */' . "\n" . '.content .archive-description p',
			'Archive Description Link' => '/* Archive Description Link */' . "\n" . '.content .archive-description a, .content .archive-description a:visited',
			'Archive Description Link Hover' => '/* Archive Description Link Hover */' . "\n" . '.content .archive-description a:hover, .content .archive-description a:focus'
		),
		'-- Taxonomy Description --' => array(
			'Taxonomy Description' => '/* Taxonomy Description */' . "\n" . '.taxonomy-description',
			'Taxonomy Description Title' => '/* Taxonomy Description Title */' . "\n" . '.content .taxonomy-description .archive-title',
			'Taxonomy Description Paragraph' => '/* Taxonomy Description Paragraph */' . "\n" . '.content .taxonomy-description p',
			'Taxonomy Description Link' => '/* Taxonomy Description Link */' . "\n" . '.content .taxonomy-description a, .content .taxonomy-description a:visited',
			'Taxonomy Description Link Hover' => '/* Taxonomy Description Link Hover */' . "\n" . '.content .taxonomy-description a:hover, .content .taxonomy-description a:focus'
		),
		'-- Author Description --' => array(
			'Author Description' => '/* Author Description */' . "\n" . '.author-description',
			'Author Description Title' => '/* Author Description Title */' . "\n" . '.content .author-description .archive-title',
			'Author Description Paragraph' => '/* Author Description Paragraph */' . "\n" . '.content .author-description p',
			'Author Description Link' => '/* Author Description Link */' . "\n" . '.content .author-description a, .content .author-description a:visited',
			'Author Description Link Hover' => '/* Author Description Link Hover */' . "\n" . '.content .author-description a:hover, .content .author-description a:focus'
		)
	);
	
	return $dynamik_archive_description_elements_array;
	
}

/**
 * Build Author Box CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Author Box CSS elements array.
 */
function dynamik_author_box_elements_array() {
	
	$dynamik_author_box_elements_array = array(
		'-- Author Box --' => array(
			'Author Box' => '/* Author Box */' . "\n" . '.author-box',
			'Author Box Title' => '/* Author Box Title */' . "\n" . '.author-box-title',
			'Author Box Paragraph' => '/* Author Box Paragraph */' . "\n" . '.author-box-content',
			'Author Box Link' => '/* Author Box Link */' . "\n" . '.author-box a, .author-box a:visited',
			'Author Box Link Hover' => '/* Author Box Link Hover */' . "\n" . '.author-box a:hover, .author-box a:focus',
			'Author Box Avatar' => '/* Author Box Avatar */' . "\n" . '.author-box .avatar'
		)
	);
	
	return $dynamik_author_box_elements_array;
	
}

/**
 * Build Featured Content CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Featured Content CSS elements array.
 */
function dynamik_featured_content_elements_array() {
	
	$dynamik_featured_content_elements_array = array(
		'-- Featured Content --' => array(
			'Featured Content' => '/* Featured Content */' . "\n" . '.featured-content',
			'Featured Content .entry' => '/* Featured Content .entry */' . "\n" . '.featured-content .entry',
			'Featured Content Title' => '/* Featured Content Title */' . "\n" . '.featured-content .entry h2',
			'Featured Content Title Link' => '/* Featured Content Title Link */' . "\n" . '.featured-content .entry h2 a, .featured-content .entry h2 a:visited',
			'Featured Content Title Link Hover' => '/* Featured Content Title Link Hover */' . "\n" . '.featured-content .entry h2 a:hover, .featured-content .entry h2 a:focus',
			'Featured Content Byline' => '/* Featured Content Byline */' . "\n" . '.featured-content .entry .byline',
			'Featured Content Byline Link' => '/* Featured Content Byline Link */' . "\n" . '.featured-content .entry .byline a, .featured-content .entry .byline a:visited',
			'Featured Content Byline Link Hover' => '/* Featured Content Byline Link Hover */' . "\n" . '.featured-content .entry .byline a:hover, .featured-content .entry .byline a:focus',
			'Featured Content Paragraph' => '/* Featured Content Paragraph */' . "\n" . '.featured-content .entry p',
			'Featured Content Link' => '/* Featured Content Link */' . "\n" . '.featured-content .entry a, .featured-content .entry a:visited',
			'Featured Content Link Hover' => '/* Featured Content Link Hover */' . "\n" . '.featured-content .entry a:hover, .featured-content .entry a:focus'
		),
		'-- Featured Post --' => array(
			'Featured Post' => '/* Featured Post */' . "\n" . '.featuredpost',
			'Featured Post .post' => '/* Featured Post .post */' . "\n" . '.featuredpost .post',
			'Featured Post Title' => '/* Featured Post Title */' . "\n" . '.featuredpost .post h2',
			'Featured Post Title Link' => '/* Featured Post Title Link */' . "\n" . '.featuredpost .post h2 a, .featuredpost .post h2 a:visited',
			'Featured Post Title Link Hover' => '/* Featured Post Title Link Hover */' . "\n" . '.featuredpost .post h2 a:hover, .featuredpost .post h2 a:focus',
			'Featured Post Post Info' => '/* Featured Post Post Info */' . "\n" . '.featuredpost .post .entry-header .entry-meta',
			'Featured Post Post Info Link' => '/* Featured Post Post Info Link */' . "\n" . '.featuredpost .post .entry-header .entry-meta a, .featuredpost .post .entry-header .entry-meta a:visited',
			'Featured Post Post Info Link Hover' => '/* Featured Post Post Info Link Hover */' . "\n" . '.featuredpost .post .entry-header .entry-meta a:hover, .featuredpost .post .entry-header .entry-meta a:focus',
			'Featured Post Paragraph' => '/* Featured Post Paragraph */' . "\n" . '.featuredpost .post p',
			'Featured Post Link' => '/* Featured Post Link */' . "\n" . '.featuredpost .post a, .featuredpost .post a:visited',
			'Featured Post Link Hover' => '/* Featured Post Link Hover */' . "\n" . '.featuredpost .post a:hover, .featuredpost .post a:focus'
		),
		'-- Featured Page --' => array(
			'Featured Page' => '/* Featured Page */' . "\n" . '.featuredpage',
			'Featured Page .page' => '/* Featured Page .page */' . "\n" . '.featuredpage .page',
			'Featured Page Title' => '/* Featured Page Title */' . "\n" . '.featuredpage .page h2',
			'Featured Page Title Link' => '/* Featured Page Title Link */' . "\n" . '.featuredpage .page h2 a, .featuredpage .page h2 a:visited',
			'Featured Page Title Link Hover' => '/* Featured Page Title Link Hover */' . "\n" . '.featuredpage .page h2 a:hover, .featuredpage .page h2 a:focus',
			'Featured Page Byline' => '/* Featured Page Byline */' . "\n" . '.featuredpage .page .byline',
			'Featured Page Byline Link' => '/* Featured Page Byline Link */' . "\n" . '.featuredpage .page .byline a, .featuredpage .page .byline a:visited',
			'Featured Page Byline Link Hover' => '/* Featured Page Byline Link Hover */' . "\n" . '.featuredpage .page .byline a:hover, .featuredpage .page .byline a:focus',
			'Featured Page Paragraph' => '/* Featured Page Paragraph */' . "\n" . '.featuredpage .page p',
			'Featured Page Link' => '/* Featured Page Link */' . "\n" . '.featuredpage .page a, .featuredpage .page a:visited',
			'Featured Page Link Hover' => '/* Featured Page Link Hover */' . "\n" . '.featuredpage .page a:hover, .featuredpage .page a:focus'
		)
	);
	
	return $dynamik_featured_content_elements_array;
	
}

/**
 * Build Sidebar CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Sidebar CSS elements array.
 */
function dynamik_sidebar_elements_array() {
	
	$dynamik_sidebar_elements_array = array(
		'-- Sidebars --' => array(
			'Sidebars' => '/* Sidebars */' . "\n" . '.sidebar',
			'Sidebars Heading' => '/* Sidebars Heading */' . "\n" . '.sidebar h3',
			'Sidebars Widget' => '/* Sidebars Widget */' . "\n" . '.sidebar .widget',
			'Sidebars Link' => '/* Sidebars Link */' . "\n" . '.sidebar a',
			'Sidebars Link Hover' => '/* Sidebars Link Hover */' . "\n" . '.sidebar a:hover, .sidebar a:focus',
			'Sidebars UL/OL' => '/* Sidebars UL/OL */' . "\n" . '.sidebar ul, .sidebar ol',
			'Sidebars UL LI' => '/* Sidebars UL LI */' . "\n" . '.sidebar ul li'
		),
		'-- Primary Sidebar --' => array(
			'Primary Sidebar' => '/* Primary Sidebar */' . "\n" . '.sidebar-primary',
			'Primary Sidebar H3' => '/* Primary Sidebar H4 */' . "\n" . '.sidebar-primary h3',
			'Primary Sidebar Widget' => '/* Primary Sidebar Widget */' . "\n" . '.sidebar-primary .widget',
			'Primary Sidebar Link' => '/* Primary Sidebar Link */' . "\n" . '.sidebar-primary a, .sidebar-primary a:visited',
			'Primary Sidebar Link Hover' => '/* Primary Sidebar Link Hover */' . "\n" . '.sidebar-primary a:hover, .sidebar-primary a:focus',
			'Primary Sidebar UL/OL' => '/* Primary Sidebar UL/OL */' . "\n" . '.sidebar-primary ul, .sidebar-primary ol',
			'Primary Sidebar UL LI' => '/* Primary Sidebar UL LI */' . "\n" . '.sidebar-primary ul li'
		),
		'-- Secondary Sidebar --' => array(
			'Secondary Sidebar' => '/* Secondary Sidebar */' . "\n" . '.sidebar-secondary',
			'Secondary Sidebar H3' => '/* Secondary Sidebar H4 */' . "\n" . '.sidebar-secondary h3',
			'Secondary Sidebar Widget' => '/* Secondary Sidebar Widget */' . "\n" . '.sidebar-secondary .widget',
			'Secondary Sidebar Link' => '/* Secondary Sidebar Link */' . "\n" . '.sidebar-secondary a, .sidebar-secondary a:visited',
			'Secondary Sidebar Link Hover' => '/* Secondary Sidebar Link Hover */' . "\n" . '.sidebar-secondary a:hover, .sidebar-secondary a:focus',
			'Secondary Sidebar UL/OL' => '/* Secondary Sidebar UL/OL */' . "\n" . '.sidebar-secondary ul, .sidebar-secondary ol',
			'Secondary Sidebar UL LI' => '/* Secondary Sidebar UL LI */' . "\n" . '.sidebar-secondary ul li'
		)
	);
	
	return $dynamik_sidebar_elements_array;
	
}

/**
 * Build Comment CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Comment CSS elements array.
 */
function dynamik_comment_elements_array() {
	
	$dynamik_comment_elements_array = array(
		'-- Comments --' => array(
			'Comments' => '/* Comments */' . "\n" . '#comments',
			'Comments Title' => '/* Comments Title */' . "\n" . '#comments h3',
			'Comment List' => '/* Comment List */' . "\n" . '.comment-list',
			'Comment Author' => '/* Comment Author */' . "\n" . '.comment-author',
			'Comment Meta' => '/* Comment Meta */' . "\n" . '.comment-meta',
			'Comment Meta Link' => '/* Comment Meta Link */' . "\n" . '.comment-meta a, .comment-meta a:visited',
			'Comment Meta Link Hover' => '/* Comment Meta Link Hover */' . "\n" . '.comment-meta a:hover, .comment-meta a:focus',
			'Comment Thread Even' => '/* Comment Thread Even */' . "\n" . '.thread-even',
			'Comment Thread Alt' => '/* Comment Thread Alt */' . "\n" . '.thread-alt',
			'Comments Nav' => '/* Comments Nav */' . "\n" . '#comments .pagination',
			'No Comments Text' => '/* No Comments Text */' . "\n" . '.nocomments'
		)
	);
	
	return $dynamik_comment_elements_array;
	
}

/**
 * Build Comment Respond CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Comment Respond CSS elements array.
 */
function dynamik_comment_respond_elements_array() {
	
	$dynamik_comment_respond_elements_array = array(
		'-- Comments Respond --' => array(
			'Comments Respond' => '/* Comments Respond */' . "\n" . '#respond',
			'Reply Title' => '/* Reply Title */' . "\n" . '#respond h3',
			'Author/Email/URL/Comment' => '/* Author/Email/URL/Comment */' . "\n" . '#author, #comment, #email, #url',
			'Comment Form' => '/* Comment Form */' . "\n" . '#comment',
			'Comment Submit Button' => '/* Comment Submit Button */' . "\n" . '#commentform #submit',
			'Comment Submit Button Hover' => '/* Comment Submit Button Hover */' . "\n" . '#commentform #submit:hover, #commentform #submit:focus'
		)
	);
	
	return $dynamik_comment_respond_elements_array;
	
}

/**
 * Build EZ Feature Top CSS elements drop-down list.
 *
 * @since 1.0
 * @return EZ Feature Top CSS elements array.
 */
function dynamik_ez_feature_top_elements_array() {
	
	$dynamik_ez_feature_top_elements_array = array(
		'-- EZ Feature Top --' => array(
			'EZ Feature Top Container Wrap' => '/* EZ Feature Top Container Wrap */' . "\n" . '#ez-feature-top-container-wrap',
			'EZ Feature Top Container' => '/* EZ Feature Top Container */' . "\n" . '#ez-feature-top-container',
			'EZ Feature Top Widget Area H4' => '/* EZ Feature Top Widget Area H4 */' . "\n" . '#ez-feature-top-container .ez-widget-area h4',
			'EZ Feature Top Widget Area Link' => '/* EZ Feature Top Widget Area Link */' . "\n" . '#ez-feature-top-container .ez-widget-area a, #ez-feature-top-container .ez-widget-area a:visited',
			'EZ Feature Top Widget Area Link Hover' => '/* EZ Feature Top Widget Area Link Hover */' . "\n" . '#ez-feature-top-container .ez-widget-area a:hover',
			'EZ Feature Top 1' => '/* EZ Feature Top 1 */' . "\n" . '#ez-feature-top-1',
			'EZ Feature Top 2' => '/* EZ Feature Top 2 */' . "\n" . '#ez-feature-top-2',
			'EZ Feature Top 3' => '/* EZ Feature Top 3 */' . "\n" . '#ez-feature-top-3',
			'EZ Feature Top 4' => '/* EZ Feature Top 4 */' . "\n" . '#ez-feature-top-4',
			'EZ Feature Top Widget Area' => '/* EZ Feature Top Widget Area */' . "\n" . '#ez-feature-top-container .ez-widget-area',
			'EZ Feature Top Widget Area Paragraph' => '/* EZ Feature Top Widget Area Paragraph */' . "\n" . '#ez-feature-top-container .ez-widget-area p',
			'ez_feature_top_1 Widget Area' => '/* ez_feature_top_1 Widget Area */' . "\n" . 'body.ez-feature-top-1 #ez-feature-top-container .ez-widget-area',
			'ez_feature_top_2 Widget Areas' => '/* ez_feature_top_2 Widget Areas */' . "\n" . 'body.ez-feature-top-2 #ez-feature-top-container .ez-widget-area',
			'ez_feature_top_3 Widget Areas' => '/* ez_feature_top_3 Widget Areas */' . "\n" . '#ez-feature-top-container .ez-widget-area',
			'ez_feature_top_4 Widget Areas' => '/* ez_feature_top_4 Widget Areas */' . "\n" . 'body.ez-feature-top-4 #ez-feature-top-container .ez-widget-area',
			'Wide Left/Wide Right Widget Area' => '/* Wide Left/Wide Right Widget Area */' . "\n" . 'body.ez-feature-top-wide-left-2 #ez-feature-top-1.ez-widget-area, body.ez-feature-top-wide-right-2 #ez-feature-top-2.ez-widget-area',
			'First/Only Widget Area' => '/* First/Only Widget Area */' . "\n" . '#ez-feature-top-container .ez-first, #ez-feature-top-container .ez-only'
		),
		'-- EZ Widget Area Class --' => array(
			'EZ Widget Area' => '/* EZ Widget Area */' . "\n" . '.ez-widget-area',
			'EZ Widget Area H4' => '/* EZ Widget Area H4 */' . "\n" . '.ez-widget-area h4',
			'EZ Widget Area UL' => '/* EZ Widget Area UL */' . "\n" . '.ez-widget-area ul',
			'EZ Widget Area OL' => '/* EZ Widget Area OL */' . "\n" . '.ez-widget-area ol',
			'EZ Widget Area UL LI' => '/* EZ Widget Area UL LI */' . "\n" . '.ez-widget-area ul li',
			'EZ Widget Area OL LI' => '/* EZ Widget Area OL LI */' . "\n" . '.ez-widget-area ol li'
		)
	);
	
	return $dynamik_ez_feature_top_elements_array;
	
}

/**
 * Build EZ Fat Footer CSS elements drop-down list.
 *
 * @since 1.0
 * @return EZ Fat Footer CSS elements array.
 */
function dynamik_ez_fat_footer_elements_array() {
	
	$dynamik_ez_fat_footer_elements_array = array(
		'-- EZ Fat Footer --' => array(
			'EZ Fat Footer Container Wrap' => '/* EZ Fat Footer Container Wrap */' . "\n" . '#ez-fat-footer-container-wrap',
			'EZ Fat Footer Container' => '/* EZ Fat Footer Container */' . "\n" . '#ez-fat-footer-container',
			'EZ Fat Footer Widget Area H4' => '/* EZ Fat Footer Widget Area H4 */' . "\n" . '#ez-fat-footer-container .ez-widget-area h4',
			'EZ Fat Footer Widget Area Link' => '/* EZ Fat Footer Widget Area Link */' . "\n" . '#ez-fat-footer-container .ez-widget-area a, #ez-fat-footer-container .ez-widget-area a:visited',
			'EZ Fat Footer Widget Area Link Hover' => '/* EZ Fat Footer Widget Area Link Hover */' . "\n" . '#ez-fat-footer-container .ez-widget-area a:hover',
			'EZ Fat Footer 1' => '/* EZ Fat Footer 1 */' . "\n" . '#ez-fat-footer-1',
			'EZ Fat Footer 2' => '/* EZ Fat Footer 2 */' . "\n" . '#ez-fat-footer-2',
			'EZ Fat Footer 3' => '/* EZ Fat Footer 3 */' . "\n" . '#ez-fat-footer-3',
			'EZ Fat Footer 4' => '/* EZ Fat Footer 4 */' . "\n" . '#ez-fat-footer-4',
			'EZ Fat Footer Widget Area' => '/* EZ Fat Footer Widget Area */' . "\n" . '#ez-fat-footer-container .ez-widget-area',
			'EZ Fat Footer Widget Area Paragraph' => '/* EZ Fat Footer Widget Area Paragraph */' . "\n" . '#ez-fat-footer-container .ez-widget-area p',
			'ez_feature_top_1 Widget Area' => '/* ez_feature_top_1 Widget Area */' . "\n" . 'body.ez-fat-footer-1 #ez-fat-footer-container .ez-widget-area',
			'ez_feature_top_2 Widget Areas' => '/* ez_feature_top_2 Widget Areas */' . "\n" . 'body.ez-fat-footer-2 #ez-fat-footer-container .ez-widget-area',
			'ez_feature_top_3 Widget Areas' => '/* ez_feature_top_3 Widget Areas */' . "\n" . '#ez-fat-footer-container .ez-widget-area',
			'ez_feature_top_4 Widget Areas' => '/* ez_feature_top_4 Widget Areas */' . "\n" . 'body.ez-fat-footer-4 #ez-fat-footer-container .ez-widget-area',
			'Wide Left/Wide Right Widget Area' => '/* Wide Left/Wide Right Widget Area */' . "\n" . 'body.ez-fat-footer-wide-left-2 #ez-fat-footer-1.ez-widget-area, body.ez-fat-footer-wide-right-2 #ez-fat-footer-2.ez-widget-area',
			'First/Only Widget Area' => '/* First/Only Widget Area */' . "\n" . '#ez-fat-footer-container .ez-first, #ez-fat-footer-container .ez-only'
		),
		'-- EZ Widget Area Class --' => array(
			'EZ Widget Area' => '/* EZ Widget Area */' . "\n" . '.ez-widget-area',
			'EZ Widget Area H4' => '/* EZ Widget Area H4 */' . "\n" . '.ez-widget-area h4',
			'EZ Widget Area UL' => '/* EZ Widget Area UL */' . "\n" . '.ez-widget-area ul',
			'EZ Widget Area OL' => '/* EZ Widget Area OL */' . "\n" . '.ez-widget-area ol',
			'EZ Widget Area UL LI' => '/* EZ Widget Area UL LI */' . "\n" . '.ez-widget-area ul li',
			'EZ Widget Area OL LI' => '/* EZ Widget Area OL LI */' . "\n" . '.ez-widget-area ol li'
		)
	);
	
	return $dynamik_ez_fat_footer_elements_array;
	
}

/**
 * Build EZ Home CSS elements drop-down list.
 *
 * @since 1.0
 * @return EZ Home CSS elements array.
 */
function dynamik_ez_home_elements_array() {
	
	$dynamik_ez_home_elements_array = array(
		'-- EZ Home --' => array(
			'EZ Home Container Wrap' => '/* EZ Home Container Wrap */' . "\n" . '#ez-home-container-wrap',
			'EZ Home Widget Area H4' => '/* EZ Home Widget Area H4 */' . "\n" . '#ez-home-container-wrap .ez-widget-area h4',
			'EZ Home Widget Area' => '/* EZ Home Widget Area */' . "\n" . '#ez-home-container-wrap .ez-widget-area',
			'EZ Home Widget Area Link' => '/* EZ Home Widget Area Link */' . "\n" . '#ez-home-container-wrap .ez-widget-area a, #ez-home-container-wrap .ez-widget-area a:visited',
			'EZ Home Widget Area Link Hover' => '/* EZ Home Widget Area Link Hover */' . "\n" . '#ez-home-container-wrap .ez-widget-area a:hover',
			'EZ Home Container Area Class' => '/* EZ Home Container Area Class */' . "\n" . '.ez-home-container-area',
			'EZ Home Top Container' => '/* EZ Home Top Container */' . "\n" . '#ez-home-top-container',
			'EZ Home Top 1' => '/* EZ Home Top 1 */' . "\n" . '#ez-home-top-1',
			'EZ Home Top 2' => '/* EZ Home Top 2 */' . "\n" . '#ez-home-top-2',
			'EZ Home Top 3' => '/* EZ Home Top 3 */' . "\n" . '#ez-home-top-3',
			'EZ Home Middle Container' => '/* EZ Home Middle Container */' . "\n" . '#ez-home-middle-container',
			'EZ Home Middle 1' => '/* EZ Home Middle 1 */' . "\n" . '#ez-home-middle-1',
			'EZ Home Middle 2' => '/* EZ Home Middle 2 */' . "\n" . '#ez-home-middle-2',
			'EZ Home Middle 3' => '/* EZ Home Middle 3 */' . "\n" . '#ez-home-middle-3',
			'EZ Home Bottom Container' => '/* EZ Home Bottom Container */' . "\n" . '#ez-home-bottom-container',
			'EZ Home Bottom 1' => '/* EZ Home Bottom 1 */' . "\n" . '#ez-home-bottom-1',
			'EZ Home Bottom 2' => '/* EZ Home Bottom 2 */' . "\n" . '#ez-home-bottom-2',
			'EZ Home Bottom 3' => '/* EZ Home Bottom 3 */' . "\n" . '#ez-home-bottom-3'
		),
		'-- EZ Widget Area Class --' => array(
			'EZ Widget Area' => '/* EZ Widget Area */' . "\n" . '.ez-widget-area',
			'EZ Widget Area H4' => '/* EZ Widget Area H4 */' . "\n" . '.ez-widget-area h4',
			'EZ Widget Area UL' => '/* EZ Widget Area UL */' . "\n" . '.ez-widget-area ul',
			'EZ Widget Area OL' => '/* EZ Widget Area OL */' . "\n" . '.ez-widget-area ol',
			'EZ Widget Area UL LI' => '/* EZ Widget Area UL LI */' . "\n" . '.ez-widget-area ul li',
			'EZ Widget Area OL LI' => '/* EZ Widget Area OL LI */' . "\n" . '.ez-widget-area ol li'
		)
	);
	
	return $dynamik_ez_home_elements_array;
	
}

/**
 * Build EZ Home Sidebar CSS elements drop-down list.
 *
 * @since 1.0
 * @return EZ Home Sidebar CSS elements array.
 */
function dynamik_ez_home_sidebar_elements_array() {
	
	$dynamik_ez_home_sidebar_elements_array = array(
		'-- EZ Home Sidebars --' => array(
			'EZ Home Sidebar Wrap' => '/* EZ Home Sidebar Wrap */' . "\n" . '#ez-home-sidebar-wrap',
			'EZ Home Sidebar' => '/* EZ Home Sidebar */' . "\n" . '#ez-home-sidebar',
			'EZ Home Sidebar Widget Area H4' => '/* EZ Home Sidebar Widget Area H4 */' . "\n" . '#ez-home-sidebar h4',
			'EZ Home Sidebar Widget Area' => '/* EZ Home Sidebar Widget Area */' . "\n" . '#ez-home-sidebar .ez-widget-area',
			'EZ Home Sidebar Widget Area Link' => '/* EZ Home Sidebar Widget Area Link */' . "\n" . '#ez-home-sidebar a, #ez-home-sidebar a:visited',
			'EZ Home Sidebar Widget Area Link Hover' => '/* EZ Home Sidebar Widget Area Link Hover */' . "\n" . '#ez-home-sidebar a:hover',
			'EZ Home Sidebar UL/OL' => '/* EZ Home Sidebar UL/OL */' . "\n" . '#ez-home-sidebar ul, #ez-home-sidebar ol',
			'EZ Home Sidebar UL LI' => '/* EZ Home Sidebar UL LI */' . "\n" . '#ez-home-sidebar ul li'
		),
		'-- EZ Widget Area Class --' => array(
			'EZ Widget Area' => '/* EZ Widget Area */' . "\n" . '.ez-widget-area',
			'EZ Widget Area H4' => '/* EZ Widget Area H4 */' . "\n" . '.ez-widget-area h4',
			'EZ Widget Area UL' => '/* EZ Widget Area UL */' . "\n" . '.ez-widget-area ul',
			'EZ Widget Area OL' => '/* EZ Widget Area OL */' . "\n" . '.ez-widget-area ol',
			'EZ Widget Area UL LI' => '/* EZ Widget Area UL LI */' . "\n" . '.ez-widget-area ul li',
			'EZ Widget Area OL LI' => '/* EZ Widget Area OL LI */' . "\n" . '.ez-widget-area ol li'
		)
	);
	
	return $dynamik_ez_home_sidebar_elements_array;
	
}

/**
 * Build EZ Home Slider CSS elements drop-down list.
 *
 * @since 1.0
 * @return EZ Home Slider CSS elements array.
 */
function dynamik_ez_home_slider_elements_array() {
	
	$dynamik_ez_home_slider_elements_array = array(
		'-- EZ Home Slider --' => array(
			'EZ Home Slider Wrap' => '/* EZ Home Slider Wrap */' . "\n" . '#ez-home-slider-container-wrap',
			'EZ Home Slider' => '/* EZ Home Slider */' . "\n" . '#ez-home-slider'
		),
		'-- EZ Widget Area Class --' => array(
			'EZ Widget Area' => '/* EZ Widget Area */' . "\n" . '.ez-widget-area',
			'EZ Widget Area H4' => '/* EZ Widget Area H4 */' . "\n" . '.ez-widget-area h4',
			'EZ Widget Area UL' => '/* EZ Widget Area UL */' . "\n" . '.ez-widget-area ul',
			'EZ Widget Area OL' => '/* EZ Widget Area OL */' . "\n" . '.ez-widget-area ol',
			'EZ Widget Area UL LI' => '/* EZ Widget Area UL LI */' . "\n" . '.ez-widget-area ul li',
			'EZ Widget Area OL LI' => '/* EZ Widget Area OL LI */' . "\n" . '.ez-widget-area ol li'
		)
	);
	
	return $dynamik_ez_home_slider_elements_array;
	
}

/**
 * Build Custom Widget Areas CSS elements drop-down list.
 *
 * @since 1.0
 * @return Custom Widget Areas CSS elements array.
 */
function dynamik_custom_widget_areas_elements_array() {
	
	$dynamik_custom_widget_areas_elements_array = array(
		'-- Custom Widgets Areas --' => array(
			'Custom Widget Area' => '/* Custom Widget Area */' . "\n" . '.dynamik-widget-area',
			'Custom Widget Area H4' => '/* Custom Widget Area H4 */' . "\n" . '.dynamik-widget-area h4',
			'Custom Widget Area Link' => '/* Custom Widget Area Link */' . "\n" . '.dynamik-widget-area a, .catalyst-widget-area a:visited',
			'Custom Widget Area Link Hover' => '/* Custom Widget Area Link Hover */' . "\n" . '.dynamik-widget-area a:hover'
		)
	);
	
	return $dynamik_custom_widget_areas_elements_array;
	
}

/**
 * Build Genesis Footer Widgets CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Genesis Footer Widgets CSS elements array.
 */
function dynamik_genesis_footer_widget_elements_array() {
	
	$dynamik_genesis_footer_widget_elements_array = array(
		'-- Genesis Footer Widgets --' => array(
			'Footer Widgets Container' => '/* Genesis Footer Widgets Container */' . "\n" . '.footer-widgets',
			'Footer Widgets Inner Wrap' => '/* Genesis Footer Widgets Inner Wrap */' . "\n" . '.footer-widgets .wrap',
			'Footer Widgets Widget' => '/* Genesis Footer Widgets Widget */' . "\n" . '.footer-widgets .widget',
			'Footer Widgets Title' => '/* Genesis Footer Widgets Title */' . "\n" . '.footer-widgets .widget .widget-title',
			'Footer Widgets Link' => '/* Genesis Footer Widgets Link */' . "\n" . '.footer-widgets .widget a',
			'Footer Widgets Link Hover' => '/* Genesis Footer Widgets Link Hover */' . "\n" . '.footer-widgets .widget a:hover, .footer-widgets .widget a:focus'
		)
	);
	
	return $dynamik_genesis_footer_widget_elements_array;
	
}

/**
 * Build Footer CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Footer CSS elements array.
 */
function dynamik_footer_elements_array() {
	
	$dynamik_footer_elements_array = array(
		'-- Footer --' => array(
			'Footer' => '/* Footer */' . "\n" . '.site-footer',
			'Footer Wrap' => '/* Footer Wrap */' . "\n" . '.site-footer .wrap',
			'Footer Text' => '/* Footer Text */' . "\n" . '.site-footer p',
			'Footer Link' => '/* Footer Link */' . "\n" . '.site-footer a, .site-footer a:visited',
			'Footer Link Hover' => '/* Footer Link Hover */' . "\n" . '.site-footer a:hover, .site-footer a:focus',
			'Footer Go To Top' => '/* Footer Go To Top */' . "\n" . '.site-footer .gototop',
			'Footer Credits' => '/* Footer Credits */' . "\n" . '.site-footer .creds'
		)
	);
	
	return $dynamik_footer_elements_array;
	
}

/**
 * Build the CSS Builder select menu.
 *
 * @since 1.0.0
 */
function dynamik_build_css_builder_select_menu( $elements_array = array(), $selected = '' ) {
	
	foreach( $elements_array as $element_type => $elements ) {
		
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data ) {
			
			$option = '<option value="' . $element_data . ' {"';
				
			if ( $element_data == $selected )
				$option .= ' selected="selected"';

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
			
		}
		echo '</optgroup>';
		
	}
	
}

/**********
General Option Arrays
           **********/

/**
 * Build main background options list.
 *
 * @since 1.0
 */
function dynamik_list_bg_options( $selected = '' )
{
	$dynamik_bg_options = array(
		'color' => 'Color',
		'transparent' => 'Transparent',
		'top left no-repeat' => 'No-Repeat Image (Left)',
		'top center no-repeat' => 'No-Repeat Image (Center)',
		'top right no-repeat' => 'No-Repeat Image (Right)',
		'top left repeat-x' => 'Horizontal-Repeat Image (Left)',
		'top center repeat-x' => 'Horizontal-Repeat Image (Center)',
		'top right repeat-x' => 'Horizontal-Repeat Image (Right)',
		'top left repeat-y' => 'Vertical-Repeat Image (Left)',
		'top center repeat-y' => 'Vertical-Repeat Image (Center)',
		'top right repeat-y' => 'Vertical-Repeat Image (Right)',
		'top repeat' => 'Horizontal & Vertical-Repeat Image'
	);
	
	foreach( $dynamik_bg_options as $bg_key => $bg_name )
	{
		$option = '<option value="' . $bg_key . '"';
			
		if( $bg_key == $selected )
		{
			$option .= ' selected="selected"';
		}

		$option .= '>' . $bg_name . '</option>';
		
		echo $option;
	}
}

/**
 * Build border options list.
 *
 * @since 1.0
 */
function dynamik_list_borders( $selected = '' )
{
	$dynamik_border_options = array( 'solid', 'dotted', 'dashed', 'double', 'groove', 'ridge', 'inset', 'outset' );

	foreach ( $dynamik_border_options as $border_option )
	{
		$option = '<option value="' . $border_option . '"';
		
		if( $border_option == $selected )
		{
			$option .= ' selected="selected"';
		}
		
		$option .= '>' . $border_option . '</option>';
		
		echo $option;
	}
}

/**
 * Build EZ Home Structure options list.
 *
 * @since 1.0
 */
function dynamik_list_ez_home_structure_options( $selected = '' )
{
	$dynamik_ez_home_structure_options = array(
		'disabled' => 'Disabled',
		'ez_home_1' => 'EZ Home 1',
		'ez_home_1_1' => 'EZ Home 1 1',
		'ez_home_1_2' => 'EZ Home 1 2',
		'ez_home_1_3' => 'EZ Home 1 3',
		'ez_home_1_1_1' => 'EZ Home 1 1 1',
		'ez_home_1_1_2' => 'EZ Home 1 1 2',
		'ez_home_1_1_3' => 'EZ Home 1 1 3',
		'ez_home_1_2_1' => 'EZ Home 1 2 1',
		'ez_home_1_2_2' => 'EZ Home 1 2 2',
		'ez_home_1_2_3' => 'EZ Home 1 2 3',
		'ez_home_1_3_1' => 'EZ Home 1 3 1',
		'ez_home_1_3_2' => 'EZ Home 1 3 2',
		'ez_home_1_3_3' => 'EZ Home 1 3 3',
		'ez_home_2' => 'EZ Home 2',
		'ez_home_2_1' => 'EZ Home 2 1',
		'ez_home_2_2' => 'EZ Home 2 2',
		'ez_home_2_3' => 'EZ Home 2 3',
		'ez_home_2_1_1' => 'EZ Home 2 1 1',
		'ez_home_2_1_2' => 'EZ Home 2 1 2',
		'ez_home_2_1_3' => 'EZ Home 2 1 3',
		'ez_home_2_2_1' => 'EZ Home 2 2 1',
		'ez_home_2_2_2' => 'EZ Home 2 2 2',
		'ez_home_2_2_3' => 'EZ Home 2 2 3',
		'ez_home_2_3_1' => 'EZ Home 2 3 1',
		'ez_home_2_3_2' => 'EZ Home 2 3 2',
		'ez_home_2_3_3' => 'EZ Home 2 3 3',
		'ez_home_3' => 'EZ Home 3',
		'ez_home_3_1' => 'EZ Home 3 1',
		'ez_home_3_2' => 'EZ Home 3 2',
		'ez_home_3_3' => 'EZ Home 3 3',
		'ez_home_3_1_1' => 'EZ Home 3 1 1',
		'ez_home_3_1_2' => 'EZ Home 3 1 2',
		'ez_home_3_1_3' => 'EZ Home 3 1 3',
		'ez_home_3_2_1' => 'EZ Home 3 2 1',
		'ez_home_3_2_2' => 'EZ Home 3 2 2',
		'ez_home_3_2_3' => 'EZ Home 3 2 3',
		'ez_home_3_3_1' => 'EZ Home 3 3 1',
		'ez_home_3_3_2' => 'EZ Home 3 3 2',
		'ez_home_3_3_3' => 'EZ Home 3 3 3',
		'ez_home_wl_2_3' => 'EZ Home Wide Left 2 3',
		'ez_home_wl_3_2' => 'EZ Home Wide Left 3 2',
		'ez_home_wl_2_3_3' => 'EZ Home Wide Left 2 3 3',
		'ez_home_wl_3_2_3' => 'EZ Home Wide Left 3 2 3',
		'ez_home_wl_3_3_2' => 'EZ Home Wide Left 3 3 2',
		'ez_home_wr_2_3' => 'EZ Home Wide Right 2 3',
		'ez_home_wr_3_2' => 'EZ Home Wide Right 3 2',
		'ez_home_wr_2_3_3' => 'EZ Home Wide Right 2 3 3',
		'ez_home_wr_3_2_3' => 'EZ Home Wide Right 3 2 3',
		'ez_home_wr_3_3_2' => 'EZ Home Wide Right 3 3 2'
	);
	
	foreach( $dynamik_ez_home_structure_options as $ez_home_structure_key => $ez_home_structure_name )
	{
		$option = '<option value="' . $ez_home_structure_key . '"';
			
		if( $ez_home_structure_key == $selected )
		{
			$option .= ' selected="selected"';
		}

		$option .= '>' . $ez_home_structure_name . '</option>';
		
		echo $option;
	}
}

/**
 * Build EZ Feature Top Structure options list.
 *
 * @since 1.0
 */
function dynamik_list_ez_feature_top_structure_options( $selected = '' )
{
	$dynamik_ez_feature_top_structure_options = array(
		'disabled' => 'Disabled',
		'ez_feature_top_1' => 'EZ Feature Top 1',
		'ez_feature_top_2' => 'EZ Feature Top 2',
		'ez_feature_top_3' => 'EZ Feature Top 3',
		'ez_feature_top_4' => 'EZ Feature Top 4',
		'ez_feature_top_wl_2' => 'EZ Feature Top Wide Left 2',
		'ez_feature_top_wr_2' => 'EZ Feature Top Wide Right 2'
	);
	
	foreach( $dynamik_ez_feature_top_structure_options as $ez_feature_top_structure_key => $ez_feature_top_structure_name )
	{
		$option = '<option value="' . $ez_feature_top_structure_key . '"';
			
		if( $ez_feature_top_structure_key == $selected )
		{
			$option .= ' selected="selected"';
		}

		$option .= '>' . $ez_feature_top_structure_name . '</option>';
		
		echo $option;
	}
}

/**
 * Build EZ Fat Footer Structure options list.
 *
 * @since 1.0
 */
function dynamik_list_ez_fat_footer_structure_options( $selected = '' )
{
	$dynamik_ez_fat_footer_structure_options = array(
		'disabled' => 'Disabled',
		'ez_fat_footer_1' => 'EZ Fat Footer 1',
		'ez_fat_footer_2' => 'EZ Fat Footer 2',
		'ez_fat_footer_3' => 'EZ Fat Footer 3',
		'ez_fat_footer_4' => 'EZ Fat Footer 4',
		'ez_fat_footer_wl_2' => 'EZ Fat Footer Wide Left 2',
		'ez_fat_footer_wr_2' => 'EZ Fat Footer Wide Right 2'
	);
	
	foreach( $dynamik_ez_fat_footer_structure_options as $ez_fat_footer_structure_key => $ez_fat_footer_structure_name )
	{
		$option = '<option value="' . $ez_fat_footer_structure_key . '"';
			
		if( $ez_fat_footer_structure_key == $selected )
		{
			$option .= ' selected="selected"';
		}

		$option .= '>' . $ez_fat_footer_structure_name . '</option>';
		
		echo $option;
	}
}

/**
 * List available images that have been uploaded using the Dynamik Image Uploader.
 *
 * @since 1.0
 */
function dynamik_list_images( $current_value = '' )
{
	$files = array();
	$images_path = dynamik_get_stylesheet_location( 'path' ) . 'images';
	$images_path_broken = false;
	$handle = dynamik_dir_check( $images_path ) ? opendir( $images_path ) : $images_path_broken = true;
	if( false == $images_path_broken )
	{
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1) );
			if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif' || $ext == 'svg' )
			{
				array_push( $files, $file );
			}
		}
		closedir( $handle );
	}
	else
	{
		$file = array();
	}
	
	echo '<option></option>';
	
	if( count( $files) != 0 )
	{
		sort( $files );
		foreach( $files as $file )
		{
			$image_list_option = '<option value="' . $file . '"';
			if( $current_value == $file )
			{
				$image_list_option .= ' selected="selected"';
			}
			$image_list_option .= '>' . $file . '</option>' . "\n";
			echo $image_list_option;
		}
	}
}

/**
 * Build "Forced Layout" options list.
 *
 * @since 1.2
 */
function dynamik_list_forced_layout_options( $selected = '' )
{
	$dynamik_forced_layout_options = array(
		"add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );" => "Content-Sidebar",
		"add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );" => "Sidebar-Content",
		"add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar_sidebar' );" => "Content-Sidebar-Sidebar",
		"add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_sidebar_content' );" => "Sidebar-Sidebar-Content",
		"add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content_sidebar' );" => "Sidebar-Content-Sidebar",
		"add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );" => "Full Width Content"
	);
	
	foreach( $dynamik_forced_layout_options as $forced_layout_key => $forced_layout_name )
	{
		$option = '<option value="' . $forced_layout_key . '"';
			
		if( $forced_layout_key == $selected )
		{
			$option .= ' selected="selected"';
		}

		$option .= '>' . $forced_layout_name . '</option>';
		
		echo $option;
	}
}

/**
 * Build "Label Widths" options list.
 *
 * @since 1.3
 */
function dynamik_list_label_width_options( $selected = '' )
{
	$dynamik_custom_labels = get_option( 'dynamik_gen_custom_labels' );
	asort( $dynamik_custom_labels );
	$dynamik_label_width_options = array();

	if( !empty( $dynamik_custom_labels ) )
	{
		foreach( $dynamik_custom_labels as $key => $value )
		{
			if( substr( $value['label_id'], 0, 6 ) == 'width-' && is_numeric( substr( $value['label_id'], 6, 2 ) ) )
			{
				$dynamik_label_width_options['label-' . $key] = $value['label_name'];
			}
		}
	}
	
	foreach( $dynamik_label_width_options as $label_width_key => $label_width_name )
	{
		$option = '<option value="' . $label_width_key . '"';
			
		if( $label_width_key == $selected )
		{
			$option .= ' selected="selected"';
		}

		$option .= '>' . $label_width_name . '</option>';
		
		echo $option;
	}
}

/**
 * Build "Custom Widget Area Shortcodes" options list.
 *
 * @since 1.6
 */
function dynamik_list_wa_shortcode_options( $selected = '' )
{
	$dynamik_custom_widget_areas = get_option( 'dynamik_gen_custom_widget_areas' );
	asort( $dynamik_custom_widget_areas );
	$dynamik_wa_shortcode_options = array();

	if( !empty( $dynamik_custom_widget_areas ) )
	{
		foreach( $dynamik_custom_widget_areas as $key => $value )
		{
			$dynamik_wa_shortcode_options[$key] = $value['widget_name'];
		}
	}
	
	foreach( $dynamik_wa_shortcode_options as $wa_shortcode_key => $wa_shortcode_name )
	{
		$option = '<option value="' . $wa_shortcode_key . '"';
			
		if( $wa_shortcode_key == $selected )
		{
			$option .= ' selected="selected"';
		}

		$option .= '>' . $wa_shortcode_name . '</option>';
		
		echo $option;
	}
}

/**
 * Build "Custom Hook Box Shortcodes" options list.
 *
 * @since 1.6
 */
function dynamik_list_hb_shortcode_options( $selected = '' )
{
	$dynamik_custom_hook_boxes = get_option( 'dynamik_gen_custom_hook_boxes' );
	asort( $dynamik_custom_hook_boxes );
	$dynamik_hb_shortcode_options = array();

	if( !empty( $dynamik_custom_hook_boxes ) )
	{
		foreach( $dynamik_custom_hook_boxes as $key => $value )
		{
			$dynamik_hb_shortcode_options[$key] = $value['hook_name'];
		}
	}
	
	foreach( $dynamik_hb_shortcode_options as $hb_shortcode_key => $hb_shortcode_name )
	{
		$option = '<option value="' . $hb_shortcode_key . '"';
			
		if( $hb_shortcode_key == $selected )
		{
			$option .= ' selected="selected"';
		}

		$option .= '>' . $hb_shortcode_name . '</option>';
		
		echo $option;
	}
}

/**
 * Build "Code Snippets" list.
 *
 * @since 1.5
 */
function dynamik_list_code_snippets( $selected = '' )
{
	$dynamik_code_snippets = array(
		"// Your PHP comment text goes here" => "Add Simple Comment",
		"/**\n * Your PHP comment text goes here\n */" => "Add Complex Comment",
		"genesis();" => "Insert genesis() Function"
	);
	
	foreach( $dynamik_code_snippets as $code_snippet_key => $code_snippet_name )
	{
		$option = '<option value="' . $code_snippet_key . '"';
			
		if( $code_snippet_key == $selected )
		{
			$option .= ' selected="selected"';
		}

		$option .= '>' . $code_snippet_name . '</option>';
		
		echo $option;
	}
}

/**
 * Build "BB Templates Shortcode" options list.
 *
 * @since 2.0
 */
function dynamik_list_bb_templates_shortcode_options( $selected = '' ) {
	
	global $post;
	$query = new WP_Query( array(
	
		'post_type' => 'fl-builder-template',
		'post_status' => 'publish',
		'posts_per_page' => -1
	
	) );
	
	$post_names = array();
	while ( $query->have_posts() ) {
	
		$query->the_post();
		$post_names[get_the_title()] = $post->post_name;
		
	}
	
	wp_reset_query();

	asort( $post_names );
	
	foreach( $post_names as $post_name => $post_slug ) {
		
		$option = '<option value="' . $post_slug . '"';
			
		if ( $post_name == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $post_name . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Build PHP "actions" drop-down list.
 *
 * @since 1.2
 * @return PHP "actions" array.
 */
function dynamik_php_actions_array()
{
	$dynamik_php_actions_array = array(
		"-- Document <head> --" => array(
			"Doctype" => "( 'genesis_doctype', 'genesis_do_doctype' );",
			"WP Title" => "( 'genesis_title', 'wp_title' );",
			"Doc Head Control" => "( 'get_header', 'genesis_doc_head_control' );",
			"SEO Meta Description" => "( 'genesis_meta', 'genesis_seo_meta_description' );",
			"SEO Meta Keywords" => "( 'genesis_meta', 'genesis_seo_meta_keywords' );",
			"Robots Meta" => "( 'genesis_meta', 'genesis_robots_meta' );",
			"Responsive Viewport" => "( 'genesis_meta', 'genesis_responsive_viewport' );",
			"Load Favicon" => "( 'wp_head', 'genesis_load_favicon' );",
			"Meta Pingback" => "( 'wp_head', 'genesis_do_meta_pingback' );",
			"Canonical" => "( 'wp_head', 'genesis_canonical', 5 );",
			"Rel Author" => "( 'wp_head', 'genesis_rel_author' );",
			"Header Scripts" => "( 'wp_head', 'genesis_header_scripts' );",
			"Custom Header" => "( 'after_setup_theme', 'genesis_custom_header' );",
			"Custom Header Style" => "( 'wp_head', 'genesis_custom_header_style' );",
			"Load Stylesheet" => "( 'genesis_meta', 'genesis_load_stylesheet' );",
			"Feed Redirect" => "( 'template_redirect', 'genesis_feed_redirect' );",
			"Create Initial Layouts" => "( 'genesis_init', 'genesis_create_initial_layouts', 0 );",
			"SEO Compatibility Check" => "( 'after_setup_theme', 'genesis_seo_compatibility_check', 5 );",
			"HTML5 IE Fix" => "( 'wp_head', 'genesis_html5_ie_fix' );"
		),
		"-- Header --" => array(
			"Header Markup Open" => "( 'genesis_header', 'genesis_header_markup_open', 5 );",
			"Header" => "( 'genesis_header', 'genesis_do_header' );",
			"Header Markup Close" => "( 'genesis_header', 'genesis_header_markup_close', 15 );",
			"Site Title" => "( 'genesis_site_title', 'genesis_seo_site_title' );",
			"Site Description" => "( 'genesis_site_description', 'genesis_seo_site_description' );"
		),
		"-- Menus --" => array(
			"Register Nav Menus" => "( 'after_setup_theme', 'genesis_register_nav_menus' );",
			"Primary Navbar" => "( 'genesis_after_header', 'genesis_do_nav' );",
			"Secondary Navbar" => "( 'genesis_after_header', 'genesis_do_subnav' );"
		),
		"-- Misc. Before Loop --" => array(
			"Breadcrumbs" => "( 'genesis_before_loop', 'genesis_do_breadcrumbs' );",
			"Taxonomy Title/Description" => "( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );",
			"Author Box Archive" => "( 'genesis_before_loop', 'genesis_do_author_box_archive', 15 );",
			"CPT Archive Title/Description" => "( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );",
			"Search Title" => "( 'genesis_before_loop', 'genesis_do_search_title' );",
			"example_text" => "( 'genesis_loop_else', 'genesis_do_noposts' );"
		),
		"-- Misc. Loop --" => array(
			"Loop" => "( 'genesis_loop', 'genesis_do_loop' );",
			"'No Posts' Text" => "( 'genesis_loop_else', 'genesis_do_noposts' );",
			"Posts Nav" => "( 'genesis_after_endwhile', 'genesis_posts_nav' );",
			"404 Content" => "( 'genesis_loop', 'genesis_404' );"
		),
		"-- HTML5 Loop --" => array(
			"Post Format Image" => "( 'genesis_entry_header', 'genesis_do_post_format_image', 5 );",
			"Entry Header Markup Open" => "( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );",
			"Entry Header Markup Close" => "( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );",
			"Post Title" => "( 'genesis_entry_header', 'genesis_do_post_title' );",
			"Post Image" => "( 'genesis_entry_content', 'genesis_do_post_image', 8 );",
			"Post Format Image" => "( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );",
			"Post Content" => "( 'genesis_entry_content', 'genesis_do_post_content' );",
			"Post Permalink" => "( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );",
			"Post Content Nav" => "( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );",
			"Post Info" => "( 'genesis_entry_header', 'genesis_post_info', 12 );",
			"Entry Footer Markup Open" => "( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );",
			"Entry Footer Markup Close" => "( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );",
			"Post Meta" => "( 'genesis_entry_footer', 'genesis_post_meta' );",
			"Author Box Single" => "( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );",
			"Grid Loop Content" => "( 'genesis_entry_content', 'genesis_grid_loop_content' );",
			"Add ID To Global Exclude" => "( 'genesis_after_entry', 'genesis_add_id_to_global_exclude' );",
			"Page Archive Content" => "( 'genesis_entry_content', 'genesis_page_archive_content' );"
		),
		"-- Pre-HTML5 Loop --" => array(
			"Post Format Image" => "( 'genesis_before_post_title', 'genesis_do_post_format_image' );",
			"Post Title" => "( 'genesis_post_title', 'genesis_do_post_title' );",
			"Post Image" => "( 'genesis_post_content', 'genesis_do_post_image', 8 );",
			"Post Format Image" => "( 'genesis_before_post_title', 'genesis_do_post_format_image' );",
			"Post Content" => "( 'genesis_post_content', 'genesis_do_post_content' );",
			"Post Permalink" => "( 'genesis_post_content', 'genesis_do_post_permalink' );",
			"Post Content Nav" => "( 'genesis_post_content', 'genesis_do_post_content_nav' );",
			"Post Info" => "( 'genesis_before_post_content', 'genesis_post_info', 12 );",
			"Post Meta" => "( 'genesis_after_post_content', 'genesis_post_meta' );",
			"Author Box Single" => "( 'genesis_after_post', 'genesis_do_author_box_single' );",
			"Grid Loop Content" => "( 'genesis_post_content', 'genesis_grid_loop_content' );",
			"Add ID To Global Exclude" => "( 'genesis_after_post', 'genesis_add_id_to_global_exclude' );",
			"Page Archive Content" => "( 'genesis_post_content', 'genesis_page_archive_content' );",
			"Author Box Single" => "( 'genesis_after_post', 'genesis_do_author_box_single' );"
		),
		"-- Comments --" => array(
			"Comments Template (HTML5)" => "( 'genesis_after_entry', 'genesis_get_comments_template' );",
			"Comments Template (Pre-HTML5)" => "( 'genesis_after_post', 'genesis_get_comments_template' );",
			"Comments" => "( 'genesis_comments', 'genesis_do_comments' );",
			"Pings" => "( 'genesis_pings', 'genesis_do_pings' );",
			"Default List Comments" => "( 'genesis_list_comments', 'genesis_default_list_comments' );",
			"Default List Pings" => "( 'genesis_list_pings', 'genesis_default_list_pings' );",
			"Comment Form" => "( 'genesis_comment_form', 'genesis_do_comment_form' );"
		),
		"-- Sidebars --" => array(
			"Build Primary Sidebar" => "( 'genesis_after_content', 'genesis_get_sidebar' );",
			"Build Secondary Sidebar" => "( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );",
			"Get Primary Sidebar" => "( 'genesis_sidebar', 'genesis_do_sidebar' );",
			"Get Secondary Sidebar" => "( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );",
			"Load Widgets" => "( 'widgets_init', 'genesis_load_widgets' );",
			"Remove Default Header Right Widgets" => "( 'load-themes.php', 'genesis_remove_default_widgets_from_header_right' );"
		),
		"-- Footer --" => array(
			"Footer Markup Open" => "( 'genesis_footer', 'genesis_footer_markup_open', 5 );",
			"Footer" => "( 'genesis_footer', 'genesis_do_footer' );",
			"Footer Markup Close" => "( 'genesis_footer', 'genesis_footer_markup_close', 15 );",
			"Footer Widget Areas" => "( 'genesis_before_footer', 'genesis_footer_widget_areas' );",
			"Footer Scripts" => "( 'wp_footer', 'genesis_footer_scripts' );"
		)
	);
	
	return $dynamik_php_actions_array;
}

/**
 * Build the PHP Builder "actions" menu.
 *
 * @since 1.2
 */
function dynamik_build_php_actions_menu( $selected = '' )
{
	$dynamik_php_actions_array = dynamik_php_actions_array();
	
	foreach( $dynamik_php_actions_array as $action_type => $actions )
	{
		echo '<optgroup label="' . $action_type . '">';
		foreach( $actions as $action_slug => $action_data )
		{
			$option = '<option value="' . $action_data . '"';
				
			if( $action_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $action_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build PHP "filters" drop-down list.
 *
 * @since 1.2
 * @return PHP "filters" array.
 */
function dynamik_php_filters_array()
{
	$dynamik_php_filters_array = array(
		'-- Header Section --' => array(
			'SEO Title' => 'genesis_seo_title',
			'SEO Description' => 'genesis_seo_description',
			'Pre-load Favicon' => 'genesis_pre_load_favicon',
			'Header Scripts' => 'genesis_header_scripts'
		),
		'-- Menus --' => array(
			'Nav Default Args' => 'genesis_nav_default_args',
			'Pre Nav' => 'genesis_pre_nav',
			'Nav Home Text' => 'genesis_nav_home_text',
			'Nav Items' => 'genesis_nav_items',
			'Nav' => 'genesis_nav'
		),
		'-- The Loop --' => array(
			'Custom Loop Args' => 'genesis_custom_loop_args',
			'Post Title Text' => 'genesis_post_title_text',
			'Post Title Output' => 'genesis_post_title_output',
			'"No Posts" Text' => 'genesis_noposts_text',
			'Post Info' => 'genesis_post_info',
			'Post Meta' => 'genesis_post_meta',
			'Author Box Gravatar Size' => 'genesis_author_box_gravatar_size',
			'Author Box Title' => 'genesis_author_box_title'
		),
		'-- Post Shortcodes --' => array(
			'Post Date' => 'genesis_post_date_shortcode',
			'Post Time' => 'genesis_post_time_shortcode',
			'Post Author Link' => 'genesis_post_author_link_shortcode',
			'Post Author' => 'genesis_post_author_shortcode',
			'Post Comment' => 'genesis_post_comments_shortcode',
			'Post Tags' => 'genesis_post_tags_shortcode',
			'Post Categories' => 'genesis_post_categories_shortcode',
			'Post Edit' => 'genesis_post_edit_shortcode'
		),
		'-- Comment Section --' => array(
			'Title Comments' => 'genesis_title_comments',
			'No Comments Text' => 'genesis_no_comments_text',
			'Comments Closed Text' => 'genesis_comments_closed_text',
			'Title Pings' => 'genesis_title_pings',
			'No Pings Text' => 'genesis_no_pings_text',
			'Comment List Args' => 'genesis_comment_list_args',
			'Ping List Args' => 'genesis_ping_list_args',
			'Author Says Text' => 'comment_author_says_text',
			'Comment Form Args' => 'genesis_comment_form_args'
		),
		'-- Misc. --' => array(
			'Breadcrumb Args' => 'genesis_breadcrumb_args',
			'Breadcrumb Home Link' => 'genesis_breadcrumb_homelink',
			'Breadcrumb Blog Link' => 'genesis_breadcrumb_bloglink',
			'Gravatar Sizes' => 'genesis_gravatar_sizes'
		),
		'-- Search Form --' => array(
			'Search Query' => 'the_search_query',
			'Search Text' => 'genesis_search_text',
			'Search Button Text' => 'genesis_search_button_text',
			'Search Form' => 'genesis_search_form'
		),
		'-- Images --' => array(
			'Get Image Default Args' => 'genesis_get_image_default_args',
			'Pre Get Image' => 'genesis_pre_get_image',
			'Get Image' => 'genesis_get_image'
		),
		'-- Footer Section --' => array(
			'"Back To Top" Text' => 'genesis_footer_backtotop_text',
			'Footer Creds Text' => 'genesis_footer_creds_text',
			'Footer Output' => 'genesis_footer_output',
			'Footer Scripts' => 'genesis_footer_scripts'
		),
		'-- Footer Shortcodes --' => array(
			'Footer "Back To Top"' => 'genesis_footer_backtotop_shortcode',
			'Footer Copyright' => 'genesis_footer_copyright_shortcode',
			'Footer Child Theme Link' => 'genesis_footer_childtheme_link_shortcode',
			'Footer Genesis Link' => 'genesis_footer_genesis_link_shortcode',
			'Footer StudioPress Link' => 'genesis_footer_studiopress_link_shortcode',
			'Footer WordPress Link' => 'genesis_footer_wordpress_link_shortcode',
			'Footer Login/out' => 'genesis_footer_loginout_shortcode'
		)
	);
	
	return $dynamik_php_filters_array;
}

/**
 * Build the PHP Builder "filters" menu.
 *
 * @since 1.2
 */
function dynamik_build_php_filters_menu( $selected = '' )
{
	$dynamik_php_filters_array = dynamik_php_filters_array();
	
	foreach( $dynamik_php_filters_array as $filter_type => $filters )
	{
		echo '<optgroup label="' . $filter_type . '">';
		foreach( $filters as $filter_slug => $filter_data )
		{
			$option = '<option value="' . $filter_data . '"';
				
			if( $filter_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $filter_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build an options list of Genesis hooks.
 *
 * @since 1.0
 */
function dynamik_list_hooks( $selected = '' )
{
	$genesis_hooks = array(
		'-- <head> Hooks --' => array(
			'genesis_doctype',
			'genesis_title',
			'genesis_meta',
			'wp_head'	
		),
		'-- Page Hooks --' => array(
			'genesis_before',
			'genesis_after'		
		),
		'-- Header Hooks --' => array(
			'genesis_before_header',
			'genesis_header',
			'genesis_after_header',
			'genesis_site_title',
			'genesis_site_description',
			'genesis_header_right'
		),
		'-- Content Hooks --' => array(
			'genesis_before_content_sidebar_wrap',
			'genesis_after_content_sidebar_wrap',
			'genesis_before_content',
			'genesis_after_content'
		),
		'-- HTML5 Content Hooks --' => array(
			'genesis_before_entry',
			'genesis_after_entry',
			'genesis_entry_header',
			'genesis_before_entry_content',
			'genesis_entry_content',
			'genesis_after_entry_content',
			'genesis_entry_footer'
		),
		'-- XHTML Content Hooks --' => array(
			'genesis_before_post',
			'genesis_after_post',
			'genesis_before_post_title',
			'genesis_post_title',
			'genesis_after_post_title',
			'genesis_before_post_content',
			'genesis_post_content',
			'genesis_after_post_content'
		),
		'-- Loop Hooks --' => array(
			'genesis_before_loop',
			'genesis_loop',
			'genesis_after_loop',
			'genesis_after_endwhile',
			'genesis_loop_else'
		),
		'-- Comment Hooks --' => array(
			'genesis_before_comments',
			'genesis_comments',
			'genesis_after_comments',
			'genesis_list_comments',
			'genesis_before_pings',
			'genesis_pings',
			'genesis_after_pings',
			'genesis_before_comment',
			'genesis_after_comment',
			'genesis_before_comment_form',
			'genesis_comment_form',
			'genesis_after_comment_form'
		),
		'-- Sidebar Hooks --' => array(
			'genesis_sidebar',
			'genesis_before_sidebar_widget_area',
			'genesis_after_sidebar_widget_area',
			'genesis_sidebar_alt',
			'genesis_before_sidebar_alt_widget_area',
			'genesis_after_sidebar_alt_widget_area'
		),
		'-- Footer Hooks --' => array(
			'genesis_before_footer',
			'genesis_footer',
			'genesis_after_footer'
		),
		'-- EZ Home Hooks --' => array(
			'dynamik_hook_before_ez_home',
			'dynamik_hook_home',
			'dynamik_hook_after_ez_home'
		)
	);
	
	foreach( $genesis_hooks as $optgroup => $options )
	{
		echo '<optgroup style="font-size:14px;color:#57A18D;" label="' . $optgroup . '">';
		foreach( $options as $option )
		{
			$output = '<option style="color:#000000;" value="' . $option . '"';
				
			if( $option == $selected )
			{
				$output .= ' selected="selected"';
			}

			$output .= '>' . $option . '</option>';
			
			echo $output;
		}
		echo '</optgroup>';
	}
}

/**
 * Build Custom Conditional Examples options list.
 *
 * @since 1.0
 */
function dynamik_list_conditional_examples( $selected = '' )
{
	$dynamik_conditional_examples = array(
		'examples' => 'Examples:',
		'is_page|is_page()' => 'Is Page',
		'is_not_page|! is_page()' => 'Is NOT Page',
		'is_page_template|is_page_template()' => 'Is Page Template',
		'is_not_page_template|! is_page_template()' => 'Is NOT Page Template',
		'is_single_post|is_single()' => 'Is Single Post',
		'is_not_single_post|! is_single()' => 'Is NOT Single Post',
		'is_front_page|is_front_page()' => 'Is Front Page',
		'is_not_front_page|! is_front_page()' => 'Is NOT Front Page',
		'is_archive|is_archive()' => 'Is Archive',
		'is_not_archive|! is_archive()' => 'Is NOT Archive',
		'is_category|is_category()' => 'Is Category',
		'is_not_category|! is_category()' => 'Is NOT Category',
		'is_tag|is_tag()' => 'Is Tag',
		'is_not_tag|! is_tag()' => 'Is NOT Tag',
		'is_author|is_author()' => 'Is Author',
		'is_not_author|! is_author()' => 'Is NOT Author',
		'has_label_example|dynamik_has_label(&#39;example&#39;)' => 'Has Dynamik Label',
		'is_ss_id|dynamik_is_ss(&#39;sb-id&#39;)' => 'Is Simple Sidebar'
	);
	
	foreach( $dynamik_conditional_examples as $conditional_examples_key => $conditional_examples_name )
	{
		$option = '<option value="' . $conditional_examples_key . '"';
			
		if( $conditional_examples_key == $selected )
		{
			$option .= ' selected="selected"';
		}

		$option .= '>' . $conditional_examples_name . '</option>';
		
		echo $option;
	}
}
