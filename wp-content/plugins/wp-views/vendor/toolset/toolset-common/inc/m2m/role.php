<?php

/**
 * Enum class. Defines names of roles that elements can take in a relationship.
 *
 * The values also match the 'role' column of the association translations table, so they must not be changed.
 *
 * @since m2m
 */
abstract class Toolset_Relationship_Role {

	const PARENT = 'parent';
	const CHILD = 'child';
	const INTERMEDIARY = 'intermediary';


	public static function parent_child() {
		return array( self::PARENT, self::CHILD );
	}


	public static function all() {
		return array( self::PARENT, self::CHILD, self::INTERMEDIARY );
	}


	public static function is_valid( $role_name ) {
		return in_array( $role_name, self::all() );
	}

	/**
	 * Throw an exception if a given role name isn't valid.
	 *
	 * @param $role_name
	 * @param null|string[] $valid_roles Array of roles to accept, defaults to all() roles.
	 * @since m2m
	 */
	public static function validate( $role_name, $valid_roles = null ) {

		if( null === $valid_roles ) {
			$valid_roles = Toolset_Relationship_Role::all();
		}

		if( !in_array( $role_name, $valid_roles ) ) {
			throw new InvalidArgumentException( 'Invalid element role name.' );
		}

	}

}