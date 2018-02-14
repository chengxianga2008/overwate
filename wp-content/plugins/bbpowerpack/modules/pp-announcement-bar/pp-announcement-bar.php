<?php

/**
 * @class PPAnnouncementBarModule
 */
class PPAnnouncementBarModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Announcement Bar', 'bb-powerpack'),
            'description'   => __('Addon to add announement bar to the page.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-announcement-bar/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-announcement-bar/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh'   => true
        ));
    }

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPAnnouncementBarModule', array(
	'general'      => array( // Tab
		'title'         => __('General', 'bb-powerpack'), // Tab title
		'sections'      => array( // Tab Sections
            'announcement_bar_position' => array(
                'title'     => '',
                'fields'    => array(
                    'announcement_bar_position' => array(
                        'type'      => 'pp-switch',
                        'label'     => __('Bar Position', 'bb-powerpack'),
                        'default'   => 'top',
                        'options'   => array(
                            'top'       => __('Top', 'bb-powerpack'),
                            'bottom'    => __('Bottom', 'bb-powerpack')
                        ),
                    ),
                ),
            ),
            'general'      => array(
                'title'         => '',
                'fields'        => array(
                    'announcement_icon' => array(
                        'type'  => 'icon',
                        'label' => __('Icon', 'bb-powerpack'),
                        'show_remove'    => true
                    ),
                    'announcement_content'  => array(
                        'type'      => 'textarea',
                        'label'     => __('Content', 'bb-powerpack'),
                        'connections'   => array( 'string', 'html', 'url' ),
                        'preview'   => array(
                            'type'  => 'text',
                            'selector'  => '.pp-announcement-bar-content p'
                        ),
                    ),
                    'announcement_link_type'    => array(
                        'type'      => 'pp-switch',
                        'label'     => __('Link Type', 'bb-powerpack'),
                        'default'   => 'link',
                        'options'   => array(
                            'link'  => __('Link', 'bb-powerpack'),
                            'button'  => __('Button', 'bb-powerpack'),
                        ),
                        'toggle'    => array(
                            'link'      => array(
                                'fields'    => array('announcement_link_hover_color'),
                            ),
                            'button'    => array(
                                'sections'  => array('announcement_button_styling'),
                            )
                        )
                    ),
                    'announcement_link_text'    => array(
                        'type'      => 'text',
                        'label'     => __('Link Text', 'bb-powerpack'),
                        'connections'   => array( 'string', 'html', 'url' ),
                        'preview'   => array(
                            'type'  => 'text',
                            'selector'  => '.pp-announcement-bar-link a'
                        )
                    ),
                    'announcement_link_url'     => array(
                        'type'      => 'link',
                        'label'     => __('Link', 'bb-powerpack'),
                        'connections'   => array( 'url' ),
                    ),
                    'announcement_link_target'  => array(
                        'type'      => 'pp-switch',
                        'label'     => __('Link Target', 'bb-powerpack'),
                        'default'   => '_self',
                        'options'   => array(
                            '_self' => __('Same Window', 'bb-powerpack'),
                            '_blank' => __('New Window', 'bb-powerpack'),
                        )
                    ),
                ),
            ),
		)
	),
    'style'     => array(
        'title' => __('Style', 'bb-powerpack'),
        'sections'  => array(
            'announcement_settings'  => array(
                'title' => __('General', 'bb-powerpack'),
                'fields'    => array(
                    'announcement_text_align'   => array(
                        'type'      => 'pp-switch',
                        'label'     => __('Content Alignment', 'bb-powerpack'),
                        'default'   => 'center',
                        'options'   => array(
                            'left'    => __('Left', 'bb-powerpack'),
                            'center'    => __('Center', 'bb-powerpack'),
                        ),
                    ),
                    'announcement_bar_height'    => array(
                        'type'      => 'text',
                        'label'     => __('Bar Height', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 80,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-announcement-bar-wrap',
                            'property'  => 'height',
                            'unit'      => 'px'
                        )
                    ),
                    'announcement_bar_background'    => array(
                        'type'      => 'color',
                        'label'     => __('Background Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-announcement-bar-wrap',
                            'property'  => 'background',
                        )
                    ),
                    'announcement_bar_border_type'  => array(
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
                                'fields'    => array('announcement_bar_border_width', 'announcement_bar_border_color'),
                            ),
                            'dashed' => array(
                                'fields'    => array('announcement_bar_border_width', 'announcement_bar_border_color'),
                            ),
                            'dotted' => array(
                                'fields'    => array('announcement_bar_border_width', 'announcement_bar_border_color'),
                            ),
                        ),
                    ),
                    'announcement_bar_border_width'     => array(
                        'type'      => 'text',
                        'label'     => __('Border Width', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 1,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-announcement-bar-wrap',
                            'property'  => 'border',
                            'unit'      => 'px'
                        ),
                    ),
                    'announcement_bar_border_color'     => array(
                        'type'      => 'color',
                        'label'     => __('Border Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-announcement-bar-wrap',
                            'property'  => 'border-color'
                        )
                    ),
                ),
            ),
            'announcement_icon_styling'     => array(
                'title'     => __('Icon', 'bb-powerpack'),
                'fields'    => array(
                    'announcement_icon_size'    => array(
                        'type'      => 'text',
                        'label'     => __('Size', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 16,
                        'description'   => 'px',
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-announcement-bar-icon .pp-icon',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        )
                    ),
                    'announcement_icon_color'   => array(
                        'type'      => 'color',
                        'label'     => __('Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-announcement-bar-icon .pp-icon',
                            'property'  => 'color'
                        ),
                    ),
                ),
            ),
            'announcement_box_shadow'   => array(
                'title'     => __('Box Shadow', 'bb-powerpack'),
                'fields'    => array(
                    'announcement_box_shadow'   => array(
                        'type'      => 'pp-switch',
                        'label'     => __('Display Box Shadow?', 'bb-powerpack'),
                        'default'   => 'no',
                        'options'   => array(
                            'yes'    => __('Yes', 'bb-powerpack'),
                            'no'    => __('No', 'bb-powerpack'),
                        ),
                        'toggle'    => array(
                            'yes'   => array(
                                'fields'    => array('announcement_box_shadow_options', 'announcement_box_shadow_color', 'announcement_box_shadow_opacity'),
                            ),
                        ),
                    ),
                    'announcement_box_shadow_options'   => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Box Shadow', 'bb-powerpack'),
                        'default'   => array(
                            'announcement_box_shadow_h' => 0,
                            'announcement_box_shadow_v' => 0,
                            'announcement_box_shadow_blur' => 10,
                            'announcement_box_shadow_spread' => 0,
                        ),
                        'options'   => array(
                            'announcement_box_shadow_h'     => array(
                                'placeholder'       => __('Horizontal', 'bb-powerpack'),
                                'icon'              => 'fa-arrows-h',
                                'maxlength'         => 2,
                                'tooltip'           => __('Horizontal', 'bb-powerpack')
                            ),
                            'announcement_box_shadow_v'     => array(
                                'placeholder'       => __('Vertical', 'bb-powerpack'),
                                'icon'              => 'fa-arrows-v',
                                'maxlength'         => 2,
                                'tooltip'           => __('Vertical', 'bb-powerpack')
                            ),
                            'announcement_box_shadow_blur'     => array(
                                'placeholder'       => __('Blur', 'bb-powerpack'),
                                'icon'              => 'fa-circle-o',
                                'maxlength'         => 2,
                                'tooltip'           => __('Blur', 'bb-powerpack')
                            ),
                            'announcement_box_shadow_spread'     => array(
                                'placeholder'       => __('Spread', 'bb-powerpack'),
                                'icon'              => 'fa-paint-brush',
                                'maxlength'         => 2,
                                'tooltip'           => __('Spread', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'announcement_box_shadow_color' => array(
                        'type'              => 'color',
                        'label'             => __('Color', 'bb-powerpack'),
                        'default'           => '000000',
                    ),
                    'announcement_box_shadow_opacity' => array(
                        'type'              => 'text',
                        'label'             => __('Opacity', 'bb-powerpack'),
                        'class'             => 'input-small',
                        'default'           => 0.5,
                    ),
                ),
            ),
            'announcement_close_button_styling' => array(
                'title'     => __('Close Button', 'bb-powerpack'),
                'fields'    => array(
                    'announcement_close_color'  => array(
                        'type'      => 'color',
                        'label'     => __('Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-announcement-bar-wrap .pp-announcement-bar-close-button .pp-close-button',
                            'property'  => 'color'
                        ),
                    ),
                    'close_size'    => array(
                        'type'      => 'text',
                        'label'     => __('Size', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 16,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-announcement-bar-wrap .pp-announcement-bar-close-button .pp-close-button',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        )
                    ),

                ),
            ),
            'announcement_button_styling'   => array(
                'title'     => __('Button', 'bb-powerpack'),
                'fields'    => array(
                    'announcement_button_backgrounds'     => array(
                        'type'  => 'pp-color',
                        'label' => __('Background Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'default'       => array(
                            'primary'   => 'dddddd',
                            'secondary'   => '333333',
                        ),
                        'options'       => array(
                            'primary'   => __('Default', 'bb-powerpack'),
                            'secondary'   => __('Hover', 'bb-powerpack'),
                        ),
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-announcement-bar-link a',
                            'property'  => 'background'
                        ),
                    ),
                    'announcement_button_border_type'   => array(
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
                                'fields'    => array('announcement_button_border_width', 'announcement_button_border_color'),
                            ),
                            'dashed' => array(
                                'fields'    => array('announcement_button_border_width', 'announcement_button_border_color'),
                            ),
                            'dotted' => array(
                                'fields'    => array('announcement_button_border_width', 'announcement_button_border_color'),
                            ),
                        )
                    ),
                    'announcement_button_border_width'  => array(
                        'type'      => 'text',
                        'label'     => __('Border Width', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 1,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-announcement-bar-link a',
                            'property'  => 'border-width',
                            'unit'      => 'px'
                        ),
                    ),
                    'announcement_button_border_color'  => array(
                        'type'      => 'color',
                        'label'     => __('Border Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-announcement-bar-link a',
                            'property'  => 'border-color'
                        )
                    ),
                    'announcement_button_border_radius'     => array(
                        'type'      => 'text',
                        'label'     => __('Round Corners', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 0,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-announcement-bar-link a',
                            'property'  => 'border-radius',
                            'unit'      => 'px'
                        ),
                    ),
                    'announcement_button_padding'   => array(
                        'type'  => 'pp-multitext',
                        'label' => __('Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'   => array(
                            'announcement_button_top_padding'   => 5,
                            'announcement_button_bottom_padding'   => 5,
                            'announcement_button_left_padding'   => 5,
                            'announcement_button_right_padding'   => 5,
                        ),
                        'options'   => array(
                            'announcement_button_top_padding'   => array(
                                'placeholder'       => __('Top', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'icon'              => 'fa-long-arrow-up',
                                'tooltip'           => __('Top', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-announcement-bar-wrap .pp-announcement-bar-link a',
                                    'property'      => 'padding-top',
                                    'unit'          => 'px'
                                ),
                            ),
                            'announcement_button_bottom_padding'   => array(
                                'placeholder'       => __('Bottom', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'default'           => 5,
                                'icon'              => 'fa-long-arrow-down',
                                'tooltip'           => __('Bottom', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-announcement-bar-wrap .pp-announcement-bar-link a',
                                    'property'      => 'padding-bottom',
                                    'unit'          => 'px'
                                ),
                            ),
                            'announcement_button_left_padding'   => array(
                                'placeholder'       => __('Left', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'default'           => 5,
                                'icon'              => 'fa-long-arrow-left',
                                'tooltip'           => __('Left', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-announcement-bar-wrap .pp-announcement-bar-link a',
                                    'property'      => 'padding-left',
                                    'unit'          => 'px'
                                ),
                            ),
                            'announcement_button_right_padding'   => array(
                                'placeholder'       => __('Right', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'default'           => 5,
                                'icon'              => 'fa-long-arrow-right',
                                'tooltip'           => __('Right', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-announcement-bar-wrap .pp-announcement-bar-link a',
                                    'property'      => 'padding-right',
                                    'unit'          => 'px'
                                ),
                            ),
                        ),
                    ),
                )
            ),
        )
    ),
    'announcement_typography'   => array(
        'title'     => __('Typography', 'bb-powerpack'),
        'sections'  => array(
            'announcement_text_typography'  => array(
                'title' => __('Content', 'bb-powerpack'),
                'fields'    => array(
                    'announcement_text_font'   => array(
                        'type'  => 'font',
                        'default'		=> array(
    						'family'		=> 'Default',
    						'weight'		=> 300
    					),
    					'label'         => __('Font', 'bb-powerpack'),
    					'preview'         => array(
    						'type'            => 'font',
    						'selector'        => '.pp-announcement-bar-content p'
    					)
                    ),
                    'announcement_text_font_size'   => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'announcement_text_font_size_desktop'   => 18,
                            'announcement_text_font_size_tablet'   => '',
                            'announcement_text_font_size_mobile'   => '',
                        ),
                        'options'   => array(
                            'announcement_text_font_size_desktop'   => array(
                                'placeholder'       => __('Desktop', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'icon'              => 'fa-desktop',
                                'tooltip'           => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-announcement-bar-wrap .pp-announcement-bar-content p',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'announcement_text_font_size_tablet'   => array(
                                'placeholder'       => __('Tablet', 'bb-powerpack'),
                                'maxlength'         => 2,
                                'icon'              => 'fa-tablet',
                                'tooltip'           => __('Tablet', 'bb-powerpack')
                            ),
                            'announcement_text_font_size_mobile'   => array(
                                'placeholder'       => __('Mobile', 'bb-powerpack'),
                                'maxlength'         => 2,
                                'icon'              => 'fa-mobile',
                                'tooltip'           => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'announcement_text_line_height'   => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'announcement_text_line_height_desktop' => 1.6,
                            'announcement_text_line_height_tablet' => '',
                            'announcement_text_line_height_mobile' => '',
                        ),
                        'options'   => array(
                            'announcement_text_line_height_desktop'   => array(
                                'placeholder'       => __('Desktop', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'icon'              => 'fa-desktop',
                                'tooltip'           => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-announcement-bar-wrap .pp-announcement-bar-content p',
                                    'property'      => 'line-height',
                                ),
                            ),
                            'announcement_text_line_height_tablet'   => array(
                                'placeholder'       => __('Tablet', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'icon'              => 'fa-tablet',
                                'tooltip'           => __('Tablet', 'bb-powerpack')
                            ),
                            'announcement_text_line_height_mobile'   => array(
                                'placeholder'       => __('Mobile', 'bb-powerpack'),
                                'maxlength'         => 3,
                                'icon'              => 'fa-mobile',
                                'tooltip'           => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'announcement_text_color'    => array(
                        'type'      => 'color',
                        'label'     => __('Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-announcement-bar-content p',
                            'property'  => 'color'
                        ),
                    ),
                ),
            ),
            'announcement_link_typography'  => array(
                'title'     => __('Link/Button', 'bb-powerpack'),
                'fields'    => array(
                    'announcement_link_font'     => array(
                        'type'      => 'font',
                        'default'		=> array(
    						'family'		=> 'Default',
    						'weight'		=> 300
    					),
    					'label'         => __('Font', 'bb-powerpack'),
    					'preview'         => array(
    						'type'            => 'font',
    						'selector'        => '.pp-announcement-bar-link a'
    					)
                    ),
                    'announcement_link_font_size'   => array(
                        'type'      => 'text',
                        'label'     => __('Font Size', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 16,
                        'description'   => 'px',
                        'preview'   => array(
                            'type'  => 'css',
                            'selector'  => '.pp-announcement-bar-link a',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        ),
                    ),
                    'announcement_link_color'    => array(
                        'type'      => 'pp-color',
                        'label'     => __('Colors', 'bb-powerpack'),
                        'show_reset'    => true,
                        'default'       => array(
                            'primary'      => '333333',
                            'secondary'     => 'dddddd',
                        ),
                        'options'       => array(
                            'primary'      => __('Default', 'bb-powerpack'),
                            'secondary'      => __('Hover', 'bb-powerpack'),
                        ),
                    ),
                ),
            ),
        ),
    ),
));
