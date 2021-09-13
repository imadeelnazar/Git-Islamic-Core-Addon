<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Main Slider
 *
 * Elementor widget for main slider.
 *
 * @since 1.0.0
 */
class Main_Slider extends Widget_Base {

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
		return 'main-slider';
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
		return __( 'Main Slider', 'elementor-main-slider' );
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
		
			return ['bx-main-slider', 'slick-slider-js', 'slick-slider-css', 'slick-slider-theme', 'flex-main-slider-js','flex-main-slider-css','core-functions' , 'elementor-main-style' ];	
	
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
			'section_content',
			[
				'label' => __( 'Content', 'elementor-main-slider' ),
			]
		);

		
		$this->add_control(
		  'main_slider_settings_type',
		  	[
		   	'label'       	=> esc_html__( 'Slider Type', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'bxslider',
		     	'label_block' 	=> false,
		     	'options' 		=> [				
					//'bgslider' => esc_html__('Background slider', 'jobly'),
					//'flexslider' => esc_html__('Flex slider', 'jobly'),
					'bxslider' => esc_html__('BX Slider', 'jobly'),
					//'slickslider' => esc_html__('Slick Slider', 'jobly'),
					//'carousel' => esc_html__('Carousel Slider', 'jobly'),
					//'nivoslider' => esc_html__('Nivo Slider', 'jobly')
		     	],
		  	]
		);
		
		$this->add_control(
			'main_slider_settings_fade_in',
			[
				'label' => esc_html__( 'Fade In (ms)', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => 400,
			]
		);

		$this->add_control(
		  'main_slider_settings_loop',
		  	[
				'label' => __( 'Loop', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'false',
				'label_on' => esc_html__( 'Yes', 'essential-addons-elementor' ),
				'label_off' => esc_html__( 'No', 'essential-addons-elementor' ),
				'return_value' => 'true',
		  	]
		);

		$this->add_control(
		  'main_slider_settings_autoplay',
		  	[
				'label' => __( 'Autoplay', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'false',
				'label_on' => esc_html__( 'Yes', 'essential-addons-elementor' ),
				'label_off' => esc_html__( 'No', 'essential-addons-elementor' ),
				'return_value' => 'true',
		  	]
		);

		/**
		 * Condition: 'main_slider_settings_autoplay' => 'true'
		 */
		$this->add_control(
			'main_slider_settings_autoplay_time',
			[
				'label' => esc_html__( 'Autoplay Timeout (ms)', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => 2000,
				'condition' => [
					'main_slider_settings_autoplay' => 'true'
				]
			]
		);
		
		$this->add_control(
		  'main_slider_settings_button',
		  	[
				'label' => __( 'Bullets or Navigator', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'true',
				'label_on' => esc_html__( 'Yes', 'essential-addons-elementor' ),
				'label_off' => esc_html__( 'No', 'essential-addons-elementor' ),
				'return_value' => 'true',
		  	]
		);

		$this->add_control(
			'main_slider_settings_spacing',
			[
				'label' => esc_html__( 'Slide Margin', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => -0.6
				],
				'range' => [
					'px' => [
						'min' => -1,
						'max' => 1,
						'step' => 0.1
					],
				],
			]
		);
		
		$this->end_controls_section();

		/**
		 * Filp Carousel Slides
		 */
		$this->start_controls_section(
			'main_slider_setting_slides',
			[
				'label' => esc_html__( 'Manage Slides', 'essential-addons-elementor' ),
			]
		);
		

		$this->add_control(
			'main_slider_settings_slides',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'main_slider_settings_slide' => KODEFOREST_MAIN_URL . 'assets/banner/1.jpg' ],
					[ 'main_slider_settings_slide' => KODEFOREST_MAIN_URL . 'assets/banner/2.jpg' ],
					[ 'main_slider_settings_slide' => KODEFOREST_MAIN_URL . 'assets/banner/3.jpg' ]
				],
				'fields' => [
					[
						'name' => 'main_slider_settings_slide',
						'label' => esc_html__( 'Slide', 'essential-addons-elementor' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => KODEFOREST_MAIN_URL . 'assets/banner/1.jpg',
						],
					],
					[
						'name' => 'main_slider_settings_caption_direction',
						'label' => esc_html__( 'Caption Direction', 'essential-addons-elementor' ),
						'type' => Controls_Manager::SELECT,
						'options' 		=> [				
							'center' => esc_html__('Center', 'jobly'),
							'left' => esc_html__('Left', 'jobly'),
							'right' => esc_html__('Right', 'jobly')
						],
						'default' => esc_html__( 'left', 'essential-addons-elementor' )
					],
					[
						'name' => 'main_slider_settings_slide_title',
						'label' => esc_html__( 'Slide Title', 'essential-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( 'O MANKIND', 'essential-addons-elementor' )
					],
					[
						'name' => 'main_slider_settings_slide_caption',
						'label' => esc_html__( 'Slide Caption', 'essential-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words...', 'essential-addons-elementor' )
					],
					[
						'name' => 'main_slider_settings_slide_text',
						'label' => esc_html__( 'Button Text', 'essential-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( 'Read More ', 'essential-addons-elementor' )
					],
					[
						'name' => 'main_slider_settings_enable_slide_link',
						'label' => __( 'Enable Slide Link', 'essential-addons-elementor' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'false',
						'label_on' => esc_html__( 'Yes', 'essential-addons-elementor' ),
						'label_off' => esc_html__( 'No', 'essential-addons-elementor' ),
						'return_value' => 'true',
						
				  	],
				  	[
						'name' => 'main_slider_settings_slide_link',
						'label' => esc_html__( 'Slide Link', 'essential-addons-elementor' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
		        			'url' => '#',
		        			'is_external' => '',
		     			],
		     			'show_external' => true,
		     			'condition' => [
		     				'main_slider_settings_enable_slide_link' => 'true'
		     			]
					],
				],
				'title_field' => '{{main_slider_settings_slide_title}}',
			]
		);

		$this->end_controls_section();
		
		/**
		 * Slider Text Settings
		 */
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Color & Design', 'essential-addons-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'name' => 'main_slider_title',
				'selector' => '{{WRAPPER}} .slide-item .slide-caption .slide-caption-title, {{WRAPPER}} .kode-bxslider .item .kode-caption .large_text',
			]
		);
		
		$this->add_control(
			'main_slider_title_color',
			[
				'label' => esc_html__( 'Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f4f4f4',
				'selectors' => [
					'{{WRAPPER}} .slide-item .slide-caption .slide-caption-title, {{WRAPPER}} .kode-bxslider .item .kode-caption .large_text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Caption', 'essential-addons-elementor' ),
				'name' => 'main_slider_caption',
				'selector' => '{{WRAPPER}} .slide-item .slide-caption .slide-caption-des, {{WRAPPER}} .kode-bxslider .item .kode-caption .small_text',
			]
		);
		
		$this->add_control(
			'main_slider_caption_color',
			[
				'label' => esc_html__( 'Caption Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f4f4f4',
				'selectors' => [
					'{{WRAPPER}} .slide-item .slide-caption .slide-caption-des, {{WRAPPER}} .kode-bxslider .item .kode-caption .small_text' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'main_slider_button_color',
			[
				'label' => esc_html__( 'Button Text Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f4f4f4',
				'selectors' => [
					'{{WRAPPER}} .slide-item .slide-caption .banner_text_btn .bg-color, .main_banner .banner_text .banner_btn .btn-bg-1,{{WRAPPER}} .kode-bxslider .item .kode-caption .koed_banner_btn .medium_btn' => 'color: {{VALUE}};',
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
		wp_register_script( 'bx-main-slider', plugins_url( '/assets/bxslider/jquery.bxslider.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_style( 'bx-main-slider', plugins_url( '/assets/bxslider/bxslider.css', __FILE__ ) );  // BxSlider
		
		
		$settings = $this->get_settings();
		$wrapper = 'div';
		$wrapper_child = 'div';
		?>
		<div class="main-slider-wrapper main-slider-<?php echo esc_attr( $this->get_id() ); ?>">
		<?php if(isset($settings['main_slider_settings_type']) && $settings['main_slider_settings_type'] == 'flexslider'){ ?>
			<div class="elementor-slider-wrapper item-wrap-<?php echo esc_attr( $settings['main_slider_settings_type'] ); ?>">
				
				<div class="flexslider">
					<?php foreach( $settings['main_slider_settings_slides'] as $slides ) { 
					if(!empty($slides['main_slider_settings_slide']['id'])){
						$image_src = wp_get_attachment_image_src($slides['main_slider_settings_slide']['id'], 'full');?>
						<div>
							<img src="<?php echo esc_url($image_src[0])?>" alt="" />
							<div class="kode-caption-wrapper position-<?php echo esc_attr($slides['main_slider_settings_caption_direction'])?>">
								<div class="kode-caption-inner container" >
									<div class="kode-caption">
										<div class="kode-caption-title"><?php echo esc_html($slides['main_slider_settings_slide_title']);?></div>
										<div class="kode-caption-text"><?php echo esc_html($slides['main_slider_settings_slide_caption']);?></div>
										<a class="kode_btn_store_1 btn-default small-btn theme-bg-color theme-bdr-color"><?php echo esc_html($slides['main_slider_settings_slide_text']);?><i class="fa fa-angle-right"></i></a>
									</div>
								</div>
							</div>	
						</div>
					<?php }else{ ?>
						<div>
							<img src="<?php echo esc_url($slides['main_slider_settings_slide']['url'])?>" alt="" />
							<div class="kode-caption-wrapper position-<?php echo esc_attr($slides['main_slider_settings_caption_direction'])?>">
								<div class="kode-caption-inner container" >
									<div class="kode-caption">
										<div class="kode-caption-title"><?php echo esc_html($slides['main_slider_settings_slide_title']);?></div>
										<div class="kode-caption-text"><?php echo esc_html($slides['main_slider_settings_slide_caption']);?></div>
										<?php if(isset($slides['main_slider_settings_enable_slide_link']) && $slides['main_slider_settings_enable_slide_link'] == 'true'){ ?><a class="kode_btn_store_1 btn-default small-btn theme-bg-color theme-bdr-color"><?php echo esc_html($slides['main_slider_settings_slide_text']);?> <i class="fa fa-angle-right"></i></a><?php }?>
									</div>
								</div>
							</div>	
						</div>
						<?php 
						}
					}?>
				</div>
			
			</div>			
			<?php 
		}else if(isset($settings['main_slider_settings_type']) && $settings['main_slider_settings_type'] == 'slickslider'){ ?>
			<div class="elementor-slider-wrapper  item-wrap-<?php echo esc_attr( $settings['main_slider_settings_type'] ); ?>">
				
				<div class="slickslider">
					<?php foreach( $settings['main_slider_settings_slides'] as $slides ) { 
					if(!empty($slides['main_slider_settings_slide']['id'])){
						$image_src = wp_get_attachment_image_src($slides['main_slider_settings_slide']['id'], 'full');?>
						<div>
							<img src="<?php echo esc_url($image_src[0])?>" alt="" />
							<div class="kode-caption-wrapper position-<?php echo esc_attr($slides['main_slider_settings_caption_direction'])?>">
								<div class="kode-caption-inner container" >
									<div class="kode-caption">
										<div class="kode-caption-title"><?php echo esc_html($slides['main_slider_settings_slide_title']);?></div>
										<div class="kode-caption-text"><?php echo esc_html($slides['main_slider_settings_slide_caption']);?></div>
										<a class="kode_btn_store_1 btn-default small-btn theme-bg-color theme-bdr-color"><?php echo esc_html($slides['main_slider_settings_slide_text']);?><i class="fa fa-angle-right"></i></a>
									</div>
								</div>
							</div>	
						</div>
					<?php }else{ ?>
						<div>
							<img src="<?php echo esc_url($slides['main_slider_settings_slide']['url'])?>" alt="" />
							<div class="kode-caption-wrapper position-<?php echo esc_attr($slides['main_slider_settings_caption_direction'])?>">
								<div class="kode-caption-inner container" >
									<div class="kode-caption">
										<div class="kode-caption-title"><?php echo esc_html($slides['main_slider_settings_slide_title']);?></div>
										<div class="kode-caption-text"><?php echo esc_html($slides['main_slider_settings_slide_caption']);?></div>
										<?php if(isset($slides['main_slider_settings_enable_slide_link']) && $slides['main_slider_settings_enable_slide_link'] == 'true'){ ?><a class="kode_btn_store_1 btn-default small-btn theme-bg-color theme-bdr-color"><?php echo esc_html($slides['main_slider_settings_slide_text']);?> <i class="fa fa-angle-right"></i></a><?php }?>
									</div>
								</div>
							</div>	
						</div>
						<?php 
						}
					}?>
				</div>
			
			</div>			
			<?php 
		}else if(isset($settings['main_slider_settings_type']) && $settings['main_slider_settings_type'] == 'bxslider'){ ?>
			<div class="elementor-slider-wrapper  item-wrap-<?php echo esc_attr( $settings['main_slider_settings_type'] ); ?>">
				<div class="kode-bxslider kode_banner_wrap">
					<ul data-mode="fade" class="bxslider" data-min="1" data-max="1" data-margin="0">
						<?php foreach( $settings['main_slider_settings_slides'] as $slides ) { 
						if(!empty($slides['main_slider_settings_slide']['id'])){
							$image_src = wp_get_attachment_image_src($slides['main_slider_settings_slide']['id'], 'full');?>
							<li class="item">
								<figure>
									<img src="<?php echo esc_url($image_src[0])?>" alt="" />
									<div class="kode_banner_text position-<?php echo esc_attr($slides['main_slider_settings_caption_direction'])?>">
										<div class="kode-caption-inner container" >
											<div class="kode-caption">
												<div class="large_text"><?php echo esc_html($slides['main_slider_settings_slide_title']);?></div>
												<div class="small_text wow"><?php echo esc_html($slides['main_slider_settings_slide_caption']);?></div>
												<a class="koed_banner_btn wow"><span class="medium_btn border btn_hover hvr-wobble-bottom"> <?php echo esc_html($slides['main_slider_settings_slide_text']);?></span></a>
											</div>
										</div>
									</div>
								</figure>							
							</li>
						<?php }else{ ?>
							<li class="item">
								<figure>
									<img src="<?php echo esc_url($slides['main_slider_settings_slide']['url'])?>" alt="" />
									<div class="kode_banner_text position-<?php echo esc_attr($slides['main_slider_settings_caption_direction'])?>">
										<div class="kode-caption-inner container" >
											<div class="kode-caption">
												<div class="large_text"><?php echo esc_html($slides['main_slider_settings_slide_title']);?></div>
												<div class="small_text wow"><?php echo esc_html($slides['main_slider_settings_slide_caption']);?></div>
												<a class="koed_banner_btn wow"><span class="medium_btn border btn_hover hvr-wobble-bottom"> <?php echo esc_html($slides['main_slider_settings_slide_text']);?></span></a>
											</div>
										</div>
									</div>
								</figure>							
							</li>
							<?php 
							}
						}?>
					</ul>
					<div id="bx-pager" class="pager_link">
					<?php 
						$counter_slider = 0;
						foreach( $settings['main_slider_settings_slides'] as $slides ) { 
							if(!empty($slides['main_slider_settings_slide']['id'])){
							$image_src = wp_get_attachment_image_src($slides['main_slider_settings_slide']['id'], 'full');?>
							<a data-slide-index="<?php echo esc_attr($counter_slider)?>" href=""><img src="<?php echo esc_url($image_src[0])?>" alt="bx-pager" /></a>
						<?php }else{ ?>	
							<a data-slide-index="<?php echo esc_attr($counter_slider)?>" href=""><img src="<?php echo esc_url($slides['main_slider_settings_slide']['url'])?>" alt="bx-pager" /></a>
						<?php }$counter_slider++;
						}?>
					</div>
				</div>
			</div>
		<?php }?>
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
