<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Call To Action
 *
 * Elementor widget for call to action.
 *
 * @since 1.0.0
 */
class Features_Steps extends Widget_Base {

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
		return 'features-steps';
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
		return __( 'Features Steps', 'elementor-call-to-action' );
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
		
		return [ 'core-style' ];	
		
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
			'features_steps_settings',
			[
				'label' => __( 'Feature', 'elementor-call-to-action' ),
			]
		);

		
		$this->add_control(
			'features_steps_list_slides',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'features_steps_list_item_title' => '1.Create a account' ],
					[ 'features_steps_list_item_title' => '2.Search & Applied Job' ],
					[ 'features_steps_list_item_title' => '3.Get Hire' ],					
				],
				'fields' => [
					[
						'name' => 'features_steps_list_item_icon',
						'label' => esc_html__( 'List Icon', 'essential-addons-elementor' ),
						'type' => Controls_Manager::ICON,
						'label_block' => true,
						'default' => esc_html__( 'islamicon-hand', 'essential-addons-elementor' )
					],
					[
						'name' => 'features_steps_list_item_title',
						'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( 'Dummy text of the printing and typesetting industry', 'essential-addons-elementor' )
					],
					[
						'name' => 'features_steps_list_item_caption',
						'label' => esc_html__( 'Caption', 'essential-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( 'This is Photoshops version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. ', 'essential-addons-elementor' )
					],
					[
						'name' => 'features_steps_list_item_color',
						'label' => esc_html__( 'Title Color', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#f4f4f4',
						'selectors' => [
							'{{WRAPPER}} .slide-item .slide-caption .kode-sub-title' => 'color: {{VALUE}};',
						],
					],
					[
						'name' => 'features_steps_list_item_btn_link',
						'label' => esc_html__( 'Button Link', 'essential-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
					],
				],
				'title_field' => '{{features_steps_list_item_title}}',
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
		<div class="call-to-action-wrapper call-to-action-<?php echo esc_attr( $this->get_id() ); ?>">
			<div class="feature_service_list">
				<ul>
				<?php 
				$feature_counter = 0;
				foreach( $settings['features_steps_list_slides'] as $slides ) { 
				$class = '';
				if($feature_counter % 2 == 0){
					$class = '';	
				}else{
					$class = 'arrow_img';
				}$feature_counter++;
				
				?>
					<li class="<?php echo esc_attr($class);?>">
						<div class="feature_service_text">
							<?php if(strpos($slides['features_steps_list_item_icon'],'fa-') === false){ ?>
							<span>
								<i class="islamicon <?php echo esc_attr($slides['features_steps_list_item_icon'])?>">
									<small class="path1"></small><small class="path2"></small><small class="path3"></small><small class="path4"></small><small class="path5"></small><small class="path6"></small><small class="path7"></small><small class="path8"></small><small class="path9"></small><small class="path10"></small><small class="path11"></small><small class="path12"></small><small class="path13"></small><small class="path14"></small><small class="path15"></small><small class="path16"></small><small class="path17"></small><small class="path18"></small><small class="path19"></small><small class="path20"></small><small class="path21"></small><small class="path22"></small><small class="path23"></small><small class="path24"></small><small class="path25"></small><small class="path26"></small><small class="path27"></small><small class="path28"></small><small class="path29"></small><small class="path30"></small><small class="path31"></small><small class="path32"></small><small class="path33"></small><small class="path34"></small><small class="path35"></small><small class="path36"></small><small class="path37"></small><small class="path38"></small><small class="path39"></small><small class="path40"></small><small class="path41"></small><small class="path42"></small><small class="path43"></small><small class="path44"></small><small class="path45"></small><small class="path46"></small><small class="path47"></small><small class="path48"></small><small class="path49"></small><small class="path50"></small><small class="path51"></small><small class="path52"></small><small class="path53"></small><small class="path54"></small><small class="path55"></small><small class="path56"></small><small class="path57"></small><small class="path58"></small><small class="path59"></small><small class="path60"></small><small class="path61"></small><small class="path62"></small><small class="path63"></small><small class="path64"></small><small class="path65"></small><small class="path66"></small><small class="path67"></small><small class="path68"></small><small class="path69"></small><small class="path70"></small><small class="path71"></small><small class="path72"></small><small class="path73"></small><small class="path74"></small><small class="path75"></small><small class="path76"></small><small class="path77"></small><small class="path78"></small><small class="path79"></small><small class="path80"></small><small class="path81"></small><small class="path82"></small><small class="path83"></small><small class="path84"></small><small class="path85"></small><small class="path86"></small><small class="path87"></small><small class="path88"></small><small class="path89"></small><small class="path90"></small><small class="path91"></small><small class="path92"></small><small class="path93"></small><small class="path94"></small><small class="path95"></small><small class="path96"></small><small class="path97"></small><small class="path98"></small><small class="path99"></small><small class="path100"></small><small class="path101"></small><small class="path102"></small><small class="path103"></small><small class="path104"></small>
								</i>
							</span>
							<?php }else{ ?>
							<span>
								<i class="fa <?php echo esc_attr($slides['features_steps_list_item_icon'])?>"></i>
							</span>
							<?php }?>
							<h5><?php echo esc_attr($slides['features_steps_list_item_title'])?></h5>
							<p><?php echo esc_attr($slides['features_steps_list_item_caption'])?></p>
							<a href="<?php echo esc_attr($slides['features_steps_list_item_btn_link'])?>"><i class="islamicon islamicon-addone"></i></a>
						</div>
					</li>
				<?php }?>	
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
