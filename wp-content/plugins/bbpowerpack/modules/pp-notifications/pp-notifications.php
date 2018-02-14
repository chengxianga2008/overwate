<?php

/**
 * @class PPNotificationsModule
 */
class PPNotificationsModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Alert Box', 'bb-powerpack'),
            'description'   => __('Addon to display notifications.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-notifications/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-notifications/',
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
FLBuilder::register_module('PPNotificationsModule', array(
	'general'      => array( // Tab
		'title'         => __('General', 'bb-powerpack'), // Tab title
		'sections'      => array( // Tab Sections
            'notifications'      => array(
                'title'     => '',
                'fields'    => array(
                    'notification_icon' => array(
                        'type'      => 'icon',
                        'label'     => __('Icon', 'bb-powerpack'),
                    ),
                    'notification_content'  => array(
                        'type'  => 'textarea',
                        'label' => __('Content', 'bb-powerpack'),
                        'connections'   => array( 'string', 'html', 'url' ),
                        'preview'   => array(
                            'type'  => 'text',
                            'selector'  => '.pp-notification-content p'
                        ),
                    ),
                ),
            ),
		)
	),
    'styles'    => array(
        'title' => __('Style', 'bb-powerpack'),
        'sections'  => array(
            'box_styling'   => array(
                'title'     => __('Box Styling', 'bb-powerpack'),
                'fields'    => array(
                    'box_background'    => array(
                        'type'      => 'color',
                        'label'     => __('Background Color', 'bb-powerpack'),
                        'default'   => 'dddddd',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => 'div.pp-notification-wrapper',
                            'property'  => 'background'
                        ),
                    ),
                    'box_border_type'   => array(
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
                                'fields'    => array('box_border_color', 'box_border_width'),
                            ),
                            'dashed' => array(
                                'fields'    => array('box_border_color', 'box_border_width'),
                            ),
                            'dotted' => array(
                                'fields'    => array('box_border_color', 'box_border_width'),
                            ),
                        ),
                    ),
                    'box_border_width'  => array(
                        'type'      => 'text',
                        'label'     => __('Border Width', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 1,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-notification-wrapper',
                            'property'  => 'border-width',
                            'unit'  => 'px'
                        ),
                    ),
                    'box_border_color'  => array(
                        'type'  => 'color',
                        'label' => __('Border Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'default'   => '333333',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-notification-wrapper',
                            'property'  => 'border-color'
                        ),
                    ),
                    'box_padding'   => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Padding', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => array(
                            'box_top_padding'   => 10,
                            'box_bottom_padding'   => 10,
                            'box_left_padding'   => 10,
                            'box_right_padding'   => 10,
                        ),
                        'description'   => 'px',
                        'options'   => array(
                            'box_top_padding'       => array(
                                'placeholder'       => __('Top', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'icon'              => 'fa-long-arrow-up',
                                'tooltip'           => __('Top', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-notification-wrapper',
                                    'property'      => 'padding-top',
                                    'unit'          => 'px'
                                ),
                            ),
                            'box_bottom_padding'       => array(
                                'placeholder'       => __('Bottom', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'icon'              => 'fa-long-arrow-down',
                                'tooltip'           => __('Bottom', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-notification-wrapper',
                                    'property'      => 'padding-bottom',
                                    'unit'          => 'px'
                                ),
                            ),
                            'box_left_padding'       => array(
                                'placeholder'       => __('Left', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'icon'              => 'fa-long-arrow-left',
                                'tooltip'           => __('Left', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-notification-wrapper',
                                    'property'      => 'padding-left',
                                    'unit'          => 'px'
                                ),
                            ),
                            'box_right_padding'       => array(
                                'placeholder'       => __('Right', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'icon'              => 'fa-long-arrow-right',
                                'tooltip'           => __('Right', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-notification-wrapper',
                                    'property'      => 'padding-right',
                                    'unit'          => 'px'
                                ),
                            ),
                        ),
                    ),
                    'box_border_radius' => array(
                        'type'      => 'text',
                        'label'     => __('Round Corners', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 0,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-notification-wrapper',
                            'property'  => 'border-radius',
                            'unit'      => 'px'
                        ),
                    ),
                ),
            ),
            'icon_styling'  => array(
                'title' => __('Icon Styling', 'bb-powerpack'),
                'fields'    => array(
                    'icon_size'     => array(
                        'type'      => 'text',
                        'label'     => __('Size', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 16,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-notification-wrapper .pp-notification-inner .pp-notification-icon span.pp-icon',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        ),
                    ),
                    'icon_color'    => array(
                        'type'      => 'color',
                        'label'     => __('Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'default'   => '000000',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-notification-wrapper .pp-notification-inner .pp-notification-icon span.pp-icon',
                            'property'  => 'color'
                        ),
                    ),
                ),
            ),
        ),
    ),
    'typography'        => array(
        'title'         => __('Typography', 'bb-powerpack'),
        'sections'      => array(
            'typography'    => array(
                'title'     => '',
                'fields'    => array(
                    'text_font'          => array(
						'type'          => 'font',
						'default'		=> array(
							'family'		=> 'Default',
							'weight'		=> 300
						),
						'label'         => __('Font', 'bb-powerpack'),
						'preview'         => array(
							'type'            => 'font',
							'selector'        => '.pp-notification-wrapper .pp-notification-inner .pp-notification-content p'
						)
					),
                    'text_size'     => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Font size', 'bb-powerpack'),
                        'default'       => array(
                            'text_size_desktop' => 18,
                            'text_size_tablet' => '',
                            'text_size_mobile' => '',
                        ),
                        'options'       => array(
                            'text_size_desktop'     => array(
                                'placeholder'       => __('Desktop', 'bb-powerpack'),
                                'icon'              => 'fa-desktop',
                                'maxlength'         => 3,
                                'tooltip'           => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-notification-wrapper .pp-notification-inner .pp-notification-content p',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'text_size_tablet'     => array(
                                'placeholder'       => __('Tablet', 'bb-powerpack'),
                                'icon'              => 'fa-tablet',
                                'maxlength'         => 3,
                                'tooltip'           => __('Tablet', 'bb-powerpack')
                            ),
                            'text_size_mobile'     => array(
                                'placeholder'       => __('Mobile', 'bb-powerpack'),
                                'icon'              => 'fa-mobile',
                                'maxlength'         => 3,
                                'tooltip'           => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'text_line_height'     => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'text_line_height_desktop' => 1.6,
                            'text_line_height_tablet' => '',
                            'text_line_height_mobile' => '',
                        ),
                        'options'       => array(
                            'text_line_height_desktop'     => array(
                                'placeholder'       => __('Desktop', 'bb-powerpack'),
                                'icon'              => 'fa-desktop',
                                'maxlength'         => 3,
                                'tooltip'           => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-notification-wrapper .pp-notification-inner .pp-notification-content p',
                                    'property'      => 'line-height',
                                ),
                            ),
                            'text_line_height_tablet'     => array(
                                'placeholder'       => __('Tablet', 'bb-powerpack'),
                                'icon'              => 'fa-tablet',
                                'maxlength'         => 3,
                                'tooltip'           => __('Tablet', 'bb-powerpack')
                            ),
                            'text_line_height_mobile'     => array(
                                'placeholder'       => __('Mobile', 'bb-powerpack'),
                                'icon'              => 'fa-mobile',
                                'maxlength'         => 3,
                                'tooltip'           => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'text_color'    => array(
                        'type'      => 'color',
                        'label'     => __('Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'default'       => '000000',
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-notification-wrapper .pp-notification-inner .pp-notification-content p',
                            'property'  => 'color'
                        ),
                    ),
                ),
            ),
        ),
    ),
));
