<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Call To Action Small Box
 *
 * Elementor widget for call to action small box.
 *
 * @since 1.0.0
 */
class Call_To_Action_Small_Box extends Widget_Base {

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
		return 'call-to-action-small-box';
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
		return __( 'CTA Small Box', 'elementor-call-to-action' );
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
			'call_to_action_small_box_settings',
			[
				'label' => __( 'CTA Small Box', 'elementor-call-to-action' ),
			]
		);
		
		$this->add_control(
		  'call_to_action_small_box_style',
		  	[
		   	'label'       	=> esc_html__( 'Style', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'style-1',
		     	'label_block' 	=> false,
		     	'options' 		=> [				
					'style-1'=> esc_html__('Style 1', 'baldiyaat'),
					'style-2'=> esc_html__('Style 2', 'baldiyaat')
		     	],
		  	]
		);
		
		$this->add_control(
			'call_to_action_list_item_image',
			[
				'label' => esc_html__( 'Call To Action Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'images/call-to-action-small-box.png',
				]
			]
		);
		
		$this->add_control(
			'call_to_action_list_item_icon',
			[
				'label' => esc_html__( 'Icon', 'essential-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => esc_html__( 'check-islamicon', 'essential-addons-elementor' )
			]
		);

		$this->add_control(
			'call_to_action_small_box_title',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Browse More Than 20,000 Current Vacancies', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_small_link',
			[
				'label' => esc_html__( 'Link', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( '#', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_small_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Browse All Categories', 'essential-addons-elementor' )
			]
		);
		
		
		$this->end_controls_section();

		/**
		 * Slider Text Settings
		 */
		$this->start_controls_section(
			'call_to_action_small_box_color_settings',
			[
				'label' => esc_html__( 'Color & Design', 'essential-addons-elementor' ),
			]
		);
		
		
		$this->add_control(
			'call_to_action_small_box_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#063869',
				'selectors' => [
					'{{WRAPPER}} .job_loacation_list,{{WRAPPER}} .job_cv_categories' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'call_to_action_small_box_title_color',
			[
				'label' => esc_html__( 'Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .job_cv_categories h4' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'call_to_action_small_box_button_color',
			[
				'label' => esc_html__( 'Button BG Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .theme_btn.btn2' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'call_to_action_small_box_button_border_color',
			[
				'label' => esc_html__( 'Button Border Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .job_cv_categories .theme_btn.btn2' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'call_to_action_small_box_icon_color',
			[
				'label' => esc_html__( 'CTA Icon Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .job_cv_categories:before' => 'color: {{VALUE}};',
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
		<div class="call-to-action-small-box-wrapper call-to-action-<?php echo esc_attr( $this->get_id() ); ?>">
		<?php if(isset($settings['call_to_action_small_box_style']) && $settings['call_to_action_small_box_style'] == 'style-1'){ ?>
			<?php if(!empty($settings['call_to_action_list_item_image']['id'])){
				$image_src = wp_get_attachment_image_src($settings['call_to_action_list_item_image']['id'], 'full');?>
				
				<div class="job_cv_categories" style="background-image:url(<?php echo esc_url($image_src[0])?>)">
			<?php }else{ ?>
				<div class="job_cv_categories" style="background-image:url(<?php echo esc_url($settings['call_to_action_list_item_image']['url'])?>)">
			<?php } ?>
				<h4><?php echo esc_html($settings['call_to_action_small_box_title'])?></h4>
				<a class="theme_btn btn2 btn-hover1" href="<?php echo esc_html($settings['call_to_action_small_link'])?>"><?php echo esc_html($settings['call_to_action_small_btn_text'])?></a>
			</div>			
		<?php }else{ ?>
			<div class="job_loacation_list">				
				<?php if(strpos($settings['call_to_action_list_item_icon'],'fa-') === false){ ?>
				<span>
					<i class="islamicon <?php echo esc_attr($settings['call_to_action_list_item_icon'])?>">
						<small class="path1"></small><small class="path2"></small><small class="path3"></small><small class="path4"></small><small class="path5"></small><small class="path6"></small><small class="path7"></small><small class="path8"></small><small class="path9"></small><small class="path10"></small><small class="path11"></small><small class="path12"></small><small class="path13"></small><small class="path14"></small><small class="path15"></small><small class="path16"></small><small class="path17"></small><small class="path18"></small><small class="path19"></small><small class="path20"></small><small class="path21"></small><small class="path22"></small><small class="path23"></small><small class="path24"></small><small class="path25"></small><small class="path26"></small><small class="path27"></small><small class="path28"></small><small class="path29"></small><small class="path30"></small><small class="path31"></small><small class="path32"></small><small class="path33"></small><small class="path34"></small><small class="path35"></small><small class="path36"></small><small class="path37"></small><small class="path38"></small><small class="path39"></small><small class="path40"></small><small class="path41"></small><small class="path42"></small><small class="path43"></small><small class="path44"></small><small class="path45"></small><small class="path46"></small><small class="path47"></small><small class="path48"></small><small class="path49"></small><small class="path50"></small><small class="path51"></small><small class="path52"></small><small class="path53"></small><small class="path54"></small><small class="path55"></small><small class="path56"></small><small class="path57"></small><small class="path58"></small><small class="path59"></small><small class="path60"></small><small class="path61"></small><small class="path62"></small><small class="path63"></small><small class="path64"></small><small class="path65"></small><small class="path66"></small><small class="path67"></small><small class="path68"></small><small class="path69"></small><small class="path70"></small><small class="path71"></small><small class="path72"></small><small class="path73"></small><small class="path74"></small><small class="path75"></small><small class="path76"></small><small class="path77"></small><small class="path78"></small><small class="path79"></small><small class="path80"></small><small class="path81"></small><small class="path82"></small><small class="path83"></small><small class="path84"></small><small class="path85"></small><small class="path86"></small><small class="path87"></small><small class="path88"></small><small class="path89"></small><small class="path90"></small><small class="path91"></small><small class="path92"></small><small class="path93"></small><small class="path94"></small><small class="path95"></small><small class="path96"></small><small class="path97"></small><small class="path98"></small><small class="path99"></small><small class="path100"></small><small class="path101"></small><small class="path102"></small><small class="path103"></small><small class="path104"></small>
					</i>
				</span>
				<?php }else{ ?>
				<span>
					<i class="fa <?php echo esc_attr($settings['call_to_action_list_item_icon'])?>"></i>
				</span>
				<?php }?>
				<div class="job_loacation_text">
					<h5><?php echo esc_html($settings['call_to_action_small_box_title'])?></h5>
					<p><?php echo esc_html($settings['call_to_action_small_btn_text'])?></p>
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
