<?php

function pp_column_register_settings( $extensions ) {

    if ( array_key_exists( 'gradient', $extensions['col'] ) || in_array( 'gradient', $extensions['col'] ) ) {
        add_filter( 'fl_builder_register_settings_form', 'pp_column_gradient', 10, 2 );
    }
    if ( array_key_exists( 'corners', $extensions['col'] ) || in_array( 'corners', $extensions['col'] ) ) {
        add_filter( 'fl_builder_register_settings_form', 'pp_column_round_corners', 10, 2 );
    }
    if ( array_key_exists( 'separators', $extensions['col'] ) || in_array( 'separators', $extensions['col'] ) ) {
        add_filter( 'fl_builder_register_settings_form', 'pp_column_separators', 10, 2 );
    }
    if ( array_key_exists( 'shadow', $extensions['col'] ) || in_array( 'shadow', $extensions['col'] ) ) {
        add_filter( 'fl_builder_register_settings_form', 'pp_column_shadow', 10, 2 );
    }
}

function pp_column_gradient( $form, $id ) {

    if ( 'col' != $id ) {
        return $form;
    }

    $border_section = $form['tabs']['style']['sections']['border'];
    unset( $form['tabs']['style']['sections']['border'] );

    $form['tabs']['style']['sections']['background']['fields']['bg_type']['options']['pp_gradient'] = esc_html__( 'Gradient', 'bb-powerpack' );
    $form['tabs']['style']['sections']['background']['fields']['bg_type']['toggle']['pp_gradient'] = array(
        'sections'  => array('pp_col_gradient')
    );

    $form['tabs']['style']['sections']['pp_col_gradient'] = array(
        'title'     => __('Gradient', 'bb-powerpack'),
        'fields'    => array(
            'gradient_type' => array(
                'type'      => 'pp-switch',
                'label'     => __('Gradient Type', 'bb-powerpack'),
                'default'   => 'linear',
                'options'   => array(
                    'linear'    => __('Linear', 'bb-powerpack'),
                    'radial'    => __('Radial', 'bb-powerpack'),
                ),
                'toggle'    => array(
                    'linear'    => array(
                        'fields'    => array('linear_direction')
                    ),
                ),
                'preview'   => array(
                    'type'      => 'none'
                )
            ),
            'gradient_color'    => array(
                'type'              => 'pp-color',
                'label'             => __('Colors', 'bb-powerpack'),
                'show_reset'        => true,
                'default'           => array(
                    'primary'           => 'd81660',
                    'secondary'         => '7d22bd',
                ),
                'options'           => array(
                    'primary'           => __('Primary', 'bb-powerpack'),
                    'secondary'         => __('Secondary', 'bb-powerpack'),
                ),
            ),
            'linear_direction'  => array(
                'type'              => 'select',
                'label'             => __('Gradient Direction', 'bb-powerpack'),
                'default'           => 'bottom',
                'options'           => array(
                    'bottom'                => __('Top to Bottom', 'bb-powerpack'),
                    'right'                 => __('Left to Right', 'bb-powerpack'),
                    'top_right_diagonal'    => __('Bottom Left to Top Right', 'bb-powerpack'),
                    'top_left_diagonal'     => __('Bottom Right to Top Left', 'bb-powerpack'),
                    'bottom_right_diagonal' => __('Top Left to Bottom Right', 'bb-powerpack'),
                    'bottom_left_diagonal'  => __('Top Right to Bottom Left', 'bb-powerpack'),
                ),
                'preview'           => array(
                    'type'              => 'none'
                )
            ),
        )
    );

    $form['tabs']['style']['sections']['border'] = $border_section;

    return $form;

}

function pp_column_round_corners( $form, $id ) {

    if ( 'col' != $id ) {
        return $form;
    }

    $form['tabs']['style']['sections']['border']['fields']['pp_round_corners'] = array(
        'type'              => 'pp-multitext',
        'label'             => __('Round Corners', 'bb-powerpack'),
        'description'       => 'px',
        'default'           => array(
            'top_left'          => 0,
            'top_right'         => 0,
            'bottom_left'       => 0,
            'bottom_right'      => 0
        ),
        'options'           => array(
            'top_left'          => array(
                'placeholder'       => __('Top Left', 'bb-powerpack'),
                'tooltip'           => __('Top Left', 'bb-powerpack')
            ),
            'top_right'         => array(
                'placeholder'       => __('Top Right', 'bb-powerpack'),
                'tooltip'           => __('Top Right', 'bb-powerpack')
            ),
            'bottom_left'       => array(
                'placeholder'       => __('Bottom Left', 'bb-powerpack'),
                'tooltip'           => __('Bottom Left', 'bb-powerpack')
            ),
            'bottom_right'      => array(
                'placeholder'       => __('Bottom Right', 'bb-powerpack'),
                'tooltip'           => __('Bottom Right', 'bb-powerpack')
            ),
        )
    );

    return $form;
}

/** Separator */
function pp_column_separators( $form, $id ) {

    if ( 'col' != $id ) {
        return $form;
    }

    $advanced = $form['tabs']['advanced'];
    unset($form['tabs']['advanced']);

    $form['tabs']['separator'] = array(
        'title'                     => __('Separator', 'bb-powerpack'),
        'sections'                  => array(
            'enable_separator'          => array(
                'title'                     => '',
                'fields'                    => array(
                    'enable_separator'          => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Enable Separator?', 'bb-powerpack'),
                        'default'                   => 'no',
                        'options'                   => array(
                            'yes'                       => __('Yes', 'bb-powerpack'),
                            'no'                        => __('No', 'bb-powerpack')
                        ),
                        'toggle'                    => array(
                            'yes'                       => array(
                                'sections'                  => array('separator_settings', 'separator_responsive')
                            )
                        ),
                        'preview'   => array(
                            'type'      => 'none'
                        )
                    )
                )
            ),
            'separator_settings'        => array(
                'title'                     => __('Settings', 'bb-powerpack'),
                'fields'                    => array(
                    'separator_type'            => array(
                        'type'                      => 'select',
                        'label'                     => __('Type', 'bb-powerpack'),
                        'options'                   => array(
                            'triangle'                  => __('Big Triangle', 'bb-powerpack'),
                            'triangle_small'            => __('Small Triangle - In', 'bb-powerpack'),
                            'triangle_small_out'        => __('Small Triangle - Out', 'bb-powerpack'),
                            'tilt'                      => __('Tilt', 'bb-powerpack'),
                            'wave'                      => __('Wave - In', 'bb-powerpack'),
                            'wave_out'                  => __('Wave - Out', 'bb-powerpack'),
                            'cloud'                     => __('Cloud', 'bb-powerpack'),
                            'slit'                      => __('Slit', 'bb-powerpack'),
                            'zigzag'                    => __('ZigZag', 'bb-powerpack'),
                        ),
                        'preview'                   => array(
                            'type'                      => 'none'
                        )
                    ),
                    'separator_color'           => array(
                        'type'                      => 'color',
                        'label'                     => __('Color', 'bb-powerpack'),
                        'default'                   => 'ffffff',
                        'preview'                   => array(
                            'type'                      => 'css',
                            'selector'                  => '.pp-col-separator svg',
                            'property'                  => 'fill'
                        )
                    ),
                    'separator_opacity'          => array(
                        'type'                      => 'text',
                        'label'                     => __('Opacity', 'bb-powerpack'),
                        'default'                   => 100,
                        'size'                      => 5,
                        'maxlength'                 => 3,
                        'description'               => '%',
                        'preview'                   => array(
                            'type'                      => 'none'
                        )
                    ),
                    'separator_height'          => array(
                        'type'                      => 'text',
                        'label'                     => __('Height', 'bb-powerpack'),
                        'default'                   => 100,
                        'size'                      => 5,
                        'maxlength'                 => 3,
                        'description'               => 'px',
                        'preview'                   => array(
                            'type'                      => 'css',
                            'selector'                  => '.pp-col-separator svg',
                            'property'                  => 'height',
                            'unit'                      => 'px'
                        )
                    ),
                    'separator_position'        => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Position', 'bb-powerpack'),
                        'default'                   => 'bottom',
                        'options'                   => array(
                            'top'                       => __('Top', 'bb-powerpack'),
                            'bottom'                    => __('Bottom', 'bb-powerpack'),
                            'left'                      => __('Left', 'bb-powerpack'),
                            'right'                     => __('Right', 'bb-powerpack'),
                        )
                    )
                )
            ),
            'separator_responsive'      => array(
                'title'                     => __('Responsive', 'bb-powerpack'),
                'fields'                    => array(
                    'separator_tablet'          => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Show on Tablet', 'bb-powerpack'),
                        'default'                   => 'no',
                        'options'                   => array(
                            'yes'                       => __('Yes', 'bb-powerpack'),
                            'no'                        => __('No', 'bb-powerpack')
                        ),
                        'toggle'                    => array(
                            'yes'                       => array(
                                'fields'                    => array('separator_height_tablet')
                            )
                        )
                    ),
                    'separator_height_tablet'   => array(
                        'type'                      => 'text',
                        'label'                     => __('Height', 'bb-powerpack'),
                        'default'                   => '',
                        'description'               => 'px',
                        'size'                      => 5,
                        'maxlength'                 => 3
                    ),
                    'separator_mobile'          => array(
                        'type'                      => 'pp-switch',
                        'label'                     => __('Show on Mobile', 'bb-powerpack'),
                        'default'                   => 'no',
                        'options'                   => array(
                            'yes'                       => __('Yes', 'bb-powerpack'),
                            'no'                        => __('No', 'bb-powerpack')
                        ),
                        'toggle'                    => array(
                            'yes'                       => array(
                                'fields'                    => array('separator_height_mobile')
                            )
                        )
                    ),
                    'separator_height_mobile'   => array(
                        'type'                      => 'text',
                        'label'                     => __('Height', 'bb-powerpack'),
                        'default'                   => '',
                        'description'               => 'px',
                        'size'                      => 5,
                        'maxlength'                 => 3
                    )
                )
            )
        )
    );

    $form['tabs']['advanced'] = $advanced;

    return $form;
}

function pp_column_shadow( $form, $id ) {

    if ( 'col' != $id ) {
        return $form;
    }

    $advanced = $form['tabs']['advanced'];
    unset($form['tabs']['advanced']);

    $form['tabs']['box_shadow'] = array(
        'title'     => __('Box Shadow', 'bb-powerpack'),
        'sections'  => array(
            'box_shadow'    => array(
                'title'         => __('Settings', 'bb-powerpack'),
                'fields'        => array(
                    'pp_box_shadow_color'   => array(
                        'type'                  => 'color',
                        'label'                 => __('Color', 'bb-powerpack'),
                        'default'               => '000000',
                        'preview'               => array(
                            'type'                  => 'none'
                        )
                    ),
                    'pp_box_shadow' => array(
                        'type'          => 'pp-multitext',
                        'label'         => __('Shadow', 'bb-powerpack'),
                        'default'       => array(
                            'vertical'      => 0,
                            'horizontal'    => 0,
                            'blur'          => 0,
                            'spread'        => 0
                        ),
                        'options'   => array(
                            'vertical'  => array(
                                'icon'          => 'fa-arrows-h',
                                'placeholder'   => __('Horizontal', 'bb-powerpack'),
                                'tooltip'       => __('Horizontal', 'bb-powerpack'),
                                'preview'       => array(
                                    'type'          => 'none'
                                )
                            ),
                            'horizontal' => array(
                                'icon'          => 'fa-arrows-v',
                                'placeholder'   => __('Vertical', 'bb-powerpack'),
                                'tooltip'       => __('Vertical', 'bb-powerpack'),
                                'preview'       => array(
                                    'type'          => 'none'
                                )
                            ),
                            'blur'      => array(
                                'icon'          => 'fa-circle-o',
                                'placeholder'   => __('Blur', 'bb-powerpack'),
                                'tooltip'       => __('Blur', 'bb-powerpack'),
                                'preview'       => array(
                                    'type'          => 'none'
                                )
                            ),
                            'spread'    => array(
                                'icon'          => 'fa-paint-brush',
                                'placeholder'   => __('Spread', 'bb-powerpack'),
                                'tooltip'       => __('Spread', 'bb-powerpack'),
                                'preview'       => array(
                                    'type'          => 'none'
                                )
                            )
                        ),
                        'preview'       => array(
                            'type'          => 'none'
                        )
                    ),
                    'pp_box_shadow_opacity' => array(
                        'type'                  => 'text',
                        'label'                 => __('Opacity', 'bb-powerpack'),
                        'default'               => 50,
                        'description'           => '%',
                        'size'                  => 5,
                        'maxlength'             => 3,
                        'preview'               => array(
                            'type'                  => 'none'
                        )
                    ),
                    'pp_box_shadow_hover_switch'    => array(
                        'type'                          => 'pp-switch',
                        'label'                         => __('Change on Hover?', 'bb-powerpack'),
                        'default'                       => 'no',
                        'options'                       => array(
                            'yes'                           => __('Yes', 'bb-powerpack'),
                            'no'                            => __('No', 'bb-powerpack'),
                        ),
                        'toggle'                        => array(
                            'yes'                           => array(
                                'sections'                       => array('box_shadow_hover')
                            )
                        ),
                        'preview'                       => array(
                            'type'                          => 'none'
                        )
                    )
                )
            ),
            'box_shadow_hover'  => array(
                'title'             => __('Hover Settings', 'bb-powerpack'),
                'fields'            => array(
                    'pp_box_shadow_color_hover' => array(
                        'type'                  => 'color',
                        'label'                 => __('Color', 'bb-powerpack'),
                        'default'               => '000000',
                        'preview'               => array(
                            'type'                  => 'none'
                        )
                    ),
                    'pp_box_shadow_hover'   => array(
                        'type'                  => 'pp-multitext',
                        'label'                 => __('Shadow', 'bb-powerpack'),
                        'default'               => array(
                            'vertical'              => 0,
                            'horizontal'            => 0,
                            'blur'                  => 0,
                            'spread'                => 0
                        ),
                        'options'   => array(
                            'vertical'  => array(
                                'icon'          => 'fa-arrows-h',
                                'placeholder'   => __('Horizontal', 'bb-powerpack'),
                                'tooltip'       => __('Horizontal', 'bb-powerpack'),
                                'preview'       => array(
                                    'type'          => 'none'
                                )
                            ),
                            'horizontal' => array(
                                'icon'          => 'fa-arrows-v',
                                'placeholder'   => __('Vertical', 'bb-powerpack'),
                                'tooltip'       => __('Vertical', 'bb-powerpack'),
                                'preview'       => array(
                                    'type'          => 'none'
                                )
                            ),
                            'blur'      => array(
                                'icon'          => 'fa-circle-o',
                                'placeholder'   => __('Blur', 'bb-powerpack'),
                                'tooltip'       => __('Blur', 'bb-powerpack'),
                                'preview'       => array(
                                    'type'          => 'none'
                                )
                            ),
                            'spread'    => array(
                                'icon'          => 'fa-paint-brush',
                                'placeholder'   => __('Spread', 'bb-powerpack'),
                                'tooltip'       => __('Spread', 'bb-powerpack'),
                                'preview'       => array(
                                    'type'          => 'none'
                                )
                            )
                        ),
                        'preview'       => array(
                            'type'          => 'none'
                        )
                    ),
                    'pp_box_shadow_opacity_hover'   => array(
                        'type'                          => 'text',
                        'label'                         => __('Opacity', 'bb-powerpack'),
                        'default'                       => 50,
                        'description'                   => '%',
                        'size'                          => 5,
                        'maxlength'                     => 3,
                        'preview'                       => array(
                            'type'                          => 'none'
                        )
                    ),
                    'pp_box_shadow_transition'      => array(
                        'type'                          => 'text',
                        'label'                         => __('Transition Speed', 'bb-powerpack'),
                        'default'                       => 500,
                        'description'                   => 'ms',
                        'size'                          => 5,
                        'maxlength'                     => 5,
                        'help'                          => __('Enter value in milliseconds.', 'bb-powerpack'),
                        'preview'                       => array(
                            'type'                          => 'none'
                        )
                    ),
                )
            )
        )
    );

    $form['tabs']['advanced'] = $advanced;

    return $form;
}
