<?php
/**
* Functions file for Gravity Form module
*/

function gf_module_form_titles() {

    $options = array( '' => __('None', 'bb-powerpack') );

    if ( class_exists( 'GFForms' ) ) {
        $forms = RGFormsModel::get_forms( null, 'title' );
        if ( count( $forms ) ) {
            foreach ( $forms as $form )
            $options[$form->id] = $form->title;
        }
    }

    return $options;
}
