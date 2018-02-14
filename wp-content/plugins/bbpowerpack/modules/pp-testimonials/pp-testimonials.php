<?php

/**
 * @class PPTestimonialsModule
 */
class PPTestimonialsModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Testimonials', 'bb-powerpack'),
            'description'   => __('Addon to display testimonials.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-testimonials/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-testimonials/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));

        /**
         * Use these methods to enqueue css and js already
         * registered or to register and enqueue your own.
         */
        // Already registered
        $this->add_css('jquery-bxslider');
		$this->add_css('font-awesome');
		$this->add_css('pp-testimonials-form', BB_POWERPACK_URL . 'modules/pp-testimonials/css/fields.css');
		$this->add_js('jquery-bxslider');
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPTestimonialsModule', array(
	'general'      => array( // Tab
		'title'         => __('General', 'bb-powerpack'), // Tab title
		'sections'      => array( // Tab Sections
			'heading'       => array( // Section
				'title'         => __('Heading', 'bb-powerpack'), // Section Title
				'fields'        => array( // Section Fields
					'heading'         => array(
						'type'          => 'text',
						'default'       => __( 'Testimonials', 'bb-powerpack' ),
						'label'         => __('Heading', 'bb-powerpack'),
                        'connections'   => array( 'string', 'html' ),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.pp-testimonials-heading'
						)
					),
				)
			),
			'slider'       => array( // Section
				'title'         => __('Settings', 'bb-powerpack'), // Section Title
				'fields'        => array( // Section Fields
                    'autoplay'         => array(
						'type'          => 'pp-switch',
						'label'         => __('Autoplay', 'bb-powerpack'),
						'default'       => '1',
                        'options'       => array(
							'1'             => __('Yes', 'bb-powerpack'),
                            '0'             => __('No', 'bb-powerpack')
						),
					),
                    'hover_pause'         => array(
						'type'          => 'pp-switch',
						'label'         => __('Pause on hover', 'bb-powerpack'),
						'default'       => '1',
                        'help'          => __('Pause when mouse hovers over slider'),
                        'options'       => array(
							'1'             => __('Yes', 'bb-powerpack'),
                            '0'             => __('No', 'bb-powerpack'),
						),
					),
                    'transition'    => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Mode', 'bb-powerpack'),
                        'default'       => 'horizontal',
                        'options'       => array(
                            'horizontal'    => _x( 'Horizontal', 'Transition type.', 'bb-powerpack' ),
                            'vertical'    => _x( 'Vertical', 'Transition type.', 'bb-powerpack' ),
                            'fade'          => __( 'Fade', 'bb-powerpack' )
                        ),
                    ),
                    'pause'         => array(
                        'type'          => 'text',
                        'label'         => __('Delay', 'bb-powerpack'),
                        'default'       => '4',
                        'maxlength'     => '4',
                        'size'          => '5',
                        'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'bb-powerpack' )
                    ),
					'speed'         => array(
						'type'          => 'text',
						'label'         => __('Transition Speed', 'bb-powerpack'),
						'default'       => '0.5',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'bb-powerpack' )
					),
                    'loop'         => array(
						'type'          => 'pp-switch',
						'label'         => __('Loop', 'bb-powerpack'),
						'default'       => '1',
                        'options'       => array(
							'1'             => __('Yes', 'bb-powerpack'),
                            '0'             => __('No', 'bb-powerpack'),
						),
					),
                    'adaptive_height'   => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Fixed Height', 'bb-powerpack'),
                        'default'           => 'yes',
                        'options'           => array(
                            'yes'               => __('Yes', 'bb-powerpack'),
                            'no'                => __('No', 'bb-powerpack')
                        ),
                        'help'              => __('Fix height to the tallest item.', 'bb-powerpack')
                    )
				)
			),
            'carousel_section'       => array( // Section
				'title'         => '',
				'fields'        => array( // Section Fields
                    'carousel'         => array(
						'type'          => 'pp-switch',
						'label'         => __('Carousel', 'bb-powerpack'),
						'default'       => '0',
                        'options'       => array(
							'1'             => __('Yes', 'bb-powerpack'),
                            '0'             => __('No', 'bb-powerpack')
						),
                        'toggle'        => array(
							'1'         => array(
								'fields'        => array('min_slides', 'move_slides', 'max_slides', 'slide_width', 'slide_margin')
							)
						)
					),
                    'min_slides'         => array(
						'type'          => 'text',
						'label'         => __('Minimum Slides', 'bb-powerpack'),
						'default'       => '1',
                        'size'          => '5',
                        'help'          => __('The minimum number of slides to be shown.', 'bb-powerpack'),
					),
                    'max_slides'         => array(
						'type'          => 'text',
						'label'         => __('Maximum Slides', 'bb-powerpack'),
						'default'       => '1',
                        'size'          => '5',
                        'help'          => __('The maximum number of slides to be shown.', 'bb-powerpack'),
					),
                    'move_slides'         => array(
						'type'          => 'text',
						'label'         => __('Move Slides', 'bb-powerpack'),
						'default'       => '1',
                        'size'          => '5',
                        'help'          => __('The number of slides to move on transition.', 'bb-powerpack'),
					),
                    'slide_width'         => array(
						'type'          => 'text',
						'label'         => __('Slides Width', 'bb-powerpack'),
						'default'       => '0',
                        'size'          => '5',
                        'description'   => 'px',
                        'help'          => __('The width of each slide. This setting is required for all horizontal carousels!', 'bb-powerpack'),
					),
                    'slide_margin'         => array(
						'type'          => 'text',
						'label'         => __('Slides Margin', 'bb-powerpack'),
						'default'       => '0',
                        'size'          => '5',
                        'description'   => 'px',
                        'help'          => __('Margin between each slide.', 'bb-powerpack'),
					),
				)
			),
			'arrow_nav'       => array( // Section
				'title'         => '',
				'fields'        => array( // Section Fields
					'arrows'       => array(
						'type'          => 'pp-switch',
						'label'         => __('Show Arrows', 'bb-powerpack'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Yes', 'bb-powerpack'),
                            '0'             => __('No', 'bb-powerpack')
						),
						'toggle'        => array(
							'1'         => array(
								'fields'        => array('arrow_color', 'arrow_alignment')
							)
						)
					),
					'arrow_color'       => array(
						'type'          => 'color',
						'label'         => __('Arrow Color', 'bb-powerpack'),
						'default'       => '999999',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.pp-testimonials-wrap .fa',
							'property'      => 'color'
						)
					),
					'arrow_alignment'       => array(
						'type'          => 'pp-switch',
						'label'         => __('Arrow Alignment', 'bb-powerpack'),
						'default'       => 'center',
                        'options'       => array(
							'left'             => __('Left', 'bb-powerpack'),
							'right'             => __('Right', 'bb-powerpack'),
							'center'             => __('Center', 'bb-powerpack')
						),
						'preview'       => array(
                            'type'          => 'css',
							'selector'      => '.pp-arrow-wrapper',
							'property'      => 'text-align'
						)
					),
				)
			),
			'dot_nav'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'dots'       => array(
						'type'          => 'pp-switch',
						'label'         => __('Show Dots', 'bb-powerpack'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Yes', 'bb-powerpack'),
                            '0'             => __('No', 'bb-powerpack'),
						),
						'toggle'        => array(
							'1'         => array(
								'fields'        => array('dot_color', 'active_dot_color')
							)
						)
					),
					'dot_color'       => array(
						'type'          => 'color',
						'label'         => __('Dot Color', 'bb-powerpack'),
						'default'       => '999999',
						'show_reset'    => true,
                        'preview'       => array(
							'type'          => 'css',
							'selector'      => '.pp-testimonials-wrap .bx-wrapper .bx-pager a',
							'property'      => 'background'
						)
					),
					'active_dot_color'       => array(
						'type'          => 'color',
						'label'         => __('Active Dot Color', 'bb-powerpack'),
						'default'       => '999999',
						'show_reset'    => true,
                        'preview'       => array(
							'type'          => 'css',
							'selector'      => '.pp-testimonials-wrap .bx-wrapper .bx-pager a.active',
							'property'      => 'background'
						)
					),
				)
			)
		)
	),
	'testimonials'      => array( // Tab
		'title'         => __('Testimonials', 'bb-powerpack'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'testimonials'     => array(
						'type'          => 'form',
						'label'         => __('Testimonial', 'bb-powerpack'),
						'form'          => 'pp_testimonials_form', // ID from registered form below
						'preview_text'  => 'title', // Name of a field to use for the preview text
						'multiple'      => true
					),
				)
			)
		)
	),
    'layouts'       => array(
        'title'     => __('Layout', 'bb-powerpack'),
        'sections'  => array(
            'layout'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'testimonial_layout'     => array(
						'type'          => 'pp-radio',
						'label'         => __('Layout', 'bb-powerpack'),
						'default'		=> 1,
                        'options'        => array(
                            '1'      => 'layout_1',
                            '2'      => 'layout_2',
                            '3'      => 'layout_3',
                            '4'      => 'layout_4',
                            '5'      => 'layout_5',
                        ),
					),
				)
			),
        ),
    ),
    'styles'      => array( // Tab
		'title'         => __('Style', 'bb-powerpack'), // Tab title
		'sections'      => array( // Tab Sections
            'box_borders'        => array(
                'title'     => __('Content Box', 'bb-powerpack'),
                'fields'        => array( // Section Fields
                    'box_border_width'    => array(
						'type'          => 'text',
                        'default'       => '0',
                        'maxlength'     => '2',
                        'size'          => '5',
						'label'         => __('Border Width', 'bb-powerpack'),
                        'description'   => 'px',
                        'preview'       => array(
                            'type'          => 'css',
                            'rules'     => array(
                                array(
                                    'selector'      => '.pp-testimonial.layout-1 .pp-content-wrapper',
                                    'property'      => 'border-width',
                                    'unit'          => 'px'
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-2 .pp-content-wrapper',
                                    'property'      => 'border-width',
                                    'unit'          => 'px'
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-3 .pp-content-wrapper',
                                    'property'      => 'border-width',
                                    'unit'          => 'px'
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-4 .layout-4-content',
                                    'property'      => 'border-width',
                                    'unit'          => 'px'
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-5 .pp-content-wrapper',
                                    'property'      => 'border-width',
                                    'unit'          => 'px'
                                ),
                            ),
                        )
					),
                    'box_border_style'      => array(
                        'type'      => 'select',
                        'label'     => __('Border Style', 'bb-powerpack'),
                        'default'   => 'none',
                        'options'   => array(
                            'none'  => __('None', 'bb-powerpack'),
                            'solid'  => __('Solid', 'bb-powerpack'),
                            'dotted'  => __('Dotted', 'bb-powerpack'),
                            'dashed'  => __('Dashed', 'bb-powerpack'),
                            'double'  => __('Double', 'bb-powerpack'),
                        ),
                    ),
                    'box_border_color'    => array(
						'type'          => 'color',
						'label'         => __('Border Color', 'bb-powerpack'),
						'show_reset'    => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'rules'     => array(
                                array(
                                    'selector'      => '.pp-testimonial.layout-1 .pp-content-wrapper',
                                    'property'      => 'border-color',
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-2 .pp-content-wrapper',
                                    'property'      => 'border-color',
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-3 .pp-content-wrapper',
                                    'property'      => 'border-color',
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-4 .layout-4-content',
                                    'property'      => 'border-color',
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-5 .pp-content-wrapper',
                                    'property'      => 'border-color',
                                ),
                            ),
                        )
					),
                    'box_border_radius'    => array(
						'type'          => 'text',
                        'default'       => '0',
                        'maxlength'     => '3',
                        'size'          => '5',
						'label'         => __('Round Corners', 'bb-powerpack'),
                        'description'   => 'px',
                        'preview'       => array(
                            'type'          => 'css',
                            'rules'     => array(
                                array(
                                    'selector'      => '.pp-testimonial.layout-1 .pp-content-wrapper',
                                    'property'      => 'border-radius',
                                    'unit'          => 'px'
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-2 .pp-content-wrapper',
                                    'property'      => 'border-radius',
                                    'unit'          => 'px'
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-3 .pp-content-wrapper',
                                    'property'      => 'border-radius',
                                    'unit'          => 'px'
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-4 .layout-4-content',
                                    'property'      => 'border-radius',
                                    'unit'          => 'px'
                                ),
                                array(
                                    'selector'      => '.pp-testimonial.layout-5 .pp-content-wrapper',
                                    'property'      => 'border-radius',
                                    'unit'          => 'px'
                                ),
                            ),
                        )
					),
                    'layout_4_content_bg'    => array(
                        'type'      => 'color',
                        'label'     => __('Background Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'rules'     => array(
                                array(
                                    'selector'      => '.pp-testimonials .layout-1 .pp-content-wrapper',
                                    'property'      => 'background-color',
                                ),
                                array(
                                    'selector'      => '.pp-testimonials .layout-2 .pp-content-wrapper',
                                    'property'      => 'background-color',
                                ),
                                array(
                                    'selector'      => '.pp-testimonials .layout-3 .pp-content-wrapper',
                                    'property'      => 'background-color',
                                ),
                                array(
                                    'selector'      => '.pp-testimonials .layout-4 .layout-4-content',
                                    'property'      => 'background-color',
                                ),
                                array(
                                    'selector'      => '.pp-testimonials .layout-5 .pp-content-wrapper',
                                    'property'      => 'background-color',
                                ),
                                array(
                                    'selector'      => '.pp-testimonials .pp-arrow-top',
                                    'property'      => 'border-bottom-color',
                                ),
                                array(
                                    'selector'      => '.pp-testimonials .pp-arrow-bottom',
                                    'property'      => 'border-top-color',
                                ),
                                array(
                                    'selector'      => '.pp-testimonials .pp-arrow-left',
                                    'property'      => 'border-right-color',
                                ),
                            ),
                        )
                    ),
                    'show_arrow'    => array(
                        'type'      => 'pp-switch',
                        'default'   => 'no',
                        'label'     => __('Show Content Indicator', 'bb-powerpack'),
                        'options'   => array(
                            'yes'    => __('Yes', 'bb-powerpack'),
                            'no'    => __('No', 'bb-powerpack'),
                        ),
                    ),
				),
            ),
            'borders'        => array(
                'title'     => __('Image Box', 'bb-powerpack'),
                'fields'        => array( // Section Fields
                    'image_size'    => array(
                        'type'          => 'text',
                        'label'         => __('Image Size', 'bb-powerpack'),
                        'size'          => 5,
                        'default'       => 100,
                        'description'   => 'px'
                    ),
                    'border_width'    => array(
						'type'          => 'text',
                        'default'       => '0',
                        'maxlength'     => '2',
                        'size'          => '5',
						'label'         => __('Border Width', 'bb-powerpack'),
                        'description'   => 'px',
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-testimonials-image img',
                            'property'      => 'border-width',
                            'unit'          => 'px'
                        )
					),
                    'image_border_style'      => array(
                        'type'      => 'select',
                        'label'     => __('Border Style', 'bb-powerpack'),
                        'default'   => 'none',
                        'options'   => array(
                            'none'  => __('None', 'bb-powerpack'),
                            'solid'  => __('Solid', 'bb-powerpack'),
                            'dotted'  => __('Dotted', 'bb-powerpack'),
                            'dashed'  => __('Dashed', 'bb-powerpack'),
                            'double'  => __('Double', 'bb-powerpack'),
                        ),
                    ),
                    'border_color'    => array(
						'type'          => 'color',
						'label'         => __('Border Color', 'bb-powerpack'),
						'show_reset'    => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-testimonials-image img',
                            'property'      => 'border-color',
                        )
					),
                    'border_radius'    => array(
						'type'          => 'text',
                        'default'       => '0',
                        'maxlength'     => '3',
                        'size'          => '5',
						'label'         => __('Round Corners', 'bb-powerpack'),
                        'description'   => 'px',
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-testimonials-image img',
                            'property'      => 'border-radius',
                            'unit'          => 'px'
                        )
					),
				)
            ),
		)
	),
    'typography'                => array(
        'title'                     => __('Typography', 'bb-powerpack'),
        'sections'                  => array(
            'heading_fonts'             => array(
                'title'                     => __('Heading', 'bb-powerpack'),
                'fields'                    => array( // Section Fields
                    'heading_alignment'         => array(
						'type'                      => 'pp-switch',
						'default'                   => 'left',
						'label'                     => __('Alignment', 'bb-powerpack'),
                        'options'                   => array(
                            'left'                      => __('Left', 'bb-powerpack'),
                            'right'                     => __('Right', 'bb-powerpack'),
                            'center'                    => __('Center', 'bb-powerpack'),
                        ),
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.pp-testimonials-heading',
                            'property'      => 'text-align'
						)
					),
                    'heading_font'          => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-testimonials-heading'
                        )
                    ),
                    'heading_font_size'    => array(
						'type'          => 'text',
                        'size'          => '5',
                        'maxlength'     => '2',
						'label'         => __('Font Size', 'bb-powerpack'),
						'description'   => 'px',
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-testimonials-heading',
                            'property'      => 'font-size',
                            'unit'          => 'px'
                        )
					),
                    'heading_color'    => array(
						'type'          => 'color',
						'label'         => __('Color', 'bb-powerpack'),
						'show_reset'    => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-testimonials-heading',
                            'property'      => 'color',
                        )
					),
                )
            ),
            'title_fonts'       => array(
                'title'             => __('Client Name', 'bb-powerpack'),
                'fields'            => array(
                    'title_font'          => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-testimonials-title'
                        )
                    ),
                    'title_font_size'    => array(
						'type'          => 'text',
                        'size'          => '5',
                        'maxlength'     => '2',
						'label'         => __('Font Size', 'bb-powerpack'),
						'description'   => 'px',
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-testimonials-title',
                            'property'      => 'font-size',
                            'unit'          => 'px'
                        )
					),
                    'title_color'    => array(
						'type'          => 'color',
						'label'         => __('Color', 'bb-powerpack'),
						'show_reset'    => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-testimonials-title',
                            'property'      => 'color',
                        )
					),
                    'title_margin'      => array(
                        'type'              => 'pp-multitext',
                        'label'             => __('Margin', 'bb-powerpack'),
                        'description'       => 'px',
                        'default'           => array(
                            'top'               => '',
                            'bottom'            => '',
                        ),
                        'options'           => array(
                            'top'               => array(
                                'placeholder'       => __('Top', 'bb-powerpack'),
                                'tooltip'           => __('Top', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-up',
                                'preview'           => array(
                                    'selector'          => '.pp-testimonials-title',
                                    'property'          => 'margin-top',
                                    'unit'              => 'px'
                                ),
                            ),
                            'bottom'            => array(
                                'placeholder'       => __('Bottom', 'bb-powerpack'),
                                'tooltip'           => __('Bottom', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-down',
                                'preview'           => array(
                                    'selector'          => '.pp-testimonials-title',
                                    'property'          => 'margin-bottom',
                                    'unit'              => 'px'
                                ),
                            )
                        )
                    ),
                )
            ),
            'subtitle_fonts'        => array(
                'title'                 => __('Client Profile', 'bb-powerpack'),
                'fields'                => array(
                    'subtitle_font'         => array(
                        'type'                  => 'font',
                        'label'                 => __('Font', 'bb-powerpack'),
                        'default'		        => array(
                            'family'		          => 'Default',
                            'weight'		          => 300
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-testimonials-subtitle'
                        )
                    ),
                    'subtitle_font_size'    => array(
						'type'          => 'text',
                        'size'          => '5',
                        'maxlength'     => '2',
						'label'         => __('Font Size', 'bb-powerpack'),
						'description'   => 'px',
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-testimonials-subtitle',
                            'property'      => 'font-size',
                            'unit'          => 'px'
                        )
					),
                    'subtitle_color'    => array(
						'type'          => 'color',
						'label'         => __('Color', 'bb-powerpack'),
						'show_reset'    => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-testimonials-subtitle',
                            'property'      => 'color',
                        )
					),
                    'subtitle_margin'   => array(
                        'type'              => 'pp-multitext',
                        'label'             => __('Margin', 'bb-powerpack'),
                        'description'       => 'px',
                        'default'           => array(
                            'top'               => '',
                            'bottom'            => '',
                        ),
                        'options'           => array(
                            'top'               => array(
                                'placeholder'       => __('Top', 'bb-powerpack'),
                                'tooltip'           => __('Top', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-up',
                                'preview'           => array(
                                    'selector'          => '.pp-testimonials-subtitle',
                                    'property'          => 'margin-top',
                                    'unit'              => 'px'
                                ),
                            ),
                            'bottom'            => array(
                                'placeholder'       => __('Bottom', 'bb-powerpack'),
                                'tooltip'           => __('Bottom', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-down',
                                'preview'           => array(
                                    'selector'          => '.pp-testimonials-subtitle',
                                    'property'          => 'margin-bottom',
                                    'unit'              => 'px'
                                ),
                            )
                        )
                    ),
                )
            ),
            'content_fonts'     => array(
                'title'             => __('Content', 'bb-powerpack'),
                'fields'            => array(
                    'text_font'          => array(
						'type'          => 'font',
						'default'		=> array(
							'family'		=> 'Default',
							'weight'		=> 300
						),
						'label'         => __('Font', 'bb-powerpack'),
						'preview'         => array(
							'type'            => 'font',
							'selector'        => '.pp-testimonials p'
						)
					),
                    'text_font_size'    => array(
						'type'          => 'text',
                        'size'          => '5',
                        'maxlength'     => '2',
						'label'         => __('Font Size', 'bb-powerpack'),
						'description'   => 'px',
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-testimonials-content',
                            'property'      => 'font-size',
                            'unit'          => 'px'
                        )
					),
                    'text_color'    => array(
						'type'          => 'color',
						'label'         => __('Color', 'bb-powerpack'),
						'show_reset'    => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-testimonials-content',
                            'property'      => 'color',
                        )
					),
                    'content_margin'      => array(
                        'type'              => 'pp-multitext',
                        'label'             => __('Margin', 'bb-powerpack'),
                        'description'       => 'px',
                        'default'           => array(
                            'top'               => '',
                            'bottom'            => '',
                        ),
                        'options'           => array(
                            'top'               => array(
                                'placeholder'       => __('Top', 'bb-powerpack'),
                                'tooltip'           => __('Top', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-up',
                                'preview'           => array(
                                    'selector'          => '.pp-testimonials-content',
                                    'property'          => 'margin-top',
                                    'unit'              => 'px'
                                ),
                            ),
                            'bottom'            => array(
                                'placeholder'       => __('Bottom', 'bb-powerpack'),
                                'tooltip'           => __('Bottom', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-down',
                                'preview'           => array(
                                    'selector'          => '.pp-testimonials-content',
                                    'property'          => 'margin-bottom',
                                    'unit'              => 'px'
                                ),
                            )
                        )
                    ),
                ),
            ),
        )
    )
));


/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('pp_testimonials_form', array(
	'title' => __('Add Testimonial', 'bb-powerpack'),
	'tabs'  => array(
		'general'      => array( // Tab
			'title'         => __('General', 'bb-powerpack'), // Tab title
			'sections'      => array( // Tab Sections
                'title'          => array(
                    'title'      => '',
                    'fields'     => array(
                        'title'     => array(
                            'type'          => 'text',
                            'label'         => __('Client Name', 'bb-powerpack'),
                            'connections'   => array( 'string', 'html', 'url' ),
                        ),
                        'subtitle'     => array(
                            'type'          => 'text',
                            'label'         => __('Client Profile', 'bb-powerpack'),
                            'connections'   => array( 'string', 'html', 'url' ),
                        ),
                        'photo'     => array(
                            'type'          => 'photo',
                            'label'         => __('Client Photo', 'bb-powerpack'),
                            'show_remove'   => true,
                            'connections'   => array( 'photo' ),
                        ),
                    ),
                ),
                'content'       => array( // Section
					'title'         => __('Content', 'bb-powerpack'), // Section Title
					'fields'        => array( // Section Fields
						'testimonial'          => array(
							'type'          => 'editor',
							'label'         => '',
                            'connections'   => array( 'string', 'html', 'url' ),
						)
					)
				),
			)
		)
	)
));
