<?php

/**
 * @class PPHoverCardsModule
 */
class PPHoverCardsModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Hover Cards', 'bb-powerpack'),
            'description'   => __('Addon to display hover cards.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-hover-cards/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-hover-cards/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh'   => true
        ));

        $this->add_css( 'hover-cards-settings-style', $this->url . 'css/settings.css' );
    }

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPHoverCardsModule', array(
    'general'   => array(
        'title'     => __('General', 'bb-powerpack'),
        'sections'  => array(
            'style_type'     => array(
                'title'     => '',
                'fields'    => array(
                    'style_type'     => array(
                        'type'      => 'select',
                        'label'     => __('Select Style', 'bb-powerpack'),
                        'default'     => 'powerpack-style',
                        'options'   => array(
                            'powerpack-style'  => __('Style 0', 'bb-powerpack'),
                            'style-1'  => __('Style 1', 'bb-powerpack'),
                            'style-2'  => __('Style 2', 'bb-powerpack'),
                            'style-3'  => __('Style 3', 'bb-powerpack'),
                            'style-4'  => __('Style 4', 'bb-powerpack'),
                            'style-5'  => __('Style 5', 'bb-powerpack'),
                        ),
                        'toggle'    => array(
                            'powerpack-style'   => array(
                                'fields'    => array('hover_card_image_select', 'hover_card_icon_color', 'hover_card_icon_size'),
                                'sections'    => array('hover_card_image_section'),
                            ),
                            'style-1'   => array(),
                            'style-2'   => array(),
                            'style-3'   => array(),
                            'style-4'   => array(),
                            'style-5'   => array()
                        )
                    ),
                    'hover_card_spacing'   => array(
                        'type'          => 'text',
                        'label'         => __('Gutter/Spacing', 'bb-powerpack'),
                        'description'   => '%',
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'       => '1',
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-hover-card-container',
                            'property'  => 'margin-right',
                            'unit'      => '%'
                        )
                    ),
                    'hover_card_height_f' 	=> array(
                    	'type' 			=> 'pp-multitext',
                    	'label' 		=> __('Height', 'bb-powerpack'),
                        'default'       => array(
                            'hover_card_height' => 300,
                            'hover_card_height_tablet' => '',
                            'hover_card_height_mobile' => ''
                        ),
                    	'options' 		=> array(
                    		'hover_card_height' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-desktop',
                                'placeholder'   =>  __('Desktop', 'bb-powerpack'),
                                'tooltip'       => 'Desktop',
                                'preview'   => array(
                                    'selector'  => '.pp-hover-card-container',
                                    'property'  => 'height',
                                    'unit'      => 'px'
                                )
                    		),
                            'hover_card_height_tablet' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-tablet',
                                'placeholder'   =>  __('Tablet', 'bb-powerpack'),
                                'tooltip'       => 'Tablet',
                    		),
                            'hover_card_height_mobile' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-mobile',
                                'placeholder'   =>  __('Mobile', 'bb-powerpack'),
                                'tooltip'       => 'Mobile',
                    		),
                    	)
                    ),
                ),
            ),
            'hover_card_count'       => array( // Section
                'title'        => __('Number of Cards in a row', 'bb-powerpack'), // Section Title
                'fields'       => array( // Section Fields
                    'hover_card_column_width' 	=> array(
                    	'type' 			=> 'pp-multitext',
                    	'label' 		=> __('Cards'),
                        'default'       => array(
                            'hover_card_columns_desktop' => 4,
                            'hover_card_columns_tablet' => 2,
                            'hover_card_columns_mobile' => 1
                        ),
                    	'options' 		=> array(
                    		'hover_card_columns_desktop' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-desktop',
                                'placeholder'   =>  __('Desktop', 'bb-powerpack'),
                                'tooltip'       => 'Desktop',
                    		),
                            'hover_card_columns_tablet' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-tablet',
                                'placeholder'   =>  __('Tablet', 'bb-powerpack'),
                                'tooltip'       => 'Tablet',
                    		),
                    		'hover_card_columns_mobile' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-mobile',
                                'placeholder'   =>  __('Mobile', 'bb-powerpack'),
                                'tooltip'       => 'Mobile',
                    		),
                    	)
                    )
                )
            )
        ),
    ),
    'hover_card_content'      => array( // Tab
		'title'         => __('Content', 'bb-powerpack'), // Tab title
		'sections'      => array(
            'hover_card_content' => array(
                'title'     => '',
                'fields'    => array(
                    'card_content'   => array(
                        'type'      => 'form',
                        'label'     => __('Hover Card', 'bb-powerpack'),
                        'form'      => 'pp_hover_card_form',
                        'preview_text'  => 'title',
                        'multiple'  => true
                    ),
                ),
            ),
		)
	),
    'style'     => array(
        'title'     => __('Style', 'bb-powerpack'),
        'sections'      => array(
            'title_styles'     => array(
                'title'     => __('Title', 'bb-powerpack'),
                'fields'    => array(
                    'hover_card_title_margin' 	=> array(
                    	'type' 			=> 'pp-multitext',
                    	'label' 		=> __('Margin', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => array(
                            'hover_card_title_margin_top' => 10,
                            'hover_card_title_margin_bottom' => 10,
                        ),
                    	'options' 		=> array(
                    		'hover_card_title_margin_top' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                    			'icon'		=> 'fa-long-arrow-up',
                                'preview'   => array(
                                    'selector'  => '.pp-hover-card-container .pp-hover-card-title h3',
                                    'property'  => 'margin-top',
                                    'unit'      => 'px'
                                )
                    		),
                            'hover_card_title_margin_bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                    			'icon'		=> 'fa-long-arrow-down',
                                'preview'   => array(
                                    'selector'  => '.pp-hover-card-container .pp-hover-card-title h3',
                                    'property'  => 'margin-bottom',
                                    'unit'      => 'px'
                                )
                    		),
                    	)
                    )
                )
            ),
            'description_styles'     => array(
                'title'     => __('Description', 'bb-powerpack'),
                'fields'    => array(
                    'hover_card_description_margin' 	=> array(
                    	'type' 			=> 'pp-multitext',
                    	'label' 		=> __('Margin', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => array(
                            'hover_card_description_margin_top' => 10,
                            'hover_card_description_margin_bottom' => 10,
                        ),
                    	'options' 		=> array(
                    		'hover_card_description_margin_top' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                    			'icon'		=> 'fa-long-arrow-up',
                                'preview'   => array(
                                    'selector'  => '.pp-hover-card-container .pp-hover-card-description',
                                    'property'  => 'margin-top',
                                    'unit'      => 'px'
                                )
                    		),
                            'hover_card_description_margin_bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                    			'icon'		=> 'fa-long-arrow-down',
                                'preview'   => array(
                                    'selector'  => '.pp-hover-card-container .pp-hover-card-description',
                                    'property'  => 'margin-bottom',
                                    'unit'      => 'px'
                                )
                    		),
                    	)
                    )
                )
            ),
        ),
    ),
    'typography'   => array(
        'title'     => __('Typography', 'bb-powerpack'),
        'sections'  => array(
            'hover_card_title_typography'  => array(
                'title' => __('Title', 'bb-powerpack'),
                'fields'    => array(
                    'hover_card_title_tag'  => array(
                        'type'      => 'select',
                        'label'     => __('HTML Tag', 'bb-powerpack'),
                        'default'   => 'h3',
                        'options'   => array(
                            'h1'        => 'H1',
                            'h2'        => 'H2',
                            'h3'        => 'H3',
                            'h4'        => 'H4',
                            'h5'        => 'H5',
                            'h6'        => 'H6',
                        )
                    ),
                    'hover_card_title_font'    => array(
                        'type'                      => 'font',
                        'default'		            => array(
                            'family'		              => 'Default',
                            'weight'		              => 300
                        ),
                        'label'                 => __('Font', 'bb-powerpack'),
                        'preview'               => array(
                            'type'                  => 'font',
                            'selector'              => '.pp-hover-card-container .pp-hover-card-title h3'
                        )
                    ),
                    'hover_card_title_font_size_f' 	=> array(
                    	'type' 			=> 'pp-multitext',
                    	'label' 		=> __('Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'hover_card_title_font_size' => 24,
                            'hover_card_title_font_size_tablet' => '',
                            'hover_card_title_font_size_mobile' => ''
                        ),
                    	'options' 		=> array(
                    		'hover_card_title_font_size' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-desktop',
                                'placeholder'   =>  __('Desktop', 'bb-powerpack'),
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'   => array(
                                    'selector'  => '.pp-hover-card-container .pp-hover-card-title h3',
                                    'property'  => 'font-size',
                                    'unit'      => 'px'
                                )
                    		),
                            'hover_card_title_font_size_tablet' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-tablet',
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'tooltip'       => __('Tablet', 'bb-powerpack'),

                    		),
                            'hover_card_title_font_size_mobile' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-mobile',
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'tooltip'       => __('Mobile', 'bb-powerpack'),
                    		),
                    	)
                    ),
                    'hover_card_title_line_height_f' 	=> array(
                    	'type' 			=> 'pp-multitext',
                    	'label' 		=> __('Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'hover_card_title_line_height' => 1.2,
                            'hover_card_title_line_height_tablet' => '',
                            'hover_card_title_line_height_mobile' => ''
                        ),
                    	'options' 		=> array(
                    		'hover_card_title_line_height' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-desktop',
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'   => array(
                                    'selector'  => '.pp-hover-card-container .pp-hover-card-title h3',
                                    'property'  => 'line-height',
                                    'unit'      => 'px'
                                )
                    		),
                            'hover_card_title_line_height_tablet' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-tablet',
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'tooltip'       => __('Tablet', 'bb-powerpack'),
                    		),
                            'hover_card_title_line_height_mobile' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-mobile',
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'tooltip'       => __('Mobile', 'bb-powerpack'),
                    		),
                    	)
                    ),
                ),
            ),
            'hover_card_description_typography'  => array(
                'title' => __('Description', 'bb-powerpack'),
                'fields'    => array(
                    'hover_card_description_font'    => array(
                        'type'      => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-hover-card-container .pp-hover-card-description'
                        )
                    ),
                    'hover_card_description_font_size_f' 	=> array(
                    	'type' 			=> 'pp-multitext',
                    	'label' 		=> __('Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'hover_card_description_font_size' => 14,
                            'hover_card_description_font_size_tablet' => '',
                            'hover_card_description_font_size_mobile' => ''
                        ),
                    	'options' 		=> array(
                    		'hover_card_description_font_size' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-desktop',
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'   => array(
                                    'selector'  => '.pp-hover-card-container .pp-hover-card-description',
                                    'property'  => 'font-size',
                                    'unit'      => 'px'
                                )
                    		),
                            'hover_card_description_font_size_tablet' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-tablet',
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'tooltip'       => __('Tablet', 'bb-powerpack'),
                    		),
                            'hover_card_description_font_size_mobile' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-mobile',
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'tooltip'       => __('Mobile', 'bb-powerpack'),
                    		),
                    	)
                    ),
                    'hover_card_description_line_height_f' 	=> array(
                    	'type' 			=> 'pp-multitext',
                    	'label' 		=> __('Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'hover_card_description_line_height' => 1.4,
                            'hover_card_description_line_height_tablet' => '',
                            'hover_card_description_line_height_mobile' => ''
                        ),
                    	'options' 		=> array(
                    		'hover_card_description_line_height' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-desktop',
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'   => array(
                                    'selector'  => '.pp-hover-card-container .pp-hover-card-description',
                                    'property'  => 'line-height',
                                    'unit'      => 'px'
                                )
                    		),
                            'hover_card_description_line_height_tablet' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-tablet',
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'tooltip'       => __('Tablet', 'bb-powerpack'),
                    		),
                            'hover_card_description_line_height_mobile' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-mobile',
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'tooltip'       => __('Mobile', 'bb-powerpack'),
                    		),
                    	)
                    ),
                ),
            ),
            'button_typography'  => array(
                'title' => __('Button', 'bb-powerpack'),
                'fields'    => array(
                    'button_font'    => array(
                        'type'      => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-hover-card .pp-hover-card-inner .pp-more-link'
                        )
                    ),
                    'button_font_size_f' 	=> array(
                    	'type' 			=> 'pp-multitext',
                    	'label' 		=> __('Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'button_font_size' => 14,
                            'hover_card_button_font_size_tablet' => '',
                            'hover_card_button_font_size_mobile' => ''
                        ),
                    	'options' 		=> array(
                    		'button_font_size' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-desktop',
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'   => array(
                                    'selector'  => '.pp-hover-card .pp-hover-card-inner .pp-more-link',
                                    'property'  => 'font-size',
                                    'unit'      => 'px'
                                )
                    		),
                            'hover_card_button_font_size_tablet' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-tablet',
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'tooltip'       => __('Tablet', 'bb-powerpack'),
                    		),
                            'hover_card_button_font_size_mobile' => array(
                                'maxlength' => 3,
                    			'icon'		=> 'fa-mobile',
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'tooltip'       => __('Mobile', 'bb-powerpack'),
                    		),
                    	)
                    ),
                ),
            ),
        ),
    ),
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('pp_hover_card_form', array(
	'title' => __('Add Hover Card', 'bb-powerpack'),
	'tabs'  => array(
		'general'      => array( // Tab
			'title'         => __('General', 'bb-powerpack'), // Tab title
			'sections'      => array( // Tab Sections
                'background_type_section'   => array(
                    'title' => '',
                    'fields'    => array(
                        'hover_card_bg_type' => array(
                            'type'      => 'pp-switch',
                            'label'     => __('Background Type', 'bb-powerpack'),
                            'default'   => 'color',
                            'options'   => array(
                                'color' => __('Color', 'bb-powerpack'),
                                'image' => __('Image', 'bb-powerpack'),
                            ),
                            'toggle'    => array(
                                'color' => array(
                                    'fields'    => array('hover_card_bg_color'),
                                ),
                                'image' => array(
                                    'fields'    => array('hover_card_box_image'),
                                    'sections'  => array('hover_card_overlay_s')
                                ),
                            ),
                        ),
                        'hover_card_bg_color'    => array(
                            'type'      => 'color',
                            'label'     => __('Color', 'bb-powerpack'),
                            'default'   => 'f5f5f5',
                            'show_reset'    => true,
                            'preview'   => array(
                                'type'  => 'css',
                                'selector'  => '.pp-hover-card-container',
                                'property'  => 'background'
                            ),
                        ),
                        'hover_card_box_image'     => array(
                            'type'      => 'photo',
                            'label'     => __('Image', 'bb-powerpack'),
                            'connections'   => array( 'photo' ),
                        ),
                    )
                ),
                'hover_card_image_section'          => array(
                    'title'      => '',
                    'fields'     => array(
                        'hover_card_image_select'       => array(
                            'type'          => 'pp-switch',
    						'label'         => __('Icon Source', 'bb-powerpack'),
                            'default'       => 'hover_card_font_icon_select',
    						'options'       => array(
    							'hover_card_font_icon_select'   => __('Icon', 'bb-powerpack'),
    							'hover_card_custom_icon_select' => __('Image', 'bb-powerpack')
    						),
                            'toggle' => array(
                                'hover_card_font_icon_select' => array(
                                    'fields'    => array('hover_card_font_icon', 'hover_card_icon_size', 'hover_card_icon_color'),
                                ),
                                'hover_card_custom_icon_select' => array(
                                    'fields'    => array('hover_card_custom_icon', 'hover_card_icon_size'),
                                )
                            )
    					),
                        'hover_card_font_icon' => array(
    						'type'          => 'icon',
    						'label'         => __('Icon', 'bb-powerpack'),
                            'show_remove'   => true
    					),
                        'hover_card_custom_icon'     => array(
                            'type'              => 'photo',
                            'label'         => __('Image', 'bb-powerpack'),
                            'show_remove'   => true,
                            'connections'   => array( 'photo' )
                        ),
                    ),
                ),
                'title'          => array(
                    'title'      => __('Title', 'bb-powerpack'),
                    'fields'     => array(
                        'title'     => array(
                            'type'          => 'text',
                            'label'         => '',
                            'connections'   => array( 'string', 'html', 'url' ),
                        ),
                    ),
                ),
                'content'       => array( // Section
					'title'         => __('Content', 'bb-powerpack'), // Section Title
					'fields'        => array( // Section Fields
						'hover_content'          => array(
							'type'          => 'editor',
							'label'         => '',
                            'connections'   => array( 'string', 'html', 'url' ),
						)
					)
				),
                'button'     => array(
                    'title'     => '',
                    'fields'    => array(
                        'hover_card_link_type'     => array(
                            'type'      => 'pp-switch',
                            'label'     => __('Link Type', 'bb-powerpack'),
                            'default'   => 'no',
                            'options'   => array(
                                'no'    => __('No Link', 'bb-powerpack'),
                                'box'    => __('Entire Box', 'bb-powerpack'),
                                'button'    => __('Button', 'bb-powerpack'),
                            ),
                            'toggle'    => array(
                                'box'   => array(
                                    'fields'    => array('button_link', 'link_target'),
                                ),
                                'button'   => array(
                                    'fields'    => array('button_text', 'button_link', 'link_target'),
                                    'tabs'      => array('button_style')
                                ),
                            ),
                        ),
                        'button_text'   => array(
                            'type'      => 'text',
                            'label'     => __('Button Text', 'bb-powerpack'),
                            'preview'   => array(
                                'type'  => 'text',
                                'selector'  => '.pp-hover-card .pp-more-link'
                            ),
                        ),
                        'button_link'   => array(
                            'type'      => 'link',
                            'label'     => __('Link', 'bb-powerpack'),
                            'placeholder'   => 'http://www.example.com',
                            'connections'   => array( 'url' ),
                        ),
                        'link_target'   => array(
                            'type'      => 'pp-switch',
                            'label'     => __('Link Target', 'bb-powerpack'),
                            'default'   => '_self',
                            'options'   => array(
                                '_blank'     => __('New Window', 'bb-powerpack'),
                                '_self'     => __('Same Window', 'bb-powerpack'),
                            ),
                        ),
                    ),
                ),
			)
		),
        'styles'    => array(
            'title' => __('Style', 'bb-powerpack'),
            'sections'  => array(
                'static_content_Styling'     => array(
                    'title'     => 'Box',
                    'fields'    => array(
                        'hover_card_box_border'    => array(
                            'type'      => 'pp-switch',
                            'label'     => __('Border', 'bb-powerpack'),
                            'default'   => 'none',
                            'options'   => array(
                                'none'  => __('None', 'bb-powerpack'),
                                'solid'  => __('Solid', 'bb-powerpack'),
                                'dashed'  => __('Dashed', 'bb-powerpack'),
                                'dotted'  => __('Dotted', 'bb-powerpack'),
                            ),
                            'toggle'    => array(
                                'dashed'   => array(
                                    'fields'    => array('hover_card_box_border_width', 'hover_card_box_border_color', 'hover_card_box_border_opacity')
                                ),
                                'dotted'   => array(
                                    'fields'    => array('hover_card_box_border_width', 'hover_card_box_border_color', 'hover_card_box_border_opacity')
                                ),
                                'solid'   => array(
                                    'fields'    => array('hover_card_box_border_width', 'hover_card_box_border_color', 'hover_card_box_border_opacity')
                                ),
                            ),
                        ),
                        'hover_card_box_border_width'  => array(
                            'type'      => 'text',
                            'label'     => __('Border Width', 'bb-powerpack'),
                            'size'      => 5,
                            'maxlength' => 3,
                            'default'   => '1',
                            'description'   => 'px',
                        ),
                        'hover_card_box_border_color'  => array(
                            'type'      => 'color',
                            'label'     => __('Border Color', 'bb-powerpack'),
                            'show_reset' => true,
                        ),
                        'hover_card_box_border_opacity'    => array(
                            'type'      => 'text',
                            'label'     => __('Border Opacity', 'bb-powerpack'),
                            'size'      => 5,
                            'maxlength' => 3,
                            'default'   => 1,
                            'description'   => __('between 0 to 1', 'bb-powerpack'),
                        ),
                        'hover_card_box_border_radius'     => array(
                            'type'      => 'text',
                            'label'     => __('Round Corners', 'bb-powerpack'),
                            'size'      => 5,
                            'maxlength' => 3,
                            'default'   => 0,
                            'description' => 'px',
                        ),
                        'hover_card_box_padding' 	=> array(
                        	'type' 			=> 'pp-multitext',
                        	'label' 		=> __('Padding', 'bb-powerpack'),
                            'description'   => 'px',
                            'default'       => array(
                                'top' => 20,
                                'right' => 20,
                                'bottom' => 20,
                                'left' => 20,
                            ),
                        	'options' 		=> array(
                        		'top' => array(
                                    'maxlength' => 3,
                                    'placeholder'   => __('Top', 'bb-powerpack'),
                                    'tooltip'       => __('Top', 'bb-powerpack'),
                        			'icon'		=> 'fa-long-arrow-up',
                        		),
                                'bottom' => array(
                                    'maxlength' => 3,
                                    'placeholder'   => __('Bottom', 'bb-powerpack'),
                                    'tooltip'       => __('Bottom', 'bb-powerpack'),
                        			'icon'		=> 'fa-long-arrow-down',
                        		),
                                'left' => array(
                                    'maxlength' => 3,
                                    'placeholder'   => __('Left', 'bb-powerpack'),
                                    'tooltip'       => __('Left', 'bb-powerpack'),
                        			'icon'		=> 'fa-long-arrow-left',
                        		),
                                'right' => array(
                                    'maxlength' => 3,
                                    'placeholder'   => __('Right', 'bb-powerpack'),
                                    'tooltip'       => __('Right', 'bb-powerpack'),
                        			'icon'		=> 'fa-long-arrow-right',
                        		),
                        	)
                        ),
                    ),
                ),
                'hover_card_overlay_s'    => array(
                    'title' => __('Overlay On Hover', 'bb-powerpack'),
                    'fields'    => array(
                        'hover_card_overlay'     => array(
                            'type'      => 'color',
                            'label'     => __('Color', 'bb-powerpack'),
                            'show_reset'   => true,
                        ),
                        'hover_card_overlay_opacity' => array(
                            'type'  => 'text',
                            'label' => __('Opacity', 'bb-powerpack'),
                            'size'  => 5,
                            'default'   => 1,
                            'description'   => __('between 0 to 1', 'bb-powerpack'),
                        ),
                    )
                ),
                'hover_card_icon_style'    => array(
                    'title'     => __('Icon', 'bb-powerpack'),
                    'fields'    => array(
                        'hover_card_icon_size'    => array(
                            'type'          => 'text',
                            'size'          => '5',
                            'maxlength'     => '3',
                            'default'       => '70',
                            'label'         => __('Size', 'bb-powerpack'),
                            'description'   => 'px',
                        ),
                        'hover_card_icon_color'   => array(
                            'type'      => 'color',
                            'label'     => __('Color', 'bb-powerpack'),
                            'default'   => '000000',
                        ),
                    )
                ),
                'title_style'    => array(
                    'title'     => __('Title', 'bb-powerpack'),
                    'fields'    => array(
                        'hover_card_title_color'       => array(
                            'type'          => 'color',
                            'label'         => __('Color', 'bb-powerpack'),
                            'default'       => '000000',
                        ),
                    ),
                ),
                'description_style'    => array(
                    'title'     => __('Description', 'bb-powerpack'),
                    'fields'    => array(
                        'hover_card_description_color'       => array(
                            'type'          => 'color',
                            'label'         => __('Color', 'bb-powerpack'),
                            'default'       => '000000',
                        ),
                    ),
                ),
            ),
        ),
        'button_style'    => array(
            'title' => __('Button', 'bb-powerpack'),
            'sections'  => array(
                'button_styles'     => array(
                    'title'     => '',
                    'fields'    => array(
                        'button_width'   => array(
                            'type'      => 'text',
                            'label'     => __('Width', 'bb-powerpack'),
                            'size'      => 5,
                            'maxlength' => 3,
                            'default'   => 100,
                            'description'   => 'px',
                        ),
                        'button_color'      => array(
                            'type'      => 'pp-color',
                            'label'     => __('Color', 'bb-powerpack'),
                            'show_reset' => true,
                            'default'   => array(
                                'primary'	=> '000000',
                                'secondary'	=> '000000'
                            ),
                            'options'	=> array(
                                'primary'	=> __('Default', 'bb-powerpack'),
                                'secondary' => __('Hover', 'bb-powerpack')
                            )
                        ),
                        'button_background' => array(
                            'type'      => 'pp-color',
                            'label'     => __('Background Color', 'bb-powerpack'),
                            'show_reset' => true,
                            'default'   => array(
                                'primary'	=> 'ffffff',
                                'secondary'	=> 'ffffff'
                            ),
                            'options'	=> array(
                                'primary'	=> __('Default', 'bb-powerpack'),
                                'secondary' => __('Hover', 'bb-powerpack')
                            )
                        ),
                        'button_border' => array(
                            'type'      => 'pp-switch',
                            'label'     => __('Border', 'bb-powerpack'),
                            'default'   => 'none',
                            'options'   => array(
                                'none'  => __('None', 'bb-powerpack'),
                                'solid'  => __('Solid', 'bb-powerpack'),
                                'dashed'  => __('Dashed', 'bb-powerpack'),
                                'dotted'  => __('Dotted', 'bb-powerpack'),
                            ),
                            'toggle'    => array(
                                'dashed'   => array(
                                    'fields'    => array('button_border_width', 'button_border_color')
                                ),
                                'dotted'   => array(
                                    'fields'    => array('button_border_width', 'button_border_color')
                                ),
                                'solid'   => array(
                                    'fields'    => array('button_border_width', 'button_border_color')
                                ),
                            ),
                        ),
                        'button_border_width'   => array(
                            'type'      => 'text',
                            'label'     => __('Border Width', 'bb-powerpack'),
                            'size'      => 5,
                            'maxlength' => 3,
                            'default'   => 0,
                            'description'   => 'px',
                        ),
                        'button_border_color'   => array(
                            'type'      => 'pp-color',
                            'label'     => __('Border Color', 'bb-powerpack'),
                            'show_reset' => true,
                            'default'   => array(
                                'primary'	=> '',
                                'secondary'	=> ''
                            ),
                            'options'	=> array(
                                'primary'	=> __('Default', 'bb-powerpack'),
                                'secondary' => __('Hover', 'bb-powerpack')
                            )
                        ),
                        'button_border_radius'   => array(
                            'type'      => 'text',
                            'label'     => __('Round Corners', 'bb-powerpack'),
                            'size'      => 5,
                            'maxlength' => 3,
                            'default'   => 0,
                            'description'   => 'px',
                        ),
                        'button_padding' 	=> array(
                        	'type' 			=> 'pp-multitext',
                        	'label' 		=> __('Padding', 'bb-powerpack'),
                            'description'   => 'px',
                            'default'       => array(
                                'top' => 5,
                                'right' => 10,
                                'bottom' => 5,
                                'left' => 10,
                            ),
                        	'options' 		=> array(
                        		'top' => array(
                                    'maxlength' => 3,
                                    'placeholder'   => __('Top', 'bb-powerpack'),
                                    'tooltip'       => __('Top', 'bb-powerpack'),
                        			'icon'		=> 'fa-long-arrow-up',
                        		),
                                'bottom' => array(
                                    'maxlength' => 3,
                                    'placeholder'   => __('Bottom', 'bb-powerpack'),
                                    'tooltip'       => __('Bottom', 'bb-powerpack'),
                        			'icon'		=> 'fa-long-arrow-down',
                        		),
                                'left' => array(
                                    'maxlength' => 3,
                                    'placeholder'   => __('Left', 'bb-powerpack'),
                                    'tooltip'       => __('Left', 'bb-powerpack'),
                        			'icon'		=> 'fa-long-arrow-left',
                        		),
                                'right' => array(
                                    'maxlength' => 3,
                                    'placeholder'   => __('Right', 'bb-powerpack'),
                                    'tooltip'       => __('Right', 'bb-powerpack'),
                        			'icon'		=> 'fa-long-arrow-right',
                        		),
                        	)
                        ),
                    ),
                ),
            )
    	)
    ),
));
