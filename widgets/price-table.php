<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Main Slider
 *
 * Elementor widget for main slider.
 *
 * @since 1.0.0
 */
class Price_Table extends Widget_Base {

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
		return 'price-table';
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
		return __( 'Price Table', 'elementor-main-slider' );
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
		
			return [ 'core-functions' , 'core-style' ];	
	
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
			'price_table_settings',
			[
				'label' => __( 'Header', 'elementor-main-slider' ),
			]
		);

		
		
		
		$this->add_control(
		  'price_table_settings_type',
		  	[
				'label'       	=> esc_html__( 'Pricing Style', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'style-1',
		     	'label_block' 	=> false,
		     	'options' 		=> [				
					'style-1' => esc_html__('Style 1', 'jobly'),
					'style-2' => esc_html__('Style 2', 'jobly'),
					'style-3' => esc_html__('Style 3', 'jobly'),
					'style-4' => esc_html__('Style 4', 'jobly'),
		     	],
		  	]
		);
		
		$this->add_control(
			'price_table_settings_header_bg',
			[
				'label' => esc_html__( 'Background Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1e73be',
				'selectors' => [
					'{{WRAPPER}} .bg_color' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'price_table_settings_header_bg_hover',
			[
				'label' => esc_html__( 'Background Hover Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1e73be',
				'selectors' => [
					'{{WRAPPER}} .job_package_list:hover .job_package_monthly::before' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'price_table_settings_header_border',
			[
				'label' => esc_html__( 'Border Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1e73be',
				'selectors' => [
					'{{WRAPPER}} .job_package_categorie h6' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'price_table_settings_list_icon',
			[
				'label' => __( 'List Icon', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'false',
				'label_on' => esc_html__( 'Yes', 'essential-addons-elementor' ),
				'label_off' => esc_html__( 'No', 'essential-addons-elementor' ),
				'return_value' => 'true',
			]
		);
		$this->add_control(
			'price_table_settings_item_icon',
			[
				'label' => __( 'Icon', 'essential-addons-elementor' ),
				'name' => 'price_table_settings_icon',				
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => esc_html__( '', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'price_table_settings_list_title',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Startup', 'jobly')
			]
		);
		
		$this->add_control(
			'price_table_settings_list_caption',
			[
				'label' => esc_html__( 'Caption', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Consecteture adipiscing elit, sed diam nonummy', 'jobly')
			]
		);
					
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'price_table_settings_price',
			[
				'label' => __( 'Price', 'elementor-main-slider' ),
			]
		);

		$this->add_control(
		  'price_table_settings_price_number',
		  	[
				'label' => esc_html__( 'Price', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('99', 'jobly')
		  	]
		);
		
		$this->add_control(
			'price_table_settings_list_icon_sale',
			[
				'label' => __( 'On Sale?', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'false',
				'label_on' => esc_html__( 'Yes', 'essential-addons-elementor' ),
				'label_off' => esc_html__( 'No', 'essential-addons-elementor' ),
				'return_value' => 'true',
			]
		);
		
		$this->add_control(
		  'price_table_settings_price_currency',
		  	[
				'label' => esc_html__( 'Currency', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('$', 'jobly')
		  	]
		);
		
		$this->add_control(
			'price_table_settings_price_currency_placement',
			[
				'label' => __( 'Currency Placement', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' 		=> [				
					'left' => esc_html__('Left', 'jobly'),
					'right' => esc_html__('Right', 'jobly')
		     	],
			]
		);
		
		$this->add_control(
		  'price_table_settings_price_period',
		  	[
				'label' => esc_html__( 'Price Period (per)', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('month', 'jobly')
		  	]
		);
		
		$this->add_control(
		  'price_table_settings_price_period_sep',
		  	[
				'label' => esc_html__( 'Period Separator', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('/', 'jobly')
		  	]
		);
					
		
		$this->end_controls_section();

		/**
		 * Filp Carousel Slides
		 */
		$this->start_controls_section(
			'price_table_setting_features',
			[
				'label' => esc_html__( 'Features', 'essential-addons-elementor' ),
			]
		);
		
		$this->add_control(
		  'price_table_settings_feature_icon',
		  	[
				'label' => esc_html__( 'List Icon', 'essential-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => esc_html__('islamicon-check', 'jobly')
		  	]
		);

		$this->add_control(
			'price_table_settings_slides',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'price_table_settings_item_title' => '05 Job Posting' ],
					[ 'price_table_settings_item_title' => '02 Highlighted Job Post' ],
					[ 'price_table_settings_item_title' => 'Job dispalyed 10 days' ],
					[ 'price_table_settings_item_title' => '05 Renew Jobs' ],
					[ 'price_table_settings_item_title' => '2 Category' ],
					[ 'price_table_settings_item_title' => 'Premium Support' ]
				],
				'fields' => [
					[
						'name' => 'price_table_settings_item_title',
						'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( '05 Job Posting', 'essential-addons-elementor' )
					],
					[
						'name' => 'price_table_settings_item_color',
						'label' => esc_html__( 'Item Color', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#f4f4f4',
						'selectors' => [
							'{{WRAPPER}} .slide-item .slide-caption .kode-sub-title' => 'color: {{VALUE}};',
						],
					],
					[
						'name' => 'price_table_settings_item_active',
						'label' => __( 'Item Active', 'essential-addons-elementor' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'false',
						'label_on' => esc_html__( 'Yes', 'essential-addons-elementor' ),
						'label_off' => esc_html__( 'No', 'essential-addons-elementor' ),
						'return_value' => 'true',
					],
					[
						'name' => 'price_table_settings_item_tooltip',
						'label' => __( 'Tool Tip', 'essential-addons-elementor' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'false',
						'label_on' => esc_html__( 'Yes', 'essential-addons-elementor' ),
						'label_off' => esc_html__( 'No', 'essential-addons-elementor' ),
						'return_value' => 'true',
					]
				],
				'title_field' => '{{price_table_settings_item_title}}',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'price_table_settings_button',
			[
				'label' => __( 'Button', 'elementor-main-slider' ),
			]
		);

		$this->add_control(
		  'price_table_settings_button_text',
		  	[
				'label' => esc_html__( 'Button Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Button Text', 'jobly')
		  	]
		);
		
		$this->add_control(
		  'price_table_settings_button_icon',
		  	[
				'label' => esc_html__( 'Button Icon', 'essential-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => esc_html__( '', 'essential-addons-elementor' )
		  	]
		);
		
		$this->add_control(
		  'price_table_settings_button_placement',
		  	[
				'label' => __( 'Button Icon Placement', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' 		=> [				
					'left' => esc_html__('Left', 'jobly'),
					'right' => esc_html__('Right', 'jobly')
		     	],
		  	]
		);
		
		$this->add_control(
		  'price_table_settings_button_link',
		  	[
				'label' => esc_html__( 'Button Link', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('#', 'jobly')
		  	]
		);
		
			
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'price_table_settings_ribbon',
			[
				'label' => __( 'Ribbon', 'elementor-main-slider' ),
			]
		);
		
		$this->add_control(
		  'price_table_settings_ribbon_featured',
			[
				'label' => __( 'Featured?', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'false',
				'label_on' => esc_html__( 'Yes', 'essential-addons-elementor' ),
				'label_off' => esc_html__( 'No', 'essential-addons-elementor' ),
				'return_value' => 'true',
		  	]
		);
		
		$this->add_control(
		  'price_table_settings_ribbon_style',
		  	[
				'label' => esc_html__( 'Ribbon Style', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => esc_html__('Featured', 'jobly'),
				'options' 		=> [				
					'style-1' => esc_html__('Style 1', 'jobly'),
					'style-2' => esc_html__('Style 2', 'jobly'),
					'style-3' => esc_html__('Style 3', 'jobly'),
		     	],
		  	]
		);

		$this->add_control(
		  'price_table_settings_ribbon_tag',
		  	[
				'label' => esc_html__( 'Featured Tag Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Featured', 'jobly')
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
		
		$class_price_table = '';
		$counter_price_table = 0;
		?>
		<div class="price-table-wrapper price-table-<?php echo esc_attr( $this->get_id() ); ?>">
			<?php  
			$class_price_table = '';
			if($settings['price_table_settings_ribbon_featured']){
				$class_price_table = 'active';
			}
			?>
		<?php if(isset($settings['price_table_settings_type']) && $settings['price_table_settings_type'] == 'style-1'){ ?>
			<div class="job_pricing_list <?php echo esc_attr($class_price_table)?>">
				<div class="job_pricing_text">						
					<?php if(strpos($settings['price_table_settings_item_icon'],'fa-') === false){ ?>
						<span>
							<i class="islamicon <?php echo esc_attr($settings['price_table_settings_item_icon'])?>">
								<small class="path1"></small><small class="path2"></small><small class="path3"></small><small class="path4"></small><small class="path5"></small><small class="path6"></small><small class="path7"></small><small class="path8"></small><small class="path9"></small><small class="path10"></small><small class="path11"></small><small class="path12"></small><small class="path13"></small><small class="path14"></small><small class="path15"></small><small class="path16"></small><small class="path17"></small><small class="path18"></small><small class="path19"></small><small class="path20"></small><small class="path21"></small><small class="path22"></small><small class="path23"></small><small class="path24"></small><small class="path25"></small><small class="path26"></small><small class="path27"></small><small class="path28"></small><small class="path29"></small><small class="path30"></small><small class="path31"></small><small class="path32"></small><small class="path33"></small><small class="path34"></small><small class="path35"></small><small class="path36"></small><small class="path37"></small><small class="path38"></small><small class="path39"></small><small class="path40"></small><small class="path41"></small><small class="path42"></small><small class="path43"></small><small class="path44"></small><small class="path45"></small><small class="path46"></small><small class="path47"></small><small class="path48"></small><small class="path49"></small><small class="path50"></small><small class="path51"></small><small class="path52"></small><small class="path53"></small><small class="path54"></small><small class="path55"></small><small class="path56"></small><small class="path57"></small><small class="path58"></small><small class="path59"></small><small class="path60"></small><small class="path61"></small><small class="path62"></small><small class="path63"></small><small class="path64"></small><small class="path65"></small><small class="path66"></small><small class="path67"></small><small class="path68"></small><small class="path69"></small><small class="path70"></small><small class="path71"></small><small class="path72"></small><small class="path73"></small><small class="path74"></small><small class="path75"></small><small class="path76"></small><small class="path77"></small><small class="path78"></small><small class="path79"></small><small class="path80"></small><small class="path81"></small><small class="path82"></small><small class="path83"></small><small class="path84"></small><small class="path85"></small><small class="path86"></small><small class="path87"></small><small class="path88"></small><small class="path89"></small><small class="path90"></small><small class="path91"></small><small class="path92"></small><small class="path93"></small><small class="path94"></small><small class="path95"></small><small class="path96"></small><small class="path97"></small><small class="path98"></small><small class="path99"></small><small class="path100"></small><small class="path101"></small><small class="path102"></small><small class="path103"></small><small class="path104"></small>
							</i>
						</span>
					<?php }else{ ?>
						<span>
							<i class="fa <?php echo esc_attr($settings['price_table_settings_item_icon'])?>"></i>
						</span>
					<?php }?>
					<h5><?php echo esc_html($settings['price_table_settings_list_title']);?></h5>
					<p><?php echo esc_html($settings['price_table_settings_list_caption']);?></p>
					<h2 class="price"><?php echo esc_html($settings['price_table_settings_price_number']);?><sup><?php echo esc_html($settings['price_table_settings_price_currency'])?></sup><sub><?php echo esc_html($settings['price_table_settings_price_period']);?></sub></h2>
				</div>
				<div class="job_pricing_detail">
					<ul>
					<?php foreach( $settings['price_table_settings_slides'] as $slides ) { ?>
						<li>
						<a href="#">
							<?php if(strpos($settings['price_table_settings_feature_icon'],'fa-') === false){ ?>
								<span>
									<i class="islamicon <?php echo esc_attr($settings['price_table_settings_feature_icon'])?>">
										<small class="path1"></small><small class="path2"></small><small class="path3"></small><small class="path4"></small><small class="path5"></small><small class="path6"></small><small class="path7"></small><small class="path8"></small><small class="path9"></small><small class="path10"></small><small class="path11"></small><small class="path12"></small><small class="path13"></small><small class="path14"></small><small class="path15"></small><small class="path16"></small><small class="path17"></small><small class="path18"></small><small class="path19"></small><small class="path20"></small><small class="path21"></small><small class="path22"></small><small class="path23"></small><small class="path24"></small><small class="path25"></small><small class="path26"></small><small class="path27"></small><small class="path28"></small><small class="path29"></small><small class="path30"></small><small class="path31"></small><small class="path32"></small><small class="path33"></small><small class="path34"></small><small class="path35"></small><small class="path36"></small><small class="path37"></small><small class="path38"></small><small class="path39"></small><small class="path40"></small><small class="path41"></small><small class="path42"></small><small class="path43"></small><small class="path44"></small><small class="path45"></small><small class="path46"></small><small class="path47"></small><small class="path48"></small><small class="path49"></small><small class="path50"></small><small class="path51"></small><small class="path52"></small><small class="path53"></small><small class="path54"></small><small class="path55"></small><small class="path56"></small><small class="path57"></small><small class="path58"></small><small class="path59"></small><small class="path60"></small><small class="path61"></small><small class="path62"></small><small class="path63"></small><small class="path64"></small><small class="path65"></small><small class="path66"></small><small class="path67"></small><small class="path68"></small><small class="path69"></small><small class="path70"></small><small class="path71"></small><small class="path72"></small><small class="path73"></small><small class="path74"></small><small class="path75"></small><small class="path76"></small><small class="path77"></small><small class="path78"></small><small class="path79"></small><small class="path80"></small><small class="path81"></small><small class="path82"></small><small class="path83"></small><small class="path84"></small><small class="path85"></small><small class="path86"></small><small class="path87"></small><small class="path88"></small><small class="path89"></small><small class="path90"></small><small class="path91"></small><small class="path92"></small><small class="path93"></small><small class="path94"></small><small class="path95"></small><small class="path96"></small><small class="path97"></small><small class="path98"></small><small class="path99"></small><small class="path100"></small><small class="path101"></small><small class="path102"></small><small class="path103"></small><small class="path104"></small>
									</i>
								</span>
							<?php }else{ ?>
								<span>
									<i class="fa <?php echo esc_attr($settings['price_table_settings_feature_icon'])?>"></i>
								</span>
							<?php }?>
							<?php echo esc_html($slides['price_table_settings_item_title']);?>
						</a>
						</li>
					<?php }?>
					</ul>
					<a class="theme_btn btn2 btn-hover2" href="<?php echo esc_url($settings['price_table_settings_button_link'])?>">
						<?php echo esc_html($settings['price_table_settings_button_text'])?> <?php if(strpos($settings['price_table_settings_button_icon'],'fa-') === false){ ?>
							<span>
								<i class="islamicon <?php echo esc_attr($settings['price_table_settings_button_icon'])?>">
									<small class="path1"></small><small class="path2"></small><small class="path3"></small><small class="path4"></small><small class="path5"></small><small class="path6"></small><small class="path7"></small><small class="path8"></small><small class="path9"></small><small class="path10"></small><small class="path11"></small><small class="path12"></small><small class="path13"></small><small class="path14"></small><small class="path15"></small><small class="path16"></small><small class="path17"></small><small class="path18"></small><small class="path19"></small><small class="path20"></small><small class="path21"></small><small class="path22"></small><small class="path23"></small><small class="path24"></small><small class="path25"></small><small class="path26"></small><small class="path27"></small><small class="path28"></small><small class="path29"></small><small class="path30"></small><small class="path31"></small><small class="path32"></small><small class="path33"></small><small class="path34"></small><small class="path35"></small><small class="path36"></small><small class="path37"></small><small class="path38"></small><small class="path39"></small><small class="path40"></small><small class="path41"></small><small class="path42"></small><small class="path43"></small><small class="path44"></small><small class="path45"></small><small class="path46"></small><small class="path47"></small><small class="path48"></small><small class="path49"></small><small class="path50"></small><small class="path51"></small><small class="path52"></small><small class="path53"></small><small class="path54"></small><small class="path55"></small><small class="path56"></small><small class="path57"></small><small class="path58"></small><small class="path59"></small><small class="path60"></small><small class="path61"></small><small class="path62"></small><small class="path63"></small><small class="path64"></small><small class="path65"></small><small class="path66"></small><small class="path67"></small><small class="path68"></small><small class="path69"></small><small class="path70"></small><small class="path71"></small><small class="path72"></small><small class="path73"></small><small class="path74"></small><small class="path75"></small><small class="path76"></small><small class="path77"></small><small class="path78"></small><small class="path79"></small><small class="path80"></small><small class="path81"></small><small class="path82"></small><small class="path83"></small><small class="path84"></small><small class="path85"></small><small class="path86"></small><small class="path87"></small><small class="path88"></small><small class="path89"></small><small class="path90"></small><small class="path91"></small><small class="path92"></small><small class="path93"></small><small class="path94"></small><small class="path95"></small><small class="path96"></small><small class="path97"></small><small class="path98"></small><small class="path99"></small><small class="path100"></small><small class="path101"></small><small class="path102"></small><small class="path103"></small><small class="path104"></small>
								</i>
							</span>
						<?php }else{ ?>
							<span>
								<i class="fa <?php echo esc_attr($settings['price_table_settings_button_icon'])?>"></i>
							</span>
						<?php }?>
					</a>
				</div>
				<?php if(isset($settings['price_table_settings_ribbon_featured']) && $settings['price_table_settings_ribbon_featured'] == true){ ?>
					<a class="most_job" href="<?php echo esc_url($settings['price_table_settings_ribbon_tag'])?>"><?php echo esc_html($settings['price_table_settings_ribbon_tag'])?></a>
				<?php }?>
			</div>
		<?php }else if(isset($settings['price_table_settings_type']) && $settings['price_table_settings_type'] == 'style-2'){ ?>
			<div class="job_pricing_four">
				<div class="job_price_plan">
					<div class="job_price_plan_text">
						
						<?php if(strpos($settings['price_table_settings_item_icon'],'fa-') === false){ ?>
							<span>
								<i class="islamicon <?php echo esc_attr($settings['price_table_settings_item_icon'])?>">
									<small class="path1"></small><small class="path2"></small><small class="path3"></small><small class="path4"></small><small class="path5"></small><small class="path6"></small><small class="path7"></small><small class="path8"></small><small class="path9"></small><small class="path10"></small><small class="path11"></small><small class="path12"></small><small class="path13"></small><small class="path14"></small><small class="path15"></small><small class="path16"></small><small class="path17"></small><small class="path18"></small><small class="path19"></small><small class="path20"></small><small class="path21"></small><small class="path22"></small><small class="path23"></small><small class="path24"></small><small class="path25"></small><small class="path26"></small><small class="path27"></small><small class="path28"></small><small class="path29"></small><small class="path30"></small><small class="path31"></small><small class="path32"></small><small class="path33"></small><small class="path34"></small><small class="path35"></small><small class="path36"></small><small class="path37"></small><small class="path38"></small><small class="path39"></small><small class="path40"></small><small class="path41"></small><small class="path42"></small><small class="path43"></small><small class="path44"></small><small class="path45"></small><small class="path46"></small><small class="path47"></small><small class="path48"></small><small class="path49"></small><small class="path50"></small><small class="path51"></small><small class="path52"></small><small class="path53"></small><small class="path54"></small><small class="path55"></small><small class="path56"></small><small class="path57"></small><small class="path58"></small><small class="path59"></small><small class="path60"></small><small class="path61"></small><small class="path62"></small><small class="path63"></small><small class="path64"></small><small class="path65"></small><small class="path66"></small><small class="path67"></small><small class="path68"></small><small class="path69"></small><small class="path70"></small><small class="path71"></small><small class="path72"></small><small class="path73"></small><small class="path74"></small><small class="path75"></small><small class="path76"></small><small class="path77"></small><small class="path78"></small><small class="path79"></small><small class="path80"></small><small class="path81"></small><small class="path82"></small><small class="path83"></small><small class="path84"></small><small class="path85"></small><small class="path86"></small><small class="path87"></small><small class="path88"></small><small class="path89"></small><small class="path90"></small><small class="path91"></small><small class="path92"></small><small class="path93"></small><small class="path94"></small><small class="path95"></small><small class="path96"></small><small class="path97"></small><small class="path98"></small><small class="path99"></small><small class="path100"></small><small class="path101"></small><small class="path102"></small><small class="path103"></small><small class="path104"></small>
								</i>
							</span>
						<?php }else{ ?>
							<span>
								<i class="fa <?php echo esc_attr($settings['price_table_settings_item_icon'])?>"></i>
							</span>
						<?php }?>
						
						<h6><?php echo esc_html($settings['price_table_settings_list_title']);?></h6>
						<h2><sup><?php echo esc_html($settings['price_table_settings_price_currency']);?></sup><?php echo esc_html($settings['price_table_settings_price_number']);?></h2>
						<span>\<?php echo esc_html($settings['price_table_settings_price_period']);?></span>
					</div>	
					<ul class="job_pricing_paln_list">
					<?php foreach( $settings['price_table_settings_slides'] as $slides ) { ?>
						<li>
							<a href="#">
								<?php if(strpos($settings['price_table_settings_feature_icon'],'fa-') === false){ ?>
									<span>
										<i class="islamicon <?php echo esc_attr($settings['price_table_settings_feature_icon'])?>">
											<small class="path1"></small><small class="path2"></small><small class="path3"></small><small class="path4"></small><small class="path5"></small><small class="path6"></small><small class="path7"></small><small class="path8"></small><small class="path9"></small><small class="path10"></small><small class="path11"></small><small class="path12"></small><small class="path13"></small><small class="path14"></small><small class="path15"></small><small class="path16"></small><small class="path17"></small><small class="path18"></small><small class="path19"></small><small class="path20"></small><small class="path21"></small><small class="path22"></small><small class="path23"></small><small class="path24"></small><small class="path25"></small><small class="path26"></small><small class="path27"></small><small class="path28"></small><small class="path29"></small><small class="path30"></small><small class="path31"></small><small class="path32"></small><small class="path33"></small><small class="path34"></small><small class="path35"></small><small class="path36"></small><small class="path37"></small><small class="path38"></small><small class="path39"></small><small class="path40"></small><small class="path41"></small><small class="path42"></small><small class="path43"></small><small class="path44"></small><small class="path45"></small><small class="path46"></small><small class="path47"></small><small class="path48"></small><small class="path49"></small><small class="path50"></small><small class="path51"></small><small class="path52"></small><small class="path53"></small><small class="path54"></small><small class="path55"></small><small class="path56"></small><small class="path57"></small><small class="path58"></small><small class="path59"></small><small class="path60"></small><small class="path61"></small><small class="path62"></small><small class="path63"></small><small class="path64"></small><small class="path65"></small><small class="path66"></small><small class="path67"></small><small class="path68"></small><small class="path69"></small><small class="path70"></small><small class="path71"></small><small class="path72"></small><small class="path73"></small><small class="path74"></small><small class="path75"></small><small class="path76"></small><small class="path77"></small><small class="path78"></small><small class="path79"></small><small class="path80"></small><small class="path81"></small><small class="path82"></small><small class="path83"></small><small class="path84"></small><small class="path85"></small><small class="path86"></small><small class="path87"></small><small class="path88"></small><small class="path89"></small><small class="path90"></small><small class="path91"></small><small class="path92"></small><small class="path93"></small><small class="path94"></small><small class="path95"></small><small class="path96"></small><small class="path97"></small><small class="path98"></small><small class="path99"></small><small class="path100"></small><small class="path101"></small><small class="path102"></small><small class="path103"></small><small class="path104"></small>
										</i>
									</span>
								<?php }else{ ?>
									<span>
										<i class="fa <?php echo esc_attr($settings['price_table_settings_feature_icon'])?>"></i>
									</span>
								<?php }?>
								<?php echo esc_html($slides['price_table_settings_item_title']);?>
							</a>
						</li>
					<?php }?>
					</ul>
					<div class="chose_demo">
						<a class="theme_btn btn-hover2" href="<?php echo esc_url($settings['price_table_settings_button_link'])?>">
							<?php echo esc_html($settings['price_table_settings_button_text'])?> <?php if(strpos($settings['price_table_settings_button_icon'],'fa-') === false){ ?>
								<span>
									<i class="islamicon <?php echo esc_attr($settings['price_table_settings_button_icon'])?>">
										<small class="path1"></small><small class="path2"></small><small class="path3"></small><small class="path4"></small><small class="path5"></small><small class="path6"></small><small class="path7"></small><small class="path8"></small><small class="path9"></small><small class="path10"></small><small class="path11"></small><small class="path12"></small><small class="path13"></small><small class="path14"></small><small class="path15"></small><small class="path16"></small><small class="path17"></small><small class="path18"></small><small class="path19"></small><small class="path20"></small><small class="path21"></small><small class="path22"></small><small class="path23"></small><small class="path24"></small><small class="path25"></small><small class="path26"></small><small class="path27"></small><small class="path28"></small><small class="path29"></small><small class="path30"></small><small class="path31"></small><small class="path32"></small><small class="path33"></small><small class="path34"></small><small class="path35"></small><small class="path36"></small><small class="path37"></small><small class="path38"></small><small class="path39"></small><small class="path40"></small><small class="path41"></small><small class="path42"></small><small class="path43"></small><small class="path44"></small><small class="path45"></small><small class="path46"></small><small class="path47"></small><small class="path48"></small><small class="path49"></small><small class="path50"></small><small class="path51"></small><small class="path52"></small><small class="path53"></small><small class="path54"></small><small class="path55"></small><small class="path56"></small><small class="path57"></small><small class="path58"></small><small class="path59"></small><small class="path60"></small><small class="path61"></small><small class="path62"></small><small class="path63"></small><small class="path64"></small><small class="path65"></small><small class="path66"></small><small class="path67"></small><small class="path68"></small><small class="path69"></small><small class="path70"></small><small class="path71"></small><small class="path72"></small><small class="path73"></small><small class="path74"></small><small class="path75"></small><small class="path76"></small><small class="path77"></small><small class="path78"></small><small class="path79"></small><small class="path80"></small><small class="path81"></small><small class="path82"></small><small class="path83"></small><small class="path84"></small><small class="path85"></small><small class="path86"></small><small class="path87"></small><small class="path88"></small><small class="path89"></small><small class="path90"></small><small class="path91"></small><small class="path92"></small><small class="path93"></small><small class="path94"></small><small class="path95"></small><small class="path96"></small><small class="path97"></small><small class="path98"></small><small class="path99"></small><small class="path100"></small><small class="path101"></small><small class="path102"></small><small class="path103"></small><small class="path104"></small>
									</i>
								</span>
							<?php }else{ ?>
								<span>
									<i class="fa <?php echo esc_attr($settings['price_table_settings_button_icon'])?>"></i>
								</span>
							<?php }?>
						</a>
					</div>
				</div>
			</div>
		<?php }else{ ?>
			<div class="job_pricetable_wrap">
				<div class="job_package_list">
					<div class="job_package_monthly pattern_bg bg_color">
						<h2 class="custom_size">
							<sup><?php echo esc_html($settings['price_table_settings_price_currency']);?></sup>
							<?php echo esc_html($settings['price_table_settings_price_number']);?>
							<sub>/<?php echo esc_html($settings['price_table_settings_price_period']);?></sub>
						</h2>
					</div>
					<div class="job_package_categorie">
						<h6><?php echo esc_html($settings['price_table_settings_list_title']);?></h6>
						<ul>
						<?php foreach( $settings['price_table_settings_slides'] as $slides ) { ?>
							<li>
							<a href="#">
								<?php if(strpos($settings['price_table_settings_feature_icon'],'fa-') === false){ ?>
									<span>
										<i class="islamicon <?php echo esc_attr($settings['price_table_settings_feature_icon'])?>">
											<small class="path1"></small><small class="path2"></small><small class="path3"></small><small class="path4"></small><small class="path5"></small><small class="path6"></small><small class="path7"></small><small class="path8"></small><small class="path9"></small><small class="path10"></small><small class="path11"></small><small class="path12"></small><small class="path13"></small><small class="path14"></small><small class="path15"></small><small class="path16"></small><small class="path17"></small><small class="path18"></small><small class="path19"></small><small class="path20"></small><small class="path21"></small><small class="path22"></small><small class="path23"></small><small class="path24"></small><small class="path25"></small><small class="path26"></small><small class="path27"></small><small class="path28"></small><small class="path29"></small><small class="path30"></small><small class="path31"></small><small class="path32"></small><small class="path33"></small><small class="path34"></small><small class="path35"></small><small class="path36"></small><small class="path37"></small><small class="path38"></small><small class="path39"></small><small class="path40"></small><small class="path41"></small><small class="path42"></small><small class="path43"></small><small class="path44"></small><small class="path45"></small><small class="path46"></small><small class="path47"></small><small class="path48"></small><small class="path49"></small><small class="path50"></small><small class="path51"></small><small class="path52"></small><small class="path53"></small><small class="path54"></small><small class="path55"></small><small class="path56"></small><small class="path57"></small><small class="path58"></small><small class="path59"></small><small class="path60"></small><small class="path61"></small><small class="path62"></small><small class="path63"></small><small class="path64"></small><small class="path65"></small><small class="path66"></small><small class="path67"></small><small class="path68"></small><small class="path69"></small><small class="path70"></small><small class="path71"></small><small class="path72"></small><small class="path73"></small><small class="path74"></small><small class="path75"></small><small class="path76"></small><small class="path77"></small><small class="path78"></small><small class="path79"></small><small class="path80"></small><small class="path81"></small><small class="path82"></small><small class="path83"></small><small class="path84"></small><small class="path85"></small><small class="path86"></small><small class="path87"></small><small class="path88"></small><small class="path89"></small><small class="path90"></small><small class="path91"></small><small class="path92"></small><small class="path93"></small><small class="path94"></small><small class="path95"></small><small class="path96"></small><small class="path97"></small><small class="path98"></small><small class="path99"></small><small class="path100"></small><small class="path101"></small><small class="path102"></small><small class="path103"></small><small class="path104"></small>
										</i>
									</span>
								<?php }else{ ?>
									<span>
										<i class="fa <?php echo esc_attr($settings['price_table_settings_feature_icon'])?>"></i>
									</span>
								<?php }?>
								<?php echo esc_html($slides['price_table_settings_item_title']);?>
							</a>
							</li>
						<?php }?>
						</ul>
					</div>
					<div class="job_detail bg_color">
						<a href="<?php echo esc_url($settings['price_table_settings_button_link'])?>">
							<?php echo esc_html($settings['price_table_settings_button_text'])?> <?php if(strpos($settings['price_table_settings_button_icon'],'fa-') === false){ ?>
								<span>
									<i class="islamicon <?php echo esc_attr($settings['price_table_settings_button_icon'])?>">
										<small class="path1"></small><small class="path2"></small><small class="path3"></small><small class="path4"></small><small class="path5"></small><small class="path6"></small><small class="path7"></small><small class="path8"></small><small class="path9"></small><small class="path10"></small><small class="path11"></small><small class="path12"></small><small class="path13"></small><small class="path14"></small><small class="path15"></small><small class="path16"></small><small class="path17"></small><small class="path18"></small><small class="path19"></small><small class="path20"></small><small class="path21"></small><small class="path22"></small><small class="path23"></small><small class="path24"></small><small class="path25"></small><small class="path26"></small><small class="path27"></small><small class="path28"></small><small class="path29"></small><small class="path30"></small><small class="path31"></small><small class="path32"></small><small class="path33"></small><small class="path34"></small><small class="path35"></small><small class="path36"></small><small class="path37"></small><small class="path38"></small><small class="path39"></small><small class="path40"></small><small class="path41"></small><small class="path42"></small><small class="path43"></small><small class="path44"></small><small class="path45"></small><small class="path46"></small><small class="path47"></small><small class="path48"></small><small class="path49"></small><small class="path50"></small><small class="path51"></small><small class="path52"></small><small class="path53"></small><small class="path54"></small><small class="path55"></small><small class="path56"></small><small class="path57"></small><small class="path58"></small><small class="path59"></small><small class="path60"></small><small class="path61"></small><small class="path62"></small><small class="path63"></small><small class="path64"></small><small class="path65"></small><small class="path66"></small><small class="path67"></small><small class="path68"></small><small class="path69"></small><small class="path70"></small><small class="path71"></small><small class="path72"></small><small class="path73"></small><small class="path74"></small><small class="path75"></small><small class="path76"></small><small class="path77"></small><small class="path78"></small><small class="path79"></small><small class="path80"></small><small class="path81"></small><small class="path82"></small><small class="path83"></small><small class="path84"></small><small class="path85"></small><small class="path86"></small><small class="path87"></small><small class="path88"></small><small class="path89"></small><small class="path90"></small><small class="path91"></small><small class="path92"></small><small class="path93"></small><small class="path94"></small><small class="path95"></small><small class="path96"></small><small class="path97"></small><small class="path98"></small><small class="path99"></small><small class="path100"></small><small class="path101"></small><small class="path102"></small><small class="path103"></small><small class="path104"></small>
									</i>
								</span>
							<?php }else{ ?>
								<span>
									<i class="fa <?php echo esc_attr($settings['price_table_settings_button_icon'])?>"></i>
								</span>
							<?php }?>
						</a>
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
