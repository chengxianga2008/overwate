<?php

/**
 * A module that adds a simple subscribe form to your layout
 * with third party optin integration.
 *
 * @since 1.5.2
 */
class PPSubscribeFormModule extends FLBuilderModule {

	/**
	 * @since 1.5.2
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct( array(
			'name'          	=> __( 'Subscribe Form', 'bb-powerpack' ),
			'description'   	=> __( 'Adds a simple subscribe form to your layout.', 'bb-powerpack' ),
			'category'			=> BB_POWERPACK_CAT,
            'dir'           	=> BB_POWERPACK_DIR . 'modules/pp-subscribe-form/',
            'url'           	=> BB_POWERPACK_URL . 'modules/pp-subscribe-form/',
			'editor_export' 	=> false,
			'partial_refresh'	=> true
		));

		add_action( 'wp_ajax_pp_subscribe_form_submit', array( $this, 'submit' ) );
		add_action( 'wp_ajax_nopriv_pp_subscribe_form_submit', array( $this, 'submit' ) );

		$this->add_js( 'jquery-cookie', $this->url . 'js/jquery.cookie.min.js', array('jquery') );
	}

	/**
	 * Called via AJAX to submit the subscribe form.
	 *
	 * @since 1.5.2
	 * @return string The JSON encoded response.
	 */
	public function submit()
	{
		$name       		= isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : false;
		$email      		= isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : false;
		$node_id    		= isset( $_POST['node_id'] ) ? sanitize_text_field( $_POST['node_id'] ) : false;
		$template_id    	= isset( $_POST['template_id'] ) ? sanitize_text_field( $_POST['template_id'] ) : false;
		$template_node_id   = isset( $_POST['template_node_id'] ) ? sanitize_text_field( $_POST['template_node_id'] ) : false;
		$result    			= array(
			'action'    		=> false,
			'error'     		=> false,
			'message'   		=> false,
			'url'       		=> false
		);

		if ( $email && $node_id ) {

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

			// Subscribe.
			$instance = FLBuilderServices::get_service_instance( $settings->service );
			$response = $instance->subscribe( $settings, $email, $name );

			// Check for an error from the service.
			if ( $response['error'] ) {
				$result['error'] = $response['error'];
			}
			// Setup the success data.
			else {

				$result['action'] = $settings->success_action;

				if ( 'message' == $settings->success_action ) {
					$result['message']  = $settings->success_message;
				}
				else {
					$result['url']  = $settings->success_url;
				}
			}
		}
		else {
			$result['error'] = __( 'There was an error subscribing. Please try again.', 'bb-powerpack' );
		}

		echo json_encode( $result );

		die();
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module( 'PPSubscribeFormModule', array(
	'general'       => array(
		'title'         => __( 'General', 'bb-powerpack' ),
		'sections'      => array(
			'service'       => array(
				'title'         => '',
				'file'          => FL_BUILDER_DIR . 'includes/service-settings.php',
				'services'      => 'autoresponder'
			),
			'display_type'	=> array(
				'title'			=> '',
				'fields'		=> array(
					'box_type'	=> array(
						'type'			=> 'select',
						'label'			=> __( 'Type', 'bb-powerpack' ),
						'default'		=> 'standard',
						'options'		=> array(
							'standard'		=> __( 'Standard', 'bb-powerpack' ),
							'fixed_bottom'	=> __( 'Fixed at Bottom', 'bb-powerpack' ),
							'slidein'		=> __( 'On-Scroll Slide-In', 'bb-powerpack' ),
							'popup_scroll'	=> __( 'On-Scroll Popup', 'bb-powerpack' ),
							'popup_exit'	=> __( 'Exit-Intent Popup', 'bb-powerpack' ),
							'popup_auto'	=> __( 'Auto-Load Popup', 'bb-powerpack' ),
							'two_step'		=> __( 'Two Step Popup', 'bb-powerpack' ),
							'welcome_gate'	=> __( 'Welcome Gate', 'bb-powerpack' ),
						),
						'toggle'		=> array(
							'standard'		=> array(
								'fields'		=> array('show_content', 'form_border_radius')
							),
							'fixed_bottom'	=> array(
								'sections'		=> array('box_content'),
								'fields'		=> array('box_width', 'display_after')
							),
							'slidein'		=> array(
								'sections'		=> array('box_content', 'content_style', 'box_content_typography', 'box_bg_setting'),
								'fields'		=> array('box_scroll', 'slidein_position', 'box_width', 'box_height', 'display_after')
							),
							'popup_scroll'	=> array(
								'sections'		=> array('box_content', 'content_style', 'box_content_typography', 'box_bg_setting', 'box_overlay'),
								'fields'		=> array('box_scroll', 'box_width', 'box_height', 'display_after')
							),
							'popup_exit'	=> array(
								'sections'		=> array('box_content', 'content_style', 'box_content_typography', 'box_bg_setting', 'box_overlay'),
								'fields'		=> array('box_width', 'box_height', 'display_after')
							),
							'popup_auto'	=> array(
								'sections'		=> array('box_content', 'content_style', 'box_content_typography', 'box_bg_setting', 'box_overlay'),
								'fields'		=> array('popup_delay', 'box_width', 'box_height', 'display_after')
							),
							'two_step'		=> array(
								'sections'		=> array('box_content', 'content_style', 'box_content_typography', 'box_bg_setting', 'box_overlay'),
								'fields'		=> array('box_width', 'box_height', 'css_class')
							),
							'welcome_gate'	=> array(
								'sections'		=> array('box_content', 'content_style', 'box_content_typography', 'box_bg_setting'),
								'fields'		=> array('popup_delay', 'box_width', 'box_height', 'display_after')
							)
						),
					),
					'show_content'	=> array(
						'type'			=> 'pp-switch',
						'label'			=> __( 'Show Content', 'bb-powerpack' ),
						'default'		=> 'no',
						'options'		=> array(
							'yes'			=> __('Yes', 'bb-powerpack'),
							'no'			=> __('No', 'bb-powerpack')
						),
						'toggle'		=> array(
							'yes'			=> array(
								'sections'		=> array('box_content', 'box_content_typography')
							)
						)
					),
					'box_scroll'	=> array(
						'type'			=> 'text',
						'label'			=> __( 'Scroll Percentage', 'bb-powerpack' ),
						'default'		=> 50,
						'description'	=> '%',
						'size'			=> 5,
						'maxlength'		=> 3,
						'preview'       => array(
							'type'             => 'none'
						),
						'help'			=> __( 'It will appear once the user scroll the page to the percentage you added.', 'bb-powerpack' )
					),
					'slidein_position'	=> array(
						'type'				=> 'pp-switch',
						'label'				=> __( 'Position', 'bb-powerpack' ),
						'default'			=> 'left',
						'options'			=> array(
							'left'				=> __( 'Bottom Left', 'bb-powerpack' ),
							'right'				=> __( 'Bottom Right', 'bb-powerpack' ),
						),
						'preview'       	=> array(
							'type'             => 'none'
						)
					),
					'popup_delay'	=> array(
						'type'			=> 'text',
						'label'			=> __( 'Delay', 'bb-powerpack' ),
						'default'		=> 1,
						'description'	=> __( 'second(s)', 'bb-powerpack' ),
						'size'			=> 5,
						'maxlength'		=> 4,
						'preview'		=> array(
							'type'			=> 'none'
						)
					),
					'box_width'		=> array(
						'type'			=> 'text',
						'label'			=> __( 'Width', 'bb-powerpack' ),
						'default'		=> 550,
						'description'	=> 'px',
						'size'			=> 5,
						'maxlength'		=> 3,
						'preview'       => array(
							'type'          => 'css',
							'selector'		=> '.pp-subscribe-box',
							'property'		=> 'width',
							'unit'			=> 'px'
						)
					),
					'box_height'	=> array(
						'type'			=> 'text',
						'label'			=> __( 'Height', 'bb-powerpack' ),
						'default'		=> 450,
						'description'	=> 'px',
						'size'			=> 5,
						'maxlength'		=> 3,
						'preview'       => array(
							'type'          => 'css',
							'selector'		=> '.pp-subscribe-box',
							'property'		=> 'height',
							'unit'			=> 'px'
						)
					),
					'css_class'	=> array(
						'type'		=> 'pp-css-class',
						'label'		=> __('CSS Class', 'bb-powerpack'),
						'default'	=> 'pp_subscribe_',
						'help'		=> __('Copy this CSS class and paste it to the element you want to trigger the popup clicking on it.', 'bb-powerpack')
					),
					'display_after'    	=> array(
                        'type'              => 'text',
                        'label'             => __('Cookie Duration', 'bb-powerpack'),
                        'default'           => 1,
                        'description'       => __('day(s)', 'bb-powerpack'),
						'size'				=> 5,
						'maxlength'			=> 3,
                        'help'              => __('If users close the box it will display them again only after the length of the time.', 'bb-powerpack'),
                    )
				)
			),
			'box_content'	=> array(
				'title'         	=> __( 'Content', 'bb-powerpack' ),
				'fields'        	=> array(
					'box_content' => array(
						'type'          => 'editor',
						'label'         => '',
						'rows'          => 6,
						'default'       => __( 'Place your content here. It will appear above the form.', 'bb-powerpack' ),
						'connections'   => array( 'string', 'html', 'url' ),
						'preview'       => array(
							'type'          => 'text',
							'selector'		=> '.pp-subscribe-content'
						)
					),
				)
			),
			'structure'        => array(
				'title'         => __( 'Form Structure', 'bb-powerpack' ),
				'fields'        => array(
					'layout'        => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Layout', 'bb-powerpack' ),
						'default'       => 'stacked',
						'options'       => array(
							'stacked'       => __( 'Stacked', 'bb-powerpack' ),
							'inline'        => __( 'Inline', 'bb-powerpack' ),
							'compact'		=> __( 'Compact', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'stacked'	=> array(
								'fields'	=> array('btn_align', 'input_custom_width', 'inputs_space', 'btn_margin')
							),
							'inline'	=> array(
								'fields'	=> array('input_custom_width', 'inputs_space')
							),
							'compact'	=> array(
								'fields'	=> array('btn_margin')
							)
						),
						'hide'	=> array(
							'compact'	=> array(
								'fields'	=> array('input_name_width', 'input_email_width')
							)
						)
					),
					'input_custom_width'     => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Inputs Width', 'bb-powerpack' ),
						'default'       => 'default',
						'options'       => array(
							'default'          => __( 'Default', 'bb-powerpack' ),
							'custom'          => __( 'Custom', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('input_name_width', 'input_email_width', 'input_button_width')
							)
						)
					),
					'input_name_width' 	=> array(
                        'type'          	=> 'text',
                        'label'         	=> __('Name Field Width', 'bb-powerpack'),
                        'description'   	=> '%',
                        'size'         		=> 5,
                        'default'       	=> '',
                    ),
					'input_email_width'      => array(
                        'type'          => 'text',
                        'label'         => __('Email Field Width', 'bb-powerpack'),
                        'description'   => '%',
                        'size'         => 5,
                        'default'       => '',
                    ),
					'input_button_width'      => array(
                        'type'          => 'text',
                        'label'         => __('Button Width', 'bb-powerpack'),
                        'description'   => '%',
                        'size'         => 5,
                        'default'       => '',

                    ),
					'inputs_space'      => array(
                        'type'          => 'text',
                        'label'         => __('Spacing Between Inputs', 'bb-powerpack'),
                        'description'   => '%',
                        'size'         => 5,
                        'default'       => 1,
                    ),
					'show_name'     => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Name Field', 'bb-powerpack' ),
						'default'       => 'show',
						'options'       => array(
							'show'          => __( 'Show', 'bb-powerpack' ),
							'hide'          => __( 'Hide', 'bb-powerpack' ),
						),
						'toggle'		=> array(
							'show'			=> array(
								'fields'		=> array('input_name_placeholder')
							)
						)
					),
					'input_name_placeholder' 	=> array(
                        'type'          	=> 'text',
                        'label'         	=> __('Name Field Placeholder Text', 'bb-powerpack'),
                        'description'   	=> '',
                        'default'       	=> __('Name', 'bb-powerpack'),
                    ),
					'input_email_placeholder' 	=> array(
                        'type'          	=> 'text',
                        'label'         	=> __('Email Field Placeholder Text', 'bb-powerpack'),
                        'description'   	=> '',
                        'default'       	=> __('Email Address', 'bb-powerpack'),
                    ),
				)
			),
		)
	),
	'subscribe_form_style'	=> array(
		'title'	=> __('Style', 'bb-powerpack'),
		'sections'	=> array(
			'box_bg_setting'	=> array(
				'title'				=> __('Box Style', 'bb-powerpack'),
				'fields'			=> array(
					'box_bg'			=> array(
						'type'          	=> 'color',
	                    'label'         	=> __('Background Color', 'bb-powerpack'),
	                    'default'       	=> 'ffffff',
	                    'show_reset'    	=> true,
	                    'preview'       	=> array(
	                        'type'      		=> 'css',
	                        'selector'  		=> '.pp-subscribe-box',
	                        'property'  		=> 'background-color'
	                    )
					),
					'box_bg_opacity'	=> array(
	                    'type'          	=> 'text',
	                    'label'             => __('Background Opacity', 'bb-powerpack'),
	                    'size'          	=> '5',
						'maxlength'			=> 3,
	                    'description'       => '%',
	                    'default'           => '100',
	                    'preview'           => array(
	                        'type'             	=> 'css',
	                        'selector'        	=> '.pp-subscribe-box',
	                        'property'         	=> 'opacity',
	                    )
	                ),
					'box_border_radius' 	=> array(
                        'type'          => 'text',
                        'label'         => __('Round Corners', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => 2,
                        'size'         => 5,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-subscribe-box',
                            'property'  => 'border-radius',
                            'unit'      => 'px'
                        )
                    ),
                    'box_padding' 	=> array(
                        'type' 			=> 'pp-multitext',
                        'label' 		=> __('Content Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => array(
                            'top' 			=> 15,
                            'right' 		=> 15,
                            'bottom' 		=> 15,
                            'left' 			=> 15,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-content',
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
                                    'selector'  => '.pp-subscribe-content',
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
                                    'selector'  => '.pp-subscribe-content',
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
                                    'selector'  => '.pp-subscribe-content',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    )
				)
			),
			'box_overlay'	=> array(
				'title'				=> __('Overlay', 'bb-powerpack'),
				'fields'			=> array(
					'show_overlay'		=> array(
						'type'				=> 'pp-switch',
						'label'				=> __('Show Overlay', 'bb-powerpack'),
						'default'			=> 'yes',
						'options'			=> array(
							'yes'				=> __('Yes', 'bb-powerpack'),
							'no'				=> __('No', 'bb-powerpack')
						),
						'toggle'			=> array(
							'yes'				=> array(
								'fields'			=> array('overlay_color', 'overlay_opacity')
							)
						),
						'preview'       	=> array(
	                        'type'      		=> 'none',
	                    )
					),
					'overlay_color'		=> array(
						'type'          	=> 'color',
	                    'label'         	=> __('Color', 'bb-powerpack'),
	                    'default'       	=> '000000',
	                    'show_reset'    	=> false,
	                    'preview'       	=> array(
	                        'type'      		=> 'none',
	                    )
					),
					'overlay_opacity'	=> array(
	                    'type'          	=> 'text',
	                    'label'             => __('Opacity', 'bb-powerpack'),
	                    'size'          	=> '5',
						'maxlength'			=> '3',
	                    'description'       => '%',
	                    'default'           => '50',
						'preview'       	=> array(
	                        'type'      		=> 'none',
	                    )
	                ),
				)
			),
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
	                        'selector'  => '.pp-subscribe-form',
	                        'property'  => 'background-color'
	                    )
	                ),
	                'form_background_opacity'    => array(
	                    'type'                 => 'text',
	                    'label'                => __('Background Opacity', 'bb-powerpack'),
	                    'size'          		=> '5',
						'maxlength'				=> 3,
	                    'description'          => '%',
	                    'default'              => '100',
	                    'preview'              => array(
	                        'type'             => 'css',
	                        'selector'         => '.pp-subscribe-form',
	                        'property'         => 'opacity',
	                    )
	                ),
	                'form_bg_image'     => array(
	                	'type'              => 'photo',
	                    'label'         	=> __('Background Image', 'bb-powerpack'),
	                    'default'       	=> '',
	                    'preview'       	=> array(
	                        'type'      		=> 'css',
	                        'selector'  		=> '.pp-subscribe-form',
	                        'property'  		=> 'background-image'
	                    )
	                ),
	                'form_bg_size'      => array(
	                    'type'         		=> 'pp-switch',
	                    'label'         	=> __('Background Size', 'bb-powerpack'),
	                    'default'       	=> 'cover',
	                    'options'       	=> array(
	                        'contain'   		=> __('Contain', 'bb-powerpack'),
	                        'cover'     		=> __('Cover', 'bb-powerpack'),
	                    )
	                ),
	                'form_bg_repeat'    => array(
	                    'type'          	=> 'pp-switch',
	                    'label'         	=> __('Background Repeat', 'bb-powerpack'),
	                    'default'       	=> 'no-repeat',
	                    'options'       	=> array(
	                        'repeat-x'      	=> __('Repeat X', 'bb-powerpack'),
	                        'repeat-y'      	=> __('Repeat Y', 'bb-powerpack'),
	                        'no-repeat'     	=> __('No Repeat', 'bb-powerpack'),
	                    )
	                ),
				)
			),
			'form_border_setting'	=> array( // Section
                'title'         		=> __('Border', 'bb-powerpack'), // Section Title
                'fields'        		=> array( // Section Fields
                    'form_border_style'	=> array(
                        'type'          	=> 'pp-switch',
                        'label'         	=> __('Border Style', 'bb-powerpack'),
                        'default'       	=> 'none',
                        'options'			=> array(
                            'none'				=> __('None', 'bb-powerpack'),
                            'solid'				=> __('Solid', 'bb-powerpack'),
                       		'dashed'			=> __('Dashed', 'bb-powerpack'),
                       		'dotted'			=> __('Dotted', 'bb-powerpack'),
                        ),
                        'preview'	=> array(
                            'type'      => 'css',
                            'selector'  => '.pp-subscribe-form',
                            'property'  => 'border-style'
                        ),
                        'toggle'    => array(
                            'solid' 	=> array(
                                'fields'    => array('form_border_width', 'form_border_color')
                            ),
                            'dashed'	=> array(
                                'fields'	=> array('form_border_width', 'form_border_color')
                            ),
                            'dotted'	=> array(
                                'fields'    => array('form_border_width', 'form_border_color')
                            )
                        )
                    ),
                    'form_border_width'	=> array(
                        'type'          	=> 'text',
                        'label'         	=> __('Border Width', 'bb-powerpack'),
                        'description'   	=> 'px',
                        'size'         		=> 5,
                        'default'       	=> 2,
                        'preview'       	=> array(
                            'type'      		=> 'css',
                            'selector'  		=> '.pp-subscribe-form',
                            'property'  		=> 'border-width',
                            'unit'      		=> 'px'
                        )
                    ),
                    'form_border_color'	=> array(
                        'type'          	=> 'color',
                        'label'         	=> __('Border Color', 'bb-powerpack'),
                        'default'       	=> 'ffffff',
                        'show_reset'    	=> true,
                        'preview'       	=> array(
                            'type'      		=> 'css',
                            'selector'  		=> '.pp-subscribe-form',
                            'property'  		=> 'border-color'
                        )
                    ),
                )
            ),
			'form_box_shadow'	=> array( // Section
                'title'         	=> __('Shadow', 'bb-powerpack'), // Section Title
                'fields'        	=> array( // Section Fields
                    'form_shadow_display'	=> array(
                        'type'                 	=> 'pp-switch',
                        'label'                	=> __('Enable Shadow', 'bb-powerpack'),
                        'default'              	=> 'no',
                        'options'              	=> array(
                            'yes'          			=> __('Yes', 'bb-powerpack'),
                            'no'             		=> __('No', 'bb-powerpack'),
                        ),
                        'toggle'	=>  array(
                            'yes'   	=> array(
                                'fields'	=> array('form_shadow', 'form_shadow_color', 'form_shadow_opacity')
                            )
                        )
                    ),
                    'form_shadow'	=> array(
						'type'          => 'pp-multitext',
						'label'         => __('Box Shadow', 'bb-powerpack'),
						'default'       => array(
							'vertical'		=> 0,
							'horizontal'	=> 0,
							'blur'			=> 10,
							'spread'		=> 5
						),
						'options'	=> array(
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
						'size'          	=> '5',
						'maxlength'			=> 3,
                        'default'           => 15,
                    ),
                )
            ),
			'form_corners_padding'      => array( // Section
                'title'         => __('Form Structure', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'form_border_radius' 	=> array(
                        'type'          => 'text',
                        'label'         => __('Round Corners', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => 2,
                        'size'         => 5,
                        'preview'       => array(
                            'type'      => 'css',
                            'selector'  => '.pp-subscribe-form',
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
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-form',
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
                                    'selector'  => '.pp-subscribe-form',
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
                                    'selector'  => '.pp-subscribe-form',
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
                                    'selector'  => '.pp-subscribe-form',
                                    'property'  => 'padding-right',
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
                            'selector'              => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
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
                            'selector'          => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
                            'property'          => 'background-color'
                        )
                    ),
                    'input_field_background_opacity'    => array(
                        'type'                 => 'text',
                        'label'                => __('Background Opacity', 'bb-powerpack'),
						'size'          		=> '5',
						'maxlength'				=> 3,
                        'description'          => '%',
                        'default'              => '100',
                        'preview'              => array(
                            'type'             => 'css',
                            'selector'         => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
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
                            'selector'          => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
                            'property'          => 'border-color'
                        )
                    ),
					'input_border_width'   => array(
                        'type'          => 'pp-multitext',
						'description'	=> 'px',
						'label'         => __('Border Width', 'bb-powerpack'),
                        'default'       => array(
                            'top'   => 1,
                            'bottom'   => 1,
                            'left'   => 1,
							'right'	=> 1
                        ),
						'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-form input[type=text], .pp-subscribe-form input[type=email]',
                                    'property'  => 'border-top-width',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-form input[type=text], .pp-subscribe-form input[type=email]',
                                    'property'  => 'border-bottom-width',
                                    'unit'      => 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Left', 'bb-powerpack'),
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-form input[type=text], .pp-subscribe-form input[type=email]',
                                    'property'  => 'border-left-width',
                                    'unit'      => 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Right', 'bb-powerpack'),
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-form input[type=text], .pp-subscribe-form input[type=email]',
                                    'property'  => 'border-right-width',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    ),
                    'input_field_focus_color'      => array(
                        'type'                  => 'color',
                        'label'                 => __('Focus Border Color', 'bb-powerpack'),
                        'default'               => '719ece',
                        'show_reset'            => true,
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.pp-subscribe-form textarea:focus, .pp-subscribe-form input[type=text]:focus, .pp-subscribe-form input[type=tel]:focus, .pp-subscribe-form input[type=email]:focus',
                            'property'          => 'border-color'
                        )
                    ),
                )
            ),
            'input_general_style'      => array( // Section
                'title'         => __('Structure', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
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
						'size'          		=> '5',
						'maxlength'				=> 3,
                        'preview'                  => array(
                            'type'                 => 'css',
                            'selector'             => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
                            'property'             => 'border-radius',
                            'unit'                 => 'px'
                        )
                    ),
                    'input_field_box_shadow'   => array(
                        'type'                 => 'pp-switch',
                        'label'                => __('Box Shadow', 'bb-powerpack'),
                        'default'              => 'no',
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
                            'selector'  => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
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
                        'description'   => 'px',
                        'default'       => array(
                            'top' => 10,
                            'right' => 10,
                            'bottom' => 10,
                            'left' => 10,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
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
                                    'selector'  => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
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
                                    'selector'  => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
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
                                    'selector'  => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    ),
					'input_height' => array(
						'type'          => 'text',
						'label'         => __( 'Height', 'bb-powerpack' ),
						'default'       => '38',
						'description'   => 'px',
						'maxlength'     => '3',
						'size'          => '5',
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
                        'default'               => 'dddddd',
                        'show_reset'            => true,
                        'preview'               => array(
                            'type'              => 'css',
                            'selector'          => '.pp-subscribe-form input[type=text]::-webkit-input-placeholder, .pp-subscribe-form input[type=tel]::-webkit-input-placeholder, .pp-subscribe-form input[type=email]::-webkit-input-placeholder, .pp-subscribe-form textarea::-webkit-input-placeholder',
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
						'label'         => __( 'Button Text', 'bb-powerpack' ),
						'default'       => __( 'Subscribe!', 'bb-powerpack' )
					),
					'btn_icon'      => array(
						'type'          => 'icon',
						'label'         => __( 'Button Icon', 'bb-powerpack' ),
						'show_remove'   => true
					),
					'btn_icon_size'    => array(
                        'type'                     => 'text',
                        'label'                    => __('Icon Size', 'bb-powerpack'),
                        'description'              => 'px',
                        'default'                  => '14',
						'size'          		=> '5',
						'maxlength'				=> 3,
                        'preview'                  => array(
                            'type'                 => 'css',
                            'selector'             => '.pp-subscribe-form a.fl-button .fl-button-icon, .pp-subscribe-form a.fl-button .fl-button-icon:before',
                            'property'             => 'font-size',
                            'unit'                 => 'px'
                        )
                    ),
					'btn_icon_position' => array(
						'type'          => 'pp-switch',
						'label'         => __('Icon Position', 'bb-powerpack'),
						'default'       => 'before',
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
				'title'         => __( 'Colors', 'bb-powerpack' ),
				'fields'        => array(
					'btn_bg_color'  => array(
						'type'          => 'color',
						'label'         => __( 'Background Color', 'bb-powerpack' ),
						'default'       => '3074b0',
						'show_reset'    => true
					),
					'btn_bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __( 'Background Hover Color', 'bb-powerpack' ),
						'default'       => '428bca',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'btn_text_color' => array(
						'type'          => 'color',
						'label'         => __( 'Text Color', 'bb-powerpack' ),
						'default'       => 'ffffff',
						'show_reset'    => true
					),
					'btn_text_hover_color' => array(
						'type'          => 'color',
						'label'         => __( 'Text Hover Color', 'bb-powerpack' ),
						'default'       => 'ffffff',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
			'btn_style'     => array(
				'title'         => __( 'Style', 'bb-powerpack' ),
				'fields'        => array(
					'btn_style'     => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Style', 'bb-powerpack' ),
						'default'       => 'flat',
						'options'       => array(
							'flat'          => __( 'Flat', 'bb-powerpack' ),
							'gradient'      => __( 'Gradient', 'bb-powerpack' ),
						),
					),
					'btn_bg_opacity' => array(
						'type'          => 'text',
						'label'         => __( 'Background Opacity', 'bb-powerpack' ),
						'default'       => '100',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					),
					'btn_bg_hover_opacity' => array(
						'type'          => 'text',
						'label'         => __('Background Hover Opacity', 'bb-powerpack'),
						'default'       => '100',
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
							'disable'        => __('Disabled', 'bb-powerpack'),
							'enable'         => __('Enabled', 'bb-powerpack')
						)
					)
				)
			),
			'btn_border_setting'	=> array(
				'title'	=>	__('Border', 'bb-powerpack'),
				'fields'	=> array(
					'button_border_size'   => array(
                        'type'          => 'pp-multitext',
						'description'	=> 'px',
						'label'         => __('Border Width', 'bb-powerpack'),
                        'default'       => array(
                            'top'   => 1,
                            'bottom'   => 1,
                            'left'   => 1,
							'right'	=> 1
                        ),
						'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-form a.fl-button',
                                    'property'  => 'border-top-width',
                                    'unit'      => 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-form a.fl-button',
                                    'property'  => 'border-bottom-width',
                                    'unit'      => 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Left', 'bb-powerpack'),
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-form a.fl-button',
                                    'property'  => 'border-left-width',
                                    'unit'      => 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Right', 'bb-powerpack'),
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-form a.fl-button',
                                    'property'  => 'border-right-width',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
                    ),
					'btn_border_color' => array(
						'type'          => 'color',
						'label'         => __( 'Border Color', 'bb-powerpack' ),
						'default'       => '',
						'show_reset'    => true
					),
					'btn_border_hover_color' => array(
						'type'          => 'color',
						'label'         => __( 'Border Hover Color', 'bb-powerpack' ),
						'default'       => '',
						'show_reset'    => true
					),
				)
			),
			'btn_structure' => array(
				'title'         => __( 'Structure', 'bb-powerpack' ),
				'fields'        => array(
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
					'btn_border_radius' => array(
						'type'          => 'text',
						'label'         => __( 'Round Corners', 'bb-powerpack' ),
						'default'       => '4',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
						'preview'		=> array(
							'type'	=> 'css',
							'selector'	=> '.pp-subscribe-form a.fl-button',
							'property'	=> 'border-radius',
							'unit'		=> 'px'
						)
					),
					'button_padding'   => array(
						'type' 			=> 'pp-multitext',
                        'label' 		=> __('Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => array(
                            'top' => 10,
                            'right' => 20,
                            'bottom' => 10,
                            'left' =>20,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'  => '.pp-subscribe-form a.fl-button',
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
                                    'selector'  => '.pp-subscribe-form a.fl-button',
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
                                    'selector'  => '.pp-subscribe-form a.fl-button',
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
                                    'selector'  => '.pp-subscribe-form a.fl-button',
                                    'property'  => 'padding-right',
                                    'unit'      => 'px'
                                )
                            ),
                        ),
					),
					'btn_margin' => array(
						'type'          => 'text',
						'label'         => __( 'Margin Top', 'bb-powerpack' ),
						'default'       => '0',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
					),
					'btn_height' => array(
						'type'          => 'text',
						'label'         => __( 'Height', 'bb-powerpack' ),
						'default'       => '38',
						'description'   => 'px',
						'maxlength'     => '3',
						'size'          => '5',
					),
				)
			)
		)
	),
	'form_messages_setting' => array(
        'title' => __('Messages', 'bb-powerpack'),
        'sections'  => array(
			'form_error_styling'    => array( // Section
                'title'             => __('Error Message', 'bb-powerpack'), // Section Title
                'fields'            => array( // Section Fields
                    'validation_message_color'    => array(
                        'type'                    => 'color',
                        'label'                   => __('Color', 'bb-powerpack'),
                        'default'                 => 'dd4420',
                        'preview'                 => array(
                            'type'                => 'css',
                            'selector'            => '.pp-subscribe-form .pp-form-error-message',
                            'property'            => 'color'
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
                            'selector'                 => '.pp-subscribe-form .pp-form-success-message',
                            'property'                 => 'color'
                        )
                    ),
					'success_action' => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Success Action', 'bb-powerpack' ),
						'default'		=> 'message',
						'options'       => array(
							'message'       => __( 'Message', 'bb-powerpack' ),
							'redirect'      => __( 'Redirect', 'bb-powerpack' )
						),
						'toggle'        => array(
							'message'       => array(
								'sections'		=> array('form_success_typography'),
								'fields'        => array( 'success_message', 'success_message_color' )
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
						'default'       => __( 'Thanks for subscribing! Please check your email for further instructions.', 'bb-powerpack' ),
						'connections'   => array( 'string', 'html', 'url' ),
						'preview'       => array(
							'type'             => 'none'
						)
					),
					'success_url'  => array(
						'type'          => 'link',
						'label'         => __( 'Success URL', 'bb-powerpack' ),
						'connections'   => array( 'url' ),
						'preview'       => array(
							'type'             => 'none'
						)
					)
                )
            ),
		)
	),
	'form_typography'       => array( // Tab
        'title'         => __('Typography', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
			'box_content_typography'       => array( // Section
                'title'         => __('Content', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'content_font_family' => array(
                        'type'          => 'font',
                        'default'		=> array(
                            'family'		=> 'Default',
                            'weight'		=> 300
                        ),
                        'label'         => __('Font', 'bb-powerpack'),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-subscribe-content',
                        )
                    ),
					'content_font_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Font Size', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  	=> __('Default', 'bb-powerpack'),
                            'custom'                	=> __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('content_font_size_custom')
							)
						)
                    ),
                    'content_font_size_custom'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Font Size', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   	=> 16,
                            'tablet'   		=> '',
                            'mobile'   		=> '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-subscribe-content',
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
					'content_line_height'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Line Height', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  	=> __('Default', 'bb-powerpack'),
                            'custom'                	=> __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('content_line_height_custom')
							)
						)
                    ),
					'content_line_height_custom'   => array(
                        'type'          => 'pp-multitext',
						'label'         => __('Custom Line Height', 'bb-powerpack'),
                        'default'       => array(
                            'desktop'   	=> 1.4,
                            'tablet'   		=> '',
                            'mobile'   		=> '',
                        ),
                        'options'       => array(
                            'desktop'   => array(
                                'placeholder'   => __('Desktop', 'bb-powerpack'),
                                'icon'          => 'fa-desktop',
                                'maxlength'     => 3,
                                'tooltip'       => __('Desktop', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'      => '.pp-subscribe-content',
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
                            'selector'        => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
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
                                    'selector'      => '.pp-subscribe-form textarea, .pp-subscribe-form input[type=text], .pp-subscribe-form input[type=tel], .pp-subscribe-form input[type=email]',
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
			'placeholder_typography'	=> array(
				'title'	=> __( 'Placeholder', 'bb-powerpack' ),
				'fields'	=> array(
					'placeholder_size'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Font Size', 'bb-powerpack'),
                        'default'                   => 'default',
                        'options'                   => array(
                            'default'                  => __('Default', 'bb-powerpack'),
                            'custom'                => __('Custom', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('placeholder_font_size')
							)
						)
                    ),
                    'placeholder_font_size'   => array(
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
                                    'selector'      => '.pp-subscribe-form input[type=text]::-webkit-input-placeholder, .pp-subscribe-form input[type=email]::-webkit-input-placeholder',
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
					'placeholder_text_transform'    => array(
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
                            'selector'        => '.pp-subscribe-form a.fl-button'
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
                                    'selector'      => '.pp-subscribe-form a.fl-button',
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
							'selector'	=> '.pp-subscribe-form a.fl-button',
							'property'	=> 'text-transform'
						)
                    ),
                )
            ),
			'errors_typography'       => array( // Section
                'title'         => __('Error Message', 'bb-powerpack'), // Section Title
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
                                    'selector'      => '.pp-subscribe-form .pp-form-error-message',
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
					'error_text_transform'    => array(
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
                                    'selector'      => '.pp-subscribe-form .pp-form-success-message',
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
					'success_message_text_transform'    => array(
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
		),
	),
));
