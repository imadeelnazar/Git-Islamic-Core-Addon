<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Call To Action Banner
 *
 * Elementor widget for call to action banner.
 *
 * @since 1.0.0
 */
class Call_To_Action_Banner extends Widget_Base {

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
		return 'call-to-action-banner';
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
		return __( 'CTA Banner', 'elementor-call-to-action' );
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
			'call_to_action_banner_settings',
			[
				'label' => __( 'Call To Action Banner', 'elementor-call-to-action' ),
			]
		);
		
		$this->add_control(
			'call_to_action_style',
			[
			 'label'       	=> esc_html__( 'Style', 'essential-addons-elementor' ),
			   'type' 			=> Controls_Manager::SELECT,
			   'default' 		=> 'style-1',
			   'label_block' 	=> false,
			   'options' 		=> [				
				  'style-1' => esc_html__('Style 1', 'jobly'),
				  'style-2' => esc_html__('Style 2', 'jobly')
			   ],
			]
		);
		
		$this->add_control(
			'call_to_action_image',
			[
				'label' => esc_html__( 'Call To Action Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'assets/call-to-action/fig-app.png',
				]				
			]
		);

		$this->add_control(
			'call_to_action_banner_title',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Download App Now!', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_banner_caption',
			[
				'label' => esc_html__( 'Caption', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'This is Photoshops version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, ', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_banner_button',
			[
				'label' => esc_html__( 'Call To Action Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'assets/call-to-action/dowload-app1.png',
				]				
			]
		);
		
		$this->add_control(
			'call_to_action_banner_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Join Our Party', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_banner_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( '#', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_banner_button_two',
			[
				'label' => esc_html__( 'Call To Action Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'assets/call-to-action/dowload-app.png',
				]				
			]
		);
		
		$this->add_control(
			'call_to_action_banner_btn_text_two',
			[
				'label' => esc_html__( 'Button Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Join Our Party', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_banner_btn_link_two',
			[
				'label' => esc_html__( 'Button Link', 'essential-addons-elementor' ),
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
			'call_to_action_banner_color_settings',
			[
				'label' => esc_html__( 'Color & Design', 'essential-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'call_to_action_title_color',
			[
				'label' => esc_html__( 'Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f4f4f4',
				'selectors' => [
					'{{WRAPPER}} .job_download_text h2' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'call_to_action_caption_color',
			[
				'label' => esc_html__( 'Caption Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f4f4f4',
				'selectors' => [
					'{{WRAPPER}} .job_download_text p' => 'color: {{VALUE}};',
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
		
		?>
		<div class="call-to-action-banner-wrapper call-to-action-<?php echo esc_attr( $this->get_id() ); ?>">
			<?php if(isset($settings['call_to_action_style']) && $settings['call_to_action_style'] == 'style-1'){ ?>
			<!--JOB DOWNLOAD APP START-->
			<div class="job_download_app">
				<div class="col-md-6">
					<div class="job_download_text">
						<?php if(!empty($settings['call_to_action_banner_title'])){ ?><h2><?php echo esc_html($settings['call_to_action_banner_title'])?></h2><?php }?>
						<?php if(!empty($settings['call_to_action_banner_caption'])){ ?><p><?php echo esc_html($settings['call_to_action_banner_caption'])?></p><?php }?>
						<div class="job_download_fig">
							<a href="<?php echo esc_url($settings['call_to_action_banner_btn_link'])?>">
								<?php 
								if(!empty($settings['call_to_action_banner_button']['id'])){
									$image_src = wp_get_attachment_image_src($settings['call_to_action_banner_button']['id'], 'full');?>
									<img src="<?php echo esc_url($image_src[0])?>" alt="">
								<?php }else{ ?>
									<img src="<?php echo esc_url($settings['call_to_action_banner_button']['url'])?>" alt="">
								<?php }?>
							</a>
							<a href="<?php echo esc_url($settings['call_to_action_banner_btn_link_two'])?>">
								<?php 
								if(!empty($settings['call_to_action_banner_button_two']['id'])){
									$image_src = wp_get_attachment_image_src($settings['call_to_action_banner_button_two']['id'], 'full');?>
									<img src="<?php echo esc_url($image_src[0])?>" alt="">
								<?php }else{ ?>
									<img src="<?php echo esc_url($settings['call_to_action_banner_button_two']['url'])?>" alt="">
								<?php }?>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="job_app_fig float-bob">
						<?php 
						if(!empty($settings['call_to_action_image']['id'])){
							$image_src = wp_get_attachment_image_src($settings['call_to_action_image']['id'], 'full');?>
							<figure>
								<img src="<?php echo esc_url($image_src[0])?>" alt="">
							</figure>
						<?php }else{ ?>
							<figure>
								<img src="<?php echo esc_url($settings['call_to_action_image']['url'])?>" alt="">
							</figure>
						<?php }?>
					</div>
				</div>	
			</div>	
			<!--JOB DOWNLOAD APP END-->
			
			<?php }else{ ?>
			
			<div class="job_mobile_apps_text">
				<h2><?php echo esc_html($settings['call_to_action_banner_title'])?></h2>
				<p><?php echo esc_html($settings['call_to_action_banner_caption'])?></p>
				<div class="job_mobile_apps_fig">
					<a href="<?php echo esc_url($settings['call_to_action_banner_btn_link'])?>">
						<?php 
						if(!empty($settings['call_to_action_banner_button']['id'])){
							$image_src = wp_get_attachment_image_src($settings['call_to_action_banner_button']['id'], 'full');?>
							<img src="<?php echo esc_url($image_src[0])?>" alt="">
						<?php }else{ ?>
							<img src="<?php echo esc_url($settings['call_to_action_banner_button']['url'])?>" alt="">
						<?php }?>
					</a>
					<a href="<?php echo esc_url($settings['call_to_action_banner_btn_link_two'])?>">
						<?php 
						if(!empty($settings['call_to_action_banner_button_two']['id'])){
							$image_src = wp_get_attachment_image_src($settings['call_to_action_banner_button_two']['id'], 'full');?>
							<img src="<?php echo esc_url($image_src[0])?>" alt="">
						<?php }else{ ?>
							<img src="<?php echo esc_url($settings['call_to_action_banner_button_two']['url'])?>" alt="">
						<?php }?>
					</a>
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
