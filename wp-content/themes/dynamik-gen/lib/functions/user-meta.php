<?php 
/**
 * Build and Add the User Meta option functions.
 *
 * @package Dynamik
 */
 
add_action( 'show_user_profile', 'dynamik_user_options_fields' );
add_action( 'edit_user_profile', 'dynamik_user_options_fields' );
/**
 * Build the Dynamik User Profile options.
 *
 * @since 1.0
 */
function dynamik_user_options_fields( $user )
{
	if( !current_user_can( 'edit_users', $user->ID ) )
		return false;

	?>
	<h3><?php _e( 'Dynamik Theme Settings', 'dynamik' ); ?></h3>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row" valign="top"><?php _e( 'Dynamik Admin Menus', 'dynamik' ); ?></th>
				<td>
					<input id="meta[disable_dynamik_gen_settings_menu]" name="meta[disable_dynamik_gen_settings_menu]" type="checkbox" value="1" <?php checked( get_the_author_meta( 'disable_dynamik_gen_settings_menu', $user->ID ) ); ?> />
					<label for="meta[disable_dynamik_gen_settings_menu]"><?php _e( 'Disable Dynamik Settings Submenu?', 'dynamik' ); ?></label><br />
					<input id="meta[disable_dynamik_gen_design_menu]" name="meta[disable_dynamik_gen_design_menu]" type="checkbox" value="1" <?php checked( get_the_author_meta( 'disable_dynamik_gen_design_menu', $user->ID ) ); ?> />
					<label for="meta[disable_dynamik_gen_design_menu]"><?php _e( 'Disable Dynamik Design Submenu?', 'dynamik' ); ?></label><br />
					<input id="meta[disable_dynamik_gen_custom_menu]" name="meta[disable_dynamik_gen_custom_menu]" type="checkbox" value="1" <?php checked( get_the_author_meta( 'disable_dynamik_gen_custom_menu', $user->ID ) ); ?> />
					<label for="meta[disable_dynamik_gen_custom_menu]"><?php _e( 'Disable Dynamik Custom Submenu?', 'dynamik' ); ?></label>
				</td>
			</tr>
			
			<tr>
				<th scope="row" valign="top"><?php _e( 'Dynamik License', 'dynamik' ); ?></th>
				<td>
					<input id="meta[hide_dynamik_gen_license_key]" name="meta[hide_dynamik_gen_license_key]" type="checkbox" value="1" <?php checked( get_the_author_meta( 'hide_dynamik_gen_license_key', $user->ID ) ); ?> />
					<label for="meta[hide_dynamik_gen_license_key]"><?php _e( 'Hide Dynamik License Key?', 'dynamik' ); ?></label>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}

add_action( 'personal_options_update', 'dynamik_user_meta_save' );
add_action( 'edit_user_profile_update', 'dynamik_user_meta_save' );
/**
 * Provide Dynamik User Profile options with save/update functionality.
 *
 * @since 1.0
 */
function dynamik_user_meta_save( $user_id )
{
	if( !current_user_can( 'edit_users', $user_id ) )
		return;

	$defaults = array(
		'disable_dynamik_gen_settings_menu' => '',
		'disable_dynamik_gen_design_menu' => '',
		'disable_dynamik_gen_custom_menu' => '',
		'hide_dynamik_gen_license_key' => ''
	);
		
	if( !isset( $_POST['meta'] ) || !is_array( $_POST['meta'] ) )
		$meta = $defaults;
	else
		$meta = wp_parse_args( $_POST['meta'], $defaults );
		
	foreach( $meta as $key => $value )
		update_user_meta( $user_id, $key, $value );
}

/* The following term_meta options are not in use at this time. */

//add_action( 'edit_term', 'dynamik_save_term_meta', 10, 2 );
/**
 * Provide Dynamik taxonomy options with save/update functionality.
 *
 * @since 1.0
 */
function dynamik_save_term_meta( $term_id, $tt_id )
{
	$term_meta = ( array ) get_option( 'dynamik_term_meta_options' );
	
	$term_meta[$term_id] = isset( $_POST['genesis-meta'] ) ? ( array ) $_POST['genesis-meta'] : array();
	
	update_option( 'dynamik_term_meta_options', $term_meta );
}

//add_action( 'delete_term', 'dynamik_delete_term_meta', 10, 2 );
/**
 * Provide Dynamik taxonomy options with delete functionality.
 *
 * @since 1.0
 */
function dynamik_delete_term_meta( $term_id, $tt_id )
{
	$term_meta = ( array ) get_option( 'dynamik_term_meta_options' );
	
	unset( $term_meta[$term_id] );
	
	update_option( 'dynamik_term_meta_options', ( array ) $term_meta );
}

//add_filter( 'get_term', 'dynamik_filter_get_term', 10, 2 );
/**
 * Filter Dynamik term-meta into the options table.
 *
 * @since 1.0
 * @return "filtered" term-meta value.
 */
function dynamik_filter_get_term( $term, $taxonomy )
{
	$db = get_option( 'dynamik_term_meta_options' );
	$term_meta = isset( $db[$term->term_id] ) ? $db[$term->term_id] : array();
	
	$term->meta = wp_parse_args( $term_meta, array(
			'layout' => ''
	) );
	
	foreach ( $term->meta as $field => $value )
	{
		$term->meta[$field] = stripslashes( wp_kses_decode_entities( $value ) );
	}
	
	return $term;
}
