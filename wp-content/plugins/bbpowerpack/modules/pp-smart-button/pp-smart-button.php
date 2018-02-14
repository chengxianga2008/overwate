<?php

/**
 * @class PPSmartButtonModule
 */
class PPSmartButtonModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Smart Button', 'bb-powerpack'),
			'description'   	=> __('A simple call to action button.', 'bb-powerpack'),
			'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-smart-button/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-smart-button/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh'   => true
		));
	}

	/**
	 * @method update
	 */
	public function update( $settings )
	{
		// Remove the old three_d setting.
		if ( isset( $settings->three_d ) ) {
			unset( $settings->three_d );
		}

		return $settings;
	}

	/**
	 * @method get_classname
	 */
	public function get_classname()
	{
		$classname = 'pp-button-wrap';

		if(!empty($this->settings->width)) {
			$classname .= ' pp-button-width-' . $this->settings->width;
		}
		if(!empty($this->settings->align)) {
			$classname .= ' pp-button-' . $this->settings->align;
		}
		if(!empty($this->settings->icon)) {
			$classname .= ' pp-button-has-icon';
		}

		return $classname;
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPSmartButtonModule', array(
	'general'       => array(
		'title'         => __('General', 'bb-powerpack'),
		'sections'      => array(
			'style'         => array(
				'title'         => __('Button Type', 'bb-powerpack'),
				'fields'        => array(
					'style'         => array(
						'type'          => 'pp-switch',
						'label'         => __('Type', 'bb-powerpack'),
						'default'       => 'flat',
						'options'       => array(
							'flat'          => __('Flat', 'bb-powerpack'),
							'gradient'      => __('Gradient', 'bb-powerpack'),
							'transparent'   => __('Transparent', 'bb-powerpack')
						),
						'toggle'		=> array(
							'flat'		=> array(
								'fields'	=> array('bg_color'),
								'sections'	=> array('effets'),
							),
							'gradient'		=> array(
								'fields'	=> array('bg_color_gradient', 'gradient_hover'),
							),
							'transparent'		=> array(
								'fields'	=> array('bg_color_transparent'),
							),
						),
					),
				)
			),
			'general'       => array(
				'title'         => __('Content', 'bb-powerpack'),
				'fields'        => array(
					'text'          => array(
						'type'          => 'text',
						'label'         => __('Text', 'bb-powerpack'),
						'default'       => __('Click Here', 'bb-powerpack'),
						'connections'   => array( 'string' ),
						'preview'         => array(
							'type'            => 'text',
							'selector'        => '.pp-button-text'
						)
					),
					'display_icon'	=> array(
						'type'		=> 'pp-switch',
						'label'		=> __('Display Icon', 'bb-powerpack'),
						'default'	=> 'no',
						'options'	=> array(
							'yes'	=> __('Yes', 'bb-powerpack'),
							'no'	=> __('No', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'yes'	=> array(
								'fields'	=> array('icon', 'icon_size', 'icon_position')
							),
						)
					),
					'icon'          => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'bb-powerpack'),
						'show_remove'   => true
					),
					'icon_size'          => array(
						'type'          => 'text',
						'label'         => __('Icon Size', 'bb-powerpack'),
						'size'			=> 5,
						'maxlength'		=> 3,
						'default'		=> 16,
						'description'	=> 'px',
						'preview'		=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-button .pp-button-icon',
							'property'	=> 'font-size',
							'unit'		=> 'px'
						)
					),
					'icon_position' => array(
						'type'          => 'pp-switch',
						'label'         => __('Icon Position', 'bb-powerpack'),
						'default'       => 'before',
						'options'       => array(
							'before'        => __('Before Text', 'bb-powerpack'),
							'after'         => __('After Text', 'bb-powerpack')
						)
					)
				)
			),
			'link'          => array(
				'title'         => __('Link', 'bb-powerpack'),
				'fields'        => array(
					'link'          => array(
						'type'          => 'link',
						'label'         => __('Link', 'bb-powerpack'),
						'placeholder'   => __( 'http://www.example.com', 'bb-powerpack' ),
						'connections'   => array( 'url' ),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'link_target'   => array(
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
					)
				)
			),
			'effets'		=> array(
				'title'		=> __('Transition', 'bb-powerpack'),
				'fields'	=> array(
					'button_effect'   => array(
                        'type'  => 'select',
                        'label' => __('Hover Transition', 'bb-powerpack'),
                        'default'   => 'fade',
                        'options'   => array(
                            'none'  => __('None', 'bb-powerpack'),
                            'fade'  => __('Fade', 'bb-powerpack'),
							'sweep_top'  => __('Sweep To Top', 'bb-powerpack'),
							'sweep_bottom'  => __('Sweep To Bottom', 'bb-powerpack'),
                            'sweep_left'  => __('Sweep To Left', 'bb-powerpack'),
							'sweep_right'  => __('Sweep To Right', 'bb-powerpack'),
							'bounce_top'  => __('Bounce To Top', 'bb-powerpack'),
							'bounce_bottom'  => __('Bounce To Bottom', 'bb-powerpack'),
                            'bounce_left'  => __('Bounce To Left', 'bb-powerpack'),
							'bounce_right'  => __('Bounce To Right', 'bb-powerpack'),
                            'radial_in'  => __('Radial In', 'bb-powerpack'),
							'radial_out'  => __('Radial Out', 'bb-powerpack'),
                            'rectangle_in'  => __('Rectangle In', 'bb-powerpack'),
							'rectangle_out'  => __('Rectangle Out', 'bb-powerpack'),
                            'shutter_in_horizontal'  => __('Shutter In Horizontal', 'bb-powerpack'),
                            'shutter_out_horizontal'  => __('Shutter Out Horizontal', 'bb-powerpack'),
                            'shutter_in_vertical'  => __('Shutter In Vertical', 'bb-powerpack'),
                            'shutter_out_vertical'  => __('Shutter Out Vertical', 'bb-powerpack'),
                            'shutter_in_diagonal'  => __('Shutter In Diagonal', 'bb-powerpack'),
							'shutter_out_diagonal'  => __('Shutter Out Diagonal', 'bb-powerpack'),
                        ),
                    ),
                    'button_effect_duration'  => array(
                        'type'  => 'text',
                        'label' => __('Transition Duration', 'bb-powerpack'),
                        'size'  => 5,
                        'maxlength' => 4,
                        'default'   => 500,
                        'description'   => __('ms', 'bb-powerpack'),
                    ),
				),
			),
		)
	),
	'style'         => array(
		'title'         => __('Style', 'bb-powerpack'),
		'sections'      => array(
			'colors'        => array(
				'title'         => __('Colors', 'bb-powerpack'),
				'fields'        => array(
					'bg_color'      => array(
						'type'          => 'pp-color',
						'label'         => __('Background', 'bb-powerpack'),
						'show_reset'    => true,
						'default'       => array(
							'primary'	=> 'd6d6d6',
							'secondary'	=> '333333',
						),
						'options'		=> array(
							'primary'	=> __('Default', 'bb-powerpack'),
							'secondary'	=> __('Hover', 'bb-powerpack'),
						)
					),
					'bg_color_gradient'      => array(
						'type'          => 'pp-color',
						'label'         => __('Background', 'bb-powerpack'),
						'show_reset'    => true,
						'default'       => array(
							'primary'	=> 'dddddd',
							'secondary'	=> 'b5b5b5',
						),
						'options'		=> array(
							'primary'	=> __('Primary', 'bb-powerpack'),
							'secondary'	=> __('Secondary', 'bb-powerpack'),
						)
					),
					'gradient_hover'	=> array(
						'type'			=> 'select',
						'label'			=> __('Hover Effect', 'bb-powerpack'),
						'default'		=> 'reverse',
						'options'		=> array(
							'reverse'	=> __('Reverse', 'bb-powerpack'),
							'primary'	=> __('Fill Primary', 'bb-powerpack'),
							'secondary'	=> __('Fill Secondary', 'bb-powerpack'),
						)
					),
					'bg_color_transparent'      => array(
						'type'          => 'color',
						'label'         => __('Background Hover', 'bb-powerpack'),
						'show_reset'    => true,
						'default'       => 'dddddd',
					),
					'text_color'    => array(
						'type'          => 'pp-color',
						'label'         => __('Text', 'bb-powerpack'),
						'show_reset'    => true,
						'default'       => array(
							'primary'	=> '000000',
							'secondary'	=> 'dddddd'
						),
						'options'		=> array(
							'primary'	=> __('Default', 'bb-powerpack'),
							'secondary'	=> __('Hover', 'bb-powerpack'),
						)
					),
				)
			),
			'formatting'    => array(
				'title'         => __('Structure', 'bb-powerpack'),
				'fields'        => array(
					'width'         => array(
						'type'          => 'pp-switch',
						'label'         => __('Width', 'bb-powerpack'),
						'default'       => 'auto',
						'options'       => array(
							'auto'          => _x( 'Auto', 'Width.', 'bb-powerpack' ),
							'full'          => __('Full Width', 'bb-powerpack'),
							'custom'        => __('Custom', 'bb-powerpack')
						),
						'toggle'        => array(
							'auto'          => array(
								'fields'        => array('align')
							),
							'full'          => array(),
							'custom'        => array(
								'fields'        => array('align', 'custom_width')
							)
						)
					),
					'custom_width'  => array(
						'type'          => 'text',
						'label'         => __('Custom Width', 'bb-powerpack'),
						'default'       => '200',
						'maxlength'     => '3',
						'size'          => '5',
						'description'   => 'px',
						'preview'		=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-button-wrap a.pp-button',
							'property'	=> 'width',
							'unit'		=> 'px'
						),
					),
					'align'         => array(
						'type'          => 'pp-switch',
						'label'         => __('Button Alignment', 'bb-powerpack'),
						'default'       => 'left',
						'options'       => array(
							'left'          => __('Left', 'bb-powerpack'),
							'center'        => __('Center', 'bb-powerpack'),
							'right'         => __('Right', 'bb-powerpack')
						)
					),
					'border_type'	=> array(
						'type'		=> 'pp-switch',
						'label'		=> __('Border Style', 'bb-powerpack'),
						'default'	=> 'none',
						'options'	=> array(
							'none'	=> __('None', 'bb-powerpack'),
							'solid'	=> __('Solid', 'bb-powerpack'),
							'dashed'	=> __('Dashed', 'bb-powerpack'),
							'dotted'	=> __('Dotted', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'dashed'	=> array(
								'fields'	=> array('border_size', 'border_color'),
							),
							'dotted'	=> array(
								'fields'	=> array('border_size', 'border_color'),
							),
							'solid'	=> array(
								'fields'	=> array('border_size', 'border_color'),
							),
						),
					),
					'border_size'   => array(
						'type'          => 'text',
						'label'         => __('Border Width', 'bb-powerpack'),
						'default'       => '2',
						'description'   => 'px',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0',
						'preview'		=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-button-wrap a.pp-button',
							'property'	=> 'border-width',
							'unit'		=> 'px'
						),
					),
					'border_color'   => array(
						'type'          => 'pp-color',
						'label'         => __('Border Colors', 'bb-powerpack'),
						'show_reset'	=> true,
						'default'       => array(
							'primary'	=> '333333',
							'secondary'	=> 'dddddd',
						),
						'options'		=> array(
							'primary'	=> __('Default', 'bb-powerpack'),
							'secondary'	=> __('Hover', 'bb-powerpack'),
						),
					),
					'padding'       => array(
						'type'          => 'pp-multitext',
						'label'         => __('Padding', 'bb-powerpack'),
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
						'default'       => array(
							'top'		=> 5,
							'bottom'	=> 5,
							'left'		=> 10,
							'right'		=> 10,
						),
						'options'		=> array(
							'top'		=> array(
								'placeholder'	=> __('Top', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-up',
								'maxlength'		=> '3',
								'tooltip'		=> __('Top', 'bb-powerpack'),
								'preview'		=> array(
									'type'		=> 'css',
									'selector'	=> '.pp-button-wrap a.pp-button',
									'property'	=> 'padding-top',
									'unit'		=> 'px'
								),
							),
							'bottom'		=> array(
								'placeholder'	=> __('Bottom', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-down',
								'maxlength'		=> '3',
								'tooltip'		=> __('Bottom', 'bb-powerpack'),
								'preview'		=> array(
									'type'		=> 'css',
									'selector'	=> '.pp-button-wrap a.pp-button',
									'property'	=> 'padding-bottom',
									'unit'		=> 'px'
								),
							),
							'left'		=> array(
								'placeholder'	=> __('Left', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-left',
								'maxlength'		=> '3',
								'tooltip'		=> __('Left', 'bb-powerpack'),
								'preview'		=> array(
									'type'		=> 'css',
									'selector'	=> '.pp-button-wrap a.pp-button',
									'property'	=> 'padding-left',
									'unit'		=> 'px'
								),
							),
							'right'		=> array(
								'placeholder'	=> __('Right', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-right',
								'maxlength'		=> '3',
								'tooltip'		=> __('Right', 'bb-powerpack'),
								'preview'		=> array(
									'type'		=> 'css',
									'selector'	=> '.pp-button-wrap a.pp-button',
									'property'	=> 'padding-right',
									'unit'		=> 'px'
								),
							),
						)
					),
					'border_radius' => array(
						'type'          => 'text',
						'label'         => __('Round Corners', 'bb-powerpack'),
						'default'       => '0',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
						'preview'		=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-button-wrap a.pp-button',
							'property'	=> 'border-radius',
							'unit'		=> 'px'
						),
					),
					'button_shadow'     => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Enable Shadow', 'bb-powerpack'),
                        'default'           => 'no',
                        'options'           => array(
                            'yes'               => __('Yes', 'bb-powerpack'),
                            'no'               => __('No', 'bb-powerpack')
                        ),
                        'toggle'            => array(
                            'yes'               => array(
                                'sections'         	=> array('button_shadow')
                            )
                        )
                    ),
				)
			),
			'button_shadow'		=> array(
				'title'				=> __('Box Shadow'),
				'fields'			=> array(
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
					'box_shadow_color'		=> array(
						'type'					=> 'color',
						'label'					=> __('Color', 'bb-powerpack'),
						'default'				=> '000000'
					),
					'box_shadow_opacity'	=> array(
						'type'					=> 'text',
						'label'					=> __('Opacity', 'bb-powerpack'),
						'default'				=> 0.3,
						'size'					=> 4,
						'description'			=> __('between 0 to 1', 'bb-powerpack')
					)
				)
			),
			'responsive'	=> array(
				'title'			=> __('Responsive', 'bb-powerpack'),
				'fields'		=> array(
					'responsive_bp' => array(
					    'type'          => 'text',
					    'label'         => __('Breakpoint', 'bb-powerpack'),
						'description'	=> 'px',
					    'default'       => 768,
						'size'			=> 4,
						'preview'		=> array(
							'type'			=> 'none'
						)
					),
					'responsive_align' => array(
					    'type'          => 'pp-switch',
					    'label'         => __('Button Alignment', 'bb-powerpack'),
					    'default'       => 'center',
					    'options'       => array(
					        'left'          => __('Left', 'bb-powerpack'),
					        'center'        => __('Center', 'bb-powerpack'),
					        'right'         => __('Right', 'bb-powerpack')
					    ),
						'preview'		=> array(
							'type'			=> 'none'
						)
					),
				)
			)
		)
	),
	'typography'	=> array(
		'title'		=> __('Typography', 'bb-powerpack'),
		'sections'	=> array(
			'text_fonts'	=> array(
				'title'		=> '',
				'fields'	=> array(
					'font' => array(
                        'type'  => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
						'preview'		=> array(
							'type'		=> 'font',
							'selector'	=> '.pp-button-wrap a.pp-button',
						),
                    ),
					'font_size'     => array(
						'type'          => 'pp-multitext',
						'label'         => __('Font Size', 'bb-powerpack'),
						'default'       => array(
							'desktop'	=> 18,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options'		=> array(
							'desktop'	=> array(
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'maxlength'		=> 3,
								'icon'			=> 'fa-desktop',
								'tooltip'		=> __('Desktop', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-button-wrap a.pp-button span',
									'property'	=> 'font-size',
									'unit'		=> 'px'
								),
							),
							'tablet'	=> array(
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'maxlength'		=> 3,
								'icon'			=> 'fa-tablet',
								'tooltip'		=> __('Tablet', 'bb-powerpack'),
							),
							'mobile'	=> array(
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'maxlength'		=> 3,
								'icon'			=> 'fa-mobile',
								'tooltip'		=> __('Mobile', 'bb-powerpack'),
							),
						),
					),
					'line_height'     => array(
						'type'          => 'pp-multitext',
						'label'         => __('Line Height', 'bb-powerpack'),
						'default'       => array(
							'desktop'	=> 1.6,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options'		=> array(
							'desktop'	=> array(
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'maxlength'		=> 3,
								'icon'			=> 'fa-desktop',
								'tooltip'		=> __('Desktop', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-button-wrap a.pp-button',
									'property'	=> 'line-height',
								),
							),
							'tablet'	=> array(
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'maxlength'		=> 3,
								'icon'			=> 'fa-tablet',
								'tooltip'		=> __('Tablet', 'bb-powerpack'),
							),
							'mobile'	=> array(
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'maxlength'		=> 3,
								'icon'			=> 'fa-mobile',
								'tooltip'		=> __('Mobile', 'bb-powerpack'),
							),
						),
					),
					'letter_spacing'     => array(
                        'type'                      => 'text',
                        'label'                     => __('Letter Spacing', 'bb-powerpack'),
                        'class'                     => 'bb-box-input input-small',
                        'default'                   => 0,
                        'description'               => 'px',
						'size'						=> 5,
                        'preview'                   => array(
                            'type'                      => 'css',
							'selector'                  => '.pp-button-wrap a.pp-button .pp-button-text',
							'property'                  => 'letter-spacing',
							'unit'                      => 'px'
                        )
                    )
				),
			),
		),
	),
));
