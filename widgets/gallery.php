<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Main Gallery
 *
 * Elementor widget for main gallery.
 *
 * @since 1.0.0
 */
class Main_Gallery extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'main-gallery';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Main Gallery', 'elementor-main-gallery' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slider-album';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'kodeforest' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		
		return [ 'owl-slider-js', 'owl-slider-css','core-functions' , 'core-style' ];	
		
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'main_gallery_settings',
			[
				'label' => __( 'Gallery Settings', 'elementor-main-gallery' ),
			]
		);
		
		$this->add_control(
		  'style',
		  	[
		   	'label'       	=> esc_html__( 'Slider Type', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'bxslider',
		     	'label_block' 	=> false,
		     	'options' 		=> [				
					'instagram'=> esc_html__('Instagram', 'baldiyaat'),
					'gallery-slider'=> esc_html__('Gallery Slider Carousel', 'baldiyaat'),
					'simple-gallery'=> esc_html__('Simple Gallery', 'baldiyaat'),
					'video-slider'=> esc_html__('Video Gallery', 'baldiyaat')
		     	],
		  	]
		);
		
		$this->add_control(
		  'gallery-columns',
		  	[
		   	'label'       	=> esc_html__( 'Column', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> '2',
		     	'options' 		=> [				
					'1' => esc_html__('1 Column', 'baldiyaat'),
					'2' => esc_html__('2 Column', 'baldiyaat'),
					'3' => esc_html__('3 Column', 'baldiyaat'),
					'4' => esc_html__('4 Column', 'baldiyaat'),
					'6' => esc_html__('6 Column', 'baldiyaat')
		     	],
		  	]
		);
		
		$this->add_control(
			'thumbnail-size',
			[
				'label' => esc_html__( 'Thumbnail Size', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'label_block' 	=> false,
				'default' => esc_html__( 'hide', 'essential-addons-elementor' ),
		     	'options' => wpha_get_thumbnail_list(),
			]
		);
		
		$this->add_control(
			'num-fetch',
			[
				'label' => esc_html__( 'Num Fetch', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => 10,
			]
		);
		
		$this->add_control(
			'pagination',
			[
				'label' => esc_html__( 'Pagination', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'essential-addons-elementor' ),
				'label_off' => __( 'no', 'essential-addons-elementor' ),
				'return_value' => 'enable',
			]
		);
		
		$this->end_controls_section();
		
		/**
		 * Gallery Text Settings
		 */
		$this->start_controls_section(
			'main_gallery_config_settings',
			[
				'label' => esc_html__( 'Gallery Images', 'essential-addons-elementor' ),
			]
		);

		$this->add_control(
			'slider',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'main_gallery_settings_slide' => KODEFOREST_MAIN_URL . 'assets/gallery/simple-gallery.png' ],
					[ 'main_gallery_settings_slide' => KODEFOREST_MAIN_URL . 'assets/gallery/simple-gallery.png' ],
					[ 'main_gallery_settings_slide' => KODEFOREST_MAIN_URL . 'assets/gallery/simple-gallery.png' ],
					[ 'main_gallery_settings_slide' => KODEFOREST_MAIN_URL . 'assets/gallery/simple-gallery.png' ],
					[ 'main_gallery_settings_slide' => KODEFOREST_MAIN_URL . 'assets/gallery/simple-gallery.png' ],
					[ 'main_gallery_settings_slide' => KODEFOREST_MAIN_URL . 'assets/gallery/simple-gallery.png' ],
					[ 'main_gallery_settings_slide' => KODEFOREST_MAIN_URL . 'assets/gallery/simple-gallery.png' ],
				],
				'fields' => [
					[
						'name' => 'main_gallery_settings_slide',
						'label' => esc_html__( 'Image', 'essential-addons-elementor' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => KODEFOREST_MAIN_URL . 'assets/gallery/simple-gallery.png',
						],
					],
					[
						'name' => 'main_gallery_settings_slide_title',
						'label' => esc_html__( 'Image Title', 'essential-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( '', 'essential-addons-elementor' )
					],
					[
						'name' => 'main_gallery_settings_slide_caption',
						'label' => esc_html__( 'Image Caption', 'essential-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( '', 'essential-addons-elementor' )
					],
					[
						'name' => 'main_gallery_settings_enable_slide_link',
						'label' => __( 'Enable Image Link', 'essential-addons-elementor' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'false',
						'label_on' => esc_html__( 'Yes', 'essential-addons-elementor' ),
						'label_off' => esc_html__( 'No', 'essential-addons-elementor' ),
						'return_value' => 'true',
						
				  	],
				  	[
						'name' => 'main_gallery_settings_slide_link',
						'label' => esc_html__( 'Image Link', 'essential-addons-elementor' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
		        			'url' => '#',
		        			'is_external' => '',
		     			],
		     			'show_external' => true,
		     			'condition' => [
		     				'main_gallery_settings_enable_slide_link' => 'true'
		     			]
					]
				],
				'title_field' => '{{main_gallery_settings_slide_title}}',
			]
		);

		$this->end_controls_section();
		
		/**
		 * Gallery Text Settings
		 */
		$this->start_controls_section(
			'main_gallery_color_settings',
			[
				'label' => esc_html__( 'Color & Design', 'essential-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'main_galleryt_bghover_color',
			[
				'label' => esc_html__( 'Background Hover Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#d2973b',
				'selectors' => [
					'{{WRAPPER}}  .kode_gallery_fig:hover img' => 'background-color: {{VALUE}} !important;',
				],
			]
		);		
		
		$this->add_control(
			'main_gallery_caption_color',
			[
				'label' => esc_html__( 'Image Caption Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f4f4f4',
				'selectors' => [
					'{{WRAPPER}} .slide-item .slide-caption .slide-caption-des' => 'color: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_control(
			'main_gallery_button_bg_color',
			[
				'label' => esc_html__( 'Image Button BG Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f4f4f4',
				'selectors' => [
					'{{WRAPPER}} .kode_gallery_fig:hover a' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {		
		
		$settings = $this->get_settings();
		
		// start printing gallery
		$current_size = 0;
		$settings['num-fetch'] = empty($settings['num-fetch'])? 9999: intval($settings['num-fetch']);
		$paged = (get_query_var('paged'))? get_query_var('paged') : 1;
		$num_page = ceil(sizeof($settings['slider']) / $settings['num-fetch']);?>
		<div class="wpha-item-holder main-gallery-wrapper main-gallery-<?php echo esc_attr( $this->get_id() ); ?>">
			<?php 
			
			echo '
			<div class="row">
			<div class="col-md-12 wpha-listing-item gallery-slider kode-style-gal-'.esc_attr($settings['style']).' kode-gallery kode-gutter-gallery bottom-spacer">';
			
			if($settings['style'] == 'simple-gallery'){
				
				echo '<div class="kode-item">';	
				
				foreach($settings['slider'] as $slide_id => $slides){
					if( ($current_size >= ($paged - 1) * $settings['num-fetch']) &&
						($current_size < ($paged) * $settings['num-fetch']) ){

						if( !empty($current_size) && ($current_size % $settings['gallery-columns'] == 0) ){
							echo '<div class="clear"></div>';
						}
						$image_id = $this->wpjb_get_image_id($slides['main_gallery_settings_slide']['url']);
						$image_src = wp_get_attachment_image_src($image_id, $settings['thumbnail-size']);
						
						$image_src = '';
						if(!empty($slides['main_gallery_settings_slide']['id'])){
							$image_id = $this->wpjb_get_image_id($slides['main_gallery_settings_slide']['url']);
							$image_src = wp_get_attachment_image_src($image_id, $settings['thumbnail-size']);
							$image_src = $image_src[0];
						}else{
							$image_src = $slides['main_gallery_settings_slide']['url'];	
						}
						
						echo '
						<div class="gallery-item columns ' . wpha_get_column_class_updated('1/' . $settings['gallery-columns']) . '">
							<div class="kode_gallery_fig">
								<figure class="them_overlay">
									<img src="'.esc_url($image_src).'" alt="">
									<a class="hvr-ripple-out" data-rel="prettyphoto[]" href="'.esc_url($image_src).'"><i class="fa fa-expand"></i></a>
								</figure>
							</div>
						</div>'; // gallery column				
					}
					$current_size ++;
				}
				echo '<div class="clearfix clear"></div>';
				echo '</div>'; // kode-gallery-item
			}else if($settings['style'] == 'gallery-slider'){
				
				
				echo '<div data-margin="0" data-slide="'.esc_attr($settings['gallery-columns']).'" data-small-slide="'.esc_attr($settings['gallery-columns']).'" class="owl-carousel-item owl-theme-item kode_video_list">';
				
				foreach($settings['slider'] as $slide_id => $slides){
					if( ($current_size >= ($paged - 1) * $settings['num-fetch']) &&
						($current_size < ($paged) * $settings['num-fetch']) ){

						if( !empty($current_size) && ($current_size % $settings['gallery-columns'] == 0) ){
							echo '';
						}
						$image_src = '';
						if(!empty($slides['main_gallery_settings_slide']['id'])){
							$image_id = $this->wpjb_get_image_id($slides['main_gallery_settings_slide']['url']);
							$image_src = wp_get_attachment_image_src($image_id, $settings['thumbnail-size']);
							$image_src = $image_src[0];
						}else{
							$image_src = $slides['main_gallery_settings_slide']['url'];	
						}
						
						echo '
						<div class="items columns">
							<img src="'.esc_url($image_src).'" alt="" />
						</div>'; // gallery item
					}
					$current_size ++;
				}
				
				echo '</div>'; // kode-gallery-item

			}
			
			if( $settings['pagination'] == true ){
				echo baldiyaat_get_pagination($num_page, $paged);
			}
			
		echo '</div></div></div>'; // kode-gallery-item
		
		
	}
	
	function wpjb_get_image_id($image_url) {
		global $wpdb;
		if(isset($image_url)){
			$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
			if(!empty($attachment)){
				return $attachment[0]; 
			}			
		}
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {}
	
}
