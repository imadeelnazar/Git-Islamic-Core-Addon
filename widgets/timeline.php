<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Project Facts
 *
 * Elementor widget for project facts.
 *
 * @since 1.0.0
 */
class Pillers_Forest extends Widget_Base {

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
		return 'pillers';
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
		return __( 'Pillers', 'elementor-call-to-action' );
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
		return 'eicon-alert';
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
		
		return [ 'core-style', 'wpicon-moon' ];	
		
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
			'timeline_forest_settings',
			[
				'label' => __( 'Pillers', 'elementor-call-to-action' ),
			]
		);

		$this->add_control(
		  'style',
		  	[
		   	'label'       	=> esc_html__( 'Style', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'bxslider',
		     	'label_block' 	=> false,
		     	'options' 		=> [				
					'none' => esc_html__('None', 'jobly'),
					'style-1' => esc_html__('Style 1', 'jobly'),
					'style-2' => esc_html__('Style 2', 'jobly')					
		     	],
		  	]
		);
		
		$this->add_control(
			'first-pillar-icon',
			[
				'label' => __( 'Icon', 'essential-addons-elementor' ),
				'name' => 'price_table_settings_icon',				
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => esc_html__( 'islamic-monitor', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'first-pillar',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('FASTING', 'jobly')
			]
		);
		
		$this->add_control(
			'first-pillar-description',
			[
				'label' => esc_html__( 'Caption', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority is have suffered alteration in some form...', 'jobly')
			]
		);

		
		$this->add_control(
			'first-pillar-image',
			[
				'label' => esc_html__( 'First Piller Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'assets/banner/1.jpg',
				],
				'condition' => [
					'style' => 'style-2'
				]
			]
		);
		
		$this->add_control(
			'second-pillar-icon',
			[
				'label' => __( 'Icon', 'essential-addons-elementor' ),
				'name' => 'price_table_settings_icon',				
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => esc_html__( '', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'second-pillar',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('HAJJ', 'jobly')
			]
		);
		
		$this->add_control(
			'second-pillar-description',
			[
				'label' => esc_html__( 'Caption', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority is have suffered alteration in some form...', 'jobly')
			]
		);

		$this->add_control(
			'second-pillar-image',
			[
				'label' => esc_html__( 'Second Piller Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'assets/banner/1.jpg',
				],
				'condition' => [
					'style' => 'style-2'
				]
			]
		);
		
		$this->add_control(
			'third-pillar-icon',
			[
				'label' => __( 'Icon', 'essential-addons-elementor' ),
				'name' => 'price_table_settings_icon',				
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => esc_html__( '', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'third-pillar',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('ZAKAT', 'jobly')
			]
		);
		
		$this->add_control(
			'third-pillar-description',
			[
				'label' => esc_html__( 'Caption', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority is have suffered alteration in some form...', 'jobly')
			]
		);

		$this->add_control(
			'third-pillar-image',
			[
				'label' => esc_html__( 'Third Piller Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'assets/banner/1.jpg',
				],
				'condition' => [
					'style' => 'style-2'
				]
			]
		);
		
		$this->add_control(
			'fourth-pillar-icon',
			[
				'label' => __( 'Icon', 'essential-addons-elementor' ),
				'name' => 'price_table_settings_icon',				
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => esc_html__( '', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'fourth-pillar',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('SALAH', 'jobly')
			]
		);
		
		$this->add_control(
			'fourth-pillar-description',
			[
				'label' => esc_html__( 'Caption', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority is have suffered alteration in some form...', 'jobly')
			]
		);

		$this->add_control(
			'fourth-pillar-image',
			[
				'label' => esc_html__( 'Fourth Piller Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'assets/banner/1.jpg',
				],
				'condition' => [
					'style' => 'style-2'
				]
			]
		);
		
		$this->add_control(
			'fifth-pillar-icon',
			[
				'label' => __( 'Icon', 'essential-addons-elementor' ),
				'name' => 'price_table_settings_icon',				
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => esc_html__( '', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'fifth-pillar',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('SHAHDAH', 'jobly')
			]
		);
		
		$this->add_control(
			'fifth-pillar-description',
			[
				'label' => esc_html__( 'Caption', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority is have suffered alteration in some form...', 'jobly'),

			]
		);
		

		$this->add_control(
			'fifth-pillar-image',
			[
				'label' => esc_html__( 'Fifth  Piller Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'assets/banner/1.jpg',
				],
				'condition' => [
					'style' => 'style-2'
				]
			]
		);
		
		$this->end_controls_section();

		/**
		 * Slider Text Settings
		 */
		$this->start_controls_section(
			'timeline_forest_color_settings',
			[
				'label' => esc_html__( 'Color & Design', 'essential-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'timeline_forest_title_color',
			[
				'label' => esc_html__( 'Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane .kode_pillars_text h4' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'timeline_forest_sub_title_color',
			[
				'label' => esc_html__( 'Caption & Sub Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane .kode_pillars_text p' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'timeline_forest_panel_title_color',
			[
				'label' => esc_html__( 'Panel Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .kode_pillars_item li a h6' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'timeline_forest_Panel_title_hover_color',
			[
				'label' => esc_html__( 'Panel Title Hover Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_pillars_item li a:hover h6' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'timeline_forest_panel_list_bg_color',
			[
				'label' => esc_html__( 'Panel Background Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_pillars_item li a' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'timeline_forest_panel_list_bghover_color',
			[
				'label' => esc_html__( 'Panel Background Hover Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#d2973b',
				'selectors' => [
					'{{WRAPPER}} .kode_pillars_item li a:hover' => 'background-color: {{VALUE}} !important;',
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
		$settings = $this->get_settings();?>
		<div class="timeline-wrapper timeline-<?php echo esc_attr( $this->get_id() ); ?>">
			
			<?php 
			
			if(strpos($settings['first-pillar-icon'],'fa-') === false){
				$settings['first_pillar_icon'] = $settings['first-pillar-icon'].' islamicon';
			}else{
				$settings['first_pillar_icon'] = $settings['first-pillar-icon'];
			}
			
			if(strpos($settings['second-pillar-icon'],'fa-') === false){
				$settings['second_pillar_icon'] = $settings['second-pillar-icon'].' islamicon';
			}else{
				$settings['second_pillar_icon'] = $settings['second-pillar-icon'];
			}
			
			if(strpos($settings['third-pillar-icon'],'fa-') === false){
				$settings['third_pillar_image'] = $settings['third-pillar-icon'].' islamicon';
			}else{
				$settings['third_pillar_image'] = $settings['third-pillar-icon'];
			}
			
			if(strpos($settings['fourth-pillar-icon'],'fa-') === false){
				$settings['fourth_pillar_image'] = $settings['fourth-pillar-icon'].' islamicon';
			}else{
				$settings['fourth_pillar_image'] = $settings['fourth-pillar-icon'];
			}
			
			if(strpos($settings['fifth-pillar-icon'],'fa-') === false){
				$settings['fifth_pillar_image'] = $settings['fifth-pillar-icon'].' islamicon';
			}else{
				$settings['fifth_pillar_image'] = $settings['fifth-pillar-icon'];
			}
			echo islamic_center_get_islamic_pillars_item($settings);?>
		</div>
		<?php 
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
