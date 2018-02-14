<?php

/**
 * @class PP3dSliderModule
 */
class PP3dSliderModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('3D Slider', 'bb-powerpack'),
            'description'   => __('3D Slider.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-3d-slider/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-3d-slider/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));

        $this->add_css( 'font-awesome' );
        $this->add_js( 'modernizr-custom', BB_POWERPACK_URL . 'modules/pp-3d-slider/js/modernizr.custom.53451.js' );
    }

    /**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Cache the photo data if using the WordPress media library.
		$settings->photo_data = $this->get_wordpress_photos();

		return $settings;
	}

    /**
	 * @method get_photos
	 */
	public function get_photos()
	{
		$default_order 	= $this->get_wordpress_photos();

		$photos_id = $default_order;

		return $photos_id;
	}

	/**
	 * @method get_wordpress_photos
	 */
	public function get_wordpress_photos()
	{
		$photos     = array();
		$ids        = $this->settings->photos;
		$medium_w   = get_option('medium_size_w');
		$large_w    = get_option('large_size_w');

		/* Template Cache */
		$photo_from_template = false;
		$photo_attachment_data = false;

		if(empty($ids)) {
			return $photos;
		}

		/* Check if all photos are available on host */
		foreach ($ids as $id) {
			$photo_attachment_data[$id] = FLBuilderPhoto::get_attachment_data($id);

			if ( ! $photo_attachment_data[$id] ) {
				$photo_from_template = true;
			}
		}

		foreach($ids as $id) {

			$photo = $photo_attachment_data[$id];

			// Use the cache if we didn't get a photo from the id.
			if ( ! $photo && $photo_from_template ) {

				if ( ! isset( $this->settings->photo_data ) ) {
					continue;
				}
				else if ( is_array( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data[ $id ];
				}
				else if ( is_object( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data->{$id};
				}
				else {
					continue;
				}
			}

			// Only use photos who have the sizes object.
			if(isset($photo->sizes)) {

				$data = new stdClass();

				// Photo data object
				$data->id = $id;
				$data->alt = $photo->alt;
				$data->caption = $photo->caption;
				$data->description = $photo->description;
				$data->title = $photo->title;

                $data->src = $photo->sizes->full->url;

				// Photo Link
				if(isset($photo->sizes->large)) {
					$data->link = $photo->sizes->large->url;
				}
				else {
					$data->link = $photo->sizes->full->url;
				}

                $data->url = get_post_meta( $id, 'pp-custom-link', true );

				$photos[$id] = $data;
			}

		}

		return $photos;
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PP3dSliderModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Photos', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'photos'        => array(
                        'type'          => 'multiple-photos',
                        'label'         => __('Upload Photos', 'bb-powerpack'),
                        'connections'   => array( 'multiple-photos' ),
                        'help'          => __('Upload minimum of 3 photos.', 'bb-powerpack')
                    ),
					'show_captions' => array(
						'type'          => 'pp-switch',
						'label'         => __('Show Captions', 'bb-powerpack'),
						'default'       => 'no',
						'options'       => array(
							'yes'           => __('Yes', 'bb-powerpack'),
							'no'            => __('No', 'bb-powerpack'),
						),
                        'toggle'        => array(
                            'yes'           => array(
                                'sections'      => array('captions_style')
                            )
                        ),
						'help'          => __('The caption pulls from whatever text you put in the caption area in the media manager for each image.', 'bb-powerpack')
					),
                    'autoplay'  => array(
                        'type'      => 'pp-switch',
                        'label'     => __('Autoplay', 'bb-powerpack'),
                        'default'   => 'no',
                        'options'   => array(
                            'yes'       => __('Yes', 'bb-powerpack'),
                            'no'        => __('No', 'bb-powerpack'),
                        ),
                        'toggle'        => array(
                            'yes'           => array(
                                'fields'        => array('autoplay_interval')
                            ),
                            'no'            => array(
                                'sections'      => array('nav_style')
                            )
                        ),
                    ),
                    'autoplay_interval' => array(
                        'type'              => 'text',
                        'label'             => __('Interval', 'bb-powerpack'),
                        'default'           => 2,
                        'size'              => 5,
                        'description'       => __('seconds', 'bb-powerpack')
                    )
                )
            )
        )
    ),
    'style' => array(
        'title'     => __('Style', 'bb-powerpack'),
        'sections'  => array(
            'photo_style'   => array(
                'title'         => __('Photo', 'bb-powerpack'),
                'fields'        => array(
                    'enable_photo_border'   => array(
                        'type'                  => 'pp-switch',
                        'label'                 => __('Enable Border', 'bb-powerpack'),
                        'default'               => 'no',
                        'options'               => array(
                            'yes'                   => __('Yes', 'bb-powerpack'),
                            'no'                    => __('No', 'bb-powerpack')
                        ),
                        'toggle'                => array(
                            'yes'                   => array(
                                'fields'                => array('photo_border', 'photo_border_color')
                            )
                        )
                    ),
                    'photo_border'  => array(
                        'type'          => 'pp-multitext',
                        'label'         => __('Border', 'bb-powerpack'),
						'default'       => array(
							'top'			=> 0,
							'bottom'	    => 0,
							'left'			=> 0,
							'right'		    => 0
						),
                        'options'           => array(
                            'top'               => array(
                                'placeholder'       => __('Top', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-up',
                                'preview'           => array(
                                    'selector'          => '.pp-3d-slider .pp-slider-img',
                                    'property'          => 'border-top-width',
                                    'unit'              => 'px'
                                ),
                                'tooltip'           => __('Top', 'bb-powerpack')
                            ),
                            'bottom'            => array(
                                'placeholder'       => __('Bottom', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-down',
                                'preview'           => array(
                                    'selector'          => '.pp-3d-slider .pp-slider-img',
                                    'property'          => 'border-bottom-width',
                                    'unit'              => 'px'
                                ),
                                'tooltip'           => __('Bottom', 'bb-powerpack')
                            ),
                            'left'            => array(
                                'placeholder'       => __('Left', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-left',
                                'preview'           => array(
                                    'selector'          => '.pp-3d-slider .pp-slider-img',
                                    'property'          => 'border-left-width',
                                    'unit'              => 'px'
                                ),
                                'tooltip'           => __('Left', 'bb-powerpack')
                            ),
                            'right'            => array(
                                'placeholder'       => __('Right', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-right',
                                'preview'           => array(
                                    'selector'          => '.pp-3d-slider .pp-slider-img',
                                    'property'          => 'border-right-width',
                                    'unit'              => 'px'
                                ),
                                'tooltip'           => __('Right', 'bb-powerpack')
                            ),
                        )
                    ),
                    'photo_border_color'    => array(
                        'type'                  => 'color',
                        'label'                 => __('Border Color', 'bb-powerpack'),
                        'default'               => '',
                        'preview'               => array(
                            'type'                  => 'css',
                            'selector'              => '.pp-3d-slider .pp-slider-img',
                            'property'              => 'border-color',
                        )
                    )
                )
            ),
            'captions_style'    => array(
                'title'             => __('Caption', 'bb-powerpack'),
                'fields'            => array(
                    'caption_color'      => array(
                        'type'              => 'color',
                        'label'             => __('Color', 'bb-powerpack'),
                        'default'           => '',
                        'show_reset'        => true,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-3d-slider .pp-slider-img-caption',
                            'property'          => 'color'
                        )
                    ),
                )
            ),
            'nav_style'     => array(
                'title'             => __('Navigation Arrows', 'bb-powerpack'),
                'fields'            => array(
                    'arrow_color'       => array(
                        'type'              => 'color',
                        'label'             => __('Color', 'bb-powerpack'),
                        'default'           => '333333',
                        'show_reset'        => true,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-3d-slider .pp-slider-nav .fa',
                            'property'          => 'color'
                        )
                    ),
                    'arrow_hover_color' => array(
                        'type'              => 'color',
                        'label'             => __('Hover Color', 'bb-powerpack'),
                        'default'           => '333333',
                        'show_reset'        => true,
                        'preview'           => array(
                            'type'              => 'none'
                        )
                    ),
                    'arrow_bg_color'    => array(
                        'type'              => 'color',
                        'label'             => __('Background Color', 'bb-powerpack'),
                        'default'           => '',
                        'show_reset'        => true,
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-3d-slider .pp-slider-nav .fa',
                            'property'          => 'background-color'
                        )
                    ),
                    'arrow_bg_hover_color'  => array(
                        'type'                  => 'color',
                        'label'                 => __('Background Hover Color', 'bb-powerpack'),
                        'default'               => '',
                        'show_reset'            => true,
                        'preview'               => array(
                            'type'                  => 'none'
                        )
                    ),
                    'arrow_radius'   => array(
                        'type'          => 'text',
                        'label'         => __('Round Corners', 'bb-powerpack'),
                        'default'       => 0,
                        'description'   => '%',
                        'size'          => 5,
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-3d-slider .pp-slider-nav .fa',
                            'property'      => 'border-radius',
                            'unit'          => '%'
                        )
                    )
                )
            )
        )
    )
));
