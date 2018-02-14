<?php
/**
 * This module was originally developed by Jonathan Perez
 * and licensed under GPL 2.
 * Author: Jonathan Perez
 * Author URI: http://surefirewebservices.com
 */

/**
 * @class PPRestaurantMenuModule
 */
class PPRestaurantMenuModule extends FLBuilderModule {

    /**
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'              => __('Restaurant / Services Menu', 'bb-powerpack'),
            'description'       => __('Restaurant and Services Menu', 'bb-powerpack'),
            'category'          => BB_POWERPACK_CAT,
            'dir'               => BB_POWERPACK_DIR . 'modules/pp-restaurant-menu/',
            'url'               => BB_POWERPACK_URL . 'modules/pp-restaurant-menu/',
            'editor_export'     => true,
            'enabled'           => true,
            'partial_refresh'   => false
        ));
    }
}

FLBuilder::register_module('PPRestaurantMenuModule', array(
   'restaurant_menu_general'      => array( // Tab
        'title'         => __('General', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'heading'       => array(
                'title'         => __('Heading', 'bb-powerpack'), // Section Title
                'fields'        => array( // Section Fields
                    'menu_heading'     => array(
                        'type'          => 'text',
                        'label'         => __('Heading', 'bb-powerpack'),
                        'default'       => __( 'MENU TITLE', 'bb-powerpack' ),
                        'connections'   => array( 'string', 'html', 'url' ),
                    ),
                    'menu_heading_align'     => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Alignment', 'bb-powerpack'),
                        'default'       => 'center',
                        'options'       => array(
                            'left'        => __( 'Left', 'bb-powerpack' ),
                            'center'      => __( 'Center', 'bb-powerpack' ),
                            'right'       => __( 'Right', 'bb-powerpack' )
                        )
                    )
                )
            ),
            'item_layouts'  => array(
                'title'         => __( 'Content Layout', 'bb-powerpack' ),
                'fields'        => array(
                    'restaurant_menu_layout'    => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Show Photo and Content', 'bb-powerpack'),
                        'options'                   => array(
                            'stacked'                   => __( 'Stacked', 'bb-powerpack' ),
                            'inline'                    => __( 'Inline', 'bb-powerpack' )
                        ),
                        'default'                   => 'stacked',
                        'toggle'                    => array(
                            'stacked'                   => array(
                                'fields'                    => array('text_alignment')
                            ),
                            'inline'                    => array(
                                'fields'                    => array('inline_image_width'),
                            )
                        )
                    ),
                    'inline_image_width'         => array(
                        'type'          => 'text',
                        'label'         => __('Image Width', 'bb-powerpack'),
                        'size'          => '4',
                        'maxlength'     => '3',
                        'default'       => '40',
                        'description'   => '%',
                        'placeholder'   => 40
                    ),
                    'text_alignment'    => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Text Alignment', 'bb-powerpack'),
                        'options'           => array(
                            'left'              => __( 'Left', 'bb-powerpack' ),
                            'center'            => __( 'Center', 'bb-powerpack' )
                        ),
                        'default'           => 'left',
                    ),
                    'show_description'    => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Show Item Description', 'bb-powerpack'),
                        'options'           => array(
                            'yes'               => __( 'Yes', 'bb-powerpack' ),
                            'no'                => __( 'No', 'bb-powerpack' )
                        ),
                        'default'           => 'yes',
                    ),
                    'show_price'    => array(
                        'type'              => 'pp-switch',
                        'label'             => __('Show Item Price', 'bb-powerpack'),
                        'options'           => array(
                            'yes'               => __( 'Yes', 'bb-powerpack' ),
                            'no'                => __( 'No', 'bb-powerpack' )
                        ),
                        'default'           => 'yes',
                        'toggle'        => array(
                            'yes'           => array(
                                'fields'        => array('currency_symbol')
                            )
                        )
                    ),
                    'currency_symbol'   => array(
                        'type'              => 'text',
                        'label'             => __('Currency Symbol', 'bb-powerpack'),
                        'default'           => '$',
                        'size'              => 5,
                    )
                )
            ),
            'general'       => array( // Section
                'title'         => __( 'Responsive Columns', 'bb-powerpack' ),
                'fields'        => array( // Section Fields
                    'large_device_columns'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Large Device', 'bb-powerpack' ),
                        'default'       => '2',
                        'size'          => '2',
                        'options'       => array(
                            '1'             => 1,
                            '2'             => 2,
                            '3'             => 3
                        )
                    ),
                    'medium_device_columns'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Medium Device', 'bb-powerpack' ),
                        'default'       => '2',
                        'size'          => '2',
                        'options'       => array(
                            '1'             => 1,
                            '2'             => 2,
                            '3'             => 3
                        )
                    ),
                    'small_device_columns'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Small Device', 'bb-powerpack' ),
                        'default'       => '1',
                        'size'          => '2',
                        'options'       => array(
                            '1'             => 1,
                            '2'             => 2,
                            '3'             => 3
                        )
                    )
                )
            )
        )
    ),
    'restaurant_menu_item'        => array(
        'title'         =>  __('Menu Items', 'bb-powerpack'),
        'sections'      => array(
            'menu_item'  => array(
                'title'         => '',
                'fields'        => array(
                    'menu_items'     => array(
                        'type'          => 'form',
                        'label'         => __('Items', 'bb-powerpack'),
                        'form'          => 'restaurant_menu_form', // ID from registered form below
                        'multiple'      => true,
                        'preview_text'  => 'menu_items_title'
                    )
                )
            )
        )
    ),
    'heading_style'        => array(
        'title'         =>  __('Heading Style', 'bb-powerpack'),
        'sections'      => array(
            'card_style'  => array(
                'title'         => __('Background', 'bb-powerpack'),
                'fields'        => array(
                    'heading_bg_type'     => array(
                        'type'          => 'pp-switch',
                        'label'         => __( 'Heading Background', 'bb-powerpack' ),
                        'default'       => 'none',
                        'options'       => array(
                            'none'          => __( 'None', 'bb-powerpack' ),
                            'color'         => __( 'Color', 'bb-powerpack' ),
                        ),
                         'toggle'        => array(
                            'color'           => array(
                                'fields'        => array('heading_bg')
                            )
                        )
                    ),
                    'heading_bg'  => array(
                        'type'          => 'color',
                        'label'         => __('Background Color', 'bb-powerpack'),
                        'default'       => 'ffffff',
                        'show_reset'    => false
                    ),
                )
            ),
            'heading_border'   => array(
                'title'         => __('Border', 'bb-powerpack'),
                'fields'        => array(
                    'heading_border'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Border Type', 'bb-powerpack' ),
                        'default'       => 'none',
                        'options'       => array(
                            'none'          => __( 'None', 'bb-powerpack' ),
                            'dashed'        => __( 'Dashed', 'bb-powerpack' ),
                            'dotted'        => __( 'Dotted', 'bb-powerpack' ),
                            'double'        => __( 'Double', 'bb-powerpack' ),
                            'solid'         => __( 'Solid', 'bb-powerpack' ),
                        ),
                        'toggle'        => array(
                            'solid'           => array(
                                'fields'        => array('heading_border_color', 'heading_border_width'),
                            ),
                            'dashed'           => array(
                                'fields'        => array('heading_border_color', 'heading_border_width'),
                            ),
                            'dotted'           => array(
                                'fields'        => array('heading_border_color', 'heading_border_width'),
                            ),
                            'double'           => array(
                                'fields'        => array('heading_border_color', 'heading_border_width'),
                            )
                        )
                    ),
                    'heading_border_color'  => array(
                        'type'          => 'color',
                        'label'         => __('Border Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true
                    ),
                    'heading_border_width'  => array(
						'type'          => 'pp-multitext',
						'label'         => __('Border Width', 'bb-powerpack'),
						'description'   => 'px',
						'default'       => array(
							'top'		    => 0,
							'bottom'	    => 1,
							'left'		    => 0,
							'right'		    => 0,
						),
						'options'		=> array(
							'top'		    => array(
								'placeholder'	=> __('Top', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-up',
								'tooltip'		=> __('Top', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-restaurant-menu-heading',
									'property'	=> 'border-top-width',
									'unit'		=> 'px'
								),
							),
							'bottom'		=> array(
								'placeholder'	=> __('Bottom', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-down',
								'tooltip'		=> __('Bottom', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-restaurant-menu-heading',
									'property'	=> 'border-bottom-width',
									'unit'		=> 'px'
								),
							),
							'left'		=> array(
								'placeholder'	=> __('Left', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-left',
								'tooltip'		=> __('Left', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-restaurant-menu-heading',
									'property'	=> 'border-left-width',
									'unit'		=> 'px'
								),
							),
							'right'		=> array(
								'placeholder'	=> __('Right', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-right',
								'tooltip'		=> __('Right', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-restaurant-menu-heading',
									'property'	=> 'border-right-width',
									'unit'		=> 'px'
								),
							),
						)
                    ),
                )
            ),
            'heading_structure' => array(
                'title'             => __('Structure', 'bb-powerpack'),
                'fields'            => array(
                    'heading_margin'   => array(
                        'type'              => 'pp-multitext',
                        'label'             => __('Margin', 'bb-powerpack'),
						'description'       => 'px',
						'default'           => array(
							'top'		        => 30,
							'bottom'	        => 30,
						),
                        'options'		=> array(
							'top'		    => array(
								'placeholder'	=> __('Top', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-up',
								'tooltip'		=> __('Top', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-restaurant-menu-heading',
									'property'	=> 'margin-top',
									'unit'		=> 'px'
								),
							),
							'bottom'		=> array(
								'placeholder'	=> __('Bottom', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-down',
								'tooltip'		=> __('Bottom', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-restaurant-menu-heading',
									'property'	=> 'margin-bottom',
									'unit'		=> 'px'
								),
							),
                        )
                    ),
                    'heading_padding'   => array(
                        'type'              => 'pp-multitext',
                        'label'             => __('Padding', 'bb-powerpack'),
						'description'       => 'px',
						'default'           => array(
							'top'		        => 0,
							'bottom'	        => 0,
						),
                        'options'		=> array(
							'top'		    => array(
								'placeholder'	=> __('Top', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-up',
								'tooltip'		=> __('Top', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-restaurant-menu-heading',
									'property'	=> 'padding-top',
									'unit'		=> 'px'
								),
							),
							'bottom'		=> array(
								'placeholder'	=> __('Bottom', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-down',
								'tooltip'		=> __('Bottom', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-restaurant-menu-heading',
									'property'	=> 'padding-bottom',
									'unit'		=> 'px'
								),
							),
                        )
                    ),
                )
            )
        )
    ),
    'restaurant_menu_style'        => array(
        'title'         =>  __('Items Style', 'bb-powerpack'),
        'sections'      => array(
            'card_style'  => array(
                'title'         => __('Background', 'bb-powerpack'),
                'fields'        => array(
                    'card_bg_type'     => array(
                        'type'          => 'pp-switch',
                        'label'         => __( 'Item Background', 'bb-powerpack' ),
                        'default'       => 'none',
                        'options'       => array(
                            'none'          => __( 'None', 'bb-powerpack' ),
                            'color'         => __( 'Color', 'bb-powerpack' ),
                        ),
                         'toggle'        => array(
                            'color'           => array(
                                'fields'        => array('card_bg')
                            )
                        )
                    ),
                    'card_bg'  => array(
                        'type'          => 'color',
                        'label'         => __('Background Color', 'bb-powerpack'),
                        'show_reset'    => false,
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-menu-item',
                            'property'      => 'background-color',
                        )
                    ),
                )
            ),
            'card_border'   => array(
                'title'         => __('Border', 'bb-powerpack'),
                'fields'        => array(
                    'card_border'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Item Border Type', 'bb-powerpack' ),
                        'default'       => 'dashed',
                        'options'       => array(
                            'none'          => __( 'None', 'bb-powerpack' ),
                            'dashed'        => __( 'Dashed', 'bb-powerpack' ),
                            'dotted'        => __( 'Dotted', 'bb-powerpack' ),
                            'double'        => __( 'Double', 'bb-powerpack' ),
                            'solid'         => __( 'Solid', 'bb-powerpack' ),
                        ),
                        'toggle'        => array(
                            'solid'           => array(
                                'fields'        => array('card_border_color', 'card_border_width'),
                            ),
                            'dashed'           => array(
                                'fields'        => array('card_border_color', 'card_border_width'),
                            ),
                            'dotted'           => array(
                                'fields'        => array('card_border_color', 'card_border_width'),
                            ),
                            'double'           => array(
                                'fields'        => array('card_border_color', 'card_border_width'),
                            )
                        )
                    ),
                    'card_border_color'  => array(
                        'type'          => 'color',
                        'label'         => __('Border Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true
                    ),
                    'card_border_width'  => array(
						'type'          => 'pp-multitext',
						'label'         => __('Border Width', 'bb-powerpack'),
						'description'   => 'px',
						'default'       => array(
							'top'		    => 0,
							'bottom'	    => 1,
							'left'		    => 0,
							'right'		    => 0,
						),
						'options'		=> array(
							'top'		    => array(
								'placeholder'	=> __('Top', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-up',
								'tooltip'		=> __('Top', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-menu-item',
									'property'	=> 'border-top-width',
									'unit'		=> 'px'
								),
							),
							'bottom'		=> array(
								'placeholder'	=> __('Bottom', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-down',
								'tooltip'		=> __('Bottom', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-menu-item',
									'property'	=> 'border-bottom-width',
									'unit'		=> 'px'
								),
							),
							'left'		=> array(
								'placeholder'	=> __('Left', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-left',
								'tooltip'		=> __('Left', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-menu-item',
									'property'	=> 'border-left-width',
									'unit'		=> 'px'
								),
							),
							'right'		=> array(
								'placeholder'	=> __('Right', 'bb-powerpack'),
								'icon'			=> 'fa-long-arrow-right',
								'tooltip'		=> __('Right', 'bb-powerpack'),
								'preview'		=> array(
									'selector'	=> '.pp-menu-item',
									'property'	=> 'border-right-width',
									'unit'		=> 'px'
								),
							),
						)
                    ),
                )
            ),
        )
    ),
    'typography'    => array(
        'title'         => __( 'Typography', 'bb-powerpack' ),
        'sections'      => array(
            'menu_heading'  => array(
                'title'         => __( 'Heading', 'bb-powerpack' ),
                'fields'        => array(
                    'menu_heading_font' => array(
                        'type'          => 'font',
                        'label'         => __( 'Font', 'bb-powerpack' ),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 400
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.pp-restaurant-menu-heading'
                        )
                    ),
                    'menu_heading_size'     => array(
                        'type'          => 'text',
                        'label'         => __('Font Size', 'bb-powerpack'),
                        'default'       => '26',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px'
                    ),
                    'menu_heading_color'     => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true
                    ),
                )
            ),
            'menu_item_style'  => array(
                'title'         => __('Items Title', 'bb-powerpack'),
                'fields'        => array(
                    'items_title_font' => array(
                        'type'          => 'font',
                        'label'         => __( 'Font', 'bb-powerpack' ),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 300
                        ),
                        'preview'   => array(
                            'type'      => 'font',
                            'selector'  => '.pp-restaurant-menu-item-title'
                        )
                    ),
                     'items_title_font_style'     => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Font Style', 'bb-powerpack'),
                        'default'       => 'normal',
                        'options'       => array(
                            'normal'      => __( 'Normal', 'bb-powerpack' ),
                            'italic'        => __( 'Italic', 'bb-powerpack' ),
                            'oblique'        => __( 'oblique', 'bb-powerpack' )
                        ),
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-restaurant-menu-item-title',
                            'property'      => 'font-style',
                        )
                    ),
                    'item_title_size'     => array(
                        'type'          => 'text',
                        'label'         => __('Font Size', 'bb-powerpack'),
                        'default'       => '20',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-restaurant-menu-item-title',
                            'property'          => 'font-size',
                            'unit'              => 'px'
                        )
                    ),
                    'menu_title_color'     => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'property'      => 'color',
                            'selector'      => '.pp-restaurant-menu-item-title',
                        )
                    ),
                )
            ),
            'menu_description_item_style'  => array(
                'title'         => __('Items Description', 'bb-powerpack'),
                'fields'        => array(
                    'items_description_font' => array(
                        'type'          => 'font',
                        'label'         => __( 'Font', 'bb-powerpack' ),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 300
                        ),
                        'preview'       => array(
                            'type'          => 'font',
                            'selector'      => '.pp-restaurant-menu-item-description'
                        )
                    ),
                    'items_description_font_style'     => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Font Style', 'bb-powerpack'),
                        'default'       => 'italic',
                        'options'       => array(
                            'normal'      => __( 'Normal', 'bb-powerpack' ),
                            'italic'        => __( 'Italic', 'bb-powerpack' ),
                            'oblique'        => __( 'oblique', 'bb-powerpack' )
                        ),
                        'preview'       => array(
                            'type'          => 'css',
                            'selector'      => '.pp-restaurant-menu-item-description',
                            'property'      => 'font-style',
                        )
                    ),
                    'item_description_size'     => array(
                        'type'          => 'text',
                        'label'         => __('Font Size', 'bb-powerpack'),
                        'default'       => '14',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px',
                        'preview'           => array(
                            'type'              => 'css',
                            'selector'          => '.pp-restaurant-menu-item-description',
                            'property'          => 'font-size',
                            'unit'              => 'px'
                        )
                    ),
                    'menu_description_color'     => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '333333',
                        'show_reset'    => true,
                        'preview'       => array(
                            'type'          => 'css',
                            'property'      => 'color',
                            'selector'      => '.pp-restaurant-menu-item-description'
                        )
                    ),
                )
            ),
            'menu_item_price_style'  => array(
                'title'         => __('Items Price', 'bb-powerpack'),
                'fields'        => array(
                    'items_price_font' => array(
                        'type'          => 'font',
                        'label'         => __( 'Font', 'bb-powerpack' ),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 300
                        ),
                        'preview'       => array(
                            'type'          => 'font',
                            'selector'      => '.pp-restaurant-menu-item-price'
                        )
                    ),
                    'items_price_font_style'     => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Font Style', 'bb-powerpack'),
                        'default'       => 'normal',
                        'options'       => array(
                            'normal'        => __( 'Normal', 'bb-powerpack' ),
                            'italic'        => __( 'Italic', 'bb-powerpack' ),
                            'oblique'       => __( 'oblique', 'bb-powerpack' )
                        ),
                        'preview'       => array(
                            'type'          => 'css',
                            'property'      => 'font-style',
                            'selector'      => '.pp-restaurant-menu-item-price'
                        )
                    ),
                    'item_color_size'   => array(
                        'type'              => 'text',
                        'label'             => __('Font Size', 'bb-powerpack'),
                        'default'           => '16',
                        'maxlength'         => '3',
                        'size'              => '4',
                        'description'       => 'px',
                        'preview'           => array(
                            'type'              => 'css',
                            'property'          => 'font-size',
                            'selector'          => '.pp-restaurant-menu-item-price',
                            'unit'              => 'px'
                        )
                    ),
                    'menu_price_color'  => array(
                        'type'              => 'color',
                        'label'             => __('Color', 'bb-powerpack'),
                        'default'           => 'aaaaaa',
                        'show_reset'        => true,
                        'preview'           => array(
                            'type'              => 'css',
                            'property'          => 'color',
                            'selector'          => '.pp-restaurant-menu-item-price'
                        )
                    ),
                )
            )
        )
    )
) );
FLBuilder::register_settings_form('restaurant_menu_form', array(
    'title' => __('Add Items', 'bb-powerpack'),
    'tabs'  => array(
        'general'      => array( // Tab
            'title'         => __('General', 'bb-powerpack'), // Tab title
            'sections'      => array( // Tab Sections
                'general'       => array( // Section
                    'title'         => '', // Section Title
                    'fields'        => array( // Section Fields
                        'restaurant_select_images'     => array(
                        'type'          => 'select',
                        'label'         => __('Item Photo', 'bb-powerpack'),
                        'default'       => 'none',
                        'options'       => array(
                            'yes'           => __( 'Yes', 'bb-powerpack' ),
                            'none'          => __( 'No', 'bb-powerpack' ),
                            ),
                            'toggle'        => array(
                                'yes'           => array(
                                    'fields'        => array('menu_item_images')
                                )
                            )
                        ),
                        'menu_item_images'          => array(
                           'type'          => 'photo',
                           'label'         => __('Select Photo', 'bb-powerpack'),
                           'connections'   => array( 'photo' ),
                        ),
                        'menu_items_title'     => array(
                            'type'          => 'text',
                            'label'         => __('Title', 'bb-powerpack'),
                            'default'       => __('Menu Item', 'bb-powerpack'),
                            'connections'   => array( 'string', 'html', 'url' ),
                        ),
                        'menu_items_link'     => array(
                            'type'          => 'link',
                            'label'         => __('Link To', 'bb-powerpack'),
                            'default'       => '',
                            'connections'   => array( 'url' ),
                        ),
                        'menu_items_link_target'     => array(
                            'type'          => 'select',
                            'label'         => __('Link Target', 'bb-powerpack'),
                            'default'       => '_blank',
                            'options'       => array(
                                '_blank'      => __( 'New Window', 'bb-powerpack' ),
                                '_self'        => __( 'Same Window', 'bb-powerpack' )
                            )
                        ),
                        'menu_item_description'          => array(
                           'type'          => 'text',
                           'label'         => __('Item Description', 'bb-powerpack'),
                           'default'       => __('Lorem Ipsum is simply dummy text', 'bb-powerpack'),
                           'connections'   => array( 'string', 'html', 'url' ),
                       ),
                       'menu_items_price'     => array(
                           'type'          => 'text',
                           'label'         => __('Price', 'bb-powerpack'),
                           'size'          =>'8',
                           'default'       => '9.99',
                       ),
                       'menu_items_unit'    => array(
                           'type'               => 'text',
                           'label'              => __('Unit', 'bb-powerpack'),
                           'help'               => __('For example, per person, pint, or lb etc.', 'bb-powerpack')
                       ),
                    )
                )
            )
        )
    )
));
