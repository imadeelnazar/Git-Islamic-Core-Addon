<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Call To Action contact
 *
 * Elementor widget for call to action contact.
 *
 * @since 1.0.0
 */
class Call_To_Action_Contact extends Widget_Base {

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
		return 'call-to-action-contact';
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
		return __( 'CTA Contact', 'elementor-call-to-action' );
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
		return 'eicon-map-pin';
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
			'call_to_action_contact_settings',
			[
				'label' => __( 'Call To Action Contact', 'elementor-call-to-action' ),
			]
		);

		$this->add_control(
			'add_one',
			[
				'label' => esc_html__( 'First Address', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( '8569 Johanwolfgang street', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'add_two',
			[
				'label' => esc_html__( 'Second Address', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Berlin Germany L, 688521', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'phone_one',
			[
				'label' => esc_html__( 'First Phone', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Landline : 37/5 77868 777 688', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'phone_two',
			[
				'label' => esc_html__( 'Second Phone', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Mobile : +87 66665 7785 7', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'email_one',
			[
				'label' => esc_html__( 'Email Phone', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'General : info@islamic.com', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'email_two',
			[
				'label' => esc_html__( 'Second Email', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Office : info@islamic.com', 'essential-addons-elementor' )
			]
		);
		
		$this->end_controls_section();

		/**
		 * Slider Text Settings
		 */
		$this->start_controls_section(
			'call_to_action_contact_color_settings',
			[
				'label' => esc_html__( 'Color & Design', 'essential-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'call_to_action_contact_title_color',
			[
				'label' => esc_html__( 'Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_contact_text h5 a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'call_to_action_contact_title_hover_color',
			[
				'label' => esc_html__( 'Title Hover Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_contact_text:hover h5 a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'call_to_action_contact_sub_title_color',
			[
				'label' => esc_html__( 'Text Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_contact_text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'call_to_action_contact_sub_title_hover_color',
			[
				'label' => esc_html__( 'Text Hover Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_contact_text:hover p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'call_to_action_contact_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_contact_text a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'call_to_action_contact_icon_hover_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_contact_text:hover a' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'call_to_action_contact_bg_color',
			[
				'label' => esc_html__( 'Backgound Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_contact_service ul li' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'call_to_action_contact__bg_hover_color',
			[
				'label' => esc_html__( 'Background hover Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .kode_contact_service ul li:hover' => 'background-color: {{VALUE}};',
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
		<div class="call-to-action-contact-wrapper call-to-action-<?php echo esc_attr( $this->get_id() ); ?>">
			<div class="kode_contact_service">
				<ul>
					<li>
						<div class="kode_contact_text">
							<h5><a href="#"><?php echo esc_attr('Address','islamic-center')?></a></h5>
							<a href="#"><i class="fa fa-map-marker"></i></a>
							<p><span><?php echo esc_attr($settings['add_one'])?></span> <?php echo esc_attr($settings['add_two'])?></p>
						</div>
					</li>
					<li>
						<div class="kode_contact_text">
							<h5><a href="#"><?php echo esc_attr('Phone','islamic-center')?></a></h5>
							<a href="#"><i class="fa fa-phone"></i></a>
							<p><span><?php echo esc_attr($settings['phone_one'])?></span> <?php echo esc_attr($settings['phone_two'])?></p>
						</div>
					</li>
					<li>
						<div class="kode_contact_text">
							<h5><a href="#"><?php echo esc_attr('Email Address','islamic-center')?></a></h5>
							<a href="#"><i class="fa fa-envelope-o"></i></a>
							<p><span><?php echo esc_attr($settings['email_one'])?></span> <?php echo esc_attr($settings['email_two'])?></p>
						</div>
					</li>
				</ul>
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
