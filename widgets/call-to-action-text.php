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
 * Elementor Call To Action Text
 *
 * Elementor widget for call to action text.
 *
 * @since 1.0.0
 */
class call_to_action_text extends Widget_Base {

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
		return 'call-to-action-text';
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
		return __( 'CTA Text', 'elementor-call-to-action' );
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
		return 'eicon-call-to-action';
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
			'call_to_action_text_settings',
			[
				'label' => __( 'Text & Content', 'elementor-call-to-action' ),
			]
		);
		
		$this->add_control(
			'call_to_action_text_image',
			[
				'label' => esc_html__( 'Call To Action Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'assets/images/pray.png',
				]				
			]
		);
		

		$this->add_control(
			'call_to_action_text_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Is Your Cv is', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_text_title',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Good Enough', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_text_content',
			[
				'label' => esc_html__( 'Content', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'Search all the open positions on the web. Get your own personalized salary estimate. Read reviews on over 600,000 companies worldwide.', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_text_button_text',
			[
				'label' => esc_html__( 'Button Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Expert Feedback', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_text_button_url',
			[
				'label' => esc_html__( 'Button URL', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( '#', 'essential-addons-elementor' )
			]
		);
		
		
		$this->add_control(
			'call_to_action_text_button_text_two',
			[
				'label' => esc_html__( 'Button Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'See More', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_text_button_url_two',
			[
				'label' => esc_html__( 'Button URL', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( '#', 'essential-addons-elementor' )
			]
		);
		
		$this->end_controls_section();
		
		
	
	
	/**
		 * Slider Text Settings
		 */
		$this->start_controls_section(
			'call_to_action_text_list_color_settings',
			[
				'label' => esc_html__( 'Color & Design', 'essential-addons-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .kode_pray_text h2',
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'body_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}}',
				'fields_options' => [
					'background' => [
						'frontend_available' => true,
					],
					'color' => [
						'dynamic' => [],
					],
					'color_b' => [
						'dynamic' => [],
					],
				],
			]
		);

		$this->add_control(
			'call_to_action_text_title_color',
			[
				'label' => esc_html__( 'Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .kode_pray_text  h2' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'call_to_action_text_sub_title_color',
			[
				'label' => esc_html__( 'Sub Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .kode_pray_text h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'call_to_action_text_content_color',
			[
				'label' => esc_html__( 'Content Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .kode_pray_text p' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'call_to_action_text_bottontxt_color',
			[
				'label' => esc_html__( 'Button   Text  Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_pray_btn' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'call_to_action_text_list_btn_bg_color',
			[
				'label' => esc_html__( 'Button Background Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .kode_pray_btn a' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'call_to_action_text_subtitle_size',
			[
				'label' => esc_html__( 'Sub Title Size', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 18
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 60,
						'step' => 1
					],
				],
				'selectors' => [
					'{{WRAPPER}} .kode_pray_text h5' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'call_to_action_text_content_size',
			[
				'label' => esc_html__( 'Second Title Size', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 60,
						'step' => 1
					],
				],
				'selectors' => [
					'{{WRAPPER}} .kode_pray_text p' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
				 
		$this->add_control(
			'call_to_action_text_title_weight',
				[
				 'label'       	=> esc_html__( 'Title Font Weight', 'essential-addons-elementor' ),
				   'type' 			=> Controls_Manager::SELECT,
				   'default' 		=> '400',
				   'label_block' 	=> false,
				   'options' 		=> [				
					  'normal' => esc_html__('normal', 'jobly'),  
					  '100' => esc_html__('100', 'jobly'),
					  '200' => esc_html__('200', 'jobly'),
					  '300' => esc_html__('300', 'jobly'),
					  '400' => esc_html__('400', 'jobly'),
					  '500' => esc_html__('500', 'jobly'),
					  '600' => esc_html__('600', 'jobly'),
					  '700' => esc_html__('700', 'jobly'),
					  '800' => esc_html__('800', 'jobly'),
					  'bold' => esc_html__('Bold', 'jobly')
				   ],
				   'selectors' => [
						'{{WRAPPER}} .kode_pray_text  h2' => 'font-weight: {{VALUE}};',
					]
				]
	   );
	   $this->add_control(
			'call_to_action_text_sub_title_weight',
				[
				 'label'       	=> esc_html__( 'Sub Title  Font Weight', 'essential-addons-elementor' ),
				   'type' 			=> Controls_Manager::SELECT,
				   'default' 		=> '700',
				   'label_block' 	=> false,
				   'options' 		=> [				
					  'normal' => esc_html__('normal', 'jobly'),  
					  '100' => esc_html__('100', 'jobly'),
					  '200' => esc_html__('200', 'jobly'),
					  '300' => esc_html__('300', 'jobly'),
					  '400' => esc_html__('400', 'jobly'),
					  '500' => esc_html__('500', 'jobly'),
					  '600' => esc_html__('600', 'jobly'),
					  '700' => esc_html__('700', 'jobly'),
					  '800' => esc_html__('800', 'jobly'),
					  'bold' => esc_html__('Bold', 'jobly')
				   ],
				   'selectors' => [
						'{{WRAPPER}} .kode_pray_text  h5' => 'font-weight: {{VALUE}};',
					]
				]
	   );
	   
	   $this->add_control(
	   'call_to_action_text_content_weight',
				[
				 'label'       	=> esc_html__( 'Content Font Weight', 'essential-addons-elementor' ),
				   'type' 			=> Controls_Manager::SELECT,
				   'default' 		=> '700',
				   'label_block' 	=> false,
				   'options' 		=> [				
					  'normal' => esc_html__('normal', 'jobly'),  
					  '100' => esc_html__('100', 'jobly'),
					  '200' => esc_html__('200', 'jobly'),
					  '300' => esc_html__('300', 'jobly'),
					  '400' => esc_html__('400', 'jobly'),
					  '500' => esc_html__('500', 'jobly'),
					  '600' => esc_html__('600', 'jobly'),
					  '700' => esc_html__('700', 'jobly'),
					  '800' => esc_html__('800', 'jobly'),
					  'bold' => esc_html__('Bold', 'jobly')
				   ],
				   'selectors' => [
						'{{WRAPPER}} .kode_pray_text p' => 'font-weight: {{VALUE}};',
					]
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
		
		?>
		<div class="call-to-action-text-wrapper call-to-action-<?php echo esc_attr( $this->get_id() ); ?>">
			
			<div class="kode_pray_wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-7">
							<div class="kode_pray_text">
								<h2><?php echo esc_html($settings['call_to_action_text_title'])?></h2>
								<h5><?php echo esc_html($settings['call_to_action_text_sub_title'])?></h5>
								<p><?php echo esc_html($settings['call_to_action_text_content'])?></p>
								<div class="kode_pray_btn">
									<a class="small_btn background-bg-dark margin-right btn_hover hvr-wobble-bottom" href="<?php echo esc_html($settings['call_to_action_text_button_url'])?>"><?php echo esc_html($settings['call_to_action_text_button_text'])?></a>
									<a class="small_btn background-bg-dark margin-right btn_hover hvr-wobble-bottom" href="<?php echo esc_html($settings['call_to_action_text_button_url_two'])?>"><?php echo esc_html($settings['call_to_action_text_button_text_two'])?></a>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="kode_pray_fig">
								<?php 
								if(!empty($settings['call_to_action_text_image']['id'])){
									$image_src = wp_get_attachment_image_src($settings['call_to_action_text_image']['id'], 'full');?>
									<figure>
										<img src="<?php echo esc_url($image_src[0])?>" alt="">
									</figure>
								<?php }else{ ?>
									<figure>
										<img src="<?php echo esc_url($settings['call_to_action_text_image']['url'])?>" alt="">
									</figure>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
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
