<?php

/**
 * Enum class.
 *
 * Purposes of a field renderer.
 *
 * @since m2m
 */
final class Toolset_Field_Renderer_Purpose {

	// Field preview (e.g. on a term listing page)
	const PREVIEW = 'preview';

	// Raw output
	const RAW = 'raw';

	// Produces an input field
	const INPUT = 'input';

	// Value display
	const DISPLAY = 'display';

	/**
	 * Forces legacy implementation for input fields. Avoid whenever possible.
	 *
	 * @deprecated
	 */
	const TOOLSET_FORMS = 'toolset-forms';

}