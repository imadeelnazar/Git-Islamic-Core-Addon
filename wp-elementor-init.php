<?php
/*
Plugin Name: KodeForest Elementor
Plugin URI:
Description: KodeForest Elementor Core Plugin
Version: 1.0
Author: Adeel Nazar
Author URI: http://www.kodeforest.com
License:
Text-Domain: wp-init
*/

// Defining Default Parametters for Path
define( 'KODEFOREST_MAIN_URL', plugins_url( '/', __FILE__ ) );
define( 'KODEFOREST_MAIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'KODEFOREST_MAIN_ROOT', __FILE__ );


require_once('wpjb-utility.php');

// Trigger the Call Backs
require_once KODEFOREST_MAIN_PATH.'includes/helper.php';
require_once KODEFOREST_MAIN_PATH.'includes/event-item.php';
require_once KODEFOREST_MAIN_PATH.'includes/post-item.php';
require_once KODEFOREST_MAIN_PATH.'includes/woo-item.php';


include_once(KODEFOREST_MAIN_PATH . '/framework/kf_pagebuilder_backend.php');
include_once(KODEFOREST_MAIN_PATH . '/framework/kf_pagebuilder_meta.php');
include_once(KODEFOREST_MAIN_PATH . '/framework/kf_pagebuilder_scripts.php');

require 'update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/imadeelnazar/Git-Islamic-Center/',
	__FILE__, //Full path to the main plugin file or functions.php.
	'Git-Islamic-Center-5.1'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('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');

/**
 * Main Elementor Main Element Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class Kodeforest_Main_Init {

	/**
	 * Plugin Version
	 *
	 * @since 1.2.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.2.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'kode-elementor' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'wp-elementor-scripts.php' );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'kode-elementor' ),
			'<strong>' . esc_html__( 'Elementor Widgets', 'kode-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'kode-elementor' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'kode-elementor' ),
			'<strong>' . esc_html__( 'Elementor Main Element', 'kode-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'kode-elementor' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'kode-elementor' ),
			'<strong>' . esc_html__( 'Elementor Main Element', 'kode-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'kode-elementor' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate Kodeforest_Main_Init.
new Kodeforest_Main_Init();
//Custom Widgets
include_once(KODEFOREST_MAIN_PATH . '/default_widgets/contact-widget.php');
include_once(KODEFOREST_MAIN_PATH . '/default_widgets/ad-banner-widget.php');

if(class_exists('EM_Events')){
	include_once(KODEFOREST_MAIN_PATH . '/default_widgets/kode-latest-events-widget.php');
	include_once(KODEFOREST_MAIN_PATH . '/default_widgets/kode-upcoming-events-widget.php');
}
include_once(KODEFOREST_MAIN_PATH . '/default_widgets/islamic-products-widget.php');



add_action('wp', 'forest_define_global_variable_islamicon');
function forest_define_global_variable_islamicon(){
	global $islamicon;

	// SVG icons list
	$pattern = '/\.(islamicon-(?:\w+(?:-)?)+):before/';
	$fontawesome_path = KODEFOREST_MAIN_PATH . 'assets/svg_icons/svg-icon.css';
	if( file_exists( $fontawesome_path ) ) {
		@$subject = file_get_contents($fontawesome_path);
	}
	preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
	$islamicon = array();
	foreach($matches as $match){
		$islamicon[$match[1]] = $match[1];
	}
	return $islamicon;
}

add_action('wp', 'forest_define_global_variable_islamic');
function forest_define_global_variable_islamic(){
	global $islamic;

	// SVG icons list
	$pattern = '/\.(islamic-(?:\w+(?:-)?)+):before/';
	$fontawesome_path = KODEFOREST_MAIN_PATH . 'assets/svg_icons/svg-icon.css';
	if( file_exists( $fontawesome_path ) ) {
		@$subject = file_get_contents($fontawesome_path);
	}
	preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
	$islamic = array();
	foreach($matches as $match){
		$islamic[$match[1]] = $match[1];
	}
	return $islamic;
}
