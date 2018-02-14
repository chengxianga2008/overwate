<?php

/**
 * @class PPAccordionModule
 */
class PPAccordionModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Advanced Accordion', 'bb-powerpack'),
			'description'   	=> __('Display a collapsible accordion of items.', 'bb-powerpack'),
			'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-advanced-accordion/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-advanced-accordion/',
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
FLBuilder::register_module('PPAccordionModule', array(
	'items'         => array(
		'title'         => __('Items', 'bb-powerpack'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'items'         => array(
						'type'          => 'form',
						'label'         => __('Item', 'bb-powerpack'),
						'form'          => 'pp_accordion_items_form', // ID from registered form below
						'preview_text'  => 'label', // Name of a field to use for the preview text
						'multiple'      => true
					)
				)
			)
		)
	),
	'icon_style'	=> array(
		'title'	=> __('Icon', 'bb-powerpack'),
		'sections'	=> array(
			'accordion_icon_style'	=> array(
				'title'	=> '',
				'fields'	=> array(
					'accordion_icon_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Size', 'bb-powerpack'),
                        'description'   => 'px',
                        'size'			=> 5,
						'maxlength'		=> 3,
                        'default'       => '15',
                        'preview'       => array(
                            'type'      => 'css',
							'selector'  => '.pp-accordion-item .pp-accordion-icon, .pp-accordion-item .pp-accordion-icon:before',
							'property'  => 'font-size',
							'unit'      => 'px'
                        )
                    ),
				)
			),
			'responsive_toggle_icons'	=> array(
				'title'	=> __('Toggle Icons', 'bb-powerpack'),
				'fields'	=> array(
					'accordion_open_icon' => array(
						'type'          => 'icon',
						'label'         => __('Open Icon', 'bb-powerpack'),
						'show_remove'   => true
					),
					'accordion_close_icon' => array(
						'type'          => 'icon',
						'label'         => __('Close Icon', 'bb-powerpack'),
						'show_remove'   => true
					),
					'accordion_toggle_icon_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Size', 'bb-powerpack'),
                        'description'   => 'px',
                        'size'			=> 5,
						'maxlength'		=> 3,
                        'default'       => '14',
                        'preview'       => array(
                            'type'      => 'css',
							'selector'  => '.pp-accordion-item .pp-accordion-button-icon, .pp-accordion-item .pp-accordion-button-icon:before',
							'property'  => 'font-size',
							'unit'      => 'px'
                        )
                    ),
					'accordion_toggle_icon_color'  => array(
						'type'          => 'color',
						'label'         => __('Color', 'bb-powerpack'),
						'default'       => '666666',
						'preview'	=> array(
							'type'	=> 'css',
							'selector'	=> '.pp-accordion-item .pp-accordion-button-icon',
							'property'	=> 'color'
						)
					),
				)
			)
		)
	),
	'style'        => array(
		'title'         => __('Style', 'bb-powerpack'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'item_spacing'     => array(
						'type'          => 'text',
						'label'         => __('Item Spacing', 'bb-powerpack'),
						'default'       => '10',
						'maxlength'     => '2',
						'size'          => '5',
						'description'   => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.pp-accordion-item',
							'property'      => 'margin-bottom',
							'unit'			=> 'px'
						)
					),
					'collapse'   => array(
						'type'          => 'select',
						'label'         => __('Collapse Inactive', 'bb-powerpack'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Yes', 'bb-powerpack'),
							'0'             => __('No', 'bb-powerpack')
						),
						'help'          => __('Choosing yes will keep only one item open at a time. Choosing no will allow multiple items to be open at the same time.', 'bb-powerpack'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'open_first'       => array(
						'type'          => 'select',
						'label'         => __('Expand First Item', 'bb-powerpack'),
						'default'       => '0',
						'options'       => array(
							'1'             => __('Yes', 'bb-powerpack'),
							'0'             => __('No', 'bb-powerpack'),
						),
						'help' 			=> __('Choosing yes will expand the first item by default.', 'bb-powerpack'),
						'toggle'		=> array(
							'0'				=> array(
								'fields'		=> array('open_custom')
							)
						)
					),
					'open_custom'	=> array(
						'type'			=> 'text',
						'label'			=> __('Expand Custom', 'bb-powerpack'),
						'default'		=> '',
						'size'			=> 5,
						'help'			=> __('Add item number to expand by default.', 'bb-powerpack')
					)
				)
			),
			'label_style'       => array(
				'title'         => __('Label', 'bb-powerpack'),
				'fields'        => array(
					'label_background_color'      => array(
						'type'      => 'pp-color',
                        'label'     => __('Background Color', 'bb-powerpack'),
						'show_reset' => true,
                        'default'   => array(
							'primary'	=> 'dddddd',
							'secondary'	=> ''
						),
						'options'	=> array(
							'primary'	=> __('Default', 'bb-powerpack'),
							'secondary' => __('Active', 'bb-powerpack')
						)
                    ),
					'label_text_color'      => array(
						'type'      => 'pp-color',
                        'label'     => __('Text Color', 'bb-powerpack'),
						'show_reset' => true,
                        'default'   => array(
							'primary'	=> '666666',
							'secondary'	=> '777777'
						),
						'options'	=> array(
							'primary'	=> __('Default', 'bb-powerpack'),
							'secondary' => __('Active', 'bb-powerpack')
						)
                    ),
					'label_border_style'   => array(
						'type'          => 'select',
						'label'         => __('Border Style', 'bb-powerpack'),
						'default'       => 'none',
						'options'       => array(
							'none'         => __( 'None', 'bb-powerpack' ),
							'solid'        => __( 'Solid', 'bb-powerpack' ),
							'dashed'         => __( 'Dashed', 'bb-powerpack' ),
							'dotted'         => __( 'Dotted', 'bb-powerpack' ),
							'double'         => __( 'Double', 'bb-powerpack' )
						),
						'toggle'	=> array(
							'solid'	=> array(
								'fields'	=> array('label_border_width', 'label_border_color')
							),
							'dashed'	=> array(
								'fields'	=> array('label_border_width', 'label_border_color')
							),
							'dotted'	=> array(
								'fields'	=> array('label_border_width', 'label_border_color')
							),
							'double'	=> array(
								'fields'	=> array('label_border_width', 'label_border_color')
							)
						),
						'preview'       => array(
							'type'          => 'css',
							'selector'		=> '.pp-accordion-item .pp-accordion-button',
							'property'		=> 'border-style'
						)
					),
					'label_border_width'     => array(
						'type' 			=> 'pp-multitext',
                        'label' 		=> __('Border Width', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => array(
                            'top' => 1,
                            'right' => 1,
                            'bottom' => 1,
                            'left' => 1,
                        ),
                        'options' 		=> array(
                            'top' 			=> array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'			=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  	=> '.pp-accordion-item .pp-accordion-button',
                                    'property'  	=> 'border-top-width',
                                    'unit'      	=> 'px'
                                )
                            ),
                            'bottom' 		=> array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'			=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  	=> '.pp-accordion-item .pp-accordion-button',
                                    'property'  	=> 'border-bottom-width',
                                    'unit'     		=> 'px'
                                )
                            ),
                            'left' 			=> array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Left', 'bb-powerpack'),
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'icon'			=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'selector' 	 => '.pp-accordion-item .pp-accordion-button',
                                    'property'  	=> 'border-left-width',
                                    'unit'      	=> 'px'
                                )
                            ),
                            'right' 		=> array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Right', 'bb-powerpack'),
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'icon'			=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'  	=> '.pp-accordion-item .pp-accordion-button',
                                    'property'  	=> 'border-right-width',
                                    'unit'      	=> 'px'
                                )
                            ),
                        ),
					),
					'label_border_color'  => array(
						'type'          => 'color',
						'label'         => __('Border Color', 'bb-powerpack'),
						'default'       => 'cccccc',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.pp-accordion-item .pp-accordion-button',
							'property'      => 'border-color'
						)
					),
					'label_border_radius'     => array(
						'type' 			=> 'pp-multitext',
                        'label' 		=> __('Round Corners', 'bb-powerpack'),
                        'description'   => __( 'px', 'Value unit for font size. Such as: "14 px"', 'bb-powerpack' ),
                        'default'       => array(
                            'top_left' => 0,
                            'top_right' => 0,
                            'bottom_left' => 0,
                            'bottom_right' => 0,
                        ),
                        'options' 		=> array(
                            'top_left' => array(
                                'maxlength' => 3,
                                'tooltip'       => __('Top Left', 'bb-powerpack'),
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-button',
                                    'property'  => 'border-top-left-radius',
                                    'unit'      => 'px'
                                )
                            ),
                            'top_right' => array(
                                'maxlength' => 3,
                                'tooltip'       => __('Top Right', 'bb-powerpack'),
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-button',
                                    'property'  => 'border-top-right-radius',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom_left' => array(
                                'maxlength' => 3,
                                'tooltip'       => __('Bottom Left', 'bb-powerpack'),
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-button',
                                    'property'  => 'border-bottom-left-radius',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom_right' => array(
                                'maxlength' => 3,
                                'tooltip'       => __('Bottom Left', 'bb-powerpack'),
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-button',
                                    'property'  => 'border-bottom-right-radius',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
					),
					'label_padding' 	=> array(
                        'type' 			=> 'pp-multitext',
                        'label' 		=> __('Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => array(
                            'top' => 10,
                            'right' => 10,
                            'bottom' => 10,
                            'left' => 10,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'			=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-button',
                                    'property'  => 'padding-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'			=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-button',
                                    'property'  => 'padding-bottom',
                                    'unit'      => 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Left', 'bb-powerpack'),
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'icon'			=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-button',
                                    'property'  => 'padding-left',
                                    'unit'      => 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Right', 'bb-powerpack'),
                                'tooltip'       =>  __('Right', 'bb-powerpack'),
                                'icon'			=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-button',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    )
				)
			),
			'content_style'       => array(
				'title'         => __('Content', 'bb-powerpack'),
				'fields'        => array(
					'content_bg_color'  => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'bb-powerpack'),
						'default'       => 'eeeeee',
						'show_reset'	=> true,
						'preview'	=> array(
							'type'	=> 'css',
							'selector'	=> '.pp-accordion-item .pp-accordion-content',
							'property'	=> 'background-color'
						)
					),
					'content_text_color'  => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'bb-powerpack'),
						'default'       => '333333',
						'preview'	=> array(
							'type'	=> 'css',
							'selector'	=> '.pp-accordion-item .pp-accordion-content',
							'property'	=> 'color'
						)
					),
					'content_border_style'   => array(
						'type'          => 'select',
						'label'         => __('Border Style', 'bb-powerpack'),
						'default'       => 'none',
						'options'       => array(
							'none'         	=> __( 'None', 'bb-powerpack' ),
							'solid'        	=> __( 'Solid', 'bb-powerpack' ),
							'dashed'        => __( 'Dashed', 'bb-powerpack' ),
							'dotted'        => __( 'Dotted', 'bb-powerpack' ),
							'double'        => __( 'Double', 'bb-powerpack' )
						),
						'toggle'	=> array(
							'solid'	=> array(
								'fields'	=> array('content_border_width', 'content_border_color')
							),
							'dashed'	=> array(
								'fields'	=> array('content_border_width', 'content_border_color')
							),
							'dotted'	=> array(
								'fields'	=> array('content_border_width', 'content_border_color')
							),
							'double'	=> array(
								'fields'	=> array('content_border_width', 'content_border_color')
							)
						),
						'preview'       => array(
							'type'          => 'css',
							'selector'		=> '.pp-accordion-item .pp-accordion-content',
							'property'		=> 'border-style'
						)
					),
					'content_border_width'     => array(
						'type' 			=> 'pp-multitext',
                        'label' 		=> __('Border Width', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => array(
                            'top' => 0,
                            'right' => 1,
                            'bottom' => 1,
                            'left' => 1,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-content',
                                    'property'  => 'border-top-width',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-content',
                                    'property'  => 'border-bottom-width',
                                    'unit'      => 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Left', 'bb-powerpack'),
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-content',
                                    'property'  => 'border-left-width',
                                    'unit'      => 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Right', 'bb-powerpack'),
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-content',
                                    'property'  => 'border-right-width',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
					),
					'content_border_color'  => array(
						'type'          => 'color',
						'label'         => __('Border Color', 'bb-powerpack'),
						'default'       => 'cccccc',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.pp-accordion-item .pp-accordion-content',
							'property'      => 'border-color'
						)
					),
					'content_border_radius' => array(
                        'type'              => 'text',
                        'label'             => __('Round Corners', 'bb-powerpack'),
                        'description'       => 'px',
						'maxlength'     => '3',
						'size'          => '5',
                        'default'           => 0,
						'preview'			=> array(
							'type'		=> 'css',
							'rules'		=> array(
								array(
									'selector'      => '.pp-accordion-item .pp-accordion-content',
									'property'      => 'border-bottom-left-radius',
									'unit'			=> 'px'
								),
								array(
									'selector'      => '.pp-accordion-item .pp-accordion-content',
									'property'      => 'border-bottom-right-radius',
									'unit'			=> 'px'
								)
							)
						)
					),
					'content_padding' 	=> array(
                        'type' 			=> 'pp-multitext',
                        'label' 		=> __('Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => array(
                            'top' => 15,
                            'right' => 15,
                            'bottom' => 15,
                            'left' => 15,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-content',
                                    'property'  => 'padding-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-content',
                                    'property'  => 'padding-bottom',
                                    'unit'      => 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Left', 'bb-powerpack'),
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-content',
                                    'property'  => 'padding-left',
                                    'unit'      => 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Right', 'bb-powerpack'),
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'  => '.pp-accordion-item .pp-accordion-content',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    ),
					'content_alignment'        => array(
						'type'          => 'pp-switch',
						'label'         => __('Alignment', 'bb-powerpack'),
						'default'       => 'left',
						'options'       => array(
							'left'    => __('Left', 'bb-powerpack'),
							'center'    => __('Center', 'bb-powerpack'),
							'right'    => __('Right', 'bb-powerpack'),
						),
						'preview'	=> array(
							'type'	=>	'css',
							'selector'	=> '.pp-accordion-item .pp-accordion-content',
							'property'	=> 'text-align'
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
				'title'	=> __('Label', 'bb-powerpack'),
				'fields'	=> array(
					'label_font' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-accordion-item .pp-accordion-button .pp-accordion-button-label'
                        )
                    ),
					'label_font_size'        => array(
						'type'          => 'pp-switch',
						'label'         => __('Font Size', 'bb-powerpack'),
						'default'       => 'default',
						'options'       => array(
							'default'    => __('Default', 'bb-powerpack'),
							'custom'    => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('label_custom_font_size')
							)
						)
					),
					'label_custom_font_size'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 14,
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
                                    'selector'      => '.pp-accordion-item .pp-accordion-button .pp-accordion-button-label',
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
					'label_line_height'   => array(
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
                                    'selector'      => '.pp-accordion-item .pp-accordion-button .pp-accordion-button-label',
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
			'content_typography'	=> array(
				'title'	=> __('Content', 'bb-powerpack'),
				'fields'	=> array(
					'content_font' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-accordion-item .pp-accordion-content'
                        )
                    ),
					'content_font_size'        => array(
						'type'          => 'pp-switch',
						'label'         => __('Font Size', 'bb-powerpack'),
						'default'       => 'default',
						'options'       => array(
							'default'    => __('Default', 'bb-powerpack'),
							'custom'    => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('content_custom_font_size')
							)
						)
					),
					'content_custom_font_size'   => array(
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
                                    'selector'      => '.pp-accordion-item .pp-accordion-content',
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
					'content_line_height'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 1.6,
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
                                    'selector'      => '.pp-accordion-item .pp-accordion-content',
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
	),
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('pp_accordion_items_form', array(
	'title' => __('Add Item', 'bb-powerpack'),
	'tabs'  => array(
		'general'      => array(
			'title'         => __('General', 'bb-powerpack'),
			'sections'      => array(
				'general'       => array(
					'title'         => '',
					'fields'        => array(
						'accordion_font_icon' => array(
							'type'          => 'icon',
							'label'         => __('Icon', 'bb-powerpack'),
							'show_remove'   => true
						),
						'label'         => array(
							'type'          => 'text',
							'label'         => __('Label', 'bb-powerpack'),
							'connections'   => array( 'string', 'html', 'url' ),
						)
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
