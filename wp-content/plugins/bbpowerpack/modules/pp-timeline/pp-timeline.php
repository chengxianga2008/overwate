<?php

/**
 * @class PPTimelineModule
 */
class PPTimelineModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Timeline', 'bb-powerpack'),
            'description'   => __('Addon to display content in timeline format.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-timeline/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-timeline/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh'   => true
        ));

        /**
         * Use these methods to enqueue css and js already
         * registered or to register and enqueue your own.
         */
        // Already registered
		$this->add_css('font-awesome');
    }

    /**
     * Use this method to work with settings data before
     * it is saved. You must return the settings object.
     *
     * @method update
     * @param $settings {object}
     */
    public function update($settings)
    {
        return $settings;
    }

    /**
     * This method will be called by the builder
     * right before the module is deleted.
     *
     * @method delete
     */
    public function delete()
    {

    }

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPTimelineModule', array(
	'general'      => array( // Tab
		'title'         => __('Content', 'bb-powerpack'), // Tab title
		'sections'      => array( // Tab Sections
            'general'      => array(
                'title'     => '',
                'fields'    => array(
                    'timeline'  => array(
                        'type'  => 'form',
                        'label' => __('Item', 'bb-powerpack'),
                        'form'  => 'pp_timeline_form',
                        'preview_text'  => 'title',
                        'multiple'      => true
                    ),
                ),
            ),
		)
	),
    'styles'    => array(
        'title'     => __('Connector', 'bb-powerpack'),
        'sections'  => array(
            'general_setting'   => array(
                'title'     => __('Connector Styling', 'bb-powerpack'),
                'fields'    => array(
                    'timeline_line_style'    => array(
                        'type'      => 'pp-switch',
                        'label'     => __('Connector Type', 'bb-powerpack'),
                        'default'   => 'solid',
                        'options'   => array(
                            'solid' => __('Solid', 'bb-powerpack'),
                            'dashed' => __('Dashed', 'bb-powerpack'),
                            'dotted' => __('Dotted', 'bb-powerpack'),
                        ),
                    ),
                    'timeline_line_width'   => array(
                        'type'      => 'text',
                        'label'     => __('Width', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 2,
                        'default'   => 1,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-timeline-content-wrapper:before',
                            'property'  => 'border-right-width',
                            'unit'      => 'px'
                        ),
                    ),
                    'timeline_line_color'   => array(
                        'type'      => 'color',
                        'label'     => __('Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'default'   => '000000',
                        'preview'   => array(
                            'type'  => 'css',
                            'rules' => array(
                                array(
                                    'selector'  => '.pp-timeline-content-wrapper:before',
                                    'property'  => 'border-right-color',
                                ),
                                array(
                                    'selector'  => '.pp-timeline-content-wrapper:after',
                                    'property'  => 'border-color',
                                ),
                            )
                        ),
                    ),
                ),
            ),
        ),
    ),
    'box'       => array(
        'title' => __('Box', 'bb-powerpack'),
        'sections'  => array(
            'title' => array(
                'title' => __('Title', 'bb-powerpack'),
                'fields'    => array(
                    'title_padding'     => array(
                        'type' => 'pp-multitext',
                        'label' => __('Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'   => array(
                            'top'   => 20,
                            'bottom'   => 20,
                            'left'   => 20,
                            'right'   => 20,
                        ),
                        'options'   => array(
                            'top'   => array(
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'icon'          => 'fa-long-arrow-up',
                                'maxlength'     => 3,
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'preview'   => array(
                                    'type'  => 'css',
                                    'selector'  => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-title',
                                    'property'  => 'padding-top',
                                    'unit'      => 'px'
                                ),
                            ),
                            'bottom'   => array(
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'icon'          => 'fa-long-arrow-down',
                                'maxlength'     => 3,
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'preview'   => array(
                                    'type'  => 'css',
                                    'selector'  => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-title',
                                    'property'  => 'padding-bottom',
                                    'unit'      => 'px'
                                ),
                            ),
                            'left'   => array(
                                'placeholder'   => __('Left', 'bb-powerpack'),
                                'icon'          => 'fa-long-arrow-left',
                                'maxlength'     => 3,
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'preview'   => array(
                                    'type'  => 'css',
                                    'selector'  => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-title',
                                    'property'  => 'padding-left',
                                    'unit'      => 'px'
                                ),
                            ),
                            'right'   => array(
                                'placeholder'   => __('Right', 'bb-powerpack'),
                                'icon'          => 'fa-long-arrow-right',
                                'maxlength'     => 3,
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'preview'   => array(
                                    'type'  => 'css',
                                    'selector'  => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-title',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                ),
                            ),
                        )
                    ),
                ),
            ),
            'content' => array(
                'title' => __('Content', 'bb-powerpack'),
                'fields'    => array(
                    'content_padding'   => array(
                        'type' => 'pp-multitext',
                        'label' => __('Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'   => array(
                            'top'   => 20,
                            'bottom'   => 20,
                            'left'   => 20,
                            'right'   => 20,
                        ),
                        'options'   => array(
                            'top'   => array(
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'icon'          => 'fa-long-arrow-up',
                                'maxlength'     => 3,
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'preview'   => array(
                                    'type'  => 'css',
                                    'selector'  => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-text-wrapper',
                                    'property'  => 'padding-top',
                                    'unit'      => 'px'
                                ),
                            ),
                            'bottom'   => array(
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'icon'          => 'fa-long-arrow-down',
                                'maxlength'     => 3,
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'preview'   => array(
                                    'type'  => 'css',
                                    'selector'  => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-text-wrapper',
                                    'property'  => 'padding-bottom',
                                    'unit'      => 'px'
                                ),
                            ),
                            'left'   => array(
                                'placeholder'   => __('Left', 'bb-powerpack'),
                                'icon'          => 'fa-long-arrow-left',
                                'maxlength'     => 3,
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'preview'   => array(
                                    'type'  => 'css',
                                    'selector'  => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-text-wrapper',
                                    'property'  => 'padding-left',
                                    'unit'      => 'px'
                                ),
                            ),
                            'right'   => array(
                                'placeholder'   => __('Right', 'bb-powerpack'),
                                'icon'          => 'fa-long-arrow-right',
                                'maxlength'     => 3,
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'preview'   => array(
                                    'type'  => 'css',
                                    'selector'  => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-text-wrapper',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                ),
                            ),
                        )
                    ),
                ),
            ),
            'icon'  => array(
                'title' => __('Icon', 'bb-powerpack'),
                'fields'    => array(
                    'icon_size' => array(
                        'type'  => 'text',
                        'label' => __('Size', 'bb-powerpack'),
                        'size'  => 5,
                        'maxlength' => 3,
                        'default'   => 20,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-timeline-icon .pp-icon',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        ),
                    ),
                    'icon_padding'  => array(
                        'type'      => 'text',
                        'label'     => __('Padding', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 15,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-timeline-icon',
                            'property'  => 'padding',
                            'unit'      => 'px'
                        ),
                    ),
                ),
            ),
        ),
    ),
    'typography'    => array(
        'title'     => __('Typography', 'bb-powerpack'),
        'sections'  => array(
            'title_typography'    => array(
                'title'     => __('Title', 'bb-powerpack'),
                'fields'  => array(
                    'title_font' => array(
                        'type'  => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
							'type'            => 'font',
							'selector'        => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-title-wrapper .pp-timeline-title'
						)
                    ),
                    'title_font_size'    => array(
						'type'          => 'pp-multitext',
						'label'         => __('Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'title_font_size_desktop'   => 24,
                            'title_font_size_tablet'   => '',
                            'title_font_size_mobile'   => '',
                        ),
                        'options'       => array(
                            'title_font_size_desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-title-wrapper .pp-timeline-title',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'title_font_size_tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 2,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'title_font_size_mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 2,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
					),
                    'title_line_height'    => array(
						'type'          => 'pp-multitext',
						'label'         => __('Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'title_line_height_desktop'   => 1.6,
                            'title_line_height_tablet'   => '',
                            'title_line_height_mobile'   => '',
                        ),
                        'options'       => array(
                            'title_line_height_desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-title',
                                    'property'      => 'line-height',
                                ),
                            ),
                            'title_line_height_tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'title_line_height_mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
					),
                ),
            ),
            'text_typography'   => array(
                'title'     => __('Text', 'bb-powerpack'),
                'fields'    => array(
                    'text_font' => array(
                        'type'  => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
							'type'            => 'font',
							'selector'        => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-text p'
						)
                    ),
                    'text_font_size'    => array(
						'type'          => 'pp-multitext',
						'label'         => __('Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'text_font_size_desktop'   => 18,
                            'text_font_size_tablet'   => '',
                            'text_font_size_mobile'   => '',
                        ),
                        'options'       => array(
                            'text_font_size_desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-text p',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'text_font_size_tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 2,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'text_font_size_mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 2,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
					),
                    'text_line_height'    => array(
						'type'          => 'pp-multitext',
						'label'         => __('Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'text_line_height_desktop'   => 1.6,
                            'text_line_height_tablet'   => '',
                            'text_line_height_mobile'   => '',
                        ),
                        'options'       => array(
                            'text_line_height_desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content .pp-timeline-text p',
                                    'property'      => 'line-height',
                                ),
                            ),
                            'text_line_height_tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'text_line_height_mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
					),
                ),
            ),
            'button_typography' => array(
                'title'     => __('Button', 'bb-powerpack'),
                'fields'    => array(
                    'button_font' => array(
                        'type'  => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
							'type'            => 'font',
							'selector'        => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content a'
						)
                    ),
                    'button_font_size'    => array(
						'type'          => 'text',
                        'size'          => 5,
                        'maxlength'     => 2,
                        'default'       => 16,
						'label'         => __('Font Size', 'bb-powerpack'),
						'description'   => 'px',
                        'preview'         => array(
							'type'            => 'css',
							'selector'        => '.pp-timeline-content-wrapper .pp-timeline-item .pp-timeline-content a',
                            'property'      => 'font-size',
                            'unit'          => 'px'
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
FLBuilder::register_settings_form('pp_timeline_form', array(
	'title' => __('Add Item', 'bb-powerpack'),
	'tabs'  => array(
		'general'      => array( // Tab
			'title'         => __('General', 'bb-powerpack'), // Tab title
			'sections'      => array( // Tab Sections
                'title'          => array(
                    'title'      => __('Title', 'bb-powerpack'),
                    'fields'     => array(
                        'title'     => array(
                            'type'          => 'text',
                            'label'         => '',
                            'connections'   => array( 'string', 'html' ),
                        ),
                    ),
                ),
                'content'       => array( // Section
					'title'         => __('Content', 'bb-powerpack'), // Section Title
					'fields'        => array( // Section Fields
						'content'          => array(
							'type'          => 'editor',
							'label'         => '',
                            'connections'   => array( 'string', 'html', 'url' ),
						)
					)
				),
                'button'    => array(
                    'title' => __('Button', 'bb-powerpack'),
                    'fields'    => array(
                        'button_text'   => array(
                            'type'  => 'text',
                            'label' => __('Text', 'bb-powerpack'),
                        ),
                        'button_link'   => array(
                            'type'  => 'link',
                            'label' => __('Link', 'bb-powerpack'),
                            'connections'   => array( 'url' ),
                        ),
                        'button_target' => array(
                            'type'  => 'pp-switch',
                            'label' => __('Link Target', 'bb-powerpack'),
                            'default'   => '_self',
                            'options'   => array(
                                '_self' => __('Same Window', 'bb-powerpack'),
                                '_blank' => __('New Window', 'bb-powerpack'),
                            ),
                        ),
                    ),
                ),
			)
		),
        'icon_tab'  => array(
            'title' => __('Icon', 'bb-powerpack'),
            'sections'  => array(
                'timeline_icon'  => array(
                    'title'     => '',
                    'fields'    => array(
                        'timeline_icon'     => array(
                            'type'  => 'icon',
                            'label' => __('Icon', 'bb-powerpack'),
                        ),
                    ),
                ),
                'icon_styling'  => array(
                    'title' => '',
                    'fields'    => array(
                        'icon_color'    => array(
                            'type'  => 'pp-color',
                            'label' => __('Colors', 'bb-powerpack'),
                            'show_reset'    => true,
                            'default'       => array(
                                'primary'   => '000000',
                                'secondary' => 'ffffff'
                            ),
                            'options'   => array(
                                'primary'   => __('Icon', 'bb-powerpack'),
                                'secondary'   => __('Background', 'bb-powerpack'),
                            ),
                        ),
                        'icon_border_style'  => array(
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
                                'solid' => array(
                                    'fields'    => array('icon_border_color', 'icon_border_width'),
                                ),
                                'dashed' => array(
                                    'fields'    => array('icon_border_color', 'icon_border_width'),
                                ),
                                'dotted' => array(
                                    'fields'    => array('icon_border_color', 'icon_border_width'),
                                ),
                            ),
                        ),
                        'icon_border_width' => array(
                            'type'  => 'text',
                            'label' => __('Border Width', 'bb-powerpack'),
                            'size'  => 5,
                            'maxlength' => 3,
                            'default'   => 0,
                            'description'   => 'px',
                        ),
                        'icon_border_color' => array(
                            'type'      => 'color',
                            'label'     => __('Border Color', 'bb-powerpack'),
                            'show_reset'    => true,
                        ),
                        'icon_border_radius'    => array(
                            'type'      => 'text',
                            'label'     => __('Round Corners', 'bb-powerpack'),
                            'size'      => 5,
                            'maxlength' => 3,
                            'default'   => 0,
                            'description'   => 'px',
                        ),
                    )
                ),
            ),
        ),
        'box_tab'   => array(
            'title' => __('Title + Box', 'bb-powerpack'),
            'sections'  => array(
                'title_styling'   => array(
                    'title' => __('Title Styling', 'bb-powerpack'),
                    'fields'    => array(
                        'title_color'  => array(
                            'type'  => 'pp-color',
                            'label' => __('Colors', 'bb-powerpack'),
                            'show_reset'    => true,
                            'default'   => array(
                                'primary'   => '000000',
                                'secondary' => 'ffffff'
                            ),
                            'options'   => array(
                                'primary'   => __('Title', 'bb-powerpack'),
                                'secondary'   => __('Background', 'bb-powerpack'),
                            ),
                        ),
                    ),
                ),
                'text_styling'  => array(
                    'title'     => __('Content Styling', 'bb-powerpack'),
                    'fields'    => array(
                        'text_color'    => array(
                            'type'      => 'color',
                            'label'     => __('Text Color', 'bb-powerpack'),
                            'show_reset'    => true
                        ),
                    ),
                ),
                'box_styling'   => array(
                    'title' => __('Box Styling', 'bb-powerpack'),
                    'fields'    => array(
                        'timeline_box_background'   => array(
                            'type'  => 'color',
                            'label' => __('Background Color', 'bb-powerpack'),
                            'show_reset'    => true
                        ),
                        'timeline_box_border_type'   => array(
                            'type'  => 'pp-switch',
                            'label' => __('Border Style', 'bb-powerpack'),
                            'default'    => 'none',
                            'options'   => array(
                                'none'  => __('None', 'bb-powerpack'),
                                'solid'  => __('Solid', 'bb-powerpack'),
                                'dashed'  => __('Dashed', 'bb-powerpack'),
                                'dotted'  => __('Dotted', 'bb-powerpack'),
                            ),
                            'toggle'    => array(
                                'dashed' => array(
                                    'fields'    => array('timeline_box_border_color', 'timeline_box_border_width'),
                                ),
                                'dotted' => array(
                                    'fields'    => array('timeline_box_border_color', 'timeline_box_border_width'),
                                ),
                                'solid' => array(
                                    'fields'    => array('timeline_box_border_color', 'timeline_box_border_width'),
                                ),
                            ),
                        ),
                        'timeline_box_border_width' => array(
                            'type'  => 'text',
                            'label' => __('Border Width', 'bb-powerpack'),
                            'size'  => 5,
                            'maxlength' => 3,
                            'default'   => 0,
                            'description'   => 'px',
                        ),
                        'timeline_box_border_color' => array(
                            'type'  => 'color',
                            'label' => __('Border Color', 'bb-powerpack'),
                            'show_reset'    => true,
                        ),
                        'timeline_box_border_radius' => array(
                            'type'  => 'text',
                            'label' => __('Round Corners', 'bb-powerpack'),
                            'size'  => 5,
                            'maxlength' => 3,
                            'default'   => 0,
                            'description'   => 'px',
                        ),
                    ),
                ),
            ),
        ),
        'box_shadow_tab'    => array(
            'title'     => __('Box Shadow', 'bb-powerpack'),
            'sections'  => array(
                'timeline_box_shadow'  => array(
                    'title'     => '',
                    'fields'    => array(
                        'timeline_box_shadow'   => array(
                            'type'      => 'pp-switch',
                            'label'     => __('Display Box Shadow?', 'bb-powerpack'),
                            'default'   => 'no',
                            'options'   => array(
                                'yes'    => __('Yes', 'bb-powerpack'),
                                'no'    => __('No', 'bb-powerpack'),
                            ),
                            'toggle'    => array(
                                'yes'   => array(
                                    'fields'    => array('box_shadow_options', 'timeline_box_shadow_color', 'timeline_box_shadow_opacity'),
                                ),
                            ),
                        ),
                        'box_shadow_options'   => array(
                            'type'          => 'pp-multitext',
                            'label'         => __('Box Shadow', 'bb-powerpack'),
                            'default'       => array(
                                'box_shadow_h' => 0,
                                'box_shadow_v' => 0,
                                'box_shadow_blur' => 0,
                                'box_shadow_spread' => 10,
                            ),
                            'options'       => array(
                                'box_shadow_h'     => array(
                                    'placeholder'           => __('Horizontal', 'bb-powerpack'),
                                    'maxlength'             => 3,
                                    'icon'                  => 'fa-arrows-h',
                                    'tooltip'               => __('Horizontal', 'bb-powerpack')
                                ),
                                'box_shadow_v'     => array(
                                    'placeholder'           => __('Vertical', 'bb-powerpack'),
                                    'maxlength'             => 3,
                                    'icon'                  => 'fa-arrows-v',
                                    'tooltip'               => __('Vertical', 'bb-powerpack')
                                ),
                                'box_shadow_blur'     => array(
                                    'placeholder'           => __('Blur', 'bb-powerpack'),
                                    'maxlength'             => 3,
                                    'icon'                  => 'fa-circle-o',
                                    'tooltip'               => __('Blur', 'bb-powerpack')
                                ),
                                'box_shadow_spread'     => array(
                                    'placeholder'           => __('Spread', 'bb-powerpack'),
                                    'maxlength'             => 3,
                                    'icon'                  => 'fa-paint-brush',
                                    'tooltip'               => __('Spread', 'bb-powerpack')
                                ),
                            ),
                        ),
                        'timeline_box_shadow_color' => array(
                            'type'              => 'color',
                            'label'             => __('Color', 'bb-powerpack'),
                            'default'           => '000000',
                        ),
                        'timeline_box_shadow_opacity' => array(
                            'type'              => 'text',
                            'label'             => __('Opacity', 'bb-powerpack'),
                            'class'             => 'input-small',
                            'default'           => 0.5,
                        ),
                    ),
                ),
            ),
        ),
        'button_tab'    => array(
            'title'     => __('Button', 'bb-powerpack'),
            'sections'  => array(
                'button_styling'   => array(
                    'title' => '',
                    'fields'    => array(
                        'timeline_button_color'  => array(
                            'type'  => 'pp-color',
                            'label' => __('Color', 'bb-powerpack'),
                            'show_reset'    => true,
                            'default'   => array(
                                'primary'   => '333333',
                                'secondary'   => 'dddddd',
                            ),
                            'options'   => array(
                                'primary'   => __('Default', 'bb-powerpack'),
                                'secondary'   => __('Hover', 'bb-powerpack'),
                            ),
                        ),
                        'timeline_button_background'  => array(
                            'type'  => 'pp-color',
                            'label' => __('Background Color', 'bb-powerpack'),
                            'show_reset'    => true,
                            'default'   => array(
                                'primary'   => 'dddddd',
                                'secondary'   => '333333',
                            ),
                            'options'   => array(
                                'primary'   => __('Default', 'bb-powerpack'),
                                'secondary'   => __('Hover', 'bb-powerpack'),
                            ),
                        ),
                        'timeline_button_border_type'   => array(
                            'type'  => 'pp-switch',
                            'label' => __('Border Style', 'bb-powerpack'),
                            'default'    => 'none',
                            'options'   => array(
                                'none'  => __('None', 'bb-powerpack'),
                                'solid'  => __('Solid', 'bb-powerpack'),
                                'dashed'  => __('Dashed', 'bb-powerpack'),
                                'dotted'  => __('Dotted', 'bb-powerpack'),
                            ),
                            'toggle'    => array(
                                'solid' => array(
                                    'fields'    => array('timeline_button_border_color', 'timeline_button_border_width'),
                                ),
                                'dashed' => array(
                                    'fields'    => array('timeline_button_border_color', 'timeline_button_border_width'),
                                ),
                                'dotted' => array(
                                    'fields'    => array('timeline_button_border_color', 'timeline_button_border_width'),
                                ),
                            ),
                        ),
                        'timeline_button_border_width' => array(
                            'type'  => 'text',
                            'label' => __('Border Width', 'bb-powerpack'),
                            'size'  => 5,
                            'maxlength' => 3,
                            'default'   => 0,
                            'description'   => 'px'
                        ),
                        'timeline_button_border_color' => array(
                            'type'  => 'color',
                            'label' => __('Border Color', 'bb-powerpack'),
                            'show_reset'    => true
                        ),
                        'timeline_button_border_radius' => array(
                            'type'      => 'text',
                            'label'     => __('Round Corners', 'bb-powerpack'),
                            'size'      => 5,
                            'maxlength' => 3,
                            'default'   => 0,
                            'description'   => 'px'
                        ),
                        'button_padding'    => array(
                            'type'      => 'pp-multitext',
                            'label'     => __('Padding', 'bb-powerpack'),
                            'description'   => 'px',
                            'default'       => array(
                                'button_top_padding'   => 10,
                                'button_bottom_padding'   => 10,
                                'button_left_padding'   => 10,
                                'button_right_padding'   => 10,
                            ),
                            'options'   => array(
                                'button_top_padding'   => array(
                                    'placeholder'   => __('Top', 'bb-powerpack'),
                                    'maxlength'     => 3,
                                    'icon'              => 'fa-long-arrow-up',
                                    'tooltip'       => __('Top', 'bb-powerpack'),
                                ),
                                'button_bottom_padding'   => array(
                                    'placeholder'   => __('Bottom', 'bb-powerpack'),
                                    'maxlength'     => 3,
                                    'icon'              => 'fa-long-arrow-down',
                                    'tooltip'       => __('Bottom', 'bb-powerpack')
                                ),
                                'button_left_padding'   => array(
                                    'placeholder'   => __('Left', 'bb-powerpack'),
                                    'maxlength'     => 3,
                                    'icon'              => 'fa-long-arrow-left',
                                    'tooltip'       => __('Left', 'bb-powerpack')
                                ),
                                'button_right_padding'   => array(
                                    'placeholder'   => __('Right', 'bb-powerpack'),
                                    'maxlength'     => 3,
                                    'icon'              => 'fa-long-arrow-right',
                                    'tooltip'       => __('Right', 'bb-powerpack')
                                ),
                            )
                        ),
                    ),
                ),
            ),
        ),
	)
));
