<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Call To Action Text
 *
 * Elementor widget for call to action text.
 *
 * @since 1.0.0
 */
class Islamic_Centre_Newsletter extends Widget_Base {

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
		return 'islamic-centre-newsletter';
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
		return __( 'Newsletter', 'elementor-call-to-action' );
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
			'newsletter_settings',
			[
				'label' => __( 'Text & Content', 'elementor-call-to-action' ),
			]
		);
		
		$this->add_control(
			'newsletter_title',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'NEWSLETTER SIGN UP', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'newsletter_content',
			[
				'label' => esc_html__( 'Sub Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'For Latest Updates & For Majalis', 'essential-addons-elementor' )
			]
		);
					
		$this->add_control(
			'newsletter_button_text_two',
			[
				'label' => esc_html__( 'Button Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'See More', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'newsletter_button_url_two',
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
			'newsletter_list_color_settings',
			[
				'label' => esc_html__( 'Color & Design', 'essential-addons-elementor' ),
			]
		);

		$this->add_control(
			'newsletter_title_color',
			[
				'label' => esc_html__( 'Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_newsletter_text a' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'newsletter_sub_title_color',
			[
				'label' => esc_html__( 'Sub Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_newsletter_text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'newsletter_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#D2973B',
				'selectors' => [
					'{{WRAPPER}} .kode_newsletter_wrap ' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'newsletter_button_bg_color',
			[
				'label' => esc_html__( 'Button Background Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .kode_newsletter_form .kf_commet_field input[type="submit"] ' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'newsletter_button_bg_hover_color',
			[
				'label' => esc_html__( 'Button Background Hover Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#D2973B',
				'selectors' => [
					'{{WRAPPER}} .kode_newsletter_form .kf_commet_field input[type="submit"]:hover ' => 'background-color: {{VALUE}};',
				],
			]
		);

		
		
		$this->add_control(
			'newsletter_Icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_newsletter_des span ' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'newsletter_title_size',
			[
				'label' => esc_html__( 'Title Size', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 24
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 60,
						'step' => 1
					],
				],
				'selectors' => [
					'{{WRAPPER}} .kode_newsletter_text a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
	
		$this->add_control(
			'newsletter_content_size',
			[
				'label' => esc_html__( 'Sub Title Size', 'essential-addons-elementor' ),
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
					'{{WRAPPER}} .kode_newsletter_text p' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
				 
		$this->add_control(
			'newsletter_title_weight',
				[
				 'label'       	=> esc_html__( 'Title Font Weight', 'essential-addons-elementor' ),
				   'type' 			=> Controls_Manager::SELECT,
				   'default' 		=> '600',
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
						'{{WRAPPER}} .kode_newsletter_text a' => 'font-weight: {{VALUE}};',
					]
				]
	   );
	   
	   $this->add_control(
	   'newsletter_content_weight',
				[
				 'label'       	=> esc_html__( 'Content Font Weight', 'essential-addons-elementor' ),
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
			<div class="kode_newsletter_wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="kode_newsletter_des">
								<span><i class="fa fa-envelope"></i></span>
								<div class="kode_newsletter_text">
									<h5><a href="#"><?php echo esc_attr($settings['newsletter_title'])?></a></h5>
									<p><?php echo esc_attr($settings['newsletter_content'])?></p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="kode_newsletter_form">		
								<form method="post" id="kode-submit-form" data-ajax="<?php echo esc_url(ISLAMIC_CENTER_AJAX_URL)?>" data-security="<?php echo wp_create_nonce('islamic-center-create-nonce')?>" data-action="newsletter_mailchimp">
									<div class="kf_commet_field">
										<input type="text" id="newsletter-email" name="email" placeholder="<?php echo esc_attr__('Enter Your Email','islamic-center')?>" class="placeholder2" />
										<input class="medium_btn background-bg-dark btn_hover hvr-wobble-bottom" value="<?php echo esc_attr($settings['newsletter_button_text_two'])?>" type="submit">
										<p class="status"></p>
									</div>
								</form>
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
