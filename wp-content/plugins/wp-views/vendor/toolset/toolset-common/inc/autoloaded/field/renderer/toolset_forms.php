<?php

/**
 * Field renderer that uses toolset-forms to render a field.
 *
 * @since 1.9
 */
class Toolset_Field_Renderer_Toolset_Forms extends Toolset_Field_Renderer_Abstract {


	private $form_id;

	private $hide_field_title = false;

	private $purpose;


	public function __construct( $field, $form_id = '' ) {
		parent::__construct( $field );

		$this->form_id = $form_id;
	}


	/**
	 * Additional setup of the renderer.
	 *
	 * @param $args array Following arguments are supported:
	 *     @type string $form_id
	 *     @type bool $hide_field_title
	 */
	public function setup( $args = array() ) {

		$this->form_id = toolset_getarr( $args, 'form_id', $this->form_id );

		$this->hide_field_title = (bool) toolset_getarr( $args, 'hide_field_title', $this->hide_field_title );

		$this->purpose = toolset_getarr( $args, 'purpose', Toolset_Common_Bootstrap::MODE_FRONTEND );
	}

	/**
	 * @param bool $echo
	 *
	 * @return string
	 */
	public function render( $echo = false ) {

		$field_config = $this->get_toolset_forms_config();

		if( $this->hide_field_title ) {
			$field_config['title'] = '';
		}

		$value_in_intermediate_format = $this->field->get_value();
		$output = wptoolset_form_field( $this->get_form_id(), $field_config, $value_in_intermediate_format );

		if( $echo ) {
			echo $output;
		}

		return $output;
	}


	protected function get_form_id() { return $this->form_id; }


	protected function get_toolset_forms_config() {
		return wptoolset_form_filter_types_field( $this->field->get_definition()->get_definition_array(), $this->field->get_object_id() );
	}

}