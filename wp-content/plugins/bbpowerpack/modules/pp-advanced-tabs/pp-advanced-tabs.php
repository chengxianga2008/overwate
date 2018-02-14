<?php

/**
 * @class PPAdvancedTabsModule
 */
class PPAdvancedTabsModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Advanced Tabs', 'bb-powerpack'),
			'description'   	=> __('Display a collection of tabbed content.', 'bb-powerpack'),
			'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-advanced-tabs/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-advanced-tabs/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
			'partial_refresh'	=> true
		));

		$this->add_css('font-awesome');
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPAdvancedTabsModule', array(
	'items'         => array(
		'title'         => __('Items', 'bb-powerpack'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'items'         => array(
						'type'          => 'form',
						'label'         => __('Item', 'bb-powerpack'),
						'form'          => 'tab_items_form', // ID from registered form below
						'preview_text'  => 'label', // Name of a field to use for the preview text
						'multiple'      => true
					),
				)
			)
		)
	),
	'style'        => array(
		'title'         => __('Style', 'bb-powerpack'),
		'sections'      => array(
			'general'       => array(
				'title'         => __('General', 'bb-powerpack'),
				'fields'        => array(
					'layout'        => array(
						'type'          => 'select',
						'label'         => __('Layout', 'bb-powerpack'),
						'default'       => 'horizontal',
						'options'       => array(
							'horizontal'    => __('Horizontal', 'bb-powerpack'),
							'vertical'      => __('Vertical', 'bb-powerpack'),
						)
					),
					'tab_style'        => array(
						'type'          => 'select',
						'label'         => __('Select Style', 'bb-powerpack'),
						'default'       => 'default',
						'options'       => array(
							'default'    => __('Basic', 'bb-powerpack'),
							'style-1'    => __('Style 1', 'bb-powerpack'),
							'style-2'    => __('Style 2', 'bb-powerpack'),
							'style-3'    => __('Style 3', 'bb-powerpack'),
							'style-4'    => __('Style 4', 'bb-powerpack'),
							'style-5'    => __('Style 5', 'bb-powerpack'),
							'style-6'    => __('Style 6', 'bb-powerpack'),
							'style-7'    => __('Style 7', 'bb-powerpack'),
							'style-8'    => __('Style 8', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'default'	=> array(
								'fields'	=> array('border_color', 'label_background_color', 'label_background_active_color', 'label_text_color', 'content_bg_color')
							),
							'style-1'	=> array(
								'fields'	=> array('border_color', 'label_background_color', 'label_background_active_color', 'label_text_color', 'content_bg_color')
							),
							'style-2'	=> array(
								'fields'	=> array('border_color', 'label_background_color', 'label_background_active_color', 'label_text_color', 'content_bg_color')
							),
							'style-3'	=> array(
								'fields'	=> array('label_background_color', 'label_background_active_color', 'label_text_color', 'content_bg_color')
							),
							'style-4'	=> array(
								'fields'	=> array('label_background_color', 'label_background_active_color', 'label_text_color', 'content_bg_color')
							),
							'style-5'	=> array(
								'fields'	=> array('label_background_active_color', 'label_text_color')
							),
							'style-6'	=> array(
								'fields'	=> array('label_text_color', 'content_bg_color')
							),
							'style-7'	=> array(
								'fields'	=> array('border_color', 'label_text_color', 'label_text_hover_color')
							),
							'style-8'	=> array(
								'fields'	=> array('border_color', 'label_background_active_color', 'label_text_color')
							),
						)
					),
					'tab_id_prefix'	=> array(
						'type'			=> 'text',
						'label'			=> __('Custom ID Prefix', 'bb-powerpack'),
						'default'		=> '',
						'placeholder'	=> __('mytab', 'bb-powerpack'),
						'help'			=> __('A prefix that will be applied to ID attribute of tabs\'s in HTML. For example, prefix "mytab" will be applied as "mytab-1", "mytab-2" in ID attribute of Tab 1 and Tab 2 respectively. It should only contain dashes, underscores, letters or numbers. No spaces.', 'bb-powerpack')
					),
					'tab_default'	=> array(
						'type'			=> 'text',
						'label'			=> __('Default Active Tab Index', 'bb-powerpack'),
						'default'		=> 1,
						'help'			=> __('Enter the index number of the tab that will be appeared as default active tab on page load.', 'bb-powerpack')
					),
				)
			),
			'label_style'       => array(
				'title'         => __('Title', 'bb-powerpack'),
				'fields'        => array(
					'label_background_color'  => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'bb-powerpack'),
						'default'       => 'ffffff',
						'show_reset'	=> true,
						'preview'	=> array(
							'type'	=> 'css',
							'selector'	=> '.pp-tabs .pp-tabs-label:not(.pp-tab-active)',
							'property'	=> 'background-color',
						)
					),
					'label_background_active_color'  => array(
						'type'          => 'color',
						'label'         => __('Background Color Active', 'bb-powerpack'),
						'default'       => 'f7f7f7',
						'show_reset'	=> true,
						'preview'	=> array(
							'type'	=> 'css',
							'rules'	=>	array(
								array(
									'selector'	=> '.pp-tabs .pp-tabs-label.pp-tab-active,
									 				.pp-tabs .pp-tabs-label.pp-tab-active:hover,
													.pp-tabs-style-5 .pp-tabs-label .pp-tab-label-inner:after,
													.pp-tabs-style-5 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after,
													.pp-tabs-style-8 .pp-tabs-label:hover .pp-tab-label-inner:after,
													.pp-tabs-style-8 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after,
													.pp-tabs-style-8 .pp-tabs-label:hover,
													.pp-tabs-vertical.pp-tabs-style-2 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after,
													.pp-tabs-style-5 .pp-tabs-panels .pp-tabs-panel-content',
									'property'	=> 'background-color',
								),
								array(
									'selector'	=> '.pp-tabs-style-2 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after',
									'property'	=> 'border-top-color',
								)
							)
						)
					),
					'label_text_color'    => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'bb-powerpack'),
						'default'       => '666666',
						'show_reset'	=> true,
						'preview'	=> array(
							'type'	=> 'css',
							'selector'	=> '.pp-tabs .pp-tabs-label',
							'property'	=> 'color',
						)
                    ),
					'label_active_text_color'    => array(
						'type'          => 'color',
						'label'         => __('Text Color Active', 'bb-powerpack'),
						'default'       => '333333',
						'show_reset'	=> true,
						'preview'	=> array(
							'type'	=> 'css',
							'rules'	=> array(
								array(
									'selector'	=> '.pp-tabs .pp-tabs-label.pp-tab-active, .pp-tabs .pp-tabs-label.pp-tab-active:hover, .pp-tabs .pp-tabs-label:hover, .pp-tabs-style-5 .pp-tabs-label:hover',
									'property'	=> 'color',
								),
								array(
									'selector'	=> '.pp-tabs-style-3 .pp-tabs-label:after, .pp-tabs-style-4 .pp-tabs-label:before, .pp-tabs-style-6 .pp-tabs-label:last-child:before',
									'property'	=> 'background-color',
								)
							)
						)
                    ),
					'border_color'  => array(
						'type'          => 'color',
						'label'         => __('Border Color', 'bb-powerpack'),
						'default'       => 'eeeeee',
						'show_reset'	=> true,
						'preview'	=> array(
							'type'	=> 'css',
							'rules'	=> array(
								array(
									'selector'	=> '.pp-tabs-style-1 .pp-tabs-labels, .pp-tabs-default .pp-tabs-panels, .pp-tabs-default .pp-tabs-panel',
									'property'	=> 'border-color',
								),
								array(
									'selector'	=> '.pp-tabs-style-1 .pp-tabs-labels, .pp-tabs-style-8 .pp-tabs-label .pp-tab-label-inner:after',
									'property'	=> 'background-color',
								),
								array(
									'selector'	=> '.pp-tabs-style-2 .pp-tabs-labels .pp-tabs-label:first-child:before, .pp-tabs-style-2 .pp-tabs-labels .pp-tabs-label::after',
									'property'	=> 'background',
								),
								array(
									'selector'	=> '.pp-tabs-style-7 .pp-tabs-label .pp-tab-label-inner',
									'property'	=> 'border-bottom-color',
								),
								array(
									'selector'	=> '.pp-tabs-style-7 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after, .pp-tabs-style-7 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:before',
									'property'	=> 'border-top-color',
								),
								array(
									'selector'	=> '.pp-tabs-vertical.pp-tabs-style-7 .pp-tabs-label .pp-tab-label-inner',
									'property'	=> 'border-right-color',
								),
								array(
									'selector'	=> '.pp-tabs-vertical.pp-tabs-style-7 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:before, .pp-tabs-vertical.pp-tabs-style-7 .pp-tabs-label.pp-tab-active .pp-tab-label-inner:after',
									'property'	=> 'border-left-color',
								)
							)
						)
					),
				)
			),
			'content_style'       => array(
				'title'         => __('Content', 'bb-powerpack'),
				'fields'        => array(
					'content_bg_color'  => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'bb-powerpack'),
						'default'       => 'f7f7f7',
						'show_reset'	=> true,
						'preview'		=> array(
							'type'			=> 'css',
							'selector'		=> '.pp-tabs-panels .pp-tabs-panel-content',
							'property'		=> 'background-color'
						)
					),
					'content_text_color'  => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'bb-powerpack'),
						'default'       => '333333',
						'show_reset'	=> true,
						'preview'		=> array(
							'type'			=> 'css',
							'selector'		=> '.pp-tabs-panels .pp-tabs-panel-content',
							'property'		=> 'color'
						)
					),
					'content_alignment'        => array(
						'type'          => 'pp-switch',
						'label'         => __('Alignment', 'bb-powerpack'),
						'default'       => 'left',
						'options'       => array(
							'left'    		=> __('Left', 'bb-powerpack'),
							'center'    	=> __('Center', 'bb-powerpack'),
							'right'    		=> __('Right', 'bb-powerpack'),
						),
						'preview'	=> array(
							'type'	=>	'css',
							'selector'	=> '.pp-tabs-panels .pp-tabs-panel-content',
							'property'	=> 'text-align'
						)
					),
				)
			)
		)
	),
	'tab_icon_style'	=> array(
		'title'	=>	__('Icon', 'bb-powerpack'),
		'sections'	=> array(
			'icon_style'       => array(
				'title'         => __('General', 'bb-powerpack'),
				'fields'        => array(
					'tab_icon_position'        => array(
						'type'          => 'select',
						'label'         => __('Icon Position', 'bb-powerpack'),
						'default'       => 'left',
						'options'       => array(
							'top'    		=> __('Top', 'bb-powerpack'),
							'bottom'    	=> __('Bottom', 'bb-powerpack'),
							'left'    		=> __('Left', 'bb-powerpack'),
							'right'    		=> __('Right', 'bb-powerpack'),
						),
					),
					'tab_icon_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Size', 'bb-powerpack'),
                        'description'   => 'px',
                        'size'			=> 5,
						'maxlength'		=> 3,
                        'default'       => '20',
                        'preview'       => array(
                            'type'      => 'css',
							'selector'  => '.pp-tabs-label .pp-tab-icon, .pp-tabs-label .pp-tab-icon:before',
							'property'  => 'font-size',
							'unit'      => 'px'
                        )
                    ),
				)
			),
			'responsive_toggle_icons'	=> array(
				'title'	=> __('Responsive Toggle Icons', 'bb-powerpack'),
				'fields'	=> array(
					'tab_open_icon' => array(
						'type'          => 'icon',
						'label'         => __('Open Icon', 'bb-powerpack'),
						'show_remove'   => true
					),
					'tab_close_icon' => array(
						'type'          => 'icon',
						'label'         => __('Close Icon', 'bb-powerpack'),
						'show_remove'   => true
					),
					'tab_toggle_icon_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Size', 'bb-powerpack'),
                        'description'   => 'px',
                        'size'			=> 5,
						'maxlength'		=> 3,
                        'default'       => '16',
                        'preview'       => array(
                            'type'      => 'css',
							'selector'  => '.pp-tabs-panel-label .pp-toggle-icon',
							'property'  => 'font-size',
							'unit'      => 'px'
                        )
                    ),
					'tab_toggle_icon_color'  => array(
						'type'          => 'color',
						'label'         => __('Color', 'bb-powerpack'),
						'default'       => '333333',
						'preview'	=> array(
							'type'	=> 'css',
							'selector'	=> '.pp-tabs-panel-label .pp-toggle-icon',
							'property'	=> 'color'
						)
					),
				)
			)
		)
	),
	'typography'        => array(
		'title'         => __('Typography', 'bb-powerpack'),
		'sections'      => array(
			'label_typography'	=> array(
				'title'	=> __('Title', 'bb-powerpack'),
				'fields'	=> array(
					'tab_label_font' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-tabs-labels .pp-tabs-label .pp-tab-title'
                        )
                    ),
					'tab_title_size'        => array(
						'type'          => 'pp-switch',
						'label'         => __('Font Size', 'bb-powerpack'),
						'default'       => 'default',
						'options'       => array(
							'default'    => __('Default', 'bb-powerpack'),
							'custom'    => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('tab_label_font_size')
							)
						)
					),
					'tab_label_font_size'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 16,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-tabs-labels .pp-tabs-label .pp-tab-title',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
					'tab_label_line_height'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 1.4,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-tabs-labels .pp-tabs-label .pp-tab-title',
                                    'property'      => 'line-height',
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
					'label_text_transform'    => array(
                        'type'                      => 'select',
                        'label'                     => __('Text Transform', 'bb-powerpack'),
                        'default'                   => 'none',
                        'options'                   => array(
                            'none'                  => __('Default', 'bb-powerpack'),
                            'lowercase'                => __('lowercase', 'bb-powerpack'),
                            'uppercase'                 => __('UPPERCASE', 'bb-powerpack'),
                        ),
						'preview'           => array(
							'type'			=> 'css',
							'selector'      => '.pp-tabs-labels .pp-tabs-label .pp-tab-title',
							'property'      => 'text-transform',
						),
                    ),
				)
			),
			'content_typography'	=> array(
				'title'	=> __('Content', 'bb-powerpack'),
				'fields'	=> array(
					'tab_content_font' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-tabs-panels .pp-tabs-panel-content'
                        )
                    ),
					'tab_content_size'        => array(
						'type'          => 'pp-switch',
						'label'         => __('Font Size', 'bb-powerpack'),
						'default'       => 'default',
						'options'       => array(
							'default'    => __('Default', 'bb-powerpack'),
							'custom'    => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('tab_content_font_size')
							)
						)
					),
					'tab_content_font_size'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 15,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-tabs-panels .pp-tabs-panel-content',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
					'tab_content_line_height'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 1.4,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-tabs-panels .pp-tabs-panel-content',
                                    'property'      => 'line-height',
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
				)
			),
		)
	)
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('tab_items_form', array(
	'title' => __('Add Item', 'bb-powerpack'),
	'tabs'  => array(
		'general'      => array(
			'title'         => __('General', 'bb-powerpack'),
			'sections'      => array(
				'general'       => array(
					'title'         => '',
					'fields'        => array(
						'tab_font_icon' => array(
							'type'          => 'icon',
							'label'         => __('Icon', 'bb-powerpack'),
							'show_remove'   => true
						),
						'label'         => array(
							'type'          => 'text',
							'label'         => __('Title', 'bb-powerpack'),
							'connections'   => array( 'string', 'html', 'url' ),
						),
					)
				),
				'content'       => array(
					'title'         => __('Content', 'bb-powerpack'),
					'fields'        => array(
						'content'       => array(
							'type'          => 'editor',
							'label'         => '',
							'connections'   => array( 'string', 'html', 'url' ),
						)
					)
				)
			)
		)
	)
));
