<?php

/**
 * @class PPFormidableFormModule
 */
class PPFormidableFormModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Formidable Form', 'bb-powerpack'),
            'description'   => __('A module for Formidable Form.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-formidable-form/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-formidable-form/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
    }

    public static function formidable_titles()
    {
        $options = array( '' => __('None', 'bb-powerpack') );

        if( class_exists('FrmForm') ) {
            $forms = FrmForm::get_published_forms( array(), 999, 'exclude' );
            if ( count( $forms ) ) {
                foreach ( $forms as $form )
                $options[$form->id] = $form->name;
            }
        }

        return $options;
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPFormidableFormModule', array(
    'form'       => array( // Tab
        'title'         => __('General', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'select_form'       => array( // Section
                'title'         => __('Form', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'form_desc'     => array(
                        'type'          => '',
                        'description'   => __('Formidable Forms Module enables you to override the default form style that has been set in the Formidable Forms settings.', 'bb-powerpack'),
                    ),
                    'select_form_field' => array(
                        'type'          => 'select',
                        'label'         => __('Select Form', 'bb-powerpack'),
                        'default'       => '',
                        'options'       => PPFormidableFormModule::formidable_titles(),
                    ),
                )
            ),
            'form_general_settings' => array(
                'title' => __('Settings', 'bb-powerpack'),
                'description'   => __('Formidable Forms Module enables you to override the default form style that has been set in the Formidable Forms settings.', 'bb-powerpack'),
                'fields'    => array(
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
						'preview'       => array(
                            'type'      => 'text',
                            'selector'  => '.pp-form-title'
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
                        'preview'           => array(
                            'type'          => 'text',
                            'selector'      => '.pp-form-description'
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
                )
            )
        )
    ),
    'style'       => array( // Tab
        'title'         => __('Style', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'form_bg_setting'      => array( // Section
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
                                'fields'    => array('form_bg_color','form_background_opacity')
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
                            'selector'  => '.pp-ff-content',
                            'property'  => 'background-color'
                        )
                    ),
                    'form_background_opacity'    => array(
                        'type'                 => 'text',
                        'label'                => __('Background Opacity', 'bb-powerpack'),
                        'class'                => 'bb-ff-input input-small',
                        'description'          => '%',
                        'default'              => '100',
                        'preview'              => array(
                            'type'             => 'css',
                            'selector'         => '.pp-ff-content',
                            'property'         => 'opacity',
                        )
                    ),
                    'form_bg_image'     => array(
                    'type'              => 'photo',
                        'label'         => __('Background Image', 'bb-powerpack'),
                        'default'       => '',
						'show_remove'	=> true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content',
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
                        'class'                => 'bb-ff-input input-small',
                        'default'              => '50',
                        'description'          => __('%', 'bb-powerpack'),
                    ),
                )
            ),
            'form_border_setting'      => array( // Section
                'title'         => __('Form Border', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'form_border_style' 	=> array(
                        'type'          => 'pp-switch',
                        'label'         => __('Border Style', 'bb-powerpack'),
                        'default'       => 'none',
                        'options'		=> array(
                            'none'		=> __('None', 'bb-powerpack'),
                            'solid'		=> __('Solid', 'bb-powerpack'),
                       		'dashed'	=> __('Dashed', 'bb-powerpack'),
                       		'dotted'	=> __('Dotted', 'bb-powerpack'),
                        ),
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content',
                            'property'  => 'border-style'
                        ),
                        'toggle'    => array(
                            'solid' => array(
                                'fields'    => array('form_border_width', 'form_border_color')
                            ),
                            'dashed' => array(
                                'fields'    => array('form_border_width', 'form_border_color')
                            ),
                            'dotted' => array(
                                'fields'    => array('form_border_width', 'form_border_color')
                            )
                        )
                    ),
                    'form_border_width'      => array(
                        'type'          => 'text',
                        'label'         => __('Border Width', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-ff-input input-small',
                        'default'       => 2,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content',
                            'property'  => 'border-width',
                            'unit'      => 'px'
                        )
                    ),
                    'form_border_color'     => array(
                        'type'          => 'color',
                        'label'         => __('Border Color', 'bb-powerpack'),
                        'default'       => 'ffffff',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content',
                            'property'  => 'border-color'
                        )
                    ),
                )
            ),
            'form_box_shadow'      => array( // Section
                'title'         => __('Box Shadow', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'form_shadow_display'   => array(
                        'type'                 => 'pp-switch',
                        'label'                => __('Enable Shadow', 'bb-powerpack'),
                        'default'              => 'no',
                        'options'              => array(
                            'yes'          => __('Show', 'bb-powerpack'),
                            'no'             => __('Hide', 'bb-powerpack'),
                        ),
                        'toggle'    =>  array(
                            'yes'   => array(
                                'fields'    => array('form_shadow', 'form_shadow_color', 'form_shadow_opacity')
                            )
                        )
                    ),
                    'form_shadow' 		=> array(
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
                    'form_shadow_color' => array(
                        'type'              => 'color',
                        'label'             => __('Shadow Color', 'bb-powerpack'),
                        'default'           => '000000',
                    ),
                    'form_shadow_opacity' => array(
                        'type'              => 'text',
                        'label'             => __('Opacity', 'bb-powerpack'),
                        'description'       => '%',
                        'class'             => 'bb-ff-input input-small',
                        'default'           => 50,
                    ),
                )
            ),
            'form_corners_padding'      => array( // Section
                'title'         => __('Size, Corners & Padding', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'form_max_width' 	=> array(
                        'type'          => 'text',
                        'label'         => __('Max Width', 'bb-powerpack'),
                        'description'   => '%',
                        'default'       => 100,
                        'class'         => 'bb-ff-input input-small',
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content',
                            'property'  => 'max-width',
                            'unit'      => '%'
                        )
                    ),
                    'form_border_radius' 	=> array(
                        'type'          => 'text',
                        'label'         => __('Round Corners', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => 2,
                        'class'         => 'bb-ff-input input-small',
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content',
                            'property'  => 'border-radius',
                            'unit'      => 'px'
                        )
                    ),
                    'form_padding' 	=> array(
                        'type' 			=> 'pp-multitext',
                        'label' 		=> __('Padding', 'bb-powerpack'),
                        'description'   => __( 'px', 'Value unit for font size. Such as: "14 px"', 'bb-powerpack' ),
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
                                'tooltip'       => 'Top',
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content',
                                    'property'  => 'padding-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => 'Bottom',
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content',
                                    'property'  => 'padding-bottom',
                                    'unit'      => 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Left', 'bb-powerpack'),
                                'tooltip'       => 'Left',
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content',
                                    'property'  => 'padding-left',
                                    'unit'      => 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Right', 'bb-powerpack'),
                                'tooltip'       => 'Right',
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    )
                )
            ),
            'section_field_setting' => array( // Section
                'title' => __('Section Field', 'bb-powerpack'),
                'fields'    => array(
                    'section_field_bg_color'     => array(
                        'type'          => 'color',
                        'label'         => __('Background Color', 'bb-powerpack'),
                        'default'       => '',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                            'property'  => 'background-color'
                        )
                    ),
                    'section_field_color'  => array(
                        'type'                  => 'color',
                        'label'                 => __('Color', 'bb-powerpack'),
                        'default'               => '444444',
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3, .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_icon_font',
                            'property'          => 'color'
                        )
                    ),
                    'section_field_border_style' 	=> array(
                        'type'          => 'pp-switch',
                        'label'         => __('Border Style', 'bb-powerpack'),
                        'default'       => 'none',
                        'options'		=> array(
                            'none'		=> __('None', 'bb-powerpack'),
                            'solid'		=> __('Solid', 'bb-powerpack'),
                       		'dashed'	=> __('Dashed', 'bb-powerpack'),
                       		'dotted'	=> __('Dotted', 'bb-powerpack'),
                        ),
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                            'property'  => 'border-style'
                        ),
                        'toggle'    => array(
                            'solid' => array(
                                'fields'    => array('section_field_border_width', 'section_field_border_color')
                            ),
                            'dashed' => array(
                                'fields'    => array('section_field_border_width', 'section_field_border_color')
                            ),
                            'dotted' => array(
                                'fields'    => array('section_field_border_width', 'section_field_border_color')
                            )
                        )
                    ),
                    'section_field_border_width'      => array(
                        'type'          => 'text',
                        'label'         => __('Border Width', 'bb-powerpack'),
                        'description'   => 'px',
                        'class'         => 'bb-ff-input input-small',
                        'default'       => 2,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                            'property'  => 'border-width',
                            'unit'      => 'px'
                        )
                    ),
                    'section_field_border_color'     => array(
                        'type'          => 'color',
                        'label'         => __('Border Color', 'bb-powerpack'),
                        'default'       => 'ffffff',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                            'property'  => 'border-color'
                        )
                    ),
                    'section_field_border_position'    => array(
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
                            'selector'            => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                            'property'            => 'border',
                            'unit'                => 'px'
                        )
                    ),
                    'section_field_margin' 	=> array(
                        'type' 			=> 'pp-multitext',
                        'label' 		=> __('Margin', 'bb-powerpack'),
                        'description'   => __( 'px', 'Value unit for font size. Such as: "14 px"', 'bb-powerpack' ),
                        'default'       => array(
                            'top' => 10,
                            'bottom' => 10,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => 'Top',
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                                    'property'  => 'margin-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => 'Bottom',
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                                    'property'  => 'margin-bottom',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    ),
                    'section_field_padding' 	=> array(
                        'type' 			=> 'pp-multitext',
                        'label' 		=> __('Padding', 'bb-powerpack'),
                        'description'   => __( 'px', 'Value unit for font size. Such as: "14 px"', 'bb-powerpack' ),
                        'default'       => array(
                            'top' => 15,
                            'right' => 0,
                            'bottom' => 15,
                            'left' => 0,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => 'Top',
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                                    'property'  => 'padding-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => 'Bottom',
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                                    'property'  => 'padding-bottom',
                                    'unit'      => 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Left', 'bb-powerpack'),
                                'tooltip'       => 'Left',
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                                    'property'  => 'padding-left',
                                    'unit'      => 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Right', 'bb-powerpack'),
                                'tooltip'       => 'Right',
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    )
                )
            ),
            'title_style' => array( // Section
                'title' => __('Title', 'bb-powerpack'),
                'fields'    => array(
                    'title_alignment'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Alignment', 'bb-powerpack'),
                        'default'                   => 'left',
                        'options'                   => array(
                            'left'                  => __('Left', 'bb-powerpack'),
                            'center'                => __('Center', 'bb-powerpack'),
                            'right'                 => __('Right', 'bb-powerpack'),
                        ),
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style h3.frm_form_title, .pp-ff-content .pp-form-title',
                            'property'  => 'text-align'
                        )
                    ),
                    'title_margin' 	=> array(
                        'type' 			=> 'pp-multitext',
                        'label' 		=> __('Margin', 'bb-powerpack'),
                        'description'   => __( 'px', 'Value unit for font size. Such as: "14 px"', 'bb-powerpack' ),
                        'default'       => array(
                            'top' => 10,
                            'bottom' => 10,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => 'Top',
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style h3.frm_form_title, .pp-ff-content .pp-form-title',
                                    'property'  => 'margin-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => 'Bottom',
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style h3.frm_form_title, .pp-ff-content .pp-form-title',
                                    'property'  => 'margin-bottom',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    )
                )
            ),
            'description_style' => array( // Section
                'title' => __('Description', 'bb-powerpack'),
                'fields'    => array(
                    'description_alignment'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Alignment', 'bb-powerpack'),
                        'default'                   => 'left',
                        'options'                   => array(
                            'left'                  => __('Left', 'bb-powerpack'),
                            'center'                => __('Center', 'bb-powerpack'),
                            'right'                 => __('Right', 'bb-powerpack'),
                        ),
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm_form_title + div.frm_description p, .pp-ff-content .pp-form-description',
                            'property'  => 'text-align'
                        )
                    ),
                    'description_margin' 	=> array(
                        'type' 			=> 'pp-multitext',
                        'label' 		=> __('Margin', 'bb-powerpack'),
                        'description'   => __( 'px', 'Value unit for font size. Such as: "14 px"', 'bb-powerpack' ),
                        'default'       => array(
                            'top' => 10,
                            'bottom' => 10,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => 'Top',
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm_form_title + div.frm_description p, .pp-ff-content .pp-form-description',
                                    'property'  => 'margin-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => 'Bottom',
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm_form_title + div.frm_description p, .pp-ff-content .pp-form-description',
                                    'property'  => 'margin-bottom',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    )
                )
            ),
        )
    ),
    'input_style_t'   => array(
        'title' => __('Inputs', 'bb-powerpack'),
        'sections'  => array(
            'input_colors_setting'      => array( // Section
                'title'         => __('Colors', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'input_field_text_color'    => array(
                        'type'                  => 'color',
                        'label'                 => __('Text Color', 'bb-powerpack'),
                        'default'               => '333333',
                        'preview'               => array(
                            'type'                  => 'css',
                            'selector'              => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
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
                            'selector'          => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea, .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_dropzone',
                            'property'          => 'background-color'
                        )
                    ),
                    'input_field_background_opacity'    => array(
                        'type'                 => 'text',
                        'label'                => __('Background Opacity', 'bb-powerpack'),
                        'class'                => 'bb-ff-input input-small',
                        'description'          => '%',
                        'default'              => '100',
                        'preview'              => array(
                            'type'             => 'css',
                            'selector'         => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                            'property'         => 'opacity',
                        )
                    ),
                )
            ),
            'input_border_setting'      => array( // Section
                'title'         => __('Border', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'input_field_border_color'  => array(
                        'type'                  => 'color',
                        'label'                 => __('Border Color', 'bb-powerpack'),
                        'default'               => 'eeeeee',
                        'show_reset'            => true,
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                            'property'          => 'border-color'
                        )
                    ),
                    'input_field_border_width'    => array(
                        'type'                    => 'text',
                        'label'                   => __('Border Width', 'bb-powerpack'),
                        'description'             => 'px',
                        'default'                 => '1',
                        'class'                   => 'bb-ff-input input-small',
                        'preview'                 => array(
                            'type'                => 'css',
                            'rules'                 => array(
                                array(
                                    'selector'            => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                                    'property'            => 'border-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                                    'property'            => 'border-top-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                                    'property'            => 'border-bottom-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                                    'property'            => 'border-left-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
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
                            'selector'            => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
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
                            'selector'          => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]):focus, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select:focus, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea:focus',
                            'property'          => 'border-color'
                        )
                    ),
                )
            ),
            'input_style'      => array( // Section
                'title'         => __('Size & Alignment', 'bb-powerpack'), // Section Title
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
                        'type'                    => 'text',
                        'label'                   => __('Input Height', 'bb-powerpack'),
                        'description'             => 'px',
                        'default'                 => '32',
                        'class'                   => 'bb-ff-input input-small',
                        'preview'                 => array(
                            'type'                => 'css',
                            'selector'            => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select',
                            'property'            => 'height',
                            'unit'                => 'px',
                        )
                    ),
                    'input_textarea_height'    => array(
                        'type'                    => 'text',
                        'label'                   => __('Textarea Height', 'bb-powerpack'),
                        'description'             => 'px',
                        'default'                 => '140',
                        'class'                   => 'bb-ff-input input-small',
                        'preview'                 => array(
                            'type'                => 'css',
                            'selector'            => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                            'property'            => 'height',
                            'unit'                => 'px',
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
                )
            ),
            'input_general_style'      => array( // Section
                'title'         => __('General', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'input_field_border_radius'    => array(
                        'type'                     => 'text',
                        'label'                    => __('Round Corners', 'bb-powerpack'),
                        'description'              => 'px',
                        'default'                  => '2',
                        'class'                    => 'bb-ff-input input-small',
                        'preview'                  => array(
                            'type'                 => 'css',
                            'selector'             => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                            'property'             => 'border-radius',
                            'unit'                 => 'px'
                        )
                    ),
                    'input_field_box_shadow'   => array(
                        'type'                 => 'pp-switch',
                        'label'                => __('Box Shadow', 'bb-powerpack'),
                        'default'              => 'yes',
                        'options'              => array(
                            'yes'          => __('Show', 'bb-powerpack'),
                            'no'             => __('Hide', 'bb-powerpack'),
                        ),
                        'toggle'    => array(
                            'yes'   => array(
                                'fields'    => array('input_shadow_color', 'input_shadow_direction')
                            )
                        )
                    ),
                    'input_shadow_color'      => array(
                        'type'          => 'color',
                        'label'         => __('Shadow Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                            'property'  => 'box-shadow'
                        ),
                    ),
                    'input_shadow_direction'  => array(
                        'type'      => 'select',
                        'label'     => __('Shadow Direction', 'bb-powerpack'),
                        'default'   => 'out',
                        'options'   => array(
                            'out'   => __('Outside', 'bb-powerpack'),
                            'inset'   => __('Inside', 'bb-powerpack'),
                        ),
                    ),
                    'input_field_padding' 	=> array(
                        'type' 			=> 'pp-multitext',
                        'label' 		=> __('Padding', 'bb-powerpack'),
                        'description'   => __( 'px', 'Value unit for font size. Such as: "14 px"', 'bb-powerpack' ),
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
                                'tooltip'       => 'Top',
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                                    'property'  => 'padding-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => 'Bottom',
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                                    'property'  => 'padding-bottom',
                                    'unit'      => 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Left', 'bb-powerpack'),
                                'tooltip'       => 'Left',
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                                    'property'  => 'padding-left',
                                    'unit'      => 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Right', 'bb-powerpack'),
                                'tooltip'       => 'Right',
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    ),
                    'input_field_margin'    => array(
                        'type'              => 'text',
                        'label'             => __('Margin Bottom', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'bb-ff-input input-small',
                        'default'           => '10',
                        'preview'           => array(
                            'type'          => 'css',
                            'selector'      => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field',
                            'property'      => 'margin-bottom',
                            'unit'          => 'px'
                        )
                    ),
                )
            ),
            'placeholder_style'      => array( // Section
                'title'         => __('Placeholder', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'input_placeholder_display' 	=> array(
                        'type'          => 'pp-switch',
                        'label'         => __('Show Placeholder', 'bb-powerpack'),
                        'default'       => 'block',
                        'options'		=> array(
                       		'block'	=> __('Yes', 'bb-powerpack'),
                       		'none'	=> __('No', 'bb-powerpack'),
                        ),
                        'toggle' => array(
                            'block' => array(
                                'fields' => array('input_placeholder_color')
                            )
                        )
                    ),
                    'input_placeholder_color'  => array(
                        'type'                  => 'color',
                        'label'                 => __('Color', 'bb-powerpack'),
                        'default'               => 'eeeeee',
                        'show_reset'            => true,
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input::-webkit-input-placeholder, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select::-webkit-input-placeholder, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea::-webkit-input-placeholder',
                            'property'          => 'color'
                        )
                    ),
                )
            ),
        )
    ),
    'button_style'    => array(
        'title' => __('Button', 'bb-powerpack'),
        'sections'  => array(
            'button_colors_setting'       => array( // Section
                'title'             => __('Colors', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'button_text_color'    => array(
                        'type'  => 'pp-color',
                        'label' => __('Text Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'default'       => array(
                            'primary'   => 'ffffff',
                            'secondary' => 'eeeeee'
                        ),
                        'options'   => array(
                            'primary'   => __('Default', 'bb-powerpack'),
                            'secondary'   => __('Hover', 'bb-powerpack'),
                        ),
                    ),
                    'button_bg_color'    => array(
                        'type'  => 'pp-color',
                        'label' => __('Background Color', 'bb-powerpack'),
                        'show_reset'    => true,
                        'default'       => array(
                            'primary'   => '333333',
                            'secondary' => '000000'
                        ),
                        'options'   => array(
                            'primary'   => __('Default', 'bb-powerpack'),
                            'secondary'   => __('Hover', 'bb-powerpack'),
                        ),
                    ),
                    'button_background_opacity'    => array(
                        'type'                 => 'text',
                        'label'                => __('Background Opacity', 'bb-powerpack'),
                        'class'                => 'bb-ff-input input-small',
                        'description'          => '%',
                        'default'              => '100',
                        'preview'              => array(
                            'type'             => 'css',
                            'selector'         => '.pp-ff-content .frm_style_formidable-style.with_frm_style input[type=submit], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=button], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=reset], .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_submit button',
                            'property'         => 'opacity',
                        )
                    ),
                )
            ),
            'button_border_setting'       => array( // Section
                'title'             => __('Border', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'button_border_width'    => array(
                        'type'               => 'text',
                        'label'              => __('Border Width', 'bb-powerpack'),
                        'description'        => 'px',
                        'class'              => 'bb-ff-input input-small',
                        'default'            => '1',
                        'preview'            => array(
                            'type'           => 'css',
                            'selector'       => '.pp-ff-content .frm_style_formidable-style.with_frm_style input[type=submit], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=button], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=reset], .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_submit button',
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
                            'selector'       => '.pp-ff-content .frm_style_formidable-style.with_frm_style input[type=submit], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=button], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=reset], .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_submit button',
                            'property'       => 'border-color'
                        )
                    ),
                )
            ),
            'button_alignment_setting'       => array( // Section
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
                                'fields'    => array('button_alignment')
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
            'button_settings'       => array( // Section
                'title'             => __('Corners & Padding', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'button_border_radius'    => array(
                        'type'                => 'text',
                        'label'               => __('Round Corners', 'bb-powerpack'),
                        'description'         => 'px',
                        'class'               => 'bb-ff-input input-small',
                        'default'             => '2',
                        'preview'             => array(
                            'type'            => 'css',
                            'selector'        => '.pp-ff-content .frm_style_formidable-style.with_frm_style input[type=submit], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=button], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=reset], .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_submit button',
                            'property'        => 'border-radius',
                            'unit'            => 'px'
                        )
                    ),
                    'button_padding' 	=> array(
                        'type' 			=> 'pp-multitext',
                        'label' 		=> __('Padding', 'bb-powerpack'),
                        'description'   => __( 'px', 'Value unit for font size. Such as: "14 px"', 'bb-powerpack' ),
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
                                'tooltip'       => 'Top',
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style input[type=submit], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=button], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=reset], .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_submit button',
                                    'property'  => 'padding-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => 'Bottom',
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style input[type=submit], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=button], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=reset], .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_submit button',
                                    'property'  => 'padding-bottom',
                                    'unit'      => 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Left', 'bb-powerpack'),
                                'tooltip'       => 'Left',
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style input[type=submit], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=button], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=reset], .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_submit button',
                                    'property'  => 'padding-left',
                                    'unit'      => 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Right', 'bb-powerpack'),
                                'tooltip'       => 'Right',
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style input[type=submit], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=button], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=reset], .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_submit button',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    ),
                )
            ),
        )
    ),
    'form_messages_setting' => array(
        'title' => __('Messages', 'bb-powerpack'),
        'sections'  => array(
            'form_error_styling'    => array( // Section
                'title'             => __('Errors', 'bb-powerpack'), // Section Title
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
                                'fields'    => array('validation_error_bg_color', 'validation_error_border_color', 'validation_error_color', 'validation_error_font_size'),
                                'sections'  => array('errors_typography')
                            )
                        )
                    ),
                    'validation_error_bg_color'    => array(
                        'type'                         => 'color',
                        'label'                        => __('Error Background Color', 'bb-powerpack'),
                        'default'                      => 'f2dede',
                        'show_reset'                   => true,
                        'preview'                      => array(
                            'type'                     => 'css',
                            'selector'                 => '.frm_style_formidable-style.with_frm_style .frm_error_style',
                            'property'                 => 'background-color'
                        )
                    ),
                    'validation_error_color'    => array(
                        'type'                  => 'color',
                        'label'                 => __('Error Description Color', 'bb-powerpack'),
                        'default'               => 'b94a4b',
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.frm_style_formidable-style.with_frm_style .frm_error_style',
                            'property'          => 'color'
                        )
                    ),
					'validation_error_border_color'    => array(
                        'type'                         => 'color',
                        'label'                        => __('Error Border Color', 'bb-powerpack'),
                        'default'                      => 'ebccd1',
                        'show_reset'                   => true,
                        'preview'                      => array(
                            'type'                     => 'css',
                            'selector'                 => '.frm_style_formidable-style.with_frm_style .frm_error_style',
                            'property'                 => 'border-color'
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
                                'fields'    => array('validation_message_color'),
                                'sections'  => array('errors_typography')
                            )
                        )
                    ),
                    'validation_message_color'    => array(
                        'type'                    => 'color',
                        'label'                   => __('Error Field Message Color', 'bb-powerpack'),
                        'default'                 => '790000',
                        'preview'                 => array(
                            'type'                => 'css',
                            'selector'            => '.frm_style_formidable-style.with_frm_style .frm_error',
                            'property'            => 'color'
                        )
                    ),
                )
            ),
            'form_success_styling'    => array( // Section
                'title'             => __('Success Message', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'success_message_bg_color'    => array(
                        'type'                         => 'color',
                        'label'                        => __('Background Color', 'bb-powerpack'),
                        'default'                      => 'dff0d8',
                        'show_reset'                   => true,
                        'preview'                      => array(
                            'type'                     => 'css',
                            'selector'                 => '.frm_style_formidable-style.with_frm_style .frm_message',
                            'property'                 => 'background-color'
                        )
                    ),
                    'success_message_color'    => array(
                        'type'                         => 'color',
                        'label'                        => __('Color', 'bb-powerpack'),
                        'default'                      => '468847',
                        'preview'                      => array(
                            'type'                     => 'css',
                            'selector'                 => '.frm_style_formidable-style.with_frm_style .frm_message',
                            'property'                 => 'color'
                        )
                    ),
					'success_message_border_color'    => array(
                        'type'                         => 'color',
                        'label'                        => __('Border Color', 'bb-powerpack'),
                        'default'                      => 'd6e9c6',
                        'show_reset'                   => true,
                        'preview'                      => array(
                            'type'                     => 'css',
                            'selector'                 => '.frm_style_formidable-style.with_frm_style .frm_message',
                            'property'                 => 'border-color'
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
                            'selector'        => '.pp-ff-content .frm_style_formidable-style.with_frm_style h3.frm_form_title, .pp-ff-content .pp-form-title'
                        )
                    ),
                    'title_text_transform'    => array(
                        'type'                      => 'select',
                        'label'                     => __('Text Transform', 'bb-powerpack'),
                        'default'                   => 'none',
                        'options'                   => array(
                            'none'                  => __('Default', 'bb-powerpack'),
                            'lowercase'                => __('lowercase', 'bb-powerpack'),
                            'uppercase'                 => __('UPPERCASE', 'bb-powerpack'),
                        )
                    ),
                    'title_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Font Size', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  => __('Default', 'bb-powerpack'),
                            'custom'                => __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('title_font_size')
							)
						)
                    ),
                    'title_font_size'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 24,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-ff-content .frm_style_formidable-style.with_frm_style h3.frm_form_title, .pp-ff-content .pp-form-title',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'title_line_height'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 1.4,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-ff-content .frm_style_formidable-style.with_frm_style h3.frm_form_title, .pp-ff-content .pp-form-title',
                                    'property'      => 'line-height',
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'title_color'       => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style h3.frm_form_title, .pp-ff-content .pp-form-title',
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
                            'selector'        => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm_form_title + div.frm_description p, .pp-ff-content .pp-form-description'
                        )
                    ),
                    'description_text_transform'    => array(
                        'type'                      => 'select',
                        'label'                     => __('Text Transform', 'bb-powerpack'),
                        'default'                   => 'none',
                        'options'                   => array(
                            'none'                  => __('Default', 'bb-powerpack'),
                            'lowercase'                => __('lowercase', 'bb-powerpack'),
                            'uppercase'                 => __('UPPERCASE', 'bb-powerpack'),
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm_form_title + div.frm_description p, .pp-ff-content .pp-form-description',
                            'property'          => 'text-transform'
                        )
                    ),
                    'description_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Font Size', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  => __('Default', 'bb-powerpack'),
                            'custom'                => __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('description_font_size')
							)
						)
                    ),
                    'description_font_size'    => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 16,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm_form_title + div.frm_description p, .pp-ff-content .pp-form-description',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'description_line_height'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 1.4,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm_form_title + div.frm_description p, .pp-ff-content .pp-form-description',
                                    'property'      => 'line-height',
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'description_color' => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm_form_title + div.frm_description p, .pp-ff-content .pp-form-description',
                            'property'  => 'color'
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
                            'selector'        => '.pp-ff-content .frm_style_formidable-style.with_frm_style label.frm_primary_label, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field.frm_third div.frm_description, .pp-ff-content .frm_style_formidable-style.with_frm_style label, .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_form_field.frm_html_container'
                        )
                    ),
                    'label_text_transform'    => array(
                        'type'                      => 'select',
                        'label'                     => __('Text Transform', 'bb-powerpack'),
                        'default'                   => 'none',
                        'options'                   => array(
                            'none'                  => __('Default', 'bb-powerpack'),
                            'lowercase'                => __('lowercase', 'bb-powerpack'),
                            'uppercase'                 => __('UPPERCASE', 'bb-powerpack'),
                        )
                    ),
                    'label_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Font Size', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  => __('Default', 'bb-powerpack'),
                            'custom'                => __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('label_font_size')
							)
						)
                    ),
                    'label_font_size'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 18,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-ff-content .frm_style_formidable-style.with_frm_style label.frm_primary_label',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'form_label_color'  => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-ff-content .frm_style_formidable-style.with_frm_style label.frm_primary_label, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field.frm_third div.frm_description, .pp-ff-content .frm_style_formidable-style.with_frm_style label, .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_form_field.frm_html_container',
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
                            'selector'        => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                        )
                    ),
                    'input_text_transform'    => array(
                        'type'                      => 'select',
                        'label'                     => __('Text Transform', 'bb-powerpack'),
                        'default'                   => 'none',
                        'options'                   => array(
                            'none'                  => __('Default', 'bb-powerpack'),
                            'lowercase'                => __('lowercase', 'bb-powerpack'),
                            'uppercase'                 => __('UPPERCASE', 'bb-powerpack'),
                        )
                    ),
                    'input_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Font Size', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  => __('Default', 'bb-powerpack'),
                            'custom'                => __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('input_font_size')
							)
						)
                    ),
                    'input_font_size'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 16,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field select, .pp-ff-content .frm_style_formidable-style.with_frm_style .form-field textarea',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'input_desc_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Description Font Size', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  => __('Default', 'bb-powerpack'),
                            'custom'                => __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('input_desc_font_size')
							)
						)
                    ),
                    'input_desc_font_size'    => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Description Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 14,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input + .frm_description',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'input_desc_line_height'    => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Description Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 1.4,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input + .frm_description',
                                    'property'      => 'line-height',
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                    'input_desc_color'  => array(
                        'type'                  => 'color',
                        'label'                 => __('Description Color', 'bb-powerpack'),
                        'default'               => '000000',
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.pp-ff-content .frm_style_formidable-style.with_frm_style .form-field input + .frm_description',
                            'property'          => 'color'
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
                            'selector'        => '.pp-ff-content .frm_style_formidable-style.with_frm_style input[type=submit], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=button], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=reset], .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_submit button'
                        )
                    ),
                    'button_text_transform'    => array(
                        'type'                      => 'select',
                        'label'                     => __('Text Transform', 'bb-powerpack'),
                        'default'                   => 'none',
                        'options'                   => array(
                            'none'                  => __('Default', 'bb-powerpack'),
                            'lowercase'                => __('lowercase', 'bb-powerpack'),
                            'uppercase'                 => __('UPPERCASE', 'bb-powerpack'),
                        )
                    ),
                    'button_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Font Size', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  => __('Default', 'bb-powerpack'),
                            'custom'                => __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('button_font_size')
							)
						)
                    ),
                    'button_font_size'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 18,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-ff-content .frm_style_formidable-style.with_frm_style input[type=submit], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=button], .pp-ff-content .frm_style_formidable-style.with_frm_style input[type=reset], .pp-ff-content .frm_style_formidable-style.with_frm_style .frm_submit button',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                )
            ),
            'section_field_typography'       => array( // Section
                'title'         => __('Section Field', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'section_field_font_family' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3'
                        )
                    ),
                    'section_field_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Font Size', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  => __('Default', 'bb-powerpack'),
                            'custom'                => __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('section_field_font_size')
							)
						)
                    ),
                    'section_field_font_size'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 18,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-ff-content .frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                )
            ),
            'errors_typography'       => array( // Section
                'title'         => __('Error', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'validation_error_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Description Font Size', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  => __('Default', 'bb-powerpack'),
                            'custom'                => __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('validation_error_font_size')
							)
						)
                    ),
                    'validation_error_font_size'    => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Description Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 14,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.frm_style_formidable-style.with_frm_style .frm_error_style',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                )
            ),
            'form_success_styling'    => array( // Section
                'title'             => __('Success Message', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'success_message_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Font Size', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  => __('Default', 'bb-powerpack'),
                            'custom'                => __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('success_message_font_size')
							)
						)
                    ),
                    'success_message_font_size'    => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   => 14,
                            'tablet'   => '',
                            'mobile'   => '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.frm_style_formidable-style.with_frm_style .frm_message',
                                    'property'      => 'font-size',
                                    'unit'          => 'px'
                                ),
                            ),
                            'tablet'   => array(
                                'placeholder'   => __('Tablet', 'bb-powerpack'),
                                'icon'          => 'fa-tablet',
                                'maxlength'     => 3,
                                'tooltip'       => __('Tablet', 'bb-powerpack')
                            ),
                            'mobile'   => array(
                                'placeholder'   => __('Mobile', 'bb-powerpack'),
                                'icon'          => 'fa-mobile',
                                'maxlength'     => 3,
                                'tooltip'       => __('Mobile', 'bb-powerpack')
                            ),
                        ),
                    ),
                )
            ),
        )
    )
));
