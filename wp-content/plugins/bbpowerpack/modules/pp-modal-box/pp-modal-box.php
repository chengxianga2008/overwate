<?php

/**
 * @class PPModalBoxModule
 */
class PPModalBoxModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Modal Box', 'bb-powerpack'),
            'description'   => __('Custom modal boxes with animation.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-modal-box/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-modal-box/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));

        if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
            $this->add_css( 'modal-settings-style', $this->url . 'css/settings.css' );
            $this->add_js( 'modal-settings-script', $this->url . 'js/settings.js', array(), '', true );
        }
        $this->add_js( 'jquery-cookie', $this->url . 'js/jquery.cookie.min.js', array('jquery') );
    }

    public static function get_saved_templates()
    {
        if ( is_admin() && isset( $_GET['page'] ) && 'pp-settings' == $_GET['page'] ) {
            return;
        }

        $templates = get_posts( array(
			'post_type' 				=> 'fl-builder-template',
			'orderby' 					=> 'title',
			'order' 					=> 'ASC',
			'posts_per_page' 			=> '-1'
		) );
        $options = array();
        if (count($templates)) {
            foreach ($templates as $template) {
                $options[$template->ID] = $template->post_title;
            }
        }

        return $options;
    }

    public function get_modal_content( $settings )
    {
        $modal_type = $settings->modal_type;

        switch($modal_type) {
            case 'photo':
                if ( isset( $settings->modal_type_photo_src ) ) {
                    return '<img src="' . $settings->modal_type_photo_src . '" style="max-width: 100%;"/>';
                }
            break;
            case 'video':
                global $wp_embed;
                return $wp_embed->autoembed($settings->modal_type_video);
            break;
            case 'url':
                return '<iframe data-src="' . $settings->modal_type_url . '" class="pp-modal-iframe" frameborder="0" width="100%" height="100%"></iframe>';
            break;
            case 'content':
                return $settings->modal_type_content;
            break;
            case 'html':
                return $settings->modal_type_html;
            break;
            case 'templates':
                return '[fl_builder_insert_layout id="'.$settings->modal_type_templates.'" type="fl-builder-template"]';
            break;
            default:
                return;
            break;
        }
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPModalBoxModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'modal_box'       => array( // Section
                'title'             => __('Modal', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'modal_layout'      => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Layout', 'bb-powerpack'),
                        'default'           => 'standard',
                        'options'           => array(
                            'standard'          => __('Standard', 'bb-powerpack'),
                            'fullscreen'        => __('Fullscreen', 'bb-powerpack')
                        ),
                        'toggle'            => array(
                            'standard'          => array(
                                'fields'            => array('modal_border', 'modal_border_radius', 'modal_width', 'modal_height_auto'),
                            ),
                            'fullscreen'        => array(
                                'fields'            => array('modal_margin_top', 'modal_margin_bottom', 'modal_margin_left', 'modal_margin_right')
                            )
                        ),
                        'hide'              => array(
                            'fullscreen'        => array(
                                'fields'            => array('modal_border', 'modal_border_radius')
                            )
                        ),
                        'help'              => __('Stying options are available in Modal Style tab.', 'bb-powerpack')
                    ),
                    'modal_width'       => array(
                        'type'              => 'text',
                        'label'             => __('Width', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 550,
                    ),
                    'modal_height_auto' => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Auto Height', 'bb-powerpack'),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'           => __('Yes', 'bb-powerpack'),
                            'no'            => __('No', 'bb-powerpack')
                        ),
                        'toggle'        => array(
                            'no'            => array(
                                'fields'        => array('modal_height')
                            )
                        )
                    ),
                    'modal_height'      => array(
                        'type'              => 'text',
                        'label'             => __('Height', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 450,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal',
                            'property'          => 'height',
                            'unit'              => 'px'
                        )
                    ),
                    'modal_preview'         => array(
                        'type'                  => 'pp-switch',
                        'label'                 => __('Show Preview', 'bb-powerpack'),
                        'default'               => 'enabled',
                        'options'               => array(
                            'enabled'               => __('Yes', 'bb-powerpack'),
                            'disabled'              => __('No', 'bb-powerpack')
                        ),
                        'help'                  => __('You will be able to see the modal box preview by enabling this option.', 'bb-powerpack')
                    ),
                )
            ),
            'modal_content' => array(
                'title'         => __('Content', 'bb-powerpack'),
                'fields'        => array(
                    'modal_title_toggle'    => array(
                        'type'                  => 'pp-switch',
                        'label'                 => __('Enable Title', 'bb-powerpack'),
                        'default'               => 'yes',
                        'options'               => array(
                            'yes'                   => __('Yes', 'bb-powerpack'),
                            'no'                    => __('No', 'bb-powerpack')
                        ),
                        'toggle'                => array(
                            'yes'                   => array(
                                'fields'                => array('modal_title'),
                                'sections'              => array('modal_title')
                            )
                        ),
                        'trigger'               => array(
                            'yes'                   => array(
                                'fields'                => array('button_type')
                            ),
                            'no'                    => array(
                                'fields'                => array('button_type')
                            )
                        )
                    ),
                    'modal_title'      => array(
                        'type'          => 'text',
                        'label'         => __('Title', 'bb-powerpack'),
                        'default'       => __('Modal Title', 'bb-powerpack'),
                        'connections'   => array( 'string', 'html', 'url' ),
                        'preview'       => array(
                            'type'          => 'text',
                            'selector'      => '.pp-modal-title'
                        )
                    ),
                    'modal_type'       => array(
                        'type'          => 'select',
                        'label'         => __('Type', 'bb-powerpack'),
                        'default'       => 'photo',
                        'options'       => array(
                            'photo'         => __('Photo', 'bb-powerpack'),
                            'video'         => __('Video', 'bb-powerpack'),
                            'url'           => __('URL', 'bb-powerpack'),
                            'content'       => __('Content', 'bb-powerpack'),
                            'html'          => __('Raw HTML', 'bb-powerpack'),
                            'templates'     => __('Saved Templates', 'bb-powerpack')
                        ),
                        'toggle'        => array(
                            'photo'        => array(
                                'fields'        => array('modal_type_photo')
                            ),
                            'video'         => array(
                                'fields'        => array('modal_type_video')
                            ),
                            'url'           => array(
                                'fields'        => array('modal_type_url')
                            ),
                            'content'       => array(
                                'fields'        => array('modal_type_content')
                            ),
                            'html'          => array(
                                'fields'        => array('modal_type_html')
                            ),
                            'templates'     => array(
                                'fields'        => array('modal_type_templates')
                            )
                        )
                    ),
                    'modal_type_photo'     => array(
                        'type'                  => 'photo',
                        'label'                 => __('Photo', 'bb-powerpack'),
                        'connections'           => array( 'photo' ),
                    ),
                    'modal_type_video'     => array(
                        'type'                  => 'textarea',
                        'label'                 => __('Embed Code / URL', 'bb-powerpack'),
                        'rows'                  => 6
                    ),
                    'modal_type_url'       => array(
                        'type'                  => 'text',
                        'label'                 => __('URL', 'bb-powerpack'),
                        'placeholder'           => 'http://www.example.com',
                        'default'               => '',
                        'connections'           => array( 'url' ),
                    ),
                    'modal_type_content'   => array(
                        'type'                  => 'editor',
                        'label'                 => '',
                        'connections'           => array( 'string', 'html', 'url' ),
                        'preview'               => array(
							'type'                  => 'text',
							'selector'              => '.pp-modal-content-inner'
						)
                    ),
                    'modal_type_html'      => array(
                        'type'                  => 'code',
                        'editor'                => 'html',
                        'label'                 => '',
                        'rows'                  => 15,
                        'connections'           => array( 'string', 'html', 'url' ),
                        'preview'               => array(
							'type'                  => 'text',
							'selector'              => '.pp-modal-content'
						)
                    ),
                    'modal_type_templates'      => array(
                        'type'                  => 'select',
                        'label'                 => __('Select Template', 'bb-powerpack'),
                        'options'               => PPModalBoxModule::get_saved_templates()
                    )
                )
            )
        )
    ),
    'settings'       => array( // Tab
        'title'         => __('Settings', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'modal_load'    => array(
                'title'         => __('Trigger', 'bb-powerpack'),
                'fields'        => array(
                    'modal_load'           => array(
                        'type'                  => 'pp-switch',
                        'label'                 => __('Trigger', 'bb-powerpack'),
                        'default'               => 'auto',
                        'options'               => array(
							'auto'                  => __('Auto', 'bb-powerpack'),
							'onclick'               => __('On Click', 'bb-powerpack'),
                            'exit_intent'           => __('Exit Intent', 'bb-powerpack'),
                            'other'                 => __('Other', 'bb-powerpack')
						),
                        'toggle'            => array(
                            'auto'              => array(
                                'sections'          => array('modal_load_auto')
                            ),
                            'onclick'           => array(
                                'sections'          => array('modal_load_onclick','modal_button_style'),
                                'tabs'               => array('modal_button_style'),
                            ),
                            'exit_intent'       => array(
                                'sections'          => array('modal_exit_intent')
                            ),
                            'other'             => array(
                                'fields'             => array('modal_css_class')
                            )
                        ),
                        'hide'              => array(
                            'auto'              => array(
                                'sections'          => array('modal_button_style'),
                                'tabs'              => array('modal_button_style'),
                            ),
                            'exit_intent'       => array(
                                'sections'          => array('modal_button_style'),
                                'tabs'              => array('modal_button_style'),
                            ),
                        ),
                        'help'              => __('Other - modal can be triggered through any other element(s) on this page by providing modal CSS class to that element.', 'bb-powerpack')
                    ),
                    'modal_css_class'       => array(
                        'type'                  => 'text',
                        'label'                 => __('CSS Class', 'bb-powerpack'),
                        'default'               => '',
                        'disabled'              => 'disabled',
                        'class'                 => 'modal-trigger-class',
                        'help'                  => __('Add this CSS class to the element you want to trigger the modal with.', 'bb-powerpack')
                    )
                )
            ),
            'modal_load_auto'   => array(
                'title'             => __('Auto Load Settings', 'bb-powerpack'),
                'fields'            => array(
                    'modal_delay'       => array(
                        'type'              => 'text',
                        'label'             => __('Delay', 'bb-powerpack'),
                        'description'       => __('seconds', 'bb-powerpack'),
                        'class'             => 'input-small',
                        'default'           => 1,
                    ),
                    'display_after_auto'    => array(
                        'type'                  => 'text',
                        'label'                 => __('Display After', 'bb-powerpack'),
                        'default'               => 1,
                        'description'           => __('day(s)', 'bb-powerpack'),
                        'help'                  => __('If a user closes the modal box, it will be displayed only after the defined day(s).', 'bb-powerpack'),
                        'class'                 => 'input-small modal-display-after'
                    )
                )
            ),
            'modal_load_onclick'  => array(
                'title'             => __('On Click Settings', 'bb-powerpack'),
                'fields'            => array(
                    'button_type'       => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Type', 'bb-powerpack'),
                        'default'           => 'button',
                        'options'           => array(
                            'button'            => __('Button', 'bb-powerpack'),
                            'image'             => __('Image', 'bb-powerpack'),
                            'icon'              => __('Icon', 'bb-powerpack')
                        ),
                        'toggle'            => array(
                            'button'            => array(
                                'fields'            => array('button_text', 'button_icon_src', 'button_icon_pos', 'button_font_family', 'button_font_size', 'button_text_color', 'button_text_hover', 'button_color', 'button_color_hover', 'button_opacity', 'button_opacity_hover', 'button_padding_left_right', 'button_padding_top_bottom', 'button_width'),
                                'sections'          => array('modal_button_bg')
                            ),
                            'icon'              => array(
                                'fields'            => array('icon_source', 'icon_size', 'button_text_color', 'button_text_hover', 'button_color', 'button_color_hover', 'button_opacity', 'button_opacity_hover', 'button_padding_left_right', 'button_padding_top_bottom', 'button_width'),
                                'sections'          => array('modal_button_bg')
                            ),
                            'image'             => array(
                                'fields'            => array('image_source', 'image_size')
                            )
                        ),
                        'hide'              => array(
                            'button'            => array(
                                'fields'            => array('image_width', 'image_height')
                            ),
                            'icon'              => array(
                                'fields'            => array('image_width', 'image_height')
                            ),
                            'image'             => array(
                                'sections'          => array('modal_button_style', 'modal_button_bg')
                            )
                        ),
                        'help'              => __('Styling options are available in Button Style tab.', 'bb-powerpack')
                    ),
                    'image_source'      => array(
                        'type'              => 'photo',
                        'label'             => __('Source', 'bb-powerpack'),
                        'connections'       => array( 'photo' ),
                    ),
                    'icon_source'       => array(
                        'type'              => 'icon',
                        'label'             => __('Icon Source', 'bb-powerpack')
                    ),
                    'button_text'       => array(
                        'type'              => 'text',
                        'label'             => __('Button Text', 'bb-powerpack'),
                        'default'           => __('Click Here', 'bb-powerpack'),
                        'preview'           => array(
                            'type'              => 'text',
                            'selector'          => '.pp-modal-trigger'
                        )
                    ),
                    'button_icon_src'   => array(
						'type'              => 'icon',
						'label'             => __('Icon', 'bb-powerpack'),
						'show_remove'       => true
					),
					'button_icon_pos'   => array(
						'type'              => 'pp-switch',
						'label'             => __('Icon Position', 'bb-powerpack'),
						'default'           => 'before',
						'options'           => array(
							'before'            => __('Before Text', 'bb-powerpack'),
							'after'             => __('After Text', 'bb-powerpack')
						)
					)
                )
            ),
            'modal_exit_intent'  => array(
                'title'             => __('Exit Intent Settings', 'bb-powerpack'),
                'fields'            => array(
                    'display_after'      => array(
                        'type'              => 'text',
                        'label'             => __('Display After', 'bb-powerpack'),
                        'default'           => 1,
                        'description'       => __('day(s)', 'bb-powerpack'),
                        'help'              => __('If a user closes the modal box, it will be displayed only after the defined day(s).', 'bb-powerpack'),
                        'class'             => 'input-small modal-display-after'
                    )
                )
            ),
            'modal_esc_exit'    => array(
                'title'             => __('Exit Settings', 'bb-powerpack'),
                'fields'            => array(
                    'modal_esc'         => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Esc to Exit', 'bb-powerpack'),
                        'default'           => 'enabled',
                        'options'           => array(
                            'enabled'           => __('Yes', 'bb-powerpack'),
                            'disabled'          => __('No', 'bb-powerpack')
                        ),
                        'help'              => __('Users can close the modal box by pressing Esc key.', 'bb-powerpack')
                    ),
                    'modal_click_exit'  => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Click to Exit', 'bb-powerpack'),
                        'default'           => 'yes',
                        'options'           => array(
                            'yes'               => __('Yes', 'bb-powerpack'),
                            'no'                => __('No', 'bb-powerpack'),
                        ),
                        'help'              => __('Users can close the modal box by clicking anywhere outside the modal.', 'bb-powerpack')
                    )
                )
            )
        )
    ),
    'modal_button_style' => array( // Tab
        'title'             => __('Button Style', 'bb-powerpack'), // Tab title
        'sections'          => array( // Tab Sections
            'modal_button_style' => array(
                'title'             => __('Button', 'bb-powerpack'),
                'fields'            => array(
                    'button_font_family' => array(
                        'type'              => 'font',
                        'default'		    => array(
                            'family'		    => 'Default',
                            'weight'		    => 400
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-modal-trigger .pp-modal-trigger-text'
                        )
                    ),
                    'button_font_size'  => array(
                        'type'              => 'text',
                        'label'             => __('Font Size', 'bb-powerpack'),
                        'default'           => 16,
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-trigger span',
                            'property'          => 'font-size',
                            'unit'              => 'px'
                        )
                    ),
                    'button_text_color' => array(
                        'type'              => 'color',
                        'label'             => __('Color', 'bb-powerpack'),
                        'default'           => 'ffffff',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-trigger',
                            'property'          => 'color'
                        )
                    ),
                    'button_text_hover' => array(
                        'type'              => 'color',
                        'label'             => __('Color Hover', 'bb-powerpack'),
                        'default'           => 'f7f7f7',
                    ),
                )
            ),
            'modal_button_bg'   => array(
                'title'                 => __('Background', 'bb-powerpack'),
                'fields'                => array(
                    'button_color'      => array(
                        'type'              => 'color',
                        'label'             => __('Background Color', 'bb-powerpack'),
                        'default'           => '428bca',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-trigger',
                            'property'          => 'background-color'
                        )
                    ),
                    'button_color_hover' => array(
                        'type'              => 'color',
                        'label'             => __('Background Color Hover', 'bb-powerpack'),
                        'default'           => '444444',
                    ),
                    'button_opacity'     => array(
                        'type'              => 'text',
                        'label'             => __('Background Opacity', 'bb-powerpack'),
                        'description'       => __('between 0 to 1', 'bb-powerpack'),
                        'class'             => 'input-small',
                        'default'           => 1
                    ),
                    'button_opacity_hover'  => array(
                        'type'                  => 'text',
                        'label'                 => __('Background Opacity Hover', 'bb-powerpack'),
                        'description'           => __('between 0 to 1', 'bb-powerpack'),
                        'class'                 => 'input-small',
                        'default'               => 1
                    ),
                )
            ),
            'modal_button_borders'  => array(
                'title'                 => __('Border', 'bb-powerpack'),
                'fields'                => array(
                    'button_border'         => array(
                        'type'                  => 'pp-switch',
                        'label'                 => __('Enable Border', 'bb-powerpack'),
                        'default'               => 'yes',
                        'options'               => array(
                            'yes'                   => __('Yes', 'bb-powerpack'),
                            'no'                    => __('No', 'bb-powerpack')
                        ),
                        'toggle'                => array(
                            'yes'                   => array(
                                'fields'                => array('button_border_width', 'button_border_color', 'button_border_color_hover')
                            )
                        )
                    ),
                    'button_border_width'   => array(
                        'type'                  => 'text',
                        'label'                 => __('Border Width', 'bb-powerpack'),
                        'description'           => 'px',
                        'class'                 => 'input-small',
                        'default'               => 1,
                        'preview'               => array(
                            'type'                  => 'css',
                            'selector'              => '.pp-modal-trigger',
                            'property'              => 'border-width',
                            'unit'                  => 'px'
                        )
                    ),
                    'button_border_color' => array(
                        'type'              => 'color',
                        'label'             => __('Border Color', 'bb-powerpack'),
                        'default'           => '2d6ca2',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-trigger',
                            'property'          => 'border-color'
                        )
                    ),
                    'button_border_color_hover' => array(
                        'type'                      => 'color',
                        'label'                     => __('Border Color Hover', 'bb-powerpack'),
                        'default'                   => '222222',
                    ),
                    'button_border_radius' => array(
                        'type'              => 'text',
                        'label'             => __('Round Corners', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 2,
                        'preview'           => array(
                            'type'              => 'css',
                            'rules'             => array(
                                array(
                                    'selector'          => '.pp-modal-trigger',
                                    'property'          => 'border-radius',
                                    'unit'              => 'px'
                                ),
                                array(
                                    'selector'          => '.pp-modal-trigger img',
                                    'property'          => 'border-radius',
                                    'unit'              => 'px'
                                )
                            )
                        )
                    ),
                )
            ),
            'modal_button_size' => array(
                'title'             => __('Size & Alignment', 'bb-powerpack'),
                'fields'            => array(
                    'image_size'        => array(
                        'type'              => 'select',
                        'label'             => __('Size', 'bb-powerpack'),
                        'default'           => 'auto',
                        'options'           => array(
                            'auto'              => __('Auto', 'bb-powerpack'),
                            'custom'            => __('Custom', 'bb-powerpack')
                        ),
                        'toggle'            => array(
                            'custom'            => array(
                                'fields'            => array('image_width', 'image_height')
                            )
                        )
                    ),
                    'image_width'       => array(
                        'type'              => 'text',
                        'label'             => __('Width', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 200,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-trigger img',
                            'property'          => 'width',
                            'unit'              => 'px'
                        )
                    ),
                    'image_height'      => array(
                        'type'              => 'text',
                        'label'             => __('Height', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 200,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-trigger img',
                            'property'          => 'height',
                            'unit'              => 'px'
                        )
                    ),
                    'icon_size'    => array(
                        'type'              => 'text',
                        'label'             => __('Icon Size', 'bb-powerpack'),
                        'default'           => 40,
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-trigger-icon',
                            'property'          => 'font-size',
                            'unit'              => 'px'
                        )
                    ),
                    'button_padding'    => array(
                        'type'              => 'pp-multitext',
                        'label'             => __('Padding', 'bb-powerpack'),
                        'description'       => 'px',
                        'default'           => array(
                            'top'               => 15,
                            'bottom'            => 15,
                            'left'              => 15,
                            'right'             => 15
                        ),
                        'options'           => array(
                            'top'               => array(
                                'placeholder'       => __('Top', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-up',
                                'tooltip'           => __('Top', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'          => '.pp-modal-trigger',
                                    'property'          => 'padding-top',
                                    'unit'              => 'px'
                                )
                            ),
                            'bottom'            => array(
                                'placeholder'       => __('Bottom', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-down',
                                'tooltip'           => __('Bottom', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'          => '.pp-modal-trigger',
                                    'property'          => 'padding-bottom',
                                    'unit'              => 'px'
                                )
                            ),
                            'left'              => array(
                                'placeholder'       => __('Left', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-left',
                                'tooltip'           => __('Left', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'          => '.pp-modal-trigger',
                                    'property'          => 'padding-left',
                                    'unit'              => 'px'
                                )
                            ),
                            'right'             => array(
                                'placeholder'       => __('Right', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-right',
                                'tooltip'           => __('Right', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'          => '.pp-modal-trigger',
                                    'property'          => 'padding-right',
                                    'unit'              => 'px'
                                )
                            ),
                        )
                    ),
                    'button_width'      => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Width', 'bb-powerpack'),
                        'default'           => 'auto',
                        'options'           => array(
                            'auto'              => __('Auto', 'bb-powerpack'),
                            'full'              => __('Full Width', 'bb-powerpack')
                        )
                    ),
                    'button_alignment'  => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Alignment', 'bb-powerpack'),
                        'default'           => 'left',
                        'options'           => array(
                            'left'              => __('Left', 'bb-powerpack'),
                            'center'            => __('Center', 'bb-powerpack'),
                            'right'             => __('Right', 'bb-powerpack'),
                        )
                    )
                )
            )
        )
    ),
    'style'       => array( // Tab
        'title'         => __('Modal Style', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'modal_title'   => array( // Section
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
                            'selector'        => '.pp-modal-title'
                        )
                    ),
                    'title_font_size'   => array(
                        'type'              => 'text',
                        'label'             => __('Font Size', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => '18',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-title',
                            'property'          => 'font-size',
                            'unit'              => 'px'
                        )
                    ),
                    'title_color'       => array(
                        'type'              => 'color',
                        'label'             => __('Color', 'bb-powerpack'),
                        'default'           => '444444',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-title',
                            'property'          => 'color'
                        )
                    ),
                    'title_bg'          => array(
                        'type'              => 'color',
                        'label'             => __('Background Color', 'bb-powerpack'),
                        'default'           => 'ffffff',
                        'show_reset'        => true,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-header',
                            'property'          => 'background-color'
                        )
                    ),
                    'title_border'      => array(
                        'type'              => 'text',
                        'label'             => __('Border Bottom', 'bb-powerpack'),
                        'default'           => 1,
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-header',
                            'property'          => 'border-bottom-width',
                            'unit'              => 'px'
                        )
                    ),
                    'title_border_style' => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Border Style', 'bb-powerpack'),
                        'default'           => 'solid',
                        'options'           => array(
                            'solid'         => __('Solid', 'bb-powerpack'),
                            'dashed'        => __('Dashed', 'bb-powerpack'),
                            'dotted'        => __('Dotted', 'bb-powerpack'),
                        ),
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-header',
                            'property'          => 'border-bottom-style'
                        )
                    ),
                    'title_border_color' => array(
                        'type'              => 'color',
                        'label'             => __('Border Color', 'bb-powerpack'),
                        'default'           => 'eeeeee',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-header',
                            'property'          => 'border-bottom-color'
                        )
                    ),
                    'title_padding'     => array(
                        'type'              => 'text',
                        'label'             => __('Side Padding', 'bb-powerpack'),
                        'default'           => 15,
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'preview'           => array(
                            'type'              => 'css',
                            'rules'             => array(
                                array(
                                    'selector'          => '.pp-modal-title',
                                    'property'          => 'padding-left',
                                    'unit'              => 'px'
                                ),
                                array(
                                    'selector'          => '.pp-modal-title',
                                    'property'          => 'padding-right',
                                    'unit'              => 'px'
                                )
                            )
                        )
                    ),
                    'title_alignment'   => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Alignment', 'bb-powerpack'),
                        'default'           => 'left',
                        'options'           => array(
                            'left'              => __('Left', 'bb-powerpack'),
                            'center'            => __('Center', 'bb-powerpack'),
                            'right'             => __('Right', 'bb-powerpack'),
                        ),
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-title',
                            'property'          => 'text-align'
                        )
                    )
                )
            ),
            'modal_bg'          => array( // Section
                'title'             => __('Background', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'modal_background'  => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Background Type', 'bb-powerpack'),
                        'default'           => 'color',
                        'options'           => array(
                            'color'             => __('Color', 'bb-powerpack'),
                            'photo'             => __('Image', 'bb-powerpack')
                        ),
                        'toggle'            => array(
                            'color'             => array(
                                'fields'            => array('modal_bg_color', 'modal_bg_opacity')
                            ),
                            'photo'             => array(
                                'fields'            => array('modal_bg_photo', 'modal_bg_size', 'modal_bg_repeat')
                            )
                        )
                    ),
                    'modal_bg_color'    => array(
                        'type'              => 'color',
                        'label'             => __('Background Color', 'bb-powerpack'),
                        'default'           => 'ffffff',
                        'show_reset'        => true,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal',
                            'property'          => 'background-color'
                        )
                    ),
                    'modal_bg_opacity'  => array(
                        'type'              => 'text',
                        'label'             => __('Opacity', 'bb-powerpack'),
                        'default'           => 1,
                        'class'             => 'input-small',
                        'description'       => __('between 0 to 1', 'bb-powerpack'),
                    ),
                    'modal_bg_photo'    => array(
                        'type'              => 'photo',
                        'label'             => __('Background Image', 'bb-powerpack'),
                        'default'           => '',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal',
                            'property'          => 'background-image'
                        )
                    ),
                    'modal_bg_size'     => array(
                        'type'          => 'select',
                        'label'         => __('Background Size', 'bb-powerpack'),
                        'default'       => 'cover',
                        'options'       => array(
                            'contain'   => __('Contain', 'bb-powerpack'),
                            'cover'     => __('Cover', 'bb-powerpack'),
                        ),
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal',
                            'property'          => 'background-size'
                        )
                    ),
                    'modal_bg_repeat'   => array(
                        'type'          => 'select',
                        'label'         => __('Background Repeat', 'bb-powerpack'),
                        'default'       => 'no-repeat',
                        'options'       => array(
                            'repeat-x'      => __('Repeat X', 'bb-powerpack'),
                            'repeat-y'      => __('Repeat Y', 'bb-powerpack'),
                            'no-repeat'     => __('No Repeat', 'bb-powerpack'),
                        ),
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal',
                            'property'          => 'background-repeat'
                        )
                    ),
                    'modal_backlight'   => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Backlight Effect', 'bb-powerpack'),
                        'default'           => 'disabled',
                        'options'           => array(
                            'enabled'           => __('Yes', 'bb-powerpack'),
                            'disabled'          => __('No', 'bb-powerpack')
                        ),
                        'help'              => __('A color shadow of background image. It may incompatible with some browsers.', 'bb-powerpack')
                    )
                )
            ),
            'modal_box'         => array( // Section
                'title'             => __('Box', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'modal_border'      => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Border', 'bb-powerpack'),
                        'default'           => 'none',
                        'options'           => array(
                            'none'              => __('None', 'bb-powerpack'),
                            'dashed'            => __('Dashed', 'bb-powerpack'),
                            'dotted'            => __('Dotted', 'bb-powerpack'),
                            'solid'             => __('Solid', 'bb-powerpack'),
                        ),
                        'toggle'        => array(
                            'dashed'        => array(
                                'fields'        => array('modal_border_width', 'modal_border_color', 'modal_border_position')
                            ),
                            'dotted'        => array(
                                'fields'        => array('modal_border_width', 'modal_border_color', 'modal_border_position')
                            ),
                            'solid'         => array(
                                'fields'        => array('modal_border_width', 'modal_border_color', 'modal_border_position')
                            )
                        )
                    ),
                    'modal_border_width' => array(
                        'type'              => 'text',
                        'label'             => __('Border Width', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 1,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal',
                            'property'          => 'border-width',
                            'unit'              => 'px'
                        )
                    ),
                    'modal_border_color' => array(
                        'type'              => 'color',
                        'label'             => __('Border Color', 'bb-powerpack'),
                        'default'           => 'ffffff',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal',
                            'property'          => 'border-color'
                        )
                    ),
                    'modal_border_position' => array(
                        'type'              => 'select',
                        'label'             => __('Border Position', 'bb-powerpack'),
                        'default'           => 'default',
                        'options'		    => array(
                       	    'default'	        => __('Default', 'bb-powerpack'),
                       		'top'	            => __('Top', 'bb-powerpack'),
                        	'bottom'		    => __('Bottom', 'bb-powerpack'),
                        	'left'		        => __('Left', 'bb-powerpack'),
                        	'right'		        => __('Right', 'bb-powerpack')
                        )
                    ),
                    'modal_border_radius' 	=> array(
                        'type'                  => 'text',
                        'label'                 => __('Round Corners', 'bb-powerpack'),
                        'description'           => 'px',
                        'default'               => 2,
                        'class'                 => 'input-small',
                        'preview'               => array(
                            'type'                  => 'css',
                            'rules'                 => array(
                                array(
                                    'selector'              => '.pp-modal',
                                    'property'              => 'border-radius',
                                    'unit'                  => 'px'
                                ),
                                array(
                                    'selector'              => '.pp-modal .pp-modal-header',
                                    'property'              => 'border-top-left-radius',
                                    'unit'                  => 'px'
                                ),
                                array(
                                    'selector'              => '.pp-modal .pp-modal-header',
                                    'property'              => 'border-top-right-radius',
                                    'unit'                  => 'px'
                                )
                            )
                        )
                    ),
                    'modal_padding'     => array(
                        'type'              => 'text',
                        'label'             => __('Padding', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 10,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-content',
                            'property'          => 'padding',
                            'unit'              => 'px'
                        )
                    ),
                    'modal_margin_top'  => array(
                        'type'              => 'text',
                        'label'             => __('Margin Top', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 0,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal',
                            'property'          => 'margin-top',
                            'unit'              => 'px'
                        )
                    ),
                    'modal_margin_bottom' => array(
                        'type'              => 'text',
                        'label'             => __('Margin Bottom', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 0,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal',
                            'property'          => 'margin-bottom',
                            'unit'              => 'px'
                        )
                    ),
                    'modal_margin_left' => array(
                        'type'              => 'text',
                        'label'             => __('Margin Left', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 0,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal',
                            'property'          => 'margin-left',
                            'unit'              => 'px'
                        )
                    ),
                    'modal_margin_right' => array(
                        'type'              => 'text',
                        'label'             => __('Margin Right', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 0,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal',
                            'property'          => 'margin-right',
                            'unit'              => 'px'
                        )
                    ),
                    'modal_shadow'      => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Enable Shadow', 'bb-powerpack'),
                        'default'           => 'no',
                        'options'           => array(
                            'yes'               => __('Yes', 'bb-powerpack'),
                            'no'               => __('No', 'bb-powerpack')
                        ),
                        'toggle'            => array(
                            'yes'               => array(
                                'sections'         => array('modal_box_shadow')
                            )
                        )
                    )
                )
            ),
            'modal_box_shadow'   => array( // Section
                'title'             => __('Box Shadow', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'box_shadow_h'      => array(
                        'type'              => 'text',
                        'label'             => __('Horizontal', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 0,
                    ),
                    'box_shadow_v'      => array(
                        'type'              => 'text',
                        'label'             => __('Vertical', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 0,
                    ),
                    'box_shadow_blur'   => array(
                        'type'              => 'text',
                        'label'             => __('Blur', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 18,
                    ),
                    'box_shadow_spread' => array(
                        'type'              => 'text',
                        'label'             => __('Spread', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 2,
                    ),
                    'box_shadow_color' => array(
                        'type'              => 'color',
                        'label'             => __('Color', 'bb-powerpack'),
                        'default'           => '000000',
                    ),
                    'box_shadow_opacity' => array(
                        'type'              => 'text',
                        'label'             => __('Opacity', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 0.5,
                    ),
                )
            ),
            'modal_content'      => array( // Section
                'title'             => __('Content', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'content_border'     => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Border', 'bb-powerpack'),
                        'default'           => 'none',
                        'options'           => array(
                            'none'              => __('None', 'bb-powerpack'),
                            'dashed'            => __('Dashed', 'bb-powerpack'),
                            'dotted'            => __('Dotted', 'bb-powerpack'),
                            'solid'             => __('Solid', 'bb-powerpack'),
                        ),
                        'toggle'        => array(
                            'dashed'        => array(
                                'fields'        => array('content_border_width', 'content_border_color', 'content_border_radius')
                            ),
                            'dotted'        => array(
                                'fields'        => array('content_border_width', 'content_border_color', 'content_border_radius')
                            ),
                            'solid'         => array(
                                'fields'        => array('content_border_width', 'content_border_color', 'content_border_radius')
                            )
                        ),
                        'trigger'       => array(
                            'dashed'        => array(
                                'fields'        => array('content_border_width', 'content_border_color')
                            ),
                            'dotted'        => array(
                                'fields'        => array('content_border_width', 'content_border_color')
                            ),
                            'solid'         => array(
                                'fields'        => array('content_border_width', 'content_border_color')
                            )
                        )
                    ),
                    'content_border_width' => array(
                        'type'              => 'text',
                        'label'             => __('Border Width', 'bb-powerpack'),
                        'description'       => 'px',
                        'class'             => 'input-small',
                        'default'           => 1,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-content-inner',
                            'property'          => 'border-width',
                            'unit'              => 'px'
                        )
                    ),
                    'content_border_color' => array(
                        'type'              => 'color',
                        'label'             => __('Border Color', 'bb-powerpack'),
                        'default'           => '555555',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-content-inner',
                            'property'          => 'border-color'
                        )
                    ),
                    'content_border_radius'  => array(
                        'type'                  => 'text',
                        'label'                 => __('Border Radius', 'bb-powerpack'),
                        'description'           => 'px',
                        'default'               => 0,
                        'class'                 => 'input-small',
                        'preview'               => array(
                            'type'                  => 'css',
                            'selector'              => '.pp-modal-content-inner',
                            'property'              => 'border-radius',
                            'unit'                  => 'px'
                        )
                    ),
                    'content_text_color'     => array(
                        'type'                  => 'color',
                        'label'                 => __('Text Color', 'bb-powerpack'),
                        'show_reset'            => true
                    ),
                    'content_padding'        => array(
                        'type'                  => 'text',
                        'label'                 => __('Padding', 'bb-powerpack'),
                        'description'           => 'px',
                        'default'               => 10,
                        'class'                 => 'input-small',
                        'preview'               => array(
                            'type'                  => 'css',
                            'selector'              => '.pp-modal-content-inner',
                            'property'              => 'padding',
                            'unit'                  => 'px'
                        )
                    )
                )
            ),
            'modal_overlay'      => array( // Section
                'title'             => __('Overlay', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'overlay_toggle'    => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Overlay', 'bb-powerpack'),
                        'default'           => 'block',
                        'options'           => array(
                            'block'             => __('Show', 'bb-powerpack'),
                            'none'              => __('Hide', 'bb-powerpack')
                        ),
                        'toggle'            => array(
                            'block'             => array(
                                'fields'            => array('overlay_bg_color', 'overlay_opacity')
                            )
                        )
                    ),
                    'overlay_bg_color'  => array(
                        'type'              => 'color',
                        'label'             => __('Background Color', 'bb-powerpack'),
                        'default'           => '000000',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-overlay',
                            'property'          => 'background-color'
                        )
                    ),
                    'overlay_opacity'   => array(
                        'type'              => 'text',
                        'label'             => __('Opacity', 'bb-powerpack'),
                        'class'             => 'input-small',
                        'default'           => '0.8',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-modal-overlay',
                            'property'          => 'opacity'
                        )
                    )
                )
            ),
            'modal_close'      => array( // Section
                'title'             => __('Close Button', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'close_btn_toggle'   => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Button', 'bb-powerpack'),
                        'default'           => 'block',
                        'options'           => array(
                            'block'             => __('Show', 'bb-powerpack'),
                            'none'              => __('Hide', 'bb-powerpack')
                        )
                    ),
                    'close_btn_color'    => array(
                        'type'              => 'color',
                        'label'             => __('Color', 'bb-powerpack'),
                        'default'           => 'ffffff',
                    ),
                    'close_btn_color_hover' => array(
                        'type'                  => 'color',
                        'label'                 => __('Color Hover', 'bb-powerpack'),
                        'default'               => 'dddddd',
                    ),
                    'close_btn_bg'      => array(
                        'type'              => 'color',
                        'label'             => __('Background Color', 'bb-powerpack'),
                        'default'           => '3a3a3a',
                        'show_reset'        => true,
                    ),
                    'close_btn_bg_hover' => array(
                        'type'              => 'color',
                        'label'             => __('Background Color Hover', 'bb-powerpack'),
                        'default'           => 'b53030',
                        'show_reset'        => true,
                    ),
                    'close_btn_border'  => array(
                        'type'              => 'text',
                        'label'             => __('Border Width', 'bb-powerpack'),
                        'default'           => 1,
                        'description'       => 'px',
                        'class'             => 'input-small',
                    ),
                    'close_btn_border_color'    => array(
                        'type'                      => 'color',
                        'label'                     => __('Border Color', 'bb-powerpack'),
                        'default'                   => 'ffffff',
                    ),
                    'close_btn_border_radius'   => array(
                        'type'                      => 'text',
                        'label'                     => __('Round Corners', 'bb-powerpack'),
                        'default'                   => 100,
                        'description'               => 'px',
                        'class'                     => 'input-small',
                    ),
                    'close_btn_size'          => array(
                        'type'                      => 'text',
                        'label'                     => __('Size', 'bb-powerpack'),
                        'default'                   => 25,
                        'description'               => 'px',
                        'class'                     => 'input-small',
                    ),
                    'close_btn_weight'          => array(
                        'type'                      => 'text',
                        'label'                     => __('Weight', 'bb-powerpack'),
                        'default'                   => 2,
                        'description'               => 'px',
                        'class'                     => 'input-small',
                    ),
                    'close_btn_position'    => array(
                        'type'                  => 'select',
                        'label'                 => __('Position', 'bb-powerpack'),
                        'default'               => 'box-top-right',
                        'options'               => array(
                            'box-top-right'         => __('Box - Top Right'),
                            'box-top-left'          => __('Box - Top Left'),
                            'win-top-right'         => __('Window - Top Right'),
                            'win-top-left'          => __('Window - Top Left')
                        ),
                        'toggle'                => array(
                            'box-top-right'         => array(
                                'fields'                => array('close_btn_top', 'close_btn_right')
                            ),
                            'box-top-left'          => array(
                                'fields'                => array('close_btn_top', 'close_btn_left')
                            ),
                            'win-top-right'         => array(
                                'fields'                => array('close_btn_top', 'close_btn_right')
                            ),
                            'win-top-left'          => array(
                                'fields'                => array('close_btn_top', 'close_btn_left')
                            )
                        )
                    ),
                    'close_btn_top'        => array(
                        'type'                      => 'text',
                        'label'                     => __('Top Margin', 'bb-powerpack'),
                        'default'                   => '-10',
                        'description'               => 'px',
                        'class'                     => 'input-small',
                    ),
                    'close_btn_left'        => array(
                        'type'                      => 'text',
                        'label'                     => __('Left Margin', 'bb-powerpack'),
                        'default'                   => '-10',
                        'description'               => 'px',
                        'class'                     => 'input-small',
                    ),
                    'close_btn_right'        => array(
                        'type'                      => 'text',
                        'label'                     => __('Right Margin', 'bb-powerpack'),
                        'default'                   => '-10',
                        'description'               => 'px',
                        'class'                     => 'input-small',
                    )
                )
            ),
            'modal_responsive'  => array( // Section
                'title'             => __('Responsive', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'media_breakpoint'  => array(
                        'type'              => 'text',
                        'label'             => __('Media Breakpoint', 'bb-powerpack'),
                        'default'           => 0,
                        'class'             => 'input-small modal-device-width',
                        'description'       => 'px',
                        'help'              => __('You can set a custom break point and devices with the same or below screen width will always display a full screen modal box.', 'bb-powerpack'),
                    )
                )
            )
        )
    ),
    'animation'     => array( // Tab
        'title'         => __('Animation', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'modal_anim_load' => array( // Section
                'title'         => __('Animation On Load', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'animation_load'    => array(
                        'type'                  => 'select',
                        'label'                 => __('Animation', 'bb-powerpack'),
                        'default'               => 'fadeIn',
                        'options'               => modal_animations(),
                    ),
                    'animation_load_duration'  => array(
                        'type'                  => 'text',
                        'label'                 => __('Speed', 'bb-powerpack'),
                        'description'           => __('seconds', 'bb-powerpack'),
                        'class'                 => 'input-small',
                        'default'               => '0.5',
                    )
                )
            ),
            'modal_anim_exit' => array( // Section
                'title'         => __('Animation On Exit', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'animation_exit'    => array(
                        'type'                  => 'select',
                        'label'                 => __('Animation', 'bb-powerpack'),
                        'default'               => 'fadeOut',
                        'options'               => modal_animations(),
                    ),
                    'animation_exit_duration'  => array(
                        'type'                  => 'text',
                        'label'                 => __('Speed', 'bb-powerpack'),
                        'description'           => __('seconds', 'bb-powerpack'),
                        'class'                 => 'input-small',
                        'default'               => '0.5',
                    )
                )
            )
        )
    )
));

function modal_animations() {
    $animations = array(
        'bounce'                => __('Bounce', 'bb-powerpack'),
        'bounceIn'              => __('Bounce In', 'bb-powerpack'),
        'bounceOut'             => __('Bounce Out', 'bb-powerpack'),
        'fadeIn'                => __('Fade In', 'bb-powerpack'),
        'fadeInDown'            => __('Fade In Down', 'bb-powerpack'),
        'fadeInLeft'            => __('Fade In Left', 'bb-powerpack'),
        'fadeInRight'           => __('Fade In Right', 'bb-powerpack'),
        'fadeInUp'              => __('Fade In Up', 'bb-powerpack'),
        'fadeOut'               => __('Fade Out', 'bb-powerpack'),
        'fadeOutDown'           => __('Fade Out Down', 'bb-powerpack'),
        'fadeOutLeft'           => __('Fade Out Left', 'bb-powerpack'),
        'fadeOutRight'          => __('Fade Out Right', 'bb-powerpack'),
        'fadeOutUp'             => __('Fade Out Up', 'bb-powerpack'),
        'pulse'                 => __('Pulse', 'bb-powerpack'),
        'shake'                 => __('Shake', 'bb-powerpack'),
        'slideInDown'           => __('Slide In Down', 'bb-powerpack'),
        'slideInLeft'           => __('Slide In Left', 'bb-powerpack'),
        'slideInRight'          => __('Slide In Right', 'bb-powerpack'),
        'slideInUp'             => __('Slide In Up', 'bb-powerpack'),
        'slideOutDown'          => __('Slide Out Down', 'bb-powerpack'),
        'slideOutLeft'          => __('Slide Out Left', 'bb-powerpack'),
        'slideOutRight'         => __('Slide Out Right', 'bb-powerpack'),
        'slideOutUp'            => __('Slide Out Up', 'bb-powerpack'),
        'swing'                 => __('Swing', 'bb-powerpack'),
        'tada'                  => __('Tada', 'bb-powerpack'),
        'zoomIn'                => __('Zoom In', 'bb-powerpack'),
        'zoomOut'               => __('Zoom Out', 'bb-powerpack'),
    );

    return $animations;
}
