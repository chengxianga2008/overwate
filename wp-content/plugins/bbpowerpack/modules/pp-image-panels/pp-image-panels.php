<?php

/**
 * @class PPImagePanelsModule
 */
class PPImagePanelsModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Image Panels', 'bb-powerpack'),
            'description'   => __('Create beautiful images panels.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-image-panels/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-image-panels/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh'   => true
        ));
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
FLBuilder::register_module('PPImagePanelsModule', array(
    'content'      => array( // Tab
		'title'         => __('Panel', 'bb-powerpack'), // Tab title
		'sections'      => array( // Tab Sections
            'separator'      => array(
                'title'     => '',
                'fields'    => array(
                    'image_panels'  => array(
                        'type'  => 'form',
                        'label' => __('Panel', 'bb-powerpack'),
                        'form'  => 'pp_image_panels_form',
                        'preview_text'  => 'title',
                        'multiple'  => true
                    ),
                ),
            ),
		)
	),
    'style'     => array(
        'title' => __('Style', 'bb-powerpack'),
        'sections'  => array(
            'panel_style'   => array(
                'title'     => __('Panel', 'bb-powerpack'),
                'fields'    => array(
                    'panel_height'  => array(
                        'type'      => 'text',
                        'label'     => __('Height', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default' => 400,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-image-panels-wrap .pp-panel-item',
                            'property'  => 'height',
                            'unit'      => 'px'
                        )
                    ),
                    'show_title'        => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Show Title', 'bb-powerpack'),
                        'default'           => 'yes',
                        'options'           => array(
                            'yes'               => __('Yes', 'bb-powerpack'),
                            'no'                => __('No', 'bb-powerpack')
                        ),
                        'toggle'            => array(
                            'yes'               => array(
                                'sections'          => array('typography')
                            )
                        )
                    ),
                ),
            ),
            'typography'    => array(
                'title'         => __('Title', 'bb-powerpack'),
                'fields'        => array(
                    'title_font'    => array(
                        'type'  => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
							'type'            => 'font',
							'selector'        => '.pp-image-panels-wrap .pp-panel-item .pp-panel-title h3'
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
                                'preview'       => array(
                                    'type'      => 'css',
                                    'selector'  => '.pp-image-panels-wrap .pp-panel-item .pp-panel-title h3',
                                    'property'  => 'font-size',
                                    'unit'      => 'px'
                                )
                            ),
                            'title_font_size_tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack'),

                            ),
                            'title_font_size_mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack'),

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
                                'preview'       => array(
                                    'type'      => 'css',
                                    'selector'  => '.pp-image-panels-wrap .pp-panel-item .pp-panel-title h3',
                                    'property'  => 'line-height',
                                )
                            ),
                            'title_line_height_tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack'),

                            ),
                            'title_line_height_mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack'),

                            ),
                        ),
					),
                    'title_padding' => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'   => array(
                            'title_top_padding' => 10,
                            'title_bottom_padding' => 10,
                            'title_left_padding' => 10,
                            'title_right_padding' => 10,
                        ),
                        'options'   => array(
                            'title_top_padding'     => array(
                                'placeholder'       => __('Top', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-up',
                                'maxlength'         => 3,
                                'tooltip'           => __('Top', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-image-panels-wrap .pp-panel-item .pp-panel-title h3',
                                    'property'      => 'padding-top',
                                    'unit'          => 'px'
                                ),
                            ),
                            'title_bottom_padding'     => array(
                                'placeholder'       => __('Bottom', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-down',
                                'maxlength'         => 3,
                                'tooltip'           => __('Bottom', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-image-panels-wrap .pp-panel-item .pp-panel-title h3',
                                    'property'      => 'padding-bottom',
                                    'unit'          => 'px'
                                ),
                            ),
                            'title_left_padding'     => array(
                                'placeholder'       => __('Left', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-left',
                                'maxlength'         => 3,
                                'tooltip'           => __('Left', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-image-panels-wrap .pp-panel-item .pp-panel-title h3',
                                    'property'      => 'padding-left',
                                    'unit'          => 'px'
                                ),
                            ),
                            'title_right_padding'     => array(
                                'placeholder'       => __('Right', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-right',
                                'maxlength'         => 3,
                                'tooltip'           => __('Right', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-image-panels-wrap .pp-panel-item .pp-panel-title h3',
                                    'property'      => 'padding-right',
                                    'unit'          => 'px'
                                ),
                            ),
                        ),
                    ),
                )
            ),
        ),
    ),
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('pp_image_panels_form', array(
	'title' => __('Add Panel', 'bb-powerpack'),
	'tabs'  => array(
		'general'      => array( // Tab
			'title'         => __('Panel', 'bb-powerpack'), // Tab title
			'sections'      => array( // Tab Sections
                'content'          => array(
                    'title'      => '',
                    'fields'     => array(
                        'title'     => array(
                            'type'          => 'text',
                            'label'         => __('Title', 'bb-powerpack'),
                            'connections'   => array( 'string', 'html', 'url' ),
                        ),
                        'photo'     => array(
                            'type'          => 'photo',
                            'label'         => __('Image', 'bb-powerpack'),
                            'connections'   => array( 'photo' ),
                        ),
                        'position'  => array(
                            'type'      => 'pp-switch',
                            'label'     => __('Image Position', 'bb-powerpack'),
                            'default'   => 'center',
                            'options'   => array(
                                'center'    => __('Center', 'bb-powerpack'),
                                'custom'    => __('Custom', 'bb-powerpack')
                            ),
                            'toggle'    => array(
                                'custom'    => array(
                                    'fields'    => array('custom_position')
                                )
                            )
                        ),
                        'custom_position'   => array(
                            'type'              => 'text',
                            'label'             => __('Set Position', 'bb-powerpack'),
                            'default'           => 50,
                            'description'       => '%',
                            'maxlength'         => 3,
                            'placeholder'       => '',
                            'class'             => '',
                            'size'              => 5,
                            'preview'           => array(
                                'type'              => 'css',
                                'selector'          => '.pp-image-panels-wrap .pp-panel-item',
                                'property'          => 'background-position',
                                'unit'              => '%'
                            )
                        ),
                        'link_type'     => array(
                            'type'          => 'pp-switch',
                            'label'         => __('Link Type', 'bb-powerpack'),
                            'default'       => 'none',
                            'options'       => array(
                                'none'          => __('None', 'bb-powerpack'),
                                'title'         => __('Title', 'bb-powerpack'),
                                'panel'         => __('Panel', 'bb-powerpack'),
                            ),
                            'toggle'    => array(
                                'title' => array(
                                    'fields'    => array('link', 'link_target'),
                                ),
                                'panel' => array(
                                    'fields'    => array('link', 'link_target'),
                                ),
                            ),
                        ),
                        'link'  => array(
                            'type'      => 'link',
                            'label'     => __('Link', 'bb-powerpack'),
                            'connections'   => array( 'url' ),
                        ),
                        'link_target'   => array(
                            'type'      => 'pp-switch',
                            'label'     => __('Link Target', 'bb-powerpack'),
                            'default'   => '_self',
                            'options'   => array(
                                '_self' => __('Same Window', 'bb-powerpack'),
                                '_blank' => __('New Window', 'bb-powerpack'),
                            ),
                        ),
                    ),
                ),
                'style'     => array(
                    'title' => __('Style', 'bb-powerpack'),
                    'fields'    => array(
                        'title_colors'   => array(
                            'type'      => 'pp-color',
                            'label'     => __('Colors', 'bb-powerpack'),
                            'show_reset'    => true,
                            'default'   => array(
                                'primary'   => '000000',
                                'secondary' => 'dddddd'
                            ),
                            'options'   => array(
                                'primary'   => __('Color', 'bb-powerpack'),
                                'secondary'   => __('Background', 'bb-powerpack'),
                            ),
                        ),
                        'title_opacity' => array(
                            'type'      => 'text',
                            'label'     => __('Opacity', 'bb-powerpack'),
                            'description'   => __('Between 0 & 1', 'bb-powerpack'),
                            'default'   => '0.5',
                            'size'      => 5,
                            'maxlength' => 3
                        ),
                    ),
                ),
			)
		),
	)
));
