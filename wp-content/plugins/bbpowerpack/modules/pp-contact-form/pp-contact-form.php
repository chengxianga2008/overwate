<?php

/**
 * @class PPContactFormModule
 */
class PPContactFormModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Contact Form', 'bb-powerpack'),
            'description'   => __('Advanced module for Contact Form.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-contact-form/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-contact-form/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
		));

		add_action('wp_ajax_pp_send_email', array($this, 'send_mail'));
		add_action('wp_ajax_nopriv_pp_send_email', array($this, 'send_mail'));
	}

	/**
	 * @method send_mail
	 */
	public function send_mail() {
	    global $pp_contact_from_name, $pp_contact_from_email;

		// Get the contact form post data
    	$node_id			= isset( $_POST['node_id'] ) ? sanitize_text_field( $_POST['node_id'] ) : false;
    	$template_id    	= isset( $_POST['template_id'] ) ? sanitize_text_field( $_POST['template_id'] ) : false;
		$template_node_id   = isset( $_POST['template_node_id'] ) ? sanitize_text_field( $_POST['template_node_id'] ) : false;

		$subject 			= (isset($_POST['subject']) ? $_POST['subject'] : __('Contact Form Submission', 'bb-powerpack'));
		$mailto 			= get_option('admin_email');

		if ( $node_id ) {

			// Get the module settings.
			if ( $template_id ) {
				$post_id  = FLBuilderModel::get_node_template_post_id( $template_id );
				$data	  = FLBuilderModel::get_layout_data( 'published', $post_id );
				$settings = $data[ $template_node_id ]->settings;
			}
			else {
				$module   = FLBuilderModel::get_module( $node_id );
				$settings = $module->settings;
			}

			if ( isset($settings->mailto_email) && !empty($settings->mailto_email) ) {
				$mailto   = $settings->mailto_email;
			}

			$pp_contact_from_email = (isset($_POST['email']) ? sanitize_email($_POST['email']) : null);
			$pp_contact_from_name = (isset($_POST['name']) ? $_POST['name'] : null);

			add_filter('wp_mail_from', 'PPContactFormModule::mail_from');
			add_filter('wp_mail_from_name', 'PPContactFormModule::from_name');

			// Build the email
			$template = "";

			if (isset($_POST['name']))  $template .= "Name: $_POST[name] \r\n";
			if (isset($_POST['email'])) $template .= "Email: $_POST[email] \r\n";
			if (isset($_POST['phone'])) $template .= "Phone: $_POST[phone] \r\n";

			$template .= __('Message', 'bb-powerpack') . ": \r\n" . $_POST['message'];

			// Double check the mailto email is proper and send
			if ($mailto) {
				wp_mail($mailto, $subject, $template);
				die('1');
			} else {
				die($mailto);
			}
		}
	}

	static public function mail_from($original_email_address) {
		global $pp_contact_from_email;
		return ($pp_contact_from_email != '') ? $pp_contact_from_email : $original_email_address;
	}

	static public function from_name($original_name) {
		global $pp_contact_from_name;
		return ($pp_contact_from_name != '') ? $pp_contact_from_name : $original_name;
	}

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPContactFormModule', array(
	'general'       => array(
		'title'         => __('General', 'bb-powerpack'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'mailto_email'     => array(
						'type'          => 'text',
						'label'         => __('Send To Email', 'bb-powerpack'),
						'default'       => '',
						'placeholder'   => __('example@mail.com', 'bb-powerpack'),
						'help'          => __('The contact form will send to this e-mail. Defaults to the admin email.', 'bb-powerpack'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'form_layout'   => array(
                        'type'          => 'select',
                        'label'         => __('Layout', 'bb-powerpack'),
                        'default'       => 'stacked',
                        'options'       => array(
                            'stacked'      => __('Stacked', 'bb-powerpack'),
                            'inline'     => __('Inline', 'bb-powerpack'),
							'stacked-inline'     => __('Stacked + Inline', 'bb-powerpack'),
                        ),
                    ),
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
                        )
                    ),
					'custom_title'      => array(
                        'type'          => 'text',
                        'label'         => __('Custom Title', 'bb-powerpack'),
                        'default'       => '',
                        'description'   => '',
						'connections'   => array('string'),
						'preview'       => array(
                            'type'      => 'text',
                            'selector'  => '.pp-form-title'
                        )
                    ),
					'custom_description'    => array(
                        'type'              => 'textarea',
                        'label'             => __('Custom Description', 'bb-powerpack'),
                        'default'           => '',
                        'placeholder'       => '',
                        'rows'              => '6',
						'connections'   	=> array('string', 'html'),
                        'preview'           => array(
                            'type'          => 'text',
                            'selector'      => '.pp-form-description'
                        )
                    ),
					'name_toggle'   => array(
						'type'          => 'pp-switch',
						'label'         => __('Name Field', 'bb-powerpack'),
						'default'       => 'show',
						'options'       => array(
							'show'      => __('Show', 'bb-powerpack'),
							'hide'      => __('Hide', 'bb-powerpack'),
						)
					),
					'email_toggle'   => array(
						'type'          => 'pp-switch',
						'label'         => __('Email Field', 'bb-powerpack'),
						'default'       => 'show',
						'options'       => array(
							'show'      => __('Show', 'bb-powerpack'),
							'hide'      => __('Hide', 'bb-powerpack'),
						)
					),
					'phone_toggle'   => array(
						'type'          => 'pp-switch',
						'label'         => __('Phone Field', 'bb-powerpack'),
						'default'       => 'hide',
						'options'       => array(
							'show'      => __('Show', 'bb-powerpack'),
							'hide'      => __('Hide', 'bb-powerpack'),
						)
					),
					'subject_toggle'   => array(
						'type'          => 'pp-switch',
						'label'         => __('Subject Field', 'bb-powerpack'),
						'default'       => 'hide',
						'options'       => array(
							'show'      => __('Show', 'bb-powerpack'),
							'hide'      => __('Hide', 'bb-powerpack'),
						)
					),
					'message_toggle'   => array(
						'type'          => 'pp-switch',
						'label'         => __('Message Field', 'bb-powerpack'),
						'default'       => 'show',
						'options'       => array(
							'show'      => __('Show', 'bb-powerpack'),
							'hide'      => __('Hide', 'bb-powerpack'),
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
			),
			'success'       => array(
				'title'         => __( 'Success', 'bb-powerpack' ),
				'fields'        => array(
					'success_action' => array(
						'type'          => 'select',
						'label'         => __( 'Success Action', 'bb-powerpack' ),
						'options'       => array(
							'none'          => __( 'None', 'bb-powerpack' ),
							'show_message'  => __( 'Show Message', 'bb-powerpack' ),
							'redirect'      => __( 'Redirect', 'bb-powerpack' )
						),
						'toggle'        => array(
							'show_message'       => array(
								'fields'        => array( 'success_message' ),
								'sections'		=> array('form_success_styling', 'form_success_typography')
							),
							'redirect'      => array(
								'fields'        => array( 'success_url' )
							)
						),
						'preview'       => array(
							'type'             => 'none'
						)
					),
					'success_message' => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false,
						'rows'          => 8,
						'default'       => __( 'Thanks for your message! We’ll be in touch soon.', 'bb-powerpack' ),
						'preview'       => array(
							'type'             => 'none'
						)
					),
					'success_url'  => array(
						'type'          => 'link',
						'label'         => __( 'Success URL', 'bb-powerpack' ),
						'preview'       => array(
							'type'             => 'none'
						)
					)
				)
			)
		)
	),
	'form_style'	=> array(
		'title'	=> __('Style', 'bb-powerpack'),
		'sections'	=> array(
			'form_bg_setting'	=> array(
				'title'	=> __('Form Background', 'bb-powerpack'),
				'fields'	=> array(
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
	                            'fields'    => array('form_bg_image','form_bg_size','form_bg_repeat')
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
	                        'selector'  => '.pp-contact-form',
	                        'property'  => 'background-color'
	                    )
	                ),
	                'form_background_opacity'    => array(
	                    'type'                 => 'text',
	                    'label'                => __('Background Opacity', 'bb-powerpack'),
	                    'class'                => 'bb-cf-input input-small',
	                    'description'          => '%',
	                    'default'              => '100',
	                    'preview'              => array(
	                        'type'             => 'css',
	                        'selector'         => '.pp-contact-form',
	                        'property'         => 'opacity',
	                    )
	                ),
	                'form_bg_image'     => array(
	                'type'              => 'photo',
	                    'label'         => __('Background Image', 'bb-powerpack'),
	                    'default'       => '',
	                    'preview'       => array(
	                        'type'      => 'css',
	                        'selector'  => '.pp-contact-form',
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
                            'selector'  => '.pp-contact-form',
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
                        'class'         => 'bb-cf-input input-small',
                        'default'       => 2,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-contact-form',
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
                            'selector'  => '.pp-contact-form',
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
                        'class'             => 'bb-cf-input input-small',
                        'default'           => 50,
                    ),
                )
            ),
			'form_corners_padding'      => array( // Section
                'title'         => __('Corners & Padding', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'form_border_radius' 	=> array(
                        'type'          => 'text',
                        'label'         => __('Round Corners', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => 2,
                        'class'         => 'bb-cf-input input-small',
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-contact-form',
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
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-contact-form',
                                    'property'  => 'padding-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-contact-form',
                                    'property'  => 'padding-bottom',
                                    'unit'      => 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Left', 'bb-powerpack'),
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'selector'  => '.pp-contact-form',
                                    'property'  => 'padding-left',
                                    'unit'      => 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Right', 'bb-powerpack'),
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'  => '.pp-contact-form',
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
                            'selector'  => '.pp-contact-form .pp-form-title',
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
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-contact-form .pp-form-title',
                                    'property'  => 'margin-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-contact-form .pp-form-title',
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
                            'selector'  => '.pp-contact-form .pp-form-description',
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
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-contact-form .pp-form-description',
                                    'property'  => 'margin-top',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-contact-form .pp-form-description',
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
	'input_style'   => array(
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
                            'selector'              => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                            'selector'          => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
                            'property'          => 'background-color'
                        )
                    ),
                    'input_field_background_opacity'    => array(
                        'type'                 => 'text',
                        'label'                => __('Background Opacity', 'bb-powerpack'),
                        'class'                => 'bb-cf-input input-small',
                        'description'          => '%',
                        'default'              => '100',
                        'preview'              => array(
                            'type'             => 'css',
                            'selector'         => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                            'selector'          => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
                            'property'          => 'border-color'
                        )
                    ),
                    'input_field_border_width'    => array(
                        'type'                    => 'text',
                        'label'                   => __('Border Width', 'bb-powerpack'),
                        'description'             => 'px',
                        'default'                 => '1',
                        'class'                   => 'bb-cf-input input-small',
                        'preview'                 => array(
                            'type'                => 'css',
                            'rules'                 => array(
                                array(
                                    'selector'            => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
                                    'property'            => 'border-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
                                    'property'            => 'border-top-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
                                    'property'            => 'border-bottom-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
                                    'property'            => 'border-left-width',
                                    'unit'                => 'px',
                                ),
                                array(
                                    'selector'            => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                            'selector'            => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                            'selector'          => '.pp-contact-form textarea:focus, .pp-contact-form input[type=text]:focus, .pp-contact-form input[type=tel]:focus, .pp-contact-form input[type=email]:focus',
                            'property'          => 'border-color'
                        )
                    ),
                )
            ),
            'input_size_style'      => array( // Section
                'title'         => __('Size & Alignment', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'input_field_height'    => array(
                        'type'                    => 'text',
                        'label'                   => __('Input Height', 'bb-powerpack'),
                        'description'             => 'px',
                        'default'                 => '32',
                        'class'                   => 'bb-cf-input input-small',
                        'preview'                 => array(
                            'type'                => 'css',
                            'selector'            => '.pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
                            'property'            => 'height',
                            'unit'                => 'px',
                        )
                    ),
                    'input_textarea_height'    => array(
                        'type'                    => 'text',
                        'label'                   => __('Textarea Height', 'bb-powerpack'),
                        'description'             => 'px',
                        'default'                 => '140',
                        'class'                   => 'bb-cf-input input-small',
                        'preview'                 => array(
                            'type'                => 'css',
                            'selector'            => '.pp-contact-form textarea',
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
                        'class'                    => 'bb-cf-input input-small',
                        'preview'                  => array(
                            'type'                 => 'css',
                            'selector'             => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                            'selector'  => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                                    'selector'  => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                                    'selector'  => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                                    'selector'  => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                        'class'             => 'bb-cf-input input-small',
                        'default'           => '10',
                        'preview'           => array(
                            'type'          => 'css',
                            'selector'      => '.pp-contact-form .pp-input-group',
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
                            'selector'          => '.pp-contact-form input[type=text]::-webkit-input-placeholder, .pp-contact-form input[type=tel]::-webkit-input-placeholder, .pp-contact-form input[type=email]::-webkit-input-placeholder, .pp-contact-form textarea::-webkit-input-placeholder',
                            'property'          => 'color'
                        )
                    ),
                )
            ),
        )
    ),
	'button'        => array(
		'title'         => __( 'Button', 'bb-powerpack' ),
		'sections'      => array(
			'btn_general'   => array(
				'title'         => '',
				'fields'        => array(
					'btn_text'      => array(
						'type'          => 'text',
						'label'         => __( 'Text', 'bb-powerpack' ),
						'default'       => __( 'Send', 'bb-powerpack' )
					),
					'btn_icon'      => array(
						'type'          => 'icon',
						'label'         => __( 'Icon', 'bb-powerpack' ),
						'show_remove'   => true
					),
					'btn_icon_position' => array(
						'type'          => 'pp-switch',
						'label'         => __('Icon Position', 'bb-powerpack'),
						'default'       => 'after',
						'options'       => array(
							'before'        => __('Before Text', 'bb-powerpack'),
							'after'         => __('After Text', 'bb-powerpack')
						)
					),
					'btn_icon_animation' => array(
						'type'          => 'select',
						'label'         => __('Icon Visibility', 'bb-powerpack'),
						'default'       => 'disable',
						'options'       => array(
							'disable'        => __('Always Visible', 'bb-powerpack'),
							'enable'         => __('Fade In On Hover', 'bb-powerpack')
						)
					)
				)
			),
			'btn_colors'     => array(
				'title'         => __( 'Button Colors', 'bb-powerpack' ),
				'fields'        => array(
					'btn_bg_color'  => array(
						'type'          => 'color',
						'label'         => __( 'Background Color', 'bb-powerpack' ),
						'default'       => '',
						'show_reset'    => true
					),
					'btn_bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __( 'Background Hover Color', 'bb-powerpack' ),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'btn_text_color' => array(
						'type'          => 'color',
						'label'         => __( 'Text Color', 'bb-powerpack' ),
						'default'       => '',
						'show_reset'    => true
					),
					'btn_text_hover_color' => array(
						'type'          => 'color',
						'label'         => __( 'Text Hover Color', 'bb-powerpack' ),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
			'btn_style'     => array(
				'title'         => __( 'Button Style', 'bb-powerpack' ),
				'fields'        => array(
					'btn_style'     => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Style', 'bb-powerpack' ),
						'default'       => 'flat',
						'options'       => array(
							'flat'          => __( 'Flat', 'bb-powerpack' ),
							'gradient'      => __( 'Gradient', 'bb-powerpack' ),
							'transparent'   => __( 'Transparent', 'bb-powerpack' )
						),
						'toggle'        => array(
							'transparent'   => array(
								'fields'        => array( 'btn_bg_opacity', 'btn_bg_hover_opacity', 'btn_border_size' )
							)
						)
					),
					'btn_border_size' => array(
						'type'          => 'text',
						'label'         => __( 'Border Width', 'bb-powerpack' ),
						'default'       => '2',
						'description'   => 'px',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					),
					'btn_bg_opacity' => array(
						'type'          => 'text',
						'label'         => __( 'Background Opacity', 'bb-powerpack' ),
						'default'       => '0',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					),
					'btn_bg_hover_opacity' => array(
						'type'          => 'text',
						'label'         => __('Background Hover Opacity', 'bb-powerpack'),
						'default'       => '0',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					),
					'btn_button_transition' => array(
						'type'          => 'pp-switch',
						'label'         => __('Transition', 'bb-powerpack'),
						'default'       => 'disable',
						'options'       => array(
							'enable'         => __('Enabled', 'bb-powerpack'),
							'disable'        => __('Disabled', 'bb-powerpack'),
						)
					)
				)
			),
			'btn_structure' => array(
				'title'         => __( 'Button Structure', 'bb-powerpack' ),
				'fields'        => array(
					'btn_width'     => array(
						'type'          => 'pp-switch',
						'label'         => __('Width', 'bb-powerpack'),
						'default'       => 'auto',
						'options'       => array(
							'auto'          => _x( 'Auto', 'Width.', 'bb-powerpack' ),
							'full'          => __('Full Width', 'bb-powerpack')
						)
					),
					'btn_align'    	=> array(
						'type'          => 'pp-switch',
						'label'         => __('Alignment', 'bb-powerpack'),
						'default'       => 'left',
						'options'       => array(
							'left'          => __('Left', 'bb-powerpack'),
							'center'		=> __('Center', 'bb-powerpack'),
							'right'         => __('Right', 'bb-powerpack'),
						)
					),
					'button_padding'   => array(
						'type' 			=> 'pp-multitext',
                        'label' 		=> __('Padding', 'bb-powerpack'),
                        'description'   => __( 'px', 'Value unit for padding. Such as: "14 px"', 'bb-powerpack' ),
                        'default'       => array(
                            'top' => 10,
                            'right' => 20,
                            'bottom' => 10,
                            'left' =>20,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-contact-form a.fl-button',
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
                                    'selector'  => '.pp-contact-form a.fl-button',
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
                                    'selector'  => '.pp-contact-form a.fl-button',
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
                                    'selector'  => '.pp-contact-form a.fl-button',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
					),
					'button_margin'   => array(
						'type'          => 'text',
						'label'         => __( 'Margin Top', 'bb-powerpack' ),
						'default'       => '10',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'btn_border_radius' => array(
						'type'          => 'text',
						'label'         => __( 'Round Corners', 'bb-powerpack' ),
						'default'       => '4',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					)
				)
			)
		)
	),
	'form_messages_setting' => array(
        'title' => __('Messages', 'bb-powerpack'),
        'sections'  => array(
			'form_error_styling'    => array( // Section
                'title'             => __('Errors', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'validation_message_color'    => array(
                        'type'                    => 'color',
                        'label'                   => __('Error Field Message Color', 'bb-powerpack'),
                        'default'                 => 'dd4420',
                        'preview'                 => array(
                            'type'                => 'css',
                            'selector'            => '.pp-contact-form .pp-contact-error',
                            'property'            => 'color'
                        )
                    ),
					'validation_field_border_color'    => array(
                        'type'                         => 'color',
                        'label'                        => __('Error Field Border Color', 'bb-powerpack'),
                        'default'                      => 'dd4420',
                        'show_reset'                   => true,
                        'preview'                      => array(
                            'type'                     => 'css',
                            'selector'                 => '.pp-contact-form .pp-error textarea, .pp-contact-form .pp-error input[type=text], .pp-contact-form .pp-error input[type=tel], .pp-contact-form .pp-error input[type=email]',
                            'property'                 => 'border-color'
                        )
                    ),
                )
            ),
			'form_success_styling'    => array( // Section
                'title'             => __('Success Message', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'success_message_color'    => array(
                        'type'                         => 'color',
                        'label'                        => __('Color', 'bb-powerpack'),
                        'default'                      => '29bb41',
                        'preview'                      => array(
                            'type'                     => 'css',
                            'selector'                 => '.pp-contact-form .pp-success-msg',
                            'property'                 => 'color'
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
                            'selector'        => '.pp-contact-form .pp-form-title'
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
                                    'selector'      => '.pp-contact-form .pp-form-title',
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
                                    'selector'      => '.pp-contact-form .pp-form-title',
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
                    'title_color'       => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-contact-form .pp-form-title',
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
                            'selector'        => '.pp-contact-form .pp-form-description'
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
                                    'selector'      => '.pp-contact-form .pp-form-description',
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
                                    'selector'      => '.pp-contact-form .pp-form-description',
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
                            'selector'        => '.pp-contact-form .pp-form-description',
                            'property'          => 'text-transform'
                        )
                    ),
                    'description_color' => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-contact-form .pp-form-description',
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
                            'selector'        => '.pp-contact-form label'
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
                            'desktop'   => 15,
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
                                    'selector'      => '.pp-contact-form label',
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
                    'form_label_color'  => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-contact-form label',
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
                            'selector'        => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                                    'selector'      => '.pp-contact-form textarea, .pp-contact-form input[type=text], .pp-contact-form input[type=tel], .pp-contact-form input[type=email]',
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
                            'selector'        => '.pp-contact-form a.fl-button'
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
                                    'selector'      => '.pp-contact-form a.fl-button',
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
                    'button_text_transform'    => array(
                        'type'                      => 'select',
                        'label'                     => __('Text Transform', 'bb-powerpack'),
                        'default'                   => 'none',
                        'options'                   => array(
                            'none'                  => __('Default', 'bb-powerpack'),
                            'lowercase'                => __('lowercase', 'bb-powerpack'),
                            'uppercase'                 => __('UPPERCASE', 'bb-powerpack'),
                        ),
						'preview'	=> array(
							'type'	=> 'css',
							'selector'	=> '.pp-contact-form a.fl-button',
							'property'	=> 'text-transform'
						)
                    ),
                )
            ),
			'errors_typography'       => array( // Section
                'title'         => __('Error', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
					'validation_error_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Font Size', 'bb-powerpack'),
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
                                    'selector'      => '.pp-contact-form .pp-contact-error',
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
			'form_success_typography'    => array( // Section
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
                                    'selector'      => '.pp-contact-form .pp-success-msg',
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
	),
));
