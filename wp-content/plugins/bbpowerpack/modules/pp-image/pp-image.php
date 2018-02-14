<?php

/**
 * @class PPImageModule
 */
class PPImageModule extends FLBuilderModule {

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
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Image', 'bb-powerpack'),
			'description'   	=> __('Upload a photo or display one from the media library.', 'bb-powerpack'),
			'category'			=> BB_POWERPACK_CAT,
			'dir'           	=> BB_POWERPACK_DIR . 'modules/pp-image/',
            'url'           	=> BB_POWERPACK_URL . 'modules/pp-image/',
            'editor_export' 	=> true, // Defaults to true and can be omitted.
            'enabled'       	=> true, // Defaults to true and can be omitted.
			'partial_refresh'	=> true
		));
	}

	/**
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts()
	{
		if(isset($this->settings->link_type) && $this->settings->link_type == 'lightbox') {
			$this->add_js('jquery-magnificpopup');
			$this->add_css('jquery-magnificpopup');
		}
	}

	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Make sure we have a photo_src property.
		if(!isset($settings->photo_src)) {
			$settings->photo_src = '';
		}

		// Cache the attachment data.
		$data = FLBuilderPhoto::get_attachment_data($settings->photo);

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
		if(!empty($this->settings->crop)) {

			$editor = $this->_get_editor();

			if(!$editor || is_wp_error($editor)) {
				return false;
			}

			$cropped_path = $this->_get_cropped_path();
			$size         = $editor->get_size();
			$new_width    = $size['width'];
			$new_height   = $size['height'];

			// Get the crop ratios.
			if($this->settings->crop == 'landscape') {
				$ratio_1 = 1.43;
				$ratio_2 = .7;
			}
			elseif($this->settings->crop == 'panorama') {
				$ratio_1 = 2;
				$ratio_2 = .5;
			}
			elseif($this->settings->crop == 'portrait') {
				$ratio_1 = .7;
				$ratio_2 = 1.43;
			}
			elseif($this->settings->crop == 'square') {
				$ratio_1 = 1;
				$ratio_2 = 1;
			}
			elseif($this->settings->crop == 'circle') {
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

			// Photo source is set to "url".
			if($this->settings->photo_source == 'url') {
				$this->data = new stdClass();
				$this->data->alt = $this->settings->caption;
				$this->data->caption = $this->settings->caption;
				$this->data->link = $this->settings->photo_url;
				$this->data->url = $this->settings->photo_url;
				$this->settings->photo_src = $this->settings->photo_url;
			}

			// Photo source is set to "library".
			else if(is_object($this->settings->photo)) {
				$this->data = $this->settings->photo;
			}
			else {
				$this->data = FLBuilderPhoto::get_attachment_data($this->settings->photo);
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
		$classes = array( 'pp-photo-img' );

		if ( ! empty( $this->settings->photo ) ) {

			$data = self::get_data();

			if ( is_object( $data ) && $this->settings->photo_source == 'library' ) {

				$classes[] = 'wp-image-' . $data->id;

				if ( isset( $data->sizes ) ) {

					foreach ( $data->sizes as $key => $size ) {

						if ( $size->url == $this->settings->photo_src ) {
							$classes[] = 'size-' . $key;
							break;
						}
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
		if($this->_has_source() && !empty($this->settings->crop)) {

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

		if($this->settings->link_type == 'url') {
			$link = $this->settings->link_url;
		}
		else if($this->settings->link_type == 'lightbox') {
			$link = $photo->url;
		}
		else if($this->settings->link_type == 'file') {
			$link = $photo->url;
		}
		else if($this->settings->link_type == 'page') {
			$link = $photo->link;
		}
		else {
			$link = '';
		}

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
		if($this->settings->photo_source == 'url' && !empty($this->settings->photo_url)) {
			return true;
		}
		else if($this->settings->photo_source == 'library' && !empty($this->settings->photo_src)) {
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
		if($this->_has_source() && $this->_editor === null) {

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
		$crop        = empty($this->settings->crop) ? 'none' : $this->settings->crop;
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
		if($this->settings->photo_source == 'url') {
			$url = $this->settings->photo_url;
		}
		else if(!empty($this->settings->photo_src)) {
			$url = $this->settings->photo_src;
		}
		else {
			$url = FL_BUILDER_URL . 'img/pixel.png';
		}

		return $url;
	}

	/**
	 * @method _get_cropped_demo_url
	 * @protected
	 */
	protected function _get_cropped_demo_url()
	{
		$info = $this->_get_cropped_path();

		return FL_BUILDER_DEMO_CACHE_URL . $info['filename'];
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPImageModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'bb-powerpack'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'photo_source'  => array(
						'type'          => 'pp-switch',
						'label'         => __('Photo Source', 'bb-powerpack'),
						'default'       => 'library',
						'options'       => array(
							'library'       => __('Media Library', 'bb-powerpack'),
							'url'           => __('URL', 'bb-powerpack')
						),
						'toggle'        => array(
							'library'       => array(
								'fields'        => array('photo')
							),
							'url'           => array(
								'fields'        => array('photo_url', 'caption'),
								'sections'		=> array('caption_section')
							)
						)
					),
					'photo'         => array(
						'type'          => 'photo',
						'label'         => __('Photo', 'bb-powerpack'),
						'connections'   => array( 'photo' ),
					),
					'photo_url'     => array(
						'type'          => 'text',
						'label'         => __('Photo URL', 'bb-powerpack'),
						'placeholder'   => __( 'http://www.example.com/my-photo.jpg', 'bb-powerpack' ),
					),
					'crop'          => array(
						'type'          => 'select',
						'label'         => __('Crop', 'bb-powerpack'),
						'default'       => '',
						'options'       => array(
							''              => _x( 'None', 'Photo Crop.', 'bb-powerpack' ),
							'landscape'     => __('Landscape', 'bb-powerpack'),
							'panorama'      => __('Panorama', 'bb-powerpack'),
							'portrait'      => __('Portrait', 'bb-powerpack'),
							'square'        => __('Square', 'bb-powerpack'),
							'circle'        => __('Circle', 'bb-powerpack')
						)
					),
					'align'         => array(
						'type'          => 'pp-switch',
						'label'         => __('Alignment', 'bb-powerpack'),
						'default'       => 'center',
						'options'       => array(
							'left'          => __('Left', 'bb-powerpack'),
							'center'        => __('Center', 'bb-powerpack'),
							'right'         => __('Right', 'bb-powerpack')
						),
					)
				)
			),
			'caption'       => array(
				'title'         => __('Caption', 'bb-powerpack'),
				'fields'        => array(
					'show_caption'  => array(
						'type'          => 'pp-switch',
						'label'         => __('Show Caption', 'bb-powerpack'),
						'default'       => 'never',
						'options'       => array(
							'never'             => __('Never', 'bb-powerpack'),
							'hover'         => __('On Hover', 'bb-powerpack'),
							'below'         => __('Below Photo', 'bb-powerpack'),
							'overlay'         => __('Overlay', 'bb-powerpack')
						),
						'toggle'		=> array(
							'hover'		=> array(
								'fields'	=> array('caption')
							),
							'below'		=> array(
								'fields'	=> array('caption')
							),
							'overlay'		=> array(
								'fields'	=> array('caption')
							),
						),
					),
				)
			),
			'caption_section'	=> array(
				'title'			=> '',
				'fields'		=> array(
					'caption'       => array(
						'type'          => 'text',
						'label'         => __('Caption', 'bb-powerpack')
					)
				),
			),
			'link'          => array(
				'title'         => __('Link', 'bb-powerpack'),
				'fields'        => array(
					'link_type'     => array(
						'type'          => 'select',
						'label'         => __('Link Type', 'bb-powerpack'),
						'options'       => array(
							''              => _x( 'None', 'Link type.', 'bb-powerpack' ),
							'url'           => __('URL', 'bb-powerpack'),
							'lightbox'      => __('Lightbox', 'bb-powerpack'),
							'file'          => __('Photo File', 'bb-powerpack'),
							'page'          => __('Photo Page', 'bb-powerpack')
						),
						'toggle'        => array(
							''              => array(),
							'url'           => array(
								'fields'        => array('link_url', 'link_target')
							),
							'file'          => array(),
							'page'          => array()
						),
						'help'          => __('Link type applies to how the image should be linked on click. You can choose a specific URL, the individual photo or a separate page with the photo.', 'bb-powerpack'),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'link_url'     => array(
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
			)
		)
	),
	'style_tab'		=> array(
		'title'			=> __('Style', 'bb-powerpack'),
		'sections'		=> array(
			'image_box_style' 	=> array(
				'title'		=> __('Image Box', 'bb-powerpack'),
				'fields'	=> array(
					'box_padding' 	=> array(
						'type'              => 'pp-multitext',
                        'label'             => __('Padding', 'bb-powerpack'),
                        'description'       => 'px',
						'help'				=> __('Padding allows you to adjust the spacing between image and the outer edge of the container.', 'bb-powerpack'),
                        'default'           => array(
                            'top'               => '0',
                            'bottom'            => '0',
                            'left'              => '0',
                            'right'             => '0',
                        ),
                        'options'           => array(
                            'top'               => array(
                                'placeholder'       => __('Top', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-up',
                                'tooltip'           => __('Top', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'          => '.pp-photo-container .pp-photo-content',
                                    'property'          => 'padding-top',
                                    'unit'              => 'px'
                                )
                            ),
                            'bottom'            => array(
                                'placeholder'       => __('Bottom', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-down',
                                'tooltip'           => __('Bottom', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'          => '.pp-photo-container .pp-photo-content',
                                    'property'          => 'padding-bottom',
                                    'unit'              => 'px'
                                )
                            ),
                            'left'              => array(
                                'placeholder'       => __('Left', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-left',
                                'tooltip'           => __('Left', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'          => '.pp-photo-container .pp-photo-content',
                                    'property'          => 'padding-left',
                                    'unit'              => 'px'
                                )
                            ),
                            'right'             => array(
                                'placeholder'       => __('Right', 'bb-powerpack'),
                                'icon'              => 'fa-long-arrow-right',
                                'tooltip'           => __('Right', 'bb-powerpack'),
                                'preview'           => array(
                                    'selector'          => '.pp-photo-container .pp-photo-content',
                                    'property'          => 'padding-right',
                                    'unit'              => 'px'
                                )
                            ),
                        )
					),
					'box_background' 		=> array(
						'type'		=> 'color',
						'label'		=> __('Background Color', 'bb-powerpack'),
						'show_reset'	=> true,
						'help'		=> __('Background color will be visible between the image and outside edge of the container when you increase the padding.', 'bb-powerpack'),
						'preview'	=> array(
							'type'	=> 'css',
							'selector'	=> '.pp-photo-container .pp-photo-content',
							'property'	=> 'background'
						),
					),
					'box_border'	=> array(
						'type'		=> 'pp-switch',
						'label'		=> __('Border Style', 'bb-powerpack'),
						'default'	=> 'none',
						'options'	=> array(
							'none'		=> __('None', 'bb-powerpack'),
							'solid'		=> __('Solid', 'bb-powerpack'),
							'dashed'	=> __('Dashed', 'bb-powerpack'),
							'dotted'	=> __('Dotted', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'solid'	=> array(
								'fields'	=> array('border_width', 'border_color'),
							),
							'dotted'	=> array(
								'fields'	=> array('border_width', 'border_color'),
							),
							'dashed'	=> array(
								'fields'	=> array('border_width', 'border_color'),
							),
						),
					),
					'border_width'	=> array(
						'type'			=> 'text',
						'label'			=> __('Border Width', 'bb-powerpack'),
						'default'		=> 1,
						'maxlength'		=> 3,
						'size'			=> 5,
						'description'	=> 'px',
						'preview'		=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-photo-container .pp-photo-content',
							'property'	=> 'border-width',
							'unit'		=> 'px'
						),
					),
					'border_color'	=> array(
						'type'			=> 'color',
						'label'			=> __('Border Color', 'bb-powerpack'),
						'default'		=> 'cccccc',
						'show_reset'	=> true,
						'preview'		=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-photo-container .pp-photo-content',
							'property'	=> 'border-color',
						),
					),
					'border_radius'		=> array(
						'type'			=> 'text',
						'label'			=> __('Round Corners', 'bb-powerpack'),
						'default'		=> '0',
						'maxlength'		=> 3,
						'size'			=> 5,
						'class'			=> 'input-small',
						'description'	=> 'px',
						'preview'		=> array(
							'type'		=> 'css',
							'rules'		=> array(
								array(
									'selector'	=> '.pp-photo-container .pp-photo-content',
									'property'	=> 'border-radius',
									'unit'		=> 'px'
								),
								array(
									'selector'	=> '.pp-photo-container .pp-photo-content .pp-photo-content-inner',
									'property'	=> 'border-radius',
									'unit'		=> 'px'
								),
							),
						),
					),
				),
			),
			'image_border'		=> array(
				'title'			=> __('Image', 'bb-powerpack'),
				'fields'		=> array(
					'image_border_type'	=> array(
						'type'		=> 'pp-switch',
						'label'		=> __('Border Style', 'bb-powerpack'),
						'default'	=> 'outside',
						'options'	=> array(
							'inside'	=> __('Inside', 'bb-powerpack'),
							'outside'	=> __('Outside', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'inside'	=> array(
								'fields'	=> array('image_spacing')
							)
						)
					),
					'image_border_style'	=> array(
						'type'		=> 'pp-switch',
						'label'		=> __('Border Style', 'bb-powerpack'),
						'default'	=> 'none',
						'options'	=> array(
							'none'	=> __('None', 'bb-powerpack'),
							'solid'	=> __('Solid', 'bb-powerpack'),
							'dashed'	=> __('Dashed', 'bb-powerpack'),
							'dotted'	=> __('Dotted', 'bb-powerpack'),
						),
						'toggle'	=> array(
							'solid'	=> array(
								'fields'	=> array('image_border_width', 'image_border_color')
							),
							'dashed'	=> array(
								'fields'	=> array('image_border_width', 'image_border_color')
							),
							'dotted'	=> array(
								'fields'	=> array('image_border_width', 'image_border_color')
							),
						)
					),
					'image_border_width'	=> array(
						'type'		=> 'text',
						'label'		=> __('Border Width', 'bb-powerpack'),
						'size'		=> 5,
						'maxlength'	=> 3,
						'default'	=> 1,
						'description'	=> 'px',
						'preview'	=> array(
							'type'	=> 'css',
							'rules'	=> array(
								array(
									'selector'	=> '.pp-photo-container .pp-photo-content .pp-photo-content-inner:before',
									'property'	=> 'border-width',
									'unit'		=> 'px'
								),
								array(
									'selector'	=> '.pp-photo-container .pp-photo-content .pp-photo-content-inner a:before',
									'property'	=> 'border-width',
									'unit'		=> 'px'
								),
							)
						)
					),
					'image_border_color'	=> array(
						'type'		=> 'color',
						'label'		=> __('Border Color', 'bb-powerpack'),
						'show_reset'	=> true,
						'default'	=> '000000',
						'preview'	=> array(
							'type'	=> 'css',
							'rules'	=> array(
								array(
									'selector'	=> '.pp-photo-container .pp-photo-content .pp-photo-content-inner:before',
									'property'	=> 'border-color'
								),
								array(
									'selector'	=> '.pp-photo-container .pp-photo-content .pp-photo-content-inner a:before',
									'property'	=> 'border-color'
								),
							)
						)
					),
					'image_spacing'		=> array(
						'type'		=> 'text',
						'label'		=> __('Spacing', 'bb-powerpack'),
						'size'		=> 5,
						'maxlength'	=> 3,
						'default'	=> 10,
						'description'	=> 'px',
						'preview'	=> array(
							'type'	=> 'css',
							'selector'	=> '.pp-photo-content-inner:before',
							'property'	=> 'margin',
							'unit'		=> 'px'
						)
					)
				)
			),
			'image_box_shadow'	=> array(
				'title'		=> __('Box Shadow', 'bb-powerpack'),
				'fields'	=> array(
					'box_shadow'		=> array(
						'type'			=> 'pp-switch',
						'label'			=> __('Box Shadow', 'bb-powerpack'),
						'default'		=> 'disable',
						'options'		=> array(
							'enable'		=> __('Enable', 'bb-powerpack'),
							'disable'		=> __('Disable', 'bb-powerpack'),
						),
						'toggle'		=> array(
							'enable'		=> array(
								'fields'	=> array('box_shadow_settings','box_shadow_color', 'box_shadow_opacity'),
							),
						),
					),
					'box_shadow_settings'   => array(
						'type'          => 'pp-multitext',
						'label'         => __('Shadow Settings', 'bb-powerpack'),
						'default'       => array(
							'h' => 0,
							'v' => 0,
							'blur' => 0,
							'spread' => 10,
						),
						'options'       => array(
							'h'     => array(
								'placeholder'           => __('Horizontal', 'bb-powerpack'),
								'maxlength'             => 3,
								'icon'                  => 'fa-arrows-h',
								'tooltip'               => __('Horizontal', 'bb-powerpack')
							),
							'v'     => array(
								'placeholder'           => __('Vertical', 'bb-powerpack'),
								'maxlength'             => 3,
								'icon'                  => 'fa-arrows-v',
								'tooltip'               => __('Vertical', 'bb-powerpack')
							),
							'blur'     => array(
								'placeholder'           => __('Blur', 'bb-powerpack'),
								'maxlength'             => 3,
								'icon'                  => 'fa-circle-o',
								'tooltip'               => __('Blur', 'bb-powerpack')
							),
							'spread'     => array(
								'placeholder'           => __('Spread', 'bb-powerpack'),
								'maxlength'             => 3,
								'icon'                  => 'fa-paint-brush',
								'tooltip'               => __('Spread', 'bb-powerpack')
							),
						),
					),
					'box_shadow_color' => array(
						'type'              => 'color',
						'label'             => __('Color', 'bb-powerpack'),
						'default'           => '666666',
					),
					'box_shadow_opacity' => array(
						'type'              => 'text',
						'label'             => __('Opacity', 'bb-powerpack'),
						'class'             => 'input-small',
						'default'           => 0.5,
					),
				),
			),
		),
	),
	'caption'	=> array(
		'title'	=> __('Caption', 'bb-powerpack'),
		'sections'	=> array(
			'colors'		=> array(
				'title'		=> __('General', 'bb-powerpack'),
				'fields'	=> array(
					'caption_alignment'	=> array(
						'type'		=> 'pp-switch',
						'label'		=> __('Alignment', 'bb-powerpack'),
						'default'	=> 'center',
						'options'	=> array(
							'left'	=> __('Left', 'bb-powerpack'),
							'center'	=> __('Center', 'bb-powerpack'),
							'right'	=> __('Right', 'bb-powerpack'),
						)
					),
					'caption_color'		=> array(
						'type'		=> 'pp-color',
						'label'		=> __('Colors', 'bb-powerpack'),
						'show_reset'	=> true,
						'default'	=> array(
							'primary'	=> '000000',
							'secondary'	=> 'dddddd'
						),
						'options'	=> array(
							'primary'	=> __('Caption', 'bb-powerpack'),
							'secondary'	=> __('Background', 'bb-powerpack'),
						),
					),
					'caption_opacity'	=> array(
						'type'		=> 'text',
						'label'		=> __('Opacity', 'bb-powerpack'),
						'size'		=> 5,
						'maxlength'	=> 3,
						'default'	=> 0.5,
						'description'	=> __('between 0 & 1', 'bb-powerpack'),
					),
					'caption_padding'	=> array(
						'type'		=> 'pp-multitext',
						'label'		=> __('Padding', 'bb-powerpack'),
						'description'	=> 'px',
						'default'	=> array(
							'top'	=> 10,
							'bottom'	=> 10,
							'left'	=> 10,
							'right'	=> 10,
						),
						'options'	=> array(
							'top'	=> array(
								'placeholder'	=> __('Top', 'bb-powerpack'),
								'maxlength'		=> 3,
								'icon'			=> 'fa-long-arrow-up',
								'tooltip'		=> __('Top', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-photo-caption',
									'property'	=> 'padding-top',
									'unit'		=> 'px'
								),
							),
							'bottom'	=> array(
								'placeholder'	=> __('Bottom', 'bb-powerpack'),
								'maxlength'		=> 3,
								'icon'			=> 'fa-long-arrow-down',
								'tooltip'		=> __('Bottom', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-photo-caption',
									'property'	=> 'padding-bottom',
									'unit'		=> 'px'
								),
							),
							'left'	=> array(
								'placeholder'	=> __('Left', 'bb-powerpack'),
								'maxlength'		=> 3,
								'icon'			=> 'fa-long-arrow-left',
								'tooltip'		=> __('Left', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-photo-caption',
									'property'	=> 'padding-left',
									'unit'		=> 'px'
								),
							),
							'right'	=> array(
								'placeholder'	=> __('Right', 'bb-powerpack'),
								'maxlength'		=> 3,
								'icon'			=> 'fa-long-arrow-right',
								'tooltip'		=> __('Right', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-photo-caption',
									'property'	=> 'padding-right',
									'unit'		=> 'px'
								),
							),
						),
					),
				),
			),
			'typography'	=> array(
				'title'	=> __('Typography', 'bb-powerpack'),
				'fields'	=> array(
					'caption_font'	=> array(
						'type'		=> 'font',
						'default'		=> array(
    						'family'		=> 'Default',
    						'weight'		=> 300
    					),
    					'label'         => __('Font', 'bb-powerpack'),
    					'preview'         => array(
    						'type'            => 'font',
    						'selector'        => '.pp-photo-caption'
    					)
					),
					'caption_font_size'	=> array(
						'type'		=> 'pp-multitext',
						'label'		=> __('Font Size', 'bb-powerpack'),
						'default'		=> array(
							'desktop'	=> 18,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options'		=> array(
							'desktop'	=> array(
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'icon'			=> 'fa-desktop',
								'maxlength'		=> 3,
								'tooltip'		=> __('Desktop', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-photo-caption',
									'property'	=> 'font-size',
									'unit'		=> 'px'
								)
							),
							'tablet'	=> array(
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'icon'			=> 'fa-tablet',
								'maxlength'		=> 3,
								'tooltip'		=> __('Tablet', 'bb-powerpack')
							),
							'mobile'	=> array(
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'icon'			=> 'fa-mobile',
								'maxlength'		=> 3,
								'tooltip'		=> __('Mobile', 'bb-powerpack')
							),
						),
					),
					'caption_line_height'	=> array(
						'type'		=> 'pp-multitext',
						'label'		=> __('Line Height', 'bb-powerpack'),
						'default'		=> array(
							'desktop'	=> 1.6,
							'tablet'	=> '',
							'mobile'	=> '',
						),
						'options'		=> array(
							'desktop'	=> array(
								'placeholder'	=> __('Desktop', 'bb-powerpack'),
								'icon'			=> 'fa-desktop',
								'maxlength'		=> 3,
								'tooltip'		=> __('Desktop', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-photo-caption',
									'property'	=> 'line-height',
								)
							),
							'tablet'	=> array(
								'placeholder'	=> __('Tablet', 'bb-powerpack'),
								'icon'			=> 'fa-tablet',
								'maxlength'		=> 3,
								'tooltip'		=> __('Tablet', 'bb-powerpack')
							),
							'mobile'	=> array(
								'placeholder'	=> __('Mobile', 'bb-powerpack'),
								'icon'			=> 'fa-mobile',
								'maxlength'		=> 3,
								'tooltip'		=> __('Mobile', 'bb-powerpack')
							),
						),
					),
				),
			),
		),
	),
));
