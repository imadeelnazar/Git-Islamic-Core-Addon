<?php
namespace ElementorDefaultCPT;

use ElementorDefaultCPT\PageSettings\Page_Settings;
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		
		wp_enqueue_style( 'elementor-main-style', plugins_url( '/assets/style.css', __FILE__ ) );  // Main Slider Main
		wp_register_script( 'core-functions', plugins_url( '/assets/js/main-functions.js', __FILE__ ), [ 'jquery' ], false, true );
		
		wp_register_script( 'bx-main-slider', plugins_url( '/assets/bxslider/jquery.bxslider.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_style( 'bx-main-slider', plugins_url( '/assets/bxslider/bxslider.css', __FILE__ ) );  // BxSlider
		
		wp_register_script( 'flex-main-slider-js', plugins_url( '/assets/flexslider/jquery_flexslider.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_style( 'flex-main-slider-css', plugins_url( '/assets/flexslider/flexslider.css', __FILE__ ) );  // Flexslider
		
		wp_register_script( 'sliderresponsive-slider-js', plugins_url( '/assets/slider-responsive/sliderresponsive.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_style( 'sliderresponsive-slider-js', plugins_url( '/assets/slider-responsive/sliderresponsive.css', __FILE__ ) );  // sliderresponsive
		
		
		wp_register_script( 'progressbar-script-js', plugins_url( '/assets/progress-bar/jQuery-plugin-progressbar.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_style( 'progressbar-script-css', plugins_url( '/assets/progress-bar/jQuery-plugin-progressbar.css', __FILE__ ) );  // sliderresponsive
		
		wp_register_script( 'slick-slider-js', plugins_url( '/assets/slick/slick.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_style( 'slick-slider-css', plugins_url( '/assets/slick/slick.css', __FILE__ ) );  // Slick
		wp_enqueue_style( 'slick-slider-theme', plugins_url( '/assets/slick/slick-theme.css', __FILE__ ) );  // Slick Theme
		
		wp_register_script( 'owl-slider-js', plugins_url( '/assets/owl_carousel/owl_carousel.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_style( 'owl-slider-css', plugins_url( '/assets/owl_carousel/owl_carousel.css', __FILE__ ) );  // OWL
		
		wp_register_script( 'prettyphoto-main', plugins_url( '/assets/prettyphoto/prettyphoto-main.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'prettyphoto-theme', plugins_url( '/assets/prettyphoto/prettyphoto.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_style( 'prettyphoto-theme', plugins_url( '/assets/prettyphoto/prettyphoto.css', __FILE__ ) );  // PrettyPhoto Theme
		
		wp_enqueue_style('chosen', plugins_url( '/assets/chosen/chosen.min.css', __FILE__ ) );
		wp_enqueue_style('nice-select', plugins_url( '/assets/chosen/selectric.css', __FILE__ ) );
		wp_register_script('chosen', plugins_url( '/assets/chosen/chosen-jquery-min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script('nice-select', plugins_url( '/assets/chosen/jquery.nice-select.min.js', __FILE__ ), [ 'jquery' ], false, true );
		

		wp_register_script('jplayer-jukebox', plugins_url( '/assets/jplayer/js/jplayer-jukebox.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script('jplayer-playlist', plugins_url( '/assets/jplayer/js/jplayer-playlist-min.js', __FILE__ ), [ 'jquery' ], false, true );		
		wp_register_script('jplayer-core', plugins_url( '/assets/jplayer/js/jquery-jplayer-min.js', __FILE__ ), [ 'jquery' ], false, true );		
		
		wp_enqueue_style('jplayer-uno', plugins_url( '/assets/jplayer/css/jplayer-uno.css', __FILE__ ) );
		wp_enqueue_style('jplayer-core', plugins_url( '/assets/jplayer/css/jplayer-core.css', __FILE__ ) );
		
		
		
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_style( 'elementor-editor-style', plugins_url( '/assets/editor.css', __FILE__ ) );  // Editor Style
		
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'elementor-hello-world-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		
		 require_once( __DIR__ . '/widgets/main-slider.php' );
		
		 require_once( __DIR__ . '/widgets/call-to-action-text.php' );
		 require_once( __DIR__ . '/widgets/call-to-action-image.php' );
		 require_once( __DIR__ . '/widgets/project-facts.php' );
		 require_once( __DIR__ . '/widgets/noble-cause.php' );
		
		 require_once( __DIR__ . '/widgets/fancy-heading.php' );
		
		 
		 require_once( __DIR__ . '/widgets/timeline.php' );
		
		 require_once( __DIR__ . '/widgets/CPT/wp-elementor-events.php' );
		 require_once( __DIR__ . '/widgets/CPT/wp-elementor-events-cta.php' );
	
		 require_once( __DIR__ . '/widgets/CPT/wp-elementor-woo.php' );
		 require_once( __DIR__ . '/widgets/CPT/wp-elementor-posts.php' );
		
		 require_once( __DIR__ . '/widgets/gallery.php' );
		 require_once( __DIR__ . '/widgets/sub-header.php' );


		 require_once( __DIR__ . '/widgets/call-to-action-small-box.php' );
		 require_once( __DIR__ . '/widgets/call-to-action-banner.php' );
		 require_once( __DIR__ . '/widgets/call-to-action-contact.php' );
		
		 require_once( __DIR__ . '/widgets/newsletter.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Main_Slider() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Call_To_Action_Text() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Noble_Cause() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Call_To_Action_Image() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Project_Facts() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pillers_Forest() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Fancy_Heading() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Blog_Listing() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Main_Gallery() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Default_Sub_Header() );


		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Call_To_Action_Banner() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Woo_Listing() );		 
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Events_Listing() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Events_Call_To_Action() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Call_To_Action_Contact() );
		 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Islamic_Centre_Newsletter() );
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );

		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Plugin::instance();
