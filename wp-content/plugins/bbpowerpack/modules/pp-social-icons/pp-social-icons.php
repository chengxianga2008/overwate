<?php

/**
 * @class FLIconGroupModule
 */
class PPSocialIconsModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Social Icons', 'bb-powerpack'),
			'description'   	=> __('Display a group of linked social icons.', 'bb-powerpack'),
			'category'			=> BB_POWERPACK_CAT,
            'dir'           	=> BB_POWERPACK_DIR . 'modules/pp-social-icons/',
            'url'           	=> BB_POWERPACK_URL . 'modules/pp-social-icons/',
			'editor_export' 	=> true,
			'partial_refresh'	=> true
		));

		$this->add_css( 'font-awesome' );
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPSocialIconsModule', array(
	'icons'         => array(
		'title'         => __('Icons', 'bb-powerpack'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'icons'         => array(
						'type'          => 'form',
						'label'         => __('Icon', 'bb-powerpack'),
						'form'          => 'social_icon_form', // ID from registered form below
						'preview_text'  => 'icon', // Name of a field to use for the preview text
						'multiple'      => true,
					)
				)
			)
		)
	),
	'style'         => array( // Tab
		'title'         => __('Style', 'bb-powerpack'), // Tab title
		'sections'      => array( // Tab Sections
			'colors'        => array( // Section
				'title'         => __('Colors', 'bb-powerpack'), // Section Title
				'fields'        => array( // Section Fields
					'color'         => array(
						'type'          => 'color',
						'label'         => __('Color', 'bb-powerpack'),
						'show_reset'    => true,
					),
					'hover_color' => array(
						'type'          => 'color',
						'label'         => __('Hover Color', 'bb-powerpack'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'bg_color'      => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'bb-powerpack'),
						'show_reset'    => true
					),
					'bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'bb-powerpack'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
				)
			),
			'structure'     => array( // Section
				'title'         => __('Structure', 'bb-powerpack'), // Section Title
				'fields'        => array( // Section Fields
					'size'          => array(
						'type'          => 'text',
						'label'         => __('Size', 'bb-powerpack'),
						'default'       => '30',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'box_size'		=> array(
						'type'          => 'text',
						'label'         => __('Box Size', 'bb-powerpack'),
						'default'       => '60',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'spacing'       => array(
						'type'          => 'text',
						'label'         => __('Spacing', 'bb-powerpack'),
						'default'       => '10',
						'maxlength'     => '2',
						'size'          => '4',
						'description'   => 'px'
					),
					'radius'		=> array(
						'type'          => 'text',
						'label'         => __('Round Corners', 'bb-powerpack'),
						'default'       => '100',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'direction'		=> array(
						'type'          => 'pp-switch',
						'label'         => __('Direction', 'bb-powerpack'),
						'default'       => 'horizontal',
						'options'       => array(
							'horizontal'    => __('Horizontal', 'bb-powerpack'),
							'vertical'      => __('Vertical', 'bb-powerpack'),
						)
					),
					'align'         => array(
						'type'          => 'pp-switch',
						'label'         => __('Desktop Alignment', 'bb-powerpack'),
						'default'       => 'left',
						'options'       => array(
							'left'          => __('Left', 'bb-powerpack'),
							'center'        => __('Center', 'bb-powerpack'),
							'right'         => __('Right', 'bb-powerpack')
						)
					),
				)
			),
			'responsive'	=> array(
				'title'			=> __('Responsive', 'bb-powerpack'),
				'fields'		=> array(
					'breakpoint'	=> array(
						'type'			=> 'text',
						'label'			=> __('Breakpoint', 'bb-powerpack'),
						'description'	=> 'px',
						'default'		=> 768,
						'size'			=> 4,
						'preview'		=> array(
							'type'			=> 'none'
						)
					),
					'responsive_align' => array(
						'type'          => 'pp-switch',
						'label'         => __('Alignment', 'bb-powerpack'),
						'default'       => 'center',
						'options'       => array(
							'left'          => __('Left', 'bb-powerpack'),
							'center'        => __('Center', 'bb-powerpack'),
							'right'         => __('Right', 'bb-powerpack')
						)
					)
				)
			)
		)
	)
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('social_icon_form', array(
	'title' => __('Add Icon', 'bb-powerpack'),
	'tabs'  => array(
		'general'       => array( // Tab
			'title'         => __('General', 'bb-powerpack'), // Tab title
			'sections'      => array( // Tab Sections
				'general'       => array( // Section
					'title'         => '', // Section Title
					'fields'        => array( // Section Fields
						'icon'          => array(
							'type'          => 'select',
							'label'         => __('Select Icon', 'bb-powerpack'),
							'default'		=> '',
							'options'		=> array(
								''				=> __('None', 'bb-powerpack'),
								'fa-envelope'	=> __('Email', 'bb-powerpack'),
								'fa-facebook'	=> __('Facebook', 'bb-powerpack'),
								'fa-twitter'	=> __('Twitter', 'bb-powerpack'),
								'fa-google-plus'=> __('Google Plus', 'bb-powerpack'),
								'fa-youtube'	=> __('YouTube', 'bb-powerpack'),
								'fa-linkedin'	=> __('LinkedIn', 'bb-powerpack'),
								'fa-pinterest-p'=> __('Pinterest', 'bb-powerpack'),
								'fa-instagram'	=> __('Instagram', 'bb-powerpack'),
								'fa-dribbble'	=> __('Dribbble', 'bb-powerpack'),
								'fa-flickr'		=> __('Flickr', 'bb-powerpack'),
								'fa-github-alt'	=> __('GitHub', 'bb-powerpack'),
								'fa-rss'		=> __('RSS', 'bb-powerpack'),
								'fa-vimeo'		=> __('Vimeo', 'bb-powerpack'),
							)
						),
						'link'          => array(
							'type'          => 'link',
							'label'         => __('Link', 'bb-powerpack'),
							'connections'	=> array('url')
						),
						'link_target'	=> array(
							'type'          => 'select',
							'label'         => __('Link Target', 'bb-powerpack'),
							'default'       => '_blank',
							'options'       => array(
								'_self' 		=> __('Same Window', 'bb-powerpack'),
								'_blank'    	=> __('New Window', 'bb-powerpack')
							)
						)
					)
				)
			)
		),
		'style'         => array( // Tab
			'title'         => __('Style', 'bb-powerpack'), // Tab title
			'sections'      => array( // Tab Sections
				'colors'        => array( // Section
					'title'         => __('Colors', 'bb-powerpack'), // Section Title
					'fields'        => array( // Section Fields
						'color'         => array(
							'type'          => 'color',
							'label'         => __('Color', 'bb-powerpack'),
							'show_reset'    => true
						),
						'hover_color' => array(
							'type'          => 'color',
							'label'         => __('Hover Color', 'bb-powerpack'),
							'show_reset'    => true,
							'preview'       => array(
								'type'          => 'none'
							)
						),
						'bg_color'      => array(
							'type'          => 'color',
							'label'         => __('Background Color', 'bb-powerpack'),
							'show_reset'    => true
						),
						'bg_hover_color' => array(
							'type'          => 'color',
							'label'         => __('Background Hover Color', 'bb-powerpack'),
							'show_reset'    => true,
							'preview'       => array(
								'type'          => 'none'
							)
						)
					)
				)
			)
		)
	)
));
