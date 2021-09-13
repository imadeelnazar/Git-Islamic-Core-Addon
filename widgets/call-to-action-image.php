<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Call To Action Image
 *
 * Elementor widget for call to action image.
 *
 * @since 1.0.0
 */
class Call_To_Action_Image extends Widget_Base {

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
		return 'call-to-action-image';
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
		return __( 'CTA Image', 'elementor-call-to-action' );
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
			'call_to_action_settings',
			[
				'label' => __( 'Call to Action Image', 'elementor-call-to-action' ),
			]
		);
		
		$this->add_control(
			'call_to_action_image_background',
			[
				'label' => esc_html__( 'Background Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => KODEFOREST_MAIN_URL . 'assets/call-to-action/slide-img-02.jpg',
				],
			]
		);
		
		$this->add_control(
			'call_to_action_title',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Madrasa in Istanbul', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'call_to_action_color_background',
			[
				'label' => esc_html__( 'Background Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#d5092c',
				'selectors' => [
					'{{WRAPPER}} .kode_mosque_fig .them_overlay figcaption h6' => 'border-color: {{VALUE}};',
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
		<div class="call-to-action-text-wrapper call-to-action-<?php echo esc_attr( $this->get_id() ); ?>">
			<div class="kode_mosque_fig ">
				<div class="kode_mosque_fig">
					<figure class="them_overlay">
						<?php if(!empty($settings['call_to_action_image_background']['id'])){
						$image_src = wp_get_attachment_image_src($settings['call_to_action_image_background']['id'], 'full'); ?>
						<img src="<?php echo esc_url($image_src[0])?>" alt="" />
						<?php }else{ ?>
						<img src="<?php echo esc_url($settings['call_to_action_image_background']['url'])?>" alt="" />
						<?php }?>
						<figcaption>
							<h6><a href=""><?php echo esc_attr($settings['call_to_action_title'])?></a></h6>
						</figcaption>
					</figure>
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
