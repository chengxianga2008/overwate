<?php

/**
 * @class PPHighlightBoxModule
 */
class PPHighlightBoxModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Highlight Box', 'bb-powerpack'),
            'description'   => __('A module for Highlight Box.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-highlight-box/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-highlight-box/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
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
FLBuilder::register_module('PPHighlightBoxModule', array(
    'highlight_box'       => array( // Tab
        'title'         => __('Box', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'box_layout'       => array( // Section
                'title'        => __('Text', 'bb-powerpack'), // Section Title
                'fields'       => array( // Section Fields
                    'box_content'       => array(
						'type'          => 'editor',
						'label'         => '',
						'rows'          => 13,
                        'connections'   => array( 'string', 'html', 'url' ),
						'preview'       => array(
							'type'      => 'text',
							'selector'  => '.pp-highlight-box-content'
						)
					),
                )
            ),
            'box_link_field'          => array(
				'title'         => __('Link', 'bb-powerpack'),
				'fields'        => array(
					'box_link'          => array(
						'type'          => 'link',
						'label'         => __('Link', 'bb-powerpack'),
                        'connections'   => array( 'url' ),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'link_target'   => array(
						'type'          => 'select',
						'label'         => __('Link Target', 'bb-powerpack'),
						'default'       => '_self',
						'options'       => array(
							'_self'         => __('Same Window', 'bb-powerpack'),
							'_blank'        => __('New Window', 'bb-powerpack')
						),
						'preview'         => array(
							'type'            => 'none'
						)
					)
				)
			),
            'icon_layout'       => array( // Section
                'title'        => __('Icon', 'bb-powerpack'), // Section Title
                'fields'       => array( // Section Fields
                    'box_icon_select'       => array(
                        'type'          => 'select',
						'label'         => __('Icon to Display', 'bb-powerpack'),
						'options'       => array(
							'font_icon'         => __('Font Icon Manager', 'bb-powerpack'),
							'custom_icon'       => __('Custom Image Icon', 'bb-powerpack')
						),
                        'toggle' => array(
                            'font_icon'    => array(
                                'fields'   => array('box_font_icon', 'box_font_icon_size', 'box_font_icon_color' ),
                                'sections' => array('icon_style')
                            ),
                            'custom_icon'   => array(
                                'fields'  => array('box_custom_icon', 'box_custom_icon_width'),
                                'sections' => array('icon_style')
                            ),
                        )
					),
                    'box_font_icon'          => array(
						'type'          => 'icon',
						'label'         => __('Font Icon', 'bb-powerpack')
					),
                    'box_custom_icon'     => array(
                        'type'              => 'photo',
                        'label'         => __('Custom Icon', 'bb-powerpack'),
                        'default'       => '',
                        'show_reset'    => true,
                        'connections'   => array( 'photo' ),
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-highlight-box-content img',
                            'property'  => ''
                        )
                    ),
                )
            ),
        )
    ),
    'style'       => array( // Tab
        'title'         => __('Style', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'general_colors'       => array( // Section
                'title'         => __('Box Style', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'box_bg_color'    => array(
                        'type'          => 'color',
                        'label'         => __('Background Color', 'bb-powerpack'),
                        'default'       => 'ff0000',
                        'show_reset'    => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.pp-highlight-box-content',
                            'property'        => 'background-color'
                        )
                    ),
                    'box_text_color'    => array(
                        'type'          => 'color',
                        'label'         => __('Text Color', 'bb-powerpack'),
                        'default'       => 'ffffff',
                        'show_reset'    => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.pp-highlight-box-content',
                            'property'        => 'color'
                        )
                    ),
                    'box_bg_hover_color'    => array(
                        'type'          => 'color',
                        'label'         => __('Hover Background Color', 'bb-powerpack'),
                        'default'       => 'c72929',
                        'show_reset'    => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.pp-highlight-box-content:hover',
                            'property'        => 'background-color'
                        )
                    ),
                    'box_text_hover_color'    => array(
                        'type'          => 'color',
                        'label'         => __('Hover Text Color', 'bb-powerpack'),
                        'default'       => 'ffffff',
                        'show_reset'    => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.pp-highlight-box-content:hover',
                            'property'        => 'color'
                        )
                    ),
                    'box_top_padding'   => array(
                        'type'          => 'text',
                        'label'         => __('Top Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-box-input input-small',
                        'default'       => '20',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-highlight-box-content',
                            'property'  => 'padding-top',
                            'unit'      => 'px'
                        )
                    ),
                    'box_bottom_padding'   => array(
                        'type'          => 'text',
                        'label'         => __('Bottom Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-box-input input-small',
                        'default'       => '20',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-highlight-box-content',
                            'property'  => 'padding-bottom',
                            'unit'      => 'px'
                        )
                    ),
                    'box_left_padding'   => array(
                        'type'          => 'text',
                        'label'         => __('Left Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-box-input input-small',
                        'default'       => '20',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-highlight-box-content',
                            'property'  => 'padding-left',
                            'unit'      => 'px'
                        )
                    ),
                    'box_right_padding'   => array(
                        'type'          => 'text',
                        'label'         => __('Right Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-box-input input-small',
                        'default'       => '20',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-highlight-box-content',
                            'property'  => 'padding-right',
                            'unit'      => 'px'
                        )
                    ),
                    'box_font' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-highlight-box-content'
                        )
                    ),
                    'box_font_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Font Size', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-box-input input-small',
                        'default'       => '20',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-highlight-box-content',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        )
                    ),
                )
            ),
            'icon_style'       => array( // Section
                'title'         => __('Icon Style', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'box_font_icon_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Font Size', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-box-input input-small',
                        'default'       => '50',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-highlight-box-content .font_icon',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        )
                    ),
                    'box_font_icon_color' => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-highlight-box-content .font_icon',
                            'property'  => 'color'
                        )
                    ),
                    'box_custom_icon_width'   => array(
                        'type'          => 'text',
                        'label'         => __('Width', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-box-input input-small',
                        'default'       => '50',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-highlight-box-content .custom_icon .custom_icon_inner',
                            'property'  => 'width',
                            'unit'      => 'px'
                        )
                    ),
                    'box_icon_effect'       => array(
                        'type'          => 'select',
						'label'         => __('Effect', 'bb-powerpack'),
						'options'       => array(
                            'box-hover'         => __('Hover', 'bb-powerpack'),
							'slide-left'         => __('Slide Left', 'bb-powerpack'),
							'slide-right'       => __('Slide Right', 'bb-powerpack'),
                            'slide-top'         => __('Slide Top', 'bb-powerpack'),
							'slide-bottom'       => __('Slide Bottom', 'bb-powerpack')
						)
					),
                    'box_icon_transition_duration'   => array(
                        'type'          => 'text',
                        'label'         => __('Transition Duration', 'bb-powerpack'),
                        'description'   => 'ms',
                        'class'         => 'bb-box-input input-small',
                        'default'       => '1000',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-highlight-box-content',
                            'property'  => 'width',
                            'unit'      => 'ms'
                        )
                    ),
                )
            )
        )
    ),
));
