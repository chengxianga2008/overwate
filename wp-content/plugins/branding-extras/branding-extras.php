<?php
/*
Plugin Name: Branding Extras
Plugin URI: http://rommelplofino.website/
Description: See more extra settings for Genesis theme
Version: 1.3
Author: Rommel Plofino
Author URI: http://rommelplofino.website/
*/

// Check WordPress version
global $wp_version;

if ( version_compare($wp_version, "4.0", "<") ) {
	exit( 'Branding Extras requires latest version of WordPress, your version is old!' );
}

if ( !class_exists( 'BrandingExtras' ) ):
	class BrandingExtras {
	
		public $config = array(
			'is_active'					=>	'0',
			'is_active_header'			=>	'0',
			'header_logo'				=> null,
			'is_active_information'		=>	'0',
			'address'					=> null,
			'contact_number' 			=> null,
			'email_address'				=> null,
			'is_active_scroll'			=>	'0',
			'scroll_img'				=>	null,
			'scroll_img_alt'			=>	'Scroll to Top',
			'scroll_img_width'			=>	'48',
			'scroll_img_height'			=>	'48',
			'scroll_offset_x'			=>	'5',
			'scroll_offset_y'			=>	'5',
			'is_active_admin_login'		=>	'0',
			'admin_logo_img'			=>	null,
			'admin_logo_bgcolor'		=>	'transparent',
			'admin_logo_width'			=>	'0',
			'admin_logo_height'			=>	'0',
			'admin_logo_padding'		=>	'0',
			'admin_logo_box_shadow'		=>	'none',
			'is_active_footer_widgets'	=>	'0',
			'footer_widgets_number'		=>	'1',
			'footer_widgets_class'		=>	'0',
		);

		// Change default
		function __construct() {

			// Scroll-to-Top default image
			$this->config['scroll_img'] = plugin_dir_url(__FILE__) . 'application/assets/images/up.png';

		}

		// Updater
		function be_activate_updater() {
			// Updater File
			require_once( 'be-updater.php' );

			// set auto-update params
			$plugin_current_version = '1.3';
			$plugin_remote_path     = 'http://plugins.rommelplofino.website/branding-extras/latest/update.php';
			$plugin_slug            = plugin_basename(__FILE__);
			$license_user           = 'free';
			$license_key            = 'freeaccount';

			new be_updater ( $plugin_current_version, $plugin_remote_path, $plugin_slug, $license_user, $license_key );
		}

		// Plugin options
		function get_branding_extras_options() {
			$options = unserialize(get_option("branding_extras_options"));
			return $options;
		}		
		
		// Install settings
		function branding_extras_activation() {
		
			// Check if Genesis theme is activated and installed
			if( basename(TEMPLATEPATH) != 'genesis' ) {
				deactivate_plugins(plugin_basename(__FILE__)); // Deactivate ourself
				wp_die('Sorry, you can\'t activate unless you have installed <a href="http://www.studiopress.com/themes/genesis">Genesis</a>');
			}
			else {
				$options = $this->get_branding_extras_options();

				$options = array(
					'is_active' 				=> $options["is_active"],
					'is_active_header' 			=> $options["is_active_header"],
					'header_logo' 				=> $options["header_logo"],
					'is_active_information'		=> $options["is_active_information"],
					'address' 					=> $options["address"],
					'contact_number' 			=> $options["contact_number"],
					'email_address' 			=> $options["email_address"],
					'is_active_scroll' 			=> $options["is_active_scroll"],
					'scroll_img' 				=> $options["scroll_img"],
					'scroll_img_alt' 			=> $options["scroll_img_alt"],
					'scroll_img_width' 			=> $options["scroll_img_width"],
					'scroll_img_height' 		=> $options["scroll_img_height"],
					'scroll_offset_x' 			=> $options["scroll_offset_x"],
					'scroll_offset_y' 			=> $options["scroll_offset_y"],
					'is_active_admin_login' 	=> $options["is_active_admin_login"],
					'admin_logo_img' 			=> $options["admin_logo_img"],
					'admin_logo_bgcolor' 		=> $options["admin_logo_bgcolor"],
					'admin_logo_width' 			=> $options["admin_logo_width"],
					'admin_logo_height' 		=> $options["admin_logo_height"],
					'admin_logo_padding' 		=> $options["admin_logo_padding"],
					'admin_logo_box_shadow' 	=> $options["admin_logo_box_shadow"],
					'is_active_footer_widgets' 	=> $options["is_active_footer_widgets"],
					'footer_widgets_number' 	=> $options["footer_widgets_number"],
					'footer_widgets_class' 		=> $options["footer_widgets_class"],
				);

				add_option("branding_extras_options", serialize($options));
			}
		}
		
		// Plugin settings page
		function handle_branding_extras_options() {
			$settings = $this->get_branding_extras_options();

			if ( isset( $_POST['submitted'] ) ) {
				// check security
				check_admin_referer('branding-extras-fields');

				$settings['is_active'] = isset($_POST['is_active'])? "1" : $this->config["is_active"];
				$settings['is_active_header'] = isset($_POST['is_active_header'])? "1" : $this->config["is_active_header"];
				$settings['header_logo'] = isset($_POST['header_logo'])? $_POST['header_logo'] : $this->config["header_logo"];
				$settings['is_active_information'] = isset($_POST['is_active_information'])? "1" : $this->config["is_active_information"];
				$settings['address'] = isset($_POST['address'])? $_POST['address'] : $this->config["address"];
				$settings['contact_number'] = isset($_POST['contact_number'])? $_POST['contact_number'] : $this->config["contact_number"];
				$settings['email_address'] = isset($_POST['email_address'])? $_POST['email_address'] : $this->config["email_address"];
				$settings['is_active_scroll'] = isset($_POST['is_active_scroll'])? "1" : $this->config["is_active_scroll"];
				$settings['scroll_img'] = isset($_POST['scroll_img'])? $_POST['scroll_img'] : $this->config["scroll_img"];
				$settings['scroll_img_alt'] = isset($_POST['scroll_img_alt'])? $_POST['scroll_img_alt'] : $this->config["scroll_img_alt"];
				$settings['scroll_img_width'] = isset($_POST['scroll_img_width'])? $_POST['scroll_img_width'] : $this->config["scroll_img_width"];
				$settings['scroll_img_height'] = isset($_POST['scroll_img_height'])? $_POST['scroll_img_height'] : $this->config["scroll_img_height"];
				$settings['scroll_offset_x'] = isset($_POST['scroll_offset_x'])? $_POST['scroll_offset_x'] : $this->config["scroll_offset_x"];
				$settings['scroll_offset_y'] = isset($_POST['scroll_offset_y'])? $_POST['scroll_offset_y'] : $this->config["scroll_offset_y"];
				$settings['is_active_admin_login'] = isset($_POST['is_active_admin_login'])? "1" : $this->config["is_active_admin_login"];
				$settings['admin_logo_img'] = isset($_POST['admin_logo_img'])? $_POST['admin_logo_img'] : $this->config["admin_logo_img"];
				$settings['admin_logo_bgcolor'] = isset($_POST['admin_logo_bgcolor'])? $_POST['admin_logo_bgcolor'] : $this->config["admin_logo_bgcolor"];
				$settings['admin_logo_width'] = isset($_POST['admin_logo_width'])? $_POST['admin_logo_width'] : $this->config["admin_logo_width"];
				$settings['admin_logo_height'] = isset($_POST['admin_logo_height'])? $_POST['admin_logo_height'] : $this->config["admin_logo_height"];
				$settings['admin_logo_padding'] = isset($_POST['admin_logo_padding'])? $_POST['admin_logo_padding'] : $this->config["admin_logo_padding"];
				$settings['admin_logo_box_shadow'] = isset($_POST['admin_logo_box_shadow'])? $_POST['admin_logo_box_shadow'] : $this->config["admin_logo_box_shadow"];
				$settings['is_active_footer_widgets'] = isset($_POST['is_active_footer_widgets'])? "1" : $this->config["is_active_footer_widgets"];
				$settings['footer_widgets_number'] = isset($_POST['footer_widgets_number'])? $_POST['footer_widgets_number'] : $this->config["footer_widgets_number"];
				$settings['footer_widgets_class'] = isset($_POST['footer_widgets_class'])? "1" : $this->config["footer_widgets_class"];

				update_option("branding_extras_options", serialize($settings));
				echo '<div class="updated fade"><p>Branding Extras Settings Updated!</p></div>';
			}
			$action_url = $_SERVER['REQUEST_URI'];
			include 'application/branding-extras-admin-options.php';
		}
		
		// Functions
		function branding_extras_function() {

			$options = $this->get_branding_extras_options();

			// Media File
			include 'application/functions/media-file.php';

			if ( $options["is_active"] == "1" ) {

				// Header
				if ( $options["is_active_header"] == "1" ) {
					// Header Logo
					if ( !empty( $options["header_logo"] ) ) {
						include 'application/functions/logo.php';
					}
				}

				// Information
				if ( $options["is_active_information"] == "1" ) {
					include 'application/functions/information.php';
				}

				// Scroll-to-Top
				if ( $options["is_active_scroll"] == "1" ) {
					include 'application/functions/scroll-to-top.php';
				}

				// Login Page
				if ( $options["is_active_admin_login"] == "1" ) {
					include 'application/functions/login-page.php';
				}

				// Footer Widgets
				if ( $options["is_active_footer_widgets"] == "1" ) {
					include 'application/functions/footer-widgets.php';
				}

			}
		}
		
		function branding_extras_settings_init() {
			add_menu_page( __('Branding Extras','BrandingExtras'), __('Branding Extras','BrandingExtras'), 'manage_options', 'branding-extras', array(&$this, 'handle_branding_extras_options') );
		}
		
		// Stylesheets
		function branding_extras_admin_scripts() {
			wp_register_style( 'branding-extras-admin-style', plugins_url('application/assets/admin-style.css', __FILE__ ) );
			wp_enqueue_style( 'branding-extras-admin-style' );

			wp_register_script( 'branding-extras-admin-script', plugins_url('application/assets/admin-script.js', __FILE__ ) );
			wp_enqueue_script( 'branding-extras-admin-script' );
		}
		
		function branding_extras_scripts() {
			wp_register_style( 'branding-extras-style', plugins_url('application/assets/style.css', __FILE__) );
			wp_enqueue_style( 'branding-extras-style' );
		}

	}
else:
	exit( 'Branding Extras already exists!' );
endif;

if ( class_exists('BrandingExtras') ) :
	$branding_extras = new BrandingExtras();
	
	register_activation_hook( __FILE__, array($branding_extras, 'branding_extras_activation' ) );
	add_action( 'admin_menu', array($branding_extras, 'branding_extras_settings_init' ) );
	add_action( 'admin_enqueue_scripts', array($branding_extras, 'branding_extras_admin_scripts' ) );
	add_action( 'wp_enqueue_scripts', array($branding_extras, 'branding_extras_scripts' ) );
	add_filter( 'after_setup_theme', array($branding_extras, 'branding_extras_function'), 10, 3 );
	add_action( 'init', array($branding_extras, 'be_activate_updater') );
endif;

?>
