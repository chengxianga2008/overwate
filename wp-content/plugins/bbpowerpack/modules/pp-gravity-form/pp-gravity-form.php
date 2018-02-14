<?php

/**
 * @class PPGravityFormModule
 */
class PPGravityFormModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Gravity Form', 'bb-powerpack'),
            'description'   => __('A module for Gravity Form.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-gravity-form/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-gravity-form/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
    }
}

require_once BB_POWERPACK_DIR . 'modules/pp-gravity-form/includes/functions.php';

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPGravityFormModule', array(
    'form'       => array( // Tab
        'title'         => __('General', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'select_form'       => array( // Section
                'title'         => '', // Section Title
                'fields'        => array( // Section Fields
                    'select_form_field' => array(
                        'type'          => 'select',
                        'label'         => __('Select Form', 'bb-powerpack'),
                        'default'       => '',
                        'options'       => gf_module_form_titles()
                    ),
                )
            ),
            'form_settings'     => array(
                'title'             => __('Settings', 'bb-powerpack'),
                'fields'            => array(
                    'form_custom_title_desc'   => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Custom Title & Description', 'bb-powerpack'),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'      => __('Yes', 'bb-powerpack'),
                            'no'     => __('No', 'bb-powerpack'),
                        ),
                        'toggle' => array(
                            'yes'      => array(
                                'fields'  => array('custom_title', 'custom_description'),
                            ),
                            'no'    => array(
                                'fields'    => array('title_field', 'description_field')
                            )
                        )
                    ),
                    'title_field'   => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Title', 'bb-powerpack'),
                        'default'       => 'true',
                        'options'       => array(
                            'true'      => __('Show', 'bb-powerpack'),
                            'false'     => __('Hide', 'bb-powerpack'),
                        ),
                    ),
                    'custom_title'      => array(
                        'type'          => 'text',
                        'label'         => __('Custom Title', 'bb-powerpack'),
                        'default'       => '',
                        'description'   => '',
                        'connections'   => array('string'),
						'preview'       => array(
                            'type'      => 'text',
                            'selector'  => '.form-title'
                        )
                    ),
                    'description_field' => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Description', 'bb-powerpack'),
                        'default'       => 'true',
                        'options'       => array(
                            'true'      => __('Show', 'bb-powerpack'),
                            'false'     => __('Hide', 'bb-powerpack'),
                        ),
                    ),
                    'custom_description'    => array(
                        'type'              => 'textarea',
                        'label'             => __('Custom Description', 'bb-powerpack'),
                        'default'           => '',
                        'placeholder'       => '',
                        'rows'              => '6',
                        'connections'       => array('string', 'html'),
                        'preview'           => array(
                            'type'          => 'text',
                            'selector'      => '.form-description'
                        )
                    ),
                    'display_labels'   => array(
                        'type'         => 'pp-switch',
                        'label'        => __('Labels', 'bb-powerpack'),
                        'default'      => 'block',
                        'options'      => array(
                            'block'    => __('Show', 'bb-powerpack'),
                            'none'     => __('Hide', 'bb-powerpack'),
                        ),
                    ),
                    'form_tab_index'      => array(
                        'type'          => 'text',
                        'label'         => __('Tab Index', 'bb-powerpack'),
                        'class'         => 'bb-gf-input input-small',
                        'default'       => 1,
                    ),
                )
            ),
        )
    ),
    'style'       => array( // Tab
        'title'         => __('Style', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'form_setting'      => array( // Section
                'title'         => __('Form Background', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'form_bg_type'      => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Background Type', 'bb-powerpack'),
                        'default'       => 'color',
                        'options'       => array(
                            'color'   => __('Color', 'bb-powerpack'),
                            'image'     => __('Image', 'bb-powerpack'),
                        ),
                        'toggle'    => array(
                            'color' => array(
                                'fields'    => array('form_bg_color', 'form_background_opacity')
                            ),
                            'image' => array(
                                'fields'    => array('form_bg_image','form_bg_size','form_bg_repeat', 'form_bg_overlay', 'form_bg_overlay_opacity')
                            )
                        )
                    ),
                    'form_bg_color'     => array(
                        'type'          => 'color',
                        'label'         => __('Background Color', 'bb-powerpack'),
                        'default'       => 'ffffff',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-gf-content',
                            'property'  => 'background-color'
                        )
                    ),
					'form_background_opacity'    => array(
                        'type'                 => 'text',
                        'label'                => __('Background Opacity', 'bb-powerpack'),
                        'class'                => 'bb-gf-input input-small',
                        'default'              => '1',
                        'description'          => __('between 0 to 1', 'bb-powerpack'),
                    ),
                    'form_bg_image'     => array(
                        'type'              => 'photo',
                        'label'         => __('Background Image', 'bb-powerpack'),
                        'default'       => '',
						'show_remove'	=> true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-gf-content',
                            'property'  => 'background-image'
                        )
                    ),
                    'form_bg_size'      => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Background Size', 'bb-powerpack'),
                        'default'       => 'cover',
                        'options'       => array(
                            'contain'   => __('Contain', 'bb-powerpack'),
                            'cover'     => __('Cover', 'bb-powerpack'),
                        )
                    ),
                    'form_bg_repeat'    => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Background Repeat', 'bb-powerpack'),
                        'default'       => 'no-repeat',
                        'options'       => array(
                            'repeat-x'      => __('Repeat X', 'bb-powerpack'),
                            'repeat-y'      => __('Repeat Y', 'bb-powerpack'),
                            'no-repeat'     => __('No Repeat', 'bb-powerpack'),
                        )
                    ),
					'form_bg_overlay'     => array(
                        'type'          => 'color',
                        'label'         => __('Background Overlay Color', 'bb-powerpack'),
                        'default'       => '000000',
                        'show_reset'    => true,
                    ),
                    'form_bg_overlay_opacity'    => array(
                        'type'                 => 'text',
                        'label'                => __('Background Overlay Opacity', 'bb-powerpack'),
                        'class'                => 'bb-gf-input input-small',
                        'default'              => '50',
                        'description'          => __('%', 'bb-powerpack'),
                    ),
                )
            ),
            'form_border'       => array(
                'title'             => __('Form Border', 'bb-powerpack'),
                'fields'            => array(
                    'form_border_width'      => array(
                        'type'          => 'text',
                        'label'         => __('Border Width', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-gf-input input-small',
                        'default'       => 0,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-gf-content',
                            'property'  => 'border-width',
                            'unit'      => 'px'
                        )
                    ),
                    'form_border_color'     => array(
                        'type'          => 'color',
                        'label'         => __('Border Color', 'bb-powerpack'),
                        'default'       => 'dddddd',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-gf-content',
                            'property'  => 'border-color'
                        )
                    ),
                    'form_border_style' 	=> array(
                        'type'          => 'pp-switch',
                        'label'         => __('Border Style', 'bb-powerpack'),
                        'default'       => 'solid',
                        'options'		=> array(
                            'solid'		=> __('Solid', 'bb-powerpack'),
                       		'dashed'	=> __('Dashed', 'bb-powerpack'),
                       		'dotted'	=> __('Dotted', 'bb-powerpack'),
                        ),
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-gf-content',
                            'property'  => 'border-style'
                        )
                    ),
                )
            ),
            'form_container'        => array(
                'title'                 => __('Corners & Padding', 'bb-powerpack'),
                'fields'                => array(
                    'form_border_radius' 	=> array(
                        'type'          => 'text',
                        'label'         => __('Round Corners', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => 2,
                        'class'         => 'bb-gf-input input-small',
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-gf-content',
                            'property'  => 'border-radius',
                            'unit'      => 'px'
                        )
                    ),
                    'form_padding' 	=> array(
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
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'type'      => 'css',
                                    'selector'  => '.pp-gf-content',
                                    'property'  => 'padding-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'type'      => 'css',
                                    'selector'  => '.pp-gf-content',
                                    'property'  => 'padding-bottom',
                                    'unit'      => 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Left', 'bb-powerpack'),
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'type'      => 'css',
                                    'selector'  => '.pp-gf-content',
                                    'property'  => 'padding-left',
                                    'unit'      => 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Right', 'bb-powerpack'),
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'type'      => 'css',
                                    'selector'  => '.pp-gf-content',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                        'fallback'			=> array(
                            'top'				=> 'form_padding',
                            'bottom'			=> 'form_padding',
                            'left'				=> 'form_padding',
                            'right'				=> 'form_padding',
                        )
                    )
                )
            ),
            'general_style'    => array( // Section
                'title'         => __('General', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'title_alignment'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Title Alignment', 'bb-powerpack'),
                        'default'                   => 'left',
                        'options'                   => array(
                            'left'                  => __('Left', 'bb-powerpack'),
                            'center'                => __('Center', 'bb-powerpack'),
                            'right'                 => __('Right', 'bb-powerpack'),
                        ),
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_title, .form-title',
                            'property'  => 'text-align'
                        )
                    ),
                    'description_alignment'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Description Alignment', 'bb-powerpack'),
                        'default'                   => 'left',
                        'options'                   => array(
                            'left'                  => __('Left', 'bb-powerpack'),
                            'center'                => __('Center', 'bb-powerpack'),
                            'right'                 => __('Right', 'bb-powerpack'),
                        ),
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_description, .form-description',
                            'property'  => 'text-align'
                        )
                    ),
                    'product_price_color'    => array(
                        'type'          => 'color',
                        'label'         => __('Product Price Color', 'bb-powerpack'),
                        'default'       => '900900',
                        'show_reset'    => true,
                        'preview'           => array(
                            'type'          => 'css',
                            'selector'      => '.gform_wrapper span.ginput_product_price',
                            'property'      => 'color'
                        )
                    ),
                )
            ),
			'section_style'    => array( // Section
                'title'         => __('Sections', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
					'section_border_width'      => array(
                        'type'          => 'text',
                        'label'         => __('Border Width', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-gf-input input-small',
                        'default'       => 1,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_wrapper .gsection',
                            'property'  => 'border-bottom-width',
                            'unit'      => 'px'
                        )
                    ),

					'section_border_color'    => array(
                        'type'          => 'color',
                        'label'         => __('Border Color', 'bb-powerpack'),
                        'default'       => 'cccccc',
                        'show_reset'    => true,
                        'preview'           => array(
                            'type'          => 'css',
                            'selector'      => '.gform_wrapper .gsection',
                            'property'      => 'border-bottom-color'
                        )
                    ),
				)
			),
        )
    ),
    'input_style'           => array(
        'title'                 => __('Inputs', 'bb-powerpack'),
        'sections'              => array(
            'input_background'      => array(
                'title'                 => __('Colors', 'bb-powerpack'),
                'fields'                => array(
                    'input_field_text_color'    => array(
                        'type'                  => 'color',
                        'label'                 => __('Text Color', 'bb-powerpack'),
                        'default'               => '333333',
                        'preview'               => array(
                            'type'                  => 'css',
                            'selector'              => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                            'property'              => 'color'
                        )
                    ),
                    'input_field_bg_color'      => array(
                        'type'                  => 'color',
                        'label'                 => __('Background Color', 'bb-powerpack'),
                        'default'               => 'ffffff',
                        'show_reset'            => true,
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                            'property'          => 'background-color'
                        )
                    ),
                    'input_field_background_opacity'    => array(
                        'type'                 => 'text',
                        'label'                => __('Background Opacity', 'bb-powerpack'),
                        'class'                => 'bb-gf-input input-small',
                        'default'              => '1',
                        'description'          => __('between 0 to 1', 'bb-powerpack'),
                        'preview'              => array(
                            'type'             => 'css',
                            'selector'         => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                            'property'         => 'opacity',
                        )
                    ),
                    'input_desc_color'  => array(
                        'type'                  => 'color',
                        'label'                 => __('Description Color', 'bb-powerpack'),
                        'default'               => '000000',
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.gform_wrapper .gfield .gfield_description',
                            'property'          => 'color'
                        )
                    ),
                )
            ),
            'input_border'      => array(
                'title'             => __('Border', 'bb-powerpack'),
                'fields'            => array(
                    'input_field_border_color'  => array(
                        'type'                  => 'color',
                        'label'                 => __('Border Color', 'bb-powerpack'),
                        'default'               => 'eeeeee',
                        'show_reset'            => true,
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                            'property'          => 'border-color'
                        )
                    ),
                    'input_field_border_width'    => array(
                        'type'                    => 'text',
                        'label'                   => __('Border Width', 'bb-powerpack'),
                        'description'             => 'px',
                        'default'                 => '1',
                        'class'                   => 'bb-gf-input input-small',
                        'preview'                 => array(
                            'type'                => 'css',
                            'rules'                 => array(
                                array(
                                    'selector'            => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                                    'property'            => 'border-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                                    'property'            => 'border-top-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                                    'property'            => 'border-bottom-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                                    'property'            => 'border-left-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                                    'property'            => 'border-right-width',
                                    'unit'                => 'px',
                                )
                            )
                        )
                    ),
                    'input_field_border_position'    => array(
                        'type'                    => 'select',
                        'label'                   => __('Border Position', 'bb-powerpack'),
                        'default'                 => 'border',
                        'options'				  => array(
                        	'border'			  => __('Default', 'bb-powerpack'),
                        	'border-top'		  => __('Top', 'bb-powerpack'),
                        	'border-bottom'		  => __('Bottom', 'bb-powerpack'),
                        	'border-left'		  => __('Left', 'bb-powerpack'),
                        	'border-right'		  => __('Right', 'bb-powerpack'),
                        ),
                        'preview'                 => array(
                            'type'                => 'css',
                            'selector'            => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                            'property'            => 'border',
                            'unit'                => 'px'
                        )
                    ),
                    'input_field_focus_color'      => array(
                        'type'                  => 'color',
                        'label'                 => __('Focus Border Color', 'bb-powerpack'),
                        'default'               => '719ece',
                        'show_reset'            => true,
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]):focus, .gform_wrapper .gfield select:focus, .gform_wrapper .gfield textarea:focus',
                            'property'          => 'border-color'
                        )
                    ),
                )
            ),
            'input_general'      => array( // Section
                'title'         => __('General', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'input_field_width'     => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Full Width', 'bb-powerpack'),
                        'default'           => 'false',
                        'options'           => array(
                            'true'          => __('Yes', 'bb-powerpack'),
                            'false'         => __('No', 'bb-powerpack'),
                        )
                    ),
                    'input_field_height'    => array(
                        'type'                  => 'pp-switch',
                        'label'                 => __('Height', 'bb-powerpack'),
                        'default'               => 'auto',
                        'options'               => array(
                            'auto'                  => __('Auto', 'bb-powerpack'),
                            'custom'                => __('Custom', 'bb-powerpack')
                        ),
                        'toggle'                => array(
                            'custom'                => array(
                                'fields'                => array('input_field_height_custom')
                            )
                        )
                    ),
                    'input_field_height_custom' => array(
                        'type'                      => 'text',
                        'label'                     => __('Custom Height', 'bb-powerpack'),
                        'description'               => 'px',
                        'default'                   => '45',
                        'class'                     => 'bb-gf-input input-small',
                        'preview'                   => array(
                            'type'                      => 'css',
                            'selector'                  => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select',
                            'property'                  => 'border-radius',
                            'unit'                      => 'px'
                        )
                    ),
                    'input_field_text_alignment'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Text Alignment', 'bb-powerpack'),
                        'default'                   => 'left',
                        'options'                   => array(
                            'left'                  => __('Left', 'bb-powerpack'),
                            'center'                => __('Center', 'bb-powerpack'),
                            'right'                 => __('Right', 'bb-powerpack'),
                        )
                    ),
                    'input_field_border_radius'    => array(
                        'type'                     => 'text',
                        'label'                    => __('Round Corners', 'bb-powerpack'),
                        'description'              => 'px',
                        'default'                  => '2',
                        'class'                    => 'bb-gf-input input-small',
                        'preview'                  => array(
                            'type'                 => 'css',
                            'selector'             => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                            'property'             => 'border-radius',
                            'unit'                 => 'px'
                        )
                    ),
                    'input_field_box_shadow'   => array(
                        'type'                 => 'pp-switch',
                        'label'                => __('Box Shadow', 'bb-powerpack'),
                        'default'              => 'inherit',
                        'options'              => array(
                            'inherit'          => __('Show', 'bb-powerpack'),
                            'none'             => __('Hide', 'bb-powerpack'),
                        )
                    ),
                    'input_field_padding'    => array(
                        'type'               => 'text',
                        'label'              => __('Padding', 'bb-powerpack'),
                        'description'        => 'px',
                        'class'              => 'bb-gf-input input-small',
                        'default'            => '12',
                        'preview'            => array(
                            'type'           => 'css',
                            'selector'       => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                            'property'       => 'padding',
                            'unit'           => 'px'
                        )
                    ),
                    'input_field_margin'    => array(
                        'type'              => 'text',
                        'label'             => __('Margin Bottom', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'bb-gf-input input-small',
                        'default'           => '10',
                        'preview'           => array(
                            'type'          => 'css',
                            'selector'      => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                            'property'      => 'margin-bottom',
                            'unit'          => 'px'
                        )
                    ),
                )
            ),
            'placeholder_style'      => array( // Section
                'title'         => __('Placeholder', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'gf_input_placeholder_display' 	=> array(
                        'type'          => 'pp-switch',
                        'label'         => __('Show Placeholder', 'bb-powerpack'),
                        'default'       => 'block',
                        'options'		=> array(
                       		'block'	=> __('Yes', 'bb-powerpack'),
                       		'none'	=> __('No', 'bb-powerpack'),
                        ),
                        'toggle' => array(
                            'block' => array(
                                'fields' => array('gf_input_placeholder_color')
                            )
                        )
                    ),
                    'gf_input_placeholder_color'  => array(
                        'type'                  => 'color',
                        'label'                 => __('Color', 'bb-powerpack'),
                        'default'               => 'eeeeee',
                        'show_reset'            => true,
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.gform_wrapper .gfield input::-webkit-input-placeholder, .gform_wrapper .gfield select::-webkit-input-placeholder, .gform_wrapper .gfield textarea::-webkit-input-placeholder',
                            'property'          => 'color'
                        )
                    ),
                )
            ),
        )
    ),
    'button_style'      => array(
        'title'             => __('Button', 'bb-powerpack'),
        'sections'          => array(
            'button_bg'         => array(
                'title'             => __('Colors', 'bb-powerpack'),
                'fields'            => array(
                    'button_text_color' => array(
                        'type'          => 'color',
                        'label'         => __('Text Color', 'bb-powerpack'),
                        'default'       => 'ffffff',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_wrapper .gform_footer .gform_button, .gform_wrapper .gform_page_footer .button',
                            'property'  => 'color'
                        )
                    ),
                    'button_hover_text_color'    => array(
                        'type'                   => 'color',
                        'label'                  => __('Text Color Hover', 'bb-powerpack'),
                        'default'                => 'eeeeee',
                        'show_reset'             => true,
                        'preview'                => array(
                            'type'               => 'css',
                            'selector'           => '.gform_wrapper .gform_footer .gform_button:hover, .gform_wrapper .gform_page_footer .button:hover',
                            'property'           => 'color'
                        )
                    ),
                    'button_bg_color'   => array(
                        'type'          => 'color',
                        'label'         => __('Background Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_wrapper .gform_footer .gform_button, .gform_wrapper .gform_page_footer .button',
                            'property'  => 'background-color'
                        )
                    ),
                    'button_background_opacity'    => array(
                        'type'                 => 'text',
                        'label'                => __('Background Opacity', 'bb-powerpack'),
                        'class'                => 'bb-gf-input input-small',
                        'default'              => '1',
                        'preview'              => array(
                            'type'             => 'css',
                            'selector'         => '.gform_wrapper .gform_footer .gform_button, .gform_wrapper .gform_page_footer .button',
                            'property'         => 'opacity',
                        )
                    ),
                    'button_hover_bg_color'    => array(
                        'type'                 => 'color',
                        'label'                => __('Background Color Hover', 'bb-powerpack'),
                        'default'              => '000000',
                        'show_reset'           => true,
                        'preview'              => array(
                            'type'             => 'css',
                            'selector'         => '.gform_wrapper .gform_footer .gform_button:hover, .gform_wrapper .gform_page_footer .button:hover',
                            'property'         => 'background-color'
                        )
                    ),
                )
            ),
            'button_border'     => array(
                'title'             => __('Border', 'bb-powerpack'),
                'fields'            => array(
                    'button_border_width'    => array(
                        'type'               => 'text',
                        'label'              => __('Border Width', 'bb-powerpack'),
                        'description'        => 'px',
                        'class'              => 'bb-gf-input input-small',
                        'default'            => '1',
                        'preview'            => array(
                            'type'           => 'css',
                            'selector'       => '.gform_wrapper .gform_footer .gform_button, .gform_wrapper .gform_page_footer .button',
                            'property'       => 'border-width',
                            'unit'           => 'px'
                        )
                    ),
                    'button_border_color'    => array(
                        'type'               => 'color',
                        'label'              => __('Border Color', 'bb-powerpack'),
                        'default'            => '333333',
                        'show_reset'         => true,
                        'preview'            => array(
                            'type'           => 'css',
                            'selector'       => '.gform_wrapper .gform_footer .gform_button, .gform_wrapper .gform_page_footer .button',
                            'property'       => 'border-color'
                        )
                    ),
                )
            ),
            'button_settings'       => array( // Section
                'title'             => __('Size & Alignment', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'button_width'  => array(
                        'type'      => 'pp-switch',
                        'label'     => __('Full Width', 'bb-powerpack'),
                        'default'   => 'false',
                        'options'   => array(
                            'true'  => __('Yes', 'bb-powerpack'),
                            'false' => __('No', 'bb-powerpack'),
                        ),
                        'toggle'    => array(
                            'false' => array(
                                'fields'    => array('button_width_size', 'button_alignment')
                            )
                        )
                    ),
                    'button_alignment'  => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Button Alignment', 'bb-powerpack'),
                        'default'       => 'left',
                        'options'       => array(
                            'left'      => __('Left', 'bb-powerpack'),
                            'center'    => __('Center', 'bb-powerpack'),
                            'right'     => __('Right', 'bb-powerpack'),
                        )
                    ),
                )
            ),
            'button_corners'        => array(
                'title'                 => __('Corners & Padding', 'bb-powerpack'),
                'fields'                => array(
                    'button_border_radius'    => array(
                        'type'                => 'text',
                        'label'               => __('Round Corners', 'bb-powerpack'),
                        'description'         => 'px',
                        'class'               => 'bb-gf-input input-small',
                        'default'             => '2',
                        'preview'             => array(
                            'type'            => 'css',
                            'selector'        => '.gform_wrapper .gform_footer .gform_button, .gform_wrapper .gform_page_footer .button',
                            'property'        => 'border-radius',
                            'unit'            => 'px'
                        )
                    ),
                    'button_padding_top_bottom'    => array(
                        'type'          => 'text',
                        'label'         => __('Top/Bottom Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-gf-input input-small',
                        'default'       => '10',
                        'preview'             => array(
                            'type'            => 'css',
                            'rules'           => array(
                                array(
                                    'selector'        => '.gform_wrapper .gform_footer .gform_button',
                                    'property'        => 'padding-top',
                                    'unit'            => 'px'
                                ),
                                array(
                                    'selector'        => '.gform_wrapper .gform_footer .gform_button, .gform_wrapper .gform_page_footer .button',
                                    'property'        => 'padding-bottom',
                                    'unit'            => 'px'
                                ),
                            ),
                        )
                    ),
                    'button_padding_left_right'    => array(
                        'type'          => 'text',
                        'label'         => __('Left/Right Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-gf-input input-small',
                        'default'       => '10',
                        'preview'             => array(
                            'type'            => 'css',
                            'rules'           => array(
                                array(
                                    'selector'        => '.gform_wrapper .gform_footer .gform_button, .gform_wrapper .gform_page_footer .button',
                                    'property'        => 'padding-left',
                                    'unit'            => 'px'
                                ),
                                array(
                                    'selector'        => '.gform_wrapper .gform_footer .gform_button, .gform_wrapper .gform_page_footer .button',
                                    'property'        => 'padding-right',
                                    'unit'            => 'px'
                                ),
                            ),
                        )
                    ),
                )
            ),
        )
    ),
    'error_style'   => array(
        'title'         => __('Errors', 'bb-powerpack'),
        'sections'      => array(
            'form_error_styling'    => array( // Section
                'title'             => __('Errors Style', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'validation_error'  => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Validation Error', 'bb-powerpack'),
                        'default'       => 'block',
                        'options'       => array(
                            'block'     => __('Show', 'bb-powerpack'),
                            'none'      => __('Hide', 'bb-powerpack'),
                        ),
                        'toggle' => array(
                            'block' => array(
                                'fields'    => array('validation_error_color'),
                                'sections'  => array('errors_typography')
                            )
                        )
                    ),
                    'validation_error_color'    => array(
                        'type'                  => 'color',
                        'label'                 => __('Error Description Color', 'bb-powerpack'),
                        'default'               => '790000',
                        'show_reset'            => true,
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.gform_wrapper .validation_error',
                            'property'          => 'color'
                        )
                    ),
					'validation_error_border_color'    => array(
                        'type'                         => 'color',
                        'label'                        => __('Error Border Color', 'bb-powerpack'),
                        'default'                      => '790000',
                        'show_reset'                   => true,
                        'preview'                      => array(
                            'type'                     => 'css',
                            'selector'                 => '.gform_wrapper .validation_error',
                            'property'                 => 'border-color'
                        )
                    ),
                    'form_error_field_background_color'    => array(
                        'type'                             => 'color',
                        'label'                            => __('Error Field Background Color', 'bb-powerpack'),
                        'default'                          => 'ffdfe0',
                        'show_reset'                       => true,
                        'preview'                          => array(
                            'type'                         => 'css',
                            'selector'                     => '.gform_wrapper .gfield.gfield_error',
                            'property'                     => 'color'
                        )
                    ),
                    'form_error_field_label_color'    => array(
                        'type'                        => 'color',
                        'label'                       => __('Error Field Label Color', 'bb-powerpack'),
                        'default'                     => '790000',
                        'show_reset'                  => true,
                        'preview'                     => array(
                            'type'                    => 'css',
                            'selector'                => '.gform_wrapper .gfield.gfield_error .gfield_label',
                            'property'                => 'color'
                        )
                    ),
					'form_error_input_border_color'    => array(
                        'type'                         => 'color',
                        'label'                        => __('Error Field Input Border Color', 'bb-powerpack'),
                        'default'                      => '790000',
                        'show_reset'                   => true,
                        'preview'                      => array(
                            'type'                     => 'css',
                            'selector'                 => '.gform_wrapper .gfield_error .ginput_container input, .gform_wrapper .gfield_error .ginput_container select, .gform_wrapper .gfield_error .ginput_container textarea',
                            'property'                 => 'color'
                        )
                    ),
					'form_error_input_border_width'    => array(
                        'type'                         => 'text',
                        'label'                        => __('Error Field Input Border Width', 'bb-powerpack'),
                        'description'                  => 'px',
                        'class'                        => 'bb-gf-input input-small',
                        'default'                      => '1',
                        'preview'                      => array(
                            'type'                     => 'css',
                            'selector'                 => '.gform_wrapper .gfield_error .ginput_container input, .gform_wrapper .gfield_error .ginput_container select, .gform_wrapper .gfield_error .ginput_container textarea',
                            'property'                 => 'border-width',
                            'unit'                     => 'px'
                        )
                    ),
					'validation_message'   => array(
                        'type'             => 'pp-switch',
                        'label'            => __('Error Field Message', 'bb-powerpack'),
                        'default'          => 'block',
                        'options'          => array(
                            'block'        => __('Show', 'bb-powerpack'),
                            'none'         => __('Hide', 'bb-powerpack'),
                        ),
                        'toggle'    => array(
                            'block' => array(
                                'fields'    => array('validation_message_color')
                            )
                        )
                    ),
                    'validation_message_color'    => array(
                        'type'                    => 'color',
                        'label'                   => __('Error Field Message Color', 'bb-powerpack'),
                        'default'                 => '790000',
                        'show_reset'              => true,
                        'preview'                 => array(
                            'type'                => 'css',
                            'selector'            => '.gform_wrapper .gfield_error .validation_message',
                            'property'            => 'color'
                        )
                    ),
                )
            ),
        )
    ),
    'form_typography'       => array( // Tab
        'title'         => __('Typography', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'title_typography'       => array( // Section
                'title'         => __('Title', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'title_font_family' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.gform_title, .form-title'
                        )
                    ),
                    'title_font_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Font Size', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-gf-input input-small',
                        'default'       => '',
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_title, .form-title',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        )
                    ),
                    'title_color'       => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_title, .form-title',
                            'property'  => 'color'
                        )
                    ),
                )
            ),
            'description_typography'    => array(
                'title' => __('Description', 'bb-powerpack'),
                'fields'    => array(
                    'description_font_family' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.gform_description, .form-description'
                        )
                    ),
                    'description_font_size'    => array(
                        'type'                 => 'text',
                        'label'                => __('Font Size', 'bb-powerpack'),
                        'description'          => 'px',
                        'class'                => 'bb-gf-input input-small',
                        'default'              => '',
                        'preview'              => array(
                            'type'             => 'css',
                            'selector'         => '.gform_description, .form-description',
                            'property'         => 'font-size',
                            'unit'             => 'px'
                        )
                    ),
                    'description_color' => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_description, .form-description',
                            'property'  => 'color'
                        )
                    ),
                )
            ),
			'section_typography'	=> array(
				'title'	=> __( 'Sections', 'bb-powerpack' ),
				'fields'	=> array(
					'section_font_size'      => array(
                        'type'          => 'text',
                        'label'         => __('Font Size', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-gf-input input-small',
                        'default'       => '',
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_wrapper h2.gsection_title',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        )
                    ),
					'section_text_color'    => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'           => array(
                            'type'          => 'css',
                            'selector'      => '.gform_wrapper h2.gsection_title',
                            'property'      => 'color'
                        )
                    ),
				)
			),
            'label_typography'       => array( // Section
                'title'         => __('Label', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'label_font_family' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.gform_wrapper .gfield .gfield_label, .gform_wrapper .gfield .gfield_description'
                        )
                    ),
                    'label_font_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Font Size', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-gf-input input-small',
                        'default'       => '',
                        'preview'           => array(
                            'type'          => 'css',
                            'selector'      => '.gform_wrapper .gfield .gfield_label',
                            'property'      => 'font-size',
                            'unit'          => 'px'
                        )
                    ),
                    'form_label_color'  => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_wrapper .gfield .gfield_label, .gform_wrapper table.gfield_list thead th, .gform_wrapper span.ginput_product_price_label, .gform_wrapper span.ginput_quantity_label, .gform_wrapper .gfield_html',
                            'property'  => 'color'
                        )
                    ),
                )
            ),
            'input_typography'       => array( // Section
                'title'         => __('Input', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'input_font_family' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.gform_wrapper .gfield input, .gform_wrapper .gfield select, .gform_wrapper .gfield textarea'
                        )
                    ),
                    'input_font_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Font Size', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-gf-input input-small',
                        'default'       => '',
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .gform_wrapper .gfield select, .gform_wrapper .gfield textarea',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        )
                    ),
                    'input_desc_font_size'    => array(
                        'type'              => 'text',
                        'label'             => __('Description Font Size', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'bb-gf-input input-small',
                        'default'           => '',
                        'preview'           => array(
                            'type'          => 'css',
                            'selector'      => '.gform_wrapper .gfield .gfield_description',
                            'property'      => 'font-size',
                            'unit'          => 'px'
                        )
                    ),
                    'input_desc_line_height'    => array(
                        'type'              => 'text',
                        'label'             => __('Description Line Height', 'bb-powerpack'),
                        'class'             => 'bb-gf-input input-small',
                        'default'           => '',
                        'preview'           => array(
                            'type'          => 'css',
                            'selector'      => '.gform_wrapper .gfield .gfield_description',
                            'property'      => 'line-height',
                        )
                    ),
                )
            ),
            'button_typography'       => array( // Section
                'title'         => __('Button', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'button_font_family' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.gform_wrapper .gform_footer .gform_button, .gform_wrapper .gform_page_footer .button'
                        )
                    ),
                    'button_font_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Font Size', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-gf-input input-small',
                        'default'       => '',
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.gform_wrapper .gform_footer .gform_button, .gform_wrapper .gform_page_footer .button',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        )
                    ),
                )
            ),
            'errors_typography'       => array( // Section
                'title'         => __('Error', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'validation_error_font_size'    => array(
                        'type'                  => 'text',
                        'label'                 => __('Error Description Font Size', 'bb-powerpack'),
                        'description'           => 'px',
                        'class'                 => 'bb-gf-input input-small',
                        'default'               => '',
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.gform_wrapper .validation_error',
                            'property'          => 'font-size',
                            'unit'              => 'px'
                        )
                    ),
                )
            )
        )
    )
));
