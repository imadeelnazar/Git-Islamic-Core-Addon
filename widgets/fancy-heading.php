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
 * Elementor Fancy Heading
 *
 * Elementor widget for fancy heading.
 *
 * @since 1.0.0
 */
class Fancy_Heading extends Widget_Base {

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
		return 'fancy-heading';
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
		return __( 'Fancy Heading', 'elementor-call-to-action' );
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
		return 'eicon-heading';
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
			'fancy_heading_settings',
			[
				'label' => __( 'Fancy Heading', 'elementor-call-to-action' ),
			]
		);

		$this->add_control(
			'fancy_heading_settings_margin_bottom',
			[
				'label' => esc_html__( 'Margin Bottom', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
						'step' => 1
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section_heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'fancy_heading_title',
			[
				'label' => esc_html__( 'Fancy Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'see what were doing', 'essential-addons-elementor' )
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'fancy_heading_typography',
				'selector' => '{{WRAPPER}} .heading-style-4.heading h2, {{WRAPPER}} .fancy-heading-style-1 h2,{{WRAPPER}} .section_hdg h3',
			]
		);

		$this->add_control(
			'fancy_heading_caption',
			[
				'label' => esc_html__( 'Fancy Caption', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Lorem Ipsum version of Lorem Ipsum. Proin gravida', 'essential-addons-elementor' )
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'fancy_heading_caption_typography',
				'selector' => '{{WRAPPER}} .section_heading p',
			]
		);

		$this->add_control(
		  'fancy_heading_style',
		  	[
		   	'label'       	=> esc_html__( 'Fancy Type', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'style-1',
		     	'label_block' 	=> false,
		     	'options' 		=> [
					'style-1' => esc_html__('Style 1', 'jobly'),
					'style-2' => esc_html__('Style 2', 'jobly')
		     	],
		  	]
		);

		/*$this->add_control(
		  'fancy_heading_style_color',
		  	[
		   	'label'       	=> esc_html__( 'Arabic Symbol Color', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'style-1',
		     	'label_block' 	=> false,
		     	'options' 		=> [
					'style-1' => esc_html__('White', 'jobly'),
					'style-2' => esc_html__('Black', 'jobly')
		     	],
		  	]
		);*/

		$this->add_responsive_control(
			'fancy_heading_alignment',
			[
				'label' => esc_html__( 'Alignment', 'essential-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'essential-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'essential-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'essential-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .heading-style-4.heading,{{WRAPPER}} .fancy-heading-style-1' => 'text-align: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Slider Text Settings
		 */
		$this->start_controls_section(
			'fancy_heading_color_settings',
			[
				'label' => esc_html__( 'Color & Design', 'essential-addons-elementor' ),
			]
		);

		$this->add_control(
			'fancy_heading_bismillah_color',
			[
				'label' => esc_html__( 'Arabic Symbol Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} i.fancy-bismillah-01' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fancy_heading_title_color',
			[
				'label' => esc_html__( 'Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .heading-style-4.heading h2, {{WRAPPER}} .fancy-heading-style-1 h2,{{WRAPPER}} .section_hdg h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fancy_heading_mosque_color',
			[
				'label' => esc_html__( 'Mosque Icon color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#D2973B',
				'selectors' => [
					'{{WRAPPER}} i.fancy-heading-01 ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fancy_heading_sub_title_color',
			[
				'label' => esc_html__( 'Caption', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .section_heading p' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'fancy_heading_border_line_color',
			[
				'label' => esc_html__( ' Border Line Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#D2973B',
				'selectors' => [
					'{{WRAPPER}} .section_hdg span:before' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fancy_heading_border_line_color_style',
			[
				'label' => esc_html__( 'Left Border Line Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#D2973B',
				'selectors' => [
					'{{WRAPPER}} .section_hdg span:after' => 'border-left-color: {{VALUE}};',
				],
				'condition' => [
					'fancy_heading_style' => 'style-1'
				]
			]
		);

		$this->add_control(
			'fancy_headingt_icon_size',
			[
				'label' => esc_html__( 'Arabic Symbol Size', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100
				],
				'range' => [
					'px' => [
						'min' => 60,
						'max' => 1000,
						'step' => 1
					],
				],
				'selectors' => [
					'{{WRAPPER}} i.fancy-bismillah-01' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'fancy_headingt_icon2_size',
			[
				'label' => esc_html__( 'Mosque Icon Size', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70
				],
				'range' => [
					'px' => [
						'min' => 60,
						'max' => 1000,
						'step' => 1
					],
				],
				'selectors' => [
					'{{WRAPPER}} i.fancy-heading-01 ' => 'font-size: {{SIZE}}{{UNIT}};',
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
<div class="col-md-12 fancy-heading-wrapper fancy-heading-<?php echo esc_attr( $this->get_id() ); ?>">



    <?php if(isset($settings['fancy_heading_style']) && $settings['fancy_heading_style'] == 'style-1'){ ?>
    <!--SECTION HEADING START-->
    <div
        class="section_heading fancy-heading-style-1 align-<?php echo esc_attr($settings['fancy_heading_alignment'])?> section_hdg hdg_2">

        <i class="fancy-bismillah-01"></i>

        <h3 class="heading-normal"><?php echo esc_attr($settings['fancy_heading_title'])?></h3>
        <span><i class="fancy-heading-01"></i></span>
        <?php if(!empty($settings['fancy_heading_caption'])){ ?><p>
            <?php echo esc_html($settings['fancy_heading_caption'])?></p><?php }?>
    </div>
    <!--SECTION HEADING END-->
    <?php }else{
				if(isset($settings['fancy_heading_alignment']) && $settings['fancy_heading_alignment'] == 'left'){  ?>
    <div
        class="section_heading fancy-heading-style-1 section_hdg align-<?php echo esc_attr($settings['fancy_heading_alignment'])?>">

        <i class="fancy-bismillah-01"></i>
        <h3><?php echo esc_attr($settings['fancy_heading_title'])?><span><i class="fancy-heading-01"></i></span></h3>
        <?php if(!empty($settings['fancy_heading_caption'])){ ?><p>
            <?php echo esc_html($settings['fancy_heading_caption'])?></p><?php }?>
    </div>
    <?php }else if(isset($settings['fancy_heading_alignment']) && $settings['fancy_heading_alignment'] == 'center'){ ?>
    <!--SECTION HEADING START-->
    <div
        class="section_heading fancy-heading-style-1 align-<?php echo esc_attr($settings['fancy_heading_alignment'])?> section_hdg hdg_2">
        <i class="fancy-bismillah-01"></i>
        <h3 class="heading-normal"><?php echo esc_attr($settings['fancy_heading_title'])?></h3>
        <span><i class="fancy-heading-01"></i></span>
        <?php if(!empty($settings['fancy_heading_caption'])){ ?><p>
            <?php echo esc_html($settings['fancy_heading_caption'])?></p><?php }?>
    </div>
    <!--SECTION HEADING END-->
    <?php }else if(isset($settings['fancy_heading_alignment']) && $settings['fancy_heading_alignment'] == 'right'){ ?>
    <div
        class="section_heading fancy-heading-style-1 section_hdg align-<?php echo esc_attr($settings['fancy_heading_alignment'])?>">
        <i class="fancy-bismillah-01"></i>
        <h3><?php echo esc_attr($settings['fancy_heading_title'])?><span><i class="fancy-heading-01"></i></span></h3>
        <?php if(!empty($settings['fancy_heading_caption'])){ ?><p>
            <?php echo esc_html($settings['fancy_heading_caption'])?></p><?php }?>
    </div>
    <?php }?>
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