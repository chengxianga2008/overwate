<?php

abstract class Toolset_User_Editors_Editor_Screen_Abstract
	implements Toolset_User_Editors_Editor_Screen_Interface {

	/**
	 * @var Toolset_User_Editors_Medium_Interface
	 */
	protected $medium;

	/**
	 * @var Toolset_User_Editors_Editor_Interface
	 */
	protected $editor;


	public function add_medium( Toolset_User_Editors_Medium_Interface $medium ) {
		$this->medium = $medium;
	}

	public function add_editor( Toolset_User_Editors_Editor_Interface $editor ) {
		$this->editor = $editor;
	}

	public function is_active() {
		return false;
	}
}