<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Jplayer Banner
 *
 * Elementor widget for call to action banner.
 *
 * @since 1.0.0
 */
class Jplayer_Default extends Widget_Base {

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
		return 'default-jplayer';
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
		return __( 'Default Jplayer', 'elementor-default-jplayer' );
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
		return 'eicon-default-jplayer';
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
			'default-jplayer_settings',
			[
				'label' => __( 'Jplayer', 'elementor-default-jplayer' ),
			]
		);
		
		$this->add_control(
			'default-jplayer_style',
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
			'default-jplayer_image',
			[
				'label' => esc_html__( 'Jplayer Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'assets/default-jplayer/fig-app.png',
				]				
			]
		);

		$this->add_control(
			'default-jplayer_title',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Download App Now!', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'default-jplayer_caption',
			[
				'label' => esc_html__( 'Caption', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'This is Photoshops version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, ', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
		  'enable-breadcrumbs',
		  	[
				'label' => __( 'Breadcrumbs', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'disable',
				'label_on' => esc_html__( 'Yes', 'essential-addons-elementor' ),
				'label_off' => esc_html__( 'No', 'essential-addons-elementor' ),
				'return_value' => 'enable',
		  	]
		);
		
		$this->end_controls_section();

		/**
		 * Slider Text Settings
		 */
		$this->start_controls_section(
			'default-jplayer_color_settings',
			[
				'label' => esc_html__( 'Color & Design', 'essential-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'default-jplayer_title_color',
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
			'default-jplayer_caption_color',
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
		$islamic_center_theme_option = get_option('islamic_center_admin_option', array());
		?>
		
		<div class="default-jplayer-wrapper default-jplayer-<?php echo esc_attr( $this->get_id() ); ?>">
			<?php if(isset($settings['default-jplayer_style']) && $settings['default-jplayer_style'] == 'style-1'){
				if(!empty($settings['default-jplayer_image']['id'])){
					$image_src = wp_get_attachment_image_src($settings['default-jplayer_image']['id'], 'full');?>
					<div style="background-image: url('<?php echo esc_url($image_src[0])?>');" class="kode_sab_banner_wrap them_overlay <?php echo esc_attr($islamic_center_theme_option['kode-header-style']);?>">
				<?php }else{ ?>
					<div style="background-image: url('<?php echo esc_url($settings['default-jplayer_image']['url'])?>');" class="kode_sab_banner_wrap them_overlay <?php echo esc_attr($islamic_center_theme_option['kode-header-style']);?>">
				<?php }?>			
				<!--CONTAINER START-->
				<div class="container">
					<div class="sab_banner_text">
						<?php if(!empty($settings['default-jplayer_title'])){ ?><h2><?php echo esc_html($settings['default-jplayer_title'])?></h2><?php }?>
						<?php if(!empty($settings['default-jplayer_caption'])){ ?><p><?php echo esc_html($settings['default-jplayer_caption'])?></p><?php }?>
						<?php if($settings['enable-breadcrumbs'] == 'enable'){ ?>
							<?php islamic_center_get_breadcumbs();?>
						<?php }?>
					</div>
				</div>
				<!--CONTAINER END-->
			</div>
			<?php }else{ 
				if(!empty($settings['default-jplayer_image']['id'])){
					$image_src = wp_get_attachment_image_src($settings['default-jplayer_image']['id'], 'full');?>
					<div style="background-image: url('<?php echo esc_url($image_src[0])?>');" class="kode_sab_banner_wrap them_overlay <?php echo esc_attr($islamic_center_theme_option['kode-header-style']);?>">
				<?php }else{ ?>
					<div style="background-image: url('<?php echo esc_url($settings['default-jplayer_image']['url'])?>');" class="kode_sab_banner_wrap them_overlay <?php echo esc_attr($islamic_center_theme_option['kode-header-style']);?>">
				<?php }?>			
				<!--CONTAINER START-->
				<div class="container">
					<div class="sab_banner_text">
						<?php if(!empty($settings['default-jplayer_title'])){ ?><h2><?php echo esc_html($settings['default-jplayer_title'])?></h2><?php }?>
						<?php if(!empty($settings['default-jplayer_caption'])){ ?><p><?php echo esc_html($settings['default-jplayer_caption'])?></p><?php }?>
						<?php if($settings['enable-breadcrumbs'] == 'enable'){ ?>
							<?php islamic_center_get_breadcumbs();?>
						<?php }?>
					</div>
				</div>
				<!--CONTAINER END-->
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
