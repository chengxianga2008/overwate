<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package Dynamik
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'http://cobaltapps.com',
		'item_name'      => 'Dynamik Website Builder',
		'theme_slug'     => 'dynamik_gen',
		'version'        => CHILD_THEME_VERSION,
		'author'         => 'The Cobalt Apps Team',
		'download_id'    => '19',
		'renew_url'      => 'https://cobaltapps.com/my-account/'
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Dynamik License', 'dynamik' ),
		'enter-key'                 => __( 'Enter your Dynamik license key.', 'dynamik' ),
		'license-key'               => __( 'License Key', 'dynamik' ),
		'license-action'            => __( 'License Action', 'dynamik' ),
		'deactivate-license'        => __( 'Deactivate License', 'dynamik' ),
		'activate-license'          => __( 'Activate License', 'dynamik' ),
		'status-unknown'            => __( 'License status is unknown.', 'dynamik' ),
		'renew'                     => __( 'Renew?', 'dynamik' ),
		'unlimited'                 => __( 'unlimited', 'dynamik' ),
		'license-key-is-active'     => __( 'License key is active.', 'dynamik' ),
		'expires%s'                 => __( 'Expires %s.', 'dynamik' ),
		'expires-never'             => __( 'Lifetime License.', 'dynamik' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'dynamik' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'dynamik' ),
		'license-key-expired'       => __( 'License key has expired.', 'dynamik' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'dynamik' ),
		'license-is-inactive'       => __( 'License is inactive.', 'dynamik' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'dynamik' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'dynamik' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'dynamik' ),
		'update-notice'             => __( "Updating Dynamik will replace the core theme files (/wp-content/themes/dynamik-gen/) with the latest version of Dynamik, so any changes to that directory will be erased. 'Cancel' to stop, 'OK' to update.", 'dynamik' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'dynamik' ),
	)

);
