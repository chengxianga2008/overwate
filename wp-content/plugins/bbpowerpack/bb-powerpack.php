<?php
/**
 * Plugin Name: PowerPack for Beaver Builder
 * Plugin URI: https://wpbeaveraddons.com
 * Description: A set of custom, creative, unique modules for Beaver Builder to speed up your web design and development process.
 * Version: 1.2.8
 * Author: Team IdeaBox - Beaver Addons
 * Author URI: https://wpbeaveraddons.com
 * Copyright: (c) 2016 IdeaBox Creations
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: bb-powerpack
 * Domain Path: /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class BB_PowerPack {

	/**
     * Holds the class object.
     *
     * @since 1.1.4
     * @var object
     */
    public static $instance;

	/**
     * Holds the upload dir path.
     *
     * @since 1.1.8
     * @var array
     */
	public static $upload_dir;

	public static $errors;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.1.4
	 */
	public function __construct()
	{
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		if ( ! class_exists( 'FLBuilder' ) ) {
			if ( ! is_plugin_active( 'beaver-builder-lite-version' . '/fl-builder.php' ) ) {
				add_action( 'admin_notices', array( $this, 'admin_notices' ) );
				add_action( 'network_admin_notices', array( $this, 'admin_notices' ) );
				return;
			}
		}

		$lite_dirname   = 'powerpack-addon-for-beaver-builder';
		$lite_active    = is_plugin_active( $lite_dirname . '/bb-powerpack-lite.php' );
		$plugin_dirname = basename( dirname( dirname( __FILE__ ) ) );

		if ( class_exists( 'BB_PowerPack_Lite' ) || ( $plugin_dirname != $lite_dirname && $lite_active ) ) {
			add_action( 'admin_init', array( $this, 'deactivate_lite' ) );
			return;
		}

		self::$errors = array();

		$this->define_constants();

		/* Hooks */
		$this->init_hooks();

		/* Classes */
		require_once 'classes/class-admin-settings.php';
		require_once 'classes/class-media-fields.php';

		/* Includes */
		require_once 'includes/helper-functions.php';
		require_once 'includes/updater/update-config.php';

		self::$upload_dir = pp_get_upload_dir();
	}

	/**
	 * Auto deactivate PowerPack Lite.
	 *
	 * @since 1.1.7
	 */
	public function deactivate_lite() {
		deactivate_plugins( 'bb-powerpack-lite/bb-powerpack-lite.php' );
	}

	/**
	 * Define PowerPack constants.
	 *
	 * @since 1.1.5
	 * @return void
	 */
	private function define_constants()
	{
		define( 'BB_POWERPACK_VER', '1.2.8' );
		define( 'BB_POWERPACK_DIR', plugin_dir_path( __FILE__ ) );
		define( 'BB_POWERPACK_URL', plugins_url( '/', __FILE__ ) );
		define( 'BB_POWERPACK_PATH', plugin_basename( __FILE__ ) );
		define( 'BB_POWERPACK_CAT', $this->register_wl_cat() );
	}

	/**
	 * Initializes actions and filters.
	 *
	 * @since 1.1.5
	 * @return void
	 */
	public function init_hooks()
	{
		add_action( 'init', array( $this, 'load_modules' ) );
		add_action( 'plugins_loaded', array( $this, 'loader' ) );
		add_action( 'after_setup_theme', array( $this, 'customizer_presets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ), 9999 );
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
		add_action( 'network_admin_notices', array( $this, 'admin_notices' ) );
		add_filter( 'body_class', array( $this, 'body_class' ) );
	}

	/**
	 * Load language files.
	 *
	 * @since 1.1.4
	 * @return void
	 */

	public function load_textdomain()
	{
    	load_plugin_textdomain( 'bb-powerpack', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Include modules.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function load_modules()
	{
		if ( class_exists( 'FLBuilder' ) ) {
			require_once 'includes/modules.php';
		}
	}

	/**
	 * Include row and column setting extendor.
	 *
	 * @since 1.1.0
	 * @return void
	 */
	public function loader()
	{
		if ( !is_admin() && class_exists( 'FLBuilder' ) ) {

			// Fields
			require_once 'classes/class-module-fields.php';

			// Panel functions
			require_once 'includes/panel-functions.php';

			$extensions = BB_PowerPack_Admin_Settings::get_enabled_extensions();

			/* Extend row settings */
			if ( isset( $extensions['row'] ) && count( $extensions['row'] ) > 0 ) {
		        require_once 'includes/row.php';
		    }

			/* Extend column settings */
			if ( isset( $extensions['col'] ) && count( $extensions['col'] ) > 0 ) {
		        require_once 'includes/column.php';
		    }

			$row_templates 	= BB_PowerPack_Admin_Settings::get_enabled_templates( 'row' );
			$scheme			= BB_PowerPack_Admin_Settings::get_template_scheme();

			if ( is_array( $row_templates ) && method_exists( 'FLBuilder', 'register_templates' ) ) {
				foreach ( $row_templates as $template ) {
					if ( file_exists( self::$upload_dir['path'] . $template . '.dat' ) ) {
						// Template filename should be the same as the category name.
						FLBuilder::register_templates( self::$upload_dir['path'] . $template . '.dat' );
					}
				}
			}

			$page_templates = BB_PowerPack_Admin_Settings::get_enabled_templates( 'page' );

			if ( is_array( $page_templates ) && method_exists( 'FLBuilder', 'register_templates' ) ) {
				foreach ( $page_templates as $template ) {

					if ( file_exists( self::$upload_dir['path'] . $template . '.dat' ) ) {
						// Template filename should be the same as the category name.
						FLBuilder::register_templates( self::$upload_dir['path'] . $template . '.dat' );
					}

				}
			}
		}

		$this->load_textdomain();
	}

	/**
	 * Include customizer presets for page templates.
	 *
	 * @since 1.1.5
	 * @return void
	 */
	public function customizer_presets()
	{
		if ( class_exists( 'FLCustomizer' ) ) {
			require_once 'includes/customizer-presets.php';
		}
	}

	/**
	 * Custom scripts.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function load_scripts()
	{
		wp_enqueue_style( 'animate', BB_POWERPACK_URL . 'assets/css/animate.min.css', array(), rand() );
		if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
			wp_enqueue_style( 'pp-fields-style', BB_POWERPACK_URL . 'assets/css/fields.css', array(), rand() );
			wp_enqueue_script( 'pp-fields-script', BB_POWERPACK_URL . 'assets/js/fields.js', array( 'jquery' ), rand(), true );
			wp_enqueue_style( 'pp-panel-style', BB_POWERPACK_URL . 'assets/css/panel.css', array(), rand() );
	        wp_enqueue_script( 'pp-panel-script', BB_POWERPACK_URL . 'assets/js/panel.js', array( 'jquery' ), rand(), true );
		}
	}

	/**
	 * Admin notices.
	 *
	 * @since 1.1.1
	 * @return void
	 */
	public function admin_notices()
	{
		if ( ! is_admin() ) {
			return;
		}
		else if ( ! is_user_logged_in() ) {
			return;
		}
		else if ( ! current_user_can( 'update_core' ) ) {
			return;
		}

		if ( !class_exists( 'FLBuilder' ) ) {
			?>
				<div class="notice notice-error">
					<p>
						<?php
							$bb_lite = '<a href="https://wordpress.org/plugins/beaver-builder-lite-version/" target="_blank">Beaver Builder Lite</a>';
							$bb_pro = '<a href="https://www.wpbeaverbuilder.com/pricing/" target="_blank">Beaver Builder Pro / Agency</a>';
							echo sprintf( esc_html__( 'Please install and activate %s or %s to use PowerPack add-on.', 'bb-powerpack' ), $bb_lite, $bb_pro ); ?>
					</p>
				</div>
			<?php
		}
		else if ( count( self::$errors ) ) {
			foreach ( self::$errors as $key => $msg ) {
				?>
				<div class="notice notice-error">
					<p><?php echo $msg; ?></p>
				</div>
				<?php
			}
		}
	}

	/**
	 * Add CSS class to body.
	 *
	 * @since 1.1.1
	 * @return array $classes Array of body CSS classes.
	 */
	public function body_class( $classes )
	{
		if ( class_exists( 'FLBuilder' ) && class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
			$classes[] = 'bb-powerpack';
			if ( pp_panel_search() == 1 ) {
				$classes[] = 'bb-powerpack-search-enabled';
			}
		}

		return $classes;
	}

	/**
	 * Register white label category
	 *
	 * @since 1.0.1
	 * @return string $ppwl
	 */
	public function register_wl_cat()
	{
		$ppwl = ( is_multisite() ) ? get_site_option( 'ppwl_builder_label' ) : get_option( 'ppwl_builder_label' );

		if ( '' == $ppwl || false == $ppwl ) {
			$ppwl = esc_html__( 'PowerPack Modules', 'bb-powerpack' );
		}

		return $ppwl;
	}

	/**
	 * Returns the singleton instance of the class.
	 *
	 * @since 1.0.0
	 * @return object The BB_PowerPack object.
	 */
	public static function get_instance()
	{
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof BB_PowerPack ) ) {
			self::$instance = new BB_PowerPack();
		}

		return self::$instance;
	}

}

// Load the PowerPack class.
$bb_powerpack = BB_PowerPack::get_instance();

/**
 * Enable white labeling setting form after re-activating the plugin
 *
 * @since 1.0.1
 * @return void
 */
function bb_powerpack_plugin_activation()
{
	delete_option( 'ppwl_hide_form' );
	delete_option( 'ppwl_hide_plugin' );
	if ( get_option( 'bb_powerpack_templates_reset' ) != 1 ) {
		delete_option( 'bb_powerpack_override_ms' );
		update_option( 'bb_powerpack_templates', array('disabled') );
		update_option( 'bb_powerpack_page_templates', array('disabled') );
		update_option( 'bb_powerpack_templates_reset', 1 );
	}
	if ( is_network_admin() ) {
		delete_site_option( 'ppwl_hide_form' );
		delete_site_option( 'ppwl_hide_plugin' );
		if ( get_site_option( 'bb_powerpack_templates_reset' ) != 1 ) {
			delete_site_option( 'bb_powerpack_override_ms' );
			update_site_option( 'bb_powerpack_templates', array('disabled') );
			update_site_option( 'bb_powerpack_page_templates', array('disabled') );
			update_site_option( 'bb_powerpack_templates_reset', 1 );
		}
	}
}
register_activation_hook( __FILE__, 'bb_powerpack_plugin_activation' );
