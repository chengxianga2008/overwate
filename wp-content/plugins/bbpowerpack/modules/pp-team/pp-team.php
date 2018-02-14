<?php

/**
 * @class PPTeamModule
 */
class PPTeamModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Team', 'bb-powerpack'),
            'description'   => __('Team module.', 'bb-powerpack'),
            'category'		=> BB_POWERPACK_CAT,
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-team/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-team/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));

        $this->add_css('font-awesome');
    }

    /**
	 * @property $data
	 */
	public $data = null;

	/**
	 * @property $_editor
	 * @protected
	 */
	protected $_editor = null;

    /**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Make sure we have a photo_src property.
		if(!isset($settings->member_image_src)) {
			$settings->member_image_src = '';
		}

		// Cache the attachment data.
		$data = FLBuilderPhoto::get_attachment_data($settings->member_image);

		if($data) {
			$settings->data = $data;
		}

		// Save a crop if necessary.
		$this->crop();

		return $settings;
	}

	/**
	 * @method delete
	 */
	public function delete()
	{
		$cropped_path = $this->_get_cropped_path();

		if(file_exists($cropped_path['path'])) {
			unlink($cropped_path['path']);
		}
	}

	/**
	 * @method crop
	 */
	public function crop()
	{
		// Delete an existing crop if it exists.
		$this->delete();

		// Do a crop.
		if(!empty($this->settings->member_image_crop)) {

			$editor = $this->_get_editor();

			if(!$editor || is_wp_error($editor)) {
				return false;
			}

			$cropped_path = $this->_get_cropped_path();
			$size         = $editor->get_size();
			$new_width    = $size['width'];
			$new_height   = $size['height'];

			if($this->settings->member_image_crop == 'portrait') {
				$ratio_1 = .7;
				$ratio_2 = 1.43;
			}
			elseif($this->settings->member_image_crop == 'square') {
				$ratio_1 = 1;
				$ratio_2 = 1;
			}
			elseif($this->settings->member_image_crop == 'circle') {
				$ratio_1 = 1;
				$ratio_2 = 1;
			}

			// Get the new width or height.
			if($size['width'] / $size['height'] < $ratio_1) {
				$new_height = $size['width'] * $ratio_2;
			}
			else {
				$new_width = $size['height'] * $ratio_1;
			}

			// Make sure we have enough memory to crop.
			@ini_set('memory_limit', '300M');

			// Crop the photo.
			$editor->resize($new_width, $new_height, true);

			// Save the photo.
			$editor->save($cropped_path['path']);

			// Return the new url.
			return $cropped_path['url'];
		}

		return false;
	}

	/**
	 * @method get_data
	 */
	public function get_data()
	{
		if(!$this->data) {

			// Photo source is set to "library".
			if(is_object($this->settings->member_image)) {
				$this->data = $this->settings->member_image;
			}
			else {
				$this->data = FLBuilderPhoto::get_attachment_data($this->settings->member_image);
			}

			// Data object is empty, use the settings cache.
			if(!$this->data && isset($this->settings->data)) {
				$this->data = $this->settings->data;
			}
		}

		return $this->data;
	}

	/**
	 * @method get_classes
	 */
	public function get_classes()
	{
		$classes = array( 'fl-photo-img' );

		if ( ! empty( $this->settings->member_image ) ) {

			$data = self::get_data();

			if ( is_object( $data ) ) {

				$classes[] = 'wp-image-' . $data->id;

				if ( isset( $data->sizes ) ) {

					foreach ( $data->sizes as $key => $size ) {

							$classes[] = 'size-' . $key;
							break;
					}
				}
			}
		}

		return implode( ' ', $classes );
	}

	/**
	 * @method get_src
	 */
	public function get_src()
	{
		$src = $this->_get_uncropped_url();

		// Return a cropped photo.
		if(!empty($this->settings->member_image_crop)) {

			$cropped_path = $this->_get_cropped_path();

			// See if the cropped photo already exists.
			if(file_exists($cropped_path['path'])) {
				$src = $cropped_path['url'];
			}
			// It doesn't, check if this is a demo image.
			elseif(stristr($src, FL_BUILDER_DEMO_URL) && !stristr(FL_BUILDER_DEMO_URL, $_SERVER['HTTP_HOST'])) {
				$src = $this->_get_cropped_demo_url();
			}
			// It doesn't, check if this is a OLD demo image.
			elseif(stristr($src, FL_BUILDER_OLD_DEMO_URL)) {
				$src = $this->_get_cropped_demo_url();
			}
			// A cropped photo doesn't exist, try to create one.
			else {

				$url = $this->crop();

				if($url) {
					$src = $url;
				}
			}
		}

		return $src;
	}

	/**
	 * @method get_link
	 */
	public function get_link()
	{
		$photo = $this->get_data();

		$link = $this->settings->link_url;

		return $link;
	}

	/**
	 * @method get_alt
	 */
	public function get_alt()
	{
		$photo = $this->get_data();

		if(!empty($photo->alt)) {
			return htmlspecialchars($photo->alt);
		}
		else if(!empty($photo->description)) {
			return htmlspecialchars($photo->description);
		}
		else if(!empty($photo->caption)) {
			return htmlspecialchars($photo->caption);
		}
		else if(!empty($photo->title)) {
			return htmlspecialchars($photo->title);
		}
	}

	/**
	 * @method get_attributes
	 */
	public function get_attributes()
	{
		$attrs = '';

		if ( isset( $this->settings->attributes ) ) {
			foreach ( $this->settings->attributes as $key => $val ) {
				$attrs .= $key . '="' . $val . '" ';
			}
		}

		return $attrs;
	}

	/**
	 * @method _has_source
	 * @protected
	 */
	protected function _has_source()
	{
		if(!empty($this->settings->link_url)) {
			return true;
		}

		return false;
	}

	/**
	 * @method _get_editor
	 * @protected
	 */
	protected function _get_editor()
	{
		if($this->_editor === null) {

			$url_path  = $this->_get_uncropped_url();
			$file_path = str_ireplace(home_url(), ABSPATH, $url_path);

			if(file_exists($file_path)) {
				$this->_editor = wp_get_image_editor($file_path);
			}
			else {
				$this->_editor = wp_get_image_editor($url_path);
			}
		}

		return $this->_editor;
	}

	/**
	 * @method _get_cropped_path
	 * @protected
	 */
	protected function _get_cropped_path()
	{
		$crop        = empty($this->settings->member_image_crop) ? 'none' : $this->settings->member_image_crop;
		$url         = $this->_get_uncropped_url();
		$cache_dir   = FLBuilderModel::get_cache_dir();

		if(empty($url)) {
			$filename    = uniqid(); // Return a file that doesn't exist.
		}
		else {

			if ( stristr( $url, '?' ) ) {
				$parts = explode( '?', $url );
				$url   = $parts[0];
			}

			$pathinfo    = pathinfo($url);
			$dir         = $pathinfo['dirname'];
			$ext         = $pathinfo['extension'];
			$name        = wp_basename($url, ".$ext");
			$new_ext     = strtolower($ext);
			$filename    = "{$name}-{$crop}.{$new_ext}";
		}

		return array(
			'filename' => $filename,
			'path'     => $cache_dir['path'] . $filename,
			'url'      => $cache_dir['url'] . $filename
		);
	}

	/**
	 * @method _get_uncropped_url
	 * @protected
	 */
	protected function _get_uncropped_url()
	{
		if(!empty($this->settings->member_image_src)) {
			$url = $this->settings->member_image_src;
		}
		else {
			$url = FL_BUILDER_URL . 'img/pixel.png';
		}

		return $url;
	}

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPTeamModule', array(
    'general'       => array( // Tab
        'title'         => __('Content', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'image_setting' => array(
                'title' => __('Image', 'bb-powerpack'),
                'fields'    => array(
                    'member_image'    => array(
                        'type'          => 'photo',
                        'show_remove'   => true,
                        'label'         => __('Image Source', 'bb-powerpack'),
                    ),
                    'member_image_crop'          => array(
						'type'          => 'select',
						'label'         => __('Crop', 'bb-powerpack'),
						'default'       => '',
						'options'       => array(
							''              => _x( 'None', 'Photo Crop.', 'bb-powerpack' ),
							'portrait'      => __('Portrait', 'bb-powerpack'),
							'square'        => __('Square', 'bb-powerpack'),
							'circle'        => __('Circle', 'bb-powerpack')
						)
					),
                )
            ),
            'member_setting'       => array( // Section
                'title'         => __('Details', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'member_name'     => array(
                        'type'          => 'text',
                        'label'         => __('Name', 'bb-powerpack'),
                        'connections'   => array( 'string', 'html' ),
                        'preview'         => array(
                            'type'             => 'text',
                            'selector'         => '.pp-member-wrapper .pp-member-name',
                        )
                    ),
                    'member_designation'     => array(
                        'type'          => 'text',
                        'label'         => __('Designation', 'bb-powerpack'),
                        'connections'   => array( 'string', 'html' ),
                        'preview'         => array(
                            'type'             => 'text',
                            'selector'         => '.pp-member-wrapper .pp-member-designation',
                        )
                    ),
                    'member_description' => array(
                        'type'          => 'editor',
                        'label'         => '',
                        'media_buttons' => false,
                        'default'       => '',
                        'rows'          => 8,
                        'connections'   => array( 'string', 'html', 'url' ),
                        'preview'         => array(
                            'type'             => 'text',
                            'selector'         => '.pp-member-wrapper .pp-member-description'
                        )
                    ),
                    'link_url'          => array(
						'type'          => 'link',
						'label'         => __('Link URL', 'bb-powerpack'),
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
            'separator_setting' => array(
                'title' =>  __('Separator', 'bb-powerpack'),
                'fields'    => array(
                    'separator_display'   => array(
						'type'          => 'pp-switch',
						'label'         => __('Enable Separator', 'bb-powerpack'),
						'default'       => 'no',
						'options'       => array(
							'yes'        => __('Yes', 'bb-powerpack'),
							'no'         => __('No', 'bb-powerpack'),
						),
                        'toggle'    => array(
                            'yes'   => array(
                                'fields'    =>  array('separator_position'),
                                'sections'  => array('separator_style')
                            )
                        )
					),
                    'separator_position'    => array(
                        'type'          => 'select',
						'label'         => __('Separator Position', 'bb-powerpack'),
						'default'       => 'below_title',
						'options'       => array(
							'below_title'        => __('Below Title', 'bb-powerpack'),
							'below_designation'         => __('Below Designation', 'bb-powerpack'),
						),
                    )
                )
            )
        )
    ),
    'social_icons_settings' => array(
        'title' =>  __('Social Icons', 'bb-powerpack'),
        'sections'  => array(
            'social_icons'  => array(
                'title' => '',
                'fields'    => array(
                    'facebook_url'          => array(
						'type'          => 'text',
						'label'         => __('Facebook URL', 'bb-powerpack'),
					),
                    'twiiter_url'          => array(
						'type'          => 'text',
						'label'         => __('Twitter URL', 'bb-powerpack'),
					),
                    'googleplus_url'          => array(
						'type'          => 'text',
						'label'         => __('Google Plus URL', 'bb-powerpack'),
					),
                    'pinterest_url'          => array(
						'type'          => 'text',
						'label'         => __('Pinterest URL', 'bb-powerpack'),
					),
                    'linkedin_url'          => array(
						'type'          => 'text',
						'label'         => __('Linkedin URL', 'bb-powerpack'),
					),
                    'youtube_url'          => array(
						'type'          => 'text',
						'label'         => __('Youtube URL', 'bb-powerpack'),
					),
                    'instagram_url'          => array(
						'type'          => 'text',
						'label'         => __('Instagram URL', 'bb-powerpack'),
					),
                    'vimeo_url'          => array(
						'type'          => 'text',
						'label'         => __('Vimeo URL', 'bb-powerpack'),
					),
                    'github_url'          => array(
						'type'          => 'text',
						'label'         => __('Github URL', 'bb-powerpack'),
					),
                    'dribbble_url'          => array(
						'type'          => 'text',
						'label'         => __('Dribbble URL', 'bb-powerpack'),
					),
                    'tumblr_url'          => array(
						'type'          => 'text',
						'label'         => __('Tumblr URL', 'bb-powerpack'),
					),
                    'flickr_url'          => array(
						'type'          => 'text',
						'label'         => __('Flickr URL', 'bb-powerpack'),
					),
                )
            )
        )
    ),
    'team_style'    => array(
        'title' => __('Style', 'bb-powerpack'),
        'sections'  => array(
            'general_style' => array(
                'title' => __('Box', 'bb-powerpack'),
                'fields'    => array(
                    'box_background'      => array(
                        'type'      => 'pp-color',
                        'label'     => __('Background Color', 'bb-powerpack'),
                        'show_reset' => true,
                        'default'   => array(
                            'primary'	=> '',
                            'secondary'	=> ''
                        ),
                        'options'	=> array(
                            'primary'	=> __('Default', 'bb-powerpack'),
                            'secondary' => __('Hover', 'bb-powerpack')
                        )
                    ),
                    'box_border'    => array(
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
                            'dashed'   => array(
                                'fields'    => array('box_border_width', 'box_border_color')
                            ),
                            'dotted'   => array(
                                'fields'    => array('box_border_width', 'box_border_color')
                            ),
                            'solid'   => array(
                                'fields'    => array('box_border_width', 'box_border_color')
                            ),
                        ),
                    ),
                    'box_border_width'   => array(
                        'type'      => 'text',
                        'label'     => __('Border Width', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 1,
                        'description'   => 'px',
                        'preview'              => array(
                            'type'				=> 'css',
                            'selector'	=> '.pp-member-wrapper',
                            'property'	=> 'border-width',
                            'unit'		=> 'px'
                        )
                    ),
                    'box_border_color'   => array(
                        'type'      => 'color',
                        'label'     => __('Border Color', 'bb-powerpack'),
                        'show_reset'   => true,
                        'preview'              => array(
                            'type'		=> 'css',
                            'selector'	=> '.pp-member-wrapper',
                            'property'	=> 'border-color',
                        )
                    ),
                    'box_border_radius'   => array(
                        'type'      => 'text',
                        'label'     => __('Round Corners', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 0,
                        'description'   => 'px',
                        'preview'       => array(
                            'type'		=> 'css',
                            'selector'	=> '.pp-member-wrapper',
                            'property'	=> 'border-radius',
                            'unit'		=> 'px'
                        ),
                    ),
                    'box_content_alignment'    => array(
                        'type'      => 'pp-switch',
                        'label'     => __('Text Alignment', 'bb-powerpack'),
                        'default'   => 'center',
                        'options'   => array(
                            'left'  => __('Left', 'bb-powerpack'),
                            'center'  => __('Center', 'bb-powerpack'),
                            'Right'  => __('Right', 'bb-powerpack'),
                        ),
                    ),
                    'box_padding'   => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Box Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => array(
                            'top' => 0,
                            'right' => 0,
                            'bottom' => 0,
                            'left' => 0,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'              => array(
                                    'selector'	=> '.pp-member-wrapper',
                                    'property'	=> 'padding-top',
                                    'unit'		=> 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'              => array(
                                    'selector'	=> '.pp-member-wrapper',
                                    'property'	=> 'padding-bottom',
                                    'unit'		=> 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Left', 'bb-powerpack'),
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'              => array(
                                    'selector'	=> '.pp-member-wrapper',
                                    'property'	=> 'padding-left',
                                    'unit'		=> 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Right', 'bb-powerpack'),
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'              => array(
                                    'selector'	=> '.pp-member-wrapper',
                                    'property'	=> 'padding-right',
                                    'unit'		=> 'px'
                                )
                            ),
                        )
                    ),
                    'box_content_padding'   => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Content Padding', 'bb-powerpack'),
                        'description'   =>'px',
                        'default'       => array(
                            'top' => 0,
                            'right' => 0,
                            'bottom' => 0,
                            'left' => 0,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'              => array(
                                    'selector'	=> '.pp-member-wrapper .pp-member-content',
                                    'property'	=> 'padding-top',
                                    'unit'		=> 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'              => array(
                                    'selector'	=> '.pp-member-wrapper .pp-member-content',
                                    'property'	=> 'padding-bottom',
                                    'unit'		=> 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Left', 'bb-powerpack'),
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'              => array(
                                    'selector'	=> '.pp-member-wrapper .pp-member-content',
                                    'property'	=> 'padding-left',
                                    'unit'		=> 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Right', 'bb-powerpack'),
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'       => array(
                                    'selector'	=> '.pp-member-wrapper .pp-member-content',
                                    'property'	=> 'padding-right',
                                    'unit'		=> 'px'
                                )
                            ),
                        )
                    ),
                )
            ),
            'image_style' => array(
                'title' => __('Image', 'bb-powerpack'),
                'fields'    => array(
                    'image_greyscale'       => array(
						'type'          => 'pp-switch',
						'label'         => __('Greyscale', 'bb-powerpack'),
						'default'       => 'original',
						'options'       => array(
							'original'             => __('Original', 'bb-powerpack'),
							'greyscale'             => __('Greyscale', 'bb-powerpack')
						),
					),
                    'image_border'    => array(
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
                            'dashed'   => array(
                                'fields'    => array('image_border_width', 'image_border_color')
                            ),
                            'dotted'   => array(
                                'fields'    => array('image_border_width', 'image_border_color')
                            ),
                            'solid'   => array(
                                'fields'    => array('image_border_width', 'image_border_color')
                            ),
                        ),
                    ),
                    'image_border_width'   => array(
                        'type'      => 'text',
                        'label'     => __('Border Width', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 1,
                        'description'   => 'px',
                        'preview'              => array(
                            'type'				=> 'css',
                            'selector'	=> '.pp-member-wrapper .pp-member-image img',
                            'property'	=> 'border-width',
                            'unit'		=> 'px'
                        )
                    ),
                    'image_border_color'   => array(
                        'type'      => 'color',
                        'label'     => __('Border Color', 'bb-powerpack'),
                        'show_reset'   => true,
                        'preview'              => array(
                            'type'		=> 'css',
                            'selector'	=> '.pp-member-wrapper .pp-member-image img',
                            'property'	=> 'border-color',
                        )
                    ),
                    'image_border_radius'   => array(
                        'type'      => 'text',
                        'label'     => __('Round Corners', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 0,
                        'description'   => 'px',
                        'preview'       => array(
                            'type'		=> 'css',
                            'selector'	=> '.pp-member-wrapper .pp-member-image img',
                            'property'	=> 'border-radius',
                            'unit'		=> 'px'
                        ),
                    ),
                    'image_shadow_display'   => array(
                        'type'                 => 'pp-switch',
                        'label'                => __('Enable Shadow', 'bb-powerpack'),
                        'default'              => 'no',
                        'options'              => array(
                            'yes'          => __('Yes', 'bb-powerpack'),
                            'no'             => __('No', 'bb-powerpack'),
                        ),
                        'toggle'    =>  array(
                            'yes'   => array(
                                'fields'    => array('image_shadow', 'image_shadow_color', 'image_shadow_opacity')
                            )
                        )
                    ),
                    'image_shadow' 		=> array(
                        'type'              => 'pp-multitext',
                        'label'             => __('Image Shadow', 'bb-powerpack'),
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
                    'image_shadow_color' => array(
                        'type'              => 'color',
                        'label'             => __('Shadow Color', 'bb-powerpack'),
                        'default'           => '000000',
                    ),
                    'image_shadow_opacity' => array(
                        'type'              => 'text',
                        'label'             => __('Shadow Opacity', 'bb-powerpack'),
                        'description'       => '%',
                        'size'             => 5,
                        'default'           => 50,
                    ),
                )
            ),
            'separator_style' => array(
                'title' => __('Separator', 'bb-powerpack'),
                'fields'    => array(
                    'separator_color' => array(
                        'type'              => 'color',
                        'label'             => __('Color', 'bb-powerpack'),
                        'default'           => '000000',
                        'preview'              => array(
                            'type'				=> 'css',
                            'selector'	=> '.pp-member-wrapper .pp-member-separator',
                            'property'	=> 'background-color',
                        )
                    ),
                    'separator_width'   => array(
                        'type'      => 'text',
                        'label'     => __('Width', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 60,
                        'description'   => 'px',
                        'preview'              => array(
                            'type'				=> 'css',
                            'selector'	=> '.pp-member-wrapper .pp-member-separator',
                            'property'	=> 'width',
                            'unit'		=> 'px'
                        )
                    ),
                    'separator_height'   => array(
                        'type'      => 'text',
                        'label'     => __('Height', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 2,
                        'description'   => 'px',
                        'preview'              => array(
                            'type'				=> 'css',
                            'selector'	=> '.pp-member-wrapper .pp-member-separator',
                            'property'	=> 'height',
                            'unit'		=> 'px'
                        )
                    ),
                ),
            ),
            'social_icons_style'    => array(
                'title' => __('Social Icons', 'bb-powerpack'),
                'fields'    => array(
                    'social_links_background'      => array(
                        'type'      => 'pp-color',
                        'label'     => __('Background Color', 'bb-powerpack'),
                        'show_reset' => true,
                        'default'   => array(
                            'primary'	=> '',
                            'secondary'	=> ''
                        ),
                        'options'	=> array(
                            'primary'	=> __('Default', 'bb-powerpack'),
                            'secondary' => __('Hover', 'bb-powerpack')
                        )
                    ),
                    'social_links_color'      => array(
                        'type'      => 'pp-color',
                        'label'     => __('Icon Color', 'bb-powerpack'),
                        'show_reset' => true,
                        'default'   => array(
                            'primary'	=> '666666',
                            'secondary'	=> '333333'
                        ),
                        'options'	=> array(
                            'primary'	=> __('Default', 'bb-powerpack'),
                            'secondary' => __('Hover', 'bb-powerpack')
                        )
                    ),
                    'social_links_font_size'   => array(
                        'type'      => 'text',
                        'label'     => __('Icon Size', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 16,
                        'description'   => 'px',
                        'preview'              => array(
                            'type'				=> 'css',
                            'selector'	=> '.pp-member-social-icons li a::before',
                            'property'	=> 'font-size',
                            'unit'		=> 'px'
                        )
                    ),
                    'social_links_border'    => array(
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
                            'dashed'   => array(
                                'fields'    => array('social_links_border_width', 'social_links_border_color')
                            ),
                            'dotted'   => array(
                                'fields'    => array('social_links_border_width', 'social_links_border_color')
                            ),
                            'solid'   => array(
                                'fields'    => array('social_links_border_width', 'social_links_border_color')
                            ),
                        ),
                    ),
                    'social_links_border_width'   => array(
                        'type'      => 'text',
                        'label'     => __('Border Width', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 1,
                        'description'   => 'px',
                        'preview'              => array(
                            'type'				=> 'css',
                            'selector'	=> '.pp-member-social-icons li a::before',
                            'property'	=> 'border-width',
                            'unit'		=> 'px'
                        )
                    ),
                    'social_links_border_color'   => array(
                        'type'      => 'pp-color',
                        'label'     => __('Border Color', 'bb-powerpack'),
                        'show_reset' => true,
                        'default'   => array(
                            'primary'	=> '666666',
                            'secondary'	=> '333333'
                        ),
                        'options'	=> array(
                            'primary'	=> __('Default', 'bb-powerpack'),
                            'secondary' => __('Hover', 'bb-powerpack')
                        )
                    ),
                    'social_links_border_radius'   => array(
                        'type'      => 'text',
                        'label'     => __('Round Corners', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 0,
                        'description'   => 'px',
                        'preview'       => array(
                            'type'		=> 'css',
                            'selector'	=> '.pp-member-social-icons li a::before',
                            'property'	=> 'border-radius',
                            'unit'		=> 'px'
                        ),
                    ),
                    'social_links_space'   => array(
                        'type'      => 'text',
                        'label'     => __('Space Between Icons', 'bb-powerpack'),
                        'size'      => 5,
                        'maxlength' => 3,
                        'default'   => 10,
                        'description'   => 'px',
                        'preview'       => array(
                            'type'		=> 'css',
                            'selector'	=> '.pp-member-social-icons li',
                            'property'	=> 'margin-right',
                            'unit'		=> 'px'
                        ),
                    ),
                    'social_links_padding'   => array(
                        'type'      => 'pp-multitext',
                        'label'     => __('Padding', 'bb-powerpack'),
                        'description'   => 'px',
                        'default'       => array(
                            'top' => 6,
                            'right' => 5,
                            'bottom' => 6,
                            'left' => 5,
                        ),
                        'options' 		=> array(
                            'top' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-up',
                                'preview'       => array(
                                    'selector'	=> '.pp-member-social-icons li a::before',
                                    'property'	=> 'padding-top',
                                    'unit'		=> 'px'
                                )
                            ),
                            'bottom' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-down',
                                'preview'       => array(
                                    'selector'	=> '.pp-member-social-icons li a::before',
                                    'property'	=> 'padding-bottom',
                                    'unit'		=> 'px'
                                )
                            ),
                            'left' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Left', 'bb-powerpack'),
                                'tooltip'       => __('Left', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-left',
                                'preview'              => array(
                                    'selector'	=> '.pp-member-social-icons li a::before',
                                    'property'	=> 'padding-left',
                                    'unit'		=> 'px'
                                )
                            ),
                            'right' => array(
                                'maxlength' => 3,
                                'placeholder'   => __('Right', 'bb-powerpack'),
                                'tooltip'       => __('Right', 'bb-powerpack'),
                                'icon'		=> 'fa-long-arrow-right',
                                'preview'              => array(
                                    'selector'	=> '.pp-member-social-icons li a::before',
                                    'property'	=> 'padding-right',
                                    'unit'		=> 'px'
                                )
                            ),
                        )
                    ),
                )
            )
        )
    ),
    'typography'	=> array( // Tab
		'title'			=> __('Typography', 'bb-powerpack'),
		'sections'		=> array(
			'title_typography'		=> array(
				'title'		=> __('Name', 'bb-powerpack'),
				'fields' 	=> array(
					'title_tag'		=> array(
						'type'		=> 'select',
						'label'		=> __('HTML Tag', 'bb-powerpack'),
						'options'	=> array(
							'h1'	=> 'H1',
							'h2'	=> 'H2',
							'h3'	=> 'H3',
							'h4'	=> 'H4',
							'h5'	=> 'H5',
							'h6'	=> 'H6',
						),
						'default'	=> 'h4',
						'help' 		=> __('Set the HTML tag for title output', 'bb-powerpack'),
					),
					'title_font'	=> array(
						'type'		=> 'font',
						'label'		=> __('Font', 'bb-powerpack'),
						'default'	=> array(
							'family'	=> 'Default',
							'weight'	=> '400',
						),
						'preview'       => array(
							'type'		=> 'font',
							'selector'        => '.pp-member-wrapper .pp-member-name',
						),
					),
					'title_font_size_toggle' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Font Size', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('title_custom_font_size')
							)
						),
					),
					'title_custom_font_size'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Font Size', 'bb-powerpack'),
						'default'		=> array(
							'desktop'	=> 18,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-member-wrapper .pp-member-name',
									'property'        => 'font-size',
									'unit'            => 'px'
		                        ),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'title_line_height_toggle' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Line Height', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('title_custom_line_height')
							)
						),
					),
					'title_custom_line_height'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Line Height', 'bb-powerpack'),
						'help' 		=> __('Recommended values between 1-2', 'bb-powerpack'),
						'default'	=> array(
							'desktop'	=> 1.6,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-member-wrapper .pp-member-name',
									'property'        => 'line-height',
		                        ),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'title_font_color' 		=> array(
						'type'			=> 'color',
						'label'			=> __('Text Color', 'bb-powerpack'),
                        'default'       => '000000',
						'preview'       => array(
							'type'		=> 'css',
                            'selector'        => '.pp-member-wrapper .pp-member-name',
                            'property'        => 'color',
						),
					),
					'title_margin' 	=> array(
                    	'type' 				=> 'pp-multitext',
                    	'label' 			=> __('Margin', 'bb-powerpack'),
                        'description'   	=> __( 'px', 'Value unit for font size. Such as: "14 px"', 'bb-powerpack' ),
                        'default'       	=> array(
                            'top' 				=> 30,
                            'bottom' 			=> 5,
                        ),
                    	'options' 		=> array(
                    		'top' 			=> array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                    			'icon'			=> 'fa-long-arrow-up',
								'preview'       => array(
									'selector'		=> '.pp-member-wrapper .pp-member-name',
									'property'      => 'margin-top',
									'unit'          => 'px'
		                        ),
                    		),
                            'bottom' 		=> array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                    			'icon'			=> 'fa-long-arrow-down',
								'preview'       => array(
									'selector'      => '.pp-member-wrapper .pp-member-name',
									'property'      => 'margin-bottom',
									'unit'          => 'px'
		                        ),
                    		),
                    	)
                    ),
				)
			),
			'designation_typography' => array(
				'title'		=> __('Designation', 'bb-powerpack'),
				'fields' 	=> array(
					'designation_font'	=> array(
						'type'		=> 'font',
						'label'		=> __('Font', 'bb-powerpack'),
						'default'	=> array(
							'family'	=> 'Default',
							'weight'	=> '400',
						),
						'preview'       => array(
							'type'		=> 'font',
							'selector'        => '.pp-member-wrapper .pp-member-designation',
						),
					),
					'designation_font_size_toggle' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Font Size', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('designation_custom_font_size')
							)
						),
					),
					'designation_custom_font_size'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Font Size', 'bb-powerpack'),
						'default'	=> array(
							'desktop'	=> 15,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-member-wrapper .pp-member-designation',
									'property'        => 'font-size',
									'unit'			=> 'px'
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'designation_line_height_toggle' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Line Height', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('designation_custom_line_height')
							)
						),
					),
					'designation_custom_line_height'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Line Height', 'bb-powerpack'),
						'help' => __('Recommended values between 1-2', 'bb-powerpack'),
						'default'	=> array(
							'desktop'	=> 1.6,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-member-wrapper .pp-member-designation',
									'property'        => 'line-height',
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'designation_font_color' 		=> array(
						'type'			=> 'color',
						'label'			=> __('Text Color', 'bb-powerpack'),
                        'default'       => '666666',
						'preview'       => array(
							'type'		=> 'css',
							'selector'        => '.pp-member-wrapper .pp-member-designation',
							'property'        => 'color',
						),
					),
					'designation_margin' 	=> array(
                    	'type' 				=> 'pp-multitext',
                    	'label' 			=> __('Margin', 'bb-powerpack'),
                        'description'   	=> __( 'px', 'Value unit for font size. Such as: "14 px"', 'bb-powerpack' ),
                        'default'       	=> array(
                            'top' 				=> 0,
                            'bottom' 			=> 15,
                        ),
                    	'options' 		=> array(
                    		'top' 			=> array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                    			'icon'			=> 'fa-long-arrow-up',
								'preview'       => array(
									'selector'		=> '.pp-member-wrapper .pp-member-designation',
									'property'      => 'margin-top',
									'unit'          => 'px'
		                        ),
                    		),
                            'bottom' 		=> array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                    			'icon'			=> 'fa-long-arrow-down',
								'preview'       => array(
									'selector'      => '.pp-member-wrapper .pp-member-designation',
									'property'      => 'margin-bottom',
									'unit'          => 'px'
		                        ),
                    		),
                    	)
                    ),
				)
			),
            'description_typography' => array(
				'title'		=> __('Description', 'bb-powerpack'),
				'fields' 	=> array(
					'description_font'	=> array(
						'type'		=> 'font',
						'label'		=> __('Font', 'bb-powerpack'),
						'default'	=> array(
							'family'	=> 'Default',
							'weight'	=> '400',
						),
						'preview'       => array(
							'type'		=> 'font',
							'selector'        => '.pp-member-wrapper .pp-member-description',
						),
					),
					'description_font_size_toggle' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Font Size', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('description_custom_font_size')
							)
						),
					),
					'description_custom_font_size'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Font Size', 'bb-powerpack'),
						'default'	=> array(
							'desktop'	=> 14,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-member-wrapper .pp-member-description',
									'property'        => 'font-size',
									'unit'			=> 'px'
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'description_line_height_toggle' => array(
						'type'		=> 'pp-switch',
						'label'		=> __('Line Height', 'bb-powerpack'),
						'default'	=> 'default',
						'options'       => array(
							'default'          => __('Default', 'bb-powerpack'),
							'custom'         => __('Custom', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array('description_custom_line_height')
							)
						),
					),
					'description_custom_line_height'	=> array(
						'type' 		=> 'pp-multitext',
						'label'		=> __('Custom Line Height', 'bb-powerpack'),
						'help' => __('Recommended values between 1-2', 'bb-powerpack'),
						'default'	=> array(
							'desktop'	=> 1.8,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options' 		=> array(
							'desktop' => array(
								'icon'		=> 'fa-desktop',
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'tooltip'	=> __('Desktop', 'bb-powerpack'),
								'preview'       => array(
									'selector'        => '.pp-member-wrapper .pp-member-description',
									'property'        => 'line-height',
								),
							),
							'tablet' => array(
								'icon'		=> 'fa-tablet',
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'tooltip'	=> __('Tablet', 'bb-powerpack'),
							),
							'mobile' => array(
								'icon'		=> 'fa-mobile',
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'tooltip'	=> __('Mobile', 'bb-powerpack'),
							),

						),
					),
					'description_font_color' 		=> array(
						'type'			=> 'color',
						'label'			=> __('Text Color', 'bb-powerpack'),
                        'default'       => '444444',
						'preview'       => array(
							'type'		=> 'css',
							'selector'        => '.pp-member-wrapper .pp-member-description',
							'property'        => 'color',
						),
					),
					'description_margin' 	=> array(
                    	'type' 				=> 'pp-multitext',
                    	'label' 			=> __('Margin', 'bb-powerpack'),
                        'description'   	=> __( 'px', 'Value unit for font size. Such as: "14 px"', 'bb-powerpack' ),
                        'default'       	=> array(
                            'top' 				=> 5,
                            'bottom' 			=> 20,
                        ),
                    	'options' 		=> array(
                    		'top' 			=> array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Top', 'bb-powerpack'),
                                'tooltip'       => __('Top', 'bb-powerpack'),
                    			'icon'			=> 'fa-long-arrow-up',
								'preview'       => array(
									'selector'		=> '.pp-member-wrapper .pp-member-description',
									'property'      => 'margin-top',
									'unit'          => 'px'
		                        ),
                    		),
                            'bottom' 		=> array(
                                'maxlength' 	=> 3,
                                'placeholder'   =>  __('Bottom', 'bb-powerpack'),
                                'tooltip'       => __('Bottom', 'bb-powerpack'),
                    			'icon'			=> 'fa-long-arrow-down',
								'preview'       => array(
									'selector'      => '.pp-member-wrapper .pp-member-description',
									'property'      => 'margin-bottom',
									'unit'          => 'px'
		                        ),
                    		),
                    	)
                    ),
				)
			),
        ),
    ),
));
