<?php

/**
 * @class PPPricingTableModule
 */
class PPPricingTableModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Pricing Table', 'bb-powerpack'),
			'description'   => __('Addon to display pricing table.', 'bb-powerpack'),
			'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-pricing-table/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-pricing-table/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh'   => true
		));

	}

	/**
	 * @method render_button
	 */
	public function render_button($column)
	{
		$btn_settings = array(
			'align'				=> $this->settings->pricing_columns[$column]->btn_align,
			'bg_color'          => $this->settings->pricing_columns[$column]->btn_bg_color,
			'bg_hover_color'    => $this->settings->pricing_columns[$column]->btn_bg_hover_color,
			'bg_opacity'        => $this->settings->pricing_columns[$column]->btn_bg_opacity,
			'border_radius'     => $this->settings->pricing_columns[$column]->btn_border_radius,
			'border_size'       => $this->settings->pricing_columns[$column]->btn_border_size,
			'icon'              => $this->settings->pricing_columns[$column]->btn_icon,
			'icon_position'     => $this->settings->pricing_columns[$column]->btn_icon_position,
			'icon_animation'	=> $this->settings->pricing_columns[$column]->btn_icon_animation,
			'link'              => $this->settings->pricing_columns[$column]->button_url,
			'link_nofollow' 	=> $this->settings->pricing_columns[$column]->btn_link_nofollow,
			'link_target'       => $this->settings->pricing_columns[$column]->btn_link_target,
			'style'             => $this->settings->pricing_columns[$column]->btn_style,
			'text'              => $this->settings->pricing_columns[$column]->button_text,
			'text_color'        => $this->settings->pricing_columns[$column]->btn_text_color,
			'text_hover_color'  => $this->settings->pricing_columns[$column]->btn_text_hover_color,
			'width'             => $this->settings->pricing_columns[$column]->btn_width
		);

		FLBuilder::render_module_html('fl-button', $btn_settings);
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPPricingTableModule', array(
	'columns'      => array(
		'title'         => __('Packages', 'bb-powerpack'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'pricing_table_style' => array(
						'type'          => 'pp-switch',
						'label'         => __('Layout', 'bb-powerpack'),
						'default'       => 'cards',
						'options'       => array(
							'cards'        => __('Cards', 'bb-powerpack'),
							'matrix'         => __('Matrix', 'bb-powerpack')
						),
						'toggle'	=> array(
							'matrix'	=> array(
								'tabs'	=> array('matrix_items')
							)
						)
					),
					'pricing_columns'     => array(
						'type'         => 'form',
						'label'        => __('Package', 'bb-powerpack'),
						'form'         => 'pp_pricing_column_form',
						'preview_text' => 'title',
						'multiple'     => true
					),
				)
			)
		)
	),
	'matrix_items'      => array(
		'title'         => __('Items Box', 'bb-powerpack'),
		'sections'      => array(
			'general'	=> array(
				'title'	=> __( 'Style', 'bb-powerpack' ),
				'fields'	=> array(
					'matrix_bg'  => array(
						'type'          => 'color',
						'default'       => 'f5f5f5',
						'label'         => __( 'Box Background Color', 'bb-powerpack' ),
						'show_reset'		=> true,
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-matrix .pp-pricing-table-column',
							'property'	=> 'background-color'
						)
					),
					'matrix_even_features_bg_color'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __('Alternate Background Color', 'bb-powerpack'),
						'show_reset'	=> true,
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-matrix .pp-pricing-table-column .pp-pricing-table-features li:nth-child(even)',
							'property'	=> 'background-color'
						)
					),
					'matrix_text_color'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __('Items Text Color', 'bb-powerpack'),
						'show_reset'	=> true,
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-matrix .pp-pricing-table-column .pp-pricing-table-features',
							'property'	=> 'color'
						)
					),
					'matrix_features_border'    => array(
						'type'      => 'pp-switch',
						'label'     => __('Items Border Style', 'bb-powerpack'),
						'default'   => 'none',
						'options'   => array(
							'none'  => __('None', 'bb-powerpack'),
							'solid'  => __('Solid', 'bb-powerpack'),
							'dashed'  => __('Dashed', 'bb-powerpack'),
							'dotted'  => __('Dotted', 'bb-powerpack'),
						),
						'toggle'    => array(
							'dashed'   => array(
								'fields'    => array('matrix_features_border_width', 'matrix_features_border_color')
							),
							'dotted'   => array(
								'fields'    => array('matrix_features_border_width', 'matrix_features_border_color')
							),
							'solid'   => array(
								'fields'    => array('matrix_features_border_width', 'matrix_features_border_color')
							),
						),
						'preview'           => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-matrix .pp-pricing-table-column .pp-pricing-table-features li',
							'property'	=> 'border-bottom-style',
						)
					),
					'matrix_features_border_width'   => array(
						'type'              => 'text',
						'label'             => __('Items Border Width', 'bb-powerpack'),
						'description'       => 'px',
						'size'             	=> 5,
						'default'           => 1,
						'preview'           => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-matrix .pp-pricing-table-column .pp-pricing-table-features li',
							'property'	=> 'border-bottom-width',
							'unit'		=> 'px'
						)
					),
					'matrix_features_border_color'   => array(
						'type'      => 'color',
						'label'     => __('Items Border Color', 'bb-powerpack'),
						'show_reset'   => true,
						'default'	=> '',
						'preview'              => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-matrix .pp-pricing-table-column .pp-pricing-table-features li',
							'property'	=> 'border-color',
						)
					),
					'matrix_alignment' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Items Alignment', 'bb-powerpack'),
						'default'	=> 'left',
						'options'       => array(
							'left'          => __('Left', 'bb-powerpack'),
							'center'         => __('Center', 'bb-powerpack'),
							'right'         => __('Right', 'bb-powerpack'),
						),
					),
				)
			),
			'matrix_column'	=> array(
				'title'	=> __( 'Items', 'bb-powerpack' ),
				'fields'	=> array(
					'matrix_items'	=> array(
						'type'          => 'text',
						'label'         => '',
						'placeholder'   => __( 'One feature per line. HTML is okay.', 'bb-powerpack' ),
						'multiple'      => true,
					)
				)
			)
		)
	),
	'style'       => array(
		'title'         => __('Style', 'bb-powerpack'),
		'sections'      => array(
			'box_style'       => array(
				'title'         => __( 'Package Column', 'bb-powerpack' ),
				'fields'        => array(
					'box_spacing'   => array(
						'type'          => 'text',
						'label'         => __('Spacing', 'bb-powerpack'),
						'default'       => '12',
						'size'          => '5',
						'description'   => 'px',
						'help'          => __('Use this to add space between pricing table columns.', 'bb-powerpack'),
						'preview'		=> array(
							'type'		=> 'css',
							'rules'		=> array(
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col',
									'property'	=> 'padding-left',
									'unit'		=> 'px'
								),
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col',
									'property'	=> 'padding-right',
									'unit'		=> 'px'
								),
							)
						)
					),
					'box_bg_color'      => array(
						'type'      => 'color',
						'label'     => __('Background Color', 'bb-powerpack'),
						'default'	=> 'f5f5f5',
						'show_reset'   => true,
						'preview'              => array(
							'type'				=> 'css',
							'selector'			=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight) .pp-pricing-table-column',
							'property'			=> 'background-color',
						)
					),
					'box_border'    => array(
						'type'      => 'pp-switch',
						'label'     => __('Border Style', 'bb-powerpack'),
						'default'   => 'none',
						'options'   => array(
							'none'  => __('None', 'bb-powerpack'),
							'solid'  => __('Solid', 'bb-powerpack'),
							'dashed'  => __('Dashed', 'bb-powerpack'),
							'dotted'  => __('Dotted', 'bb-powerpack'),
						),
						'toggle'    => array(
							'dashed'   => array(
								'fields'    => array('box_border_width', 'box_border_color')
							),
							'dotted'   => array(
								'fields'    => array('box_border_width', 'box_border_color')
							),
							'solid'   => array(
								'fields'    => array('box_border_width', 'box_border_color')
							),
						),
					),
					'box_border_width'   => array(
						'type'      => 'text',
						'label'     => __('Border Width', 'bb-powerpack'),
						'size'      => 5,
						'maxlength' => 3,
						'default'   => 1,
						'description'   => 'px',
						'preview'              => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-highlight) .pp-pricing-table-column',
							'property'	=> 'border-width',
							'unit'		=> 'px'
						)
					),
					'box_border_color'   => array(
						'type'      => 'color',
						'label'     => __('Border Color', 'bb-powerpack'),
						'show_reset'   => true,
						'preview'              => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-highlight) .pp-pricing-table-column',
							'property'	=> 'border-color',
						)
					),
					'box_shadow_display'   => array(
						'type'                 => 'pp-switch',
						'label'                => __('Enable Shadow', 'bb-powerpack'),
						'default'              => 'no',
						'options'              => array(
							'yes'          => __('Yes', 'bb-powerpack'),
							'no'             => __('No', 'bb-powerpack'),
						),
						'toggle'    =>  array(
							'yes'   => array(
								'fields'    => array('box_shadow', 'box_shadow_color', 'box_shadow_opacity')
							)
						)
					),
					'box_shadow' 		=> array(
						'type'              => 'pp-multitext',
						'label'             => __('Box Shadow', 'bb-powerpack'),
						'default'           => array(
							'vertical'			=> 2,
							'horizontal'		=> 2,
							'blur'				=> 2,
							'spread'			=> 1
						),
						'options'			=> array(
							'vertical'			=> array(
								'placeholder'		=> __('Vertical', 'bb-powerpack'),
								'tooltip'			=> __('Vertical', 'bb-powerpack'),
								'icon'				=> 'fa-arrows-v'
							),
							'horizontal'		=> array(
								'placeholder'		=> __('Horizontal', 'bb-powerpack'),
								'tooltip'			=> __('Horizontal', 'bb-powerpack'),
								'icon'				=> 'fa-arrows-h'
							),
							'blur'				=> array(
								'placeholder'		=> __('Blur', 'bb-powerpack'),
								'tooltip'			=> __('Blur', 'bb-powerpack'),
								'icon'				=> 'fa-circle-o'
							),
							'spread'			=> array(
								'placeholder'		=> __('Spread', 'bb-powerpack'),
								'tooltip'			=> __('Spread', 'bb-powerpack'),
								'icon'				=> 'fa-paint-brush'
							),
						)
					),
					'box_shadow_color' => array(
						'type'              => 'color',
						'label'             => __('Shadow Color', 'bb-powerpack'),
						'default'           => '000000',
					),
					'box_shadow_opacity' => array(
						'type'              => 'text',
						'label'             => __('Shadow Opacity', 'bb-powerpack'),
						'description'       => '%',
						'size'             => 5,
						'default'           => 50,
					),
					'box_border_radius' => array(
						'type'              => 'text',
						'label'             => __('Round Corners', 'bb-powerpack'),
						'description'       => 'px',
						'size'             	=> 5,
						'default'           => 0,
						'preview'			=> array(
							'type'				=> 'css',
							'selector'			=> '.pp-pricing-table .pp-pricing-table-col .pp-pricing-table-column',
							'property'			=> 'border-radius',
							'unit'				=> 'px'
						)
					),
					'box_padding'   => array(
                        'type'      => 'pp-multitext',
                        'label'     => __( 'Padding', 'bb-powerpack' ),
                        'description'   => 'px',
						'default'       => array(
                            'top' => 10,
                            'right' => 10,
                            'bottom' => 10,
                            'left' => 10,
                        ),
                    	'options' 		=> array(
                    		'top' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __( 'Top', 'bb-powerpack' ),
                                'tooltip'       => __( 'Top', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-up',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-highlight) .pp-pricing-table-column',
									'property'	=> 'padding-top',
									'unit'		=> 'px'
		                        )
                    		),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __( 'Bottom', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-down',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-highlight) .pp-pricing-table-column',
									'property'	=> 'padding-bottom',
									'unit'		=> 'px'
		                        )
                    		),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Left', 'bb-powerpack'),
                                'tooltip'       => __( 'Left', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-left',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-highlight) .pp-pricing-table-column',
									'property'	=> 'padding-left',
									'unit'		=> 'px'
		                        )
                    		),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Right', 'bb-powerpack'),
                                'tooltip'       => __( 'Right', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-right',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-highlight) .pp-pricing-table-column',
									'property'	=> 'padding-right',
									'unit'		=> 'px'
		                        )
                    		),
                    	)
                    ),
				)
			),
			'featured_title_style'	=> array(
				'title'	=> __( 'Featured Title', 'bb-powerpack' ),
				'fields'	=> array(
					'featured_title_bg_color' => array(
						'type'              => 'color',
						'label'             => __('Background Color', 'bb-powerpack'),
						'default'           => 'cccccc',
						'show_reset'		=> true,
						'preview'       => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-highlight) .pp-pricing-table-column .pp-pricing-featured-title',
							'property'	=> 'background-color',
						)
					),
					'featured_title_color' => array(
						'type'              => 'color',
						'label'             => __('Text Color', 'bb-powerpack'),
						'default'           => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-highlight) .pp-pricing-table-column .pp-pricing-featured-title',
							'property'	=> 'color',
						)
					),
					'featured_title_alignment' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Alignment', 'bb-powerpack'),
						'default'	=> 'center',
						'options'       => array(
							'left'          => __('Left', 'bb-powerpack'),
							'center'         => __('Center', 'bb-powerpack'),
							'right'         => __('Right', 'bb-powerpack'),
						),
						'preview'		=> array(
							'type'			=> 'css',
							'selector'		=> '.pp-pricing-table .pp-pricing-table-column .pp-pricing-featured-title',
							'property'		=> 'text-align'
						)
					),
					'featured_title_padding'   => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Padding', 'bb-powerpack'),
                        'description'   => 'px',
						'default'       => array(
                            'top' => 10,
                            'right' => 10,
                            'bottom' => 10,
                            'left' => 10,
                        ),
                    	'options' 		=> array(
                    		'top' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => __( 'Top', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-up',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-column .pp-pricing-featured-title',
									'property'	=> 'padding-top',
									'unit'		=> 'px'
		                        )
                    		),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __( 'Bottom', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-down',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-column .pp-pricing-featured-title',
									'property'	=> 'padding-bottom',
									'unit'		=> 'px'
		                        )
                    		),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Left', 'bb-powerpack'),
                                'tooltip'       => __( 'Left', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-left',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-column .pp-pricing-table-title',
									'property'	=> 'padding-left',
									'unit'		=> 'px'
		                        )
                    		),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Right', 'bb-powerpack'),
                                'tooltip'       => __( 'Right', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-right',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-column .pp-pricing-featured-title',
									'property'	=> 'padding-right',
									'unit'		=> 'px'
		                        )
                    		),
                    	)
                    ),
				)
			),
			'title_style'	=> array(
				'title'	=> __( 'Package Title', 'bb-powerpack' ),
				'fields'	=> array(
					'title_position' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Position', 'bb-powerpack'),
						'default'	=> 'above',
						'options'       => array(
							'above'          => __( 'Above Price', 'bb-powerpack' ),
							'below'         => __( 'Below Price', 'bb-powerpack' ),
						),
					),
					'title_bg_color' => array(
						'type'              => 'color',
						'label'             => __('Background Color', 'bb-powerpack'),
						'default'           => '',
						'show_reset'		=> true,
						'preview'       => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight):not(.pp-pricing-table-highlight-title) .pp-pricing-table-column .pp-pricing-table-title',
							'property'	=> 'background-color',
						)
					),
					'title_color' => array(
						'type'              => 'color',
						'label'             => __('Text Color', 'bb-powerpack'),
						'default'           => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight):not(.pp-pricing-table-highlight-title) .pp-pricing-table-column .pp-pricing-table-title',
							'property'	=> 'color',
						)
					),
					'title_alignment' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Alignment', 'bb-powerpack'),
						'default'	=> 'center',
						'options'       => array(
							'left'          => __('Left', 'bb-powerpack'),
							'center'         => __('Center', 'bb-powerpack'),
							'right'         => __('Right', 'bb-powerpack'),
						),
						'preview'		=> array(
							'type'			=> 'css',
							'selector'		=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-title',
							'property'		=> 'text-align'
						)
					),
					'title_padding'   => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Padding', 'bb-powerpack'),
                        'description'   => 'px',
						'default'       => array(
                            'top' => 10,
                            'right' => 10,
                            'bottom' => 10,
                            'left' => 10,
                        ),
                    	'options' 		=> array(
                    		'top' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => __( 'Top', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-up',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col .pp-pricing-table-column .pp-pricing-table-title',
									'property'	=> 'padding-top',
									'unit'		=> 'px'
		                        )
                    		),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __( 'Bottom', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-down',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col .pp-pricing-table-column .pp-pricing-table-title',
									'property'	=> 'padding-bottom',
									'unit'		=> 'px'
		                        )
                    		),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Left', 'bb-powerpack'),
                                'tooltip'       => __( 'Left', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-left',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col .pp-pricing-table-column .pp-pricing-table-title',
									'property'	=> 'padding-left',
									'unit'		=> 'px'
		                        )
                    		),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Right', 'bb-powerpack'),
                                'tooltip'       => __( 'Right', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-right',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col .pp-pricing-table-column .pp-pricing-table-title',
									'property'	=> 'padding-right',
									'unit'		=> 'px'
		                        )
                    		),
                    	)
                    ),
				)
			),
			'price_style'	=> array(
				'title'	=> __( 'Price', 'bb-powerpack' ),
				'fields'	=> array(
					'price_bg_color'  => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'bb-powerpack'),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'			=> 'css',
							'selector'		=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight):not(.pp-pricing-table-highlight-price) .pp-pricing-table-column .pp-pricing-table-price',
							'property'		=> 'background-color',
						)
					),
					'price_color'  => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'bb-powerpack'),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'			=> 'css',
							'selector'		=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight):not(.pp-pricing-table-highlight-price) .pp-pricing-table-column .pp-pricing-table-price',
							'property'		=> 'color',
						)
					),
					'duration_text_color' 		=> array(
						'type'			=> 'color',
						'label'			=> __( 'Duration Color', 'bb-powerpack' ),
						'default'		=> '',
						'show_reset'    => true,
						'preview'       => array(
							'type'		=> 'css',
							'selector'        => '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight):not(.pp-pricing-table-highlight-price) .pp-pricing-table-column .pp-pricing-table-duration',
							'property'        => 'color',
						),
					),
					'price_alignment' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Alignment', 'bb-powerpack'),
						'default'	=> 'center',
						'options'       => array(
							'left'          => __('Left', 'bb-powerpack'),
							'center'         => __('Center', 'bb-powerpack'),
							'right'         => __('Right', 'bb-powerpack'),
						),
						'preview'       => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-price',
							'property'	=> 'text-align',
						)
					),
					'price_padding'   => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Padding', 'bb-powerpack'),
                        'description'   => 'px',
						'default'       => array(
                            'top' => 10,
                            'right' => 10,
                            'bottom' => 10,
                            'left' => 10,
                        ),
                    	'options' 		=> array(
                    		'top' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => __( 'Top', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-up',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-price',
									'property'	=> 'padding-top',
									'unit'		=> 'px'
		                        )
                    		),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __( 'Bottom', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-down',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-price',
									'property'	=> 'padding-bottom',
									'unit'		=> 'px'
		                        )
                    		),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Left', 'bb-powerpack'),
                                'tooltip'       => __( 'Left', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-left',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-price',
									'property'	=> 'padding-left',
									'unit'		=> 'px'
		                        )
                    		),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Right', 'bb-powerpack'),
                                'tooltip'       => __( 'Right', 'bb-powerpack' ),
                    			'icon'		=> 'fa-long-arrow-right',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-price',
									'property'	=> 'padding-right',
									'unit'		=> 'px'
		                        )
                    		),
                    	)
                    ),
				)
			),
			'features_style'	=> array(
				'title'	=> __( 'Items', 'bb-powerpack' ),
				'fields'	=> array(
					'features_min_height'   => array(
						'type'          => 'text',
						'label'         => __('Items Min Height', 'bb-powerpack'),
						'default'       => '0',
						'size'          => '5',
						'description'   => 'px',
						'help'          => __('Use this to normalize the height of your boxes when they have different numbers of items.', 'bb-powerpack'),
						'preview'		=> array(
							'type'			=> 'css',
							'selector'		=> '.pp-pricing-table .pp-pricing-table-column .pp-pricing-table-features',
							'property'		=> 'min-height',
							'unit'			=> 'px'
						)
					),
					'even_features_background'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __('Alternate Background Color', 'bb-powerpack'),
						'show_reset'	=> true,
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight) .pp-pricing-table-column .pp-pricing-table-features li:nth-child(even)',
							'property'	=> 'background-color'
						)
					),
					'features_font_color' 		=> array(
						'type'			=> 'color',
						'label'			=> __('Text Color', 'bb-powerpack'),
						'default'		=> '',
						'show_reset'	=> true,
						'preview'       => array(
							'type'		=> 'css',
							'selector'        => '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight) .pp-pricing-table-column .pp-pricing-table-features',
							'property'        => 'color',
						),
					),
					'features_border'    => array(
						'type'      => 'pp-switch',
						'label'     => __('Border Style', 'bb-powerpack'),
						'default'   => 'none',
						'options'   => array(
							'none'  => __('None', 'bb-powerpack'),
							'solid'  => __('Solid', 'bb-powerpack'),
							'dashed'  => __('Dashed', 'bb-powerpack'),
							'dotted'  => __('Dotted', 'bb-powerpack'),
						),
						'toggle'    => array(
							'dashed'   => array(
								'fields'    => array('features_border_width', 'features_border_color')
							),
							'dotted'   => array(
								'fields'    => array('features_border_width', 'features_border_color')
							),
							'solid'   => array(
								'fields'    => array('features_border_width', 'features_border_color')
							),
						),
						'preview'           => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight) .pp-pricing-table-column .pp-pricing-table-features li',
							'property'	=> 'border-bottom-style',
						)
					),
					'features_border_width'   => array(
						'type'              => 'text',
						'label'             => __('Border Width', 'bb-powerpack'),
						'description'       => 'px',
						'size'             	=> 5,
						'default'           => 1,
						'preview'           => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight) .pp-pricing-table-column .pp-pricing-table-features li',
							'property'	=> 'border-bottom-width',
							'unit'		=> 'px'
						)
					),
					'features_border_color'   => array(
						'type'      => 'color',
						'label'     => __('Border Color', 'bb-powerpack'),
						'show_reset'   => true,
						'default'	=> 'dddddd',
						'preview'              => array(
							'type'				=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight) .pp-pricing-table-column .pp-pricing-table-features li',
							'property'	=> 'border-color',
						)
					),
					'features_alignment' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Alignment', 'bb-powerpack'),
						'default'	=> 'left',
						'options'       => array(
							'left'          => __('Left', 'bb-powerpack'),
							'center'         => __('Center', 'bb-powerpack'),
							'right'         => __('Right', 'bb-powerpack'),
						),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix):not(.pp-pricing-table-highlight) .pp-pricing-table-column .pp-pricing-table-features',
							'property'	=> 'text-align'
						)
					),
					'features_padding'   => array(
						'type'      => 'pp-multitext',
						'label'     => __('Padding', 'bb-powerpack'),
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
								'placeholder'   =>  __('Top', 'bb-powerpack'),
								'tooltip'       => __( 'Top', 'bb-powerpack' ),
								'icon'		=> 'fa-long-arrow-up',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col .pp-pricing-table-features li',
									'property'	=> 'padding-top',
									'unit'		=> 'px'
								)
							),
							'bottom' => array(
								'maxlength' => 3,
								'placeholder'   =>  __('Bottom', 'bb-powerpack'),
								'tooltip'       => __( 'Bottom', 'bb-powerpack' ),
								'icon'		=> 'fa-long-arrow-down',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col .pp-pricing-table-features li',
									'property'	=> 'padding-bottom',
									'unit'		=> 'px'
								)
							),
							'left' => array(
								'maxlength' => 3,
								'placeholder'   =>  __('Left', 'bb-powerpack'),
								'tooltip'       => __( 'Left', 'bb-powerpack' ),
								'icon'		=> 'fa-long-arrow-left',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col .pp-pricing-table-features li',
									'property'	=> 'padding-left',
									'unit'		=> 'px'
								)
							),
							'right' => array(
								'maxlength' => 3,
								'placeholder'   =>  __('Right', 'bb-powerpack'),
								'tooltip'       => __( 'Right', 'bb-powerpack' ),
								'icon'		=> 'fa-long-arrow-right',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col .pp-pricing-table-features li',
									'property'	=> 'padding-right',
									'unit'		=> 'px'
								)
							),
						)
					),
				)
			)
		),
	),
	'highlight_box_style'	=> array(
		'title'	=> __( 'Highlight', 'bb-powerpack' ),
		'sections'	=> array(
			'general'	=> array(
				'title'	=> '',
				'fields'	=> array(
					'highlight'   => array(
						'type'          => 'pp-switch',
						'label'         => __('Highlight', 'bb-powerpack'),
						'default'       => 'none',
						'options'       => array(
							'none'       	=> __('None', 'bb-powerpack'),
							'title'       	=> __('Title', 'bb-powerpack'),
							'price'       	=> __('Price', 'bb-powerpack'),
							'package'     	=> __('Package', 'bb-powerpack')
						),
						'toggle'	=> array(
							'title'	=> array(
								'sections'	=> array('hl_title_style'),
								'fields'	=> array('hl_packages')
							),
							'price'	=> array(
								'sections'	=> array('hl_price_style'),
								'fields'	=> array('hl_packages')
							),
							'package'	=> array(
								'sections'	=> array( 'hl_box_style', 'hl_features_style', 'hl_title_style', 'hl_price_style', 'hl_featured_title_style' ),
								'fields'	=> array( 'hl_packages' ),
							)
						)
					),
					'hl_packages'   => array(
						'type'                 => 'select',
						'label'                => __('Highlight Package', 'bb-powerpack'),
						'default'              => 0,
						'options'              => array(
							0	=> __('Package 1', 'bb-powerpack'),
							1	=> __('Package 2', 'bb-powerpack'),
							2	=> __('Package 3', 'bb-powerpack'),
							3	=> __('Package 4', 'bb-powerpack'),
							4	=> __('Package 5', 'bb-powerpack'),
							5	=> __('Package 6', 'bb-powerpack'),
						),
					),
				)
			),
			'hl_box_style' => array(
				'title'	=> __( 'Package', 'bb-powerpack' ),
				'fields'	=> array(
					'hl_box_bg_color'      => array(
						'type'      => 'color',
						'label'     => __('Background Color', 'bb-powerpack'),
						'show_reset'   => true,
						'default'		=> 'f3f3f3',
						'preview'       => array(
							'type'			=> 'css',
							'selector'		=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column',
							'property'		=> 'background-color',
						)
					),
					'hl_box_border'    => array(
						'type'      => 'pp-switch',
						'label'     => __('Border Style', 'bb-powerpack'),
						'default'   => 'none',
						'options'   => array(
							'none'  => __('None', 'bb-powerpack'),
							'solid'  => __('Solid', 'bb-powerpack'),
							'dashed'  => __('Dashed', 'bb-powerpack'),
							'dotted'  => __('Dotted', 'bb-powerpack'),
						),
						'toggle'    => array(
							'dashed'   => array(
								'fields'    => array('hl_box_border_width', 'hl_box_border_color')
							),
							'dotted'   => array(
								'fields'    => array('hl_box_border_width', 'hl_box_border_color')
							),
							'solid'   => array(
								'fields'    => array('hl_box_border_width', 'hl_box_border_color')
							),
						),
						'preview'              => array(
							'type'				=> 'css',
							'selector'			=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column',
							'property'			=> 'border-style',
						)
					),
					'hl_box_border_width'   => array(
						'type'      => 'text',
						'label'     => __('Border Width', 'bb-powerpack'),
						'size'      => 5,
						'maxlength' => 3,
						'default'   => 1,
						'description'   => 'px',
						'preview'              => array(
							'type'				=> 'css',
							'selector'			=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column',
							'property'			=> 'border-width',
							'unit'				=> 'px'
						)
					),
					'hl_box_border_color'   => array(
						'type'      => 'color',
						'label'     => __('Border Color', 'bb-powerpack'),
						'show_reset'   => true,
						'preview'              => array(
							'type'				=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column',
							'property'	=> 'border-color',
						)
					),
					'hl_box_shadow_display'   => array(
						'type'                 => 'pp-switch',
						'label'                => __('Enable Shadow', 'bb-powerpack'),
						'default'              => 'no',
						'options'              => array(
							'yes'          => __('Yes', 'bb-powerpack'),
							'no'             => __('No', 'bb-powerpack'),
						),
						'toggle'    =>  array(
							'yes'   => array(
								'fields'    => array('hl_box_shadow', 'hl_box_shadow_color', 'hl_box_shadow_opacity')
							)
						)
					),
					'hl_box_shadow' 		=> array(
						'type'              => 'pp-multitext',
						'label'             => __('Box Shadow', 'bb-powerpack'),
						'default'           => array(
							'vertical'			=> 2,
							'horizontal'		=> 2,
							'blur'				=> 2,
							'spread'			=> 1
						),
						'options'			=> array(
							'vertical'			=> array(
								'placeholder'		=> __('Vertical', 'bb-powerpack'),
								'tooltip'			=> __('Vertical', 'bb-powerpack'),
								'icon'				=> 'fa-arrows-v'
							),
							'horizontal'		=> array(
								'placeholder'		=> __('Horizontal', 'bb-powerpack'),
								'tooltip'			=> __('Horizontal', 'bb-powerpack'),
								'icon'				=> 'fa-arrows-h'
							),
							'blur'				=> array(
								'placeholder'		=> __('Blur', 'bb-powerpack'),
								'tooltip'			=> __('Blur', 'bb-powerpack'),
								'icon'				=> 'fa-circle-o'
							),
							'spread'			=> array(
								'placeholder'		=> __('Spread', 'bb-powerpack'),
								'tooltip'			=> __('Spread', 'bb-powerpack'),
								'icon'				=> 'fa-paint-brush'
							),
						)
					),
					'hl_box_shadow_color' => array(
						'type'              => 'color',
						'label'             => __('Shadow Color', 'bb-powerpack'),
						'default'           => '000000',
					),
					'hl_box_shadow_opacity' => array(
						'type'              => 'text',
						'label'             => __('Shadow Opacity', 'bb-powerpack'),
						'description'       => '%',
						'size'             => 5,
						'default'           => 50,
					),
					'hl_box_margin_top'	=> array(
						'type'		=> 'text',
						'label'		=> __('Margin Top', 'bb-powerpack'),
						'description'	=> 'px',
						'default'	=> 0,
						'size'		=> 5,
						'preview'   => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column',
							'property'	=> 'margin-top',
							'unit'		=> 'px'
						)
					),
					'hl_box_padding'   => array(
						'type'      => 'pp-multitext',
						'label'     => __('Padding', 'bb-powerpack'),
						'description'   => 'px',
						'default'       => array(
							'top' => 10,
							'right' => 10,
							'bottom' => 10,
							'left' => 10,
						),
						'options' 		=> array(
							'top' => array(
								'maxlength' => 3,
								'placeholder'   =>  __('Top', 'bb-powerpack'),
								'tooltip'       => __( 'Top', 'bb-powerpack' ),
								'icon'		=> 'fa-long-arrow-up',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column',
									'property'	=> 'padding-top',
									'unit'		=> 'px'
								)
							),
							'bottom' => array(
								'maxlength' => 3,
								'placeholder'   =>  __('Bottom', 'bb-powerpack'),
								'tooltip'       => __( 'Bottom', 'bb-powerpack' ),
								'icon'		=> 'fa-long-arrow-down',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column',
									'property'	=> 'padding-bottom',
									'unit'		=> 'px'
								)
							),
							'left' => array(
								'maxlength' => 3,
								'placeholder'   =>  __('Left', 'bb-powerpack'),
								'tooltip'       => __( 'Left', 'bb-powerpack' ),
								'icon'		=> 'fa-long-arrow-left',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column',
									'property'	=> 'padding-left',
									'unit'		=> 'px'
								)
							),
							'right' => array(
								'maxlength' => 3,
								'placeholder'   =>  __('Right', 'bb-powerpack'),
								'tooltip'       => __( 'Right', 'bb-powerpack' ),
								'icon'		=> 'fa-long-arrow-right',
								'preview'              => array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column',
									'property'	=> 'padding-right',
									'unit'		=> 'px'
								)
							),
						)
					),
				)
			),
			'hl_featured_title_style'	=> array(
				'title'	=> __( 'Featured Title', 'bb-powerpack' ),
				'fields'	=> array(
					'hl_featured_title_bg_color' => array(
						'type'              => 'color',
						'label'             => __('Background Color', 'bb-powerpack'),
						'default'           => 'cccccc',
						'show_reset'		=> true,
						'preview'       => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-featured-title',
							'property'	=> 'background-color',
						)
					),
					'hl_featured_title_color'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __('Text Color', 'bb-powerpack'),
						'show_reset'    => true,
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-featured-title',
							'property'	=> 'color'
						)
					),
				)
			),
			'hl_title_style'	=> array(
				'title'	=> __( 'Package Title', 'bb-powerpack' ),
				'fields'	=> array(
					'hl_title_bg_color' => array(
						'type'              => 'color',
						'label'             => __('Background Color', 'bb-powerpack'),
						'default'           => 'cccccc',
						'show_reset'		=> true,
						'preview'       => array(
							'type'			=> 'css',
							'rules'			=> array(
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-title',
									'property'	=> 'background-color',
								),
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight-title .pp-pricing-table-column .pp-pricing-table-title',
									'property'	=> 'background-color',
								)
							)
						)
					),
					'hl_title_color'  => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'bb-powerpack'),
						'default'       => '',
						'show_reset'	=> true,
						'preview'       => array(
							'type'			=> 'css',
							'rules'			=> array(
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-title',
									'property'	=> 'color',
								),
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight-title .pp-pricing-table-column .pp-pricing-table-title',
									'property'	=> 'color',
								)
							)
						)
					),
				)
			),
			'hl_price_style'	=> array(
				'title'				=> __( 'Price', 'bb-powerpack' ),
				'fields'			=> array(
					'hl_price_bg_color' => array(
						'type'              => 'color',
						'label'             => __('Background Color', 'bb-powerpack'),
						'default'           => 'cccccc',
						'show_reset'		=> true,
						'preview'       => array(
							'type'			=> 'css',
							'rules'			=> array(
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-price',
									'property'	=> 'background-color',
								),
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight-price .pp-pricing-table-column .pp-pricing-table-price',
									'property'	=> 'background-color',
								)
							)
						)
					),
					'hl_price_color'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __('Text Color', 'bb-powerpack'),
						'show_reset'	=> true,
						'preview'       => array(
							'type'			=> 'css',
							'rules'			=> array(
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-price',
									'property'	=> 'color',
								),
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight-price .pp-pricing-table-column .pp-pricing-table-price',
									'property'	=> 'color',
								)
							)
						)
					),
					'hl_duration_color'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __('Duration Color', 'bb-powerpack'),
						'show_reset'	=> true,
						'preview'       => array(
							'type'			=> 'css',
							'rules'			=> array(
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-duration',
									'property'	=> 'color',
								),
								array(
									'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight-price .pp-pricing-table-column .pp-pricing-table-duration',
									'property'	=> 'color',
								)
							)
						)
					),
				)
			),
			'hl_features_style'	=> array(
				'title'	=> __( 'Items', 'bb-powerpack' ),
				'fields'	=> array(
					'hl_even_features_bg_color'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __('Alternate Background Color', 'bb-powerpack'),
						'show_reset'	=> true,
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-features li:nth-child(even)',
							'property'	=> 'background-color'
						)
					),
					'hl_features_color'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __('Text Color', 'bb-powerpack'),
						'show_reset'    => true,
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-features',
							'property'	=> 'color'
						)
					),
					'hl_features_border'    => array(
						'type'      => 'pp-switch',
						'label'     => __('Border Style', 'bb-powerpack'),
						'default'   => 'none',
						'options'   => array(
							'none'  => __('None', 'bb-powerpack'),
							'solid'  => __('Solid', 'bb-powerpack'),
							'dashed'  => __('Dashed', 'bb-powerpack'),
							'dotted'  => __('Dotted', 'bb-powerpack'),
						),
						'toggle'    => array(
							'dashed'   => array(
								'fields'    => array('hl_features_border_width', 'hl_features_border_color')
							),
							'dotted'   => array(
								'fields'    => array('hl_features_border_width', 'hl_features_border_color')
							),
							'solid'   => array(
								'fields'    => array('hl_features_border_width', 'hl_features_border_color')
							),
						),
						'preview'           => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-features li',
							'property'	=> 'border-bottom-style',
						)
					),
					'hl_features_border_width'   => array(
						'type'              => 'text',
						'label'             => __('Border Width', 'bb-powerpack'),
						'description'       => 'px',
						'size'             	=> 5,
						'default'           => 1,
						'preview'           => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-features li',
							'property'	=> 'border-bottom-width',
							'unit'		=> 'px'
						)
					),
					'hl_features_border_color'   => array(
						'type'      => 'color',
						'label'     => __('Border Color', 'bb-powerpack'),
						'show_reset'   => true,
						'default'	=> '',
						'preview'              => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col.pp-pricing-table-highlight .pp-pricing-table-column .pp-pricing-table-features li',
							'property'	=> 'border-color',
						)
					),
				)
			),
		)
	),
	'typography'	=> array(
		'title'		=> __('Typography', 'bb-powerpack'),
		'sections'	=> array(
			'featured_title_typography'	=> array(
				'title'	=> __( 'Featured Title', 'bb-powerpack' ),
				'fields'	=> array(
					'featured_title_font'	=> array(
						'type'		=> 'font',
						'label'		=> __('Font', 'bb-powerpack'),
						'default'	=> array(
							'family'	=> 'Default',
							'weight'	=> '400',
						),
						'preview'       => array(
							'type'		=> 'font',
							'selector'        => '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-featured-title',
						),
					),
					'featured_title_font_size' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Font Size', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('featured_title_custom_font_size')
							)
						),
					),
					'featured_title_custom_font_size'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Font Size', 'bb-powerpack'),
						'default'		=> array(
							'desktop'	=> 24,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-featured-title',
									'property'        => 'font-size',
									'unit'            => 'px'
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'featured_title_line_height' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Line Height', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('featured_title_custom_line_height')
							)
						),
					),
					'featured_title_custom_line_height'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Line Height', 'bb-powerpack'),
						'help' 		=> __('Recommended values between 1-2', 'bb-powerpack'),
						'default'	=> array(
							'desktop'	=> 1.6,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-featured-title',
									'property'        => 'line-height',
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'featured_title_text_transform' => array(
						'type'		=> 'select',
						'label'		=> __('Text Transform', 'bb-powerpack'),
						'default'	=> 'none',
						'options'       => array(
							'none'          => __('None', 'bb-powerpack'),
							'lowercase'     => __('lowercase', 'bb-powerpack'),
							'uppercase'     => __('UPPERCASE', 'bb-powerpack'),
						),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-featured-title',
							'property'	=> 'text-transform'
						)
					),
					'featured_title_letter_spacing'   => array(
						'type'              => 'text',
						'label'             => __('Letter Spacing', 'bb-powerpack'),
						'description'       => 'px',
						'size'             	=> 5,
						'default'           => 0,
						'preview'           => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-featured-title',
							'property'	=> 'letter-spacing',
							'unit'		=> 'px'
						)
					),
				)
			),
			'title_typography'	=> array(
				'title'	=> __( 'Package Title', 'bb-powerpack' ),
				'fields'	=> array(
					'title_tag'		=> array(
						'type'		=> 'select',
						'label'		=> __('HTML Tag', 'bb-powerpack'),
						'options'	=> array(
							'h1'	=> 'H1',
							'h2'	=> 'H2',
							'h3'	=> 'H3',
							'h4'	=> 'H4',
							'h5'	=> 'H5',
							'h6'	=> 'H6',
						),
						'default'	=> 'h4',
						'help' 		=> __('Set the HTML tag for title output', 'bb-powerpack'),
					),
					'title_font'	=> array(
						'type'		=> 'font',
						'label'		=> __('Font', 'bb-powerpack'),
						'default'	=> array(
							'family'	=> 'Default',
							'weight'	=> '400',
						),
						'preview'       => array(
							'type'		=> 'font',
							'selector'        => '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-title',
						),
					),
					'title_font_size' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Font Size', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('title_custom_font_size')
							)
						),
					),
					'title_custom_font_size'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Font Size', 'bb-powerpack'),
						'default'		=> array(
							'desktop'	=> 24,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-title',
									'property'        => 'font-size',
									'unit'            => 'px'
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'title_line_height' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Line Height', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('title_custom_line_height')
							)
						),
					),
					'title_custom_line_height'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Line Height', 'bb-powerpack'),
						'help' 		=> __('Recommended values between 1-2', 'bb-powerpack'),
						'default'	=> array(
							'desktop'	=> 1.6,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-title',
									'property'        => 'line-height',
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'title_text_transform' => array(
						'type'		=> 'select',
						'label'		=> __('Text Transform', 'bb-powerpack'),
						'default'	=> 'none',
						'options'       => array(
							'none'          => __('None', 'bb-powerpack'),
							'lowercase'     => __('lowercase', 'bb-powerpack'),
							'uppercase'     => __('UPPERCASE', 'bb-powerpack'),
						),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-title',
							'property'	=> 'text-transform'
						)
					),
					'title_letter_spacing'   => array(
						'type'              => 'text',
						'label'             => __('Letter Spacing', 'bb-powerpack'),
						'description'       => 'px',
						'size'             	=> 5,
						'default'           => 0,
						'preview'           => array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-title',
							'property'	=> 'letter-spacing',
							'unit'		=> 'px'
						)
					),
				)
			),
			'price_typography'	=> array(
				'title'	=> __( 'Price', 'bb-powerpack' ),
				'fields'	=> array(
					'price_font'	=> array(
						'type'		=> 'font',
						'label'		=> __('Font', 'bb-powerpack'),
						'default'	=> array(
							'family'	=> 'Default',
							'weight'	=> '400',
						),
						'preview'       => array(
							'type'		=> 'font',
							'selector'        => '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-price',
						),
					),
					'price_font_size' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Price Font Size', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('price_custom_font_size')
							)
						),
					),
					'price_custom_font_size'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Price Custom Font Size', 'bb-powerpack'),
						'default'		=> array(
							'desktop'	=> 50,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-price',
									'property'        => 'font-size',
									'unit'            => 'px'
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'duration_font_size' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Duration Font Size', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('duration_custom_font_size')
							)
						),
					),
					'duration_custom_font_size'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Duration Custom Font Size', 'bb-powerpack'),
						'default'		=> array(
							'desktop'	=> 16,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-duration',
									'property'        => 'font-size',
									'unit'            => 'px'
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'price_text_transform' => array(
						'type'		=> 'select',
						'label'		=> __('Text Transform', 'bb-powerpack'),
						'default'	=> 'none',
						'options'       => array(
							'none'          => __('None', 'bb-powerpack'),
							'lowercase'         => __('lowercase', 'bb-powerpack'),
							'uppercase'         => __('UPPERCASE', 'bb-powerpack'),
						),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-col:not(.pp-pricing-table-matrix) .pp-pricing-table-column .pp-pricing-table-price',
							'property'	=> 'text-transform'
						)
					),
				)
			),
			'features_typography'	=> array(
				'title'	=> __( 'Items', 'bb-powerpack' ),
				'fields'	=> array(
					'features_font'	=> array(
						'type'		=> 'font',
						'label'		=> __('Font', 'bb-powerpack'),
						'default'	=> array(
							'family'	=> 'Default',
							'weight'	=> '400',
						),
						'preview'       => array(
							'type'		=> 'font',
							'selector'        => '.pp-pricing-table .pp-pricing-table-column .pp-pricing-table-features',
						),
					),
					'features_font_size' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Font Size', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('features_custom_font_size')
							)
						),
					),
					'features_custom_font_size'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Font Size', 'bb-powerpack'),
						'default'		=> array(
							'desktop'	=> 18,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-pricing-table .pp-pricing-table-column .pp-pricing-table-features',
									'property'        => 'font-size',
									'unit'            => 'px'
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'features_text_transform' => array(
						'type'		=> 'select',
						'label'		=> __('Text Transform', 'bb-powerpack'),
						'default'	=> 'none',
						'options'       => array(
							'none'          => __('None', 'bb-powerpack'),
							'lowercase'         => __('lowercase', 'bb-powerpack'),
							'uppercase'         => __('UPPERCASE', 'bb-powerpack'),
						),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-column .pp-pricing-table-features',
							'property'	=> 'text-transform'
						)
					),
				)
			),
			'button_typography'	=> array(
				'title'	=> __( 'Button', 'bb-powerpack' ),
				'fields'	=> array(
					'button_font'	=> array(
						'type'		=> 'font',
						'label'		=> __('Font', 'bb-powerpack'),
						'default'	=> array(
							'family'	=> 'Default',
							'weight'	=> '400',
						),
						'preview'       => array(
							'type'		=> 'font',
							'selector'        => '.pp-pricing-table .pp-pricing-table-column a.fl-button',
						),
					),
					'button_font_size' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Font Size', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('button_custom_font_size')
							)
						),
					),
					'button_custom_font_size'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Font Size', 'bb-powerpack'),
						'default'		=> array(
							'desktop'	=> 16,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-pricing-table .pp-pricing-table-column a.fl-button',
									'property'        => 'font-size',
									'unit'            => 'px'
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),
						),
					),
					'button_text_transform' => array(
						'type'		=> 'select',
						'label'		=> __('Text Transform', 'bb-powerpack'),
						'default'	=> 'none',
						'options'       => array(
							'none'          => __('None', 'bb-powerpack'),
							'lowercase'         => __('lowercase', 'bb-powerpack'),
							'uppercase'         => __('UPPERCASE', 'bb-powerpack'),
						),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-pricing-table .pp-pricing-table-column a.fl-button',
							'property'	=> 'text-transform'
						)
					),
				)
			)
		)
	)
));

FLBuilder::register_settings_form('pp_pricing_column_form', array(
	'title' => __( 'Add Package', 'bb-powerpack' ),
	'tabs'  => array(
		'general'      => array(
			'title'         => __('General', 'bb-powerpack'),
			'sections'      => array(
				'general'	=> array(
					'title'	=> __('Featured Title', 'bb-powerpack'),
					'fields'	=> array(
						'hl_featured_title'          => array(
							'type'          => 'text',
							'label'         => __('Title', 'bb-powerpack'),
							'connections'   => array( 'string', 'html', 'url' ),
						),
					)
				),
				'title'       => array(
					'title'         => __( 'Package Title', 'bb-powerpack' ),
					'fields'        => array(
						'title'          => array(
							'type'          => 'text',
							'label'         => __('Title', 'bb-powerpack'),
							'connections'   => array( 'string', 'html', 'url' ),
						),
					),
				),
				'price-box'       => array(
					'title'         => __( 'Price Box', 'bb-powerpack' ),
					'fields'        => array(
						'price'          => array(
							'type'          => 'text',
							'label'         => __('Price', 'bb-powerpack'),
						),
						'duration'          => array(
							'type'          => 'text',
							'label'         => __('Duration', 'bb-powerpack'),
							'placeholder'   => __( 'per Year', 'bb-powerpack' )
						),
					)
				),
			)
		),
		'items'	=> array(
			'title'		=> __('Items', 'bb-powerpack'),
			'sections'	=> array(
				'features'       => array(
					'title'         => _x( 'Items', 'items to be displayed in the pricing box.', 'bb-powerpack' ),
					'fields'        => array(
						'features'          => array(
							'type'          => 'text',
							'label'         => '',
							'placeholder'   => __( 'One item per line. HTML is okay.', 'bb-powerpack' ),
							'multiple'      => true
						)
					)
				)
			)
		),
		'button'      => array(
			'title'         => __('Button', 'bb-powerpack'),
			'sections'      => array(
				'default'   => array(
					'title'         => '',
					'fields'        => array(
						'button_text'   => array(
							'type'          => 'text',
							'label'         => __('Button Text', 'bb-powerpack'),
							'default'       => __('Get Started', 'bb-powerpack'),
						),
						'button_url'    => array(
							'type'          => 'link',
							'label'         => __('Button URL', 'bb-powerpack'),
							'connections'   => array( 'url' ),
						),
						'btn_link_target'    	=> array(
							'type'          => 'pp-switch',
							'label'         => __('Link Target', 'bb-powerpack'),
							'default'       => '_self',
							'options'       => array(
								'_self'         => __('Same Window', 'bb-powerpack'),
								'_blank'        => __('New Window', 'bb-powerpack')
							),
							'preview'       => array(
								'type'          => 'none'
							)
						),
						'btn_link_nofollow' => array(
							'type'          	=> 'pp-switch',
							'label' 	        => __('Link No Follow', 'bb-powerpack'),
							'default'       => 'no',
							'options' 			=> array(
								'yes' 				=> __('Yes', 'bb-powerpack'),
								'no' 				=> __('No', 'bb-powerpack'),
							),
							'preview'       	=> array(
								'type'          	=> 'none'
							)
						),
						'btn_icon'      => array(
							'type'          => 'icon',
							'label'         => __('Button Icon', 'bb-powerpack'),
							'show_remove'   => true
						),
						'btn_icon_position' => array(
							'type'          => 'pp-switch',
							'label'         => __('Button Icon Position', 'bb-powerpack'),
							'default'       => 'before',
							'options'       => array(
								'before'        => __('Before Text', 'bb-powerpack'),
								'after'         => __('After Text', 'bb-powerpack')
							)
						),
						'btn_icon_animation' => array(
							'type'          => 'select',
							'label'         => __('Icon Visibility', 'bb-powerpack'),
							'default'       => 'disable',
							'options'       => array(
								'disable'        => __('Always Visible', 'bb-powerpack'),
								'enable'         => __('Fade In On Hover', 'bb-powerpack')
							)
						)
					)
				),
				'btn_colors'     => array(
					'title'         => __('Button Colors', 'bb-powerpack'),
					'fields'        => array(
						'btn_bg_color'  => array(
							'type'          => 'color',
							'label'         => __('Background Color', 'bb-powerpack'),
							'default'       => '',
							'show_reset'    => true
						),
						'btn_bg_hover_color' => array(
							'type'          => 'color',
							'label'         => __('Background Hover Color', 'bb-powerpack'),
							'default'       => '',
							'show_reset'    => true,
						),
						'btn_text_color' => array(
							'type'          => 'color',
							'label'         => __('Text Color', 'bb-powerpack'),
							'default'       => '',
							'show_reset'    => true
						),
						'btn_text_hover_color' => array(
							'type'          => 'color',
							'label'         => __('Text Hover Color', 'bb-powerpack'),
							'default'       => '',
							'show_reset'    => true,
						)
					)
				),
				'btn_style'     => array(
					'title'         => __('Button Style', 'bb-powerpack'),
					'fields'        => array(
						'btn_style'     => array(
							'type'          => 'pp-switch',
							'label'         => __('Style', 'bb-powerpack'),
							'default'       => 'flat',
							'options'       => array(
								'flat'          => __('Flat', 'bb-powerpack'),
								'gradient'      => __('Gradient', 'bb-powerpack'),
								'transparent'   => __('Transparent', 'bb-powerpack')
							),
							'toggle'        => array(
								'transparent'   => array(
									'fields'        => array('btn_bg_opacity', 'btn_bg_hover_opacity', 'btn_border_size')
								)
							)
						),
						'btn_border_size' => array(
							'type'          => 'text',
							'label'         => __('Border Size', 'bb-powerpack'),
							'default'       => '2',
							'description'   => 'px',
							'maxlength'     => '3',
							'size'          => '5',
							'placeholder'   => '0'
						),
						'btn_bg_opacity' => array(
							'type'          => 'text',
							'label'         => __('Background Opacity', 'bb-powerpack'),
							'default'       => '0',
							'description'   => '%',
							'maxlength'     => '3',
							'size'          => '5',
							'placeholder'   => '0'
						),
						'btn_bg_hover_opacity' => array(
						'type'          => 'text',
						'label'         => __('Background Hover Opacity', 'bb-powerpack'),
						'default'       => '0',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
						),
						'btn_button_transition' => array(
							'type'          => 'pp-switch',
							'label'         => __('Transition', 'bb-powerpack'),
							'default'       => 'disable',
							'options'       => array(
								'disable'        => __('Disabled', 'bb-powerpack'),
								'enable'         => __('Enabled', 'bb-powerpack')
							)
						)
					)
				),
				'btn_structure' => array(
					'title'         => __('Button Structure', 'bb-powerpack'),
					'fields'        => array(
						'btn_width'     => array(
							'type'          => 'pp-switch',
							'label'         => __('Width', 'bb-powerpack'),
							'default'       => 'full',
							'options'       => array(
								'auto'          => _x( 'Auto', 'Width.', 'bb-powerpack' ),
								'full'          => __('Full Width', 'bb-powerpack')
							)
						),
						'btn_align'    	=> array(
							'type'          => 'pp-switch',
							'label'         => __('Alignment', 'bb-powerpack'),
							'default'       => 'center',
							'options'       => array(
								'left'          => __('Left', 'bb-powerpack'),
								'center'		=> __('Center', 'bb-powerpack'),
								'right'         => __('Right', 'bb-powerpack'),
							),
							'preview'       => array(
								'type'          => 'none'
							)
						),
						'button_padding'   => array(
	                        'type'      => 'pp-multitext',
	                        'label'     => __( 'Padding', 'bb-powerpack' ),
	                        'description'   => __( 'px', 'bb-powerpack' ),
							'default'       => array(
	                            'top' => 10,
	                            'right' => 10,
	                            'bottom' => 10,
	                            'left' => 10,
	                        ),
	                    	'options' 		=> array(
	                    		'top' => array(
	                                'maxlength' => 3,
	                                'placeholder'   =>  __( 'Top', 'bb-powerpack' ),
	                                'tooltip'       => __( 'Top', 'bb-powerpack' ),
	                    			'icon'		=> 'fa-long-arrow-up',
									'preview'              => array(
										'selector'	=> '.pp-pricing-table .pp-pricing-table-column a.fl-button',
										'property'	=> 'padding-top',
										'unit'		=> 'px'
			                        )
	                    		),
	                            'bottom' => array(
	                                'maxlength' => 3,
	                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
	                                'tooltip'       => __( 'Bottom', 'bb-powerpack' ),
	                    			'icon'		=> 'fa-long-arrow-down',
									'preview'              => array(
										'selector'	=> '.pp-pricing-table .pp-pricing-table-column a.fl-button',
										'property'	=> 'padding-bottom',
										'unit'		=> 'px'
			                        )
	                    		),
	                            'left' => array(
	                                'maxlength' => 3,
	                                'placeholder'   =>  __('Left', 'bb-powerpack'),
	                                'tooltip'       => __( 'Left', 'bb-powerpack' ),
	                    			'icon'		=> 'fa-long-arrow-left',
									'preview'              => array(
										'selector'	=> '.pp-pricing-table .pp-pricing-table-column a.fl-button',
										'property'	=> 'padding-left',
										'unit'		=> 'px'
			                        )
	                    		),
	                            'right' => array(
	                                'maxlength' => 3,
	                                'placeholder'   =>  __('Right', 'bb-powerpack'),
	                                'tooltip'       => __( 'Right', 'bb-powerpack' ),
	                    			'icon'		=> 'fa-long-arrow-right',
									'preview'              => array(
										'selector'	=> '.pp-pricing-table .pp-pricing-table-column a.fl-button',
										'property'	=> 'padding-right',
										'unit'		=> 'px'
			                        )
	                    		),
	                    	)
	                    ),
						'button_margin'   => array(
	                        'type'      => 'pp-multitext',
	                        'label'     => __( 'Margin', 'bb-powerpack' ),
	                        'description'   => __( 'px', 'bb-powerpack' ),
							'default'       => array(
	                            'top' => 0,
	                            'right' => 0,
	                            'bottom' => 0,
	                            'left' => 0,
	                        ),
	                    	'options' 		=> array(
	                    		'top' => array(
	                                'maxlength' => 3,
	                                'placeholder'   =>  __( 'Top', 'bb-powerpack' ),
	                                'tooltip'       => __( 'Top', 'bb-powerpack' ),
	                    			'icon'		=> 'fa-long-arrow-up',
									'preview'              => array(
										'selector'	=> '.pp-pricing-table .pp-pricing-table-column a.fl-button',
										'property'	=> 'padding-top',
										'unit'		=> 'px'
			                        )
	                    		),
	                            'bottom' => array(
	                                'maxlength' => 3,
	                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
	                                'tooltip'       => __( 'Bottom', 'bb-powerpack' ),
	                    			'icon'		=> 'fa-long-arrow-down',
									'preview'              => array(
										'selector'	=> '.pp-pricing-table .pp-pricing-table-column a.fl-button',
										'property'	=> 'padding-bottom',
										'unit'		=> 'px'
			                        )
	                    		),
	                            'left' => array(
	                                'maxlength' => 3,
	                                'placeholder'   =>  __('Left', 'bb-powerpack'),
	                                'tooltip'       => __( 'Left', 'bb-powerpack' ),
	                    			'icon'		=> 'fa-long-arrow-left',
									'preview'              => array(
										'selector'	=> '.pp-pricing-table .pp-pricing-table-column a.fl-button',
										'property'	=> 'padding-left',
										'unit'		=> 'px'
			                        )
	                    		),
	                            'right' => array(
	                                'maxlength' => 3,
	                                'placeholder'   =>  __('Right', 'bb-powerpack'),
	                                'tooltip'       => __( 'Right', 'bb-powerpack' ),
	                    			'icon'		=> 'fa-long-arrow-right',
									'preview'              => array(
										'selector'	=> '.pp-pricing-table .pp-pricing-table-column a.fl-button',
										'property'	=> 'padding-right',
										'unit'		=> 'px'
			                        )
	                    		),
	                    	)
	                    ),
						'btn_border_radius' => array(
							'type'          => 'text',
							'label'         => __('Round Corners', 'bb-powerpack'),
							'default'       => '4',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px'
						)
					)
				)
			)
		),
		'style'      => array(
			'title'         => __('Style', 'bb-powerpack'),
			'sections'      => array(
				'package_style'       => array(
					'title'         => __('Package', 'bb-powerpack'),
					'fields'        => array(
						'margin'        => array(
							'type'          => 'text',
							'label'         => __('Package Top Margin', 'bb-powerpack'),
							'default'       => '0',
							'maxlength'     => '3',
							'size'          => '3',
							'description'   => 'px'
						),
						'package_bg_color'  => array(
							'type'          => 'color',
							'label'         => __('Package Background Color', 'bb-powerpack'),
							'default'       => '',
							'show_reset'    => true
						),
					)
				),
			)
		)
	)
));
