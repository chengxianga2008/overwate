<?php

/**
 * Interface for post elements.
 *
 * @since m2m
 */
interface IToolset_Post extends IToolset_Element {

	/**
	 * @return string Post type slug.
	 * @since m2m
	 */
	public function get_type();

	/**
	 * @return string Post title
	 * @since m2m
	 */
	public function get_title();

	/**
	 * @return string Post slug
	 * @since m2M
	 */
	public function get_slug();
}